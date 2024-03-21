<?php
//-------------------------------------------------------------------------------------------------
echo "
              <form method='post'>
                <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <th bgcolor='#0784C0' class='t2 b2 l2' width='40' valign='middle'><div align='center' style='font-size: 12px;color: #FFFFFF;'>#</div></th>
                    <th bgcolor='#0784C0' class='t2 b2 l1' width='40' valign='middle'><div align='center'><input type='checkbox' class='checkall' id='select_all' /></div></th>
                    <th bgcolor='#0784C0' class='t2 b2 l1' valign='middle'><div align='center' style='font-size: 12px;color: #FFFFFF;'>DESCRIPTION</div></th>
                    <th bgcolor='#0784C0' class='t2 b2 l1' valign='middle'><div align='center' style='font-size: 12px;color: #FFFFFF;'>DATE/TIME OF REQUEST</div></th>
                    <th bgcolor='#0784C0' class='t2 b2 l1' valign='middle'><div align='center' style='font-size: 12px;color: #FFFFFF;'>STATUS</div></th>
                    <th bgcolor='#0784C0' class='t2 b2 l1 r2' valign='middle'><div align='center' style='font-size: 12px;color: #FFFFFF;'>ACTION</div></th>
                  </tr>
";

$a=0;
if(($stype=="hematology")||($stype=="chemistry")||($stype=="serology")){
  $asql=mysqli_query($conn,"SELECT p.`refno`, p.`productcode`, p.`productdesc`, p.`invno`, p.`terminalname`, p.`batchno`, p.`datearray`, l.`test`, l.`remarks` FROM `productout` p, `labtest` l WHERE p.`caseno`='$caseno' AND p.`refno`=l.`refno` AND l.`test`='$stype' AND (p.`status`='Approved' OR p.`status`='PAID') AND p.`terminalname` NOT LIKE 'Testdone' AND p.`productsubtype`='LABORATORY'");
}
else{
  $asql=mysqli_query($conn,"SELECT p.`refno`, p.`productcode`, p.`productdesc`, p.`invno`, p.`terminalname`, p.`batchno`, p.`datearray`, l.`test`, l.`remarks` FROM `productout` p, `labtest` l WHERE p.`caseno`='$caseno' AND p.`refno`=l.`refno` AND l.`refno`='$srefno' AND (p.`status`='Approved' OR p.`status`='PAID') AND p.`terminalname` NOT LIKE 'Testdone' AND p.`productsubtype`='LABORATORY'");
}
while($afetch=mysqli_fetch_array($asql)){
  $refno=$afetch['refno'];
  $pcode=$afetch['productcode'];
  $pdesc=$afetch['productdesc'];
  $timer=$afetch['invno'];
  $dater=$afetch['datearray'];
  $stat=$afetch['terminalname'];
  $test=$afetch['test'];
  $rmk=$afetch['remarks'];

  $bsql=mysqli_query($conn,"SELECT * FROM `labnormalvalues` WHERE `code`='$pcode'");
  $bcount=mysqli_num_rows($bsql);

  if($bcount>0){
    $a++;


    $ckp="";
    if($srefno==$refno){$ckp="checked";}

    if($stat=="pending"){$stat="<span style='color: #FF5E27;'>Pending</span>";}
    else if($stat=="Testdone"){$stat="<span style='color: #27BAFF;'>Test Done</span>";}
    else if($stat=="Testtobedone"){$stat="<span style='color: #8C27FF;'>Test to be Done</span>";}

    if($rmk!=""){$rmk=" <span style='color: #48C9B0;font-size: 12px;'>($rmk)</span>";}

echo "
                  <tr>
                    <td class='b1 l2'><div align='left' style='padding-left: 5px;font-weight: bold;'>$a</div></td>
                    <td class='b1 l1'><div align='center' style='font-weight: bold;'><input type='checkbox' name='refno$a' class='case' value='$refno' $ckp /></div></td>
                    <td class='b1 l1'><div align='left' style='padding-left: 5px;font-weight: bold;'>".$pdesc.$rmk."</div></td>
                    <td class='b1 l1'><div align='center' style='font-weight: bold;'>".date("M d, Y h:i A",strtotime("$dater $timer"))."</div></td>
                    <td class='b1 l1'><div align='center' style='font-weight: bold;'>$stat</div></td>
                    <td class='b1 l1 r2'><div align='center'></div></td>
                  </tr>
";
  }
}

if($a==0){$sbm="button";}else{$sbm="submit";};

echo "
                  <tr>
                    <td class='t2' colspan='6' height='50'><div align='center'><button type='$sbm' name='cres' class='btn btn-success text-white' style='font-weight: bold;' title='Back to Select test'><i class='icofont-test-tube-alt'></i> Create Result</button></div></td>

                  </tr>
                </table>
                <input type='hidden' name='srefno' value='$srefno' />
                <input type='hidden' name='ltype' value='$stype' />
                <input type='hidden' name='count' value='$a' />
                <input type='hidden' name='stest' />
              </form>
";
//-------------------------------------------------------------------------------------------------
?>

<script src='../extra/Resources/JS/jquery.min.js'></script>
<script language="javascript">
  $(function(){
    // add multiple select / deselect functionality
    $("#select_all").click(function () {
      $('.case').attr('checked', this.checked);
    });

    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
      if($(".case").length == $(".case:checked").length) {
        $("#select_all").attr("checked", "checked");
      }
      else {
        $("#select_all").removeAttr("checked");
      }
    });
  });
</script>
