<?php
$cc = 1;
if(isset($_POST['btnlog'])){
$doc = $_POST['name'];

$sql2g = "SELECT * FROM nsauthdoctors where station='RADIOLOGYDOCTORS' and name='$doc' order by name";    
$result2g = $conn->query($sql2g);
$count = mysqli_num_rows($result2g);

if($count>0){
while($row2g = $result2g->fetch_assoc()) {  
$userup = $row2g['name'];
$dept2 = $row2g['station'];
$branch = $row2g['Branch'];
$uname = $row2g['username'];
$pass = $row2g['password'];
$empiddoc = $row2g['empid'];
}

$_SESSION['userdoc'] = $userup;
$_SESSION['useruniquedoc'] = $uname;
$_SESSION['deptdoc'] = $dept2;
$_SESSION['empiddoc'] = $empiddoc;

echo"
<script>
let a=document.createElement('a');
a.href='../readerslog/?main';
a.target='_blank';
a.click();

window.location= '?readerslogin';
</script>
";

exit();
}else{$cc = 0;}
}
?>


<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?view=main">Main</a></li>
<li class="breadcrumb-item">Readers Login</li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body"><br>

<form class="user" method="POST">
<table width="50%" align="center"><tr><td>
<div class='card' style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class='card-body'>Readers Login<b><?php echo $employerno ?></b><hr>

<br><table width="95%" align="center"><tr><td>
<div class="form-group">

<select name="name" class="form-control mb-3">
<?php 
$sql2g = "SELECT * FROM nsauthdoctors where station='RADIOLOGYDOCTORS' order by name";    
$result2g = $conn->query($sql2g);
while($row2g = $result2g->fetch_assoc()) { 
$name=$row2g['name'];  
echo "<option value='$name'>$name</option> ";
}
?>
</select>
<input type="hidden" name="dept" id="dept"  value="RADIOLOGYDOCTORS">    
<?php if($cc<=0){ echo"<p><font color='red'>* Wrong Username and Password!</p>"; } ?>                        
                        
</div>
<div class="form-group" style="text-align: right;">
<button type="submit" name="btnlog" class="btn btn-primary btn-block"><i class="bi bi-person-check-fill"></i> Login</button>
</div>

</td></tr></table><br>

</div>
</td></tr></table>
</form>


</div>
</div>
</div>
</div>
</section>
</main>
