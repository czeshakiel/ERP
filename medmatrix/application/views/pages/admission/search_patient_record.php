<div class="body d-flex py-lg-3 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h5 class="fw-bold mb-0"><?=$title;?></h5>
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
								<?=form_open(base_url()."search_patient_record_search");?>
								<td width="30%" align="right">

									<input type="text" name="searchme" class="form-control" placeholder="Search Patient here.. e.g. Last Name First Name">

								</td>
								<td width="6.5%" align="right">
									<button type="submit" name="submit" class="btn btn-primary"><i class="icofont-search"></i> Search</button>
								</td>
							</tr>
							<?=form_close();?>
						</table>
					</div>
					<div class="card-body">
						<table class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<!--th>#</th-->
								<th></th>								
								<th>Name</th>
								<th>Birth Date</th>
								<th>Age</th>
								<th></th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($inpatient as $list){
								//$visit=$this->Admission_model->getLastVisit($list['patientidno']);
								$diff=date_diff(date_create(date('Y-m-d')),date_create($list['dateofbirth']));
								$stillin=$this->Admission_model->checkAdmission($list['patientidno']);
								if($stillin){
									$button="<button disabled class='btn btn-danger btn-sm'><i class='icofont-exclamation-circle'></i> Still in</button>";
									$view="style='display:none;'";
									$color="style='background-color:pink;'";
								}else{
									$button="";
									$view="";
									$color="";
								}
								if($list['sex']=="M" || $list['sex']=="m"){
									$sex="male";
									$fa="info";
								}else{
									$sex="female";
									$fa="danger";
								}
								$age=$diff->format('%y');
								echo "<tr style='font-size:16px;'>";								
								if($list['sex']=="M" || $list['sex']=="m"){
									$sex="man-in-glasses";
									$fa="info";
									$avatar="avatar1.jpg";
								}else{
									$sex="woman-in-glasses";
									$fa="danger";
									$avatar="avatar2.jpg";
								}
								$age=$diff->format('%y');								
								//echo "<td width='1%'>$x.</td>";
								echo "<td align='center' width='2%'><img src='".base_url()."design/images/xs/$avatar' width='50' height='50' style='border-radius:50%;'></td>";								
								echo "<td>ID No.: <b>$list[patientidno]<br>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</b></td>";								
								echo "<td><i class='icofont-calendar'></i> $list[birthdate]</td>";
								echo "<td>$age</td>";
								?>
								<td align="center" width="8%">
									<a href="<?=base_url();?>view_patient_record/<?=$list['patientidno'];?>" class="btn btn-success btn-sm text-white"><i class="icofont-eye-alt"></i> View</a>
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
