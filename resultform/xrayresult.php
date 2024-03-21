
<?php
include '../main/class.php';
$version = explode(".", phpversion());

if($version[0]=="5"){
//5.4 and above
require_once '../resultform/dompdf5.4/autoload.inc.php';
}else{
//7.1 and above
require_once '../resultform/dompdf7.1/autoload.inc.php';
}

$dompdf = new Dompdf\Dompdf();

ob_start();
$caseno=$_GET['caseno'];
$refno=$_GET['refno'];

$sql222 = $conn->query("SELECT * FROM productout where caseno='$caseno' and refno='$refno'");
while($row222 = $sql222->fetch_assoc()) { 
$approvalno=$row222['approvalno'];
$referenceno=$row222['referenceno'];
list($user, $filmno) = explode('_', $approvalno);
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
if(mysqli_num_rows($sql3)==0){
$sql3 = $conn->query("SELECT concat(lastname,' ',firstname,' ',middlename) as patientname, birthdate, age, age as senior, gender as sex from nsauthemployees where empid='$patientidno'");}
while($row3 = $sql3->fetch_assoc()){ 
$age=$row3['age'];
$sex=$row3['sex'];
$name=$row3['patientname'];
if($sex=='M') {$sex='MALE';} elseif($sex=='F') {$sex='FEMALE';}
}

$result33 = $conn->query("SELECT * FROM xray1 where caseno='$caseno' and refno='$refno'");
while($row33 = $result33->fetch_assoc()) {
$validate=$row33['validate'];
$referredby=$row33['referredby'];
$interpretation=$row33['interpretation'];
$interpretation = addslashes($interpretation);
$impression=$row33['impression'];
$radiologist=$row33['radiologist'];
$partexamined=$row33['partexamined'];
$daterr=$row33['date'];
$filmno2=$row33['filmno'];
}
if($filmno==""){$filmno = $filmno2;}

if($radiologist == "ELMA PACIFICO CONAHAP MD, DPBR, FCT-MRISP"){$sig ="1";}
if($radiologist == "APOLONIO S. BERNARDO MD, FPCR, FUSP, Fellow-CTMRI"){$sig ="2";}
if($radiologist == "ELMA P. PACIFICO-CONAHAP MD, DPBR, FCT-MRISP"){$sig ="3";}
if($radiologist == "PHILLEN D URETA, MD, FPOGS"){$sig ="4";}

// Define the HTML content
$html = '
<style>
.watermark__inner {
    /* Center the content */
    align-items: center;
    display: flex;
    justify-content: center;

    /* Absolute position */
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;


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

.watermark-container {
    position: relative;
}


.watermark-container::after {
content: "";
background-image: url("../resultform/watermark.png");
background-repeat: no-repeat;
background-position: center center;
background-size: 200px 100px;
opacity: 0.2;
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
z-index: -1;
}

</style>
';

if(!isset($_GET['viewonly'])){
$html .='
<table width="100%"><tr>
<td width="10%"><img src="../resultform/kmsci.png" width="50" height="50"></td>
<td>
<table align="center">
<tr><td style="text-align: center; font-size: 13px;"><b>'.$heading.'</b></td></tr>
<tr><td style="font-size: 11px; text-align: center;">'.$address.'</td></tr>
<tr><td style="font-size: 11px; text-align: center;">'.$telno.'</td></tr>
</table>
</td>
<td width="10%">&nbsp;</td>
</tr></table>
<br>
';
}else{
    $html .= '<h2 align="center"><font color="red">NOT PRINTABLE! FOR PREVIEW PURPOSE ONLY...</font></h2>';
    $html .=' <div class="watermark-container">';    
}

$html .='
<table width="100%" style="border-collapse: collapse;" border="0">
<tr><td colspan="4" style="font-weight:bold" align="center"></td></tr>

<tr>
<td style="font-size:11px;">FILM NO:</td>
<td style="font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;">'.$filmno.'</td>
<td style="font-size:11px;">&nbsp;&nbsp;&nbsp;DATE:</td>
<td style="font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;">'.$daterr.'</td>
</tr>

<tr>
<td style="font-size:11px;">CASENO:</td>
<td style="font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;">'.$caseno.'</td>
<td style="font-size:11px;">&nbsp;&nbsp;&nbsp;ROOM:</td>
<td style="font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;">'.$room.'</td>
</tr>

<tr>
<td style="font-size:11px;">NAME:</td>
<td style="font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;">'.$name.'</td>
<td style="font-size:11px;">&nbsp;&nbsp;&nbsp;AGE/SEX:</td>
<td style="font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;">'.$age.'/'.$sex.'</td>
</tr>

<tr>
<td style="font-size:11px;">REFERED BY:</td>
<td style="font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px">'.$ap.'</td>
<td style="font-size:11px;">&nbsp;&nbsp;&nbsp;EXAMINATION:</td>
<td style="font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px">'.$partexamined.'</td>
</tr>

<tr>
<th style="font-size:11px; text-align: left;">ADDRESS:</th>
<td style="font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px" colspan="3">'.$address22.'</td>
</tr>

<tr>
<th style="font-size:11px; text-align: left;">COMPLAINT:</th>
<td style="font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid; font-size:11px;" colspan="3">N/A</td>
</tr>
</table>

			
<table width="100%">
<tr>
<td style="font-size:11px; width: 10%; text-align: left;">HEIGHT:</td>
<td style=" width: 15%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px">'.$height.' cm/ft</td>
<td style="font-size:11px; width: 10%;">WEIGHT:</td>
<td style=" width: 15%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px">'.$weight.' kg</td>
<td style="font-size:11px; width: 5%;">BSA:</td>
<td style="font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px"">'.$bsa.'</td>
</tr>
</table>

<br><table width="100%" style="border-collapse: collapse;">
<tr>
<td align="center"><b> RADIOGRAPHY RESULT</b></td>
</tr>
</table><br>


<table width="100%"><tr>
<td height="420" valign="TOP" style="font-size: 12px; font-family: Arial, Helvetica, sans-serif; border: none; text-align: justify;" readonly>
'.$interpretation.'<br><br>IMPRESSION:<br>'.$impression.'
</td></tr></table>

';

if(!isset($_GET['viewonly'])){ 
$html .='
<table width="100%">
<tr><th style="border-bottom: solid 1px black;"></th></tr>

<tr>
<td style="text-align: center; background-image:url(signature/'.$sig.'.png);background-repeat:no-repeat; background-size:450px 130px; background-position: center;">
<br>
<b><font size="12px">'.$radiologist.'</font></b><br>
<font size="10px">
Radiologist<br>
Lic. No.  <br>
Electronically Signed </font>
</td>
</tr>
<tr>
<th style="border-bottom: solid 1px black;"></th>
</tr>
<tr>
<td style="font-size: 10px;"><b>DISCLAIMER:</b> These findings ar based on radiological imaging studies. It must be correlated with clinical, laboratory, and other ancillary procedures for a comprehensive assesment of patients condition. Thus, radiology reports are best explained  by the attending  physician to the patient.</td>
</tr>
<tr>
<td style="font-size: 10px;"><b>RAD TECH:<u>'.strtoupper($validate).'</u></b></td>
</tr>
</table>
';
}


// Load the HTML into the renderer
$dompdf->loadHtml($html);


// Set the paper size and orientation
//$dompdf->setPaper('A4', 'portrait');
$dompdf->setPaper('Letter', 'portrait');

// Render the PDF
$dompdf->render();


// Output the generated PDF to the browser
$dompdf->stream('imaging-result.pdf', array('Attachment' => false));
?>
