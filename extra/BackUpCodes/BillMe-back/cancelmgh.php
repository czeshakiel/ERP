<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Cancel MGH</title>
  <link rel="stylesheet" type="text/css" href="../../../Resources/CSS/mystyle.css">
  <!-- Favicon -->
    <link rel="icon" href="../../../rs/favicon/Logo.png" type="image/png" />
    <link rel="shortcut icon" href="../../../rs/favicon/Logo.png" type="image/png" />

    <style>
      * {box-sizing: border-box;}
      body {font-family: Roboto, Helvetica, sans-serif;background-color: #FFFFFF;}
      .open-btn {display: flex;justify-content: left;}
      .open-button {background-color: #1c87c9;color: white;padding: 12px 20px;border: none;border-radius: 5px;cursor: pointer;opacity: 0.8;position: fixed;}
      .form-container-up {max-width: 500px;padding: 15px;background-color: #FFFFFF;}
      .form-container-up input[type=text], .form-container-up input[type=password] {width: 250px;height: 50px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #83D9EE;border-radius: 10px;font-size: 16px;}
      .form-container-up input[type=text]:focus, .form-container-up input[type=file]:focus, .form-container-up select:focus {background-color: #039DC3;outline: none;}
      .form-container-up .btn {background-color: #8ebf42;color: #fff;width: 100px;height: 40px;border: none;cursor: pointer;opacity: 1;border-radius: 6px;}
      .form-container-up .cancel {background-color: #cc0000;}
      .form-container-up .btn:hover, .open-button:hover {opacity: 0.9;color: #000000;}
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
include('../Settings.php');
$cuz = new database();

session_start();

$ipec=$_SERVER['HTTP_HOST'];

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);

echo "
<div align='center' class='form-container-up'>
  <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td valign='middle'><div align='center'>
        <table border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td><div style='border: 3px solid black;border-radius: 5px;padding: 8px;background-color: rgba(250, 215, 160, 0.9);'>
";

if(!isset($_POST['cancelnow'])){
echo "
              <form method='post'>
                <table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td><div align='center' style='font-family: arial;font-size: 19px;font-weight: bold;'><u>CANCEL MAY GO HOME</u></div></td>
                  </tr>
                  <tr>
                    <td height='20'></td>
                  </tr>
                  <tr>
                    <td><input name='reason' type='text' value='' style='width: 400px;height: 100px;text-align: center;' placeholder='REASON TO CANCEL MGH' required autofocus /></td>
                  </tr>
                  <tr>
                    <td height='20'></td>
                  </tr>
                  <tr>
                    <td><input name='une' type='text' value='' style='width: 400px;text-align: center;' placeholder='Username' required /></td>
                  </tr>
                  <tr>
                    <td><input name='pws' type='password' value='' style='width: 400px;text-align: center;' placeholder='Password' required /></td>
                  </tr>
                  <tr>
                    <td height='10'></td>
                  </tr>
                  <tr>
                    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td width='50%'><div align='right' style='padding-right: 1px;'><button type='button' class='btn cancel' onclick='closeme()'>&nbsp;Close</button></div></td>
                        <td width='50%'><div align='left' style='padding-left: 1px;'><button name='cancelnow' type='submit' class='btn'>Cancel Now</button></div></td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
              <input type='hidden' name='caseno' value='$caseno' />
              </form>
";
}
else if(isset($_POST['cancelnow'])){
$caseno=mysqli_real_escape_string($conn,$_POST['caseno']);
$reason=mb_strtoupper(mysqli_real_escape_string($conn,$_POST['reason']));
$une=mysqli_real_escape_string($conn,$_POST['une']);
$pws=mysqli_real_escape_string($conn,$_POST['pws']);

$asql=mysqli_query($conn,"SELECT * FROM `nsauth` WHERE `password` LIKE '$pws' AND `username` LIKE '$une' AND `station` LIKE 'BILLING'");
$acount=mysqli_num_rows($asql);

if($acount==0){
echo "
              <table border='0' width='400' cellpadding='0' cellspacing='0'>
                <tr>
                  <td height='300' valign='middle'><div align='center' style='font-weight: bold;color: red;font-size: 18px;'>ERROR!!! USER NOT AUTHORIZED!!!<br />TRY AGAIN!!!</div></td>
                </tr>
              </table>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='4;URL=cancelmgh.php?caseno=$caseno'>";
}
else{
$afetch=mysqli_fetch_array($asql);
$nm=$afetch['name'];

$bsql=mysqli_query($conn,"SELECT p.`patientname` FROM `admission` a,`patientprofile` p WHERE a.`patientidno`=p.`patientidno` AND a.`caseno`='$caseno'");
$bfetch=mysqli_fetch_array($bsql);
$patname=$bfetch['patientname'];

echo "
              <table border='0' width='400' cellpadding='0' cellspacing='0'>
                <tr>
                  <td height='300' valign='middle'><div align='center' style='font-weight: bold;color: blue;font-size: 18px;'>CANCEL MGH SUCCESSFULL!!!</div></td>
                </tr>
              </table>
";

mysqli_query($conn,"UPDATE `admission` SET `status`='Active', `consult_id`=CONCAT(`consult_id`, '\nCancel mgh by: $nm') WHERE `caseno`='$caseno'");
mysqli_query($conn,"DELETE FROM `admitmgh` WHERE `caseno`='$caseno'");
mysqli_query($conn,"INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$caseno - $patname CANCEL MGH ($reason)', '$nm', CURDATE(), CURTIME())");

if(!is_dir("Logs/CancelMGH/$caseno")){
mkdir("Logs/CancelMGH/$caseno", 0777, true);
exec("chmod 777 Logs/CancelMGH/$caseno/");
}

$dt=date("YmdHis");
$decf = fopen("Logs/CancelMGH/$caseno/$une-$dt.txt", "w") or die("Unable to open file!");
fwrite($decf, "$une $nm ".date("Y-m-d H:i:s")."");
fclose($decf);

echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=Close.php'>";
}
}

echo "
            </div></td>
          </tr>
        </table>
      </div></td>
    </tr>
  </table>
</div>
";

//echo "<META HTTP-EQUIV='Refresh'CONTENT='360;URL=Close.php'>";

?>

<script>
  function closeme() {
    window.close();
  }
</script>

</body>
</html>
