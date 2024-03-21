<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row clearfix g-3">
			<div class="col-xl-12 col-lg-12 col-md-12 flex-column">
				<div class="row g-3">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
								<h6 class="mb-0 fw-bold ">Dietary Information</h6>
							</div>
							<div class="card-body">
								<div class="row g-2 row-deck">
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-users fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Total In-Patient</h6>
												<h2><span class="text-muted"><?=count($employees);?></span></h2>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-user-alt-1 fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">MGH Status</h6>
												<h2><span class="text-muted"><?=count($rooms);?></span></h2>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-user-alt-7 fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Warning Status</h6>
												<h2><span class="text-muted"><?=count($doctors);?></span></h2>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-user-alt-5 fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Locked Status</h6>
												<h2><span class="text-muted"><?=count($hmo);?></span></h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
