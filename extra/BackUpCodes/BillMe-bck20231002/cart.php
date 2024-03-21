<?php
echo "
<table border='0' width='100%' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='250' valign='top' bgcolor='#058BD3' class='t2 b2 l2'><div align='center'>
      <table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='25'></td>
        </tr>
        <tr>
          <td><a href='../Cart/?caseno=$caseno&toh=CHARGES&station=$dept' target='mainFrame'><button type='button' style='width: 200px;height: 40px;font-weight: bold;'>CHARGES</button></a></td>
        </tr>
        <tr>
          <td height='20'></td>
        </tr>
        <tr>
          <td><a href='../Cart/?caseno=$caseno&toh=CSR2_MANUAL&station=$dept' target='mainFrame'><button type='button' style='width: 200px;height: 40px;font-weight: bold;'>CSR2</button></a></td>
        </tr>
        <tr>
          <td height='20'></td>
        </tr>
";

if($dept=="RDU"){
echo "
        <tr>
          <td><a href='http://$setip/2021codes/ChargeCart/?caseno=$caseno&&toh=RDU_MANUAL&station=$mt' target='mainFrame'><button type='button' style='width: 200px;height: 40px;font-weight: bold;'>$dept (BETA)</button></a></td>
        </tr>
        <tr>
          <td height='20'></td>
        </tr>
";
}

echo "
        <tr>
          <td><a href='http://$setip/2021codes/ChargeCart/?caseno=$caseno&toh=PACKAGE&station=$dept' target='mainFrame'><button type='button' style='width: 200px;height: 40px;font-weight: bold;'>PACKAGE</button></a></td>
        </tr>
        <tr>
          <td height='20'></td>
        </tr>
        <tr>
          <td><a href='../Cart/?caseno=$caseno&toh=PHARMACY_MANUAL&station=$dept' target='mainFrame'><button type='button' style='width: 200px;height: 40px;font-weight: bold;'>PHARMACY</button></a></td>
        </tr>
      </table>
    </div></td>
    <td width='auto' class='t2 b2 l1 r2'><iframe src='../Cart/?caseno=$caseno&toh=CHARGES&station=$dept' name='mainFrame' id='mainFrame' title='mainFrame' style='border: 0px;' height='800' width='100%'></iframe></td>
  </tr>
</table>
";
?>
