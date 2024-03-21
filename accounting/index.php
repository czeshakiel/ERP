
<?php
include "../main/class.php";
if($_SESSION['verifyuser']!="verified"){echo"<script>window.location='../';</script>";}
// -------------------------------------->>>>> ISSET DISPLAY -------------------->>>>>>>
if($dept=="ACCOUNTING"){
if(isset($_GET['main'])){$main="main.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['paysupplier'])){$main="paysupplier.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['editOR'])){$main="editOR.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['makesupvoucher'])){$main="makesuppliervoucher.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['paysupvoucher'])){$main="makesuppliervoucherpayment.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['artrade'])){$main="../cashier/arpatient.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['aremployee'])){$main="../cashier/arpatient.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['arpayment'])){$main="../cashier/artradepayment.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['billingreport'])){$main="billingreport.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['pricereview'])){$main="pricereview.php"; $sidebar="sidebar.php";}

elseif(isset($_GET['accountreceivable'])){$main="accountreceivable.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['phicreceivable'])){$main="phicreceivable.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['phicreceivabledetails'])){$main="phicreceivabledetails.php"; $sidebar="sidebar.php";}

elseif(isset($_GET['accountpayable'])){$main="accountpayable.php"; $sidebar="sidebar.php";}

elseif(isset($_GET['papsmear'])){$main="reports/papsmear.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['readerpf'])){$main="readerpf.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['xrayrep_print'])){$main="reports/rep_xray_print.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['heartrep_print'])){$main="reports/rep_heart_print.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['diagnosticrep'])){$main="reports/diagnosticrep.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['arreport'])){$main="arreport.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['pfreport'])){$main="pfreports.php"; $sidebar="sidebar.php";}
else{$main="main.php"; $sidebar="sidebar.php";}
}

elseif($dept=="CPU" or $dept=="CSR" or $dept=="CPU-RDU"){
if(isset($_GET['main'])){$main="../accounting/cpureport/main.php"; $sidebar="../accounting/cpureport/sidebar.php";}
elseif(isset($_GET['chargeslip'])){$main="../accounting/cpureport/chargeslip.php"; $sidebar="../accounting/cpureport/sidebar.php";}
}


elseif($dept=="ER"){
if(isset($_GET['main'])){$main=""; $sidebar="../accounting/cpureport/sidebar.php";}
elseif(isset($_GET['bulkadjustment'])){$main="../pharmacy/scm_bulkadjustment"; $sidebar="../accounting/cpureport/sidebar.php";}
}


else{
if(isset($_GET['main'])){$main="../accounting/hmotransmittal/hmotransmittal.php"; $sidebar="../accounting/hmotransmittal/sidebar.php";}
elseif(isset($_GET['newtransmittallist'])){$main="../accounting/hmotransmittal/newtransmittallist.php"; $sidebar="../accounting/hmotransmittal/sidebar.php";}
elseif(isset($_GET['processingdetails'])){$main="../accounting/hmotransmittal/processingdetails.php"; $sidebar="../accounting/hmotransmittal/sidebar.php";}
elseif(isset($_GET['transmittallist'])){$main="../accounting/hmotransmittal/transmittallist.php"; $sidebar="../accounting/hmotransmittal/sidebar.php";}
elseif(isset($_GET['transmittallistdetails'])){$main="../accounting/hmotransmittal/transmittallistdetails.php"; $sidebar="../accounting/hmotransmittal/sidebar.php";}
elseif(isset($_GET['hmoacctreceivable'])){$main="../accounting/hmotransmittal/accountreceivable.php"; $sidebar="../accounting/hmotransmittal/sidebar.php";}
elseif(isset($_GET['hmoacctreceivabledetails'])){$main="../accounting/hmotransmittal/accountreceivabledetails.php"; $sidebar="../accounting/hmotransmittal/sidebar.php";}
elseif(isset($_GET['statuschecker'])){$main="../accounting/hmotransmittal/statuschecker.php"; $sidebar="../accounting/hmotransmittal/sidebar.php";}
elseif(isset($_GET['statusmonitoring'])){$main="../accounting/hmotransmittal/statusmonitoring.php"; $sidebar="../accounting/hmotransmittal/sidebar.php";}
elseif(isset($_GET['statusmonitoringdetail'])){$main="../accounting/hmotransmittal/statusmonitoringdetail.php"; $sidebar="../accounting/hmotransmittal/sidebar.php";}
elseif(isset($_GET['agingmonitoring'])){$main="../accounting/hmotransmittal/agingmonitoring.php"; $sidebar="../accounting/hmotransmittal/sidebar.php";}
elseif(isset($_GET['agingmonitoringdetail'])){$main="../accounting/hmotransmittal/agingmonitoringdetail.php"; $sidebar="../accounting/hmotransmittal/sidebar.php";}
else{$main="../accounting/hmotransmittal/hmotransmittal.php"; $sidebar="../accounting/hmotransmittal/sidebar.php";}
}
// ------------------------------------------------------------------------------ >>>>>>


include "../main/header.php"; 
?>
<!------------------------------- AUTO LOADING IF PAGE IS LOADING --------------------->
<style>
.center {
position: absolute;
top: 0;
bottom: 0;
left: 0;
right: 0;
margin: auto;
}
</style>

<!------------------------------- AUTO LOADING IF PAGE IS LOADING --------------------->
<style>
.center {
position: absolute;
top: 0;
bottom: 0;
left: 0;
right: 0;
margin: auto;
}
</style>

<script>
document.onreadystatechange = function() {
if (document.readyState !== "complete") {
document.getElementById("loading").style.display="";
document.getElementById("maindisplay").style.display="";
} else {
document.getElementById("loading").style.display="none";
document.getElementById("maindisplay").style.display="";
}
};
</script>
<img src="../main/img/loading2.gif" id="loading" class="center"></img>
<!--------------------------- END AUTO LOADING IF PAGE IS LOADING --------------------->



<body>
<div id="mytask-layout" class="theme-indigo"> 
<?php include "$sidebar"; ?>  

<!-- main body area -->
<div class="main px-lg-4 px-md-4">
<?php include "../main/heading.php"; ?> 
<div id="maindisplay" style="display: none;"><?php include "$main"; ?> <br></div>
</div>
</div>

<?php
if($dept=="ACCOUNTING" or $dept=="HMO" or $dept=="CPU" or $dept=="CSR" or $dept=="CPU-RDU" or $dept=="ER"){$mydept=$dept;}else{$mydept="ACCOUNTING";}
include "../verifymodule.php";
include "../main/footer.php";
?> 
</body>
</html> 