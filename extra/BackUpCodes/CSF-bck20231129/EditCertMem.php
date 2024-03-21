<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Certification of Member</title>
  <link rel="stylesheet" type="text/css" href="CSS/mystyle.css">
  <!-- Favicon -->
    <link rel="icon" href="../../rs/favicon/logo.png" type="image/png" />
    <link rel="shortcut icon" href="../../rs/favicon/logo.png" type="image/png" />

    <style>
      * {
      box-sizing: border-box;
      }
      body {
      font-family: Roboto, Helvetica, sans-serif;
      background-color: #E8E4C9;
      }
      /* Fix the button on the left side of the page */
      .open-btn {
      display: flex;
      justify-content: left;
      }
      /* Style and fix the button on the page */
      .open-button {
      background-color: #1c87c9;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      opacity: 0.8;
      position: fixed;
      }
      /* Styles for the form container */
      .form-container-Edit {
      max-width: 500px;
      padding: 15px;
      background-color: #E8E4C9;
      }
      /* Full-width for input fields */
      .form-container-Edit input[type=text], .form-container-Edit input[type=password] {
      width: 250px;
      height: 40px;
      padding: 7px;
      margin: 5px 0 5px 0;
      border: none;
      background: #eee;
      }
      /* Full-width for input fields */
      .form-container-Edit select {
      height: 40px;
      padding: 7px;
      margin: 5px 0 5px 0;
      border: none;
      background: #eee;
      }
      /* Select fields */
      .form-container-Edit select {
      padding: 10px;
      margin: 5px 0 10px 0;
      border: none;
      background: #eee;
      }
      /* When the inputs get focus, do something */
      .form-container-Edit input[type=text]:focus, .form-container-Edit input[type=password]:focus, .form-container-Edit select:focus {
      background-color: #ddd;
      outline: none;
      }
      /* Style submit/login button */
      .form-container-Edit .btn {
      background-color: #8ebf42;
      color: #fff;
      padding: 12px 20px;
      border: none;
      cursor: pointer;
      margin-bottom:10px;
      opacity: 0.8;
      }
      /* Style cancel button */
      .form-container-Edit .cancel {
      background-color: #cc0000;
      }
      /* Hover effects for buttons */
      .form-container-Edit .btn:hover, .open-button:hover {
      opacity: 1;
      }
      
      /* Radio Look Like Checkbox*/
      .css-prp{color: #17CBF2;font-family: arial;}
      .con1 {display: block;position: relative;padding-left: 25px;margin-bottom: 12px;cursor: pointer;font-size: 15px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;}

      /* Hide the browser's default radio button */
      .con1 input {position: absolute;opacity: 0;cursor: pointer;}

      /* Create a custom radio button */
      .checkmark {position: absolute;top: 0;left: 0;height: 18px;width: 18px;background-color: lightgrey;border-radius: 10%;}

      /* When the radio button is checked, add a blue background */
      .con1 input:checked ~ .checkmark {background-color: #17CBF2;}
      
    </style>
    <script type="text/javascript">
        function change_url(val) {
            window.location=val;
        }
        
        function myFunction() {
          // Get the checkbox
          var radio = document.getElementById("myCheck");
          // Get the output text
          var text = document.getElementById("text");

          // If the checkbox is checked, display the output text
          if (radio.checked == true){
            text.style.display = "block";
          } else {
            text.style.display = "none";
          }
        }
        function myFunction2() {
          // Get the checkbox
          var radio = document.getElementById("myCheck2");
          // Get the output text
          var text = document.getElementById("text");

          // If the checkbox is checked, display the output text
          if (radio.checked == true){
            text.style.display = "none";
          } else {
            text.style.display = "none";
          }
        }
        function myFunction3() {
          // Get the checkbox
          var radio = document.getElementById("myCheck3");
          // Get the output text
          var text = document.getElementById("text2");

          // If the checkbox is checked, display the output text
          if (radio.checked == true){
            text.style.display = "block";
          } else {
            text.style.display = "none";
          }
        }
        function myFunction4() {
          // Get the checkbox
          var radio = document.getElementById("myCheck4");
          // Get the output text
          var text = document.getElementById("text2");

          // If the checkbox is checked, display the output text
          if (radio.checked == true){
            text.style.display = "none";
          } else {
            text.style.display = "none";
          }
        }
    </script>            
  </head>
<body>
<?php
ini_set("display_errors", "On");
include('../Settings.php');
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$caseno=mysql_real_escape_string($_GET['caseno']);
$patientidno=mysql_real_escape_string($_GET['patientidno']);
$paymentmode=mysql_real_escape_string($_GET['paymentmode']);

if(!isset($_GET['setcomchoose'])){
$setcomchoose="M";
}
else{
  $setcomchoose=mysql_real_escape_string($_GET['setcomchoose']);
}

mysql_query('SET NAMES utf8');
$cfsql=mysql_query("SELECT identificationno, UPPER(lastname) AS lastname, UPPER(firstname) AS firstname, UPPER(middlename) AS middlename FROM claiminfo WHERE patientidno='$patientidno' AND caseno='$caseno'");
$cfcount=mysql_num_rows($cfsql);
if($cfcount==0){
  $cf2sql=mysql_query("SELECT identificationno, UPPER(lastname) AS lastname, UPPER(firstname) AS firstname, UPPER(middlename) AS middlename FROM claiminfo WHERE patientidno='$patientidno' AND caseno NOT LIKE '$caseno' AND identificationno NOT LIKE '' AND lastname NOT LIKE ''");
  $cf2count=mysql_num_rows($cf2sql);
  if($cf2count==0){
    $identificationno="";
    $mlname="";
    $mfname="";
    $mmname="";
  }
  else{
    $cf2fetch=mysql_fetch_array($cf2sql);
    $identificationno=$cf2fetch['identificationno'];
    $mlname=$cf2fetch['lastname'];
    $mfname=$cf2fetch['firstname'];
    $mmname=$cf2fetch['middlename'];
    
  }
  
}
else{
  while($cffetch=mysql_fetch_array($cfsql)){
    $identificationno=$cffetch['identificationno'];
    $mlname= $cffetch['lastname'];
    $mfname=$cffetch['firstname'];
    $mmname=$cffetch['middlename'];
  }
}

$cimisql=mysql_query("SELECT `membersuffix`, `comchoose`, `comname`, `comcontact`, `comdatesigned`, `comrelation`, `comrelationos`, `comreason`, `comreasonos`, `comuw` FROM claiminfomoreinfo WHERE caseno='$caseno'");
$cimicount=mysql_num_rows($cimisql);
if($cimicount==0){
  $membersuffix="";
  $comchoose="";
  $comname="";
  $comcontact="";
  $comdatesigned="";
  $comrelation="";
  $comrelationos="";
  $comreason="";
  $comreasonos="";
  $comuw="";
}
else{
  while($cimifetch=mysql_fetch_array($cimisql)){
    $membersuffix=$cimifetch['membersuffix'];
    $comchoose=$cimifetch['comchoose'];
    $comname=$cimifetch['comname'];
    $comcontact=$cimifetch['comcontact'];
    $comdatesigned=$cimifetch['comdatesigned'];
    $comrelation=$cimifetch['comrelation'];
    $comrelationos=$cimifetch['comrelationos'];
    $comreason=$cimifetch['comreason'];
    $comreasonos=$cimifetch['comreasonos'];
    $comuw=$cimifetch['comuw'];
  }
}


$patpsql=mysql_query("SELECT * FROM patientprofile WHERE patientidno='$patientidno'");
while($patpfetch=mysql_fetch_array($patpsql)){
  $ln=$patpfetch['lastname'];
  $fn=$patpfetch['firstname'];
  $mn=$patpfetch['middlename'];
  $sf=$patpfetch['suffix'];
}


if($paymentmode=="Member"){
  $st1="selected='selected'";$st2="";$st3="";$st4="";
  $lnf=$ln;
  $fnf=$fn;
  $mnf=$mn;
  $sff=$sf;
}
else{
  $lnf=$mlname;
  $fnf=$mfname;
  $mnf=$mmname;
  $sff=$membersuffix;
}

if($setcomchoose=="M"){
  $comnamedisp="$fnf $mnf $lnf $sff";
  $scc1="selected='selected'";
  $scc2="";
}
else if($setcomchoose=="R"){
  if($comname==""){
    if($paymentmode!="Member"){
      $comnamedisp="$fn $mn $ln $sf";
    }
    else{
      $comnamedisp="";
    }
  }
  else{
    $comnamedisp=$comname;
  }
  
  $scc1="";
  $scc2="selected='selected'";
}
else{
  $scc1="";
  $scc2="";
  $comnamedisp="";
}

if($comdatesigned==""){
  $bdd=date("d");
  $bdm=date("m");
  $bdy=date("Y");
}
else{
  $bdd=date("d",strtotime($comdatesigned));
  $bdm=date("m",strtotime($comdatesigned));
  $bdy=date("Y",strtotime($comdatesigned));
}

echo "
<div align='center'>
  <form name='Save' method='post' action='EditCertMemSave.php' class='form-container-Edit'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td colspan='3'><div align='center' class='arial s20 blue bold'>Certification of Member</div></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Sigantory Type</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select onchange='change_url(this.value);' style='width: 250px;'>
            <option value='EditCertMem.php?caseno=$caseno&patientidno=$patientidno&paymentmode=$paymentmode&setcomchoose=M' $scc1>Member</option>
            <option value='EditCertMem.php?caseno=$caseno&patientidno=$patientidno&paymentmode=$paymentmode&setcomchoose=R' $scc2>Representative</option>
          </select>
        </td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Name of Signatory</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Full Name' name='comname' value='$comnamedisp' autocomplete='off' /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Contact No.</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Contact Number' name='comcontact' value='$comcontact' autocomplete='off' /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Date Signed</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='mm'>
            <option value=''>MM</option>
";

for($l=1;$l<=12;$l++){
if($l<10){$lf="0".$l;}else{$lf=$l;}
if($lf==$bdm){$sm="selected='selected'";}else{$sm="";}
$dl=date("M",strtotime("2020-$lf-01"));
echo "
            <option value='$lf' $sm>$dl</option>
";
}

echo "
          </select>
          <select name='dd'>
            <option value=''>DD</option>
";

for($k=1;$k<=31;$k++){
if($k<10){$kf="0".$k;}else{$kf=$k;}
if($kf==$bdd){$sd="selected='selected'";}else{$sd="";}
echo "
            <option value='$kf' $sd>$kf</option>
";
}

echo "
          </select>
          <select name='yy'>
            <option value=''>YYYY</option>
";

for($j=2020;$j<=date("Y")+5;$j++){
if($j==$bdy){$sy="selected='selected'";}else{$sy="";}
echo "
            <option $sy>$j</option>
";
}

echo "
          </select>
        </td>
      </tr>
";

if($comrelation=="Spouse"){$ccr1="checked";$ccr2="";$ccr3="";$ccr4="";$ccr5="";$ccr6="";$cctxt="style='display:none'";}
else if($comrelation=="Child"){$ccr1="";$ccr2="checked";$ccr3="";$ccr4="";$ccr5="";$ccr6="";$cctxt="style='display:none'";}
else if($comrelation=="Parent"){$ccr1="";$ccr2="";$ccr3="checked";$ccr4="";$ccr5="";$ccr6="";$cctxt="style='display:none'";}
else if($comrelation=="Sibling"){$ccr1="";$ccr2="";$ccr3="";$ccr4="checked";$ccr5="";$ccr6="";$cctxt="style='display:none'";}
else if($comrelation=="Others"){$ccr1="";$ccr2="";$ccr3="";$ccr4="";$ccr5="checked";$ccr6="";$cctxt="style='display:block'";}
else{$ccr1="";$ccr2="";$ccr3="";$ccr4="";$ccr5="";$ccr6="checked";$cctxt="style='display:none'";}

echo "
      <tr>
        <td><div align='left' class='s14'>Relationship of<br />the Representative<br />to the memeber</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><table border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td><table border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td><label class='con1'><span>Spouse</span><input type='radio' name='comrela' value='Spouse' id='myCheck2' onclick='myFunction2()' $ccr1 /><span class='checkmark'></span></label></td>
                <td width='4'></td>
                <td><label class='con1'><span>Child</span><input type='radio' name='comrela' value='Child' id='myCheck2' onclick='myFunction2()' $ccr2 /><span class='checkmark'></span></label></td>
                <td width='4'></td>
                <td><label class='con1'><span>Parent</span><input type='radio' name='comrela' value='Parent' id='myCheck2' onclick='myFunction2()' $ccr3 /><span class='checkmark'></span></label></td>
              </tr>
              <tr>
                <td><label class='con1'><span>Sibling</span><input type='radio' name='comrela' value='Sibling' id='myCheck2' onclick='myFunction2()' $ccr4 /><span class='checkmark'></span></label></td>
                <td width='4'></td>
                <td><label class='con1'><span>Others</span><input type='radio' name='comrela' value='Others' id='myCheck' onclick='myFunction()' $ccr5 /><span class='checkmark'></span></label></td>
                <td width='4'></td>
                <td><label class='con1'><span>Blank</span><input type='radio' name='comrela' value='' id='myCheck2' onclick='myFunction2()' $ccr6 /><span class='checkmark'></span></label></td>
              </tr>
            </table></td>
          </tr>
          <tr id='text' $cctxt>
            <td><div align='left'><input type='text' placeholder='Specify Relationship' name='comrelationos' value='$comrelationos' autocomplete='off' /></div></td>
          </tr>
        </table></td>
      </tr>
";

if($comreason=="1"){$crr1="checked";$crr2="";$crr3="";$crrtxt="style='display:none'";}
else if($comreason=="2"){$crr1="";$crr2="checked";$crr3="";$crrtxt="style='display:block'";}
else{$crr1="";$crr2="";$crr3="checked";$crrtxt="style='display:none'";}

echo "
      <tr>
        <td><div align='left' class='s14'>Reason for signing<br />on behalf of<br />the memeber</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><table border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td><table border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td><label class='con1'><span>Member is incapacitated</span><input type='radio' name='comreason' value='1' id='myCheck4' onclick='myFunction4()' $crr1 /><span class='checkmark'></span></label></td>
              </tr>
              <tr>
                <td><label class='con1'><span>Other reasons</span><input type='radio' name='comreason' value='2' id='myCheck3' onclick='myFunction3()' $crr2 /><span class='checkmark'></span></label></td>
              </tr>
              <tr>
                <td><label class='con1'><span>Blank</span><input type='radio' name='comreason' value='' id='myCheck4' onclick='myFunction4()' $crr3 /><span class='checkmark'></span></label></td>
              </tr>
            </table></td>
          </tr>
          <tr id='text2' $crrtxt>
            <td><div align='left'><input type='text' placeholder='Specify Reason' name='comreasonos' value='$comreasonos' autocomplete='off' /></div></td>
          </tr>
        </table></td>
      </tr>
";

if($comuw=="1"){$rrr1="checked";$rrr2="";$rrr3="";}
else if($comuw=="2"){$rrr1="";$rrr2="checked";$rrr3="";}
else if($comuw=="3"){$rrr1="";$rrr2="";$rrr3="checked";}
else{$rrr1="";$rrr2="";$rrr3="checked";}

echo "
      <tr>
        <td><div align='left' class='s14'>Unable to write</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><table border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td><table border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td><label class='con1'><span>Member</span><input type='radio' name='comuw' value='1' $rrr1 /><span class='checkmark'></span></label></td>
                <td width='4'></td>
                <td><label class='con1'><span>Representative</span><input type='radio' name='comuw' value='2' $rrr2 /><span class='checkmark'></span></label></td>
                <td width='4'></td>
                <td><label class='con1'><span>Blank</span><input type='radio' name='comuw' value='3' $rrr3 /><span class='checkmark'></span></label></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td colspan='3'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td width='49%'><div align='right'><button type='button' class='btn cancel' onclick='closeme()'>Close</button></div></td>
            <td width='2%'></td>
            <td width='49%'><div align='left'><button type='submit' class='btn'>Save</button></div></td>
          </tr>
        </table></td>
      </tr>
    </table>
  <input type='hidden' name='caseno' value='$caseno' />
  <input type='hidden' name='patientidno' value='$patientidno' />
  <input type='hidden' name='paymentmode' value='$paymentmode' />
  <input type='hidden' name='comchoose' value='$setcomchoose' />
  </form>
</div>
";

?>

<script>    
  function closeme() {
    window.close();
  }
</script>

</body>
</html>
