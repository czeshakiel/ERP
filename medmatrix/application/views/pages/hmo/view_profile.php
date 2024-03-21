<script type="text/javascript">
	function  updatePrice(){
		var hmo = document.getElementById('price_hmo');
		var discount = 0;
		var srp = document.getElementById('price_srp');
		discount = parseFloat(srp.value)-parseFloat(hmo.value);
		document.getElementById('price_discount').value = discount.toFixed(2);
	}	
</script>
<?php
$query=$this->Admission_model->db->query("SELECT * FROM admissionaddinfo WHERE caseno='$caseno'");
$info=$query->row_array();
?>
<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row clearfix">
			<div class="col-md-12">
				<div class="card border-0 mb-4 no-bg">
					<div class="card-header py-3 px-0 d-flex align-items-center  justify-content-between border-bottom">
						<h5 class=" fw-bold flex-fill mb-0"><?=$title;?></h5>
					</div>
				</div>
			</div>
		</div><!-- Row End -->
		<div class="row g-3">
			<div class="col-xl-12 col-lg-12 col-md-12">
				<?php
				if($this->session->save_success){
					?>
					<div class="alert alert-success"><?=$this->session->save_success;?></div>
					<?php
				}
				?>
				<?php
				if($this->session->save_failed){
					?>
					<div class="alert alert-danger"><?=$this->session->save_failed;?></div>
					<?php
				}
				?>
				<div class="card teacher-card  mb-3">
					<div class="card-body  d-flex teacher-fulldeatil">
						<div class="profile-teacher pe-xl-4 pe-md-2 pe-sm-4 pe-0 text-center w220 mx-sm-0 mx-auto">
							<?php
							if($patient['sex']=="M"){
								$avatar="avatar3.jpg";
								$sex="icofont-boy";
								$gender="Male";
							}else{
								$avatar="avatar6.jpg";
								$sex="icofont-girl";
								$gender="Female";
							}
							if($patient['senior']=="Y"){
								$senior="Senior";
							}else{
								$senior="Non-Senior";
							}
							$name=$patient['lastname'].", ".$patient['firstname']." ".$patient['middlename']." ".$patient['suffix'];
							$dept=$this->session->dept;
							$user=$this->session->fullname;
							$username=$this->session->username;
							?>
							<?php
						
						$c=explode('-',$patient['caseno']);
						
						$hmo="";
							$nhmo="style='display:none;'";
							$whmo="";
							$soa="style='display:none;'";
							$vs="style='display:none;'";
							if($department=="HMO"){
								if($patient['hmo'] == "N/A"){
									$whmo="style='display:none;'";
								}
								$hmo="style='display:none;'";
								$nhmo="";
								$soa="";
								$vs="";
							}
							//$ass="style='display:none;'";
							//if($patient['status']=="MGH"){
								$ass="";
							//}
						if($patient['status']=="discharged"){
							$open="";
							$final="style='display:none;'";
							$nhmo="style='display:none;'";
						}else{
							$open="style='display:none;'";
							$final="";
							$nhmo="";
						}
						$excess="";
								if($c[0]=="I" || $c[0]=="W" || $c[0]=="WPOS" || $c[0]=="WPT"){
							$open="style='display:none;'";
							$final="style='display:none;'";
							$nhmo="style='display:none;'";
							$excess="style='display:none;'";
						}
						$billing="";
						$billing1="style='display:none;'";							
						if($department=="BILLING"){
							$billing="style='display:none;'";							
							$billing1="";
						}

						$arpat="style='display:none;'";
						if($patient['hmo'] == "" || $patient['hmo'] == "N/A"){
							$chargeto=$this->General_model->checkChargeTo($patient['addemployer']);
							if($chargeto['lastname']==""){
								$g=$patient['addemployer'];								
							}else{
								$g=$chargeto['lastname'].", ".$chargeto['firstname']." ".$chargeto['middlename'];
								$arpat="";
							}
						}else{
							$g=$patient['hmo'];
						}
						?>
							<a href="#">
								<img src="<?=base_url();?>design/images/lg/<?=$avatar;?>" class="avatar xl rounded-circle img-thumbnail shadow-sm">
							</a>

							<div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
								<h6 class="mb-0 fw-bold d-block fs-6"><?=$patient['firstname'];?></h6>
								<span class="text-muted small">Patient ID: <?=$patient['patientidno'];?></span>
								<table border="0">
									<tr>
										<td><button type="button" onclick="myChargeCart()" class="btn btn-outline-primary btn-sm" title='Charge Cart' <?=$final;?> <?=$billing;?>><i class="icofont-ui-cart"></i> Cart</button></td>
										<td><a href="#" class="btn btn-outline-success btn-sm addPF" data-bs-toggle="modal" data-bs-target="#AddPF" data-id="<?=$patient['caseno'];?>"  <?=$final;?>  <?=$billing;?>><i class="icofont-plus"></i> ADD PF</a>
									</tr>
								</table>								
							</div>
						</div>
						<script type="text/javascript">
							function myChargeCart(){
						    window.open('../../chargecart/carthmo.php?caseno=<?=$patient['caseno'];?>&dept=<?=$dept;?>&user=<?=$user;?>&username=<?=$username;?>', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=1000,height=500');
						  }
						  function myPrintSlip(){
						    window.open('http://192.168.0.100:100/ERP/main/bridge.php?caseno=<?=$patient['caseno'];?>&username=<?=$username;?>&nursename=<?=$user;?>&dept=<?=$dept;?>&print_slip', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=1000,height=500');
						  }
						  function myAllocation(){
						    window.open('<?=base_url();?>hmo_allocation/<?=$patient['caseno'];?>', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=1000,height=500');
						  }
						  function myAssistance(){
						    window.open('<?=base_url();?>hmo_assistance/<?=$patient['caseno'];?>', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=1000,height=500');
						  }
						  function myExcess(){
						    window.open('<?=base_url();?>hmo_excess/<?=$patient['caseno'];?>', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=1000,height=500');
						  }
						  function myDiscount(){
						    window.open('http://192.168.0.100:100/aboy2020/pages/billing/?appydiscount&patientidno=<?=$patient['patientidno'];?>&caseno=<?=$patient['caseno'];?>&userunique=<?=$username;?>&nursename=<?=$user;?>&dept=<?=$dept;?>', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=700,height=500');
						  }
						</script>
						
						<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
							<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?=$name;?></h6>
							<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted"><?=$patient['caseno'];?></span>
							<p class="mt-2 small"><a href="" class="btn btn-primary btn-sm hmoreopen" <?=$open;?> data-bs-target="#HMOReopen" data-bs-toggle="modal" data-id="<?=$patient['caseno'];?>"><i class="icofont-exchange"></i> Reopen</a> <a href="#" class="btn btn-primary btn-sm finalize" <?=$final;?> data-bs-target="#Finalize" data-bs-toggle="modal" data-id="<?=$patient['caseno'];?>"><i class="icofont-email"></i> Finalize</a> <button type="button" onclick="myPrintSlip()" class="btn btn-outline-primary btn-sm" title='Print Slip' <?=$final;?> <?=$billing;?>><i class="icofont-print"></i> Print Slip</button>
								<a class="btn btn-outline-warning btn-sm editHMO" href="#" data-bs-toggle="modal" data-bs-target="#UpdateHMOAR" data-id="<?=$patient['caseno'];?>_<?=$patient['hmo'];?>_<?=$patient['policyno'];?>" <?=$nhmo;?> <?=$billing;?>>Edit HMO/LOA</a>
								<a class="btn btn-outline-success btn-sm" href="#" onclick="myAllocation();" <?=$nhmo;?> <?=$whmo;?> <?=$ass;?> <?=$billing;?>>Allocation</a>
								<a class="btn btn-outline-info btn-sm" href="#" onclick="myAssistance();" <?=$nhmo;?> <?=$ass;?>>Assistance</a>
								<a class="btn btn-outline-warning btn-sm" href="#" onclick="myDiscount();" <?=$billing1;?> <?=$final;?> <?=$ass;?>>Manual Discount</a>
								<a class="btn btn-outline-danger btn-sm" href="#" onclick="myExcess();" <?=$excess;?> <?=$final;?>>Post Excess</a>
							</p>
							<div class="row g-2 pt-2">
								<div class="col-xl-2">
									<div class="d-flex align-items-center">
										<i class="<?=$sex;?>"></i>
										<span class="ms-2 small"><?=$gender;?> </span>
									</div>
								</div>
								<div class="col-xl-2">
									<div class="d-flex align-items-center">
										<i class="icofont-ui-calendar"></i>
										<span class="ms-2 small"><?=$patient['age'];?> y/o</span>
									</div>
								</div>
								<div class="col-xl-2">
									<div class="d-flex align-items-center">
										<i class="icofont-birthday-cake"></i>
										<span class="ms-2 small"><?=date('m/d/Y',strtotime($patient['dateofbirth']));?></span>
									</div>
								</div>
								<div class="col-xl-2">
									<div class="d-flex align-items-center">
										<i class="icofont-user-male"></i>
										<span class="ms-2 small"><?=$senior;?></span>
									</div>
								</div>
								<div class="col-xl-2">
									<div class="d-flex align-items-center">
										<i class="icofont-hospital"></i>
										<span class="ms-2 small"><?=$patient['employerno'];?></span>
									</div>
								</div>
								<div class="col-xl-2">
									<div class="d-flex align-items-center">
										<i class="icofont-doctor-alt"></i>
										<span class="ms-2 small"><?=$patient['name'];?></span>
									</div>
								</div>
								<div class="col-xl-2">
									<div class="d-flex align-items-center">
										<i class="icofont-bed"></i>
										<span class="ms-2 small"><?=$patient['room'];?></span>
									</div>
								</div>
								<div class="col-xl-2">
									<div class="d-flex align-items-center">
										<i class="icofont-building-alt"></i>
										<span class="ms-2 small"><?=$patient['religion'];?></span>
									</div>
								</div>
								<div class="col-xl-2">
									<div class="d-flex align-items-center">
										<i class="icofont-building"></i>
										<span class="ms-2 small"><?=$g;?></span>
									</div>
								</div>
								<div class="col-xl-2">
									<div class="d-flex align-items-center">
										<i class="icofont-calendar"></i>
										<span class="ms-2 small"><?=$patient['dateadmitted'];?></span>
									</div>
								</div>
								<div class="col-xl-2">
									<div class="d-flex align-items-center">
										<i class="icofont-clock-time"></i>
										<span class="ms-2 small"><?=date('h:i A',strtotime($patient['timeadmitted']));?></span>
									</div>
								</div>
								<div class="col-xl-2">
									<div class="d-flex align-items-center">
										<i class="icofont-phone-circle"></i>
										<span class="ms-2 small"><?=$patient['patientcontactno'];?></span>
									</div>
								</div>
								<div class="col-xl-6">
									<div class="d-flex align-items-center">
										<i class="icofont-home"></i>
										<span class="ms-2 small"><?=$patient['street'];?>, <?=$patient['barangay'];?>, <?=$patient['municipality'];?>, <?=$patient['province'];?> <?=$patient['zipcode'];?></span>
									</div>
								</div>
								<div class="col-xl-6">
									<div class="d-flex align-items-center">
										<!-- <i class="icofont-hospital"></i> -->										
										<span class="ms-2 small"><b>Initial Dx:</b> <?=$patient['initialdiagnosis'];?></span>
									</div>
								</div>
								<div class="col-xl-6" align="right">
									<div class="d-flex align-items-center">										
										<span class="ms-2 small"><b>Chief Complaint:</b> <?=$info['chiefcomplaint'];?></span>
									</div>
								</div>
								<div class="col-xl-6">
									<div class="d-flex align-items-center">
										<!-- <i class="icofont-hospital"></i> -->										
										<span class="ms-2 small"><b>Final Dx:</b> <?=$patient['finaldiagnosis'];?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="bd-example mb-5">                    
					<div class="accordion" id="accordionExample">
								<div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                	<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                        Statement of Account
                                    </button>
                                </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
																	<table class="table table-hover align-middle mb-0" width="100%" id="charged-table">
																		<!--tr>
																			<td><a href="http://192.168.0.100:100/2017codes/SOA/StatementOfAccountPHICVer.php?patientidno=<?=$patient['patientidno'];?>&caseno=<?=$patient['caseno'];?>&uname=<?=$this->session->fullname;?>&dept=<?=$department;?>" class="btn btn-outline-primary btn-sm" target="_bank">PHILHEALTH SOA</a></td>
																		</tr-->																		
																		<tr>
																			<td><a href="<?=base_url();?>details_hmo/<?=$patient['caseno'];?>/<?=$patient['patientidno'];?>" class="btn btn-outline-primary btn-sm" target="_bank">DETAILS HMO</a></td>
																		</tr>
																		<tr>
																			<td><a href="http://192.168.0.100:100/2017codes/SOA/StatementOfAccountPHICVerExportmed.php?patientidno=<?=$patient['patientidno'];?>&caseno=<?=$patient['caseno'];?>&uname=<?=$this->session->fullname;?>&dept=<?=$department;?>" class="btn btn-outline-primary btn-sm" target="_bank">SOA TO EXPORT (MEDICARD)</a></td>
																		</tr>
																		<tr>
																			<td><a href="http://192.168.0.100:100/2021codes/HMOSOA/?patientidno=<?=$patient['patientidno'];?>&caseno=<?=$patient['caseno'];?>&user=<?=$this->session->fullname;?>&dept=<?=$department;?>" class="btn btn-outline-primary btn-sm" target="_bank">PHILHEALTH SOA NEW</a></td>
																		</tr>
																		<tr>
																			<td><a href="<?=base_url();?>print_soa/<?=$patient['caseno'];?>/<?=$patient['patientidno'];?>" class="btn btn-outline-primary btn-sm" target="_bank">SOA for Transmittal</a></td>
																		</tr>
																		<tr>
																			<td><a href="<?=base_url();?>print_soa_beta/<?=$patient['caseno'];?>/<?=$patient['patientidno'];?>" class="btn btn-outline-primary btn-sm" target="_bank">SOA for Transmittal Beta</a></td>
																		</tr>
																	</table>
                                </div>
                            </div>
                        </div>
                  <div class="accordion-item">
                                      <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                          Diagnostics
                                        </button>
                                      </h2>
                                      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
										<table class="table table-hover align-middle mb-0" width="100%" id="patient-table">
											<thead>
											<tr>
											<th class="text-center"><font size="2">#</th>
											<th class="text-center" width="40%"><font size="2">DESCRIPTION</th>
											<th class="text-center" width="25%"><font size="2">STATUS</th>
											<th class="text-center"><font size="2%">Refno/ User</th>
												<th class="text-center" width="25%"><font size="2">PRICE</th>
											<th class="text-center"><font size="2%"></th>
											</tr>
											</thead>
											<tbody>

											<?php
											$case=explode('-',$patient['caseno']);
											$i=0;
											$sql = $this->Dietary_model->db->query("SELECT * FROM productout where caseno= '$patient[caseno]' and (productsubtype='XRAY' OR productsubtype='ULTRASOUND' OR productsubtype='CT SCAN' OR productsubtype='MAMMOGRAPHY') AND (status='PAID' or status='Approved') group by refno order by trantype desc, datearray desc");
											$items = $sql->result_array();
											foreach($items as $row){
											$col="";
											$col1="black";
											$blink="";
											$status =$row['administration'];
											$status1 =$row['status'];
											$administration1 =$row['administration'];
											$prod =$row['productsubtype'];
											$terminalname=$row['terminalname'];
											$terminalname2=$row['terminalname'];
											$productdesc=$row['productdesc'];
											$approvalno=$row['approvalno'];
											$producttype=$row['producttype'];
											$qty =$row['quantity'];
											$invno =$row['invno'];
											$approvalno = $row['approvalno'];
											$batchno=$row['batchno'];
											$productcode=$row['productcode'];
											$refno=$row['refno'];
											$datearray= date("F d, Y", strtotime($row['datearray']));
											$timedispensed=$row['datearray'];
											$loginuser=$row['loginuser'];
											$srp=$row['sellingprice'];
										$discount=$row['adjustment'];
										$gross=$row['gross'];
										$hmo=$row['hmo'];
										$excess=$row['excess'];
											$i++;

											$productdesc=str_replace("mak-","",$productdesc);
											$productdesc=str_replace("-med","",$productdesc);
											$productdesc=str_replace("-sup","",$productdesc);
											$productdesc=str_replace("ams-","",$productdesc);

											if($terminalname == "pending") {$terminalname="<span class='badge bg-primary'>$terminalname</span>";}
											elseif($terminalname == "Testdone") {$terminalname="<span class='badge bg-danger'>$terminalname</span>";}
											else{$terminalname="<span class='badge bg-success'>$terminalname</span>";}

											$color ="";
											$linkage="$productdesc";


											$resultq = $this->Dietary_model->db->query("SELECT remarks FROM labtest WHERE refno='$refno'");
											$rem=$resultq->row_array();
											$rm=$rem['remarks'];

											$hm="";
											if($rm!=""){$hm = "<small><font color='blue'>$rm</font></small>";}
											?>

											<tr>
											<td align="center" style="font-size: 12px;">
												<?php
												if($case[0] == 'AR' && $patient['status']=="Active"){
												?>
												<a href="" class="btn btn-warning btn-sm text-center text-white EditPrice" data-bs-toggle="modal" data-bs-target="#editPrice" data-id="<?=$patient['caseno'];?>_<?=$refno;?>_<?=$srp;?>_<?=$discount;?>_<?=$hmo;?>" title="Edit"><i class="icofont-edit"></i></a>
											<?php 
										if($terminalname2=="pending" && $patient['status']=="Active"){
											?>
											<a href="<?=base_url();?>delete_hmo_price/<?=$patient['caseno'];?>/<?=$refno;?>" class="btn btn-danger btn-sm text-center text-white" title="Delete" onclick="return confirm('Do you wish to delete this item?');return false;"><i class="icofont-trash"></i></a>
											<?php
										}
									}
										?>
									</td>
											<td style="font-size: 12px;"><font color='gray'>Desc:</font> <b><?php echo $productdesc." ".$hm; ?></b><br><font color='gray'>Test:</font> <?php echo $prod ?></td>
											<td style="font-size: 12px;"><font color='gray'>Status:</font> <?php echo $row['trantype'].'/ '.$status1.'/ '.$terminalname ?><br><font color='gray'>Date:</font> <?php echo $datearray ?></td>
											<td style="font-size: 12px;"><font color='gray'>Refno:</font> <b><?php echo $refno ?></b><br><font color='gray'>User:</font> <?php echo $loginuser ?></td>
											<td style="font-size: 12px;"><div class="dropdown">
										<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
											View Price
										</a>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">																			
											<li>Selling Price: <b><?php echo $srp ?></b></li>
											<li>Discount: <b><?php echo $discount ?></b></li>
											<li>Gross: <b><?php echo $gross ?></b></li>
											<li>HMO: <b><?php echo $hmo ?></b></li>
											<li>Excess: <b><?php echo $excess ?></b></li>
										</ul>
									</div></td>
											<td style="text-align: center; font-size: 25px;"><a href="http://192.168.0.99:100/ERP/printresult/imaging-view/<?php echo $patient['caseno'] ?>/<?php echo $refno ?>" target="_bank"><button type="submit" class="btn btn-outline-primary btn-sm"><i class="icofont-printer"></i></button></a></td>
											</tr>
											<?php  } ?>


											<?php
										error_reporting(1);
										$i=0;
										$sql = $this->Dietary_model->db->query("SELECT * FROM productout where caseno= '$patient[caseno]' and (productsubtype = 'LABORATORY' OR productsubtype = 'PHYSICAL THERAPY' OR productsubtype = 'EEG') and (status='PAID' or status='Approved') order by datearray desc");
										$items = $sql->result_array();
										foreach($items as $row){
										$col="";
										$col1="black";
										$blink="";
										$status =$row['administration'];
										$status1 =$row['status'];
										$administration1 =$row['administration'];
										$prod =$row['productsubtype'];
										$terminalname=$row['terminalname'];
										$terminalname2=$row['terminalname'];
										$productdesc=$row['productdesc'];
										$approvalno=$row['approvalno'];
										$producttype=$row['producttype'];
										$qty =$row['quantity'];
										$invno =$row['invno'];
										$approvalno = $row['approvalno'];
										$batchno=$row['batchno'];
										$productcode=$row['productcode'];
										$refno=$row['refno'];
										$datearray= date("F d, Y", strtotime($row['datearray']));
										$timedispensed=$row['datearray'];
										$loginuser=$row['loginuser'];
										$trantype=$row['trantype'];
										$srp=$row['sellingprice'];
										$discount=$row['adjustment'];
										$gross=$row['gross'];
										$hmo=$row['hmo'];
										$excess=$row['excess'];
										$i++;


										if($terminalname2 == "pending") {$terminalname="<span class='badge bg-primary'>$terminalname2</span>";}
										elseif($terminalname2 == "Testdone") {$terminalname="<span class='badge bg-danger'>$terminalname2</span>";}
										else{$terminalname="<span class='badge bg-success'>$terminalname2</span>";}

										$color ="";
										$linkage="$productdesc";


										$resultq = $this->Dietary_model->db->query("SELECT remarks FROM labtest WHERE refno='$refno'");
										$rowq=$resultq->row_array();
										$rm=$rowq['remarks'];

										$resultq1 = $this->Dietary_model->db->query("SELECT * FROM receiving WHERE code='$productcode'");
										$rowq1=$resultq->row_array();
										$lotno=$rowq1['lotno'];



										$hmm="";
										if($rm!=""){$hmm = "<small><font color='blue'>$rm</font></small>";}
										$linked = "http://192.168.0.100:100/ERP/nsstation/other/dxlaboratory_redirect.php?caseno=$patient[caseno]&refno=$refno";
										?>

										<tr>
										<td align="center" style="font-size: 12px;">
											<?php
											if($case[0]=="AR" && $patient['status']=="Active"){
											?>
											<a href="" class="btn btn-warning btn-sm text-center text-white EditPrice" data-bs-toggle="modal" data-bs-target="#editPrice" data-id="<?=$patient['caseno'];?>_<?=$refno;?>_<?=$srp;?>_<?=$discount;?>_<?=$hmo;?>" title="Edit"><i class="icofont-edit"></i></a>
											<?php 
										if($terminalname2=="pending" && $patient['status']=="Active"){
											?>
											<a href="<?=base_url();?>delete_hmo_price/<?=$patient['caseno'];?>/<?=$refno;?>" class="btn btn-danger btn-sm text-center text-white" title="Delete" onclick="return confirm('Do you wish to delete this item?');return false;"><i class="icofont-trash"></i></a>
											<?php
										}
									}
										?>
										</td>
										<td style="font-size: 12px;"><font color='gray'>Desc:</font> <b><?php echo $productdesc." ".$hm; ?></b><br><font color='gray'>Test:</font> <?php echo $lotno ?></td>
										<td style="font-size: 12px;"><font color='gray'>Status:</font> <?php echo $row['trantype'].'/ '.$status1.'/ '.$terminalname ?><br><font color='gray'>Date:</font> <?php echo $datearray ?></td>
										<td style="font-size: 12px;"><font color='gray'>Refno:</font> <b><?php echo $refno ?></b><br><font color='gray'>User:</font> <?php echo $loginuser ?></td>
										<td width="20%">
											<div class="dropdown">
										<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
											View Price
										</a>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">																			
											<li>Selling Price: <b><?php echo $srp ?></b></li>
											<li>Discount: <b><?php echo $discount ?></b></li>
											<li>Gross: <b><?php echo $gross ?></b></li>
											<li>HMO: <b><?php echo $hmo ?></b></li>
											<li>Excess: <b><?php echo $excess ?></b></li>
										</ul>
									</div>

										</td>
										<td style="text-align: center; font-size: 25px;">
										<?php 
										if($terminalname2=="Testdone"){echo"<a href='$linked&from=$dept' target='_bank'><button type='submit' class='btn btn-outline-primary btn-sm'><i class='icofont-printer'></i></button></a>";}
										else{
										if($productdesc=="HGT" or $productdesc=="RBS"){
										
										}
										}
										?>
										</td>
										</tr>
										<?php  } ?>

										<?php
									$i=0;
									$sql = $this->Dietary_model->db->query("SELECT * FROM productout where caseno = '$patient[caseno]' and (productsubtype='ECG' or productsubtype='HEARTSTATION') and (status='PAID' or status='Approved') group by refno order by trantype desc, datearray desc");
									$items=$sql->result_array();
									foreach($items AS $row){
									$col="";
									$col1="black";
									$blink="";
									$status =$row['administration'];
									$status1 =$row['status'];
									$administration1 =$row['administration'];
									$prod =$row['productsubtype'];
									$terminalname=$row['terminalname'];
									$terminalname2=$row['terminalname'];
									$productdesc=$row['productdesc'];
									$approvalno=$row['approvalno'];
									$producttype=$row['producttype'];
									$qty =$row['quantity'];
									$invno =$row['invno'];
									$approvalno = $row['approvalno'];
									$batchno=$row['batchno'];
									$productcode=$row['productcode'];
									$refno=$row['refno'];
									$datearray= date("F d, Y", strtotime($row['datearray']));
									$timedispensed=$row['datearray'];
									$loginuser=$row['loginuser'];
									$srp=$row['sellingprice'];
										$discount=$row['adjustment'];
										$gross=$row['gross'];
										$hmo=$row['hmo'];
										$excess=$row['excess'];
									$i++;

									$productdesc=str_replace("mak-","",$productdesc);
									$productdesc=str_replace("-med","",$productdesc);
									$productdesc=str_replace("-sup","",$productdesc);
									$productdesc=str_replace("ams-","",$productdesc);

									if($terminalname == "pending") {$terminalname="<span class='badge bg-primary'>$terminalname</span>";}
									elseif($terminalname == "Testdone") {$terminalname="<span class='badge bg-danger'>$terminalname</span>";}
									else{$terminalname="<span class='badge bg-success'>$terminalname</span>";}

									$color ="";
									$linkage="$productdesc";


									$resultq = $this->Dietary_model->db->query("SELECT remarks FROM labtest WHERE refno='$refno'");
									$rowq=$resultq->row_array();
									$rm=$rowq['remarks'];

									$hmm="";
									if($rm!=""){$hmm = "<small><font color='blue'>$rm</font></small>";}
									?>

									<tr>
									<td align="center" style="font-size: 12px;">
										<?php
										if($case[0]=="AR" && $patient['status']=="Active"){
										?>
										<a href="" class="btn btn-warning btn-sm text-center text-white EditPrice" data-bs-toggle="modal" data-bs-target="#editPrice" data-id="<?=$patient['caseno'];?>_<?=$refno;?>_<?=$srp;?>_<?=$discount;?>_<?=$hmo;?>" title="Edit"><i class="icofont-edit"></i></a>
											<?php 
										if($terminalname2=="pending" && $patient['status']=="Active"){
											?>
											<a href="<?=base_url();?>delete_hmo_price/<?=$patient['caseno'];?>/<?=$refno;?>" class="btn btn-danger btn-sm text-center text-white" title="Delete" onclick="return confirm('Do you wish to delete this item?');return false;"><i class="icofont-trash"></i></a>
											<?php
										}
									}
										?>
									</td>
									<td style="font-size: 12px;"><font color='gray'>Desc:</font> <b><?php echo $productdesc." ".$hm; ?></b><br><font color='gray'>Test:</font> <?php echo $prod ?></td>
									<td style="font-size: 12px;"><font color='gray'>Status:</font> <?php echo $row['trantype'].'/ '.$status1.'/ '.$terminalname ?><br><font color='gray'>Date:</font> <?php echo $datearray ?></td>
									<td style="font-size: 12px;"><font color='gray'>Refno:</font> <b><?php echo $refno ?></b><br><font color='gray'>User:</font> <?php echo $loginuser ?></td>
									<td style="font-size: 12px;"><div class="dropdown">
										<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
											View Price
										</a>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">																			
											<li>Selling Price: <b><?php echo $srp ?></b></li>
											<li>Discount: <b><?php echo $discount ?></b></li>
											<li>Gross: <b><?php echo $gross ?></b></li>
											<li>HMO: <b><?php echo $hmo ?></b></li>
											<li>Excess: <b><?php echo $excess ?></b></li>
										</ul>
									</div></td>
									<td style="text-align: center; font-size: 25px;">
									<?php
									if($terminalname2 = "Testdone" and strpos($productdesc, "ECHO")!==false){echo"<a href='http://192.168.0.99:100/ERP/printresult/2decho_v1/$caseno/$refno/iuo' target='_blank'><button class='btn btn-outline-info btn-sm'><i class='icofont-printer'></i></button></a>";}
									elseif($terminalname2 = "Testdone" and strpos($productdesc, "STRESS")!==false){echo"<a href='http://192.168.0.99:100/ERP/printresult/stresstest/$caseno/$refno/iuo' target='_blank'><button class='btn btn-outline-info btn-sm'><i class='icofont-printer'></i></button></a>";}
									elseif($terminalname2 = "Testdone"){}
									?>
									</td>
									</tr>
									<?php  } ?>
										</tbody></table>
                                        </div>
                                    </div>
                                </div>                                                           
                        <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSix">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        Professional Fee
                                    </button>
                                    </h2>
                                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
									<table class="table table-hover align-middle mb-0" width="100%" id="pf-table">
										<thead>
										<tr>
										<th class="text-center"><font size="2">#</th>
										<th class="text-center" width="40%"><font size="2">DESCRIPTION</th>
										<th class="text-center" width="25%"><font size="2">STATUS</th>
										<th class="text-center"><font size="2%">Refno/ User</th>			
										<th class="text-center" width="25%"><font size="2">PRICE</th>							
										</tr>
										</thead>
										<tbody>

										<?php
										error_reporting(1);
										$i=0;
										$sql = $this->Dietary_model->db->query("SELECT * FROM productout where caseno= '$patient[caseno]' and (productsubtype = 'PROFESSIONAL FEE') and status='Approved' AND quantity > 0 ORDER BY productsubtype ASC");
										$items = $sql->result_array();
										foreach($items as $row){
										$col="";
										$col1="black";
										$blink="";
										$status =$row['administration'];
										$status1 =$row['status'];
										$administration1 =$row['administration'];
										$prod =$row['productsubtype'];
										$terminalname=$row['terminalname'];
										$terminalname2=$row['terminalname'];
										$productdesc=$row['productdesc'];
										$approvalno=$row['approvalno'];
										$producttype=$row['producttype'];
										$qty =$row['quantity'];
										$invno =$row['invno'];
										$approvalno = $row['approvalno'];
										$batchno=$row['batchno'];
										$productcode=$row['productcode'];
										$refno=$row['refno'];
										$datearray= date("F d, Y", strtotime($row['datearray']));
										$timedispensed=$row['datearray'];
										$loginuser=$row['loginuser'];
										$trantype=$row['trantype'];
										$srp=$row['sellingprice'];
										$discount=$row['adjustment'];
										$gross=$row['gross'];
										$hmo=$row['hmo'];
										$excess=$row['excess'];
										$i++;


										if($administration1 == "pending") {$terminalname="<span class='badge bg-primary'>$terminalname2</span>";}
										elseif($administration1 == "dispensed") {$terminalname="<span class='badge bg-danger'>$terminalname2</span>";}
										else{$administration1="<span class='badge bg-success'>$administration1</span>";}

										$color ="";
										$linkage="$productdesc";


										$resultq = $this->Dietary_model->db->query("SELECT remarks FROM labtest WHERE refno='$refno'");
										$rowq=$resultq->row_array();
										$rm=$rowq['remarks'];

										$resultq1 = $this->Dietary_model->db->query("SELECT * FROM receiving WHERE code='$productcode'");
										$rowq1=$resultq->row_array();
										$lotno=$rowq1['lotno'];



										$hmm="";
										if($rm!=""){$hmm = "<small><font color='blue'>$rm</font></small>";}
										$linked = "http://192.168.0.100:100/ERP/nsstation/other/dxlaboratory_redirect.php?caseno=$patient[caseno]&refno=$refno";

										?>

										<tr>
										<td align="center" style="font-size: 12px;">
											<?php
										if($case[0]=="AR" && $patient['status']=="Active"){
										?>
										<a href="" class="btn btn-warning btn-sm text-center text-white EditPrice" data-bs-toggle="modal" data-bs-target="#editPrice" data-id="<?=$patient['caseno'];?>_<?=$refno;?>_<?=$srp;?>_<?=$discount;?>_<?=$hmo;?>" title="Edit"><i class="icofont-edit"></i></a>
											
										
											<a href="<?=base_url();?>delete_hmo_price/<?=$patient['caseno'];?>/<?=$refno;?>" class="btn btn-danger btn-sm text-center text-white" title="Delete" onclick="return confirm('Do you wish to delete this item?');return false;"><i class="icofont-trash"></i></a>
											<?php
										
									}
										?>
										</td>
										<td style="font-size: 12px;"><font color='gray'>Desc:</font> <b><?php echo $productdesc; ?></b></td>
										<td style="font-size: 12px;"><font color='gray'>Status:</font> <?php echo $row['trantype'].'/ '.$status1.'/ '.$administration1 ?><br><font color='gray'>Date:</font> <?php echo $datearray ?></td>
										<td style="font-size: 12px;"><font color='gray'>Refno:</font> <b><?php echo $refno ?></b><br><font color='gray'>User:</font> <?php echo $loginuser ?></td>		<td style="font-size: 12px;"><div class="dropdown">
										<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
											View Price
										</a>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">																			
											<li>Selling Price: <b><?php echo $srp ?></b></li>
											<li>Discount: <b><?php echo $discount ?></b></li>
											<li>Gross: <b><?php echo $gross ?></b></li>
											<li>HMO: <b><?php echo $hmo ?></b></li>
											<li>Excess: <b><?php echo $excess ?></b></li>
										</ul>
									</div></td>
										<?php  } ?></tbody></table>
                                	</div>
                                </div>
                            </div>
                        <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseTwo">
                                        Medicines & Supplies
                                    </button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
									<table class="table table-hover align-middle mb-0" width="100%" id="meds-table">
										<thead>
										<tr>
										<th class="text-center"><font size="2">#</th>
										<th class="text-center" width="40%"><font size="2">DESCRIPTION</th>
										<th class="text-center" width="25%"><font size="2">STATUS</th>
										<th class="text-center"><font size="2%">Refno/ User</th>										
										</tr>
										</thead>
										<tbody>

										<?php
										error_reporting(1);
										$i=0;
										$sql = $this->Dietary_model->db->query("SELECT * FROM productout where caseno= '$patient[caseno]' and (productsubtype = 'PHARMACY/MEDICINE' OR productsubtype LIKE '%SUPPLIES%') and (status='PAID' or status='Approved') AND quantity > 0 ORDER BY productsubtype ASC");
										$items = $sql->result_array();
										foreach($items as $row){
										$col="";
										$col1="black";
										$blink="";
										$status =$row['administration'];
										$status1 =$row['status'];
										$administration1 =$row['administration'];
										$prod =$row['productsubtype'];
										$terminalname=$row['terminalname'];
										$terminalname2=$row['terminalname'];
										$productdesc=$row['productdesc'];
										$approvalno=$row['approvalno'];
										$producttype=$row['producttype'];
										$qty =$row['quantity'];
										$invno =$row['invno'];
										$approvalno = $row['approvalno'];
										$batchno=$row['batchno'];
										$productcode=$row['productcode'];
										$refno=$row['refno'];
										$datearray= date("F d, Y", strtotime($row['datearray']));
										$timedispensed=$row['datearray'];
										$loginuser=$row['loginuser'];
										$trantype=$row['trantype'];
										$i++;


										if($administration1 == "pending") {$terminalname="<span class='badge bg-primary'>$terminalname2</span>";}
										elseif($administration1 == "dispensed") {$terminalname="<span class='badge bg-danger'>$terminalname2</span>";}
										else{$administration1="<span class='badge bg-success'>$administration1</span>";}

										$color ="";
										$linkage="$productdesc";


										$resultq = $this->Dietary_model->db->query("SELECT remarks FROM labtest WHERE refno='$refno'");
										$rowq=$resultq->row_array();
										$rm=$rowq['remarks'];

										$resultq1 = $this->Dietary_model->db->query("SELECT * FROM receiving WHERE code='$productcode'");
										$rowq1=$resultq->row_array();
										$lotno=$rowq1['lotno'];



										$hmm="";
										if($rm!=""){$hmm = "<small><font color='blue'>$rm</font></small>";}
										$linked = "http://192.168.0.100:100/ERP/nsstation/other/dxlaboratory_redirect.php?caseno=$patient[caseno]&refno=$refno";

										?>

										<tr>
										<td align="center" style="font-size: 12px;"><?php echo $i ?>.</td>
										<td style="font-size: 12px;"><font color='gray'>Desc:</font> <b><?php echo $productdesc; ?></b></td>
										<td style="font-size: 12px;"><font color='gray'>Status:</font> <?php echo $row['trantype'].'/ '.$status1.'/ '.$administration1 ?><br><font color='gray'>Date:</font> <?php echo $datearray ?></td>
										<td style="font-size: 12px;"><font color='gray'>Refno:</font> <b><?php echo $refno ?></b><br><font color='gray'>User:</font> <?php echo $loginuser ?></td>										
										<?php  } ?></tbody></table>
                                	</div>
                                </div>
                            </div>
                                                    
                    </div>
				</div>								
			</div>
		</div><!-- Row End -->

	</div>
</div>
