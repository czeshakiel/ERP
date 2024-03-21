<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h5 class="fw-bold mb-0"><?=$title;?></h5>
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
						<table class="table table-bordered">
							<tr>
								<td><h6>Date Range: <?=date('M-d-Y',strtotime($startdate));?> to <?=date('M-d-Y',strtotime($enddate));?></h6></td>
							</tr>
							<tr>
								<td><h6>Department: <?=$department;?></h6></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table id="employee-table" class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th>#</th>
								<th>Issuance ID</th>
								<th>Supplier</th>
								<th>Charge To</th>
								<th>Requesting User</th>
								<th>Issuing User</th>
								<th>Transdate</th>
								<th>Status</th>
								<th width="10%">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($purchases as $emp){
								echo "<tr>";
								echo "<td>$x.</td>";
								echo "<td>$emp[isid]</td>";
								echo "<td>$department</td>";
								echo "<td>$emp[reqdept]</td>";
								echo "<td>$emp[user]</td>";
								echo "<td>$emp[receivinguser]</td>";
								echo "<td>$emp[datearray]</td>";
								echo "<td>$emp[status]</td>";
								?>
								<td>
									<a href="<?=base_url();?>print_stock_issuance_detailed/<?=$emp['isid'];?>/<?=$department;?>/<?=$startdate;?>/<?=$enddate;?>" class="btn btn-success btn-sm text-white" target="_blank"><i class="icofont-printer"></i> View</a>
									<a href="<?=base_url();?>print_stock_issuance/<?=$emp['isid'];?>" class="btn btn-info btn-sm text-white" target="_blank"><i class="icofont-printer"></i> Copy</a>
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
