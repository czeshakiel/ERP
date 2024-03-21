				<?php
					include('../main/connection.php');
					$rundate=$_GET['startdate'];
				$enddate=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));
				$startdate=date('Y-m-d',strtotime('-1 day',strtotime($enddate)));
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
						$qry="((datearray = '$startdate' AND paymentTime > '$starttime')  OR (datearray = '$enddate' AND paymentTime <= '$endtime')) AND accttitle NOT LIKE '%MEDICINE%' AND paidBy <> 'CASHIER4' AND paidBy <> 'CASHIER3' AND paidBy <> 'CASHIER2'";
					}else if($department=="CASHIER3"){
						$qry="((datearray = '$startdate' AND paymentTime > '$starttime')  OR (datearray = '$enddate' AND paymentTime <= '$endtime')) AND paidBy='$department' AND (accttitle LIKE '%MEDICINE%' OR accttitle LIKE '%SUPPLIES%')";
					}else{
						$qry="((datearray = '$startdate' AND paymentTime > '$starttime')  OR (datearray = '$enddate' AND paymentTime <= '$endtime')) AND paidBy='$department'";
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
								FROM <?=date('F d, Y',strtotime($startdate));?>, <?php echo "11:00 PM";?> TO <?=date('F d, Y',strtotime($enddate));?>, <?php echo "11:00 PM";?><br>
								Shift: <?=$shift;?><br>
							Station: <?=$station;?><br>
	                            <table width="100%" border="1" style="font-size:16px; border-collapse: collapse;">
	                                <tr style='font-size:10px;font-family: Times New Roman;'>
																		<!-- <td align="center" ><b>PAYOR NAME</b></td> -->
																		<td align="center" style="font-size:10px;font-family: Times New Roman;"><b>OR No.</b></td>
																		<td align="center" style="font-size:10px;font-family: Times New Roman;"><b>DATE / TIME</b></td>
																		<td align="center" style="font-size:10px;font-family: Times New Roman;"><b>PATIENT NAME</b></td>
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
																			mysqli_query($conn,"SET NAMES 'utf8'");
																					//$sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,accttitle,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount FROM collection WHERE accttitle NOT LIKE '%PROFESSIONAL FEE%' AND accttitle NOT LIKE '%PHARMACY/MEDICINE%' AND ((datearray BETWEEN '$startdate' AND '$enddate' AND paymentTime >= '$starttime') OR (datearray BETWEEN '$startdate' AND '$enddate' AND paymentTime <= '$endtime')) AND ofr <> '' GROUP BY
																					$sqlAmount=mysqli_query($conn,"SELECT acctno,acctname,ofr,description,accttitle,datearray,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type` FROM collection WHERE $qry AND ((`type` LIKE '%Visa%' AND accttitle <> 'PROFESSIONAL FEE') OR (accttitle = 'PROFESSIONAL FEE' AND type='card-Visa')) GROUP BY ofr ORDER BY ofr ASC");
																					if(mysqli_num_rows($sqlAmount)>0){
																						while($item=mysqli_fetch_array($sqlAmount)){
																							$acctno=$item['acctno'];
																							$payor=$item['acctname'];
																							$ofr=$item['ofr'];
																							$particulars=$item['description'];
																							$subaccttitle=$item['accttitle'];
																							$paymentDate=$item['datearray'];
																							$dept=$item['Dept'];
																							$paymentTime=date('h:i A',strtotime($item['paymentTime']));
																							$amount=$item['amount'];
																							$discount=$item['discount'];
																							$gross=$amount+$discount;
																							$vat=($discount/$gross)*100;
																							$type=$item['type'];
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
																							if($subaccttitle=="PROFESSIONAL FEE" && $type=="cash-Visa"){
																								$gross=0;
																								$discount=0;
																								$amount=0;
																							}
																							if($subaccttitle=="PROFESSIONAL FEE" && $type=="card-Visa"){
																								$subaccttitle="CASHONHAND card";
																							}
																							// $act=explode('-',$acctno);
																							// if($act[0]=="R" && ($particulars=="HOSPITAL BILL" || $subaccttitle=="RDU-SUPPLIES" || $particulars=="PROCESSING FEE (RDU)" || $subaccttitle=="RDU-MEDICINE" || $subaccttitle=="OXYGEN SUPPLIES")){}else{
																							$subtotalgross +=$gross;
																							$subtotalamount +=$amount;
																							$subtotaldiscount +=$discount;

																							if($particulars=="RAPID TEST - PATIENT" || $particulars=="RAPID TEST - WATCHER/OPD" || $particulars=="RAPID TEST" || $particulars=="RAPID TEST (RDU PATIENT)" || $particulars=="RAPID TEST - EMPLOYEE"){
																								$subaccttitle="RAPID TEST";
																							}
																							else if($particulars=="RT PCR (SURGICAL)" OR $particulars=="RT PCR (OPD)" OR $particulars=="RT PCR (IM CASE)" OR $particulars=="RT-PCR (REGULAR)" OR $particulars=="TRANSPORTATION AND SUPPLIES (REG)" OR $particulars=="RT-PCR (RDU)" OR $particulars=="TRANSPORTATION AND SUPPLIES (RDU)" OR $particulars=="RT-PCR (HC)" OR $particulars=="TRANSPORTATION AND SUPPLIES (HC)" OR $particulars=="RT-PCR (RUSH)" OR $particulars=="TRANSPORTATION AND SUPPLIES (RUSH)"){
																								$subaccttitle="RT PCR";
																							}
																							else if($particulars=="BIOPSY SMALL" OR $particulars=="BIOPSY MEDIUM" OR $particulars=="BIOPSY X-LARGE" OR $particulars=="BIOPSY PACKAGE(XXL)" OR $particulars=="BIOPSY LARGE" OR $particulars=="BIOPSY LUNGS" OR $particulars=="BIOPSY"  OR $particulars=="RECTAL BIOPSY (SCHISTOSOMA OVA)"){
																								$subaccttitle="BIOPSY";
																							}
																							else if($particulars=="NEWBORN HEARING TEST SUPPLIES" OR $particulars=="NEWBORN HEARING TEST"){
																								$subaccttitle="NEWBORN HEARING TEST";
																							}
																							else if($particulars=="NEWBORN SCREENING"){
																								$subaccttitle="NEWBORN SCREENING";
																							}
																							else if($subaccttitle=="PHARMACY/SUPPLIES"){
																								//$subaccttitle="MEDICAL SUPPLIES";
																							}
																						
																							else if($subaccttitle=="PATIENTS DEPOSIT"){
																								$particulars="PATIENTS DEPOSIT";
																							}
																							
																								if(stripos($particulars, "NEBULE") !== FALSE){
                                                        $subaccttitle="RESPIRATORY SUPPLIES";
																								}
																							
																							echo "<tr>";
																								//echo "<td>$payor</td>";
																								echo "<td>$ofr</td>";
																								echo "<td>".date('m/d/Y',strtotime($paymentDate))." / $paymentTime</td>";
																								echo "<td>$payor</td>";
																								 echo "<td>$subaccttitle</td>";
																								echo "<td align='right'>".number_format($gross,2,".",",")."</td>";
																								echo "<td align='right'>".number_format($discount,2,".",",")."</td>";
																								echo "<td align='right'>".number_format($amount,2,".",",")."</td>";
																							echo "</tr>";
																						//}
																						}
																					}
																	echo "<tr>";
																		echo "<td colspan='6' align='right'>&nbsp;</td>";
																	echo "</tr>";
																	echo "<tr>";
																		echo "<td colspan='3' align='right'><b>GRAND TOTAL</b></td>";
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
