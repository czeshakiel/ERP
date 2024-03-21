<script>
	function search_history(){
		document.getElementById('loadermain').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Searching.....";
	}
</script>
<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h4 class="fw-bold mb-0"><?=$title;?></h4>
				</div>
			</div>
		</div> <!-- Row end  -->
		<?php if($this->session->save_success){ ?>
			<div class="alert alert-success" role="alert"><?=$this->session->save_success;?></div>
		<?php } ?>
		<?php if($this->session->save_failed){ ?>
			<div class="alert alert-danger" role="alert"><?=$this->session->save_failed;?></div>
		<?php } ?>
		<div class="row align-item-center">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h4>Charge List</h4></td>
								<td  width="10%" style="vertical-align: bottom;">
									<a href="#" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#NewChargeBOD"><i class="icofont-plus-circle"></i> Create Request</a>
								</td>
								<?=form_open(base_url()."search_charge_to_bod",array('onsubmit' => 'search_history();'));?>
								<td width="20%">
									<label>BOD</label>
									<select name="branch" class="form-select" required>
										<?php
										foreach($bod as $branch){
											echo "<option value='$branch[name]'>$branch[name]</option>";
										}
										?>
									</select>
								</td>
								<td  width="10%">
									<label>Start Date</label>
									<input type="date" name="startdate" class="form-control">
								</td>
								<td  width="10%">
									<label>End Date</label>
									<input type="date" name="enddate" class="form-control">
								</td>
								<td  width="7%" style="vertical-align: bottom;">
									<button type="submit" class="btn btn-primary"><i class="icofont-search"></i> Search</button>
								</td>
								<?=form_close();?>
								<?php
								if(count($items)>0){
									?>
								<td width="7%" style="vertical-align: bottom;">									
									<a href="<?=base_url();?>print_charge_bod/<?=$board;?>/<?=$startdate;?>/<?=$enddate;?>" target="_blank" class="btn btn-warning"><i class="icofont-print"></i> Print All</a>
								</td>
								<?php
							}
							?>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<div style="position: absolute; left:45%;" align="center"  id="loadermain">
							<div class="spinner-border text-center" style="width: 10rem; height: 10rem;" role="status"></div>
							<h5 id="loaderlabel">Saving.....</h5>
						</div>
						<table id="employee-table" class="table table-hover align-middle mb-0" style="width: 100%;">
							<thead>
							<tr>
								<th>#</th>
								<th>Charge Slip No.</th>
								<th>Date</th>
								<th>Charge To</th>
								<th width="10%">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($items as $item){
								$charge=str_replace('CHARGE TO ','',$item['trantype']);
								$edit="";
								$print="";
								if($item['isid']==""){
									$edit="";
									$print="style='display:none;'";
								}else{
									$edit="style='display:none;'";
									$print="";
								}
								echo "<tr>";
								echo "<td>$x.</td>";
								echo "<td>$item[po]</td>";
								echo "<td>$item[datearray]</td>";
								echo "<td>$charge</td>";
								echo "<td>"; ?>
									<?=form_open(base_url()."manage_charge");?>
										<input type="hidden" name="invno" value="<?=$item['po'];?>">
									<input type="hidden" name="bod" value="<?=$charge;?>">
								<input type="hidden" name="transdate" value="<?=date('Y-m-d');?>">
										<button type="submit" class='btn btn-success btn-sm text-white' <?=$edit;?>><i class='icofont-ui-edit'></i> Edit</button>
								<?=form_close();?>
							<?php
									echo "<a href='".base_url()."print_transfer/$item[po]' target='_blank' class='btn btn-warning btn-sm text-white' $print><i class='icofont-ui-add'></i> Print</a>
									 </td>";
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
