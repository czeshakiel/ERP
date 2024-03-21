<style>
.A4 {
  background: white;
  font-family: Tahoma;
  width: 21.59cm;
  height: 33.02cm;
  display: block;
  margin: 0 auto;
  padding: 10px 25px;
  margin-bottom: 0.5cm;
  box-sizing: border-box;
  box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
}

@media print {
  @page {
     size: 8.5in 13in;
     size: portrait;
  }
}
@media print {
  .pagebreak {
    clear: both;
    page-break-after: always;
  }


@media print {
  body {
    margin: 0;
    padding: 0;
  }

  .A4 {
    box-shadow: none;
  }

  .noprint {
    display: none;
  }

  .enable-print {
    display: block;
  }
}
}

</style>
<!--overflow-y: scroll;box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);-->

<?php
$caseno=$_GET['caseno'];
include '../main/class.php';
ini_set("display_errors","on");

$sql2222 = $conn->query("SELECT * FROM admission where caseno='$caseno'");
while($row2222 = $sql2222->fetch_assoc()){
$room=$row2222['room'];
$employerno=$row2222['employerno'];
$patientidno=$row2222['patientidno'];
$ap=$row2222['ap'];
$street=$row2222['street'];
$barangay=$row2222['barangay'];
$municipality=$row2222['municipality'];
$province=$row2222['province'];
$admittingdiagnosis=$row2222['initialdiagnosis'];
$finaldiagnosis=$row2222['finaldiagnosis'];
$dateadmit=$row2222['dateadmitted'];
$timeadmit=date("h:i:s a", strtotime($row2222['timeadmitted']));
$address22=$street." ".$barangay." ".$municipality.", ".$province;
$dateRegister=date('m/d/Y',strtotime($row2222['dateadmitted']));
$dateRegister=new DateTime($dateRegister,new DateTimeZone('Asia/Manila'));
}

mysqli_query($conn,"SET NAMES 'utf8'");
$sqlx=$conn->query("SELECT name FROM docfile where code = $ap");
if(mysqli_num_rows($sqlx)!=0){
  $fetchap=mysqli_fetch_array($sqlx);
  $ap=mb_strtoupper($fetchap['name']);
}

$sql2223 = $conn->query("SELECT * FROM dischargedtable where caseno='$caseno'");
$s23count=mysqli_num_rows($sql2223);
if ($s23count==0)
{
  $dischargedno = '';
  $datedischarged = '';
  $timedischarged = '';
}
else {

while($row2223 = $sql2223->fetch_assoc()){
$dischargedno = $row2223['caseno'];
$datedischarged = $row2223['datedischarged'];
$timedischarged = $row2223['timedischarged'];
}
}

$sql3 = $conn->query("SELECT * from patientprofile where patientidno='$patientidno'");
$s3count=mysqli_num_rows($sql3);
if ($s3count==0)
{
  $age='';
  $sex='';
  $bdate='';
  $name='';
}
else {
while($row3 = $sql3->fetch_assoc()){
$age=$row3['age'];
$sex=$row3['sex'];
$bdate = $row3['dateofbirth'];
$name=$row3['lastname'].", ".$row3['firstname']." ".$row3['middlename'];
if($sex=='M') {$sex='MALE'; $male="checked"; $female="";} elseif($sex=='F') {$sex='FEMALE'; $male=""; $female="checked";}
}
}

$datePxDoB = date('m/d/Y',strtotime($bdate));
$datePxDoB = new DateTime($datePxDoB,new DateTimeZone('Asia/Manila'));
$getAgeServ = date_diff($dateRegister,$datePxDoB);
$age = $getAgeServ->y." yr(s), ".$getAgeServ->m." mo(s), ".$getAgeServ->d." day(s)";

$mysql=$conncf4->query("SELECT * FROM profile WHERE caseno='$caseno'");
$m1count =mysqli_num_rows($mysql);
if ($m1count==0) {
  $pin='';
}
else {
while($myresult = $mysql->fetch_assoc()){$pin = $myresult['pPatientPin'];}
}
$mysql2=$conn->query("SELECT * FROM admissionaddinfo WHERE caseno='$caseno'");
$m2count=mysqli_num_rows($mysql2);
if($m2count == 0)
{
  $chiefcomplaint = '';
  $historyofpresentillness = '';
  $pastmedicalhistory ='';

}
else {
while($myresult2 = $mysql2->fetch_assoc()){
$chiefcomplaint = $myresult2['chiefcomplaint'];
$historyofpresentillness = $myresult2['historyofpresentillness'];
$pastmedicalhistory = $myresult2['pastmedicalhistory'];
}
}

$mysql4=$conncf4->query("SELECT * FROM preghist WHERE caseno='$caseno'");
$m4count=mysqli_num_rows($mysql4);
if ($m4count==0)
{
  $pPregCnt = '';
  $pDeliveryCnt = '';
}
else {
while($myresult4 = $mysql4->fetch_assoc()){
$pPregCnt = $myresult4['pPregCnt'];
$pDeliveryCnt = $myresult4['pDeliveryCnt'];
}
}

$mysql5=$conncf4->query("SELECT * FROM menshist WHERE caseno='$caseno'");
$m5count=mysqli_num_rows($mysql5);
if ($m5count==0)
{
$pLastMensPeriod = '';
}
while($myresult5 = $mysql5->fetch_assoc()){
$pLastMensPeriod = $myresult5['pLastMensPeriod'];
}

$sql="SELECT * FROM claiminfoadd WHERE caseno='$caseno'";
$sqlTransfer=mysqli_query($conn,$sql);
if(mysqli_num_rows($sqlTransfer)>0){
$trans=mysqli_fetch_array($sqlTransfer);
$transfer=$trans['hci'];
$yes=$trans['hciyes'];
$no=$trans['hcino'];
$reason=$trans['reasons'];
}else{
$transfer="";
$yes="";
$no="checked";
$reason="";
}

$sql="SELECT * FROM courseward WHERE caseno='$caseno'";
$sqlcourseward=mysqli_query($conncf4,$sql);

$sql="SELECT * FROM tsekap_lib_gen_survey WHERE LIB_STAT='1' ORDER BY GENSURVEY_ID ASC";
$sqlGensurvey=mysqli_query($conn,$sql);

$sqlVital=mysqli_query($conn,"SELECT * FROM pepert WHERE caseno='$caseno'");
$vital=mysqli_fetch_array($sqlVital);

$sql="SELECT * FROM pegensurvey WHERE caseno='$caseno'";
$sqlgensurvey=mysqli_query($conncf4,$sql);
$survey=mysqli_fetch_array($sqlgensurvey);

$sql="SELECT * FROM tsekap_lib_heent WHERE LIB_STAT='1' AND HEENT_ID NOT LIKE '99' ORDER BY SORT_NO ASC";
$sqlheent=mysqli_query($connepcb,$sql);

$sql="SELECT * FROM tsekap_lib_chest WHERE LIB_STAT='1' AND CHEST_ID NOT LIKE '99' ORDER BY SORT_NO ASC";
$sqlchest=mysqli_query($connepcb,$sql);

$sql="SELECT * FROM tsekap_lib_heart WHERE LIB_STAT='1' AND HEART_ID NOT LIKE '99' ORDER BY SORT_NO ASC";
$sqlheart=mysqli_query($connepcb,$sql);

$sql="SELECT * FROM tsekap_lib_abdomen WHERE LIB_STAT='1' AND ABDOMEN_ID NOT LIKE '99'ORDER BY SORT_NO ASC";
$sqlabdomen=mysqli_query($connepcb,$sql);

$sql="SELECT * FROM tsekap_lib_genitourinary WHERE LIB_STAT='1' AND GU_ID NOT LIKE '99' ORDER BY SORT_NO ASC";
$sqlguie=mysqli_query($connepcb,$sql);

$sql="SELECT * FROM tsekap_lib_skin_extremities WHERE LIB_STAT='1' AND SKIN_ID NOT LIKE '99' ORDER BY SORT_NO ASC";
$sqlskin=mysqli_query($connepcb,$sql);

$sql="SELECT * FROM tsekap_lib_neuro WHERE LIB_STAT='1' AND NEURO_ID NOT LIKE '99' ORDER BY SORT_NO ASC";
$sqlneuro=mysqli_query($connepcb,$sql);

$sql="SELECT pHeentId FROM pemisc WHERE caseno='$caseno' AND pHeentId <> ''";
$sqlpheent=mysqli_query($conncf4,$sql);
$pheent=mysqli_fetch_array($sqlpheent);

$sql="SELECT pChestId FROM pemisc WHERE caseno='$caseno' AND pChestId <> ''";
$sqlpchest=mysqli_query($conncf4,$sql);
$pchest=mysqli_fetch_array($sqlpchest);

$sql="SELECT pHeartId FROM pemisc WHERE caseno='$caseno' AND pHeartId <> ''";
$sqlpheart=mysqli_query($conncf4,$sql);
$pheart=mysqli_fetch_array($sqlpheart);

$sql="SELECT pAbdomenId FROM pemisc WHERE caseno='$caseno' AND pAbdomenId <> ''";
$sqlpabdomen=mysqli_query($conncf4,$sql);
$pabdomen=mysqli_fetch_array($sqlpabdomen);

$sql="SELECT pGuId FROM pemisc WHERE caseno='$caseno' AND pGuId <> ''";
$sqlpguie=mysqli_query($conncf4,$sql);
$pguie=mysqli_fetch_array($sqlpguie);

$sql="SELECT pSkinId FROM pemisc WHERE caseno='$caseno' AND pSkinId <> ''";
$sqlpskin=mysqli_query($conncf4,$sql);
$pskin=mysqli_fetch_array($sqlpskin);

$sql="SELECT pNeuroId FROM pemisc WHERE caseno='$caseno' AND pNeuroId <> ''";
$sqlpneuro=mysqli_query($conncf4,$sql);
$pneuro=mysqli_fetch_array($sqlpneuro);

$sqlPERem=$conncf4->query("SELECT * FROM pespecific WHERE caseno='$caseno'");
$sremcount=mysqli_num_rows($sqlPERem);
if($sremcount==0)
{
  $aa='';
  $bb='';
  $cc='';
  $dd='';
  $ee='';
  $ff='';
  $gg='';
}
else {
while($peremarks = $sqlPERem->fetch_assoc()){
  $aa=$peremarks["pHeentRem"];
  $bb=$peremarks["pChestRem"];
  $cc=$peremarks["pHeartRem"];
  $dd=$peremarks["pAbdomenRem"];
  $ee=$peremarks["pGuRem"];
  $ff=$peremarks["pSkinRem"];
  $gg=$peremarks["pNeuroRem"];
}
}

$sqlVital=mysqli_query($conncf4,"SELECT * FROM pepert WHERE caseno='$caseno'");
$vital=mysqli_fetch_array($sqlVital);

echo "
<div width='730' align='center' class='A4'><br>
      <table align='center' style='border-collapse: collapse;' border='0' width='100%'>
            <tr><td>
                  <table width='730' align='center'>
                        <tr>
                              <td width='7%'><img src='../main/img/logo/mmshi.png' width='75' height='auto'></td>
                              <td><p align='center' style='margin-right:70px'><b>$heading<br><font style='font-weight:normal; text-indent:2px; font-size: 10px;'>$address<br>$telno</b></p></td>
                        </tr>
                  </table>
            </td></tr>
            <tr><td>
              <table width='100%' style='border-collapse: collapse;' border='0'>
                <tr>
                  <td colspan='4' style='font-weight:bold' align='center'>MEDICAL EXAMINATION SHEET</td>
                </tr>
              </table>
            </td></tr>
              <table width='100%' border='1' style='border-collapse: collapse;'>
                <tr>
                  <td width='78%' valign='TOP'><font size='2px'>Patient Address: <br> <br> &nbsp;&nbsp;&nbsp;&nbsp;<b>$address22</b></font></td>
                  <td valign='TOP'><font size='2px'>Case #: <b><u>$employerno</u></b> <br><br> Room #: <b><u>$room</u></b></font></td>
                </tr>
                <tr>
                  <td rowspan='2'><font size='2px'>Past Medical/Personal/Social/Family History:<b> $pastmedicalhistory</b><br>&nbsp;&nbsp;&nbsp;&nbsp;<b></b><br>Referral/Consult:&nbsp;&nbsp;&nbsp;&nbsp;<b></b><br><br>Travel History (Abroad) Place/s:     Date/s:</font></td>
                  <td valign='TOP'><font style='font-weight:normal; text-indent:2px; font-size: 14px;'>Primary AP: <b><u><br>$ap</u></b></font></td>
                </tr>
                <tr>
                  <td valign='TOP'><font style='font-weight:normal; text-indent:2px; font-size: 12px;'>Co-Manage: <b><u><br></u></b></font></td>
                </tr>
                <tr>
                  <td colspan='2' style='text-align: center; background-color: lightgray;'><font style='font-weight:normal; text-indent:2px; font-size: 13px;'><b>II. PATIENT'S DATA</b></font></td>
                </tr>
                <tr>
                  <td><font size='3px'>1. Name of Patient <br>&nbsp;&nbsp;&nbsp;&nbsp;<b>$name</b></font></td>
                  <td><font size='2px'>2. PIN <br>&nbsp;&nbsp;&nbsp;&nbsp;<b>$pin</b></font></td>
                </tr>
                <tr>
                  <td colspan='2'><font style='font-weight:normal; text-indent:2px; font-size: 12px;'><small>&nbsp;&nbsp;&nbsp;&nbsp;Last Name | First Name | Middle Name</small></font></td>
                </tr>
                <tr>
                  <td rowspan='2' valign='TOP'><font size='2px'>5. Chief Complaint:<br>&nbsp;&nbsp;&nbsp;&nbsp;<b>$chiefcomplaint</font><br></td>
                  <td valign='TOP'><font style='font-weight:normal; text-indent:2px; font-size: 12px;'>Age: <br><b><u>$age</u></b></font></td>
                </tr>
                <tr>
                  <td valign='TOP'><font style='font-weight:normal; text-indent:2px; font-size: 12px;'>Sex:<input type='checkbox' name='typeSex' value='M' readonly='true' $male> Male <input type='checkbox' name='typeSex' value='M' readonly='true' $female> Female</font></td>
                </tr>
                <tr>
                  <td rowspan='2' valign='TOP'>
                  <table width='100%' border='1' style='border-collapse: collapse;'>
                    <tr>
                      <td width='50%'  style='height: 90px;' valign='TOP'><font size='2px'>Admitting Diagnosis:<br>&nbsp;&nbsp;&nbsp;&nbsp;<b>$admittingdiagnosis</b></font></td>
                      <td width='50%' valign='TOP'><font size='2px'>Final Diagnosis:<br>&nbsp;&nbsp;&nbsp;&nbsp;<b>$finaldiagnosis</b></font></td>
                    </tr>
                  </table>
                  <td valign='TOP'><font style='font-weight:normal; text-indent:2px; font-size: 12px;'>8.a. 1st Case Rate Code <br><b><u></u></b></font></td>
                </tr>
                <tr>
                  <td valign='TOP'><font style='font-weight:normal; text-indent:2px; font-size: 12px;'>8.b. 2nd Case Rate Code <br><b><u></u></b></font></td>
                </tr>

                <tr>
                  <td colspan='2'><font style='font-weight:normal; text-indent:2px; font-size: 12px;'>9.a. Date admitted&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9.b. Time admitted:<br><b>$dateadmit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $timeadmit</b></font></td>
                </tr>
                <tr>
                  <td colspan='3'><font style='font-weight:normal; text-indent:2px; font-size: 12px;'>10.a. Date discharged&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10.b. Time discharged:<br><b>$datedischarged&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$timedischarged</b></font></td>
                </tr>
                <?php
                <tr>
                  <td colspan='2' style='text-align: center; background-color: lightgray;'><font style='font-weight:normal; text-indent:2px; font-size: 13px;'><b>III. REASON FOR ADMISSION</b></font></td>
                </tr>
                <tr>
                  <td colspan='2' style='height: 100px;' valign='TOP'><font style='font-weight:normal; text-indent:2px; font-size: 14px;'>1.History of Present Illness: <br>&nbsp;&nbsp;&nbsp;&nbsp;<b>$historyofpresentillness</b></font></td>
                </tr>
                <tr>
                  <td colspan='2' style='height: 100px;' valign='TOP'><font style='font-weight:normal; text-indent:2px; font-size: 14px;'>2.a. Pertinent Past Medical History: <br>&nbsp;&nbsp;&nbsp;&nbsp;<b>$pastmedicalhistory</b><br><br>2.b. OB/GYN History: <br>G: &emsp;$pPregCnt&emsp;&emsp;P: &emsp;$pDeliveryCnt&emsp;&emsp;LMP: &emsp;$pLastMensPeriod&emsp;&emsp;<input type='checkbox' value='NA' name='na' $male> NA&emsp;&emsp;Others: <u style='text-transform:uppercase;'></u></font></td>
                </tr>
                <tr><td colspan='2' style='height: 100px;' valign='TOP'><font style='font-weight:normal; text-indent:2px; font-size: 12px;'>3. Pertinent Signs and Symptoms on Admission: <br>
                    <table width='98%' align='center' border='0' style='border-collapse: collapse;'>
                      <tr>

";
$i=1;
$x = 0;
$sql2 = "SELECT * FROM tsekap_lib_symptoms WHERE LIB_STAT = '1' AND SYMPTOMS_ID NOT IN('X','38') ORDER BY SYMPTOMS_DESC ASC";
$result2 = $conn->query($sql2);

while($row2 = $result2->fetch_assoc()) {
$SYMPTOMS_ID=$row2["SYMPTOMS_ID"];
$SYMPTOMS_DESC=$row2["SYMPTOMS_DESC"];
$col='black';
$SYMPTOMS_ID2 = $SYMPTOMS_ID.";";
$x++;

$subj = $conncf4->query("select * from subjective where caseno='$caseno'");
$s1count=mysqli_num_rows($subj);
if ($s1count==0)
{
$symp = explode(";", '');
$pPainSite='';
$pOtherComplaint='';
$c=0;
$countsymp=0;
}
else {
while($myrow = $subj->fetch_assoc()){
$symp = explode(";", $myrow['pSignsSymptoms']);
$pPainSite = $myrow['pPainSite'];
$pOtherComplaint = $myrow['pOtherComplaint'];
$countsymp = count($symp);
}
}

$sqlpainSite=$conncf4->query("SELECT * FROM subjective WHERE caseno='$caseno'");
$paincount=mysqli_num_rows($sqlpainSite);
if($paincount==0)
{
  $pp='';
}
else{
while($painsite = $sqlpainSite->fetch_assoc()){
  $pp=$painsite["pPainSite"];
}
}

//print_r($symp);
$c=0;
//echo $countsymp."sdfgh";
for($d=0; $d<$countsymp; $d++){
if($SYMPTOMS_ID == $symp[$d]){$c++;}
//echo $symp[$d]."<br / />";
}


if($c>0){$checked="checked";}else{$checked="";}
if($pOtherComplaint != ""){$checked2="checked";}else{$checked2="";}
if($aa != ""){$checked3="checked";}else{$checked3="";}
if($bb != ""){$checked4="checked";}else{$checked4="";}
if($cc != ""){$checked5="checked";}else{$checked5="";}
if($dd != ""){$checked6="checked";}else{$checked6="";}
if($ee != ""){$checked7="checked";}else{$checked7="";}
if($ff != ""){$checked8="checked";}else{$checked8="";}
if($gg != ""){$checked9="checked";}else{$checked9="";}
if($pp != ""){$checkedp="checked";}else{$checkedp="";}
echo"<td width='25%' style='font-size: 12px'><font color='$col'><input type='checkbox' name='symptom$x' value='$SYMPTOMS_ID2' id='ch_$SYMPTOMS_DESC' onclick='loadtxt()' $checked> $SYMPTOMS_DESC</td>";
if($i<4)
  {
    $i++;
    if($SYMPTOMS_DESC=="ORTHOPNEA")
    {
      echo"<tr><td colspan='4' valign='TOP'>
      <table width='100%' border='0' style='border-collapse: collapse;'>
      <tr>
        <td colspan='2' valign='TOP' style='font-size: 11px'><font color='$col'><input type='checkbox' name='symptomother' value='X;' id='ch_others' $checkedp> PAIN: <b>$pPainSite</b></font></td>
      </tr>
      </table>
      </td></tr>";
    }
  }
  else
    {
      echo"</tr>"; $i=1;
    }

}
echo"
                </tr>
                <tr><td colspan='4' valign='TOP'>
                <table width='100%' border='0' style='border-collapse: collapse;'>
                <tr>
                  <td colspan='2' valign='TOP' style='font-size: 11px'><font color='$col'><input type='checkbox' name='symptomother' value='X;' id='ch_others' $checked2> OTHERS: <b>$pOtherComplaint</b></font></td>
                </tr>
                </table>
                </td></tr>
                </table>
                </font>
                </td></tr>

";?>
                <tr>
                 <td colspan='2' style='height: 80px;' valign='TOP'><font style="font-weight:normal; font-size: 13px; text-indent:2px;">4. Referred from another Health Care Institution (HCI):</font><br><br>&nbsp;&nbsp;
                    <font style='font-size: 12px'>
                      <input type="checkbox" name="referredHci" value="N" readonly="true" style='width:20px;' <?=$no;?>/> No &emsp;&emsp;
                      <input type="checkbox" name="referredHci" value="Y" readonly="true" style='width:20px;' <?=$yes;?>/> Yes, Specify Reason: <u style="text-transform:uppercase;"><b><?=$reason;?></b></u><br><br>
                    </font>
                    <font style="margin-left:50px; font-size: 12px">Name of Originating HCI: <u style="text-transform:uppercase;"><b><?=$transfer;?></b></u></font><br></td>
                </tr><?php
echo"
        </table>
    </table>
</div>
<div width='730' align='center' class='A4'>
      <table align='center' style='border-collapse: collapse;' border='0' width='100%'>
      <tr><td>
      <table width='100%' border='1' style='border-collapse: collapse;'>
        <td colspan='2' valign='top'>
        <table width='100%' border='0' cellpadding='0' cellspacing='0'>
          <font style='font-weight:normal; text-indent:2px; font-size: 12px;'>5. Physical Examination on Admission (Pertinent Findings per System)</font><br>
          <font style='text-indent:2px; font-size:13px;''> General Survey:&emsp;&emsp;<?php
";
?>
<?php
while($gensurvey=mysqli_fetch_array($sqlGensurvey)){ ?>

    <font style='font-size: 12px'><b><input type='checkbox' <?php if($survey['pGenSurveyId']==$gensurvey['GENSURVEY_ID']){ echo 'checked';}?>> <?=$gensurvey['GENSURVEY_DESC'];?> &emsp;&emsp;&emsp;</b></font>
      <?php }?>
    <font style='font-size: 12px'>Remarks: <u><b><?=$survey['pGenSurveyRem'];?></b></u></font>
    </font><br><br>
    <font style="font-size:12px; text-indent:2px;">&emsp;Vital Signs: &emsp;BP:&emsp;<u><b><?=$vital['pSystolic'];?> / <?=$vital['pDiastolic'];?> mmHg</b></u>&emsp;HR: &emsp;<u><b><?=$vital['pHr'];?> /min</b></u>&emsp;RR: &emsp;<u><b><?=$vital['pRr'];?> /min</b></u> &emsp;Temp: &emsp;<u><b><?=$vital['pTemp'];?> &#176;C</b></u>&emsp; Height:&emsp;<u><b><?=$vital['pHeight'];?> cm</b></u> &emsp;Weight: &emsp;<u><b><?=$vital['pWeight'];?> kg</b></u></font><br><br>
<?php
echo "            </font>
                  </td>
                </tr>
          <font style='font-size:12px;'>&nbsp HEENT:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
          <table width='80%'' border='0' style='margin-left:100px; margin-top:-17px;'>
          <tr>";
            ?>
            <?php
              $l=1;
              while($heent=mysqli_fetch_array($sqlheent))
              {
                if($l>3)
                {
                  echo "</tr>";
                  $l=1;
                }
                echo "<td width='25%' style='vertical-align:top; font-size: 12px; font-weight= bold'><input type='checkbox'"; if($pheent[0]==$heent['HEENT_ID']){ echo "checked"; }  echo "> $heent[HEENT_DESC]";if($heent['HEENT_DESC']=="Others"){ echo ": <u>".$peremarks['pHeentRem']."</u>"; }
                $l++;
              }
echo "
          </tr>
          <tr><td colspan='4' valign='TOP'>
          <table width='100%' border='0' style='border-collapse: collapse;'>
          <tr>
            <td colspan='4' valign='TOP' style='font-size: 11px'><font color='$col'><input type='checkbox' $checked3> Others: <b>$aa</b></font></td>
          </tr>
          </table>
          </td></tr>
          </table>
          </font>
          <font style='font-size:11px;'>&nbsp CHEST/LUNGS:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
          <table width='80%'' border='0' style='margin-left:100px; margin-top:-17px;'>
          <tr>";?>
              <?php
               $l=1;
               while($chest=mysqli_fetch_array($sqlchest))
               {
                 if($l>3)
                 {
                   echo "</tr>";
                   $l=1;
                 }
                 echo "<td width='25%' style='vertical-align:top; font-size: 12px; font-weight= bold'><input type='checkbox'"; if($pchest[0]==$chest['CHEST_ID']){ echo "checked"; }  echo "> $chest[CHEST_DESC]"; if($chest['CHEST_DESC']=="Others"){ echo " : <u>".$peremarks['pChestRem']."</u>"; }
                 $l++;
               }
echo "
          </tr>
          <tr><td colspan='4' valign='TOP'>
          <table width='100%' border='0' style='border-collapse: collapse;'>
          <tr>
            <td colspan='4' valign='TOP' style='font-size: 11px'><font color='$col'><input type='checkbox' $checked4> Others: <b>$bb</b></font></td>
          </tr>
          </table>
          </td></tr>
          </table>
          </font>
          <font style='font-size:12px;'>&nbsp CVS:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
          <table width='80%'' border='0' style='margin-left:100px; margin-top:-17px;'>
          <tr>";?>
                <?php
                $l=1;
                while($heart=mysqli_fetch_array($sqlheart))
                {
                  if($l>3)
                  {
                    echo "</tr>";
                    $l=1;
                  }
                  echo "<td width='25%' style='vertical-align:top; font-size: 12px; font-weight= bold'><input type='checkbox'"; if($pheart[0]==$heart['HEART_ID']){ echo "checked"; }  echo "> $heart[HEART_DESC]"; if($heart['HEART_DESC']=="Others"){ echo " : <u>".$peremarks['pHeartRem']."</u>"; }
                  $l++;
                }
echo "
          </tr>
          <tr><td colspan='4' valign='TOP'>
          <table width='100%' border='0' style='border-collapse: collapse;'>
          <tr>
            <td colspan='4' valign='TOP' style='font-size: 11px'><font color='$col'><input type='checkbox' $checked5> Others: <b>$cc</b></font></td>
          </tr>
          </table>
          </td></tr>
          </table>
          </font>
          <font style='font-size:12px;'>&nbsp ABDOMEN:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
          <table width='80%'' border='0' style='margin-left:100px; margin-top:-17px;'>
          <tr>";?>
                <?php
                $l=1;
                while($abdomen=mysqli_fetch_array($sqlabdomen))
                {
                  if($l>3)
                  {
                    echo "</tr>";
                    $l=1;
                  }
                  echo "<td width='25%' style='vertical-align:top; font-size: 12px; font-weight= bold'><input type='checkbox'"; if($pabdomen[0]==$abdomen['ABDOMEN_ID']){ echo "checked"; }  echo "> $abdomen[ABDOMEN_DESC]"; if($abdomen['ABDOMEN_DESC']=="Others"){ echo " : <u>".$peremarks['pAbdomenRem']."</u>"; }
                  $l++;
                }
echo "
          </tr>
          <tr><td colspan='4' valign='TOP'>
          <table width='100%' border='0' style='border-collapse: collapse;'>
          <tr>
            <td colspan='4' valign='TOP' style='font-size: 11px'><font color='$col'><input type='checkbox' $checked6> Others: <b>$dd</b></font></td>
          </tr>
          </table>
          </td></tr>
          </table>
          </font>
          <font style='font-size:12px;'>&nbsp GU (IE):&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
          <table width='80%'' border='0' style='margin-left:100px; margin-top:-17px;'>
          <tr>";?>
                <?php
                $l=1;
                while($guie=mysqli_fetch_array($sqlguie))
                {
                  if($l>3)
                  {
                    echo "</tr>";
                    $l=1;
                  }
                  echo "<td width='25%' style='vertical-align:top; font-size: 11px; font-weight= bold'><input type='checkbox'"; if($pguie[0]==$guie['GU_ID']){ echo "checked"; }  echo "> $guie[GU_DESC]"; if($guie['GU_DESC']=="Others"){ echo " : <u>".$peremarks['pGuRem']."</u>"; }
                  $l++;
                }
echo "
          </tr>
          <tr><td colspan='4' valign='TOP'>
          <table width='100%' border='0' style='border-collapse: collapse;'>
          <tr>
            <td colspan='4' valign='TOP' style='font-size: 11px'><font color='$col'><input type='checkbox' $checked7> Others: <b>$ee</b></font></td>
          </tr>
          </table>
          </td></tr>
          </table>
          </font>
          <font style='font-size:12px;'>&nbsp SKIN/<br>&nbspEXTREMITIES:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
          <table width='80%'' border='0' style='margin-left:100px; margin-top:-17px;'>
          <tr>";?>
                <?php
                $l=1;
                while($skin=mysqli_fetch_array($sqlskin))
                {
                  if($l>3)
                  {
                    echo "</tr>";
                    $l=1;
                  }
                  echo "<td width='25%' style='vertical-align:top; font-size: 12px; font-weight= bold'><input type='checkbox'"; if($pskin[0]==$skin['SKIN_ID']){ echo "checked"; }  echo "> $skin[SKIN_DESC]"; if($skin['SKIN_DESC']=="Others"){ echo " : <u>".$peremarks['pSkinRem']."</u>"; }
                  $l++;
                }
echo "
          </tr>
          <tr><td colspan='4' valign='TOP'>
          <table width='100%' border='0' style='border-collapse: collapse;'>
          <tr>
            <td colspan='4' valign='TOP' style='font-size: 11px'><font color='$col'><input type='checkbox' $checked8> Others: <b>$ff</b></font></td>
          </tr>
          </table>
          </td></tr>
          </table>
          </font>
          <font style='font-size:11px;'>&nbsp NEURO-EXAM:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
          <table width='80%'' border='0' style='margin-left:100px; margin-top:-17px;'>
          <tr>";?>
                <?php
                $l=1;
                while($neuro=mysqli_fetch_array($sqlneuro))
                {
                  if($l>3)
                  {
                    echo "</tr>";
                    $l=1;
                  }
                  echo "<td width='25%' style='vertical-align:top; font-size: 12px; font-weight= bold'><input type='checkbox'"; if($pneuro[0]==$neuro['NEURO_ID']){ echo "checked"; }  echo "> $neuro[NEURO_DESC]"; if($neuro['NEURO_DESC']=="Others"){ echo " : <u>".$peremarks['pNeuroRem']."</u>"; }
                  $l++;
                }
echo "
          </tr>
          <tr><td colspan='4' valign='TOP'>
          <table width='100%' border='0' style='border-collapse: collapse;'>
          <tr>
            <td colspan='4' valign='TOP' style='font-size: 11px'><font color='$col'><input type='checkbox' $checked9> Others: <b>$gg</b></font></td>
          </tr>
          </table>
          </td></tr>
          </table>
          </font>
          <tr>
          <td colspan='2' style='text-align: center; background-color: lightgray;'><font style='font-weight:normal; text-indent:2px; font-size: 13px;'><b> IV. COURSE IN THE WARD (Attach photocopy of laboratory/image results)</b></font></td>
          </tr>
          <tr>
            <td colspan='2' valign='TOP'>
            <table width='100%' border='1' style='border-collapse: collapse;'>
              <tr>
                <td width='25%' style='font-size: 13px; font=Tahoma11black; text-align: center'>DATE</td>
                <td width='80%' style='font-size: 13px; font=Tahoma11black; text-align: center'>DOCTOR'S ORDER/ACTION</td>
              </tr>
              <tbody>";
              ?><?php
                  while($course=mysqli_fetch_array($sqlcourseward)){
                        echo "<!--tr>";
                          echo "<td style='font-size: 13px; text-align: center'>$course[pDateAction]</td>";
                          echo "<td style='font-size: 12px; text-align: justify'>$course[pDoctorsAction]</td>";
                        echo "</tr-->";
                      }
              ?><?php
echo "      </tbody>
            </table>
            </td></tr><br><br>
        <tr>
          <td colspan='2' valign='TOP'>
          <span style='font-weight:normal; text-indent:2px; font-size: 13px;'> SURGICAL PROCEDURE/RVS/CODE (Attach photocopy of OR technique):&nbsp;&nbsp;&nbsp;&nbsp;</span>
          </td>
        </tr>
        <tr>
          <td colspan='2' style='text-align: center; background-color: lightgray;'><font style='font-weight:normal; text-indent:2px; font-size: 13px;'><b> V. DRUGS/MEDICINES</b></font></td>
        </tr>
        <tr>
          <td colspan='2' valign='TOP'>
          <table width='100%' border='1' style='border-collapse: collapse;'>
                  <tr style='text-align: center;'>
                        <td width='25%' style='font-size: 13px'>Generic Name</td>
                        <td width='50%' style='font-size: 13px'>Quantity/Dosage/Route</td>
                        <td width='25%' style='font-size: 13px'>Total Cost</td>
                  </tr>
                  <tbody>
                  </tbody>
          </table>
            <b style='font-size: 12px'> Number of record/s: <br>
          </td>
        </tr>
        <tr>
          <td colspan='2' style='text-align: center; background-color: lightgray;'><font style='font-weight:normal; text-indent:2px; font-size: 12px;'><b> VI. OUTCOME OF TREATMENT</b></font></td>
        </tr>
        <tr>
           <td colspan='2' style='text-indent:2px;'><font style='font-size: 12px'>
           <input type='checkbox' name='outTreatment' value='1' readonly='true'/> IMPROVED&emsp;&emsp;
           <input type='checkbox' name='outTreatment' value='2' readonly='true'/> HAMA&emsp;&emsp;
           <input type='checkbox' name='outTreatment' value='3' readonly='true'/> EXPIRED&emsp;&emsp;
           <input type='checkbox' name='outTreatment' value='4' readonly='true'/> ABSCONDED&emsp;&emsp;
           <input type='checkbox' name='outTreatment' value='5' readonly='true'/> TRANSFERRED&emsp;&emsp;
           <br><br>&nbspSpecify reason: __________________________
           </font></td>
        </tr>
        <!--</td></tr>
        </table>
    </table>
</div>
<div width='730' align='center' class='A4'><br><br><br><br>
  <table align='center' style='border-collapse: collapse;' border='0' width='100%'>
      <tr><td>
      <table width='100%' border='1' style='border-collapse: collapse;'>-->
        <tr>
          <td colspan='2' style='text-align: center; background-color: lightgray;'><font style='font-weight:normal; text-indent:2px; font-size: 12px;'><b> VII. CERTIFICATION OF HEALTH CARE PROFESSIONAL</b></font></td>
        </tr>
        <tr>
          <td colspan='2' style='height: 80px;' valign='TOP'>
          <font style='font-weight:normal; text-indent:2px; font-size: 13px;'><br>&nbsp; Certification of Attending Health Care Professional:&nbsp;&nbsp;&nbsp;&nbsp;
          <p style='font-style: italic;text-align: center; font-size: 15px'>I certify that the above information given in this form, including all attachments, are true and correct.</p><br><br>
          <p style='text-align: center;'>   _________________________________________________________________&emsp;&emsp;&emsp;&emsp;____________________<br>
          Signature over Printed Name of Attending Health Care Professional
          &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Date Signed</p>
          </font>
          </td>
        </tr>
      </table>
    </td>
  </table>
</table>
";
?>
<table border="0" width="100%">
  <tr>
    <td height="20px"></td>
  </tr>
  <tr>
  <td><div align="left" style="font-size: 12px;font-family: arial; color: black;">Prepared By: <?=$_SESSION['username'];?>
  <td><div align="right" style="font-size: 12px;font-family: arial; color: black;">Prepared Date: <?=date('M d, Y');?></div></td>
</tr>
</table>
<?php
echo "
</td></tr>
</table>
</div>
";
?>