<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h4 class="fw-bold py-3 mb-0"><?=$title;?></h4>
				</div>
			</div>
		</div> <!-- Row end  -->
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
		<div class="tab-content">
			<div class="tab-pane fade show active" id="grid-view">
				<div class="row clearfix g-3">
					<table width="100%" border="0" cellspacing="1" cellpadding="1">
						<tr>
							<td><h4>List of Doctors (<?=count($doctors);?>) <small><a href="#" class="btn btn-success btn-sm .addDoctor" style="float:right; margin-right:10px;" data-bs-toggle="modal" data-bs-target="#modal_add_doctor"><i class="icofont-plus-circle"></i> Add Doctor</a></small></h4></td>
							<td><?=form_open(base_url()."manage_search_doctors");?>
								<input type="text" name="searchme" class="form-control" placeholder="Search doctor here.. e.g lastname firstname" style="width:100%;">
							</td>
							<td width="6%" align="center">
								<?php
								if($search_result != ""){
									?>
									<a href="<?=base_url();?>manage_doctors" class="btn btn-primary">Refresh</a>
									<?php
								}else{
									?>
									<input type="submit" class="btn btn-primary" value="Search">
									<?php
								}
								?>
							</td>
							<?=form_close();?>
						</tr>
					</table>
					<div class="col-lg-12">
						<div class="row row-cols-sm-1 row-cols-md-2 row-col-lg-3 row-cols-xl-2 row-cols-xxl-3">
							<?php
							foreach($doctors as $rod){
								?>
								<div class="col">
									<div class="card teacher-card mb-3 flex-column">
										<div class="card-body d-flex teacher-fulldeatil flex-column">
											<div class="profile-teacher text-center w220 mx-auto">
												<a href="#">
													<img src="<?=base_url();?>design/images/lg/avatar5.jpg" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
												</a>
												<a href="#" class="btn btn-primary editDoctor" style="position: absolute;top:15px;right: 15px;" data-bs-toggle="modal" data-bs-target="#modal_add_doctor" data-id="<?=$rod['code'];?>"><i class="icofont-edit"></i></a>
												<div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
													<span class="text-muted small">DOCTOR ID: <?=$rod['code'];?></span>
												</div>
											</div>
											<div class="teacher-info   w-100">
												<h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center"><?=$rod['lastname'];?>, <?=$rod['firstname'];?></h6>
												<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block"><?=$rod['specialization'];?></span>
												<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block"><a href="<?=base_url();?>manage_doctor_account/<?=$rod['code'];?>" class="btn btn-outline-success btn-sm">User Account</a></span>
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
