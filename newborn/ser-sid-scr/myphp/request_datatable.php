<?php
session_start();
ini_set('display_errors', 'on');
include '../../meshes/alink.php';
$lgnuser = $_SESSION['username'];
$reqType = $_POST['selectedRequestType'];

$commonConditions = "p.productsubtype NOT LIKE '%MISCELLANEOUS' AND p.status != 'CANCELLED'";
if ($reqType == 'IPD') {
    $wardCondition = "a.ward = 'in' AND p.terminalname != 'Testtobedone' AND p.terminalname != 'Testdone'";
} else if ($reqType == 'OPD') {
    $wardCondition = "a.ward = 'out' AND p.terminalname != 'Testtobedone' AND p.terminalname != 'Testdone' AND p.datearray > (CURDATE() - INTERVAL 7 DAY)";
}
$query = "SELECT 
        p.caseno, p.refno, p.batchno, p.productdesc, p.status, p.gross, p.approvalno,
        p.loginuser, p.terminalname, p.hmo, p.invno, a.ward, a.patientidno, a.room, 
        a.dateadmitted, p.productsubtype, p.productcode, p.trantype, p.datearray, 
        a.timeadmitted 
    FROM 
        productout p 
    JOIN 
        admission a ON a.caseno = p.caseno
    WHERE 
        (
            p.productdesc LIKE '%NEWBORN HEARING%' 
            OR p.productdesc LIKE '%NEWBORN SCREENING%' 
            OR p.productdesc LIKE '%AUDIOMETRY%'
        ) 
        AND $wardCondition
        AND $commonConditions
    GROUP BY 
        p.refno 
    ORDER BY 
        p.datearray DESC, p.invno";
$statement = $pdo->prepare($query);
$statement->execute();
echo "
<table id='patient-table' class='table table-hover align-middle mb-0' style='width: 100%;'>
<thead>
    <tr>
        <th style='text-align:center'>Patient Id</th>
        <th style='text-align:center'>Patients Name</th>
        <th style='text-align:center'>Description</th>
        <th style='text-align:center'>Status</th>
        <th style='text-align:center'>Test</th>
        <th style='text-align:center'>Userlog</th>
        <th style='text-align:center'>Date/ Time</th>
        <th style='text-align:center'>Repeat</th>
        <th style='text-align:center'>Action</th>
    </tr>
</thead>
<tbody id='nwbrn_ipdlist'>";
$rowCount = $statement->rowCount();
if ($rowCount > 0) {
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $row) {
        $caseno = $row['caseno'];
        $refno = $row['refno'];
        $productdesc = $row['productdesc'];
        $status =$row['status'];
        $gross = $row['gross'];
        $loginuser = $row['loginuser'];
        $terminalname = $row['terminalname'];
        $ward = $row['ward'];
        $patientidno = $row['patientidno'];
        $room = $row['room'];
        $dateadmitted = $row['dateadmitted'];
        $timeadmitted = $row['timeadmitted'];
        $hmo = $row['hmo'];
        $invno = $row['invno'];
        $date = $row['datearray'];
        $trantype = $row['trantype'];
        $productsubtype = $row['productsubtype'];
        $productcode = $row['productcode'];
        $approvalno = $row['approvalno'];
        $batchno = $row['batchno'];

        $queryptprofile = $pdo->query("SELECT * FROM patientprofile WHERE patientidno = '$patientidno'");
        $ptexist = $queryptprofile->rowCount();
        while($rowx = $queryptprofile->fetch(PDO::FETCH_ASSOC)) {
            $lname=$rowx['lastname'];
            $fname=$rowx['firstname'];
            $mname=$rowx['middlename'];
            $name = $lname.", ".$fname." ".$mname;
        }

        if($ptexist<=0){
            $queryEmp = "SELECT * FROM nsauthemployees WHERE empid='$patientidno'";
            $resultEmp = $pdo->query($queryEmp);
            while($rowEmp = $resultEmp->fetch(PDO::FETCH_ASSOC)) {
            $lname=$rowEmp['lastname'];
            $fname=$rowEmp['firstname'];
            $mname=$rowEmp['middlename'];
            $name = $lname.", ".$fname." ".$mname;
            }
        }

        $ofr="";
        if($status=="PAID"){
            $queryColl = "SELECT ofr FROM `collection` WHERE refno='$refno'";
            $resultColl = $pdo->query($queryColl);
            while($rowColl = $resultColl->fetch(PDO::FETCH_ASSOC)) {
                $ofr ="- ".$rowColl['ofr'];
            } 
        }
                 
        $name = strtoupper($name);
        $loginuser = strtoupper($loginuser);
        $gross = number_format($gross,"2",".",",");

        if($approvalno=="FOR CANCEL"){$name = $name."<p class='blink-me'><font size='5'> FOR DELETE</font></p>; $bgnd = '#FFF3CD'";}

        // refund 
        if($terminalname == "pending" && $status == "PAID"){
            $refund = "<button type='submit' onclick=\"forRefundItem('$caseno','$refno','$loginuser')\" data-bs-toggle='tooltip' data-bs-displacement='top' title='For Return Item' class='btn btn-outline-primary'><i class='icofont-peso-plus'></i></button>";
        }else if($terminalname == "refund" && $status == "PAID"){
            $refund = "<button type='submit' onclick=\"UndoForRefundItem('$caseno','$refno','$loginuser')\" data-bs-toggle='tooltip' data-bs-displacement='top' title='Undo Return Item' class='btn btn-outline-primary'><i class='icofont-ui-reply'></i></button>";
        }else{
            $refund = "";
        }

        $queryRd = "SELECT * FROM xrayevent WHERE hmo='$refno'";
        $resultRd = $pdo->query($queryRd);
        $ccount = $resultRd->rowCount();
        if($ccount>0){
            while($rowh = $resultRd->fetch(PDO::FETCH_ASSOC)) {
                $read = $rowh['ap'];
            }
        }else{ $read = "---------";}

        if($status=='requested'){$ecol='red';}else{$ecol='black';}
        $queryMGH = "SELECT dept,caseno FROM mgh_table WHERE caseno ='$caseno' AND stat='requesting' AND dept='RADIOLOGY'";
        $resultMGH = $pdo->query($queryMGH);
        while($rowMGH = $resultMGH->fetch(PDO::FETCH_ASSOC)) {
            $a1 =$rowMGH['dept'];
            $a2 =$rowMGH['caseno'];
            if($a2 == "$caseno"){$z1=$z1+1;}
        }

        if($ccount > 0){
            $read = "<a type='submit' onclick=\"readersDetail('$reader')\" data-bs-toggle='tooltip' data-bs-displacement='top' title='Reader' class='btn btn-outline-success'><i class='icofont-doctor'></i></a>";
        }else{
            $read = "";
        }

        if($status=="requested"){
            $bgnd = "#F8D7DA";
            $ths_bttn = "<button type='submit' data-bs-toggle='tooltip' data-bs-displacement='top' title='Request is not Paid or Approved' class='btn btn-outline-light'><i class='icofont-exclamation-circle text-danger'></i></button>";
        }else if($terminalname=="Testdone"){
            $bgnd = "";
            $ths_bttn = "<button type='submit' onclick=\"print_report_result('$caseno','$lgnuser','$dept','$refno')\" data-bs-toggle='tooltip' data-bs-displacement='top' title='View' class='btn btn-outline-primary'><i class='icofont-eye-alt'></i></button>";
        }
        else{
            $bgnd = "";
            $ths_bttn = "<button type='submit' onclick=\"proceedTestdone('$caseno','$refno')\" data-bs-toggle='tooltip' data-bs-displacement='top' title='Set Doctor, Film NO.' class='btn btn-outline-info'><i class='icofont-laboratory'></i></button>";
        }
        if(($trantype=="charge" and $terminalname=="pending" and $ccount=="") OR ($trantype=="cash" and $terminalname=="pending" and $status=="requested" and $ccount=="")) {
            $ths_btn2 = "<button type='submit' onclick=\"deletenewborn('$caseno','$refno')\" data-bs-toggle='tooltip' data-bs-displacement='top' title='Delete' class='btn btn-outline-danger'><i class='icofont-trash'></i></button>";
        }elseif(($trantype=="cash" and $terminalname=="pending" and $status=="PAID") || ($trantype=="cash" and $terminalname=="refund" and $status=="PAID")) {
            $ths_btn2 = $refund;
        }else{
            $ths_btn2 = "<button type='submit' onclick='' data-bs-toggle='tooltip' data-bs-displacement='top' title='Delete is not allowed for $status transaction.' class='btn btn-outline-light'><i class='icofont-ui-block text-danger'></i></button>";
        }
        echo "
            <tr style='background-color:$bgnd;'>
               <td style='text-align:center'>".$patientidno."</td>
               <td><img src='assets/images/xs/babyboy.png' class='avatar sm rounded-circle me-2' alt='profile-image'><span>".$name."</span></td>
               <td>".$productdesc."</td>
               <td>".$status.$ofr ."</td>
               <td>".$terminalname."</td>
               <td style='text-align:center'><a type='submit' onclick=\"loginuserDetails('$loginuser')\" data-bs-toggle='tooltip' data-bs-displacement='top' title='Person Request' class='btn btn-outline-info'><i class='icofont-ui-user'></i></a></td>
               <td>".$date." | ".$invno."</td>
               <td style='text-align:center'></td>
               <td style='text-align:center'>
                    <div class='func-btn'>  
                        $ths_bttn 
                        <button type='submit' onclick=\"print_allsup('$caseno','$batchno','$refno','$trantype','$lgnuser')\" data-bs-toggle='tooltip' data-bs-displacement='top' title='Print' class='btn btn-outline-warning'><i class='icofont-print'></i></i></button> 
                        $ths_btn2
                    </div>
               </td>
            </tr>";
        }
} else {
    echo "<tr><td colspan='9'>No records found.</td></tr>";
}
echo"
</tbody>
</table>
";
?>