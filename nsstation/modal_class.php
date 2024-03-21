<style>
.glowing-circle2 {
  box-shadow: 0px 0px 2000px #6e7fcb;
}
</style>


<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<div class="modal fade" id="return" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xl glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><b><i class="icofont-finger-print"></i> RETURN UNUSED MEDICINE AND SUPPLIES</b></h5>
<button type="button" class="btn-close btn-outline-danger" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='tabiframereturn' src='' width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->




<!-------------------------------------------- ADMINISTER MED/SUP ------------------------------------------->
<div class="modal fade" id="administer" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xl glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><b><i class="icofont-finger-print"></i> ADMINISTRATION OF MEDICINE AND SUPPLIES</b></h5>
<button type="button" class="btn-close btn-outline-danger" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='tabiframeadminister' src='' width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>
<!---------------------------------------- END ADMINISTER MED/SUP ------------------------------------------->


<!-------------------------------------------- CANCEL PENDING ------------------------------------------->
<div class="modal fade" id="cancelpending" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xl glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> DELETE PENDING REQUEST</h5>
<button type="button" class="btn-close btn-outline-danger" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='tabiframecancelpending' src='' width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>
<!---------------------------------------- CANCEL PENDING ------------------------------------------->

<!-------------------------------------------- CANCEL ADMINISTERED ------------------------------------------->
<div class="modal fade" id="canceladministered" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xl glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> CANCEL ADMINISTERED</h5>
<button type="button" class="btn-close btn-outline-danger" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='tabiframecanceladministered' src='' width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>
<!---------------------------------------- CANCEL ADMINISTERED ------------------------------------------->

<!-------------------------------------------- REQUEST FOR REFUND ------------------------------------------->
<div class="modal fade" id="requestforrefund" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xl glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> REQUEST FOR REFUND</h5>
<button type="button" class="btn-close btn-outline-danger" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='tabiframerequestforrefund' src='' width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>
<!---------------------------------------- REQUEST FOR REFUND ------------------------------------------->



<!-------------------------------------------- MGH ------------------------------------------->
<div class="modal fade" id="exampleModal" tabindex="-1">
<div class="modal-dialog modal-xs glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> SET MGH</h5>
<button type="button" class="btn-close btn-outline-danger" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">
<font color="black">Are you sure you want to set status as May Go Home?</font>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<a href="../nsstation/mgh.php?caseno=<?php echo $caseno ?><?php echo $datax ?>"><button type="submit" name="btnnewpatient" class="btn btn-danger">MGH</button></a>
</div>
</div>
</div>
</div>
<!-------------------------------------------- MGH ------------------------------------------->


<!-------------------------------------------- REVERT MGH ------------------------------------------->
<form method="POST">
<div class="modal fade" id="exampleModal2" tabindex="-1">
<div class="modal-dialog modal-xs glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> SET MGH</h5>
<button type="button" class="btn-close btn-outline-danger" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">
<font color="black">Are you sure you want to Revert May Go Home Status? <br>
<textarea name="reason" placeholder="Enter Reason for Cancel MGH..." class="form-control"></textarea><br>
Enter Password:</font>
<input type="password" name="pass" placeholder="Enter Password.." class="form-control">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" name="btnrev" class="btn btn-danger">REVERT MGH</button>
</div>
</div>
</div>
</div>
</form>
<!-------------------------------------------- REVERT MGH ------------------------------------------->




<!-------------------------------------------- DISCHARGED ------------------------------------------->
<div class="modal fade" id="exampleModaldis" tabindex="-1" data-bs-backdrop='static'>
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="icofont-warning"></i> Discharge Patient</h5>
</div>
<div class="modal-body">

<table align='center' width="100%"><tr><td><img src='../main/img/discharged.gif' style="width: 100%; height: 400px;"></td></tr></table>

<form name="f4" action="?dischargedpt" method="POST" onsubmit="return confirm('Do you wish to discharge this patient?');return false;"> 	
<input type="hidden" name="caseno" id="caseno" value="<?=$caseno;?>">
<input type="hidden" name="nursename" id="patientidno"  value="<?=$user;?>">
<div class="form-group">
<label><font color="black">Date Discharge</font></label>
<input type="date" name="datedischarged" class="form-control" value="<?php echo date('Y-m-d'); ?>" required >
</div>
<div class="form-group">
<label><font color="black">Time Discharge</font></label>
<input type="time" name="timedischarged" class="form-control" value="<?php echo date('H:i'); ?>" required>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-bs-dismiss="modal" style='background: #830d21; color: white;'><i class='icofont-close-circled'></i> Close</button>
<button type="submit" class="btn btn-primary" style='background: #0a3877; color: white;'><i class='icofont-check-circled'></i> Submit</button>
</div>
</form>

</div>
</div>
</div>
<!-------------------------------------------- DISCHARGED ------------------------------------------->



<!-------------------------------------------- MGH ------------------------------------------->
<div class="modal fade" id="exampleModalhmofinalize" tabindex="-1">
<div class="modal-dialog modal-xs glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> HMO FINALIZE</h5>
<button type="button" class="btn-close btn-outline-danger" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">
<font color="black">Are you sure you want to finalize this status? Finalizing will result in the permanent deletion of all pending requests.</font>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<a href="../nsstation/hmofinalize.php?caseno=<?php echo $caseno ?><?php echo $datax ?>"><button type="submit" name="btnnewpatient" class="btn btn-danger">Finalize</button></a>
</div>
</div>
</div>
</div>
<!-------------------------------------------- MGH ------------------------------------------->