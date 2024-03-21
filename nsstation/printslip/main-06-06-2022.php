<?php
$caseno = $_GET['caseno'];
if(isset($_POST['btnsave'])){
$refno = $_POST['refno'];
$remarks = $_POST['remarks'];
$test = $_POST['test'];

$sql22x = "select * from labtest  where caseno='$caseno' and refno='$refno'";
$result22x = $conn->query($sql22x);
$countx = mysqli_num_rows($result22x);

if($countx>0){
$sql778 = "update labtest set remarks = '$remarks' where caseno='$caseno' and refno='$refno'";
if ($conn->query($sql778) === TRUE) {}
}else{
$sql778 = "insert into labtest (remarks, caseno, refno, test) values ('$remarks', '$caseno', '$refno', '$test')";
if ($conn->query($sql778) === TRUE) {}
}

echo"<script>alert('Successfully Update!'); window.location = '?view=printslip&caseno=$caseno$datax';</script>";
}
?>

<div class="col-lg-12" style="width: 100%;">
<div class="card mb-4">
<div class="table-responsive p-3">

<font color='black'><?php echo $caseno." - ".$ptname ?></font><hr>

<table width="100%">
<tr><td valign="TOP" width="55%">

<?php
echo"
<div class='panel panel-default' id='accordion'>
<a data-toggle='collapse' data-parent='#accordion'><div class='panel-heading' style='background: #0F6F8D;'>
<font color = 'white'>LABORATORY/ IMAGING PROCEDURES</font></div></a>
<form method='POST' name='arvz' action='../nsstation/printslip/ticket_select.php?caseno=$caseno&user=$user' target='_blank'>


<br><table width='98%' border='1' align='center'>
<tr>
<td width='5%' bgcolor='$primarycolor' class='text-center'><font color='white'></td>
<td align='center' bgcolor='$primarycolor' class='text-center'><font color='white'><b>Description</td>
<td width='5%' align='center' bgcolor='$primarycolor' class='text-center'><font color='white'><b>Date</td>
<td width='5%' bgcolor='$primarycolor' class='text-center'><font color='white'><b>Trantype</td>
<td width='25%' bgcolor='$primarycolor' class='text-center'><font color='white'><b>Status</td>
<td width='10%' bgcolor='$primarycolor' class='text-center'><font color='white'></td>
</tr>
";


$i = 0;
$sql22 = "SELECT * from productout where caseno='$caseno' and (productsubtype like '%LABORATORY%' OR productsubtype like '%XRAY%' OR productsubtype like '%ULTRASOUND%' OR productsubtype like '%MAMO%' OR batchno like '%LXD%') and status!='CANCELLED' and (terminalname!='Testdone' and terminalname!='Testtobedone') order by productsubtype, terminalname, productdesc";
$result22 = $conn->query($sql22);
$count = mysqli_num_rows($result22);
while($row22 = $result22->fetch_assoc()) {
$desc=$row22['productdesc'];
$refno=$row22['refno'];
$trantype=$row22['trantype'];
$status=$row22['status'];
$status2=$row22['terminalname'];
$referenceno=$row22['referenceno'];
$datereq=$row22['datearray'];
$desc2 = $desc;
$i++;

$packagename="";
$pckge = $conn->query("select * from packagelist where pckgno='$referenceno'");
while($pcg = $pckge->fetch_assoc()){$packagename = $pcg['packagename'];}

$remarks="";
$sql222 = $conn->query("SELECT * from labtest where caseno='$caseno' and refno='$refno'");
while($row222 = $sql222->fetch_assoc()) {$remarks=$row222['remarks'];}

if($remarks != ""){$desc = $desc." - <font size='1' color='blue'> (".$remarks.")</font>";}
if($packagename!= ""){$desc = $desc." - <font size='1' color='red'><i> (".$packagename.")</i></font>";}

echo"
<tr>
<td align='center'><input type='checkbox' style='transform : scale(1.5);' name='ck[]' id='ck' value='$refno'></td>
<td><font class='font8'>$desc</td>
<td><font class='font8'>$datereq</td>
<td align='center'><font class='font8'>$trantype</td>
<td align='center'><font class='font8'>$status - $status2</td>
<td class='text-center'>
<div class='dropdown'>
<a class='btn btn-danger dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='padding: 0px 10px;'> <i class='fa fa-cog'></i></a>
<div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
<a class='dropdown-item' href='../nsstation/printslip/ticket_batch.php?caseno=$caseno&refno=$refno&user=$user' target='_blank'><i class='fa fa-print'></i> Print</a>
";
?>
<a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModalScrollable" id="#modalScroll" onclick="rem('<?php echo $remarks ?>', '<?php echo $refno ?>', '<?php echo $desc2 ?>');"><i class='fa fa-edit'></i> Edit Remarks</a>
<?php
echo"
</div>
</div>
</td>
</tr>
";
}

if($count>1){
echo "
<tr><td colspan='5' style='text-align: center;'>
<button type='button' class='btn btn-info' onclick='check()' style='padding: 0px 10px;'>Check ALL</button>
<button type='button' class='btn btn-primary' onclick='uncheck()' style='padding: 0px 10px;'>Uncheck ALL</button>
<button class='btn btn-danger' style='padding: 0px 10px;'>Print Selected Item(s)</button>
</td></tr>
";
}
echo"
</table><br></form></div>";

?>
</td><td width="1%"></td><td valign="TOP">

<?php


$i++;
echo"
<div class='panel panel-default' id='accordion'>
<a data-toggle='collapse' data-parent='#accordion' href='#collapseOne$i'><div class='panel-heading' style='background: #0F6F8D;'>
<font color='white'>Medicine & Supplies Request</font>
</font></div></a>
<form method='POST' action='../nsstation/printslip/ticket_select.php?caseno=$caseno&user=$user' target='_blank'>

";

$i = 0;
$sql2 = "SELECT * from productout where caseno='$caseno' AND (productsubtype like '%SUPPLIES%' or productsubtype like '%MEDICINE%') AND administration='pending' and status!='PAID' and quantity>0 group by batchno order by batchno desc, datearray desc";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()){
$batchno=$row2['batchno'];
$trantype = $row2['trantype'];

if($trantype == "cash") {$btn = "http://$ip/2021codes/ChargeCart/ccpharmacyprintticketRX.php?ticketno=$batchno&caseno=$caseno";}
else{$btn = "../nsstation/printslip/ticket_batch.php?caseno=$caseno&batchno=$batchno&user=$user";}


echo"
<br><table width='98%' border='1' align='center'>
<tr>
<td bgcolor='$primarycolor' class='text-center'><font color='white'><a href='$btn' target='_blank'><i class='fa fa-print'></i> Print Batch $batchno</a></td>
<td width='5%' bgcolor='$primarycolor' class='text-center'><font color='white'>Trantype</td>
<td width='1%' bgcolor='$primarycolor' class='text-center'><font color='white'></td>
</tr>
";


$sql22 = "SELECT * from productout where batchno = '$batchno' and caseno='$caseno' AND status!='CANCELLED' and (productsubtype like '%SUPPLIES%' or productsubtype like '%MEDICINE%') group by productcode order by productdesc";
$result22 = $conn->query($sql22);
$count = mysqli_num_rows($result22);
while($row22 = $result22->fetch_assoc()) {
$desc=$row22['productdesc'];
$refno=$row22['refno'];
$trantype=$row22['trantype'];
$status=$row22['status'];
$status2=$row22['terminalname'];
$referenceno=$row22['referenceno'];
$quantity=$row22['quantity'];


echo"
<tr>
<td class='text-center'><font class='font8'>$desc</td>
<td class='text-center'><font class='font8'>$trantype</td>
<td class='text-center'><a href='$btn' target='_blank'><button type='button' class='btn btn-primary' style='padding: 0px 10px;'><i class='fa fa-print'></i></button></a></td>
</tr>
";


}
echo"</table>";
}
echo"
</form><br></div>";

?>


</td>
</tr></table>

</div>
</div>
</div>

<script>
function rem(val, val2, val3){
document.getElementById("myTextarea").value = val;
document.getElementById("refno").value = val2;
document.getElementById("test").value = val3;
document.getElementById('lab').innerHTML = val3;
}

function check(){
if(!document.forms['arvz'])
return;
var objCheckBoxes = document.forms['arvz'].elements['ck[]'];
if(!objCheckBoxes)
return;
var countCheckBoxes = objCheckBoxes.length;
if(!countCheckBoxes)
objCheckBoxes.checked = true;
else
for(var i = 0; i < countCheckBoxes; i++)
objCheckBoxes[i].checked = true;
}

function uncheck(){
if(!document.forms['arvz'])
return;
var objCheckBoxes = document.forms['arvz'].elements['ck[]'];
if(!objCheckBoxes)
return;
var countCheckBoxes = objCheckBoxes.length;
if(!countCheckBoxes)
objCheckBoxes.checked = false;
else
for(var i = 0; i < countCheckBoxes; i++)
objCheckBoxes[i].checked = false;
}
</script>

  <!-- Modal Scrollable -->
<form method="POST">
          <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Remarks</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h5 class="font-weight-bold">Remarks</h5>
                  <p id="lab"></p>
                  <textarea name="remarks" id = "myTextarea"></textarea>
                  <input type="hidden" name="refno" id = "refno">
                  <input type="hidden" name="test" id = "test">
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                  <button type="submit" name="btnsave" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
</form>
          <!-- Modal Center -->
