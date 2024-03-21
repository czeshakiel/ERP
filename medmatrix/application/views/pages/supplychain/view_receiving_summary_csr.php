<div>
<table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:9px;border-collapse:collapse;">
<tr>
        <td align="center" width="5%">Date</td>
        <td align="center" width="4%">RRNo.</td>
        <td align="center" width="8%">Supplier</td>
        <td align="center" width="5%">P.O #</td>
        <td align="center" width="4%">Invoice</td>
        <td align="center" width="5%">Amount<br>AP Trade</td>
        <td align="center" width="5%">Input<br>Tax</td>
        <td align="center" width="5%">Lab<br>Supplies</td>
        <td align="center" width="4%">RAD/USD<br>Supplies</td>
        <td align="center" width="4%">General<br>Supplies</td>
        <td align="center" width="4%">Kit<br>Supplies</td>
        <td align="center" width="5%">Pharma & Surg<br>Supplies</td>
        <td align="center" width="4%">Accountable<br>Forms</td>
        <td align="center" width="4%">Oxygen<br>Supplies</td>
        <td align="center" width="4%">Office<br>Supplies</td>
        <td align="center" width="4%">Dietary<br>Supplies</td>
        <td align="center" width="4%">Laundry<br>Supplies</td>
        <td align="center" width="4%">OR/DR<br>Supplies</td>
        <td align="center" width="4%">Medical<br>Equipment</td>
        <td align="center" width="4%">Handling<br>Fee</td>
        <td align="center" width="4%">Free<br>Goods</td>
        </tr>
<?php
$totalAr=0;$totallab=0;$totalxray=0;$totalkit=0;$totalmed=0;$totaloxygen=0;$totaloffice=0;$totalordr=0;$totalfreegoods=0;
$totalVat=0;$totalhandfee=0;$totalgensup=0;$totalsupp=0;$totalform=0;$totaldiet=0;$totallaundry=0;$totalmedical=0;
$artrade=0;
foreach($items as $item){
  $trade=0;
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
    $lab=$this->Purchase_model->checkAmount($item['rrno'],'LABORATORY SUPPLIES','LABORATORY SUPPLIES','LABORATORY SUPPLIES',$trantype,$datefrom,$dateto);
    $xray=$this->Purchase_model->checkAmount($item['rrno'],'XRAY SUPPLIES','ULTRASOUND SUPPLIES','XRAY SUPPLIES',$trantype,$datefrom,$dateto);
    $gensup=$this->Purchase_model->checkAmount($item['rrno'],'GENERAL SUPPLIES','GENERAL SUPPLIES','GENERAL SUPPLIES',$trantype,$datefrom,$dateto);
    $kit=$this->Purchase_model->checkAmount($item['rrno'],'CSR/KIT SUPPLIES','CSR/KIT SUPPLIES','CSR/KIT SUPPLIES',$trantype,$datefrom,$dateto);
    $supp=$this->Purchase_model->checkAmount($item['rrno'],'PHARMACY/SUPPLIES','MEDICAL SURGICAL SUPPLIES','MEDICAL SURGICAL CSR',$trantype,$datefrom,$dateto);
    $form=$this->Purchase_model->checkAmount($item['rrno'],'ACCOUNTABLE FORMS','ACCOUNTABLE FORMS','ACCOUNTABLE FORMS',$trantype,$datefrom,$dateto);
    $oxygen=$this->Purchase_model->checkAmount($item['rrno'],'OXYGEN SUPPLIES','OXYGEN SUPPLIES','OXYGEN SUPPLIES',$trantype,$datefrom,$dateto);
    $office=$this->Purchase_model->checkAmount($item['rrno'],'OFFICE-SUPPLIES','OFFICE-SUPPLIES','OFFICE-SUPPLIES',$trantype,$datefrom,$dateto);
    $diet=$this->Purchase_model->checkAmount($item['rrno'],'DIETARY','DIETARY','DIETARY',$trantype,$datefrom,$dateto);
    $laundry=$this->Purchase_model->checkAmount($item['rrno'],'LAUNDRY','LAUNDRY','LAUNDRY',$trantype,$datefrom,$dateto);
    $ordr=$this->Purchase_model->checkAmount($item['rrno'],'OR/DR SUPPLIES','OR/DR SUPPLIES','OR/DR SUPPLIES',$trantype,$datefrom,$dateto);
    $medical=$this->Purchase_model->checkAmount($item['rrno'],'MEDICAL EQUIPMENT','MEDICAL EQUIPMENT','MEDICAL EQUIPMENT',$trantype,$datefrom,$dateto);
    $freegoods=$this->Purchase_model->checkAmountFreeGoods($item['rrno'],'FREE GOODS',$datefrom,$dateto);
    $totalAr += $artrade;
    $totalVat += $vat;

    $totalhandfee += $handfee;
    $totallab += $lab;
    $totalxray += $xray;
    $totalgensup += $gensup;
    $totalkit += $kit;
    $totalsupp += $supp;
    $totalform +=$form;
    $totaloxygen +=$oxygen;
    $totaloffice +=$office;
    $totaldiet +=$diet;
    $totallaundry +=$laundry;
    $totalordr += $ordr;
    $totalmedical +=$medical;
    $totalfreegoods +=$freegoods;
?>
    <tr>
        <td align="left" width="5%"><?=$item['date'];?></td>
        <td align="left" width="4%"><?=$item['rrno'];?></td>
        <td align="left" width="8%"><?=$item['suppliername'];?></td>
        <td align="center" width="5%"><?=$item['po'];?></td>
        <td align="center" width="4%"><?=$item['invno'];?></td>
        <td align="right" width="6%"><?=number_format($artrade,2);?></td>
        <td align="right" width="4%"><?=number_format($vat,2);?></td>
        <td align="right" width="4%"><?=number_format($lab,2);?></td>
        <td align="right" width="4%"><?=number_format($xray,2);?></td>
        <td align="right" width="4%"><?=number_format($gensup,2);?></td>
        <td align="right" width="4%"><?=number_format($kit,2);?></td>
        <td align="right" width="4%"><?=number_format($supp,2);?></td>
        <td align="right" width="4%"><?=number_format($form,2);?></td>
        <td align="right" width="4%"><?=number_format($oxygen,2);?></td>
        <td align="right" width="4%"><?=number_format($office,2);?></td>
        <td align="right" width="4%"><?=number_format($diet,2);?></td>
        <td align="right" width="4%"><?=number_format($laundry,2);?></td>
        <td align="right" width="4%"><?=number_format($ordr,2);?></td>
        <td align="right" width="4%"><?=number_format($medical,2);?></td>
        <td align="right" width="4%"><?=number_format($handfee,2);?></td>
        <td align="right" width="4%"><?=number_format($freegoods,2);?></td>
    </tr>
    <?php
    }
    ?>
    <tr>
        <td colspan="21">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5"><b>TOTAL</b></td>
        <td align="right"><?=number_format($totalAr,2);?></td>
        <td align="right"><?=number_format($totalVat,2);?></td>
        <td align="right"><?=number_format($totallab,2);?></td>
        <td align="right"><?=number_format($totalxray,2);?></td>
        <td align="right"><?=number_format($totalgensup,2);?></td>
        <td align="right"><?=number_format($totalkit,2);?></td>
        <td align="right"><?=number_format($totalsupp,2);?></td>
        <td align="right"><?=number_format($totalform,2);?></td>
        <td align="right"><?=number_format($totaloxygen,2);?></td>
        <td align="right"><?=number_format($totaloffice,2);?></td>
        <td align="right"><?=number_format($totaldiet,2);?></td>
        <td align="right"><?=number_format($totallaundry,2);?></td>
        <td align="right"><?=number_format($totalordr,2);?></td>
        <td align="right"><?=number_format($totalmedical,2);?></td>
        <td align="right"><?=number_format($totalhandfee,2);?></td>
        <td align="right"><?=number_format($totalfreegoods,2);?></td>
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