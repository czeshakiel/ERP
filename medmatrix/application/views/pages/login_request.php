
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>MedMatrix e-Health Solutions, Inc.</title>
	<link rel="icon" href="<?=base_url();?>design/images/medmatrix-logo.png" type="image/x-icon"> <!-- Favicon-->
	<!-- project css file  -->
	<link rel="stylesheet" href="<?=base_url();?>design/css/my-task.style.min.css">
	<link href="<?=base_url();?>design/css/select2.min.css" rel="stylesheet"/>
	<style type="text/css">
		#loader{
			display: none;
		}
	</style>
</head>

<body>

<div id="mytask-layout" class="theme-indigo" style="background: url(<?=base_url();?>design/images/kmscibackground.jpg) no-repeat; background-size: cover;">

	<!-- main body area -->
	<div class="main p-2 py-3 p-xl-5 ">

		<!-- Body: Body -->
		<div class="body d-flex p-0 p-xl-5">
			<div class="container-xxl">

				<div class="row g-0">
					<div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
						<div style="max-width: 25rem;">
							<div class="text-center mb-5">
	<!--								<svg  width="4rem" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">-->
	<!--									<path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>-->
	<!--									<path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>-->
	<!--									<path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>-->
	<!--								</svg>-->
<!--								<img src="--><?//=base_url();?><!--design/images/medmatrix-logo.png" width="100">-->
							</div>
							<div class="mb-5">
<!--								<h2 class="color-900 text-center">MedMatrix e-Health Solutions, Inc.</h2>-->
							</div>
							<!-- Image block -->
							<div class="">
<!--								<img src="--><?//=base_url();?><!--design/images/login-img.svg" alt="login-img">-->
							</div>
						</div>
					</div>
					<div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
						<div class="w-100 p-3 p-md-5 card border-0 bg-dark text-light" style="max-width: 32rem;">
							<!-- Form -->

							<div class="col-12 text-center mb-1 mb-lg-3">
								<h1>Sign in</h1>								
							</div>
							<div width="100%" align="center" id="loader">
								<div class="spinner-border text-center" style="width: 10rem; height: 10rem;" role="status"></div><br>
								<p style="font-size: 20px;">Authenticating... Please wait...</p>
							</div>
							<!-- <form class="row g-1 p-3 p-md-4" method="post" id="login" action="<?=base_url();?>authenticate"> -->
								<?=form_open(base_url()."authenticate",array('id' => 'login','class' => 'row g-1 p-3 p-md-4'));?>							

								<div class="col-12">
									<div class="mb-2">
										<label class="form-label">Username</label>
										<input type="text" name="username" class="form-control form-control-lg" placeholder="Username" id="username">
									</div>
								</div>
								<div class="col-12">
									<div class="mb-2">
										<div class="form-label">
                                            <span class="d-flex justify-content-between align-items-center">
                                                Password
<!--                                                <a class="text-secondary" href="auth-password-reset.html">Forgot Password?</a>-->
                                            </span>
										</div>
										<input type="password" name="password" class="form-control form-control-lg" placeholder="***************" id="password">
									</div>
								</div>
								<div class="col-12">
									<div class="mb-2">
										<label class="form-label">Department</label>
										<select name="dept" class="item form-control" required>
											<option value="">Select Department</option>
											<?php
												$station=$this->General_model->getAllStation();
												foreach($station as $d){
													echo "<option value='$d[station]'>$d[station]</option>";
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-12">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
										<label class="form-check-label" for="flexCheckDefault">
											Remember me
										</label>
									</div>
								</div>
								<div class="col-12 text-center mt-4">
									<button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" atl="signin">
										SIGN IN</button>
								</div>
							<!-- </form> -->
							<?=form_close();?>
							<div class="col-12 text-center mt-4">
								<span class="text-muted">Don't have an account yet? <a href="#" class="text-secondary">Please contact System Adminstrator or IT Personel for account registration</a></span>
							</div>
							<!-- End Form -->
						</div>
					</div>
				</div> <!-- End Row -->
			</div>
		</div>
	</div>
</div>

<!-- Jquery Core Js -->
<script src="<?=base_url();?>design/bundles/libscripts.bundle.js"></script>
<script src="<?=base_url();?>design/js/select2.min.js"></script>

<!-- Plugin Js-->
<script src="<?=base_url();?>design/bundles/dataTables.bundle.js"></script>
<script src="<?=base_url();?>design/bundles/apexcharts.bundle.js"></script>

<!-- Jquery Page Js -->
<script src="<?=base_url();?>design/js/template.js"></script>
<script src="<?=base_url();?>design/js/page/hr.js"></script>
<script>
	$(document).ready(function(){
		$('#login').submit(function(){
			document.getElementById('loader').style.display = "block";
			document.getElementById('login').style.display = "none";
		// 	var data=$(this).serializeArray();
		// 	$.ajax({
		// 		url:'<?=base_url();?>index.php/pages/checklogin',
		// 		type:'post',
		// 		data: data,
		// 		dataType:'json',
		// 		success:function(response){
		// 			if(response.length > 0){						
		// 				window.location = '<?=base_url();?>main';
		// 			}else{
		// 				document.getElementById('loader').style.display = "none";
		// 				alert('Invalid username and password!');
		// 				document.getElementById('login').style.display = "block";
		// 			}
		// 		}
		// 	});
		 });
	});
	$(document).ready(function(){		
		$('.item').select2();		
	});
</script>
</body>
</html>
