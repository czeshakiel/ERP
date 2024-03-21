<?php
$count=1;
foreach($body as $item){
	$diet=$this->Dietary_model->getSingleAdmissionDiet($item['caseno']);
	$description=$diet['description'];
	$remarks=$diet['remarks'];
	if($diet['description']==""){
		$description=$item['diet'];
		$remarks="";
	}
	?>
<div style="width:45%;border:1px solid black;border-radius:10px;padding:10px;float:right;margin-right:5px;margin-bottom: 5px;">
		<table border="0" width="100%" cellspacing="1" cellpadding="0">
			<tr>
				<td align="center" style="font-size:13px;" colspan="2"><b>KIDAPAWAN MEDICAL SPECIALISTS HOSPITAL, INC.</b></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td align="center" style="font-size:12px;" colspan="2"><b>DIETARY DEPARTMENT</b></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:12px;" width="5%">NAME:</td>
				<td style="font-size:12px; border-bottom:1px solid black" width="95%"><b><?=$item['patientname'];?></b></td>
			</tr>
			<tr>
				<td style="font-size:12px;" width="5%">AGE:</td>
				<td style="font-size:12px; border-bottom:1px solid black" width="95%"><b> <?=$item['age'];?></b></td>
			</tr>
			<tr>
				<td style="font-size:12px;" width="5%">ROOM:</td>
				<td style="font-size:12px; border-bottom:1px solid black" width="95%"><b> <?=$item['room'];?></b></td>
			</tr>
			<tr>
				<td style="font-size:12px;" width="5%">RELIGION:</td>
				<td style="font-size:12px; border-bottom:1px solid black" width="95%"> <b><?=$item['religion'];?></b></td>
			</tr>
			<tr>
				<td style="font-size:12px;" width="5%">DIET:</td>
				<td style="font-size:12px; border-bottom:1px solid black" width="95%"><b><?=$description;?></b></td>
			</tr>
			<tr>
				<td style="font-size:12px;" width="5%">REMARKS:</td>
				<td style="font-size:12px; border-bottom:1px solid black" width="95%"><b><?=$remarks;?></b></td>
			</tr>
			<tr>
				<td style="font-size:12px;" colspan="2">PAALALA:<br>1. Ito ang mga sumusunod na oras sa paghatid ng pagkain:<br>&nbsp;&nbsp;&nbsp;Agahan: 6:00 AM - 7:00 AM<br>&nbsp;&nbsp;&nbsp;Tanghalian: 11:00 AM - 12:00 NN<br>&nbsp;&nbsp;&nbsp;Hapunan: 4:30 PM - 5:30 PM<br>2. Ang Food tray ay kokolektahin pagkalipas ng isang (1) oras.<br>3. Ipinagbabawal ang paglagay ng Food tray sa labas ng kwarto.</td>

			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</table>
</div>
<?php
$count++;
} ?>
