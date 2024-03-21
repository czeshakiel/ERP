<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row clearfix">
			<div class="col-md-12">
				<div class="card border-0 mb-4 no-bg">
					<div class="card-header py-3 px-0 d-flex align-items-center  justify-content-between border-bottom">
						<h3 class=" fw-bold flex-fill mb-0"><?=$title;?></h3>
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
							 $hmo="";
							 $nhmo="display:none;";
							 if($this->session->dept=="HMO"){
							// 	$hmo="display:none;";
							 	$nhmo="";
							 }							 
							?>
							<a href="#">
								<img src="<?=base_url();?>design/images/lg/<?=$avatar;?>" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
							</a>
							<!-- <a href="#" class="btn btn-primary editpatientprofile" data-bs-toggle="modal" data-bs-target="#EditPatientProfile" data-id="<?=$patient['patientidno'];?>" style="position: absolute;top:15px;right: 15px;<?=$hmo;?>" title="Edit Profile"><i class="icofont-edit"></i></a> -->
							<div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
								<h6 class="mb-0 fw-bold d-block fs-6"><?=$patient['firstname'];?></h6>
								<span class="text-muted small">Patient ID: <?=$patient['patientidno'];?></span>
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
										<span class="ms-2 small"><?=$senior;?></span>
									</div>
								</div>
								<div class="col-xl-12">
									<div class="d-flex align-items-center">
										<i class="icofont-home"></i>
										<?php
										$admitting=$this->General_model->getSingleAddress($patient['patientidno']);
										?>
										<span class="ms-2 small"><?=$admitting['street'];?>, <?=$admitting['barangay'];?>, <?=$admitting['municipality'];?>, <?=$admitting['province'];?> <?=$admitting['zipcode'];?> <!--a href="#" class="btn btn-outline-info btn-sm text-info editAddress" data-bs-toggle="modal" data-bs-target="#EditAddress" data-id="<?=$patient['patientidno'];?>" style="<?=$hmo;?>"><i>Edit Address</i></a--></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<h6 class="fw-bold  py-3 mb-3">Admission History</h6>
				<div class="teachercourse-list">
					<div class="row g-3 gy-5 py-3 row-deck">
						
					<div class="card-body">
						<table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th width="1%">No.</th>
								<th>Caseno</th>
								<th>Admission<br>Date & Time</th>
								<th>Room</th>
								<th>HMO</th>								
								<th>GUARANTOR</th>
								<th width="30%">Admitting Diagnosis</th>
								<th>Status</th>
								<th width="10%"></th>
							</tr>
							</thead>
							<tbody>
							<?php							
							$x=1;
							foreach($admission as $list){
								$charge=$this->Admission_model->checkCharge($list['caseno']);
								if($charge){
									$view="style='display:none;'";
								}else{
									$view="";
								}
								if($this->session->dept=="ER"){
								$er="";
								$other="style='display:none;'";
								$admit="";
								$mesheet="style='display:none;'";
								$mesheet1=$this->Emergency_model->checkMESheet($list['caseno']);
								if($mesheet1){
									$mesheet="";
								}
							}else{
								$er="";
								$other="";
								$admit="style='display:none;'";
								$mesheet="style='display:none;'";
							}
							$guarantor=$this->General_model->checkChargeTo($list['addemployer']);
							if($guarantor['lastname']==""){
								$chargeto=$list['addemployer'];								
							}else{
								$chargeto=$guarantor['lastname'].", ".$guarantor['firstname']." ".$guarantor['middlename'];
							}
							if($guarantor['lastname']==""){
								if($this->session->dept=="BILLING"){
									$prof="";
								}else{
									$prof="";
								}
							}else{
								if($this->session->dept=="BILLING"){								
									$prof="";
								}else{
									$prof="style='display:none;'";
								}
							}
								echo "<tr style='font-size:12px;'>";
								echo "<td>$x.</td>";
								echo "<td><b>$list[caseno]</b></td>";
								echo "<td>$list[dateadmitted] ".date('h:i A',strtotime($list['timeadmitted']))."</td>";
								echo "<td>$list[room]</td>";
								echo "<td>$list[hmo]</td>";
								echo "<td>$chargeto</td>";
								echo "<td>$list[initialdiagnosis]</td>";
								echo "<td>$list[status]</td>";
								?>
								<td align="center" width="10%">
									<a class="btn btn-primary btn-sm" href="<?=base_url();?>view_profile/<?=$list['caseno'];?>" <?=$prof;?>><i class="icofont-eye"></i> View Profile</a>	
								</td>
								<?php
								echo "</tr>";
								$x++;
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
