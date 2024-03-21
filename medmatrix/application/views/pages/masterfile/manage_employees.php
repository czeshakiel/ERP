<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h4 class="fw-bold mb-0"><?=$title;?></h4>
				</div>
			</div>
		</div> <!-- Row end  -->
		<?php if($this->session->save_success){ ?>
			<div class="alert alert-success" role="alert"><?=$this->session->save_success;?></div>
		<?php } ?>
		<?php if($this->session->save_failed){ ?>
			<div class="alert alert-danger" role="alert"><?=$this->session->save_failed;?></div>
		<?php } ?>
		<div class="row align-item-center">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td width="10%"><h6 class="mb-0 fw-bold ">List of Employee</h6></td>
								<td align="right"><a href="#" class="btn btn-success newEmployee" data-bs-toggle="modal" data-bs-target="#EmployeeProfile"><i class="icofont-plus-circle"></i> Add Employee</a></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th>IDNo</th>
								<th>Last Name</th>
								<th>First Name</th>
								<th>Middle Name</th>
								<th>Birth Date</th>
								<th>Age</th>
								<th>Address</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							foreach($employees as $list){
								//$visit=$this->Admission_model->getLastVisit($list['patientidno']);
								$diff=date_diff(date_create(date('Y-m-d')),date_create($list['birthdate']));
								$age=$diff->format('%y');
								echo "<tr>";
								echo "<td>$list[empid]</td>";
								echo "<td>$list[lastname]</td>";
								echo "<td>$list[firstname]</td>";
								echo "<td>$list[middlename]</td>";
								echo "<td>$list[birthdate]</td>";
								echo "<td align='center'>$age</td>";
								echo "<td>$list[address]</td>";
								?>
								<td align="center" width="20%">
									<a href="#" class="btn btn-info btn-sm editEmployee" data-bs-toggle="modal" data-bs-target="#EmployeeProfile" data-id="<?=$list['empid'];?>"><i class="icofont-edit-alt"></i> Edit Profile</a>
									<a href="<?=base_url();?>manage_employee_account/<?=$list['empid'];?>" class="btn btn-warning btn-sm"><i class="icofont-edit"></i> Edit Account</a>
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
