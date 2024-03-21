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
								<td><h4>Posted Transfer List</h4></td>
								<?=form_open(base_url()."search_charge_slip");?>
								<td width="15%">
									<label>Branch</label>
									<select name="branch" class="form-select" required>
										<?php
										foreach($station as $branch){
											echo "<option value='$branch[station]'>$branch[station]</option>";
										}
										?>
									</select>
								</td>
								<td  width="10%">
									<label>Start Date</label>
									<input type="date" name="startdate" class="form-control">
								</td>
								<td  width="10%">
									<label>End Date</label>
									<input type="date" name="enddate" class="form-control">
								</td>
								<td  width="7%" style="vertical-align: bottom;">
									<button type="submit" class="btn btn-primary"><i class="icofont-search"></i> Search</button>
								</td>
								<td  width="7%" style="vertical-align: bottom;">
									<a href="<?=base_url();?>charge_slip" class="btn btn-secondary"><i class="icofont-recycle"></i> Refresh</a>
								</td>
								<?=form_close();?>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table id="employee-table" class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th>#</th>
								<th>Charge Slip No.</th>
								<th>Date</th>
								<th>Charge To</th>
								<th width="10%">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($requests as $emp){
								$transfer=str_replace('TRANSFER TO ','',$emp['trantype']);
								$transfer=str_replace('CHARGE TO ','',$transfer);
								echo "<tr>";
								echo "<td>$x.</td>";
								echo "<td>$emp[invno]</td>";
								echo "<td>".date('m/d/Y',strtotime($emp['datearray']))."</td>";
								echo "<td>$transfer</td>";
								?>
								<td>
									<a href="<?=base_url();?>print_transfer/<?=$emp['invno'];?>" class="btn btn-info btn-sm" target="_blank"><i class="icofont-printer"></i> Print</a>
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
