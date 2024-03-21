<div>
<table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:11px;border-bottom:0; border-collapse: collapse;">
<?php
$x=1;
foreach($items as $item){
    $desc=str_replace('ams-','',$item['description']);
    $desc=str_replace('cmshi-','',$desc);
    $desc=str_replace('-med','',$desc);
    $desc=str_replace('-sup','',$desc);
    $code=str_replace('kmsci-34-m-','',$item['code']);
    $code=str_replace('-n','',$code);
    $code=str_replace('-p','',$code);
    $expiration=$this->Purchase_model->getExpiration($item['code'],$item['rrno']);
    if($item['generic']==""){
      $generic="";
    }else{
      $generic=" <font color='red'>(".$item['generic'].")</font>";
    }
?>
    <tr>
        <td witdh="5%" align="center" style="border-bottom:1px solid black;"><?=$x;?>.</td>
        <td width="55%" style="border-bottom:1px solid black;"><?=$desc;?><?=$generic;?></td>
        <td width="15%" align="center" style="border-bottom:1px solid black;"><?=$expiration['expiration'];?></td>
        <td width="5%" align="center" style="border-bottom:1px solid black;"><?=$item['quantity'];?></td>
        <td width="10%" align="center" style="border-bottom:1px solid black;"></td>
        <td width="10%" align="center" style="border-bottom:1px solid black;"></td>
    </tr>
    <?php
    $x++;
}
    ?>
</table>
</div>
