<?php // basketsmall.php

	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Дата в прошлом

session_start();

require_once 'login.php';//02.11.15
session_set_cookie_params('','/','m.'.$dircook);//m.pajamas.esy.es

//require_once 'login.php';//02.11.15

$idarr = array();
$nid = array();
$priceall = 0;

if(isset($_SESSION["idbasketsmall"])){
	$idarr = $_SESSION["idbasketsmall"];
	$nid = $_SESSION["nid"];
}

if(isset($_GET["id"])){
	$id = $foo_mysgli->sanitizeString($_GET["id"]); //получили из js
	//$clearone1 = $_GET["nocache"];
	$clearone = $foo_mysgli->sanitizeString($_GET["mclon"]);
	//echo "clearone = $clearone";
		if(in_array($id, $idarr)){//наличие значения в массиве
			foreach($idarr as $k=>$v){
				if($v == $id){
					if($clearone == 'FALSE'){
						$nid[$k]++;
					}
					else{
						array_splice($idarr, $k, 1);
						array_splice($nid, $k, 1);
					}
				}	
			}
		}
		else{
			$idarr[] = $id;
			$nid[] = 1;
		}
	if(count($idarr) == 0) $id= -1;	
}

//echo "sid = $id ";
if (!($id == -1)){
	require_once "bassmallunated.php";

	$_SESSION["idbasketsmall"] = $idarr;
	$_SESSION["nid"] = $nid;
}
else{
	destroy_session_and_data();
}

function destroy_session_and_data()
{	
	$_SESSION = array();
	if (session_id() != "" || isset($_COOKIE[session_name()]))
	setcookie(session_name(), '', time() - 2592000, '/');
	session_destroy();
}


?>