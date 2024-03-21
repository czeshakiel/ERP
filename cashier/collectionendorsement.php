			<?php
				include('../includes/config.php');
				$startdate=$_GET['startdate'];
				$enddate=$_GET['enddate'];
				$starttime=date('H:i:s',strtotime($_GET['starttime']));
				$endtime=date('H:i:s',strtotime($_GET['endtime']));
				//$dateto=date('Y-m-d',strtotime('1 day',strtotime($rundate)));
				//$datefrom=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));

				$sql123="SELECT * FROM heading";
				$sqlMission=mysqli_query($con,$sql123);
				$mv=mysqli_fetch_array($sqlMission);
				$heading=$mv['heading'];
				$address=$mv['address'];
				$telno=$mv['telno'];
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
                                        <td align="right" width="5%"><div style="height: 100px;width: 100px;"><img src="../images/kmsci.jpg" width="100" height="100"></div></td>
                                        <td align="center" width="95%"><label style="font-size:18px;font-family: Times New Roman;"><?=$heading;?></label><p><?=$address;?></p><label style="font-size: 20px;font-family: Times New Roman;">COLLECTION REPORT</label></td>
                                    </tr>
                                </table>
                            </center>
                        </div>
                        <div class="panel-body">
							<b style="font-size:12px;font-family: Times New Roman;">CASH COLLECTION SUMMARY (DETAIL) - OVERALL</b><br>
							FROM <?=date('F d, Y',strtotime($startdate));?>, <?=date('H:i A',strtotime($starttime));?> TO <?=date('F d, Y',strtotime($enddate));?>, <?=date('H:i A',strtotime($endtime));?><br>
                            <table width="730" cellpadding="1" cellspacing="2" class="table table-hover table-bordered" style="font-size:12px;">
                                <tr style='font-size:10px;font-family: Times New Roman;'>
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
																mysqli_query($con,"SET NAMES 'utf8'");
																$sqlAccttitle=mysqli_query($con,"SELECT * FROM accounttitle WHERE accounttitle NOT LIKE 'OTHER FEES' ORDER BY accounttitle ASC");
																if(mysqli_num_rows($sqlAccttitle)>0){
																	while($acct=mysqli_fetch_array($sqlAccttitle)){
																		$accttitle=$acct['accounttitle'];
																		echo "<tr>";
																			echo "<td colspan='8'><b>$accttitle</b></td>";
																		echo "</tr>";
																		$subtotalgross=0;
																		$subtotaldiscount=0;
																		$subtotalamount=0;
																		$sqlSubAcct=mysqli_query($con,"SELECT subaccounttitle FROM subaccounttitle WHERE accounttitle='$accttitle'");
																		if(mysqli_num_rows($sqlSubAcct)>0){
																			while($sub=mysqli_fetch_array($sqlSubAcct)){
																				$subaccttitle=$sub['subaccounttitle'];
																				$sqlAmount=mysqli_query($con,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount FROM collection WHERE accttitle LIKE '%$subaccttitle%' AND ((datearray BETWEEN '$startdate' AND '$enddate' AND paymentTime >= '$starttime') OR (datearray BETWEEN '$startdate' AND '$enddate' AND paymentTime <= '$endtime')) AND `type` NOT LIKE '%pending%' GROUP BY description,accttitle,ofr ORDER BY ofr ASC");
																				if(mysqli_num_rows($sqlAmount)>0){
																					while($item=mysqli_fetch_array($sqlAmount)){
																						$payor=$item['acctname'];
																						$ofr=$item['ofr'];
																						$particulars=$item['description'];
																						$paymentDate=$item['date'];
																						$dept=$item['Dept'];
																						$paymentTime=$item['paymentTime'];
																						$amount=$item['amount'];
																						$discount=$item['discount'];
																						$gross=$amount+$discount;
																						if($ofr=="798377"){
																							$grossvat=$gross/1.12;
																							$discount=$grossvat*.2;
																							$v=$gross-$grossvat;
																							$discount=($grossvat*.2)+$v;
																							$amount=$gross-$discount;
																						}
																						$subtotalgross +=$gross;
																						$subtotalamount +=$amount;
																						$subtotaldiscount +=$discount;
																						echo "<tr>";
																							echo "<td>$payor</td>";
																							echo "<td>$ofr</td>";
																							echo "<td>$paymentDate / $paymentTime</td>";
																							echo "<td>$particulars</td>";
																							echo "<td>$subaccttitle</td>";
																							echo "<td align='right'>".number_format($gross,2,".",",")."</td>";
																							echo "<td align='right'>".number_format($discount,2,".",",")."</td>";
																							echo "<td align='right'>".number_format($amount,2,".",",")."</td>";
																						echo "</tr>";
																					}
																				}
																			}
																		}
																		$totalgross +=$subtotalgross;
																		$totaldiscount +=$subtotaldiscount;
																		$totalamount +=$subtotalamount;
																		echo "<tr>";
																			echo "<td colspan='5' align='right'><b> SUB TOTAL</b></td>";
																			echo "<td align='right'>".number_format($subtotalgross,2,".",",")."</td>";
																			echo "<td align='right'>".number_format($subtotaldiscount,2,".",",")."</td>";
																			echo "<td align='right'>".number_format($subtotalamount,2,".",",")."</td>";
																		echo "</tr>";
																	}
																}
																echo "<tr>";
																	echo "<td colspan='8' align='right'>&nbsp;</td>";
																echo "</tr>";
																echo "<tr>";
																	echo "<td colspan='5' align='right'><b>GRAND TOTAL</b></td>";
																	echo "<td align='right'>".number_format($totalgross,2,".",",")."</td>";
																	echo "<td align='right'>".number_format($totaldiscount,2,".",",")."</td>";
																	echo "<td align='right'>".number_format($totalamount,2,".",",")."</td>";
																echo "</tr>";
																 ?>
                            </table>


							<br>
							<p style='float:left;' style="font-size:8px;font-family: Times New Roman;"><b>Prepared by</b><br><br><u><?=$_GET['nursename'];?></u><br>CASHIER</p>
							<p style='float:left; margin-left:100px' style="font-size:8px;font-family: Times New Roman;"><b>Checked by</b><br><br><u>ROSEMARIE AGRIPO</u><br>CASHIER-HEAD</p>
							<p style='float:left; margin-left:100px' style="font-size:8px;font-family: Times New Roman;"><b>Noted by</b><br><br><u></u><br>FINANCE OFFICER</p>
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
