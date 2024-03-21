<?php
echo "
<div class='login-popup-AD'>
  <div class='form-popup-AD' id='patname' align='center'>
    <form action='PatNameSave.php' method='post' class='form-container-AD'>
      <h4><strong>Consent To Access Patient Records</strong></h4>
      <table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td><div align='left'>Last Name</div></td>
          <td width='15'><div align='center'>:</div></td>
          <td><input type='text' placeholder='Last Name' name='lastname' autocomplete='off'  value='$ln' /></td>
        </tr>
        <tr>
          <td><div align='left'>First Name</div></td>
          <td width='15'><div align='center'>:</div></td>
          <td><input type='text' placeholder='First Name' name='firstname' autocomplete='off'  value='$fn' /></td>
        </tr>
        <tr>
          <td><div align='left'>Suffix</div></td>
          <td width='15'><div align='center'>:</div></td>
          <td><input type='text' placeholder='Suffix' name='suffix' autocomplete='off'  value='$su' /></td>
        </tr>
        <tr>
          <td><div align='left'>Middle Name</div></td>
          <td width='15'><div align='center'>:</div></td>
          <td><input type='text' placeholder='Middle Name' name='middlename' autocomplete='off'  value='$mn' /></td>
        </tr>
        <tr>
          <td colspan='3' height='15'></td>
        </tr>
        <tr>
          <td colspan='3'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><button type='button' class='btn cancel' onclick='closepatname()'>Close</button></td>
              <td><button type='submit' class='btn'>Save</button></td>
            </tr>
          </table></div></td>
        </tr>
      </table>
      <input type='hidden' name='caseno' value='$caseno' />
      <input type='hidden' name='patientidno' value='$patientidno' />
      <input type='hidden' name='ln' value='$ln' />
      <input type='hidden' name='fn' value='$fn' />
      <input type='hidden' name='su' value='$su' />
      <input type='hidden' name='mn' value='$mn' />
    </form>
  </div>
</div>

<script>
  function openpatname() {
    document.getElementById('patname').style.display='block';
  }
      
  function closepatname() {
    document.getElementById('patname').style.display='none';
  }
</script>
";
?>
