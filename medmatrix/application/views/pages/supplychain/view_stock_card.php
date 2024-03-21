            <div>
            <table width="100%" border="1" cellspacing="1" cellpadding="2" style="font-family:Arial;font-size:13px;border-collapse: collapse;">
                 <tr>
                <td witdh="5%" align="left" style="border-bottom:1px solid black;"><b>Date</b></td>
                <td width="25%" align="left" style="border-bottom:1px solid black;"><b>Transaction Name</b></td>
                <td width="21%" align="left" style="border-bottom:1px solid black;"><b>Transaction Type</b></td>
                <td width="15%" align="center" style="border-bottom:1px solid black;"><b>Running Balance</b></td>
                <td width="13%" align="center" style="border-bottom:1px solid black;"><b>Stock on Hand</b></td>
                <td width="13%" align="center" style="border-bottom:1px solid black;"><b>Unit Cost</b></td>
                <td width="20%" align="center" style="border-bottom:1px solid black;"><b>User</b></td>
            </tr>
            <?php
            if($begbalance==""){
                $begbalance=0;
            }
            ?>
            <tr>
            <td width='5%'></td>
            <td width='20%'>Beginning Balance</td>
            <td width='21%'></td>
            <td width='15%'></td>
            <td align="center" width='13%'><?=$begbalance;?></td>
            <td width='13%'>&nbsp;</td>
            <td width='15%'>&nbsp;</td>
            </tr>            
            <?php
            $soh=$begbalance;
            foreach($items as $item){
                $soh +=$item['quantity'];
                echo "<tr>";
                    echo "<td width='5%'>$item[datearray]</td>";
                    echo "<td width='20%'>$item[suppliername]</td>";
                    echo "<td width='21%'>$item[trantype] ($item[paymentstatus])</td>";
                    echo "<td width='15%' align='center'>$item[quantity]</td>";
                    echo "<td width='13%' align='center'>$soh</td>";
                    echo "<td width='13%' align='right'>".number_format($item['unitcost'],2)."</td>";
                    echo "<td width='15%' align='left'>$item[receivinguser]</td>";
                echo "</tr>";
            }
            ?><tr>
            <td width='5%'></td>
            <td width='20%'></td>
            <td width='20%'>Stock on Hand</td>
            <td width='15%' align="center"><?=$soh;?></td>
            <td width='13%'></td>
            <td width='13%'></td>
            <td width='15%'>&nbsp;</td>
            </tr>
            <tr>

            </tr>
            </table>
            </div>
