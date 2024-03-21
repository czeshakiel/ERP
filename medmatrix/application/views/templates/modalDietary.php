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