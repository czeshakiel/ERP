<?php
  if($admstatus!="MGH"){
    include("finalized-body.php");
  }
  else{
    if($dept=="BILLING"){
      include("finalized-body.php");
    }
    else{
echo "
    <span style='font-family: arial;font-weight: bold;font-size: 16px;color: #FF0000;'>Finalized Request Failed!!! Patient is already set as MGH.</span>
";

    echo "<META HTTP-EQUIV='Refresh'CONTENT='4;URL=../$aa[3]/$aa[4]'>";
    }
  }
?>
