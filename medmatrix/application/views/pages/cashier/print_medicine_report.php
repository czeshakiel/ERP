<div>
	<br>
<b style="font-size:12px;font-family: Times New Roman;">CASH COLLECTION SUMMARY (DETAIL) - OVERALL</b><br>
				As of <?=date('F d, Y',strtotime($rundate));?><br>
											<table width="100%" border="1" cellpadding="1" cellspacing="0" style="font-size:12px; border-collapse:collapse;">
													<tr>
														<td align="center" ><b>PAYOR NAME</b></td>
														<td align="center" style="font-size:10px;font-family: Times New Roman;"><b>OR No.</b></td>
														<td align="center" style="font-size:10px;font-family: Times New Roman;"><b>DATE / TIME</b></td>
														<td align="center" style="font-size:10px;font-family: Times New Roman;"><b>PARTICULARS</b></td>
														<td align="center" style="font-size:10px;font-family: Times New Roman;"><b>ACCTTITLE</b></td>
														<td align="center" style="font-size:10px;font-family: Times New Roman;"><b>GROSS</b></td>
														<td align="center" style="font-size:10px;font-family: Times New Roman;"><b>DISCOUNT</b></td>
														<td align="center" style="font-size:10px;font-family: Times New Roman;"><b>TOTAL</b></td>
													</tr>
													<?php
													$totalgross=0;
													$totaldiscount=0;
													$totalamount=0;
															
															$subtotalgross=0;
															$subtotaldiscount=0;
															$subtotalamount=0;
																	foreach($body as $item){
																			$acctno=$item['acctno'];
																			$payor=$item['acctname'];
																			$ofr=$item['ofr'];
																			$particulars=$item['description'];
																			$subaccttitle=$item['accttitle'];
																			$paymentDate=$item['date'];
																			$dept=$item['Dept'];
																			$paymentTime=$item['paymentTime'];
																			$amount=$item['amount'];
																			$discount=$item['discount'];
																			$gross=$amount+$discount;																			

																			$subtotalgross +=$gross;
																			$subtotalamount +=$gross-$discount;
																			$subtotaldiscount +=$discount;
																			echo "<tr>";
																				echo "<td>$payor</td>";
																				echo "<td>$ofr</td>";
																				echo "<td>$paymentDate / $paymentTime</td>";
																				echo "<td>$particulars</td>";
																				echo "<td>$subaccttitle</td>";
																				echo "<td align='right'>".number_format($gross,2,".",",")."</td>";
																				echo "<td align='right'>".number_format($discount,2,".",",")."</td>";
																				echo "<td align='right'>".number_format($gross-$discount,2,".",",")."</td>";
																			echo "</tr>";
																		}																	
													echo "<tr>";
														echo "<td colspan='8' align='right'>&nbsp;</td>";
													echo "</tr>";
													echo "<tr>";
														echo "<td colspan='5' align='right'><b>GRAND TOTAL</b></td>";
														echo "<td align='right'>".number_format($subtotalgross,2,".",",")."</td>";
														echo "<td align='right'>".number_format($subtotaldiscount,2,".",",")."</td>";
														echo "<td align='right'>".number_format($subtotalamount,2,".",",")."</td>";
													echo "</tr>";
													 ?>
											</table>				
									</div>