<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row clearfix g-3">
			<div class="col-xl-12 col-lg-12 col-md-12 flex-column">
				<div class="row g-3">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
								<h6 class="mb-0 fw-bold ">Medical Records Information</h6>
							</div>
							<div class="card-body">
								<div class="row g-2 row-deck">
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-user fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Total Patient</h6>
												<h2><span class="text-muted"><?=count($patient);?></span></h2>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-ambulance fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Total In-Patient</h6>
												<h2><span class="text-muted"><?=count($inpatient);?></span></h2>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-home fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Total Out-Patient</h6>
												<h2><span class="text-muted"><?=count($outpatient);?></span></h2>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-patient-bed fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Total Walkin Patient</h6>
												<h2><span class="text-muted"><?=count($walkinpatient);?></span></h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
