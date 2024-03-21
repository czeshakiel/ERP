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