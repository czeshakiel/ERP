<div>
<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;">
    <?php
    $x=1;
    foreach($body as $item){
        $desc=str_replace('ams-','',$item['description']);
        $desc=str_replace('-med','',$desc);
        $desc=str_replace('-sup','',$desc);
        if($item['generic']==""){
            $generic="";
          }else{
            $generic="(".$item['generic'].")<br>";
          }
        echo "<tr>";
            echo '<td align="center" width="10%">'.$x.'.</td>';
            echo '<td align="center" width="10%" >'.$item['prodqty'].'</td>';
            echo '<td width="30%" align="center" >'.$item['code'].'</td>';
            echo '<td width="50%" >'.$generic.$desc.'</td>';
        echo "</tr>";
        $x++;
    }
    ?>
</table>
<hr>
<br>
<table width="100%" border="0" cellspacing="0" style="font-size:12px;">
<tr>
    <td width="10%" >Remarks</td>
    <td >_____________________________________</td>
</tr>
<tr>
    <td width="10%" ></td>
    <td >_____________________________________</td>
</tr>
</table>
</div>
<br>
<hr>
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
