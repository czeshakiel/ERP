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

<?php
include "../../main/connection.php";
$caseno = $_GET['caseno'];


echo"<table width='100%' class='tablex'><tr><th>TEST</th><th>AMOUNT</th></tr>";
$total = 0;
$result = $conn->query("select sum(hmo) as amountc, productdesc from productout where caseno='$caseno' and quantity>0 and trantype='charge' group by productdesc");
while($row = $result->fetch_assoc()) {
$amountc = $row['amountc'];
$productdesc = $row['productdesc'];
$total += $amountc;
$total2 = number_format($total, 2);
echo "<tr><td>$productdesc</td><td>$amountc</td></tr>";
}
echo"<tr><td><b>TOTAL</b></td><td><b>$total2</b></td></tr></table>";
?>