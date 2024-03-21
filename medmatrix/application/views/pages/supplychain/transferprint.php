
        <div>
			 <table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:13px;border-collapse:collapse;">
				 <tr>
						 <td align="center" width="5%"><b>Qty</b></td>
						 <td align="center" width="5%"><b>Unit</b></td>
							<td align="center" width="42%"><b>Product Description</b></td>
							<td align="center" width="12%"><b>Lot #</b></td>
							<td align="center" width="12%"><b>Expiration<br>Date</b></td>
							<td align="center" width="12%"><b>Unit Cost</b></td>
							<td align="center" width="12%"><b>Disc</b></td>
							<td align="center" width="12%"><b>Total Amount</b></td>
					</tr>
				 <?php
				 $grandtotal=0;
				 $totalgross=0;
                 $x=1;
				 foreach($body AS $item){
					 $desc=str_replace('ams-','',$item['description']);
					 $desc=str_replace('-med','',$desc);
					 $desc=str_replace('-sup','',$desc);
					 if($item['prodtype1'] > 0){
					 	$totalamount=$item['prodtype1']*$item['quantity'];
					    $totalgross +=$item['prodtype1']*$item['quantity'];
					 }else{
					 	$totalamount=$item['unitcost']*$item['quantity'];
					    $totalgross +=$item['unitcost']*$item['quantity'];
					 }						
              if($item['generic']==""){
                $generic="";
              }else{
                $generic="(".$item['generic'].") ";
              }
					 echo "<tr>";
                         echo "<td align='center' width='5%'>".$item['quantity']."</td>";
						 echo "<td align='center' width='5%'>".$item['paymentstatus']."</td>";
					 	 echo "<td width='42%'>".$generic.$desc."</td>";
						 echo "<td align='center' width='12%'>".$item['lotno']."</td>";
						 echo "<td align='center' width='12%'>".$item['expiration']."</td>";
                         echo "<td align='right' width='12%'>".number_format($item['unitcost'],2)."</td>";
                         echo "<td align='right' width='12%'>".number_format($item['prodtype1'],2)."</td>";
						 echo "<td align='right' width='12%'>".number_format($totalamount,2)."</td>";
					 echo "</tr>";
					 //$grandtotal +=$totalamount;
                     $x++;
				 }
                 //$handfee=$totalamount*($hf/100);
				 ?>
			 </table>
        </div>
