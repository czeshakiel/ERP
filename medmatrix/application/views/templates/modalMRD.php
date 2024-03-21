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




		<div class="modal fade" id="EditAttending" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."update_attending_doctor");?>
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Update Doctor</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="caseno" id="admit_caseno">
						<div class="form-group mb-3">
							<label>Attending Doctor</label>
							<select name="ap" class="form-select" required id="admit_attending">
								<?php
								$attending = $this->General_model->getAttendingDoctor();
								foreach($attending as $ap){
									echo "<option value='$ap[code]'>$ap[lastname], $ap[firstname]</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Admitting Doctor</label>
							<select name="ad" class="form-select" required id="admit_admitting_doctor">
								<?php
								$admitting = $this->General_model->getAdmittingDoctor();
								foreach($admitting as $ap){
									echo "<option value='$ap[code]'>$ap[lastname], $ap[firstname]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Update" onclick="return confirm('Do you wish to update attending and admitting doctor?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>


		<div class="modal fade" id="EditARAttending" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."update_ar_attending_doctor");?>
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Update Doctor</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="caseno" id="admit_caseno">
						<div class="form-group mb-3">
							<label>Attending Doctor</label>
							<select name="ap" class="form-select" required id="admit_ar_attending">
								<?php
								foreach($attending as $ap){
									echo "<option value='$ap[code]'>$ap[lastname], $ap[firstname]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Update" onclick="return confirm('Do you wish to update attending doctor?');return false;">
					</div>
					<?=form_close();?>
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

		<div class="modal fade" id="generateDailyAdmission" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Daily Admission</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."daily_admission",array("target" => "_blank"));?>
					<div class="modal-body">
						<div class="form-group">
							<label>Select Date</label>
							<input type="date" name="rundate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="generateDailyDischarged" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Daily Discharged</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."daily_discharged",array("target" => "_blank"));?>
					<div class="modal-body">
						<div class="form-group">
							<label>Select Date</label>
							<input type="date" name="rundate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="EditPatientProfile" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."updatepatientprofile");?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Patient Profile</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="patientidno" id="editpatientidno">
						<input type="hidden" name="caseno" id="editcaseno">
						<div class="form-group">
							<label>Last Name</label>
							<input type="text" name="lastname" class="form-control" id="plastname">
						</div>
						<div class="form-group">
							<label>First Name</label>
							<input type="text" name="firstname" class="form-control" id="pfirstname">
						</div>
						<div class="form-group">
							<label>Middle Name</label>
							<input type="text" name="middlename" class="form-control" id="pmiddlename">
						</div>
						<div class="form-group">
							<label>Suffix</label>
							<input type="text" name="suffix" class="form-control" id="psuffix">
						</div>
						<div class="form-group">
							<label>Contact No.</label>
							<input type="text" name="contactno" class="form-control" id="pcontactno">
						</div>
						<div class="form-group">
							<label>Birth Date</label>
							<input type="date" name="birthdate" class="form-control" id="pbirthdate">
						</div>
						<div class="form-group">
							<label>Gender</label>
							<select name="gender" class="form-select" id="pgender">
								<option value="M">Male</option>
								<option value="F">Female</option>
							</select>
						</div>
						<div class="form-group">
							<label>Discount Type</label>
							<select name="discounttype" class="form-select" id="pdiscounttype">
								<option value="NONE">NONE</option>
								<option value="SENIOR">SENIOR</option>
								<option value="PWD">PWD</option>
							</select>
						</div>
						<div class="form-group">
							<label>Discount ID</label>
							<input type="text" name="discountid" class="form-control" id="pdiscountid">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success" value="Update" onclick="return confirm('Do you wish to submit details?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="EditAddress" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."updatepatientaddress");?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Patient Address</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="patientidno" id="updatepatientidno">
						<input type="hidden" name="caseno" id="updatecaseno">
						<div class="form-group mb-2">
							<label class="mb-2">Province</label>
							<select name="province" class="form-select" id="province" required>
								<?php
								foreach($province as $prov){
									echo "<option value='$prov[id]'>$prov[statename]</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mb-2">
							<label class="mb-2">City/Municipality</label>
							<select name="city" class="form-select" id="city" required>
							</select>
						</div>
						<div class="form-group mb-2">
							<label class="mb-2">Barangay</label>
							<select name="barangay" class="form-select" id="barangay" required>
							</select>
						</div>
						<div class="form-group mb-2">
							<label class="mb-2">Street</label>
							<input type="text" name="street" class="form-control" id="street" required>
						</div>
						<div class="form-group mb-2">
							<label class="mb-2">Zip Code</label>
							<input type="text" name="zipcode" class="form-control" id="zipcode" readonly>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success" value="Update" onclick="return confirm('Do you wish to submit details?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ReOpen" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."reopen");?>
					<input type="hidden" name="patientidno" id="open_patientidno">
					<input type="hidden" name="caseno" id="open_caseno">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Re-Open Admission</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Enter Password to Activate</label>
							<input type="password" class="form-control" name="password" required>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit" value="Re-Open">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="DischargePatient" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."discharge_patient");?>
					<input type="hidden" name="patientidno" id="disc_patientidno">
					<input type="hidden" name="caseno" id="disc_caseno">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Discharge Patient</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Discharged Date</label>
							<input type="date" class="form-control" name="datedischarged" required>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Discharged Time</label>
							<input type="time" class="form-control" name="timedischarged" required>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit" value="Discharge Patient" onclick="return confirm('Do you wish to discharged patient?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="EditAdmissionTime" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<?=form_open(base_url()."update_admission_details");?>
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Update Admission Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="caseno" id="admit_caseno">
						<input type="hidden" name="patientidno" id="admit_patientidno">
						<div class="form-group mb-3">
							<label class="mb-2">Admission Date</label>
							<input type="date" name="admissiondate" class="form-control" id="admit_date">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Admission Time</label>
							<input type="time" name="admissiontime" class="form-control" id="admit_time">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Person In case of emergency</label>
							<input type="text" name="contactperson" class="form-control" id="contactperson">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Contact No. of Person</label>
							<input type="text" name="contactpersonno" class="form-control" id="contactpersonno">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Relationship to contact person</label>
							<input type="text" name="contactpersonrelation" class="form-control" id="contactpersonrelation">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Name of Father</label>
							<input type="text" name="father" class="form-control" id="father">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Name of Mother</label>
							<input type="text" name="mother" class="form-control" id="mother">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Civil Status</label>
							<select name="civilstatus" class="form-select" id="civilstatus">
								<option value="New Born">New Born</option>
								<option value="Child">Child</option>
								<option value="Single">Single</option>
								<option value="Married">Married</option>
								<option value="Separated">Separated</option>
								<option value="Widowed">Widowed</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Religion</label>
							<select name="religion" class="form-select" id="religion">
								<?php

								foreach($religion as $rel){
									echo "<option value='$rel[description]'>$rel[description]</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Civil Status</label>
							<select name="nationality" class="form-select" id="nationality">
								<?php

								foreach($nationality as $rel){
									echo "<option value='$rel[description]'>$rel[description]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Update" onclick="return confirm('Do you wish to update admission time?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="DischargedDateTime" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."update_discharged_date_time");?>
					<input type="hidden" name="patientidno" id="d_patientidno">
					<input type="hidden" name="caseno" id="d_caseno">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Discharged Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Date Discharged</label>
							<input type="date" name="dischargeddate" class="form-control" id="d_date">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Time Discharged</label>
							<input type="time" name="dischargedtime" class="form-control" id="d_time">
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit" value="Update" onclick="return confirm('Do you wish to submit update?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="AddDiagnosis" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Add Diagnosis</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_diagnosis");?>
					<input type="hidden" name="patientidno" id="ad_patientidno">
					<input type="hidden" name="caseno" id="ad_caseno">
					<input type="hidden" name="code" id="ad_code">
					<input type="hidden" name="type" id="ad_case_type">
					<div class="modal-body">
						<div class="form-group">
							<label>Description</label>
							<textarea name="description" class="form-control" rows="3" id="ad_description"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success btn-sm" name="submit" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="EditDiagnosis" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Edit Diagnosis</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."update_diagnosis");?>
					<input type="hidden" name="patientidno" id="ed_patientidno">
					<input type="hidden" name="caseno" id="ed_caseno">
					<input type="hidden" name="autono" id="ed_autono">
					<div class="modal-body">
						<div class="form-group">
							<label>ICD Code</label>
							<input type="text" class="form-control" id="ed_code" readonly>
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea name="description" class="form-control" rows="3" id="ed_description"></textarea>
						</div>
						<div class="form-group">
							<label>Level</label>
							<select name="level" class="form-select" required id="ed_level">
								<option value="primary">Primary</option>
								<option value="secondary">Secondary</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success btn-sm" name="submit" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="EditDisposition" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Edit Disposition</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."update_disposition");?>
					<input type="hidden" name="patientidno" id="ud_patientidno">
					<input type="hidden" name="caseno" id="ud_caseno">
					<div class="modal-body">
						<div class="form-group">
							<label>Disposition</label>
							<select name="disposition" class="form-select" required id="ud_disposition">
								<option value="IMPROVED">IMPROVED</option>
								<option value="HAMA">HAMA</option>
								<option value="DIED">DIED</option>
								<option value="ABSCONDED">ABSCONDED</option>
								<option value="TRANSFERRED">TRANSFERRED</option>
							</select>
						</div>
						<div class="form-group">
							<label>Status</label>
							<select name="status" class="form-select" required id="ud_status">
								<option value="discharged">DISCHARGED</option>
								<option value="CANCELLED">HAMA</option>
								<option value="ABSCONDED">ABSCONDED</option>
								<option value="TRANSFERRED">TRANSFERRED</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success btn-sm" name="submit" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="UpdateAttending" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."update_attending_doctor_mrd");?>
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Update Doctor</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="caseno" id="admit_caseno_mrd">
						<input type="hidden" name="patientidno" id="admit_patientidno_mrd">
						<div class="form-group mb-3">
							<label>Attending Doctor</label>
							<select name="ap" class="form-select" required id="admit_attending_mrd">
								<?php
								foreach($attending as $ap){
									echo "<option value='$ap[code]'>$ap[lastname], $ap[firstname]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Update" onclick="return confirm('Do you wish to update attending doctor?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ErrorDischarged" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content bg-opacity-75 bg-danger text-white">
					<div class="modal-header">
						<h5 class="modal-title h6" id="exampleModalSmLabel">Discharged Error!</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<h5 class="text-white"><i class="icofont-exclamation-circle text-white"></i> Patient must be set to FINAL!</h5>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-secondary btn-sm text-white" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="CreateCertificate" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Create Certificate</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."create_certificate");?>
					<input type="hidden" name="patientidno" id="cert_patientidno">
					<input type="hidden" name="caseno" id="cert_caseno">
					<input type="hidden" name="type" id="cert_type">
					<div class="modal-body">
						<div class="form-group">
							<label>Purpose</label>
							<textarea name="purpose" class="form-control" rows="3"></textarea>
						</div>
						<div class="form-group">
							<label>Remarks</label>
							<textarea name="remarks" class="form-control" rows="3"></textarea>
						</div>
						<div class="form-group">
							<lable>Charge to</lable>
							<select name="chargeto" class="form-control">
								<option value="">Select Employee</option>
								<?php
								$employee=$this->Masterfile_model->getAllEmployees();
								foreach($employee as $emp){
									echo "<option value='$emp[lastname], $emp[firstname] $emp[middlename]'>$emp[lastname], $emp[firstname] $emp[middlename]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success btn-sm" name="submit" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="EditCertificate" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Edit Certificate</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."update_certificate");?>
					<input type="hidden" name="patientidno" id="cert_edit_patientidno">
					<input type="hidden" name="caseno" id="cert_edit_caseno">
					<input type="hidden" name="type" id="cert_edit_type">
					<input type="hidden" name="id" id="cert_edit_id">
					<div class="modal-body">
						<div class="form-group">
							<label>Purpose</label>
							<textarea name="purpose" class="form-control" rows="3" id="cert_edit_purpose"></textarea>
						</div>
						<div class="form-group">
							<label>Remarks</label>
							<textarea name="remarks" class="form-control" rows="3" id="cert_edit_remarks"></textarea>
						</div>
						<div class="form-group">
							<lable>Charge to</lable>
							<select name="chargeto" class="form-control" id="cert_edit_charge">
								<option value="">Select Employee</option>
								<?php
								$employee=$this->Masterfile_model->getAllEmployees();
								foreach($employee as $emp){
									echo "<option value='$emp[lastname], $emp[firstname] $emp[middlename]'>$emp[lastname], $emp[firstname] $emp[middlename]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success btn-sm" name="submit" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="AddMedicoLegal" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Create Medico Legal</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."create_certificate");?>
					<input type="hidden" name="patientidno" id="med_patientidno">
					<input type="hidden" name="caseno" id="med_caseno">
					<input type="hidden" name="type" id="med_type">
					<div class="modal-body">
						<div class="form-group">
							<label>Nature of Incident</label>
							<textarea name="noi" class="form-control" rows="3"required></textarea>
						</div>
						<div class="form-group">
							<label>Place of Incident</label>
							<textarea name="poi" class="form-control" rows="3" required></textarea>
						</div>
						<div class="form-group">
							<label>Time of Incident</label>
							<input type="time" name="toi" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Date of Incident</label>
							<input type="date" name="doi" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Advise to rest for</label>
							<textarea name="advise" class="form-control" rows="3"></textarea>
						</div>
						<div class="form-group">
							<label>May go back to work</label>
							<textarea name="recommend" class="form-control" rows="3" ></textarea>
						</div>
						<div class="form-group">
							<lable>Charge to</lable>
							<select name="chargeto" class="form-control">
								<option value="">Select Employee</option>
								<?php
								$employee=$this->Masterfile_model->getAllEmployees();
								foreach($employee as $emp){
									echo "<option value='$emp[lastname], $emp[firstname] $emp[middlename]'>$emp[lastname], $emp[firstname] $emp[middlename]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success btn-sm" name="submit" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="EditMedicoLegal" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Edit Certificate</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."update_certificate");?>
					<input type="hidden" name="patientidno" id="med_edit_patientidno">
					<input type="hidden" name="caseno" id="med_edit_caseno">
					<input type="hidden" name="type" id="med_edit_type">
					<input type="hidden" name="id" id="med_edit_id">
					<div class="modal-body">
						<div class="form-group">
							<label>Nature of Incident</label>
							<textarea name="noi" class="form-control" rows="3" id="med_edit_noi" required></textarea>
						</div>
						<div class="form-group">
							<label>Place of Incident</label>
							<textarea name="poi" class="form-control" rows="3" id="med_edit_poi" required></textarea>
						</div>
						<div class="form-group">
							<label>Time of Incident</label>
							<input type="time" name="toi" class="form-control" id="med_edit_toi" required>
						</div>
						<div class="form-group">
							<label>Date of Incident</label>
							<input type="date" name="doi" class="form-control" id="med_edit_doi" required>
						</div>
						<div class="form-group">
							<label>Advise to rest for</label>
							<textarea name="advise" class="form-control" rows="3" id="med_edit_advise"></textarea>
						</div>
						<div class="form-group">
							<label>May go back to work</label>
							<textarea name="recommend" class="form-control" rows="3" id="med_edit_recommend"></textarea>
						</div>
						<div class="form-group">
							<lable>Charge to</lable>
							<select name="chargeto" class="form-control" id="med_edit_charge">
								<option value="">Select Employee</option>
								<?php
								$employee=$this->Masterfile_model->getAllEmployees();
								foreach($employee as $emp){
									echo "<option value='$emp[lastname], $emp[firstname] $emp[middlename]'>$emp[lastname], $emp[firstname] $emp[middlename]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success btn-sm" name="submit" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="generateAdmissionRecords" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Daily/Monthly Admission</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."daily_admission",array("target" => "_blank"));?>
					<div class="modal-body">
						<div class="form-group">
							<label>Start Date</label>
							<input type="date" name="startdate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
						<div class="form-group">
							<label>End Date</label>
							<input type="date" name="enddate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
						<div class="form-group">
							<label>Type</label>
							<select name="type" class="form-select">
								<option value="AdmissionDate">Sort By Admission Date</option>
								<option value="Alphabetical">Sort By Name</option>
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
		<div class="modal fade" id="generateAdmissionList" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Daily Admission</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."daily_admission_list",array("target" => "_blank"));?>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label>Run Date</label>
							<input type="date" name="startdate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
						<div class="form-group">
							<label>List Type</label>
							<select name="type" class="form-select" required>
								<option value="AdmissionTime">Sort by Admission Time</option>
								<option value="Alphabetical">Sort by Name</option>
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
		<div class="modal fade" id="generateBabyList" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Baby Admission</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."baby_admission",array("target" => "_blank"));?>
					<div class="modal-body">
						<div class="form-group">
							<label>Start Date</label>
							<input type="date" name="startdate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
						<div class="form-group">
							<label>End Date</label>
							<input type="date" name="enddate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="generateExpiredList" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Expired Patient</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."expired_admission",array("target" => "_blank"));?>
					<div class="modal-body">
						<div class="form-group">
							<label>Start Date</label>
							<input type="date" name="startdate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
						<div class="form-group">
							<label>End Date</label>
							<input type="date" name="enddate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="generateCourseWardCompliance" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Course Ward Compliance</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."course_ward_compliance",array("target" => "_blank"));?>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label>Start Date</label>
							<input type="date" name="startdate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
						<div class="form-group">
							<label>End Date</label>
							<input type="date" name="enddate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="generateCF4Patient" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Patient List</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."patient_list",array("target" => "_blank"));?>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label>Start Date</label>
							<input type="date" name="startdate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
						<div class="form-group">
							<label>End Date</label>
							<input type="date" name="enddate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="generateDiseases" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Top 10 Diseases</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."top_diseases",array("target" => "_blank"));?>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label>Start Date</label>
							<input type="date" name="startdate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
						<div class="form-group">
							<label>End Date</label>
							<input type="date" name="enddate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="TagEMR" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Tag to EMR</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."tag_emr");?>
					<input type="hidden" name="patientidno" id="tag_patientidno">
					<input type="hidden" name="caseno" id="tag_caseno">
					<input type="hidden" name="icdcode" id="tag_icdcode">
					<div class="modal-body">
						<div class="form-group">
							<label>ICD Code</label>
							<input type="text" class="form-control" id="tag_code" readonly>
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea name="description" class="form-control" rows="3" id="tag_description" readonly></textarea>
						</div>
						<div class="form-group">
							<label>ICD10 Code</label>
							<input list="icd10code" name="icd10code" class="form-control" required id="tag_icd10code">
                                 <datalist id="icd10code">
                                   <?php
                                   $icd10codes = $this->Records_model->getAllICD10Code();
                                    foreach($icd10codes as $row){
                                      echo "<option value='$row[icd10desc]_$row[icd10code]'>";
                                    }
                                   ?>
                                 </datalist>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success btn-sm" name="submit" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="documents" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Certifcation Report</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."view_documents");?>
					<div class="modal-body">
						<div class="form-group">
							<label>Run Date</label>
							<input type="date" name="startdate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Generate">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="SecondCopy" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Issue Document</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."issue_second_copy_others");?>
					<input type="hidden" name="patientidno" id="copy_patientidno">
					<input type="hidden" name="caseno" id="copy_caseno">
					<div class="modal-body">
						<div class="form-group">
							<label>Document</label>
							<select name="type" class="form-control" required>
								<option value="">Select Document</option>
								<option value="Birth Certificate">Birth Certificate</option>
								<option value="Death Certificate">Death Certificate</option>
								<option value="Process Insurance">Process Insurance</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Generate">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="copydocuments" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">2nd Copy Report</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."view_documents_copy");?>
					<div class="modal-body">
						<div class="form-group">
							<label>Run Date</label>
							<input type="date" name="startdate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Generate">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="Photocopy" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Photocopy Payment</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."photocopy",array("target" => "_blank"));?>
					<input type="hidden" name="patientidno" id="copy_patientidno">
					<input type="hidden" name="caseno" id="copy_caseno">
					<div class="modal-body">
						<div class="form-group">
							<label>Amount</label>
							<input type="text" name="amount" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="UploadChart" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Upload Chart</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."upload_chart",array('enctype' => 'multipart/form-data'));?>
					<input type="hidden" name="caseno" id="chart_caseno">
					<input type="hidden" name="patientidno" id="chart_patientidno">
					<div class="modal-body">
						<div class="form-group">
							<label>File</label>
							<input type="file" name="file" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Upload">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="AddICD10" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Add ICD10</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."add_icd");?>					
					<div class="modal-body">
						<div class="form-group">
	                      	<label>ICD CODE</label>
	                     	<input type="text" class="form-control" name="code">
	                    </div>
	                    <div class="form-group">
	                       <label>DESCRIPTION</label>
	                       <textarea name="description" class="form-control" rows="4"></textarea>
	                    </div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success btn-sm" name="submit" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="UpdateFinalDiagnosis" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."update_final_diag");?>
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Update Final Dx</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">			
						<input type="hidden" name="patientidno" id="dx_patientidno">
						<input type="hidden" name="caseno" id="dx_caseno">			
						<div class="form-group mb-3">
							<label>Final Diagnosis</label>
							<textarea name="finaldx" class="form-control" rows="3" id="dx_final"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>