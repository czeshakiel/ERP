<?php
include '../main/class.php';
$str = $_GET['str'];



if($str=="verifyadminister"){
$pass =$_GET['pass'];
$username = $_GET['username'];
$ck = $conn->query("select * from nsauth where username='$username' and password='$pass'");
if(mysqli_num_rows($ck)>0){echo"YES";}else{echo"NO";}
}


if($str=="ARtrade_otp"){
$otp =$_GET['otp'];
$caseno = $_GET['caseno'];
$ck = $conn->query("select * from  otp where caseno='$caseno' and otp='$otp'");
if(mysqli_num_rows($ck)>0){
$conn->query("update otp set status='Approved' where caseno='$caseno' and otp='$otp'");
$conn->query("delete from otp where status!='Approved' and caseno='$caseno'");
echo"YES";
}
else{echo"NO";}
}



if($str=="save_ds_lab"){
$idx = $_GET['idx'];
$labresult = $_GET['lab'];
$btn =$_GET['btn'];
$caseno = $_GET['caseno'];
$dateadded=date("Y-m-d H:i:s");
if($btn=="btnsave"){$conn->query("INSERT INTO `labfindings` (`caseno`, `labfindings`, `dateadded`, `addedby`) VALUES ('$caseno', '$labresult', '$dateadded', '$user')");}
else{$conn->query("update labfindings set labfindings='$labresult', dateadded='$dateadded', addedby='$user' where no='$idx'");}
}



if($str=="delete_ds_lab"){
$idx = $_GET['idx'];
$conn->query("delete from labfindings where no='$idx'");
}



if($str=="save_ds_med"){
$desc = $_GET["desc"];
$qty = $_GET["qty"];
$route = $_GET["route"];
$frequency = $_GET["frequency"];
$am = $_GET["am"];
$nn = $_GET["nn"];
$pm = $_GET["pm"];
$mn = $_GET["mn"];
$duration = $_GET["duration"];
$caseno = $_GET['caseno'];
$code = $_GET['code'];
$batchno = $_GET['batchnox'];
$dept2 = "pharmacy";

//$conn->query("delete from homemeds where caseno='$caseno' and code='$code' and batchno='$batchno'");
//$conn->query("delete from productouthm where caseno='$caseno' and productcode='$code' and batchno='$batchno'");
//$conn->query("delete from productoutconsult where caseno='$caseno' and batchno='$refnox'");

$ss = $conn->query("select * from homemeds where caseno='$caseno' and code='$code' and batchno='$batchno'");
if(mysqli_num_rows($ss)>0){

$conn->query("update homemeds set dosage='$route', frequency='$frequency', tam='$am', tnn='$nn', tpm='$pm',
 tmn='$mn', duration='$duration' where caseno='$caseno' and code='$code' and batchno='$batchno'");

}else{

$refno="MYHM".date("YmdHis");
$conn->query("INSERT INTO `homemeds`(`caseno`, `refno`, `code`, `dosage`, `frequency`, `tam`, `tnn`, `tpm`, `tmn`, `duration`, `dateadded`, `addedby`, `batchno`) VALUES
('$caseno','$refno','$refno','$route','$frequency','$am','$nn','$pm','$mn','$duration',NOW(),'$user', '$refno')");

$conn->query("INSERT INTO `productouthm`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`,
`trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`,
`referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno',CURTIME(),'$caseno','$refno','$desc','$sp','$qty',
'$adjustment','$net','homemeds','0','0','$net','$datex','$appr','$rrno','$empid','$caseno','$prodtype','PHARMACY/MEDICINE','insert-1','QR-$qty','pending','HOMEMEDS', '$dept2', CURDATE(), '')");

}
}



if($str=="delete_ds_med"){
$id = $_GET['no'];
$refno = $_GET['refno'];
$conn->query("delete from productouthm where refno='$refno'");
$conn->query("delete from homemeds where no='$id'");
}





if($str=="save_ds_oi"){
$dd = $_GET['dd'];
$td = $_GET['td'];
$od = $_GET['od'];
$ffon = $_GET['ffon'];
$ffat = $_GET['ffat'];
$at = $_GET['at'];
$pb = $_GET['pb'];
$rb = $_GET['rb'];
$db = $_GET['db'];
$caseno = $_GET['caseno'];
$dateadded=date("Y-m-d H:i:s");

$conn->query("delete from dsdetails where caseno='$caseno'");
$conn->query("INSERT INTO `dsdetails` (`caseno`, `datedischarged`, `timedischarged`, `operationdone`, `ffcheckupon`, `ffat`, `advise`, `dischargedby`, `preparedby`, `rod`, `dateadded`, `addedby`)
VALUES ('$caseno', '$dd', '$td', '$od', '$ffon', '$ffat', '$at', '$db', '$pb', '$rb', '$dateadded', '$user')");
echo"hahahaha";
}



if($str=="get_orno"){
$dept = $_GET['dept'];

$result22j = $conn->query("SELECT * from orno_series where status='Active' and dept='$dept'");
while($row22j = $result22j->fetch_assoc()) {
$orno_id=$row22j['id'];
$active_or = $row22j['orno'];
}

$sql22jj = "SELECT * from orno_used where orseries='$orno_id'";
$result22jj = $conn->query($sql22jj);
$orseries = mysqli_num_rows($result22jj);

if($orseries>0){
$result22jjj = $conn->query("SELECT max(or_used) as maxor from orno_used where orseries='$orno_id'");
while($row22jjj = $result22jjj->fetch_assoc()) {$maxor=$row22jjj['maxor'];}
$orno = $maxor+1;
}else{$orno = $active_or;}

echo"$orno";
}



if($str=="AIchatbot"){
$curl = curl_init();
$OPENAI_API_KEY="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";
$question = $_GET['str2'];
$data = array(
        'model' => 'text-davinci-003',
        'prompt' => "Q: $question",
        'temperature' => 0,
        'max_tokens' => 100,
        'top_p' => 1,
        'frequency_penalty' => 0,
        'presence_penalty' => 0,
        'stop' => ['\n']
    );
    
    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer '.$OPENAI_API_KEY
    );
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.openai.com/v1/completions',
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => $headers,
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    
    //echo $response;
    
    
    $string = $response;
    $start = '"text":"\n\n';
    $end = '","index":0';
    
    $start_pos = strpos($string, $start);
    $end_pos = strpos($string, $end);
    
    $substring = substr($string, $start_pos, $end_pos - $start_pos + strlen($end));
    $substring = str_replace('"text":"\n\n', "", $substring);
    $substring = str_replace('","index":0', "", $substring);
    $substring = str_replace('A: ', "", $substring);
    if(strpos($substring, '"object":"text_completion"')!==false){$substring="no answer!";}
    if($substring==""){$substring="No Internet Connection!";}
    
    $datetime = date("Y-m-d H:i:s");
    $conn->query("INSERT INTO `chatbot`(`chat`, `reply`, `user`, `ip`, `datetime`) VALUES ('$question', '$substring', '$user', '', '$datetime')");
}



// if($str=="patient"){
// echo "<option value=''>Select Patient</option>";
// $sqlccv = "SELECT * FROM patientprofilewalkin where patientidno!='' order by lastname";
// $resultccv = $conn->query($sqlccv);
// while($rowccv = $resultccv->fetch_assoc()) {
// $patientidno=$rowccv['patientidno'];
// $name = $rowccv['lastname'].", ".$rowccv['firstname']." ".$rowccv['middlename'];
// $namex = $name."_____".$patientidno;
// echo"<option value='$namex'>$name</option>";
// }
// }

// if($str=="doctor"){
// echo "<option hidden>Select Doctor</option>
// <option value='NONE__NONE'>NONE</option>";
// $sqlccv = "SELECT * FROM docfile order by name";
// $resultccv = $conn->query($sqlccv);
// while($rowccv = $resultccv->fetch_assoc()) {
// $name=$rowccv['name'];
// $codedoc=$rowccv['code'];
// $co = $codedoc."__".$name;
// echo"<option value='$codedoc'>$name</option>";
// }
// }


if($str=="patient"){
$searchTerm = $_GET['q'];
if($searchTerm==""){}else{
$querySelectlist = $conn->query("SELECT * FROM patientprofilewalkin WHERE patientidno!='' AND (CONCAT(lastname, ', ', firstname, ' ', middlename) LIKE '%$searchTerm%' OR 
CONCAT(lastname, ' ', firstname, ' ', middlename) LIKE '%$searchTerm%') ORDER BY lastname ASC");
    
$results = [];
if ($querySelectlist->num_rows > 0) {
while ($rwi = $querySelectlist->fetch_assoc()) {
    $result = [
    'id' => $rwi['patientidno'],
    'text' => $rwi['lastname'] . ', ' . $rwi['firstname'] . ' ' . $rwi['middlename']
    ];

$results[] = $result;
}

} else {
    $results[] = [
    'id' => '',
    'text' => 'No data found.'
    ];
}
}
echo json_encode($results);
}
    
 



if($str=="doctor"){
$results = [];
$searchTerm = $_GET['q'];

if($searchTerm==""){
    $results[] = [
    'id' => 'NONE__NONE',
    'text' => "NONE"
    ];
}else{
$querySelectlist = $conn->query("SELECT * FROM docfile WHERE (CONCAT(lastname, ', ', firstname, ' ', middlename) LIKE '%$searchTerm%' OR CONCAT(lastname, ' ', firstname, ' ', middlename) LIKE '%$searchTerm%') ORDER BY lastname ASC");
if ($querySelectlist->num_rows > 0) {
while ($rwi = $querySelectlist->fetch_assoc()) {
    $result = [
    'id' => $rwi['code'],
    'text' => $rwi['name']
    ];
    $results[] = $result;
}
} else {
    $results[] = [
    'id' => '',
    'text' => 'No data found.'
    ];
}
}
echo json_encode($results);
}
    
    
    
    


if($str=="barcode"){
$barcode=$_GET['str2'];
$dept=$_GET['dept'];
$bar = $conn->query("select * from receiving where aveconsole='$barcode'");
if(mysqli_num_rows($bar)==1){
while($bar1 = $bar->fetch_assoc()){$code=$bar1['code'];}
$qty1 = "1";
$ttype = "PATIENT";
include "../pharmacy/pricingscheme_vat.php";
include "../pharmacy/POSinsert.php";
}else{echo"no item found...";}
}

if($str=="validate_cp"){
$caseno=$_GET['caseno'];
$passwordx=$_GET['pass'];

$result = $conn->query("SELECT * FROM admission where employerno='$caseno'");
$result2 = $conn->query("SELECT * FROM nsauth where password='$passwordx'");

if(mysqli_num_rows($result)>0){echo"Caseno Exist!";}
elseif(mysqli_num_rows($result2)==0){echo"Wrong Password!";}
else{echo"ok";}
}


if($str=="generateseq"){
$seqname=$_GET['seqname'];
$user = $_GET['user'];

$resultmm = $conn->query("SELECT * FROM seqpatientid WHERE id='1'");
if(mysqli_num_rows($resultmm) > 0){
        
while($rowm = $resultmm->fetch_assoc()) {
$seq_name=$rowm['seq_name'];
$seq_code=$rowm['seq_code'];
$last_value=$rowm['last_value'];
$date=date('Y-m-d H:i:s');
$new_value=$last_value+1;
}
        
if($new_value > 99){
$new_value="01";
$seq_code=$seq_code+1;

if($seq_code > 99){
$seq_name=$seq_name+1;
$seq_code="00";
if(strlen($seq_name) < 2){$seq_name="0".$seq_name;}
}

if(strlen($seq_code)<2){$seq_code="0".$seq_code;}
}
        
$count_last_value=strlen($new_value);
$count_format=strlen('00');
$count=$count_format - $count_last_value;
$new_format="";
for($i=0;$i<$count;$i++){$new_format="0".$new_value;}
if($count<=0){$new_format=$new_value;}
        
$caseno=$seq_name."-".$seq_code."-".$new_format;
$conn->query("UPDATE seqpatientid SET seq_name='$seq_name',seq_code='$seq_code',last_value='$new_format',last_gen_date='$date',last_gen_by='$user' WHERE id='1'");

        
}else{

$new_value="01";
$last_gen_date="00";
$format='00';
$caseno=$format."-".$last_gen_date."-".$new_value;
$conn->query("INSERT INTO seqpatientid(id,seq_name,seq_code,last_value,last_gen_date,last_gen_by) VALUES('$seqname','$format','$last_gen_date','$new_value',NOW(),'$user')");
}
        
echo"$caseno";
}




if($str=="loadprovince"){
$pro = $_GET['str2'];
if($pro==""){echo "<option value='' hidden>Select Province</option>";}

$result2 = $conn->query("SELECT * FROM state");
while($row2 = $result2->fetch_assoc()) { 
$province=$row2['statename'];
$provinceid=$row2['id'];

if($pro==$province){echo "<option value='$province' selected>$province</option>";}
else{echo "<option value='$province'>$province</option>";}
}
}


if($str=="loadmunicipality"){
$name=$_GET['str2'];
$mun=$_GET['str3'];
if($mun==""){echo "<option hidden>Select Municipality</option>";}

$result2 = $conn->query("SELECT * FROM state where statename='$name'");
while($row2 = $result2->fetch_assoc()) { $provinceid=$row2['id'];}

$result3 = $conn->query("SELECT * FROM city where stateid='$provinceid' order by city");
while($row3 = $result3->fetch_assoc()) { 
$municipality=$row3['city'];
$municipalityid=$row3['id'];

if($mun==$municipality){echo "<option value='$municipality' selected>$municipality</option>";}
else{echo "<option value='$municipality'>$municipality</option>";}
}
}


if($str=="loadbarangay"){
$name=$_GET['str2'];
$bar=$_GET['str3'];
if($bar==""){echo "<option hidden>Select Barangay</option>";}

$result = $conn->query("SELECT * FROM city where city='$name'");
while($row = $result->fetch_assoc()){ $cityid=$row['id'];}

$result2 = $conn->query("SELECT * FROM barangay where cityid='$cityid'");
while($row2 = $result2->fetch_assoc()) { 
$barangay=$row2['barangay'];
$barangayid=$row2['id'];

if($bar==$barangay){echo "<option value='$barangay' selected>$barangay</option>";}
else{echo "<option value='$barangay'>$barangay</option>";}
}
}

if($str=="loadzipcode"){
$pro=$_GET['pro'];
$mun=$_GET['mun'];

$result = $conn->query("SELECT * FROM state where statename='$pro'");
while($row = $result->fetch_assoc()){ $proid=$row['id'];}

$result = $conn->query("SELECT * FROM city where city='$mun'");
while($row = $result->fetch_assoc()){ $munid=$row['id'];}

$result = $conn->query("SELECT * FROM zipcode where PROV_ID='$proid' and MUN_ID='$munid'");
while($row = $result->fetch_assoc()){ $zipcode=$row['ZIP_CODE'];}

echo"$zipcode";
}


if($str=="chargeto"){
$ct = $_GET['str2'];

if($ct=="AR EMPLOYEE" or $ct=="EMPLOYEE"){
echo "<option value=''>Select Employee</option>";
$result2 = $conn->query("SELECT * FROM nsauthemployees order by name");
while($row2 = $result2->fetch_assoc()) { 
$name=$row2['name'];
$id=$row2['empid']."||".$row2['name'];
echo "<option value='$id'>$name</option>";
}

}else{
    echo "<option value=''>Select Doctor</option>";
    $result2 = $conn->query("SELECT * FROM docfile order by name");
    while($row2 = $result2->fetch_assoc()) { 
    $name=$row2['name'];
    $id=$row2['code']."||".$row2['name'];
    echo "<option value='$id'>$name</option>";
    }

}
}


if($str=="adjustment_qty"){
$qty = $_GET['qty'];
$id = $_GET['id'];
$user = $_GET['user']; 
$conn->query("update bulkadjustment set qty='$qty', user='$user' where id='$id'");
}
?>