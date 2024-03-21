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
								<td><h4>List of Diagnostics<small><a href="#" class="btn btn-success btn-sm addDiagnostics" style="float:right; margin-right:10px;" data-bs-toggle="modal" data-bs-target="#ManageDiagnostics"><i class="fa fa-plus"></i> Add Diagnostic</a></small></h4></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table id="employee-table" class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th>#</th>
								<th>Code</th>
								<th>Description</th>
								<th>Lot No</th>
								<th>Unit</th>
								<th width="10%">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($diagnostics as $emp){
								echo "<tr>";
								echo "<td>$x.</td>";
								echo "<td>$emp[code]</td>";
								echo "<td>$emp[description]</td>";
								echo "<td>$emp[lotno]</td>";
								echo "<td>$emp[unit]</td>";?>
								<td><a href='#' class='btn btn-info btn-sm text-white editDiagnostics' data-bs-toggle='modal' data-bs-target='#ManageDiagnostics' data-id="<?=$emp['code'];?>"><i class='icofont-pencil-alt-1'></i> Edit </a> | <a href="<?=base_url();?>delete_diagnostic/<?=$emp['code'];?>" onclick="return confirm('Do you wish to delete this diagnostic?');return false;" class="btn btn-danger text-white"><i class='icofont-trash'></i> Delete</a></td>
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
