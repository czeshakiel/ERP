<script>
	function setValue(){
		var itemCount=document.getElementsByClassName('vat');
		var textInput=document.getElementsByClassName('tax');
		for(var i=0 ; i < itemCount.length; i++){
			if(itemCount[i].checked==true){
				textInput[i].value=itemCount[i].value;
			}else{
				textInput[i].value=0;
			}
			save_quantity();
		}
	}
	function save_quantity(){
		document.getElementById("save_qty").click();
		//alert("Submitted");
	}
	function post_receiving(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Posting.....";
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
		<?php
		foreach($purchases as $item){
			$suppliername=$item['supplier'];
			$terms=$item['terms'];
			$reqdept=$item['reqdept'];
		}
		if($invoice['invno'] == ""){
			$preview="style='display:none;'";
		}else{
			$preview="";
		}
		?>
		<div class="tab-content" onblur="self.focus();">
			<div class="tab-pane fade show active" id="list-view">
				<div class="row clearfix g-3">
					<div class="col-lg-12">
						<div class="card mb-3">
							<div class="card-header">
								<table border="0" style="width:100%">
									<tr>
										<td>Supplier: <b><?=$suppliername;?></b> <a href="" class="btn btn-outline-info btn-sm changeSupplier" title="Edit Supplier" data-bs-toggle="modal" data-bs-target="#ManageRRSupplier" data-id="<?=$pono;?>"><i class="icofont-ui-edit"></i> </a> </td>
										<td>Requesting Department: <b><?=$reqdept;?></b></td>
										<td align="right"  style="font-size:11px;">
											<a href="#" class='btn btn-outline-danger btn-sm' onclick="window.close();"><i class='icofont-exit'></i> Close</a>
											<a href="<?=base_url();?>preview_receiving/<?=$pono;?>/<?=$invoice['invno'];?>" class="btn btn-outline-warning btn-sm text-warning" <?=$preview;?> target="_blank" id="preview"><i class="icofont-search"></i> Preview </a>
											<!-- <a href="#" onclick="previewReceiving(<?=$pono;?>,<?=$invoice['invno'];?>);" class="btn btn-outline-warning btn-sm text-warning" <?=$preview;?> id="preview"><i class="icofont-search"></i> Preview </a> -->
										</td>
										<td width="15%">
											<?=form_open(base_url()."post_receiving",array('onsubmit' => 'post_receiving();'));?>
											<input type="hidden" name="pono" value="<?=$pono;?>">
											<input type="hidden" name="invno" value="<?=$invoice['invno'];?>">
											<button type="submit" class="btn btn-outline-success btn-sm" onclick="return confirm('Do you wish to post receiving? You cannot undo once submitted.');return false;"><i class="icofont-send-mail"></i> Post Receiving</button>
										</td>
									</tr>
									<tr>
										<td>Terms: <b><?=$terms;?></b></td>
										<td>P.O. No.: <b><?=$pono;?></b></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>Invoice Date: <input type="date" name="invdate" class="form-control" style="width: 200px;" value="<?=date('Y-m-d');?>"></td>
										<td>Invoice:
											<input type="hidden" name="pono" value="<?=$pono;?>" id="pono"> <div class="spinner-border text-center" style="width: 1rem; height: 1rem;" role="status" id="loader"></div>
											<input type="text" name="invno" class="form-control" style="width: 200px;" value="<?=$invoice['invno'];?>" id="save_invoice">
										</td>
										<td>
											PO Branch:
											<select name="chargeto" class="form-control">
												<option value="">Select Branch</option>
												<option value="AMSHI">AMSHI</option>
												<option value="MMSHI">MMSHI</option>
												<option value="CMSHI">CMSHI</option>
												<option value="MMHI">MMHI</option>
											</select>
										</td>
										<?=form_close();?>
										<td></td>
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
								<div style="position: absolute; left:45%;" align="center"  id="loadermain">
									<div class="spinner-border text-center" style="width: 10rem; height: 10rem;" role="status"></div>
									<h5 id="loaderlabel">Saving.....</h5>
								</div>
								<table class="table table-hover align-middle mb-0">
									<thead>
									<tr style="font-weight: bold;">
										<td style="font-size:11px;">Description</td>
										<td align="center" style="font-size:11px;">Unit</td>
										<td align="center" style="font-size:11px;">Type</td>
										<td align="center" style="font-size:11px;">Req. Qty</td>
										<td align="right"  style="font-size:11px;">Unitcost</td>
										<td align="right"  style="font-size:11px;">Discount</td>
										<td align="center" style="font-size:11px;" width="10%">Rec Qty</td>
										<td align="center" style="font-size:11px;">Lot No</td>
										<td align="center" style="font-size:11px;">Vat?</td>
										<td align="right"  style="font-size:11px;">Tax</td>
										<td align="left" style="font-size:11px;">Expiration</td>
										<td width="3%" style="font-size:11px;">Actions</td>
									</tr>
									</thead>
									<tbody>
									<form action="" id="save_quantity" method="POST">
									<?php
									$totalamount=0;
									foreach($purchases AS $item){
										$desc=str_replace('ams-','',$item['description']);
										$desc=str_replace('-med','',$desc);
										$desc=str_replace('-sup','',$desc);
										if($item['vat']=="" || $item['vat']==0){
											$vat=0;
											$checked="";
										}else{
											$vat=$item['vat'];
											$checked="checked";
										}
										if($item['unitcost']==$item['prodtype1'] || $item['prodtype1'] == 0){
											$uprice=0;
											$tax=($item['unitcost'])*.12;
										}else{
											$uprice=$item['prodtype1'];
											$tax=($uprice)*.12;
										}
										if($item['generic']==""){
											$generic="";
										}else{
											$generic="(".$item['generic'].")<br>";
										}
										$fg="";
										if($item['trantype']=="FREE GOODS"){
											$fg="style='display:none;'";
										}
										?>
										<input type="hidden" name="rrdetails[]" value="<?=$item['rrdetails'];?>">
										<?php
										echo "<tr>";
										echo "<td width='15%' style='font-size:11px;'>".$generic.$desc."</td>";
										echo "<td align='center' width='5%' style='font-size:11px;'>".$item['unit']."</td>";
										echo "<td align='center' width='5%' style='font-size:11px;'>".$item['trantype']."</td>";
										echo "<td align='center' width='5%' style='font-size:11px;'>".$item['prodqty']."</td>";
										echo "<td align='right' width='5%' style='font-size:11px;'>".number_format($item['unitcost'],2)."</td>";
										echo "<td align='right' width='5%' style='font-size:11px;'>".number_format($item['prodtype1'],2)."</td>";
										echo "<td align='center' width='5%'><input type='text' name='recqty[]' class='form-control text-center' onchange='save_quantity();' value='$item[quantity]'></td>";
										echo "<td align='center' width='18%'><input type='text' name='lotno[]' class='form-control text-center' onchange='save_quantity();' value='$item[lotno]'></td>";
										echo "<td align='center' width='2%'><input type='checkbox' name='vat[]' class='form-check-input vat' $checked value='$tax' onclick='setValue()'></td>";
										echo "<td align='right' width='8%'><input type='text' name='tax[]' class='form-control tax' style='text-align: right;' value='$item[vat]'></td>";
										echo "<td align='right' width='7%'><input type='date' name='expiration[]' class='form-control text-center' onchange='save_quantity();' value='$item[expiration]'></td>";
										?>
										<td align="center" width="5%">
											<a href="#" class="editReceiveItem text-info" data-bs-toggle="modal" data-bs-target="#EditItemReceive" data-id="<?=$item['rrdetails'];?>_<?=$pono;?>" title="Edit Item"><i class="icofont-edit-alt"></i></a>
											<a href="#" class="addfreegoodsreceiving text-success" data-bs-toggle="modal" <?=$fg;?> data-bs-target="#ReceivingAddFreeGoods" data-id="<?=$item['rrdetails'];?>_<?=$pono;?>" title="Add Free Goods"><i class="icofont-plus-square"></i> </a>
											<a href="#" class="addbatchreceiving text-primary" data-bs-toggle="modal" <?=$fg;?> data-bs-target="#ReceivingAddBatch" data-id="<?=$item['rrdetails'];?>_<?=$pono;?>" title="Add Batch"><i class="icofont-plus-square"></i> </a>
										</td>
										<?php
										echo "</tr>";
									}
									?>
										<input type="submit" name="submit" id="save_qty" style="display: none;">
									</form>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
	function previewReceiving(po,invno){
		window.open('<?=base_url();?>preview_receiving/' + po + '/' + invno, '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=0,width=1250,height=1000');
						  }
</script>