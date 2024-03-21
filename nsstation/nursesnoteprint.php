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


<?php
$rundate = $_GET['datef'];
$dateto = $_GET['datet'];
$caseno = $_GET['caseno'];
$pname = $_GET['pname'];
   
$sql2 = "SELECT * FROM admission where caseno='$caseno'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) { 
$room=$row2['room'];
}
?>


<div class="col-lg-12" style="width: 100%;">
<div class="card mb-4">
<div class="table-responsive p-3">


<button class="btn btn-danger" onclick="printDiv()"><li class="fa fa-print"></li> Print</button>
<hr class="sidebar-divider">



<div id='GFG'>
<html>
<style type='text/css'>
textarea { border: none; }
</style>
<style>
@media print {
* {
-webkit-print-color-adjust: exact;
}
}
th{ font-weight: normal;}
textarea{visibility:hidden;}
table {border-collapse: collapse; border: 1;}
</style>
<body>


<table width="100%" border="0"><tr>
<td align="right" width="5%" style="text-align: center;"><div style="height: 100px;width: 100px;"><img src="../main/img/logo/mmshi.png" width="100" height="100"></div></td>
<td align="center" width="95%" style="text-align: center;"><label style="font-size:18px;font-family: Times New Roman; color: black;"><?=$heading;?></label><p><font color="black"><?=$address;?></p><br><label style="font-size: 20px;font-family: Times New Roman; color: black;">NURSES' NOTE</label></td>
</tr>
</table>

<br></br>
<font color="black" size="2">
NAME: <u><?php echo $pname ?></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ROOM: <u><?php echo $room ?></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
CASENO: <u><?php echo $caseno ?></u><br><br>
</font>

<table width="100%"><th style="height: 930px;" valign="top">
<table width="100%" cellpadding="1" cellspacing="2" border="1">
<tr>
<td align="center" style="font-size:15px;font-family: Times New Roman; color: black; text-align: center;" width="10%"><b>DATE</b></td>
<td align="center" style="font-size:15px;font-family: Times New Roman; color: black; text-align: center;" width="12%"><b>TIME</b></td>
<td align="center" style="font-size:15px;font-family: Times New Roman; color: black; text-align: center;"><b></b></td>
</tr>
<?php
$sql2v = "SELECT * FROM medical_notes where caseno='$caseno' and type='NURSE' and subtype='active' order by dateposted asc, timeposted asc";
$result2v = $conn->query($sql2v);
while($row = $result2v->fetch_assoc()){
$caseno=$row['caseno'];
$datep=$row['dateposted'];
$timep=$row['timeposted'];
$notes=$row['notes'];
$user11=$row['user'];
$idno=$row['id'];

echo "
<tr style=''>
<td style='text-align: center; font-size:14px;font-family: Times New Roman;'><font color='black'>$datep</td>
<td style='text-align: center; font-size:14px;font-family: Times New Roman;'><font color='black'>$timep</td>
<td style='text-align: center; font-size:14px;font-family: Times New Roman;'><font color='black'>$notes</td>
</tr>
";
}
?>
</table>
</th></table>

<?php $totalhosp=$diaghosp; ?>
<br><p style='font-size:12px;font-family: Times New Roman;font-weight: bold;'><b>Signature of Patient/ Representative:</u>  ________________________________</p>
</body></html>							
</div>
</div>
</div>
