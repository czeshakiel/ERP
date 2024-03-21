<style>
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
$view=$_GET['view'];

include '../main/class.php';
$sql2 = "SELECT * FROM ipaddress";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) { 
$ip=$row2['ipaddress'];
}

$ck = $conn->query("select * from 2dechoresult where refno='$refno' and caseno='$caseno'");
if(mysqli_num_rows($ck)==0){echo"<script>window.location='http://$ip/ERP/printresult/2decho_v2/$caseno/$refno/$view';</script>"; exit();}

$sql22 = "SELECT * FROM heading";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) { 
$hh=$row22['heading'];
$tt=$row22['telno'];
}

$sql222 = "SELECT * FROM productout where caseno='$caseno' and refno='$refno'";
$result222 = $conn->query($sql222);
while($row222 = $result222->fetch_assoc()) { 
$approvalno=$row222['approvalno'];
$referenceno=$row222['referenceno'];
}
list($user, $filmno) = explode('-', $approvalno);

$sql2222 = "SELECT * FROM admission where caseno='$caseno'";
$result2222 = $conn->query($sql2222);
while($row2222 = $result2222->fetch_assoc()) { 
$room=$row2222['room'];
$patientidno=$row2222['patientidno'];
$ap=$row2222['ap'];

$street=$row2222['street'];
$barangay=$row2222['barangay'];
$municipality=$row2222['municipality'];
$province=$row2222['province'];
$address=$street." ".$barangay." ".$municipality.", ".$province;
}



$sql3 = "SELECT * FROM patientprofile where patientidno='$patientidno'";
$result3 = $conn->query($sql3);



 if($result3->num_rows == 0)
   {

    $sql3 = "SELECT concat(lastname,' ',firstname,' ',middlename) as patientname,birthdate,age, age as senior,gender as sex from nsauthemployees where empid='$patientidno'";
   $result3 = $conn->query($sql3);

   }


while($row3 = $result3->fetch_assoc()) { 
$age=$row3['age'];
$sex=$row3['sex'];
$name=$row3['patientname'];
}






if($sex=='M') {$sex='MALE';} elseif($sex=='F') {$sex='FEMALE';}


$sql33 = "SELECT * FROM 2dechoresult where caseno='$caseno' and refno='$refno'";
$result33 = $conn->query($sql33);
while($row33 = $result33->fetch_assoc()) { 

$interpretation=$row33['interpretation'];
$radiologist=$row33['radiologist'];
$partexamined=$row33['partexamined'];
$daterr=$row33['date'];
$validate=$row33['validate'];
}

if($radiologist == "ELMA PACIFICO CONAHAP MD, DPBR, FCT-MRISP")
{
$sig ="1";	
}
if($radiologist == "APOLONIO S. BERNARDO MD, FPCR, FUSP, Fellow-CTMRI")
{
$sig ="2";	
}

if (strpos($partexamined, 'PEDIA') !== false)
{
	$title="PEDIA 2D ECHO REPORT";
	$label="PEDIA CARDIOLOGIST";

}
elseif (strpos($partexamined, 'ADULT') !== false)
{
	$title= "ADULT 2D ECHO REPORT";
	$label="ADULT CARDIOLOGIST";
}
else 
{
  $title= "2D ECHO REPORT";
  $label="CARDIOLOGIST";
}

$sql1x = "select * from 2dechoresult where caseno='$caseno' and refno='$refno'";
$result1x = $conn->query($sql1x);
while($row1x = $result1x->fetch_assoc()) 

{ 
$radiologist=$row1x['reader'];
$prodsubtype=$row1x['clinicalservices'];
$interpretation=$row1x['interpretation'];
$description=$row1x['partexamined'];
$filmno=$row1x['filmno'];
$remarks=$row1x['remarks'];
           
              for($i=1; $i <= 63;$i++)
              {
                $table="lab".$i;

                $lab[$i]=$row1x["$table"];

                ?>
            <script type="text/javascript"> 
            //alert("<?php echo $lab[$i]; ?>");
          // alert("<?php echo $table; ?>");

            </script>


                <?php


              }

}
if($_GET['view']!="verified"){echo"<div class='watermark__inner'><div class='watermark__body'>Internal use only<br>Please do not print</div></div>";}
echo "
<html>
<style type='text/css'>
    textarea { border: none; }
</style>
<style>
pre {
 white-space: pre-wrap;       /* css-3 */
 white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
 white-space: -pre-wrap;      /* Opera 4-6 */
 white-space: -o-pre-wrap;    /* Opera 7 */
 word-wrap: break-word;       /* Internet Explorer 5.5+ */
}




@media print {
    * {
        -webkit-print-color-adjust: exact;
    }
}

th{
    font-weight: normal;
}


</style>
<body>

<div width='730' align='center'>
<table align='center'  style='border-collapse: collapse;' border='0'>
	<tr>
		<td >
			<p align='center'><b>$hh<br>
			$tt</b></p>
		</td>
	</tr>

	<tr>
		<td>
			<table width='100%' style='border-collapse: collapse;' border='0'>
				<tr>
  					<td colspan='4' style='font-weight:bold' align='center'>$title</td>
				</tr>
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
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px' colspan='3'>$address</td>
				</tr>
				<tr>
					<th style='font-size:11px;'><p align='left'>COMPLAINT: </p></th>
					<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px' colspan='3'>N/A</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td>
";
?>
			<table width="100%" style='border-collapse: collapse;'>
				<tr>
					<td align="center">
						<b> ECHOCARDIOGRAPHIC DATA </b>
					</td>
				</tr>

			</table>
		</td>
	</tr>
	<tr>
		<td valign="TOP">
			<table align="center" border="0" width="100%" style='border-collapse: collapse;'>
				<tr>
      				<td>
              			<table align="center" border="1" width="100%" style='border-collapse: collapse;'>
                            <tr>
	                            <td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >DIMENSION</td>
	                            <td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >MEASUREMENT</td>
	                            <!--td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >FINDINGS</td-->
	                            <td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >NORMAL VALUES</td>
	                            <!--td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >CU NORMAL VALUES</td-->

                            </tr>
                            <?php
                            $counter=1;
                            $a=0;
                            $sql2 = "SELECT * FROM 2decho where 2decho.group!='4'";
                            $result2 = $conn->query($sql2);
                            while($row2 = $result2->fetch_assoc()) { 
	                            $demension=$row2['demension'];
	                            $id=$row2['id'];
	                            $ns=$row2['normalstart'];
	                            $ne=$row2['normalend'];


	                            ?>
	                            <tr>
		                            <td style="font-size:11px;font-weight: normal;" align="center" ><?php echo $demension ?></td>
		                            <td style="font-weight: bold;font-size:11px" align="center"><?php echo $lab[$counter]; ?></td>
		                            <!--td style="font-size:12px;font-weight: bold;" align="center"><?php 


	                                if( $ns == "")
	                                {
	                                  echo  "-";

	                                }
	                                elseif($lab[$counter] == "") {
	                                  echo "-";
	                                }
	                                 elseif($lab[$counter] < $ns) {
	                                  echo "LOW";
	                                }
	                                
	                                elseif($lab[$counter] > $ne)
	                                  {

	                                  echo "HIGH";  
	                                  }

	                                else
	                                  {
	                                    echo  "NORMAL";
	                                  }
	                             	?>
	                             	</td-->
		                            <td style="font-size:11px;font-weight: normal;" align="center"><?php echo $ns.'-'.$ne ?></td>
		                            <!--td style="font-size:12px;font-weight: normal;" align="center"></td-->
	                            </tr>
					              <?php
					              if($counter == 16)
					              {
					                break;
					              }
					              $counter++;
					              $a++;

				              }
				              ?>

              			</table>
          			</td>
          			<td valign="TOP">
             			 <table align="" border="1" width="100%" style='border-collapse: collapse;'>
                            <tr>
	                            <td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >DIMENSION</td>
	                            <td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >RESULT</td>
	                            <!--td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >FINDINGS</td-->
	                            <td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >NORMAL VALUES</td>
	                            <!--td bgcolor="" style="font-size:12px;font-weight: bold;" align="center" >CU NORMAL VALUES</td-->

                            </tr>
	                            <?php
	                            $counter=17;
	                            $a=0;
	                            $sql2 = "SELECT * FROM 2decho where 2decho.group!='4' and id > 16";
	                            $result2 = $conn->query($sql2);
	                            while($row2 = $result2->fetch_assoc()) { 
	                            $demension=$row2['demension'];
	                            $id=$row2['id'];
	                            $ns=$row2['normalstart'];
	                            $ne=$row2['normalend'];


	                            ?>
                            <tr>
	                            <td style="font-size:11px;font-weight: normal;" align="center" ><?php echo $demension ?></td>
	                            <td style="font-weight: bold;font-size:11px" align="center"><?php echo $lab[$counter]; ?></td>
	                            <!--td style="font-size:12px;font-weight: bold;" align="center"><?php 


                                if( $ns == "")
                                {
                                  echo  "-";

                                }
                                elseif($lab[$counter] == "") {
                                  echo "-";
                                }
                                 elseif($lab[$counter] < $ns) {
                                  echo "LOW";
                                }
                                
                                elseif($lab[$counter] > $ne)
                                  {

                                  echo "HIGH";  
                                  }

                                else
                                  {
                                    echo  "NORMAL";
                                  }


	                             ?></td-->
	                            <td style="font-size:11px;font-weight: normal;" align="center"><?php echo $ns.'-'.$ne ?></td>
	                            <!--td style="font-size:12px;font-weight: normal;" align="center"></td-->
                            </tr>
					              <?php
					               if($counter == 28)
					              {
					                break;
					              }
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
			<table width="100%" style='border-collapse: collapse;' border="0">
				<tr>
					<td align="center">
						<b> DOPPLER SPECTRAL DATA </b>
					</td>

				</tr>

			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="1" style='border-collapse: collapse;'>
				<tr>
			      	<td style="font-size:12px;font-weight: bold;" align="center" >VALVE</font></td>
			      	<td style="font-size:12px;font-weight: bold;" align="center" >MAX VELOCITY<br>(M/SEC)</font></td>
			     	<td style="font-size:12px;font-weight: bold;" align="center" >PEAK GRADIENT<br>(MMHG)</font></td>
			      	<td style="font-size:12px;font-weight: bold;" align="center">ORIFIRE<BR>AREA(CM2)</font></td>
			      	<td style="font-size:12px;font-weight: bold;" align="center">VTI</font></td>
			      	<td style="font-size:12px;font-weight: bold;" align="center">RATIO</font></td>
			      	<td style="font-size:12px;font-weight: bold;" align="center">JET AREA</font></td>
			      	<td style="font-size:12px;font-weight: bold;" align="center">GRADIENT</font></td>

				</tr>
					<?php
					$sql2 = "SELECT * FROM 2decho where 2decho.group='4'";
					$result2 = $conn->query($sql2);
					$max=29;
					$peak=34;
					$ori=39;
					$vti=44;
					$ratio=49;
					$jet=54;
					$grad=59;
					while($row2 = $result2->fetch_assoc()) { 
					$demension=$row2['demension'];
					$id=$row2['id'];
					$ns=$row2['normalstart'];
					$ne=$row2['normalend'];

					if($demension=="PAPressure")
					{
					  $val2 = "PAT=";
					}
					 
					?>
	         	<tr>
		          <td style="font-size:10px;font-weight: normal;font-size:11px" align="center"><?php echo $demension; ?></td>
		          <td style="font-weight: bold;font-size:11px" align="center"><?php echo $lab[$max]; ?></td>
		          <td style="font-weight: bold;font-size:11px" align="center"><?php echo $lab[$peak]; ?></td>
		          <td style="font-weight: bold;font-size:11px" align="center"><?php echo $lab[$ori]; ?></td>
		          <td style="font-weight: bold;font-size:11px" align="center"><?php echo $lab[$vti]; ?></td>
		          <td style="font-weight: bold;font-size:11px" align="center"><?php echo $lab[$ratio]; ?></td>
		          <td style="font-weight: bold;font-size:11px" align="center"><font color="black"><?php echo $lab[$jet]; ?></td>
		          <td style="font-weight: bold;font-size:11px" align="center"><font color="black"><?php echo $lab[$grad]; ?></td>
          		</tr>

					<?php
					$max++;
					$peak++;
					$ori++;
					$vti++;
					$ratio++;
					$jet++;
					$grad++;
					}
					?>

				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" width="100%">
          		<!--tr>
		          <td align="center">
						<b> IMPRESSION </b>
					</td>
          		</tr-->
          		<tr>
        			<td  width="100" >
				        <textarea id='result' name='result' rows='24' cols='100' style='font-size: 12px;font-weight:bold' readonly><?php echo $interpretation; ?></textarea>
				        <?php 
				       // $interpretation= str_replace("   ", "<br>",$interpretation );
				       //  $interpretation= str_replace("CONCLUSION:", "CONCLUSION: <br>",$interpretation );
				       //  echo $interpretation;
				        ?>
			        </td>
        		</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" width="100%">
				<tr>
					<td >

						<p style="font-size:12px;font-weight: normal;" align="center"><br><br>
						<b><?php echo $remarks ?></b> <br>
						TECHNICIAN<br>

						</p>
					</td>
					<td>
						<table border="0" width="100%">
							<tr>
								<td align="center">
									<?php if(strpos($validate, "MOJICA")!==false){ ?><img src="signature/drmojica.png" width="150px" height="30px" > <?php } ?>
								</td>
							</tr>
							<tr>
								<td style="font-size:12px;font-weight: normal;" align="center">
									<b><?php echo $validate ?></b> <br>
									<?php echo $label ?><br>
									
								</td>
							</tr>

						</table>		
					</td>
				</tr>
				<tr>
					<!--th style='border-bottom: solid 1px black;'></th-->
				</tr>
				<!--tr>
					<td style="font-size:12px;font-weight: normal;" align="center"><b>DISCLAIMER:</b> These findings ar based on radiological imaging studies. It must be correlated with clinical, laboratory, and other  ancillary procedures for a comprehensive assesment of patient's condition. Thus, radiology reports are best explained  by the attending physician to the patient.</td>
				</tr-->
				<tr>
					<!--td style="font-size:12px;font-weight: normal;" ><br><b>READER: <?php echo $radiologist; ?></b></td-->
				</tr>
			</table>
		</td>
	</tr>
</table>
</div>

</body>
</html>
