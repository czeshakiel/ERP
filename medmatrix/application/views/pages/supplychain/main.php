<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row clearfix g-3">
			<div class="col-xl-12 col-lg-12 col-md-12 flex-column">
				<div class="row g-3">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
								<h6 class="mb-0 fw-bold ">Supply Chain Management Information (<?=$this->session->dept;?>)</h6>
							</div>
							<div class="card-body">
								<div class="row g-2 row-deck">
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-medicine fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Medicine</h6>
												<h2><span class="text-muted"><?=count($medicine);?></span></h2>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-injection-syringe fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Supplies</h6>
												<h2><span class="text-muted"><?=count($supplies);?></span></h2>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-flask fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Diagnostics</h6>
												<h2><span class="text-muted"><?=count($diagnostics);?></span></h2>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="card">
											<div class="card-body ">
												<i class="icofont-building-alt fs-1"></i>
												<h6 class="mt-3 mb-0 fw-bold small-14">Suppliers</h6>
												<h2><span class="text-muted"><?=count($suppliers);?></span></h2>
											</div>
										</div>
									</div>
									<?php
									$reorder=0;
									foreach($items as $item){
										if($item['soh'] <= $item['quantity']){
											$reorder++;
										}
									}
									?>
									<div class="col-md-12 col-sm-12">
										<div class="card">
											<div class="card-body ">
												<a href="<?=base_url();?>critical_level" target="_blank"><i class="icofont-medicine fs-3"> <i class="icofont-injection-syringe fs-3"></i></i></a>
												<h6 class="mt-3 mb-0 fw-bold small-14">Items need to reorder.</h6>
												<h2><span class="text-muted"><?=$reorder;?></span></h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
