<div>
            <table width="100%" border="0" cellspacing="1" cellpadding="1" style="font-family:Arial;font-size:13px;">            
            <?php            
            $totalamount=0;
            foreach($items as $item){                
                $unitcost=number_format($item['unitcost'],2,".",",");
                $amount=number_format($item['totalgross'],2,".",",");
                echo "<tr>
                        <td width='25%'>$item[itemname]</td>
                        <td width='25%'>$item[suppliername]</td>
                        <td width='15%' align='center'>$item[usages]</td>
                        <td width='15%' align='right'>$unitcost</td>
                        <td width='20%' align='right'>$amount</td>
                    </tr>";
                $totalamount +=$item['totalgross'];
            }
            ?>
            <tr>
                <td colspan='5' style="border-top:1px solid black;">&nbsp;</td>
            </tr>
            <tr>
            <td width='25%'><b>TOTAL</b></td>
            <td width='25%'></td>
            <td width='15%'></td>
            <td width='15%'></td>            
            <td width='20%' align='right'><?=number_format($totalamount,2);?></td>
            </tr>
            <tr>

            </tr>
            </table>
            </div>