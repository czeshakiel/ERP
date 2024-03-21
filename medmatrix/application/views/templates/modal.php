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
		<div class="modal fade" id="generateDailyAdmissionOPD" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Daily Admission</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."daily_admission_opd",array("target" => "_blank"));?>
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

		<div class="modal fade" id="generateRODReports" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."rod_reports",array("target" => "_blank"));?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">ROD Reports</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Start Date</label>
							<input type="date" class="form-control" name="startdate" required>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">End Date</label>
							<input type="date" class="form-control" name="enddate" required>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Resident on Duty</label>
							<select name="code" class="form-select" required>
								<?php
								$rod=$this->General_model->getAdmittingDoctor();
								foreach($rod as $doc){
									echo "<option value='$doc[code]'>$doc[lastname], $doc[firstname]</option>";
								}
								?>
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
						<h5 class="modal-title h4" id="exampleModalSmLabel">Bed Details</h5>
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
						<h5 class="modal-title h4" id="exampleModalSmLabel">Bed Details</h5>
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

		<div class="modal fade" id="NewRequest" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."create_request");?>
					<input type="hidden" name="reqdate" value="<?=date('Y-m-d');?>">
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">New Purchase Request</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label>Terms</label>
							<select name="terms" class="form-select" required>
								<option value="">Select Terms</option>
								<option value="None">None</option>
								<option value="60">60</option>
								<option value="45">45</option>
								<option value="30">30</option>
								<option value="15">15</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Trantype</label>
							<select name="trantype" class="form-select" required>
								<option value="">Select Type</option>
								<option value="charge">Charge</option>
								<option value="cash">Cash</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Supplier</label>
							<select name="supplier" class="form-select" required>
								<option value="">Select Supplier</option>
								<?php
								foreach($suppliers as $ap){
									echo "<option value='$ap[suppliercode]_$ap[suppliername]'>$ap[suppliername]</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Requesting Department</label>
							<select name="reqdept" class="form-select" required>
								<option value="<?=$department;?>"><?=$department;?></option>
								<?php
								foreach($station as $ap){
									echo "<option value='$ap[station]'>$ap[station]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Create Request" onclick="return confirm('Do you wish to create new Request?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="EditItemRequest" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."update_requested_item");?>
					<input type="hidden" name="rrdetails" id="req_id">
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Edit Item</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label>Description</label>
							<input type="text" name="description" class="form-control" id="req_desc">
						</div>
						<div class="form-group mb-3">
							<label>Quantity</label>
							<input type="text" name="quantity" class="form-control" id="req_quantity">
						</div>
						<div class="form-group mb-3">
							<label>Unit Cost</label>
							<input type="text" name="unitcost" class="form-control" id="req_unitcost">
						</div>
						<div class="form-group mb-3">
							<label>Discount</label>
							<input type="text" name="discount" class="form-control" id="req_discount">
						</div>
						<div class="form-group mb-3">
							<label>Unit</label>
							<select name="unit" class="form-select" required id="req_unit">
								<option value='pcs'>pcs</option>
								<option value='packs'>packs</option>
								<option value='box'>box</option>
								<option value='vial'>vial</option>
								<option value='bottle'>bottle</option>
								<option value='liter'>liter</option>
								<option value='gallon'>gallon</option>
								<option value='tablet'>tablet</option>
								<option value='capsule'>capsule</option>
								<option value='ampule'>ampule</option>
								<option value='tube'>tube</option>
								<option value='rim'>rim</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Submit" onclick="return confirm('Do you wish to submit update?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ManageRRSupplier" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Change Supplier</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."change_supplier");?>
					<div class="modal-body">
						<input type="hidden" name="pono" id="rr_po">
						<div class="form-group mb-3">
							<label>Supplier</label>
							<select name="supplier" class="form-select" required id="rr_supplier">
								<?php								
								foreach($supplier as $sup){
									echo "<option value='$sup[suppliercode]_$sup[suppliername]'>$sup[suppliername]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit" onclick="return confirm('Do you wish to change supplier?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="EditItemReceive" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."update_receive_item");?>
					<input type="hidden" name="rrdetails" id="rec_id">
					<input type="hidden" name="pono" id="rec_po">
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Edit Item</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label>Description</label>
							<input type="text" name="description" class="form-control" id="rec_desc">
						</div>
						<div class="form-group mb-3">
							<label>Quantity</label>
							<input type="text" name="quantity" class="form-control" id="rec_quantity">
						</div>
						<div class="form-group mb-3">
							<label>Unit Cost</label>
							<input type="text" name="unitcost" class="form-control" id="rec_unitcost">
						</div>
						<div class="form-group mb-3">
							<label>Discount</label>
							<input type="text" name="discount" class="form-control" id="rec_discount">
						</div>
						<div class="form-group mb-3">
							<label>Unit</label>
							<select name="unit" class="form-select" required id="rec_unit">
								<option value='pcs'>pcs</option>
								<option value='packs'>packs</option>
								<option value='box'>box</option>
								<option value='vial'>vial</option>
								<option value='bottle'>bottle</option>
								<option value='liter'>liter</option>
								<option value='gallon'>gallon</option>
								<option value='tablet'>tablet</option>
								<option value='capsule'>capsule</option>
								<option value='ampule'>ampule</option>
								<option value='tube'>tube</option>
								<option value='rim'>rim</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Submit" onclick="return confirm('Do you wish to submit update?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="ReceivingAddFreeGoods" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."receiving_add_free_goods");?>
					<input type="hidden" name="code" id="fg_code">
					<input type="hidden" name="pono" id="fg_po">
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Free Goods</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label>Description</label>
							<input type="text" name="description" class="form-control" id="fg_desc">
						</div>
						<div class="form-group mb-3">
							<label>Quantity</label>
							<input type="text" name="quantity" class="form-control" id="fg_quantity">
						</div>
						<div class="form-group mb-3">
							<label>Unit Cost</label>
							<input type="text" name="unitcost" class="form-control" id="fg_unitcost">
						</div>
						<div class="form-group mb-3">
							<label>Discount</label>
							<input type="text" name="discount" class="form-control" id="fg_discount">
						</div>
						<div class="form-group mb-3">
							<label>Unit</label>
							<select name="unit" class="form-select" required id="fg_unit">
								<option value='pcs'>pcs</option>
								<option value='packs'>packs</option>
								<option value='box'>box</option>
								<option value='vial'>vial</option>
								<option value='bottle'>bottle</option>
								<option value='liter'>liter</option>
								<option value='gallon'>gallon</option>
								<option value='tablet'>tablet</option>
								<option value='capsule'>capsule</option>
								<option value='ampule'>ampule</option>
								<option value='tube'>tube</option>
								<option value='rim'>rim</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Submit" onclick="return confirm('Do you wish to submit update?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="ReceivingAddBatch" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."receiving_add_batch");?>
					<input type="hidden" name="code" id="ab_code">
					<input type="hidden" name="pono" id="ab_po">
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Add Batch</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label>Description</label>
							<input type="text" name="description" class="form-control" id="ab_desc">
						</div>
						<div class="form-group mb-3">
							<label>Quantity</label>
							<input type="text" name="quantity" class="form-control" id="ab_quantity">
						</div>
						<div class="form-group mb-3">
							<label>Unit Cost</label>
							<input type="text" name="unitcost" class="form-control" id="ab_unitcost">
						</div>
						<div class="form-group mb-3">
							<label>Discount</label>
							<input type="text" name="discount" class="form-control" id="ab_discount">
						</div>
						<div class="form-group mb-3">
							<label>Unit</label>
							<select name="unit" class="form-select" required id="ab_unit">
								<option value='pcs'>pcs</option>
								<option value='packs'>packs</option>
								<option value='box'>box</option>
								<option value='vial'>vial</option>
								<option value='bottle'>bottle</option>
								<option value='liter'>liter</option>
								<option value='gallon'>gallon</option>
								<option value='tablet'>tablet</option>
								<option value='capsule'>capsule</option>
								<option value='ampule'>ampule</option>
								<option value='tube'>tube</option>
								<option value='rim'>rim</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Submit" onclick="return confirm('Do you wish to submit update?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="NewReceiving" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."create_receiving");?>
					<input type="hidden" name="reqdate" value="<?=date('Y-m-d');?>">
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">New Manual Receiving</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label>Invoice No.</label>
							<input type="text" name="invno" class="form-control checkInvoice" required id="mr_invoice">
						</div>
						<div class="form-group mb-3">
							<label>Invoice Date</label>
							<input type="date" name="invdate" class="form-control" value="<?=date('Y-m-d');?>" required>
						</div>
						<div class="form-group mb-3">
							<label>Transaction Date</label>
							<input type="date" name="transdate" class="form-control" value="<?=date('Y-m-d');?>" required>
						</div>
						<div class="form-group mb-3">
							<label>Terms</label>
							<select name="terms" class="form-select" required>
								<option value="">Select Terms</option>
								<option value="None">None</option>
								<option value="60">60</option>
								<option value="45">45</option>
								<option value="30">30</option>
								<option value="15">15</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Trantype</label>
							<select name="trantype" class="form-select" required>
								<option value="">Select Type</option>
								<option value="charge">Charge</option>
								<option value="cash">Cash</option>
								<option value="FREE GOODS">Free Goods</option>
								<option value="EXCESS STOCKS">Excess Stocks</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Supplier</label>
							<select name="supplier" class="form-select" required>
								<option value="">Select Supplier</option>
								<?php
								foreach($suppliers as $ap){
									echo "<option value='$ap[suppliercode]_$ap[suppliername]'>$ap[suppliername]</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Requesting Department</label>
							<select name="reqdept" class="form-select" required>
								<option value="<?=$department;?>"><?=$department;?></option>
								<?php
								foreach($station as $ap){
									echo "<option value='$ap[station]'>$ap[station]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Create Request" onclick="return confirm('Do you wish to create new Request?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="EditItemManual" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."update_manual_item");?>
					<input type="hidden" name="isid" id="man_id">
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Edit Item</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label>Description</label>
							<input type="text" name="description" class="form-control" id="man_desc">
						</div>
						<div class="form-group mb-3">
							<label>Quantity</label>
							<input type="text" name="quantity" class="form-control" id="man_quantity">
						</div>
						<div class="form-group mb-3">
							<label>Unit Cost</label>
							<input type="text" name="unitcost" class="form-control" id="man_unitcost">
						</div>
						<div class="form-group mb-3">
							<label>Discount</label>
							<input type="text" name="discount" class="form-control" id="man_discount">
						</div>
						<div class="form-group mb-3">
							<label>Unit</label>
							<select name="unit" class="form-select" required id="man_unit">
								<option value='pcs'>pcs</option>
								<option value='packs'>packs</option>
								<option value='box'>box</option>
								<option value='vial'>vial</option>
								<option value='bottle'>bottle</option>
								<option value='liter'>liter</option>
								<option value='gallon'>gallon</option>
								<option value='tablet'>tablet</option>
								<option value='capsule'>capsule</option>
								<option value='ampule'>ampule</option>
								<option value='tube'>tube</option>
								<option value='rim'>rim</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Expiration</label>
							<input type="date" name="expiration" class="form-control" id="man_expiration">
						</div>
						<div class="form-group mb-3">
							<label>Vat</label>
							<!--input type="hidden" name="tax" class="form-control" id="man_vat"-->
							<input type="checkbox" name="vat" class="form-check-input" id="man_vat">
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Submit" onclick="return confirm('Do you wish to submit update?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="NewTransfer" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Stock Transfer</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?php
					$invno=$this->General_model->generateRefNo('STB',$this->session->fullname);
					?>
					<?=form_open(base_url()."create_transfer");?>
					<input type="hidden" name="transdate" value="<?=date('Y-m-d');?>">
					<input type="hidden" name="invno" value="<?=$invno;?>">
					<div class="modal-body">
						<div class="form-group">
							<label>Charge To</label>
							<select name="branch" class="form-select" required>
								<option value=""></option>
								<?php
								foreach($station as $stat){
									echo "<option value='$stat[station]'>$stat[station]</option>";
								}
								?>
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
		<div class="modal fade" id="EditItemTransfer" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."update_transfer_item",array('onsubmit' => 'update_item();'));?>
					<input type="hidden" name="autono" id="trans_id">
					<input type="hidden" name="code" id="trans_code">
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Edit Item</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-body">
						<div class="form-group mb-3">
							<label>Description</label>
							<input type="text" name="description" class="form-control" id="trans_desc">
						</div>
						<div class="form-group mb-3">
							<label>Quantity</label>
							<input type="text" name="quantity" class="form-control" id="trans_quantity">
						</div>
						<div class="form-group mb-3">
							<label>Unit Cost</label>
							<input type="text" name="unitcost" class="form-control" id="trans_unitcost">
						</div>
						<div class="form-group mb-3">
							<label>Lot No</label>
							<input type="text" name="lotno" class="form-control" id="trans_lotno">
						</div>
						<div class="form-group mb-3">
							<label>Expiration</label>
							<input type="date" name="expiration" class="form-control" id="trans_expiration">
						</div>
						<div class="form-group mb-3">
							<label>Unit</label>
							<select name="unit" class="form-select" required id="trans_unit">
								<option value='pcs'>pcs</option>
								<option value='packs'>packs</option>
								<option value='box'>box</option>
								<option value='vial'>vial</option>
								<option value='bottle'>bottle</option>
								<option value='liter'>liter</option>
								<option value='gallon'>gallon</option>
								<option value='tablet'>tablet</option>
								<option value='capsule'>capsule</option>
								<option value='ampule'>ampule</option>
								<option value='tube'>tube</option>
								<option value='rim'>rim</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<div align="center"  id="loaderupdate">
							<div class="spinner-border text-center" style="width: 1rem; height: 1rem;" role="status"></div>
							<p id="loaderlabel">Updating.....</p>
<!--							<h5 id="loaderlabel">Saving.....</h5>-->
						</div>
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Submit" onclick="return confirm('Do you wish to submit update?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="generateReceivingSummary" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."receiving_summary",array("target" => "_blank"));?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Receiving Summary</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Transaction Type</label>
							<select name="trantype" class="form-select" required>
								<option value="">Select Trantype</option>
								<option value="charge">Charge</option>
								<option value="cash">Cash</option>
								<option value="EXCESS STOCKS">Excess Stocks</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Start Date</label>
							<input type="date" class="form-control" name="startdate" required>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">End Date</label>
							<input type="date" class="form-control" name="enddate" required>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="generateConsolidatedPO" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."consolidated_po",array("target" => "_blank"));?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Consolidated PO</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Start Date</label>
							<input type="date" class="form-control" name="startdate" required>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">End Date</label>
							<input type="date" class="form-control" name="enddate" required>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="generateKitAssemblyReport" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."kit_assembly_report");?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Kit Assembly Report</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Start Date</label>
							<input type="date" class="form-control" name="startdate" required>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">End Date</label>
							<input type="date" class="form-control" name="enddate" required>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="AdjustingEntry" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."authenticate_adjustment");?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Adjusting Entry</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Password</label>
							<input type="password" class="form-control" name="password" required>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit" value="Validate">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="AddMedicine" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalFullscreenLabel">Medicine Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."add_medicine");?>
					<div class="modal-body">
						<div class="row">
							<div class="col-4">
								<div class="mb-3">
									<label class="form-label">Description</label>
									<input type="text" class="form-control" name="description" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Brand</label>
									<input type="text" class="form-control" name="brand" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Expiration</label>
									<input type="date" class="form-control" name="expiration">
								</div>
								<div class="mb-3">
									<label class="form-label">PNDF?</label>
									<input type="radio" name="pnf" value="PNDF" checked> <b>PNDF</b>&nbsp;
									<input type="radio" name="pnf" value="NON-PNDF"> <b>NON-PNDF</b>
								</div>
								<div class="mb-3">
									<label class="form-label">Price Scheme</label>
									<input type="radio" name="pricescheme" value="S" checked> <b>Special</b>&nbsp;
									<input type="radio" name="pricescheme" value="M"> <b>Mark-up</b>
								</div>
								<div class="mb-3">
									<label class="form-label">Department</label>
									<select name="department" class="form-select" required>
										<option value="">Select Department</option>
										<?php
										foreach($station as $st){
											echo "<option value='$st[station]'>$st[station]</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-4">
								<div class="mb-3">
									<label class="form-label">Unit Cost</label>
									<input type="text" class="form-control" name="unitcost" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Cash Price</label>
									<input type="text" class="form-control" name="cash" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Charge Price</label>
									<input type="text" class="form-control" name="charge">
								</div>
								<div class="mb-3">
									<label class="form-label">Initial Quantity</label>
									<input type="text" class="form-control" name="quantity">
								</div>
							</div>
							<div class="col-4">
								<div class="mb-3">
									<label class="form-label">Form</label>
									<input type="text" class="form-control" name="medform" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Strenght</label>
									<input type="text" class="form-control" name="strength" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Unit</label>
									<input type="text" class="form-control" name="unit">
								</div>
								<div class="mb-3">
									<label class="form-label">Package</label>
									<input type="text" class="form-control" name="package">
								</div>
								<div class="mb-3">
									<label class="form-label">Route</label>
									<input type="text" class="form-control" name="route">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success btn-sm">Submit</button>
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="ManageMedicine" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalFullscreenLabel">Medicine Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."update_medicine");?>
					<input type="hidden" name="code" id="med_id">
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label">Description</label>
							<input type="text" class="form-control" name="description" required id="med_desc">
						</div>
						<div class="mb-3">
							<label class="form-label">Brand</label>
							<input type="text" class="form-control" name="brand" required id="med_brand">
						</div>
						<div class="mb-3">
							<label class="form-label">Form</label>
							<input type="text" class="form-control" name="medform" required id="med_form">
						</div>
						<div class="mb-3">
							<label class="form-label">Strenght</label>
							<input type="text" class="form-control" name="strength" required id="med_strength">
						</div>
						<div class="mb-3">
							<label class="form-label">Unit</label>
							<input type="text" class="form-control" name="unit" id="med_unit">
						</div>
						<div class="mb-3">
							<label class="form-label">Package</label>
							<input type="text" class="form-control" name="package" id="med_package">
						</div>
						<div class="mb-3">
							<label class="form-label">Route</label>
							<input type="text" class="form-control" name="route" id="med_route">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success btn-sm">Submit</button>
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="AddSupplies" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalFullscreenLabel">Supplies Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."add_supplies");?>
					<div class="modal-body">
						<div class="row">
							<div class="col-12">
								<div class="mb-3">
									<label class="form-label">Description</label>
									<input type="text" class="form-control" name="description" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Expiration</label>
									<input type="date" class="form-control" name="expiration">
								</div>
								<div class="mb-3">
									<label class="form-label">PNDF?</label>
									<input type="radio" name="pnf" value="PNDF" checked> <b>PNDF</b>&nbsp;
									<input type="radio" name="pnf" value="NON-PNDF"> <b>NON-PNDF</b>
								</div>
								<div class="mb-3">
									<label class="form-label">Price Scheme</label>
									<input type="radio" name="pricescheme" value="S" checked> <b>Special</b>&nbsp;
									<input type="radio" name="pricescheme" value="M"> <b>Mark-up</b>
								</div>
								<div class="mb-3">
									<label class="form-label">Unit Cost</label>
									<input type="text" class="form-control" name="unitcost" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Cash Price</label>
									<input type="text" class="form-control" name="cash" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Charge</label>
									<input type="text" class="form-control" name="charge" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Initial Quantity</label>
									<input type="text" class="form-control" name="quantity" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Department</label>
									<select name="department" class="form-select" required>
										<option value="">Select Department</option>
										<?php
										foreach($station as $st){
											echo "<option value='$st[station]'>$st[station]</option>";
										}
										?>
									</select>
								</div>
								<div class="mb-3">
									<label class="form-label">Product Type</label>
									<select name="prodtype" class="form-select" required>
										<option value="">Select Product Type</option>
										<?php
										foreach($type as $st){
											echo "<option value='$st[producttype]'>$st[producttype]</option>";
										}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success btn-sm">Submit</button>
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="ManageSupplies" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalFullscreenLabel">Supplies Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."update_supplies");?>
					<input type="hidden" name="code" id="sup_id">
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label">Description</label>
							<input type="text" class="form-control" name="description" required id="sup_desc">
						</div>
						<div class="mb-3">
							<label class="form-label">Product Type</label>
							<select name="prodtype" class="form-select" required id="sup_type">
								<option value="">Select Product Type</option>
								<?php
								foreach($type as $st){
									echo "<option value='$st[producttype]'>$st[producttype]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success btn-sm">Submit</button>
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="ManageSupplier" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalFullscreenLabel">Supplies Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_supplier");?>
					<input type="hidden" name="code" id="supp_id">
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label">Description</label>
							<input type="text" class="form-control" name="suppliername" required id="supp_name">
						</div>
						<div class="mb-3">
							<label class="form-label">Address</label>
							<textarea name="address" class="form-control" id="supp_address"></textarea>
						</div>
						<div class="mb-3">
							<label class="form-label">TIN</label>
							<input type="text" name="tin" class="form-control" id="supp_tin">
						</div>
						<div class="mb-3">
							<label class="form-label">Status</label>
							<select name="status" class="form-select" id="supp_status">
								<option value="ACTIVE">Active</option>
								<option value="INACTIVE">In active</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success btn-sm">Submit</button>
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ManageKitAssembly" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalFullscreenLabel">Kit Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_kit_assembly",array('onsubmit' => 'update_item();'));?>
					<input type="hidden" name="code" id="kit_id">
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label">Description</label>
							<input type="text" class="form-control" name="description" required id="kit_desc">
						</div>
						<div class="mb-3">
							<label class="form-label">Unit Cost</label>
							<input type="text" name="unitcost" class="form-control" id="kit_unitcost">
						</div>
						<div class="mb-3">
							<label class="form-label">PHIC Price</label>
							<input type="text" name="phic" class="form-control" id="kit_phic">
						</div>
						<div class="mb-3">
							<label class="form-label">OPD Price</label>
							<input type="text" name="opd" class="form-control" id="kit_opd">
						</div>
					</div>
					<div class="modal-footer">
						<div align="center"  id="loaderupdate1">
							<div class="spinner-border text-center" style="width: 1rem; height: 1rem;" role="status"></div>
							<p id="loaderlabel">Updating.....</p>
						</div>
						<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success btn-sm">Submit</button>
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="AddKitQty" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."add_kit_quantity",array('target' => '_blank','onsubmit' => 'add_item();'));?>
					<input type="hidden" name="code" id="q_id">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Add Kit Quantity</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Decription</label>
							<input type="text" class="form-control" name="description" readonly id="q_desc">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Quantity</label>
							<input type="text" class="form-control" name="quantity" required>
						</div>
					</div>
					<div class="modal-footer">
						<div align="center"  id="loaderupdate2">
							<div class="spinner-border text-center" style="width: 1rem; height: 1rem;" role="status"></div>
							<p id="loaderlabel">Updating.....</p>
						</div>
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit" value="Submit" data-bs-dismiss="modal">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="ProductionGloves" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."save_production_gloves",array('onsubmit'=> 'search_history();'));?>
					<input type="hidden" name="code" id="g_code">
					<input type="hidden" name="prodcode" id="g_pcode">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Gloves Production</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Production From</label>
							<input type="text" class="form-control" name="description" readonly id="g_desc">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Production To</label>
							<input type="text" class="form-control" name="description" readonly id="g_pdesc">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">No. of Box</label>
							<input type="text" class="form-control" name="box" required>
						</div>
					</div>
					<div class="modal-footer">
						<div align="center"  id="loaderupdate3">
							<div class="spinner-border text-center" style="width: 1rem; height: 1rem;" role="status"></div>
							<p id="loaderlabel">Updating.....</p>
						</div>
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ProductionAlcohol" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."save_production_alcohol",array('onsubmit'=> 'search_history();'));?>
					<input type="hidden" name="code" id="a_code">
					<input type="hidden" name="prodcode" id="a_pcode">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Alcohol Production</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Production From</label>
							<input type="text" class="form-control" name="description" readonly id="a_desc">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Production To</label>
							<input type="text" class="form-control" name="description" readonly id="a_pdesc">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">No. of Gallon</label>
							<input type="text" class="form-control" name="box" required>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">No. of Bottle</label>
							<input type="text" class="form-control" name="bottle" required>
						</div>
					</div>
					<div class="modal-footer">
						<div align="center"  id="loaderupdate3">
							<div class="spinner-border text-center" style="width: 1rem; height: 1rem;" role="status"></div>
							<p id="loaderlabel">Updating.....</p>
						</div>
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="ProductionOS" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."save_production_os",array('onsubmit'=> 'search_history();'));?>
					<input type="hidden" name="code" id="o_code">
					
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">OPACK Production</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Production From</label>
							<input type="text" class="form-control" name="description" readonly id="o_desc">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">No. of O.S. Pack</label>
							<input type="text" class="form-control" name="osqty">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Production To</label>
							<select name="prodcode" class="form-control">
								<?php
							$query=$this->Purchase_model->db->query("SELECT * FROM production WHERE code='2928'");
							$result=$query->result_array();
							foreach($result AS $item){
								echo "<option value='$item[prodcode]'>$item[proddesc]</option>";
							}
								?>								
							</select>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">No. of OPack</label>
							<input type="text" class="form-control" name="opqty" required>
						</div>
					</div>
					<div class="modal-footer">
						<div align="center"  id="loaderupdate3">
							<div class="spinner-border text-center" style="width: 1rem; height: 1rem;" role="status"></div>
							<p id="loaderlabel">Updating.....</p>
						</div>
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="NewChargeBOD" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."create_charge");?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">New Request</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Board of Director</label>
							<select name="bod" class="form-select" required>
								<option value="">Select BOD</option>
								<?php
								foreach($bod as $doc){
									echo "<option value='$doc[name]'>$doc[name]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit" value="Create">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="ReturnHistory" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."department_return_history");?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Return History</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Start Date</label>
							<input type="date" name="startdate" class="form-control">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">End Date</label>
							<input type="date" name="enddate" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit" value="Generate">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="ReturnHistoryItems" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."item_returns");?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Supplier Return History</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?php
					$supplier=$this->Purchase_model->getAllSuppliers();
					?>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Supplier</label>
							<select name="supplier" class="form-select" required>
								<option value="">Select Supplier</option>
								<?php
								foreach($supplier as $sup){
									echo "<option value='$sup[suppliercode]_$sup[suppliername]'>$sup[suppliername]</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Start Date</label>
							<input type="date" name="startdate" class="form-control">
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">End Date</label>
							<input type="date" name="enddate" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit" value="Generate">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="CreateReturn" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."create_return");?>
					<input type="hidden" name="transdate" value="<?=date('Y-m-d');?>">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Return to Supplier</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?php
					$supplier=$this->Purchase_model->getAllSuppliers();
					?>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Supplier</label>
							<select name="supplier" class="form-select" required>
								<option value="">Select Supplier</option>
								<?php
								foreach($supplier as $sup){
									echo "<option value='$sup[suppliercode]_$sup[suppliername]'>$sup[suppliername]</option>";
								}
								?>
							</select>
						</div>						
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit" value="Submit">
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

		<div class="modal fade" id="AddDiet" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."add_diet");?>
					<input type="hidden" name="caseno" id="diet_caseno">
					<input type="hidden" name="room" id="diet_room">
					<input type="hidden" name="user" id="diet_user">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Add Diet</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Diet</label>
							<select name="diet" class="form-select" required>
								<option value="">Select Diet</option>
								<?php
								foreach($alldiet as $diet){
									echo "<option value='$diet[COD]'>$diet[description]</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Reason</label>
							<textarea name="reason" class="form-control" rows="2"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit" value="Save Diet" onclick="return confirm('Do you wish to add this diet?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="activate_account" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Activate Account</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."activate_account");?>
					<input type="hidden" name="caseno" id="aa_caseno">
					<div class="modal-body">
						<div class="form-group">
							<label>Reason</label>
							<textarea name="reason" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="InventoryReport" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."inventory_reports",array("target" => "_blank"));?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Inventory Report</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Start Date</label>
							<input type="date" class="form-control" name="startdate" required>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">End Date</label>
							<input type="date" class="form-control" name="enddate" required>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Item</label>
							<select name="item" class="form-select" required>
								<?php
								$rod=$this->Dialysis_model->getAllItems();
								foreach($rod as $doc){
									echo "<option value='$doc[code]'>$doc[itemname]</option>";
								}
								?>
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

		<div class="modal fade" id="StockCardReport" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."view_stock_card",array("target" => "_blank"));?>
					<input type="hidden" name="department" value="<?=$this->session->dept;?>">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Stock Card</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Start Date</label>
							<input type="date" class="form-control" name="startdate" required>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">End Date</label>
							<input type="date" class="form-control" name="enddate" required>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Item</label>
							<select name="item" class="form-select" required>
								<?php
								$rod=$this->Dialysis_model->getAllItems();
								foreach($rod as $doc){
									echo "<option value='$doc[code]'>$doc[itemname]</option>";
								}
								?>
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

		<div class="modal fade" id="PrintAllTag" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Select Station</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."print_diet_tag_all",array('target' => '_blank'));?>
					<div class="modal-body">
						<div class="form-group">
							<label>Station</label>
							<select name="station" class="form-select" required>
								<option value=""></option>
								<?php
								$stat1=$this->Dietary_model->getAllStation();
								foreach($stat1 as $stat){
									echo "<option value='$stat[nursestation]'>$stat[nursestation]</option>";
								}
								?>
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
		<div class="modal fade" id="ServeMeal" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Meal Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."serve_meal");?>
					<div class="modal-body">
						<div class="form-group">
							<label>Meal Type</label>
							<select name="meal_type" class="form-select" required>
								<option value="breakfast">Breakfast</option>
								<option value="lunch">Lunch</option>
								<option value="dinner">Dinner</option>
							</select>
						</div>
						<div class="form-group">
							<label>Station</label>
							<select name="station" class="form-select" required>
								<option value=""></option>
								<?php
								$stat1=$this->Dietary_model->getAllStation();
								foreach($stat1 as $stat){
									echo "<option value='$stat[nursestation]'>$stat[nursestation]</option>";
								}
								?>
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
		<div class="modal fade" id="DietMasterList" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Diet Master List</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."diet_master_list",array('target' => '_blank'));?>
					<div class="modal-body">
						<div class="form-group">
							<label>Meal Type</label>
							<select name="meal_type" class="form-select" required>
								<option value="breakfast">Breakfast</option>
								<option value="lunch">Lunch</option>
								<option value="dinner">Dinner</option>
							</select>
						</div>
						<div class="form-group">
							<label>Station</label>
							<select name="station" class="form-select" required>
								<option value=""></option>
								<?php
								$stat1=$this->Dietary_model->getAllStation();
								foreach($stat1 as $stat){
									echo "<option value='$stat[nursestation]'>$stat[nursestation]</option>";
								}
								?>
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

		<div class="modal fade" id="VitalSigns" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."save_vital_signs");?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Vital Signs</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">						
						<input type="hidden" name="caseno" id="vs_caseno">
						<div class="form-group">
							<label>Temperature (&deg;C)</label>
							<input type="text" name="temp" class="form-control" id="vs_temp">
						</div>
						<div class="form-group">
							<label>Blood Pressure</label>
							<table width="100%" border="0" cellspacing="1" cellpadding="1">
								<tr>
									<td><input type="text" name="systolic" class="form-control" id="vs_systolic" placeholder="Systolic"></td>
									<td><input type="text" name="diastolic" class="form-control" id="vs_diastolic" placeholder="Diastolic"></td>
								</tr>
							</table>							
						</div>
						<div class="form-group">
							<label>Height (cm)</label>
							<input type="text" name="height" class="form-control" id="vs_height">
						</div>
						<div class="form-group">
							<label>Weight (kg)</label>
							<input type="text" name="weight" class="form-control" id="vs_weight">
						</div>
						<div class="form-group">
							<label>Pulse Rate</label>
							<input type="text" name="pr" class="form-control" id="vs_pr">
						</div>						
						<div class="form-group">
							<label>Respiratory Rate</label>
							<input type="text" name="rr" class="form-control" id="vs_rr">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success" value="Update" onclick="return confirm('Do you wish to submit details?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="editCreditLimit" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."save_credit_limit");?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Credit Limit</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">						
						<input type="hidden" name="caseno" id="cl_caseno">
						<input type="hidden" name="rundate" value="<?=$rundate;?>">
						<input type="hidden" name="atype" value="<?=$type;?>">
						<div class="form-group">
							<label>Old Credit Limit</label>
							<input type="text" name="oldcredit" class="form-control" id="cl_creditlimit">
						</div>						
						<div class="form-group">
							<label>New Credit Limit</label>
							<input type="text" name="newcredit" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success" value="Update" onclick="return confirm('Do you wish to submit details?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="MealMonitoring" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Meal Monitoring</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."meal_monitoring_sheet",array('target' => '_blank'));?>
					<div class="modal-body">						
						<div class="form-group">
							<label>Station</label>
							<select name="station" class="form-select" required>
								<option value=""></option>
								<?php
								$stat1=$this->Dietary_model->getAllStation();
								foreach($stat1 as $stat){
									echo "<option value='$stat[nursestation]'>$stat[nursestation]</option>";
								}
								?>
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
		<div class="modal fade" id="NewAdmissionQuotation" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Quotation</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."new_patient_quotation");?>					
					<input type="hidden" name="patientidno">
					<div class="modal-body">					
						<div class="form-group">
							<label>Last Name</label>
							<input type="text" class="form-control" name="lastname" required>
						</div>
						<div class="form-group">
							<label>First Name</label>
							<input type="text" class="form-control" name="firstname" required>
						</div>
						<div class="form-group">
							<label>Middle Name</label>
							<input type="text" class="form-control" name="middlename" required>
						</div>
						<div class="form-group">
							<label>Suffix</label>
							<input type="text" class="form-control" name="suffix">
						</div>
						<div class="form-group">
							<label>Date of Birth</label>
							<input type="date" class="form-control" name="birthdate">
						</div>
						<div class="form-group">
							<label>Gender</label>
							<select name="sex" class="form-control" required>
								<option value="M">Male</option>
								<option value="F">Female</option>
							</select>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password" required>
						</div>
						<div class="form-group">	
							<br>						
							<input type="submit" class="btn btn-success btn-sm" name="submit" value="Proceed">
						</div>
					</div>				
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="ReAdmissionQuotation" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Quotation</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."new_patient_quotation");?>					
					<input type="hidden" name="patientidno" id="quotation_patientidno">
					<div class="modal-body">					
						<div class="form-group">
							<label>Last Name</label>
							<input type="text" class="form-control" name="lastname" required id="quotation_lname">
						</div>
						<div class="form-group">
							<label>First Name</label>
							<input type="text" class="form-control" name="firstname" required id="quotation_fname">
						</div>
						<div class="form-group">
							<label>Middle Name</label>
							<input type="text" class="form-control" name="middlename" required id="quotation_mname">
						</div>
						<div class="form-group">
							<label>Suffix</label>
							<input type="text" class="form-control" name="suffix" id="quotation_suffix">
						</div>
						<div class="form-group">
							<label>Date of Birth</label>
							<input type="date" class="form-control" name="birthdate" required id="quotation_birthdate">
						</div>
						<div class="form-group">
							<label>Gender</label>
							<select name="sex" class="form-control" required id="quotation_gender">
								<option value="M">Male</option>
								<option value="F">Female</option>
							</select>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control admitpassword" name="password" required>
						</div>	
						<br>						
						<span class="caseexist"></span>
						<div class="form-group">	
							<br>						
							<input type="submit" class="btn btn-success btn-sm" name="submit" value="Proceed">
						</div>
					</div>				
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ChargeItem" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."add_charge_item");?>
					<input type="hidden" name="caseno" id="diet_charge_id">					
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Charge Dietary Item</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Item</label>
							<select name="item" class="form-select" required>
								<option value="">Select Item</option>
								<?php
								$query="SELECT * FROM receiving WHERE (description LIKE '%COMMERCIAL%' AND `unit` LIKE '%DIETARY COUNSELING INCOME%') OR (description LIKE '%OSTHEORIZED FEEDING%' AND unit = 'NURSING CHARGES') OR (description LIKE '%PAPER CUP%' AND unit LIKE '%MISC%') OR (description LIKE '%PAPER PACK%' AND unit LIKE '%MISC%')";
								$query_result=$this->Dietary_model->db->query($query);
								if($query_result->num_rows()>0){
									$result=$query_result->result_array();
									foreach($result as $diet){
										echo "a";
										echo "<option value='$diet[code]'>$diet[description]</option>";
									}
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Quantity</label>
							<input type="number" name="quantity" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit" value="Save Diet" onclick="return confirm('Do you wish to charge this item?');return false;">
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

		<div class="modal fade" id="generateReferredSummary" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."referred_summary",array("target" => "_blank"));?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Referred Summary</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label class="mb-2">Start Date</label>
							<input type="date" class="form-control" name="startdate" required>
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">End Date</label>
							<input type="date" class="form-control" name="enddate" required>
						</div>						
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="generateDailyARHMO" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Daily AR Admission</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."daily_admission_ar_hmo",array("target" => "_blank"));?>
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

		<div class="modal fade" id="generateDailyAdmissionHMO" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Daily Admission</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."daily_admission_ipd_hmo",array("target" => "_blank"));?>
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

		<div class="modal fade" id="StillinReadmission" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Re-Admission</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>					
					<div class="modal-body" align="center">
						<h4>Select Admission Type</h4>													
							<?=form_open(base_url()."walkinreadmission");?>
							<input type="hidden" name="patientidno" id="stillinreadmitpatientidno">
							<input type="submit" style="width:250px;<?=$walkin;?>margin-bottom:10px;" class="btn btn-danger btn-lg text-white" value="Walkin-Patient">
							<?=form_close();?>						
					</div>				
				</div>
			</div>
		</div>