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
								<td><h4>Account Title<small><a href="#" class="btn btn-success btn-sm addProvince" style="float:right; margin-right:10px;" data-bs-toggle="modal" data-bs-target="#AddAccountTitle"><i class="fa fa-plus"></i> Add Account Title</a></small></h4></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table id="employee-table" class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th width="2%">#</th>								
								<th width="2%">Code</th>
								<th>Account Title</th>
								<th>HMO</th>
								<th width="15%">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($items as $emp){
								
								echo "<tr>";
									echo "<td>$x.</td>";
									echo "<td>$emp[id]</td>";
									echo "<td>$emp[accounttitle]</td>";
									echo "<td>$emp[hmo]</td>";
									echo "<td><a href='#'  class='btn btn-warning btn-sm text-white editAccttitle' title='Edit Account Title' data-bs-toggle='modal' data-bs-target='#EditAccounttitle' data-id='$emp[id]_$emp[accounttitle]_$emp[hmo]'><i class='icofont-ui-edit'></i></a>
										<a href='".base_url()."soa_settings_details/$emp[id]' class='btn btn-info btn-sm text-white' title='View Details'><i class='icofont-ui-search'></i></a>
										";
									?>
									<a href="<?=base_url();?>delete_soa_accounttitle/<?=$emp['id'];?>" class="btn btn-danger btn-sm text-white" title="Delete Account Title" onclick="return confirm('Do you wish to delete this item? Note: All sub account title under this account will be deleted!');return false;"><i class="icofont-ui-delete"></i></a>
									<?php
									echo "</td>";
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
