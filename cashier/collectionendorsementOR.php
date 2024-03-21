			<?php
			ini_set('display_errors',1);
				include('../main/connection.php');
				$rundate=$_GET['startdate'];
				$enddate=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));
				$startdate=date('Y-m-d',strtotime('-1 day',strtotime($enddate)));
				$department=$_GET['department'];
				$shift=$_GET['shift'];
				if($shift==1){
					$starttime="23:00:00";
					$endtime="07:00:00";
					$qry="((datearray = '$startdate' AND paymentTime > '$starttime')  OR (datearray = '$enddate' AND paymentTime < '$endtime')) AND paidBy='$department' AND `type` LIKE '%Visa%'";
				}else if($shift==2){
					$starttime="07:00:01";
					$endtime="15:00:00";
					$startdate=$enddate;
					$qry="datearray = '$startdate' AND paymentTime BETWEEN '$starttime' AND '$endtime' AND paidBy='$department' AND `type` LIKE '%Visa%'";
				}else if($shift==3){
					$starttime="15:00:01";
					$endtime="23:00:00";
					$startdate=$enddate;
					$qry="datearray = '$startdate' AND paymentTime BETWEEN '$starttime' AND '$endtime' AND paidBy='$department' AND `type` LIKE '%Visa%'";
				}else{
					$starttime="23:00:00";
					$endtime="23:00:00";
					if($department=="CASHIER"){
						$qry="((datearray = '$startdate' AND paymentTime > '$starttime')  OR (datearray = '$enddate' AND paymentTime <= '$endtime')) AND `type` LIKE '%Visa%' AND paidBy <> 'CASHIER4'";
					}else{
						$qry="((datearray = '$startdate' AND paymentTime > '$starttime')  OR (datearray = '$enddate' AND paymentTime <= '$endtime')) AND `type` LIKE '%Visa%' AND paidBy='$department'";
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
                        <div class="panel-body">
							<b style="font-size:12px;font-family: Times New Roman;">CASH COLLECTION SUMMARY (DETAIL) - OVERALL</b><br>
							FROM <?=date('F d, Y',strtotime($startdate));?>, <?=date('h:i A',strtotime($starttime));?> TO <?=date('F d, Y',strtotime($enddate));?>, <?=date('h:i A',strtotime($endtime));?><br>
							Shift: <?=$shift;?><br>
							Station: <?=$station;?><br>
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
																$totalcard=0;
																mysqli_query($conn,"SET NAMES 'utf8'");
																if($department=="CASHIER4"){
																	$sqlAccttitle=mysqli_query($conn,"SELECT * FROM accounttitle WHERE accounttitle NOT LIKE 'OTHER FEES' ORDER BY accounttitle ASC");
																}else{
																	$sqlAccttitle=mysqli_query($conn,"SELECT * FROM accounttitle WHERE accounttitle NOT LIKE 'OTHER FEES' AND accounttitle NOT LIKE 'PROFESSIONAL FEE' ORDER BY accounttitle ASC");
																}																
																if(mysqli_num_rows($sqlAccttitle)>0){
																	while($acct=mysqli_fetch_array($sqlAccttitle)){
																		$accttitle=$acct['accounttitle'];
																		if($accttitle=="HOSPITAL BILL"){
																			$accttitle="PATIENTS DEPOSIT";
																		}
																		if($accttitle=="PATIENTS DEPOSIT"){
																			$accttitle="HOSPITAL BILL";
																		}
																		$subtotalgross=0;
																		$subtotaldiscount=0;
																		$subtotalamount=0;
																		$sqlSubAcct=mysqli_query($conn,"SELECT subaccounttitle FROM subaccounttitle WHERE accounttitle='$accttitle'");
																		if(mysqli_num_rows($sqlSubAcct)>0){
																			while($sub=mysqli_fetch_array($sqlSubAcct)){
																				$subaccttitle=$sub['subaccounttitle'];
																				if($accttitle=="BIOPSY INCOME"){
																					$sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle FROM collection WHERE (accttitle LIKE '%LABORATORY%' AND description LIKE '%BIOPSY%') AND $qry GROUP BY ofr ORDER BY ofr ASC");
																					$subaccttitle="BIOPSY";
																				}elseif($accttitle=="LABORATORY"){
																					$sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle FROM collection WHERE (accttitle LIKE '%$subaccttitle%' AND (description NOT LIKE '%BIOPSY%' AND description NOT LIKE '%RAPID TEST%' AND description NOT LIKE '%RT PCR%' AND description NOT LIKE '%RT-PCR%')) AND $qry GROUP BY ofr ORDER BY ofr ASC");

																				}elseif($accttitle=="RAPID TEST"){
																					$sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle FROM collection WHERE (accttitle LIKE '%LABORATORY%' AND description LIKE '%RAPID TEST%') AND $qry GROUP BY ofr ORDER BY ofr ASC");
																					$subaccttitle="RAPID TEST";
																				}elseif($accttitle=="RT PCR"){
																					$sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle FROM collection WHERE ((accttitle LIKE '%LABORATORY%' OR accttitle LIKE '%MISCELLANEOUS%') AND (description LIKE '%RT-PCR%' OR description LIKE '%TRANSPORTATION AND SUPPLIES%')) AND $qry GROUP BY ofr ORDER BY ofr ASC");
																					$subaccttitle="RT PCR";
																				}elseif($accttitle=="RESPIRATORY SUPPLIES"){
																					$sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle FROM collection WHERE (accttitle LIKE '%PHARMACY/SUPPLIES%' AND description LIKE '%NEBULE%') AND $qry AND `type` LIKE '%Visa%' GROUP BY ofr ORDER BY ofr ASC");
																					$subaccttitle="RESPIRATORY SUPPLIES";
																				}
																				elseif($accttitle=="CASHONHAND" && $subaccttitle=="PROFESSIONAL FEE"){
																					$sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle FROM collection WHERE accttitle LIKE '%$subaccttitle%' AND $qry AND (accttitle='PROFESSIONAL FEE' AND `type` LIKE '%card%') GROUP BY ofr ORDER BY ofr ASC");
																					//$subaccttitle="MEDICAL SUPPLIES";

																				}elseif($accttitle=="CASHONHAND"){
																					$sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle FROM collection WHERE accttitle LIKE '%$subaccttitle%' AND $qry AND acctno NOT LIKE 'R-%' GROUP BY ofr ORDER BY ofr ASC");
																				}elseif($accttitle=="A/P RDU"){
																					$sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle FROM collection WHERE accttitle LIKE '%$subaccttitle%' AND $qry AND acctno LIKE 'R-%' GROUP BY ofr ORDER BY ofr ASC");
																				}
																				else{
																					$sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle FROM collection WHERE accttitle = '$subaccttitle' AND $qry AND (CHAR_LENGTH(ofr) < 7 OR (CHAR_LENGTH(ofr) <= 7 AND ofr LIKE '%-%')) GROUP BY ofr ORDER BY ofr ASC");
																				}

																				if(mysqli_num_rows($sqlAmount)>0){
																					echo "<tr>";
																						echo "<td colspan='8'><b>$accttitle</b></td>";
																					echo "</tr>";
																					while($item=mysqli_fetch_array($sqlAmount)){
																						$payor=$item['acctname'];
																						$ofr=$item['ofr'];
																						$particulars=$item['description'];
																						$acct=$item['accttitle'];
																						$paymentDate=$item['date'];
																						$dept=$item['Dept'];
																						$paymentTime=date('h:i A',strtotime($item['paymentTime']));
																						$amount=$item['amount'];
																						$discount=$item['discount'];
																						$gross=$amount+$discount;
																						$type=str_replace('-Visa', '', $item['type']);

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
																						if($accttitle=="HOSPITAL BILL"){
																							//$particulars="PATIENTS DEPOSIT";
																						}
																						if($type=="card"){
																							$totalcard += $amount;
																						}
																						if($accttitle=="AR TRADE"){
																							$subaccttitle=$particulars;
																						}
																						echo "<tr>";
																							echo "<td>$payor</td>";
																							echo "<td>$ofr</td>";
																							echo "<td>$paymentDate / $paymentTime</td>";
																							echo "<td>$particulars - $type</td>";
																							echo "<td>$subaccttitle</td>";
																							echo "<td align='right'>".number_format($gross,2,".",",")."</td>";
																							echo "<td align='right'>".number_format($discount,2,".",",")."</td>";
																							echo "<td align='right'>".number_format($amount,2,".",",")."</td>";
																						echo "</tr>";
																					}
																				}
																			}
																		}
																		if($subtotalgross > 0){
																				echo "<tr>";
																					echo "<td colspan='5'><b>TOTAL</td>";
																					echo "<td align='right'><b>".number_format($subtotalgross,2)."<b/></td>";
																					echo "<td align='right'><b>".number_format($subtotaldiscount,2)."</b></td>";
																					echo "<td align='right'><b>".number_format($subtotalamount,2)."</b></td>";
																				echo "</tr>";
																			}
																		$totalgross +=$subtotalgross;
																		$totaldiscount +=$subtotaldiscount;
																		$totalamount +=$subtotalamount;
																		$hide="";
																		if($subtotalgross == 0){
																			$hide="style='display:none;'";
																		}
																	}
																}
																echo "<tr>";
																	echo "<td colspan='8' align='right'>&nbsp;</td>";
																echo "</tr>";
																echo "<tr>";
																	echo "<td colspan='5' align='right'><b>GRAND TOTAL</b></td>";
																	echo "<td align='right'><b>".number_format($totalgross,2,".",",")."</b></td>";
																	echo "<td align='right'><b>".number_format($totaldiscount,2,".",",")."</b></td>";
																	echo "<td align='right'><b>".number_format($totalamount,2,".",",")."</b></td>";
																echo "</tr>";
																 ?>
                            </table>
                            								<?php
                            								$subtotalgross=0;
															$subtotaldiscount=0;
															$subtotalamount=0;
															$subtotalsupgross=0;
															$starttime="23:00:00";
															$endtime="23:00:00";
																	$sqlAmount=mysqli_query($conn,"SELECT acctno,acctname,ofr,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,accttitle FROM collection WHERE ((datearray = '$startdate' AND paymentTime > '$starttime')  OR (datearray = '$enddate' AND paymentTime <= '$endtime')) AND `type` LIKE '%Visa%' AND ofr <> '' AND (accttitle = 'PHARMACY/MEDICINE' OR accttitle = 'PHARMACY/SUPPLIES' OR accttitle = 'MEDICAL SURGICAL SUPPLIES' OR accttitle='RDU-Supplies' OR accttitle='MEDICAL SUPPLIES' OR accttitle='CSR/KIT SUPPLIES') AND (paidBy='CASHIER3' OR paidBy='CASHIER2') AND CHAR_LENGTH(ofr) >= 7 GROUP BY ofr,accttitle ORDER BY ofr ASC");
																	if(mysqli_num_rows($sqlAmount)>0){
																		while($item=mysqli_fetch_array($sqlAmount)){
																			$amount=$item['amount'];
																			$discount=$item['discount'];
																			$accttitle=$item['accttitle'];
																			//echo $item['ofr']."-".$accttitle."<br>";
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
																			// if($accttitle <> 'PHARMACY/MEDICINE'){
																			// 	$subtotalsupgross += $amount;
																			// }
																			$subtotalgross +=$gross;
																			$subtotalamount +=$amount;
																			$subtotaldiscount +=$discount;
																		}
																	}
                            ?>
                            <b>
                            <p>GROSS HOSPITAL INCOME: <u><?=number_format($totalgross+$subtotalsupgross,2,".",",");?></u></p>
                            <p>TOTAL DISCOUNT: <u>(<?=number_format($totaldiscount,2,".",",");?>)</u></p>                            
                            <p>NET HOSPITAL INCOME: <u><?=number_format($totalamount,2,".",",");?></u></p>
                            <?php
                            if($department=="CASHIER"){
                            ?>
                            <p>NET MEDICINE & SUPPLIES: <u><?=number_format($subtotalamount-$subtotalsupgross,2,".",",");?></u></p>
                            <p>CREDIT CARD PAYMENT: <u>(<?=number_format($totalcard,2,".",",");?>)</u></p>                            
                            <p>TOTAL CASH ON HAND: <u><?=number_format($totalamount-$totalcard+$subtotalamount,2,".",",");?></u></p>
                            <?php
                        }
                            ?>
                        </b>
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
