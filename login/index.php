<?php
$dept = strtoupper($_GET['dept']);

if($dept=="DOC-OTHERS"){$tab = "nsauthdoctors"; $bg = "doc.jpg";}
else{$tab = "nsauth"; $bg="hcibg.jpg";}
?>
<!doctype html>
<html class='no-js' lang='en' dir='ltr'>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=Edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
  <title><?php echo $dept ?> Department</title>
  <link rel='icon' href='../main/assets/favicon/favicon.png' type='image/png' />
  <link rel='shortcut icon' href='../main/assets/favicon/favicon.png' type='image/png' />
  <!-- project css file  -->
  <link rel='stylesheet' href='../main/assets/css/my-task.style.min.css'>
  <style>
    body, html {height: 100%;}
    .bg {
      /* The image used */
      background-image: url("../main/assets/images/<?php echo $bg ?>");
      /* Full height */
      height: 100%;
      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
backdrop-filter: blur(8px);
    }
  </style>
</head>
<body class='bg'>
<?php
session_start();
include("../main/class.php");
$dept = strtoupper($_GET['dept']);

echo "
<div id='mytask-layout' class='theme-indigo'>
  <!-- main body area -->
  <div class='main p-2 py-3 p-xl-5 '>
    <!-- Body: Body -->
    <div class='body d-flex p-0 p-xl-5'>
      <div class='container-xxl'>
        <div class='row g-0'>
          <div class='col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100'>
            <div style='max-width: 25rem;'>
              <div class='text-center mb-5'>
                <!-- img src='../main/assets/images/bl.png' alt='login-img' width='auto' height='100' / -->
              </div>
              <div class='mb-5'>
                <h2 class='color-900 text-center' style='text-shadow: 0px 0px 12px #000000, 0 0 15px #000000;color: #FFFFFF;'>$dept DEPARTMENT</h2>
              </div>
              <!-- Image block -->
              <div class=''>
                <!-- img src='../main/assets/images/login-img.svg' alt='login-img' / -->
              </div>
            </div>
          </div>
";

if(!isset($_POST['sub'])){
  if((!isset($_COOKIE['uname']))||(!isset($_COOKIE['upass']))||(!isset($_COOKIE['usrnm']))||(!isset($_COOKIE['uacce']))){
    unset($_SESSION['un']);
    unset($_SESSION['pw']);
    unset($_SESSION['nm']);
    unset($_SESSION['ac']);

    setcookie("uname", "", time() - 18000, "/");
    setcookie("upass", "", time() - 18000, "/");
    setcookie("usrnm", "", time() - 18000, "/");
    setcookie("uacce", "", time() - 18000, "/");

echo "
          <div class='col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100'>
            <div class='w-100 p-3 p-md-5 card border-0 bg-dark text-light' style='max-width: 32rem; box-shadow: 0px 0px 10px 1px lightgray;'>
              <!-- Form -->
              <form class='row g-1 p-3 p-md-4' method='post'>
                <div class='col-12 text-center mb-1 mb-lg-2'>
                  <h1>Sign in</h1>
                </div>
                <div class='col-12 text-center mb-4'>
                  <span class='dividers text-muted mt-4'> </span>
                </div>
                <div class='col-12'>
                  <div class='mb-2'>
                    <label class='form-label'>Username</label>
                    <input type='text' name='un' class='form-control form-control-lg' placeholder='Username' autofocus />
                  </div>
                </div>
                <div class='col-12'>
                  <div class='mb-2'>
                    <div class='form-label'>
                      <span class='d-flex justify-content-between align-items-center'>
                        Password
                      </span>
                    </div>
                    <input type='password' name='pw' class='form-control form-control-lg' placeholder='Password' />
                  </div>
                </div>
                ";

                if($dept=="MEDICAL RECORDS EMR"){
                  $mydate = date("Y");
echo"
                <div class='col-12'>
                  <div class='mb-2'>
                    <div class='form-label'>
                      <span class='d-flex justify-content-between align-items-center'>
                        Date
                      </span>
                    </div>
                    <input type='text' name='mydate' class='form-control form-control-lg' placeholder='Year' value='$mydate' />
                  </div>
                </div>
";

                }


                echo"
                <div class='col-12'>
                  <div class='form-check'>
                    <input class='form-check-input' name='remember' type='checkbox' value='RememberMe' id='flexCheckDefault'>
                    <label class='form-check-label' for='flexCheckDefault'>
                      Remember me
                    </label>
                  </div>
                </div>
                <div class='col-12 text-center mt-4'>
                  <button type='submit' name='sub' class='btn btn-lg btn-block btn-light lift text-uppercase' atl='signin'>SIGN IN</button>
                </div>
";

if(isset($_GET['cont'])){
  $cont=$_GET['cont'];

echo "
                <input type='hidden' name='cont' value='$cont' />
";
}

echo "
              </form>
              <!-- End Form -->
            </div>
          </div>
";
  }
  else{
    //setcookie("uname", "", time() - 10800, "/");
    //setcookie("upass", "", time() - 10800, "/");

echo "
          <div class='col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100'>
            <div class='w-100 p-3 p-md-5 card border-0 bg-dark text-light' style='max-width: 32rem;height: 36rem;'>
              <!-- Form -->
                <div class='col-12' align='center'>
                  <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td valign='center'><div align='center'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><span class='spinner-border spinner-border-sm' style='width: 4rem; height: 4rem;color: #FFFFFF;' role='status' aria-hidden='true'></span></td>
                            <td width='10'></td>
                            <td><span style='font-size: 40px;color: #FFFFFF;'> Loading...</span></td>
                          </tr>
                        </table>
                      </div></td>
                    </tr>
                  </table>
                </div>
              <!-- End Form -->
            </div>
          </div>
          <META HTTP-EQUIV='Refresh'CONTENT='0;URL=../' />
";
  }
}
else if(isset($_POST['sub'])){
  if(empty($_POST["remember"])){$rem="";}else{$rem=mysqli_real_escape_string($conn,$_POST['remember']);}

  $un=mysqli_real_escape_string($conn,$_POST['un']);
  $pw=mysqli_real_escape_string($conn,$_POST['pw']);
  $mydate=mysqli_real_escape_string($conn,$_POST['mydate']);



  $asql=mysqli_query($conn,"SELECT * FROM `$tab` WHERE `username`='$un' AND `password`='$pw' AND `station`='$dept'");
  $acount=mysqli_num_rows($asql);

  if($acount==0){
    unset($_SESSION['un']);
    unset($_SESSION['pw']);
    unset($_SESSION['nm']);
    unset($_SESSION['ac']);

    setcookie("uname", "", time() - 18000, "/");
    setcookie("upass", "", time() - 18000, "/");
    setcookie("usrnm", "", time() - 18000, "/");
    setcookie("uacce", "", time() - 18000, "/");

    $contlink="";
    if(isset($_GET['cont'])){
      $cont=$_GET['cont'];
      $contlink="&cont=$cont";
    }

echo "
          <div class='col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100'>
            <div class='w-100 p-3 p-md-5 card border-0 bg-dark text-light' style='max-width: 32rem;height: 36rem;'>
              <!-- Form -->
                <div class='col-12' align='center'>
                  <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td valign='center'><div align='center'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><span style='font-size: 44px;color: #FFFFFF;text-shadow: 2px 2px #ff0000;'><i class='icofont-warning'></i></span></td>
                            <td width='10'></td>
                            <td><span style='font-size: 40px;color: #FFFFFF;text-shadow: 2px 2px #ff0000;'>Sign in failed!!!</span></td>
                          </tr>
                        </table>
                      </div></td>
                    </tr>
                  </table>
                </div>
              <!-- End Form -->
            </div>
          </div>
          <META HTTP-EQUIV='Refresh'CONTENT='2;URL=../login/?dept=$dept".$contlink."' />
";
  }
  else{
    $rows=$asql->fetch_assoc();
    $name= $rows['name'];
    $branch = $rows['branch'];
    $access = $rows['access'];

    $_SESSION['un'] = base64_encode($un);
    $_SESSION['pw'] = base64_encode($pw);
    $_SESSION['nm'] = base64_encode($name);
    $_SESSION['ac'] = base64_encode($access);

    if($rem=="RememberMe"){
      setcookie("uname", base64_encode($un), time() + 18000, "/");
      setcookie("upass", base64_encode($pw), time() + 18000, "/");
      setcookie("usrnm", base64_encode($name), time() + 18000, "/");
      setcookie("uacce", base64_encode($access), time() + 18000, "/");
    }
    else{
      setcookie("uname", "", time() - 18000, "/");
      setcookie("upass", "", time() - 18000, "/");
      setcookie("usrnm", "", time() - 18000, "/");
      setcookie("uacce", "", time() - 18000, "/");
    }

    $_SESSION['username']=$name;
    $_SESSION['password']=$pw;
    $_SESSION['userunique']=$un;
    $_SESSION['branch']=$branch;
    $_SESSION['dept']=strtoupper($dept);
    $_SESSION['count']=0;
    $_SESSION['verifyuser']="verified";
    $_SESSION['user_login'] = true;
    $_SESSION['mydate'] = $mydate;
    $_SESSION['access'] = $access;
    //$this->session->set_userdata('user_login',true);
    $conn->query("DELETE FROM `user_session` WHERE ipaddress='$myip'");

    if($dept=="NS1"){$utmp="nsstation/?main";}
    else if($dept=="NS2"){$utmp="nsstation/?main";}
    else if($dept=="NS3"){$utmp="nsstation/?main";}
    else if($dept=="NS 4"){$utmp="nsstation/?main";}
    else if($dept=="NS 5A"){$utmp="nsstation/?main";}
    else if($dept=="NS 5B"){$utmp="nsstation/?main";}
    else if($dept=="NS 6"){$utmp="nsstation/?main";}
    else if($dept=="ICU"){$utmp="nsstation/?main";}
    else if($dept=="SCU"){$utmp="nsstation/?main";}
    else if($dept=="VERIFIER"){$utmp="verifier/?main";}
    else if($dept=="PHARMACY"){$utmp="pharmacy/?main";}
    else if($dept=="PHARMACY_OPD"){$utmp="pharmacy/?main";}
    else if($dept=="CSR2"){$utmp="pharmacy/?main";}
    else if($dept=="CASHIER"){$utmp="cashier/?main";}
    else if($dept=="CASHIER2"){$utmp="cashier/?main";}
    else if($dept=="CASHIER3"){$utmp="cashier/?main";}
    else if($dept=="CASHIER4"){$utmp="cashier/?main";}
    else if($dept=="XRAY"){$utmp="radiology/?main";}
    else if($dept=="MEDICARE"){$utmp="hcpu/?main";}
    else if($dept=="OR"){$utmp="specialservices/?main";}
    else if($dept=="PT"){$utmp="specialservices/?main";}
    else if($dept=="RT"){$utmp="specialservices/?main";}
    else if($dept=="HEART"){$utmp="heart/?main";}
    else if($dept=="NEW BORN SCREENING"){$utmp="newborn";}
    else if($dept=="BILLING"){
      $cont="";
      if(isset($_POST['cont'])){$cont=base64_decode($_GET['cont']);}
      $utmp="billing/$cont";
    }
    else if($dept=="LABORATORY"){
      $cont="";
      if(isset($_POST['cont'])){$cont=base64_decode($_GET['cont']);}
      $utmp="laboratory/$cont";
    }
    else if($dept=="PHILHEALTH"){
      if(isset($_POST['cont'])){$cont=base64_decode($_GET['cont']);}
      $utmp="philhealth/$cont";
    }
    else if($dept=="ACCOUNTING"){$utmp="accounting/?main";}
    else if($dept=="TRANSCRIBER"){$utmp="transcriber/?main";}
    else if($dept=="MEDICAL RECORDS EMR"){$utmp="medicalrecordsemr/?main";}
    else if($dept=="DOC-OTHERS"){$utmp="doctorslog/?main";}


echo "
          <div class='col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100'>
            <div class='w-100 p-3 p-md-5 card border-0 bg-dark text-light' style='max-width: 32rem;height: 36rem;'>
              <!-- Form -->
                <div class='col-12' align='center'>
                  <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td valign='center'><div align='center'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><span class='spinner-border spinner-border-sm' style='width: 4rem; height: 4rem;color: #FFFFFF;' role='status' aria-hidden='true'></span></td>
                            <td width='10'></td>
                            <td><span style='font-size: 40px;color: #FFFFFF;'> Loading...</span></td>
                          </tr>
                        </table>
                      </div></td>
                    </tr>
                  </table>
                </div>
              <!-- End Form -->
            </div>
          </div>

          <META HTTP-EQUIV='Refresh'CONTENT='0;URL=../$utmp' />
";
  }
}

echo "
        </div> <!-- End Row -->
      </div>
    </div>
  </div>
</div>
";
?>
<!-- Jquery Core Js -->
<script src='../main/assets/bundles/libscripts.bundle.js'></script>

</body>
</html>
