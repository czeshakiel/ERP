<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Enterprise Resource Planning System</title>
<link href="../main/img/logo/logo.png" rel="icon">
<!-- project css file  -->
<link rel="stylesheet" href="../main/assets/css/my-task.style.min.css">
<link rel="stylesheet" href="../main/assets/plugin/datatables/responsive.dataTables.min.css">
<link rel="stylesheet" href="../main/assets/plugin/datatables/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="../main/assets/plugin/prism/prism.css">
<link href="../main/arv_new/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
</head>

<?php //include "../main/style.php"; include "../mainpage/javascript.php"; ?>
<script src="../main/arv_new/jquery/dist/jquery.min.js"></script>
<script src="../main/arv_new/sweetalert/sweetalert.js"></script>


<style>
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