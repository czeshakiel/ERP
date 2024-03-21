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
				<input type="hidden" name="patientidno" value="">
				<input type="hidden" name="admissiontype" value="Walkin">
				<div class="card mb-3">
					<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
						<h6 class="mb-0 fw-bold ">Patient Information</h6>
					</div>
					<div class="card-body">
						<div class="row g-3 align-items-center">
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Last Name</label>
									<input type="text" class="form-control" name="lastname" required id="admitlastname">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">First Name</label>
									<input type="text" class="form-control" name="firstname" required id="admitfirstname">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Middle Name</label>
									<input type="text" class="form-control" name="middlename" id="admitmiddlename">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Suffix</label>
									<input type="text" class="form-control" name="suffix" id="admitsuffix">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Date of Birth <button type="button" onclick='myFunction4()' class="btn btn-warning" title='Age/Year Calculator'><i class="icofont-calculator"></i></button></label>
									<input type="date" class="form-control" name="birthdate" required id="admitbirthdate">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label class="form-label">Age</label>
									<input type="text" id="admitage" class="form-control" disabled style="text-align: center;">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Contact No</label>
									<input type="text" class="form-control" name="contactno" required id="admitcontactno">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label class="form-label">Gender</label>
									<select name="gender" class="form-select" required id="admitgender" required>
										<option value="">Gender</option>
										<option value="M">Male</option>
										<option value="F">Female</option>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Discount Type</label>
									<br />
									<label class="fancy-radio">
										<input type="radio" name="discounttype" value="NONE" required data-parsley-errors-container="#error-radio" checked id="admitdiscountnone">
										<span><i></i>None</span>
									</label>
									<label class="fancy-radio">
										<input type="radio" name="discounttype" value="SENIOR" id="admitdiscountsenior">
										<span><i></i>Senior</span>
									</label>
									<label class="fancy-radio">
										<input type="radio" name="discounttype" value="PWD" id="admitdiscountpwd">
										<span><i></i>PWD</span>
									</label>
									<p id="error-radio"></p>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Discount ID</label>
									<input type="text" class="form-control" name="discountid"  id="admitdiscountid">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Doctor</label>
									<select name="ap" class="form-select item" required>										
										<option value="">Select Doctor</option>
										<?php
										$attending=$this->General_model->getAttendingDoctor();
										$admitting=$this->General_model->getAdmittingDoctor();
										?>
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
										<?php
										$province=$this->General_model->getState();
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
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Barangay</label>
									<select name="barangay" class="form-select item" id="barangay">
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Street</label>
									<input type="text" class="form-control" name="street" required>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="form-label">Zip Code</label>
									<input type="text" class="form-control" name="zipcode" id="zipcode">
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
