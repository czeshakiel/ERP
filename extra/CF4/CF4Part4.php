<link href="res/css/jquery-ui-1.11.4.css" rel="stylesheet"><!--added by marv 01302018-->
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

var el = document.getElementById('RemoveCF4');

el.addEventListener('submit', function(){
    return confirm('Are you sure you want to remove this entry?');
}, false);
//-->
</script>
<?php
include('function.php');
include('function_global.php');

if(isset($_POST['savep4'])){
echo "
<div align='left'>
";

    include("CF4Part4Save.php");

echo "
</div>
";
}
else{
  if(isset($_POST['removecw'])){
echo "
<div align='left'>
";

    include("CF4Part4Remove.php");

echo "
</div>
";
  }
  else{
    if($dateadmitted==""){$dateadmitted=date("m-d-Y");}
    else{$dateadmitted=date("m-d-Y",strtotime($dateadmitted));}

    if($ddt==""){$datedischarged=date("m-d-Y");}
    else{$datedischarged=date("m-d-Y",strtotime($ddt));}

    $preda=preg_split("/\-/",$dateadmitted);
    $dastr=$preda[2]."-".$preda[0]."-".$preda[1];

    $da=preg_split("/\-/",$dastr);
    $daY=$da[0];
    $daM=$da[1];
    $daD=$da[2];

    $predd=preg_split("/\-/",$datedischarged);
    $ddstr=$predd[2]."-".$predd[0]."-".$predd[1];

    $ddstrp1=date('Y-m-d', strtotime('+1 day', strtotime($ddstr)));
    $dd=preg_split("/\-/",$ddstr);
    $ddY=$dd[0];
    $ddM=$dd[1];
    $ddD=$dd[2];

    $period = new DatePeriod(new DateTime($dastr), new DateInterval('P1D'), new DateTime($ddstrp1));

    $asd=(-1);
    foreach ($period as $date){$days[] = $date->format("d");}
    foreach ($period as $date){$months[] = $date->format("m");$asd+=1;}

    $asql=mysqli_query($conncf4,"SELECT * FROM `subjective` WHERE `caseno`='$caseno'");
    $acount=mysqli_num_rows($asql);
    if($acount!=0){
      $afetch=mysqli_fetch_array($asql);
      $pOtherComplaint=$afetch["pOtherComplaint"];
      $pSignsSymptoms=$afetch["pSignsSymptoms"];
      $pPainSite=$afetch["pPainSite"];
    }
    else{
      $pOtherComplaint="";
      $pSignsSymptoms="";
      $pPainSite="";
    }

    $listHeents = listHeent();
    $listChests = listChest();
    $listHearts = listHeart();
    $listAbs = listAbdomen();
    $listNeuro = listNeuro();
    $listGenitourinary = listGenitourinary();
    $listRectal = listDigitalRectal();
    $listSkinExtremities = listSkinExtremities();

//---------------------------------------------------------------------------------------------------------------------------------------------------

echo "
<div align='center'>
  <table style='width:100%;'>
    <tr>
      <td>
        <div class='alert alert-success' style='margin-bottom: 2px'>
          <label style='color:red;'>*</label><strong style='font-size: 16px'>COURSE IN THE WARD</strong>
        </div>
        <table id='tblCourseWard' class='table table-condensed table-bordered'>
          <col width='300'>
          <col width='auto'>
          <col width='110'>
          <thead>
            <tr>
              <th>DATE</th>
              <th>DOCTOR'S ORDER/ACTION</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
";

    $a=0;
    $werr=0;
    $asql=mysqli_query($conncf4,"SELECT * FROM `courseward` WHERE `caseno`='$caseno' ORDER BY `pDateAction`");
    while($afetch=mysqli_fetch_array($asql)){
      $a++;
      $pDateAction=$afetch['pDateAction'];
      $pDoctorsAction=$afetch['pDoctorsAction'];
      $no=$afetch['no'];

      $countda=strlen($pDateAction);
      $warn="";
      if($countda!=10){
        $warn="style='background-color: red;color: #FFFFFF;font-weight: bold;'";
        $werr+=1;
      }

      $pDateActionfmt=date("M d, Y",strtotime($pDateAction));

      $err="";
      if(stripos($pDoctorsAction, "%") !== FALSE){
        $err="<span style='font-family: arial;font-size: 9;color: red;'>*PLEASE REMOVE &quot;%&quot;.</span>";
      }

echo "
            <form method='post'";?> onsubmit="return confirm('Are you sure you want to remove this entry?');" <?php echo ">
            <tr>
              <td style='vertical-align: middle'><div align='center' class='arial16black' $warn>$pDateActionfmt</div></td>
              <td style='vertical-align: middle'>
                <textarea name='txtWardDocAction' id='txtWardDocAction' onkeyup='resizeTextAreaCf4();' class='form-control' rows='1' maxlength='1500' style='resize: none; width: 100%;height: 100px;text-transform: uppercase;'>$pDoctorsAction</textarea><br />$err
              </td>
              <td style='vertical-align: middle'><div align='center'>
                <table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td><a href='?cf4p4edit&caseno=$caseno&no=$no' class='astyle'><button type='button' class='btn btn-success btn-sm' title='Edit Course in Ward'><i class='icofont-edit-alt'></i></button></a></td>
                    <td width='3'></td>
                    <td><button type='submit' name='removecw' class='btn btn-danger btn-sm' title='Remove Course in Ward'><i class='icofont-ui-delete'></i></button></td>
                  </tr>
                </table>
              </div></td>
            </tr>
            <input type='hidden' name='no' value='$no' />
            </form>
";
    }

echo "
            <form method='post'>
            <tr>
              <td style='vertical-align: middle'><div align='center'>
                <table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td>
                      <select name='txtWardDateOrderM' class='form-control' style='width: 90px;text-transform: uppercase;'>
                        <option value='' disabled>Month</option>
";

    $pm=date("m");
    $bn=0;
    $mo = getDateMonth(true, '');
    foreach($mo as $key => $value) {

      if($daM==$ddM){
        if(in_array($key,$months)){$bn+=1;$disa="";}
        else{$bn=0;$disa="disabled";}
      }
      else{
        if(in_array($key,$months)){$bn+=1;$disa="";}
        else{$bn+=0;$disa="disabled";}
      }

      if($bn==1){$bdms="selected='selected'";}else{$bdms="";}


echo "
                        <option value='$key' $bdms $disa>$value</option>
";
    }


echo "
                      </select>
                    </td>
                    <td width='2'></td>
                    <td>
                      <select name='txtWardDateOrderD' class='form-control' style='width: 80px;text-transform: uppercase;'>
                        <option value='' disabled>Day</option>
";

    $pd=date("d");
    $cv=0;
    for($x=1;$x<=31;$x++){
      if($x<10){$y="0".$x;}else{$y=$x;}

      if(in_array($y,$days)){$cv+=1;$disb="";}
      else{$cv+=0;$disb="disabled";}

      if($cv==1){$bdds="selected='selected'";}else{$bdds="";}

echo "
                        <option $bdds $disb>$y</option>
";
    }


echo "
                      </select>
                    </td>
                    <td width='2'></td>
                    <td>
                      <select name='txtWardDateOrderY' class='form-control' style='width: 95px;text-transform: uppercase;'>
                        <option value='' disabled>Year</option>
";

    $py=date("Y");
    for($z=$preda[2];$z<=$predd[2];$z++){

      if($z==$py){$bdys="selected='selected'";}else{$bdys="";}
echo "
                        <option $bdys>$z</option>
";
    }


echo "
                      </select>
                    </td>
                  </tr>
                </table>
              </div></td>
              <td>
                <textarea name='txtWardDocAction' id='txtWardDocAction' onkeyup='resizeTextAreaCf4();' class='form-control' rows='1' maxlength='1500' style='resize: none; width: 100%;height: 100px;text-transform: uppercase;' autofocus></textarea>
              </td>
              <td style='vertical-align: middle'><div align='center'>
                <button type='submit' class='btn btn-primary btn-sm' name='savep4' title='Save Course in the Ward' style='width: 70px;'><i class='icofont-save'></i></button>
              </div></td>
            </tr>
            </form>
          </tbody>
        </table>
      </td>
    </tr>
  </table>
  <hr />
  <table boreder='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left'><a href='?cf4clear&bck=p4&caseno=$caseno'";?> onclick="return confirm('Clear CF4 Data?');" <?php echo "><input type='button' class='btn btn-danger' value='Clear CF4 Data' title='Clear CF4 Data' style='color: #FFFFFF;font-weight: bold;margin: 10px 0px 0px 0px;' /></a></div></td>
      <td><div align='right'>
        <table border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <!-- td><a href='../eClaimsTwo/3/CF4/?caseno=$caseno' class='astyle' target='_blank'><div align='right'><input type='button' class='btn btn-primary' value='PRINTABLE CF4' title='PRINTABLE CF4' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
            <td width='3'></td -->
";

    $zsql=mysqli_query($conncf4,"SELECT `pHciCaseNo`, `pHciTransNo` FROM `enlistment` WHERE `caseno`='$caseno'");
    $zcount=mysqli_num_rows($zsql);

    if($zcount!=0){
echo "
            <!-- td><a href='?cf4p5&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 5' value='CF4 Part 5' title='CF4 Part 5' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
            <td width='3'></td -->
            <td><a href='?cf4p3&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 3' value='CF4 Part 3' title='CF4 Part3' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
            <td width='3'></td>
";
    }

echo "
            <td><a href='?cf4p2&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 2' value='CF4 Part 2' title='CF4 Part2' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
            <td width='3'></td>
            <td><a href='?cf4p1&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 1' value='CF4 Part 1' title='CF4 Part1' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
            <!-- td width='20'></td>
            <td><a href='?cf4p5&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-primary' value='Save Entries' title='Save Entries' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></a></td -->
          </tr>
        </table>
      </div></td>
    </tr>
  </table>
</div>
";
  }
}
//---------------------------------------------------------------------------------------------------------------------------------------------------


?>
