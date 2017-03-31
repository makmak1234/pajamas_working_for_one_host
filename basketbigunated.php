<?php 
//print_r('basketbigunated');
echo <<<END
<table class="basketbig" id="idbasketbig">
		<tr>
			<th></th>		
			<th>Цена 1-го $this->prsite</th>
			<th>Кол-во</th>
			<th>Цена всего $this->prsite</th>
		</tr>
END;
		foreach($this->idarr as $k=>$v){
			$id = $v;
			$query = "SELECT * FROM pajamas1 WHERE id='$id'";//row2all idarr nid namesurname city tel id telques prsite
				$result = $this->foo_mysgli->mysql_query($query);
				$row = $this->foo_mysgli->mysql_fetch_row($result);
				$pri[$k] = $row[$this->val];
		}
		//$pri_js = json_encode($pri);
		$itemnumber = count($this->idarr);
		foreach($this->idarr as $k=>$v){
			$idtr = "idtr" . $k;
			$idtd = "pricegoods" . $k;
			$idnidk = "idnidk" . $k;
			$idrowk = "idrowk" . $k;
			$idrow2 = "idrow2" . $k;
			$id = $v;
			$query = "SELECT * FROM pajamas1 WHERE id='$id'";
				$result = $this->foo_mysgli->mysql_query($query);
				$row = $this->foo_mysgli->mysql_fetch_row($result);	
			$this->priceall +=$this->nid[$k]*$row[$this->val];
			$images = "./m/gallery/thum_" . $row[4];//путь к больш изображению товара
			//basketbigjs1($row[2], this.value, $k, $itemnumber)
			$rowtmp = $row[$this->val];
			$nidtmp = $this->nid[$k];
			echo <<<END
			<tr id="$idtr">
				<td class="goodsimg"> <img src="$images" alt=""></br>$row[0] </td>			
				<td id="$idrow2"> $rowtmp </td>
				<td id="$idnidk"><input type="number" min="1" max="99" name="numbergoods" value="$nidtmp" onchange="basketbigclear($rowtmp, this.value, $k, $itemnumber)"/></td>
END;
				$rowk = $row[$this->val]*$this->nid[$k];
				echo <<<END
				<td><div id="$idrowk">$rowk</div></br><img src="./m/elements/delete_16x16.png" class="goodsbasketclearone" onclick="basketbigclear1($row[3], $idtr, $k)">
				<!--<a href="basketbigclear1.php?idclear1=$row[3]&kgoods1=$k"><button>Отладка</button></a>--!>
				</td>
			
			</tr>
END;
		}
			echo <<<END
			<tr>
				<td colspan="4"><span id="priceall" class="priceall">К оплате всего: $this->priceall </span><span class="priceall"> $this->prsite</span></td>
			</tr>
		</table>
END;

?>
