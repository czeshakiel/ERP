

<?php
mysql_connect("localhost","root","b0ykup4l");
mysql_select_db("kmsci");



$nursename=$_GET['nursename'];


$dept1= $_GET['dept'];

$branch= $_GET['branch'];
$month10= $_GET['month'];
$day10= $_GET['day'];
$year10= $_GET['year'];


$onestop= $_GET['onestop'];
$twostop= $_GET['twostop'];
$timearray= $_GET['timearray'];

//mysql_query("DELETE FROM displaypagepharmacy WHERE branch='$branch' ");

//Mark -- 2020-07-08 --<
$ip=$_SERVER['REMOTE_ADDR'];
mysql_query("DELETE FROM displaypagepharmacy WHERE branch='$branch'  AND ip='$ip'");
//Mark -- 2020-07-08 -->



//echo "select caseno,batchno,gross,refno,loginuser,status from productout where   (productsubtype='PHARMACY/MEDICINE' or productsubtype='PHARMACY/SUPPLIES' or productsubtype = 'SALES-SUPPLIES' or productsubtype='GMAP' or productsubtype='VACCINES') and (status='Approved' or status='PAID' or status='requested') and  administration='pending' group by refno ";

$colsql=mysql_query("select caseno,batchno,gross,refno,loginuser,status from productout where   (productsubtype='PHARMACY/MEDICINE' or productsubtype='PHARMACY/SUPPLIES' or productsubtype = 'SALES-SUPPLIES' or productsubtype='GMAP' or productsubtype='VACCINES') and (status='Approved' or status='PAID' or status='requested') and  administration='pending' group by refno ") ;
while($colfetch=mysql_fetch_array($colsql)){
 
  
  $caseno =$colfetch['caseno'];
 $batchno =$colfetch['batchno'];
 $gross =$colfetch['gross'];
 $refno =$colfetch['refno'];
 $loginuser =$colfetch['loginuser'];
 $status =$colfetch['status'];
$prhmsql=mysql_query("SELECT * FROM productouthm WHERE refno='$refno'");
$prhmcount=mysql_num_rows($prhmsql);

if($prhmcount==0){
$pfsql1=mysql_query("SELECT ward,hmo,patientidno,room,dateadmitted,timeadmitted from admission where branch='$branch'  and caseno = '$caseno'  ");
while($pffetch=mysql_fetch_array($pfsql1)){
$patientidno= $pffetch['patientidno'];

 $ward =$pffetch['ward'];
 $hmoname =$pffetch['hmo'];
 $room =$pffetch['room'];
$dateadmitted =$pffetch['dateadmitted'];
$timeadmitted =$pffetch['timeadmitted'];


$pfsql2=mysql_query("SELECT lastname,firstname,middlename from patientprofile where patientidno='$patientidno' ");
while($pffetch=mysql_fetch_array($pfsql2)){

$lastname = $pffetch['lastname'];
$firstname = $pffetch['firstname'];
$middlename = $pffetch['middlename'];





//mysql_query("INSERT INTO displaypagepharmacy (patientidno,caseno,lastname,firstname,middlename,ward,hmo,room,branch,dateadmitted,timeadmitted,batchno,gross,refno,user,type,status) VALUES ('$patientidno', '$caseno', '$lastname','$firstname','$middlename','$ward','$hmoname','$room','$branch','$dateadmitted','$timeadmitted','$batchno','$gross','$refno','$loginuser','MEDICINES','$status')");

//Mark --> 2020-07-08 --<
mysql_query("INSERT INTO displaypagepharmacy (patientidno,caseno,lastname,firstname,middlename,ward,hmo,room,branch,dateadmitted,timeadmitted,batchno,gross,refno,user,type,status,ip) VALUES ('$patientidno', '$caseno', '$lastname','$firstname','$middlename','$ward','$hmoname','$room','$branch','$dateadmitted','$timeadmitted','$batchno','$gross','$refno','$loginuser','MEDICINES','$status','$ip')");
//Mark --> 2020-07-08 -->


}

}
}
}








$colsql=mysql_query("select caseno,productdesc,gross,refno,producttype,status from productout where   date like '%$month10%%$day10%%$year10%'  and  terminalname = 'v' and productsubtype =  'PROFESSIONAL FEE'  group by refno ") ;
while($colfetch=mysql_fetch_array($colsql)){
 
  
  $caseno =$colfetch['caseno'];
 $batchno =$colfetch['productdesc'];
 $gross =$colfetch['gross'];
 $refno =$colfetch['refno'];
 $status =$colfetch['status'];
 $loginuser =$colfetch['producttype'];

$pfsql1=mysql_query("SELECT ward,hmo,patientidno,room,dateadmitted,timeadmitted from admission where branch='$branch'  and caseno = '$caseno'  ");
while($pffetch=mysql_fetch_array($pfsql1)){
$patientidno= $pffetch['patientidno'];

 $ward =$pffetch['ward'];
 $hmoname =$pffetch['hmo'];
 $room =$pffetch['room'];
$dateadmitted =$pffetch['dateadmitted'];
$timeadmitted =$pffetch['timeadmitted'];


$pfsql2=mysql_query("SELECT lastname,firstname,middlename from patientprofile where patientidno='$patientidno' ");
while($pffetch=mysql_fetch_array($pfsql2)){

$lastname = $pffetch['lastname'];
$firstname = $pffetch['firstname'];
$middlename = $pffetch['middlename'];





mysql_query("INSERT INTO displaypagepharmacy (patientidno,caseno,lastname,firstname,middlename,ward,hmo,room,branch,dateadmitted,timeadmitted,batchno,gross,refno,user,type,status)
VALUES ('$patientidno', '$caseno', '$lastname','$firstname','$middlename','$ward','$hmoname','$room','$branch','$dateadmitted','$timeadmitted','$batchno','$gross','$refno','$loginuser','VACCINES','$status')");


}

}}






$pfsql=mysql_query("SELECT ipaddress from ipaddress");
while($pffetch=mysql_fetch_array($pfsql)){
$ipaddress=$pffetch['ipaddress'];
}

$pfsql=mysql_query("SELECT ipaddress from ipconsole");
while($pffetch=mysql_fetch_array($pfsql)){
$ipconf=$pffetch['ipaddress'];
}




$pfsql=mysql_query("SELECT heading from heading where branch='$branch'");
while($pffetch=mysql_fetch_array($pfsql)){
$heading=$pffetch['heading'];
}



$pfsql=mysql_query("SELECT datearray from dateformat");
while($pffetch=mysql_fetch_array($pfsql)){
$datearray=$pffetch['datearray'];
}



$pfsql=mysql_query("SELECT version,versionname,tabname,hospital,banner,logo from version where branch='$branch'");
while($pffetch=mysql_fetch_array($pfsql)){
$version=$pffetch['version'];

$versionname=$pffetch['versionname'];

$tabname=$pffetch['tabname'];

$hospital=$pffetch['hospital'];

$banner=$pffetch['banner'];

$logo=$pffetch['logo'];

}









 


echo " 








"  


  ;

?>





<?php
mysql_connect("localhost","root","b0ykup4l");
mysql_select_db("kmsci");

$zxsql=mysql_query("SELECT rowcount FROM tempsound1 WHERE no='1'");
while($zxfetch=mysql_fetch_array($zxsql)){$rwc=$zxfetch['rowcount'];}


//$colsql=mysql_query("select lastname,firstname,middlename,ward,hmo,room,batchno,sum(gross) as gross,caseno,dateadmitted,user,status from displaypagepharmacy where    branch='$branch' and type ='MEDICINES' group by batchno,caseno order by lastname asc") ;

$colsql=mysql_query("select lastname,firstname,middlename,ward,hmo,room,batchno,sum(gross) as gross,caseno,dateadmitted,user,status from displaypagepharmacy where    branch='$branch' and type ='MEDICINES' and ip = '$ip' group by batchno,caseno order by lastname asc") ;

$asdcount=mysql_num_rows($colsql);

if($rwc!=$asdcount){
//$sound="on";

echo "
<audio autoplay>
  <source src='warning.mp3' type='audio/mpeg'>
</audio>
";

mysql_query("UPDATE `tempsound` SET rowcount='$asdcount' WHERE no='1'");
}
else{
//$sound="off";
}

echo "

 



    <tr>
      <td><table width='100%' border='1' align='center'  cellpadding='0' cellspacing='0' bordercolor='#000000' class='TFtable'>
        <tr>
          <td width='2%' height='20' class='red'><div align='center'></div></td>

            <td width='15%' class='red'><div align='center'>PATIENTS NAME</div></td>

 <td width='1%' class='red'><div align='center'>WARD</div></td>
 <td width='1%' class='red'><div align='center'>ROOM</div></td>

 <td width='5%' class='red'><div align='center'>DATE</div></td>
<td width='10%' class='red'><div align='center'>BATCH NO.</div></td>
<td width='10%' class='red'><div align='center'>USER</div></td>
<td width='10%' class='red'><div align='center'>TRANTYPE</div></td>
<td width='10%' class='red'><div align='center'>STATUS</div></td>
<td width='5%' class='red'><div align='center'>GROSS</div></td>
<td width='5%' class='red'><div align='center'></div></td>
        </tr>


";



$x=1;





while($colfetch=mysql_fetch_array($colsql)){
 
  
  $caseno =$colfetch['caseno'];
  //$productdesc =$colfetch['productdesc'];

  


 $ward =$colfetch['ward'];
 $room =$colfetch['room'];
 $hmoname =$colfetch['hmo'];
 $user =$colfetch['user'];

$lastname = $colfetch['lastname'];
$firstname = $colfetch['firstname'];
$middlename = $colfetch['middlename'];

  $batchno =$colfetch['batchno'];
  $gross =$colfetch['gross'];
  $date =$colfetch['dateadmitted'];
  $status1 =$colfetch['status'];


$colsql1=mysql_query("select trantype from productout where batchno='$batchno'") ;

while($colfetch1=mysql_fetch_array($colsql1)){
$trantype =$colfetch1['trantype'];
}


$namearray = "$lastname".",  "."$firstname"."  "."$middlename";

$arvcol="black";
if($status1 == "requested")
{
$arvcol="red";
}

if($ward == "discharged") {
$ward = "IN";
}
if($ward == "out") {
$ward = "OUT";
}

if($hmoname == "N/A") {
$hmoname = "CASH";
}
if($hmoname == "") {
$hmoname = "CASH";
}

$str = "$namearray";
$patientname = strtoupper($str);

$str = "$loginuser";
$loginuser = strtoupper($str);


//$gross=number_format($gross,"2",".",",");


/// DONT DELETE THIS!! ARVID BACKUP CODE NI....!!!!

//<td class='ARIALLSS' align='center'><a href='http://$ipaddress/2011codes/dispensepharmacy.php?caseno=$caseno&batchno=$batchno&nursename=$nursename&branch=$branch&ward=$ward&timearray=$timearray&dept1=$dept1' target='_newwin'>VIEW</a></td>

//----------------------------------------------------------!!!!!!!!
echo "
    <td class='ARIALLSS'>".$x++.".</td>


    <td class='ARIALLSS' align='left'><font color='$arvcol'>$patientname</font></td>
    <td class='ARIALLSS' align='left'><font color='$arvcol'>$ward</font></td>
    <td class='ARIALLSS' align='center'><font color='$arvcol'>$room</font></td>

    <td class='ARIALLSS' align='left'><font color='$arvcol'>$date</font></td>
    <td class='ARIALLSS' align='center'><font color='$arvcol'>$batchno</font></td>
    <td class='ARIALLSS' align='center'><font color='$arvcol'>$user</font></td>
<td class='ARIALLSS' align='center'><font color='$arvcol'>$trantype</font></td>
    <td class='ARIALLSS' align='center'><font color='$arvcol'>$status1</font></td>
    <td class='ARIALLSS' align='right'><font color='$arvcol'>$gross</font></td>





<td class='ARIALLSS' align='center'><a href='http://$ipaddress/cgi-bin/pharmacydispense2.cgi?ward=$fields[9]&batchno=$batchno&caseno=$caseno&dept1=$dept1&month=$month10&day=$day10&year=$year10&status=$status&nursename=$loginuser&statx=$status1' target='_newwin'>VIEW</a></td>
  </tr>


";

}









mysql_close();
?>


<?php
mysql_connect("localhost","root","b0ykup4l");
mysql_select_db("kmsci");








echo "

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Untitled Document</title>
</head>

<body>
<table width='200' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td></td>  <td></td>
  <td></td>

  </tr>
</table>
</body>
</html>




";
mysql_close();
?>












<?php






echo "
<body>
<table width='350' border='0' cellpadding='0'>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

";

?>

