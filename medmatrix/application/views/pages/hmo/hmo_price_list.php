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
								<td><h6 class="mb-0 fw-bold ">Item List</h6></td>
							</tr>								
						</table>
					</div>
					<div class="card-body">
						<table class="table table-hover align-middle mb-0 nowrap dataTable no-footer dtr-inline" style="width: 100%;" id="patient-table">
							<thead>
							<tr>		
								<th>#</th>
								<th>Description</th>						
								<th>Cash Price</th>	
								<?php if($department=="HMO"){ ?>
								?>							
								<th>Charge Price</th>
								<th>HMO Price</th>
								<?php
                                    $sqlCompany=$this->Hmo_model->db->query("SELECT company FROM comsplist GROUP BY company");
                                    if($sqlCompany->num_rows()>0){
                                    	$comps=$sqlCompany->result_array();
                                      foreach($comps as $comp){
                                        echo "<th align='center' width='10%'>$comp[company] PRICE</th>";
                                      }
                                    }
                                  }
                                    ?>								
							</tr>
							</thead>
							<tbody>
							<?php
							$hmo="";
							// if($this->session->dept=="HMO"){
							// 	$hmo="style='display:none;'";
							// }
							$x=1;
							foreach($items as $list){
								$description=$list['itemname'];
                                        $cash=$list['opd'];
                                        $charge=$list['philhealth'];
                                        if($list['code']=='210916093805p-3' || $list['code']=='210916093934p-3' || $list['code']=='210916083459p-3' || $list['code']=='210916093831p-3'){
                                            $sqlAdd=$this->Hmo_model->db->query("SELECT r.itemname,p.opd,p.philhealth,r.code FROM receiving r INNER JOIN productsmasterlist p ON p.code=r.code WHERE r.code='$list[SEMIPRIVATE]'");
                                            $add=$sqlAdd->row_array();
                                            $description=$description." / ".$add['itemname'];
                                            $cash=$cash+$add['opd'];
                                            $charge=$charge+$add['philhealth'];

                                        }
                                      echo "
                                        <tr>
                                        	<td>$x.</td>
                                          <td>$description</td>
                                          <td align='right'>".number_format($cash,2)."</td>";
                                          if($department=="HMO"){
                                          	echo "
                                          <td align='right'>".number_format($charge,2)."</td>
                                          <td align='right'>".number_format($list['hmo'],2)."</td>
                                          ";
                                          $sqlCompany=$this->Hmo_model->db->query("SELECT price FROM comsplist WHERE `code`='$list[code]' GROUP BY company");
                                          if($sqlCompany->num_rows()>0){
                                          	$comps=$sqlCompany->result_array();
                                            foreach($comps as $comp){
                                              $price=number_format($comp['price'],2);
                                              echo "<td align='right'>$price</td>";
                                            }
                                          }else{
                                            $price=number_format(0,2);
                                            echo "<td align='right'>$price</td>";
                                          }
                                        }
                                        echo "</tr>
                                      ";
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
