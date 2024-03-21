<table width="100%" border="1" cellspacing="0" cellpadding="2" style="border-collapse: collapse; font-size: 11px;">
    <tr>
        <td width="10%" align="center">DATE</td>
        <td align="center">PATIENT NAME</td>
        <td align="center">INSURANCE</td>
        <td align="center">CONTROL NO</td>        
        <td align="center">LABORATORY PERFORMED</td>
        <td align="center">AMOUNT</td>
        <td align="center">MEDS</td>
        <td align="center">TOTAL</td>
    </tr>
<?php    
$x=1;
$totalcharges=0;
$totalmeds=0;
$totalamount=0;
    foreach($body as $list){      
        $cn=explode('-',$list['employerno']);
        if(count($cn)>1){
            $case="NC";
        }else{
            $case=$list['employerno'];
        }
        if($list['hmo']=="N/A" || $list['hmo']==""){
            $hmo=$list['addemployer'];
        }else{
            $hmo=$list['hmo'];
        }
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
            echo "<tr>";
                echo "<td>".date('m/d/Y',strtotime($rundate))."</td>";                
                echo "<td style='text-transform:capitalize;'>$list[lastname], $list[firstname] $list[suffix]</td>";           
                echo "<td style='text-transform:uppercase;'>$hmo</td>";             
                echo "<td align='center'>".$case."</td>";                
                echo "<td>";
                $charges=0;
                foreach($lab as $item){
                    echo $item['productdesc']."(".number_format($item['hmo'],0)."),";
                    $charges +=$item['hmo'];
                }
                foreach($pt as $item){
                    echo $item['productdesc']."(".number_format($item['hmo'],0)."),";
                    $charges +=$item['hmo'];
                }
                foreach($xray as $item){
                    echo $item['productdesc']."(".number_format($item['hmo'],0)."),";
                    $charges +=$item['hmo'];
                }
                foreach($eegs as $item){
                    echo $item['productdesc']."(".number_format($item['hmo'],0)."),";
                    $charges +=$item['hmo'];
                }
                foreach($ecgs as $item){
                    echo $item['productdesc']."(".number_format($item['hmo'],0)."),";
                    $charges +=$item['hmo'];
                }
                foreach($ultra as $item){
                    echo $item['productdesc']."(".number_format($item['hmo'],0)."),";
                    $charges +=$item['hmo'];
                }
                foreach($ctscan as $item){
                    echo $item['productdesc']."(".number_format($item['hmo'],0)."),";
                    $charges +=$item['hmo'];
                }
                foreach($echos as $item){
                    echo $item['productdesc']."(".number_format($item['hmo'],0)."),";
                    $charges +=$item['hmo'];
                }
                foreach($hearts as $item){
                    echo $item['productdesc']."(".number_format($item['hmo'],0)."),";
                    $charges +=$item['hmo'];
                }

               
                $medicine=0;
                foreach($meds as $item){
                    echo $item['productdesc']."(".number_format($item['hmo'],0)."),";
                    $medicine +=$item['hmo'];
                }
                 foreach($sups as $item){
                    echo $item['productdesc']."(".number_format($item['hmo'],0)."),";
                    $medicine +=$item['hmo'];
                }
                if($charges==0 && $medicine==0){
                    echo "PF ONLY";
                }
                echo "</td>";
                echo "<td align='right'>".number_format($charges,2)."</td>";
                echo "<td align='right'>".number_format($medicine,2)."</td>";
                echo "<td align='right'>".number_format($charges+$medicine,2)."</td>";
            echo "</tr>";
            $x++;  
            $totalcharges +=$charges;
            $totalmeds +=$medicine;
            $totalamount +=$charges+$medicine;      
        }
    }   
?>
    <tr>
        <td colspan="8" style="border:0;">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5" align="right" style="border:0;"><b>TOTAL</b></td>
        <td align="right" style="border:0;"><b><u><?=number_format($totalcharges,2);?></u></b></td>
        <td align="right" style="border:0;"><b><u><?=number_format($totalmeds,2);?></u></b></td>
        <td align="right" style="border:0;"><b><u><?=number_format($totalamount,2);?></u></b></td>
    </tr>
</table>