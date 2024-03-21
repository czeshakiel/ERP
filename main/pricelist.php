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

<script>
function printDiv() {
var divContents = document.getElementById("GFG").innerHTML;
var a = window.open('', '', 'height=500, width=500');
a.document.write('<html>');
a.document.write(divContents);
a.document.write('</body></html>');
a.document.close();
a.print();
}
</script>


<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item">Pricelist</li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<button class="btn btn-primary btn-sm" onclick="printDiv()"><i class="icofont-printer"></i> Print Pricelist</button><p></p>
<hr>

<?php
if($dept=="HEART"){$que="(unit='HEARTSTATION' or unit = 'ECG')";}


echo "
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
<td style='background-image:url(../main/img/logo/mmshi.png);background-repeat:no-repeat;background-size:70px 70px;'>
<p align='center'><font color='black'><b>$heading</b><br>$address<br>
$dept PRICELIST<br>
</td>
</tr>

<tr>
<td>
<br>


</td>
</tr>

<tr>
<td>
<table align='center' class='tablex' width='100%' border='1'>
<tr>
<td style='font-size: 12px;'><b>#</td>
<td style='font-size: 12px;'><b>CODE</td>
<td style='font-size: 12px;'><b>DESCRIPTION</td>
<td style='font-size: 12px;'><b>UNIT</td>
<td style='font-size: 12px;'><b>CASH</td>
<td style='font-size: 12px;'><b>CHARGE</td>
</tr>
<tr>
";

$i=0;
$sql222 = "SELECT * FROM receiving where $que";
$result222 = $conn->query($sql222);
while($row222 = $result222->fetch_assoc()){ 
$code=$row222['code'];
$description=$row222['description'];
$unit=$row222['unit'];
$i++;

$bb = $conn->query("select * from productsmasterlist where code='$code'");
while($bb1=$bb->fetch_assoc()){$cash = number_format($bb1['opd'], 2); $charge=number_format($bb1['philhealth'], 2);}


if($oldqty>=$newqty){$discre = $oldqty - $newqty;}else{$discre = $newqty - $oldqty;}
echo"
<tr>
<td style='font-size: 12px;'>$i.</td>
<td style='font-size: 12px;'>$code</td>
<td style='font-size: 12px;'>$description</td>
<td style='font-size: 12px;'>$unit</td>
<td style='font-size: 12px; text-align: right;'>$cash</td>
<td style='font-size: 12px; text-align: right;'>$charge</td>
</tr>
";
}


echo "
</table>
</td>
</tr>
</table>


</body>
</html>
</div>
";
?>







</div>
</div>
</div>
</div>
</section>
</main>

