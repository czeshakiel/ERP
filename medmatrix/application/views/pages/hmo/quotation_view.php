<div class="body d-flex py-lg-3 py-md-2">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h3 class="fw-bold mb-0"><?=$title;?></h3>
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
        $print="style='display:none;'";
        if(count($inpatient)>0){
            $print="";
        }
        ?>
		<div class="row align-item-center">
        <div class="col-md-4">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h6 class="mb-0 fw-bold ">Patient Information</h6></td>
                                <td align="right"><a href="<?=base_url();?>print_quotation/<?=$patient['caseno'];?>/<?=$quote_id;?>" class="btn btn-info btn-sm text-white" target="_blank" <?=$print;?>><i class="icofont-print"></i> Print Quotation</a></td>								
							</tr>							
						</table>
					</div>
					<div class="card-body">
                        <table border="0" width="100%">
                            <tr>
                                <td>Caseno: <b><?=$patient['caseno'];?></b></td>
                            </tr>
                            <tr>
                                <td>Patient ID: <b><?=$patient['patientidno'];?></b></td>
                            </tr>
                            <tr>
                                <td>Patient Name: <b><?=$patient['lastname'];?>, <?=$patient['firstname'];?> <?=$patient['middlename'];?></b></td>
                            </tr>
                            <tr>
                                <td>Birth Date: <b><?=date('F d, Y',strtotime($patient['dateofbirth']));?></b></td>
                            </tr>
                            <tr>
                                <td>Age: <b><?=$patient['age'];?></b></td>
                            </tr>
                            <tr>
                                <td>Gender: <b><?=$patient['sex'];?></b></td>
                            </tr>
                        </table>						
					</div>
				</div>

			</div>
			<div class="col-md-8">
				<div class="card mb-3">
					<div class="card-header py-3 bg-transparent border-bottom-0">
						<table border="0" width="100%">
							<tr>
								<td><h6 class="mb-0 fw-bold ">Item List</h6></td>
                                <td align="right">
                                <?php
                                $userunique=$this->session->fullname;
echo "
                              <button class='btn btn-primary btn-sm'";?> onclick="<?php echo "window.open('http://192.168.0.100:100/2021codes/ChargeCart/autoaccess.php?caseno=$patient[caseno]&station=HMO&toh=CHARGES_QUOT&user=$userunique', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=300,width=710,height=710');";?>" <?php echo "><i class='icofont icofont-cart'></i> Charges Cart </button>
                              <button class='btn btn-warning btn-sm'";?> onclick="<?php echo "window.open('http://192.168.0.100:100/2021codes/ChargeCart/autoaccess.php?caseno=$patient[caseno]&station=HMO&toh=PHARMACY_QUOT&user=$userunique', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=300,width=710,height=710');";?>" <?php echo "><i class='icofont icofont-cart'></i> Pharmacy Cart </button>
                              <button class='btn btn-success btn-sm'";?> onclick="<?php echo "window.open('http://192.168.0.100:100/2021codes/ChargeCart/autoaccess.php?caseno=$patient[caseno]&station=HMO&toh=CSR2_QUOT&user=$userunique', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=300,width=710,height=710');";?>" <?php echo "><i class='icofont icofont-cart'></i> CSR2 Cart </button>
";
?>
                                </td>								
							</tr>							
						</table>
					</div>
					<div class="card-body">
						<table class="table" style="width: 100%;" id="patient-table">
							<thead>
							<tr>		
								<td>#</td>
								<td>Code</td>						
								<td>Description</td>								
                                <td>Qty</td>
								<td align="center">Price Cash</td>
                                <td align="center">Price Charge</td>
								<td>Date</td>
								<td>Action</td>
							</tr>                           
							</thead>
							<tbody>
							<?php
							$x=1;
							foreach($inpatient as $list){
								echo "<tr>";
                                    echo "<td align='center'>$x.</td>";
                                    echo "<td>$list[productcode]</td>";
                                    echo "<td>$list[productdesc]</td>";
                                    echo "<td align='center'>$list[quantity]</td>";
                                    echo "<td align='right'>".number_format($list['price_cash'],2)."</td>";
                                    echo "<td align='right'>".number_format($list['price_charge'],2)."</td>";
                                    echo "<td align='center'>$list[datearray]</td>";
                                    echo "<td align='right'>";
                                    ?>
                                        <a href="<?=base_url();?>remove_quote_item/<?=$quote_id;?>/<?=$caseno;?>/<?=$list['id'];?>" class='btn btn-danger btn-sm text-white' title='Remove' onclick="return confirm('Are you sure you want to remove this item?');return false;"><i class='icofont icofont-trash'></i></a>
                                    <?php
                                    echo "</td>";
                                echo "</tr>";
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
