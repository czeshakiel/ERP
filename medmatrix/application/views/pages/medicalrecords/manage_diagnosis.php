<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row clearfix">
			<div class="col-md-12">
				<div class="card border-0 mb-4 no-bg">
					<div class="card-header py-3 px-0 d-flex align-items-center  justify-content-between border-bottom">
						<h6 class=" fw-bold flex-fill mb-0"><?=$title;?></h5>
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
				if($discharge['datedischarged']==""){
					$ddate="";
					$dtime="";
					$edit="";
				}else{
					$ddate=date('M-d-Y',strtotime($discharge['datedischarged']));
					$dtime=date('h:i A',strtotime($discharge['timedischarged']));
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
							$doctor=$this->General_model->fetch_single_doctor_by_code($patient['ap']);
							$hrn=$this->Records_model->checkHRN($patient['patientidno']);
							if($hrn==""){
								$button="";
							}else{
								$button=$hrn['hrn'];
							}
							?>
							<a href="#">
								<img src="<?=base_url();?>design/images/lg/<?=$avatar;?>" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
							</a>
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
										<span class="ms-2 small"><?=$patient['street'];?>, <?=$patient['barangay'];?>, <?=$patient['municipality'];?>, <?=$patient['province'];?> <?=$patient['zipcode'];?> </span>
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
				<div class="card teacher-card mb-3">
					<div class="card-header">
						<h6  class="mb-0 mt-2  fw-bold d-block fs-6">Case Rates
							<?php
							//if($patient['status']=='discharged'){}else{
								?>
								<a href="<?=base_url();?>add_diagnosis/<?=$patientidno;?>/<?=$caseno;?>" class="btn btn-info btn-sm text-white" style="float: right;"><i class="icofont-plus-square"></i> Add Diagnosis</a>

								<!-- <a href="#" class="btn btn-warning btn-sm text-white addICDCode" style="float: right; margin-right: 5px;" data-bs-toggle="modal" data-bs-target="#AddICDCode" data-id="<?=$patientidno;?>_<?=$caseno;?>"><i class="icofont-plus-square"></i> Add ICD Code</a> -->
								<?php
							//}
							?>
						</h6>
					</div>
					<div class="card-body">
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
						<div class="row g-2 pt-2">
							<table class="table table-bordered">
								<thead>
								<tr>
									<th>ICD10CODE</th>
									<th>CODE</th>
									<th>DESCRIPTION</th>
									<th>HOSPITAL SHARE</th>
									<th>PF SHARE</th>
									<th wid>ACTION</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$log=0;
								$mod=0;
								foreach($caserate as $case){
									$check=$this->Records_model->db->query("SELECT * FROM patienthospOptDischargesMorbidity WHERE patientidno='$caseno' AND icd10category='$case[icdcode]'");
                                              if($check->num_rows() > 0){
                                                $view="";
                                                $view1="style='display:none;'";
                                                $mod++;
                                              }else{
                                                $view="style='display:none;'";
                                                $view1="";
                                              }
                                              if((($case['emrgroup'] != "" && $case['level']=="primary") || ($case['emrgroup'] != "" && $patient['membership']=="Nonmed-none")) && $mod==0){
                                                $log++;
                                              }
									echo "<tr>";
									echo "<td>$case[emrgroup]</td>";
									echo "<td>$case[icdcode]</td>";
									echo "<td>$case[description]</td>";
									echo "<td align='right'>".number_format($case['hospitalshare'],2)."</td>";
									echo "<td align='right'>".number_format($case['pfshare'],2)."</td>";
									echo "<td width='15%'>";
									//if($patient['status']=='discharged'){}else{
										?>
										<a href="#" class="btn btn-success btn-sm text-white editDiagnosis" data-bs-toggle="modal" data-bs-target="#EditDiagnosis" data-id="<?=$patientidno;?>_<?=$caseno;?>_<?=$case['autono'];?>"><i class="icofont-ui-edit"></i> Edit</a>
										<?php
										if($case['level']=="primary" || $case['level']=="secondary"){
											?>
											<a href="<?=base_url();?>remove_emr/<?=$patientidno;?>/<?=$caseno;?>/<?=$case['icdcode'];?>" class="btn btn-danger btn-sm" <?=$view;?>><i class="icofont-trash"></i>Remove from EMR</a>
											<?php
										}else{
											?>
											<a href="<?=base_url();?>remove_diagnosis/<?=$patientidno;?>/<?=$caseno;?>/<?=$case['autono'];?>" class="btn btn-sm btn-danger text-white" onclick="return confirm('Do you wish to remove this caserate?');return false;"><i class="icofont-trash"></i> Remove</a>
											<?php
										}
										?>
										<a href="#" class="btn btn-primary btn-sm tagEMR" data-bs-toggle="modal" data-bs-target="#TagEMR" data-id="<?=$patientidno;?>_<?=$caseno;?>_<?=$case['icdcode'];?>_<?=$case['description'];?>_<?=$case['autono'];?>" <?=$view1;?>><i class="icofont-ui-edit"></i> Tag to EMR</a>
										<?php
									//}
									echo "</td>";
									echo "</tr>";
								}
								?>
								</tbody>
							</table>
							<div class="col-xl-2">
								<?php
								if($log>0){
									?>
							<a href="<?=base_url();?>logout_case/<?=$patientidno;?>/<?=$caseno;?>" onclick="return confirm('Do you wish to logout this case?');return false;" class="btn btn-info text-white"><i class="icofont-exit"></i> Logout Case</a>
							<?php
						}
						?>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- Row End -->

	</div>
</div>
