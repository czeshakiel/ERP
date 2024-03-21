<script>
	function setValue(){
		var itemCount=document.getElementsByClassName('rrdetails');
		var textInput=document.getElementsByClassName('qty');
		for(var i=0 ; i < itemCount.length; i++){
			if(itemCount[i].checked==true){
				textInput[i].value=itemCount[i].value;
			}else{
				textInput[i].value=0;
			}
		}
	}
	function post_receiving(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Issuing.....";
	}
</script>
<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h5 class="fw-bold mb-0"><?=$title;?></h5>
						<div class="text-right">
							<a href="#" class="btn btn-primary btn-sm text-white" onclick="window.close();"><i class="icofont-exit"></i> Close</a>
						</div>
				</div>
			</div>
		</div> <!-- Row end  -->
		<?php if($this->session->save_success){ ?>
			<div class="alert alert-success" role="alert"><?=$this->session->save_success;?></div>
		<?php } ?>
		<?php if($this->session->save_failed){ ?>
			<div class="alert alert-danger" role="alert"><?=$this->session->save_failed;?></div>
		<?php } ?>
		<?php
		if(count($requests)==0){
			echo "<script>window.close();</script>";
		}
		?>
		<?=form_open(base_url()."post_stock_issuance",array('onsubmit' => 'post_receiving();'));?>
		<div class="row align-item-center">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td>
									<div style="float: right;">
										<button type="submit" class="btn btn-success btn-sm text-white" onclick="return confirm('Do you wish to submit issuance? Once submitted, you are not able to undo transaction.');return false;"><i class="icofont-send-mail"></i> Issue</button>
										<a href="<?=base_url();?>cancel_issuance/<?=$reqno;?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Do you wish to cancel this request?'); return false;"><i class="icofont-trash"></i> Cancel</a>
									</div>
									<h4>Requesting Department: <?=$reqdept;?></h4>
									<h4>Request No.: <?=$reqno;?></h4>
								</td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<div style="position: absolute; left:45%;" align="center"  id="loadermain">
							<div class="spinner-border text-center" style="width: 10rem; height: 10rem;" role="status"></div>
							<h5 id="loaderlabel">Saving.....</h5>
						</div>
						<table class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th></th>
								<th>Description</th>
								<th>Reqeusted Qty</th>
								<th>Trantype</th>
								<th>SOH</th>
								<th width="10%">Issued Qty</th>
								<th width="10%">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($requests as $emp){
								$qty=$this->General_model->getQty($emp['code'],$emp['dept']);
								if($qty['quantity'] > $emp['prodqty']){
									$quantity=$emp['prodqty'];
								}else{
									$quantity=$qty['quantity'];
								}
								echo "<tr>";
								echo "<td><input type='checkbox' name='itemqty[]' value='$quantity' class='form-check-input rrdetails' checked onclick='setValue();'></td>";
								echo "<td>$emp[description] ($emp[generic])</td>";
								echo "<td>$emp[prodqty]</td>";
								echo "<td>$emp[approvingofficer]</td>";
								echo "<td>$qty[quantity]</td>";
								echo "<td><input type='text' class='form-control text-center qty' name='issuedqty[]' value='$quantity'></td>";
								?>
								<input type="hidden" name="reqno" value="<?=$reqno;?>">
								<input type="hidden" name="reqdept" value="<?=$reqdept;?>">
								<input type="hidden" name="soh[]" value="<?=$qty['quantity'];?>">
								<input type="hidden" name="rrdetails[]" value="<?=$emp['rrdetails'];?>">
								<td>
									<a href="<?=base_url();?>cancel_stock_issuance/<?=$reqdept;?>/<?=$emp['reqno'];?>/<?=$emp['rrdetails'];?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Do you wish to cancel <?=$emp['description'];?>?');return false;"><i class="icofont-ui-remove"></i> Cancel</a>
								</td>
								<?php
								echo "</tr>";
								$x++;
							}
							?>
							</tbody>
						</table>
					</div>
				</div>
				<?=form_close();?>
			</div>
		</div><!-- Row end  -->
	</div>
</div>
