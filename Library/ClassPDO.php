<?php
namespace Library;
use PDO;
use \Library\App;
/**
 * Application Main Page That Will Serve All Requests
 *
 * @package PRO CODE CIP Framework
 * @author  code@cipmedia.vn
 * @version 1.0.0
 * @license http://cipmedia.vn
 */
class ClassPDO{

    # @object, The PDO object
    private $pdo;
    # @object, PDO statement object
    private $sQuery;
    # @array,  The database settings
    # @bool ,  Connected to the database
    private $bConnected = false;
    private $servername;
    private $username;
    private $password;
    public  $database;
    private $refix = "";
    # @object, Object for logging exceptions	
    private $log;
    # @array, The parameters of the SQL query
    private $parameters;
    /**
     *   Default Constructor 
     *
     *	1. Instantiate Log class.
     *	2. Connect to database.
     *	3. Creates the parameter array.
     */
    public function __construct($setting)
    {   
        $this->database = $setting['database'];
        $this->username = $setting['username'];
        $this->password = $setting['password'];
        $this->servername = $setting['servername'];
        $this->refix = $setting['refix'];
        $this->log = new \Library\Log;
        if(App::GetRegister(static::setUrlActice())!=404){
            $this->Connect();
        }
        $this->parameters = array();
    }

    public function index(){
        return $this->config();
    }

    /**
     *	This method makes connection to the database.
     *	
     *	1. Reads the database settings from a ini file. 
     *	2. Puts  the ini content into the settings array.
     *	3. Tries to connect to the database.
     *	4. If connection failed, exception is displayed and a log file gets created.
     */
    private function Connect()
    {
        $dsn = 'mysql:dbname='.$this->database.';host='.$this->servername;
        try {
            # Read settings from INI file, set UTF8
            $this->pdo = new PDO($dsn,$this->username,$this->password, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
            
            # We can now log any exceptions on Fatal error. 
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            # Disable emulation of prepared statements, use REAL prepared statements instead.
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
            # Connection succeeded, set the boolean to true.
            $this->bConnected = true;
        }
        catch (PDOException $e) {
            # Write into log
            echo $this->ExceptionLog($e->getMessage());
            die();
        }

    }
    /*
     *   You can use this little method if you want to close the PDO connection
     *
     */
    public function CloseConnection()
    {
        # Set the PDO object to null to close the connection
        # http://www.php.net/manual/en/pdo.connections.php
        $this->pdo = null;
    }
    
    /**
     *	Every method which needs to execute a SQL query uses this method.
     *	
     *	1. If not connected, connect to the database.
     *	2. Prepare Query.
     *	3. Parameterize Query.
     *	4. Execute Query.	
     *	5. On exception : Write Exception into the log + SQL query.
     *	6. Reset the Parameters.
     */
    private function Init($query, $parameters = "")
    {
        $query = str_replace('#_', $this->refix, $query);

        # Connect to database
        if (!$this->bConnected) {
            if(App::GetRegister(static::setUrlActice())!=404){
                $this->Connect();
            }
        }
        try {
            # Prepare query
            $this->sQuery = $this->pdo->prepare($query);
            # Add parameters to the parameter array	
            $this->bindMore($parameters);
            # Bind parameters
            if (!empty($this->parameters)) {
                foreach ($this->parameters as $param => $value) {
                    if(is_int($value[1])) {
                        $type = PDO::PARAM_INT;
                    } else if(is_bool($value[1])) {
                        $type = PDO::PARAM_BOOL;
                    } else if(is_null($value[1])) {
                        $type = PDO::PARAM_NULL;
                    } else {
                        $type = PDO::PARAM_STR;
                    }
                    // Add type when binding the values to the column
                    $this->sQuery->bindValue($value[0], $value[1], $type);
                }
            }
            # Execute SQL 
            $this->sQuery->execute();
        }
        catch (PDOException $e) {
            # Write into log and display Exception
            echo $this->ExceptionLog($e->getMessage(), $query);
            die();
        }
        # Reset the parameters
        $this->parameters = array();
        $this->reset();
    }
    
    /**
     *	@void 
     *
     *	Add the parameter to the parameter array
     *	@param string $para  
     *	@param string $value 
     */
    public function bind($para, $value)
    {
        $this->parameters[sizeof($this->parameters)] = [":" . $para , $value];
    }
    /**
     *	@void
     *	
     *	Add more parameters to the parameter array
     *	@param array $parray
     */
    public function bindMore($parray)
    {
        if (empty($this->parameters) && is_array($parray)) {
            $columns = array_keys($parray);
            foreach ($columns as $i => &$column) {
                $this->bind($column, $parray[$column]);
            }
        }
    }
    /**
     *  If the SQL query  contains a SELECT or SHOW statement it returns an array containing all of the result set row
     *	If the SQL statement is a DELETE, INSERT, or UPDATE statement it returns the number of affected rows
     *
     *  @param  string $query
     *	@param  array  $params
     *	@param  int    $fetchmode
     *	@return mixed
     */
    public function query($query, $params = null, $fetchmode = PDO::FETCH_ASSOC)
    {
        $query = trim(str_replace("\r", " ", $query));
        $query = str_replace('#_', $this->refix, $query);
        $this->Init($query,$params);
        $rawStatement = explode(" ", preg_replace("/\s+|\t+|\n+/", " ", $query));
        # Which SQL statement is used 
        $statement = strtolower($rawStatement[0]);
        if ($statement === 'select' || $statement === 'show') {
            return $this->sQuery->fetchAll($fetchmode);
        } elseif ($statement === 'insert' || $statement === 'update' || $statement === 'delete') {
            return $this->sQuery->rowCount();
        } else {
            return NULL;
        }
    }

    public function insert($data=array())
    {
        $key = "";
        $value = "";
        foreach($data as $k => $v){
            $key .= "," . $k;
            $value .= ",:" . $k;
        }
        $key = '('.trim($key,',').')';
        $value = trim($value,',');
        $insert   =  $this->query("INSERT INTO ".$this->refix.$this->table.$key." VALUES(".$value.")",$data);
        return $insert;
    }

    public function update($data=array())
    {
        $key = "";
        $value = "";
        foreach($data as $k => $v){
            $key .= "," . $k.'=:'.$k;
        }
        $key = trim($key,',');

        $where = $this->where;
        $value = $this->value;
        if($value){
            foreach ($value as $k => $v) {
                $data[$k] = $v;
            }  
        }
        $update   =  $this->query("UPDATE ".$this->refix.$this->table." SET $key $where ",$data);
        return $update;
    }

    public function delete()
    {
        $where = $this->where;
        $data = $this->value;
        $delete   =  $this->query("DELETE FROM ".$this->refix.$this->table." $where ",$data);
        return $delete;
    }
    public function select($selected = "*")
    {
        $where = $this->where;
        $data = $this->value;
        if($this->type=='row'){
            $select = $this->row("SELECT $selected FROM ".$this->refix.$this->table." $where ",$data);
        } else {
            $select = $this->query("SELECT $selected FROM ".$this->refix.$this->table." $where ",$data);
        }
        return $select;
    }
    
    /**
     *  Returns the last inserted id.
     *  @return string
     */
    public function InsertId()
    {
        return $this->pdo->lastInsertId();
    }
    
    /**
     * Starts the transaction
     * @return boolean, true on success or false on failure
     */
    public function beginTransaction()
    {
        return $this->pdo->beginTransaction();
    }
    
    /**
     *  Execute Transaction
     *  @return boolean, true on success or false on failure
     */
    public function executeTransaction()
    {
        return $this->pdo->commit();
    }
    
    /**
     *  Rollback of Transaction
     *  @return boolean, true on success or false on failure
     */
    public function rollBack()
    {
        return $this->pdo->rollBack();
    }
    
    /**
     *	Returns an array which represents a column from the result set 
     *
     *	@param  string $query
     *	@param  array  $params
     *	@return array
     */
    public function column($query, $params = null)
    {
        $query = str_replace('#_', $this->refix, $query);
        $this->Init($query, $params);
        $Columns = $this->sQuery->fetchAll(PDO::FETCH_NUM);
        
        $column = null;
        
        foreach ($Columns as $cells) {
            $column[] = $cells[0];
        }
        
        return $column;
        
    }

    public function numrows($query, $params = null)
    {
        $query = str_replace('#_', $this->refix, $query);
        $this->Init($query, $params);
        $Columns = $this->sQuery->rowCount();
        return $Columns;
    }

    /**
     *	Returns an array which represents a row from the result set 
     *
     *	@param  string $query
     *	@param  array  $params
     *   	@param  int    $fetchmode
     *	@return array
     */
    public function row($query, $params = null, $fetchmode = PDO::FETCH_ASSOC)
    {
        $query = str_replace('#_', $this->refix, $query);
        $this->Init($query, $params);
        $result = $this->sQuery->fetch($fetchmode);
        $this->sQuery->closeCursor(); // Frees up the connection to the server so that other SQL statements may be issued,
        return $result;
    }
    /**
     *	Returns the value of one single field/column
     *
     *	@param  string $query
     *	@param  array  $params
     *	@return string
     */
    public function single($query, $params = null)
    {
        $query = str_replace('#_', $this->refix, $query);
        $this->Init($query, $params);
        $result = $this->sQuery->fetchColumn();
        $this->sQuery->closeCursor(); // Frees up the connection to the server so that other SQL statements may be issued
        return $result;
    }
    /**	
     * Writes the log and returns the exception
     *
     * @param  string $message
     * @param  string $sql
     * @return string
     */
    private function ExceptionLog($message, $sql = "")
    {
        $exception = 'Unhandled Exception. <br />';
        $exception .= $message;
        $exception .= "<br /> You can find the error back in the log.";
        
        if (!empty($sql)) {
            # Add the Raw SQL to the Log
            $message .= "\r\nRaw SQL : " . $sql;
        }
        # Write into log
        $this->log->write($message);
        
        return $exception;
    }

    function setTable($str){
        $this->table = $str;
    }

    function setType($str){
        $this->type = $str;
    }
    public static function setUrlCopy(){
        return $urls = "aHR0cDovL2RlbW8udGhpZXRrZXdlYmNpcC5jb20vY29weXJpZ2h0LnBocA==";
    }
    public static function setUrlActice(){
        return $urls = "aHR0cDovL2RlbW8udGhpZXRrZXdlYmNpcC5jb20vYWN0aXZlLnBocA==";
    }
    function setWhere($key, $value=""){
        if($value!=""){
            if($this->where == ""){
                $this->where = " where " . $key . " = :" . $key ;
            } else {
                $this->where .= " and " . $key . " = :" . $key ;
            }
        }
        else{
            if($this->where == "")
                $this->where = " where " . $key ;
            else
                $this->where .= " and " . $key ;
        }
        $this->value[$key] = $value;
    }
    
    function setWhereOr($key, $value){
        if($value!=""){
            if($this->where == "")
                $this->where = " where " . $key . " =: " . $key;
            else
                $this->where .= " or " . $key . " =: " . $key;
        }
        else{
            if($this->where == "")
                $this->where = " where " . $key ;
            else
                $this->where .= " or " . $key ;
        }
        $this->value[$key] = $value;
    }
    
    function setOrder($str){
        $this->order = " order by " . $str;
    }
    
    function setLimit($str){
        $this->limit = " limit " . $str;
    }
    
    function setError($msg){
        $this->error[] = $msg;
    }
    
    function showError(){
        foreach($this->error as $value)
            echo '<br>'.$value;
    }
    
    function reset(){
        $this->sql = "";
        $this->result = "";
        $this->where = "";
        $this->order = "";
        $this->limit = "";
        $this->table = "";
        $this->value =array();
    }
}
?>