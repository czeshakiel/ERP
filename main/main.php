<?php
$in = $conn->query("select * from admission where ward='in'");
$inpatient = mysqli_num_rows($in);

$out = $conn->query("select * from admission where ward='out' and dateadmit=CURDATE();");
$outpatient = mysqli_num_rows($out);

$dis = $conn->query("select * from dischargedtable where dept='in' and datearray=CURDATE();");
$discharged = mysqli_num_rows($dis);
?>

<script>
setInterval(myTimer, 1000);
function myTimer() {
const d = new Date();
document.getElementById("demo").innerHTML = d.toLocaleTimeString();
}
</script>

<style>
.parent {
  position: relative;
  top: 0;
  left: 0;
}
.image1 {
  position: relative;
  top: 0;
  left: 0;
opacity: 0.2;
width: 100%;
}
.image2 {
  position: absolute;
 top: 100px;
  left: 30px;
width: 80%;
}
</style>

<!-- Body: Body -->
        <div class="body d-flex py-3">
            <div class="container-xxl">
                <div class="row g-3 mb-3 row-deck">
                    <div class="col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="card ">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar lg  rounded-1 no-thumbnail bg-lightyellow color-defult"><i class="bi bi-journal-check fs-4"></i></div>
                                    <div class="flex-fill ms-4">
                                        <div class="">Total Inpatient(s)</div>
                                        <h5 class="mb-0 "><?php echo $inpatient ?></h5>
                                    </div>
                                    <a href="?totalinpatient" title="view-members" class="btn btn-link text-decoration-none  rounded-1"><i class="icofont-hand-drawn-right fs-2 "></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="card ">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar lg  rounded-1 no-thumbnail bg-lightblue color-defult"><i class="bi bi-list-check fs-4"></i></div>
                                    <div class="flex-fill ms-4">
                                        <div class="">Daily OPD</div>
                                        <h5 class="mb-0 "><?php echo $outpatient ?></h5>
                                    </div>
                                    <a href="task.html" title="space-used" class="btn btn-link text-decoration-none  rounded-1"><i class="icofont-hand-drawn-right fs-2 "></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="card ">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar lg  rounded-1 no-thumbnail bg-lightgreen color-defult"><i class="bi bi-clipboard-data fs-4"></i></div>
                                    <div class="flex-fill ms-4">
                                        <div class="">Today's Discharged</div>
                                        <h5 class="mb-0"><?php echo $discharged ?></h5>
                                    </div>
                                    <a href="task.html" title="renewal-date" class="btn btn-link text-decoration-none  rounded-1"><i class="icofont-hand-drawn-right fs-2 "></i></a>
                                </div>
                            </div>
                        </div>
                    </div>



                </div><!-- Row End -->
                <div class="row g-3 mb-3 row-deck">
                    <div class="col-md-12 col-lg-8 col-xl-7 col-xxl-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                  
                                    <div style="text-align: justify; text-justify: inter-word; width: 60%;">
                                        <h3 class="fw-bold "><i class="icofont-eye"></i> VISION</h3>
                                       <?php echo $vision ?><br><br>
                                       <h3 class="fw-bold "><i class="icofont-hospital"></i> MISSION</h3>
                                       <?php echo $mission ?>
                                    </div>
                                    <div style="width: 40%;">
                                        <div class="text-center p-4 parent">
                                            <img src="../main/img/logo/mmshi.png" alt="..." class="image1">
<img src="../main/img/missionvision.gif" alt="..." class="image2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 col-xl-5 col-xxl-5">
                        <div class="alert alert-primary p-3 mb-0 w-100">
                    <i class='icofont-certificate-alt-1'></i> CERTIFICATES
                        <!-- COUROSEL -->
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class=""></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="img-fluid" src="../main/img/cert_eclaims.png" alt="" />
        </div>
        <div class="carousel-item">
            <img class="img-fluid" src="../main/img/cert_emr.png" alt="" />
        </div>
    </div>

</div>
                        <!-- COUROSEL -->



                        </div>
                    </div>
                </div><!-- Row End -->
 
                <div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 row-cols-xxl-4">
                    <div class="col">
                        <div class="card bg-primary">
                            <div class="card-body text-white d-flex align-items-center">
                                <i class="icofont-data fs-3"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h6 style="font-size: 12px;">PHILHEALTH PSG</h6>
                                    <small><a href='../main/uploadfiles.php?psg' target='dis_sum'>
                                    <button type="button" class='btn btn-outline-info btn-sm' style="padding: 3px; font-size: 11px;" data-bs-toggle="modal" data-bs-target="#dis_sum_modal"><i class="icofont-arrow-right"></i> View PSG List</button>
                                </a></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card bg-primary">
                            <div class="card-body text-white d-flex align-items-center">
                                <i class="icofont-chart-flow fs-3"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h6 style="font-size: 12px;">CLINCAL PRACTICE GUIDELINES</h6>
                                    <small><a href='../main/uploadfiles.php?cpg' target='dis_sum'>
                                    <button type="button" class='btn btn-outline-info btn-sm' style="padding: 3px; font-size: 11px;" data-bs-toggle="modal" data-bs-target="#dis_sum_modal"><i class="icofont-arrow-right"></i> View CPG List</button>
                                </a></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card bg-primary">
                            <div class="card-body text-white d-flex align-items-center">
                                <i class="icofont-chart-flow-2 fs-3"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h6 style="font-size: 12px;">LICENSING ASSESSMENT TOOL</h6>
                                    <small><a href='../main/uploadfiles.php?lat' target='dis_sum'>
                                    <button type="button" class='btn btn-outline-info btn-sm' style="padding: 3px; font-size: 11px;" data-bs-toggle="modal" data-bs-target="#dis_sum_modal"><i class="icofont-arrow-right"></i> View LAT List</button>
                                </a></small>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col">
                        <div class="card bg-primary">
                            <div class="card-body text-white d-flex align-items-center">
                                <i class="icofont-tasks fs-3"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h6 style="font-size: 12px;">Date: <?php echo date("F d, Y"); ?></h6>
                                    <small style="color: yellow; font-size: 15px;">Time: <b id="demo"></b></small>
                                </div>
                            </div>
                        </div>
                    </div>             
                </div>
                <div class="row g-3 mb-3 row-deck">
                    <div class="col-md-12">
                        <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <div class="info-header">
                                        <h6 class="mb-0 fw-bold ">Project Information</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Date Start</th>
                                                <th>Deadline</th>
                                                <th>Leader</th>
                                                <th>Completion</th>
                                                <th>Stage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="projects.html">Social Geek Made</a></td>
                                                <td>10-01-2021</td>
                                                <td>4 Month</td>
                                                <td><img src="assets/images/xs/avatar1.jpg" alt="Avatar" class="avatar sm  rounded-circle me-2"><a href="#">Keith</a></td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"  style="width: 78%;">78%</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-warning">MEDIUM</span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="projects.html">Practice to Perfect</a></td>
                                                <td>12-02-2021</td>
                                                <td>1 Month</td>
                                                <td><img src="assets/images/xs/avatar2.jpg" alt="Avatar" class="avatar sm rounded-circle me-2"><a href="#">Colin</a></td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar  bg-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">80%</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-success">LOW</span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="projects.html">Rhinestone</a></td>
                                                <td>18-02-2021</td>
                                                <td>2 Month</td>
                                                <td><img src="assets/images/xs/avatar3.jpg" alt="Avatar" class="avatar sm rounded-circle me-2"><a href="#">Adam</a></td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar  bg-primary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">90%</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-danger">HIGH</span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="projects.html">Box of Crayons</a></td>
                                                <td>23-02-2021</td>
                                                <td>1 Month</td>
                                                <td><img src="assets/images/xs/avatar4.jpg" alt="Avatar" class="avatar sm rounded-circle me-2"><a href="#">Peter</a></td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar  bg-primary" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">85%</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-warning">MEDIUM</span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="projects.html">Gob Geeklords</a></td>
                                                <td>16-03-2021</td>
                                                <td>10 Month</td>
                                                <td><img src="assets/images/xs/avatar5.jpg" alt="Avatar" class="avatar sm rounded-circle me-2"><a href="#">Evan</a></td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar  bg-primary" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%;">65%</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-success">LOW</span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="projects.html">Java Dalia</a></td>
                                                <td>17-03-2021</td>
                                                <td>8 Month</td>
                                                <td><img src="assets/images/xs/avatar6.jpg" alt="Avatar" class="avatar sm rounded-circle me-2"><a href="#">Connor</a></td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar  bg-primary" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100" style="width: 48%;">48%</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-secondary">MEDIUM</span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="projects.html">Fast Cad</a></td>
                                                <td>14-04-2021</td>
                                                <td>2 Month</td>
                                                <td><img src="assets/images/xs/avatar7.jpg" alt="Avatar" class="avatar sm rounded-circle me-2"><a href="#">Benjamin</a></td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar  bg-primary" role="progressbar" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100" style="width: 76%;">76%</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-secondary">MEDIUM</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div><!-- Row End -->
            </div>             
        </div>


<div class="modal fade" id="dis_sum_modal" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xl glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><b><i class="icofont-patient-file"></i> Uploaded Files</b></h5>
<button type="button" class="btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='dis_sum' width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>