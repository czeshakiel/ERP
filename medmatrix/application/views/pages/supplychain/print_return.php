<div>
        <table width="100%" border="1" cellspacing="0" cellpadding="0" style="font-family:Arial;font-size:12px;border-collapse: collapse;">
        <?php
        $totalamount=0;
        foreach($items as $item){
			$item['description'] = str_replace('ams-','',$item['description']);
			$item['description'] = str_replace('-med','',$item['description']);
			$item['description'] = str_replace('-sup','',$item['description']);
            $total=$item['unitcost']*$item['quantity'];
            $totalamount +=$total;
        ?>
            <tr> 
                <td witdh="25%" ><?=$item['description'];?></td>
                <td width="25%" align="center" ><?=$item['expiration'];?></td>
                <td width="10%" align="center" ><?=$item['lotno'];?></td>
                <td width="15%" align="right" ><?=number_format($item['unitcost'],2);?></td>
                <td width="10%" align="center" ><?=$item['quantity'];?></td>
                <td width="15%" align="right" ><?=number_format($total,2);?></td>
            </tr>            			 	
            <?php
        }
            ?>
            <tr>
                <td colspan="6" style="border-bottom:0; border-right:0;border-left:0;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="6" style="border-bottom:0; border-top:0; border-right:0;border-left:0;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="6" style="border-bottom:0; border-top:0; border-right:0;border-left:0;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="6" style="border-bottom:0; border-top:0; border-right:0;border-left:0;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5" style="border-bottom:0; border-top:0; border-right:0;"><b>TOTAL</b></td>
                <td align="right" style="border-bottom:0; border-top:0;border-left:0;"><?=number_format($totalamount,2);?></td>
            </tr>
        </table>
</div>
