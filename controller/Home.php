<?php
// namespace vng\classs;

/**
 *
 */
class Home extends Controller {

	public function index() 
	{
		$q = $this->db->query("SHOW DATABASES");

		$databases = $q->fetchAll(PDO::FETCH_COLUMN);
		require 'views/index.php';
	}
}