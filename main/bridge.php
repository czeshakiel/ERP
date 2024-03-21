<?php
session_start();
$caseno=$_GET['caseno'];
$_SESSION['username'] = $_GET['nursename'];
$_SESSION['userunique'] = $_GET['username'];
$_SESSION['dept'] = $_GET['dept'];
$_SESSION['branch'] = 'KMSCI';
$_SESSION['verifyuser'] = 'verified';

if($_SESSION['dept']=="HMO" and isset($_GET['transmittal'])){echo"<script>window.location='../accounting/?main';</script>";}
elseif($_SESSION['dept']=="HMO" and isset($_GET['detail'])){echo"<script>window.location='../nsstation/?detail&caseno=$caseno';</script>";}
elseif(($_SESSION['dept']=="HMO" || $_SESSION['dept']=="BILLING" || $_SESSION['dept']=="RDU") and isset($_GET['print_slip'])){echo"<script>window.location='../nsstation/?printslip&caseno=$caseno';</script>";}
elseif($_SESSION['dept']=="RDU" and isset($_GET['editcaseno'])){echo"<script>window.location='../nsstation/?editcaseno&caseno=$caseno';</script>";}
elseif(($_SESSION['dept']=="CPU" or $_SESSION['dept']=="CSR" or $_SESSION['dept']=="CPU-RDU") and isset($_GET['chargeslip'])){echo"<script>window.location='../accounting/?chargeslip';</script>";}
elseif(isset($_GET['dischargedsummary'])){echo"<script>window.location='../nsstation/?dischargedsummary&caseno=$caseno';</script>";}
elseif(isset($_GET['laboratory'])){ echo "<script>window.location='../laboratory/?details&inp&caseno=$caseno';</script>";}

elseif(strpos($_SESSION['dept'], "RECORDS")!==false and isset($_GET['otherinfo'])){echo"<script>window.location='../nsstation/?otherinfo&caseno=$caseno';</script>";}
elseif(strpos($_SESSION['dept'], "RECORDS")!==false and isset($_GET['part2'])){echo"<script>window.location='../nsstation/?part2&caseno=$caseno';</script>";}
elseif(strpos($_SESSION['dept'], "RECORDS")!==false and isset($_GET['part3'])){echo"<script>window.location='../nsstation/?part3&caseno=$caseno';</script>";}

else{echo"<script>window.location='../nsstation/?detail&caseno=$caseno';</script>";}
?>
