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
								<?=form_open(base_url()."search_discharged_patient");?>
								<td width="30%" align="right">

									<input type="text" name="searchme" class="form-control" placeholder="Search Patient here.. e.g. Last Name First Name" required>

								</td>
								<td width="6.5%" align="right">
									<button type="submit" name="submit" class="btn btn-primary"><i class="icofont-search"></i> Search</button>
								</td>
							</tr>
							<?=form_close();?>
						</table>
					</div>
					<div class="card-body">
						<table class="table table-hover align-middle mb-0 nowrap dataTable no-footer dtr-inline" style="width: 100%;">
							<thead>
							<tr>		
								<th>#</th>
								<th>Caseno</th>						
								<th>Patient Name</th>								
								<th>Date Discharged</th>
								<th>Date Visited</th>
								<th>Room</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$hmo="";
							// if($this->session->dept=="HMO"){
							// 	$hmo="style='display:none;'";
							// }
							$x=1;
							foreach($inpatient as $list){
								if($list['sex']=="M" || $list['sex']=="m"){
									$sex="man-in-glasses";
									$fa="info";
									$avatar="avatar1.jpg";
								}else{
									$sex="woman-in-glasses";
									$fa="danger";
									$avatar="avatar2.jpg";
								}								
								echo "<tr style='font-size:13px;'>";
								echo "<td width='1%'>$x.</td>";
								echo "<td align='center' width='3%'>$list[caseno]</td>";
								echo "<td><img src='".base_url()."design/images/xs/$avatar' width='20' height='20' style='border-radius:50%;'><br>ID No.: $list[patientidno]<br>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";								
								echo "<td><i class='icofont-calendar'></i> ".date('m/d/Y',strtotime($list['dateadmit']))."</td>";
								echo "<td><i class='icofont-calendar'></i> ".date('m/d/Y',strtotime($list['datearray']))."</td>";
								echo "<td><i class='icofont-bed'></i> $list[room]</td>";
								?>
								<td align="center" width="20%">
									<a href="<?=base_url();?>view_profile/<?=$list['caseno'];?>" class="btn btn-success btn-sm text-white" title="View Profile"><i class="icofont-eye"></i></a>
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
