<div>
<table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;border-collapse:collapse;">
<tr>
        <td align="center" width="7%">Date</td>
        <td align="center" width="7%">RR#</td>
        <td align="center" width="7%">P.O #</td>
        <td align="center" width="6%">SI#</td>
        <td align="center" width="30%">Supplier</td>        
        <!-- <td align="center" width="8%">Amount<br>AP Trade</td>
        <td align="center" width="7%">Input<br>Tax</td> -->        
        <td align="center" width="5%">MEDICINE</td>
        <td align="center" width="7%">FG-MEDS</td>        
        <td align="center" width="7%">MEDSUP</td>
        <td align="center" width="7%">FG-SUPP</td>
        <td align="center" width="4%">AMOUNT</td>
        </tr>
<?php
$totalAr=0;$totallab=0;$totalxray=0;$totalkit=0;$totalmed=0;$totaloxygen=0;$totaloffice=0;$totalordr=0;$totalfreegoodsSupplies=0;$totalfreegoodsMedicine=0;
$totalVat=0;$totalhandfee=0;$totalgensup=0;$totalsupp=0;$totalform=0;$totaldiet=0;$totallaundry=0;$totalmedical=0;
$artrade=0;$totaltrade=0;$grandtotaltrade=0;
foreach($items as $item){    
  $trade=0;
  // if($item['ARTradeDisc'] > 0){
  //   $trade=$item['ARTradeDisc'];
  // }else{
  //   $trade=$item['ARTrade'];
  // }
//if($item['leadtime']  "hosp"){
$ar=$this->Purchase_model->getAllPOReceivedAmount($item['rrno'],$item['invno'],$item['po'],$trantype);
$trade=$ar;

    if($item['suppliername']=="KMSCI CSR"){
        $artrade=$trade*1.01;
        $handfee=$trade*.01;
    }else{
        $artrade=$trade;
        $handfee=0;
    }
    $vat=$this->Purchase_model->checkVat($item['rrno']);

    $supp=$this->Purchase_model->checkAmount($item['rrno'],'PHARMACY/SUPPLIES','MEDICAL SURGICAL SUPPLIES','MEDICAL SURGICAL CSR',$trantype,$datefrom,$dateto);
    $med=$this->Purchase_model->checkAmount($item['rrno'],'PHARMACY/MEDICINE','PHARMACY/MEDICINE','PHARMACY/MEDICINE',$trantype,$datefrom,$dateto);
    $freegoodsSupplies=$this->Purchase_model->checkAmount($item['rrno'],'PHARMACY/SUPPLIES','MEDICAL SURGICAL SUPPLIES','MEDICAL SURGICAL CSR','FREE GOODS',$datefrom,$dateto);
    $freegoodsMedicine=$this->Purchase_model->checkAmount($item['rrno'],'PHARMACY/MEDICINE','PHARMACY/MEDICINE','PHARMACY/MEDICINE','FREE GOODS',$datefrom,$dateto);
    $totalAr += $artrade;
    $totalVat += $vat;

    $totalhandfee += $handfee;
    $totalsupp += $supp;
    $totalmed += $med;
    $totalfreegoodsSupplies +=$freegoodsSupplies;
    $totalfreegoodsMedicine +=$freegoodsMedicine;
    if($item['invno']==""){
        $invno="";
    }else{
        $invno=$item['invno'];
    }
    $invno=str_replace('CPU-','',$invno);
    $rrno=str_replace('RRN','',$item['rrno']);
    $totaltrade = $artrade+$freegoodsMedicine+$freegoodsSupplies;
    $grandtotaltrade += $totaltrade;
?>
    <tr>
        <td align="left" width="5%"><?=date('m/d/Y',strtotime($item['date']));?></td>
        <td align="left" width="8%"><?=$rrno;?></td>
        <td align="center" width="5%"><?=$item['po'];?></td>
        <td align="center" width="7%"><?=$invno;?></td>
        <td align="left" width="20%"><?=$item['suppliername'];?></td>        
        <!-- <td align="right" width="5%"><?=number_format($artrade,2);?></td>
        <td align="right" width="5%"><?=number_format($vat,2);?></td> -->        
        <td align="right" width="5%"><?=number_format($med,2);?></td>
        <td align="right" width="5%"><?=number_format($freegoodsMedicine,2);?></td>        
        <td align="right" width="5%"><?=number_format($supp+$vat,2);?></td>
        <td align="right" width="5%"><?=number_format($freegoodsSupplies,2);?></td>
        <td align="right"><?=number_format($totaltrade,2);?></td>
    </tr>
    <?php
//}
    }
    ?>
    <tr>
        <td colspan="10">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5"><b>TOTAL</b></td>
        <!-- <td align="right"><?=number_format($totalAr,2);?></td>
        <td align="right"><?=number_format($totalVat,2);?></td> -->        
        <td align="right"><?=number_format($totalmed,2);?></td>
        <td align="right"><?=number_format($totalfreegoodsMedicine,2);?></td>        
        <td align="right"><?=number_format($totalsupp+$totalVat,2);?></td>
        <td align="right"><?=number_format($totalfreegoodsSupplies,2);?></td>
        <td align="right"><?=number_format($grandtotaltrade,2);?></td>
    </tr>
</table>
</div>
<br><br>
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;">
    <tr>
        <td><b>Prepared by:</b></td>
        <td><b>Checked by:</b></td>
        <td><b>Received by:</b></td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td><b><u><?=$this->session->fullname;?></u></b></td>
        <td><b><u>JIHAN S. KUSAIN, RPh</u></b></td>
        <td><b><u>MEHRALYN L. TORCULAS</u></b></td>
    </tr>
    <tr>
        <td><b>CPU Staff</b></td>
        <td><b>CPU Head</b></td>
        <td><b>Accounting</b></td>
    </tr>
</table>
</div>
