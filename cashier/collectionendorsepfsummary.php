<?php
				include('../main/connection.php');
				mysqli_query($conn,"SET NAMES 'utf8'");
				$rundate=$_GET['startdate'];
				$enddate=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));
				$startdate=date('Y-m-d',strtotime('-1 day',strtotime($enddate)));	
				//$ap=str_replace('%20',' ',$_GET['ap']);
				$ap=$_GET['ap'];
				$sql123="SELECT * FROM heading";
				$sqlMission=mysqli_query($conn,$sql123);
				$mv=mysqli_fetch_array($sqlMission);
				$heading=$mv['heading'];
				$address=$mv['address'];
				$telno=$mv['telno'];
                ?>
            <div class="row">
                <div class="col-lg-12">                   
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
                        <div class="panel-body">
							DATE RANGE:<b style="font-size:12px;font-family: Times New Roman;"> <?=date('F d, Y',strtotime($startdate));?> - <?=date('F d, Y',strtotime($enddate));?></b><br>
							DOCTOR:<b style="font-size:12px;font-family: Times New Roman;"> DR. <?=$ap;?></b><br><br />
							<!--b>Doctor: <u><?=$ap;?></u></b-->
                            <table width="100%" cellpadding="1" border="1" cellspacing="0" style="border-collapse: collapse;">
                                <tr>
									<td align="center" style="font-size:12px;font-family: Times New Roman;"><b>PATIENT NAME</b></td>
									<td align="center" style="font-size:12px;font-family: Times New Roman;" width="10%"><b>OR No.</b></td>
									<td align="center" style="font-size:12px;font-family: Times New Roman;" width="15%"><b>DATE</b></td>
									<!--td align="center"><b>PARTICULARS</b></td>
									<td align="center"><b>DESCRIPTION</b></td-->
									<!--td align="center" style="font-size:10px;font-family: Times New Roman;"><b>GROSS</b></td>
									<td align="center" style="font-size:10px;font-family: Times New Roman;"><b>DISCOUNT</b></td-->
									<td align="center" style="font-size:12px;font-family: Times New Roman;"><b>TOTAL AMOUNT</b></td>

								</tr>
								<?php

									$sql="SELECT *,SUM(amount) as amount FROM collection WHERE ((datearray = '$startdate' AND paymentTime > '23:00:00') OR (datearray='$enddate' AND paymentTime <= '23:00:00')) AND accttitle LIKE '%PROFESSIONAL FEE%' AND description LIKE '%$ap%' AND amount > 0 AND `type` NOT LIKE '%pending%' AND `type` <> 'card-Visa' GROUP BY ofr ORDER BY acctname ASC";
									$sqlHospitalBill=mysqli_query($conn,$sql);
									$diaghosp=0;
									//$arpf=0;
									$diagdisc=0;
									if(mysqli_num_rows($sqlHospitalBill)>0){
										while($hbill=mysqli_fetch_array($sqlHospitalBill)){
											$acctname=$hbill['acctname'];
											$accttitle=$hbill['accttitle'];
											$acctno=$hbill['acctno'];
											$transdate=date('m/d/Y',strtotime($hbill['date']));
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

											//if($rundate==$dateto){
												//if(($datearray >= $rundate && $paymentTime > '00:00:00') && ($datearray <= $dateto && $paymentTime <= '23:59:00')){
													$diaghosp +=$amount;
												$diagdisc +=$discount;
												echo "
												<tr style='font-size:12px;font-family: Times New Roman;'>
													<td style='padding:5px;'>$acctname</td>
													<td align='center'>$orno</td>
													<td align='center'>$transdate</td>
													<!--td>$accttitle</td>
													<td>$description - $dept</td-->
													<!--td align='right'>".number_format($gross,2,'.',',')."</td>
													<td align='right'>$discount</td-->
													<td align='right' style='padding:5px;'>".number_format($amount,2,'.',',')."</td>

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
											<tr>
												<td colspan='4' align='center'>&nbsp;</td>
											</tr>
										";
									}
												echo "
												<tr style='font-size:12px;font-family: Times New Roman;font-weight: bold;'>
													<td colspan='3' align='right' style='padding:5px;'>TOTAL</td>
													<td align='right' style='padding:5px;'>".number_format($diaghosp,2)."</td>

												</tr>
												";
								?>
                            </table>
							<?php

								$totalhosp=$diaghosp;
							?>

							<!--p style="font-size:12px;font-family: Times New Roman;"><b>Professional Fee: </b><u><?=number_format($totalhosp,2,'.',',');?></u></p-->
							<br>
							<table border="0" cellspacing="0" width="100%" style="font-size:12px;font-family: Times New Roman;">
								<tr>
									<td>Prepared by:</td>
									<td>Checked by:</td>
									<td>Noted by:</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
								</tr>
								<tr>
									<td><u><?=$_GET['nursename'];?></u></td>
									<td>______________________________</td>
									<td>______________________________</td>
								</tr>
								<tr>
									<td>Cashier Staff</td>
									<td>Accounting Unit</td>
									<td>Hospital Administrator</td>
								</tr>
							</table>
							<!--p><b>Noted by</b><br><u>VIEVINIA T. ALLIDA, MAHA</u><br>Hospital Administrator</p-->


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
