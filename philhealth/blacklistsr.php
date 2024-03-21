<?php
ini_set("display_errors","On");
include("../main/connection.php");

$show=$_GET['show'];
$page=$_GET['page'];
$searchme=$_GET['searchme'];
$user=$_GET['user'];
$userunique=$_GET['userunique'];

echo "
<div align='center'>
";

$len=strlen($searchme);
if($len>1){
mysqli_query($conn,"SET NAMES 'utf8'");

echo "
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td><table border='0' width='100%' cellpadding='0' cellspacing='0' class='hoverTable'>
        <tr>
          <td class='t2 b2 l2' width='30'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>#</div></td>
          <td class='t2 b2 l1' width='100'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Patient ID No.</div></td>
          <td class='t2 b2 l1'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Patient Name</div></td>
          <td class='t2 b2 l1' width='110'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Birth Date</div></td>
          <td class='t2 b2 l1' width='130'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Out-Patient Entries</div></td>
          <td class='t2 b2 l1' width='130'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>In-Patient Entries</div></td>
          <td class='t2 b2 l1' width='110'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Date Set</div></td>
          <td class='t2 b2 l1'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>User</div></td>
          <td class='t2 b2 l1'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Remarks</div></td>
          <td class='t2 b2 l1 r2' width='70'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Action</div></td>
        </tr>
";

mysqli_query($conn,"SET NAMES 'utf8'");

$a=0;
$asql=mysqli_query($conn,"SELECT * FROM `patientblacklist` WHERE CONCAT(`ln`, ' ', `fn`, ' ', `mn`) LIKE '%$searchme%' ORDER BY `ln`, `fn`, `mn`, `sf`");
while($afetch=mysqli_fetch_array($asql)){
  $no=$afetch['no'];
  $patientidno=$afetch['patientidno'];
  $ln=trim($afetch['ln']);
  $fn=trim($afetch['fn']);
  $mn=trim($afetch['mn']);
  $sf=trim($afetch['sf']);
  $bd=$afetch['bd'];
  $ds=$afetch['dateset'];
  $ur=mb_strtoupper($afetch['user']);
  $rm=mb_strtoupper($afetch['remarks']);
  $a++;

  if($mn!=""){$mn=" ".$mn;}else{$mn="";}
  if($sf!=""){$sf=" ".$sf;}else{$sf="";}
  $pn=$ln.", ".$fn.$sf.$mn;

  $bsql=mysqli_query($conn,"SELECT * FROM `admission` WHERE `patientidno`='$patientidno' AND `caseno` LIKE 'O-%%'");
  $bcount=mysqli_num_rows($bsql);

  $csql=mysqli_query($conn,"SELECT * FROM `admission` WHERE `patientidno`='$patientidno' AND `caseno` LIKE 'I-%%'");
  $ccount=mysqli_num_rows($csql);

echo "
        <tr>
          <td class='b1 l2' height='30'><div align='left' class='arial s14 black' style='padding: 2px 5px;'>$a</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black' style='padding: 2px 3px;'>$patientidno</div></td>
          <td class='b1 l1'><div align='left' class='arial s14 black' style='padding: 2px 5px;'>$pn</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black' style='padding: 2px 5px;'>".date("M d, Y",strtotime($bd))."</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black' style='padding: 2px 5px;'>$bcount</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black' style='padding: 2px 5px;'>$ccount</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black' style='padding: 2px 5px;'>".date("M d, Y",strtotime($ds))."</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black' style='padding: 2px 5px;'>$ur</div></td>
          <td class='b1 l1'><div align='justify' class='arial s14 black' style='padding: 2px 5px;'>$rm</div></td>
          <td class='b1 l1 r2' valign='middle'><div align='center' class='arial s14 black btnstyle' style='padding: 2px 5px;'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><button type='button' class='btn cancel' title='Remove'"; ?> onclick="<?php echo "window.open('blacklistrm.php?no=$no&pn=".base64_encode($pn)."&user=".base64_encode($user)."', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=250,left=500,width=450,height=330');";?>" <?php echo "><i class='icofont-ui-delete fs-6'></i></button></td>
            </tr>
          </table></div></td>
        </tr>

";
}

echo "
        <tr>
          <td colspan='10' class='t2'></td>
        </tr>
      </table></td>
    </tr>
  </table>
";
}
else{
echo "
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td>
        <table border='0' width='100%' cellpadding='0' cellspacing='0'>
          <tr>
            <td><table border='0' width='100%' cellpadding='0' cellspacing='0' class='hoverTable'>
              <tr>
                <td class='t2 b2 l2' width='30'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>#</div></td>
                <td class='t2 b2 l1' width='100'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Patient ID No.</div></td>
                <td class='t2 b2 l1'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Patient Name</div></td>
                <td class='t2 b2 l1' width='110'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Birth Date</div></td>
                <td class='t2 b2 l1' width='130'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Out-Patient Entries</div></td>
                <td class='t2 b2 l1' width='130'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>In-Patient Entries</div></td>
                <td class='t2 b2 l1' width='110'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Date Set</div></td>
                <td class='t2 b2 l1'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>User</div></td>
                <td class='t2 b2 l1'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Remarks</div></td>
                <td class='t2 b2 l1 r2' width='70'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Action</div></td>
              </tr>
";

mysqli_query($conn,"SET NAMES 'utf8'");

$a=$page;
$asql=mysqli_query($conn,"SELECT * FROM `patientblacklist` ORDER BY `ln`, `fn`, `mn`, `sf` LIMIT $page,$show");
while($afetch=mysqli_fetch_array($asql)){
  $no=$afetch['no'];
  $patientidno=$afetch['patientidno'];
  $ln=trim($afetch['ln']);
  $fn=trim($afetch['fn']);
  $mn=trim($afetch['mn']);
  $sf=trim($afetch['sf']);
  $bd=$afetch['bd'];
  $ds=$afetch['dateset'];
  $ur=mb_strtoupper($afetch['user']);
  $rm=mb_strtoupper($afetch['remarks']);
  $a++;

  if($mn!=""){$mn=" ".$mn;}else{$mn="";}
  if($sf!=""){$sf=" ".$sf;}else{$sf="";}
  $pn=$ln.", ".$fn.$sf.$mn;

  $bsql=mysqli_query($conn,"SELECT * FROM `admission` WHERE `patientidno`='$patientidno' AND `caseno` LIKE 'O-%%'");
  $bcount=mysqli_num_rows($bsql);

  $csql=mysqli_query($conn,"SELECT * FROM `admission` WHERE `patientidno`='$patientidno' AND `caseno` LIKE 'I-%%'");
  $ccount=mysqli_num_rows($csql);

echo "
              <tr>
                <td class='b1 l2' height='30'><div align='left' class='arial s14 black' style='padding: 2px 5px;'>$a</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black' style='padding: 2px 3px;'>$patientidno</div></td>
                <td class='b1 l1'><div align='left' class='arial s14 black' style='padding: 2px 5px;'>$pn</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black' style='padding: 2px 5px;'>".date("M d, Y",strtotime($bd))."</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black' style='padding: 2px 5px;'>$bcount</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black' style='padding: 2px 5px;'>$ccount</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black' style='padding: 2px 5px;'>".date("M d, Y",strtotime($ds))."</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black' style='padding: 2px 5px;'>$ur</div></td>
                <td class='b1 l1'><div align='justify' class='arial s14 black' style='padding: 2px 5px;'>$rm</div></td>
                <td class='b1 l1 r2' valign='middle'><div align='center' class='arial s14 black btnstyle' style='padding: 2px 5px;'><table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td><button type='button' class='btn cancel' title='Remove'"; ?> onclick="<?php echo "window.open('blacklistrm.php?no=$no&pn=".base64_encode($pn)."&user=".base64_encode($user)."', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=250,left=500,width=450,height=330');";?>" <?php echo "><i class='icofont-ui-delete fs-6'></i></button></td>
                  </tr>
                </table></div></td>
              </tr>
";
}

echo "
              <tr>
                <td colspan='10' class='t2'></td>
              </tr>
            </table></td>
          </tr>
        </table>
      </div></td>
    </tr>
    <tr>
      <td height='5'></td>
    </tr>
    <tr>
      <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td>
";

$pagesql=mysqli_query($conn,"SELECT * FROM `patientblacklist`");
$pagecount=mysqli_num_rows($pagesql);

if($pagecount<=$show){
$pagenum=1;
$totalpage=1;
$prevpage=0;
$nxtpage=0;
}
else if($pagecount>$show){
$var1=$pagecount/$show;
$var1fmt=number_format($var1,0,'.',',');
$var1fmt=str_replace(",","",$var1fmt);
if($var1fmt>=$var1){
$var2=$var1fmt-1;
}
else{
$var2=$var1fmt;
}
if($var1==$var2){
$totalpage=$var2;
}
else{
$totalpage=$var2+1;
}

$pagenum=($page+$show)/$show;
$pagelimit=$var2*$show;

if($page=='0'){
$prevpage=0;
$nxtpage=$page+$show;
}
else if(($page!='0')&&($page!=$pagelimit)){
$prevpage=$page-$show;
$nxtpage=$page+$show;
}
else if($page==$pagelimit){
$prevpage=$page-$show;
$nxtpage=$page;
}
}

echo "
            <table width='100%' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                  <tr>
                    <td width='50%'><div align='left'><span class='arial s12 black bold'>Showing </span><span class='arial s13 blue'>".($page+1)." to ".($page+$show)." of $pagecount</span> | <span class='arial s12 black bold'>Page: </span><span class='arial s13 blue'>$pagenum of $totalpage</span></div></td>
                    <td width='50%'><div align='right'>
                      <table border='0' cellspacing='0' cellpadding='0'>
";

if($pagecount<=$show){
echo "
                        <tr>
                          <td>
                            <input name='Submit4' type='submit' class='button13' value='  &lt;   ' disabled />
                          </td>
                          <td width='2'></td>
                          <td><div align='center'>
                            <input type='text' name='pagest' value='".($pagenum)."' style='height: 28px;width: 50px;text-align: center;border: 1px solid blue;padding: 0;' disabled />
                          </div></td>
                          <td width='2'></td>
                          <td>
                            <input name='Submit5' type='submit' class='button13' value='  &gt;  ' disabled />
                          </td>
                        </tr>
";
}
else if($pagecount>$show){
if($page=='0'){
echo "
                        <tr>
                          <td>
                            <input name='Submit4' type='submit' class='button13' value='  &lt;   ' disabled />
                          </td>
                          <td width='2'></td>
                          <td><div align='center'><form name='ShortPage' method='post' action='../philhealth/?blk&show=$show".$datax."'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='text' name='pagest' value='".($pagenum)."' style='height: 28px;width: 50px;text-align: center;border: 1px solid blue;padding: 0;' autocomplete='off' /></td>
                              </tr>
                            </table>
                          </form></div></td>
                          <td width='2'></td>
                          <td>
                            <a href='../philhealth/?blk&show=$show&page=".($nxtpage)."".$datax."'><input name='Submit5' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &gt;  ' /></a>
                          </td>
                        </tr>
";
}
else if(($page!=0)&&($nxtpage!=$page)){
echo "
                        <tr>
                          <td>
                            <a href='../philhealth/?blk&show=$show&page=".($prevpage)."".$datax."'><input name='Submit4' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &lt;   ' /></a>
                          </td>
                          <td width='2'></td>
                          <td><div align='center'><form name='ShortPage' method='post' action='../philhealth/?blk&show=$show".$datax."'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='text' name='pagest' value='".($pagenum)."' style=height: 28px;width: 50px;text-align: center;border: 1px solid blue;padding: 0;' autocomplete='off' /></td>
                              </tr>
                            </table>
                          </form></div></td>
                          <td width='2'></td>
                          <td>
                            <a href='../philhealth/?blk&show=$show&page=".($nxtpage)."".$datax."'><input name='Submit5' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &gt;  ' /></a>
                          </td>
                        </tr>
";
}
else if($nxtpage==$page){
echo "
                        <tr>
                          <td>
                            <a href='../philhealth/?blk&show=$show&page=".($prevpage)."".$datax."'><input name='Submit4' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &lt;   ' /></a>
                          </td>
                          <td width='2'></td>
                          <td><div align='center'><form name='ShortPage' method='post' action='../philhealth/?blk&show=$show".$datax."'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='text' name='pagest' value='".($pagenum)."' style='height: 28px;width: 50px;text-align: center;border: 1px solid blue;padding: 0;' autocomplete='off' /></td>
                              </tr>
                            </table>
                          </form></div></td>
                          <td width='2'></td>
                          <td>
                            <input name='Submit5' type='submit' class='button13' value='  &gt;  ' disabled />
                          </td>
                        </tr>
";
}
}

echo "
                      </table>
                    </div></td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </td>
        </tr>
      </table></td>
    </tr>
  </table>
";
}

echo "
</div>
";
?>
