<?php
    if(isset($_POST['searchme'])){$searchmeval=mysqli_real_escape_string($conn,$_POST['searchme']);}else{$searchmeval="";}
    if(isset($_POST['unit'])){$unitval=mysqli_real_escape_string($conn,$_POST['unit']);}else{$unitval="";}

    if($unitval=="2D ECHO"){$uns1="selected";$uns2="";$uns3="";$uns4="";$uns5="";$uns6="";$uns7="";$uns8="";$uns9="";}
    else if($unitval=="CT SCAN"){$uns1="";$uns2="selected";$uns3="";$uns4="";$uns5="";$uns6="";$uns7="";$uns8="";$uns9="";}
    else if($unitval=="ECG"){$uns1="";$uns2="";$uns3="selected";$uns4="";$uns5="";$uns6="";$uns7="";$uns8="";$uns9="";}
    else if($unitval=="LABORATORY"){$uns1="";$uns2="";$uns3="";$uns4="selected";$uns5="";$uns6="";$uns7="";$uns8="";$uns9="";}
    else if($unitval=="ULTRASOUND"){$uns1="";$uns2="";$uns3="";$uns4="";$uns5="selected";$uns6="";$uns7="";$uns8="";$uns9="";}
    else if($unitval=="XRAY"){$uns1="";$uns2="";$uns3="";$uns4="";$uns5="";$uns6="selected";$uns7="";$uns8="";$uns9="";}
    else if($unitval=="PHYSICAL THERAPY"){$uns1="";$uns2="";$uns3="";$uns4="";$uns5="";$uns6="";$uns7="selected";$uns8="";$uns9="";}
    else if($unitval=="HEARTSTATION"){$uns1="";$uns2="";$uns3="";$uns4="";$uns5="";$uns6="";$uns7="";$uns8="selected";$uns9="";}
    else if($unitval=="EEG"){$uns1="";$uns2="";$uns3="";$uns4="";$uns5="";$uns6="";$uns7="";$uns8="";$uns9="selected";}
    else{$uns1="";$uns2="";$uns3="";$uns4="";$uns5="";$uns6="";$uns7="";$uns8="";$uns9="";}

echo "
                    <table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><div align='left'>
                          <form method='post'>
                            <table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='text' name='searchme' class='searchme' style='padding: 5px;height: 25px;width: 400px;border: 2px solid #000000;border-radius: 5px;font-size: 15px;font-weight: bold;' value='$searchmeval' placeholder='SEARCH DESCRIPTION' autofocus /></td>
                                <!-- td width='5'></td>
                                <td>
                                  <select name='unit' class='searchme' style='padding: 5px;height: 38px;border: 2px solid #000000;border-radius: 5px;font-size: 15px;font-weight: bold;'>
                                    <option>All</option>
                                    <option $uns1>2D ECHO</option>
                                    <option $uns2>CT SCAN</option>
                                    <option $uns3>ECG</option>
                                    <option $uns4>LABORATORY</option>
                                    <option $uns5>ULTRASOUND</option>
                                    <option $uns6>XRAY</option>
                                    <option $uns7>PHYSICAL THERAPY</option>
                                    <option $uns8>HEARTSTATION</option>
                                    <option $uns9>EEG</option>
                                  </select>
                                </td -->
                                <td width='5'></td>
                                <td><button type='submit' class='sch'>&#x1F50D</button></td>
                              </tr>
                            </table>
                          </form>
                        </div></td>
                      </tr>
";

    if(isset($_POST['searchme'])){
      include("othe-t1-A.php");
    }
    else{
      if(isset($_POST['prc'])){
        include("sitm-oth-a.php");
      }
      else{
        if(isset($_POST['proceed'])){
          include("sitm-oth-b.php");
        }
        else{
          if(isset($_POST['finalized'])){
            include("sitm-oth-c.php");
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
