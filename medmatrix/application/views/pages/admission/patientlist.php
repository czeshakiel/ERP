<div class="body d-flex py-lg-3 py-md-2">
	<div class="container-xxl">

		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h3 class="fw-bold mb-0 py-3 pb-2"><?=$title;?></h3>
					<div class="col-12 py-2 w-sm-100">
						<ul class="nav nav-tabs tab-body-header rounded invoice-set" role="tablist">
							<li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#NS1" role="tab">Nurse Station 1</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#NS2" role="tab">Nurse Station 2</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#NS3" role="tab">Nurse Station 3</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#NS5A" role="tab">Nurse Station 5A</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#NS5B" role="tab">Nurse Station 5B</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#NS6" role="tab">Nurse Station 6</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#ICU" role="tab">Intensive Care Unit</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#ER" role="tab">Emergency Room</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#SCU" role="tab">Special Care Unit</a></li>
							<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#COVIDICU" role="tab">COVID ICU</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div> <!-- Row end  -->

		<div class="row justify-content-center">

			<div class="col-lg-12 col-md-12">
				<div class="tab-content">					
					<div class="tab-pane fade show active" id="NS1">
						<div class="row justify-content-center">
							<div class="col-lg-12 col-md-12">
								<table class="table table-hover align-middle mb-0" style="width: 100%;">
									<thead>
									<tr>
										<th width="1%">No.</th>
										<th>Patient Name</th>
										<th>Admission<br>Date & Time</th>
										<th>Room</th>
										<th>HMO</th>
										<th>Doctor</th>								
										<th width="30%">Admitting Diagnosis</th>								
									</tr>
									</thead>
									<tbody>
								<?php
								$patient=$this->Admission_model->getAllPatientByStation('NS1');
								$x=1;
								foreach($patient as $list){
									echo "<tr style='font-size:12px;'>";
									echo "<td>$x.</td>";
									echo "<td><b>$list[employerno]</b><br>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";
									echo "<td>$list[dateadmitted] ".date('h:i A',strtotime($list['timeadmitted']))."</td>";
									echo "<td>$list[room]</td>";
									echo "<td>$list[hmo]</td>";
									echo "<td>DR. $list[apname]</td>";								
									echo "<td>$list[initialdiagnosis]</td>";
									$x++;
								}
								?>
							</tbody>
							</table>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="NS2">
						<div class="row justify-content-center">
							<div class="col-lg-12 col-md-12">
								<table class="table table-hover align-middle mb-0" style="width: 100%;">
									<thead>
									<tr>
										<th width="1%">No.</th>
										<th>Patient Name</th>
										<th>Admission<br>Date & Time</th>
										<th>Room</th>
										<th>HMO</th>
										<th>Doctor</th>								
										<th width="30%">Admitting Diagnosis</th>								
									</tr>
									</thead>
									<tbody>
								<?php
								$patient=$this->Admission_model->getAllPatientByStation('NS2');
								$x=1;
								foreach($patient as $list){
									echo "<tr style='font-size:12px;'>";
									echo "<td>$x.</td>";
									echo "<td><b>$list[employerno]</b><br>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";
									echo "<td>$list[dateadmitted] ".date('h:i A',strtotime($list['timeadmitted']))."</td>";
									echo "<td>$list[room]</td>";
									echo "<td>$list[hmo]</td>";
									echo "<td>DR. $list[apname]</td>";								
									echo "<td>$list[initialdiagnosis]</td>";
									$x++;
								}
								?>
							</tbody>
							</table>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="NS3">
						<div class="row justify-content-center">
							<div class="col-lg-12 col-md-12">
								<table class="table table-hover align-middle mb-0" style="width: 100%;">
									<thead>
									<tr>
										<th width="1%">No.</th>
										<th>Patient Name</th>
										<th>Admission<br>Date & Time</th>
										<th>Room</th>
										<th>HMO</th>
										<th>Doctor</th>								
										<th width="30%">Admitting Diagnosis</th>								
									</tr>
									</thead>
									<tbody>
								<?php
								$patient=$this->Admission_model->getAllPatientByStation('NS3');
								$x=1;
								foreach($patient as $list){
									echo "<tr style='font-size:12px;'>";
									echo "<td>$x.</td>";
									echo "<td><b>$list[employerno]</b><br>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";
									echo "<td>$list[dateadmitted] ".date('h:i A',strtotime($list['timeadmitted']))."</td>";
									echo "<td>$list[room]</td>";
									echo "<td>$list[hmo]</td>";
									echo "<td>DR. $list[apname]</td>";								
									echo "<td>$list[initialdiagnosis]</td>";
									$x++;
								}
								?>
							</tbody>
							</table>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="NS5A">
						<div class="row justify-content-center">
							<div class="col-lg-12 col-md-12">
								<table class="table table-hover align-middle mb-0" style="width: 100%;">
									<thead>
									<tr>
										<th width="1%">No.</th>
										<th>Patient Name</th>
										<th>Admission<br>Date & Time</th>
										<th>Room</th>
										<th>HMO</th>
										<th>Doctor</th>								
										<th width="30%">Admitting Diagnosis</th>								
									</tr>
									</thead>
									<tbody>
								<?php
								$patient=$this->Admission_model->getAllPatientByStation('NS 5A');
								$x=1;
								foreach($patient as $list){
									echo "<tr style='font-size:12px;'>";
									echo "<td>$x.</td>";
									echo "<td><b>$list[employerno]</b><br>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";
									echo "<td>$list[dateadmitted] ".date('h:i A',strtotime($list['timeadmitted']))."</td>";
									echo "<td>$list[room]</td>";
									echo "<td>$list[hmo]</td>";
									echo "<td>DR. $list[apname]</td>";								
									echo "<td>$list[initialdiagnosis]</td>";
									$x++;
								}
								?>
							</tbody>
							</table>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="NS5B">
						<div class="row justify-content-center">
							<div class="col-lg-12 col-md-12">
								<table class="table table-hover align-middle mb-0" style="width: 100%;">
									<thead>
									<tr>
										<th width="1%">No.</th>
										<th>Patient Name</th>
										<th>Admission<br>Date & Time</th>
										<th>Room</th>
										<th>HMO</th>
										<th>Doctor</th>								
										<th width="30%">Admitting Diagnosis</th>								
									</tr>
									</thead>
									<tbody>
								<?php
								$patient=$this->Admission_model->getAllPatientByStation('NS 5B');
								$x=1;
								foreach($patient as $list){
									echo "<tr style='font-size:12px;'>";
									echo "<td>$x.</td>";
									echo "<td><b>$list[employerno]</b><br>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";
									echo "<td>$list[dateadmitted] ".date('h:i A',strtotime($list['timeadmitted']))."</td>";
									echo "<td>$list[room]</td>";
									echo "<td>$list[hmo]</td>";
									echo "<td>DR. $list[apname]</td>";								
									echo "<td>$list[initialdiagnosis]</td>";
									$x++;
								}
								?>
							</tbody>
							</table>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="NS6">
						<div class="row justify-content-center">
							<div class="col-lg-12 col-md-12">
								<table class="table table-hover align-middle mb-0" style="width: 100%;">
									<thead>
									<tr>
										<th width="1%">No.</th>
										<th>Patient Name</th>
										<th>Admission<br>Date & Time</th>
										<th>Room</th>
										<th>HMO</th>
										<th>Doctor</th>								
										<th width="30%">Admitting Diagnosis</th>								
									</tr>
									</thead>
									<tbody>
								<?php
								$patient=$this->Admission_model->getAllPatientByStation('NS 6');
								$x=1;
								foreach($patient as $list){
									echo "<tr style='font-size:12px;'>";
									echo "<td>$x.</td>";
									echo "<td><b>$list[employerno]</b><br>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";
									echo "<td>$list[dateadmitted] ".date('h:i A',strtotime($list['timeadmitted']))."</td>";
									echo "<td>$list[room]</td>";
									echo "<td>$list[hmo]</td>";
									echo "<td>DR. $list[apname]</td>";								
									echo "<td>$list[initialdiagnosis]</td>";
									$x++;
								}
								?>
							</tbody>
							</table>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="ICU">
						<div class="row justify-content-center">
							<div class="col-lg-12 col-md-12">
								<table class="table table-hover align-middle mb-0" style="width: 100%;">
									<thead>
									<tr>
										<th width="1%">No.</th>
										<th>Patient Name</th>
										<th>Admission<br>Date & Time</th>
										<th>Room</th>
										<th>HMO</th>
										<th>Doctor</th>								
										<th width="30%">Admitting Diagnosis</th>								
									</tr>
									</thead>
									<tbody>
								<?php
								$patient=$this->Admission_model->getAllPatientByStation('ICU');
								$x=1;
								foreach($patient as $list){
									echo "<tr style='font-size:12px;'>";
									echo "<td>$x.</td>";
									echo "<td><b>$list[employerno]</b><br>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";
									echo "<td>$list[dateadmitted] ".date('h:i A',strtotime($list['timeadmitted']))."</td>";
									echo "<td>$list[room]</td>";
									echo "<td>$list[hmo]</td>";
									echo "<td>DR. $list[apname]</td>";								
									echo "<td>$list[initialdiagnosis]</td>";
									$x++;
								}
								?>
							</tbody>
							</table>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="ER">
						<div class="row justify-content-center">
							<div class="col-lg-12 col-md-12">
								<table class="table table-hover align-middle mb-0" style="width: 100%;">
									<thead>
									<tr>
										<th width="1%">No.</th>
										<th>Patient Name</th>
										<th>Admission<br>Date & Time</th>
										<th>Room</th>
										<th>HMO</th>
										<th>Doctor</th>								
										<th width="30%">Admitting Diagnosis</th>								
									</tr>
									</thead>
									<tbody>
								<?php
								$patient=$this->Admission_model->getAllPatientByStation('ER');
								$x=1;
								foreach($patient as $list){
									echo "<tr style='font-size:12px;'>";
									echo "<td>$x.</td>";
									echo "<td><b>$list[employerno]</b><br>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";
									echo "<td>$list[dateadmitted] ".date('h:i A',strtotime($list['timeadmitted']))."</td>";
									echo "<td>$list[room]</td>";
									echo "<td>$list[hmo]</td>";
									echo "<td>DR. $list[apname]</td>";								
									echo "<td>$list[initialdiagnosis]</td>";
									$x++;
								}
								?>
							</tbody>
							</table>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="SCU">
						<div class="row justify-content-center">
							<div class="col-lg-12 col-md-12">
								<table class="table table-hover align-middle mb-0" style="width: 100%;">
									<thead>
									<tr>
										<th width="1%">No.</th>
										<th>Patient Name</th>
										<th>Admission<br>Date & Time</th>
										<th>Room</th>
										<th>HMO</th>
										<th>Doctor</th>								
										<th width="30%">Admitting Diagnosis</th>								
									</tr>
									</thead>
									<tbody>
								<?php
								$patient=$this->Admission_model->getAllPatientByStation('SCU');
								$x=1;
								foreach($patient as $list){
									echo "<tr style='font-size:12px;'>";
									echo "<td>$x.</td>";
									echo "<td><b>$list[employerno]</b><br>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";
									echo "<td>$list[dateadmitted] ".date('h:i A',strtotime($list['timeadmitted']))."</td>";
									echo "<td>$list[room]</td>";
									echo "<td>$list[hmo]</td>";
									echo "<td>DR. $list[apname]</td>";								
									echo "<td>$list[initialdiagnosis]</td>";
									$x++;
								}
								?>
							</tbody>
							</table>
							</div>
						</div>  <!-- Row end  -->
					</div>
					<div class="tab-pane fade" id="COVIDICU">
						<div class="row justify-content-center">
							<div class="col-lg-12 col-md-12">
								<table class="table table-hover align-middle mb-0" style="width: 100%;">
									<thead>
									<tr>
										<th width="1%">No.</th>
										<th>Patient Name</th>
										<th>Admission<br>Date & Time</th>
										<th>Room</th>
										<th>HMO</th>
										<th>Doctor</th>								
										<th width="30%">Admitting Diagnosis</th>								
									</tr>
									</thead>
									<tbody>
								<?php
								$patient=$this->Admission_model->getAllPatientByStation('COVID ICU');
								$x=1;
								foreach($patient as $list){
									echo "<tr style='font-size:12px;'>";
									echo "<td>$x.</td>";
									echo "<td><b>$list[employerno]</b><br>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</td>";
									echo "<td>$list[dateadmitted] ".date('h:i A',strtotime($list['timeadmitted']))."</td>";
									echo "<td>$list[room]</td>";
									echo "<td>$list[hmo]</td>";
									echo "<td>DR. $list[apname]</td>";								
									echo "<td>$list[initialdiagnosis]</td>";
									$x++;
								}
								?>
							</tbody>
							</table>
							</div>
						</div>  <!-- Row end  -->
					</div>
				</div>
			</div>

		</div> <!-- Row end  -->
	</div>
</div>

