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
							<!-- <input type="text" name="invno" class="form-control checkInvoice" required id="mr_invoice"> -->
							<input type="text" name="invno" class="form-control checkInvoice" required>
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
							<label>Discount</label>
							<input type="text" name="discount" class="form-control" id="trans_discount">
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
									<input type="text" class="form-control" name="cash">
								</div>
								<div class="mb-3">
									<label class="form-label">Charge</label>
									<input type="text" class="form-control" name="charge">
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
								<div class="mb-3">
							<label class="form-label">Sub Section</label>
							<select name="optset3" class="form-select" id="sup_section">
								<option value="">Select Sub Section</option>
								<?php
								$section=$this->Purchase_model->getSubSection();
								foreach($section as $st){
									echo "<option value='$st[description]'>$st[description]</option>";
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
						<div class="mb-3">
							<label class="form-label">Sub Section</label>
							<select name="optset3" class="form-select" id="sup_section">
								<option value="">Select Sub Section</option>
								<?php
								$section=$this->Purchase_model->getSubSection();
								foreach($section as $st){
									echo "<option value='$st[description]'>$st[description]</option>";
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
						<h5 class="modal-title h4" id="exampleModalFullscreenLabel">Supplier Details</h5>
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

		<div class="modal fade" id="EditInvoice" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Edit Invoice</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."edit_invoice",array('target' => '_blank'));?>
					<div class="modal-body">
						<input type="hidden" name="rrno" id="ed_rrno">
						<input type="hidden" name="oldinvno" id="ed_oldinvno">
						<div class="form-group mb-3">
							<label>Invoice</label>
							<input type="text" class="form-control" name="invno" id="ed_newinvno">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit" onclick="return confirm('Do you wish to change Invoice?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ManageReorder" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Manage Reorder Level</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_reorder_level");?>
					<div class="modal-body">
						<input type="hidden" name="code" id="rom_code">
						<input type="hidden" name="dept" id="rom_dept">
						<input type="hidden" name="type" value="medicine">
						<div class="form-group mb-3">
							<label>Description</label>
							<input type="text" class="form-control" name="description" id="rom_description" readonly>
						</div>
						<div class="form-group mb-3">
							<label>Quantity</label>
							<input type="text" class="form-control" name="quantity">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit" onclick="return confirm('Do you wish to update Reorder Level?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ManageReorderSupplies" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-sm modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Manage Reorder Level</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."save_reorder_level");?>
					<div class="modal-body">
						<input type="hidden" name="code" id="ros_code">
						<input type="hidden" name="dept" id="ros_dept">
						<input type="hidden" name="type" value="supplies">
						<div class="form-group mb-3">
							<label>Description</label>
							<input type="text" class="form-control" name="description" id="ros_description" readonly>
						</div>
						<div class="form-group mb-3">
							<label>Quantity</label>
							<input type="text" class="form-control" name="quantity">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit" onclick="return confirm('Do you wish to update Reorder Level?');return false;">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="generateInvoiceReport" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."weekly_invoice_report",array("target" => "_blank"));?>
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Weekly Invoice Report</h5>
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

		<div class="modal fade" id="EditBODPrice" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<?=form_open(base_url()."update_bod_price");?>
					<input type="hidden" name="autono" id="bod_id">
					<input type="hidden" name="code" id="bod_code">
					<div class="modal-header">
						<h5 class="modal-title h5" id="exampleModalSmLabel">Edit Item</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label>Description</label>
							<input type="text" name="description" class="form-control" id="bod_desc">
						</div>
						<div class="form-group mb-3">
							<label>Quantity</label>
							<input type="text" name="quantity" class="form-control" id="bod_quantity">
						</div>
						<div class="form-group mb-3">
							<label>Unit Cost</label>
							<input type="text" name="unitcost" class="form-control" id="bod_unitcost">
						</div>
						<div class="form-group mb-3">
							<label>Discount</label>
							<input type="text" name="discount" class="form-control" id="bod_discount">
						</div>
						<div class="form-group mb-3">
							<label>Lot No</label>
							<input type="text" name="lotno" class="form-control" id="bod_lotno">
						</div>
						<div class="form-group mb-3">
							<label>Expiration</label>
							<input type="date" name="expiration" class="form-control" id="bod_expiration">
						</div>
						<div class="form-group mb-3">
							<label>Unit</label>
							<select name="unit" class="form-select" required id="bod_unit">
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