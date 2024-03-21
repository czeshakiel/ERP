<?php
$trans = $_GET['trans'];

if($trans=="adjustment"){$da = "adjustment entry";}

if(isset($_POST['btnpass'])){
$pass = $_POST['pass'];
$sql22l = "SELECT * from nsauth where password='$pass' and station='$dept'";
$result22l = $conn->query($sql22l);
$passcheck = mysqli_num_rows($result22l);

if($passcheck<1) {$validate = "Wrong Password! Please try again...";}
if($passcheck>0){
if($trans == "adjustment"){	echo "<script>window.location='?adjustment$datax';</script>"; }
	
}
}
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a>Authentication</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><font color="black"><b><i class="bi bi-file-earmark-medical"></i> <?php echo strtoupper($da); ?></b></font></p><hr>


<table width="40%">
<tr>
<td valign="top" style="width: 70%;">
<div class='card' style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class='card-body'>
<i class="bi bi-key"></i> ENTER PASSWORD:
<hr>


<form method="POST"><br>
<table width="100%" align='center'>
<tr>
<td style="text-align: left;"><input type="password" name="pass" style="width: 100%;" class="form-control">
<?php if($validate!="") { ?> <br><font color="red">* <?php echo $validate ?></font> <?php } ?>
</td>
</tr>
<tr>
<td style="text-align: right;"><br><button name="btnpass" class="btn btn-primary">Submit</button></td>
</tr>
</table>
<br></form>

<br>
</div>
</div>
</td>
</tr>
</table>


</div>
</div>
</div>
</div>
</section>
</main>
