<?php
  $clientProps=array('screen.width','screen.height','window.innerWidth','window.innerHeight',
    'window.outerWidth','window.outerHeight','screen.colorDepth','screen.pixelDepth');

  if(! isset($_POST['screenheight'])){

    echo "<form method='POST' id='data' style='display:none'>";
    foreach($clientProps as $p) {  //create hidden form
      echo "<input type='text' id='".str_replace('.','',$p)."' name='".str_replace('.','',$p)."'>";
    }
    if(isset($_POST['savedata'])){
      $setno=mysqli_real_escape_string($mycon,$_POST['no']);
      $setplantype=mysqli_real_escape_string($mycon,$_POST['plantype']);
      $setdueamount=mysqli_real_escape_string($mycon,$_POST['dueamount']);
      $setinsamount=mysqli_real_escape_string($mycon,$_POST['insamount']);
      $seteffdate=mysqli_real_escape_string($mycon,$_POST['effdate']);
      $setpremium=mysqli_real_escape_string($mycon,$_POST['premium']);
      $setterms=mysqli_real_escape_string($mycon,$_POST['terms']);
      $setinstype=mysqli_real_escape_string($mycon,$_POST['instype']);

      echo "<input type='hidden' name='no' value='$setno' />";
      echo "<input type='hidden' name='plantype' value='$setplantype' />";
      echo "<input type='hidden' name='dueamount' value='$setdueamount' />";
      echo "<input type='hidden' name='insamount' value='$setinsamount' />";
      echo "<input type='hidden' name='effdate' value='$seteffdate' />";
      echo "<input type='hidden' name='premium' value='$setpremium' />";
      echo "<input type='hidden' name='terms' value='$setterms' />";
      echo "<input type='hidden' name='instype' value='$setinstype' />";
      echo "<input type='hidden' name='instype' value='$setinstype' />";
      echo "<input type='hidden' name='savedata' value='' />";
    }
    echo "<input type='submit'></form>";

    echo "<script>";
    foreach($clientProps as $p) {  //populate hidden form with screen/window info
      echo "document.getElementById('" . str_replace('.','',$p) . "').value = $p;";
    }
    echo "document.forms.namedItem('data').submit();"; //submit form
    echo "</script>";

  }else{

    $zx=0;
    foreach($clientProps as $p) {
         //create output table
      $asd[$zx]=$_POST[str_replace('.','',$p)];
      $zx++;
    }
  }

  $scw=$asd[0];
  $sch=$asd[1];
?>
<script>
    window.history.replaceState(null,null); //avoid form warning if user clicks refresh
</script>
