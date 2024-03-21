<div class="tab-content">
	<div class="tab-pane fade show active" id="list-view">
		<div class="row clearfix g-3">
			<div class="col-lg-12">
				<div class="card mb-3">
					<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
						<h6 class="mb-0 fw-bold "><?=$title;?></h6>
					</div>
				</div>						
				<div class="row">
					<!-- <div class="col-lg-4">
						<div class="card">
							<div class="card-header">
								<b>Daily Collection</b>
							</div>
							<div class="card-body">
								<form action="../cashier/collectionportal.php" target="_blank" method="GET">
								<input type="hidden" name="nursename" value="<?=str_replace('%20',' ',$this->session->fullname);?>">								
									<table width="100%" border="0" cellpadding="4" cellspacing="2">
										<tr>
											<td width="20%">Report Date:</td>
											<td><input type="date" name="startdate" class="form-control" required>
										</tr>
										<tr>
											<td colspan="2" style="background: lightgreen;">OR SET 1</td>
										</tr>
										<tr>
											<td width="20%">Start OR #:</td>
											<td><input type="text" name="orstart" class="form-control"></td>
										</tr>
										<tr>
											<td width="20%">End OR #:</td>
											<td><input type="text" name="orend" class="form-control"></td>
										</tr>
										<tr>
											<td colspan="2" style="background: lightgreen;">OR SET 2</td>
										</tr>
										<tr>
											<td width="20%">Start OR #:</td>
											<td><input type="text" name="orstart1" class="form-control"></td>
										</tr>
										<tr>
											<td width="20%">End OR #:</td>
											<td><input type="text" name="orend1" class="form-control"></td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<td width="20%">Report Type:</td>
											<td>
												<select name="stat" class="form-select" required>
													<option value="">Select Report Type</option>
													<option value="CashOR">IPD/OPD Collection per OR</option>
	                                                <option value="Cash1">IPD/OPD Collection Detailed</option>
	                                                <option value="Cash2">RDU Collection Detailed</option>
	                                                <option value="Senior">Medicines</option>
	                                                <option value="Senior1">Medicines Detailed</option>
	                                                <option value="Other">Other Fees</option>
												</select>
											</td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<td width="20%">&nbsp;</td>
											<td><input type="submit" name="submit" class="btn btn-success text-white" value="Generate"></td>
										</tr>
									</table>
								</form>
							</div>
						</div>
					</div> -->
					<div class="col-lg-4">
						<div class="card">
							<div class="card-header">
								<b>Daily Collection</b>
							</div>
							<div class="card-body">
								<form action="../cashier/collectionportal.php" target="_blank" method="GET">
								<input type="hidden" name="nursename" value="<?=str_replace('%20',' ',$this->session->fullname);?>">								
									<table width="100%" border="0" cellpadding="4" cellspacing="2">
										<tr>
											<td width="20%">Report Date:</td>
											<td><input type="date" name="startdate" class="form-control" required>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<td width="20%">Department:</td>
											<td>
												<select name="department" class="form-select" required>
													<option value="">Select Department</option>
													<?php
													if($this->session->dept=="RDU" || $this->session->dept=="CASHIER4"){
														?>
														<option value="CASHIER4">CASHIER RDU</option>	                                                
														<?php
													}else if($this->session->dept=="CASHIER2"){
														?>
														<option value="CASHIER2">CASHIER OPD</option>
														<?php
												}else if($this->session->dept=="CASHIER3"){
														?>
														<option value="CASHIER3">CASHIER PHARMA</option>
														<?php
												}else{
														?>
														<option value="CASHIER">CASHIER MAIN</option>
		                                                <option value="CASHIER2">CASHIER OPD</option>
		                                                <option value="CASHIER3">CASHIER PHARMA</option>
		                                                <option value="CASHIER4">CASHIER RDU</option>	                                                
														<?php
													}
													?>													
												</select>
											</td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<td width="20%">Report Type:</td>
											<td>
												<select name="stat" class="form-select" required>
													<option value="">Select Report Type</option>													
														<?php
														if($this->session->dept=="CASHIER2" || $this->session->dept=="CASHIER3"){
															?>
															<option value="CashOR">IPD/OPD Collection per OR</option>
															<option value="Cash1">IPD/OPD Collection Detailed</option>
															<option value="Senior">Medicines</option>
	                                                		<option value="Senior1">Medicines Detailed</option>
															<?php
														}else if($this->session->dept=="CASHIER4"){
															?>
															<option value="CashOR">IPD/OPD Collection per OR</option>
															<option value="Cash1">IPD/OPD Collection Detailed</option>
															<option value="Cash2">RDU Collection Detailed</option>
															<?php
														}
														else{
														?>
														<option value="CashOR">IPD/OPD Collection per OR</option>
													<option value="CashORMain">IPD/OPD Collection per OR (CASHIER MAIN ONLY)</option>
	                                                <option value="Cash1">IPD/OPD Collection Detailed</option>
	                                                <option value="Cash2">RDU Collection Detailed</option>
	                                                <option value="Senior">Medicines</option>
	                                                <option value="Senior1">Medicines Detailed</option>
	                                                <option value="Other">Other Fees</option>
	                                                <?php
														}
														?>
												</select>
											</td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<td width="20%">Shift:</td>
											<td>
												<select name="shift" class="form-select" required>
													<option value="">Select Shift</option>
													<option value="1">Shift 1</option>
	                                                <option value="2">Shift 2</option>
	                                                <option value="3">Shift 3</option>
	                                                <option value="all">All</option>
												</select>
											</td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<td width="20%">&nbsp;</td>
											<td><input type="submit" name="submit" class="btn btn-success text-white" value="Generate"></td>
										</tr>
									</table>
								</form>
							</div>
						</div>
					</div>
					<?php
					if($this->session->dept=="CASHIER" || $this->session->dept=="CASHIER4"){
					?>
					<div class="col-lg-4">
						<div class="card">
							<div class="card-header">
								<b>Daily Collection Summary</b>
							</div>
							<div class="card-body">
								<form action="../cashier/collectionportal.php" target="_blank" method="GET">
								<input type="hidden" name="nursename" value="<?=str_replace('%20',' ',$this->session->fullname);?>">								
									<table width="100%" border="0" cellpadding="4" cellspacing="2">
										<tr>
											<td width="20%">Report Date:</td>
											<td><input type="date" name="startdate" class="form-control" required>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>																				
										<tr>
											<td width="20%">Report Type:</td>
											<td>
												<select name="stat" class="form-select" required>
													  <option value="CASH SUMMARY">CASH COLLECTION SUMMARY</option>
													  <option value="CASH SUMMARY BETA">CASH COLLECTION SUMMARY BETA</option>
                                              		  <option value="CASH OVERALL">CASH COLLECTION SUMMARY - OVERALL</option>
												</select>
											</td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>										
										<tr>
											<td width="20%">&nbsp;</td>
											<td><input type="submit" name="submit" class="btn btn-success text-white" value="Generate"></td>
										</tr>
									</table>
								</form>
							</div>
						</div>
					</div>
					<?php
				}
					?>
				</div>
			</div>
		</div>					
	</div>
</div>