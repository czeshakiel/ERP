<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h5 class="fw-bold mb-0"><?=$title;?></h4>
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
								<td><h4>Requesting Department: <?=$reqdept;?></h4></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table id="employee-table" class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th>#</th>
								<th>Request No.</th>
								<th>Date Requested</th>
								<th>Requested By</th>
								<th width="10%">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($requests as $emp){
								echo "<tr>";
								echo "<td>$x.</td>";
								echo "<td>$emp[reqno]</td>";
								echo "<td>$emp[reqdate]</td>";
								echo "<td>$emp[user]</td>";
								?>
								<td>
									<a href="<?=base_url();?>manage_stock_issuance/<?=$reqdept;?>/<?=$emp['reqno'];?>" class="btn btn-info btn-sm text-white" target="_blank"><i class="icofont-gear-alt"></i> Manage</a>
									<a href="<?=base_url();?>stock_request_print/<?=$emp['reqno'];?>" class="btn btn-success btn-sm text-white" target="_blank"><i class="icofont-printer"></i> Print</a>
								</td>
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
