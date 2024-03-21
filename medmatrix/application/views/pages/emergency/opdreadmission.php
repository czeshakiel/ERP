<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h4 class="fw-bold mb-0"><a href="<?=base_url();?>admission"><i class="icofont-arrow-left"></i> Back </a>| <?=$title;?></h4>
				</div>
			</div>
		</div> <!-- Row end  -->

		<div class="row align-item-center">
			<div class="col-md-12">
				<?=form_open(base_url()."submitadmission");?>
				<input type="hidden" name="patientidno" value="<?=$patientidno;?>">
				<input type="hidden" name="admissiontype" value="OPD">
				<div class="card mb-3">
					<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
						<h6 class="mb-0 fw-bold ">Patient Information</h6>
					</div>
					<div class="card-body">
						<div class="row g-3 align-items-center">
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Last Name</label>
									<input type="text" class="form-control" name="lastname" required value="<?=$outpatient['lastname'];?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">First Name</label>
									<input type="text" class="form-control" name="firstname" required value="<?=$outpatient['firstname'];?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Middle Name</label>
									<input type="text" class="form-control" name="middlename" value="<?=$outpatient['middlename'];?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Suffix</label>
									<input type="text" class="form-control" name="suffix" value="<?=$outpatient['suffix'];?>">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Date of Birth <button type="button" onclick='myFunction4()' class="btn btn-warning" title='Age/Year Calculator'><i class="icofont-calculator"></i></button></label>
									<input type="date" class="form-control" name="birthdate" required value="<?=$outpatient['dateofbirth'];?>" id="admitbirthdate">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label class="form-label">Age</label>
									<input type="text" id="admitage" class="form-control" disabled style="text-align: center;"value="<?=$outpatient['age'];?>">
								</div>
							</div>							
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Contact No</label>
									<input type="text" class="form-control" name="contactno" required value="<?=$outpatient['patientcontactno'];?>">
								</div>
							</div>
							<?php
							if($outpatient['sex']=="M"){
								$sex=$outpatient['sex'];
								$gender="Male";
							}else{
								$sex=$outpatient['sex'];
								$gender="Female";
							}
							?>
							<div class="col-md-1">
								<div class="form-group">
									<label class="form-label">Gender</label>
									<select name="gender" class="form-select" required id="admitgender">
										<option value="<?=$sex;?>"><?=$gender;?></option>
										<option value="M">Male</option>
										<option value="F">Female</option>
									</select>									
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Civil Status</label>
									<select name="civilstatus" class="form-select" required id="admitcivilstatus">
										<option value="<?=$outpatient['stat1'];?>"><?=$outpatient['stat1'];?></option>
										<option value="New Born">New Born</option>
										<option value="Child">Child</option>
										<option value="Single">Single</option>
										<option value="Married">Married</option>
										<option value="Separated">Separated</option>
										<option value="Widowed">Widowed</option>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Nationality</label>
									<select name="nationality" class="form-select" required>
										<option value="<?=$outpatient['notify'];?>"><?=$outpatient['notify'];?></option>
										<?php
										foreach($nationality as $rel){
											echo "<option value='$rel[description]'>$rel[description]</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Religion</label>
									<select name="religion" class="form-select" required id="admitreligion">
										<option value="<?=$outpatient['religion'];?>"><?=$outpatient['religion'];?></option>
										<?php
										foreach($religion as $rel){
											echo "<option value='$rel[description]'>$rel[description]</option>";
										}
										?>
									</select>
								</div>
							</div>
							<?php
							$none="";
							$senior="";
							$pwd="";
							if(($outpatient['discounttype']=="NONE" && $outpatient['age'] < 60) || $outpatient['discounttype'] == ""){
								$none="checked";
							}else if($outpatient['discounttype']=="SENIOR" || $outpatient['age'] >= 60){
								$senior="checked";
							}else{
								$pwd="checked";
							}
							?>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Discount Type</label>
									<br />
									<label class="fancy-radio">
										<input type="radio" name="discounttype" value="NONE" required data-parsley-errors-container="#error-radio" checked id="admitdiscountnone" <?=$none;?>>
										<span><i></i>None</span>
									</label>
									<label class="fancy-radio">
										<input type="radio" name="discounttype" value="SENIOR" id="admitdiscountsenior" <?=$senior;?>>
										<span><i></i>Senior</span>
									</label>
									<label class="fancy-radio">
										<input type="radio" name="discounttype" value="PWD" id="admitdiscountpwd" <?=$pwd;?>>
										<span><i></i>PWD</span>
									</label>
									<p id="error-radio"></p>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Discount ID</label>
									<input type="text" class="form-control" name="discountid"  value="<?=$outpatient['discountid'];?>">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3">
					<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
						<h6 class="mb-0 fw-bold ">Other Information</h6>
					</div>
					<div class="card-body">
						<div class="row g-3 align-items-center">
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Province</label>
									<select name="province" class="form-select item" required id="province">
										<option value="<?=$outpatient['province'];?>"><?=$outpatient['province'];?></option>
										<?php
										foreach($province as $rel){
											echo "<option value='$rel[id]'>$rel[statename]</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">City/Municipality</label>
									<select name="city" class="form-select item" id="city">
										<option value="<?=$outpatient['municipality'];?>"><?=$outpatient['municipality'];?></option>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Barangay</label>
									<select name="barangay" class="form-select item" id="barangay">
										<option value="<?=$outpatient['barangay'];?>"><?=$outpatient['barangay'];?></option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Street</label>
									<input type="text" class="form-control" name="street" required value="<?=$outpatient['street'];?>">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Zip Code</label>
									<input type="text" class="form-control" name="zipcode" id="zipcode" value="<?=$outpatient['zipcode'];?>">
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label class="form-label">Disposition</label>
									<br />
									<label class="fancy-radio">
										<input type="radio" name="disposition" value="Ambulatory" required data-parsley-errors-container="#error-radio">
										<span><i></i>Ambulatory</span>
									</label>
									&nbsp;
									<label class="fancy-radio">
										<input type="radio" name="disposition" value="Stretcher">
										<span><i></i>Stretcher</span>
									</label>
									&nbsp;
									<label class="fancy-radio">
										<input type="radio" name="disposition" value="Wheel Chair">
										<span><i></i>Wheel Chair</span>
									</label>
									&nbsp;
									<label class="fancy-radio">
										<input type="radio" name="disposition" value="Carried by Relative" checked>
										<span><i></i>Carried by Relative</span>
									</label>
									&nbsp;
									<label class="fancy-radio">
										<input type="radio" name="disposition" value="New Born">
										<span><i></i>New Born</span>
									</label>
									<p id="error-radio"></p>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Transfer from other Hospital?</label>
									<br />
									<label class="fancy-radio">
										<input type="radio" name="transferfrom" value="Yes" required data-parsley-errors-container="#error-radio">
										<span><i></i>Yes</span>
									</label>
									<label class="fancy-radio">
										<input type="radio" name="transferfrom" value="No" checked>
										<span><i></i>No</span>
									</label>
									<p id="error-radio"></p>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label class="form-label">Name of Hospital transfer from</label>
									<input type="text" class="form-control" name="transfrom">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Person in case of Emergency</label>
									<input type="text" class="form-control" name="contactperson" id="admitcontactperson" value="<?=$outpatient['middlenamed'];?>">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Contact No. of Person</label>
									<input type="text" class="form-control" name="contactpersonno" id="admitcontactpersonnumber" value="<?=$outpatient['contactno'];?>">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Relation to Contact Person</label>
									<input type="text" class="form-control" name="contactpersonrelation" id="admitcontactrelation" value="<?=$outpatient['relationship'];?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Name of Father</label>
									<input type="text" class="form-control" name="father" id="admitfather" value="<?=$outpatient['lastnamed'];?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Name of Mother</label>
									<input type="text" class="form-control" name="mother" id="admitmother" value="<?=$outpatient['firstnamed'];?>">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3">
					<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
						<h6 class="mb-0 fw-bold ">Admission Details</h6>
					</div>
					<div class="card-body">
						<div class="row g-3 align-items-center">
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Doctor</label>
									<select name="ap" class="form-select item" required>
										<option value="">Select Doctor</option>
										<?php
										foreach($attending as $rel){
											echo "<option value='$rel[code]'>$rel[lastname], $rel[firstname]</option>";
										}
										foreach($admitting as $rel){
											echo "<option value='$rel[code]'>$rel[lastname], $rel[firstname]</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Service Type</label>
									<select name="service" class="form-select" required>
										<?php
										foreach($servicetype as $serv){
											if($serv['proc']=="Consultation" || $serv['proc']=="OPD Procedure"){
												echo "<option value='$serv[proc]'>$serv[proc]</option>";
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Payment Mode</label>
									<br />
									<label class="fancy-radio">
										<input type="radio" name="hmomembership" value="hmo-hmo" required data-parsley-errors-container="#error-radio" onclick="showSelect();">
										<span><i></i>HMO</span>
									</label>
									&nbsp;
									<label class="fancy-radio">
										<input type="radio" name="hmomembership" value="hmo-hmo" onclick="showSelect();">
										<span><i></i>Company</span>
									</label>
									&nbsp;
									<label class="fancy-radio">
										<input type="radio" name="hmomembership" value="none" checked onclick="hideSelect();">
										<span><i></i>None (Self pay)</span>
									</label>
									<p id="error-radio"></p>
								</div>
							</div>
							<div class="hide col-md-12" id="my_select">
								<div class="col-md-2 mb-3">
									<label for="suffix" class="form-label">HMO:</label>
									<select name="hmo" class="form-select">
										<option value="N/A"></option>
										<?php
										foreach($company as $hmo){
											echo "<option value='$hmo[companyname]'>$hmo[companyname]</option>";
										}
										?>
									</select>
								</div>
								<div class="col-md-2">
									<label  class="form-label">LOA Limit</label>
									<input type="text" class="form-control" name="loalimit">
								</div>
							</div>
							<?php
							if($this->session->dept=="ONCOLOGY"){
								$case="ONCO".date('y')."-";
							}else{
								$case="C".date('y')."-".date('YmdHis');
							}
							?>
							<?php
							if($this->session->dept=="ER"){
								?>
								<div class="col-md-1">
									<div class="form-group">
										<label class="form-label">Station</label>
										<br />
										<label class="fancy-radio">
											<input type="radio" name="station" value="OPD" required data-parsley-errors-container="#error-radio" checked onclick="hideSelect1();insertData('<?=$case;?>');">
											<span><i></i>OPD</span>
										</label>
										&nbsp;
										<label class="fancy-radio">
											<input type="radio" name="station" value="ER" onclick="showSelect1();insertData('E');">
											<span><i></i>ER</span>
										</label>
										<p id="error-radio"></p>
									</div>
								</div>
								<?php
							}
							?>
							<?php
							if($this->session->dept=="OPD" || $this->session->dept=="ONCOLOGY"){
								?>
								<div class="col-md-3">
									<div class="form-group">
										<label class="form-label">Station</label>
										<br />
										<?php
										if($this->session->dept=="OPD"){
										?>
										<label class="fancy-radio">
											<input type="radio" name="station" value="OPD" required data-parsley-errors-container="#error-radio" checked onclick="hideSelect1();insertData('<?=$case;?>');">
											<span><i></i>OPD</span>
										</label>
										&nbsp;
										<label class="fancy-radio">
											<input type="radio" name="station" value="ER" onclick="showSelect1();insertData('M');">
											<span><i></i>OPD Minor</span>
										</label>
										<?php
										}
										if($this->session->dept=="ONCOLOGY"){
											?>
											<label class="fancy-radio">
												<input type="radio" name="station" value="ONCO" onclick="showSelect1();insertData('ONCO');" checked>
												<span><i></i>ONCOLOGY</span>
											</label>
											<?php
										}
										?>
										<p id="error-radio"></p>
									</div>
								</div>
								<?php
							}
							?>
							<?php
							if($this->session->dept=="ONCOLOGY"){
								?>
								<div class="col-md-12" id="my_select1">
								<?php	
							}else{
								?>
								<div class="hide col-md-12" id="my_select1">
								<?php
							}
							?>							
								<div class="col-md-1 mb-3">
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
								</div>
								<div class="col-md-2 mb-3">
									<div class="form-group">
										<label class="form-label">Type</label>
										<select name="type" class="form-select" required>
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
								</div>
								<div class="col-md-2 mb-3">
									<div class="form-group">
										<label class="form-label">Membership Status</label>
										<select name="paymentmode" class="form-select" required>
											<option value="N/A"></option>
											<option value="Member">Member</option>
											<option value="Dependent">Dependent</option>
											<option value="N/A">N/A</option>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="form-label">Procedure</label><br>
										<select name="procedure" class="form-select item" style="width: 50%;" required>
											<option value="N/A">Select Procedure</option>
											<?php
											foreach($procedure as $serv){
												echo "<option value='$serv[proccode]'>$serv[procdesc]</option>";
											}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Hospital Case No</label>
									<input type="text" class="form-control hcn" name="hcn" required id="hcn" value="<?=$case;?>">
									<span id="hcnexist"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Initial Diagnosis</label>
									<input type="text" name="initialdiagnosis" class="form-control" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Password</label>
									<input type="password" class="form-control admitpassword" name="password" required id="admitpassword">
									<span id="caseexist"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3">
					<div class="card-header py-3 d-flex bg-transparent border-bottom-0 justify-content-center">
						<h6 class="mb-0 fw-bold "><input type="submit" name="submit" value="Submit Details" class="btn btn-primary btn-block" id="walkinsubmit" disabled></h6>
					</div>
				</div>
				<?=form_close();?>
			</div>
		</div><!-- Row end  -->

	</div>
</div>
