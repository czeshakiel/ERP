<?php
if(isset($_POST['savedata'])){
//-------------------------------------------------------------------------------------------------
  $identificationno=mysqli_real_escape_string($conn,$_POST['identificationno']);

  $paymentmode=mysqli_real_escape_string($conn,$_POST['paymentmode']);
  $memberlastname=mysqli_real_escape_string($conn,$_POST['memberlastname']);
  $memberfirstname=mysqli_real_escape_string($conn,$_POST['memberfirstname']);
  $membermiddlename=mysqli_real_escape_string($conn,$_POST['membermiddlename']);
  $membersuffix=mysqli_real_escape_string($conn,$_POST['membersuffix']);

  $memberbdaym=mysqli_real_escape_string($conn,$_POST['memberbdaym']);
  $memberbdayd=mysqli_real_escape_string($conn,$_POST['memberbdayd']);
  $memberbdayy=mysqli_real_escape_string($conn,$_POST['memberbdayy']);

  $memberbday=$memberbdaym."-".$memberbdayd."-".$memberbdayy;

  $membergender=mysqli_real_escape_string($conn,$_POST['membergender']);
  $rtm=mysqli_real_escape_string($conn,$_POST['rtm']);
  $comchoose=mysqli_real_escape_string($conn,$_POST['comchoose']);
  $comname=mysqli_real_escape_string($conn,$_POST['comname']);
  $comcontact=mysqli_real_escape_string($conn,$_POST['comcontact']);

  $comdatesignedm=mysqli_real_escape_string($conn,$_POST['comdatesignedm']);
  $comdatesignedd=mysqli_real_escape_string($conn,$_POST['comdatesignedd']);
  $comdatesignedy=mysqli_real_escape_string($conn,$_POST['comdatesignedy']);

  $comdatesigned=$comdatesignedm."-".$comdatesignedd."-".$comdatesignedy;

  $comrelation=mysqli_real_escape_string($conn,$_POST['comrela']);
  $comrelationos=mysqli_real_escape_string($conn,$_POST['comrelationos']);
  $comreason=mysqli_real_escape_string($conn,$_POST['comreason']);
  $comreasonos=mysqli_real_escape_string($conn,$_POST['comreasonos']);
  $comuw=mysqli_real_escape_string($conn,$_POST['comuw']);
  $emppen=mysqli_real_escape_string($conn,$_POST['emppen']);
  $empbusinessname=mysqli_real_escape_string($conn,$_POST['empbusinessname']);
  $empname=mysqli_real_escape_string($conn,$_POST['empname']);
  $empcontactno=mysqli_real_escape_string($conn,$_POST['empcontactno']);
  $empsigdesignation=mysqli_real_escape_string($conn,$_POST['empsigdesignation']);

  $empdatesignedm=mysqli_real_escape_string($conn,$_POST['empdatesignedm']);
  $empdatesignedd=mysqli_real_escape_string($conn,$_POST['empdatesignedd']);
  $empdatesignedy=mysqli_real_escape_string($conn,$_POST['empdatesignedy']);

  $empdatesigned=$empdatesignedm."-".$empdatesignedd."-".$empdatesignedy;

  $carchoose=mysqli_real_escape_string($conn,$_POST['carchoose']);
  $carname=mysqli_real_escape_string($conn,$_POST['carname']);

  $cardatesignedm=mysqli_real_escape_string($conn,$_POST['cardatesignedm']);
  $cardatesignedd=mysqli_real_escape_string($conn,$_POST['cardatesignedd']);
  $cardatesignedy=mysqli_real_escape_string($conn,$_POST['cardatesignedy']);

  $cardatesigned=$cardatesignedm."-".$cardatesignedd."-".$cardatesignedy;

  $carrelation=mysqli_real_escape_string($conn,$_POST['carrelation']);
  $carrelationos=mysqli_real_escape_string($conn,$_POST['carrelationos']);
  $carreason=mysqli_real_escape_string($conn,$_POST['carreason']);
  $carreasonos=mysqli_real_escape_string($conn,$_POST['carreasonos']);
  $caruw=mysqli_real_escape_string($conn,$_POST['caruw']);
  $hcirep=mysqli_real_escape_string($conn,$_POST['hcirep']);
  $hcidesignation=mysqli_real_escape_string($conn,$_POST['hcidesignation']);
  $hcidatesignedm=mysqli_real_escape_string($conn,$_POST['hcidatesignedm']);
  $hcidatesignedd=mysqli_real_escape_string($conn,$_POST['hcidatesignedd']);
  $hcidatesignedy=mysqli_real_escape_string($conn,$_POST['hcidatesignedy']);

  $hcidatesigned=$hcidatesignedm."-".$hcidatesignedd."-".$hcidatesignedy;

  $patientidno=mysqli_real_escape_string($conn,$_POST['patientidno']);
  $caseno=mysqli_real_escape_string($conn,$_POST['caseno']);

  $cfmicount=mysqli_real_escape_string($conn,$_POST['cfmicount']);

  if($cfmicount!=0){
    mysqli_query($conn,"SET NAMES 'utf8'");
    //echo "UPDATE claiminfomoreinfo SET membersuffix='$membersuffix', memberbday='$memberbday', membergender='$membergender', rtm='$rtm', comchoose='$comchoose', comname='$comname', comcontact='$comcontact', comdatesigned='$comdatesigned', comrelation='$comrelation', comrelationos='$comrelationos', comreason='$comreason', comreasonos='$comreasonos', comuw='$comuw', emppen='$emppen', empbusinessname='$empbusinessname', empname='$empname', empcontactno='$empcontactno', empsigdesignation='$empsigdesignation', empdatesigned='$empdatesigned', carchoose='$carchoose', carname='$carname', cardatesigned='$cardatesigned', carrelation='$carrelation', carrelationos='$carrelationos', carreason='$carreason', carreasonos='$carreasonos', caruw='$caruw', hcirep='$hcirep', hcidesignation='$hcidesignation', hcidatesigned='$hcidatesigned' WHERE caseno='$caseno'<br />";
    mysqli_query($conn,"UPDATE `claiminfomoreinfo` SET `membersuffix`='$membersuffix', `memberbday`='$memberbday', `membergender`='$membergender', `rtm`='$rtm', `comchoose`='$comchoose', `comname`='$comname', `comcontact`='$comcontact', `comdatesigned`='$comdatesigned', `comrelation`='$comrelation', `comrelationos`='$comrelationos', `comreason`='$comreason', `comreasonos`='$comreasonos', `comuw`='$comuw', `emppen`='$emppen', `empbusinessname`='$empbusinessname', `empname`='$empname', `empcontactno`='$empcontactno', `empsigdesignation`='$empsigdesignation', `empdatesigned`='$empdatesigned', `carchoose`='$carchoose', `carname`='$carname', `cardatesigned`='$cardatesigned', `carrelation`='$carrelation', `carrelationos`='$carrelationos', `carreason`='$carreason', `carreasonos`='$carreasonos', `caruw`='$caruw', `hcirep`='$hcirep', `hcidesignation`='$hcidesignation', `hcidatesigned`='$hcidatesigned' WHERE `caseno`='$caseno'");
  }
  else{
    mysqli_query($conn,"SET NAMES 'utf8'");
    //echo "INSERT INTO `claiminfomoreinfo` (`caseno`, `membersuffix`, `memberbday`, `membergender`, `rtm`, `comchoose`, `comname`, `comcontact`, `comdatesigned`, `comrelation`, `comrelationos`, `comreason`, `comreasonos`, `comuw`, `emppen`, `empbusinessname`, `empname`, `empcontactno`, `empsigdesignation`, `empdatesigned`, `carchoose`, `carname`, `cardatesigned`, `carrelation`, `carrelationos`, `carreason`, `carreasonos`, `caruw`, `hcirep`, `hcidesignation`, `hcidatesigned`) VALUES ('$caseno', '$membersuffix', '$memberbday', '$membergender', '$rtm', '$comchoose', '$comname', '$comcontact', '$comdatesigned', '$comrelation', '$comrelationos', '$comreason', '$comreasonos', '$comuw', '$emppen', '$empbusinessname', '$empname', '$empcontactno', '$empsigdesignation', '$empdatesigned', '$carchoose', '$carname', '$cardatesigned', '$carrelation', '$carrelationos', '$carreason', '$carreasonos', '$caruw', '$hcirep', '$hcidesignation', '$hcidatesigned')<br />";
    mysqli_query($conn,"INSERT INTO `claiminfomoreinfo` (`caseno`, `membersuffix`, `memberbday`, `membergender`, `rtm`, `comchoose`, `comname`, `comcontact`, `comdatesigned`, `comrelation`, `comrelationos`, `comreason`, `comreasonos`, `comuw`, `emppen`, `empbusinessname`, `empname`, `empcontactno`, `empsigdesignation`, `empdatesigned`, `carchoose`, `carname`, `cardatesigned`, `carrelation`, `carrelationos`, `carreason`, `carreasonos`, `caruw`, `hcirep`, `hcidesignation`, `hcidatesigned`) VALUES ('$caseno', '$membersuffix', '$memberbday', '$membergender', '$rtm', '$comchoose', '$comname', '$comcontact', '$comdatesigned', '$comrelation', '$comrelationos', '$comreason', '$comreasonos', '$comuw', '$emppen', '$empbusinessname', '$empname', '$empcontactno', '$empsigdesignation', '$empdatesigned', '$carchoose', '$carname', '$cardatesigned', '$carrelation', '$carrelationos', '$carreason', '$carreasonos', '$caruw', '$hcirep', '$hcidesignation', '$hcidatesigned')");
  }

  $cisql=mysqli_query($conn,"SELECT * FROM `claiminfo` WHERE `caseno`='$caseno'");
  $cicount=mysqli_num_rows($cisql);

  if(($cicount!=0)&&($paymentmode!='Member')){
    mysqli_query($conn,"SET NAMES 'utf8'");
    //echo "UPDATE claiminfo SET lastname='$memberlastname', firstname='$memberfirstname', middlename='$membermiddlename', identificationno='$identificationno' WHERE caseno='$caseno'<br />";
    mysqli_query($conn,"UPDATE `claiminfo` SET `lastname`='$memberlastname', `firstname`='$memberfirstname', `middlename`='$membermiddlename', `identificationno`='$identificationno' WHERE `caseno`='$caseno'");
  }

  if($cicount!=0){
    mysqli_query($conn,"SET NAMES 'utf8'");
    //echo "UPDATE claiminfo SET identificationno='$identificationno' WHERE caseno='$caseno'<br />";
    mysqli_query($conn,"UPDATE `claiminfo` SET `identificationno`='$identificationno' WHERE `caseno`='$caseno'");
  }

echo "
  <table border='0' width='500' cellpadding='0' cellspacing='0'>
    <tr>
      <td height='100' valign='middle'><div align='center' style='faont-family: arial;font-size: 16px;font-weight: bold;color: green;'>Data saved successfully...</div></td>
    </tr>
  </table>
";

  echo "<META HTTP-EQUIV='Refresh'CONTENT='2;URL=../philhealth/?csfada&caseno=$caseno'>";
//-------------------------------------------------------------------------------------------------
}
else{
  mysqli_query($conn,"SET NAMES 'utf8'");
  $cisql=mysqli_query($conn,"SELECT `lastname`, `firstname`, `middlename`, `identificationno` FROM `claiminfo` WHERE `caseno`='$caseno'");
  $cicount=mysqli_num_rows($cisql);
  if($cicount==0){
    $climlname="";
    $climfname="";
    $climmname="";
    $clipin="";
    $cistat="off";
  }
  else{
    $cifetch=mysqli_fetch_array($cisql);
    $climlname=$cifetch['lastname'];
    $climfname=$cifetch['firstname'];
    $climmname=$cifetch['middlename'];
    $clipin=$cifetch['identificationno'];
    $cistat="on";
  }

  $cfmisql=mysqli_query($conn,"SELECT * FROM `claiminfomoreinfo` WHERE `caseno`='$caseno'");
  $cfmicount=mysqli_num_rows($cfmisql);
  if($cfmicount==0){
    $membersuffix="";
    $memberbday="";
    $membergender="";
    $rtm="";
    $comchoose="";
    $comname="";
    $comcontact="";
    $comdatesigned="--";
    $comrelation="";
    $comrelationos="";
    $comreason="";
    $comreasonos="";
    $comuw="";
    $emppen="";
    $empbusinessname="";
    $empname="";
    $empcontactno="";
    $empsigdesignation="";
    $empdatesigned="";
    $carchoose="";
    $carname="";
    $cardatesigned="--";
    $carrelation="";
    $carrelationos="";
    $carreason="";
    $carreasonos="";
    $caruw="";
    $hcirep="";
    $hcidesignation="";
    $hcidatesigned="";
  }
  else{
    $cfmifetch=mysqli_fetch_array($cfmisql);
    $membersuffix=$cfmifetch['membersuffix'];
    $memberbday=$cfmifetch['memberbday'];
    $membergender=$cfmifetch['membergender'];
    $rtm=$cfmifetch['rtm'];
    $comchoose=$cfmifetch['comchoose'];
    $comname=$cfmifetch['comname'];
    $comcontact=$cfmifetch['comcontact'];
    $comdatesigned=$cfmifetch['comdatesigned'];
    $comrelation=$cfmifetch['comrelation'];
    $comrelationos=$cfmifetch['comrelationos'];
    $comreason=$cfmifetch['comreason'];
    $comreasonos=$cfmifetch['comreasonos'];
    $comuw=$cfmifetch['comuw'];
    $emppen=$cfmifetch['emppen'];
    $empbusinessname=$cfmifetch['empbusinessname'];
    $empname=$cfmifetch['empname'];
    $empcontactno=$cfmifetch['empcontactno'];
    $empsigdesignation=$cfmifetch['empsigdesignation'];
    $empdatesigned=$cfmifetch['empdatesigned'];
    $carchoose=$cfmifetch['carchoose'];
    $carname=$cfmifetch['carname'];
    $cardatesigned=$cfmifetch['cardatesigned'];
    $carrelation=$cfmifetch['carrelation'];
    $carrelationos=$cfmifetch['carrelationos'];
    $carreason=$cfmifetch['carreason'];
    $carreasonos=$cfmifetch['carreasonos'];
    $caruw=$cfmifetch['caruw'];
    $hcirep=$cfmifetch['hcirep'];
    $hcidesignation=$cfmifetch['hcidesignation'];
    $hcidatesigned=$cfmifetch['hcidatesigned'];
  }

echo "
                    <table bordercolor='#000000' border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <form method='post'>
                        <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td height='30' width='auto'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Patient Name</div></td>
                            <td height='30' width='10'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30' width='auto'><div align='left'><input type='text' name='name' value='$patientname' style='width: 300px;' /></div></td>
                          </tr>
                          <tr>
                            <td colspan='3' height='40'><div align='left' style='font-face: arial;font-weight: bold;font-size: 13px;padding: 0 3px;color: blue;'>PART I - MEMBER AND PATIENT INFORMATION AND CERTIFICATION</div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Member PIN</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='identificationno' type='text' value='$clipin' /></div></td>
                          </tr>
          ";

  if($paymentmode=='Member'){
echo "
                          <input type='hidden' name='paymentmode' value='$paymentmode' />
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Member Last Name</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='memberlastname' type='text' value='$lname' /></div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Member First Name</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='memberfirstname' type='text' value='$fname' /></div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Member Middle Name</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='membermiddlename' type='text' value='$mname' /></div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Member Suffix</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='membersuffix' type='text' value='$suffix' /></div></td>
                          </tr>
";
  }
  else{
echo "
                          <input type='hidden' name='paymentmode' value='$paymentmode' />
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Member Laast Name</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='memberlastname' type='text' value='$climlname' /></div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Member First Name</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='memberfirstname' type='text' value='$climfname' /></div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Member Middle Name</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='membermiddlename' type='text' value='$climmname' /></div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Member Suffix</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='membersuffix' type='text' value='$membersuffix' /></div></td>
                          </tr>
";
  }

  $pmonth=date("M");
  $pday=date("d");
  $pyear=date("Y");

  if($memberbday!=""){
    $memberbdaysplit=preg_split('/\-/',$memberbday);
    $mm=$memberbdaysplit[0];
    $md=$memberbdaysplit[1];
    $my=$memberbdaysplit[2];

    $mbm="<option selected='selected'>$mm</option>";
    $mbd="<option selected='selected'>$md</option>";
    $mby="<option selected='selected'>$my</option>";
  }
  else{
    $my="";

    $mbm="";
    $mbd="";
    $mby="";
  }

echo "
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Member Birthday</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'>
                              &nbsp;<select name='memberbdaym'>
                                $mbm
                                <option>Jan</option>
                                <option>Feb</option>
                                <option>Mar</option>
                                <option>Apr</option>
                                <option>May</option>
                                <option>Jun</option>
                                <option>Jul</option>
                                <option>Aug</option>
                                <option>Sep</option>
                                <option>Oct</option>
                                <option>Nov</option>
                                <option>Dec</option>
                              </select>
                              <select name='memberbdayd'>
                                $mbd
";

  for($a=1;$a<=31;$a++){
    if($a<10){$b="0".$a;}else{$b=$a;}

echo "
                                <option>$b</option>
";
  }

echo "
                              </select>
                              <select name='memberbdayy'>
                                $mbd
";

  for($c=1900;$c<=($pyear+10);$c++){
    if($my==$c){
      $sy="selected='selected'";
    }
    else{
      if(($pyear==$c)&&($my=='')){$sy="selected='selected'";}else{$sy="";}
    }

echo "
                                <option $sy>$c</option>
";
}

echo "
                              </select>
                            </div></td>
                          </tr>
";

  if(($membergender=="M")||($membergender=="m")){$smg1="selected='selected'";$smg2="";}else if(($membergender=="F")||($membergender=="f")){$smg1="";$smg2="selected='selected'";}else{$smg1="";$smg2="";}

echo "
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Member Gender</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'>
                              &nbsp;<select name='membergender'>
                                <option value='M' $smg1>Male</option>
                                <option value='F' $smg2>Female</option>
                              </select>&nbsp;
                            </div></td>
                          </tr>
";

  if($rtm=='Child'){$rtms1="";$rtms2="checked='checked'";$rtms3="";$rtms4="";}
  else if($rtm=='Parent'){$rtms1="";$rtms2="";$rtms3="checked='checked'";$rtms4="";}
  else if($rtm=='Spouse'){$rtms1="";$rtms2="";$rtms3="";$rtms4="checked='checked'";}
  else{$rtms1="";$rtms2="";$rtms3="";$rtms4="";}

echo "
                          <tr>
                            <td colspan='3' height='40'><div align='left' style='font-face: arial;font-weight: bold;font-size: 13px;padding: 0 3px;color: blue;'>6. RELATIONSHIP TO MEMBER:</div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left'><span style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Relationship to Member</span><br /><span class='arial09blackbold'>&nbsp;(Select Member if Member is also the Patient)</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left' class='arial10blackbold'>
                              &nbsp;<input name='rtm' type='hidden' value='' /><input name='rtm' type='radio' title='Member' value='' $rtms1 />Member
                              &nbsp;<input name='rtm' type='radio' title='Child' value='Child' $rtms2 />Child
                              &nbsp;<input name='rtm' type='radio' title='Parent' value='Parent' $rtms3 />Parent
                              &nbsp;<input name='rtm' type='radio' title='Spouse' value='Spouse' $rtms4 />Spouse&nbsp;
                            </div></td>
                          </tr>
";

  if($comchoose=="M"){
    $chs1="selected='selected'";
    $chs2="";
  }
  else if($comchoose=="R"){
    $chs1="";
    $chs2="selected='selected'";
  }
  else{
    $chs1="";
    $chs2="";
  }

echo "
                          <tr>
                            <td colspan='3' height='40'><div align='left' style='font-face: arial;font-weight: bold;font-size: 13px;padding: 0 3px;color: blue;'>9. CERTIFICATION OF MEMBER:</div></td>
                          </tr>

                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Is the Signatory the Member or Representative?</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'>
                              &nbsp;<select name='comchoose'>
                                <option $chs1 value='M'>Member</option>
                                <option $chs2 value='R'>Representative</option>
                              </select>
                            </div></td>
                          </tr>

                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Signatory Name<br />&nbsp;(Leave this blank or disregard this if the signatory here is the Member/Patient)</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='comname' type='text' value='$comname' /></div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Contact No. Of Signatory</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='comcontact' type='text' value='$comcontact' /></div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Date Signed</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'>
";

  if($comdatesigned==""){
echo "
                              &nbsp;<select name='comdatesignedm'>
                                <option></option>
                                <option selected='selected'>$pmonth</option>
                                <option>Jan</option>
                                <option>Feb</option>
                                <option>Mar</option>
                                <option>Apr</option>
                                <option>May</option>
                                <option>Jun</option>
                                <option>Jul</option>
                                <option>Aug</option>
                                <option>Sep</option>
                                <option>Oct</option>
                                <option>Nov</option>
                                <option>Dec</option>
                              </select>
                              <select name='comdatesignedd'>
                                <option></option>
";

    for($z=1;$z<=31;$z++){
      if($z<10){$y="0".$z;}else{$y=$z;}
      if($y==$pday){$yds="selected='selected'";}else{$yds="";}

echo "
                                <option $yds>$y</option>
";
    }

echo "
                              </select>
                              <select name='comdatesignedy'>
                                <option></option>
";

      for($x=2016;$x<=($pyear+5);$x++){
        if($x==$pyear){$ydy="selected='selected'";}else{$ydy="";}

echo "
                                <option $ydy>$x</option>
";
      }

echo "
                              </select>&nbsp;
";
  }
  else{
    $cds=preg_split('/\-/',$comdatesigned);
    $cdsm=$cds[0];
    $cdsd=$cds[1];
    $cdsy=$cds[2];

echo "
                              &nbsp;<select name='comdatesignedm'>
                                <option></option>
                                <option selected='selected'>$cdsm</option>
                                <option>Jan</option>
                                <option>Feb</option>
                                <option>Mar</option>
                                <option>Apr</option>
                                <option>May</option>
                                <option>Jun</option>
                                <option>Jul</option>
                                <option>Aug</option>
                                <option>Sep</option>
                                <option>Oct</option>
                                <option>Nov</option>
                                <option>Dec</option>
                              </select>
                              <select name='comdatesignedd'>
                                <option></option>
";

    for($z=1;$z<=31;$z++){
      if($z<10){$y="0".$z;}else{$y=$z;}
      if($y==$cdsd){$yds="selected='selected'";}else{$yds="";}

echo "
                                <option $yds>$y</option>
";
    }

echo "
                              </select>
                              <select name='comdatesignedy'>
                                <option></option>
";

    for($x=2016;$x<=($pyear+5);$x++){
      if($x==$cdsy){$ydy="selected='selected'";}else{$ydy="";}

echo "
                                <option $ydy>$x</option>
";
    }

echo "
                              </select>&nbsp;
";
  }

echo "
                            </div></td>
                          </tr>
";

  if($comrelation=='Spouse'){$comrela1="checked='checked'";$comrela2="";$comrela3="";$comrela4="";$comrela5="";$comrela6="";}
  else if($comrelation=='Child'){$comrela1="";$comrela2="checked='checked'";$comrela3="";$comrela4="";$comrela5="";$comrela6="";}
  else if($comrelation=='Parent'){$comrela1="";$comrela2="";$comrela3="checked='checked'";$comrela4="";$comrela5="";$comrela6="";}
  else if($comrelation=='Sibling'){$comrela1="";$comrela2="";$comrela3="";$comrela4="checked='checked'";$comrela5="";$comrela6="";}
  else if($comrelation=='Others'){$comrela1="";$comrela2="";$comrela3="";$comrela4="";$comrela5="checked='checked'";$comrela6="";}
  else if($comrelation==''){$comrela1="";$comrela2="";$comrela3="";$comrela4="";$comrela5="";$comrela6="checked='checked'";}
  else{$comrela1="";$comrela2="";$comrela3="";$comrela4="";$comrela5="checked='checked'";$comrela6="";}

echo "
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Relationship of the Representative to the memeber</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left' class='arial10blackbold'>
                              &nbsp;<input name='comrela' type='hidden' value='' /><input name='comrela' type='radio' title='Spouse' value='Spouse' $comrela1 />Spouse
                              &nbsp;<input name='comrela' type='radio' title='Child' value='Child' $comrela2 />Child
                              &nbsp;<input name='comrela' type='radio' title='Parent' value='Parent' $comrela3 />Parent
                              &nbsp;<input name='comrela' type='radio' title='Sibling' value='Sibling' $comrela4 />Sibling
                              &nbsp;<input name='comrela' type='radio' title='Others' value='Others' $comrela5 />Others&nbsp;
                              &nbsp;<input name='comrela' type='radio' title='Others' value='' $comrela6 />Blank&nbsp;
                            </div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Specify if Relationship is Others</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='comrelationos' type='text' value='$comrelationos' /></div></td>
                          </tr>
";

  if($comreason==1){$comres1="checked='checked'";$comres2="";$comres3="";}
  else if($comreason==2){$comres1="";$comres2="checked='checked'";$comres3="";}
  else if($comreason==""){$comres1="";$comres2="";$comres3="checked='checked'";}
  else{$comres1="";$comres2="";$comres3="";}

echo "
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Reason for signing on behalf of the member</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left' class='arial10blackbold'>
                              &nbsp;<input name='comreason' type='hidden' value='' /><input name='comreason' type='radio' title='Member is incapacitated' value='1' $comres1 />Member is incapacitated
                              &nbsp;<input name='comreason' type='radio' title='Other reasons' value='2' $comres2 />Other reasons
                              &nbsp;<input name='comreason' type='radio' title='Other reasons' value='' $comres3 />Blank&nbsp;
                            </div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Specify if Reason is Others</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='comreasonos' type='text' value='$comreasonos' /></div></td>
                          </tr>
";

  if($comuw==1){$comuw1="";$comuw2="checked='checked'";$comuw3="";}
  else if($comuw==2){$comuw1="";$comuw2="";$comuw3="checked='checked'";}
  else{$comuw1="";$comuw2="";$comuw3="";}

echo "
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Is the Member or Representative unable to write?</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'>
                              &nbsp;<input name='comuw' type='hidden' value='' /><input name='comuw' type='radio' title='No' value='0' $comuw1 />Select this if No
                              &nbsp;<input name='comuw' type='radio' title='Member' value='1' $comuw2 />Member&nbsp;
                              &nbsp;<input name='comuw' type='radio' title='Representative' value='2' $comuw3 />Representative&nbsp;
                            </div></td>
                          </tr>
                          <tr>
                            <td colspan='3' height='40'><div align='left' style='font-face: arial;font-weight: bold;font-size: 13px;padding: 0 3px;color: blue;'>PART II - EMPLOYER'S CERTIFICATION(for employed members only)</div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Employer PEN</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='emppen' type='text' value='$emppen' /></div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Business Name of Employer</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><textarea name='empbusinessname'>$empbusinessname</textarea></div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Name of Employer or Authorized Representative</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='empname' type='text' value='$empname' /></div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Employer Contasct No.</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='empcontactno' type='text' value='$empcontactno' /></div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Designation of the Signatory</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='empsigdesignation' type='text' value='$empsigdesignation' /></div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Date Signed</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'>
";

  if($empdatesigned==""){
echo "
                              &nbsp;<select name='empdatesignedm'>
                                <option></option>
                                <option selected='selected'>$pmonth</option>
                                <option>Jan</option>
                                <option>Feb</option>
                                <option>Mar</option>
                                <option>Apr</option>
                                <option>May</option>
                                <option>Jun</option>
                                <option>Jul</option>
                                <option>Aug</option>
                                <option>Sep</option>
                                <option>Oct</option>
                                <option>Nov</option>
                                <option>Dec</option>
                              </select>
                              <select name='empdatesignedd'>
                                <option></option>
";

    for($m=1;$m<=31;$m++){
      if($m<10){$n="0".$m;}else{$n=$m;}
      if($n==$pday){$nds="selected='selected'";}else{$nds="";}

echo "
                                <option $nds>$n</option>
";
    }

echo "
                              </select>
                              <select name='empdatesignedy'>
                                <option></option>
";

    for($o=2016;$o<=($pyear+5);$o++){
      if($o==$pyear){$ody="selected='selected'";}else{$ody="";}

echo "
                                <option $ody>$o</option>
";
    }

echo "
                              </select>&nbsp;
";
  }
  else{
    $eds=preg_split('/\-/',$empdatesigned);
    $edsm=$eds[0];
    $edsd=$eds[1];
    $edsy=$eds[2];

echo "
                              &nbsp;<select name='empdatesignedm'>
                                <option></option>
                                <option selected='selected'>$edsm</option>
                                <option>Jan</option>
                                <option>Feb</option>
                                <option>Mar</option>
                                <option>Apr</option>
                                <option>May</option>
                                <option>Jun</option>
                                <option>Jul</option>
                                <option>Aug</option>
                                <option>Sep</option>
                                <option>Oct</option>
                                <option>Nov</option>
                                <option>Dec</option>
                              </select>
                              <select name='empdatesignedd'>
                                <option></option>
";

    for($m=1;$m<=31;$m++){
      if($m<10){$n="0".$m;}else{$n=$m;}
      if($n==$edsd){$nds="selected='selected'";}else{$nds="";}

echo "
                                <option $nds>$n</option>
";
    }

echo "
                              </select>
                              <select name='empdatesignedy'>
                                <option></option>
";

    for($o=2016;$o<=($pyear+5);$o++){
      if($o==$edsy){$ody="selected='selected'";}else{$ody="";}

echo "
                                <option $ody>$o</option>
";
    }

echo "
                              </select>
";
  }

echo "
                            </div></td>
                          </tr>
                          <tr>
                            <td colspan='3' height='40'><div align='left' style='font-face: arial;font-weight: bold;font-size: 13px;padding: 0 3px;color: blue;'>PART III - CONSENT TO ACCESS PATIENT RECORDS</div></td>
                          </tr>
";

  if($carchoose=="M"){
    $chsb1="selected='selected'";
    $chsb2="";
  }
  else if($carchoose=="R"){
    $chsb1="";
    $chsb2="selected='selected'";
  }
  else{
    $chsb1="";
    $chsb2="";
  }

echo "
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Is the signatory here the Member or Representative?</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'>
                              <select name='carchoose'>
                                <option $chsb1 value='M'>Member</option>
                                <option $chsb2 value='R'>Representative</option>
                              </select>
                            </div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Name of Signatory<br />&nbsp;(Leave this blank or disregard this if the signatory here is the Member/Patient)</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='carname' type='text' value='$carname' /></div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Date Signed</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'>
";

  if($cardatesigned==""){
echo "
                              <select name='cardatesignedm'>
                                <option></option>
                                <option selected='selected'>$pmonth</option>
                                <option>Jan</option>
                                <option>Feb</option>
                                <option>Mar</option>
                                <option>Apr</option>
                                <option>May</option>
                                <option>Jun</option>
                                <option>Jul</option>
                                <option>Aug</option>
                                <option>Sep</option>
                                <option>Oct</option>
                                <option>Nov</option>
                                <option>Dec</option>
                              </select>
                              <select name='cardatesignedd'>
                                <option></option>
";

    for($p=1;$p<=31;$p++){
      if($p<10){$q="0".$p;}else{$q=$p;}
      if($q==$pday){$qds="selected='selected'";}else{$qds="";}

echo "
                                <option $qds>$q</option>
";
    }

echo "
                              </select>
                              <select name='cardatesignedy'>
                                <option></option>
";

    for($r=2016;$r<=($pyear+5);$r++){
      if($r==$pyear){$rdy="selected='selected'";}else{$rdy="";}

echo "
                                <option $rdy>$r</option>
";
    }

echo "
                              </select>
";
  }
  else{
    $crds=preg_split('/\-/',$cardatesigned);
    $crdsm=$crds[0];
    $crdsd=$crds[1];
    $crdsy=$crds[2];

echo "
                              <select name='cardatesignedm'>
                                <option></option>
                                <option selected='selected'>$crdsm</option>
                                <option>Jan</option>
                                <option>Feb</option>
                                <option>Mar</option>
                                <option>Apr</option>
                                <option>May</option>
                                <option>Jun</option>
                                <option>Jul</option>
                                <option>Aug</option>
                                <option>Sep</option>
                                <option>Oct</option>
                                <option>Nov</option>
                                <option>Dec</option>
                              </select>
                              <select name='cardatesignedd'>
                                <option></option>
";

    for($p=1;$p<=31;$p++){
      if($p<10){$q="0".$p;}else{$q=$p;}
      if($q==$crdsd){$qds="selected='selected'";}else{$qds="";}

echo "
                                <option $qds>$q</option>
";
    }

echo "
                              </select>
                              <select name='cardatesignedy'>
                                <option></option>
";

    for($r=2016;$r<=($pyear+5);$r++){
      if($r==$crdsy){$rdy="selected='selected'";}else{$rdy="";}

echo "
                                <option $rdy>$r</option>
";
    }

echo "
                              </select>
";
  }

echo "
                            </div></td>
                          </tr>
";

  if($carrelation=="Spouse"){$carrel1="checked='checked'";$carrel2="";$carrel3="";$carrel4="";$carrel5="";$carrel6="";}
  else if($carrelation=="Child"){$carrel1="";$carrel2="checked='checked'";$carrel3="";$carrel4="";$carrel5="";$carrel6="";}
  else if($carrelation=="Parent"){$carrel1="";$carrel2="";$carrel3="checked='checked'";$carrel4="";$carrel5="";$carrel6="";}
  else if($carrelation=="Sibling"){$carrel1="";$carrel2="";$carrel3="";$carrel4="checked='checked'";$carrel5="";$carrel6="";}
  else if($carrelation=="Others"){$carrel1="";$carrel2="";$carrel3="";$carrel4="";$carrel5="checked='checked'";$carrel6="";}
  else if($carrelation==""){$carrel1="";$carrel2="";$carrel3="";$carrel4="";$carrel5="";$carrel6="checked='checked'";}
  else{$carrel1="";$carrel2="";$carrel3="";$carrel4="";$carrel5="";$carrel6="";}

echo "
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Relationship to Member/Patient</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left' class='arial10blackbold'>
                              <input name='carrelation' type='hidden' value='' /><input name='carrelation' type='radio' title='Spouse' value='Spouse' $carrel1 />Spouse
                              &nbsp;<input name='carrelation' type='radio' title='Child' value='Child' $carrel2 />Child
                              &nbsp;<input name='carrelation' type='radio' title='Parent' value='Parent' $carrel3 />Parent
                              &nbsp;<input name='carrelation' type='radio' title='Sibling' value='Sibling' $carrel4 />Sibling
                              &nbsp;<input name='carrelation' type='radio' title='Others' value='Others' $carrel5 />Others
                              &nbsp;<input name='carrelation' type='radio' title='Blank' value='' $carrel6 />Blank
                            </div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Specify if Others</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='carrelationos' type='text' value='$carrelationos' /></div></td>
                          </tr>
";

  if($carreason==1){$carres1="checked='checked'";$carres2="";$carres3="";}
  else if($carreason==2){$carres1="";$carres2="checked='checked'";$carres3="";}
  else if($carreason==""){$carres1="";$carres2="";$carres3="checked='checked'";}
  else{$carres1="";$carres2="";$carres3="";}

echo "
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Reason for signing on behalf of the Member/Patient</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'>
                              <input type='hidden' name='carreason' value='' /><input type='radio' name='carreason' title='Patient is incapacitated' $carres1 value='1' />Patient is incapacitated
                              &nbsp;<input type='radio' name='carreason' title='Other reasons' $carres2 value='2' />Other reasons
                              &nbsp;<input type='radio' name='carreason' title='Blank' $carres3 value='' />Blank
                            </div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Specify if Others</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'><input name='carreasonos' type='text' value='$carreasonos' /></div></td>
                          </tr>
";

  if($caruw==1){$caruw1="";$caruw2="checked='checked'";$caruw3="";}
  else if($comuw==2){$caruw1="";$caruw2="";$caruw3="checked='checked'";}
  else{$caruw1="";$caruw2="";$caruw3="";}

echo "
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Is the Member or Representative unable to Read or Write?</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'>
                              <input name='caruw' type='hidden' value='' /><input name='caruw' type='radio' title='No' value='0' $caruw1 />Select this if No
                              &nbsp;<input name='caruw' type='radio' title='Member' value='1' $caruw2 />Member&nbsp;
                              &nbsp;<input name='caruw' type='radio' title='Representative' value='2' $caruw3 />Representative
                            </div></td>
                          </tr>
                          <tr>
                            <td colspan='3' height='40'><div align='left' style='font-face: arial;font-weight: bold;font-size: 13px;padding: 0 3px;color: blue;'>PART V - PROVIDER INFORMATION AND CERTIFICATION</div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Authorized HCI Representative</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'>
                              <select name='hcirep'>
";

echo "
                                <option selected='selected'>$hcirep</option>
                                <option></option>
                                <option>ROSARIO A. GAYAS</option>
";

echo "
                              </select>
                            </div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>Official Capacity/Designation</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'>
                              <select name='hcidesignation'>
";

echo "
                                <option selected='selected'>$hcidesignation</option>
                                <option></option>
                                <option>HOSPITAL ADMINISTRATOR</option>
";

echo "
                              </select>
                            </div></td>
                          </tr>
                          <tr>
                            <td height='30'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>HCI Date Signed</div></td>
                            <td height='30'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                            <td height='30'><div align='left'>
";

  if($hcidatesigned==""){
echo "
                              <select name='hcidatesignedm'>
                                <option selected='selected'>$pmonth</option>
                                <option></option>
                                <option>Jan</option>
                                <option>Feb</option>
                                <option>Mar</option>
                                <option>Apr</option>
                                <option>May</option>
                                <option>Jun</option>
                                <option>Jul</option>
                                <option>Aug</option>
                                <option>Sep</option>
                                <option>Oct</option>
                                <option>Nov</option>
                                <option>Dec</option>
                              </select>
                              <select name='hcidatesignedd'>
                                <option></option>
";

    for($s=1;$s<=31;$s++){
      if($s<10){$t="0".$s;}else{$t=$s;}
      if($t==$pday){$tds="selected='selected'";}else{$tds="";}

echo "
                                <option $tds>$t</option>
";
    }

echo "
                              </select>
                              <select name='hcidatesignedy'>
                                <option></option>
";

    for($u=2016;$u<=($pyear+5);$u++){
      if($u==$pyear){$udy="selected='selected'";}else{$udy="";}

echo "
                                <option $udy>$u</option>
";
    }

echo "
                              </select>
";
  }
  else{
    $hcids=preg_split('/\-/',$hcidatesigned);
    $hcidsm=$hcids[0];
    $hcidsd=$hcids[1];
    $hcidsy=$hcids[2];

echo "
                              <select name='hcidatesignedm'>
                                <option selected='selected'>$hcidsm</option>
                                <option></option>
                                <option>Jan</option>
                                <option>Feb</option>
                                <option>Mar</option>
                                <option>Apr</option>
                                <option>May</option>
                                <option>Jun</option>
                                <option>Jul</option>
                                <option>Aug</option>
                                <option>Sep</option>
                                <option>Oct</option>
                                <option>Nov</option>
                                <option>Dec</option>
                              </select>
                              <select name='hcidatesignedd'>
                                <option></option>
";

    for($s=1;$s<=31;$s++){
      if($s<10){$t="0".$s;}else{$t=$s;}
      if($t==$hcidsd){$tds="selected='selected'";}else{$tds="";}

echo "
                                <option $tds>$t</option>
";
    }

echo "
                              </select>
                              <select name='hcidatesignedy'>
                                <option></option>
";

    for($u=2016;$u<=($pyear+5);$u++){
      if($u==$hcidsy){$udy="selected='selected'";}else{$udy="";}

echo "
                                <option $udy>$u</option>
";
    }

echo "
                              </select>
";
  }

echo "
                            </div></td>
                          </tr>
                          <tr>
                            <td height='25' colspan='3'><div align='right'><input type='submit' name='savedata' class='butgreen01' value='   GO   ' /></div></td>
                          </tr>
                        </table></td>
                        <input type='hidden' name='patientidno' value='$patientidno' />
                        <input type='hidden' name='caseno' value='$caseno' />
                        <input type='hidden' name='cfmicount' value='$cfmicount' />
                        </form>
                      </tr>
                    </table>
";
}
?>
