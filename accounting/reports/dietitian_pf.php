
<form method="POST" action="../printreport/dietitianpf" target="_blank">
<table width="60%">
<tr>
<td>Dietitian: </td>
<td style="text-align: left;"><input type="text" name="report" value="RONQUILLO, MARA VANESSA LAMPON" style="width: 100%;" readonly></td>
</tr>
<tr>
<td>Date From: </td>
<td style="text-align: left;"><input type="date" name="datef" value="<?php echo date("Y-m-d") ?>" style="width: 100%;"></td>
</tr>
<tr>
<td>Date To: </td>
<td style="text-align: left;"><input type="date" name="datet" value="<?php echo date("Y-m-d") ?>" style="width: 100%;"></td>
</tr>
<tr>
<td colspan="2" style="text-align: right;"><br><button name="btnpass" class="btn btn-primary">Submit</button></td>
</tr>
</table>
</form>
