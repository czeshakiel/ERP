<script>
	function search_item(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Searching.....";
	}
	function add_item(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Adding Item.....";
	}
	function remove_item(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Removing item.....";
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
					<div class="col-lg-6">
						<div class="card mb-3">
							<div class="card-header">
								<table border="0" style="width:100%">
									<tr>
										<td>Supplier: <b><?=$suppliername;?></b></td>
										<td>Department: <b><?=$department;?></b></td>
										<td></td>
									</tr>
									<tr>
										<td>Transaction Date: <b><?=$transdate;?></b></td>
										<td>SLIP No.: <b><?=$invno;?></b></td>
										<td align="right">
											<a href="<?=base_url();?>return_to_supplier" class='btn btn-outline-danger btn-sm'><i class='icofont-exit'></i> Close</a>
											<?php
											$itemcount=count($items);
											if($itemcount>0){ ?>
												<a href="<?=base_url();?>preview_return/<?=$invno;?>" class="btn btn-outline-info btn-sm" target="_blank"><i class="icofont-search-restaurant"></i> Preview</a>
												<a href="<?=base_url();?>postreturnsupplier" class="btn btn-outline-success btn-sm" onclick="return confirm('Do you wish to submit transaction? Once submitted, you are not able to revert the transaction.');return false;"><i class="icofont-send-mail"></i> Post</a>
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
								<table class="table">
									<thead>
									<tr>
										<td align="center">Qty</td>
										<td align="center">Unit</td>
										<td>Description</td>
										<td align="right">Lot No</th>
										<td align="center">Expiration Date</td>
										<td align="right">Unit Cost</th>
										<td align="right">Total Amount</th>
										<td>Action</td>
									</tr>
									</thead>
									<tbody>
									<?php
									foreach($items AS $item){
										$desc=str_replace('ams-','',$item['description']);
										$desc=str_replace('-med','',$desc);
										$desc=str_replace('-sup','',$desc);
										$total=($item['unitcost']*$item['quantity']);
										echo "<tr>";
										echo "<td align='center'>".$item['quantity']."</td>";
										echo "<td align='center'>".$item['paymentstatus']."</td>";
										echo "<td>".$desc."</td>";
										echo "<td align='center'>".$item['lotno']."</td>";
										echo "<td align='center'>".$item['expiration']."</td>";
										echo "<td align='right'>".number_format($item['unitcost'],2)."</td>";
										echo "<td align='right'>".number_format($total,2)."</td>";
										?>
										<td align="center">
											<a href="<?=base_url();?>returnremoveitem/<?=$item['autono'];?>" class="btn btn-danger btn-sm text-white" onclick="remove_item();"><i class="icofont-trash"></i> </a>
										</td>
										<?php
										echo "</tr>";
									}
									?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="card">
							<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
								<h6 class="mb-0 fw-bold ">Search Item</h6>
							</div>
							<div class="card-body">
								<div class="row g-3 mb-3">
								<?=form_open(base_url()."manage_return_search",array('onsubmit' => 'search_item();'));?>
									<input type="hidden" name="suppliercode" value="<?=$suppliercode;?>">
								<div class="col-sm-12">
									<label class="form-label">Item Description</label>
									<input type="text" name="description" class="form-control" required placeholder="Search description here and press <enter> key">
								</div>
								<?=form_close();?>
								</div>
								<?php
								if ($searchresult != ""){
									?>
								<table class="table" style="font-size:12px;" cellpadding="1" cellspacing="0" >
									<tr>
										<td>Description</td>
										<td align="center">RecQty</td>
										<td align="center">SOH</td>
										<td align="center">LotNo</td>
										<td align="right">Expiration</td>
										<td align="center">Qty</td>
										<td></td>
									</tr>
								<?php
								foreach($searchresult as $row){
									$soh=$this->Purchase_model->getQtyReturn($row['code'],$this->session->dept,$row['rrno']);
									if($soh['soh'] > 0){
										$stat="";
									}else{
										$stat="disabled";
									}
									if($row['generic']==""){
										$generic="";
									}else{
										$generic="(".$row['generic'].") ";
									}
									echo "<tr>";
									echo "<td>".$generic.$row['itemname']."</td> ";
									echo "<td align='center'>".$row['prodqty']."</td>";
									echo "<td align='center'>".$soh['soh']."</td>";
									?>
									<?=form_open("returnadditem",array('onsubmit' => 'add_item();'));?>
									<input type="hidden" name="code" value="<?=$row['code'];?>">
									<input type="hidden" name="description" value="<?=$row['itemname'];?>">
									<input type="hidden" name="rrno" value="<?=$row['rrno'];?>">
									<input type="hidden" name="suppliercode" value="<?=$suppliercode;?>">
									<input type="hidden" name="suppliername" value="<?=$suppliername;?>">
									<input type="hidden" name="unitcost" value="<?=$row['unitcost'];?>" style="width:70px; text-align:right;">
									<td align='center'><input type="hidden" name="lotno" style="width:90px; text-align:center;" value="<?=$row['lotno'];?>"><?=$row['lotno'];?></td>
									<td align='right'><input type="hidden" name="expiration" style="width:90px; text-align:right;" value="<?=$row['expiration'];?>"><?=date('m/d/Y',strtotime($row['expiration']));?></td>
									<td align="center"><input type="text" name="quantity" class="form-control" style="width:60px; text-align:center;" required></td>
									<td><input type="submit" name="submit" value="Select" <?=$stat;?> class="btn btn-info btn-sm text-white"></td>
									<?=form_close();?>
									<?php
									echo "</tr>";
								}
								?>
								</table>
									<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
