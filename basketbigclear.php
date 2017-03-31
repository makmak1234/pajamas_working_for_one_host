<?php
//это изменение кол-ва
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Дата в прошлом

//require_once 'sanitizeString.php';

require_once 'login.php';

echo <<<END
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
END;
	
session_start();
if(isset($_GET["nidaj"]) && isset($_GET["kg2"])){
	$nidaj = $foo_mysgli->sanitizeString($_GET["nidaj"]);
	$k = $foo_mysgli->sanitizeString($_GET["kg2"]);
	$nid = $_SESSION["nid"];
	$nid[$k] = $nidaj;
	//array_splice($nid, 0, 1);
	$_SESSION["nid"] = $nid;
	//echo "snid: $nid[$k]";
}
//else echo "запрос не прошел";

if(isset($_GET["exchrtv"]) && isset($_GET["elem"])){
	$exchrtv = $foo_mysgli->sanitizeString($_GET["exchrtv"]);
	$elem = $foo_mysgli->sanitizeString($_GET["elem"]);
	//print_r(" exchrtv= " . $exchrtv . "elem= " . $elem);
	/*if(isset($_GET["index"])){
		$index =  sanitizeString($_GET["index"]);
		if($exchrtv == 8 && $index == "sal") $exchrtv = 2;
		if($exchrtv == 9 && $index == "sal") $exchrtv = 7;
		if($exchrtv == 2 && $index == "ret") $exchrtv = 8;
		if($exchrtv == 7 && $index == "ret") $exchrtv = 9;
	}*/
	if($exchrtv == "true") $exchrtv = 1;
	else if($exchrtv == "false") $exchrtv = 0;
	
	if(!isset($_GET["index"])){
		$query = "UPDATE pajset SET $elem='$exchrtv' WHERE id=1"; //WHERE name1='$name1' OR name1='$nameadmin1'		
		$result = $foo_mysgli->mysql_query($query);
		if(!$result) echo " Сбой при измен данных pajset"  . $foo_mysgli->mysql_error($result);
	}
	
	if(isset($_GET["index"])){
		$index =  $foo_mysgli->sanitizeString($_GET["index"]);
		if($index == "ret"){
			setcookie("valcook", "0", 0, "", ".".$dircook, false, true);//.pajamas.esy.es
		}
		else if($index == "sal"){
			setcookie("valcook", "1", 0, "", ".".$dircook, false, true);//.pajamas.esy.es
		}
		$nameinp = "none";
		$inputgoodsid="";
		if(isset($_GET["inputgoodsid"])){
			$inputgoodsid = $foo_mysgli->sanitizeString($_GET["inputgoodsid"]);
			$nameinp = "inputgoodsid";
		}
		//$mobcook = $_COOKIE["mobcook"];
		//if($mobcook == "1") $mydir = $dirpajsm;
		//if($mobcook == "0") $mydir = $dirpajs;
		$mydir = $dirpajs;
	$valcook = "none";
	if(isset($_COOKIE["valcook"]))$valcook = $_COOKIE["valcook"];
		echo <<<END
	valcook = $valcook
		<form name="inputgoodsid" action="$mydir" method="POST">
			<input type="hidden" name="$nameinp" value="$inputgoodsid" />
	<!--<input type="submit" value="Посмотрел">-->
		</form>
		<script>document.inputgoodsid.submit()</script>
END;
	}
}

if(isset($_POST["organiz"])){
	//$dirpajs .= ".";
	//setcookie("valcook", "1", 0, "", $dirpajs, false, true);
	
	$organiz = substr($foo_mysgli->sanitizeMySQL(trim($_POST['organiz'])), 0, 30); 
	$city =  substr($foo_mysgli->sanitizeMySQL(trim($_POST['city'])), 0, 30); 
	$tel =  substr($foo_mysgli->sanitizeMySQL(trim($_POST['tel'])), 0, 13); 
	$email =  substr($foo_mysgli->sanitizeMySQL(trim($_POST['email'])), 0, 30);
	
	$mypassa = explode(" ", $organiz);
	$mypass = $mypassa[0];
	$mypass = ltrim($mypass);
	//print($mypass);	
	//$mypass = strtolower($mypass);
	//if(strlen($mypass) > 5) $mypass = substr($mypass, 0, 5);
	//print($mypass);
	$mypass .= rand(10,99);
	
	//создаём таблицу регистрации оптовиков
	$query = "CREATE TABLE salclients (orderclients MEDIUMINT,
										mycurdate CHAR(11), 
										mycurtime CHAR(8), 
										organiz VARCHAR(30)  CHARACTER SET utf8 COLLATE utf8_unicode_ci, 
										city VARCHAR(30)  CHARACTER SET utf8 COLLATE utf8_unicode_ci, 
										tel VARCHAR(30), 
										email VARCHAR(30),  
										pass VARCHAR(32),
										id MEDIUMINT AUTO_INCREMENT KEY) ENGINE MyISAM";

		$result = $foo_mysgli->mysql_query($query);
		if($result){
			$query = "INSERT INTO salclients VALUES (NULL, CURDATE(), CURTIME(), 'Тестовая запись', 'City', 'Tel', 'email', NULL, NULL)";
			$result = $foo_mysgli->mysql_query($query);
			if(!$result) echo "Сбой при изменении данных salclients: $query <br />" . $foo_mysgli->mysql_error($result);
		}
	//записываем данные оптовиков в табл salclients
	$query = "INSERT INTO salclients VALUES (NULL, CURDATE(), CURTIME(), '$organiz', '$city', '$tel', '$email', '$mypass', NULL)";
	$result = $foo_mysgli->mysql_query($query);
	if(!$result) echo "Сбой при изменении данных salclients: $query <br />" . $foo_mysgli->mysql_error($result);
	
	$_SESSION["namesurname"] = $organiz;
	$_SESSION["city"] = $city;
	$_SESSION["tel"] = $tel;
	$_SESSION["email"] = $email;
	$_SESSION["valpass"] = $mypass;
	
	//print($mypass);
	echo <<<END
	$mypass
END;
}

if(isset($_POST["valpass"])){
	$valpass = substr($foo_mysgli->sanitizeMySQL(trim($_POST['valpass'])), 0, 32); 
	$query = "SELECT * FROM salclients WHERE pass='$valpass'";
	$result = $foo_mysgli->mysql_query($query);
	if(!$result) echo "Сбой при изменении данных salclients: $query <br />" . $foo_mysgli->mysql_error($result);
	$row = $foo_mysgli->mysql_fetch_row ($result);
	$reply = "Не правильно";	
	if($row[7] == $valpass){
		$reply = "Правильно";
		$assreply["organiz"] = $row[3];
		$assreply["city"] = $row[4];
		$assreply["tel"] = $row[5];
		$assreply["email"] = $row[6];
		$assreply["valpass"] = $row[7];
		$reply = json_encode($row, 256);
		$_SESSION["namesurname"] = $row[3];
		$_SESSION["city"] = $row[4];
		$_SESSION["tel"] = $row[5];
		$_SESSION["email"] = $row[6];
		$_SESSION["valpass"] = $row[7];
	}
	echo <<<END
			$reply
END;
}

//header('location:' . $_SERVER['PHP_SELF']);

?>