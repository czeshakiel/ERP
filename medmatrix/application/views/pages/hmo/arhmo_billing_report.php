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
								<td><h5>DAILY AR ADMISSION (EXPORT TO EXCEL)</h5></td>
							</tr>
						</table>
					</div>
					<?=form_open(base_url()."daily_admission_ar_hmo_billing_excel",array("target" => "_blank"));?>
					<div class="card-body">												
						<div class="form-group mb-3">
							<label>Run Date</label>
							<input type="date" name="rundate" class="form-control" required>
						</div>						
						<div class="form-group mb-3">
							<input type="submit" name="submit" class="btn btn-success text-white" value="Generate">
						</div>
					</div>
					<?=form_close();?>
				</div>
			</div>
			<!-- <div class="col-md-4">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h5>DAILY AR ADMISSION SUMMARY</h5></td>
							</tr>
						</table>
					</div>
					<?=form_open(base_url()."daily_admission_ar_hmo_billing_summary",array('target'=> '_blank'));?>
					<div class="card-body">
						<div class="form-group mb-3">
							<label>Run Date</label>
							<input type="date" name="rundate" class="form-control" required>
						</div>
						<div class="form-group mb-3">
							<input type="submit" name="submit" class="btn btn-success text-white" value="Generate">
						</div>
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div> -->
		<!-- Row end  -->
	</div>
</div>
