<button onclick="tableToExcel('printThis','Discharged_Summary_Debit')">EXPORT REPORT</button>
<div id="printThis">
	<table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse:collapse; font-size:8px;font-family:Arial;">
		<tr>
			<td rowspan="2" align="center" width="1.5%">No.</td>
			<td rowspan="2" align="center">Case No</td>
			<td rowspan="2" align="center">HRN</td>
			<td colspan="2" align="center">Admission</td>
			<td rowspan="2" align="center">Patient Name</td>
			<td rowspan="2" align="center">Birthdate</td>
			<td rowspan="2" align="center">Sex</td>
			<td rowspan="2" align="center">Age</td>
			<td rowspan="2" align="center">Status</td>
			<td rowspan="2" align="center">Member</td>
			<td rowspan="2" align="center">Address</td>
			<td rowspan="2" align="center">Dept</td>
			<td rowspan="2" align="center">Admit Doctor</td>
			<td rowspan="2" align="center">Admit. Diag.</td>
			<td rowspan="2" align="center">Final Diag.</td>
			<td rowspan="2" align="center">Disposition</td>
			<td rowspan="2" align="center">Admit<br>Result</td>
			<td colspan="2" align="center">Discharged</td>
			<td rowspan="2" align="center">Attend. Doctor</td>
			<td rowspan="2" align="center">MR<br>Locator</td>
			<td rowspan="2" align="center">Length<br>of Stay</td>
		</tr>
		<tr>
			<td align="center">Date</td>
			<td align="center">Time</td>
			<td align="center">Date</td>
			<td align="center">Time</td>
		</tr>
		<?php
		$x=1;
		$i=0;
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
			$discharged=$this->Admission_model->discharged($item['caseno']);
			if($discharged['datedischarged']==""){
				$datedischarged="";
				$timedischarged="";
				$stay=0;
			}else{
				$datedischarged=$discharged['datedischarged'];
				$timedischarged=date('h:i A',strtotime($discharged['timedischarged']));
				$datetime1 = date_create($item['dateadmit']);
				$datetime2 = date_create($discharged['datearray']);

				// calculates the difference between DateTime objects
				$interval = date_diff($datetime1, $datetime2);

				// printing result in days format
				$stay=$interval->format('%a');
			}
			$caseno=str_replace('I-','',$item['caseno']);
			echo "<tr>";
			echo "<td align='center'>$x.</td>";
			echo "<td>$caseno</td>";
			echo "<td>$item[patientidno]</td>";
			echo "<td>$item[dateadmitted]</td>";
			echo "<td>$timeadmit</td>";
			echo "<td>$item[lastname], $item[firstname]</td>";
			echo "<td>$item[birthdate]</td>";
			echo "<td align='center'>$item[sex]</td>";
			echo "<td align='center'>$item[age]</td>";
			echo "<td align='center'>$item[stat1]</td>";
			echo "<td align='center'>$item[membership]</td>";
			echo "<td>$street $barangay $city $province $zipcode</td>";
			echo "<td>$ap[specialization]</td>";
			echo "<td>DR. $ad[lastname], $ad[firstname]</td>";
			echo "<td>$item[initialdiagnosis]</td>";
			echo "<td>$finaldx</td>";
			echo "<td>$item[status]</td>";
			echo "<td align='center'>$item[disposition]</td>";
			echo "<td align='center'>$datedischarged</td>";
			echo "<td align='center'>$timedischarged</td>";
			echo "<td>DR. $ap[lastname], $ap[firstname]</td>";
			echo "<td align='center'>$item[employerno]</td>";
			echo "<td align='center'>$stay</td>";
			echo "</tr>";
			$x++;
			$i++;
		}
		?>
	</table>
</div>
<script>                 
  var tableToExcel = (function(){
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>