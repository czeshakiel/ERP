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
		document.getElementById('loaderlabel').innerHTML = "Returning.....";
	}
</script>
<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h5 class="fw-bold mb-0"><?=$title;?></h5>
					<div class="text-right">
						<a href="<?=base_url();?>department_return" class="btn btn-primary btn-sm text-white"><i class="icofont-exit"></i> Close</a>
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
		<?
		 //form_open(base_url()."post_stock_issuance",array('onsubmit' => 'post_receiving();'));
		?>
		<div class="row align-item-center">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<table border="0" cellspacing="1" cellpadding="1" width="100%">
								<tr>
									<td>Request No.: <b><?=$reqno;?></b></td>
								</tr>
								<tr>
									<td>Requested Date: <b><?=date('F d, Y',strtotime($reqdate));?></b></td>
								</tr>
								<tr>
									<td>Requesting User: <b><?=$requser;?></b></td>
								</tr>
							</table>
						</table>
					</div>
					<div class="card-body">
						<div style="position: absolute; left:45%;" align="center"  id="loadermain">
							<div class="spinner-border text-center" style="width: 10rem; height: 10rem;" role="status"></div>
							<h5 id="loaderlabel">Saving.....</h5>
						</div>
						<table class="table">
							<thead>
							<tr>
								<th>Description</th>
								<th>type</th>
								<th><?=$reqdept;?> Stocks</th>
								<th>Requested Qty</th>
								<th>Return Qty</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							foreach ($items as $item){
								$desc=str_replace('ams-','',$item['description']);
								$desc=str_replace('-med','',$desc);
								$desc=str_replace('-sup','',$desc);
								$desc=str_replace('cmshi-','',$desc);
								$soh=$this->Purchase_model->getQtyPharma($item['code'],$reqdept);
								echo "<tr>";
								echo "<td>$desc</td>";
								echo "<td>$item[status]</td>";
								echo "<td>$soh[soh]</td>";
								echo "<td>$item[prodqty]</td>";
								?>
								<?=form_open(base_url()."return_item",array('onsubmit' => 'post_receiving();'));?>
								<input type="hidden" name="rrdetails" value="<?=$item['rrdetails'];?>">
								<input type="hidden" name="reqno" value="<?=$item['reqno'];?>">
								<td><input type="text" name="quantity" class="form-control" style="width:100px;text-align:center;" value="<?=$item['prodqty'];?>"></td>
								<td>
									<button type="submit" class="btn btn-success btn-sm text-white">Return</button>
									<a href="<?=base_url();?>cancel_return_view/<?=$item['rrdetails'];?>/<?=$item['reqno'];?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Do you wish to cancel this item?');return false;">Cancel</a>
								</td>
								<?=form_close();?>

								<?php
								echo "</tr>";
							}
							?>
							</tbody>
						</table>
					</div>
				</div>
				<? //form_close();
				?>
			</div>
		</div><!-- Row end  -->
	</div>
</div>
