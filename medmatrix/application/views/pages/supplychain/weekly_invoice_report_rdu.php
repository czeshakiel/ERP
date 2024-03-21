<div>
<table width="100%" border="1" cellspacing="0" cellpadding="0" style="font-family:Arial;font-size:12px;border-collapse:collapse;">
<tr>
        <td align="center" width="7%"><b>Date</b></td>
        <td align="center" width="10%"><b>RRNo.</b></td>
        <td align="center" width="10%"><b>Invoice</b></td>
        <td align="center" width="30%"><b>Supplier</b></td>                
        <td align="center" width="10%"><b>Amount</b></td>        
        </tr>
<?php
$totalAr=0;$totallab=0;$totalxray=0;$totalkit=0;$totalmed=0;$totaloxygen=0;$totaloffice=0;$totalordr=0;$totalfreegoods=0;
$totalVat=0;$totalhandfee=0;$totalgensup=0;$totalsupp=0;$totalform=0;$totaldiet=0;$totallaundry=0;$totalmedical=0;
$totalNet=0;
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
    $freegoods=$this->Purchase_model->checkAmountFreeGoods($item['rrno'],'FREE GOODS',$datefrom,$dateto);
    $net= $artrade-$vat;
    $totalAr += $artrade;
    $totalVat += $vat;
    $totalNet +=$net;
    $totalfreegoods +=$freegoods;
    if($artrade>0){
?>
    <tr>
        <td align="left" width="5%"><?=$item['date'];?></td>
        <td align="left" width="4%"><?=$item['rrno'];?></td>
        <td align="center" width="4%"><?=$item['invno'];?></td>
        <td align="left" width="8%"><?=$item['suppliername'];?></td>                
        <td align="right" width="4%"><?=number_format($artrade,2);?></td>        
    </tr>
    <?php
}
    }
    ?>
    <tr>
        <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="4"><b>TOTAL</b></td>
        <td align="right"><?=number_format($totalAr,2);?></td>        
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