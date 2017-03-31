<?php
//	session_start();
	if(isset($_GET['PHPSESSID'])){
		session_id($_GET['PHPSESSID']);
		$mysesid = $_GET['PHPSESSID'];
	}
	if(isset($_POST['PHPSESSID'])){
		session_id($_POST['PHPSESSID']);
		$mysesid = $_POST['PHPSESSID'];
	}
	//session_set_cookie_params('','/',"$dirpajsm", false, false);//'m.pajamas.esy.es'
	session_start();
	
	require_once 'login.php';
	
//	session_set_cookie_params('','/',"$dirpajsm", false, false);//'m.pajamas.esy.es'
	//$myconst = new myconst();
	
	//require_once "$myconst->dirbasbi";
	
	
	if(isset($_GET['namesurname']) || isset($_GET['city']) || isset($_GET['tel']) || isset($_GET['email'])) { 
		$namesurname = substr($foo_mysgli->sanitizeMySQL(trim($_GET['namesurname'])), 0, 30); 
		$city =  substr($foo_mysgli->sanitizeMySQL(trim($_GET['city'])), 0, 30); 
		$tel =  substr($foo_mysgli->sanitizeMySQL(trim($_GET['tel'])), 0, 13); 
		$email =  substr($foo_mysgli->sanitizeMySQL(trim($_GET['email'])), 0, 30);
		$_SESSION["namesurname"] = $namesurname;
		$_SESSION["city"] = $city;
		$_SESSION["tel"] = $tel;
		$_SESSION["email"] = $email;
	}
	
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Дата в прошлом
	//require_once 'login.php';
//setcookie("mobcook", "1");
	if(isset($_GET["mobcook"])){ //$_GET["mobcook"]
		//setcookie("mobcook", "1", 0, "", ".".$dircook, false, true); //.pajamas.esy.es
		$_SESSION["mobcook"] = 1;
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
		<form name="mypostid" action="$dirpajsm" method="POST">
			<input type="hidden" name="PHPSESSID" value="$mysesid" />
			<input type="hidden" name="$inputgoodsid" value="$idpost" />
		</form>
		<script>
			document.mypostid.submit();
		</script>
		
END;
		//header ("Location: $dirpajsm?" .session_name().'='.session_id());
	}
	$ua=getBrowser();		
	if(isset($_SESSION["mobcook"])){ //$_COOKIE["mobcook"]
		if($_SESSION["mobcook"] == "1") $ua['system'] = true;
		else $ua['system'] = false;
	}
//$ua['system'] = true;
	if($ua['system']){
		header ("Location: $dirpajsm?" .session_name().'='.session_id());
	}
?>
<!DOCTYPE html>
<!-- saved from url=(0024)http://kidorable.com.ru/ -->
<html prefix="og: http://ogp.me/ns#">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!--charset=utf-8-->

<meta property="fb:app_id"             content="944534542247328" />
<meta property="og:image" content="./m/elements/1419281141_363179.ico" />
<meta property="og:title" content="Пижамки" />
<meta property="og:description" content="Магазин детских пижамок." />

<meta name="title" content="Пижамки" />
<meta name="description" content="Магазин детских пижамок." />
<link rel="image_src" href="./m/elements/1419281141_363179.ico" />
<script type="text/javascript" src="http://vk.com/js/api/share.js?90" charset="windows-1251"></script>

<meta name="robots" content="index, follow">
<meta name="keywords" content="детская пижама отечественная одежда Пижамки Pajamas качественная ноская недорогая скидки натуральнный материал гипоаллергенная легко стирается">
<meta name="description" content="Детская пижама Pajamas — это яркие, стильные и удивительно ноские вещи, которые обязательно понравятся маленьким модникам и модницам, а также их родителям!">

<link href="./m/elements/1419281141_363179.ico" rel="shortcut icon" type="image/x-icon" />
<title>Пижамки</title>
<link href="Pajamas.css" type="text/css" rel="stylesheet">
<script src="jquery/jquery.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript"  src="jquery/jquery.carouFredSel.packed.js"></script>

<script language="javascript" type="text/javascript"  src="myscript/pause.js"></script>
<script language="javascript" type="text/javascript"  src="myscript/click.js"></script>
<script language="javascript" type="text/javascript"  src="myscript/goodsbasketcheck.js"></script>
<script language="javascript" type="text/javascript"  src="myscript/authvkajx.js"></script>

<script type="text/javascript" src="//vk.com/js/api/openapi.js?116"></script>
<!--<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'ru'}
</script>-->

</head>
<body bgcolor="#13c5d8"><!--bgcolor="#13c5d8"-->

<!--<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '944534542247328',
      xfbml      : true,
      version    : 'v2.3'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script> -->

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
				<div>
					<a href="$dirpajs1">Мобильная версия</a>
				</div>
			</footer></br>
END;
			//print_r(" session_id()= " . session_id());
			//if(isset($_COOKIE["mobcook"])) print_r(" mobcook= " . $_COOKIE["mobcook"]);
			//if(!empty($this->idpost)) print_r(" idpost= " . $this->idpost);
			//if(isset($_SESSION["sesgoodsid"])) print_r(" sesgoodsid= " . $_SESSION["sesgoodsid"]);
		}
	}
?>

<div class="test">пижамки</div>
 
	<div id="header-top"><!-- google search -->
		<!--
		<form action="http://www.wisecleaner.com/search.html" id="google-search">
		  <div>
		    <input type="hidden" name="cx" value="partner-pub-2235757663962576:9250704230" />
		    <input type="hidden" name="cof" value="FORID:10" />
		    <input type="hidden" name="ie" value="UTF-8" />
		    <input type="text" name="q" size="30" id="search-input" />
		    <input type="submit" name="sa" value="" class="global-image" id="search-submit" />
		  </div>
		</form>
		-->
		<!-- google search End -->
		
		<ul id="agents">
		  <li><a href="http://jp.wisecleaner.com" id="japan" name="Japan-Language"></a></li>
			<li><a href="http://www.wisecleaner.eu" id="germany" name="Germany-Lanuage"></a></li>
	  </ul>
 
		<!-- google -->
		<div id="google_translate_element"></div>
		<!-- google End -->
</div>
	
	<div id="entrance-nav">
		<ul id="entrance" class="entrance">
			<li><a class="entranceeditor">Войти</a>
				<ul>
				<?php
			
				echo <<<END
					<li><a href="$dirgaupl">Редактор</a></li>
					<li><a href="$dirbycus">Архив</a></li>
END;
				?>
				</ul>
			</li>
		</ul>
	</div>

<?php
	$subscribe = $dirpajs . "?socnet=1";
//ссылка для пункта цена опт/розн
	$inputgoodsid = "";
	if(isset($_POST["inputgoodsid"])){
		$inputgoodsid = "&inputgoodsid=";
		$inputgoodsid .= $foo_mysgli->sanitizeMySQL($_POST['inputgoodsid']);
	}
	$bsbigcl = $dirbsbigcl . "?exchrtv=" . $val . "&elem=prsite" . $inputgoodsid;
	$bsbigclret = $bsbigcl . "&index=ret" ;
	$bsbigclsal = $bsbigcl . "&index=sal" ;
	//if($val == 2 || $val == 7) $bsbigclret = $bsbigcl;
	//if($val == 8 || $val == 9) $bsbigclsal = $bsbigcl;
//форма для регистрации оптовиков
	//$basketbig = new basketbig();
	
	//$formregis = $basketbig->persinfo();
	$organiz = "";
	$city = "";
	$tel = "";
	$email = "";
	$valpass = "";
	if(isset($_SESSION["valpass"])){
		$organiz = $_SESSION["namesurname"];
		$city = $_SESSION["city"];
		$tel = $_SESSION["tel"];
		$email = $_SESSION["email"];
		$valpass = $_SESSION["valpass"];
	}
	echo <<<END
	<div id="formregis">
		<img src="./m/elements/delete_16x16.png" class="clformregis" onclick='document.getElementById("formregis").style.display = "none";'>
		Регистрация оптовиков</br></br>
		<form action="#" onsubmit="fpasssub2(this); return false;" method="POST" name="fpasssub1">
			<div id="incorrval"></div>
			<input id="inpvalpass" type="text" name="inpvalpass" value="" placeholder="Введите код" maxlength=32 />
			<input type="hidden" name="dirbsbigcl" value="$dirbsbigcl" />
			<input type="submit" id="inpvalbut" value="Ok" /><img  id="ajaxload" src="./m/elements/350.gif">
		</form>
		Или зарегистрируйтесь
		<form action="#" onsubmit="fregsub1(this); return false;" method="POST" name="fregsub">
			<input id="organiz" type="text" name="organiz" value="$organiz" placeholder="Организация" maxlength=30 /></br>
			<input id="city" type="text" name="city" value="$city" placeholder="Город" maxlength=30 /></br><img id="ajaxload2" src="./m/elements/350.gif">
			<input id="tel" type="tel" name="tel" value="$tel" placeholder="Моб телефон" maxlength=30 required /></br>
			<input id="email" type="email" name="email" value="$email" placeholder="email" maxlength=30 /></br>
			<input type="hidden" name="dirbsbigcl" value="$dirbsbigcl" />
			<input type="submit" id="mysubmit" value="Готово" />
		</form>
		<div id="valcode">Ваш код входа:</div><div id="valpass"></div>
		<input type="hidden" id="valbutton" onclick="formregok('$bsbigclsal');" value="Ok" />
		<div id="querymy"></div>
	</div>
END;
	if(isset($_SESSION["valpass"])){
		echo <<<END
		<script>
			document.getElementById("valcode").style.display = "block";
			document.getElementById("valbutton").type = "button";
			document.getElementById("mysubmit").type = "hidden";
			document.getElementById("valpass").innerHTML = "$valpass";
		</script>
END;
	}
	
	echo <<<END
	<div id="header-nav">
		<ul id="nav">
			<li id="home"><a href="$dirpajs">Главная</a></li>
			<!--<li id="products"><a href="gallery_upload.php">Каталоги</a>
				<ul>
					<li><a href="#"><span class="care365"></span>Подпункт 1</a></li>
					<li><a href="#"><span class="wpca"></span>Подпункт 2</a></li>
					<li><a href="#"><span class="wrc"></span>Подпункт 3</a></li>
					<li><a href="#"><span class="wdc"></span>Подпункт 4</a></li>
					<li><a href="#"><span class="wpm"></span>Подпункт 5<span class="nav-new"></span></a></li>
					<li><a href="#"><span class="wdr"></span>Подпункт 6</a></li>
					<li><a href="#"><span class="wpu"></span>Подпункт 7</a></li>
					<li><a href="#"><span class="wfh"></span>Подпункт 8</a></li>
					<li><a href="#"><span class="wrm"></span>Подпункт 9</a></li>
					<li><a href="#"><span class="wmo"></span>Подпункт 10</a></li>
					<li><a href="#"><span class="wgb"></span>Подпункт 11</a></li>				
					<li><a href="#"><span class="wjs"></span>Подпункт 12</a></li>
					<li><a href="#"><span class="was"></span>Подпункт 13</a></li>
				</ul>
			</li>
			<li id="buynow"><a href="">Фотогалерея</a></li>--!>
			<li id="downloads"><a href="">Оптовым клиентам</a>
				<ul>
					<li onclick='document.getElementById("formregis").style.display = "block";'><a href="#">Оптовая цена (регистрация)</a></li>
					<li><a href="$bsbigclret">Розничная цена</a></li>
				</ul>
			</li>
			<!--<li id="support"><a href="">Новости</a>
				<ul>
					<li><a href="">Подпункт 1</a></li>
					<li><a href="">Подпункт 2</a></li>
					<li><a href="">Подпункт 3</a></li>
				</ul>
			</li>
			<li id="think-tank"><a href="">Контакты</a></li>--!>
			<li id="think-tank"><a href="$subscribe">Подписаться</a></li>
		</ul>
	</div>
END;
?>

<?php // sqltest.php
//session_start();

//require_once 'login.php';

$priceall = 0;
				
$query = "SELECT * FROM pajamas1 ORDER BY myorder";
$result = $foo_mysgli->mysql_query($query);

if ( !$result) die();//die ("Сбой при доступе к базе данных: " . mysql_error());
$rows = $foo_mysgli->mysql_num_rows($result);

/*if(isset($_GET['namesurname']) || isset($_GET['city']) || isset($_GET['tel']) || isset($_GET['email'])) { 
	$namesurname = substr($foo_mysgli->sanitizeMySQL(trim($_GET['namesurname'])), 0, 30); 
    $city =  substr($foo_mysgli->sanitizeMySQL(trim($_GET['city'])), 0, 30); 
	$tel =  substr($foo_mysgli->sanitizeMySQL(trim($_GET['tel'])), 0, 13); 
	$email =  substr($foo_mysgli->sanitizeMySQL(trim($_GET['email'])), 0, 30);
	$_SESSION["namesurname"] = $namesurname;
	$_SESSION["city"] = $city;
	$_SESSION["tel"] = $tel;
	$_SESSION["email"] = $email;
}*/

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
		<section class="ss">
			<div class="subscriptiontxt"> Подписаться </div>
		</section>
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
	$myfooter = new myfooter($dirpajs, $idpostp);
	//$myfooter->__construct($dirpajs, $idpostp);
	$myfooter->foomyfooter();
	
	echo "</div>";

	exit;
}

if(!isset($_POST["inputgoodsid"]))
{
	$phpsessid = session_id();
	echo <<<END
		<div class="jcarousel-slider jcarousel-container-horizontal">
		<form name="choicegoods" action="$dirpajs" method="POST">
			<input type="hidden" name="inputgoodsid" value="" />
			<input type='hidden' name='PHPSESSID' value='$phpsessid'>
		</form>
              <ul class="jcarousel-list jcarousel-list-horizontal" id="carousel" onmouseover="pause('left', 'mouseover'), pause('right', 'mouseover')" onmouseout="pause('left', 'mouseout'), pause('right', 'mouseout')">
			  <!--Вывод топовых новинок бегущая строка-->
END;
					 
				//$dir = "gallery
				$foo_mysgli->mysql_data_seek($result, 0);//установить номер строки таблицы в 0
				for($i = 1; $i <= $rows; $i++) //$rows
				{
					$row =  $foo_mysgli->mysql_fetch_row($result);//текущая строка таблицы
					$images = "m/gallery/" . $row[4];//путь к большому изображению товара
					echo <<<END
						<li class="imgrecord"><img src="$images" onclick="document.choicegoods.inputgoodsid.value='$row[3]'; document.choicegoods.submit();" alt=""><div class="slider__item-name">$row[0]</div></li>
END;
				}
					
				echo <<<END
				             <!--   <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" jcarouselindex="1" style="float: left; list-style: none; width: 440px;"><a href="http://kidorable.com.ru/catalog/detail.php?ID=157"><img src="./Kidorable.com.ru_files/mdl_lotus_02.png" alt=""><div class="slider__item-name">Мистический лотос</div></a></li>-->
    
							 </ul>
			
			<script>
				$(document).ready(function() {
					// Using default configuration
					$('#carousel').carouFredSel();
 
					// Using custom configuration
					$('#carousel').carouFredSel({
						width				: "100%",
						items               : 3,
						direction           : "left",
						prev                : "#cl_left",
						next                : "#cl_right",
						align				: "center",
						scroll : {
							items           : 3,
							easing          : "swing", /*"quadratic"*/
							duration        : 1000,
							pauseOnHover    : true
						},
					});
				});
			</script> 
		</div>	
            <div class='buttons'>
				<div class="left" id="cl_left"><img id="left" onmouseover="pause(this.id, 'mouseover')" onmouseout="pause(this.id, 'mouseout')" src="./m/elements/arrow left.png">
				</div>
				<div class="left_pause" id="left_pause"><img src="./m/elements/pause_membership.png">
				</div>
				<!--<div class="pause" id="cl_pause" onmouseover="click()" data-title="Пуск"></div>-->
				<div class="right_pause" id="right_pause"><img src="./m/elements/pause_membership.png">
				</div>
				<div class='right' id="cl_right"><img id="right" onmouseover="pause(this.id, 'mouseover')" onmouseout="pause(this.id, 'mouseout')" src="./m/elements/arrow right.png">
				</div>
			</div>
        
    <!--</div>-->
	
	<div id="basketsmall">
END;
		if(isset($_SESSION["idbasketsmall"]))
					{
						$idarr = $_SESSION["idbasketsmall"];
						$nid = $_SESSION["nid"];
						if($idarr){
							require_once "bassmallunatedmb.php";
						}
						//else array_splice($idarr, 0, 1);
					}
					echo <<<END
	</div>
END;
}
else{
	$id = $foo_mysgli->sanitizeMySQL($_POST['inputgoodsid']);
	$idpost = $id;
//echo " id= $id";
	$query = "SELECT * FROM pajamas1 WHERE id='$id'";
	$result = $foo_mysgli->mysql_query($query);
	$row = $foo_mysgli->mysql_fetch_row ( $result);
	if ( !$result) die ("Сбой при доступе к базе данных вывод одного товара: " . $foo_mysgli->mysql_error());
	$myfile_name = "./m/gallery/" . $row[4];
	//отображаемый файл
	//$directory = ROOT_LOCATION . "basketbig.php";
	$dirbuy = $dirbasbi . "?buyid=" . $row[3];

$valcook = "none";
if(isset($_COOKIE["valcook"]))	$valcook = $_COOKIE["valcook"];
	
	echo <<<END
		<div class="choicegoodscont">
			<div class="choicegoods">
				<img src="$myfile_name">
				<div class="choicegoodsitem">$row[0]</div>
			</div>
			<form name="buyform" id="buyform" action="$dirbasbi" method="POST">
				<input type="hidden" name="buyid" value="" />
			</form>
			
			<div class="choicegoodssii">
				<div class="choicegoodsdescr">$row[1]</div>
				<div class="choicegoodsprice">Цена: $row[$val] $prsite </div>
				<button class="goodsbasketinp ibutton-css-blue"  name="goodsbasketinp" onclick="goodsbasketcheck($row[3], 'FALSE', '')">В корзину</button><br/><br/>
				<!--<label class="goodsbasketinp"><input name="goodsbasketinp" type="checkbox" style="visibility:hidden;" onclick="goodsbasketcheck($row[3], 'FALSE')"></label>-->
				<form action="$dirbasbi" method="POST">
					<button type="submit" class="buylab ibutton-css-green">Купить</button>
					<input type="hidden" name="buyid" value="$row[3]" />
					<!--<a class="buylab" href="$dirbuy">onclick="goodsbasketcheck($row[3], 'FALSE', ''); window.location.href = '$dirbasbi';"-->
				</form>
				
			</div>
			<div id="querymy">
			</div>
			<div id="basketsmall">
END;

				if(isset($_SESSION["idbasketsmall"]))
				{
					$idarr = $_SESSION["idbasketsmall"];
					$nid = $_SESSION["nid"];
					if($idarr){
						require_once "bassmallunated.php";
					}
					//else array_splice($idarr, 0, 1);
				}
	echo <<<END
			</div>
		</div>
END;
}

?>			  
			 <?php //Вывод маленьких топовых новинок бегущая строка
				//$dir = "gallery"
				$query = "SELECT * FROM pajamas1 ORDER BY myorder";
				$result = $foo_mysgli->mysql_query($query);
				if ( !$result) die ("Сбой при доступе к базе данных: " . $foo_mysgli->mysql_error());
				$rows = $foo_mysgli->mysql_num_rows($result);
				$foo_mysgli->mysql_data_seek($result, 0);//установить номер строки таблицы в 0
				//$dirpajs = ROOT_LOCATION . "pajamas.php";
				echo <<<END
					<form name="choicegoods2" action="$dirpajs" method="POST">
							<input type="hidden" name="inputgoodsid" value="" />
					</form>
				
					<div class="jcarousel-slider2">
						<div class="left" id="cl_left2"><img id="left" onmouseover="pause(this.id, 'mouseover2')" onmouseout="pause(this.id, 'mouseout2')" src="./m/elements/arrow left.png">
						</div>
						<div class="left_pause" id="left_pause2"><img src="./m/elements/pause_membership.png">
						</div>
						<div class="right_pause" id="right_pause2"><img src="./m/elements/pause_membership.png">
						</div>
						<div class='right' id="cl_right2"><img id="right" onmouseover="pause(this.id, 'mouseover2')" onmouseout="pause(this.id, 'mouseout2')" src="./m/elements/arrow right.png">
						</div>
					
						<ul class="jcarousel-list2" id="carousel2" onmouseover="pause('left', 'mouseover2'), pause('right', 'mouseover2')" onmouseout="pause('left', 'mouseout2'), pause('right', 'mouseout2')">
END;
				
							for($i = 1; $i <= $rows; $i++) //$rows
							{
								$row =  $foo_mysgli->mysql_fetch_row($result);//текущая строка таблицы
					
								$images = "./m/gallery/thum_" . $row[4];//путь к большому изображению товара
								echo <<<END
								<li style="float: left; list-style: none;"><img src="$images" onclick="document.choicegoods2.inputgoodsid.value='$row[3]'; document.choicegoods2.submit();" alt=""></li>
END;
							}
			
						echo <<<END
							<!--	<li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" jcarouselindex="1" style="float: left; list-style: none;"><img class="carousel__img" src="./Kidorable.com.ru_files/mdl_lotus_02(1).png" alt=""></li>-->
						</ul>
				
						<script>
							$(document).ready(function() {
								// Using default configuration
								$('#carousel2').carouFredSel();
 
								// Using custom configuration
								$('#carousel2').carouFredSel({
									width				: null,
									items               : 8,
									direction           : "left",
									prev                : "#cl_left2",
									next                : "#cl_right2",
									align				: "center",
									scroll : {
										items           : 3,
										easing          : "linear",
										duration        : 1000,
										pauseOnHover    : true
									},
									//synchronise: 		: ["#carousel", true, true, 0]
								});
							});
						</script>
        
					</div>				
END;
?>

<!--	<a href="#"
   onclick="this.href='https://vk.com/share.php?url='+window.location.href+window.location.hash+'&title='+document.title">
   <img src="./m/elements/vk_rus.png" alt="ВКонтакте"></a> -->
   
	<!--<section class="ss">
		<div class="subscriptiontxt"> Подписаться </div>
		<div class="vk">
			<script type="text/javascript">
				document.write(VK.Share.button(false,{type: "custom", text: "<img src=\"./m/elements/vk_rus.png\" width=\"32\" height=\"32\" />"}));
			</script>
		</div>
		
		<div class="fb">
			<a href="#"
				onclick="this.href='http://www.facebook.com/share.php?u='+window.location.href+window.location.hash">
			<img src="./m/elements/facebook.png" alt="Facebook" width=32 height=32></a>
		</div>
		
		<div class="tw">
			<a href="#" onclick="this.href='http://twitter.com/timeline/home?status='+document.title+'%20'+window.location.href+window.location.hash">
			<img src="./m/elements/twitter.png" alt="Twitter" width=32 height=32></a>
		</div> 
		
		<div class="subscription">
			<a href="#" onclick="return addSoc(1);" title="Twitter"><img src="./m/elements/twitter.png" width=32 height=32></a>
			<a href="#" onclick="return addSoc(2);" title="Facebook"><img src="./m/elements/facebook.png" width=32 height=32></a>
			<a href="#" onclick="return addSoc(3);" title="Vkontakte"><img src="./m/elements/vk_rus.png" width=32 height=32></a>
			<a href="#" onclick="return addSoc(4);" title="Одноклассники.ru"><img src="./m/elements/odnoklassniki.png" width=32 height=32></a>
			<a href="#" onclick="return addSoc(5);" title="livejournal"><img src="./m/elements/livejournal.png" width=32 height=32></a>
			<a href="#" onclick="return addSoc(6);" title="Яндекс"><img src="./m/elements/yandex.png" width=32 height=32></a>
			<a href="#" onclick="return addSoc(7);" title="Мой мир"><img src="./m/elements/mail.png" width=32 height=32></a>
		</div>
	</section> -->
	
	<?php
  $wall = file_get_contents("http://api.vk.com/method/wall.get?v=5.3&filter=others&domain=id124540301&count=5"); // Отправляем запрос
//  print_r($wall);
  $wall = json_decode($wall); // Преобразуем JSON-строку в массив
  $wall = $wall->response->items; // Получаем массив комментариев
  for ($i = 0; $i < count($wall); $i++) {
//    echo "<p><b>".($i + 1)."</b>. <i>".$wall[$i]->text."</i><br /><span>".date("Y-m-d H:i:s", $wall[$i]->date)."</span></p>"; // Выводим записи
  }
//  $new_wall = file_get_contents("http://api.vk.com/method/wall.post?v=5.3&ovner_id=-124540301&massage='Новая запись'");
//  print_r("new_wall = " . $new_wall);

?>

<?php
	if(isset($_GET['code']))
	{
		//sleep(1);
		//$code = $foo_mysgli->sanitizeMySQL($_GET['code']);
		$code = $_GET['code'];
//		print_r("code= " . $code);
//		echo "</br></br>";
		
		/*$access_token = file_get_contents("https://api.vk.com/oauth/access_token?client_id=4857278&client_secret=GccTw54ju21H0Y92QPFw&code=$code&redirect_uri=http://pajamas.esy.es/index.php"); // Отправляем запрос
		//print_r($access_token);
		$access_token = json_decode($access_token); // Преобразуем JSON-строку в массив
		//$access_token = $access_token->response->items; // Получаем массив комментариев
		//print_r($access_token);
		echo "</br></br>";
		foreach($access_token as $k=>$v){
			echo $k . ": " . $v . "</br></br>";
		}*/
		
//		echo <<<END
//		<a href="https://api.vk.com/oauth/access_token?client_id=4857278&client_secret=GccTw54ju21H0Y92QPFw&code=$code&redirect_uri=http://pajamas.esy.es/index.php">Получить access_token из VK</a>
//END;
		
		//echo "<script>authvkajx()</script>";
		//echo " access_token= <div id='access_token'></div>";
	} 
?>

<?php
	if(isset($_GET['access_token']))
	{
		
//		echo "</br></br>";
		$access_token = $_GET['access_token'];
//		print_r("access_token= " . $access_token);
//		echo "</br></br>";
		foreach($access_token as $k=>$v){
//			echo $k . ": " . $v . "</br></br>";
		}
	} 
?>

<?php
	if(isset($_GET['code']))
	{
		$code = $_GET['code'];
		$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "https://api.vk.com/oauth/access_token?client_id=4857278&client_secret=GccTw54ju21H0Y92QPFw&code=$code&redirect_uri=http://pajamas.esy.es/index.php");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_TIMEOUT, 30);
				curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
				/*curl_setopt($ch, CURLOPT_POSTFIELDS, array(
	
					"client_id"      =>   "4857278",
					"client_secret"          =>   "GccTw54ju21H0Y92QPFw",
					"code"        =>   "$code",
					"redirect_uri"        =>   "http://pajamas.esy.es/index.php"
						)); */
				$body = curl_exec($ch);
				curl_close($ch);
//				print_r("body= " . $body);
	}
?>
	
<?php
	$scope = 'offline,notes,nohttps';//65536 + 2048;	
/*	echo <<<END
		<a href="https://oauth.vk.com/authorize?v=5.29&client_id=4857278&redirect_uri=http://pajamas.esy.es/index.php&scope=$scope&display=page">Разрешить приложению Pajamas работать с моими данными из VK</a>
		</br></br>
END;
*/	
	if(isset($_GET['error']) || isset($_GET['error_description']))
	{
		$error = $_GET['error'];
		$error_description = $_GET['error_description'];
//		print_r("error= " . $error . "  " . "error_description: " . $error_description);
	}
?>

<?php
function authOpenAPIMember() { 
  $session = array(); 
  $member = FALSE; 
  $valid_keys = array('expire', 'mid', 'secret', 'sid', 'sig'); 
  $app_cookie = '';//$_COOKIE['vk_app_'.'4857278']; //APP_ID
  if ($app_cookie) { 
    $session_data = explode ('&', $app_cookie, 10); 
    foreach ($session_data as $pair) { 
      list($key, $value) = explode('=', $pair, 2); 
      if (empty($key) || empty($value) || !in_array($key, $valid_keys)) { 
        continue; 
      } 
      $session[$key] = $value; 
    } 
    foreach ($valid_keys as $key) { 
      if (!isset($session[$key])) return $member; 
    } 
    ksort($session); 

$sign = ''; 
    foreach ($session as $key => $value) { 
      if ($key != 'sig') { 
        $sign .= ($key.'='.$value); 
      } 
    } 
    $sign .= 'GccTw54ju21H0Y92QPFw';//APP_SHARED_SECRET; 
    $sign = md5($sign); 
    if ($session['sig'] == $sign && $session['expire'] > time()) { 
      $member = array( 
        'id' => intval($session['mid']), 
        'secret' => $session['secret'], 
        'sid' => $session['sid'] 
      ); 
    } 
  } 
  return $member; 
} 

$member = authOpenAPIMember(); 

if($member !== FALSE) { 
//  echo "Пользователь авторизован в Open API";/* Пользователь авторизован в Open API */ 
} else { 
//  echo "Пользователь не авторизован в Open API";/* Пользователь не авторизован в Open API */ 
}
?>


</br></br>
<div id="login_button" onclick="VK.Auth.login(authInfo);"></div>

<script language="javascript">
/*VK.init({
  apiId: '4871603'
  onlyWidgets: true
});
function authInfo(response) {
  if (response.session) {
    alert('user: '+response.session.mid);
  } else {
    alert('not auth');
  }
}
VK.Auth.getLoginStatus(authInfo);
VK.UI.button('login_button'); */
</script>

<!-- VK Widget -->
<!--<div id="vk_subscribe"></div>
<script type="text/javascript">
window.onload = function () {
 VK.init({apiId: 4871603, onlyWidgets: true});
 VK.Widgets.Subscribe('vk_subscribe', {mode: 1}, 300660605);
}
</script> -->
	
	<script>
			function addSoc(a) {
				h=encodeURIComponent(window.location.href+window.location.hash);
				t=encodeURIComponent(document.title);
				if(a==3)h='vkontakte.ru/share.php?url='+h+'&title='+t;
				else if(a==4)h='odnoklassniki.ru/dk?st.cmd=addShare&st.s=1000&st._surl='+h+'&tkn=3009';
				else if(a==5)h='www.livejournal.com/update.bml?mode=full&subject='+t+'&event='+h;
				else if(a==1)h='twitter.com/timeline/home?status='+t+'%20'+h;
				else if(a==2)h='www.facebook.com/share.php?u='+h;
				else if(a==6)h='wow.ya.ru/posts_share_link.xml?url='+h+'&title='+t;
				else if(a==7)h='connect.mail.ru/share?url='+h+'&title='+t+'&description=&imageurl=';
				else if(a==8)h='moikrug.ru/share?ie=utf-8&url='+h+'&title='+t+'&description=';
				else return;
				window.open('http://'+h,'Soc','screenX=100,screenY=100,height=500,width=500,location=no,toolbar=no,directories=no,menubar=no,status=no');
				return false;
			}
	</script>

</br></br></br></br>
<ul class="widgets">
	<li>
		<div class="sharetxt"> Поделиться </div>
	</li>
	<li>
		<div class="share">
			<a href="#" onclick="return addSoc(1);" title="Twitter"><img src="./m/elements/twitter.png"></a>
			<a href="#" onclick="return addSoc(2);" title="Facebook"><img src="./m/elements/facebook.png" width=32 height=32></a>
			<a href="#" onclick="return addSoc(3);" title="Vkontakte"><img src="./m/elements/vk_rus.png" width=32 height=32></a>
			<a href="#" onclick="return addSoc(4);" title="Одноклассники.ru"><img src="./m/elements/odnoklassniki.png" width=32 height=32></a>
			<a href="#" onclick="return addSoc(5);" title="livejournal"><img src="./m/elements/livejournal.png" width=32 height=32></a>
			<a href="#" onclick="return addSoc(6);" title="Яндекс"><img src="./m/elements/yandex.png" width=32 height=32></a>
			<a href="#" onclick="return addSoc(7);" title="Мой мир"><img src="./m/elements/mail.png" width=32 height=32></a>
		</div>
	</li>
	<li>
	<div class="g-plus" data-action="share" data-annotation="none"></div>
	</li>
</br></br>

</ul>


<?php
// переход в моб вер
	$idpostp = "";
	if(isset($idpost)){
		$idpostp = "&idpost=$idpost";
	}
	$myfooter = new myfooter($dirpajs, $idpostp);
	//$myfooter->__construct($dirpajs, $idpostp);
	$myfooter->foomyfooter();
?>

<?php
function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
	
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";
	$pattern = "";
	
	//$bname = 'Internet Explorer'; //эти две стр добавлены 30.10.15
   // $ub = "MSIE"; 

    //First get the platform?
	if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
		/*if (preg_match('/android/i', $u_agent)) {
			$system = 'Android';
		}*/
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
	$system = device($u_agent);
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE|like/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera|OPR/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
  /*  // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";} */
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern,
		'system'    => $system
    );	
} 

// now try it
//$ua=getBrowser();
//$yourbrowser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: " . " System - " . $ua['system'] . "<br >" . $ua['userAgent'];
//print_r($yourbrowser);

function device($u_agent)
{
	$user_agent = $u_agent; // взять USER_AGENT пользователя
 
	$oses = array ('Windows 95','Win95','Windows_95', 'Windows 98', 'Win98', 'Windows NT', 'winNT', 'Windows 2000', 'Windows XP', 'winXP', 'Windows ME', 'winME', 'OpenBSD', 'SunOS', 'Linux', 'Mac_PowerPC', 'Macintosh', 'QNX', 'BeOS', 'OS/2');
	foreach($oses as $os)
	{
		if (substr_count($user_agent, $os) > 0){
			if ($os == 'Linux' && preg_match('/android/i', $user_agent)) return TRUE;//Mobile
			return FALSE;//PC
		}
	}
	return TRUE;//Mobile
}
?>
	
</body>
</html>