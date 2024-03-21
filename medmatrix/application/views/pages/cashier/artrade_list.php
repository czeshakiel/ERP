<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row clearfix g-3">
			<div class="col-xl-12 col-lg-12 col-md-12 flex-column">
				<div class="row g-3">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
								<h6 class="mb-0 fw-bold "><?=$title;?></h6>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<?=form_open(base_url()."artrade_list_search");?>
								<table width="100%" border="0">
									<tr>
										<td width="10%">Search Patient:</td>
										<td width="30%"><input type="text" name="description" class="form-control" placeholder="Type patient name here.."></td>
										<td><input type="submit" name="search" class="btn btn-success" value="Search"></td>
									</tr>
								</table>
								<?=form_close();?>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-12">									
										<?php
										if($this->session->dept=="HMO"){
											$hmo="";
											$cashier="style='display:none;'";
										}else{
											$cashier="";
											$hmo="style='display:none;'";
										}
										if($search_result){
											echo "<table class='table table-bordered'>";
												echo "<tr>";
													echo "<td align='center'>Caseno</td>";
													echo "<td align='center'>Patient Name</td>";													
													echo "<td align='center'>Amount</td>";
													echo "<td align='center'>Date</td>";
													echo "<td align='center'>Action</td>";
												echo "</tr>";
											foreach ($search_result as $item) {
												echo "<tr>";
													echo "<td>$item[acctno]</td>";
													echo "<td>$item[acctname]</td>";
													echo "<td align='right'>".number_format($item['amount'],2)."</td>";
													echo "<td align='center'>$item[date]</td>";
													echo "<td align='center'><a href='".base_url()."artrade_indexcard/$item[acctno]' class='btn btn-primary btn-sm' target='_blank' $cashier>Index Card</a><a href='".base_url()."pf_allocation/$item[acctno]' class='btn btn-info btn-sm text-white' $hmo>View</a></td>";
												echo"</tr>";
											}
											echo "</table>";
										}
										?>									
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
