<table width="100%" border="1" cellspacing="0" cellpadding="2" style="border-collapse: collapse; font-size: 12px;">
    <tr>
        <td width="3%" align="center">NO.</td>
        <td width="15%" align="center">PATIENT NAME</td>
        <td width="10%" align="center">HMO</td>
        <td width="6%" align="center">MEDS</td>
        <td width="6%" align="center">LAB</td>
        <td width="6%" align="center">XRAY</td>
        <td width="6%" align="center">UTZ</td>
        <td width="6%" align="center">ECG</td>
        <td width="6%" align="center">EEG</td>
        <td width="6%" align="center">CT</td>
        <td width="6%" align="center">2D ECHO</td>
        <td width="6%" align="center">RESPI</td>
        <td width="10%" align="center">TOTAL</td>
    </tr>
<?php    
$x=1;
    $meds1=0;$lab1=0;$xray1=0;$utz1=0;$ecg1=0;$eeg1=0;$ct1=0;$echo1=0;$respi1=0;$sup1=0;
    foreach($body as $item){
    if($item['addemployer']==""){
        $hmo=$item['hmo'];        
    }else{        
        $hmo=str_replace('AR ','',$item['addemployer']);
    }
        $meds=0;$lab=0;$xray=0;$utz=0;$ecg=0;$eeg=0;$ct=0;$echo=0;$respi=0;$sup=0;
        $amount=$this->Hmo_model->getARAmount($item['caseno'],"PHARMACY/MEDICINE");
        $meds=$amount['amount'];
        if($meds == 0){
            $meds2="";
        }else{
            $meds2=number_format($amount['amount'],2);
        }
        $meds1 +=$meds;
        $amount=$this->Hmo_model->getARAmount($item['caseno'],"LABORATORY");
        $lab=$amount['amount'];
        if($lab == 0){
            $lab2="";
        }else{
            $lab2=number_format($amount['amount'],2);
        }
        $lab1 +=$lab;
        $amount=$this->Hmo_model->getARAmount($item['caseno'],"XRAY");
        $xray=$amount['amount'];
        if($xray == 0){
            $xray2="";
        }else{
            $xray2=number_format($amount['amount'],2);
        }
        $xray1 +=$xray;
        $amount=$this->Hmo_model->getARAmount($item['caseno'],"ULTRASOUND");
        $utz=$amount['amount'];
        if($amount['amount'] == 0){
            $utz2="";
        }else{
            $utz2=number_format($amount['amount'],2);
        }
        $utz1 +=$utz;
        $amount=$this->Hmo_model->getARAmount($item['caseno'],"ECG");
        $ecg=$amount['amount'];
        if($ecg == 0){
            $ecg2="";
        }else{
            $ecg2=number_format($amount['amount'],2);
        }
        $ecg1 +=$ecg;

        $amount=$this->Hmo_model->getARAmount($item['caseno'],"EEG");
        $eeg=$amount['amount'];
        if($eeg == 0){
            $eeg2="";
        }else{
            $eeg2=number_format($amount['amount'],2);
        }
        $eeg1 +=$eeg;

        $amount=$this->Hmo_model->getARAmount($item['caseno'],"CT SCAN");
        $ct=$amount['amount'];
        if($ct == 0){
            $ct2="";
        }else{
            $ct2=number_format($amount['amount'],2);
        }
        $ct1 +=$ct;
        $amount=$this->Hmo_model->getARAmount($item['caseno'],"2D ECHO");
        $echo=$amount['amount'];
        if($echo == 0){
            $echo2="";
        }else{
            $echo2=number_format($amount['amount'],2);
        }
        $echo1 +=$echo;
        $amount=$this->Hmo_model->getARAmount($item['caseno'],"RESPIRATORY");
        $respi=$amount['amount'];
        if($respi == 0){
            $respi2="";
        }else{
            $respi2=number_format($amount['amount'],2);
        }
        $respi1 +=$respi;
        $total=$meds+$lab+$xray+$utz+$ecg+$eeg+$ct+$echo+$respi;
        if($total>0){
        echo "<tr>";
            echo "<td>$x.</td>";
            echo "<td>$item[patientname]</td>";
            echo "<td align='center'>".$hmo."</td>";
            echo "<td align='right'>$meds2</td>";
            echo "<td align='right'>$lab2</td>";
            echo "<td align='right'>$xray2</td>";
            echo "<td align='right'>$utz2</td>";
            echo "<td align='right'>$ecg2</td>";
            echo "<td align='right'>$eeg2</td>";
            echo "<td align='right'>$ct2</td>";
            echo "<td align='right'>$echo2</td>";            
            echo "<td align='right'>$respi2</td>";
            echo "<td align='right'>".number_format($total,2)."</td>";
        echo "</tr>";
        $x++;
        }
    }
    $grandtotal=$meds1+$lab1+$xray1+$utz1+$ecg1+$eeg1+$ct1+$echo1+$respi1;
        if($meds1 == 0){
            $meds1="";
        }else{
            $meds1=number_format($meds1,2);
        }
       
        if($lab1 == 0){
            $lab1="";
        }else{
            $lab1=number_format($lab1,2);
        }
       
        if($xray1 == 0){
            $xray1="";
        }else{
            $xray1=number_format($xray1,2);
        }
        
        if($utz1 == 0){
            $utz1="";
        }else{
            $utz1=number_format($utz1,2);
        }
        
        if($ecg1 == 0){
            $ecg1="";
        }else{
            $ecg1=number_format($ecg1,2);
        }
        
        if($eeg1 == 0){
            $eeg1="";
        }else{
            $eeg1=number_format($eeg1,2);
        }
        
        if($ct1 == 0){
            $ct1="";
        }else{
            $ct1=number_format($ct1,2);
        }
        
        if($echo1 == 0){
            $echo1="";
        }else{
            $echo1=number_format($echo1,2);
        }        
        if($respi1 == 0){
            $respi1="";
        }else{
            $respi1=number_format($respi1,2);
        }
    echo "<tr>";
            echo "<td colspan='3'><b>TOTAL</b></td>";                        
            echo "<td align='right'><b>$meds1</b></td>";
            echo "<td align='right'><b>$lab1</b></td>";
            echo "<td align='right'><b>$xray1</b></td>";
            echo "<td align='right'><b>$utz1</b></td>";
            echo "<td align='right'><b>$ecg1</b></td>";
            echo "<td align='right'><b>$eeg1</b></td>";
            echo "<td align='right'><b>$ct1</b></td>";
            echo "<td align='right'><b>$echo1</b></td>";            
            echo "<td align='right'><b>$respi1</b></td>";
            echo "<td align='right'><b>".number_format($grandtotal,2)."</b></td>";
        echo "</tr>";
?>
</table>