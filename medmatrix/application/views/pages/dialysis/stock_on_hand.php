<table width="100%" border="1" style="font-size:12px; border-collapse: collapse">
	<tr>
		<td align='center'>CODE</td>
		<td align='center'>DESCRIPTION</td>
		<td align='center'>STOCK ON HAND</td>
	</tr>
	<?php
	foreach($items as $item){
		echo
		"<tr>
             <td>$item[code]</td>
             <td>$item[itemname]</td>
             <td align='center'>$item[soh]</td>
        </tr>
        ";
	}
	?>
</table>
