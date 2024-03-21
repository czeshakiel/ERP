		<div class="modal fade" id="exampleModalSm" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Oh, No!!</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<h4>Do you wish to logout?</h4>
					</div>
					<div class="modal-footer">
						&nbsp;<button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal" aria-label="Close">No, I will stay.</button> <a href="<?=base_url();?>logout" class="btn btn-success text-white">Yes, I will go.</a>
					</div>
				</div>
			</div>
		</div>

		

		<div class="modal fade" id="newrequest" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Stock Request</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."stock_request_new");?>
					<input type="hidden" name="requestingdept" value="<?=$dept;?>">
					<input type="hidden" name="requestinguser" value="<?=$this->session->fullname;?>">
					<input type="hidden" name="requestingdate" value="<?=date('Y-m-d');?>">
					<input type="hidden" name="reqno" value="<?=$dept."-".date('YmdHis');?>">
					<div class="modal-body">
						<div class="form-group">
							<label>Charge To</label>
							<select name="requesteddept" class="form-select" required>
								<option value=""></option>								
								<?php
								foreach($station as $stat){
									if($stat['station']=="CPU" || $stat['station']=="CSR" || $stat['station']=="csr2" || $stat['station']=="PHARMACY" || $stat['station']=="CPU-RDU"){
										echo "<option value='$stat[station]'>$stat[station]</option>";
									}									
								}
								?>
							</select>
						</div>
						<?php
						if($dept=="RDU"){
						?>
						<div class="form-group">
										<label for="deptwophone" class="form-label">Requesting Department</label>
											<select name="requestingdept" class="form-select" required>
												<option value="<?=$dept;?>"><?=$dept;?></option>
												<option value="RDU NURSING">RDU NURSING</option>
												<option value="RDU ADMIN">RDU ADMIN</option>
											</select>
										</div>
										<?php
									}
									?>
						<div class="form-group">
										<label for="deptwophone" class="form-label">Type</label>
											<select name="type" class="form-select" required>
												<?php												
												if($dept=="PHARMACY" || $dept=="PHARMACY_OPD" || $dept=="csr2" || $dept=="OR" || $dept=="RDU"){
												?>
													<option value="charge">Charge (for patient use)</option>
												<?php
												}
												?>
												<option value="EXPENSE">Expense (for employee use)</option>
											</select>
										</div>				
					</div>						
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>		

		<div class="modal fade" id="EmployeeProfile" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<?=form_open(base_url()."save_employee");?>
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Employee Pofile</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row g-3 align-items-center">
							<input type="hidden" name="empid" id="emp_id">
							<div class="form-group mb-3 col-md-4">
								<label class="mb-2">Last Name</label>
								<input type="text" name="lastname" class="form-control" id="emp_lastname">
							</div>
							<div class="form-group mb-3 col-md-4">
								<label class="mb-2">First Name</label>
								<input type="text" name="firstname" class="form-control" id="emp_firstname">
							</div>
							<div class="form-group mb-3 col-md-4">
								<label class="mb-2">Middle Name</label>
								<input type="text" name="middlename" class="form-control" id="emp_middlename">
							</div>
							<div class="form-group mb-3 col-md-4">
								<label class="mb-2">Date of Birth</label>
								<input type="date" name="birthdate" class="form-control" id="emp_birthdate">
							</div>
							<div class="form-group mb-3 col-md-4">
								<label class="mb-2">Gender</label>
								<select name="gender" class="form-select" id="emp_gender">
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
							<div class="form-group mb-3">
								<label class="mb-2">Address</label>
								<textarea name="address" class="form-control" rows="3" id="emp_address"></textarea>
							</div>
							<div class="form-group mb-3 col-md-6">
								<label class="mb-2">Position</label>
								<input type="text" name="designation" class="form-control" id="emp_position">
							</div>
							<div class="form-group mb-3 col-md-6">
								<label class="mb-2">Salary</label>
								<input type="text" name="salary" class="form-control" id="emp_salary">
							</div>
							<div class="form-group mb-3 col-md-3">
								<label class="mb-2">SSS</label>
								<input type="text" name="sss" class="form-control" id="emp_sss">
							</div>
							<div class="form-group mb-3 col-md-3">
								<label class="mb-2">TIN</label>
								<input type="text" name="tin" class="form-control" id="emp_tin">
							</div>
							<div class="form-group mb-3 col-md-3">
								<label class="mb-2">PhilHealth</label>
								<input type="text" name="phic" class="form-control" id="emp_phic">
							</div>
							<div class="form-group mb-3 col-md-3">
								<label class="mb-2">Pag-ibig</label>
								<input type="text" name="hdmf" class="form-control" id="emp_hdmf">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Save" onclick="return confirm('Do you wish to save employee details?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal_edit_account" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">User Account</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."update_user_account");?>
					<div class="modal-body">
						<input type="hidden" name="empid" id="user_id">
						<div class="form-group mb-3">
							<label>Username</label>
							<input type="text" name="username" class="form-control" id="username">
						</div>
						<div class="form-group mb-3">
							<label>Password</label>
							<input type="password" name="password" class="form-control" id="password">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal_doctor_account" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Doctor Account</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."update_doctor_account");?>
					<div class="modal-body">
						<input type="hidden" name="empid" id="doctor_id">
						<div class="form-group mb-3">
							<label>Username</label>
							<input type="text" name="username" class="form-control" id="doc_user">
						</div>
						<div class="form-group mb-3">
							<label>Password</label>
							<input type="password" name="password" class="form-control" id="doc_pass">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal_edit_access" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Station Access</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."update_user_access");?>
					<div class="modal-body">
						<input type="hidden" name="empid" id="userid">
						<input type="hidden" name="autono" id="autono">
						<div class="form-group mb-3">
							<label>Access</label>
							<input type="text" name="access" class="form-control" id="access">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal_doctor_access" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Station Access</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."update_doctor_access");?>
					<div class="modal-body">
						<input type="hidden" name="empid" id="docid">
						<input type="hidden" name="autono" id="docautono">
						<div class="form-group mb-3">
							<label>Access</label>
							<input type="text" name="access" class="form-control" id="doc_access">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal_add_doctor" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<?=form_open(base_url()."save_doctor");?>
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Doctor Pofile</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row g-3 align-items-center">
							<input type="hidden" name="code" id="doc_id">
							<div class="form-group mb-3 col-md-3">
								<label class="mb-2">Last Name</label>
								<input type="text" name="lastname" class="form-control" id="doc_lastname">
							</div>
							<div class="form-group mb-3 col-md-3">
								<label class="mb-2">First Name</label>
								<input type="text" name="firstname" class="form-control" id="doc_firstname">
							</div>
							<div class="form-group mb-3 col-md-3">
								<label class="mb-2">Middle Name</label>
								<input type="text" name="middlename" class="form-control" id="doc_middlename">
							</div>
							<div class="form-group mb-3 col-md-3">
								<label class="mb-2">Suffix</label>
								<input type="text" name="suffix" class="form-control" id="doc_suffix">
							</div>
							<div class="form-group mb-3 col-md-3">
								<label class="mb-2">Specialization</label>
								<select name="specialization" class="form-select" required id="doc_specialization">
									<?php
									foreach($specializations as $sp){
										echo "<option value='$sp[specialization]'>$sp[specialization]</option>";
									}
									?>
								</select>
							</div>
							<div class="form-group mb-3 col-md-3">
								<label class="mb-2">PHIC Accrediation No.</label>
								<input type="text" name="phicacc" class="form-control" id="doc_phicacc">
							</div>
							<div class="form-group mb-3 col-md-2">
								<label class="mb-2">TIN</label>
								<input type="text" name="tin" class="form-control" id="doc_tin">
							</div>
							<div class="form-group mb-3 col-md-2">
								<label class="mb-2">PF</label>
								<input type="text" name="pf" class="form-control" id="doc_pf">
							</div>
							<div class="form-group mb-3 col-md-2">
								<label class="mb-2">Rebates</label>
								<input type="text" name="rebates" class="form-control" id="doc_rebates">
							</div>
							<div class="form-group mb-3 col-md-3">
								<label class="mb-2">Email</label>
								<input type="text" name="email" class="form-control" id="doc_email">
							</div>
							<div class="form-group mb-3 col-md-3">
								<label class="mb-2">License No.</label>
								<input type="text" name="licenseno" class="form-control" id="doc_licenseno">
							</div>
							<div class="form-group mb-3 col-md-3">
								<label class="mb-2">PTR No.</label>
								<input type="text" name="ptrno" class="form-control" id="doc_ptrno">
							</div>
							<div class="form-group mb-3 col-md-3">
								<label class="mb-2">S2 No.</label>
								<input type="text" name="s2no" class="form-control" id="doc_s2no">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Save" onclick="return confirm('Do you wish to save employee details?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="addRoom" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Bed Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_room");?>
					<div class="modal-body">
						<input type="hidden" name="station" id="station_id">
						<input type="hidden" name="autono" id="room_id">
						<div class="form-group mb-3">
							<label>Description</label>
							<input type="text" name="room" class="form-control" id="room_desc">
						</div>
						<div class="form-group mb-3">
							<label>Room Rate</label>
							<input type="text" name="roomrates" class="form-control" id="room_rates">
						</div>
						<div class="form-group mb-3">
							<label>Room Type</label>
							<select name="roomprop" class="form-select" id="room_type">
								<option value="">N/A</option>
								<option value="PRIVATE">PRIVATE</option>
								<option value="SEMI-PRIVATE">SEMI-PRIVATE</option>
								<option value="WARD">WARD</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Credit Limit</label>
							<input type="text" name="credit" class="form-control" id="room_credit">
						</div>
						<div class="form-group mb-3">
							<label>Room Kit</label>
							<input type="text" name="roomkit" class="form-control" id="room_kit">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ManageCompany" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Company Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_hmo");?>
					<div class="modal-body">
						<input type="hidden" name="hmo_id" id="hmo_id">
						<div class="form-group mb-3">
							<label>Company Name</label>
							<input type="text" name="company" class="form-control" required id="hmoname">
						</div>
						<div class="form-group mb-3">
							<label>Address</label>
							<textarea name="address" class="form-control" rows="3" id="hmoaddress"></textarea>
						</div>
						<div class="form-group mb-3">
							<label>Type</label>
							<select name="hmotype" class="form-control" id="hmotype">
								<option value="">N/A</option>
								<option value="company">Company</option>
								<option value="hmo">HMO</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ManageDiagnostics" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Diagnostic Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_diagnostics");?>
					<div class="modal-body">
						<input type="hidden" name="code" id="diag_id">
						<div class="form-group mb-3">
							<label>Description</label>
							<input type="text" name="description" class="form-control" id="diag_desc">
						</div>
						<div class="form-group mb-3">
							<label>Unit</label>
							<select name="unit" class="form-select" id="diag_unit">
								<?php
								foreach($unit as $u){
									echo "<option value='$u[unit]'>$u[unit]</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Type</label>
							<select name="ptype" class="form-select" id="diag_type">
								<?php
								foreach($types AS $u){
									echo "<option value='$u[lotno]'>$u[lotno]</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>PNDF</label>
							<select name="pndf" class="form-select" id="diag_pndf">
								<option value="pndf">Yes</option>
								<option value="npndf">No</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Cash Price</label>
							<input type="text" name="cash" class="form-control" id="diag_cash">
						</div>
						<div class="form-group mb-3">
							<label>Charge Price</label>
							<input type="text" name="charge" class="form-control" id="diag_charge">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ManageOthers" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Other Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_others");?>
					<div class="modal-body">
						<input type="hidden" name="code" id="other_id">
						<div class="form-group mb-3">
							<label>Description</label>
							<input type="text" name="description" class="form-control" id="other_desc">
						</div>
						<div class="form-group mb-3">
							<label>Unit</label>
							<select name="unit" class="form-select" id="other_unit">
								<?php
								foreach($unit as $u){
									echo "<option value='$u[unit]'>$u[unit]</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Type</label>
							<select name="ptype" class="form-select" id="other_type">
								<?php
								foreach($types AS $u){
									echo "<option value='$u[lotno]'>$u[lotno]</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>PNDF</label>
							<select name="pndf" class="form-select" id="other_pndf">
								<option value="pndf">Yes</option>
								<option value="npndf">No</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Cash Price</label>
							<input type="text" name="cash" class="form-control" id="other_cash">
						</div>
						<div class="form-group mb-3">
							<label>Charge Price</label>
							<input type="text" name="charge" class="form-control" id="other_charge">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ManageProvince" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Province</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_address");?>
					<div class="modal-body">
						<input type="hidden" name="id" id="prov_id">
						<div class="form-group mb-3">
							<label>Province</label>
							<input type="text" name="description" class="form-control" id="prov_desc">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ManageCity" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">City/Municipality</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_city");?>
					<div class="modal-body">
						<input type="hidden" name="prov_id" id="prov_id_city">
						<input type="hidden" name="id" id="city_id">
						<div class="form-group mb-3">
							<label>City/Municipality</label>
							<input type="text" name="description" class="form-control" id="city_desc">
						</div>
						<div class="form-group mb-3">
							<label>ZipCode</label>
							<input type="text" name="zipcode" class="form-control" id="city_zipcode">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ManageBarangay" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Barangay</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_barangay");?>
					<div class="modal-body">
						<input type="hidden" name="prov_id" id="prov_id_barangay">
						<input type="hidden" name="city_id" id="city_id_barangay">
						<input type="hidden" name="id" id="barangay_id">
						<div class="form-group mb-3">
							<label>Barangay</label>
							<input type="text" name="description" class="form-control" id="barangay_desc">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ManageReligion" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Religion</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_religion");?>
					<div class="modal-body">
						<input type="hidden" name="id" id="rel_id">
						<div class="form-group mb-3">
							<label>Description</label>
							<input type="text" name="description" class="form-control" id="rel_desc">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ManageStation" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Station</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_station");?>
					<div class="modal-body">
						<input type="hidden" name="id" id="stat_id">
						<div class="form-group mb-3">
							<label>Description</label>
							<input type="text" name="description" class="form-control" id="stat_desc">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ManageNationality" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Nationality</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_nationality");?>
					<div class="modal-body">
						<input type="hidden" name="id" id="nat_id">
						<div class="form-group mb-3">
							<label>Description</label>
							<input type="text" name="description" class="form-control" id="nat_desc">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ManageAccountTitle" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Account Title</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_accounttitle");?>
					<div class="modal-body">
						<input type="hidden" name="id" id="acct_id">
						<div class="form-group mb-3">
							<label>Description</label>
							<input type="text" name="description" class="form-control" id="acct_desc">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>		