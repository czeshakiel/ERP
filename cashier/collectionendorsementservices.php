<?php
				include('../main/connection.php');
				$rundate=$_GET['startdate'];
				$enddate=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));
				$startdate=date('Y-m-d',strtotime('-1 day',strtotime($enddate)));				
				$sql123="SELECT * FROM heading";
				$sqlMission=mysqli_query($conn,$sql123);
				$mv=mysqli_fetch_array($sqlMission);
				$heading=$mv['heading'];
				$address=$mv['address'];
				$telno=$mv['telno'];
                ?>            
            <div class="row">
                <div class="col-lg-12">
                    <!-- <p align="right"><a href="#" onclick="printDiv('printableArea')" class="btn btn-primary"><i class="fa fa-print"> </i> PRINT</a> <button onclick="tableToExcel('printThis','Detailed_Report')" class="btn btn-success"><i class="fa fa-download"> </i> EXPORT</button></p> -->
                    <div class="panel panel-white" id="printableArea" width="100%" style="font-size:12px;">
                        <div class="panel-heading">
                            <center>
                                <table width="100%" border="0">
                                    <tr>
                                        <td align="right" width="5%"><div style="height: 100px;width: 100px;"><img src="../main/img/logo/kmsci.png" width="100" height="100"></div></td>
                                        <td align="center" width="95%"><label style="font-size:18px;font-family: Times New Roman;"><?=$heading;?></label><p><?=$address;?></p><br><label style="font-size: 20px;font-family: Times New Roman;">PROFESSIONAL FEE REPORT</label></td>
                                    </tr>
                                </table>
                            </center>
                        </div>
                        <div class="panel-body" id="printThis">
							<b>RUNNING DATE: <u><?=date('M d, Y',strtotime($startdate));?></u> - <u><?=date('M d, Y',strtotime($enddate));?></u></b><br>
							<b>Collection Type: <u>Professional Fee</u></b><br>
							<!--b>Doctor: <u><?=$ap;?></u></b-->
                            <table width="100%" cellpadding="1" cellspacing="0" border="1" style="border-collapse: collapse; font-size: 12px; font-family: Arial;">
                                <tr>
									<td align="center" style="font-size:10px;font-family: Times New Roman;"><b>PATIENT NAME</b></td>
									<td align="center" style="font-size:10px;font-family: Times New Roman;"><b>OR No.</b></td>
									<?php
									$sql="SELECT c.description FROM docfile d INNER JOIN collection c ON c.pfcode=d.code WHERE ((c.datearray='$startdate' AND c.paymentTime > '23:00:00') OR (c.datearray='$enddate' AND c.paymentTime <= '23:00:00')) AND c.accttitle = 'PROFESSIONAL FEE' AND c.amount > 0 AND c.`type` LIKE '%Visa%' AND c.acctno NOT LIKE '%R-%' AND c.type <> 'card-Visa' GROUP BY c.description ORDER BY d.lastname ASC";
									$sqlPF=mysqli_query($conn,$sql);
									while($pf=mysqli_fetch_array($sqlPF)){
										echo "<td align='right' style='font-size:8px;font-family: Times New Roman; font-weight:bold;'>
										DR. $pf[description]
										</td>";
									}
									 ?>
									 <td align="center" style="font-size:10px;font-family: Times New Roman;"><b>TOTAL</b></td>
								</tr>
								<?php
									$sql="SELECT * FROM collection WHERE ((datearray = '$startdate' AND paymentTime > '23:00:00') OR (datearray='$enddate' AND paymentTime <= '23:00:00')) AND accttitle = 'PROFESSIONAL FEE' AND amount > 0 AND `type` LIKE '%Visa%' AND acctno NOT LIKE '%R-%' AND `type` <> 'card-Visa' GROUP BY ofr ORDER BY acctname ASC";
									$sqlHospitalBill=mysqli_query($conn,$sql);
									$diaghosp=0;
									//$arpf=0;
									$diagdisc=0;
									$pfgrandtotal="";	

									if(mysqli_num_rows($sqlHospitalBill)>0){
										while($hbill=mysqli_fetch_array($sqlHospitalBill)){
											$amount=0;
											$acctname=$hbill['acctname'];
											$accttitle=$hbill['accttitle'];
											$acctno=$hbill['acctno'];
											$transdate=$hbill['date'];
											$datearray=$hbill['datearray'];
											$description=$hbill['description'];
											//$amount=$hbill['amount'];
											$paymentTime=$hbill['paymentTime'];
											$discount = $hbill['discount'];
											$orno = $hbill['ofr'];
											$gross = $amount + $discount;
											$shift1=$hbill['shift'];
											$dept=$hbill['Dept'];
											$p=explode('-',$acctno);
											$pfix=$p[0];
											if($pfix=="I"){
												$orno=$orno;
												$sqlCheckStatus=mysqli_query($conn,"SELECT ward FROM admission WHERE caseno='$acctno'");
												$stat=mysqli_fetch_array($sqlCheckStatus);
												$status=$stat['ward'];
												$empno="";
											}else if($pfix=="O"){
												//$orno="OPD Sur";
												$sqlCheckStatus=mysqli_query($conn,"SELECT ward,employerno FROM admission WHERE caseno='$acctno'");
												$stat=mysqli_fetch_array($sqlCheckStatus);
												$status=$stat['ward'];
												$empno=$stat['employerno'];
												if(strpos($empno,"C") !== false){
													$empno="C";
												}
											}else{
												//$orno="OPD";
												$status="discharged";
												$empno="C";
											}											
											//if($rundate==$dateto){
												//if($status=="discharged" || $empno=="C"){
													//$diaghosp +=$amount;
												$diagdisc +=$discount;
												echo "
												<tr style='font-size:10px;font-family: Times New Roman;'>
													<td>$acctname</td>
													<td>$orno</td>
													";
													$pftotal=0;	
													$sql="SELECT c.description FROM docfile d INNER JOIN collection c ON c.pfcode=d.code WHERE ((c.datearray='$startdate' AND c.paymentTime > '23:00:00') OR (c.datearray='$enddate' AND c.paymentTime <= '23:00:00')) AND c.accttitle = 'PROFESSIONAL FEE' AND c.amount > 0 AND c.`type` LIKE '%Visa%' AND c.acctno NOT LIKE '%R-%' AND c.type <> 'card-Visa' GROUP BY c.description ORDER BY d.lastname ASC";
													$sqlPF=mysqli_query($conn,$sql);
													while($pf=mysqli_fetch_array($sqlPF)){
														$pfdesc=$pf['description'];
														$sqlAmount=mysqli_query($conn,"SELECT SUM(amount) as amount FROM collection WHERE `description` LIKE '%$pfdesc%' AND acctno='$acctno' AND accttitle='PROFESSIONAL FEE' AND `type` LIKE '%Visa%' AND ((datearray = '$startdate' AND paymentTime > '23:00:00') OR (datearray='$enddate' AND paymentTime <= '23:00:00')) AND acctno NOT LIKE '%R-%' AND `type` <> 'card-Visa'");
														if(mysqli_num_rows($sqlAmount)>0){
															$pfamount=mysqli_fetch_array($sqlAmount)['amount'];
														}else{
															$pfamount=0;
														}

														echo "<td align='right' style='font-size:10px;font-family: Times New Roman;'>
														".number_format($pfamount,2)."
														</td>";
														$amount += $pfamount;														
													}			
													$diaghosp +=$amount;
													echo "
													<td align='right'>".number_format($amount,2,'.',',')."</td>
												</tr>
												";
												//}
												

											/*}else{
												if(($datearray == $rundate && $paymentTime > '15:30:00') || ($datearray == $dateto && $paymentTime <= '15:30:00') || ($datearray==$rundate)){
													$diaghosp +=$amount;
												$diagdisc +=$discount;
												echo "
												<tr>
													<td>$acctname</td>
													<td>$orno</td>
													<td>$transdate - $paymentTime</td>
													<!--td>$accttitle</td>
													<td>$description - $dept</td-->
													<td align='right'>".number_format($gross,2,'.',',')."</td>
													<td align='right'>$discount</td>
													<td align='right'>".number_format($amount,2,'.',',')."</td>

												</tr>
												";
												}
											}*/
										}


									}else{
										echo "
											<tr style='font-size:10px;font-family: Times New Roman;'>
												<td colspan='7' align='center'>&nbsp;</td>
											</tr>
										";
									}
												echo "
												<tr style='font-size:10px;font-family: Times New Roman;font-weight: bold;'>
													<td colspan='2' align='left'>TOTAL</td>

													";
													$sql="SELECT SUM(c.amount) as amount FROM docfile d INNER JOIN collection c ON c.pfcode=d.code WHERE ((c.datearray='$startdate' AND c.paymentTime > '23:00:00') OR (c.datearray='$enddate' AND c.paymentTime <= '23:00:00')) AND c.accttitle = 'PROFESSIONAL FEE' AND c.amount > 0 AND c.`type` LIKE '%Visa%' AND c.acctno NOT LIKE '%R-%' AND c.type <> 'card-Visa' GROUP BY c.description ORDER BY d.lastname ASC";
													$sqlPF=mysqli_query($conn,$sql);
													while($pf=mysqli_fetch_array($sqlPF)){
														echo "<td align='right' style='font-size:12px;font-family: Times New Roman;'>
														".number_format($pf['amount'],2)."
														</td>";
													}
													echo "
													<td align='right' style='font-size:12px;'>".number_format($diaghosp,2)."</td>
												</tr>
												";
								?>
                            </table>
							<?php

								$totalhosp=$diaghosp;
							?>

							<p style='font-size:12px;font-family: Times New Roman;font-weight: bold;'><br /><b>Professional Fee: </b><u><?=number_format($totalhosp,2,'.',',');?></u></p>
							<br>
							<p style='font-size:10px;font-family: Times New Roman;font-weight: bold;'><b>Prepared by</b><br><br /><u><?=$_GET['nursename'];?></u><br></p>
							<!--p><b>Noted by</b><br><u>VIEVINIA T. ALLIDA, MAHA</u><br>Hospital Administrator</p-->


                        </div>
                        </div>


                    </div>
                    <!-- /.col-lg-4 -->
                </div>
            </div>            
