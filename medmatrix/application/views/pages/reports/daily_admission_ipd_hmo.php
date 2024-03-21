<table width="100%" border="1" cellspacing="0" cellpadding="2" style="border-collapse: collapse; font-size: 12px;">
    <tr>
        <td align="center"><b>STATION/ROOM</b></td>
        <td align="center"><b>NAME OF PATIENT</b></td>
        <td align="center"><b>HMO</b></td>
        <td align="center"><b>NAME OF WATCHER</b></td>
        <td align="center"><b>SIGNATURE</b></td>
        <td align="center"><b>REMARKS</b></td>
    </tr>
<?php    
    if(count($ns1)>0){
    echo "<tr>";
        echo "<td colspan='6'><b>Nurse Station 1</b></td>";
    echo "</tr>";    
    foreach($ns1 as $item){
        echo "<tr>";
            echo "<td>$item[room]</td>";
            echo "<td>$item[patientname]</td>";
            echo "<td align='center'>$item[hmo]</td>";
            echo "<td>$item[middlenamed]</td>";
            echo "<td></td>";
            echo "<td></td>";
        echo "</tr>";
    }
}
if(count($ns2)>0){
    echo "<tr>";
        echo "<td colspan='6'><b>Nurse Station 2</b></td>";
    echo "</tr>";
    foreach($ns2 as $item){
        echo "<tr>";
            echo "<td>$item[room]</td>";
            echo "<td>$item[patientname]</td>";
            echo "<td align='center'>$item[hmo]</td>";
            echo "<td>$item[middlenamed]</td>";
            echo "<td></td>";
            echo "<td></td>";
        echo "</tr>";
    }
}
if(count($ns3)>0){
    echo "<tr>";
        echo "<td colspan='6'><b>Nurse Station 3</b></td>";
    echo "</tr>";
    foreach($ns3 as $item){
        echo "<tr>";
            echo "<td>$item[room]</td>";
            echo "<td>$item[patientname]</td>";
            echo "<td align='center'>$item[hmo]</td>";
            echo "<td>$item[middlenamed]</td>";
            echo "<td></td>";
            echo "<td></td>";
        echo "</tr>";
    }
}
if(count($ns5a)>0){
    echo "<tr>";
        echo "<td colspan='6'><b>Nurse Station 5A</b></td>";
    echo "</tr>";
    foreach($ns5a as $item){
        echo "<tr>";
            echo "<td>$item[room]</td>";
            echo "<td>$item[patientname]</td>";
            echo "<td align='center'>$item[hmo]</td>";
            echo "<td>$item[middlenamed]</td>";
            echo "<td></td>";
            echo "<td></td>";
        echo "</tr>";
    }
}
if(count($ns5b)>0){
    echo "<tr>";
        echo "<td colspan='6'><b>Nurse Station 5B</b></td>";
    echo "</tr>";
    foreach($ns5b as $item){
        echo "<tr>";
            echo "<td>$item[room]</td>";
            echo "<td>$item[patientname]</td>";
            echo "<td align='center'>$item[hmo]</td>";
            echo "<td>$item[middlenamed]</td>";
            echo "<td></td>";
            echo "<td></td>";
        echo "</tr>";
    }
}
if(count($ns6)>0){
    echo "<tr>";
        echo "<td colspan='6'><b>Nurse Station 6</b></td>";
    echo "</tr>";
    foreach($ns6 as $item){
        echo "<tr>";
            echo "<td>$item[room]</td>";
            echo "<td>$item[patientname]</td>";
            echo "<td align='center'>$item[hmo]</td>";
            echo "<td>$item[middlenamed]</td>";
            echo "<td></td>";
            echo "<td></td>";
        echo "</tr>";
    }
}
if(count($icu)>0){
    echo "<tr>";
        echo "<td colspan='6'><b>Intensive Care Unit</b></td>";
    echo "</tr>";
    foreach($icu as $item){
        echo "<tr>";
            echo "<td>$item[room]</td>";
            echo "<td>$item[patientname]</td>";
            echo "<td align='center'>$item[hmo]</td>";
            echo "<td>$item[middlenamed]</td>";
            echo "<td></td>";
            echo "<td></td>";
        echo "</tr>";
    }
}
if(count($nicu)>0){
    echo "<tr>";
        echo "<td colspan='6'><b>Special Care Unit</b></td>";
    echo "</tr>";
    foreach($nicu as $item){
        echo "<tr>";
            echo "<td>$item[room]</td>";
            echo "<td>$item[patientname]</td>";
            echo "<td align='center'>$item[hmo]</td>";
            echo "<td>$item[middlenamed]</td>";
            echo "<td></td>";
            echo "<td></td>";
        echo "</tr>";
    }
}
?>
</table>