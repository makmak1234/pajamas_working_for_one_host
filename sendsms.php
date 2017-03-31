<?php
	echo "<body style='font-size: 5px; color:#669900;'>";
	
	if(isset($_GET['PHPSESSID'])){
		session_id($_GET['PHPSESSID']);
		$myses = $_GET['PHPSESSID'];
	}

	session_start();
//	error_reporting(E_ALL);
	require_once 'login.php';
	
	$arrtextsms = $_SESSION['arrtextsms'];
	
	destroy_session_and_data();
	
	$query = "SELECT * FROM anna";
	$result= $foo_mysgli->mysql_query($query);
	//$row = mysql_fetch_row($result);
	$rows = $foo_mysgli->mysql_num_rows($result);

	//Отпраляем смс Сяве
		$foo_mysgli->mysql_data_seek($result, 0);//установить номер строки таблицы в 0
		for($i = 0; $i <= $rows-1; $i++){
			$row = $foo_mysgli->mysql_fetch_row($result);
			$telanna = $row[2];
			$sendtel = $row[4];
			$api_id = $row[6];//dd49dcc9-8ee1-d734-b1a7-d24e206db722
			if($sendtel == 1 ){
			/*	$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "http://sms.ru/sms/send");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_TIMEOUT, 30);
				curl_setopt($ch, CURLOPT_POSTFIELDS, array(
	
					"api_id"      =>   "$api_id",
					"to"          =>   "$telanna",
					"text"        =>   "$arrtextsms[0]"
						));
				$body = curl_exec($ch);
				curl_close($ch); */
				
				//http://sms.ru/sms/send?api_id=&to=&text=
	
				$myurl = "http://sms.ru/sms/send?api_id=" . $api_id . "&to=" . $telanna . "&text=" . $arrtextsms[0];
		//echo "Smyurl=  '$myurl'";
				header ("Location: $myurl");
		//echo "<div style='font-size:10px; color:#669900;'><br>cqwertffgt '$i'</div>";
				//$body=file_get_contents($myurl.urlencode(iconv("windows-1251","utf-8","Привет!")));
				
				//$body=file_get_contents("http://sms.ru/sms/send?api_id=dd49dcc9-8ee1-d734-b1a7-d24e206db722&to=+380951859539&text=Привет".urlencode(iconv("windows-1251","utf-8","Привет!")));
				
				/*if($body){
					echo "<div style='font-size:10px; color:#669900;'><br>c '$i'</div>";
				}
				else{
					echo "<div style='font-size:10px; color:#FF0000;'><br>c '$i'</div>";
				} */
			}
		}
		
//	destroy_session_and_data();
	
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
</body>