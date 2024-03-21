<?php
$date2=date('F d, Y',strtotime('-1 day',strtotime($rundate)));
$date1=date('F d, Y',strtotime('-2 day',strtotime($rundate)));
    if($button=="1"){
        ?>
        <br>
    <button onclick="tableToExcel('printThis','Discharged_Summary_Debit')">EXPORT CREDIT</button>
    <?php
    }
    ?>
    <?php
    if($type=="WCOH"){
        $st="WITH COH";
    }else{
        $st="WITHOUT COH";
    }
    if($department=="I-"){
        $dpt="IPD";
    }else if($department=="O-"){
        $dpt="OPD";
    }else{
        $dpt="HMO";
    }
    ?>
    <div id="printThis">
    <h4 style="margin-left:90px;">DAILY DISCHARGED REPORT (CREDIT) - <?=$st;?> (<b><?=$dpt;?></b>)<br><?=$date1;?> 11:00 PM to <?=$date2;?> 11:00 PM</h4>
	<table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse: collapse; font-size: 11px;">
		<?php
        $totalamountDebit=0;
		$meds1=0;$lab1=0;$xray1=0;$utz1=0;$ecg1=0;$eeg1=0;$ct1=0;$echo1=0;$respi1=0;$room1=0;$sup1=0;$rt1=0;$erfee1=0;$admit1=0;$nsfee1=0;$ordr1=0;$oxygen1=0;$cert1=0;$diet1=0;
        $pt1=0;$ambu1=0;$appfother1=0;$appftrade1=0;$appfphic1=0;$appfdep1=0;$ordrsup1=0;$refund1=0;
        $totalamount=0;
        $credittotal=0;
	    $coh1=0;
        if($dpt=="OPD"){
            $qry="SUM(sellingprice*quantity) AS amount";
        }else{
            $qry="SUM(sellingprice*quantity) AS amount";
        }
	    foreach($body as $item){
	    	$caseno=$item['caseno'];
	    	$patientname=$item['patientname'];
	    	$sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='PHARMACY/MEDICINE' AND trantype='charge' AND quantity > 0 AND administration='administered'");
        $amount=$sql->row_array();
        $meds=$amount['amount'];
        $meds1 +=$meds;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='LABORATORY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $lab=$amount['amount'];
        $lab1 +=$lab;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='XRAY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $xray=$amount['amount'];
        $xray1 +=$xray;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ULTRASOUND' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $utz=$amount['amount'];
        $utz1 +=$utz;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ECG' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $ecg=$amount['amount'];
        $ecg1 +=$ecg;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='EEG' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $eeg=$amount['amount'];
        $eeg1 +=$eeg;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='CT SCAN' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $ct=$amount['amount'];
        $ct1 +=$ct;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='HEARTSTATION' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $echo=$amount['amount'];
        $echo1 +=$echo;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='RESPIRATORY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $respi=$amount['amount'];
        $respi1 +=$respi;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ROOM ACCOMODATION' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $room=$amount['amount'];
        $room1 +=$room;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='PHARMACY/SUPPLIES' OR productsubtype='MEDICAL SURGICAL SUPPLIES' OR productsubtype='RESPIRATORY SUPPLIES' OR productsubtype='GENERAL SUPPLIES' OR (productsubtype LIKE '%MISCELLANEOUS%' AND (productdesc NOT LIKE '%MINOR ROOM FEE%' AND productdesc NOT LIKE '%RT FEE%')) OR productsubtype LIKE '%MEDICAL EQUIPMENT%' OR productsubtype='LINENS' OR productsubtype='MEDICAL SUPPLIES' OR (productsubtype='NURSING CHARGES' AND productdesc NOT LIKE '%OSTHEORIZED FEEDING%') OR productsubtype='NURSING-CHARGES' OR productsubtype='OR-CHARGES' OR (productsubtype='NURSING SERVICE FEE' AND productdesc='OR PACK') OR productsubtype='OR/DR SUPPLIES' OR productsubtype='RT ON CALL' OR productsubtype='RT REFERRAL' OR (productsubtype='OR/DR/ER FEE' AND productdesc LIKE '%ARMY NAVY%')) AND productdesc NOT LIKE '%DEATH CERTIFICATE%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $sup=$amount['amount'];
        $sup1 +=$sup;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productdesc LIKE '%RT FEE%') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $rt=$amount['amount'];
        $rt1 +=$rt;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ER FEE' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $erfee=$amount['amount'];
        $erfee1 +=$erfee;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ADMISSION FEE' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $admit=$amount['amount'];
        $admit1 +=$admit;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%NURSING SERVICE FEE%' AND productdesc NOT LIKE '%OR PACK%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $nsfee=$amount['amount'];
        $nsfee1 +=$nsfee;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='OR/DR/ER FEE' OR (productsubtype LIKE '%MISCELLANEOUS%' AND (productdesc LIKE '%MINOR ROOM FEE%' OR productdesc LIKE '%DELIVERY ROOM%'))) AND productdesc NOT LIKE '%OR SERVICE FEE%' AND productdesc NOT LIKE '%DR SERVICE FEE%' AND productdesc NOT LIKE '%ARMY NAVY%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ordr=$amount['amount'];
        $ordr1 +=$ordr;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='OR/DR/ER FEE' OR productsubtype='OR-CHARGES') AND (productdesc LIKE '%OR SERVICE FEE%' OR productdesc LIKE '%DR SERVICE FEE%') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ordrsup=$amount['amount'];
        $ordrsup1 += $ordrsup;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='OXYGEN SUPPLIES' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $oxygen=$amount['amount'];
        $oxygen1 +=$oxygen;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='MISCELLANEOUS' AND (productdesc='DEATH CERTIFICATE' OR productdesc='LAB 2ND COPY') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $cert=$amount['amount'];
        $cert1 +=$cert;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='DIETARY' OR productsubtype='DIETARY COUNSELING INCOME' OR productsubtype='OTHER FEES' OR productdesc LIKE '%OSTHEORIZED FEEDING%') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $diet=$amount['amount'];
        $diet1 +=$diet;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='PHYSICAL THERAPY' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $pt=$amount['amount'];
        $pt1 +=$pt;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='AMBULANCE INCOME' AND trantype='charge' AND quantity > 0");
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

         $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='OTHER INCOME' AND trantype='charge' AND quantity > 0");
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

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle LIKE '%AP PATIENT DEPOSIT%'  OR accttitle LIKE '%FOR REFUND%')");
        $amount=$sql->row_array();
        $deposit=$amount['amount'];

        $dep=$excess-$deposit;

        if($dep<0){
          $appfdep=abs($dep);
        }else{
          $appfdep=0;
        }        
        $appfdep1 +=$deposit;      
	    }
        if(count($body1) > 0){
            foreach($body1 as $item){
            $caseno=$item['caseno'];
            $patientname=$item['lastname'].", ".$item['firstname']." ".$item['middlename'];
            $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='PHARMACY/MEDICINE' AND trantype='charge' AND quantity > 0 AND administration='administered'");
        $amount=$sql->row_array();
        $meds=$amount['amount'];
        $meds1 +=$meds;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='LABORATORY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $lab=$amount['amount'];
        $lab1 +=$lab;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='XRAY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $xray=$amount['amount'];
        $xray1 +=$xray;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ULTRASOUND' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $utz=$amount['amount'];
        $utz1 +=$utz;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ECG' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $ecg=$amount['amount'];
        $ecg1 +=$ecg;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='EEG' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $eeg=$amount['amount'];
        $eeg1 +=$eeg;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='CT SCAN' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $ct=$amount['amount'];
        $ct1 +=$ct;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='HEARTSTATION' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $echo=$amount['amount'];
        $echo1 +=$echo;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='RESPIRATORY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $respi=$amount['amount'];
        $respi1 +=$respi;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ROOM ACCOMODATION' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $room=$amount['amount'];
        $room1 +=$room;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='PHARMACY/SUPPLIES' OR productsubtype='MEDICAL SURGICAL SUPPLIES' OR productsubtype='RESPIRATORY SUPPLIES' OR productsubtype='GENERAL SUPPLIES' OR (productsubtype LIKE '%MISCELLANEOUS%' AND (productdesc NOT LIKE '%MINOR ROOM FEE%' AND productdesc NOT LIKE '%RT FEE%')) OR productsubtype LIKE '%MEDICAL EQUIPMENT%' OR productsubtype='LINENS' OR productsubtype='MEDICAL SUPPLIES' OR (productsubtype='NURSING CHARGES' AND productdesc NOT LIKE '%OSTHEORIZED FEEDING%') OR productsubtype='NURSING-CHARGES' OR productsubtype='OR-CHARGES' OR (productsubtype='NURSING SERVICE FEE' AND productdesc='OR PACK') OR productsubtype='OR/DR SUPPLIES' OR productsubtype='RT ON CALL' OR productsubtype='RT REFERRAL' OR (productsubtype='OR/DR/ER FEE' AND productdesc LIKE '%ARMY NAVY%')) AND productdesc NOT LIKE '%DEATH CERTIFICATE%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $sup=$amount['amount'];
        $sup1 +=$sup;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productdesc LIKE '%RT FEE%') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $rt=$amount['amount'];
        $rt1 +=$rt;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ER FEE' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $erfee=$amount['amount'];
        $erfee1 +=$erfee;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ADMISSION FEE' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $admit=$amount['amount'];
        $admit1 +=$admit;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%NURSING SERVICE FEE%' AND productdesc NOT LIKE '%OR PACK%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $nsfee=$amount['amount'];
        $nsfee1 +=$nsfee;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='OR/DR/ER FEE' OR (productsubtype LIKE '%MISCELLANEOUS%' AND (productdesc LIKE '%MINOR ROOM FEE%' OR productdesc LIKE '%DELIVERY ROOM%'))) AND productdesc NOT LIKE '%OR SERVICE FEE%' AND productdesc NOT LIKE '%DR SERVICE FEE%' AND productdesc NOT LIKE '%ARMY NAVY%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ordr=$amount['amount'];
        $ordr1 +=$ordr;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='OR/DR/ER FEE' OR productsubtype='OR-CHARGES') AND (productdesc LIKE '%OR SERVICE FEE%' OR productdesc LIKE '%DR SERVICE FEE%') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ordrsup=$amount['amount'];
        $ordrsup1 += $ordrsup;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='OXYGEN SUPPLIES' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $oxygen=$amount['amount'];
        $oxygen1 +=$oxygen;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='MISCELLANEOUS' AND (productdesc='DEATH CERTIFICATE' OR productdesc='LAB 2ND COPY') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $cert=$amount['amount'];
        $cert1 +=$cert;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='DIETARY' OR productsubtype='DIETARY COUNSELING INCOME' OR productsubtype='OTHER FEES' OR productdesc LIKE '%OSTHEORIZED FEEDING%') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $diet=$amount['amount'];
        $diet1 +=$diet;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='PHYSICAL THERAPY' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $pt=$amount['amount'];
        $pt1 +=$pt;

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='AMBULANCE INCOME' AND trantype='charge' AND quantity > 0");
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

         $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='OTHER INCOME' AND trantype='charge' AND quantity > 0");
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

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle LIKE '%AP PATIENT DEPOSIT%'  OR accttitle LIKE '%FOR REFUND%')");
        $amount=$sql->row_array();
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
	    //$credittotal=$meds1+$lab1+$xray1+$utz1+$ecg1+$eeg1+$ct1+$echo1+$respi1+$room1+$sup1+$rt1+$erfee1+$admit1+$nsfee1+$ordr1+$oxygen1+$cert1+$diet1+$pt1+$ambu1+$appfother1+$appftrade1+$appfphic1+$appfdep1+$ordrsup1;
	    echo "<tr>";
echo "<td width='3%' class='font11'>NO.</td>";
echo "<td align='center' class='font11' width='20%'>PATIENT NAME</td>";
if($meds1>0){echo "<td align='center' class='font10' width='6%'>MEDS</td>";}
if($lab1>0){echo "<td align='center' class='font10' width='6%'>LAB</td>";}
if($xray1>0){echo "<td align='center' class='font10' width='6%'>XRAY</td>";}
if($utz1>0){echo "<td align='center' class='font10' width='6%'>UTZ</td>";}
if($ecg1>0){echo "<td align='center' class='font10' width='6%'>ECG</td>";}
if($eeg1>0){echo "<td align='center' class='font10' width='6%'>EEG</td>";}
if($ct1>0){echo "<td align='center' class='font10' width='6%'>CT SCAN</td>";}
if($echo1>0){echo "<td align='center' class='font10' width='6%'>2D ECHO</td>";}
if($respi1>0){echo "<td align='center' class='font10' width='6%'>RESPI</td>";}
if($room1>0){echo "<td align='center' class='font10' width='6%'>ROOM</td>";}
if($sup1>0){echo "<td align='center' class='font10' width='6%'>MED. SUP</td>";}
if($rt1>0){echo "<td align='center' class='font10' width='6%'>RT</td>";}
if($erfee1>0){echo "<td align='center' class='font10' width='6%'>ER FEE</td>";}
if($admit1>0){echo "<td align='center' class='font10' width='6%'>ADMIT</td>";}
if($nsfee1>0){echo "<td align='center' class='font10' width='6%'>NS FEE</td>";}
if($ordr1>0){echo "<td align='center' class='font10' width='6%'>OR/DR FEE</td>";}
if($ordrsup1>0){echo "<td align='center' class='font10' width='6%'>OR/DR SUPP</td>";}
if($oxygen1>0){echo "<td align='center' class='font10' width='6%'>OXYGEN</td>";}
if($cert1>0){echo "<td align='center' class='font10' width='6%'>CERT</td>";}
if($diet1>0){echo "<td align='center' class='font10' width='6%'>DIETARY</td>";}
if($pt1>0){echo "<td align='center' class='font10' width='6%'>PT</td>";}
if($ambu1>0){echo "<td align='center' class='font10' width='6%'>AMBU</td>";}
if($appfother1>0){echo "<td align='center' class='font10' width='6%'>APPF OT</td>";}
if($appftrade1>0){echo "<td align='center' class='font10' width='6%'>APPF TR</td>";}
if($appfdep1>0){echo "<td align='center' class='font10' width='6%'>APPT DEP</td>";}
if($appfphic1>0){echo "<td align='center' class='font10' width='6%'>OTHE INCOME</td>";}
//if($refund1>0){echo "<td align='center' class='font10' width='6%'>REFUND</td>";}
echo "<td align='center' class='font10'>TOTAL</td>";
echo "</tr>";
  $x=1;
  $color="";
  $meds2=0;$lab2=0;$xray2=0;$utz2=0;$ecg2=0;$eeg2=0;$ct2=0;$echo2=0;$respi2=0;$room2=0;$sup2=0;$rt2=0;$erfee2=0;$admit2=0;$nsfee2=0;$ordr2=0;$oxygen2=0;$cert2=0;$diet2=0;
        $pt2=0;$ambu2=0;$appfother2=0;$appftrade2=0;$appfphic2=0;$appfdep2=0;$ordrsup2=0;$refund2=0;
foreach($body as $item){
	    	$caseno=$item['caseno'];
	    	$patientname=$item['patientname'];
            $coh=$item['amount'];           
            if($type <> "WCOH"){
                $checkCOH=$this->General_model->checkCOH($caseno);
                $coh=$checkCOH['amount'];               
            }
	    	$sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='PHARMACY/MEDICINE' AND trantype='charge' AND quantity > 0 AND administration='administered'");
        $amount=$sql->row_array();
        $meds=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='LABORATORY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $lab=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='XRAY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $xray=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ULTRASOUND' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $utz=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ECG' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $ecg=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='EEG' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $eeg=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='CT SCAN' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $ct=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='HEARTSTATION' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $echo=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='RESPIRATORY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $respi=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ROOM ACCOMODATION' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $room=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='PHARMACY/SUPPLIES' OR productsubtype='MEDICAL SURGICAL SUPPLIES' OR productsubtype='RESPIRATORY SUPPLIES' OR productsubtype='GENERAL SUPPLIES' OR (productsubtype LIKE '%MISCELLANEOUS%' AND (productdesc NOT LIKE '%MINOR ROOM FEE%' AND productdesc NOT LIKE '%RT FEE%')) OR productsubtype LIKE '%MEDICAL EQUIPMENT%' OR productsubtype='LINENS' OR productsubtype='MEDICAL SUPPLIES' OR (productsubtype='NURSING CHARGES' AND productdesc NOT LIKE '%OSTHEORIZED FEEDING%') OR productsubtype='NURSING-CHARGES' OR productsubtype='OR-CHARGES' OR (productsubtype='NURSING SERVICE FEE' AND productdesc='OR PACK') OR productsubtype='OR/DR SUPPLIES' OR productsubtype='RT ON CALL' OR productsubtype='RT REFERRAL' OR (productsubtype='OR/DR/ER FEE' AND productdesc LIKE '%ARMY NAVY%')) AND productdesc NOT LIKE '%DEATH CERTIFICATE%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $sup=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productdesc LIKE '%RT FEE%') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $rt=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ER FEE' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $erfee=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ADMISSION FEE' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $admit=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%NURSING SERVICE FEE%' AND productdesc NOT LIKE '%OR PACK%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $nsfee=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='OR/DR/ER FEE' OR (productsubtype LIKE '%MISCELLANEOUS%' AND productdesc LIKE '%MINOR ROOM FEE%')) AND productdesc NOT LIKE '%OR SERVICE FEE%' AND productdesc NOT LIKE '%DR SERVICE FEE%' AND productdesc NOT LIKE '%ARMY NAVY%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ordr=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='OR/DR/ER FEE' OR productsubtype='OR-CHARGES') AND (productdesc LIKE '%OR SERVICE FEE%' OR productdesc LIKE '%DR SERVICE FEE%') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ordrsup=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='OXYGEN SUPPLIES' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $oxygen=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='MISCELLANEOUS' AND (productdesc='DEATH CERTIFICATE' OR productdesc='LAB 2ND COPY') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $cert=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='DIETARY' OR productsubtype='DIETARY COUNSELING INCOME' OR productsubtype='OTHER FEES' OR productdesc LIKE '%OSTHEORIZED FEEDING%') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $diet=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='PHYSICAL THERAPY' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $pt=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='AMBULANCE INCOME' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ambu=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle LIKE '%APPF OTHERS%' OR (accttitle='PROFESSIONAL FEE' AND `type`='card-Visa'))");
        $amount=$sql->row_array();
        $appfother=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle='AR TRADE PF' OR accttitle='AR EMPLOYEE PF' OR accttitle='AR DOCTOR PF' OR accttitle='AR PERSONAL PF')");
        $amount=$sql->row_array();
        $appftrade=$amount['amount'];        

         $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='OTHER INCOME' AND trantype='charge' AND quantity > 0");
         $amount=$sql->row_array();
         $appfphic=$amount['amount'];
         
        //  $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND accttitle LIKE '%REFUND%' AND `type`='pending'");
        // $amount=$sql->row_array();
        // $refund=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(excess) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $excess=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle LIKE '%AP PATIENT DEPOSIT%' OR accttitle LIKE '%FOR REFUND%')");
        $amount=$sql->row_array();
        $deposit=$amount['amount'];

        // $dep=$excess-$deposit;

        // if($dep<0){
        //   $appfdep=abs($dep);
        // }else{
        //   $appfdep=0;
        // }
$appfdep=$deposit;
        




        //============================================================Debit Check==================================================
        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='PATIENTS DEPOSIT' AND acctno='$caseno' AND `type` <> 'pending'");
        $amount=$sql->row_array();
        $dep12=$amount['amount'];        
        

        $sql=$this->General_model->db->query("SELECT SUM(adjustment) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype NOT LIKE '%PROFESSIONAL FEE%' AND quantity > 0");
        $amount=$sql->row_array();
        $disc=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(amount) as amount FROM acctgenledge WHERE caseno='$caseno' AND acctitle='DISCOUNT' GROUP BY acctitle");
        if($sql->num_rows()>0){
            $result=$sql->row_array();
            $disc += $result['amount'];
        }
        

        $sql=$this->General_model->db->query("SELECT SUM(phic+phic1) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $arphic=$amount['amount'];
        

        // $sql=$this->General_model->db->query("SELECT SUM(phic+phic1) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='PROFESSIONAL FEE' AND trantype='charge' AND quantity > 0 AND producttype NOT LIKE '%IPD admitting%'");
        // $amount=$sql->row_array();
        // $arpfphic=$amount['amount'];
        // $arpfphic1 +=$arpfphic;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='ASIAN LIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $al=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='AVEGA' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $avega=$amount['amount'];
		
		$sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='WITH LOVE JAN FOUNDATION' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $lovej=$amount['amount'];
        
        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo LIKE '%SSS(SOCIAL SECURITY SYSTEM)%' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $sss=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='CAREHEALTH' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $chealth=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='CARITAS' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $caritas=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='COCOLIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $coco=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='FLEXICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $flexi=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INTELLICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $intel=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MEDOCARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $medoc=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MAXICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $maxi=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MCL' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $mcl=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MEDICARD' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $mcard=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PHILCARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $pcare=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='VALU CARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $vcare=$amount['amount'];
        
        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PACIFIC CROSS' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $pcross=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INSULAR HEALTHCARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $insu=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INSULAR LIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $insulife=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='GENERALI' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $generali=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PGI CARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $pgicare=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='EAST WEST' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $eastwest=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR DSWD' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $dswd=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE (accttitle='AR LGU KIDAPAWAN' OR accttitle='A/R LGU KIDAPAWAN' OR accttitle='AR LGU-KIDAPAWAN') AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $lgukid=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE (accttitle='A/R LGU MAKILALA' OR accttitle='AR LGU MAKILALA' OR accttitle='AR LGU-MAKILALA') AND acctno='$caseno'");
        $amount=$sql->row_array();
        $lgumak=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PCSO' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $pcso=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='PCSO' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $pcso3=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR EDC' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $edc=$amount['amount'];        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='EDC' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $edc +=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR COTELCO' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $cotelco=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='COTELCO' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $cotelco4=$amount['amount'];
               

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PEPSI COLA' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $pepsi=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PROVINCE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $province=$amount['amount'];
        
	$sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='FIRST BALFOUR' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $balfour=$amount['amount'];


        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR EMPLOYEE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $emp=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%AR DOCTOR%' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $doc=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $maip=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%TEJADA MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $tejada=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%SANTOS MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $santos=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%CAOAGDAN MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $caoagdan=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%PIÑOL MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $pinol=$amount['amount'];
        
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR TRADE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $trade=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE (accttitle = 'AR TRADE PF' OR accttitle='AR EMPLOYEE PF') AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $tradepf=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT shift FROM collection WHERE acctno='$caseno' AND shift <> '' AND (accttitle = 'AR EMPLOYEE' OR accttitle = 'AR PEROSNAL' OR accttitle = 'AR DOCTOR' OR accttitle = 'AR TRADE PF') AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $guarantor=$amount['shift'];
        //============================================================Debit Check==================================================

if($type <> "WCOH"){
            if($coh==0){
         $totalamount=$meds+$lab+$xray+$utz+$ecg+$eeg+$ct+$echo+$respi+$room+$sup+$rt+$erfee+$admit+$nsfee+$ordr+$oxygen+$cert+$diet+$pt+$ambu+$appfother+$appftrade+$appfphic+$appfdep+$ordrsup;
         $meds2 += $meds;
         $lab2 +=$lab;
         $xray2 += $xray;
         $utz2 += $utz;
         $ecg2 += $ecg;
         $eeg2 += $eeg;
         $ct2 += $ct;
         $echo2 += $echo;
         $respi2 += $respi;
         $room2 += $room;
         $sup2 += $sup;
         $rt2 += $rt;
         $erfee2 += $erfee;
         $admit2 += $admit;
         $nsfee2 += $nsfee;
         $ordr2 += $ordr;
         $oxygen2 += $oxygen;
         $cert2 += $cert;
         $diet2 += $diet;
         $pt2 += $pt;
         $ambu2 += $ambu;
         $appfother2 += $appfother;
         $appftrade2 += $appftrade;
         $appfphic2 += $appfphic;
         $appfdep2 += $appfdep;
         $ordrsup2 += $ordrsup;
         //$refund2 +=$refund;
         $totalamountDebit=$coh+$dep12+$disc+$arphic+$al+$avega+$lovej+$chealth+$caritas+$coco+$flexi+$intel+$maxi+$mcl+$mcard+$pcare+$vcare+$pcross+$dswd+$lgumak+$lgukid+$pcso+$pepsi+$province+$trade+$tradepf+$maip+$insu+$generali+$insulife+$doc+$emp+$pgicare+$eastwest+$cotelco+$tejada+$santos+$caoagdan+$pinol+$cotelco4+$pcso3+$balfour+$sss+$medoc+$edc;
         if(number_format($totalamount,2) <> number_format($totalamountDebit,2)){
                    $color="style='color:red;'";
                }else{
                    $color="style='color:black;'";
                }
        echo "<tr>";
    echo "<td align='left' class='font11' $color>$x.</td>";
    echo "<td align='left' class='font11' width='15%' $color>$patientname</td>";
    if($meds1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($meds,2)."</td>";}
    if($lab1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($lab,2)."</td>";}
    if($xray1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($xray,2)."</td>";}
    if($utz1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($utz,2)."</td>";}
    if($ecg1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ecg,2)."</td>";}
    if($eeg1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($eeg,2)."</td>";}
    if($ct1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ct,2)."</td>";}
    if($echo1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($echo,2)."</td>";}
    if($respi1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($respi,2)."</td>";}
    if($room1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($room,2)."</td>";}
    if($sup1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($sup,2)."</td>";}
    if($rt1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($rt,2)."</td>";}
    if($erfee1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($erfee,2)."</td>";}
    if($admit1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($admit,2)."</td>";}
    if($nsfee1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($nsfee,2)."</td>";}
    if($ordr1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ordr,2)."</td>";}
    if($ordrsup1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ordrsup,2)."</td>";}
    if($oxygen1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($oxygen,2)."</td>";}
    if($cert1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($cert,2)."</td>";}
    if($diet1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($diet,2)."</td>";}
    if($pt1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($pt,2)."</td>";}
    if($ambu1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ambu,2)."</td>";}
    if($appfother1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($appfother,2)."</td>";}
    if($appftrade1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($appftrade,2)."</td>";}
    if($appfdep1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($appfdep,2)."</td>";}
    if($appfphic1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($appfphic,2)."</td>";}
    // if($refund1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($refund,2)."</td>";}
    echo "<td align='right' class='font10' width='4%' $color>".number_format($totalamount,2)."</td>";
    echo "</tr>";
    $x++;
    $credittotal += $totalamount;
}
}else{
    $totalamount=$meds+$lab+$xray+$utz+$ecg+$eeg+$ct+$echo+$respi+$room+$sup+$rt+$erfee+$admit+$nsfee+$ordr+$oxygen+$cert+$diet+$pt+$ambu+$appfother+$appftrade+$appfphic+$appfdep+$ordrsup;
     $meds2 += $meds;
         $lab2 +=$lab;
         $xray2 += $xray;
         $utz2 += $utz;
         $ecg2 += $ecg;
         $eeg2 += $eeg;
         $ct2 += $ct;
         $echo2 += $echo;
         $respi2 += $respi;
         $room2 += $room;
         $sup2 += $sup;
         $rt2 += $rt;
         $erfee2 += $erfee;
         $admit2 += $admit;
         $nsfee2 += $nsfee;
         $ordr2 += $ordr;
         $oxygen2 += $oxygen;
         $cert2 += $cert;
         $diet2 += $diet;
         $pt2 += $pt;
         $ambu2 += $ambu;
         $appfother2 += $appfother;
         $appftrade2 += $appftrade;
         $appfphic2 += $appfphic;
         $appfdep2 += $appfdep;
         $ordrsup2 += $ordrsup;
         //$refund2 += $refund;

         $totalamountDebit=$coh+$dep12+$disc+$arphic+$al+$avega+$lovej+$chealth+$caritas+$coco+$flexi+$intel+$maxi+$mcl+$mcard+$pcare+$vcare+$pcross+$dswd+$lgumak+$lgukid+$pcso+$pepsi+$province+$trade+$tradepf+$maip+$insu+$generali+$insulife+$doc+$emp+$pgicare+$eastwest+$cotelco+$tejada+$santos+$caoagdan+$pinol+$cotelco4+$pcso3+$balfour+$sss+$medoc+$edc;
         if(number_format($totalamount,2) <> number_format($totalamountDebit,2)){
                    $color="style='color:red;'";
                }else{
                    $color="style='color:black;'";
                }                
        echo "<tr>";
    echo "<td align='left' class='font11' $color>$x.</td>";
    echo "<td align='left' class='font11' width='15%' $color>$patientname</td>";
    if($meds1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($meds,2)."</td>";}
    if($lab1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($lab,2)."</td>";}
    if($xray1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($xray,2)."</td>";}
    if($utz1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($utz,2)."</td>";}
    if($ecg1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ecg,2)."</td>";}
    if($eeg1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($eeg,2)."</td>";}
    if($ct1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ct,2)."</td>";}
    if($echo1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($echo,2)."</td>";}
    if($respi1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($respi,2)."</td>";}
    if($room1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($room,2)."</td>";}
    if($sup1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($sup,2)."</td>";}
    if($rt1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($rt,2)."</td>";}
    if($erfee1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($erfee,2)."</td>";}
    if($admit1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($admit,2)."</td>";}
    if($nsfee1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($nsfee,2)."</td>";}
    if($ordr1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ordr,2)."</td>";}
    if($ordrsup1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ordrsup,2)."</td>";}
    if($oxygen1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($oxygen,2)."</td>";}
    if($cert1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($cert,2)."</td>";}
    if($diet1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($diet,2)."</td>";}
    if($pt1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($pt,2)."</td>";}
    if($ambu1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ambu,2)."</td>";}
    if($appfother1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($appfother,2)."</td>";}
    if($appftrade1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($appftrade,2)."</td>";}
    if($appfdep1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($appfdep,2)."</td>";}
    if($appfphic1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($appfphic,2)."</td>";}
    // if($refund1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($refund,2)."</td>";}
    echo "<td align='right' class='font10' width='4%' $color>".number_format($totalamount,2)."</td>";
    echo "</tr>";
    $x++;
    $credittotal += $totalamount;
}
	    }
        if(count($body1) > 0){

            foreach($body1 as $item){
            $caseno=$item['caseno'];
            $patientname=$item['lastname'].", ".$item['firstname']." ".$item['middlename'];
                    
            if($type <> "WCOH"){
                $checkCOH=$this->General_model->checkCOH($caseno);
                $coh=$checkCOH['amount'];               
            }
            $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='PHARMACY/MEDICINE' AND trantype='charge' AND quantity > 0 AND administration='administered'");
        $amount=$sql->row_array();
        $meds=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='LABORATORY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $lab=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='XRAY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $xray=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ULTRASOUND' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $utz=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ECG' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $ecg=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='EEG' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $eeg=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='CT SCAN' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $ct=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='HEARTSTATION' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $echo=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='RESPIRATORY' AND trantype='charge' AND quantity > 0 AND (terminalname = 'Testdone' OR terminalname = 'Testtobedone')");
        $amount=$sql->row_array();
        $respi=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ROOM ACCOMODATION' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $room=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='PHARMACY/SUPPLIES' OR productsubtype='MEDICAL SURGICAL SUPPLIES' OR productsubtype='RESPIRATORY SUPPLIES' OR productsubtype='GENERAL SUPPLIES' OR (productsubtype LIKE '%MISCELLANEOUS%' AND (productdesc NOT LIKE '%MINOR ROOM FEE%' AND productdesc NOT LIKE '%RT FEE%')) OR productsubtype LIKE '%MEDICAL EQUIPMENT%' OR productsubtype='LINENS' OR productsubtype='MEDICAL SUPPLIES' OR (productsubtype='NURSING CHARGES' AND productdesc NOT LIKE '%OSTHEORIZED FEEDING%') OR productsubtype='NURSING-CHARGES' OR productsubtype='OR-CHARGES' OR (productsubtype='NURSING SERVICE FEE' AND productdesc='OR PACK') OR productsubtype='OR/DR SUPPLIES' OR productsubtype='RT ON CALL' OR productsubtype='RT REFERRAL' OR (productsubtype='OR/DR/ER FEE' AND productdesc LIKE '%ARMY NAVY%')) AND productdesc NOT LIKE '%DEATH CERTIFICATE%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $sup=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productdesc LIKE '%RT FEE%') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $rt=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ER FEE' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $erfee=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='ADMISSION FEE' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $admit=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%NURSING SERVICE FEE%' AND productdesc NOT LIKE '%OR PACK%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $nsfee=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='OR/DR/ER FEE' OR (productsubtype LIKE '%MISCELLANEOUS%' AND productdesc LIKE '%MINOR ROOM FEE%')) AND productdesc NOT LIKE '%OR SERVICE FEE%' AND productdesc NOT LIKE '%DR SERVICE FEE%' AND productdesc NOT LIKE '%ARMY NAVY%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ordr=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='OR/DR/ER FEE' OR productsubtype='OR-CHARGES') AND (productdesc LIKE '%OR SERVICE FEE%' OR productdesc LIKE '%DR SERVICE FEE%') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ordrsup=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='OXYGEN SUPPLIES' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $oxygen=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='MISCELLANEOUS' AND (productdesc='DEATH CERTIFICATE' OR productdesc='LAB 2ND COPY') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $cert=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='DIETARY' OR productsubtype='DIETARY COUNSELING INCOME' OR productsubtype='OTHER FEES' OR productdesc LIKE '%OSTHEORIZED FEEDING%') AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $diet=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='PHYSICAL THERAPY' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $pt=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='AMBULANCE INCOME' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $ambu=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle LIKE '%APPF OTHERS%' OR (accttitle='PROFESSIONAL FEE' AND `type`='card-Visa'))");
        $amount=$sql->row_array();
        $appfother=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle='AR TRADE PF' OR accttitle='AR EMPLOYEE PF' OR accttitle='AR DOCTOR PF' OR accttitle='AR PERSONAL PF')");
        $amount=$sql->row_array();
        $appftrade=$amount['amount'];        

         $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='OTHER INCOME' AND trantype='charge' AND quantity > 0");
         $amount=$sql->row_array();
         $appfphic=$amount['amount'];
         
        //  $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND accttitle LIKE '%REFUND%' AND `type`='pending'");
        // $amount=$sql->row_array();
        // $refund=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(excess) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $excess=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle LIKE '%AP PATIENT DEPOSIT%' OR accttitle LIKE '%FOR REFUND%')");
        $amount=$sql->row_array();
        $deposit=$amount['amount'];

        // $dep=$excess-$deposit;

        // if($dep<0){
        //   $appfdep=abs($dep);
        // }else{
        //   $appfdep=0;
        // }
$appfdep=$deposit;
        




        //============================================================Debit Check==================================================
        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='PATIENTS DEPOSIT' AND acctno='$caseno' AND `type` <> 'pending'");
        $amount=$sql->row_array();
        $dep12=$amount['amount'];        
        

        $sql=$this->General_model->db->query("SELECT SUM(adjustment) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype NOT LIKE '%PROFESSIONAL FEE%' AND quantity > 0");
        $amount=$sql->row_array();
        $disc=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(amount) as amount FROM acctgenledge WHERE caseno='$caseno' AND acctitle='DISCOUNT' GROUP BY acctitle");
        if($sql->num_rows()>0){
            $result=$sql->row_array();
            $disc += $result['amount'];
        }
        

        $sql=$this->General_model->db->query("SELECT SUM(phic+phic1) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $arphic=$amount['amount'];
        

        // $sql=$this->General_model->db->query("SELECT SUM(phic+phic1) AS amount FROM productout WHERE caseno='$caseno' AND productsubtype='PROFESSIONAL FEE' AND trantype='charge' AND quantity > 0 AND producttype NOT LIKE '%IPD admitting%'");
        // $amount=$sql->row_array();
        // $arpfphic=$amount['amount'];
        // $arpfphic1 +=$arpfphic;

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='ASIAN LIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $al=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='AVEGA' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $avega=$amount['amount'];
		
		$sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='WITH LOVE JAN FOUNDATION' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $lovej=$amount['amount'];
        
        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo LIKE '%SSS(SOCIAL SECURITY SYSTEM)%' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $sss=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='CAREHEALTH' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $chealth=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='CARITAS' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $caritas=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='COCOLIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $coco=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='FLEXICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $flexi=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INTELLICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $intel=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MEDOCARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $medoc=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MAXICARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $maxi=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MCL' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $mcl=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='MEDICARD' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $mcard=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PHILCARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $pcare=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='VALU CARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $vcare=$amount['amount'];
        
        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PACIFIC CROSS' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $pcross=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INSULAR HEALTHCARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $insu=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INSULAR LIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $insulife=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='GENERALI' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $generali=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='PGI CARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $pgicare=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='EAST WEST' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $eastwest=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR DSWD' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $dswd=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE (accttitle='AR LGU KIDAPAWAN' OR accttitle='A/R LGU KIDAPAWAN' OR accttitle='AR LGU-KIDAPAWAN') AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $lgukid=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE (accttitle='A/R LGU MAKILALA' OR accttitle='AR LGU MAKILALA' OR accttitle='AR LGU-MAKILALA') AND acctno='$caseno'");
        $amount=$sql->row_array();
        $lgumak=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PCSO' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $pcso=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='PCSO' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $pcso3=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR EDC' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $edc=$amount['amount'];        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='EDC' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $edc +=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR COTELCO' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $cotelco=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='COTELCO' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $cotelco4=$amount['amount'];
               

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PEPSI COLA' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $pepsi=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PROVINCE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $province=$amount['amount'];
        
    $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='FIRST BALFOUR' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $balfour=$amount['amount'];


        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR EMPLOYEE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $emp=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%AR DOCTOR%' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $doc=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $maip=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%TEJADA MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $tejada=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%SANTOS MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $santos=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%CAOAGDAN MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $caoagdan=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%PIÑOL MAIP FUND' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $pinol=$amount['amount'];
        
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR TRADE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $trade=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE (accttitle = 'AR TRADE PF' OR accttitle='AR EMPLOYEE PF') AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $tradepf=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT shift FROM collection WHERE acctno='$caseno' AND shift <> '' AND (accttitle = 'AR EMPLOYEE' OR accttitle = 'AR PEROSNAL' OR accttitle = 'AR DOCTOR' OR accttitle = 'AR TRADE PF') AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $guarantor=$amount['shift'];
        //============================================================Debit Check==================================================

if($type <> "WCOH"){
            if($coh==0){
         $totalamount=$meds+$lab+$xray+$utz+$ecg+$eeg+$ct+$echo+$respi+$room+$sup+$rt+$erfee+$admit+$nsfee+$ordr+$oxygen+$cert+$diet+$pt+$ambu+$appfother+$appftrade+$appfphic+$appfdep+$ordrsup;
         $meds2 += $meds;
         $lab2 +=$lab;
         $xray2 += $xray;
         $utz2 += $utz;
         $ecg2 += $ecg;
         $eeg2 += $eeg;
         $ct2 += $ct;
         $echo2 += $echo;
         $respi2 += $respi;
         $room2 += $room;
         $sup2 += $sup;
         $rt2 += $rt;
         $erfee2 += $erfee;
         $admit2 += $admit;
         $nsfee2 += $nsfee;
         $ordr2 += $ordr;
         $oxygen2 += $oxygen;
         $cert2 += $cert;
         $diet2 += $diet;
         $pt2 += $pt;
         $ambu2 += $ambu;
         $appfother2 += $appfother;
         $appftrade2 += $appftrade;
         $appfphic2 += $appfphic;
         $appfdep2 += $appfdep;
         $ordrsup2 += $ordrsup;
         //$refund2 +=$refund;
         $totalamountDebit=$coh+$dep12+$disc+$arphic+$al+$avega+$lovej+$chealth+$caritas+$coco+$flexi+$intel+$maxi+$mcl+$mcard+$pcare+$vcare+$pcross+$dswd+$lgumak+$lgukid+$pcso+$pepsi+$province+$trade+$tradepf+$maip+$insu+$generali+$insulife+$doc+$emp+$pgicare+$eastwest+$cotelco+$tejada+$santos+$caoagdan+$pinol+$cotelco4+$pcso3+$balfour+$sss+$medoc+$edc;
         if(number_format($totalamount,2) <> number_format($totalamountDebit,2)){
                    $color="style='color:red;'";
                }else{
                    $color="style='color:black;'";
                }
        echo "<tr>";
    echo "<td align='left' class='font11' $color>$x.</td>";
    echo "<td align='left' class='font11' width='15%' $color>$patientname</td>";
    if($meds1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($meds,2)."</td>";}
    if($lab1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($lab,2)."</td>";}
    if($xray1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($xray,2)."</td>";}
    if($utz1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($utz,2)."</td>";}
    if($ecg1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ecg,2)."</td>";}
    if($eeg1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($eeg,2)."</td>";}
    if($ct1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ct,2)."</td>";}
    if($echo1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($echo,2)."</td>";}
    if($respi1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($respi,2)."</td>";}
    if($room1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($room,2)."</td>";}
    if($sup1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($sup,2)."</td>";}
    if($rt1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($rt,2)."</td>";}
    if($erfee1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($erfee,2)."</td>";}
    if($admit1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($admit,2)."</td>";}
    if($nsfee1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($nsfee,2)."</td>";}
    if($ordr1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ordr,2)."</td>";}
    if($ordrsup1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ordrsup,2)."</td>";}
    if($oxygen1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($oxygen,2)."</td>";}
    if($cert1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($cert,2)."</td>";}
    if($diet1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($diet,2)."</td>";}
    if($pt1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($pt,2)."</td>";}
    if($ambu1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ambu,2)."</td>";}
    if($appfother1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($appfother,2)."</td>";}
    if($appftrade1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($appftrade,2)."</td>";}
    if($appfdep1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($appfdep,2)."</td>";}
    if($appfphic1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($appfphic,2)."</td>";}
    // if($refund1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($refund,2)."</td>";}
    echo "<td align='right' class='font10' width='4%' $color>".number_format($totalamount,2)."</td>";
    echo "</tr>";
    $x++;
    $credittotal += $totalamount;
}
}else{
    $totalamount=$meds+$lab+$xray+$utz+$ecg+$eeg+$ct+$echo+$respi+$room+$sup+$rt+$erfee+$admit+$nsfee+$ordr+$oxygen+$cert+$diet+$pt+$ambu+$appfother+$appftrade+$appfphic+$appfdep+$ordrsup;
     $meds2 += $meds;
         $lab2 +=$lab;
         $xray2 += $xray;
         $utz2 += $utz;
         $ecg2 += $ecg;
         $eeg2 += $eeg;
         $ct2 += $ct;
         $echo2 += $echo;
         $respi2 += $respi;
         $room2 += $room;
         $sup2 += $sup;
         $rt2 += $rt;
         $erfee2 += $erfee;
         $admit2 += $admit;
         $nsfee2 += $nsfee;
         $ordr2 += $ordr;
         $oxygen2 += $oxygen;
         $cert2 += $cert;
         $diet2 += $diet;
         $pt2 += $pt;
         $ambu2 += $ambu;
         $appfother2 += $appfother;
         $appftrade2 += $appftrade;
         $appfphic2 += $appfphic;
         $appfdep2 += $appfdep;
         $ordrsup2 += $ordrsup;
         //$refund2 += $refund;

         $totalamountDebit=$coh+$dep12+$disc+$arphic+$al+$avega+$lovej+$chealth+$caritas+$coco+$flexi+$intel+$maxi+$mcl+$mcard+$pcare+$vcare+$pcross+$dswd+$lgumak+$lgukid+$pcso+$pepsi+$province+$trade+$tradepf+$maip+$insu+$generali+$insulife+$doc+$emp+$pgicare+$eastwest+$cotelco+$tejada+$santos+$caoagdan+$pinol+$cotelco4+$pcso3+$balfour+$sss+$medoc+$edc;
         if(number_format($totalamount,2) <> number_format($totalamountDebit,2)){
                    $color="style='color:red;'";
                }else{
                    $color="style='color:black;'";
                }                
        echo "<tr>";
    echo "<td align='left' class='font11' $color>$x.</td>";
    echo "<td align='left' class='font11' width='15%' $color>$patientname</td>";
    if($meds1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($meds,2)."</td>";}
    if($lab1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($lab,2)."</td>";}
    if($xray1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($xray,2)."</td>";}
    if($utz1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($utz,2)."</td>";}
    if($ecg1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ecg,2)."</td>";}
    if($eeg1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($eeg,2)."</td>";}
    if($ct1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ct,2)."</td>";}
    if($echo1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($echo,2)."</td>";}
    if($respi1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($respi,2)."</td>";}
    if($room1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($room,2)."</td>";}
    if($sup1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($sup,2)."</td>";}
    if($rt1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($rt,2)."</td>";}
    if($erfee1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($erfee,2)."</td>";}
    if($admit1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($admit,2)."</td>";}
    if($nsfee1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($nsfee,2)."</td>";}
    if($ordr1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ordr,2)."</td>";}
    if($ordrsup1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ordrsup,2)."</td>";}
    if($oxygen1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($oxygen,2)."</td>";}
    if($cert1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($cert,2)."</td>";}
    if($diet1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($diet,2)."</td>";}
    if($pt1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($pt,2)."</td>";}
    if($ambu1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($ambu,2)."</td>";}
    if($appfother1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($appfother,2)."</td>";}
    if($appftrade1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($appftrade,2)."</td>";}
    if($appfdep1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($appfdep,2)."</td>";}
    if($appfphic1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($appfphic,2)."</td>";}
    // if($refund1>0){echo "<td align='right' class='font10' width='6%' $color>".number_format($refund,2)."</td>";}
    echo "<td align='right' class='font10' width='4%' $color>".number_format($totalamount,2)."</td>";
    echo "</tr>";
    $x++;
    $credittotal += $totalamount;
}
        }
        }
	    echo "<tr>";
echo "<td align='left' class='font10'></td>";
echo "<td align='left' class='font10' width='15%'  style='font-weight:bold;' $color>TOTAL</td>";
if($meds1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($meds2,2)."</td>";}
if($lab1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($lab2,2)."</td>";}
if($xray1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($xray2,2)."</td>";}
if($utz1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($utz2,2)."</td>";}
if($ecg1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($ecg2,2)."</td>";}
if($eeg1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($eeg2,2)."</td>";}
if($ct1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($ct2,2)."</td>";}
if($echo1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($echo2,2)."</td>";}
if($respi1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($respi2,2)."</td>";}
if($room1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($room2,2)."</td>";}
if($sup1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($sup2,2)."</td>";}
if($rt1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($rt2,2)."</td>";}
if($erfee1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($erfee2,2)."</td>";}
if($admit1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($admit2,2)."</td>";}
if($nsfee1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($nsfee2,2)."</td>";}
if($ordr1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($ordr2,2)."</td>";}
if($ordrsup1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($ordrsup2,2)."</td>";}
if($oxygen1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($oxygen2,2)."</td>";}
if($cert1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($cert2,2)."</td>";}
if($diet1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($diet2,2)."</td>";}
if($pt1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($pt2,2)."</td>";}
if($ambu1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($ambu2,2)."</td>";}
if($appfother1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($appfother2,2)."</td>";}
if($appftrade1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($appftrade2,2)."</td>";}
if($appfdep1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($appfdep2,2)."</td>";}
if($appfphic1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($appfphic2,2)."</td>";}
// if($refund1>0){echo "<td align='right' class='font10' width='6%' style='font-weight:bold;' $color>".number_format($refund2,2)."</td>";}
echo "<td align='right' class='font10' width='4%' style='font-weight:bold;' $color>".number_format($credittotal,2)."</td>";
echo "</tr>";
		?>
	</table>
</div>
