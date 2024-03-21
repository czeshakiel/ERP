<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h4 class="fw-bold mb-0"><a href="<?=base_url();?>rdu_list"><i class="icofont-arrow-left"></i> Back </a>| <?=$title;?></h4>
				</div>
			</div>
		</div> <!-- Row end  -->
        <?php
                if($this->session->save_success){
                    ?>
					<div class="alert alert-success"><?=$this->session->save_success;?></div>
                    <?php
                }
                if($this->session->save_failed){
                    ?>
					<div class="alert alert-danger"><?=$this->session->save_failed;?></div>
                    <?php
                }
                ?>                
		<div class="row align-item-center">
			<div class="col-md-12">
                <div align="center">
                <h4>HMO ASSITANCE</h4>
                </div>				
				<div class="card mb-3">
					<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                        <?php
                        $accttitle=$this->Dialysis_model->getGL($patientidno);
                        ?>
                        <h6 class="mb-1 fw-bold ">Guarantee Letter:<br>
                            <?php
                            foreach($accttitle as $item){
                                echo $item['gl_company']." : ".number_format($item['amount'],2)."<br>";
                            }
                            ?>
                        </h6>						
					</div>
					<div class="card-body">
						<div class="row g-3 align-items-center">
                            <?=form_open(base_url()."save_gl_posting");?>
                            <input type="hidden" name="caseno" value="<?=$caseno;?>">
                            <input type="hidden" name="patientidno" value="<?=$patientidno;?>">
                            <table class="table">
                                <tr>
                                    <td align="left"><u>Item Name</u></td>
                                    <td align="right"><u>Excess</u></td>
                                    <td align="right"><u>Amount Allocated</u></td>
                                    <td align="right"><u>HMO</u></td>
                                </tr>
                                <?php
                                $hospitalbill=0;
                                foreach($allocation as $allo){
                                    
                                    $hospitalbill +=$allo['totalexcess'];
                                }
                                $hospay=$hosp['amount'];
                                $totalbalance=$hospitalbill-$hospay;
                                $count=0;
                                if($totalbalance>0){
                                    $count++;
                                    echo "<input type='hidden' name='balance' value='$totalbalance'>";
                                    echo "<tr>";
                                        echo "<td>HOSPITAL BILL</td>";
                                        echo "<td align='right'>".number_format($totalbalance,2,".",",")."</td>";
                                        echo "<td align='right'><input type='text' name='amount' value='$totalbalance' class='form-control hospitalbill' style='width:150px; text-align:right'></td>";
                                        echo "<td align='right'>";
                                        
                                        echo "<select name='gl_company' class='item form-control' style='width:300px;' required>";                                        
                                            foreach($accttitle as $hmo){
                                                echo "<option value='$hmo[gl_company]'>$hmo[gl_company]</option>";                                                
                                            }                 
                                            echo "<option value='DISCOUNT'>DISCOUNT</option>";
                                            echo "<option value='AR TRADE'>AR TRADE</option>";
                                            echo "</select>";                                            
                                            echo "</td>";
                                          echo "</tr>";
                                }
                                if($count>0){
                                    $view="";
                                }else{
                                    $view="style='display:none;'";
                                }
                                ?>
                                <tr>
                                    <td colspan="4" align="center">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Post Allocation" <?=$view;?>>
                                    </td>
                                </tr>
                            </table>                                                                
                            <?=form_close();?>
						</div>
					</div>
				</div>
                <div class="card mb-3">
					<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
						<h6 class="mb-0 fw-bold ">Allocation History</h6>
					</div>
					<div class="card-body">
						<div class="row g-3 align-items-center">
                        <table class="table">
                                        <!-- <tr>
                                            <td colspan="4"><a href="http://192.168.0.100:100/2017codes/SOA/StatementOfAccountPHICVerHMO.php?patientidno=<?=$patientidno;?>&caseno=<?=$caseno;?>&uname" target="_blank" class="btn btn-warning">View SOA</a></td>
                                        </tr> -->                                        
                                        <?php
                                          $sqlCollect=$this->Hmo_model->getAllocationHistory($caseno);
                                          $totalposted=0;
                                          if(count($sqlCollect)>0){
                                            foreach($sqlCollect as $tbal){
                                              if($tbal['type']=='pending'){
                                                $hide="";
                                              }else{
                                                $hide="style='display:none'";
                                              }
                                              if($tbal['accttitle']=='PHARMACY/MEDICINE' || $tbal['accttitle']=='PHARMACY/SUPPLIES' || $tbal['accttitle']=='LABORATORY' || $tbal['accttitle']=='ULTRASOUND' || $tbal['accttitle']=='XRAY' || $tbal['accttitle']=='CANCELLED' || $tbal['accttitle']=='ECG' || $tbal['accttitle']=='EEG' || $tbal['accttitle']=='MEDICAL SURGICAL SUPPLIES'){

                                              }else{
                                              $totalposted +=$tbal['amount'];
                                              $rem='Do you wish to remove this item?';
                                              echo "<tr><td>$tbal[description] ($tbal[accttitle])</td><td align='right'>".number_format($tbal['amount'],2,".",",")."</td>";
                                              ?>
                                              <td width='5%' style='text-indent:10px;'><a href="<?=base_url();?>remove_gl_posting/<?=$caseno;?>/<?=$patientidno;?>/<?=$tbal['refno'];?>" onclick="return confirm('Do you wish to remove this item?');return false;" <?=$hide;?>>Remove</a></td>
                                              <?php echo "<td width='50%'>&nbsp;</td></tr>";
                                            }
                                            }
                                          }
                                         ?>
                                         <tr>
                                            <td colspan="4">&nbsp;</td>
                                         </tr>
                                         <tr>
                                            <td>TOTAL</td><td align='right'> <?=number_format($totalposted,2,".",",");?></td><td width='70%' colspan='2'>&nbsp;</td>
                                        </tr>
								</table>                            
						</div>
					</div>
				</div>               							
			</div>
		</div><!-- Row end  -->

	</div>
</div>
