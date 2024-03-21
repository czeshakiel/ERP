<div class="tab-content">
	<div class="tab-pane fade show active" id="list-view">
		<div class="row clearfix g-3">
			<div class="col-lg-12">
				<div class="card mb-3">
					<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
						<h6 class="mb-0 fw-bold "><?=$title;?></h6>
					</div>
				</div>						
				<div class="row">					
					<div class="col-lg-4">
						<div class="card">
							<div class="card-header">
								<b>Daily PF Collection</b>
							</div>
							<div class="card-body">
								<form action="../cashier/collectionportal.php" target="_blank" method="GET">
								<input type="hidden" name="nursename" value="<?=str_replace('%20',' ',$this->session->fullname);?>">								
									<table width="100%" border="0" cellpadding="4" cellspacing="2">
										<tr>
											<td width="20%">Report Date:</td>
											<td><input type="date" name="startdate" class="form-control" required>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>																				
										<tr>
											<td width="20%">Report Type:</td>
											<td>
												<select name="stat" class="form-select" required>
													<option value="">Select Report Type</option>
													<option value="Professional Fee">Professional Fee</option>
	                                                <option value="Professional Fee Summary">PF Summary</option>
	                                                <option value="APPF">AP PF Summary</option>	                                                
	                                                <option value="PFPHIC">PHIC PF Summary</option>
												</select>
											</td>
										</tr>										
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<td width="20%">&nbsp;</td>
											<td><input type="submit" name="submit" class="btn btn-success text-white" value="Generate"></td>
										</tr>
									</table>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card">
							<div class="card-header">
								<b>Daily PF Collection (per Doctor)</b>
							</div>
							<div class="card-body">
								<form action="../cashier/collectionportal.php" target="_blank" method="GET">
								<input type="hidden" name="nursename" value="<?=str_replace('%20',' ',$this->session->fullname);?>">								
									<table width="100%" border="0" cellpadding="4" cellspacing="2">
										<tr>
											<td width="20%">Report Date:</td>
											<td><input type="date" name="startdate" class="form-control" required>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>																				
										<tr>
											<td width="20%">Doctor:</td>
											<td>
												<select name="ap" class="form-select item" required>
													<option value="">Select Doctor</option>	
													<?php
													foreach($doctors as $doc){
														echo "<option value='$doc[name]'>$doc[lastname], $doc[firstname] $doc[middlename]</option>";
													}
													?>												
												</select>
											</td>
										</tr>										
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<td width="20%">&nbsp;</td>
											<td><input type="submit" name="submit" class="btn btn-success text-white" value="Generate"></td>
										</tr>
									</table>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card">
							<div class="card-header">
								<b>PF EXCESS</b>
							</div>
							<div class="card-body">
								<form method="POST" action="../printreport/pfexcess" target="_blank">
														
									<table width="100%" border="0" cellpadding="4" cellspacing="2">
																														
										<tr>
											<td width="20%">Doctor:</td>
											<td>
												<select name="doc" class="form-select item" required>
													<option value="">Select Doctor</option>	
													<?php
echo"<option value='ALL'>ALL</option>";
													foreach($doctors as $doc){
														echo "<option value='$doc[code]'>$doc[name]</option>";
													}
													?>												
												</select>
											</td>
										</tr>
										<tr>
<td>Date From: </td>
<td style="text-align: left;"><input type="date" name="datef" value="<?php echo date("Y-m-d") ?>" style="width: 100%;"></td>
</tr>
<tr>
<td>Date To: </td>
<td style="text-align: left;"><input type="date" name="datet" value="<?php echo date("Y-m-d") ?>" style="width: 100%;"></td>
</tr>										
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<td width="20%">&nbsp;</td>
											<td><input type="submit" name="submit" class="btn btn-success text-white" value="Generate"></td>
										</tr>
									</table>
								</form>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>					
	</div>
</div>