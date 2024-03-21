<script src="../main/assets/bundles/libscripts.bundle.js"></script>
<script src="../main/assets/bundles/apexcharts.bundle.js"></script>
<script src="../main/js/template.js"></script>
<script src="../main/js/page/hr.js"></script>
<script src="../main/assets/bundles/dataTables.bundle.js"></script>
<script src="../main/assets/plugin/prism/prism.js"></script>
<script src="../main/js/template.js"></script>
<script src="../main/arv_new/select2/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {

    $('.select2-single').select2();

      // Select2 Single  with Placeholder
      $('.select2-single-placeholder').select2({
        placeholder: "Select a Province",
        allowClear: true
      });      

      // Select2 Multiple
      $('.select2-multiple').select2();

$('#myProjectTable')

.dataTable( {
responsive: true,
columnDefs: [
{ targets: [-1, -3], className: 'dt-body-right' }
]
});

$('.deleterow').on('click',function(){
var tablename = $(this).closest('table').DataTable();  
tablename
.row( $(this)
.parents('tr') )
.remove()
.draw();

} );
});
</script>


<script>
$(document).ready(function() {
$('#patient-table')
.addClass( 'nowrap' )
.dataTable( {
responsive: true,
columnDefs: [{ targets: [-1, -3], className: 'dt-body-right' }]
});

$('[data-toggle="popover"]').popover();
});

function sbview(){
const sidebar = document.querySelector('.sidebar');
if(sidebar.style.transform == 'translateX(-100%)'){sidebar.style.transform = 'translateX(0)';}
else{sidebar.style.transform = 'translateX(-100%)';}
}


const sidebar = document.querySelector('.sidebar');
const mediaQuery = window.matchMedia("(min-width: 1275.99px)");
const handleMediaQueryChange = (mediaQuery) => {
if (mediaQuery.matches) {sidebar.style.transform = 'translateX(0)';} 
else {sidebar.style.transform = 'translateX(-100%)';}
}

mediaQuery.addListener(handleMediaQueryChange);
handleMediaQueryChange(mediaQuery);
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var session_verifier = <?php echo json_encode($verifier); ?>;
    if (session_verifier === false) {
        $("#sessionExpiredModal").modal('show');
    }
    $("#close_session_modal").click(function() {
        window.location = '../';
    });
});
</script>



