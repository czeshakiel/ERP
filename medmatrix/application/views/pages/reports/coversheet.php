<div>
    <table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-collapse: collapse;font-size:12px;font-family:Arial;">
        <tr>
            <td width="25%">&nbsp;</td>
            <td width="25%">&nbsp;</td>
            <td width="25%">&nbsp;</td>
            <td width="25%">&nbsp;</td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid black;">HRN: <b><?=$body['patientidno'];?></b></td>
            <td style="border-bottom:1px solid black;">Case No.: <b><?=$body['employerno'];?></b></td>
            <td style="border-bottom:1px solid black;" colspan="2">Ward/Room: <b><?=$body['room'];?></b></td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid black;border-right:1px solid black;">Last Name<br><b><?=$body['lastname'];?></b></td>
            <td style="border-bottom:1px solid black;border-right:1px solid black;">First Name<br><b><?=$body['firstname'];?></b></td>
            <td style="border-bottom:1px solid black;border-right:1px solid black;">Middle Name<br><b><?=$body['middlename'];?></b></td>
            <td style="border-bottom:1px solid black; vertical-align:top;">Suffix<br><b><?=$body['suffix'];?></b></td>
        </tr>
        <?php
        if($body['sex']=="M"){
            $sex="Male";
        }else{
            $sex="Female";
        }
        ?>
        <tr>
            <td>Age: <b><?=$body['age'];?> yrs old</b></td>
            <td>Sex: <b><?=$sex;?></b></td>
            <td>Civil Status: <b><?=$body['stat1'];?></b></td>
            <td>Contact No.: <b><?=$body['patientcontactno'];?></b></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <?php
        if($body['membership']=="phic-med"){
            $type=str_replace('Employment-','',$body['type']);
            $phic="Yes/".$type."/".$body['paymentmode'];
            $plan="PHILHEALTH";
        }else{
            $phic="No";
            $plan="NONE";
        }
        ?>
        <tr>
            <td colspan="3">Address: <b><?=$body['street'];?>, <?=$body['barangay'];?>, <?=$body['municipality'];?>, <?=$body['province'];?> <?=$body['zipcode'];?></b></td>
            <td>PHIC: <b><?=$phic;?></b></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid black;">Nationality: <b><?=$body['notify'];?></b></td>
            <td style="border-bottom:1px solid black;">Religion: <b><?=$body['religion'];?></b></td>
            <td style="border-bottom:1px solid black;">Birth Date: <b><?=$body['birthdate'];?></b></td>
            <td style="border-bottom:1px solid black; font-size:10.5px;">Department: <b><?=$body['specialization'];?></b></td>
        </tr>
        <tr>
            <td>Name of Father:<br><b><?=$body['lastnamed'];?></b></td>
            <td>Name of Mother:<br><b><?=$body['firstnamed'];?></b></td>
            <td colspan="2">Name of Guardian:<br><b></b></td>
        </tr>
        <tr>
            <td colspan="4">Name of Spouse:<br>&nbsp;</td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid black;">Informant's Name:<br><b><?=$body['middlenamed'];?></b></td>
            <td style="border-bottom:1px solid black;">Relation to Patient:<br><b><?=$body['relationship'];?></b></td>
            <td style="border-bottom:1px solid black;" colspan="2">Hospitalization Plan:<br><b><?=$plan;?></b></td>
        </tr>
        <?php
        $admitting=$this->General_model->fetch_single_doctor($body['ad']);
        ?>
        <tr>
            <td colspan="2">Admitting Dr.: <b>DR. <?=$admitting[0]['name'];?></b></td>
            <td colspan="2">Attending Dr.: <b>DR. <?=$body['name'];?></b></td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4">Consulting Dr.: <b>DR. <?=$body['name'];?></b></td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4">Admitting Clerk: <b><?=$body['admittingclerk'];?></b></td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4">Admitting Diagnosis: <b><?=$body['initialdiagnosis'];?></b></td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4">Principal Diagnosis: <b></b></td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4">Other Diagnosis: <b></b></td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4">Operation Done: <b></b></td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4" style="font-size:10px;"><i>Note: Always indicate diagnosis/procedure in order of importance, also indicate if procedure is Minor/Major.
</i></td>
        </tr>
        <tr>
            <td colspan="4">
                <table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse:collapse;">
                    <tr>
                        <td width="15%" style="border-right:0;" rowspan="4">
                            Result<br><br>
                            &nbsp;[ ] Recovered<br><br>
                            &nbsp;[ ] Improved<br><br>
                            &nbsp;[ ] Unimproved<br><br>
                        </td>
                        <td width="15%" style="border-left:0;" rowspan="4">
                            <br><br>
                            &nbsp;[ ] Died<br><br>
                            &nbsp;[ ] Autopsy<br><br>
                            &nbsp;[ ] No Autopsy<br><br>
                        </td>
                        <td width="15%" style="border-right:0;" rowspan="4">
                            Disposition<br><br>
                            &nbsp;[ ] Discharged<br><br>
                            &nbsp;[ ] Transferred<br><br>
                            &nbsp;[ ] DAMA<br><br>
                        </td>
                        <td width="15%" style="border-left:0;" rowspan="4">
                            <br><br>
                            &nbsp;[ ] Absconded<br><br>
                        </td>
                        <td width="40%" align="left" style="border-bottom:0;">
                            Admission Date/Time
                        </td>
                    </tr>
                    <tr>
                        <td width="40%" style="border-top:0;" align="center">
                            <b><?=$body['dateadmitted'];?> <?=date('h:i A',strtotime($body['timeadmitted']));?></b>
                        </td>
                    </tr>
                    <?php
                    $discharged=$this->Admission_model->discharged($body['caseno']);
                    if($discharged['datedischarged']==""){
                        $datedischarged="&nbsp;";
                    }else{
                        $datedischarged=$discharged['datedischarged']." ".date('h:i A',strtotime($discharged['timedischarged']));
                    }
                    ?>
                    <tr>
                        <td width="40%" style="border-bottom:0;">
                            Discharged Date/Time
                        </td>
                    </tr>
                    <tr>
                        <td width="40%" style="border-top:0;" align="center">
                            <b><?=$datedischarged;?></b>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <p style="font-family:Arial;font-size:12px;" align="center"><i>I have reviewed this record and found it to be accurate and complete.</i></p>
    <br>
    <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size:12px; font-family:Arial;">
        <tr>
            <td width="20%" align="center">
                <b>THUMB MARK</b>
            </td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td width="20%" align="center" style="height:120px; border:1px solid black;">
                &nbsp;
            </td>
            <td width="40%" align="center" style="vertical-align:top;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;__________________________________
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Informant/Patient Signature
            </td>
            <td width="40%" align="center" style="vertical-align:top;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><b><?=$body['name'];?></b></u><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Attending Physician
            </td>
        </tr>
    </table>
</div>
