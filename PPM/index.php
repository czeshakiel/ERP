<?php
session_start();
include 'prop/connect/link.php';
ini_set('display_errors','on');
$loginuser = $_GET['user'];
if(isset($_POST['search']) && $_POST['search'] !=""){$search = $_POST['search'];}else{$search ="";}
?>
<!doctype html> 
<html class="no-js" lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Patient Profile Merging</title>
<link href="prop/img/logo/logo.png" rel="icon">
<link rel="stylesheet" href="prop/assets/plugin/datatables/responsive.dataTables.min.css">
<link rel="stylesheet" href="prop/assets/plugin/datatables/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="prop/assets/css/my-task.style.min.css">
<link rel="stylesheet" href="prop/select2/select2.min.css">
<link rel="stylesheet" href="prop/assets/css/mystyle.css">
<link rel="stylesheet" href="prop/assets/css/mystylus.css">
<link rel="stylesheet" href="prop/assets/css/jquery-ui.css">
<style>
.tooltipbutton {position: relative; display: inline-block; cursor: pointer;}
.tooltipbutton::before {content: attr(data-tooltip); position: absolute; background: rgba(0, 0, 0, 0.7); color: #fff; padding: 4px 8px; border-radius: 4px; top: 100%; left: 50%; transform: translateX(-50%); opacity: 0; pointer-events: none; transition: opacity 0.2s ease-in-out; width: 280px;}
.tooltipbutton:hover::before {opacity: 1;}
</style>
</head>
<body>
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h5 class="fw-bold mb-0">Patient Profile Merging</h5>
                        <div class="row">
                            <div class="col-md-2" style="border:none; padding:0; margin:0">
                                <a type="submit" class="btn btn-danger" style="width: 70px;" onclick="ptprofileMergedList()"><span style="font-weight:bold">History</span></a>
                            </div>
                            <div class="col-md-10" style="border:none">
                                <a type="submit"><h5 class="fw-bold mb-0" id="duplicateCountDiv"></h5></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <form method = "POST">
                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5><b>LIST</b></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control cusinp" id="search" oninput="convertToUpperCase(this)" name="search" placeholder="Enter lastname firstname middlename" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group" style="text-align:center;">
                                <button type="submit" class="btn btn-success cusbtn"><i class="icofont-search-job"></i> Search</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body">
                    <table class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style='text-align:center; width:35%'>Patients</th>
                                <th style='text-align:center; width:10%'>HRN</th>
                                <th style='text-align:center; width:10%'>Age</th>
                                <th style='text-align:center; width:10%'>Senior</th>
                                <th style='text-align:center; width:15%'>Date of Birth</th>
                                <th style='text-align:center; width:10%'>Number Of CaseNo.</th>
                                <th style='text-align:center; width:10%'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $querySelect = $conn->query("SELECT * FROM patientprofile WHERE CONCAT(lastname,' ',firstname,' ',middlename) LIKE '%$search%' ORDER BY lastname ASC LIMIT 20");
                                if($querySelect->num_rows > 0){
                                    while($row = $querySelect->fetch_assoc()){
                                        $gender = $row['sex'];
                                        if($gender == 'M'){
                                            $image = 'avatar7.jpg';
                                        }elseif($gender == 'F'){
                                            $image = 'avatar6.jpg';
                                        }else{
                                            $image = 'avatar5.jpg';
                                        }
                                        $lastname = $row['lastname'];
                                        $firstname = $row['firstname'];
                                        $middlename = $row['middlename'];
                                        $suffix = $row['suffix'];
                                        $dateofbirth = $row['dateofbirth'];
                                        $patientidno = $row['patientidno'];
                                        $birthdate = new DateTime($dateofbirth);
                                        $currentDate = new DateTime();
                                        $age = $currentDate->diff($birthdate)->y;
                                        
                                        $possibleDuplicateQuery = $conn->query("SELECT * FROM patientprofile WHERE `lastname` = '$lastname' AND `firstname` = '$firstname' AND `middlename` = '$middlename' AND `patientidno` != '{$row['patientidno']}'");
                                        if ($possibleDuplicateQuery->num_rows > 0) {
                                            $possibleDuplicate = "<span class='glwspn'>Possible Duplicate</span>";
                                        } else {
                                            $possibleDuplicate = "";
                                        }

                                        $queryAdmission = $conn->query("SELECT COUNT(caseno) as casecnt FROM admission WHERE patientidno ='$patientidno'");
                                        $fetch = $queryAdmission->fetch_assoc();
                                        $totalcaseno = $fetch['casecnt'];
                                        $queryHrn = $conn->query("SELECT COUNT(id) as hid FROM hrn WHERE patientidno = '$patientidno'");
                                        $fthrn = $queryHrn->fetch_assoc();
                                        $hrnCount = $fthrn['hid'];
                                        if($hrnCount > 0){
                                            $hrn = "<span class='glwtxtyes'>EXIST<span>";
                                            $disablebtn = true;
                                        }else{
                                            $hrn = "<span class='glwtxtno'>NOT<span>";
                                            $disablebtn = false;
                                        }
                                        $senior = $row['senior'];
                            ?>
                            <tr>
                                <td style='text-align:left'>
                                    <div class="row">
                                        <div class="col-sm-1" style="border:none">
                                            <img src="prop/assets/images/xs/<?=$image;?>" class="avatar rounded-circle" alt="profile-image">
                                        </div>
                                        <div class="col-sm-8" style="border:none">
                                            <span><?=$lastname;?>, <?=$firstname;?> <?=$middlename;?></span><br>
                                            <small><b><i><?=$patientidno;?></i></b></small>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span><?=$possibleDuplicate;?></span>
                                        </div>
                                    </div>
                                </td>
                                <td style='text-align:center'><?=$hrn;?></td>
                                <td style='text-align:center'><?=$age;?></td>
                                <td style='text-align:center'><?=$senior;?></td>
                                <td style='text-align:center'><?=$dateofbirth;?></td>
                                <td style='text-align:center'><?=$totalcaseno;?></td>
                                <td style='text-align:center'>
                                    <button type="button" onclick="viewCasenoCount('<?=$patientidno;?>','<?=$lastname;?>','<?=$firstname;?>','<?=$middlename;?>')" class="btn btn-warning" style="color:black" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="icofont-eye-alt"></i></button>
                                    <button type="button" onclick="mergePatientidno('<?=$patientidno;?>','<?=$lastname;?>','<?=$firstname;?>','<?=$middlename;?>','<?=$dateofbirth;?>')" class="btn btn-danger" style="color:black" data-bs-toggle="tooltip" data-bs-placement="top" title="Merge" <?= $disablebtn ? 'disabled' : '' ?>><i class="icofont-rounded-collapse"></i></button>
                                </td>
                            </tr>
                            <?php 
                                }
                            } 
                            else {echo "<tr>
                                    <td colspan='6'><b>No result for this name.</b></td>.
                                </tr>";}
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Viewing patientidno "caseno" in admission modal -->
    <div class="modal fade" id="viewNumberofCasenoModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="patientName"></h5>
                    &nbsp;&nbsp;<span id="patientIdNoDis" style="color:blue"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="casenolist"></div>
                </div>
                <div class="modal-footer" style="text-align:center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Merging Modal -->
    <div class="modal fade" id="mergingModal" tabindex="-1" role="dialog" aria-labelledby="myModalMeringPtProfile" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="exampleModalLgLabel">Merge Patient Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <span id="alertmsg"></span>
                            <div class="form-group">
                                <input type="text" id="patientnameid" class="form-control" readonly>
                                <input type="hidden" id="loginuser" class="form-control" value="<?=$loginuser;?>">
                            </div>
                            <div class="form-group" style="text-align:center; margin-top:5px">
                                <span><b>merge to</b></span>
                            </div>
                            <div class="form-group">
                                <input type="text" list="doublepatientname" id="originalptprofile" class="form-control" readonly>
                                <datalist id="doublepatientname">
                                    <option value=""></option>
                                </datalist>
                            </div>
                            <div class="form-group">
                               <h6 style="padding-top:20px">LIST</h6>
                            </div>
                            <div class="form-group" id="thisgroup">
                               <div id="doublelist"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-lg btn-secondary btnbld" data-bs-dismiss="modal"> Close</button>
                    <button type="submit" class="btn btn-lg btn-danger btnbld" onclick="mergepatientprofile()"> Merge</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal confirmation -->
    <div class="modal fade" id="confirmMergeModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content mdlcnt">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="icofont-question-circle"></i> Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p>Are you sure, you want to merge this patientidno "<span id="selectedtomerge" class="bldtxt"></span>" to "<span id="cons_patientidno" class="bldtxt"></span>"?</p>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary canlbtn" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info confbtn" id="confirmedMergePtProfile">Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <!-- duplicate patient name list modal -->
    <div class="modal fade" id="duplicatePatientNameList" tabindex="-1" aria-labelledby="exampleModalXlLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title h4" id="exampleModalXlLabel">List of Duplicate Patient Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="PTdataTable"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- history list of merged patient profile modal -->
    <div class="modal fade" id="ptProfileMergingHistory" tabindex="-1" aria-labelledby="exampleModalXlLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title h4" id="exampleModalXlLabel">List of Merged Patient Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="ptMergedListTable"></div>
                </div>
            </div>
        </div>
    </div>

      <!-- success -->
    <div class="modal fade" id="popupAlertSuccess" tabindex="-1" 
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modalbox success center animate">
                <div class="icon">
			    	<span class="icofont-thumbs-up"></span>
			    </div>
			    <h1>Success!</h1>
			    <p>Merging patient profile has been successful.</p>
			    <button type="button" class="btn confSBtn" style="text-align:center">Ok</button>
            </div>
        </div>
    </div>

     <!-- failed -->
    <div class="modal fade" id="popupAlertFailed" tabindex="-1" 
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modalbox error center animate">
                <div class="icon">
			    	<span class="icofont-thumbs-down"></span>
			    </div>
			    <h1>Oh no!</h1>
			    <p>Oops! Something went wrong,</p>
				<p>you should try again.</p>
			    <button type="button" class="btn confEBtn" style="text-align:center">Ok</button>
            </div>
        </div>
    </div>

<!-- scripts -->
<script src="prop/js/jquery-3.7.1.min.js"></script>
<script src="prop/assets/bundles/libscripts.bundle.js"></script>
<script src="prop/assets/bundles/dataTables.bundle.js"></script>
<script src="prop/js/template.js"></script>
<script src="prop/js/custom_js/csmrge.js"></script>
<script src="prop/js/jquery-ui.js"></script>
<script src="prop/select2/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('#confirmMergeModal, #ptProfileMergingHistory').draggable({
          handle: '.modal-header',
        });
    });
</script>
</body>
</html>