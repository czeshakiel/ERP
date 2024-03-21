<style>
.imgx {
  border-radius: 8px;
 float: left;
    width:  120px;
    height: 120px;
    object-fit: cover;
}
</style>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($_SESSION['deptdoc'])." DEPARTMENT" ?><small style="font-size: 13px;"> || Reader: <b><?php echo strtoupper($_SESSION['userdoc']); ?></b></small></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">



<table align="center" width="90%">
<tr>
<td><a href="?ptlist&page=xray"><img src="../main/img/xray.jpg" class="imgx" title="CLick Here For X-Ray"></a></td>
<td style="width: 88%;" valign="bottom"><b><i class="bi bi-arrow-left-square-fill"></i> CLICK THE IMAGE</b><br><font class="font8x">Diagnostic X-ray, or radiography, is a special method for taking pictures of areas inside the body. A machine focuses a small amount of radiation on the area of the body to be examined. The X-rays pass through the body, creating an image on film or a computer display.<br><b>XRAY PROCEDURE</b></td>
</tr><tr><td colspan="2">&nbsp;</td></tr><tr>
<td><a href="?ptlist&page=ultrasound"><img src="../main/img/ultra.jpg" class="imgx" title="CLick Here For Ultrasound"></a></td>
<td valign="bottom"><b><i class="bi bi-arrow-left-square-fill"></i> CLICK THE IMAGE</b><br><font class="font8x">Diagnostic ultrasound, also called sonography or diagnostic medical sonography, is an imaging method that uses sound waves to produce images of structures within your body. The images can provide valuable information for diagnosing and directing treatment for a variety of diseases and conditions.<br><b>ULTRASOUND PROCEDURE</b></td>
</tr><tr><td colspan="2">&nbsp;</td></tr><tr>
<td><a href="?ptlist&page=ctscan"><img src="../main/img/ctscan.jpg" class="imgx" title="CLick Here For CT-SCAN"></a></td>
<td valign="bottom"><b><i class="bi bi-arrow-left-square-fill"></i> CLICK THE IMAGE</b><br><font class="font8x">A computerized tomography (CT) scan combines a series of X-ray images taken from different angles around your body and uses computer processing to create cross-sectional images (slices) of the bones, blood vessels and soft tissues inside your body. CT scan images provide more-detailed information than plain X-rays do.<br><b>CT SCAN PROCEDURE</b></td>
</tr><tr><td colspan="2">&nbsp;</td></tr><tr>
<td><a href="?ptlist&page=mamo"><img src="../main/img/mamo.jpg" class="imgx" title="CLick Here For Mammography"></a></td>
<td valign="bottom"><b><i class="bi bi-arrow-left-square-fill"></i> CLICK THE IMAGE</b><br><font class="font8x">During a mammogram, your breasts are compressed between two firm surfaces to spread out the breast tissue. Then an X-ray captures black-and-white images that are displayed on a computer screen and examined for signs of cancer.<br><b>MAMMOGRAM PROCEDURE</b></td>
</tr>
</table>


</div>
</div>
</div>
</div>
</section>
</main>

