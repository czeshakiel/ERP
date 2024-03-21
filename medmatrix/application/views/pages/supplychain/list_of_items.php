<div>
<table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:11px;border-bottom:0; border-collapse: collapse;">
<?php
    if(count($items_meds)>0){
?>
    <tr>
        <td colspan="5"><b>MEDICINE</b></td>
    </tr>
<?php
$x=1;
foreach($items_meds as $item){
    $desc=str_replace('ams-','',$item['description']);
    $desc=str_replace('cmshi-','',$desc);
    $desc=str_replace('-med','',$desc);
    $desc=str_replace('-sup','',$desc);
    $code=str_replace('kmsci-34-m-','',$item['code']);
    $code=str_replace('-n','',$code);
    $code=str_replace('-p','',$code);    
    if($item['generic']==""){
      $generic="";
    }else{
      $generic=" <font color='red'>(".$item['generic'].")</font>";
    }
    $cost=$this->Purchase_model->getUnitCostByItem($item['code'],$item['suppliercode']);
?>
    <tr>
        <td witdh="5%" align="center" style="border-bottom:1px solid black;"><?=$x;?>.</td>
        <td width="50%" style="border-bottom:1px solid black;"><?=$desc;?><?=$generic;?></td>
        <td width="25%" align="center" style="border-bottom:1px solid black;"><?=$item['suppliername'];?></td>        
        <td width="10%" align="right" style="border-bottom:1px solid black;"><?=number_format($cost['unitcost'],2);?></td>
        <td width="10%" align="right" style="border-bottom:1px solid black;"><?=number_format($cost['prodtype1'],2);?></td>
    </tr>
    <?php
    $x++;
}
}
    ?>
    <?php
    if(count($items_meds)>0){
?>
    <tr>
        <td colspan="5"><b>SUPPPLIES</b></td>
    </tr>
<?php
$x=1;
foreach($items_sup as $item){
    $desc=str_replace('ams-','',$item['description']);
    $desc=str_replace('cmshi-','',$desc);
    $desc=str_replace('-med','',$desc);
    $desc=str_replace('-sup','',$desc);
    $code=str_replace('kmsci-34-m-','',$item['code']);
    $code=str_replace('-n','',$code);
    $code=str_replace('-p','',$code);    
    if($item['generic']==""){
      $generic="";
    }else{
      $generic=" <font color='red'>(".$item['generic'].")</font>";
    }
    $cost=$this->Purchase_model->getUnitCostByItem($item['code'],$item['suppliercode']);
?>
    <tr>
        <td witdh="5%" align="center" style="border-bottom:1px solid black;"><?=$x;?>.</td>
        <td width="50%" style="border-bottom:1px solid black;"><?=$desc;?><?=$generic;?></td>
        <td width="25%" align="center" style="border-bottom:1px solid black;"><?=$item['suppliername'];?></td>        
        <td width="10%" align="right" style="border-bottom:1px solid black;"><?=number_format($cost['unitcost'],2);?></td>
        <td width="10%" align="right" style="border-bottom:1px solid black;"><?=number_format($cost['prodtype1'],2);?></td>
    </tr>
    <?php
    $x++;
}
}
    ?>
</table>
</div>
