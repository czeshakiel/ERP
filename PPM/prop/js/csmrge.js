
$(document).ready(function() {
    $('.selectbox select').selectpicker();
});

function convertToUpperCase(input) {
    input.value = input.value.toUpperCase();
}

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});

// view Caseno count
function viewCasenoCount(ptidno, lname, fname, mname) {
    $.post('prop/connect/fetchpatientprofile.php', { ptid: ptidno }, function (data, status) {
        var fth = JSON.parse(data);
        $("#patientIdNoDis").text("(" + ptidno + ")");
        $("#patientName").text(lname + ", " + fname + " " + mname);

        // Create a table element
        var table = $("<table>");
        table.addClass("table table-bordered"); // Add any necessary classes

        // Create a table header
        var thead = $("<thead>");
        thead.html("<tr><th class='txtcntr'>Case Number</th><th class='txtcntr'>Date Admit</th></tr>");
        table.append(thead);
        // Create a table body
        var tbody = $("<tbody>");
        for (var i = 0; i < fth.length; i++) {
            var row = $("<tr>");
            row.append("<td class='txtcntr'>" + fth[i].caseno + "</td>");
            row.append("<td class='txtcntr'>" + fth[i].dateadmit + "</td>");
            tbody.append(row);
        }
        table.append(tbody);
        // Append the table to the specific div with a class
        $("#casenolist").empty().append(table);
        $("#viewNumberofCasenoModal").modal('show');
    });
}

function mergePatientidno(ptidno, lsname, fsname, mlname) {
    $.post('prop/connect/fetchdoubleptprofile.php', { ptidno: ptidno, lsname: lsname, fsname:fsname, mlname: mlname }, function (data) {
        var dpt = JSON.parse(data);

        // Clear the existing list items
        $('#doublelist').empty();

        // Iterate over the data and add each item to the list
        for (var i = 0; i < dpt.length; i++) {
            var listItem = $('<li class="item">').append(dpt[i].lastname + ", " + dpt[i].firstname + " " + dpt[i].middlename + "(<span style='color:red; font-weight:bold'>" + dpt[i].patientidno + "</span>)");

            // Add a click event listener to each list item
            listItem.click(function () {
                var selectedName = $(this).text();
                $("#selectedptprofile").val(selectedName);
                $("#selectedptprofile").removeClass('errorbox');
                $("#sppmsg").html("");
            });

            // Append the list item to the list
            $('#doublelist').append(listItem);
        }

        // Set other values and show the modal
        $("#patientnameid").val(lsname + ", " + fsname + " " + mlname + "(" + ptidno + ")");
        $("#mergingModal").modal('show');
    });
}

function mergepatientprofile(){
    var tomergeptprofile = $("#patientnameid").val();
    var org_ptprofile = $("#selectedptprofile").val();
    var tmgid = "";
    var orgid = "";

    var tomrgeid = extractID(tomergeptprofile);
    var orgptid = extractID(org_ptprofile);
    if(!org_ptprofile){
        $("#selectedptprofile").addClass('errorbox');
        $("#sppmsg").html("<span style='color:red'><b>*required</b></span>");
    }else{
        if(tomrgeid !== null){
            tmgid = tomrgeid;
        }else{
            tmgid = "no_id";
        }

        if(orgptid !== null){
            orgid = orgptid
        }else{
            orgid = "no_id";
        }
        if(tmgid && orgid == "no_id"){
            $("#alertmsg").html("<div role='alert' class='alert alert-warning'>No data with this patient id.</div>");
        }else if(tmgid == orgid){
            $("#alertmsg").html("<div role='alert' class='alert alert-danger'>Cannot be merge, the same patient id.</div>");
        }else{
            $.post('prop/connect/mergepatientprofile.php',{orgid:orgid,tmgid:tmgid},function(data){
                alert(data);
            });
        }
    }
    $("#selectedptprofile").on('input', function(){
        $("#selectedptprofile").removeClass('errorbox');
        $("#sppmsg").html("");
    })
}

function extractID(input) {
    // Use a regular expression to extract the ID enclosed in parentheses
    var idRegex = /\((\d{2}-\d{2}-\d{2})\)/;
    
    // Try to match the ID pattern in the input
    var match = input.match(idRegex);
    
    if (match) {
        var id = match[1]; // Extract the ID
        return id;
    } else {
        return null; // No match found
    }
}
