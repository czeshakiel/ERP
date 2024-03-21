<div>
        <table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;border-collapse: collapse;">
            <tr>
                <td align='center'><b>No.</b></td>
                <td align='center'><b>Description</b></td>
                <td align='center'><b>Supplier</b></td>
                <td align='center'><b>RR No.</b></td>
                <td align='center'><b>Stock on Hand</b></td>
                <td align='center'><b>EXpiration</b></td>
                <td align='center'><b>No. of Days</b></td>
            </tr>
            <?php
            $x=1;
            foreach($items as $item){                    
                    echo "<tr>";
                        echo "<td>$x.</td>";
                        echo "<td>$item[itemname] ($item[generic])</td>";
                        echo "<td>$item[suppliername]</td>";
                        echo "<td>$item[rrno]</td>";
                        echo "<td align='center'>$item[soh]</td>";
                        echo "<td align='center'>$item[expiration]</td>";
                        echo "<td align='center'>$item[no_of_days]</td>";                    
                    echo "</tr>";
                    $x++;
                }
            ?>
        </table>
</div>
