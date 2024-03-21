<div>
	<table width="100%" border="1" cellpadding="2" cellspacing="0" style="font-size:12px;border-collapse: collapse;">
                        <tr>
                            <td colspan="2" rowspan="2" align="center">Cause of Morbidity (Underlying)</td>
                            <td colspan="34" align="center">Age of Distribution of Patients</td>
                            <td rowspan="3" align="center">Total</td>
                            <td rowspan="3" align="center">ICD-10 CODE/TABULAR LIST</td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">Under 1</td>
                            <td colspan="2" align="center">1 - 4</td>
                            <td colspan="2" align="center">5 - 9</td>
                            <td colspan="2" align="center">10 - 14</td>
                            <td colspan="2" align="center">15 - 19</td>
                            <td colspan="2" align="center">20 - 24</td>
                            <td colspan="2" align="center">25 - 29</td>
                            <td colspan="2" align="center">30 - 34</td>
                            <td colspan="2" align="center">35 - 39</td>
                            <td colspan="2" align="center">40 - 44</td>
                            <td colspan="2" align="center">45 - 49</td>
                            <td colspan="2" align="center">50 - 54</td>
                            <td colspan="2" align="center">55 - 59</td>
                            <td colspan="2" align="center">60 - 64</td>
                            <td colspan="2" align="center">65 - 69</td>
                            <td colspan="2" align="center">70 & over</td>
                            <td colspan="2" align="center">Subtotal</td>
                        </tr>
                        <tr>
                            <td colspan="2">Spell out. Do not abbreviate.</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                            <td align="center">M</td>
                            <td align="center">F</td>
                        </tr>                                                
                        <?php
                        $x=1;
                        foreach($body as $row){
            $munder1=0;$funder1=0;$m1to4=0;$f1to4=0;$m5to9=0;$f5to9=0;$m10to14=0;$f10to14=0;$m15to19=0;$f15to19=0;$m20to24=0;$f20to24=0;$m25to29=0;$f25to29=0;
            $m30to34=0;$f30to34=0;$m35to39=0;$f35to39=0;$m40to44=0;$f40to44=0;$m45to49=0;$f45to49=0;$m50to54=0;$f50to54=0;$m55to59=0;$f55to59=0;$m60to64=0;$f60to64=0;
            $m65to69=0;$f65to69=0;$m70over=0;$f70over=0;$msubtotal=0;$fsubtotal=0;$grandtotal=0;
                                $querycount=$this->Records_model->checkTopDisease($row['icd10code'],$startdate,$enddate);
                                foreach($querycount as $count){
                                $munder1 += $count['munder1'];
                                $funder1 += $count['funder1'];
                                $m1to4 += $count['m1to4'];
                                $f1to4 += $count['f1to4'];
                                $m5to9 += $count['m5to9'];
                                $f5to9 += $count['f5to9'];
                                $m10to14 += $count['m10to14'];
                                $f10to14 += $count['f10to14'];
                                $m15to19 += $count['m15to19'];
                                $f15to19 += $count['f15to19'];
                                $m20to24 += $count['m20to24'];
                                $f20to24 += $count['f20to24'];
                                $m25to29 += $count['m25to29'];
                                $f25to29 += $count['f25to29'];
                                $m30to34 += $count['m30to34'];
                                $f30to34 += $count['f30to34'];
                                $m35to39 += $count['m35to39'];
                                $f35to39 += $count['f35to39'];
                                $m40to44 += $count['m40to44'];
                                $f40to44 += $count['f40to44'];
                                $m45to49 += $count['m45to49'];
                                $f45to49 += $count['f45to49'];
                                $m50to54 += $count['m50to54'];
                                $f50to54 += $count['f50to54'];
                                $m55to59 += $count['m55to59'];
                                $f55to59 += $count['f55to59'];
                                $m60to64 += $count['m60to64'];
                                $f60to64 += $count['f60to64'];
                                $m65to69 += $count['m65to69'];
                                $f65to69 += $count['f65to69'];
                                $m70over += $count['m70over'];
                                $f70over += $count['f70over'];
                                $msubtotal =$munder1+$m1to4+$m5to9+$m10to14+$m15to19+$m20to24+$m25to29+$m30to34+$m35to39+$m40to44+$m45to49+$m50to54+$m55to59+$m60to64+$m65to69+$m70over;
                                $fsubtotal =$funder1+$f1to4+$f5to9+$f10to14+$f15to19+$f20to24+$f25to29+$f30to34+$f35to39+$f40to44+$f45to49+$f50to54+$f55to59+$f60to64+$f65to69+$f70over;                                
                                }                                                             
                                $grandtotal = $msubtotal+$fsubtotal;
                                echo "<tr>";
                                    echo "<td>$x.</td>";
                                    echo "<td>$row[icd10desc]</td>";                                    
                                    echo "
                                    <td align='center'>$munder1</td>
                                    <td align='center'>$funder1</td>
                                    <td align='center'>$m1to4</td>
                                    <td align='center'>$f1to4</td>
                                    <td align='center'>$m5to9</td>
                                    <td align='center'>$f5to9</td>
                                    <td align='center'>$m10to14</td>
                                    <td align='center'>$f10to14</td>
                                    <td align='center'>$m15to19</td>
                                    <td align='center'>$f15to19</td>
                                    <td align='center'>$m20to24</td>
                                    <td align='center'>$f20to24</td>
                                    <td align='center'>$m25to29</td>
                                    <td align='center'>$f25to29</td>
                                    <td align='center'>$m30to34</td>
                                    <td align='center'>$f30to34</td>
                                    <td align='center'>$m35to39</td>
                                    <td align='center'>$f35to39</td>
                                    <td align='center'>$m40to44</td>
                                    <td align='center'>$f40to44</td>
                                    <td align='center'>$m45to49</td>
                                    <td align='center'>$f45to49</td>
                                    <td align='center'>$m50to54</td>
                                    <td align='center'>$f50to54</td>
                                    <td align='center'>$m55to59</td>
                                    <td align='center'>$f55to59</td>
                                    <td align='center'>$m60to64</td>
                                    <td align='center'>$f60to64</td>
                                    <td align='center'>$m65to69</td>
                                    <td align='center'>$f65to69</td>
                                    <td align='center'>$m70over</td>
                                    <td align='center'>$f70over</td>                                    
                                    ";
                                    echo "<td align='center'>$msubtotal</td>";
                                    echo "<td align='center'>$fsubtotal</td>";
                                    echo "<td align='center'>$row[topnumber]</td>";
                                    echo "<td align='center'>$row[icd10code]</td>";
                                echo "</tr>";
                                $x++;
                            }                                                    
                        ?>                        
                    </table>
</div>
