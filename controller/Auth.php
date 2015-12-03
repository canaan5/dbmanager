<?php


/**
* 
*/
class Auth
{

	public function __construct()
	{
		session_start();

		$this->checkLogin();
	}
	
	public function checkLogin()
	{
		if ( !isset ( $_SESSION["DBM_LOGIN"]))
		{
			$this->login();
			die;
		}

		return true;
	}

	public function login()
	{
		if ( $_POST )
		{

			$host = $_POST["host"];
			$user = $_POST["user"];
			$pass = $_POST["pass"];

			try {

				$dsn = "mysql:host=$host";

				$con = new DB($dsn, $user, $pass);

				if ( $con ) {
					$_SESSION["DBM_LOGIN"] = true;
					$_SESSION["DBM_DSN"] = $dsn;
					$_SESSION["DBM_USER"] = $user;
					$_SESSION["DBM_PASS"] = $pass;
					return header("Location: /");
				}
				
			} catch (PDOException $e) {

				echo "Error: " . $e->getMessage();

			}
		} else {

			require 'views/login.php';
		}

		
	}

	public function logout()
	{
		session_start();
		unset($_SESSION['DBM_LOGIN']);
		unset($_SESSION['DBM_DSN']);
		unset($_SESSION['DBM_USER']);
		unset($_SESSION['DBM_PASS']);
		return header("Location: /login");
	}
}