<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h4 class="fw-bold mb-0"><?=$title;?></h4>
				</div>
			</div>
		</div> <!-- Row end  -->
		<div class="row align-item-center">
			<div class="col-md-4">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h5>Issuance Report</h5></td>
							</tr>
						</table>
					</div>
					<?=form_open(base_url()."issuance_history_report");?>
					<div class="card-body">
						<div class="form-group mb-3">
							<label>Start Date</label>
							<input type="date" name="startdate" class="form-control" required>
						</div>
						<div class="form-group mb-3">
							<label>End Date</label>
							<input type="date" name="enddate" class="form-control" required>
						</div>
						<div class="form-group mb-3">
							<label>Department</label>
							<input type="text" name="department" class="form-control" readonly value="<?=$this->session->dept;?>">
						</div>
						<div class="form-group mb-3">
							<input type="submit" name="submit" class="btn btn-success text-white" value="Generate">
						</div>
					</div>
					<?=form_close();?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h5>Department Issuance Report Charged</h5></td>
							</tr>
						</table>
					</div>
					<?=form_open(base_url()."issuance_history_charge",array('target'=> '_blank'));?>
					<div class="card-body">
						<div class="form-group mb-3">
							<label>Start Date</label>
							<input type="date" name="startdate" class="form-control" required>
						</div>
						<div class="form-group mb-3">
							<label>End Date</label>
							<input type="date" name="enddate" class="form-control" required>
						</div>
						<div class="form-group mb-3">
							<label>Department</label>
							<select name="department" class="form-control item" required>
								<option value="">Select Department</option>
								<?php
								foreach($suppliers as $supplier){
									echo "<option value='$supplier[station]'>$supplier[station]</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<input type="submit" name="submit" class="btn btn-success text-white" value="Generate">
						</div>
					</div>
					<?=form_close();?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h5>Department Issuance Report Expense</h5></td>
							</tr>
						</table>
					</div>
					<?=form_open(base_url()."issuance_history_expense",array('target'=> '_blank'));?>
					<div class="card-body">
						<div class="form-group mb-3">
							<label>Start Date</label>
							<input type="date" name="startdate" class="form-control" required>
						</div>
						<div class="form-group mb-3">
							<label>End Date</label>
							<input type="date" name="enddate" class="form-control" required>
						</div>
						<div class="form-group mb-3">
							<label>Department</label>
							<select name="department" class="form-control item" required>
								<option value="">Select Department</option>
								<?php
								foreach($suppliers as $supplier){
									echo "<option value='$supplier[station]'>$supplier[station]</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<input type="submit" name="submit" class="btn btn-success text-white" value="Generate">
						</div>
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div><!-- Row end  -->
	</div>
</div>
