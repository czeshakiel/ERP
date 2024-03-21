
<?php
include "../main/class.php";
if($_SESSION['verifyuser']!="verified"){echo"<script>window.location='../';</script>";}
// -------------------------------------->>>>> ISSET DISPLAY -------------------->>>>>>>
if(isset($_GET['main'])){$main="main.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['mypatient'])){$main="../nsstation/allpatient.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['detail'])){$main="../nsstation/detail.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['activepatients'])){$main="../nsstation/allpatient.php"; $sidebar="sidebar.php";}

elseif(isset($_GET['otherinfo'])){$main="../nsstation/cf4/otherinfo.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['part2'])){$main="../nsstation/cf4/part2.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['part3'])){$main="../nsstation/cf4/part3.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['finaldx'])){$main="../nsstation/finaldx.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['courseward'])){$main="../nsstation/cf4/courseward.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['diagnosisresult'])){$main="../nsstation/diagnosisresult.php"; $sidebar="sidebardetail.php";}

//ROD schedule------------------------------------------------------------------------------ >>>>>>
elseif(isset($_GET['rodsched'])){$main="../rodschedule/rodframe.php"; $sidebar="sidebar.php";}

elseif(isset($_GET['searchpt'])){$main="../doctorslog/patientlist.php"; $sidebar="sidebar.php";}
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
$mydept="DOC-OTHERS";
include "../verifymodule.php";

$_SESSION['homemeds']='';
include "../chargecart/cartmodal.php";
include "../nsstation/modal_class.php";
include "../main/footer.php";
?> 
</body>
</html> 