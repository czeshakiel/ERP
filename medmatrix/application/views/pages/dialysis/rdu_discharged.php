	

					<?=form_open(base_url()."patient_discharged");?>					
					<input type="hidden" name="caseno" value="<?=$caseno;?>">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Discharge Patient</h5>						
					</div>
					<div class="modal-body">						
						<div class="form-group mb-3">
							<label class="mb-2">Date Discharge</label>
							<input type="date" name="datedischarged" class="form-control" value="<?=date('Y-m-d');?>" required>		
						</div>
						<div class="form-group mb-3">
							<label class="mb-2">Time Discharged</label>
							<input type="time" name="timedischarged" class="form-control" required>		
						</div>
					</div>
					<div class="modal-footer">
						&nbsp;<input type="submit" class="btn btn-secondary" name="submit" onclick="return confirm('Do you wish to discharge this patient?');return false;" onclick="window.close();">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>