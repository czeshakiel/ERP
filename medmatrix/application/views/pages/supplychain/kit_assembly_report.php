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
								<td>Date Range: <?=$startdate;?> to <?=$enddate;?></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table class="table table-vcenter card-table table-striped">
							<thead>
							<tr>
								<td align="center" style="font-size:10px;font-family: Times New Roman;">REFNO</td>
								<td align="center" style="font-size:10px;font-family: Times New Roman;">USER</td>
								<td align="center" style="font-size:10px;font-family: Times New Roman;">KIT ITEM</td>
								<td align="center" style="font-size:10px;font-family: Times New Roman;">QUANTITY</td>
								<td align="center" style="font-size:10px;font-family: Times New Roman;">DATE</td>
								<td align="center" style="font-size:10px;font-family: Times New Roman;">ACTION</td>
							</tr>
							</thead>
							<tbody>
							<?php
							$totalamount=0;
							$amount=0;
							foreach($items AS $item){
								echo "<tr>";
								echo "<td>$item[refno]</td>";
								echo "<td>$item[user]</td>";
								echo "<td>$item[itemname]</td>";
								echo "<td>$item[quantity]</td>";
								echo "<td>$item[datearray]</td>";
								?>
								<td align='center'>
									<a href="<?=base_url();?>print_kit_assembly_report/<?=$item['refno'];?>" target='_blank' class="btn btn-info text-white btn-sm">
										<i class="icofont-printer"></i>
										View
									</a>
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
		</div><!-- Row end  -->
	</div>
</div>
