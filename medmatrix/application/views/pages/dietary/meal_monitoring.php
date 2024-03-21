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

								<td><h6 class="mb-0 fw-bold ">List of Patient </h6></td>
								<td width="30%">&nbsp;</td>
								<td align="right"><a href="#" class="btn btn-success btn-sm text-white" data-bs-toggle="modal" data-bs-target="#ServeMeal"><i class="icofont-spoon-and-fork"></i> Serve Meal</a></td>
<!--								--><?//=form_open(base_url()."search_patient_list_view");?>
<!--								<td width="30%" align="right">-->
<!---->
<!--									<input type="text" name="searchme" class="form-control" placeholder="Search Patient here.. e.g. Last Name First Name">-->
<!---->
<!--								</td>-->
<!--								<td width="6.5%" align="right">-->
<!--									<button type="submit" name="submit" class="btn btn-primary"><i class="icofont-search"></i> Search</button>-->
<!--								</td>-->
<!--							</tr>-->
<!--							--><?//=form_close();?>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table class="table table-hover align-middle mb-0 table-bordered" style="width: 100%;" id="patient-table">
							<thead>
							<tr>
								<th width="1%">No.</th>
								<th>Case No.</th>
								<th>Patient Name</th>
								<th>Room</th>
								<th>Breakfast</th>
								<th>Lunch</th>
								<th>Dinner</th>
								<th>Diet</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($inpatient as $list){
								echo "<tr style='font-size:12px;'>";
								echo "<td>$x.</td>";
								echo "<td>$list[caseno]</td>";
								echo "<td>$list[patientname]</td>";
								echo "<td>$list[room]</td>";
								$serve=$this->Dietary_model->checkDiet($list['caseno']);
								if($serve['breakfast']=="" || $serve['breakfast']==0){
									$breakfast="<i class='icofont-not-allowed text-danger'></i>";
								}else{
									$breakfast="<i class='icofont-check text-success'></i>";
								}
								if($serve['lunch']=="" || $serve['lunch']==0){
									$lunch="<i class='icofont-not-allowed text-danger'></i>";
								}else{
									$lunch="<i class='icofont-check text-success'></i>";
								}
								if($serve['dinner']=="" || $serve['dinner']==0){
									$dinner="<i class='icofont-not-allowed text-danger'></i>";
								}else{
									$dinner="<i class='icofont-check text-success'></i>";
								}
								echo "<td align='center'>$breakfast</td>";
								echo "<td align='center'>$lunch</td>";
								echo "<td align='center'>$dinner</td>";
								$diet=$this->Dietary_model->getSingleDiet($list['caseno']);
								echo "<td>$diet[description]</td>";
								?>
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
