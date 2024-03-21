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
								<td><h4>Pending Return List</h4></td>
								<td align="right"><a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CreateReturn">Create Return</a></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<div style="position: absolute; left:45%;" align="center"  id="loadermain">
							<div class="spinner-border text-center" style="width: 10rem; height: 10rem;" role="status"></div>
							<h5 id="loaderlabel">Saving.....</h5>
						</div>
						<table id="employee-table" class="table" width="100%">
							<thead>
							<tr>
								<td>Return ID</td>
								<td>Supplier</td>
								<td>Request Date</td>
								<td>Action</td>
							</tr>
							</thead>
							<tbody>
							<?php
							foreach($pending as $pitem){
								echo "<tr>";
								echo "<td>$pitem[invno]</td>";
								echo "<td>$pitem[suppliername]</td>";
								echo "<td>$pitem[date]</td>";
								?>
								<td>
									<?=form_open(base_url()."update_return");?>
									<input type="hidden" name="invno" value="<?=$pitem['invno'];?>">
									<input type="hidden" name="supplier" value="<?=$pitem['suppliercode'];?>_<?=$pitem['suppliername'];?>">
									<input type="hidden" name="transdate" value="<?=$pitem['datearray'];?>">
									<button type="submit" class="btn btn-success btn-sm text-white"><i class="icofont-eye"></i> View</button>
									<?=form_close();?>
								</td>
								<?php
								echo "</tr>";
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
