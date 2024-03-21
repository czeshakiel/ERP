<?php
if(isset($_GET['cancelor'])){
$orno = $_GET['orno'];


$i=0;
$result = $conn->query("select * from collection where batchno='$orno'");
while($row = $result->fetch_assoc()) {
$caseno = $row['acctno'];
$acctname = $row['acctname'];
$accttitle = $row['accttitle'];
$desc = $row['description'];
$amount = $row['amount'];
$tamount += $amount;
$disc = $row['discount'];
$refno = $row['refno'];
$vdate = date("F d, Y", strtotime($row['datearray']));
$vtime = date("h:i:s a", strtotime($row['paymentTime']));
$type = $row['type'];
$deptx = $row['Dept'];
$i++;

if((strpos($accttitle, "AR TRADE")!==false or strpos($accttitle, "AR DOCTOR")!==false or strpos($accttitle, "AR EMPLOYEE")!==false or strpos($accttitle, "AR PERSONAL")!==false) and $type=="cash-Visa"){
$totalam = 0; $totaldisc = 0;
$ar = $conn->query("select * from collection where acctno='$caseno' and accttitle='$accttitle' and description='$desc' and type='pending'");
while($ar1 = $ar->fetch_assoc()){$arrefno = $ar1['refno']; $aramount = $ar1['amount']; $ardisc = $ar1['discount'];}

$totalam = $aramount + $amount;
$totaldisc = $ardisc + $disc;
$conn->query("update collection set amount='$totalam', discount='$totaldisc' where acctno='$caseno' and refno='$arrefno'");
}

$refnox = "RN".date("YmdHis").$i;
$conn->query("update productout set status='requested' where caseno='$caseno' and refno='$refno'");
$conn->query("update collection set type='CANCELLED', refno='$refnox', accttitle='CANCELLED', amount='0.00', discount='0.00', shift='$refno' where acctno='$caseno' and refno='$refno'");
$conn->query("update acctgenledge set status='CANCELLED', refno='$refnox' where caseno='$caseno' and refno='$refno'");
$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('cancel OR Number [$orno] [$refno - $amount - $disc - $accttitle - $desc]', '$user', CURDATE(), CURTIME())");


if((strpos($caseno, "I-")!==false or strpos($caseno, "O-")!==false  or strpos($caseno, "R")!==false) and ($desc=='HOSPITAL BILL' or $accttitle=='PROFESSIONAL FEE')){
$conn->query("update admission set corp='' where caseno='$caseno'");
}

if(strpos($caseno, "R-")!==false){
$refno1 = $refno."1";
$vdate = date("M-d-Y");
$conn->query("INSERT INTO `collection`(`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`,
`Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`, `batchno`) VALUES ('$refno1', '$caseno', '$acctname', '', '$desc', '$accttitle',
'$amount', '$disc', '$vdate', '$deptx', '$user', '', 'pending', '', '', CURDATE(), '', '')");
}
 
}


echo"<script>alert('Cancel OR Successfully..'); window.location='../cashier/?editOR';</script>";
}


if(isset($_POST['refund'])){
$ck = $_POST['ck'];
$ccount = count($ck);

for($i=0; $i<$ccount; $i++){
$result = $conn->query("select * from collection where refno='$ck[$i]'");
while($row = $result->fetch_assoc()) {
$caseno = $row['acctno'];
$acctname = $row['acctname'];
$accttitle = $row['accttitle'];
$desc = $row['description'];
$amount = $row['amount'];
$tamount += $amount;
$disc = $row['discount'];
$refno = $row['refno'];
$ofr = $row['ofr'];
$deptx = $row['Dept'];
$vdate = date("M-d-Y");
}

// if($dept=="ACCOUNTING"){
//   $conn->query("update collection set type='Refunded' where refno='$ck[$i]'");
//   $conn->query("update productout set status='Refunded' where refno='$ck[$i]'");
//   $conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('Refund OR Number [$ofr] [$refno - $amount - $disc - $accttitle - $desc]', '$user', CURDATE(), CURTIME())");
// }

// else{
// $refnox = $refno."_ref";
// $conn->query("INSERT INTO `collection`(`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`, `Dept`, `username`,
// `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`) VALUES ('$refnox', '$caseno', '$acctname', '$ofr', '$desc', '$accttitle', '$amount', '$disc', '$vdate', '$deptx', '$user',
// '', 'Refunded', CURTIME(), '$dept', CURDATE(), '')");

// $conn->query("update productout set status='Refunded' where refno='$ck[$i]'");
// }


$conn->query("update collection set type='Refunded' where refno='$ck[$i]'");
$conn->query("update productout set status='Refunded' where refno='$ck[$i]'");
$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('Refund OR Number [$ofr] [$refno - $amount - $disc - $accttitle - $desc]', '$user', CURDATE(), CURTIME())");



}
echo"<script>alert('Refund Successfully..'); window.location='../cashier/?editOR';</script>";
}
?>

<style>
.tablex {
  border-collapse: separate;
  border-spacing: 0;
  width: 100%;
  

}
.tablex tr th,
.tablex tr td {
  border-right: 1px solid #bbb;
  border-bottom: 1px solid #bbb;
  padding: 5px;
  text-align: left;
  /*font-family: "Arial", Arial, San-serif;*/
    font-family: Arial, Helvetica, sans-serif;
}
.tablex tr th:first-child,
.tablex tr td:first-child {
  border-left: 1px solid #bbb;
}
.tablex tr th {

  border-top: 1px solid #bbb;
  text-align: left;
}

/* top-left border-radius */
.tablex tr:first-child th:first-child {
}

/* top-right border-radius */
.tablex tr:first-child th:last-child {
}

/* bottom-left border-radius */
.tablex tr:last-child td:first-child {
}

/* bottom-right border-radius */
.tablex tr:last-child td:last-child {
}
}
</style>

<main id="main" class="main">

<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?view=main">Main</a></li>
<li class="breadcrumb-item"></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">

<div class="card">
<div class="card-body">

<h5><font color="black"><i class='icofont-edit'></i> EDIT OR TRANSACTION</h5><hr>


<table width="40%"><tr>
<td valign="TOP">
<div class="input-group mb-3" valign="bottom">
<span class="input-group-text" id="basic-addon1"><i class="icofont-search-2"></i></span>
<input type="text" class="form-control" name="search_text" id="search_text" onchange="aa(this.value)" placeholder="Search OR Number [Enter]">
</div>
</td>
</tr></table>

<div id="result"></div>


</div>
</div>

</div>
</div>
</section>
</main>


<script>
function aa(str){
$.get("../accounting/editORfetch.php", {str:str},
function (data) {$("#result").html(data);});
}

function conf(){if (confirm('Are you sure you want to cancel this OR?')){return true;}else{event.stopPropagation(); event.preventDefault();};}
</script>