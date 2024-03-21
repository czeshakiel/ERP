<script>
    function updateTotalAss(){
    //var loa=$('#loaless').val();
 var itemCount = document.getElementsByClassName("itemclass"); 
 var total = 0;
 var id= '';
 for(var i = 0; i < itemCount.length; i++)
 {
   id = "tamount"+(i+1);
   //total = total + parseFloat(itemCount[i].value);
//if(total + parseFloat(document.getElementById(id).value) <= loa){
   total = total +  parseFloat(document.getElementById(id).value);
//}else{
   //document.getElementById(id).value=0;
// }
 }
document.getElementById('totalexcess').value = total.toFixed(2);
//return total;
  }
</script>
<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h4 class="fw-bold mb-0"><a href="<?=base_url();?>admit_ipdlist"><i class="icofont-arrow-left"></i> Back </a>| <?=$title;?></h4>
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
                <h4>HMO ALLOCATION</h4>
                </div>				
				<div class="card mb-3">
					<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
						<h6 class="mb-0 fw-bold ">HCI Fees</h6>
					</div>
					<div class="card-body">
						<div class="row g-3 align-items-center">
                            <?=form_open(base_url()."save_allocation");?>
                            <input type="hidden" name="caseno" value="<?=$caseno;?>">
                            <table class="table">
                                <tr>
                                    <td align="center"><u>Items</u></td>
                                    <td align="right"><u>Gross</u></td>
                                    <td align="right"><u>SC/PWD</u></td>
                                    <td align="right"><u>PHIC</u></td>
                                    <td align="right"><u>HMO</u></td>
                                    <td align="right"><u>Excess</u></td>
                                    <td align="right"><u>Allocate Amount</u></td>
                                </tr>
                                <?php
                                $totalexcess=0;
                                $tamount=0;
                                $totalphic=0;
                                $totalhmo=0;
                                $totaldiscount=0;
                                $gross1=0;
                                $phic1=0;
                                $hmo1=0;
                                $excess1=0;
                                $discount1=0; 
                                $w=1;                               
                                foreach($allocation as $item){
                                    $accounttitle=$item['producttype'];
                                    $gross=0;
                                    $phic=0;
                                    $phic12=0;
                                    $hmo=0;
                                    $discount=0;
                                    $subtype=$this->Hmo_model->getHMOAllocationType($item['id']);
                                    foreach($subtype as $type){
                                        $pat=$this->Hmo_model->db->query("SELECT SUM(sellingprice*quantity) as gross,SUM(phic) as phic,SUM(hmo) as hmo,SUM(adjustment) as discount,SUM(phic1) as phic1 FROM productout WHERE caseno='$caseno' AND excess >= 0 AND quantity > 0 AND gross > 0 AND trantype='charge' AND productsubtype='$type[productsubtype]' GROUP BY productsubtype");
                                        $patient=$pat->row_array();
                                        $excess=0;
                                        $gross +=$patient['gross'];
                                        $phic +=$patient['phic'];
                                        $phic12 +=$patient['phic1'];
                                        $hmo +=$patient['hmo'];
                                        $discount +=$patient['discount'];
                                        $excess +=$gross-$phic-$hmo-$discount-$phic12;
                                    }
                                    if($gross>0){
                                        if($excess==0){
                                          $disabled="disabled";
                                        }else{
                                          $disabled="";
                                        }
                                        if($hmo>0){
                                          $view="";
                                        }else{
                                          $view="style='display:none'";
                                        }
                                        $remarks="Are you sure you want to remove this allocation?";
                                        echo "<input type='hidden' name='producttype[]' value='$accounttitle' />";
                                        echo "<tr>
                                        <td>$accounttitle</td>
                                        <td align='right'>".number_format($gross,2)."</td>
                                        <td align='right'>".number_format($discount,2)."</td>
                                        <td align='right'>".number_format($phic,2)."</td>
                                        <td align='right'>".number_format($hmo,2); 
                                    ?>
                                        <a href="<?=base_url();?>remove_allocation/<?=$caseno;?>/<?=$accounttitle;?>" <?=$view;?> title="Remove" onclick="return confirm('Are you sure you want to remove this allocation?'); return false;"><i class="icofont-bin text-danger"></i></a></td>
                                        <?php
                                        echo "<td align='right'>".number_format($excess,2)."</td>
                                        <td align='right'><input type='text' class='form-control itemclass' onchange='updateTotalAss();' name='amount[]' style='width:100px;text-align:right;' value='0' id='tamount$w'/></td>
                                        </tr>";
                                        $w++;
                                      }
                                      $totalexcess+=$excess;
                                      $tamount+=$gross;
                                      $totalphic+=$phic;
                                      $totalhmo+=$hmo;
                                      $totaldiscount+=$discount;                                      
                                }
                                $grandtotalhmo = $totalhmo+$hmo1;
                                $ll=$this->Hmo_model->getLOA($caseno);                                          
                                $loa=$ll['policyno'];
                                ?>                                
                                <tr>
                                                <td colspan="7"><hr width='100%'>&nbsp;</td>
                                        </tr>
                                        <tr>

                                                <td align="right"><b>TOTAL</b>
                                                </td>
                                                <td align="right"><u><?=number_format($tamount+$gross1,2,".",",");?></u></td>
                                                <td align="right"><u><?=number_format($totaldiscount+$discount1,2,".",",");?></u></td>
                                                <td align="right"><u><?=number_format($totalphic+$phic1,2,".",",");?></u></td>
                                                <td align="right"><u><?=number_format($totalhmo+$hmo1,2,".",",");?></u></td>
                                                <td align="right"><u><?=number_format($totalexcess+$excess1,2,".",",");?></u></td>
                                                <td align="right"><label><input type="submit" name="submit" value="Allocate Amount" class="btn btn-primary" onclick="return confirm('Do you wish to submit allcoation?'); return false;" /></td>
                                        </tr>    
                            </table>            
                            <input type="hidden" name="totalhmo" value="<?=$grandtotalhmo;?>">
                                        <input type="hidden" name="loa" value="<?=$loa;?>">                                                    
                            <?=form_close();?>
						</div>
					</div>
				</div>
                <div class="card mb-3">
					<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
						<h6 class="mb-0 fw-bold ">Professional Fee</h6>
					</div>
					<div class="card-body">
						<div class="row g-3 align-items-center">
                            <table class="table">
                            <?=form_open(base_url()."save_allocation_pf");?>
                            <input type="hidden" name="caseno" value="<?=$caseno;?>">                                                        
                                <tr>
                                    <td align="center"><u>Items</u></td>
                                    <td align="right"><u>Gross</u></td>
                                    <td align="right"><u>SC/PWD</u></td>
                                    <td align="right"><u>PHIC</u></td>
                                    <td align="right"><u>HMO</u></td>
                                    <td align="right"><u>Excess</u></td>
                                    <td align="right"><u>Allocate Amount</u></td>
                                </tr>
                                <?php
                                $gross1=0;
                                $phic1=0;
                                $hmo1=0;
                                $excess1=0;
                                $discount1=0;                                
                                foreach($allocation as $item){
                                    $accounttitle=$item['producttype'];
                                    $gross=0;
                                    $phic=0;
                                    $phic12=0;
                                    $hmo=0;
                                    $discount=0;
                                    $subtype=$this->Hmo_model->getHMOAllocationTypePF($item['id']);
                                    foreach($subtype as $type){
                                        $pat=$this->Hmo_model->db->query("SELECT SUM(sellingprice*quantity) as gross,SUM(phic) as phic,SUM(hmo) as hmo,SUM(adjustment) as discount,SUM(phic1) as phic1, refno, productdesc FROM productout WHERE caseno='$caseno' AND excess >= 0 AND quantity > 0 AND gross > 0 AND trantype='charge' AND productsubtype='$type[productsubtype]' GROUP BY productcode");
                                        $patients=$pat->result_array();
                                        $excess=0;
                                        foreach($patients as $patient){
                                        $gross =$patient['gross'];
                                        $phic =$patient['phic'];
                                        $phic12 =$patient['phic1'];
                                        $hmo =$patient['hmo'];
                                        $discount =$patient['discount'];
                                        $excess =$gross-$phic-$hmo-$discount-$phic12;
                                               if($gross>0){
                                        if($excess==0){
                                          $disabled="disabled";
                                        }else{
                                          $disabled="";
                                        }
                                        if($hmo>0){
                                          $view="";
                                        }else{
                                          $view="style='display:none'";
                                        }                                        
                                        echo "<input type='hidden' name='refno[]' value='$patient[refno]' />";
                                        echo "<tr>
                                        <td>$patient[productdesc]</td>
                                        <td align='right'>".number_format($gross,2)."</td>
                                        <td align='right'>".number_format($discount,2)."</td>
                                        <td align='right'>".number_format($phic,2)."</td>
                                        <td align='right'>".number_format($hmo,2); 
                                    ?>
                                        <a href="<?=base_url();?>remove_allocation_pf/<?=$caseno;?>/<?=$patient['refno'];?>" <?=$view;?> title="Remove" onclick="return confirm('Are you sure you want to remove this allocation?'); return false;"><i class="icofont-bin text-danger"></i></a></td>
                                        <?php
                                        echo "<td align='right'>".number_format($excess,2)."</td>
                                        <td align='right'><input type='text' class='form-control itemclass' name='amount[]' style='width:100px;text-align:right' autocomplete='off' value='0' id='tamount$w' onchange='updateTotalAss()'/></td>
                                        </tr>";
                                        $w++;
                                      }
                                        $gross1 +=$gross;
                                        $phic1 +=$phic;
                                        $hmo1 +=$hmo;
                                        $excess1 +=$excess;
                                        $discount1 +=$discount;
                                    }
                                    }
                             
                                }
                                $grandtotalhmo = $totalhmo+$hmo1;
                                $ll=$this->Hmo_model->getLOA($caseno);                                          
                                $loa=$ll['policyno'];                                
                                ?>
                                <tr>
                                    <td colspan="6" align="right"><b>Total Amount Allocated:</b></td>
                                    <td width="20%"><input type="text" id="totalexcess" style="text-align: right;" class="form-control" value="0">
                                </tr>
                                        <tr>
                                                <td colspan="7"><hr width='100%'></td>
                                        </tr>
                                        <tr>

                                                <td align="right"><b>TOTAL</b>
                                                </td>
                                                <td align="right"><u><?=number_format($gross1,2,".",",");?></u></td>
                                                <td align="right"><u><?=number_format($discount1,2,".",",");?></u></td>
                                                <td align="right"><u><?=number_format($phic1,2,".",",");?></u></td>
                                                <td align="right"><u><?=number_format($hmo1,2,".",",");?></u></td>
                                                <td align="right"><u><?=number_format($excess1,2,".",",");?></u></td>
                                                <td align="right"><label><input type="submit" name="submit" value="Allocate Amount" class="btn btn-primary" onclick="return confirm('Do you wish to submit allcoation?'); return false;" /></td>
                                        </tr>

                                        <input type="hidden" name="totalhmo" value="<?=$grandtotalhmo;?>">
                                        <input type="hidden" name="loa" value="<?=$loa;?>">
                            <?=form_close();?>
						</div>
					</div>
				</div>	
                <div class="card mb-3">					
					<div class="card-body">
						<div class="row g-3 align-items-center">  
                        <tr>
                                                <td colspan="7"><hr width='100%'></td>
                                        </tr>                                                      
                            <tr>
                                <td align="right"><b>GRAND TOTAL</b>
                                </td>
                                <td align="right"><u><?=number_format($gross1+$tamount,2,".",",");?></u></td>
                                <td align="right"><u><?=number_format($discount1+$totaldiscount,2,".",",");?></u></td>
                                <td align="right"><u><?=number_format($phic1+$totalphic,2,".",",");?></u></td>
                                <td align="right"><u><?=number_format($hmo1+$totalhmo,2,".",",");?></u></td>
                                <td align="right"><u><?=number_format($excess1+$totalexcess,2,".",",");?></u></td>
                                <td align="right"><label></td>
                                </tr>
                            </table>
                            <table width="100%" border="0">
                                        <?php
                                          $ll=$this->Hmo_model->getLOA($caseno);                                          
                                          $loa=$ll['policyno'];
                                         ?>
                                        <tr>
                                          <td align="right">LOA Limit: </td>
                                          <td align="right"></td>
                                          <td align="right"></td>
                                          <td align="right"><?=number_format($loa,2,".",",");?></td>
                                          <td align="left">&nbsp;<a href="#" class="btn btn-outline-primary btn-sm editloa" data-bs-toggle="modal" data-bs-target="#UpdateHMOAllocation" data-id="<?=$caseno;?>_<?=$loa;?>">Update LOA limit</a>
                                        </tr>
                                        <tr>
                                          <td align="right">Allocation Amount: </td>
                                          <td align="right"></td>
                                          <td align="right"></td>
                                          <td align="right"><?=number_format($loa-$totalhmo-$hmo1,2,".",",");?></td>
                                        </tr>
                                        <!--tr>
                                         <td align="right"><a href="http://192.168.0.100:100/2017codes/SOA/StatementOfAccountPHICVer.php?&caseno=<?=$caseno;?>&uname" target="_blank">VIEW SOA </a></td>
                                          <td align="right"></td>
                                          <td align="right"></td>
                                          <td align="right"></td>
                                      </tr-->
                                      <tr>
                                       <td align="right"><a href="http://192.168.0.100:100/2017codes/SOA/StatementOfAccountHMOVer-20211102.php?&caseno=<?=$caseno;?>&uname&patientidno" target="_blank">SOA (BETA)</a></td>
                                        <td align="right"></td>
                                        <td align="right"></td>
                                        <td align="right"></td>
                                    </tr>
                                      <tr>
                                       <!-- <td align="right"><a href="http://192.168.0.100:100/2011codes/details.php?&caseno=<?=$caseno;?>&uname" target="_blank">VIEW DETAILS </a></td> -->
                                       <td align="right"><a href="http://192.168.0.100:100/ERP/extra/Details/?caseno=<?=$caseno;?>&user&dept=BILLING" target="_blank">VIEW DETAILS </a></td>
                                        <td align="right"></td>
                                        <td align="right"></td>
                                        <td align="right"></td>
                                    </tr>
                                    <tr>
                                       <td align="right"><a href="<?=base_url();?>details_hmo/<?=$caseno;?>/<?=$patientidno;?>" target='_blank'>VIEW DETAILS HMO </a></td>
                                        <td align="right"></td>
                                        <td align="right"></td>
                                        <td align="right"></td>
                                    </tr>
                                        <input type="hidden" name="loa" value="<?=$loa;?>" id="loa">
                                        <input type="hidden" name="loaless" value="<?=$loa-$totalhmo-$hmo1;?>" id="loaless">
                                        <tr>
                                            <td colspan="4" align="right"><a href="<?=base_url();?>remove_allocation_all/<?=$caseno;?>" onclick="return confirm('Do you wish to remove all allocation?');return false;" class="btn btn-danger text-white" style="width:200px;">Remove Allocation</a></td>
                                        </tr>
                                      </table>                                                                
						</div>
					</div>
				</div>							
			</div>
		</div><!-- Row end  -->

	</div>
</div>
