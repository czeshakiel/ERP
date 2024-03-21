<!DOCTYPE html>
<html lang="en">
  <head>
  <title>SOA Setup</title>
  <link rel="stylesheet" type="text/css" href="../Resources/CSS/mystyle.css">
  <!-- Favicon -->
    <link rel="icon" href="../Resources/Favicon/logo.png" type="image/png" />
    <link rel="shortcut icon" href="../Resources/Favicon/logo.png" type="image/png" />

    <style>
      * {
      box-sizing: border-box;
      }
      body {
      font-family: Roboto, Helvetica, sans-serif;
      background-color: #FFFFFF;
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
      background-color: #FFFFFF;
      }
      /* Full-width for input fields */
      .form-container-Edit input[type=text], .form-container-Edit input[type=number] {
      width: 250px;
      height: 40px;
      padding: 7px;
      margin: 5px 0 5px 0;
      border: none;
      background: #FFFFF;
      border-radius: 10px;
      font-size: 16px;
      border: solid 1px #000000;
      }
            /* Full-width for input fields */
      .form-container-Edit select {
      height: 40px;
      padding: 7px;
      margin: 5px 0 5px 0;
      border: none;
      background: #eee;
      border-radius: 10px;
      font-size: 16px;
      }
      /* Select fields */
      .form-container-Edit select {
      padding: 10px;
      margin: 5px 0 10px 0;
      border: none;
      background: #eee;
      }
      /* When the inputs get focus, do something */
      .form-container-Edit input[type=text]:focus, .form-container-Edit input[type=number]:focus, .form-container-Edit select:focus {
      background-color: #ddd;
      outline: none;
      }
      /* Style submit/login button */
      .form-container-Edit .btn {
      background-color: #8ebf42;
      color: #fff;
      padding: 5px 5px;
      border: none;
      cursor: pointer;
      margin-bottom:0px;
      opacity: 0.8;
      border-radius: 5px;
      }
      /* Style cancel button */
      .form-container-Edit .cancel {
      background-color: #cc0000;
      }
      /* Hover effects for buttons */
      .form-container-Edit .btn:hover, .open-button:hover {
      opacity: 1;
      }
    </style>
    <script type="text/javascript">
        function change_url(val) {
            window.location=val;
        }
    </script>
  </head>
<body>
<?php
ini_set("display_errors", "On");
include("../../main/class.php");
$cuz = new database();

echo "
<div align='left' class='form-container-Edit'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td colspan='4'><div align='right'><a href='LabelManagement.php?add'><button type='submit' class='btn' title='Add' style='font-size: 10px;width: 25px;height: 25px;border-radius: 12px;'>+</button></a></div></td>
    </tr>
    <tr>
      <td colspan='4' height='5'></td>
    </tr>
    <tr>
      <td class='t2 b2 l2'><div align='center' class='courier s16 black bold'>#</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s16 black bold'>Label</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s16 black bold'>Items Included</div></td>
      <td class='t2 b2 l1 r2'><div align='center' class='courier s16 black bold'>Action</div></td>
    </tr>
";

$a=0;
$asql=mysqli_query($conn,"SELECT * FROM `soasetup` ORDER BY CAST(`sort` AS unsigned)");
while($afetch=mysqli_fetch_array($asql)){
  $autono=$afetch['autono'];
  $sort=$afetch['sort'];
  $label=$afetch['label'];
  $a++;

echo "
    <tr>
      <td class='b1 l2' height='30'><div align='left' class='courier s18 black bold'>&nbsp;$sort&nbsp;</div></td>
      <td class='b1 l1'><div align='left' class='courier s18 black bold'>&nbsp;$label&nbsp;</div></td>
      <td class='b1 l1'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='2' colspan='5'></td>
        </tr>
        <tr>
          <td width='2'></td>
          <td class='t1 b1 l1'><div align='left' class='tahoma s10 black bold'>&nbsp;Items&nbsp;</div></td>
          <td class='t1 b1 l1'><div align='left' class='tahoma s10 black bold'>&nbsp;Type&nbsp;</div></td>
          <td class='t1 b1 l1 r1'><div align='left' class='tahoma s10 black bold'>&nbsp;Options&nbsp;</div></td>
          <td width='2'></td>
        </tr>
";

$bsql=mysqli_query($conn,"SELECT `productsubtype`, `type`, `producttype`, `terminalname`, `administration`  FROM `soasetupdetails` WHERE `no`='$autono'");
while($bfetch=mysqli_fetch_array($bsql)){
$productsubtype=$bfetch['productsubtype'];
$type=$bfetch['type'];
$producttype=$bfetch['producttype'];
$terminalname=$bfetch['terminalname'];
$administration=$bfetch['administration'];

if($type==1){$opt="";}
else if($type==2){$opt="administration --> $administration";}
else if($type==3){$opt="terminalname --> $terminalname";}
else if($type==4){$opt="producttype --> $producttype";}

echo "
        <tr>
          <td width='2'></td>
          <td class='b1 l1'><div align='left' class='tahoma s11 black'>&nbsp;$productsubtype&nbsp;</div></td>
          <td class='b1 l1'><div align='left' class='tahoma s11 black'>&nbsp;$type&nbsp;</div></td>
          <td class='b1 l1 r1'><div align='left' class='tahoma s11 black'>&nbsp;$opt&nbsp;</div></td>
          <td width='2'></td>
        </tr>
";
}

echo "
        <tr>
          <td height='2' colspan='5'></td>
        </tr>
      </table></td>
      <td class='b1 l1 r2'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='15'></td>
          <td><div align='center'><a href='LabelManagement.php?edit&autono=$autono'><button type='submit' class='btn'>&nbsp;E&nbsp;</button></a></div></td>
          <td width='25'></td>
          <td><div align='center'><a href='LabelManagement.php?remgo&autono=$autono'><button type='submit' class='btn cancel'>&nbsp;X&nbsp;</button></a></div></td>
          <td width='15'></td>
        </tr>
      </table></td>
    </tr>
";
}

echo "
  </table>
";

if(isset($_GET['add'])){
echo "
  <br />
  <hr />
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <form name='Save' method='post' action='LabelManagement.php?addgo' class='form-container-Edit'>
      <td class='t2 b2 l2 r2'><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td colspan='5' height='5'></td>
        </tr>
        <tr>
          <td width='5'></td>
          <td><div align='left' class='s14'>Label</div></td>
          <td width='10'><div align='center' class='s14'>:</div></td>
          <td><input type='text' placeholder='Label' name='addlabel' value='' autocomplete='off' style='background-color: #acc7f8;' required /></td>
          <td width='5'></td>
        </tr>
        <tr>
          <td></td>
          <td><div align='left' class='s14'>Sorting</div></td>
          <td width='10'><div align='center' class='s14'>:</div></td>
          <td><input type='number' placeholder='Set sorting position' name='addsort' value='' autocomplete='off' style='background-color: #acc7f8;' required /></td>
          <td></td>
        </tr>
        <tr>
          <td colspan='5' height='10'></td>
        </tr>
        <tr>
          <td></td>
          <td colspan='3'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='right'><button type='submit' class='btn'>&nbsp;Add&nbsp;</button></div></td>
            </tr>
          </table></td>
          <td></td>
        </tr>
        <tr>
          <td colspan='5' height='5'></td>
        </tr>
      </table></td>
      </form>
    </tr>
  </table>
";
}


if(isset($_GET['addgo'])){
  $addlabel=strtoupper(mysqli_real_escape_string($conn,$_POST['addlabel']));
  $addsort=strtoupper(mysqli_real_escape_string($conn,$_POST['addsort']));

  mysqli_query($conn,"INSERT INTO `soasetup` (`sort`, `label`) VALUES ('$addsort', '$addlabel')");
  echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=LabelManagement.php'>";
}

if(isset($_GET['remgo'])){
  $delautono=mysqli_real_escape_string($conn,$_GET['autono']);

  mysqli_query($conn,"DELETE FROM `soasetup` WHERE `autono`='$delautono'");
  mysqli_query($conn,"DELETE FROM `prdsetupdetails` WHERE `no`='$delautono'");
  echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=LabelManagement.php'>";
}


if(isset($_GET['edit'])){
  $setautono=mysqli_real_escape_string($conn,$_GET['autono']);

  $csql=mysqli_query($conn,"SELECT `label`, `sort` FROM `soasetup` WHERE `autono`='$setautono'");
  $cfetch=mysqli_fetch_array($csql);
  $clabel=$cfetch['label'];
  $csort=$cfetch['sort'];

echo "
  <br />
  <hr />
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <form name='Save' method='post' action='LabelManagement.php?edit&autono=$setautono&update' class='form-container-Edit'>
      <td class='t2 b2 l2 r2'><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td colspan='5' height='5'></td>
        </tr>
        <tr>
          <td width='5'></td>
          <td><div align='left' class='s14'>Label</div></td>
          <td width='10'><div align='center' class='s14'>:</div></td>
          <td><input type='text' placeholder='Label' name='setlabel' value='$clabel' autocomplete='off' style='background-color: #acc7f8;' required /></td>
          <td width='5'></td>
        </tr>
        <tr>
          <td></td>
          <td><div align='left' class='s14'>Sorting</div></td>
          <td width='10'><div align='center' class='s14'>:</div></td>
          <td><input type='number' placeholder='Set sorting position' name='setsort' value='$csort' autocomplete='off' style='background-color: #acc7f8;' required /></td>
          <td></td>
        </tr>
        <tr>
          <td colspan='5' height='10'></td>
        </tr>
        <tr>
          <td></td>
          <td colspan='3'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='right'><button type='submit' class='btn'>Update</button></div></td>
            </tr>
          </table></td>
          <td></td>
        </tr>
        <tr>
          <td colspan='5' height='5'></td>
        </tr>
      </table></td>
      </form>
    </tr>
  </table>
";

echo "
  <br />
  <hr />
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='right'><a href='LabelManagement.php?edit&autono=$setautono&additm'><button type='submit' class='btn' title='Add' style='font-size: 10px;width: 25px;height: 25px;border-radius: 12px;'>+</button></a></div></td>
    </tr>
    <tr>
      <td height='5'></td>
    </tr>
    <tr>
      <td class='t2 b2 l2 r2'><table  border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='5' colspan='3'></td>
        </tr>
        <tr>
          <td width='5'></td>
          <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td class='t1 b1'><div align='center' class='arial s10 black bold'>&nbsp;#&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='center' class='arial s10 black bold'>&nbsp;Product Type&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='center' class='arial s10 black bold'>&nbsp;Opt. Type&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='center' class='arial s10 black bold'>&nbsp;Condition&nbsp;</div></td>
              <td class='t1 b1 l1' colspan='2'><div align='center' class='arial s10 black bold'>&nbsp;Action&nbsp;</div></td>
            </tr>
";

$d=0;
$dsql=mysqli_query($conn,"SELECT `refno`, `no`, `productsubtype`, `type`, `producttype`, `terminalname`, `administration` FROM `soasetupdetails` WHERE `no`='$setautono'");
while($dfetch=mysqli_fetch_array($dsql)){
  $drefno=$dfetch['refno'];
  $dproductsubtype=$dfetch['productsubtype'];
  $dtype=$dfetch['type'];
  $dproducttype=$dfetch['producttype'];
  $dterminalname=$dfetch['terminalname'];
  $dadministration=$dfetch['administration'];
  $d++;

  if($dtype==1){$condition="";}
  else if($dtype==2){$condition="administration --> $dadministration";}
  else if($dtype==3){$condition="terminalname --> $dterminalname";}
  else if($dtype==4){$condition="producttype --> $dproducttype";}

echo "
            <tr>
              <td class='b1' height='30'><div align='center' class='arial s12 black'>&nbsp;$d&nbsp;</div></td>
              <td class='b1 l1'><div align='left' class='arial s12 black'>&nbsp;$dproductsubtype&nbsp;</div></td>
              <td class='b1 l1'><div align='center' class='arial s12 black'>&nbsp;$dtype&nbsp;</div></td>
              <td class='b1 l1'><div align='left' class='arial s12 black'>&nbsp;$condition&nbsp;</div></td>
              <td class='b1 l1'><div align='center'><a href='LabelManagement.php?edit&autono=$setautono&delitm&refno=$drefno'><button type='submit' class='btn cancel' title='Remove' style='font-size: 10px;width: 25px;height: 25px;border-radius: 12px;'>X</button></a></div></td>
            </tr>
";
}

echo "
          </table></td>
          <td width='5'></td>
        </tr>
        <tr>
          <td height='5' colspan='3'></td>
        </tr>
      </table></td>
    </tr>
  </table>
";
}


if(isset($_GET['update'])){
  $fsautono=mysqli_real_escape_string($conn,$_GET['autono']);
  $setlabel=strtoupper(mysqli_real_escape_string($conn,$_POST['setlabel']));
  $setsort=strtoupper(mysqli_real_escape_string($conn,$_POST['setsort']));

  mysqli_query($conn,"UPDATE `soasetup` SET `sort`='$setsort', `label`='$setlabel' WHERE `autono`='$fsautono'");
  echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=LabelManagement.php?edit&autono=$fsautono'>";
}


if(isset($_GET['delitm'])){
  $delautono=mysqli_real_escape_string($conn,$_GET['autono']);
  $setrefno=strtoupper(mysqli_real_escape_string($conn,$_GET['refno']));

  mysqli_query($conn,"DELETE FROM `soasetupdetails` WHERE `refno`='$setrefno'");
  echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=LabelManagement.php?edit&autono=$delautono'>";
}


echo "
</div>
";

if(isset($_GET['additm'])){
  $setautono=mysqli_real_escape_string($conn,$_GET['autono']);

  if(isset($_GET['etype'])){
    $etype=mysqli_real_escape_string($conn,$_GET['etype']);
  }
  else{
    $etype=1;
  }

  if($etype==1){$ets1="selected='selected'";$ets2="";$ets3="";$ets4="";}
  else if($etype==2){$ets1="";$ets2="selected='selected'";$ets3="";$ets4="";}
  else if($etype==3){$ets1="";$ets2="";$ets3="selected='selected'";$ets4="";}
  else if($etype==4){$ets1="";$ets2="";$ets3="";$ets4="selected='selected'";}

echo "
  <br />
  <hr />
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <form name='Save' method='post' action='LabelManagement.php?edit&autono=$setautono&additmgo'>
      <input type='hidden' name='autono' value='$setautono' />
      <input type='hidden' name='type' value='$etype' />
      <td class='t2 b2 l2 r2'><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td colspan='5' height='5'></td>
        </tr>
        <tr>
          <td></td>
          <td><div align='left' class='s14 bold'>Type</div></td>
          <td width='10'><div align='center' class='s14'>:</div></td>
          <td>
            <select name='forma' onchange='location = this.value;' style='height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 16px;border: solid 1px #000000;background-color: #acc7f8;'>
              <option value='LabelManagement.php?edit&autono=$setautono&additm&etype=1' $ets1>1</option>
              <option value='LabelManagement.php?edit&autono=$setautono&additm&etype=2' $ets2>2</option>
              <option value='LabelManagement.php?edit&autono=$setautono&additm&etype=3' $ets3>3</option>
              <option value='LabelManagement.php?edit&autono=$setautono&additm&etype=4' $ets4>4</option>
            </select>
          </td>
          <td></td>
        </tr>
        <tr>
          <td width='5'></td>
          <td><div align='left' class='s14 bold'>Product Type</div></td>
          <td width='10'><div align='center' class='s14'>:</div></td>
          <td>
            <select name='productsubtype' style='height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 16px;border: solid 1px #000000;background-color: #acc7f8;'>
";

$esql=mysqli_query($conn,"SELECT `productsubtype` FROM `productout` GROUP BY `productsubtype` ORDER BY `productsubtype`");
while($efetch=mysqli_fetch_array($esql)){
  $ptype=$efetch['productsubtype'];
echo "
              <option>$ptype</option>
";
}

echo "
            </select>
          </td>
          <td width='5'></td>
        </tr>
";

if($etype==1){
echo "
  <input type='hidden' name='producttype' value='' />
  <input type='hidden' name='administration' value='' />
  <input type='hidden' name='terminalname' value='' />
";
}

if($etype==2){
  $econ="administration";

echo "
        <tr>
          <td></td>
          <td><div align='left' class='s14 bold'>$econ</div></td>
          <td width='10'><div align='center' class='s14'>:</div></td>
          <td>
            <select name='$econ' style='height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 16px;border: solid 1px #000000;background-color: #acc7f8;'>
              <option value='administered'>Administered</option>
              <option value='dispensed'>Dispensed</option>
              <option value=''></option>
            </select>
          </td>
          <td></td>
        </tr>
        <input type='hidden' name='producttype' value='' />
        <input type='hidden' name='terminalname' value='' />
";
}
else if($etype==3){
  $econ="terminalname";

echo "
        <tr>
          <td></td>
          <td><div align='left' class='s14 bold'>$econ</div></td>
          <td width='10'><div align='center' class='s14'>:</div></td>
          <td>
            <select name='$econ' style='height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 16px;border: solid 1px #000000;background-color: #acc7f8;'>
              <option value='Testdone'>Test Done</option>
              <option value='Testtobedone'>Test to be Done</option>
              <option value='pending'>Pending</option>
            </select>
          </td>
          <td></td>
        </tr>
        <input type='hidden' name='producttype' value='' />
        <input type='hidden' name='administration' value='' />
";
}
else if($etype==4){
  $econ="producttype";

echo "
        <tr>
          <td></td>
          <td><div align='left' class='s14 bold'>$econ</div></td>
          <td width='10'><div align='center' class='s14'>:</div></td>
          <td>
            <select name='$econ' style='height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 16px;border: solid 1px #000000;background-color: #acc7f8;'>
              <option value='IPD admitting'>IPD admitting</option>
              <option value='Consultation'>Consultation</option>
            </select>
          </td>
          <td></td>
        </tr>
        <input type='hidden' name='administration' value='' />
        <input type='hidden' name='terminalname' value='' />
";
}

echo "
        <tr>
          <td colspan='5' height='10'></td>
        </tr>
        <tr>
          <td></td>
          <td colspan='3'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='right'><button type='submit' style='background-color: #8ebf42;color: #fff;padding: 5px 5px;border: none;cursor: pointer;margin-bottom:0px;opacity: 0.8;border-radius: 5px;'>Save</button></div></td>
            </tr>
          </table></td>
          <td></td>
        </tr>
        <tr>
          <td colspan='5' height='5'></td>
        </tr>
      </table></td>
      </form>
    </tr>
  </table>
";
}


if(isset($_GET['additmgo'])){
  $addautono=mysqli_real_escape_string($conn,$_GET['autono']);
  $addproductsubtype=mysqli_real_escape_string($conn,$_POST['productsubtype']);
  $addtype=mysqli_real_escape_string($conn,$_POST['type']);
  $addproducttype=mysqli_real_escape_string($conn,$_POST['producttype']);
  $addterminalname=mysqli_real_escape_string($conn,$_POST['terminalname']);
  $addadministration=mysqli_real_escape_string($conn,$_POST['administration']);

  mysqli_query($conn,"INSERT INTO `soasetupdetails` (`no`, `productsubtype`, `type`, `producttype`, `terminalname`, `administration`) VALUES ('$addautono', '$addproductsubtype', '$addtype', '$addproducttype', '$addterminalname', '$addadministration')");
  echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=LabelManagement.php?edit&autono=$addautono'>";
}


/*$asql=mysqli_query($conn,"SELECT `no`, `productsubtype` FROM `soasetupdetails` GROUP BY `no`");
while($afetch=mysqli_fetch_array($asql)){
  $ano=$afetch['no'];
  $aptype=$afetch['productsubtype'];

  $bsql=mysqli_query($conn,"SELECT * FROM `soasetup` WHERE `autono`='$ano'");
  $bcount=mysqli_num_rows($bsql);

  if($bcount==0){
    echo $ano." --> ".$aptype."<br />";
  }
}*/


?>

<script>
  function closeme() {
    window.close();
  }
</script>

</body>
</html>
