// JavaScript Document

/** getXmlHttpObject **/
function GetXmlHttpObject(sender) {
    var xmlHttp=null;
    // Firefox, Opera 8.0+, Safari
    try {
        xmlHttp=new XMLHttpRequest();
    }
    catch (e) {
        // Internet Explorer
        try {
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
            try {
                xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {
                alert("Your browser does not support AJAX! Please update your browser.");
                return null;
            }
        }
    }
    return xmlHttp;
}

/** Checking of Dates Version 1 **/
function check_date(pAdmissionDate,pDischargeDate) {
    var fromdate = pAdmissionDate.split('/');
    pAdmissionDate = new Date();
    pAdmissionDate.setFullYear(fromdate[2],fromdate[0]-1,fromdate[1]); //setFullYear(year,month,day)

    var todate = pDischargeDate.split('/');
    pDischargeDate = new Date();
    pDischargeDate.setFullYear(todate[2],todate[0]-1,todate[1]);

    if (pAdmissionDate > pDischargeDate ) {
        return false;
    }
    else {
        return true;
    }
}

/** Checking of Dates Version 3 **/
function checkDateValue(dateValue) {
    var error = 0;
    var now = new Date();
    var day = now.getDate();
    var mon = now.getMonth()+1;
    var year = now.getFullYear();
    var selectedDate = dateValue;
    selectedDate = selectedDate.split("/");

    if (ValidateDate(selectedDate[2], selectedDate[0], selectedDate[1]) === false) { error = 1; }

    if ( selectedDate[2] > year ) { error = 1; }
    else if ( selectedDate[2] < 1000 ) { error = 1; }
    else if (selectedDate[2] == year) {
        if ( selectedDate[0] > mon ) { error = 1; }
        else if ( selectedDate[0] == mon ) {
            if ( selectedDate[1] > day ) { error = 1; }
        }
    }

    if (error == 1) { return false; }
    else { return true; }
}

/** Checking of Dates Version 4 **/
function ValidateDate(y, mo, d) {
    var date = new Date(y, mo - 1, d);
    var ny = date.getFullYear();
    var nmo = date.getMonth() + 1;
    var nd = date.getDate();
    return ny == y && nmo == mo && nd == d;
}

/** is Number Key **/
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;

}

/** is Number Key **/
function isNumberWithDecimalKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    } else {
        // If the number field already has . then don't allow to enter . again.
        if (evt.target.value.search(/\./) > -1 && charCode == 46) {
            return false;
        }
        return true;
    }
}

/** Validate Alpha Characters  **/
function ValidateAlpha(evt) {
    var keyCode = (evt.which) ? evt.which : evt.keyCode;
    if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32 &&
        keyCode != 45 && keyCode != 209 && keyCode != 241 && keyCode != 13 && keyCode != 37) //45 = '-', 209 = 'Ñ', 241 = 'ñ', 13 = 'Enter Key', 37 '%' //savr20151026
        return false;

    return true;
}

/** Set Focus **/
function setFocus(id) {
    document.getElementById(id).focus();
}

/** Set Display **/
function setDisplay(id, dis) {
    document.getElementById(id).style.display = dis;
}

/** Set Disabled **/
function setDisabled(id, dis) {
    document.getElementById(id).disabled = dis;
}

/** Set Value **/
function setValue(id, val) {
    document.getElementById(id).value = val;
}

/** Get Value **/
function getValue(id) {
    return document.getElementById(id).value;
}

/** Is Checked **/
function isChecked(id) {
    if (document.getElementById(id).checked == true) { return true; }
    else { return false; }
}

/** Disable ID **/
function disableID(id) {
    document.getElementById(id).disabled = true;
}

/** Enabled ID **/
function enableID(id) {
    document.getElementById(id).disabled = false;
}

/** Check ID **/
function checkID(id) {
    document.getElementById(id).checked = true;
}

/** UnCheck ID **/
function uncheckID(id) {
    document.getElementById(id).checked = false;
}

/* Print Report */
function printReport(action, title) {
    document.getElementById('statsForm').action = action + '/print_report/' + title;
    document.getElementById('statsForm').target = '_blank';
    document.getElementById('statsForm').submit();
}

/* Show/Hide ID */
function showHideID(id, task) {
    if (task == 'show') {
        document.getElementById(id).style.display = '';
    } else {
        document.getElementById(id).style.display = 'none';
    }
}

/* URL redirection */
function urlRedirection(url) {
    window.location = url;
}

/* URL Window Open */
function urlWindowOpen(url) {
    params  = 'width='+screen.width;
    params += ', height='+screen.height;
    params += ', top=0, left=0'
    params += ', fullscreen=yes';

    newwin=window.open(url,'windowname4', params);
    if (window.focus) {newwin.focus()}
    return false;
}

/* Ask Confirmation Before Saving */
function confirmSave(message, form_id) {
    var response = confirm(message + "Continue to save?");
    if (response == true) {
        document.getElementById(form_id).submit();
    }
}

/* Validate Search PhilHealth Records */
function validateSearch() {
    var pin = $("#pPIN").val();
    var lastname = $("#pLastName").val();
    var firstname = $("#pFirstName").val();
    var birthday = $("#pDateOfBirth").val();

    if(pin == "" && lastname == "" && firstname == "" && birthday == "") {
        alert("Please input any of the following: \n\n-PhilHealth Identification Number.\n-Name and Birthday.");
        $("#pPIN").focus();
        return false;
    }
    else {
        if(pin == "" && lastname == "") {
            alert("Please input Last Name.");
            $("#pLastName").focus();
            return false;
        }
        else if(pin == "" && firstname == "") {
            alert("Please input First Name.");
            $("#pFirstName").focus();
            return false;
        }
        else if(pin == "" && birthday == "") {
            alert("Please input Date of Birth.");
            $("#pDateOfBirth").focus();
            return false;
        }
    }

    $("#wait_image").show();
}
function validateEnlistmentSearch() {
    var pPIN = getValue('pPIN');
    var pLastName = getValue('pLastName');
    var pFirstName = getValue('pFirstName');
    var pDateOfBirth = getValue('pDateOfBirth');

    if ((pPIN == '') && (pLastName == '') && (pFirstName == '') && (pDateOfBirth == '')) {
        alert('Please Indicate PIN');
        setFocus('pPIN');
    }
    else if ((pPIN == '') && pLastName == '') {
        alert('Last Name is required');
        setFocus('pLastName');
    }
    else if ((pPIN == '') && pFirstName == '') {
        alert('First Name is required');
        setFocus('pFirstName');
    }
    else {
        setDisplay('content_div', 'none');
        setDisplay('result', 'none');
        setDisplay('wait_image', '');
        document.getElementById('search_enlistment_form').submit();
    }
}

function validateConsultationSearch() {
    var pPIN = getValue('pPIN');
    var pLastName = getValue('pLastName');
    var pFirstName = getValue('pFirstName');
    var pDateOfBirth = getValue('pDateOfBirth');

    if ((pPIN == '') && (pLastName == '') && (pFirstName == '') && (pDateOfBirth == '')) {
        alert('Please Indicate PIN');
        setFocus('pPIN');
    }
    else if ((pPIN == '') && pLastName == '') {
        alert('Last Name is required');
        setFocus('pLastName');
    }
    else if ((pPIN == '') && pFirstName == '') {
        alert('First Name is required');
        setFocus('pFirstName');
    }
    else {
        setDisplay('content_div', 'none');
        setDisplay('result', 'none');
        setDisplay('wait_image', '');
        document.getElementById('search_profile_form').submit();
    }
}

function validateLabResultsSearch() {
    var pPIN = getValue('pPIN');
    var pLastName = getValue('pLastName');
    var pFirstName = getValue('pFirstName');
    var pDateOfBirth = getValue('pDateOfBirth');

    if ((pPIN == '') && (pLastName == '') && (pFirstName == '') && (pDateOfBirth == '')) {
        alert('Please Indicate PIN');
        setFocus('pPIN');
    }
    else if ((pPIN == '') && pLastName == '') {
        alert('Last Name is required');
        setFocus('pLastName');
    }
    else if ((pPIN == '') && pFirstName == '') {
        alert('First Name is required');
        setFocus('pFirstName');
    }
    else if ((pPIN == '') && (pDateOfBirth != '')) {
        alert('Please input a valid value for Date of Birth');
        setFocus('pDateOfBirth');
    }
    else {
        setDisplay('content_div', 'none');
        setDisplay('result', 'none');
        setDisplay('wait_image', '');
        document.getElementById('search_lab_results_form').submit();
    }
}
/* Validate Data Entry of Enlistment */
function validatePatientForEnlistment() {
    var pCaseNo = getValue('pCaseNo');
    var pEnlistmentDate = getValue('pEnlistmentDate');
    var pPatientType = getValue('pPatientType');
    var pWithConsent = getValue('pWithConsent');
    var pIsEligible = getValue('pIsEligible');
    if ((pPatientType == 'DD') && (pIsEligible != 'NOT ELIGIBLE')) { var pWithLOA = getValue('pWithLOA'); }
    var pPatientLastName = getValue('pPatientLastName');
    var pPatientFirstName = getValue('pPatientFirstName');
    var pPatientDateOfBirth = getValue('pPatientDateOfBirth');
    var pPatientContactNo = getValue('pPatientContactNo');
    var pPatientSexX = getValue('pPatientSexX');
    var pPatientCivilStatusX = getValue('pPatientCivilStatusX');
    var pProvinceX = getValue('pProvinceX');
    var pMunicipalityX = getValue('pMunicipalityX');
    var pBarangayX = getValue('pBarangayX');
    var pTaggingForEnrollment = getValue('pTaggingForEnrollment');
    //var pPatientFamilyPlanningCounselling = document.getElementById('pPatientFamilyPlanningCounselling').value;
    //var pDateToday = getValue('pDateToday'); c

    // alert(pPatientSexX);

    if (pEnlistmentDate == '' || !checkDateValue(pEnlistmentDate)) {
        alert('Encounter Date is invalid.');
        setFocus('pEnlistmentDate');
    }
    else
    if ((pCaseNo == '') && (!isDateWithinRange(pEnlistmentDate))) { //savr 2016-01-21
        alert('Encounter Date must be within this quarter.');
        setFocus('pEnlistmentDate');
    }
    else
    if (pWithConsent == '') {
        alert('With Consent is required.');
        setFocus('pWithConsent');
    }
    else
    if ((pCaseNo == '') && (pPatientType == 'DD') && (pWithLOA == '')) {
        alert('With Letter of Authorization is required.');
        setFocus('pWithLOA');
    }
    else
    if (pPatientLastName == '') {
        alert('Last Name is required.');
        setFocus('pPatientLastName');
    }
    else
    if (pPatientFirstName == '') {
        alert('First Name is required.');
        setFocus('pPatientFirstName');
    }
    else
    if (pPatientDateOfBirth == '') {
        alert('Date of Birth is required.');
        setFocus('pPatientDateOfBirth');
    }
    else
    if (pPatientContactNo == '') {
        alert('Contact No. is required.');
        setFocus('pPatientContactNo');
    }
    else
    if ((pPatientSexX == '-') || (pPatientSexX == '')) { //savr 2016-04-08: update validation of Sex Field
        alert('Sex is required.');
        setFocus('pPatientSexX');
    }
    else
    if ((pPatientCivilStatusX == '-') || (pPatientCivilStatusX == '')) { //savr 2016-04-08: update validation of Civil Status Field
        alert('Civil Status is required.');
        setFocus('pPatientCivilStatusX');
    }
    else
    if (pProvinceX == '') {
        alert('Province is required.');
        setFocus('pProvinceX');
    }
    else
    if (pMunicipalityX == '') {
        alert('Municipality is required.');
        setFocus('pMunicipalityX');
    }
    else
    if ((pBarangayX == '') && (pPatientType == 'NM')) {
        alert('Barangay is required.');
        setFocus('pBarangayX');
    }
    else
    if ((pTaggingForEnrollment == '') && ((pPatientType == 'NM') || ((pPatientType == 'DD') && (pIsEligible == 'NOT ELIGIBLE')))) {
        alert('Tagging For Enrollment is required.');
        setFocus('pTaggingForEnrollment');
    }
    /*else
    if (pPatientFamilyPlanningCounselling == '') {
        alert('Choose One for Family Planning Counselling');
        setFocus('pPatientFamilyPlanningCounselling');
    }*/
    else {
        setDisplay('content_div', 'none');
        setDisplay('wait_image', '');
        document.getElementById('data_entry_enlistment_form').submit();
    }
}


/* Treatment Check */
function checkTreatment(id, div_result) {
    if(isChecked(id)) {
        setDisplay(div_result + '_header', '');
        setDisplay(div_result + '_form', '');
    }
    else {
        setDisplay(div_result + '_header', 'none');
        setDisplay(div_result + '_form', 'none');
    }
}

/* Check Other Diagnostic Examination */
function checkOtherDiagExam() {
    if(isChecked('diagnostic_oth')) {
        enableID('diagnostic_oth_remarks');
        setFocus('diagnostic_oth_remarks');
    }
    else {
        disableID('diagnostic_oth_remarks');
    }
}

/* Check Other Management */
function checkOtherManagement() {
    if(isChecked('management_oth')) {
        enableID('management_oth_remarks');
        setFocus('management_oth_remarks');
    }
    else {
        disableID('management_oth_remarks');
    }
}

/* Check Other Management */
function checkOtherChiefComplaint() {
    if(isChecked('symptom_X')) {
        document.getElementById("pOtherChiefComplaint").style.display = '';
        enableID('pOtherChiefComplaint');
        setFocus('pOtherChiefComplaint');
    }
    else {
        document.getElementById("pOtherChiefComplaint").style.display = 'none';
        disableID('pOtherChiefComplaint');
    }
    if(isChecked('symptom_38')) {
        document.getElementById("pPainSite").style.display = '';
        enableID('pPainSite');
        setFocus('pPainSite');
    }
    else {
        document.getElementById("pPainSite").style.display = 'none';
        disableID('pPainSite');
    }
}

/* Exam Results Check */
function checkExamResults(id) {
    if(isChecked(id)) {
        enableID(id+'_given');
        enableID(id+'_referred');
        enableID(id+'_remarks');
    }
    else {
        disableID(id+'_given');
        disableID(id+'_referred');
        disableID(id+'_remarks');
        uncheckID(id+'_given');
        uncheckID(id+'_referred');
    }
}

/* Add Diagnosis */
function addDiagnosis(imageURL) {
    var pICD = document.getElementById('pICD');

    if (pICD.value == '') {
        alert('Please select a diagnosis');
        setFocus('pICD');
    }
    else {
        var fieldDesc = pICD.options[pICD.selectedIndex].text;
        if (getRowID('diagnosis_table', '1', fieldDesc) == 0) {
            addDiagnosisRow('diagnosis_table', pICD.value, fieldDesc, imageURL);
            designTable('diagnosis_table');
        } else {
            alert('Diagnosis already in the list.');
        }
    }
}

/* Add Diagnosis Row */
function addDiagnosisRow(tableID, fieldValue, fieldDesc, imageURL) {
    var table = document.getElementById(tableID);
    var length = table.rows.length;
    var row = table.insertRow(length);
    var cell1 = row.insertCell(0);
    cell1.innerHTML = length;

    var cell2 = row.insertCell(1);
    cell2.innerHTML = fieldDesc;

    var cell3 = row.insertCell(2);
    cell3.innerHTML = '<input type="hidden" value="' + fieldValue + '" id="diagnosis_' + fieldValue + '" name="diagnosis[]">' +
        '<img src="' + imageURL + '" onClick="removeDiagnosisRow(\''+ tableID +'\', \''+ fieldDesc +'\');" alt="Remove Diagnosis" title="Remove Diagnosis" style="width: 20px; height: 20px; cursor: pointer;">';
}

/* Remove Diagnosis Row */
function removeDiagnosisRow(tableID, fieldDesc) {
    var rowID = getRowID(tableID, '1', fieldDesc);
    document.getElementById(tableID).deleteRow(rowID);
    renameNumberID(tableID);
    designTable('diagnosis_table');
}

/* Get ROW ID */
function getRowID(tableID, columnID, fieldDesc) {
    var table = document.getElementById(tableID);
    var length = table.rows.length;
    var val = 0;

    for (i = 0; i < length; i++) {
        var x = table.rows[i].cells;
        if (x[columnID].innerHTML == fieldDesc) {
            val = i;
        }
    }
    return val;
}

/* Rename Number ID */
function renameNumberID(tableID) {
    var table = document.getElementById(tableID);
    var length = table.rows.length;

    for (i = 1; i < length; i++) {
        var x = table.rows[i].cells;
        x[0].innerHTML = i;
    }
}

/* Validate SOAP */
function validateSOAP(obligated_services) {
    var message = '';
    var focusID = '';
    var BPMeasurements = false;
    //var obligated_services = Array('', 'BP Measurements', 'Periodic clinical breast cancer examination', 'Visual inspection with acetic acid', 'Digital Rectal Examination');

    // Obligated Services Checking
    var obligated_error = false;
    for (i = 1; i < 5; i++) {
        if (i == 1) {
            if ((!isChecked('obligated_service_' + i + '_yes')) && (!isChecked('obligated_service_' + i + '_no'))) {
                obligated_error = true;
                message = 'Select one for \'' + obligated_services[i] + '\' under Obligated Service Tab.';
                break;
            }
            else
            if (isChecked('obligated_service_' + i + '_yes') && getValue('obligated_service_' + i + '_type') == '') {
                obligated_error = true;
                message = 'Select one type in \'' + obligated_services[i] + '\' under Obligated Service Tab.';
                focusID = 'obligated_service_' + i + '_type';
                break;
            }
            else {
                BPMeasurements = isChecked('obligated_service_' + i + '_yes');
            }
        }
        else {
            if ((!isChecked('obligated_service_' + i + '_yes')) && (!isChecked('obligated_service_' + i + '_no'))  && (!isChecked('obligated_service_' + i + '_waived'))) {
                obligated_error = true;
                message = 'Select one for \'' + obligated_services[i] + '\' under Obligated Service Tab.';
                break;
            }
            else
            if (isChecked('obligated_service_' + i + '_waived') && getValue('obligated_service_' + i + '_waived_reason') == '') {
                obligated_error = true;
                message = 'Select one reason in \'' + obligated_services[i] + '\' under Obligated Service Tab.';
                focusID = 'obligated_service_' + i + '_waived_reason';
                break;
            }
        }
    }

    // Subjective/History of Illnees Checking
    var sujective_error = false;
    if (!obligated_error) {
        var pSOAPDate = getValue('pSOAPDate');
        if (!checkDateValue(pSOAPDate)) {
            sujective_error = true;
            focusID = 'pSOAPDate';
            message = 'Invalid value for consultation date under Subjective/History of Illness Tab.';
        }
        else
        if ((!isDateWithinRange(pSOAPDate))) {//savr 2016-06-06 #v1.1.2: added checking of consultation date
            sujective_error = true;
            focusID = 'pSOAPDate';
            message = 'Consultation Date must be within this quarter.';
        }
        else
        if (getValue('pChiefComplaint') == '') {
            sujective_error = true;
            focusID = 'pChiefComplaint';
            message = 'Enter a valid chief complaint under Subjective/History of Illness Tab.';
        }
    }

    // Objective/Physical Examination Checking
    var objective_error = false;
    if (!sujective_error && !obligated_error) {
        if (BPMeasurements && (getValue('pe_bp_u') == '')) {
            objective_error = true;
            focusID = 'pe_bp_u';
            message = 'Enter systolic value in BP under Objective/Physical Examination Tab.';
        }
        else
        if (BPMeasurements && (getValue('pe_bp_l') == '')) {
            objective_error = true;
            focusID = 'pe_bp_l';
            message = 'Enter diastolic value in BP under Objective/Physical Examination Tab.';
        }
    }

    // Assessment/Diagnosis Checking
    var assessment_error = false;
    if (!sujective_error && !obligated_error && !objective_error) {
        var table = document.getElementById('diagnosis_table');
        var rowCount = table.rows.length;  //It will return the last Index of the row and its row count
        var actualRowCount = parseInt(rowCount) -1 ;

        if (actualRowCount == 0) {
            assessment_error = true;
            message = 'Please add at least one diagnosis in the Assessment/Diagnosis Tab.';
            focusID = 'pICD';
        }
    }

    // Plan/Management Checking
    var plan_error = false;
    var pDiagnostic = false;
    var pManagement = false;
    if (!sujective_error && !obligated_error && !objective_error && !assessment_error) {
        for (i = 1; i < 13; i++) {
            if (isChecked('diagnostic_' + i)) { pDiagnostic = true; break; }
        }
        if (isChecked('diagnostic_oth')) { pDiagnostic = true; }

        for (i = 1; i < 5; i++) {
            if (isChecked('management_' + i)) { pManagement = true; break; }
        }

        if (!pDiagnostic && !isChecked('diagnostic_NA')) {
            plan_error = true;
            message = 'Please select at least one in Diagnostic Examination or tick Not Applicable.'
        }
        else
        if (isChecked('diagnostic_oth') && getValue('diagnostic_oth_remarks') == '') {
            plan_error = true;
            message = 'Please specify the other diagnostic examination.'
            focusID = 'diagnostic_oth_remarks';
        }
        else
        if (!pManagement && !isChecked('management_NA')) {
            plan_error = true;
            message = 'Please select at least one in Management or tick Not Applicable.'
        }

    }

    if (obligated_error) {
        alert(message);
        document.getElementById('obliSerTabClick').click();
        if (focusID != '') { setFocus(focusID); }
    }
    else
    if (sujective_error) {
        alert(message);
        document.getElementById('subjectiveTabClick').click();
        setFocus(focusID);
    }
    else
    if (objective_error) {
        alert(message);
        document.getElementById('objectiveTabClick').click();
        setFocus(focusID);
    }
    else
    if (assessment_error) {
        alert(message);
        document.getElementById('assessmentTabClick').click();
        setFocus(focusID);
    }
    else
    if (plan_error) {
        alert(message);
        document.getElementById('planTabClick').click();
        if (focusID != '') { setFocus(focusID); }
    }
    else {
        setDisplay('content_div_body', 'none');
        setDisplay('wait_image_outside', '');
        document.getElementById('data_entry_soap_form').submit();
        //alert('Patient Record has been saved');
    }
}

/* Conversion */
function roundit(num) {
    return Math.round(num * 100) / 100;
}

function CmtoInch(x) {
    if (x.value.match(/[^\d.]/)) {
        x.value = x.value.replace(/[^\d.]/g, '');
    }
    if (isNaN(x.value)) {
        x.value = x.value.substring(0, x.value.length - 1);
    }

    return roundit(x.value / 2.54);
}

function InchToCm(x) {
    if (x.value.match(/[^\d.]/)) {
        x.value = x.value.replace(/[^\d.]/g, '');
    }
    if (isNaN(x.value)) {
        x.value = x.value.substring(0, x.value.length - 1);
    }

    return roundit(x.value * 2.54);
}

function KgToLb(x) {
    if (x.value.match(/[^\d.]/)) {
        x.value = x.value.replace(/[^\d.]/g, '');
    }
    if (isNaN(x.value)) {
        x.value = x.value.substring(0, x.value.length - 1);
    }

    return roundit(x.value * 2.20462);
}

function LbToKg(x) {
    if (x.value.match(/[^\d.]/)) {
        x.value = x.value.replace(/[^\d.]/g, '');
    }
    if (isNaN(x.value)) {
        x.value = x.value.substring(0, x.value.length - 1);
    }

    return roundit(x.value / 2.20462);
}

function ChkWholeNum(x) {
    if (x.value.match(/[^\d]/)) {
        x.value = x.value.replace(/[^\d]/g, '');
    }
    if (isNaN(x.value)) {
        x.value = x.value.substring(0, x.value.length - 1);
    }

    return x.value;
}

/* Validate Report List */
function validateReportList(form_id) {
    var pStartDate = getValue('pStartDate');
    var pEndDate = getValue('pEndDate');

    if (!checkDateValue(pStartDate)) { alert('Invalid value for start date.'); setFocus('pStartDate'); }
    else if (!checkDateValue(pEndDate)) { alert('Invalid value for end date.'); setFocus('pEndDate'); }
    else if (check_date(pStartDate, pEndDate) == false) {
        alert('End Date must not be earlier than the Start Date');
        setFocus('pStartDate');
    }
    else {
        setDisplay('results_list_tbl', 'none');
        setDisplay('no_record_tbl', 'none');
        setDisplay('wait_image', '');
        document.getElementById(form_id).submit();
        setDisabled('pReportType', true);
        setDisabled('pStartDate', true);
        setDisabled('pEndDate', true);
        setDisabled('pGenerate', true);
        //setDisabled('pPrint', true);
    }
}

/* Checked Waived Reason if OTHER is selected */
function onChangeWaivedReason(reasonID, remarkID) {
    var reasonVal = getValue(reasonID);
    if (reasonVal == 'X') { setDisabled(remarkID, false); setFocus(remarkID); }
    else { setDisabled(remarkID, true); }
}

/* for table display */
function designTable(tableID) {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;  //It will return the last Index of the row and its row count
    var actualRowCount = parseInt(rowCount)-1;

    for (i = 1; i <= actualRowCount; i++) {
        if (i % 2 == 1) {
            table.rows[i].style.backgroundColor = '#FBFCC7';
        }
        else {
            table.rows[i].style.backgroundColor = '';
        }
    }
}

/* Disable Diagnostic Examinations */
function enableDisableDiagnosticExaminations() {
    if (isChecked('diagnostic_NA')) {
        for (i = 1; i < 15; i++) {
            disableID('diagnostic_' + i);
            disableID('diagnostic_oth');
            disableID('diagnostic_13');
            disableID('diagnostic_14');
            disableID('diagnostic_9');
            disableID('diagnostic_oth_remarks');
            disableID('diagnostic_'+i+'_lab_exam_in');
            disableID('diagnostic_'+i+'_lab_exam_out');
            disableID('diagnostic_'+i+'_accre_diag_fac');
            disableID('diagnostic_9_lab_exam_in');
            disableID('diagnostic_13_lab_exam_in');
            disableID('diagnostic_14_lab_exam_in');
            disableID('diagnostic_9_lab_exam_out');
            disableID('diagnostic_13_lab_exam_out');
            disableID('diagnostic_14_lab_exam_out');
            disableID('diagnostic_9_accre_diag_fac');
            disableID('diagnostic_13_accre_diag_fac');
            disableID('diagnostic_14_accre_diag_fac');
        }

    } else {
        for (i = 1; i < 15; i++) {
            enableID('diagnostic_' + i);
            enableID('diagnostic_oth');
            enableID('diagnostic_13');
            enableID('diagnostic_14');
            enableID('diagnostic_9');
        }

    }
}

/* Disable Management */
function enableDisableManagement() {
    if (isChecked('management_NA')) {
        for (i = 1; i < 5; i++) {
            disableID('management_' + i);
        }
        disableID('management_oth');
        disableID('management_oth_remarks');
    } else {
        for (i = 1; i < 5; i++) {
            enableID('management_' + i);
        }
        enableID('management_oth');
    }
}

/* SCRIPTS ADDED BY ZIA*/
function validateEmail(emailField){
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

    if (reg.test(emailField.value) == false)
    {
        // alert('Invalid Email Address');
        $("#errmsg1").html("Invalid email address").show().fadeOut("slow");
        $("input[id='pHospEmailAdd']").val("");
        return false;
    }
    return true;
}
function validateEmailPx(emailField){
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

    if (reg.test(emailField.value) == false)
    {
        // alert('Invalid Email Address');
        $("#errmsg1").html("Invalid email address").show().fadeOut("slow");
        $("input[id='pPatientEmailAdd']").val("");
        return false;
    }
    return true;
}

function loadMunicipality(pProvCode) {
    /*Hospital Registration*/
    $("#pHospAddMun").load("loadMunicipality.php?pProvCode=" + pProvCode);
    document.getElementById("pHospAddBrgy").options.length = 0;
    document.getElementById("pHospZIPCode").options.length = 0;
}

function loadBarangay() {
    /*Hospital Registration*/
    var pProvCodeHosp = $("#pHospAddProv option:selected").val();
    var pMunCodeHosp = $("#pHospAddMun option:selected").val();
    $("#pHospAddBrgy").load("loadBarangay.php?pMunCode=" + pMunCodeHosp + "&pProvCode=" + pProvCodeHosp);
    document.getElementById("pHospZIPCode").value = "";
}

function loadZipCode() {
    /*Hospital Registration*/
    var pProvCodeHosp = $("#pHospAddProv option:selected").val();
    var pMunCodeHosp = $("#pHospAddMun option:selected").val();
    $("#pHospZIPCode").load("loadZipCode.php?pMunCode="+ pMunCodeHosp +"&pProvCode=" + pProvCodeHosp);
}


function loadMunicipalityPx(pProvCode){
    /*Client Registration*/
    $("#pPatientAddMun").load("loadMunicipality.php?pProvCode="+pProvCode);
    document.getElementById("pPatientAddBrgy").options.length = 0;
    document.getElementById("pPatientZIPCode").value = "";
    document.getElementById("pHospZIPCode").value = "";
}
function loadBarangayPx() {
    /*Client Registration*/
    var pProvCode = $("#pPatientAddProv option:selected").val();
    var pMunCode = $("#pPatientAddMun option:selected").val();
    $("#pPatientAddBrgy").load("loadBarangay.php?pMunCode=" + pMunCode+"&pProvCode=" + pProvCode);

    document.getElementById("pPatientZIPCode").value = "";
}

function loadZipCodePx() {
    /*Client Registration*/
    var pProvCode = $("#pPatientAddProv option:selected").val();
    var pMunCode = $("#pPatientAddMun option:selected").val();
    $("#pPatientZIPCode").load("loadZipCode.php?pMunCode="+ pMunCode +"&pProvCode=" + pProvCode);
}

function computeAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}
/*Load Data to Prescribed Medicine*/
function loadMedsGeneric(pMeds){
    $("#pGeneric").load("loadMedsGeneric.php?pMeds="+pMeds);
}
function loadMedsStrength(pMeds){
    $("#pStrength").load("loadMedsStrength.php?pMeds="+pMeds);
}
function loadMedsForm(pMeds){
    $("#pForm").load("loadMedsForm.php?pMeds="+pMeds);
}
function loadMedsPackage(pMeds){
    $("#pPackage").load("loadMedsPackage.php?pMeds="+pMeds);
}
function loadMedsSalt(pMeds){
    $("#pSalt").load("loadMedsSalt.php?pMeds="+pMeds);
}
function loadMedsUnit(pMeds){
    $("#pUnit").load("loadMedsUnit.php?pMeds="+pMeds);
}
function loadMedsInsStrength(pMeds){
    $("#pStrengthInstruction").load("loadMedsStrength.php?pMeds="+pMeds);
}
function loadMedsCopay(){
        var drugCode = $("#pDrugCode").val();

        if(drugCode != ""){
            $("#pCoPayment").load("loadMedsCopay.php?mDrugCode=" + drugCode);
        }
}
/*End load data to Prescribed Medicine*/

/*Functions fo Lab Results Module*/
function checkHct(value){
    var pSex = $("#pxSex").val();
    var pAgeBracket = $("#pxAgeBracket").val();

    if(pSex == 'M' && pAgeBracket == 'adult'){
        if(value >=39 && value <=54 && value > 0){
            var pValue = 'normal';
        } else if(value < 39 && value > 0){
            var pValue = 'below';
        } else if(value >54 && value > 0){
            var pValue = 'above';
        }
        showHideSpanHct(pValue);
    } else if (pSex == 'F' && pAgeBracket == 'adult'){
        if (value >= 34 && value <= 47 && value > 0) {
            var pValue = 'normal';
        } else if(value < 34 && value > 0){
            var pValue = 'below';
        } else if(value > 47 && value > 0) {
            var pValue = 'above';
        }
        showHideSpanHct(pValue);
    } else if((pSex == 'F' || pSex == 'M') && (pAgeBracket == 'child')){
        if (value >= 30 && value <= 42 && value > 0) {
            var pValue = 'normal';
        } else if(value < 30 && value > 0){
            var pValue = 'below';
        } else if(value > 42 && value > 0){
            var pValue = 'above';
        }
        showHideSpanHct(pValue);
    }
}

function showHideSpanHct(status){
    if (status == 'normal') {
        document.getElementById("normalHct").style.display = '';
        document.getElementById("belowHct").style.display = 'none';
        document.getElementById("aboveHct").style.display = 'none';
    } else if(status == 'above') {
        document.getElementById("aboveHct").style.display = '';
        document.getElementById("normalHct").style.display = 'none';
        document.getElementById("belowHct").style.display = 'none';
    } else if(status == 'below') {
        document.getElementById("normalHct").style.display = 'none';
        document.getElementById("aboveHct").style.display = 'none';
        document.getElementById("belowHct").style.display = '';
    } else{
        document.getElementById("normalHct").style.display = 'none';
        document.getElementById("aboveHct").style.display = 'none';
        document.getElementById("belowHct").style.display = 'none';
    }
}

function checkHgb(value){
    var pSex = $("#pxSex").val();
    var pAgeBracket = $("#pxAgeBracket").val();

    if(pSex == 'M' && pAgeBracket == 'adult'){
        if(value >=14 && value <=18 && value > 0){
            var pValue = 'normal';
        } else if(value < 14 && value > 0){
            var pValue = 'below';
        } else if(value > 18 && value > 0){
            var pValue = 'above';
        }
        showHideSpanHgb(pValue);
    } else if (pSex == 'F' && pAgeBracket == 'adult'){
        if (value >= 11 && value <= 16 && value > 0) {
            var pValue = 'normal';
        } else if(value < 11 && value > 0){
            var pValue = 'below';
        } else if(value > 16 && value > 0){
            var pValue = 'above';
        }
        showHideSpanHgb(pValue);
    } else if((pSex == 'F' || pSex == 'M') && (pAgeBracket == 'child')){
        if (value >= 10 && value <= 14 && value > 0) {
            var pValue = 'normal';
        } else if(value < 30 && value > 0){
            var pValue = 'below';
        } else if(value > 14 && value > 0){
            var pValue = 'above';
        }
        showHideSpanHgb(pValue);
    }else if((pSex == 'F' || pSex == 'M') && (pAgeBracket == 'newborn')){
        if (value >= 15 && value <= 25 && value > 0) {
            var pValue = 'normal';
        } else if(value < 30 && value > 0){
            var pValue = 'below';
        } else if(value > 25 && value > 0){
            var pValue = 'above';
        }
        showHideSpanHgb(pValue);
    }

}

function showHideSpanHgb(status){
    if (status == 'normal') {
        document.getElementById("normalHgb").style.display = '';
        document.getElementById("belowHgb").style.display = 'none';
        document.getElementById("aboveHgb").style.display = 'none';
    } else if(status == 'above') {
        document.getElementById("aboveHgb").style.display = '';
        document.getElementById("normalHgb").style.display = 'none';
        document.getElementById("belowHgb").style.display = 'none';
    } else if(status == 'below'){
        document.getElementById("normalHgb").style.display = 'none';
        document.getElementById("aboveHgb").style.display = 'none';
        document.getElementById("belowHgb").style.display = '';
    } else{
        document.getElementById("normalHgb").style.display = 'none';
        document.getElementById("aboveHgb").style.display = 'none';
        document.getElementById("belowHgb").style.display = 'none';
    }
}

function checkLymphocytes(value){
    if(value >=14 && value <=44 && value > 0){
        var pValue = 'normal';
    } else if(value < 14 && value > 0){
        var pValue = 'below';
    } else if(value > 44 && value > 0){
        var pValue = 'above';
    }
    showHideSpanLymp(pValue);
}

function showHideSpanLymp(status){
    if (status == 'normal'){
        document.getElementById("normalLymp").style.display = '';
        document.getElementById("belowLymp").style.display = 'none';
        document.getElementById("aboveLymp").style.display = 'none';
    } else if(status == 'above'){
        document.getElementById("aboveLymp").style.display = '';
        document.getElementById("normalLymp").style.display = 'none';
        document.getElementById("belowLymp").style.display = 'none';
    } else if(status == 'below'){
        document.getElementById("normalLymp").style.display = 'none';
        document.getElementById("aboveLymp").style.display = 'none';
        document.getElementById("belowLymp").style.display = '';
    } else{
        document.getElementById("normalLymp").style.display = 'none';
        document.getElementById("aboveLymp").style.display = 'none';
        document.getElementById("belowLymp").style.display = 'none';
    }
}

function checkMonocytes(value){
    if(value >=2 && value <=6 && value > 0){
        var pValue = 'normal';
    } else if(value < 2 && value > 0){
        var pValue = 'below';
    } else if(value > 6 && value > 0){
        var pValue = 'above';
    }
    showHideSpanMono(pValue);
}

function showHideSpanMono(status){
    if (status == 'normal'){
        document.getElementById("normalMono").style.display = '';
        document.getElementById("belowMono").style.display = 'none';
        document.getElementById("aboveMono").style.display = 'none';
    } else if(status == 'above'){
        document.getElementById("aboveMono").style.display = '';
        document.getElementById("normalMono").style.display = 'none';
        document.getElementById("belowMono").style.display = 'none';
    } else if(status == 'below'){
        document.getElementById("normalMono").style.display = 'none';
        document.getElementById("aboveMono").style.display = 'none';
        document.getElementById("belowMono").style.display = '';
    } else{
        document.getElementById("normalMono").style.display = 'none';
        document.getElementById("aboveMono").style.display = 'none';
        document.getElementById("belowMono").style.display = 'none';
    }
}

function checkEosinophils(value){
    if(value >=1 && value <=5 && value > 0){
        var pValue = 'normal';
    } else if(value < 1 && value > 0){
        var pValue = 'below';
    } else if(value > 5 && value > 0){
        var pValue = 'above';
    }
    showHideSpanEosi(pValue);
}
function showHideSpanEosi(status){
    if (status == 'normal'){
        document.getElementById("normalEosi").style.display = '';
        document.getElementById("belowEosi").style.display = 'none';
        document.getElementById("aboveEosi").style.display = 'none';
    } else if(status == 'above'){
        document.getElementById("aboveEosi").style.display = '';
        document.getElementById("normalEosi").style.display = 'none';
        document.getElementById("belowEosi").style.display = 'none';
    } else if(status == 'below'){
        document.getElementById("normalEosi").style.display = 'none';
        document.getElementById("aboveEosi").style.display = 'none';
        document.getElementById("belowEosi").style.display = '';
    } else{
        document.getElementById("normalEosi").style.display = 'none';
        document.getElementById("aboveEosi").style.display = 'none';
        document.getElementById("belowEosi").style.display = 'none';
    }
}

function checkUrinalysisPus(value){
    if(value >=0 && value <=3){
        var pValue = 'normal';
    } else if(value > 3 && value > 0){
        var pValue = 'above';
    }
    showHideSpanUrinePus(pValue);
}
function showHideSpanUrinePus(status){
    if (status == 'normal'){
        document.getElementById("normalUrinePus").style.display = '';
        document.getElementById("aboveUrinePus").style.display = 'none';
    } else if(status == 'above'){
        document.getElementById("aboveUrinePus").style.display = '';
        document.getElementById("normalUrinePus").style.display = 'none';
    } else{
        document.getElementById("normalUrinePus").style.display = 'none';
        document.getElementById("aboveUrinePus").style.display = 'none';
    }
}

function checkUrineRbc(value){
    if(value >=0 && value <=2){
        var pValue = 'normal';
    } else if(value > 2 && value < 0){
        var pValue = 'above';
    }
    showHideSpanUrineRbc(pValue);
}

function showHideSpanUrineRbc(status){
    if (status == 'normal'){
        document.getElementById("normalUrineRbc").style.display = '';
        document.getElementById("aboveUrineRbc").style.display = 'none';
    } else if(status == 'above'){
        document.getElementById("aboveUrineRbc").style.display = '';
        document.getElementById("normalUrineRbc").style.display = 'none';
    } else{
        document.getElementById("normalUrineRbc").style.display = 'none';
        document.getElementById("aboveUrineRbc").style.display = 'none';
    }
}

function checkAlbumin(value){
    if(value >=0 && value <=8){
        var pValue = 'normal';
    } else if(value > 8 && value < 0){
        var pValue = 'above';
    }
    showHideSpanUrineAlb(pValue);
}

function showHideSpanUrineAlb(status){
    if (status == 'normal'){
        document.getElementById("normalUrineAlb").style.display = '';
        document.getElementById("aboveUrineAlb").style.display = 'none';
    } else if(status == 'above'){
        document.getElementById("aboveUrineAlb").style.display = '';
        document.getElementById("normalUrineAlb").style.display = 'none';
    } else{
        document.getElementById("normalUrineAlb").style.display = 'none';
        document.getElementById("aboveUrineAlb").style.display = 'none';
    }
}

/*Check value of LDL Cholesterol under Lipid Profile*/
function checkLipidLdl(value){
    if(value >=60 && value <=130){
        var pValue = 'normal';
    } else if(value > 130 && value > 0){
        var pValue = 'above';
    } else if(value < 60 && value > 0){
        var pValue = 'below';
    }
    showHideSpanLipidLdl(pValue);
}

/*Show Hide span notification for Lipid Profile - LDL*/
function showHideSpanLipidLdl(status){
    if (status == 'normal'){
        document.getElementById("normalLdl").style.display = '';
        document.getElementById("aboveLdl").style.display = 'none';
        document.getElementById("belowLdl").style.display = 'none';
    } else if(status == 'above'){
        document.getElementById("normalLdl").style.display = 'none';
        document.getElementById("aboveLdl").style.display = '';
        document.getElementById("belowLdl").style.display = 'none';
    } else if(status == 'below'){
        document.getElementById("normalLdl").style.display = 'none';
        document.getElementById("aboveLdl").style.display = 'none';
        document.getElementById("belowLdl").style.display = '';
    } else{
        document.getElementById("normalLdl").style.display = 'none';
        document.getElementById("aboveLdl").style.display = 'none';
        document.getElementById("belowLdl").style.display = 'none';
    }
}

/*Check value of HDL Cholesterol under Lipid Profile*/
function checkLipidHdl(value){
    if(value == 60){
        var pValue = 'normal';
    } else if(value > 60 && value > 0){
        var pValue = 'above';
    } else if(value < 60 && value > 0){
        var pValue = 'below';
    }
    showHideSpanLipidHdl(pValue);
}

/*Show Hide span notification for Lipid Profile - HDL*/
function showHideSpanLipidHdl(status){
    if (status == 'normal'){
        document.getElementById("normalHdl").style.display = '';
        document.getElementById("aboveHdl").style.display = 'none';
        document.getElementById("belowHdl").style.display = 'none';
    } else if(status == 'above'){
        document.getElementById("normalHdl").style.display = 'none';
        document.getElementById("aboveHdl").style.display = '';
        document.getElementById("belowHdl").style.display = 'none';
    } else if(status == 'below'){
        document.getElementById("normalHdl").style.display = 'none';
        document.getElementById("aboveHdl").style.display = 'none';
        document.getElementById("belowHdl").style.display = '';
    } else{
        document.getElementById("normalHdl").style.display = 'none';
        document.getElementById("aboveHdl").style.display = 'none';
        document.getElementById("belowHdl").style.display = 'none';
    }
}

/*Check value of Cholesterol under Lipid Profile*/
function checkLipidChol(value){
    if(value < 200 && value >= 0){
        var pValue = 'normal';
    } else if(value >= 200 && value > 0){
        var pValue = 'above';
    }
    showHideSpanLipidChol(pValue);
}

/*Show Hide span notification for Lipid Profile - Cholesterol*/
function showHideSpanLipidChol(status){
    if (status == 'normal'){
        document.getElementById("normalChol").style.display = '';
        document.getElementById("aboveChol").style.display = 'none';
    } else if(status == 'above'){
        document.getElementById("normalChol").style.display = 'none';
        document.getElementById("aboveChol").style.display = '';
    } else{
        document.getElementById("normalChol").style.display = 'none';
        document.getElementById("aboveChol").style.display = 'none';
    }
}

/*Check value of Triglycerides under Lipid Profile*/
function checkLipidTrigly(value){
    if(value < 150 && value > 0){
        var pValue = 'normal';
    } else if(value >= 150 && value > 0){
        var pValue = 'above';
    }
    showHideSpanLipidTrigly(pValue);
}

/*Show Hide span notification for Lipid Profile - Triglycerides*/
function showHideSpanLipidTrigly(status){
    if (status == 'normal'){
        document.getElementById("normalTrigly").style.display = '';
        document.getElementById("aboveTrigly").style.display = 'none';
    } else if(status == 'above'){
        document.getElementById("normalTrigly").style.display = 'none';
        document.getElementById("aboveTrigly").style.display = '';
    } else{
        document.getElementById("normalTrigly").style.display = 'none';
        document.getElementById("aboveTrigly").style.display = 'none';
    }
}

/*Check value of Glucose under Lipid Profile*/
function checkLipidGlucose(value){
    if(value >=70 && value <= 100){
        var pValue = 'normal';
    } else if(value > 100 && value > 0){
        var pValue = 'above';
    } else if(value < 70 && value > 0){
        var pValue = 'below';
    }
    showHideSpanLipidGlucose(pValue);
}

/*Show Hide span notification for Lipid Profile - Glucose*/
function showHideSpanLipidGlucose(status){
    if (status == 'normal'){
        document.getElementById("normalGlucose").style.display = '';
        document.getElementById("aboveGlucose").style.display = 'none';
        document.getElementById("belowGlucose").style.display = 'none';
    } else if(status == 'above'){
        document.getElementById("normalGlucose").style.display = 'none';
        document.getElementById("aboveGlucose").style.display = '';
        document.getElementById("belowGlucose").style.display = 'none';
    } else if(status == 'below'){
        document.getElementById("normalGlucose").style.display = 'none';
        document.getElementById("aboveGlucose").style.display = 'none';
        document.getElementById("belowGlucose").style.display = '';
    } else{
        document.getElementById("normalGlucose").style.display = 'none';
        document.getElementById("aboveGlucose").style.display = 'none';
        document.getElementById("belowGlucose").style.display = 'none';
    }
}

/* Checked Observation n if OTHER is selected */
function onChangeObservation(reasonID, remarkID) {
    var reasonVal = getValue(reasonID);
    if (reasonVal == '99') { setDisabled(remarkID, false); setFocus(remarkID); }
    else { setDisabled(remarkID, true); }
}
/* Checked Findings n if OTHER is selected */
function onChangeFindings(reasonID, remarkID) {
    var reasonVal = getValue(reasonID);
    if (reasonVal == '99') { setDisabled(remarkID, false); setFocus(remarkID); }
    else { setDisabled(remarkID, true); }
}

/*Add Observation List - Chest X-ray Results*/
function addXrayObservation() {
    var observation = $("#diagnostic_4_chest_observe");
    var remarks = $("#diagnostic_4_chest_observe_remarks");
    var observationTxt = $("#diagnostic_4_chest_observe option:selected").text();
    var already_in_row = $("#tblChestObservation tr > td:contains('"+observation.val()+"')").length;

    if(observation.val() != "") {
        if(already_in_row == 0) {
            $("#tblChestObservation tr:last").before("<tr> \
                                                             <td style='vertical-align: middle; text-align: left;font-size:11px;font-weight: normal;'><input type='hidden' name='observation[]' value='"+observation.val()+"'>"+observationTxt+"</td> \
                                                             <td style='vertical-align: middle;font-size:11px;font-weight: normal;'><input type='hidden' name='observationRemarks[]' value='"+remarks.val()+"'>"+remarks.val()+"</td> \
                                                             <td><button onclick='if(confirm(\"Do you want to remove this item?\")) $(this).closest(\"tr\").remove(); $(\"#diagnostic_4_chest_observe\").focus();' style='width: 100%' class='btn btn-danger'>Remove</button></td> \
                                                           </tr>");
            observation.val("");
            observation.prop("rows","1");
            remarks.val("");
            observation.focus();
        }
        else {
            alert("Observation already added in list.");
            observation.val("");
            observation.prop("rows","1");
            remarks.val("");
            observation.focus();
        }
    }
    else {
        alert("Please input observation details");
        observation.focus();
    }
}

/*Add Medicine in the table*/
function addMedicine() {
    var drugCode = $("#pDrugCode");
    var drugCompleteDesc = $("#pDrugCode option:selected").text();
    var genCode = $("#pGeneric");
    var genDesc = $("#pGeneric option:selected").text();
    var genName = $("#pGenericFreeText");
    var salt = $("#pSalt");
    var saltDesc = $("#pSalt option:selected").text();
    var strength = $("#pStrength");
    var strengthDesc = $("#pStrength option:selected").text();
    var form = $("#pForm");
    var formDesc = $("#pForm option:selected").text();
    var unit = $("#pUnit");
    var unitDesc = $("#pUnit option:selected").text();
    var package = $("#pPackage");
    var packageDesc = $("#pPackage option:selected").text();
    var qty = $("#pQuantity");
    var unitPrice = $("#pUnitPrice");
    var coPayment = $("#pCoPayment");
    var totalPrice = qty.val() * unitPrice.val();
    var qtyIns = $("#pQtyInstruction");
    var strengthIns = $("#pStrengthInstruction");
    var frequency = $("#pFrequencyInstruction");
    var already_in_row = $("#tblResultsMeds tr > td:contains('"+genCode.val()+"')").length;

    var count = $('#tblBodyMeds').children('tr').length;

    if(genCode.val() != "" && strength.val() != "" && form.val() != "" && package.val() != "" && qty.val() != "" && unitPrice.val() != "" && qtyIns.val() != "" && strengthIns.val() != "" &&  frequency.val() != "") {
        if(already_in_row == 0) {
            $("#tblResultsMeds tr:last").after("<tr style='background-color: #FBFCC7'> \
                                                    <td><input type='hidden' name='pDrugCodeMeds[]' value='"+drugCode.val()+"'><input type='hidden' name='pGenCodeMeds[]' value='"+genCode.val()+"'><input type='hidden' name='pSaltCodeMeds[]' value='"+salt.val()+"'><input type='hidden' name='pStrengthCodeMeds[]' value='"+strength.val()+"'><input type='hidden' name='pFormCodeMeds[]' value='"+form.val()+"'><input type='hidden' name='pUnitCodeMeds[]' value='"+unit.val()+"'><input type='hidden' name='pPackageCodeMeds[]' value='"+package.val()+"'><input type='hidden' name='pGenericNameMeds[]' value=''>"+drugCompleteDesc+"</td> \
                                                     <td><input type='hidden' name='pQtyMeds[]' value='"+qty.val()+"'>"+qty.val()+"</td> \
                                                     <td><input type='hidden' name='pUnitPriceMeds[]' value='"+unitPrice.val()+"'>"+unitPrice.val()+"</td> \
                                                     <td><input type='hidden' name='pCoPaymentMeds[]' value='"+coPayment.val()+"'>"+coPayment.val()+"</td> \
                                                     <td><input type='hidden' name='pTotalPriceMeds[]' value='"+totalPrice+"'>"+totalPrice+"</td> \
                                                     <td><input type='hidden' name='pQtyInsMeds[]' value='"+qtyIns.val()+"'>"+qtyIns.val()+"</td> \
                                                     <td><input type='hidden' name='pStrengthInsMeds[]' value='"+strengthIns.val()+"'>"+strengthIns.val()+"</td> \
                                                     <td><input type='hidden' name='pFrequencyInsMeds[]' value='"+frequency.val()+"'>"+frequency.val()+"</td> \
                                                     <td><button onclick='if(confirm(\"Do you want to remove this item?\")) $(this).closest(\"tr\").remove(); $(\"#diagnostic_4_chest_observe\").focus();' style='width: 100%' class='btn btn-danger'>Remove</button></td> \
                                                   </tr>");
            drugCode.val("");
            genCode.empty();
            coPayment.val("");
            qty.val("");
            unitPrice.val("");
            strength.empty();
            form.empty();
            package.empty();
            qtyIns.val("");
            strengthIns.empty();
            strengthIns.val("");
            frequency.val("");
            genName.val("");
            salt.empty();
            unit.empty();
        }
        else {
            alert("Medicine already added in list.");
            drugCode.val("");
            genCode.empty();
            coPayment.val("");
            qty.val("");
            unitPrice.val("");
            strength.empty();
            form.empty();
            package.empty();
            qtyIns.val("");
            strengthIns.empty();
            strengthIns.val("");
            frequency.val("");
            genName.val("");
            salt.empty();
            unit.empty();
        }
    }
    else if(genName.val() != "" && qty.val() != "" && unitPrice.val() != "" && qtyIns.val() != "" && strengthIns.val() != "" && frequency.val() != "") {
            $("#tblResultsMeds tr:last").after("<tr style='background-color: #FBFCC7'> \
                                                     <td><input type='hidden' name='pDrugCodeMeds[]' value=''><input type='hidden' name='pGenCodeMeds[]' value=''><input type='hidden' name='pSaltCodeMeds[]' value=''><input type='hidden' name='pStrengthCodeMeds[]' value=''><input type='hidden' name='pFormCodeMeds[]' value=''><input type='hidden' name='pUnitCodeMeds[]' value=''><input type='hidden' name='pPackageCodeMeds[]' value=''><input type='hidden' name='pGenericNameMeds[]' value='"+genName.val()+"'>"+genDesc+"</td> \
                                                     <td><input type='hidden' name='pQtyMeds[]' value='"+qty.val()+"'>"+qty.val()+"</td> \
                                                     <td><input type='hidden' name='pUnitPriceMeds[]' value='"+unitPrice.val()+"'>"+unitPrice.val()+"</td> \
                                                     <td><input type='hidden' name='pCoPaymentMeds[]' value='"+coPayment.val()+"'>"+coPayment.val()+"</td> \
                                                     <td><input type='hidden' name='pTotalPriceMeds[]' value='"+totalPrice+"'>"+totalPrice+"</td> \
                                                     <td><input type='hidden' name='pQtyInsMeds[]' value='"+qtyIns.val()+"'>"+qtyIns.val()+"</td> \
                                                     <td><input type='hidden' name='pStrengthInsMeds[]' value='"+strengthIns.val()+"'>"+strengthIns.val()+"</td> \
                                                     <td><input type='hidden' name='pFrequencyInsMeds[]' value='"+frequency.val()+"'>"+frequency.val()+"</td> \
                                                     <td><button onclick='if(confirm(\"Do you want to remove this item?\")) $(this).closest(\"tr\").remove(); $(\"#diagnostic_4_chest_observe\").focus();' style='width: 100%' class='btn btn-danger'>Remove</button></td> \
                                                   </tr>");
            drugCode.val("");
            genCode.empty();
            coPayment.val("");
            qty.val("");
            unitPrice.val("");
            strength.empty();
            form.empty();
            package.empty();
            qtyIns.val("");
            strengthIns.empty();
            strengthIns.val("");
            frequency.val("");
            genName.val("");
            salt.empty();
            unit.empty();
    }
    else {
        alert("Please fill up the ff.:\nComplete Drug Description, Quantity, Actual Unit Price, Instruction - Quantity, Strength and Frequency; \n\nOR if not available in the list, Input the following:\n\n" +
            "Generic Name/Salt/Strength/Form/Unit/Package, Quantity, Actual Unit Price, Instruction - Quantity, Strength and Frequency to add on the list of Medicine!");
        drugCode.focus();
    }
}

/*Add Medicine in the table of CF4 Module*/
function addMedicineCf4() {
    var drugCode = $("#pDrugCode");
    var drugCompleteDesc = $("#pDrugCode option:selected").text();
    var genCode = $("#pGeneric");
    var genDesc = $("#pGeneric option:selected").text();
    var genName = $("#pGenericFreeText");
    var strength = $("#pStrength");
    var strengthDesc = $("#pStrength option:selected").text();
    var form = $("#pForm");
    var formDesc = $("#pForm option:selected").text();
    var salt = $("#pSalt");
    var saltDesc = $("#pSalt option:selected").text();
    var unit = $("#pUnit");
    var unitDesc = $("#pUnit option:selected").text();
    var package = $("#pPackage");
    var packageDesc = $("#pPackage option:selected").text();

    var route = $("#pRoute");
    var qty = $("#pQuantity");
    var totalPrice = $("#pTotalPrice");
    var insFrequency = $("#pFrequencyInstruction");
    var already_in_row = $("#tblResultsMeds tr > td:contains('"+genCode.val()+"')").length;

    var count = $('#tblBodyMeds').children('tr').length;

    if(drugCode.val() != "" && qty.val() != "" && totalPrice.val() != "" && route.val() != ""  && insFrequency.val() != "") {
        $("#tblResultsMeds tr:last").after("<tr style='background-color: #FBFCC7'> \
                                                 <td><input type='hidden' name='pDrugCodeMeds[]' value='"+drugCode.val()+"'><input type='hidden' name='pGenCodeMeds[]' value='"+genCode.val()+"'><input type='hidden' name='pSaltCodeMeds[]' value='"+salt.val()+"'><input type='hidden' name='pStrengthCodeMeds[]' value='"+strength.val()+"'><input type='hidden' name='pFormCodeMeds[]' value='"+form.val()+"'><input type='hidden' name='pUnitCodeMeds[]' value='"+unit.val()+"'><input type='hidden' name='pPackageCodeMeds[]' value='"+package.val()+"'><input type='hidden' name='pGenericNameMeds[]' value=''>"+drugCompleteDesc+"</td> \
                                                 <td><input type='hidden' name='pRouteMeds[]' value='"+route.val()+"'>"+route.val()+"</td> \
                                                 <td><input type='hidden' name='pFrequencyMeds[]' value='"+insFrequency.val()+"'>"+insFrequency.val()+"</td> \
                                                 <td><input type='hidden' name='pQtyMeds[]' value='"+qty.val()+"'>"+qty.val()+"</td> \
                                                 <td><input type='hidden' name='pTotalPriceMeds[]' value='"+totalPrice.val()+"'>"+totalPrice.val()+"</td> \
                                                 <td><button onclick='if(confirm(\"Do you want to remove this item?\")) $(this).closest(\"tr\").remove(); $(\"#diagnostic_4_chest_observe\").focus();' style='width: 100%' class='btn btn-danger'>Remove</button></td> \
                                           </tr>");

        if(already_in_row == 0) {
            drugCode.val("");
            genName.val("");
            genCode.empty();
            salt.empty();
            strength.empty();
            form.empty();
            unit.empty();
            package.empty();
            route.val("");
            insFrequency.val("");
            qty.val("");
            totalPrice.val("");
        }
        else {
            alert("Medicine already added in list.");
            drugCode.val("");
            genName.val("");
            genCode.empty();
            salt.empty();
            strength.empty();
            form.empty();
            unit.empty();
            package.empty();
            route.val("");
            insFrequency.val("");
            qty.val("");
            totalPrice.val("");
        }
    }
    else if(genName.val() != "" && qty.val() != "" && totalPrice.val() != "" && route.val() != "" && insFrequency.val() != "") {
        $("#tblResultsMeds tr:last").after("<tr style='background-color: #FBFCC7'> \
                                                 <td><input type='hidden' name='pDrugCodeMeds[]' value=''><input type='hidden' name='pGenCodeMeds[]' value=''><input type='hidden' name='pSaltCodeMeds[]' value=''><input type='hidden' name='pStrengthCodeMeds[]' value=''><input type='hidden' name='pFormCodeMeds[]' value=''><input type='hidden' name='pUnitCodeMeds[]' value=''><input type='hidden' name='pPackageCodeMeds[]' value=''><input type='hidden' name='pGenericNameMeds[]' value='"+genName.val()+"'>"+genName.val()+"</td> \
                                                 <td><input type='hidden' name='pRouteMeds[]' value='"+route.val()+"'>"+route.val()+"</td> \
                                                 <td><input type='hidden' name='pFrequencyMeds[]' value='"+insFrequency.val()+"'>"+insFrequency.val()+"</td> \
                                                 <td><input type='hidden' name='pQtyMeds[]' value='"+qty.val()+"'>"+qty.val()+"</td> \
                                                 <td><input type='hidden' name='pTotalPriceMeds[]' value='"+totalPrice.val()+"'>"+totalPrice.val()+"</td> \
                                                 <td><button onclick='if(confirm(\"Do you want to remove this item?\")) $(this).closest(\"tr\").remove(); $(\"#diagnostic_4_chest_observe\").focus();' style='width: 100%' class='btn btn-danger'>Remove</button></td> \
                                           </tr>");

            drugCode.val("");
            genName.val("");
            genCode.empty();
            salt.empty();
            strength.empty();
            form.empty();
            unit.empty();
            package.empty();
            route.val("");
            insFrequency.val("");
            qty.val("");
            totalPrice.val("");
    }
    else {
        alert("Please fill up the ff.:\nComplete Drug Description, Route, Frequency, Quantity, and Total Amount Price; \n\nOR if not available in the list, Input the following:\n\n" +
            "Generic Name/Salt/Strength/Form/Unit/Package, Route, Frequency, Quantity, and Total Amount Price to add on the list of Medicine!");
        drugCode.focus();
    }
}
/*START HSA MODULE*/
function addOperationHist() {
    var operation = $("#txaMedHistOpHist");
    var op_date = $("#txtMedHistOpDate");
    var already_in_row = $("#tblMedHistOpHist tr > td:contains('"+operation.val()+"') + td:contains('"+op_date.val()+"')").length;

    if(operation.val() != "" && op_date.val() != "") {
        if(already_in_row == 0) {
            $("#tblMedHistOpHist tr:last").before("<tr> \
                                                     <td style='vertical-align: middle; text-align: left;'><input type='hidden' name='operation[]' value='"+operation.val()+"'>"+operation.val()+"</td> \
                                                     <td style='vertical-align: middle;'><input type='hidden' name='operationDate[]' value='"+op_date.val()+"'>"+op_date.val()+"</td> \
                                                     <td><button onclick='if(confirm(\"Do you want to remove this item?\")) $(this).closest(\"tr\").remove(); $(\"#txaMedHistOpHist\").focus();' style='width: 100%' class='btn btn-danger'>Remove</button></td> \
                                                   </tr>");
            operation.val("");
            operation.prop("rows","1");
            op_date.val("");
            operation.focus();
        }
        else {
            alert("Operation already added in list.");
            operation.val("");
            operation.prop("rows","1");
            op_date.val("");
            operation.focus();
        }
    }
    else {
        alert("Please input operation details and date of operation.");
        operation.focus();
    }
}

/*CF4 MODULE - ADD LIST IN COURSE IN THE WARD SUB-MODULE*/
function addCourseInTheWard() {
    var docAction = $("#txtWardDocAction");
    var action_date = $("#txtWardDateOrder");
    var already_in_row = $("#tblCourseWard tr > td:contains('"+action_date.val()+"') + td:contains('"+docAction.val()+"')").length;

    if(docAction.val() != "" && action_date.val() != "") {
        if(already_in_row == 0) {
            $("#tblCourseWard tr:last").before("<tr> \
                                                 <td style='vertical-align: middle;'><input type='hidden' name='pDateActionWard[]' value='"+action_date.val()+"'>"+action_date.val()+"</td> \
                                                 <td style='vertical-align: middle; text-align: left;text-transform: uppercase;'><input type='hidden' name='pActionWard[]' value='"+docAction.val()+"'>"+docAction.val()+"</td> \
                                                 <td><button onclick='if(confirm(\"Do you want to remove this item?\")) $(this).closest(\"tr\").remove(); $(\"#txtWardDocAction\").focus();' style='width: 100%' class='btn btn-danger'>Remove</button></td> \
                                               </tr>");
            docAction.val("");
            docAction.prop("rows","1");
            action_date.val("");
            docAction.focus();
        }
        else {
            alert("Action already added in list.");
            docAction.val("");
            docAction.prop("rows","1");
            action_date.val("");
            docAction.focus();
        }
    }
    else {
        alert("Please input Doctor's Action and Date of Action.");
        docAction.focus();
    }
}

function enDisSpecificMedHist(m_disease_code) {
    var checkbox = $("#chkMedHistDiseases_"+m_disease_code);
    var boolChecked = (checkbox.is(":checked")) ? false : true;
    var boolCheckedNone = (checkbox.is(":checked")) ? true : false;

    if(m_disease_code == "001") {
        $("#txtMedHistAllergy").attr("disabled",boolChecked);
        $("#txtMedHistAllergy").val("");
    }
    else if (m_disease_code == "003") {
        $("#txtMedHistCancer").attr("disabled",boolChecked);
        $("#txtMedHistCancer").val("");
    }
    else if (m_disease_code == "009") {
        $("#txtMedHistHepatitis").attr("disabled",boolChecked);
        $("#txtMedHistHepatitis").val("");
    }
    else if (m_disease_code == "011") {
        $("#txtMedHistBPDiastolic").attr("disabled",boolChecked);
        $("#txtMedHistBPSystolic").attr("disabled",boolChecked);

        $("#txtMedHistBPDiastolic").val("");
        $("#txtMedHistBPSystolic").val("");
    }
    else if (m_disease_code == "015") {
        $("#txtMedHistPTB").attr("disabled",boolChecked);
        $("#txtMedHistPTB").val("");
    }
    else if (m_disease_code == "016") {
        $("#txtMedHistExPTB").attr("disabled",boolChecked);
        $("#txtMedHistExPTB").val("");
    }
    else if (m_disease_code == "998") {
        $("#txaMedHistOthers").attr("disabled",boolChecked);
        $("#txaMedHistOthers").val("");
    }
    else if (m_disease_code == "999") {
        for(x=1;x<=9;x++){
            $("#chkMedHistDiseases_00"+x).attr("disabled",boolCheckedNone);
        }
        for(x=10;x<=18;x++){
            $("#chkMedHistDiseases_0"+x).attr("disabled",boolCheckedNone);
            $("#chkMedHistDiseases_998").attr("disabled",boolCheckedNone);
        }

        $("#txtMedHistAllergy").attr("disabled",true);
        $("#txtMedHistCancer").attr("disabled",true);
        $("#txtMedHistHepatitis").attr("disabled",true);
        $("#txtMedHistBPDiastolic").attr("disabled",true);
        $("#txtMedHistBPSystolic").attr("disabled",true);
        $("#txtMedHistPTB").attr("disabled",true);
        $("#txtMedHistExPTB").attr("disabled",true);
        $("#txaMedHistOthers").attr("disabled",true);
    }
}

function enDisSpecificFamHist(m_disease_code) {
    var checkbox = $("#chkFamHistDiseases_"+m_disease_code);
    var boolChecked = (checkbox.is(":checked")) ? false : true;
    var boolCheckedNone = (checkbox.is(":checked")) ? true : false;

    if(m_disease_code == "001") {
        $("#txtFamHistAllergy").attr("disabled",boolChecked);
        $("#txtFamHistAllergy").val("");
    }
    else if (m_disease_code == "003") {
        $("#txtFamHistCancer").attr("disabled",boolChecked);
        $("#txtFamHistCancer").val("");
    }
    else if (m_disease_code == "009") {
        $("#txtFamHistHepatitis").attr("disabled",boolChecked);
        $("#txtFamHistHepatitis").val("");
    }
    else if (m_disease_code == "011") {
        $("#txtFamHistBPDiastolic").attr("disabled",boolChecked);
        $("#txtFamHistBPSystolic").attr("disabled",boolChecked);

        $("#txtFamHistBPDiastolic").val("");
        $("#txtFamHistBPSystolic").val("");
    }
    else if (m_disease_code == "015") {
        $("#txtFamHistPTB").attr("disabled",boolChecked);
        $("#txtFamHistPTB").val("");
    }
    else if (m_disease_code == "016") {
        $("#txtFamHistExPTB").attr("disabled",boolChecked);
        $("#txtFamHistExPTB").val("");
    }
    else if (m_disease_code == "998") {
        $("#txaFamHistOthers").attr("disabled",boolChecked);
        $("#txaFamHistOthers").val("");
    }
    else if (m_disease_code == "999") {
        for(x=1;x<=9;x++){
            $("#chkFamHistDiseases_00"+x).attr("disabled",boolCheckedNone);
        }
        for(x=10;x<=18;x++){
            $("#chkFamHistDiseases_0"+x).attr("disabled",boolCheckedNone);
            $("#chkFamHistDiseases_998").attr("disabled",boolCheckedNone);
        }

        $("#txtFamHistAllergy").attr("disabled",true);
        $("#txtFamHistCancer").attr("disabled",true);
        $("#txtFamHistHepatitis").attr("disabled",true);
        $("#txtFamHistBPSystolic").attr("disabled",true);
        $("#txtFamHistBPDiastolic").attr("disabled",true);
        $("#txtFamHistPTB").attr("disabled",true);
        $("#txtFamHistExPTB").attr("disabled",true);
        $("#txaFamHistOthers").attr("disabled",true);

    }
}

function enDisImmuneChild(m_immune_code) {
    var checkbox = $("#chkImmChild_" + m_immune_code);
    var boolCheckedNone = (checkbox.is(":checked")) ? true : false;

    if (m_immune_code == "999") {
        for(x=1;x<=9;x++){
            $("#chkImmChild_C0"+x).attr("disabled", boolCheckedNone);
        }
        for(x=10;x<=13;x++){
            $("#chkImmChild_C"+x).attr("disabled",boolCheckedNone);
        }
    }
}

function enDisImmuneAdult(m_immune_code) {
    var checkbox = $("#chkImmAdult_" + m_immune_code);
    var boolCheckedNone = (checkbox.is(":checked")) ? true : false;

    if (m_immune_code == "999") {
        for(x=1;x<=2;x++){
            $("#chkImmAdult_Y0"+x).attr("disabled",boolCheckedNone);
        }
    }
}

function enDisImmunePreg(m_immune_code) {
    var checkbox = $("#chkImmPregnant_" + m_immune_code);
    var boolCheckedNone = (checkbox.is(":checked")) ? true : false;

    if (m_immune_code == "999") {
        for(x=1;x<=2;x++){
            $("#chkImmPregnant_P0"+x).attr("disabled",boolCheckedNone);
        }
    }
}

function enDisImmuneElder(m_immune_code) {
    var checkbox = $("#chkImmElderly_" + m_immune_code);
    var boolCheckedNone = (checkbox.is(":checked")) ? true : false;

    if (m_immune_code == "999") {
        for(x=1;x<=2;x++){
            $("#chkImmElderly_E0"+x).attr("disabled",boolCheckedNone);
        }
    }
}

function disDigitalRectal(rectal_code) {
    var checkbox = $("#rectal_" + rectal_code);
    var boolCheckedNone = (checkbox.is(":checked")) ? true : false;

    if (rectal_code == "0") {
        for(x=1;x<=5;x++){
            $("#rectal_"+x).attr("disabled",boolCheckedNone);
        }
    }
}

function resizeTextArea() {
    var textarea = $("#txaMedHistOpHist").val();

    if(textarea != "") {
        var rows = textarea.split("\n");
        $("#txaMedHistOpHist").prop("rows",rows.length+1);
    }
    else {
        $("#txaMedHistOpHist").prop("rows","1");
    }
};

function resizeTextAreaCf4() {
    var textarea = $("#txtWardDocAction").val();

    if(textarea != "") {
        var rows = textarea.split("\n");
        $("#txtWardDocAction").prop("rows",rows.length+1);
    }
    else {
        $("#txtWardDocAction").prop("rows","1");
    }
};

function loadMunicipalities(prov_code) {
    $("#optPerHistPobMun").load("loadMunicipality.php?pProvCode=" + prov_code);
}

/*START SAVE HSA TRANSACTION*/
function acceptNumOnly(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false
    }
}
/*Validate Final Health Screening & Assessment Fields*/
function saveFinalHsaTransaction() {
    var txtProfileOTP = $("#txtPerHistOTP").val();
    var txtProfileDate = $("#txtPerHistProfDate").val();
    /*Individual Health Profile*/
    var txtBirthProvince = $("#optPerHistPobProv option:selected").val();
    var txtBirthMun = $("#optPerHistPobMun option:selected").val();
    var txtMomDoB = $("#txtPerHistMomBirthday").val();
    var txtDadDob = $("#txtPerHistDadBirthday").val();

    /*Start Get date today*/
    var dateToday = new Date();
    var dateMomDoB = new Date(txtMomDoB);
    var dateDadDoB = new Date(txtDadDob);

    var compareMomDoB = compareDates(dateToday,dateMomDoB);
    var compareDadDoB = compareDates(dateToday,dateDadDoB);
    var compareProfDate = compareDates(dateToday,txtProfileDate);
    /*End Get date today*/

    /*Past Medical History*/
    var chkAllergy = $("#chkMedHistDiseases_001").is(":checked");
    var chkCancer = $("#chkMedHistDiseases_003").is(":checked");
    var chkHepatitis = $("#chkMedHistDiseases_009").is(":checked");
    var chkHypertension = $("#chkMedHistDiseases_011").is(":checked");
    var chkPTB = $("#chkMedHistDiseases_015").is(":checked");
    var chkExPTB = $("#chkMedHistDiseases_016").is(":checked");
    var chkOthers = $("#chkMedHistDiseases_998").is(":checked");

    var txtAllergy = $("#txtMedHistAllergy").val();
    var txtCancer = $("#txtMedHistCancer").val();
    var txtHepatitis = $("#txtMedHistHepatitis").val();
    var txtDiastolic = $("#txtMedHistBPDiastolic").val();
    var txtSystolic = $("#txtMedHistBPSystolic").val();
    var txtPTB = $("#txtMedHistPTB").val();
    var txtExPTB = $("#txtMedHistExPTB").val();
    var txaOthers = $("#txaMedHistOthers").val();

    /*Family & Personal History*/
    var chkAllergyFam = $("#chkFamHistDiseases_001").is(":checked");
    var chkCancerFam = $("#chkFamHistDiseases_003").is(":checked");
    var chkHepatitisFam = $("#chkFamHistDiseases_009").is(":checked");
    var chkHypertensionFam = $("#chkFamHistDiseases_011").is(":checked");
    var chkPTBfam = $("#chkFamHistDiseases_015").is(":checked");
    var chkExPTBfam = $("#chkFamHistDiseases_016").is(":checked");
    var chkOthersFam = $("#chkFamHistDiseases_998").is(":checked");

    var txtAllergyFam = $("#txtFamHistAllergy").val();
    var txtCancerFam = $("#txtFamHistCancer").val();
    var txtHepatitisFam = $("#txtFamHistHepatitis").val();
    var txtDiastolicFam = $("#txtFamHistBPDiastolic").val();
    var txtSystolicFam = $("#txtFamHistBPSystolic").val();
    var txtPTBfam = $("#txtFamHistPTB").val();
    var txtExPTBfam = $("#txtFamHistExPTB").val();
    var txaOthersFam = $("#txaFamHistOthers").val();

    /*Personal/Social History*/
    var chkFamHistSmokeY = $("#radFamHistSmokeY").is(":checked");
    var chkFamHistSmokeN = $("#radFamHistSmokeN").is(":checked");
    var chkFamHistSmokeX = $("#radFamHistSmokeX").is(":checked");
    var chkFamHistAlcoholY = $("#radFamHistAlcoholY").is(":checked");
    var chkFamHistAlcoholN = $("#radFamHistAlcoholN").is(":checked");
    var chkFamHistAlcoholX = $("#radFamHistAlcoholX").is(":checked");
    var chkFamHistAlcoholX = $("#radFamHistAlcoholX").is(":checked");
    var chkFamHistDrugsY = $("#radFamHistDrugsY").is(":checked");
    var chkFamHistDrugsN = $("#radFamHistDrugsN").is(":checked");

    /*Pertinent Physical Examination Findings*/
    var txtPhExSystolic = $("#txtPhExSystolic").val();
    var txtPhExBPDiastolic = $("#txtPhExBPDiastolic").val();
    var txtPhExHeartRate = $("#txtPhExHeartRate").val();
    var txtPhExRespiratoryRate = $("#txtPhExRespiratoryRate").val();
    var txtPhExHeightCm = $("#txtPhExHeightCm").val();
    var txtPhExWeightKg = $("#txtPhExWeightKg").val();
    var txtPhExTemp = $("#txtPhExTemp").val();
    var txtPhExVisualAcuityL = $("#txtPhExVisualAcuityL").val();
    var txtPhExVisualAcuityR = $("#txtPhExVisualAcuityR").val();

    /*General Survey*/
    var chkGenSurvey1 = $("#pGenSurvey_1").is(":checked");
    var chkGenSurvey2 = $("#pGenSurvey_2").is(":checked");
    var txtGenSurveyRem = $("#pGenSurveyRem").val();

    /*Check if Done tabs*/
    var chkPMH = $("#pmhDone_1").is(":checked");
    /*var chkPSH = $("#pshDone_1").is(":checked");*/
    var chkFH = $("#fhDone_1").is(":checked");
    var chkPH = $("#phDone_1").is(":checked");
    var chkIMM = $("#immDone_1").is(":checked");
    var chkMHdone = $("#mhDone_0").is(":checked");
    var chkMH = $("#mhDone_2").is(":checked");
    var chkPREGdone = $("#pregDone_0").is(":checked");
    var chkPREG = $("#pregDone_2").is(":checked");
    var chkPE = $("#peDone_1").is(":checked");
    var chkPEdone = $("#peDone_0").is(":checked");
    var chkPF = $("#pfDone_1").is(":checked");
    var chkPlanMngmt = $("#pmDone_1").is(":checked");
    var chkPlanMngmtDone = $("#pmDone_0").is(":checked");
    var chkMeds = $("#medsDone_1").is(":checked");

    /*Labs*/
    var chkCBC = $("#cbcDone_1").is(":checked"); //notyetdone
    var chkCBCdone = $("#cbcDone_0").is(":checked"); //done
    var chkUrinalysis = $("#urineDone_1").is(":checked");//notyetdone
    var chkUrinalysisDone = $("#urineDone_0").is(":checked");//done
    var chkFecalysis = $("#fecaDone_1").is(":checked");//notyetdone
    var chkFecalysisDone = $("#fecaDone_0").is(":checked");//done
    var chkXray = $("#xrayDone_1").is(":checked");//notyetdone
    var chkXrayDone = $("#xrayDone_0").is(":checked");//done
    var chkSputum = $("#sputumDone_1").is(":checked");//notyetdone
    var chkSputumDone = $("#sputumDone_0").is(":checked");//done
    var chkLipid = $("#lipidDone_1").is(":checked");//notyetdone
    var chkLipidDone = $("#lipidDone_0").is(":checked");//done
    var chkECG = $("#ecgDone_1").is(":checked");//notyetdone
    var chkECGDone = $("#ecgDone_0").is(":checked");//done
    var chkPapsSmear = $("#papsDone_1").is(":checked");//notyetdone
    var chkPapsSmearDone = $("#papsDone_0").is(":checked");//done
    var chkOGTT = $("#ogttDone_1").is(":checked");//notyetdone
    var chkOGTTDone = $("#ogttDone_0").is(":checked");//done

    /*CBC*/
    var txtCbcLabDate = $("#diagnostic_1_lab_exam_date").val();
    var dateCbcDate = new Date(txtCbcLabDate);
    var compareCbcDate = compareDates(dateToday,dateCbcDate);
    var txtCbcLabFee = $("#diagnostic_1_lab_fee").val();
    var txtCbcHema = $("#diagnostic_1_hematocrit").val();
    var txtCbchemo = $("#diagnostic_1_hemoglobin_gdL").val();
    var txtCbcMhc = $("#diagnostic_1_mhc_pgcell").val();
    var txtCbcMchc= $("#diagnostic_1_mchc_gHbdL").val();
    var txtCbcMcv = $("#diagnostic_1_mcv_um").val();
    var txtCbcWbc = $("#diagnostic_1_wbc_cellsmmuL").val();
    var txtCbcMyelocyte = $("#diagnostic_1_myelocyte").val();
    var txtCbcNeutroBand = $("#diagnostic_1_neutrophils_bands").val();
    var txtCbcNeutroSeg = $("#diagnostic_1_neutrophils_segmenters").val();
    var txtCbcLymph = $("#diagnostic_1_lymphocytes").val();
    var txtCbcMono = $("#diagnostic_1_monocytes").val();
    var txtCbcEosi = $("#diagnostic_1_eosinophils").val();
    var txtCbcBaso = $("#diagnostic_1_basophils").val();
    var txtCbcPlatelet = $("#diagnostic_1_platelet").val();

    /*PAPS SMEAR*/
    var txtPapsLabDate = $("#diagnostic_13_lab_exam_date").val();
    var datePaps = new Date(txtCbcLabDate);
    var comparePapsDate = compareDates(dateToday,datePaps);
    var txtPapsLabFee = $("#diagnostic_13_lab_fee").val();
    var txtPapsFind = $("#diagnostic_13_papsSmearFindings").val();
    var txtPapsImpre = $("#diagnostic_13_papsSmearImpression").val();

    /*OGTT*/
    var txtOgttLabDate = $("#diagnostic_14_lab_exam_date").val();
    var dateOgtt = new Date(txtOgttLabDate);
    var compareOgttDate = compareDates(dateToday,dateOgtt);
    var txtOgttLabFee = $("#diagnostic_14_lab_fee").val();
    var txtOgttFastMg = $("#diagnostic_14_fasting_mg").val();
    var txtOgttFastMmol = $("#diagnostic_14_fasting_mmol").val();
    var txtOgttOneMg = $("#diagnostic_14_oneHr_mg").val();
    var txtOgttOneMmol = $("#diagnostic_14_oneHr_mmol").val();
    var txtOgttTwoMg = $("#diagnostic_14_twoHr_mg").val();
    var txtOgttTwoMmol = $("#diagnostic_14_twoHr_mmol").val();

    /*URINALYSIS*/
    var txtUrineLabDate = $("#diagnostic_2_lab_exam_date").val();
    var dateUrine = new Date(txtUrineLabDate);
    var compareUrineDate = compareDates(dateToday,dateUrine);
    var txtUrineLabFee = $("#diagnostic_2_lab_fee").val();
    var txtUrineSg = $("#diagnostic_2_sg").val();
    var txtUrineAppear = $("#diagnostic_2_appearance").val();
    var txtUrineColor = $("#diagnostic_2_color").val();
    var txtUrineGlucose = $("#diagnostic_2_glucose").val();
    var txtUrineProtein = $("#diagnostic_2_proteins").val();
    var txtUrineKetones = $("#diagnostic_2_ketones").val();
    var txtUrinePh = $("#diagnostic_2_pH").val();
    var txtUrinePus = $("#diagnostic_2_pus").val();
    var txtUrineAlb = $("#diagnostic_2_alb").val();
    var txtUrineRbc = $("#diagnostic_2_rbc").val();
    var txtUrineWbc = $("#diagnostic_2_wbc").val();
    var txtUrineBact = $("#diagnostic_2_bacteria").val();
    var txtUrineCryst = $("#diagnostic_2_crystals").val();
    var txtUrineBlad = $("#diagnostic_2_bladder_cells").val();
    var txtUrineSqCell= $("#diagnostic_2_squamous_cells").val();
    var txtUrineTubCell = $("#diagnostic_2_tubular_cells").val();
    var txtUrineBrCast = $("#diagnostic_2_broad_casts").val();
    var txtUrineCellCast = $("#diagnostic_2_epithelial_cell_casts").val();
    var txtUrineGranCast = $("#diagnostic_2_granular_casts").val();
    var txtUrineHyaCast = $("#diagnostic_2_hyaline_casts").val();
    var txtUrineRbcCast = $("#diagnostic_2_rbc_casts").val();
    var txtUrineWaxyCast = $("#diagnostic_2_waxy_casts").val();
    var txtUrineWcCast = $("#diagnostic_2_wc_casts").val();

    /*FECALYSIS*/
    var txtFecaLabDate = $("#diagnostic_3_lab_exam_date").val();
    var dateFeca = new Date(txtFecaLabDate);
    var compareFecaDate = compareDates(dateToday,dateFeca);
    var txtFecaLabFee = $("#diagnostic_3_lab_fee").val();
    var txtFecaPus = $("#diagnostic_3_pus").val();
    var txtFecaRbc = $("#diagnostic_3_rbc").val();
    var txtFecaWbc = $("#diagnostic_3_wbc").val();
    var txtFecaOva = $("#diagnostic_3_ova").val();
    var txtFecaPara = $("#diagnostic_3_parasite").val();
    var txtFecaOccult = $("#diagnostic_3_occult_blood").val();

    /*CHEST X-RAY*/
    var txtXrayLabDate = $("#diagnostic_4_lab_exam_date").val();
    var dateXray = new Date(txtXrayLabDate);
    var compareXrayDate = compareDates(dateToday,dateXray);
    var txtXrayLabFee = $("#diagnostic_4_lab_fee").val();
    var txtXrayFindings = $("#diagnostic_4_chest_findings option:selected").val();

    /*SPUTUM MICROSCOPY*/
    var txtSputumLabDate = $("#diagnostic_5_lab_exam_date").val();
    var dateSputum = new Date(txtSputumLabDate);
    var compareSputumDate = compareDates(dateToday,dateSputum);
    var txtSputumLabFee = $("#diagnostic_5_lab_fee").val();
    var txtSputumPlusses = $("#diagnostic_5_plusses").val();

    /*LIPID PROFILE*/
    var txtLipidLabDate = $("#diagnostic_6_lab_exam_date").val();
    var dateLipid = new Date(txtLipidLabDate);
    var compareLipidDate = compareDates(dateToday,dateLipid);
    var txtLipidLabFee = $("#diagnostic_6_lab_fee").val();
    var txtLipidTotal = $("#diagnostic_6_total").val();
    var txtLipidLdl = $("#diagnostic_6_ldl").val();
    var txtLipidHdl = $("#diagnostic_6_hdl").val();
    var txtLipidChol = $("#diagnostic_6_cholesterol").val();
    var txtLipidTrigy = $("#diagnostic_6_triglycerides").val();

    /*ECG*/
    var txtEcgLabDate = $("#diagnostic_9_lab_exam_date").val();
    var dateEcg = new Date(txtEcgLabDate);
    var compareEcgDate = compareDates(dateToday,dateEcg);
    var txtEcgLabFee = $("#diagnostic_9_lab_fee").val();
    var chkEcgNormal = $("#diagnostic_9_no").is(":checked");
    var chkEcgNotnNormal = $("#diagnostic_9_yes").is(":checked");
    var remEcgFindings = $("#diagnostic_9_ecg_remarks").val();

    /*Menstrual History*/
    var txtMenarche = $("#txtOBHistMenarche").val();
    var txtLastMens = $("#txtOBHistLastMens").val();
    var dateLastMens = new Date(txtLastMens);
    var compareLastMensDate = compareDates(dateToday,dateLastMens);
    var txtPeriodDuration = $("#txtOBHistPeriodDuration").val();
    /*Pregnancy History*/
    var txtGravity = $("#txtOBHistGravity").val();
    var txtParity = $("#txtOBHistParity").val();

    var whatSex = $("#txtPerHistPatSex").val();
    var whatAge = $("#valtxtPerHistPatAge").val();
    var whatMonths = $("#valtxtPerHistPatMonths").val();

    if (txtProfileOTP == "") {
        alert("Authorization Transaction Code is required under PATIENT PROFILE menu");
        $("#txtPerHistOTP").focus();
        return false;
    }
    else if (txtProfileDate == "" || compareProfDate == "0") {
        alert("Screening & Assessment Date under PATIENT PROFILE menu is invalid! It should be less than or equal to current day.");
        $("#txtPerHistProfDate").focus();
        return false;
    }
    else if(txtBirthProvince == "" || txtBirthMun == ""){
        alert("Please fill up all required fields of Individual Health Profile in PATIENT PROFILE menu");
        return false;
    }
    else if(compareMomDoB == "0"){
        alert("Mother's Date of Birth is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(compareDadDoB == "0"){
        alert("Father's Date of Birth is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(validateChecksMedsHist() == false){
        alert("Choose at least one Past Medical History in MEDICAL & SURGICAL HISTORY menu");
        return false;
    }
    /*CHECK IF TEXTBOXES HAS VALUE IF CHECKED IN MEDICAL & SURGICAL HISTORY*/
    else if(chkAllergy == true && txtAllergy == "") {
        alert("Please specify allergy under MEDICAL & SURGICAL HISTORY menu.");
        return false;
    }
    else if(chkCancer == true && txtCancer == "") {
        alert("Please specify organ with cancer under MEDICAL & SURGICAL HISTORY menu.");
        $("#txtMedHistCancer").focus();
        return false;
    }
    else if(chkHepatitis == true && txtHepatitis == "") {
        alert("Please specify hepatitis type under MEDICAL & SURGICAL HISTORY menu.");
        $("#txtMedHistHepatitis").focus();
        return false;
    }
    else if(chkHypertension == true && (txtSystolic == "" || txtDiastolic == "")) {
        alert("Please specify highest blood pressure under MEDICAL & SURGICAL HISTORY menu.");
        if(txtSystolic == "") {
            $("#txtMedHistBPSystolic").focus();
        }
        else {
            $("#txtMedHistBPDiastolic").focus();
        }
        return false;
    }
    else if(chkPTB == true && txtPTB == "") {
        alert("Please specify Pulmonary Tuberculosis category under MEDICAL & SURGICAL HISTORY menu.");
        $("#txtMedHistPTB").focus();
        return false;
    }
    else if(chkExPTB == true && txtExPTB == "") {
        alert("Please specify Extrapulmonary Tuberculosis category under MEDICAL & SURGICAL HISTORY menu.");
        $("#txtMedHistExPTB").focus();
        return false;
    }
    else if(chkOthers == true && txaOthers == "") {
        alert("Please specify others under MEDICAL & SURGICAL HISTORY menu.");
        $("#txaMedHistOthers").focus();
        return false;
    }
    /*CHECK IF TEXTBOXES HAS VALUE IF CHECKED IN FAMILY & PERSONAL HISTORY*/
    else if(chkAllergyFam == true && txtAllergyFam == "") {
        alert("Please specify allergy under FAMILY & PERSONAL HISTORY menu.");
        return false;
    }
    else if(chkCancerFam == true && txtCancerFam == "") {
        alert("Please specify organ with cancer under FAMILY & PERSONAL HISTORY menu.");
        $("#txtFamHistCancer").focus();
        return false;
    }
    else if(chkHepatitisFam == true && txtHepatitisFam == "") {
        alert("Please specify hepatitis type under FAMILY & PERSONAL HISTORY menu.");
        $("#txtFamHistHepatitis").focus();
        return false;
    }
    else if(validateChecksFamHist() == false){
        alert("Choose at least one Family History in FAMILY & PERSONAL HISTORY menu");
        return false;
    }
    else if(chkHypertensionFam == true && (txtSystolicFam == "" || txtDiastolicFam == "")) {
        alert("Please specify highest blood pressure under FAMILY & PERSONAL HISTORY menu.");
        if(txtSystolic == "") {
            $("#txtFamHistBPSystolic").focus();
        }
        else {
            $("#txtFamHistBPDiastolic").focus();
        }
        return false;
    }
    else if(chkPTBfam == true && txtPTBfam == "") {
        alert("Please specify Pulmonary Tuberculosis category under FAMILY & PERSONAL HISTORY menu.");
        $("#txtFamHistPTB").focus();
        return false;
    }
    else if(chkExPTBfam == true && txtExPTBfam == "") {
        alert("Please specify Extrapulmonary Tuberculosis category under FAMILY & PERSONAL HISTORY menu.");
        $("#txtFamHistExPTB").focus();
        return false;
    }
    else if(chkOthersFam == true && txaOthersFam == "") {
        alert("Please specify others.");
        $("#txaFamHistOthers").focus();
        return false;
    }
    else if(chkFamHistSmokeY == false && chkFamHistSmokeN == false && chkFamHistSmokeX == false) {
        alert("Fill up all the required fields of Personal/Social History in FAMILY & PERSONAL HISTORY menu.");
        return false;
    }
    else if(chkFamHistAlcoholY == false && chkFamHistAlcoholN == false && chkFamHistAlcoholX == false) {
        alert("Fill up all the required fields of Personal/Social History in FAMILY & PERSONAL HISTORY menu.");
        return false;
    }
    else if(chkFamHistDrugsY == false && chkFamHistDrugsN == false) {
        alert("Fill up all the required fields of Personal/Social History in FAMILY & PERSONAL HISTORY menu.");
        return false;
    }
    else if(validateChecksImmune() == false){
        alert("Choose at least one in each category of IMMUNIZATION");
        return false;
    }
    else if(chkMH == true){
        alert("Check DONE/NOT APPLICABLE in MENSTRUAL HISTORY!");
        return false;
    }
    else if(chkMHdone == true && whatSex == "FEMALE" && (txtMenarche == "" || txtLastMens == "" || txtPeriodDuration == "") && whatAge >= 10){
        alert("Menarche, Last Menstrual Period and Period Duration are REQUIRED in MENSTRUAL HISTORY under OB-GYNE HISTORY menu!");
        return false;
    }
    else if(compareLastMensDate == "0"){
        alert("Date of Last Menstrual Period is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkPREG == true){
        alert("Check DONE/NOT APPLICABLE in PREGNANCY HISTORY!");
        $("#immDone_1").focus();
        return false;
    }
    else if(chkPREGdone == true && whatSex == "FEMALE" && txtGravity == "" && txtParity == ""){
        alert("Gravity and Parity are REQUIRED in PREGNANCY HISTORY under OB-GYNE HISTORY menu!");
        return false;
    }
    else if(txtPhExSystolic == "" || txtPhExBPDiastolic == "" || txtPhExHeartRate == "" || txtPhExRespiratoryRate == "" || txtPhExHeightCm == "" || txtPhExWeightKg == "" || txtPhExTemp == "" || txtPhExVisualAcuityL == "" || txtPhExVisualAcuityL == ""){
        alert("Please fill up all required fields in PERTINENT PHYSICAL EXAMINATION FINDINGS!");
        return false;
    }
    else if(chkGenSurvey1 == false && chkGenSurvey2 == false){
        alert("Please specify General Survey under PERTINENT PHYSICAL EXAMINATION FINDINGS!");
        $("#pGenSurvey_1").focus();
        return false;
    }
    else if(chkGenSurvey2 == true && txtGenSurveyRem == ""){
        alert("Please specify Altered Sensorium in General Survey under PHYSICAL EXAMINATION ON ADMISSION!");
        $("#pGenSurveyRem").focus();
        return false;
    }
    else if(validateChecksHeent() == false){
        alert("Choose at least one HEENT in PERTINENT FINDINGS PER SYSTEM of PERTINENT PHYSICAL EXAMINATION FINDINGS");
        return false;
    }
    else if(validateChecksChest() == false){
        alert("Choose at least one CHEST/BREAST/LUNGS in PERTINENT FINDINGS PER SYSTEM of PERTINENT PHYSICAL EXAMINATION FINDINGS");
        return false;
    }
    else if(validateChecksHeart() == false){
        alert("Choose at least one HEART in PERTINENT FINDINGS PER SYSTEM of PERTINENT PHYSICAL EXAMINATION FINDINGS");
        return false;
    }
    else if(validateChecksAbdomen() == false){
        alert("Choose at least one ABDOMEN in PERTINENT FINDINGS PER SYSTEM of PERTINENT PHYSICAL EXAMINATION FINDINGS");
        return false;
    }
    else if(validateChecksGenitoUrinary() == false){
        alert("Choose at least one GENITOURINARY in PERTINENT FINDINGS PER SYSTEM of PERTINENT PHYSICAL EXAMINATION FINDINGS");
        return false;
    }
    else if(validateChecksRectal() == false){
        alert("Choose at least one DIGITAL RECTAL EXAMINATION in PERTINENT FINDINGS PER SYSTEM of PERTINENT PHYSICAL EXAMINATION FINDINGS");
        return false;
    }
    else if(validateChecksSkin() == false){
        alert("Choose at least one SKIN/EXTREMITIES in PERTINENT FINDINGS PER SYSTEM of PERTINENT PHYSICAL EXAMINATION FINDINGS");
        return false;
    }
    else if(validateChecksNeuro() == false){
        alert("Choose at least one NEUROLOGICAL EXAMINATION in PERTINENT FINDINGS PER SYSTEM of PERTINENT PHYSICAL EXAMINATION FINDINGS");
        return false;
    }
    else if(chkCBC == true){
        alert("Fill up all required fields and check DONE of Complete Blood Count in LABORATORY RESULTS!");
        $("#cbcDone_1").focus();
        return false;
    }
    else if(chkCBCdone == true && txtCbcLabDate == "" && txtCbcLabFee == "" && txtCbcHema == "" && txtCbchemo == "" && txtCbcMhc == "" && txtCbcMchc == "" && txtCbcMcv == "" && txtCbcWbc == "" && txtCbcMyelocyte == "" && txtCbcNeutroBand == "" && txtCbcNeutroSeg == "" && txtCbcLymph == "" && txtCbcMono == "" && txtCbcEosi == "" && txtCbcBaso == "" && txtCbcPlatelet == ""){
        alert("Fill up all required fields of CBC in LABORATORY RESULTS!");
        return false;
    }
    else if(compareCbcDate == "0"){
        alert("Laboratory Date of CBC is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkUrinalysis == true){
        alert("Fill up all required fields and check DONE of Urinalysis in LABORATORY RESULTS!");
        $("#urineDone_1").focus();
        return false;
    }
    else if(chkUrinalysisDone == true && txtUrineLabDate == "" && txtUrineLabFee == "" && txtUrineSg == "" && txtUrineAppear == "" && txtUrineColor == "" && txtUrineGlucose == "" && txtUrineProtein == "" &&
        txtUrineKetones == "" && txtUrinePh == "" && txtUrinePus == "" && txtUrineAlb == "" && txtUrineRbc == "" && txtUrineWbc == "" && txtUrineBact == "" && txtUrineCryst == "" && txtUrineBlad == "" &&
        txtUrineSqCell == "" && txtUrineTubCell == "" && txtUrineBrCast == "" && txtUrineCellCast == "" && txtUrineGranCast == "" && txtUrineHyaCast == "" && txtUrineRbcCast == "" && txtUrineWaxyCast == "" && txtUrineWcCast == ""){
        alert("Fill up all required fields of Urinalysis in LABORATORY RESULTS!");
        return false;
    }
    else if(compareUrineDate == "0"){
        alert("Laboratory Date of Urinalysis is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkFecalysis == true){
        alert("Fill up all required fields and check DONE of Fecalysis in LABORATORY RESULTS!");
        $("#fecaDone_1").focus();
        return false;
    }
    else if(chkFecalysisDone == true && txtFecaLabDate == "" && txtFecaLabFee == "" && txtFecaPus == "" && txtFecaRbc == "" && txtFecaWbc == "" && txtFecaOva == "" && txtFecaPara == "" && txtFecaOccult == ""){
        alert("Fill up all required fields of Fecalysis in LABORATORY RESULTS!");
        return false;
    }
    else if(compareFecaDate == "0"){
        alert("Laboratory Date of Fecalysis is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkXray == true){
        alert("Fill up all required fields and check DONE of Chest X-ray in LABORATORY RESULTS!");
        $("#xrayDone_1").focus();
        return false;
    }
    else if(chkXrayDone == true && txtXrayLabDate == "" && txtXrayLabFee == "" && txtXrayFindings == ""){
        alert("Fill up all required fields of Chest X-ray in LABORATORY RESULTS!");
        return false;
    }
    else if(compareXrayDate == "0"){
        alert("Laboratory Date of Chest X-ray is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkSputum == true){
        alert("Fill up all required fields and check DONE of Sputum Microscopy in LABORATORY RESULTS!");
        $("#sputumDone_1").focus();
        return false;
    }
    else if(chkSputumDone == true && txtSputumLabDate == "" && txtSputumLabFee == "" && txtSputumPlusses == ""){
        alert("Fill up all required fields of Sputum Microscopy in LABORATORY RESULTS!");
        return false;
    }
    else if(compareSputumDate == "0"){
        alert("Laboratory Date of Sputum Microscopy is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkLipid == true){
        alert("Fill up all required fields and check DONE of Lipid Profile in LABORATORY RESULTS!");
        $("#lipidDone_1").focus();
        return false;
    }
    else if(chkLipidDone == true && txtLipidLabDate == "" && txtLipidLabFee == "" && txtLipidTotal == "" && txtLipidLdl == "" && txtLipidHdl == "" && txtLipidChol == "" && txtLipidTrigy == ""){
        alert("Fill up all required fields of Lipid Profile in LABORATORY RESULTS!");
        return false;
    }
    else if(compareLipidDate == "0"){
        alert("Laboratory Date of Lipid Profile is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkECG == true){
        alert("Fill up all required fields and check DONE of Electrocardiogram (ECG) in LABORATORY RESULTS!");
        $("#ecgDone_1").focus();
        return false;
    }
    else if(chkECGDone == true && txtEcgLabDate == "" && txtEcgLabFee == "" && chkEcgNormal == false && chkEcgNotnNormal == false){
        alert("Fill up all required fields of Electrocardiogram (ECG) in LABORATORY RESULTS!");
        return false;
    }
    else if(compareEcgDate == "0"){
        alert("Laboratory Date of ECG is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkPapsSmear == true){
        alert("Fill up all required fields and check DONE of Paps Smear in LABORATORY RESULTS!");
        $("#papsDone_1").focus();
        return false;
    }
    else if(chkPapsSmearDone == true && txtPapsLabDate == "" && txtPapsLabFee == "" && txtPapsFind == "" && txtPapsImpre == ""){
        alert("Fill up all required fields of Paps Smear in LABORATORY RESULTS!");
        return false;
    }
    else if(comparePapsDate == "0"){
        alert("Laboratory Date of Paps Smear is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkOGTT == true){
        alert("Fill up all required fields and check DONE of Oral Glucose Tolerance Test (OGTT) in LABORATORY RESULTS!");
        $("#ogttDone_1").focus();
        return false;
    }
    else if(chkOGTTDone == true && txtOgttLabDate == "" && txtOgttLabFee == "" && txtOgttFastMg == "" && txtOgttFastMmol == "" && txtOgttOneMg == "" && txtOgttOneMmol == "" && txtOgttTwoMg == ""  && txtOgttTwoMmol == ""){
        alert("Fill up all required fields of Oral Glucose Tolerance Test (OGTT) in LABORATORY RESULTS!");
        return false;
    }
    else if(compareOgttDate == "0"){
        alert("Laboratory Date of OGTT is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(validateChecksPlan() == false){
        if(document.getElementById('diagnostic_NA').checked == false && document.getElementById('management_NA').checked == false ){
            alert("Fill up all the required fields in PLAN/MANAGEMENT");
            return false;
        }
    }
    else {
        //TO DO SAVING
        return confirm('Do you want to submit it now?');
    }
} /*END SAVE FINAL HSA TRANSACTION*/

function saveHsaTransaction() {
    var txtProfileOTP = $("#txtPerHistOTP").val();
    var txtProfileDate = $("#txtPerHistProfDate").val();

    /*Individual Health Profile*/
    var txtBirthProvince = $("#optPerHistPobProv option:selected").val();
    var txtBirthMun = $("#optPerHistPobMun option:selected").val();

    /*Start Get date today*/
    var dateToday = new Date();

    var compareProfDate = compareDates(dateToday,txtProfileDate);
    /*End Get date today*/

    /*Ob-gyne History*/
    var txtLastMens = $("#txtOBHistLastMens").val();

    /*Past Medical History*/
    var chkAllergy = $("#chkMedHistDiseases_001").is(":checked");
    var chkCancer = $("#chkMedHistDiseases_003").is(":checked");
    var chkHepatitis = $("#chkMedHistDiseases_009").is(":checked");
    var chkHypertension = $("#chkMedHistDiseases_011").is(":checked");
    var chkPTB = $("#chkMedHistDiseases_015").is(":checked");
    var chkExPTB = $("#chkMedHistDiseases_016").is(":checked");
    var chkOthers = $("#chkMedHistDiseases_998").is(":checked");

    var txtAllergy = $("#txtMedHistAllergy").val();
    var txtCancer = $("#txtMedHistCancer").val();
    var txtHepatitis = $("#txtMedHistHepatitis").val();
    var txtDiastolic = $("#txtMedHistBPDiastolic").val();
    var txtSystolic = $("#txtMedHistBPSystolic").val();
    var txtPTB = $("#txtMedHistPTB").val();
    var txtExPTB = $("#txtMedHistExPTB").val();
    var txaOthers = $("#txaMedHistOthers").val();

    /*Family & Personal History*/
    var chkAllergyFam = $("#chkFamHistDiseases_001").is(":checked");
    var chkCancerFam = $("#chkFamHistDiseases_003").is(":checked");
    var chkHepatitisFam = $("#chkFamHistDiseases_009").is(":checked");
    var chkHypertensionFam = $("#chkFamHistDiseases_011").is(":checked");
    var chkPTBfam = $("#chkFamHistDiseases_015").is(":checked");
    var chkExPTBfam = $("#chkFamHistDiseases_016").is(":checked");
    var chkOthersFam = $("#chkFamHistDiseases_998").is(":checked");

    var txtAllergyFam = $("#txtFamHistAllergy").val();
    var txtCancerFam = $("#txtFamHistCancer").val();
    var txtHepatitisFam = $("#txtFamHistHepatitis").val();
    var txtDiastolicFam = $("#txtFamHistBPDiastolic").val();
    var txtSystolicFam = $("#txtFamHistBPSystolic").val();
    var txtPTBfam = $("#txtFamHistPTB").val();
    var txtExPTBfam = $("#txtFamHistExPTB").val();
    var txaOthersFam = $("#txaFamHistOthers").val();

    /*Pertinent Physical Examination Findings*/
    var txtPhExSystolic = $("#txtPhExSystolic").val();
    var txtPhExBPDiastolic = $("#txtPhExBPDiastolic").val();
    var txtPhExHeartRate = $("#txtPhExHeartRate").val();
    var txtPhExRespiratoryRate = $("#txtPhExRespiratoryRate").val();
    var txtPhExHeightCm = $("#txtPhExHeightCm").val();
    var txtPhExWeightKg = $("#txtPhExWeightKg").val();
    var txtPhExTemp = $("#txtPhExTemp").val();
    var txtPhExVisualAcuityL = $("#txtPhExVisualAcuityL").val();
    var txtPhExVisualAcuityR = $("#txtPhExVisualAcuityR").val();

    if (txtProfileOTP == "") {
        alert("Authorization Transaction Code is required under PATIENT PROFILE menu");
        $("#txtPerHistOTP").focus();
        return false;
    }
    else if (compareProfDate == "" || compareProfDate == "0") {
        alert("Screening & Assessment Date is required and must be less than or equal to current date under PATIENT PROFILE menu");
        $("#txtPerHistProfDate").focus();
        return false;
    }
    else if(txtBirthProvince == "" && txtBirthMun == ""){
        alert("Please fill up all require fields in Individual Health Profile under PATIENT PROFILE menu");
        return false;
    }
    /*CHECK IF TEXTBOXES HAS VALUE IF CHECKED IN MEDICAL & SURGICAL HISTORY*/
    else if(chkAllergy == true && txtAllergy == "") {
        alert("Please specify allergy under MEDICAL & SURGICAL HISTORY menu.");
        return false;
    }
    else if(chkCancer == true && txtCancer == "") {
        alert("Please specify organ with cancer under MEDICAL & SURGICAL HISTORY menu.");
        $("#txtMedHistCancer").focus();
        return false;
    }
    else if(chkHepatitis == true && txtHepatitis == "") {
        alert("Please specify hepatitis type under MEDICAL & SURGICAL HISTORY menu.");
        $("#txtMedHistHepatitis").focus();
        return false;
    }
    else if(chkHypertension == true && (txtSystolic == "" || txtDiastolic == "")) {
        alert("Please specify highest blood pressure under MEDICAL & SURGICAL HISTORY menu.");
        if(txtSystolic == "") {
            $("#txtMedHistBPSystolic").focus();
        }
        else {
            $("#txtMedHistBPDiastolic").focus();
        }
        return false;
    }
    else if(chkPTB == true && txtPTB == "") {
        alert("Please specify Pulmonary Tuberculosis category under MEDICAL & SURGICAL HISTORY menu.");
        $("#txtMedHistPTB").focus();
        return false;
    }
    else if(chkExPTB == true && txtExPTB == "") {
        alert("Please specify Extrapulmonary Tuberculosis category under MEDICAL & SURGICAL HISTORY menu.");
        $("#txtMedHistExPTB").focus();
        return false;
    }
    else if(chkOthers == true && txaOthers == "") {
        alert("Please specify others under MEDICAL & SURGICAL HISTORY menu.");
        $("#txaMedHistOthers").focus();
        return false;
    }
    /*CHECK IF TEXTBOXES HAS VALUE IF CHECKED IN FAMILY & PERSONAL HISTORY*/
    else if(chkAllergyFam == true && txtAllergyFam == "") {
        alert("Please specify allergy under FAMILY & PERSONAL HISTORY menu.");
        return false;
    }
    else if(chkCancerFam == true && txtCancerFam == "") {
        alert("Please specify organ with cancer under FAMILY & PERSONAL HISTORY menu.");
        $("#txtFamHistCancer").focus();
        return false;
    }
    else if(chkHepatitisFam == true && txtHepatitisFam == "") {
        alert("Please specify hepatitis type under FAMILY & PERSONAL HISTORY menu.");
        $("#txtFamHistHepatitis").focus();
        return false;
    }
    else if(chkHypertensionFam == true && (txtSystolicFam == "" || txtDiastolicFam == "")) {
        alert("Please specify highest blood pressure under FAMILY & PERSONAL HISTORY menu.");
        if(txtSystolic == "") {
            $("#txtFamHistBPSystolic").focus();
        }
        else {
            $("#txtFamHistBPDiastolic").focus();
        }
        return false;
    }
    else if(chkPTBfam == true && txtPTBfam == "") {
        alert("Please specify Pulmonary Tuberculosis category under FAMILY & PERSONAL HISTORY menu.");
        $("#txtFamHistPTB").focus();
        return false;
    }
    else if(chkExPTBfam == true && txtExPTBfam == "") {
        alert("Please specify Extrapulmonary Tuberculosis category under FAMILY & PERSONAL HISTORY menu.");
        $("#txtFamHistExPTB").focus();
        return false;
    }
    else if(chkOthersFam == true && txaOthersFam == "") {
        alert("Please specify others.");
        $("#txaFamHistOthers").focus();
        return false;
    }
    else if(txtPhExSystolic == "" || txtPhExBPDiastolic == "" || txtPhExHeartRate == "" || txtPhExRespiratoryRate == "" || txtPhExHeightCm == "" || txtPhExWeightKg == "" || txtPhExTemp == "" || txtPhExVisualAcuityL == "" || txtPhExVisualAcuityL == ""){
        alert("Please fill up all required fields in PERTINENT PHYSICAL EXAMINATION FINDINGS!");
        return false;
    }
    else {
        //TO DO SAVING
        return confirm('Do you want to save it now and finalize later?');
    }
} /*END SAVE HSA TRANSACTION*/

function validateSoapForm() {
    var pSoapOTP = $("#pSoapOTP").val();
    var pSoapdate = $("#pSOAPDate").val();
    var pChiefComplaint = $("#pChiefComplaint").text();
    var pIcd = $("#pICD").val();
    var chksDiagnosis = document.getElementsByName('diagnosis[]');

    /*Start Get date today*/
    var dateToday = new Date();
    var dateSoapDate = new Date(pSoapdate);
    var compareSoapDate = compareDates(dateToday,dateSoapDate);
    /*End Get date today*/

    /*Objective/Physical Examination*/
    var txtPhExSystolic = $("#pe_bp_u").val();
    var txtPhExBPDiastolic = $("#pe_bp_l").val();
    var txtPhExHeartRate = $("#pe_hr").val();
    var txtPhExRespiratoryRate = $("#pe_rr").val();
    var txtPhExHeightCm = $("#pe_height_cm").val();
    var txtPhExWeightKg = $("#pe_weight_kg").val();
    var txtPhExTemp = $("#pe_temp").val();
    var txtPhExVisualAcuityL = $("#pe_visual_acuityL").val();
    var txtPhExVisualAcuityR = $("#pe_visual_acuityR").val();

    /*Labs*/
    var chkCBCdone = $("#diagnostic_1").is(":checked"); //done
    var chkUrinalysisDone = $("#diagnostic_2").is(":checked");//done
    var chkFecalysisDone = $("#diagnostic_3").is(":checked");//done
    var chkXrayDone = $("#diagnostic_4").is(":checked");//done
    var chkSputumDone = $("#diagnostic_5").is(":checked");//done
    var chkLipidDone = $("#diagnostic_6").is(":checked");//done
    var chkECGDone = $("#diagnostic_9").is(":checked");//done
    var chkPapsSmearDone = $("#diagnostic_13").is(":checked");//done
    var chkOGTTDone = $("#diagnostic_14").is(":checked");//done
    var chkFbsDone = $("#diagnostic_7").is(":checked");//done

    /*CBC*/
    var txtCbcLabDate = $("#diagnostic_1_lab_exam_date").val();
    var dateCbcDate = new Date(txtCbcLabDate);
    var compareCbcDate = compareDates(dateToday,dateCbcDate);
    var txtCbcLabFee = $("#diagnostic_1_lab_fee").val();
    var txtCbcHema = $("#diagnostic_1_hematocrit").val();
    var txtCbchemo = $("#diagnostic_1_hemoglobin_gdL").val();
    var txtCbcMhc = $("#diagnostic_1_mhc_pgcell").val();
    var txtCbcMchc= $("#diagnostic_1_mchc_gHbdL").val();
    var txtCbcMcv = $("#diagnostic_1_mcv_um").val();
    var txtCbcWbc = $("#diagnostic_1_wbc_cellsmmuL").val();
    var txtCbcMyelocyte = $("#diagnostic_1_myelocyte").val();
    var txtCbcNeutroBand = $("#diagnostic_1_neutrophils_bands").val();
    var txtCbcNeutroSeg = $("#diagnostic_1_neutrophils_segmenters").val();
    var txtCbcLymph = $("#diagnostic_1_lymphocytes").val();
    var txtCbcMono = $("#diagnostic_1_monocytes").val();
    var txtCbcEosi = $("#diagnostic_1_eosinophils").val();
    var txtCbcBaso = $("#diagnostic_1_basophils").val();
    var txtCbcPlatelet = $("#diagnostic_1_platelet").val();

    /*PAPS SMEAR*/
    var txtPapsLabDate = $("#diagnostic_13_lab_exam_date").val();
    var datePaps = new Date(txtPapsLabDate);
    var comparePapsDate = compareDates(dateToday,datePaps);
    var txtPapsLabFee = $("#diagnostic_13_lab_fee").val();
    var txtPapsFind = $("#diagnostic_13_papsSmearFindings").val();
    var txtPapsImpre = $("#diagnostic_13_papsSmearImpression").val();

    /*OGTT*/
    var txtOgttLabDate = $("#diagnostic_14_lab_exam_date").val();
    var dateOgtt = new Date(txtOgttLabDate);
    var compareOgttDate = compareDates(dateToday,dateOgtt);
    var txtOgttLabFee = $("#diagnostic_14_lab_fee").val();
    var txtOgttFastMg = $("#diagnostic_14_fasting_mg").val();
    var txtOgttFastMmol = $("#diagnostic_14_fasting_mmol").val();
    var txtOgttOneMg = $("#diagnostic_14_oneHr_mg").val();
    var txtOgttOneMmol = $("#diagnostic_14_oneHr_mmol").val();
    var txtOgttTwoMg = $("#diagnostic_14_twoHr_mg").val();
    var txtOgttTwoMmol = $("#diagnostic_14_twoHr_mmol").val();

    /*URINALYSIS*/
    var txtUrineLabDate = $("#diagnostic_2_lab_exam_date").val();
    var dateUrine = new Date(txtUrineLabDate);
    var compareUrineDate = compareDates(dateToday,dateUrine);
    var txtUrineLabFee = $("#diagnostic_2_lab_fee").val();
    var txtUrineSg = $("#diagnostic_2_sg").val();
    var txtUrineAppear = $("#diagnostic_2_appearance").val();
    var txtUrineColor = $("#diagnostic_2_color").val();
    var txtUrineGlucose = $("#diagnostic_2_glucose").val();
    var txtUrineProtein = $("#diagnostic_2_proteins").val();
    var txtUrineKetones = $("#diagnostic_2_ketones").val();
    var txtUrinePh = $("#diagnostic_2_pH").val();
    var txtUrinePus = $("#diagnostic_2_pus").val();
    var txtUrineAlb = $("#diagnostic_2_alb").val();
    var txtUrineRbc = $("#diagnostic_2_rbc").val();
    var txtUrineWbc = $("#diagnostic_2_wbc").val();
    var txtUrineBact = $("#diagnostic_2_bacteria").val();
    var txtUrineCryst = $("#diagnostic_2_crystals").val();
    var txtUrineBlad = $("#diagnostic_2_bladder_cells").val();
    var txtUrineSqCell= $("#diagnostic_2_squamous_cells").val();
    var txtUrineTubCell = $("#diagnostic_2_tubular_cells").val();
    var txtUrineBrCast = $("#diagnostic_2_broad_casts").val();
    var txtUrineCellCast = $("#diagnostic_2_epithelial_cell_casts").val();
    var txtUrineGranCast = $("#diagnostic_2_granular_casts").val();
    var txtUrineHyaCast = $("#diagnostic_2_hyaline_casts").val();
    var txtUrineRbcCast = $("#diagnostic_2_rbc_casts").val();
    var txtUrineWaxyCast = $("#diagnostic_2_waxy_casts").val();
    var txtUrineWcCast = $("#diagnostic_2_wc_casts").val();

    /*FECALYSIS*/
    var txtFecaLabDate = $("#diagnostic_3_lab_exam_date").val();
    var dateFeca = new Date(txtFecaLabDate);
    var compareFecaDate = compareDates(dateToday,dateFeca);
    var txtFecaLabFee = $("#diagnostic_3_lab_fee").val();
    var txtFecaPus = $("#diagnostic_3_pus").val();
    var txtFecaRbc = $("#diagnostic_3_rbc").val();
    var txtFecaWbc = $("#diagnostic_3_wbc").val();
    var txtFecaOva = $("#diagnostic_3_ova").val();
    var txtFecaPara = $("#diagnostic_3_parasite").val();
    var txtFecaOccult = $("#diagnostic_3_occult_blood").val();

    /*CHEST X-RAY*/
    var txtXrayLabDate = $("#diagnostic_4_lab_exam_date").val();
    var dateXray = new Date(txtXrayLabDate);
    var compareXrayDate = compareDates(dateToday,dateXray);
    var txtXrayLabFee = $("#diagnostic_4_lab_fee").val();
    var txtXrayFindings = $("#diagnostic_4_chest_findings option:selected").val();

    /*SPUTUM MICROSCOPY*/
    var txtSputumLabDate = $("#diagnostic_5_lab_exam_date").val();
    var dateSputum = new Date(txtSputumLabDate);
    var compareSputumDate = compareDates(dateToday,dateSputum);
    var txtSputumLabFee = $("#diagnostic_5_lab_fee").val();
    var txtSputumPlusses = $("#diagnostic_5_plusses").val();

    /*LIPID PROFILE*/
    var txtLipidLabDate = $("#diagnostic_6_lab_exam_date").val();
    var dateLipid = new Date(txtLipidLabDate);
    var compareLipidDate = compareDates(dateToday,dateLipid);
    var txtLipidLabFee = $("#diagnostic_6_lab_fee").val();
    var txtLipidTotal = $("#diagnostic_6_total").val();
    var txtLipidLdl = $("#diagnostic_6_ldl").val();
    var txtLipidHdl = $("#diagnostic_6_hdl").val();
    var txtLipidChol = $("#diagnostic_6_cholesterol").val();
    var txtLipidTrigy = $("#diagnostic_6_triglycerides").val();

    /*ECG*/
    var txtEcgLabDate = $("#diagnostic_9_lab_exam_date").val();
    var dateEcg = new Date(txtEcgLabDate);
    var compareEcgDate = compareDates(dateToday,dateEcg);
    var txtEcgLabFee = $("#diagnostic_9_lab_fee").val();
    var chkEcgNormal = $("#diagnostic_9_no").is(":checked");
    var chkEcgNotnNormal = $("#diagnostic_9_yes").is(":checked");
    var remEcgFindings = $("#diagnostic_9_ecg_remarks").val();

    /*START CONSULTATION ONLY*/
    /*FBS*/
    var txtFbsLabDate = $("#diagnostic_7_lab_exam_date").val();
    var dateFbs = new Date(txtFbsLabDate);
    var compareFbsDate = compareDates(dateToday,dateFbs);
    var txtFbsLabFee = $("#diagnostic_7_lab_fee").val();
    var txtFbsGlucoseMgdl = $("#diagnostic_7_glucose_mgdL").val();
    var txtFbsGlucoseMmol = $("#diagnostic_7_glucose_mmolL").val();
    /*END CONSULTATION ONLY*/

    if (pSoapOTP == "") {
        alert("Authorization Transaction Code is required!");
        return false;
    }
    else if (pSoapdate == "" &&  pChiefComplaint == "") {
        alert("Fill up all the required fields in SUBJECTIVE/ HISTORY OF ILLNESS");
        return false;
    }
    else if (compareSoapDate == "0") {
        alert("Consultation Date is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(validateChecksChiefComplaint() == false){
        alert("Choose at least one CHIEF COMPLAINT in SUBJECTIVE/HISTORY OF ILLNESS");
        return false;
    }
    else if(pIcd == ""){
        alert("Fill up all the required fields in ASSESSMENT/DIAGNOSIS");
        return false;
    }
    else if(txtPhExSystolic == "" && txtPhExBPDiastolic == "" && txtPhExHeartRate == "" && txtPhExRespiratoryRate == "" && txtPhExHeightCm == "" && txtPhExWeightKg == "" && txtPhExTemp == "" && txtPhExVisualAcuityL == "" && txtPhExVisualAcuityR == ""){
        alert("Fill up all the required fields in OBJECTIVE/PHYSICAL EXAMINATION");
        return false;
    }
    else if(validateChecksHeent() == false){
        alert("Choose at least one HEENT in PERTINENT FINDINGS PER SYSTEM of OBJECTIVE/PHYSICAL EXAMINATION");
        return false;
    }
    else if(validateChecksChest() == false){
        alert("Choose at least one CHEST/BREAST/LUNGS in PERTINENT FINDINGS PER SYSTEM of OBJECTIVE/PHYSICAL EXAMINATION");
        return false;
    }
    else if(validateChecksHeart() == false){
        alert("Choose at least one HEART in PERTINENT FINDINGS PER SYSTEM of OBJECTIVE/PHYSICAL EXAMINATION");
        return false;
    }
    else if(validateChecksAbdomen() == false){
        alert("Choose at least one ABDOMEN in PERTINENT FINDINGS PER SYSTEM of OBJECTIVE/PHYSICAL EXAMINATION");
        return false;
    }
    else if(validateChecksGenitoUrinary() == false){
        alert("Choose at least one GENITOURINARY in PERTINENT FINDINGS PER SYSTEM of OBJECTIVE/PHYSICAL EXAMINATION");
        return false;
    }
    else if(validateChecksRectal() == false){
        alert("Choose at least one DIGITAL RECTAL EXAMINATION in PERTINENT FINDINGS PER SYSTEM of OBJECTIVE/PHYSICAL EXAMINATION");
        return false;
    }
    else if(validateChecksSkin() == false){
        alert("Choose at least one SKIN/EXTREMITIES in PERTINENT FINDINGS PER SYSTEM of OBJECTIVE/PHYSICAL EXAMINATION");
        return false;
    }
    else if(validateChecksNeuro() == false){
        alert("Choose at least one NEUROLOGICAL EXAMINATION in PERTINENT FINDINGS PER SYSTEM of OBJECTIVE/PHYSICAL EXAMINATION");
        return false;
    }
    else if(validateChecksPlan() == false){
        if(document.getElementById('diagnostic_NA').checked == false && document.getElementById('management_NA').checked == false ){
            alert("Fill up all the required fields in PLAN/MANAGEMENT");
            return false;
        }
    }
    else if(chkCBCdone == true && txtCbcLabDate == "" && txtCbcLabFee == "" && txtCbcHema == "" && txtCbchemo == "" && txtCbcMhc == "" && txtCbcMchc == "" && txtCbcMcv == "" && txtCbcWbc == "" && txtCbcMyelocyte == "" && txtCbcNeutroBand == "" && txtCbcNeutroSeg == "" && txtCbcLymph == "" && txtCbcMono == "" && txtCbcEosi == "" && txtCbcBaso == "" && txtCbcPlatelet == ""){
        alert("Fill up all required fields of CBC in LABORATORY RESULTS!");
        return false;
    }
    else if(compareCbcDate == "0"){
        alert("Laboratory Date of CBC is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkPapsSmearDone == true && txtPapsLabDate == "" && txtPapsLabFee == "" && txtPapsFind == "" && txtPapsImpre == ""){
        alert("Fill up all required fields of Paps Smear in LABORATORY RESULTS!");
        return false;
    }
    else if(comparePapsDate == "0"){
        alert("Laboratory Date of Paps Smear is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkOGTTDone == true && txtOgttLabDate == "" && txtOgttLabFee == "" && txtOgttFastMg == "" && txtOgttFastMmol == "" && txtOgttOneMg == "" && txtOgttOneMmol == "" && txtOgttTwoMg == ""  && txtOgttTwoMmol == ""){
        alert("Fill up all required fields of Oral Glucose Tolerance Test (OGTT) in LABORATORY RESULTS!");
        return false;
    }
    else if(compareOgttDate == "0"){
        alert("Laboratory Date of OGTT is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkUrinalysisDone == true && txtUrineLabDate == "" && txtUrineLabFee == "" && txtUrineSg == "" && txtUrineAppear == "" && txtUrineColor == "" && txtUrineGlucose == "" && txtUrineProtein == "" &&
        txtUrineKetones == "" && txtUrinePh == "" && txtUrinePus == "" && txtUrineAlb == "" && txtUrineRbc == "" && txtUrineWbc == "" && txtUrineBact == "" && txtUrineCryst == "" && txtUrineBlad == "" &&
        txtUrineSqCell == "" && txtUrineTubCell == "" && txtUrineBrCast == "" && txtUrineCellCast == "" && txtUrineGranCast == "" && txtUrineHyaCast == "" && txtUrineRbcCast == "" && txtUrineWaxyCast == "" && txtUrineWcCast == ""){
        alert("Fill up all required fields of Urinalysis in LABORATORY RESULTS!");
        return false;
    }
    else if(compareUrineDate == "0"){
        alert("Laboratory Date of Urinalysis is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkFecalysisDone == true && txtFecaLabDate == "" && txtFecaLabFee == "" && txtFecaPus == "" && txtFecaRbc == "" && txtFecaWbc == "" && txtFecaOva == "" && txtFecaPara == "" && txtFecaOccult == ""){
        alert("Fill up all required fields of Fecalysis in LABORATORY RESULTS!");
        return false;
    }
    else if(compareFecaDate == "0"){
        alert("Laboratory Date of Fecalysis is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkXrayDone == true && txtXrayLabDate == "" && txtXrayLabFee == "" && txtXrayFindings == ""){
        alert("Fill up all required fields of Chest X-ray in LABORATORY RESULTS!");
        return false;
    }
    else if(compareXrayDate == "0"){
        alert("Laboratory Date of Chest X-ray is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkSputumDone == true && txtSputumLabDate == "" && txtSputumLabFee == "" && txtSputumPlusses == ""){
        alert("Fill up all required fields of Sputum Microscopy in LABORATORY RESULTS!");
        return false;
    }
    else if(compareSputumDate == "0"){
        alert("Laboratory Date of Sputum Microscopy is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkLipidDone == true && txtLipidLabDate == "" && txtLipidLabFee == "" && txtLipidTotal == "" && txtLipidLdl == "" && txtLipidHdl == "" && txtLipidChol == "" && txtLipidTrigy == ""){
        alert("Fill up all required fields of Lipid Profile in LABORATORY RESULTS!");
        return false;
    }
    else if(compareLipidDate == "0"){
        alert("Laboratory Date of Lipid Profile is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkECGDone == true && txtEcgLabDate == "" && txtEcgLabFee == "" && chkEcgNormal == false && chkEcgNotnNormal == false){
        alert("Fill up all required fields of Electrocardiogram (ECG) in LABORATORY RESULTS!");
        return false;
    }
    else if(compareEcgDate == "0"){
        alert("Laboratory Date of ECG is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(chkFbsDone == true && txtFbsLabDate == "" && txtFbsLabFee == "" && txtFbsGlucoseMgdl == "" && txtFbsGlucoseMmol == ""){
        alert("Fill up all required fields of Fasting Blood Sugar (FBS) in LABORATORY RESULTS!");
        return false;
    }
    else if(compareFbsDate == "0"){
        alert("Laboratory Date of FBS is invalid! It should be less than or equal to current day.");
        return false;
    }
    else{
        return confirm('Are all information encoded correctly? Click OK to Submit now.');
    }
}

function validateFollowupMeds() {
    var pSoapOTP = $("#pSoapOTP").val();
    var pPrescDoctor = $("#pPrescDoctor").val();
    var pSoapDate = $("#pSOAPDate").val();

    var dateToday = new Date();
    var dateSoapDate = new Date(pSoapdate);
    var compareSoapDate = compareDates(dateToday,dateSoapDate);

    if (pSoapOTP == "") {
        alert("Authorization Transaction Code is required!");
        return false;
    }
    else if(pSoapDate == ""){
        alert("Consultation Date is required.");
        return false;
    }
    else if(pSoapDate == "0"){
        alert("Consultation Date is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(pPrescDoctor == ""){
        alert("Please input at least one medicine for follow-up.");
        return false;
    }
    else{
        return confirm('Do you want to submit it now?');
    }
}

function validateChecksSignsSymptomsCf4() {
    var chksChief = document.getElementsByName('pCf4Symptoms[]');
    var checkCountChief = 0;

    for (var i = 0; i < chksChief.length; i++) {
        if (chksChief[i].checked) {
            checkCountChief++;
        }
    }
    if ( checkCountChief < 1) {
        return false;
    }
    return true;
}

function validateChecksHeent() {
    var chksValue = document.getElementsByName('heent[]');
    var checkCountValue = 0;

    for (var i = 0; i < chksValue.length; i++) {
        if (chksValue[i].checked) {
            checkCountValue++;
        }
    }
    if ( checkCountValue < 1) {
        return false;
    }
    return true;
}

function validateChecksChest() {
    var chksValue = document.getElementsByName('chest[]');
    var checkCountValue = 0;

    for (var i = 0; i < chksValue.length; i++) {
        if (chksValue[i].checked) {
            checkCountValue++;
        }
    }
    if ( checkCountValue < 1) {
        return false;
    }
    return true;
}

function validateChecksHeart() {
    var chksValue = document.getElementsByName('heart[]');
    var checkCountValue = 0;

    for (var i = 0; i < chksValue.length; i++) {
        if (chksValue[i].checked) {
            checkCountValue++;
        }
    }
    if ( checkCountValue < 1) {
        return false;
    }
    return true;
}

function validateChecksAbdomen() {
    var chksValue = document.getElementsByName('abdomen[]');
    var checkCountValue = 0;

    for (var i = 0; i < chksValue.length; i++) {
        if (chksValue[i].checked) {
            checkCountValue++;
        }
    }
    if ( checkCountValue < 1) {
        return false;
    }
    return true;
}

function validateChecksGenitoUrinary() {
    var chksValue = document.getElementsByName('genitourinary[]');
    var checkCountValue = 0;

    for (var i = 0; i < chksValue.length; i++) {
        if (chksValue[i].checked) {
            checkCountValue++;
        }
    }
    if ( checkCountValue < 1) {
        return false;
    }
    return true;
}

function validateChecksRectal() {
    var chksValue = document.getElementsByName('rectal[]');
    var checkCountValue = 0;

    for (var i = 0; i < chksValue.length; i++) {
        if (chksValue[i].checked) {
            checkCountValue++;
        }
    }
    if ( checkCountValue < 1) {
        return false;
    }
    return true;
}

function validateChecksSkin() {
    var chksValue = document.getElementsByName('skinExtremities[]');
    var checkCountValue = 0;

    for (var i = 0; i < chksValue.length; i++) {
        if (chksValue[i].checked) {
            checkCountValue++;
        }
    }
    if ( checkCountValue < 1) {
        return false;
    }
    return true;
}

function validateChecksNeuro() {
    var chksValue = document.getElementsByName('neuro[]');
    var checkCountValue = 0;

    for (var i = 0; i < chksValue.length; i++) {
        if (chksValue[i].checked) {
            checkCountValue++;
        }
    }
    if ( checkCountValue < 1) {
        return false;
    }
    return true;
}

function validateChecksMedsHist() {
    var chksMedsHist = document.getElementsByName('chkMedHistDiseases[]');
    var checkCountMedsHist = 0;

    for (var i = 0; i < chksMedsHist.length; i++) {
        if (chksMedsHist[i].checked) {
            checkCountMedsHist++;
        }
    }

    if (checkCountMedsHist < 1) {
        return false;
    }
    return true;
}

function validateChecksFamHist() {
    var chksFamHist = document.getElementsByName('chkFamHistDiseases[]');
    var checkCountFamHist = 0;

    for (var i = 0; i < chksFamHist.length; i++) {
        if (chksFamHist[i].checked) {
            checkCountFamHist++;
        }
    }

    if (checkCountFamHist < 1) {
        return false;
    }
    return true;
}

function validateChecksImmune() {
    var chksImmChild = document.getElementsByName('chkImmChild[]');
    var checkCountImmChild = 0;
    var chksImmAdult = document.getElementsByName('chkImmAdult[]');
    var checkCountImmAdult = 0;
    var chksImmPreg = document.getElementsByName('chkImmPregnant[]');
    var checkCountImmPreg = 0;
    var chksImmElder = document.getElementsByName('chkImmElderly[]');
    var checkCountImmElder = 0;

    for (var i = 0; i < chksImmChild.length; i++) {
        if (chksImmChild[i].checked) {
            checkCountImmChild++;
        }
    }
    for (var i = 0; i < chksImmAdult.length; i++) {
        if (chksImmAdult[i].checked) {
            checkCountImmAdult++;
        }
    }
    for (var i = 0; i < chksImmElder.length; i++) {
        if (chksImmElder[i].checked) {
            checkCountImmElder++;
        }
    }
    for (var i = 0; i < chksImmPreg.length; i++) {
        if (chksImmPreg[i].checked) {
            checkCountImmPreg++;
        }
    }
    if ( checkCountImmChild < 1 && checkCountImmAdult < 1 && checkCountImmElder < 1 && checkCountImmPreg < 1) {
        return false;
    }
    return true;
}

function validateChecksPlan() {
    var chksDiag = document.getElementsByName('diagnostic[]');
    var checkCountDiag = 0;
    var chksMgmt = document.getElementsByName('management[]');
    var checkCountMgmt = 0;
    for (var i = 0; i < chksDiag.length; i++) {
        if (chksDiag[i].checked) {
            checkCountDiag++;
        }
    }
    for (var i = 0; i < chksMgmt.length; i++) {
        if (chksMgmt[i].checked) {
            checkCountMgmt++;
        }
    }
    if ( checkCountDiag < 1 && checkCountMgmt < 1) {
        return false;
    }
    return true;
}

function enDisFamHistSmoking(selected_val) {
    if(selected_val == "Y" || selected_val == "X") {
        $("#txtFamHistCigPk").attr("disabled",false);
        $("#txtFamHistCigPk").val("");
    }
    else {
        $("#txtFamHistCigPk").attr("disabled",true);
        $("#txtFamHistCigPk").val("");
    }
}

function enDisFamHistAlcohol(selected_val) {
    if(selected_val == "Y" || selected_val == "X") {
        $("#txtFamHistBottles").attr("disabled",false);
        $("#txtFamHistBottles").val("");
    }
    else {
        $("#txtFamHistBottles").attr("disabled",true);
        $("#txtFamHistBottles").val("");
    }
}
/*Disabled fields in Menstrual History*/
function disMenstrualHist(){
    $("#txtOBHistMenarche").attr("disabled",true);
    $("#txtOBHistLastMens").attr("disabled",true);
    $("#txtOBHistPeriodDuration").attr("disabled",true);
    $("#txtOBHistPadsPerDay").attr("disabled",true);
    $("#txtOBHistOnsetSexInt").attr("disabled",true);
    $("#txtOBHistBirthControl").attr("disabled",true);
    $("#txtOBHistInterval").attr("disabled",true);
    $("#radOBHistMenopauseN").attr("disabled",true);
    $("#txtOBHistMenopauseAge").attr("disabled",true);
}
/*Enabled fields in Menstrual History*/
function enMenstrualHist(){
    $("#txtOBHistMenarche").attr("disabled",false);
    $("#txtOBHistLastMens").attr("disabled",false);
    $("#txtOBHistPeriodDuration").attr("disabled",false);
    $("#txtOBHistPadsPerDay").attr("disabled",false);
    $("#txtOBHistOnsetSexInt").attr("disabled",false);
    $("#txtOBHistBirthControl").attr("disabled",false);
    $("#txtOBHistInterval").attr("disabled",false);
    $("#radOBHistMenopauseN").attr("disabled",false);

    var chkMenoY = $("#radOBHistMenopauseY").is(":checked");
    if(chkMenoY == true){
        $("#txtOBHistMenopauseAge").attr("disabled",false);
    }else{
        $("#txtOBHistMenopauseAge").attr("disabled",true);
    }
}

/*Disabled fields in Pregnancy History*/
function disPregHist(){
    $("#txtOBHistGravity").attr("disabled",true);
    $("#txtOBHistParity").attr("disabled",true);
    $("#optOBHistDelivery").attr("disabled",true);
    $("#txtOBHistFullTerm").attr("disabled",true);
    $("#txtOBHistPremature").attr("disabled",true);
    $("#txtOBHistAbortion").attr("disabled",true);
    $("#txtOBHistLivingChildren").attr("disabled",true);
}

/*Enabled fields in Pregnancy History*/
function enPregHist(){
    $("#txtOBHistGravity").attr("disabled",false);
    $("#txtOBHistParity").attr("disabled",false);
    $("#optOBHistDelivery").attr("disabled",false);
    $("#txtOBHistFullTerm").attr("disabled",false);
    $("#txtOBHistPremature").attr("disabled",false);
    $("#txtOBHistAbortion").attr("disabled",false);
    $("#txtOBHistLivingChildren").attr("disabled",false);
}

/*Disabled fields in Paps Smear Labs*/
function disLabsPapsSmear(){
    $("#diagnostic_13_lab_exam_date").attr("disabled",true);
    $("#diagnostic_13_lab_fee").attr("disabled",true);
    $("#diagnostic_13_papsSmearFindings").attr("disabled",true);
    $("#diagnostic_13_papsSmearImpression").attr("disabled",true);
    $("#diagnostic_13_copay").attr("disabled",true);
}

/*Enabled fields in Paps Smear Labs*/
function enLabsPapsSmear(){
    $("#diagnostic_13_lab_exam_date").attr("disabled",false);
    $("#diagnostic_13_lab_fee").attr("disabled",false);
    $("#diagnostic_13_papsSmearFindings").attr("disabled",false);
    $("#diagnostic_13_papsSmearImpression").attr("disabled",false);
    $("#diagnostic_13_copay").attr("readonly",true);
    $("#diagnostic_13_copay").attr("disabled",false);
}

/*Disabled fields in OGTT Labs*/
function disLabsOgtt(){
    $("#diagnostic_14_lab_exam_date").attr("disabled",true);
    $("#diagnostic_14_lab_fee").attr("disabled",true);
    $("#diagnostic_14_fasting_mg").attr("disabled",true);
    $("#diagnostic_14_fasting_mmol").attr("disabled",true);
    $("#diagnostic_14_oneHr_mg").attr("disabled",true);
    $("#diagnostic_14_oneHr_mmol").attr("disabled",true);
    $("#diagnostic_14_twoHr_mg").attr("disabled",true);
    $("#diagnostic_14_twoHr_mmol").attr("disabled",true);
    $("#diagnostic_14_copay").attr("disabled",true);
}
function enLabsOgtt(){
    $("#diagnostic_14_lab_exam_date").attr("disabled",false);
    $("#diagnostic_14_lab_fee").attr("disabled",false);
    $("#diagnostic_14_fasting_mg").attr("disabled",false);
    $("#diagnostic_14_fasting_mmol").attr("disabled",false);
    $("#diagnostic_14_oneHr_mg").attr("disabled",false);
    $("#diagnostic_14_oneHr_mmol").attr("disabled",false);
    $("#diagnostic_14_twoHr_mg").attr("disabled",false);
    $("#diagnostic_14_twoHr_mmol").attr("disabled",false);
    $("#diagnostic_14_copay").attr("disabled",false);
    $("#diagnostic_14_copay").attr("readonly",true);
}


/*Disabled fields in Sputum Microscopy (1) Labs*/
function disLabsSputum_1(){
    $("#diagnostic_5_lab_exam_date").attr("disabled",true);
    $("#diagnostic_5_lab_fee").attr("disabled",true);
    $("#diagnostic_5_copay").attr("disabled",true);
    $("#diagnostic_5_no").attr("disabled",true);
    $("#diagnostic_5_yes").attr("disabled",true);
    $("#diagnostic_5_sputum_remarks").attr("disabled",true);
    $("#diagnostic_5_plusses").attr("disabled",true);
}

/*Enabled fields in Sputum Microscopy (1) Labs*/
function enLabsSputum_1(){
    $("#diagnostic_5_lab_exam_date").attr("disabled",false);
    $("#diagnostic_5_lab_fee").attr("disabled",false);
    $("#diagnostic_5_no").attr("disabled",false);
    $("#diagnostic_5_yes").attr("disabled",false);
    $("#diagnostic_5_sputum_remarks").attr("disabled",false);
    $("#diagnostic_5_plusses").attr("disabled",false);
    $("#diagnostic_5_copay").attr("readonly",true);
    $("#diagnostic_5_copay").attr("disabled",false);
}

function enDisOBHistMenopause(selected_val) {
    if(selected_val == "Y" || selected_val == "X") {
        $("#txtOBHistMenopauseAge").attr("disabled",false);
        $("#txtOBHistMenopauseAge").val("");
    }
    else {
        $("#txtOBHistMenopauseAge").attr("disabled",true);
        $("#txtOBHistMenopauseAge").val("");
    }
}

function chkNA(){
    if($('[name="Q17"]').checked == '3'){
        alert('not applicable');
        var $success=false;
    }
    else{
        var $success=true;
    }
    return $success;
}
/*END HSA MODULE*/

function enableDependentTypeMemInfo() {
    value = $( "#pPatientType" ).val();
    if(value == 'DD'){
        $("#pDependentType").attr("disabled",false);
        $("#pPatientPIN").attr("readonly",false);
        $("#pWithDisability").attr("disabled",false);
    } else{
        $("#pDependentType").attr("disabled",true);
        $("#pPatientPIN").attr("readonly",false);
        $("#pWithDisability").attr("disabled",true);
    }

    if(value == 'NM') {
        $("#pPatientPIN").attr("readonly",true);
    } else{
        $("#pPatientPIN").attr("readonly",false);
    }

    if(value == 'MM'){
        $("#pMemberPIN").attr("readonly",true);
        $("#pMemberLastName").attr("readonly",true);
        $("#pMemberFirstName").attr("readonly",true);
        $("#pMemberMiddleName").attr("readonly",true);
        $("#pMemberSuffix").attr("readonly",true);
        $("#pMemberDateOfBirth").attr("disabled",true);
        $("#pMemberSex").attr("disabled",true);
    }
    else if(value == 'NM'){
        $("#pMemberPIN").attr("readonly",true);
        $("#pMemberLastName").attr("readonly",true);
        $("#pMemberFirstName").attr("readonly",true);
        $("#pMemberMiddleName").attr("readonly",true);
        $("#pMemberSuffix").attr("readonly",true);
        $("#pMemberDateOfBirth").attr("disabled",true);
        $("#pMemberSex").attr("disabled",true);
    }
    else{
        $("#pMemberPIN").attr("readonly",false);
        $("#pMemberLastName").attr("readonly",false);
        $("#pMemberFirstName").attr("readonly",false);
        $("#pMemberMiddleName").attr("readonly",false);
        $("#pMemberSuffix").attr("readonly",false);
        $("#pMemberDateOfBirth").attr("disabled",false);
        $("#pMemberSex").attr("disabled",false);
    }
}

function selectCivilStatus(value){
    if(value == 'S'){
        $("#pPatientCivilStatusX option:selected").val('M');
        $("#pPatientCivilStatusX option:selected").text('MARRIED');
        $("#pPatientCivilStatusX option:disabled").removeAttr('disabled');
        $("#pPatientCivilStatusX option[value='S']").attr('disabled', true);
        $("#pPatientCivilStatusX option[value='W']").attr('disabled', true);
        $("#pPatientCivilStatusX option[value='X']").attr('disabled', true);
        $("#pPatientCivilStatusX option[value='A']").attr('disabled', true);
    }
    else if(value == 'C'){
        $("#pPatientCivilStatusX option:selected").val('S');
        $("#pPatientCivilStatusX option:selected").text('SINGLE');
        $("#pPatientCivilStatusX option:disabled").removeAttr('disabled');
        $("#pPatientCivilStatusX option[value='M']").attr('disabled', true);
        $("#pPatientCivilStatusX option[value='W']").attr('disabled', true);
        $("#pPatientCivilStatusX option[value='X']").attr('disabled', true);
        $("#pPatientCivilStatusX option[value='A']").attr('disabled', true);
    }
    else{
        $("#pPatientCivilStatusX option:selected").val('');
        $("#pPatientCivilStatusX option:selected").text('');
        $("#pPatientCivilStatusX option[value='S']").attr('disabled', false);
        $("#pPatientCivilStatusX option[value='M']").attr('disabled', false);
        $("#pPatientCivilStatusX option[value='W']").attr('disabled', false);
        $("#pPatientCivilStatusX option[value='X']").attr('disabled', false);
        $("#pPatientCivilStatusX option[value='A']").attr('disabled', false);
    }
}


function saveTransRegistration() {
    var txtPxSex = $("#pPatientSexX option:selected").val();
    var txtMmSex = $("#pMemberSex option:selected").val();
    var txtDdType = $("#pDependentType option:selected").val();
    var txtPxCivilStat = $("#pPatientCivilStatusX option:selected").val();
    var txtPxDoB = $("#pPatientDateOfBirth").val();
    var txtEnlistDate = $("#pEnlistmentDate").val();
    var txtMmDoB = $("#pMemberDateOfBirth").val();

    var dateToday = new Date();
    var datePxDoB = new Date(txtPxDoB);
    var dateRegDate = new Date(txtEnlistDate);
    var dateMemDoB = new Date(txtMmDoB);

    var regDateYear = dateRegDate.getYear();

    var comparePxDoB = compareDates(dateToday,datePxDoB);
    var compareRegDate = compareDates(dateToday,dateRegDate);
    var compareMemDoB = compareDates(dateToday,dateMemDoB);

    if (txtPxSex == "") {
        alert("Patient's Sex is required!");
        $("#pPatientSexX").focus();
        return false;
    }
    else if(txtPxCivilStat == ""){
        alert("Patient's Civil Status is required!");
        $("#pPatientCivilStatusX").focus();
        return false;
    }
    else if(txtDdType == 'S' && txtPxSex == txtMmSex){
        alert("Dependent Type is SPOUSE. Patient's Sex should not equal to Member's Sex!");
        return false;
    }
    else if(regDateYear <= 116){
        alert("Date of Encounter is invalid! Year should be greater than or equal to year 2017");
        return false;
    }
    else if(compareRegDate == "0"){
        alert("Date of Encounter is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(comparePxDoB == "0"){
        alert("Patient's Date of Birth is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(compareMemDoB == "0"){
        alert("Member's Date of Birth is invalid! It should be less than or equal to current day.");
        return false;
    }
    else {
        //TO DO SAVING
        return confirm('Do you want to register this patient?');
    }

}

 function compareDates(dateToday,date2){
    if (dateToday>date2) return ("1");
    else if (dateToday<date2) return ("0");
    else return ("-");
}

function validateHciForm() {
    var pUserPass = $("#pUserPassword").val();
    var pUserConfirmPass = $("#pUserConfirmPassword").val();
    var pAccreNo = $("#pAccreNo").val();
    var pUserId = $("#pUserId").val();
    var pCKey = $("#pHciKey").val();
    var pUserDoB = $("#pUserDoB").val();

    var dateToday = new Date();
    var dateUserDoB = new Date(pUserDoB);
    var compareUserDoB = compareDates(dateToday,dateUserDoB);


    if (pUserPass != pUserConfirmPass) {
        alert("Password do not match!");
        return false;
    }
    else if(pAccreNo == ""){
        alert("Accreditation Number required!");
        return false;
    }
    else if(pUserId.length() > 5){
        alert("User ID must be minimum of 6 characters!");
        return false;
    }
    else if(pUserPass.length() > 5){
        alert("User Password must be minimum of 6 characters!");
        return false;
    }
    else if(pAccreNo.length() > 8){
        alert("Accreditation Number must be minimum of 9 characters!");
        return false;
    }
    else if(pCKey.length() > 9){
        alert("Accreditation Number must be minimum of 10 characters!");
        return false;
    }
    else if(compareUserDoB == "0"){
        alert("Date of Birth is invalid! It should be less than or equal to current day.");
        return false;
    }
    else{
        return confirm('Are all information encoded correctly? Click OK to Submit now.');
    }
}


/*CF4*/
function showTab(id){
    if(id == 'tab9') {
        var dateToday = new Date();
        var txtCF4TransNo = $("#txtPerTransmittalNo").val();
        var txtCF4ClaimId = $("#txtPerClaimId").val();
        /*Individual Health Profile*/
        var txtPxPin = $("#txtPerPatPIN").val();
        var txtMemLname = $("#txtPerPatLname").val();
        var txtMemFname = $("#txtPerPatFname").val();
        var txtPxSex = $("#txtPerPatSex option:selected").val();
        var txtPxCivilStatus = $("#txtPerPatStatus option:selected").val();
        var txtPxType = $("#txtPerPatType option:selected").val();
        var txtPxDoB = $("#txtPerPatBirthday").val();
        var datePxDoB= new Date(txtPxDoB);
        var comparePxDoB = compareDates(dateToday,datePxDoB);

        if (txtCF4TransNo == "" || txtCF4ClaimId == "" || txtPxPin == "" || txtMemLname == ""  || txtMemFname == "" || txtPxSex == "" || txtPxCivilStatus == "" || txtPxType == "") {
            alert("Please fill up all required fields in PATIENT PROFILE");
            return false;
        }
        else if (txtPxPin.length < 12) {
            alert("Input 12 numbers of Patient's PIN");
            return false;
        }
        else if(comparePxDoB == "0"){
            alert("Date of Birth in PATIENT PROFILE is invalid! It should be less than or equal to current day.");
            return false;
        }
        else {
            $("#list1").removeClass("active");
            $("#tab1").removeClass("active");
            $("#tab9").addClass("active in");
            $("#list9").addClass("active");
        }
    }
    if(id == 'tab2') {
        var txtComplaint = $("#pChiefComplaint").val();
        if(txtComplaint == "") {
            alert("Please specify Chief Complaint");
            $("#pChiefComplaint").focus();
            return false;
        }
        else {
            $("#list9").removeClass("active");
            $("#tab9").removeClass("active");
            $("#tab2").addClass("active in");
            $("#list2").addClass("active");
        }
    }
    if(id == 'tab3') {
        var txtHistIllness = $("#pHistPresentIllness").val();
        if(txtHistIllness == "") {
            alert("Please specify History of Present Illness");
            $("#pHistPresentIllness").focus();
            return false;
        }
        else {
            $("#list2").removeClass("active");
            $("#tab2").removeClass("active");
            $("#tab3").addClass("active in");
            $("#list3").addClass("active");
        }
    }
    if(id == 'tab4') {
        var txtPastMedsHist = $("#txaMedHistOthers").val();
        if(txtPastMedsHist == "") {
            alert("Please specify Pertinent Past Medical History");
            $("#txaMedHistOthers").focus();
            return false;
        }
        else {
            $("#list3").removeClass("active");
            $("#tab3").removeClass("active");
            $("#tab4").addClass("active in");
            $("#list4").addClass("active");
        }
    }
    if(id == 'tab5') {
        var obgyne = $("#mhDone_2").is(":checked");
        var txtLastMens = $("#txtOBHistLastMens").val();
        var dateLastMens = new Date(txtLastMens);
        var compareLastMensDate = compareDates(dateToday,dateLastMens);

        var txtGravity = $("#txtOBHistGravity").val();
        var txtParity = $("#txtOBHistParity").val();
        var txtFullTerm = $("#txtOBHistFullTerm").val();
        var txtPremature = $("#txtOBHistPremature").val();
        var txtAbortion = $("#txtOBHistAbortion").val();
        var txtLivingChildren = $("#txtOBHistLivingChildren").val();

        if(txtLastMens != "" && compareLastMensDate == "0"){
            alert("Date of Last Menstrual Period is invalid! It should be less than or equal to current day.");
            return false;
        }
        else if(obgyne == true && (txtLastMens == "" || txtGravity == "" || txtParity == "" || txtFullTerm == "" || txtPremature == "" || txtAbortion == "" || txtLivingChildren == "")){
            alert("Please fill up all the fields in OB-Gyne History!");
            return false;
        }
        else {
            $("#list4").removeClass("active");
            $("#tab4").removeClass("active");
            $("#tab5").addClass("active in");
            $("#list5").addClass("active");
        }
    }
    if(id == 'tab6') {
        if(validateChecksSignsSymptomsCf4() == false){
            alert("Choose at least one PERTINENT SIGNS & SYMPTOMS ON ADMISSION!");
            return false;
        }
        else {
            $("#list5").removeClass("active");
            $("#tab5").removeClass("active");
            $("#tab6").addClass("active in");
            $("#list6").addClass("active");
        }
    }
    if(id == 'tab7') {
        /*Pertinent Physical Examination Findings*/
        var txtPhExSystolic = $("#txtPhExSystolic").val();
        var txtPhExBPDiastolic = $("#txtPhExBPDiastolic").val();
        var txtPhExHeartRate = $("#txtPhExHeartRate").val();
        var txtPhExRespiratoryRate = $("#txtPhExRespiratoryRate").val();

        /*General Survey*/
        var chkGenSurvey1 = $("#pGenSurvey_1").is(":checked");
        var chkGenSurvey2 = $("#pGenSurvey_2").is(":checked");
        var txtGenSurveyRem = $("#pGenSurveyRem").val();

        if(txtPhExSystolic == "" || txtPhExBPDiastolic == "" || txtPhExHeartRate == "" || txtPhExRespiratoryRate == "" || txtPhExTemp == ""){
            alert("Please fill up all required fields in PHYSICAL EXAMINATION ON ADMISSION!");
            return false;
        }
        else if(chkGenSurvey1 == false && chkGenSurvey2 == false){
            alert("Please specify General Survey of PHYSICAL EXAMINATION ON ADMISSION!");
            $("#pGenSurvey_1").focus();
            return false;
        }
        else if(chkGenSurvey2 == true && txtGenSurveyRem == ""){
            alert("Please specify Altered Sensorium in General Survey of PHYSICAL EXAMINATION ON ADMISSION!");
            $("#pGenSurveyRem").focus();
            return false;
        }
        else if(validateChecksHeent() == false){
            alert("Choose at least one HEENT in PERTINENT FINDINGS PER SYSTEM of PHYSICAL EXAMINATION ON ADMISSION");
            return false;
        }
        else if(validateChecksChest() == false){
            alert("Choose at least one CHEST/BREAST/LUNGS in PERTINENT FINDINGS PER SYSTEM of PHYSICAL EXAMINATION ON ADMISSION");
            return false;
        }
        else if(validateChecksHeart() == false){
            alert("Choose at least one HEART in PERTINENT FINDINGS PER SYSTEM of PHYSICAL EXAMINATION ON ADMISSION");
            return false;
        }
        else if(validateChecksAbdomen() == false){
            alert("Choose at least one ABDOMEN in PERTINENT FINDINGS PER SYSTEM of PHYSICAL EXAMINATION ON ADMISSION");
            return false;
        }
        else if(validateChecksGenitoUrinary() == false){
            alert("Choose at least one GENITOURINARY in PERTINENT FINDINGS PER SYSTEM of PHYSICAL EXAMINATION ON ADMISSION");
            return false;
        }
        else if(validateChecksSkin() == false){
            alert("Choose at least one SKIN/EXTREMITIES in PERTINENT FINDINGS PER SYSTEM of PHYSICAL EXAMINATION ON ADMISSION");
            return false;
        }
        else if(validateChecksNeuro() == false){
            alert("Choose at least one NEUROLOGICAL EXAMINATION in PERTINENT FINDINGS PER SYSTEM of PHYSICAL EXAMINATION ON ADMISSION");
            return false;
        }
        else {
            $("#list6").removeClass("active");
            $("#tab6").removeClass("active");
            $("#tab7").addClass("active in");
            $("#list7").addClass("active");
        }
    }
    if(id == 'tab8') {
        var txtDateActionWard = $("#pDateActionWard").val();
        var dateActionWard = new Date(txtDateActionWard);
        var compareDateActionWard = compareDates(dateToday,dateActionWard);
        var txtActionWard = $("#pActionWard").val();

        if(txtActionWard != null){
            alert("Please input at least one DOCTOR'S ORDER/ACTION in COURSE IN THE WARD");
            $("#txtWardDocAction").focus();
            return false;
        }
        else if(compareDateActionWard == "0"){
            alert("Date of Doctor's Order/Action in COURSE IN THE WARD is invalid! It should be less than or equal to current day.");
            return false;
        }
        else {
            $("#list7").removeClass("active");
            $("#tab7").removeClass("active");
            $("#tab8").addClass("active in");
            $("#list8").addClass("active");
        }
    }
}

function saveCF4Transaction() {
    var dateToday = new Date();
    var txtCF4TransNo = $("#txtPerTransmittalNo").val();
    var txtCF4ClaimId = $("#txtPerClaimId").val();
    /*Individual Health Profile*/
    var txtPxPin = $("#txtPerPatPIN").val();
    var txtMemLname = $("#txtPerPatLname").val();
    var txtMemFname = $("#txtPerPatFname").val();
    var txtPxSex = $("#txtPerPatSex option:selected").val();
    var txtPxCivilStatus = $("#txtPerPatStatus option:selected").val();
    var txtPxType = $("#txtPerPatType option:selected").val();
    var txtPxDoB = $("#txtPerPatBirthday").val();
    var datePxDoB= new Date(txtPxDoB);
    var comparePxDoB = compareDates(dateToday,datePxDoB);

    /*Chief Complaint*/
    var txtComplaint = $("#pChiefComplaint").val();

    /*History of Present Illness*/
    var txtHistIllness = $("#pHistPresentIllness").val();

    /*Past Medical History*/
    var txtPastMedsHist = $("#txaMedHistOthers").val();

    /*Menstrual History*/
    var obgyne = $("#mhDone_2").is(":checked");
    var txtMenarche = $("#txtOBHistMenarche").val();
    var txtLastMens = $("#txtOBHistLastMens").val();
    var dateLastMens = new Date(txtLastMens);
    var compareLastMensDate = compareDates(dateToday,dateLastMens);
    var txtPeriodDuration = $("#txtOBHistPeriodDuration").val();
    /*Pregnancy History*/
    var txtGravity = $("#txtOBHistGravity").val();
    var txtParity = $("#txtOBHistParity").val();

    var whatSex = $("#txtPerPatSex").val();

    /*Pertinent Physical Examination Findings*/
    var txtPhExSystolic = $("#txtPhExSystolic").val();
    var txtPhExBPDiastolic = $("#txtPhExBPDiastolic").val();
    var txtPhExHeartRate = $("#txtPhExHeartRate").val();
    var txtPhExRespiratoryRate = $("#txtPhExRespiratoryRate").val();

    /*General Survey*/
    var chkGenSurvey1 = $("#pGenSurvey_1").is(":checked");
    var chkGenSurvey2 = $("#pGenSurvey_2").is(":checked");
    var txtGenSurveyRem = $("#pGenSurveyRem").val();

    /*Course in the Ward*/
    var txtDateActionWard = $("#pDateActionWard").val();
    var dateActionWard = new Date(txtDateActionWard);
    var compareDateActionWard = compareDates(dateToday,dateActionWard);
    var txtActionWard = $("#pActionWard").val();

    if (txtCF4TransNo == "" || txtCF4ClaimId == "" || txtPxPin == "" || txtMemLname == ""  || txtMemFname == "" || txtPxSex == "" || txtPxCivilStatus == "" || txtPxType == "") {
        alert("Please fill up all required fields in PATIENT PROFILE");
        return false;
    }
    else if (txtPxPin.length < 12) {
        alert("Input 12 numbers of Patient's PIN");
        return false;
    }
    else if(comparePxDoB == "0"){
        alert("Date of Birth in PATIENT PROFILE is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(txtComplaint == "") {
        alert("Please specify Chief Complaint");
        $("#pChiefComplaint").focus();
        return false;
    }
    else if(txtHistIllness == "") {
        alert("Please specify History of Present Illness");
        $("#pHistPresentIllness").focus();
        return false;
    }
    else if(txtPastMedsHist == "") {
        alert("Please specify Pertinent Past Medical History");
        $("#txaMedHistOthers").focus();
        return false;
    }
    else if(txtLastMens != "" && compareLastMensDate == "0"){
        alert("Date of Last Menstrual Period is invalid! It should be less than or equal to current day.");
        return false;
    }
    else if(obgyne == true && txtLastMens == ""){
        alert("Please fill up the Last Menstrual Period in MENSTRUAL HISTORY of OB-GYNE HISTORY menu!");
        return false;
    }
    else if(obgyne == true && (txtGravity == "" || txtParity == "")){
        alert("Please fill up the Gravity and Parity in PREGNANCY HISTORY of OB-GYNE HISTORY!");
        return false;
    }
    else if(validateChecksSignsSymptomsCf4() == false){
        alert("Choose at least one PERTINENT SIGNS & SYMPTOMS ON ADMISSION!");
        return false;
    }
    else if(txtPhExSystolic == "" || txtPhExBPDiastolic == "" || txtPhExHeartRate == "" || txtPhExRespiratoryRate == "" || txtPhExTemp == ""){
        alert("Please fill up all required fields in PHYSICAL EXAMINATION ON ADMISSION!");
        return false;
    }
    else if(chkGenSurvey1 == false && chkGenSurvey2 == false){
        alert("Please specify General Survey of PHYSICAL EXAMINATION ON ADMISSION!");
        $("#pGenSurvey_1").focus();
        return false;
    }
    else if(chkGenSurvey2 == true && txtGenSurveyRem == ""){
        alert("Please specify Altered Sensorium in General Survey of PHYSICAL EXAMINATION ON ADMISSION!");
        $("#pGenSurveyRem").focus();
        return false;
    }
    else if(validateChecksHeent() == false){
        alert("Choose at least one HEENT in PERTINENT FINDINGS PER SYSTEM of PHYSICAL EXAMINATION ON ADMISSION");
        return false;
    }
    else if(validateChecksChest() == false){
        alert("Choose at least one CHEST/BREAST/LUNGS in PERTINENT FINDINGS PER SYSTEM of PHYSICAL EXAMINATION ON ADMISSION");
        return false;
    }
    else if(validateChecksHeart() == false){
        alert("Choose at least one HEART/CVS in PERTINENT FINDINGS PER SYSTEM of PHYSICAL EXAMINATION ON ADMISSION");
        return false;
    }
    else if(validateChecksAbdomen() == false){
        alert("Choose at least one ABDOMEN in PERTINENT FINDINGS PER SYSTEM of PHYSICAL EXAMINATION ON ADMISSION");
        return false;
    }
    else if(validateChecksGenitoUrinary() == false){
        alert("Choose at least one GENITOURINARY in PERTINENT FINDINGS PER SYSTEM of PHYSICAL EXAMINATION ON ADMISSION");
        return false;
    }
    else if(validateChecksSkin() == false){
        alert("Choose at least one SKIN/EXTREMITIES in PERTINENT FINDINGS PER SYSTEM of PHYSICAL EXAMINATION ON ADMISSION");
        return false;
    }
    else if(validateChecksNeuro() == false){
        alert("Choose at least one NEUROLOGICAL EXAMINATION in PERTINENT FINDINGS PER SYSTEM of PHYSICAL EXAMINATION ON ADMISSION");
        return false;
    }
    else if(txtActionWard != null){
        alert("Please input at least one DOCTOR'S ORDER/ACTION in COURSE IN THE WARD");
        $("#txtWardDocAction").focus();
        return false;
    }
    else if(compareDateActionWard == "0"){
        alert("Date of Doctor's Order/Action in COURSE IN THE WARD is invalid! It should be less than or equal to current day.");
        return false;
    }
    else {
        //TO DO SAVING
        return confirm('Do you want to submit it now?');
    }
} /*END SAVE CF4 TRANSACTION*/