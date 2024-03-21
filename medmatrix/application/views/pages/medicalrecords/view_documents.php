
<div class="body d-flex py-lg-3 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h3 class="fw-bold mb-0"><?=$title;?></h3>
				</div>
			</div>
		</div> <!-- Row end  -->
		<?php			
			$check=$this->Records_model->db->query("SELECT * FROM collection WHERE datearray = '$datearray' AND acctno='WPOS-001' AND refno LIKE '%MRD%'");
			if($check->num_rows()>0){
				$r=$check->row_array();
				if($r['type']=="pending"){
					$forward="style='display:none;'";
					$cancel="";
					$cash="";
				}else{
					$forward="style='display:none;'";
					$cancel="style='display:none;'";
					$cash="";
				}
			}else{
				$forward="";
				$cancel="style='display:none;'";
				$cash="style='display:none;'";
			}
			if(count($documents)>0 || count($medicolegal) > 0 || count($others)>0){
				$view="";
			}else{
				$view="style='display:none;'";
			}
		?>
		<div class="row align-item-center">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h6 class="mb-0 fw-bold ">List of Documents</h6></td>
								<?=form_open(base_url()."view_documents");?>
								<input type="hidden" name="startdate" value="<?=$datearray;?>">
								<td align="right" width="50%">
									<button type="submit" name="forward" class="btn btn-primary btn-sm" <?=$forward;?> <?=$view;?> onclick="return confirm('Do you wish to forward records income to cashier?'); return false;"><i class="icofont-logout"></i> Forward to Cashier</button>
									<?=form_close();?>
									<?=form_open(base_url()."view_documents");?>
									<input type="hidden" name="startdate" value="<?=$datearray;?>">
										<button type="submit" name="cancel" class="btn btn-danger btn-sm text-white" <?=$cancel;?> <?=$view;?> onclick="return confirm('Do you wish to cancel records income?'); return false;"><i class="icofont-stop"></i> Cancel Forward</button>
									<?=form_close();?>
								</td>
								<td align="right" width="15%">
									<a href="<?=base_url();?>print_certificate_forward/<?=$datearray;?>/CASH" target="_blank" class="btn btn-info btn-sm text-white" <?=$view;?><?=$cash;?>><i class="icofont-print"></i> Print Cash</a>
									<a href="<?=base_url();?>print_certificate_forward/<?=$datearray;?>/CHARGED" target="_blank" class="btn btn-warning btn-sm text-white" <?=$view;?>><i class="icofont-print"></i> Print Charge</a>
								</td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table class="table table-hover align-middle mb-0 table-bordered" style="width: 100%;">
							<thead>
							<tr>
								<th width="1%">No.</th>
								<th>Document Type</th>
								<th>Issued to</th>
								<th>Issued by</th>
								<th>Amount</th>
								<th>Charged to/Ref No.</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							$totalamount=0;
							$totalamountlegal=0;
							$totalamountother=0;
							foreach($documents as $item){
								if($item['is_employee'] <> ""){
									$unitcost=0;
								}else{
									$unitcost=$item['unitcost'];
								}
								echo "<tr>";
									echo "<td>$x.</td>";
									echo "<td>$item[type]</td>";
									echo "<td>$item[lastname], $item[firstname] $item[middlename] $item[suffix]</td>";
									echo "<td>$item[user]</td>";
									echo "<td align='right'>".number_format($unitcost,2)."</td>";
									echo "<td>$item[is_employee]</td>";
								echo "</tr>";
								$x++;
								$totalamount +=$unitcost;
							}
							foreach($medicolegal as $item){
								if($item['is_employee'] <> ""){
									$unitcost=0;
								}else{
									$unitcost=$item['unitcost'];
								}
								echo "<tr>";
									echo "<td>$x.</td>";
									echo "<td>Medico Legal</td>";
									echo "<td>$item[lastname], $item[firstname] $item[middlename] $item[suffix]</td>";
									echo "<td>$item[user]</td>";
									echo "<td align='right'>".number_format($unitcost,2)."</td>";
									echo "<td>$item[is_employee]</td>";
								echo "</tr>";
								$x++;
								$totalamountlegal +=$unitcost;
							}
							foreach($others as $item){
									$unitcost=$item['unitcost'];
								echo "<tr>";
									echo "<td>$x.</td>";
									echo "<td>$item[description] ($item[type])</td>";
									echo "<td>$item[lastname], $item[firstname] $item[middlename] $item[suffix]</td>";
									echo "<td>$item[user]</td>";
									echo "<td align='right'>".number_format($unitcost,2)."</td>";
									echo "<td>$item[refno]</td>";
								echo "</tr>";
								$x++;
								$totalamountother +=$unitcost;
							}
							?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="4" align="right"><b>TOTAL</b></td>
									<td align="right"><?=number_format($totalamount+$totalamountlegal+$totalamountother,2);?></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>

			</div>
		</div><!-- Row end  -->

	</div>
</div>
