
<?php
include "../main/class.php";

// -------------------------------------->>>>> ISSET DISPLAY -------------------->>>>>>>
if(isset($_GET['main'])){$main="main.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['totalinpatient'])){$main="z_totalinpatient.php"; $sidebar="sidebar.php";}
else{$main="main.php"; $sidebar="sidebar.php";}
// ------------------------------------------------------------------------------ >>>>>>


include "../main/header.php"; 
?>
<body>
<div id="mytask-layout" class="theme-indigo"> 
<?php include "../main/$sidebar"; ?>  

<!-- main body area -->
<div class="main px-lg-4 px-md-4">
<?php include "../main/headingmain.php"; ?> 
<?php include "../main/$main"; ?> 
</div>
</div>

<?php include "../main/footer.php"; ?> 
</body>
</html> 