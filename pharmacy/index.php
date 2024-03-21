
<?php
include "../main/class.php";
if($_SESSION['verifyuser']!="verified"){echo"<script>window.location='../';</script>";}
// -------------------------------------->>>>> ISSET DISPLAY -------------------->>>>>>>
if(isset($_GET['main'])){$main="main.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['mainhm'])){$main="mainhm.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['details'])){$main="detail.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['archives'])){$main="../nsstation/searcharchives.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['detail'])){$main="../nsstation/detail.php"; $sidebar="../nsstation/sidebardetail.php";}
elseif(isset($_GET['activept'])){$main="../nsstation/allpatient.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['activeptopd'])){$main="../nsstation/allpatient.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['returnitem'])){$main="returnitem.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['returnitem2'])){$main="returnitem2.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['pos'])){$main="POS.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['requestreturn'])){$main="requestreturn.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['servemonitoring'])){$main="servemonitoring.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['trackinvoice'])){$main="trackinvoice.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['aremployee'])){$main="POSar.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['ardoctor'])){$main="POSar.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['priceinquiry'])){$main="viewprice.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['priceinquirynew'])){$main="priceinquiry.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['arreport'])){$main="../accounting/arreport.php"; $sidebar="sidebar.php";}

// --------------------------------- SCM MODULE --------------------------
elseif(isset($_GET['manualreceiving'])){$main="scm_manualreceiving.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['manualreceiving2'])){$main="scm_manualreceiving2.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['purchaserequest'])){$main="scm_purchaserequest.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['purchaserequest2'])){$main="scm_purchaserequest2.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['stockrequest'])){$main="scm_stockrequest.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['stockrequest2'])){$main="scm_stockrequest2.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['adjustmenthistory'])){$main="scm_adjustmenthistory.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['adjustmenthistory2'])){$main="scm_adjustmenthistory2.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['adjustmenthistorydet'])){$main="scm_adjustmenthistory2detail.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['password'])){$main="scm_password.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['adjustment'])){$main="scm_adjustment.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['reorderinglevel'])){$main="scm_reorderinglevel.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['estockcard'])){$main="scm_estockcard.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['estockcarddet'])){$main="scm_estockcarddet.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['prhistory'])){$main="scm_prhistory.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['prhistorylist'])){$main="scm_prhistorylist.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['stockissuance'])){$main="scm_stockissuance.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['issuancehistory'])){$main="scm_issuancehistory.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['issuancehistory2'])){$main="scm_issuancehistory2.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['countsheet'])){$main="scm_countsheet.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['bulkadjustment'])){$main="scm_bulkadjustment.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['stockreturn'])){$main="scm_stockreturn.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['stockreturn2'])){$main="scm_stockreturn2.php"; $sidebar="sidebar.php";}
else{$main="main.php"; $sidebar="sidebar.php";}
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
if($dept=="PHARMACY" or $dept=="PHARMACY_OPD" or $dept=="CSR2"){$mydept="$dept";}
else{$mydept="PHARMACY";}

include "../verifymodule.php";

$_SESSION['homemeds']='';
include "../chargecart/cartmodal.php";
include "../nsstation/modal_class.php";
include "../main/footer.php";
?>
</body>
</html>
