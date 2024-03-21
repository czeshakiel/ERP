
<style>
.A4 {
  background: white;
  width: 21.59cm;
  height: 33.05cm;
  display: block;
  margin: 0 auto;
  padding: 10px 25px;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
  overflow-y: scroll;
  box-sizing: border-box;
  overflow: hidden;
}

@media print {
  @page {
     size: 8.5in 13in landscape;
  }
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

.notes {
    background-attachment: local;
    background-image:
        linear-gradient(to right, white 10px, transparent 10px),
        linear-gradient(to left, white 10px, transparent 10px),
        repeating-linear-gradient(white, white 20px, #000000 20px, #000000 21px, white 21px);
    line-height: 21px;
    padding: 4px 5px;
	border: none;
    outline: none;
	resize: none;
	width: 100%;
	rows: 2;
	font-family:"Times New Roman", Times, serif;
	font-size: 12px;
}

.textt {
    font-size: 11px;
    letter-spacing: 2px;
    height: 11px;
    border: 1px solid gray;
    padding:10px,20px;
    width: 20%;
    overflow: hidden;
    resize: vertical;
    outline: none;
    border-top:none;
    border-left: none;
    border-right: none;
	text-align: center;
  }
 
  .textt2 {
    height: 12px;
    border: 1px solid gray;
    padding:12px,20px;
    width: 100%;
    overflow: hidden;
    resize: vertical;
    outline: none;
    border-top:none;
    border-left: none;
    border-right: none;
	text-align: center;
	font-family:"Times New Roman", Times, serif;
	font-size: 11px;
  }
</style>

<?php
$caseno=$_GET['caseno'];
$refno=$_GET['refno'];
include '../main/class.php';


$sql222 = $conn->query("SELECT * FROM productout where caseno='$caseno' and refno='$refno'");
while($row222 = $sql222->fetch_assoc()) {
$approvalno=$row222['approvalno'];
$referenceno=$row222['referenceno'];
list($user, $filmno) = explode('-', $approvalno);
}

$sql2222 = $conn->query("SELECT * FROM admission where caseno='$caseno'");
while($row2222 = $sql2222->fetch_assoc()){
$room=$row2222['room'];
$patientidno=$row2222['patientidno'];
$ap=$row2222['ap'];
$street=$row2222['street'];
$barangay=$row2222['barangay'];
$municipality=$row2222['municipality'];
$province=$row2222['province'];
$address22=$street." ".$barangay." ".$municipality.", ".$province;
}

$sql2222x = $conncf4->query("SELECT * FROM pepert where caseno='$caseno'");
while($row2222x = $sql2222x->fetch_assoc()){
$height=$row2222x['pHeight'];
$weight=$row2222x['pWeight'];
}

$sql3 = $conn->query("SELECT * from patientprofile where patientidno='$patientidno'");
if(mysqli_num_rows($sql3)==0){$sql3 = $conn->query("SELECT concat(lastname,' ',firstname,' ',middlename) as patientname, birthdate, age, age as senior, gender as sex from nsauthemployees where empid='$patientidno'");}
while($row3 = $sql3->fetch_assoc()){
$age=$row3['age'];
$sex=$row3['sex'];
$name=$row3['patientname'];
if($sex=='M') {$sex='MALE';} elseif($sex=='F') {$sex='FEMALE';}
}


$sql1x = $conn->query("select * from 2dechoresult_ver2 where caseno='$caseno' and refno='$refno'");
while($row1x = $sql1x->fetch_assoc()){
$radiologist=$row1x['reader'];
$prodsubtype=$row1x['clinicalservices'];
$interpretation=$row1x['interpretation'];
$interpret=$row1x['interpretation'];
$description=$row1x['partexamined'];
$filmno=$row1x['filmno'];
$remarks=$row1x['remarks'];
$validate=$row1x['validate'];
$testtype = $row1x['lab111'];
$radiologist=$row1x['radiologist'];
$partexamined=$row1x['partexamined'];
$daterr= date("F d, Y || h:i:s a", strtotime($row1x['date']));
$height=$row1x['height'];
$weight=$row1x['weight'];
$bsa=$row1x['BSA'];
$hr=$row1x['HR'];

for($i=1; $i <= 111;$i++){$table="lab".$i; $lab[$i]=$row1x["$table"];}

$normal=""; $abnormal="";
if($lab[46]=="Normal"){$normal="checked";}else{$abnormal="checked";}

$poor=""; $fair=""; $average=""; $good=""; $high="";
if($lab[51]=="Poor"){$poor="checked";}
if($lab[51]=="Fair"){$fair="checked";}
if($lab[51]=="Average"){$average="checked";}
if($lab[51]=="Good"){$good="checked";}
if($lab[51]=="High"){$high="checked";}
}

if($radiologist == "ELMA PACIFICO CONAHAP MD, DPBR, FCT-MRISP"){$sig ="1";	}
if($radiologist == "APOLONIO S. BERNARDO MD, FPCR, FUSP, Fellow-CTMRI")
{$sig ="2";	}

if (strpos($partexamined, 'PEDIA') !== false){
$title="PEDIA 2D ECHOCARDIOGRAPHY REPORT";
$label="PEDIA CARDIOLOGIST";
}elseif (strpos($partexamined, 'ADULT') !== false){
$title= "ADULT 2D ECHOCARDIOGRAPHY REPORT";
$label="ADULT CARDIOLOGIST";
}
else{
$title= "2D ECHOCARDIOGRAPHY REPORT";
$label="CARDIOLOGIST";
}


if(strpos($validate, 'MOJICA')!==false){ $cardio_sig="drmojica.png";}
elseif(strpos($validate, 'DENILA')!==false){ $cardio_sig="drdenila.png";}
elseif(strpos($validate, 'MALALUAN')!==false){ $cardio_sig="drmalaluan.png";}
elseif(strpos($validate, 'PARAGAS')!==false){ $cardio_sig=""; $label="PEDIA CARDIOLOGIST";}

$reasonfortermination=str_replace('"', "", $lab[45]);
$reasonfortermination=str_replace('[', "", $reasonfortermination);
$reasonfortermination=str_replace(']', "", $reasonfortermination);
$reasonfortermination = explode(",", $reasonfortermination);
$countrft = count($reasonfortermination);

$s[1]=""; $s[2]=""; $s[3]=""; $s[4]=""; $s[5]=""; $s[6]=""; $s[7]=""; $s[8]="";
$s[9]=""; $s[10]=""; $s[11]=""; $s[12]=""; $s[13]=""; $s[14]=""; $s[15]=""; $s[16]="";
for($d=0; $d<=$countrft; $d++){
if($reasonfortermination[$d]=='1'){$s[1]="checked";}
elseif($reasonfortermination[$d]=='2'){$s[2]="checked";}
elseif($reasonfortermination[$d]=='3'){$s[3]="checked";}
elseif($reasonfortermination[$d]=='4'){$s[4]="checked";}
elseif($reasonfortermination[$d]=='5'){$s[5]="checked";}
elseif($reasonfortermination[$d]=='6'){$s[6]="checked";}
elseif($reasonfortermination[$d]=='7'){$s[7]="checked";}
elseif($reasonfortermination[$d]=='8'){$s[8]="checked";}
elseif($reasonfortermination[$d]=='9'){$s[9]="checked";}
elseif($reasonfortermination[$d]=='10'){$s[10]="checked";}
elseif($reasonfortermination[$d]=='11'){$s[11]="checked";}
elseif($reasonfortermination[$d]=='12'){$s[12]="checked";}
elseif($reasonfortermination[$d]=='13'){$s[13]="checked";}
elseif($reasonfortermination[$d]=='14'){$s[14]="checked";}
elseif($reasonfortermination[$d]=='15'){$s[15]="checked";}
elseif($reasonfortermination[$d]=='16'){$s[16]="checked";}
}


$highriskfeature=str_replace('"', "", $lab[49]);
$highriskfeature=str_replace('[', "", $highriskfeature);
$highriskfeature=str_replace(']', "", $highriskfeature);
$highriskfeature = explode(",", $highriskfeature);
$counthrf = count($highriskfeature);

$t[1]=""; $t[2]=""; $t[3]=""; $t[4]=""; $t[5]=""; $t[6]=""; $t[7]=""; $t[8]="";
for($d=0; $d<=$counthrf; $d++){
if($highriskfeature[$d]=='1'){$t[1]="checked";}
elseif($highriskfeature[$d]=='2'){$t[2]="checked";}
elseif($highriskfeature[$d]=='3'){$t[3]="checked";}
elseif($highriskfeature[$d]=='4'){$t[4]="checked";}
elseif($highriskfeature[$d]=='5'){$t[5]="checked";}
elseif($highriskfeature[$d]=='6'){$t[6]="checked";}
elseif($highriskfeature[$d]=='7'){$t[7]="checked";}
elseif($highriskfeature[$d]=='8'){$t[8]="checked";}
}


$otherpostexc=str_replace('"', "", $lab[50]);
$otherpostexc=str_replace('[', "", $otherpostexc);
$otherpostexc=str_replace(']', "", $otherpostexc);
$otherpostexc = explode(",", $otherpostexc);
$countope = count($otherpostexc);

$u[1]=""; $u[2]=""; $u[3]=""; $u[4]=""; $u[5]=""; $u[6]="";
for($d=0; $d<=$countope; $d++){
if($otherpostexc[$d]=='1'){$u[1]="checked";}
elseif($otherpostexc[$d]=='2'){$u[2]="checked";}
elseif($otherpostexc[$d]=='3'){$u[3]="checked";}
elseif($otherpostexc[$d]=='4'){$u[4]="checked";}
elseif($otherpostexc[$d]=='5'){$u[5]="checked";}
elseif($otherpostexc[$d]=='6'){$u[6]="checked";}
}

$in1 = ""; $in2 = ""; $in3 = ""; $in4 = ""; $in5 = "";
$inn1 = ""; $inn2 = ""; $inn3 = ""; $inn4 = ""; $inn5 = "";
if($lab[54]=="Normal Stress Test"){$in1 = "checked"; $inn1 = "$lab[55]";}
if($lab[54]=="Abnormal Stress Test"){$in2 = "checked"; $inn2 = "$lab[55]";}
if($lab[54]=="Equivocal Stress Test"){$in3 = "checked"; $inn3 = "$lab[55]";}
if($lab[54]=="Inadequate Stress Test"){$in4 = "checked"; $inn4 = "$lab[55]";}
if($lab[54]=="Functional Capacity"){$in5 = "checked"; $inn5 = "$lab[55]";}

$low=""; $moderate=""; $highx="";
if($lab[52]=="Low Risk"){$low="checked";}
if($lab[52]=="Moderate Risk"){$moderate="checked";}
if($lab[52]=="High Risk"){$highx="checked";}

echo "
<div width='730' align='center' class='A4'><br>
<table align='center'  style='border-collapse: collapse;' border='0' width='100%'>
<tr><td>

<table width='100%' align='center'>
<tr>
<td width='7%'><img src='http://$ip/arv2022/main/img/logo/mmshi.png' width='50' height='auto'></td>
<td><p align='center'><b>$heading<br><font size='1%'>$address<br>$telno</font></b></p></td>
</tr>
</table>

</td></tr>
<tr>
<td>
<table width='100%' style='border-collapse: collapse;' border='0'>
<tr><td colspan='4' style='font-weight:bold' align='center'>$testtype STRESS TEST REPORT</td></tr>

<tr>
<td style='font-size:11px; width: 15%;'>LABORATORY NO:</td>
<td style=' width: 35%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$filmno</td>
<td style=' width: 15%; font-size:11px;'>&nbsp;&nbsp;&nbsp;DATE:</td>
<td style=' width: 35%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$daterr</td>
</tr>
				<tr>
					<td style='font-size:11px;'>CASENO:</td>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$caseno</td>
					<td style='font-size:11px;'>&nbsp;&nbsp;&nbsp;EXAMINATION:</td>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'>$partexamined</td>
				</tr>
				<tr>
					<td style='font-size:11px;'>NAME:</td>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$name</td>
					<td style='font-size:11px;'>&nbsp;&nbsp;&nbsp;AGE/SEX:</td>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$age/$sex</td>
				</tr>



			</table>

<table width='100%'>
			<tr>
				<td style='font-size:11px; width: 10%;'><p align='left'>HEIGHT: </p></td>
				<th style=' width: 10%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'><p align='left'>$height cm/ft</p></th>
				<td style='font-size:11px; width: 5%;'></td>
				<td style='font-size:11px; width: 10%;'><p align='left'>WEIGHT: </p></td>
				<th style=' width: 10%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'><p align='left'>$weight kg</p></th>
				<td style='font-size:11px; width: 5%;'></td>
				<td style='font-size:11px; width: 10%;'><p align='left'>BSA: </p></td>
				<th style=' width: 10%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px''><p align='left'>$bsa</p></th>
				<td style='font-size:11px; width: 5%;'></td>
				<td style='font-size:11px; width: 10%;'><p align='left'>HEART RATE: </p></td>
				<th style=' width: 10%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px''><p align='left'>$hr</p></th>
				<td style='font-size:11px; width: 5%;'></td>
				</tr>
				</table>


        <table width='100%'>
        <tr>
          <td style='font-size:11px; width: 10%;'><p align='left'>SBP: </p></td>
          <th style=' width: 10%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'><p align='left'>$lab[57] mmHg</p></th>
          <td style='font-size:11px; width: 5%;'></td>
          <td style='font-size:11px; width: 10%;'><p align='left'>DBP: </p></td>
          <th style=' width: 10%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'><p align='left'>$lab[58] mmHg</p></th>
          <td style='font-size:11px; width: 5%;'></td>
          <td style='font-size:11px; width: 10%;'><p align='left'>Target HR: </p></td>
          <th style=' width: 10%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px''><p align='left'>$lab[59] beats/min</p></th>
          <td style='font-size:11px; width: 5%;'></td>
          <td style='font-size:11px; width: 10%;'><p align='left'>MPHR: </p></td>
          <th style=' width: 10%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px''><p align='left'>$lab[60] beats/min</p></th>
          <td style='font-size:11px; width: 5%;'></td>
          </tr>
          </table>        
		</td>
	</tr>
";
?>

	<tr>
		<td valign="TOP">
			

<?php
echo"<hr>
<b style='font-size: 11px;'>MONITORED LEADS: I-II-III-aVR-aVL-aVF-V1-V2-V3-V4-V5-V6. Three minutes of walking at each indicated stage of exercise.</b>

<table width='100%' border='1' style='border-collapse: collapse;'>
<tr>
<td style='font-size:11px; text-align: center; width: 20%;'></td>
<td style='font-size:11px; text-align: center;'></td>
<td style='font-size:11px; text-align: center;'>Speed<br>(mph)</td>
<td style='font-size:11px; text-align: center;'>Grade(%)</td>
<td style='font-size:11px; text-align: center;'> Oxygen Consumption<br>(ml O2/kg/min)</td>
<td style='font-size:11px; text-align: center;'>Workload<br>(Mets)</td>
<td style='font-size:11px; text-align: center;'>Functional<br>Class</td>
<td style='font-size:11px; text-align: center;'>BP</td>
<td style='font-size:11px; text-align: center;'>HR</td>
</tr>
<tr>
<td style='font-size:11px; text-align: center;'><b>CONTROL SUPINE</b></td>
<td style='font-size:11px; text-align: center;'></td>
<td style='font-size:11px; text-align: center;'><b>$lab[1]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[2]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[3]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[4]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[5]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[6]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[7]</td>
</tr>
<tr>
<td style='font-size:11px; text-align: center;'><b>CONTROL STANDING</b></td>
<td style='font-size:11px; text-align: center;'></td>
<td style='font-size:11px; text-align: center;'><b>$lab[8]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[9]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[10]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[11]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[12]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[13]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[14]</td>
</tr>

<tr>
<td style='font-size:11px; text-align: center;'><b>STAGES:</b></td>
<td style='font-size:11px; text-align: center;'>1</td>
";
$z=2; $zz=0; $zzz=0; $num1 = 15; $num2=16;
$init = $conn->query("select * from stresstestinitial where test='$testtype'");
while($nv = $init->fetch_assoc()){
$nvalue = $nv['normalvalue'];
$zz++; $zzz++;

echo"
<td style='font-size:11px; text-align: center;'>$nvalue</td>
";

if($zz==5){
$v1="r".$num1;
$v2="r".$num2;
echo"
<td style='font-size:11px; text-align: center;'><b>$lab[$num1]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[$num2]</td>
</tr>
";
$num1= $num1+2; $num2=$num2+2;
}



if($zz==5 and mysqli_num_rows($init)>$zzz){echo"
<tr>
<td style='font-size:11px; text-align: center;'></td>
<td style='font-size:11px; text-align: center;'>$z</td>";
$zz=0; $z++;}
}
echo"</tr><tr>
</table>

<br>
<b style='font-size: 11px;'>BLOOD PRESSURE AND HEART RATE RECOVERY</b>
<table width='100%' class='tablex' border='1' style='border-collapse: collapse;'>
<tr>
<td style='font-size:11px; text-align: center;'></td>
<td style='font-size:11px; text-align: center; width: 20%;'>Immediately After</td>
<td style='font-size:11px; text-align: center;'>1 min</td>
<td style='font-size:11px; text-align: center;'>3 mins</td>
<td style='font-size:11px; text-align: center;'>5 mins</td>
<td style='font-size:11px; text-align: center;'>8 mins</td>
<td style='font-size:11px; text-align: center;'>11 mins</td>
</tr>
<tr>
<td style='font-size:11px; text-align: center;'><b>BP:</td>
<td style='font-size:11px; text-align: center;'><b>$lab[33]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[34]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[35]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[36]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[37]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[38]</td>
</tr>
<tr>
<td style='font-size:11px; text-align: center;'><b>HR:</td>
<td style='font-size:11px; text-align: center;'><b>$lab[39]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[40]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[41]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[42]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[43]</td>
<td style='font-size:11px; text-align: center;'><b>$lab[44]</td>
</tr>
</table>

<br>
<b style='font-size: 11px;'>REASONS FOR TERMINATION OF EXERSICE:</b>
<table width='100%' style='border-collapse: collapse;'>
<tr>
";
$z2=2; $zz2=0; $zzz2=0;
$init2 = $conn->query("select * from stresstestinitial where groupx='2'");
while($nv2 = $init2->fetch_assoc()){
$nvalue2 = $nv2['test'];
$zz2++; $zzz2++;
if($zz2==3){$w="40%";}else{$w="20%";}
echo"<td style='font-size:11px; width: $w;' valign='TOP'><input type='checkbox' onclick='return false;' name='reasonex[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $s[$zzz2]>$nvalue2</td>";
if($zz2==4 and mysqli_num_rows($init2)>$zzz2){echo"</tr>";$zz2=0; $z2++;}
}
echo"</tr><tr>
</table>


<table width='100%'>
<tr>
<td style='font-size:11px; width: 15%;'><b>RESTING ECG:</b></td>
<td>
<table width='100%'><tr>
<td style='font-size:11px; width: 15%;'><input type='checkbox' onclick='return false;' name='reasonex[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $normal> Normal</td>
<td style='font-size:11px; width: 15%;'><input type='checkbox' onclick='return false;' name='reasonex[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $abnormal> Abnormal</td>
<td style='font-size:11px;'><input type='text' value='$lab[47]' class='textt2' readonly></td>
</tr></table>
</td>
</tr>
</table>


<table width='100%'>
<tr>
<td style='font-size:11px; width: 30%;'><b>RESPONSES TO EXERCISE TEST:</b></td>
</tr><tr>
<td>
<textarea name='ifabnormal' class='notes' readonly>$lab[48]</textarea>
</td>
</tr>
</table>

<b style='font-size: 11px;'>HIGH RISK FEATURES:</b>
<table width='100%' style='border-collapse: collapse;'>
<tr>
";
$z2=2; $zz2=0; $zzz2=0;
$init2 = $conn->query("select * from stresstestinitial where groupx='3'");
while($nv2 = $init2->fetch_assoc()){
$nvalue2 = $nv2['test'];
$zz2++; $zzz2++;
echo"<td style='font-size:11px; width: 50%;' valign='TOP'><input type='checkbox' onclick='return false;' name='highrisk[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $t[$zzz2]> $nvalue2</td>";
if($zz2==2 and mysqli_num_rows($init2)>$zzz2){echo"</tr>";$zz2=0; $z2++;}
}
echo"</tr><tr>
</table>

<br>
<b style='font-size: 11px;'>OTHER POST EXERCISE FINDINGS:</b>
<table width='100%' style='border-collapse: collapse;'>
<tr>
";
$z2=2; $zz2=0; $zzz2=0;
$init2 = $conn->query("select * from stresstestinitial where groupx='4'");
while($nv2 = $init2->fetch_assoc()){
$nvalue2 = $nv2['test'];
$zz2++; $zzz2++;
echo"<td style='font-size:11px; width: 33%;' valign='TOP'><input type='checkbox' onclick='return false;' name='otherpost[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $u[$zzz2]> $nvalue2</td>";
if($zz2==3 and mysqli_num_rows($init2)>$zzz2){echo"</tr>";$zz2=0; $z2++;}
}
echo"</tr><tr>
</table>


<table width='100%'>
<tr>
<td style='font-size:11px;' width='20%'><b>FUNCTIONAL CAPACITY:</b></td>
<td>
<table width='80%'><tr>
<td style='font-size:11px; width: 20%;'><input type='checkbox' onclick='return false;' name='reasonex[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $poor> Poor</td>
<td style='font-size:11px; width: 20%;'><input type='checkbox' onclick='return false;' name='reasonex[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $fair> Fair</td>
<td style='font-size:11px; width: 20%;'><input type='checkbox' onclick='return false;' name='reasonex[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $average> Average</td>
<td style='font-size:11px; width: 20%;'><input type='checkbox' onclick='return false;' name='reasonex[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $good> Good</td>
<td style='font-size:11px; width: 20%;'><input type='checkbox' onclick='return false;' name='reasonex[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $high> High</td>
</tr></table>
</td>
</tr>
</table>

<table width='100%'>
<tr>
<td style='font-size:11px;' width='20%'><b>DUKE TREADMILL SCORE:</b></td>
<td>
<table width='100%'><tr>
<td style='font-size:11px; width: 25%; border-bottom:1px; border-bottom: solid 1px black; text-align: center;'>$lab[53]</td>
<td style='font-size:11px; width: 25%;'><input type='checkbox' onclick='return false;' name='reasonex[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $low> LOW RISK</td>
<td style='font-size:11px; width: 25%;'><input type='checkbox' onclick='return false;' name='reasonex[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $moderate> MODERATE RISK</td>
<td style='font-size:11px; width: 25%;'><input type='checkbox' onclick='return false;' name='reasonex[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $highx> HIGH RISK</td>
</tr></table>
</td>
</tr>
</table>


<b style='font-size: 11px;'>INTERPRETATION:</b>
<table width='100%'>
<tr>
<td style='font-size:11px;' width='50%'><input type='checkbox' onclick='return false;' name='reasonex[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $in1> NORMAL STRESS TEST AT <input type='text' value='$inn1' class='textt'> METS</td>
<td style='font-size:11px;'><input type='checkbox' onclick='return false;' name='reasonex[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $in4> INADEQUATE STRESS TEST AT <input type='text' value='$inn4' class='textt'> METS</td>
</tr>
<tr>
<td style='font-size:11px;'><input type='checkbox' onclick='return false;' name='reasonex[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $in2> ABNORMAL STRESS TEST AT <input type='text' value='$inn2' class='textt'> METS</td>
<td style='font-size:11px;'><input type='checkbox' onclick='return false;' name='reasonex[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $in5> FUNCTIONAL CAPACITY AT <input type='text' value='$inn5' class='textt'> METS</td>
</tr>
<tr>
<td style='font-size:11px;'><input type='checkbox' onclick='return false;' name='reasonex[]' style='transform : scale(1.0); accent-color: black;' value='$zzz2' $in3> EQUIVOCAL STRESS TEST AT <input type='text' value='$inn3' class='textt'> METS</td>
<td></td>
</tr>
</table>

<table width='100%'>
<tr>
<td style='font-size:11px; width: 30%;'><b>COMMENTS/ REMARKS:</b></td>
</tr><tr>
<td>
<textarea name='ifabnormal' class='notes' readonly>$lab[56]</textarea>
</td>
</tr>
</table>


<table width='40%' align='right'>
<tr>
<td style='font-size:12px;font-weight: normal; vertical-align:bottom;text-align:center; background-image:url(http://$ip/arv2022/heart/signature/$cardio_sig); background-repeat:no-repeat;background-size:180px 80px; background-position: center;'>
<br><br><br><br><b>$validate</b><br>
$label
</td>
</tr>
</table>
";
?>



</td>
</tr>
</table>
</div>







</body>
</html>
