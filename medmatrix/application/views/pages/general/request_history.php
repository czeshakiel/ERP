<div class="body d-flex py-lg-3 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h3 class="fw-bold mb-0"><?=$title;?></h3>					
				</div>
			</div>
		</div> <!-- Row end  -->
		<div class="row clearfix g-3">
			<div class="col-sm-12">
				<div class="card mb-3">
					<div class="card-body">
						<table id="patient-table" class="table table-hover align-middle mb-0" style="width:100%">
							<thead>
							<tr>
								<th>#</th>
								<th>Request No.</th>
								<th>Requesting User</th>
								<th>Charge To</th>
								<th>Date</th>
								<th>Items</th>								
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($items as $req){
								echo "<tr>";
									echo "<td>$x.</td>";
									echo "<td>$req[reqno]</td>";
									echo "<td>$req[requser]</td>";
									echo "<td>$req[dept]</td>";
									echo "<td>$req[reqdate]</td>";
									?>									
								<td>
									<?php
										$query=$this->Purchase_model->getRequestedItem($req['reqno']);
										foreach($query as $item){
											echo $item['description']."<br>";
										}
									?>
										<!-- <a href="<?=base_url();?>stock_request_print/<?=$req['reqno'];?>" class="btn btn-success" target="_blank"><i class="icofont-printer text-success"></i> Print</a> -->
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
		</div><!-- Row End -->
	</div>
</div>
