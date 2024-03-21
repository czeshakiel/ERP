<?php 
				include('../includes/config.php');
				$rundate=$_GET['startdate'];
				$datefrom=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));
                ?>
            <div class="row">
                <br>
                <div class="col-lg-12">
                    <a href="../cashier/?precollection&branch=<?=$branch;?>&dept=<?=$st;?>&nursename=<?=$nursename;?>&userunique=<?=$userunique;?>"><i class="fa fa-arrow-left"></i> Back</a> > Collection Endorsement Report
                </div>
                <div class="col-lg-12">
                    <h1 class="page-header"></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p align="right"><a href="#" onclick="printDiv('printableArea')" class="btn btn-primary"><i class="fa fa-print"> </i> PRINT</a></p>
                    <div class="panel panel-white" id="printableArea" width="100%" style="font-size:12px;">
                        <div class="panel-heading">
                            <center>
                                <table width="100%" border="0">
                                    <tr>
                                        <td align="right" width="5%"><div style="height: 100px;width: 100px;"><img src="../images/centino.png" width="100" height="100"></div></td>
                                        <td align="center" width="95%"><label style="font-size:18px;font-family: Times New Roman;">CENTENO MEDICAL SPECIALISTS HOSPITAL, INC.</label><p>Bansalan, Davao del Sur</p><br><label style="font-size: 24px;font-family: Times New Roman;">COLECTION REPORT</label></td>
                                    </tr>
                                </table>
                            </center>
                        </div>
                        <div class="panel-body">
							<b>RUNNING DATE: <u><?=date('M d, Y',strtotime($rundate));?></u></b><br>
							<b>Collection Type: <u>NON-SENIOR DISCOUNT FOR MEDICINE AND SUPPLIES</u></b>
                            <table width="100%" cellpadding="1" cellspacing="2" class="table table-hover table-bordered">
                                <tr>
									<td align="center"><b>PATIENT NAME</b></td>
									<td align="center"><b>OR No.</b></td>
									<td align="center"><b>DATE / TIME</b></td>
									<td align="center"><b>PARTICULARS</b></td>
									<td align="center"><b>DESCRIPTION</b></td>
									<td align="center"><b>GROSS</b></td>
									<td align="center"><b>DISCOUNT</b></td>
									<td align="center"><b>HOSPITAL BILL</b></td>																		
								</tr>								
								<tr>
									<td colspan="8" style="text-indent:20px;"><b>MEDICINE</b></td>
								</tr>
								<?php
									$sql="SELECT * FROM collection WHERE datearray BETWEEN '$datefrom' AND '$rundate' AND accttitle LIKE '%PHARMACY/MEDICINE%' AND amount > 0 AND `type` NOT LIKE '%pending%' GROUP BY ofr,`description` ORDER BY ofr ASC,accttitle ASC";
									$sqlHospitalBill=mysqli_query($con,$sql);
									$medhosp=0;
									//$arpf=0;
									$meddisc=0;									
									if(mysqli_num_rows($sqlHospitalBill)>0){
										while($hbill=mysqli_fetch_array($sqlHospitalBill)){
											$acctname=$hbill['acctname'];
											$accttitle=$hbill['accttitle'];
											$acctno=$hbill['acctno'];
											$transdate=$hbill['date'];
											$datearray=$hbill['datearray'];
											$description=$hbill['description'];
											$amount=$hbill['amount'];
											$paymentTime=$hbill['paymentTime'];
											$discount = $hbill['discount'];
											$orno = $hbill['ofr'];
											$gross = $amount + $discount;
											$shift1=$hbill['shift'];
											$dept=$hbill['Dept'];
											$p=explode('-',$acctno);
											$pfix=$p[0];
										
												$checkSenior=mysqli_query($con,"SELECT pp.*,a.* FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$acctno' AND pp.senior LIKE '%N%'");
											
											
											if(mysqli_num_rows($checkSenior)>0){
												if(($datearray==$datefrom && $paymentTime >= '16:00:00') || ($datearray==$rundate && $paymentTime <= '16:00:00')){
												$medhosp +=$amount;
												$meddisc +=$discount;												
												echo "
												<tr>
													<td>$acctname</td>
													<td>$orno</td>
													<td>$transdate - $paymentTime</td>
													<td>$accttitle</td>
													<td>$description - $dept</td>
													<td align='right'>".number_format($gross,2,'.',',')."</td>
													<td align='right'>$discount</td>
													<td align='right'>".number_format($amount,2,'.',',')."</td>
													
												</tr>
												";
												}
											}
										}

									}else{
										echo "
											<tr>
												<td colspan='8' align='center'>&nbsp;</td>
											</tr>
										";
									}
												echo "
												<tr>
													<td colspan='7' align='right'>TOTAL</td>												
													<td align='right'>".number_format($medhosp,2)."</td>													
												</tr>
												";
								?>					
                <tr>
									<td colspan="8" style="text-indent:20px;"><b>SUPPLIES</b></td>
								</tr>
								<?php
									$sql="SELECT * FROM collection WHERE datearray BETWEEN '$datefrom' AND '$rundate' AND accttitle LIKE '%PHARMACY/SUPPLIES%' AND amount > 0 AND `type` NOT LIKE '%pending%' GROUP BY ofr,accttitle ORDER BY ofr ASC,accttitle ASC";
									$sqlHospitalBill=mysqli_query($con,$sql);
									$suphosp=0;
									//$arpf=0;
									$supdisc=0;									
									if(mysqli_num_rows($sqlHospitalBill)>0){
										while($hbill=mysqli_fetch_array($sqlHospitalBill)){
											$acctname=$hbill['acctname'];
											$accttitle=$hbill['accttitle'];
											$acctno=$hbill['acctno'];
											$transdate=$hbill['date'];
											$datearray=$hbill['datearray'];
											$description=$hbill['description'];
											$amount=$hbill['amount'];
											$paymentTime=$hbill['paymentTime'];
											$discount = $hbill['discount'];
											$orno = $hbill['ofr'];
											$gross = $amount + $discount;
											$shift1=$hbill['shift'];
											$dept=$hbill['Dept'];
											$p=explode('-',$acctno);
											$pfix=$p[0];
											
												$checkSenior=mysqli_query($con,"SELECT pp.*,a.* FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$acctno' AND pp.senior LIKE '%N%'");
											
											
											if(mysqli_num_rows($checkSenior)>0){
												if(($datearray==$datefrom && $paymentTime >= '16:00:00') || ($datearray==$rundate && $paymentTime <= '16:00:00')){
												$suphosp +=$amount;
												$supdisc +=$discount;												
												echo "
												<tr>
													<td>$acctname</td>
													<td>$orno</td>
													<td>$transdate - $paymentTime</td>
													<td>$accttitle</td>
													<td>$description - $dept</td>
													<td align='right'>".number_format($gross,2,'.',',')."</td>
													<td align='right'>$discount</td>
													<td align='right'>".number_format($amount,2,'.',',')."</td>
													
												</tr>
												";
												}
											}
										}

									}else{
										echo "
											<tr>
												<td colspan='8' align='center'>&nbsp;</td>
											</tr>
										";
									}
												echo "
												<tr>
													<td colspan='7' align='right'>TOTAL</td>												
													<td align='right'>".number_format($suphosp,2)."</td>
													
												</tr>
												";
								?>			
                            </table>
							<?php
								
								$totalhosp=$medhosp+$suphosp;
							?>
							
							<p><b>Hospital Bill: </b><u><?=number_format($totalhosp,2,'.',',');?></u></p>
							<br>
							<p><b>Prepared by</b><br><u><?=$_GET['nursename'];?></u><br>Billing</p>
							<p><b>Checked by</b><br>________________________<br>Accountant</p>
							<p><b>Noted by</b><br><u>ROSARIO A. GAYAS</u><br>Hospital Administrator</p>
                        </div>
                        </div>
                        

                    </div>
                    <!-- /.col-lg-4 -->
                </div>
            </div>
            <script type="text/javascript">
                function printDiv(divName) {
                     var printContents = document.getElementById(divName).innerHTML;
                     var originalContents = document.body.innerHTML;

                     document.body.innerHTML = printContents;

                     window.print();

                     document.body.innerHTML = originalContents;
                }
            </script>