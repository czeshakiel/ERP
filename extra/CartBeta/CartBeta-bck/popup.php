<?php
//START POP UP-------------------------------------------------------------------------------------
if($ct=="sot"){$lglbl="Services & Other Charges";}
else if($ct=="phm"){$lglbl="Pharmacy";}
else if($ct=="phs"){$lglbl="CSR2";}

echo "
<div class='cpup' style='box-sizing: border-box;border-radius: 10px;'>
  <div class='formcpup' id='lin' align='center'>
    <form method='post' class='formcontainer'>
      <table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td style='padding: 10px 0;' valign='top'><div align='center'>
            <img src='../Resources/Pictures/Cart.png' width='20' height='auto' /> <span style='font-family: arial;font-weight: bold;font-size: 16px;color: #2BAA76;'>$lglbl Cart Log-In</span>
";

if(isset($_SESSION['lerr'])){
  echo base64_decode($_SESSION['lerr']);
}

echo "
          </div></td>
        </tr>
";

if(isset($_GET['chu'])){
echo "
        <tr>
          <td style='padding-bottom: 5px;'><div align='center'><input type='text' name='susr' style='font-weight: bold;font-size: 16px;' placeholder='Username' autofocus required /></div></td>
        </tr>
";
}
else{
echo "
        <tr>
          <td style='padding-bottom: 5px;'><div align='center' style='font-family: arial;font-weight: bold;font-size: 12px;'>User: <span style='color: #03A3CD;'>$snm</span> <a href='../$aa[3]/$aa[4]&chu' style='text-decoration: none;'><span style='font-size:10px;font-weigth: bold;color: #FF0000;'>(Change User)</span></a></div></td>
        </tr>
";
}

echo "
        <tr>
          <td><div align='center'><input type='password' name='spsw' style='font-weight: bold;font-size: 16px;' placeholder='Password' autofocus required /></div></td>
        </tr>
        <tr>
          <td style='padding-top: 10px;'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><button type='submit' name='login' class='btn'>Proceed</button></td>
            </tr>
          </table></div></td>
        </tr>
      </table>
    </form>
  </div>
</div>

<script>
  function openlin() {
    document.getElementById('lin').style.display='block';
  }

  function closelin() {
    document.getElementById('lin').style.display='none';
  }
</script>
";
//END POP UP---------------------------------------------------------------------------------------
?>
