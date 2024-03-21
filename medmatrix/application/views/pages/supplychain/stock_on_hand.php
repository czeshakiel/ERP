<script>
	function search_history(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Searching. Please wait.....";
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
		<div class="row align-item-center">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h5><?=$subtitle;?></h5></td>
								<?=form_open(base_url()."search_stock_on_hand",array('onsubmit' => 'search_history();'));?>
								<td align="right" width="300">
									<input type="text" name="searchme" class="form-control" placeholder="Search item description....">
								</td>
								<td width="150" align="right">
									<input type="submit" class="btn btn-success text-white" value="Search">
									<a href="<?=base_url();?>stock_on_hand" class="btn btn-primary">Back</a>
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
						<table class="table table-vcenter card-table table-striped">
							<thead>
							<tr>
								<th>Description</th>
								<th>Department</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($items AS $item){
								// $desc=str_replace('ams-','',$item['description']);
								// $desc=str_replace('-sup','',$desc);
								$department=$this->Purchase_model->getSingleDepartment($item['code']);
								$arr_dept="";
								foreach($department as $dept){
									$soh=$this->Purchase_model->getSingleQty($item['code'],$dept['dept']);
									$arr_dept .=$dept['dept']." : ".$soh['soh']."<br>";
								}
								if($item['generic']==""){
									$generic="";
								}else{
									$generic="<font color='red'>(".$item['generic'].") </font>";
								}
								echo "<tr>";
								echo "<td>".$generic.$item['itemname']."</td>";
								echo "<td>".$arr_dept."</td>";
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
