<div class="body d-flex py-lg-3 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h3 class="fw-bold mb-0"><?=$title;?></h3>
				</div>
			</div>
		</div> <!-- Row end  -->
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
		<div class="row align-item-center">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h6 class="mb-0 fw-bold ">List of Patient</h6></td>
								<?=form_open(base_url()."search_ipdlist");?>
								<!-- <td width="30%" align="right">

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
								<th width="1%">No.</th>
								<th>Patient Name</th>
								<th>Admission<br>Date & Time</th>
								<th>Room</th>
								<th>HMO</th>
								<th>Doctor</th>								
								<th width="30%">Admitting Diagnosis</th>
								<th>Status</th>
								<th width="10%"></th>
							</tr>
							</thead>
							<tbody>
							<?php							
							$x=1;
							foreach($inpatient as $list){
								$charge=$this->Admission_model->checkCharge($list['caseno']);
								if($charge){
									$view="style='display:none;'";
								}else{
									$view="";
								}
								if($this->session->dept=="ER"){
								$er="";
								$other="style='display:none;'";
								$admit="";
								$mesheet="style='display:none;'";
								$mesheet1=$this->Emergency_model->checkMESheet($list['caseno']);
								if($mesheet1){
									$mesheet="";
								}
							}else{
								$er="";
								$other="";
								$admit="style='display:none;'";
								$mesheet="style='display:none;'";
							}
							$hmo="";
							$nhmo="style='display:none;'";
							$whmo="";
							$soa="style='display:none;'";
							$vs="style='display:none;'";
							if($department=="HMO"){
								if($list['hmo'] == "N/A"){
									$whmo="style='display:none;'";
								}
								$hmo="style='display:none;'";
								$nhmo="";
								$soa="";
								$vs="";
							}
							$ass="style='display:none;'";
							if($list['status']=="MGH"){
								$ass="";
							}
							$newborn="style='display:none;'";
							if($department=="ADMISSION"){
								if($list['stat1']=="New Born"){
									$newborn="";
								}								
							}
								echo "<tr style='font-size:12px;'>";
								echo "<td>$x.</td>";
								echo "<td><b>$list[employerno]</b><br>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";
								echo "<td>$list[dateadmitted] ".date('h:i A',strtotime($list['timeadmitted']))."</td>";
								echo "<td>$list[room]</td>";
								echo "<td>$list[hmo]</td>";
								echo "<td>DR. $list[apname]</td>";								
								echo "<td>$list[initialdiagnosis]</td>";
								echo "<td>$list[status]</td>";
								?>
								<td align="center" width="10%">
									<div class="dropdown">
										<a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
											Action
										</a>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<li><a class="dropdown-item" href="http://192.168.0.100:100/ERP/main/bridge.php?caseno=<?=$list['caseno'];?>&username=<?=$this->session->username;?>&nursename=<?=$this->session->fullname;?>&dept=<?=$this->session->dept;?>" <?=$er;?> <?=$hmo;?> target="_blank">View Profile</a></li>
											<li><a class="dropdown-item" href="<?=base_url();?>view_profile/<?=$list['caseno'];?>" <?=$nhmo;?>>View Profile</a></li>											
											<li><a class="dropdown-item editAdmitTime" href="#" data-bs-toggle="modal" data-bs-target="#EditAdmissionTime" data-id="<?=$list['caseno'];?>" <?=$other;?> <?=$hmo;?>>Edit Admission Details</a></li>
											<li><a class="dropdown-item editAP" href="#" data-bs-toggle="modal" data-bs-target="#EditAttending" data-id="<?=$list['caseno'];?>_<?=$list['ap'];?>_<?=$list['ad'];?>" <?=$other;?> <?=$hmo;?>>Edit Doctor</a></li>
											<!-- <li><a class="dropdown-item editAdmitRoom" href="#" data-bs-toggle="modal" data-bs-target="#UpdateRoomAdmitting" data-id="<?=$list['caseno'];?>_<?=$list['room'];?>" <?=$other;?> <?=$hmo;?>>Edit Room</a></li> -->
											<li><a class="dropdown-item" href="<?=base_url();?>manage_room_admit/<?=$list['caseno'];?>" <?=$other;?> <?=$hmo;?>>Edit Room</a></li>
											<li><a class="dropdown-item editHMO" href="#" data-bs-toggle="modal" data-bs-target="#UpdateHMO" data-id="<?=$list['caseno'];?>_<?=$list['hmo'];?>_<?=$list['policyno'];?>" <?=$other;?>>Edit HMO/LOA</a></li>
											<li><a class="dropdown-item" href="<?=base_url();?>cover_sheet/<?=$list['caseno'];?>" <?=$other;?> target="_blank" <?=$hmo;?>>Cover Sheet</a></li>
											<li><a class="dropdown-item" href="<?=base_url();?>cancel_admission/<?=$list['caseno'];?>/<?=$list['room'];?>" <?=$other;?> <?=$view;?> <?=$hmo;?> onclick="return confirm('Do you wish to cancel this admission?');return false;">Cancel Admission</a></li>
											<li><a class="dropdown-item" href="<?=base_url();?>printCF3/<?=$list['caseno'];?>" <?=$er;?> <?=$admit;?> target="_blank" <?=$hmo;?>>CF3</a></li>
											<li><a class="dropdown-item" href="../printresult/mesheet/<?=$this->session->fullname;?>/<?=$list['caseno'];?>" <?=$mesheet;?> target="_blank" <?=$hmo;?>>ME Sheet</a></li>
											<li><a class="dropdown-item" href="<?=base_url();?>summary_chart/<?=$list['caseno'];?>" target="_blank" <?=$hmo;?>>Summary Chart</a></li>
											<li><a class="dropdown-item vitalsigns" href="#" data-bs-toggle="modal" data-bs-target="#VitalSigns" data-id="<?=$list['caseno'];?>" <?=$admit;?> <?=$hmo;?>>Vital Signs</a></li>
											<li><a class="dropdown-item" href="<?=base_url();?>hmo_allocation/<?=$list['caseno'];?>" <?=$nhmo;?> <?=$whmo;?> <?=$ass;?>>Allocation</a></li>
											<li><a class="dropdown-item" href="<?=base_url();?>hmo_assistance/<?=$list['caseno'];?>" <?=$nhmo;?> <?=$ass;?>>Assistance</a></li>
											<li><a class="dropdown-item viewVitalSigns" href="#" data-bs-toggle="modal" data-bs-target="#ViewVS" data-id="<?=$list['caseno'];?>" <?=$vs;?>>Vital Signs</a></li>
											<li><a class="dropdown-item" href="http://192.168.0.100:100/2017codes/SOA/StatementOfAccountPHICVerHMO.php?patientidno=<?=$list['patientidno'];?>&caseno=<?=$list['caseno'];?>&uname" <?=$nhmo;?> target="_blank">SOA</a></li>
											<li><a class="dropdown-item editInitialDiag" href="#" data-bs-toggle="modal" data-bs-target="#EditInitialDiag" data-id="<?=$list['caseno'];?>_<?=$list['initialdiagnosis'];?>" <?=$newborn;?>>Edit Initial Diagnosis</a></li>
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
