<?php
echo <<<END
					<table class="goodsbasketfont m-cart-full">
						<tr><td colspan= "4">Ваша корзина:<td></tr>
						<tr>
							<th>Товар</th>
							<th>Цена за ед</th>
							<th>Кол-во</th>
							<th>Цена за все</th>
							<th></th>
						</tr>
END;
					foreach($idarr as $k=>$v){
						$id = $v;
						$n = $nid[$k];
						$query = "SELECT * FROM pajamas1 WHERE id='$id'";
						$result = $foo_mysgli->mysql_query($query);
						$row = $foo_mysgli->mysql_fetch_row($result);
						$priceone = $row[$val] * $n;
						$priceall +=  $priceone;
						echo <<<END
						<tr>
							<td>$row[0]</td>
							<td>$row[$val]</td>
							<td>$n</td>
							<td>$priceone</td>
							<td><img src="./m/elements/delete_16x16.png" class="goodsbasketclearone" onclick="goodsbasketcheck($row[3], 'TRUE', '')"></td>
						</tr>
END;
		
					}
					echo <<<END
						<tr><td colspan= "5">К оплате: $priceall $prsite</td></tr>
						<tr>
							<td colspan= "3"><a class="buylab" href="$dirbasbi">Оформить</a></td>
							<td colspan= "2"><label class="goodsbasketclear" onclick="goodsbasketcheck('-1', 'FALSE', '')"><input type="hidden" />Очистить корзину</label></td>
						</tr>
					</table>
END;
?>