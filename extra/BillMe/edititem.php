<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Edit Item</title>
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
      .form-container-Edit input[type=text], .form-container-Edit input[type=password] {
      width: 250px;
      height: 40px;
      padding: 7px;
      margin: 5px 0 5px 0;
      border: none;
      background: #eee;
      border-radius: 10px;
      font-size: 16px;
      }
            /* Full-width for input fields */
      .form-container-Edit select {
      height: 40px;
      padding: 7px;
      margin: 5px 0 5px 0;
      border: none;
      background: #eee;
      border-radius: 10px;
      font-size: 16px;
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
      border-radius: 10px;
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
    <script type="text/javascript">
        function change_url(val) {
            window.location=val;
        }
    </script>
  </head>
<body>
<?php
ini_set("display_errors", "On");
include("../../main/class.php");
$cuz = new database();

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$refno=mysqli_real_escape_string($conn,$_GET['refno']);
$user=mysqli_real_escape_string($conn,$_GET['user']);

$asql=mysqli_query($conn,"SELECT * FROM `productout` WHERE `refno`='$refno'");
$afetch=mysqli_fetch_array($asql);
$code=$afetch['productcode'];
$desc=$afetch['productdesc'];
$sp=$afetch['sellingprice'];
$qt=$afetch['quantity'];
$ad=$afetch['adjustment'];
$gr=$afetch['gross'];
$p1=$afetch['phic'];
$p2=$afetch['phic1'];
$hm=$afetch['hmo'];
$ex=$afetch['excess'];
$pe=$afetch['producttype'];
$pt=$afetch['productsubtype'];
$cd=$afetch['productcode'];
$st=$afetch['terminalname'];
$rm=$afetch['remarks'];

$descdisp=str_replace("ams-","",$desc);
$descdisp=str_replace("-sup","",$descdisp);
$descdisp=str_replace("-med","",$descdisp);

$pnf="off";

if(($pt=="PHARMACY/SUPPLIES")||($pt=="PHARMACY/MEDICINE")||($pt=="MEDICAL SURGICAL SUPPLIES")){
  $lock="style='background-color: #acc7f8;' readonly";

  $kpnfsql=mysqli_query($conn,"SELECT `pnf` FROM `receiving` WHERE `code`='$code'");
  $kpnfcount=mysqli_num_rows($kpnfsql);
  if($kpnfcount>0){
    $kpnffetch=mysqli_fetch_array($kpnfsql);
    $kpnf=$kpnffetch['pnf'];
    if($kpnf=="PNDF"){
      $lockphic1="";
      $lockphic2="";
    }
    else if(($kpnf=="NPNDF")||($kpnf=="NON-PNDF")){
      $lockphic1="style='background-color: #acc7f8;' readonly";
      $lockphic2="style='background-color: #acc7f8;' readonly";
      $pnf="on";
    }
    else{
      $lockphic1="";
      $lockphic2="";
    }
  }
}
else{
  $lock="";
  $lockphic1="";
  $lockphic2="";
}

$net=$sp*$qt;

echo "
<div align='center'>
  <form name='Save' method='post' action='edititemsave.php' class='form-container-Edit'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td colspan='3'><div align='center' class='arial s20 blue bold'>Edit Item</div></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
";


if($pt=="PROFESSIONAL FEE"){
echo "
      <tr>
        <td><div align='left' class='s14'>Doctor</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='productdesc' style='width: 250px;'>
            <option selected='selected'>$desc</option>
            <option >MARY ANN A. JOSUE, RTRP</option>
            <option >KRIZIAH LOU R. EMBODO, RTRP</option>
            <option >JURELL DAVE N. OGADO, RTRP</option>
";

$bsql=mysqli_query($conn,"SELECT `name` FROM `docfile` ORDER BY `name`");
while($bfetch=mysqli_fetch_array($bsql)){
$pname=$bfetch['name'];

echo "
            <option value='$pname'>".strtoupper($pname)."</option>
";
}

echo "
          </select>
        </td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Doctor</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='producttype' style='width: 250px;'>
            <option value='$pe' selected='selected'>$pe</option>
            <option value'IPD attending'>IPD attending</option>
            <option value'IPD comanaged'>IPD comanaged</option>
            <!--option value'IPD admitting'>IPD admitting</option>
            <option value'IPD discharge'>IPD discharge</option-->
            <option value'IPD discharge'>IPD surgeon</option>
            <option value'IPD discharge'>IPD co-surgeon</option>
            <option value'IPD discharge'>IPD anesthesiologist</option>
            <option value'IPD discharge'>IPD co-anesthesiologist</option>
            <!--option value'IPD discharge'>IPD pfexcess</option>
            <option value'IPD discharge'>APPF Others</option>
            <option value'IPD discharge'>APPF Com</option-->
            <!--option value='caserate'>caserate</option>
            <option value='IPDconsultation'>IPDconsultation</option>
            <option value='med'>Medicine</option>
            <option value='sup'>supplies</option>
            <option value='ordr'>ordr</option>
            <option value='Room'>Room</option-->
            <option value'ON CALL'>ON CALL</option>
";

$csql=mysqli_query($conn,"SELECT DISTINC(proc) AS proc FROM PF_SHARING WHERE tag NOT LIKE '%NONE%' ORDER BY proc ASC");
while($cfetch=mysqli_fetch_array($csql)){
$proc=$bfetch['proc'];

echo "
            <option value='$roc'>".strtoupper($proc)."</option>
";
}

echo "
          </select>
        </td>
      </tr>
";
}
else{
echo "
      <tr>
        <td><div align='left' class='s14'>Description</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Description' value='$descdisp' autocomplete='off' style='background-color: #acc7f8;' readonly /></td>
      </tr>
";
}

if(($code=="11334620210406")||($code=="210505100721p-50")){
echo "
      <tr>
        <td><div align='left' class='s14'>Remarks</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' name='remarks' placeholder='Remarks' value='$rm' autocomplete='off' style='background-color: #acc7f8;' /></td>
      </tr>
";
}
else{
echo "
      <input type='hidden' name='remarks' value='$rm' />
";
}

echo "
      <tr>
        <td><div align='left' class='s14'>Selling Price</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Selling Price' name='sellingprice' value='$sp' autocomplete='off' required $lock /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Quantity</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Quantity' name='quantity' value='$qt' autocomplete='off' required $lock /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Discount</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Discount' name='adjustment' value='$ad' autocomplete='off' required /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Net</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Middle Name' value='$gr' autocomplete='off' style='background-color: #acc7f8;' readonly /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>PHIC 1</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Case Rate 1' name='phic' value='$p1' autocomplete='off' required $lockphic1 /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>PHIC 2</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Case Rate 2' name='phic1' value='$p2' autocomplete='off' required $lockphic2 /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>HMO</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='HMO' name='hmo' value='$hm' autocomplete='off' required /></td>
      </tr>
";

if((($pt=="ECG")||(($cd=="110002612n-3")||($cd=="10007083p-3")))&&(($st=="pending")||($st=="Testtobedone"))){

  if($st=="pending"){
    $stdisp="Pending";
  }
  else if($st=="Testtobedone"){
    $stdisp="Test to be done";
  }
  else{
    $stdisp=$st;
  }

echo "
      <tr>
        <td><div align='left' class='s14'>Status</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='terminalname' style='width: 250px;'>
            <option value='$st' selected='selected'>$stdisp</option>
            <option value='pending'>Pending</option>
            <option value='Testtobedone'>Test to be done</option>
          </select>
        </td>
      </tr>
";
}
else{
echo "
      <input type='hidden' name='terminalname' value='$st' />
";
}
echo "
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td colspan='3'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td width='49%'><div align='right'><button type='button' class='btn cancel' onclick='closeme()'>Close</button></div></td>
            <td width='2%'></td>
            <td width='49%'><div align='left'><button type='submit' class='btn'>Save</button></div></td>
          </tr>
        </table></td>
      </tr>
    </table>
  <input type='hidden' name='caseno' value='$caseno' />
  <input type='hidden' name='refno' value='$refno' />
  <input type='hidden' name='productsubtype' value='$pt' />
  <input type='hidden' name='user' value='$user' />
";

if($pnf=="on"){
echo "
  <input type='hidden' name='pnf' value='' />
";
}

echo "
  </form>
</div>
";

?>

<script>
  function closeme() {
    window.close();
  }
</script>

</body>
</html>
