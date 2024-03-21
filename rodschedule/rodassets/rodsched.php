<?php include 'rodassets/php/db-connect.php'; ?>
<link href='rodassets/css/custom.css' rel='stylesheet'/>
<link href='rodassets/vendor/fontawesome-free/css/all.min.css' rel='stylesheet' type='text/css'>
<link href='rodassets/css/bootstrap.min.css' rel='stylesheet'/>
<script src='rodassets/lib/index.global.min.js' type='text/javascript'></script>
<script src='rodassets/js/moment.min.js' type='text/javascript'></script>
<script src='rodassets/js/jquery-3.6.0.min.js' type='text/javascript'></script>
<script src='rodassets/js/bootstrap.min.js' type='text/javascript'></script>
<script src='rodassets/js/iscript.js' type='text/javascript'></script>
<style>
#calendar {
max-width: 1200px;
height: 1060px;
margin: 0 auto;
}
#calendar .fc-scroller {
overflow-x: hidden !important;
overflow-y: hidden !important;
}
#calendar .fc-day-number {
  text-decoration: none;
  cursor: default;
  pointer-events: none;
}
.input-error{
box-shadow: 0 0 5px #fb0100;
}
.wrap .one_totwo {
float: left;
}
#calendar {
width: 1100px;
}

#station_rod table {
  border-collapse: collapse;
  border-spacing: 0;
  font-size: 1em; /* normalize cross-browser */
  font-family: sans-serif;
  min-width: 130px;
  margin-left: 10px;
  margin-bottom: 10px;
}
#station_rod td{
  border: 1px solid #ddd;
  vertical-align: top;
  text-align: center;
}
#station_rod thead #erhght {
  height: 63px;
}
#station_rod thead #erhght1 {
  height: 26px;
}
#station_rod .thtext_er {
   background-color: #ffffff;
  text-align: center;
  border: 1px solid #dddddd;
}
.thtext_er .stton{
  font-size: 15px;
  font-weight: bold;
  color: #0D6EFD;
  display: block;
  position: relative;
  margin-top: 5px;
}
#station_rod td, th{
  position: relative;
}
#station_rod tbody tr {
    border-bottom: 1px solid #dddddd;
    height: 900px;
}
.spn-border span {
  font-size: 15px;
  font-weight: bold;
  color: #ffffff;
  display: block;
  border-radius: 2px;
  background: #5f5fa1;
  position: relative;
}
 .spn-border .span_er{
  margin-top: 32px;
}
.spn-border .spn1{
  margin-top: 7px;
}
#station_rod tbody #trone{
  height: 161px;
}
#station_rod tbody #trtwo {
  height: 161px;
}
#station_rod tbody #trthree {
  height: 163px;
}
#station_rod tbody #trfour {
  height: 162px;
}
#station_rod tbody #trfive {
  height: 163px;
}
#station_rod tbody #trsix {
  height: 161px;
}
</style>
<div class="wrap">
      <div class="one_totwo" id="station_rod">
        <table class="styled-table">
          <thead>
              <tr id='erhght'>
                  <th></th>
              </tr>
              <tr id='erhght1'>
                  <th class="thtext_er"><span class='stton'>STATION</span></th>
              </tr>
          </thead>
          <tbody>
              <tr class="spn-border" id="trone">
                <td>
                  <span class="span_er">ER</span>
                  <span class="spn1">NS1/OR-DR/NS4</span>
                  <span class="spn1">NS2/RDU/NS3</span>
                  <span class="spn1">ICU/NS5/NS6</span>
                </td>
              </tr>
              <tr class="spn-border" id="trtwo">
                <td>
                  <span class="span_er">ER</span>
                  <span class="spn1">NS1/OR-DR/NS4</span>
                  <span class="spn1">NS2/RDU/NS3</span>
                  <span class="spn1">ICU/NS5/NS6</span>
                </td>
              </tr>
              <tr class="spn-border" id="trthree">
                <td>
                  <span class="span_er">ER</span>
                  <span class="spn1">NS1/OR-DR/NS4</span>
                  <span class="spn1">NS2/RDU/NS3</span>
                  <span class="spn1">ICU/NS5/NS6</span>
                </td>
              </tr>
              <tr class="spn-border" id="trfour">
                  <td>
                    <span class="span_er">ER</span>
                    <span class="spn1">NS1/OR-DR/NS4</span>
                    <span class="spn1">NS2/RDU/NS3</span>
                    <span class="spn1">ICU/NS5/NS6</span>
                  </td>
              </tr>
              <tr class="spn-border" id="trfive">
                  <td>
                    <span class="span_er">ER</span>
                    <span class="spn1">NS1/OR-DR/NS4</span>
                    <span class="spn1">NS2/RDU/NS3</span>
                    <span class="spn1">ICU/NS5/NS6</span>
                  </td>
              </tr>
              <tr class="spn-border" id="trsix">
                  <td>
                    <span class="span_er">ER</span>
                    <span class="spn1">NS1/OR-DR/NS4</span>
                    <span class="spn1">NS2/RDU/NS3</span>
                    <span class="spn1">ICU/NS5/NS6</span>
                  </td>
              </tr>
          </tbody>
        </table>
      </div>
    <div class="one_totwo" id="calendar"></div>
</div>
<input type='hidden' id='rodname' name='rodname' value='<?php echo $_GET['username'];?>'>

<!--modal-->
     <!-- Start popup dialog box -->
     <div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Add Today's Schedule</h5>
          </div>
          <div class="modal-body">
          <form id="assign-sched-form" action="schedule/php/save_schedule.php">
            <div class="img-container">
              <div class="row">
                <div class="col-sm-12">
                <span id='status-message'></span>
                  <div class="form-group">
                    <label for="assignname">Name</label>
                    <select class='form-control' type='text' name='assignname' id='assignname' required>
                      <option value="">--select--</option>
                      <?php

                        $sqlrod = $conn->query("SELECT * FROM `docfile` WHERE `specialization` ='ROD' AND `name` != 'REFERRAL'");
                        while ($drow = $sqlrod->fetch_assoc()) {
                          $lname = $drow['lastname'];
                          $fname = $drow['firstname'];
                          $mname = $drow['middlename'];
                          $lname = $drow['lastname'];
                          $code = $drow['code'];
                          echo "<option value='".$code."|".$lname."|".$fname."|".$mname."'>$lname, $fname ".$mname[0].".</option>";
                        }
                      ?>
                     </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="docspec">Specialization</label>
                    <input class="form-control" type="text" name="docspec" id="docspec" value="ROD" readonly></input>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="sched_station">Station</label>
                    <select class="form-control" name="sched_station" id="sched_station" required>
                      <option value="">--select--</option>
                      <option value="1|Er">ER</option>
                      <option value="2|NS1/OR-DR/NS4">NS1/OR-DR/NS4</option>
                      <option value="3|NS2/RDU/NS3">NS2/RDU/NS3</option>
                      <option value="4|ICU/NS5/NS6">ICU/NS5/NS6</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="assgn_start_date">Schedule Date</label>
                    <input class="form-control" type="date" name="assgn_start_date" id="assgn_start_date" required>
                   </div>
                </div>
              </div>
              <div class="row" style="padding-bottom:20px">
                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="assgn_end_date">Schedule Time</label> 
                    <input class="form-control" type="time" name="startTime" id="startTime" required>
                  </div>
                </div>
                <div class="col-sm-2" style="text-align:center; padding-top:35px;">
                  <label for="to">to</label>
                </div>
                <div class="col-sm-5" style="margin-top:24px">
                  <div class="form-group">
                    <label for="assgn_end_date"></label>
                    <input class="form-control" type="time" name="endTime" id="endTime" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Close</button>
              <button type="submit" class="btn btn-primary" id="save_rod_sched"><i class="fa fa-paper-plane"></i> Save</button>
            </div>
        </form>
        </div>
        </div>
      </div>
    </div>
    <!-- End popup dialog box -->
      <!--Confirm Save successfully-->
      <div id="successfullModal" class="modal fade">
	      <div class="modal-dialog modal-sucConf">
	      	<div class="modal-content">
	      		<div class="modal-header justify-content-center">
	      			<div class="icon-box">
	      				<i class="fa fa-check"></i>
	      			</div>
	      		</div>
	      		<div class="modal-body text-center">
	      			<h4>Great!</h4>	
	      			<p>Schedule has been created successfully.</p>
	      			<button class="btn btn-success" data-dismiss="modal" id='successfullBtn'><span>OK</span></button>
	      		</div>
	      	</div>
	      </div>
      </div>     
    
    <!--modal for scheudule details-->                
    <div class="modal fade" id="scheduleDetails" aria-hidden="true" aria-labelledby="ScheduleDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="ScheduleDetailsModal">Schedule Details</h6>
              <button type="button" class="close" aria-label="Close" data-dismiss="modal"><small>x</small></button>
            </div>
            <div class="modal-body">
                <div id="eventList"></div>
          </div>
        </div>
      </div>
    </div>
<!--delete modal confirmation-->
<div id="dlteModalConfirmation" class="modal fade">
	<div class="modal-dialog dlte-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box">
					<i class="fa fa-trash"></i>
				</div>						
				<h4 class="modal-title w-100">Are you sure?</h4>	
        <div id="delete-message"></div>
			</div>
			<div class="modal-body">
				<p>Do you really want to delete these records? This process cannot be undone.</p>
			</div>
			<div class="modal-footer justify-content-center">
        <input type="hidden" id="del_id" name="del_id">
        <input type="hidden" id="tdate" name="tdate">
        <input type="hidden" id="tcode" name="tcode">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger" id="confDlte" name="confDlte">Delete</button>
			</div>
		</div>
	</div>
</div>
    <!--Confirm deleted successfully-->
    <div id="confirmDeleteModal" class="modal fade">
	      <div class="modal-dialog modal-sucConf">
	      	<div class="modal-content">
	      		<div class="modal-header justify-content-center">
	      			<div class="icon-box">
	      				<i class="fa fa-check"></i>
	      			</div>
	      		</div>
	      		<div class="modal-body text-center">
	      			<h4>Deleted!</h4>	
	      			<p>Schedule has been deleted successfully.</p>
	      			<button class="btn btn-info" data-dismiss="modal" id='deltBtn'><span>OK</span></button>
	      		</div>
	      	</div>
	      </div>
      </div>     

<!-- edit modal -->
<div class="modal fade" id="editDetailsModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Edit Today's Schedule</h5>
          </div>
          <div class="modal-body">
          <form id="editDetailsForm">
            <div class="img-container">
              <div class="row">
                <div class="col-sm-12">
                <span id='estatus-message'></span>
                  <div class="form-group">
                    <label for="editName">Name</label>
                    <input type="hidden" id="rod_id" name="rod_id">
                    <select class='form-control' type='text' name='editName' id='editName' required>
                      <option value="">--select--</option>
                      <?php
                        $sqlrod = $conn->query("SELECT * FROM `docfile` WHERE `specialization` ='ROD' AND `name` != 'REFERRAL'");
                        while ($drow = $sqlrod->fetch_assoc()) {
                          $lname = $drow['lastname'];
                          $fname = $drow['firstname'];
                          $mname = $drow['middlename'];
                          $code = $drow['code'];
                          echo "<option value='".$code."|".$lname."|".$fname."|".$mname."'>$lname, $fname ".$mname[0]."</option>";
                        }
                      ?>
                     </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="editSpec">Specialization</label>
                    <input class="form-control" type="text" name="editSpec" id="editSpec" value="ROD" readonly></input>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="editStation">Station</label>
                    <select class="form-control" type="text" name="editStation" id="editStation" required>
                      <option value="">--select--</option>
                      <option value="1|ER">ER</option>
                      <option value="2|NS1/OR-DR/NS4">NS1/OR-DR/NS4</option>
                      <option value="3|NS2/RDU/NS3">NS2/RDU/NS3</option>
                      <option value="4|ICU/NS5/NS6">ICU/NS5/NS6</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="editStartDate">Schedule Date</label>
                    <input class="form-control" type="date" name="editStartDate" id="editStartDate" required>
                   </div>
                </div>
              </div>
              <div class="row" style="padding-bottom:20px">
                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="editStartTime">Schedule Time</label> 
                    <input class="form-control" type="time" name="editStartTime" id="editStartTime" required>
                  </div>
                </div>
                <div class="col-sm-2" style="text-align:center; padding-top:35px;">
                  <label for="to">to</label>
                </div>
                <div class="col-sm-5" style="margin-top:24px">
                  <div class="form-group">
                    <label for="editEndTime"></label>
                    <input class="form-control" type="time" name="editEndTime" id="editEndTime" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Close</button>
              <button type="submit" class="btn btn-primary" id="saveEditBtn" name="saveEditBtn"><i class="fa fa-paper-plane"></i> Save</button>
            </div>
        </form>
        </div>
        </div>
      </div>
    </div>
    <!--Confirm Save Edited successfully-->
    <div id="successEditModal" class="modal fade">
	      <div class="modal-dialog modal-sucConf">
	      	<div class="modal-content">
	      		<div class="modal-header justify-content-center">
	      			<div class="icon-box">
	      				<i class="fa fa-check"></i>
	      			</div>
	      		</div>
	      		<div class="modal-body text-center">
	      			<h4>Success</h4>	
	      			<p>Details updated successfully.</p>
	      			<button class="btn btn-success" data-dismiss="modal" id='successEditBtn'><span>OK</span></button>
	      		</div>
	      	</div>
	      </div>
      </div>     
    <!-- edit modal -->