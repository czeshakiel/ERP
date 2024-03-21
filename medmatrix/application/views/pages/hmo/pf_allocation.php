<script>
    function updateTotal(){
    var loa=$('#loaless').val();
 var itemCount = document.getElementsByClassName("itemclass");
 var total = 0;
 var id= '';
 for(var i = 0; i < itemCount.length; i++)
 {
   id = "tamount"+(i+1);
   //total = total + parseFloat(itemCount[i].value);
if(total + parseFloat(document.getElementById(id).value) <= loa){
   total = total +  parseFloat(document.getElementById(id).value);
 }else{
   //document.getElementById(id).value=0;
 }
 }
document.getElementById('totalexcess').value = total.toFixed(2);
return total;
  }
</script>
<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h4 class="fw-bold mb-0"><a href="<?=base_url();?>artrade_list"><i class="icofont-arrow-left"></i> Back </a>| <?=$title;?></h4>
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
                <h4>GUARANTEE ALLOCATION</h4>
                </div>				
				<div class="card mb-3">
					<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
						<h6 class="mb-0 fw-bold ">HCI Fees</h6>
					</div>
					<div class="card-body">
						<div class="row g-3 align-items-center">
                            <?=form_open(base_url()."save_pf_discount");?>
                            <input type="hidden" name="caseno" value="<?=$caseno;?>">                            
                            <table class="table">
                                <tr>
                                        <td align="left"><u>Description</u></td>
                                        <td align="right"><u>Amount</u></td>
                                        <td align="right"><u>Discount</u></td>
                                        <td align="right"><u>HMO</u></td>
                                    </tr>
                                    <?php
                                    $total=0;
                                    foreach($allocation as $row){
                                        $description=$row['description'];
                                        $amount=$row['amount'];
                                        $sqlDiscount=$this->Hmo_model->getPFDiscount($row['acctno'],$row['description']);
                                        $discount=$sqlDiscount['amount'];

                                        $total +=$amount-$discount;

                                        echo "<input type='hidden' name='refno[]' value='$row[refno]' />";
                                        echo "<tr>
                                        <td>$description</td>
                                        <td align='right'>".number_format($amount-$discount,2)."</td>
                                        <td align='right'><input type='text' class='form-control' value='0.00' style='width:100px; text-align:right;' name='amount[]' /></td>
                                        <td align='right'>";
                                        echo "<select name='accttitle[]' class='form-control item' style='width:200px;'>";
                                        $sqlhmo=$this->Hmo_model->getAccttitle();
                                        foreach($sqlhmo as $hmo){
                                            echo "<option vaue='$hmo[accttitle]'>$hmo[accttitle]</option>";
                                        }                                        
                                        echo "</select>";
                                        echo "
                                        </td></tr>";                                      
                                    }
                                    ?>
                                        <tr>
                                                <td colspan="4"><hr width='100%'></td>
                                        </tr>
                                        <tr>

                                                <td align="right">TOTAL AMOUNT</td>
                                                <td align="right"><u><?=number_format($total,2,".",",");?></u></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="center"><input type="submit" name="submit" value="ALLOCATE PAYMENT" class="btn btn-primary"></td>
                                        </tr>
                                      </table>
                                                                                                      
                            <?=form_close();?>
						</div>
					</div>
				</div>                
                <div class="card mb-3">
					<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
						<h6 class="mb-0 fw-bold ">Allocation History</h6>
                        <a href="http://192.168.0.100:100/2017codes/SOA/StatementOfAccountHMOVer-20211102.php?&caseno=<?=$caseno;?>&uname&patientidno" class="btn btn-primary btn-sm" target="_blank">Print SOA</a>
					</div>
					<div class="card-body">
						<div class="row g-3 align-items-center">
                        <table class="table">
                                       <!--  <tr>
                                            <td colspan="4"><a href="http://192.168.0.100:100/2017codes/SOA/StatementOfAccountPHICVerHMO.php?patientidno=<?=$patient['patientidno'];?>&caseno=<?=$caseno;?>&uname=<?=$this->session->fullname; ?>" target="_blank" class="btn btn-warning">View SOA</a></td>
                                        </tr>  -->                                       
                                        <?php
                                          $sqlCollect=$this->Hmo_model->getPFDiscountHistory($caseno);
                                          $totalposted=0;
                                          if(count($sqlCollect)>0){
                                            foreach($sqlCollect as $tbal){                                              
                                              $totalposted +=$tbal['amount'];
                                              $rem='Do you wish to remove this item?';
                                              echo "<tr><td>$tbal[description] ($tbal[accttitle])</td><td align='right'>".number_format($tbal['amount'],2,".",",")."</td>";
                                              ?>
                                              <td width='5%' style='text-indent:10px;'><a href="<?=base_url();?>remove_pf_allocation/<?=$tbal['refno'];?>/<?=$caseno;?>" onclick="return confirm('Do you wish to remove this item?');return false;" >Remove</a></td>
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
