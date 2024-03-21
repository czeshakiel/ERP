<?php
ini_set("display_errors","On");
include("query.php");

echo "
<!doctype html>
<html>
<head>
  <meta charset='utf-8'>
  <title>BILLING EXPRESS - $heading</title>
  <link rel='icon' href='../../main/assets/favicon/favicon.png' type='image/png' />
  <link rel='shortcut icon' href='../../main/assets/favicon/favicon.png' type='image/png' />
  <link href='../Resources/CSS/mystyle.css' rel='stylesheet' type='text/css' />
  <link rel='stylesheet' href='css/animation.css'>
  <!-- plugin css file  -->
  <link rel='stylesheet' href='../../main/assets/plugin/datatables/responsive.dataTables.min.css'>
  <link rel='stylesheet' href='../../main/assets/plugin/datatables/dataTables.bootstrap5.min.css'>
  <style>
    .navbarcs {overflow: hidden;background-color: #474583;}
    .navbarcs a {float: left;font-size: 16px;color: white;text-align: center;padding: 14px 16px;text-decoration: none;}
    .dropdowncs {float: left;overflow: hidden;}
    .dropdowncs .dropbtn {font-size: 16px;border: none;outline: none;color: white;padding: 14px 16px;background-color: inherit;font-family: inherit;margin: 0;}
    .navbarcs a:hover, .dropdowncs:hover .dropbtn {background-color: red;}
    .dropdowncs-content {display: none;position: absolute;background-color: #f9f9f9;min-width: 160px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 1;}
    .dropdowncs-content a {float: none;color: black;padding: 12px 16px;text-decoration: none;display: block;text-align: left;}
    .dropdowncs-content a:hover {background-color: #ddd;}
    .dropdowncs-content span {float: none;color: black;padding: 12px 16px;text-decoration: none;display: block;text-align: left;font-size: 16px;cursor: pointer;}
    .dropdowncs-content span:hover {background-color: #ddd;}
    .istyle .iall:hover {color: #FF0000;opacity: 1;cursor: pointer;}
    .dropdowncs:hover .dropdowncs-content {display: block;}
    .buttonstyle .butt:hover {opacity: 0.8;cursor: pointer;}

    .tabstyle .tab {padding: 5px 20px;font-family: Arial;font-weight: bold;font-size: 16px;color: #000000;}
    .tabstyle .tab:hover {background-color: #FF0000;color: #FFFFFF;}
    .tabstyle .tabselect {padding: 5px 20px;font-family: Arial;font-weight: bold;font-size: 16px;color: #FFFFFF;background-color: #FF0000;}
    .tabstyle .tabselect:hover {opacity: 0.4;}

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

        .quadrat {
          -webkit-animation: NAME-YOUR-ANIMATION 1s infinite;  /* Safari 4+ */
          -moz-animation: NAME-YOUR-ANIMATION 1s infinite;  /* Fx 5+ */
          -o-animation: NAME-YOUR-ANIMATION 1s infinite;  /* Opera 12+ */
          animation: NAME-YOUR-ANIMATION 1s infinite;  /* IE 10+, Fx 29+ */
        }

        @-webkit-keyframes NAME-YOUR-ANIMATION {
          0%, 49% {
            background-color: #FFFFFF;
            color: #000000;
            height: 100%;
          }
          50%, 100% {
            background-color: #FF0000;
            color: #FFFFFF;
            height: 100%;
          }
        }

        .hmoblinker {
          -webkit-animation: blinker 1s infinite;  /* Safari 4+ */
          -moz-animation: blinker 1s infinite;  /* Fx 5+ */
          -o-animation: blinker 1s infinite;  /* Opera 12+ */
          animation: blinker 1s infinite;  /* IE 10+, Fx 29+ */
        }

        @-webkit-keyframes blinker {
          0%, 49% {
            background-color: #E4D2AD;
            color: #000000;
            height: 100%;
          }
          50%, 100% {
            background-color: #B005EC;
            color: #FFFFFF;
            height: 100%;
          }
        }
  </style>
  <!-- project css file  -->
  <link rel='stylesheet' href='../../main/assets/css/my-task.style.min.css'>
</head>
<body onload='placeFocus()'>
<div>
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
   
    <tr>
      <td><div class='navbarcs'>
";

include("navbar.php");

echo "
      </div></td>
    </tr>
    <tr>
      <td height='2'></td>
    </tr>
    <tr>
      <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td class='t3 b3' bgcolor='#FFFFFF'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='60%' valign='top'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='10' class='b1'></td>
                  <td class='b1'><div align='left' style='font-family: Cooper Black;font-size: 20px;font-weight: bold;color: #000000;text-shadow: 3px 3px 3px #2CBAE9;'>$patname</div></td>
                </tr>
                <tr>
                  <td colspan='2' heught='5'></td>
                </tr>

                <tr>
                  <td></td>
                  <td valign='top'><div align='left'><table border='0' width='0 cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' class='arial s14 black bold' style='font-size: 11px;'>GENDER:&nbsp;</td>
                      <td><div align='left' class='arial s18 black' style='font-size: 12px;'><u>$sex</u></div></td>
                      <td width='15'></td>
                      <td><div align='left' class='arial s14 black bold' style='font-size: 11px;'>BIRTH DATE:&nbsp;</td>
                      <td><div align='left' class='arial s18 black' style='font-size: 12px;'><u>".date("M d, Y",strtotime($dateofbirth))."</u></div></td>
                      <td width='15'></td>
                      <td><div align='left' class='arial s14 black bold' style='font-size: 11px;'>AGE:&nbsp;</td>
                      <td><div align='left' class='arial s18 black' style='font-size: 12px;'><u>$age</u></div></td>
                      <td width='15'></td>
                      <td><div align='left' class='arial s14 black bold' style='font-size: 11px;'>SENIOR/PWD:&nbsp;</td>
                      <td><div align='left' class='arial s18 black' style='font-size: 12px;'><u>$senior</u></div></td>
                      <td width='15'></td>
                    </tr>
                  </table></div></td>
                </tr>
                <tr>
                  <td colspan='2' height='5'></td>
                </tr>
                <tr>
                  <td></td>
                  <td valign='top'><div align='left'><table border='0' width='0 cellpadding='0' cellspacing='0'>
                    <tr>
                      <td valign='top'><div align='left' class='arial s14 black bold' style='font-size: 11px;'>ADDRESS:&nbsp;</td>
                      <td><div align='left' class='arial s18 black' style='font-size: 12px;'>".strtoupper($pataddress)."</div></td>
                      <td width='10'></td>
                    </tr>
                  </table></div></td>
                </tr>
                <tr>
                  <td colspan='2' heught='5' class='b1'></td>
                </tr>
                <tr>
                  <td colspan='2' heught='5'></td>
                </tr>
                <tr>
                  <td></td>
                  <td><div align='left'><table border='0' width='0 cellpadding='0' cellspacing='0'>
                    <tr>
                      <td valign='top'><div align='left' class='arial s14 black bold' style='font-size: 11px;'>PATIENT ID NO&nbsp;</td>
                      <td valign='top'><div align='center' class='arial s14 black bold' style='font-size: 11px;'>&nbsp;:&nbsp;</td>
                      <td><div align='left' class='arial s18 black' style='font-size: 12px;'>$patientidno</div></td>
                      <td width='10'></td>
                      <td width='5' class='l1'></td>
                      <td valign='top'><div align='left' class='arial s14 black bold' style='font-size: 11px;'>PHILHEALTH&nbsp;</td>
                      <td valign='top'><div align='center' class='arial s14 black bold' style='font-size: 11px;'>&nbsp;:&nbsp;</td>
                      <td><div align='left' class='arial s18 black' style='font-size: 12px;'>$phic</div></td>
                      <td width='10'></td>
                      <td width='5' class='l1'></td>
                      <td valign='top'><div align='left' class='arial s14 black bold' style='font-size: 11px;'>ROOM&nbsp;</td>
                      <td valign='top'><div align='center' class='arial s14 black bold' style='font-size: 11px;'>&nbsp;:&nbsp;</td>
                      <td><div align='left' class='arial s18 black' style='font-size: 12px;'>".strtoupper($room)."</div></td>
                      <td width='10'></td>
                    </tr>
                    <tr>
                      <td valign='top'><div align='left' class='arial s14 black bold' style='font-size: 11px;'>CASE NO&nbsp;</td>
                      <td valign='top'><div align='center' class='arial s14 black bold' style='font-size: 11px;'>&nbsp;:&nbsp;</td>
                      <td><div align='left' class='arial s18 black' style='font-size: 12px;'>$caseno</div></td>
                      <td></td>
                      <td class='l1'></td>
                      <td valign='top' class='$hmoblink'><div align='left' class='arial s14 bold' style='font-size: 11px;'>HMO&nbsp;</td>
                      <td valign='top' class='$hmoblink'><div align='center' class='arial s14 bold' style='font-size: 11px;'>&nbsp;:&nbsp;</td>
                      <td class='$hmoblink'><div align='left' class='arial s18' style='font-size: 12px;'>".strtoupper($hmo)."</div></td>
                      <td></td>
                      <td class='l1'></td>
                      <td valign='top'><div align='left' class='arial s14 black bold' style='font-size: 11px;'>DATE ADMITTED&nbsp;</td>
                      <td valign='top'><div align='center' class='arial s14 black bold' style='font-size: 11px;'>&nbsp;:&nbsp;</td>
                      <td><div align='left' class='arial s18 black' style='font-size: 12px;'>".date("M d, Y",strtotime($dateadmit))."</div></td>
                      <td></td>
                    </tr>
                  </table></div></td>
                </tr>
                <tr>
                  <td colspan='2' heught='5' class='b1'></td>
                </tr>
                <tr>
                  <td colspan='2' height='5'></td>
                </tr>
                <tr>
                  <td></td>
                  <td valign='top'><div align='left'><table border='0' width='0 cellpadding='0' cellspacing='0'>
                    <tr>
                      <td valign='top'><div align='left' class='arial s14 black bold' style='font-size: 11px;'>ATTENDING DOCTOR:&nbsp;</td>
                      <td><div align='left' class='arial s18 black' style='font-size: 12px;'>".strtoupper($aprel)."</div></td>
                      <td width='10'></td>
                    </tr>
                    <tr>
                      <td colspan='3' height='3'></td>
                    </tr>
                    <tr>
                      <td valign='top'><div align='left' class='arial s14 black bold' style='font-size: 11px;'>FINAL DIAGNOSIS:&nbsp;</td>
                      <td><div align='left' class='arial s18 black' style='font-size: 12px;'>".strtoupper($finaldiagnosis)."</div></td>
                      <td width='10'></td>
                    </tr>
                  </table></div></td>
                </tr>
                <tr>
                  <td colspan='2' height='5'></td>
                </tr>
              </table></td>
";


$pasql=mysqli_query($conn,"SELECT `caseno`, `dateadmit` FROM `admission` WHERE `patientidno`='$patientidno' AND (`caseno` LIKE 'I-%%' OR `caseno` LIKE 'R-%%') AND `caseno` NOT LIKE '$caseno' ORDER BY `dateadmit` DESC LIMIT 0,5");
$pacount=mysqli_num_rows($pasql);
echo "
              <td width='20%' class='l2' valign='top'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td height='5' colspan='3'></td>
                </tr>
                <tr>
                  <td width='5'></td>
                  <td><div align='left' class='arial s16 blue bold'>PREVIOUS ADMISSIONS</div></td>
                  <td width='5'></td>
                </tr>
                <tr>
                  <td height='5' colspan='3'></td>
                </tr>
";

if($pacount!=0){
echo "
                <tr>
                  <td></td>
                  <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td class='t1 b1' width='25'><div align='center' class='arial s14 black bold' style='font-size: 11px;'>#</div></td>
                      <td class='t1 b1 l1'><div align='center' class='arial s14 black bold' style='font-size: 11px;'>Date Admitted</div></td>
                      <td class='t1 b1 l1' width='70'><div align='center' class='arial s14 black bold' style='font-size: 11px;'>ICD/RVS</div></td>
                      <td class='t1 b1 l1' width='50'><div align='center' class='arial s14 black bold' style='font-size: 11px;'>View</div></td>
                    </tr>
";

$pa=0;
while($pafetch=mysqli_fetch_array($pasql)){
$pacaseno=$pafetch['caseno'];
$padateadmit=$pafetch['dateadmit'];
$pa++;

$pafcsql=mysqli_query($conn,"SELECT `icdcode` FROM `finalcaserate` WHERE `caseno`='$pacaseno' AND `level`='primary'");
$pafccount=mysqli_num_rows($pafcsql);
if($pafccount==0){
  $pafc="";
}
else{
  $pafcfetch=mysqli_fetch_array($pafcsql);
  $pafc=$pafcfetch['icdcode'];
}

$pascsql=mysqli_query($conn,"SELECT `icdcode` FROM `finalcaserate` WHERE `caseno`='$pacaseno' AND `level`='secondary'");
$pasccount=mysqli_num_rows($pascsql);
if($pasccount==0){
  $pasc="";
}
else{
  $pascfetch=mysqli_fetch_array($pascsql);
  $pasc="|".$pascfetch['icdcode'];
}

$fcsc=$pafc.$pasc;

echo "
                    <tr>
                      <td class='b1' width='25'><div align='center' class='arial s14 black bold' style='font-size: 11px;'>$pa</div></td>
                      <td class='b1 l1'><div align='left' class='arial s16 black'>&nbsp;".date("M d, Y",strtotime($padateadmit))."&nbsp;</div></td>
                      <td class='b1 l1' width='70'><div align='center' class='arial s16 black'>$fcsc</div></td>
                      <td class='b1 l1' width='50'><a href='../BillMe/?caseno=$pacaseno&user=$user&dept=BILLING' target='_blank' class='astyle'><div align='center' class='arial s16 black istyle'>&nbsp;<i class='demo-icon icon-eye-1 iall' style='font-size: 25px;'>&#xe8e5</i>&nbsp;</div></a></td>
                    </tr>
";
}

echo "
                  </table></td>
                  <td></td>
                </tr>
";
}

echo "
                <tr>
                  <td height='5' colspan='3'></td>
                </tr>
              </table></td>
";



echo "
              <td width='20%' class='l2' valign='top'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='1%' class='b1'></td>
                  <td width='49%' class='b1' colspan='4'><div align='left' class='arial s14 black bold' style='font-size: 11px;'>1st Case Rate</div></td>
                  <td width='1%' class='b1 l1'></td>
                  <td width='48%' class='b1' colspan='3'><div align='left' class='arial s14 black bold' style='font-size: 11px;'>2nd Case Rate</div></td>
                  <td width='1%' class='b1'></td>
                </tr>
                <tr>
                  <td class='b1' rowspan='3'></td>
                  <td class='b1 r1' width='20%' rowspan='3'><div align='center' class='arial s15 blue bold'>$crcode1</div></td>
                  <td class='b1 r1' width='4%'><div align='center' class='courier s13 black bold'>T</div></td>
                  <td class='b1' width='24%'><div align='right' class='courier s14 black bold'>".number_format(($p1+$h1),2)."</div></td>
                  <td class='b1' width='1%'></td>
                  <td class='b1 l1' rowspan='3'></td>
                  <td class='b1 r1' width='20%' rowspan='3'><div align='center' class='arial s15 blue bold'>$crcode2</div></td>
                  <td class='b1 r1' width='4%'><div align='center' class='courier s13 black bold'>T</div></td>
                  <td class='b1'width='24%'><div align='right' class='courier s14 black bold'>".number_format(($p2+$h2),2)."</div></td>
                  <td class='b1' rowspan='3'></td>
                </tr>
                <tr>
                  <td class='b1 r1'><div align='center' class='courier s13 black bold'>H</div></td>
                  <td class='b1'><div align='right' class='courier s14 black'>".number_format($h1,2)."</div></td>
                  <td class='b1'></td>
                  <td class='b1 r1'><div align='center' class='courier s13 black bold'>H</div></td>
                  <td class='b1'><div align='right' class='courier s14 black'>".number_format($h2,2)."</div></td>
                </tr>
                <tr>
                  <td class='b1 r1'><div align='center' class='courier s13 black bold'>P</div></td>
                  <td class='b1'><div align='right' class='courier s14 black'>".number_format($p1,2)."</div></td>
                  <td class='b1'></td>
                  <td class='b1 r1'><div align='center' class='courier s13 black bold'>P</div></td>
                  <td class='b1'><div align='right' class='courier s14 black'>".number_format($p2,2)."</div></td>
                </tr>
                <tr>
                  <td colspan='10' class='b1' height='5'></td>
                </tr>
";

$depsql=mysqli_query($conn,"SELECT `ofr`, `description`, `accttitle`, `amount`, `paymentTime`, `paidBy`, `datearray` FROM `collection` WHERE `acctno`='$caseno' AND `accttitle`='PATIENTS DEPOSIT'");
$depcount=mysqli_num_rows($depsql);
if($depcount!=0){
echo "
                <tr>
                  <td colspan='10'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='1%' class='b1'></td>
                      <td class='b1'><div align='left' class='arial s14 red bold'>Deposit/s</div></td>
                      <td width='1%' class='b1'></td>
                    </tr>
";


while($depfetch=mysqli_fetch_array($depsql)){
  $ofr=$depfetch['ofr'];
  $description=$depfetch['description'];
  $accttitle=$depfetch['accttitle'];
  $amount=$depfetch['amount'];
  $paymentTime=$depfetch['paymentTime'];
  $paidBy=$depfetch['paidBy'];
  $datearray=$depfetch['datearray'];

echo "
                    <tr>
                      <td width='1%' class='b1'></td>
                      <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td width='auto' class='b1'><div align='left' class='courier s12 black'>$accttitle<span class='s10 red'>($ofr)</div></div></td>
                          <td class='b1'><div align='center' class='courier s12 black'>$datearray</div></td>
                          <td class='b1'><div align='right' class='courier s12 black'>$amount</div></td>
                        </tr>
                      </table></td>
                      <td width='1%' class='b1'></td>
                    </tr>
";
}

echo "
                  </table></td>
                </tr>
";
}

if($result=="FINAL"){
  $disstat="<span style='color: #a905ff;font-weight: bold;font-size: 20px;font-family: Cooper Black;'>$status (SET AS FINAL)</span>";
  $fview="style='display: none;'";
}
else{
  $fview="";
  // if($status=="MGH"){
  //   $disstat="<span style='color: #ff6e05;font-weight: bold;font-size: 20px;font-family: Cooper Black;'>MAY GO HOME</span>";
  // }
  // else if($status=="WARNING"){
  //   $disstat="<span style='color: #ff0000;font-weight: bold;font-size: 20px;font-family: Cooper Black;'>WARNING</span>";
  // }
  // else if($status=="LOCKED"){
  //   $disstat="<span style='color: #8d0773;font-weight: bold;font-size: 20px;font-family: Cooper Black;'>LOCKED</span>";
  // }
  // else if($status=="YELLOW TAG"){
  //   $disstat="<span style='color: #ffaf05;font-weight: bold;font-size: 20px;font-family: Cooper Black;'>YELLOW TAG</span>";
  // }
  // else if($status=="Active"){
  //   $disstat="<span style='color: #000000;font-weight: bold;font-size: 20px;font-family: Cooper Black;'>ACTIVE</span>";
  // }
  // else{
    $disstat="<span style='color: #000000;font-weight: bold;font-size: 20px;font-family: Cooper Black;'>$status</span>";
  //}
}
//if($status != "discharged"){
echo "
                <tr>
                  <td colspan='10' height='90'><table border='0' width='100%' height='100%' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='30'><div align='center'>$disstat</div></td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='2'></td>
    </tr>
    <tr>
      <td height='50' style='padding-left: 5px;padding-right: 5px;'><div class='buttonstyle'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='200'><a href='setfinal.php?caseno=$caseno&nursename=$name&userunique=$user&branch=KMSCI&dept=$dept' $finalview $fview style='color:black;' onclick=return confirm('Do you wish to set final bill? Once you set final bill, you cannot update this record unless it is re-opened.');return false;><button type='button' style='background-color: #61D909;color: #000000;font-family: Arial;border: none;height: 30px;width: 150px;font-size: 16px;font-weight: bold;' class='butt'>Post All Payment</button></a>
          <a href='setfinalbill.php?caseno=$caseno&nursename=$name&userunique=$user&branch=KMSCI&dept=$dept' $setfinal $fview style='color:black;' onclick=return confirm('Do you wish to set final bill? Once you set final bill, you cannot update this record unless it is re-opened.');return false;><button type='button' style='background-color: #61D909;color: #000000;font-family: Arial;border: none;height: 30px;width: 150px;font-size: 16px;font-weight: bold;' class='butt'>Set Final</button></a>
          </td>
          <td><div align='center'><span class='h2' $color2>$warning2</span></td></td>
          <td width='200'></td>
        </tr>
      </table></div></td>
    </tr>
    <tr>
      <td height='2'></td>
    </tr>
    <tr>
      <td style='padding-left: 5px;padding-right: 5px;'>

        <div class='tabset bodyset'>
        <!-- Tab 1 -->
        <input type='radio' name='tabset' id='tab1' aria-controls='Charge' checked />
        <label for='tab1'>Charged&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <!-- Tab 1Beta -->
        <!-- input type='radio' name='tabset' id='tab1beta' aria-controls='Charge_beta' />
        <label for='tab1beta'>Charged (Beta)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label -->
        <!-- Tab 2 -->
        <input type='radio' name='tabset' id='tab2' aria-controls='Cash' />
        <label for='tab2'>Cash&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <!-- Tab 3 -->
        <input type='radio' name='tabset' id='tab3' aria-controls='Cart' $view $viewsel />
        <label for='tab3' $view $viewsel>Cart&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

          <div class='tab-panels'>
            <section id='Charge' class='tab-panel'>
              <h5 style='font-weight: bold;padding-left: 3px;'>Charge Items</h5>
";

include("allcharges.php");

echo "
            </section>
            <!-- section id='Charge_beta' class='tab-panel'>
              <h5 style='font-weight: bold;padding-left: 3px;'>Charge Items (Beta)</h5>
";

//include("allcharges_beta.php");

echo "
            </section -->
            <section id='Cash' class='tab-panel'>
              <h5 style='font-weight: bold;padding-left: 3px;'>Cash Items</h5>
";

include("allcash.php");

echo "
            </section>
            <section id='Cart' class='tab-panel' $view $viewsel>
              <h5 style='font-weight: bold;padding-left: 3px;'>Cart</h5>
";

include("cart.php");

echo "
            </section>
          </div>
        </div>

      </td>
    </tr>
    ";

    echo"
  </table>
</div>
";


echo "
<!-- Modal Fullscreen -->
<div class='modal fade' id='exampleModalFullscreen' tabindex='-1' aria-labelledby='exampleModalFullscreenLabel' aria-hidden='true' style='display: none;'>
  <div class='modal-dialog modal-fullscreen'>
    <div class='modal-content'>
      <div class='modal-header' style='border-bottom: 2px solid #8D8D8D;'>
        <h5 class='modal-title h2' id='exampleModalFullscreenLabel'><span style='color: #0075D7;font-weight: bold;font-size: 20px;'>Manual Discount</span></h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' style='color: red;' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
";

include("../AutoDistro/allmanualdiscount.php");

echo "
      </div>
      <div class='modal-footer' style='border-top: 2px solid #8D8D8D;'>
        <button type='button' class='btn btn-danger' data-bs-dismiss='modal' style='color: #FFFFFF;font-weight: bold;'>Close <i class='icofont-ui-close'></i></button>
      </div>
    </div>
  </div>
</div>
";


echo "
</body>
</html>
";
?>

<!-- Jquery Core Js -->
<script src='../../main/assets/bundles/libscripts.bundle.js'></script>
<!-- Plugin Js-->
<script src='../../main/assets/bundles/dataTables.bundle.js'></script>

<script>
  // project data table
  $(document).ready(function() {
    $('#myProjectTable')
    .addClass( 'nowrap' )
    .dataTable( {
      responsive: true,
      columnDefs: [
        { targets: [-1, -3], className: 'dt-body-right' }
      ]
    });
    $('.deleterow').on('click',function(){
      var tablename = $(this).closest('table').DataTable();
      tablename
        .row( $(this)
        .parents('tr') )
        .remove()
        .draw();
    } );
  });
</script>

<script>
  var myModal = new bootstrap.Modal(document.getElementById('leavereject'), {})
  myModal.show();
</script>
