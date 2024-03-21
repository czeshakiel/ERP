<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Removing...</title>
  <link rel="stylesheet" type="text/css" href="../Resources/CSS/mystyle.css">
  <!-- Favicon -->
    <link rel="icon" href="../Resources/Favicon/logo.png" type="image/png" />
    <link rel="shortcut icon" href="../Resources/Favicon/logo.png" type="image/png" />

    <style>
      * {
      box-sizing: border-box;
      }
      body {
      font-family: Roboto, Helvetica, sans-serif;
      background-color: #E8E4C9;
      }
      /* Fix the button on the left side of the page */
      .open-btn {
      display: flex;
      justify-content: left;
      }
      /* Style and fix the button on the page */
      .open-button {
      background-color: #1c87c9;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      opacity: 0.8;
      position: fixed;
      }
      /* Styles for the form container */
      .form-container-Edit {
      max-width: 500px;
      padding: 15px;
      background-color: #E8E4C9;
      }
      /* Full-width for input fields */
      .form-container-Edit input[type=text], .form-container-Edit input[type=password], .form-container-Edit select {
      width: 250px;
      height: 40px;
      padding: 7px;
      margin: 5px 0 5px 0;
      border: none;
      background: #eee;
      }
      /* Select fields */
      .form-container-Edit select {
      padding: 10px;
      margin: 5px 0 10px 0;
      border: none;
      background: #eee;
      }
      /* When the inputs get focus, do something */
      .form-container-Edit input[type=text]:focus, .form-container-Edit input[type=password]:focus, .form-container-Edit select:focus {
      background-color: #ddd;
      outline: none;
      }
      /* Style submit/login button */
      .form-container-Edit .btn {
      background-color: #8ebf42;
      color: #fff;
      padding: 12px 20px;
      border: none;
      cursor: pointer;
      margin-bottom:10px;
      opacity: 0.8;
      }
      /* Style cancel button */
      .form-container-Edit .cancel {
      background-color: #cc0000;
      }
      /* Hover effects for buttons */
      .form-container-Edit .btn:hover, .open-button:hover {
      opacity: 1;
      }
    </style>
  </head>
<body>
<?php
ini_set("display_errors", "On");
include("../../main/class.php");
$cuz = new database();

$caseno=mysqli_real_escape_string($conn,$_POST['caseno']);
$refno=mysqli_real_escape_string($conn,$_POST['refno']);
$user=mysqli_real_escape_string($conn,$_POST['user']);

$zsql=mysqli_query($conn,"SELECT `productcode`, `batchno`, `terminalname`, `productcode`, `quantity`, `productsubtype`, `approvalno` FROM `productout` WHERE `refno`='$refno'");
$zfetch=mysqli_fetch_array($zsql);
$zproductcode=$zfetch['productcode'];
$zbatchno=$zfetch['batchno'];
$zterminalname=$zfetch['terminalname'];
$zproductcode=$zfetch['productcode'];
$zquantity=$zfetch['quantity'];
$zproductsubtype=$zfetch['productsubtype'];
$app=$zfetch['approvalno'];

$miscsql=mysqli_query($conn,"SELECT `SEMIPRIVATE` FROM `receiving` WHERE `code`='$zproductcode' AND `PRIVATE`='misc'");
$misccount=mysqli_num_rows($miscsql);

$miscaddsql=mysqli_query($conn,"SELECT `code` FROM `receiving` WHERE `SEMIPRIVATE`='$zproductcode' AND `PRIVATE`='misc'");
$miscaddcount=mysqli_num_rows($miscaddsql);

$zsp=preg_split("/\-/",$zbatchno);


if(!is_dir("Logs/Delete/$caseno")){
mkdir("Logs/Delete/$caseno", 0777, true);
exec("chmod 777 Logs/Delete/$caseno/");
}

$pdate=date("YmdHis");

mysqli_query($conn,"SELECT * FROM productout WHERE refno='$refno' INTO OUTFILE '/opt/lampp/htdocs/2021codes/BillMe/Logs/Delete/$caseno/$refno-$user-$pdate.txt' FIELDS TERMINATED BY '|'");


echo "
<div align='center'>
    <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='center' class='arial s18 blue bold'>Item deleted...</div></td>
      </tr>
    </table>
</div>
";

if($zsp[0]=="RDU"){
$ysql=mysqli_query($conn,"SELECT * FROM `stocktable` WHERE `rrno`='$zterminalname' AND `suppliercode`='$caseno' AND `code`='$zproductcode' AND `trantype`='dispensed'");
$ycount=mysqli_num_rows($ysql);
$yfetch=mysqli_fetch_array($ysql);

$date=$yfetch['date'];
$rrno=$yfetch['rrno'];
$po=$yfetch['po'];
$invno=$yfetch['invno'];
$suppliercode=$yfetch['suppliercode'];
$suppliername=$yfetch['suppliername'];
$code=$yfetch['code'];
$description=$yfetch['description'];
$unitcost=$yfetch['unitcost'];
$quantity=$yfetch['quantity'];
$recdqty=$yfetch['recdqty'];
$generic=$yfetch['generic'];
$statquantity=$yfetch['statquantity'];
$expiration=$yfetch['expiration'];
$lotno=$yfetch['lotno'];
$trantype="return";
$terms=$yfetch['terms'];
$transdate=date("M-d-Y");
$dept=$yfetch['dept'];
$prodtype1=$yfetch['prodtype1'];
$paymentstatus=$yfetch['paymentstatus'];
$isid=$yfetch['isid'];
$receivinguser=$yfetch['receivinguser'];
$prevqty=$yfetch['prevqty'];
$stockalert=$yfetch['stockalert'];
$duedate=$yfetch['duedate'];
$datearray=date("Y-m-d");

$xsql=mysqli_query($conn,"SELECT `name` FROM `nsauth` WHERE `username`='$user'");
$xfetch=mysqli_fetch_array($xsql);
$uname=$xfetch['name'];

mysqli_query($conn,"INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('$date', '$rrno', '$po', '$invno', '$suppliercode', '$suppliername', '$code', '$description', '$unitcost', '$zquantity', '$zquantity', '$generic', '$statquantity', '$expiration', '$lotno', '$trantype', '$terms', '$transdate', '$dept', '$prodtype1', '$paymentstatus', '$isid', '$uname', '$zquantity', '$stockalert', '$duedate', '$datearray')");
}

if($misccount!=0){
  $miscfetch=mysqli_fetch_array($miscsql);
  $misccd=$miscfetch['SEMIPRIVATE'];
  mysqli_query($conn,"SELECT * FROM productout WHERE productcode='$misccd' AND approvalno='PA-$refno' INTO OUTFILE '/opt/lampp/htdocs/2021codes/BillMe/Logs/Delete/$caseno/MISC-$refno-$user-$pdate.txt' FIELDS TERMINATED BY '|'");
  mysqli_query($conn,"DELETE FROM productout WHERE productcode='$misccd' AND approvalno='PA-$refno'");
}

if($miscaddcount!=0){
  $miscaddfetch=mysqli_fetch_array($miscaddsql);
  $miscaddcd=$miscaddfetch['code'];

  $apps=preg_split("/\-/",$app);
  $appref=$apps[1];

  mysqli_query($conn,"SELECT * FROM productout WHERE productcode='$miscaddcd' AND refno='$appref' INTO OUTFILE '/opt/lampp/htdocs/2021codes/BillMe/Logs/Delete/$caseno/MISCI-$refno-$user-$pdate.txt' FIELDS TERMINATED BY '|'");
  mysqli_query($conn,"DELETE FROM productout WHERE productcode='$miscaddcd' AND refno='$appref'");
  mysqli_query($conn,"DELETE FROM labpending WHERE refno='$appref'");
}

mysqli_query($conn,"DELETE FROM `productout` WHERE `refno`='$refno'");

if($zproductsubtype=="LABORATORY"){
  mysqli_query($conn,"DELETE FROM `labpending` WHERE `refno`='$refno'");
}


echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=Close.php'>";

?>

</body>
</html>
