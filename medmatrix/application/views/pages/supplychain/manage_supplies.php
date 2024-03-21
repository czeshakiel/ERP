<script>
	function search_history(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Searching.....";
	}
	function adjust_item(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Validating item.....";
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
								<td align="right"><a href="#" data-bs-toggle="modal" data-bs-target="#AddSupplies" class="btn btn-success btn-sm text-white"><i class="icofont-plus-square"></i> Add New</a></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<div style="position: absolute; left:45%;" align="center"  id="loadermain">
							<div class="spinner-border text-center" style="width: 10rem; height: 10rem;" role="status"></div>
							<h5 id="loaderlabel">Saving.....</h5>
						</div>
						<table id="employee-table" class="table table-hover align-middle mb-0" width="100%">
							<thead>
							<tr>
								<th>Code</th>
								<th>Description</th>
								<th>Type</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($items AS $item){
								$dept=$this->session->dept;
								$desc=str_replace('ams-','',$item['description']);
								$desc=str_replace('-med','',$desc);
								$desc=str_replace('cmshi-','',$desc);
								$desc=str_replace('mak-','',$desc);
								if($item['generic']==""){
									$generic="";
								}else{
									$generic="(".$item['generic'].") ";
								}
								echo "<tr>";
								echo "<td>".$item['code']."</td>";
								echo "<td>".$desc."</td>";
								echo "<td>$item[unit]</td>";
								?>
								<td>
									<a href="#" data-bs-toggle="modal" data-bs-target="#ManageSupplies" data-id="<?=$item['code'];?>" title="Edit Description" class="btn btn-info btn-sm text-white manageSupplies">
										<i class="icofont-edit"></i>
										Edit
									</a>
									<a href="#" class="btn btn-warning btn-sm manageReorderSupplies" data-bs-toggle="modal" data-bs-target="#ManageReorderSupplies" data-id="<?=$item['code'];?>_<?=$desc;?>_<?=$dept;?>">Re-order Level</a>
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
