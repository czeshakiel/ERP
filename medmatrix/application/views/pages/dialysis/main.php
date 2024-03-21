<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row clearfix g-3">
			<div class="col-xl-12 col-lg-12 col-md-12 flex-column">
				<div class="row g-3">
					<img src="design/images/dialysis.png" width="100" height="300">
					<div class="col-md-12">
						<div class="card">						
							<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
								<h6 class="mb-0 fw-bold ">Dialysis Information</h6>
							</div>
							<div class="card-body">
								<div class="row g-2 row-deck">
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-user fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Active Dialysis Patient</h6>
												<h2><span class="text-muted"><?=count($inpatient);?></span></h2>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-ambulance-crescent fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Today's Dialysis</h6>
												<h2><span class="text-muted"><?=count($newadmit);?></span></h2>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-home fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Today's MGH</h6>
												<h2><span class="text-muted"><?=count($mgh);?></span></h2>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-bed fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Total Discharged</h6>
												<h2><span class="text-muted"><?=count($vacantroom);?></span></h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
