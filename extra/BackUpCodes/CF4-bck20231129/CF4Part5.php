<link href="res/css/normalize.css" rel="stylesheet" type="text/css" />
<link href="res/css/omis.css" rel="stylesheet" type="text/css" />
<link href="res/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="res/css/styles.css" rel="stylesheet" type="text/css" />
<link href="res/css/jquery-ui-1.11.4.css" rel="stylesheet"><!--added by marv 01302018-->
<link href="res/datatable/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />

<?php
$outconnkmsci=mysqli_connect('192.168.0.200', 'kmsciec', 'levelwithme', 'kmsci');
if(!$outconnkmsci){echo"<script>alert('Unable to connect eClaims KMSCI DB');</script>";}

echo '
<script type="text/JavaScript">
<!--
function placeFocus() {
  if (document.forms.length > 0) {
    var field = document.forms[0];
    for (i = 0; i < field.length; i++) {
      if ((field.elements[i].type == "checkbox") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
        document.forms[0].elements[i].focus();
        break;
      }
    }
  }
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

var el = document.getElementById("RemoveCF4");

el.addEventListener("submit", function(){
    return confirm("Are you sure you want to remove this entry?");
}, false);

function showResult() {
  if (document.searchme.searchme.value.length==0) {
    document.getElementById("livesearch").innerHTML=" ";
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
  xmlhttp.open("GET","CF4Part5SearchResult.php?caseno='.$caseno.'&searchme="+document.searchme.searchme.value,true);
  xmlhttp.send();
}

//-->
</script>
';

include('function.php');
include('function_global.php');

//aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
if(empty($_GET["aa"])){$aa="";}
else{$aa=mysqli_real_escape_string($conncf4,$_GET["aa"]);}

$aasql=mysqli_query($outconnkmsci,"SELECT `drugdesc` FROM `phicmedicine` WHERE `drugcode`='$aa'");

$aacount=mysqli_num_rows($aasql);
if($aacount==0){
  $drugdesc="";
}
else{
  $aafetch=mysqli_fetch_array($aasql);
  $drugdesc=$aafetch['drugdesc'];
}

//bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb
if(empty($_GET["bb"])){$bb="";}
else{$bb=mysqli_real_escape_string($conncf4,$_GET["bb"]);}

$bbsql=mysqli_query($outconnkmsci,"SELECT `gendesc` FROM `phicmedsgeneric` WHERE `gencode`='$bb'");

$bbcount=mysqli_num_rows($bbsql);
if($bbcount==0){
  $gendesc="";
}
else{
  $bbfetch=mysqli_fetch_array($bbsql);
  $gendesc=$bbfetch['gendesc'];
}

//ccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc
if(empty($_GET["cc"])){$cc="";}
else{$cc=mysqli_real_escape_string($conncf4,$_GET["cc"]);}

$ccsql=mysqli_query($outconnkmsci,"SELECT `saltdesc` FROM `phicmedssalt` WHERE `saltcode`='$cc'");

$cccount=mysqli_num_rows($ccsql);
if($cccount==0){
  $saltdesc="";
}
else{
  $ccfetch=mysqli_fetch_array($ccsql);
  $saltdesc=$ccfetch['saltdesc'];
}

//ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd
if(empty($_GET["dd"])){$dd="";}
else{$dd=mysqli_real_escape_string($conncf4,$_GET["dd"]);}

$ddsql=mysqli_query($outconnkmsci,"SELECT `strengthdesc` FROM `phicmedsstrength` WHERE `strengthcode`='$dd'");

$ddcount=mysqli_num_rows($ddsql);
if($ddcount==0){
  $strengthdesc="";
}
else{
  $ddfetch=mysqli_fetch_array($ddsql);
  $strengthdesc=$ddfetch['strengthdesc'];
}

//eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
if(empty($_GET["ee"])){$ee="";}
else{$ee=mysqli_real_escape_string($conncf4,$_GET["ee"]);}

$eesql=mysqli_query($outconnkmsci,"SELECT `formdesc` FROM `phicmedsform` WHERE `formcode`='$ee'");

$eecount=mysqli_num_rows($eesql);
if($eecount==0){
  $formdesc="";
}
else{
  $eefetch=mysqli_fetch_array($eesql);
  $formdesc=$eefetch['formdesc'];
}

//fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
if(empty($_GET["ff"])){$ff="";}
else{$ff=mysqli_real_escape_string($conncf4,$_GET["ff"]);}

$ffsql=mysqli_query($outconnkmsci,"SELECT `unitdesc` FROM `phicmedsunit` WHERE `unitcode`='$ff'");

$ffcount=mysqli_num_rows($ffsql);
if($ffcount==0){
  $unitdesc="";
}
else{
  $fffetch=mysqli_fetch_array($ffsql);
  $unitdesc=$fffetch['unitdesc'];
}

//ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg
if(empty($_GET["gg"])){$gg="";}
else{$gg=mysqli_real_escape_string($conncf4,$_GET["gg"]);}

$ggsql=mysqli_query($outconnkmsci,"SELECT `packagedesc` FROM `phicmedspackage` WHERE `packagecode`='$gg'");

$ggcount=mysqli_num_rows($ggsql);
if($ggcount==0){
  $packagedesc="";
}
else{
  $ggfetch=mysqli_fetch_array($ggsql);
  $packagedesc=$ggfetch['packagedesc'];
}

//---------------------------------------------------------------------------------------------------------------------------------------------------

if($aa=="NOMED0000000000000000000000000"){$nomedroute="-";$nomedfreq="-";$nomedqty="0";$nomedtot="0";}
else{$nomedroute="";$nomedfreq="";$nomedqty="";$nomedtot="";}

echo "
<div align='center'>
<table style='width:100%;'>
  <tr>
    <td width='10'></td>
    <td>
    <a href='CF4Part5_test.php?caseno=$caseno' style='text-decoration: none;'><div class='alert alert-success' style='margin-bottom: 0px'>
      <strong style='font-size: 16px'>DRUG PRESCRIPTION</strong>
    </div></a>

    <table id='tblPrescribeMeds' class='table table-bordered table-condensed' style='width:100%'>
      <tr>
        <td colspan='2'>
          <table style='margin-top: 5px; text-align: left;'>
            <tr>
              <th><label style='font-size:13px;'>Search Drug Description</label></th>
            </tr>
            <tr>
              <form name='searchme'>
              <td>
                <input name='searchme' type='text' class='form-control' autocomplete='off' style='width:300px;margin:0px 10px 0px 0px;' placeholder='Type Name of the Medicine Here' onKeyUp='showResult();' />
              </td>
              </form>
            </tr>
            <tr>
              <td height='10'></td>
            </tr>
            <tr>
              <td><div align='left' id='livesearch'></div></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <form name='CF4Part5AddMeds' method='post' action='CF4Part5Save.php'>
        <td>
          <table>
            <tr>
              <td><label style='text-decoration: underline;'>MEDICINE</label></td>
            </tr>
          </table>
          <table style='margin-top: 5px; text-align: left;'>
            <tr>
              <th><label style='font-size:13px;'>Complete Drug Description</label></th>
            </tr>
            <tr>
              <td>
                <select name='pDrugCode' id='pDrugCode' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                  <option value='$aa'>$drugdesc</option>
                </select>
              </td>
            </tr>
          </table>
          <table style='margin-top: 15px; text-align: left;'>
            <tr>
              <th><label style='font-style: italic;font-weight: normal;'>Generic Name&nbsp;</label></th>
              <th><label style='font-style: italic;font-weight: normal;'>Salt&nbsp;</label></th>
              <th><label style='font-style: italic;font-weight: normal;'>Strength&nbsp;</label></th>
              <th><label style='font-style: italic;font-weight: normal;'>Form&nbsp;</label></th>
              <th><label style='font-style: italic;font-weight: normal;'>Unit&nbsp;</label></th>
              <th><label style='font-style: italic;font-weight: normal;'>Package</label></th>
            </tr>
            <tr>
              <td>
                <select name='pGeneric' id='pGeneric' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                  <option value='$bb' selected='selected'>$gendesc</option>
                </select>
              </td>
              <td>
                <select name='pSalt' id='pSalt' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                  <option value='$cc' selected='selected'>$saltdesc</option>
                </select>
              </td>
              <td>
                <select name='pStrength' id='pStrength' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                  <option value='$dd' selected='selected'>$strengthdesc</option>
                </select>
              </td>
              <td>
                <select name='pForm' id='pForm' class='form-control' style='width:auto; margin:0px 10px 0px 0px;'>
                  <option value='$ee' selected='selected'>$formdesc</option>
                </select>
              </td>
              <td>
                <select name='pUnit' id='pUnit' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                  <option value='$ff' selected='selected'>$unitdesc</option>
                </select>
              </td>
              <td>
                <select name='pPackage' id='pPackage' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                  <option value='$gg' selected='selected'>$packagedesc</option>
                </select>
              </td>
            </tr>
          </table>
          <table style='margin-top: 15px; text-align: left;'>
            <tbody>
              <tr>
                <td>
                  <label style='font-size:11px;color: red;'><i>Note: If Medicine is not available in the list, kindly input  the drug description below as required:</i></label><br/>
                  <label style='font-size:13px;'>Generic Name/Salt/Strength/Form/Unit/Package</label>
                </td>
              </tr>
              <tr>
                <td>
                  <input type='text' name='pGenericFreeText' id='pGenericFreeText' class='form-control' value='' style='width: 100%; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' autocomplete='off' maxlength='500' />
                </td>
              </tr>
            </tbody>
          </table>
          <table style='margin-top: 15px; text-align: left;'>
            <tbody>
              <tr>
                <td><label style='font-size:13px;'>Route</label></td>
                <td><label style='font-size:13px;'>Frequency</label></td>
                <td></td>
              </tr>
              <tr>
                <td>
                  <input type='text' name='pRoute' id='pRoute' class='form-control' value='$nomedroute' style='width: 220px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' maxlength='500' />
                </td>
                <td>
                  <input type='text' name='pFrequencyInstruction' id='pFrequencyInstruction' class='form-control' value='$nomedfreq' style='width: 220px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' maxlength='500' />
                </td>
              </tr>
            </tbody>
          </table>
          <table style='margin-top: 15px; text-align: left;'>
            <tr>
              <td><label style='font-size:13px;'>Quantity</label></td>
              <td><label style='font-size:13px;'>Total Amount Price</label></td>
            </tr>
            <tr>
              <td>
                <input type='text' name='pQuantity' id='pQuantity' class='form-control' value='$nomedqty' style='width: 80px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' autocomplete='off' maxlength='5' onkeypress='return isNumberKey(event);' />
              </td>
              <td>
                <input type='text' name='pTotalPrice' id='pTotalPrice' class='form-control' value='$nomedtot' style='width: 150px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' autocomplete='off' maxlength='15' onkeypress='return isNumberWithDecimalKey(event);' />
              </td>
            </tr>
          </table>
        </td>
        <td style='vertical-align: middle'><div align='center'>
          <input type='image' name='imageField' src='Resources/Button/AddMed-Out.png' id='ImageA' height='38' onmouseover=MM_swapImage('ImageA','','Resources/Button/AddMed-Over.png',1) onmouseout='MM_swapImgRestore()' title='Add Medicine' />
        </div></td>
        <input type='hidden' name='caseno' value='$caseno' />
        </form>
      </tr>
";

if((stripos($caseno, "RC-") !== FALSE)||(stripos($caseno, "I-") !== FALSE)||(stripos($caseno, "O-") !== FALSE)){
  //AUTO MEDS------------------------------------------------------------------------------------------------------------------------------------------
  $medisql=mysqli_query($conn,"SELECT `productdesc`, `productcode`, SUM(`quantity`) AS `quantity`, `sellingprice` FROM `productout` WHERE `caseno`='$caseno' AND `productsubtype`='PHARMACY/MEDICINE' AND `trantype`='charge' AND `quantity` > 0 AND `gross` > 0 GROUP BY `productcode` ORDER BY `refno`");
  while($medifetch=mysqli_fetch_array($medisql)){
  $productcode=$medifetch['productcode'];
  $productdesc=$medifetch['productdesc'];
  $productdesc=str_replace("ams-","",$productdesc);
  $productdesc=str_replace("-med","",$productdesc);
  $productdesc=strtoupper($productdesc);

  //$qty=$medifetch['quantity'];
  //$ramt=$medifetch['sellingprice'];
  //$tamt=$ramt*$qty;

  $qty=0;
  $tamt=0;
  $smedisql=mysqli_query($conn,"SELECT `quantity`, `sellingprice` FROM `productout` WHERE `productcode`='$productcode' AND `caseno`='$caseno' AND `productsubtype`='PHARMACY/MEDICINE' AND `trantype`='charge' AND `quantity` > 0 AND `gross` > 0");
  while($smedifetch=mysqli_fetch_array($smedisql)){
    $sqty=$smedifetch['quantity'];
    $sspr=$smedifetch['sellingprice'];

    $tamt+=($sqty*$sspr);
    $qty+=$sqty;
  }

  $mtsql=mysqli_query($outconnkmsci,"SELECT * FROM `medtranslator` WHERE `code`='$productcode'");
  $mtcount=mysqli_num_rows($mtsql);

  $sroute="";
  $sfreq="";
  $paisql=mysqli_query($conn,"SELECT `route`, `frequency` FROM `productoutaddinfo` WHERE `caseno`='$caseno' AND `code`='$productcode' AND `route` NOT LIKE ''");
  $paicount=mysqli_num_rows($paisql);
  if($paicount==0){
    $sroute="";
    $sfreq="";
  }
  else{
    $paifetch=mysqli_fetch_array($paisql);
    $sroute=$paifetch['route'];
    $sfreq=$paifetch['frequency'];
  }

  //BEGIN FIND IF ALREADY ADDED
  $ifpre=0;
  if($mtcount!=0){
  while($dcfetch=mysqli_fetch_array($mtsql)){$dc=$dcfetch['drugcode'];}

  $fpsql=mysqli_query($conncf4,"SELECT * FROM `medicine` WHERE `pDrugCode`='$dc' AND `caseno`='$caseno'");
  $fpcount=mysqli_num_rows($fpsql);

  if($fpcount!=0){$ifpre+=1;}
  }
  else{
  $fpsql=mysqli_query($conncf4,"SELECT * FROM `medicine` WHERE `pGenericName`='$productdesc' AND `caseno`='$caseno'");
  $fpcount=mysqli_num_rows($fpsql);

  if($fpcount!=0){$ifpre+=1;}
  }
  //END FIND IF ALREADY ADDED

  if($ifpre==0){
  echo "
        <tr>
          <form name='CF4Part5AddMeds' method='post' action='CF4Part5Save.php'>
          <td>
  ";

  if($mtcount!=0){
  $aaa=$dc;

  $agsql=mysqli_query($outconnkmsci,"SELECT * FROM `phicmedicine` WHERE `drugcode`='$aaa'");
  while($agfetch=mysqli_fetch_array($agsql)){
  $drugdescauto=$agfetch['drugdesc'];
  $bbb=$agfetch['gencode'];
  $ccc=$agfetch['saltcode'];
  $eee=$agfetch['formcode'];
  $ddd=$agfetch['strengthcode'];
  $fff=$agfetch['unitcode'];
  $ggg=$agfetch['packagecode'];
  }

  //bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb
  $bbbsql=mysqli_query($outconnkmsci,"SELECT `gendesc` FROM `phicmedsgeneric` WHERE `gencode`='$bbb'");
  while($bbbfetch=mysqli_fetch_array($bbbsql)){$gendescauto=$bbbfetch['gendesc'];}

  //ccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc
  $cccsql=mysqli_query($outconnkmsci,"SELECT `saltdesc` FROM `phicmedssalt` WHERE `saltcode`='$ccc'");
  while($cccfetch=mysqli_fetch_array($cccsql)){$saltdescauto=$cccfetch['saltdesc'];}

  //ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd
  $dddsql=mysqli_query($outconnkmsci,"SELECT `strengthdesc` FROM `phicmedsstrength` WHERE `strengthcode`='$ddd'");
  while($dddfetch=mysqli_fetch_array($dddsql)){$strengthdescauto=$dddfetch['strengthdesc'];}

  //eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
  $eeesql=mysqli_query($outconnkmsci,"SELECT `formdesc` FROM `phicmedsform` WHERE `formcode`='$eee'");
  while($eeefetch=mysqli_fetch_array($eeesql)){$formdescauto=$eeefetch['formdesc'];}

  //fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
  $fffsql=mysqli_query($outconnkmsci,"SELECT `unitdesc` FROM `phicmedsunit` WHERE `unitcode`='$fff'");
  while($ffffetch=mysqli_fetch_array($fffsql)){$unitdescauto=$ffffetch['unitdesc'];}

  //ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg
  $gggsql=mysqli_query($outconnkmsci,"SELECT `packagedesc` FROM `phicmedspackage` WHERE `packagecode`='$ggg'");
  while($gggfetch=mysqli_fetch_array($gggsql)){$packagedescauto=$gggfetch['packagedesc'];}

  $generic="";

  $genoc="1";

  echo "
            <table>
              <tr>
                <td><label style='text-decoration: underline;'>MEDICINE</label></td>
              </tr>
            </table>
            <table style='margin-top: 5px; text-align: left;'>
              <tr>
                <th><label style='font-size:13px;'>Complete Drug Description</label></th>
              </tr>
              <tr>
                <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td>
                      <select name='pDrugCode' id='pDrugCode' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                        <option value='$aaa'>$drugdescauto</option>
                      </select>
                    </td>
                    <td width='5'></td>
                    <td><a href='http://192.168.0.200/2019codes/CF4Meds/MedSearchGen.php?Assign=Assign+Code&code=$productcode&gen=$generic' target='_blank' style='text-decoration: none;'><div align='center' style='color: red;'>&nbsp;Edit Generic Name&nbsp;</div></a></td>
                  </tr>
                </table></div></td>
              </tr>
            </table>
            <table style='margin-top: 15px; text-align: left;'>
              <tr>
                <th><label style='font-style: italic;font-weight: normal;'>Generic Name&nbsp;</label></th>
                <th><label style='font-style: italic;font-weight: normal;'>Salt&nbsp;</label></th>
                <th><label style='font-style: italic;font-weight: normal;'>Strength&nbsp;</label></th>
                <th><label style='font-style: italic;font-weight: normal;'>Form&nbsp;</label></th>
                <th><label style='font-style: italic;font-weight: normal;'>Unit&nbsp;</label></th>
                <th><label style='font-style: italic;font-weight: normal;'>Package</label></th>
              </tr>
              <tr>
                <td>
                  <select name='pGeneric' id='pGeneric' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$bbb' selected='selected'>$gendescauto</option>
                  </select>
                </td>
                <td>
                  <select name='pSalt' id='pSalt' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$ccc' selected='selected'>$saltdescauto</option>
                  </select>
                </td>
                <td>
                  <select name='pStrength' id='pStrength' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$ddd' selected='selected'>$strengthdescauto</option>
                  </select>
                </td>
                <td>
                  <select name='pForm' id='pForm' class='form-control' style='width:auto; margin:0px 10px 0px 0px;'>
                    <option value='$eee' selected='selected'>$formdescauto</option>
                  </select>
                </td>
                <td>
                  <select name='pUnit' id='pUnit' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$fff' selected='selected'>$unitdescauto</option>
                  </select>
                </td>
                <td>
                  <select name='pPackage' id='pPackage' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$ggg' selected='selected'>$packagedescauto</option>
                  </select>
                </td>
              </tr>
            </table>
  ";
  }
  else{
  echo "
  <input type='hidden' name='pDrugCode' value='' />
  <input type='hidden' name='pGeneric' value='' />
  <input type='hidden' name='pSalt' value='' />
  <input type='hidden' name='pStrength' value='' />
  <input type='hidden' name='pForm' value='' />
  <input type='hidden' name='pUnit' value='' />
  <input type='hidden' name='pPackage' value='' />
  ";
  $generic=$productdesc;
  $genoc="0";
  }

  if($genoc=="0"){
  echo "
            <table style='margin-top: 15px; text-align: left;'>
              <tbody>
                <tr>
                  <td>
                    <label style='font-size:13px;'>Generic Name/Salt/Strength/Form/Unit/Package</label>
                  </td>
                </tr>
                <tr>
                  <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><input type='text' name='pGenericFreeText' id='pGenericFreeText' class='form-control' value='$generic' style='width: 100%; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' autocomplete='off' maxlength='500' /></td>
";

if($mtcount==0){
echo "
                      <td><a href='http://192.168.0.200/2019codes/CF4Meds/MedSearchGen.php?Assign=Assign+Code&code=$productcode&gen=$generic' target='_blank' style='text-decoration: none;'><div align='center' style='color: red;'>&nbsp;Add Proper Generic Name&nbsp;</div></a></td>
";
}

echo "
                    </tr>
                  </table></div></td>
                </tr>
              </tbody>
            </table>
  ";
  }
  else{
  echo "
  <input type='hidden' name='pGenericFreeText' value='' />

  ";
  }

  echo "
            <table style='margin-top: 15px; text-align: left;'>
              <tbody>
                <tr>
                  <td><label style='font-size:13px;'>Route</label></td>
                  <td><label style='font-size:13px;'>Frequency</label></td>
                  <td></td>
                </tr>
                <tr>
                  <td>
                    <input type='text' name='pRoute' id='pRoute' class='form-control' value='$sroute' style='width: 220px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' maxlength='500' />
                  </td>

                  <td>
                    <input type='text' name='pFrequencyInstruction' id='pFrequencyInstruction' class='form-control' value='$sfreq' style='width: 220px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' maxlength='500' />
                  </td>
                </tr>
              </tbody>
            </table>
            <table style='margin-top: 15px; text-align: left;'>
              <tr>
                <td><label style='font-size:13px;'>Quantity</label></td>
                <td><label style='font-size:13px;'>Total Amount Price</label></td>
              </tr>
              <tr>
                <td>
                  <input type='text' name='pQuantity' id='pQuantity' class='form-control' value='$qty' style='width: 80px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' autocomplete='off' maxlength='5' onkeypress='return isNumberKey(event);' />
                </td>
                <td>
                  <input type='text' name='pTotalPrice' id='pTotalPrice' class='form-control' value='$tamt' style='width: 150px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' autocomplete='off' maxlength='15' onkeypress='return isNumberWithDecimalKey(event);' />
                </td>
              </tr>
            </table>
          </td>
          <td style='vertical-align: middle'><div align='center'>
            <input type='image' name='imageField' src='Resources/Button/AddMed-Out.png' id='ImageA' height='38' onmouseover=MM_swapImage('ImageA','','Resources/Button/AddMed-Over.png',1) onmouseout='MM_swapImgRestore()' title='Add Medicine' />
          </div></td>
          <input type='hidden' name='caseno' value='$caseno' />
          </form>
        </tr>
  ";
  }

  }
  //END AUTO MEDS--------------------------------------------------------------------------------------------------------------------------------------
}
else{
  $ertsql=mysqli_query($mycon3,"SELECT `hiscaseno`, `hispname`, `hisadt`, `hisddt`, `hisbdate` FROM `rthclaim` WHERE `caseno`='$caseno'");
  $ertcount=mysqli_num_rows($ertsql);
  if($ertcount!=0){
  $ertfetch=mysqli_fetch_array($ertsql);
  $hiscaseno=$ertfetch['hiscaseno'];

  //AUTO MEDS------------------------------------------------------------------------------------------------------------------------------------------
  $medisql=mysqli_query($conn,"SELECT `productdesc`, `productcode`, SUM(`quantity`) AS `quantity`, `sellingprice` FROM `productout` WHERE `caseno`='$hiscaseno' AND `productsubtype`='PHARMACY/MEDICINE' AND `trantype`='charge' AND `quantity` > 0 AND `gross` > 0 GROUP BY `productcode`");
  while($medifetch=mysqli_fetch_array($medisql)){
  $productcode=$medifetch['productcode'];
  $productdesc=$medifetch['productdesc'];
  $productdesc=str_replace("ams-","",$productdesc);
  $productdesc=str_replace("-med","",$productdesc);
  $productdesc=strtoupper($productdesc);

  //$qty=$medifetch['quantity'];
  //$ramt=$medifetch['sellingprice'];
  $qty=0;
  $tamt=0;
  $smedisql=mysqli_query($conn,"SELECT `quantity`, `sellingprice` FROM `productout` WHERE `productcode`='$productcode' AND `productsubtype`='PHARMACY/MEDICINE' AND `caseno`='$hiscaseno' AND `trantype`='charge' AND `quantity` > 0 AND `gross` > 0");
  while($smedifetch=mysqli_fetch_array($smedisql)){
    $sqty=$smedifetch['quantity'];
    $sspr=$smedifetch['sellingprice'];

    $tamt+=($sqty*$sspr);
    $qty+=$sqty;
  }
  //$tamt=$ramt*$qty;

  $mtsql=mysqli_query($outconnkmsci,"SELECT * FROM `medtranslator` WHERE `code`='$productcode'");
  $mtcount=mysqli_num_rows($mtsql);

  $sroute="";
  $sfreq="";
  $paisql=mysqli_query($conn,"SELECT `route`, `frequency` FROM `productoutaddinfo` WHERE `caseno`='$hiscaseno' AND `code`='$productcode'");
  $paifetch=mysqli_fetch_array($paisql);
  $sroute=$paifetch['route'];
  $sfreq=$paifetch['frequency'];

  //BEGIN FIND IF ALREADY ADDED
  $ifpre=0;
  if($mtcount!=0){
  while($dcfetch=mysqli_fetch_array($mtsql)){$dc=$dcfetch['drugcode'];}

  $fpsql=mysqli_query($conncf4,"SELECT * FROM `medicine` WHERE `pDrugCode`='$dc' AND `caseno`='$caseno'");
  $fpcount=mysqli_num_rows($fpsql);

  if($fpcount!=0){$ifpre+=1;}
  }
  else{
  $fpsql=mysqli_query($conncf4,"SELECT * FROM `medicine` WHERE `pGenericName`='$productdesc' AND `caseno`='$caseno'");
  $fpcount=mysqli_num_rows($fpsql);

  if($fpcount!=0){$ifpre+=1;}
  }
  //END FIND IF ALREADY ADDED

  if($ifpre==0){
  echo "
        <tr>
          <form name='CF4Part5AddMeds' method='post' action='CF4Part5Save.php'>
          <td>
  ";

  if($mtcount!=0){
  $aaa=$dc;

  $agsql=mysqli_query($outconnkmsci,"SELECT * FROM `phicmedicine` WHERE `drugcode`='$aaa'");
  while($agfetch=mysqli_fetch_array($agsql)){
  $drugdescauto=$agfetch['drugdesc'];
  $bbb=$agfetch['gencode'];
  $ccc=$agfetch['saltcode'];
  $eee=$agfetch['formcode'];
  $ddd=$agfetch['strengthcode'];
  $fff=$agfetch['unitcode'];
  $ggg=$agfetch['packagecode'];
  }

  //bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb
  $bbbsql=mysqli_query($outconnkmsci,"SELECT `gendesc` FROM `phicmedsgeneric` WHERE `gencode`='$bbb'");
  while($bbbfetch=mysqli_fetch_array($bbbsql)){$gendescauto=$bbbfetch['gendesc'];}

  //ccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc
  $cccsql=mysqli_query($outconnkmsci,"SELECT `saltdesc` FROM `phicmedssalt` WHERE `saltcode`='$ccc'");
  while($cccfetch=mysqli_fetch_array($cccsql)){$saltdescauto=$cccfetch['saltdesc'];}

  //ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd
  $dddsql=mysqli_query($outconnkmsci,"SELECT `strengthdesc` FROM `phicmedsstrength` WHERE `strengthcode`='$ddd'");
  while($dddfetch=mysqli_fetch_array($dddsql)){$strengthdescauto=$dddfetch['strengthdesc'];}

  //eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
  $eeesql=mysqli_query($outconnkmsci,"SELECT `formdesc` FROM `phicmedsform` WHERE `formcode`='$eee'");
  while($eeefetch=mysqli_fetch_array($eeesql)){$formdescauto=$eeefetch['formdesc'];}

  //fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
  $fffsql=mysqli_query($outconnkmsci,"SELECT `unitdesc` FROM `phicmedsunit` WHERE `unitcode`='$fff'");
  while($ffffetch=mysqli_fetch_array($fffsql)){$unitdescauto=$ffffetch['unitdesc'];}

  //ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg
  $gggsql=mysqli_query($outconnkmsci,"SELECT `packagedesc` FROM `phicmedspackage` WHERE `packagecode`='$ggg'");
  while($gggfetch=mysqli_fetch_array($gggsql)){$packagedescauto=$gggfetch['packagedesc'];}

  $generic="";

  $genoc="1";

  echo "
            <table>
              <tr>
                <td><label style='text-decoration: underline;'>MEDICINE</label></td>
              </tr>
            </table>
            <table style='margin-top: 5px; text-align: left;'>
              <tr>
                <th><label style='font-size:13px;'>Complete Drug Description</label></th>
              </tr>
              <tr>
                <td>
                  <select name='pDrugCode' id='pDrugCode' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$aaa'>$drugdescauto</option>
                  </select>
                </td>
              </tr>
            </table>
            <table style='margin-top: 15px; text-align: left;'>
              <tr>
                <th><label style='font-style: italic;font-weight: normal;'>Generic Name&nbsp;</label></th>
                <th><label style='font-style: italic;font-weight: normal;'>Salt&nbsp;</label></th>
                <th><label style='font-style: italic;font-weight: normal;'>Strength&nbsp;</label></th>
                <th><label style='font-style: italic;font-weight: normal;'>Form&nbsp;</label></th>
                <th><label style='font-style: italic;font-weight: normal;'>Unit&nbsp;</label></th>
                <th><label style='font-style: italic;font-weight: normal;'>Package</label></th>
              </tr>
              <tr>
                <td>
                  <select name='pGeneric' id='pGeneric' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$bbb' selected='selected'>$gendescauto</option>
                  </select>
                </td>
                <td>
                  <select name='pSalt' id='pSalt' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$ccc' selected='selected'>$saltdescauto</option>
                  </select>
                </td>
                <td>
                  <select name='pStrength' id='pStrength' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$ddd' selected='selected'>$strengthdescauto</option>
                  </select>
                </td>
                <td>
                  <select name='pForm' id='pForm' class='form-control' style='width:auto; margin:0px 10px 0px 0px;'>
                    <option value='$eee' selected='selected'>$formdescauto</option>
                  </select>
                </td>
                <td>
                  <select name='pUnit' id='pUnit' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$fff' selected='selected'>$unitdescauto</option>
                  </select>
                </td>
                <td>
                  <select name='pPackage' id='pPackage' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$ggg' selected='selected'>$packagedescauto</option>
                  </select>
                </td>
              </tr>
            </table>
  ";
  }
  else{
  echo "
  <input type='hidden' name='pDrugCode' value='' />
  <input type='hidden' name='pGeneric' value='' />
  <input type='hidden' name='pSalt' value='' />
  <input type='hidden' name='pStrength' value='' />
  <input type='hidden' name='pForm' value='' />
  <input type='hidden' name='pUnit' value='' />
  <input type='hidden' name='pPackage' value='' />
  ";
  $generic=$productdesc;
  $genoc="0";
  }

  if($genoc=="0"){
  echo "
            <table style='margin-top: 15px; text-align: left;'>
              <tbody>
                <tr>
                  <td>
                    <label style='font-size:13px;'>Generic Name/Salt/Strength/Form/Unit/Package</label>
                  </td>
                </tr>
                <tr>
                  <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><input type='text' name='pGenericFreeText' id='pGenericFreeText' class='form-control' value='$generic' style='width: 100%; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' autocomplete='off' maxlength='500' /></td>
";

if($mtcount==0){
echo "
                      <td><a href='http://192.168.0.100:100/2019codes/CF4Meds/MedSearchGen.php?Assign=Assign+Code&code=$productcode&gen=$generic' target='_blank' style='text-decoration: none;'><div align='center' style='color: red;'>&nbsp;Add Proper Generic Name&nbsp;</div></a></td>
";
}

echo "
                    </tr>
                  </table></div></td>
                </tr>
              </tbody>
            </table>
  ";
  }
  else{
  echo "
  <input type='hidden' name='pGenericFreeText' value='' />
  ";
  }

  echo "
            <table style='margin-top: 15px; text-align: left;'>
              <tbody>
                <tr>
                  <td><label style='font-size:13px;'>Route</label></td>
                  <td><label style='font-size:13px;'>Frequency</label></td>
                  <td></td>
                </tr>
                <tr>
                  <td>
                    <input type='text' name='pRoute' id='pRoute' class='form-control' value='$sroute' style='width: 220px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' maxlength='500' />
                  </td>

                  <td>
                    <input type='text' name='pFrequencyInstruction' id='pFrequencyInstruction' class='form-control' value='$sfreq' style='width: 220px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' maxlength='500' />
                  </td>
                </tr>
              </tbody>
            </table>
            <table style='margin-top: 15px; text-align: left;'>
              <tr>
                <td><label style='font-size:13px;'>Quantity</label></td>
                <td><label style='font-size:13px;'>Total Amount Price</label></td>
              </tr>
              <tr>
                <td>
                  <input type='text' name='pQuantity' id='pQuantity' class='form-control' value='$qty' style='width: 80px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' autocomplete='off' maxlength='5' onkeypress='return isNumberKey(event);' />
                </td>
                <td>
                  <input type='text' name='pTotalPrice' id='pTotalPrice' class='form-control' value='$tamt' style='width: 150px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' autocomplete='off' maxlength='15' onkeypress='return isNumberWithDecimalKey(event);' />
                </td>
              </tr>
            </table>
          </td>
          <td style='vertical-align: middle'><div align='center'>
            <input type='image' name='imageField' src='Resources/Button/AddMed-Out.png' id='ImageA' height='38' onmouseover=MM_swapImage('ImageA','','Resources/Button/AddMed-Over.png',1) onmouseout='MM_swapImgRestore()' title='Add Medicine' />
          </div></td>
          <input type='hidden' name='caseno' value='$caseno' />
          </form>
        </tr>
  ";
  }

  }
  }
  //END AUTO MEDS--------------------------------------------------------------------------------------------------------------------------------------
}

echo "
    </table>

    <div style='font-weight: normal;font-style: italic;font-size:11px;color:#8b0000'>Click 'Add Medicine' button to add medicine in the list.</div>
    <table id='tblResultsMeds' class='table table-bordered table-hover' style='font-weight: normal;font-size:11px;'>
      <thead>
      <tr>
        <th colspan='6'>List of Medicine</th>
        <th rowspan='2'></th>
      </tr>
      <tr>
        <th style='vertical-align: middle;' colspan='2'>Drug Description</th>
        <th style='vertical-align: middle;'>Route</th>
        <th style='vertical-align: middle;'>Frequency</th>
        <th style='vertical-align: middle;'>Quantity</th>
        <th style='vertical-align: middle;'>Total Amount Price</th>
      </tr>
      </thead>
      <tbody id='tblBodyMeds'>
";

$b=0;
$tp=0;
$bsql=mysqli_query($conncf4,"SELECT * FROM `medicine` WHERE `caseno`='$caseno'");
while($bfetch=mysqli_fetch_array($bsql)){
$b++;
$pDrugCode=$bfetch['pDrugCode'];
$pGenericName=$bfetch['pGenericName'];
$pRoute=$bfetch['pRoute'];
$pInstructionFrequency=$bfetch['pInstructionFrequency'];
$pQuantity=$bfetch['pQuantity'];
$pTotalAmtPrice=$bfetch['pTotalAmtPrice'];
$no=$bfetch['no'];

$tp+=$pTotalAmtPrice;

if($pDrugCode==""){
$desc=$pGenericName;
}
else{
$aaasql=mysqli_query($outconnkmsci,"SELECT `drugdesc` FROM `phicmedicine` WHERE `drugcode`='$pDrugCode'");
while($aaafetch=mysqli_fetch_array($aaasql)){$desc=$aaafetch['drugdesc'];}
}

echo "
        <tr>
          <td>$b</td>
          <td>$desc</td>
          <td>$pRoute</td>
          <td>$pInstructionFrequency</td>
          <td>$pQuantity</td>
          <td align='right'>$pTotalAmtPrice&nbsp;</td>
          <form name='CF4Part5Remove' method='post' id='RemoveCF4' action='CF4Part5Remove.php' ";?> onsubmit="return confirm('Are you sure you want to remove this entry?');" <?php echo ">
          <td width='100'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><a href='CF4Part5Edit.php?caseno=$caseno&count=$b' class='astyle'><img src='Resources/Button/Edit-S-Out.png' alt='Edit' width='auto' height='35' id='Image1$b' onmouseover=MM_swapImage('Image1$b','','Resources/Button/Edit-S-Over.png',0) onmouseout=MM_swapImgRestore() /></a></td>
              <td width='3'></td>
              <td><input type='image' name='imageField' src='Resources/Button/Remove-S-Out.png' id='ImageR$b' height='35' onmouseover=MM_swapImage('ImageR$b','','Resources/Button/Remove-S-Over.png',1) onmouseout='MM_swapImgRestore()' /></td>
            </tr>
          </table></div></td>
          <input type='hidden' name='caseno' value='$caseno' />
          <input type='hidden' name='no' value='$no' />
          </form>
        </tr>
";
}

echo "
        <tr>
          <th colspan='4' style='vertical-align: middle;'><div align='right'>TOTAL&nbsp;</div></th>
          <th style='vertical-align: middle;'><div align='right'>".number_format($tp,"2",".",",")."&nbsp;</div></th>
        </tr>
      </tbody>
    </table>

    <td width='10'></td>
  </tr>
";

echo "
  <tr>
    <td></td>
    <td><div align='right'><table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td height='60'><a href='../eClaimsTwo/3/CF4/?caseno=$caseno' class='astyle' target='_blank'><div align='right'><input type='button' class='btn btn-primary' value='PRINTABLE CF4' title='PRINTABLE CF4' style='margin: 10px 0px 0px 0px;' /></div></td>
        <td width='3'></td>
";

$zsql=mysqli_query($conncf4,"SELECT `pHciCaseNo`, `pHciTransNo` FROM `enlistment` WHERE `caseno`='$caseno'");
$zcount=mysqli_num_rows($zsql);

if($zcount!=0){
echo "
        <td height='60'><a href='CF4Part4.php?caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-primary' name='CF4 Part 4' value='CF4 Part 4' title='CF4 Part 4' style='margin: 10px 0px 0px 0px;' /></div></td>
        <td width='3'></td>
";
}

echo "
        <td height='60'><a href='CF4Part3.php?caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-primary' name='CF4 Part 3' value='CF4 Part 3' title='CF4 Part 3' style='margin: 10px 0px 0px 0px;' /></div></td>
        <td width='3'></td>
        <td height='60'><a href='CF4Part2.php?caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-primary' name='CF4 Part 2' value='CF4 Part 2' title='CF4 Part 2' style='margin: 10px 0px 0px 0px;' /></div></td>
        <td width='3'></td>
        <td height='60'><a href='CF4Part1.php?caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-primary' name='CF4 Part 1' value='CF4 Part 1' title='CF4 Part 1' style='margin: 10px 0px 0px 0px;' /></div></td>
        <td width='20'></td>
        <td><div align='right'><input type='submit' class='btn btn-primary' name='Next' value='Next' title='Save Entries' style='margin: 10px 0px 0px 0px;' /></div></td>
      </tr>
    </table></div></td>
    <td></td>
  </tr>
  <input type='hidden' name='caseno' value='$caseno' />
";

echo "
</table>
</div>
";

//---------------------------------------------------------------------------------------------------------------------------------------------------
/*ini_set("display_errors","On");
mysql_connect("192.168.0.8","mainserv","open");
mysql_select_db("kmsci");
$asql=mysql_query("SELECT * FROM admission WHERE caseno='$caseno'");
$acount=mysql_num_rows($asql);*/

?>
</body>
</html>
