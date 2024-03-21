<?php
echo "
<table border='0' width='100%' cellpadding='0' cellspacing='0'>
  <tr>
    <!-- td width='250' valign='top' bgcolor='#058BD3' class='t2 b2 l2'><div align='center'>
      <table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='25'></td>
        </tr>
        <tr>
          <td><a href='../CartBeta/?caseno=$caseno&ct=sot&dept=$dept&user=".base64_decode($user)."&xix' target='mainFrame'><button type='button' style='width: 200px;height: 40px;font-weight: bold;'>CHARGES</button></a></td>
        </tr>
        <tr>
          <td height='20'></td>
        </tr>
        <tr>
          <td><a href='../CartBeta/?caseno=$caseno&ct=phs&dept=$dept&user=".base64_decode($user)."&xix' target='mainFrame'><button type='button' style='width: 200px;height: 40px;font-weight: bold;'>CSR2</button></a></td>
        </tr>
        <tr>
          <td height='20'></td>
        </tr>
";

if($dept=="RDU"){
echo "
        <tr>
          <td><a href='http://".$_SERVER['HTTP_HOST']."/2021codes/ChargeCart/?caseno=$caseno&&toh=RDU_MANUAL&station=$mt' target='mainFrame'><button type='button' style='width: 200px;height: 40px;font-weight: bold;'>$dept (BETA)</button></a></td>
        </tr>
        <tr>
          <td height='20'></td>
        </tr>
";
}

echo "
        <tr>
          <td><a href='http://".$_SERVER['HTTP_HOST']."/2021codes/ChargeCart/?caseno=$caseno&toh=PACKAGE&station=$dept' target='mainFrame'><button type='button' style='width: 200px;height: 40px;font-weight: bold;'>PACKAGE</button></a></td>
        </tr>
        <tr>
          <td height='20'></td>
        </tr>
        <tr>
          <td><a href='../CartBeta/?caseno=$caseno&ct=phm&dept=$dept&user=".base64_decode($user)."&xix' target='mainFrame'><button type='button' style='width: 200px;height: 40px;font-weight: bold;'>PHARMACY</button></a></td>
        </tr>
      </table>
    </div></td -->
    <td width='auto' class='t2 b2 l1 r2'><iframe src='../CartBeta/?caseno=$caseno&ct=sot&dept=$dept&user=".base64_decode($user)."&xix' name='mainFrame' id='mainFrame' title='mainFrame' style='border: 0px;' height='700' width='100%'></iframe></td>
  </tr>
</table>
";
?>
