<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Claim Signature Form (Front)</title>
<link href="CSS/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="Favicon/favicon.png" type="image/png" />
</head>

<body>
<?php

/*1. PhilHealth Identification Number (PIN) of Member: */
$phicofmember = "12-345678901-2"; //Place value of PHIC Number of member from the DB here.

if(strlen($phicofmember)==14){
$phicmember = str_split($phicofmember);

$phicmember0 = $phicmember[0];
$phicmember1 = $phicmember[1];
$phicmember3 = $phicmember[3];
$phicmember4 = $phicmember[4];
$phicmember5 = $phicmember[5];
$phicmember6 = $phicmember[6];
$phicmember7 = $phicmember[7];
$phicmember8 = $phicmember[8];
$phicmember9 = $phicmember[9];
$phicmember10 = $phicmember[10];
$phicmember11 = $phicmember[11];
$phicmember13 = $phicmember[13];

}
else{
$phicmember0 = "";
$phicmember1 = "";
$phicmember3 = "";
$phicmember4 = "";
$phicmember5 = "";
$phicmember6 = "";
$phicmember7 = "";
$phicmember8 = "";
$phicmember9 = "";
$phicmember10 = "";
$phicmember11 = "";
$phicmember13 = "";
}
/*------------------------------------------------------*/


/*2. Name of Member: */
$LN = "Alocelja";
$FN = "Mark";
$MN = "BACONG";
/*------------------------------------------------------*/


/*3. Member Date of Birth: */
$bdayofmem="04-10-1985"; //change this to the value on the DB.

$bdayofmemarr=str_split($bdayofmem);

if(strlen($bdayofmem)>1){
$bdayofmemarr0 = $bdayofmemarr[0];
$bdayofmemarr1 = $bdayofmemarr[1];
$bdayofmemarr3 = $bdayofmemarr[3];
$bdayofmemarr4 = $bdayofmemarr[4];
$bdayofmemarr6 = $bdayofmemarr[6];
$bdayofmemarr7 = $bdayofmemarr[7];
$bdayofmemarr8 = $bdayofmemarr[8];
$bdayofmemarr9 = $bdayofmemarr[9];
}
else{
$bdayofmemarr0 = "";
$bdayofmemarr1 = "";
$bdayofmemarr3 = "";
$bdayofmemarr4 = "";
$bdayofmemarr6 = "";
$bdayofmemarr7 = "";
$bdayofmemarr8 = "";
$bdayofmemarr9 = "";
}
/*------------------------------------------------------*/


/*4. PhilHealth Identification Number (PIN) of Dependent: */
$phicofdep = "21-098765432-1"; //Place value of PHIC Number of dependent from the DB here.

if(strlen($phicofdep)==14){
$phicdep = str_split($phicofdep);

$phicdep0 = $phicdep[0];
$phicdep1 = $phicdep[1];
$phicdep3 = $phicdep[3];
$phicdep4 = $phicdep[4];
$phicdep5 = $phicdep[5];
$phicdep6 = $phicdep[6];
$phicdep7 = $phicdep[7];
$phicdep8 = $phicdep[8];
$phicdep9 = $phicdep[9];
$phicdep10 = $phicdep[10];
$phicdep11 = $phicdep[11];
$phicdep13 = $phicdep[13];

}
else{
$phicdep0 = "";
$phicdep1 = "";
$phicdep3 = "";
$phicdep4 = "";
$phicdep5 = "";
$phicdep6 = "";
$phicdep7 = "";
$phicdep8 = "";
$phicdep9 = "";
$phicdep10 = "";
$phicdep11 = "";
$phicdep13 = "";
}
/*------------------------------------------------------*/

 	
/*5. Name of Patient: */
$LNPat = "Alocelja1";
$FNPat = "Mark1";
$MNPat = "BACONG1";
/*------------------------------------------------------*/


/*6. Relationship to Member: */
$relofmem = "Child";

if($relofmem=="Child"){$rom1 = "&#10004;"; $rom2 = ""; $rom3 = "";}
else if($relofmem=="Parent"){$rom1 = ""; $rom2 = "&#10004;"; $rom3 = "";}
else if($relofmem=="Spouse"){$rom1 = ""; $rom2 = ""; $rom3 = "&#10004;";}
else {$rom1 = ""; $rom2 = ""; $rom3 = "";}
/*------------------------------------------------------*/


/*7. Confinement Period */
$dateadmitted = "11-13-2017";
$datedischarged = "11-19-2017";

$dateadmittedarr=str_split($dateadmitted);

if(strlen($dateadmitted)>1){
$dateadmittedarr0 = $dateadmittedarr[0];
$dateadmittedarr1 = $dateadmittedarr[1];
$dateadmittedarr3 = $dateadmittedarr[3];
$dateadmittedarr4 = $dateadmittedarr[4];
$dateadmittedarr6 = $dateadmittedarr[6];
$dateadmittedarr7 = $dateadmittedarr[7];
$dateadmittedarr8 = $dateadmittedarr[8];
$dateadmittedarr9 = $dateadmittedarr[9];
}
else{
$dateadmittedarr0 = "";
$dateadmittedarr1 = "";
$dateadmittedarr3 = "";
$dateadmittedarr4 = "";
$dateadmittedarr6 = "";
$dateadmittedarr7 = "";
$dateadmittedarr8 = "";
$dateadmittedarr9 = "";
}

$datedischargedarr=str_split($datedischarged);

if(strlen($datedischarged)>1){
$datedischargedarr0 = $datedischargedarr[0];
$datedischargedarr1 = $datedischargedarr[1];
$datedischargedarr3 = $datedischargedarr[3];
$datedischargedarr4 = $datedischargedarr[4];
$datedischargedarr6 = $datedischargedarr[6];
$datedischargedarr7 = $datedischargedarr[7];
$datedischargedarr8 = $datedischargedarr[8];
$datedischargedarr9 = $datedischargedarr[9];
}
else{
$datedischargedarr0 = "";
$datedischargedarr1 = "";
$datedischargedarr3 = "";
$datedischargedarr4 = "";
$datedischargedarr6 = "";
$datedischargedarr7 = "";
$datedischargedarr8 = "";
$datedischargedarr9 = "";
}
/*------------------------------------------------------*/


/*8. Patient Date of Birth: */
$bdayofpat="12-01-2005"; //change this to the value on the DB.

$bdayofpatarr=str_split($bdayofpat);

if(strlen($bdayofpat)>1){
$bdayofpatarr0 = $bdayofpatarr[0];
$bdayofpatarr1 = $bdayofpatarr[1];
$bdayofpatarr3 = $bdayofpatarr[3];
$bdayofpatarr4 = $bdayofpatarr[4];
$bdayofpatarr6 = $bdayofpatarr[6];
$bdayofpatarr7 = $bdayofpatarr[7];
$bdayofpatarr8 = $bdayofpatarr[8];
$bdayofpatarr9 = $bdayofpatarr[9];
}
else{
$bdayofpatarr0 = "";
$bdayofpatarr1 = "";
$bdayofpatarr3 = "";
$bdayofpatarr4 = "";
$bdayofpatarr6 = "";
$bdayofpatarr7 = "";
$bdayofpatarr8 = "";
$bdayofpatarr9 = "";
}
/*------------------------------------------------------*/


/*1.PhilHealth Employer No. (PEN): */
$phicofemploy = "12-345679352-2"; //Place value of PhilHealth Employer No. (PEN) from the DB here.

if(strlen($phicofemploy)==14){
$pen = str_split($phicofemploy);

$pen0 = $pen[0];
$pen1 = $pen[1];
$pen3 = $pen[3];
$pen4 = $pen[4];
$pen5 = $pen[5];
$pen6 = $pen[6];
$pen7 = $pen[7];
$pen8 = $pen[8];
$pen9 = $pen[9];
$pen10 = $pen[10];
$pen11 = $pen[11];
$pen13 = $pen[13];

}
else{
$pen0 = "";
$pen1 = "";
$pen3 = "";
$pen4 = "";
$pen5 = "";
$pen6 = "";
$pen7 = "";
$pen8 = "";
$pen9 = "";
$pen10 = "";
$pen11 = "";
$pen13 = "";
}
/*------------------------------------------------------*/


/*2. Contact No.: */
$employercontactno = "+63 920 345 1234";
/*------------------------------------------------------*/

echo "
<div align='center'>
  <table width='700' border='0' cellpadding='0' cellspacing='0' bordercolor='#000000'>

    <tr>
      <td><table width='100%' boreder='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='50%' height='78' valign='top' ><div align='left'><img src='Image/Logo.jpg' height='78' width='auto' /></div></td>
          <td width='45%' height='78' valign='bottom'><div align='right' class='arial40blackbold'>CSF</div></td>
          <td width='5%' height='78'></td>
        </tr>
        <tr>
          <td valign='bottom'><div align='left' class='arial11blackbold'>IMPORTANT REMINDERS:</div></td>
          <td valign='bottom'><div align='right'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='center' class='arial12blackbold'>(Claim Signature<br />Form)</div></td>
            </tr>
          </table></div></td>
          <td></td>
        </tr>
        <tr>
          <td colspan='3'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='60%'><div align='left'><span class='arial09black'>PLEASE WRITE IN CAPITA </span><span class='arial09blackbold'>LETTERS</span><span class='arial09black'> AND </span><span class='arial09blackbold'>CHECK</span><span class='arial09black'> THE APPROPRIATE BOXES.</span></div></td>
              <td width='38%'><div align='right'><table border='0' cellspacing='0' cellpadding='0'>
                <tr>
                  <td><span class='arial12blackbold'>Series #&nbsp;</span></td>
                  <td><table cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='13' height='13' class='table1Top1Bottom1Left1Right'></td>
                      <td width='13' height='13' class='table1Top1Bottom1Right'></td>
                      <td width='13' height='13' class='table1Top1Bottom1Right'></td>
                      <td width='1' height='13' class='table1Left1Left'></td>
                      <td width='13' height='13' class='table1Top1Bottom1Left1Right'></td>
                      <td width='13' height='13' class='table1Top1Bottom1Right'></td>
                      <td width='1' height='13' class='table1Left1Left'></td>
                      <td width='13' height='13' class='table1Top1Bottom1Left1Right'></td>
                      <td width='13' height='13' class='table1Top1Bottom1Right'></td>
                      <td width='13' height='13' class='table1Top1Bottom1Right'></td>
                      <td width='13' height='13' class='table1Top1Bottom1Right'></td>
                      <td width='13' height='13' class='table1Top1Bottom1Right'></td>
                      <td width='13' height='13' class='table1Top1Bottom1Right'></td>
                      <td width='13' height='13' class='table1Top1Bottom1Right'></td>
                      <td width='13' height='13' class='table1Top1Bottom1Right'></td>
                    </tr>
                  </table></td>
                </tr>
              </table></div></td>
              <td width='2%'>&nbsp;</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan='3'><div align='left' class='arial09black'>All information required in this form are necessary and claim forms with incomplete information shall not be processed.</div></td>
        </tr>
        <tr>
          <td colspan='3'><div align='left' class='arial09black'>FALSE/INCORRECT INFORMATION OR MISPRESENTATION SHALL BE SUBJECT TO CRIMINAL OR ADMINISTRATIVE LIABILITIES.</div></td>
        </tr>
        <tr>
          <td colspan='3' height='10'></td>
        </tr>
      </table></td>      
    </tr>

    <tr>
      <td height='1' class='table1Top1Bottom'></td>
    </tr>

    <tr>
      <td><div align='center' class='arial11blackbold'>PART I - MEMBER AND PATIENT INFORMATION AND CERTIFICATION</div></td>
    </tr>

    <tr>
      <td height='1' class='table1Top1Bottom'></td>
    </tr>

    <tr>
      <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td width='2'></td>
          <td width='auto'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='40%'><div align='left' class='arial09black'>1. PhilHealth Identification Number (PIN) of Member:</div></td>
              <td width='auto'><table cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='11' height='11' class='table1Bottom1Left1Right'><div align='center' class='arial12black'>".$phicmember0."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicmember1."</div></td>
                  <td width='13' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                  <td width='11' height='11' class='table1Bottom1Left1Right'><div align='center' class='arial12black'>".$phicmember3."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicmember4."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicmember5."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicmember6."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicmember7."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicmember8."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicmember9."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicmember10."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicmember11."</div></td>
                  <td width='13' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                  <td width='11' height='11' class='table1Bottom1Left1Right'><div align='center' class='arial12black'>".$phicmember13."</div></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          <td width='2'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td width='2'></td>
          <td width='auto'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='65%' valign='top'><div align='left' class='arial09black'>2. Name of Member:</div></td>
              <td width='2%'></td>
              <td width='13%' rowspan='3' valign='top'><div align='center' class='arial09black'>3. Member Date of Birth:</div></td>
              <td width='20%' rowspan='2' valign='bottom'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>".$bdayofmemarr0."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$bdayofmemarr1."</div></td>
                    </tr>
                  </table></td>
                  <td width='13' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>".$bdayofmemarr3."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$bdayofmemarr4."</div></td>
                    </tr>
                  </table></td>
                  <td width='13' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>".$bdayofmemarr6."</div></td>
                  <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$bdayofmemarr7."</div></td>
                    </tr>
                  </table></td>
                  <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$bdayofmemarr8."</div></td>
                    </tr>
                  </table></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$bdayofmemarr9."</div></td>
                    </tr>
                  </table></td>
                </tr>
              </table></div></td>
            </tr>
            <tr>
              <td height='22' class='table1Bottom' valign='bottom'><div align='left' class='arial11blackbold'>".strtoupper($LN).", ".strtoupper($FN)." ".strtoupper($MN)."</div></td>
              <td></td>
            </tr>
            <tr>
              <td><div align='left' class='arial09black'>&nbsp;&nbsp;&nbsp;Last Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;First Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Middle Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( example : Dela Cruz, Juan Jr., Sipag)</div></td>
              <td></td>
              <td><div align='center' class='arial09black'>(month-day-year)</td>
            </tr>
          </table></td>
          <td width='2'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td width='2'></td>
          <td width='auto'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='40%'><div align='left' class='arial09black'>4. PhilHealth Identification Number (PIN) of Dependent:</div></td>
              <td width='auto'><table cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='11' height='11' class='table1Bottom1Left1Right'><div align='center' class='arial12black'>".$phicdep0."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicdep1."</div></td>
                  <td width='13' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                  <td width='11' height='11' class='table1Bottom1Left1Right'><div align='center' class='arial12black'>".$phicdep3."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicdep4."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicdep5."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicdep6."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicdep7."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicdep8."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicdep9."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicdep10."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$phicdep11."</div></td>
                  <td width='13' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                  <td width='11' height='11' class='table1Bottom1Left1Right'><div align='center' class='arial12black'>".$phicdep13."</div></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          <td width='2'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td width='2'></td>
          <td width='auto'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='65%' valign='top'><div align='left' class='arial09black'>5. Name of Patient:</div></td>
              <td width='2%'></td>
              <td width='33%' valign='top'><div align='left' class='arial09black'>&nbsp;&nbsp;6. Relationship to Member:</div></td>
            </tr>
            <tr>
              <td height='22' class='table1Bottom' valign='bottom'><div align='left' class='arial11blackbold'>".strtoupper($LNPat).", ".strtoupper($FNPat)." ".strtoupper($MNPat)."</div></td>
              <td></td>
              <td rowspan='2' valign='center'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='20' height='12'></td>
                  <td width='12' height='12' class='table1Top1Bottom1Left1Right'><div align='center' class='arial10blackbold'>$rom1</div></td>
                  <td width='50' height='12' valign='bottom'><div align='left' class='arial09black'>&nbsp;Child</div></td>
                  <td width='12' height='12' class='table1Top1Bottom1Left1Right'><div align='center' class='arial10blackbold'>$rom2</div></td>
                  <td width='50' height='12' valign='bottom'><div align='left' class='arial09black'>&nbsp;Parent</div></td>
                  <td width='12' height='12' class='table1Top1Bottom1Left1Right'><div align='center' class='arial10blackbold'>$rom3</div></td>
                  <td width='50' height='12' valign='bottom'><div align='left' class='arial09black'>&nbsp;Spouse</div></td>
                </tr>
              </table></div></td>
            </tr>
            <tr>
              <td><div align='left' class='arial09black'>&nbsp;&nbsp;&nbsp;Last Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;First Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Middle Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( example : Dela Cruz, Juan Jr., Sipag)</div></td>
              <td></td>
            </tr>
          </table></td>
          <td width='2'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td width='2'></td>
          <td width='auto'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td colspan='6' valign='center'><div align='left' class='arial09black'>7. Confinement Period</div></td>
            </tr>
            <tr>
              <td height='5' colspan='6'></td>
            </tr>
            <tr>
              <td width='12%'><div align='center' class='arial09black'>a. Date Admitted:</div></td>

              <td width='20%' valign='bottom'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>".$dateadmittedarr0."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$dateadmittedarr1."</div></td>
                    </tr>
                  </table></td>
                  <td width='13' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>".$dateadmittedarr3."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$dateadmittedarr4."</div></td>
                    </tr>
                  </table></td>
                  <td width='13' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>".$dateadmittedarr6."</div></td>
                  <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$dateadmittedarr7."</div></td>
                    </tr>
                  </table></td>
                  <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$dateadmittedarr8."</div></td>
                    </tr>
                  </table></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$dateadmittedarr9."</div></td>
                    </tr>
                  </table></td>
                </tr>
              </table></div></td>

              <td width='13%'><div align='center' class='arial09black'>c. Date Discharged:</div></td>

              <td width='20%' valign='bottom'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>".$datedischargedarr0."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$datedischargedarr1."</div></td>
                    </tr>
                  </table></td>
                  <td width='13' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>".$datedischargedarr3."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$datedischargedarr4."</div></td>
                    </tr>
                  </table></td>
                  <td width='13' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>".$datedischargedarr6."</div></td>
                  <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$datedischargedarr7."</div></td>
                    </tr>
                  </table></td>
                  <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$datedischargedarr8."</div></td>
                    </tr>
                  </table></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$datedischargedarr9."</div></td>
                    </tr>
                  </table></td>
                </tr>
              </table></div></td>

              <td width='15%'><div align='center' class='arial09black'>8. Patient Date of Birth:</div></td>

              <td width='20%' valign='bottom'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>".$bdayofpatarr0."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$bdayofpatarr1."</div></td>
                    </tr>
                  </table></td>
                  <td width='13' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>".$bdayofpatarr3."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$bdayofpatarr4."</div></td>
                    </tr>
                  </table></td>
                  <td width='13' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>".$bdayofpatarr6."</div></td>
                  <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$bdayofpatarr7."</div></td>
                    </tr>
                  </table></td>
                  <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$bdayofpatarr8."</div></td>
                    </tr>
                  </table></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>".$bdayofpatarr9."</div></td>
                    </tr>
                  </table></td>
                </tr>
              </table></div></td>

            </tr>
            <tr>
              <td></td>
              <td><div align='center' class='arial09black'>(month-day-year)</td>
              <td></td>
              <td><div align='center' class='arial09black'>(month-day-year)</td>
              <td></td>
              <td><div align='center' class='arial09black'>(month-day-year)</td>
            </tr>
          </table></td>
          <td width='2'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td colspan='3' height='10'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "

        <tr>
          <td width='2'></td>
          <td width='auto'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td valign='top'><div align='left' class='arial09blackbold'>9. CERTIFICATION OF MEMBER:</div></td>
            </tr>
            <tr>
              <td height='28'><div align='left' class='times10blackbold'><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Under the penalty of law, I attest that the information I provided in this Form are true and accurate to the best of my knowledge.</i</div></td>
            </tr>
            <tr>
              <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='18%' height='15'></td>
                  <td width='32%' height='15' class='table1Bottom'><div align='center' class='arial11blackbold'></div></td>
                  <td width='5%' height='15'></td>
                  <td width='39%' height='15' class='table1Bottom'><div align='center' class='arial11blackbold'></div></td>
                  <td width='6%' height='15'></td>
                </tr>
                <tr>
                  <td></td>
                  <td valign='top'><div align='center' class='arial09black'>Signature Over Printed Name of Member</div></td>
                  <td></td>
                  <td valign='top'><div align='center' class='arial09black'>Signature Over Printed Name of Member's Representative</div></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>

                  <td><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='13' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='13' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></div></td>

                  <td></td>
                  <td><div align='center'><table cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='13' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='13' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></div></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td valign='top'><div align='center' class='arial09black'>Date Signed (month-day-year)</div></td>
                  <td></td>
                  <td valign='top'><div align='center' class='arial09black'>Date Signed (month-day-year)</div></td>
                  <td></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height='5'></td>
            </tr>
            <tr>
              <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='35%' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' class='arial09black'>If member/ representative is unable to write, put right thumbmark. Member/ representative should be assisted by an HCI representative. Check the appropriate box:</div></td>
                    </tr>
                    <tr>
                      <td height='25' valign='bottom'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td width='15' height='12'></td>
                          <td width='12' height='12' class='table1Top1Bottom1Left1Right'></td>
                          <td width='80' height='12' valign='bottom'><div align='left' class='arial09black'>&nbsp;Member</div></td>
                          <td width='12' height='12' class='table1Top1Bottom1Left1Right' valign='bottom'></td>
                          <td width='80' height='12' valign='bottom'><div align='left' class='arial09black'>&nbsp;Representative</div></td>
                        </tr>
                      </table></div></td>
                    </tr>
                  </table></td>
                  <td width='2%'></td>
                  <td width='13%'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='70' class='table1Top1Bottom1Left1Right'></td>
                    </tr>
                  </table></td>
                  <td width='20%' valign='bottom'><table width='100%' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='2'></td>
                      <td width='auto'><div align='left' class='arial09black'>Relationship of the</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><div align='left' class='arial09black'>representative to the member:</div></td>
                    </tr>
                    <tr>
                      <td height='8' colspan='2'></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><div align='left' class='arial09black'>Reason for signing on</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><div align='left' class='arial09black'>behalf of the member:</div></td>
                    </tr>
                    <tr>
                      <td height='3' colspan='2'></td>
                    </tr>
                  </table></td>
                  <td width='30%'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='12' height='10'></td>
                      <td width='12' height='12' class='table1Top1Bottom1Left1Right'></td>
                      <td width='40' height='12' valign='bottom'><div align='left' class='arial09black'>&nbsp;Spouse</div></td>
                      <td width='12' height='12' class='table1Top1Bottom1Left1Right' valign='bottom'></td>
                      <td width='40' height='12' valign='bottom'><div align='left' class='arial09black'>&nbsp;Child</div></td>
                      <td width='12' height='12' class='table1Top1Bottom1Left1Right' valign='bottom'></td>
                      <td width='auto' height='12' valign='bottom'><div align='left' class='arial09black'>&nbsp;Parent</div></td>
                    </tr>
                    <tr>
                      <td height='2' colspan='7'></td>
                    </tr>
                    <tr>
                      <td height='12'></td>
                      <td height='12' class='table1Top1Bottom1Left1Right'></td>
                      <td height='12' valign='bottom'><div align='left' class='arial09black'>&nbsp;Sibling</div></td>
                      <td height='12' class='table1Top1Bottom1Left1Right' valign='bottom'></td>
                      <td height='12' valign='bottom' colspan='3'><div align='left' class='arial09black'>&nbsp;Others, specify __________</div></td>
                    </tr>
                    <tr>
                      <td height='2' colspan='7'></td>
                    </tr>
                    <tr>
                      <td height='12'></td>
                      <td height='12' class='table1Top1Bottom1Left1Right'></td>
                      <td height='12' valign='bottom' colspan='5'><div align='left' class='arial09black'>&nbsp;Member is incapacitated</div></td>
                    </tr>
                    <tr>
                      <td height='2' colspan='7'></td>
                    </tr>
                    <tr>
                      <td height='12'></td>
                      <td height='12' class='table1Top1Bottom1Left1Right'></td>
                      <td height='12' valign='bottom' colspan='5'><div align='left' class='arial09black'>&nbsp;Other reasons______________</div></td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          <td width='2'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
      </table></td>
    </tr>

    <tr>
      <td height='5'></td>
    </tr>

    <tr>
      <td height='1' class='table1Top1Bottom'></td>
    </tr>

    <tr>
      <td><div align='center' class='arial11blackbold'>PART II - EMPLOYER'S CERTIFICATION (for employed members only)</div></td>
    </tr>

    <tr>
      <td height='1' class='table1Top1Bottom'></td>
    </tr>

    <tr>
      <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>

";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td width='2'></td>
          <td width='auto'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='25%'><div align='left' class='arial09black'>1.PhilHealth Employer No. (PEN):</div></td>
              <td width='auto'><table cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='11' height='11' class='table1Bottom1Left1Right'><div align='center' class='arial12black'>".$pen0."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$pen1."</div></td>
                  <td width='13' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                  <td width='11' height='11' class='table1Bottom1Left1Right'><div align='center' class='arial12black'>".$pen3."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$pen4."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$pen5."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$pen6."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$pen7."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$pen8."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$pen9."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$pen10."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right'><div align='center' class='arial12black'>".$pen11."</div></td>
                  <td width='13' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                  <td width='11' height='11' class='table1Bottom1Left1Right'><div align='center' class='arial12black'>".$pen13."</div></td>
                </tr>
              </table></td>
              <td width='2%'></td>
              <td width='auto'><div align='left' class='arial09black'>2. Contact No.:</div></td>
              <td width='20%' class='table1Bottom'><div align='left' class='arial10black'>$employercontactno</div></td>
              <td width='10%'></td>
            </tr>
          </table></td>
          <td width='2'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td width='2'></td>
          <td width='auto'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='25%'><div align='left' class='arial09black'>3. Business Name:</div></td>
              <td width='auto' class='table1Bottom'></td>
              <td width='10%'></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='center' class='arial08black'>Business Name of Employer</div></td>
              <td></td>
            </tr>
          </table></td>
          <td width='2'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td width='2'></td>
          <td width='auto'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='arial09blackbold'>4. CERTIFICATION OF EMPLOYER:</div></td>
            </tr>
            <tr>
              <td height='5'></td>
            </tr>
            <tr>
              <td><div align='justify' class='arial09blackbold'><i>&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that all monthly premium contributions for and in behalf of the member, while employed in this company, including the applicable three (3) monthly premium contributions within the past six (6) months period prior to the first day of this confinement, have been deducted/collected and remitted to PhilHealth, and that the information supplied by the member or his/her representative on Part I are consistent with our available records.</i></div></td>
            </tr>
          </table></td>
          <td width='2'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td width='2'></td>
          <td width='auto'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='45%' height='22' class='table1Bottom'><div align='center' class='arial10black'></div></td>
              <td width='2%' height='20'></td>
              <td width='25%' height='20' class='table1Bottom'><div align='center' class='arial10black'></div></td>
              <td width='2%' height='20'></td>
              <td width='auto' height='20' valign='bottom'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></td>
                  <td width='15' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></td>
                  <td width='15' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                  <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></td>
                  <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></td>
                </tr>
              </table></div></td>
              <td width='6%'></td>
            </tr>
            <tr>
              <td><div align='center' class='arial09black'>Signature Over Printed Name of Employer / Authorized Representative</div></td>
              <td></td>
              <td><div align='center' class='arial09black'>Official Capacity / Designation</div></td>
              <td></td>
              <td><div align='center' class='arial09black'>Date Signed (month-day-year)</div></td>
              <td></td>
            </tr>
          </table></td>
          <td width='2'></td>
        </tr>
";

echo "
      </table></td>
    </tr>

    <tr>
      <td height='2'></td>
    </tr>

    <tr>
      <td height='1' class='table1Top1Bottom'></td>
    </tr>

    <tr>
      <td><div align='center' class='arial11blackbold'>PART III - CONSENT TO ACCESS PATIENT RECORD/S</div></td>
    </tr>

    <tr>
      <td height='1' class='table1Top1Bottom'></td>
    </tr>

    <tr>
      <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>

";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td width='2'></td>
          <td width='auto'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='arial09blackbold'><i>I hereby consent to the examination by PhilHealth of the patient's medical records for the purpose of verifying the veracity of this claim.</i></div></td>
            </tr>
            <tr>
              <td height='3'></td>
            </tr>
            <tr>
              <td><div align='left' class='arial09blackbold'><i>I hereby hold PhilHealth or any of its officers, employees and/or representatives free from any and all liabilities relative to the herein-mentioned</i></div></td>
            </tr>
            <tr>
              <td height='3'></td>
            </tr>
            <tr>
              <td><div align='left' class='arial09blackbold'><i>consent which I have voluntarily and willingly given in connection with this claim for reimbursement before PhilHealth.</i></div></td>
            </tr>
          </table></td>
          <td width='2'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td width='2'></td>
          <td width='auto'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='10' height='20'></td>
              <td width='auto' height='20' class='table1Bottom'></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='center' class='arial09black'>Signature Over Printed Name of Member/ Patient/ Authorized Representative</div></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></td>

                  <td width='13' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></td>
                  <td width='13' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>

                  <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></td>
                  <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>

                  </table></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></td>
                </tr>
              </table></div></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='center' class='arial09black'>(Date Signed (month-day-year)</div></td>
            </tr>
          </table></div></td>
          <td width='2'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td width='2'></td>
          <td width='auto'><div align='left'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='15%'  height='20' valign='top'><div align='left' class='arial09black'>Relationship of the<br />representative to the<br />member:/ patient:<br /><br />Reason for signing on<br />behalf of the<br />member:/ patient:</div></td>
              
              <td width='30%'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='10' height='10'></td>
                  <td width='12' height='12' class='table1Top1Bottom1Left1Right'></td>
                  <td width='40' height='12' valign='bottom'><div align='left' class='arial09black'>&nbsp;Spouse</div></td>
                  <td width='12' height='12' class='table1Top1Bottom1Left1Right' valign='bottom'></td>
                  <td width='40' height='12' valign='bottom'><div align='left' class='arial09black'>&nbsp;Child</div></td>
                  <td width='12' height='12' class='table1Top1Bottom1Left1Right' valign='bottom'></td>
                  <td width='auto' height='12' valign='bottom'><div align='left' class='arial09black'>&nbsp;Parent</div></td>
                </tr>
                <tr>
                  <td height='2' colspan='7'></td>
                </tr>
                <tr>
                  <td height='10'></td>
                  <td height='12' class='table1Top1Bottom1Left1Right'></td>
                  <td height='12' valign='bottom'><div align='left' class='arial09black'>&nbsp;Sibling</div></td>
                  <td height='12' class='table1Top1Bottom1Left1Right' valign='bottom'></td>
                  <td height='12' valign='bottom' colspan='3'><div align='left' class='arial09black'>&nbsp;Others, specify __________</div></td>
                </tr>
                <tr>
                  <td height='2' colspan='7'></td>
                </tr>
                <tr>
                  <td height='10'></td>
                  <td height='12' class='table1Top1Bottom1Left1Right'></td>
                  <td height='12' valign='bottom' colspan='5'><div align='left' class='arial09black'>&nbsp;Patient is incapacitated</div></td>
                </tr>
                <tr>
                  <td height='2' colspan='7'></td>
                </tr>
                <tr>
                  <td height='10'></td>
                  <td height='12' class='table1Top1Bottom1Left1Right'></td>
                  <td height='12' valign='bottom' colspan='5'><div align='left' class='arial09black'>&nbsp;Other reasons______________</div></td>

                </tr>
              </table></td>
              <td width='2%'></td>
              <td width='35%'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><div align='left' class='arial09black'>If patient/ representative is unable to write, put right<br />thumbmark. Patient/ representative should be assisted<br />by an HCI representative. Check the appropriate box:</div></td>
                </tr>
                <tr>
                  <td height='8'></td>
                </tr>
                <tr>
                  <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='10' height='12'></td>
                      <td width='12' height='12' class='table1Top1Bottom1Left1Right'></td>
                      <td width='auto' height='12'><div align='left' class='arial09black'>&nbsp;Patient</div></td>
                      <td width='12' height='12' class='table1Top1Bottom1Left1Right'></td>
                      <td width='auto' height='12'><div align='left' class='arial09black'>&nbsp;Representative</div></td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
              <td width='13%'><div align='left'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td height='70' class='table1Top1Bottom1Left1Right'></td>
                </tr>
              </table></div></td>
              <td width='5%'></td>
            </tr>
          </table></div></td>
          <td width='2'></td>
        </tr>
";

echo "
      </table></td>
    </tr>
";


echo "
    <tr>
      <td height='30'>&nbsp;</td>
    </tr>
";


/*BACK-------BACK-------BACK-------BACK-------BACK-------BACK-------BACK-------BACK-------BACK-------BACK*/


echo "
    <tr>
      <td height='1' class='table1Top1Bottom'></td>
    </tr>

    <tr>
      <td><div align='center' class='arial11blackbold'>PART IV - HEALTH CARE PROFESSIONAL INFORMATION</div></td>
    </tr>

    <tr>
      <td height='1' class='table1Top1Bottom'></td>
    </tr>

    <tr>
      <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td width='2'></td>
          <td width='auto'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='50%' valign='top'><div align='center'><table border'0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='auto' valign='top'><div align='left' class='arial09blackbold'><i>Accreditation No.&nbsp;&nbsp;&nbsp;</i></div></td>
                  <td><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='13' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='13' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                      <td width='11' height='11' class='table1Bottom1Left1Right' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></div></td>
                </tr>
                <tr>
                  <td colspan='2' height='15' class='table1Bottom'></td>
                </tr>
                <tr>
                  <td colspan='2'><div align='center' class='arial09black'>Signature Over Printed Name</div></td>
                </tr>
                <tr>
                  <td colspan='2' height='10'></td>
                </tr>
                <tr>
                  <td colspan='2'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='13' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='13' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></div></td>
                </tr>
                <tr>
                  <td colspan='2'><div align='center' class='arial09black'>Date Signed (month-day-year)</div></td>
                </tr>
              </table></div></td>



              <td width='50%' valign='top'><div align='center'><table border'0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='auto' valign='top'><div align='left' class='arial09blackbold'><i>Accreditation No.&nbsp;&nbsp;&nbsp;</i></div></td>
                  <td><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='13' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='13' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                      <td width='11' height='11' class='table1Bottom1Left1Right' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></div></td>
                </tr>
                <tr>
                  <td colspan='2' height='15' class='table1Bottom'></td>
                </tr>
                <tr>
                  <td colspan='2'><div align='center' class='arial09black'>Signature Over Printed Name</div></td>
                </tr>
                <tr>
                  <td colspan='2' height='10'></td>
                </tr>
                <tr>
                  <td colspan='2'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='13' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='13' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></div></td>
                </tr>
                <tr>
                  <td colspan='2'><div align='center' class='arial09black'>Date Signed (month-day-year)</div></td>
                </tr>
              </table></div></td>
            </tr>

            <tr>
              <td height='20' colspan='2'></td>
            </tr>

            <tr>
              <td width='50%' valign='top'><div align='center'><table border'0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='auto' valign='top'><div align='left' class='arial09blackbold'><i>Accreditation No.&nbsp;&nbsp;&nbsp;</i></div></td>
                  <td><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='13' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='13' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                      <td width='11' height='11' class='table1Bottom1Left1Right' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></div></td>
                </tr>
                <tr>
                  <td colspan='2' height='15' class='table1Bottom'></td>
                </tr>
                <tr>
                  <td colspan='2'><div align='center' class='arial09black'>Signature Over Printed Name</div></td>
                </tr>
                <tr>
                  <td colspan='2' height='10'></td>
                </tr>
                <tr>
                  <td colspan='2'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='13' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>-</div></td>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='13' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>-</span></div></td>
                      <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                      <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></div></td>
                </tr>
                <tr>
                  <td colspan='2'><div align='center' class='arial09black'>Date Signed (month-day-year)</div></td>
                </tr>
              </table></div></td>
              <td width='50%'></td>
            </tr>

          </table></div></td>
          <td width='2'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
      </table></td>
    </tr>

    <tr>
      <td height='20'></td>
    </tr>

    <tr>
      <td height='1' class='table1Top1Bottom'></td>
    </tr>

    <tr>
      <td><div align='center' class='arial11blackbold'>PART V - PROVIDER INFORMATION AND CERTIFICATION</div></td>
    </tr>

    <tr>
      <td height='1' class='table1Top1Bottom'></td>
    </tr>

    <tr>
      <td height='15'></td>
    </tr>

    <tr>
      <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='2'></td>
          <td><div align='left' class='arialnarrow10blackbold'><i>I certify that services rendered were recorded in the patient's chart and health care institution records and that the herein information given are true and correct.</i></div></td>
          <td width='2'></td>
        </tr>
        <tr>
          <td height='15' colspan='3'></td>
        </tr>
        <tr>
          <td width='2'></td>
          <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='40%' class='table1Bottom'></td>
              <td width='2%'></td>
              <td width='30%' class='table1Bottom'></td>
              <td width='2%'></td>
              <td width='auto'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></td>
                  <td width='25' height='11' class='table1Left1Left'><div align='center' class='arial12blackbold'>&nbsp;</div></td>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></td>
                  <td width='25' height='11' class='table1Left1Left'><div align='center'><span class='arial12blacbold'>&nbsp;</span></div></td>
                  <td width='11' height='11' class='table1Bottom1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                  <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></td>
                  <td width='11' height='11' class='table1Bottom' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></td>
                  <td width='11' height='11' class='table1Bottom1Right' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='9' class='table1Left' valign='bottom'><div align='center' class='arial12black'>"." "."</div></td>
                    </tr>
                  </table></td>
                </tr>
              </table></div></td>
            </tr>

            <tr>
              <td><div align='center' class='arial09black'>Signature Over Printed Name Authorized HCI Representative</div></td>
              <td></td>
              <td><div align='center' class='arial09black'>Official Capacity / Designation</div></td>
              <td></td>
              <td><div align='center' class='arial09black'>Date Signed (month-day-year)</div></td>
            </tr>
          </table></td>
          <td width='2'></td>
        </tr>
";

//-----------------------------------------------------------------------------------------------------

echo "
      </table></td>
    </tr>
";


echo "
  </table>
</div>
";




?> 
</body>
</html>
