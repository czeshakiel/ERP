<?php
session_start();
include "meshes/alink.php";
include "includes/header.php";
if($_SESSION['verifyuser'] == "verified"){ $verifier = true;}
else{$verifier = false;}
include "includes/pages.php";
?>
<body>
<div id="mytask-layout" class="theme-indigo"> 
<?php include "includes/sidebar.php"; ?>
<!-- main body area -->
<div class="main px-lg-4 px-md-4">
    <?php include "includes/heading.php";?> 
    <div class="maindisplay"><?php include "$page"; ?></div>
</div>
</div>
<?php
include "pages/modals/session_expired_modal.php";
include "includes/footer.php"; 
?>
</body>
</html>