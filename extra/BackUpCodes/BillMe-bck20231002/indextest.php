<?php
ini_set("display_errors","On");
include("query.php");

echo "
<!doctype html>
<html>
<head>
  <meta charset='utf-8'>
  <title>BILLING EXPRESS - $heading</title>
  <link rel='icon' href='../../image/logo/logo.png' type='image/png' />
  <link rel='shortcut icon' href='../../image/logo/logo.png' type='image/png' />
  <link href='../Resources/CSS/mystyle.css' rel='stylesheet' type='text/css' />
  <link rel='stylesheet' href='css/animation.css'>
  <style>
    .navbar {overflow: hidden;background-color: #333;}
    .navbar a {float: left;font-size: 16px;color: white;text-align: center;padding: 14px 16px;text-decoration: none;}
    .dropdown {float: left;overflow: hidden;}
    .dropdown .dropbtn {font-size: 16px;border: none;outline: none;color: white;padding: 14px 16px;background-color: inherit;font-family: inherit;margin: 0;}
    .navbar a:hover, .dropdown:hover .dropbtn {background-color: red;}
    .dropdown-content {display: none;position: absolute;background-color: #f9f9f9;min-width: 160px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 1;}
    .dropdown-content a {float: none;color: black;padding: 12px 16px;text-decoration: none;display: block;text-align: left;}
    .dropdown-content a:hover {background-color: #ddd;}
    .istyle .iall:hover {color: #FF0000;opacity: 1;cursor: pointer;}
    .dropdown:hover .dropdown-content {display: block;}
    .buttonstyle .butt:hover {opacity: 0.8;cursor: pointer;}

    .tabstyle .tab {padding: 5px 5px;font-family: Arial;font-weight: bold;font-size: 12px;color: #000000;}
    .tabstyle .tab:hover {background-color: #FF0000;color: #FFFFFF;}
    .tabstyle .tabselect {padding: 5px 5px;font-family: Arial;font-weight: bold;font-size: 10px;color: #FFFFFF;background-color: #FF0000;}
    .tabstyle .tabselect:hover {opacity: 0.4;}

    .h2 {
            font-size: 30px;
            font-family: Arial;
            font-weight: bold;
            animation: animate
                1.5s linear infinite;
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
  </style>
</head>
<body onload='placeFocus()'>
<div>
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td class='t3 b3'><table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='#4F52F5'>
        <tr>
          <td width='70%' height='50'><div align='left' class='arial s20 white bold' style='text-shadow: 0 0 3px #CCCCCC, 0 0 15px #000000;'><i class='demo-icon icon-info-circled' style='font-size: 25px;'>&#xe80c</i>BILLING EXPRESS - $heading</div></td>
          <td width='30%'><div align='right' class='courier s16 white bold'><i class='demo-icon icon-user' style='font-size: 20px;'>&#xe81b</i>$name&nbsp;</div></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='2'></td>
    </tr>
    <tr>
      <td><div class='navbar'>
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
          <td class='t3 b3' bgcolor='#E4D2AD'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='60%' valign='top'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='10' class='b1'></td>
                  <td class='b1'><div align='left' style='font-family: Cooper Black;font-size: 30px;font-weight: bold;color: #000000;text-shadow: 3px 3px 3px #2CBAE9;'>$patname</div></td>
                </tr>
                <tr>
                  <td colspan='2' heught='5'></td>
                </tr>

                <tr>
                  <td></td>
                  <td valign='top'><div align='left'><table border='0' width='0 cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' class='arial s14 black bold'>GENDER:&nbsp;</td>
                      <td><div align='left' class='arial s18 black'><u>$sex</u></div></td>
                      <td width='15'></td>
                      <td><div align='left' class='arial s14 black bold'>BIRTH DATE:&nbsp;</td>
                      <td><div align='left' class='arial s18 black'><u>".date("M d, Y",strtotime($dateofbirth))."</u></div></td>
                      <td width='15'></td>
                      <td><div align='left' class='arial s14 black bold'>AGE:&nbsp;</td>
                      <td><div align='left' class='arial s18 black'><u>$age</u></div></td>
                      <td width='15'></td>
                      <td><div align='left' class='arial s14 black bold'>SENIOR/PWD:&nbsp;</td>
                      <td><div align='left' class='arial s18 black'><u>$senior</u></div></td>
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
                      <td valign='top'><div align='left' class='arial s14 black bold'>ADDRESS:&nbsp;</td>
                      <td><div align='left' class='arial s18 black'>".strtoupper($pataddress)."</div></td>
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
                      <td valign='top'><div align='left' class='arial s14 black bold'>PATIENT ID NO&nbsp;</td>
                      <td valign='top'><div align='center' class='arial s14 black bold'>&nbsp;:&nbsp;</td>
                      <td><div align='left' class='arial s18 black'>$patientidno</div></td>
                      <td width='10'></td>
                      <td width='5' class='l1'></td>
                      <td valign='top'><div align='left' class='arial s14 black bold'>PHILHEALTH&nbsp;</td>
                      <td valign='top'><div align='center' class='arial s14 black bold'>&nbsp;:&nbsp;</td>
                      <td><div align='left' class='arial s18 black'>$phic</div></td>
                      <td width='10'></td>
                      <td width='5' class='l1'></td>
                      <td valign='top'><div align='left' class='arial s14 black bold'>ROOM&nbsp;</td>
                      <td valign='top'><div align='center' class='arial s14 black bold'>&nbsp;:&nbsp;</td>
                      <td><div align='left' class='arial s18 black'>".strtoupper($room)."</div></td>
                      <td width='10'></td>
                    </tr>
                    <tr>
                      <td valign='top'><div align='left' class='arial s14 black bold'>CASE NO&nbsp;</td>
                      <td valign='top'><div align='center' class='arial s14 black bold'>&nbsp;:&nbsp;</td>
                      <td><div align='left' class='arial s18 black'>$caseno</div></td>
                      <td></td>
                      <td class='l1'></td>
                      <td valign='top'><div align='left' class='arial s14 black bold'>HMO&nbsp;</td>
                      <td valign='top'><div align='center' class='arial s14 black bold'>&nbsp;:&nbsp;</td>
                      <td><div align='left' class='arial s18 black'>".strtoupper($hmo)."</div></td>
                      <td></td>
                      <td class='l1'></td>
                      <td valign='top'><div align='left' class='arial s14 black bold'>DATE ADMITTED&nbsp;</td>
                      <td valign='top'><div align='center' class='arial s14 black bold'>&nbsp;:&nbsp;</td>
                      <td><div align='left' class='arial s18 black'>".date("M d, Y",strtotime($dateadmit))."</div></td>
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
                      <td valign='top'><div align='left' class='arial s14 black bold'>ATTENDING DOCTOR:&nbsp;</td>
                      <td><div align='left' class='arial s18 black'>".strtoupper($ap)."</div></td>
                      <td width='10'></td>
                    </tr>
                    <tr>
                      <td colspan='3' height='3'></td>
                    </tr>
                    <tr>
                      <td valign='top'><div align='left' class='arial s14 black bold'>FINAL DIAGNOSIS:&nbsp;</td>
                      <td><div align='left' class='arial s18 black'>".strtoupper($finaldiagnosis)."</div></td>
                      <td width='10'></td>
                    </tr>
                  </table></div></td>
                </tr>
                <tr>
                  <td colspan='2' height='5'></td>
                </tr>
              </table></td>
";


$pasql=mysqli_query($mycon1,"SELECT `caseno`, `dateadmit` FROM `admission` WHERE `patientidno`='$patientidno' AND (`caseno` LIKE 'I-%%' OR `caseno` LIKE 'R-%%') AND `caseno` NOT LIKE '$caseno' ORDER BY `dateadmit` DESC LIMIT 0,5");
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
                      <td class='t1 b1' width='25'><div align='center' class='arial s14 black bold'>#</div></td>
                      <td class='t1 b1 l1'><div align='center' class='arial s14 black bold'>Date Admitted</div></td>
                      <td class='t1 b1 l1' width='70'><div align='center' class='arial s14 black bold'>ICD/RVS</div></td>
                      <td class='t1 b1 l1' width='50'><div align='center' class='arial s14 black bold'>View</div></td>
                    </tr>
";

$pa=0;
while($pafetch=mysqli_fetch_array($pasql)){
$pacaseno=$pafetch['caseno'];
$padateadmit=$pafetch['dateadmit'];
$pa++;

echo "
                    <tr>
                      <td class='b1' width='25'><div align='center' class='arial s14 black bold'>$pa</div></td>
                      <td class='b1 l1'><div align='left' class='arial s16 black'>&nbsp;".date("M d, Y",strtotime($padateadmit))."&nbsp;</div></td>
                      <td class='b1 l1' width='70'><div align='center' class='arial s16 black'></div></td>
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
                  <td width='49%' class='b1' colspan='4'><div align='left' class='arial s14 black bold'>1st Case Rate</div></td>
                  <td width='1%' class='b1 l1'></td>
                  <td width='48%' class='b1' colspan='3'><div align='left' class='arial s14 black bold'>2nd Case Rate</div></td>
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
";

if($result=="FINAL"){
  $disstat="<span style='color: #a905ff;font-weight: bold;font-size: 20px;font-family: Cooper Black;'>SET AS FINAL</span>";
}
else{
  if($status=="MGH"){
    $disstat="<span style='color: #ff6e05;font-weight: bold;font-size: 20px;font-family: Cooper Black;'>MAY GO HOME</span>";
  }
  else if($status=="WARNING"){
    $disstat="<span style='color: #ff0000;font-weight: bold;font-size: 20px;font-family: Cooper Black;'>WARNING</span>";
  }
  else if($status=="LOCKED"){
    $disstat="<span style='color: #8d0773;font-weight: bold;font-size: 20px;font-family: Cooper Black;'>LOCKED</span>";
  }
  else if($status=="YELLOW TAG"){
    $disstat="<span style='color: #ffaf05;font-weight: bold;font-size: 20px;font-family: Cooper Black;'>YELLOW TAG</span>";
  }
  else{
    $disstat="<span style='color: #000000;font-weight: bold;font-size: 20px;font-family: Cooper Black;'>ACTIVE</span>";
  }
}

echo "
                <tr>
                  <td colspan='10' height='120'><table border='0' width='100%' height='100%' cellpadding='0' cellspacing='0'>
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
      <td height='50'><div class='buttonstyle'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='200'><a href='setfinal.php?caseno=$caseno&nursename=$name&userunique=$user&branch=KMSCI&dept=$dept' style='color:black;' onclick=return confirm('Do you wish to set final bill? Once you set final bill, you cannot update this record unless it is re-opened.');return false;><button type='button' style='background-color: #61D909;color: #000000;font-family: Arial;border: none;height: 30px;width: 150px;font-size: 16px;font-weight: bold;' class='butt'>Set Final Bill</button></a></td>
          <td><div align='center'><span class='h2' $color2>$warning2</span></td></td>
          <td width='200'></td>
        </tr>
      </table></div></td>
    </tr>
    <tr>
      <td height='2'></td>
    </tr>
    <tr>
      <td>

        <div class='tabset bodyset'>
        <!-- Tab 1 -->
        <input type='radio' name='tabset' id='tab1' aria-controls='Charge' checked />
        <label for='tab1'>Charged&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <!-- Tab 2 -->
        <input type='radio' name='tabset' id='tab2' aria-controls='Cash' />
        <label for='tab2'>Cash&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <!-- Tab 3 -->
        <input type='radio' name='tabset' id='tab3' aria-controls='Cart' />
        <label for='tab3'>Cart&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

          <div class='tab-panels'>
            <section id='Charge' class='tab-panel'>
              <h2>Charge Items</h2>
";

include("charges.php");

echo "
            </section>
            <section id='Cash' class='tab-panel'>
              <h2>Cash Items</h2>
";

include("allcash.php");

echo "
            </section>
            <section id='Cart' class='tab-panel'>
              <h2>Cart</h2>
              <iframe src='http://$setip/cgi-bin/wah/chargingwindowbill.cgi?caseno=$caseno&dept=$dept&branch=KMSCI&nursename=$name&newbill=1' title='Charge Cart' style='border: none;' width='100%' height='900px'></iframe>
            </section>
          </div>
        </div>

      </td>
    </tr>
  </table>
</div>
</body>
</html>
";
?>
