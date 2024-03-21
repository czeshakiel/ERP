
<form method="POST" action="../printreport/pfexcess" target="_blank">
<table width="60%">
<tr>
<td>Doctor: </td>
<td style="text-align: left;">
<select name="doc" class="form-control select2-single">
<?php
echo"<option value='ALL'>ALL</option>";
$ss = $conn->query("select * from docfile order by name");
while($ss1=$ss->fetch_assoc()){
$code = $ss1['code'];
$name = $ss1['name'];
echo"<option value='$code'>$name</option>";
}
?>
</select>
</td>
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
