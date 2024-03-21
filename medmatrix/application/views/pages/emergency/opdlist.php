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
				<?php
				if($this->session->success){
					?>
					<div class="alert alert-success"><?=$this->session->success;?></div>
				<?php
				}
				?>
				<?php
				if($this->session->failed){
					?>
					<div class="alert alert-danger"><?=$this->session->failed;?></div>
					<?php
				}
				?>
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h6 class="mb-0 fw-bold ">List of Patient</h6></td>
								<?=form_open(base_url()."searchopdlist");?>
								<!-- <input type="hidden" name="rundate" value="<?=$rundate;?>">
								<input type="hidden" name="atype" value="<?=$type;?>">
								<td width="30%" align="right">

									<input type="text" name="searchme" class="form-control" placeholder="Search Patient here.. e.g. Last Name First Name">

								</td>
								<td width="6.5%" align="right">
									<button type="submit" name="submit" class="btn btn-primary"><i class="icofont-search"></i> Search</button>
								</td> -->
							</tr>
							<?=form_close();?>
						</table>
					</div>
					<div class="card-body">
						<table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th width="10%">Case No</th>
								<th>Patient Name</th>
								<th>Membership</th>
								<th>HMO</th>
								<th width="10%"></th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($outpatient as $list){
								$view="style='display:none;'";
								$index="style='display:none;'";
								if($type=="M"){
									$view="";
								}
								if($type=="C"){
									$index="";
								}
								$checkItems=$this->Emergency_model->checkItems($list['caseno']);
								$cancel="";
								if(count($checkItems)>0){
									$cancel="style='display:none;'";
								}
								echo "<tr style='font-size:12px;'>";
								echo "<td>$list[caseno]</td>";
								echo "<td>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";								
								echo "<td>$list[membership]</td>";
								echo "<td>$list[hmo]</td>";
								?>
								<td align="center" width="10%">
									<div class="dropdown">
										<a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
											Action
										</a>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<li><a class="dropdown-item" href="http://192.168.0.100:100/ERP/main/bridge.php?caseno=<?=$list['caseno'];?>&username=<?=$this->session->username;?>&nursename=<?=$this->session->fullname;?>&dept=<?=$this->session->dept;?>" target="_blank">View Profile</a></li>
											<li><a class="dropdown-item editAD" href="#" data-bs-toggle="modal" data-bs-target="#EditAdmitting" data-id="<?=$list['caseno'];?>_<?=$list['ap'];?>">Edit Doctor</a></li>
											<li><a class="dropdown-item editCreditLimit" href="#" data-bs-toggle="modal" data-bs-target="#editCreditLimit" data-id="<?=$list['caseno'];?>">Edit Credit Limit</a></li>
											<li><a class="dropdown-item editMembership" href="#" data-bs-toggle="modal" data-bs-target="#editMembership" data-id="<?=$list['caseno'];?>">Edit Membership</a></li>
											<li><a class="dropdown-item editHMO" href="#" data-bs-toggle="modal" data-bs-target="#UpdateHMO" data-id="<?=$list['caseno'];?>_<?=$list['hmo'];?>_<?=$list['policyno'];?>">Edit HMO/LOA</a></li>
											<li><a class="dropdown-item" href="<?=base_url();?>cancel_opd_admission/<?=$list['caseno'];?>" onclick="return confirm('Do you wish to cancel this admission?');return false;" <?=$cancel;?>>Cancel Admission</a></li>
											<li><a class="dropdown-item" href="<?=base_url();?>print_index_card/<?=$list['caseno'];?>" target="_blank" <?=$index;?>>Index Card</a></li>
										</ul>
									</div>
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
