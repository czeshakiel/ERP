<table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse: collapse; font-size: 12px;">
    <tr>
        <td width="10%" align="center">DATE</td>
        <td align="center">CASENO</td>
        <td align="center">PATIENT NAME</td>
        <td align="center">LABORATORY PERFORMED</td>
    </tr>
<?php    
$x=1;
    foreach($body as $list){      
        $lab=$this->Hmo_model->fetch_product($list['caseno'],"LABORATORY");
        $xray=$this->Hmo_model->fetch_product($list['caseno'],"XRAY");
        $eegs=$this->Hmo_model->fetch_product($list['caseno'],"EEG");
        $ecgs=$this->Hmo_model->fetch_product($list['caseno'],"ECG");
        $ultra=$this->Hmo_model->fetch_product($list['caseno'],"ULTRASOUND");
        $ctscan=$this->Hmo_model->fetch_product($list['caseno'],"CT SCAN");
        $echos=$this->Hmo_model->fetch_product($list['caseno'],"2D ECHO");
        $hearts=$this->Hmo_model->fetch_product($list['caseno'],"HEARTSTATION");
            echo "<tr>";
                echo "<td>".date('m/d/Y',strtotime($list['dateadmit']))."</td>";
                echo "<td>".$list['caseno']."</td>";
                echo "<td style='text-transform:capitalize;'>$list[patientname]</td>";            
                echo "<td>";
                foreach($lab as $item){
                    echo $item['productdesc'].",";
                }
                foreach($xray as $item){
                    echo $item['productdesc'].",";
                }
                foreach($eegs as $item){
                    echo $item['productdesc'].",";
                }
                foreach($ecgs as $item){
                    echo $item['productdesc'].",";
                }
                foreach($ultra as $item){
                    echo $item['productdesc'].",";
                }
                foreach($ctscan as $item){
                    echo $item['productdesc'].",";
                }
                foreach($echos as $item){
                    echo $item['productdesc'].",";
                }
                foreach($hearts as $item){
                    echo $item['productdesc'].",";
                }
                echo "</td>";
            echo "</tr>";
            $x++;        
    }   
?>
</table>