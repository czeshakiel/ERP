<?php
ini_set("display_errors", "on");
$version = explode(".", phpversion());
if ($version[0] == "5") { require_once '../resultform/dompdf5.4/autoload.inc.php'; } 
else { require_once '../resultform/dompdf7.1/autoload.inc.php'; }
$dompdf = new Dompdf\Dompdf();
$html = "<!DOCTYPE html>
<html>
<head>
    <title>MEDICATION SHEET</title>
    <style>
      .material-checkbox input[type='checkbox'] { position:absolute; opacity:0; width:0; height:0; }
      .description{margin-left:20px; }
      .checkbox-input{margin-bottom:10px; }
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
</body>
</html>";
$dompdf->loadHtml($html);
$dompdf->setPaper('folio', 'portrait');
$dompdf->render();
$dompdf->stream('Newborn PF.pdf', array('Attachment' => false));
?>