<?php

if(isset($_POST['btndone'])){
$refno = $_POST['refno'];
$caseno = $_POST['caseno'];
$conn->query("update productout set terminalname='Testdone' where caseno='$caseno' and refno='$refno'");
$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('PT Set Testdone [refno: $refno || caseno: $caseno]', '$user', CURDATE(), CURTIME())");
echo"<script>alert('set procedure done!'); window.location='?ptlab';</script>";
}


if(isset($_POST['ipd'])){
$ipd = "class='btn btn-primary'";
$opd = "class='btn btn-outline-primary'";
$ipdtd = "class='btn btn-outline-primary'";
$opdtd = "class='btn btn-outline-primary'";
$queryx="and a.ward='in' and po.terminalname='pending'";
}

elseif(isset($_POST['opd'])){
$ipd = "class='btn btn-outline-primary'";
$opd = "class='btn btn-primary'";
$ipdtd = "class='btn btn-outline-primary'";
$opdtd = "class='btn btn-outline-primary'";
$queryx="and a.ward='out' and po.terminalname='pending'";
}

elseif(isset($_POST['ipdtd'])){
    $ipd = "class='btn btn-outline-primary'";
    $opd = "class='btn btn-outline-primary'";
    $ipdtd = "class='btn btn-primary'";
    $opdtd = "class='btn btn-outline-primary'";
    $queryx="and a.ward='in' and po.terminalname='Testdone'";
    }

    elseif(isset($_POST['opdtd'])){
        $ipd = "class='btn btn-outline-primary'";
        $opd = "class='btn btn-outline-primary'";
        $ipdtd = "class='btn btn-outline-primary'";
        $opdtd = "class='btn btn-primary'";
        $queryx="and a.ward='out' and po.terminalname='Testdone'";
        }

else{
$ipd = "class='btn btn-primary'";
$opd = "class='btn btn-outline-primary'";
$ipdtd = "class='btn btn-outline-primary'";
$opdtd = "class='btn btn-outline-primary'";
$queryx="and a.ward='in' and po.terminalname='pending'"; 
}
?>

<main id="main" class="main">

<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?ptpf">PT PF Date</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">

<div class="card">
<div class="card-body">


<form method="post">
<div class="container">
<div class="btn-group btn-group-justified" style="width: 70%;">
<button name="ipd" style="width:20%; font-size: 12px;" <?php echo $ipd ?>><i class="icofont-people"></i> IPD Request</button>
<button name="opd" style="width:20%; font-size: 12px;" <?php echo $opd ?>><i class="icofont-users-social"></i> OPD Request</button>
<button name="ipdtd" style="width:20%; font-size: 12px;" <?php echo $ipdtd ?>><i class="bi bi-journal-medical"></i> IPD Testdone</button>
<button name="opdtd" style="width:20%; font-size: 12px;" <?php echo $opdtd ?>><i class="icofont-credit-card"></i> OPD Testdone</button>
</div>
</div>
</form><br>

<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th width='5%'>#</th>
<th width='35%'>PATIENT NAME</th>
<th width='25%'>DATE/TIME Request</th>
<th width='20%'>TEST</th>
<th width='5%'>USER</th>
<th width='10%'></th>
</tr>
</thead>
<tbody>
<?php

$i=0;
$sql = "select a.patientidno, a.caseno, po.productcode, po.productdesc, po.status, po.refno, po.loginuser, po.terminalname, po.invno, po.datearray from 
productout po, admission a where po.caseno = a.caseno and po.productsubtype = 'PHYSICAL THERAPY' and po.status!='CANCELLED' $queryx order by po.date desc";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$productdesc =$row['productdesc'];
$status =$row['status'];
$loginuser=$row['loginuser'];
$terminalname=$row['terminalname'];
$patientidno =$row['patientidno'];
$refno =$row['refno'];
$productcode =$row['productcode'];
$caseno =$row['caseno'];

$time= date("h:i:s a", strtotime($row['invno']));
$date= date("F d, Y", strtotime($row['datearray']));
$i++;

$pt = $conn->query("select * from patientprofile where patientidno='$patientidno'");
while($pts = $pt->fetch_assoc()){
$name = $pts['lastname'].", ".$pts['firstname']." ".$pts['middlename'];
$sex = $row['sex'];
if($sex=="M"){$ge = "boy"; $sexcol ="blue";}else{$ge = "girl"; $sexcol ="#F309B6";}
}

if($status=='PAID'){$del_ref="refund"; $del_ref2="Refund";}
else{$del_ref="delete"; $del_ref2="Delete";}

echo"
<tr>
<td style='font-size:11px;'>$i</td>
<td style='font-size:11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $caseno<br><b>$name</b></td></tr></table></td>
<td style='font-size:11px;'><i class='icofont-ui-calendar'> $date<br><i class='icofont-clock-time'> $time</td>
<td style='font-size:11px;'><i class='icofont-laboratory'> $productdesc<br><i class='icofont-info-circle'> $status/ $terminalname</td>
<td style='font-size:25px;'><i class='icofont-man-in-glasses' data-bs-toggle='tooltip' title='$loginuser'></i></td>
<td class='text-center'>
"; if($terminalname!='Testdone'){ echo"
<div class='dropdown'>
<button class='btn btn-outline-danger btn-sm' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false' style='border-radius: 50%;'>
<i class='icofont-ui-settings'></i>
</button>
<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
"; if($status=="requested"){echo"<li><a class='dropdown-item'><font color='red'><i class='bi bi-exclamation-circle'></i> Unable to Testdone</font></a></li>";}else{ ?>
<li><a class="dropdown-item" onclick="loaddatax('<?php echo $caseno ?>', '<?php echo $refno ?>', '<?php echo $name ?>', '<?php echo $productdesc ?>')"><i class='bi bi-pin-angle'></i> Set Testdone</a></li>
<?php } echo"
<li><a class='dropdown-item' href='?ptlab&caseno=$caseno&refno=$refno&code=$productcode&$del_ref' onclick='confirmx();'><i class='bi bi-trash'></i> $del_ref2</a></li>
</ul>
</div>
"; }else{echo" <font color='green'><i class='icofont-check-circled'> Testdone</font>";} echo"
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


<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<button type="button" id="btnmod" class="btn btn-primary "data-bs-toggle="modal" data-bs-target="#conf" hidden>Save changes</button>
<div class="modal fade" id="conf" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><b><i class="icofont-finger-print"></i> Confirmation!</b></h5>
<button type="button" class="btn-close btn-outline-danger" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<form method='POST'>
Patient : <b id='pt'></b><br>
Test : <b id='test'></b><br><br>
Are you sure you want to set this procedure as done?<hr>
<table width="100%"><tr><td>
<table align="right">
    <tr>
        <td><button class="btn btn-primary btn-sm" type="submit" name="btndone">Proceed</button></td>
        <td><button class="btn btn-danger btn-sm" onclick="location.reload();">Cancel</button></td>
</tr>
</table>
</td></tr></table>
<input type='hidden' name='caseno' id='caseno'>
<input type='hidden' name='refno' id='refno'>
<input type='hidden' name='name' id='name'>
<input type='hidden' name='desc' id='desc'>
</form>

</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->

<script>
function loaddatax(caseno, refno, name, desc){
document.getElementById('caseno').value=caseno;
document.getElementById('refno').value=refno;
document.getElementById('name').value=name;
document.getElementById('desc').value=desc;
document.getElementById('test').innerHTML = desc;
document.getElementById('pt').innerHTML = name;
$("#btnmod").click();
}
</script>