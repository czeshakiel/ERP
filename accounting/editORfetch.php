<?php
$isearch=$_GET['str'];
include "../main/class.php";
include "../main/header.php";
$chk = 0;
$counting1 = 0;

if($isearch == ""){}
else{
echo"
<form method='POST'>
<table width='100%'><tr>
<td>Date/Time Posted: <b id='dt'></b> / Posted By: <b id='puser'></b></td>
<td style='text-align: right;'>
<table align='right'><tr>
<td><button type='submit' id='idrefund' name='refund' class='btn btn-info btn-sm' style='color: white; width: 100%;'><i class='icofont-undo'></i> Refund</button></td>
<td><a href='?editOR&orno=$isearch&cancelor' onclick='conf();'><button type='button' id='idcancel' class='btn btn-danger btn-sm' style='color: white; width: 100%;'><i class='icofont-ui-close'></i> Cancel</button></td>
<td><a href='http://$ip/2020codes/PrintOR/OR1.php?orno=$isearch' target='_blank'><button type='button' id='idprint1' class='btn btn-success btn-sm' style='color: white; width: 100%;'><i class='icofont-printer'></i> Reprint</button></a></td>
<td><a href='http://$ip/ERP/printslip/ORprint/$isearch' target='_blank'><button type='button' id='idprint2' class='btn btn-success btn-sm' style='color: white; width: 100%;'><i class='icofont-printer'></i> Reprint</button></a></td>
</tr></table>
</td></tr></table>

<table width='100%' align='center'><tr><td>
<table class='tablex'>
<tr>
<th></th>
<th width='30%'><font class='font8x'>Patient Information</th>
<th width='30%'><font class='font8x'>Desc/ Acctitle</th>
<th class='text-center' width='0%'><font class='font8x'>Amount</th>
<th class='text-center'>Action</th>
</tr>
";

$tamount = 0; $ckpen = 0; $ckmed=0; $notmedsup=0;
$sql = "select * from collection where ofr='$isearch'";
$result = $conn->query($sql);
$counting = mysqli_num_rows($result);
while($row = $result->fetch_assoc()) {
$caseno = $row['acctno'];
$acctname = $row['acctname'];
$accttitle = $row['accttitle'];
$desc = $row['description'];
$amount = $row['amount'];
$tamount += $amount;
$disc = $row['discount'];
$paidBy = $row['paidBy'];
$usernamex = $row['username'];
$refno = $row['refno'];
$vdate = date("F d, Y", strtotime($row['datearray']));
$vtime = date("h:i:s a", strtotime($row['paymentTime']));

$desc=str_replace("mak-","",$desc);
$desc=str_replace("-med","",$desc);
$desc=str_replace("-sup","",$desc);
$desc=str_replace("ams-","",$desc);

$time1=strtotime($vdate." ".$vtime);
$time2=strtotime(date('Y-m-d H:i:s'));
$hour=abs($time2-$time1)/(60*60);

if($access=="12"){}
else{if($hour >= 5){echo"<script>document.getElementById('idcancel').style.display='none';</script>";}}

$sstat = "";
$ff = $conn->query("select * from productout where caseno='$caseno' and refno='$refno'");
while($ff1 = $ff->fetch_assoc()){
$adm = $ff1['administration'];
$ter = $ff1['terminalname'];
}

if(strpos($accttitle,"MEDICINE")!==false or strpos($accttitle,"SUPPLIES")!==false){$sstat = $adm; $ckmed++;}
if(strpos($accttitle,"MEDICINE")===false and strpos($accttitle,"SUPPLIES")===false){$sstat = $adm; $notmedsup++;}
else{$sstat = $ter;}

if(strpos($refno, '_xx')!==false){$sstat="CANCELLED";}

$ck_d_a=0;
$gg = $conn->query("select * from productout where caseno='$caseno' and referenceno='$refno'");
if(mysqli_num_rows($gg)>0){$ckpen++; $ck_d_a++;}


$sqlq = "SELECT remarks FROM labtest WHERE refno='$refno'";
$resultq = $conn->query($sqlq);
while($rowq = $resultq->fetch_assoc()) {$rm=$rowq['remarks'];}
if($rm!=""){$desc = "<small>$desc <font color='blue'>[$rm]</font></small>";}


if(strpos($accttitle,"MEDICINE")!==false or strpos($accttitle,"SUPPLIES")!==false){

if($ck_d_a>0){$ckbox="<i class='icofont-warning' style='font-size: 20px; color: red;' title='use (request for refund) for medicine and supplies.'></i>";}
else{$ckbox = "<input type='checkbox' name='ck[]' style='transform : scale(1.7);' value='$refno'>";}

if($ckpen>0){echo"<script>document.getElementById('idcancel').style.display='none';</script>";}

}
elseif($sstat == "Testdone"){
$ckbox="<i class='icofont-warning' style='font-size: 20px; color: red;' title='unable to cancel/refund, Procedure is set as Testdone!'></i>";
echo"<script>document.getElementById('idcancel').style.display='none';</script>";
}
else{$ckbox = "<input type='checkbox' name='ck[]' style='transform : scale(1.7);' value='$refno'>";}

echo"
<script>
document.getElementById('dt').innerHTML='$vdate $vtime';
document.getElementById('puser').innerHTML='$usernamex';
</script>
";



echo"
<tr>
<td style='font-size: 11px; text-align: center;'>$ckbox</td>
<td style='font-size: 12px;'><font color='gray'><i class='icofont-id'></i> Caseno:</font> $caseno $refno<br><font color='gray'><i class='icofont-user-alt-3'></i> NAME:</font> <b>$acctname</b></td>
<td style='font-size: 12px;'><font color='gray'><i class='icofont-clip-board'></i> Accttitle:</font> $accttitle<br><font color='gray'><i class='icofont-law-document'></i> Desc:</font> <b>$desc</b></td>
<td style='font-size: 12px;'><font color='gray'><i class='icofont-peso'></i> Amount:</font> $amount<br><font color='gray'><i class='icofont-sale-discount'></i> Discount:</font> $disc</td>
<td style='font-size: 12px;'><font color='gray'><i class='icofont-ui-calendar'></i> Status:</font> $sstat<br><font color='gray'><i class='icofont-ui-calendar'></i> Posted Dept.:</font> $paidBy</td>
</tr>
";
} 
$tamount2 = number_format($tamount, 2);
echo"
<tr id='idtotal'>
<td colspan='3' style='text-align: right;'><b>TOTAL:&nbsp;</b></td>
<td colspan='2'><b><i class='icofont-peso'></i> $tamount2</b></td>
</tr>
";

if($ckmed>0 and $notmedsup==0){
echo"
<script>
document.getElementById('idprint1').style.display='none';
document.getElementById('idprint2').style.display='';
</script>
";    
}else{
echo"
<script>
document.getElementById('idprint1').style.display='';
document.getElementById('idprint2').style.display='none';
</script>
";  
}

if($counting==0){
echo"<script>document.getElementById('idtotal').style.display='none';</script>";
if($counting1=="0"){
echo "
<tr>
<td colspan='9'><h3><font color='black'>No Data Found........</h3></td>
</tr>

<script>
document.getElementById('idrefund').style.display='none';
document.getElementById('idcancel').style.display='none';
document.getElementById('idprint1').style.display='none';
document.getElementById('idprint2').style.display='none';
</script>
";
}else{
echo "
<tr>
<td colspan='9'><h3><font color='black'></h3></td>
</tr>
";    
}
}
echo"</table></tr></td></table><br></form>";

}
?>