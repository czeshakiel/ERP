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
								<td><h4>Manual Receiving List<small><a href="#" class="btn btn-success btn-sm text-white" style="float:right; margin-right:10px;" data-bs-toggle="modal" data-bs-target="#NewReceiving"><i class="icofont-plus-circle"></i> New Receiving</a></small></h4></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table id="employee-table" class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th>#</th>
								<th>Supplier</th>
								<th>Invoice No.</th>
								<th>Transaction Date</th>
								<th>Requesting User</th>
								<th width="10%">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($purchases as $emp){
								echo "<tr>";
								echo "<td>$x.</td>";
								echo "<td>$emp[suppliername]</td>";
								echo "<td>$emp[invno]</td>";
								echo "<td>$emp[datearray]</td>";
								echo "<td>$emp[receivinguser]</td>";?>
								<td>
									<?=form_open(base_url()."create_receiving",array('target' => '_blank'));?>
									<input type="hidden" name="invno" value="<?=$emp['invno'];?>">
									<input type="hidden" name="supplier" value="<?=$emp['suppliercode'];?>_<?=$emp['suppliername'];?>">
									<input type="hidden" name="reqdept" value="<?=$emp['dept'];?>">
									<input type="hidden" name="terms" value="<?=$emp['terms'];?>">
									<input type="hidden" name="trantype" value="<?=$emp['trantype'];?>">
									<input type="hidden" name="transdate" value="<?=$emp['transdate'];?>">
									<input type="hidden" name="invdate" value="<?=$emp['datearray'];?>">
									<button type="submit" class="btn btn-info btn-sm text-white"><i class='icofont-gear'></i> Manage</button>
									<?=form_close();?>
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
