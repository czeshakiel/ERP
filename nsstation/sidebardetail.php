
<?php
$result22cc = $conn->query("SELECT * from admission where caseno='$caseno'");
while($row22cc = $result22cc->fetch_assoc()) {
$statusbb = $row22cc['status'];
$wardbb = $row22cc['ward'];
$membership = $row22cc['membership'];
$datetime = $row22cc['dateadmit']." ".$row22cc['timeadmitted'];
$disposition = $row22cc['disposition'];
$hmomembership = $row22cc['hmomembership'];
}

$date1 = new DateTime($datetime);
$date2 = new DateTime();
$diff = $date2->diff($date1);
$hours = $diff->h;
$hours = $hours + ($diff->days*24);

if($dept=="OPD" OR $dept=="ADMISSION" OR $dept=="ER" OR $dept=="ONCOLOGY" OR $dept=="HMO"){$dist = "http://$ip/ERP/medmatrix/?dept=$dept";}
elseif($dept=="RDU" or strpos($dept, "RECORDS")!==false){$dist="?closetab";}
else{$dist = "?main";}
?>

<button class='hamburger' onclick='sbview();'><i class='icofont-navigation-menu'></i></button>
  <!-- sidebar -->
    <div class="sidebar px-4 py-4 py-md-5 me-0">
      <div class="d-flex flex-column h-100">



       <table>
	<tr>
	<td><img src="../main/img/logo/logo.png" width='40' height='40' style='border-radius: 50%;'></td>
	<td style="color: white;">MedMatrix<br><small style="font-size:11px;">eHealth Solutions, Inc.</small></td>
	</tr>
	</table><hr style="color: white;">
        <!-- Menu: main ul -->
        <ul class="menu-list flex-grow-1 mt-3">
          <li><a class="ms-link" href="<?php echo $dist ?>"><span><i class="icofont-ui-home"></i> Main Menu</span></a></li>
          <li><a class="ms-link" href="?detail&caseno=<?php echo $caseno ?>"><span><i class="icofont-man-in-glasses"></i> Patient Profile</span></a></li>

          <?php if($statusbb!="discharged"){ ?>
          <li><a class="ms-link" href="?printslip&caseno=<?php echo $caseno ?>"><span><i class="icofont-printer"></i> Print Slip</span></a></li>
          <li class="collapsed">
            <a class="ms-link"  data-bs-toggle="collapse" data-bs-target="#NursingServices" href="#">
              <span><i class="icofont-ui-settings"></i> Profile Settings</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="NursingServices">
              <!--li><a class="ms-link" href="?ap&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Attending Physician</span></a></li>
              <li><a class="ms-link" href="?senior&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Senior/ PWD</span></a></li>
              <li><a class="ms-link" href="?room&caseno=<?php echo $caseno ?>""><span><i class="icofont-caret-right"></i> Room</span></a></li-->
              <li><a class="ms-link" href="?editcaseno&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Hospital Caseno</span></a></li>
              <li><a class="ms-link" href="?dietlist&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Diet List</span></a></li>
            </ul>
          </li>
          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#tikit-Components" href="#">
              <span><i class="icofont-patient-file"></i> Cf4 Entry</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <ul class="sub-menu collapse" id="tikit-Components">
              <li><a class="ms-link" href="http://<?php echo $ip ?>/eClaims/CF4.php?caseno=<?php echo $caseno ?>" target="_blank"><span><i class="icofont-caret-right"></i> Print CF4</span></a></li>
              <li><a class="ms-link" href="?otherinfo&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Additional Info</span></a></li>
              <li><a class="ms-link" href="?part2&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Pertinent Sign & Symptoms on Admission</span></a></li>
              <li><a class="ms-link" href="?part3&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Pertinent Findings per System</span></a></li>
              <!--li><a class="ms-link" href="?courseward&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Course in the Ward</span></a></li-->
            </ul>
          </li>
<?php
if(stripos($caseno, "R-") !== FALSE){
echo "
          <li class='collapsed'>
            <a class='ms-link' data-bs-toggle='collapse' data-bs-target='#tikit-Components2' href='#'>
              <span><i class='icofont-patient-file'></i> PhilHealth Forms</span> <span class='arrow icofont-dotted-down ms-auto text-end fs-5'></span>
            </a>
            <ul class='sub-menu collapse' id='tikit-Components2'>
              <li><a class='ms-link' href='../extra/RDUCSF/?caseno=$caseno' target='_blank'><span><i class='icofont-caret-right'></i> CSF</span></a></li>
              <!-- li><a class='ms-link' href='' target='_blank'><span><i class='icofont-caret-right'></i> CF2</span></a></li -->
            </ul>
          </li>
";
}
?>
          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#client-Components" href="#">
              <span><i class="icofont-medicine"></i> Medical Details</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <ul class="sub-menu collapse" id="client-Components">
              <li><a class="ms-link" href="?finaldx&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Final Diagnosis</span></a></li>
              <li><a class="ms-link" href="?medicationsheet&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Medication Sheet</span></a></li>
              <li><a class="ms-link" href="?medicationsheetgroup&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Medication Sheet Group</span></a></li>
              <li><a class="ms-link" href="?labcharges&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Laboratory Charges</span></a></li>
              <li><a class="ms-link" href="../login/?dept=CSR2"><span><i class="icofont-caret-right"></i> Doctor's Note</span></a></li>
              <li><a class="ms-link" href="?nursesnote&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Nurses Note</span></a></li>
              <li><a class="ms-link" href="../printresult/mesheet/<?=$_SESSION['username'];?>/<?=$caseno ?>" target="_blank"><span><i class="icofont-caret-right"></i> ME Sheet</span></a></li>
            </ul>
          </li>
          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#emp-Components" href="#">
              <span><i class="icofont-medical-sign"></i> Other Services</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <ul class="sub-menu collapse" id="emp-Components">
              <li><a class="ms-link" href="?proceduresched&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Procedure Schedule</span></a></li>
              <!--li><a class="ms-link" href=../login/?dept=CSR2"><span><i class="icofont-caret-right"></i> Health Care Infection</span></a></li-->
              <li><a class="ms-link" href="?dischargedsummary&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Discharged Summary</span></a></li>
            </ul>
          </li>

          <li><a class="ms-link" href="?diagnosisresult&caseno=<?php echo $caseno ?>"><span><i class="icofont-flask"></i> Test Performed</span></a></li>



          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#emp-Components2" href="#">
              <span><i class="icofont-hand"></i> Administration & Return</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <ul class="sub-menu collapse" id="emp-Components2">

<li><a class="ms-link" href='http://<?php echo $ip ?>/ERP/nsstation/return.php?caseno=<?php echo $caseno ?>' target='tabiframereturn' onclick="document.getElementById('idreturn').click();">
<span><i class="icofont-caret-right"></i> Return Item(s)</span>
<button type="button" id="idreturn" data-bs-toggle="modal" data-bs-target="#return" hidden>My Button</button>
</a></li>

<li><a class="ms-link" href='http://<?php echo $ip ?>/ERP/nsstation/administer.php?caseno=<?php echo $caseno ?>' target='tabiframeadminister' onclick="document.getElementById('idadminister').click();">
<span><i class="icofont-caret-right"></i> Administer Item(s)</span>
<button type="button" id="idadminister" data-bs-toggle="modal" data-bs-target="#administer" hidden>My Button</button>
</a></li>

<!--li><a class="ms-link" href="http://<?php echo $ip ?>/aboy2020/pages/ns/?administer&caseno=<?php echo $caseno ?>&dept=<?php echo $dept ?>&username=<?php echo $user ?>&branch=<?php echo $branch ?>&userunique=<?php echo $userunique ?>&station10=<?php echo $dept ?>" target="_blank">Administer Item (old)</a></li-->

<li><a class="ms-link" href='http://<?php echo $ip ?>/ERP/nsstation/cancelpending.php?caseno=<?php echo $caseno ?>' target='tabiframecancelpending' onclick="document.getElementById('idcancelpending').click();">
<span><i class="icofont-caret-right"></i> Cancel Pending Request</span>
<button type="button" id="idcancelpending" data-bs-toggle="modal" data-bs-target="#cancelpending" hidden>My Button</button>
</a></li>


<li><a class="ms-link" href='http://<?php echo $ip ?>/2021codes/CancelAdm/?caseno=<?php echo $caseno ?>&dept=<?php echo $dept ?>' target='tabiframecanceladministered' onclick="document.getElementById('idcanceladministered').click();">
<span><i class="icofont-caret-right"></i> Cancel Administered</span>
<button type="button" id="idcanceladministered" data-bs-toggle="modal" data-bs-target="#canceladministered" hidden>My Button</button>
</a></li>

<?php if($dept=="VERIFIER"){ ?>
<li><a class="ms-link" href='http://<?php echo $ip ?>/ERP/nsstation/requestforrefund.php?caseno=<?php echo $caseno ?>' target='tabiframerequestforrefund' onclick="document.getElementById('idrequestforrefund').click();">
<span><i class="icofont-caret-right"></i> Request for Refund</span>
<button type="button" id="idrequestforrefund" data-bs-toggle="modal" data-bs-target="#requestforrefund" hidden>My Button</button>
</a></li>
<?php } ?>

<!--li><a class="ms-link" href=../login/?dept=CSR2"><span><i class="icofont-caret-right"></i> Administered Med Report</span></a></li>
<li><a class="ms-link" href=../login/?dept=CSR2"><span><i class="icofont-caret-right"></i> Pedia Monitoring</span></a></li-->
</ul>
</li>

<?php
if($dept=="VERIFIER" or $dept=="OPD" or $dept=="ONCOLOGY" or $dept=="ER"){
if(($hours>=24 and $membership=="phic-med") or $wardbb=="out" or $membership!=="phic-med" or $disposition=='HAMA' or $disposition=='DIED' or $disposition=='TRANSFERED'){

//  --------------- MGH or CANCEL MGH --------------------->
 if($statusbb == "MGH"){
echo"
<li><a class='ms-link' href='' data-bs-toggle='modal' data-bs-target='#exampleModal2'>
<font color='yellow'><b><i class='icofont-hand'></i><span> Cancel MGH</span></a></li></b></font>
";
}else{
echo"
<li><a class='ms-link' href='' data-bs-toggle='modal' data-bs-target='#exampleModal'>
<font color='yellow'><b><i class='icofont-hand'></i><span> Set (May Go Home)</span></a></li></b></font>
";
}
//-------------------------------------------------------->
}

else{
echo"<li><a class='ms-link'><font color='yellow'><b><i class='icofont-times'></i><span>Unable to MGH. $hours hr/s from admission</span></a></li></b></font>";
}
} ?>

<?php if($statusbb!="discharged"){ ?>
<li>&nbsp;</li>
<li style='text-align: center;'><button class="btn btn-danger" style="background: #ca207f; color: white; width: 100%;" href="" data-bs-toggle="modal" data-bs-target="#exampleModaldis"><i class="icofont-bed"></i><span> Discharge Patient</span></button></li>
<?php } ?>

<?php }else{echo"<li><a class='ms-link' href='?diagnosisresult&caseno=$caseno'><span><i class='icofont-flask'></i> Test Performed</span></a></li>";} ?>

<?php
if($dept=="HMO" and $hmomembership!='none'){
$gg = $conn->query("select * from arv_tbl_hmofinalize where caseno='$caseno'");
if(mysqli_num_rows($gg)>0){echo"<br><li><a class='ms-link'><font color='yellow'><b><i class='icofont-times'></i><span>HMO is already finalized!</span></a></li></b></font></li>";}else{
echo"<br>
    <li><a class='btn btn-danger btn-sm' href='' data-bs-toggle='modal' data-bs-target='#exampleModalhmofinalize' style='width: 100%;'>
    <font color='yellow'><b><i class='icofont-finger-print'></i><span> FINALIZE HMO</span></a></li></b></font>
    ";
}
}
?>


        </ul>
        <!-- Theme: Switch Theme -->
        <ul class="list-unstyled mb-0">
          <li class="d-flex align-items-center justify-content-center">
            <div class="form-check form-switch theme-switch">
              <input class="form-check-input" type="checkbox" id="theme-switch">
              <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
            </div>
          </li>

        </ul>

      </div>
    </div>
