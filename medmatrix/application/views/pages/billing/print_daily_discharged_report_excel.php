<?php
if($department=="I-"){
        $dpt="IPD";
    }else if($department=="O-"){
        $dpt="OPD";
    }else{
        $dpt="HMO";
    }
        if($dpt=="OPD"){
            $qry="SUM(hmo+phic+adjustment) AS amount";
        }else{
            $qry="SUM(sellingprice*quantity) AS amount";
        }
$totalamountCredit=0;

//=============================================Credit Check=============================================================
    if($button=="1"){
        ?>
    <button onclick="tableToExcel('printThis','Discharged_Summary_Debit')">EXPORT DEBIT</button>
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
    }else{
        $dpt="OPD";
    }
    $color="";
    ?>
    
    <div id="printThis">
    <h4 style="margin-left:90px;">DAILY DISCHARGED REPORT (DEBIT) - <?=$st;?> (<b><?=$dpt;?></b>)<br>As of <?=$startdate;?></h4>
    <table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse: collapse; font-size: 11px;">
        <?php
        $coh=0;$dep=0;$disc=0;$arphic=0;$arpfphic=0;$al=0;$avega=0;$chealth=0;$caritas=0;$coco=0;$flexi=0;$intel=0;$maxi=0;$mcl=0;$mcard=0;$pcare=0;$vcare=0;
        $dswd=0;$lgumak=0;$lgukid=0;$pcso=0;$pepsi=0;$province=0;$trade=0;$tradepf=0;$pcross=0;$maip=0;$insu=0;$generali=0;$insulife=0;$emp=0;$doc=0;$pgicare=0;$balfour=0;
        $coh1=0;$dep1=0;$disc1=0;$arphic1=0;$arpfphic1=0;$al1=0;$avega1=0;$chealth1=0;$caritas1=0;$coco1=0;$flexi1=0;$intel1=0;$maxi1=0;$mcl1=0;$mcard1=0;$pcare1=0;$pgicare1=0;
        $vcare1=0;$dswd1=0;$lgumak1=0;$lgukid1=0;$pcso1=0;$pepsi1=0;$province1=0;$trade1=0;$tradepf1=0;$pcross1=0;$maip1=0;$insu1=0;$generali1=0;$insulife1=0;$emp1=0;$doc1=0;$eastwest1=0;$cotelco1=0;$tejada1=0;$santos1=0;$caoagdan1=0;$pinol1=0;$pcso3=0;$pcso4=0;$medoc=0;$medoc1=0;$guarantor="";$guarantor1="";$cotelco3=0;$sss=0;$sss1=0;
        $balfour1=0;
        $totalamount=0;
        $credittotal=0;
        foreach($body as $item){
            $caseno=$item['caseno'];
            $patientname=$item['patientname'];
            $coh=$item['amount'];           
            if($type <> "WCOH"){                
                $checkCOH=$this->General_model->checkCOH($caseno);
                $coh=$checkCOH['amount'];               
            }
            //$coh1 += $coh;
           // if($coh==0){
        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='PATIENTS DEPOSIT' AND acctno='$caseno' AND `type` <> 'pending'");
        $amount=$sql->row_array();
        $dep=$amount['amount'];        
        //$dep1 +=$dep;

        $sql=$this->General_model->db->query("SELECT SUM(adjustment) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype NOT LIKE '%PROFESSIONAL FEE%' AND quantity > 0");
        $amount=$sql->row_array();
        $disc=$amount['amount'];
        //$disc1 +=$disc;

        $sql=$this->General_model->db->query("SELECT SUM(phic+phic1) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $arphic=$amount['amount'];
        //$arphic1 +=$arphic;

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

         $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo LIKE '%SSS%' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $sss=$amount['amount'];
        $sss1 +=$sss;

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
        $medoc=$amount['amount'];
        $medoc1 +=$medoc;

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

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='INSULAR LIFE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $insulife=$amount['amount'];
        $insulife1 +=$insulife;

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

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE (accttitle='A/R LGU MAKILALA' OR accttitle='AR LGU MAKILALA' OR accttitle='AR LGU-MAKILALA') AND acctno='$caseno'");
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
        $pcso4 +=$pcso;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR COTELCO' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $cotelco=$amount['amount'];
        $cotelco1 +=$cotelco;

    $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='FIRST BALFOUR' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $balfour=$amount['amount'];
        $balfour1 +=$balfour;


        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='COTELCO' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $cotelco=$amount['amount'];
        $cotelco3 +=$cotelco;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PEPSI COLA' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $pepsi=$amount['amount'];
        $pepsi1 +=$pepsi;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PROVINCE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $province=$amount['amount'];
        $province1 +=$province;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle = 'AR EMPLOYEE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $emp=$amount['amount'];
        $emp1 +=$emp;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle LIKE '%AR DOCTOR%' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $doc=$amount['amount'];
        $doc1 +=$doc;

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

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE (accttitle='AR TRADE PF' OR accttitle='AR EMPLOYEE PF' OR accttitle='AR DOCTOR PF' OR accttitle='AR PERSONAL PF') AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $tradepf=$amount['amount'];
        $tradepf1 +=$tradepf; 

        $sql=$this->General_model->db->query("SELECT shift FROM collection WHERE acctno='$caseno' AND shift <> '' AND (accttitle = 'AR EMPLOYEE' OR accttitle = 'AR PEROSNAL' OR accttitle = 'AR DOCTOR' OR accttitle = 'AR TRADE PF') AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $guarantor1 .=$amount['shift'];
   // }
        }        
echo "<tr>";
  echo "<td width='3%' class='font11'>No.</td>";
  echo "<td align='center' class='font11' width='20%'>PATIENT NAME</td>";
  echo "<td align='center' class='font11' width='5%'>COH</td>";
  echo "<td align='center' class='font11' width='6%'>DEP</td>";
  echo "<td align='center' class='font11' width='6%'>DISC</td>";
  echo "<td align='center' class='font11' width='6%'>PHIC</td>";

  if($al1>0){echo "<td align='center' class='font11' width='6%'>ASIAN LIFE</td>";}
  if($avega1>0){echo "<td align='center' class='font11' width='6%'>AVEGA</td>";}
  if($sss1>0){echo "<td align='center' class='font11' width='6%'>SSS</td>";}
  if($chealth1>0){echo "<td align='center' class='font11' width='6%'>CAREHALTH</td>";}
  if($caritas1>0){echo "<td align='center' class='font11' width='6%'>CARITAS</td>";}
  if($coco1>0){echo "<td align='center' class='font11' width='6%'>COCOLIFE</td>";}
  if($flexi1>0){echo "<td align='center' class='font11' width='6%'> FLEXICARE</td>";}
  if($intel1>0){echo "<td align='center' class='font11' width='6%'>INTELLICARE</td>";}
  if($maxi1>0){echo "<td align='center' class='font11' width='6%'>MAXICARE</td>";}
  if($mcl1>0){echo "<td align='center' class='font11' width='6%'>MCL</td>";}
  if($mcard1>0){echo "<td align='center' class='font11' width='6%'>MEDICARD</td>";}
  if($pcare1>0){echo "<td align='center' class='font11' width='6%'>PHILCARE</td>";}
  if($vcare1>0){echo "<td align='center' class='font11' width='6%'>VALUE CARE</td>";}
  if($pcross1>0){echo "<td align='center' class='font11' width='6%'>PACIFIC CROSS</td>";}
  if($insu1>0){echo "<td align='center' class='font11' width='6%'>INSULAR HEALTHCARE</td>";}
  if($insulife1>0){echo "<td align='center' class='font11' width='6%'>INSULAR LIFE</td>";}
   if($medoc1>0){echo "<td align='center' class='font11' width='6%'>MEDOCARE</td>";}
  if($generali1>0){echo "<td align='center' class='font11' width='6%'> GENERALI</td>";}
  if($pgicare1>0){echo "<td align='center' class='font11' width='6%'> PGI CARE</td>";}
  if($eastwest1>0){echo "<td align='center' class='font11' width='6%'>EAST WEST</td>";}
  if($dswd1>0){echo "<td align='center' class='font11' width='6%'>DSWD</td>";}
  if($lgumak1>0){echo "<td align='center' class='font11' width='6%'>LGU MAK</td>";}
  if($lgukid1>0){echo "<td align='center' class='font11' width='6%'>LGU KID</td>";}
  if($pcso1+$pcso4>0){echo "<td align='center' class='font11' width='6%'>PCSO</td>";}
  if($cotelco1+$cotelco3>0){echo "<td align='center' class='font11' width='6%'>COTELCO</td>";}
  if($pepsi1>0){echo "<td align='center' class='font11' width='6%'>PEPSI COLA</td>";}
  if($doc1>0){echo "<td align='center' class='font11' width='6%'>DOCTOR</td>";}
  if($emp1>0){echo "<td align='center' class='font11' width='6%'>EMPLOYEE</td>";}
  if($province1>0){echo "<td align='center' class='font11' width='6%'>PROVINCE</td>";}
  if($balfour1>0){echo "<td align='center' class='font11' width='6%'>BALFOUR</td>";}
  if($tejada1>0){echo "<td align='center' class='font11' width='6%'>TEJADA MAIP</td>";}
  if($santos1>0){echo "<td align='center' class='font11' width='6%'>SANTOS MAIP</td>";}
  if($caoagdan1>0){echo "<td align='center' class='font11' width='6%'>CAOAGDAN MAIP</td>";}
  if($pinol1>0){echo "<td align='center' class='font11' width='6%'>PINOL MAIP</td>";}
  if($maip1>0){echo "<td align='center' class='font11' width='6%'>MAIP FUND</td>";}
  if($trade1>0){echo "<td align='center' class='font11' width='6%'>TRADE</td>";}
  if($tradepf1>0){echo "<td align='center' class='font11' width='6%'>TRADE PF</td>";}
  echo "<td align='center' class='font11' width='6%'>TOTAL</td>";
  if($guarantor1 <> ''){echo "<td align='center' class='font11' width='6%'>GUARANTOR</td>";}

  echo "</tr>";
  $x=1;
  
  $al2=0;$avega2=0;$chealth2=0;$caritas2=0;$coco2=0;$flexi2=0;$intel2=0;$maxi2=0;$mcl2=0;$mcard2=0;$pcare2=0;$pgicare2=0;$eastwest2=0;$medoc2=0;
        $vcare2=0;$dswd2=0;$lgumak2=0;$lgukid2=0;$pcso2=0;$pepsi2=0;$province2=0;$trade2=0;$tradepf2=0;$pcross2=0;$maip2=0;$insu2=0;$generali2=0;$insulife2=0;$emp2=0;$doc2=0;$cotelco2=0;$tejada2=0;$santos2=0;$caoagdan2=0;$pinol2=0;$balfour2=0;$sss2=0;
foreach($body as $item){
            $caseno=$item['caseno'];
            $patientname=$item['patientname'];
            $coh=$item['amount'];           
            if($type <> "WCOH"){
                $checkCOH=$this->General_model->checkCOH($caseno);
                $coh=$checkCOH['amount'];               
            }
            //$coh1 += $coh;

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='PATIENTS DEPOSIT' AND acctno='$caseno' AND `type` <> 'pending'");
        $amount=$sql->row_array();
        $dep=$amount['amount'];        
        

        $sql=$this->General_model->db->query("SELECT SUM(adjustment) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype NOT LIKE '%PROFESSIONAL FEE%' AND quantity > 0");
        $amount=$sql->row_array();
        $disc=$amount['amount'];
        

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
        

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po LEFT JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND po.trantype='charge' AND po.quantity > 0 AND a.hmo='VALUE CARE' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
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

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR COTELCO' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $cotelco=$amount['amount'];

    $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='FIRST BALFOUR' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $balfour=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(po.hmo) AS amount FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.hmo='COTELCO' AND a.caseno='$caseno' AND po.productsubtype NOT LIKE '%PROFESSIONAL FEE%'");
        $amount=$sql->row_array();
        $cotelco4=$amount['amount'];
               

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PEPSI COLA' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $pepsi=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE accttitle='AR PROVINCE' AND acctno='$caseno' AND refno NOT LIKE '%LP%'");
        $amount=$sql->row_array();
        $province=$amount['amount'];
        

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



        //====================================Credit Check==================================
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
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productsubtype='PHARMACY/SUPPLIES' OR productsubtype='MEDICAL SURGICAL SUPPLIES' OR productsubtype='RESPIRATORY SUPPLIES' OR productsubtype='GENERAL SUPPLIES' OR (productsubtype LIKE '%MISCELLANEOUS%' AND (productdesc NOT LIKE '%MINOR ROOM FEE%' AND productdesc NOT LIKE '%RT FEE%')) OR productsubtype LIKE '%MEDICAL EQUIPMENT%' OR productsubtype='LINENS' OR productsubtype='MEDICAL SUPPLIES' OR (productsubtype='NURSING CHARGES' AND productdesc NOT LIKE '%OSTHEORIZED FEEDING%') OR productsubtype='NURSING-CHARGES' OR productsubtype='OR-CHARGES' OR (productsubtype='NURSING SERVICE FEE' AND productdesc='OR PACK') OR productsubtype='OR/DR SUPPLIES' or productsubtype='RT ON CALL' OR productsubtype='RT REFERRAL' OR (productsubtype='OR/DR/ER FEE' AND productdesc LIKE '%ARMY NAVY%')) AND productdesc NOT LIKE '%DEATH CERTIFICATE%' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $sup=$amount['amount'];
        

        $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND (productdesc LIKE '%RT FEE%' ) AND trantype='charge' AND quantity > 0");
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

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND accttitle LIKE '%REFUND%' AND `type`='pending'");
        $amount=$sql->row_array();
        $refund=$amount['amount'];        

         $sql=$this->General_model->db->query("SELECT $qry FROM productout WHERE caseno='$caseno' AND productsubtype='OTHER INCOME' AND trantype='charge' AND quantity > 0");
         $amount=$sql->row_array();
         $appfphic=$amount['amount'];
         

        $sql=$this->General_model->db->query("SELECT SUM(excess) AS amount FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0");
        $amount=$sql->row_array();
        $excess=$amount['amount'];

        $sql=$this->General_model->db->query("SELECT SUM(amount) AS amount FROM collection WHERE acctno='$caseno' AND (accttitle LIKE '%AP PATIENT DEPOSIT%'  OR accttitle LIKE '%FOR REFUND%')");
        $amount=$sql->row_array();
        $deposit=$amount['amount'];

        //$dep12=$excess-$deposit;

        // if($dep12<0){
        //   $appfdep=abs($dep12);
        // }else{
        //   $appfdep=0;
        // }
$appfdep=$deposit;
        
        //=========================================Credit Check==================================================

        if($type != "WCOH"){
            if($coh==0){
                $totalamount=$coh+$dep+$disc+$arphic+$arpfphic+$al+$avega+$chealth+$caritas+$coco+$flexi+$intel+$maxi+$mcl+$mcard+$pcare+$vcare+$pcross+$dswd+$lgumak+$lgukid+$pcso+$pepsi+$province+$trade+$tradepf+$maip+$insu+$generali+$insulife+$doc+$emp+$pgicare+$eastwest+$cotelco+$tejada+$santos+$caoagdan+$pinol+$cotelco4+$pcso3+$balfour+$sss;
                $dep1 += $dep;
                $disc1 += $disc;
                $arphic1 += $arphic;
                $coh1 += $coh;
                $al2 +=$al;
                $avega2 +=$avega;
                $sss2 +=$sss;
                $chealth2 +=$chealth;
                $caritas2 +=$caritas;
                $coco2 +=$coco;
                $flexi2 +=$flexi;
                $intel2 +=$intel;
                $maxi2 +=$maxi;
                $mcl2 +=$mcl;
                $mcard2 +=$mcard;
                $pcare2 +=$pcare;
                $vcare2 +=$vcare;
                $pcross2 +=$pcross;
                $insu2 +=$insu;
                $insulife2 +=$insulife;
                $generali2 +=$generali;
                $pgicare2 +=$pgicare;
                $dswd2 +=$dswd;
                $lgukid2 +=$lgukid;
                $lgumak2 +=$lgumak;
                $pcso2 +=$pcso+$pcso3;
                $pepsi2 +=$pepsi;
                $province2 +=$province;
                $emp2 +=$emp;
                $doc2 +=$doc;
                $maip2 +=$maip;
                $trade2 +=$trade;
                $tradepf2 +=$tradepf;
                $eastwest2 +=$eastwest;
                $cotelco2 +=$cotelco+$cotelco4;
                $tejada2 +=$tejada;
                $santos2 +=$santos;
                $caoagdan2 +=$caoagdan;
                $pinol2 +=$pinol;
                $medoc2+=$medoc;
        $balfour2 += $balfour;
                
        $totalamountCredit=$meds+$lab+$xray+$utz+$ecg+$eeg+$ct+$echo+$respi+$room+$sup+$rt+$erfee+$admit+$nsfee+$ordr+$oxygen+$cert+$diet+$pt+$ambu+$appfother+$appftrade+$appfphic+$appfdep+$ordrsup;
                
                if(number_format($totalamount,2) <> number_format($totalamountCredit,2)){
                    $color="style='color:red;'";
                }else{
                    $color="style='color:black;'";
                }
        echo "<tr $color>";
    echo "<td align='left' class='font11' $color>$x.</td>";
    echo "<td align='left' class='font11' $color>$patientname</td>";
    echo "<td align='right' class='font11' $color>".number_format($coh,2)."</td>";
    echo "<td align='right' class='font11' $color>".number_format($dep,2)."</td>";
    echo "<td align='right' class='font11' $color>".number_format($disc,2)."</td>";
    echo "<td align='right' class='font11' $color>".number_format($arphic,2)."</td>";
    if($al1>0){echo "<td align='right' class='font11' $color>".number_format($al,2)."</td>";}
    if($avega1>0){echo "<td align='right' class='font11' $color>".number_format($avega,2)."</td>";}
    if($sss1>0){echo "<td align='right' class='font11' $color>".number_format($sss,2)."</td>";}
    if($chealth1>0){echo "<td align='right' class='font11' $color>".number_format($chealth,2)."</td>";}
    if($caritas1>0){echo "<td align='right' class='font11' $color>".number_format($caritas,2)."</td>";}
    if($coco1>0){echo "<td align='right' class='font11' $color>".number_format($coco,2)."</td>";}
    if($flexi1>0){echo "<td align='right' class='font11' $color>".number_format($flexi,2)."</td>";}
    if($intel1>0){echo "<td align='right' class='font11' $color>".number_format($intel,2)."</td>";}
    if($maxi1>0){echo "<td align='right' class='font11' $color>".number_format($maxi,2)."</td>";}
    if($mcl1>0){echo "<td align='right' class='font11' $color>".number_format($mcl,2)."</td>";}
    if($mcard1>0){echo "<td align='right' class='font11' $color>".number_format($mcard,2)."</td>";}
    if($pcare1>0){echo "<td align='right' class='font11' $color>".number_format($pcare,2)."</td>";}
    if($vcare1>0){echo "<td align='right' class='font11' $color>".number_format($vcare,2)."</td>";}
    if($pcross1>0){echo "<td align='right' class='font11' $color>".number_format($pcross,2)."</td>";}
    if($insu1>0){echo "<td align='right' class='font11' $color>".number_format($insu,2)."</td>";}
    if($insulife1>0){echo "<td align='right' class='font11' $color>".number_format($insulife,2)."</td>";}
    if($medoc1>0){echo "<td align='right' class='font11' $color>".number_format($medoc,2)."</td>";}
    if($generali1>0){echo "<td align='right' class='font11' $color>".number_format($generali,2)."</td>";}
    if($pgicare1>0){echo "<td align='right' class='font11' $color>".number_format($pgicare,2)."</td>";}
    if($eastwest1>0){echo "<td align='right' class='font11' $color>".number_format($eastwest,2)."</td>";}
    if($dswd1>0){echo "<td align='right' class='font11' $color>".number_format($dswd,2)."</td>";}
    if($lgumak1>0){echo "<td align='right' class='font11' $color>".number_format($lgumak,2)."</td>";}
    if($lgukid1>0){echo "<td align='right' class='font11' $color>".number_format($lgukid,2)."</td>";}
    if($pcso1+$pcso4>0){echo "<td align='right' class='font11' $color>".number_format($pcso+$pcso3,2)."</td>";}
    if($cotelco1+$cotelco3>0){echo "<td align='right' class='font11' $color>".number_format($cotelco,2)."</td>";}
    if($pepsi1>0){echo "<td align='right' class='font11' $color>".number_format($pepsi,2)."</td>";}
    if($doc1>0){echo "<td align='right' class='font11' $color>".number_format($doc,2)."</td>";}
    if($emp1>0){echo "<td align='right' class='font11' $color>".number_format($emp,2)."</td>";}
    if($province1>0){echo "<td align='right' class='font11' $color>".number_format($province,2)."</td>";}
    if($balfour1>0){echo "<td align='right' class='font11' $color>".number_format($balfour,2)."</td>";}
    if($tejada1>0){echo "<td align='right' class='font11' $color>".number_format($tejada,2)."</td>";}
     if($santos1>0){echo "<td align='right' class='font11' $color>".number_format($santos,2)."</td>";}
     if($caoagdan1>0){echo "<td align='right' class='font11' $color>".number_format($caoagdan,2)."</td>";}
     if($pinol1>0){echo "<td align='right' class='font11' $color>".number_format($pinol,2)."</td>";}
     if($maip1>0){echo "<td align='right' class='font11' $color>".number_format($maip,2)."</td>";}
    if($trade1>0){echo "<td align='right' class='font11' $color>".number_format($trade,2)."</td>";}
    if($tradepf1>0){echo "<td align='right' class='font11' $color>".number_format($tradepf,2)."</td>";}
    echo "<td align='right' $color>".number_format($totalamount,2)."</td>";
    if($guarantor1 <> ''){ 
        $g=explode('||', $guarantor);
        if(count($g)>1){
        echo "<td align='center' class='font11' width='10%'>".$g[1]."</td>";
        }else{
          echo "<td align='right' class='font11' width='10%'></td>";  
        }
    }else{
        //echo "<td align='right' class='font11' width='10%'></td>";
    }
    echo "</tr>";
    $x++;
    $credittotal += $totalamount;
            }
        }else{
            $totalamount=$coh+$dep+$disc+$arphic+$arpfphic+$al+$avega+$chealth+$caritas+$coco+$flexi+$intel+$maxi+$mcl+$mcard+$pcare+$vcare+$pcross+$dswd+$medoc+$lgumak+$lgukid+$pcso+$pepsi+$province+$trade+$tradepf+$maip+$insu+$generali+$insulife+$doc+$emp+$pgicare+$eastwest+$cotelco+$tejada+$santos+$caoagdan+$pinol+$cotelco4+$pcso3+$balfour+$sss;
                $dep1 += $dep;
                $disc1 += $disc;
                $arphic1 += $arphic;
                $coh1 += $coh;
                $al2 +=$al;
                $avega2 +=$avega;
                $sss2 +=$sss;
                $chealth2 +=$chealth;
                $caritas2 +=$caritas;
                $coco2 +=$coco;
                $flexi2 +=$flexi;
                $intel2 +=$intel;
                $maxi2 +=$maxi;
                $mcl2 +=$mcl;
                $mcard2 +=$mcard;
                $pcare2 +=$pcare;
                $vcare2 +=$vcare;
                $pcross2 +=$pcross;
                $insu2 +=$insu;
                $insulife2 +=$insulife;
                $generali2 +=$generali;
                $pgicare2 +=$pgicare;
                $dswd2 +=$dswd;
                $lgukid2 +=$lgukid;
                $lgumak2 +=$lgumak;
                $pcso2 +=$pcso+$pcso3;
                $pepsi2 +=$pepsi;
                $province2 +=$province;
                $emp2 +=$emp;
                $doc2 +=$doc;
                $maip2 +=$maip;
                $trade2 +=$trade;
                $tradepf2 +=$tradepf;
                $eastwest2 +=$eastwest;
                $cotelco2 +=$cotelco+$cotelco4;
                $tejada2 +=$tejada;
                $santos2 +=$santos;
                $caoagdan2 +=$caoagdan;
                $pinol2 +=$pinol;
                $medoc2+=$medoc;
        $balfour2 += $balfour;
                $totalamountCredit=$meds+$lab+$xray+$utz+$ecg+$eeg+$ct+$echo+$respi+$room+$sup+$rt+$erfee+$admit+$nsfee+$ordr+$oxygen+$cert+$diet+$pt+$ambu+$appfother+$appftrade+$appfphic+$appfdep+$ordrsup;

                if(number_format($totalamount,2) <> number_format($totalamountCredit,2)){
                    $color="style='color:red;'";
                }else{
                    $color="style='color:black;'";
                }
        echo "<tr>";
    echo "<td align='left' class='font11' $color>$x.</td>";
    echo "<td align='left' class='font11' $color>$patientname</td>";
    echo "<td align='right' class='font11' $color>".number_format($coh,2)."</td>";
    echo "<td align='right' class='font11' $color>".number_format($dep,2)."</td>";
    echo "<td align='right' class='font11' $color>".number_format($disc,2)."</td>";
    echo "<td align='right' class='font11' $color>".number_format($arphic,2)."</td>";
    if($al1>0){echo "<td align='right' class='font11' $color>".number_format($al,2)."</td>";}
    if($avega1>0){echo "<td align='right' class='font11' $color>".number_format($avega,2)."</td>";}
    if($sss1>0){echo "<td align='right' class='font11' $color>".number_format($sss,2)."</td>";}
    if($chealth1>0){echo "<td align='right' class='font11' $color>".number_format($chealth,2)."</td>";}
    if($caritas1>0){echo "<td align='right' class='font11' $color>".number_format($caritas,2)."</td>";}
    if($coco1>0){echo "<td align='right' class='font11' $color>".number_format($coco,2)."</td>";}
    if($flexi1>0){echo "<td align='right' class='font11' $color>".number_format($flexi,2)."</td>";}
    if($intel1>0){echo "<td align='right' class='font11' $color>".number_format($intel,2)."</td>";}
    if($maxi1>0){echo "<td align='right' class='font11' $color>".number_format($maxi,2)."</td>";}
    if($mcl1>0){echo "<td align='right' class='font11' $color>".number_format($mcl,2)."</td>";}
    if($mcard1>0){echo "<td align='right' class='font11' $color>".number_format($mcard,2)."</td>";}
    if($pcare1>0){echo "<td align='right' class='font11' $color>".number_format($pcare,2)."</td>";}
    if($vcare1>0){echo "<td align='right' class='font11' $color>".number_format($vcare,2)."</td>";}
    if($pcross1>0){echo "<td align='right' class='font11' $color>".number_format($pcross,2)."</td>";}
    if($insu1>0){echo "<td align='right' class='font11' $color>".number_format($insu,2)."</td>";}
    if($insulife1>0){echo "<td align='right' class='font11' $color>".number_format($insulife,2)."</td>";}
    if($medoc1>0){echo "<td align='right' class='font11' $color>".number_format($medoc,2)."</td>";}
    if($generali1>0){echo "<td align='right' class='font11' $color>".number_format($generali,2)."</td>";}
    if($pgicare1>0){echo "<td align='right' class='font11' $color>".number_format($pgicare,2)."</td>";}
    if($eastwest1>0){echo "<td align='right' class='font11' $color>".number_format($eastwest,2)."</td>";}
    if($dswd1>0){echo "<td align='right' class='font11' $color>".number_format($dswd,2)."</td>";}
    if($lgumak1>0){echo "<td align='right' class='font11' $color>".number_format($lgumak,2)."</td>";}
    if($lgukid1>0){echo "<td align='right' class='font11' $color>".number_format($lgukid,2)."</td>";}
    if($pcso1+$pcso4>0){echo "<td align='right' class='font11' $color>".number_format($pcso+$pcso3,2)."</td>";}
    if($cotelco1+$cotelco3>0){echo "<td align='right' class='font11' $color>".number_format($cotelco,2)."</td>";}
    if($pepsi1>0){echo "<td align='right' class='font11' $color>".number_format($pepsi,2)."</td>";}
    if($doc1>0){echo "<td align='right' class='font11' $color>".number_format($doc,2)."</td>";}
    if($emp1>0){echo "<td align='right' class='font11' $color>".number_format($emp,2)."</td>";}
    if($province1>0){echo "<td align='right' class='font11' $color>".number_format($province,2)."</td>";}
    if($balfour1>0){echo "<td align='right' class='font11' $color>".number_format($balfour,2)."</td>";}
    if($tejada1>0){echo "<td align='right' class='font11' $color>".number_format($tejada,2)."</td>";}
     if($santos1>0){echo "<td align='right' class='font11' $color>".number_format($santos,2)."</td>";}
     if($caoagdan1>0){echo "<td align='right' class='font11' $color>".number_format($caoagdan,2)."</td>";}
     if($pinol1>0){echo "<td align='right' class='font11' $color>".number_format($pinol,2)."</td>";}
     if($maip1>0){echo "<td align='right' class='font11' $color>".number_format($maip,2)."</td>";}
    if($trade1>0){echo "<td align='right' class='font11' $color>".number_format($trade,2)."</td>";}
    if($tradepf1>0){echo "<td align='right' class='font11' $color>".number_format($tradepf,2)."</td>";}
    echo "<td align='right' $color>".number_format($totalamount,2)."</td>";
    if($guarantor1 <> ''){ 
        $g=explode('||', $guarantor);
        if(count($g)>1){
        echo "<td align='center' class='font11' width='10%'>".$g[1]."</td>"; 
        }else{
            echo "<td align='right' class='font11' width='10%'></td>";
        }
        }else{
        //echo "<td align='right' class='font11' width='10%'></td>";
    }
    echo "</tr>";
    $x++;
    $credittotal += $totalamount;
        }        
        
        }
        echo "<tr>";
echo "<td class='font11'></td>";
echo "<td align='right' class='font11' style='font-weight:bold;' $color>TOTAL</td>";
echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($coh1,2)."</td>";
echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($dep1,2)."</td>";
echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($disc1,2)."</td>";
echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($arphic1,2)."</td>";
if($al1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($al2,2)."</td>";}
if($avega1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($avega2,2)."</td>";}
if($sss1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($sss2,2)."</td>";}
if($chealth1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($chealth2,2)."</td>";}
if($caritas1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($caritas2,2)."</td>";}
if($coco1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($coco2,2)."</td>";}
if($flexi1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($flexi2,2)."</td>";}
if($intel1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($intel2,2)."</td>";}
if($maxi1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($maxi2,2)."</td>";}
if($mcl1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($mcl2,2)."</td>";}
if($mcard1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($mcard2,2)."</td>";}
if($pcare1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($pcare2,2)."</td>";}
if($vcare1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($vcare2,2)."</td>";}
if($pcross1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($pcross2,2)."</td>";}
if($insu1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($insu2,2)."</td>";}
if($insulife1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($insulife2,2)."</td>";}
if($medoc1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($medoc2,2)."</td>";}
if($generali1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($generali2,2)."</td>";}
if($pgicare1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($pgicare2,2)."</td>";}
if($eastwest1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($eastwest2,2)."</td>";}
if($dswd1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($dswd2,2)."</td>";}
if($lgumak1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($lgumak2,2)."</td>";}
if($lgukid1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($lgukid2,2)."</td>";}
if($pcso1+$pcso4>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($pcso2,2)."</td>";}
if($cotelco1>0){echo "<td align='right' class='font11'style='font-weight:bold;' $color>".number_format($cotelco2,2)."</td>";}
if($pepsi1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($pepsi2,2)."</td>";}
if($doc1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($doc2,2)."</td>";}
if($emp1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($emp2,2)."</td>";}
if($province1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($province2,2)."</td>";}
if($balfour1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($balfour2,2)."</td>";}
if($tejada1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($tejada2,2)."</td>";}
if($santos1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($santos2,2)."</td>";}
if($caoagdan1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($caoagdan2,2)."</td>";}
if($pinol1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($pinol2,2)."</td>";}
 if($maip1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($maip2,2)."</td>";}
if($trade1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($trade2,2)."</td>";}
if($tradepf1>0){echo "<td align='right' class='font11' style='font-weight:bold;' $color>".number_format($tradepf2,2)."</td>";}
echo "<td align='right' style='font-weight:bold;' $color>".number_format($credittotal,2)."</td>";
if($guarantor1 <> ''){echo "<td align='right' class='font11' width='10%'></td>";}
echo "</tr>";
        ?>
    </table>
</div>






<script>                 
  var tableToExcel = (function(){
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
