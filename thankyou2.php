<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
	<title>Пижамки</title>
	<link href="./m/elements/1419281141_363179.ico" rel="shortcut icon" type="image/x-icon" />
	<style>@charset "utf-8";</style>
</head>
<?php
	session_start();
//	error_reporting(E_ALL);
	require_once 'login.php';
	
	$priceall = 0;
	$price = array();
	$pricegoods = array();
	$title = array();
	$messgoods = "";
	$smstext = "";
	$sendm = "";
	$body = "";
	
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
	
	$namesurname = $_SESSION["namesurname"];
	$city = $_SESSION["city"];
	$tel = $_SESSION["tel"];
	$email = $_SESSION["email"];
	
		$query = "SELECT orderclients FROM clients";
		$result =  $foo_mysgli->mysql_query($query);
		$nrow = $foo_mysgli->mysql_num_rows($result);//лол-во элементов
		$nrow--;
		$orderclientsmax = $foo_mysgli->mysql_result ($result, $nrow, "orderclients");//последний элементо;
		
		echo "<center style='font: 1.5em italic; color:#006600;'><a href='$dirpajs'>Вернуться в магазин</a></center>"; 
		echo '<center style="font-size:1.5em; color:#669900;"><br>Спасибо! Заказ принят. В ближайшее время с вами свяжется наш менеджер</center>'; 
		echo "<center style='font-size:1.5em; color:#669900;'><br>Ваш номер заказа: <div style='font-size:2.5em; color:red;'> $orderclientsmax</div></center>";

		//$smstitle = "Пижамки: " . $namesurname . "\n Тел: " . $tel . "\n email: " . $email . " ". "\n";
		$telsms = str_split($tel, 13);
		$smstitle = "N " . $orderclientsmax . " Тел: " . $telsms[0];
		
		$messtitle ="
			<div><h3>Заказ от:  <b> $namesurname </b><h3/><div>
			<div><h3> Номер заказа:  <b><font color='red'> $orderclientsmax </font></b></h3><div>
			<div> Телефон:  <b> $tel </b><div>
			<div>  email:  <b> $email </b> <div>
			<div>  Город:  <b> $city </b> <div></br>
			<div><h3><b><font color='red'><i> Товар: </i></font></b></h3><div>";
		foreach($idarr as $k=>$v){
				
				$k1 = $k + 1;
				$messgoods .="
					<div><font color='green'> $k1) <b>  $title[$k] </font></b></div>
					<div> <b>  $nid[$k] шт * $price[$k] $prsite = $pricegoods[$k] $prsite</b> </div>";
		}

		$smstext = "   " . $priceall . " $prsite";
		$messgoods .= "<div><h3><b><i> Всего к оплате: </i><font color='red'> $priceall </font> </b> $prsite</h3></div>";
		
		$textsms = $smstitle . $smstext;
		$mess = $messtitle . $messgoods ;
		
		// На случай если какая-то строка письма длиннее 70 символов мы используем wordwrap()
		$mess = wordwrap($mess, 70);

		$arrtextsms = str_split($textsms, 67);
		
		$_SESSION["arrtextsms"] = $arrtextsms;
		
		$titleemail = "Пижамки: заказ от: ";
		$titleemail .= $namesurname;
		
		//считываем тел и email
		$query = "SELECT * FROM anna";
		$result= $foo_mysgli->mysql_query($query);
		//$row = mysql_fetch_row($result);
		$rows = $foo_mysgli->mysql_num_rows($result);

		$headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
		$headers .= "From: Birthday Reminder <birthday@example.com>\r\n"; 
		$headers .= "Bcc: birthday-archive@example.com\r\n"; 
		
		//destroy_session_and_data();

        // функция, которая отправляет наше письмо.
		for($i = 0; $i <= $rows-1; $i++){
			$row = $foo_mysgli->mysql_fetch_row($result);
			$emailanna = $row[3];
			$sendemail = $row[5];
			$emailto = $emailanna;
			$from = $titleemail . "\r\n" .
				"Reply-To: '$namesurname'" . "\r\n" .
				'MIME-Version: 1.0' . "\r\n" .
				'Content-type: text/html; charset=utf-8' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
			if($sendemail == 1){
				$sendm = mail($emailto, $titleemail, $mess, "From: " . $from);		
				if($sendm){
					//destroy_session_and_data();
					echo "<div style='font-size:10px; color:#669900;'><br>e '$i'</div>"; 
				}
				else{
					echo "<div style='font-size:10px; color:#FF0000;'><br>e '$i'</div>";
				}	
			
			}
		}

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
				
				//$body=file_get_contents($myurl.urlencode(iconv("windows-1251","utf-8","Привет!")));
				
				//$sendsms = "sendsms.php?" .session_name()."=".session_id();
				
				//$body=file_get_contents("http://sms.ru/sms/send?api_id=dd49dcc9-8ee1-d734-b1a7-d24e206db722&to=+380951859539&text=Привет".urlencode(iconv("windows-1251","utf-8","Привет!")));
				
				if($body){
					echo "<div style='font-size:10px; color:#669900;'><br>c '$i'</div>";
				}
				else{
					echo "<div style='font-size:10px; color:#FF0000;'><br>c '$i'</div>";
				} 
			}
		}
		
		$sendsms = "sendsms.php?" .session_name()."=".session_id();
				echo "<iframe SRC='$sendsms' MARGINWIDTH='1' frameborder='no' seamless style='position: absolute; width: 100px; left: -100px;'>";
					//$myurl = "http://sms.ru/sms/send?api_id=" . $api_id . "&to=" . $telanna . "&text=" .$arrtextsms[0];
				
					//header ("Location: $myurl");
				echo "</iframe>";
	
	//destroy_session_and_data();
	
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