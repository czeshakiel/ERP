<div>
<table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:10px;border-bottom:0;border-collapse: collapse;">
<?php
$x=1;
$totalamount=0;
foreach($items as $item){
    $desc=str_replace('ams-','',$item['description']);
    $desc=str_replace('cmshi-','',$desc);
    $desc=str_replace('-med','',$desc);
    $desc=str_replace('-sup','',$desc);
    $code=str_replace('kmsci-34-m-','',$item['code']);
    $code=str_replace('-n','',$code);
    $code=str_replace('-p','',$code);
    $code=str_replace('-48','',$code);
    $code=str_replace('SP','',$code);
    $code=str_replace('n','',$code);
    $code=str_replace('p','',$code);
    $expiration=$this->Purchase_model->getExpiration($item['code'],$item['rrno']);
    $uc=$this->Purchase_model->getUnitCost($item['code']);
    if($uc['unitcost']==""){
      $unitcost=$item['unitcost'];
    }else{
      $unitcost=$uc['unitcost'];
    }
    $disc=$this->Purchase_model->getDiscount($item['code']);
    if($disc['prodtype1']=="" || $disc['prodtype1']==0 || $disc['prodtype1']==$unitcost){
    }else{
      $unitcost=$disc['prodtype1'];
    }
    if($unitcost==0){
      $unitcost=$item['capital'];
    }
    $vat=$disc['stockalert']; 
    $unitcost=$unitcost-$vat;
    $total = ($unitcost)*$item['quantity'];
    $totalamount +=$total;
    if($item['generic']==""){
      $generic="";
    }else{
      $generic="";
      $generic=" <font color='red'>(".$item['generic'].")</font>";
    }
    if($item['quantity'] > 0){
?>
    <tr>
        <td witdh="5%" align="center" style="border-bottom:1px solid black;"><?=$x;?>.</td>
        <td width="62%" style="border-bottom:1px solid black;"><?=$desc;?><?=$generic;?></td>
        <td width="10%" align="center" style="border-bottom:1px solid black;"><?=$expiration['expiration'];?></td>
        <td width="5%" align="center" style="border-bottom:1px solid black;"><?=$item['quantity'];?></td>
        <td width="8%" align="right" style="border-bottom:1px solid black;"><?=number_format($unitcost,2);?></td>
        <td width="10%" align="right" style="border-bottom:1px solid black;"><?=number_format($total,2);?></td>
    </tr>
    <?php    
    $x++;
  }
}
    ?>
</table>
<br><br>
<table width="100%" border="0" cellspacing="1" cellpadding="1" style="font-family:Arial;font-size:11px;border-bottom:0;">
<tr>
    <td colspan="5">TOTAL</td>
    <td align="right"><?=number_format($totalamount,2);?></td>
</tr>
</table>
</div>
