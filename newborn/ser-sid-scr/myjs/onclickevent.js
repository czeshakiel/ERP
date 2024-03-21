function loginuserDetails(lguser) {
    $.post('ser-sid-scr/myphp/fetch_user_details.php', { lguser: lguser }, function (data) {
        var user = JSON.parse(data);

        function abbreviateMiddleName(middleName) {
            return middleName ? `${middleName.charAt(0)}.` : "";
        }

        var abbreviatedMiddleName = abbreviateMiddleName(user.middlename);
        var fullName = `${user.firstname} ${abbreviatedMiddleName} ${user.lastname}`;
        var position = (user.position || "STAFF").toUpperCase();
        var empid = (user.empid || "00000").toUpperCase();

        $("#loginuser_name").text(fullName);
        $("#job_title").text(position);
        $("#employee_id").text(`EMP: ${empid}`);
        updateProfileImage(user.gender);
        $("#requestByProfile").modal('show');
    });
}

function updateProfileImage(gender) {
    var imageElement = document.querySelector(".profile-image img");
    if (gender && typeof gender === 'string') {
        var lowerCaseGender = gender.toLowerCase();
        if (lowerCaseGender.includes('female')) {
            imageElement.src = "assets/images/lg/femalestaff.jpg";
        } else if (lowerCaseGender === 'f') {
            imageElement.src = "assets/images/lg/femalestaff.jpg";
        } else if (lowerCaseGender === 'm'){
            imageElement.src = "assets/images/lg/malestaff.jpg";
        } else{
            imageElement.src = "assets/images/lg/malestaff.jpg";
        }
    }
}

function proceedTestdone(caseno, refno){
    var readersdiv = document.getElementById('readersdiv');
    $.post('ser-sid-scr/myphp/fetch_bbpatient_details.php',{caseno: caseno, refno: refno}, function(data,status){
        var combinedData = JSON.parse(data);
        var ptDetails = combinedData.ptDetails;
        var productDetails = combinedData.productDetails;
        var prodDesc = productDetails[0].productdesc;
        if(prodDesc == "AUDIOMETRY"){
            readersdiv.style.display = "block";
            $("#prodDescCon").val(true);
        }else{
            readersdiv.style.display = "none";
            $("#prodDescCon").val(false); 
        }
        var fName = ptDetails.lastname + ", " + ptDetails.firstname + " " + ptDetails.middlename + " => " + productDetails[0].approvalno;
        $("#bb_patientidno").val(ptDetails.patientidno);
        $("#bb_caseno").val(caseno);
        $("#bb_refno").val(refno);
        $("#bb_description").val(productDetails[0].productdesc);
        $("#bb_refphysician").val(combinedData.refphysician);
        $("#refphysician").val(ptDetails.ap);
        $("#bb_clinicalservices").val(productDetails[0].productdesc + " " + "RESULTS");
        $("#bby-fname").text(fName);
        $("#fsname").val(ptDetails.firstname);
        $("#mdname").val(ptDetails.middlename);
        $("#lsname").val(ptDetails.lastname);
        $("#lguser").val(productDetails[0].lguser);
        $("#productcode").val(productDetails[0].productcode);
        $("#trantype").val(productDetails[0].trantype);
        $("#productdesc").val(prodDesc);
        $("#senior").val(ptDetails.senior)
        $("#proceedTestdoneModal").modal('show');
    });
}

function sdfn_testdone(){
    var bb_radtech = $("#bb_radtech").val();
    var bb_seriesno = $("#bb_seriesno").val();
    var bb_patientidno = $("#bb_patientidno").val();
    var bb_caseno = $("#bb_caseno").val();
    var bb_refno = $("#bb_refno").val();
    var bb_description = $("#bb_description").val();
    var bb_refphysician = $("#refphysician").val();
    var bb_clinicalservices = $("#bb_clinicalservices").val();
    var fname = $("#fsname").val();
    var mdname = $("#mdname").val();
    var lsname = $("#lsname").val();
    var lguser = $("#lguser").val();
    var productcode = $("#productcode").val();
    var trantype = $("#trantype").val();
    var productdesc = $("#productdesc").val();
    var bb_reader = $("#bb_reader").val();
    var prodDescCon = $("#prodDescCon").val();
    if(prodDescCon == "true" && !bb_reader){
        $("#bb_reader").next('.select2').addClass('error-input');
    }else if (!bb_seriesno){
        $("#bb_seriesno").addClass('error-input');
    }else{
        $("#confirmationTestdone").modal('show');
        $("#confirmedTDone").on('click', function(){
            $.post('ser-sid-scr/myphp/save_request_testdone.php', {
                bb_radtech:bb_radtech,
                bb_seriesno:bb_seriesno,
                bb_patientidno:bb_patientidno,
                bb_caseno:bb_caseno,
                bb_refno:bb_refno,
                bb_description:bb_description,
                bb_refphysician:bb_refphysician,
                bb_clinicalservices:bb_clinicalservices,
                fname:fname,
                mdname:mdname,
                lsname:lsname,
                lguser:lguser,
                productcode:productcode,
                productdesc:productdesc,
                trantype:trantype,
                bb_reader:bb_reader
            }, function(data, status){
                console.log(data);
                if (data.startsWith("success:")) {
                    $("#loaderModal").modal("show");
                    $("#proceedTestdoneModal").modal("hide");
                    $("#confirmationTestdone").modal("hide");
                    function showSuccessModal() {
                        $("#loaderModal").modal("hide");
                        $("#spanfrtstdone").text(bb_description);
                        $("#popupAlertSuccess").modal("show");
                        $("#confTestdone").on("click", function () {
                            $("#popupAlertSuccess").modal("hide");
                            location.reload();
                        });
                        $(document).on("keypress", function (event) {
                            if (event.which === 13) {
                                location.reload();
                            }
                        });
                    }
                    const animationDuration = 1000;
                    setTimeout(showSuccessModal, animationDuration);
                }else if(data == "noitemfailed"){
                    $("#emptyStockNewbornKit").modal('show');
                    $("#confirmationTestdone").modal("hide");
                    $("#confRequestKit").on("click", function () {
                        $("#emptyStockNewbornKit").modal('hide');
                        $("#proceedTestdoneModal").modal("hide");
                    });
                }
                else {
                    $("#popupAlertFailed").modal("show");
                    $("#proceedTestdoneModal").modal("hide");
                    $("#confirmationTestdone").modal("hide");
                    $("#confTDoneFailed").on("click", function () {
                        location.reload();
                    });
                    $(document).on("keypress", function (event) {
                        if (event.which === 13) {
                            location.reload();
                        }
                    });
                }
            });
        });
    }
    $("#bb_reader").on('select2:select', function () {
        $(this).next('.select2').removeClass('error-input');
    });    
    
    $("#bb_seriesno").on('click', function () {
        $(this).removeClass('error-input');
    });    
}

function print_allsup(caseno, batchno, refno, trantype, user) {
    var form = document.createElement('form');
    form.method = 'GET';
    form.action = '../nsstation/printslip/ticket_batch.php';
    form.target = '_blank';

    function addInput(name, value) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = value;
        form.appendChild(input);
    }

    addInput('caseno', caseno);
    addInput('batchno', batchno);
    addInput('refno', refno);
    addInput('trantype', trantype);
    addInput('user', user);

    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}

// search patient archive
$(document).ready(function () {
    $("#search_patient").on('input', function () {
        $("#search_patient").removeClass('error-input');
        $("#search_patient").popover('hide');
    });

    $(".srch_button").on('click', function (event) {
        event.preventDefault();
        showLoader();
        search_archpatient();
    });

    $("#search_patient").on('keypress', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            showLoader();
            search_archpatient();
        }
    });

    window.search_archpatient = function() {
        $('#table_patientlist').html('');
        var search_patient = $("#search_patient").val();
        $("#search_patient").popover('hide');

        $("#search_patient").on('shown.bs.popover', function () {
            setTimeout(function () {
                $("#search_patient").popover('hide');
            }, 2000);
        });

        if (!search_patient) {
            hideLoader();
            $("#search_patient").addClass('error-input');
            $("#search_patient").popover('show');
        } else {
            showLoader();
            $.ajax({
                method: 'POST',
                url: 'ser-sid-scr/myphp/search_archpatient.php',
                data: { search_patient: search_patient },
                success: function (data) {
                    hideLoader();
                    $('#table_patientlist').html(data);
                    $("#search_result_container").show();
                        var totalCount = $('.dd-handle tbody tr.rw_cnt').length;
                        if (totalCount === 0) {
                            $('#search_result').text('No records found.');
                        } else {
                            $('#search_result').text(totalCount + ' results');
                        }
                    reinitializeTooltips();
                },
                error: function () {
                    hideLoader();
                    alert('Error executing the search.');
                }
            });
        }
    }

    function showLoader() {
        $("#myloader").show();
    }
    function hideLoader() {
        $("#myloader").hide();
    }
});

function print_report_result(caseno, lginuser, dept, refno){
    window.open("http://192.168.0.99:100/ERP/printresult/imaging/" + caseno + "/" + refno +"");
}

// laod readers selection
document.addEventListener("DOMContentLoaded", function () {
    const readerSelect = document.getElementById("readerSelect");
    const phpEndpoint = 'ser-sid-scr/myphp/fetch_readers_data.php';
    const emptyOption = document.createElement("option");
    emptyOption.value = "";
    emptyOption.text = "None";
    readerSelect.appendChild(emptyOption);

    fetch(phpEndpoint)
        .then(response => response.json())
        .then(data => {
            data.forEach(reader => {
                const option = document.createElement("option");
                option.value = reader.id;
                option.text = reader.name;
                readerSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});

function generate_pfreport() {
    const reader = document.getElementById("readerSelect").value;
    const datef = document.getElementById("dateFrom").value;
    const datet = document.getElementById("dateTo").value;

    const showError = (element) => {
        $(element).next('.select2').addClass("error-input");
        $(element).next('.select2').on("click", function () {
            $(element).next('.select2').removeClass("error-input");
        });
    };
    if (!reader) {
        showError("#readerSelect");
    } else if (!datef) {
        showError("#dateFrom");
    } else if (!datet) {
        showError("#dateTo");
    } else {
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "../printreport/audiometrypf";
        form.target = "_blank";

        const reportInput = document.createElement("input");
        reportInput.type = "text";
        reportInput.name = "reader";
        reportInput.value = reader;
        reportInput.style.display = "none";
        form.appendChild(reportInput);

        const datefInput = document.createElement("input");
        datefInput.type = "date";
        datefInput.name = "datef";
        datefInput.value = datef;
        form.appendChild(datefInput);

        const datetInput = document.createElement("input");
        datetInput.type = "date";
        datetInput.name = "datet";
        datetInput.value = datet;
        form.appendChild(datetInput);

        document.body.appendChild(form);
        form.submit();

        document.body.removeChild(form);
    }
}

function deletenewborn(caseno, refno) {
    $("#confirmation_modal").modal("show");
    $("#confirmedDelete").on("click", function () {
        $.post('ser-sid-scr/myphp/delete_newborn.php', { caseno: caseno, refno: refno }, function (data) {
            if (data == "success") {
                $("#loadingbar").modal("show");
                $("#confirmation_modal").modal("hide");
                function showSuccessModal() {
                    $("#loadingbar").modal("hide");
                    $("#popupDeleteSuccess").modal("show");
                    $("#confSuccess").on("click", function () {
                        $("#popupDeleteSuccess").modal("hide");
                        search_archpatient();
                    });
                    $(document).on("keypress", function (event) {
                        if (event.which === 13) {
                        $("#popupDeleteSuccess").modal("hide");
                            search_archpatient();
                        }
                    });
                }
                const animationDuration = 6000;
                setTimeout(showSuccessModal, animationDuration);
            } else {
                $("#popupDeleteFailed").modal("show");
                $("#confirmation_modal").modal("hide");
                $("#confFailed").on("click", function () {
                    location.reload();
                });
                $(document).on("keypress", function (event) {
                    if (event.which === 13) {
                        location.reload();
                    }
                });
            }
        });
    });
}

function forRefundItem(caseno, refno, lguser){
    $("#confirmationRefundModal").modal("show");
    $("#confirmedRefund").on("click", function () {
        $.post('ser-sid-scr/myphp/refund.php', { caseno: caseno, refno: refno }, function (data) {
            if (data == "success") {
                $("#refloadingbar").modal("show");
                $("#confirmationRefundModal").modal("hide");
                function showSuccessModal() {
                    $("#refloadingbar").modal("hide");
                    $("#popupRefundSuccess").modal("show");
                    $("#confRefSuccess").on("click", function () {
                        location.reload();
                    });
                    $(document).on("keypress", function (event) {
                        if (event.which === 13) {
                            location.reload();
                        }
                    });
                }
                const animationDuration = 6000;
                setTimeout(showSuccessModal, animationDuration);
            } else {
                $("#popupDeleteFailed").modal("show");
                $("#confirmationRefundModal").modal("hide");
                $("#confFailed").on("click", function () {
                    location.reload();
                });
                $(document).on("keypress", function (event) {
                    if (event.which === 13) {
                        location.reload();
                    }
                });
            }
        });
    });
}

function UndoForRefundItem(caseno, refno, lguser){
    $("#confirmationUndoRefundModal").modal("show");
    $("#confirmedUndo").on("click", function () {
        $.post('ser-sid-scr/myphp/undoRefund.php', { caseno: caseno, refno: refno }, function (data) {
            if (data == "success") {
                $("#refloadingbar").modal("show");
                $("#confirmationUndoRefundModal").modal("hide");
                function showSuccessModal() {
                    $("#refloadingbar").modal("hide");
                    $("#popupUndoSuccess").modal("show");
                    $("#confUndoSuccess").on("click", function () {
                        location.reload();
                    });
                    $(document).on("keypress", function (event) {
                        if (event.which === 13) {
                            location.reload();
                        }
                    });
                }
                const animationDuration = 6000;
                setTimeout(showSuccessModal, animationDuration);
            } else {
                $("#popupDeleteFailed").modal("show");
                $("#confirmationUndoRefundModal").modal("hide");
                $("#confFailed").on("click", function () {
                    location.reload();
                });
                $(document).on("keypress", function (event) {
                    if (event.which === 13) {
                        location.reload();
                    }
                });
            }
        });
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const selectedStock = document.getElementById("selected_stock");
    const eStocksUrl = 'ser-sid-scr/myphp/fetch_estocks_data.php';
    const emptyEsOption = document.createElement("option");
    emptyEsOption.value = "";
    emptyEsOption.text = "None";
    selectedStock.appendChild(emptyEsOption);
    fetch(eStocksUrl)
        .then(response => response.json())
        .then(data => {
            data.forEach(stocks => {
                const option = document.createElement("option");
                option.value = stocks.code;
                option.text = stocks.desc;
                selectedStock.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});

document.addEventListener("DOMContentLoaded", function () {
    const slctdnbsrep = document.getElementById("slctdnbsrep");
    const rpUrl = 'ser-sid-scr/myphp/fetch_nbs_description.php';
    const emptyRepOpt = document.createElement("option");
    emptyRepOpt.value = "";
    emptyRepOpt.text = "None";
    slctdnbsrep.appendChild(emptyRepOpt);
    fetch(rpUrl)
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            data.forEach(rept => {
                const option = document.createElement("option");
                option.value = rept.code;
                option.text = rept.desc;
                slctdnbsrep.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});

function generateStockcard(){
    const slct_stock = document.getElementById("selected_stock").value;
    const edatefrom = document.getElementById("edateFrom").value;
    const edateto = document.getElementById("edateTo").value;
    if(!slct_stock) {
        $("#selected_stock").next('.select2').addClass("error-input");
    }else{
        window.open('../scmprint/estockcard/' + slct_stock + '/' + edatefrom + '/' + edateto);
    }
    $("#selected_stock").next('.select2').on("click", function () {
        $("#selected_stock").next('.select2').removeClass("error-input");
    });
}

function repeatTest(rep_caseno, rep_refno, rep_lguser){
    $.post('ser-sid-scr/myphp/fetch_bbpatient_details.php',{caseno: rep_caseno, refno: rep_refno}, function(data,status){
        var combinedData = JSON.parse(data);
        var ptDetails = combinedData.ptDetails;
        var productDetails = combinedData.productDetails;
        var fName = ptDetails.lastname + ", " + ptDetails.firstname + " " + ptDetails.middlename + " => " + productDetails[0].approvalno;
        var screenername = rep_lguser.toUpperCase();
        $("#rep_screeners").val(screenername);
        $("#rep_bbpatientidno").val(ptDetails.patientidno);
        $("#rep_bbcaseno").val(rep_caseno);
        $("#rep_bbrefno").val(rep_refno);
        $("#rep_bbdescription").val(productDetails[0].productdesc);
        $("#rep_bbrefphysician").val(ptDetails.ap);
        $("#rep_bbclinicalservices").val(productDetails[0].productdesc + " " + "RESULTS");
        $("#rep_bbyname").text(fName);
        $("#rep_fsname").val(ptDetails.firstname);
        $("#rep_mdname").val(ptDetails.middlename);
        $("#rep_lsname").val(ptDetails.lastname);
        $("#rep_productcode").val(productDetails[0].productcode);
        $("#rep_trantype").val(productDetails[0].trantype);
        $("#rep_productdesc").val(productDetails[0].productdesc);
        $("#newbornRepeatModal").modal('show');
    });
}

function saveRepeatNewborn(){
    const rep_scrns = document.getElementById("rep_screeners").value;
    const rep_series = document.getElementById("rep_bbseriesno").value;
    const rep_ptidno = document.getElementById("rep_bbpatientidno").value;
    const rep_caseno = document.getElementById("rep_bbcaseno").value;
    const rep_refno = document.getElementById("rep_bbrefno").value;
    const rep_desc = document.getElementById("rep_bbdescription").value;
    const rep_refphy = document.getElementById("rep_bbrefphysician").value;
    const rep_clcserv = document.getElementById("rep_bbclinicalservices").value;
    const rep_fname = document.getElementById("rep_fsname").value;
    const rep_mname = document.getElementById("rep_mdname").value;
    const rep_lname = document.getElementById("rep_lsname").value;
    const rep_trantype = document.getElementById("rep_trantype").value;
    const rep_prodcode = document.getElementById("rep_productcode").value;
    const rep_proddesc = document.getElementById("rep_productdesc").value;

    if(!rep_series){
        $("#rep_bbseriesno").addClass("error-input");
    }else{
        $.post('ser-sid-scr/myphp/save_repeat_newborn.php',{
            rep_scrns:rep_scrns,
            rep_series:rep_series,
            rep_ptidno:rep_ptidno,
            rep_caseno:rep_caseno,
            rep_refno:rep_refno,
            rep_desc:rep_desc,
            rep_refphy:rep_refphy,
            rep_clcserv:rep_clcserv,
            rep_fname:rep_fname,
            rep_mname:rep_mname,
            rep_lname:rep_lname,
            rep_trantype:rep_trantype,
            rep_prodcode:rep_prodcode,
            rep_proddesc:rep_proddesc
        }, function(data, status){
            console.log(data);
            if (data === "success") {
                $("#repProdDesc").text(rep_proddesc);
                $("#successRepeatNewborn").modal('show');
            } else {
                $("#popupAlertWarningRep").modal('show');
            }
        });
    }
    $("#confRept").on('click', function() {
        $("#successRepeatNewborn").modal('hide');
        $("#newbornRepeatModal").modal('hide');
        search_archpatient();
    });
    
    $("#confWarnRep").on('click', function() {
        $("#popupAlertWarningRep").modal('hide');
        $("#newbornRepeatModal").modal('hide');
        search_archpatient();
    });
}
