<div>
						<table style="width: 100%; border-collapse:collapse;font-size:10px;" border="1">							
							<tr>
								<th width="2%">No.</th>								
								<th>Patient Name</th>
								<th>Room</th>
								<th>Breakfast</th>
								<th>Lunch</th>
								<th>Dinner</th>
								<th>Diet</th>
							</tr>							
							<tbody>
							<?php
							$x=1;
							foreach($inpatient as $list){
								echo "<tr style='font-size:12px;'>";
								echo "<td>$x.</td>";								
								echo "<td>$list[patientname]</td>";
								echo "<td>$list[room]</td>";
								$serve=$this->Dietary_model->checkDiet($list['caseno']);
								if($serve['breakfast']=="" || $serve['breakfast']==0){
									$breakfast="";
								}else{
									$breakfast="";
								}
								if($serve['lunch']=="" || $serve['lunch']==0){
									$lunch="";
								}else{
									$lunch="";
								}
								if($serve['dinner']=="" || $serve['dinner']==0){
									$dinner="";
								}else{
									$dinner="";
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