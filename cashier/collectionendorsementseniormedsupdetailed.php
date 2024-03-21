<?php
	include('../main/connection.php');
	$rundate=$_GET['startdate'];
	$enddate=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));
	$startdate=date('Y-m-d',strtotime('-2 days',strtotime($rundate)));
	$department=$_GET['department'];				
				$shift=$_GET['shift'];
				if($shift==1){
					$starttime="23:00:00";
					$endtime="07:00:00";
					$qry="((datearray = '$startdate' AND paymentTime > '$starttime')  OR (datearray = '$enddate' AND paymentTime < '$endtime')) AND paidBy='$department'";
				}else if($shift==2){
					$starttime="07:01:00";
					$endtime="15:00:00";
					$startdate=$enddate;
					$qry="datearray = '$startdate' AND paymentTime BETWEEN '$starttime' AND '$endtime' AND paidBy='$department'";
				}else if($shift==3){
					$starttime="15:01:00";
					$endtime="23:00:00";
					$startdate=$enddate;
					$qry="datearray = '$startdate' AND paymentTime BETWEEN '$starttime' AND '$endtime' AND paidBy='$department'";
				}else{
					$starttime="23:00:00";
					$endtime="23:00:00";
					if($department=="CASHIER"){
						$qry="((datearray = '$startdate' AND paymentTime > '$starttime')  OR (datearray = '$enddate' AND paymentTime <= '$endtime')) AND paidBy <> 'CASHIER4'";
					}else{
						// $startdate=$startdate." 23:00:00";
						// $enddate=$enddate." 23:00:00";
						$qry="((datearray = '$startdate' AND paymentTime > '$starttime')  OR (datearray = '$enddate' AND paymentTime <= '$endtime')) AND paidBy= '$department'";
						//$qry="CONCAT(datearray,' ',paymentTime) BETWEEN '$startdate' AND '$enddate' AND paidBy= '$department'";
					}			
				}

				if($department=="CASHIER"){
					$station="CASHIER MAIN";
				}
				if($department=="CASHIER2"){
					$station="CASHIER OPD";
				}
				if($department=="CASHIER3"){
					$station="CASHIER PHARMA";
				}
				if($department=="CASHIER4"){
					$station="CASHIER RDU";
				}

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
									<div class="panel-body" id="printThis">
				<b style="font-size:12px;font-family: Times New Roman;">CASH COLLECTION SUMMARY (MEDICINE) - OVERALL DETAILED</b><br>
				FROM <?=date('F d, Y',strtotime($startdate));?>, <?=date('h:i A',strtotime($starttime));?> TO <?=date('F d, Y',strtotime($enddate));?>, <?=date('h:i A',strtotime($endtime));?><br>Shift: <?=$shift;?><br>Station: <?=$station;?><br>
											<table width="100%" cellpadding="1" cellspacing="0" border="1" style="font-size:12px; border-collapse: collapse;" id="example1">
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

															$accttitle=$acct['accounttitle'];
															$subtotalgross=0;
															$subtotaldiscount=0;
															$subtotalamount=0;
																	$sqlAmount=mysqli_query($conn,"SELECT acctno,acctname,ofr,description,accttitle,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,paidBy,type FROM collection WHERE $qry AND type LIKE  '%Visa%' AND ofr <> '' AND accttitle = 'PHARMACY/MEDICINE'  GROUP BY ofr,accttitle ORDER BY accttitle ASC, ofr ASC");
																	if(mysqli_num_rows($sqlAmount)>0){
																		while($item=mysqli_fetch_array($sqlAmount)){
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
																			$type=$item['type'];
																			$gross=$amount+$discount;
																			if(($paymentDate < '2021-04-21' && $ofr=='1002487') || $ofr=='1000973'){
																			$sqlSenior=mysqli_query($conn,"SELECT p.* FROM patientprofile p INNER JOIN admission a ON a.patientidno=p.patientidno WHERE a.caseno='$acctno' AND p.senior='Y'");
																			if(mysqli_num_rows($sqlSenior)>0){
																				$grossvat=$gross/1.12;
																				$discount=$grossvat*.2;
																				$v=$gross-$grossvat;
																				$discount=($grossvat*.2)+$v;
																				$amount=$gross-$discount;
																			}
																		}else{

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
													echo "<tr>";
														echo "<td colspan='8' align='right'>&nbsp;</td>";
													echo "</tr>";
													echo "<tr>";
														echo "<td colspan='5' align='right'><b>MEDICINE TOTAL</b></td>";
														echo "<td align='right'>".number_format($subtotalgross,2,".",",")."</td>";
														echo "<td align='right'>".number_format($subtotaldiscount,2,".",",")."</td>";
														echo "<td align='right'>".number_format($subtotalamount,2,".",",")."</td>";
													echo "</tr>";
													echo "<td colspan='8' align='right'>&nbsp;</td>";
													 ?>
													 <?php
													$totalgrosssup=0;
													$totaldiscountsup=0;
													$totalamountsup=0;

															$accttitle=$acct['accounttitle'];
															$subtotalgrosssup=0;
															$subtotaldiscountsup=0;
															$subtotalamountsup=0;
																	$sqlAmount=mysqli_query($conn,"SELECT acctno,acctname,ofr,description,accttitle,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,paidBy,type FROM collection WHERE $qry AND type LIKE '%Visa%' AND ofr <> '' AND (accttitle = 'PHARMACY/SUPPLIES' OR accttitle = 'MEDICAL SURGICAL SUPPLIES' OR accttitle='RDU-Supplies' OR accttitle='MEDICAL SUPPLIES' OR accttitle='CSR/KIT SUPPLIES') AND CHAR_LENGTH(ofr) >= 7 GROUP BY ofr,accttitle ORDER BY accttitle ASC, ofr ASC");
																	if(mysqli_num_rows($sqlAmount)>0){
																		while($item=mysqli_fetch_array($sqlAmount)){
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
																			$type=$item['type'];
																			$gross=$amount+$discount;
																			if(($paymentDate < '2021-04-21' && $ofr=='1002487') || $ofr=='1000973'){
																			$sqlSenior=mysqli_query($conn,"SELECT p.* FROM patientprofile p INNER JOIN admission a ON a.patientidno=p.patientidno WHERE a.caseno='$acctno' AND p.senior='Y'");
																			if(mysqli_num_rows($sqlSenior)>0){
																				$grossvat=$gross/1.12;
																				$discount=$grossvat*.2;
																				$v=$gross-$grossvat;
																				$discount=($grossvat*.2)+$v;
																				$amount=$gross-$discount;
																			}
																		}else{

																		}
																			$subtotalgrosssup +=$gross;
																			$subtotalamountsup +=$amount;
																			$subtotaldiscountsup +=$discount;
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
														echo "<td colspan='5' align='right'><b>SUPPLIES TOTAL</b></td>";
														echo "<td align='right'>".number_format($subtotalgrosssup,2,".",",")."</td>";
														echo "<td align='right'>".number_format($subtotaldiscountsup,2,".",",")."</td>";
														echo "<td align='right'>".number_format($subtotalamountsup,2,".",",")."</td>";
													echo "</tr>";
													echo "<tr>";
														echo "<td colspan='8' align='right'>&nbsp;</td>";
													echo "</tr>";
													echo "<tr>";
														echo "<td colspan='5' align='right'><b>GRAND TOTAL</b></td>";
														echo "<td align='right'><b>".number_format($subtotalgrosssup+$subtotalgross,2,".",",")."</b></td>";
														echo "<td align='right'><b>".number_format($subtotaldiscountsup+$subtotaldiscount,2,".",",")."</b></td>";
														echo "<td align='right'><b>".number_format($subtotalamountsup+$subtotalamount,2,".",",")."</b></td>";
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
