<table width="100%" border="1" cellspacing="0" cellpadding="2" style="border-collapse: collapse; font-size: 12px;">
    <tr>
        <td width="5%" align="center">NO.</td>
        <td width="40%" align="center">PATIENT NAME</td>
        <td width="5%" align="center">AGE</td>
        <td align="center" width="50%">CHARGES</td>
    </tr>
<?php    
$x=1;
    
    foreach($body as $item){
        echo "<tr>";
            echo "<td>$x.</td>";
            echo "<td>$item[patientname]</td>";
            echo "<td align='center'>$item[age]</td>";
            echo "<td>";
            $qry=$this->Hmo_model->db->query("SELECT * FROM productout WHERE caseno='$item[caseno]' AND quantity > 0 ORDER BY productdesc ASC");
            $charges=$qry->result_array();
            foreach($charges AS $row){
                echo $row['productdesc'].",";
            }
            echo "</td>";
        echo "</tr>";
        $x++;
        
    }    
?>
</table>