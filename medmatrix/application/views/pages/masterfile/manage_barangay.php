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
								<td><h4>List of Barangay<small><a href="#" class="btn btn-success btn-sm addBarangay" style="float:right; margin-right:10px;" data-bs-toggle="modal" data-bs-target="#ManageBarangay" data-id="<?=$province;?>_<?=$city;?>"><i class="fa fa-plus"></i> Add Barangay</a></small></h4></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table id="employee-table" class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th width="2%">#</th>
								<th width="5%">Code</th>
								<th>Barangay</th>
								<th>City/Municipality</th>
								<th>Province</th>
								<th width="15%">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($barangay as $emp){
								echo "<tr>";
								echo "<td>$x.</td>";
								echo "<td>$emp[id]</td>";
								echo "<td>$emp[barangay]</td>";
								echo "<td>$emp[city]</td>";
								echo "<td>$emp[statename]</td>";
								?>
								<td><a href='#' class='btn btn-info btn-sm text-white editBarangay' data-bs-toggle='modal' data-bs-target='#ManageBarangay' data-id="<?=$emp['id'];?>_<?=$city;?>_<?=$province;?>"><i class='icofont-pencil-alt-1'></i> Edit </a> <a href="<?=base_url();?>delete_barangay/<?=$emp['id'];?>/<?=$city;?>/<?=$province;?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Do you wish to delete this barangay?');return false;"><i class='icofont-trash'></i> Delete</a></td>
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
