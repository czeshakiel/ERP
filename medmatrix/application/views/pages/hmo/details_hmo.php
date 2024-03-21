<?php
if($patient['datedischarged']==""){
	$no_of_days="";
	$datedischarged="";
}else{
	$datedischarged=date('F d, Y',strtotime($patient['datedischarged']))." ".date('h:i A',strtotime($patient['timedischarged']));
	$dischargeddate=$patient['datedischarged']." ".$patient['timedischarged'];
  	$datediff=strtotime($patient['datedischarged'])-strtotime($patient['dateadmit']);
	$no_of_days=round($datediff / (60 * 60 * 24));
}
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1" style="font-size:12px;">
	<tr>
		<td width="18%"><b>Patient Name:</b></td>
		<td width="40%"><b><?=$patient['lastname'];?>, <?=$patient['firstname'];?> <?=$patient['suffix'];?> <?=$patient['middlename'];?></b></td>
		<td width="16%"><b>Admission No.:</b></td>
		<td><b><?=$caseno;?></b></td>
	</tr>
	<tr>
		<td><b>Address:</b></td>
		<td><b><?=$patient['street'];?>, <?=$patient['barangay'];?>, <?=$patient['municipality'];?>, <?=$patient['province'];?> <?=$patient['zipcode'];?></b></td>
		<td><b>Admission Date:</b></td>
		<td><b><?=date('m/d/Y',strtotime($patient['dateadmit']));?> <?=date('h:i A',strtotime($patient['timeadmitted']));?></b></td>
	</tr>
	<tr>
		<td><b>Attending Physician:</b></td>
		<td><b><?=$patient['name'];?></b></td>
		<td><b>Discharged Date:</b></td>
		<td><b><?=$datedischarged;?></b></td>
	</tr>
	<tr>
		<td><b>Guarantors:</b></td>
		<td><b><?=$patient['hmo'];?></b></td>
		<td><b>Room No.:</b></td>
		<td><b><?=$patient['room'];?></b></td>
	</tr>
	<tr>
		<td><b>Age:</b></td>
		<td><b><?=$patient['age'];?> years</b></td>
		<td><b>No. of Days Admit:</b></td>
		<td><b><?=$no_of_days;?></b></td>
	</tr>
	<tr>
		<td><b>Gender:</b></td>
		<td><b><?=$patient['sex'];?></b></td>
		<td></td>
		<td></td>
	</tr>
</table>
<br>
<?php
$rooms=$this->Hmo_model->fetch_product($caseno,"ROOM ACCOMODATION");
$labs=$this->Hmo_model->fetch_product($caseno,"LABORATORY");
$xrays=$this->Hmo_model->fetch_product($caseno,"XRAY");
$eegs=$this->Hmo_model->fetch_product($caseno,"EEG");
$ecgs=$this->Hmo_model->fetch_product($caseno,"ECG");
$ultra=$this->Hmo_model->fetch_product($caseno,"ULTRASOUND");
$ctscan=$this->Hmo_model->fetch_product($caseno,"CT SCAN");
$echos=$this->Hmo_model->fetch_product($caseno,"2D ECHO");
$hearts=$this->Hmo_model->fetch_product($caseno,"HEARTSTATION");
$medsup=$this->Hmo_model->fetch_product($caseno,"MEDICAL SURGICAL SUPPLIES");
$medicalsup=$this->Hmo_model->fetch_product($caseno,"MEDICAL SUPPLIES");
$pharmasup=$this->Hmo_model->fetch_product($caseno,"PHARMACY/SUPPLIES");
$meds=$this->Hmo_model->fetch_product($caseno,"PHARMACY/MEDICINE");
$adfee=$this->Hmo_model->fetch_product($caseno,"ADMISSION FEE");
$pt=$this->Hmo_model->fetch_product($caseno,"PHYSICAL THERAPY");
$erfee=$this->Hmo_model->fetch_product($caseno,"ER FEE");
$mequip=$this->Hmo_model->fetch_product($caseno,"MEDICAL EQUIPMENT");
$misc=$this->Hmo_model->fetch_product($caseno,"MISCELLANEOUS");
//$misc1=$this->Hmo_model->fetch_product($caseno,"OR/DR/ER FEE");
$misc1=array();
$nsfee=$this->Hmo_model->fetch_product($caseno,"NURSING SERVICE FEE");
$pf=$this->Hmo_model->fetch_product($caseno,"PROFESSIONAL FEE");
$oxy=$this->Hmo_model->fetch_product($caseno,"OXYGEN SUPPLIES");
$rt=$this->Hmo_model->fetch_product($caseno,"RT ON CALL");
$nscharge=$this->Hmo_model->fetch_product($caseno,"NURSING CHARGES");
$orcharge=$this->Hmo_model->fetch_product($caseno,"OR/CHARGES");
$orsup=$this->Hmo_model->fetch_product($caseno,"OR/DR SUPPLIES");
$orcharge1=$this->Hmo_model->fetch_product($caseno,"OR-CHARGES");
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" style="font-size:12px;">
	<tr>
		<td><b>Doc. No.</b></td>
		<td><b>Date</b></td>
		<td><b>Description</b></td>
		<td><b>Qty</b></td>
		<td align="right"><b>Unit Price</b></td>
		<td align="right"><b>Amount</b></td>
		<td align="right"><b>Total</b></td>
	</tr>
	<tr>
		<td colspan="7"><b>ROOM & BOARD</b></td>
	</tr>
	<?php
	$totalroom=0;
	foreach($rooms as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalroom +=$room['sellingprice']*$room['quantity'];
	}
	?>
	<tr>
		<td colspan="7" align="right"><b><?=number_format($totalroom,2);?></b></td>
	</tr>
	<tr>
		<td colspan="7"><b>LABORATORY</b></td>
	</tr>
	<?php
	$totallabs=0;
		if(count($labs)>0){
	?>
	<?php

	foreach($labs as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totallabs +=$room['sellingprice']*$room['quantity'];
	}
	?>
	<tr>
		<td colspan="7" align="right"><b><?=number_format($totallabs,2);?></b></td>
	</tr>	
	<tr>
		<td colspan="7"><b>RADIOLOGY</b></td>
	</tr>
	<?php
	}
	$totalxray=0;
		if(count($xrays)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>XRAY</b></td>
	</tr>
	<?php
	foreach($xrays as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalxray +=$room['sellingprice']*$room['quantity'];
	}
	?>

	<?php
	}
	?>

	<?php
	$totaleeg=0;
		if(count($eegs)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>EEG</b></td>
	</tr>
	<?php

	foreach($eegs as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalxray +=$room['sellingprice']*$room['quantity'];
	}
	?>

	<?php
	}
	?>
	?>
	<?php
	$totalecg=0;
		if(count($ecgs)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ECG</b></td>
	</tr>
	<?php

	foreach($ecgs as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalxray +=$room['sellingprice']*$room['quantity'];
	}
	?>

	<?php
	}
	?>
	?>
	<?php
	$totalultra=0;
		if(count($ultra)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ULTRASOUND</b></td>
	</tr>
	<?php

	foreach($ultra as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalxray +=$room['sellingprice']*$room['quantity'];
	}
	?>

	<?php
	}
	?>
	?>
	<?php
	$totalct=0;
		if(count($ctscan)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>CT SCAN</b></td>
	</tr>
	<?php

	foreach($ctscan as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalxray +=$room['sellingprice']*$room['quantity'];
	}
	?>

	<?php
	}
	?>
	?>
	<?php
	$totalechos=0;
		if(count($echos)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>2D ECHO</b></td>
	</tr>
	<?php

	foreach($echos as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalxray +=$room['sellingprice']*$room['quantity'];
	}
	?>

	<?php
	}
	?>
	<?php
	$totalheart=0;
		if(count($hearts)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>HEART STATION</b></td>
	</tr>
	<?php
	foreach($hearts as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalxray +=$room['sellingprice']*$room['quantity'];
	}
	?>
	<?php
	}
	?>
	<tr>
		<td colspan="7" align="right"><b><?=number_format($totalxray,2);?></b></td>
	</tr>
	<!-- <tr>
		<td colspan="7" align="right"><b><?=number_format($totallabs+$totalxray+$totalecg+$totaleeg+$totalechos+$totalheart+$totalultra+$totalct,2);?></b></td>
	</tr> -->
	<tr>
		<td colspan="7"><b>SUPPLIES</b></td>
	</tr>
	<?php
	$totalmedsup=0;
		if(count($medsup)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>MEDICAL SURGICAL SUPPLIES</b></td>
	</tr>
	<?php

	foreach($medsup as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalmedsup +=$room['sellingprice']*$room['quantity'];
	}
	?>
	<?php
	}
	?>
	<?php
	$totalmedicalsup=0;
		if(count($medicalsup)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>MEDICAL SUPPLIES</b></td>
	</tr>
	<?php

	foreach($medicalsup as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalmedicalsup +=$room['sellingprice']*$room['quantity'];
	}
	?>
	<?php
	}
	?>
	<?php
	$totalpharmasup=0;
		if(count($pharmasup)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>PHARMACY/SUPPLIES</b></td>
	</tr>
	<?php

	foreach($pharmasup as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalpharmasup +=$room['sellingprice']*$room['quantity'];
	}
	?>

	<?php
	}
	?>
	<tr>
		<td colspan="7" align="right"><b><?=number_format($totalmedsup+$totalpharmasup+$totalmedicalsup,2);?></b></td>
	</tr>
	<tr>
		<td colspan="7"><b>DRUGS & MEDICINES</b></td>
	</tr>
	<?php
	$totalmeds=0;
		if(count($meds)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>PHARMACY/MEDICINE</b></td>
	</tr>
	<?php
	
	foreach($meds as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalmeds +=$room['sellingprice']*$room['quantity'];
	}
	?>
	<tr>
		<td colspan="7" align="right"><b><?=number_format($totalmeds,2);?></b></td>
	</tr>
	<?php
	}
	?>

	<tr>
		<td colspan="7"><b>MISCELLANEOUS</b></td>
	</tr>
	<?php
	$totaladmit=0;
		if(count($adfee)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ADMISSION FEE</b></td>
	</tr>
	<?php

	foreach($adfee as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totaladmit +=$room['sellingprice']*$room['quantity'];
	}
	?>
	<tr>
		<td colspan="7" align="right"><b><?=number_format($totaladmit,2);?></b></td>
	</tr>
	<?php
	}
	?>
	<?php
	$totaler=0;
		if(count($erfee)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ER FEE</b></td>
	</tr>
	<?php
	foreach($erfee as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totaler +=$room['sellingprice']*$room['quantity']; 
		//echo $totaler."<br>";
	}
	?>
	<?php
	}
	?>
	<tr>
		<td colspan="7" align="right"><b><?=number_format($totaler,2);?></b></td>
	</tr>
	<?php
	$totalequip=0;
		if(count($mequip)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>MEDICAL EQUIPMENT</b></td>
	</tr>
	<?php
	foreach($mequip as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalequip +=$room['sellingprice']*$room['quantity'];
	}
	?>
	<?php
	}
	?>
	<tr>
		<td colspan="7" align="right"><b><?=number_format($totalequip,2);?></b></td>
	</tr>
	<tr>
		<td colspan="7"><b>PHYSICAL THERAPY</b></td>
	</tr>
	<?php
	$totalpt=0;
		if(count($pt)>0){
	?>
	<?php

	foreach($pt as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalpt +=$room['sellingprice']*$room['quantity'];
	}
}
	?>
	<tr>
		<td colspan="7" align="right"><b><?=number_format($totalpt,2);?></b></td>
	</tr>
	<?php
	$totalmisc=0;
		if(count($misc)>0 || count($nscharge)>0 || count($orcharge)>0 || count($orsup)>0 || count($orcharge1)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>MISCELLANEOUS</b></td>
	</tr>
	<?php
	foreach($misc as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalmisc +=$room['sellingprice']*$room['quantity'];
	}
	foreach($nscharge as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalmisc +=$room['sellingprice']*$room['quantity'];
	}
	foreach($orcharge as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalmisc +=$room['sellingprice']*$room['quantity'];
	}	
	foreach($orsup as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalmisc +=$room['sellingprice']*$room['quantity'];
	}
	foreach($orcharge1 as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalmisc +=$room['sellingprice']*$room['quantity'];
	}
	// foreach($misc1 as $room){
	// 	echo "<tr>";
	// 		echo "<td>$room[refno]</td>";
	// 		echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
	// 		echo "<td>$room[productdesc]</td>";
	// 		echo "<td>$room[quantity]</td>";
	// 		echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
	// 		echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
	// 		echo "<td>&nbsp;</td>";
	// 	echo "<tr>";
	// 	$totalmisc +=$room['sellingprice']*$room['quantity'];
	// }
	?>
	<?php
	}
	?>
	<tr>
		<td colspan="7" align="right"><b><?=number_format($totalmisc,2);?></b></td>
	</tr>
	<?php
	$totalnsfee=0;
		if(count($nsfee)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>NURSING SERVICE FEE</b></td>
	</tr>
	<?php
	foreach($nsfee as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalnsfee +=$room['sellingprice']*$room['quantity'];
	}
	?>
	<?php
	}
	?>
	<tr>
		<td colspan="7" align="right"><b><?=number_format($totalnsfee,2);?></b></td>
	</tr>
	<?php
	$totaloxy=0;
		if(count($oxy)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>OXYGEN</b></td>
	</tr>
	<?php
	foreach($oxy as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totaloxy +=$room['sellingprice']*$room['quantity'];
	}
	?>
	<?php
	}
	?>
	<tr>
		<td colspan="7" align="right"><b><?=number_format($totaloxy,2);?></b></td>
	</tr>
	<?php
	$totalrt=0;
		if(count($rt)>0){
	?>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>RT ON CALL</b></td>
	</tr>
	<?php
	foreach($rt as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalrt +=$room['sellingprice']*$room['quantity'];
	}
	?>
	<?php
	}
	?>
	<tr>
		<td colspan="7" align="right"><b><?=number_format($totalrt,2);?></b></td>
	</tr>
	<?php
	$totalpf=0;
		if(count($pf)>0){
	?>
	<tr>
		<td colspan="7"><b>PROFESSIONAL FEE</b></td>
	</tr>
	<tr>
		<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>IPD Attending</b></td>
	</tr>
	<?php
	foreach($pf as $room){
		echo "<tr>";
			echo "<td>$room[refno]</td>";
			echo "<td>".date('m/d/Y h:i A',strtotime($room['datearray']." ".$room['invno']))."</td>";
			echo "<td>$room[productdesc]</td>";
			echo "<td>$room[quantity]</td>";
			echo "<td align='right'>".number_format($room['sellingprice'],2)."</td>";
			echo "<td align='right'>".number_format($room['sellingprice']*$room['quantity'],2)."</td>";
			echo "<td>&nbsp;</td>";
		echo "<tr>";
		$totalpf +=$room['sellingprice']*$room['quantity'];
	}
	?>
	<?php
	}
	?>
	<tr>
		<td colspan="7" align="right"><b><?=number_format($totalpf,2);?></b></td>
	</tr>
	<tr>
		<td colspan="7" align="right">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="6" align="right"><b>Grand Total >></b></td>
		<td align="right"><b><?=number_format($totaladmit+$totaler+$totalroom+$totallabs+$totalmedsup+$totalmedicalsup+$totalpharmasup+$totalxray+$totalequip+$totalmisc+$totalnsfee+$totaloxy+$totalrt+$totalpf+$totalpt+$totalmeds,2);?></b></td>
	</tr>
</table>
<br>
<table width="100%" border="0" style="font-size:12px;">
		<tr>
			<td colspan="2">PREPARED BY</td>
		</tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
		<td><b><u><?=$this->session->fullname;?></u></b></td>
		</tr>
		</table>
