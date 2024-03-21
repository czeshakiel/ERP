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
								<?=form_open(base_url()."search_patient_record_search_rdu");?>
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
						<table class="table table-hover align-middle mb-0 table-bordered" style="width: 100%;">
							<thead>
							<tr>
								<th>HRN</th>
								<th>Case #</th>
								<th>Last Name</th>
								<th>First Name</th>
								<th>Middle Name</th>
								<th>Suffix</th>
								<th>Date Admitted</th>
								<th>Status</th>
								<th></th>
							</tr>
							</thead>
							<tbody>
							<?php
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
								echo "<tr>";
								echo "<td>$list[patientidno]</td>";
								echo "<td>$list[caseno]</td>";
								echo "<td>$list[lastname]</td>";
								echo "<td>$list[firstname]</td>";
								echo "<td>$list[middlename]</td>";
								echo "<td>$list[suffix]</td>";
								echo "<td>$list[dateadmitted]</td>";
								echo "<td align='center'>$list[status]</td>";
								if($list['status']=="discharged"){
									$view="";
								}else{
									$view="style='display:none;'";
								}
								?>
								<td>
									<a href="http://192.168.0.100:100/ERP/main/bridge.php?caseno=<?=$list['caseno'];?>&username=<?=$this->session->username;?>&nursename=<?=$this->session->fullname;?>&dept=<?=$this->session->dept;?>" target="_blank" class="btn btn-success btn-sm text-white"><i class="icofont-eye-alt"></i> View Profile</a>
									<a href="../../2021codes/BillMe/?caseno=<?=$list['caseno'];?>&user=<?=$this->session->username;?>&dept=RDU" target="_blank" class="btn btn-info btn-sm text-white"><i class="icofont-money"></i> Billing</a>
									<a href="#" class="btn btn-danger btn-sm text-white activate_account" <?=$view;?> data-bs-toggle="modal" data-bs-target="#activate_account" data-id="<?=$list['caseno'];?>"><i class="icofont-stack-exchange"></i> Activate</a>
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
