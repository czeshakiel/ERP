<script>
document.addEventListener("DOMContentLoaded", function() {
    var verifier = <?php echo json_encode($verifier); ?>;
    if (verifier === false) {
        $("#sessionExpiredModal").modal('show');
    }
    $("#close_session_modal").click(function() {
        window.location = '../';
    });
});
</script>