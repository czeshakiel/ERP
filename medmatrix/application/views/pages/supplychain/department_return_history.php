<script>
	function search_history(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Searching.....";
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
		<?php if($this->session->save_success){ ?>
			<div class="alert alert-success" role="alert"><?=$this->session->save_success;?></div>
		<?php } ?>
		<?php if($this->session->save_failed){ ?>
			<div class="alert alert-danger" role="alert"><?=$this->session->save_failed;?></div>
		<?php } ?>
		<div class="row align-item-center">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h4>Item Return List</h4></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<div style="position: absolute; left:45%;" align="center"  id="loadermain">
							<div class="spinner-border text-center" style="width: 10rem; height: 10rem;" role="status"></div>
							<h5 id="loaderlabel">Saving.....</h5>
						</div>
						<table id="employee-table" class="table" width="100%">
							<thead>
							<tr>
								<th>Return ID</th>
								<th>Department</th>
								<th>Returned Date</th>
								<th>Requesting User</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							foreach($items as $item){
								echo "<tr>";
								echo "<td>$item[reqno]</td>";
								echo "<td>$item[dept]</td>";
								echo "<td>".date('M-d-Y',strtotime($item['reqdate']))."</td>";
								echo "<td>$item[requser]</td>";
								?>
								<td align="center"><a href="<?=base_url();?>return_print/<?=$item['reqno'];?>" class="btn btn-success btn-sm text-white" target="_blank"><i class="icofont-printer"></i> Print</a></td>
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
