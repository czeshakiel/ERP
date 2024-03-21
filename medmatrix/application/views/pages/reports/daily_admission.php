<div>
    <table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse:collapse; font-size:10px;font-family:Arial;">
        <tr>
            <td rowspan="2" align="center" width="1.5%">No.</td>
            <td rowspan="2" align="center" width="3%">Case No</td>
            <td colspan="2" align="center">Admission</td>
            <td rowspan="2" align="center">Patient Name</td>
            <td rowspan="2" align="center">Birthdate</td>
            <td rowspan="2" align="center">Sex</td>
            <td rowspan="2" align="center">Age</td>
            <td rowspan="2" align="center">Status</td>
            <td rowspan="2" align="center">Address</td>
            <td rowspan="2" align="center">Membership</td>
            <td rowspan="2" align="center">Admit. Diag.</td>
            <td rowspan="2" align="center">Admit Doctor</td>
            <td rowspan="2" align="center">Attend. Doctor</td>
            <td rowspan="2" align="center">Admit Clerk</td>
            <td rowspan="2" align="center">Disposition</td>
            <td rowspan="2" align="center">Final Diag.</td>
            <td colspan="2" align="center">Discharged</td>
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
            }else{
                $datedischarged=$discharged['datedischarged'];
                $timedischarged=date('h:i A',strtotime($discharged['timedischarged']));
            }
            echo "<tr>";
                echo "<td align='center'>$x.</td>";
                echo "<td>$item[employerno]</td>";
                echo "<td>$item[dateadmitted]</td>";
                echo "<td>$timeadmit</td>";
                echo "<td>$item[lastname], $item[firstname] $item[middlename]</td>";
                echo "<td>$item[birthdate]</td>";
                echo "<td align='center'>$item[sex]</td>";
                echo "<td align='center'>$item[age]</td>";
                echo "<td align='center'>$item[stat1]</td>";
                echo "<td>$street $barangay $city $province $zipcode</td>";
                echo "<td align='center'>$item[membership]</td>";
                echo "<td>$item[initialdiagnosis]</td>";
                echo "<td>DR. $ad[lastname], $ad[firstname]</td>";
                echo "<td>DR. $ap[lastname], $ap[firstname]</td>";
                echo "<td>$item[admittingclerk]</td>";
                echo "<td>$item[disposition]</td>";
                echo "<td>$finaldx</td>";
                echo "<td align='center'>$datedischarged</td>";
                echo "<td align='center'>$timedischarged</td>";
            echo "</tr>";
            $x++;
			$i++;
        }
        ?>
    </table>
</div>
