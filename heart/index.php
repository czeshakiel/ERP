
<?php
include "../main/class.php";
if($_SESSION['verifyuser']!="verified"){echo"<script>window.location='../';</script>";}
// -------------------------------------->>>>> ISSET DISPLAY -------------------->>>>>>>
if(isset($_GET['main'])){$main="main.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['generateresult'])){$main="generateresult.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['resultdecking'])){$main="resultdecking.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['cr2decho'])){$main="cr_2decho_ver2.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['crstresstestadult'])){$main="stresstestadult.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['details'])){$main="heartresults.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['archives'])){$main="../nsstation/searcharchives.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['xrayresults'])){$main="xrayresults.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['editresult'])){$main="../readerslog/editresults.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['pfreport'])){$main="pfreport.php"; $sidebar="sidebar.php";}

elseif(isset($_GET['stockrequest'])){$main="../pharmacy/scm_stockrequest.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['stockrequest2'])){$main="../pharmacy/scm_stockrequest2.php"; $sidebar="sidebar.php";}

elseif(isset($_GET['pricelist'])){$main="../main/pricelist.php"; $sidebar="sidebar.php";}
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
document.onreadystatechange = function(){
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
$mydept="HEART";
include "../verifymodule.php";
include "../main/footer.php";
?> 
</body>
</html>