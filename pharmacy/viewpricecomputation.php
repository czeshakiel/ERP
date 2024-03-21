<?php
include "../main/class.php";
$id = $_GET['id'];

$sql = $conn->query("select * from poswalkin2 where id='$id'");
while($res = $sql->fetch_assoc()){
$desc = $res['desc'];
$unitcost = $res['unitcost'];
$lotno = $res['lotno'];
$dis = $res['dis'];
$code = $res['code'];
}

//$sql2 = $conn->query("select * ")

if($lotno=="M"){$lot="MARK-UP";}else{$lot="SPECIAL";}

echo"<h3>Code: $code <br> Desc: $desc <br> <font color='green'>Type: <u>$lot</u></font> || <font color='blue'>Senior/PWD: <u>$dis</u></font></h3><hr>";

if($lotno=="M"){
$markup = $unitcost * 1.30;
$markup = sp($markup);
echo"<h5>Unitcost ($unitcost) + ( Unitcost ($unitcost) * Markup (0.30) ) = Markup ($markup)  <b style='color: red;'>(original Markup)</b></h5>";

$markup2 = $markup; $markup3 = $markup;
$mk = $conn->query("select * from markupaddon where status='1' and trantype='cash' order by sort");
while($mk1 = $mk->fetch_assoc()){
$addon = $mk1['addon'];
$iomno = $mk1['iomno'];
$markup2 = $markup2+($markup2*$addon);
$markup2 = sp($markup2);
echo"<h5>Markup ($markup3) + ( Markup ($markup3) * new Markup ($addon) ) = Another Markup ($markup2) <b style='color: red;'>(IOM No.: $iomno)</b></h5>";
$markup3 = $markup2;
}

$wvat = $markup3 * 1.12;
$wvat = sp($wvat);
echo"<h5>SRP ($markup3) * Vat (12%) = SRPwvat ($wvat)</h5>";

if($dis=="Y"){
echo"<br><br><font size='2'>-------------- SET AS SENIOR/PWD -------------------</font>";
$wvat2 = $wvat / 1.12;
echo"<h5>SRPwvat ($wvat) / lessvat (1.12) = SRPlessvat ($wvat2)</h5>";

$less = $wvat2 - ($wvat2*0.20);
echo"<h5>SRPlessvat ($wvat2) - ( SRPlessvat ($wvat2) * MAX Discount (0.20) ) = NET ($less)</h5>";
}else{
$less = $wvat - ($wvat*0.26);
echo"<h5>SRPwvat ($wvat) - ( SRPwvat ($wvat) * MAX Discount (0.26) ) = NET ($less)</h5>";    
}

$mydisc = round($wvat - $less,2);
$less = round($less, 2);
echo"<h4 style='color: red;'>DISC:$mydisc <br> NET: $less</h4>";
}
?>