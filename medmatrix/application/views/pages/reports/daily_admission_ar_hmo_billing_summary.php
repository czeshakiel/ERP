<table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-collapse: collapse; font-size: 11px;">
    <tr>
    <td colspan="4"><b>DEBIT</b></td>    
</tr>
<tr>
        <td colspan="4">&nbsp;</td>
    </tr>
<tr>
    <td>DESCRIPTION</td>
    <td align="center">BEGINNING</td>
    <td align="center">TODAY</td>
    <td align="center">ENDING</td>
</tr>   
<tr>
    <td colspan="4">&nbsp;</td>
</tr>
<?php
$begdate=date('Y-m',strtotime($rundate))."-01";
$totalamshibegin=0;$totalasianbegin=0;$totalavegabegin=0;$totalcarehealthbegin=0;$totalcaritasbegin=0;$totalcmshibegin=0;$totalcocolifebegin=0;$totaltejadabegin=0;
$totalcbcbegin=0;$totalcosucecobegin=0;$totalcotelcobegin=0;$totaldbpbegin=0;$totaldepedbegin=0;$totaldohbegin=0;$totaldswdbegin=0;$totaldxndbegin=0;$totaleastwestbegin=0;
$totaledcbegin=0;$totalemcorbegin=0;$totalbalfourbegin=0;$totalflexicarebegin=0;$totalfortunebegin=0;$totalgeneralibegin=0;$totalgsisbegin=0;$totalinsularhealthcarebegin=0;
$totalinsularlifebegin=0;$totalintelbegin=0;$totalkingbegin=0;$totallandbankbegin=0;$totalpikitbegin=0;$totalkidapawanbegin=0;$totalmakilalabegin=0;$totalmaipbegin=0;
$totalmakmpcbegin=0;$totalmaxicarebegin=0;$totalmclbegin=0;$totalmediatrixbegin=0;$totalmedicardbegin=0;$totalmedicarebegin=0;$totalmedilinkbegin=0;$totalmkwdbegin=0;
$totalmmshibegin=0;$totalmutibegin=0;$totalpresidentbegin=0;$totalcrossbegin=0;$totalpcsobegin=0;$totalpenongsbegin=0;$totalpepsibegin=0;$totalpgibegin=0;$totalphilcarebegin=0;
$totalphicbegin=0;$totalpikitwdbegin=0;$totalprovincebegin=0;$totalpsabegin=0;$totalsssbegin=0;$totalstacatbegin=0;$totalstanfilcobegin=0;$totalsunlifebegin=0;$totalucpbbegin=0;
$totalvaluecarebegin=0;
foreach($begin as $list){
    $amshi=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'AMSHI');$asian=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'ASIAN LIFE');
    $avega=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'AVEGA');$carehealth=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'CAREHEALTH');
    $caritas=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'CARITAS');$cmshi=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'CMSHI');
    $cocolife=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'COCOLIFE');$tejada=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'CONG. TEJADA MAIP FUND');
    $cbc=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'COOP BANK OF COTABATO');$cosuceco=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'COSUCECO');
    $cotelco=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'COTELCO');$dbp=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'DBP');
    $deped=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'DEPED');
    $doh=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'DOH');$dswd=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'DSWD');
    $dxnd=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'DXND');$eastwest=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'EAST WEST');
    $edc=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'EDC');$emcor=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'EMCOR');
    $balfour=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'FIRST BALFOUR');$flexicare=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'FLEXICARE');
    $fortune=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'FORTUNE CARE');$generali=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'GENERALI');
    $gsis=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'GSIS');$insularhealth=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'INSULAR HEALTHCARE');
    $insularlife=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'INSULAR LIFE');$intel=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'INTELLICARE');
    $king=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'KING COOP');$landbank=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'LANDBANK');
    $pikit=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'LGU PIKIT');$kidapawan=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'LGU-KIDAPAWAN');
    $makilala=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'LGU-MAKILALA');$maip=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MAIP FUND');
    $makmpc=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MAK-MPC');$maxicare=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MAXICARE');
    $mcl=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MCL');$mediatrix=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MEDIATRIX MPC');
    $medicard=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MEDICARD');$medilink=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MEDILINK');
    $mkwd=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MKWD');$mmshi=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MMSHI');
    $muti=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MUTI');$president=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'OFFICE OF THE PRESIDENT');
    $cross=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PACIFIC CROSS');$pcso=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PCSO');
    $penongs=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PENONGS');$pepsi=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PEPSI-COLA');
    $pgi=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PGI CARE');$philcare=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PHILCARE');
    $phic=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PHILHEALTH');$pikitwd=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PIKIT WATER DISTRICT');
    $province=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PROVINCE');$psa=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PSA');
    $sss=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'SSS(SOCIAL SECURITY SYSTEM)');$stacat=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'STA CATALINA');
    $stanfilco=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'STANFILCO');$sunlife=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'SUNLIFE GREPA');
    $ucpb=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'UCPB');$valuecare=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'VALUE CARE');

    foreach($amshi as $item){ $totalamshibegin += $item['hmo']; }
    foreach($asian as $item){ $totalasianbegin += $item['hmo']; }
    foreach($avega as $item){ $totalavegabegin += $item['hmo']; }
    foreach($carehealth as $item){ $totalcarehealthbegin += $item['hmo']; }
    foreach($caritas as $item){ $totalcaritasbegin += $item['hmo']; }
    foreach($cmshi as $item){ $totalcmshibegin += $item['hmo']; }
    foreach($cocolife as $item){ $totalcocolifebegin += $item['hmo']; }
    foreach($tejada as $item){ $totaltejadabegin += $item['hmo']; }
    foreach($cbc as $item){ $totalcbcbegin += $item['hmo']; }
    foreach($cosuceco as $item){ $totalcosucecobegin += $item['hmo']; }
    foreach($cotelco as $item){ $totalcotelcobegin += $item['hmo']; }
    foreach($dbp as $item){ $totaldbpbegin += $item['hmo']; }
    foreach($deped as $item){ $totaldepedbegin += $item['hmo']; }
    foreach($doh as $item){ $totaldohbegin += $item['hmo']; }
    foreach($dswd as $item){ $totaldswdbegin += $item['hmo']; }
    foreach($dxnd as $item){ $totaldxndbegin += $item['hmo']; }
    foreach($eastwest as $item){ $totaleastwestbegin += $item['hmo']; }
    foreach($edc as $item){ $totaledcbegin += $item['hmo']; }
    foreach($emcor as $item){ $totalemcorbegin += $item['hmo']; }
    foreach($balfour as $item){ $totalbalfourbegin += $item['hmo']; }
    foreach($flexicare as $item){ $totalflexicarebegin += $item['hmo']; }
    foreach($fortune as $item){ $totalfortunebegin += $item['hmo']; }
    foreach($generali as $item){ $totalgeneralibegin += $item['hmo']; }
    foreach($gsis as $item){ $totalgsisbegin += $item['hmo']; }
    foreach($insularhealth as $item){ $totalinsularhealthcarebegin += $item['hmo']; }
    foreach($insularlife as $item){ $totalinsularlifebegin += $item['hmo']; }
    foreach($intel as $item){ $totalintelbegin += $item['hmo']; }
    foreach($king as $item){ $totalkingbegin += $item['hmo']; }
    foreach($landbank as $item){ $totallandbankbegin += $item['hmo']; }
    foreach($pikit as $item){ $totalpikitbegin += $item['hmo']; }
    foreach($kidapawan as $item){ $totalkidapawanbegin += $item['hmo']; }
    foreach($makilala as $item){ $totalmakilalabegin += $item['hmo']; }
    foreach($maip as $item){ $totalmaipbegin += $item['hmo']; }
    foreach($makmpc as $item){ $totalmakmpcbegin += $item['hmo']; }
    foreach($maxicare as $item){ $totalmaxicarebegin += $item['hmo']; }
    foreach($mcl as $item){ $totalmclbegin += $item['hmo']; }
    foreach($mediatrix as $item){ $totalmediatrixbegin += $item['hmo']; }
    foreach($medicard as $item){ $totalmedicardbegin += $item['hmo']; }
    foreach($medilink as $item){ $totalmedilinkbegin += $item['hmo']; }
    foreach($mkwd as $item){ $totalmkwdbegin += $item['hmo']; }
    foreach($mmshi as $item){ $totalmmshibegin += $item['hmo']; }
    foreach($muti as $item){ $totalmutibegin += $item['hmo']; }
    foreach($president as $item){ $totalpresidentbegin += $item['hmo']; }
    foreach($cross as $item){ $totalcrossbegin += $item['hmo']; }
    foreach($pcso as $item){ $totalpcsobegin += $item['hmo']; }
    foreach($penongs as $item){ $totalpenongsbegin += $item['hmo']; }
    foreach($pepsi as $item){ $totalpepsibegin += $item['hmo']; }
    foreach($pgi as $item){ $totalpgibegin += $item['hmo']; }
    foreach($philcare as $item){ $totalphilcarebegin += $item['hmo']; }
    foreach($phic as $item){ $totalphicbegin += $item['hmo']; }
    foreach($pikitwd as $item){ $totalpikitwdbegin += $item['hmo']; }
    foreach($province as $item){ $totalprovincebegin += $item['hmo']; }
    foreach($psa as $item){ $totalpsabegin += $item['hmo']; }
    foreach($sss as $item){ $totalsssbegin += $item['hmo']; }
    foreach($stacat as $item){ $totalstacatbegin += $item['hmo']; }
    foreach($stanfilco as $item){ $totalstanfilcobegin += $item['hmo']; }
    foreach($sunlife as $item){ $totalsunlifebegin += $item['hmo']; }
    foreach($ucpb as $item){ $totalucpbbegin += $item['hmo']; }
    foreach($valuecare as $item){ $totalvaluecarebegin += $item['hmo']; }

    $amshi=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'AMSHI');$asian=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'ASIAN LIFE');
    $avega=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'AVEGA');$carehealth=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'CAREHEALTH');
    $caritas=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'CARITAS');$cmshi=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'CMSHI');
    $cocolife=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'COCOLIFE');$tejada=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'CONG. TEJADA MAIP FUND');
    $cbc=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'COOP BANK OF COTABATO');$cosuceco=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'COSUCECO');
    $cotelco=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'COTELCO');$dbp=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'DBP');
    $deped=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'DEPED');
    $doh=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'DOH');$dswd=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'DSWD');
    $dxnd=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'DXND');$eastwest=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'EAST WEST');
    $edc=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'EDC');$emcor=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'EMCOR');
    $balfour=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'FIRST BALFOUR');$flexicare=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'FLEXICARE');
    $fortune=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'FORTUNE CARE');$generali=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'GENERALI');
    $gsis=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'GSIS');$insularhealth=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'INSULAR HEALTHCARE');
    $insularlife=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'INSULAR LIFE');$intel=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'INTELLICARE');
    $king=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'KING COOP');$landbank=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'LANDBANK');
    $pikit=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'LGU PIKIT');$kidapawan=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'LGU-KIDAPAWAN');
    $makilala=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'LGU-MAKILALA');$maip=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MAIP FUND');
    $makmpc=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MAK-MPC');$maxicare=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MAXICARE');
    $mcl=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MCL');$mediatrix=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MEDIATRIX MPC');
    $medicard=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MEDICARD');$medilink=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MEDILINK');
    $mkwd=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MKWD');$mmshi=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MMSHI');
    $muti=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MUTI');$president=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'OFFICE OF THE PRESIDENT');
    $cross=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PACIFIC CROSS');$pcso=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PCSO');
    $penongs=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PENONGS');$pepsi=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PEPSI-COLA');
    $pgi=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PGI CARE');$philcare=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PHILCARE');
    $phic=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PHILHEALTH');$pikitwd=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PIKIT WATER DISTRICT');
    $province=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PROVINCE');$psa=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PSA');
    $sss=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'SSS(SOCIAL SECURITY SYSTEM)');$stacat=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'STA CATALINA');
    $stanfilco=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'STANFILCO');$sunlife=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'SUNLIFE GREPA');
    $ucpb=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'UCPB');$valuecare=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'VALUE CARE');

    foreach($amshi as $item){ $totalamshibegin += $item['amount']; }
    foreach($asian as $item){ $totalasianbegin += $item['amount']; }
    foreach($avega as $item){ $totalavegabegin += $item['amount']; }
    foreach($carehealth as $item){ $totalcarehealthbegin += $item['amount']; }
    foreach($caritas as $item){ $totalcaritasbegin += $item['amount']; }
    foreach($cmshi as $item){ $totalcmshibegin += $item['amount']; }
    foreach($cocolife as $item){ $totalcocolifebegin += $item['amount']; }
    foreach($tejada as $item){ $totaltejadabegin += $item['amount']; }
    foreach($cbc as $item){ $totalcbcbegin += $item['amount']; }
    foreach($cosuceco as $item){ $totalcosucecobegin += $item['amount']; }
    foreach($cotelco as $item){ $totalcotelcobegin += $item['amount']; }
    foreach($dbp as $item){ $totaldbpbegin += $item['amount']; }
    foreach($deped as $item){ $totaldepedbegin += $item['amount']; }
    foreach($doh as $item){ $totaldohbegin += $item['amount']; }
    foreach($dswd as $item){ $totaldswdbegin += $item['amount']; }
    foreach($dxnd as $item){ $totaldxndbegin += $item['amount']; }
    foreach($eastwest as $item){ $totaleastwestbegin += $item['amount']; }
    foreach($edc as $item){ $totaledcbegin += $item['amount']; }
    foreach($emcor as $item){ $totalemcorbegin += $item['amount']; }
    foreach($balfour as $item){ $totalbalfourbegin += $item['amount']; }
    foreach($flexicare as $item){ $totalflexicarebegin += $item['amount']; }
    foreach($fortune as $item){ $totalfortunebegin += $item['amount']; }
    foreach($generali as $item){ $totalgeneralibegin += $item['amount']; }
    foreach($gsis as $item){ $totalgsisbegin += $item['amount']; }
    foreach($insularhealth as $item){ $totalinsularhealthcarebegin += $item['amount']; }
    foreach($insularlife as $item){ $totalinsularlifebegin += $item['amount']; }
    foreach($intel as $item){ $totalintelbegin += $item['amount']; }
    foreach($king as $item){ $totalkingbegin += $item['amount']; }
    foreach($landbank as $item){ $totallandbankbegin += $item['amount']; }
    foreach($pikit as $item){ $totalpikitbegin += $item['amount']; }
    foreach($kidapawan as $item){ $totalkidapawanbegin += $item['amount']; }
    foreach($makilala as $item){ $totalmakilalabegin += $item['amount']; }
    foreach($maip as $item){ $totalmaipbegin += $item['amount']; }
    foreach($makmpc as $item){ $totalmakmpcbegin += $item['amount']; }
    foreach($maxicare as $item){ $totalmaxicarebegin += $item['amount']; }
    foreach($mcl as $item){ $totalmclbegin += $item['amount']; }
    foreach($mediatrix as $item){ $totalmediatrixbegin += $item['amount']; }
    foreach($medicard as $item){ $totalmedicardbegin += $item['amount']; }
    foreach($medilink as $item){ $totalmedilinkbegin += $item['amount']; }
    foreach($mkwd as $item){ $totalmkwdbegin += $item['amount']; }
    foreach($mmshi as $item){ $totalmmshibegin += $item['amount']; }
    foreach($muti as $item){ $totalmutibegin += $item['amount']; }
    foreach($president as $item){ $totalpresidentbegin += $item['amount']; }
    foreach($cross as $item){ $totalcrossbegin += $item['amount']; }
    foreach($pcso as $item){ $totalpcsobegin += $item['amount']; }
    foreach($penongs as $item){ $totalpenongsbegin += $item['amount']; }
    foreach($pepsi as $item){ $totalpepsibegin += $item['amount']; }
    foreach($pgi as $item){ $totalpgibegin += $item['amount']; }
    foreach($philcare as $item){ $totalphilcarebegin += $item['amount']; }
    foreach($phic as $item){ $totalphicbegin += $item['amount']; }
    foreach($pikitwd as $item){ $totalpikitwdbegin += $item['amount']; }
    foreach($province as $item){ $totalprovincebegin += $item['amount']; }
    foreach($psa as $item){ $totalpsabegin += $item['amount']; }
    foreach($sss as $item){ $totalsssbegin += $item['amount']; }
    foreach($stacat as $item){ $totalstacatbegin += $item['hmamounto']; }
    foreach($stanfilco as $item){ $totalstanfilcobegin += $item['amount']; }
    foreach($sunlife as $item){ $totalsunlifebegin += $item['amount']; }
    foreach($ucpb as $item){ $totalucpbbegin += $item['amount']; }
    foreach($valuecare as $item){ $totalvaluecarebegin += $item['amount']; }

}
// if($begdate==$rundate){
// $totalamshibegin=0;$totalasianbegin=0;$totalavegabegin=0;$totalcarehealthbegin=0;$totalcaritasbegin=0;$totalcmshibegin=0;$totalcocolifebegin=0;$totaltejadabegin=0;
// $totalcbcbegin=0;$totalcosucecobegin=0;$totalcotelcobegin=0;$totaldbpbegin=0;$totaldepedbegin=0;$totaldohbegin=0;$totaldswdbegin=0;$totaldxndbegin=0;$totaleastwestbegin=0;
// $totaledcbegin=0;$totalemcorbegin=0;$totalbalfourbegin=0;$totalflexicarebegin=0;$totalfortunebegin=0;$totalgeneralibegin=0;$totalgsisbegin=0;$totalinsularhealthcarebegin=0;
// $totalinsularlifebegin=0;$totalintelbegin=0;$totalkingbegin=0;$totallandbankbegin=0;$totalpikitbegin=0;$totalkidapawanbegin=0;$totalmakilalabegin=0;$totalmaipbegin=0;
// $totalmakmpcbegin=0;$totalmaxicarebegin=0;$totalmclbegin=0;$totalmediatrixbegin=0;$totalmedicardbegin=0;$totalmedicarebegin=0;$totalmedilinkbegin=0;$totalmkwdbegin=0;
// $totalmmshibegin=0;$totalmutibegin=0;$totalpresidentbegin=0;$totalcrossbegin=0;$totalpcsobegin=0;$totalpenongsbegin=0;$totalpepsibegin=0;$totalpgibegin=0;$totalphilcarebegin=0;
// $totalphicbegin=0;$totalpikitwdbegin=0;$totalprovincebegin=0;$totalpsabegin=0;$totalsssbegin=0;$totalstacatbegin=0;$totalstanfilcobegin=0;$totalsunlifebegin=0;$totalucpbbegin=0;
// $totalvaluecarebegin=0;
// }
$totalamountbegincredit = $totalamshibegin+$totalasianbegin+$totalavegabegin+$totalcarehealthbegin+$totalcaritasbegin+$totalcmshibegin+$totalcocolifebegin+$totaltejadabegin+$totalcbcbegin+$totalcosucecobegin+$totalcotelcobegin+$totaldbpbegin+$totaldepedbegin+$totaldohbegin+$totaldswdbegin+$totaldxndbegin+$totaleastwestbegin+$totaledcbegin+$totalemcorbegin+$totalbalfourbegin+$totalflexicarebegin+$totalfortunebegin+$totalgeneralibegin+$totalgsisbegin+$totalinsularhealthcarebegin+$totalinsularlifebegin+$totalintelbegin+$totalkingbegin+$totallandbankbegin+$totalpikitbegin+$totalkidapawanbegin+$totalmakilalabegin+$totalmaipbegin+$totalmakmpcbegin+$totalmaxicarebegin+$totalmclbegin+$totalmediatrixbegin+$totalmedicardbegin+$totalmedicarebegin+$totalmedilinkbegin+$totalmkwdbegin+$totalmmshibegin+$totalmutibegin+$totalpresidentbegin+$totalcrossbegin+$totalpcsobegin+$totalpenongsbegin+$totalpepsibegin+$totalpgibegin+$totalphilcarebegin+$totalphicbegin+$totalpikitwdbegin+$totalprovincebegin+$totalpsabegin+$totalsssbegin+$totalstacatbegin+$totalstanfilcobegin+$totalsunlifebegin+$totalucpbbegin+$totalvaluecarebegin;


$totalamshi=0;$totalasian=0;$totalavega=0;$totalcarehealth=0;$totalcaritas=0;$totalcmshi=0;$totalcocolife=0;$totaltejada=0;$totalcbc=0;$totalcosuceco=0;$totalcotelco=0;
$totaldbp=0;$totaldeped=0;$totaldoh=0;$totaldswd=0;$totaldxnd=0;$totaleastwest=0;$totaledc=0;$totalemcor=0;$totalbalfour=0;$totalflexicare=0;$totalfortune=0;$totalgenerali=0;
$totalgsis=0;$totalinsularhealthcare=0;$totalinsularlife=0;$totalintel=0;$totalking=0;$totallandbank=0;$totalpikit=0;$totalkidapawan=0;$totalmakilala=0;$totalmaip=0;
$totalmakmpc=0;$totalmaxicare=0;$totalmcl=0;$totalmediatrix=0;$totalmedicard=0;$totalmedicare=0;$totalmedilink=0;$totalmkwd=0;$totalmmshi=0;$totalmuti=0;$totalpresident=0;
$totalcross=0;$totalpcso=0;$totalpenongs=0;$totalpepsi=0;$totalpgi=0;$totalphilcare=0;$totalphic=0;$totalpikitwd=0;$totalprovince=0;$totalpsa=0;$totalsss=0;$totalstacat=0;
$totalstanfilco=0;$totalsunlife=0;$totalucpb=0;$totalvaluecare=0;
foreach($body as $list){
    $amshi=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'AMSHI');$asian=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'ASIAN LIFE');
    $avega=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'AVEGA');$carehealth=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'CAREHEALTH');
    $caritas=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'CARITAS');$cmshi=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'CMSHI');
    $cocolife=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'COCOLIFE');$tejada=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'CONG. TEJADA MAIP FUND');
    $cbc=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'COOP BANK OF COTABATO');$cosuceco=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'COSUCECO');
    $cotelco=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'COTELCO');$dbp=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'DBP');
    $deped=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'DEPED');
    $doh=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'DOH');$dswd=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'DSWD');
    $dxnd=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'DXND');$eastwest=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'EAST WEST');
    $edc=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'EDC');$emcor=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'EMCOR');
    $balfour=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'FIRST BALFOUR');$flexicare=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'FLEXICARE');
    $fortune=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'FORTUNE CARE');$generali=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'GENERALI');
    $gsis=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'GSIS');$insularhealth=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'INSULAR HEALTHCARE');
    $insularlife=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'INSULAR LIFE');$intel=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'INTELLICARE');
    $king=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'KING COOP');$landbank=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'LANDBANK');
    $pikit=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'LGU PIKIT');$kidapawan=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'LGU-KIDAPAWAN');
    $makilala=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'LGU-MAKILALA');$maip=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MAIP FUND');
    $makmpc=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MAK-MPC');$maxicare=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MAXICARE');
    $mcl=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MCL');$mediatrix=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MEDIATRIX MPC');
    $medicard=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MEDICARD');$medilink=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MEDILINK');
    $mkwd=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MKWD');$mmshi=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MMSHI');
    $muti=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'MUTI');$president=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'OFFICE OF THE PRESIDENT');
    $cross=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PACIFIC CROSS');$pcso=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PCSO');
    $penongs=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PENONGS');$pepsi=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PEPSI-COLA');
    $pgi=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PGI CARE');$philcare=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PHILCARE');
    $phic=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PHILHEALTH');$pikitwd=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PIKIT WATER DISTRICT');
    $province=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PROVINCE');$psa=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'PSA');
    $sss=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'SSS(SOCIAL SECURITY SYSTEM)');$stacat=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'STA CATALINA');
    $stanfilco=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'STANFILCO');$sunlife=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'SUNLIFE GREPA');
    $ucpb=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'UCPB');$valuecare=$this->Hmo_model->fetch_product_by_allocation($list['caseno'],'VALUE CARE');

    foreach($amshi as $item){ $totalamshi += $item['hmo']; }
    foreach($asian as $item){ $totalasian += $item['hmo']; }
    foreach($avega as $item){ $totalavega += $item['hmo']; }
    foreach($carehealth as $item){ $totalcarehealth += $item['hmo']; }
    foreach($caritas as $item){ $totalcaritas += $item['hmo']; }
    foreach($cmshi as $item){ $totalcmshi += $item['hmo']; }
    foreach($cocolife as $item){ $totalcocolife += $item['hmo']; }
    foreach($tejada as $item){ $totaltejada += $item['hmo']; }
    foreach($cbc as $item){ $totalcbc += $item['hmo']; }
    foreach($cosuceco as $item){ $totalcosuceco += $item['hmo']; }
    foreach($cotelco as $item){ $totalcotelco += $item['hmo']; }
    foreach($dbp as $item){ $totaldbp += $item['hmo']; }
    foreach($deped as $item){ $totaldeped += $item['hmo']; }
    foreach($doh as $item){ $totaldoh += $item['hmo']; }
    foreach($dswd as $item){ $totaldswd += $item['hmo']; }
    foreach($dxnd as $item){ $totaldxnd += $item['hmo']; }
    foreach($eastwest as $item){ $totaleastwest += $item['hmo']; }
    foreach($edc as $item){ $totaledc += $item['hmo']; }
    foreach($emcor as $item){ $totalemcor += $item['hmo']; }
    foreach($balfour as $item){ $totalbalfour += $item['hmo']; }
    foreach($flexicare as $item){ $totalflexicare += $item['hmo']; }
    foreach($fortune as $item){ $totalfortune += $item['hmo']; }
    foreach($generali as $item){ $totalgenerali += $item['hmo']; }
    foreach($gsis as $item){ $totalgsis += $item['hmo']; }
    foreach($insularhealth as $item){ $totalinsularhealthcare += $item['hmo']; }
    foreach($insularlife as $item){ $totalinsularlife += $item['hmo']; }
    foreach($intel as $item){ $totalintel += $item['hmo']; }
    foreach($king as $item){ $totalking += $item['hmo']; }
    foreach($landbank as $item){ $totallandbank += $item['hmo']; }
    foreach($pikit as $item){ $totalpikit += $item['hmo']; }
    foreach($kidapawan as $item){ $totalkidapawan += $item['hmo']; }
    foreach($makilala as $item){ $totalmakilala += $item['hmo']; }
    foreach($maip as $item){ $totalmaip += $item['hmo']; }
    foreach($makmpc as $item){ $totalmakmpc += $item['hmo']; }
    foreach($maxicare as $item){ $totalmaxicare += $item['hmo']; }
    foreach($mcl as $item){ $totalmcl += $item['hmo']; }
    foreach($mediatrix as $item){ $totalmediatrix += $item['hmo']; }
    foreach($medicard as $item){ $totalmedicard += $item['hmo']; }
    foreach($medilink as $item){ $totalmedilink += $item['hmo']; }
    foreach($mkwd as $item){ $totalmkwd += $item['hmo']; }
    foreach($mmshi as $item){ $totalmmshi += $item['hmo']; }
    foreach($muti as $item){ $totalmuti += $item['hmo']; }
    foreach($president as $item){ $totalpresident += $item['hmo']; }
    foreach($cross as $item){ $totalcross += $item['hmo']; }
    foreach($pcso as $item){ $totalpcso += $item['hmo']; }
    foreach($penongs as $item){ $totalpenongs += $item['hmo']; }
    foreach($pepsi as $item){ $totalpepsi += $item['hmo']; }
    foreach($pgi as $item){ $totalpgi += $item['hmo']; }
    foreach($philcare as $item){ $totalphilcare += $item['hmo']; }
    foreach($phic as $item){ $totalphic += $item['hmo']; }
    foreach($pikitwd as $item){ $totalpikitwd += $item['hmo']; }
    foreach($province as $item){ $totalprovince += $item['hmo']; }
    foreach($psa as $item){ $totalpsa += $item['hmo']; }
    foreach($sss as $item){ $totalsss += $item['hmo']; }
    foreach($stacat as $item){ $totalstacat += $item['hmo']; }
    foreach($stanfilco as $item){ $totalstanfilco += $item['hmo']; }
    foreach($sunlife as $item){ $totalsunlife += $item['hmo']; }
    foreach($ucpb as $item){ $totalucpb += $item['hmo']; }
    foreach($valuecare as $item){ $totalvaluecare += $item['hmo']; }

    $amshi=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'AMSHI');$asian=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'ASIAN LIFE');
    $avega=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'AVEGA');$carehealth=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'CAREHEALTH');
    $caritas=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'CARITAS');$cmshi=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'CMSHI');
    $cocolife=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'COCOLIFE');$tejada=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'CONG. TEJADA MAIP FUND');
    $cbc=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'COOP BANK OF COTABATO');$cosuceco=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'COSUCECO');
    $cotelco=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'COTELCO');$dbp=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'DBP');
    $deped=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'DEPED');
    $doh=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'DOH');$dswd=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'DSWD');
    $dxnd=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'DXND');$eastwest=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'EAST WEST');
    $edc=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'EDC');$emcor=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'EMCOR');
    $balfour=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'FIRST BALFOUR');$flexicare=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'FLEXICARE');
    $fortune=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'FORTUNE CARE');$generali=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'GENERALI');
    $gsis=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'GSIS');$insularhealth=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'INSULAR HEALTHCARE');
    $insularlife=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'INSULAR LIFE');$intel=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'INTELLICARE');
    $king=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'KING COOP');$landbank=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'LANDBANK');
    $pikit=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'LGU PIKIT');$kidapawan=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'LGU-KIDAPAWAN');
    $makilala=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'LGU-MAKILALA');$maip=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MAIP FUND');
    $makmpc=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MAK-MPC');$maxicare=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MAXICARE');
    $mcl=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MCL');$mediatrix=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MEDIATRIX MPC');
    $medicard=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MEDICARD');$medilink=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MEDILINK');
    $mkwd=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MKWD');$mmshi=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MMSHI');
    $muti=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'MUTI');$president=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'OFFICE OF THE PRESIDENT');
    $cross=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PACIFIC CROSS');$pcso=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PCSO');
    $penongs=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PENONGS');$pepsi=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PEPSI-COLA');
    $pgi=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PGI CARE');$philcare=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PHILCARE');
    $phic=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PHILHEALTH');$pikitwd=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PIKIT WATER DISTRICT');
    $province=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PROVINCE');$psa=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'PSA');
    $sss=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'SSS(SOCIAL SECURITY SYSTEM)');$stacat=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'STA CATALINA');
    $stanfilco=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'STANFILCO');$sunlife=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'SUNLIFE GREPA');
    $ucpb=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'UCPB');$valuecare=$this->Hmo_model->fetch_product_by_assistance($list['caseno'],'VALUE CARE');

    foreach($amshi as $item){ $totalamshi += $item['amount']; }
    foreach($asian as $item){ $totalasian += $item['amount']; }
    foreach($avega as $item){ $totalavega += $item['amount']; }
    foreach($carehealth as $item){ $totalcarehealth += $item['amount']; }
    foreach($caritas as $item){ $totalcaritas += $item['amount']; }
    foreach($cmshi as $item){ $totalcmshi += $item['amount']; }
    foreach($cocolife as $item){ $totalcocolife += $item['amount']; }
    foreach($tejada as $item){ $totaltejada += $item['amount']; }
    foreach($cbc as $item){ $totalcbc += $item['amount']; }
    foreach($cosuceco as $item){ $totalcosuceco += $item['amount']; }
    foreach($cotelco as $item){ $totalcotelco += $item['amount']; }
    foreach($dbp as $item){ $totaldbp += $item['amount']; }
    foreach($deped as $item){ $totaldeped += $item['amount']; }
    foreach($doh as $item){ $totaldoh += $item['amount']; }
    foreach($dswd as $item){ $totaldswd += $item['amount']; }
    foreach($dxnd as $item){ $totaldxnd += $item['amount']; }
    foreach($eastwest as $item){ $totaleastwest += $item['amount']; }
    foreach($edc as $item){ $totaledc += $item['amount']; }
    foreach($emcor as $item){ $totalemcor += $item['amount']; }
    foreach($balfour as $item){ $totalbalfour += $item['amount']; }
    foreach($flexicare as $item){ $totalflexicare += $item['amount']; }
    foreach($fortune as $item){ $totalfortune += $item['amount']; }
    foreach($generali as $item){ $totalgenerali += $item['amount']; }
    foreach($gsis as $item){ $totalgsis += $item['amount']; }
    foreach($insularhealth as $item){ $totalinsularhealthcare += $item['amount']; }
    foreach($insularlife as $item){ $totalinsularlife += $item['amount']; }
    foreach($intel as $item){ $totalintel += $item['amount']; }
    foreach($king as $item){ $totalking += $item['amount']; }
    foreach($landbank as $item){ $totallandbank += $item['amount']; }
    foreach($pikit as $item){ $totalpikit += $item['amount']; }
    foreach($kidapawan as $item){ $totalkidapawan += $item['amount']; }
    foreach($makilala as $item){ $totalmakilala += $item['amount']; }
    foreach($maip as $item){ $totalmaip += $item['amount']; }
    foreach($makmpc as $item){ $totalmakmpc += $item['amount']; }
    foreach($maxicare as $item){ $totalmaxicare += $item['amount']; }
    foreach($mcl as $item){ $totalmcl += $item['amount']; }
    foreach($mediatrix as $item){ $totalmediatrix += $item['amount']; }
    foreach($medicard as $item){ $totalmedicard += $item['amount']; }
    foreach($medilink as $item){ $totalmedilink += $item['amount']; }
    foreach($mkwd as $item){ $totalmkwd += $item['amount']; }
    foreach($mmshi as $item){ $totalmmshi += $item['amount']; }
    foreach($muti as $item){ $totalmuti += $item['amount']; }
    foreach($president as $item){ $totalpresident += $item['amount']; }
    foreach($cross as $item){ $totalcross += $item['amount']; }
    foreach($pcso as $item){ $totalpcso += $item['amount']; }
    foreach($penongs as $item){ $totalpenongs += $item['amount']; }
    foreach($pepsi as $item){ $totalpepsi += $item['amount']; }
    foreach($pgi as $item){ $totalpgi += $item['amount']; }
    foreach($philcare as $item){ $totalphilcare += $item['amount']; }
    foreach($phic as $item){ $totalphic += $item['amount']; }
    foreach($pikitwd as $item){ $totalpikitwd += $item['amount']; }
    foreach($province as $item){ $totalprovince += $item['amount']; }
    foreach($psa as $item){ $totalpsa += $item['amount']; }
    foreach($sss as $item){ $totalsss += $item['amount']; }
    foreach($stacat as $item){ $totalstacat += $item['amount']; }
    foreach($stanfilco as $item){ $totalstanfilco += $item['amount']; }
    foreach($sunlife as $item){ $totalsunlife += $item['amount']; }
    foreach($ucpb as $item){ $totalucpb += $item['amount']; }
    foreach($valuecare as $item){ $totalvaluecare += $item['amount']; }

}

$totalamountnowcredit = $totalamshi+$totalasian+$totalavega+$totalcarehealth+$totalcaritas+$totalcmshi+$totalcocolife+$totaltejada+$totalcbc+$totalcosuceco+$totalcotelco+$totaldbp+$totaldeped+$totaldoh+$totaldswd+$totaldxnd+$totaleastwest+$totaledc+$totalemcor+$totalbalfour+$totalflexicare+$totalfortune+$totalgenerali+$totalgsis+$totalinsularhealthcare+$totalinsularlife+$totalintel+$totalking+$totallandbank+$totalpikit+$totalkidapawan+$totalmakilala+$totalmaip+$totalmakmpc+$totalmaxicare+$totalmcl+$totalmediatrix+$totalmedicard+$totalmedicare+$totalmedilink+$totalmkwd+$totalmmshi+$totalmuti+$totalpresident+$totalcross+$totalpcso+$totalpenongs+$totalpepsi+$totalpgi+$totalphilcare+$totalphic+$totalpikitwd+$totalprovince+$totalpsa+$totalsss+$totalstacat+$totalstanfilco+$totalsunlife+$totalucpb+$totalvaluecare;

?>
    <?php
    if($totalamshi > 0 || $totalamshibegin > 0){
    ?>
    <tr>
        <td>AMSHI</td>
        <td align="right"><?=number_format($totalamshibegin,2);?></td>
        <td align="right"><?=number_format($totalamshi,2);?></td>
        <td align="right"><?=number_format($totalamshibegin+$totalamshi,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalasian > 0 || $totalasianbegin > 0){
    ?>
    <tr>
        <td>ASIAN LIFE</td>
        <td align="right"><?=number_format($totalasianbegin,2);?></td>
        <td align="right"><?=number_format($totalasian,2);?></td>
        <td align="right"><?=number_format($totalasianbegin+$totalasian,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalavega > 0 || $totalavegabegin > 0){
    ?>
    <tr>
        <td>AVEGA</td>
        <td align="right"><?=number_format($totalavegabegin,2);?></td>
        <td align="right"><?=number_format($totalavega,2);?></td>
        <td align="right"><?=number_format($totalavegabegin+$totalavega,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalcarehealth > 0 || $totalcarehealthbegin > 0){
    ?>
    <tr>
        <td>CAREHEALTH</td>
        <td align="right"><?=number_format($totalcarehealthbegin,2);?></td>
        <td align="right"><?=number_format($totalcarehealth,2);?></td>
        <td align="right"><?=number_format($totalcarehealthbegin+$totalcarehealth,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalcaritas > 0 || $totalcaritasbegin > 0){
    ?>
    <tr>
        <td>CAREHEALTH</td>
        <td align="right"><?=number_format($totalcaritasbegin,2);?></td>
        <td align="right"><?=number_format($totalcaritas,2);?></td>
        <td align="right"><?=number_format($totalcaritasbegin+$totalcaritas,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalcmshi > 0 || $totalcmshibegin > 0){
    ?>
    <tr>
        <td>CMSHI</td>
        <td align="right"><?=number_format($totalcmshibegin,2);?></td>
        <td align="right"><?=number_format($totalcmshi,2);?></td>
        <td align="right"><?=number_format($totalcmshibegin+$totalcmshi,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalcocolife > 0 || $totalcocolifebegin > 0){
    ?>
    <tr>
        <td>COCOLIFE</td>
        <td align="right"><?=number_format($totalcocolifebegin,2);?></td>
        <td align="right"><?=number_format($totalcocolife,2);?></td>
        <td align="right"><?=number_format($totalcocolifebegin+$totalcocolife,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totaltejada > 0 || $totaltejadabegin > 0){
    ?>
    <tr>
        <td>CONG. TEJADA MAIP FUND</td>
        <td align="right"><?=number_format($totaltejadabegin,2);?></td>
        <td align="right"><?=number_format($totaltejada,2);?></td>
        <td align="right"><?=number_format($totaltejadabegin+$totaltejada,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalcbc > 0 || $totalcbcbegin > 0){
    ?>
    <tr>
        <td>COOP BANK OF COTABATO</td>
        <td align="right"><?=number_format($totalcbcbegin,2);?></td>
        <td align="right"><?=number_format($totalcbc,2);?></td>
        <td align="right"><?=number_format($totalcbcbegin+$totalcbc,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalcarehealth > 0 || $totalcarehealthbegin > 0){
    ?>
    <tr>
        <td>CAREHEALTH</td>
        <td align="right"><?=number_format($totalcarehealthbegin,2);?></td>
        <td align="right"><?=number_format($totalcarehealth,2);?></td>
        <td align="right"><?=number_format($totalcarehealthbegin+$totalcarehealth,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalcosuceco > 0 || $totalcosucecobegin > 0){
    ?>
    <tr>
        <td>COSUCECO</td>
        <td align="right"><?=number_format($totalcosucecobegin,2);?></td>
        <td align="right"><?=number_format($totalcosuceco,2);?></td>
        <td align="right"><?=number_format($totalcosucecobegin+$totalcosuceco,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalcotelco > 0 || $totalcotelcobegin > 0){
    ?>
    <tr>
        <td>COTELCO</td>
        <td align="right"><?=number_format($totalcotelcobegin,2);?></td>
        <td align="right"><?=number_format($totalcotelco,2);?></td>
        <td align="right"><?=number_format($totalcotelcobegin+$totalcotelco,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totaldbp > 0 || $totaldbpbegin > 0){
    ?>
    <tr>
        <td>DBP</td>
        <td align="right"><?=number_format($totaldbpbegin,2);?></td>
        <td align="right"><?=number_format($totaldbp,2);?></td>
        <td align="right"><?=number_format($totaldbpbegin+$totaldbp,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totaldeped > 0 || $totaldepedbegin > 0){
    ?>
    <tr>
        <td>DEPED</td>
        <td align="right"><?=number_format($totaldepedbegin,2);?></td>
        <td align="right"><?=number_format($totaldeped,2);?></td>
        <td align="right"><?=number_format($totaldepedbegin+$totaldeped,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totaldoh > 0 || $totaldohbegin > 0){
    ?>
    <tr>
        <td>DOH</td>
        <td align="right"><?=number_format($totaldohbegin,2);?></td>
        <td align="right"><?=number_format($totaldoh,2);?></td>
        <td align="right"><?=number_format($totaldohbegin+$totaldoh,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totaldswd > 0 || $totaldswdbegin > 0){
    ?>
    <tr>
        <td>DSWD</td>
        <td align="right"><?=number_format($totaldswdbegin,2);?></td>
        <td align="right"><?=number_format($totaldswd,2);?></td>
        <td align="right"><?=number_format($totaldswdbegin+$totaldswd,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totaldxnd > 0 || $totaldxndbegin > 0){
    ?>
    <tr>
        <td>DXND</td>
        <td align="right"><?=number_format($totaldxndbegin,2);?></td>
        <td align="right"><?=number_format($totaldxnd,2);?></td>
        <td align="right"><?=number_format($totaldxndbegin+$totaldxnd,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totaleastwest > 0 || $totaleastwestbegin > 0){
    ?>
    <tr>
        <td>EAST WEST</td>
        <td align="right"><?=number_format($totaleastwestbegin,2);?></td>
        <td align="right"><?=number_format($totaleastwest,2);?></td>
        <td align="right"><?=number_format($totaleastwestbegin+$totaleastwest,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totaledc > 0 || $totaledcbegin > 0){
    ?>
    <tr>
        <td>EDC</td>
        <td align="right"><?=number_format($totaledcbegin,2);?></td>
        <td align="right"><?=number_format($totaledc,2);?></td>
        <td align="right"><?=number_format($totaledcbegin+$totaledc,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalemcor > 0 || $totalemcorbegin > 0){
    ?>
    <tr>
        <td>EMCOR</td>
        <td align="right"><?=number_format($totalemcorbegin,2);?></td>
        <td align="right"><?=number_format($totalemcor,2);?></td>
        <td align="right"><?=number_format($totalemcorbegin+$totalemcor,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalbalfour > 0 || $totalbalfourbegin > 0){
    ?>
    <tr>
        <td>FIRST BALFOUR</td>
        <td align="right"><?=number_format($totalbalfourbegin,2);?></td>
        <td align="right"><?=number_format($totalbalfour,2);?></td>
        <td align="right"><?=number_format($totalbalfourbegin+$totalbalfour,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalflexicare > 0 || $totalflexicarebegin > 0){
    ?>
    <tr>
        <td>FLEXICARE</td>
        <td align="right"><?=number_format($totalflexicarebegin,2);?></td>
        <td align="right"><?=number_format($totalflexicare,2);?></td>
        <td align="right"><?=number_format($totalflexicarebegin+$totalflexicare,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalfortune > 0 || $totalfortunebegin > 0){
    ?>
    <tr>
        <td>FORTUNE</td>
        <td align="right"><?=number_format($totalfortunebegin,2);?></td>
        <td align="right"><?=number_format($totalfortune,2);?></td>
        <td align="right"><?=number_format($totalfortunebegin+$totalfortune,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalgenerali > 0 || $totalgeneralibegin > 0){
    ?>
    <tr>
        <td>GENERALI</td>
        <td align="right"><?=number_format($totalgeneralibegin,2);?></td>
        <td align="right"><?=number_format($totalgenerali,2);?></td>
        <td align="right"><?=number_format($totalgeneralibegin+$totalgenerali,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalgsis > 0 || $totalgsisbegin > 0){
    ?>
    <tr>
        <td>GSIS</td>
        <td align="right"><?=number_format($totalgsisbegin,2);?></td>
        <td align="right"><?=number_format($totalgsis,2);?></td>
        <td align="right"><?=number_format($totalgsisbegin+$totalgsis,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalinsularhealthcare > 0 || $totalinsularhealthcarebegin > 0){
    ?>
    <tr>
        <td>INSULAR HEALTHCARE</td>
        <td align="right"><?=number_format($totalinsularhealthcarebegin,2);?></td>
        <td align="right"><?=number_format($totalinsularhealthcare,2);?></td>
        <td align="right"><?=number_format($totalinsularhealthcarebegin+$totalinsularhealthcare,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalinsularlife > 0 || $totalinsularlifebegin > 0){
    ?>
    <tr>
        <td>INSULAR LIFE</td>
        <td align="right"><?=number_format($totalinsularlifebegin,2);?></td>
        <td align="right"><?=number_format($totalinsularlife,2);?></td>
        <td align="right"><?=number_format($totalinsularlifebegin+$totalinsularlife,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalintel > 0 || $totalintelbegin > 0){
    ?>
    <tr>
        <td>INTELLICARE</td>
        <td align="right"><?=number_format($totalintelbegin,2);?></td>
        <td align="right"><?=number_format($totalintel,2);?></td>
        <td align="right"><?=number_format($totalintelbegin+$totalintel,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalking > 0 || $totalkingbegin > 0){
    ?>
    <tr>
        <td>KING COOPERATIVE</td>
        <td align="right"><?=number_format($totalkingbegin,2);?></td>
        <td align="right"><?=number_format($totalking,2);?></td>
        <td align="right"><?=number_format($totalkingbegin+$totalking,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totallandbank > 0 || $totallandbankbegin > 0){
    ?>
    <tr>
        <td>LANDBANK</td>
        <td align="right"><?=number_format($totallandbankbegin,2);?></td>
        <td align="right"><?=number_format($totallandbank,2);?></td>
        <td align="right"><?=number_format($totallandbankbegin+$totallandbank,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalpikit > 0 || $totalpikitbegin > 0){
    ?>
    <tr>
        <td>LGU PIKIT</td>
        <td align="right"><?=number_format($totalpikitbegin,2);?></td>
        <td align="right"><?=number_format($totalpikit,2);?></td>
        <td align="right"><?=number_format($totalpikitbegin+$totalpikit,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalkidapawan > 0 || $totalkidapawanbegin > 0){
    ?>
    <tr>
        <td>LGU KIDAPAWAN</td>
        <td align="right"><?=number_format($totalkidapawanbegin,2);?></td>
        <td align="right"><?=number_format($totalkidapawan,2);?></td>
        <td align="right"><?=number_format($totalkidapawanbegin+$totalkidapawan,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalmakilala > 0 || $totalmakilalabegin > 0){
    ?>
    <tr>
        <td>LGU MAKILALA</td>
        <td align="right"><?=number_format($totalmakilalabegin,2);?></td>
        <td align="right"><?=number_format($totalmakilala,2);?></td>
        <td align="right"><?=number_format($totalmakilalabegin+$totalmakilala,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalmaip > 0 || $totalmaipbegin > 0){
    ?>
    <tr>
        <td>MAIP FUND</td>
        <td align="right"><?=number_format($totalmaipbegin,2);?></td>
        <td align="right"><?=number_format($totalmaip,2);?></td>
        <td align="right"><?=number_format($totalmaipbegin+$totalmaip,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalmakmpc > 0 || $totalmakmpcbegin > 0){
    ?>
    <tr>
        <td>MAKILALA MPC</td>
        <td align="right"><?=number_format($totalmakmpcbegin,2);?></td>
        <td align="right"><?=number_format($totalmakmpc,2);?></td>
        <td align="right"><?=number_format($totalmakmpcbegin+$totalmakmpc,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalmaxicare > 0 || $totalmaxicarebegin > 0){
    ?>
    <tr>
        <td>MAXICARE</td>
        <td align="right"><?=number_format($totalmaxicarebegin,2);?></td>
        <td align="right"><?=number_format($totalmaxicare,2);?></td>
        <td align="right"><?=number_format($totalmaxicarebegin+$totalmaxicare,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalmcl > 0 || $totalmclbegin > 0){
    ?>
    <tr>
        <td>MCL</td>
        <td align="right"><?=number_format($totalmclbegin,2);?></td>
        <td align="right"><?=number_format($totalmcl,2);?></td>
        <td align="right"><?=number_format($totalmclbegin+$totalmcl,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalmediatrix > 0 || $totalmediatrixbegin > 0){
    ?>
    <tr>
        <td>MEDIATRIX MPC</td>
        <td align="right"><?=number_format($totalmediatrixbegin,2);?></td>
        <td align="right"><?=number_format($totalmediatrix,2);?></td>
        <td align="right"><?=number_format($totalmediatrixbegin+$totalmediatrix,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalmedicard > 0 || $totalmedicardbegin > 0){
    ?>
    <tr>
        <td>MEDICARD</td>
        <td align="right"><?=number_format($totalmedicardbegin,2);?></td>
        <td align="right"><?=number_format($totalmedicard,2);?></td>
        <td align="right"><?=number_format($totalmedicardbegin+$totalmedicardbegin,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalmedilink > 0 || $totalmedilinkbegin > 0){
    ?>
    <tr>
        <td>MEDILINK</td>
        <td align="right"><?=number_format($totalmedilinkbegin,2);?></td>
        <td align="right"><?=number_format($totalmedilink,2);?></td>
        <td align="right"><?=number_format($totalmedilinkbegin+$totalmedilink,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalmkwd > 0 || $totalmkwdbegin > 0){
    ?>
    <tr>
        <td>MKWD</td>
        <td align="right"><?=number_format($totalmkwdbegin,2);?></td>
        <td align="right"><?=number_format($totalmkwd,2);?></td>
        <td align="right"><?=number_format($totalmkwdbegin+$totalmkwd,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalmmshi > 0 || $totalmmshibegin > 0){
    ?>
    <tr>
        <td>MMSHI</td>
        <td align="right"><?=number_format($totalmmshibegin,2);?></td>
        <td align="right"><?=number_format($totalmmshi,2);?></td>
        <td align="right"><?=number_format($totalmmshibegin+$totalmmshi,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalmuti > 0 || $totalmutibegin > 0){
    ?>
    <tr>
        <td>MUTI</td>
        <td align="right"><?=number_format($totalmutibegin,2);?></td>
        <td align="right"><?=number_format($totalmuti,2);?></td>
        <td align="right"><?=number_format($totalmutibegin+$totalmuti,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalpresident > 0 || $totalpresidentbegin > 0){
    ?>
    <tr>
        <td>OFFICE OF THE PRESIDENT</td>
        <td align="right"><?=number_format($totalpresidentbegin,2);?></td>
        <td align="right"><?=number_format($totalpresident,2);?></td>
        <td align="right"><?=number_format($totalpresidentbegin+$totalpresident,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalcross > 0 || $totalcrossbegin > 0){
    ?>
    <tr>
        <td>PACIFIC CROSS</td>
        <td align="right"><?=number_format($totalcrossbegin,2);?></td>
        <td align="right"><?=number_format($totalcross,2);?></td>
        <td align="right"><?=number_format($totalcrossbegin+$totalcross,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalpcso > 0 || $totalpcsobegin > 0){
    ?>
    <tr>
        <td>PCSO</td>
        <td align="right"><?=number_format($totalpcsobegin,2);?></td>
        <td align="right"><?=number_format($totalpcso,2);?></td>
        <td align="right"><?=number_format($totalpcsobegin+$totalpcso,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalpenongs > 0 || $totalpenongsbegin > 0){
    ?>
    <tr>
        <td>PENONGS</td>
        <td align="right"><?=number_format($totalpenongsbegin,2);?></td>
        <td align="right"><?=number_format($totalpenongs,2);?></td>
        <td align="right"><?=number_format($totalpenongsbegin+$totalpenongs,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalpepsi > 0 || $totalpepsibegin > 0){
    ?>
    <tr>
        <td>PEPSI-COLA</td>
        <td align="right"><?=number_format($totalpepsibegin,2);?></td>
        <td align="right"><?=number_format($totalpepsi,2);?></td>
        <td align="right"><?=number_format($totalpepsibegin+$totalpepsi,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalpgi > 0 || $totalpgibegin > 0){
    ?>
    <tr>
        <td>PGI CARE</td>
        <td align="right"><?=number_format($totalpgibegin,2);?></td>
        <td align="right"><?=number_format($totalpgi,2);?></td>
        <td align="right"><?=number_format($totalpgibegin+$totalpgi,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalphilcare > 0 || $totalphilcarebegin > 0){
    ?>
    <tr>
        <td>PHILCARE</td>
        <td align="right"><?=number_format($totalphilcarebegin,2);?></td>
        <td align="right"><?=number_format($totalphilcare,2);?></td>
        <td align="right"><?=number_format($totalphilcarebegin+$totalphilcare,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalphic > 0 || $totalphicbegin > 0){
    ?>
    <tr>
        <td>PHIC</td>
        <td align="right"><?=number_format($totalphicbegin,2);?></td>
        <td align="right"><?=number_format($totalphic,2);?></td>
        <td align="right"><?=number_format($totalphicbegin+$totalphic,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalpikitwd > 0 || $totalpikitwdbegin > 0){
    ?>
    <tr>
        <td>PIKIT WATER DISTRICT</td>
        <td align="right"><?=number_format($totalpikitwdbegin,2);?></td>
        <td align="right"><?=number_format($totalpikitwd,2);?></td>
        <td align="right"><?=number_format($totalpikitwdbegin+$totalpikitwd,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalprovince > 0 || $totalprovincebegin > 0){
    ?>
    <tr>
        <td>PROVINCE</td>
        <td align="right"><?=number_format($totalprovincebegin,2);?></td>
        <td align="right"><?=number_format($totalprovince,2);?></td>
        <td align="right"><?=number_format($totalprovincebegin+$totalprovince,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalpsa > 0 || $totalpsabegin > 0){
    ?>
    <tr>
        <td>PSA</td>
        <td align="right"><?=number_format($totalpsabegin,2);?></td>
        <td align="right"><?=number_format($totalpsa,2);?></td>
        <td align="right"><?=number_format($totalpsabegin+$totalpsa,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalsss > 0 || $totalsssbegin > 0){
    ?>
    <tr>
        <td>SSS</td>
        <td align="right"><?=number_format($totalsssbegin,2);?></td>
        <td align="right"><?=number_format($totalsss,2);?></td>
        <td align="right"><?=number_format($totalsssbegin+$totalsss,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalstacat > 0 || $totalstacatbegin > 0){
    ?>
    <tr>
        <td>STA CATALINA</td>
        <td align="right"><?=number_format($totalstacatbegin,2);?></td>
        <td align="right"><?=number_format($totalstacat,2);?></td>
        <td align="right"><?=number_format($totalstacatbegin+$totalstacat,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalstanfilco > 0 || $totalstanfilcobegin > 0){
    ?>
    <tr>
        <td>STANFILCO</td>
        <td align="right"><?=number_format($totalstanfilcobegin,2);?></td>
        <td align="right"><?=number_format($totalstanfilco,2);?></td>
        <td align="right"><?=number_format($totalstanfilcobegin+$totalstanfilco,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalsunlife > 0 || $totalsunlifebegin > 0){
    ?>
    <tr>
        <td>SUNLIFE</td>
        <td align="right"><?=number_format($totalsunlifebegin,2);?></td>
        <td align="right"><?=number_format($totalsunlife,2);?></td>
        <td align="right"><?=number_format($totalsunlifebegin+$totalsunlife,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalucpb > 0 || $totalucpbbegin > 0){
    ?>
    <tr>
        <td>UCPB</td>
        <td align="right"><?=number_format($totalucpbbegin,2);?></td>
        <td align="right"><?=number_format($totalucpb,2);?></td>
        <td align="right"><?=number_format($totalucpbbegin+$totalucpb,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if($totalvaluecare > 0 || $totalvaluecarebegin > 0){
    ?>
    <tr>
        <td>VALUE CARE</td>
        <td align="right"><?=number_format($totalvaluecarebegin,2);?></td>
        <td align="right"><?=number_format($totalvaluecare,2);?></td>
        <td align="right"><?=number_format($totalvaluecarebegin+$totalvaluecare,2);?></td>
    </tr>
    <?php
    }
    ?>
    <?php    
    if($totalamountbegincredit > 0 || $totalamountnowcredit > 0){
    ?>
    <tr>
        <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
        <td align="right"><b>TOTAL</b></td>
        <td align="right"><b><u><?=number_format($totalamountbegincredit,2);?></u></b></td>
        <td align="right"><b><u><?=number_format($totalamountnowcredit,2);?></u></b></td>
        <td align="right"><b><u><?=number_format($totalamountbegincredit+$totalamountnowcredit,2);?></u></b></td>
        <td></td>
    </tr>
    <?php
    }    
    ?>
<tr>
    <td colspan="4"><b>CREDIT</b></td>    
</tr>
<tr>
        <td colspan="4">&nbsp;</td>
    </tr>
<tr>
        <td colspan="4">&nbsp;</td>
    </tr>
<?php    
$begdate=date('Y-m',strtotime($rundate))."-01";
$x=1;
$totallabbegin=0;
$totalxraybegin=0;
$totaleegbegin=0;
$totalecgbegin=0;
$totalutzbegin=0;
$totalctbegin=0;
$totalechobegin=0;
$totalheartbegin=0;
$totalptbegin=0;
$totalmedsbegin=0;
$totalsupbegin=0;
foreach($begin as $list){
    $lab=$this->Hmo_model->fetch_product($list['caseno'],"LABORATORY");
        $xray=$this->Hmo_model->fetch_product($list['caseno'],"XRAY");
        $eegs=$this->Hmo_model->fetch_product($list['caseno'],"EEG");
        $ecgs=$this->Hmo_model->fetch_product($list['caseno'],"ECG");
        $ultra=$this->Hmo_model->fetch_product($list['caseno'],"ULTRASOUND");
        $ctscan=$this->Hmo_model->fetch_product($list['caseno'],"CT SCAN");
        $echos=$this->Hmo_model->fetch_product($list['caseno'],"2D ECHO");
        $hearts=$this->Hmo_model->fetch_product($list['caseno'],"HEARTSTATION");
        $meds=$this->Hmo_model->fetch_product($list['caseno'],"MEDICINE");
        $sups=$this->Hmo_model->fetch_product($list['caseno'],"SUPPLIES");
        $pt=$this->Hmo_model->fetch_product($list['caseno'],"PHYSICAL THERAPY");
        if(!is_numeric($list['addemployer'])){
        foreach($lab as $item){
            $totallabbegin +=$item['hmo'];
        }        
        foreach($xray as $item){
            $totalxraybegin +=$item['hmo'];
        }
        foreach($eegs as $item){
            $totaleegbegin +=$item['hmo'];
        }
        foreach($ecgs as $item){
            $totalecgbegin +=$item['hmo'];
        }
        foreach($ultra as $item){
            $totalutzbegin +=$item['hmo'];
        }
        foreach($ctscan as $item){
            $totalctbegin +=$item['hmo'];
        }
        foreach($echos as $item){
            $totalechobegin +=$item['hmo'];
        }
        foreach($hearts as $item){
            $totalheartbegin +=$item['hmo'];
        }
        foreach($pt as $item){
            $totalptbegin +=$item['hmo'];
        }
        foreach($meds as $item){
            $totalmedsbegin +=$item['hmo'];
        }
        foreach($sups as $item){
            $totalsupbegin +=$item['hmo'];
        }
    }
}
// if($rundate==$begdate){
//     $totallabbegin=0;
//     $totalxraybegin=0;
//     $totaleegbegin=0;
//     $totalecgbegin=0;
//     $totalutzbegin=0;
//     $totalctbegin=0;
//     $totalechobegin=0;
//     $totalheartbegin=0;
//     $totalptbegin=0;
//     $totalmedsbegin=0;
//     $totalsupbegin=0;
// }
// if($rundate==$begdate){
//     $totallabbegin=0;
//     $totalxraybegin=0;
//     $totaleegbegin=0;
//     $totalecgbegin=0;
//     $totalutzbegin=0;
//     $totalctbegin=0;
//     $totalechobegin=0;
//     $totalheartbegin=0;
//     $totalptbegin=0;
//     $totalmedsbegin=0;
//     $totalsupbegin=0;
// }
$totalamountbegin=$totallabbegin+$totalxraybegin+$totaleegbegin+$totalecgbegin+$totalutzbegin+$totalctbegin+$totalechobegin+$totalheartbegin+$totalptbegin+$totalmedsbegin+$totalsupbegin;

$totallab=0;
$totalxray=0;
$totaleeg=0;
$totalecg=0;
$totalutz=0;
$totalct=0;
$totalecho=0;
$totalheart=0;
$totalpt=0;
$totalmeds=0;
$totalsup=0;
    foreach($body as $list){        
        $lab=$this->Hmo_model->fetch_product($list['caseno'],"LABORATORY");
        $xray=$this->Hmo_model->fetch_product($list['caseno'],"XRAY");
        $eegs=$this->Hmo_model->fetch_product($list['caseno'],"EEG");
        $ecgs=$this->Hmo_model->fetch_product($list['caseno'],"ECG");
        $ultra=$this->Hmo_model->fetch_product($list['caseno'],"ULTRASOUND");
        $ctscan=$this->Hmo_model->fetch_product($list['caseno'],"CT SCAN");
        $echos=$this->Hmo_model->fetch_product($list['caseno'],"2D ECHO");
        $hearts=$this->Hmo_model->fetch_product($list['caseno'],"HEARTSTATION");
        $meds=$this->Hmo_model->fetch_product($list['caseno'],"MEDICINE");
        $sups=$this->Hmo_model->fetch_product($list['caseno'],"SUPPLIES");
        $pt=$this->Hmo_model->fetch_product($list['caseno'],"PHYSICAL THERAPY");
        if(!is_numeric($list['addemployer'])){
        foreach($lab as $item){
            $totallab +=$item['hmo'];
        }        
        foreach($xray as $item){
            $totalxray +=$item['hmo'];
        }
        foreach($eegs as $item){
            $totaleeg +=$item['hmo'];
        }
        foreach($ecgs as $item){
            $totalecg +=$item['hmo'];
        }
        foreach($ultra as $item){
            $totalutz +=$item['hmo'];
        }
        foreach($ctscan as $item){
            $totalct +=$item['hmo'];
        }
        foreach($echos as $item){
            $totalecho +=$item['hmo'];
        }
        foreach($hearts as $item){
            $totalheart +=$item['hmo'];
        }
        foreach($pt as $item){
            $totalpt +=$item['hmo'];
        }
        foreach($meds as $item){
            $totalmeds +=$item['hmo'];
        }
        foreach($sups as $item){
            $totalsup +=$item['hmo'];
        }
    }
    }
    $totalamountnow=$totallab+$totalxray+$totaleeg+$totalecg+$totalutz+$totalct+$totalecho+$totalheart+$totalpt+$totalmeds+$totalsup;   
?>    
    <?php
    if($totallabbegin > 0 || $totallab > 0){
    ?>
    <tr>
        <td>LABORATORY</td>
        <td align="right"><?=number_format($totallabbegin,2);?></td>
        <td align="right"><?=number_format($totallab,2);?></td>
        <td align="right"><?=number_format($totallabbegin+$totallab,2);?></td>
    </tr>
    <?php
    }
    if($totalxraybegin > 0 || $totalxray > 0){
    ?>
    <tr>
        <td>XRAY</td>
        <td align="right"><?=number_format($totalxraybegin,2);?></td>
        <td align="right"><?=number_format($totalxray,2);?></td>
        <td align="right"><?=number_format($totalxraybegin+$totalxray,2);?></td>
    </tr>
    <?php
    }
    if($totaleegbegin > 0 || $totaleeg > 0){
    ?>
    <tr>
        <td>EEG</td>
        <td align="right"><?=number_format($totaleegbegin,2);?></td>
        <td align="right"><?=number_format($totaleeg,2);?></td>
        <td align="right"><?=number_format($totaleegbegin+$totaleeg,2);?></td>
    </tr>
    <?php
    }
    if($totalecgbegin > 0 || $totalecg > 0){
    ?>
    <tr>
        <td>ECG</td>
        <td align="right"><?=number_format($totalecgbegin,2);?></td>
        <td align="right"><?=number_format($totalecg,2);?></td>
        <td align="right"><?=number_format($totalecgbegin+$totalecg,2);?></td>
    </tr>
    <?php
    }
    if($totalutzbegin > 0 || $totalutz > 0){
    ?>
    <tr>
        <td>ULTRASOUND</td>
        <td align="right"><?=number_format($totalutzbegin,2);?></td>
        <td align="right"><?=number_format($totalutz,2);?></td>
        <td align="right"><?=number_format($totalutzbegin+$totalutz,2);?></td>
    </tr>
    <?php
    }
    if($totalctbegin > 0 || $totalct > 0){
    ?>
    <tr>
        <td>CT SCAN</td>
        <td align="right"><?=number_format($totalctbegin,2);?></td>
        <td align="right"><?=number_format($totalct,2);?></td>
        <td align="right"><?=number_format($totalctbegin+$totalct,2);?></td>
    </tr>
    <?php
    }
    if($totalechobegin > 0 || $totalecho > 0){
    ?>
    <tr>
        <td>2D ECHO</td>
        <td align="right"><?=number_format($totalechobegin,2);?></td>
        <td align="right"><?=number_format($totalecho,2);?></td>
        <td align="right"><?=number_format($totalechobegin+$totalecho,2);?></td>
    </tr>
    <?php
    }
    if($totalheartbegin > 0 || $totalheart > 0){
    ?>
    <tr>
        <td>HEARTSTATION</td>
        <td align="right"><?=number_format($totalheartbegin,2);?></td>
        <td align="right"><?=number_format($totalheart,2);?></td>
        <td align="right"><?=number_format($totalheartbegin+$totalheart,2);?></td>
    </tr>
    <?php
    }
    if($totalptbegin > 0 || $totalpt > 0){
    ?>
    <tr>
        <td>PHYSICAL THERAPY</td>
        <td align="right"><?=number_format($totalptbegin,2);?></td>
        <td align="right"><?=number_format($totalpt,2);?></td>
        <td align="right"><?=number_format($totalptbegin+$totalpt,2);?></td>
    </tr>
    <?php
    }
    if($totalmedsbegin > 0 || $totalmeds > 0){
    ?>
    <tr>
        <td>MEDICINE</td>
        <td align="right"><?=number_format($totalmedsbegin,2);?></td>
        <td align="right"><?=number_format($totalmeds,2);?></td>
        <td align="right"><?=number_format($totalmedsbegin+$totalmeds,2);?></td>
    </tr>
    <?php
    }
    if($totalsupbegin > 0 || $totalsup > 0){
    ?>
    <tr>
        <td>SUPPLIES</td>
        <td align="right"><?=number_format($totalsupbegin,2);?></td>
        <td align="right"><?=number_format($totalsup,2);?></td>
        <td align="right"><?=number_format($totalsupbegin+$totalsup,2);?></td>
    </tr>
    <?php
    }
    if($totalamountbegin > 0 || $totalamountnow > 0){
    ?>
    <tr>
        <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
        <td align="right"><b>TOTAL</b></td>
        <td align="right"><b><u><?=number_format($totalamountbegin,2);?></u></b></td>
        <td align="right"><b><u><?=number_format($totalamountnow,2);?></u></b></td>
        <td align="right"><b><u><?=number_format($totalamountbegin+$totalamountnow,2);?></u></b></td>
        <td></td>
    </tr>
    <?php
    }    
    ?>
</table>