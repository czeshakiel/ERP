<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row clearfix g-3">
			<div class="col-xl-12 col-lg-12 col-md-12 flex-column">
				<div class="row g-3">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
								<h6 class="mb-0 fw-bold "><a href="<?=base_url();?>patient_refund"><i class="icofont-arrow-left"></i> Back </a> | <?=$title;?> | <?=$patient['lastname'];?>, <?=$patient['firstname'];?> <?=$patient['middlename'];?></h6>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<?=form_open(base_url()."save_refund");?>
								<table width="100%" border="0" cellpadding="2" cellspacing="2">
									<input type="hidden" name="caseno" value="<?=$caseno;?>">
									<input type="hidden" name="patientname" value="<?=$patient['lastname'];?>, <?=$patient['firstname'];?> <?=$patient['middlename'];?>">
									<tr>
										<td width="15%">Enter Amount:</td>
										<td width="25%" align="center"><input type="text" name="amount" class="form-control"></td>
										<td width="60%"><input type="submit" name="search" class="btn btn-success text-white" value="Post Amount"></td>
									</tr>
								</table>
								<?=form_close();?>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-12">
										<b>Post Refund History</b>
										<table class="table">											
											<thead>
												<tr>
													<th>Refno</th>
													<th>Account Title</th>
													<th>Amount</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach($history as $item){
													if($item['type'] == 'pending'){
														$remove="";
													}else{
														$remove="style='display:none;'";
													}
													echo "<tr>";
														echo "<td>$item[refno]</td>";
														echo "<td>$item[accttitle]</td>";
														echo "<td>$item[amount]</td>";
														?>
														<td><a href="<?=base_url();?>remove_refund/<?=$caseno;?>/<?=$item['refno'];?>" <?=$remove;?> class="btn btn-danger btn-sm" onclick="return confirm('Do you wish to remove this item?');return false;">Remove</a></td>
														<?php
													echo "</tr>";
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
