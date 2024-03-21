<?php
$at=$totgross;
$cac=base64_decode($_SESSION['cac']);

//SERVICES AND OTHERS START------------------------------------------------------------------------
    if($ct=="sot-lab"){

      $zxsql=mysqli_query($conn,"SELECT * FROM `receiving` WHERE `code`='1000582n-3' OR `code`='10007110p-3' OR `code`='110002625n-3' OR `code`='110003885n-5' OR `code`='L62p-3' OR `code`='L139p-3' OR `code`='L135p-3' OR `code`='L1000p-3' OR `code`='L32p-3' ORDER BY `description`");
      $zxcount=mysqli_num_rows($zxsql);

      if($zxcount==0){
echo "
      <div align='left' style='font-family: arial;font-size: 16px;font-weight: bold;color: #FF0000;'>0 results found!!!</div>
";
      }
      else{
echo "
        <table border='0' cellpadding='0' cellspacing='0' class='hoverTable'>
          <tr>
            <td class='t2 b2 l2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;padding: 3px 5px;'>#</div></td>
            <td class='t2 b2 l1'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;padding: 3px 5px;'>Description</div></td>
            <td class='t2 b2 l1'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;padding: 3px 5px;'>Action</div></td>
            <td class='t2 b2 l1 r2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;padding: 3px 5px;'>Type</div></td>
          </tr>
";

        $zx=0;
        while($zxfetch=mysqli_fetch_array($zxsql)){
          $cod=$zxfetch['code'];
          $itn=mb_strtoupper($zxfetch['itemname']);
          $itnor=$zxfetch['itemname'];
          $unt=$zxfetch['unit'];
          $gte=$zxfetch['gtestcode'];
          $op4=$zxfetch['optset4'];
          $zx++;

          if(($dept=="PHARMACY")&&(stripos($op4, "-1|") !== FALSE)){$gte=1;}
          if((($dept=="PHARMACY_OPD")||($dept=="pharmacy_opd"))&&(stripos($op4, "-2|") !== FALSE)){$gte=1;}
          if((($dept=="CSR2")||($dept=="csr2"))&&(stripos($op4, "-3|") !== FALSE)){$gte=1;}
          if(($dept=="BILLING")&&(stripos($op4, "-4|") !== FALSE)){$gte=1;}
          if(($dept=="NS1")&&(stripos($op4, "-5|") !== FALSE)){$gte=1;}
          if(($dept=="NS2")&&(stripos($op4, "-6|") !== FALSE)){$gte=1;}
          if(($dept=="NS3")&&(stripos($op4, "-7|") !== FALSE)){$gte=1;}
          if(($dept=="NS 4")&&(stripos($op4, "-8|") !== FALSE)){$gte=1;}
          if(($dept=="NS 5A")&&(stripos($op4, "-9|") !== FALSE)){$gte=1;}
          if(($dept=="NS 5B")&&(stripos($op4, "-10|") !== FALSE)){$gte=1;}
          if(($dept=="NS 6")&&(stripos($op4, "-11|") !== FALSE)){$gte=1;}

          $ronl="";
          if((stripos($unt, "LABORATORY") !== FALSE)||(stripos($unt, "CT SCAN") !== FALSE)||(stripos($unt, "ULTRASOUND") !== FALSE)||(stripos($unt, "ECG") !== FALSE)||(stripos($unt, "XRAY") !== FALSE)||(stripos($unt, "EEG") !== FALSE)){
            $ronl="readonly";
          }

          //$zvsql=mysqli_query($conn,"SELECT `opd`, `philhealth` FROM `productsmasterlist` WHERE `code`='$cod'");
          //if(mysqli_num_rows($zvsql)==0){
            //$op=0;
            //$ph=0;
          //}
          //else{
            //$zvfetch=mysqli_fetch_array($zvsql);
            //$op=$zvfetch['opd'];
            //$ph=$zvfetch['philhealth'];
          //}

          $qtdis="";
          if($gte==1){$qtdis="disabled";}
echo "
          <tr>
            <td class='b1 l2'><div align='left' style='font-family: arial;font-weight: bold;font-size: 14px;color: #000000;padding: 3px 5px;'>$zx</div></td>
            <td class='b1 l1'><div align='left' style='font-family: arial;font-weight: bold;font-size: 14px;color: #000000;padding: 3px 5px;'>$itn</div></td>
            <td class='b1 l1'><div align='left' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>
              <form method='post'>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td width='60'><div align='center' style='padding: 3px 5px;'><input type='number' style='height: 30px;width: 60px;border-radius: 5px;border: 2px solid #000000;' placeholder='Qty.' name='qty' value='1' $qtdis $ronl /></div></td>
";

          if($gte==1){
echo "
                    <td><div align='center' style='font-family: arial;font-weight: bold;font-size: 14px;color: #FF0000;'>DISABLED</div></td>
";
          }
          else{
echo "
                    <td>
                      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                        <tr>
";
            $kcst=preg_split("/\-/",$caseno);
            if($at<=$cl){
              if(($kcst[0]!="W")&&($kcst[0]!="WD")){
                if(stripos($caseno, "C2") !== FALSE){
                }
                else{
echo "
                          <td><div align='center' style='padding: 3px 2px;'><button type='submit' name='trantype' value='charge' class='btn'>Charge</button></div></td>
";
                }
              }
            }

            if($kcst[0]!="AR"){
echo "
                          <td><div align='center' style='padding: 3px 2px;'><button type='submit' name='trantype' value='cash' class='btn cancel'>Cash</button></div></td>
";
            }

            if(($cac=="4")||($cac=="5")){
              if(stripos($caseno, "C2") !== FALSE){
              }
              else{
echo "
                          <td><div align='center' style='padding: 3px 2px;'><button type='submit' name='trantype' value='tpl' class='btn tpl'>TPL</button></div></td>
";
              }
            }

echo "
                        </tr>
                      </table>
                    </td>
";
          }

echo "
                  </tr>
                </table>
                <input type='hidden' name='itmcode' value='$cod' />
                <input type='hidden' name='itmtype' value='$unt' />
                <input type='hidden' name='itmname' value='$itnor' />
";

if($unt=="LABORATORY"){
echo "
                <input type='hidden' name='addchrmks' />
";
}
else{
  if($cod=="210906184316p-50"){
echo "
                <input type='hidden' name='addchrmks' />
";
  }
  else{
echo "
                <input type='hidden' name='addch' />
";
  }
}

echo "
              </form>
            </div></td>
            <td class='b1 l1 r2'><div align='center' style='font-family: arial;font-weight: bold;font-size: 14px;color: #03A3CD;padding: 3px 5px;'>$unt</div></td>
          </tr>
";
        }

echo "
          <tr>
            <td class='t2'></td>
            <td class='t2'></td>
            <td class='t2'></td>
            <td class='t2'></td>
          </tr>
        </table>
";
      }
    }
//SERVICES AND OTHERS END--------------------------------------------------------------------------
?>
</body>
</html>
