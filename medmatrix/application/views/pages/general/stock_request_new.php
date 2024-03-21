<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h5 class="fw-bold py-3 mb-0"><?=$title;?></h5>
				</div>
			</div>
		</div> <!-- Row end  -->
		<div class="tab-content">
			<div class="tab-pane fade show active" id="list-view">
				<div class="row clearfix g-3">
					<div class="col-lg-8">
						<div class="card mb-3">
							<div class="card-header">
								<table border="0" style="width:100%">
									<tr>
										<td>Charge To: <b><?=$requesteddept;?></b></td>
										<td>Requesting Department: <b><?=$requestingdept;?></b></td>
									</tr>
									<tr>
										<td>Requesting User: <b><?=$requestinguser;?></b></td>
										<td>Request No.: <b><?=$reqno;?></b></td>
									</tr>
									<tr>
										<td>Transaction Date: <b><?=date('M-d-Y',strtotime($requestingdate));?></b></td>
										<td align="right">
											<?php
											$itemcount=count($requested);
											if($itemcount>0){ ?>
												<a href="<?=base_url();?>stock_request_cancel/<?=$reqno;?>" class='btn btn-outline-danger btn-sm' onclick="return confirm('Do you wish to cancel request?');return false;"><i class='icofont-printer'></i> Cancel</a>
											<?php
												echo "<a href='".base_url()."stock_request_print/$reqno' class='btn btn-outline-success btn-sm' target='_blank'><i class='icofont-printer'></i> Print</a>";
											}
											?>
										</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="card mb-3">
							<div class="card-body">
								<?php
								if($this->session->remove_success){
									?>
									<div class="alert alert-success"><?=$this->session->remove_success;?></div>
								<?php } ?>
								<?php
								if($this->session->remove_failed){
									?>
									<div class="alert alert-danger"><?=$this->session->remove_failed;?></div>
								<?php } ?>
								<table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
									<thead>
									<tr>
										<th>Type</th>
										<th>Description</th>
										<th>Qty</th>
										<th width="3%">Actions</th>
									</tr>
									</thead>
									<tbody>
									<?php
									foreach($requested as $req){
										if($req['approvingofficer']=="EXPENSE"){
											$type1="<span class='badge bg-danger' style='font-size: 16px;'>E</span>";
										}else{
											$type1="<span class='badge bg-success' style='font-size: 16px;'>C</span>";
										}
										if($req['generic']==""){
											$generic="";
										}else{
											$generic="(".$req['generic'].") ";
										}
										echo "<tr>";
										echo "<td>$type1</td>";
										echo "<td>$generic.$req[itemname]</td>";
										echo "<td>$req[prodqty]</td>";
										echo "<td align='center'><a href='".base_url()."remove_item_request/$req[rrdetails]' class='btn btn-outline-secondary deleterow'><i class='icofont-ui-delete text-danger'></i></a></td>";
										echo "</tr>";
									}
									?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card">
							<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
								<h6 class="mb-0 fw-bold ">Search Item</h6>
							</div>
							<div class="card-body">
								<?=form_open(base_url()."requestadditem");?>
									<input type="hidden" name="description" id="selected_item_description">
									<input type="hidden" name="generic" id="selected_item_generic">
									<input type="hidden" name="qty" id="selected_item_quantity">
									<div class="row g-3 mb-3">
										<div class="col-sm-12">
											<label class="form-label">Item Description</label>
											<select class="form-control item" name="code" required id="selected_item">
												<option value="">Select Item</option>
												<?php
												foreach($search_result as $item){
													if($item['generic']==""){
														$generic="";
													}else{
														$generic=" (".$item['generic'].")";
													}
													echo "<option value='$item[code]'>$item[itemname]$generic</option>";
												}
												?>
											</select>
										</div>
										<div class="col-sm-12">
											<label for="depone" class="form-label">Stock on Hand: </label>
											<span class="badge bg-info" id="display_selected_item_quantity" style="font-size: 15px;"></span>
										</div>
									</div>
									<div class="row g-3 mb-3">
										<div class="col-sm-3">
											<label for="deptwo" class="form-label">Requested Qty</label>
											<input type="text" name="quantity" class="form-control text-center" id="reqqty" required>
										</div>
										<div class="col-sm-12">
											<label for="deptwophone" class="form-label">Type: </label>
											<?php
											if($type=="charge"){
												$val="Charge (for patient use)";
											}else{
												$val="Expense (for employee use)";
											}
											?>
											<input type="hidden" name="type" class="form-control" value="<?=$type;?>">
											<b><?=$val;?></b>
											<!-- <select name="type" class="form-select" required>
												<?php												
												//if($requestingdept=="PHARMACY" || $requestingdept=="PHARMACY_OPD" || $requestingdept=="CSR2" || $requestingdept=="OR"){
												?>
													<option value="charge">Charge (for patient use)</option>
												<?php
												//}
												?>
												<option value="EXPENSE">Expense (for employee use)</option>
											</select> -->
										</div>
									</div>
									<button type="submit" class="btn btn-primary mb-2" id="btn_save">Add to List</button>
									<?php
									if($this->session->add_success){
									?>
									<div class="alert alert-success"><?=$this->session->add_success;?></div>
									<?php } ?>
									<?php
									if($this->session->add_failed){
										?>
										<div class="alert alert-danger"><?=$this->session->add_failed;?></div>
									<?php } ?>
								<?=form_close();?>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
