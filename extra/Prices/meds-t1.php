<?php
    if(isset($_POST['searchme'])){$searchmeval=mysqli_real_escape_string($conn,$_POST['searchme']);}else{if(isset($_POST['searchmeval'])){$searchmeval=mysqli_real_escape_string($conn,$_POST['searchmeval']);}else{$searchmeval="";}}
    if(isset($_POST['dept'])){$deptval=mysqli_real_escape_string($conn,$_POST['dept']);}else{$deptval="";}
    if(isset($_POST['pt'])){$ptval=mysqli_real_escape_string($conn,$_POST['pt']);}else{$ptval="";}

    if($deptval=="PHARMACY"){$dps1="selected";$dps2="";$dps3="";}
    else if($deptval=="PHARMACY_OPD"){$dps1="";$dps2="selected";$dps3="";}
    else if($deptval=="CPU"){$dps1="";$dps2="";$dps3="selected";}
    else{$dps1="";$dps2="";$dps3="";}

    if($ptval=="All"){$pts0="selected";$pts1="";$pts2="";}
    else if($ptval=="M"){$pts0="";$pts1="selected";$pts2="";}
    else if($ptval=="M"){$pts0="";$pts1="";$pts2="selected";}
    else{$pts0="";$pts1="";$pts2="";}

echo "
                    <table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><div align='left'>
                          <form method='post'>
                            <table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='text' name='searchme' class='searchme' style='padding: 5px;height: 25px;width: 400px;border: 2px solid #000000;border-radius: 5px;font-size: 15px;font-weight: bold;' value='$searchmeval' placeholder='SEARCH GENERIC OR BRAND NAME' autofocus /></td>
                                <td width='5'></td>
                                <td>
                                  <select name='dept' class='searchme' style='padding: 5px;height: 38px;border: 2px solid #000000;border-radius: 5px;font-size: 15px;font-weight: bold;'>
                                    <option $dps1>PHARMACY</option>
                                    <option value='PHARMACY_OPD' $dps2>OPD PHARMACY</option>
                                    <option $dps3>CPU</option>
                                  </select>
                                </td>
                                <td width='5'></td>
                                <td>
                                  <select name='pt' class='searchme' style='padding: 5px;height: 38px;border: 2px solid #000000;border-radius: 5px;font-size: 15px;font-weight: bold;'>
                                    <option $pts0>All</option>
                                    <option value='M' $pts1>Mark-up</option>
                                    <option value='S' $pts2>Special</option>
                                  </select>
                                </td>
                                <td width='5'></td>
                                <td><button type='submit' name='search' class='sch'>&#x1F50D</button></td>
                              </tr>
                            </table>
                          </form>
                        </div></td>
                      </tr>
";

    if(isset($_POST['search'])){
      include("meds-t1-A.php");
    }
    else{
      if(isset($_POST['prc'])){
        include("sitm-a.php");
      }
      else{
        if(isset($_POST['proceed'])){
          include("sitm-b.php");
        }
        else{
          if(isset($_POST['finalized'])){
            include("sitm-c.php");
          }
        }
      }
    }

echo "
                    </table>
";
?>

<!-- jQuery -->
<script src='../Resources/JS/jquery.min.js'></script>
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
        } else {
            $("#select_all").removeAttr("checked");
        }

    });
});
</script>
