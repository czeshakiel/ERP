<?php
if(isset($_POST['subm'])){
$casen = $_POST['caseno'];
$chargeto = $_POST['chargeto'];

$conn->query("update collection set shift='$chargeto' where acctno='$casen' and (accttitle like '%EMPLOYEE%' or accttitle like '%DOCTOR%') and type='pending'");
echo"<script>window.history.back();</script>";
}
?>

<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center">#</th>
<th class="text-center">PATIENT <br> INFORMATION</th>
<th class="text-center">DATE AND TIME OF<br>ADMITTED/ DISCHARGED</th>
<th class="text-center">DESCRIPTION/ <br> AMOUNT</th>
<th class="text-center">ROOM/ <br> USER</th>
<th class="text-center">ACTION</th>
</tr>
</thead>
<tbody>


<!-- ################################ ARVID QUERY..... START SQL QUERY ##############################################-->


<?php
if(isset($_GET['aremployee'])){$vi = "c.accttitle like '%EMPLOYEE%'"; $v1="EMPLOYEE";}
elseif(isset($_GET['ardoctor'])){$vi = "c.accttitle like '%DOCTOR%'"; $v1="DOCTOR";}
else{$vi = "(c.accttitle like '%EMPLOYEE%' or c.accttitle like '%DOCTOR%' or c.accttitle like '%TRADE%')"; $v1="TRADE";}

//$sqlc = "select acctname,description,accttitle,amount,acctno,refno,username from collection  where  type='pending' and amount > 0 and accttitle like '%TRADE%' group by acctno";
$sqlc = "select c.acctname, c.description, c.accttitle, sum(c.amount) as amount, c.acctno, c.refno, c.username, c.shift from
 collection c inner join acctgenledge a on c.refno=a.refno  where c.type='pending' and $vi group by c.acctno having amount>0";
$resultc = $conn->query($sqlc);
while($rowc = $resultc->fetch_assoc()){
$acctname2=$rowc['acctname'];
$description2=$rowc['description'];
$accttitle2=$rowc['accttitle'];
$amount2=number_format($rowc['amount'], 2);
$refno2=$rowc['refno'];
$acctno2=$rowc['acctno'];
$uuname=$rowc['username'];
$shift = $rowc['shift'];

if($shift==""){$shift="<button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#requestreturn2x' onclick=\"loademp('$acctno2');\">XX</button>";}

if($v1!="TRADE"){$acctname2=$acctname2."<br><b style='font-size: 10px; color: green;'>Charge to:<font color='red'>".$shift."</font></b>";}
$i++;

$sqlccc = "select * from admission a, patientprofile p  where a.patientidno=p.patientidno and a.caseno='$acctno2'";
$resultccc = $conn->query($sqlccc);
while($rowccc = $resultccc->fetch_assoc()) {
$dateadmit=date("F d, Y", strtotime($rowccc['dateadmit']));
$timeadmit=date("h:i:s a", strtotime($rowccc['timeadmitted']));
$dtadmit = $dateadmit." ".$timeadmit;
$sex = $rowccc['sex'];
$room2=$rowccc['room'];
$hmo2=$rowccc['hmo'];
$ward2=$rowccc['ward'];
$status2=$rowccc['status'];
}

$sqlcccx = "select * from dischargedtable where caseno='$acctno2'";
$resultcccx = $conn->query($sqlcccx);
if(mysqli_num_rows($resultcccx)>0){
while($rowcccx = $resultcccx->fetch_assoc()){
$datedisch=date("F d, Y", strtotime($rowcccx['datearray']));
$timedisch=date("h:i:s a", strtotime($rowcccx['timedischarged']));
$dtdisch = $datedisch." ".$timedisch;
}
}else{$dtdisch ="Not yet discharge";}

if($sex=="M"){if($senior=="Y"){$ge="boy";}else{$ge="boy";}}
else{if($senior=="Y"){$ge="girl";}else{$ge="girl";}}
echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $acctno2<br><b>$acctname2</b></td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>Admitted: $dtadmit </br>Discharged: $dtdisch</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$description2<br>$amount2</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'><font color='gray'><i class='icofont-bed'></i></font> $room2<br><font color='gray'><i class='icofont-user'></i></font> $uuname</td>
<td style='text-align: center;' bgcolor='$col'>
<a href='?arpayment&caseno=$acctno2'><button type='submit' class='btn btn-outline-primary mb-1 btn-sm'><i class='icofont-check-circled'></i></button></a>
</td>
</tr>
";
 } ?>
</tbody>
</table>



<div class="modal fade" id="requestreturn2x" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog" style="box-shadow: 0px 0px 2000px #6e7fcb;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> VERIFY PROCEDURE</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<form method="POST">
<input type="text" name="caseno" id="caseno" class="form-control" readonly><br>
<select style='width: 100%; height:30px; font-size:12pt; padding: 0px;' name="chargeto" id="chargeto" class="form-control"></select><br>
<p align="right"><button class="btn btn-primary" name="subm">Submit</button></p>
</form>

</div>
</div>
</div>
</div>


<script>
function loademp(casen){
var v1 = "<?php echo $v1 ?>";
var str = "chargeto";

document.getElementById('caseno').value=casen;

if(v1=="EMPLOYEE"){
$.get("../main/functions.php", {str:str, str2:v1},
function (data) {$("#chargeto").html(data);});
}

else if(v1=="DOCTOR"){
$.get("../main/functions.php", {str:str, str2:v1},
function (data) {$("#chargeto").html(data);});
}
}
</script>