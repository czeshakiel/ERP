<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row clearfix g-3">
			<div class="col-xl-12 col-lg-12 col-md-12 flex-column">
				<div class="row g-3">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
								<h6 class="mb-0 fw-bold "><?=$title;?></h6>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<div style="float:right; margin-top: 20px;">
									<a href="#" class="btn btn-primary btn-sm addbillingreport" data-bs-toggle="modal" data-bs-target="#ManageBillingReport">Add Account Title</a>
								</div>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-12">	
									<table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
										<thead>
											<tr>
												<th>ID</th>
												<th>Account Title</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php																				
											
												$x=1;
											foreach ($items as $item){
												echo "<tr>";
													echo "<td>$x.</td>";
													echo "<td>$item[accounttitle]</td>";
													echo "<td align='center'><a href='#' class='btn btn-success btn-sm editbillingreport' data-bs-toggle='modal' data-bs-target='#ManageBillingReport' data-id='$item[id]_$item[accounttitle]'>Edit</a>
													 <a href='".base_url()."delete_billing_report/$item[id]/$item[accounttitle]' class='btn btn-danger btn-sm'>Delete</a>
													</td>";
												echo"</tr>";
												$x++;
											}											
										?>	
										</tbody>
										</table>								
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
