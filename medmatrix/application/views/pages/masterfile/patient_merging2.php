<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h4 class="fw-bold py-3 mb-0"><?=$title;?></h4>
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
			<div class="margin_0 mb-3">
				<table width="100%" border="0" cellspacing="1" cellpadding="1">
					<tr>
						<td><h2>Station: <?=$station;?> (<?=count($rooms);?>)</h2></td>
						<td><a href="#" class="btn btn-success addRoom" style="float:right; margin-right:10px;" data-bs-toggle="modal" data-bs-target="#addRoom" data-id="<?=$station;?>"><i class="fa fa-plus"></i> Add Room</a></td>
						<td>
							<?=form_open(base_url()."view_room_search");?>
							<input type="hidden" name="station" value="<?=$station;?>">
							<input type="text" name="searchme" class="form-control" placeholder="Search room here.." style="width:100%;">
						</td>
						<td width="6%" align="center">
							<?php
							if($search_result != ""){
								?>
								<a href="<?=base_url();?>view_rooms/<?=$station;?>" class="btn btn-primary">Refresh</a>
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
			</div>
			<div class="tab-pane fade show active" id="grid-view">
				<div class="row clearfix g-3">
					<div class="col-lg-12">
						<div class="row row-cols-sm-1 row-cols-md-2 row-col-lg-3 row-cols-xl-2 row-cols-xxl-3">
							<?php
								foreach($rooms as $emp){
									if($emp['roomstat']=="vacant"){
										$badge="success";
									}else{
										$badge="danger";
									}
							?>
							<div class="col">
								<div class="card teacher-card mb-3 flex-column">
									<div class="card-body d-flex teacher-fulldeatil flex-column">
										<div class="profile-teacher text-center w220 mx-auto">
											<a href="#">
												<img src="<?=base_url();?>design/images/hospitalroom.webp" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
											</a>
											<button class="btn btn-primary editRoom" style="position: absolute;top:15px;right: 15px;" data-bs-toggle="modal" data-bs-target="#addRoom" data-id="<?=$emp['autono'];?>_<?=$station;?>"><i class="icofont-edit"></i></button>
											<div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
												<span class="text-muted small">Room ID : <?=$emp['autono'];?></span>
											</div>
										</div>
										<div class="teacher-info   w-100">
											<h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center"><?=$emp['room'];?></h6>
											<span class="py-1 fw-bold small-11 mb-0 mt-1 text-center mx-auto d-block"><span class="badge bg-<?=$badge;?>"><?=$emp['roomstat'];?></span></span>
											<div class="row g-2 pt-2">
												<div class="col-xl-12">
													<div class="d-flex align-items-center">
														<i class="icofont-price"></i>
														<span class="ms-2"><?=number_format($emp['roomrates'],2);?></span>
													</div>
												</div>
												<div class="col-xl-12">
													<div class="d-flex align-items-center">
														<i class="icofont-patient-bed"></i>
														<span class="ms-2"><?=$emp['roomprop'];?></span>
													</div>
												</div>
												<div class="col-xl-12">
														<span>
															<a href="<?=base_url();?>change_room_status/<?=$station;?>/<?=$emp['autono'];?>/<?=$emp['roomstat'];?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Do you wish to change room status?');return false;">Change Room Status</a>
														</span>
												</div>
											</div>
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
