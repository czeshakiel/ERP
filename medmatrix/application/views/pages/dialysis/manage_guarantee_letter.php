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
								<td><h6 class="mb-0 fw-bold ">Patient Name: <?=$patient['lastname'];?>, <?=$patient['firstname'];?> <?=$patient['middlename'];?></h6></td>		
								<td width="30%" align="right">	
									<a href="#" class="btn btn-success text-white addGL" data-bs-toggle="modal" data-bs-target="#ManageGuaranteeLetter" data-id="<?=$patient['patientidno'];?>"><i class="icofont-plus"></i> Add New GL</a>
								</td>								
							</tr>							
						</table>
					</div>
					<div class="card-header bg-transparent">
						<h6><b>List of Guarantee Letter</b></h6>
					</div>
					<div class="card-body">
						<table class="table table-hover align-middle table-bordered" style="width: 100%;">
							<thead>
							<tr>		
								<th width="3%">#</th>
								<th width="8%">GL ID</th>						
								<th width="35%">Company</th>								
								<th width="10%">Remaining Balance</th>
								<th width="15%">Date Posted</th>
								<th width="10%">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php							
							$x=1;
							foreach($guarantee_letter as $list){								
								echo "<tr style='font-size:14px;'>";
								echo "<td width='1%'>$x.</td>";
								echo "<td align='center' width='2%'>$list[gl_id]</td>";
								echo "<td>$list[gl_company]</td>";								
								echo "<td align='right'>".number_format($list['remaining'],2)."</td>";
								echo "<td align='center'>".date('m/d/Y',strtotime($list['datearray']))."</td>";
								?>
								<td align="center" width="20%">
									<a href="<?=base_url();?>view_guarantee_letter/<?=$list['patientidno'];?>/<?=$list['gl_id'];?>" class="btn btn-primary btn-sm"><i class="icofont-book"></i> View History</a>
									<a href="#" class="btn btn-warning btn-sm editGL" data-bs-toggle="modal" data-bs-target="#ManageGuaranteeLetter" data-id="<?=$list['id'];?>_<?=$list['gl_id'];?>"><i class="icofont-edit"></i> Edit GL</a>
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
