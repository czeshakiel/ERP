<html>
<head><title>Wala</title></head>
<body>
<?php
mysql_connect("localhost","root","b0ykup4l");
mysql_select_db("kmsci");

$date=$_GET['date'];

$asql=mysql_query("SELECT admission.caseno, admission.patientidno, patientprofile.lastname, patientprofile.firstname, patientprofile.middlename FROM admission, patientprofile, dischargedtable WHERE admission.caseno=dischargedtable.caseno AND admission.patientidno=patientprofile.patientidno AND admission.paymentmode='Member' AND dischargedtable.datedischarged='$date'");

while($afetch=mysql_fetch_array($asql)){
echo "
<table border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td><div align='left'>&nbsp;".$afetch['caseno']."&nbsp;</div></td>
    <td><div align='left'>&nbsp;".$afetch['lastname'].", ".$afetch['firstname']." ".$afetch['middlename']."&nbsp;</div></td>
    <form name='form' method='get' target='_blank' action='http://192.168.0.207:100/2017codes/SOA/StatementOfAccountPHICVer.php'>
    <td>&nbsp;<input type='submit' name='submit' value='submit' />&nbsp;</td>
    <input type='hidden' name='caseno' value='".$afetch['caseno']."' />
    <input type='hidden' name='patientidno' value='".$afetch['patientidno']."' />
    <input type='hidden' name='uname' value='Mark Alocelja' />
    </form>
  </tr>
</table>
"
}
?>
</body>
</html>
