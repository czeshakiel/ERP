<?php
$yy=$sety[2];
$mm=$setm[2];
$dd=$setd[2];

echo "
<div class='login-popup-AD'>
  <div class='form-popup-AD' id='ad4' align='center'>
    <form action='DateSignedSave.php' method='get' class='form-container-AD'>
      <h4><strong>Doctor 5</strong></h4>
      <table width='100%' border='0' cellpadding='0' cellspacing='0'>

        <tr>
          <td><div align='left'>Date Signed</div></td>
          <td width='15'><div align='center'>:</div></td>
          <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td>
                <select name='dsm'>
                  <option></option>
";

for($a=1;$a<=12;$a++){
  if($a<10){$aa="0".$a;}else{$aa=$a;}
  $adisp=date("M",strtotime("2020-$aa-01"));
  if($aa==$mm){$as="selected='selected'";}else{$as="";}

echo "
                  <option value='$aa' $as>$adisp</option>
";
}

echo "
                </select>
              </td>
              <td width='4'></td>
              <td>
                <select name='dsd'>
                  <option></option>
";

for($b=1;$b<=31;$b++){
  if($b<10){$bb="0".$b;}else{$bb=$b;}
  if($bb==$dd){$bs="selected='selected'";}else{$bs="";}

echo "
                  <option value='$bb' $bs>$bb</option>
";
}

echo "
                </select>
              </td>
              <td width='4'></td>
              <td>
                <select name='dsy'>
                  <option></option>
";

for($c=(2020-2);$c<=(2020+15);$c++){
  if($c==$yy){$cs="selected='selected'";}else{$cs="";}

echo "
                  <option value='$c' $cs>$c</option>
";
}

echo "
                </select>
              </td>
            </tr>
          </table></div></td>
        </tr>
        <tr>
          <td colspan='3'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><button type='button' class='btn cancel' onclick='closead4()'>Close</button></td>
              <td><button type='submit' class='btn'>Save</button></td>
            </tr>
          </table></div></td>
        </tr>
      </table>
      <input type='hidden' name='caseno' value='$caseno' />
      <input type='hidden' name='num' value='1' />
      <input type='hidden' name='setnum' value='$num' />
    </form>
  </div>
</div>

<script>
  function openad4() {
    document.getElementById('ad4').style.display='block';
  }

  function closead4() {
    document.getElementById('ad4').style.display='none';
  }
</script>
";
?>
