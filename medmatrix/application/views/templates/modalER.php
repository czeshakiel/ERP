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
								<?php
								if($this->session->dept=="ONCOLOGY"){
									?>
									<option value="ONCO">Oncology</option>
									<?php
								}else if($this->session->dept=="RDU"){
									?>
									<option value="RDU">RDU</option>
									<option value="WD">RDU Walkin</option>
									<?php
								}else{
									?>									
									<option value="M">Surgical</option>
									<option value="C">Consultation</option>									
									<option value="E">Emergency</option>
									<option value="NB">New Born</option>
									<option value="W">Walkin</option>
									<?php
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
						if($this->session->dept=="KONSULTA"){
						$inpatient="display:none;";
						$walkin="display:none;";
						 $rdupatient="display:none;";
						 $outpatient='display:none;';					
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
					if($this->session->dept=="KONSULTA"){
						$inpatient="display:none;";
						$walkin="display:none;";
						//$arpatient="display:none;";
						 $rdupatient="display:none;";
						 $outpatient='display:none;';
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
								//$attending = $this->General_model->getAttendingDoctor();					
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
								//$admitting = $this->General_model->getAdmittingDoctor();
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
												if($dept=="PHARMACY" || $dept=="PHARMACY_OPD" || $dept=="csr2" || $dept=="OR" || $dept=="RDU" || $dept=="KONSULTA"){
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

		<div class="modal fade" id="editMembership" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."update_opd_membership");?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Membership</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">						
						<input type="hidden" name="caseno" id="mem_caseno">	
						<input type="hidden" name="rundate" value="<?=$rundate;?>">
						<input type="hidden" name="atype" value="<?=$type;?>">					
						<div class="form-group">
									<label class="form-label">Philhealth</label>
									<br />
									<label class="fancy-radio">
										<input type="radio" name="membership" value="phic-med" required data-parsley-errors-container="#error-radio">
										<span><i></i>Yes</span>
									</label>
									&nbsp;
									<label class="fancy-radio">
										<input type="radio" name="membership" value="No" checked>
										<span><i></i>No</span>
									</label>
									<p id="error-radio"></p>
								</div>
								<div class="form-group">
									<label class="form-label">Type</label>
									<select name="type" class="form-select">
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
								<div class="form-group">
									<label class="form-label">Membership Status</label>
									<select name="paymentmode" class="form-select">
										<option></option>
										<option value="Member">Member</option>
										<option value="Dependent">Dependent</option>
										<option value="N/A">N/A</option>
									</select>
								</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success" value="Update" onclick="return confirm('Do you wish to submit details?');return false;">
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
		<div class="modal fade" id="generateMinorSurgical" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">OPD Minor Report</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."opd_minor_report",array("target" => "_blank"));?>
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
		<div class="modal fade" id="generateOBReports" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."ob_reports",array("target" => "_blank"));?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">OB Reports</h5>
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