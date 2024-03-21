<?php
echo "
    <!-- Body: Header -->
    <div class='header'>
      <nav class='navbar py-4'>
        <div class='container-xxl'>
          <!-- header rightbar icon -->
          <div class='h-right d-flex align-items-center mr-5 mr-lg-0 order-1'>
            <div class='d-flex'>

            </div>
            <div class='dropdown notifications zindex-popover'>
              <a class='nav-link dropdown-toggle pulse' href='#' role='button' data-bs-toggle='dropdown'>
                <i class='icofont-alarm fs-5'></i>
                <span class='pulse-ring'></span>
              </a>
              <div id='NotificationsDiv' class='dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-sm-end p-0 m-0'>
                <div class='card border-0 w380'>
                  <div class='card-header border-0 p-3'>
                    <h5 class='mb-0 font-weight-light d-flex justify-content-between'>
                      <span><i class='icofont-robot'></i> AI Chatbot</span>
                      <span class='badge text-white'>@azb</span>
                    </h5>
                  </div>
                  <div class='tab-content card-body'>
                    <iframe src='../main/sample.php'  style='height: 400px; width: 100%;'></iframe>
                  </div>
                  <a class='card-footer text-center border-top-0' href='#'> View all notifications</a>
                </div>
              </div>
            </div>


            
            <div class='dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover'>
              <div class='u-info me-2'>
                <p class='mb-0 text-end line-height-sm '><span class='font-weight-bold'>$user</span></p>
                <small>$position</small>
              </div>
              <a class='nav-link dropdown-toggle pulse p-0' href='#' role='button' data-bs-toggle='dropdown' data-bs-display='static'>
                <img class='avatar lg rounded-circle img-thumbnail' src='http://".$_SERVER['HTTP_HOST']."/ERP/main/assets/images/profile_av.png' alt='profile'>
              </a>
              <div class='dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0'>
                <div class='card border-0 w280'>
                  <div class='card-body pb-0'>
                    <div class='d-flex py-1'>
                      <img class='avatar rounded-circle' src='http://".$_SERVER['HTTP_HOST']."/ERP/main/assets/images/profile_av.png' alt='profile'>
                      <div class='flex-fill ms-3'>
                        <p class='mb-0'><span class='font-weight-bold'>$user</span></p>
                        <small class=''>$position</small>
                      </div>
                    </div>
                    <div><hr class='dropdown-divider border-dark'></div>
                  </div>
                  <div class='list-group m-2 '>
                    <!-- a href='task.html' class='list-group-item list-group-item-action border-0 '><i class='icofont-tasks fs-5 me-3'></i>My Task</a>
                    <a href='members.html' class='list-group-item list-group-item-action border-0 '><i class='icofont-ui-user-group fs-6 me-3'></i>members</a -->
                    "; ?>
                    <a  href="javascript:void(0);"  onclick="c_load(this.id);" data-bs-toggle="modal" data-bs-target="#basicModalswitch" class='list-group-item list-group-item-action border-0 '><i class='icofont-logout fs-6 me-3'></i>Switch Department</a>
                    <a  href="javascript:void(0);"  onclick="c_load(this.id);" data-bs-toggle="modal" data-bs-target="#basicModal" class='list-group-item list-group-item-action border-0 '><i class='icofont-logout fs-6 me-3'></i>Sign out</a>
                    <?php echo"
                    <!-- div><hr class='dropdown-divider border-dark'></div -->
                    <!-- a href='ui-elements/auth-signup.html' class='list-group-item list-group-item-action border-0 '><i class='icofont-contact-add fs-5 me-3'></i>Add personal account</a -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- menu toggler -->
          <button class='navbar-toggler p-0 border-0 menu-toggle order-3' type='button' data-bs-toggle='collapse' data-bs-target='#mainHeader'>
            <span class='fa fa-bars'></span>
          </button>
          <!-- Company Header-->
          <div>
            <table width='100%'>
              <tr>
                <td width='10%'><img src='".$ipadd."img/logo/mmshi.png' width='60px'></td>
                <td style='font-size: 13px;'><b>$heading</b><br>$address<br>$telno</td>
              </tr>
            </table>
          </div>

        </div>
      </nav>
    </div>
";
?>

<form method="POST" action="../main/logout.php">
<div class="modal fade" id="basicModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Ohh No!!!</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">Are you sure you want to logout?</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Logout</button>
</div>
</div>
</div>
</div><!-- End Basic Modal-->
</form>

<?php
if(isset($_POST['btndeptswitch'])){
$newdept = $_POST['btndeptswitch'];
$_SESSION['dept'] = $newdept;


$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('Switch Dept from $dept to $newdept', '$user', CURDATE(), CURTIME())");

$newdept = strtoupper($newdept);

if(strpos($newdept, "CASHIER")!==false){$newswitch = "cashier";}
elseif(strpos($newdept, "PHARMACY")!==false or $newdept=="CSR2"){$newswitch = "pharmacy";}
else{$newswitch = "";}
echo"<script>window.location='http://$ip/ERP/$newswitch/?main';</script>";
}
?>
<form method="POST">
<div class="modal fade" id="basicModalswitch" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Switch Department</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
  
<table>
<?php
$ff = $conn->query("select * from nsauth where username='$userunique' and password='$password' and (station like '%pharmacy%' or station like '%cashier%' or station = 'CSR2')");
while($ff1=$ff->fetch_assoc()){
$fdept = $ff1['station'];
if($fdept=="CASHIER"){$gdept="CASHIER MAIN";}
elseif($fdept=="CASHIER2"){$gdept="CASHIER OPD";}
elseif($fdept=="CASHIER3"){$gdept="CASHIER PHARMA";}
elseif($fdept=="CASHIER4"){$gdept="CASHIER RDU";}
else{$gdept=$fdept;}
echo"<tr><td><button type='submit' value='$ff1[station]' name='btndeptswitch' class='btn btn-danger btn-sm'>$gdept</button></td></tr>";
}
?>
</table>

</div>
</div>
</div>
</div><!-- End Basic Modal-->
</form>

