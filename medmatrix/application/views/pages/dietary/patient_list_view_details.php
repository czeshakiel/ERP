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
							?>
							<a href="#">
								<img src="<?=base_url();?>design/images/lg/<?=$avatar;?>" class="avatar xl rounded-circle img-thumbnail shadow-sm">
								<a href="#" class="btn btn-success btn-sm text-white addDiet" style="position: absolute;top:15px;right: 15px;" data-bs-toggle="modal" data-bs-target="#AddDiet" data-id="<?=$patient['caseno'];?>_<?=$patient['room'];?>_<?=$this->session->username;?>"><i class="icofont-plus-circle"></i> Add Diet</a>
								<?php
								if($patient['status']=="MGH"){

								}else{
								?>
								<a href="#" class="btn btn-info btn-sm text-white chargedItem" style="position: absolute;top:15px;right: 110px;" data-bs-toggle="modal" data-bs-target="#ChargeItem" data-id="<?=$patient['caseno'];?>"><i class="icofont-plus-circle"></i> Charge Item</a>
								<?php	
								}
								?>								
							</a>

							<div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
								<h6 class="mb-0 fw-bold d-block fs-6"><?=$patient['firstname'];?></h6>
								<span class="text-muted small">Patient ID: <?=$patient['patientidno'];?></span>
							</div>
						</div>
						<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
							<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?=$name;?></h6>
							<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted"><?=$patient['caseno'];?></span>
							<p class="mt-2 small">&nbsp;</p>
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
										<span class="ms-2 small"><?=$patient['hmo'];?></span>
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
										<span class="ms-2 small"><?=$patient['timeadmitted'];?></span>
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
										<i class="icofont-hospital"></i>
										<span class="ms-2 small"><?=$patient['initialdiagnosis'];?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="bd-example mb-5">                    
					<div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                          Imaging Results
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
											<th class="text-center"><font size="2%"></th>
											</tr>
											</thead>
											<tbody>

											<?php
											$i=0;
											$sql = $this->Dietary_model->db->query("SELECT * FROM productout where caseno= '$patient[caseno]' and (productsubtype='XRAY' OR productsubtype='ULTRASOUND' OR productsubtype='CT SCAN' OR productsubtype='MAMMOGRAPHY') and terminalname='Testdone'  group by refno order by trantype desc, datearray desc");
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

											$hmm="";
											if($rm!=""){$hmm = "<small><font color='blue'>$rm</font></small>";}
											?>

											<tr>
											<td align="center" style="font-size: 12px;"><?php echo $i ?>.</td>
											<td style="font-size: 12px;"><font color='gray'>Desc:</font> <b><?php echo $productdesc." ".$hm; ?></b><br><font color='gray'>Test:</font> <?php echo $prod ?></td>
											<td style="font-size: 12px;"><font color='gray'>Status:</font> <?php echo $row['trantype'].'/ '.$status1.'/ '.$terminalname ?><br><font color='gray'>Date:</font> <?php echo $datearray ?></td>
											<td style="font-size: 12px;"><font color='gray'>Refno:</font> <b><?php echo $refno ?></b><br><font color='gray'>User:</font> <?php echo $loginuser ?></td>
											<td style="text-align: center; font-size: 25px;"><a href="http://192.168.0.99:100/ERP/printresult/imaging-view/<?php echo $caseno ?>/<?php echo $refno ?>" target="_bank"><button type="submit" class="btn btn-outline-primary btn-sm"><i class="icofont-printer"></i></button></a></td>
											</tr>
											<?php  } ?></tbody></table>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Laboratory Results
                                    </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
									<table class="table table-hover align-middle mb-0" width="100%" id="clients-table">
										<thead>
										<tr>
										<th class="text-center"><font size="2">#</th>
										<th class="text-center" width="40%"><font size="2">DESCRIPTION</th>
										<th class="text-center" width="25%"><font size="2">STATUS</th>
										<th class="text-center"><font size="2%">Refno/ User</th>
										<th class="text-center"><font size="2%"></th>
										</tr>
										</thead>
										<tbody>

										<?php
										error_reporting(1);
										$i=0;
										$sql = $this->Dietary_model->db->query("SELECT * FROM productout where caseno= '$patient[caseno]' and productsubtype = 'LABORATORY' and (status='PAID' or status='Approved') order by datearray desc");
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
										<td align="center" style="font-size: 12px;"><?php echo $i ?>.</td>
										<td style="font-size: 12px;"><font color='gray'>Desc:</font> <b><?php echo $productdesc." ".$hm; ?></b><br><font color='gray'>Test:</font> <?php echo $lotno ?></td>
										<td style="font-size: 12px;"><font color='gray'>Status:</font> <?php echo $row['trantype'].'/ '.$status1.'/ '.$terminalname ?><br><font color='gray'>Date:</font> <?php echo $datearray ?></td>
										<td style="font-size: 12px;"><font color='gray'>Refno:</font> <b><?php echo $refno ?></b><br><font color='gray'>User:</font> <?php echo $loginuser ?></td>
										<td style="text-align: center; font-size: 25px;">
										<?php 
										if($terminalname2=="Testdone"){echo"<a href='$linked&from=$dept' target='_bank'><button type='submit' class='btn btn-outline-primary btn-sm'><i class='icofont-printer'></i></button></a>";}
										else{
										if($productdesc=="HGT" or $productdesc=="RBS"){
										echo"<a href='http://192.168.0.99:100/cgi-bin/bloodchemnewns.cgi?refno=$refno&productdesc=$productdesc&trantype=$trantype&nursename=$this->session->user&nursestation=&caseno=$patient[caseno]&setgrp=2&lyte=$lotno' target='_bank'><button type='submit' class='btn btn-outline-danger btn-sm'><i class='icofont-flask'></i></button></a>";
										}
										}
										?>
										</td>
										</tr>
										<?php  } ?></tbody></table>
                                	</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        ECG Results
                                    </button>
                                </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
								<table class="table table-hover align-middle mb-0" width="100%" id="result-table">
									<thead>
									<tr>
									<th class="text-center"><font size="2">#</th>
									<th class="text-center" width="40%"><font size="2">DESCRIPTION</th>
									<th class="text-center" width="25%"><font size="2">STATUS</th>
									<th class="text-center"><font size="2%">Refno/ User</th>
									<th class="text-center"><font size="2%"></th>
									</tr>
									</thead>
									<tbody>

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
									<td align="center" style="font-size: 12px;"><?php echo $i ?>.</td>
									<td style="font-size: 12px;"><font color='gray'>Desc:</font> <b><?php echo $productdesc." ".$hm; ?></b><br><font color='gray'>Test:</font> <?php echo $prod ?></td>
									<td style="font-size: 12px;"><font color='gray'>Status:</font> <?php echo $row['trantype'].'/ '.$status1.'/ '.$terminalname ?><br><font color='gray'>Date:</font> <?php echo $datearray ?></td>
									<td style="font-size: 12px;"><font color='gray'>Refno:</font> <b><?php echo $refno ?></b><br><font color='gray'>User:</font> <?php echo $loginuser ?></td>
									<td style="text-align: center; font-size: 25px;">
									<?php
									if($terminalname2 = "Testdone" and strpos($productdesc, "ECHO")!==false){echo"<a href='http://192.168.0.99:100/ERP/printresult/2decho_v1/$caseno/$refno/iuo' target='_blank'><button class='btn btn-outline-info btn-sm'><i class='icofont-printer'></i></button></a>";}
									elseif($terminalname2 = "Testdone" and strpos($productdesc, "STRESS")!==false){echo"<a href='http://192.168.0.99:100/ERP/printresult/stresstest/$caseno/$refno/iuo' target='_blank'><button class='btn btn-outline-info btn-sm'><i class='icofont-printer'></i></button></a>";}
									elseif($terminalname2 = "Testdone"){echo"<a href='http://192.168.0.99:100/ERP/heart/resultdeckingecg.php?caseno=$caseno&refno=$refno&productsubtype=$productsubtype' target='tabiframedecking'><button type='submit' class='btn btn-outline-primary btn-sm' data-bs-toggle='modal' data-bs-target='#decking'><i class='icofont-flask'></i></button></a>";}
									?>
									</td>
									</tr>
									<?php  } ?></tbody></table>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Dietary Charged Items
                                    </button>
                                </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
								<table class="table table-hover align-middle mb-0" width="100%" id="charged-table">
									<thead>
									<tr>
									<th class="text-center"><font size="2">#</th>
									<th class="text-center" width="40%"><font size="2">DESCRIPTION</th>
									<th class="text-center" width="25%"><font size="2">DATE & TIME</th>
									<th class="text-center"><font size="2%">Quantity</th>
									<th class="text-center"><font size="2%"></th>
									</tr>
									</thead>
									<tbody>

									<?php
									$i=0;
									$dept=$this->session->dept;
									$sql = $this->Dietary_model->db->query("SELECT * FROM productout WHERE caseno='$patient[caseno]' AND batchno LIKE '%$dept%'");
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
									$i++;

									// $productdesc=str_replace("mak-","",$productdesc);
									// $productdesc=str_replace("-med","",$productdesc);
									// $productdesc=str_replace("-sup","",$productdesc);
									// $productdesc=str_replace("ams-","",$productdesc);

									// if($terminalname == "pending") {$terminalname="<span class='badge bg-primary'>$terminalname</span>";}
									// elseif($terminalname == "Testdone") {$terminalname="<span class='badge bg-danger'>$terminalname</span>";}
									// else{$terminalname="<span class='badge bg-success'>$terminalname</span>";}

									// $color ="";
									// $linkage="$productdesc";


									// $resultq = $this->Dietary_model->db->query("SELECT remarks FROM labtest WHERE refno='$refno'");
									// $rowq=$resultq->row_array();
									// $rm=$rowq['remarks'];

									// $hmm="";
									// if($rm!=""){$hmm = "<small><font color='blue'>$rm</font></small>";}
									$delete_charged="";
									if($patient['status']=="MGH"){
										$delete_charged="style='display:none;'";
									}
									?>

									<tr>
									<td align="center" style="font-size: 12px;"><?php echo $i ?>.</td>
									<td style="font-size: 12px;"><b><?=$productdesc; ?></b></td>
									<td align="center" style="font-size: 12px;"><?=$row['date']." ".$row['invno'];?></td>
									<td align="center" style="font-size: 12px;"><?=$row['quantity'];?></td>
									<td style="font-size: 25px;" align="center"><a href="<?=base_url();?>delete_charged_item/<?=$patient['caseno'];?>/<?=$row['refno'];?>" class="btn btn-danger btn-sm text-white" title="Remove" <?=$delete_charged;?> onclick="return confirm('Do you wish to remove this item?'); return false;"><i class="icofont-trash"></i></a></td>									
									</tr>
									<?php  } ?></tbody></table>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>				
				<h6 class="fw-bold  py-3 mb-3">Diet List</h6>
				<div class="teachercourse-list">
					<div class="row g-3 gy-5 py-3 row-deck">
						<?php
						foreach($diet as $d){
						?>
							<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-12">
								<div class="card">
									<div class="card-body">
										<div class="d-flex align-items-center justify-content-between mt-5">
											<div class="lesson_name">
												<div class="project-block light-info-bg">
													<i class="icofont-fork-and-knife"></i>
												</div>
												<span class="small text-muted project_name fw-bold"><?=$d['description'];?></span>
											</div>
										</div>
										<div class="row g-2 pt-4">
											<div class="col-6">
												<div class="d-flex align-items-center">
													Date
												</div>
											</div>
											<div class="col-6">
												<div class="d-flex align-items-center">
													<i class="icofont-calendar"></i>
													<span class="ms-2"><?=date('m/d/Y',strtotime($d['date']));?></span>
												</div>
											</div>
											<div class="col-6">
												<div class="d-flex align-items-center">
													Time
												</div>
											</div>
											<div class="col-6">
												<div class="d-flex align-items-center">
													<i class="icofont-clock-time "></i>
													<span class="ms-2"><?=date('h:i A',strtotime($d['time']));?></span>
												</div>
											</div>
										</div>
										<div class="dividers-block"></div>
										<div class="d-flex align-items-center justify-content-between mb-2">
											<h4 class="small fw-bold mb-0"></h4>
										</div>
									</div>
								</div>
							</div>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</div><!-- Row End -->

	</div>
</div>
