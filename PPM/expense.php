<?php
include 'prop/connect/link.php';
ini_set('display_errors','off');
?>
<!doctype html> 
<html class="no-js" lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Expense & Charge Meds</title>
<link href="prop/assets/logo/bl.png" rel="icon">
<link rel="stylesheet" href="prop/assets/plugin/datatables/responsive.dataTables.min.css">
<link rel="stylesheet" href="prop/assets/plugin/datatables/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="prop/assets/css/my-task.style.min.css">
<link rel="stylesheet" href="prop/assets/css/expensemodule.css">
</head>
<body>
<div id="mytask-layout" class="theme-indigo"> 
    <div class="main px-lg-4 px-md-4">
        <div class="maindisplay">
            <div class="body d-flex py-lg-3 py-md-2" style="border:none; display:flex; justify-content: center; align-items:center; height:100vh">
                <div class="exp_div">
                  <form class="form">
                    <div class="banner"></div>
                    <label class="title">Expense Charge Meds</label>
                    <p class="description"></p>
                        <div class="radio-tile-group">
                        <div class="col-6">
                          <select type="text" class="form-select text-center" id="selectedtype">
                              <option value="">--select--</option>
                              <option value="expense">Expense</option>
                              <option value="charge">Charge</option>
                          </select>
                        </div>
                          <span id="errormsg"></span>
                        </div>
                        <div class="benefits">
                      <span>Select Date</span>
                      <ul>
                        <li>
                          <span class="dtspan"> From</span>
                          <input type="date" class="form-control" id="datefrom" value="<?=date('Y-m-01');?>">
                        </li>
                        <li>
                          <span class="dtspan"> End</span>
                          <input type="date" class="form-control" id="dateto" value="<?=date('Y-m-t');?>">
                        </li>
                      </ul>
                    </div>
                    <div class="modal-footer">
                        <button class="mybttn text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 text-center mr-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 inline-flex items-center" type="submit" onclick="proceedToNext()" id="mybutton">PROCEED</button>
                    </div>
                  </form>
                </div>
            </div>
        </div> 
    </div>
</div>
</div>
<!-- scripts -->
<script src="prop/assets/bundles/libscripts.bundle.js"></script>
<script src="prop/assets/bundles/dataTables.bundle.js"></script>
<script>
function proceedToNext() {
    var selectedtype = $("#selectedtype").val();
    var datefrom = $("#datefrom").val();
    var dateto = $("#dateto").val();
    if (!selectedtype) {
        alert("Please select type.");
        return
    } else {
        window.open('expense_meds.php?type=' + selectedtype + "&datefrom=" + datefrom + "&dateto=" + dateto);
    }
}
</script>
</body>
</html> 