<div style="border:1px solid black; border-radius: 50px; padding:20px;">
    <table width="100%" border="0" cellspacing="2" cellpadding="1" style="font-size:12px;font-family:Arial;">
    <tr>
        <td><b>Name:</b></td>
        <td colspan="5" style="border-bottom:1px solid black;"><?=$item['lastname'];?>, <?=$item['firstname'];?> <?=$item['middlename'];?> <?=$item['suffix'];?></td>
        <td><b>Date:</b></td>
        <td colspan="2" style="border-bottom:1px solid black;"><?=$item['dateadmit'];?></td>
        <td><b>Time:</b></td>
        <td style="border-bottom:1px solid black;"><?=$item['timeadmitted'];?></td>
    </tr>
    <tr>
        <td><b>Address:</b></td>
        <td colspan="2" style="border-bottom:1px solid black; font-size: 10px;"><?=$item['street'];?>, <?=$item['barangay'];?>, <?=$item['municipality'];?>, <?=$item['province'];?></td>
        <td width="5%"><b>Age:</b></td>
        <td colspan="2" align="center" style="border-bottom:1px solid black;"><?=$item['age'];?></td>
        <td><b>Sex:</b></td>
        <td style="border-bottom:1px solid black;" align="center"><?=$item['sex'];?></td>
        <td><b>DOB:</b></td>
        <td colspan="2" style="border-bottom:1px solid black;"><?=$item['dateofbirth'];?></td>
    </tr>
    <tr>
        <td colspan="11">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="11"><b>Chief Complaint</b></td>
    </tr>
    <tr>
        <td colspan="11" style="border-bottom:1px solid black;"><?=$item['chiefcomplaint'];?></td>        
    </tr>    
    <tr>
        <td colspan="7" width="95%"><b>Pertinent Medical History</b></td>
        <td colspan="4" rowspan="12" width="5%" style="cellpadding:10px;" align="center">               
                <table width="100%" style="border-spacing: 0; border-collapse: separate; border-radius: 10px;  border:1px solid black;" cellspacing="2">
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>VITAL SIGNS</b></td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td><b>BP:</b></td>
                        <td style="border-bottom: 1px solid black;">&nbsp;</td>
                        <td width="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td><b>HR:</b></td>
                        <td style="border-bottom: 1px solid black;">&nbsp;</td>
                        <td width="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td><b>RR:</b></td>
                        <td style="border-bottom: 1px solid black;">&nbsp;</td>
                        <td width="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="30%"><b>TEMP:</b></td>
                        <td style="border-bottom: 1px solid black;">&nbsp;</td>
                        <td width="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td><b>WT:</b></td>
                        <td style="border-bottom: 1px solid black;">&nbsp;</td>
                        <td width="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>                   
        </td>
    </tr>
    <tr>
        <td colspan="7" style="border-bottom:1px solid black;">&nbsp;</td>        
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7" style="border-bottom:1px solid black;">&nbsp;</td>        
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7" style="border-bottom:1px solid black;">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7" style="border-bottom:1px solid black;">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7"><b>Laboratories</b></td>
    </tr>    
    <tr>
        <td colspan="7" style="border-bottom:1px solid black;">&nbsp;</td>
    </tr>
     <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
     <tr>
        <td colspan="7">&nbsp;</td>
    </tr>    
    </table>
    <?php
    $doctor=$this->General_model->fetch_single_doctor_by_code($item['ap']);
    ?>
    <table width="100%" border="0" style="font-size:12px; font-family: Arial; border-collapse:collapse;">
        <tr>
            <td width="21%"><b>ATTENDING PHYSICIAN:</b></td>
            <td width="40%" style="border-bottom:1px solid black; font-size: 16px;">&nbsp;&nbsp;&nbsp;&nbsp;<b><?=$doctor['firstname'];?> <?=$doctor['lastname'];?></b></td>
            <td>&nbsp;</td>
        </tr>
    </table>
</div>
