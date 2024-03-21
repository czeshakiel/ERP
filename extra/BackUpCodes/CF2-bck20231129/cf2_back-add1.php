<?php
mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$all=fopen("../2017codes/SOA/Logs/$caseno.txt", "r") or die("Unable to open file!");
$allres=trim(fgets($all));
fclose($all);

$alls=preg_split("/\<>/",$allres);

$hrs=preg_split("/\|/",$alls[0]);

$prs=preg_split("/\|/",$alls[2]);

$pdrs=preg_split("/\|/",$alls[1]);

//finalcaserates------------------------------------------------
$toths=0;
$totps=0;
$fcsql=mysql_query("SELECT * FROM finalcaserate WHERE caseno='$caseno' AND (level='primary' OR level='secondary')");
while($fcfetch=mysql_fetch_array($fcsql)){
$hs=$fcfetch['hospitalshare'];
$ps=$fcfetch['pfshare'];

$toths+=$hs;
$totps+=$ps;
}//echo "<br />".$toths."-->".$totps;
//---------------------------------------------------------

$hact=$hrs[0];
$hadj=$hrs[1];

$hnet=$hact-$hadj;
$hexc=$hnet-$toths;
//echo "<br />".$hnet."-->".$hexc;

$pact=$prs[0];
$padj=$prs[1];

$pnet=$pact-$padj;
$pexc=$pnet-$totps;
//echo "<br />".$pnet."-->".$pexc;

$totalactual=$hact+$pact;
$totphic=$toths+$totps;
//echo "<br />".$totalactual."-->".$totphic;

//PART III. CERTIFICATION OF CONSUMPTION OF BENEFITS AND CONSENT TO ACCESS PATIENT RECORD/S
$totleft=$totalactual-$totphic;
//echo "<br />".$totleft;
if($totleft<=0){
//echo "<br />A";
//No Excess
$certcon1="&#10003;";
$certcon2="";

$hospactual="";
$profactual="";

$hosplessdisc="";
$proflessdisc="";

$hospphicben="";
$profphicben="";

$hospnet="";
$hospmempat="";

$profnet="";
$profmempat="";

//Total Actual Charges*
$TotalHealthCareInstitutionFees=number_format($hact,2,'.',',');
$TotalProfessionalFees=number_format($pact,2,'.',',');
$GrandTotal=number_format($totalactual,2,'.',',');
}
else if($totleft>0){
//echo "<br />B";
//With Excess
$certcon1="";
$certcon2="&#10003;";

//Total Actual Charges*
$TotalHealthCareInstitutionFees="";
$TotalProfessionalFees="";
$GrandTotal="";

$hospactual=number_format($hact,2,'.',',');
$profactual=number_format($pact,2,'.',',');

$hosplessdisc=number_format(($hact-$hadj),2,'.',',');
$proflessdisc=number_format(($pact-$padj),2,'.',',');

$hospphicben=number_format($toths,2,'.',',');
$profphicben=number_format($totps,2,'.',',');

if(($hact-$hadj-$toths)>0){
  $hospnet=number_format(($hact-$hadj-$toths),2,'.',',');
  $hospmempat="<img src='Resources/Pictures/check.png' height='10' width='auto' />";
}
else{
  $hospnet="";
  $hospmempat="";
}

if(($pact-$padj-$totps)>0){
  $profnet=number_format(($pact-$padj-$totps),2,'.',',');
  $profmempat="<img src='Resources/Pictures/check.png' height='10' width='auto' />";
}
else{
  $profnet="";
  $profmempat="";
}

}

$purchase1="<img src='Resources/Pictures/check.png' height='10' width='auto' />";
$purchase2="<img src='Resources/Pictures/check.png' height='10' width='auto' />";

?>
