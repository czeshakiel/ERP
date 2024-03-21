<?php
$lb="Daily Discharged Report (Out-Patient)";

if(isset($_GET['startdate'])){$startdate=mysqli_real_escape_string($conn,$_GET['startdate']);}
else{$startdate=date("Y-m-d");}

echo "
    <!-- Body: Body -->
    <div class='body d-flex py-lg-3 py-md-2'>
      <div class='container-xxl'>
        <div class='row align-items-center'>
          <div class='border-0 mb-4'>
            <div class='card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap'>
              <h3 class='fw-bold mb-0'>$lb</h3>
            </div>
          </div>
        </div> <!-- Row end  -->
        <div class='row clearfix g-3'>
          <div class='col-sm-12'>
            <div class='card mb-3'>
              <div class='card-body'>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td><div align='left'>
                      <form method='get'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><div style='font-family: arial;font-weight: bold;font-size: 16px;color: #089AD1;padding: 0 0 0 3px;'>Select Date</div></td>
                            <td><div style='padding: 0 3px 0 3px;'><input type='date' name='startdate' value='$startdate' style='height: 30px;border-radius: 3px;padding: 3px;' required /></div></td>
                            <td><div style='padding: 0 3px 0 3px;'><button type='submit' class='btn btn-primary btn-sm' style='width: 100px;' title='Submit'><i class='icofont-ui-next'></i></button></div></td>
                          </tr>
                        </table>
                        <input type='hidden' name='dadr' />
                      </form>
                    </div></td>
                  </tr>

";

if(!isset($_GET['startdate'])){
echo "
                  <tr>
                    <td height='550'></td>
                  </tr>
";
}
else{
echo "
                  <tr>
                    <td height='30'></td>
                  </tr>
                  <tr>
                    <td><div align='center'>
                      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><div align='right'><button type='button' onclick=printDiv('printableArea') class='btn btn-success btn-sm' style='width: 100px;' title='Print'><i class='icofont-print'></i></button></div></td>
                        </tr>
                        <tr>
                          <td><div id='printableArea'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='10'></td>
                              </tr>
                              <tr>
                                <td><div align='center'>
                                  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                                    <tr>
                                      <td align='right' width='130'><div style='height: 100px;widtd: 100px;'><img src='../extra/Resources/Logo/logo.png' widtd='100' height='100' /></div></td>
                                      <td align='center' widtd='auto'><label style='font-size:18px;font-family: Times New Roman;font-weight: bold;'>$heading</label><p>$address</p><br /><label style='font-size: 24px;font-family: Times New Roman;font-weight: bold;'>DAILY DISCHARGED REPORT<br />(Out-Patient)</label><br />".date('F d, Y',strtotime($startdate))."</td>
                                      <td width='130'></td>
                                    </tr>
                                  </table>
                                </div></td>
                              </tr>
                              <tr>
                                <td height='10'></td>
                              </tr>
                              <tr>
                                <td>
                                  <table class='table table-bordered table-striped' style='font-size:8px;'>
                                    <tr>
                                      <td><u>PATIENT NAME</u></td>
                                      <td><div align='right'><u>COH</u></div></td>
                                      <td><div align='right'><u>DP</u></div></td>
                                      <td><div align='right'><u>DISC SC</u></div></td>
                                      <td><div align='right'><u>DISC REG</u></div></td>
                                      <td><div align='right'><u>DISC OT</u></div></td>
                                      <td><div align='right'><u>AR-HMO</u></div></td>
                                      <td><div align='right'><u>AR-PHIC</u></div></td>
                                      <td><div align='right'><u>AR-TRADE</u></div></td>
                                      <td><div align='right'><u>DEBIT</u></div></td>
                                      <td>&nbsp;</td>
                                      <td><div align='right'><u>Pharma Meds</u></div></td>
                                      <td><div align='right'><u>Pharma Sups</u></div></td>
                                      <td><div align='right'><u>Lab</u></div></td>
                                      <td><div align='right'><u>Rad</u></div></td>
                                      <td><div align='right'><u>Other Sups</u></div></td>
                                      <td><div align='right'><u>Oxygen</u></div></td>
                                      <td><div align='right'><u>Room</u></div></td>
                                      <td><div align='right'><u>NS Fee</u></div></td>
                                      <td><div align='right'><u>NS Charges</u></div></td>
                                      <td><div align='right'><u>Other Fees</u></div></td>
                                      <td><div align='right'><u>Certification</u></div></td>
                                      <td><div align='right'><u>Miscellaneous</u></div></td>
                                      <td><div align='right'><u>CREDIT</u></div></td>
                                    </tr>

";

  $debitgrand=0;$creditgrand=0;$totaldebit=0;$totalgain=0;$coh1=0;$disc1=0;$dp1=0;$dswd1=0;$mswd1=0;$phic2=0;$artrade1=0;$discreg1=0;
  $med1=0;$sup1=0;$lab1=0;$rad1=0;$othersup1=0;$oxygen1=0;$room1=0;$nsfee1=0;$nscharge1=0;$otherfee1=0;$cert1=0;$misc1=0;
  $amount1=0;$coh=0;$disc=0;$dp=0;$dswd=0;$mswd=0;$artrade=0;$discreg=0;$dep2=0;$artrade1=0;$otherdisc1=0;$credittotal=0;$debittotal=0;
  $sqlPatient=mysqli_query($conn,"SELECT `patientname`,caseno,timedischarged,datearray FROM dischargedtable WHERE (datearray='$startdate' AND timedischarged > '12:00:00 AM' AND caseno LIKE '%O-%') OR (datearray='$startdate' AND timedischarged <= '11:59:00 PM' AND caseno LIKE '%O-%')");
  if(mysqli_num_rows($sqlPatient)>0){
    while($patient=mysqli_fetch_array($sqlPatient)){
      $name=$patient['patientname'];
      $caseno=$patient['caseno'];
      $timedischarged=date('H:i:s',strtotime($patient['timedischarged']));
      $datearray=$patient['datearray'];

      $sql42="SELECT SUM(amount) as amount FROM acctgenledge WHERE caseno='$caseno' AND acctitle LIKE '%CASHONHAND%'";
      $sqlCOH=mysqli_query($conn,$sql42);
      $debit2=mysqli_fetch_array($sqlCOH);
      $amount1=$debit2['amount'];
      $sql41="SELECT SUM(gross-phic-hmo) as amount,SUM(adjustment) as discount,SUM(phic) as phic,SUM(hmo) as hmo FROM productout WHERE caseno='$caseno' AND (producttype NOT LIKE '%IPD comanaged%' AND producttype NOT LIKE '%IPD attending%' AND producttype NOT LIKE '%CONSULTATION%') AND trantype='charge'";
      $sqlDebit1=mysqli_query($conn,$sql41);
      $debit1=mysqli_fetch_array($sqlDebit1);

      $checkSenior=mysqli_query($conn,"SELECT * FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$caseno' AND pp.senior LIKE '%Y%'");
      if(mysqli_num_rows($checkSenior)>0){
        $discsen=$debit1['discount'];
        $disc=$disc+$discsen;
        $discregular=0;
      }
      else{
        $discregular=$debit1['discount'];
        $discreg=$discreg+$discregular;
        $discsen=0;
      }

      $phic=0;
      $sqlPHIC=mysqli_query($conn,"SELECT hospitalshare FROM finalcaserate WHERE caseno='$caseno'");
      while($phicamount=mysqli_fetch_array($sqlPHIC)){
        $phic+=$phicamount['hospitalshare'];
      }

      $hmo=$debit1['hmo'];

      $sqlDep=mysqli_query($conn,"SELECT SUM(amount) as Deposit FROM acctgenledge WHERE caseno='$caseno' AND acctitle LIKE '%PATIENT DEPOSIT%'");
      if(mysqli_num_rows($sqlDep)>0){
        $dep1=mysqli_fetch_array($sqlDep);
        $dep=$dep1['Deposit'];
      }
      else{
        $dep=0;
      }

      $sql43="SELECT amount FROM acctgenledge WHERE caseno='$caseno' AND acctitle LIKE '%AR-%'";
      $sqlAr=mysqli_query($conn,$sql43);
      $arTrade=mysqli_fetch_array($sqlAr);

      $sql44="SELECT amount FROM acctgenledge WHERE caseno='$caseno' AND (acctitle LIKE '%Discounts%' or acctitle LIKE '%DISCOUNT%')";
      $sqlOther=mysqli_query($conn,$sql44);
      $otherdisc=mysqli_fetch_array($sqlOther);

      $debittotal=$debittotal+$amount1+$discsen+$discregular+$phic+$hmo+$dep+$arTrade['amount']+$otherdisc['amount'];
      $coh=$coh+$amount1;
      $dp=$dp+$hmo;
      $dswd=$dswd+$phic;
      $dep2=$dep2+$dep;
      $artrade1=$artrade1+$arTrade['amount'];
      $otherdisc1=$otherdisc1+$otherdisc['amount'];

      $sqlMeds=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype LIKE '%PHARMACY/MEDICINE%'");
      $meds=0;
      if(mysqli_num_rows($sqlMeds)>0){
        $meds=mysqli_fetch_array($sqlMeds)['amount'];
      }

      $sqlSups=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype LIKE '%PHARMACY/SUPPLIES%'");
      $sups=0;
      if(mysqli_num_rows($sqlSups)>0){
        $sups=mysqli_fetch_array($sqlSups)['amount'];
      }

      $sqlLab=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype LIKE '%LABORATORY%'");
      $lab=0;
      if(mysqli_num_rows($sqlLab)>0){
        $lab=mysqli_fetch_array($sqlLab)['amount'];
      }

      $sqlRad=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (productsubtype LIKE '%XRAY%' OR productsubtype LIKE '%ULTRASOUND%' OR productsubtype LIKE '%CT SCAN%' OR productsubtype LIKE '%ECG%' OR productsubtype LIKE '%2D ECHO%')");
      $rad=0;
      if(mysqli_num_rows($sqlRad)>0){
        $rad=mysqli_fetch_array($sqlRad)['amount'];
      }

      $sqlOther=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (productsubtype LIKE '%MEDICAL SURGICAL SUPPLIES%' OR productsubtype LIKE '%GENERAL SUPPLIES%' OR productsubtype LIKE '%MEDICAL EQUIPMENT%') AND quantity > 0");
      $othersups=0;
      if(mysqli_num_rows($sqlOther)>0){
        $othersups=mysqli_fetch_array($sqlOther)['amount'];
      }

      $sqlOxygen=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype LIKE '%OXYGEN%'");
      $oxygen=0;
      if(mysqli_num_rows($sqlOxygen)>0){
        $oxygen=mysqli_fetch_array($sqlOxygen)['amount'];
      }

      $sqlRoom=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype LIKE '%ROOM ACCOMODATION%'");
      $room=0;
      if(mysqli_num_rows($sqlRoom)>0){
        $room=mysqli_fetch_array($sqlRoom)['amount'];
      }

      $sqlNSFEE=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype LIKE '%NURSING SERVICE FEE%'");
      $nsfee=0;
      if(mysqli_num_rows($sqlNSFEE)>0){
        $nsfee=mysqli_fetch_array($sqlNSFEE)['amount'];
      }

      $sqlNSCharge=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (productsubtype LIKE '%NURSING CHARGES%' OR productsubtype LIKE '%PULMONARY%' OR productsubtype LIKE '%NURSE ON CALL%')");
      $nscharge=0;
      if(mysqli_num_rows($sqlNSCharge)>0){
        $nscharge=mysqli_fetch_array($sqlNSCharge)['amount'];
      }

      $sqlOtherFees=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (productsubtype LIKE '%OTHER FEES%' OR productsubtype LIKE '%OR/DR/ER FEE%' OR productsubtype LIKE '%OTHERS%' OR (producttype LIKE '%IPD admitting%'))");
      $otherfees=0;
      if(mysqli_num_rows($sqlOtherFees)>0){
        $otherfees=mysqli_fetch_array($sqlOtherFees)['amount'];
      }

      $sqlCertification=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype LIKE '%CERTIFICATION%'");
      $cert=0;
      if(mysqli_num_rows($sqlCertification)>0){
        $cert=mysqli_fetch_array($sqlCertification)['amount'];
      }

      $sqlMisc=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (productsubtype LIKE '%MISCELLANEOUS CR%' OR productsubtype LIKE '%AMBULANCE INCOME%')");
      $misc=0;
      if(mysqli_num_rows($sqlMisc)>0){
        $misc=mysqli_fetch_array($sqlMisc)['amount'];
      }

      $totaldebit=$meds+$sups+$lab+$rad+$othersups+$oxygen+$room+$nsfee+$nscharge+$otherfees+$cert+$misc;

      $sqlMeds=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype LIKE '%PHARMACY/MEDICINE%'");
      $meds=0;
      if(mysqli_num_rows($sqlMeds)>0){
        $meds=mysqli_fetch_array($sqlMeds)['amount'];
      }

      $sqlSups=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (productsubtype LIKE '%PHARMACY/SUPPLIES%' OR productsubtype LIKE '%PHARMACY SUPPLIES%')");
      $sups=0;
      if(mysqli_num_rows($sqlSups)>0){
        $sups=mysqli_fetch_array($sqlSups)['amount'];
      }

      $sqlLab=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype LIKE '%LABORATORY%'");
      $lab=0;
      if(mysqli_num_rows($sqlLab)>0){
        $lab=mysqli_fetch_array($sqlLab)['amount'];
      }

      $sqlRad=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (productsubtype LIKE '%XRAY%' OR productsubtype LIKE '%ULTRASOUND%' OR productsubtype LIKE '%CT SCAN%' OR productsubtype LIKE '%ECG%' OR productsubtype LIKE '%2D ECHO%')");
      $rad=0;
      if(mysqli_num_rows($sqlRad)>0){
        $rad=mysqli_fetch_array($sqlRad)['amount'];
      }

      $sqlOther=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (productsubtype LIKE '%MEDICAL SURGICAL SUPPLIES%' OR productsubtype LIKE '%GENERAL SUPPLIES%' OR productsubtype LIKE '%MEDICAL EQUIPMENT%') AND quantity > 0");
      $othersups=0;
      if(mysqli_num_rows($sqlOther)>0){
        $othersups=mysqli_fetch_array($sqlOther)['amount'];
      }

      $sqlOxygen=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype LIKE '%OXYGEN%'");
      $oxygen=0;
      if(mysqli_num_rows($sqlOxygen)>0){
        $oxygen=mysqli_fetch_array($sqlOxygen)['amount'];
      }

      $sqlRoom=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype LIKE '%ROOM ACCOMODATION%'");
      $room=0;
      if(mysqli_num_rows($sqlRoom)>0){
        $room=mysqli_fetch_array($sqlRoom)['amount'];
      }

      $sqlNSFEE=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype LIKE '%NURSING SERVICE FEE%'");
      $nsfee=0;
      if(mysqli_num_rows($sqlNSFEE)>0){
        $nsfee=mysqli_fetch_array($sqlNSFEE)['amount'];
      }

      $sqlNSCharge=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (productsubtype LIKE '%NURSING CHARGES%' OR productsubtype LIKE '%PULMONARY%' OR productsubtype LIKE '%NURSE ON CALL%')");
      $nscharge=0;
      if(mysqli_num_rows($sqlNSCharge)>0){
        $nscharge=mysqli_fetch_array($sqlNSCharge)['amount'];
      }

      $sqlOtherFees=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (productsubtype LIKE '%OTHER FEES%' OR productsubtype LIKE '%OR/DR/ER FEE%' OR productsubtype LIKE '%OTHERS%' OR (producttype LIKE '%IPD admitting%'))");
      $otherfees=0;
      if(mysqli_num_rows($sqlOtherFees)>0){
        $otherfees=mysqli_fetch_array($sqlOtherFees)['amount'];
      }

      $sqlCertification=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype LIKE '%CERTIFICATION%'");
      $cert=0;
      if(mysqli_num_rows($sqlCertification)>0){
        $cert=mysqli_fetch_array($sqlCertification)['amount'];
      }

      $sqlMisc=mysqli_query($conn,"SELECT SUM(gross+adjustment) as amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (productsubtype LIKE '%MISCELLANEOUS CR%' OR productsubtype LIKE '%AMBULANCE INCOME%')");
      $misc=0;
      if(mysqli_num_rows($sqlMisc)>0){
        $misc=mysqli_fetch_array($sqlMisc)['amount'];
      }

      $credittotal=$meds+$sups+$lab+$rad+$othersups+$oxygen+$room+$nsfee+$nscharge+$otherfees+$cert+$misc;

echo "
                                    <tr>
                                      <td><div align='left'>$name</div></td>
                                      <td><div align='right'>".number_format($amount1,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($dep,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($discsen,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($discregular,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($otherdisc['amount'],2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($hmo,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($phic,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($arTrade['amount'],2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($debittotal,2,".",",")."</div></td>
                                      <td><div align='right'></div></td>
                                      <td><div align='right'>".number_format($meds,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($sups,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($lab,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($rad,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($othersups,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($oxygen,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($room,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($nsfee,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($nscharge,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($otherfees,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($cert,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($misc,2,".",",")."</div></td>
                                      <td><div align='right'>".number_format($credittotal,2,".",",")."</div></td>
                                    </tr>
";

      $debitgrand=$debitgrand+$debittotal;
      $creditgrand=$creditgrand+$credittotal;

      $coh1=$coh1+$coh;
      $disc1=$disc1+$disc;
      $dp1=$dp1+$dp;
      $dswd1=$dswd1+$dswd;
      $mswd1=$mswd1+$mswd;
      $artrade1=$artrade1+$artrade;
      $discreg1=$discreg1+$discreg;
      $phic2=$phic2+$phil;
      $med1=$med1+$meds;
      $sup1=$sup1+$sups;
      $lab1=$lab1+$lab;
      $rad1=$rad1+$rad;
      $othersup1=$othersup1+$othersups;
      $oxygen1=$oxygen1+$oxygen;
      $room1=$room1+$room;
      $nsfee1=$nsfee1+$nsfee;
      $nscharge1=$nscharge1+$nscharge;
      $otherfee1=$otherfee1+$otherfees;
      $cert1=$cert1+$cert;
      $misc1=$misc1+$misc;
      $totalgain=$totalgain+$gain;
    }
  }

echo "
                                    <tr>
                                      <td><div align='left' style='font-weight: bold;'>TOTAL</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($coh,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($dep2,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($disc1,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($discreg1,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($otherdisc1,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($dp,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($dswd,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($artrade1,2,".",",")."</div></td>
                                      <td><div align='right style='font-weight: bold;''>".number_format($debitgrand,2,".",",")."</div></td>
                                      <td><div align='right'></div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($med1,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($sup1,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($lab1,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($rad1,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($othersup1,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($oxygen1,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($room1,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($nsfee1,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($nscharge1,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($otherfee1,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($cert1,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($misc1,2,".",",")."</div></td>
                                      <td><div align='right' style='font-weight: bold;'>".number_format($creditgrand,2,".",",")."</div></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                            <br />
                            <br />
                            <div align='center'>***NOTHING FOLLOWS***</div>
                            <br />
                            <br />
                            <br />
                            <table cellspacing='0' cellpadding='0' border='0' width='90%'>
                              <tr>
                                <td>Prepared by:</td>
                                <td>Checked by:</td>
                                <td>Noted by:</td>
                              </tr>
                              <tr>
                                <td colspan='3'>&nbsp;</td>
                              </tr>
                              <tr>
                                <td><u>".base64_decode($_SESSION['nm'])."</u></td>
                                <td>___________________________</td>
                                <td>___________________________</td>
                              </tr>
                              <tr>
                                <td>Cashier</td>
                                <td>Book Keeper</td>
                                <td>Hospital Administrator</td>
                              </tr>
                            </table>
                          </div></td>
                        </tr>
                    </div></td>
                  </tr>
";
}

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

<script type="text/javascript">
  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }
</script>
