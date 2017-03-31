<?
session_start();
if(isset($_GET["nidaj"])){
	//$nid = $_GET["nidaj"];
	$nid = $_SESSION["nid"];
	$nid[0] = 4;
	//array_splice($nid, 0, 1);
	$_SESSION["nid"] = $nid;
	echo "snid: $nid";
}
else echo "запрос не прошел";
?>