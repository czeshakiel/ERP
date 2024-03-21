<?php
error_reporting(1);
session_start();
require_once('config.php');
try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME."; charset=utf8mb4";
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Indexes for conditions
    createIndexIfNotExists($pdo, "productout", "productdesc", "idx_productdesc");
    createIndexIfNotExists($pdo, "productout", "productsubtype", "idx_productsubtype");
    createIndexIfNotExists($pdo, "admission", "ward", "idx_ward");
    createIndexIfNotExists($pdo, "productout", "terminalname", "idx_terminalname");
    createIndexIfNotExists($pdo, "productout", "datearray", "idx_datearray");
    createIndexIfNotExists($pdo, "productout", "status", "idx_status");
    createIndexIfNotExists($pdo, "productout", "status", "idx_status");
    createIndexIfNotExists($pdo, "admission", "caseno", "idx_caseno");
    createIndexIfNotExists($pdo, "productout", "invno", "idx_invno");
    createIndexIfNotExists($pdo, "admission", "patientidno", "idx_patientidno");
    createIndexIfNotExists($pdo, "patientprofile", "patientidno", "idx_patientprofile_patientidno");
    createIndexIfNotExists($pdo, "admission", "status", "idx_status");

} catch (PDOException $e) {
    die("Unable to connect to the database: " . $e->getMessage());
}

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if (strpos($url, "index.php") !== false) {
    $url = str_replace("index.php", "", $url);
    echo "<script>window.location='$url';</script>";
}

$ipadd = "";
$sql = $pdo->prepare("SELECT ipaddress FROM ipaddress");
$sql->execute();
$result = $sql->fetch(PDO::FETCH_ASSOC);
if ($result) {
    $ipadd = "http://" . $result['ipaddress'] . "/ERP/newborn/";
    $ip = $result['ipaddress'];
}

$myip = $_SERVER['REMOTE_ADDR'];
$sqlxx = "SELECT * FROM heading";
$resultxx = $pdo->query($sqlxx);
$rowxx = $resultxx->fetch(PDO::FETCH_ASSOC);
$heading = $rowxx['heading'];
$address = $rowxx['address'];
$telno = $rowxx['telno'];
$softwarename = $rowxx['designation'];

$sqlxxx = "SELECT * FROM mission";
$resultxxx = $pdo->query($sqlxxx);
$rowxxx = $resultxxx->fetch(PDO::FETCH_ASSOC);
$mission = $rowxxx['mission'];
$vision = $rowxxx['vision'];

$user = $_SESSION["username"];
$userunique = $_SESSION["userunique"];
$dept = strtoupper($_SESSION["dept"]);
$branch = $_SESSION["branch"];

$queryposition = $pdo->query("SELECT position FROM nsauthemployees WHERE `name` = '$user'");
$fthpst = $queryposition->fetch(PDO::FETCH_ASSOC);
$position = $fthpst['position'];
if(empty($position)) {$dspst = "Staff";}
else{$dspst = $position;}
$gender = $fthpst['gender'];

$view = $_GET['view'];
$modulex = $_GET["modulex"];
$mm = $_GET['mm'];
$dd = $_GET['dd'];
$yy = $_GET['yy'];
if (isset($_GET['nursename'])) {
    $user = $_GET['nursename'];
}
if (isset($_GET['st'])) {
    $dept = $_GET['st'];
}

function createIndexIfNotExists($pdo, $table, $columns, $indexName) {
    $query = "SHOW INDEX FROM $table WHERE Key_name = :indexName";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':indexName' => $indexName]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result || $result['Column_name'] !== $columns) {
        $createIndexQuery = "CREATE INDEX $indexName ON $table ($columns)";
        $pdo->query($createIndexQuery);
    }
}
?>