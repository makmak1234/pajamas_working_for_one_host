<?php
require_once 'basketbigclass.php';
$basketbig = new basketbig();
$basketbig->basketbigunated();

/*class basketbig{
	protected $priceall = 0;
	protected $price = array();
	protected $row2all = array();
	protected $idarr = array();
	protected $nid = array();
	protected $namesurname = ""; 
	protected $city = "";
	protected $tel = "";
	protected $email = "";
	//$id = "";
	protected $telques = "";
	protected $prsite, $val, $myconst, $dirpajs, $dircook, $dirthan;
	
	function __construct(){
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Дата в прошлом
		
//header("Location: http://127.0.0.1/Pajamas/basketbig.php");
		require_once 'login.php';
		$this->myconst  = new myconst;
		$this->prsite = $this->myconst->prsite;
		$this->val = $this->myconst->val;
		$this->foo_mysgli = $this->myconst->foo_mysgli;
		$this->dirpajs = $this->myconst->dirpajs;
		$this->dircook = $this->myconst->dircook;
		$this->dirthan = $this->myconst->dirthan;

		if(isset($_GET['PHPSESSID'])){
			session_id($_GET['PHPSESSID']);
		}

		session_start();

		//require_once 'login.php';
?>
		<!DOCTYPE html>
		<html>
		<head>

		<title>Пижамки</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>

		<link href="./m/elements/1419281141_363179.ico" rel="shortcut icon" type="image/x-icon" />

		<script language="javascript" type="text/javascript"  src="myscript/basketbigclear1.js">
		</script>

		<script language="javascript" type="text/javascript"  src="myscript/basketbigclear.js">
		</script>

		<script language="javascript" type="text/javascript"  src="myscript/backtoshopping.js">
		</script>

		<link href="basketbig.css" type="text/css" rel="stylesheet">
		</head>
		<body>
<?php

		if(isset($_SESSION["namesurname"])){
			$this->namesurname = $_SESSION["namesurname"];
			$this->city = $_SESSION["city"];
			$this->tel = $_SESSION["tel"];
			$this->email = $_SESSION["email"];
		}

		if(isset($_GET["telques"])){
			$this->telques = $foo_mysgli->sanitizeMySQL($_GET["telques"]);
			if($this->telques == 1) $this->telques = "Введите пожайлуста номер телефона для связи с вами";
			//echo "Введите пожайлуста номер телефона для связи с вами";
		}			


		if(isset($_SESSION["idbasketsmall"])){
			$this->idarr = $_SESSION["idbasketsmall"];
			$this->nid = $_SESSION["nid"];
		}
	
	
		if(isset($_POST["buyid"])){
			$id = $foo_mysgli->sanitizeMySQL($_POST["buyid"]);
			if(!(in_array($id, $this->idarr))){//наличие значения в массиве
				$this->idarr[] = $id;
				$this->nid[] = 1;	
			}
		//$idarr[] = $id;
		//$nid[] = 1;
		//$_GET = array();
		}
	}
	
	function basketbigunated(){
	
		if(count($this->idarr) == 0){
			echo "Корзина пуста ";
		}
		else{
			echo <<<END
			<div class="youitems">Ваши покупки</div>
			<div id="iddivbasketbig"><!--</div>--!>
END;
			require_once 'basketbigunated.php';
			echo <<<END
			</div>
END;
		}
		$this->persinfo();
		
		$_SESSION["idbasketsmall"] = $this->idarr;
		$_SESSION["nid"] = $this->nid;
	}
	
	function persinfo(){
		echo <<<END
			</br>
			<a class="backtoshopping" onclick="backtoshopping('$this->dirpajs')"> Вернуться к покупкам</a><br/><br/>
			<!--?namesurname= document.personaldata.namesurname.value &city=document.personaldata.city.value &tel= document.personaldata.tel.value &email=document.personaldata.email.value-->
		
			<div class="youitems">Оформление заказа</div><br/>
			<form class="youitemsform" name="youitemsform" action="$this->dirthan" method="POST">
			
				<table name="personaldata" class="personaldata" cellspacing="7">
					<tr>
					
						<td><input id="namesurname" type="text" name="namesurname" value="$this->namesurname" placeholder="Имя и фамилия" maxlength=30 /></td>
					</tr>
					<tr>
					
						<td><input id="city" type="text" name="city" value="$this->city" placeholder="Город" maxlength=30 /></td>
					</tr>
					<tr>
					
						<td><input id="tel" type="tel" name="tel" value="$this->tel" placeholder="Моб телефон" maxlength=30 required /></td>
					</tr>
					<tr>
					
						<td><input id="email" type="email" name="email" value="$this->email" placeholder="email" maxlength=30 /></td>
					</tr>
					<tr>
						<td colspan="1" class="telques">$this->telques<td/>
					</tr>
					<tr>
						<td><input colspan="2" type="hidden" name="formsubmit" /><input type="submit" value="Готово" /></td>
						<!--<td><input type="submit" value="Готово" /></td>-->
					</tr>
				</table>
			</form>
		
			<div id="idback"></div>
	</body>
	</html>	
END;
		if(isset($_SESSION["valpass"])){
			echo <<<END
			<script>
				document.youitemsform.namesurname.placeholder = "Организация";
			</script>
END;
		}
	}

	function basketbigclear1(){
		$priceall = 0;
		$namesurname = ""; 
		$city = "";
		$tel = "";
		$email = "";
		$id = "";

		if(isset($_GET["idclear1"])){
			$idclear = $foo_mysgli->sanitizeMySQL($_GET["idclear1"]);
			print_r('idclear: ');
			print_r($idclear); print_r('<br>');
			$id = $idclear;
			$k = $foo_mysgli->sanitizeMySQL($_GET["kgoods1"]);
			$this->idarr = $_SESSION["idbasketsmall"];
			$this->nid = $_SESSION["nid"];
			print_r('idarr: ');
			print_r($this->idarr); print_r('<br>');
			print_r('nid: ');
			print_r($this->nid); print_r('<br>');
			foreach($this->idarr as $k=>$v){
				print_r('k: ');
				print_r($k); print_r('<br>');
					if($v == $id){
						print_r('idarr before: ');
						print_r($this->idarr); print_r('<br>');
							array_splice($this->idarr, $k, 1);
							array_splice($this->nid, $k, 1);
						print_r('idarr after: ');
						print_r($this->idarr); print_r('<br>');
						print_r('nid after: ');
						print_r($this->nid); print_r('<br>');
					}	
			}
			$idarrnumber = count($this->idarr);
			if($idarrnumber == 0){
				destroy_session_and_data();
				echo "Корзина пуста ";
				//echo"<a href='http://127.0.0.1/Pajamas/Pajamas.php'> Вернуться к покупкам</a>";
				//echo "Вернуться к покупкам";
				exit();
			}
			
			require_once 'basketbigunated.php';
		
			$_SESSION["idbasketsmall"] = $this->idarr;
			$_SESSION["nid"] = $this->nid;

			print_r('idarr after sess: ');
			print_r($this->idarr); print_r('<br>');
			print_r('nid after sess: ');
			print_r($this->nid); print_r('<br>');	
		}
		
	//header('location:' . $_SERVER['PHP_SELF']);

	}
	
	function destroy_session_and_data()
	{	
		$_SESSION = array();
		if (session_id() != "" || isset($_COOKIE[session_name()]))
		setcookie(session_name(), '', time() - 2592000, '/');
		session_destroy();
	}

}*/
?>