<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../image/logo/logo.png" type="image/png" />
<link rel="shortcut icon" href="../image/logo/logo.png" type="image/png" />
<title>Claim Form 2 Front</title>
<link href="Resources/CSS/style.css" rel="stylesheet" type="text/css" />
<link href="Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
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
<style type="text/css">
<!--

-->
</style>
</head>

<body onload="placeFocus()">

<?php
ini_set("display_errors","On");
include("../2020codes/Settings.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$caseno=mysql_real_escape_string($_GET['caseno']);

$cursty="style='cursor: pointer;'";

include("access.php");
include("Popup/PUS-Doctor.php");





			echo"
			<div align='center'>
			  <table width='730' border='0' cellpadding='0' cellspacing='0'>
			    <tr>
			      <td class='t2 b2 l2 r2'>
			        <table width='100%' border='0' cellpadding='0' cellspacing='0'>
			          <tr>
			            <td class='b2'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			              <tr>
			                <td width='22%' valign='center'><div align='center'>
			                  <img src='philhealthlogo.png' width='auto' height='45' />
			                </div></td>
			                <td width='auto'><div align='center'>
			                  <table border='0' cellpadding='0' cellspacing='0'>
			                    <tr>
			                      <td><div align='center' class='times s10 black'><i>Republic of the Philippines</i></div></td>
			                    </tr>
			                    <tr>
			                      <td><div align='center' class='times s16 black bold'>PHILIPPINE HEALTH INSURANCE CORPORATION</div></td>
			                    </tr>
			                    <tr>
			                      <td><div align='center' class='times s10 black'> Citystate Centre 709 Shaw Boulevard, Pasig City</div></td>
			                    </tr>
			                    <tr>
			                      <td><div align='center' class='times s10 black'> Call Center (02) 441-7442 . Trunkline (02) 441-7444</div></td>
			                    </tr>
			                    <tr>
			                      <td><div align='center' class='times s10 black'>www.philhealth.gov.ph</div></td>
			                    </tr>
			                    <tr>
			                      <td><div align='center' class='times s10 black'>email: actioncenter@philhealth.gov.ph</div></td>
			                    </tr>
			                  </table>
			                </div></td>
			                <td width='22%'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td height='5'></td>
			                  </tr>
			                  <tr>
			                    <td><div align='center' class='tahoma s9 black'>This form may be reproduced and<br />is NOT FOR SALE</div></td>
			                  </tr>
			                  <tr>
			                    <td><div align='center' class='tahoma s44 black bold'>CF-2</div></td>
			                  </tr>
			                  <tr>
			                    <td><div align='center' class='tahoma s12 black bold'>(Claim Form 2)</div></td>
			                  </tr>
			                  <tr>
			                    <td height='5'></td>
			                  </tr>
			                  <tr>
			                    <td><div align='center' class='tahoma s12 black'>Revised September 2018</div></td>
			                  </tr>
			                  <tr>
			                    <td height='5'></td>
			                  </tr>
			                </table></div></td>
			              </tr>
			              <tr>
			                <td colspan='3'><div align='right' class='Tahoma12'>
			                  <table border='0' cellpadding='0' cellspacing='0'>
			                    <tr>
			                      <td valign='bottom'><div class='arial11blackbold'>Series #&nbsp;</div></td>
			                      <td colspan='2'><div align='right' class='tahoma s9 black'>
			                        <table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='18' height='18' class='t1 b1 l1'></td>
			                            <td width='18' class='t1 b1 l1'></td>
			                            <td width='18' class='t1 b1 l1'></td>
			                            <td width='18' class='t1 b1 l1'></td>
			                            <td width='18' class='t1 b1 l1'></td>
			                            <td width='18' class='t1 b1 l1'></td>
			                            <td width='18' class='t1 b1 l1'></td>
			                            <td width='18' class='t1 b1 l1'></td>
			                            <td width='18' class='t1 b1 l1'></td>
			                            <td width='18' class='t1 b1 l1'></td>
			                            <td width='18' class='t1 b1 l1'></td>
			                            <td width='18' class='t1 b1 l1'></td>
			                            <td width='18' class='t1 b1 l1 r1'></td>
			                          </tr>
			                        </table>
			                      </div></td>
			                      <td width='10'></td>
			                    </tr>
			                  </table>
			                </div></td>
			              </tr>
			              <tr>
			                <td colspan='3' height='3'></td>
			              </tr>
			            </table></td>
			          </tr>
			";


			echo "
			          <tr>
			            <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			              <tr>
			                <td colspan='2' height='3'></td>
			              </tr>
			              <tr>
			                <td width='5'></td>
			                <td><div align='left' class='tahoma s8 black bold'>IMPORTANT REMINDERS:</div></td>
			              </tr>
			              <tr>
			                <td></td>
			                <td><div align='left' class='tahoma s8 black'>PLEASE WRITE IN CAPITAL <b>LETTERS</b> AND <b> CHECK </b> THE APPROPRIATE BOXES.</div></td>
			              </tr>
			              <tr>
			                <td></td>
			                <td><div align='left' class='tahoma s8 black'>This form together with other supporting documents should be filled within sixty (60) calendar days from the date of discharge.</div></td>
			              </tr>
			              <tr>
			                <td></td>
			                <td><div align='left' class='tahoma s8 black'>All information, fields and trick boxes required in this form are necessary. Claim forms with incomplete information shall not be processed.</div></td>
			              </tr>
			              <tr>
			                <td></td>
			                <td><div align='left' class='tahoma s8 black bold'>FALSE/INCORRECT INFORMATION OR MISREPRESENTATION SHALL BE SUBJECT TO CRIMINAL, CIVIL OR ADMINISTRATIVE LIABILITIES.</div></td>
			              </tr>
			              <tr>
			                <td colspan='2' height='3'></td>
			              </tr>
			            </table></td>
			          </tr>
			";

			//START PART I-------------------------------------------------------------------------------------------------------------------
			echo "
			          <tr>
			            <td height='24' class='t1 b1 l1 r1' bgcolor='#000000'><div align='center' class='arial s12 white bold'>PART I. HEALTH CARE INSTITUTION (HCI) INFORMATION</div></td>
			          </tr>
			          <tr>
			            <td><table border='0' cellpadding='0' cellspacing='0' width='100%'>
			              <tr>
			                <td width='5'></td>
			                <td width='50%'><div align='left' class='tahoma s9 black bold'>1. Philhealth Accreditation Number (PAN) of Health Care Institution:&nbsp;</div></td>
			                <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td height='9'></td>
			                    <td class='b1' height='18' rowspan='2' width='18'><div align='center' class='tahoma s12 black'>$hc1</div></td>
			                    <td></td>
			                    <td class='b1' rowspan='2' width='18'><div align='center' class='tahoma s12 black'>$hc2</div></td>
			                    <td></td>
			                    <td class='b1' rowspan='2' width='18'><div align='center' class='tahoma s12 black'>$hc3</div></td>
			                    <td></td>
			                    <td class='b1' rowspan='2' width='18'><div align='center' class='tahoma s12 black'>$hc4</div></td>
			                    <td></td>
			                    <td class='b1' rowspan='2' width='18'><div align='center' class='tahoma s12 black'>$hc5</div></td>
			                    <td></td>
			                    <td class='b1' rowspan='2' width='18'><div align='center' class='tahoma s12 black'>$hc6</div></td>
			                    <td></td>
			                    <td class='b1' rowspan='2' width='18'><div align='center' class='tahoma s12 black'>$hc7</div></td>
			                    <td></td>
			                    <td class='b1' rowspan='2' width='18'><div align='center' class='tahoma s12 black'>$hc8</div></td>
			                    <td></td>
			                    <td class='b1' rowspan='2' width='18'><div align='center' class='tahoma s12 black'>$hc9</div></td>
			                    <td></td>
			                  </tr>
			                  <tr>
			                    <td height='9' class='l1'></td>
			                    <td class='l1'></td>
			                    <td class='l1'></td>
			                    <td class='l1'></td>
			                    <td class='l1'></td>
			                    <td class='l1'></td>
			                    <td class='l1'></td>
			                    <td class='l1'></td>
			                    <td class='l1'></td>
			                    <td class='l1'></td>
			                  </tr>
			                </table></div></td>
			                <td width='5'></td>
			              </tr>
			              <tr>
			                <td></td>
			                <td colspan='2'><table border='0' cellpadding='0' cellspacing='0' width='100%' >
			                  <tr>
			                    <td width='25%'><div align='left' class='tahoma s9 black bold' >2. Name of Health Care Institution:&nbsp;</div></td>
			                    <td class='b1' ><div align='left' class='tahoma s12 black' >ANTIPAS MEDCIAL SPECIALISTS HOSPITAL, INC.</div></td>
			                  </tr>
			                </table></td>
			                <td></td>
			              </tr>
			              <tr>
			                <td></td>
			                <td colspan='2'><table border='0' cellpadding='0' cellspacing='0' width='100%'>
			                  <tr>
			                    <td width='10%'><div align='left' class='tahoma s9 black bold'>3. Address: &nbsp;</div></td>
			                    <td class='b1'><div align='center' class='tahoma s12 black'>NATIONAL HIGHWAY, POBLACION</div></td>
			                    <td width='5'></td>
			                    <td class='b1'><div align='center' class='tahoma s12 black'>ANTIPAS</div></td>
			                    <td width='5'></td>
			                    <td class='b1'><div align='center' class='tahoma s12 black'>COTABATO</div></td>
			                  </tr>
			                  <tr>
			                    <td><div align='center' class='tahoma s9 blackbold'></div></td>
			                    <td><div align='center' class='tahoma s12 black'>Building Number and Street &nbsp;</div></td>
			                    <td></td>
			                    <td><div align='center' class='tahoma s12 black'>City/Municipality &nbsp;</div></td>
			                    <td></td>
			                    <td><div align='center' class='tahoma s12 black'>Province &nbsp;</div></td>
			                  </tr>
			                </table></td>
			                <td></td>
			              </tr>
			            </table></td>
			          </tr>
			          <tr>
			            <td height='10'></td>
			          </tr>
			";
			//END PART I---------------------------------------------------------------------------------------------------------------------


			//START PART II------------------------------------------------------------------------------------------------------------------
			echo "
			          <tr>
			            <td height='24' class='t1 b1 l1 r1' bgcolor='#000000'><div align='center' class='arial s12 white bold'>PART II. PATIENT CONFINEMENT INFORMATION</div></td>
			          </tr>
			          <tr>
			            <td><table border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;'>
			              <tr>
			                <td width='5'></td>
			                <td><div align='center' $cursty onclick='openpatname()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td class='tahoma s9 black bold' width='15%'>1 Name of Patient </td>
			                    <td class='b1'><div align='center' class='tahoma s12 black'>$ln</div></td>
			                    <td class='b1'><div align='center' class='tahoma s12 black'>$fn</div></td>
			                    <td class='b1'><div align='center' class='tahoma s12 black'>$su</div></td>
			                    <td class='b1'><div align='center' class='tahoma s12 black'>$mn</div></td>
			                  </tr>
			                  <tr>
			                    <td><div align='center' class='tahoma s9 black bold'></div></td>
			                    <td ><div align='center' class='tahoma s10 black'>Last Name &nbsp;</div></td>
			                    <td><div align='center' class='tahoma s10 black'>First Name &nbsp;</div></td>
			                    <td><div align='center' class='tahoma s10 black'>Name Extension &nbsp;</div></td>
			                    <td><div align='center' class='tahoma s10 black'>Middle Name &nbsp;</div></td>
			                  </tr>
			                  <tr>
			                    <td><div align='center' class='tahoma s8 black'></div></td>
			                    <td ><div align='center' class='tahoma s8 black'></div></td>
			                    <td><div align='center' class='tahoma s8 black'></div></td>
			                    <td valign='top'><div align='center' class='tahoma s8 black'>(JR/SR/III)</div></td>
			                    <td><div align='center' class='tahoma s8 black'>(ex:DELA CRUZ JR SIPAG)</div></td>
			                  </tr>
			                </table></div></td>
			              </tr>
			              <tr>
			                <td height='5'></td>
			              </tr>
			              <tr>
			                <td width='5'></td>
			                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td><div align='left' class='tahoma s9 black bold'>2. Was patient referred by another Health Care Institution (HCI)? &nbsp;</div></td>
			                  </tr>
			                  <tr>
			                    <td height='5'></td>
			                  </tr>
			                  <tr>
			                    <td width='10'><table border='0' cellpadding='0' cellspacing='0' width='100%'>
			                      <tr>
			                        <td width='10'></td>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td class='r1 l1 b1 t1' height='17' width='17'><div align='center'></div></td>
			                            <td><div class='tahoma s12 black'>&nbsp;NO&nbsp;</div></td>
			                          </tr>
			                        </table></td>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td class='r1 l1 b1 t1' height='17' width='17'><div align='center'></div></td>
			                            <td class='tahoma s12 black'>&nbsp;YES&nbsp;</td>
			                          </tr>
			                        </table></td>
			                        <td class='b1'><div align='center' class='tahoma s10 black'></div></td>
			                        <td width='5'></td>
			                        <td class='b1'><div align='center' class='tahoma s10 black'></div></td>
			                        <td width='5'></td>
			                        <td class='b1'><div align='center' class='tahoma s10 black'></div></td>
			                        <td width='5'></td>
			                        <td class='b1'><div align='center' class='tahoma s10 black'></div></td>
			                        <td width='5'></td>
			                        <td class='b1'><div align='center' class='tahoma s10 black'></div></td>
			                        <td width='5'></td>
			                      </tr>
			                      <tr>
			                        <td></td>
			                        <td></td>
			                        <td></td>
			                        <td><div align='center' class='tahoma s10 black'>&nbsp;Name of referring Health Care Institution&nbsp;</div></td>
			                        <td></td>
			                        <td><div align='center' class='tahoma s10 black'>&nbsp;Building Number and Street Name&nbsp;</div></td>
			                        <td></td>
			                        <td><div align='center' class='tahoma s10 black'>&nbsp;City/Municipality&nbsp;</div></td>
			                        <td></td>
			                        <td><div align='center' class='tahoma s10 black'>&nbsp;Province&nbsp;</div></td>
			                        <td></td>
			                        <td><div align='center' class='tahoma s10 black'>&nbsp;Zip code&nbsp;</div></td>
			                        <td></td>
			                      </tr>
			                    </table></td>
			                  </tr>
			                </table></td>
			              </tr>


			              <tr>
			                <td width='5'></td>
			                <td><div align='left'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse;'>
			";


			//---------------------------------------------------------------------------------------------------------------------------------------------------
			echo "
			                  <tr>
			                    <td><div align='left' class='tahoma s9 black bold'>3. Confinement Period:</div></td>
			                    <td width='20'></td>
			                    <td valign='center'><div align='left' class='tahoma s10 black'>a. Date Admitted</div></td>
			                    <td width='10'></td>
			                    <td><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>0</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>3</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td width='15' height='15'><div align='center' class='tahoma s10 black'>-</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>2</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>1</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td width='15' height='15'><div align='center' class='tahoma s10 black'>-</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>2</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>0</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>2</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>1</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                          </tr>
			                          <tr>
			                            <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>month</div></td>
			                            <td></td>
			                            <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>day</div></td>
			                            <td></td>
			                            <td colspan='9' valign='top'><div align='center' class='tahoma s7 black'>year</div></td>
			                          </tr>
			                        </table></td>
			                      </tr>
			                    </table></td>
			                    <td width='20'></td>


			                    <td valign='center'><div align='left' class='tahoma s10 black'>b. Time Admitted</div></td>
			                    <td width='10'></td>
			                    <td><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>0</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>3</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td width='15' height='15'><div align='center' class='tahoma s10 black'>-</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>2</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>1</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                          </tr>
			                          <tr>
			                            <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>hour</div></td>
			                            <td></td>
			                            <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>min</div></td>
			                          </tr>
			                        </table></td>
			                      </tr>
			                    </table></td>
			                    <td width='25'></td>
			                    <td><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td class='r1 l1 b1 t1' width='17' height='17' class='tahoma s9 black'></td>
			                            <td class='tahoma s9 black'>&nbsp;AM &nbsp;</td>
			                          </tr>
			                        </table></td>
			                        <td width='10'></td>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td class='r1 l1 b1 t1' width='17' height='17' class='tahoma s9 black'></td>
			                            <td class='tahoma s9 black'>&nbsp;PM &nbsp;</td>
			                          </tr>
			                        </table></td>
			                      </tr>
			                    </table></td>
			                  </tr>

			                  <tr>
			                    <td><div align='left' class='tahoma s9 black bold'></div></td>
			                    <td></td>
			                    <td valign='center'><div align='left' class='tahoma s10 black'>c. Date Admitted</div></td>
			                    <td width='10'></td>
			                    <td><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>0</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>3</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td width='15' height='15'><div align='center' class='tahoma s10 black'>-</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>2</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>1</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td width='15' height='15'><div align='center' class='tahoma s10 black'>-</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>2</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>0</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>2</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>1</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                          </tr>
			                          <tr>
			                            <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>month</div></td>
			                            <td></td>
			                            <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>day</div></td>
			                            <td></td>
			                            <td colspan='9' valign='top'><div align='center' class='tahoma s7 black'>year</div></td>
			                          </tr>
			                        </table></td>
			                      </tr>
			                    </table></td>
			                    <td width='20'></td>


			                    <td valign='center'><div align='left' class='tahoma s10 black'>d. Time Admitted</div></td>
			                    <td width='10'></td>
			                    <td><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>0</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>3</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td width='15' height='15'><div align='center' class='tahoma s10 black'>-</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>2</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>1</div></td>
			                              </tr>
			                            </table></td>
			                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='5' class='l1'></td>
			                              </tr>
			                            </table></td>
			                          </tr>
			                          <tr>
			                            <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>hour</div></td>
			                            <td></td>
			                            <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>min</div></td>
			                          </tr>
			                        </table></td>
			                      </tr>
			                    </table></td>
			                    <td></td>
			                    <td><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td class='r1 l1 b1 t1' width='17' height='17' class='tahoma s9 black'></td>
			                            <td class='tahoma s9 black'>&nbsp;AM &nbsp;</td>
			                          </tr>
			                        </table></td>
			                        <td width='10'></td>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td class='r1 l1 b1 t1' width='17' height='17' class='tahoma s9 black'></td>
			                            <td class='tahoma s9 black'>&nbsp;PM &nbsp;</td>
			                          </tr>
			                        </table></td>
			                      </tr>
			                    </table></td>
			                  </tr>
			";
			//---------------------------------------------------------------------------------------------------------------------------------------------------


			echo "
			                </table></td>
			              </tr>



			              <tr>
			                <td colspan='2' height='10'></td>
			              </tr>
			              <tr>
			                <td width='5'></td>
			                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td class='tahoma s9 black'><b>4. Patient Disposition:</b> (select only 1) </td>
			                  </tr>
			                  <tr>
			                    <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>

			                      <tr>
			                        <td width='10'></td>
			                        <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='17' height='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'></div></td>
			                          </tr>
			                        </table></td>
			                        <td width='12'></td>
			                        <td width='180'><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td><div align='left' class='tahoma s10 black'>a. Improved</div></td>
			                          </tr>
			                        </table></td>
			                        <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='17' height='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'></div></td>
			                          </tr>
			                        </table></td>
			                        <td width='12'></td>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17'><div align='left' class='tahoma s10 black'>e. Expired</div></td>
			                              </tr>
			                            </table></td>
			                            <td width='12'></td>
			                            <td valign='top'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>

			                                <td><table border='0' cellpadding='0' cellspacing='0'>
			                                  <tr>
			                                    <td height='13' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td height='5' class='l1'></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>0</div></td>
			                                      </tr>
			                                    </table></td>
			                                    <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td height='5' class='l1'></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>3</div></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td height='5' class='l1'></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td width='15' height='13'><div align='center' class='tahoma s10 black'>-</div></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td height='5' class='l1'></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>2</div></td>
			                                      </tr>
			                                    </table></td>
			                                    <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td height='5' class='l1'></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>1</div></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td height='5' class='l1'></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td width='15' height='13'><div align='center' class='tahoma s10 black'>-</div></td>
			                                      </tr>
			                                    </table></td>
			                                    <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td height='5' class='l1'></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>2</div></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td height='5' class='l1'></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>0</div></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td height='5' class='l1'></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>2</div></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td height='5' class='l1'></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>1</div></td>
			                                      </tr>
			                                    </table></td>
			                                    <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td height='5' class='l1'></td>
			                                      </tr>
			                                    </table></td>
			                                  </tr>
			                                  <tr>
			                                    <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>month</div></td>
			                                    <td></td>
			                                    <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>day</div></td>
			                                    <td></td>
			                                    <td colspan='9' valign='top'><div align='center' class='tahoma s7 black'>year</div></td>
			                                  </tr>
			                                </table></td>
			                                <td width='20'></td>
			                                <td><div align='left' class='tahoma s10 black'>Time:</div></td>
			                                <td width='10'></td>
			                                <td valign='top'><table border='0' cellpadding='0' cellspacing='0'>
			                                  <tr>
			                                    <td><table border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                          <tr>
			                                            <td height='5' class='l1'></td>
			                                          </tr>
			                                        </table></td>
			                                        <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                                          <tr>
			                                            <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>0</div></td>
			                                          </tr>
			                                        </table></td>
			                                        <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                          <tr>
			                                            <td height='5' class='l1'></td>
			                                          </tr>
			                                        </table></td>
			                                        <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                                          <tr>
			                                            <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>3</div></td>
			                                          </tr>
			                                        </table></td>
			                                        <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                          <tr>
			                                            <td height='5' class='l1'></td>
			                                          </tr>
			                                        </table></td>
			                                        <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                                          <tr>
			                                            <td width='15' height='13'><div align='center' class='tahoma s10 black'>-</div></td>
			                                          </tr>
			                                        </table></td>
			                                        <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                          <tr>
			                                            <td height='5' class='l1'></td>
			                                          </tr>
			                                        </table></td>
			                                        <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                                          <tr>
			                                            <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>2</div></td>
			                                          </tr>
			                                        </table></td>
			                                        <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                          <tr>
			                                            <td height='5' class='l1'></td>
			                                          </tr>
			                                        </table></td>
			                                        <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			                                          <tr>
			                                            <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>1</div></td>
			                                          </tr>
			                                        </table></td>
			                                        <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
			                                          <tr>
			                                            <td height='5' class='l1'></td>
			                                          </tr>
			                                        </table></td>
			                                      </tr>
			                                      <tr>
			                                        <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>hour</div></td>
			                                        <td></td>
			                                        <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>min</div></td>
			                                      </tr>
			                                    </table></td>
			                                  </tr>
			                                </table></td>
			                                <td width='10'></td>
			                                <td><table border='0' cellpadding='0' cellspacing='0'>
			                                  <tr>
			                                    <td><table border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td class='r1 l1 b1 t1' width='17' height='17' class='tahoma s9 black'></td>
			                                        <td class='tahoma s9 black'>&nbsp;AM &nbsp;</td>
			                                      </tr>
			                                    </table></td>
			                                    <td><table border='0' cellpadding='0' cellspacing='0'>
			                                      <tr>
			                                        <td class='r1 l1 b1 t1' width='17' height='17' class='tahoma s9 black'></td>
			                                        <td class='tahoma s9 black'>&nbsp;PM &nbsp;</td>
			                                      </tr>
			                                    </table></td>
			                                  </tr>
			                                </table></td>

			                              </tr>
			                            </table></div></td>
			                          </tr>
			                        </table></td>
			                      </tr>

			                      <tr>
			                        <td></td>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='17' height='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'></div></td>
			                          </tr>
			                        </table></td>
			                        <td></td>
			                        <td><div align='left' class='tahoma s10 black'>b. Recovered</div></td>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='17' height='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'></div></td>
			                          </tr>
			                        </table></td>
			                        <td></td>
			                        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='110'><div align='left' class='tahoma s10 black'>f. Transferred/Referred</div></td>
			                            <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='15' class='b1'><div align='center' class='tahoma s10 black'>&nbsp;</div></td>
			                              </tr>
			                              <tr>
			                                <td><div align='center' class='tahoma s7 black'>Name of Referral Health Care Institution</div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                          </tr>
			                        </table></td>
			                      </tr>

			                      <tr>
			                        <td colspan='7' height='2'></td>
			                      </tr>

			                      <tr>
			                        <td></td>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='17' height='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>&nbsp;</div></td>
			                          </tr>
			                        </table></td>
			                        <td ></td>
			                        <td colspan='2'><div align='left' class='tahoma s10 black'>c. Home/Discharged Against Medical Advise</div></td>
			                        <td></td>
			                        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='30'></td>
			                            <td class='b1' width='180'><div align='center' class='tahoma s10 black'>&nbsp;</div></td>
			                            <td width='5'></td>
			                            <td class='b1'><div align='center' class='tahoma s10 black'>&nbsp;</div></td>
			                            <td width='5'></td>
			                            <td class='b1' width='80'><div align='center' class='tahoma s10 black'>&nbsp;</div></td>
			                            <td width='5'></td>
			                            <td class='b1' width='50'><div align='center' class='tahoma s10 black'>&nbsp;</div></td>
			                            <td width='5'></td>
			                          </tr>
			                          <tr>
			                            <td></td>
			                            <td><div align='center' class='tahoma s7 black'>Building Number and Street Name</div></td>
			                            <td></td>
			                            <td><div align='center' class='tahoma s7 black'>City/Municipality</div></td>
			                            <td></td>
			                            <td><div align='center' class='tahoma s7 black'>Province</div></td>
			                            <td></td>
			                            <td><div align='center' class='tahoma s7 black'>Zip code</div></td>
			                            <td></td>
			                          </tr>
			                        </table></td>
			                      </tr>

			                      <tr>
			                        <td colspan='7' height='3'></td>
			                      </tr>

			                      <tr>
			                        <td></td>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='17' height='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'></div></td>
			                          </tr>
			                        </table></td>
			                        <td ></td>
			                        <td colspan='2'><div align='left' class='tahoma s10 black'>d. Absconded</div></td>
			                        <td></td>
			                        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='140'><div align='left' class='tahoma s10 black'>Reason/s for referral/transfer: </div></td>
			                            <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                            <td width='5'></td>
			                          </tr>
			                        </table></td>
			                      </tr>

			                    </table></td>
			                  </tr>

			                </table></td>
			              </tr>

			              <tr>
			                <td colspan='2' height='10'></td>
			              </tr>

			              <tr>
			                <td width='5'></td>
			                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td width='140' class='tahoma s9 black bold'>5. Type of Accomodation:</td>
			                    <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td class='r1 l1 b1 t1' width='17' height='17'><div align='center' class='tahoma s10 black'>$rmchk1</div></td>
			                            <td class='tahoma s10 black' valign='bottom'>&nbsp;Private&nbsp;</td>
			                          </tr>
			                        </table></td>
			                        <td width='10'></td>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td class='r1 l1 b1 t1' width='17' height='17'><div align='center' class='tahoma s10 black'>$rmchk2</div></td>
			                            <td class='tahoma s10 black' valign='bottom'>&nbsp;Non-Private (Charity/Service)&nbsp;</td>
			                          </tr>
			                        </table></td>
			                      </tr>
			                    </table></div></td>
			                  </tr>
			                  <tr>
			                    <td height='3'></td>
			                  </tr>
			                </table></td>
			              </tr>


			            </table></div></td>
			          </tr>

			          <tr>
			            <td colspan='3' class='t2' height='5'></td>
			          </tr>


			          <tr height='20'>
			            <td class='b2'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			              <tr>
			                <td width='5'></td>
			                <td><div align='left' class='tahoma s9 black bold'>6. Admission Diagnosis/es:</div></td>
			                <td width='5'></td>
			              </tr>
			              <tr>
			                <td></td>
			                <td height='30' valign='middle'><div align='left' class='tahoma s12 black'>$finaldiagnosis</div></td>
			                <td></td>
			              </tr>
			              <tr>
			                <td colspan='3' height='10'></td>
			              </tr>
			            </table></td>
			          </tr>

			          <tr>
			            <td colspan='3' height='5'></td>
			          </tr>

			          <tr>
			            <td colspan='3' class='b2'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
			              <tr>
			                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td width='5'></td>
			                    <td><div align='left' class='tahoma s9 black'><b>7. Discharge Diagnosis/es</b> (Use additional CF2 if necessary):</div></td>
			                  </tr>
			                </table></td>
			              </tr>
			              <tr>
			                <td height='5'></td>
			              </tr>
			              <tr>
			                <td><table border='0' cellpadding='0' cellspacing='0' width='100%'>
			                  <tr>
			                    <td width='10'></td>
			                    <td class='Tahoma10black'></td>
			                    <td width='100'><div align='center' class='tahoma s10 black'>Diagnosis</div></td>
			                    <td width='8'></td>
			                    <td width='80'><div align='center' class='tahoma s10 black'>ICD-10 Code/s</div></td>
			                    <td width='8'></td>
			                    <td><div align='center' class='tahoma s10 black'></div></td>
			                    <td><div align='center' class='tahoma s10 black'>Related Procedure/s (if there's any)</div></td>
			                    <td width='8'></td>
			                    <td><div align='center' class='tahoma s10 black'>RVS Code</div></td>
			                    <td width='8'></td>
			                    <td><div align='center' class='tahoma s10 black'>Date of Procedure</div></td>
			                    <td width='8'></td>
			                    <td colspan='6'><div align='center' class='tahoma s10 black'>Laterality (check pplicable box)</div></td></td>
			                    <td width='8'></td>
			                  </tr>
			                  <tr>
			                    <td colspan='15' height='3'></td>
			                  </tr>";


			                        $count=1;
			                        while($count <= 6)
			                        {
			                          $description[$count]="";
			                          $icdcode[$count]="";
			                          $count++;
			                        }


			                        $num=1;
			                        $SQLcase=mysql_query("SELECT * FROM finalcaserate WHERE caseno='$caseno' ORDER BY FIELD(level, 'primary','secondary','additional')");
			                        if(mysql_num_rows($SQLcase)>0)
			                        {
			                          while($casefetch=mysql_fetch_array($SQLcase))
			                          {
			                            $description[$num]=$casefetch['description'];
			                            $icdcode[$num]=$casefetch['icdcode'];

			                            $num++;

			                          }
			                        }
			          
			  echo"
			                  <tr>
			                    <td></td>
			                    <td><div align='left' class='tahoma s10 black'>a.&nbsp;</div></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'>$description[1]</div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'>$icdcode[1]</div></td>
			                    <td></td>
			                    <td><div align='left' class='tahoma s10 black'>i.</div></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>left</div></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>right</div></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>both</div></td>
			                  </tr>
			                  <tr>
			                    <td colspan='16' height='2'></td>
			                  </tr>
			                  <tr>
			                    <td></td>
			                    <td><div align='left' class='tahoma s10 black'></div></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'>$description[2]</div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'>$icdcode[2]</div></td>
			                    <td></td>
			                    <td><div align='left' class='tahoma s10 black'>ii.</div></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>left</div></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>right</div></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>both</div></td>
			                  </tr>
			                  <tr>
			                    <td colspan='15' height='2'></td>
			                  </tr>
			                  <tr>
			                    <td></td>
			                    <td><div align='left' class='tahoma s10 black'></div></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'>$description[3]</div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'>$icdcode[3]</div></td>
			                    <td></td>
			                    <td><div align='left' class='tahoma s10 black'>iii.</div></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>left</div></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>right</div></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>both</div></td>
			                  </tr>
			                  <tr>
			                    <td colspan='15' height='2'></td>
			                  </tr>
			                  <tr>
			                    <td></td>
			                    <td><div align='left' class='tahoma s10 black'>b.&nbsp;</div></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'>$description[4]</div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'>$icdcode[4]</div></td>
			                    <td></td>
			                    <td><div align='left' class='tahoma s10 black'>i.</div></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>left</div></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>right</div></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>both</div></td>
			                  </tr>
			                  <tr>
			                    <td colspan='16' height='2'></td>
			                  </tr>
			                  <tr>
			                    <td></td>
			                    <td><div align='left' class='tahoma s10 black'></div></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'>$description[5]</div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'>$icdcode[5]</div></td>
			                    <td></td>
			                    <td><div align='left' class='tahoma s10 black'>ii.</div></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>left</div></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>right</div></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>both</div></td>
			                  </tr>
			                  <tr>
			                    <td colspan='15' height='2'></td>
			                  </tr>
			                  <tr>
			                    <td></td>
			                    <td><div align='left' class='tahoma s10 black'></div></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'>$description[6]</div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'>$icdcode[6]</div></td>
			                    <td></td>
			                    <td><div align='left' class='tahoma s10 black'>iii.</div></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                    <td></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>left</div></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>right</div></td>
			                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                      </tr>
			                    </table></td>
			                    <td><div align='center' class='tahoma s10 black'>both</div></td>
			                  </tr>
			                </table></td>
			              </tr>
			              <tr>
			                <td height='5'></td>
			              </tr>
			            </table></td>
			          </tr>

			          <tr>
			            <td class='b2'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			              <tr>
			                <td colspan='3' height='3'></td>
			              </tr>
			              <tr>
			                <td width='5'></td>
			                <td><div align='left' class='tahoma s9 black bold'>8. Special Consideration:</div></td>
			                <td width='5'></td>
			              </tr>
			              <tr>
			                <td colspan='3' height='3'></td>
			              </tr>
			            </table></td>
			          </tr>

			          <tr>
			            <td colspan='3'><table border='0' cellpadding='0' cellspacing='0' width='100%'>
			              <tr>
			                <td height='5'></td>
			              </tr>

			              <tr>
			                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td width='10'></td>
			                    <td><div align='left' class='tahoma s9 black'>a. For the following repetitive procedures, check box that applies and enumerate the procedure/sessions dates[mm-dd-yyyy]. For chemotheraphy, see guidelines</div></td>
			                  </tr>
			                </table></td>
			              </tr>

			              <tr>
			                <td height='5'></td>
			              </tr>

			              <tr>
			                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td width='15'></td>
			<!-- ------------------------------------------------------------------------------------------------------------------ -->
			                    <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>

			                      <tr>
			                        <td width='20%'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s10 black'>Hemodialysis</div></td>
			                          </tr>
			                        </table></div></td>
			                        <td width='28%' class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                        <td width='4%'></td>
			                        <td width='20%'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s10 black'>Blood Transfusion</div></td>
			                          </tr>
			                        </table></div></td>
			                        <td width='28%' class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                      </tr>

			                      <tr>
			                        <td colspan='5' height='2'></td>
			                      </tr>

			                      <tr>
			                        <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s10 black'>Peritoneal Dialysis</div></td>
			                          </tr>
			                        </table></div></td>
			                        <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                        <td></td>
			                        <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s10 black'>Brachytherapy</div></td>
			                          </tr>
			                        </table></div></td>
			                        <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                      </tr>

			                      <tr>
			                        <td colspan='5' height='2'></td>
			                      </tr>

			                      <tr>
			                        <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s10 black'>Radiotheraphy (LINAC)</div></td>
			                          </tr>
			                        </table></div></td>
			                        <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                        <td></td>
			                        <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s10 black'>Chemotheraphy</div></td>
			                          </tr>
			                        </table></div></td>
			                        <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                      </tr>

			                      <tr>
			                        <td colspan='5' height='2'></td>
			                      </tr>

			                      <tr>
			                        <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s10 black'>Radiotheraphy (COBALT)</div></td>
			                          </tr>
			                        </table></div></td>
			                        <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                        <td></td>
			                        <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s10 black'>Simple Debridement</div></td>
			                          </tr>
			                        </table></div></td>
			                        <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                      </tr>

			                    </table></td>
			<!-- ------------------------------------------------------------------------------------------------------------------ -->
			                    <td width='15'></td>
			                  </tr>
			                </table></td>
			              </tr>

			              <tr>
			                <td height='5'></td>
			              </tr>

			              <tr>
			                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td width='10'></td>
			                    <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td width='25%'><div align='left' class='tahoma s9 black'>b. For Z-Benefit Package</div></td>
			                        <td width='50%'><div align='center'><table border='0' width='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td><div class='tahoma s9 black bold'>Z-Benefit Package Code:&nbsp;</td>
			                            <td width='200' class='b1'><div align='left' class='tahoma s10 black bold'></div></td>
			                          </tr>
			                        </table></div></td>
			                        <td width='25%'></td>
			                      </tr>
			                    </table></td>
			                    <td width='10'></td>
			                  </tr>
			                </table></td>
			              </tr>

			              <tr>
			                <td height='5'></td>
			              </tr>

			              <tr>
			                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td width='10'></td>
			                    <td><div align='left' class='tahoma s9 black'>c. For MCP Package (enumerate four dates [mm-dd-yyyy] of pre-natal check-ups)</div></td>
			                    <td width='10'></td>
			                  </tr>
			                </table></td>
			              </tr>

			              <tr>
			                <td height='5'></td>
			              </tr>

			              <tr>
			                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td width='20'></td>
			                    <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td width='25%'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='10'><div align='left' class='tahoma s10 black'>1</div></td>
			                            <td width='auto' class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                            <td width='10'></td>
			                          </tr>
			                        </table></td>
			                        <td width='25%'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='10'><div align='left' class='tahoma s10 black'>2</div></td>
			                            <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                            <td width='10'></td>
			                          </tr>
			                        </table></td>
			                        <td width='25%'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='10'><div align='left' class='tahoma s10 black'>3</div></td>
			                            <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                            <td width='10'></td>
			                          </tr>
			                        </table></td>
			                        <td width='25%'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='10'><div align='left' class='tahoma s10 black'>4</div></td>
			                            <td width='auto' class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                            <td width='10'></td>
			                          </tr>
			                        </table></td>
			                      </tr>
			                    </table></td>
			                    <td width='5'></td>
			                  </tr>
			                </table></td>
			              </tr>

			              <tr>
			                <td height='5'></td>
			              </tr>

			              <tr>
			                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td width='10'></td>
			                    <td width='130'><div align='left' class='tahoma s9 black'>d. For TB DOTS Package</div></td>
			                    <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                          </tr>
			                        </table></td>
			                        <td width='10'></td>
			                        <td><div align='left' class='tahoma s10 blck'>Intensive Phase</div></td>
			                        <td width='50'></td>
			                        <td><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                          </tr>
			                        </table></td>
			                        <td width='10'></td>
			                        <td><div align='left' class='tahoma s10 blck'>Maintenance Phase</div></td>
			                      </tr>
			                    </div></table></td>
			                  </tr>
			                </table></td>
			              </tr>

			              <tr>
			                <td height='5'></td>
			              </tr>

			              <tr>
			                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td width='10'></td>
			                    <td height='20'><div align='left' class='tahoma s9 black'>e. For Animal Bites Package (write the dates [mm-dd-yyyy] when the following doses of vaccine were given)</div></td>
			                    <td width='270' class='t1 b1 l1'><div align='center' class='tahoma s8 black bold'>Note: Anti Rabies Vaccine (ARV), Rabies Immunoglobulin (RIG)</div></td>
			                  </tr>
			                </table></td>
			              </tr>

			              <tr>
			                <td height='5'></td>
			              </tr>

			              <tr>
			                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td width='20'></td>
			                    <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td width='19%'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='52'><div align='left' class='tahoma s9 black bold'>Day 0 ARV</div></td>
			                            <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                          </tr>
			                        </table></td>
			                        <td width='1%'></td>
			                        <td width='19%'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='52'><div align='left' class='tahoma s9 black bold'>Day 3 ARV</div></td>
			                            <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                          </tr>
			                        </table></td>
			                        <td width='1%'></td>
			                        <td width='19%'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='52'><div align='left' class='tahoma s9 black bold'>Day 7 ARV</div></td>
			                            <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                          </tr>
			                        </table></td>
			                        <td width='1%'></td>
			                        <td width='16%'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='25'><div align='left' class='tahoma s9 black bold'>RIG</div></td>
			                            <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                          </tr>
			                        </table></td>
			                        <td width='1%'></td>
			                        <td width='22%'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='75'><div align='left' class='tahoma s9 black bold'>Others (Specify)</div></td>
			                            <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
			                          </tr>
			                        </table></td>
			                      </tr>
			                    </table></td>
			                    <td width='5'></td>
			                  </tr>
			                </table></td>
			              </tr>

			              <tr>
			                <td height='5'></td>
			              </tr>

			              <tr>
			                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td width='10'></td>
			                    <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td><div align='left' class='tahoma s9 black'>f. For Newborn Care Package</div></td>
			                        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s10 blck'>Essential Newborn Care</div></td>
			                            <td width='5'></td>
			                          </tr>
			                        </table></td>
			                        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s10 blck'>Newborn Hearing Screening Test</div></td>
			                            <td width='5'></td>
			                          </tr>
			                        </table></td>
			                        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s10 blck'>Newborn Screening Test</div></td>
			                            <td width='5'></td>
			                          </tr>
			                        </table></td>
			                        <td rowspan='3' class='t1 b1 l1'><div align='center'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='3'></td>
			                            <td><div align='left' class='tahoma s9 black'>For Newborn Screening<br />please attach NBS Filter Sticker here</div></td>
			                            <td width='3'></td>
			                          </tr>
			                        </table></div></td>
			                      </tr>
			                      <tr>
			                        <td colspan='4' height='3'></td>
			                      </tr>
			                      <tr>
			                        <td colspan='4'><table border='0' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td height='20' class='t1 b1 l1 r1'><div align='left'><span class='tahoma s9 black'><b>&nbsp;&nbsp;&nbsp;&nbsp;For Essential Newborn Care</b> (check applicable boxes)</span></div></div></td>
			                          </tr>
			                        </table></td>
			                      </tr>
			                    </table></td>
			                  </tr>
			                </table></td>
			              </tr>

			              <tr>
			                <td height='5'></td>
			              </tr>
			              
			              <tr>
			                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td width='15'></td>
			                    <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td width='23%'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='17'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s9 blck'>Immediate drying of newborn</div></td>
			                            <td width='3'></td>
			                          </tr>
			                        </table></td>
			                        <td width='17%'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='17'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s9 blck'>Timely cord clamping</div></td>
			                            <td width='3'></td>
			                          </tr>
			                        </table></td>
			                        <td width='19%'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='17'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s9 blck'>Weighing of the newborn</div></td>
			                            <td width='3'></td>
			                          </tr>
			                        </table></td>
			                        <td width='17%'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='17'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s9 blck'>BCG vaccination</div></td>
			                            <td width='3'></td>
			                          </tr>
			                        </table></td>
			                        <td width='23%'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='17'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s9 blck'>Hepatitis B vaccination</div></td>
			                            <td width='3'></td>
			                          </tr>
			                        </table></td>
			                      </tr>
			                      
			                      <tr>
			                        <td colspan='5' height='2'></td>
			                      </tr>
			                      
			                      <tr>
			                        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='17'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s9 blck'>Early skin-to-skin contact</div></td>
			                            <td width='3'></td>
			                          </tr>
			                        </table></td>
			                        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='17'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s9 blck'>Eye Prophylaxis</div></td>
			                            <td width='3'></td>
			                          </tr>
			                        </table></td>
			                        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='17'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s9 blck'>Vitamin K administration</div></td>
			                            <td width='3'></td>
			                          </tr>
			                        </table></td>
			                        <td colspan='2'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                          <tr>
			                            <td width='17'><table border='0' cellpadding='0' cellspacing='0'>
			                              <tr>
			                                <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
			                              </tr>
			                            </table></td>
			                            <td width='5'></td>
			                            <td><div align='left' class='tahoma s9 blck'>Non-separation of mother/baby for early breastfeeding initiation</div></td>
			                            <td width='3'></td>
			                          </tr>
			                        </table></td>
			                      </tr>
			                      
			                    </table></td>
			                    <td width='15'></td>
			                  </tr>
			                </table></td>
			              </tr>
			              
			              <tr>
			                <td height='5'></td>
			              </tr>

			              <tr>
			                <td><div align='left'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td width='10'></td>
			                    <td width='250'><div align='left' class='tahoma s9 black'>g. For Outpatient HIV/AIDS Treatment Package</div></td>
			                    <td width='100'><div align='left' class='tahoma s9 black bold'>&nbsp;Laboratory Number:</div></td>
			                    <td class='Tahoma10black b1' ><div align='left' ></div></td>
			                    <td width='180'></td>
			                  </tr>
			                </table></div></td>
			              </tr>
			              
			              <tr>
			                <td height='5'></td>
			              </tr>

			            </table></td>
			          </tr>

			          <tr>
			            <td class='t2 b1'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			              <tr>
			                <td colspan='3' height='3'></td>
			              </tr>
			              <tr>
			                <td width='5'></td>
			                <td><div align='left' class='tahoma s9 black bold'>9. PhilHealth Benefits:</div></td>
			                <td width='5'></td>
			              </tr>
			              <tr>
			                <td colspan='3' height='10'></td>
			              </tr>
			              <tr>
			                <td colspan='3'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                  <tr>
			                    <td width='10'></td>
			                    <td width='100'><div align='left' class='tahoma s8 black bold'>ICD 10 or RVS Code:</div></td>
			                    <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
			                      <tr>
			                        <td width='12%'><div align='left' class='tahoma s8 black'>a. First Case Rate</div></td>
			                        <td width='37%' class='b1'><div align='center' class='tahoma s10 black'>&nbsp;$cr1&nbsp;</div></td>
			                        <td width='1%'></td>
			                        <td width='13%'><div align='left' class='tahoma s8 black'>b. Second Case Rate</div></td>
			                        <td width='37%' class='b1'><div align='center' class='tahoma s10 black'>&nbsp;$cr2&nbsp;</div></td>
			                      </tr>
			                    </table></td>
			                    <td width='5'></td>
			                  </tr>
			                </table></td>
			              </tr>
			              <tr>
			                <td colspan='3' height='3'></td>
			              </tr>
			            </table></td>
			          </tr>
			          
			        </table>
			      </td>
			    </tr>
			  </table>
			</div>
			";

include("Popup/PU-PatName.php");

?>
</body>
</html>
