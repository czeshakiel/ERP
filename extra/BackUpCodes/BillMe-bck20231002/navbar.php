<?php
if((isset($_SESSION['scw']))&&($_SESSION['sch'])){
  $setsw=$_SESSION['scw'];
  $setsh=$_SESSION['sch'];
}
else{
  $setsw=1600;
  $setsh=900;
}

$viewsel="";
$viewselrm="";
if($status=="discharged"){
  $view="style='display:none;'";
}
else{
  if($dept=="PHILHEALTH"){
    //$view="";
  }
  else{

  }

  if($result=="FINAL"){
    $viewsel="style='display:none;'";
    $viewselrm="display:none;";
  }
  $view="";

}

echo "
        <div class='dropdowncs'>
          <button class='dropbtn' style='font-family: arial;font-weight: bold;'>SOA <i class='demo-icon icon-down-dir'>&#xe82d</i></button>
          <div class='dropdowncs-content courier bold s20'>
";

if((stripos($caseno, "R-") !== FALSE)||(stripos($caseno, "WD-") !== FALSE)){
echo "
            <a href='../SOA17/StatementOfAccountRDUVer.php?caseno=$caseno&patientidno=$patientidno&uname=$name' target='_blank'>RDU PHILHEALTH SOA (RDU)</a>
";
}
else{
echo "
            <a href='../SOA17/StatementOfAccountPHICVer_ComPF.php?caseno=$caseno&patientidno=$patientidno&uname=$name' target='_blank'>SOA 1.0</a>

            <a href='../SOA/?caseno=$caseno&user=$user&dept=$dept' target='_blank'>SOA 2.0</a>
";
}

echo "
            <a href='../Details/?caseno=$caseno&user=$user&dept=$dept' target='_blank'>DETAILS 2.0</a>
          </div>
        </div>
        <div class='dropdowncs' $view $viewsel>
          <button class='dropbtn' style='font-family: arial;font-weight: bold;'>PAYMENTS <i class='demo-icon icon-down-dir'>&#xe82d</i></button>
          <div class='dropdowncs-content courier bold s20'>
            <a href='../../aboy2020/pages/billing/?pfallocationhmo&caseno=$caseno&patientidno=$patientidno&dept=BILLING&branch=&nursename=$name&userunique=$user&noback' target='_blank'>POST PAYMENT</a>
            <!--a href='http://$setip/cgi-bin/refund.cgi?caseno=$caseno&nursename=$name' target='_blank'>REFUND</a-->
          </div>
        </div>
        <div class='dropdowncs' $view $viewsel>
          <button class='dropbtn' style='font-family: arial;font-weight: bold;'>PROFESSIONAL FEE <i class='demo-icon icon-down-dir'>&#xe82d</i></button>
          <div class='dropdowncs-content courier bold s20'>
            <!--a href='http://$setip/cgi-bin/wah/billingdocmanual.cgi?caseno=$caseno&nursename=$name&userunique=$user&dept=BILLING' target='_blank'>PF POSTING</a-->
			<a href='http://$setip/arv2022/billing/index.php?view=password&route=pfposting&caseno=$caseno&username=$name&userunique=$user&dept=BILLING&branch=KMSCI' target='_blank'>PF POSTING</a>
            <a href='http://$setip/arv2022/billing/index.php?view=password&route=pfposting_other&caseno=$caseno&username=$name&userunique=$user&dept=BILLING&branch=KMSCI' target='_blank'>PF POSTING OTHERS</a>
          </div>
        </div>
        <div class='dropdowncs' $view $viewsel>
          <button class='dropbtn' style='font-family: arial;font-weight: bold;'>AUTO FEATURES <i class='demo-icon icon-down-dir'>&#xe82d</i></button>
          <div class='dropdowncs-content courier bold s20'>
            <a href='../AutoDistri/?caseno=$caseno&dept=BILLING' target='_blank'>AUTO DISTRIBUTE CHARGES</a>
            <a href='../AutoDistro/applysenior.php?caseno=$caseno&dept=BILLING' target='_blank' ";?> onclick="return confirm('APPLY SENIOR DISCOUNT?');" <?php echo ">APPLY SENIOR DISCOUNT</a>
            <a href='../AutoDistro/removesenior.php?caseno=$caseno&dept=BILLING' target='_blank' ";?> onclick="return confirm('REMOVE SENIOR DISCOUNT?');" <?php echo ">REMOVE SENIOR DISCOUNT</a>
            <a href='../AutoDistro/allexcesssa.php?caseno=$caseno' target='_blank' ";?> onclick="return confirm('APPLY EXCESS?');" <?php echo ">APPLY EXCESS</a>
            <a href='' data-bs-toggle='modal' data-bs-target='#exampleModalFullscreen'>MANUAL DISCOUNT</a>
          </div>
        </div>
";
$cancel="style='display:none'";
if((stripos($caseno, "R-") !== FALSE)||(stripos($caseno, "WD-") !== FALSE)){
echo "
        <!-- a href='http://$setip/cgi-bin/searchicdcodebilling1.cgi?caseno=$caseno' target='_blank' style='font-family: arial;font-weight: bold;'>SEARCH ICD</a -->
        <a"; ?> onclick="<?php echo "window.open('../CaseRates/?caseno=$caseno&user=".base64_encode($name)."&dept=$dept', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=300,width=1000,height=650');";?>" <?php echo " target='_blank' style='font-family: arial;font-weight: bold;cursor: pointer;'>SEARCH ICD</a>
";
$cancel="";
}

if($dept=="PHILHEALTH"){
echo "
        <div class='dropdowncs'>
          <button class='dropbtn' style='font-family: arial;font-weight: bold;'>PHILHEALTH <i class='demo-icon icon-down-dir'>&#xe82d</i></button>
          <div class='dropdowncs-content courier bold s20'>
            <a href=''"; ?> onclick="<?php echo "window.open('../CaseRates/?caseno=$caseno&user=".base64_encode($name)."', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=300,width=1000,height=650');";?>" <?php echo ">SEARCH ICD</a>
            <a href='http://$setip/cgi-bin/medicaredataentry.cgi?patient=$patient' target='_blank'>DATA ENTRY</a>
            <a href='http://$setip/cgi-bin/medicaredataedit.cgi?patient=$patient' target='_blank'>DATA EDIT</a>
            <a href='http://$setip/CF2/cf2_front.php?caseno=$caseno&user=".base64_encode($name)."' target='_blank'>CF2 FRONT</a>
            <a href='http://$setip/CF2/before_cf2_back.php?caseno=$caseno' target='_blank'>CF2 BACK</a>
            <a href='http://$setip/CF2/ReloadCF2.php?caseno=$caseno' target='_blank'>RELOAD CF2 DATA</a>
            <a href='http://$setip/2017codes/ClaimSignatureForm/ClaimSignatureForm.php?patientidno=$patientidno&caseno=$caseno' target='_blank'>CSF PHIC</a>
            <a href='http://$setip/eClaims/CSF-Data-AddEdit.php?patientidno=$patientidno&caseno=$caseno&choosea=2&chooseb=2' target='_blank'>CSF ADDITIONAL ENTRY</a>
            <a href='http://$setip/2017codes/eClaims/DataEntryeClaims.php?patientidno=$patientidno&caseno=$caseno&uname=$name' target='_blank'>IMPORT DATA TO ECLAIMS PORTAL</a>
          </div>
        </div>
";
}

echo "
        <!--div class='dropdowncs' $view>
          <button class='dropbtn' style='font-family: arial;font-weight: bold;'>DISCHARGED <i class='demo-icon icon-down-dir'>&#xe82d</i></button>
          <div class='dropdowncs-content courier bold s20'>
            <a href='http://$setip/cgi-bin/billdischargeview.cgi?caseno=$caseno&nursename=$name' target='_blank' $view>DISCHARGED</a>
            <a href='http://$setip/cgi-bin/billdischargeview1.cgi?caseno=$caseno' target='_blank'>ACTIVATE</a>
          </div>
        </div-->
        <a href='../../aboy2020/pages/billing/?manageroom&caseno=$caseno&patientidno=$patientidno' $view target='_blank' style='font-family: arial;font-weight: bold;$viewselrm'>ADD ROOM</a>
        <div class='dropdowncs' $view>
          <button class='dropbtn' style='font-family: arial;font-weight: bold;'>OTHERS <i class='demo-icon icon-down-dir'>&#xe82d</i></button>
          <div class='dropdowncs-content courier bold s20'>
            <a href='http://$setip/cgi-bin/editpxad.cgi?patient=$patient' target='_blank' $viewsel>EDIT PROFILE</a>
            <a href='http://$setip/cgi-bin/remarksP.cgi?caseno=$caseno' target='_blank' $viewsel>REMARKS</a>
            <!--a href='http://$setip/cgi-bin/applycharge.cgi?caseno=$caseno' target='_blank'>UPGRADE TO INPATIENT</a-->
            <a href='http://$setip/cgi-bin/canceladmission.cgi?caseno=$caseno&userunique=$user' target='_blank' $cancel>CANCEL ADMISSION</a>
            <a href='http://$setip/2011codes/yellowtag.php?caseno=$caseno&dept=BILLING&nursename=$name&userunique=$user' $viewsel>LOCKED CHARGES</a>
            <!--a href='http://$setip/2011codes/mgh.php?caseno=$caseno&dept=BILLING&nursename=$name&branch=KMSCI' target='_blank'>MAY GO HOME</a-->
            <a href='http://$setip/2021codes/BillMe/undosetfinal.php?caseno=$caseno&dept=BILLING&nursename=$name&branch=KMSCI'>REMOVE SET FINAL</a>
";

if(stripos($caseno, "O-") !== FALSE){
  if($status=="MGH"){
echo "
            <span  "; ?> onclick="<?php echo "window.open('cancelmgh.php?caseno=$caseno', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=".((($setsh-450)/2)-50).",left=".(($setsw-500)/2).",width=500,height=450');";?>" <?php echo ">CANCEL MGH</span>
";
  }
}

echo "
          </div>
        </div>
";
?>
