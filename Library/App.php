<?php
	namespace Library;
	/**
	 * Application Main Page That Will Serve All Requests
	 *
	 * @package PRO CODE CIP Framework
	 * @author  code@cipmedia.vn
	 * @version 1.0.0
	 * @license http://cipmedia.vn
	 */
	class App {
		/**
		* Array Holds Application Instances
		* @var array
		*/
		protected static $instances = [];
		/**
		 * Register An Application Instance
		 * @param  String $key      Instance Name
		 * @param  Object $instance Instance
		 * @return Null
		 */
		public static function register($key,$instance)
		{
			if( !isset( self::$instances[ $key ] ) )
			{
				// Register
				self::$instances[ $key ] = $instance;
			}
		}
		/**
		* Get An Registerd Instance
		* @param  String $key Instance Name
		* @return Mixed Object If Found Otherwise Null
		**/
		public static function get($key)
		{
			return self::has( $key ) ? self::$instances[ $key ] : null;
		}
		/**
		 * Check If An Instance Registered
		 * @param  String  $key Instance name
		 * @return boolean
		 */
		public static function has( $key )
		{
			return isset( self::$instances[ $key ] );
		}

		public static function GetRegister($urlcode){
			/*if(!$_SESSION['Resgister']){
				$ch = curl_init(base64_decode($urlcode));
				$data_curl = array('domain' => $_SERVER["SERVER_NAME"]);
				$param_curl = http_build_query($data_curl);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $param_curl);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$kqUrls = curl_exec($ch);
				$result = json_decode($kqUrls,true);
				if($result['data']['result']==404){
					$result = $result['data']['result'];
				} else {
					$result = 1;
				}
				$_SESSION['Resgister'] = $result;
				curl_close($ch);
			} else {
				$result = $_SESSION['Resgister'];
			}*/
			return $result;
		}

		public static function hasError($type){
			switch ($type) { 
				case 'email': $error = 'Email không hợp lệ'; break; 
				case 'username': $error = 'Username không được rỗng'; break; 
				case 'password': $error = 'Password không hợp lệ'; break; 
				default: break;
			}
			return $error;
		}
		
	}