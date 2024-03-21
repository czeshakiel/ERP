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
$enddate=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));
$startdate=date('Y-m-d',strtotime('-1 day',strtotime($enddate)));
$checkdate=date('Y-m',strtotime($rundate))."-01";
$datefrom=date('Y-m-d',strtotime('-2 days',strtotime($checkdate)))." 23:00:00";
$datestart=date('Y-m-d',strtotime($startdate))." 23:00:00";
$sqlHeading=$this->General_model->db->query("SELECT * FROM heading");
$head=$sqlHeading->row_array();
$heading=$head['heading'];
$address=$head['address'];
$email=$head['FullAddress'];
$telno=$head['telno'];
$img=$head['custodian'];
$date=date('M-d-Y',strtotime($enddate));
$cohbeg=0;$depbeg=0;$discbeg=0;$arphicbeg=0;$arpfphicbeg=0;$albeg=0;$avegabeg=0;$chealthbeg=0;$caritasbeg=0;$cocobeg=0;$flexibeg=0;$intelbeg=0;$maxibeg=0;$mclbeg=0;$mcardbeg=0;$pcarebeg=0;$vcarebeg=0;$cotelcobeg=0;$santosbeg=0;$caoagdanbeg=0;$pinolbeg=0;$medoarebeg=0;
$dswdbeg=0;$lgumakbeg=0;$lgukidbeg=0;$pcsobeg=0;$pepsibeg=0;$provincebeg=0;$tradebeg=0;$tradepfbeg=0;$pcrossbeg=0;$maipbeg=0;$insubeg=0;$fortunebeg=0;$stanfilcobeg=0;$doctorbeg=0;$sumifrubeg=0;$easwestbeg=0;$vcarebeg=0;
$genearlibeg=0;$medcardbeg=0;$prudentbeg=0;$clinicbeg=0;$mplusbeg=0;$personalbeg=0;$employeebeg=0;$officebeg=0;$phcbeg=0;$catamcobeg=0;$tejadabeg=0;$mcpbeg=0;$makmpcbeg=0;$mediatrixbeg=0;$pgicarebeg=0;$balfourbeg=0;
$coh1beg=0;$dep1beg=0;$disc1beg=0;$arphic1beg=0;$arpfphic1beg=0;$al1beg=0;$avega1beg=0;$chealth1beg=0;$caritas1beg=0;$coco1beg=0;$flexi1beg=0;$intel1beg=0;$maxi1beg=0;$mcl1beg=0;$mcard1beg=0;$pcare1beg=0;$balfour1beg=0;$sss1beg=0;
$vcare1beg=0;$dswd1beg=0;$lgumak1beg=0;$lgukid1beg=0;$pcso1beg=0;$pcso2beg=0;$pepsi1beg=0;$province1beg=0;$trade1beg=0;$tradepf1beg=0;$pcross1beg=0;$maip1beg=0;$insu1beg=0;$forutne1beg=0;$stanfilco1beg=0;$doctor1beg=0;$cotelco1beg=0;$santos1beg=0;$caoagdan1beg=0;$pinol1beg=0;$audio1beg=0;$biop1beg=0;
$sumifru1beg=0;$eastwest1beg=0;$generali1beg=0;$medcard1beg=0;$prudent1beg=0;$clinic1beg=0;$mplus1beg=0;$personal1beg=0;$employee1beg=0;$office1beg=0;$phc1beg=0;$catamco1beg=0;$tejada1beg=0;$mcp1beg=0;$makmpc1beg=0;$mediatrix1beg=0;$pgicare1beg=0;$medocare1beg=0;$cotelco2beg=0;$fortune1beg=0;$medcare1beg=0;$mammo1beg=0;
$totalamountbeg=0;
$credittotalbeg=0;
if($department=="R-"){
$sqlPatient=$this->General_model->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname FROM admission a LEFT JOIN dischargedtable c ON c.caseno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE c.datearray BETWEEN '$checkdate' AND '$enddate' AND (a.status='discharged' OR a.ward = 'discharged') AND a.caseno LIKE '$department%' AND a.hmo <> 'N/A' GROUP BY a.caseno ORDER BY pp.lastname ASC");
}else if($department=="O-"){
$sqlPatient=$this->General_model->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname FROM admission a LEFT JOIN dischargedtable c ON c.caseno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE c.datearray BETWEEN '$checkdate' AND '$enddate' AND (a.status='discharged' OR a.ward = 'discharged') AND (a.caseno LIKE '$department%' OR a.caseno LIKE 'W-%' OR a.caseno LIKE 'O-%') AND a.hmo <> 'N/A' GROUP BY a.caseno ORDER BY pp.lastname ASC");
}else{
$sqlPatient=$this->General_model->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE CONCAT(c.datearray,' ',c.paymentTime) >= '$datefrom' AND CONCAT(c.datearray,' ',c.paymentTime) <= '$datestart' AND a.status='discharged' AND a.caseno LIKE '%$department%' AND a.hmo <> 'N/A' AND ((c.accttitle='CASHONHAND' AND (c.type='cash-Visa' OR c.type='card-Visa')) OR (c.accttitle='PROFESSIONAL FEE' AND c.type='card-Visa') OR (((c.accttitle = 'AR TRADE' OR c.accttitle LIKE '%AR TRADE%' OR c.accttitle = 'NO EXCESS' OR c.accttitle LIKE 'AR EMPLOYEE%' OR c.accttitle LIKE '%AR DOCTOR%') AND c.type='pending'))) GROUP BY a.caseno ORDER BY pp.lastname ASC");
}
    if($sqlPatient->num_rows()>0){      
        foreach($sqlPatient->result_array() as $patient){
        $caseno =$patient['caseno'];       
        $patientname=$patient['patientname'];
        //$coh1beg +=$patient['amount'];
        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE ((accttitle='CASHONHAND' AND (`type`='cash-Visa' OR `type`='card-Visa')) OR (accttitle ='PROFESSIONAL FEE' AND `type`='card-Visa')) AND acctno='$caseno'");
        $amount=$sql->row_array();
        $cohbeg=$amount['amount'];        
        if($cohbeg>0){
          $coh1beg +=$cohbeg;
        }        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='PATIENTS DEPOSIT' AND acctno='$caseno' AND `type` <> 'pending'");
        $amount=$sql->row_array();
        $depbeg=$amount['amount'];        
        $dep1beg +=$depbeg;

        $sql=$this->General_model->db->query("SELECT SUM(adjustment) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype NOT LIKE '%PROFESSIONAL FEE%' AND quantity > 0");
        $amount=$sql->row_array();
        $discbeg=$amount['amount'];
        $disc1beg +=$discbeg;

        $sql=$this->General_model->db->query("SELECT SUM(phic+phic1) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $arphicbeg=$amount['amount'];
        $arphic1beg +=$arphicbeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='ASIAN LIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $albeg=$amount['amount'];
        $al1beg +=$albeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='AVEGA' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $avegabeg=$amount['amount'];
        $avega1beg +=$avegabeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='CAREHEALTH' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $chealthbeg=$amount['amount'];
        $chealth1beg +=$chealthbeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='CARITAS' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $caritasbeg=$amount['amount'];
        $caritas1beg +=$caritasbeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='COCOLIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $cocobeg=$amount['amount'];
        $coco1beg +=$cocobeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='FLEXICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $flexibeg=$amount['amount'];
        $flexi1beg +=$flexibeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INTELLICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $intelbeg=$amount['amount'];
        $intel1beg +=$intelbeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MEDOCARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $medocarebeg=$amount['amount'];
        $medocare1beg +=$medocarebeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MAXICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $maxibeg=$amount['amount'];
        $maxi1beg +=$maxibeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MCL' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $mclbeg=$amount['amount'];
        $mcl1beg +=$mclbeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MEDICARD' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $mcardbeg=$amount['amount'];
        $mcard1beg +=$mcardbeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PHILCARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $pcarebeg=$amount['amount'];
        $pcare1beg +=$pcarebeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='VALUE CARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $vcarebeg=$amount['amount'];
        $vcare1beg +=$vcarebeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PACIFIC CROSS' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $pcrossbeg=$amount['amount'];
        $pcross1beg +=$pcrossbeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INSULAR HEALTHCARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $insubeg=$amount['amount'];
        $insu1beg +=$insubeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='GENERALI' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $generalibeg=$amount['amount'];
        $generali1beg +=$generalibeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PGI CARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $pgicarebeg=$amount['amount'];
        $pgicare1beg +=$pgicarebeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='EAST WEST' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $eastwestbeg=$amount['amount'];
        $eastwest1beg +=$eastwestbeg;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR DSWD' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $dswdbeg=$amount['amount'];
        $dswd1beg +=$dswdbeg;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE (accttitle='AR LGU KIDAPAWAN' OR accttitle='A/R LGU KIDAPAWAN' OR accttitle='AR LGU-KIDAPAWAN') AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $lgukidbeg=$amount['amount'];
        $lgukid1beg +=$lgukidbeg;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE (accttitle='A/R LGU MAKILALA' OR accttitle='AR LGU MAKILALA' OR accttitle='AR LGU-MAKILALA') AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $lgumakbeg=$amount['amount'];
        $lgumak1beg +=$lgumakbeg;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PCSO' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $pcsobeg=$amount['amount'];
        $pcso1beg +=$pcsobeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='PCSO' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $pcsobeg=$amount['amount'];
        $pcso2beg +=$pcsobeg; 

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR COTELCO' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $cotelcobeg=$amount['amount'];
        $cotelco1beg +=$cotelcobeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='COTELCO' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $cotelcobeg=$amount['amount'];
        $cotelco2beg +=$cotelcobeg; 

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PEPSI' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $pepsibeg=$amount['amount'];
        $pepsi1beg +=$pepsibeg;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PROVINCE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $provincebeg=$amount['amount'];
        $province1beg +=$provincebeg;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $maipbeg=$amount['amount'];
        $maip1beg +=$maipbeg;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%TEJADA MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $tejadabeg=$amount['amount'];
        $tejada1beg +=$tejadabeg;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%SANTOS MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $santosbeg=$amount['amount'];
        $santos1beg +=$santosbeg;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%CAOAGDAN MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $caoagdanbeg=$amount['amount'];
        $caoagdan1beg +=$caoagdanbeg;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%PIÑOL MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $pinolbeg=$amount['amount'];
        $pinol1beg +=$pinolbeg;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND accttitle='AR TRADE' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $tradebeg=$amount['amount'];
        $trade1beg +=$tradebeg;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle='AR TRADE PF' OR accttitle='AR EMPLOYEE PF' OR accttitle='AR DOCTOR PF' OR accttitle='AR PERSONAL PF') AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $tradepfbeg=$amount['amount'];
        $tradepf1beg +=$tradepfbeg;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR EMPLOYEE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $employeebeg=$amount['amount'];
        $employee1beg +=$employeebeg;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR DOCTOR' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $doctorbeg=$amount['amount'];
        $doctor1beg +=$doctorbeg;

    $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='FIRST BALFOUR' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
    $amount=$sql->row_array();
        $balfourbeg=$amount['amount'];
        $balfour1beg +=$balfourbeg;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo LIKE '%SSS%' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $sss=$amount['amount'];
        $sss1beg +=$sss;



  }
  if($rundate==$checkdate){
    $coh1beg=0;$dep1beg=0;$disc1beg=0;$arphic1beg=0;$arpfphic1beg=0;$al1beg=0;$avega1beg=0;$chealth1beg=0;$caritas1beg=0;$coco1beg=0;$flexi1beg=0;$intel1beg=0;$maxi1beg=0;$mcl1beg=0;$mcard1beg=0;$pcare1beg=0;$pgicare1beg=0;
$vcare1beg=0;$dswd1beg=0;$lgumak1beg=0;$lgukid1beg=0;$pcso1beg=0;$pepsi1beg=0;$province1beg=0;$trade1beg=0;$tradepf1beg=0;$pcross1beg=0;$maip1beg=0;$insu1beg=0;$fortune1beg=0;$stanfilco1beg=0;$doctor1beg=0;$sumifru1beg=0;$eastwest1beg=0;$generali1beg=0;$medcard1beg=0;$prudent1beg=0;$clinic1beg=0;$mplus1beg=0;$personal1beg=0;$employee1beg=0;$office1beg=0;$phc1beg=0;$catamco1beg=0;$tejada1beg=0;$mcp1beg=0;$makmpc1beg=0;$mediatrix1beg=0;$cotelco1beg=0;$santos1beg=0;$caoagdan1beg=0;$pinol1beg=0;$pcso2beg=0;$medocare1beg=0;$cotelco2beg=0;$balfour1beg=0;$sss1beg=0;
  }
  $credittotalbeg=$coh1beg+$dep1beg+$disc1beg+$arphic1beg+$arpfphic1beg+$al1beg+$avega1beg+$chealth1beg+$caritas1beg+$coco1beg+$flexi1beg+$intel1beg+$maxi1beg+$mcl1beg+$mcard1beg+$pcare1beg+$vcare1beg+$pcross1beg+$dswd1beg+$lgumak1beg+$lgukid1beg+$pcso1beg+$pepsi1beg+$province1beg+$trade1beg+$tradepf1beg+$maip1beg+$insu1beg+$fortune1beg+$stanfilco1beg+$doctor1beg+$sumifru1beg+$eastwest1beg+$generali1beg+$medcard1beg+$prudent1beg+$clinic1beg+$mplus1beg+$personal1beg+$employee1beg+$office1beg+$phc1beg+$catamco1beg+$tejada1beg+$mcp1beg+$makmpc1beg+$mediatrix1beg+$pgicare1beg+$cotelco1beg+$santos1beg+$caoagdan1beg+$pinol1beg+$pcso2beg+$medocare1beg+$cotelco2beg+$balfour1beg+$cotelco2beg+$sss1beg;
}

$coh=0;$dep=0;$disc=0;$arphic=0;$arpfphic=0;$al=0;$avega=0;$chealth=0;$caritas=0;$coco=0;$flexi=0;$intel=0;$maxi=0;$mcl=0;$mcard=0;$pcare=0;$vcare=0;$office=0;$phc=0;$catamco=0;$tejada=0;$mcp=0;$makmpc=0;
$mediatrix=0;$pgicare=0;$cotelco=0;$balfour=0;
$dswd=0;$lgumak=0;$lgukid=0;$pcso=0;$pepsi=0;$province=0;$trade=0;$tradepf=0;$pcross=0;$maip=0;$insu=0;$fortune=0;$stanfilco=0;$doctor=0;$sumifru=0;$eastwest=0;$generali=0;$prudent=0;$clinic=0;$personal=0;$santos=0;$caoagdan=0;$pinol=0;
$employee=0;$balfour1=0;$sss=0;
$coh1=0;$dep1=0;$disc1=0;$arphic1=0;$arpfphic1=0;$al1=0;$avega1=0;$chealth1=0;$caritas1=0;$coco1=0;$flexi1=0;$intel1=0;$maxi1=0;$mcl1=0;$mcard1=0;$pcare1=0;$vcare1=0;$sss1=0;
$dswd1=0;$lgumak1=0;$lgukid1=0;$pcso1=0;$pcso2=0;$pepsi1=0;$province1=0;$trade1=0;$tradepf1=0;$pcross1=0;$maip1=0;$insu1=0;$fortune1=0;$stanfilco1=0;$doctor1=0;$sumifru1=0;$eastwest1=0;$generali1=0;$prudent1=0;$pgicare1=0;$cotelco1=0;$santos1=0;$caoagdan1=0;$pinol1=0;$cotelco2=0;$mammo1=0;$audio1=0;$biop1=0;
$clinic1=0;$personal1=0;$employee1=0;$office1=0;$phc1=0;$catamco1=0;$tejada1=0;$mcp1=0;$makmpc1=0;$mediatrix1=0;$medocare1=0;$medcard1=0;$mplus1=0;$medcare1=0;
$totalamount=0;
$credittotal=0;
if($department=="R-"){
$sqlPatient=$this->General_model->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname FROM admission a LEFT JOIN dischargedtable c ON c.caseno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE (c.datearray = '$rundate') AND (a.status='discharged' OR a.ward = 'discharged') AND a.caseno LIKE '$department%' AND a.hmo <> 'N/A' GROUP BY a.caseno ORDER BY pp.lastname ASC");
}else if($department=="O-"){
$sqlPatient=$this->General_model->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname FROM admission a LEFT JOIN dischargedtable c ON c.caseno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE (c.datearray = '$rundate') AND (a.status='discharged' OR a.ward = 'discharged') AND (a.caseno LIKE '$department%' OR a.caseno LIKE 'W-%' OR a.caseno LIKE 'O-%') AND a.hmo <> 'N/A' GROUP BY a.caseno ORDER BY pp.lastname ASC");
}else{
$sqlPatient=$this->General_model->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE ((c.datearray = '$startdate' AND c.paymentTime >= '23:00:00') OR (c.datearray = '$enddate' AND c.paymentTime <= '23:00:00')) AND a.status='discharged' AND a.caseno LIKE '$department%' AND a.hmo <> 'N/A' AND ((c.accttitle='CASHONHAND' AND (c.type='cash-Visa' OR c.type='card-Visa')) OR (c.accttitle='PROFESSIONAL FEE' AND c.type='card-Visa') OR (((c.accttitle = 'AR TRADE' OR c.accttitle LIKE '%AR TRADE%' OR c.accttitle = 'NO EXCESS' OR c.accttitle LIKE '%AR EMPLOYEE%' OR c.accttitle LIKE '%AR DOCTOR%') AND c.type='pending'))) GROUP BY a.caseno ORDER BY pp.lastname ASC");
}
    if($sqlPatient->num_rows()>0){
      foreach($sqlPatient->result_array() as $patient){
        $caseno =$patient['caseno'];
        
        $patientname=$patient['patientname'];

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE ((accttitle='CASHONHAND' AND (`type`='cash-Visa' OR `type`='card-Visa')) OR (accttitle ='PROFESSIONAL FEE' AND `type`='card-Visa')) AND acctno='$caseno'");
        $amount=$sql->row_array();
        $coh=$amount['amount'];        
        if($coh>0){
          $coh1 +=$coh;
        }

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='PATIENTS DEPOSIT' AND acctno='$caseno' AND `type` <> 'pending'");
        $amount=$sql->row_array();
        $dep=$amount['amount'];        
        $dep1 +=$dep;

        $sql=$this->General_model->db->query("SELECT SUM(adjustment) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype NOT LIKE '%PROFESSIONAL FEE%' AND quantity > 0");
        $amount=$sql->row_array();
        $disc=$amount['amount'];
        $disc1 +=$disc;

        $sql=$this->General_model->db->query("SELECT SUM(phic+phic1) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $arphic=$amount['amount'];
        $arphic1 +=$arphic;

        // $sql=$this->General_model->db->query("SELECT SUM(phic+phic1) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='PROFESSIONAL FEE' AND trantype='charge' AND quantity > 0 AND producttype NOT LIKE '%IPD admitting%'");
        // $amount=$sql->row_array();
        // $arpfphic=$amount['amount'];
        // $arpfphic1 +=$arpfphic;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='ASIAN LIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $al=$amount['amount'];
        $al1 +=$al;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='AVEGA' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $avega=$amount['amount'];
        $avega1 +=$avega;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='CAREHEALTH' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $chealth=$amount['amount'];
        $chealth1 +=$chealth;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='CARITAS' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $caritas=$amount['amount'];
        $caritas1 +=$caritas;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='COCOLIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $coco=$amount['amount'];
        $coco1 +=$coco;

    $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='FIRST BALFOUR' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
    $amount=$sql->row_array();
        $balfour=$amount['amount'];
        $balfour1 +=$balfour;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='FLEXICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $flexi=$amount['amount'];
        $flexi1 +=$flexi;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INTELLICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $intel=$amount['amount'];
        $intel1 +=$intel;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MEDOCARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $medocare=$amount['amount'];
        $medocare1 +=$medocare;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MAXICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $maxi=$amount['amount'];
        $maxi1 +=$maxi;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MCL' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $mcl=$amount['amount'];
        $mcl1 +=$mcl;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MEDICARD' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $mcard=$amount['amount'];
        $mcard1 +=$mcard;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PHILCARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $pcare=$amount['amount'];
        $pcare1 +=$pcare;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='VALUE CARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $vcare=$amount['amount'];
        $vcare1 +=$vcare;
        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PACIFIC CROSS' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $pcross=$amount['amount'];
        $pcross1 +=$pcross;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INSULAR HEALTHCARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $insu=$amount['amount'];
        $insu1 +=$insu;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='GENERALI' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $generali=$amount['amount'];
        $generali1 +=$generali;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PGI CARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $pgicare=$amount['amount'];
        $pgicare1 +=$pgicare;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='EAST WEST' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $eastwest=$amount['amount'];
        $eastwest1 +=$eastwest;        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR DSWD' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $dswd=$amount['amount'];
        $dswd1 +=$dswd;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE (accttitle='AR LGU KIDAPAWAN' OR accttitle='A/R LGU KIDAPAWAN' OR accttitle='AR LGU-KIDAPAWAN') AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $lgukid=$amount['amount'];
        $lgukid1 +=$lgukid;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE (accttitle='A/R LGU MAKILALA' OR accttitle='AR LGU MAKILALA' OR accttitle='AR LGU-MAKILALA') AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $lgumak=$amount['amount'];
        $lgumak1 +=$lgumak;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PCSO' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $pcso=$amount['amount'];
        $pcso1 +=$pcso;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='PCSO' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $pcso=$amount['amount'];
        $pcso2 +=$pcso; 

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR COTELCO' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $cotelco=$amount['amount'];
        $cotelco1 +=$cotelco;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='COTELCO' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $cotelco=$amount['amount'];
        $cotelco2 +=$cotelco; 

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PEPSI' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $pepsi=$amount['amount'];
        $pepsi1 +=$pepsi;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PROVINCE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $province=$amount['amount'];
        $province1 +=$province;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $maip=$amount['amount'];
        $maip1 +=$maip;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%TEJADA MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $tejada=$amount['amount'];
        $tejada1 +=$tejada;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%SANTOS MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $santos=$amount['amount'];
        $santos1 +=$santos;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%CAOAGDAN MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $caoagdan=$amount['amount'];
        $caoagdan1 +=$caoagdan;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%PIÑOL MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $pinol=$amount['amount'];
        $pinol1 +=$pinol;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR TRADE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $trade=$amount['amount'];
        $trade1 +=$trade;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle='AR TRADE PF' OR accttitle='AR EMPLOYEE PF' OR accttitle='AR DOCTOR PF' OR accttitle='AR PERSONAL PF') AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $tradepf=$amount['amount'];
        $tradepf1 +=$tradepf;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR EMPLOYEE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $employee=$amount['amount'];
        $employee1 +=$employee;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR DOCTOR' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $doctor=$amount['amount'];
        $doctor1 +=$doctor;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo LIKE '%SSS%' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $sss=$amount['amount'];
        $sss1 +=$sss;

  }
  $credittotal=$coh1+$dep1+$disc1+$arphic1+$arpfphic1+$al1+$avega1+$chealth1+$caritas1+$coco1+$flexi1+$intel1+$maxi1+$mcl1+$mcard1+$pcare1+$vcare1+$pcross1+$dswd1+$lgumak1+$lgukid1+$pcso1+$pepsi1+$province1+$trade1+$tradepf1+$maip1+$insu1+$fortune1+$stanfilco1+$doctor1+$sumifru1+$eastwest1+$generali1+$medcard1+$prudent1+$clinic1+$mplus1+$personal1+$employee1+$office1+$phc1+$catamco1+$tejada1+$mcp1+$makmpc1+$mediatrix1+$pgicare1+$cotelco1+$santos1+$caoagdan1+$pinol1+$pcso2+$medocare1+$cotelco2+$balfour1+$sss1;
}

$medsbeg=0;$labbeg=0;$xraybeg=0;$utzbeg=0;$ecgbeg=0;$eegbeg=0;$ctbeg=0;$echobeg=0;$respibeg=0;$roombeg=0;$supbeg=0;$rtbeg=0;$erfeebeg=0;$admitbeg=0;$nsfeebeg=0;$ordrbeg=0;$oxygenbeg=0;$certbeg=0;$dietbeg=0;$ordrsuppliesbeg=0;
$ptbeg=0;$ambubeg=0;$appfotherbeg=0;$appftradebeg=0;$appfphicbeg=0;$appfdepbg=0;$refund1beg=0;
$meds1beg=0;$lab1beg=0;$xray1beg=0;$utz1beg=0;$ecg1beg=0;$eeg1beg=0;$ct1beg=0;$echo1beg=0;$respi1beg=0;$room1beg=0;$sup1beg=0;$rt1beg=0;$erfee1beg=0;$admit1beg=0;$nsfee1beg=0;$ordr1beg=0;$oxygen1beg=0;$ordrsupplies1beg=0;$cert1beg=0;$diet1beg=0;$pt1beg=0;$ambu1beg=0;$appfother1beg=0;$appftrade1beg=0;$appfphic1beg=0;$appfdep1beg=0;
$totalamount=0;
$totalcreditbeg=0;
if($department=="R-"){
$sqlPatient=$this->General_model->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname FROM admission a LEFT JOIN dischargedtable c ON c.caseno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE c.datearray BETWEEN '$checkdate' AND '$enddate' AND (a.status='discharged' OR a.ward = 'discharged') AND a.caseno LIKE '$department%' AND a.hmo <> 'N/A' GROUP BY a.caseno ORDER BY pp.lastname ASC");
}else if($department=="O-"){
$sqlPatient=$this->General_model->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname FROM admission a LEFT JOIN dischargedtable c ON c.caseno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE c.datearray BETWEEN '$checkdate' AND '$enddate' AND (a.status='discharged' OR a.ward = 'discharged') AND (a.caseno LIKE '$department%' OR a.caseno LIKE 'W-%' OR a.caseno LIKE 'O-%') AND a.hmo <> 'N/A' GROUP BY a.caseno ORDER BY pp.lastname ASC");
}else{
$sqlPatient=$this->General_model->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE CONCAT(c.datearray,' ',c.paymentTime) >= '$datefrom' AND CONCAT(c.datearray,' ',c.paymentTime) < '$datestart' AND a.status='discharged' AND a.caseno LIKE '$department%' AND a.hmo <> 'N/A' AND ((c.accttitle='CASHONHAND' AND (c.type='cash-Visa' OR c.type='card-Visa')) OR (c.accttitle='PROFESSIONAL FEE' AND c.type='card-Visa') OR (((c.accttitle = 'AR TRADE' OR c.accttitle LIKE '%AR TRADE%' OR c.accttitle = 'NO EXCESS' OR c.accttitle LIKE '%AR EMPLOYEE%' OR c.accttitle LIKE '%AR DOCTOR%') AND c.type='pending'))) GROUP BY a.caseno ORDER BY pp.lastname ASC");
}
    if($sqlPatient->num_rows()>0){
      foreach($sqlPatient->result_array() as $patient){
        $caseno =$patient['caseno'];        
        $patientname=$patient['patientname'];        
        
        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='PHARMACY/MEDICINE' AND trantype='charge' AND quantity > 0 AND administration='administered'");
        $amount=$sql->row_array();
        $medsbeg=$amount['amount'];
        $meds1beg +=$medsbeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='LABORATORY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $labbeg=$amount['amount'];
        $lab1beg +=$labbeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='XRAY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $xraybeg=$amount['amount'];
        $xray1beg +=$xraybeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ULTRASOUND' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $utzbeg=$amount['amount'];
        $utz1beg +=$utzbeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ECG' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $ecgbeg=$amount['amount'];
        $ecg1beg +=$ecgbeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='EEG' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $eegbeg=$amount['amount'];
        $eeg1beg +=$eegbeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='CT SCAN' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $ctbeg=$amount['amount'];
        $ct1beg +=$ctbeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='HEARTSTATION' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $echobeg=$amount['amount'];
        $echo1beg +=$echobeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='RESPIRATORY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $respibeg=$amount['amount'];
        $respi1beg +=$respibeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ROOM ACCOMODATION' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $roombeg=$amount['amount'];
        $room1beg +=$roombeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productsubtype='PHARMACY/SUPPLIES' OR productsubtype='MEDICAL SURGICAL SUPPLIES' OR productsubtype='RESPIRATORY SUPPLIES' OR productsubtype='GENERAL SUPPLIES' OR (productsubtype LIKE '%MISCELLANEOUS%' AND (productdesc NOT LIKE '%MINOR ROOM FEE%' AND productdesc NOT LIKE '%RT FEE%')) OR productsubtype LIKE '%MEDICAL EQUIPMENT%' OR productsubtype='LINENS' OR productsubtype='MEDICAL SUPPLIES' OR (productsubtype='NURSING CHARGES' AND productdesc NOT LIKE '%OSTHEORIZED FEEDING%') OR productsubtype='NURSING-CHARGES' OR productsubtype='OR-CHARGES' OR (productsubtype='NURSING SERVICE FEE' AND productdesc='OR PACK') OR productsubtype='OR/DR SUPPLIES' or productsubtype='RT ON CALL' OR productsubtype='RT REFERRAL' OR (productsubtype='OR/DR/ER FEE' AND productdesc LIKE '%ARMY NAVY%')) AND productdesc NOT LIKE '%DEATH CERTIFICATE%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $supbeg=$amount['amount'];
        $sup1beg +=$supbeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND ( productdesc LIKE '%RT FEE%' ) AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $rtbeg=$amount['amount'];
        $rt1beg +=$rtbeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ER FEE' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $erfeebeg=$amount['amount'];
        $erfee1beg +=$erfeebeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ADMISSION FEE' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $admitbeg=$amount['amount'];
        $admit1beg +=$admitbeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%NURSING SERVICE FEE%' AND productdesc NOT LIKE '%OR PACK%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $nsfeebeg=$amount['amount'];
        $nsfee1beg +=$nsfeebeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productsubtype='OR/DR/ER FEE' OR (productsubtype LIKE '%MISCELLANEOUS%' AND productdesc LIKE '%MINOR ROOM FEE%')) AND productdesc NOT LIKE '%OR SERVICE FEE%' AND productdesc NOT LIKE '%DR SERVICE FEE%' AND productdesc NOT LIKE '%ARMY NAVY%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ordrbeg=$amount['amount'];
        $ordr1beg +=$ordrbeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productsubtype='OR/DR/ER FEE' OR productsubtype='OR-CHARGES') AND (productdesc LIKE '%OR SERVICE FEE%' OR productdesc LIKE '%DR SERVICE FEE%') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ordrsuppliesbeg=$amount['amount'];
        $ordrsupplies1beg += $ordrsuppliesbeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='OXYGEN SUPPLIES' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $oxygenbeg=$amount['amount'];
        $oxygen1beg +=$oxygenbeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='MISCELLANEOUS' AND (productdesc='DEATH CERTIFICATE' OR productdesc='LAB 2ND COPY') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $certbeg=$amount['amount'];
        $cert1beg +=$certbeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productsubtype='DIETARY' OR productsubtype='DIETARY COUNSELING INCOME' OR productsubtype='OTHER FEES' OR productdesc LIKE '%OSTHEORIZED FEEDING%') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $dietbeg=$amount['amount'];
        $diet1beg +=$dietbeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='PHYSICAL THERAPY' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ptbeg=$amount['amount'];
        $pt1beg +=$ptbeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='AMBULANCE INCOME' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ambubeg=$amount['amount'];
        $ambu1beg +=$ambubeg;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle LIKE '%APPF OTHERS%' OR (accttitle='PROFESSIONAL FEE' AND `type`='card-Visa'))");
        $amount=$sql->row_array();
        $appfotherbeg=$amount['amount'];
        $appfother1beg +=$appfotherbeg;        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle='AR TRADE PF' OR accttitle='AR EMPLOYEE PF' OR accttitle='AR DOCTOR PF' OR accttitle='AR PERSONAL PF')");
        $amount=$sql->row_array();
        $appftradebeg=$amount['amount'];
        $appftrade1beg +=$appftradebeg;

         $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='OTHER INCOME' AND trantype='charge' AND quantity > 0");
         $amount=$sql->row_array();
         $appfphicbeg=$amount['amount'];
         $appfphic1beg +=$appfphicbeg;

        //  $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND accttitle LIKE '%REFUND%' AND `type`='pending'");
        // $amount=$sql->row_array();
        // $refund=$amount['amount'];
        // $refund1beg +=$refund;

        $sql=$this->General_model->db->query("SELECT SUM(excess) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $excessbeg=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle LIKE '%PATIENTS DEPOSIT%' OR accttitle LIKE '%FOR REFUND%')");
        $amount=$sql->row_array();
        $depositbeg=$amount['amount'];

        $dep=$excessbeg-$depositbeg;

        if($dep<0){
          $appfdepbeg=abs($dep);
        }else{
          $appfdepbeg=0;
        }
        $appfdep1beg +=$appfdepbeg;      

  }
  if($rundate==$checkdate){
    $meds1beg=0;$lab1beg=0;$xray1beg=0;$utz1beg=0;$ecg1beg=0;$eeg1beg=0;$ct1beg=0;$echo1beg=0;$respi1beg=0;$room1beg=0;$sup1beg=0;$rt1beg=0;$erfee1beg=0;$admit1beg=0;$nsfee1beg=0;$ordr1beg=0;$oxygen1beg=0;$$mammo1beg=0;$biop1beg=0;$audio1beg=0;
    $cert1beg=0;$diet1beg=0;$pt1beg=0;$ambu1beg=0;$appfother1beg=0;$appftrade1beg=0;$appfphic1beg=0;$appfdep1beg=0;$refund1beg=0;
  }

  $totalcreditbeg=$meds1beg+$lab1beg+$xray1beg+$utz1beg+$ecg1beg+$eeg1beg+$ct1beg+$echo1beg+$respi1beg+$room1beg+$sup1beg+$rt1beg+$erfee1beg+$admit1beg+$nsfee1beg+$ordr1beg+$oxygen1beg+$cert1beg+$diet1beg+$pt1beg+$ambu1beg+$appfother1beg+$appftrade1beg+$appfphic1beg+$appfdep1beg+$ordrsupplies1beg+$refund1beg+$mammo1beg+$audio1beg+$biop1beg;
}

$meds=0;$lab=0;$xray=0;$utz=0;$ecg=0;$eeg=0;$ct=0;$echo=0;$respi=0;$room=0;$sup=0;$rt=0;$erfee=0;$admit=0;$nsfee=0;$ordr=0;$oxygen=0;$cert=0;$diet=0;
$pt=0;$ambu=0;$appfother=0;$appftrade=0;$appfphic=0;$appfdep=0;$ordrsupplies=0;$refund1=0;
$meds1=0;$lab1=0;$xray1=0;$utz1=0;$ecg1=0;$eeg1=0;$ct1=0;$echo1=0;$respi1=0;$room1=0;$sup1=0;$rt1=0;$erfee1=0;$admit1=0;$nsfee1=0;$ordr1=0;$oxygen1=0;$cert1=0;$diet1=0;
$pt1=0;$ambu1=0;$appfother1=0;$appftrade1=0;$appfphic1=0;$appfdep1=0;$ordrsupplies1=0;
$totalamount=0;
$totalcredit=0;
if($department=="R-"){
$sqlPatient=$this->General_model->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname FROM admission a LEFT JOIN dischargedtable c ON c.caseno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE (c.datearray = '$rundate') AND (a.status='discharged' OR a.ward = 'discharged') AND a.caseno LIKE '$department%' AND a.hmo <> 'N/A' GROUP BY a.caseno ORDER BY pp.lastname ASC");
}else if($department=="O-"){
$sqlPatient=$this->General_model->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname FROM admission a LEFT JOIN dischargedtable c ON c.caseno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE (c.datearray = '$rundate') AND (a.status='discharged' OR a.ward = 'discharged') AND (a.caseno LIKE '$department%' OR a.caseno LIKE 'W-%' OR a.caseno LIKE 'O-%') AND a.hmo <> 'N/A' GROUP BY a.caseno ORDER BY pp.lastname ASC");
}else{
$sqlPatient=$this->General_model->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE ((c.datearray = '$startdate' AND c.paymentTime >= '23:00:00') OR (c.datearray = '$enddate' AND c.paymentTime <= '23:00:00')) AND a.status='discharged' AND a.caseno LIKE '$department%' AND a.hmo <> 'N/A' AND ((c.accttitle='CASHONHAND' AND (c.type='cash-Visa' OR c.type='card-Visa')) OR (c.accttitle='PROFESSIONAL FEE' AND c.type='card-Visa') OR (((c.accttitle = 'AR TRADE' OR c.accttitle LIKE '%AR TRADE%' OR c.accttitle = 'NO EXCESS' OR c.accttitle LIKE '%AR EMPLOYEE%' OR c.accttitle LIKE '%AR DOCTOR%') AND c.type='pending'))) GROUP BY a.caseno ORDER BY pp.lastname ASC");
}
    if($sqlPatient->num_rows()>0){
      foreach($sqlPatient->result_array() as $patient){
        $caseno =$patient['caseno'];        
        $patientname=$patient['patientname'];        

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='PHARMACY/MEDICINE' AND trantype='charge' AND quantity > 0 AND administration='administered'");
        $amount=$sql->row_array();
        $meds=$amount['amount'];
        $meds1 +=$meds;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='LABORATORY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $lab=$amount['amount'];
        $lab1 +=$lab;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='XRAY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $xray=$amount['amount'];
        $xray1 +=$xray;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ULTRASOUND' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $utz=$amount['amount'];
        $utz1 +=$utz;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ECG' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $ecg=$amount['amount'];
        $ecg1 +=$ecg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='EEG' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $eeg=$amount['amount'];
        $eeg1 +=$eeg;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='CT SCAN' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $ct=$amount['amount'];
        $ct1 +=$ct;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='HEARTSTATION' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $echo=$amount['amount'];
        $echo1 +=$echo;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='RESPIRATORY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $respi=$amount['amount'];
        $respi1 +=$respi;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ROOM ACCOMODATION' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $room=$amount['amount'];
        $room1 +=$room;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productsubtype='PHARMACY/SUPPLIES' OR productsubtype='MEDICAL SURGICAL SUPPLIES' OR productsubtype='RESPIRATORY SUPPLIES' OR productsubtype='GENERAL SUPPLIES' OR (productsubtype LIKE '%MISCELLANEOUS%' AND (productdesc NOT LIKE '%MINOR ROOM FEE%' AND productdesc NOT LIKE '%RT FEE%')) OR productsubtype LIKE '%MEDICAL EQUIPMENT%' OR productsubtype='LINENS' OR productsubtype='MEDICAL SUPPLIES' OR (productsubtype='NURSING CHARGES' AND productdesc NOT LIKE '%OSTHEORIZED FEEDING%') OR productsubtype='NURSING-CHARGES' OR productsubtype='OR-CHARGES' OR (productsubtype='NURSING SERVICE FEE' AND productdesc='OR PACK') OR productsubtype='OR/DR SUPPLIES' or productsubtype='RT ON CALL' OR productsubtype='RT REFERRAL' OR (productsubtype='OR/DR/ER FEE' AND productdesc LIKE '%ARMY NAVY%')) AND productdesc NOT LIKE '%DEATH CERTIFICATE%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $sup=$amount['amount'];
        $sup1 +=$sup;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND ( productdesc LIKE '%RT FEE%' ) AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $rt=$amount['amount'];
        $rt1 +=$rt;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ER FEE' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $erfee=$amount['amount'];
        $erfee1 +=$erfee;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='ADMISSION FEE' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $admit=$amount['amount'];
        $admit1 +=$admit;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%NURSING SERVICE FEE%' AND productdesc NOT LIKE '%OR PACK%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $nsfee=$amount['amount'];
        $nsfee1 +=$nsfee;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productsubtype='OR/DR/ER FEE' OR (productsubtype LIKE '%MISCELLANEOUS%' AND productdesc LIKE '%MINOR ROOM FEE%')) AND productdesc NOT LIKE '%OR SERVICE FEE%' AND productdesc NOT LIKE '%DR SERVICE FEE%' AND productdesc NOT LIKE '%ARMY NAVY%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ordr=$amount['amount'];
        $ordr1 +=$ordr;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productsubtype='OR/DR/ER FEE' OR productsubtype='OR-CHARGES') AND (productdesc LIKE '%OR SERVICE FEE%' OR productdesc LIKE '%DR SERVICE FEE%') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ordrsupplies=$amount['amount'];
        $ordrsupplies1 += $ordrsupplies;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='OXYGEN SUPPLIES' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $oxygen=$amount['amount'];
        $oxygen1 +=$oxygen;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='MISCELLANEOUS' AND (productdesc='DEATH CERTIFICATE' OR productdesc='LAB 2ND COPY') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $cert=$amount['amount'];
        $cert1 +=$cert;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND (productsubtype='DIETARY' OR productsubtype='DIETARY COUNSELING INCOME' OR productsubtype='OTHER FEES' OR productdesc LIKE '%OSTHEORIZED FEEDING%') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $diet=$amount['amount'];
        $diet1 +=$diet;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='PHYSICAL THERAPY' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $pt=$amount['amount'];
        $pt1 +=$pt;

        $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='AMBULANCE INCOME' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ambu=$amount['amount'];
        $ambu1 +=$ambu;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle LIKE '%APPF OTHERS%' OR (accttitle='PROFESSIONAL FEE' AND `type`='card-Visa'))");
        $amount=$sql->row_array();
        $appfother=$amount['amount'];
        $appfother1 +=$appfother;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle='AR TRADE PF' OR accttitle='AR EMPLOYEE PF' OR accttitle='AR DOCTOR PF' OR accttitle='AR PERSONAL PF')");
        $amount=$sql->row_array();
        $appftrade=$amount['amount'];
        $appftrade1 +=$appftrade;

         $sql=$this->General_model->db->query("SELECT SUM(sellingprice*quantity) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='OTHER INCOME' AND trantype='charge' AND quantity > 0");
         $amount=$sql->row_array();
         $appfphic=$amount['amount'];
         $appfphic1 +=$appfphic;

        //  $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND accttitle LIKE '%REFUND%' AND `type`='pending'");
        // $amount=$sql->row_array();
        // $refund=$amount['amount'];
        // $refund1 +=$refund;

        $sql=$this->General_model->db->query("SELECT SUM(excess) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $excess=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle LIKE '%PATIENTS DEPOSIT%' OR accttitle LIKE '%FOR REFUND%')");
        $amount=$sql->row_array();
        $deposit=$amount['amount'];

        $dep=$excess-$deposit;

        if($dep<0){
          $appfdep=abs($dep);
        }else{
          $appfdep=0;
        }
        $appfdep1 +=$appfdep;      

  }
  $totalcredit=$meds1+$lab1+$xray1+$utz1+$ecg1+$eeg1+$ct1+$echo1+$respi1+$room1+$sup1+$rt1+$erfee1+$admit1+$nsfee1+$ordr1+$oxygen1+$cert1+$diet1+$pt1+$ambu1+$appfother1+$appftrade1+$appfphic1+$appfdep1+$ordrsupplies1+$refund1;
}
 ?>

  <div class="page">    
    <table width="100%" border="0" style="font-size:12px;">        
        <tr>
            <td width="40%">CASH ON HAND</td>
            <td align="right" width="20%"><?=number_format($coh1beg,2);?></td>
            <td align="right" width="20%"><?=number_format($coh1,2);?></td>
            <td align="right" width="20%"><?=number_format($coh1beg+$coh1,2);?></td>
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
        if($insu1beg > 0 || $insu1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - INSULAR</td>
            <td align="right"><?=number_format($insu1beg,2);?></td>
            <td align="right"><?=number_format($insu1,2);?></td>
            <td align="right"><?=number_format($insu1beg+$insu1,2);?></td>
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
            <td align="right"><?=number_format($eastwest1+$eastwest1beg,2);?></td>
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
        if($medocare1beg > 0 || $medocare1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - MEDOCARE</td>
            <td align="right"><?=number_format($medocare1beg,2);?></td>
            <td align="right"><?=number_format($medocare1,2);?></td>
            <td align="right"><?=number_format($medocare1beg+$medocare1,2);?></td>
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
        if($pcso1beg+$pcso2beg > 0 || $pcso1+$pcso2 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - PCSO</td>
            <td align="right"><?=number_format($pcso1beg+$pcso2beg,2);?></td>
            <td align="right"><?=number_format($pcso1+$pcso2,2);?></td>
            <td align="right"><?=number_format($pcso1beg+$pcso1+$pcso2beg+$pcso2,2);?></td>
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
        if($sss1beg > 0 || $sss1 > 0){
        ?>
        <tr>
            <td>ACCOUNTS RECEIVABLE - SSS</td>
            <td align="right"><?=number_format($sss1beg,2);?></td>
            <td align="right"><?=number_format($sss1,2);?></td>
            <td align="right"><?=number_format($sss1beg+$sss1,2);?></td>
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
        if($refund1beg > 0 || $refund1 > 0){
        ?>
        <tr>
            <td>FOR REFUND</td>
            <td align="right"><?=number_format($refund1beg,2);?></td>
            <td align="right"><?=number_format($refund1,2);?></td>
            <td align="right"><?=number_format($refund1beg+$refund1,2);?></td>
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
  </div>
  