function convertToUpperCase(input) {
    input.value = input.value.toUpperCase();
}

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});


function viewCasenoCount(ptidno, lname, fname, mname) {
    $.post('prop/connect/fetchpatientprofile.php', { ptid: ptidno }, function (data, status) {
        var fth = JSON.parse(data);
        $("#patientIdNoDis").text("(" + ptidno + ")");
        $("#patientName").text(lname + ", " + fname + " " + mname);

        var table = $("<table>");
        table.addClass("table table-bordered");
        var thead = $("<thead>");
        thead.html("<tr><th class='txtcntr'>Case Number</th><th class='txtcntr'>Date Admit</th></tr>");
        table.append(thead);
        var tbody = $("<tbody>");
        for (var i = 0; i < fth.length; i++) {
            var row = $("<tr>");
            row.append("<td class='txtcntr'>" + fth[i].caseno + "</td>");
            row.append("<td class='txtcntr'>" + fth[i].dateadmit + "</td>");
            tbody.append(row);
        }
        table.append(tbody);
        $("#casenolist").empty().append(table);
        $("#viewNumberofCasenoModal").modal('show');
    });
}

function mergePatientidno(ptidno, lsname, fsname, mdname, dofbirth) {
    $.post('prop/connect/fetchdoubleptprofile.php', { ptidno: ptidno, lsname: lsname, fsname:fsname, mdname:mdname, dofbirth: dofbirth }, function (data) {
        var dpt = JSON.parse(data);

        $('#doublelist').empty();
        for (var i = 0; i < dpt.length; i++) {
            var listItem = $('<li class="item">').append(dpt[i].lastname + ", " + dpt[i].firstname + " " + dpt[i].middlename + "(<span style='color:black; font-weight:bold'>" + dpt[i].patientidno + "</span>)");

            listItem.click(function () {
                var selectedName = $(this).text();
                $("#originalptprofile").val(selectedName);
                $("#originalptprofile").removeClass('errorbox');
                $("#sppmsg").html("");
            });
            
            $('#doublelist').append(listItem);
        }

        $("#patientnameid").val(lsname + ", " + fsname + " " + mdname + "(" + ptidno + ")");
        $("#mergingModal").modal('show');
    });
}

function mergepatientprofile(){
    var tomergeptprofile = $("#patientnameid").val();
    var org_ptprofile = $("#originalptprofile").val();
    var loginuser = $("#loginuser").val();
    var tmgid = "";
    var orgid = "";

    var tomrgeid = extractID(tomergeptprofile);
    var orgptid = extractID(org_ptprofile);
    if(!org_ptprofile){
        $("#originalptprofile").addClass('errorbox');
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
            $("#alertmsg").html("<div role='alert' class='alert alert-warning'>No unknown patient id.</div>");
        }else if(tmgid == orgid){
            $("#alertmsg").html("<div role='alert' class='alert alert-danger'>Cannot be merge, the same patient id.</div>");
        }else{
            $('#mergingModal').addClass('modal-blur');
            $("#cons_patientidno").text(orgid);
            $("#selectedtomerge").text(tmgid);
            $("#confirmMergeModal").modal('show');
            $("#confirmedMergePtProfile").on('click', function(){
                $.post('prop/connect/mergepatientprofile.php',{orgid:orgid, tmgid:tmgid, loginuser:loginuser},function(data){
                    if(data == "success"){
                        $("#popupAlertSuccess").modal('show');
                        $(".confSBtn").on('click', function(){
                            $('#confirmMergeModal').modal('hide');
                            location.reload();
                        });
                    }else{
                        $("#popupAlertFailed").modal('show');
                        $(".confEBtn").on('click', function(){
                            $('#popupAlertFailed').modal('hide');
                        });
                    }
                });
            })
        }
    }
    
    $("#originalptprofile").on('input', function(){
        $("#originalptprofile").removeClass('errorbox');
        $("#sppmsg").html("");
    })

    $('#confirmMergeModal').on('hidden.bs.modal', function () {
        $('#mergingModal').removeClass('modal-blur');
    });
    
}

function extractID(input) {
    var idRegex = /\((\d{2}-\d{2}-\d{2})\)/;
    var match = input.match(idRegex);
    
    if (match) {
        var id = match[1];
        return id;
    } else {
        return null;
    }
}

// server side js for display total number of duplicate patient profile
var duplicateCountDiv = document.getElementById('duplicateCountDiv');
duplicateCountDiv.classList.add('tooltipbutton');
function displayError(message) {
  duplicateCountDiv.textContent = 'An error occurred: ' + message;
}

function fetchDuplicateNames() {
  fetch('prop/connect/fetchduplicateNames.php')
    .then(response => response.json())
    .then(data => {
      var countis = data;
      duplicateCountDiv.textContent = 'Total Duplicate Records: ' + countis;
      duplicateCountDiv.setAttribute('data-tooltip', 'Click to view duplicate list.');
    })
    .catch(error => {
      displayError('Fetching duplicate names failed: ' + error);
    });
}

function displayDuplicatePatientProfileList() {
    $.get('prop/connect/fetchduplicateptprofilelist.php', function (data) {
        var vpp = JSON.parse(data);
        var table = $("<table>");
        table.addClass("table table-hover align-middle mb-0");
        table.attr("id", "patienttable");
        table.css("width", "100%");
        var thead = $("<thead>");
        thead.html("<tr><th class='txtheader'>First Name</th><th class='txtheader'>Middle Name</th><th class='txtheader'>Last Name</th><th class='txtheaderdob'>Date of Birth</th></tr>");
        table.append(thead);
        var tbody = $("<tbody>");
        for (var i = 0; i < vpp.length; i++) {
            var row = $("<tr>");
            row.append("<td class='txtdata'>" + vpp[i].firstname + "</td>");
            row.append("<td class='txtdata'>" + vpp[i].middlename + "</td>");
            row.append("<td class='txtdata'>" + vpp[i].lastname + "</td>");
            row.append("<td class='txtdatadob'>" + vpp[i].dateofbirth + "</td>");
            tbody.append(row);
        }
        table.append(tbody);
        $("#PTdataTable").empty().append(table);
        $("#duplicatePatientNameList").modal('show');

        $('#patienttable').DataTable({
            responsive: true,
            columnDefs: [
                { targets: [-1, -3], className: 'dt-body-right' }
            ]
        });
    });
}

duplicateCountDiv.addEventListener('click', displayDuplicatePatientProfileList);
fetchDuplicateNames();

function ptprofileMergedList(){
    $.get('prop/connect/fetchmergedptprofilelist.php',function(data,status){
        var mrg = JSON.parse(data);
        var table = $("<table>");
        table.addClass("table table-hover align-middle mb-0");
        table.attr("id", "mrgpatienttable");
        table.css("width", "100%");
        var thead = $("<thead>");
        thead.html("<tr><th class='txtheaderdob'>Patientidno</th><th class='txtheader'>Patient Name</th><th class='txtheaderdob'>Age</th><th class='txtheaderdob'>Date of Birth</th><th class='txtheaderdob'>Merged w/ PT IDNo</th><th class='txtheaderdob'>Merged By</th></tr>");
        table.append(thead);
        var tbody = $("<tbody>");
        for (var i = 0; i < mrg.length; i++) {
            var dateOfBirth = new Date(mrg[i].dateofbirth);
            var currentDate = new Date();
            var ageDisplay = calculateAge(dateOfBirth, currentDate);
            var gender = mrg[i].sex;
            var imageSrc = "prop/assets/images/xs/avatar3.jpg";
            if (gender === "M") {
                imageSrc = "prop/assets/images/xs/male.jpg";
            } else if (gender === "F") {
                imageSrc = "prop/assets/images/xs/female.jpg";
            }

            var row = $("<tr>");
            row.append("<td class='txtdatadob' style='width:10%'>" + mrg[i].patientidno + "</td>");
            row.append("<td class='txtdata' style='width: 30%'><img src='" + imageSrc + "' class='avatar sm rounded-circle me-2' alt='profile-image'><span>" + mrg[i].firstname + " " + mrg[i].middlename + " " + mrg[i].lastname + "</span></td>");
            row.append("<td class='txtdatadob' style='width:10%'>" + ageDisplay + "</td>");
            row.append("<td class='txtdatadob'style='width:10%'>" + mrg[i].dateofbirth + "</td>");
            row.append("<td class='txtdatadob' style='width:10%'>" + mrg[i].merge_in + "</td>");
            row.append("<td class='txtdatadob' style='width:10%'>" + mrg[i].merged_by + "</td>");
            tbody.append(row);
        }
        table.append(tbody);
        $("#ptMergedListTable").empty().append(table);
        $("#ptProfileMergingHistory").modal('show');
        $('#mrgpatienttable').DataTable({
            responsive: true,
            columnDefs: [
                { targets: [-1, -3], className: 'dt-body-right' }
            ]
        });
    });
}

function calculateAge(dateOfBirth, currentDate) {
    var ageInMonths = (currentDate.getMonth() - dateOfBirth.getMonth()) + 12 * (currentDate.getFullYear() - dateOfBirth.getFullYear());
    if (ageInMonths < 12) {
        if(ageInMonths === 0){
            return ageInMonths;
        }else{
            return ageInMonths + " month" + (ageInMonths === 1 ? "" : "s");
        }
    } else {
        var years = Math.floor(ageInMonths / 12);
        var months = ageInMonths % 12;
        if (months === 0) {
            return years;
        } else {
            return years;
        }
    }
}