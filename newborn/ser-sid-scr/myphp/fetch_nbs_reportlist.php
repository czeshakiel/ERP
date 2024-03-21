<?php
include '../../meshes/alink.php';
ini_set("display_errors","off");
echo "<table id=patient-table' class='table table-hover align-middle mb-0' style='width: 100%;'>
        <thead>
            <tr>
                <th class='text-center'><i class='icofont-navigation-menu'></i></th>
                <th class='text-center'>Title</th>
                <th class='text-center'>Date/Time Created</th>
                <th class='text-center'>Date Submitted</th>
                <th class='text-center'>Action</th>
            </tr>
        </thead>
    <tbody>";
    $queryFetch = $pdo->query("SELECT * FROM `nbs_report` ORDER BY `slc_year` ASC");
        if($queryFetch->rowCount() > 0){
            while($row = $queryFetch->fetch(PDO::FETCH_ASSOC)){
                $yr_slc = $row['slc_year'];
                $rp_title = $row['title'];
                $datecreated = $row['date_created'];
                $datesubmitted = $row['date_submitted'];
                $timecreated = $row['time_created'];
                $yearExists = false;
                if($datesubmitted == "0000-00-00"){$datesubmitted = "";}
                $queryCheck = $pdo->query("SELECT `year` FROM nbs_report_details WHERE `year` = '$yr_slc' GROUP BY `year`");
                if($queryCheck->rowCount() > 0){ $yearExists = true;}
               
echo "
        <tr>
            <td class='text-center'><i class='icofont-newspaper'></i></td>
            <td class='text-center'>$rp_title</td>
            <td class='text-center'>$datecreated<br>$timecreated</td>
            <td class='text-center'>$datesubmitted</td>
            <td class='text-center'>
                <button class='btn btn-primary' data-bs-toggle='tooltip' data-bs-placement='top' title='Manage Report' onclick=\"manageNbsReport('$yr_slc')\"><i class='icofont-gear'></i></button>
                <button class='btn btn-danger' data-bs-toggle='tooltip' data-bs-placement='top' title='Print Report' onclick=\"chooseReport('$yr_slc')\"><i class='icofont-print'></i></button>
            </td>
        </tr>";
    } 
}else{
echo"
        <tr>
            <td colspan='5'> No result.</td>
        </tr>";
}
echo "
    </tbody>
</table>";
?>