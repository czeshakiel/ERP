function handleRequestClick(requestType) {
    sessionStorage.setItem("selectedRequestType", requestType);
    var newUrl = '?requests';
    $.ajax({
        url: 'ser-sid-scr/myphp/set_session.php',
        method: 'POST',
        data: { selectedRequestType: requestType },
        success: function(response) {
            console.log("Session variable set successfully");
            window.location.href = newUrl;
        },
        error: function(error) {
            console.error("Error setting session variable:", error);
        }
    });
}