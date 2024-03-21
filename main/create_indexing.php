<?php
include "../main/connection.php";

$conn->query("CREATE INDEX arv_casestudy ON productout (productcode, trantype, status, datearray, refno)");
$conn->query("CREATE INDEX arv_casestudy ON admission (caseno);");

$conn->query("CREATE INDEX arv_cashierPTdeposit ON admission (patientidno, ward, room, dateadmit, timeadmitted)");
$conn->query("CREATE INDEX arv_cashierPTdeposit ON patientprofile (patientidno)");

$conn->query("CREATE INDEX arv_cashierOPD ON productout (caseno, trantype, status, productsubtype, datearray)");
$conn->query("CREATE INDEX arv_cashierOPD ON admission (caseno, ward)");

$conn->query("CREATE INDEX arv_homemeds ON admission (status, caseno)");
$conn->query("CREATE INDEX arv_homemeds ON productout (caseno, location, administration, shift, quantity, datearray, invno)");

$conn->query("CREATE INDEX arv_homemeds_qty ON stocktable (code, dept, quantity)");
$conn->query("CREATE INDEX arv_homemeds_qty ON receiving (code, unit, description, generic)");

$conn->query("CREATE INDEX arv_xray ON admission (caseno, patientidno, room, ward)");
$conn->query("CREATE INDEX arv_xray ON productout (caseno, productsubtype, terminalname, status, datearray, invno)");

$conn->query("CREATE INDEX arv_reader_pt ON productout (caseno, terminalname, productsubtype, referenceno)");
$conn->query("CREATE INDEX arv_reader_pt ON patientprofile (patientidno)");
$conn->query("CREATE INDEX arv_reader_pt ON admission (caseno, patientidno)");

$conn->query("CREATE INDEX arv_issuancehistory on purchaseorder (reqdept, dept, status reqno, code)");
$conn->query("CREATE INDEX arv_issuancehistory on stocktable (datearray, isid, code)");

echo"<h1>DONE INDEXING......</h1>";
?>





