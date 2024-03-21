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
                <h4>HMO EXCESS</h4>
                </div>				
				<div class="card mb-3">
					<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
						<h6 class="mb-0 fw-bold ">HCI Fees</h6>
					</div>
					<div class="card-body">
						<div class="row g-3 align-items-center">                            
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
                                    <td></td>
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
                                    $posted=$this->Hmo_model->getExcessPayment($caseno,$accounttitle);
                                    $posted_amount=$posted['amount'];
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
                                        $excess=$excess-$posted_amount;
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
                                        echo "<tr>
                                        <td>$accounttitle</td>
                                        <td align='right'>".number_format($gross,2)."</td>
                                        <td align='right'>".number_format($discount,2)."</td>
                                        <td align='right'>".number_format($phic,2)."</td>
                                        <td align='right'>".number_format($hmo,2); 
                                    ?>
                                        </td>
                                        <?=form_open(base_url()."post_excess");?>
                                        <input type="hidden" name="caseno" value="<?=$caseno;?>">
                                        <?php                   
                                        echo "<input type='hidden' name='producttype' value='$accounttitle' />";                     
                                        echo "<td align='right'>".number_format($excess,2)."</td>
                                        <td align='right'>
                                        <input type='text' class='form-control itemclass' onchange='updateTotalAss();' name='amount' style='width:100px;text-align:right;' value='0'/>
                                        </td>
                                        <td>
                                            <input type='submit' name='submit' class='btn btn-primary btn-sm' value='Post Excess' $disabled>
                                        </td>
                                        </tr>";
                                        ?>
                                        <?=form_close();?>
                                        <?php                                        
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
                                                <td align="right"></td>
                                        </tr>    
                            </table>            
                            <input type="hidden" name="totalhmo" value="<?=$grandtotalhmo;?>">
                                        <input type="hidden" name="loa" value="<?=$loa;?>">                            
						</div>
					</div>
				</div>
                <div class="card mb-3">
                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                        <h6 class="mb-0 fw-bold ">Posted Excess History</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3 align-items-center">
                        <table class="table">
                                        <?php
                                          $sqlCollect=$this->Hmo_model->getExcessHistory($caseno);
                                          $totalposted=0;
                                          if(count($sqlCollect)>0){
                                            foreach($sqlCollect as $tbal){
                                              if($tbal['type']=='pending'){
                                                $hide="";
                                              }else{
                                                $hide="style='display:none'";
                                              }                                              
                                              $totalposted +=$tbal['amount'];
                                              $rem='Do you wish to remove this item?';
                                              echo "<tr><td>$tbal[description] ($tbal[accttitle])</td><td align='right'>".number_format($tbal['amount'],2,".",",")."</td>";
                                              ?>
                                              <td width='5%' style='text-indent:10px;'><a href="<?=base_url();?>remove_excess/<?=$tbal['refno'];?>/<?=$caseno;?>" onclick="return confirm('Do you wish to remove this item?');return false;" <?=$hide;?>>Remove</a></td>
                                              <?php echo "<td width='50%'>&nbsp;</td></tr>";                                            
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
