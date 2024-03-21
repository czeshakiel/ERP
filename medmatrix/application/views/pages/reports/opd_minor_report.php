<div>
    <table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse:collapse; font-size:10px;font-family:Arial;">
        <tr>
            <td align="center" width="1.5%">No.</td>
            <td align="center">Case No</td>
            <td align="center">Time</td>
            <td align="center">Patient Name</td>            
            <td align="center">Age</td>
            <td align="center">Sex</td>            
            <td align="center">Status</td>
            <td align="center">Birthdate</td>
            <td align="center">Address</td>            
            <td align="center">Admit. Diag.</td>
            <td align="center">Procedure</td>
            <td align="center">Physician</td>            
            <td align="center">Date</td>
        </tr>        
        <?php
        $x=1;
		$i=0;
        foreach($body as $item){
            $timeadmit=date('h:i A',strtotime($item['timeadmitted']));            
            $caseno=str_replace('M','',$item['employerno']);
            $street=$item['street'].", ";
            $barangay=$item['barangay'].", ";
            $city=$item['municipality'].", ";
            $province=$item['province'];
            $zipcode=$item['zipcode'];
            $address=$street.$barangay.$city.$province." ".$zipcode;
            $ad=$this->General_model->fetch_single_doctor_by_code($item['ad']);            
            $caserates=$this->General_model->finalcaserate($item['caseno']);
            $finaldx=$item['finaldiagnosis'];
            $initialdx=$item['initialdiagnosis'];
            echo "<tr>";
                echo "<td>$x.</td>";
                echo "<td>$caseno</td>";
                echo "<td>$timeadmit</td>";
                echo "<td>$item[patientname]</td>";
                echo "<td>$item[age]</td>";
                echo "<td>$item[sex]</td>";
                echo "<td>$item[stat1]</td>";
                echo "<td>$item[birthdate]</td>";
                echo "<td>$address</td>";
                echo "<td>$initialdx</td>";
                echo "<td>$finaldx</td>";
                echo "<td>$ad[name]</td>";
                echo "<td>$item[dateadmit]</td>";
            echo "</tr>";
            $x++;
			$i++;
        }
        ?>
    </table>
</div>
