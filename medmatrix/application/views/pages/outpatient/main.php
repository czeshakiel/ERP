<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row clearfix g-3">
			<div class="col-xl-12 col-lg-12 col-md-12 flex-column">
				<div class="row g-3">
					<div class="col-md-12">
						<div class="card">
							<?php
							if($this->session->dept=="OPD"){
								$dept="Out Patient";
							}else{
								$dept=$this->session->dept;
							}
							?>
							<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
								<h6 class="mb-0 fw-bold "><?=$dept;?> Department Information</h6>
							</div>
							<div class="card-body">
								<div class="row g-2 row-deck">
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-user fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Today's Outpatient</h6>
												<h2><span class="text-muted"><?=count($outpatient);?></span></h2>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-ambulance-crescent fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Today's Walkin</h6>
												<h2><span class="text-muted"><?=count($walkin);?></span></h2>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-home fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Today's Laboratory</h6>
												<h2><span class="text-muted"><?=count($laboratory);?></span></h2>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-bed fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Today's Diagnostics</h6>
												<h2><span class="text-muted"><?=count($diagnostics);?></span></h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
