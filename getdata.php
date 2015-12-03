<?php

// error_reporting(1);
// set_time_limit(0);
// header('Access-Control-Allow-Origin: *');
require 'core/Database';
$db = new Database();
if ($_REQUEST['gettables']) {

	$dbname = $_REQUEST['gettables'];
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$host = $_REQUEST['host'];

	try {

		$dsn = "mysql:dbname=$dbname;host=$host";
		$db = new PDO($dsn, $username, $password);
		$db = $db->connect("mysql:dbname=verifynigeria;host=localhost", 'kesty', 'canaan');

		header('Content-type: application/json');

		$k = $db->query("SHOW TABLES");
		$k->execute();
		$dar = array();

		while ($row = $k->fetch()) {

			$tname = $row["Tables_in_$dbname"];
			array_push($dar, $tname);

		}

		$json = '(' . json_encode($dar) . ');';
		echo $_GET['callback'] . $json;

	} catch (PDOException $e) {
		echo "Error: $e->getMessages()";
	}

} elseif ($_POST['getdatasize']) {

	$tname = $_POST['getdatasize'];
	$dbname = $_POST['dbname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$host = $_REQUEST['host'];

	$db = new mysqli($host, $username, $password, $dbname);

	$vd = $db->query("SELECT * FROM $tname");
	$no_rows = $vd->num_rows;
	echo $no_rows;

} elseif ($_POST['hostname']) {

	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$host = $_REQUEST['hostname'];

	$dsn = "mysql:host=$host";
	$db = new PDO($dsn, $username, $password);

	$k = $db->prepare("SHOW DATABASES");

	$vinda = "";

	$k->execute();
	while ($row = $k->fetch()) {

		$vinda .= "<option value='" . $row['Database'] . "'>" . $row['Database'] . "</option>";
	}

	echo $vinda;
}
?>
