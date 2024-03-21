<?php
$dfrom = date("Y")."-01-01";
$dto = date("Y")."-12-31";
if($dept=="xray" or $dept=="XRAY" or $dept=="laboratory" or $dept=="LABORATORY" or $dept=="rt" or $dept=="RT" or $dept=="heart" or $dept=="HEART"){$hide ="";}else{$hide="hidden";}
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?main">Main</a></li>
          <li class="breadcrumb-item"><a href="?archives">Search Archive</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

<p><font color="black"><b><i class="icofont-search-job"></i> Search Archives</font></b></font></p><hr>


<table width="100%"><tr><td width="30%">
<div class="input-group mb-3" valign="bottom">
<span class="input-group-text" id="basic-addon1"><i class="icofont-search-2"></i></span>
<input type="text" class="form-control" name="search_text" id="search_text" onchange="aa()" placeholder="Search Patient [Enter]">
</div>
</td><td align="left" width="20%" style="font-size: 11px;">&nbsp; e.g <font color="red">Juan Dela Cruz</font> or <font color="red">Dela Cruz Juan</font></font></td>
<td><font class="font7">Date Range: <input type="date" name="dfrom" id="dfrom" onchange="aa()" value="<?php echo $dfrom ?>" style="width: 18%; height:30px; font-size:10pt; padding: 0px;">
 To <input type="date" name="dto" id="dto" onchange="aa()" value="<?php echo $dto ?>" style="width: 18%; height:30px; font-size:10pt; padding: 0px;">
 
 <select id="options" onchange="aa()" style="width: 15%; height:30px; font-size:10pt; padding: 0px;">
 <option value="all">ALL</option>
 <option value="ipd">IPD</option>
 <option value="opd">OPD</option>
 <option value="walkin">Walkin</option>
 <option value="rdu">RDU</option>
 <option value="ar">AR</option>
 <option value="discharged">Discharged</option>
 </select>
 
 <select id="opsearch" onchange="aa()" style="width: 15%; height:30px; font-size:10pt; padding: 0px;" <?php echo $hide ?>>
 <option value="profile">Profile</option>
 <option value="request">Request</option>
 </select>
</tr></table>

<form method="POST">
<table style="height: 400px; width: 100%;"><tr><td valign="TOP" align="center">
<div id="result"></div>
<img style="width: 400px; display: none; align: center;" src="../main/img/loading.gif" id="loading2"></img>  
</td></tr></table>
</form>

<script>
function aa(){
document.getElementById("loading2").style.display="";
document.getElementById("result").style.display="none";

var str = document.getElementById('search_text').value;
var dfrom = document.getElementById('dfrom').value;
var dto = document.getElementById('dto').value;
var options = document.getElementById('options').value;
var opsearch = document.getElementById('opsearch').value;
var dept = "<?php echo $dept ?>";
var username = "<?php echo $user ?>";
var userunique = "<?php echo $userunique ?>";
var branch = "<?php echo $branch ?>";
$.get("../nsstation/searcharchivesfetch.php", {str:str, dept:dept, username:username, userunique:userunique, branch:branch, dfrom:dfrom, dto:dto, options: options, opsearch:opsearch},
function (data) {$("#result").html(data); document.getElementById("loading2").style.display="none"; document.getElementById("result").style.display="";});   
}
</script>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>



