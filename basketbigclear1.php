<?php
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Дата в прошлом

//session_start();

//require_once 'login.php';

//echo "<link href='basketbig.css' type='text/css' rel='stylesheet'>";


//это удаление
require_once 'basketbigclass.php';

$basketbig = new basketbig();
$basketbig->basketbigclear1();


/*$priceall = 0;
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
		$this->basketbig->idarr = $_SESSION["idbasketsmall"];
		$this->basketbig->nid = $_SESSION["nid"];
		print_r('idarr: ');
		print_r($this->basketbig->idarr); print_r('<br>');
		print_r('nid: ');
		print_r($this->basketbig->nid); print_r('<br>');
		foreach($this->basketbig->idarr as $k=>$v){
			print_r('k: ');
			print_r($k); print_r('<br>');
				if($v == $id){
					print_r('idarr before: ');
					print_r($this->basketbig->idarr); print_r('<br>');
						array_splice($this->basketbig->idarr, $k, 1);
						array_splice($this->basketbig->nid, $k, 1);
					print_r('idarr after: ');
					print_r($this->basketbig->idarr); print_r('<br>');
					print_r('nid after: ');
					print_r($this->basketbig->nid); print_r('<br>');
				}	
		}
		$idarrnumber = count($this->basketbig->idarr);
		if($idarrnumber == 0){
			destroy_session_and_data();
			echo "Корзина пуста ";
			//echo"<a href='http://127.0.0.1/Pajamas/Pajamas.php'> Вернуться к покупкам</a>";
			//echo "Вернуться к покупкам";
			exit();
		}
		
		require_once 'basketbigunated.php';
	
		$_SESSION["idbasketsmall"] = $this->basketbig->idarr;
		$_SESSION["nid"] = $this->basketbig->nid;

		print_r('idarr after sess: ');
		print_r($this->basketbig->idarr); print_r('<br>');
		print_r('nid after sess: ');
		print_r($this->basketbig->nid); print_r('<br>');	
	}
	
//header('location:' . $_SERVER['PHP_SELF']);
	
	function destroy_session_and_data()
	{	
		$_SESSION = array();
		if (session_id() != "" || isset($_COOKIE[session_name()]))
		setcookie(session_name(), '', time() - 2592000, '/');
		session_destroy();
	}*/
?>