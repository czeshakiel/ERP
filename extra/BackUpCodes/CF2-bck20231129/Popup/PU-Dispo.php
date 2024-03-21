<style>
/* Radio Look Like Checkbox*/
.css-prp{color: #17CBF2;font-family: arial;}
.con1 {display: block;position: relative;padding-left: 25px;margin-bottom: 12px;cursor: pointer;font-size: 15px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;}

/* Hide the browser's default radio button */
.con1 input {position: absolute;opacity: 0;cursor: pointer;}

/* Create a custom radio button */
.checkmark {position: absolute;top: 0;left: 0;height: 18px;width: 18px;background-color: lightgrey;border-radius: 10%;}

/* When the radio button is checked, add a blue background */
.con1 input:checked ~ .checkmark {background-color: #17CBF2;}
</style>
<script type="text/javascript">
  function handleEnter (field, event) {
    var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
      if (keyCode == 13) {
        var i;
        for (i = 0; i < field.form.elements.length; i++)
        if (field == field.form.elements[i])
        break;
        i = (i + 1) % field.form.elements.length;
        field.form.elements[i].focus();
        return false;
      }
      else
        return true;
  }
</script>
<?php
if($isref=="n"){$r1="checked";$r2="";}
else if($isref=="y"){$r1="";$r2="checked";}
else{$r1="";$r2="";}

if($disposition=="I"){$s1="checked";$s2="";$s3="";$s4="";$s5="";$s6="";}
else if($disposition=="R"){$s1="";$s2="checked";$s3="";$s4="";$s5="";$s6="";}
else if($disposition=="H"){$s1="";$s2="";$s3="checked";$s4="";$s5="";$s6="";}
else if($disposition=="A"){$s1="";$s2="";$s3="";$s4="checked";$s5="";$s6="";}
else if($disposition=="E"){$s1="";$s2="";$s3="";$s4="";$s5="checked";$s6="";}
else if($disposition=="T"){$s1="";$s2="";$s3="";$s4="";$s5="";$s6="checked";}
else{$s1="";$s2="";$s3="";$s4="";$s5="";$s6="";}

if($romi=="P"){$ro1="checked";$ro2="";}
else if($romi=="N"){$ro1="";$ro2="checked";}
else{$ro1="";$ro2="";}

echo "
<div class='login-popup-AD'>
  <div class='form-popup-AD' id='dispo' align='center'>
    <form action='DispoSave.php' method='post' class='form-container-AD'>
      <h4><strong>PATIENT CONFINEMENT INFORMATION</strong></h4>
      <table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
        <tr>
          <td><div align='left'>Is reffered?</div></td>
          <td width='15'><div align='center'>:</div></td>
          <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><label class='con1'><span>No</span><input type='radio' name='isref' value='N' $r1 required /><span class='checkmark'></span></label></td>
              <td width='4'></td>
              <td><label class='con1'><span>Yes</span><input type='radio' name='isref' value='Y' $r2 required /><span class='checkmark'></span></label></td>
              <td width='4'></td>
            </tr>
          </table></div></td>
        </tr>
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
        <tr>
          <td><div align='left'>HCI Name</div></td>
          <td width='15'><div align='center'>:</div></td>
";

echo '
          <td><textarea placeholder="Name of referring Health Care Institution" onkeypress="return handleEnter(this, event)" name="hci">'.$hci.'</textarea></td>
';


echo "
        </tr>
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
        <!-- tr>
          <td><div align='left'>HCI Name</div></td>
          <td width='15'><div align='center'>:</div></td>
";

echo '
          <td><textarea placeholder="Address of referring Health Care Institution" onkeypress="return handleEnter(this, event)" name="hciaddress">'.$hciaddress.'</textarea></td>
';


echo "
        </tr>
        <tr>
          <td colspan='3' height='5'></td>
        </tr -->
        <tr>
          <td><div align='left'>Disposition</div></td>
          <td width='15'><div align='center'>:</div></td>
          <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><label class='con1'><span>Improved</span><input type='radio' name='disposition' value='I' $s1 required /><span class='checkmark'></span></label></td>
              <td width='4'></td>
              <td><label class='con1'><span>Expired</span><input type='radio' name='disposition' value='E' $s5 required /><span class='checkmark'></span><span style='color: blue;'>*</span></label></td>
              <td width='4'></td>
            </tr>
            <tr>
              <td><label class='con1'><span>Recovered</span><input type='radio' name='disposition' value='R' $s2 required /><span class='checkmark'></span></label></td>
              <td width='4'></td>
              <td><label class='con1'><span>Transfered</span><input type='radio' name='disposition' value='T' $s6 required /><span class='checkmark'></span></label></td>
              <td width='4'></td>
            </tr>
            <tr>
              <td colspan='3'><label class='con1'><span>Home/Discharged Against Medical Advise</span><input type='radio' name='disposition' value='H' $s3 required /><span class='checkmark'></span></label></td>
              <td width='4'></td>
            </tr>
            <tr>
              <td colspan='3'><label class='con1'><span>Absconded</span><input type='radio' name='disposition' value='A' $s4 required /><span class='checkmark'></span></label></td>
              <td width='4'></td>
            </tr>
          </table></div></td>
        </tr>
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
        <tr>
          <td><div align='left'>Date Expired<span style='color: blue;'>*</span></div></td>
          <td width='15'><div align='center'>:</div></td>
          <td><input type='date' name='expireddays' value='$expireddays'></td>
        </tr>
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
        <tr>
          <td><div align='left'>Time Expired<span style='color: blue;'>*</span></div></td>
          <td width='15'><div align='center'>:</div></td>
          <td><input type='time' name='timeexpired' value='$timeexpired'></td>
        </tr>
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
        <tr>
          <td><div align='left'>Accomodation Type</div></td>
          <td width='15'><div align='center'>:</div></td>
          <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><label class='con1'><span>Private</span><input type='radio' name='romi' value='P' $ro1 required /><span class='checkmark'></span></label></td>
              <td width='4'></td>
              <td><label class='con1'><span>Non-private</span><input type='radio' name='romi' value='N' $ro2 required /><span class='checkmark'></span></label></td>
              <td width='4'></td>
            </tr>
          </table></div></td>
        </tr>
        <tr>
          <td colspan='3' height='15'></td>
        </tr>
        <tr>
          <td colspan='3'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><button type='button' class='btn cancel' onclick='closedispo()'>Close</button></td>
              <td><button type='submit' class='btn'>Save</button></td>
            </tr>
          </table></div></td>
        </tr>
      </table>
      <input type='hidden' name='user' value='".base64_encode($user)."' />
      <input type='hidden' name='caseno' value='$caseno' />
    </form>
  </div>
</div>

<script>
  function opendispo() {
    document.getElementById('dispo').style.display='block';
  }

  function closedispo() {
    document.getElementById('dispo').style.display='none';
  }
</script>
";
?>
