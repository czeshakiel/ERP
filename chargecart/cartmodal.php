<style>
.glowing-circle3 {
box-shadow: 0px 0px 2000px #6e7fcb;
}
</style>


<div class="modal fade" id="cart" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xl glowing-circle3">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><b><a href='?printslip&caseno=<?php echo $caseno ?>'><button class='btn btn-warning'><i class='icofont-printer'></i> Print Slip</button></a></b></h5>

<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='tabiframe' src='' width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>



<div class="modal fade" id="carthm" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xl glowing-circle3">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="icofont-cart-alt"></i> Take Home Medicine</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='tabiframehm' src='' width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>
