<style>
.glowing-circle2 {
  box-shadow: 0px 0px 2000px #6e7fcb;
}
</style>


<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<div class="modal fade" id="return" tabindex="-1" data-bs-backdrop="false">
<div class="modal-dialog modal-xl glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> RETURN UNUSED MEDICINE AND SUPPLIES</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='tabiframereturn' src='' width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>

<script>
function return(){
let a=document.createElement('a');
a.target='#return';
a.href='save_collection.php?orno=$ofr&nursename=$nursename&paymenttype=$paymenttype&caseno=$caseno&dis=$dis&mm=$mm&dd=$dd&yy=$yy&sukicard=$sukicard&transactions=$transactions&specialdisc=$specialdisc&specialdisctype=$specialdisctype&orseries=$orno_id$datax';
a.click();
</script>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->
