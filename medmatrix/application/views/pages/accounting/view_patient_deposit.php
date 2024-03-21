<table width="100%" border="1" cellpadding="2" cellspacing="0" style="font-size: 12px;border-collapse: collapse;">
		<!-- <tr>
			<td width="10%" align="center"><b>DATE</b></td>
			<td width="40%" align="center"><b>PATIENT NAME</b></td>
			<td align="center"><b>DEBIT</b></td>
			<td align="center"><b>CREDIT</b></td>
		</tr> -->
		<?php
		$totaldebitamount=0;
		$totalcreditamount=0;
		foreach($body as $item){			
			$payment=$this->Cashier_model->getPatientDeposit($item['caseno'],$item['datearray']);
			$previous_payment=$this->Cashier_model->getPatientDepositBegin($item['caseno'],$startdatebeg,$enddatebeg);
			
				if(count($payment)>0){
				echo "<tr>";
					echo "<td width='10%'>".date('m/d/Y',strtotime($item['dateadmit']))."</td>";
					echo "<td width='40%'>$item[lastname], $item[firstname] $item[suffix] $item[middlename]</td>";
					echo "<td align='right' width='30%'>";
					$totaldebit=0;
					$refno="";
						foreach($previous_payment as $debit1){														
								$refno=$debit1['refno'];
								echo "<b>".number_format($debit1['amount'],2)."</b> - ".$debit1['ofr']." - ".date('m/d/Y',strtotime($debit1['datearray']))."<br>";
								$totaldebit +=$debit1['amount'];							
						}						
						foreach($payment as $debit){		
							if($item['datearray'] >= $startdatebeg && $item['datearray'] <= $enddatebeg){

							}else{
								echo "<b>".number_format($debit['amount'],2)."</b> - ".$debit['ofr']." - ".date('m/d/Y',strtotime($debit['datearray']))."<br>";
								$totaldebit +=$debit['amount'];
							}							
						}
					echo "</td>";
					echo "<td align='right' width='20%'>";
						$discharged=$this->Admission_model->discharged($item['caseno']);
						if($discharged){
							if(($discharged['datearray'] >= $startdate && $discharged['datearray'] <= $enddate)){
								echo "<b>".number_format($totaldebit,2)."</b> - ".date('m/d/Y',strtotime($discharged['datearray']));
									$totalcreditamount +=$totaldebit;
								}							
						}						
					echo "</td>";
				echo "</tr>";
				$totaldebitamount +=$totaldebit;
			}		
		}		
		?>

		<tr>
			<td colspan="2" align="right"><b>TOTAL</b></td>
			<td align="right"><b><?=number_format($totaldebitamount,2);?></b></td>
			<td align="right"><b><?=number_format($totalcreditamount,2);?></b></td>
		</tr>
</table>
<?php
// $totaldebitbegamount=0;
// 		$totalcreditbegamount=0;
// 		foreach($begin as $item){
// 			$payment=$this->Cashier_model->getPatientDeposit($item['caseno'],$item['datearray']);
// 			if(count($payment)>0){
// 					$totaldebitbeg=0;
// 						foreach($payment as $debit){							
// 							$totaldebitbeg +=$debit['amount'];
// 						}
					
// 						$discharged=$this->Admission_model->discharged($item['caseno']);
// 						if($discharged){
// 							if($discharged['datearray'] >= $startdatebeg && $discharged['datearray'] <= $enddatebeg){								
// 								$totalcreditbegamount +=$totaldebitbeg;
// 							}
// 						}											
// 				$totaldebitbegamount +=$totaldebitbeg;
// 			}
// 		}
?>
<!-- <p align="right">
	<b>BEGINNING BALANCE: <u><?=number_format($totaldebitbegamount-$totalcreditbegamount,2);?></u></b>
</p> -->