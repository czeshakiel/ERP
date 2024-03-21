<script>
	function search_history(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Searching.....";
	}
	function adjust_item(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Adjusting quantity.....";
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
								<?=form_open(base_url()."search_adjusting_entry",array('onsubmit' => 'search_history();'));?>
								<td align="right" width="300">
									<input type="text" name="searchme" class="form-control" placeholder="Search item description....">
								</td>
								<td width="150" align="right">
									<input type="submit" class="btn btn-success text-white" value="Search">
									<a href="<?=base_url();?>adjusting_entry" class="btn btn-primary">Back</a>
								</td>
								<?=form_close();?>
							</tr>
						</table>
						<table border="0" width="100%">
							<tr>
								<td>Department: <b><?=$this->session->dept;?></b></td>
							</tr>
							<tr>
								<td>Adjustment Date: <b><?=date('F d, Y');?></b></td>
							</tr>
							<tr>
								<td>User: <b><?=$this->session->user_name;?></b></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<div style="position: absolute; left:45%;" align="center"  id="loadermain">
							<div class="spinner-border text-center" style="width: 10rem; height: 10rem;" role="status"></div>
							<h5 id="loaderlabel">Saving.....</h5>
						</div>
						<table class="table table-vcenter card-table table-striped">
							<thead>
							<tr>
								<th>code</th>
								<th>Description</th>
								<th align='center'>SOH</th>
								<th align='center'>QTY</th>
								<th align='center'>REASON</th>
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
								$desc=str_replace('mak-','',$desc);
								if($item['generic']==""){
									$generic="";
								}else{
									$generic="(".$item['generic'].") ";
								}
								echo "<tr>";
								echo "<td>$item[code]</td>";
								echo "<td>$generic$desc</td>";
								echo "<td>$item[soh]</td>";
								?>
								<?=form_open(base_url()."adjust_item",array('onsubmit' => 'adjust_item();'));?>
								<input type="hidden" name="code" value="<?=$item['code'];?>">
								<input type="hidden" name="prevqty" value="<?=$item['soh'];?>">
								<td><input type="text" class="form-control" name="quantity" style="width:100px;"></td>
								<td>
									<select name="reason" class="form-control">
										<?php
										foreach($reasons as $reason){
											echo "<option value='$reason[comment]'>$reason[comment]</option>";
										}
										?>
									</select>
								</td>
								<td><button type="submit" class="btn btn-primary btn-md">Adjust</button></td>
								<?=form_close();?>
								<?php
								echo "</tr>";
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
