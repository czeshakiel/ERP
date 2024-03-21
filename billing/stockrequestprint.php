			<?php
				include("../main/class.php");
				$pono=$_GET['reqno'];
				$st=$_GET['dept'];
                $sqlProfile=mysqli_query($conn,"SELECT * FROM purchaseorder WHERE reqno='$pono'");
                if(mysqli_num_rows($sqlProfile)>0){
                    $profile=mysqli_fetch_array($sqlProfile);
                    $dept=$profile['dept'];
                }else{
                    $supcode="";
                }
			?>
            <html>
            <head>
            <title>STOCK TRANSFER REQUISITION SLIP</title>
            <style type="text/css">
                /* Styles go here */

                    .page-header, .page-header-space {
                    height: 90px;;
                    }

                    .page-footer, .page-footer-space {
                    height: auto;

                    }

                    .page-footer {
                    position: fixed;
                    bottom: 0mm;
                    width: 100%;
                    border-top: 0;
                    background-color:white;
                    }

                    .page-header {
                    position: fixed;
                    top: 0mm;
                    width: 100%;
                    background-color:white;

                    }

                    .page {
                    page-break-after: always;
                    margin-top:80px;
                    }

                    @page {
                    margin: 34px;
                    }

                    @media print {
                    thead {display: table-header-group;}
                    tfoot {display: table-footer-group;}

                    button {display: none;}

                    body {margin: 0;}
                    }
            </style>
            </head>
                    <body>
                        <div class="page-header">
                            <center>
                                <table width="100%" border="0" style="font-family:Arial; font-size:12px;">
                                    <tr>
                                        <td align="right" width="5%"><div style="height: 50px;width: 50px;"><img src="../main/assets/favicon/favicon.png" width="50" height="50"></div></td>
                                        <td align="center" width="65%"><label style="font-size:18px;font-family: Arial;font-weight: bold;">KIDAPAWAN MEDICAL SPECIALISTS CENTER, INC.</label><br>Brgy. Sudapin, Kidapawan City<br><br><br><label style="font-size: 24px;font-family: Arial;">STOCK TRANSFER REQUISITION</label></td>
                                    </tr>
                                </table>

                            <br>
                            <button type="button" onclick="window.print();" style="border-radius:50px; border:1px solid #ccc; float:left">PRINT</button>
                            <table width="100%" cellpadding="0" cellspacing="0" class="table" style="font-family:Arial; font-size:12px;" border="0">
                                	<tr>
										<td width="20%">Requested to: </td>
										<td width="50%"><u><b><?=$dept;?></b></u></td>
                                        <td width="10%" align="left">STR No.:</td>
                                        <td width="20%"><u><b><?=$pono;?></b></u></td>
									</tr>
									<tr>
										<td>Requested By: </td>
										<td><b><u><?=$st;?></b></u></td>
                                        <td>Date: </td>
										<td><b><u><?=$profile['reqdate'];?></b></u></td>
									</tr>
                            </table>
                            </center>
                        </div>
                        <center>
                        <table width="100%" border="0">
                        <thead>
                            <tr>
                                <td>
                                    <div class="page-header-space">&nbsp;</div>
                                </td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="font-family:Arial; font-size:12px;" class="page">
															<tr>
																<td align="center" style="border-bottom:1px solid;" width='20'>#</td>
																<td align="center" style="border-bottom:1px solid;" width='50'>QTY.</td>
																<td align="left" style="border-bottom:1px solid;">DESCRIPTION</td>
																<td align="left" style="border-bottom:1px solid;">LAST DATE REQUESTED</td>
															</tr>
															<tr>
																	<td colspan="3">&nbsp;</td>
															</tr>
															<?php
																	$num=0;
																	$sql="SELECT * FROM purchaseorder WHERE po='$pono' AND `status` NOT LIKE '%Cancel%' AND `status` NOT LIKE '%poreceived%'";
																	$sqlItems=mysqli_query($conn,$sql);
																	$totalamount=0;

																	if(mysqli_num_rows($sqlItems)>0){
																			while($item=mysqli_fetch_array($sqlItems)){
																					$sql1="SELECT reqdate FROM purchaseorder WHERE code='$item[code]' AND reqdept='$st' AND `status`='received' AND reqdate < '$item[reqdate]' GROUP BY reqno ORDER BY reqdate DESC";
																					$sqlDate=mysqli_query($conn,$sql1);
																					$sdate=mysqli_fetch_array($sqlDate);
																					$num++;
																																													$description= $item['description'];
																																													$description=str_replace('cmshi-', '', $description);
																																													$description=str_replace('ams-', '', $description);
																																													$description=str_replace('amc-', '', $description);
																																													$description=str_replace('RDU-', '', $description);
																																													$description=str_replace('-sup', '', $description);
																																													$description=str_replace('-med', '', $description);
																					echo
																					"<tr>
																					<td align='left'>$num</td>
																						<td align='center'>$item[prodqty]</td>
																						<td align='left'>$description</td>
																						<td align='left'>$sdate[reqdate]</td>
																					 </tr>";
                                            }
                                        }
                                    ?>
                                    <tr>
                                        <td colspan="4" style="border-bottom:1px solid">&nbsp;</td>
                                    </tr>
                            </table>
                        </td>
                        </tr>
                        </tbody>
                        </table>
                        </center>
                        <!--div class="page-footer"-->
													<table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-family:Arial; font-size:10px; font-weight:bold;">
															<tr>
																	<td align="left" colspan="2">Requested by:</td>
																	<td align="left" colspan="2">Received by:</td>
																	<td align="left" colspan="2">Approved by: </td>

															</tr>
															<tr>
																	<td align="left" colspan="2"><br>_______________________________</td>
																	<td align="left" colspan="2"><br>_______________________________</td>
																	<td align="left" colspan="2"><br>_______________________________</td>

															</tr>
															<tr>
																<td colspan="4">&nbsp;</td>
															</tr>
															<tr>
																	<td align="left" colspan="2">&nbsp;</td>
																	<td colspan="2">&nbsp;</td>
															</tr>
													</table>
                    <!--/div-->
                    <!-- /.col-lg-4 -->
                    </body>
                    </html>
