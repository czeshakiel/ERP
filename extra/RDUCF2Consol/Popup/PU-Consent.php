<?php
$yy=$dtrepy;
$mm=$dtrepm;
$dd=$dtrepd;

if($rep[2]=="<img src='Resources/Pictures/check.png' height='10' width='auto' />"){$s1="checked='checked'";}else{$s1="";}
if($rep[3]=="<img src='Resources/Pictures/check.png' height='10' width='auto' />"){$s2="checked='checked'";}else{$s2="";}
if($rep[4]=="<img src='Resources/Pictures/check.png' height='10' width='auto' />"){$s3="checked='checked'";}else{$s3="";}
if($rep[5]=="<img src='Resources/Pictures/check.png' height='10' width='auto' />"){$s4="checked='checked'";}else{$s4="";}
if($rep[6]=="<img src='Resources/Pictures/check.png' height='10' width='auto' />"){$s5="checked='checked'";}else{$s5="";}

if($rep[7]=="<img src='Resources/Pictures/check.png' height='10' width='auto' />"){$s6="checked='checked'";}else{$s6="";}
if($rep[8]=="<img src='Resources/Pictures/check.png' height='10' width='auto' />"){$s7="checked='checked'";}else{$s7="";}

if($rep[9]=="<img src='Resources/Pictures/check.png' height='10' width='auto' />"){$s8="checked='checked'";}else{$s8="";}
if($rep[10]=="<img src='Resources/Pictures/check.png' height='10' width='auto' />"){$s9="checked='checked'";}else{$s9="";}

echo "
<div class='login-popup-AD'>
  <div class='form-popup-AD' id='consent' align='center'>
    <form action='RepreSave.php' method='get' class='form-container-AD'>
      <h4><strong>Consent To Access Patient Records</strong></h4>
      <table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td><div align='left'>Name</div></td>
          <td width='15'><div align='center'>:</div></td>
          <td><input type='text' placeholder='Name of Member or Representative' name='name' autocomplete='off'  value='".$rep[0]."' /></td>
        </tr>
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
          <td><div align='left'>Relationship</div></td>
          <td width='15'><div align='center'>:</div></td>
          <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='s9'><input type='checkbox' title='Spouse' name='relationship1' value='Spouse' $s1 />&nbsp;Spouse</div></td>
              <td><div align='left' class='s9'><input type='checkbox' title='Child' name='relationship2' value='Child' $s2 />&nbsp;Child</div></td>
              <td><div align='left' class='s9'><input type='checkbox' title='Parent' name='relationship3' value='Parent' $s3 />&nbsp;Parent</div></td>
            </tr>
            <tr>
              <td><div align='left' class='s9'><input type='checkbox' title='Sibling' name='relationship4' value='Sibling' $s4 />&nbsp;Sibling</div></td>
              <td><div align='left' class='s9'><input type='checkbox' title='Others' name='relationship5' value='Others' $s5 />&nbsp;Others</div></td>
              <td><div align='left' class='s9'><input type='text' placeholder='Specify' name='relationship5spec' style='width: 100px; font-size: 8px;' value='".$rep[11]."' />&nbsp;</div></td>
            </tr>
          </table></div></td>
        </tr>
        <tr>
          <td><div align='left'>Reason</div></td>
          <td width='15'><div align='center'>:</div></td>
          <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td colspan='2'><div align='left' class='s9'><input type='checkbox' title='Incapacitated' name='reason1' value='Incapacitated' $s6 />&nbsp;Patient is Incapacitated</div></td>
            </tr>
            <tr>
              <td><div align='left' class='s9'><input type='checkbox' title='Others' name='reason2' value='Others' $s7 />&nbsp;Others</div></td>
              <td><div align='left' class='s9'><input type='text' placeholder='Specify' name='reason2spec' style='width: 100px; font-size: 8px;' value='".$rep[12]."' />&nbsp;</div></td>
            </tr>
          </table></div></td>
        </tr>
        <tr>
          <td><div align='left'>Unable to sign</div></td>
          <td width='15'><div align='center'>:</div></td>
          <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='s9'><input type='checkbox' title='Patient' name='unable1' value='Patient' $s8 />&nbsp;Patient</div></td>
              <td><div align='left' class='s9'><input type='checkbox' title='Representative' name='unable2' value='Representative' $s9 />&nbsp;Representative</div></td>
            </tr>
          </table></div></td>
        </tr>
        <tr>
          <td colspan='3' height='15'></td>
        </tr>
        <tr>
          <td colspan='3'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><button type='button' class='btn cancel' onclick='closeconsent()'>Close</button></td>
              <td><button type='submit' class='btn'>Save</button></td>
            </tr>
          </table></div></td>
        </tr>
      </table>
      <input type='hidden' name='caseno' value='$caseno' />
      <input type='hidden' name='setnum' value='$num' />
    </form>
  </div>
</div>

<script>
  function openconsent() {
    document.getElementById('consent').style.display='block';
  }

  function closeconsent() {
    document.getElementById('consent').style.display='none';
  }
</script>
";
?>
