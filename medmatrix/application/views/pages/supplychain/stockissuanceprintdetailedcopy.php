<div>
<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;">
    <?php
    $x=1;
    foreach($body as $item){
        $desc=str_replace('ams-','',$item['description']);
        $desc=str_replace('-med','',$desc);
        $desc=str_replace('-sup','',$desc);
        $reqqty=$this->Purchase_model->getRequestedQty($reqno,$item['code']);
        if($item['generic']==""){
            $generic="";
          }else{
            $generic="(".$item['generic'].")<br>";
          }
        echo "<tr>";
            echo '<td align="center" width="10%">'.$x.'.</td>';
            echo '<td width="52%" >'.$generic.$desc.'</td>';
            echo '<td width="8%" align="center">'.$item['lotno'].'</td>';
            echo '<td width="15%" align="center">'.$reqqty['reqqty'].'</td>';
            echo '<td width="15%" align="center">'.$item['quantity'].'</td>';
        echo "</tr>";
        $x++;
    }
    ?>
</table>
</div>
<br /><br />
<hr />
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size:10px;font-weight:bold;">
<tr>
<td width="25%">Prepared by:______________________</td>
<td width="25%">Noted by:______________________</td>
<td width="25%">Approved by:____________________</td>
<td width="25%">Received by:____________________</td>
</tr>
</table>
</div>
