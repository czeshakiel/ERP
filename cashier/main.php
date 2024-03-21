<?php
$displayx = ""; $displayxx = "";
//if($dept =="CASHIER"){$displayx = "and po.productsubtype != 'PHARMACY/MEDICINE'"; $displayxx = "and po.productsubtype != 'PHARMACY/MEDICINE'";}
//elseif($dept =="CASHIER3"){$displayx = "and po.productsubtype = 'PHARMACY/MEDICINE'";}

if($dept =="CASHIER"){$displayx = "and po.productsubtype != 'PHARMACY/MEDICINE'"; $displayxx = "and po.productsubtype != 'PHARMACY/MEDICINE'";}
elseif($dept =="CASHIER3"){$displayx = "and (po.productsubtype = 'PHARMACY/MEDICINE' or po.productsubtype like '%SUPPLIES%')";}
?>



<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><?php echo $ddisp ?></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">


<?php
if($_SESSION['loadreq'] == "ipd"){include "inpatient.php";}
elseif($_SESSION['loadreq'] == "rdu"){include "outpatientrdu.php";}
elseif($_SESSION['loadreq'] == "opd"){include "outpatient.php";}
elseif($_SESSION['loadreq'] == "ppayment"){include "postpayment.php";}
elseif($_SESSION['loadreq'] == "arp"){include "arpatient.php";}
elseif($_SESSION['loadreq'] == "finalbill"){include "finalbill.php";}
elseif($_SESSION['loadreq'] == "casestudy"){include "casestudy.php";}
else{
echo"<br>";
if($_SESSION['loadreq'] == ""){include 'inpatient.php';}
else{include 'outpatient.php';}
} 
?>



</div>
</div>
</div>
</div>
</section>
</main>
