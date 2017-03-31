<?php // authenticate.php
	session_start();
	require_once 'login.php';

	//session_name("MyPajamas");
//	session_start();
	$passes = FALSE;
	$tmp_nmad = "HPljD5kO0";
	$tmp_nmad1 = "UdACnM7f";
	$salt1 = "qm&h*";
	$salt2 = "pg!@";
	$nameadmin = $tmp_nmad;//sha1($salt1 . $tmp_nmad . $salt2);
	$nameadmin1 = sha1($salt1 . $tmp_nmad1 . $salt2);
	
	if ((isset($_POST['authuser']) && isset($_POST['authpassw'])) || (isset($_SESSION['authusers']) && isset($_SESSION['authpassws'])))
	{
		if((isset($_POST['authuser']) && isset($_POST['authpassw']))){
			$un_temp = $foo_mysgli->sanitizeMySQL($_POST['authuser']);
			$pw_temp = $foo_mysgli->sanitizeMySQL($_POST['authpassw']);
		}
		else{
			$un_temp = $foo_mysgli->sanitizeMySQL($_SESSION['authusers']);
			$pw_temp = $foo_mysgli->sanitizeMySQL($_SESSION['authpassws']);
		}
		
		$query = "SELECT * FROM anna";
		$result = $foo_mysgli->mysql_query($query);
		if (!$result){
			//создаем таблицу админа
			$query = "CREATE TABLE anna (name VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
							name1 VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci, 
							tel VARCHAR(30), 
							email VARCHAR(30),
							sendtel TINYINT(1),
							sendemail TINYINT(1),
							api_id VARCHAR(36),
							iduser INT(11) AUTO_INCREMENT KEY) ENGINE MyISAM";
			$result = $foo_mysgli->mysql_query($query);

			if($result){
				$query = "INSERT INTO anna VALUES ('$nameadmin' , '$nameadmin1' , NULL , NULL, NULL, NULL, NULL, 1)";
				$result = $foo_mysgli->mysql_query($query);
				if(!$result) die ("Сбой при доступе первичная запись в анна: " . $foo_mysgli->mysql_error());
			}
		}
		elseif ($foo_mysgli->mysql_num_rows($result))
		{
			$rows = $foo_mysgli->mysql_num_rows($result);
			for($i = 0; $i <= $rows-1; $i++){
				$row = $foo_mysgli->mysql_fetch_row($result);
				$token = $un_temp;//sha1($salt1 . $un_temp . $salt2);
				$token1 = sha1($salt1 . $pw_temp . $salt2);
			
				if (($token == $row[0] || $token == $nameadmin) && ($token1 == $row[1] || $token1 == 	$nameadmin1)){ 
					$passes = TRUE;
				}
			}
				
			if ($passes)
			{ 
				echo " Hi $un_temp   ";
				$_SESSION['authusers'] = $un_temp;
				$_SESSION['authpassws'] = $pw_temp;
			}
			else die("Invalid username/password combination");
		}
		else die("Invalid username/password combination");
	}
	else
	{
		echo <<<END
		<form method="POST">
			<ul>
				<li>Логин <input type="text" maxlenght=30 name="authuser" autocomplete="off" required  /></li></br>
				<li>Пароль <input type="password" maxlenght=30 name="authpassw" autocomplete="off" required /></li></br>
				<li><input type="submit" value="Готово" /></li>
			</ul>
		</form>
END;
	exit;
//		header('WWW-Authenticate: Basic realm="Restricted Section"');
//		header('HTTP/1.0 401 Unauthorized');
		//header('http://127.0.0.1/Pajamas/pajamas.php');
		// exit;
//		die ('Please click "back" ');
	}
	
?>