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
$viewdis="";
$viewselrm="";
if(($status=="discharged")||($status=="TRANSFERRED")){
  $view="style='display:none;'";
  $viewdis="display:none;";
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
  if((stripos($caseno, "AR-") !== FALSE)){

  }
  else{
echo "
            <a href='../SOA17/StatementOfAccountRDUVer.php?caseno=$caseno&patientidno=$patientidno&uname=$name' target='_blank'>RDU PHILHEALTH SOA (RDU)</a>
";
  }
}
else{
echo "
            <!-- a href='../SOA17/StatementOfAccountPHICVer_ComPF.php?caseno=$caseno&patientidno=$patientidno&uname=$name' target='_blank'>SOA 1.0</a -->
            <a href='../SOA/?caseno=$caseno&user=$user&dept=$dept' target='_blank'>SOA 2.0</a>
            <a href='../SOA/index-test20230712.php?caseno=$caseno&user=$user&dept=$dept' target='_blank'>SOA 3.0 (Beta)</a>
";
}

echo "
            <a href='../Details/?caseno=$caseno&user=$user&dept=$dept' target='_blank'>DETAILS 2.0</a>
            <a href='../Itemized/?caseno=$caseno&user=$user&dept=$dept' target='_blank'>Itemized (Beta)</a>
            <a href='http://192.168.0.100:100/ERP/medmatrix/hospital_charges/$caseno/$name' target='_blank'>HOSPITAL CHARGES</a>
          </div>
        </div>
        <!-- div class='dropdowncs' $view $viewsel>
          <button class='dropbtn' style='font-family: arial;font-weight: bold;'>PAYMENTS <i class='demo-icon icon-down-dir'>&#xe82d</i></button>
          <div class='dropdowncs-content courier bold s20'>
            <a href='../BillMe/?caseno=$caseno&dept=BILLING&user=$user&postpay'>POST PAYMENT</span></a>
          </div>
        </div -->
        <div class='dropdowncs' $view $viewsel>
          <button class='dropbtn' style='font-family: arial;font-weight: bold;'>PROFESSIONAL FEE <i class='demo-icon icon-down-dir'>&#xe82d</i></button>
          <div class='dropdowncs-content courier bold s20'>
            <a href='../BillMe/?caseno=$caseno&dept=BILLING&user=$user&postpf'>PF POSTING</span></a>
            <!-- a href='http://".$_SERVER['HTTP_HOST']."/arv2022/billing/index.php?view=password&route=pfposting_other&caseno=$caseno&username=$name&userunique=$user&dept=BILLING&branch=KMSCI' target='_blank'>PF POSTING OTHERS</a -->
          </div>
        </div>
        <div class='dropdowncs' $view $viewsel>
          <button class='dropbtn' style='font-family: arial;font-weight: bold;'>AUTO FEATURES <i class='demo-icon icon-down-dir'>&#xe82d</i></button>
          <div class='dropdowncs-content courier bold s20'>
            <a href='?caseno=$caseno&dept=BILLING&user=$user&adistro'>AUTO DISTRIBUTE CHARGES</a>
            <a href='?caseno=$caseno&dept=BILLING&user=$user&appsn'";?> onclick="return confirm('APPLY SENIOR/PWD DISCOUNT?');" <?php echo ">APPLY SENIOR/PWD DISCOUNT</a>
            <a href='?caseno=$caseno&dept=BILLING&user=$user&rmsn'";?> onclick="return confirm('REMOVE SENIOR/PWD DISCOUNT?');" <?php echo ">REMOVE SENIOR/PWD DISCOUNT</a>
            <a href='?caseno=$caseno&dept=BILLING&user=$user&appex'";?> onclick="return confirm('APPLY EXCESS?');" <?php echo ">APPLY EXCESS</a>
            <!--a href='?caseno=$caseno&dept=BILLING&user=$user&applydiscount'>MANUAL DISCOUNT</a-->
            <a href='?caseno=$caseno&dept=BILLING&user=$user&applydiscountbeta'>MANUAL DISCOUNT BETA</a>
          </div>
        </div>
";
$cancel="style='display:none'";
if((stripos($caseno, "R-") !== FALSE)||(stripos($caseno, "WD-") !== FALSE)){
  if((stripos($caseno, "AR-") !== FALSE)){}
  else{
echo "
        <!-- a href='http://".$_SERVER['HTTP_HOST']."/cgi-bin/searchicdcodebilling1.cgi?caseno=$caseno' target='_blank' style='font-family: arial;font-weight: bold;'>SEARCH ICD</a -->
        <a"; ?> onclick="<?php echo "window.open('../CaseRates/?caseno=$caseno&user=".base64_encode($name)."&dept=$dept', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=300,width=1000,height=650');";?>" <?php echo " target='_blank' style='font-family: arial;font-weight: bold;cursor: pointer;'>SEARCH ICD</a>
";
    $cancel="";
  }
}

if($dept=="PHILHEALTH"){
echo "
        <div class='dropdowncs'>
          <button class='dropbtn' style='font-family: arial;font-weight: bold;'>PHILHEALTH <i class='demo-icon icon-down-dir'>&#xe82d</i></button>
          <div class='dropdowncs-content courier bold s20'>
            <a href=''"; ?> onclick="<?php echo "window.open('../CaseRates/?caseno=$caseno&user=".base64_encode($name)."', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=300,width=1000,height=650');";?>" <?php echo ">SEARCH ICD</a>
            <a href='http://".$_SERVER['HTTP_HOST']."/cgi-bin/medicaredataentry.cgi?patient=$patient' target='_blank'>DATA ENTRY</a>
            <a href='http://".$_SERVER['HTTP_HOST']."/cgi-bin/medicaredataedit.cgi?patient=$patient' target='_blank'>DATA EDIT</a>
            <a href='http://".$_SERVER['HTTP_HOST']."/CF2/cf2_front.php?caseno=$caseno&user=".base64_encode($name)."' target='_blank'>CF2 FRONT</a>
            <a href='http://".$_SERVER['HTTP_HOST']."/CF2/before_cf2_back.php?caseno=$caseno' target='_blank'>CF2 BACK</a>
            <a href='http://".$_SERVER['HTTP_HOST']."/CF2/ReloadCF2.php?caseno=$caseno' target='_blank'>RELOAD CF2 DATA</a>
            <a href='http://".$_SERVER['HTTP_HOST']."/2017codes/ClaimSignatureForm/ClaimSignatureForm.php?patientidno=$patientidno&caseno=$caseno' target='_blank'>CSF PHIC</a>
            <a href='http://".$_SERVER['HTTP_HOST']."/eClaims/CSF-Data-AddEdit.php?patientidno=$patientidno&caseno=$caseno&choosea=2&chooseb=2' target='_blank'>CSF ADDITIONAL ENTRY</a>
            <a href='http://".$_SERVER['HTTP_HOST']."/2017codes/eClaims/DataEntryeClaims.php?patientidno=$patientidno&caseno=$caseno&uname=$name' target='_blank'>IMPORT DATA TO ECLAIMS PORTAL</a>
          </div>
        </div>
";
}

if($result!="FINAL"){
echo "
        <a style='cursor: pointer;color: #FFFFFF;font-family: arial;font-weight: bold;$viewdis' "; ?> onclick="<?php echo "window.open('addroom.php?caseno=$caseno&xix=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=".((($setsh-300)/2)-50).",left=".(($setsw-580)/2).",width=580,height=300');";?>" <?php echo ">ADD ROOM</a>
";
}

if($result=="FINAL"){
echo "
        <a style='cursor: pointer;color: #FFFFFF;font-family: arial;font-weight: bold;$viewdis' href='?caseno=$caseno&dept=BILLING&user=$user&rmsf'>REMOVE SET FINAL</a>
";
}


if(stripos($caseno, "O-") !== FALSE){
  if($status=="MGH"){
echo "
        <a style='cursor: pointer;color: #FFFFFF;font-family: arial;font-weight: bold;$viewdis'"; ?> onclick="<?php echo "window.open('cancelmgh.php?caseno=$caseno', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=".((($setsh-450)/2)-50).",left=".(($setsw-500)/2).",width=500,height=450');";?>" <?php echo ">CANCEL MGH</a>
";
  }
}

echo "
          </div>
        </div>
";
?>
