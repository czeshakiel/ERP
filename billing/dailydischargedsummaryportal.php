<?php
$rundate=$_GET['startdate'];
$type=$_GET['type'];
$department=$_GET['department'];
if($type=="CREDIT"){
  echo "<script>
  window.location='dailydischargednocoh.php?startdate=$rundate&department=$department';
  </script>";
}else{
  echo "<script>
  window.location='dailydischargedcoh.php?startdate=$rundate&department=$department';
  </script>";
}
 ?>
