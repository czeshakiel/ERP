<script>
	function search_history(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Generating.....";
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
			<div class="col-md-3">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h5>Select Date Range</h5></td>
							</tr>
						</table>
					</div>
					<div style="position: absolute; left:25%;" align="center"  id="loadermain">
						<div class="spinner-border text-center" style="width: 10rem; height: 10rem;" role="status"></div>
						<h5 id="loaderlabel">Saving.....</h5>
					</div>
					<?=form_open(base_url()."view_adjustment_history",array('onsubmit' => 'search_history();'));?>
					<div class="card-body">
						<div class="form-group mb-3">
							<label>Start Date</label>
							<input type="date" name="startdate" class="form-control" required>
						</div>
						<div class="form-group mb-3">
							<label>End Date</label>
							<input type="date" name="enddate" class="form-control" required>
						</div>
						<div class="form-group mb-3">
							<input type="submit" name="submit" class="btn btn-success text-white" value="View">
						</div>
					</div>
					<?=form_close();?>
				</div>
			</div>
			<div class="col-md-9">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h5><?=$subtitle;?></h5></td>
								<td align="right"><a href="<?=base_url();?>adjustment_history" class="btn btn-primary" <?=$view;?> onclick="search_history();">Back</a></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table class="table" style="font-size: 10px;">
							<thead>
							<tr>
								<th>Date</th>
								<th>Code</th>
								<th>Description</th>
								<th>Original Quantity</th>
								<th>Adjusted Quantity</th>
								<th>Reason</th>
								<th>Adjusted By</th>
							</tr>
							</thead>
							<tbody>
							<?php
							foreach($items as $item){
								$desc=str_replace('ams-','',$item['description']);
								$desc=str_replace('-med','',$desc);
								$desc=str_replace('-sup','',$desc);
								echo "<tr>";
								echo "<td>$item[date]</td>";
								echo "<td>$item[code]</td>";
								echo "<td>$desc</td>";
								echo "<td align='center'>$item[prevqty]</td>";
								echo "<td align='center'>$item[statquantity]</td>";
								echo "<td>$item[paymentstatus]</td>";
								echo "<td>$item[receivinguser]</td>";
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
