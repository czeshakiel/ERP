<?php
include 'prop/connect/link.php';
ini_set('display_errors','on');
$slcttype = $_GET['type'];
if($slcttype == "charge"){ $type == "$slcttype"; } else{ $type = strtoupper($slcttype); }
$datef = $_GET['datefrom'];
$dateto = $_GET['dateto'];

$query = $conn->query("SELECT po.status,po.reqdate, po.approvingofficer,po.unitcost,po.supplier,po.reqdept,r.description,s.*,s.unitcost as amount,SUM(s.quantity) as quantity,r.code,r.unit,r.generic,s.dept 
FROM stocktable s INNER JOIN purchaseorder po ON po.reqno=s.isid AND po.code=s.code INNER JOIN receiving r ON r.code=s.code WHERE s.isid <> '' AND po.reqdate BETWEEN '$datef' AND '$dateto' AND po.reqdept = 'PHARMACY' AND s.suppliercode='CPU' AND po.status='received' AND po.approvingofficer='$type' 
GROUP BY s.code ORDER BY r.generic ASC");

?>
<!doctype html> 
<html class="no-js" lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>EXPENSE & CHARGE MEDS</title>
<link href="prop/img/logo/logo.png" rel="icon">
<link rel="stylesheet" href="prop/assets/plugin/datatables/responsive.dataTables.min.css">
<link rel="stylesheet" href="prop/assets/plugin/datatables/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="prop/assets/css/my-task.style.min.css">
</head>
<body>
<div id="mytask-layout" class="theme-indigo"> 
    <div class="main px-lg-4 px-md-4">
        <div class="maindisplay">
        <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="card mb-3">
                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h5><b><?php echo $type;?> MEDS</b></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header py-3  bg-transparent border-bottom-0">
                    <h6 class="mb-0 fw-bold ">LIST</h6> 
                </div>
                <div class="card-body">
                    <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="text-align:center">Code</th>
                                <th style="text-align:center">Description</th>
                                <th style="text-align:center">Supplier</th>
                                <th style="text-align:center">Status</th>
                                <th style="text-align:center">App. Offc</th>
                                <th style="text-align:center">Req. Dept</th>
                                <th style="text-align:center">Req. Date</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                while($row = $query->fetch_assoc()){
                                    $supplier = $row['supplier'];
                                    $status = $row['status'];
                                    $approvingofficer = $row['approvingofficer'];
                                    $description = $row['description'];
                                    $reqdept = $row['reqdept'];
                                    $reqdate = $row['reqdate'];
                                    $code = $row['code'];
                            ?>
                            <tr>
                                    <td style="text-align:center; width:10%;"><?=$code;?></td>
                                    <td style="text-align:center; width:20%; white-space:wrap; max-width:300px;"><?=$description;?></td>
                                    <td style="text-align:center; width:10%;"><?=$supplier;?></td>
                                    <td style="text-align:center; width:10%;"><?=$status;?></td>
                                    <td style="text-align:center; width:10%;"><?=$approvingofficer;?></td>
                                    <td style="text-align:center; width:10%;"><?=$reqdept;?></td>
                                    <td style="text-align:center; width:10%;"><?=$reqdate;?></td>
                                    <td style="text-align:center; width:10%;">
                                    <input type="hidden" id="datefrom" value="<?=$datef;?>">
                                    <input type="hidden" id="dateto" value="<?=$dateto;?>">
                                    <input type="hidden" id="slct_type" value="<?=$slcttype;?>">
                                    <button class="btn btn-danger" onclick="update_expense_meds('<?=$code;?>', '<?=$approvingofficer;?>', '<?=$reqdept;?>', '<?=$supplier;?>', '<?=$description;?>')"><i class="icofont-circle-up"></i> Update</button></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>  
</div>
</div>

<!-- modal start -->
    <div class="modal fade" id="confirmMergeModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content mdlcnt">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="icofont-question-circle"></i> Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p>Are you sure, you want to update this meds "<span id="itemdesc" class="bldtxt"></span>" (approvingofficer) from "<span id="approvingoff" class="bldtxt"></span>" to "<span class="bldtxt">charge</span>"?</p>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary canlbtn" data-bs-dismiss="modal"> Close</button>
                    <button type="button" class="btn btn-info confbtn" id="confirmedUpdate"> Proceed</button>
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
			    <p>Medicine has been updated successfully.</p>
			    <button type="button" class="btn confSBtn" style="text-align:center" id="confOkSuccess">Ok</button>
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
			    <button type="button" class="btn confEBtn" style="text-align:center" id="confOkFailed">Ok</button>
            </div>
        </div>
    </div>
<script src="prop/assets/bundles/libscripts.bundle.js"></script>
<script src="prop/assets/bundles/dataTables.bundle.js"></script>
<script>
    $(document).ready(function() {
       $('#patient-table')
       .addClass( 'nowrap' )
       .dataTable( {
           responsive: true,
           columnDefs: [
               { targets: [-1, -3], className: 'dt-body-right' }
           ]
       });
   });

   function update_expense_meds(code, approff, reqdept, supplier, desc){
        var datefrom = $("#datefrom").val();
        var dateto = $("#dateto").val();
        var slct_type = $("#slct_type").val();
        $("#itemdesc").text(desc);
        $("#approvingoff").text(approff);
        $("#confirmMergeModal").modal('show');
        $("#confirmedUpdate").on('click', function(){
            $.post('updatethismeds.php', {
                code:code, 
                approff:approff, 
                reqdept:reqdept, 
                supplier:supplier,
                datefrom:datefrom, 
                dateto:dateto,
                slct_type:slct_type
            }, function(data){
                console.log(data);
                if(data == "success"){
                    $("#confirmMergeModal").modal('hide');
                        $("#popupAlertSuccess").modal('show');
                        $("#confOkSuccess").on('click',function () {
                            $("#popupAlertSuccess").modal('show');
                            location.reload();
                    });
                }else{
                    $("#popupAlertFailed").modal('show');
                        $("#confOkFailed").on('click',function () {
                            $("#popupAlertFailed").modal('hide');
                            location.reload();
                    });
                }
            });
        });
   }
</script>
</body>
</html> 