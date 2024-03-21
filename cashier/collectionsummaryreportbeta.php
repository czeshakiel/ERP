<?php
    ini_set('display_errors',1);
    session_start();
                include("../main/connection.php");
                $rundate=$_GET['startdate'];
                $enddate=date('Y-m-d',strtotime('-1 days',strtotime($rundate)))." 23:00:00";
                $startdate=date('Y-m-d',strtotime('-1 day',strtotime($enddate)))." 23:00:00";
                $checkdate=date('Y-m',strtotime($rundate))."-01";
                $datefrom=date('Y-m-d',strtotime('-2 days',strtotime($checkdate)))." 23:00:00";
                $datestart=date('Y-m-d',strtotime($startdate))." 23:00:00";               
                 if($_SESSION['dept']=="CASHIER"){
                  $qrybegin="CONCAT(datearray,' ',paymentTime) >= '$datefrom' AND CONCAT(datearray,' ',paymentTime) < '$datestart' AND (`type` LIKE '%Visa%') AND paidBy <> 'CASHIER4'";
                  $qrynow="CONCAT(datearray,' ',paymentTime) >= '$startdate' AND CONCAT(datearray,' ',paymentTime) < '$enddate' AND (`type` LIKE '%Visa%') AND paidBy <> 'CASHIER4'";
                 }else{
                  $qrybegin="CONCAT(datearray,' ',paymentTime) >= '$datefrom' AND CONCAT(datearray,' ',paymentTime) < '$datestart' AND `type` LIKE '%Visa%' AND paidBy = '".$_SESSION['dept']."'";
                  $qrynow="CONCAT(datearray,' ',paymentTime) >= '$startdate' AND CONCAT(datearray,' ',paymentTime) < '$enddate' AND `type` LIKE '%Visa%' AND paidBy = '".$_SESSION['dept']."'";
                 }

                $sql123="SELECT * FROM heading";
                $sqlMission=mysqli_query($conn,$sql123);
                $mv=mysqli_fetch_array($sqlMission);
                $heading=$mv['heading'];
                $address=$mv['address'];
                $telno=$mv['telno'];
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-white" id="printableArea">
                        <div class="panel-heading">
                            <center>
                                <table width="90%" border="0">
                                    <tr>
                                        <td align="left" width="5%"><div style="height: 100px;width: 100px;"><img src="../main/img/logo/kmsci.png" width="100" height="100"></div></td>
                                        <td align="center" width="95%"><label style="font-size:20px;font-family: Times New Roman;"><?=$heading;?></label><br><label style="font-size: 16px;font-family: Times New Roman;">DAILY SUMMARY COLLECTION REPORT</label><br><label style="font-size: 16px;font-family: Times New Roman;">AS OF <?=date('F d, Y',strtotime($rundate));?></label></td>
                                    </tr>
                                </table>
<br>
                                <table width="90%" border="0">
                                    <tr>
                                        <td align="center"><u>Account Title</u></td>
                                        <td align="right"><u>Beginning</u></td>
                                        <td align="right"><u>Today</u></td>
                                        <td align="right"><u>End</u></td>
                                    </tr>
                                    <?php
                                        mysqli_query($conn,"SET NAMES 'utf8'");
                                        $totalbeg=0;
                                        $totalnow=0;
                                        $totaldiscbeg=0;
                                        $totaldiscnow=0;
                                        $totalbegdiscsen=0;
                                        $totalbegdiscnorm=0;
                                        $totaldiscnowsen=0;
                                        $totaldiscnownorm=0;
                                        $sqlAccttitle=mysqli_query($conn,"SELECT * FROM accounttitle WHERE accounttitle NOT LIKE 'OTHER FEES' AND accounttitle NOT LIKE 'PROFESSIONAL FEE' ORDER BY accounttitle ASC");
                                        if(mysqli_num_rows($sqlAccttitle)>0){
                                            while($acct=mysqli_fetch_array($sqlAccttitle)){
                                                $accttitle=$acct['accounttitle'];
                                                echo "<tr>";
                                                    if($accttitle=="HOSPITAL BILL"){
                                                        $accttitle="PATIENTS DEPOSIT";
                                                    }
                                                    echo "<td>$accttitle</td>";
                                                    if($accttitle=="PATIENTS DEPOSIT"){
                                                        $accttitle="HOSPITAL BILL";
                                                    }
                                                    $amountbeg=0;
                                                    $amountbegdisc=0;
                                                    $begdiscsen=0;
                                                    $begdiscnorm=0;
                                                    
                                                    $sqlSubAcct=mysqli_query($conn,"SELECT subaccounttitle FROM subaccounttitle WHERE accounttitle='$accttitle'");
                                                    if(mysqli_num_rows($sqlSubAcct)>0){
                                                        while($sub=mysqli_fetch_array($sqlSubAcct)){
                                                            $subaccttitle=$sub['subaccounttitle'];
                                                            if($accttitle=="BIOPSY INCOME"){
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE (accttitle LIKE '%LABORATORY%' AND description LIKE '%BIOPSY%') AND $qrybegin GROUP BY description,accttitle,ofr,acctno ORDER BY ofr ASC");
                                                                                    $subaccttitle="BIOPSY";
                                                                                }elseif($accttitle=="LABORATORY"){
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE (accttitle LIKE '%$subaccttitle%' AND (description NOT LIKE '%BIOPSY%' AND description NOT LIKE '%RAPID TEST%' AND description NOT LIKE '%RT PCR%' AND description NOT LIKE '%RT-PCR%')) AND $qrybegin GROUP BY description,accttitle,ofr,acctno ORDER BY ofr ASC");

                                                                                }elseif($accttitle=="RAPID TEST"){
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE (accttitle LIKE '%LABORATORY%' AND description LIKE '%RAPID TEST%') AND $qrybegin GROUP BY description,accttitle,ofr,acctno ORDER BY ofr ASC");
                                                                                    $subaccttitle="RAPID TEST";
                                                                                }elseif($accttitle=="RT PCR"){
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE ((accttitle LIKE '%LABORATORY%' OR accttitle LIKE '%MISCELLANEOUS%') AND (description LIKE '%RT-PCR%' OR description LIKE '%TRANSPORTATION AND SUPPLIES%')) AND $qrybegin GROUP BY description,accttitle,ofr,acctno ORDER BY ofr ASC");
                                                                                    $subaccttitle="RT PCR";
                                                                                }elseif($accttitle=="RESPIRATORY SUPPLIES"){
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE (accttitle LIKE '%PHARMACY/SUPPLIES%' AND description LIKE '%NEBULE%') AND $qrybegin AND `type` LIKE '%Visa%' GROUP BY description,accttitle,ofr,acctno ORDER BY ofr ASC");
                                                                                    $subaccttitle="RESPIRATORY SUPPLIES";
                                                                                }
                                                                                elseif($accttitle=="CASHONHAND" && $subaccttitle=="PROFESSIONAL FEE"){
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE accttitle LIKE '%$subaccttitle%' AND $qrybegin AND (accttitle='PROFESSIONAL FEE' AND `type` LIKE '%card%') GROUP BY description,accttitle,ofr,acctno ORDER BY ofr ASC");
                                                                                    //$subaccttitle="MEDICAL SUPPLIES";

                                                                                }elseif($accttitle=="CASHONHAND"){
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE accttitle LIKE '%$subaccttitle%' AND $qrybegin AND acctno NOT LIKE 'R-%' GROUP BY ofr ORDER BY ofr ASC");
                                                                                }elseif($accttitle=="A/P RDU"){
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE accttitle LIKE '%$subaccttitle%' AND $qrybegin AND acctno LIKE 'R-%' GROUP BY ofr ORDER BY ofr ASC");
                                                                                }
                                                                                else{
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE accttitle = '$subaccttitle' AND $qrybegin GROUP BY description,accttitle,ofr,acctno ORDER BY ofr ASC");
                                                                                }                                                                                
                                                            if(mysqli_num_rows($sqlAmount)>0){
                                                                while($item=mysqli_fetch_array($sqlAmount)){
                                                                    $caseno=$item['acctno'];
                                                                    $check_disc=mysqli_query($conn,"SELECT * FROM admission WHERE caseno='$caseno' AND senior LIKE '%Y%'");
                                                                    if(mysqli_num_rows($check_disc)>0){
                                                                        $begdiscsen += $item['discount'];
                                                                    }else{
                                                                        $begdiscnorm += $item['discount'];
                                                                    }
                                                                    $amountbeg +=$item['amount']+$item['discount'];
                                                                    $amountbegdisc +=$item['discount'];                                                               
                                                                    if($checkdate==$rundate){
                                                                        $amountbeg=0;
                                                                        $amountbegdisc=0;
                                                                        $begdiscsen=0;
                                                                        $begdiscnorm=0;
                                                                    }                                                                    
                                                                }
                                                            }
                                                        }
                                                    }
                                                    $totalbeg +=$amountbeg;
                                                    $totaldiscbeg +=$amountbegdisc;
                                                    $totalbegdiscsen +=$begdiscsen;
                                                    $totalbegdiscnorm +=$begdiscnorm;

                                                    $amountnow=0;
                                                    $amountnowdisc=0;
                                                    $discnowsen=0;
                                                    $discnownorm=0;                                                    
                                                    $sqlSubAcct=mysqli_query($conn,"SELECT subaccounttitle FROM subaccounttitle WHERE accounttitle='$accttitle'");
                                                    if(mysqli_num_rows($sqlSubAcct)>0){
                                                        while($sub=mysqli_fetch_array($sqlSubAcct)){
                                                            $subaccttitle=$sub['subaccounttitle'];
                                                            if($accttitle=="BIOPSY INCOME"){
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE (accttitle LIKE '%LABORATORY%' AND description LIKE '%BIOPSY%') AND $qrynow GROUP BY description,accttitle,ofr,acctno ORDER BY ofr ASC");
                                                                                    $subaccttitle="BIOPSY";
                                                                                }elseif($accttitle=="LABORATORY"){
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE (accttitle LIKE '%$subaccttitle%' AND (description NOT LIKE '%BIOPSY%' AND description NOT LIKE '%RAPID TEST%' AND description NOT LIKE '%RT PCR%' AND description NOT LIKE '%RT-PCR%')) AND $qrynow GROUP BY description,accttitle,ofr,acctno ORDER BY ofr ASC");

                                                                                }elseif($accttitle=="RAPID TEST"){
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE (accttitle LIKE '%LABORATORY%' AND description LIKE '%RAPID TEST%') AND $qrynow GROUP BY description,accttitle,ofr,acctno ORDER BY ofr ASC");
                                                                                    $subaccttitle="RAPID TEST";
                                                                                }elseif($accttitle=="RT PCR"){
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE ((accttitle LIKE '%LABORATORY%' OR accttitle LIKE '%MISCELLANEOUS%') AND (description LIKE '%RT-PCR%' OR description LIKE '%TRANSPORTATION AND SUPPLIES%')) AND $qrynow GROUP BY description,accttitle,ofr,acctno ORDER BY ofr ASC");
                                                                                    $subaccttitle="RT PCR";
                                                                                }elseif($accttitle=="RESPIRATORY SUPPLIES"){
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE (accttitle LIKE '%PHARMACY/SUPPLIES%' AND description LIKE '%NEBULE%') AND $qrynow AND `type` LIKE '%Visa%' GROUP BY description,accttitle,ofr,acctno ORDER BY ofr ASC");
                                                                                    $subaccttitle="RESPIRATORY SUPPLIES";
                                                                                }
                                                                                elseif($accttitle=="CASHONHAND" && $subaccttitle=="PROFESSIONAL FEE"){
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE accttitle LIKE '%$subaccttitle%' AND $qrynow AND (accttitle='PROFESSIONAL FEE' AND `type` LIKE '%card%') GROUP BY description,accttitle,ofr,acctno ORDER BY ofr ASC");
                                                                                    //$subaccttitle="MEDICAL SUPPLIES";

                                                                                }elseif($accttitle=="CASHONHAND"){
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE accttitle LIKE '%$subaccttitle%' AND $qrynow AND acctno NOT LIKE 'R-%' GROUP BY ofr ORDER BY ofr ASC");
                                                                                }elseif($accttitle=="A/P RDU"){
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE accttitle LIKE '%$subaccttitle%' AND $qrynow AND acctno LIKE 'R-%' GROUP BY ofr ORDER BY ofr ASC");
                                                                                }
                                                                                else{
                                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,`type`,accttitle,acctno FROM collection WHERE accttitle = '$subaccttitle' AND $qrynow GROUP BY description,accttitle,ofr,acctno ORDER BY ofr ASC");
                                                                                }                                                                               
                                                            if(mysqli_num_rows($sqlAmount)>0){
                                                                while($item=mysqli_fetch_array($sqlAmount)){
                                                                    $caseno=$item['acctno'];
                                                                    $check_disc=mysqli_query($conn,"SELECT * FROM admission WHERE caseno='$caseno' AND senior LIKE '%Y%'");
                                                                    if(mysqli_num_rows($check_disc)>0){
                                                                        $discnowsen += $item['discount'];
                                                                    }else{
                                                                        $discnownorm += $item['discount'];
                                                                    }
                                                                    $amountnow +=$item['amount']+$item['discount'];
                                                                    $amountnowdisc +=$item['discount'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                    $totalnow+=$amountnow;
                                                    $totaldiscnow+=$amountnowdisc;
                                                    $totaldiscnowsen +=$discnowsen;
                                                    $totaldiscnownorm +=$discnownorm;
                                                    if($amountbeg>0 || $amountnow>0){
                                                        echo "<td align='right'>".number_format($amountbeg,2)."</td>";
                                                        echo "<td align='right'>".number_format($amountnow,2)."</td>";

                                                        echo "<td align='right'>".number_format($amountbeg+$amountnow,2)."</td>";
                                                    }
                                                echo "</tr>";

                                            }
                                        }
                                        $medbegin=0;
                                                            $mednow=0;
                                                            $meddiscbegsen=0;
                                                            $meddiscbegnorm=0;
                                                            $meddiscnowsen=0;
                                                            $meddiscnownorm=0;
                                                            $medbegipd=0;
                                                            $mednowipd=0;
                                                            $medbegopd=0;
                                                            $mednowopd=0;
                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctno,acctname,ofr,description,accttitle,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,datearray FROM collection WHERE $qrybegin AND ofr <> '' AND accttitle = 'PHARMACY/MEDICINE' GROUP BY ofr ORDER BY ofr ASC");
                                                                    if(mysqli_num_rows($sqlAmount)>0){
                                                                        while($item=mysqli_fetch_array($sqlAmount)){
                                                                            $amount=$item['amount'];
                                                                            $discount=$item['discount'];
                                                                            $gross=$amount+$discount;
                                                                            $ofr=$item['ofr'];
                                                                            $paymentDate=$item['datearray'];
                                                                            $acctno=$item['acctno'];
                                                                            if(($paymentDate < '2021-04-21' && $ofr=='1002487') || $ofr=='1000973'){
                                                                            $sqlSenior=mysqli_query($conn,"SELECT p.* FROM patientprofile p INNER JOIN admission a ON a.patientidno=p.patientidno WHERE a.caseno='$acctno' AND p.senior='Y'");
                                                                            if(mysqli_num_rows($sqlSenior)>0){
                                                                                $grossvat=$gross/1.12;
                                                                                $discount=$grossvat*.2;
                                                                                $v=$gross-$grossvat;
                                                                                $discount=($grossvat*.2)+$v;
                                                                                $amount=$gross-$discount;
                                                                            }
                                                                        }else{

                                                                        }
                                                                            $check_disc=mysqli_query($conn,"SELECT * FROM admission WHERE caseno='$caseno' AND senior LIKE '%Y%'");
                                                                            if(mysqli_num_rows($check_disc)>0){
                                                                                $meddiscbegsen += $discount;
                                                                            }else{
                                                                                $meddiscbegnorm += $discount;
                                                                            }
                                                                            $medbegin +=$gross;
                                                                            if(strpos($acctno,"I-") !== false){
                                                                                $medbegipd += $gross;
                                                                            }else{
                                                                                $medbegopd += $gross;
                                                                            }                                                                            

                                                                        }
                                                                    }

                                                                    $sqlAmount=mysqli_query($conn,"SELECT acctno,acctname,ofr,description,accttitle,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount,datearray FROM collection WHERE $qrynow AND ofr <> '' AND accttitle = 'PHARMACY/MEDICINE' GROUP BY ofr ORDER BY ofr ASC");
                                                                    if(mysqli_num_rows($sqlAmount)>0){
                                                                        while($item=mysqli_fetch_array($sqlAmount)){
                                                                            $amount=$item['amount'];
                                                                            $discount=$item['discount'];
                                                                            $gross=$amount+$discount;
                                                                            $ofr=$item['ofr'];
                                                                            $paymentDate=$item['datearray'];
                                                                            $acctno=$item['acctno'];
                                                                            if(($paymentDate < '2021-04-21' && $ofr=='1002487') || $ofr=='1000973'){
                                                                            $sqlSenior=mysqli_query($conn,"SELECT p.* FROM patientprofile p INNER JOIN admission a ON a.patientidno=p.patientidno WHERE a.caseno='$acctno' AND p.senior='Y'");
                                                                            if(mysqli_num_rows($sqlSenior)>0){
                                                                                $grossvat=$gross/1.12;
                                                                                $discount=$grossvat*.2;
                                                                                $v=$gross-$grossvat;
                                                                                $discount=($grossvat*.2)+$v;
                                                                                $amount=$gross-$discount;
                                                                            }
                                                                        }else{

                                                                        }
                                                                        $check_disc=mysqli_query($conn,"SELECT * FROM admission WHERE caseno='$caseno' AND senior LIKE '%Y%'");
                                                                            if(mysqli_num_rows($check_disc)>0){
                                                                                $meddiscnowsen += $discount;
                                                                            }else{
                                                                                $meddiscnownorm += $discount;
                                                                            }
                                                                            $mednow +=$gross;
                                                                            if(strpos($acctno,"I-") !== false){
                                                                                $mednowipd += $gross;
                                                                            }else{
                                                                                $mednowopd += $gross;
                                                                            }                                                                        

                                                                        }
                                                                    }
                                                echo "<tr>";
                                                    echo "<td>MEDICINE IPD</td>";
                                                    echo "<td align='right'>".number_format($medbegipd,2)."</td>";
                                                    echo "<td align='right'>".number_format($mednowipd,2)."</td>";
                                                    echo "<td align='right'>".number_format($medbegipd+$mednowipd,2)."</td>";
                                                echo "</tr>";
                                                echo "<tr>";
                                                    echo "<td>MEDICINE OPD</td>";
                                                    echo "<td align='right'>".number_format($medbegopd,2)."</td>";
                                                    echo "<td align='right'>".number_format($mednowopd,2)."</td>";
                                                    echo "<td align='right'>".number_format($medbegopd+$mednowopd,2)."</td>";
                                                echo "</tr>";
                                        echo "<tr>";
                                                    echo "<td>DISCOUNT SENIOR</td>";
                                                    echo "<td align='right'>(".number_format($totalbegdiscsen+$meddiscbegsen,2).")</td>";
                                                    echo "<td align='right'>(".number_format($totaldiscnowsen+$meddiscnowsen,2).")</td>";
                                                    echo "<td align='right'>(".number_format($totalbegdiscsen+$totaldiscnowsen+$meddiscbegsen+$meddiscnowsen,2).")</td>";
                                                echo "</tr>";
                                                echo "<tr>";
                                                    echo "<td>DISCOUNT REGULAR</td>";
                                                    echo "<td align='right'>(".number_format($totalbegdiscnorm+$meddiscbegnorm,2).")</td>";
                                                    echo "<td align='right'>(".number_format($totaldiscnownorm+$meddiscnownorm,2).")</td>";
                                                    echo "<td align='right'>(".number_format($totalbegdiscnorm+$totaldiscnownorm+$meddiscbegnorm+$meddiscnownorm,2).")</td>";
                                                echo "</tr>";

                                    ?>
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="left"><b>TOTAL</b></td>
                                        <td align="right"><?=number_format($totalbeg-$totaldiscbeg+$medbegin-$meddiscbegsen-$meddiscbegnorm,2);?></td>
                                        <td align="right"><?=number_format($totalnow-$totaldiscnow+$mednow-$meddiscnownorm-$meddiscnowsen,2);?></td>
                                        <td align="right"><?=number_format($totalbeg+$totalnow-$totaldiscbeg-$totaldiscnow+$medbegin+$mednow-$meddiscbegsen-$meddiscbegnorm-$meddiscnownorm-$meddiscnowsen,2);?></td>
                                    </tr>
								</table>
                                <br>
                                <br>
                                <br>
								<table cellspacing="0" cellpadding="0" border="0" width="90%">
									<tr>
										<td>Prepared by:</td>
										<td>Checked by:</td>
										<td>Noted by:</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td><u><?=$_SESSION['username'];?></u></td>
										<td>___________________________</td>
										<td>___________________________</td>
									</tr>
									<tr>
										<td>Cashier</td>
										<td>Book Keeper</td>
										<td>Hospital Administrator</td>
									</tr>
                               </table>
                            </center>
                        </div>
                        <div class="panel-body">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">

                            </table>
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
            </div>
            <script type="text/javascript">
                function printDiv(divName) {
                     var printContents = document.getElementById(divName).innerHTML;
                     var originalContents = document.body.innerHTML;

                     document.body.innerHTML = printContents;

                     window.print();

                     document.body.innerHTML = originalContents;
                }
            </script>
