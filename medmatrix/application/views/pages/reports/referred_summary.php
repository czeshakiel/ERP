<table width="100%" border="1" cellpadding="1" style="font-size:12px;border-collapse: collapse;">
    <tr>
        <td align="center"></td>
        <td align="center">Name of Patient</td>
        <td align="center">Hospital (referred from)</td>
        <td align="center">Disposition</td>
    </tr>
                                    
	<?php
    	$x=1;
        foreach($body as $patient){
        echo "<tr>
             	<td align='center'>$x.</td>
              	<td align=''>$patient[lastname], $patient[firstname] $patient[suffix] $patient[middlename]</td>
                <td align=''>$patient[hospital]</td>
				<td align=''>$patient[disposition]</td>
			  </tr>";
        $x++;
		}
		?>
</table>
