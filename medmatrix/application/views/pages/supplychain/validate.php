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
								<?=form_open(base_url()."search_validate",array('onsubmit' => 'search_history();'));?>
								<td align="right" width="300">
									<input type="text" name="searchme" class="form-control" placeholder="Search item description....">
								</td>
								<td width="150" align="right">
									<input type="submit" class="btn btn-success text-white" value="Search">
									<a href="<?=base_url();?>validate" class="btn btn-primary">Back</a>
								</td>
								<?=form_close();?>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<div style="position: absolute; left:45%;" align="center"  id="loadermain">
							<div class="spinner-border text-center" style="width: 10rem; height: 10rem;" role="status"></div>
							<h5 id="loaderlabel">Saving.....</h5>
						</div>
						<table class="table table-bordered">
							<thead>
							<tr>
								<th>no.</th>
								<th>Description</th>
								<th>Expiry Date</th>
								<th>SOH</th>
								<th>Unit Cost</th>
								<th>Quantity</th>
								<th>ACtion</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($items AS $item){
								$desc=str_replace('ams-','',$item['description']);
								$desc=str_replace('-med','',$desc);
								if($item['generic']==""){
									$generic="";
								}else{
									$generic="<font color='red'>(".$item['generic'].") </font>";
								}
								echo "<tr>";
								echo "<td>".$x.".</td>";
								echo "<td>".$desc.$generic."</td>";
								echo "<td>".$item['expiration']."</td>";
								echo "<td>".$item['quantity']."</td>";
								echo "<td align='center'>".$item['unitcost']."</td>";
								?>
								<?=form_open(base_url()."validate_save",array('onsubmit' => 'adjust_item();'));?>
								<input type="hidden" name="expiration" value="<?=$item['expiration'];?>">
								<input type="hidden" name="code" value="<?=$item['code'];?>">
								<input type="hidden" name="soh" value="<?=$item['quantity'];?>">
								<input type="hidden" name="unitcost" value="<?=$item['unitcost'];?>">
								<td align='center'><input type='text' name='quantity' class='form-control' style='width:100px; text-align:center;' value='<?=$item['quantity'];?>'></td>
								<td align='center'><input type="submit" name="submit" value="Validate" class="btn btn-primary"></td>
								<?=form_close();?>
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
