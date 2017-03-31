<!DOCTYPE html>
<!-- saved from url=(0024)http://kidorable.com.ru/ -->
<html><head><meta content="text/html; charset=utf-8" http-equiv="Content-Type"><!--charset=utf-8-->

<!--<meta name="robots" content="index, follow">
<meta name="keywords" content="1С-Битрикс, CMS, PHP, bitrix, система управления контентом">
<meta name="description" content="Детская одежда Kidorable — это яркие, стильные и удивительно ноские вещи, которые обязательно понравятся маленьким модникам и модницам, а также их родителям!">-->

<title>Покупки клиентов</title>
<link href="buying_customers.css" type="text/css" rel="stylesheet">
</head>
<body>

<?php 

require_once 'authenticate.php';
//session_start();

echo <<<END
	</br>
	<a href="$dirbycus?buyingcust" id="buyingcust"> Покупки </a> &nbsp&nbsp&nbsp
	<a href="$dirbycus?salregistr" id="salregistr"> Зарегистрированные оптовики </a> &nbsp&nbsp&nbsp
	<a href="$dirpajs"> Вернуться в магазин</a>
	</br></br>
END;
$buyingcust = true;
if(isset($_GET["salregistr"])) $buyingcust = false;

if(isset($_GET["buyingcust"]) || $buyingcust){
	//cчитываем и выводим покупки клиентов
	$query = "SELECT * FROM clients ORDER BY orderclients DESC";
	$result = $foo_mysgli->mysql_query($query);
	if($result)$rows = $foo_mysgli->mysql_num_rows($result);
	else die("Покупок нет");
	//print_r("rows= " . $rows);
	echo <<<END
	<script>
		document.getElementById("buyingcust").style.color = "#0f0";
	</script>
	<table class="basketbig">
		<tr>
			<th>Номер заказа</th>
			<th>Дата</th>
			<th>Время</th>
			<th>Имя фамилия</th>
			<th>Город</th>
			<th>Телефон</th>
			<th>email</th>
			<th>Цена текущая</th>
			<th>Цена по которой купили</th>
		</tr>
END;
for($i = 0; $i < $rows; $i++){
	//print_r("rows= " . $rows);
	//print_r("i= " . $i);
	$row = $foo_mysgli->mysql_fetch_row($result);
	$valbuy = $row[10];
	if($valbuy == 2) $prsite = $valuta[0];
	if($valbuy == 7) $prsite = $valuta[1];
	if($valbuy == 8) $prsite = $valuta[2];
	if($valbuy == 9) $prsite = $valuta[3];
	echo <<<END
		<tr>
			<td>$row[0]</td>
			<td>$row[1]</td>
			<td>$row[2]</td>
			<td>$row[3]</td>
			<td>$row[4]</td>
			<td>$row[5]</td>
			<td>$row[6]</td>
		
END;
	//выбор id покупок, названия, кол-во
	$idarr = explode(" ", $row[8]);
	$nid = explode(" ", $row[9]);
	echo <<<END
			<td>
				<table class = "goods">
END;
				//$query = "SELECT * FROM pajamas1";
				//$result = mysql_query($query);
				//$rows = mysql_fetch_row($result);
				$priceall = 0; 
				for($j = 0; $j < count($idarr); $j++){
					$query = "SELECT * FROM pajamas1 WHERE id = '$idarr[$j]'";
					$resultitem = $foo_mysgli->mysql_query($query);
					$rowitem = $foo_mysgli->mysql_fetch_row($resultitem);
					//$row0 = mysql_result ($result, j, "item");
					//$row2 = mysql_result ($result, j, "price");
					$priceone = $rowitem[$valbuy] * $nid[$j];
					$priceall += $priceone;
					echo <<<END
					<tr>
						<td>$rowitem[0]</td>
						<td>$rowitem[$valbuy] $prsite x $nid[$j] шт = $priceone $prsite</td>
					</tr>
END;
				}
				echo <<<END
					<tr>
						<td colspan="2" color='red'>К оплате: $priceall $prsite </td>
					</tr>
				</table>
			</td>
			<td>
				<table class="goods2">
END;
				//$query = "SELECT * FROM pajamas1";
				//$result = mysql_query($query);
				//$rows = mysql_fetch_row($result);
				$priceall = 0;
				$query2 = "SELECT * FROM buyclients WHERE orderclients = '$row[0]'";	
				$resultitem = $foo_mysgli->mysql_query($query2);
				$rows2 = $foo_mysgli->mysql_num_rows($resultitem);
				for($j = 0; $j < $rows2; $j++){
					$rowitem2 =  $foo_mysgli->mysql_fetch_row($resultitem);//текущая строка таблицы
					//$row0 = mysql_result ($result, j, "item");
					//$row2 = mysql_result ($result, j, "price");
					$priceone2 = $rowitem2[2] * $rowitem2[3];
					$priceall += $priceone2;
					echo <<<END
					<tr>
						<td style="color: #f00;">$rowitem2[1]</td>
						<td style="color: #f00;">$rowitem2[2] $rowitem2[4] x $rowitem2[3] шт = $priceone2 $rowitem2[4]</td>
					</tr>
END;
				}
				echo <<<END
					<tr>
						<td colspan="2" style="color: #f00;">К оплате: $priceall $rowitem2[4] </td>
					</tr>
				</table>
			</td>
		</tr>
END;
}
echo <<<END
	</table>
END;
}

if(isset($_GET["salregistr"])){
	//cчитываем и выводим покупки клиентов
	$query = "SELECT * FROM salclients ORDER BY orderclients DESC";
	$result = $foo_mysgli->mysql_query($query);
	if($result)$rows = $foo_mysgli->mysql_num_rows($result);
	else die("Покупок нет");
	//print_r("rows= " . $rows);
	echo <<<END
	<script>
		document.getElementById("salregistr").style.color = "#0f0";
	</script>
	<table class="basketbig">
		<tr>
			<th>Номер заказа</th>
			<th>Дата</th>
			<th>Время</th>
			<th>Имя фамилия</th>
			<th>Город</th>
			<th>Телефон</th>
			<th>email</th>
			<th>Пароль для опта</th>
		</tr>
END;
for($i = 0; $i < $rows; $i++){
	//print_r("rows= " . $rows);
	//print_r("i= " . $i);
	$row = $foo_mysgli->mysql_fetch_row($result);
	echo <<<END
		<tr>
			<td>$row[0]</td>
			<td>$row[1]</td>
			<td>$row[2]</td>
			<td>$row[3]</td>
			<td>$row[4]</td>
			<td>$row[5]</td>
			<td>$row[6]</td>
			<td>$row[7]</td>
		</tr>
END;
	
}
echo <<<END
	</table>
END;
}

	echo <<<END
	</br></br>
	<a href="$dirpajs"> Вернуться в магазин</a>
END;
?>