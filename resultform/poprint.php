<?php
require_once('../tcpdf/tcpdf.php');
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 061');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style
$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<table Style="width: 100%;" align="center">
<tr>
<td width="7%"><img src="../mainpage/img/logo/kmsci.png" width="50" height="auto"></td>
<td width="93%"><p align="center" style="font-size: 13px;"><b>'.$heading.'<br><small>'.$address.'<br>'.$telno.'</small></b></p></td>
</tr>
</table>

<br><br>

<table style="border-collapse: collapse;" width="100%">

<tr>
<td style="font-size:11px;" width="15%">FILM NO:</td>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;" width="35%">'.$filmno.'</td>
<td style="font-size:11px;" width="15%">&nbsp;&nbsp;&nbsp;DATE:</td>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;" width="35%">'.$daterr.'</td>
</tr>


<tr>
<td style="font-size:11px;">CASENO:</td>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;">'.$caseno.'</td>
<td style="font-size:11px;">&nbsp;&nbsp;&nbsp;ROOM:</td>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;">'.$room.'</td>
</tr>

<tr>
<td style="font-size:11px;">NAME:</td>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;">'.$name.'</td>
<td style="font-size:11px;">&nbsp;&nbsp;&nbsp;AGE/SEX:</td>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;">'.$age.'/'.$sex.'</td>
</tr>

<tr>
<td style="font-size:11px;">REFERED BY:</td>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px">'.$ap.'</td>
<td style="font-size:11px;">&nbsp;&nbsp;&nbsp;EXAMINATION:</td>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px">'.$partexamined.'</td>
</tr>

<tr>
<th style="font-size:11px;"><p align="left">ADDRESS:</p></th>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px" colspan="3">'.$address22.'</td>
</tr>

<tr>
<th style="font-size:11px;"><p align="left">COMPLAINT: </p></th>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px" colspan="3">N/A</td>
</tr>
</table>


<br><hr>

<p></p>

<table width="100%" style="border-collapse: collapse;">
<tr>
<td align="center" style="font-size: 15px;"><b> RADIOGRAPHY RESULT</b></td>
</tr>
</table>

<br>

<div style="font-size: 14px; font-family: Arial, Helvetica, sans-serif; border: none; text-align: justify; height: 5000px;">'.$interpretation.'</div>
<table>
<tr><th style="border-bottom: solid 1px black;"></th></tr>

<tr>
<!--td style="text-align: center; background-image:url(http://'.$ip.'/arv2022/radiology/signature/'.$sig.'.png);background-repeat:no-repeat;background-size:450px 130px; background-position: center;"-->
<br>
<b>'.$radiologist.'</b><br>
Radiologist<br>
Lic. No.  <br>
Electronically Signed <br>
</p>
</td>
</tr>
<tr>
<th style="border-bottom: solid 1px black;"></th>
</tr>
<tr>
<td><b><font color="black" size="1">DISCLAIMER:</b> These findings ar based on radiological imaging studies. It must be correlated with clinical, laboratory, and other ancillary procedures for a comprehensive assesment of patient"s condition. Thus, radiology reports are best explained  by the attending  physician to the patient.</td>
</tr>
<tr>
<td><br><b><font color="black" size="1">RAD TECH:$validate</b></td>
</tr>

</table>
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page
$pdf->AddPage();



// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_061.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
