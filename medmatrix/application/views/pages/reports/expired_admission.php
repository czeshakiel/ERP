<?php
			$startdate=date('F d, Y',strtotime($startdate));
			$enddate=date('F d, Y',strtotime($enddate));
			$header=$this->General_model->getinfo();
?>
<div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="<?=base_url();?>design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;"><?=$header['heading'];?></b><br>
                    <font style="font-size:10px;"><?=$header['address'];?></font><br>
                    <font style="font-size:10px;">Tel. No.: <?=$header['telno'];?></font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4 style="margin-left:90px;">LIST OF EXPIRED PATIENT<br><?=$startdate;?> - <?=$enddate;?></h4>
             </div>
<div>
<div>
	<table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse:collapse; font-size:12px;font-family:Arial;">
		<tr>
			<td align="center"></td>
			<td align="center">HRN</td>
			<td align="center">CASE NO.</td>
			<td align="center">PATIENT</td>
			<td align="center">AGE</td>
			<td align="center">SEX</td>
			<td align="center">ADDRESS</td>
			<td align="center">DEATH DATE</td>
			<td align="center">DISCHARGED DATE</td>
		</tr>
		<?php
		$x=1;
		foreach($body as $item){
			$timeadmit=date('h:i A',strtotime($item['timeadmitted']));
			$street=$item['street'].", ";
			$barangay=$item['barangay'].", ";
			$city=$item['municipality'].", ";
			$province=$item['province'];
			$zipcode=$item['zipcode'];

			$discharged=$this->Admission_model->discharged($item['caseno']);
			if($discharged['datedischarged']==""){
				$datedischarged="";
				$timedischarged="";
			}else{
				$datedischarged=$discharged['datedischarged'];
				$timedischarged=date('h:i A',strtotime($discharged['timedischarged']));
			}
			$caseno=str_replace('I-','',$item['caseno']);
			echo "<tr>";
			echo "<td>$x.</td>";
			echo "<td align='center'>$item[patientidno]</td>";
			echo "<td align='center'>$caseno</td>";
			echo "<td>$item[lastname], $item[firstname]</td>";
			echo "<td align='center'>$item[age]</td>";
			echo "<td align='center'>$item[sex]</td>";
			echo "<td>$street, $barangay, $city, $province $zipcode</td>";
			echo "<td align='center'>$datedischarged $timedischarged</td>";
			echo "<td align='center'>$datedischarged $timedischarged</td>";
			echo "</tr>";
			$x++;
		}
		?>
	</table>
</div>
