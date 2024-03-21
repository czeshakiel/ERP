<?php
  $clientProps=array('screen.width','screen.height','window.innerWidth','window.innerHeight',
    'window.outerWidth','window.outerHeight','screen.colorDepth','screen.pixelDepth');

  if(! isset($_POST['screenheight'])){

    echo "<form method='POST' id='data' style='display:none'>";
    foreach($clientProps as $p) {  //create hidden form
      echo "<input type='text' id='".str_replace('.','',$p)."' name='".str_replace('.','',$p)."'>";
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
