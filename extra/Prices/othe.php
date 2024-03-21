<?php
  if(isset($_GET['srm'])){$btcl1="tabsel";$btcl2="tabuns";$btcl3="tabuns";$tab="1";}
  else{
    if(isset($_GET['ads'])){$btcl1="tabuns";$btcl2="tabsel";$btcl3="tabuns";$tab="2";}
    else{
      if(isset($_GET['prl'])){$btcl1="tabuns";$btcl2="tabuns";$btcl3="tabsel";$tab="3";}
      else{$btcl1="tabsel";$btcl2="tabuns";$btcl3="tabuns";$tab="1";}
    }
  }

echo "
    <tr>
      <td style='padding-top: 5px;'><div align='left'>
        <table border='0' width='100%' cellpadding='0' cellspacing='0'>
          <tr>
            <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td width='70%'><div align='left' style='font-family: arial;font-size: 16px;font-weight: bold;color: #34495E;padding-bottom: 10px;'>OTHER CHARGES</div></td>
                <td width='30%'><div align='right'><a href='../Prices/?back$usr'><button class='bck'>&#x21fd; Back</button></a></div></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>
              <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='150'><a href='?others&srm$usr' style='text-decoration: none;'><div align='center' class='$btcl1'>Search Item</div></a></td>
                  <td width='150'><a href='?others&ads$usr' style='text-decoration: none;'><div align='center' class='$btcl2'>Add Item</div></a></td>
                  <td width='150'><a href='?others&prl$usr' style='text-decoration: none;'><div align='center' class='$btcl3'>Printable List</div></a></td>
                  <td class='b2'></td>
                </tr>
                <tr>
                  <td class='b2 l2 r2' colspan='4' height='830' valign='top'><div align='left' style='padding: 10px;'>
";

  if($tab=="1"){
    include("othe-t1.php");
  }
  else if($tab=="2"){
    include("othe-t2.php");
  }
  else if($tab=="3"){
    include("othe-t3.php");
  }

echo "
                  </div></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </div></td>
    </tr>
";
?>
