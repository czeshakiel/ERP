
<?php
include "../main/class.php";
if($_SESSION['verifyuser']!="verified"){echo"<script>window.location='../';</script>";}
// -------------------------------------->>>>> ISSET DISPLAY -------------------->>>>>>>
if(isset($_GET['main'])){$main="main.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['outpatientdetail'])){$main="POS_cashier.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['archives'])){$main="../nsstation/searcharchives.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['xrayresults'])){$main="xrayresults.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['editresult'])){$main="../readerslog/editresults.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['readerslogin'])){$main="readerslogin.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['arpayment'])){$main="artradepayment.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['manualpayment'])){$main="manualpayment.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['ormonitoring'])){$main="ormonitoring.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['orseries'])){$main="orseries.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['editOR'])){$main="../accounting/editOR.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['pricelist'])){$main="pricelist.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['bulkadjustment'])){$main="../pharmacy/scm_bulkadjustment.php"; $sidebar="sidebar.php";}

elseif(isset($_GET['hmoacctreceivable'])){$main="../accounting/hmotransmittal/accountreceivable.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['hmoacctreceivabledetails'])){$main="../accounting/hmotransmittal/accountreceivabledetails.php"; $sidebar="sidebar.php";}

elseif(isset($_GET['stockrequest'])){$main="../pharmacy/scm_stockrequest.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['stockrequest2'])){$main="../pharmacy/scm_stockrequest2.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['estockcard'])){$main="../pharmacy/scm_estockcard.php"; $sidebar="sidebar.php";}

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
document.getElementById("maindisplay").style.display="none";
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
if($dept=="CASHIER" or $dept=="CASHIER2" or $dept=="CASHIER3" or $dept=="CASHIER4"){$mydept="$dept";}
else{$mydept="CASHIER";}

include "../verifymodule.php";
include "../main/footer.php";
?> 
</body>
</html> 