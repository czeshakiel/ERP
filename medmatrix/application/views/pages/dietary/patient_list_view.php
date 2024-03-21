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
								<td><h6 class="mb-0 fw-bold ">List of Patient <a href="#" class="btn btn-success btn-sm text-white" data-bs-toggle="modal" data-bs-target="#PrintAllTag"><i class="icofont-printer"></i> Print All Tag</a></h6></td>
								<?=form_open(base_url()."search_patient_list_view");?>
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
						<table class="table table-hover align-middle mb-0 table-bordered" style="width: 100%;" id="patient-table">
							<thead>
							<tr>
								<th width="1%">No.</th>
								<th>Patient Name</th>
								<th>Admission<br>Date & Time</th>
								<th>Room</th>
								<th>Religion</th>
								<th>Diet</th>
								<th width="10%"></th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($inpatient as $list){
								echo "<tr style='font-size:12px;'>";
								echo "<td>$x.</td>";
								echo "<td>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";
								echo "<td>$list[dateadmitted] ".date('h:i A',strtotime($list['timeadmitted']))."</td>";
								echo "<td>$list[room]</td>";
								echo "<td>$list[religion]</td>";
								$diet=$this->Dietary_model->getSingleDiet($list['caseno']);
								echo "<td>$diet[description]</td>";
								?>
								<td align="center" width="15%">
									<a class="btn btn-success btn-sm text-white" href="<?=base_url();?>patient_list_view_details/<?=$list['caseno'];?>"><i class="icofont-eye"></i> View</a>
									<a href="<?=base_url();?>print_diet_tag/<?=$list['caseno'];?>" class="btn btn-info btn-sm text-white" target="_blank"><i class="icofont-printer"></i> Print Tag</a>
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
