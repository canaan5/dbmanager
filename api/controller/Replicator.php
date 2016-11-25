<?php

// use \vng\core\Database;

/**
 *
 */
class Replicator {

	private $db;

	public function __construct(Database $db) {
		
		$this->db = $db;
	}

	public function index() {
		echo 'hello from inside replicate class';
	}

	// public function connect($con) {

	// 	return $this->db->connect( $con, $user, $pass );
	// }

	public function getDatabase($con = null)
	{
		if ( $_POST['hostname'] )
		{
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];
			$host = $_REQUEST['hostname'];

			$con = $this->db->connect("mysql:host=$host", $username, $password);

			$q = $con->prepare("SHOW DATABASES");

			$vinda = "";

			$q->execute();
			while ($row = $q->fetch()) {

				$vinda .= "<option value='" . $row['Database'] . "'>" . $row['Database'] . "</option>";
			}

			echo $vinda;

			$con = null;
		}
	}

	public function getTables($con = null)
	{
		$dbname = $_REQUEST['db'];
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$host = $_REQUEST['host'];

		$con = $this->db->connect("mysql:host=$host;dbname=$dbname", $username, $password);

		$q = $con->query("SHOW TABLES");
		$q->execute();

		$dar = array();

		while ($row = $q->fetch()) {

			$tname = $row["Tables_in_$dbname"];
			array_push($dar, $tname);

		}

		$json = '(' . json_encode($dar) . ');';
		echo $_GET['callback'] . $json;
	}

	public function getRowCount()
	{
		$tname = $_POST['getdatasize'];
		$dbname = $_POST['dbname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$host = $_REQUEST['host'];

		$con = $this->db->connect("mysql:host=$host;dbname=$dbname", $username, $password);

		$q = $con->prepare("SELECT * FROM $tname");
		$q->execute();

		echo $q->rowCount();
	}

	public function compareTables()
	{
		$dsn1 = $_REQUEST['dsn1'];
		$dsn2 = $_REQUEST['dsn2'];
		$u1 = $_REQUEST['u1'];
		$p1 = $_REQUEST['p1'];
		$u2 = $_REQUEST['u2'];
		$p2 = $_REQUEST['p2'];

		$con1 = $this->db->connect($dsn1, $u1, $p1);
		$con2 = $this->db->connect($dsn2, $u2, $p2);

		/**
		 * Prepare the Master database;
		 */
		$q1 = $con1->query("SHOW TABLES");
		$q1->execute();

		// Get the master table table name
		$t1 = preg_split("/[=]+/", $dsn1);

		$tables1 = array();

		while ($row = $q1->fetch()) {

			$tname = $row["Tables_in_$t1[2]"];
			array_push($tables1, $tname);			
		}

		/**
		 * Prepare the Slave Database and tables
		 * 
		 */
		$q2 = $con2->query("SHOW TABLES");
		$q2->execute();

		// Get the Slave table table name
		$t2 = preg_split("/[=]+/", $dsn2);

		// $tables2 = array();

		// while ($row = $q2->fetch()) {

		// 	$tname = $row["Tables_in_$t2[2]"];
		// 	array_push($tables2, $tname);			
		// }

		foreach ($tables1 as $table1) {
			
			$s1 = $con1->query("SELECT * FROM $table1");
			$q1 = $con1->query("DESCRIBE $table1");
			$q1->execute();
			$s1->execute();

			$q2 = $con2->query("SELECT * FROM $table1");
			$s2 = $con2->query("DESCRIBE $table1");
			$q2->execute();
			$s2->execute();

			// $master_num_rows = $q1->rowCount();
			// $slave_num_rows = $q2->rowCount();

			// echo "number of rows in master is $master_num_rows";
			// echo '<br>';
			// echo "number of rows in slave is $slave_num_rows";
			
			while ($row = $q1->fetch()) {
				echo "Table for Master structure\n";
				echo "{$row['Field']} - {$row['Type']}\n";
			}


			$structure2 = [];

			while ($row = $q2->fetch()) {
				echo "Table for Slave structure\n";
				echo "{$row['Field']} - {$row['Type']}\n";

				array_push($structure2, $tname);
			}
			
			// if ($q1->fetch() === $q2->fetch() ) {

			// 	echo 'The same table structure';
			// } else {
			// 	echo 'different table structure';
			// }
		}
		
		$json = '(' . json_encode($dar) . ');';
		echo $_GET['callback'] . $json;

	}

}