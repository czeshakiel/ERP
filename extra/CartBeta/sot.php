<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home Meds</title>
<link href="../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript">
<!--
function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[0].elements[i].focus();
break;
         }
      }
   }
}
//-->
</script>

</head>

<body onload="placeFocus()">
<?php
include("../../main/class.php");
ini_set("display_erros","On");

session_start();

$searchme=$_GET['searchme'];
$caseno=$_GET['caseno'];
$dept=$_GET['dept'];
$ct=$_GET['ct'];
$tick=$_GET['tick'];
$at=$_GET['at'];
$cl=$_GET['cl'];

$len=strlen($searchme);

$cac=base64_decode($_SESSION['cac']);

//SERVICES AND OTHERS START------------------------------------------------------------------------
  if($len>1){
    if($ct=="sot"){
      $adexc="";
      $zzsql=mysqli_query($conn,"SELECT `accounttitle` FROM `accounttitle` WHERE `grp`='SUPPLIES'");
      $zzcount=mysqli_num_rows($zzsql);
      while($zzfetch=mysqli_fetch_array($zzsql)){
        $zzacc=$zzfetch['accounttitle'];

        $adexc=$adexc." AND `unit` NOT LIKE '$zzacc'";
      }

      if($dept=="BILLING"){
        if((stripos($caseno, "I-") !== FALSE)||(stripos($caseno, "O-") !== FALSE)){
          $adexc=$adexc." AND unit NOT LIKE 'LABORATORY' AND unit NOT LIKE 'XRAY' AND unit NOT LIKE 'HEARTSTATION' AND unit NOT LIKE 'ULTRASOUND' AND unit NOT LIKE 'EEG' AND unit NOT LIKE 'CT SCAN' AND unit NOT LIKE 'ECG'";
        }
      }

      $zxsql=mysqli_query($conn,"SELECT * FROM `receiving` WHERE `description` LIKE '%$searchme%' AND `unit` NOT LIKE '%medicine%' AND `unit` NOT LIKE '%PHARMACY%' AND `unit` NOT LIKE '%ACCOUNTABLE%' AND `unit` NOT LIKE '%-SUPPLIES%' AND `unit` NOT LIKE '%LABORATORY SUPPLIES%' AND `unit` NOT LIKE 'GENERAL SUPPLIES' AND `unit` NOT LIKE '%CSR/KIT%' AND `unit` NOT LIKE 'RADIOLOGY SUPPLIES' AND `unit` NOT LIKE 'RESPIRATORY SUPPLIES' AND `unit` NOT LIKE 'STERILIZATION SUPPLIES' AND `unit` NOT LIKE 'ULTRASOUND SUPPLIES' AND `unit` NOT LIKE 'PT SUPPLIES' AND `unit` NOT LIKE 'PLUMBING' AND `unit` NOT LIKE '%OFFICE%%SUPPLIES%' AND `unit` NOT LIKE '%Nonmedical Supplies%' AND `unit` NOT LIKE 'HEART STATION SUPPLIES' AND `unit` NOT LIKE 'LAUNDRY SUPPLIES' AND `unit` NOT LIKE 'ELECTRICAL SUPPLIES' AND `unit` NOT LIKE 'CT SCAN SUPPLIES' AND `unit` NOT LIKE 'Housekeeping Supplies' AND `unit` NOT LIKE 'Equipment' AND `unit` NOT LIKE 'COMPUTER EQUIPMENT AND ACCESS' AND `unit` NOT LIKE 'HOSPITAL EQUIPMENT' AND `unit` NOT LIKE 'COMPUTER SUPPLIES' AND `unit` NOT LIKE 'LAUNDRY' AND `unit` NOT LIKE 'CENTRAL SUPPLIES' AND `unit` NOT LIKE '%MEDICAL SURGICAL SUPPLIES%' AND `unit` NOT LIKE 'MISCELLANEOUS SUPPLIES' AND `unit` NOT LIKE 'HOSPITAL CSR KIT' AND `unit` NOT LIKE 'ECG SUPPLIES' AND `unit` NOT LIKE '%ECG SUPPLIES%' AND `unit` NOT LIKE '%DIALYSIS%' AND `unit` NOT LIKE 'NEWBORN SCREENING SUPPLIES' AND `unit` NOT LIKE 'OTHERS' AND `unit` NOT LIKE '' $adexc ORDER BY itemname");
      $zxcount=mysqli_num_rows($zxsql);

      if($zxcount==0){
echo "
      <div align='left' style='font-family: arial;font-size: 16px;font-weight: bold;color: #FF0000;'>0 results found!!!</div>
";
      }
      else{
echo "
        <table border='0' cellpadding='0' cellspacing='0' class='hoverTable'>
          <tr>
            <td class='t2 b2 l2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;padding: 3px 5px;'>#</div></td>
            <td class='t2 b2 l1'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;padding: 3px 5px;'>Description</div></td>
            <td class='t2 b2 l1'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;padding: 3px 5px;'>Action</div></td>
            <td class='t2 b2 l1 r2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;padding: 3px 5px;'>Type</div></td>
          </tr>
";

        $zx=0;
        while($zxfetch=mysqli_fetch_array($zxsql)){
          $cod=$zxfetch['code'];
          $itn=mb_strtoupper($zxfetch['itemname']);
          $itnor=$zxfetch['itemname'];
          $unt=$zxfetch['unit'];
          $gte=$zxfetch['gtestcode'];
          $op4=$zxfetch['optset4'];
          $zx++;

          if(($dept=="PHARMACY")&&(stripos($op4, "-1|") !== FALSE)){$gte=1;}//disable pharmacy only
          if((($dept=="PHARMACY_OPD")||($dept=="pharmacy_opd"))&&(stripos($op4, "-2|") !== FALSE)){$gte=1;}//disable pharmacy opd only
          if((($dept=="CSR2")||($dept=="csr2"))&&(stripos($op4, "-3|") !== FALSE)){$gte=1;}//disable csr2 only
          if(($dept=="BILLING")&&(stripos($op4, "-4|") !== FALSE)){$gte=1;}//disable billing only
          if(($dept=="NS1")&&(stripos($op4, "-5|") !== FALSE)){$gte=1;}//disable ns1 only
          if(($dept=="NS2")&&(stripos($op4, "-6|") !== FALSE)){$gte=1;}//disable ns2 only
          if(($dept=="NS3")&&(stripos($op4, "-7|") !== FALSE)){$gte=1;}//disable ns3 only
          if(($dept=="NS 4")&&(stripos($op4, "-8|") !== FALSE)){$gte=1;}//disable ns4 only
          if(($dept=="NS 5A")&&(stripos($op4, "-9|") !== FALSE)){$gte=1;}//disable ns5a only
          if(($dept=="NS 5B")&&(stripos($op4, "-10|") !== FALSE)){$gte=1;}//disable nsb only
          if(($dept=="NS 6")&&(stripos($op4, "-11|") !== FALSE)){$gte=1;}//disable ns6 only
          if(($dept=="ER")&&(stripos($op4, "-12|") !== FALSE)){$gte=1;}//disable er only

          if((stripos($op4, "-99|") !== FALSE)&&(stripos($caseno, "I-") !== FALSE)){$gte=1;}//disable in patient only
          if((stripos($op4, "-100|") !== FALSE)&&(stripos($caseno, "I-") !== TRUE)){$gte=1;}//disable out patient only

          $cashonly=1;
          $chargeonly=1;
          if((stripos($op4, "-101|") !== FALSE)&&(stripos($caseno, "I-") !== FALSE)){$cashonly=0;}//disable charge and tpl button for in patient
          if((stripos($op4, "-102|") !== FALSE)&&(stripos($caseno, "I-") !== FALSE)){$chargeonly=0;}//disable cash button for in patient

          $ronl="";
          if((stripos($unt, "LABORATORY") !== FALSE)||(stripos($unt, "CT SCAN") !== FALSE)||(stripos($unt, "ULTRASOUND") !== FALSE)||(stripos($unt, "ECG") !== FALSE)||(stripos($unt, "XRAY") !== FALSE)||(stripos($unt, "EEG") !== FALSE)){
            $ronl="readonly";
          }

          //$zvsql=mysqli_query($conn,"SELECT `opd`, `philhealth` FROM `productsmasterlist` WHERE `code`='$cod'");
          //if(mysqli_num_rows($zvsql)==0){
            //$op=0;
            //$ph=0;
          //}
          //else{
            //$zvfetch=mysqli_fetch_array($zvsql);
            //$op=$zvfetch['opd'];
            //$ph=$zvfetch['philhealth'];
          //}

          $qtdis="";
          if($gte==1){$qtdis="disabled";}
echo "
          <tr>
            <td class='b1 l2'><div align='left' style='font-family: arial;font-weight: bold;font-size: 14px;color: #000000;padding: 3px 5px;'>$zx</div></td>
            <td class='b1 l1'><div align='left' style='font-family: arial;font-weight: bold;font-size: 14px;color: #000000;padding: 3px 5px;' title='$cod'>$itn</div></td>
            <td class='b1 l1'><div align='left' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>
              <form method='post'>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td width='60'><div align='center' style='padding: 3px 5px;'><input type='number' style='height: 30px;width: 60px;border-radius: 5px;border: 2px solid #000000;' placeholder='Qty.' name='qty' value='1' $qtdis $ronl /></div></td>
";

          if($gte==1){
echo "
                    <td><div align='center' style='font-family: arial;font-weight: bold;font-size: 14px;color: #FF0000;'>DISABLED</div></td>
";
          }
          else{
echo "
                    <td>
                      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                        <tr>
";
            $kcst=preg_split("/\-/",$caseno);
            if($at<=$cl){
              if(($kcst[0]!="W")&&($kcst[0]!="WD")){
                if(stripos($caseno, "C2") !== FALSE){
                }
                else{
                  if($cashonly==1){
echo "
                          <td><div align='center' style='padding: 3px 2px;'><button type='submit' name='trantype' value='charge' class='btn'>Charge</button></div></td>
";
                  }
                }
              }
            }

            if($kcst[0]!="AR"){
              if($chargeonly==1){
echo "
                          <td><div align='center' style='padding: 3px 2px;'><button type='submit' name='trantype' value='cash' class='btn cancel'>Cash</button></div></td>
";
              }
            }

            if(($cac=="4")||($cac=="5")){
              if(stripos($caseno, "C2") !== FALSE){
              }
              else{
                if($cashonly==1){
echo "
                          <td><div align='center' style='padding: 3px 2px;'><button type='submit' name='trantype' value='tpl' class='btn tpl'>TPL</button></div></td>
";
                }
              }
            }

echo "
                        </tr>
                      </table>
                    </td>
";
          }

echo "
                  </tr>
                </table>
                <input type='hidden' name='itmcode' value='$cod' />
                <input type='hidden' name='itmtype' value='$unt' />
                <input type='hidden' name='itmname' value='$itnor' />
";

if($unt=="LABORATORY"){
echo "
                <input type='hidden' name='addchrmks' />
";
}
else{
  if($cod=="210906184316p-50"){
echo "
                <input type='hidden' name='addchrmks' />
";
  }
  else{
    if(($cod=="11334620210406")||($cod=="210505100721p-50")){
echo "
                <input type='hidden' name='oncall' />
";
    }
    else{
echo "
                <input type='hidden' name='addch' />
";
    }
  }
}

echo "
              </form>
            </div></td>
            <td class='b1 l1 r2'><div align='center' style='font-family: arial;font-weight: bold;font-size: 14px;color: #03A3CD;padding: 3px 5px;'>$unt</div></td>
          </tr>
";
        }

echo "
          <tr>
            <td class='t2'></td>
            <td class='t2'></td>
            <td class='t2'></td>
            <td class='t2'></td>
          </tr>
        </table>
";
      }
    }
  }
//SERVICES AND OTHERS END--------------------------------------------------------------------------
?>
</body>
</html>
