<?php
//require_once 'login.php';
function sanitizeString($var)
{
	if (get_magic_quotes_gpc()) $var = stripslashes($var);
	$var =  htmlspecialchars($var);
	$var = strip_tags($var);
	return $var;
}
function sanitizeMySQL($var)
{
	$db_hostname = 'localhost';
	$db_database = 'pajamas';
	$db_username = 'mak';
	$db_password = '1234';
	
	$foo_mysgli = new foo_mysgli;
	$foo_mysgli->myconstruct($db_hostname, $db_username, $db_password, $db_database);
	//$foo_mysgli = new foo_mysgli;
	$var = $foo_mysgli->mysql_real_escape_string($var);
	$var = sanitizeString($var);
	return $var;
}

?>