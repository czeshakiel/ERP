<script>
	function search_history(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Loading..... Please wait.";
	}
</script>
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
				$discharge=$this->Admission_model->discharged($patient['caseno']);
				$editprofile="";
				if($discharge['datedischarged']==""){
					$ddate="";
					$dtime="";
					$edit="";
					if($department=="MEDICAL RECORDS"){
						$edit="<span class='badge bg-warning'><a href='' class='editDischargedDateTime' data-bs-toggle='modal' data-bs-target='#DischargedDateTime' data-id='".$patient['patientidno']."_".$patient['caseno']."_".$discharge['datearray']."_".$discharge['timedischarged']."'>Edit</a></span>";
						$address="<span class='badge bg-info'><a href='' class='editAddressmrd' data-bs-toggle='modal' data-bs-target='#EditAddress' data-id='".$patient['patientidno']."_".$patient['caseno']."'>Edit</a></span>";
						// if($patient['status']=='discharged' && $patient['result']=="FINAL"){
						// 	$edit="";
						// }
					}else{
						$edit="";
						$address="";
					}
				}else{
					$ddate=date('M-d-Y',strtotime($discharge['datedischarged']));
					$dtime=date('h:i A',strtotime($discharge['timedischarged']));
					if($department=="MEDICAL RECORDS"){
						$edit="<span class='badge bg-warning'><a href='' class='editDischargedDateTime' data-bs-toggle='modal' data-bs-target='#DischargedDateTime' data-id='".$patient['patientidno']."_".$patient['caseno']."_".$discharge['datearray']."_".$discharge['timedischarged']."'>Edit</a></span>";
						$address="<span class='badge bg-info'><a href='' class='editAddressmrd' data-bs-toggle='modal' data-bs-target='#EditAddress' data-id='".$patient['patientidno']."_".$patient['caseno']."'>Edit</a></span>";
						// if($patient['status']=='discharged' && $patient['result']=="FINAL"){
						// 	$edit="";
						// }
					}else{
						$edit="";
						$address="";
					}
					$editprofile="display:none;";
				}
				if($department=="MEDICAL RECORDS"){
					//$address="<span class='badge bg-info'><a href='' class='editAddressmrd' data-bs-toggle='modal' data-bs-target='#EditAddress' data-id='".$patient['patientidno']."_".$patient['caseno']."'>Edit</a></span>";
					$details="<span class='badge bg-success'><a href='' class='editAdmitTimemrd' data-bs-toggle='modal' data-bs-target='#EditAdmissionTime' data-id='".$patient['caseno']."_".$patient['patientidno']."'>Edit</a></span>";
					if($patient['status']=='discharged' && $patient['result']=="FINAL"){
						$reopen="<a href='#' class='btn btn-warning btn-sm text-white reopen' data-bs-toggle='modal' data-bs-target='#ReOpen' data-id='".$patient['caseno']."_".$patient['patientidno']."'>Re-Open</a>";
						// $details="";
					}else{
						$reopen="";
					}
					$editprofile="";
				}else{
					//$address="";
					$details="";
					$reopen="";
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
							$hrn=$this->Records_model->checkHRN($patient['patientidno']);
							if($hrn==""){
								$button="";
							}else{
								$button=$hrn['hrn'];
							}
							$name=$patient['lastname'].", ".$patient['firstname']." ".$patient['middlename']." ".$patient['suffix'];
							$doctor=$this->General_model->fetch_single_doctor_by_code($patient['ap']);
							?>
							<a href="#">
								<img src="<?=base_url();?>design/images/lg/<?=$avatar;?>" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
							</a>
							<a href="#" class="btn btn-primary editpatientprofilemrd" data-bs-toggle="modal" data-bs-target="#EditPatientProfile" data-id="<?=$patient['patientidno'];?>_<?=$patient['caseno'];?>" style="position: absolute;top:15px;right: 15px; <?=$editprofile;?>" title="Edit Profile" ><i class="icofont-edit"></i></a>
							<!--							<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditPatientProfile" data-id="--><?//=$patient['patientidno'];?><!--" style="position: absolute;top:15px;right: 15px;" title="Edit Profile"><i class="icofont-edit"></i></a>-->
							<div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
								<h6 class="mb-0 fw-bold d-block fs-6"><?=$patient['firstname'];?></h6>
								<span class="text-muted small">Patient ID: <?=$button;?></span>
							</div>
						</div>
						<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
							<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?=$name;?></h6>
							<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted">Patient</span>
							<p class="mt-2 small">&nbsp;</p>
							<div class="row g-2 pt-2">
								<div class="col-xl-5">
									<div class="d-flex align-items-center">
										<i class="<?=$sex;?>"></i>
										<span class="ms-2 small"><?=$gender;?> </span>
									</div>
								</div>
								<div class="col-xl-5">
									<div class="d-flex align-items-center">
										<i class="icofont-ui-calendar"></i>
										<span class="ms-2 small"><?=$patient['age'];?> y/o</span>
									</div>
								</div>
								<div class="col-xl-5">
									<div class="d-flex align-items-center">
										<i class="icofont-birthday-cake"></i>
										<span class="ms-2 small"><?=date('m/d/Y',strtotime($patient['dateofbirth']));?></span>
									</div>
								</div>
								<div class="col-xl-5">
									<div class="d-flex align-items-center">
										<i class="icofont-user-male"></i>
										<span class="ms-2 small"><?=$patient['stat1'];?></span>
									</div>
								</div>
								<div class="col-xl-12">
									<div class="d-flex align-items-center">
										<i class="icofont-home"></i>
										<span class="ms-2 small"><?=$patient['street'];?>, <?=$patient['barangay'];?>, <?=$patient['municipality'];?>, <?=$patient['province'];?> <?=$patient['zipcode'];?> <?=$address;?></span>
									</div>
								</div>
								<div class="col-xl-5">
									<div class="d-flex align-items-center">
										<i class="icofont-phone-circle"></i>
										<span class="ms-2 small"><?=$patient['patientcontactno'];?></span>
									</div>
								</div>
								<div class="col-xl-5">
									<div class="d-flex align-items-center">
										<i class="icofont-patient-bed"></i>
										<span class="ms-2 small"><?=$patient['room'];?></span>
									</div>
								</div>
								<div class="col-xl-5">
									<div class="d-flex align-items-center">
										<i class="icofont-doctor"></i>
										<span class="ms-2 small">DR. <?=$doctor['name'];?></span>
									</div>
								</div>
								<div class="col-xl-5">
									<div class="d-flex align-items-center">
										<i class="icofont-2checkout"></i>
										<span class="ms-2 small"><?=$patient['employerno'];?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card teacher-card  mb-3">
					<div class="card-body">
						<div style="position: absolute; left:45%;" align="center"  id="loadermain">
							<div class="spinner-border text-center" style="width: 10rem; height: 10rem;" role="status"></div>
							<h5 id="loaderlabel">Saving.....</h5>
						</div>
						<?php
						if($this->session->success){
							?>
							<div class="alert alert-success"><?=$this->session->success;?></div>
						<?php
						}
						?>
						<?php
						if($this->session->failed){
							?>
							<div class="alert alert-danger"><?=$this->session->failed;?></div>
							<?php
						}
						?>
							<h6  class="mb-0 mt-2  fw-bold d-block fs-6">Admission Details <?=$details;?><div style="float:right;"><?=$reopen;?></div></h6>
							<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted"><?=$patient['caseno'];?></span>
							<div class="row g-2 pt-2">
								<table class="table table-bordered">
									<thead>
									<tr>
										<th>Date/Time Admitted</th>
										<th>Admitting Diagnosis</th>
										<th>Date/Time Discharged</th>
										<th>Final Diagnosis</th>
										<th>Disposition</th>
									</tr>
									</thead>
									<tbody>
										<tr>
											<td style="vertical-align: top;"><?=date('M-d-Y',strtotime($patient['dateadmit']));?> / <?=date('h:i A',strtotime($patient['timeadmitted']));?></td>
											<td style="vertical-align: top;"><?=$patient['initialdiagnosis'];?></td>
											<td style="vertical-align: top;"><?=$ddate;?> / <?=$dtime;?> <?=$edit;?></td>
											<td>
												<?php
												$caserate=$this->General_model->finalcaserate($patient['caseno']);
												foreach($caserate as $case){
													echo $case['icdcode']." - ".$case['description']."<br>";
												}
												?>
											</td>
											<td style="vertical-align: top;"><?=$patient['status'];?>/<?=$patient['disposition'];?></td>
										</tr>
									</tbody>
								</table>
							</div>
					</div>
				</div>
				<?php
				if($department=="MEDICAL RECORDS"){
					if($patient['result']=="FINAL"){
						$final="";
						$final1="style='display:none;'";
					}else{
						$final="style='display:none;'";
						$final1="";
					}
				?>
					<div class="card teacher-card  mb-3">
						<div class="card-header bg-primary text-white">
							<b>Transactions</b>
						</div>
						<div class="card-body">
							<div class="row">
								<table class="table">
									<tr>
										<td><a href="<?=base_url();?>manage_diagnosis/<?=$patientidno;?>/<?=$caseno;?>" class="btn btn-success btn-sm text-white" onclick="search_history();">Manage Diagnosis</a>
											<?php
											if($patient['status']=='discharged'){}else{
												?>
												<a href="" class="btn btn-success btn-sm text-white">Add Final Diagnosis</a>
												<?php
											}
											?>
											<div class="btn-group">
												<button type="button" class="btn btn-success btn-sm dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">CF4 Details</button>
												<ul class="dropdown-menu border-0 shadow bg-success">
													<?php echo"
													<li><a class='dropdown-item text-light' href='http://".$_SERVER['HTTP_HOST']."/ERP/main/bridge.php?username=".$this->session->username."&nursename=".$this->session->fullname."&dept=".$this->session->dept."&otherinfo&caseno=$patient[caseno]' target='_blank'>CF4 Edit Additional Info</a></li>
													"; ?>
													<li><hr class="dropdown-divider"></li>

													<li><a class="dropdown-item text-light" href="<?=base_url();?>printCF3/<?=$caseno;?>" target="_blank">CF3</a></li>
													<li><hr class="dropdown-divider"></li>
													<!--li><a class="dropdown-item text-light" href="#">CF4</a></li>
													<li><hr class="dropdown-divider"></li-->
													<?php echo "
													<li><a class='dropdown-item text-light' href='http://".$_SERVER['HTTP_HOST']."/ERP/extra/HMOSOA/?caseno=$patient[caseno]&user=".$this->session->username."&dept=MEDICAL RECORDS' target='_blank'>View SOA</a></li>

													<li><hr class='dropdown-divider'></li>
													<li><a class='dropdown-item text-light' href='http://".$_SERVER['HTTP_HOST']."/ERP/extra/Details/?caseno=$patient[caseno]&user=".base64_encode($this->session->username)."&dept=MEDICAL RECORDS' target='_blank'>View SOA Details</a></li>
													"; ?>
													<li><hr class="dropdown-divider"></li>
													<li><a class="dropdown-item text-light" href="../../../nsstation/mesheet2.php?caseno=<?=$caseno;?>" target="_blank">ME Sheet</a></li>
												</ul>
											</div>
												<div class="btn-group">
													<button type="button" class="btn btn-success btn-sm dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">Admission Details</button>
													<ul class="dropdown-menu border-0 shadow bg-success">
														<li><a class="dropdown-item text-light editDisposition" href="#" data-bs-toggle="modal" data-bs-target="#EditDisposition" data-id="<?=$patientidno;?>_<?=$caseno;?>_<?=$patient['disposition'];?>_<?=$patient['status'];?>">Manage Disposition</a></li>
														<li><hr class="dropdown-divider"></li>
														<?php
															if($patient['status']=='discharged'){
																?>
																<li><a class="dropdown-item text-light" href="#"  <?=$final1;?> data-bs-toggle="modal" data-bs-target="#ErrorDischarged">Discharge Patient</a></li>
																<?php
															}else{
																?>
																<li><a class="dropdown-item text-light dischargedPatient" href="#" <?=$final;?> data-bs-toggle="modal" data-bs-target="#DischargePatient" data-id="<?=$patientidno;?>_<?=$caseno;?>">Discharge Patient</a></li>
																<?php
															}
															?>
														<li><hr class="dropdown-divider"></li>
														<li><a class="dropdown-item text-light updateAP" href="#" data-bs-toggle="modal" data-bs-target="#UpdateAttending" data-id="<?=$patientidno;?>_<?=$caseno;?>_<?=$patient['ap'];?>">Manage Attending Physician</a></li>
														<li><hr class="dropdown-divider"></li>
														<li><a class="dropdown-item text-light updateFinalDiag" href="#" data-bs-toggle="modal" data-bs-target="#UpdateFinalDiagnosis" data-id="<?=$patientidno;?>_<?=$caseno;?>_<?=$patient['finaldiagnosis'];?>">Edit Final Diagnosis</a></li>
													</ul>
												</div>
												<div class="btn-group">
													<button type="button" class="btn btn-success btn-sm dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">E-Chart</button>
													<ul class="dropdown-menu border-0 shadow bg-success">
														<?php
															$chart=$this->Records_model->getChart($caseno);
															if($chart){
																?>
																<li><a class="dropdown-item text-light" href="<?=base_url();?>delete_chart/<?=$patientidno;?>/<?=$caseno;?>/<?=$chart['id'];?>" onclick="return confirm('Do you wish to delete this chart?');return false;">Delete Chart</a></li>
																<li><hr class="dropdown-divider"></li>
																<li><a class="dropdown-item text-light" href="../../../main/view_chart.php?id=<?=$chart['id'];?>" target="_blank">View Chart</a></li>
																<?php
															}else{
																?>
																<li><a class="dropdown-item text-light uploadchart" href="#" data-bs-toggle="modal" data-bs-target="#UploadChart" data-id="<?=$patientidno;?>_<?=$caseno;?>">Upload Chart</a></li>
																<?php
															}
														 ?>
													</ul>
												</div>
											<div class="btn-group">
												<button type="button" class="btn btn-success btn-sm dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">Test Performed</button>
												<ul class="dropdown-menu border-0 shadow bg-success">
													<li><a class="dropdown-item text-light" href="<?=base_url();?>testresultview/<?=$patientidno;?>/<?=$caseno;?>/LABORATORY">Laboratory</a></li>
													<li><hr class="dropdown-divider"></li>
													<li><a class="dropdown-item text-light" href="<?=base_url();?>testresultview/<?=$patientidno;?>/<?=$caseno;?>/XRAY">Imaging</a></li>
													<li><hr class="dropdown-divider"></li>
													<li><a class="dropdown-item text-light" href="<?=base_url();?>testresultview/<?=$patientidno;?>/<?=$caseno;?>/ULTRASOUND">Ultrasound</a></li>
													<li><hr class="dropdown-divider"></li>
													<li><a class="dropdown-item text-light" href="<?=base_url();?>testresultview/<?=$patientidno;?>/<?=$caseno;?>/CT SCAN">CT Scan</a></li>
													<li><hr class="dropdown-divider"></li>
													<li><a class="dropdown-item text-light" href="<?=base_url();?>testresultview/<?=$patientidno;?>/<?=$caseno;?>/HEARTSTATION">Cardiography</a></li>
													<li><hr class="dropdown-divider"></li>
													<li><a class="dropdown-item text-light" href="<?=base_url();?>testresultview/<?=$patientidno;?>/<?=$caseno;?>/MAMMOGRAM">Mammography</a></li>
												</ul>
											</div>
											<div class="btn-group">
												<button type="button" class="btn btn-success btn-sm dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">Charged Items</button>
												<ul class="dropdown-menu border-0 shadow bg-success">
													<li><a class="dropdown-item text-light" href="<?=base_url();?>medsupview/<?=$patientidno;?>/<?=$caseno;?>/MEDICINE">Medicines</a></li>
													<li><hr class="dropdown-divider"></li>
													<li><a class="dropdown-item text-light" href="<?=base_url();?>medsupview/<?=$patientidno;?>/<?=$caseno;?>/SUPPLIES">Supplies</a></li>
												</ul>
											</div>
											<div class="btn-group">
												<button type="button" class="btn btn-success btn-sm dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">Department Services</button>
												<ul class="dropdown-menu border-0 shadow bg-success">
													<li><a class="dropdown-item text-light" href="<?=base_url();?>documents/<?=$patientidno;?>/<?=$caseno;?>/Medical Certificate">Medical Certificate</a></li>
													<li><hr class="dropdown-divider"></li>
													<li><a class="dropdown-item text-light" href="<?=base_url();?>documents/<?=$patientidno;?>/<?=$caseno;?>/Medical Abstract">Medical Abstract</a></li>
													<li><hr class="dropdown-divider"></li>
													<!--li><a class="dropdown-item text-light" href="<?=base_url();?>documents/<?=$patientidno;?>/<?=$caseno;?>/Clinical Abstract">Clinical Abstract</a></li-->
													<!--li><hr class="dropdown-divider"></li-->
													<li><a class="dropdown-item text-light" href="<?=base_url();?>documents/<?=$patientidno;?>/<?=$caseno;?>/Confinement Certificate">Confinement Certificate</a></li>
													<li><hr class="dropdown-divider"></li>
													<li><a class="dropdown-item text-light" href="<?=base_url();?>documents/<?=$patientidno;?>/<?=$caseno;?>/Medico Legal">Medico Legal</a></li>
													<li><hr class="dropdown-divider"></li>
													<li><a class="dropdown-item text-light secondCopy" href="#" data-bs-toggle="modal" data-bs-target="#SecondCopy" data-id="<?=$patientidno;?>_<?=$caseno;?>">Other Documents</a></li>
													<li><hr class="dropdown-divider"></li>
													<li><a class="dropdown-item text-light" href="http://192.168.0.100:100/ERP/printresult/dischargedsummary/<?=$caseno;?>" target="_blank">Discharged Summary</a></li>
													<li><a class="dropdown-item text-light" href="http://192.168.0.100:100/2020codes/DischargeSummary.php?caseno=<?=$caseno;?>&nursename=<?=$this->session->fullname;?>" target="_blank">Discharged Summary Old</a></li>
												</ul>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div><!-- Row End -->

	</div>
</div>
