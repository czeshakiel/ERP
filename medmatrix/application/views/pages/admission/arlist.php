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
								<?=form_open(base_url()."search_arlist");?>
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
								<th width="1%">No.</th>
								<th>Patient Name</th>
								<th>Admission<br>Date & Time</th>
								<th>Attending Doctor</th>
								<th>Charge to</th>
								<th width="10%"></th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($inpatient as $list){
								if(is_numeric($list['addemployer'])){
									$check=$this->General_model->checkChargeTo($list['addemployer']);
									$charge=$check['lastname'].", ".$check['firstname']." ".$check['middlename'];
								}else{
									$charge=$list['addemployer'];
								}
								if($charge==""){
									$charge=$list['hmo'];
								}
								echo "<tr style='font-size:12px;'>";
								echo "<td>$x.</td>";
								echo "<td>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";
								echo "<td>$list[dateadmitted] ".date('h:i A',strtotime($list['timeadmitted']))."</td>";
								echo "<td>DR. $list[apname]</td>";
								echo "<td>$charge</td>";
								$view="";
								$edit="";
								$details="style='display:none;'";
								if($this->session->dept=="RDU"){
									$view="style='display:none;'";																
								}
								if($this->session->dept=="HMO"){
									$view="style='display:none;'";
									$edit="style='display:none;'";
									$details='';
								}
								?>
								<td align="center" width="10%">
									<div class="dropdown">
										<a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
											Action
										</a>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<li><a class="dropdown-item" href="http://192.168.0.100:100/ERP/main/bridge.php?caseno=<?=$list['caseno'];?>&username=<?=$this->session->username;?>&nursename=<?=$this->session->fullname;?>&dept=<?=$this->session->dept;?>" target="_blank" <?=$edit;?>>View Profile</a></li>
											<li><a class="dropdown-item editAR" href="#" data-bs-toggle="modal" data-bs-target="#EditARAttending" data-id="<?=$list['caseno'];?>_<?=$list['ap'];?>" <?=$edit;?>>Edit Doctor</a></li>
											<li><a class="dropdown-item" href="<?=base_url();?>discharge_ar_admission/<?=$list['caseno'];?>" onclick="return confirm('Do you wish to discharge this admission?');return false;" <?=$view;?>>Discharge</a></li>
											<li><a class="dropdown-item" href="<?=base_url();?>patientprofile/<?=$list['patientidno'];?>" <?=$details;?>>View Details</a></li>
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
