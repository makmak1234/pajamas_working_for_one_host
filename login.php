<?php 

//открываем базу данных
//if(!db_server)
//{
	global $db_hostname;
	global $db_database;
	global $db_username;
	global $db_password;
	$db_hostname = 'pajamas_one.home';//'mysql.hostinger.com.ua';
	$db_database = 'pajamas_one';//'u742892412_pajam';
	$db_username = 'root';//'u742892412_pajam';
	$db_password = '8585';//'SFgU9CO';
	
	define("COOK_LOCATION", "pajamas_one.home");//http://pajamas.home/
	define("ROOT_LOCATION", "http://pajamas_one.home/");// http://pajamas.esy.es/
	define("M_LOCATION", "http://pajamas_one.home/indexm.php");//http://m.pajamas.esy.es  http://pajamas_one.home/m
	$dirgaupl = ROOT_LOCATION . "gallery_upload.php";
	$dirbycus = ROOT_LOCATION . "buying_customers.php";
	$dirpajs = ROOT_LOCATION . "";//"pajamas.php";
	$dirbasbi = ROOT_LOCATION . "basketbig.php";
	$dirthan = ROOT_LOCATION . "thankyou.php";
	$dirthan2 = ROOT_LOCATION . "thankyou2.php";
	$dirbsbigcl = ROOT_LOCATION . "basketbigclear.php";
	//$directory = "http://127.0.0.1/Pajamas/";
	$dircook = COOK_LOCATION;
	$dirpajsm = M_LOCATION; //"";
	$dirpajs_m = M_LOCATION;// "m/";//"pajamas.php";
	
	$exchrt = 2.5; //руб/грн
	$factor = 1.2; //розница/опт
	$exchrtus = 1; //использовать руб/грн = 1
	$factorus = 1; //использовать розница/опт = 1
	$prsitem = 8; //показывать в грн опт = 2, руб опт = 7, грн розн = 8, руб розн = 9
	$valuta = array ("грн опт", "руб опт", "грн розн", "руб розн");
	
	
	class myconst{
		
		protected $db_hostname = 'pajamas_one.home';//'mysql.hostinger.com.ua';
		protected $db_database = 'pajamas_one';//'u742892412_pajam';
		protected $db_username = 'root';//'u742892412_pajam';
		protected $db_password = '8585';//'SFgU9CO';
		
		public $exchrt = 2.5; //руб/грн
		public $factor = 1.2; //розница/опт
		public $exchrtus = 1; //использовать руб/грн = 1
		public $factorus = 1; //использовать розница/опт = 1
		public $prsitem = 8; //показывать в грн опт = 2, руб опт = 7, грн розн = 8, руб розн = 9
		public $valuta = array ("грн опт", "руб опт", "грн розн", "руб розн");
		public $val;
		
		public $dirgaupl;
		public $dirbycus;
		public $dirpajs;
		public $dirbasbi;
		public $dirthan;
		public $dirthan2;
		public $dirpajsm;
		public $dirpajs_m;
		public $dircook;
		public $dirbsbigcl;

		const M_LOCATION = "http://pajamas_one.home/indexm.php";//"http://m.pajamas.esy.es";
		const ROOT_LOCATION = "http://pajamas_one.home/";//"http://pajamas.esy.es/";
		const COOK_LOCATION = "http://pajamas_one.home/";//"pajamas.esy.es";
		public $foo_mysgli;
		
		function __construct(){
			//define("ROOT_LOCATION", "http://127.0.0.1/Pajamas/");
			$this->dirgaupl = self::ROOT_LOCATION . "gallery_upload.php";
			$this->dirbycus = self::ROOT_LOCATION . "buying_customers.php";
			$this->dirpajs = self::ROOT_LOCATION . "";//"pajamas.php";
			$this->dirbasbi = self::ROOT_LOCATION . "basketbig.php";
			$this->dirthan = self::ROOT_LOCATION . "thankyou.php";
			$this->dirthan2 = self::ROOT_LOCATION . "thankyou2.php";
			$this->dirbsbigcl = self::ROOT_LOCATION . "basketbigclear.php";
			//$directory = "http://127.0.0.1/Pajamas/";
			$this->dircook = self::COOK_LOCATION;
			$this->dirpajsm = self::M_LOCATION; // ""; 
			$this->dirpajs_m = self::M_LOCATION; //. "m/";//"pajamas.php";
			
			$foo_mysgli = new foo_mysgli($this->db_hostname, $this->db_username, $this->db_password, $this->db_database);
			$this->foo_mysgli = $foo_mysgli;
			//$foo_mysgli->myconstruct($this->db_hostname, $this->db_username, $this->db_password, $this->db_database);
	
			//создать таблицу настроек контента сайта		
			$query = "CREATE TABLE pajset (exchrt FLOAT(3,1) UNSIGNED,
										factor FLOAT(3,2) UNSIGNED,
										exchrtus TINYINT(1),
										factorus TINYINT(1),
										prsite TINYINT(1),
										id INT(11) AUTO_INCREMENT KEY) ENGINE MyISAM";
			$result = $foo_mysgli->mysql_query($query);
		
			if($result){
				$query = "INSERT INTO pajset VALUES ('$exchrt' , '$factor' , '$exchrtus' , '$factorus', '$prsitem', 1)";
				$result = $foo_mysgli->mysql_query($query);
				if(!$result) die ("Сбой при доступе первичная запись в pajset: " . $foo_mysgli->mysql_error());
			}
			$query = "SELECT * FROM pajset";
			$result = $foo_mysgli->mysql_query($query);
			if(!$result) die ("Сбой при доступе в pajset1: " . $foo_mysgli->mysql_error());
			//$rows = $foo_mysgli->mysql_num_rows($result);
			$row = $foo_mysgli->mysql_fetch_row($result);//текущая строка таблиц
			//выбор отображаемой валюты-------------------------------------------------------
			// столбец в базе: 2-опт грн 7-опт руб 8-розн грн 9-розн руб
			$this->val = $row[4];
			if(isset($_SESSION["valcook"])){
				if($_SESSION["valcook"] == '1'){
					if($this->val == 8) $this->val = 2;
					if($this->val == 9) $this->val = 7;
				}
			}
			if($this->val == 2) $this->prsite = $this->valuta[0];
			if($this->val == 7) $this->prsite = $this->valuta[1];
			if($this->val == 8) $this->prsite = $this->valuta[2];
			if($this->val == 9) $this->prsite = $this->valuta[3];
		
			$foo_mysgli->mysql_query ("set_client='utf8'");
			$foo_mysgli->mysql_query ("set character_set_results='utf8'");
			$foo_mysgli->mysql_query ("set collation_connection='utf8_general_ci'");
			$foo_mysgli->mysql_query ("SET NAMES utf8");
		}
	}

	$foo_mysgli = new foo_mysgli($db_hostname, $db_username, $db_password, $db_database);
	
	//создать таблицу настроек контента сайта		
		$query = "CREATE TABLE pajset (exchrt FLOAT(3,1) UNSIGNED,
										factor FLOAT(3,2) UNSIGNED,
										exchrtus TINYINT(1),
										factorus TINYINT(1),
										prsite TINYINT(1),
										id INT(11) AUTO_INCREMENT KEY) ENGINE MyISAM";
		$result = $foo_mysgli->mysql_query($query);
		
		if($result){
				$query = "INSERT INTO pajset VALUES ('$exchrt' , '$factor' , '$exchrtus' , '$factorus', '$prsitem', 1)";
				$result = $foo_mysgli->mysql_query($query);
				if(!$result) die ("Сбой при доступе первичная запись в pajset: " . $foo_mysgli->mysql_error());
		}
		$query = "SELECT * FROM pajset";
		$result = $foo_mysgli->mysql_query($query);
		if(!$result) die ("Сбой при доступе в pajset2: " . $foo_mysgli->mysql_error());
		//$rows = $foo_mysgli->mysql_num_rows($result);
		$row = $foo_mysgli->mysql_fetch_row($result);//текущая строка таблиц
//выбор отображаемой валюты-------------------------------------------------------
// столбец в базе: 2-опт грн 7-опт руб 8-розн грн 9-розн руб
		$val = $row[4];
		if(isset($_SESSION["valcook"])){
				if($_SESSION["valcook"] == '1'){
					if($val == 8) $val = 2;
					if($val == 9) $val = 7;
				}
		}
		if($val == 2) $prsite = $valuta[0];
		if($val == 7) $prsite = $valuta[1];
		if($val == 8) $prsite = $valuta[2];
		if($val == 9) $prsite = $valuta[3];
		
$foo_mysgli->mysql_query ("set_client='utf8'");
$foo_mysgli->mysql_query ("set character_set_results='utf8'");
$foo_mysgli->mysql_query ("set collation_connection='utf8_general_ci'");
$foo_mysgli->mysql_query ("SET NAMES utf8");

class foo_mysgli extends mysqli{
	
	function __construct($db_hostname, $db_username, $db_password, $db_database){
		parent::__construct($db_hostname, $db_username, $db_password, $db_database);
	}
	function mysql_query($query){
		return $this->query($query);
	}
	function mysql_num_rows($result){
		return $result->num_rows;
	}
	function mysql_data_seek($result, $n){
		return $result->data_seek($n);
	}
	function mysql_fetch_row($result){
		return $result->fetch_row();
	}
	function mysql_error($result){
		return $this->error;
	}
	function mysql_result($result, $n, $column){
		$result->data_seek($n);
		$row = $result->fetch_assoc();

		return  $row[$column];// = $result->fetch_field();//$row[$column];
	}
	function sanitizeString($var)
	{
		if (get_magic_quotes_gpc()) $var = stripslashes($var);
		$var =  htmlspecialchars($var);
		$var = strip_tags($var);
		return $var;
	}
	function sanitizeMySQL($var)
	{
		//$var = $foo_mysgli->mysql_real_escape_string($var);
		$var = $this->real_escape_string($var);
		$var = $this->sanitizeString($var);
		return $var;
	}
}

?>	
