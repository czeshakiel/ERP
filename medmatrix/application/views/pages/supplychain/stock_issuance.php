<div class="body d-flex py-lg-3 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h5 class="fw-bold py-3 mb-0"><?=$title;?></h5>
				</div>
			</div>
		</div> <!-- Row end  -->
		<?php if($this->session->save_success){ ?>
			<div class="alert alert-success" role="alert"><?=$this->session->save_success;?></div>
		<?php } ?>
		<?php if($this->session->save_failed){ ?>
			<div class="alert alert-danger" role="alert"><?=$this->session->save_failed;?></div>
		<?php } ?>
		<div class="tab-content">
			<div class="tab-pane fade show active" id="grid-view">
				<div class="row clearfix g-3">
					<div class="col-lg-12">
						<div class="row row-cols-sm-1 row-cols-md-2 row-col-lg-3 row-cols-xl-2 row-cols-xxl-3">
							<?php
							$x=1;
							if(count($requests)>0){
							foreach($requests as $emp){
								$request=$this->Purchase_model->getAllRequestByReqNo($emp['reqdept']);
								$pending=count($request);
								?>
								<div class="col-md-3">
									<div class="card teacher-card mb-3 flex-column">
										<div class="card-body d-flex teacher-fulldeatil flex-column">
											<div class="profile-teacher text-center w220 mx-auto">
												<a href="#">
													<img src="<?=base_url();?>design/images/lg/avatar4.jpg" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
												</a>
												<a href="<?=base_url();?>view_stock_issuance/<?=$emp['reqdept'];?>" class="btn btn-primary" style="position: absolute;top:15px;right: 15px;"><i class="icofont-eye"></i> View</a>
												<div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
													<span class="text-muted small">No. : <?=$x;?></span>
												</div>
											</div>
											<div class="teacher-info   w-100">
												<h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center"><?=$emp['reqdept'];?></h6>
												<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block">Pending Request: <?=$pending;?></span>
											</div>
										</div>
									</div>
								</div>
								<?php
								$x++;
							}
							}else{
								?>
								<div class="col-md-3">
									<div class="card teacher-card mb-3 flex-column">
										<div class="card-body d-flex teacher-fulldeatil flex-column">
											<div class="profile-teacher text-center w220 mx-auto">
												<a href="#">
													<img src="<?=base_url();?>design/images/lg/avatar4.jpg" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
												</a>
												<div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
													<span class="text-muted small"></span>
												</div>
											</div>
											<div class="teacher-info   w-100">
												<h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center">No Requesting Department</h6>
												<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block">Pending Request: 0</span>
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
