<?php
			$startdate=date('F d, Y',strtotime($dischargeddate));
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
            <h4 style="margin-left:90px;">DAILY DISCHARGED REPORT<br><?=$startdate;?></h4>
             </div>
<div>
	<table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse:collapse; font-size:14px;font-family:Arial;">
		<tr>
			<td align="center" width="2%">No.</td>
			<td align="center">Patient Name</td>
			<td align="center">HRN</td>
			<td align="center" width="2%"></td>
			<td align="center">Case No</td>
			<td align="center">Admitted</td>
			<td align="center">Discharged</td>
			<td align="center">Department</td>
			<td align="center">Sex</td>
			<td align="center">Result</td>
			<td align="center">Age</td>
			<td align="center">Room #</td>
			<td align="center">Length of Stay</td>
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
			$ad=$this->General_model->fetch_single_doctor_by_code($item['ad']);
			$ap=$this->General_model->fetch_single_doctor_by_code($item['ap']);
			$caserates=$this->General_model->finalcaserate($item['caseno']);
			$finaldx="";
			if(sizeof($caserates)>0){
				foreach($caserates as $caserate){
					$finaldx .=$caserate['icdcode']." ".$caserate['description']."<br>";
				}
			}else{
				$finaldx=$item['finaldiagnosis'];
			}
			//$discharged=$this->Admission_model->discharged($item['caseno']);
//			if($discharged['datedischarged']==""){
//				$datedischarged="";
//				$timedischarged="";
//				$stay=0;
//			}else{
//				$datedischarged=$discharged['datedischarged'];
//				$timedischarged=date('h:i A',strtotime($discharged['timedischarged']));
				$datetime1 = date_create($item['dateadmit']);
				$datetime2 = date_create($dischargeddate);

				// calculates the difference between DateTime objects
				$interval = date_diff($datetime1, $datetime2);

				// printing result in days format
				$stay=$interval->format('%a');
			//}
			$mem=explode('-',$item['membership']);
			if($mem[0]=='phic'){
				$member="P";
			}else{
				$member="NP";
			}
			$caseno=str_replace('I-','',$item['caseno']);
			echo "<tr>";
			echo "<td>$x.</td>";
			echo "<td>$item[lastname], $item[firstname]</td>";
			echo "<td align='center'>$item[patientidno]</td>";
			echo "<td align='center'>$member</td>";
			echo "<td align='center'>$caseno</td>";
			echo "<td align='center'>".date('m/d/Y',strtotime($item['dateadmitted']))."</td>";
			echo "<td align='center'>".date('m/d/Y',strtotime($dischargeddate))."</td>";
			echo "<td>$ap[specialization]</td>";
			echo "<td align='center'>$item[sex]</td>";
			echo "<td align='center'>$item[disposition]</td>";
			echo "<td align='center'>$item[age]</td>";
			echo "<td>$item[room]</td>";
			echo "<td align='center'>$stay</td>";
			echo "</tr>";
			$x++;
		}
		?>
	</table>
</div>
