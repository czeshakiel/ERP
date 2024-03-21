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
							if($this->session->dept=="MEDICAL RECORDS"){
								$index="";
							}else{
								$index="display:none;";
							}
							$hrn=$this->Records_model->checkHRN($patient['patientidno']);
							if($hrn==""){
								$button="";
							}else{
								$button=$hrn['hrn'];
							}
							?>

							<a href="#">								
								<a href="<?=base_url();?>index_card/<?=$patientidno;?>" style="position: absolute;top:15px;right: 60px; <?=$index;?>" title="Index Card"   class="btn btn-success btn-sm text-white" target="_blank"><i class="icofont-printer"></i> Index Card</a>		
								<img src="<?=base_url();?>design/images/lg/<?=$avatar;?>" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
								<a href="#" class="btn btn-primary editpatientprofile" data-bs-toggle="modal" data-bs-target="#EditPatientProfile" data-id="<?=$patient['patientidno'];?>" style="position: absolute;top:15px;right: 15px;" title="Edit Profile"><i class="icofont-edit"></i></a>
							</a>							
							<div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">								
								<h6 class="mb-0 fw-bold d-block fs-6"><?=$patient['firstname'];?></h6>								
								<span class="text-muted small">Patient ID: 
									<?php
									if($button==""){
										if($this->session->username=="SHAYE"){
										?>
										<a href="<?=base_url();?>create_hrn/<?=$patient['patientidno'];?>" class="btn btn-primary btn-sm text-white" onclick="return confirm('Do you wish to generate HRN?');return false;" style="<?=$index;?>">Generate HRN</a>				
										<?php
									}
									}else{
										echo $button;
									}
									?>
									</span>
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
								<th>Status</th>
								<th>Action</th>								
							</tr>
							</thead>
							<tbody>
						<?php
						$x=1;
						foreach($admission as $admit){														
							echo "<tr style='font-size:12px;'>";
								echo "<td>$x.</td>";
								echo "<td><b>$admit[caseno]</b></td>";
								echo "<td>$admit[dateadmitted] ".date('h:i A',strtotime($admit['timeadmitted']))."</td>";								
								echo "<td>$admit[status]</td>";
								?>
								<td><a href="<?=base_url();?>view_patient_record_details/<?=$admit['patientidno'];?>/<?=$admit['caseno'];?>" class="btn btn-warning btn-sm text-white">View Details</a></td>
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
