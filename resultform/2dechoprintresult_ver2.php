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


.watermark__inner {
    /* Center the content */
    align-items: center;
    display: flex;
    justify-content: center;

    /* Absolute position */
    left: 0px;
    position: fixed;
    top: 0px;

    /* Take full size */
    height: 100%;
    width: 100%;
}

.watermark__body {
    /* Text color */
    color: rgba(0, 0, 0, 0.2);

    /* Text styles */
    font-size: 4rem;
    font-weight: bold;
    text-transform: uppercase;

    /* Rotate the text */
    transform: rotate(-45deg);

    /* Disable the selection */
    user-select: none;
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
$description=$row1x['partexamined'];
$filmno=$row1x['filmno'];
$remarks=$row1x['remarks'];
$partexamined=$row1x['partexamined'];
$daterr=$row1x['date'];
$validate=$row1x['validate'];
$height=$row1x['height'];
$weight=$row1x['weight'];
$bsa=$row1x['BSA'];
$hr=$row1x['HR'];

for($i=1; $i <= 111;$i++){$table="lab".$i; $lab[$i]=$row1x["$table"];}
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
if($_GET['view']!="verified"){echo"<div class='watermark__inner'><div class='watermark__body'>Internal use only<br>Please do not print</div></div>";}
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
<tr><td colspan='4' style='font-weight:bold' align='center'>$title</td></tr>

<tr>
<td style='font-size:11px;'>LABORATORY NO:</td>
<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$filmno</td>
<td style='font-size:11px;'>&nbsp;&nbsp;&nbsp;DATE:</td>
<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$daterr</td>
</tr>
				<tr>
					<td style='font-size:11px;'>CASENO:</td>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$caseno</td>
					<td style='font-size:11px;'>&nbsp;&nbsp;&nbsp;ROOM:</td>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$room</td>
				</tr>
				<tr>
					<td style='font-size:11px;'>NAME:</td>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$name</td>
					<td style='font-size:11px;'>&nbsp;&nbsp;&nbsp;AGE/SEX:</td>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$age/$sex</td>
				</tr>

				<tr>
					<td style='font-size:11px;'>REFERED BY:</td>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'>$ap</td>
					<td style='font-size:11px;'>&nbsp;&nbsp;&nbsp;EXAMINATION:</td>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'>$partexamined</td>
				</tr>

				<tr>
					<th style='font-size:11px;'><p align='left'>ADDRESS:</p></th>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px' colspan='3'>$address22</td>
				</tr>
				<tr>
					<th style='font-size:11px;'><p align='left'>COMPLAINT: </p></th>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px' colspan='3'>N/A</td>
				</tr>
			</table>

<table width='100%'>
			<tr>
				<td style='font-size:11px; width: 10%;'><p align='left'>HEIGHT: </p></td>
				<th style=' width: 15%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'><p align='left'>$height cm/ft</p></th>
				<td style='font-size:11px; width: 10%;'><p align='left'>WEIGHT: </p></td>
				<th style=' width: 15%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'><p align='left'>$weight kg</p></th>
				<td style='font-size:11px; width: 5%;'><p align='left'>BSA: </p></td>
				<th style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px''><p align='left'>$bsa</p></th>
                <td style='font-size:11px; width: 5%;'><p align='left'>HR: </p></td>
				<th style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px''><p align='left'>$hr</p></th>
				</tr>
				</table>
		</td>
	</tr>

	<tr>
		<td>
";
?>
			<br><br><table width="100%" style='border-collapse: collapse;'>
				<tr>
					<td align="center">
						<b> 2D AND M-MODE MEASUREMENTS </b>
					</td>
				</tr>

			</table>
		</td>
	</tr>
	<tr>
		<td valign="TOP">
			<table align="center" border="0" width="100%" style='border-collapse: collapse;'>
				<tr>
      				<td width="50%">
              			<table align="center" border="1" width="100%" style='border-collapse: collapse;'>
                            <tr>
	                            <td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >PARAMETER</td>
	                            <td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >MEASUREMENT</td>
	                            <!--td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >FINDINGS</td-->
	                            <td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >NORMAL VALUES</td>
	                            <!--td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >CU NORMAL VALUES</td-->

                            </tr>
                            <?php
                            $counter=1;
                            $a=0;
                            $sql2 = "SELECT * FROM 2decho_ver2 where 2decho_ver2.group='1'";
                            $result2 = $conn->query($sql2);
                            while($row2 = $result2->fetch_assoc()) {
	                            $demension=$row2['demension'];
	                            $id=$row2['id'];
	                            $ns=$row2['normalstart'];
	                            $ne=$row2['normalend'];
	                            $nv=$row2['normalvalues'];


	                            ?>
	                            <tr>
		                            <td style="font-size:11px;font-weight: normal;" align="center" ><?php echo $demension ?></td>
		                            <td style="font-weight: bold;font-size:11px" align="center"><?php echo $lab[$counter]; ?></td>
		                            <td style="font-size:9px;font-weight: normal;" align="center"><?php echo $nv ?></td>
		                            <!--td style="font-size:12px;font-weight: normal;" align="center"></td-->
	                            </tr>
					              <?php

					              $counter++;
					              $a++;

				              }
				              ?>

              			</table>
          			</td>
          			<td valign="TOP">
             			 <table align="" border="1" width="100%" style='border-collapse: collapse;'>
                            <tr>
	                            <td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >PARAMETER</td>
	                            <td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >MEASUREMENT</td>
	                            <!--td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >FINDINGS</td-->
	                            <td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >NORMAL VALUES</td>
	                            <!--td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >CU NORMAL VALUES</td-->

                            </tr>
	                            <?php

	                            $a=0;
	                            $sql2 = "SELECT * FROM 2decho_ver2 where 2decho_ver2.group='2'";
	                            $result2 = $conn->query($sql2);
	                            while($row2 = $result2->fetch_assoc()) {
	                            $demension=$row2['demension'];
	                            $id=$row2['id'];
	                            $ns=$row2['normalstart'];
	                            $ne=$row2['normalend'];
	                            $nv=$row2['normalvalues'];


	                            ?>
                            <tr>
	                            <td style="font-size:11px;font-weight: normal;" align="center" ><?php echo $demension ?></td>
	                            <td style="font-weight: bold;font-size:11px" align="center"><?php echo $lab[$counter]; ?></td>
	                            <td style="font-size:9px;font-weight: normal;" align="center"><?php echo $nv ?></td>
	                            <!--td style="font-size:12px;font-weight: normal;" align="center"></td-->
                            </tr>
					              <?php

					              $counter++;

					              $a++;
					              }
					              ?>

              			</table>
          			</td>
      			</tr>

  			</table>
  		</td>
  	</tr>
  	<tr>
  		<td>
			<br><br><br><table width="100%" style='border-collapse: collapse;' border="0">
				<tr>
					<td align="center">
						<b> DOPPLER STUDY </b>
					</td>

				</tr>

			</table>
		</td>
	</tr>
	<tr>
		<td>

<table width="100%" align="center">
<tr><td width="65%">

<!-------------------------------------------- GROUP 3 -------------------------------------->
<table width="100%" border="1" style='border-collapse: collapse;'>
<tr>
<td style="font-size:9px;font-weight: bold;" align="center" ></font></td>
<td style="font-size:9px;font-weight: bold;" align="center" >VELOCITY<br>(M/SEC)(E/A)</font></td>
<td style="font-size:9px;font-weight: bold;" align="center" >PEAK GRADIENT</font></td>
<td style="font-size:9px;font-weight: bold;" align="center">VALVE AREA</font></td>
<td style="font-size:9px;font-weight: bold;" align="center">VTI (cm)</font></td>
</tr>

<?php
$velocity=61; $peak=67; $valve=73; $vti=79;
$sql2 = $conn->query("SELECT * FROM 2decho_ver2 where 2decho_ver2.group='3'");
while($row2 = $sql2->fetch_assoc()) {
$demension=$row2['demension'];
$id=$row2['id'];
$ns=$row2['normalstart'];
$ne=$row2['normalend'];

echo"
<tr>
<td style='font-size:10px;font-weight: normal;font-size:11px' align='center'>$demension</td>
<td style='font-weight: bold;font-size:11px' align='center'>$lab[$velocity]</td>
<td style='font-weight: bold;font-size:11px' align='center'>$lab[$peak]</td>
<td style='font-weight: bold;font-size:11px' align='center'>$lab[$valve]</td>
<td style='font-weight: bold;font-size:11px' align='center'>$lab[$vti]</td>
</tr>
";
$velocity++; $peak++; $valve++; $vti++;
}
?>
</tr>
</table><br>
<!---------------------------------------- END GROUP 3 -------------------------------------->


<!-------------------------------------------- GROUP 4 -------------------------------------->
<table width="100%" border="1" style='border-collapse: collapse;'>
<tr>
<td width='25%' style="font-size:9px;font-weight: bold;" align="center" ></font></td>
<td width='20%' style="font-size:9px;font-weight: bold;" align="center" >VC</font></td>
<td width='20%' style="font-size:9px;font-weight: bold;" align="center" >%</font></td>
<td width='20%' style="font-size:9px;font-weight: bold;" align="center">JET AREA</font></td>
<td width='20%' style="font-size:9px;font-weight: bold;" align="center">VOLUME</font></td>
<td width='20%' style="font-size:9px;font-weight: bold;" align="center">GRADIENT</font></td>
</tr>

<?php
$vc=85; $perc=89; $jet=93; $volume=97; $grad=101;
$sql2 = $conn->query("SELECT * FROM 2decho_ver2 where 2decho_ver2.group='4'");
while($row2 = $sql2->fetch_assoc()) {
$demension=$row2['demension'];
$id=$row2['id'];
$ns=$row2['normalstart'];
$ne=$row2['normalend'];

echo"
<tr>
<td style='font-size:10px;font-weight: normal;font-size:11px' align='center'>$demension</td>
<td style='font-weight: bold;font-size:11px' align='center'>$lab[$vc]</td>
<td style='font-weight: bold;font-size:11px' align='center'>$lab[$perc]</td>
<td style='font-weight: bold;font-size:11px' align='center'>$lab[$jet]</td>
<td style='font-weight: bold;font-size:11px' align='center'>$lab[$volume]</td>
<td style='font-weight: bold;font-size:11px' align='center'>$lab[$grad]</td>
</tr>
";
$vc++; $perc++; $jet++; $volume++; $grad++;
}
?>
</tr>
</table>
<!---------------------------------------- END GROUP 4 -------------------------------------->


</td><td width="1%"></td><td valign="TOP">

<!-------------------------------------------- GROUP 5 -------------------------------------->
<table width="100%" border="1" style='border-collapse: collapse;'>


<?php
$g5=105;
$sql2 = $conn->query("SELECT * FROM 2decho_ver2 where 2decho_ver2.group='5'");
while($row2 = $sql2->fetch_assoc()) {
$demension=$row2['demension'];
$id=$row2['id'];
$ns=$row2['normalstart'];
$ne=$row2['normalend'];

echo"
<tr>
<td width='60%' style='font-size:10px; font-weight: normal;font-size:11px; padding: 9px;' align='center'>$demension</td>
<td style='font-weight: bold;font-size:11px' align='center'>$lab[$g5]</td>
</tr>
";
$g5++;
}
?>
</tr>
</table>
<!---------------------------------------- END GROUP 5 -------------------------------------->

</td>
</tr>
</table>


</td>
</tr>
</table>
</div>


<?php
echo"<br><br>
<div width='730' align='center' class='A4'><br>
<table align='center'  style='border-collapse: collapse;' border='0'>
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
<tr><td colspan='4' style='font-weight:bold' align='center'>$title</td></tr>

<tr>
<td style='font-size:11px;'>LABORATORY NO:</td>
<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$filmno</td>
<td style='font-size:11px;'>&nbsp;&nbsp;&nbsp;DATE:</td>
<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$daterr</td>
</tr>
				<tr>
					<td style='font-size:11px;'>CASENO:</td>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$caseno</td>
					<td style='font-size:11px;'>&nbsp;&nbsp;&nbsp;ROOM:</td>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$room</td>
				</tr>
				<tr>
					<td style='font-size:11px;'>NAME:</td>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$name</td>
					<td style='font-size:11px;'>&nbsp;&nbsp;&nbsp;AGE/SEX:</td>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$age/$sex</td>
				</tr>

				<tr>
					<td style='font-size:11px;'>REFERED BY:</td>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'>$ap</td>
					<td style='font-size:11px;'>&nbsp;&nbsp;&nbsp;EXAMINATION:</td>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'>$partexamined</td>
				</tr>

				<tr>
					<th style='font-size:11px;'><p align='left'>ADDRESS:</p></th>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px' colspan='3'>$address22</td>
				</tr>
				<tr>
					<th style='font-size:11px;'><p align='left'>COMPLAINT: </p></th>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px' colspan='3'>N/A</td>
				</tr>

			</table>
			<table width='100%'>
			<tr>
				<td style='font-size:11px; width: 10%;'><p align='left'>HEIGHT: </p></td>
				<th style=' width: 15%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'><p align='left'>$height cm/ft</p></th>
				<td style='font-size:11px; width: 10%;'><p align='left'>WEIGHT: </p></td>
				<th style=' width: 15%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'><p align='left'>$weight kg</p></th>
				<td style='font-size:11px; width: 5%;'><p align='left'>BSA: </p></td>
				<th style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px''><p align='left'>$bsa</p></th>
                <td style='font-size:11px; width: 5%;'><p align='left'>HR: </p></td>
				<th style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px''><p align='left'>$hr</p></th>
				</tr>
				</table>
		</td>
	</tr>

<tr>
<td>





<table border='0' width='100%'>
<tr>
<td align='center'>
<b> IMPRESSION </b>
</td>
</tr>
<tr>
<td width='100'>
<textarea id='result' name='result' rows='25' cols='100' style='font-size: 12px; font-weight:bold; border: none; overflow:hidden;' readonly>$interpretation</textarea>
</td>
</tr>
</table>




<table border='0' width='100%'>
<tr>
<td width='50%' style='font-size:12px;font-weight: normal; vertical-align:bottom;text-align:center; background-image:url(http://$ip/arv2022/heart/signature/$tech_sig); background-repeat:no-repeat;background-size:180px 80px; background-position: center;'>
<p style='font-size:12px;font-weight: normal;' align='center'><br><br>
<b>$remarks</b><br>TECHNICIAN<br>
</p>
</td>

<td style='font-size:12px;font-weight: normal; vertical-align:bottom;text-align:center; background-image:url(http://$ip/arv2022/heart/signature/$cardio_sig); background-repeat:no-repeat;background-size:180px 80px; background-position: center;'>
<br><br><br><br><b>$validate</b><br>
$label
</td>
</tr>
</table>



</td>
</tr>
<tr>
</table>



</td>
</tr>
</table>
</div>
";

?>
<tr>
<td>








</body>
</html>
