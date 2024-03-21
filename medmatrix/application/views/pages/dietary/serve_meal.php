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
		if($this->session->save_success){
			?>
			<div class="alert alert-success"><?=$this->session->save_success;?></div>
			<?php
		}
		?>
		<?php
		if($this->session->save_failed){
			?>
			<div class="alert alert-danger"><?=$this->session->save_failed;?></div>
			<?php
		}
		?>
		<?=form_open(base_url()."meal_served");?>
		<input type="hidden" name="meal_type" value="<?=$meal_type;?>">
		<div class="row align-item-center">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td align="right"><input type="submit" class="btn btn-success text-white" name="submit" value="SERVE <?=mb_strtoupper($meal_type);?>" onclick="return confirm('Do you wish to serve <?=$meal_type;?>?');return false;"></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table class="table table-hover align-middle mb-0 table-bordered" style="width: 100%;">
							<thead>
							<tr>
								<td width="1%"><b>No.</b></td>
								<td><b>Case No.</b></td>
								<td><b>Patient Name</b></td>
								<td align="center"><label><b>Check All</b><br><input type="checkbox" onclick="checkAll()" style="width: 20px;height: 20px;"></label></td>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($inpatient as $list){
								$serve=$this->Dietary_model->checkDiet($list['caseno']);
								if($serve[$meal_type]==0){
									echo "<tr style='font-size:12px;'>";
									echo "<td>$x.</td>";
									echo "<td>$list[caseno]</td>";
									echo "<td>$list[patientname]</td>";
									echo "<td align='center'><input type='checkbox' name='caseno[]' value='$list[caseno]' class='pl' style='width:20px; height:20px;'></td>";
									$x++;
								}
								echo "</tr>";

							}
							?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div><!-- Row end  -->
		<?=form_close();?>
	</div>
</div>
