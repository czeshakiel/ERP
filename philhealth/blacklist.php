<style>
.t1 {border-top-width: 1px;border-top-color: #000000;border-top-style: solid;}
.b1 {border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;}
.l1 {border-left-width: 1px;border-left-color: #000000;border-left-style: solid;}
.r1 {border-right-width: 1px;border-right-color: #000000;border-right-style: solid;}

.t2 {border-top-width: 2px;border-top-color: #000000;border-top-style: solid;}
.b2 {border-bottom-width: 2px;border-bottom-color: #000000;border-bottom-style: solid;}
.l2 {border-left-width: 2px;border-left-color: #000000;border-left-style: solid;}
.r2 {border-right-width: 2px;border-right-color: #000000;border-right-style: solid;}

.arial{font-family: Arial;}
.times{font-family: "Times New Roman";}
.comic{font-family: "Comic Sans";}
.calibri{font-family: Calibri;}
.courier{font-family: "Courier New";}
.tahoma{font-family: Tahoma;}

.white{color: #FFFFFF;}
.black{color: #000000;}
.red{color: #FF0000;}
.blue{color: #0066FF;}
.green{color: #2FC200;}
.yellow{color: #FFFF00;}
.darkred{color: #830077;}
.brown{color: #4F2626;}
.grey{color: #CCCCCC;}

.bold{font-weight: bold;}

.s8{font-size: 8px;}
.s9{font-size: 9px;}
.s10{font-size: 10px;}
.s11{font-size: 11px;}
.s12{font-size: 12px;}
.s13{font-size: 13px;}
.s14{font-size: 14px;}
.s15{font-size: 15px;}
.s16{font-size: 16px;}
.s17{font-size: 17px;}
.s18{font-size: 18px;}
.s19{font-size: 19px;}
.s20{font-size: 20px;}
.s21{font-size: 21px;}
.s22{font-size: 22px;}
.s23{font-size: 23px;}
.s24{font-size: 24px;}
.s25{font-size: 25px;}
.s30{font-size: 30px;}
.s35{font-size: 35px;}
.s40{font-size: 40px;}

.pagein{width: 50px;text-align: center;border: 1px solid blue;color: blue;}

.hoverTable{width:100%; border-collapse:collapse;}

/* Define the default color for all the table rows */
.hoverTable tr{background: #b8d1f3;}

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}

.tabstyle .tab {padding: 5px 20px;font-family: Arial;font-weight: bold;font-size: 16px;color: #000000;}
.tabstyle .tab:hover {background-color: #FF0000;color: #FFFFFF;}
.tabstyle .tabselect {padding: 5px 20px;font-family: Arial;font-weight: bold;font-size: 16px;color: #FFFFFF;background-color: #FF0000;}
.tabstyle .tabselect:hover {opacity: 0.4;}

.btn {border: 1px solid #000000;width: 26px;height: 26px;border-radius: 7px;font-family: arial;font-size: 10px;text-align: center;padding: 0px 0px;}
.blk {background-color: #B200B0;color: #FFFFFF;border: 2px solid #000000;height: 30px;border-radius: 7px;font-family: arial;font-size: 12px;font-weight: bold;text-align: center;padding: 0px 5px;}
.blk:hover {opacity: 0.8;}
.cancel {background-color: #FF0000;color: #FFFFFF;}
.cancel:hover {opacity: 0.4;}
.add {background-color: #FFFFFF;color: #000000;}
.add:hover {opacity: 0.4;}
.view {background-color: #01d0da;color: #FFFFFF;}
.view:hover {opacity: 0.6;}
.dis {background-color: #b4b4b1;color: #e9e9e7;}
</style>
<script>
  function refundItem(){
    return confirm('Do you wish to request for refund?');
  }
  function undoRefund(){
    return confirm('Do you wish to undo request for refund?');
  }

  function deleteitem(){
    return confirm('Do you wish to delete?');
  }
</script>
<?php
//-------------------------------------------------------------------------------------------------
if(isset($_GET['show'])){
  $show=$_GET['show'];
}
else{
  if(isset($_POST['showme'])){
    $show=$_POST['showme'];
  }
  else{
    $show="20";
  }
}

if(isset($_GET['page'])){
  $page=$_GET['page'];
}
else{
  if(isset($_POST['pagest'])){
    $page=(($_POST['pagest']-1)*$show);
  }
  else{
    $page="0";
  }
}
//-------------------------------------------------------------------------------------------------

if($modulex=="IPD"){$queryx="and admission.ward='in' and productout.terminalname!='Testtobedone' and productout.terminalname!='Testdone'";}
elseif($modulex=="OPD"){$queryx="and admission.ward='out' and productout.terminalname!='Testtobedone' and productout.terminalname!='Testdone'";}
//elseif($modulex=="OPD"){$queryx="and admission.ward='out' and productout.terminalname!='Testtobedone' and productout.terminalname!='Testdone' and DATE(productout.datearray) > (NOW() - INTERVAL 60 DAY)";}
elseif($modulex=="TESTTOBEDONE"){$queryx="and productout.terminalname='Testtobedone'";}
elseif($modulex=="TESTDONE-IPD"){$queryx="and admission.ward='in' and productout.terminalname='Testdone'";}
elseif($modulex=="TESTDONE-OPD"){$queryx="and admission.ward='out' and productout.terminalname='Testdone'";}
elseif($modulex=="DISCHARGED"){$queryx="and admission.ward='discharged' and productout.terminalname!='Testdone' and (productout.status='PAID' or productout.status='Approved')";}
?>

<script type="text/JavaScript">
<!--
function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[1].elements[i].focus();
break;
         }
      }
   }
}

<?php
ini_set("display_errors","On");
echo '
function showResult() {
if (document.searchme.searchme.value.length==0) {
  document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
  return;
}
if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
  }
}
xmlhttp.open("GET","blacklistsr.php?blk&user='.$user.'&userunique='.$userunique.'&show='.$show.'&page='.$page.'&searchme="+document.searchme.searchme.value,true);
xmlhttp.send();
}
';
?>
//-->
</script>

<?php
echo "
    <!-- Body: Body -->
    <div class='body d-flex py-lg-3 py-md-2'>
      <div class='container-xxl'>
        <div class='row align-items-center'>
          <div class='border-0 mb-4'>
            <div class='card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap'>
              <h3 class='fw-bold mb-0'>Patient Black List</h3>
            </div>
          </div>
        </div> <!-- Row end  -->
        <div class='row clearfix g-3'>
          <div class='col-sm-12'>
            <div class='card mb-3'>
              <div class='card-body'>
              
                <table border='0' width='98%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td height='15'></td>
                  </tr>
                  <tr>
                    <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td width='50%'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><div align='left' class='arial s12 black bold'>Show</div></td>
                            <td width='5'></td>
                            <form id='NextPage' name='NextPage' method='post' action='../philhealth/?blk&page=0'>
                            <td><input name='showme' type='text' autocomplete='off' onKeyUp='showResult();' style='height: 25px;width: 40px;font-family: courier new;color: blue;border-top: none;border-left: none;border-right: none;border-bottom: 2px solid black;padding-left: 5px;padding-right: 5px;text-align: center;' value='$show'></td>
                            </form>
                            <td width='5'></td>
                            <td><div align='left' class='arial s12 black bold'>entries</div></td>
                          </tr>
                        </table></div></td>
                        <td width='50%'><div align='right'>
                          <table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <form name='searchme' onload='showResult();' method='post' action='../philhealth/?blk&show=$show&page=".($page)."'>
                              <td><div align='right' style='font-family: arial; font-weight: bold; font-size: 12px; color: blue;'>SEARCH: <input name='searchme' type='text' autocomplete='off' onKeyUp='showResult();' style='height: 25px;width: 250px;font-family: courier new;color: red;border-top: none;border-left: none;border-right: none;border-bottom: 2px solid black;padding-left: 5px;padding-right: 5px;'></div></td>
                              </form>
                              <td width='10'></td>
                              <td><a href='../philhealth/?blksp&show=$show&page=".($page)."'><button type='button' class='blk' title='Remove'><i class='icofont-ui-add fs-7'></i> Add to Black List</button></a></</td>
                            </tr>
                          </table>
                        </div></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height='5'></td>
                  </tr>
";


//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
echo "
                  <tr>
                    <td><div id='livesearch' align='left'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
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
  $ln=mb_strtoupper(trim($afetch['ln']));
  $fn=mb_strtoupper(trim($afetch['fn']));
  $mn=mb_strtoupper(trim($afetch['mn']));
  $sf=mb_strtoupper(trim($afetch['sf']));
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

if(($page+$show)>$pagecount){$tonum=$pagecount;}
else{$tonum=$page+$show;}

echo "
                              <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                <tr>
                                  <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                    <tr>
                                      <td width='50%'><div align='left'><span class='arial s12 black bold'>Showing </span><span class='arial s13 blue'>".($page+1)." to ".$tonum." of $pagecount</span> | <span class='arial s12 black bold'>Page: </span><span class='arial s13 blue'>$pagenum of $totalpage</span></div></td>
                                      <td width='50%'><div align='right'>
                                        <table border='0' cellspacing='0' cellpadding='0'>
";

if($pagecount<=$show){
echo "
                                          <tr>
                                            <td>
                                              <input name='Submit4' type='submit' style='color: #cccccc;' value='  &lt;   ' disabled />
                                            </td>
                                            <td width='2'></td>
                                            <td><div align='center'>
                                              <input type='text' name='pagest' value='".($pagenum)."' style='height: 28px;width: 50px;border: 1px solid blue;text-align: center;padding: 0;' disabled />
                                            </div></td>
                                            <td width='2'></td>
                                            <td>
                                              <input name='Submit5' type='submit' style='color: #cccccc;' value='  &gt;  ' disabled />
                                            </td>
                                          </tr>
";
}
else if($pagecount>$show){
if($page=='0'){
echo "
                                          <tr>
                                            <td>
                                              <input name='Submit4' type='submit' style='color: #cccccc;' value='  &lt;   ' disabled />
                                            </td>
                                            <td width='2'></td>
                                            <form name='ShortPage' method='post' action='../philhealth/?blk&show=$show'>
                                            <td><div align='center'>
                                              <input type='text' name='pagest' value='".($pagenum)."' style='height: 28px;width: 50px;border: 1px solid blue;text-align: center;padding: 0;' autocomplete='off' />
                                            </div></td>
                                            </form>
                                            <td width='2'></td>
                                            <form id='NextPage' name='NextPage' method='post' action='../philhealth/?blk&show=$show&page=".($nxtpage)."'>
                                            <td>
                                              <input name='Submit5' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &gt;  ' />
                                            </td>
                                            </form>
                                          </tr>
";
}
else if(($page!=0)&&($nxtpage!=$page)){
echo "
                                          <tr>
                                            <form id='NextPage' name='NextPage' method='post' action='../philhealth/?blk&show=$show&page=".($prevpage)."'>
                                            <td>
                                              <input name='Submit4' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &lt;   ' />
                                            </td>
                                            </form>
                                            <td width='2'></td>
                                            <form name='ShortPage' method='post' action='../philhealth/?blk&show=$show'>
                                            <td><div align='center'>
                                              <input type='text' name='pagest' value='".($pagenum)."' style='height: 28px;width: 50px;border: 1px solid blue;text-align: center;padding: 0;' autocomplete='off' />
                                            </div></td>
                                            </form>
                                            <td width='2'></td>
                                            <form id='NextPage' name='NextPage' method='post' action='../philhealth/?blk&show=$show&page=".($nxtpage)."'>
                                            <td>
                                              <input name='Submit5' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &gt;  ' />
                                            </td>
                                            </form>
                                          </tr>
";
}
else if($nxtpage==$page){
echo "
                                          <tr>
                                            <form id='NextPage' name='NextPage' method='post' action='../philhealth/?blk&show=$show&page=".($prevpage)."'>
                                            <td>
                                              <input name='Submit4' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &lt;   ' />
                                            </td>
                                            </form>
                                            <td width='2'></td>
                                            <form name='ShortPage' method='post' action='../philhealth/?blk&show=$show'>
                                            <td><div align='center'>
                                              <input type='text' name='pagest' value='".($pagenum)."' style='height: 28px;width: 50px;border: 1px solid blue;text-align: center;padding: 0;' autocomplete='off' />
                                            </div></td>
                                            </form>
                                            <td width='2'></td>
                                            <td>
                                              <input name='Submit5' type='submit' style='color: #cccccc;' value='  &gt;  ' disabled />
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
                    </table></div></td>
                  </tr>
";
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


echo "
                </table>
                
                <!-- Back to top button -->
              </div>
            </div>
          </div>
        </div><!-- Row End -->
      </div>
    </div>
";
?>
