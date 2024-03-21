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
								<td align="right"><a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#NewAdmission"><i class="icofont-plus-circle"></i> New Admission</a></td>
								<?=form_open(base_url()."search_admission");?>
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
								<th></th>						
								<th>Patient Name</th>								
								<th>Birth Date</th>
								<th>Age</th>
								<th></th>
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
								//$visit=$this->Admission_model->getLastVisit($list['patientidno']);
								$diff=date_diff(date_create(date('Y-m-d')),date_create($list['dateofbirth']));
								$stillin=$this->Admission_model->checkAdmission($list['patientidno']);
								$c=explode('-',$stillin['caseno']);
								if($stillin && $department=="ADMISSION" && $c[0]=="I"){
									$button="<button disabled class='btn btn-outline-danger btn-sm' title='Still in'><i class='icofont-exclamation-circle'></i></button>";
									$view="style='display:none;'";
									$color="style='background-color:pink;'";
								}
								else if($stillin && $department=="RDU"){
									$c=explode('-',$stillin['caseno']);
									if($c[0]=="I"){
										$color="style='background-color:pink;'";
										$button="";
										$view="";
									}else{
										if($stillin['status']=="discharged"){
											$button="";
											$view="";
											$color="";
										}else{											
											//$button="<button disabled class='btn btn-outline-danger btn-sm' title='Still in'><i class='icofont-exclamation-circle'></i></button>";
											$button="";
											//$view="style='display:none;'";
											$view="";
											$color="";
										}										
									}																		
									
								}else if($stillin && ($department=="ER" || $department=="OPD")){
									$button="<a class='btn btn-outline-danger btn-sm stillinreadmit' title='Still in' href='#' data-bs-toggle='modal' data-bs-target='#StillinReadmission' data-id='".$list['patientidno']."'><i class='icofont-exclamation-circle'></i></a>";
									$view="style='display:none;'";
									$color="style='background-color:pink;'";
								}else{
									$c=explode('-',$stillin['caseno']);
									if($c[0]=="R"){
										$button="";
											//$view="style='display:none;'";
											$view="";
											$color="style='background-color:pink;'";
									}else{
										if($stillin['status']=="discharged"){
											$button="";
											$view="";
											$color="";
										}else{											
											//$button="<button disabled class='btn btn-outline-danger btn-sm' title='Still in'><i class='icofont-exclamation-circle'></i></button>";
											//$button="";
											//$view="style='display:none;'";
											//$view="";
											//$color="style='background-color:pink;'";
											$button="";
											$view="";
											$color="";
										}										
									}
								}
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
								echo "<tr style='font-size:13px;'>";
								echo "<td width='1%' $color>$x.</td>";
								echo "<td align='center' width='2%' $color><img src='".base_url()."design/images/xs/$avatar' width='20' height='20' style='border-radius:50%;'$color></td>";
								echo "<td $color>ID No.: $list[patientidno]<br>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";								
								echo "<td $color><i class='icofont-calendar'></i> $list[birthdate]</td>";
								echo "<td $color>$age</td>";
								?>
								<td align="center" width="20%" <?=$color;?>>
									<a href="#" class="btn btn-outline-success btn-sm readmit" <?=$view;?> data-bs-toggle="modal" data-bs-target="#ReAdmission" data-id="<?=$list['patientidno'];?>" title="Readmit"><i class="icofont-ambulance"></i></a> <?=$button;?> <a href="<?=base_url();?>patientprofile/<?=$list['patientidno'];?>" class="btn btn-outline-<?=$fa;?> btn-sm" title="Profile" <?=$hmo;?>><i class="icofont-<?=$sex;?>"></i></a>
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
