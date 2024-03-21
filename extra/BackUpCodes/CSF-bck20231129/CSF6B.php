<?php
//claiminfoadd2
mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
mysql_query('SET NAMES utf8');
$cfasql=mysql_query("SELECT doctor7, datesigned7, copay7, doctor8, datesigned8, copay8, doctor9, datesigned9, copay9 FROM claiminfoadd2 WHERE caseno='$caseno'");
$cfacount=mysql_num_rows($cfasql);
if($cfacount==0){
$doctor4="";
$datesigned4="";
$copay4="";
$doctor5="";
$datesigned5="";
$copay5="";
$doctor6="";
$datesigned6="";
$copay6="";
}
else{
while($cfafetch=mysql_fetch_array($cfasql)){
$doctor4=$cfafetch['doctor7'];
$datesigned4=$cfafetch['datesigned7'];
$copay4=$cfafetch['copay7'];
$doctor5=$cfafetch['doctor8'];
$datesigned5=$cfafetch['datesigned8'];
$copay5=$cfafetch['copay8'];
$doctor6=$cfafetch['doctor9'];
$datesigned6=$cfafetch['datesigned9'];
$copay6=$cfafetch['copay9'];
}
}

$dcname4=$doctor4;echo $docname4;

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
mysql_query('SET NAMES utf8');
$dfsql=mysql_query("SELECT phicacc FROM docfile WHERE name like '$dcname4'");
$dfcount=mysql_num_rows($dfsql);
if($dfcount==0){
$phicacc="";

$dclname="";
$dcfname="";
$dcmname="";
$dcsuffix="";

$phicac7="";

$pa10 = "";
$pa11 = "";
$pa12 = "";
$pa13 = "";
$pa14 = "";
$pa15 = "";
$pa16 = "";
$pa17 = "";
$pa18 = "";
$pa19 = "";
$pa110 = "";
$pa111 = "";
$pa112 = "";
$pa113 = "";
}
else{
while($dffetch=mysql_fetch_array($dfsql)){$phicacc=$dffetch['phicacc'];}

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
mysql_query('SET NAMES utf8');
$ddsql=mysql_query("SELECT UPPER(lastname) AS lastname, UPPER(firstname) AS firstname, UPPER(middlename) AS middlename, UPPER(suffix) AS suffix FROM docdetails WHERE phicacc='$phicacc'");
$ddcount=mysql_num_rows($ddsql);
if($ddcount==0){
$dclname="";
$dcfname="";
$dcmname="";
$dcsuffix="";

$phicac7="";

$pa10 = "";
$pa11 = "";
$pa12 = "";
$pa13 = "";
$pa14 = "";
$pa15 = "";
$pa16 = "";
$pa17 = "";
$pa18 = "";
$pa19 = "";
$pa110 = "";
$pa111 = "";
$pa112 = "";
$pa113 = "";
}
else{
while($ddfetch=mysql_fetch_array($ddsql)){
$dclname=$ddfetch['lastname'];
$dcfname=$ddfetch['firstname'];
$dcmname=$ddfetch['middlename'];
$dcsuffix=$ddfetch['suffix'];
}

$phicac7=str_replace("-","",$phicacc);

$pa1 = str_split($phicacc);
$pa10 = $pa1[0];
$pa11 = $pa1[1];
$pa12 = $pa1[2];
$pa13 = $pa1[3];
$pa14 = $pa1[4];
$pa15 = $pa1[5];
$pa16 = $pa1[6];
$pa17 = $pa1[7];
$pa18 = $pa1[8];
$pa19 = $pa1[9];
$pa110 = $pa1[10];
$pa111 = $pa1[11];
$pa112 = $pa1[12];
$pa113 = $pa1[13];
}


}

$pfname4=$dcfname." ".$dcmname." ".$dclname." ".$dcsuffix;

//PF2

$dcname5=$doctor5;

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
mysql_query('SET NAMES utf8');
$df2sql=mysql_query("SELECT phicacc FROM docfile WHERE name='$dcname5'");
$df2count=mysql_num_rows($df2sql);
if($df2count==0){
$phicacc2="";

$dc2lname="";
$dc2fname="";
$dc2mname="";
$dc2suffix="";

$phicac8="";

$pa20 = "";
$pa21 = "";
$pa22 = "";
$pa23 = "";
$pa24 = "";
$pa25 = "";
$pa26 = "";
$pa27 = "";
$pa28 = "";
$pa29 = "";
$pa210 = "";
$pa211 = "";
$pa212 = "";
$pa213 = "";
}
else{
while($df2fetch=mysql_fetch_array($df2sql)){$phicacc2=$df2fetch['phicacc'];}

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
mysql_query('SET NAMES utf8');
$dd2sql=mysql_query("SELECT UPPER(lastname) AS lastname, UPPER(firstname) AS firstname, UPPER(middlename) AS middlename, UPPER(suffix) AS suffix FROM docdetails WHERE phicacc='$phicacc2'");
$dd2count=mysql_num_rows($dd2sql);
if($dd2count==0){
$dc2lname="";
$dc2fname="";
$dc2mname="";
$dc2suffix="";

$phicac8="";

$pa20 = "";
$pa21 = "";
$pa22 = "";
$pa23 = "";
$pa24 = "";
$pa25 = "";
$pa26 = "";
$pa27 = "";
$pa28 = "";
$pa29 = "";
$pa210 = "";
$pa211 = "";
$pa212 = "";
$pa213 = "";
}
else{
while($dd2fetch=mysql_fetch_array($dd2sql)){
$dc2lname=$dd2fetch['lastname'];
$dc2fname=$dd2fetch['firstname'];
$dc2mname=$dd2fetch['middlename'];
$dc2suffix=$dd2fetch['suffix'];
}

$phicac8=str_replace("-","",$phicacc2);

$pa2123 = str_split($phicacc2);
$pa20 = $pa2123[0];
$pa21 = $pa2123[1];
$pa22 = $pa2123[2];
$pa23 = $pa2123[3];
$pa24 = $pa2123[4];
$pa25 = $pa2123[5];
$pa26 = $pa2123[6];
$pa27 = $pa2123[7];
$pa28 = $pa2123[8];
$pa29 = $pa2123[9];
$pa210 = $pa2123[10];
$pa211 = $pa2123[11];
$pa212 = $pa2123[12];
$pa213 = $pa2123[13];
}

}

$pfname5=$dc2fname." ".$dc2mname." ".$dc2lname." ".$dc2suffix;

//PF3

$dcname6=$doctor6;

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
mysql_query('SET NAMES utf8');
$df3sql=mysql_query("SELECT phicacc FROM docfile WHERE name='$dcname6'");
$df3count=mysql_num_rows($df3sql);
if($df3count==0){
$phicacc3="";

$dc3lname="";
$dc3fname="";
$dc3mname="";
$dc3suffix="";

$phicac9="";

$pa30 = "";
$pa31 = "";
$pa32 = "";
$pa33 = "";
$pa34 = "";
$pa35 = "";
$pa36 = "";
$pa37 = "";
$pa38 = "";
$pa39 = "";
$pa310 = "";
$pa311 = "";
$pa312 = "";
$pa313 = "";
}
else{
while($df3fetch=mysql_fetch_array($df3sql)){$phicacc3=$df3fetch['phicacc'];}

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
mysql_query('SET NAMES utf8');
$dd3sql=mysql_query("SELECT UPPER(lastname) AS lastname, UPPER(firstname) AS firstname, UPPER(middlename) AS middlename, UPPER(suffix) AS suffix FROM docdetails WHERE phicacc='$phicacc3'");
$dd3count=mysql_num_rows($dd3sql);
if($dd3count==0){
$dc3lname="";
$dc3fname="";
$dc3mname="";
$dc3suffix="";

$phicac9="";

$pa30 = "";
$pa31 = "";
$pa32 = "";
$pa33 = "";
$pa34 = "";
$pa35 = "";
$pa36 = "";
$pa37 = "";
$pa38 = "";
$pa39 = "";
$pa310 = "";
$pa311 = "";
$pa312 = "";
$pa313 = "";
}
else{
while($dd3fetch=mysql_fetch_array($dd3sql)){
$dc3lname=$dd3fetch['lastname'];
$dc3fname=$dd3fetch['firstname'];
$dc3mname=$dd3fetch['middlename'];
$dc3suffix=$dd3fetch['suffix'];
}

$phicac9=str_replace("-","",$phicacc3);

$pa3123 = str_split($phicacc3);
$pa30 = $pa3123[0];
$pa31 = $pa3123[1];
$pa32 = $pa3123[2];
$pa33 = $pa3123[3];
$pa34 = $pa3123[4];
$pa35 = $pa3123[5];
$pa36 = $pa3123[6];
$pa37 = $pa3123[7];
$pa38 = $pa3123[8];
$pa39 = $pa3123[9];
$pa310 = $pa3123[10];
$pa311 = $pa3123[11];
$pa312 = $pa3123[12];
$pa313 = $pa3123[13];
}

}

$pfname6=$dc3fname." ".$dc3mname." ".$dc3lname." ".$dc3suffix;


//Date Signed--------------------------------------------------------------------------------------
$pfdatesigned4 = date("m-d-Y",strtotime($datesigned4));

$pfdatesiarr=str_split($pfdatesigned4);

if(($datesigned4!="")&&($datesigned4!="0000-00-00")){
$pfdatesiarr0 = $pfdatesiarr[0];
$pfdatesiarr1 = $pfdatesiarr[1];
$pfdatesiarr3 = $pfdatesiarr[3];
$pfdatesiarr4 = $pfdatesiarr[4];
$pfdatesiarr6 = $pfdatesiarr[6];
$pfdatesiarr7 = $pfdatesiarr[7];
$pfdatesiarr8 = $pfdatesiarr[8];
$pfdatesiarr9 = $pfdatesiarr[9];

$pfdatesiarrf = $pfdatesigned4;
}
else{
$pfdatesiarr0 = "";
$pfdatesiarr1 = "";
$pfdatesiarr3 = "";
$pfdatesiarr4 = "";
$pfdatesiarr6 = "";
$pfdatesiarr7 = "";
$pfdatesiarr8 = "";
$pfdatesiarr9 = "";

$pfdatesiarrf = "";
}


$pfdatesigned5 = date("m-d-Y",strtotime($datesigned5));

$pfdatesiarr2111=str_split($pfdatesigned5);

if(($datesigned5!="")&&($datesigned5!="0000-00-00")){
$pfdatesiarr20 = $pfdatesiarr2111[0];
$pfdatesiarr21 = $pfdatesiarr2111[1];
$pfdatesiarr23 = $pfdatesiarr2111[3];
$pfdatesiarr24 = $pfdatesiarr2111[4];
$pfdatesiarr26 = $pfdatesiarr2111[6];
$pfdatesiarr27 = $pfdatesiarr2111[7];
$pfdatesiarr28 = $pfdatesiarr2111[8];
$pfdatesiarr29 = $pfdatesiarr2111[9];

$pfdatesiarr2f = $pfdatesigned5;
}
else{
$pfdatesiarr20 = "";
$pfdatesiarr21 = "";
$pfdatesiarr23 = "";
$pfdatesiarr24 = "";
$pfdatesiarr26 = "";
$pfdatesiarr27 = "";
$pfdatesiarr28 = "";
$pfdatesiarr29 = "";

$pfdatesiarr2f = "";
}


$pfdatesigned6 = date("m-d-Y",strtotime($datesigned6));

$pfdatesiarr3111=str_split($pfdatesigned6);

if(($datesigned6!="")&&($datesigned6!="0000-00-00")){
$pfdatesiarr30 = $pfdatesiarr3111[0];
$pfdatesiarr31 = $pfdatesiarr3111[1];
$pfdatesiarr33 = $pfdatesiarr3111[3];
$pfdatesiarr34 = $pfdatesiarr3111[4];
$pfdatesiarr36 = $pfdatesiarr3111[6];
$pfdatesiarr37 = $pfdatesiarr3111[7];
$pfdatesiarr38 = $pfdatesiarr3111[8];
$pfdatesiarr39 = $pfdatesiarr3111[9];

$pfdatesiarr3f = $pfdatesigned6;
}
else{
$pfdatesiarr30 = "";
$pfdatesiarr31 = "";
$pfdatesiarr33 = "";
$pfdatesiarr34 = "";
$pfdatesiarr36 = "";
$pfdatesiarr37 = "";
$pfdatesiarr38 = "";
$pfdatesiarr39 = "";

$pfdatesiarr3f = "";
}

if(trim($pfname4)!=""){$pre4="DR.";}else{$pre4="";}
if(trim($pfname5)!=""){$pre5="DR.";}else{$pre5="";}
if(trim($pfname6)!=""){$pre6="DR.";}else{$pre6="";}

//$phicac7="";
//$phicac8="";
//$phicac9="";

if(getBrowser()!="Firefox"){
  if(file_exists("Sig/".$phicac7."_".$dnum.".png")){
    echo "<img src='Sig/".$phicac7."_".$dnum.".png' style='position: absolute;left: 270px;top: 1320px;width: auto;height: 75px;' alt='$phicac7'  />";
  }

  if(file_exists("Sig/".$phicac8."_".$dnum.".png")){
    echo "<img src='Sig/".$phicac8."_".$dnum.".png' style='position: absolute;left: 160px;top: 1355px;width: auto;height: 75px;' alt='$phicac8'  />";
  }

  if(file_exists("Sig/".$phicac9."_".$dnum.".png")){
    echo "<img src='Sig/".$phicac9."_".$dnum.".png' style='position: absolute;left: 270px;top: 1380px;width: auto;height: 75px;' alt='$phicac9'  />";
  }
}

echo "
    <!-- PART IV - HEALTH CARE PROFESSIONAL INFORMATION -->
    <table width='750' border='0' cellpadding='0' cellspacing='0'>
      <tbody>
        <tr>
          <td height='3'></td>
        </tr>
        <tr>
          <td $cursty onclick='myFunction82()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='auto'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td rowspan='2'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td colspan='5' align='left' class='tahoma s8 black'>Accreditation No.&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa10</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa11</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa12</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa13</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa15</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa16</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa17</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa18</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa19</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa110</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa111</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa113</div></td>
                    </tr>
                  </table></td>
                  <td width='10'>&nbsp;</td>
                  <td width='240' class='bottomboxborder' align='center' valign='middle'>$pre4 $pfname4</td>
                  <td width='10'>&nbsp;</td>
                  <td rowspan='2'><table border='0' cellpadding='0' cellspacing='0'>
                    <!-- tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr0</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr1</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr3</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr4</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr6</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr7</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr6</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr9</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td colspan='2' valign='top' align='center' class='tahoma s8 black'>month</td>
                      <td></td>
                      <td colspan='2' valign='top' align='center' class='tahoma s8 black'>day</td>
                      <td></td>
                      <td colspan='4' valign='top' align='center' class='tahoma s8 black1'>year</td>
                    </tr -->
                    <tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='140' height='18' class='b1 l1 r1'><div align='center' class='tahoma s12 black'>$pfdatesiarrf</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td valign='top' align='center' class='tahoma s8 black'>month day year</td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td></td>
                  <td><div align='center' class='tahoma s8 black'>Signature Over Printed Name</div></td>
                  <td></td>
                </tr>
              </table></td>
              <td width='7'></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='3'></td>
        </tr>
        <tr>
          <td $cursty onclick='myFunction82()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='auto'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td rowspan='2'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td colspan='5' align='left' class='tahoma s8 black'>Accreditation No.&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa20</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa21</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa22</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa23</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa25</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa26</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa27</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa28</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa29</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa210</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa211</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa213</div></td>
                    </tr>
                  </table></td>
                  <td width='10'>&nbsp;</td>
                  <td width='240' class='bottomboxborder' align='center' valign='middle'>$pre5 $pfname5</td>
                  <td width='10'>&nbsp;</td>
                  <td rowspan='2'><table border='0' cellpadding='0' cellspacing='0'>
                    <!-- tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr20</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr21</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr23</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr24</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr26</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr27</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr26</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr29</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td colspan='2' valign='top' align='center' class='tahoma s8 black'>month</td>
                      <td></td>
                      <td colspan='2' valign='top' align='center' class='tahoma s8 black'>day</td>
                      <td></td>
                      <td colspan='4' valign='top' align='center' class='tahoma s8 black1'>year</td>
                    </tr -->
                    <tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='140' height='18' class='b1 l1 r1'><div align='center' class='tahoma s12 black'>$pfdatesiarr2f</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td valign='top' align='center' class='tahoma s8 black'>month day year</td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td></td>
                  <td><div align='center' class='tahoma s8 black'>Signature Over Printed Name</div></td>
                  <td></td>
                </tr>
              </table></td>
              <td width='7'></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='3'></td>
        </tr>
        <tr>
          <td $cursty onclick='myFunction82()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='auto'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td rowspan='2'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td colspan='5' align='left' class='tahoma s8 black'>Accreditation No.&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa30</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa31</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa32</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa33</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa35</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa36</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa37</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa38</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa39</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa310</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa311</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa313</div></td>
                    </tr>
                  </table></td>
                  <td width='10'>&nbsp;</td>
                  <td width='240' class='bottomboxborder' align='center' valign='middle'>$pre6 $pfname6</td>
                  <td width='10'>&nbsp;</td>
                  <td rowspan='2'><table border='0' cellpadding='0' cellspacing='0'>
                    <!-- tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr30</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr31</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr33</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr34</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr36</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr37</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr36</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr39</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td colspan='2' valign='top' align='center' class='tahoma s8 black'>month</td>
                      <td></td>
                      <td colspan='2' valign='top' align='center' class='tahoma s8 black'>day</td>
                      <td></td>
                      <td colspan='4' valign='top' align='center' class='tahoma s8 black1'>year</td>
                    </tr -->
                    <tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='140' height='18' class='b1 l1 r1'><div align='center' class='tahoma s12 black'>$pfdatesiarr3f</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td valign='top' align='center' class='tahoma s8 black'>month day year</td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td></td>
                  <td><div align='center' class='tahoma s8 black'>Signature Over Printed Name</div></td>
                  <td></td>
                </tr>
              </table></td>
              <td width='7'></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='3'></td>
        </tr>
      </tbody>
    </table>

<script>
function myFunction82() {
  window.open('AddEditProfDetailsMorePlus.php?caseno=$caseno', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=700');
}
</script>
";
?>
