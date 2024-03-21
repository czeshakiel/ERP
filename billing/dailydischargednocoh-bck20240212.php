<style>
.font10{
  font-size:12px;
  font-family:'Times New Roman';
}
.font11{
  font-size:11px;
  font-family:'Times New Roman';
}
.font12{
  font-size:12px;
  font-family:'Times New Roman';
}
.font13{
  font-size:13px;
  font-family:'Times New Roman';
}
</style>
<?php
session_start();
include("../main/connection.php");
$rundate=$_GET['startdate'];
$department=$_GET['department'];
$enddate=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));
$startdate=date('Y-m-d',strtotime('-1 day',strtotime($enddate)));
$checkdate=date('Y-m',strtotime($rundate))."-01";
$datefrom=date('Y-m-d',strtotime('-2 days',strtotime($checkdate)))." 23:00:00";
$datestart=date('Y-m-d',strtotime($startdate))." 23:00:00";
$sqlHeading=mysqli_query($conn,"SELECT * FROM heading");
$head=mysqli_fetch_array($sqlHeading);
$heading=$head['heading'];
$address=$head['address'];
$email=$head['FullAddress'];
$telno=$head['telno'];
$img=$head['custodian'];
$date=date('M-d-Y',strtotime($startdate));
$cohbeg=0;$depbeg=0;$discbeg=0;$arphicbeg=0;$arpfphicbeg=0;$albeg=0;$avegabeg=0;$chealthbeg=0;$caritasbeg=0;$cocobeg=0;$flexibeg=0;$intelbeg=0;$maxibeg=0;$mclbeg=0;$mcardbeg=0;$pcarebeg=0;$vcarebeg=0;$insulifebeg=0;
$dswdbeg=0;$lgumakbeg=0;$lgukidbeg=0;$pcsobeg=0;$pepsibeg=0;$provincebeg=0;$tradebeg=0;$tradepfbeg=0;$pcrossbeg=0;$maipbeg=0;$insubeg=0;$fortunebeg=0;$stanfilcobeg=0;$doctorbeg=0;$sumifrubeg=0;$easwestbeg=0;$santosbeg=0;$caoagdanbeg=0;$pinolbeg=0;
$genearlibeg=0;$medcardbeg=0;$prudentbeg=0;$clinicbeg=0;$mplusbeg=0;$personalbeg=0;$employeebeg=0;$officebeg=0;$phcbeg=0;$catamcobeg=0;$tejadabeg=0;$mcpbeg=0;$makmpcbeg=0;$mediatrixbeg=0;$employeebeg=0;$pgicarebeg=0;$cotelcobeg=0;$balfourbeg=0;
$coh1beg=0;$dep1beg=0;$disc1beg=0;$arphic1beg=0;$arpfphic1beg=0;$al1beg=0;$avega1beg=0;$chealth1beg=0;$caritas1beg=0;$coco1beg=0;$flexi1beg=0;$intel1beg=0;$maxi1beg=0;$mcl1beg=0;$mcard1beg=0;$pcare1beg=0;$employee1beg=0;$pgicare1beg=0;$caoagdan1beg=0;$pinol1beg=0;
$vcare1beg=0;$dswd1beg=0;$lgumak1beg=0;$lgukid1beg=0;$pcso1beg=0;$pepsi1beg=0;$province1beg=0;$trade1beg=0;$tradepf1beg=0;$pcross1beg=0;$maip1beg=0;$insu1beg=0;$forutne1beg=0;$stanfilco1beg=0;$doctor1beg=0;$insulife1beg=0;$santos1beg=0;$balfour1beg=0;
$sumifru1beg=0;$eastwest1beg=0;$generali1beg=0;$medcard1beg=0;$prudent1beg=0;$clinic1beg=0;$mplus1beg=0;$personal1beg=0;$employee1beg=0;$office1beg=0;$phc1beg=0;$catamco1beg=0;$tejada1beg=0;$mcp1beg=0;$makmpc1beg=0;$mediatrix1beg=0;$cotelco1beg=0;$sssbeg=0;$sss1beg=0;
$totalamountbeg=0;
$credittotalbeg=0;
// $sqlPatient=mysqli_query($conn,"SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE ((c.datearray = '$datefrom' AND c.paymentTime >= '23:00:00') OR (c.datearray = '$startdate' AND c.paymentTime < '23:00:00')) AND a.status='discharged' AND a.caseno LIKE '%$department%' AND (((c.accttitle = 'AR TRADE' OR c.accttitle LIKE '%AR TRADE%' OR c.accttitle = 'NO EXCESS' OR c.accttitle LIKE '%AR EMPLOYEE%' OR c.accttitle LIKE '%AR DOCTOR%') AND c.type='pending') OR (c.accttitle='PROFESSIONAL FEE' AND c.type='cash-Visa')) GROUP BY a.caseno ORDER BY pp.lastname ASC");
if($department=="O-"){
  $sqlPatient=mysqli_query($conn,"SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE c.datearray >= '$checkdate' AND c.datearray < '$rundate' AND a.status='discharged' AND (a.caseno LIKE '%$department%' OR a.caseno LIKE '%AR-%') AND (((c.accttitle = 'AR TRADE' OR c.accttitle LIKE '%AR TRADE%' OR c.accttitle = 'NO EXCESS' OR c.accttitle LIKE '%AR EMPLOYEE%' OR c.accttitle LIKE '%AR DOCTOR%') AND c.type='pending') OR (c.accttitle='PROFESSIONAL FEE' AND c.type='cash-Visa')) GROUP BY a.caseno ORDER BY pp.lastname ASC");
}else{
  $sqlPatient=mysqli_query($conn,"SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE CONCAT(c.datearray,' ',c.paymentTime) >= '$datefrom' AND CONCAT(c.datearray,' ',c.paymentTime) < '$datestart' AND a.status='discharged' AND a.caseno LIKE '%$department%' AND (((c.accttitle = 'AR TRADE' OR c.accttitle LIKE '%AR TRADE%' OR c.accttitle = 'NO EXCESS' OR c.accttitle LIKE '%AR EMPLOYEE%' OR c.accttitle LIKE '%AR DOCTOR%') AND c.type='pending') OR (c.accttitle='PROFESSIONAL FEE' AND c.type='cash-Visa')) GROUP BY a.caseno ORDER BY pp.lastname ASC");
}
    if(mysqli_num_rows($sqlPatient)>0){
      while($patient=mysqli_fetch_array($sqlPatient)){
        $caseno =$patient['caseno'];        
        // $p=explode(' ',$patient['patientname']);
        // $patientname =$p[0].", ".$p[1];        
        $patientname=$patient['patientname'];

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE ((accttitle='CASHONHAND' AND `type` LIKE '%Visa%') OR (accttitle ='PROFESSIONAL FEE' AND `type`='card-Visa')) AND acctno='$caseno'");
        $amount=mysqli_fetch_array($sql);
        $cohbeg=$amount['amount'];        
        if($cohbeg>0){
          $coh1beg +=0;
        }

if($cohbeg==0){
        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle='PATIENTS DEPOSIT' AND acctno='$caseno' AND `type` <> 'pending'");
        $amount=mysqli_fetch_array($sql);
        $depbeg=$amount['amount'];        
        $dep1beg +=$depbeg;

        $sql=mysqli_query($conn,"SELECT SUM(adjustment) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype NOT LIKE '%PROFESSIONAL FEE%' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $discbeg=$amount['amount'];
        $disc1beg +=$discbeg;

        $sql=mysqli_query($conn,"SELECT SUM(phic+phic1) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $arphicbeg=$amount['amount'];
        $arphic1beg +=$arphicbeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='ASIAN LIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $albeg=$amount['amount'];
        $al1beg +=$albeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='AVEGA' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $avegabeg=$amount['amount'];
        $avega1beg +=$avegabeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo LIKE '%SSS(SOCIAL SECURITY SYSTEM)%' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $sssbeg=$amount['amount'];
        $sss1beg +=$sssbeg;


        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='CAREHEALTH' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $chealthbeg=$amount['amount'];
        $chealth1beg +=$chealthbeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='CARITAS' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $caritasbeg=$amount['amount'];
        $caritas1beg +=$caritasbeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='COCOLIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $cocobeg=$amount['amount'];
        $coco1beg +=$cocobeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='FLEXICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $flexibeg=$amount['amount'];
        $flexi1beg +=$flexibeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INTELLICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $intelbeg=$amount['amount'];
        $intel1beg +=$intelbeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MAXICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $maxibeg=$amount['amount'];
        $maxi1beg +=$maxibeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MCL' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $mclbeg=$amount['amount'];
        $mcl1beg +=$mclbeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MEDICARD' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $mcardbeg=$amount['amount'];
        $mcard1beg +=$mcardbeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PHILCARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $pcarebeg=$amount['amount'];
        $pcare1beg +=$pcarebeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='VALUE CARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $vcarebeg=$amount['amount'];
        $vcare1beg +=$vcarebeg;
        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PACIFIC CROSS' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $pcrossbeg=$amount['amount'];
        $pcross1beg +=$pcrossbeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INSULAR HEALTHCARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $insubeg=$amount['amount'];
        $insu1beg +=$insubeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INSULAR LIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $insulifebeg=$amount['amount'];
        $insulife1beg +=$insulifebeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='GENERALI' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $generalibeg=$amount['amount'];
        $generali1beg +=$generalibeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PGI CARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $pgicarebeg=$amount['amount'];
        $pgicare1beg +=$pgicarebeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='EAST WEST' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $eastwestbeg=$amount['amount'];
        $eastwest1beg +=$eastwestbeg;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR DSWD' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $dswdbeg=$amount['amount'];
        $dswd1beg +=$dswdbeg;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE (accttitle='AR LGU KIDAPAWAN' OR accttitle='A/R LGU KIDAPAWAN' OR accttitle='AR LGU-KIDAPAWAN') AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $lgukidbeg=$amount['amount'];
        $lgukid1beg +=$lgukidbeg;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE (accttitle='A/R LGU MAKILALA' OR accttitle='AR LGU MAKILALA' OR accttitle='AR LGU-MAKILALA') AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $lgumakbeg=$amount['amount'];
        $lgumak1beg +=$lgumakbeg;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PCSO' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $pcsobeg=$amount['amount'];
        $pcso1beg +=$pcsobeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='PCSO' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $pcsobeg=$amount['amount'];
        $pcso1beg +=$pcsobeg; 

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR COTELCO' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $cotelcobeg=$amount['amount'];
        $cotelco1beg +=$cotelcobeg;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='COTELCO' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $cotelcobeg=$amount['amount'];
        $cotelco1beg +=$cotelcobeg;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PEPSI COLA' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $pepsibeg=$amount['amount'];
        $pepsi1beg +=$pepsibeg;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PROVINCE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $provincebeg=$amount['amount'];
        $province1beg +=$provincebeg;

	$sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='FIRST BALFOUR' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
	$amount=mysqli_fetch_array($sql);
        $balfourbeg=$amount['amount'];
        $balfour1beg +=$balfourbeg;


        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $maipbeg=$amount['amount'];
        $maip1beg +=$maipbeg;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%TEJADA MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $tejadabeg=$amount['amount'];
        $tejada1beg +=$tejadabeg;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%SANTOS MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $santosbeg=$amount['amount'];
        $santos1beg +=$santosbeg;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%CAOAGDAN MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $caoagdanbeg=$amount['amount'];
        $caoagdan1beg +=$caoagdanbeg;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%PIÑOL MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $pinolbeg=$amount['amount'];
        $pinol1beg +=$pinolbeg;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR TRADE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $tradebeg=$amount['amount'];
        $trade1beg +=$tradebeg;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle='AR TRADE PF' OR accttitle='AR EMPLOYEE PF' OR accttitle='AR DOCTOR PF' OR accttitle='AR PERSONAL PF') AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $tradepfbeg=$amount['amount'];
        $tradepf1beg +=$tradepfbeg;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR EMPLOYEE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $employeebeg=$amount['amount'];
        $employee1beg +=$employeebeg;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR DOCTOR' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $doctorbeg=$amount['amount'];
        $doctor1beg +=$doctorbeg;

      }

  }
  if($rundate==$checkdate){
    $coh1beg=0;$dep1beg=0;$disc1beg=0;$arphic1beg=0;$arpfphic1beg=0;$al1beg=0;$avega1beg=0;$chealth1beg=0;$caritas1beg=0;$coco1beg=0;$flexi1beg=0;$intel1beg=0;$maxi1beg=0;$mcl1beg=0;$mcard1beg=0;$pcare1beg=0;$insulife1beg=0;$sss1beg=0;
$vcare1beg=0;$dswd1beg=0;$lgumak1beg=0;$lgukid1beg=0;$pcso1beg=0;$pepsi1beg=0;$province1beg=0;$trade1beg=0;$tradepf1beg=0;$pcross1beg=0;$maip1beg=0;$insu1beg=0;$fortune1beg=0;$stanfilco1beg=0;$doctor1beg=0;$sumifru1beg=0;$eastwest1beg=0;$generali1beg=0;$medcard1beg=0;$prudent1beg=0;$clinic1beg=0;$mplus1beg=0;$personal1beg=0;$employee1beg=0;$office1beg=0;$phc1beg=0;$catamco1beg=0;$tejada1beg=0;$mcp1beg=0;$makmpc1beg=0;$mediatrix1beg=0;$pgicare1beg=0;$cotelco1beg=0;$santos1beg=0;$caoagdan1beg=0;$pinol1beg=0;$balfour1beg=0;
  }
  $credittotalbeg=$coh1beg+$dep1beg+$disc1beg+$arphic1beg+$arpfphic1beg+$al1beg+$avega1beg+$chealth1beg+$caritas1beg+$coco1beg+$flexi1beg+$intel1beg+$maxi1beg+$mcl1beg+$mcard1beg+$pcare1beg+$vcare1beg+$pcross1beg+$dswd1beg+$lgumak1beg+$lgukid1beg+$pcso1beg+$pepsi1beg+$province1beg+$trade1beg+$tradepf1beg+$maip1beg+$insu1beg+$fortune1beg+$stanfilco1beg+$doctor1beg+$sumifru1beg+$eastwest1beg+$generali1beg+$medcard1beg+$prudent1beg+$clinic1beg+$mplus1beg+$personal1beg+$employee1beg+$office1beg+$phc1beg+$catamco1beg+$tejada1beg+$mcp1beg+$makmpc1beg+$mediatrix1beg+$pgicare1beg+$insulife1beg+$cotelco1beg+$santos1beg+$caoagdan1beg+$pinol1beg+$balfour1beg+$sss1beg;
}

$coh=0;$dep=0;$disc=0;$arphic=0;$arpfphic=0;$al=0;$avega=0;$chealth=0;$caritas=0;$coco=0;$flexi=0;$intel=0;$maxi=0;$mcl=0;$mcard=0;$pcare=0;$vcare=0;$office=0;$phc=0;$catamco=0;$tejada=0;$mcp=0;$makmpc=0;$cotelco=0;$santos=0;$caoagdan=0;$pinol=0;$sss=0;
$mediatrix=0;$pgicare=0;$insulife=0;$balfour=0;
$dswd=0;$lgumak=0;$lgukid=0;$pcso=0;$pepsi=0;$province=0;$trade=0;$tradepf=0;$pcross=0;$maip=0;$insu=0;$fortune=0;$stanfilco=0;$doctor=0;$sumifru=0;$eastwest=0;$generali=0;$prudent=0;$clinic=0;$personal=0;
$employee=0;$balfour1=0;
$coh1=0;$dep1=0;$disc1=0;$arphic1=0;$arpfphic1=0;$al1=0;$avega1=0;$chealth1=0;$caritas1=0;$coco1=0;$flexi1=0;$intel1=0;$maxi1=0;$mcl1=0;$mcard1=0;$pcare1=0;$vcare1=0;
$dswd1=0;$lgumak1=0;$lgukid1=0;$pcso1=0;$pepsi1=0;$province1=0;$trade1=0;$tradepf1=0;$pcross1=0;$maip1=0;$insu1=0;$fortune1=0;$stanfilco1=0;$doctor1=0;$sumifru1=0;$eastwest1=0;$generali1=0;$prudent1=0;$pgicare1=0;$insulife1=0;$cotelco1=0;$santos1=0;$caoagdan1=0;$pinol1=0;$sss1=0;
$clinic1=0;$personal1=0;$employee1=0;$office1=0;$phc1=0;$catamco1=0;$tejada1=0;$mcp1=0;$makmpc1=0;$mediatrix1=0;
$totalamount=0;
$credittotal=0;
  if($department=="O-"){
    $sqlPatient=mysqli_query($conn,"SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE c.datearray = '$rundate' AND a.status='discharged' AND (a.caseno LIKE '%$department%' OR a.caseno LIKE '%AR-%') AND (((c.accttitle = 'AR TRADE' OR c.accttitle LIKE '%AR TRADE%' OR c.accttitle = 'NO EXCESS' OR c.accttitle LIKE '%AR EMPLOYEE%' OR c.accttitle LIKE '%AR DOCTOR%') AND c.type='pending') OR (c.accttitle='PROFESSIONAL FEE' AND c.type='cash-Visa')) GROUP BY a.caseno ORDER BY pp.lastname ASC");
  }else{
    $sqlPatient=mysqli_query($conn,"SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE ((c.datearray = '$startdate' AND c.paymentTime >= '23:00:00') OR (c.datearray = '$enddate' AND c.paymentTime < '23:00:00')) AND a.status='discharged' AND a.caseno LIKE '%$department%' AND (((c.accttitle = 'AR TRADE' OR c.accttitle LIKE '%AR TRADE%' OR c.accttitle = 'NO EXCESS' OR c.accttitle LIKE '%AR EMPLOYEE%' OR c.accttitle LIKE '%AR DOCTOR%') AND c.type='pending') OR (c.accttitle='PROFESSIONAL FEE' AND c.type='cash-Visa')) GROUP BY a.caseno ORDER BY pp.lastname ASC");
  }
    if(mysqli_num_rows($sqlPatient)>0){
      while($patient=mysqli_fetch_array($sqlPatient)){
        $caseno =$patient['caseno'];
        // $p=explode(' ',$patient['patientname']);
        // $patientname =$p[0].", ".$p[1];        
        $patientname=$patient['patientname'];

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE ((accttitle='CASHONHAND' AND `type` LIKE '%Visa%') OR (accttitle ='PROFESSIONAL FEE' AND `type`='card-Visa')) AND acctno='$caseno'");
        $amount=mysqli_fetch_array($sql);
        $coh=$amount['amount'];
        //$paymentTime=$amount['paymentTime'];
        //$paymentDate=$amount['datearray'];
        if($coh>0){
        $coh1 +=0;
        }        

if($coh==0){
        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle='PATIENTS DEPOSIT' AND acctno='$caseno' AND `type` <> 'pending'");
        $amount=mysqli_fetch_array($sql);
        $dep=$amount['amount'];        
        $dep1 +=$dep;

        $sql=mysqli_query($conn,"SELECT SUM(adjustment) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype NOT LIKE '%PROFESSIONAL FEE%' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $disc=$amount['amount'];
        $disc1 +=$disc;

        $sql=mysqli_query($conn,"SELECT SUM(phic+phic1) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $arphic=$amount['amount'];
        $arphic1 +=$arphic;

        // $sql=mysqli_query($conn,"SELECT SUM(phic+phic1) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='PROFESSIONAL FEE' AND trantype='charge' AND quantity > 0 AND producttype NOT LIKE '%IPD admitting%'");
        // $amount=mysqli_fetch_array($sql);
        // $arpfphic=$amount['amount'];
        // $arpfphic1 +=$arpfphic;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='ASIAN LIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $al=$amount['amount'];
        $al1 +=$al;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='AVEGA' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $avega=$amount['amount'];
        $avega1 +=$avega;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo LIKE '%SSS(SOCIAL SECURITY SYSTEM)%' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $sss=$amount['amount'];
        $sss1 +=$sss;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='CAREHEALTH' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $chealth=$amount['amount'];
        $chealth1 +=$chealth;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='CARITAS' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $caritas=$amount['amount'];
        $caritas1 +=$caritas;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='COCOLIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $coco=$amount['amount'];
        $coco1 +=$coco;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='FLEXICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $flexi=$amount['amount'];
        $flexi1 +=$flexi;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INTELLICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $intel=$amount['amount'];
        $intel1 +=$intel;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MAXICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $maxi=$amount['amount'];
        $maxi1 +=$maxi;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MCL' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $mcl=$amount['amount'];
        $mcl1 +=$mcl;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MEDICARD' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $mcard=$amount['amount'];
        $mcard1 +=$mcard;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PHILCARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $pcare=$amount['amount'];
        $pcare1 +=$pcare;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='VALUE CARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $vcare=$amount['amount'];
        $vcare1 +=$vcare;
        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PACIFIC CROSS' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $pcross=$amount['amount'];
        $pcross1 +=$pcross;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INSULAR HEALTHCARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $insu=$amount['amount'];
        $insu1 +=$insu;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INSULAR LIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $insulife=$amount['amount'];
        $insulife1 +=$insulife;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='GENERALI' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $generali=$amount['amount'];
        $generali1 +=$generali;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PGI CARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $pgicare=$amount['amount'];
        $pgicare1 +=$pgicare;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='EAST WEST' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $eastwest=$amount['amount'];
        $eastwest1 +=$eastwest;

	$sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='FIRST BALFOUR' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
	$amount=mysqli_fetch_array($sql);
        $balfour=$amount['amount'];
        $balfour1 +=$balfour;


        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR DSWD' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $dswd=$amount['amount'];
        $dswd1 +=$dswd;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE (accttitle='AR LGU KIDAPAWAN' OR accttitle='A/R LGU KIDAPAWAN' OR accttitle='AR LGU-KIDAPAWAN') AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $lgukid=$amount['amount'];
        $lgukid1 +=$lgukid;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE (accttitle='A/R LGU MAKILALA' OR accttitle='AR LGU MAKILALA' OR accttitle='AR LGU-MAKILALA') AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $lgumak=$amount['amount'];
        $lgumak1 +=$lgumak;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PCSO' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $pcso=$amount['amount'];
        $pcso1 +=$pcso;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='PCSO' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $pcso=$amount['amount'];
        $pcso1 +=$pcso; 

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR COTELCO' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $cotelco=$amount['amount'];
        $cotelco1 +=$cotelco;

        $sql=mysqli_query($conn,"SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='COTELCO' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=mysqli_fetch_array($sql);
        $cotelco=$amount['amount'];
        $cotelco1 +=$cotelco; 

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PEPSI COLA' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $pepsi=$amount['amount'];
        $pepsi1 +=$pepsi;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PROVINCE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $province=$amount['amount'];
        $province1 +=$province;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $maip=$amount['amount'];
        $maip1 +=$maip;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%TEJADA MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $tejada=$amount['amount'];
        $tejada1 +=$tejada;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%SANTOS MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $santos=$amount['amount'];
        $santos1 +=$santos;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%CAOAGDAN MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $caoagdan=$amount['amount'];
        $caoagdan1 +=$caoagdan;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%PIÑOL MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $pinol=$amount['amount'];
        $pinol1 +=$pinol;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR TRADE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $trade=$amount['amount'];
        $trade1 +=$trade;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle='AR TRADE PF' OR accttitle='AR EMPLOYEE PF' OR accttitle='AR DOCTOR PF' OR accttitle='AR PERSONAL PF') AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $tradepf=$amount['amount'];
        $tradepf1 +=$tradepf;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR EMPLOYEE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $employee=$amount['amount'];
        $employee1 +=$employee;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR DOCTOR' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=mysqli_fetch_array($sql);
        $doctor=$amount['amount'];
        $doctor1 +=$doctor;
      }

  }
  $credittotal=$coh1+$dep1+$disc1+$arphic1+$arpfphic1+$al1+$avega1+$chealth1+$caritas1+$coco1+$flexi1+$intel1+$maxi1+$mcl1+$mcard1+$pcare1+$vcare1+$pcross1+$dswd1+$lgumak1+$lgukid1+$pcso1+$pepsi1+$province1+$trade1+$tradepf1+$maip1+$insu1+$fortune1+$stanfilco1+$doctor1+$sumifru1+$eastwest1+$generali1+$medcard1+$prudent1+$clinic1+$mplus1+$personal1+$employee1+$office1+$phc1+$catamco1+$tejada1+$mcp1+$makmpc1+$mediatrix1+$pgicare1+$insulife1+$cotelco1+$santos1+$caoagdan1+$pinol1+$balfour1+$sss1;
}

$medsbeg=0;$labbeg=0;$xraybeg=0;$utzbeg=0;$ecgbeg=0;$eegbeg=0;$ctbeg=0;$echobeg=0;$respibeg=0;$roombeg=0;$supbeg=0;$rtbeg=0;$erfeebeg=0;$admitbeg=0;$nsfeebeg=0;$ordrbeg=0;$oxygenbeg=0;$certbeg=0;$dietbeg=0;$ordrsuppliesbeg=0;
$ptbeg=0;$ambubeg=0;$appfotherbeg=0;$appftradebeg=0;$appfphicbeg=0;$appfdepbeg=0;
$meds1beg=0;$lab1beg=0;$xray1beg=0;$utz1beg=0;$ecg1beg=0;$eeg1beg=0;$ct1beg=0;$echo1beg=0;$respi1beg=0;$room1beg=0;$sup1beg=0;$rt1beg=0;$erfee1beg=0;$admit1beg=0;$nsfee1beg=0;$ordr1beg=0;$oxygen1beg=0;$ordrsupplies1beg=0;
$cert1beg=0;$diet1beg=0;$pt1beg=0;$ambu1beg=0;$appfother1beg=0;$appftrade1beg=0;$appfphic1beg=0;$appfdep1beg=0;
$totalamount=0;
$totalcreditbeg=0;
if($department=="O-"){
  $sqlPatient=mysqli_query($conn,"SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE c.datearray >= '$checkdate' AND c.datearray < '$rundate' AND a.status='discharged' AND (a.caseno LIKE '%$department%' OR a.caseno LIKE '%AR-%') AND (((c.accttitle = 'AR TRADE' OR c.accttitle LIKE '%AR TRADE%' OR c.accttitle = 'NO EXCESS' OR c.accttitle LIKE '%AR EMPLOYEE%' OR c.accttitle LIKE '%AR DOCTOR%') AND c.type='pending') OR (c.accttitle='PROFESSIONAL FEE' AND c.type='cash-Visa')) GROUP BY a.caseno ORDER BY pp.lastname ASC");
}else{
$sqlPatient=mysqli_query($conn,"SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE CONCAT(c.datearray,' ',c.paymentTime) >= '$datefrom' AND CONCAT(c.datearray,' ',c.paymentTime) < '$datestart' AND a.status='discharged' AND a.caseno LIKE '%$department%' AND (((c.accttitle = 'AR TRADE' OR c.accttitle LIKE '%AR TRADE%' OR c.accttitle = 'NO EXCESS' OR c.accttitle LIKE '%AR EMPLOYEE%' OR c.accttitle LIKE '%AR DOCTOR%') AND c.type='pending') OR (c.accttitle='PROFESSIONAL FEE' AND c.type='cash-Visa')) GROUP BY a.caseno ORDER BY pp.lastname ASC");
}
    if(mysqli_num_rows($sqlPatient)>0){
      while($patient=mysqli_fetch_array($sqlPatient)){
        $caseno =$patient['caseno'];
        // $p=explode(' ',$patient['patientname']);
        // $patientname =$p[0].", ".$p[1];        
        $patientname=$patient['patientname'];
        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE ((accttitle='CASHONHAND' AND `type` LIKE '%Visa%') OR (accttitle ='PROFESSIONAL FEE' AND `type`='card-Visa')) AND acctno='$caseno'");
        $amount=mysqli_fetch_array($sql);
        $cohbeg=$amount['amount'];
        if($cohbeg>0){
        $coh1beg +=0;
        }
        if($cohbeg==0){
        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='PHARMACY/MEDICINE' AND trantype='charge' AND quantity > 0 AND administration='administered'");
        $amount=mysqli_fetch_array($sql);
        $medsbeg=$amount['amount'];
        $meds1beg +=$medsbeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='LABORATORY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=mysqli_fetch_array($sql);
        $labbeg=$amount['amount'];
        $lab1beg +=$labbeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='XRAY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=mysqli_fetch_array($sql);
        $xraybeg=$amount['amount'];
        $xray1beg +=$xraybeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ULTRASOUND' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=mysqli_fetch_array($sql);
        $utzbeg=$amount['amount'];
        $utz1beg +=$utzbeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ECG' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=mysqli_fetch_array($sql);
        $ecgbeg=$amount['amount'];
        $ecg1beg +=$ecgbeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='EEG' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=mysqli_fetch_array($sql);
        $eegbeg=$amount['amount'];
        $eeg1beg +=$eegbeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='CT SCAN' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=mysqli_fetch_array($sql);
        $ctbeg=$amount['amount'];
        $ct1beg +=$ctbeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='HEARTSTATION' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=mysqli_fetch_array($sql);
        $echobeg=$amount['amount'];
        $echo1beg +=$echobeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='RESPIRATORY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=mysqli_fetch_array($sql);
        $respibeg=$amount['amount'];
        $respi1beg +=$respibeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ROOM ACCOMODATION' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $roombeg=$amount['amount'];
        $room1beg +=$roombeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productsubtype='PHARMACY/SUPPLIES' OR productsubtype='MEDICAL SURGICAL SUPPLIES' OR productsubtype='RESPIRATORY SUPPLIES' OR productsubtype='GENERAL SUPPLIES' OR (productsubtype LIKE '%MISCELLANEOUS%' AND (productdesc NOT LIKE '%MINOR ROOM FEE%' AND productdesc NOT LIKE '%RT FEE%')) OR productsubtype LIKE '%MEDICAL EQUIPMENT%' OR productsubtype='LINENS' OR productsubtype='MEDICAL SUPPLIES' OR (productsubtype='NURSING CHARGES' AND productdesc NOT LIKE '%OSTHEORIZED FEEDING%') OR productsubtype='NURSING-CHARGES' OR productsubtype='OR-CHARGES' OR (productsubtype='NURSING SERVICE FEE' AND productdesc='OR PACK') OR productsubtype='OR/DR SUPPLIES' or productsubtype='RT ON CALL' OR productsubtype='RT REFERRAL' OR (productsubtype='OR/DR/ER FEE' AND productdesc LIKE '%ARMY NAVY%')) AND productdesc NOT LIKE '%DEATH CERTIFICATE%' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $supbeg=$amount['amount'];
        $sup1beg +=$supbeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productdesc LIKE '%RT FEE%' ) AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $rtbeg=$amount['amount'];
        $rt1beg +=$rtbeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ER FEE' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $erfeebeg=$amount['amount'];
        $erfee1beg +=$erfeebeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ADMISSION FEE' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $admitbeg=$amount['amount'];
        $admit1beg +=$admitbeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%NURSING SERVICE FEE%' AND productdesc NOT LIKE '%OR PACK%' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $nsfeebeg=$amount['amount'];
        $nsfee1beg +=$nsfeebeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productsubtype='OR/DR/ER FEE' OR (productsubtype LIKE '%MISCELLANEOUS%' AND productdesc LIKE '%MINOR ROOM FEE%')) AND productdesc NOT LIKE '%OR SERVICE FEE%' AND productdesc NOT LIKE '%DR SERVICE FEE%' AND productdesc NOT LIKE '%ARMY NAVY%' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $ordrbeg=$amount['amount'];
        $ordr1beg +=$ordrbeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productsubtype='OR/DR/ER FEE' OR productsubtype='OR-CHARGES') AND (productdesc LIKE '%OR SERVICE FEE%' OR productdesc LIKE '%DR SERVICE FEE%') AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $ordrsuppliesbeg=$amount['amount'];
        $ordrsupplies1beg += $ordrsuppliesbeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='OXYGEN SUPPLIES' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $oxygenbeg=$amount['amount'];
        $oxygen1beg +=$oxygenbeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='MISCELLANEOUS' AND (productdesc='DEATH CERTIFICATE' OR productdesc='LAB 2ND COPY') AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $certbeg=$amount['amount'];
        $cert1beg +=$certbeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productsubtype='DIETARY' OR productsubtype='DIETARY COUNSELING INCOME' OR productsubtype='OTHER FEES' OR productdesc LIKE '%OSTHEORIZED FEEDING%') AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $dietbeg=$amount['amount'];
        $diet1beg +=$dietbeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='PHYSICAL THERAPY' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $ptbeg=$amount['amount'];
        $pt1beg +=$ptbeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='AMBULANCE INCOME' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $ambubeg=$amount['amount'];
        $ambu1beg +=$ambubeg;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle LIKE '%APPF OTHERS%' OR (accttitle='PROFESSIONAL FEE' AND `type`='card-Visa'))");
        $amount=mysqli_fetch_array($sql);
        $appfotherbeg=$amount['amount'];
        $appfother1beg +=$appfotherbeg;        

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle='AR TRADE PF' OR accttitle='AR EMPLOYEE PF' OR accttitle='AR DOCTOR PF' OR accttitle='AR PERSONAL PF')");
        $amount=mysqli_fetch_array($sql);
        $appftradebeg=$amount['amount'];
        $appftrade1beg +=$appftradebeg;

         $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='OTHER INCOME' AND trantype='charge' AND quantity > 0");
         $amount=mysqli_fetch_array($sql);
         $appfphicbeg=$amount['amount'];
         $appfphic1beg +=$appfphicbeg;

        $sql=mysqli_query($conn,"SELECT SUM(excess) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $excessbeg=$amount['amount'];

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND accttitle LIKE '%AP PATIENT DEPOSIT%'");
        $amount=mysqli_fetch_array($sql);
        $depositbeg=$amount['amount'];

        $dep=$excessbeg-$depositbeg;

        if($dep<0){
          $appfdepbeg=abs($dep);
        }else{
          $appfdepbeg=0;
        }
        $appfdep1beg +=$depositbeg;
      }

  }
  if($rundate==$checkdate){
    $meds1beg=0;$lab1beg=0;$xray1beg=0;$utz1beg=0;$ecg1beg=0;$eeg1beg=0;$ct1beg=0;$echo1beg=0;$respi1beg=0;$room1beg=0;$sup1beg=0;$rt1beg=0;$erfee1beg=0;$admit1beg=0;$nsfee1beg=0;$ordr1beg=0;$oxygen1beg=0;
    $cert1beg=0;$diet1beg=0;$pt1beg=0;$ambu1beg=0;$appfother1beg=0;$appftrade1beg=0;$appfphic1beg=0;$appfdep1beg=0;
  }

  $totalcreditbeg=$meds1beg+$lab1beg+$xray1beg+$utz1beg+$ecg1beg+$eeg1beg+$ct1beg+$echo1beg+$respi1beg+$room1beg+$sup1beg+$rt1beg+$erfee1beg+$admit1beg+$nsfee1beg+$ordr1beg+$oxygen1beg+$cert1beg+$diet1beg+$pt1beg+$ambu1beg+$appfother1beg+$appftrade1beg+$appfphic1beg+$appfdep1beg+$ordrsupplies1beg;
}

$meds=0;$lab=0;$xray=0;$utz=0;$ecg=0;$eeg=0;$ct=0;$echo=0;$respi=0;$room=0;$sup=0;$rt=0;$erfee=0;$admit=0;$nsfee=0;$ordr=0;$oxygen=0;$cert=0;$diet=0;
$pt=0;$ambu=0;$appfother=0;$appftrade=0;$appfphic=0;$appfdep=0;$ordrsupplies=0;
$meds1=0;$lab1=0;$xray1=0;$utz1=0;$ecg1=0;$eeg1=0;$ct1=0;$echo1=0;$respi1=0;$room1=0;$sup1=0;$rt1=0;$erfee1=0;$admit1=0;$nsfee1=0;$ordr1=0;$oxygen1=0;$cert1=0;$diet1=0;$ordrsupplies1=0;
$pt1=0;$ambu1=0;$appfother1=0;$appftrade1=0;$appfphic1=0;$appfdep1=0;
$totalamount=0;
$totalcredit=0;
if($department=="O-"){
    $sqlPatient=mysqli_query($conn,"SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE c.datearray = '$rundate' AND a.status='discharged' AND (a.caseno LIKE '%$department%' OR a.caseno LIKE '%AR-%') AND (((c.accttitle = 'AR TRADE' OR c.accttitle LIKE '%AR TRADE%' OR c.accttitle = 'NO EXCESS' OR c.accttitle LIKE '%AR EMPLOYEE%' OR c.accttitle LIKE '%AR DOCTOR%') AND c.type='pending') OR (c.accttitle='PROFESSIONAL FEE' AND c.type='cash-Visa')) GROUP BY a.caseno ORDER BY pp.lastname ASC");
  }else{
$sqlPatient=mysqli_query($conn,"SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE ((c.datearray = '$startdate' AND c.paymentTime >= '23:00:00') OR (c.datearray = '$enddate' AND c.paymentTime < '23:00:00')) AND a.status='discharged' AND a.caseno LIKE '%$department%' AND (((c.accttitle = 'AR TRADE' OR c.accttitle LIKE '%AR TRADE%' OR c.accttitle = 'NO EXCESS' OR c.accttitle LIKE '%AR EMPLOYEE%' OR c.accttitle LIKE '%AR DOCTOR%') AND c.type='pending') OR (c.accttitle='PROFESSIONAL FEE' AND c.type='cash-Visa')) GROUP BY a.caseno ORDER BY pp.lastname ASC");
}
    if(mysqli_num_rows($sqlPatient)>0){
      while($patient=mysqli_fetch_array($sqlPatient)){
        $caseno =$patient['caseno'];
        // $p=explode(' ',$patient['patientname']);
        // $patientname =$p[0].", ".$p[1];
        $patientname=$patient['patientname'];

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE ((accttitle='CASHONHAND' AND `type` LIKE '%Visa%') OR (accttitle ='PROFESSIONAL FEE' AND `type`='card-Visa')) AND acctno='$caseno'");
        $amount=mysqli_fetch_array($sql);
        $coh=$amount['amount'];
        if($coh>0){
        $coh1 +=0;
        }
        if($coh==0){
        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='PHARMACY/MEDICINE' AND trantype='charge' AND quantity > 0 AND administration='administered'");
        $amount=mysqli_fetch_array($sql);
        $meds=$amount['amount'];
        $meds1 +=$meds;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='LABORATORY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=mysqli_fetch_array($sql);
        $lab=$amount['amount'];
        $lab1 +=$lab;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='XRAY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=mysqli_fetch_array($sql);
        $xray=$amount['amount'];
        $xray1 +=$xray;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ULTRASOUND' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=mysqli_fetch_array($sql);
        $utz=$amount['amount'];
        $utz1 +=$utz;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ECG' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=mysqli_fetch_array($sql);
        $ecg=$amount['amount'];
        $ecg1 +=$ecg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='EEG' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=mysqli_fetch_array($sql);
        $eeg=$amount['amount'];
        $eeg1 +=$eeg;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='CT SCAN' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=mysqli_fetch_array($sql);
        $ct=$amount['amount'];
        $ct1 +=$ct;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='HEARTSTATION' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=mysqli_fetch_array($sql);
        $echo=$amount['amount'];
        $echo1 +=$echo;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='RESPIRATORY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=mysqli_fetch_array($sql);
        $respi=$amount['amount'];
        $respi1 +=$respi;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ROOM ACCOMODATION' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $room=$amount['amount'];
        $room1 +=$room;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productsubtype='PHARMACY/SUPPLIES' OR productsubtype='MEDICAL SURGICAL SUPPLIES' OR productsubtype='RESPIRATORY SUPPLIES' OR productsubtype='GENERAL SUPPLIES' OR (productsubtype LIKE '%MISCELLANEOUS%' AND (productdesc NOT LIKE '%MINOR ROOM FEE%' AND productdesc NOT LIKE '%RT FEE%')) OR productsubtype LIKE '%MEDICAL EQUIPMENT%' OR productsubtype='LINENS' OR productsubtype='MEDICAL SUPPLIES' OR (productsubtype='NURSING CHARGES' AND productdesc NOT LIKE '%OSTHEORIZED FEEDING%') OR productsubtype='NURSING-CHARGES' OR productsubtype='OR-CHARGES' OR (productsubtype='NURSING SERVICE FEE' AND productdesc='OR PACK') OR productsubtype='OR/DR SUPPLIES' or productsubtype='RT ON CALL' OR productsubtype='RT REFERRAL' OR (productsubtype='OR/DR/ER FEE' AND productdesc LIKE '%ARMY NAVY%')) AND productdesc NOT LIKE '%DEATH CERTIFICATE%' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $sup=$amount['amount'];
        $sup1 +=$sup;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productdesc LIKE '%RT FEE%') AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $rt=$amount['amount'];
        $rt1 +=$rt;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ER FEE' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $erfee=$amount['amount'];
        $erfee1 +=$erfee;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ADMISSION FEE' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $admit=$amount['amount'];
        $admit1 +=$admit;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%NURSING SERVICE FEE%' AND productdesc NOT LIKE '%OR PACK%' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $nsfee=$amount['amount'];
        $nsfee1 +=$nsfee;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productsubtype='OR/DR/ER FEE' OR (productsubtype LIKE '%MISCELLANEOUS%' AND productdesc LIKE '%MINOR ROOM FEE%')) AND productdesc NOT LIKE '%OR SERVICE FEE%' AND productdesc NOT LIKE '%DR SERVICE FEE%' AND productdesc NOT LIKE '%ARMY NAVY%' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $ordr=$amount['amount'];
        $ordr1 +=$ordr;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productsubtype='OR/DR/ER FEE' OR productsubtype='OR-CHARGES') AND (productdesc LIKE '%OR SERVICE FEE%' OR productdesc LIKE '%DR SERVICE FEE%') AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $ordrsupplies=$amount['amount'];
        $ordrsupplies1 += $ordrsupplies;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='OXYGEN SUPPLIES' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $oxygen=$amount['amount'];
        $oxygen1 +=$oxygen;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='MISCELLANEOUS' AND (productdesc='DEATH CERTIFICATE' OR productdesc='LAB 2ND COPY') AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $cert=$amount['amount'];
        $cert1 +=$cert;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productsubtype='DIETARY' OR productsubtype='DIETARY COUNSELING INCOME' OR productsubtype='OTHER FEES' OR productdesc LIKE '%OSTHEORIZED FEEDING%') AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $diet=$amount['amount'];
        $diet1 +=$diet;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='PHYSICAL THERAPY' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $pt=$amount['amount'];
        $pt1 +=$pt;

        $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='AMBULANCE INCOME' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $ambu=$amount['amount'];
        $ambu1 +=$ambu;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle LIKE '%APPF OTHERS%' OR (accttitle='PROFESSIONAL FEE' AND `type`='card-Visa'))");
        $amount=mysqli_fetch_array($sql);
        $appfother=$amount['amount'];
        $appfother1 +=$appfother;

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle='AR TRADE PF' OR accttitle='AR EMPLOYEE PF' OR accttitle='AR DOCTOR PF' OR accttitle='AR PERSONAL PF')");
        $amount=mysqli_fetch_array($sql);
        $appftrade=$amount['amount'];
        $appftrade1 +=$appftrade;

         $sql=mysqli_query($conn,"SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='OTHER INCOME' AND trantype='charge' AND quantity > 0");
         $amount=mysqli_fetch_array($sql);
         $appfphic=$amount['amount'];
         $appfphic1 +=$appfphic;

        $sql=mysqli_query($conn,"SELECT SUM(excess) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0");
        $amount=mysqli_fetch_array($sql);
        $excess=$amount['amount'];

        $sql=mysqli_query($conn,"SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND accttitle LIKE '%AP PATIENT DEPOSIT%'");
        $amount=mysqli_fetch_array($sql);
        $deposit=$amount['amount'];

        $dep=$excess-$deposit;

        if($dep<0){
          $appfdep=abs($dep);
        }else{
          $appfdep=0;
        }
        $appfdep1 +=$deposit;
      }

  }
  $totalcredit=$meds1+$lab1+$xray1+$utz1+$ecg1+$eeg1+$ct1+$echo1+$respi1+$room1+$sup1+$rt1+$erfee1+$admit1+$nsfee1+$ordr1+$oxygen1+$cert1+$diet1+$pt1+$ambu1+$appfother1+$appftrade1+$appfphic1+$appfdep1+$ordrsupplies1;
}
 ?>
<html>
<head>
  <title>DAILY DISCHARGED REPORT</title>
  <style type="text/css">
      /* Styles go here */
          .page {
            width: 100%;
          }

          @page {
          margin:40px;
          width: 100%;
          }

          @media print {
          button {display: none;}
          body {margin: 0;}
          table {width:100%;}
          }
  </style>
</head>
<body>
  <div class="page">
    <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td width="90">
          <img src="../main/img/logo/kmsci.png" width="80" height="80" />
        </td>
        <td>
          <b style="font-family:'Times New Roman'; font-size:16px;"><?=$heading;?></b><br />
          <font style="font-family:'Times New Roman'; font-size:12px;">
            <?=$address;?><br />
            <?=$email;?><br />
            <?=$telno;?>
          </font>
        </td>
      </tr>
    </table>
    <table width="100%" border="0">
      <tr>
        <td width="90">

        </td>
        <td>
          <b style="font-family:'Times New Roman'; font-size:12px;">DISCHARGED REPORT (W/O COH) - SUMMARY</b><br />
          <b style="font-family:'Times New Roman'; font-size:12px;">AS OF <?=date('F d, Y',strtotime($rundate));?></b>
        </td>
      </tr>
    </table>
    <br>
    <table width="50%" border="0" style="font-size:12px;">
        <tr>
            <td align="left" style="font-size:12px;"><b>ACCOUNTS</b></td>
            <td align="right" style="font-size:12px;"><b>BEG. BALANCE</b></td>
            <td align="right" style="font-size:12px;"><b>TODAY</b></td>
            <td align="right" style="font-size:12px;"><b>TOTAL TO DATE</b></td>
        </tr>
        <tr>
            <td>CASH ON HAND</td>
            <td align="right"><?=number_format($coh1beg,2);?></td>
            <td align="right"><?=number_format($coh1,2);?></td>
            <td align="right"><?=number_format($coh1beg+$coh1,2);?></td>
        </tr>
        <tr>
            <td>DEPOSIT</td>
            <td align="right"><?=number_format($dep1beg,2);?></td>
            <td align="right"><?=number_format($dep1,2);?></td>
            <td align="right"><?=number_format($dep1beg+$dep1,2);?></td>
        </tr>
        <tr>
            <td>DISCOUNT</td>
            <td align="right"><?=number_format($disc1beg,2);?></td>
            <td align="right"><?=number_format($disc1,2);?></td>
            <td align="right"><?=number_format($disc1beg+$disc1,2);?></td>
        </tr>
        <tr>
            <td>ACCOUNTS RECEIVABLE - PHIC</td>
            <td align="right"><?=number_format($arphic1beg,2);?></td>
            <td align="right"><?=number_format($arphic1,2);?></td>
            <td align="right"><?=number_format($arphic1beg+$arphic1,2);?></td>
        </tr>
        <?php
        if($trade1beg > 0 || $trade1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - TRADE</td>
            <td align="right"><?=number_format($trade1beg,2);?></td>
            <td align="right"><?=number_format($trade1,2);?></td>
            <td align="right"><?=number_format($trade1beg+$trade1,2);?></td>
        </tr>
        <?php
        }
        if($intel1beg > 0 || $intel1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - INTELLICARE</td>
            <td align="right"><?=number_format($intel1beg,2);?></td>
            <td align="right"><?=number_format($intel1,2);?></td>
            <td align="right"><?=number_format($intel1beg+$intel1,2);?></td>
        </tr>
        <?php
        }
        if($fortune1beg > 0 || $fortune1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - FORTUNE</td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
        </tr>
        <?php
        }
        if($province1beg > 0 || $province1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - PROVINCE</td>
            <td align="right"><?=number_format($province1beg,2);?></td>
            <td align="right"><?=number_format($province1,2);?></td>
            <td align="right"><?=number_format($province1beg+$province1,2);?></td>
        </tr>
<?php
        }
        if($pepsi1beg > 0 || $pepsi1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - PEPSI COLA</td>
            <td align="right"><?=number_format($pepsi1beg,2);?></td>
            <td align="right"><?=number_format($pepsi1,2);?></td>
            <td align="right"><?=number_format($pepsi1beg+$pepsi1,2);?></td>
        </tr>
        <?php
        }
        if($insu1beg > 0 || $insu1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - INSULAR HEALTHCARE</td>
            <td align="right"><?=number_format($insu1beg,2);?></td>
            <td align="right"><?=number_format($insu1,2);?></td>
            <td align="right"><?=number_format($insu1beg+$insu1,2);?></td>
        </tr>
        <?php
        }
        if($insulife1beg > 0 || $insulife1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - INSULAR LIFE</td>
            <td align="right"><?=number_format($insulife1beg,2);?></td>
            <td align="right"><?=number_format($insulife1,2);?></td>
            <td align="right"><?=number_format($insulife1beg+$insulife1,2);?></td>
        </tr>
        <?php
        }
        if($maxi1beg > 0 || $maxi1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - MAXICARE</td>
            <td align="right"><?=number_format($maxi1beg,2);?></td>
            <td align="right"><?=number_format($maxi1,2);?></td>
            <td align="right"><?=number_format($maxi1beg+$maxi1,2);?></td>
        </tr>
        <?php
        }
        if($flexi1beg > 0 || $flexi1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - FLEXICARE</td>
            <td align="right"><?=number_format($flexi1beg,2);?></td>
            <td align="right"><?=number_format($flexi1,2);?></td>
            <td align="right"><?=number_format($flexi1beg+$flexi1,2);?></td>
        </tr>
        <?php
        }
        if($al1beg > 0 || $al1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - ASIAN LIFE</td>
            <td align="right"><?=number_format($al1beg,2);?></td>
            <td align="right"><?=number_format($al1,2);?></td>
            <td align="right"><?=number_format($al1beg+$al1,2);?></td>
        </tr>
        <?php
        }
	if($balfour1beg > 0 || $balfour1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - FIRST BALFOUR</td>
            <td align="right"><?=number_format($balfour1beg,2);?></td>
            <td align="right"><?=number_format($balfour1,2);?></td>
            <td align="right"><?=number_format($balfour1beg+$balfour1,2);?></td>
        </tr>
        <?php
        }
        if($stanfilco1beg > 0 || $stanfilco1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - STANFILCO</td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
        </tr>
        <?php
        }
        if($avega1beg > 0 || $avega1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - AVEGA</td>
            <td align="right"><?=number_format($avega1beg,2);?></td>
            <td align="right"><?=number_format($avega1,2);?></td>
            <td align="right"><?=number_format($avega1beg+$avega1,2);?></td>
        </tr>

         <?php
        }
        if($sss1beg > 0 || $sss1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - SSS(SOCIAL SECURITY SYSTEM)</td>
            <td align="right"><?=number_format($sss1beg,2);?></td>
            <td align="right"><?=number_format($sss1,2);?></td>
            <td align="right"><?=number_format($sss1beg+$sss1,2);?></td>
        </tr>
        <?php
        }
        if($doctor1beg > 0 || $doctor1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - DOCTOR</td>
            <td align="right"><?=number_format($doctor1beg,2);?></td>
            <td align="right"><?=number_format($doctor1,2);?></td>
            <td align="right"><?=number_format($doctor1beg+$doctor1,2);?></td>
        </tr>
        <?php
        }
        if($sumifru1beg > 0 || $sumifru1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - SUMIFRU</td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
        </tr>
        <?php
        }
        if($vcare1beg > 0 || $vcare1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - VALUE CARE</td>
            <td align="right"><?=number_format($vcare1beg,2);?></td>
            <td align="right"><?=number_format($vcare1,2);?></td>
            <td align="right"><?=number_format($vcare1beg+$vcare1,2);?></td>
        </tr>
        <?php
        }
        if($chealth1beg > 0 || $chealth1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - CARE HEALTH</td>
            <td align="right"><?=number_format($chealth1beg,2);?></td>
            <td align="right"><?=number_format($chealth1,2);?></td>
            <td align="right"><?=number_format($chealth1beg+$chealth1,2);?></td>
        </tr>
        <?php
        }
        if($eastwest1beg > 0 || $eastwest1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - EAST WEST</td>
            <td align="right"><?=number_format($eastwest1beg,2);?></td>
            <td align="right"><?=number_format($eastwest1,2);?></td>
            <td align="right"><?=number_format($eastwest1beg+$eastwest1,2);?></td>
        </tr>
        <?php
        }
        if($generali1beg > 0 || $generali1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - GENERALI</td>
            <td align="right"><?=number_format($generali1beg,2);?></td>
            <td align="right"><?=number_format($generali1,2);?></td>
            <td align="right"><?=number_format($generali1beg+$generali1,2);?></td>
        </tr>
        <?php
        }
        if($pgicare1beg > 0 || $pgicare1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - PGI CARE</td>
            <td align="right"><?=number_format($pgicare1beg,2);?></td>
            <td align="right"><?=number_format($pgicare1,2);?></td>
            <td align="right"><?=number_format($pgicare1beg+$pgicare1,2);?></td>
        </tr>
        <?php
        }
        if($medcare1beg > 0 || $medcare1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - MEDOCARE</td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
        </tr>
        <?php
        }
        if($mcard1beg > 0 || $mcard1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - MEDICARD</td>
            <td align="right"><?=number_format($mcard1beg,2);?></td>
            <td align="right"><?=number_format($mcard1,2);?></td>
            <td align="right"><?=number_format($mcard1beg+$mcard1,2);?></td>
        </tr>
        <?php
        }
        if($prudent1beg > 0 || $prudent1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - PRUDENTIAL</td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
        </tr>
        <?php
        }
        if($clinic1beg > 0 || $clinic1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - CLINICARD</td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
        </tr>
        <?php
        }
        if($caritas1beg > 0 || $caritas1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - CARITAS</td>
            <td align="right"><?=number_format($caritas1beg,2);?></td>
            <td align="right"><?=number_format($caritas1,2);?></td>
            <td align="right"><?=number_format($caritas1beg+$caritas1,2);?></td>
        </tr>
        <?php
        }
        if($mplus1beg > 0 || $mplus1> 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - MEDICARE PLUS</td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
        </tr>
        <?php
        }
        if($personal1beg > 0 || $personal1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - PERSONAL</td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
        </tr>
        <?php
        }
        if($tradepf1beg > 0 || $tradepf1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - PF TRADE</td>
            <td align="right"><?=number_format($tradepf1beg,2);?></td>
            <td align="right"><?=number_format($tradepf1,2);?></td>
            <td align="right"><?=number_format($tradepf1beg+$tradepf1,2);?></td>
        </tr>
        <?php
        }
        if($employee1beg > 0 || $employee1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - EMPLOYEE</td>
            <td align="right"><?=number_format($employee1beg,2);?></td>
            <td align="right"><?=number_format($employee1,2);?></td>
            <td align="right"><?=number_format($employee1beg+$employee1,2);?></td>
        </tr>
        <?php
        }
        if($lgukid1beg > 0 || $lgukid1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - LGU KIDAPAWAN</td>
            <td align="right"><?=number_format($lgukid1beg,2);?></td>
            <td align="right"><?=number_format($lgukid1,2);?></td>
            <td align="right"><?=number_format($lgukid1beg+$lgukid1,2);?></td>
        </tr>
        <?php
        }
        if($lgumak1beg > 0 || $lgumak1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - LGU MAKILALA</td>
            <td align="right"><?=number_format($lgumak1beg,2);?></td>
            <td align="right"><?=number_format($lgumak1,2);?></td>
            <td align="right"><?=number_format($lgumak1beg+$lgumak1,2);?></td>
        </tr>
        <?php
        }
        if($dswd1beg > 0 || $dswd1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - DSWD</td>
            <td align="right"><?=number_format($dswd1beg,2);?></td>
            <td align="right"><?=number_format($dswd1,2);?></td>
            <td align="right"><?=number_format($dswd1beg+$dswd1,2);?></td>
        </tr>
        <?php
        }
        if($pcso1beg > 0 || $pcso1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - PCSO</td>
            <td align="right"><?=number_format($pcso1beg,2);?></td>
            <td align="right"><?=number_format($pcso1,2);?></td>
            <td align="right"><?=number_format($pcso1beg+$pcso1,2);?></td>
        </tr>
        <?php
        }
        if($mcl1beg > 0 || $mcl1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - MCL</td>
            <td align="right"><?=number_format($mcl1beg,2);?></td>
            <td align="right"><?=number_format($mcl1,2);?></td>
            <td align="right"><?=number_format($mcl1beg+$mcl1,2);?></td>
        </tr>
        <?php
        }
        if($cotelco1beg > 0 || $cotelco1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - COTELCO</td>
            <td align="right"><?=number_format($cotelco1beg,2);?></td>
            <td align="right"><?=number_format($cotelco1,2);?></td>
            <td align="right"><?=number_format($cotelco1beg+$cotelco1,2);?></td>
        </tr>
        <?php
        }
        if($coco1beg > 0 || $coco1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - COCOLIFE</td>
            <td align="right"><?=number_format($coco1beg,2);?></td>
            <td align="right"><?=number_format($coco1,2);?></td>
            <td align="right"><?=number_format($coco1beg+$coco1,2);?></td>
        </tr>
        <?php
        }
        if($office1beg > 0 || $office1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - OFFICE OF THE PRESIDENT</td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
        </tr>
        <?php
    }
    if($pcross1beg > 0 || $pcross1 > 0){
    ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - PACIFIC CROSS</td>
            <td align="right"><?=number_format($pcross1beg,2);?></td>
            <td align="right"><?=number_format($pcross1,2);?></td>
            <td align="right"><?=number_format($pcross1beg+$pcross1,2);?></td>
        </tr>
        <?php
    }
    if($phc1beg > 0 || $phc1 > 0){
    ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - PHILHEALTHCARE</td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
        </tr>
        <?php
    }
    if($pcare1beg > 0 || $pcare1 > 0){
    ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - PHIL CARE</td>
            <td align="right"><?=number_format($pcare1beg,2);?></td>
            <td align="right"><?=number_format($pcare1,2);?></td>
            <td align="right"><?=number_format($pcare1beg+$pcare1,2);?></td>
        </tr>
        <?php
    }
    if($catamco1beg > 0 || $catamco1 > 0){
    ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - CATAMCO</td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
        </tr>
        <?php
    }
    if($tejada1beg > 0 || $tejada1 > 0){
    ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - CONG TEJADA MAIP FUND</td>
            <td align="right"><?=number_format($tejada1beg,2);?></td>
            <td align="right"><?=number_format($tejada1,2);?></td>
            <td align="right"><?=number_format($tejada1beg+$tejada1,2);?></td>
        </tr>
        <?php
    }
    if($santos1beg > 0 || $santos1 > 0){
    ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - CONG SANTOS MAIP FUND</td>
            <td align="right"><?=number_format($santos1beg,2);?></td>
            <td align="right"><?=number_format($santos1,2);?></td>
            <td align="right"><?=number_format($santos1beg+$santos1,2);?></td>
        </tr>
        <?php
    }
    if($caoagdan1beg > 0 || $caoagdan1 > 0){
    ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - CONG CAOAGDAN MAIP FUND</td>
            <td align="right"><?=number_format($caoagdan1beg,2);?></td>
            <td align="right"><?=number_format($caoagdan1,2);?></td>
            <td align="right"><?=number_format($caoagdan1beg+$caoagdan1,2);?></td>
        </tr>
        <?php
    }
    if($pinol1beg > 0 || $pinol1 > 0){
    ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - VICE GOV. PIÑOL MAIP FUND</td>
            <td align="right"><?=number_format($pinol1beg,2);?></td>
            <td align="right"><?=number_format($pinol1,2);?></td>
            <td align="right"><?=number_format($pinol1beg+$pinol1,2);?></td>
        </tr>
        <?php
    }
    if($maip1beg > 0 || $maip1 > 0){
    ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - MAIP FUND</td>
            <td align="right"><?=number_format($maip1beg,2);?></td>
            <td align="right"><?=number_format($maip1,2);?></td>
            <td align="right"><?=number_format($maip1beg+$maip1,2);?></td>
        </tr>
        <?php
    }
    if($mcp1beg > 0 || $mcp1 > 0){
    ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - MCP</td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
        </tr>
        <?php
    }
    if($makmpc1beg > 0 || $makmpc1 > 0){
    ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - MAK MPC</td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
        </tr>
        <?php
    }
    if($mediatrix1beg > 0 || $mediatrix1 > 0){
    ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - MEDIATRIX</td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
            <td align="right"><?=number_format(0,2);?></td>
        </tr>
        <?php
    }
    ?>
       
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td><b>TOTAL DEBIT</b></td>
            <td align="right"><b><?=number_format($credittotalbeg,2);?></b></td>
            <td align="right"><b><?=number_format($credittotal,2);?></b></td>
            <td align="right"><b><?=number_format($credittotalbeg+$credittotal,2);?></b></td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <?php        
        if($meds1beg > 0 || $meds1 > 0){
        ?>
        <tr>
            <td>PHARMACY</td>
            <td align="right"><?=number_format($meds1beg,2);?></td>
            <td align="right"><?=number_format($meds1,2);?></td>
            <td align="right"><?=number_format($meds1beg+$meds1,2);?></td>
        </tr>
        <?php
        }
        if($lab1beg > 0 || $lab1 > 0){
        ?>
        <tr>
            <td>LABORATORY</td>
            <td align="right"><?=number_format($lab1beg,2);?></td>
            <td align="right"><?=number_format($lab1,2);?></td>
            <td align="right"><?=number_format($lab1beg+$lab1,2);?></td>
        </tr>
        <?php
        }
        if($xray1beg > 0 || $xray1 > 0){
        ?>
        <tr>
            <td>RADIOLOGY</td>
            <td align="right"><?=number_format($xray1beg,2);?></td>
            <td align="right"><?=number_format($xray1,2);?></td>
            <td align="right"><?=number_format($xray1beg+$xray1,2);?></td>
        </tr>
        <?php
        }
       if($ct1beg > 0 || $ct1 > 0){
        ?>
        <tr>
            <td>CT SCAN</td>
            <td align="right"><?=number_format($ct1beg,2);?></td>
            <td align="right"><?=number_format($ct1,2);?></td>
            <td align="right"><?=number_format($ct1beg+$ct1,2);?></td>
        </tr>
        <?php
        }
        if($utz1beg > 0 || $utz1 > 0){
        ?>
        <tr>
            <td>ULTRASOUND</td>
            <td align="right"><?=number_format($utz1beg,2);?></td>
            <td align="right"><?=number_format($utz1,2);?></td>
            <td align="right"><?=number_format($utz1beg+$utz1,2);?></td>
        </tr>
        <?php
        }
        if($ecg1beg > 0 || $ecg1 > 0){
        ?>
        <tr>
            <td>ECG/STRESS TEST</td>
            <td align="right"><?=number_format($ecg1beg,2);?></td>
            <td align="right"><?=number_format($ecg1,2);?></td>
            <td align="right"><?=number_format($ecg1beg+$ecg1,2);?></td>
        </tr>
        <?php
        }
        if($mammo1beg > 0 || $mammo1 > 0){
        ?>
        <tr>
            <td>MAMMOGRAPHY</td>
            <td align="right"><?=number_format($mammo1beg,2);?></td>
            <td align="right"><?=number_format($mammo1,2);?></td>
            <td align="right"><?=number_format($mammo1beg+$mammo1,2);?></td>
        </tr>
        <?php
        }
        if($eeg1beg > 0 || $eeg1 > 0){
        ?>
        <tr>
            <td>EEG</td>
            <td align="right"><?=number_format($eeg1beg,2);?></td>
            <td align="right"><?=number_format($eeg1,2);?></td>
            <td align="right"><?=number_format($eeg1beg+$eeg1,2);?></td>
        </tr>
        <?php
        }
        if($respi1beg > 0 || $respi1 > 0){
        ?>
        <tr>
            <td>RESPIRATORY</td>
            <td align="right"><?=number_format($respi1beg,2);?></td>
            <td align="right"><?=number_format($respi1,2);?></td>
            <td align="right"><?=number_format($respi1beg+$respi1,2);?></td>
        </tr>
        <?php
        }
        if($audio1beg > 0 || $audio1 > 0){
        ?>
        <tr>
            <td>AUDIOMETRY</td>
            <td align="right"><?=number_format($audio1beg,2);?></td>
            <td align="right"><?=number_format($audio1,2);?></td>
            <td align="right"><?=number_format($audio1beg+$audio1,2);?></td>
        </tr>
        <?php
        }
        if($biop1beg > 0 || $biop1 > 0){
        ?>
        <tr>
            <td>BIOPSY</td>
            <td align="right"><?=number_format($biop1beg,2);?></td>
            <td align="right"><?=number_format($biop1,2);?></td>
            <td align="right"><?=number_format($biop1beg+$biop1,2);?></td>
        </tr>
        <?php
        }
        if($echo1beg > 0 || $echo1 > 0){
        ?>
        <tr>
            <td>2D ECHO</td>
            <td align="right"><?=number_format($echo1beg,2);?></td>
            <td align="right"><?=number_format($echo1,2);?></td>
            <td align="right"><?=number_format($echo1beg+$echo1,2);?></td>
        </tr>
        <?php
        }
        if($room1beg > 0 || $room1 > 0){
        ?>
        <tr>
            <td>ROOM ACCOMODATION</td>
            <td align="right"><?=number_format($room1beg,2);?></td>
            <td align="right"><?=number_format($room1,2);?></td>
            <td align="right"><?=number_format($room1beg+$room1,2);?></td>
        </tr>
        <?php
        }
        if($sup1beg > 0 || $sup1 > 0){
        ?>
        <tr>
            <td>MEDICAL SUPPLIES</td>
            <td align="right"><?=number_format($sup1beg,2);?></td>
            <td align="right"><?=number_format($sup1,2);?></td>
            <td align="right"><?=number_format($sup1beg+$sup1,2);?></td>
        </tr>
        <?php
        }
        if($rt1beg > 0 || $rt1 > 0){
        ?>
        <tr>
            <td>RT FEE</td>
            <td align="right"><?=number_format($rt1beg,2);?></td>
            <td align="right"><?=number_format($rt1,2);?></td>
            <td align="right"><?=number_format($rt1beg+$rt1,2);?></td>
        </tr>
        <?php
        }
        if($erfee1beg > 0 || $erfee1 > 0){
        ?>
        <tr>
            <td>ER FEE</td>
            <td align="right"><?=number_format($erfee1beg,2);?></td>
            <td align="right"><?=number_format($erfee1,2);?></td>
            <td align="right"><?=number_format($erfee1beg+$erfee1,2);?></td>
        </tr>
        <?php
        }
        if($admit1beg > 0 || $admit1 > 0){
        ?>
        <tr>
            <td>ADMITTING FEE</td>
            <td align="right"><?=number_format($admit1beg,2);?></td>
            <td align="right"><?=number_format($admit1,2);?></td>
            <td align="right"><?=number_format($admit1beg+$admit1,2);?></td>
        </tr>
        <?php
        }
        if($nsfee1beg > 0 || $nsfee1 > 0){
        ?>
        <tr>
            <td>NS FEE</td>
            <td align="right"><?=number_format($nsfee1beg,2);?></td>
            <td align="right"><?=number_format($nsfee1,2);?></td>
            <td align="right"><?=number_format($nsfee1beg+$nsfee1,2);?></td>
        </tr>
        <?php
        }
        if($ordr1beg > 0 || $ordr1 > 0){
        ?>
        <tr>
            <td>OR/DR FEE</td>
            <td align="right"><?=number_format($ordr1beg,2);?></td>
            <td align="right"><?=number_format($ordr1,2);?></td>
            <td align="right"><?=number_format($ordr1beg+$ordr1,2);?></td>
        </tr>
        <?php
        }
        if($ordrsupplies1beg > 0 || $ordrsupplies1 > 0){
        ?>
        <tr>
            <td>OR/DR SUPPLIES</td>
            <td align="right"><?=number_format($ordrsupplies1beg,2);?></td>
            <td align="right"><?=number_format($ordrsupplies1,2);?></td>
            <td align="right"><?=number_format($ordrsupplies1beg+$ordrsupplies1,2);?></td>
        </tr>
        <?php
        }
        if($oxygen1beg > 0 || $oxygen1 > 0){
        ?>
        <tr>
            <td>OXYGEN</td>
            <td align="right"><?=number_format($oxygen1beg,2);?></td>
            <td align="right"><?=number_format($oxygen1,2);?></td>
            <td align="right"><?=number_format($oxygen1beg+$oxygen1,2);?></td>
        </tr>
        <?php
        }
        if($ambu1beg > 0 || $ambu1 > 0){
        ?>
        <tr>
            <td>AMBULANCE</td>
            <td align="right"><?=number_format($ambu1beg,2);?></td>
            <td align="right"><?=number_format($ambu1,2);?></td>
            <td align="right"><?=number_format($ambu1beg+$ambu1,2);?></td>
        </tr>
        <?php
        }
        if($diet1beg > 0 || $diet1 > 0){
        ?>
        <tr>
            <td>DIETARY</td>
            <td align="right"><?=number_format($diet1beg,2);?></td>
            <td align="right"><?=number_format($diet1,2);?></td>
            <td align="right"><?=number_format($diet1beg+$diet1,2);?></td>
        </tr>
        <?php
        }
        if($cert1beg > 0 || $cert1 > 0){
        ?>
        <tr>
            <td>CERTIFICATION</td>
            <td align="right"><?=number_format($cert1beg,2);?></td>
            <td align="right"><?=number_format($cert1,2);?></td>
            <td align="right"><?=number_format($cert1beg+$cert1,2);?></td>
        </tr>
        <?php
        }
        if($pt1beg > 0 || $pt1 > 0){
        ?>
        <tr>
            <td>PHYSICAL THERAPY</td>
            <td align="right"><?=number_format($pt1beg,2);?></td>
            <td align="right"><?=number_format($pt1,2);?></td>
            <td align="right"><?=number_format($pt1beg+$pt1,2);?></td>
        </tr>
        <?php
        }
        if($appfother1beg > 0 || $appfother1 > 0){
        ?>
        <tr>
            <td>A/P PF OTHERS</td>
            <td align="right"><?=number_format($appfother1beg,2);?></td>
            <td align="right"><?=number_format($appfother1,2);?></td>
            <td align="right"><?=number_format($appfother1beg+$appfother1,2);?></td>
        </tr>
        <?php
        }
        if($appfdep1beg > 0 || $appfdep1 > 0){
        ?>
        <tr>
            <td>A/P PATIENT DEPOSIT</td>
            <td align="right"><?=number_format($appfdep1beg,2);?></td>
            <td align="right"><?=number_format($appfdep1,2);?></td>
            <td align="right"><?=number_format($appfdep1beg+$appfdep1,2);?></td>
        </tr>
        <?php
        }
        if($appftrade1beg > 0 || $appftrade1 > 0){
        ?>
        <tr>
            <td>A/P PF TRADE</td>
            <td align="right"><?=number_format($appftrade1beg,2);?></td>
            <td align="right"><?=number_format($appftrade1,2);?></td>
            <td align="right"><?=number_format($appftrade1beg+$appftrade1,2);?></td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td><b>TOTAL CREDIT</b></td>
            <td align="right"><b><?=number_format($totalcreditbeg,2);?></b></td>
            <td align="right"><b><?=number_format($totalcredit,2);?></b></td>
            <td align="right"><b><?=number_format($totalcreditbeg+$totalcredit,2);?></b></td>
        </tr>
    </table>   
    <br><br><br>
    <table width="50%" border="0" cellspacing="0" cellpadding="1" style="font-size:12px;">    
      <tr>
        <td><b>Prepared by:</b></td>
        <td><b>Checked by:</b></td>
        <td><b>Noted by:</b></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><u><?=$_SESSION['username'];?></u></td>
        <td align="center"><u>E. MUDANZA</u></td>
        <td align="center"><u>MEHRALYN L. TORCULAS</u></td>
      </tr>
      <tr>
        <td align="center">BILLING</td>
        <td align="center">CASHIER</td>
        <td align="center">FINANCE OFFICER</td>
      </tr>
    </table> 
  </div>
</body>
</html>
