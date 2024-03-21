<div class="body d-flex py-lg-1 py-md-2">
	<div class="container-xxl">
		<div class="row clearfix">
			<div class="col-md-12">
				<div class="card border-0 mb-4 no-bg">
					<div class="card-header py-3 px-0 d-flex align-items-center  justify-content-between border-bottom">
						<h6 class=" fw-bold flex-fill mb-0"><?=$title;?></h5>
					</div>
				</div>
			</div>
		</div><!-- Row End -->
		<div class="row g-3">
			<div class="col-xl-12 col-lg-12 col-md-12">
				<?php
				if($this->session->save_success){
					?>
					<div class="alert alert-success"><?=$this->session->save_success;?></div>
					<?php
				}
				?>
				<?php
				$discharge=$this->Admission_model->discharged($patient['caseno']);
				if($discharge['datedischarged']==""){
					$ddate="";
					$dtime="";
					$edit="";
				}else{
					$ddate=date('M-d-Y',strtotime($discharge['datedischarged']));
					$dtime=date('h:i A',strtotime($discharge['timedischarged']));
				}
				?>
				<div class="card teacher-card  mb-3">
					<div class="card-body  d-flex teacher-fulldeatil">
						<div class="profile-teacher pe-xl-4 pe-md-2 pe-sm-4 pe-0 text-center w220 mx-sm-0 mx-auto">
							<?php
							if($patient['sex']=="M"){
								$avatar="avatar3.jpg";
								$sex="icofont-boy";
								$gender="Male";
							}else{
								$avatar="avatar6.jpg";
								$sex="icofont-girl";
								$gender="Female";
							}
							if($patient['senior']=="Y"){
								$senior="Senior";
							}else{
								$senior="Non-Senior";
							}
							$name=$patient['lastname'].", ".$patient['firstname']." ".$patient['middlename']." ".$patient['suffix'];
							$doctor=$this->General_model->fetch_single_doctor_by_code($patient['ap']);
							$nursename=$this->session->fullname;
							?>
							<a href="#">
								<img src="<?=base_url();?>design/images/lg/<?=$avatar;?>" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
							</a>
							<div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
								<h6 class="mb-0 fw-bold d-block fs-6"><?=$patient['firstname'];?></h6>
								<span class="text-muted small">Patient ID: <?=$patient['patientidno'];?></span>
							</div>
						</div>
						<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
							<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?=$name;?></h6>
							<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted">Patient</span>
							<p class="mt-2 small">&nbsp;</p>
							<div class="row g-2 pt-2">
								<div class="col-xl-5">
									<div class="d-flex align-items-center">
										<i class="<?=$sex;?>"></i>
										<span class="ms-2 small"><?=$gender;?> </span>
									</div>
								</div>
								<div class="col-xl-5">
									<div class="d-flex align-items-center">
										<i class="icofont-ui-calendar"></i>
										<span class="ms-2 small"><?=$patient['age'];?> y/o</span>
									</div>
								</div>
								<div class="col-xl-5">
									<div class="d-flex align-items-center">
										<i class="icofont-birthday-cake"></i>
										<span class="ms-2 small"><?=date('m/d/Y',strtotime($patient['dateofbirth']));?></span>
									</div>
								</div>
								<div class="col-xl-5">
									<div class="d-flex align-items-center">
										<i class="icofont-user-male"></i>
										<span class="ms-2 small"><?=$patient['stat1'];?></span>
									</div>
								</div>
								<div class="col-xl-12">
									<div class="d-flex align-items-center">
										<i class="icofont-home"></i>
										<span class="ms-2 small"><?=$patient['street'];?>, <?=$patient['barangay'];?>, <?=$patient['municipality'];?>, <?=$patient['province'];?> <?=$patient['zipcode'];?> </span>
									</div>
								</div>
								<div class="col-xl-5">
									<div class="d-flex align-items-center">
										<i class="icofont-phone-circle"></i>
										<span class="ms-2 small"><?=$patient['patientcontactno'];?></span>
									</div>
								</div>
								<div class="col-xl-5">
									<div class="d-flex align-items-center">
										<i class="icofont-patient-bed"></i>
										<span class="ms-2 small"><?=$patient['room'];?></span>
									</div>
								</div>
								<div class="col-xl-5">
									<div class="d-flex align-items-center">
										<i class="icofont-doctor"></i>
										<span class="ms-2 small">DR. <?=$doctor['name'];?></span>
									</div>
								</div>
								<div class="col-xl-5">
									<div class="d-flex align-items-center">
										<i class="icofont-2checkout"></i>
										<span class="ms-2 small"><?=$patient['employerno'];?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card teacher-card  mb-3">
					<div class="card-body">
						<div style="position: absolute; left:45%;" align="center"  id="loadermain">
							<div class="spinner-border text-center" style="width: 10rem; height: 10rem;" role="status"></div>
							<h5 id="loaderlabel">Saving.....</h5>
						</div>
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
						<h6  class="mb-0 mt-2  fw-bold d-block fs-6">Admission Details</h6>
						<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted"><?=$patient['caseno'];?></span>
						<div class="row g-2 pt-2">
							<table class="table table-bordered">
								<thead>
								<tr>
									<th>Date/Time Admitted</th>
									<th>Admitting Diagnosis</th>
									<th>Date/Time Discharged</th>
									<th>Final Diagnosis</th>
									<th>Disposition</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td style="vertical-align: top;"><?=date('M-d-Y',strtotime($patient['dateadmit']));?> / <?=date('h:i A',strtotime($patient['timeadmitted']));?></td>
									<td style="vertical-align: top;"><?=$patient['initialdiagnosis'];?></td>
									<td style="vertical-align: top;"><?=$ddate;?> / <?=$dtime;?></td>
									<td>
										<?php
										$caserate=$this->General_model->finalcaserate($patient['caseno']);
										foreach($caserate as $case){
											echo $case['icdcode']." - ".$case['description']."<br>";
										}
										?>
									</td>
									<td style="vertical-align: top;"><?=$patient['status'];?>/<?=$patient['disposition'];?></td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="card teacher-card mb-3">
					<div class="card-body">
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
						<div class="row table-responsive">
							<table class="table" width="100%" style="font-size: 12px; font-family: 'Times New Roman';">
								<thead>
									<tr>
										<th>Ref. No.</th>
										<th>Description</th>
										<th>SRP</th>
										<th>Qty</th>
										<th>Disc</th>
										<th>Gross</th>
										<th>Trantype</th>
										<th>PHIC</th>
										<th>HMO</th>
										<th>Excess</th>
										<th>Date</th>
										<th>Status</th>
										<th>User</th>
										<th>Ticket No</th>
										<th>Test</th>
										<th></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php
								$ip="192.168.0.100:100";
								$linkhema = "http://$ip/labprint/hemabody.php";
								$linkother = "http://$ip/labprint/AntigenTest.php";
								$linkmicro = "http://$ip/labprint/Urinalysis-body.php";
								$linkbac = "http://$ip/cgi-bin/fecalysis200.cgi";
								$linkchem = "http://$ip/labprint/bloodchem.php";
								$linknone = "http://$ip/labprint/ABG-body.php";
								foreach($results as $res){
									$testtype=$this->Records_model->getLabTestType($caseno,$res['refno']);
									if($testtype['test']=="hematology"){
										$linked="$linkhema?caseno=$caseno&lab29=$res[refno]";
									}
									else if(($testtype['test']=="chemistry")||($testtype['test']=="serology")){
										$hema=$this->Records_model->getHematology($res['refno']);
										$testno=$hema['testno'];
										$linked="$linkchem?caseno=$caseno&lab29=$res[refno]&testno=$testno";
									}else if($testtype['test']=="serology"){
										$linked="$linkchem?caseno=$caseno&lab29=$res[refno]&testno=$testno";
									}
									else if($testtype['test']=="parasitology"){
										$linked="$linkbac?patient=$patient[patientname]_$caseno&refno=$res[refno]";
									}
									else if($testtype['test']=="covid"){
										$linked="$linkother?caseno=$caseno&lab29=$res[refno]";
									}
									else if($testtype['test']=="clinical microscopy"){
										$linked="$linkmicro?caseno=$caseno&refno=$res[refno]";
									}else{
										if($test=="XRAY"){
											$linked="http://$ip/arv2020/doctorslog/printresult.php?caseno=$caseno&refno=$res[refno]";
										}else{
											$linked="http://$ip/labprint/$res[productdesc]-body.php?caseno=$caseno&refno=$res[refno]";
										}
									}

									echo "<tr>";
									echo "<td>$res[refno]</td>";
									echo "<td>$res[productdesc]</td>";
									echo "<td align='right'>".number_format($res['sellingprice'],2)."</td>";
									echo "<td align='center'>$res[quantity]</td>";
									echo "<td align='right'>".number_format($res['adjustment'],2)."</td>";
									echo "<td align='right'>".number_format($res['gross'],2)."</td>";
									echo "<td align='center'>$res[trantype]</td>";
									echo "<td align='right'>".number_format($res['phic'],2)."</td>";
									echo "<td align='right'>".number_format($res['hmo'],2)."</td>";
									echo "<td align='right'>".number_format($res['excess'],2)."</td>";
									echo "<td align='center'>".date('m/d/Y',strtotime($res['datearray']))."</td>";
									echo "<td align='center'>$res[terminalname]</td>";
									echo "<td>$res[loginuser]</td>";
									echo "<td align='center'>$res[batchno]</td>";

									$sqlTest=$this->Records_model->db->query("SELECT test FROM labtest WHERE caseno='$caseno' AND refno='$res[refno]'");
									$test=$sqlTest->row_array();

                            $zzsql=$this->Records_model->db->query("SELECT * FROM `labresults` WHERE `refno`='".$res['refno']."' LIMIT 0,1");
                            $zzcount=$zzsql->num_rows();
						ini_set("display_errors","ON");
                            if($zzcount==0){
                              if($test['test']=="hematology"){
                                $linked="$linkhema?caseno=$caseno&lab29=$res[refno]";
                              }
                              else if(($test['test']=="chemistry")||($test['test']=="serology")){
                                $sqlTest=$this->Records_model->db->query("SELECT testno FROM hematology WHERE lab29='$res[refno]'");
                                if($sqlTest->num_rows()>0){
                                  $test1=$sqlTest->row_array();
                                  $testno=$test1['testno'];
                                }
                                else{
                                  $testno="";
                                }
                                $linked="$linkchem?caseno=$caseno&lab29=$res[refno]&testno=$testno";
                              }
                              else if($test['test']=="serology"){
                                $linked="$linkchem?caseno=$caseno&lab29=$res[refno]&testno=$testno";
                              }
                              else if($test['test']=="parasitology"){
                                $linked="$linkbac?patient=$patient[patientname]_$caseno&refno=$res[refno]";
                              }
                              else if($test['test']=="covid"){
                                $linked="$linkother?caseno=$caseno&lab29=$res[refno]";
                              }
                              else if($test['test']=="clinical microscopy"){
                                $linked="$linkmicro?caseno=$caseno&refno=$res[refno]";
                              }
                              else{
                                $linked="http://$ip/labprint/".$res['productdesc']."-body.php?caseno=$caseno&refno=$res[refno]";
                              }
                            }
                            else{
                              $stype=$test['test'];

                              $zzfetch=$zzsql->row_array();
                              $printbatch=$zzfetch['printbatchno'];
                              $linked="http://$ip/ERP/extra/LabExpress/PrintResult/?caseno=$caseno&patid=$patient[patientidno]&printbatchno=$printbatch&stype=$stype&asd=$nursename";
                            }

									echo "<td align='center'>$testtype[test]</td>";
									echo "<td>";
									if($test=="LABORATORY"){
									$a=0;
									$atno="";
									$verifier=$this->Records_model->getVerifier($res['refno']);
									if($verifier != ""){
										$a=1;
										$atno=$verifier['testno'];
									}
									$rd=$this->Records_model->checkVerified($res['refno']);
									$redit=$rd['redit'];
									if(($a==1)&&($redit!=0)){
										echo "<div align='center' title='Result editing is locked.' class='arial s11 black bold' style='cursor: pointer;'";?> onclick="<?php echo "window.open('Unlock.php?caseno=$caseno&refno=$res[refno]&testno=$atno&user=$this->session->fullname', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=700,width=360,height=250');"; ?>" <?php echo "><i class='icofont-ui-lock'></i></div>";
									}else if($a==1){
										echo "<div align='center' title='Result editing is enabled.' class='arial s11 black bold' style='cursor: pointer;'";?> onclick="<?php echo "window.open('Lock.php?caseno=$caseno&refno=$rno&testno=$atno&user=$userunique', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=700,width=360,height=250');"; ?>" <?php echo "><i class='fa fa-unlock'></i></div>";
									}else{
										echo "<div align='center' title='Result is not verified.' style='color: red;'><i class='icofont-spinner'></i></div>";
									}
									}
									echo "</td>";
									?>
									<td>
									<a href='<?=$linked;?>' target='_blank' class='btn btn-outline-info btn-sm'><i class='icofont-printer'></i></a> 
									<a href="<?=base_url();?>issue_second_copy_lab/<?=$patient['patientidno'];?>/<?=$caseno;?>/<?=$res['productdesc'];?>/<?=$testing;?>/testresultview" class="btn btn-outline-primary btn-sm" title="2nd Copy" onclick="return confirm('Do you wish to issue 2nd copy for this document?');return false;"><i class="icofont-logout"></i></a>
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
			</div>
		</div><!-- Row End -->

	</div>
</div>
