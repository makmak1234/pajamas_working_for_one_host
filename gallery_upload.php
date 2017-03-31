<?php
require_once 'authenticate.php'; 
echo <<<END
<!DOCTYPE html>
<!-- saved from url=(0024)http://kidorable.com.ru/ -->
<html><head><meta content="text/html; charset=utf-8" http-equiv="Content-Type"><!--charset=utf-8-->
	<title>Пижамки</title>
<!--<meta name="robots" content="index, follow">
<meta name="keywords" content="1С-Битрикс, CMS, PHP, bitrix, система управления контентом">
<meta name="description" content="Детская одежда Kidorable — это яркие, стильные и удивительно ноские вещи, которые обязательно понравятся маленьким модникам и модницам, а также их родителям!"> -->

<!--<title>Загрузка</title>-->
<!--<link href="gallery_upload.css" type="text/css" rel="stylesheet">-->
<script language="javascript" type="text/javascript"  src="myscript/submit_forms.js">
</script>
<script language="javascript" type="text/javascript"  src="myscript/basketbigclear.js">
</script>
</head>
<!--<body>-->
END;

	
//создать таблицу контента сайта
		$query = "CREATE TABLE pajamas1 (title VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
										description VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci, 
										prsalu VARCHAR(7), 
										id INT(11) AUTO_INCREMENT KEY, 
										filename VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci, 
										isbn INT(11), 
										myorder INT(11),
										prsalr VARCHAR(7),
										prretu VARCHAR(7),
										prretr VARCHAR(7)) ENGINE MyISAM";
		
		//$query = "CREATE TABLE clients (orderclients MEDIUMINT AUTO_INCREMENT KEY, mycurdate MEDIUMINT) ENGINE MyISAM";
		$result = $foo_mysgli->mysql_query($query);
		//if(!$result)  die ("Сбой при создании pajamas1: " . mysql_error());


//else echo "Таблица анна не создана";
//}
$amendlogic = FALSE;
$beback = "";
$stbeback = "";
$sendtel = "";
$sendemail = "";
$amend = FALSE;
$removeus = FALSE;

//запись порядковых номеров
if(isset($_POST['recordnumber'])){
	foreach ($foo_mysgli->sanitizeMySQL($_POST['recordnumber']) as $k=>$v){
		$recordnamber = $foo_mysgli->sanitizeMySQL($_POST['recordnumber'][$k]);
		$id = $foo_mysgli->sanitizeMySQL($_POST['id'][$k]);
		$query = "UPDATE pajamas1 SET myorder = '$recordnamber' WHERE id='$id'";
		$result = $foo_mysgli->mysql_query($query);
		if ( !$result) die ("Сбой при доступе к базе данных запись порядковых номеров: " . $foo_mysgli->mysql_error());
	} 	
}

//замена большого и всех зуммированных маленьких
if(isset($_FILES['myfile']) && isset($_POST['amend'])) 
{
	$id = $foo_mysgli->sanitizeMySQL($_POST['id']);
//echo " id= $id";
	$query = "SELECT * FROM pajamas1 WHERE id='$id'";
	//$query = "SELECT * FROM pajamas1 WHERE id='$id'";
	$amendfile = $_FILES["myfile"]["name"][0];//новый файл
	$result = $foo_mysgli->mysql_query($query);
	$result1 = $foo_mysgli->mysql_result ( $result, 0, 'filename' );
	if ( !$result) die ("Сбой при доступе к базе данных замена большого и маленького: " . $foo_mysgli->mysql_error());
	//$row =  mysql_fetch_row($result);
//echo " sresult1 = $result1 ";
	//удаляем файл
	$myfile_name = "./m/gallery/" . $result1;//удаляемый файл большой
//echo " myfile_name = $myfile_name";
//echo " amendfile= $amendfile"; 
	if(!unlink("$myfile_name")) echo "Удаление невозможно";
	//удаляем файл 
	$myfile_name = "./m/gallery/thum_" .  $result1;//удаляемый файл маленький
	if(!unlink("$myfile_name")) echo "Удаление невозможно";
	//удаляем файл 
	$myfile_name = "./m/gallery/thum300_" .  $result1;//удаляемый файл большой моб
	if(!unlink("$myfile_name")) echo "Удаление невозможно";
	//удаляем файл 
	$myfile_name = "./m/gallery/thum100_" .  $result1;//удаляемый файл маленький моб
	if(!unlink("$myfile_name")) echo "Удаление невозможно";
	$amendlogic = TRUE;//логика в SFILES
}

//замена маленького
if(isset($_FILES['myfilesmall']) && ($_POST['amendsmall'])) 
{
		$myfile = $_FILES["myfilesmall"]["tmp_name"][0]; 
		$myfile_name = $_FILES["myfilesmall"]["name"][0]; 
		$myfile_size = $_FILES["myfilesmall"]["size"][0]; 
		$myfile_type = $_FILES["myfilesmall"]["type"][0]; 
		$error_flag = $_FILES["myfilesmall"]["error"][0]; 
		
		$amendsmall = $foo_mysgli->sanitizeMySQL($_POST['amendsmall']);

		// Если ошибок не было 
		if($error_flag == 0) 
		{			
			//Проверка расширений загружаемых изображений
			if($myfile_type == "image/gif" || $myfile_type == "image/png" || $myfile_type == "image/jpg" || $myfile_type == "image/jpeg")
			{
				//черный список типов файлов
				$blacklist = array(".php", ".phtml", ".php3", ".php4");
				foreach ($blacklist as $item)
				{
					if(preg_match("/$item\$/i", $myfile_name))
					{
						echo "Нельзя загружать скрипты.";
						exit;
					}
				}
				
				$filetype = $myfile_type;
				switch ($filetype)
				{
					case "image/gif":
						$ext = ".gif";
						$extnumb = 3;
						$funcreate = 'imagecreatefromgif';
						$funcimage = 'imagegif';
						break;
					case "image/png":
						$ext = ".png";
						$extnumb = 3;
						$funcreate = 'imagecreatefrompng';
						$funcimage = 'imagepng';
						break;
					case "image/jpg":
						$ext = ".jpg";
						$extnumb = 3;
						$funcreate = 'imagecreatefromjpeg';
						$funcimage = 'imagejpeg';
						break;
					case "image/jpeg":
						$ext = ".jpeg";
						$extnumb = 4;
						$funcreate = 'imagecreatefromjpeg';
						$funcimage = 'imagejpeg';
						break;
				}
	
				$id = $foo_mysgli->sanitizeMySQL($_POST['id']);
			//echo " id= $id";
				$query = "SELECT * FROM pajamas1 WHERE id='$id'";
				//$query = "SELECT * FROM pajamas1 WHERE id='$id'";
				//$amendfile = $_FILES["myfilesmall"]["name"][0];//новый файл
				$result = $foo_mysgli->mysql_query($query);
				$result1 = $foo_mysgli->mysql_result ( $result, 0, 'filename' );
				if ( !$result) die ("Сбой при доступе к базе данных замена маленького: " . $foo_mysgli->mysql_error());

	
				$myfile_dell = "./m/gallery/" . $amendsmall ."_" .  $result1;//удаляемый файл маленький
			
				//удаляем файл 
				if(!unlink("$myfile_dell")) die ("Удаление невозможно");
	
				
				// копируем
			
				copy($myfile, $myfile_dell);
			}	
		}		
}

// Если upload файла 
if(isset($_FILES["myfile"])) 
{

	foreach ($_FILES["myfile"]["name"] as $k=>$v)
	{ 
		$myfile = $_FILES["myfile"]["tmp_name"][$k]; 
		$myfile_name = $_FILES["myfile"]["name"][$k]; 
		$myfile_size = $_FILES["myfile"]["size"][$k]; 
		$myfile_type = $_FILES["myfile"]["type"][$k]; 
		$error_flag = $_FILES["myfile"]["error"][$k]; 

		// Если ошибок не было 
		if($error_flag == 0) 
		{			
			//Проверка расширений загружаемых изображений
			if($_FILES['myfile']['type'][$k] == "image/gif" || $_FILES['myfile']['type'][$k] == "image/png" || $_FILES['myfile']['type'][$k] == "image/jpg" || $_FILES['myfile']['type'][$k] == "image/jpeg")
			{
				//черный список типов файлов
				$blacklist = array(".php", ".phtml", ".php3", ".php4");
				foreach ($blacklist as $item)
				{
					if(preg_match("/$item\$/i", $_FILES['myfile']['name'][$k]))
					{
						die ("Нельзя загружать скрипты.");
						exit;
					}
				}
				
				$filetype = $_FILES["myfile"]["type"][$k];
				switch ($filetype)
				{
					case "image/gif":
						$ext = ".gif";
						$extnumb = 3;
						$funcreate = 'imagecreatefromgif';
						$funcimage = 'imagegif';
						break;
					case "image/png":
						$ext = ".png";
						$extnumb = 3;
						$funcreate = 'imagecreatefrompng';
						$funcimage = 'imagepng';
						break;
					case "image/jpg":
						$ext = ".jpg";
						$extnumb = 3;
						$funcreate = 'imagecreatefromjpeg';
						$funcimage = 'imagejpeg';
						break;
					case "image/jpeg":
						$ext = ".jpeg";
						$extnumb = 4;
						$funcreate = 'imagecreatefromjpeg';
						$funcimage = 'imagejpeg';
						break;
				}
			
				$dir = './m/gallery/thum_';
				$tm = time() . rand(10,100);
				$myfile_fit = substr_replace($myfile_name, "", (strlen($myfile_name) - $extnumb));
				$f_thum = $dir . basename($myfile_fit) . $tm . $ext;

				// если размер файла больше 512 Кб
				if ($myfile_size > 512*1024) die('Размер файла больше 512 Кб! Уменьшите файл и повторите попытку');

				// копируем
				$dir = './m/gallery/';
				$databasename = basename($myfile_fit) . $tm . $ext;
				$upfile_name = $dir . basename($myfile_fit) . $tm . $ext;
				copy($myfile, $upfile_name);
				//echo "<img src='$upfile_name' style='float:left; width:220px; height:220px'/>";

				// создаем миниатюру размером 65x65, качество JPEG 75
				imageresize($f_thum,$upfile_name,65,65,0,$funcreate,$funcimage);
				
				// создаем миниатюру размером 300x300, качество JPEG 75
				$dir = './m/gallery/thum300_';
				$f_thum = $dir . basename($myfile_fit) . $tm . $ext;
				imageresize($f_thum,$upfile_name,300,300,0,$funcreate,$funcimage);
				
				// создаем миниатюру размером 100x100, качество JPEG 75
				$dir = './m/gallery/thum100_';
				$f_thum = $dir . basename($myfile_fit) . $tm . $ext;
				imageresize($f_thum,$upfile_name,100,100,0,$funcreate,$funcimage);
				
				//пишем в базу данных
				if(!$amendlogic){
					$query = "INSERT INTO pajamas1 VALUES (NULL , NULL , NULL , NULL , '$databasename' , NULL, '99', NULL, NULL, NULL)";
				}
				else{
					$query = "UPDATE pajamas1 SET filename = '$databasename' WHERE id='$id'";
					$amendlogic = FALSE;
				}
				
				$result = $foo_mysgli->mysql_query($query);
				if ( !$result) die ("Сбой при доступе к базе данных Если upload файла: " . $foo_mysgli->mysql_error($result));
			}
			else
			{
				die ("<center><br>Можно загружать только изображения в форматах jpg, jpeg, gif и png.</center>");
			}
		}
	}
	header ("Location: $dirgaupl");
	//header("$dirgaupl");
 //unset($_FILES);
}
//unset($_FILES);

//внесение одного title, price, description
if(isset($_POST['title']) || isset($_POST['prretu']) || isset($_POST['description']))
{
	$title = $foo_mysgli->sanitizeMySQL($_POST['title']);
	//$price = $foo_mysgli->sanitizeMySQL($_POST['price']);
	$prretu = $foo_mysgli->sanitizeMySQL($_POST['prretu']);
	$prretr = $foo_mysgli->sanitizeMySQL($_POST['prretr']);
	$prsalu = $foo_mysgli->sanitizeMySQL($_POST['prsalu']);
	$prsalr = $foo_mysgli->sanitizeMySQL($_POST['prsalr']);
	$description = $foo_mysgli->sanitizeMySQL($_POST['description']);
	$id = $foo_mysgli->sanitizeMySQL($_POST['id']);
	$query = "UPDATE pajamas1 SET title='$title', prretu='$prretu', prretr='$prretr', prsalu='$prsalu', prsalr='$prsalr', description='$description' WHERE id='$id'";
	$result = $foo_mysgli->mysql_query($query);
	if(!$result) echo "Сбой при изменении данных: $query <br />" . $foo_mysgli->mysql_error . "<br /><br />";
}

//внесение всех title, price, description
if(isset($_POST['alltitle']) || isset($_POST['alldescr']))
{
	$allid = ($_POST['allid']);
	$alltitle = ($_POST['alltitle']);
	//$allprice = ($_POST['allprice']);
	$allprretu = ($_POST['allprretu']);
	$allprretr = ($_POST['allprretr']);
	$allprsalu = ($_POST['allprsalu']);
	$allprsalr = ($_POST['allprsalr']);
	$alldescr = ($_POST['alldescr']);
	
	$add = "*$#";
	$allid = explode($add, $allid);
	$alltitle = explode($add, $alltitle);
	//$allprice = explode($add, $allprice);
	$allprretu = explode($add, $allprretu);
	$allprretr = explode($add, $allprretr);
	$allprsalu = explode($add, $allprsalu);
	$allprsalr = explode($add, $allprsalr);
	$alldescr = explode($add, $alldescr);
	
//echo "allid= " . $allid;
	$rows = count($allid);
//echo "  Srows=" . $rows;
	for($i = 0; $i <= $rows-1; $i++){
		$id = $foo_mysgli->sanitizeMySQL($allid[$i]);
		$title = $foo_mysgli->sanitizeMySQL($alltitle[$i]);
		//$price = $foo_mysgli->sanitizeMySQL($allprice[$i]);
		$prretu = $foo_mysgli->sanitizeMySQL($allprretu[$i]);
		$prretr = $foo_mysgli->sanitizeMySQL($allprretr[$i]);
		$prsalu = $foo_mysgli->sanitizeMySQL($allprsalu[$i]);
		$prsalr = $foo_mysgli->sanitizeMySQL($allprsalr[$i]);
		$description = $foo_mysgli->sanitizeMySQL($alldescr[$i]);
//echo " " . $i . "title= " . $title . "  Srows=" . $rows;
		
		$query = "UPDATE pajamas1 SET title='$title', prretu='$prretu', prretr='$prretr', prsalu='$prsalu', prsalr='$prsalr', description='$description' WHERE id='$id'";
		$result = $foo_mysgli->mysql_query($query);
		if(!$result) echo "Сбой при изменении данных: $query <br />" . $foo_mysgli->mysql_error . "<br /><br />";
	}
}

//удалить один
if(isset($_POST['delete']) && isset($_POST['id']))
{
	$id = $foo_mysgli->sanitizeMySQL($_POST['id']);
	$query = "SELECT * FROM pajamas1 WHERE id='$id'";
	$result = $foo_mysgli->mysql_query($query);
	$result1 = $foo_mysgli->mysql_result ( $result, 0, 'filename' );
	if ( !$result) die ("Сбой при доступе к базе данных удалении: " . $foo_mysgli->mysql_error());
	//удаляем файл
	$myfile_name = "./m/gallery/" . $result1;//удаляемый файл большой 
	if(!unlink("$myfile_name")) echo "Удаление невозможно";
	//удаляем файл 
	$myfile_name = "./m/gallery/thum_" .  $result1;//удаляемый файл маленький
	if(!unlink("$myfile_name")) echo "Удаление невозможно";
	//удаляем файл 
	$myfile_name = "./m/gallery/thum300_" .  $result1;//удаляемый файл большой моб
	if(!unlink("$myfile_name")) echo "Удаление невозможно";
	//удаляем файл 
	$myfile_name = "./m/gallery/thum100_" .  $result1;//удаляемый файл маленький моб
	if(!unlink("$myfile_name")) echo "Удаление невозможно";
	$query = "DELETE FROM pajamas1 WHERE id='$id'";
	$result = $foo_mysgli->mysql_query($query);
	if(!$result) echo "Сбой при удалении данных: $query <br />" . $foo_mysgli->mysql_error . "<br /><br />";
}

//удаление выбранных
if(isset($_POST['iddbdell']))
{
	$iddbdell = $_POST['iddbdell'];
echo "iddbdell= " . $iddbdell;
	$iddbdell = explode(",", $iddbdell);
	$rows = count($iddbdell);
echo " rows= " . $rows;
	for($i = 0; $i <= $rows-1; $i++){
		$id = $foo_mysgli->sanitizeMySQL($iddbdell[$i]);
		$query = "SELECT * FROM pajamas1 WHERE id='$id'";
		$result = $foo_mysgli->mysql_query($query);
		$result1 = $foo_mysgli->mysql_result ( $result, 0, 'filename' );
		if ( !$result) die ("Сбой при доступе к базе данных удалении: " . $foo_mysgli->mysql_error());
		//удаляем файл
		$myfile_name = "./m/gallery/" . $result1;//удаляемый файл большой 
		if(!unlink("$myfile_name")) echo "Удаление невозможно";
		//удаляем файл 
		$myfile_name = "./m/gallery/thum_" .  $result1;//удаляемый файл маленький
		if(!unlink("$myfile_name")) echo "Удаление невозможно";
		//удаляем файл
		$myfile_name = "./m/gallery/thum300_" . $result1;//удаляемый файл большой моб 
		if(!unlink("$myfile_name")) echo "Удаление невозможно";
		//удаляем файл 
		$myfile_name = "./m/gallery/thum100_" .  $result1;//удаляемый файл маленький моб
		if(!unlink("$myfile_name")) echo "Удаление невозможно";
		$query = "DELETE FROM pajamas1 WHERE id='$id'";
		$result = $foo_mysgli->mysql_query($query);
		if(!$result) echo "Сбой при удалении данных: $query <br />" . $foo_mysgli->mysql_error . "<br /><br />";
	}
}

//если смена телефона email
if ((isset($_POST["name"]) && isset($_POST["name1"])) && (isset($_POST["tel"]) || isset($_POST["email"]) || isset($_POST["sendtel"]) || isset($_POST["sendemail"]) ))
{
	//echo " Форма изм тел и email передана";
	$tmpname = $foo_mysgli->sanitizeMySQL($_POST["name"]);
	$tmpname1 = $foo_mysgli->sanitizeMySQL($_POST["name1"]);
	$name = $tmpname;//sha1($salt1 . $tmpname . $salt2);
	$name1 = sha1($salt1 . $tmpname1 . $salt2);
	$tel = $foo_mysgli->sanitizeMySQL($_POST["tel"]);
	$email = $foo_mysgli->sanitizeMySQL($_POST["email"]);
	$iduser = $foo_mysgli->sanitizeMySQL($_POST["iduser"]);
	$api_id = $foo_mysgli->sanitizeMySQL($_POST["api_id"]);
	
	if(isset($_POST["sendtel"]))$sendtel = $foo_mysgli->sanitizeMySQL($_POST["sendtel"]);
	if(isset($_POST["sendemail"]))$sendemail = $foo_mysgli->sanitizeMySQL($_POST["sendemail"]);
	$query = "SELECT * FROM anna WHERE iduser='$iduser'";
	$result = $foo_mysgli->mysql_query($query);
	$row = $foo_mysgli->mysql_fetch_row($result);
	if(($name == $row[0] && $name1 == $row[1]) || ($name == $nameadmin && $name1 == $nameadmin1))
	{
	
		$query = "UPDATE anna SET tel='$tel', email='$email', sendtel='$sendtel', sendemail='$sendemail',  api_id='$api_id' WHERE iduser='$iduser'"; //WHERE name1='$name1' OR name1='$nameadmin1'
		
		$result = $foo_mysgli->mysql_query($query);
		if(!$result) echo " Сбой при измен данных тел email:"  . $foo_mysgli->mysql_error();
	}
}

//если смена логина и пароля или удаление пользователя
if ((isset($_POST["old_name"]) || isset($_POST["old_name1"])) && (isset($_POST["new_name"]) || (isset($_POST["new_name1"]) && isset($_POST["new_name2"]))))
{
	//echo " Форма изм логина и пароля передана";
	$tmpoldnm = $foo_mysgli->sanitizeMySQL($_POST["old_name"]);
	$tmpoldnm1 = $foo_mysgli->sanitizeMySQL($_POST["old_name1"]);
	$tmpnewnm = $foo_mysgli->sanitizeMySQL($_POST["new_name"]);
	$tmpnewnm1 = $foo_mysgli->sanitizeMySQL($_POST["new_name1"]);
	$tmpnewnm2 = $foo_mysgli->sanitizeMySQL($_POST["new_name2"]);
	$iduser = $foo_mysgli->sanitizeMySQL($_POST["iduser"]);
	if(isset($_POST["amend"]))$amend = TRUE;
	if(isset($_POST["removeus"]))$removeus = TRUE;
	$old_name = $tmpoldnm;//sha1($salt1 . $tmpoldnm . $salt2);
	$old_name1 = sha1($salt1 . $tmpoldnm1 . $salt2);
	$new_name = $tmpnewnm;//sha1($salt1 . $tmpnewnm . $salt2);
	$new_name1 = sha1($salt1 . $tmpnewnm1 . $salt2);
	$new_name2 = sha1($salt1 . $tmpnewnm2 . $salt2);
	$query = "SELECT * FROM anna WHERE iduser='$iduser'";
	$result = $foo_mysgli->mysql_query($query);
	$row = $foo_mysgli->mysql_fetch_row($result);
	if(($old_name == $row[0] && $old_name1 == $row[1]) || ($old_name == $nameadmin && $old_name1 == $nameadmin1))
	{
		if($amend){
			if($new_name1 == $new_name2)
			{		
				$query = "UPDATE anna SET name='$new_name', name1='$new_name1' WHERE iduser='$iduser'";
				$result = $foo_mysgli->mysql_query($query);
				if(!$result) echo " Сбой при измен login password:  . mysql_error()";
				if($result)
				{
					$beback = " Логин и пароль изменен";
					$stbeback = "font: bold; color: green;";
				}
			}
			else
			{ 
				$beback = " Новый пароль несовпадает";
				$stbeback = "color: red;";
			}
		}
		
		if($removeus){
				//echo " stel=$tel email=$email name1=$name1  name1=$nameadmin1 ";
			
				$query = "DELETE FROM anna WHERE iduser='$iduser'";
				$result = $foo_mysgli->mysql_query($query);
				if(!$result) echo " Сбой при удал login password:"  . $foo_mysgli->mysql_error();
				if($result)
				{
					$beback = " Логин и пароль удален";
					$stbeback = "font: bold; color: green;";
				}
				else
				{ 
					$beback = " Сбой при удал пользователя";
					$stbeback = "color: red;";
				}
		}
		
	}
	else
	{
		$beback = " Логин или пароль неверный";
		$stbeback = "color: red;";
	}
}

//если добавление пользователя
if ((isset($_POST["admin_name"]) || isset($_POST["admin_name1"])) && (isset($_POST["newus_name"]) || (isset($_POST["newus_name1"]) && isset($_POST["newus_name2"]))))
{
	$tmpadmnm = $foo_mysgli->sanitizeMySQL($_POST["admin_name"]);
	$tmpadmnm1 = $foo_mysgli->sanitizeMySQL($_POST["admin_name1"]);
	$tmpnewus = $foo_mysgli->sanitizeMySQL($_POST["newus_name"]);
	$tmpnewus1 = $foo_mysgli->sanitizeMySQL($_POST["newus_name1"]);
	$tmpnewus2 = $foo_mysgli->sanitizeMySQL($_POST["newus_name2"]);

	$admin_name = $tmpadmnm;//sha1($salt1 . $tmpadmnm . $salt2);
	$admin_name1 = sha1($salt1 . $tmpadmnm1 . $salt2);
	$newus_name = $tmpnewus;//sha1($salt1 . $tmpnewus . $salt2);
	$newus_name1 = sha1($salt1 . $tmpnewus1 . $salt2);
	$newus_name2 = sha1($salt1 . $tmpnewus2 . $salt2);
	$query = "SELECT * FROM anna";
	$result = $foo_mysgli->mysql_query($query);
	$row = $foo_mysgli->mysql_fetch_row($result);
	if(($admin_name == $row[0] && $admin_name1 == $row[1]) || ($admin_name == $nameadmin && $admin_name1 == $nameadmin1))
	{
			if($newus_name1 == $newus_name2)
			{
				//echo " stel=$tel email=$email name1=$name1  name1=$nameadmin1 ";
			
				$query = "INSERT INTO anna VALUES('$newus_name', '$newus_name1', NULL, NULL, NULL, NULL, NULL, NULL)";
				$result = $foo_mysgli->mysql_query($query);
				if(!$result) echo " Сбой при добавлении пользователя:"  . $foo_mysgli->mysql_error();
				if($result)
				{
					$beback = " Пользователь добавлен";
					$stbeback = "font: bold; color: green;";
				}
			}
			else
			{ 
				$beback = " Новый пароль несовпадает";
				$stbeback = "color: red;";
			}
	}
	else
	{
		$beback = " Логин или пароль неверный";
		$stbeback = "color: red;";
	}
}

if(($_POST || $_GET)){
	$repost = "?repost=1";
	if(isset($_GET["repost"])){
		header ("Location: $dirgaupl");
		exit;
	}
	$dirgaupl1 = $dirgaupl . $repost;
	header ("Location: $dirgaupl1");
}

//вывод стат карусели
$query = "SELECT * FROM pajamas1 ORDER BY myorder";
$result = $foo_mysgli->mysql_query($query);
if ( !$result) die ("Сбой при доступе к базе данных вывод стат карусели: " . $foo_mysgli->mysql_error());
$rows = $foo_mysgli->mysql_num_rows($result);

echo<<<END
<div class="mycont">
	<a href="$dirpajs"> Вернуться в магазин</a>
	<div class="headercarousel">Порядок вывода</div>
	<div class="carouselstatic">
	<form action="$dirgaupl" method="POST" id="record_carousel">
END;
	for ($i = 1; $i <= $rows; $i++)
	{
		$row = $foo_mysgli->mysql_fetch_row($result);//текущая строка таблиц
		$images = "./m/gallery/" . $row[4];//путь к большому изображ
		echo<<<END
			<div class="recordcarousel">
				<div class="imagescarousel"><img src="$images"></div>
					<input type="hidden" name="id[$i]" value="$row[3]" />	
					<b>порядок: </b><input type="number" min="0" max="99" name="recordnumber[$i]" value="$row[6]">
			</div>
END;
	}
echo<<<END
	</form>
	<input class='submitcarousel' type='submit' value='Применить порядок' form='record_carousel'></br>
	</div></br>
	<div class='space'> </div>
</div>
END;

// общая информация-------------------------------------------
class geninf{
	protected $foo_mysgli;
	public $result;
	public $rows;
	function __construct($foo_mysgli){
		$this->foo_mysgli = $foo_mysgli;
		$this->result;
		$this->rows;
	}
	public function dbsquery($query){
		$this->result = $this->foo_mysgli->mysql_query($query);
		if ( !$this->result) die ("Сбой при доступе к базе общая информация: " . $this->foo_mysgli->mysql_error($this->result));
		$this->rows = $this->foo_mysgli->mysql_num_rows($this->result);
		return array($this->result, $this->rows);
	}
	public function mygeninf(){
		$query = "SELECT * FROM pajset";
		$this->dbsquery($query);
		$row =  $this->foo_mysgli->mysql_fetch_row($this->result);//текущая строка таблиц
		//print_r("geninf rows= " . $this->rows);
		if($row[2] == 1) $exchrtus = "checked";
		else $exchrtus = "";
		if($row[3] == 1) $factorus = "checked";
		else $factorus = "";
		
		$prsalu = "";
		$prsalr = "";
		$prretu = "";
		$prretr = "";
		if($row[4] == 2)$prsalu = "checked";
		if($row[4] == 7)$prsalr = "checked";
		if($row[4] == 8)$prretu = "checked";
		if($row[4] == 9)$prretr = "checked";
		
		echo <<<END
		<div class="headercarousel">Общие настройки</div>
		<div class="geninf">
			<div class="prsite">
				Цена на сайте <input type="radio" name="prsite" $prretu="" onchange="exchrt(8, 'prsite')"/>грн розн
							<input type="radio" name="prsite" $prretr="" onchange="exchrt(9, 'prsite')" />руб розн
							<input type="radio" name="prsite" $prsalu="" onchange="exchrt(2, 'prsite')"/>грн опт
							<input type="radio" name="prsite" $prsalr="" onchange="exchrt(7, 'prsite')" />руб опт
			</div>
			<div class="exchrtus">
				<input type="checkbox" name="exchrtus" $exchrtus="" onchange="exchrt(this.checked, 'exchrtus')" /> Использовать курс руб/грн <input type="number" min="1.0" max="99.9" step="0.1" name="exchrt" value="$row[0]" onchange="exchrt(this.value, 'exchrt')"/>
			</div>
			<div class="factor">
				<input type="checkbox" name="factorus" $factorus="" onchange="exchrt(this.checked, 'factorus')" /> Использовать курс розница/опт <input type="number" min="1.00" max="9.99" step="0.01" name="factor" value="$row[1]" onchange="exchrt(this.value, 'factor')"/>
			</div>
<div id="elem"></div>
		</div>
END;
	}
		// 1-грн 2-руб 3-exchrtus(использ курса руб/грн) 4-exchrt(коэф курса руб/грн) 5-factorus(использ коэф розн/опт) 6-factor(коэф розн/опт)
}

$geninf = new geninf($foo_mysgli);
$geninf->mygeninf();

// выводим форму--------------------------------------------------------------------------------------
class formrec{
	protected $foo_mysgli;
	protected $geninf;
	public $rowsrec;
	function __construct($foo_mysgli){
		$this->foo_mysgli = $foo_mysgli;
		$this->geninf = new geninf($foo_mysgli);
	}
	
	function myformrec(){
		$myconst = new myconst;
		//$myconst->myconst1();
		$dirgaupl = $myconst->dirgaupl;
	$query = "SELECT * FROM pajamas1 ORDER BY myorder";
	$this->geninf->dbsquery($query);
	$result = $this->geninf->result;
	//$result = $foo_mysgli->mysql_query($query);
	//if ( !$result) die ("Сбой при доступе к базе данных выводим форму: " . $foo_mysgli->mysql_error());
	$rows = $this->geninf->rows;
	//$rows = $foo_mysgli->mysql_num_rows($result);
	$this->rowsrec = $rows;
	
	echo <<<END
	</br></br>
	<script>myswitch = true</script>
	<input id="allmark" type="button" value="Выделить всё" onclick='submit_mark($rows)' />
	<div class="headerrecord">Созданные записи</div>
END;
	for($i = 0; $i <= $rows-1; $i++) //$rows
	{
		$row =  $this->foo_mysgli->mysql_fetch_row($result);//текущая строка таблиц
		$images = "./m/gallery/" . $row[4];//путь к большому изображению товара
		$images_thum = "./m/gallery/thum_" . $row[4];//путь к маленькому изображению товара
		$images_thum300 = "./m/gallery/thum300_" . $row[4];//путь к большому изображению товара моб
		$images_thum100 = "./m/gallery/thum100_" . $row[4];//путь к маленькому изображению товара моб
		$iddell = "dell" . $i;
		$idid = "id" . $i;
		$idsubmit = "submit" . $i;
		$idtitle = "title" . $i;
			//$idprice = "price" . $i;
		$idprru = "idprru" . $i; //розн грн
		$idprrr = "idprrr" . $i; //розн руб
		$idprsu = "idprsu" . $i; //опт грн
		$idprsr = "idprsr" . $i; //опт руб
		$iddescr = "descr" . $i;
		echo <<<END
			<div class="record">
				<input form="deleteform" class="delinp" type="checkbox" id="$iddell" />
				
				<div class="recdstop">
					<form ENCTYPE="multipart/form-data" action="$dirgaupl" method="POST">
						<input type="hidden" name="amend" value="yes" />
						<input type="hidden" name="id" value="$row[3]" />
						<label class="bigimage" title="Кликни для замены большого и всех маленьких"><INPUT class="inputexch" NAME="myfile[]" TYPE="file" onchange="submit()" ><img src="$images"  alt="">~400x400 px</label>
					</form>
				
					<form ENCTYPE="multipart/form-data" action="$dirgaupl" method="POST">
						<input type="hidden" name="amendsmall" value="thum" />
						<input type="hidden" name="id" value="$row[3]" />
						<div class="smallimage"><label class="smallimagelabel" title="Кликни для замены маленького"><INPUT class="inputexch" NAME="myfilesmall[]" TYPE="file" onchange="submit()" ><img src="$images_thum" alt=""></br></br>~65x65px</label></div>
					</form>
					<div class="recdstoptx">Для полного сайта</div>
				</div>
				
				<div class="recmob">
					<form ENCTYPE="multipart/form-data" action="$dirgaupl" method="POST">
						<input type="hidden" name="amendsmall" value="thum300" />
						<input type="hidden" name="id" value="$row[3]" />
						<label class="bigimagem" title="Кликни для замены большого "><INPUT class="inputexch" NAME="myfilesmall[]" TYPE="file" onchange="submit()" ><img src="$images_thum300"  alt="">~300x300 px</label>
					</form>
				
					<form ENCTYPE="multipart/form-data" action="$dirgaupl" method="POST">
						<input type="hidden" name="amendsmall" value="thum100" />
						<input type="hidden" name="id" value="$row[3]" />
						<div class="smallimagem"><label class="smallimagelabelm" title="Кликни для замены маленького"><INPUT class="inputexch" NAME="myfilesmall[]" TYPE="file" onchange="submit()" ><img src="$images_thum100" alt=""></br></br>~100x100px</label></div>
					</form>
					<div class="recdstoptx">Для мобильного сайта</div>
				</div>
				
			
				<form class="info" action="$dirgaupl" method="POST">
					<input id="$idid" type="hidden" name="id" value="$row[3]" /><br />
					<table class="infotable">
						<tr>
							<td><b>Название: </b></td>
							<td><input id="$idtitle" type="text" name="title" value="$row[0]" autocomplete="off" /></td>
						</tr>
						<tr>
							<td><b>Цена грн розн: </b></td>
							<td><input id="$idprru" type="text" name="prretu" value="$row[8]" autocomplete="off" onchange="price1(this.value, this.name, $i)" /></td>
						</tr>
						<tr>
							<td><b>Цена руб розн: </b></td>
							<td><input id="$idprrr" type="text" name="prretr" value="$row[9]" autocomplete="off" onchange="price1(this.value, this.name, $i)" /></td>
						</tr>
						<tr>
							<td><b>Цена грн опт: </b></td>
							<td><input id="$idprsu" type="text" name="prsalu" value="$row[2]" autocomplete="off" onchange="price1(this.value, this.name, $i)" /></td>
						</tr>
						<tr>
							<td><b>Цена руб опт: </b></td>
							<td><input id="$idprsr" type="text" name="prsalr" value="$row[7]" autocomplete="off" onchange="price1(this.value, this.name, $i)" /></td>
						</tr>
						<tr>
							<td><b>Описание: </b></td>
							<td><textarea id="$iddescr" cols="30" rows="5" name="description">$row[1]</textarea></td>	
						</tr>
							<td></td>
							<td><input id="$idsubmit" class="apply" type="submit" value="Применить"  /> Применить для всех - внизу </td>
					</table>
				</form>

				<form id="deleteform" action="$dirgaupl" method="POST" class="delete" >
					<input type="hidden" name="delete" value="yes" />
					<input type="hidden" name="id" value="$row[3]" />
					<!--<input type="checkbox" id="$iddell" />выделить</br></br>--><!--, id в БД = $row[3]-->
					<button type="submit">Удалить запись</button>
				</form>
				
			</div>
END;
	}
	}
}

$formrec = new formrec($foo_mysgli);
$formrec->myformrec();


//вывод формы применить все, добавить запись, замена телефона email-------------------------------------------------------------------------------------------
	//$formrec = new formrec($foo_mysgli);
	$rowsrec = $formrec->rowsrec;
	$query = "SELECT * FROM anna";
	$result = $foo_mysgli->mysql_query($query);
	if ( !$result) die ("Сбой при доступе к базе данных anna: " . $foo_mysgli->mysql_error());
	$rows = $foo_mysgli->mysql_num_rows($result);
	
	echo <<<END
	</br>
	<div id="divid"></div>
	<form name="allsubmit" method="POST" action="$dirgaupl">
		<input id="allid" type="hidden" name="allid" multiple="true" />
		<input id="alltitle" type="hidden" name="alltitle" multiple="true" />
		<!--<input id="allprice" type="hidden" name="allprice" multiple="true" />-->
		<input id="allprretu" type="hidden" name="allprretu" multiple="true" />
		<input id="allprretr" type="hidden" name="allprretr" multiple="true" />
		<input id="allprsalu" type="hidden" name="allprsalu" multiple="true" />
		<input id="allprsalr" type="hidden" name="allprsalr" multiple="true" />
		<input id="alldescr" type="hidden" name="alldescr" multiple="true" />
	</form>
	<form name="seldell" method="POST" action="$dirgaupl">
		<input id="iddbdell" type="hidden" name="iddbdell" multiple="true" />
	</form>
	<button onclick="submit_dell($rowsrec)">Удалить выделенные</button>
	<input class="allapply" type="button" value="Применить все" onclick="submit_forms($rowsrec)" /></br></br>
	
	<div class="newform">
		<FORM ENCTYPE="multipart/form-data" ACTION="$dirgaupl" METHOD="POST"> 
			Добавить новые картинки:<INPUT NAME="myfile[]" TYPE="file" multiple="true" onchange="submit()" value="Добавить новые картинки">  
		</FORM>
	</div>
	</br></br>
	
END;
		for($i = 0; $i <= $rows-1; $i++){
			$row =  $foo_mysgli->mysql_fetch_row($result);//текущая строка таблиц
			if($row[0] != $nameadmin) $name = $row[0];
			else $name = "";
			$name1 = $row[1];
			$tel = $row[2];
			$email = $row[3];
			$sendtel = $row[4];
			$sendemail = $row[5];
			$api_id = $row[6];
			if($sendtel == 1) $checktel = "checked";
			else $checktel = "";
			if($sendemail == 1) $checkemail = "checked";
			else $checkemail = "";
			if($i == 0){
				$tremove = "hidden";
				$nremove = "";
			}
			else{
				$tremove = "submit";
				$nremove = "removeus";
			}
		
		echo <<<END
		<div class="formtelemail">
		<div class="administrator">Смена телефона email</div><br/>
		<form action="$dirgaupl" method="POST">		
			<table class="admintable" cellspacing="7">
				<tr>
					<td>Логин существующий</td>
					<td><input type="text" name="name" value="$name" maxlength=30 autocomplete="off" required /></td>
				</tr>
				<tr>
					<td>Пароль существующий</td>
					<td><input type="password" name="name1" value="" maxlength=30 autocomplete="off" required /></td>
				</tr>
				<tr>
					<td>Моб телефон для СМС </td>
					<td><input type="tel" name="tel" value="$tel" maxlength=30 /><input type="checkbox" name="sendtel" value="1" $checktel="" />отправка СМС</td>
				</tr>
				<tr>
					<td>код для sms.ru </td>
					<td><input type="text" name="api_id" value="$api_id" maxlength=36 /></td>
				</tr>
				<tr>
					<td>email для заказов</td>
					<td><input type="email" name="email" value="$email" maxlength=30 /><input type="checkbox" name="sendemail" value="1" $checkemail="" />отправка email</td>
				</tr>
				<tr>
					<td><input type="submit" name="amend" value="Изменить" /><input type="hidden" name="iduser" value="$row[7]" /></td>
					<td><td/>
				</tr>
			</table>
		</form>
	</div>
	
	<div class="adminpassword">Смена логина и пароля </div><div class="stbeback" style="$stbeback"> $beback</div><br/>

		<form action="$dirgaupl" method="POST">		
			<table class="admintable" cellspacing="7">
				<tr>
					<td>Логин существующий</td>
					<td><input type="text" name="old_name" value="$name" maxlength=30 autocomplete="off"  required /></td>
				</tr>
				<tr>
					<td>Пароль существующий</td>
					<td><input type="password" name="old_name1" value="" maxlength=30 autocomplete="off" required /></td>
				</tr>
				<tr>
					<td>Логин новый</td>
					<td><input type="text" name="new_name" value="" maxlength=30 autocomplete="off" required /></td>
				</tr>
				<tr>
					<td>Пароль новый</td>
					<td><input type="password" name="new_name1" value="" maxlength=30 autocomplete="off" required /></td>
				</tr>
				<tr>
					<td>Пароль новый подтвержд</td>
					<td><input type="password" name="new_name2" value="" maxlength=30 autocomplete="off" required /></td>
				</tr>
				<tr>
					<td><input type="$tremove" name="$nremove" value="Удалить" /><input type="hidden" name="iduser" value="$row[7]" /></td>
					<td><input type="submit" name="amend" value="Изменить" /></td>
				</tr>
			</table>
		</form>
		</br></br>
END;
		}
		//$dirgaupl1 = $dirgaupl . "?add=1";
		echo <<<END
		</br>
		<div class="administrator">Добавить пользователя</div><br/>
		<div class="adduser">		
			<form action="$dirgaupl" method="POST">		
			<table class="admintable" cellspacing="7">
				<tr>
					<td>Логин админа</td>
					<td><input type="text" name="admin_name" value="" maxlength=30 autocomplete="off"  required /></td>
				</tr>
				<tr>
					<td>Пароль админа</td>
					<td><input type="password" name="admin_name1" value="" maxlength=30 autocomplete="off" required /></td>
				</tr>
				<tr>
					<td>Логин пользователя</td>
					<td><input type="text" name="newus_name" value="" maxlength=30 autocomplete="off" required /></td>
				</tr>
				<tr>
					<td>Пароль пользователя</td>
					<td><input type="password" name="newus_name1" value="" maxlength=30 autocomplete="off" required /></td>
				</tr>
				<tr>
					<td>Пароль пользов подтвержд</td>
					<td><input type="password" name="newus_name2" value="" maxlength=30 autocomplete="off" required /></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="adduser" value="Добавить" /></td>
				</tr>
			</table>
			</form>			
		</div>
		</br></br>
		<a href="$dirpajs">Вернуться в магазин</a>
		</br></br>
</div>
END;


//echo file_get_contents('gallery_form.html');
// делаем thumb
function imageresize($outfile,$infile,$neww,$newh,$quality,$funcreate1,$funcimage1) { 

				$im=$funcreate1($infile); 
				$im1=imagecreatetruecolor($neww,$newh);
				$black = imagecolorallocate($im1, 0, 0, 0);
				// Сделаем фон прозрачным
				imagecolortransparent($im1, $black);
				$white = imagecolorallocatealpha($im1, 255, 255, 255, 0);
				//$bg = imagecolorat($im, 0, 0);
				imagefilledrectangle($im1, 0, 0, $neww, $newh, $white);
				//imagefill($im1, 0, 0, $white);
				imagecolortransparent($im1, $white);
				//$im2=imagecolorallocate($im1, 255, 255, 255);
				imagecopyresampled($im1,$im,0,0,0,0,$neww,$newh,imagesx($im),imagesy($im)); 
				//$im2=imagecolorallocate($im1, 255, 255, 255);
				$funcimage1($im1, $outfile);
				//echo "<img src='$outfile' style='float:left; width:65px; height:65px'/>";
				imagedestroy($im); 
				imagedestroy($im1); 
				//imagedestroy($im2);
} 

?>
<link href="gallery_upload.css" type="text/css" rel="stylesheet">
</body>
</html>