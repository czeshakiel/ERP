<div class="body d-flex py-lg-3 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h3 class="fw-bold mb-0"><?=$title;?></h3>
				</div>
			</div>
		</div> <!-- Row end  -->

		<div class="row align-item-center">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h6 class="mb-0 fw-bold ">List of Patient</h6></td>
							</tr>
							<tr>
								<td><h6 class="mb-0 fw-bold ">Date Range: <u><?=date('F d, Y',strtotime($startdate));?> - <?=date('F d, Y',strtotime($enddate));?></u></h6></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table class="table table-hover align-middle mb-0 table-bordered" style="width: 100%;" id="patient-table">
							<thead>
							<tr>
								<th width="1%">No.</th>
								<th>HMO/Company</th>
								<th>No. of Patient</th>
								<th width="10%"></th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($inpatient as $list){	
								if(is_numeric($list['addemployer'])){

								}else{
									echo "<tr style='font-size:12px;'>";
									echo "<td>$x.</td>";
									echo "<td>$list[addemployer]</td>";
									echo "<td>$list[patient]</td>";								
									?>
									<td align="center" width="10%">
										<a href="<?=base_url();?>view_walkin_hmo/<?=$list['addemployer'];?>/<?=$startdate;?>/<?=$enddate;?>" class="btn btn-success text-white" title="View List" target="_blank"><i class="icofont-eye"></i></a>
									</td>
									<?php
									echo "</tr>";
									$x++;
								}
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
