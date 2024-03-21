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

		<div class="modal fade" id="OPDList" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<?php
					$this->session->unset_userdata('rundate');
					$this->session->unset_userdata('atype');
					?>
					<?=form_open(base_url()."opdlist");?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">OPD List</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Run Date</label>
							<input type="date" class="form-control" name="rundate" value="<?=date('Y-m-d');?>">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Admission Type</label>
							<select name="atype" class="form-select" required>
								<option value="C">Consultation</option>
								<option value="M">Surgical</option>
								<option value="E">Emergency</option>
								<option value="NB">New Born</option>
								<option value="W">Walkin</option>
								<option value="ONCO">Oncology</option>								
								<option value="RDU">RDU</option>
								<option value="WD">RDU Walkin</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="NewAdmission" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">New Admission</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?php
					$inpatient="";
					$outpatient="";
					$walkin="";
					$arpatient="";
					$rdupatient="display:none;";
					if($this->session->dept=="ADMISSION"){
						$outpatient="display:none;";
						$walkin="display:none;";
						$rdupatient="display:none;";

					}
						if($this->session->dept=="OPD"){
							$inpatient="display:none;";
							$rdupatient="display:none;";

						}
						 if($this->session->dept=="ONCOLOGY"){
							$inpatient="display:none;";
							$walkin="display:none;";
							$arpatient='display:none;';
							 $rdupatient="display:none;";

						}
						if($this->session->dept=="HMO"){
							$inpatient="display:none;";
							$walkin="display:none;";
							$outpatient='display:none;';
							 $rdupatient="display:none;";

						}
					if($this->session->dept=="RDU"){
						$inpatient="display:none;";
						$outpatient='display:none;';
						$rdupatient="";
					}
					?>
					<div class="modal-body" align="center">
						<h4>Select Admission Type</h4>
							<a href="<?=base_url();?>ipdadmission" class="btn btn-success btn-lg text-white" style="width:250px;<?=$inpatient;?>margin-bottom:10px;">In-Patient</a>
							<a href="<?=base_url();?>rduadmission" style="width:250px;<?=$rdupatient;?>margin-bottom:10px;" class="btn btn-warning btn-lg text-white" >Dialysis Patient</a>
							<a href="<?=base_url();?>opdadmission" style="width:250px;<?=$outpatient;?>margin-bottom:10px;" class="btn btn-warning btn-lg text-white" >Out-Patient</a>
							<a href="<?=base_url();?>walkinadmission" style="width:250px;<?=$walkin;?>margin-bottom:10px;" class="btn btn-danger btn-lg text-white" >Walkin-Patient</a>
							<a href="<?=base_url();?>aradmission" class="btn btn-info btn-lg text-white" style="width:250px;<?=$arpatient;?>margin-bottom:10px;">AR-Patient</a>
					</div>					
				</div>
			</div>
		</div>

		<div class="modal fade" id="ReAdmission" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Re-Admission</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?php
					$inpatient="";
					$outpatient="";
					$walkin="";
					$arpatient="";
					$rdupatient="display:none;";
					if($this->session->dept=="ADMISSION"){
						$outpatient="display:none;";
						$walkin="display:none;";
						$rdupatient="display:none;";
						$rduwalkin="display:none;";
						$rduarpatient="display:none;";
					}
							if($this->session->dept=="OPD"){
								$inpatient="display:none;";
								$rdupatient="display:none;";
								$rduwalkin="display:none;";
								$rduarpatient="display:none;";
							}
					 if($this->session->dept=="ONCOLOGY"){
						$inpatient="display:none;";
						$walkin="display:none;";
						$arpatient="display:none;";
						 $rdupatient="display:none;";
						 // $rduwalkin="display:none;";
						 // $rduarpatient="display:none;";
					}
					if($this->session->dept=="RDU"){
						$inpatient="display:none;";
						$outpatient='display:none;';
						$rdupatient="";
					}
					if($this->session->dept=="HMO"){
						$inpatient="display:none;";
						$walkin="display:none;";
						$outpatient='display:none;';
						 $rdupatient="display:none;";

					}
					?>
					<div class="modal-body" align="center">
						<h4>Select Admission Type</h4>
						<?=form_open(base_url()."ipdreadmission");?>
						<input type="hidden" name="patientidno" id="readmitpatientidno">
						<button type="submit" class="btn btn-success btn-lg text-white" style="width:250px;<?=$inpatient;?>margin-bottom:10px;">In-Patient</button>
						<?=form_close();?>
						<?=form_open(base_url()."rdureadmission");?>
						<input type="hidden" name="patientidno" id="readmitpatientidno">
						<button type="submit" class="btn btn-success btn-lg text-white" style="width:250px;<?=$rdupatient;?>margin-bottom:10px;">Dialysis Patient</button>
						<?=form_close();?>
							
							<?=form_open(base_url()."opdreadmission");?>
							<input type="hidden" name="patientidno" id="readmitpatientidno">
							<input type="submit" style="width:250px;<?=$outpatient;?>margin-bottom:10px;" class="btn btn-warning btn-lg text-white" value="Out-Patient">
							<?=form_close();?>
							
							<?=form_open(base_url()."walkinreadmission");?>
							<input type="hidden" name="patientidno" id="readmitpatientidno">
							<input type="submit" style="width:250px;<?=$walkin;?>margin-bottom:10px;" class="btn btn-danger btn-lg text-white" value="Walkin-Patient">
							<?=form_close();?>
						
						<?=form_open(base_url()."arreadmission");?>
						<input type="hidden" name="patientidno" id="readmitpatientidno">
						<input type="submit" class="btn btn-info btn-lg text-white" value="AR-Patient" style="width:250px;<?=$arpatient;?>margin-bottom:10px;">
						<?=form_close();?>
					</div>				
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
						<div class="form-group mb-3">
							<label class="mb-2">PhilHealth</label>
							<select name="membership" class="form-select" id="membership">
								<option value="phic-med">YES</option>
								<option value="Nonmed-none">NO</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Type</label>
							<select name="type" class="form-select" id="membertype">
								<option value="N/A"></option>
								<option value="Employment-Govt">Employed-Govt</option>
								<option value="Employment-Private">Employed-Private</option>
								<option value="Self-Employed">Self-Employed</option>
								<option value="OFW">OFW</option>
								<option value="OWWA">OWWA</option>
								<option value="Indigent">Indigent</option>
								<option value="Pensioner">Pensioner</option>
								<option value="Non PHIC">NON PHIC</option>
							</select>
						</div>	
						<div class="form-group mb-3">
							<label class="mb-2">Membership Status</label>
							<select name="paymentmode" class="form-select" id="paymentmode">
								<option value="Member">Member</option>
								<option value="Dependent">Dependent</option>
								<option value="N/A">N/A</option>
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
									echo "<option value='$ap[code]'>$ap[lastname], $ap[firstname] $ap[ext]</option>";
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
									echo "<option value='$ap[code]'>$ap[lastname], $ap[firstname] $ap[ext]</option>";
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

		<div class="modal fade" id="EditAdmitting" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<form action="<?=base_url();?>update_admitting_doctor" method ="post" id="update_admitting_doctor">
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Update Doctor</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="caseno" id="admit_caseno">
						<input type="hidden" name="rundate" value="<?=$rundate;?>">
						<input type="hidden" name="atype" value="<?=$type;?>">
						<div class="form-group mb-3">
							<label>Attending Doctor</label>
							<select name="ad" class="form-select" required id="admit_admitting">
								<?php
								foreach($admitting as $ap){
									echo "<option value='$ap[code]'>$ap[lastname], $ap[firstname]</option>";
								}
								foreach($attending as $ap){
									echo "<option value='$ap[code]'>$ap[lastname], $ap[firstname]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" data-bs-dismiss="modal" class="btn btn-success bt-lg" value="Update" onclick="return confirm('Do you wish to update admitting doctor?');return false;">
					</div>
					</form>
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

		<div class="modal fade" id="UpdateRoomAdmitting" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."save_admission_change_room");?>
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Update Room</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="caseno" id="admit_caseno">
						<div class="form-group mb-3">
							<label>Old Room</label>
							<input type="text" class="form-control" name="oldroom" id="oldroom">
						</div>
						<div class="form-group mb-3">
							<label>New Room</label>
							<input list="newrooms" name="newroom" class="form-control" id="newroom">
							<datalist id="newrooms">
								<?php
								
								foreach($room as $ap){
									echo "<option value='$ap[room]'>";
								}
								?>
							</datalist>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Update" onclick="return confirm('Do you wish to update patient room?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="UpdateHMO" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."save_admission_hmo");?>
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Update HMO</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="caseno" id="admit_caseno">
						<div class="form-group mb-3">
							<label>Current HMO</label>
							<input type="text" class="form-control" name="oldhmo" id="oldhmo">
						</div>
						<div class="form-group mb-3">
							<label>Current LOA LIMIT</label>
							<input type="text" class="form-control" name="oldloa" id="oldloa">
						</div>
						<div class="form-group mb-3">
							<label>New HMO</label>
							<select name="newhmo" class="form-select" required id="newhmo">
								<?php
								foreach($company as $ap){
									echo "<option value='$ap[companyname]'>$ap[companyname]</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>New LOA LIMIT</label>
							<input type="text" class="form-control" name="newloa">
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Update" onclick="return confirm('Do you wish to update patient hmo?');return false;">
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
							<label>Birth Date</label>
							<input type="date" name="birthdate" class="form-control" id="pbirthdate">
						</div>
						<div class="form-group">
							<label>Contact No</label>
							<input type="text" name="contactno" class="form-control" id="pcontactno">
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

		<div class="modal fade" id="ARList" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">					
					<?php
					$this->session->unset_userdata('startate');
					?>
					<?=form_open(base_url()."admit_arlist");?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">AR List</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Run Date</label>
							<input type="date" class="form-control" name="startdate" value="<?=date('Y-m-d');?>">
						</div>						
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="EditInitialDiag" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">					
					<?php
					$this->session->unset_userdata('startate');
					?>
					<?=form_open(base_url()."save_initial_diag");?>
					<input type="hidden" name="caseno" id="init_caseno">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Edit Initial Diagnosis</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Initial Diagnosis</label>
							<textarea name="diagnosis" class="form-control" id="init_diag" rows="5"></textarea>
						</div>						
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>