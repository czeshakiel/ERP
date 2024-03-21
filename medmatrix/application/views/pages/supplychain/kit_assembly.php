<script>
	function search_history(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Searching.....";
	}
	function update_item(){
		document.getElementById('loaderupdate1').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Submitting item.....";
	}
	function add_item(){
		document.getElementById('loaderupdate2').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Submitting item.....";
	}
</script>
<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h4 class="fw-bold mb-0"><?=$title;?></h4>
				</div>
			</div>
		</div> <!-- Row end  -->
		<?php
		if($this->session->success){
			?>
			<div class="alert alert-success"><?=$this->session->success;?></div>
			<?php
		}
		?>
		<?php
		if($this->session->failed){
			?>
			<div class="alert alert-danger"><?=$this->session->danger;?></div>
			<?php
		}
		?>
		<div class="row align-item-center">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td>List of Items</td>
								<td align="right"><a href="#" data-bs-toggle="modal" data-bs-target="#ManageKitAssembly" class="btn btn-success btn-sm text-white addKit"><i class="icofont-plus-square"></i> Add New</a></td>
								<?=form_open(base_url()."search_kit_assembly",array('onsubmit' => 'search_history();'));?>
								<td width="15%"><input type="text" name="description" class="form-control" placeholder="Search Kit Here..."></td>
								<td width="5%"><input type="submit" class="btn btn-primary" value="Search"></td>
								<?=form_close();?>
								<td width="5%"><a href="<?=base_url();?>kit_assembly" class="btn btn-info text-white">Refresh</a></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<div style="position: absolute; left:45%;" align="center"  id="loadermain">
							<div class="spinner-border text-center" style="width: 10rem; height: 10rem;" role="status"></div>
							<h5 id="loaderlabel">Saving.....</h5>
						</div>
						<table class="table table-hover align-middle mb-0" width="100%">
							<thead>
							<tr>
								<th>code</th>
								<th>Description</th>
								<th>Items</th>
								<th>Unitcost</th>
								<th>Selling Price</th>
								<th>SOH</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($items AS $item){
								$desc=str_replace('ams-','',$item['description']);
								$desc=str_replace('-sup','',$desc);
								$kititems=$this->Purchase_model->getAllKitItems($item['code']);
								$allitems="";
								$citem=0;
								foreach($kititems as $kitems){
									$desc1=str_replace('ams-','',$kitems['productdesc']);
									$desc1=str_replace('-sup','',$desc1);
									$allitems .=$kitems['productqty']." - ".$desc1."<br>";
									$citem++;
								}
								$qty=$this->Purchase_model->getQty($item['code'],$this->session->dept);
								if($citem>0){
									$view="";
								}else{
									$view="style='display:none;'";
								}
								echo "<tr>";
								echo "<td>".$item['code']."</td>";
								echo "<td>".$desc."</td>";
								echo "<td>".$allitems."</td>";
								echo "<td align='right'>".number_format($item['unitcost'],2)."</td>";
								echo "<td align='right'>PHIC: ".number_format($item['philhealth'],2)."<br>OPD: ".number_format($item['nonmed'],2)."</td>";
								echo "<td align='center'>".$qty['soh']."</td>";
								?>
								<td>
									<a href="#" data-bs-toggle="modal" data-bs-target="#ManageKitAssembly" data-id="<?=$item['code'];?>" class="btn btn-info text-white editKit btn-sm">
										<i class="icofont-ui-edit"></i>
										Edit
									</a>
									<a href="<?=base_url();?>add_kit_items/<?=$item['code'];?>/<?=$qty['soh'];?>" class="btn btn-warning btn-sm text-white">
										<i class="icofont-ui-add"></i>
										Add Items
									</a>
									<a href="#" class="btn btn-success btn-sm text-white AddKitQuantity" data-bs-toggle="modal" data-bs-target="#AddKitQty" data-id="<?=$item['code'];?>_<?=$desc;?>" <?=$view;?>>
										<i class="icofont-plus-square"></i>
										Add Qty
									</a>
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
			</div>
		</div><!-- Row end  -->
	</div>
</div>
