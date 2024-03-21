<div>
    <table width="100%" cellspacing="0" cellpadding="1" border="1" style="font-size:12px;">
      <tr>
                <td witdh="15%" align="center"><b>DATE</b></td>
                <td width="15%" align="center"><b>REFNO</b></td>
                <td width="40%" align="center"><b>DESCRIPTION</b></td>
                <td width="10%" align="center"><b>UNIT COST</b></td>
                <td width="5%" align="center"><b>QTY</b></td>
                <td width="10%" align="right"><b>TOTAL</b></td>
            </tr>
        <?php
        $totalamount=0;
        foreach($items as $item){
            $itemdesc=$this->Purchase_model->getSingleChargeBodReport($item['isid']);
            $itemdetails="";
            $itemcost="";
            $itemtotalcost="";
            $itemquantity="";
            foreach($itemdesc as $details){
                $desc=str_replace('ams-','',$details['description']);
                $desc=str_replace('-med','',$desc);
                $desc=str_replace('-sup','',$desc);
                $desc=str_replace('cmschi-','',$desc);
                $itemdetails .=$desc."<br>";
                $itemcost .=number_format($details['unitcost'],2)."<br>";
                $itemquantity .=$details['quantity']."<br>";
                if($details['prodtype1']>0){$itemtotalcost .=number_format($details['quantity']*$details['prodtype1'],2)."<br>";}
                else{$itemtotalcost .=number_format($details['quantity']*$details['unitcost'],2)."<br>";}
                $totalamount +=$details['quantity']*$details['unitcost'];
            }


        ?>
        <tr>
                <td witdh="15%" align="center" style="border-bottom:1px solid black;"><?=$item['date'];?></td>
                <td width="15%" align="center" style="border-bottom:1px solid black;"><?=$item['invno'];?></td>
                <td width="40%" style="border-bottom:1px solid black;"><?=$itemdetails;?></td>
                <td width="10%" align="right" style="border-bottom:1px solid black;"><?=$itemcost;?></td>
                <td width="5%" align="center" style="border-bottom:1px solid black;"><?=$itemquantity;?></td>
                <td width="10%" align="right" style="border-bottom:1px solid black;"><?=$itemtotalcost;?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <br>
    <br>
    <br>
    <table width="100%" border="0" cellspacing="0">
        <tr>
            <td>Total</td>
            <td align="right"><?=number_format($totalamount,2);?></td>
        </tr>
    </table>
<br />
<br />
  <table width="100%" borborder="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <b>Prepared by</b>
      </td>
      <td>
        <b>Received by</b>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        &nbsp;
      </td>
    </tr>
    <tr>
      <td>
        <u><b>JIHAN KUSAIN, RPh.</b></u><br />CPU Head
      </td>
      <td>
        <u><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></u><br />Accounting Staff
      </td>
    </tr>
  </table>
</div>
