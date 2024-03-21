</div>
</div>
<!-- Jquery Core Js -->
<script src="<?=base_url();?>design/bundles/libscripts.bundle.js"></script>
<script src="<?=base_url();?>design/js/select2.min.js"></script>

<!-- Plugin Js-->
<script src="<?=base_url();?>design/bundles/dataTables.bundle.js"></script>
<script src="<?=base_url();?>design/bundles/apexcharts.bundle.js"></script>

<!-- Jquery Page Js -->
<script src="<?=base_url();?>design/js/template.js"></script>
<script src="<?=base_url();?>design/js/page/hr.js"></script>

 <script>
 	function sbview(){
const sidebar = document.querySelector('.sidebar');
if(sidebar.style.transform == 'translateX(-100%)'){sidebar.style.transform = 'translateX(0)';}
else{sidebar.style.transform = 'translateX(-100%)';}
}


const sidebar = document.querySelector('.sidebar');
const mediaQuery = window.matchMedia("(min-width: 1275.99px)");
const handleMediaQueryChange = (mediaQuery) => {
if (mediaQuery.matches) {sidebar.style.transform = 'translateX(0)';} 
else {sidebar.style.transform = 'translateX(-100%)';}
}

mediaQuery.addListener(handleMediaQueryChange);
handleMediaQueryChange(mediaQuery);
 	                                        function myFunction4() {
                                          window.open('../../../2021codes/TestCodes/DateCalculator.php', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=250');
                                        }
                                        </script>
<script>
	$(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
      });

	$(document).ready(function() {
		$('#patient-table')
			.addClass( 'wrap' )
			.dataTable( {
				responsive: true,
				columnDefs: [
					{ targets: [-1, -3], className: 'dt-body-right' }
				],
				sort: false
			})
	});
	$(document).ready(function() {
		$('#clients-table')
			.addClass( 'wrap' )
			.dataTable( {
				responsive: true,
				columnDefs: [
					{ targets: [-1, -3], className: 'dt-body-right' }
				],
				sort: false
			})
	});
	$(document).ready(function() {
		$('#employee-table')
			.addClass( 'wrap' )
			.dataTable( {
				responsive: true,
				sort: false,
				columnDefs: [
					{ targets: [-1, -3], className: 'dt-body-right' }
				]
			})
	});
	$(document).ready(function() {
		$('#result-table')
			.addClass( 'wrap' )
			.dataTable( {
				responsive: true,
				columnDefs: [
					{ targets: [-1, -3], className: 'dt-body-right' }
				]
			})
	});
	$(document).ready(function() {
		$('#meds-table')
			.addClass( 'wrap' )
			.dataTable( {
				responsive: true,
				columnDefs: [
					{ targets: [-1, -3], className: 'dt-body-right' }
				]
			})
	});
	$(document).ready(function() {
		$('#pf-table')
			.addClass( 'wrap' )
			.dataTable( {
				responsive: true,
				columnDefs: [
					{ targets: [-1, -3], className: 'dt-body-right' }
				]
			})
	});
	$(document).ready(function() {
		$('#charged-table')
			.addClass( 'wrap' )
			.dataTable( {
				responsive: true,
				columnDefs: [
					{ targets: [-1, -3], className: 'dt-body-right' }
				]
			})
	});
</script>
<script>
	$(document).ready(function(){
		$('#province').change(function(){
			var stateId = $(this).val();
			$.ajax({
				url:'<?=base_url();?>index.php/pages/getCity',
				type:'post',
				data: {id: stateId},
				dataType:'json',
				success: function(response){
					var select = document.getElementById("city");
					select.replaceChildren();
					for (var i = 0; i < response.length; i++) {
						var optn = response[i]['id'];
						var optn1 = response[i]['city'];
						var el = document.createElement("option");
						el.textContent = optn1;
						el.value = optn;
						select.appendChild(el);
					}
				}
			});
		});
		$('#city').change(function(){
			var cityId = $(this).val();
			$.ajax({
				url:'<?=base_url();?>index.php/pages/getBarangay',
				type:'post',
				data: {id: cityId},
				dataType:'json',
				success: function(response){
					var select = document.getElementById("barangay");
					select.replaceChildren();
					for (var i = 0; i < response.length; i++) {
						var optn = response[i]['id'];
						var optn1 = response[i]['barangay'];
						var el = document.createElement("option");
						el.textContent = optn1;
						el.value = optn;
						select.appendChild(el);
					}
				}
			});
			$.ajax({
				url:'<?=base_url();?>index.php/pages/getZipCode',
				type:'post',
				data: {id: cityId},
				dataType:'json',
				success: function(response){
					document.getElementById("zipcode").value=response[0]['ZIP_CODE'];
				}
			});
		});
	});
	$('.editAdmitTime').click(function(){
		var id=$(this).data('id');		
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_admission',
			type:'post',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				document.getElementById('admit_caseno').value = id;				
				document.getElementById("admit_date").value=response[0]['dateadmit'];
				document.getElementById("admit_time").value=response[0]['timeadmitted'];
				document.getElementById("contactperson").value=response[0]['middlenamed'];
				document.getElementById("contactpersonno").value=response[0]['contactno'];
				document.getElementById("contactpersonrelation").value=response[0]['relationship'];
				document.getElementById("father").value=response[0]['lastnamed'];
				document.getElementById("mother").value=response[0]['firstnamed'];
				var select = document.getElementById("civilstatus");
				var optn = response[0]['stat1'];
				var optn1 = response[0]['stat1'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);

				var select = document.getElementById("religion");
				var optn = response[0]['religion'];
				var optn1 = response[0]['religion'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);

				var select = document.getElementById("nationality");
				var optn = response[0]['notify'];
				var optn1 = response[0]['notify'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);
				
				var select = document.getElementById("membership");
				var optn = response[0]['membership'];
				if(optn=="phic-med"){
					var optn1 = "YES";
				}else{
					var optn1 = "NO";
				}
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);

				var select = document.getElementById("membertype");
				var optn = response[0]['type'];
				var optn1 = response[0]['type'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);

				var select = document.getElementById("paymentmode");
				var optn = response[0]['paymentmode'];
				var optn1 = response[0]['paymentmode'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);



			}
		});
	});
	$('.editAdmitTimeRDU').click(function(){
		var id=$(this).data('id');		
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_admission',
			type:'post',
			data: {id:id},
			dataType: 'json',
			success: function(response){				
				document.getElementById('admit_caseno_time').value = id;
				document.getElementById("admit_date").value=response[0]['dateadmit'];
				document.getElementById("admit_time").value=response[0]['timeadmitted'];
				document.getElementById("contactperson").value=response[0]['middlenamed'];
				document.getElementById("contactpersonno").value=response[0]['contactno'];
				document.getElementById("contactpersonrelation").value=response[0]['relationship'];
				document.getElementById("father").value=response[0]['lastnamed'];
				document.getElementById("mother").value=response[0]['firstnamed'];
				var select = document.getElementById("civilstatus");
				var optn = response[0]['stat1'];
				var optn1 = response[0]['stat1'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);

				var select = document.getElementById("religion");
				var optn = response[0]['religion'];
				var optn1 = response[0]['religion'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);

				var select = document.getElementById("nationality");
				var optn = response[0]['notify'];
				var optn1 = response[0]['notify'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);
				
				var select = document.getElementById("membership");
				var optn = response[0]['membership'];
				if(optn=="phic-med"){
					var optn1 = "YES";
				}else{
					var optn1 = "NO";
				}
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);

				var select = document.getElementById("membertype");
				var optn = response[0]['type'];
				var optn1 = response[0]['type'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);

				var select = document.getElementById("paymentmode");
				var optn = response[0]['paymentmode'];
				var optn1 = response[0]['paymentmode'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);



			}
		});
	});
	$('.editAdmitTimemrd').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		$(".modal-body #admit_caseno").val(id[0]);
		$(".modal-body #admit_patientidno").val(id[1]);
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_admission',
			type:'post',
			data: {id:id[0]},
			dataType: 'json',
			success: function(response){
				document.getElementById("admit_date").value=response[0]['dateadmit'];
				document.getElementById("admit_time").value=response[0]['timeadmitted'];
				document.getElementById("contactperson").value=response[0]['middlenamed'];
				document.getElementById("contactpersonno").value=response[0]['contactno'];
				document.getElementById("contactpersonrelation").value=response[0]['relationship'];
				document.getElementById("father").value=response[0]['lastnamed'];
				document.getElementById("mother").value=response[0]['firstnamed'];
				var select = document.getElementById("civilstatus");
				var optn = response[0]['stat1'];
				var optn1 = response[0]['stat1'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);

				var select = document.getElementById("religion");
				var optn = response[0]['religion'];
				var optn1 = response[0]['religion'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);

				var select = document.getElementById("nationality");
				var optn = response[0]['notify'];
				var optn1 = response[0]['notify'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});
	$(document).on('click','.readmit',function(){
		var data=$(this).data('id');
		$(".modal-body #readmitpatientidno").val(data);
	});
	$(document).on('click','.stillinreadmit',function(){
		var data=$(this).data('id');
		$(".modal-body #stillinreadmitpatientidno").val(data);
	});
	$('.editAdmitRoom').click(function(){
		var data=$(this).data('id');
		var my_id=data.split('_');
		$(".modal-body #admit_caseno").val(my_id[0]);
		$(".modal-body #oldroom").val(my_id[1]);
	});
	$('.editHMO').click(function(){
		var data=$(this).data('id');
		var my_id=data.split('_');
		$(".modal-body #admit_caseno").val(my_id[0]);
		$(".modal-body #oldhmo").val(my_id[1]);
		$(".modal-body #oldloa").val(my_id[2]);
		var select = document.getElementById("newhmo");
					var optn = my_id[1];
					var optn1 = my_id[1];
					var el = document.createElement("option");
					el.selected = "selected";
					el.textContent = optn1;
					el.value = optn;
					select.appendChild(el);
	});
	$('.editAP').click(function(){
		var data=$(this).data('id');
		var myid = data.split('_');
		$('.modal-body #admit_caseno').val(myid[0]);
		var id=myid[1];
		var ad=myid[2];
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_doctor',
			type:'post',
			data: {id: id},
			dataType:'json',
			success: function(response){
					var select = document.getElementById("admit_attending");
					var optn = response[0]['code'];
					var optn1 = response[0]['name'];
					var el = document.createElement("option");
					el.selected = "selected";
					el.textContent = optn1;
					el.value = optn;
					select.appendChild(el);
			}
		});
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_doctor',
			type:'post',
			data: {id: ad},
			dataType:'json',
			success: function(response){
					var select = document.getElementById("admit_admitting_doctor");
					var optn = response[0]['code'];
					var optn1 = response[0]['name'];
					var el = document.createElement("option");
					el.selected = "selected";
					el.textContent = optn1;
					el.value = optn;
					select.appendChild(el);
			}
		});
	});
	$('.editAD').click(function(){
		var data=$(this).data('id');
		var myid = data.split('_');
		$('.modal-body #admit_caseno').val(myid[0]);
		var id=myid[1];
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_doctor',
			type:'post',
			data: {id: id},
			dataType:'json',
			success: function(response){
				var select = document.getElementById("admit_admitting");
				var optn = response[0]['code'];
				var optn1 = response[0]['name'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});
	$('.editAR').click(function(){
		var data=$(this).data('id');
		var myid = data.split('_');
		$('.modal-body #admit_caseno').val(myid[0]);
		var id=myid[1];
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_doctor',
			type:'post',
			data: {id: id},
			dataType:'json',
			success: function(response){
				var select = document.getElementById("admit_ar_attending");
				var optn = response[0]['code'];
				var optn1 = response[0]['name'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});
	$('.editpatientprofile').click(function(){
		var id=$(this).data('id');
		$('.modal-body #editpatientidno').val(id);
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetchSinglePatient',
			type:'post',
			data: {id: id},
			dataType:'json',
			success: function(response){
				document.getElementById("plastname").value = response[0]['lastname'];
				document.getElementById("pfirstname").value = response[0]['firstname'];
				document.getElementById("pmiddlename").value = response[0]['middlename'];
				document.getElementById("psuffix").value = response[0]['suffix'];
				document.getElementById("pbirthdate").value = response[0]['dateofbirth'];
				document.getElementById("pdiscountid").value = response[0]['discountid'];
				document.getElementById("pcontactno").value = response[0]['patientcontactno'];
				if(response[0]['sex']=="M"){
					var sex="Male";
				}else{
					var sex="Female";
				}
				var select = document.getElementById("pgender");
				var optn = response[0]['sex'];
				var optn1 = sex;
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);

				var select = document.getElementById("pdiscounttype");
				var optn = response[0]['discounttype'];
				var optn1 = response[0]['discounttype'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});
	$('.editpatientprofilemrd').click(function(){
		var data=$(this).data('id');
		var id = data.split('_');
		$('.modal-body #editpatientidno').val(id[0]);
		$('.modal-body #editcaseno').val(id[1]);
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetchSinglePatient',
			type:'post',
			data: {id: id[0]},
			dataType:'json',
			success: function(response){
				document.getElementById("plastname").value = response[0]['lastname'];
				document.getElementById("pfirstname").value = response[0]['firstname'];
				document.getElementById("pmiddlename").value = response[0]['middlename'];
				document.getElementById("psuffix").value = response[0]['suffix'];
				document.getElementById("pbirthdate").value = response[0]['dateofbirth'];
				document.getElementById("pdiscountid").value = response[0]['discountid'];
				document.getElementById("pcontactno").value = response[0]['patientcontactno'];
				if(response[0]['sex']=="M"){
					var sex="Male";
				}else{
					var sex="Female";
				}
				var select = document.getElementById("pgender");
				var optn = response[0]['sex'];
				var optn1 = sex;
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);

				var select = document.getElementById("pdiscounttype");
				var optn = response[0]['discounttype'];
				var optn1 = response[0]['discounttype'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});
	$('.editAddress').click(function(){
		var id=$(this).data('id');
		$('.modal-body #updatepatientidno').val(id);
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_address',
			type:'post',
			data: {id: id},
			dataType:'json',
			success: function(response){
				document.getElementById("street").value = response[0]['street'];
				document.getElementById("zipcode").value = response[0]['zipcode'];
				var select = document.getElementById("province");
				var optn = response[0]['province'];
				var optn1 = response[0]['province'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);
				var select = document.getElementById("city");
				var optn = response[0]['municipality'];
				var optn1 = response[0]['municipality'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);
				var select = document.getElementById("barangay");
				var optn = response[0]['barangay'];
				var optn1 = response[0]['barangay'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});
	$('.editAddressmrd').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		$('.modal-body #updatepatientidno').val(id[0]);
		$('.modal-body #updatecaseno').val(id[1]);
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_address',
			type:'post',
			data: {id: id[0]},
			dataType:'json',
			success: function(response){
				document.getElementById("street").value = response[0]['street'];
				document.getElementById("zipcode").value = response[0]['zipcode'];
				var select = document.getElementById("province");
				var optn = response[0]['province'];
				var optn1 = response[0]['province'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);
				var select = document.getElementById("city");
				var optn = response[0]['municipality'];
				var optn1 = response[0]['municipality'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);
				var select = document.getElementById("barangay");
				var optn = response[0]['barangay'];
				var optn1 = response[0]['barangay'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});
	$('.editEmployee').click(function(){
		var id=$(this).data('id');
		$('.modal-body #emp_id').val(id);
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_employee',
			type:'post',
			data: {id: id},
			dataType:'json',
			success: function(response){
				document.getElementById("emp_lastname").value = response[0]['lastname'];
				document.getElementById("emp_firstname").value = response[0]['firstname'];
				document.getElementById("emp_middlename").value = response[0]['middlename'];
				document.getElementById("emp_birthdate").value = response[0]['birthdate'];
				document.getElementById("emp_address").value = response[0]['address'];
				var select = document.getElementById("emp_gender");
				var optn = response[0]['gender'];
				var optn1 = response[0]['gender'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);
				document.getElementById("emp_position").value = response[0]['position'];
				document.getElementById("emp_salary").value = response[0]['salary'];
				document.getElementById("emp_sss").value = response[0]['sss'];
				document.getElementById("emp_tin").value = response[0]['tin'];
				document.getElementById("emp_phic").value = response[0]['philhealth'];
				document.getElementById("emp_hdmf").value = response[0]['pagibig'];
			}
		});
	});
	$('.newEmployee').click(function(){
				document.getElementById("emp_id").value = '';
				document.getElementById("emp_lastname").value = '';
				document.getElementById("emp_firstname").value = '';
				document.getElementById("emp_middlename").value = '';
				document.getElementById("emp_birthdate").value = '';
				document.getElementById("emp_address").value = '';
				document.getElementById("emp_position").value = '';
				document.getElementById("emp_salary").value = '';
				document.getElementById("emp_sss").value = '';
				document.getElementById("emp_tin").value = '';
				document.getElementById("emp_phic").value = '';
				document.getElementById("emp_hdmf").value = '';
				var select = document.getElementById("emp_gender");
				select.replaceChildren();
				var optn = 'Male';
				var optn1 = 'Male';
				var el = document.createElement("option");
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);
				var optn = 'Female';
				var optn1 = 'Female';
				var el = document.createElement("option");
				el.textContent = optn1;
				el.value = optn;
				select.appendChild(el);

	});
</script>
<script type="text/javascript">
	$('.editAccount').click(function(){
		var id = $(this).data('id');
		document.getElementById("user_id").value=id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_employee',
			type:'post',
			data:{id:id},
			dataType:'json',
			success:function(response){
				if(response.length>0) {
					document.getElementById('username').value = response[0]['username'];
					document.getElementById('password').value = response[0]['password'];
				}
			}
		});
	});
	$('.editDoctorAccount').click(function(){
		var id = $(this).data('id');
		document.getElementById("doctor_id").value=id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_account_doctor',
			type:'post',
			data:{id:id},
			dataType:'json',
			success:function(response){
				if(response.length>0) {
					document.getElementById('doc_user').value = response[0]['username'];
					document.getElementById('doc_pass').value = response[0]['password'];
				}
			}
		});
	});
	$('.editAccess').click(function(){
		var data = $(this).data('id');
		var empid = data.split('_');
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_access',
			type:'post',
			data:{id:empid[0],station:empid[1]},
			dataType:'json',
			success:function(response){
				if(response.length>0) {
					document.getElementById('access').value = response[0]['Access'];
					document.getElementById('userid').value = response[0]['empid'];
					document.getElementById('autono').value = response[0]['autono'];
				}
			}
		});
	});
	$('.editDoctorAccess').click(function(){
		var data = $(this).data('id');
		var empid = data.split('_');
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_doctor_access',
			type:'post',
			data:{id:empid[0],station:empid[1]},
			dataType:'json',
			success:function(response){
				if(response.length>0) {
					document.getElementById('doc_access').value = response[0]['Access'];
					document.getElementById('docid').value = response[0]['empid'];
					document.getElementById('docautono').value = response[0]['autono'];
				}
			}
		});
	});
	$('.editDoctor').click(function(){
		var id = $(this).data('id');
		document.getElementById("doc_id").value=id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_doctor',
			type:'post',
			data:{id:id},
			dataType:'json',
			success:function(response){
				if(response.length>0) {
					document.getElementById('doc_lastname').value = response[0]['lastname'];
					document.getElementById('doc_firstname').value = response[0]['firstname'];
					document.getElementById('doc_middlename').value = response[0]['middlename'];
					document.getElementById('doc_suffix').value = response[0]['ext'];
					var select = document.getElementById("doc_specialization");
					var optn = response[0]['specialization'];
					var optn1 = response[0]['specialization'];
					var el = document.createElement("option");
					el.selected = "selected";
					el.textContent = optn1;
					el.value = optn;
					select.appendChild(el);
					document.getElementById('doc_tin').value = response[0]['tinbir'];
					document.getElementById('doc_pf').value = response[0]['PF'];
					document.getElementById('doc_rebates').value = response[0]['rebates'];
					document.getElementById('doc_phicacc').value = response[0]['phicacc'];
					document.getElementById('doc_email').value = response[0]['emailaddress'];
					document.getElementById('doc_licenseno').value = response[0]['licenseno'];
					document.getElementById('doc_ptrno').value = response[0]['ptrno'];
					document.getElementById('doc_s2no').value = response[0]['s2no'];
				}
			}
		});
	});
	$('.addDoctor').click(function(){
		document.getElementById("doci_id").value='';
					document.getElementById('doc_lastname').value = '';
					document.getElementById('doc_firstname').value = '';
					document.getElementById('doc_middlename').value = '';
					document.getElementById('doc_middlename').value = '';
					document.getElementById('doc_specialization').value = '';
					document.getElementById('doc_tin').value = '';
					document.getElementById('doc_pf').value = '';
					document.getElementById('doc_rebates').value = '';
					document.getElementById('doc_phicacc').value = '';
					document.getElementById('doc_email').value = '';
					document.getElementById('doc_licenseno').value = '';
					document.getElementById('doc_ptrno').value = '';
					document.getElementById('doc_s2no').value = '';
	});

	$('.editRoom').click(function(){
		var data = $(this).data('id');
		var id=data.split('_');
		document.getElementById('station_id').value = id[1];
		document.getElementById('room_id').value = id[0];
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_room',
			type:'post',
			data:{id:id[0]},
			dataType:'json',
			success: function(response){
				document.getElementById('room_desc').value = response[0]['room'];
				document.getElementById('room_rates').value = response[0]['roomrates'];
				document.getElementById("room_credit").value=response[0]['pfadmit'];
				document.getElementById("room_kit").value=response[0]['pfattend'];
				var selectBrand = document.getElementById("room_type");
				var optn = response[0]['roomprop'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				selectBrand.appendChild(el);

			}
		});
	});
	$('.addRoom').click(function(){
		var id=$(this).data('id');
		document.getElementById('station_id').value = id;
		document.getElementById('room_id').value = '';
		document.getElementById('room_desc').value = '';
		document.getElementById('room_rates').value = '';
		document.getElementById("room_credit").value='';
		document.getElementById("room_kit").value='';
	});
	$('.editManageHMO').click(function(){
		var id = $(this).data('id');
		document.getElementById('hmo_id').value = id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_hmo',
			type:'post',
			data:{id:id},
			dataType:'json',
			success: function(response){
				document.getElementById('hmoname').value = response[0]['companyname'];
				document.getElementById('hmoaddress').value = response[0]['Address'];
				var selectBrand = document.getElementById("hmotype");
				var optn = response[0]['type'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				selectBrand.appendChild(el);
			}
		});
	});
	$('.addHMO').click(function(){
		document.getElementById('hmo_id').value = '';
		document.getElementById('hmoaddress').value = '';
		document.getElementById('hmoname').value = '';
	});
	$('.addDiagnostics').click(function(){
		document.getElementById('diag_id').value = '';
		document.getElementById('diag_cash').value = '';
		document.getElementById('diag_charge').value = '';
		document.getElementById('diag_desc').value = '';
	});
	$('.editDiagnostics').click(function(){
		var id = $(this).data('id');
		document.getElementById('diag_id').value = id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_diagnostic',
			type:'post',
			data:{id:id},
			dataType:'json',
			success: function(response){
				document.getElementById('diag_desc').value = response[0]['description'];
				document.getElementById('diag_cash').value = response[0]['OPD'];
				document.getElementById('diag_charge').value = response[0]['WARD'];
				var selectBrand = document.getElementById("diag_unit");
				var optn = response[0]['unit'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				selectBrand.appendChild(el);

				var selectBrand = document.getElementById("diag_type");
				var optn = response[0]['lotno'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				selectBrand.appendChild(el);

				if(response[0]['pnf']=="NON-PNDF" || response[0]['pnf']=="npndf"){
					var pndf = "pndf";
					var rem = "Yes";
				}else{
					var pndf = "npndf";
					var rem = "No";
				}

				var selectBrand = document.getElementById("diag_pndf");
				var optn = pndf;
				var optn1 = rem;
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				selectBrand.appendChild(el);
			}
		});
	});

	$('.addOthers').click(function(){
		document.getElementById('diag_id').value = '';
		document.getElementById('diag_cash').value = '';
		document.getElementById('diag_charge').value = '';
		document.getElementById('diag_desc').value = '';
	});
	$('.editOthers').click(function(){
		var id = $(this).data('id');
		document.getElementById('other_id').value = id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_diagnostic',
			type:'post',
			data:{id:id},
			dataType:'json',
			success: function(response){
				document.getElementById('other_desc').value = response[0]['description'];
				document.getElementById('other_cash').value = response[0]['OPD'];
				document.getElementById('other_charge').value = response[0]['WARD'];
				var selectBrand = document.getElementById("other_unit");
				var optn = response[0]['unit'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				selectBrand.appendChild(el);

				var selectBrand = document.getElementById("other_type");
				var optn = response[0]['lotno'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				selectBrand.appendChild(el);

				if(response[0]['pnf']=="NON-PNDF" || response[0]['pnf']=="npndf"){
					var pndf = "pndf";
					var rem = "Yes";
				}else{
					var pndf = "npndf";
					var rem = "No";
				}

				var selectBrand = document.getElementById("other_pndf");
				var optn = pndf;
				var optn1 = rem;
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				selectBrand.appendChild(el);
			}
		});
	});

	$('.addProvince').click(function(){
		document.getElementById('prov_id').value='';
		document.getElementById('prov_desc').value='';
	});
	$('.editProvince').click(function(){
		var id = $(this).data('id');
		document.getElementById('prov_id').value = id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_province',
			type:'post',
			data:{id:id},
			dataType:'json',
			success: function(response){
				document.getElementById('prov_desc').value = response[0]['statename'];
			}
		});
	});

	$('.addCity').click(function(){
		var id=$(this).data('id');
		document.getElementById('prov_id_city').value=id;
		document.getElementById('city_id').value='';
		document.getElementById('city_desc').value='';
	});
	$('.editCity').click(function(){
		var data = $(this).data('id');
		var id = data.split('_');
		document.getElementById('prov_id_city').value = id[1];
		document.getElementById('city_id').value = id[0];
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_city',
			type:'post',
			data:{id:id[0]},
			dataType:'json',
			success: function(response){
				document.getElementById('city_desc').value = response[0]['city'];
				document.getElementById('city_zipcode').value = response[0]['ZIP_CODE'];
			}
		});
	});

	$('.addBarangay').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		document.getElementById('prov_id_barangay').value=id[0];
		document.getElementById('city_id_barangay').value=id[1];
		document.getElementById('barangay_desc').value='';
		document.getElementById('barangay_id').value='';
	});
	$('.editBarangay').click(function(){
		var data = $(this).data('id');
		var id = data.split('_');
		document.getElementById('prov_id_barangay').value = id[2];
		document.getElementById('city_id_barangay').value = id[1];
		document.getElementById('barangay_id').value = id[0];
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_barangay',
			type:'post',
			data:{id:id[0]},
			dataType:'json',
			success: function(response){
				document.getElementById('barangay_desc').value = response[0]['barangay'];
			}
		});
	});

	$('.addReligion').click(function(){
		document.getElementById('rel_id').value='';
		document.getElementById('rel_desc').value='';
	});
	$('.editReligion').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		document.getElementById('rel_id').value=id[0];
		document.getElementById('rel_desc').value=id[1];
	});

	$('.addStation').click(function(){
		document.getElementById('stat_id').value='';
		document.getElementById('stat_desc').value='';
	});
	$('.editStation').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		document.getElementById('stat_id').value=id[0];
		document.getElementById('stat_desc').value=id[1];
	});

	$('.addNationality').click(function(){
		document.getElementById('nat_id').value='';
		document.getElementById('nat_desc').value='';
	});
	$('.editNationality').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		document.getElementById('nat_id').value=id[0];
		document.getElementById('nat_desc').value=id[1];
	});

	$('.addAccountTitle').click(function(){
		document.getElementById('acct_id').value='';
		document.getElementById('acct_desc').value='';
	});
	$('.editAccountTitle').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		document.getElementById('acct_id').value=id[0];
		document.getElementById('acct_desc').value=id[1];
	});

	function showSelect(){
		var select = document.getElementById('my_select');
		select.className = 'show';
	}
	function hideSelect(){
		var select = document.getElementById('my_select');
		select.className = 'hide';
	}

	function showSelect1(){
		var select = document.getElementById('my_select1');
		select.className = 'show';
	}
	function hideSelect1(){
		var select = document.getElementById('my_select1');
		select.className = 'hide';
	}
	function formatDate(d)
	{
		//get the month
		//var month = d.getMonth();
		//get the day
		//convert day to string
		//var day = d.getDate().toString();
		//get the year
		var year = d.getFullYear();

		//pull the last two digits of the year
		year = year.toString().substr(-2);

		//increment month by 1 since it is 0 indexed
		//converts month to a string
		//month = (month + 1).toString();

		//if month is 1-9 pad right with a 0 for two digits
		//if (month.length === 1)
		//{
		//    month = "0" + month;
		//}

		//if day is between 1-9 pad right with a 0 for two digits
		//if (day.length === 1)
		//{
		//    day = "0" + day;
		//}

		//return the string "MMddyy"
		return year;
	}
	function insertData(str) {
		var dt = new Date();
		if(str=='M' || str=='E' || str=='ONCO'){
			document.getElementById("hcn").value = str+formatDate(dt)+"-";
		}else{
			document.getElementById("hcn").value = str;
		}
	}
</script>
<style type="text/css">
	.hide{
		display:none;
	}
	.show{
		display:block;
	}
</style>
<script>
	$(".admitpassword").change(function(){
		var password = $(this).val();
		$.ajax({
			url:'<?=base_url();?>index.php/pages/checkPassword',
			type:'post',
			data: {id: password},
			dataType:'json',
			success: function(response) {
				if(response.length > 0) {
					document.getElementById('caseexist').innerHTML = "<font color='#32cd32'><i class='icofont-check-circled'></i> You are authorized!</font>";
					document.getElementById('walkinsubmit').disabled=false;
				}else {
					document.getElementById('admitpassword').value = '';
					document.getElementById('caseexist').innerHTML = "<font color='red'><i class='icofont-exclamation-circle'></i> You are NOT authorized!</font>";
					document.getElementById('walkinsubmit').disabled=true;
				}
			}
		});
	});
	$(".controlno").change(function(){
		var dt="<?=date('YmdHis');?>";
		var password = $(this).val();
		$.ajax({
			url:'<?=base_url();?>index.php/pages/checkControlNo',
			type:'post',
			data: {id: password},
			dataType:'json',
			success: function(response) {
				if(response.length == 0) {
					document.getElementById('controlexist').innerHTML = "<font color='#32cd32'><i class='icofont-check-circled'></i> Control No is available!</font>";
				}else {
					document.getElementById('controlno').value = 'AR-' + dt;
					document.getElementById('controlexist').innerHTML = "<font color='red'><i class='icofont-exclamation-circle'></i> Control No already exist!</font>";
				}
			}
		});
	});

	$(".hcn").change(function(){
		var hcn = $(this).val();
		$.ajax({
			url:'<?=base_url();?>index.php/pages/checkHCNExist',
			type:'post',
			data: {id: hcn},
			dataType:'json',
			success: function(response) {
				if(response.length > 0) {
					document.getElementById('hcn').value = '';
					document.getElementById('hcnexist').innerHTML = "<font color='red'>HCN already exist!</font>";
				}else{
					document.getElementById('hcnexist').innerHTML = "<font color='#adff2f'>HCN available!</font>";
				}
			}
		});
	});
	$(document).ready(function(){
		$('.item').select2();
	});
	$('#selected_item').change(function(){
		var id=$(this).val();
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_item',
			type:'post',
			data: {id:id},
			dataType:'json',
			success: function(response){
				document.getElementById("selected_item_description").value = response[0]['itemname'];
				document.getElementById("selected_item_generic").value = response[0]['generic'];
				document.getElementById("selected_item_quantity").value = response[0]['quantity'];
				document.getElementById("display_selected_item_quantity").innerHTML = response[0]['quantity'];
				document.getElementById("btn_save").disabled = response[0]['quantity'] <= 0;
			}
		});
	});
	$('#requested_item').change(function(){
		var id=$(this).val();
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_requested_item',
			type:'post',
			data: {id:id},
			dataType:'json',
			success: function(response){
				document.getElementById("requested_item_description").value = response['description'];
				document.getElementById("requested_item_quantity").value = response['quantity'];
				document.getElementById("display_requested_item_quantity").innerHTML = response['quantity'];
				document.getElementById("requested_unitcost").value = response['unitcost'];
				document.getElementById("requested_discount").value = response['discount'];
			}
		});
	});
	$('#itemcode').change(function(){
		var id=$(this).val();
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_code',
			type:'post',
			data: {id:id},
			dataType:'json',
			success: function(response){
				var amount = response[0]['sellingprice'];
				document.getElementById("srp").innerHTML = amount;
			}
		});
	});
	$('.editRequestedItem').click(function(){
		var id =$(this).data('id');
		document.getElementById('req_id').value = id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_requested_item',
			type:'post',
			data:{id:id},
			dataType: 'json',
			success:function(response){
				document.getElementById('req_desc').value = response[0]['description'];
				document.getElementById('req_quantity').value = response[0]['prodqty'];
				document.getElementById('req_unitcost').value = response[0]['unitcost'];
				document.getElementById('req_discount').value = response[0]['prodtype1'];
				var select = document.getElementById('req_unit');
				var optn = response[0]['unit'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});
	$('.editReceiveItem').click(function(){
		var data=$(this).data('id');
		var d = data.split('_');
		var id = d[0];
		var po = d[1];
		document.getElementById('rec_id').value = id;
		document.getElementById('rec_po').value = po;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_requested_item',
			type:'post',
			data:{id:id},
			dataType: 'json',
			success:function(response){
				document.getElementById('rec_desc').value = response[0]['description'];
				document.getElementById('rec_quantity').value = response[0]['prodqty'];
				document.getElementById('rec_unitcost').value = response[0]['unitcost'];
				document.getElementById('rec_discount').value = response[0]['prodtype1'];
				var select = document.getElementById('rec_unit');
				var optn = response[0]['unit'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});
	$('.editTransferItem').click(function(){
		var id =$(this).data('id');
		document.getElementById('trans_id').value = id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_transfer_item',
			type:'post',
			data:{id:id},
			dataType: 'json',
			success:function(response){
				document.getElementById('trans_code').value = response[0]['code'];
				document.getElementById('trans_desc').value = response[0]['description'];
				document.getElementById('trans_quantity').value = response[0]['quantity'];
				document.getElementById('trans_discount').value = response[0]['prodtype1'];
				document.getElementById('trans_unitcost').value = response[0]['unitcost'];
				document.getElementById('trans_lotno').value = response[0]['lotno'];
				document.getElementById('trans_expiration').value = response[0]['expiration'];
				var select = document.getElementById('trans_unit');
				var optn = response[0]['paymentstatus'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});
	$('#transfer_item').change(function(){
		var id=$(this).val();
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_requested_item',
			type:'post',
			data: {id:id},
			dataType:'json',
			success: function(response){
				document.getElementById("transfer_item_description").value = response['description'];
				document.getElementById("transfer_item_quantity").value = response['quantity'];
				document.getElementById("display_transfer_item_quantity").innerHTML = response['quantity'];
				document.getElementById("transfer_unitcost").value = response['unitcost'];
				document.getElementById("transfer_discount").value = response['discount'];
				document.getElementById("transfer_lotno").value = response['lotno'];
				document.getElementById("transfer_expiration").value = response['expiration'];
				if(response['quantity']>0){
					document.getElementById('btn_save').removeAttribute("disabled");
				} else {
					document.getElementById('btn_save').setAttribute("disabled","disabled");
				}
			}
		});
	});
	$('.addfreegoodsreceiving').click(function(){
		var data=$(this).data('id');
		var d = data.split('_');
		var id = d[0];
		var po = d[1];
		document.getElementById('fg_code').value = id;
		document.getElementById('fg_po').value = po;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_requested_item',
			type:'post',
			data:{id:id},
			dataType: 'json',
			success:function(response){
				document.getElementById('fg_desc').value = response[0]['description'];
				document.getElementById('fg_quantity').value = 0;
				document.getElementById('fg_unitcost').value = response[0]['unitcost'];
				document.getElementById('fg_discount').value = response[0]['prodtype1'];
				var select = document.getElementById('fg_unit');
				var optn = response[0]['unit'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});
	$('.addbatchreceiving').click(function(){
		var data=$(this).data('id');
		var d = data.split('_');
		var id = d[0];
		var po = d[1];
		document.getElementById('ab_code').value = id;
		document.getElementById('ab_po').value = po;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_requested_item',
			type:'post',
			data:{id:id},
			dataType: 'json',
			success:function(response){
				document.getElementById('ab_desc').value = response[0]['description'];
				document.getElementById('ab_quantity').value = 0;
				document.getElementById('ab_unitcost').value = response[0]['unitcost'];
				document.getElementById('ab_discount').value = response[0]['prodtype1'];
				var select = document.getElementById('ab_unit');
				var optn = response[0]['unit'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});
	$('#save_invoice').change(function(){
		document.getElementById('loader').style.display = "block";
		var invno=$(this).val();
		var pono = $('#pono').val();
		if(invno ==''){
			document.getElementById('preview').style.display= "none";
		}else{
			document.getElementById('preview').style.display= "inline-block";
		}
		$.ajax({
			url:'<?=base_url();?>index.php/pages/save_invoice',
			type:'post',
			data: {invno:invno,pono:pono},
			dataType:'json',
			success: function(response){
				if(response.length > 0){
					document.getElementById("save_invoice").value = '';
					alert('Invoice already used!');
					document.getElementById('loader').style.display = "none";
				}else{
					document.getElementById('loader').style.display = "none";
				}
			}
		});
	});
	$('#save_remarks').change(function(){
		document.getElementById('loader1').style.display = "block";
		var invno=$(this).val();
		var pono = $('#pono').val();
		$.ajax({
			url:'<?=base_url();?>index.php/pages/save_remark',
			type:'post',
			data: {invno:invno,pono:pono},
			dataType:'json',
			success: function(response){
				if(response){
					document.getElementById('loader1').style.display = "none";
				}
			}
		});
	});
	$('#save_quantity').submit(function(e){
		e.preventDefault();
		document.getElementById('loadermain').style.display = "block";
		var data=$("#save_quantity").serializeArray();
		$.ajax({
			url:'<?=base_url();?>index.php/pages/save_quantity',
			type:'post',
			data: data,
			dataType:'json',
			success: function(response){
				document.getElementById('loadermain').style.display = "none";
			}
		});
	});
	$('.changeSupplier').click(function(){
		var id=$(this).data('id');
		document.getElementById('rr_po').value = id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_rr_supplier',
			type:'post',
			data:{id:id},
			dataType: 'json',
			success:function(response){
				var select = document.getElementById('rr_supplier');
				var optn = response[0]['suppliercode'];
				var optn1 = response[0]['supplier'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn + '_' + optn1 ;
				select.appendChild(el);
			}
		});
	});
	$('.editManualItem').click(function(){
		var id =$(this).data('id');
		document.getElementById('man_id').value = id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_manual_item',
			type:'post',
			data:{id:id},
			dataType: 'json',
			success:function(response){
				document.getElementById('man_desc').value = response[0]['description'];
				document.getElementById('man_quantity').value = response[0]['quantity'];
				document.getElementById('man_unitcost').value = response[0]['unitcost'];
				document.getElementById('man_discount').value = response[0]['prodtype1'];
				document.getElementById('man_expiration').value = response[0]['expiration'];
				var unitcost=response[0]['unitcost'];
				var tax = unitcost - (unitcost/1.12);
				document.getElementById('man_vat').value = tax;
				if(response[0]['stockalert'] > 0){
					document.getElementById('man_vat').checked = true;
				}else{
					document.getElementById('man_vat').checked = false;
				}
				var select = document.getElementById('man_unit');
				var optn = response[0]['unit'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});
	$('.manageMedicine').click(function(){
		var id=$(this).data('id');
		document.getElementById('med_id').value=id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_medicine',
			type:'post',
			data:{id:id},
			dataType:'json',
			success:function(response){
				document.getElementById('med_desc').value=response[0]['description'];
				document.getElementById('med_brand').value=response[0]['generic'];
				document.getElementById('med_form').value=response[0]['ave'];
				document.getElementById('med_strength').value=response[0]['aveconsole'];
				document.getElementById('med_unit').value=response[0]['unitcost'];
				document.getElementById('med_package').value=response[0]['package'];
				document.getElementById('med_route').value=response[0]['SuppliesPricing'];
			}
		});
	});
	$('.manageSupplies').click(function(){
		var id=$(this).data('id');
		document.getElementById('sup_id').value=id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_medicine',
			type:'post',
			data:{id:id},
			dataType:'json',
			success:function(response){
				document.getElementById('sup_desc').value=response[0]['description'];
				var select = document.getElementById('sup_type');
				var optn = response[0]['unit'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				select.appendChild(el);

				var select = document.getElementById('sup_section');
				var optn = response[0]['optset3'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});
	$('.addSupplier').click(function(){
		document.getElementById('supp_id').value='';
				document.getElementById('supp_name').value='';
				document.getElementById('supp_address').value='';
				document.getElementById('supp_tin').value='';
	});
	$('.manageSupplier').click(function(){
		var id=$(this).data('id');
		document.getElementById('supp_id').value=id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_supplier',
			type:'post',
			data:{id:id},
			dataType:'json',
			success:function(response){
				document.getElementById('supp_name').value=response[0]['suppliername'];
				document.getElementById('supp_address').value=response[0]['address'];
				document.getElementById('supp_tin').value=response[0]['tin'];
				var select = document.getElementById('supp_status');
				var optn = response[0]['status'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});
	$('.addKit').click(function(){
		var id=$(this).data('id');
		document.getElementById('kit_id').value='';
		document.getElementById('kit_desc').value='';
		document.getElementById('kit_unitcost').value='';
		document.getElementById('kit_phic').value='';
		document.getElementById('kit_opd').value='';
	});
	$('.editKit').click(function(){
		var id=$(this).data('id');
		document.getElementById('kit_id').value=id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_code',
			type:'post',
			data:{id:id},
			dataType:'json',
			success:function(response){
				document.getElementById('kit_desc').value=response[0]['description'];
				document.getElementById('kit_unitcost').value=response[0]['capital'];
				document.getElementById('kit_phic').value=response[0]['sellingprice'];
				document.getElementById('kit_opd').value=response[0]['OPD'];
			}
		});
	});
	$('.AddKitQuantity').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		document.getElementById('q_id').value=id[0];
		document.getElementById('q_desc').value=id[1];
	});
	$('#kit_item').change(function(){
		var id=$(this).val();
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_requested_item',
			type:'post',
			data: {id:id},
			dataType:'json',
			success: function(response){
				document.getElementById("kit_item_description").value = response['description'];
				document.getElementById("display_kit_item_quantity").innerHTML = response['quantity'];
			}
		});
	});
	$('.productionGloves').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		document.getElementById('g_code').value=id[0];
		document.getElementById('g_pcode').value=id[1];
		document.getElementById('g_desc').value=id[2];
		document.getElementById('g_pdesc').value=id[3];
	});
	$('.productionAlcohol').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		document.getElementById('a_code').value=id[0];
		document.getElementById('a_pcode').value=id[1];
		document.getElementById('a_desc').value=id[2];
		document.getElementById('a_pdesc').value=id[3];
	});
	$('.productionOS').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		document.getElementById('o_code').value=id[0];
		document.getElementById('o_desc').value=id[2];
	});
	$('.editDischargedDateTime').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		document.getElementById('d_patientidno').value=id[0];
		document.getElementById('d_caseno').value=id[1];
		document.getElementById('d_date').value=id[2];
		document.getElementById('d_time').value=id[3];
	});
	$('.addDiagnosis').click(function(){
		var data = $(this).data('id');
		var id = data.split('_');
		document.getElementById('ad_patientidno').value = id[0];
		document.getElementById('ad_caseno').value = id[1];
		document.getElementById('ad_code').value = id[2];
		document.getElementById('ad_case_type').value = id[3];
		document.getElementById('ad_description').value = id[4];
	});
	$('.editDiagnosis').click(function(){
		var data = $(this).data('id');
		var id = data.split('_');
		document.getElementById('ed_patientidno').value = id[0];
		document.getElementById('ed_caseno').value = id[1];
		document.getElementById('ed_autono').value = id[2];
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_case',
			type:'post',
			data:{id:id[2]},
			dataType:'json',
			success:function(response){
				document.getElementById("ed_description").value = response[0]['description'];
				document.getElementById("ed_code").value = response[0]['icdcode'];
				var select = document.getElementById('ed_level');
				var optn = response[0]['level'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});
	$('.editDisposition').click(function(){
		var data = $(this).data('id');
		var id = data.split('_');
		document.getElementById('ud_patientidno').value = id[0];
		document.getElementById('ud_caseno').value = id[1];
		var select = document.getElementById('ud_disposition');
		var optn = id[2];
		var el = document.createElement("option");
		el.selected = "selected";
		el.textContent = optn;
		el.value = optn;
		select.appendChild(el);
		var select = document.getElementById('ud_status');
		var optn = id[3];
		var el = document.createElement("option");
		el.selected = "selected";
		el.textContent = optn;
		el.value = optn;
		select.appendChild(el);
	});
	$('.updateAP').click(function(){
		var data=$(this).data('id');
		var myid = data.split('_');
		$('.modal-body #admit_caseno_mrd').val(myid[1]);
		$('.modal-body #admit_patientidno_mrd').val(myid[0]);
		var id=myid[2];
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_doctor',
			type:'post',
			data: {id: id},
			dataType:'json',
			success: function(response){
				var select = document.getElementById("admit_attending_mrd");
				var optn = response[0]['code'];
				var optn1 = response[0]['lastname'] + ", " + response[0]['firstname'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.prepend(el);
			}
		});
	});
	$('.createCertificate').click(function(){
		var data = $(this).data('id');
		var id = data.split('_');
		document.getElementById('cert_patientidno').value = id[0];
		document.getElementById('cert_caseno').value = id[1];
		document.getElementById('cert_type').value = id[2];
	});
	$('.editCertificate').click(function(){
		var data = $(this).data('id');
		var id = data.split('_');
		document.getElementById('cert_edit_patientidno').value = id[0];
		document.getElementById('cert_edit_caseno').value = id[1];
		document.getElementById('cert_edit_type').value = id[2];
		document.getElementById('cert_edit_id').value = id[3];
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_certificate',
			type:'post',
			data:{id:id[3]},
			dataType:'json',
			success:function(response){
				document.getElementById('cert_edit_purpose').value = response[0]['purpose'];
				document.getElementById('cert_edit_remarks').value = response[0]['recommendation'];
				var select = document.getElementById("cert_edit_charge");
				var optn = response[0]['is_employee'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				select.prepend(el);
			}
		});
	});
	$('.addMedicoLegal').click(function(){
		var data = $(this).data('id');
		var id = data.split('_');
		document.getElementById('med_patientidno').value = id[0];
		document.getElementById('med_caseno').value = id[1];
		document.getElementById('med_type').value = id[2];
	});
	$('.editMedicoLegal').click(function(){
		var data = $(this).data('id');
		var id = data.split('_');
		document.getElementById('med_edit_patientidno').value = id[0];
		document.getElementById('med_edit_caseno').value = id[1];
		document.getElementById('med_edit_type').value = id[2];
		document.getElementById('med_edit_id').value = id[3];
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_medicolegal',
			type:'post',
			data:{id:id[3]},
			dataType:'json',
			success:function(response){
				document.getElementById('med_edit_noi').value = response[0]['medcase'];
				document.getElementById('med_edit_poi').value = response[0]['medplace'];
				document.getElementById('med_edit_toi').value = response[0]['medtime'];
				document.getElementById('med_edit_doi').value = response[0]['meddate'];
				document.getElementById('med_edit_advise').value = response[0]['medadvised'];
				document.getElementById('med_edit_recommend').value = response[0]['medrecommend'];
				var select = document.getElementById("med_edit_charge");
				var optn = response[0]['is_employee'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				select.prepend(el);
			}
		});
	});
	$('.reopen').click(function(){
		var data = $(this).data('id');
		var id = data.split('_');
		document.getElementById('open_patientidno').value = id[1];
		document.getElementById('open_caseno').value = id[0];
	});
	$('.dischargedPatient').click(function(){
		var data = $(this).data('id');
		var id = data.split('_');
		document.getElementById('disc_patientidno').value = id[0];
		document.getElementById('disc_caseno').value = id[1];
	});
	$('.addDiet').click(function(){
		var data = $(this).data('id');
		var id = data.split('_');
		document.getElementById('diet_caseno').value = id[0];
		document.getElementById('diet_room').value = id[1];
		document.getElementById('diet_user').value = id[2];
	});
	$('.chargedItem').click(function(){
		var id = $(this).data('id');
		document.getElementById('diet_charge_id').value = id;
	});
	$('.activate_account').click(function(){
		var id = $(this).data('id');
		document.getElementById('aa_caseno').value = id;
	});

	$('.vitalsigns').click(function(){
		var id = $(this).data('id');
		document.getElementById('vs_caseno').value=id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_vital_signs',
			type:'post',
			data:{id:id},
			dataType:'json',
			success:function(response){
				var sys=0;
				var dia=0;
				if(response[0]['bp'].length > 0){
					var bp = response[0]['bp'].split('/');
					 sys=bp[0];
					 dia=bp[1];
				}
				document.getElementById('vs_temp').value = response[0]['temp'];
				document.getElementById('vs_systolic').value = sys;
				document.getElementById('vs_diastolic').value = dia;
				document.getElementById('vs_height').value = response[0]['height'];
				document.getElementById('vs_weight').value = response[0]['weight'];
				document.getElementById('vs_pr').value = response[0]['heartrate'];
				document.getElementById('vs_rr').value = response[0]['respiratoryrate'];
			}
		});
	});
	$('.arlist').click(function(){
		<?php
		$this->session->unset_userdata('startdate');
		?>
	});
	$('.editCreditLimit').click(function(){
		var id = $(this).data('id');
		document.getElementById('cl_caseno').value=id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_credit_limit',
			type:'post',
			data:{id:id},
			dataType:'json',
			success:function(response){
				document.getElementById('cl_creditlimit').value = response[0]['creditlimit'];
			}
		});
	});
	$('.readmitquotation').click(function(){
		var id = $(this).data('id');
		document.getElementById('quotation_patientidno').value=id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_single_patient',
			type:'post',
			data:{id:id},
			dataType:'json',
			success:function(response){
				document.getElementById('quotation_lname').value = response[0]['lastname'];
				document.getElementById('quotation_fname').value = response[0]['firstname'];
				document.getElementById('quotation_mname').value = response[0]['middlename'];
				document.getElementById('quotation_suffix').value = response[0]['suffix'];
				document.getElementById('quotation_birthdate').value = response[0]['dateofbirth'];
				var select = document.getElementById("quotation_gender");
				var optn = response[0]['sex'];
				if(optn == 'M'){
					var optn1 = 'Male';
				}else{
					var optn1 = 'Female';
				}
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn1;
				el.value = optn;
				select.prepend(el);
			}
		});
	});

	$('.editMembership').click(function(){
		var id = $(this).data('id');
		document.getElementById('mem_caseno').value=id;
	});
</script>
<script type="text/javascript">
	function checkAll(){
		var inputs = document.querySelectorAll('.pl');
		for (var i = 0; i < inputs.length; i++) {
			if(inputs[i].checked==true){
				inputs[i].checked = false;
			}else{
				inputs[i].checked = true;
			}

		}
	}
	$('.checkInvoice').change(function(){
		var id = $(this).val();
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_invoice',
			type:'post',
			data:{id:id},
			dataType:'json',
			success:function(response){
				document.getElementById('mr_invoice').value = response;
			}
		});
	});

	$('#admitbirthdate').on('change',function (){		
		var selectedDate = $(this).val();
		var today = new Date();
		var dob = new Date(selectedDate);
		var age = today.getFullYear() - dob.getFullYear();
		var m = today.getMonth() - dob.getMonth();
		if (m < 0 || (m === 0 && today.getDate() < dob.getDate()))
    {
        age--;
    }
    if(age < 0){
    	age = 0;
    }
    document.getElementById("admitage").value = age;
    if(age >= 60){
    	document.getElementById("admitdiscountsenior").checked = true;
    }else{    	
    	document.getElementById("admitdiscountnone").checked = true;
    }
	});
	$(document).on("click", ".viewVitalSigns", function () {
            var id=$(this).data('id');
            $.ajax({
                type:'post',
                url:'http://192.168.0.100:100/ERP/hmo/viewvs.php',
                data:{id:id},
                success:function(response){
                    $("#vitalsigns").html(response);
                }
            });
        });

$(document).on("change",".hospitalbill", function(){
var id=$(this).val();
var amount = document.getElementById('totalexcess');
var oldamount = document.getElementById('hospitalbill');
var total=0;

total = (parseFloat(id)-parseFloat(oldamount.value)) + parseFloat(amount.value);
document.getElementById("hospitalbill").value= id;
document.getElementById('totalexcess').value = total;
});
function updateTotal(){
	 var itemCount = document.getElementsByClassName("itemclass");
	 var hospitalbill = document.getElementById("hospitalbill");
	 var total = parseFloat(hospitalbill.value);
	 var id= '';
	 for(var i = 0; i < itemCount.length; i++)
	 {
	   id = "tamount"+(i+1);
	   total = total + parseFloat(itemCount[i].value);
	// if(total + parseFloat(document.getElementById(id).value) <= loa){
	//    total = total +  parseFloat(document.getElementById(id).value);
	//  }else{
	   //document.getElementById(id).value=0;
	 //}
	 }
	document.getElementById('totalexcess').value = total.toFixed(2);
  }
  $('.EditPrice').click(function(){
		var data = $(this).data('id');
		var id=data.split('_');
		document.getElementById('price_caseno').value =id[0];
		document.getElementById('price_refno').value =id[1];
		document.getElementById('price_srp').value=id[2];
		document.getElementById('price_discount').value=id[3];
		document.getElementById('price_hmo').value=id[4];
	});
	$('.addPF').click(function(){
		var id=$(this).data('id');
		document.getElementById('pf_caseno').value=id;
	});
	$('.hmoreopen').click(function(){
		var id = $(this).data('id');
		document.getElementById('open_caseno_hmo').value = id;
	});
	$('.finalize').click(function(){
		var id = $(this).data('id');
		document.getElementById('final_caseno').value = id;
	});
	$('.editInvoice').click(function(){
		var data = $(this).data('id');
		var id=data.split('_');
		document.getElementById('ed_rrno').value = id[0];
		document.getElementById('ed_oldinvno').value = id[1];
		document.getElementById('ed_newinvno').value = id[1];
	});
	$('.editloa').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		document.getElementById('allo_caseno').value=id[0];
		document.getElementById('allo_loa').value=id[1];
	});
	$('.manageReorder').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		document.getElementById('rom_code').value=id[0];
		document.getElementById('rom_description').value=id[1];
		document.getElementById('rom_dept').value=id[2];
	});
	$('.manageReorderSupplies').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		document.getElementById('ros_code').value=id[0];
		document.getElementById('ros_description').value=id[1];
		document.getElementById('ros_dept').value=id[2];
	});
	$('.tagEMR').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		document.getElementById('tag_patientidno').value = id[0];
		document.getElementById('tag_caseno').value = id[1];
		document.getElementById('tag_icdcode').value = id[4];
		document.getElementById('tag_code').value = id[2];
		document.getElementById('tag_description').value = id[3];
	});
	$('.editInitialDiag').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		document.getElementById('init_caseno').value = id[0];
		document.getElementById('init_diag').value = id[1];
	});
	$('.editBODPrice').click(function(){
		var id=$(this).data('id');
		document.getElementById('bod_id').value = id;
		$.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_bod_price',
			type:'post',
			data:{id:id},
			dataType: 'json',
			success:function(response){
				document.getElementById('bod_code').value = response[0]['code'];
				document.getElementById('bod_desc').value = response[0]['description'];
				document.getElementById('bod_quantity').value = response[0]['quantity'];
				document.getElementById('bod_unitcost').value = response[0]['unitcost'];
				document.getElementById('bod_discount').value = response[0]['prodtype1'];
				document.getElementById('bod_expiration').value = response[0]['expiration'];
				document.getElementById('bod_lotno').value = response[0]['lotno'];
				var select = document.getElementById('bod_unit');
				var optn = response[0]['paymentstatus'];
				var el = document.createElement("option");
				el.selected = "selected";
				el.textContent = optn;
				el.value = optn;
				select.appendChild(el);
			}
		});
	});

	$('.secondCopy').click(function(){
		var data=$(this).data('id');
		var id=data.split('_');
		document.getElementById('copy_patientidno').value=id[0];
		document.getElementById('copy_caseno').value=id[1];
	});
  $('.uploadchart').click(function(){
    var data=$(this).data('id');
    var id=data.split('_');
    document.getElementById('chart_patientidno').value=id[0];
    document.getElementById('chart_caseno').value=id[1];
  });
  $('.addGL').click(function(){
    var id=$(this).data('id');    
    document.getElementById('gl_patientidno').value=id;
    document.getElementById('gl_idno').value="";    
    document.getElementById('gl_id').value="";    
    document.getElementById('gl_company').value="";    
    document.getElementById('gl_amount').value="";    
  });
  $('.editGL').click(function(){
    var data=$(this).data('id');
    var id=data.split('_');
    var idno=id[0];
    var gl_id=id[1];
   $.ajax({
			url:'<?=base_url();?>index.php/pages/fetch_gl_details',
			type:'post',
			data:{id:id,gl_id:gl_id},
			dataType: 'json',
			success:function(response){
				document.getElementById('gl_idno').value = id[0];
				document.getElementById('gl_id').value = response[0]['gl_id'];
				document.getElementById('gl_company').value = response[0]['gl_company'];
				document.getElementById('gl_amount').value = response[0]['amount'];
				document.getElementById('gl_datearray').value = response[0]['datearray'];
				document.getElementById('gl_patientidno').value = response[0]['patientidno'];				
			}
		});
	});
	$('.patient_discharged').click(function(){
		var id=$(this).data('id');
		document.getElementById('d_caseno').value=id;
	});
	$('.editAccttitle').click(function(){
		var data=$(this).data('id');
		var id = data.split('_');
		document.getElementById('soa_id').value = id[0];
		document.getElementById('soa_accttitle').value = id[1];
		document.getElementById('soa_hmo').value = id[2];
	});
	$('.editSubAccttitle').click(function(){
		var data=$(this).data('id');
		var id = data.split('_');
		document.getElementById('soa_id_details').value = id[0];
		document.getElementById('soa_accttitle_details').value = id[1];		
	});
	$('.updateFinalDiag').click(function(){
		var data=$(this).data('id');
		var id = data.split('_');
		document.getElementById('dx_patientidno').value = id[0];
		document.getElementById('dx_caseno').value = id[1];		
		document.getElementById('dx_final').value = id[2];		
	});
	$('.editbillingreport').click(function(){
		var data=$(this).data('id');
		var id = data.split('_');
		document.getElementById('bill_id').value = id[0];
		document.getElementById('bill_accounttitle').value = id[1];		
	});
	$('.addbillingreport').click(function(){		
		document.getElementById('bill_id').value = '';
		document.getElementById('bill_accounttitle').value = '';		
	});
</script>
</body>
</html>
