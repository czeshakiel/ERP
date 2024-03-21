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
							</tr>
							<?=form_close();?>
						</table>
					</div>
					<div class="card-body">
						<table class="table" style="width: 100%;" id="patient-table">
							<thead>
							<tr>		
								<th>#</th>
								<th></th>						
								<th>Patient Name</th>								
                                <th>Gender</th>
								<th>Birth Date</th>
								<th>Transdate</th>
								<th></th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($inpatient as $list){
								$diff=date_diff(date_create(date('Y-m-d')),date_create($list['dateofbirth']));
								
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
								echo "<td width='1%'>$x.</td>";
								echo "<td align='center' width='2%'><img src='".base_url()."design/images/xs/$avatar' width='20' height='20' style='border-radius:50%;'></td>";
								echo "<td>ID No.: $list[patientidno]<br>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";								
                                echo "<td>$list[sex]</td>";
								echo "<td><i class='icofont-calendar'></i> $list[dateofbirth]</td>";
								echo "<td>".date('M-d-Y',strtotime($list['datearray']))."</td>";
								?>
								<td align="left" width="20%">
									<a href="<?=base_url();?>quotation_view/<?=$list['id'];?>/<?=$list['caseno'];?>" class="btn btn-success btn-sm text-white">View</a>
									<?=form_open(base_url()."arreadmission");?>
									<input type="hidden" name="patientidno" value="<?=$list['patientidno'];?>">
									<input type="hidden" name="artype" value="quotation">
									<input type="submit" class="btn btn-primary btn-sm" value="Proceed">
									<?=form_close();?>
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
