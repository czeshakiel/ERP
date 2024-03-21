<?php
$rundate=$_GET['startdate'];
$type=$_GET['type'];
$department=$_GET['department'];
if($type=="CREDIT"){
  echo "<script>
  window.location='dailydischargednocohbeta.php?startdate=$rundate&department=$department';
  </script>";
}else{
  echo "<script>
  window.location='dailydischargedcohbeta.php?startdate=$rundate&department=$department';
  </script>";
}
 ?>
