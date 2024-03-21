<?php
//AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
if(empty($_POST["heent"])){
}
else{
//A. Check For Errors--------
  $essa=0;
  $otha=0;
  $alla=0;
  $erra=0;
  foreach ($_POST['heent'] as $keyacheck => $valueacheck) {
    if($valueacheck=="11"){$essa+=1;}
    elseif($valueacheck=="99"){$otha+=1;}
    else{$alla+=1;}
  }

  if(($essa>0)&&(($otha>0)||($alla>0))){

echo "
  <span class='arial16redbold'>Error!!! You need to <span style='color: black;'>uncheck</span> <u><span style='color: black;'>Essentially normal</span></u> if other options are checked!!! (A. HEENT)</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";

    $erra+=1;
  }
  else{
    if(($otha>0)&&($aa=="")){

echo "
  <span class='arial16redbold'>Error!!! Remarks cannot be blank if <u><span style='color: black;'>Others</span></u> is <span style='color: black;'>checked</span>!!! (A. HEENT)</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";

      $erra+=1;
    }
  }
//A. End Check For Errors----
}

//BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB
if(empty($_POST["chest"])){
}
else{
//B. Check For Errors--------
  $essb=0;
  $othb=0;
  $allb=0;
  $errb=0;
  foreach ($_POST['chest'] as $keybcheck => $valuebcheck) {
    if($valuebcheck=="6"){$essb+=1;}
    elseif($valuebcheck=="99"){$othb+=1;}
    else{$allb+=1;}
  }

  if(($essb>0)&&(($othb>0)||($allb>0))){

echo "
  <span class='arial16redbold'>Error!!! You need to <span style='color: black;'>uncheck</span> <u><span style='color: black;'>Essentially normal</span></u> if other options are checked!!! (B. Chest/Lungs)</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";

    $errb+=1;
  }
  else{
    if(($othb>0)&&($bb=="")){

echo "
  <span class='arial16redbold'>Error!!! Remarks cannot be blank if <u><span style='color: black;'>Others</span></u> is <span style='color: black;'>checked</span>!!! (B. Chest/Lungs)</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";

      $errb+=1;
    }
  }
//B. End Check For Errors----
}

//CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC
if(empty($_POST["heart"])){
}
else{
//C. Check For Errors--------
  $essc=0;
  $othc=0;
  $allc=0;
  $errc=0;
  foreach ($_POST['heart'] as $keyccheck => $valueccheck) {
    if($valueccheck=="5"){$essc+=1;}
    elseif($valueccheck=="99"){$othc+=1;}
    else{$allc+=1;}
  }

  if(($essc>0)&&(($othc>0)||($allc>0))){

echo "
  <span class='arial16redbold'>Error!!! You need to <span style='color: black;'>uncheck</span> <u><span style='color: black;'>Essentially normal</span></u> if other options are checked!!! (C. CVS)</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";

    $errc+=1;
  }
  else{
    if(($othc>0)&&($cc=="")){

echo "
  <span class='arial16redbold'>Error!!! Remarks cannot be blank if <u><span style='color: black;'>Others</span></u> is <span style='color: black;'>checked</span>!!! (C. CVS)</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";

      $errc+=1;
    }
  }
//C. End Check For Errors----
}

//DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD
if(empty($_POST["abdomen"])){
}
else{
//D. Check For Errors--------
  $essd=0;
  $othd=0;
  $alld=0;
  $errd=0;
  foreach ($_POST['abdomen'] as $keydcheck => $valuedcheck) {
    if($valuedcheck=="7"){$essd+=1;}
    elseif($valuedcheck=="99"){$othd+=1;}
    else{$alld+=1;}
  }

  if(($essd>0)&&(($othd>0)||($alld>0))){

echo "
  <span class='arial16redbold'>Error!!! You need to <span style='color: black;'>uncheck</span> <u><span style='color: black;'>Essentially normal</span></u> if other options are checked!!! (D. Abdomen)</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";

    $errd+=1;
  }
  else{
    if(($othd>0)&&($dd=="")){

echo "
  <span class='arial16redbold'>Error!!! Remarks cannot be blank if <u><span style='color: black;'>Others</span></u> is <span style='color: black;'>checked</span>!!! (D. Abdomen)</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";

      $errd+=1;
    }
  }
//D. End Check For Errors----
}

//EEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
if(empty($_POST["genitourinary"])){
}
else{
//E. Check For Errors--------
  $esse=0;
  $othe=0;
  $alle=0;
  $erre=0;
  foreach ($_POST['genitourinary'] as $keyecheck => $valueecheck) {
    if($valueecheck=="1"){$esse+=1;}
    elseif($valueecheck=="99"){$othe+=1;}
    else{$alle+=1;}
  }

  if(($esse>0)&&(($othe>0)||($alle>0))){

echo "
  <span class='arial16redbold'>Error!!! You need to <span style='color: black;'>uncheck</span> <u><span style='color: black;'>Essentially normal</span></u> if other options are checked!!! (E. GU (IE))</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";

    $erre+=1;
  }
  else{
    if(($othe>0)&&($ee=="")){

echo "
  <span class='arial16redbold'>Error!!! Remarks cannot be blank if <u><span style='color: black;'>Others</span></u> is <span style='color: black;'>checked</span>!!! (E. GU (IE))</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";

      $erre+=1;
    }
  }
//E. End Check For Errors----
}

//FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
if(empty($_POST["skinExtremities"])){
}
else{
//F. Check For Errors--------
  $essf=0;
  $othf=0;
  $allf=0;
  $errf=0;
  foreach ($_POST['skinExtremities'] as $keyfcheck => $valuefcheck) {
    if($valuefcheck=="1"){$essf+=1;}
    elseif($valuefcheck=="99"){$othf+=1;}
    else{$allf+=1;}
  }

  if(($essf>0)&&(($othf>0)||($allf>0))){

echo "
  <span class='arial16redbold'>Error!!! You need to <span style='color: black;'>uncheck</span> <u><span style='color: black;'>Essentially normal</span></u> if other options are checked!!! (F. Skin/Extremities)</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";

    $errf+=1;
  }
  else{
    if(($othf>0)&&($ff=="")){

echo "
  <span class='arial16redbold'>Error!!! Remarks cannot be blank if <u><span style='color: black;'>Others</span></u> is <span style='color: black;'>checked</span>!!! (F. Skin/Extremities)</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";

      $errf+=1;
    }
  }
//F. End Check For Errors----
}

//GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
if(empty($_POST["neuro"])){
}
else{
//F. Check For Errors--------
  $essg=0;
  $othg=0;
  $allg=0;
  $errg=0;
  foreach ($_POST['neuro'] as $keygcheck => $valuegcheck) {
    if($valuegcheck=="6"){$essg+=1;}
    elseif($valuegcheck=="99"){$othg+=1;}
    else{$allg+=1;}
  }

  if(($essg>0)&&(($othg>0)||($allg>0))){

echo "
  <span class='arial16redbold'>Error!!! You need to <span style='color: black;'>uncheck</span> <u><span style='color: black;'>Essentially normal</span></u> if other options are checked!!! (G. Neurological Examination)</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";

    $errg+=1;
  }
  else{
    if(($othg>0)&&($gg=="")){

echo "
  <span class='arial16redbold'>Error!!! Remarks cannot be blank if <u><span style='color: black;'>Others</span></u> is <span style='color: black;'>checked</span>!!! (G. Neurological Examination)</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";

      $errg+=1;
    }
  }
//F. End Check For Errors----
}
?>
