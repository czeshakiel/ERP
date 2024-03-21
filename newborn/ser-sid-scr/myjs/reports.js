function populateYears() {
    var currentYear = new Date().getFullYear();
    var startYear = currentYear - 50;
    var endYear = currentYear;
    var selectElement = document.getElementById("year-select");
    selectElement.innerHTML = "";
    for (var year = startYear; year <= endYear; year++) {
        var option = document.createElement("option");
        option.value = year;
        option.text = year;
        selectElement.add(option);
    }
    selectElement.value = currentYear;
}
populateYears();

document.addEventListener('DOMContentLoaded', function () {
    const nbs_report_list = document.getElementById("nbs_report_list");
    const apiUrl = 'ser-sid-scr/myphp/fetch_nbs_reportlist.php';

    fetch(apiUrl)
        .then(response => response.text())
        .then(htmlTable => {
            nbs_report_list.innerHTML = htmlTable;
             var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
             var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                 return new bootstrap.Tooltip(tooltipTriggerEl);
             });
        })
        .catch(error => {
            console.error('Error fetching HTML table:', error);
        });
});

function createNbsCensusReport(){
    var yearSlct = document.getElementById("year-select").value;
    var yearselected = document.getElementById("yearselected");
    var pst_year = document.getElementById("pst_year");
    var yrmdl = document.getElementById("yrmdl");
    $.post('ser-sid-scr/myphp/save_nbs_year.php', {yearSlct: yearSlct}, function(data,status){
        if(data == "success"){
            yearselected.textContent = yearSlct;
            pst_year.value = yearSlct;
            manageNbsReport(yearSlct);
        }else if(data == "exists"){
            yrmdl.textContent = yearSlct;
            $("#nbsReportAlreadyDone").modal("show");
            $("#confReportBtn").on("click", function(){
                $("#nbsReportAlreadyDone").modal("hide");
                location.reload();
            })
        }else{
            $("#popupAlertWarning").modal("show");
            $(".confWBtn").on("click",function(){
                $("#popupAlertWarning").modal("hide");
                    location.reload();
            })
        }
    });   
}

function manageNbsReport(slctd_year) {
    var yearselected = document.getElementById("yearselected");
    var pst_year = document.getElementById("pst_year");
    yearselected.textContent = slctd_year;
    pst_year.value = slctd_year;
    $.post('ser-sid-scr/myphp/fetch_nbsreport_details.php', { slctd_year: slctd_year }, function (data) {
        var nbsReportData = JSON.parse(data);
        var monthNames = ["january", "february", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december"];
    
        for (var i = 0; i < monthNames.length; i++) {
            var monthName = monthNames[i];
            var monthData = nbsReportData[monthName];
    
            if (monthData) {
                document.getElementById(monthName + '_ttl_delv').value = monthData.ttl_delv;
                document.getElementById(monthName + '_ttl_neod').value = monthData.ttl_neod;
                document.getElementById(monthName + '_ttl_lvb').value = monthData.ttl_lvb;
                document.getElementById(monthName + '_ttl_stbr').value = monthData.ttl_stbr;
                document.getElementById(monthName + '_ttl_inbs').value = monthData.ttl_inbs;
                document.getElementById(monthName + '_ttl_onbs').value = monthData.ttl_onbs;
                document.getElementById(monthName + '_ttl_refu').value = monthData.ttl_refu;
                document.getElementById(monthName + '_ttl_tran').value = monthData.ttl_tran;
                document.getElementById(monthName + '_reason_refu').value = monthData.reason_refu;
            } else {
                console.error('Data for ' + monthName + ' is missing.');
            }
        }
        $("#createReportModal").modal("show");
    }).fail(function () {
        alert('Error fetching NBS report details. Please try again.');
    });    
}

function saveNbsReportDetails() {
    var slctdYear = document.getElementById("pst_year").value;
    var slctdYearData = { year: slctdYear };    
    var january = collectData('january');
    var february = collectData('february');
    var march = collectData('march');
    var april = collectData('april');
    var may = collectData('may');
    var june = collectData('june');
    var july = collectData('july');
    var august = collectData('august');
    var september = collectData('september');
    var october = collectData('october');
    var november = collectData('november');
    var december = collectData('december');

    var requestData = { slctdYearData, january, february, march, april, may, june, july, august, september, october, november, december};
    fetch('ser-sid-scr/myphp/save_nbs_report_details.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(requestData),
    })
    .then(response => response.text())
    .then(message => {
        console.log(message);
        if(message == "success"){
            $("#createReportModal").modal("hide");
            $("#gettingFileReady").modal('show');
            setTimeout(() => {
                $("#gettingFileReady").modal('hide');
                $("#yearReportCrt").text(slctdYear);
                $("#popupAlertSuccessReport").modal('show');
            }, 3000);
            $("#confRepDone").on('click', function(){
                $("#popupAlertSuccessReport").modal('hide');
                location.reload();
            });
            $(document).on("keypress", function (event) {
                if (event.which === 13) {
                    $("#popupAlertSuccessReport").modal('hide');
                }
            });
        }else{
            $("#failedToSaveModal").modal('show');
            $("#confFailed2").on('click', function(){
                $("#failedToSaveModal").modal('hide');
            });
            $(document).on("keypress", function (event) {
                if (event.which === 13) {
                    $("#failedToSaveModal").modal('hide');
                }
            });
        }
    })
    .catch(error => {
        console.error('Error during fetch:', error);
        alert('Error saving data. Please try again.');
    });
}

function collectData(month) {
    return {
        ttl_delv: document.getElementById(month + '_ttl_delv').value,
        ttl_neod: document.getElementById(month + '_ttl_neod').value,
        ttl_lvb: document.getElementById(month + '_ttl_lvb').value,
        ttl_stbr: document.getElementById(month + '_ttl_stbr').value,
        ttl_inbs: document.getElementById(month + '_ttl_inbs').value,
        ttl_onbs: document.getElementById(month + '_ttl_onbs').value,
        ttl_refu: document.getElementById(month + '_ttl_refu').value,
        ttl_tran: document.getElementById(month + '_ttl_tran').value,
        reason_refu: document.getElementById(month + '_reason_refu').value
    };
}

// propmt user when closing modal report
var isClosing = false;
var originalData = {};

function retrieveOriginalData() {
    var retrvYear = document.getElementById("pst_year").value;
    $.post('ser-sid-scr/myphp/getOriginalData.php', { retrvYear: retrvYear }, function (data) {
        originalData = JSON.parse(data);
    });
}

function getCurrentDataFromModal() {
    var currentData = {};
    var months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
    for (var i = 0; i < months.length; i++) {
        var month = months[i];
        currentData[month] = {
            ttl_delv: $("#" + month + "_ttl_delv").val(),
            ttl_neod: $("#" + month + "_ttl_neod").val(),
            ttl_lvb: $("#" + month + "_ttl_lvb").val(),
            ttl_stbr: $("#" + month + "_ttl_stbr").val(),
            ttl_inbs: $("#" + month + "_ttl_inbs").val(),
            ttl_onbs: $("#" + month + "_ttl_onbs").val(),
            ttl_refu: $("#" + month + "_ttl_refu").val(),
            ttl_tran: $("#" + month + "_ttl_tran").val(),
            reason_refu: $("#" + month + "_reason_refu").val(),
        };
    }
    return currentData;
}

function compareData(original, current) {
    for (var month in original) {
        if (original.hasOwnProperty(month) && current.hasOwnProperty(month)) {
            for (var field in original[month]) {
                if (original[month].hasOwnProperty(field) && current[month].hasOwnProperty(field)) {
                    if (original[month][field] != current[month][field]) {
                        return true;
                    }
                }
            }
        }
    }
    return false;
}

$("#createReportModal").on('show.bs.modal', function () {
     $(this).modal({
        keyboard: false
    });
    retrieveOriginalData();
});

$("#closeNbsReportDetails").on('click', function (e) {
    checkForChangesAndClose();
    if (isClosing) {
        e.preventDefault();
    }
});

$(document).on('keyup', function (e) {
    if (e.key === "Escape") {
        checkForChangesAndClose();
        if (isClosing) {
            e.preventDefault();
            $('#confirmationCloseReport').modal('show');
        }
    }
});

$("#cancelCloseRep").on('click', function () {
    $('#confirmationCloseReport').modal('hide');
    isClosing = false;
});

$("#confirmedCloseRep").on('click', function () {
    checkForChangesAndClose();
    if (isClosing) {
        $('#createReportModal').modal('hide');
        $('#confirmationCloseReport').modal('hide');
        location.reload();
    }
});

function handleEscKey(e) {
    if (e.key === "Escape") {
        checkForChangesAndClose();
        if (!isClosing) {
            e.preventDefault();
            $('#confirmationCloseReport').modal('show');
        }
    }
}

function checkForChangesAndClose() {
    if (isClosing) return;
    var currentData = getCurrentDataFromModal();
    var changes = compareData(originalData, currentData);
    if (changes) {
        $('#confirmationCloseReport').modal('show');
        isClosing = true;
        return;
    }else{
        $('#createReportModal').modal('hide');
        location.reload();
    }
}

function chooseReport(slctdYr){
    $("#reportSelectionModal").modal('show');
    $("#yearlyNbsReport").on('click', function(){
        window.open('../yrly_generate_nbs_report/' + slctdYr);
    });
    $("#monthlyNbsReport").on('click', function(){
        window.open('../mnly_generate_nbs_report/' + slctdYr);
    });
}

function generate_audiometry_report(){
    const audCode = document.getElementById("aud_code").value;
    const audDateFrom = document.getElementById("aud_dateFrom").value;
    const audDateTo = document.getElementById("aud_dateTo").value;
    const form = document.createElement("form");
        form.method = "POST";
        form.action = "../audiometry_report";
        form.target = "_blank";

        const reportInput = document.createElement("input");
        reportInput.type = "text";
        reportInput.name = "audCode";
        reportInput.value = audCode;
        reportInput.style.display = "none";
        form.appendChild(reportInput);

        const datefInput = document.createElement("input");
        datefInput.type = "date";
        datefInput.name = "audDateFrom";
        datefInput.value = audDateFrom;
        form.appendChild(datefInput);

        const datetInput = document.createElement("input");
        datetInput.type = "date";
        datetInput.name = "audDateTo";
        datetInput.value = audDateTo;
        form.appendChild(datetInput);

        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
}

function generate_repeat_report(){
    const desc_code = document.getElementById("slctdnbsrep").value;
    const rep_datefrom = document.getElementById("rep_dateFrom").value;
    const rep_dateto = document.getElementById("rep_dateTo").value;

    if(!desc_code){
        $("#slctdnbsrep").next('.select2').addClass("error-input");
    }else{
        const iform = document.createElement("form");
        iform.method = "POST";
        iform.action = "../nbs_repeat_report";
        iform.target = "_blank";

        const prdcode = document.createElement("input");
        prdcode.type = "text";
        prdcode.name = "repCode";
        prdcode.value = desc_code;
        prdcode.style.display = "none";
        iform.appendChild(prdcode);

        const dateRepFrom = document.createElement("input");
        dateRepFrom.type = "date";
        dateRepFrom.name = "repDateFrom";
        dateRepFrom.value = rep_datefrom;
        iform.appendChild(dateRepFrom);

        const dateRepTo = document.createElement("input");
        dateRepTo.type = "date";
        dateRepTo.name = "repDateTo";
        dateRepTo.value = rep_dateto;
        iform.appendChild(dateRepTo);
        
        document.body.appendChild(iform);
        iform.submit();
        document.body.removeChild(iform);
    }
    $("#slctdnbsrep").next('.select2').on("click", function () {
        $("#slctdnbsrep").next('.select2').removeClass("error-input");
    });
}