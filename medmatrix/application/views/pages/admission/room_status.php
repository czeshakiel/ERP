<div class="body d-flex py-lg-3 py-md-2">
	<div class="container-xxl">

		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h3 class="fw-bold mb-0 py-3 pb-2"><?=$title;?></h3>
					<div class="col-auto py-2 w-sm-100">
						<ul class="nav nav-tabs tab-body-header rounded invoice-set" role="tablist">
							<li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#NS1" role="tab">Nurse Station 1</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#NS2" role="tab">Nurse Station 2</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#NS3" role="tab">Nurse Station 3</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#NS5A" role="tab">Nurse Station 5A</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#NS5B" role="tab">Nurse Station 5B</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#NS6" role="tab">Nurse Station 6</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#ICU" role="tab">Intensive Care Unit</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#ER" role="tab">Emergency Room</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#SCU" role="tab">Special Care Unit</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#COVIDICU" role="tab">Special Care Unit</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div> <!-- Row end  -->

		<div class="row justify-content-center">

			<div class="col-lg-12 col-md-12">
				<div class="tab-content">
					<?php
					if($this->session->set_success){
					?>
						<div class="alert alert-success"><?=$this->session->set_success;?></div>
					<?php
					}
					?>
					<?php
					if($this->session->set_failed){
						?>
						<div class="alert alert-danger"><?=$this->session->set_failed;?></div>
						<?php
					}
					?>
					<div class="tab-pane fade show active" id="NS1">
						<div class="row justify-content-center">
							<div class="col-lg-8 col-md-12">
								<?php
								$station=$this->General_model->getAllRoomByStation('NS1');
								foreach($station as $room){
									if($room['roomstat']=="vacant"){
										$occupied="style='display:none;'";
										$vacant="";
										$bg="bg-success";
									}else{
										$vacant="style='display:none;'";
										$occupied="";
										$bg="bg-danger";
									}
								?>
								<div class="card mb-3">
									<div class="card-body d-sm-flex justify-content-between">
										<a href="javascript:void(0);" class="d-flex">
											<img class="avatar rounded-circle" src="<?=base_url();?>design/images/hospitalroom.webp" alt="">
											<div class="flex-fill ms-3 text-truncate">
												<h6 class="d-flex justify-content-between mb-0"><span><?=$room['room'];?></span></h6>
												<span class="badge <?=$bg;?>"><?=$room['roomstat'];?></span>
											</div>
										</a>
										<div class="text-end d-none d-md-block">
											<p class="mb-1"><i class="icofont-bed ps-1"></i> <?=$room['roomprop'];?></p>
											<span class="text-muted"><i class="icofont-money ps-1"></i>Php <?=number_format($room['roomrates'],2);?> per day</span>
										</div>
									</div>
									<div class="card-footer justify-content-between d-flex align-items-center">
										<div class="d-none d-md-block">
											<strong>Credit Limit: </strong>
											<span><?=number_format($room['pfadmit'],2);?></span>
										</div>
										<div class="card-hover-show">
											<a class="btn btn-sm btn-success border lift text-white" href="<?=base_url();?>set_status_vacant/<?=$room['autono'];?>" <?=$occupied;?> onclick="return confirm('Do you wish to set this room to vacant?');return false;">Set to Vacant</a>
											<a class="btn btn-sm btn-danger border lift text-white" href="<?=base_url();?>set_status_occupied/<?=$room['autono'];?>" <?=$vacant;?> onclick="return confirm('Do you wish to set this room to occupied?');return false;">Set to Occupied</a>
										</div>
									</div>
								</div>
								<?php
								}
								?>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="NS2">
						<div class="row justify-content-center">
							<div class="col-lg-8 col-md-12">
								<?php
								$station=$this->General_model->getAllRoomByStation('NS2');
								foreach($station as $room){
									if($room['roomstat']=="vacant"){
										$occupied="style='display:none;'";
										$vacant="";
										$bg="bg-success";
									}else{
										$vacant="style='display:none;'";
										$occupied="";
										$bg="bg-danger";
									}
									?>
									<div class="card mb-3">
										<div class="card-body d-sm-flex justify-content-between">
											<a href="javascript:void(0);" class="d-flex">
												<img class="avatar rounded-circle" src="<?=base_url();?>design/images/hospitalroom.webp" alt="">
												<div class="flex-fill ms-3 text-truncate">
													<h6 class="d-flex justify-content-between mb-0"><span><?=$room['room'];?></span></h6>
													<span class="badge <?=$bg;?>"><?=$room['roomstat'];?></span>
												</div>
											</a>
											<div class="text-end d-none d-md-block">
												<p class="mb-1"><i class="icofont-bed ps-1"></i> <?=$room['roomprop'];?></p>
												<span class="text-muted"><i class="icofont-money ps-1"></i>Php <?=number_format($room['roomrates'],2);?> per day</span>
											</div>
										</div>
										<div class="card-footer justify-content-between d-flex align-items-center">
											<div class="d-none d-md-block">
												<strong>Credit Limit: </strong>
												<span><?=number_format($room['pfadmit'],2);?></span>
											</div>
											<div class="card-hover-show">
												<a class="btn btn-sm btn-success border lift text-white" href="<?=base_url();?>set_status_vacant/<?=$room['autono'];?>" <?=$occupied;?> onclick="return confirm('Do you wish to set this room to vacant?');return false;">Set to Vacant</a>
												<a class="btn btn-sm btn-danger border lift text-white" href="<?=base_url();?>set_status_occupied/<?=$room['autono'];?>" <?=$vacant;?> onclick="return confirm('Do you wish to set this room to occupied?');return false;">Set to Occupied</a>
											</div>
										</div>
									</div>
									<?php
								}
								?>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="NS3">
						<div class="row justify-content-center">
							<div class="col-lg-8 col-md-12">
								<?php
								$station=$this->General_model->getAllRoomByStation('NS3');
								foreach($station as $room){
									if($room['roomstat']=="vacant"){
										$occupied="style='display:none;'";
										$vacant="";
										$bg="bg-success";
									}else{
										$vacant="style='display:none;'";
										$occupied="";
										$bg="bg-danger";
									}
									?>
									<div class="card mb-3">
										<div class="card-body d-sm-flex justify-content-between">
											<a href="javascript:void(0);" class="d-flex">
												<img class="avatar rounded-circle" src="<?=base_url();?>design/images/hospitalroom.webp" alt="">
												<div class="flex-fill ms-3 text-truncate">
													<h6 class="d-flex justify-content-between mb-0"><span><?=$room['room'];?></span></h6>
													<span class="badge <?=$bg;?>"><?=$room['roomstat'];?></span>
												</div>
											</a>
											<div class="text-end d-none d-md-block">
												<p class="mb-1"><i class="icofont-bed ps-1"></i> <?=$room['roomprop'];?></p>
												<span class="text-muted"><i class="icofont-money ps-1"></i>Php <?=number_format($room['roomrates'],2);?> per day</span>
											</div>
										</div>
										<div class="card-footer justify-content-between d-flex align-items-center">
											<div class="d-none d-md-block">
												<strong>Credit Limit: </strong>
												<span><?=number_format($room['pfadmit'],2);?></span>
											</div>
											<div class="card-hover-show">
												<a class="btn btn-sm btn-success border lift text-white" href="<?=base_url();?>set_status_vacant/<?=$room['autono'];?>" <?=$occupied;?> onclick="return confirm('Do you wish to set this room to vacant?');return false;">Set to Vacant</a>
												<a class="btn btn-sm btn-danger border lift text-white" href="<?=base_url();?>set_status_occupied/<?=$room['autono'];?>" <?=$vacant;?> onclick="return confirm('Do you wish to set this room to occupied?');return false;">Set to Occupied</a>
											</div>
										</div>
									</div>
									<?php
								}
								?>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="NS5A">
						<div class="row justify-content-center">
							<div class="col-lg-8 col-md-12">
								<?php
								$station=$this->General_model->getAllRoomByStation('NS 5A');
								foreach($station as $room){
									if($room['roomstat']=="vacant"){
										$occupied="style='display:none;'";
										$vacant="";
										$bg="bg-success";
									}else{
										$vacant="style='display:none;'";
										$occupied="";
										$bg="bg-danger";
									}
									?>
									<div class="card mb-3">
										<div class="card-body d-sm-flex justify-content-between">
											<a href="javascript:void(0);" class="d-flex">
												<img class="avatar rounded-circle" src="<?=base_url();?>design/images/hospitalroom.webp" alt="">
												<div class="flex-fill ms-3 text-truncate">
													<h6 class="d-flex justify-content-between mb-0"><span><?=$room['room'];?></span></h6>
													<span class="badge <?=$bg;?>"><?=$room['roomstat'];?></span>
												</div>
											</a>
											<div class="text-end d-none d-md-block">
												<p class="mb-1"><i class="icofont-bed ps-1"></i> <?=$room['roomprop'];?></p>
												<span class="text-muted"><i class="icofont-money ps-1"></i>Php <?=number_format($room['roomrates'],2);?> per day</span>
											</div>
										</div>
										<div class="card-footer justify-content-between d-flex align-items-center">
											<div class="d-none d-md-block">
												<strong>Credit Limit: </strong>
												<span><?=number_format($room['pfadmit'],2);?></span>
											</div>
											<div class="card-hover-show">
												<a class="btn btn-sm btn-success border lift text-white" href="<?=base_url();?>set_status_vacant/<?=$room['autono'];?>" <?=$occupied;?> onclick="return confirm('Do you wish to set this room to vacant?');return false;">Set to Vacant</a>
												<a class="btn btn-sm btn-danger border lift text-white" href="<?=base_url();?>set_status_occupied/<?=$room['autono'];?>" <?=$vacant;?> onclick="return confirm('Do you wish to set this room to occupied?');return false;">Set to Occupied</a>
											</div>
										</div>
									</div>
									<?php
								}
								?>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="NS5B">
						<div class="row justify-content-center">
							<div class="col-lg-8 col-md-12">
								<?php
								$station=$this->General_model->getAllRoomByStation('NS 5B');
								foreach($station as $room){
									if($room['roomstat']=="vacant"){
										$occupied="style='display:none;'";
										$vacant="";
										$bg="bg-success";
									}else{
										$vacant="style='display:none;'";
										$occupied="";
										$bg="bg-danger";
									}
									?>
									<div class="card mb-3">
										<div class="card-body d-sm-flex justify-content-between">
											<a href="javascript:void(0);" class="d-flex">
												<img class="avatar rounded-circle" src="<?=base_url();?>design/images/hospitalroom.webp" alt="">
												<div class="flex-fill ms-3 text-truncate">
													<h6 class="d-flex justify-content-between mb-0"><span><?=$room['room'];?></span></h6>
													<span class="badge <?=$bg;?>"><?=$room['roomstat'];?></span>
												</div>
											</a>
											<div class="text-end d-none d-md-block">
												<p class="mb-1"><i class="icofont-bed ps-1"></i> <?=$room['roomprop'];?></p>
												<span class="text-muted"><i class="icofont-money ps-1"></i>Php <?=number_format($room['roomrates'],2);?> per day</span>
											</div>
										</div>
										<div class="card-footer justify-content-between d-flex align-items-center">
											<div class="d-none d-md-block">
												<strong>Credit Limit: </strong>
												<span><?=number_format($room['pfadmit'],2);?></span>
											</div>
											<div class="card-hover-show">
												<a class="btn btn-sm btn-success border lift text-white" href="<?=base_url();?>set_status_vacant/<?=$room['autono'];?>" <?=$occupied;?> onclick="return confirm('Do you wish to set this room to vacant?');return false;">Set to Vacant</a>
												<a class="btn btn-sm btn-danger border lift text-white" href="<?=base_url();?>set_status_occupied/<?=$room['autono'];?>" <?=$vacant;?> onclick="return confirm('Do you wish to set this room to occupied?');return false;">Set to Occupied</a>
											</div>
										</div>
									</div>
									<?php
								}
								?>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="NS6">
						<div class="row justify-content-center">
							<div class="col-lg-8 col-md-12">
								<?php
								$station=$this->General_model->getAllRoomByStation('NS 6');
								foreach($station as $room){
									if($room['roomstat']=="vacant"){
										$occupied="style='display:none;'";
										$vacant="";
										$bg="bg-success";
									}else{
										$vacant="style='display:none;'";
										$occupied="";
										$bg="bg-danger";
									}
									?>
									<div class="card mb-3">
										<div class="card-body d-sm-flex justify-content-between">
											<a href="javascript:void(0);" class="d-flex">
												<img class="avatar rounded-circle" src="<?=base_url();?>design/images/hospitalroom.webp" alt="">
												<div class="flex-fill ms-3 text-truncate">
													<h6 class="d-flex justify-content-between mb-0"><span><?=$room['room'];?></span></h6>
													<span class="badge <?=$bg;?>"><?=$room['roomstat'];?></span>
												</div>
											</a>
											<div class="text-end d-none d-md-block">
												<p class="mb-1"><i class="icofont-bed ps-1"></i> <?=$room['roomprop'];?></p>
												<span class="text-muted"><i class="icofont-money ps-1"></i>Php <?=number_format($room['roomrates'],2);?> per day</span>
											</div>
										</div>
										<div class="card-footer justify-content-between d-flex align-items-center">
											<div class="d-none d-md-block">
												<strong>Credit Limit: </strong>
												<span><?=number_format($room['pfadmit'],2);?></span>
											</div>
											<div class="card-hover-show">
												<a class="btn btn-sm btn-success border lift text-white" href="<?=base_url();?>set_status_vacant/<?=$room['autono'];?>" <?=$occupied;?> onclick="return confirm('Do you wish to set this room to vacant?');return false;">Set to Vacant</a>
												<a class="btn btn-sm btn-danger border lift text-white" href="<?=base_url();?>set_status_occupied/<?=$room['autono'];?>" <?=$vacant;?> onclick="return confirm('Do you wish to set this room to occupied?');return false;">Set to Occupied</a>
											</div>
										</div>
									</div>
									<?php
								}
								?>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="ICU">
						<div class="row justify-content-center">
							<div class="col-lg-8 col-md-12">
								<?php
								$station=$this->General_model->getAllRoomByStation('ICU');
								foreach($station as $room){
									if($room['roomstat']=="vacant"){
										$occupied="style='display:none;'";
										$vacant="";
										$bg="bg-success";
									}else{
										$vacant="style='display:none;'";
										$occupied="";
										$bg="bg-danger";
									}
									?>
									<div class="card mb-3">
										<div class="card-body d-sm-flex justify-content-between">
											<a href="javascript:void(0);" class="d-flex">
												<img class="avatar rounded-circle" src="<?=base_url();?>design/images/hospitalroom.webp" alt="">
												<div class="flex-fill ms-3 text-truncate">
													<h6 class="d-flex justify-content-between mb-0"><span><?=$room['room'];?></span></h6>
													<span class="badge <?=$bg;?>"><?=$room['roomstat'];?></span>
												</div>
											</a>
											<div class="text-end d-none d-md-block">
												<p class="mb-1"><i class="icofont-bed ps-1"></i> <?=$room['roomprop'];?></p>
												<span class="text-muted"><i class="icofont-money ps-1"></i>Php <?=number_format($room['roomrates'],2);?> per day</span>
											</div>
										</div>
										<div class="card-footer justify-content-between d-flex align-items-center">
											<div class="d-none d-md-block">
												<strong>Credit Limit: </strong>
												<span><?=number_format($room['pfadmit'],2);?></span>
											</div>
											<div class="card-hover-show">
												<a class="btn btn-sm btn-success border lift text-white" href="<?=base_url();?>set_status_vacant/<?=$room['autono'];?>" <?=$occupied;?> onclick="return confirm('Do you wish to set this room to vacant?');return false;">Set to Vacant</a>
												<a class="btn btn-sm btn-danger border lift text-white" href="<?=base_url();?>set_status_occupied/<?=$room['autono'];?>" <?=$vacant;?> onclick="return confirm('Do you wish to set this room to occupied?');return false;">Set to Occupied</a>
											</div>
										</div>
									</div>
									<?php
								}
								?>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="ER">
						<div class="row justify-content-center">
							<div class="col-lg-8 col-md-12">
								<?php
								$station=$this->General_model->getAllRoomByStation('ER');
								foreach($station as $room){
									if($room['roomstat']=="vacant"){
										$occupied="style='display:none;'";
										$vacant="";
										$bg="bg-success";
									}else{
										$vacant="style='display:none;'";
										$occupied="";
										$bg="bg-danger";
									}
									?>
									<div class="card mb-3">
										<div class="card-body d-sm-flex justify-content-between">
											<a href="javascript:void(0);" class="d-flex">
												<img class="avatar rounded-circle" src="<?=base_url();?>design/images/hospitalroom.webp" alt="">
												<div class="flex-fill ms-3 text-truncate">
													<h6 class="d-flex justify-content-between mb-0"><span><?=$room['room'];?></span></h6>
													<span class="badge <?=$bg;?>"><?=$room['roomstat'];?></span>
												</div>
											</a>
											<div class="text-end d-none d-md-block">
												<p class="mb-1"><i class="icofont-bed ps-1"></i> <?=$room['roomprop'];?></p>
												<span class="text-muted"><i class="icofont-money ps-1"></i>Php <?=number_format($room['roomrates'],2);?> per day</span>
											</div>
										</div>
										<div class="card-footer justify-content-between d-flex align-items-center">
											<div class="d-none d-md-block">
												<strong>Credit Limit: </strong>
												<span><?=number_format($room['pfadmit'],2);?></span>
											</div>
											<div class="card-hover-show">
												<a class="btn btn-sm btn-success border lift text-white" href="<?=base_url();?>set_status_vacant/<?=$room['autono'];?>" <?=$occupied;?> onclick="return confirm('Do you wish to set this room to vacant?');return false;">Set to Vacant</a>
												<a class="btn btn-sm btn-danger border lift text-white" href="<?=base_url();?>set_status_occupied/<?=$room['autono'];?>" <?=$vacant;?> onclick="return confirm('Do you wish to set this room to occupied?');return false;">Set to Occupied</a>
											</div>
										</div>
									</div>
									<?php
								}
								?>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="SCU">
						<div class="row justify-content-center">
							<div class="col-lg-8 col-md-12">
								<?php
								$station=$this->General_model->getAllRoomByStation('SCU');
								foreach($station as $room){
									if($room['roomstat']=="vacant"){
										$occupied="style='display:none;'";
										$vacant="";
										$bg="bg-success";
									}else{
										$vacant="style='display:none;'";
										$occupied="";
										$bg="bg-danger";
									}
									?>
									<div class="card mb-3">
										<div class="card-body d-sm-flex justify-content-between">
											<a href="javascript:void(0);" class="d-flex">
												<img class="avatar rounded-circle" src="<?=base_url();?>design/images/hospitalroom.webp" alt="">
												<div class="flex-fill ms-3 text-truncate">
													<h6 class="d-flex justify-content-between mb-0"><span><?=$room['room'];?></span></h6>
													<span class="badge <?=$bg;?>"><?=$room['roomstat'];?></span>
												</div>
											</a>
											<div class="text-end d-none d-md-block">
												<p class="mb-1"><i class="icofont-bed ps-1"></i> <?=$room['roomprop'];?></p>
												<span class="text-muted"><i class="icofont-money ps-1"></i>Php <?=number_format($room['roomrates'],2);?> per day</span>
											</div>
										</div>
										<div class="card-footer justify-content-between d-flex align-items-center">
											<div class="d-none d-md-block">
												<strong>Credit Limit: </strong>
												<span><?=number_format($room['pfadmit'],2);?></span>
											</div>
											<div class="card-hover-show">
												<a class="btn btn-sm btn-success border lift text-white" href="<?=base_url();?>set_status_vacant/<?=$room['autono'];?>" <?=$occupied;?> onclick="return confirm('Do you wish to set this room to vacant?');return false;">Set to Vacant</a>
												<a class="btn btn-sm btn-danger border lift text-white" href="<?=base_url();?>set_status_occupied/<?=$room['autono'];?>" <?=$vacant;?> onclick="return confirm('Do you wish to set this room to occupied?');return false;">Set to Occupied</a>
											</div>
										</div>
									</div>
									<?php
								}
								?>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="COVIDICU">
						<div class="row justify-content-center">
							<div class="col-lg-8 col-md-12">
								<?php
								$station=$this->General_model->getAllRoomByStation('COVID ICU');
								foreach($station as $room){
									if($room['roomstat']=="vacant"){
										$occupied="style='display:none;'";
										$vacant="";
										$bg="bg-success";
									}else{
										$vacant="style='display:none;'";
										$occupied="";
										$bg="bg-danger";
									}
									?>
									<div class="card mb-3">
										<div class="card-body d-sm-flex justify-content-between">
											<a href="javascript:void(0);" class="d-flex">
												<img class="avatar rounded-circle" src="<?=base_url();?>design/images/hospitalroom.webp" alt="">
												<div class="flex-fill ms-3 text-truncate">
													<h6 class="d-flex justify-content-between mb-0"><span><?=$room['room'];?></span></h6>
													<span class="badge <?=$bg;?>"><?=$room['roomstat'];?></span>
												</div>
											</a>
											<div class="text-end d-none d-md-block">
												<p class="mb-1"><i class="icofont-bed ps-1"></i> <?=$room['roomprop'];?></p>
												<span class="text-muted"><i class="icofont-money ps-1"></i>Php <?=number_format($room['roomrates'],2);?> per day</span>
											</div>
										</div>
										<div class="card-footer justify-content-between d-flex align-items-center">
											<div class="d-none d-md-block">
												<strong>Credit Limit: </strong>
												<span><?=number_format($room['pfadmit'],2);?></span>
											</div>
											<div class="card-hover-show">
												<a class="btn btn-sm btn-success border lift text-white" href="<?=base_url();?>set_status_vacant/<?=$room['autono'];?>" <?=$occupied;?> onclick="return confirm('Do you wish to set this room to vacant?');return false;">Set to Vacant</a>
												<a class="btn btn-sm btn-danger border lift text-white" href="<?=base_url();?>set_status_occupied/<?=$room['autono'];?>" <?=$vacant;?> onclick="return confirm('Do you wish to set this room to occupied?');return false;">Set to Occupied</a>
											</div>
										</div>
									</div>
									<?php
								}
								?>
							</div>
						</div>  <!-- Row end  -->
					</div>
				</div>
			</div>

		</div> <!-- Row end  -->
	</div>
</div>
