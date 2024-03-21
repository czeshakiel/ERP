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
								<td>List of Items</td>
								<?=form_open(base_url()."search_item_price");?>
								<td align="right" width="300">
									<input type="text" name="searchme" class="form-control" placeholder="Search item here or rrno....">
								</td>
								<td width="150" align="right">
									<input type="submit" class="btn btn-success text-white" value="Search">
									<a href="<?=base_url();?>item_price" class="btn btn-primary">Back</a>
								</td>
								<?=form_close();?>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>RR DATE</th>
								<th>RRNO</th>
								<th>DESCRIPTION</th>
								<th>UNIT COST</th>
								<th>QUANTITY</th>
								<th>LOT NO</th>
								<th>EXPIRATION</th>
								<th>SUPPLIER</th>
								<th></th>
							</tr>
							</thead>
							<tbody>
							<?php
							foreach($items AS $item){
								$desc=str_replace('ams-','',$item['description']);
								$desc=str_replace('cmshi-','',$desc);
								$desc=str_replace('-med','',$desc);
								$desc=str_replace('-sup','',$desc);
								if($item['generic']==""){
									$generic="";
								}else{
									$generic="(".$item['generic'].")<br>";
								}
								if($item['prodtype1'] > 0){
									$unitcost=$item['prodtype1'];
								}else{
									$unitcost=$item['unitcost'];
								}
								echo "<tr>";
								echo "<td>$item[date]</td>";
								echo "<td>$item[rrno]</td>";
								echo "<td>$generic$desc</td>";
								echo "<td>$unitcost</td>";
								echo "<td align='center'>$item[quantity]</td>";
								echo "<td>$item[lotno]</td>";
								echo "<td>$item[expiration]</td>";
								echo "<td>$item[suppliername]</td>";
								?>
								<td align='center'><a href="<?=base_url();?>rr_print/<?=$item['invno'];?>/<?=$item['rrno'];?>" class="btn btn-success btn-sm" target="_blank">Print</a></td>
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
