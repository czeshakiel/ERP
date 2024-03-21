<?php
$query=$this->Dialysis_model->db->query("SELECT SUM(amount) as amount FROM collection WHERE acctno='$caseno' AND accttitle='DISCOUNT'");
if($query->num_rows()>0){
	$discount=$query->row_array()['amount'];
}else{
	$discount=0;
}
?>
<table width="100%" border="0" style="font-size:15.8px">
	<tr>
		<td align="justify">
	This is an estimate of Hospital (HCI) Charges only. It does not cover costs of Professional Fees and related costs that may be incurred to certain treatments (e.g. dialysis, physical therapy, etc.), particularly for ongoing treatment that may extend over a long period of time.<br><b style="font-size:14px;">PATIENT'S DETAILS</b>
</td></tr>
</table>
<table width="100%" border="1" style="font-size:14px; border-collapse: collapse;">
	<tr>
		<td style="height:40px;"><b>Patient Name:</b> <?=$patient['lastname'];?>, <?=$patient['firstname'];?> <?=$patient['middlename'];?> <?=$patient['suffix'];?></td>
	</tr>
	<tr>
		<td style="height:30px;"><b>Address:</b> <?=$patient['street'];?>, <?=$patient['barangay'];?>, <?=$patient['municipality'];?>, <?=$patient['province'];?>, <?=$patient['zipcode'];?></td>
	</tr>	
</table>
To be completed with the <b>Attending Physician/s</b>
<table width="100%" border="1" style="font-size:12px; border-collapse: collapse;" cellpadding="1">
	<tr>
		<td align="center"><b>Item No.</b></td>
		<td align="center"><b>Hospital charges (includes room accommodation, medicine, laboratory, imaging, medical supply, utilities, etc.)</b></td>
		<td align="center"><b>Estimated actual charges</b></td>
		<td align="center"><b>Discounts PWD/SC</b></td>
		<td align="center"><b>PHIC case rate amount (HCI only)</b></td>
		<td align="center"><b>Other HMOs LOA or GL covered (HCI only)</b></td>
		<td align="center"><b>Estimated excess/OOP (HCI only)</b></td>
	</tr>
	<tr>
		<td style="height:40px;" align="center">1.</td>
		<td style="font-size:14px;">Dialysis Treatment</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td style="font-size:14px;" align="right"><?=number_format($body['phic'],2);?></td>
		<td>&nbsp;</td>
		<td style="font-size:14px;" align="right"><?=number_format($body['excess']-$discount,2);?></td>
	</tr>
	<tr>
		<td style="height:40px;">&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="height:40px;">&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="height:40px;">&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="height:40px;">&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="height:40px;">&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="height:40px;" colspan="2"><b>Total:</b></td>		
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="7" align="justify" style="font-size:14px;">
			&nbsp;&nbsp;<b style="font-size:15px;">DECLARATION BY PATIENT OR GUARDIAN:</b><br>
			I understand that this is an estimate only and may be subject to variation. I acknowledge that it is my responsibility to confirm with my health insurance fund the level of cover that I have and any amount that it will be my responsibility to pay. I have been advised that other health professionals may be involed in my treatment and I understand that this estimate does not include their fees or charges unless specifically stated otherwise.
		</td>
	</tr>
	<tr>
		<td colspan="7">
			<table border="0" width="100%" style="font-size: 14px;">
				<tr>
					<td>
						<b>Patient or Guardian's signature:</b>
					</td>
					<td align="right">
						<b>Date: <u><?=date('m');?></u> / <u><?=date('d');?></u> / <u><?=date('Y');?></u></b>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2"><b>Guardian's full name:</b></td>
				</tr>
			</table>
		</td>
	</tr>	
</table>
<table border="0" width="100%" style="font-size: 14px;border:1px solid black; border-top:0;">
				<tr>
					<td>
						<b>Explained by (Admitting Officer)</b>
					</td>
					<td align="right">
						<b>Date: <u><?=date('m');?></u> / <u><?=date('d');?></u> / <u><?=date('Y');?></u></b>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2"><b>Admitting Officer's name & signature: </b><?=str_replace('%20',' ',$username);?></td>
				</tr>
			</table>