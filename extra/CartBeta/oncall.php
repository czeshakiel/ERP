<style>
  .list {width: 100%;height: 40px;padding: 7px;margin: 5px 0 5px 0;border: 2px solid #000000;background: #eee;border-radius: 10px;font-size: 16px;}
  .list:focus{background-color: #ddd;outline: none;}
</style>

<?php
  $itmqty=mysqli_real_escape_string($conn,$_POST['qty']);
  $itmcode=mysqli_real_escape_string($conn,$_POST['itmcode']);
  $itmtran=mysqli_real_escape_string($conn,$_POST['trantype']);
  $itmtype=mysqli_real_escape_string($conn,$_POST['itmtype']);
  $itmname=mysqli_real_escape_string($conn,$_POST['itmname']);

echo "
  <form method='post'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td style='padding-bottom: 5px;'><div align='left'>
          <img src='../Resources/Pictures/Cart.png' width='20' height='auto' /> <span style='font-family: arial;font-weight: bold;font-size: 16px;color: #2BAA76;'> $ctlbl CART</span> | <span style='font-family: arial;font-weight: bold;font-size: 12px;color: #000000;'>USER: <span style='color: #03A3CD;'>$snm</span></span>
        </div></td>
      </tr>
      <tr>
        <td style='padding-bottom: 5px;'><div align='left' style='font-family: arial;font-size: 16px;font-weight: bold;color: #7109A9;'>$itmname</div></td>
      </tr>
      <tr>
        <td style='padding-bottom: 5px;'><div align='left'>
          <input list='brow' class='list' name='remarks' placeholder='Search Employee' autocomplete='off' autofocus required>
          <datalist id='brow' class=''>
";

$asql=mysqli_query($conn,"SELECT `name` FROM `nsauthemployees` WHERE accesscode='RT' GROUP BY `name` ORDER BY `name` ASC");
while($afetch=mysqli_fetch_array($asql)){
  $nsnm=trim(mb_strtoupper($afetch['name']));
echo "
            <option selected='selected'>$nsnm</option>
";
}

echo "
          </datalist>
        </div></td>
      </tr>
      <tr>
        <td style='padding-bottom: 5px;'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='50%'><div align='left'><a href='../$aa[3]/$aa[4]'><input type='button' class='btn cancel' value='&lt; Back' /></a></div></td>
              <td width='50%'><div align='right'><input type='submit' name='addch' class='btn' value='Submit' /></div></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <input type='hidden' name='qty' value='$itmqty' />
    <input type='hidden' name='itmcode' value='$itmcode' />
    <input type='hidden' name='trantype' value='$itmtran' />
    <input type='hidden' name='itmtype' value='$itmtype' />
    <input type='hidden' name='itmname' value='$itmname' />
  </form>
";
?>

<script src="../../Resources/JS/sb-admin-2.js"></script>
<script src="../../Resources/JS/jquery.min.js"></script>
<script>
  function closeme() {
    window.close();
  }
</script>
