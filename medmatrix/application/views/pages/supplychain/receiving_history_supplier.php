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
						<table border="0" width="100%">
							<tr>
								<td><h4>Supplier: <?=$suppliername;?></h4></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table id="employee-table" class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th>#</th>
								<th>Due Date</th>
								<th>Ref No.</th>
								<th>Trantype</th>
								<th>Invoice No.</th>
								<th>P.O. No.</th>
								<th>RR Date</th>
								<th>Total Amount</th>
								<th width="10%">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$totalamount=0;
							$x=1;
							foreach($purchases as $emp){
								$total=0;
								$items=$this->Purchase_model->db->query("SELECT * FROM stocktablepayables WHERE rrno='$emp[rrno]'");
								foreach($items->result_array() as $item){
									if($item['prodtype1'] > 0){
										$total +=$item['quantity'] * $item['prodtype1'];
									}else{
										$total +=$item['quantity'] * $item['unitcost'];
									}
								}								
								echo "<tr>";
								echo "<td>$x.</td>";
								echo "<td>$emp[duedate]</td>";
								echo "<td>$emp[rrno]</td>";
								echo "<td>$emp[trantype]</td>";
								echo "<td><a href='#' class='editInvoice' data-bs-toggle='modal' data-bs-target='#EditInvoice' data-id='".$emp['rrno']."_".$emp['invno']."'>$emp[invno]</a></td>";
								echo "<td>$emp[po]</td>";
								echo "<td>$emp[datearray]</td>";
								echo "<td align='right'>".number_format($total,2)."</td>";
								?>
								<td>
									<a href="<?=base_url();?>rr_print/<?=$emp['invno'];?>/<?=$emp['rrno'];?>" class="btn btn-info btn-sm text-white" target="_blank"><i class="icofont-printer"></i> Print</a>
								</td>
								<?php
								echo "</tr>";
								$x++;
								$totalamount +=$total;
							}
							?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="7"><b>Total Amount</b></td>
									<td align="right"><?=number_format($totalamount,2);?></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>

			</div>
		</div><!-- Row end  -->
	</div>
</div>
