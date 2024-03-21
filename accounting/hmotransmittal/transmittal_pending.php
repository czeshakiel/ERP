<h5><font color='black'><i class="fa-solid fa-laptop-medical"></i> UNDONE TRANSACTIONS</font></h5><hr>
<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center">#</th>
<th class="text-center">Company</th>
<th class="text-center">Batchno</th>
<th class="text-center">Amount</th>
<th class="text-center">Date</th>
<th class="text-center">User</th>
<th class="text-center"></th>
</tr>
</thead>
<tbody>


<?php
$i = 0;
$sql4 = "select sum(amount) as amount, batchno, transdate, user, company, ptype, trantype, idhmo from arv_tbl_hmotransmittallist where transaction = 'requesting' group by batchno";
$result4 = $conn->query($sql4);
while($row4 = $result4->fetch_assoc()) {
$batchno=$row4['batchno'];
$amount=$row4['amount'];
$transdate=$row4['transdate'];
$userx=$row4['user'];
$company=$row4['company'];
$idhmo=$row4['idhmo'];
$ptype=$row4['ptype'];
$ttype=$row4['trantype'];
$hmo = $idhmo."||".$company;
$i++; $ecol="black";

echo"
<tr>
<td align='center'><font color='blue'>$i</td>
<td>$company</td>
<td>$batchno</td>
<td>$amount</td>
<td>$transdate</td>
<td>$userx</td>
<td style='text-align: center;'>
<a href='?newtransmittallist&hmo=$hmo&batchno=$batchno&ptype=$ptype&ttype=$ttype&transdate=$transdate'><button class='btn btn-info btn-sm'>Submit</button></a>
</td>
</tr>
";
}
?>

</tbody>
</table>

