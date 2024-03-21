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
								<th>Charge To</th>
								<th>Charges</th>
								<th width="10%">Remarks</th>
								<th width="10%"></th>
							</tr>
							</thead>
							<tbody>
							<?php							
							$x=1;
							foreach($arpatient as $list){
								$query=$this->Hmo_model->getAllLabResult($list['caseno']);
								$pending=0;
								$done=0;
								foreach($query as $item){
									if($item['terminalname']=="pending"){
										$pending++;
									}else{
										$done++;
									}
								}						
								if($pending==0){
									$remarks="For Discharge";
									$color="background-color:red;";
								}else{
									$remarks="";
									$color="";
								}
								echo "<tr style='font-size:12px;$color'>";
								echo "<td>$x.</td>";
								echo "<td>$list[caseno]<br><b>$list[lastname], $list[firstname] $list[middlename] $list[suffix]</b></td>";
								echo "<td>$list[dateadmitted] ".date('h:i A',strtotime($list['timeadmitted']))."</td>";
								?>
								<td align="center">
									<?=$list['hmo'];?><?=$list['addemployer'];?>
								</td>
								<td align="center" width="10%">
									<?=$pending;?> Pending<br>
									<?=$done;?> Testdone
								</td>
								<td align="center">
									<?=$remarks;?>
								</td>
								<td>
									<a href="<?=base_url();?>view_profile/<?=$list['caseno'];?>" class="btn btn-success btn-sm">View Profile</a>
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
