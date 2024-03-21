<?php
ini_set("display_errors","On");
include("../main/connection.php");

$show=$_GET['show'];
$page=$_GET['page'];
$searchme=$_GET['searchme'];
$user=$_GET['user'];
$userunique=$_GET['userunique'];

$ip="192.168.0.100:100";

echo "
<style>
  .h2 {
    font-size: 30px;
    font-family: Arial;
    font-weight: bold;
    animation: animate 1.5s linear infinite;
  }

  @keyframes animate {
    0% {
      opacity: 0;
    }

    50% {
      opacity: 0.7;
    }

    100% {
      opacity: 0;
    }
  }

  .warn30over {
    -webkit-animation: warn30over 1s infinite;  /* Safari 4+ */
    -moz-animation: warn30over 1s infinite;  /* Fx 5+ */
    -o-animation: warn30over 1s infinite;  /* Opera 12+ */
    animation: warn30over 1s infinite;  /* IE 10+, Fx 29+ */
  }

  @-webkit-keyframes warn30over {
    0%, 49% {
      background-color: #b8d1f3;
      color: #000000;
      height: 100%;
    }
    50%, 100% {
      background-color: #F54432;
      color: #FFFFFF;
      height: 100%;
    }
  }

  .warn5days {
    -webkit-animation: warn5days 1s infinite;  /* Safari 4+ */
    -moz-animation: warn5days 1s infinite;  /* Fx 5+ */
    -o-animation: warn5days 1s infinite;  /* Opera 12+ */
    animation: warn5days 1s infinite;  /* IE 10+, Fx 29+ */
  }

  @-webkit-keyframes warn5days {
    0%, 49% {
      background-color: #b8d1f3;
      color: #000000;
      height: 100%;
    }
    50%, 100% {
      background-color: #931003;
      color: #FFFFFF;
      height: 100%;
    }
  }

  .warnover {
    -webkit-animation: warnover 1s infinite;  /* Safari 4+ */
    -moz-animation: warnover 1s infinite;  /* Fx 5+ */
    -o-animation: warnover 1s infinite;  /* Opera 12+ */
    animation: warnover 1s infinite;  /* IE 10+, Fx 29+ */
  }

  @-webkit-keyframes warnover {
    0%, 49% {
      background-color: #b8d1f3;
      color: #000000;
      height: 100%;
    }
    50%, 100% {
      background-color: #370601;
      color: #FFFFFF;
      height: 100%;
    }
  }
</style>
";

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
          <td class='t2 b2 l1' width='130'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Status</div></td>
          <td class='t2 b2 l1 r2' width='70'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Action</div></td>
        </tr>
";

mysqli_query($conn,"SET NAMES 'utf8'");

$a=0;
$asql=mysqli_query($conn,"SELECT * FROM `patientprofile` WHERE CONCAT(`lastname`, ' ', `firstname`, ' ', `middlename`) LIKE '%$searchme%' ORDER BY `lastname`, `firstname`, `middlename`, `suffix`");
while($afetch=mysqli_fetch_array($asql)){
  $patientidno=$afetch['patientidno'];
  $ln=trim($afetch['lastname']);
  $fn=trim($afetch['firstname']);
  $mn=trim($afetch['middlename']);
  $mnrel=$mn;
  $sf=trim($afetch['suffix']);
  $sfrel=$sf;
  $bd=$afetch['dateofbirth'];
  $a++;

  if($mn!=""){$mn=" ".$mn;}else{$mn="";}
  if($sf!=""){$sf=" ".$sf;}else{$sf="";}
  $pn=$ln.", ".$fn.$sf.$mn;

  $bsql=mysqli_query($conn,"SELECT * FROM `admission` WHERE `patientidno`='$patientidno' AND `caseno` LIKE 'O-%%'");
  $bcount=mysqli_num_rows($bsql);

  $csql=mysqli_query($conn,"SELECT * FROM `admission` WHERE `patientidno`='$patientidno' AND `caseno` LIKE 'I-%%'");
  $ccount=mysqli_num_rows($csql);

  $dsql=mysqli_query($conn,"SELECT * FROM `patientblacklist` WHERE `ln` LIKE '$ln' AND `fn` LIKE '$fn' AND `mn` LIKE '$mnrel' AND `sf` LIKE '$sfrel'");
  $dcount=mysqli_num_rows($dsql);

  $st="";
  $btn="";
  $btnc="btn add";
  $rbg="";
  $rtc="";
  if($dcount>0){
    $st="Black Listed";
    $btn="disabled";
    $btnc="dis";
    $rbg="style='background-color: #FF0000;'";
    $rtc="color: #FFFFFF;";
  }

echo "
        <tr>
          <td class='b1 l2' height='30' $rbg><div align='left' class='arial s14 black' style='padding: 2px 5px;$rtc'>$a</div></td>
          <td class='b1 l1' $rbg><div align='center' class='arial s14 black' style='padding: 2px 3px;$rtc'>$patientidno</div></td>
          <td class='b1 l1' $rbg><div align='left' class='arial s14 black' style='padding: 2px 5px;$rtc'>$pn</div></td>
          <td class='b1 l1' $rbg><div align='center' class='arial s14 black' style='padding: 2px 5px;$rtc'>".date("M d, Y",strtotime($bd))."</div></td>
          <td class='b1 l1' $rbg><div align='center' class='arial s14 black' style='padding: 2px 5px;$rtc'>$bcount</div></td>
          <td class='b1 l1' $rbg><div align='center' class='arial s14 black' style='padding: 2px 5px;$rtc'>$ccount</div></td>
          <td class='b1 l1' $rbg><div align='center' class='arial s14 black' style='padding: 2px 5px;$rtc'>$st</div></td>
          <td class='b1 l1 r2' valign='middle' $rbg><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td $rbg><button type='button' class='$btnc' title='Add to Black List' $btn "; ?> onclick="<?php echo "window.open('blacklisted.php?patientidno=$patientidno&user=".base64_encode($user)."', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=250,left=500,width=450,height=330');";?>" <?php echo "><i class='icofont-ui-add fs-9'></i></button></td>
            </tr>
          </table></div></td>
        </tr>

";
}

echo "
        <tr>
          <td colspan='8' class='t2'></td>
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
                <td class='t2 b2 l1' width='130'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Status</div></td>
                <td class='t2 b2 l1 r2' width='70'><div align='center' class='arial s12 black bold' style='padding: 3px 3px;'>Action</div></td>
              </tr>
";

mysqli_query($conn,"SET NAMES 'utf8'");

$a=$page;
$asql=mysqli_query($conn,"SELECT * FROM `patientprofile` ORDER BY `lastname`, `firstname`, `middlename`, `suffix` LIMIT $page,$show");
while($afetch=mysqli_fetch_array($asql)){
  $patientidno=$afetch['patientidno'];
  $ln=trim($afetch['lastname']);
  $fn=trim($afetch['firstname']);
  $mn=trim($afetch['middlename']);
  $mnrel=$mn;
  $sf=trim($afetch['suffix']);
  $sfrel=$sf;
  $bd=$afetch['dateofbirth'];
  $a++;

  if($mn!=""){$mn=" ".$mn;}else{$mn="";}
  if($sf!=""){$sf=" ".$sf;}else{$sf="";}
  $pn=$ln.", ".$fn.$sf.$mn;

  $bsql=mysqli_query($conn,"SELECT * FROM `admission` WHERE `patientidno`='$patientidno' AND `caseno` LIKE 'O-%%'");
  $bcount=mysqli_num_rows($bsql);

  $csql=mysqli_query($conn,"SELECT * FROM `admission` WHERE `patientidno`='$patientidno' AND `caseno` LIKE 'I-%%'");
  $ccount=mysqli_num_rows($csql);

  $dsql=mysqli_query($conn,"SELECT * FROM `patientblacklist` WHERE `ln` LIKE '$ln' AND `fn` LIKE '$fn' AND `mn` LIKE '$mnrel' AND `sf` LIKE '$sfrel'");
  $dcount=mysqli_num_rows($dsql);

  $st="";
  $btn="";
  $btnc="btn add";
  $rbg="";
  $rtc="";
  if($dcount>0){
    $st="Black Listed";
    $btn="disabled";
    $btnc="dis";
    $rbg="style='background-color: #FF0000;'";
    $rtc="color: #FFFFFF;";
  }

echo "
              <tr>
                <td class='b1 l2' height='30' $rbg><div align='left' class='arial s14 black' style='padding: 2px 5px;$rtc'>$a</div></td>
                <td class='b1 l1' $rbg><div align='center' class='arial s14 black' style='padding: 2px 3px;$rtc'>$patientidno</div></td>
                <td class='b1 l1' $rbg><div align='left' class='arial s14 black' style='padding: 2px 5px;$rtc'>$pn</div></td>
                <td class='b1 l1' $rbg><div align='center' class='arial s14 black' style='padding: 2px 5px;$rtc'>".date("M d, Y",strtotime($bd))."</div></td>
                <td class='b1 l1' $rbg><div align='center' class='arial s14 black' style='padding: 2px 5px;$rtc'>$bcount</div></td>
                <td class='b1 l1' $rbg><div align='center' class='arial s14 black' style='padding: 2px 5px;$rtc'>$ccount</div></td>
                <td class='b1 l1' $rbg><div align='center' class='arial s14 black' style='padding: 2px 5px;$rtc'>$st</div></td>
                <td class='b1 l1 r2' valign='middle' $rbg><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td $rbg><button type='button' class='$btnc' title='Add to Black List' $btn "; ?> onclick="<?php echo "window.open('blacklisted.php?patientidno=$patientidno&user=".base64_encode($user)."', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=250,left=500,width=450,height=330');";?>" <?php echo "><i class='icofont-ui-add fs-9'></i></button></td>
                  </tr>
                </table></div></td>
              </tr>
";
}

echo "
              <tr>
                <td colspan='8' class='t2'></td>
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

$pagesql=mysqli_query($conn,"SELECT * FROM `patientprofile`");
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
                          <td><div align='center'><form name='ShortPage' method='post' action='../philhealth/?blksp&show=$show'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='text' name='pagest' value='".($pagenum)."' style='height: 28px;width: 50px;text-align: center;border: 1px solid blue;padding: 0;' autocomplete='off' /></td>
                              </tr>
                            </table>
                          </form></div></td>
                          <td width='2'></td>
                          <td>
                            <a href='../philhealth/?blksp&show=$show&page=".($nxtpage)."'><input name='Submit5' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &gt;  ' /></a>
                          </td>
                        </tr>
";
}
else if(($page!=0)&&($nxtpage!=$page)){
echo "
                        <tr>
                          <td>
                            <a href='../philhealth/?blksp&show=$show&page=".($prevpage)."'><input name='Submit4' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &lt;   ' /></a>
                          </td>
                          <td width='2'></td>
                          <td><div align='center'><form name='ShortPage' method='post' action='../philhealth/?blksp&show=$show'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='text' name='pagest' value='".($pagenum)."' style=height: 28px;width: 50px;text-align: center;border: 1px solid blue;padding: 0;' autocomplete='off' /></td>
                              </tr>
                            </table>
                          </form></div></td>
                          <td width='2'></td>
                          <td>
                            <a href='../philhealth/?blksp&show=$show&page=".($nxtpage)."'><input name='Submit5' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &gt;  ' /></a>
                          </td>
                        </tr>
";
}
else if($nxtpage==$page){
echo "
                        <tr>
                          <td>
                            <a href='../philhealth/?blksp&show=$show&page=".($prevpage)."'><input name='Submit4' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &lt;   ' /></a>
                          </td>
                          <td width='2'></td>
                          <td><div align='center'><form name='ShortPage' method='post' action='../philhealth/?blksp&show=$show'>
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
