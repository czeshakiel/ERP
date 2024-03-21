<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row clearfix g-3">
			<div class="col-xl-12 col-lg-12 col-md-12 flex-column">
				<div class="row g-3">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
								<h6 class="mb-0 fw-bold "><?=$title;?></h6>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<?=form_open(base_url()."search_patient_refund");?>
								<table width="100%" border="0">
									<tr>
										<td width="10%">Search Patient:</td>
										<td width="30%"><input type="text" name="description" class="form-control" placeholder="Type patient name here.."></td>
										<td><input type="submit" name="search" class="btn btn-success" value="Search"></td>
									</tr>
								</table>
								<?=form_close();?>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-12">									
										<?php										
										if($search_result){
											echo "<table class='table table-bordered'>";
												echo "<tr>";
													echo "<td align='center'>Caseno</td>";
													echo "<td align='center'>Patient Name</td>";									
													echo "<td align='center'>Date Admitted</td>";
													echo "<td align='center'>Action</td>";
												echo "</tr>";
											foreach ($search_result as $item) {
												echo "<tr>";
													echo "<td>$item[caseno]</td>";
													echo "<td>$item[lastname], $item[firstname] $item[middlename] $item[suffix]</td>";
													echo "<td align='center'>$item[dateadmit]</td>";
													echo "<td align='center'><a href='".base_url()."manage_refund/$item[caseno]' class='btn btn-primary btn-sm'>Manage</a></td>";
												echo"</tr>";
											}
											echo "</table>";
										}
										?>									
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
