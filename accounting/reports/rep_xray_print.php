<script type="text/javascript" src="../main/arv_new/excel/excel.min.js"></script>
<?php include "../main/arv_new/excel/excel.php"; ?>

<style>
    .tablex {
  border-collapse: separate;
  border-spacing: 0;
  width: 100%;
  

}
.tablex tr th,
.tablex tr td {
  border-right: 1px solid #bbb;
  border-bottom: 1px solid #bbb;
  padding: 5px;
  text-align: left;
  /*font-family: "Arial", Arial, San-serif;*/
    font-family: Arial, Helvetica, sans-serif;
}
.tablex tr th:first-child,
.tablex tr td:first-child {
  border-left: 1px solid #bbb;
}
.tablex tr th {

  border-top: 1px solid #bbb;
  text-align: left;
}

/* top-left border-radius */
.tablex tr:first-child th:first-child {
}

/* top-right border-radius */
.tablex tr:first-child th:last-child {
}

/* bottom-left border-radius */
.tablex tr:last-child td:first-child {
}

/* bottom-right border-radius */
.tablex tr:last-child td:last-child {
}
}
</style>
<div class="pagetitle">
      <h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?view=main">Main</a></li>
          <li class="breadcrumb-item"><a href="?readerpf">Readers Fee Report</a></li>
          <li class="breadcrumb-item">Imaging Report</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

<button class="btn btn-danger" onclick="printDiv()"><i class="icofont-print"></i> Print</button>
<button class="btn btn-primary" onclick="ExportToExcel('xlsx')"><i class="icofont-file-excel"></i> Export to excel</button><br><br>
<hr class="sidebar-divider my-0"><br>

<?php
$dstart=$_POST['dstart'];
$dend=$_POST['dend'];
$reader=$_POST['reader'];
$trans=$_POST['trans'];
$test=$_POST['test'];
$date_dis = $dstart." - ".$dend;



echo "
<html>
<div id='GFG'>
<html>
<style type='text/css'>
textarea { border: none; }
@media print {* {-webkit-print-color-adjust: exact;}}
th{font-weight: normal;}
textarea{visibility:hidden;}
table {border-collapse: collapse;}
</style>
<body>




<table align='center' width='100%'>
<tr>
<td style='background-image:url(../main/img/logo/mmshi.png);background-repeat:no-repeat;background-size:90px 80px;'>
<p align='center'><font color='black'>$heading<br>PF READERS FEE REPORT - $trans<br>DATE: $date_dis <br>$reader</p>
</td>
</tr>

<tr>
<th style='border-top: solid 1px black;'><br></th>
</tr>


<tr>
<td>


<table align='center' width='100%' id='excel' class='tablex' style='border-collapse: collapse; border: 1px solid;'>
<tr>
<th class='text-center'><b>#</th>
<th class='text-center'><b>PATIENT'S NAME</th>
<th class='text-center'><b>SENIOR</th>
<th class='text-center'><b>$trans</th>
<th class='text-center'><b>DATE</th>
<th class='text-center'><b>TEST</th>
<th class='text-center'><b>ACCTTITLE</th>
<th class='text-center'><b>GROSS</th>
<th class='text-center'><b>SHARE</th>
</tr>
";
$i=0;
if($test == "All"){
$sql22 = "select receiving.description, receiving.unit, UPPER(patientprofile.lastname) as lname,UPPER(patientprofile.firstname) as fname,UPPER(patientprofile.middlename) as mname, patientprofile.senior, readersfee.amount,readersfee.caseno,readersfee.date,admission.hmo,readersfee.refno1,readersfee.gross,readersfee.productcode,readersfee.refno,readersfee.producttype  from readersfee, admission, patientprofile, receiving where readersfee.productcode=receiving.code and readersfee.date between '$dstart' AND '$dend'  and (admission.ward='out' or admission.ward='discharged' or admission.ward='in') and readersfee.doctor  like '%$reader%' and admission.caseno=readersfee.caseno and patientprofile.patientidno=admission.patientidno order by receiving.unit, readersfee.date";
}else{
$sql22 = "select UPPER(patientprofile.lastname) as lname,UPPER(patientprofile.firstname) as fname,UPPER(patientprofile.middlename) as mname, patientprofile.senior, readersfee.amount,readersfee.caseno,readersfee.date,admission.hmo,readersfee.refno1,readersfee.gross,readersfee.productcode,readersfee.refno,readersfee.producttype  from readersfee,admission,patientprofile where readersfee.date between '$dstart' AND '$dend'  and (admission.ward='out' or admission.ward='discharged' or admission.ward='in') and readersfee.doctor  like '%$reader%' and admission.caseno=readersfee.caseno and patientprofile.patientidno=admission.patientidno and readersfee.productcode='$test'  order by readersfee.date";
}


$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()){ 
$fname=$row22['fname'];
$lname=$row22['lname'];
$mname=$row22['mname'];
$name = $lname.", ".$fname." ".$mname;
$datez=$row22['date'];
$productcode=$row22['productcode'];
$gross=$row22['gross'];
$amount=$row22['amount'];
$senior=$row22['producttype'];
$senior2=$row22['senior'];
$refno20=$row22['refno1'];
$hmo=$row22['hmo'];
$desc=$row22['description'];
$unit=$row22['unit'];
$col="black";

if($senior=="" or $senior=="READERS FEE" or $senior=="A"){$senior = $senior2; $col = "red";}else{$col="black";}
if($senior == "Y" or $senior == "y" or $senior == "YES"){$senior="YES";}else{$senior="NO";}

if($trans=="CASH"){$sql223 = "select excess from productout where refno='$refno20' AND status ='PAID' and excess > 0";}
elseif($trans=="HMO"){$sql223 = "select hmo from productout where  refno='$refno20' AND status ='Approved' and hmo > 0";}
elseif($trans=="PHIC"){$sql223 = "select phic from productout where  refno='$refno20' AND status ='Approved' and phic > 0";}
elseif($trans=="CHARGE EXCESS"){$sql223 = "select excess from productout where refno='$refno20' AND status ='Approved' and excess > 0";}
$result223 = $conn->query($sql223);
while($row223 = $result223->fetch_assoc()){ 
$amount2 += $amount;
$gross2 += $gross;
$i++;
echo"
<tr>
<td class='text-center' style='font-size:11px;'>$i.</td>
<td class='text-center' style='font-size:11px;'>$name</td>
<td class='text-center' style='font-size:11px;'>$senior</td>
<td class='text-center' style='font-size:11px;'>---</td>
<td class='text-center' style='font-size:11px;'>$datez</td>
<td class='text-center' style='font-size:11px;'>$desc</td>
<td class='text-center' style='font-size:11px;'>$unit</td>
<td class='text-center' style='font-size:11px;'>$gross</td>
<td class='text-center' style='font-size:11px;'>$amount</td>
</tr>
<tr>
";
}

}

$amount2 = number_format($amount2, 2);
$gross2 = number_format($gross2, 2);

echo "
<tr>
<td bgcolor='gray' class='text-center'><font color='white'>TOTAL:</td>
<td bgcolor='gray'></td>
<td bgcolor='gray'></td>
<td bgcolor='gray'></td>
<td bgcolor='gray'></td>
<td bgcolor='gray'></td>
<td bgcolor='gray'></td>
<td bgcolor='gray' class='text-center'><font color='white'>$gross2</td>
<td bgcolor='gray' class='text-center'><font color='white'>$amount2</td>
</tr>
<tr>
";

echo "
</table>
";
?>


<?php
echo "
</td>
</tr>
<tr>
<th style='border-bottom: solid 1px black;'></th>
</tr>
<tr>
<td>
<table align='center' width='100%'>
<tr>
<td>PREPARED BY:</td>
<td>CHECKED BY:</td>
<td>NOTED BY:</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><u>_______________________</u></td>
<td><u>_______________________</u></td>
<td><u>_______________________</u></td>
</tr>
<tr>
<td>RADIOLOGY HEAD</td>
<td>ACCOUNTING IN-CHARGE</td>
<td>ADMINISTRATOR</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<textarea id='result' name='result' rows='1' cols='90' style='font-size: 18px;' disabled>
</textarea></font>
</td>
</tr>
</table>


</body>
</html>
";
?>

</div>

</div>
          </div>

        </div>
      </div>
    </section>