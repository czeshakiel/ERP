<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row clearfix g-3">
			<div class="col-xl-12 col-lg-12 col-md-12 flex-column">
				<div class="row g-3">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
								<h3 class="mb-0 fw-bold ">AR Trade Details</h3>
							</div>
						</div>
						<div class="card">							
							<div class="card-body">
								<div class="row">
									<div class="col-lg-12">									
										<table width="100%" border="0" style="font-size: 14px;">
											<?php
											$hospital=0;
											$hpaid=0;
											$pftrade=0;			
											$pfpaid=0;								
												foreach($profile as $item){
													if($item['accttitle']=="AR TRADE" || $item['accttitle']=="AR EMPLOYEE" || $item['accttitle']=="AR PERSONAL" || $item['accttitle']=="AR DOCTOR"){
														$hospital +=$item['amount'];
														if($item['type']=="cash-Visa" || $item['type']=="card-Visa"){
															$hpaid +=$item['amount'];
														}
													}
													if($item['accttitle']=="AR TRADE PF" || $item['accttitle']=="AR EMPLOYEE PF" || $item['accttitle']=="AR PERSONAL PF" || $item['accttitle']=="AR DOCTOR PF"){
														$pftrade +=$item['amount'];
														if($item['type']=="cash-Visa" || $item['type']=="card-Visa"){
															$pfpaid +=$item['amount'];
														}
													}
												}												
											?>
											<tr>
												<td><b>AR - Trade: </b></td>
												<td align="right"><?=number_format($hospital,2);?></td>
											</tr>
											<tr>
												<td colspan="2"><b>AR - Trade PF: </b></td>												
											</tr>
											<?php											
											foreach($profile as $item){
													if($item['accttitle']=="AR TRADE PF" || $item['accttitle']=="AR EMPLOYEE PF" || $item['accttitle']=="AR PERSONAL PF" || $item['accttitle']=="AR DOCTOR PF"){
														echo "<tr>";
															echo "<td>$item[description]</td>";
															echo "<td align='right'>".number_format($item['amount'],2)."</td>";
														echo "</tr>";
													}												
												}
											?>
											<tr>
												<td align="right">Total AR Trade</td>
												<td align="right" style="border-top:1px solid black">&#8369; <?=number_format($pftrade+$hospital,2);?></td>
											</tr>
											<tr>
												<td colspan="2">&nbsp;</td>
											</tr>
											<tr>
												<td colspan="2"><b>Guarantor</b></td>
											</tr>
											<?php
											$company=$this->Cashier_model->getAllGuarantor($caseno);
											$guarantor=0;
											foreach($company as $item){
												$guarantor +=$item['amount'];
												$datepaid=date('M d, Y',strtotime($item['datearray']));
												echo "<tr>";
													echo "<td>".str_replace('AR ','',$item['accttitle'])." / ".$datepaid."</td>";
													echo "<td align='right'>".number_format($item['amount'],2)."</td>";
												echo "</tr>";
											}
											?>
											<tr>
												<td align="right">Total Guarantor</td>
												<td align="right" style="border-top:1px solid black">&#8369; <?=number_format($guarantor,2);?></td>
											</tr>
											<tr>
												<td colspan="2">&nbsp;</td>
											</tr>
											<tr>
												<td align="right">Sub Total</td>
												<td align="right">&#8369; <?=number_format($pftrade+$hospital-$guarantor,2);?></td>
											</tr>
											<tr>
												<td colspan="2">&nbsp;</td>
											</tr>
											<tr>
												<td colspan="2"><b>Payment History</b></td>
											</tr>
											<?php
											foreach($profile as $item){
													if($item['type']=='cash-Visa' || $item['type']=="card-Visa"){
														$datepaid=date('M d, Y',strtotime($item['datearray']));
														echo "<tr>";
															echo "<td><b>OR #: </b>$item[ofr] / ".$datepaid."</td>";
															echo "<td align='right'>".number_format($item['amount'],2)."</td>";
														echo "</tr>";
													}
												}
											?>
											<tr>
												<td colspan="2">&nbsp;</td>
											</tr>
											<tr>
												<td><b>Remaining Balance as of <?=date('F d, Y');?>:</b></td>
												<td align="right">&#8369; <?=number_format($hospital+$pftrade-$hpaid-$pfpaid-$guarantor,2);?></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
