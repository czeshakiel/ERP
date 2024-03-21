<?php
  $ermkrfn=mysqli_real_escape_string($tmpconn,$_GET['ermkrfn']);

  $rfa="&ermkrfn=$ermkrfn&edrmk";

  $zpsql=mysqli_query($tmpconn,"SELECT `productdesc` FROM `productout` WHERE `refno`='$ermkrfn'");
  $zpfetch=mysqli_fetch_array($zpsql);
  $zpdesc=mb_strtoupper(trim($zpfetch['productdesc']));

  $zhsql=mysqli_query($tmpconn,"SELECT `remarks` FROM `labtest` WHERE `refno`='$ermkrfn'");
  $zhfetch=mysqli_fetch_array($zhsql);
  $zhrmks=$zhfetch['remarks'];

echo "
  <form method='post' action='../$aa[3]/".str_replace("$rfa","",$aa[4])."'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td style='padding-bottom: 5px;'><div align='left'>
          <img src='../Resources/Pictures/Cart.png' width='20' height='auto' /> <span style='font-family: arial;font-weight: bold;font-size: 16px;color: #2BAA76;'> $ctlbl CART</span> | <span style='font-family: arial;font-weight: bold;font-size: 12px;color: #000000;'>USER: <span style='color: #03A3CD;'>$snm</span></span>
        </div></td>
      </tr>
      <tr>
        <td style='padding-bottom: 5px;'><div align='left' style='font-family: arial;font-size: 16px;font-weight: bold;color: #7109A9;'>$zpdesc</div></td>
      </tr>
      <tr>
        <td style='padding-bottom: 5px;'><div align='left'><textarea name='eremarks' style='border: 3px solid #000000;border-radius: 10px;padding: 5px;font-size: 16px;width: 100%;height: 100px;' placeholder='REMARKS' autofocus>$zhrmks</textarea></div></td>
      </tr>
      <tr>
        <td style='padding-bottom: 5px;'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='50%'><div align='left'><a href='../$aa[3]/".str_replace("$rfa","",$aa[4])."'><input type='button' class='btn cancel' value='&#9664; Back' /></a></div></td>
              <td width='50%'><div align='right'><input type='submit' name='srmk' class='btn' value='Submit' /></div></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <input type='hidden' name='itmrfnrmk' value='$ermkrfn' />
  </form>
";
?>
