<?php
session_start();

require_once 'login.php';

echo <<<END
<head>
	<title>Пижамки</title>
	<link href="./m/elements/1419281141_363179.ico" rel="shortcut icon" type="image/x-icon" />
</head>
END;

$priceall = 0;

// если была нажата кнопка "Отправить"
if(isset($_POST['formsubmit']) && isset($_SESSION['idbasketsmall'])) { 
	if( $_POST['tel'] == '') { 
		$namesurname = substr($foo_mysgli->sanitizeMySQL(trim($_POST['namesurname'])), 0, 30); 
		$city =  substr($foo_mysgli->sanitizeMySQL(trim($_POST['city'])), 0, 30); 
		$tel =  substr($foo_mysgli->sanitizeMySQL(trim($_POST['tel'])), 0, 13); 
		$email =  substr($foo_mysgli->sanitizeMySQL(trim($_POST['email'])), 0, 30);
		$_SESSION["namesurname"] = $namesurname;
		$_SESSION["city"] = $city;
		$_SESSION["tel"] = $tel;	
		$_SESSION["email"] = $email;
		$dirbasbi1 = $dirbasbi . '?telques=1';
		header ("Location: $dirbasbi1");
		exit;
	}

	$idarr = $_SESSION["idbasketsmall"];
	$nid = $_SESSION["nid"];//колво товара
		
		foreach($idarr as $k=>$v){
			$id = $v;
			$query = "SELECT * FROM pajamas1 WHERE id='$id'";
				$result = $foo_mysgli->mysql_query($query);
				$row = $foo_mysgli->mysql_fetch_row($result);
				$title[$k] = $row[0];
				$price[$k] = $row[$val];
				$pricegoods[$k] = $price[$k]*$nid[$k];
				$priceall += $pricegoods[$k];
				
		}
		
        $namesurname = substr($foo_mysgli->sanitizeString(trim($_POST['namesurname'])), 0, 30); 
        $city =  substr($foo_mysgli->sanitizeMySQL(trim($_POST['city'])), 0, 30); 
		$tel =  substr($foo_mysgli->sanitizeMySQL(trim($_POST['tel'])), 0, 13); 
		$email =  substr($foo_mysgli->sanitizeMySQL(trim($_POST['email'])), 0, 30);
		
		//создание и запись покупок клиентов в базу данных
		//создать таблицу данных клиентов
		$query = "CREATE TABLE clients (orderclients MEDIUMINT AUTO_INCREMENT KEY,
										mycurdate CHAR(11), 
										mycurtime CHAR(8), 
										namesurname VARCHAR(128)  CHARACTER SET utf8 COLLATE utf8_unicode_ci, 
										city VARCHAR(30)  CHARACTER SET utf8 COLLATE utf8_unicode_ci, 
										tel VARCHAR(30), 
										email VARCHAR(30), 
										idorder MEDIUMINT, 
										idarr VARCHAR(128), 
										nid VARCHAR(128),
										buyprsite TINYINT(1)) ENGINE MyISAM";

		$result = $foo_mysgli->mysql_query($query);
		if($result){
			$query = "INSERT INTO clients VALUES (283758, CURDATE(), CURTIME(), 'Тестовая запись', 'City', 'Tel', 'email', NULL, 1, 1, 8)";
			$result = $foo_mysgli->mysql_query($query);			
		}
		
		$query = "CREATE TABLE buyclients (orderclients MEDIUMINT,
										title VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci, 
										price VARCHAR(7), 
										nid MEDIUMINT,
										prsite VARCHAR(10)  CHARACTER SET utf8 COLLATE utf8_unicode_ci,
										incr MEDIUMINT AUTO_INCREMENT KEY) ENGINE MyISAM";

		$result = $foo_mysgli->mysql_query($query);
		if($result){
			$query = "INSERT INTO buyclients VALUES (000000,  'Тестовая запись', 0, 0, 'грн розн', NULL)";
			$result = $foo_mysgli->mysql_query($query);			
		}
		
		$query = "SELECT idorder FROM clients ORDER BY idorder";
		$result = $foo_mysgli->mysql_query($query);
		$nrow = $foo_mysgli->mysql_num_rows($result);//лол-во элементов
		$nrow--;
		$idordermax = $foo_mysgli->mysql_result ($result, $nrow, "idorder");//последний элементо
		$idordermin = $foo_mysgli->mysql_result ($result, 1, "idorder");//первый элементо
		$idordermax++;
		$idimplode = implode (" ", $idarr);//массив в строку
		$nidimplode = implode (" ", $nid);//массив в строку

		if($nrow >= 200){
			//$idordermin = array_shift ($row);//первый элементо
			$query = "DELETE FROM clients WHERE idorder = '$idordermin'";
			$result = $foo_mysgli->mysql_query($query);
			if(!$result) die (" в таблице cliets не удален первый элемент 1");
		}
		
		$query = "INSERT INTO clients VALUES (NULL, CURDATE(), CURTIME(), '$namesurname', '$city', '$tel', '$email', '$idordermax', '$idimplode', '$nidimplode', '$val')";

		$result = $foo_mysgli->mysql_query($query);
		if(!$result) die (" в таблицу cliets не добавлена новая запись 2");
	
		$query = "SELECT orderclients FROM clients";
		$result =  $foo_mysgli->mysql_query($query);
		$nrow = $foo_mysgli->mysql_num_rows($result);//лол-во элементов
		$nrow--;
		$orderclientsmax = $foo_mysgli->mysql_result ($result, $nrow, "orderclients");//последний элементо;
		
		//запись в salclients orderclientsmax
		if(isset($_SESSION["valpass"])){
			$valpass = $_SESSION["valpass"];
			$query = "UPDATE salclients SET orderclients = '$orderclientsmax' WHERE pass='$valpass'";
			$result =  $foo_mysgli->mysql_query($query);
			if(!$result) die (" в таблицу salclients не добавлена orderclientsmax" . $foo_mysgli->mysql_error($result));
		}
		
		foreach($idarr as $k=>$v){
			//print_r("sk= " . $k . "sv= " . $v);
			$query = "INSERT INTO buyclients VALUES ('$orderclientsmax', '$title[$k]', '$price[$k]', '$nid[$k]', '$prsite', NULL)";

			$result = $foo_mysgli->mysql_query($query);
			if(!$result) die (" в таблицу buyclients не добавлена новая запись" . $foo_mysgli->mysql_error($result));
		}
		
		echo '<center style="font-size:25px; color:#669900;"><br>Спасибо! Заказ принят. В ближайшее время с вами свяжется наш менеджер</center>'; 
		echo "<center style='font-size:25px; color:#669900;'><br>Ваш номер заказа: <div style='font-size:35px; color:red;'> $orderclientsmax</div></center>";

		//session_start();
		$_SESSION["namesurname"] = $namesurname;
		$_SESSION["city"] = $city;
		$_SESSION["tel"] = $tel;
		$_SESSION["email"] = $email;
		
		//header ("Location: thanksframe.html?" .session_name().'='.session_id());
		header ("Location: $dirthan2?" .session_name().'='.session_id());
		//header ("Location: $dirthan2");
		exit;
} 
else{
	die ('Please click "back" ');
}


function destroy_session_and_data()
{
		//$_GET = array();
		//$_POST = array();
		unset($_GET, $_POST);
		$_SESSION = array();
		if (session_id() != "" || isset($_COOKIE[session_name()])){
		setcookie(session_name(), '', time() - 2592000, '/');
		}
		session_destroy();
}
?> 