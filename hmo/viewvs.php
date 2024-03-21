<?php
include('../main/connection.php');
$caseno=$_POST['id'];
$response="";
$query=mysqli_query($conncf4,"SELECT vs.*,CONCAT(pp.pPatientFname,' ',pp.pPatientLname) as patientname FROM pepert vs INNER JOIN enlistment pp ON pp.caseno=vs.caseno WHERE vs.caseno='$caseno'");
if(mysqli_num_rows($query)>0){
	$items=mysqli_fetch_array($query);
	$name=$items['patientname'];
	$bp=$items['pSystolic']." / ".$items['pDiastolic'];
	$hr=$items['pHr'];
	$rr=$items['pRr'];
	$temp=$items['pTemp'];
    $Other=mysqli_query($conncf4,"SELECT * FROM subjective WHERE caseno='$caseno'");
    $row=mysqli_fetch_array($Other);
    $history=$row['pIllnessHistory'];
    $complaint=$row['pChiefComplaint'];
	$response = '<h4>'.$name.'</h4>
                       <table width="100%" border="0" style="font-size:16px;">
                        <tr>
                            <td>BP: '.$bp.' mmHg</td>
                            <td>HR: '.$hr.' / min</td>
                        </tr>
                        <tr>
                            <td>RR: '.$rr.' / min</td>
                            <td>Temp: '.$temp.' &deg;C</td>
                        </tr>
                        <tr>
                            <td colspan="2">Brief History:<br><br>'.$history.'</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">Chief Complaint:<br><br>'.$complaint.'</td>
                        </tr>
                       </table>';
}
echo $response;
?>