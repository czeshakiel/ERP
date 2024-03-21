<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row clearfix">
			<div class="col-md-12">
				<div class="card border-0 mb-4 no-bg">
					<div class="card-header py-3 px-0 d-flex align-items-center  justify-content-between border-bottom">
						<h6 class=" fw-bold flex-fill mb-0"><?=$title;?></h6>
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
				<div class="card teacher-card">
					<br>
					<div class="card-header">
						<h3>Case Rates <a href="#" data-bs-toggle="modal" data-bs-target="#AddICD10" class="btn btn-primary btn-sm">Add ICD</a>
							<div style="float: right; width: 30%;">
								<?=form_open(base_url()."search_add_diagnosis");?>
								<input type="hidden" name="patientidno" value="<?=$patientidno;?>">
								<input type="hidden" name="caseno" value="<?=$caseno;?>">
								<input type="text" name="description" class="form-control" placeholder="Enter description or icd code here and press <enter> key">
								<?=form_close();?>
							</div>
						</h3>
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
						<div class="row">
							<table class="table">
								<thead>
								<tr>
									<th>CODE</th>
									<th>DESCRIPTION</th>
									<th>GROUP</th>
									<th>HOSPITAL SHARE</th>
									<th>PF SHARE</th>
									<th>ACTION</th>
								</tr>
								</thead>
								<tbody>
                                <?php
                                foreach($caserates as $case){
									if($case['category']=="surgical"){
										$typecr="rvs";
									}else{
										$typecr="icd";
									}
									$check=$this->Records_model->checkExistICD($caseno,$case['icdcode']);
									if($check){
										$view="style='display:none'";
										$text="SELECTED";
									}else{
										$view="";
										$text="";
									}
                                    echo "<tr>";
                                    echo "<td>$case[icdcode]</td>";
                                    echo "<td>$case[description]</td>";
									echo "<td>$case[groupdiag]</td>";
                                    echo "<td align='right'>".number_format($case['hospital'],2)."</td>";
                                    echo "<td align='right'>".number_format($case['pf'],2)."</td>";
                                    echo "<td width='12%'>";
									?>
										<a href="#" class="btn btn-success btn-sm text-white addDiagnosis" data-bs-toggle="modal" data-bs-target="#AddDiagnosis" data-id="<?=$patientidno;?>_<?=$caseno;?>_<?=$case['icdcode'];?>_<?=$typecr;?>_<?=$case['description'];?>" <?=$view;?>>Select</a> <?=$text;?>
									<?php
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div><!-- Row End -->

	</div>
</div>
