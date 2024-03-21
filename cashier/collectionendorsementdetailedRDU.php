				<?php
					include('../main/connection.php');
					$startdate=$_GET['startdate'];
					$enddate=$_GET['enddate'];
					// $starttime=date('H:i:s',strtotime($_GET['starttime']));
					// $endtime=date('H:i:s',strtotime($_GET['endtime']));
					$orstart=$_GET['orstart'];
					$orend=$_GET['orend'];
					$orstart1=$_GET['orstart1'];
					$orend1=$_GET['orend1'];
					$orstart=str_replace('.','',$orstart);
					$orend=str_replace('.','',$orend);
					$orstart1=str_replace('.','',$orstart1);
					$orend1=str_replace('.','',$orend1);
					$orstart=str_replace('-0','',$orstart);
					$orend=str_replace('-0','',$orend);
					$orstart1=str_replace('-0','',$orstart1);
					$orend1=str_replace('-0','',$orend1);
					//$dateto=date('Y-m-d',strtotime('1 day',strtotime($rundate)));
					//$datefrom=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));

					$sql123="SELECT * FROM heading";
					$sqlMission=mysqli_query($conn,$sql123);
					$mv=mysqli_fetch_array($sqlMission);
					$heading=$mv['heading'];
					$address=$mv['address'];
					$telno=$mv['telno'];
					$email=$mv['FullAddress'];
	                ?>
	            
	            <div class="row">
                <div class="col-lg-12">
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td width="90">
          <img src="../main/img/logo/kmsci.png" width="80" height="80" />
        </td>
        <td>
          <b style="font-family:'Times New Roman'; font-size:16px;"><?=$heading;?></b><br />
          <font style="font-family:'Times New Roman'; font-size:12px;">
            <?=$address;?><br />
            <?=$email;?><br />
            <?=$telno;?>
          </font>
        </td>
      </tr>
    </table>
</div>
<br>
	                        <div class="panel-body">
														<div id="printThis">
								<b style="font-size:12px;font-family: Times New Roman;">CASH COLLECTION SUMMARY (DETAIL) - OVERALL</b><br>
								FROM <?=date('F d, Y',strtotime($startdate));?>, <?=date('H:i A',strtotime($starttime));?> TO <?=date('F d, Y',strtotime($enddate));?>, <?=date('H:i A',strtotime($endtime));?><br><br>
	                            <table width="100%" border="1" style="font-size:12px; border-collapse: collapse;">
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
																			$subtotalgross=0;
																			$subtotaldiscount=0;
																			$subtotalamount=0;
																			mysqli_query($conn,"SET NAMES 'utf8'");
																					//$sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,accttitle,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount FROM collection WHERE accttitle NOT LIKE '%PROFESSIONAL FEE%' AND accttitle NOT LIKE '%PHARMACY/MEDICINE%' AND ((datearray BETWEEN '$startdate' AND '$enddate' AND paymentTime >= '$starttime') OR (datearray BETWEEN '$startdate' AND '$enddate' AND paymentTime <= '$endtime')) AND ofr <> '' GROUP BY
																					$sqlAmount=mysqli_query($conn,"SELECT acctno,acctname,ofr,description,accttitle,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount FROM collection WHERE accttitle NOT LIKE '%PHARMACY/MEDICINE%' AND accttitle NOT LIKE '%REFUND-ITEMS' AND datearray BETWEEN '$startdate' AND '$enddate' AND (ofr BETWEEN '$orstart' AND '$orend' OR ofr BETWEEN '$orstart1' AND '$orend1') AND ofr <> '' AND ((acctno LIKE 'R-%' AND (description LIKE '%RDU%' OR description LIKE '%HOSPITAL BILL%' OR accttitle LIKE '%PROFESSIONAL FEE%' or  accttitle LIKE '%OXYGEN SUPPLIES%')) OR (acctno LIKE 'WD-%' AND description LIKE '%(RDU)%' or  accttitle LIKE '%OXYGEN SUPPLIES%')) GROUP BY description,accttitle,ofr ORDER BY ofr ASC");

																					if(mysqli_num_rows($sqlAmount)>0){
																						while($item=mysqli_fetch_array($sqlAmount)){
																							$acctno=$item['acctno'];
																							$payor=$item['acctname'];
																							$ofr=$item['ofr'];
																							$particulars=$item['description'];
																							$subaccttitle=$item['accttitle'];
																							$paymentDate=$item['date'];
																							$dept=$item['Dept'];
																							$paymentTime=date('h:i A',strtotime($item['paymentTime']));
																							$amount=$item['amount'];
																							$discount=$item['discount'];
																							$gross=$amount+$discount;
																							$vat=($discount/$gross)*100;
																							if($ofr=="798377" && $paymentDate=='2021-04-12' && $paymentTime < $starttime){
																								$grossvat=$gross/1.12;
																								$discount=$grossvat*.2;
																								$v=$gross-$grossvat;
																								$discount=($grossvat*.2)+$v;
																								$amount=$gross-$discount;
																							}

																							if($subaccttitle=="PHARMACY/SUPPLIES" && $paymentDate < '2021-04-21'){
																								$sqlSenior=mysqli_query($conn,"SELECT pp.* FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$acctno' AND pp.senior='Y'");
																								if(mysqli_num_rows($sqlSenior)>0){
																									$grossvat=round($gross/1.12,3);
																									$discount=round($grossvat*.2,4);
																									$v=$gross-$grossvat;
																									$discount=(round($grossvat*.2,4))+$v;
																									$amount=round($gross-$discount,3);
																								}
																							}
																							$subtotalgross +=$gross;
																							$subtotalamount +=$amount;
																							$subtotaldiscount +=$discount;

																							if($particulars=="RAPID TEST - PATIENT" || $particulars=="RAPID TEST - WATCHER"){
																								$subaccttitle="RAPID TEST";
																							}
																							else if($particulars=="RT PCR (SURGICAL)" || $particulars=="RT PCR (OPD)" || $particulars=="RT PCR (IM CASE)"){
																								$subaccttitle="RT PCR";
																							}
																							else if($subaccttitle=="CASHONHAND"){
																								$subaccttitle="HOSPITAL BILL";
																							}
																							else if($subaccttitle=="PATIENTS DEPOSIT"){
																								$particulars="PATIENTS DEPOSIT";
																							}
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
