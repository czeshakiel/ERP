<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PRICE INQUIRY</title>
<link rel='icon' href='../Resources/Favicon/Cart.png' type='image/png' />
<link rel='shortcut icon' href='../Resources/Favicon/Cart.png' type='image/png' />
<link href="../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript">
<!--
//-->
</script>
<style>
  .tabsel{background-color: #FFFFFF;padding: 10px 0;color: #FF5733;font-family: arial;font-weight: bold;font-size: 14px;cursor: pointerborder-bottom: 2px solid #FFFFFF;border-top: 2px solid #000000;border-left: 2px solid #000000;border-right: 2px solid #000000;border-radius: 8px 8px 0 0;}
  .tabsel:hover{color: #000000;}
  .tabuns{background-color: #FF5733;padding: 10px 0;color: #FFFFFF;font-family: arial;font-weight: bold;font-size: 14px;cursor: pointer;border-bottom: 2px solid #000000;border-top: 2px solid #FF0000;border-left: 2px solid #FF0000;border-right: 2px solid #FF0000;border-radius: 8px 8px 0 0;}
  .tabuns:hover{color: #000000;}
  .adsel{background-color: #5DADE2;color: #000000;font-family: arial;font-weight: bold;font-size: 12px;padding: 2px 5px;}
  .adsel:hover{background-color: #2874A6;color: #FFFFFF;}
  .aduns{background-color: #FFFFFF;color: #000000;font-family: arial;font-weight: bold;font-size: 12px;padding: 2px 5px;}
  .aduns:hover{background-color: #5DADE2;color: #000000;}
  .searchme{background-color: #FFFFFF;}
  .searchme:focus{background-color: #DEF7FB;}
  .sch{width: 50px;height: 38px;font-size: 16px;font-weight: bold;background-color: #7CC7FB;color: #000000;border: 2px solid #000000;border-radius: 5px;padding: 3px 0;}
  .sch:hover{background-color: #21699B;color: #FFFFFF;}
  .dpt{width: 50px;height: 30px;font-size: 16px;font-weight: bold;background-color: #7CC7FB;color: #000000;border: 2px solid #000000;border-radius: 5px;padding: 3px 0;}
  .dpt:hover{background-color: #21699B;color: #FFFFFF;}
  .btn{width: 50px;font-size: 11px;font-weight: bold;background-color: #7FF59A;color: #000000;border: 1px solid #000000;border-radius: 3px;padding: 3px 0;}
  .btn:hover{background-color: #5EB071;color: #FFFFFF;}
  .btndis{width: 50px;font-size: 11px;font-weight: bold;background-color: #DBDBDB ;color: #000000;border: 1px solid #000000;border-radius: 3px;padding: 3px 0;}
  .prt{width: 50px;height: 30px;font-size: 16px;font-weight: bold;background-color: #7CC7FB;color: #000000;border: 2px solid #000000;border-radius: 5px;padding: 3px 0;}
  .prt:hover{background-color: #21699B;color: #FFFFFF;}
  .bck{font-size: 11px;font-weight: bold;background-color: #B07CFB;color: #000000;border: 1px solid #000000;border-radius: 3px;padding: 3px 10px;}
  .bck:hover{background-color: #6B4D95;color: #FFFFFF;}
  .inp{border: 2px solid #000000;border-radius: 5px;height: 25px;width: 250px;font-family: arial;font-size: 12px;font-weight: bold;padding: 2px 5px;}
  .inp:hover{background-color: #DAF7A6;}
  .inp:focus{background-color: #DAF7A6;}
</style>
</head>
<?php
ini_set("display_errors","On");
include("../../main/connection.php");

$up=0;
if(isset($_GET['xox'])){
  $user=mysqli_real_escape_string($conn,$_GET['xox']);
  $usr="&xox=".$user;

  $zasql=mysqli_query($conn,"SELECT * FROM `nsauth` WHERE `station`='Masterfile' AND `username`='".base64_decode($user)."'");
  if(mysqli_num_rows($zasql)>0){$up=1;}
}
else{
  $usr="";
}

echo "
<div align='left' style='padding: 5px;'>
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td class='b2' style='padding-bottom: 10px;'><div align='left' style='font-family: arial;fonmt-size: 18px;font-weight: bold;color: #334FFF;'>PRICE INQUIRY</div></td>
    </tr>
";


if(isset($_GET['meds'])){
  include("meds.php");
}
else if(isset($_GET['supplies'])){
  include("supp.php");
}
else if(isset($_GET['services'])){
  include("serv.php");
}
else if(isset($_GET['others'])){
  include("othe.php");
}
else{
echo "
    <tr>
      <td style='padding-top: 5px;'><div align='left'>
        <table border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td><div align='left' style='font-family: arial;font-size: 16px;font-weight: bold;color: #FF5733;padding: 5px 5px;'>&#9755;</div></td>
            <td><a href='?meds$usr' style='text-decoration: none;'><div align='left' style='font-family: arial;font-size: 16px;font-weight: bold;color: #229954;padding: 5px 5px;'>MEDICINES</div></a></td>
          </tr>
          <tr>
            <td><div align='left' style='font-family: arial;font-size: 16px;font-weight: bold;color: #FF5733;padding: 5px 5px;'>&#9755;</div></td>
            <td><a href='?supplies$usr' style='text-decoration: none;'><div align='left' style='font-family: arial;font-size: 16px;font-weight: bold;color: #D4AC0D;padding: 5px 5px;'>SUPPLIES</div><a/></td>
          </tr>
          <tr>
            <td><div align='left' style='font-family: arial;font-size: 16px;font-weight: bold;color: #FF5733;padding: 5px 5px;'>&#9755;</div></td>
            <td><a href='?services&$usr' style='text-decoration: none;'><div align='left' style='font-family: arial;font-size: 16px;font-weight: bold;color: #7D3C98;padding: 5px 5px;'>SERVICES</div><a/></td>
          </tr>
          <tr>
            <td><div align='left' style='font-family: arial;font-size: 16px;font-weight: bold;color: #FF5733;padding: 5px 5px;'>&#9755;</div></td>
            <td><a href='?others$usr' style='text-decoration: none;'><div align='left' style='font-family: arial;font-size: 16px;font-weight: bold;color: #34495E;padding: 5px 5px;'>OTHER CHARGES</div><a/></td>
          </tr>
        </table>
      </div></td>
    </tr>
";
}

echo "
  </table>
</div>
";
?>
</body>
</html>
