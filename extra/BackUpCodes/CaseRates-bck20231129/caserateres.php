<style type="text/css">
<!--
.t1 {border-top-width: 1px;border-top-color: #000000;border-top-style: solid;}
.b1 {border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;}
.l1 {border-left-width: 1px;border-left-color: #000000;border-left-style: solid;}
.r1 {border-right-width: 1px;border-right-color: #000000;border-right-style: solid;}

.t2 {border-top-width: 2px;border-top-color: #000000;border-top-style: solid;}
.b2 {border-bottom-width: 2px;border-bottom-color: #000000;border-bottom-style: solid;}
.l2 {border-left-width: 2px;border-left-color: #000000;border-left-style: solid;}
.r2 {border-right-width: 2px;border-right-color: #000000;border-right-style: solid;}

.s1 {font-family: Arial;font-weight: bold;font-size: 11px;}
.s2 {font-family: Arial;font-size: 16px;}
.s3 {font-family: Arial;font-weight: bold;font-size: 14px;color: #000000;}
.s4 {font-family: Arial;font-weight: bold;font-size: 13px;color: #000000;}
.s5 {font-family: Arial;font-size: 13px;color: #0B95F7;}

.red {color: #FF0000;}
.blue {color: #0B95F7;}

.s12 {font-size: 12px;}

.bgwhite {background-color: #FFFFFF;}

.borderwhite {border-color: #000000;border-width: 1px;}

.hoverTable{border-collapse:collapse;}
/*.hoverTable td{padding:0px; border:#4e95f4 1px solid;}*/

/* Define the default color for all the table rows */
/*.hoverTable tr{background: #b8d1f3;}*/

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}

.button1 {font-family: Arial;font-size: 14px;font-weight: bold;color: #FFFFFF;background-color: #00DA1D;border: 1px solid #00DA1D;height: 32px;}
.button2 {font-family: Arial;font-size: 14px;font-weight: bold;color: #FFFFFF;background-color: #00DA1D;border: 1px solid #00DA1D;}

.textfield1 {font-family: Arial;font-size: 16px;font-weight: bold;color: #000000;background-color: #ccff99;border: 1px solid #000000;height: 30px;width: 200px;}

.astyle {text-decoration: none;}

.btnstyle .btn {border: 1px solid #000000;width: 26px;height: 26px;border-radius: 8px;font-family: arial;font-size: 14px;font-weight: bold;text-align: center;padding: 0px 0px;}
.btnstyle .import {background-color: #4bf77c;color: #FFFFFF;}
.btnstyle .import:hover {opacity: 0.4;}
.btnstyle .add {background-color: #FFFFFF;color: #000000;}
.btnstyle .add:hover {opacity: 0.4;}
.btnstyle .view {background-color: #01d0da;color: #FFFFFF;}
.btnstyle .view:hover {opacity: 0.6;}
.btnstyle .dis {background-color: #b4b4b1;color: #e9e9e7;}
.btnstyle .btnadd {border: 1px solid #000000;width: 130px;height: 40px;border-radius: 3px;font-family: arial;font-size: 18px;font-weight: bold;text-align: center;padding: 0px 0px;background-color: #1D9FF4;color: #FFFFFF;}
.btnstyle .btnadd:hover {opacity: 0.4;}
-->
</style>

<?php
ini_set("display_errors","On");
include("../Settings.php");
$caseno=$_GET['caseno'];
$user=$_GET['user'];
$frm=$_GET['frm'];
$searchme=$_GET['searchme'];
$rvauto=$_GET['rvauto'];


if(($frm=="additional")||($frm=="con")){
  $statem="SELECT `icdcode`, `description`, `actualcaserate`, `hospital`, `pf`, `actualcaserate2`, `hospital2`, `pf2`, `actualcaserate3`, `hospital3`, `pf3`, `groupdiag`, `category`, `idno` FROM `caserates` WHERE `icdcode` LIKE '%$searchme%' AND (`category`='medical' OR `category`='additional') ORDER BY `icdcode`";
}
else{
  $statem="SELECT `icdcode`, `description`, `actualcaserate`, `hospital`, `pf`, `actualcaserate2`, `hospital2`, `pf2`, `actualcaserate3`, `hospital3`, `pf3`, `groupdiag`, `category`, `idno` FROM `caserates` WHERE `icdcode` LIKE '%$searchme%' AND (`category`='medical' OR `category`='surgical' OR `category`='additional') ORDER BY `icdcode`";
}

$len=strlen($searchme);
if($len>1){
$asql=mysqli_query($mycon1,$statem);
$acount=mysqli_num_rows($asql);

if($acount==0){
echo "
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' style='font-size: 32px;font-weigth: bold;font-family: arial;'><span style='color: #FF0000;'>No records found!!!</span><span style='color: #1D9FF4;'> Add </span><span style='color: #000000;'>&quot;</span><span style='color: #1D9FF4;'><u>".strtoupper($searchme)."</u></span><span style='color: #000000;'>&quot;</span> <span style='color: #1D9FF4;'>to list?</span></div></td>
    </tr>
    <tr>
      <td height='10'></td>
    </tr>
    <tr>
      <td><div align='center' class='btnstyle'><button type='button' class='btnadd' title='Add'"; ?> onclick="<?php echo "window.open('AddICDToListConf.php?user=$user&icdcode=$searchme', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=300');";?>" <?php echo ">Add Now?</button></div></td>
    </tr>
  </table>
</div>
";
}
else{
echo "
<div align='left'>
  <table border='0' width='100%' cellpadding='0' cellspacing='0' class='hoverTable'>
    <tr>
      <td class='t2 b2 l2' width='100' rowspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>ICD/RVS Code</div></td>
      <td class='t2 b1 l1' colspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Case Rate Amount</div></td>
      <td class='t2 b2 l1' width='auto' rowspan='2' colspan='3'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Description</div></td>
      <td class='t2 b2 l1' width='auto' rowspan='2' colspan='3'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Group Description</div></td>
      <td class='t2 b2 l1 r2' width='90' rowspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Action</div></td>
    </tr>
    <tr>
      <td class='b2 l1' width='100'><div align='center' style='font-family: courier;font-size: 12px;font-weight: bold;color: #000000;'>Primary</div></td>
      <td class='b2 l1' width='100'><div align='center' style='font-family: courier;font-size: 12px;font-weight: bold;color: #000000;'>Secondary</div></td>
    </tr>
";

while($afetch=mysqli_fetch_array($asql)){
$icdcode=$afetch['icdcode'];
$description=$afetch['description'];
$actualcaserate=$afetch['actualcaserate'];
$hospital=$afetch['hospital'];
$pf=$afetch['pf'];
$actualcaserate2=$afetch['actualcaserate2'];
$hospital2=$afetch['hospital2'];
$pf2=$afetch['pf2'];
$actualcaserate3=$afetch['actualcaserate3'];
$hospital3=$afetch['hospital3'];
$pf3=$afetch['pf3'];
$groupdiag=$afetch['groupdiag'];
$category=$afetch['category'];
$idno=$afetch['idno'];

if($category=="surgical"){
  $hei="430";
}
else{
  $hei="270";
}

echo "
    <tr>
      <td class='b1 l2' height='35'><div align='center' style='font-family: courier;font-size: 16px;color: #000000;'>&nbsp;$icdcode&nbsp;</div></td>
      <td class='b1 l1'><div align='right' style='font-family: courier;font-size: 14px;color: #000000;'>&nbsp;".number_format($actualcaserate,2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' style='font-family: courier;font-size: 14px;color: #000000;'>&nbsp;".number_format($actualcaserate2,2)."&nbsp;</div></td>
      <td width='3' class='b1 l1'></td>
      <td class='b1'><div align='left' style='font-family: courier;font-size: 13px;color: #000000;'>$description</div></td>
      <td width='3' class='b1'></td>
      <td width='3' class='b1 l1'></td>
      <td class='b1'><div align='left' style='font-family: courier;font-size: 13px;color: #000000;'>$groupdiag</div></td>
      <td width='3' class='b1'></td>
      <td class='b1 l1 r2'><div align='center' class='btnstyle'><button type='button' class='btn import' title='Add'"; ?> onclick="<?php echo "window.open('AddICDRVS.php?caseno=$caseno&user=$user&idno=$idno&frm=$frm&rvauto=$rvauto', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=$hei');";?>" <?php echo ">+</button></div></td>
    </tr>
";
}

echo "
    <tr>
      <td class='t1' colspan='10'></td>
    </tr>
  </table>
</div>
";
}
}
?>
