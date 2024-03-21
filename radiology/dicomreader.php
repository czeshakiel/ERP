
<?php
$sourceFile = '';
$destinationFile = '/path/to/destination/file.txt';

$remoteFile = 'http://38.17.52.121/imaging/202210100923480752.jpg';
$contents = file_get_contents($remoteFile);

if ($contents !== false) {
    file_put_contents('../image/202210100923480752.jpg', $contents);
    echo 'File downloaded successfully';
} else {
    echo 'Failed to download file';
}
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?view=main">Main</a></li>
<li class="breadcrumb-item"><a href=""></a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='tabiframereturn' src="https://dicomviewer.net/viewer" width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>
</section>
</main>

