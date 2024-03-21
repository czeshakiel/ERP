<?php
include 'alink.php';
ini_set("display_errors", "off");
$version = explode(".", phpversion());
if ($version[0] == "5") { require_once '../dompdf/dompdf0.8.3/autoload.inc.php'; } 
else { require_once '../dompdf/dompdf7.1/autoload.inc.php'; }
$dompdf = new Dompdf\Dompdf();
$html = "<!DOCTYPE html>
<html>
<head>
    <title>MEDICATION SHEET</title>
    <style>
    
      .checkbox-input{ display: block; color:#000000; position:relative; display:flex; }
      .material-checkbox input[type='checkbox'] { opacity: 0; width: 0; height: 0; padding:0; margin:0;}
      .material-checkbox .description{
        font-size:16px;
        font-weight:bold;
        margin-left:20px;
        color: #000000;
      }
    </style>
</head>
<body>
    <table width='100%' cellpadding='0' cellspacing='0' border='1'>
        <tr>
            <td>
                <div class='checkbox-container'>
                    <label class='material-checkbox'>
                        <input type='checkbox' class='checkbox-input' checked>
                        <span class='checkmark'></span>
                        <span class='description'>NANANANANA</span>
                    </label>
                </div>
            </td>
            <td>
                <div class='checkbox-container'>
                    <label class='material-checkbox'>
                        <input type='checkbox' class='checkbox-input' checked>
                        <span class='checkmark'></span>
                        <span class='description'>NANANANANA</span>
                    </label>
                </div>
            </td>
            <td>
                <div class='checkbox-container'>
                    <label class='material-checkbox'>
                        <input type='checkbox' class='checkbox-input' checked>
                        <span class='checkmark'></span>
                        <span class='description'>NANANANANA</span>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
        <td colspan='3' valign='top'>
          <table width='100%' border='1' cellpadding='0' cellspacing='0'>
            <tr>
                <td style='width:20%'><span>Sex</span></td>
                <td style='width:40%'>
                  <div class='checkbox-container'>
                    <label class='material-checkbox'>
                      <input type='checkbox' class='checkbox-input' checked>
                      <span class='checkmark'></span>
                      <span class='description'> Male</span>
                    </label>
                  </div>
                </td>
                <td style='width:40%'>
                  <div class='checkbox-container'>
                    <label class='material-checkbox'>
                      <input type='checkbox' class='checkbox-input' checked>
                      <span class='checkmark'></span>
                      <span class='description'> Female</span>
                    </label>
                  </div>
                </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <style>
      .chckbox{display:block;}
      .mtrl-box input[type='checkbox'] { position:absolute; opacity:0; width:0; height:0; }
      .chckmark {border: 1px solid red; widht:15px; height:15px; margin:1px; }
      .chmrk{ border:1px solid red; width:10px; height:10px; display:relative; }
      .mtrl-box { border:1px solid red; width:17px; height:17px; }
      .mtrl-box .desc{ color:#000000; margin-left:20px; }
    </style>

    <div class='chckbx-con'>
        <div class='mtrl-box'>
            <input type='checkbox' class='chckbox' checked>
            <span class='chckmark'></span>
            <span class='desc'>NANANANANA</span>
        </div>
    </div>
</body>
</html>";
$dompdf->loadHtml($html);
$dompdf->setPaper('folio', 'portrait');
$dompdf->render();
$dompdf->stream('Newborn PF.pdf', array('Attachment' => false));
?>