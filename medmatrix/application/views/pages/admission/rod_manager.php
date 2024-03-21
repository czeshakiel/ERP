<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h3 class="fw-bold py-3 mb-0"><?=$title;?></h3>
				</div>
			</div>
		</div> <!-- Row end  -->
		<div class="tab-content">
			<div class="tab-pane fade show active" id="grid-view">
				<div class="row clearfix g-3">
					<div class="col-lg-4">
						<div class="card sticky-lg-top">
							<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
								<h6 class="mb-0 fw-bold ">Today's Resident on Duty</h6>
							</div>
							<div class="card-body">
								<div class="profile-teacher text-center w220 mx-auto">
									<a href="#">
										<img src="<?=base_url();?>design/images/lg/avatar5.jpg" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
									</a>
									<div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
										<span class="text-muted small">DOCTOR ID : <?=$rodcode;?></span>
									</div>
								</div>
								<div class="teacher-info   w-100">
									<h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center"><?=$rod;?></h6>
									<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block"><?=date('M-d-Y');?></span>
								</div>
								<?php
								if($this->session->set_success){
								?>
									<div class="alert alert-success text-muted"><?=$this->session->set_success;?></div>
								<?php
								}
								?>
								<?php
								if($this->session->set_failed){
									?>
									<div class="alert alert-danger text-muted"><?=$this->session->set_failed;?></div>
									<?php
								}
								?>
							</div>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="row row-cols-sm-1 row-cols-md-2 row-col-lg-3 row-cols-xl-2 row-cols-xxl-3">
							<?php
							foreach($admitting as $rod){
								if($rod['code']==$rodcode){
									$view="display:none;";
									$avatar="avatar5";
								}else{
									$view="";
									$avatar="avatar4";
								}
								?>
								<div class="col">
								<div class="card teacher-card mb-3 flex-column">
									<div class="card-body d-flex teacher-fulldeatil flex-column">
										<div class="profile-teacher text-center w220 mx-auto">
											<a href="#">
												<img src="<?=base_url();?>design/images/lg/<?=$avatar;?>.jpg" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
											</a>
											<a href="<?=base_url();?>set_rod/<?=$rod['code'];?>" class="btn btn-primary" style="position: absolute;top:15px;right: 15px;<?=$view;?>" onclick="return confirm('Do you wish to update today`s resident on duty?');return false;"><i class="icofont-edit"></i></a>
											<div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
												<span class="text-muted small">DOCTOR ID: <?=$rod['code'];?></span>
											</div>
										</div>
										<div class="teacher-info   w-100">
											<h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center"><?=$rod['lastname'];?>, <?=$rod['firstname'];?></h6>
											<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block"><?=$rod['specialization'];?></span>
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
			</div>
		</div>
	</div>
</div>
