<?php

/**
* 
*/
class Controller
{

	public function __construct()
	{
		$db = new DB();
		$this->db = $db;
		$this->con = $db->getCon();
	}
	
	public function view($file)
	{
		require $file;
	}
}