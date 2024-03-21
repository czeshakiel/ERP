<table width="100%" border="1" cellpadding="4" cellspacing="0" style="font-size:9px;">
	<tr>
		<td align="center" width="32%"><b>CHARGES</b></td>
		<td align="center" width="17%"><b>ACTUAL</b></td>
		<td align="center" width="17%"><b>PHIC</b></td>
		<td align="center" width="17%"><b>HMO</b></td>
		<td align="center" width="17%"><b>EXCESS</b></td>
	</tr>
	<?php
	$hactual=0;
	$hphic=0;
	$hhmo=0;
	$hexcess=0;
	$discount=0;
	$texcess=0;
	$gross=0;
	$hmo=0;
	$excess=0;
	// foreach($items as $item){
	// 	if($item['productsubtype'] != "PROFESSIONAL FEE"){
	// 		$hactual += $item['gross'] + $item['adjustment'];
	// 		$discount +=$item['adjustment'];
	// 		$hphic += $item['phic'];
	// 		$hexcess += $item['excess'];
	// 		$gross = number_format($item['gross'] + $item['adjustment'],2);
	// 		$texcess += $item['adjustment'];
	// 		$excess=number_format($item['adjustment']+$item['gross']-$item['hmo'],2);
	// 		if($item['hmo'] > 0){
	// 			$hmo=$item['hmo'];
	// 			$hhmo += $item['hmo'];				
	// 		}else{
	// 			$hmo=$item['excess'];
	// 			$hhmo += $item['excess'];
	// 			$excess=0;
	// 			$hexcess=0;				
	// 		}			

	// 		echo "<tr>";
	// 			echo "<td align='left'>$item[productdesc]</td>";
	// 			echo "<td align='right'><b>$gross</b></td>";
	// 			echo "<td align='right'><b>$item[phic]</b></td>";
	// 			echo "<td align='right'><b>$hmo</b></td>";
	// 			echo "<td align='right'><b>$excess</b></td>";
	// 		echo "</tr>";
	// 	}
	// }
	$hactual=0;
	$hphic=0;
	$hhmo=0;
	$hexcess=0;
	$discount=0;
	$texcess=0;
	$cn=explode('-',$caseno);	
	if($cn[0]=="R"){
		$items1=$this->Hmo_model->db->query("SELECT * FROM soahmo WHERE hmo='$hmo_desc' AND accounttitle='HEMODIALYSIS'");
	}else{
		$items1=$this->Hmo_model->db->query("SELECT * FROM soahmo WHERE hmo='$hmo_desc' AND accounttitle <> 'HEMODIALYSIS'");
	}	
	$res=$items1->result_array();
	foreach($res as $item){		
		$query=$this->Hmo_model->db->query("SELECT * FROM soahmodetails WHERE accounttitle_id='$item[id]' AND status='1'");
		$result=$query->result_array();
			$gross=0;
			$hmo=0;
			$excess=0;
			$phic=0;
		foreach($result as $row){			
			if($row['accounttitle']=="PHARMACY/SUPPLIES" && $item['accounttitle']=="LABORATORY"){
				$qry=$this->Hmo_model->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype='$row[accounttitle]' AND terminalname <> 'pending' AND  administration <> 'pending' AND (productdesc LIKE '%MICROSET%' AND productdesc LIKE '%INSYTE%') AND trantype='charge'");
			}else if($row['accounttitle']=="MISCELLANEOUS" && $item['accounttitle']=="SYRINGE"){
				$qry=$this->Hmo_model->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype='$row[accounttitle]' AND terminalname <> 'pending' AND  administration <> 'pending' AND productdesc LIKE '%SYRINGE IVTT%' AND trantype='charge'");
			}else if($row['accounttitle']=="MISCELLANEOUS" && $item['accounttitle']=="PULMO AIDE"){
				$qry=$this->Hmo_model->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype='$row[accounttitle]' AND administration <> 'pending' AND productdesc LIKE '%NEBULIZATION%' AND trantype='charge'");
			}else if($item['accounttitle']=="OR FEE"){
				$qry=$this->Hmo_model->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype='$row[accounttitle]' AND trantype='charge'");
			}else{
				if($cn[0]=="R"){
					$qry=$this->Hmo_model->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype='$row[accounttitle]' AND trantype='charge'");
				}else{
					$qry=$this->Hmo_model->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype='$row[accounttitle]' AND ((terminalname <> 'pending' AND  administration <> 'pending')) AND trantype='charge'");
				}
				
			}			
			$amount1=$qry->result_array();
			foreach($amount1 as $amount){
				if($row['accounttitle']=="PHARMACY/SUPPLIES" && $item['accounttitle']=="SYRINGE"){
					$srp=62.5;
					$discount += $amount['adjustment'];
					$phic += $amount['phic'];
					$hexcess += $amount['excess'];
					$gross += $srp * $amount['quantity'];			
					//$excess +=($srp * $amount['quantity']);
					if($amount['hmo'] > 0){
						$hmo +=0;
						$phic += ($srp * $amount['quantity']);						
						$excess +=0;
					}else{
						$hmo +=($srp * $amount['quantity']);			
						$excess +=($srp * $amount['quantity']);
					}
				}else if($row['accounttitle']=="MISCELLANEOUS" && $item['accounttitle']=="PULMO AIDE"){
					$srp=187.5;
					$discount += $amount['adjustment'];
					$phic += $amount['phic'];
					$hexcess += $amount['excess'];
					$gross += $srp * $amount['quantity'];			
					$excess +=($srp * $amount['quantity'])-$amount['hmo'];
					if($amount['hmo'] > 0){
						$hmo +=0;
						$phic +=($srp * $amount['quantity']);
						$excess +=0;
					}else{
						$hmo +=($srp * $amount['quantity']);			
						$excess +=($srp * $amount['quantity']);
					}
				}else{
					$discount += $amount['adjustment'];
					$phic += $amount['phic'];
					$hexcess += $amount['excess'];
					$gross += $amount['sellingprice'] * $amount['quantity'];			
					$excess +=$amount['gross']-$amount['hmo']-$amount['phic'];
					//if($amount['hmo'] > 0){
						$hmo +=$amount['hmo'];
					// }else{
					// 	if($cn[0]=="R"){
					// 		$hmo +=0;			
					// 	}else{
					// 		$hmo +=$amount['excess'];			
					// 	}
						
					// 	$excess +=0;
					// }
				}
			
		}		
		}
		echo $hmo."<br>";
		$hactual += $gross;
		$hphic += $phic;
		$texcess += $discount;
		$hhmo += $hmo;
		echo "<tr>";
			echo "<td align='left'>$item[accounttitle]</td>";
			echo "<td align='right'><b>".number_format($gross,2)."</b></td>";
			echo "<td align='right'><b>".number_format($phic,2)."</b></td>";
			echo "<td align='right'><b>".number_format($hmo,2)."</b></td>";
			echo "<td align='right'><b>".number_format($gross-$phic-$hmo,2)."</b></td>";
		echo "</tr>";
	}
	if($hactual==0){
		echo "<tr>";
		echo "<td>ADD: Charges</td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "</tr>";
	}
	?>
	<tr>
		<td align="center"><b>**TOTAL HOSPITAL BILL**</b></td>
		<td align="right"><b><?=number_format($hactual,2);?></b></td>
		<td align="right"><b><?=number_format($hphic,2);?></b></td>
		<td align="right"><b><?=number_format($hhmo,2);?></b></td>
		<td align="right"><b><?=number_format($hactual-$hphic-$hhmo,2);?></b></td>
	</tr>
	<?php
	$pactual=0;
	$pphic=0;
	$phmo=0;
	$pexcess=0;
	foreach($items as $item){
		if($item['productsubtype'] == "PROFESSIONAL FEE" && $item['producttype'] <> "IPD admitting"){
			$pactual += $item['gross'];
			$pphic += $item['phic'];
			$phmo += $item['hmo'];
			$pexcess += $item['excess'];
			$discount +=$item['adjustment'];			
			echo "<tr>";
				echo "<td>$item[productdesc]</td>";
				echo "<td align='right'><b>$item[gross]</b></td>";
				echo "<td align='right'><b>$item[phic]</b></td>";
				echo "<td align='right'><b>$item[hmo]</b></td>";
				echo "<td align='right'><b>$item[excess]</b></td>";
			echo "</tr>";
		}
	}
	if($pactual==0){
		echo "<tr>";
		echo "<td style='padding:10px;'>ADD: PHYSICIAN'S FEE</td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "</tr>";
	}	
	?>
	<tr>
		<td align="center"><b>**TOTAL PHYSICIAN'S FEE**</b></td>
		<td align="right"><b><?=number_format($pactual,2);?></b></td>
		<td align="right"><b><?=number_format($pphic,2);?></b></td>
		<td align="right"><b><?=number_format($phmo,2);?></b></td>
		<td align="right"><b><?=number_format($pexcess,2);?></b></td>
	</tr>
	<?php	
		echo "<tr>";
		echo "<td style='padding:10px;'>ADD: SENIOR DISCOUNT</td>";
		echo "<td align='right'><b>".number_format($discount,2)."</b></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td align='right'><b>".number_format($discount,2)."</b></td>";
		echo "</tr>";
	?>
	<tr>
		<td align="center"><b>**TOTAL BILL**</b></td>
		<td align="right"><b><?=number_format($pactual+$hactual-$discount,2);?></b></td>
		<td align="right"><b><?=number_format($pphic+$hphic,2);?></b></td>
		<td align="right"><b><?=number_format($phmo+$hhmo,2);?></b></td>
		<td align="right"><b><?=number_format($pexcess+$hexcess,2);?></b></td>
	</tr>
</table>