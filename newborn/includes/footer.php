<script src="assets/bundles/apexcharts.bundle.js"></script>
<script src="assets/bundles/dataTables.bundle.js"></script>
<script src="assets/plugin/prism/prism.js"></script>
<script src="assets/js/call-pages.js"></script>
<script src="assets/js/template.js"></script>
<script>
$(document).ready(function() {
$('.deleterow').on('click',function(){
var tablename = $(this).closest('table').DataTable();  
tablename
.row( $(this)
.parents('tr') )
.remove()
.draw();
});
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
function reinitializeTooltips() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}
reinitializeTooltips();
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var dept = document.getElementById("session_dept").value;
    var verifier = <?php echo json_encode($verifier); ?>;
    if (verifier === false) {
        $("#sessionExpiredModal").modal('show');
    }
    $("#close_session_modal").click(function() {
        window.location = '../login/?dept=' + encodeURIComponent(dept);
    });
});
</script>
<script src="ser-sid-scr/myjs/reports.js"></script>