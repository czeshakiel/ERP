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
								<th width="10%">Case No & HCN</th>
								<th>Patient Name</th>
								<th>Attending Physician</th>
								<th>Status</th>
								<th width="10%"></th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($outpatient as $list){								
								echo "<tr style='font-size:12px;'>";
								echo "<td>$list[caseno]<br>$list[employerno]</td>";
								echo "<td>$list[patientidno]<br>$list[patientname]</td>";								
								echo "<td>$list[datedischarged] / $list[timedischarged]<br>$list[name]</td>";
								echo "<td>$list[status]</td>";
								?>
								<td align="center" width="10%">
									<a  href="http://192.168.0.100:100/ERP/main/bridge.php?dischargedsummary&caseno=<?=$list['caseno'];?>&username=<?=$this->session->username;?>&nursename=<?=$this->session->fullname;?>&dept=<?=$this->session->dept;?>" class="btn btn-primary btn-sm" title="View Profile"><i class="icofont-eye"></i></a>
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
