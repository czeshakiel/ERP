<script>
	function remove_item(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Removing.....";
	}
	function add_item(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Adding Item.....";
	}
	function update_item(){
		document.getElementById('loaderupdate').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Updating.....";
	}
	function post_item(){
		var post = confirm("Do you wish to submit transaction? Once submitted, you are not able to revert the transaction.");
		if(post){
			document.getElementById('loadermain').style.display="block";
			document.getElementById('loaderlabel').innerHTML = "Posting.....";
			return true;
		}else{
			return false;
		}

	}
</script>
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
										<td>Supplier: <b><?=$department;?></b></td>
										<td>Requesting Branch: <b><?=$branch;?></b></td>
									</tr>
									<tr>
										<td>Transaction Date: <b><?=$transdate;?></b></td>
										<td>Slip No.: <b><?=$invno;?></b></td>
									</tr>
									<tr>
										<td></td>
										<td align="right">
											<a href="<?=base_url();?>stock_transfer" class='btn btn-outline-danger btn-sm'><i class='icofont-exit'></i> Close</a>
											<?php
											$itemcount=count($items);
											$isid=0;
											if($itemcount>0){
												?>
												<a href="<?=base_url();?>preview_transfer/<?=$invno;?>" class="btn btn-outline-info btn-sm" target="_blank"><i class="icofont-search-restaurant"></i> Preview</a>
												<a href="<?=base_url();?>post_transfer/<?=$invno;?>" class="btn btn-outline-success btn-sm" onclick="post_item();"><i class="icofont-send-mail"></i> Post Transfer</a>
												<?php
											}else{
												//$isid++;
												?>
												<a href="<?=base_url();?>print_transfer/<?=$invno;?>" class="btn btn-outline-info btn-sm" target="_blank"><i class="icofont-search-restaurant"></i> Print Charge Slip</a>
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
								<div style="position: absolute; left:45%;" align="center"  id="loadermain">
									<div class="spinner-border text-center" style="width: 10rem; height: 10rem;" role="status"></div>
									<h5 id="loaderlabel">Saving.....</h5>
								</div>
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
										<td align="center" width="4%">Qty</td>
										<td align="center" width="4%">Unit</td>
										<td>Description</td>
										<td align="center" width="5%">Lot No</td>
										<td align="center" width="5%">Expiration</td>
										<td align="right" width="5%">Unitcost</td>
										<td align="right" width="5%">Total</td>
										<td width="3%">Actions</td>
									</tr>
									<tbody>
									<?php
									$totalamount=0;
									foreach($items AS $item){
										$desc=str_replace('ams-','',$item['description']);
										$desc=str_replace('-med','',$desc);
										$desc=str_replace('-sup','',$desc);
											$total=($item['unitcost']*$item['quantity']);
											$proditem=0;
										$totalamount +=$total;
										if($item['generic']==""){
											$generic="";
										}else{
											$generic="(".$item['generic'].")<br>";
										}
										echo "<tr>";
										echo "<td align='center'>".$item['quantity']."</td>";
										echo "<td align='center'>".$item['paymentstatus']."</td>";
										echo "<td>".$generic.$desc."</td>";
										echo "<td align='center'>".$item['lotno']."</td>";
										echo "<td align='center'>".date('m/d/Y',strtotime($item['expiration']))."</td>";
										echo "<td align='right'>".number_format($item['unitcost'],2)."</td>";
										echo "<td align='right'>".number_format($total,2)."</td>";
										?>
										<td align="center">
											<a href="#" class="btn btn-info btn-sm editTransferItem text-white" data-bs-toggle="modal" data-bs-target="#EditItemTransfer" data-id="<?=$item['autono'];?>" title="Edit Item"><i class="icofont-edit-alt"></i></a>
											<a href="<?=base_url();?>remove_transfer_item/<?=$item['autono'];?>" class="btn btn-danger btn-sm editItem text-white" title="Remove Item" onclick="remove_item(); return confirm('Do you wish to remove this item?');return false;"><i class="icofont-trash"></i></a>
										</td>
										<?php
										echo "</tr>";
									}
									?>
									<tr>
										<td colspan="6" align="right">TOTAL</td>
										<td align="right"><?=number_format($totalamount,2);?></td>
										<td></td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<?php
					if($isid > 0){
						$view="disabled";
					}else{
						$view="";
					}
					?>
					<div class="col-lg-4">
						<div class="card">
							<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
								<h6 class="mb-0 fw-bold ">Search Item</h6>
							</div>
							<div class="card-body">
								<?=form_open(base_url()."transferadditem",array('onsubmit' => 'add_item();'));?>
								<input type="hidden" name="description" id="transfer_item_description">
								<input type="hidden" name="qty" id="transfer_item_quantity">
								<div class="row g-3 mb-3">
									<div class="col-sm-12">
										<label class="form-label">Item Description</label>
										<select class="form-control item" name="code" required id="transfer_item">
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
										<span class="badge bg-info" id="display_transfer_item_quantity" style="font-size: 15px;"></span>
									</div>
									<div class="col-sm-4">
										<label for="depone" class="form-label">Unit Cost: </label>
										<input type="text" class="form-control" style="text-align: right;" name="unitcost" id="transfer_unitcost">
									</div>
									<div class="col-sm-4">
										<label for="depone" class="form-label">Discount: </label>
										<input type="text" class="form-control" style="text-align: right;" name="discount" id="transfer_discount">
									</div>
									<div class="col-sm-4">
										<label for="depone" class="form-label">Lot No: </label>
										<input type="text" class="form-control" style="text-align: right;" name="lotno" id="transfer_lotno">
									</div>
									<div class="col-sm-4">
										<label for="deptwo" class="form-label">Expiration</label>
										<input type="date" name="expiration" class="form-control" id="transfer_expiration" required>
									</div>
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
								</div>																	
								
								<button type="submit" class="btn btn-primary mb-2" id="btn_save" <?=$view;?>>Add to List</button>
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
