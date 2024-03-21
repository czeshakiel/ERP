<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Unsubmitted Claims</title>
  <!-- Favicon -->
  <link rel="icon" href="../extra/Resources/Favicon/favicon.png" type="image/png" />
  <link rel="shortcut icon" href="../extra/Resources/Favicon/favicon.png" type="image/png" />
  <!-- My CSS -->
  <link href="../extra/Resources/CSS/mycss.css" rel="stylesheet">
  <link href="../extra/Resources/CSS/mystyle.css" rel="stylesheet">
  <script type="text/JavaScript">
  <!--
    function MM_goToURL() { //v3.0
      var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
      for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
    }
    function OpenInNewTab(url) {
      var win = window.open(url, '_blank');
      win.focus();
    }
  //-->
  </script>
  <style>
    /* Styles go here */
    .page-header, .page-header-space {height: 120px;}
    .page-footer, .page-footer-space {height: 70px;}
    .page-footer {position: fixed;bottom: 0;width: 100%;background: #FFFFFF;}
    .page-header {position: fixed;top: 0mm;width: 100%;background: #FFFFFF;}
    .page {page-break-after: always;}

    @page {margin: 20mm}

    @media print {
      thead {display: table-header-group;}
      tfoot {display: table-footer-group;}
      button {display: none;}
      body {margin: 0;}
    }
    .prntbtn{background: #FD75C4;font-weight: bold;color: #000000;border: 2px solid #000000;border-radius: 5px;padding: 5px 10px;}
    .prntbtn:hover{background: #FA1499;color: #FFFFFF;}
  </style>
</head>
<body>
<?php
include("../extra/outcon.php");
include("../main/connection.php");

echo "
<div class='page-header' style='text-align: left'>
  <button type='button' onClick='window.print()' class='prntbtn'>&#x2399; PRINT ME!</button>
  <table border='0' width='50%' cellpadding='0' cellspacing='0'>
    <tr>
      <td width='120'><div align='left' style='font-family: times new roman;font-size: 13px;color: #000000;padding: 3px 0;'>HOSPITAL NAME</div></td>
      <td width='8'><div align='center' style='font-family: times new roman;font-size: 13px;color: #000000;padding: 3px 0;'>:</div></td>
      <td width='auto' class='b1'><div align='left' style='font-family: times new roman;font-size: 13px;font-weight: bold;color: #000000;padding: 3px 3px;'>KIDAPAWAN MEDICAL SPECIALISTS CENTER, INC.</div></td>
    </tr>
    <tr>
      <td><div align='left' style='font-family: times new roman;font-size: 13px;color: #000000;padding: 3px 0;'>HOSPITAL CODE</div></td>
      <td><div align='center' style='font-family: times new roman;font-size: 13px;color: #000000;padding: 3px 0;'>:</div></td>
      <td class='b1'><div align='left' style='font-family: times new roman;font-size: 13px;font-weight: bold;color: #000000;padding: 3px 3px;'>H12017336</div></td>
    </tr>
    <tr>
      <td><div align='left' style='font-family: times new roman;font-size: 13px;color: #000000;padding: 3px 0;'>ADDRESS</div></td>
      <td><div align='center' style='font-family: times new roman;font-size: 13px;color: #000000;padding: 3px 0;'>:</div></td>
      <td class='b1'><div align='left' style='font-family: times new roman;font-size: 13px;font-weight: bold;color: #000000;padding: 3px 3px;'>BRGY. SUDAPIN, KIDAPAWAN CITY, NORTH COTABATO 9400</div></td>
    </tr>
    <tr>
      <td colspan='3'><div align='left' style='font-family: times new roman;font-size: 13px;font-weight: bold;color: #000000;padding: 3px 0;'>REPORT OF UNSUBMITTED CLAIMS - IBNR</div></td>
    </tr>
    <tr>
      <td colspan='3'><div align='left' style='font-family: times new roman;font-size: 13px;color: #000000;padding: 3px 0;'>As of <u>2024</u></div></td>
    </tr>
  </table>
</div>

<div class='page-footer'>
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td width='33%'><div align='left'>
        <table border='0' width='80%' cellpadding='0' cellspacing='0'>
          <tr>
            <td><div align='left' style='font-size: 13px;color: #000000;'>Prepared by:</div></td>
          </tr>
          <tr>
            <td height='30' class='b1'></td>
          </tr>
          <tr>
            <td><div align='left' style='font-size: 13px;color: #000000;'>&nbsp;</div></td>
          </tr>
        </table>
      </td>
      <td width='34%'><div align='left'>
        <table border='0' width='80%' cellpadding='0' cellspacing='0'>
          <tr>
            <td><div align='left' style='font-size: 13px;color: #000000;'>Certified Complete and Accurate by:</div></td>
          </tr>
          <tr>
            <td height='30' class='b1'></td>
          </tr>
          <tr>
            <td><div align='left' style='font-size: 13px;color: #000000;'>Chief Accountant</div></td>
          </tr>
        </table>
      </div></td>
      <td width='33%'><div align='left'>
        <table border='0' width='80%' cellpadding='0' cellspacing='0'>
          <tr>
            <td><div align='left' style='font-size: 13px;color: #000000;'>Approved by:</div></td>
          </tr>
          <tr>
            <td height='30' class='b1'></td>
          </tr>
          <tr>
            <td><div align='left' style='font-size: 13px;color: #000000;'>Medical Director/Chief of Hospital/Owner</div></td>
          </tr>
        </table>
      </div></td>
    </tr>
  </table>
</div>

<table width='100%' border='0' cellpadding='0' cellspacing='0'>
  <thead>
    <tr>
      <td>
        <div class='page-header-space'></div>
      </td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
";

//$a=0;
//$kpsql=mysqli_query($mycon3,"SELECT `caseno` FROM `statusinfo` WHERE `setready`='transmitted' AND (`pStatus` LIKE 'IN PROCESS' OR `pStatus` LIKE 'DENIED') AND `td` BETWEEN '2022-08-01' AND '2023-12-01'");
//$kpcount=mysqli_num_rows($kpsql);
//$tpcount=$kpcount/20;

//if(stripos($tpcount, ".") !== FALSE){
  //$tpcs=preg_split("/\./",$tpcount);
  //$tpcount=$tpcs[0]+1;
//}

//for($xx=0;$xx<$tpcount;$xx++){
  //$pxx=20*$xx;

echo "
        <div class='page' align='left'>
          <table border='0' width='98%' cellpadding='0' cellspacing='0'>
            <tr>
              <td rowspan='2' class='t1 b1 l1' width='30'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>Item<br />No.</div></td>
              <td rowspan='2' class='t1 b1 l1' width='80'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>Claims<br />Code/<br />Reference<br />Number</div></td>
              <td colspan='3' class='t1 b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>Patient Name</div></td>
              <td colspan='3' class='t1 b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>Member Name</div></td>
              <td rowspan='2' class='t1 b1 l1' width='70'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>Member's<br />PIN</div></td>
              <td rowspan='2' class='t1 b1 l1' width='55'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>Date of<br />Admission</div></td>
              <td rowspan='2' class='t1 b1 l1' width='55'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>Date of<br />Discharged</div></td>
              <td rowspan='2' class='t1 b1 l1' width='55'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>Case Rate<br />Claim<br />amount</div></td>
              <td rowspan='2' class='t1 b1 l1' width='70'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>ICD 10<br />RVS Code</div></td>
              <td rowspan='2' class='t1 b1 l1 r1' width='75'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>Claim<br />Status</div></td>
            </tr>
            <tr>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>Surname</div></td>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>First Name</div></td>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>Middle Name</div></td>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>Surname</div></td>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>First Name</div></td>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>Middle Name</div></td>
            </tr>
";

  mysqli_query($conn,"SET NAMES 'utf8'");
  $asql=mysqli_query($conn,"SELECT dt.`caseno`, dt.`datedischarged`, dt.`timedischarged`, dt.`datearray`, a.`patientidno`, a.`dateadmit`, a.`membership` FROM `dischargedtable` dt, `admission` a WHERE dt.`caseno`=a.`caseno` AND a.`membership`='phic-med' AND dt.`count` NOT LIKE '9' AND a.`caseno` NOT LIKE '%R-%' AND dt.`datearray` BETWEEN '2023-11-01' AND '2023-12-31' ORDER BY dt.`datearray`, dt.`patientname`");
  while($afetch=mysqli_fetch_array($asql)){
    $caseno=$afetch['caseno'];
    $patid=$afetch['patientidno'];
    $ad=$afetch['dateadmit'];
    $dd=$afetch['datearray'];

    $ecsql=mysqli_query($mycon3,"SELECT `status` FROM `caseno` WHERE `caseno`='$caseno'");
    $eccount=mysqli_num_rows($ecsql);
    if($eccount==0){
      $yr=date("Y",strtotime($td));
      $admission=date("m/d/Y",strtotime($ad));
      $discharged=date("m/d/Y",strtotime($dd));
      $received=date("m/d/Y",strtotime($td));

      $bsql=mysqli_query($conn,"SELECT `lastname`, `firstname`, `middlename`, `suffix` FROM `patientprofile` WHERE `patientidno`='$patid'");
      $bfetch=mysqli_fetch_array($bsql);
      $pln=trim(mb_strtoupper($bfetch['lastname']));
      $pfn=trim(mb_strtoupper($bfetch['firstname']));
      $pmn=trim(mb_strtoupper($bfetch['middlename']));
      $psf=trim(mb_strtoupper($bfetch['suffix']));

      $csql=mysqli_query($conn,"SELECT `lastname`, `firstname`, `middlename`, `identificationno` FROM `claiminfo` WHERE `caseno`='$caseno'");
      $ccount=mysqli_num_rows($csql);
      if($ccount>0){
        $cfetch=mysqli_fetch_array($csql);
        $pin=$cfetch['identificationno'];

        if($pin=="."){}
        else if($pin=="-"){}
        else{
          $a++;
          $mln=trim(mb_strtoupper($cfetch['lastname']));
          $mfn=trim(mb_strtoupper($cfetch['firstname']));
          $mmn=trim(mb_strtoupper($cfetch['middlename']));

          $d=0;
          $cr="";
          $dsql=mysqli_query($conn,"SELECT `icdcode` FROM `finalcaserate` WHERE `caseno`='$caseno' AND (`level`='primary' OR `level`='secondary')");
          $dcount=mysqli_num_rows($dsql);
          while($dfetch=mysqli_fetch_array($dsql)){
            $d++;
            if($d==2){$mid=", ";}else{$mid="";}
            $cr=$cr.$mid.$dfetch['icdcode'];
          }

echo "
            <tr>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>$a</div></td>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>$caseno</div></td>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>$pln</div></td>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>$pfn</div></td>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>$pmn</div></td>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>$mln</div></td>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>$mfn</div></td>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>$mmn</div></td>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>$pin</div></td>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>$admission</div></td>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>$discharged</div></td>
              <td class='b1 l1'><div align='right' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>".number_format($cramt,2)."</div></td>
              <td class='b1 l1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'>$cr</div></td>
              <td class='b1 l1 r1'><div align='center' style='font-family: times new roman;font-size: 10px;color: #000000;padding: 2px 2px;'></div></td>
            </tr>
";
        }
      }
    }
  }

echo "
          </table>
        </div>
";
//}

echo "
      </td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <td>
        <div class='page-footer-space'></div>
      </td>
    </tr>
  </tfoot>
</table>
";

?>
</body>

</html>
