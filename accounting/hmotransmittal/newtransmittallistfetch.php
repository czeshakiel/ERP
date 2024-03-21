<?php
$isearch= $_GET['str'];
$hmo = $_GET['hmo'];
$ptype = $_GET['ptype'];
$ttype = $_GET['ttype'];

list($hmocode, $hmoname) = explode("||", $hmo);
if($ptype=="in"){$patienttype = "IN-PATIENT"; $qryz = "and a.caseno like '%I-%'";}
elseif($ptype=="in"){$patienttype = "OUT-PATIENT"; $qryz = "and a.caseno not like '%I-%'";}
else{$patienttype = "ALL"; $qryz = "";}

include "../../main/connection.php";

$counting1 = 0;
if($isearch == ""){}else{
echo"
<table width='100%' align='center'><tr><td>
<table class='table' border='1'>
<tr>
<th class='text-center'>Action</th>
<th width='50%'>Patient Information</th>
<th width='30%'>Amount</th>
</tr>
";


$result = $conn->query("SELECT a.caseno, p.patientname, a.hmo, a.dateadmit from admission a left join patientprofile p on a.patientidno=p.patientidno where
(p.lastname like '$isearch%' OR p.firstname like '$isearch%' OR concat(p.lastname,' ',p.firstname,' ',p.middlename) like '%$isearch%' OR 
concat(p.lastname,', ',p.firstname,' ',p.middlename) like '%$isearch%' OR a.caseno='$isearch') and a.caseno not like '%W%' $qryz 
group by a.caseno order by p.patientname");
$counting = mysqli_num_rows($result);
while($row22j = $result->fetch_assoc()){
$caseno = $row22j['caseno'];
$pname = $row22j['patientname'];
$hmocompany = $row22j['hmo'];
$dateadmit = $row22j['dateadmit'];
    
$a=0; $loa=0;
if($ttype=="insurance"){
if($ptype=="in"){
$result2 = $conn->query("SELECT sum(hmo) as hmoamount FROM productout where caseno='$caseno' and trantype='charge'");
while($row2 = $result2->fetch_assoc()) {$loa=$row2['hmoamount'];}
}else{
$result2 = $conn->query("SELECT sum(hmo) + sum(excess) as hmoamount FROM productout where caseno='$caseno' and trantype='charge'");
while($row2 = $result2->fetch_assoc()) {$loa=$row2['hmoamount'];}
}
if($hmocompany == $hmoname){$a++;}
    
}else{
    
$sql2 = $conn->query("SELECT sum(amount) as amount, refno FROM collection where acctno='$caseno' and accttitle like '%$hmoname%' and type='pending'");
while($row2 = $sql2->fetch_assoc()) {
    $loa=$row2['amount'];
    $refno = $row2['refno'];
    
    if(strpos($caseno, "AR-") === false and strpos($caseno, "R-") !== false) {
    if(strpos($refno, "GL")!==false){
        $sel = $conn->query("select * from gl_posting where refno='$refno'");
        if(mysqli_num_rows($sel)>0){
        while($ssel = $sel->fetch_assoc()){$gl_id = $ssel['gl_id'];}

        $fel = $conn->query("select * from gl_posting where gl_id='$gl_id' and gl_type='debit' and status='pending'");
        if(mysqli_num_rows($fel)>0){
        while($fel1 = $fel->fetch_assoc()){$loa=$fel1['amount'];}
        }else{$loa="0";}
    }
    }else{$loa = "0";}
}

}
if($loa>0){$a++;}

}

if($a>0){
echo"

<tr>
<td style='text-align: center;'>
<form method='POST'>
<button type='submit' class='btn btn-primary' name='btnsave'><i class='icofont-check'></i></button>
<input type='hidden' name='caseno' value='$caseno'>
<input type='hidden' name='origamount' value='$loa'>
<input type='hidden' name='amount' id='amount' value='$loa'>
<input type='hidden' name='gl_id' id='amount' value='$gl_id'>
</form>
</td>
<td style='font-size: 12px;'><font color='gray'><i class='icofont-id'></i> Caseno:</font> <a href='../nsstation/?detail&caseno=$caseno' target='_blank'>$caseno || $refno</a><br><font color='gray'><i class='icofont-user-alt-3'></i> Name:</font> <b>$pname</b></td>
<td style='font-size: 12px;'><input type='text' name='amountx' value='$loa' oninput='eload(this.value);' style='height:30px; font-size:10pt; padding: 0px; text-align: center;'></td>
</tr>

";
}

}

if($counting==0){
echo "
<tr>
<td colspan='9'><h3><font color='black'>No Record Found........</h3></td>
</tr>
";
}
echo"</table></tr></td></table>";
}
?>

<script>
function eload(val){
$document.getElementById("amount").value = val;
}
</script>