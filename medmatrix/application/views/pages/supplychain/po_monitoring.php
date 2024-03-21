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
								<td><h4>Purchase Order List<small><a href="#" class="btn btn-success btn-sm text-white" style="float:right; margin-right:10px;" data-bs-toggle="modal" data-bs-target="#NewRequest"><i class="icofont-plus-circle"></i> New Request</a></small></h4></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table id="employee-table" class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th>Items</th>
								<th>Supplier</th>
								<th>P.O. No.</th>
								<th>P.O. Date</th>
								<th>Requesting User</th>
								<th width="10%">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($purchases as $emp){
								$items=$this->Purchase_model->getItemsPOMonitoring($emp['po']);
								if(count($items)>0){
								echo "<tr>";
								echo "<td width='30%'>";								
								foreach($items as $item){									
									$description=$item['itemname'];
									echo $description."<br>";
								}
								echo "</td>";
								echo "<td>$emp[supplier]</td>";
								echo "<td>$emp[po]</td>";
								echo "<td>$emp[reqdate]</td>";
								echo "<td>$emp[user]</td>";?>
								<td><a href="<?=base_url();?>po_print_monitoring/<?=$emp['po'];?>" class="btn btn-info btn-sm text-white" target="_blank"><i class="icofont-print"></i> Print</a></td>
								<?php
								echo "</tr>";
								$x++;
							}
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
