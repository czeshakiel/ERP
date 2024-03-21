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
							<!-- <label>Current HMO</label> -->
							<input type="hidden" class="form-control" name="oldhmo" id="oldhmo">
						</div>
						<div class="form-group mb-3">
							<label>New HMO</label>
							<select name="newhmo" class="form-select" required id="newhmo">
								<option value="N/A">N/A</option>
								<?php
								foreach($company as $ap){
									echo "<option value='$ap[companyname]'>$ap[companyname]</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Current LOA LIMIT</label>
							<input type="text" class="form-control" name="oldloa" id="oldloa" readonly>
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
		<div class="modal fade" id="UpdateHMOAR" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."save_admission_hmo_ar",array("target" => "_blank"));?>
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Update HMO</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="caseno" id="admit_caseno">
						<div class="form-group mb-3">
							<!-- <label>Current HMO</label> -->
							<input type="hidden" class="form-control" name="oldhmo" id="oldhmo">
						</div>
						<div class="form-group mb-3">
							<label>New HMO</label>
							<select name="newhmo" class="form-select" required id="newhmo">
								<option value="N/A">N/A</option>
								<?php
								foreach($company as $ap){
									echo "<option value='$ap[companyname]'>$ap[companyname]</option>";
								}
								?>
								<option value="N/A">N/A</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Current LOA LIMIT</label>
							<input type="text" class="form-control" name="oldloa" id="oldloa" readonly>
						</div>
						<div class="form-group mb-3">
							<label>New LOA LIMIT</label>
							<input type="text" class="form-control" name="newloa">
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Update" onclick="return confirm('Do you wish to update patient hmo?');return false;" data-bs-dismiss="modal">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="UpdateHMOProcedure" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."save_admission_hmo_procedure");?>
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Update HMO</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="caseno" id="admit_caseno">
						<div class="form-group mb-3">
							<!-- <label>Current HMO</label> -->
							<input type="hidden" class="form-control" name="oldhmo" id="oldhmo">
						</div>
						<div class="form-group mb-3">
							<label>New HMO</label>
							<select name="newhmo" class="form-select" required id="newhmo">
								<option value="N/A">N/A</option>
								<?php
								foreach($company as $ap){
									echo "<option value='$ap[companyname]'>$ap[companyname]</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Current LOA LIMIT</label>
							<input type="text" class="form-control" name="oldloa" id="oldloa" readonly>
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

		<div class="modal fade" id="UpdateHMOList" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."save_admission_hmo_list");?>
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
								<option value="N/A">N/A</option>
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
		<div class="modal fade" id="generateDailyAREmployee" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Daily AR Employee</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."daily_admission_ar_employee",array("target" => "_blank"));?>
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
		<div class="modal fade" id="generateDailyWalkinHMO" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Daily AR Admission</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."daily_admission_walkin_hmo");?>
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
		<div class="modal fade" id="ViewVS" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Vital Sign</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body" id="vitalsigns">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="editPrice" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Edit Price</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_hmo_price",array('target' => '_blank'));?>
					<input type="hidden" name="caseno" id="price_caseno">
					<input type="hidden" name="refno" id="price_refno">
					<div class="modal-body">
						<div class="form-group">
							<label>Selling Price</label>
							<input type="text" name="sellingprice" class="form-control price_srp" required id="price_srp" onchange="updatePrice();">
						</div>
						<div class="form-group">
							<label>Discount</label>
							<input type="text" name="discount" class="form-control" required id="price_discount">
						</div>
						<div class="form-group">
							<label>HMO</label>
							<input type="text" name="hmo" class="form-control price_hmo" required id="price_hmo" onchange="updatePrice();">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="AddPF" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">ADD PROFESSIONAL FEE</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."add_hmo_pf");?>
					<input type="hidden" name="caseno" id="pf_caseno">
					<div class="modal-body">
						<div class="form-group">
							<label>Doctor</label>
							<input list="doctors" name="doctor" id="doctor" class="form-control" required>
							<datalist id="doctors">
								<?php
								$attending=$this->General_model->getAllDoctor();
								foreach($attending as $item){
									echo "<option value='$item[lastname], $item[firstname] $item[middlename]_$item[code]'>";
								}
								?>
							</datalist>
						</div>
						<div class="form-group">
							<label>Amount</label>
							<input type="text" name="amount" class="form-control" required id="price_discount">
						</div>
						<div class="form-group">
							<label>HMO</label>
							<input type="text" name="hmo" class="form-control" required id="price_hmo">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="HMOReopen" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."hmoreopen");?>
					<input type="hidden" name="caseno" id="open_caseno_hmo">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Activate Account</h5>
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

		<div class="modal fade" id="Finalize" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."hmofinalize");?>
					<input type="hidden" name="caseno" id="final_caseno">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Finalize Account</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<h3>Do you wish to submit transaction for finalization?</h3>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-primary" name="submit" value="Finalize">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="generateDailyARHMOBilling" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Daily AR Admission</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."daily_admission_ar_hmo_billing",array("target" => "_blank"));?>
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

		<div class="modal fade" id="UpdateHMOAllocation" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."save_admission_hmo_allocation");?>
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Update HMO</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="caseno" id="allo_caseno">
						<div class="form-group mb-3">
							<label>Current LOA LIMIT</label>
							<input type="text" class="form-control" name="oldloa" id="allo_loa">
						</div>
						<div class="form-group mb-3">
							<label>New LOA LIMIT</label>
							<input type="text" class="form-control" name="newloa">
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Update" onclick="return confirm('Do you wish to update patient hmo?');return false;" data-bs-dismiss="modal">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="generateDailyARHMOBillingSummary" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalSmLabel">Daily Admission Summary</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."daily_admission_ar_hmo_billing_summary",array("target" => "_blank"));?>
					<div class="modal-body">
						<div class="form-group">
							<label>Select Date</label>
							<input type="date" name="rundate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
						<div class="form-group">
							<label>Report Type</label>
							<select name="type" class="form-select" required>
								<option value="m">Monthly</option>
								<option value="f">Forwarded</option>
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
		<div class="modal fade" id="PriceList" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalSmLabel">Price List</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."hmo_price_list");?>
					<div class="modal-body">
						<div class="form-group">
							<label>Service Type</label>
							<select name="service" class="form-control" required>
								<option value="">Select Type</option>
								<option value="LABORATORY">LABORATORY</option>
								<option value="IMAGING">IMAGING</option>
								<option value="OTHER">OTHER SERVICE</option>
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

		<div class="modal fade" id="PostARAllocation" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalSmLabel">POST ALLOCATION</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_hmo_allocation_type");?>
					<input type="hidden" name="caseno" cla>
					<div class="modal-body">
						<div class="form-group">
							<label>Allocation Type</label>
							<select name="type" class="form-control" required>
								<option value="">Select Type</option>
								<option value="AR EMPLOYEE">AR EMPLOYEE</option>
								<option value="AR DOCTOR">AR DOCTOR</option>
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
<div class="modal fade" id="generateDailyInpatientHMO" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalSmLabel">IPD Daily Discharged</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."daily_discharged_inpatient",array("target" => "_blank"));?>
					<div class="modal-body">
						<div class="form-group">
							<label>Select Date</label>
							<input type="date" name="rundate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
						<div class="form-group">
							<label>Select Department</label>
							<select name="department" class="form-select">
								<option value="I-">IPD</option>
								<option value="R-">RDU</option>
								<option value="O-">OPD</option>
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
		<div class="modal fade" id="generateSummaryInpatientHMO" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalSmLabel">IPD Discharged Summary</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."daily_discharged_inpatient_summary",array("target" => "_blank"));?>
					<div class="modal-body">
						<div class="form-group">
							<label>Select Date</label>
							<input type="date" name="rundate" class="form-control" value="<?=date('Y-m-d');?>">
						</div>
						<div class="form-group">
							<label>Select Department</label>
							<select name="department" class="form-select">
								<option value="I-">IPD</option>
								<option value="R-">RDU</option>
								<option value="O-">OPD</option>
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
		<div class="modal fade" id="AddAccountTitle" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."add_soa_accounttitle");?>
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Add Account Title</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">						
						<div class="form-group mb-3">
							<label>AccountTitle</label>
							<input type="text" class="form-control" name="accounttitle" required>
						</div>						
						<div class="form-group mb-3">
							<label>HMO</label>
							<select name="hmo" class="form-select" required>								
								<?php
								foreach($company as $ap){
									echo "<option value='$ap[companyname]'>$ap[companyname]</option>";
								}
								?>
							</select>
						</div>						
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="EditAccounttitle" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."update_soa_accounttitle");?>
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Edit Account Title</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">						
						<div class="form-group mb-3">
							<input type="hidden" name="id" id="soa_id">
							<label>AccountTitle</label>
							<input type="text" class="form-control" name="accounttitle" required id="soa_accttitle">
						</div>						
						<div class="form-group mb-3">
							<label>HMO</label>
							<select name="hmo" class="form-select" required id="soa_hmo">								
								<?php
								foreach($company as $ap){
									echo "<option value='$ap[companyname]'>$ap[companyname]</option>";
								}
								?>
							</select>
						</div>						
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="AddSubAccountTitle" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."add_soa_subaccounttitle");?>
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Add Account Title</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">			
						<input type="hidden" name="accounttitle_id" value="<?=$account_id;?>">			
						<div class="form-group mb-3">
							<label>AccountTitle</label>
							<select name="accounttitle" class="form-select" required>
								<?php
								$account_title = $this->Hmo_model->getAccttitleByUnit();
								foreach($account_title as $ap){
									echo "<option value='$ap[unit]'>$ap[unit]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="EditSubAccounttitle" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."update_soa_subaccounttitle");?>
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Edit Account Title</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">			
						<input type="hidden" name="accounttitle_id" value="<?=$account_id;?>">
						<input type="hidden" name="id" id="soa_id_details">			
						<div class="form-group mb-3">
							<label>AccountTitle</label>
							<select name="accounttitle" class="form-select" required id="soa_accttitle_details">
								<?php
								$account_title = $this->Hmo_model->getAccttitleByUnit();
								foreach($account_title as $ap){
									echo "<option value='$ap[unit]'>$ap[unit]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" name="submit" class="btn btn-success bt-lg" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>		