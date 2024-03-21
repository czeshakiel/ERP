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
										<td>Supplier: <b><?=$suppliername;?></b></td>
										<td>Requesting Department: <b><?=$reqdept;?></b></td>
									</tr>
									<tr>
										<td>Terms: <b><?=$terms;?></b></td>
										<td>Invoice No.: <b><?=$invno;?></b></td>
									</tr>
									<tr>
										<td>Invoice Date: <b><?=date('M-d-Y',strtotime($invdate));?></b></td>
										<td align="right">
											<a href="#" onclick="window.close();" class='btn btn-outline-danger btn-sm'><i class='icofont-exit'></i> Close</a>
											<?php
											$itemcount=count($items);
											if($itemcount>0){ ?>
													<a href="<?=base_url();?>preview_manual_receiving/<?=$invno;?>" class="btn btn-outline-info btn-sm" target="_blank"><i class="icofont-search-restaurant"></i> Preview</a>
												<a href="<?=base_url();?>post_manual_receiving/<?=$invno;?>" class="btn btn-outline-success btn-sm" onclick="return confirm('Do you wish to submit transaction? Once submitted, you are not able to revert the transaction.');return false;"><i class="icofont-send-mail"></i> Post Receiving</a>
												<?php
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
								<table id="employee-table" class="table table-hover align-middle mb-0">
									<tr style="font-weight: bold;">
										<td>Description</td>
										<td align="center">Unit</td>
										<td align="center">Qty</td>
										<td align="center">Expiration</td>
										<td align="right">Unitcost</td>
										<td align="right">Discount</td>
										<td align="center">Vat</td>
										<td align="right">Total</td>
										<td width="3%">Actions</td>
									</tr>
									<tbody>
									<?php
									$totalamount=0;
									foreach($items AS $item){
										$desc=str_replace('ams-','',$item['description']);
										$desc=str_replace('-med','',$desc);
										$desc=str_replace('-sup','',$desc);
										if($item['prodtype1']=="0"){
											$total=($item['unitcost']*$item['quantity']);
											$proditem=0;
										}else{
											$total=$item['quantity']*$item['prodtype1'];
											$proditem=$item['prodtype1'];
										}
										if($item['vat']>0){
											$total = $total/1.12;
										}
										$totalamount +=$total;
										if($item['generic']==""){
											$generic="";
										}else{
											$generic="(".$item['generic'].")<br>";
										}
										echo "<tr>";
										echo "<td>".$generic.$desc."</td>";
										echo "<td align='center'>".$item['unit']."</td>";
										echo "<td align='center'>".$item['quantity']."</td>";
										echo "<td align='center'>".$item['expiration']."</td>";
										echo "<td align='right'>".number_format($item['unitcost'],2)."</td>";
										echo "<td align='right'>".number_format($proditem,2)."</td>";
										echo "<td align='right'>".$item['stockalert']."</td>";
										echo "<td align='right'>".number_format($total,2)."</td>";
										?>
										<td align="center">
											<a href="#" class="btn btn-info btn-sm editManualItem text-white" data-bs-toggle="modal" data-bs-target="#EditItemManual" data-id="<?=$item['isid'];?>" title="Edit Item"><i class="icofont-edit-alt"></i></a>
											<a href="<?=base_url();?>remove_manual_item/<?=$item['isid'];?>" class="btn btn-danger btn-sm editItem text-white" title="Remove Item" onclick="return confirm('Do you wish to remove this item?');return false;"><i class="icofont-trash"></i></a>
										</td>
										<?php
										echo "</tr>";
									}
									?>
									<tr>
										<td colspan="7" align="right">TOTAL</td>
										<td align="right"><?=number_format($totalamount,2);?></td>
										<td></td>
									</tr>
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
								<?=form_open(base_url()."manualpoadditem");?>
								<input type="hidden" name="description" id="requested_item_description">
								<input type="hidden" name="qty" id="requested_item_quantity">
								<div class="row g-3 mb-3">
									<div class="col-sm-12">
										<label class="form-label">Item Description</label>
										<select class="form-control item" name="code" required id="requested_item">
											<option value="">Select Item</option>
											<?php
											foreach ($itemdept as $item){
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
										<span class="badge bg-info" id="display_requested_item_quantity" style="font-size: 15px;"></span>
									</div>
									<div class="col-sm-4">
										<label for="depone" class="form-label">Unit Cost: </label>
										<input type="text" class="form-control" style="text-align: right;" name="unitcost" id="requested_unitcost">
									</div>
									<div class="col-sm-4">
										<label for="depone" class="form-label">Discount: </label>
										<input type="text" class="form-control" style="text-align: right;" name="discount" id="requested_discount">
									</div>
									<div class="col-sm-4">
										<label for="deptwo" class="form-label">Expiration</label>
										<input type="date" name="expiration" class="form-control" id="reqqty" required>
									</div>
								</div>
								<div class="row g-3 mb-3">
									<div class="col-sm-3">
										<label for="deptwo" class="form-label">Requested Qty</label>
										<input type="text" name="quantity" class="form-control text-center" id="reqqty" required>
									</div>
									<div class="col-sm-3">
										<label for="deptwo" class="form-label">Unit</label>
										<select name="unit" class="form-select">
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
									<div class="col-sm-2 text-center">
										<label class="form-check-label">Vat?</label><br>
										<input type="checkbox" name="vat" class="form-control-sm" value="Yes">
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
