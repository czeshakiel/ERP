<?php
if(strpos($dept, "$mydept")===false){
  echo"
  <script type='text/javascript'>
  swal({
  icon: 'info',
  title: 'Forced Logout!',
  text: 'You are currently logged into the $dept module. Only one department is allowed to be open at a time. Thank you!',
  type: 'error'
  }).then(function() {
  window.location = '../';
  });
  </script>';
  ";
  }
  ?>