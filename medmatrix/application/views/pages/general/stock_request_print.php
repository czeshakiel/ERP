<div>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;">
		<?php
		$x=1;
		foreach($body as $item){
			$desc=str_replace('ams-','',$item['description']);
			$desc=str_replace('-med','',$desc);
			$desc=str_replace('-sup','',$desc);
			$desc=str_replace('cmshi-','',$desc);
			$lastdate=$this->General_model->getRequestLastDate($item['code'],$item['reqdept'],$item['reqdate']);
			if($item['generic']==""){
				$generic="";
			}else{
				$generic="(".$item['generic'].")<br>";
			}
			echo "<tr>";
			echo '<td align="center" width="5%">'.$x.'.</td>';
			echo '<td align="center" width="5%">'.$item['prodqty'].'</td>';
			echo '<td width="65%">'.$generic.$desc.'</td>';
			echo '<td width="25%">'.$lastdate['reqdate'].'</td>';
			echo "</tr>";
			$x++;
		}
		?>
	</table>
</div>
<br><br><br><br><br><br>
<div>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size:10px;font-weight:bold;">
		<tr>
			<td colspan="3" style="border-top:1px solid black;">&nbsp;</td>
		</tr>
		<tr>
			<td width="35%">Requested by:_________________________</td>
			<td width="35%">Received by:_________________________</td>
			<td width="30%">Approved by:_______________________</td>
		</tr>
	</table>
</div>
