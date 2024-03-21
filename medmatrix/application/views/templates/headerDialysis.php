<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>MedMatrix e-Health Solutions, Inc.</title>
	<link rel="icon" href="<?=base_url();?>design/images/medmatrix-logo.png" type="image/x-icon"> <!-- Favicon-->

	<link rel="stylesheet" href="<?=base_url();?>design/plugin/datatables/responsive.dataTables.min.css">
	<link rel="stylesheet" href="<?=base_url();?>design/plugin/datatables/dataTables.bootstrap5.min.css">
	<link href="<?=base_url();?>design/css/select2.min.css" rel="stylesheet"/>
	<!-- project css file  -->

	<link rel="stylesheet" href="<?=base_url();?>design/css/my-task.style.min.css">
</head>
<style>
	#loadermain{
		display: none;
	}
	.sidebar {
top: 0;
left: 0;
bottom: 0;
transition: all 0.3s ease;
}

@media (max-width: 575.98px) {
.sidebar {transform: translateX(-100%);}
}

.sidebar.open {
transform: translateX(0);
}

.hamburger {
display: none;
}

@media (max-width: 1275.99px) {
.hamburger {
display: block;
position: fixed; /* Make the hamburger button fixed so it's always visible */
top: 1rem;
right: 1rem;
z-index: 200; /* Set a higher z-index than the sidebar to make sure it's above it */
padding: 0px;
}
}

.hamburger{
width: 50px;
height: 50px;
background-color: #6d2344;
border-radius: 30%;
color: #fff;
text-align: center;
font-size: 20px;
line-height: 1;
cursor: pointer;
}

.select2-container .select2-selection--single {
  font-size: 15px;
}



  .tablex {
  border-collapse: separate;
  border-spacing: 0;
  width: 100%;
  

}
.tablex tr th,
.tablex tr td {
  border-right: 1px solid #bbb;
  border-bottom: 1px solid #bbb;
  padding: 5px;
  text-align: left;
  /*font-family: "Arial", Arial, San-serif;*/
    font-family: Arial, Helvetica, sans-serif;
}
.tablex tr th:first-child,
.tablex tr td:first-child {
  border-left: 1px solid #bbb;
}
.tablex tr th {

  border-top: 1px solid #bbb;
  text-align: left;
}

/* top-left border-radius */
.tablex tr:first-child th:first-child {
}

/* top-right border-radius */
.tablex tr:first-child th:last-child {
}

/* bottom-left border-radius */
.tablex tr:last-child td:first-child {
}

/* bottom-right border-radius */
.tablex tr:last-child td:last-child {
}

.modal-content .eight {
    background: darkmagenta;
    color: white;
    border-radius: 5px;
    transition: transform 300ms;
    width: 200px;
    height: auto;
    font-size: 1.5em;
    letter-spacing: 1px;
    font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}

.modal-content .eight:hover {
    transform: scale(0.9);
    box-shadow: 0px 0px 0 4px #fff, 0px 0px 0 6px #bc00d8 ; background:rgb(205, 1, 202);
}
</style>
<body>

<div id="mytask-layout" class="theme-indigo">
<button class='hamburger' onclick='sbview();'><i class='icofont-navigation-menu'></i></button>
	<!-- sidebar -->
	<div class="sidebar px-4 py-4 py-md-5 me-0">
		<div class="d-flex flex-column h-100">
			<a href="<?=base_url();?>" class="mb-0 brand-icon">
                <span class="logo-icon">
                    <span style='font-size: 30px;'><i class='icofont-washing-machine'></i></span>
                </span>
				<span class="logo-text">Renal Dialysis Unit</span>
			</a>
			<!-- Menu: main ul -->

			<ul class="menu-list flex-grow-1 mt-3">
				<li><a class="m-link" href="<?=base_url();?>"><i class="icofont-home"></i> <span>Home</span></a></li>
				<li  class="collapsed">
					<a class="m-link"  data-bs-toggle="collapse" data-bs-target="#project-Components" href="#">
						<i class="icofont-ambulance-cross"></i><span>Transaction</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
					<!-- Menu: Sub menu ul -->
					<ul class="sub-menu collapse" id="project-Components">
						<li><a class="ms-link" href="<?=base_url();?>admission"><span>>> Admission</span></a></li>
						<li><a class="ms-link" href="<?=base_url();?>rdu_list"><span>>> Dialysis Patient</span></a></li>
						<li><a class="ms-link" href="#" data-bs-toggle="modal" data-bs-target="#ARList"><span>>> AR List</span></a></li>
						<li><a class="ms-link" href="#" data-bs-toggle="modal" data-bs-target="#OPDList"><span>>> Walkin List</span></a></li>
					</ul>
				</li>
				<li><a class="m-link" href="<?=base_url();?>stock_request"><i class="icofont-ui-cart"></i> <span>Stock Request</span></a></li>
				<li class="collapsed">
					<a class="m-link" data-bs-toggle="collapse" data-bs-target="#client-Components" href="#"><i
							class="icofont-ui-folder"></i> <span>Reports</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
					<!-- Menu: Sub menu ul -->
					<ul class="sub-menu collapse" id="client-Components">
						<li><a class="ms-link" href="#" data-bs-toggle="modal" data-bs-target="#generateDailyAdmission"> <span>>> Daily Admission</span></a></li>
						<li class="collapsed">
							<a class="ms-link" data-bs-toggle="collapse" data-bs-target="#department-report" href="#"> <span>>> Department Report</span></a>
							<ul class="sub-menu collapse" id="department-report">
								<li>
									<a class="ms-link" href="#" data-bs-toggle="modal" data-bs-target="#InventoryReport">>> Inventory Report</a>
								</li>
								<li>
									<a class="ms-link" href="#" data-bs-toggle="modal" data-bs-target="#StockCardReport">>> e-Stock Card</a>
								</li>
								<li>
									<a class="ms-link" href="<?=base_url();?>stock_on_hand_rdu" target="_blank">>> Stock on Hand</a>
								</li>								
							</ul>
						</li>
						<li><a class="ms-link" href="#" data-bs-toggle="modal" data-bs-target="#generateDailyInpatientHMO"> <span>>> Daily Discharged Report</span></a></li>
								<li><a class="ms-link" href="#" data-bs-toggle="modal" data-bs-target="#generateSummaryInpatientHMO"> <span>>> Discharged Summary Report</span></a></li>
								<li><a class="ms-link" href="<?=base_url();?>daily_collection"><span>>> Daily Collection</span></a></li>
					</ul>
				</li>
				<li class="collapsed">
					<a class="m-link" data-bs-toggle="collapse" data-bs-target="#emp-Components" href="#"><i
							class="icofont-ui-settings"></i> <span>Management</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
					<!-- Menu: Sub menu ul -->
					<ul class="sub-menu collapse" id="emp-Components">
<!--						<li><a class="ms-link" href="--><?//=base_url();?><!--rod_manager"> <span>>> Set ROD</span></a></li>-->
						<li><a class="ms-link" href="<?=base_url();?>guarantee_letter"> <span>>> Post GL</span></a></li>
						<li><a class="ms-link" href="<?=base_url();?>search_patient_record_rdu"> <span>>> Search Patient Records</span></a></li>
					</ul>
				</li>
				<li><a class="m-link" href="<?=base_url();?>for_transmittal"><i class="icofont-listing-box"></i> <span> Transmittal List</span></a></li>
				<li><a class="m-link" href="http://192.168.0.200/MedMatrixeClaims/" target="_blank"><i class="icofont-electron"></i> <span> RDU eClaims</span></a></li>
			</ul>

			<!-- Theme: Switch Theme -->
			<!--			<ul class="list-unstyled mb-0">-->
			<!--				<li class="d-flex align-items-center justify-content-center">-->
			<!--					<div class="form-check form-switch theme-switch">-->
			<!--						<input class="form-check-input" type="checkbox" id="theme-switch">-->
			<!--						<label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>-->
			<!--					</div>-->
			<!--				</li>-->
			<!--				<li class="d-flex align-items-center justify-content-center">-->
			<!--					<div class="form-check form-switch theme-rtl">-->
			<!--						<input class="form-check-input" type="checkbox" id="theme-rtl">-->
			<!--						<label class="form-check-label" for="theme-rtl">Enable RTL Mode!</label>-->
			<!--					</div>-->
			<!--				</li>-->
			<!--			</ul>-->

			<!-- Menu: menu collepce btn -->
			<button type="button" class="btn btn-link sidebar-mini-btn text-light">
				<span class="ms-2"><i class="icofont-bubble-right"></i></span>
			</button>
		</div>
	</div>

	<!-- main body area -->
	<div class="main px-lg-4 px-md-4">

		<!-- Body: Header -->
		<div class="header">
			<nav class="navbar py-4">
				<div class="container-xxl">

					<!-- header rightbar icon -->
					<div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">
						<div class="dropdown notifications zindex-popover">
							<a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
								<i class="icofont-alarm fs-5"></i>
								<span class="pulse-ring"></span>
							</a>
							<!--							<div id="NotificationsDiv" class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-sm-end p-0 m-0">-->
							<!--								<div class="card border-0 w380">-->
							<!--									<div class="card-header border-0 p-3">-->
							<!--										<h5 class="mb-0 font-weight-light d-flex justify-content-between">-->
							<!--											<span>Notifications</span>-->
							<!--											<span class="badge text-white">11</span>-->
							<!--										</h5>-->
							<!--									</div>-->
							<!--									<div class="tab-content card-body">-->
							<!--										<div class="tab-pane fade show active">-->
							<!--											<ul class="list-unstyled list mb-0">-->
							<!--												<li class="py-2 mb-1 border-bottom">-->
							<!--													<a href="javascript:void(0);" class="d-flex">-->
							<!--														<img class="avatar rounded-circle" src="--><?//=base_url();?><!--design/images/xs/avatar1.jpg" alt="">-->
							<!--														<div class="flex-fill ms-2">-->
							<!--															<p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Dylan Hunter</span> <small>2MIN</small></p>-->
							<!--															<span class="">Added  2021-02-19 my-Task ui/ux Design <span class="badge bg-success">Review</span></span>-->
							<!--														</div>-->
							<!--													</a>-->
							<!--												</li>-->
							<!--												<li class="py-2 mb-1 border-bottom">-->
							<!--													<a href="javascript:void(0);" class="d-flex">-->
							<!--														<div class="avatar rounded-circle no-thumbnail">DF</div>-->
							<!--														<div class="flex-fill ms-2">-->
							<!--															<p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Diane Fisher</span> <small>13MIN</small></p>-->
							<!--															<span class="">Task added Get Started with Fast Cad project</span>-->
							<!--														</div>-->
							<!--													</a>-->
							<!--												</li>-->
							<!--												<li class="py-2 mb-1 border-bottom">-->
							<!--													<a href="javascript:void(0);" class="d-flex">-->
							<!--														<img class="avatar rounded-circle" src="--><?//=base_url();?><!--design/images/xs/avatar3.jpg" alt="">-->
							<!--														<div class="flex-fill ms-2">-->
							<!--															<p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Andrea Gill</span> <small>1HR</small></p>-->
							<!--															<span class="">Quality Assurance Task Completed</span>-->
							<!--														</div>-->
							<!--													</a>-->
							<!--												</li>-->
							<!--												<li class="py-2 mb-1 border-bottom">-->
							<!--													<a href="javascript:void(0);" class="d-flex">-->
							<!--														<img class="avatar rounded-circle" src="--><?//=base_url();?><!--design/images/xs/avatar5.jpg" alt="">-->
							<!--														<div class="flex-fill ms-2">-->
							<!--															<p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Diane Fisher</span> <small>13MIN</small></p>-->
							<!--															<span class="">Add New Project for App Developemnt</span>-->
							<!--														</div>-->
							<!--													</a>-->
							<!--												</li>-->
							<!--												<li class="py-2 mb-1 border-bottom">-->
							<!--													<a href="javascript:void(0);" class="d-flex">-->
							<!--														<img class="avatar rounded-circle" src="--><?//=base_url();?><!--design/images/xs/avatar6.jpg" alt="">-->
							<!--														<div class="flex-fill ms-2">-->
							<!--															<p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Andrea Gill</span> <small>1HR</small></p>-->
							<!--															<span class="">Add Timesheet For Rhinestone project</span>-->
							<!--														</div>-->
							<!--													</a>-->
							<!--												</li>-->
							<!--												<li class="py-2">-->
							<!--													<a href="javascript:void(0);" class="d-flex">-->
							<!--														<img class="avatar rounded-circle" src="--><?//=base_url();?><!--design/images/xs/avatar7.jpg" alt="">-->
							<!--														<div class="flex-fill ms-2">-->
							<!--															<p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Zoe Wright</span> <small class="">1DAY</small></p>-->
							<!--															<span class="">Add Calander Event</span>-->
							<!--														</div>-->
							<!--													</a>-->
							<!--												</li>-->
							<!--											</ul>-->
							<!--										</div>-->
							<!--									</div>-->
							<!--									<a class="card-footer text-center border-top-0" href="#"> View all notifications</a>-->
							<!--								</div>-->
							<!--							</div>-->
						</div>
						<div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
							<div class="u-info me-2">
								<p class="mb-0 text-end line-height-sm "><span class="font-weight-bold"><?=$this->session->fullname;?></span></p>
								<small>User Profile</small>
							</div>
							<a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
								<img class="avatar lg rounded-circle img-thumbnail" src="<?=base_url();?>design/images/profile_av.png" alt="profile">
							</a>
							<div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
								<div class="card border-0 w280">
									<div class="card-body pb-0">
										<div class="d-flex py-1">
											<img class="avatar rounded-circle" src="<?=base_url();?>design/images/profile_av.png" alt="profile">
											<div class="flex-fill ms-3">
												<p class="mb-0"><span class="font-weight-bold"><?=$this->session->fullname;?></span></p>
												<small class="">@<?=$this->session->username;?></small>
											</div>
										</div>

										<div><hr class="dropdown-divider border-dark"></div>
									</div>
									<div class="list-group m-2 ">
										<!--										<a href="task.html" class="list-group-item list-group-item-action border-0 "><i class="icofont-tasks fs-5 me-3"></i>My Task</a>-->
										<!--										<a href="members.html" class="list-group-item list-group-item-action border-0 "><i class="icofont-ui-user-group fs-6 me-3"></i>members</a>-->
										<a href="#" class="list-group-item list-group-item-action border-0" data-bs-toggle="modal" data-bs-target="#exampleModalSm"><i class="icofont-logout fs-6 me-3"></i>Signout</a>
										<!--										<div><hr class="dropdown-divider border-dark"></div>-->
										<!--										<a href="ui-elements/auth-signup.html" class="list-group-item list-group-item-action border-0 "><i class="icofont-contact-add fs-5 me-3"></i>Add personal account</a>-->
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- menu toggler -->
					<button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">
						<span class="fa fa-bars"></span>
					</button>

					<!-- main menu Search-->
					<div class="order-0 col-lg-8 col-md-8 col-sm-12 col-12 mb-3 mb-md-0 ">
						<table width="100%" border="0">
							<tr>
								<td width="110"><img src="<?=base_url();?>design/images/kmsci.png" width="100"></td>
								<td>
									<font style="font-size:20px;font-weight: bold;"><?=$header['heading'];?></font> <br>
									<?=$header['address'];?><br>
									<?=$header['FullAddress'];?><br>
									<?=$header['telno'];?>
								</td>
							</tr>
						</table>
						<!--						<div class="input-group flex-nowrap input-group-lg">-->
						<!--							<button type="button" class="input-group-text" id="addon-wrapping"><i class="fa fa-search"></i></button>-->
						<!--							<input type="search" class="form-control" placeholder="Search" aria-label="search" aria-describedby="addon-wrapping">-->
						<!--							<button type="button" class="input-group-text add-member-top" id="addon-wrappingone" data-bs-toggle="modal" data-bs-target="#addUser"><i class="fa fa-plus"></i></button>-->
						<!--						</div>-->

					</div>

				</div>
			</nav>
		</div>
		<div class="modal fade" id="activate_account" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-md modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h4" id="exampleModalSmLabel">Activate Account</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?=form_open(base_url()."activate_account");?>
					<input type="hidden" name="caseno" id="aa_caseno">
					<div class="modal-body">
						<div class="form-group">
							<label>Reason</label>
							<textarea name="reason" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-secondary" value="Submit">
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
<?php
