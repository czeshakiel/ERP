<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h4 class="fw-bold mb-0"><?=$title;?></h4>
				</div>
			</div>
		</div> <!-- Row end  -->
		<?php if($this->session->save_success){ ?>
			<div class="alert alert-success" role="alert"><?=$this->session->save_success;?></div>
		<?php } ?>
		<?php if($this->session->save_failed){ ?>
			<div class="alert alert-danger" role="alert"><?=$this->session->save_failed;?></div>
		<?php } ?>
		<div class="row align-item-center">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td width="10%"><h6 class="mb-0 fw-bold ">List of Company</h6></td>
								<td align="right"><a href="#" class="btn btn-success addHMO" data-bs-toggle="modal" data-bs-target="#ManageCompany"><i class="icofont-plus-circle"></i> Add Company</a></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table id="employee-table" class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th>#</th>
								<th>Code</th>
								<th>Name</th>
								<th>Address</th>
								<th>Type</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($company as $emp){
								echo "<td>$x.</td>";
								echo "<td>$emp[acctno]</td>";
								echo "<td>$emp[companyname]</td>";
								echo "<td>$emp[Address]</td>";
								echo "<td>$emp[type]</td>";?>
								<td><a href='#' class='btn btn-outline-warning text-warning editManageHMO' data-bs-toggle='modal' data-bs-target='#ManageCompany' data-id="<?=$emp['acctno'];?>"><i class='icofont-pencil-alt-1'></i> Edit </a> <a href="<?=base_url();?>delete_hmo/<?=$emp['acctno'];?>" style='color:red;' class="btn btn-outline-danger" onclick="return confirm('Do you wish to delete this company?');return false;"><i class='icofont-trash'></i> Delete</a></td>
								<?php
								echo "</tr>";
								$x++;
							}
							?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div><!-- Row end  -->

	</div>
</div>
