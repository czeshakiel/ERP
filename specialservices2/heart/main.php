<script>
function confirmx(){
    if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};
    }
</script>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?view=main">Main</a></li>
<li class="breadcrumb-item"><a href=""></a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<?php
if(isset($_GET['IPD'])){
$ipd = "class='btn btn-primary btn-sm'";
$opd = "class='btn btn-default border border-primary btn-sm'";
$ttbd = "class='btn btn-default border border-primary btn-sm'";
$queryx="and a.ward='in' and p.terminalname='pending'";
}
elseif(isset($_GET['OPD'])){
$opd = "class='btn btn-primary btn-sm'";
$ipd = "class='btn btn-default border border-primary btn-sm'";
$ttbd = "class='btn btn-default border border-primary btn-sm'";
$queryx="and a.ward='out' and p.terminalname='pending'";
}

elseif(isset($_GET['TTBD'])){
$ttbd = "class='btn btn-primary btn-sm'";
$opd = "class='btn btn-default border border-primary btn-sm'";
$ipd = "class='btn btn-default border border-primary btn-sm'";
$queryx="and (a.ward='in' or a.ward='out') and p.terminalname='Testtobedone'";
}

else{
$ipd = "class='btn btn-primary btn-sm'";
$opd = "class='btn btn-default border border-primary btn-sm'";
$ttbd = "class='btn btn-default border border-primary btn-sm'";
$queryx="and a.ward='in' and p.terminalname='pending'";
}

if(!isset($_POST['day1'])){$day1=date("Y-m-d"); $day2=date("Y-m-d");}else{$day1 = $_POST['day1']; $day2 = $_POST['day2'];}
?>

<table width="100%"><tr><td width="45%">
<div class="container">
<div class="btn-group btn-group-justified" style="width: 100%;">
<button name="ipd" style="width:20%; font-size: 12px;" onclick="loadz('IPD');" <?php echo $ipd ?>><i class="icofont-users-alt-5"></i> IPD Request</button></a>
<button name="opd" style="width:20%; font-size: 12px;" onclick="loadz('OPD');" <?php echo $opd ?>><i class="icofont-users-social"></i> OPD Request</button>
<button name="rdu" style="width:20%; font-size: 12px;" onclick="loadz('TTBD');" <?php echo $ttbd ?>><i class="icofont-ui-clip-board"></i> Test To Be Done</button>
</div>
</div>
</td><td>
<form method="POST">
<table align="right" width="85%"><tr>
<td width="20%"><font class="font7">Display From :</td>
<td width="20%"><input type="date" name="day1" value="<?php echo $day1 ?>" style="text-align: center; height: 25px; padding: 0;"></td>
<td width="40%">to <input type="date" name="day2" value="<?php echo $day2 ?>" style="text-align: center; height: 25px; padding: 0;"></b></td>
<td> <button class="btn btn-danger btn-sm"><i class="icofont-ui-calendar"></i> Submit</button></td>
</tr></table>
</form>
</tr>
</td></tr></table>
<hr>


<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr> 
<th class="text-center">#</th>
<th class="text-center">PATIENT <br> INFORMATION</th>
<th class="text-center">DATE/ TIME<br>REQUEST</th>
<th class="text-center">DESCRIPTION/ <br> PRODUCTSUBTYPE</th>
<th class="text-center">STATUS</th>
<th class="text-center">READER/ <br> USER</th>
<th class="text-center">ACTION</th>
</tr>
</thead>
<tbody>

<?php
$sql4 = "select a.patientidno, a.caseno, p.refno, p.productdesc, p.status, p.loginuser, p.terminalname, a.patientidno, a.room, p.invno, p.datearray, p.trantype, p.productsubtype, p.productcode, p.approvalno, p.administration from productout p, admission a where a.caseno=p.caseno and (p.productsubtype LIKE '%HEARTSTATION%' or p.productsubtype LIKE '%ECG%') $queryx and p.status!='CANCELLED' and p.datearray between '$day1' and '$day2' order by p.datearray desc, p.invno";
$result4 = $conn->query($sql4);
while($row4 = $result4->fetch_assoc()){
$patientidno=$row4['patientidno'];
$caseno=$row4['caseno'];
$refno=$row4['refno'];
$productdesc=$row4['productdesc'];
$status =$row4['status'];;
$loginuser=$row4['loginuser'];
$terminalname=$row4['terminalname'];
$patientidno=$row4['patientidno'];
$room=$row4['room'];
$invno=$row4['invno'];
$date=$row4['datearray'];
$trantype=$row4['trantype'];
$productsubtype = $row4['productsubtype'];
$productcode =$row4['productcode'];
$approvalno =$row4['approvalno'];
$dtreq = date("F d, Y", strtotime($date))."<br>".date("h:i:s a", strtotime($invno));
list($readercode, $read) = explode("_", $row4['administration']);
if($read==""){$read="---- NOT SET ----";}
$i++;


$sql44 = "select * from patientprofile where patientidno='$patientidno'";
$result44 = $conn->query($sql44);
while($row44 = $result44->fetch_assoc()){
$i++;
$lname=$row44['lastname'];
$fname=$row44['firstname'];
$mname=$row44['middlename'];
$name = $lname.", ".$fname." ".$mname;
$sex = $row44['sex'];

if($sex=="M"){if($senior=="Y"){$ge="boy";}else{$ge="boy";}}
else{if($senior=="Y"){$ge="girl";}else{$ge="girl";}}
}


if($terminalname == "pending" && $status == "PAID"){
$refund="<a class='dropdown-item' href='refund.php?refno=$refno' title='For Refund Item' onclick='return refundItem();'><font size='2'><i class='bi bi-arrow-down-left-circle'></i> Refund</a>";}
elseif($terminalname == "refund" && $status == "PAID"){$refund="<a class='dropdown-item' href='undorefund.php?refno=$refno' title='Undo Refund Item' onclick='return undoRefund();'><font size='2'><i class='bi bi-arrow-up-right-circle-fill'></i> Undo Refund</a>";}
else{ $refund="";}

echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $caseno<br>$name</td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px; text-align: center;'>$dtreq</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px; text-align: center;'>$productdesc<br>$productsubtype</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px; text-align: center;'>$status<br>$terminalname</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px; text-align: center;'>$read<br>$user</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px; text-align: center;'>
<div class='dropdown'>
<button class='btn btn-primary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>
<i class='icofont-ui-settings'></i>
</button>
<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
"; if($status=="requested"){echo"<li><a class='dropdown-item'><font color='red'><i class='bi bi-exclamation-circle'></i> Unable to Generate</font></a></li>";}else{ ?>
<li><a class="dropdown-item" href="?generateresult&caseno=<?php echo $caseno ?>&refno=<?php echo $refno ?>&productsubtype=<?php echo $productsubtype.$datax ?>"><i class='bi bi-pin-angle'></i> Generate Result</a>
<button type='button' id='iddecking' data-bs-toggle='modal' data-bs-target='#decking' hidden>My Button</button>
</li>
<?php } echo"
<li><a class='dropdown-item' href='index.php?view=manage_qty$datax&caseno=$caseno&refno=$refno&code=$productcode&batchno=$batchno&pname=$pname&mm=$mm1&dd=$dd1&yy=$yy1'><i class='bi bi-printer'></i> Print Slip</a></li>
$refund
<li><a class='dropdown-item' href='?main&caseno=$caseno&refno=$refno&code=$productcode&delete' onclick='confirmx();'><i class='bi bi-trash'></i> Delete</a></li>
</ul>
</div>
</td>
</tr>
";
}
?>
</tbody>
</table>


</div>
</div>
</div>
</div>
</section>
</main>

<script>
function loadz(val){window.location= "?main&"+val;}
</script>



<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<div class="modal fade" id="decking" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> SET READER AND FILMNO</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='tabiframedecking' src='' width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->
