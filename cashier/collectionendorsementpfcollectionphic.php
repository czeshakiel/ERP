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
                    <div class="panel panel-white" id="printableArea" width="100%" style="font-size:12px;">
                        <div class="panel-heading">
                            <center>
                                <table width="100%" border="0">
                                    <tr>
                                        <td align="right" width="5%"><div style="height: 100px;width: 100px;"><img src="../main/img/logo/kmsci.png" width="100" height="100"></div></td>
                                        <td align="center" width="95%"><label style="font-size:18px;font-family: Times New Roman;"><?=$heading;?></label><p><?=$address;?></p><br><label style="font-size: 18px;font-family: Times New Roman;"><b>PROFESSIONAL FEE PHIC REPORT</b></label></td>
                                    </tr>
                                </table>
                            </center>
                        </div>
                        <div class="panel-body" id="printThis">
							<b>RUNNING DATE: <u><?=date('M d, Y',strtotime($startdate));?></u> - <u><?=date('M d, Y',strtotime($enddate));?></u></b><br>
							<b>Collection Type: <u>PHIC Professional Fee</u></b><br>
							<!--b>Doctor: <u><?=$ap;?></u></b-->
                            <table width="100%" cellpadding="1" cellspacing="0" border="1" style="border-collapse: collapse;">
                                <tr>
									<td align="center" style="font-size:10px;font-family: Times New Roman;"><b>PATIENT NAME</b></td>
									<td align="center" style="font-size:10px;font-family: Times New Roman;"><b>DOCTOR</b></td>
									<td align="center" style="font-size:10px;font-family: Times New Roman;"><b>AMOUNT</b></td>									
								<?php
								$totalbill=0;
									$sql=mysqli_query($conn,"SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,po.phic as amount,po.productdesc as doctor FROM admission a LEFT JOIN productout po ON po.caseno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno LEFT JOIN collection c ON c.acctno=a.caseno WHERE ((c.datearray = '$startdate' AND c.paymentTime >= '23:00:00') OR (c.datearray = '$enddate' AND c.paymentTime <= '23:00:00')) AND (a.status='discharged' OR a.ward = 'discharged') AND po.productsubtype='PROFESSIONAL FEE' AND po.phic > 0 AND a.caseno NOT LIKE '%R-%' GROUP BY a.caseno,po.productcode ORDER BY pp.lastname ASC");
									
									if(mysqli_num_rows($sql)>0){
										while($hbill=mysqli_fetch_array($sql)){
											echo "<tr>";
												echo "<td>$hbill[patientname]</td>";
												echo "<td>DR. $hbill[doctor]</td>";
												echo "<td align='right'>$hbill[amount]</td>";
											echo "</tr>";
											$totalbill += $hbill['amount'];
										}
									}else{
										echo "
											<tr style='font-size:10px;font-family: Times New Roman;'>
												<td colspan='3' align='center'>&nbsp;</td>
											</tr>
										";
									}												
								?>
								<tr>
									<td colspan="2" align="right"><b>TOTAL</b></td>
									<td align="right"><?=number_format($totalbill,2);?></td>
								</tr>
                            </table>
                            <br><br>
                            <table border="0" width="100%">
                            	<tr>
                            		<td><b>Prepared by:</b></td>                            		
                            	</tr>
                            	<tr>
                            		<td>&nbsp;</td>                            		
                            	</tr>
                            	<tr>
                            		<td><b><u><?=$_GET['nursename'];?></u></b></td>                            		
                            	</tr>
                            	<tr>
                            		<td>Cashier Staff</td>                            		
                            	</tr>
                            </table>
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
