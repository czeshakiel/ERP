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
			<div class="col-md-8">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td width="20%">DoctorName:</td>
								<td><b><u><?=$doctor['lastname'];?>, <?=$doctor['firstname'];?></u></b></td>
							</tr>
							<?php
							if($employee['username']==""){
								$user="Not set";
								$view="disabled";
								$add="style='color:blue;'";
								$edit="style='display:none;'";
							}else{
								$user=$employee['username'];
								$view="";
								$add="style='display:none;'";
								$edit="style='color:blue;'";
							}
							?>
							<tr>
								<td>Username:</td>
								<td><?=$user;?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" <?=$add;?> data-bs-toggle="modal" class='btn btn-outline-success text-success editDoctorAccount' data-bs-target="#modal_doctor_account" data-id="<?=$empid;?>"><i class="icofont-plus-circle"></i> Set Account</a> <a href="#" <?=$edit;?> data-bs-toggle="modal" data-bs-target="#modal_doctor_account" data-id="<?=$empid;?>" class='btn btn-outline-info text-info editDoctorAccount'><i class="icofont-ui-edit"></i> Edit Account</a></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th width="5%">#</th>
								<th>Station</th>
								<th width="10%">Access</th>
								<th width="20%">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$num=1;
							foreach($access as $ua){
								echo "<tr>";
								echo "<td>$num.</td>";
								echo "<td>$ua[station]</td>";
								echo "<td>$ua[Access]</td>";
								echo "<td align='center'><a href='#' class='btn btn-info btn-sm text-white editDoctorAccess' data-bs-toggle='modal' data-bs-target='#modal_doctor_access' data-id='$ua[empid]_$ua[autono]' style='color:blue;'><i class='icofont-pencil-alt-1'></i> Edit</a> <a href='".base_url()."delete_doctor_account/$empid/$ua[autono]' class='btn btn-danger btn-sm text-white'><i class='icofont-trash'></i> Delete</a></td>";
								echo "</tr>";
								$num++;
							}
							?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
			<div class="col-md-4">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td width="30%"><h6 class="mb-0 fw-bold ">Station Access</h6></td>
								<td align="right"></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<?=form_open(base_url()."add_doctor_access");?>
						<input type='hidden' name='empid' value='<?=$empid;?>'>
						<div class="form-group mb-3">
							<label>Station</label>
							<select name="station" class="item form-control" required>
								<option value=""></option>
								<?php
								foreach($station as $stat){
									$exist=$this->Masterfile_model->checkAccessExist($stat['station'],$empid);
									if($exist){

									}else {
										echo "<option value='$stat[station]'>$stat[station]</option>";
									}
								}
								?>
							</select>
						</div>
						<div class="form-group mb-3">
							<label>Access</label>
							<input type="text" name="access" class="form-control" value="Single">
						</div>
						<div class="form-group mb-3">
							<input type="submit" name="submit" class="btn btn-primary" value="Select" <?=$view;?>>
						</div>
						<?=form_close();?>
					</div>
				</div>

			</div>
		</div><!-- Row end  -->

	</div>
</div>
