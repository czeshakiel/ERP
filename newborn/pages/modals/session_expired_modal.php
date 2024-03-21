<div class="modal fade" id="sessionExpiredModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" data-bs-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <img src="assets/images/change-log.svg" class="img-fluid mx-size" alt="No Data">
                <input type="hidden" value="NEW BORN SCREENING" id="session_dept">
                <h3>Whoops, Your session has expired</h3>
                <p>Your session has expired due to your inactivity. No worry, simply log in again.</p>
                <div class="button-box">
                    <button class="btn eight" id="close_session_modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- pop up alerts / toast notifications -->
    <!-- success -->
    <div class="modal fade" id="popupAlertSuccess" tabindex="-1" 
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modalbox success center animate" style="text-align:center">
                <div class="icon">
			    	<span class="icofont-thumbs-up"></span>
			    </div>
			    <h1>Success!</h1>
			    <p>You have successfully conducted the <i>"<span id="spanfrtstdone"></span>"</i>.</p>
			    <button type="button" class="btn confSBtn" id="confTestdone" style="text-align:center">Ok</button>
            </div>
        </div>
    </div>
    <!-- failed -->
    <div class="modal fade" id="popupAlertFailed" tabindex="-1" 
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modalbox error center animate">
                <div class="icon">
			    	<span class="icofont-thumbs-down"></span>
			    </div>
			    <h1>Oh no!</h1>
			    <p>Oops! Something went wrong,</p>
				<p>you should try again.</p>
			    <button type="button" class="btn confEBtn" id="confTDoneFailed" style="text-align:center">Ok</button>
            </div>
        </div>
    </div>
    <!-- warning -->
    <div class="modal fade" id="popupAlertWarning" tabindex="-1" 
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modalbox warning center animate">
                <div class="icon">
			    	<span class="icofont-exclamation"></span>
			    </div>
			    <h1>Warning!</h1>
			    <p>Oops! Something went wrong,</p>
				<p>you should try again.</p>
			    <button type="button" class="btn confWBtn" style="text-align:center">Ok</button>
            </div>
        </div>
    </div>

<!-- loader modal -->
<div class="modal fade" id="loaderModal" tabindex="-1" aria-labelledby="exampleModalXlLabel" data-keyboard="false"  style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal_laoder">
            <div class="modal-body">
                <div class="loader">
                    <div style="--i:1" class="loader_item"></div>
                    <div style="--i:2" class="loader_item"></div>
                    <div style="--i:3" class="loader_item"></div>
                    <div style="--i:4" class="loader_item"></div>
                    <div style="--i:5" class="loader_item"></div> 
                    <div style="--i:6" class="loader_item"></div>
                    <div style="--i:7" class="loader_item"></div>
                    <div style="--i:8" class="loader_item"></div>
                    <div style="--i:9" class="loader_item"></div>
                    <div style="--i:10" class="loader_item"></div>
                    <div style="--i:11" class="loader_item"></div>
                    <div style="--i:12" class="loader_item"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- request modal -->
<div class="modal fade" id="modalForPrintTickets" tabindex="-1" aria-labelledby="exampleModalXlLabel" data-bs-backdrop="static" data-keyboard="false"  style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="background-color: #cccacaf2; border:none">
            <div class="modal-header">
                <button class="btn-close" data-bs-dismiss="modal" data-bs-toggle="tooltip" title="Close" data-bs-displacement="left"></button>
            </div>
            <div class="modal-body" id="patientdata"></div>
        </div>
    </div>
</div>


<!-- requests page modal -->
    <!-- deletion modal -->
    <div class="modal fade" id="confirmation_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content confirmCard">
                <div class="confirmation_card">
                  <img src="assets/images/gif/Yesorno.gif" alt="Delete or Not" class="myimage">
                  <p class="cookieHeading">Delete Confirmation</p>
                  <p class="cookieDescription">Are you sure, do you want to delete this transaction?</p>
                  <div class="buttonContainer">
                    <button type="submit" id="confirmedDelete" class="acceptButton"> Yes, delete</button>
                    <button type="submit" data-bs-dismiss="modal" class="declineButton"> Cancel</button>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <!-- refund modal -->
    <div class="modal fade" id="confirmationRefundModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content confirmReFundModal">
                <div class="confirmationRefundCard">
                  <img src="assets/images/gif/Refund.gif" alt="Refund" class="myimage">
                  <p class="cookieHeading">Refund Confirmation</p>
                  <p class="cookieDescription">Are you sure, do you want to refund this transaction?</p>
                  <div class="buttonContainer">
                    <button type="submit" id="confirmedRefund" class="acceptButton"> Refund</button>
                    <button type="submit" data-bs-dismiss="modal" class="declineButton"> Cancel</button>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <!-- undo refund modal -->
    <div class="modal fade" id="confirmationUndoRefundModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content confirmUndoModal">
                <div class="confirmationUndoCard">
                  <img src="assets/images/gif/UndoRefund.gif" alt="Undo Refund" class="myimage">
                  <p class="cookieHeading">Undo Refund Confirmation</p>
                  <p class="cookieDescription">Are you sure, do you want to undo the refund?</p>
                  <div class="buttonContainer">
                    <button type="submit" id="confirmedUndo" class="acceptButton"> Undo</button>
                    <button type="submit" data-bs-dismiss="modal" class="declineButton"> Cancel</button>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <!-- testdone modal -->
    <div class="modal fade" id="proceedTestdoneModal" tabindex="-1" aria-labelledby="exampleModalLgLabel" data-bs-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="exampleModalLgLabel">Set Reader and Series Number</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body xrydkg">
                    <div class="form-group">
                        <img src="assets/images/lg/baby-boy.jpg" alt="baby-profile">
                        <span class="bby-name" id="bby-fname"></span>
                    </div>
                    <div class="row" style="margin-top:5px">
                        <div class="col-md-1">
                            <div class="form-group" style="border: 2px solid black"></div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group" style="border: 2px solid black"></div>
                        </div>
                    </div>
                    <div id="readersdiv">
                        <div class="row" style="margin-top:10px">
                            <div class="col-md-4">
                                <span class="xr-label"> READER :</span>
                            </div>
                            <div class="col-md-8">
                                <select type="text" class="selectsearch form-select" id="bb_reader" style="width:100%;">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-4">
                            <span class="xr-label"> TECH :</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="bb_radtech" value="MARITES TORCULAS" readonly>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-4">
                            <span class="xr-label"> SERIES NO. :</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="bb_seriesno">
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-4">
                            <span class="xr-label"> PATIENTIDNO :</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="bb_patientidno" readonly>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-4">
                            <span class="xr-label"> CASENO :</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="bb_caseno" readonly>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-4">
                            <span class="xr-label"> REFNO :</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="bb_refno" readonly>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-4">
                            <span class="xr-label"> DESCRIPTION :</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="bb_description" readonly>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-4">
                            <span class="xr-label"> REF PHYSICIAN :</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="bb_refphysician" readonly>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-4">
                            <span class="xr-label"> CLINICAL SERVICES :</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="bb_clinicalservices" readonly>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="fsname">
                    <input type="hidden" class="form-control" id="mdname">
                    <input type="hidden" class="form-control" id="lsname">
                    <input type="hidden" class="form-control" id="lguser">
                    <input type="hidden" class="form-control" id="trantype">
                    <input type="hidden" class="form-control" id="productcode">
                    <input type="hidden" class="form-control" id="productdesc">
                    <input type="hidden" class="form-control" id="prodDescCon">
                    <input type="hidden" class="form-control" id="senior">
                    <input type="hidden" class="form-control" id="refphysician">
                </div>
                <div class="modal-footer">
                    <button class="btn-53" onclick="sdfn_testdone()">
                      <div class="original"> Proceed</div>
                      <div class="letters">
                        <span>T</span>
                        <span>E</span>
                        <span>S</span>
                        <span>T</span>
                        <span>D</span>
                        <span>O</span>
                        <span>N</span>
                        <span>E</span>
                      </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- test done confirmation -->
    <div class="modal fade" id="confirmationTestdone" tabindex="-1" aria-labelledby="exampleModalLgLabel" data-bs-backdrop="static" data-keyboard="false" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content confirmTDone">
                <div class="confirmationTDone">
                  <img src="assets/images/gif/Pediatrician.gif" alt="Delete or Not" class="myimage">
                  <p class="cookieHeading">Testdone Confirmation</p>
                  <p class="cookieDescription">Are you sure, do you want to set this transaction as <b>"Testdone"</b>?</p>
                  <div class="buttonContainer">
                    <button type="submit" id="confirmedTDone" class="acceptButton"> Confirm</button>
                    <button type="submit" data-bs-dismiss="modal" class="declineButton"> Cancel</button>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <!-- success modal -->
    <div class="modal fade" id="popupDeleteSuccess" tabindex="-1" 
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modalbox warning center animate">
                <div class="icon">
			    	<span class="icofont-trash"></span>
			    </div>
			    <h1>Deleted!</h1>
			    <p>Transaction has been deleted successfully.</p>
			    <button type="button" class="btn confSBtn" id="confSuccess" style="text-align:center">Ok</button>
            </div>
        </div>
    </div>
    <!-- refund success -->
    <div class="modal fade" id="popupRefundSuccess" tabindex="-1" 
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modalbox success center animate">
                <div class="icon">
			    	<span class="icofont-peso-true"></span>
			    </div>
			    <h1>Refunded!</h1>
			    <p>Transaction has been refunded successfully.</p>
			    <button type="button" class="btn confSBtn" id="confRefSuccess" style="text-align:center">Ok</button>
            </div>
        </div>
    </div>
    <!-- undo refund success -->
    <div class="modal fade" id="popupUndoSuccess" tabindex="-1" 
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modalbox success center animate">
                <div class="icon">
			    	<span class="icofont-peso-false"></span>
			    </div>
			    <h1>Revoke Refund!</h1>
			    <p>Transaction has been undo the refund successfully.</p>
			    <button type="button" class="btn confSBtn" id="confUndoSuccess" style="text-align:center">Ok</button>
            </div>
        </div>
    </div>
    <!-- deleting modal -->
        <div class="modal fade" id="loadingbar" tabindex="-1" data-bs-backdrop="static" data-keyboard="false" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content confirmCard">
                    <div class="confirmation_card">
                        <div class="deleteLoadingBar"></div>
                        <span>Deleting please wait...</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- refund loader -->
        <div class="modal fade" id="refloadingbar" tabindex="-1" data-bs-backdrop="static" data-keyboard="false" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content confirmCard">
                    <div class="confirmation_card">
                        <div class="deleteLoadingBar"></div>
                        <span>Processing please wait...</span>
                    </div>
                </div>
            </div>
        </div>
    <!-- failed modal -->
    <div class="modal fade" id="popupDeleteFailed" tabindex="-1" 
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modalbox error center animate">
                <div class="icon">
			    	<span class="icofont-thumbs-down"></span>
			    </div>
			    <h1>Oh no!</h1>
			    <p>Oops! Something went wrong,</p>
				<p>you should try again.</p>
			    <button type="button" class="btn confEBtn" id="confFailed" style="text-align:center">Ok</button>
            </div>
        </div>
    </div>

        <!-- Warning Report already created -->
    <div class="modal fade" id="nbsReportAlreadyDone" tabindex="-1" aria-labelledby="exampleModalCenterTitle" data-bs-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <img src="assets/images/gif/Report.gif" class="img-fluid mx-size" alt="No Data">
                    <h3>Oops! A report for year <span id="yrmdl"></span> has already been created.</h3>
                    <p>You can find the existing report in the list below. Please check the list to locate the report you're looking for.</p>
                    <div class="button-box">
                        <button class="btn eight" id="confReportBtn">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- requested profile modal -->
    <div class="modal fade" id="requestByProfile" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content pfCard">
                <div class="close-btn ">
                    <button class="bttn ms-auto" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                </div>
                <div class="PfDetails">
                    <div class="flip-card">
                      <div class="flip-card-inner">
                        <div class="flip-card-front">
                          <div class="profile-image">
                            <img src="assets/images/lg/unknown.png" alt="userlog-image" class="pfp">
                            <div class="name">
                                <span id="loginuser_name"></span>
                            </div>
                            <div class="emp_id">
                                <span id="employee_id"></span>
                            </div>
                          </div>
                        </div>
                        <div class="flip-card-back">
                          <div class="Description">
                            <p class="description">
                              <span id="job_title"></span>
                            </p>
                            <div class="socialbar">
                              <a id="github" href="#"><svg viewBox="0 0 16 16" class="bi bi-github" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path>
                          </svg></a>

                              <a id="instagram" href="#"><svg viewBox="0 0 16 16" class="bi bi-instagram" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                          </svg></a>

                              <a id="facebook" href="#"><svg viewBox="0 0 16 16" class="bi bi-facebook" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                          </svg></a>

                              <a id="twitter" href="#"><svg viewBox="0 0 16 16" class="bi bi-twitter" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
                          </svg></a>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- end of request page modal -->

<!-- start of reports modal -->
<div class="modal fade" id="createReportModal" tabindex="-1" aria-labelledby="createReportModal" data-bs-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h5 class="modal-title h4">NBS CENSUS MODAL <span class="font-italic" id="yearselected"></span></h5><input type="hidden" id="pst_year">
                <button type="submit" class="savebtn" onclick="saveNbsReportDetails()"><span class="icon"><i class="icofont-cloudapp"></i></span><span class="text"> Save Report</span></button>
                <button type="submit" title="Close" id="closeNbsReportDetails" class="modal-close-btn"><i class="icofont-close-circled"></i></button>  
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="width:100%" border='1'>
                        <thead>
                            <tr>
                                <th class="text-center; width:10%"><span>CALENDAR</span></th>
                                <th class="text-center; width:10%">Total Count of Deliveries</th>
                                <th class="text-center; width:10%">Total Count of Neonatal Deaths</th>
                                <th class="text-center; width:10%">Total Count of Livebirths</th>
                                <th class="text-center; width:10%">Total Count of Stillbirths</th>
                                <th class="text-center; width:10%">Total Count of Inborn Screened</th>
                                <th class="text-center; width:10%">Total Count of Outborn Screened</th>
                                <th class="text-center; width:10%">Total Count of Transfer</th>
                                <th class="text-center; width:10%">Total Count of Refusal</th>
                                <th class="text-center; width:10%">REASONS FOR REFUSALS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"><span>JANUARY</span></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="january_ttl_delv"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="january_ttl_neod"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="january_ttl_lvb"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="january_ttl_stbr"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="january_ttl_inbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="january_ttl_onbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="january_ttl_tran"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="january_ttl_refu"></td>
                                <td class="text-center"><input type="text" class="form-control text-center" id="january_reason_refu"></td>
                            </tr>
                            <tr>
                                <td class="text-center"><span>FEBUARY</span></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="february_ttl_delv"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="february_ttl_neod"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="february_ttl_lvb"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="february_ttl_stbr"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="february_ttl_inbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="february_ttl_onbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="february_ttl_tran"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="february_ttl_refu"></td>
                                <td class="text-center"><input type="text" class="form-control text-center" id="february_reason_refu"></td>
                            </tr>
                            <tr>
                                <td class="text-center"><span>MARCH</span></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="march_ttl_delv"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="march_ttl_neod"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="march_ttl_lvb"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="march_ttl_stbr"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="march_ttl_inbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="march_ttl_onbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="march_ttl_tran"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="march_ttl_refu"></td>
                                <td class="text-center"><input type="text" class="form-control text-center" id="march_reason_refu"></td>
                            </tr>
                            <tr>
                                <td class="text-center"><span>APRIL</span></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="april_ttl_delv"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="april_ttl_neod"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="april_ttl_lvb"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="april_ttl_stbr"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="april_ttl_inbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="april_ttl_onbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="april_ttl_tran"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="april_ttl_refu"></td>
                                <td class="text-center"><input type="text" class="form-control text-center" id="april_reason_refu"></td>  
                            </tr>
                            <tr>
                                <td class="text-center"><span>MAY</span></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="may_ttl_delv"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="may_ttl_neod"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="may_ttl_lvb"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="may_ttl_stbr"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="may_ttl_inbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="may_ttl_onbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="may_ttl_tran"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="may_ttl_refu"></td>
                                <td class="text-center"><input type="text" class="form-control text-center" id="may_reason_refu"></td>
                            </tr>
                            <tr>
                                <td class="text-center"><span>JUNE</span></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="june_ttl_delv"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="june_ttl_neod"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="june_ttl_lvb"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="june_ttl_stbr"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="june_ttl_inbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="june_ttl_onbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="june_ttl_tran"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="june_ttl_refu"></td>
                                <td class="text-center"><input type="text" class="form-control text-center" id="june_reason_refu"></td>                      
                            </tr>
                            <tr>
                                <td class="text-center"><span>JULY</span></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="july_ttl_delv"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="july_ttl_neod"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="july_ttl_lvb"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="july_ttl_stbr"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="july_ttl_inbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="july_ttl_onbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="july_ttl_tran"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="july_ttl_refu"></td>
                                <td class="text-center"><input type="text" class="form-control text-center" id="july_reason_refu"></td>                            
                            </tr>
                            <tr>
                                <td class="text-center"><span>AUGUST</span></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="august_ttl_delv"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="august_ttl_neod"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="august_ttl_lvb"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="august_ttl_stbr"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="august_ttl_inbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="august_ttl_onbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="august_ttl_tran"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="august_ttl_refu"></td>
                                <td class="text-center"><input type="text" class="form-control text-center" id="august_reason_refu"></td>                            
                            </tr>
                            <tr>
                                <td class="text-center"><span>SEPTEMBER</span></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="september_ttl_delv"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="september_ttl_neod"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="september_ttl_lvb"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="september_ttl_stbr"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="september_ttl_inbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="september_ttl_onbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="september_ttl_tran"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="september_ttl_refu"></td>
                                <td class="text-center"><input type="text" class="form-control text-center" id="september_reason_refu"></td>                              
                            </tr>
                            <tr>
                                <td class="text-center"><span>OCTOBER</span></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="october_ttl_delv"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="october_ttl_neod"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="october_ttl_lvb"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="october_ttl_stbr"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="october_ttl_inbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="october_ttl_onbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="october_ttl_tran"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="october_ttl_refu"></td>
                                <td class="text-center"><input type="text" class="form-control text-center" id="october_reason_refu"></td>
                            <tr>
                                <td class="text-center"><span>NOVEMBER</span></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="november_ttl_delv"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="november_ttl_neod"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="november_ttl_lvb"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="november_ttl_stbr"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="november_ttl_inbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="november_ttl_onbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="november_ttl_tran"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="november_ttl_refu"></td>
                                <td class="text-center"><input type="text" class="form-control text-center" id="november_reason_refu"></td>
                            </tr>
                            <tr>
                                <td class="text-center"><span>DECEMBER</span></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="december_ttl_delv"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="december_ttl_neod"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="december_ttl_lvb"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="december_ttl_stbr"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="december_ttl_inbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="december_ttl_onbs"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="december_ttl_tran"></td>
                                <td class="text-center"><input type="number" class="form-control text-center" id="december_ttl_refu"></td>
                                <td class="text-center"><input type="text" class="form-control text-center" id="december_reason_refu"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- end of report modal -->
<div class="modal fade" id="confirmationCloseReport" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content confirmUndoModal">
            <div class="confirmationUndoCard">
                <img src="assets/images/gif/discarded.gif" alt="Undo Refund" class="myimage">
                <p class="cookieHeading">Unsaved Changes!</p>
                <p class="cookieDescription">You have unsaved changes in your report. <br> Closing without saving will discard these changes.</p>
                <div class="buttonContainer">
                    <button type="button" id="confirmedCloseRep" class="btn btn-danger">Discard Changes</button>
                    <button type="button" id="cancelCloseRep" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- success alert in report module -->
    <div class="modal fade" id="popupAlertSuccessReport" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modalbox success center animate" style="text-align:center">
                <div class="icon">
			    	<span class="icofont-thumbs-up"></span>
			    </div>
			    <h1>Success!</h1>
			    <p>NBS report for year <span id="yearReportCrt"></span> has been created.</p>
			    <button type="button" class="btn confSBtn" id="confRepDone" style="text-align:center">Ok</button>
            </div>
        </div>
    </div>

<!-- report selection -->
<div class="modal fade" id="reportSelectionModal" tabindex="-1" aria-labelledby="createReportModal" data-bs-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modhov_card">
                <div class="close-btn ">
                    <button class="bttn ms-auto" data-bs-toggle="tooltip" data-bs-displacement="top" title="Close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                </div>
            <div class="modal-body modhov_bdy">
                <div class="hov_header">
                    <h4>Select Report</h4>
                </div>
                <div class="hov_cards">
                    <a type="submit" id="yearlyNbsReport" class="hovcard red">
                        <p class="tip">Annual NBS Report</p>
                    </a>
                    <a type="submit" id="monthlyNbsReport" class="hovcard blue">
                        <p class="tip">Quarterly NBS Report</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- failed to save nbs report alert modal -->
<div class="modal fade" id="failedToSaveModal" tabindex="-1" 
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modalbox error center animate">
                <div class="icon">
			    	<span class="icofont-thumbs-down"></span>
			    </div>
			    <h1>Oh no!</h1>
			    <p>Oops! Something went wrong,</p>
				<p>you should try again.</p>
			    <button type="submit" class="btn confEBtn" id="confFailed2" style="text-align:center">Ok</button>
            </div>
        </div>
    </div>

<!-- getting files ready loader -->
<div class="modal fade" id="gettingFileReady" tabindex="-1" aria-labelledby="createReportModal" data-bs-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content file_loader">
            <div class="modal-body">
                <div class="get_file_ready">
                  <div class="folder">
                    <div class="top"></div>
                    <div class="bottom"></div>
                  </div>
                  <div class="title">getting files ready...</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- empty stock -->
<div class="modal fade" id="emptyStockNewbornKit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content confirmUndoModal">
            <div class="confirmationUndoCard">
                <img src="assets/images/gif/emptybox.gif" alt="Empty Stocks" class="myimage">
                <p class="cookieHeading">Oops!</p>
                <p class="cookieDescription">We're currently out of stock for the newborn kit item.</p>
                <div class="buttonContainer">
                    <button type="button" id="confRequestKit" class="btn btn-danger"> OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- repeat modal -->
  <!-- testdone modal -->
  <div class="modal fade" id="newbornRepeatModal" tabindex="-1" aria-labelledby="exampleModalLgLabel" data-bs-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="exampleModalLgLabel">Set Repeat Series Number</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body xrydkg">
                    <div class="form-group">
                        <img src="assets/images/lg/baby-boy.jpg" alt="baby-profile">
                        <span class="bby-name" id="rep_bbyname"></span>
                    </div>
                    <div class="row" style="margin-top:5px">
                        <div class="col-md-1">
                            <div class="form-group" style="border: 2px solid black"></div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group" style="border: 2px solid black"></div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-4">
                            <span class="xr-label"> TECH :</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="rep_screeners" readonly>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-4">
                            <span class="xr-label"> SERIES NO. :</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="rep_bbseriesno">
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-4">
                            <span class="xr-label"> PATIENTIDNO :</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="rep_bbpatientidno" readonly>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-4">
                            <span class="xr-label"> CASENO :</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="rep_bbcaseno" readonly>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-4">
                            <span class="xr-label"> REFNO :</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="rep_bbrefno" readonly>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-4">
                            <span class="xr-label"> DESCRIPTION :</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="rep_bbdescription" readonly>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-4">
                            <span class="xr-label"> REF PHYSICIAN :</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="rep_bbrefphysician" readonly>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-4">
                            <span class="xr-label"> CLINICAL SERVICES :</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="rep_bbclinicalservices" readonly>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="rep_fsname">
                    <input type="hidden" class="form-control" id="rep_mdname">
                    <input type="hidden" class="form-control" id="rep_lsname">
                    <input type="hidden" class="form-control" id="rep_trantype">
                    <input type="hidden" class="form-control" id="rep_productcode">
                    <input type="hidden" class="form-control" id="rep_productdesc">
                </div>
                <div class="modal-footer">
                    <button class="btn-53" onclick="saveRepeatNewborn()">
                      <div class="original"> Proceed</div>
                      <div class="letters">
                        <span>T</span>
                        <span>E</span>
                        <span>S</span>
                        <span>T</span>
                        <span>D</span>
                        <span>O</span>
                        <span>N</span>
                        <span>E</span>
                      </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- success repeat -->
    <div class="modal fade" id="successRepeatNewborn" tabindex="-1" 
    aria-labelledby="exampleModalLgLabel" data-bs-backdrop="static" data-keyboard="false" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content confirmTDone">
                <div class="confirmationTDone">
                  <img src="assets/images/gif/Happybaby.gif" alt="Delete or Not" class="myimage">
                  <p class="cookieHeading">Success!</p>
                  <p class="cookieDescription"><span id="repProdDesc"></span> test completed successfully.</p>
                  <div class="buttonContainer">
                    <button type="submit" id="confRept" class="acceptButton"> OK</button>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <!-- warning repeat -->
    <div class="modal fade" id="popupAlertWarningRep" tabindex="-1" 
    aria-labelledby="exampleModalLgLabel" data-bs-backdrop="static" data-keyboard="false" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content confirmTDone">
                <div class="confirmationTDone">
                  <img src="assets/images/gif/OpssErrorRobot.gif" alt="Delete or Not" class="myimage">
                  <p class="cookieHeading">Opss!</p>
                  <p class="cookieDescription">Something went wrong, you should try again.</p>
                  <div class="buttonContainer">
                    <button type="submit" id="confWarnRep" class="acceptButton"> OK</button>
                  </div>
                </div>
            </div>
        </div>
    </div>
