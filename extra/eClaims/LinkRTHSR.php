<?php
$ipm=$_SERVER['HTTP_HOST'];
$ip="192.168.0.100:100";

$user="";
$userunique="";

mysqli_query($mycon1,"SET NAMES 'utf8'");

echo "
  <table border='0' width='100%' cellpadding='0' cellspacing='0' style='background-color: #FFFFFF;'>
    <tr>
      <td><table border='0' width='100%' cellpadding='0' cellspacing='0' class='hoverTable'>
        <tr>
          <td class='t2 b2 l2' width='30'><div align='center' class='arial s12 black bold'>#</div></td>
          <!-- td class='t2 b2 l1'><div align='center' class='arial s12 black bold'>Case No.</div></td -->
          <td class='t2 b2 l1'><div align='center' class='arial s12 black bold'>Patient Name</div></td>
          <td class='t2 b2 l1' width='100'><div align='center' class='arial s12 black bold'>Patient Type</div></td>
          <td class='t2 b2 l1' width='200'><div align='center' class='arial s12 black bold'>Confinement Period</div></td>
          <td class='t2 b2 l1' width='150'><div align='center' class='arial s12 black bold'>Case Rate</div></td>
          <td class='t2 b2 l1 r2' width='100'><div align='center' class='arial s12 black bold'>Action</div></td>
        </tr>
";

$a=0;
$asql=mysqli_query($mycon1,"SELECT dt.`caseno`, dt.`datedischarged`, dt.`timedischarged`, dt.`datearray`, a.`patientidno`, a.`dateadmit`, a.`membership`, p.`lastname`, p.`firstname`, p.`middlename`, p.`suffix` FROM `dischargedtable` dt, `admission` a, `patientprofile` p WHERE dt.`caseno`=a.`caseno` AND a.`patientidno`=p.`patientidno` AND a.`membership`='phic-med' AND a.`caseno` NOT LIKE '%R-%' AND CONCAT(p.lastname, ' ', p.firstname, ' ', p.middlename) LIKE '%$searchme%' ORDER BY dt.`datearray`, dt.`patientname`");
while($afetch=mysqli_fetch_array($asql)){
$caseno=$afetch['caseno'];
$patientidno=$afetch['patientidno'];
$datedischarged=$afetch['datedischarged'];
$timedischarged=$afetch['timedischarged'];
$datearray=$afetch['datearray'];
$a++;

$patientidno=$afetch['patientidno'];
$dateadmit=$afetch['dateadmit'];
$membership=$afetch['membership'];

$csql=mysqli_query($mycon1,"SELECT * FROM `patientprofile` WHERE `patientidno`='$patientidno'");
$cfetch=mysqli_fetch_array($csql);
$ln=$cfetch['lastname'];
$fn=$cfetch['firstname'];
$mn=$cfetch['middlename'];
$sf=$cfetch['suffix'];

$cr="";
$d=0;
$dsql=mysqli_query($mycon1,"SELECT `icdcode` FROM `finalcaserate` WHERE `caseno`='$caseno' AND (`level`='primary' OR `level`='secondary')");
$dcount=mysqli_num_rows($dsql);
while($dfetch=mysqli_fetch_array($dsql)){
$d++;

if(($d!=1)){$ck="; ";}else{$ck="";}
  $ic=$dfetch['icdcode'];
  $cr=$cr.$ck.$ic;
}


$strStart=$datearray;
$strEnd=date("Y-m-d");
$from=$strStart;
$to=$strEnd;
$total=strtotime($to) - strtotime($from);
$days=round($total / (60 * 60 * 24));
$val=$days;

$val2="";

if(stripos($caseno, "I-") !== FALSE){
  $pattype="IPD";
}
else if(stripos($caseno, "O-") !== FALSE){
  $pattype="OPD";
}
else if(stripos($caseno, "R-") !== FALSE){
  $pattype="RDU";
}
else{
  $pattype=$caseno;
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$ecsql=mysqli_query($mycon5,"SELECT * FROM `courseward` WHERE `caseno`='$erthcaseno'");
$eccount=mysqli_num_rows($ecsql);
if($eccount==0){
  $ipbtn="on";
}
else{
  $ipbtn="";

}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

echo "
        <tr>
          <td class='b1 l2' height='30'><div align='left' class='arial s14 black'>&nbsp;$a&nbsp;</div></td>
          <!-- td class='b1 l1'><div align='left' class='arial s14 black'>&nbsp;$caseno&nbsp;</div></td -->
          <td class='b1 l1'><div align='left' class='arial s14 black'>&nbsp;$ln, $fn $sf $mn&nbsp;</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'>&nbsp;$pattype&nbsp;</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'>".date("M d, Y",strtotime($dateadmit))." to ".date("M d, Y",strtotime($datearray))."</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'>$cr</div></td>
          <td class='b1 l1 r2' valign='middle'><div align='center' class='arial s14 black btnstyle'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
";

if($ipbtn=="on"){
echo "
              <td><a href='EuroLinkLoadCF4.php?patientidno=$patientidno&caseno=$caseno&erthcaseno=$erthcaseno&uname=$unm'";?> onclick="return confirm('Import CF4 Data to eClaims?');" <?php echo "><button type='button' class='btn import' title='Link Patient & Import CF4 Data to eClaims' style='background-color: #02AA02;color: #FFFFFF;border-radius: 3px;width: 50px;cursor: pointer;'><i class='fa fa-upload'></i></button></a></td>
";
}
else{
echo "
              <td><button type='button' class='btn dis' title='Already Imported' style='background-color: #DEDEDE;color: #565656;border-radius: 3px;width: 50px;cursor: no-drop;' disabled><i class='fa fa-upload'></i></button></td>
";
}


echo "
            </tr>
          </table></div></td>
        </tr>

";
}

echo "
        <tr>
          <td colspan='6' class='t2'></td>
        </tr>
      </table></td>
    </tr>
  </table>
";
?>
