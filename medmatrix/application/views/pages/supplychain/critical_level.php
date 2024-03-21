<div>
        <table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;border-collapse: collapse;">
            <tr>
                <td align='center'><b>No.</b></td>
                <td align='center'><b>Description</b></td>
                <td align='center'><b>SOH</b></td>
                <td align='center'><b>Re-Order Level</b></td>
                <td align='center'><b>Department</b></td>                                
            </tr>
            <?php
            $x=1;
            foreach($items as $item){    
                if($item['soh'] <= $item['quantity']){            
                    echo "<tr>";
                        echo "<td>$x.</td>";
                        echo "<td>$item[itemname]</td>";
                        echo "<td align='center'>$item[soh]</td>";
                        echo "<td align='center'>$item[quantity]</td>";
                        echo "<td align='center'>$item[department]</td>";                    
                    echo "</tr>";
                }
                $x++;
            }
            ?>
        </table>
</div>
