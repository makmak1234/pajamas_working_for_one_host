<?php
$n = 0;
foreach($idarr as $k=>$v){
						$id = $v;
						$n += $nid[$k];
						$query = "SELECT * FROM pajamas1 WHERE id='$id'";
						$result = $foo_mysgli->mysql_query($query);
						$row = $foo_mysgli->mysql_fetch_row($result);
						$priceone = $row[$val] * $nid[$k];
						$priceall +=  $priceone;
}
$dirbasbi1 = $dirbasbi . "?" .session_name().'='.session_id();
echo <<<END
				<div class="goodsbasketfont">
					<img src="./elements/delete_16x16.png" class="goodsbasketclear" onclick="goodsbasketcheck('-1', 'FALSE', './')" title="Очистить корзину">
					<table class="m-cart-full" title="Оформить" onclick="movbigcart('$dirbasbi1')">
						<tr>
							<td>В корзине: $n товар<td>
						</tr>
END;
					echo <<<END
						<tr><td>К оплате: $priceall $prsite</td></tr>
					</table>
				</div>
				<script>
					function movbigcart(dirbasbi){
						//document.getElementById("idtest").innerHTML = "this.responseText";
						var query = dirbasbi;
						window.location.href= query;
					}
				</script>
END;
?>