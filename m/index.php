<!DOCTYPE html>
<?php
//session_start();
if(isset($_GET['PHPSESSID'])){
	session_id($_GET['PHPSESSID']);
	$mysesid = $_GET['PHPSESSID'];
}
if(isset($_POST['PHPSESSID'])){
	session_id($_POST['PHPSESSID']);
	$mysesid = $_POST['PHPSESSID'];
}
//session_set_cookie_params('','/','m.pajamas.esy.es', false, false);
//session_set_cookie_params('','/',"$dirpajsm", false, false);//'m.pajamas.esy.es'
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Дата в прошлом

require_once "../login.php";

//session_set_cookie_params('','/','m.'.$dircook, false, false);//'m.pajamas.esy.es'

if(isset($_GET["mobcook"])){ //$_GET["mobcook"]
	//setcookie("mobcook", "0", 0, "", ".".$dircook, false, true);//.pajamas.esy.es
	$_SESSION["mobcook"] = 0;
	$mydir = "." . "$dirpajs";
	if(isset($_GET["idpost"])){
		if($_GET["idpost"] != ""){ 
			$idpost = $_GET["idpost"];
			$inputgoodsid = "inputgoodsid";
		}
	}
	else{
		$idpost = "";
		$inputgoodsid = "inputgoodsf";
	}
	echo <<<END
	<form name="mypostid" action="$dirpajs" method="POST">
		<input type="hidden" name="PHPSESSID" value="$mysesid" />
		<input type="hidden" name="$inputgoodsid" value="$idpost" />
	</form>
	<script>
		document.mypostid.submit();
	</script>
	
END;
	//header ("Location: $dirpajs?" .session_name().'='.session_id());
}

//if(isset($_GET["mobcook"])){
//	setcookie("mobcook", "1");
//}
//$ua=getBrowser();
//	if(isset($_COOKIE["mobcook"])){
//		if($_COOKIE["mobcook"] == "1") $ua['system'] = true;
//		print_r("ua= " . $ua['system']);
//		print_r("mobcook= " . $_COOKIE["mobcook"]);
//	}
//ini_set('display_errors',1);
//error_reporting(E_ALL);
?>
<!-- saved from url=(0024)http://kidorable.com.ru/ -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><!--charset=utf-8-->

<meta name="robots" content="index, follow">
<meta name="keywords" content="детская пижама отечественная одежда Пижамки Pajamas качественная ноская недорогая скидки натуральнный материал гипоаллергенная легко стирается">
<meta name="description" content="Детская пижама Pajamas — это яркие, стильные и удивительно ноские вещи, которые обязательно понравятся маленьким модникам и модницам, а также их родителям!">

<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>

<link href="./elements/1419281141_363179.ico" rel="shortcut icon" type="image/x-icon" />
<title>Пижамки</title>
<link href="mpajamas.css" type="text/css" rel="stylesheet">
<script language="javascript" type="text/javascript"  src="./jsm/goodsbasketcheckm.js">
</script>
<script type="text/javascript" src="//vk.com/js/api/openapi.js?116"></script>

</head>

<body><!--bgcolor="#13c5d8"-->

<?php
//класс для перехода в моб
	class myfooter{
		protected $idpostp;
		protected $dirpajs;
		protected $idpost;
		
		function __construct($dirp, $idpstp){
			$this->idpostp = $idpstp;
			$this->dirpajs = $dirp;
			$this->idpost = $idpstp;
		}
		
		public function foomyfooter(){
			$dirpajs1 = $this->dirpajs . "?mobcook=0&" .session_name().'='.session_id() . $this->idpostp;
			echo <<<END
			<footer>
				<a href="$dirpajs1">Полная версия</a>
			</footer></br>
END;
			//print_r(" session_id()= " . session_id());
			//if(isset($_COOKIE["mobcook"])) print_r(" mobcook= " . $_COOKIE["mobcook"]);
			//if(!empty($this->idpost)) print_r(" idpost= " . $this->idpost);
			//if(isset($_SESSION["sesgoodsid"])) print_r(" sesgoodsid= " . $_SESSION["sesgoodsid"]);
		}
	}
?>

<?php

// подключаем файл настроек
//$inifopen = ini_set("allow_url_fopen", 1);
//$iniinclude = ini_set("allow_url_include", 1);


//$inifopen = 1;
//echo "inifopen = $inifopen ";
//echo "iniinclude = $iniinclude";

//require_once "../login.php"; 

// подключаемся к серверу БД
//mysql_connect($dbhost,$dbuser,$dbpasswd);
//mysql_select_db($dbname);
//mysql_query('SET NAMES cp1251');

	//require_once 'login.php';


// подключаем шаблонизатор
//require_once "mtemplate.php"; 

// открываем шаблон
//$tpl->get_tpl('mpajamas.tpl'); 

//session_start();

//require_once 'login.php';

$priceall = 0;
$subscribe = $dirpajsm . "?socnet=1";
//ссылка для пункта цена опт/розн index
	$inputgoodsid = "";
	if(isset($_POST["inputgoodsid"])){
		$inputgoodsid = "&inputgoodsid=";
		$inputgoodsid .= $foo_mysgli->sanitizeMySQL($_POST['inputgoodsid']);
	}
	$bsbigcl = $dirpajsm . "?exchrtv=" . $val . "&elem=prsite" . $inputgoodsid;
	$retprice = $bsbigcl . "&retprice=ret" ;
	$salprice = $bsbigcl . "&salprice=sal" ;

echo <<<END

<header>
	<div class="title">ПИЖАМКИ</div>
	<div class="contmenu" id="contmenu">
	<ul class="allmenu" id="allmenu">
		<li onmouseover="myover()" onmouseout="myout()"><button class="menu" id="menu">Меню</button>
			<ul>
				<li><a href='$dirpajsm'><button class="menu">Главная</button></a></li>
				<li><a href="http://127.0.0.1/Pajamas/m/"><button class="menu">Контакты</button></a></li>
				<li><a href="$subscribe"><button class="menu">Социальные сети</button></a></li>
				<li><a href="$salprice"><button class="menu">Оптовые цены</button></a></li>
				<li><a href="$retprice"><button class="menu">Розничные цены</button></a></li>
				<li><a href="$dirpajsm"><button class="menu">Пункт номер 6</button></a></li>
				<li><a href="$dirpajsm"><button class="menu">Пункт номер 7</button></a></li>
				<li><a href="$dirpajsm"><button class="menu">Пункт номер 8</button></a></li>
			</ul>
		</li>
	</ul>
	</div>
</header>

<script>
	function myover(){
		document.getElementById("mybody").style.background_="#000";
		document.getElementById("mybody").style.opacity="0.2";
		document.getElementById("menu").style.color="#000";
	}
	function myout(){
		document.getElementById("mybody").style.background_="#fff";
		document.getElementById("mybody").style.opacity="1.0";
		document.getElementById("menu").style.color="#ccc";
	}
</script>

<div class="mybody" id="mybody">

	<div id="basketsmall">
END;

				if(isset($_SESSION["idbasketsmall"]))
				{
					$idarr = $_SESSION["idbasketsmall"];
					$nid = $_SESSION["nid"];
					if($idarr){
						require_once "./bassmallunatedm.php";
					}
					//else array_splice($idarr, 0, 1);
				}
	echo <<<END
	</div>

END;

$nameinp = "none";
$inputgoodsid="";
if(isset($_GET["inputgoodsid"])){
	$inputgoodsid = $foo_mysgli->sanitizeString($_GET["inputgoodsid"]);//sanitizeString
	$nameinp = "inputgoodsid";
}

if(isset($_POST["inputgoodsid"])){
	$inputgoodsid = $foo_mysgli->sanitizeString($_POST["inputgoodsid"]);//sanitizeString
	$nameinp = "inputgoodsid";
}

$finpgdsname = "";
$fsubmit = "hidden";

if(isset($_GET["salprice"]) || isset($_POST["valpass"])){
	$organiz = "";
	$city = "";
	$tel = "";
	$email = "";
	$valpass = "";
	$replyb = false;
	if(isset($_SESSION["valpass"])){
		$organiz = $_SESSION["namesurname"];
		$city = $_SESSION["city"];
		$tel = $_SESSION["tel"];
		$email = $_SESSION["email"];
		$valpass = $_SESSION["valpass"];
		$salret = "sal";
		$finpgdsname = "inputgoodsid";
	}
	
	if(isset($_POST["valpass"])){
		$valpass = substr($foo_mysgli->sanitizeMySQL(trim($_POST['valpass'])), 0, 32); 
		$query = "SELECT * FROM salclients WHERE pass='$valpass'";
		$result = $foo_mysgli->mysql_query($query);
		if(!$result) echo "Сбой при изменении данных salclients: $query <br />" . $foo_mysgli->mysql_error($result);
		$row = $foo_mysgli->mysql_fetch_row ($result);
		$reply = "Не правильно";
		$replyb = false;
		if($row[7] == $valpass){
			$replyb = true;
			$salret = "sal";
			$organiz = $row[3];
			$city = $row[4];
			$tel = $row[5];
			$email = $row[6];
			$valpass = $row[7];
			//$reply = json_encode($row, 256);
			$_SESSION["namesurname"] = $row[3];
			$_SESSION["city"] = $row[4];
			$_SESSION["tel"] = $row[5];
			$_SESSION["email"] = $row[6];
			$_SESSION["valpass"] = $row[7];
			$finpgdsname = "inputgoodsid";
			$reply = "Привет: " . $organiz;
		}
		echo <<<END
		$reply		
END;
	}

	if(!$replyb && !isset($_SESSION["valpass"])){	
		echo <<<END
		<div id="formregis">
			Регистрация оптовиков</br>
			<form action="$dirpajsm" method="POST" class="youitemsform" name="fpasssub1">
				<div id="incorrval"></div>
				<input id="valpass" type="text" name="valpass" value="" placeholder="Введите код" maxlength=32 />
				<input type="hidden" name="dirbsbigcl" value="$dirbsbigcl" />
				<input type="hidden" name="$nameinp" value="$inputgoodsid" />
				<input type="submit" id="inpvalbut" value="Ok" />
			</form></br>
			Или зарегистрируйтесь
			<form action="$dirpajsm" method="POST" class="youitemsform" name="fregsub">
				<input id="organiz" type="text" name="organiz" value="$organiz" placeholder="Организация" maxlength=30 /></br>
				<input id="city" type="text" name="city" value="$city" placeholder="Город" maxlength=30 /></br>
				<input id="tel" type="tel" name="tel" value="$tel" placeholder="Моб телефон" maxlength=30 required /></br>
				<input id="email" type="email" name="email" value="$email" placeholder="email" maxlength=30 /></br>
				<input type="hidden" name="dirbsbigcl" value="$dirbsbigcl" />
				<input type="hidden" name="$nameinp" value="$inputgoodsid" />
				<input type="submit" id="mysubmit" value="Готово" />
			</form>
		</div>
END;
		exit;
	}
}

if(isset($_POST["organiz"])){
	//if(isset($_GET["organiz"]){
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
		//setcookie("valcook", "1", 0, "/");//, "dirpajs", false, true);//.pajamas.esy.es
		
		$salret = "sal";
		$finpgdsname = "";
		$fsubmit = "submit";
		echo <<<END
		Код для входа:</br></br>
		<div class="mypass">$mypass</div>
		</br>
		<!--<form name="inputgoodsid" action="$dirpajsm" method="POST">
			<input type="hidden" name="$nameinp" value="$inputgoodsid" />
			<input type="submit" id="valbutton" value="Ok" />
		</form>-->
		<!--<script>document.inputgoodsid.submit()</script>-->
END;
	//exit;
		
		//print($mypass);	
	//}
}

//редирект после вывода на экр кода
if(isset($salret) || isset($_GET["retprice"])){
	//$index =  $foo_mysgli->sanitizeString($_GET["index"]);
	if(isset($_GET["retprice"])){
		setcookie("valcook", "0", 0, "", ".".$dircook, false, true);//.pajamas.esy.es
		$finpgdsname = "inputgoodsid";
	}
	else if(isset($salret)){
		setcookie("valcook", "1", 0, "", ".".$dircook, false, true);//.pajamas.esy.es
	}

	$valcook = "none";
	if(isset($_COOKIE["valcook"]))$valcook = $_COOKIE["valcook"];
	echo <<<END
	<form name="$finpgdsname" action="$dirpajsm" method="POST">
		<input type="hidden" name="$nameinp" value="$inputgoodsid" />
		<input type="$fsubmit" id="valbutton" value="Ok" />
		<!--<input type="submit" value="Посмотрел">-->
	</form>
	<script>document.inputgoodsid.submit()</script>
END;
	exit;
}

if(isset($_GET["socnet"])){
	echo <<<END
	
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.3";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	
	<div class="widgetsdiv">
	<ul class="widgetssub">
	<li>

			<div class="subscriptiontxt"> Подписаться </div>
	
	</li>

	<!-- VK Widget -->
	<li>
		<div id="vk_groups"></div>
		<script type="text/javascript">
			VK.Widgets.Group("vk_groups", {mode: 1, width: "220", height: "400", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 91772404);
		</script>
	</li>

	</br>
	<li>
	<!--OK Widget-->
		<div id="ok_group_widget"></div>
		<script>
			!function (d, id, did, st) {
				var js = d.createElement("script");
				js.src = "http://connect.ok.ru/connect.js";
				js.onload = js.onreadystatechange = function () {
				if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
					if (!this.executed) {
						this.executed = true;
						setTimeout(function () {
							OK.CONNECT.insertGroupWidget(id,did,st);
						}, 0);
					}
				}}
				d.documentElement.appendChild(js);
			}(document,"ok_group_widget","52600174411956","{width:200,height:135}");
		</script>
	</li>

	</br>
	<li>
		<div class="fb-follow" data-href="https://www.facebook.com/pages/Pajamas/1569508466632344" data-colorscheme="light" data-layout="button" data-show-faces="true"></div>
	</li>

	</br>
	<li>

	</li>
	</ul>
END;

	// переход в моб вер
	$idpostp = "";
	$myfooter = new myfooter($dirpajsm, $idpostp);
	//$myfooter->__construct($dirpajs, $idpostp);
	$myfooter->foomyfooter();

	exit;
}

if(!isset($_POST["inputgoodsid"]))
{
	$phpsessid = session_id();
	echo <<<END

	<form name='choicegoods' action='$dirpajsm' method='POST'>
		<input type='hidden' name='inputgoodsid' value='' />
		<input type='hidden' name='PHPSESSID' value='$phpsessid'>
	</form>	
END;

	$query = "SELECT * FROM pajamas1 ORDER BY myorder";
	$result = $foo_mysgli->mysql_query($query);

	if ( !$result) die ("Сбой при доступе к базе данных: " . $foo_mysgli->mysql_error());
	$rows = $foo_mysgli->mysql_num_rows($result);

	for($i = 1; $i <= $rows; $i++) //$rows
	{
		$row =  $foo_mysgli->mysql_fetch_row($result);//текущая строка таблицы
		$images = "./gallery/thum100_" . $row[4];//путь к маленькому изображению товара
			echo <<<END
		<div class="content">
				<figure class='imgrecord'><img class='myimages' src='$images' 		onclick="document.choicegoods.inputgoodsid.value='$row[3]'; document.choicegoods.submit();" alt=''>
					<figcaption class='slider__item-name'>$row[0]</figcaption>
				</figure>
			
				<div class="choicegoodssiig">
					<div class="choicegoodsdescr">$row[1]</div></br></br>
					<div class="choicegoodspriceg"><div class="choicegoodsprice1">Цена: $row[$val] $prsite</div></div></br>
					<button class="goodsbasketinpg ibutton-css-blue"  name="goodsbasketinp" onclick="goodsbasketcheck($row[3], 'FALSE', './')">В корзину</button>
				
					<form action="$dirbasbi" method="POST">
						<button type="submit" class="buylabg ibutton-css-green">Купить</button>
						<input type="hidden" name="buyid" value="$row[3]" />
					</form>
				
				</div>
				
		</div>
END;
	}
	//echo "</div>";
}
else{
	$id = $foo_mysgli->sanitizeMySQL($_POST['inputgoodsid']);
	$idpost = $id;
//echo " id= $id";
	$query = "SELECT * FROM pajamas1 WHERE id='$id'";
	$result = $foo_mysgli->mysql_query($query);
	$row = $foo_mysgli->mysql_fetch_row ( $result);
	if ( !$result) die ("Сбой при доступе к базе данных вывод одного товара: " . $foo_mysgli->mysql_error());
	$myfile_name = "./gallery/thum300_" . $row[4];
	//отображаемый файл
	//$directory = ROOT_LOCATION . "basketbig.php";
	$dirbuy = $dirbasbi . "?buyid=" . $row[3];
	
	echo <<<END
		<div class="choicegoodscont">
			<figure class='choicegoods'><img src="$myfile_name">
				<figcaption class='choicegoodsitem'>$row[0]</figcaption>
			</figure>
			
			<form name="buyform" id="buyform" action="$dirbasbi" method="POST">
				<input type="hidden" name="buyid" value="" />
			</form>
			
			<div class="choicegoodssii">
				<div class="choicegoodsdescr">$row[1]</div></br></br>
				<div class="choicegoodsprice"><div class="choicegoodsprice1">Цена: $row[$val] $prsite</div></div></br>
				<button class="goodsbasketinp ibutton-css-blue"  name="goodsbasketinp" onclick="goodsbasketcheck($row[3], 'FALSE', './')">В корзину</button><br/><br/>
				
				<form action="$dirbasbi" method="POST">
					<button type="submit" class="buylab ibutton-css-green">Купить</button>
					<input type="hidden" name="buyid" value="$row[3]" />
				</form>
				
			</div>
			<div id="querymy"></div>
			<!--<div id="basketsmall">-->
END;

			/*	if(isset($_SESSION["idbasketsmall"]))
				{
					$idarr = $_SESSION["idbasketsmall"];
					$nid = $_SESSION["nid"];
					if($idarr){
						require_once "./bassmallunatedm.php";
					}
					//else array_splice($idarr, 0, 1);
				} */
	echo <<<END
			<!--</div>-->
		</div>
END;

 //Вывод маленьких топовых новинок 
				//$dir = "gallery"
				$query = "SELECT * FROM pajamas1 ORDER BY myorder";
				$result = $foo_mysgli->mysql_query($query);
				if ( !$result) die ("Сбой при доступе к базе данных: " . $foo_mysgli->mysql_error());
				$rows = $foo_mysgli->mysql_num_rows($result);
				$foo_mysgli->mysql_data_seek($result, 0);//установить номер строки таблицы в 0
				//$dirpajs = ROOT_LOCATION . "pajamas.php";
				echo <<<END
					<form name="choicegoods2" action="$dirpajsm" method="POST">
							<input type="hidden" name="inputgoodsid" value="" />
					</form>
					<div class="smallfig">
					<ul>
END;
							for($i = 1; $i <= $rows; $i++) //$rows
							{
								$row =  $foo_mysgli->mysql_fetch_row($result);//текущая строка таблицы
					
								$images = "./gallery/thum_" . $row[4];//путь к большому изображению товара
								echo <<<END
								<li><img src="$images" onclick="document.choicegoods2.inputgoodsid.value='$row[3]'; document.choicegoods2.submit();" alt=""></li>
END;
							}
			
						echo <<<END
							<!--	<li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" jcarouselindex="1" style="float: left; list-style: none;"><img class="carousel__img" src="./Kidorable.com.ru_files/mdl_lotus_02(1).png" alt=""></li>-->
					</ul>
					</div>
END;

echo <<<END
END;
}
	$idpostp = '';
	if(isset($idpost)){
		$idpostp = "&idpost=$idpost";
	}
	

// переход в моб вер
	$idpostp = "";
	if(isset($idpost)){
		$idpostp = "&idpost=$idpost";
	}
	$myfooter = new myfooter($dirpajsm, $idpostp);
	//$myfooter->__construct($dirpajs, $idpostp);
	$myfooter->foomyfooter();
			  
//	echo $goods;

// устанавливаем переменные шаблона
//$page = join('',file($f));
//$goods = "Images";
//$tpl->set_value('GOODS', $goods);

//$tpl->set_value('TITLE',"title"); 
//$tpl->set_value('DESCRIPTION',"description"); 
//$tpl->set_value('INFO',"info"); 

// меню пока не будет
//include "menu.php";

//$tpl->set_value('MENU',"menu"); 

//$tpl->set_value('TEST',"Тест"); 

// переменная $p не установлена - нужно вывести главную страницу
/*  if (!isset($p)) {

        $q = "select * from static where id=\"main\" limit 1";
	$r = mysql_query($q);

	$row = mysql_fetch_array($r);
	$page = $row[content];

}
elseif($p=="show") {

// выводим содержимое раздела
	$id = @htmlspecialchars($id);
	$id = @strip_tags($id);

// ищем подразделы
$query = "select * from cats where root=$id";
$result = mysql_query($query);
if (mysql_num_rows($result)==0) {
// подразделов нет, выводим страницы
	$q2 = "select * from cats where id=$id";
	$res2 = mysql_query($q2);

	$q3 = "select * from cats where id=$id";
	$res3 = mysql_query($q3);

        $row3 = mysql_fetch_array($res3);

	$info = $row3[txt];

	$page = $page . "<table width=100% border=0><td valign=top width=40%>";

	if (mysql_num_rows($res2)>0) {

		$row2 = mysql_fetch_array($res2);
		$page = $page . "<h1>$row2[title]</h1><p>";		

		$q = "select * from pages where cat=$id";
		
		$res = mysql_query($q);
		
		while ($row = mysql_fetch_array($res))  
			$page = $page . "<br><b><a href=index.php?p=showpage&id=$row[id]>$row[header]</a></b>";
		
	    
       $page = $page . "</td><td valign=top>$info</td></table>";

	}
	else $page = $page .  "<h1>Нет такого раздела!</h1>";
}

// есть подразделы, выводим их
while ($row = mysql_fetch_array($result))  
	$page = $page .  "<br><a href=index.php?p=show&id=$row[id]>$row[title]";

}
elseif ($p=="showpage") {

	$id = @htmlspecialchars($id);
	$id = @strip_tags($id);

	$q = "select * from pages where id=$id";
	$r = mysql_query($q);
	
	if (mysql_num_rows($r)>0) {
		$row = mysql_fetch_array($r);
		$page = $page .  "<h1>$row[header]</h1>";

		$page = $page .  "<p><center><a name=top></a><a href=#down>Вниз</a></center><p>";

		$page = $page .  "<p><br><br>$row[content]";
		$page = $page .  "<p><p><a target=_blank href=print.php?id=$id>Версия для печати</a>";

		$page = $page .  "<p><br><p><center><a name=down></a><a href=#top>Наверх</a></center>";
		
	}
	else $page = $page .  "<h1>Нет такой страницы!</h1>";
}
elseif ($p=="static") {

	$id = @htmlspecialchars($id);
	$id = @strip_tags($id);

	$q = "select * from static where id=\"$id\" limit 1";
	$r = mysql_query($q);

	$row = mysql_fetch_array($r);
	$page = $row[content];

}
elseif($p=="file") {

$f = $f . ".html";
$page = join('',file($f));

} */


//$tpl->set_value('PAGE',"page"); 

// запускаем парсинг шаблона
//$tpl->tpl_parse(); 

// выводим HTML
//echo $tpl->html; 
?>

</div>
</body>
</html>