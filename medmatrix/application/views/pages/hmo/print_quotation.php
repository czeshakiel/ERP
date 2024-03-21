<?php
$labs=0;
$meds=0;
$type=$this->Hmo_model->checkQuotationType($caseno);
foreach($type as $item){
    if($item['unit']=="CT SCAN" || $item['unit']=="HEARTSTATION" || $item['unit']=="LABORATORY" || $item['unit']=="ULTRASOUND" || $item['unit']=="XRAY"){
        $labs++;
    }
    if($item['unit']=="PHARMACY/MEDICINE" || $item['unit']=="PHARMACY/SUPPLIES" || $item['unit']=="SUPPLIES"){
        $meds++;
    }
}
$remarks="";
if($labs>0 && $meds > 0){
    $remarks="LABORATORIES AND MEDICINE/SUPPLIES";
}else
if($labs>0 && $meds==0){
    $remarks="LABORATORIES";
}else if($labs==0 && $meds > 0){
    $remarks="MEDICINE/SUPPLIES";
}
?>
<br>
<b><?=$datenow;?></b>
<p>SIR/MADAM</p>
<p>Patient <?=$pat['lastname'];?>, <?=$pat['firstname'];?> <?=$pat['middlename'];?> price quotation for <?=$remarks;?>.</p>
<br>
<table border="0" cellspacing="0" cellpadding="1" width="100%">
    <tr>
        <td><b>ITEM DESCRIPTION</b></td>
        <td align="center"><b>QUANTITY</b></td>
        <td align="right"><b>AMOUNT</b></td>
        <td align="right"><b>TOTAL</b></td>
    </tr>
    <tr>
        <td colspan="4" align="">&nbsp;</td>
    </tr>
    <?php
    $total=0;
    $totalcash=0;
    $totalpharma=0;
    foreach($items as $item){
        $check=$this->Hmo_model->db->query("SELECT unit FROM receiving WHERE code='$item[productcode]'");
        $type=$check->row_array();
        if($type['unit']=="PHARMACY/MEDICINE" || $type['unit']=="PHARMACY/SUPPLIES" || $type['unit']=="SUPPLIES"){
            $unitcost=$item['price_charge'];
            $totaldue=$unitcost*$item['quantity'];
            $totalduecash=$item['price_cash']*$item['quantity'];
            $totalpharma +=$totaldue;
          }else{
            $unitcost=$item['price_cash'];
            $totaldue=$unitcost*$item['quantity'];
            $totalduecash=0;
          }
          $total +=$totaldue;
          $totalcash +=$totalduecash;
        echo "<tr>";
            echo "<td>$item[productdesc]</td>";
            echo "<td align='center'>$item[quantity]</td>";
            echo "<td align='right'>".number_format($unitcost,2)."</td>";
            echo "<td align='right'>".number_format($totaldue,2)."</td>";
        echo "</tr>";
    }
    ?>
    <tr>
         <td colspan="4">&nbsp;</td>
       </tr>
       <tr>
         <td colspan="4">&nbsp;</td>
       </tr>
       <tr>
         <td colspan="3" align="right">
           <b>SUB TOTAL:</b>
         </td>
         <td align="right">
           <?=number_format($total,2);?>
         </td>
       </tr>
       <tr>
         <td colspan="4">&nbsp;</td>
       </tr>
       <tr>
         <td colspan="3" align="right">
           <b>DISCOUNT:</b>
         </td>
         <td align="right">
           <?=number_format($totalpharma-$totalcash,2);?>
         </td>
       </tr>
       <tr>
         <td colspan="4">&nbsp;</td>
       </tr>
       <tr>
         <td colspan="3" align="right">
           <b>TOTAL DUE:</b>
         </td>
         <td align="right">
           <?=number_format($total-($totalpharma-$totalcash),2);?>
         </td>
       </tr>
</table>