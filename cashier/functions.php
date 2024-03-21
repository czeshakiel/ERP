<?php
include "../main/class.php";
$view = $_GET['str'];

if($view=="chargeto"){
echo"<select name='accttitle' class='desn'>";
$sqlAcct = $conn->query("SELECT accttitle FROM accttitle");
while($acct = $sqlAcct->fetch_assoc()){echo "<option value='$acct[accttitle]'>$acct[accttitle]</option>";}
echo"</select>";
}


if($view=="paymentname"){
echo"<datalist id='brow'>";
$sqlPatient = $conn->query("SELECT * FROM patientprofile");
while($patient=$sqlPatient->fetch_assoc()){echo "<option value='$patient[patientidno]_$patient[patientname]'>"; }

$sqlPatient2 = $conn->query("SELECT * FROM docfile GROUP BY code");
while($patient2=$sqlPatient2->fetch_assoc()){echo "<option value='$patient2[code]_$patient2[name]'>";}

$sqlPatient3 = $conn->query("SELECT * FROM company GROUP BY acctno");
while($patient3=$sqlPatient3->fetch_assoc()){echo "<option value='$patient3[acctno]_$patient3[companyname]'>";}

$sqlPatient4 = $conn->query("SELECT * FROM nsauthemployees");
while($patient4=$sqlPatient4->fetch_assoc()){echo "<option value='$patient4[empid]_$patient4[name]'>";}
echo"</datalist>";
}
?>