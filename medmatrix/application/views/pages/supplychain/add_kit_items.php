<script>
	function search_history(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Adding item.....";
	}
	function remove_item(){
		var act = confirm('Do you wish to remove this item?');
		if(act){
			document.getElementById('loadermain').style.display="block";
			document.getElementById('loaderlabel').innerHTML = "Removing item.....";
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
		<?php
		$description="";
		$unitcost="";
		$phic="";
		$opd="";
		foreach($head as $h){
			$description=$h['description'];
			$unitcost=$h['unitcost'];
			$phic=$h['sellingpricePHIC'];
			$opd=$h['sellingpriceOPD'];
		}
		?>
		<div class="tab-content">
			<div class="tab-pane fade show active" id="list-view">
				<div class="row clearfix g-3">
					<div class="col-lg-8">
						<div class="card mb-3">
							<div class="card-header">
								<table border="0" style="width:100%">
									<tr>
										<td>Code: <b><?=$code;?></b></td>
										<td>Description: <b><?=$description;?></b></td>
									</tr>
									<tr>
										<td>Unit Cost: <b><?=$unitcost;?></b></td>
										<td>OPD Price: <b><?=$opd;?></b></td>
									</tr>
									<tr>
										<td>PHIC Price: <b><?=$phic;?></b></td>
										<td align="right">
											<a href="<?=base_url();?>kit_assembly" class='btn btn-outline-danger btn-sm'><i class='icofont-exit'></i> Close</a>
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
										<td>Code</td>
										<td>Description</td>
										<td align="center">Qty</td>
										<td width="3%">Actions</td>
									</tr>
									<tbody>
									<?php
									$totalamount=0;
									foreach($items AS $item){
										echo "<tr>";
										echo "<td>".$item['productcode']."</td>";
										echo "<td>".$item['productdesc']."</td>";
										echo "<td align='center'>".$item['productqty']."</td>";
										?>
										<td align="center">
											<a href="<?=base_url();?>remove_kit_item/<?=$code;?>/<?=$soh;?>/<?=$item['autono'];?>" class="btn btn-danger btn-sm editItem text-white" title="Remove Item" onclick="return remove_item(); "><i class="icofont-trash"></i></a>
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
					<div class="col-lg-4">
						<div class="card">
							<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
								<h6 class="mb-0 fw-bold ">Search Item</h6>
							</div>
							<div class="card-body">
								<?=form_open(base_url()."add_kit_item",array('onsubmit'=>'search_history();'));?>
								<input type="hidden" name="itemdesc" id="kit_item_description">
								<input type="hidden" name="soh" value="<?=$soh;?>">
								<input type="hidden" name="code" value="<?=$code;?>">
								<div class="row g-3 mb-3">
									<div class="col-sm-12">
										<label class="form-label">Item Description</label>
										<select class="form-control item" name="itemcode" required id="kit_item">
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
										<span class="badge bg-info" id="display_kit_item_quantity" style="font-size: 15px;"></span>
									</div>
								</div>
								<div class="row g-3 mb-3">
									<div class="col-sm-3">
										<label for="deptwo" class="form-label">Qty</label>
										<input type="text" name="quantity" class="form-control text-center" id="reqqty" required>
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
