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
			<!--div class="col-md-4">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h5>Daily Discharged Report</h5></td>
							</tr>
						</table>
					</div>
					<?=form_open(base_url()."print_daily_discharged_report",array("target" => "_blank"));?>
					<div class="card-body">												
						<div class="form-group mb-3">
							<label>Run Date</label>
							<input type="date" name="rundate" class="form-control" required>
						</div>
						<div class="form-group mb-3">
							<label>Type</label>
							<select name="type" class="form-control" required>
								<option value="WCOH">WITH COH</option>
								<option value="NCOH">WITHOUT COH</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Department</label>
							<select name="department" class="form-control" required>
								<option value="I-">Inpatient</option>
								<option value="O-">Outpatient</option>
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
								<td><h5>Daily Discharged Summary</h5></td>
							</tr>
						</table>
					</div>
					<form action="../billing/dailydischargedsummaryportal.php" target="_blank" method="GET">
					<div class="card-body">
						<div class="form-group mb-3">
							<label>Run Date</label>
							<input type="date" name="startdate" class="form-control" required>
						</div>
						<div class="form-group mb-3">
							<label>Type</label>
							<select name="type" class="form-control" required>
								<option value="DEBIT">WITH COH</option>
								<option value="CREDIT">WITHOUT COH</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Department</label>
							<select name="department" class="form-control" required>
								<option value="I-">Inpatient</option>
								<option value="O-">Outpatient</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<input type="submit" name="submit" class="btn btn-success text-white" value="Generate">
						</div>
					</div>
					</form>
				</div>
			</div-->
			<div class="col-md-4">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h5>Daily Discharged Report</h5></td>
							</tr>
						</table>
					</div>
					<?=form_open(base_url()."print_daily_discharged_report_beta",array("target" => "_blank"));?>
					<div class="card-body">												
						<div class="form-group mb-3">
							<label>Run Date</label>
							<input type="date" name="rundate" class="form-control" required>
						</div>
						<div class="form-group mb-3">
							<label>Type</label>
							<select name="type" class="form-control" required>
								<option value="WCOH">WITH COH</option>
								<option value="NCOH">WITHOUT COH</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Department</label>
							<select name="department" class="form-control" required>
								<option value="I-">Inpatient</option>
								<option value="O-">Outpatient</option>
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
								<td><h5>Daily Discharged Summary</h5></td>
							</tr>
						</table>
					</div>
					<form action="../billing/dailydischargedsummaryportalbeta.php" target="_blank" method="GET">
					<div class="card-body">
						<div class="form-group mb-3">
							<label>Run Date</label>
							<input type="date" name="startdate" class="form-control" required>
						</div>
						<div class="form-group mb-3">
							<label>Type</label>
							<select name="type" class="form-control" required>
								<option value="DEBIT">WITH COH</option>
								<option value="CREDIT">WITHOUT COH</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Department</label>
							<select name="department" class="form-control" required>
								<option value="I-">Inpatient</option>
								<option value="O-">Outpatient</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<input type="submit" name="submit" class="btn btn-success text-white" value="Generate">
						</div>
					</div>
					</form>
				</div>
			</div>
			<!-- <div class="col-md-4">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h5>Daily Discharged Report Aplha</h5></td>
							</tr>
						</table>
					</div>
					<?=form_open(base_url()."print_daily_discharged_report_alpha",array("target" => "_blank"));?>
					<div class="card-body">												
						<div class="form-group mb-3">
							<label>Run Date</label>
							<input type="date" name="rundate" class="form-control" required>
						</div>
						<div class="form-group mb-3">
							<label>Type</label>
							<select name="type" class="form-control" required>
								<option value="WCOH">WITH COH</option>
								<option value="NCOH">WITHOUT COH</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Department</label>
							<select name="department" class="form-control" required>
								<option value="I-">Inpatient</option>
								<option value="O-">Outpatient</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<input type="submit" name="submit" class="btn btn-success text-white" value="Generate">
						</div>
					</div>
					<?=form_close();?>
				</div>
			</div> -->
		</div><!-- Row end  -->
	</div>
</div>
