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
<div>
    <table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse:collapse; font-size:9px;font-family:Arial;">
    <tr>
        <td rowspan="2" align="center">Case No</td>
        <td colspan="2" align="center">Admission</td>
        <td rowspan="2" align="center">Patient Name</td>
        <td rowspan="2" align="center">Admit Diag</td>
        <td rowspan="2" align="center">Admit Doctor</td>
        <td rowspan="2" align="center">Attend Doctor</td>
        <td rowspan="2" align="center">Disposition</td>
        <td rowspan="2" align="center">Final Diag</td>
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
                echo "<td>$item[employerno]</td>";
                echo "<td>$item[dateadmitted]</td>";
                echo "<td>$timeadmit</td>";
                echo "<td>$item[lastname], $item[firstname] $item[middlename]</td>";                
                echo "<td>$item[initialdiagnosis]</td>";
                echo "<td>DR. $ad[lastname], $ad[lastname]</td>";
                echo "<td>DR. $ap[lastname], $ap[lastname]</td>";
                echo "<td>$item[disposition]</td>";
                echo "<td>$finaldx</td>";
                echo "<td align='center'>$datedischarged</td>";
                echo "<td align='center'>$timedischarged</td>";
            echo "</tr>";
            $x++;
        }
        ?>
    </table>
</div>
