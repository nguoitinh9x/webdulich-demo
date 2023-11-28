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
class View{

	private $db;
	private $func;

	public function __construct()
    {
    	
    }

    public function db(){
        return new functions;
    }

    public function func(){
    	return new functions;
    }

    public function lang(){
        return new Lang;
    }

}