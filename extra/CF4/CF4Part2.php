<link href="res/ico/favicon.png" rel="shortcut icon" type="image/x-icon" />
<link href="res/css/normalize.css" rel="stylesheet" type="text/css" />
<link href="res/css/omis.css" rel="stylesheet" type="text/css" />
<link href="res/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="res/css/styles.css" rel="stylesheet" type="text/css" />
<link href="res/css/jquery-ui-1.11.4.css" rel="stylesheet">
<link href="res/datatable/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
<style>
  .unhide{display: block;}
  .hide{display: none;}
</style>

<?php
include('function.php');
include('function_global.php');

if(!isset($_POST['savep2'])){
  $asql=mysqli_query($conncf4,"SELECT * FROM `subjective` WHERE `caseno`='$caseno'");
  $acount=mysqli_num_rows($asql);
  if($acount!=0){
    $afetch=mysqli_fetch_array($asql);
    $pOtherComplaint=$afetch["pOtherComplaint"];
    $pSignsSymptoms=$afetch["pSignsSymptoms"];
    $pPainSite=$afetch["pPainSite"];
  }
  else{
    $pOtherComplaint="";
    $pSignsSymptoms="";
    $pPainSite="";
  }

  $listHeents = listHeent();
  $listChests = listChest();
  $listHearts = listHeart();
  $listAbs = listAbdomen();
  $listNeuro = listNeuro();
  $listGenitourinary = listGenitourinary();
  $listRectal = listDigitalRectal();
  $listSkinExtremities = listSkinExtremities();

//---------------------------------------------------------------------------------------------------------------------------------------------------

echo "
<div align='center'>
  <form method='post'>
    <table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td>
          <table border='0' style='width: 100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div class='alert alert-success' style='margin-bottom: 0px'>
                <label style='color:red;'>*</label><strong style='font-size: 16px'>III.b. REASON FOR ADMISSION - PERTINENT SIGNS & SYMPTOMS ON ADMISSION</strong>
              </div></td>
            </tr>
            <tr>
              <td height='5'></td>
            </tr>
            <tr>
              <td>
                <table border='0' cellpadding='0' cellspacing='0'>
";


  $pLibComplaint = listComplaint();
  for ($i = 0; $i < count($pLibComplaint); $i++) {
    $asd=$pLibComplaint[$i]['SYMPTOMS_ID'];

    if(strpos($pSignsSymptoms, $asd)!== false){
      $cs="checked='checked'";
      if($pLibComplaint[$i]['SYMPTOMS_ID'] == '38'){
        $csps="unhide";
        $rq38="required";
      }
      else{
        $csps="hide";
        $rq38="";
      }
    }
    else{
      $cs="";
      $csps="hide";
      $rq38="";
    }

    if($pLibComplaint[$i]['SYMPTOMS_ID'] == '38'){$valp="onclick='unhidepain()'";}else{$valp="";}

echo "
                  <tr>
                    <td>
                      <label style='cursor: pointer;' $valp>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='checkbox' name='pCf4Symptoms[]' id='symptom_".$pLibComplaint[$i]['SYMPTOMS_ID']."' value='".$pLibComplaint[$i]['SYMPTOMS_ID']."' style='cursor: pointer; float: left;' $cs $valp /></td>
                            <td width='3'></td>
                            <td><span style='font-weight: normal;float:left;margin: 4px 0px 0px 2px;'>".$pLibComplaint[$i]['SYMPTOMS_DESC']."</span></td>
                          </tr>
                        </table>
                      </label>
";

    if($pLibComplaint[$i]['SYMPTOMS_ID'] == '38'){
echo "
                      <br/><input type='text' name='pPainSite' id='pPainSite' class='form-control $csps' style='width: 500px; color: #000; margin: 0px 10px 0px 10px; text-transform: uppercase; resize: none;' placeholder='Input the Site of Pain here...' autocomplete='off' value='$pPainSite' maxlength='500' $rq38 />
";
    }

echo "
                    </td>
                  </tr>
";
  }

  if(strpos($pSignsSymptoms, "X")!== false){$csx="checked='checked'";$csot="unhide";$csps="unhide";$rqx="required";}else{$csx="";$csot="hide";$rqx="";}
echo "
                  <tr>
                    <td>
                      <label style='cursor: pointer;' onclick='unhideot()'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='checkbox' name='pCf4Symptoms[]' id='symptom_X' $csx value='X' style='cursor: pointer; float: left;' onclick='unhideot()' /></td>
                            <td width='3'></td>
                            <td><span style='font-weight: normal;float:left;margin: 4px 0px 0px 2px;'>OTHERS</span></td>
                          </tr>
                        </table>
                      </label><br/>
                      <input type='text' name='pCf4OtherSymptoms' id='OTX' class='form-control $csot' style='width: 500px; color: #000; margin: 0px 10px 0px 10px; text-transform: uppercase; resize: none;' placeholder='OTHERS' autocomplete='off' value='$pOtherComplaint' maxlength='500' $rqx />
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <hr />
    <table boreder='0' width='100%' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='left'><a href='?cf4clear&bck=p2&caseno=$caseno'";?> onclick="return confirm('Clear CF4 Data?');" <?php echo "><input type='button' class='btn btn-danger' value='Clear CF4 Data' title='Clear CF4 Data' style='color: #FFFFFF;font-weight: bold;margin: 10px 0px 0px 0px;' /></a></div></td>
        <td><div align='right'>
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <!-- td><a href='../eClaimsTwo/3/CF4/?caseno=$caseno' class='astyle' target='_blank'><div align='right'><input type='button' class='btn btn-primary' value='PRINTABLE CF4' title='PRINTABLE CF4' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
              <td width='3'></td -->
";

  $zsql=mysqli_query($conncf4,"SELECT `pHciCaseNo`, `pHciTransNo` FROM `enlistment` WHERE `caseno`='$caseno'");
  $zcount=mysqli_num_rows($zsql);

  if($zcount!=0){
echo "
              <!-- td><a href='?cf4p5&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 5' value='CF4 Part 5' title='CF4 Part 5' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
              <td width='3'></td -->
              <td><a href='?cf4p4&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 4' value='CF4 Part 4' title='CF4 Part4' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
              <td width='3'></td>
";
  }

echo "
              <td><a href='?cf4p3&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 3' value='CF4 Part 3' title='CF4 Part3' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
              <td width='3'></td>
              <td><a href='?cf4p1&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 1' value='CF4 Part 1' title='CF4 Part1' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
              <td width='20'></td>
              <td><div align='right'><input type='submit' class='btn btn-primary' name='savep2' value='Save Entries' title='Save Entries' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
            </tr>
          </table>
        </div></td>
      </tr>
    </table>
  </form>
</div>
";
}
else{
echo "
<div align='left'>
";

  include("CF4Part2Save.php");

echo "
</div>
";
}

//---------------------------------------------------------------------------------------------------------------------------------------------------
?>
<script>
function unhidepain() {
  var checkBox = document.getElementById("symptom_38");
  var element = document.getElementById("pPainSite");
  if (checkBox.checked == true){
    element.classList.remove("hide");
    element.classList.add("unhide");
    element.required = true;
  }
  else{
    element.classList.remove("unhide");
    element.classList.add("hide");
    element.required = false;
  }
}
function unhideot() {
  var checkBox = document.getElementById("symptom_X");
  var element = document.getElementById("OTX");
  if (checkBox.checked == true){
    element.classList.remove("hide");
    element.classList.add("unhide");
    element.required = true;
  }
  else{
    element.classList.remove("unhide");
    element.classList.add("hide");
    element.required = false;
  }
}
</script>
