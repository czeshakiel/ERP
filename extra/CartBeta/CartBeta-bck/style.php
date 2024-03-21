<?php
echo "
<style style='text/css'>
  .hoverTable tr{background: #ffffff;}
  .hoverTable tr:hover {background-color: #ffff99;}

  .btn {background-color: #0E8516;color: #fff;font-weight: bold;font-size: 12px;padding: 5px 10px;border: none;cursor: pointer;opacity: 0.7;border-radius: 5px;}
  .cancel {background-color: #cc0000;}
  .tpl {background-color: #821C97;}
  .tkt {background-color: #B60050;}
  .unf {background-color: #0061B6;}
  .btn:hover, .open-button:hover {opacity: 1;}

  .bgunsel{background-color: #02668E;color: #FFFFFF;font-family: arial;font-size: 16px;font-weight: bold;padding: 5px 10px 5px 10px;border-radius: 8px 8px 0 0;opacity: 0.7;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
  .bgunsel:hover{opacity: 1;}
  .bgsel{background-color: #FF0000;color: #FFFFFF;font-family: arial;font-size: 16px;font-weight: bold;padding: 5px 10px 5px 10px;border-radius: 8px 8px 0 0;opacity: 1;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
  .bgsel:hover{opacity: 0.5;}

  .textf{background-color: #FFFFFF;}
  .textf:focus{background-color: #00E10E;color: #000000;}

  .textf::placeholder {color: #6F6F6F;opacity: 1;}
  .textf:-ms-input-placeholder {color: #6F6F6F;}
  .textf::-ms-input-placeholder {color: #6F6F6F;}

  * {box-sizing: border-box;border-radius: 10px;}
  body {font-family: Roboto, Helvetica, sans-serif;}
  /* Fix the button on the left side of the page */
  .open-btn {display: flex;justify-content: left;}
  /* Style and fix the button on the page */
  .open-button {background-color: #1c87c9;color: white;padding: 12px 20px;border: none;border-radius: 5px;cursor: pointer;opacity: 0.8;position: fixed;}
  /* Position the Popup form */
  .cpup {position: relative;text-align: center;width: 100%;}
  /* Hide the Popup form */
  .formcpup {display: none;position: fixed;left: 50%;top: 50%;transform: translate(-50%,-50%);border: 3px solid #000000;z-index: 9;}
  /* Styles for the form container */
  .formcontainer {max-width: 500px;padding: 15px;background-color: #fff;}
  /* Full-width for input fields */
  .formcontainer input[type=text], .formcontainer input[type=password] {width: 250px;height: 40px;font-size: 14px;text-align: center;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;}
  /* Select fields */
  .formcontainer select {padding: 10px;margin: 5px 0 10px 0;border: none;background: #eee;}
  /* When the inputs get focus, do something */
  .formcontainer input[type=text]:focus, .formcontainer input[type=password]:focus, .formcontainer select:focus {background-color: #ddd;outline: none;}
  /* Style submit/login button */
  .formcontainer .btn {background-color: #8ebf42;color: #fff;padding: 12px 20px;border: none;cursor: pointer;margin-bottom:10px;opacity: 0.8;}
  /* Style cancel button */
  .formcontainer .cancel {background-color: #cc0000;}
  /* Hover effects for buttons */
  .formcontainer .btn:hover, .open-button:hover {opacity: 1;}
</style>
";
?>
