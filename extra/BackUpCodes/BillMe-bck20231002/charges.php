<?php

echo "
<div align='left'>
  <form name='Update' method='post' target='_blank' action='updatetocashprice.php'>
  <table border='0' width='100%' cellpadding='0' cellspacing='0' class='hoverTable'>
    <tr>
      <td><div align='left' class='tabstyle'><table border='0' cellapdding='0' cellspacing='0'>
        <tr>
          <td width='1' bgcolor='#ece0cf' style='border-bottom: 2px solid #ece0cf;'></td>
          <td class='b2'><a href='../BillMe/indextest.php?caseno=$caseno&nursename=$name&user=$user&branch=KMSCI&dept=$dept&all' style='text-decoration: none;'><div align='center' class='tabselect'>Detailed</div></a></td>
          <td width='1' bgcolor='#ece0cf' style='border-bottom: 2px solid #ece0cf;'></td>
";

$zasql=mysqli_query($conn,"SELECT `productsubtype` FROM productout WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 GROUP BY `productsubtype` ORDER BY `productsubtype`");
while($afetch=mysqli_fetch_array($zasql)){
$pst=$afetch['productsubtype'];

echo "
          <td class='b2'><a href='../BillMe/indextest.php?caseno=$caseno&nursename=$name&user=$user&branch=KMSCI&dept=$dept&$pst' style='text-decoration: none;'><div align='center' class='tabselect'>$pst</div></a></td>
          <td width='1' bgcolor='#ece0cf' style='border-bottom: 2px solid #ece0cf;'></td>
";
}

echo "
        </tr>
      </table></div></td>
    </tr>
  </table>
  <!-- br />
  <input type='submit' value='Update Price' />
  </form -->
</div>
";
?>
