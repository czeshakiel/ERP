<script>
	function search_history(){
		document.getElementById('loaderupdate3').style.display="block";
		document.getElementById('loaderlabel').innerHTML = "Production.....";
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
			<div class="alert alert-danger"><?=$this->session->danger;?></div>
			<?php
		}
		?>
		<div class="row align-item-center">
			<div class="col-md-6">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h5>EXAMINATION GLOVES</h5></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<tr>
								<th>CODE</th>
								<th>DESCRIPTION</th>
								<th>SOH</th>
								<th>ACTION</th>
							</tr>
							<?php
							$pcode="";
							$pcode1="";
							foreach($items as $row){
								$desc=str_replace('ams-','',$row['description']);
								$desc=str_replace('-sup','',$desc);
								$code=$row['prodcode'];
								if($code==$pcode1){

								}else{
									$pcode .=$row['prodcode']."()";
									$pcode1=$code;
								}
								$item=$this->Purchase_model->getItemsProduction($row['code']);
								?>
								<tr>
									<td><?php echo $row['code'];?></td>
									<td><?php echo $desc;?></td>
									<td align='center'><?php echo $row['quantity'];?></td>
									<td align="center"><a href="#" data-bs-toggle="modal" data-bs-target="#ProductionGloves" class="btn btn-primary btn-sm productionGloves" data-id="<?=$row['code'];?>_<?=$item['prodcode'];?>_<?=$desc;?>_<?=$item['proddesc'];?>">Process</a></td>
								</tr>
								<?php
							}
							?>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h5>ALCOHOL</h5></td>
							</tr>
						</table>
					</div>

					<div class="card-body">
						<table class="table table-bordered">
							<tr>
								<th>CODE</th>
								<th>DESCRIPTION</th>
								<th>SOH</th>
								<th>ACTION</th>
							</tr>
							<?php
							$pcode2="";
							$pcode3="";
							foreach($items1 as $row){
								$desc=str_replace('ams-','',$row['description']);
								$desc=str_replace('-sup','',$desc);
								$code=$row['prodcode'];
								if($code==$pcode1){

								}else{
									$pcode2 .=$row['prodcode']."()";
									$pcode3=$code;
								}
								$item=$this->Purchase_model->getItemsProduction($row['code']);
								?>
								<tr>
									<td><?php echo $row['code'];?></td>
									<td><?php echo $desc;?></td>
									<td align='center'><?php echo $row['quantity'];?></td>
									<td align="center"><a href="#" data-bs-toggle="modal" data-bs-target="#ProductionAlcohol" class="btn btn-primary btn-sm productionAlcohol" data-id="<?=$row['code'];?>_<?=$item['prodcode'];?>_<?=$desc;?>_<?=$item['proddesc'];?>">Process</a></td>
								</tr>
								<?php
							}
							?>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h5>EXAMINATION GLOVES PRODUCTION</h5></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<tr>
								<td align='center'>CODE</td>
								<td align='center'>DESCRIPTION</td>
								<td align='center'>SOH</td>
							</tr>
							<?php
							$prodcode=explode('()',$pcode);
							for($i=0;$i<sizeof($prodcode)-1;$i++){
								$item=$this->Purchase_model->getAllProductions($prodcode[$i]);
								$qty=$this->Purchase_model->getAllProductionsQty($prodcode[$i]);
								$desc=str_replace('ams-','',$item['proddesc']);
								$desc=str_replace('-sup','',$desc);
								$soh=$qty['soh'];
								echo "<tr>";
								echo "<td align='left'>$item[prodcode]</td>";
								echo "<td align='left'>$desc</td>";
								echo "<td align='center'>$soh</td>";
								echo "</tr>";
							}
							?>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h5>ALCOHOL PRODUCTION</h5></td>
							</tr>
						</table>
					</div>

					<div class="card-body">
						<table class="table table-bordered">
							<tr>
								<td align='center'>CODE</td>
								<td align='center'>DESCRIPTION</td>
								<td align='center'>SOH</td>
							</tr>
							<?php
							$prodcode=explode('()',$pcode2);
							for($i=0;$i<sizeof($prodcode)-1;$i++){
								$item=$this->Purchase_model->getAllProductions($prodcode[$i]);
								$qty=$this->Purchase_model->getAllProductionsQty($prodcode[$i]);
								$desc=str_replace('ams-','',$item['proddesc']);
								$desc=str_replace('-sup','',$desc);
								$soh=$qty['soh'];
								echo "<tr>";
								echo "<td align='left'>$item[prodcode]</td>";
								echo "<td align='left'>$desc</td>";
								echo "<td align='center'>$soh</td>";
								echo "</tr>";
							}
							?>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h5>O.S 4X4X8 PLY (40s)</h5></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<tr>
								<th>CODE</th>
								<th>DESCRIPTION</th>
								<th>SOH</th>
								<th>ACTION</th>
							</tr>
							<?php
							$pcode="";
							$pcode1="";
							$ocode="";
							foreach($items2 as $row){
								$ocode=$row['code'];
								$desc=str_replace('ams-','',$row['description']);
								$desc=str_replace('-sup','',$desc);
								$code=$row['prodcode'];
								if($code==$pcode1){

								}else{
									$pcode=$row['prodcode'];
									$pcode1=$code;
								}
								$item=$this->Purchase_model->getItemsProduction($row['code']);
								$qty=$this->Purchase_model->getAllProductionsQty($item['code']);
								?>
								<tr>
									<td><?php echo $row['code'];?></td>
									<td><?php echo $desc;?></td>
									<td align='center'><?php echo $qty['soh'];?></td>
									<td align="center"><a href="#" data-bs-toggle="modal" data-bs-target="#ProductionOS" class="btn btn-primary btn-sm productionOS" data-id="<?=$row['code'];?>_<?=$item['prodcode'];?>_<?=$desc;?>_<?=$item['proddesc'];?>">Process</a></td>
								</tr>
								<?php
							}
							?>
						</table>
					</div>
				</div>
			</div>			
		</div><!-- Row end  -->
		<div class="row">
		<div class="col-md-6">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h5>OPACK PRODUCTION</h5></td>
							</tr>
						</table>
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<tr>
								<td align='center'>CODE</td>
								<td align='center'>DESCRIPTION</td>
								<td align='center'>SOH</td>
							</tr>
							<?php
							//$prodcode=explode('()',$pcode);
							$query=$this->Purchase_model->db->query("SELECT * FROM production WHERE code='$ocode'");
							$result=$query->result_array();
							foreach($result AS $item){
								$item=$this->Purchase_model->getAllProductions($item['prodcode']);
								$qty=$this->Purchase_model->getAllProductionsQty($item['prodcode']);
								$desc=str_replace('ams-','',$item['proddesc']);
								$desc=str_replace('-sup','',$desc);
								$soh=$qty['soh'];
								echo "<tr>";
								echo "<td align='left'>$item[prodcode]</td>";
								echo "<td align='left'>$desc</td>";
								echo "<td align='center'>$soh</td>";
								echo "</tr>";
							}
							?>
						</table>
					</div>
				</div>
			</div>
	</div>
</div>
