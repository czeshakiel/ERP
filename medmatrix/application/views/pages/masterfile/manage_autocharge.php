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
			<div class="col-md-8">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<h5>Admission Autocharge Items</h5>
					</div>
					<div class="card-body">
						<table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th width="15%">Code</th>
								<th>Description</th>
								<th width="20%">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$num=1;
							foreach($autocharge as $ua){
								echo "<tr>";
								echo "<td>$ua[code]</td>";
								echo "<td>$ua[itemname]</td>";?>
								<td align='center'><a href="<?=base_url();?>delete_autocharge/<?=$ua['code'];?>" class='btn btn-danger btn-sm text-white' onclick="return confirm('Do you wish to remove this item?');return false;"><i class='icofont-trash'></i> Delete</a></td>
							<?php
								echo "</tr>";
								$num++;
							}
							?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
			<div class="col-md-4">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td width="20%"><h6 class="mb-0 fw-bold ">Select Item</h6></td>
								<td align="right"></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<?=form_open(base_url()."save_autocharge");?>
						<div class="form-group mb-3">
							<label>Items</label>
							<select name="code" class="item form-control" required id="itemcode">
								<option value=""></option>
								<?php
								foreach($items as $stat){
									$exist=$this->Masterfile_model->checkAutocharge($stat['code']);
									if($exist){

									}else {
										echo "<option value='$stat[code]'>$stat[itemname]</option>";
									}
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>SRP</label>
							<span class="badge bg-success" id="srp"></span>
						</div>
						<div class="form-group mb-3">
							<input type="submit" name="submit" class="btn btn-primary" value="Select">
						</div>
						<?=form_close();?>
					</div>
				</div>

			</div>
		</div><!-- Row end  -->

	</div>
</div>
