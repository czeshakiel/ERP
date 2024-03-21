<?php
ini_set("display_errors","On");
include("../../main/class.php");
session_start();

$st="BILLLING";
$nursename=base64_decode($_SESSION['nm']);
$userunique=base64_decode($_SESSION['un']);

$sqlHead=mysqli_query($conn,"SELECT * FROM heading");
$head=mysqli_fetch_array($sqlHead);
$heading=$head['ceo'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$heading;?></title>

    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../images/medmatrixlogo.jfif" type="img/png">

</head>

<body>


<?php
$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$patientidno=mysqli_real_escape_string($conn,$_GET['patientidno']);
$user=mysqli_real_escape_string($conn,$_GET['user']);

include('pfallocationhmo.php');
?>

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
            sort: false
        });
    });
    </script>
</body>
</html>
