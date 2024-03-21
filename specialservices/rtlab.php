<?php
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
$sql = "select a.patientidno, a.caseno, po.productcode, po.productdesc, po.status, po.refno, po.loginuser, po.terminalname, po.invno, po.datearray from productout po, admission a where po.caseno = a.caseno 
and (po.productdesc LIKE 'ABG' or po.productdesc LIKE '%ASTHMA %' or po.productdesc LIKE '%COPD%' or po.productdesc LIKE '%SPIROMETRY%' or po.productdesc LIKE '%SLEEP TEST%') and po.status!='CANCELLED' $queryx order by po.date desc";
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


if(strpos($productdesc, 'ABG') !== false){
    $create_result="abg_createresult";
    $print_result="abg_printresult.php";
    
    }elseif (strpos($productdesc, 'ASTHMA') !== false){
    $create_result="as_createresult";
    $print_result="as_printresult.php";
    
    }elseif (strpos($productdesc, 'COPD') !== false){
    $create_result="copd_createresult";
    $print_result="copd_printresult.php";
    
    }elseif ((strpos($productdesc, 'SPIROM-PRE') !== false) || (strpos($productdesc, 'SPIROMETRY') !== false)){
    $create_result="spi_createresult";
    $print_result="spi_printresult.php";
    
    }elseif (strpos($productdesc, 'SLEEP TEST') !== false){
    $create_result="st_createresult";
    $print_result="st_printresult.php";
    }

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
"; 

if($status=="requested"){echo"<li><a class='dropdown-item'><font color='red'><i class='icofont-ban'></i> Unable to Create Result</font></a></li>";}
else{echo"<li><a class='dropdown-item' href='?$create_result&caseno=$caseno&refno=$refno'><i class='icofont-flask'></i> Create Result</a></li>";} 

echo"
<li><a class='dropdown-item' href='index.php?view=manage_qty$datax&caseno=$caseno&refno=$refno&code=$productcode&batchno=$batchno&pname=$pname&mm=$mm1&dd=$dd1&yy=$yy1'><i class='bi bi-printer'></i> Print Slip</a></li>
$refund
<li><a class='dropdown-item' href='?main&caseno=$caseno&refno=$refno&code=$productcode&delete' onclick='confirmx();'><i class='bi bi-trash'></i> Delete</a></li>
</ul>
</div>
"; }else{echo"<i class='icofont-check-circled'> Testdone";} echo"
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