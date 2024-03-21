<?php
$outconnkmsci=mysqli_connect('192.168.0.200', 'kmsciec', 'levelwithme', 'kmsci');
if(!$outconnkmsci){echo"<script>alert('Unable to connect eClaims KMSCI DB');</script>";}

$searchme=mysqli_real_escape_string($outconnkmsci,$_GET['searchme']);
$caseno=mysqli_real_escape_string($outconnkmsci,$_GET["caseno"]);

echo "
<table id='tblCourseWard' class='table table-condensed table-bordered'>
  <tr>
    <th>DESCRIPTION</th>
    <th>&nbsp;</th>
  </tr>
";

$a=0;
$asql=mysqli_query($outconnkmsci,"SELECT * FROM `phicmedicine` WHERE `drugdesc` LIKE '%$searchme%'");
while($afetch=mysqli_fetch_array($asql)){
  $a++;
  $drugcode=$afetch['drugcode'];
  $drugdesc=$afetch['drugdesc'];
  $gencode=$afetch['gencode'];
  $saltcode=$afetch['saltcode'];
  $formcode=$afetch['formcode'];
  $strengthcode=$afetch['strengthcode'];
  $unitcode=$afetch['unitcode'];
  $packagecode=$afetch['packagecode'];

echo "
  <tr>
    <td><div align='left' class='arial16black'>$drugdesc</div></td>
    <td><a href='CF4Part5.php?caseno=$caseno&aa=$drugcode&bb=$gencode&cc=$saltcode&dd=$strengthcode&ee=$formcode&ff=$unitcode&gg=$packagecode' class='astyle'><input type='image' name='imageField' src='Resources/Button/Select-Out.png' id='ImageA$a' width='55' onmouseover=MM_swapImage('ImageA$a','','Resources/Button/Select-Over.png',1) onmouseout='MM_swapImgRestore()' /></a></td>
  </tr>
";
}

echo "
</table>
";
?>
