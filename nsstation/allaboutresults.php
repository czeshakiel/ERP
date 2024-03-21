<style>
  .t1 {border-top-width: 1px;border-top-color: #000000;border-top-style: solid;}
  .b1 {border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;}
  .l1 {border-left-width: 1px;border-left-color: #000000;border-left-style: solid;}
  .r1 {border-right-width: 1px;border-right-color: #000000;border-right-style: solid;}

  .t2 {border-top-width: 2px;border-top-color: #000000;border-top-style: solid;}
  .b2 {border-bottom-width: 2px;border-bottom-color: #000000;border-bottom-style: solid;}
  .l2 {border-left-width: 2px;border-left-color: #000000;border-left-style: solid;}
  .r2 {border-right-width: 2px;border-right-color: #000000;border-right-style: solid;}

  .t3 {border-top-width: 3px;border-top-color: #000000;border-top-style: solid;}
  .b3 {border-bottom-width: 3px;border-bottom-color: #000000;border-bottom-style: solid;}
  .l3 {border-left-width: 3px;border-left-color: #000000;border-left-style: solid;}
  .r3 {border-right-width: 3px;border-right-color: #000000;border-right-style: solid;}
</style>

<?php
ini_set("display_errors","On");

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$srefno=mysqli_real_escape_string($conn,$_POST['srefno']);
$stype=mysqli_real_escape_string($conn,$_POST['ltype']);

//-------------------------------------------------------------------------------------------------

echo "
        <div class='row clearfix g-3'>
          <div class='col-sm-12'>
            <div class='card mb-3'>
              <div class='card-header'>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
";

if(isset($_POST['stest'])){
  if(isset($_POST['cres'])){
echo "
                    <td><div align='left'><h5 class='fw-bold'><i class='icofont-keyboard-wireless me-2'></i> INPUT RESULT</h5></div></td>
";
  }
  else{
    if(isset($_POST['sres'])){
echo "
                    <td><div align='left'><h5 class='fw-bold'><i class='icofont-save me-2'></i> SAVING RESULT</h5></div></td>
";
    }
    else{
echo "
                    <td><div align='left'><h5 class='fw-bold'><i class='icofont-ui-pointer me-2'></i> SELECT TEST</h5></div></td>
";
    }
  }
}
else{
  if(isset($_POST['eres'])){
    if(isset($_POST['ures'])){
echo "
                    <td><div align='left'><h5 class='fw-bold'><i class='icofont-ui-settings me-2'></i> UPDATING RESULT</h5></div></td>
";
    }
    else{
echo "
                    <td><div align='left'><h5 class='fw-bold'><i class='icofont-edit-alt me-2'></i> EDIT RESULT</h5></div></td>
";
    }
  }
}


echo "
                  </tr>
                </table>
              </div>
              <div class='card-body'>
";

if(isset($_POST['stest'])){
  if(isset($_POST['cres'])){
    include("ltcr.php");
  }
  else{
    if(isset($_POST['sres'])){
      include("ltsr.php");
    }
    else{
      include("ltst.php");
    }
  }
}
else{
  if(isset($_POST['eres'])){
    if(isset($_POST['ures'])){
      include("ltur.php");
    }
    else{
      include("lter.php");
    }
  }
}

echo "
              </div>
            </div>
          </div>
        </div><!-- Row End -->
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='600;URL=Close.php'>";
?>
