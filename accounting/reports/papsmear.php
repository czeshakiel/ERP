<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?editcaseno&caseno=<?php echo $caseno ?>">Change Hospital Caseno</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><b><i class="bi bi-file-earmark-medical"></i> Papsmear Report </b></p><hr>

<?php if(!isset($_POST['datefrom'])){ ?>
<table width="40%"><tr><td>
<div class="card" style='box-shadow: 0px 0px 0px 1px #4B54B2;'>
<div class="card-header" style="background-color: #4B54B2; padding: 7px;">
<table width="100%"><tr><td style="color: white;"> <i class="bi bi-award"></i> HOSPITAL CASENO: <b><?php echo $employerno ?></td></tr></table>
</div>
<div class="card-body">
<form method="POST">
<br><table width="100%" align="center">
<tr>
<td width="30%"><font class="font8">Date from:</td>
<td><input type="date" name="datefrom" style="height:35px; font-size:10pt; color: black; width: 100%;" value="<?php echo date('Y-m-d') ?>" required></td>
</tr>
<tr>
<td><font class="font8">Date to:</td>
<td><input type="date" name="dateto" style="height:35px; font-size:10pt; color: black; width: 100%;" value="<?php echo date('Y-m-d') ?>" required></td>
</tr>
<tr><td colspan="2" align="right">
<button type="submit" name="btnupdate" class="btn btn-primary"><i class="fa fa-edit"></i> Submit</button>
</td></tr>
</table><br>
</form>
</div>
</div>
</td></tr></table>
<?php } ?>



<?php 
if(isset($_POST['datefrom'])){ 
$datefrom = $_POST['datefrom'];
$dateto = $_POST['dateto'];

echo"
<table width='100%' border='1' class='table'>
<tr>
<td>name</td>
<td>Trantype</td>
<td>Date Request</td>
<td>Amount Share</td>
</tr>
";

$total = 0;
$sqlres = $conn->query("select * from patientprofile a, admission b, productout c where a.patientidno = b.patientidno and 
b.caseno = c.caseno and c.productdesc = 'PAP SMEAR' and (c.status='PAID' or c.status='Approved') and (ap = '100143' or ap='LILY YAP MUDANZA')");
while($res = $sqlres->fetch_assoc()){

$total += 300;
echo"
<tr>
<td>$res[patientname]</td>
<td>$res[trantype]</td>
<td>$res[datearray]</td>
<td>300</td>
</tr>
";
}

echo"
<tr>
<td>TOTAL</td>
<td></td>
<td></td>
<td>$total</td>
</tr>
";
} 
?>

</div>
</div>
</div>
</div>
</section>
</main>
