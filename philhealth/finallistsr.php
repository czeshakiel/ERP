<?php
ini_set("display_errors","On");
include("../../2022codes/outcon.php");
include("../../2021codes/Settings.php");

$view=$_GET['view'];
$show=$_GET['show'];
$page=$_GET['page'];
$searchme=$_GET['searchme'];
$user=$_GET['user'];
$userunique=$_GET['userunique'];

$ip="192.168.0.100:100";

echo "
<div align='center'>
";

$len=strlen($searchme);
if($len>1){
mysqli_query($mycon1,"SET NAMES 'utf8'");

echo "
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td><table border='0' width='100%' cellpadding='0' cellspacing='0' class='hoverTable'>
        <tr>
          <td class='t2 b2 l2' width='30' rowspan='2'><div align='center' class='arial s12 black bold'>#</div></td>
          <td class='t2 b2 l1' width='30' rowspan='2'><div align='center' class='arial s12 black bold'><input type='checkbox' name='test' value='' /></div></td>
          <td class='t2 b2 l1' width='auto' rowspan='2'><div align='center' class='arial s12 black bold'>Transmittal Number</div></td>
          <td class='t2 b2 l1' width='250' rowspan='2'><div align='center' class='arial s12 black bold'>Date Transmitted</div></td>
          <td class='t2 b2 l1' width='100' rowspan='2'><div align='center' class='arial s12 black bold'>Total Claims</div></td>
          <td class='t2 b2 l1' colspan='6'><div align='center' class='arial s12 black bold'>Charges</div></td>
          <td class='t2 b2 l1 r2' width='100' rowspan='2'><div align='center' class='arial s12 black bold'>Action</div></td>
        </tr>
        <tr>
          <td class='b2 l1' width='100'><div align='center' class='arial s12 black bold'>Room & Board</div></td>
          <td class='b2 l1' width='100'><div align='center' class='arial s12 black bold'>Lab / Others</div></td>
          <td class='b2 l1' width='100'><div align='center' class='arial s12 black bold'>Meds.</div></td>
          <td class='b2 l1' width='100'><div align='center' class='arial s12 black bold'>O.R.</div></td>
          <td class='b2 l1' width='100'><div align='center' class='arial s12 black bold'>PF</div></td>
          <td class='b2 l1' width='100'><div align='center' class='arial s12 black bold'>Total</div></td>
        </tr>
";

$a=0;
$asql=mysqli_query($mycon1,"SELECT `claimnumber`, `datetransmitted` FROM `translist` WHERE `status`='Finalized' AND `claimnumber`='$searchme' GROUP BY `claimnumber` ORDER BY `claimnumber`");
while($afetch=mysqli_fetch_array($asql)){
$claimnumber=$afetch['claimnumber'];
$datetransmitted=$afetch['datetransmitted'];
$a++;

$room=0;
$lab=0;
$meds=0;
$or=0;
$pf=0;
$tt=0;
$bsql=mysqli_query($mycon1,"SELECT `roomandboard`, `labothers`, `meds`, `or`, `pf` FROM `translist` WHERE `claimnumber`='$claimnumber'");
while($bfetch=mysqli_fetch_array($bsql)){
$room+=$bfetch['roomandboard'];
$lab+=$bfetch['labothers'];
$meds+=$bfetch['meds'];
$or+=$bfetch['or'];
$pf+=$bfetch['pf'];
$tt+=($bfetch['roomandboard']+$bfetch['labothers']+$bfetch['meds']+$bfetch['or']+$bfetch['pf']);
}

$csql=mysqli_query($mycon1,"SELECT * FROM `translist` WHERE `claimnumber`='$claimnumber'");
$ccount=mysqli_num_rows($csql);

echo "
        <tr>
          <td class='b1 l2' height='35'><div align='left' class='arial s14 black'>&nbsp;$a&nbsp;</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'><input type='checkbox' name='test' value='' /></div></td>
          <td class='b1 l1'><div align='left' class='arial s15 black'>&nbsp;$claimnumber&nbsp;</div></td>
          <td class='b1 l1'><div align='center' class='arial s15 black'>&nbsp;$datetransmitted&nbsp;</div></td>
          <td class='b1 l1'><div align='center' class='arial s15 black'>&nbsp;$ccount&nbsp;</div></td>
          <td class='b1 l1'><div align='right' class='arial s15 black'>&nbsp;".number_format($room,2)."&nbsp;</div></td>
          <td class='b1 l1'><div align='right' class='arial s15 black'>&nbsp;".number_format($lab,2)."&nbsp;</div></td>
          <td class='b1 l1'><div align='right' class='arial s15 black'>&nbsp;".number_format($meds,2)."&nbsp;</div></td>
          <td class='b1 l1'><div align='right' class='arial s15 black'>&nbsp;".number_format($or,2)."&nbsp;</div></td>
          <td class='b1 l1'><div align='right' class='arial s15 black'>&nbsp;".number_format($pf,2)."&nbsp;</div></td>
          <td class='b1 l1'><div align='right' class='arial s15 black'>&nbsp;".number_format($tt,2)."&nbsp;</div></td>
          <td class='b1 l1 r2' valign='middle'><div align='center' class='arial s14 black btnstyle'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
            <td><button type='button' class='btn mod' title='Edit'"; ?> onclick="<?php echo "window.open('FinalizeEdit.php?claimnumber=$claimnumber&uname=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=380,left=720,width=450,height=250');";?>" <?php echo "><i class='icofont-edit'></i></button></td>
            <td width='2'></td>
            <td><a href='../philhealth/?dl&show=$show&claimnumber=$claimnumber' target='_blank'><button type='button' class='btn view' title='View Details'><i class='icofont-eye-alt'></i></button></a></td>
            <td width='2'></td>
            <td><a href='../extra/TransmittalList/?claimnumber=$claimnumber' target='_blank'><button type='button' class='btn print' title='Print Transmittal List'><i class='icofont-print'></i></button></a></td>
            </tr>
          </table></div></td>
        </tr>

";
}

echo "
        <tr>
          <td colspan='12' class='t2'></td>
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
                <td class='t2 b2 l2' width='30' rowspan='2'><div align='center' class='arial s12 black bold'>#</div></td>
                <td class='t2 b2 l1' width='30' rowspan='2'><div align='center' class='arial s12 black bold'><input type='checkbox' name='test' value='' /></div></td>
                <td class='t2 b2 l1' width='auto' rowspan='2'><div align='center' class='arial s12 black bold'>Transmittal Number</div></td>
                <td class='t2 b2 l1' width='250' rowspan='2'><div align='center' class='arial s12 black bold'>Date Transmitted</div></td>
                <td class='t2 b2 l1' width='100' rowspan='2'><div align='center' class='arial s12 black bold'>Total Claims</div></td>
                <td class='t2 b2 l1' colspan='6'><div align='center' class='arial s12 black bold'>Charges</div></td>
                <td class='t2 b2 l1 r2' width='100' rowspan='2'><div align='center' class='arial s12 black bold'>Action</div></td>
              </tr>
              <tr>
                <td class='b2 l1' width='100'><div align='center' class='arial s12 black bold'>Room & Board</div></td>
                <td class='b2 l1' width='100'><div align='center' class='arial s12 black bold'>Lab / Others</div></td>
                <td class='b2 l1' width='100'><div align='center' class='arial s12 black bold'>Meds.</div></td>
                <td class='b2 l1' width='100'><div align='center' class='arial s12 black bold'>O.R.</div></td>
                <td class='b2 l1' width='100'><div align='center' class='arial s12 black bold'>PF</div></td>
                <td class='b2 l1' width='100'><div align='center' class='arial s12 black bold'>Total</div></td>
              </tr>
";

mysqli_query($mycon1,"SET NAMES 'utf8'");

$a=$page;
$asql=mysqli_query($mycon1,"SELECT `claimnumber`, `datetransmitted` FROM `translist` WHERE `status`='Finalized' GROUP BY `claimnumber` ORDER BY `claimnumber` LIMIT $page,$show");
while($afetch=mysqli_fetch_array($asql)){
$claimnumber=$afetch['claimnumber'];
$datetransmitted=$afetch['datetransmitted'];
$a++;

$room=0;
$lab=0;
$meds=0;
$or=0;
$pf=0;
$tt=0;
$bsql=mysqli_query($mycon1,"SELECT `roomandboard`, `labothers`, `meds`, `or`, `pf` FROM `translist` WHERE `claimnumber`='$claimnumber'");
while($bfetch=mysqli_fetch_array($bsql)){
$room+=$bfetch['roomandboard'];
$lab+=$bfetch['labothers'];
$meds+=$bfetch['meds'];
$or+=$bfetch['or'];
$pf+=$bfetch['pf'];
$tt+=($bfetch['roomandboard']+$bfetch['labothers']+$bfetch['meds']+$bfetch['or']+$bfetch['pf']);
}

$csql=mysqli_query($mycon1,"SELECT * FROM `translist` WHERE `claimnumber`='$claimnumber'");
$ccount=mysqli_num_rows($csql);

echo "
              <tr>
                <td class='b1 l2' height='35'><div align='left' class='arial s14 black'>&nbsp;$a&nbsp;</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black'><input type='checkbox' name='test' value='' /></div></td>
                <td class='b1 l1'><div align='left' class='arial s15 black'>&nbsp;$claimnumber&nbsp;</div></td>
                <td class='b1 l1'><div align='center' class='arial s15 black'>&nbsp;$datetransmitted&nbsp;</div></td>
                <td class='b1 l1'><div align='center' class='arial s15 black'>&nbsp;$ccount&nbsp;</div></td>
                <td class='b1 l1'><div align='right' class='arial s15 black'>&nbsp;".number_format($room,2)."&nbsp;</div></td>
                <td class='b1 l1'><div align='right' class='arial s15 black'>&nbsp;".number_format($lab,2)."&nbsp;</div></td>
                <td class='b1 l1'><div align='right' class='arial s15 black'>&nbsp;".number_format($meds,2)."&nbsp;</div></td>
                <td class='b1 l1'><div align='right' class='arial s15 black'>&nbsp;".number_format($or,2)."&nbsp;</div></td>
                <td class='b1 l1'><div align='right' class='arial s15 black'>&nbsp;".number_format($pf,2)."&nbsp;</div></td>
                <td class='b1 l1'><div align='right' class='arial s15 black'>&nbsp;".number_format($tt,2)."&nbsp;</div></td>
                <td class='b1 l1 r2' valign='middle'><div align='center' class='arial s14 black btnstyle'><table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                  <td><button type='button' class='btn mod' title='Edit'"; ?> onclick="<?php echo "window.open('FinalizeEdit.php?claimnumber=$claimnumber&uname=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=380,left=720,width=450,height=250');";?>" <?php echo "><i class='icofont-edit'></i></button></td>
                  <td width='2'></td>
                  <td><a href='../philhealth/?dl&show=$show&claimnumber=$claimnumber' target='_blank'><button type='button' class='btn view' title='View Details'><i class='icofont-eye-alt'></i></button></a></td>
                  <td width='2'></td>
                  <td><a href='../extra/TransmittalList/?claimnumber=$claimnumber' target='_blank'><button type='button' class='btn print' title='Print Transmittal List'><i class='icofont-print'></i></button></a></td>
                  </tr>
                </table></div></td>
              </tr>
";
}

echo "
              <tr>
                <td colspan='12' class='t2'></td>
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

$pagesql=mysqli_query($mycon1,"SELECT `claimnumber`, `datetransmitted` FROM `translist` WHERE `status`='Finalized' GROUP BY `claimnumber`");
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
                            <input type='text' name='pagest' value='".($pagenum)."' style='width: 40px;text-align: center;border: 1px solid blue;' disabled />
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
                          <td><div align='center'><form name='ShortPage' method='post' action='../philhealth/?fl&show=$show'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='text' name='pagest' value='".($pagenum)."' style='width: 40px;text-align: center;border: 1px solid blue;' autocomplete='off' /></td>
                              </tr>
                            </table>
                          </form></div></td>
                          <td width='2'></td>
                          <td>
                            <a href='../philhealth/?view=translist&show=$show&page=".($nxtpage)."'><input name='Submit5' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &gt;  ' /></a>
                          </td>
                        </tr>
";
}
else if(($page!=0)&&($nxtpage!=$page)){
echo "
                        <tr>
                          <td>
                            <a href='../philhealth/?fl&show=$show&page=".($prevpage)."'><input name='Submit4' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &lt;   ' /></a>
                          </td>
                          <td width='2'></td>
                          <td><div align='center'><form name='ShortPage' method='post' action='../philhealth/?fl&show=$show'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='text' name='pagest' value='".($pagenum)."' style='width: 40px;text-align: center;border: 1px solid blue;' autocomplete='off' /></td>
                              </tr>
                            </table>
                          </form></div></td>
                          <td width='2'></td>
                          <td>
                            <a href='../philhealth/?view=translist&show=$show&page=".($nxtpage)."'><input name='Submit5' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &gt;  ' /></a>
                          </td>
                        </tr>
";
}
else if($nxtpage==$page){
echo "
                        <tr>
                          <td>
                            <a href='../philhealth/?fl&show=$show&page=".($prevpage)."'><input name='Submit4' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &lt;   ' /></a>
                          </td>
                          <td width='2'></td>
                          <td><div align='center'><form name='ShortPage' method='post' action='../philhealth/?vfl&show=$show'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='text' name='pagest' value='".($pagenum)."' style='width: 40px;text-align: center;border: 1px solid blue;' autocomplete='off' /></td>
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
