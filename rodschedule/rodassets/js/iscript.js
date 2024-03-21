var calendar;
var Calendar = FullCalendar.Calendar;
var events = [];

$(function() {
    
    $.ajax({
        url: "rodassets/php/get-schedule.php",
        type: "GET",
        success: function(data) {
            var scheds = $.parseJSON(data);
            Object.keys(scheds).forEach(k => {  
              var row = scheds[k];
              var id = row.id;
              var stid = row.station_id; 
              var lname = row.lastname;
              var fname = row.firstname;
              var dateStart = row.start_datetime;
              var dateEnd = row.end_datetime;
              var fnm = fname.substr(0,1);
              var name = lname + ", " + fnm + ".";
              var existingEvent = events.find(e => e.description === stid && e.start === dateStart);
              if (existingEvent) {
                existingEvent.title += '/ ' + name;
                existingEvent.id = id + '/' + existingEvent.id;
              } else {
                events.push({
                  id: id,
                  title: name,
                  start: dateStart,
                  end: dateEnd,
                  description: stid
                });
              }
            });
            
            calendar = new Calendar(document.getElementById('calendar'), {
                headerToolbar: {
                  left: 'title',
                  center: '',
                  right: 'prev,next today printButton'

                },
                events: events,
                displayEventTime: false,
                //navLinks: true,
                selectable: true,
                selectMirror: true,
                showNonCurrentDates: false,
                eventOrder: "description",
                eventColor: '#f2330d',
                dayMaxEvents: true,

                eventRender: function(info) {
                  info.el.querySelector('.fc-day-number').addEventListener('click', function(e) {
                    e.preventDefault();
                  });
                },
                navLinks: false,
                
                dateClick: function (info){
                  $('#assgn_start_date').val(moment(info.dateStr).format('YYYY-MM-DD'));
                  $('#startTime').val(moment("2023-02-07 07:00:00", "YYYY-MM-DD HH:mm:ss").format('HH:mm:ss'));
                  $('#endTime').val(moment("2023-02-07 12:00:00", "YYYY-MM-DD HH:mm:ss").format('HH:mm:ss'));
                  $('#event_entry_modal').modal('show');
                },
                
                eventClick: function(info) {
                  var _details = $('#scheduleDetails');
                  var options = { hour: 'numeric', minute: 'numeric', hour12: true };
                  var id = info.event.id;
                  var ids = id.split('/');
                  var eventsWithIds = ids.map(i => scheds[i]);
              
                  var _html = '';
                  eventsWithIds.forEach((event, index) => {
                    _html += `
                    <div class="card teacher-card mb-3">
                      <div class="card-body d-flex teacher-fulldeatil">
                        <div class="profile-teacher pe-xl-3 pe-md-2 pe-sm-3 pe-3 text-center" style="width: 200px">
                          <a href="#">
                            <img src="rodassets/images/lg/doctor.png" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                          </a>
                          <div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
                            <h6 class="mb-0 fw-bold d-block fs-6">${event.specialization}</h6>
                            <span class="text-muted small">${event.code}</span>
                          </div>
                        </div>
                        <div class="teacher-info border-start ps-xl-4 ps-md-4 ps-sm-4 ps-4 w-100">
                          <h6 class="mb-0 mt-2 fw-bold d-block fs-6">DR. ${event.firstname} ${event.middlename[0]}. ${event.lastname}</h6>
                          <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted">ROD</span>
                          <div class="row g-2 pt-2">
                            <div class="col-md-12">
                              <div class="d-flex align-items-center">
                                <i class="icofont-ui-touch-phone"></i>
                                <p><strong>Date:</strong><span style="padding-left: 10px;">${moment(event.start_datetime).format('MMMM DD, YYYY')}</span></p>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="d-flex align-items-center">
                                <i class="icofont-email"></i>
                                <p><strong>Time:</strong><span style="padding-left: 10px;">${new Date("1970-01-01 " + event.start_time).toLocaleTimeString([], options)} to ${new Date("1970-01-01 " + event.end_time).toLocaleTimeString([], options)}</span></p>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="d-flex align-items-center">
                                <i class="icofont-birthday-cake"></i>
                                <p><strong>Assigned Station:</strong><span style="padding-left: 10px;">${event.station_name}</span></p>
                              </div>
                            </div> 
                            <div class='row'>                                      
                              <div class="btn-group-sm" style="position: relative; margin-left:200px;">
                                <input type='hidden' id='tcode' value='${(event.code)}'>
                                <input type='hidden' id='tdate' value='${moment(event.start_datetime).format('YYYY-MM-DD')}'>
                                <button type='submit' class='btn btn-info edtButton' data-id=${event.id}><i class='fa fa-edit'></i></button>
                                <button type='submit' class='btn btn-danger delButton' data-id=${event.id}><i class='fa fa-trash'></i></button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                              
                    `;
                  });
                  _details.find('#eventList').html(_html);
                  _details.modal('show');

                  $('.delButton').click(function() {
                    var id = $(this).attr('data-id');
                    var tcode= $("#tcode").val();
                    var tdate= $("#tdate").val();
                    var _delt = $("#dlteModalConfirmation");
                    _delt.find('[name="del_id"]').val(id);
                    _delt.find('[name="tdate"]').val(tdate);
                    _delt.find('[name="tcode"]').val(tcode);
                    _delt.modal('show');
                  });
                
                  $('#confDlte').click(function(){
                    var del_id = $("#del_id").val();
                    var tdate = $("#tdate").val();
                    var tcode = $("#tcode").val();
                    $.ajax({
                        type: "POST",
                        url: "rodassets/php/delete_schedule.php",
                        data: { del_id: del_id, tdate:tdate, tcode:tcode },
                        success: function(data) {
                            if(data == 200) {
                                $("#confirmDeleteModal").modal('show');
                                $("#scheduleDetails").modal('hide');
                                $("#dlteModalConfirmation").modal('hide');
                                $("#deltBtn").off('click').click(function(){
                                    $("#deltModal").modal('hide');
                                    location.reload();
                                });
                            } else {
                                alert("Error: " + data);
                            }
                        }
                    });
                  });
                  // edit btn click
                  $('.edtButton').on('click', function() {
                    var eventId = $(this).data('id');
                    var event = scheds[eventId];
                    $('#rod_id').val(eventId);
                    $('#editName').val(event.code + "|" + event.lastname + "|" + event.firstname + "|" + event.middlename);
                    $('#editStartDate').val(moment(event.start_datetime).format('YYYY-MM-DD'));
                    $('#editStation').val(event.station_id + "|" + event.station_name);
                    $('#editStartTime').val(event.start_time);
                    $('#editEndTime').val(event.end_time);
                    $('#editDetailsModal').modal('show');
                  });
                  //save edited ROD details
                  $('#saveEditBtn').click(function(e){
                    e.preventDefault();
                    var eId = $("#rod_id").val();
                    var eName = $("#editName").val();
                    var eSpec = $("#editSpec").val();
                    var eStartDate = $("#editStartDate").val();
                    var eStation = $("#editStation").val();
                    var eStartTime = $("#editStartTime").val();
                    var eEndTime = $("#editEndTime").val();
                    var esubmit = $("#editEndTime").val();
                    $.ajax({
                        type: "POST",
                        url: "rodassets/php/save_edited_details.php",
                        data: { 
                                eId: eId,
                                eName: eName,
                                eSpec: eSpec,
                                eStartDate: eStartDate,
                                eStation: eStation,
                                eStartTime: eStartTime,
                                eEndTime: eEndTime,
                                esubmit: esubmit
                              },
                        success: function(data) {
                          $("#estatus-message").html(data);
                        }
                    });
                  });
                  
                },
                //print button
                customButtons: {
                  printButton: {
                    text: 'Print',
                    click: function() {
                      var rodname = $('#rodname').val();
                      // Generate a PDF file using FPDF
                      var selectedDate = moment(calendar.getDate()).format('YYYY-MM-DD');
                      var selectedMonth = moment(selectedDate).format('MM');
                      var selectedYear = moment(selectedDate).format('YYYY');
                      window.open('rodassets/form/calendarphp.php?month=' + selectedMonth + '&year=' + selectedYear + '&rod=' + rodname,'_blank');
                    }
                  }
                },
                
            });
           // Fetch new date from PHP script and set it in calendar
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var newAddDate = this.responseText;
                    var newAddEvent = new Date(newAddDate);
                    calendar.gotoDate(newAddEvent);
                }
            };
            xhr.open("GET", "rodassets/php/get_newaddeddate.php", true);
            xhr.send();
           
            calendar.render();
        },
    });
    //add function
    $("#save_rod_sched").click(function(event){
      event.preventDefault();
      var assignname = $("#assignname").val();
      var docspec = $("#docspec").val();
      var sched_station = $("#sched_station").val();
      var assgn_start_date = $("#assgn_start_date").val();
      var startSetTime = $("#startTime").val();
      var endSetTime = $("#endTime").val();
      var submit = $("#save_rod_sched").val();
    
      $.ajax({
        type: "POST",
        url: "rodassets/php/save_schedule.php", 
        data: {
          assignname: assignname,
          docspec: docspec,
          sched_station: sched_station,
          assgn_start_date: assgn_start_date,
          startSetTime: startSetTime,
          endSetTime: endSetTime,
          submit: submit
        },
        success: function(data){
          $("#status-message").html(data);
        }
      });
    });
    //end function
});
