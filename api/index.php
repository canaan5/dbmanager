<?php
error_reporting(E_ALL);

require 'vendor/autoload.php';


$auth = new Auth();
if ( $auth->checkLogin() )
{
	$route = new Route();

	// Add a route and a method to map it to
	require 'routes.php';

	$route->submit();
}
