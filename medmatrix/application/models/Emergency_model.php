<?php
date_default_timezone_set('Asia/Manila');
class Emergency_model extends CI_model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getAllOutPatient(){
		$rundate=$this->session->rundate;
		$type=$this->session->atype;
		$result=$this->db->query("SELECT pp.lastname,pp.firstname,pp.middlename,pp.suffix,a.caseno,a.ad,a.ap,a.membership,a.hmo,a.policyno FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.employerno LIKE '$type%'  AND a.status <> 'discharged' AND a.status <> 'CANCELLED' AND a.dateadmit='$rundate' ORDER BY a.timeadmitted DESC");		return $result->result_array();
	}

	public function getSingleOutPatient($searchme){
		$rundate=$this->session->rundate;
		$type=$this->session->atype;
		$result=$this->db->query("SELECT pp.lastname,pp.firstname,pp.middlename,pp.suffix,a.caseno,a.ad,a.ap FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.employerno LIKE '$type%' AND a.status='Active' AND a.dateadmit='$rundate' AND CONCAT(pp.lastname,' ',pp.firstname) LIKE '%%$searchme%%' ORDER BY a.timeadmitted DESC");
		return $result->result_array();
	}

	public function update_admitting_doctor($caseno){
		$ad=$this->input->post('ad');
		$startdate=$this->input->post('rundate');
		$atype=$this->input->post('atype');
		$doctor=$this->db->query("SELECT * FROM docfile WHERE code='$ad'");
		$doc=$doctor->row_array();
		$result=$this->db->query("UPDATE admission SET ap='$ad',ad='$ad' WHERE caseno='$caseno'");
		if($result){
			$this->db->query("UPDATE productout SET productcode='$ad',productdesc='$doc[name]' WHERE caseno='$caseno' AND productsubtype='PROFESSIONAL FEE'");
			return true;
		}else{
			return false;
		}
	}

	public function save_opd_admission($patientidno,$pid,$caseno,$admittingclerk,$empid){
		$st=$this->session->dept;
		$lastname=$this->input->post('lastname');
		$firstname=$this->input->post('firstname');
		$middlename=$this->input->post('middlename');
		$suffix=$this->input->post('suffix');
		if($suffix==""){
			$patientname=$lastname." ".$firstname." ".$middlename;
		}else{
			$patientname=$lastname." ".$firstname." ".$suffix." ".$middlename;
		}
		$dateofbirth=$this->input->post('birthdate');
		$birthdate=date('M-d-Y',strtotime($dateofbirth));
		$contactno=$this->input->post('contactno');
		$gender=$this->input->post('gender');
		$civilstatus=$this->input->post('civilstatus');
		$nationality=$this->input->post('nationality');
		$religion=$this->input->post('religion');
		$discounttype=$this->input->post('discounttype');
		$discountid=$this->input->post('discountid');
		$province=$this->input->post('province');
		$city=$this->input->post('city');
		$barangay=$this->input->post('barangay');
		$street=$this->input->post('street');
		$zipcode=$this->input->post('zipcode');
		$demographics=$barangay."_".$city."_".$province;
		$disposition=$this->input->post('disposition');
		$transferfrom=$this->input->post('transferfrom');
		$transfrom=$this->input->post('transfrom');
		$contactperson=$this->input->post('contactperson');
		$contactpersonno=$this->input->post('contactpersonno');
		$contactpersonrelation=$this->input->post('contactpersonrelation');
		$father=$this->input->post('father');
		$mother=$this->input->post('mother');
		$ap=$this->input->post('ap');
		$hmomembership=$this->input->post('hmomembership');
		$hmo=$this->input->post('hmo');
		$loalimit=$this->input->post('loalimit');
		$membership=$this->input->post('membership');
		if($membership=="phic-med"){
		$membership="phic-med";
		}else{
		$membership="none";
		}
		$type=$this->input->post('type');
		$paymentmode=$this->input->post('paymentmode');
		$hcn=$this->input->post('hcn');
		$initialdiagnosis=$this->input->post('initialdiagnosis');
		$service=$this->input->post('service');
		$station=$this->input->post('station');
		$procedure=$this->input->post('procedure');

		if($st=="ONCOLOGY"){
			$room="ONCO";
		}else{
			$room="ER";
		}

		$bday = new DateTime($dateofbirth); // Your date of birth
		$today = new Datetime(date('Y-m-d'));
		$diff = $today->diff($bday);
		$age=$diff->y;
		if(($age >= 60 && $discounttype=="SENIOR") || $discounttype=="PWD" || $age >= 60){
			$senior="Y";
			$discounttype=$discounttype;
		}else{
			$senior="N";
			$discounttype="NONE";
		}
		$dateadmit=date('M-d-Y');
		$timeadmit=date('H:i:s');
		$date=date('Y-m-d');
		$check=$this->db->query("SELECT * FROM patientprofile WHERE lastname='$lastname' AND firstname='$firstname' AND middlename='$middlename' AND dateofbirth='$dateofbirth' AND patientidno <> '$pid'");
		if($check->num_rows() > 0 && $patientidno==""){			
			return false;
			echo "<script>alert('Unable to save details! Duplicate Entry');window.history.back();</script>";
		}else{
		//Account Ledger===================================
		$this->db->query("INSERT INTO patientprofileid(caseno) VALUES('$caseno')");
		$this->db->query("INSERT INTO acctledge(patientidno,balance,`date`,admittingofficer) VALUE('$pid','0','$date','$admittingclerk')");
		//=================================================

		//Address==========================================
		$prov=$this->db->query("SELECT statename FROM `state` WHERE id='$province' OR statename = '$province'");
		$state=$prov->row_array();
		$provincecode=$state['id'];
		$provincename=$state['statename'];

		$municipality=$this->db->query("SELECT city FROM city WHERE id='$city' OR city='$city'");
		$municity=$municipality->row_array();
		$citycode=$municity['id'];
		$cityname=$municity['city'];

		$barang=$this->db->query("SELECT barangay FROM barangay WHERE id='$barangay' OR barangay='$barangay'");
		$bar=$barang->row_array();
		$barcode=$bar['id'];
		$barangayname=$bar['barangay'];
		//=================================================

		//Doctor=================================
		$doctor=$this->db->query("SELECT * FROM docfile WHERE code='$ap'");
		$doc=$doctor->row_array();
		$apname=$doc['name'];
		$arSpecialization=$doc['specialization'];
		$arPF=$doc['PF'];
		//=================================================

		//Room Rates=======================================
		$rates=$this->db->query("SELECT * FROM room WHERE room='$room'");
		$rate=$rates->row_array();
		$roomrates=$rate['roomrates'];
		$creditlimit=15000;
		//=================================================
		if($patientidno==""){
			//Patient Profile==================================
			$this->db->query("INSERT INTO patientprofile(patientidno,lastname,firstname,middlename,suffix,birthdate,age,sex,senior,patientname,dateofbirth,type) VALUES('$pid','$lastname','$firstname','$middlename','$suffix','$birthdate','$age','$gender','$senior','$patientname','$dateofbirth','$date')");
			$this->db->query("INSERT INTO patientprofileaddinfo(patientidno,discounttype,discountid) VALUES('$pid','$discounttype','$discountid')");
			//=================================================
		}else{
			$this->db->query("UPDATE patientprofile SET lastname='$lastname',firstname='$firstname',middlename='$middlename',suffix='$suffix',birthdate='$birthdate',age='$age',sex='$gender',senior='$senior',patientname='$patientname',dateofbirth='$dateofbirth' WHERE patientidno='$pid'");
			$check=$this->db->query("SELECT * FROM patientprofileaddinfo WHERE patientidno='$pid'");
			if($check->num_rows() > 0){
				$this->db->query("UPDATE patientprofileaddinfo SET discounttype='$discounttype',discountid='$discountid' WHERE patientidno='$pid'");				
			}else{
				$this->db->query("INSERT INTO patientprofileaddinfo(patientidno,discounttype,discountid) VALUES('$pid','$discounttype','$discountid')");
			}
		}
		//Admission========================================
		$this->db->query("INSERT INTO admission(patientidno,caseno,`type`,membership,hmomembership,hmo,policyno,paymentmode,room,ward,street,barangay,municipality,province,zipcode,middlenamed,initialdiagnosis,ad,ap,`case`,dateadmitted,timeadmitted,`status`,casetype,birthplace,stat1,patientadmit,religion,occupation,job,employerno,notify,relationship,`proc`,contactno,course,patientcontactno,diet,admittingclerk,dateadmit,`count`,branch,consult_id,lastnamed,firstnamed,senior) VALUES('$pid','$caseno','$type','$membership','$hmomembership','$hmo','$loalimit','$paymentmode','$room','out','$street','$barangayname','$cityname','$provincename','$zipcode','$contactperson','$initialdiagnosis','$ap','$ap','$case','$dateadmit','$timeadmit','Active','A','','$civilstatus','$disposition','$religion','','restrict','$hcn','$nationality','$contactpersonrelation','$age','$contactpersonno','NEW','$contactno','','$admittingclerk','$date','1','KMSCI','$demographics','$father','$mother','$senior')");
		$this->db->query("INSERT INTO admissionaddinfo(caseno,chiefcomplaint) VALUES('$caseno','')");
		//=================================================

		//Productout=======================================
		if($service=="Consultation"){
			//Admitting Doctor PF
			$timenow=date('Y-m-d H:i:s');
			$datearray=date('Y-m-d');
			$morningfrom=$datearray.' 00:00:00';
			$morningto=$datearray.' 08:00:00';
			$nightfrom=$datearray.' 08:01:00';
			$nightto=$datearray.' 23:59:00';
			$consult=100;
			$consultdisc=0;
			$arPFdisc=0;
			$consultgross=$consult;
			if($arSpecialization=="ROD" && ($timenow >= $morningfrom && $timenow <= $morningto)){
				$arPF=150;
				$arPFgross=$arPF;
				if($senior=="Y"){
					$consultdisc=$consult*.20;
					$arPFdisc=$arPF*.20;
					$consultgross=$consult-$consultdisc;
					$arPFgross=$arPF-$arPFdisc;
				}
				$refno=$this->General_model->generateRefNo('RN',$admittingclerk);
				$this->db->query("INSERT INTO productout(refno,invno,caseno,productcode,productdesc,sellingprice,quantity,adjustment,gross,trantype,phic,hmo,excess,`date`,status,loginuser,productsubtype,shift,location,datearray) VALUES('$refno','$timeadmit','$caseno','$ap','$apname','$arPF','1','$arPFdisc','$arPFgross','cash','0','0','$arPFgross','$dateadmit','requested','$admittingclerk','PROFESSIONAL FEE','KMSCI','0','$date')");
				$refno=$this->General_model->generateRefNo('RN',$admittingclerk);
				$this->db->query("INSERT INTO productout(refno,invno,caseno,productcode,productdesc,sellingprice,quantity,adjustment,gross,trantype,phic,hmo,excess,`date`,status,loginuser,productsubtype,shift,location,datearray) VALUES('$refno','$timeadmit','$caseno','CONSULTATION FEE','CONSULTATION FEE','$consult','1','$consultdisc','$consultgross','cash','0','0','$consultgross','$dateadmit','requested','$admittingclerk','CONSULTATION FEE','KMSCI','0','$date')");
			}else if($arSpecialization=="ROD" && ($timenow >= $nightfrom && $timenow <= $nightto)){
				$arPF=120;
				$arPFgross=$arPF;
				if($senior=="Y"){
					$consultdisc=$consult*.20;
					$arPFdisc=$arPF*.20;
					$consultgross=$consult-$consultdisc;
					$arPFgross=$arPF-$arPFdisc;
				}
				$refno=$this->General_model->generateRefNo('RN',$admittingclerk);
				$this->db->query("INSERT INTO productout(refno,invno,caseno,productcode,productdesc,sellingprice,quantity,adjustment,gross,trantype,phic,hmo,excess,`date`,status,loginuser,productsubtype,shift,location,datearray) VALUES('$refno','$timeadmit','$caseno','$ap','$apname','$arPF','1','$arPFdisc','$arPFgross','cash','0','0','$arPFgross','$dateadmit','requested','$admittingclerk','PROFESSIONAL FEE','KMSCI','0','$date')");
				$refno=$this->General_model->generateRefNo('RN',$admittingclerk);
				$this->db->query("INSERT INTO productout(refno,invno,caseno,productcode,productdesc,sellingprice,quantity,adjustment,gross,trantype,phic,hmo,excess,`date`,status,loginuser,productsubtype,shift,location,datearray) VALUES('$refno','$timeadmit','$caseno','CONSULTATION FEE','CONSULTATION FEE','$consult','1','$consultdisc','$consultgross','cash','0','0','$consultgross','$dateadmit','requested','$admittingclerk','CONSULTATION FEE','KMSCI','0','$date')");
			}else{
				$arPF=$arPF;
				$arPFgross=$arPF;
				if($senior=="Y"){
					$consultdisc=$consult*.20;
					$arPFdisc=$arPF*.20;
					$consultgross=$consult-$consultdisc;
					$arPFgross=$arPF-$arPFdisc;
				}
				$refno=$this->General_model->generateRefNo('RN',$admittingclerk);
				$this->db->query("INSERT INTO productout(refno,invno,caseno,productcode,productdesc,sellingprice,quantity,adjustment,gross,trantype,phic,hmo,excess,`date`,status,loginuser,productsubtype,shift,location,datearray) VALUES('$refno','$timeadmit','$caseno','$ap','$apname','$arPF','1','$arPFdisc','$arPFgross','cash','0','0','$arPFgross','$dateadmit','requested','$admittingclerk','PROFESSIONAL FEE','KMSCI','0','$date')");
			}
		}
		if ($hmomembership == "none") {
			$erfeesp = "200";
			$erfeegross = "200";
			$erfeeexcess = "200";
			$erfeehmo = "0";
		}


		if ($hmomembership == "hmo-hmo") {
			$erfeesp = "200";
			$erfeegross = "200";
			$erfeehmo = "200";
			$erfeeexcess = "0";
		}
		if ($hmomembership == "hmo-company") {
			$erfeesp = "200";
			$erfeegross = "200";
			$erfeehmo = "200";
			$erfeeexcess = "0";
		}

		if($service == 'OPD Procedure' && $procedure <> 'ENDOSCOPY' && $procedure <> 'COLONOSCOPY'){
			$refno=$this->General_model->generateRefNo('RN',$admittingclerk);
			$this->db->query("INSERT INTO productout(refno,invno,caseno,productcode,productdesc,sellingprice,quantity,adjustment,gross,trantype,phic,hmo,excess,`date`,status,loginuser,producttype,productsubtype,shift,location,datearray) VALUES('$refno','$timeadmit','$caseno','ER FEE','ER FEE','$erfeesp','1','0','$erfeegross','charge','0','$erfeehmo','$erfeeexcess','$dateadmit','requested','$admittingclerk','ER','OR/DR/ER FEE','KMSCI','0','$date')");
		}
		//========================================================

		//Vital Signs=====================================
		if ($timeadmit >="23:00:01" &&  $timeadmit <= "8:00:00") {
			$shift = "1";
		}
		if ($timeadmit >="8:00:01" &&  $timeadmit <= "16:00:00") {
			$shift = "2";
		}
		if ($timeadmit >="16:00:01" &&  $timeadmit <= "23:00:00") {
			$shift = "3";
		}
		$this->db->query("INSERT INTO vitalsigns VALUES('$patientidno','$caseno','0','0','0','0','0','0','$date','$timeadmit','','','IN','INPATIENT','','','','','1','$st','$apname','KMSCI','$shift','$date')");
		//=================================================

		//Credit Limit=====================================
		if(strpos($hcn, "C") !== false){
			if(strpos($hcn, "ONCO") !== false){

			}else{
				$creditlimit=0;
			}		
		}
		$this->db->query("INSERT INTO patientscredit(caseno,creditlimit) VALUES('$caseno','$creditlimit')");
		//=================================================

		return true;
	}
	}

	public function getRODReports(){
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$rod=$this->input->post('code');
		$result=$this->db->query("SELECT pp.lastname,pp.firstname,pp.middlename,pp.suffix,a.caseno,a.dateadmit,a.ap FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.ad='$rod' AND a.dateadmit BETWEEN '$startdate' AND '$enddate' AND a.status <> 'CANCELLED' AND a.caseno LIKE '%I-%' ORDER BY a.dateadmit ASC");
		return $result->result_array();
	}

	public function save_walkin_admission($patientidno,$pid,$caseno,$admittingclerk,$empid){
		$st=$this->session->dept;
		$lastname=$this->input->post('lastname');
		$firstname=$this->input->post('firstname');
		$middlename=$this->input->post('middlename');
		$suffix=$this->input->post('suffix');
		if($suffix==""){
			$patientname=$lastname." ".$firstname." ".$middlename;
		}else{
			$patientname=$lastname." ".$firstname." ".$suffix." ".$middlename;
		}
		$dateofbirth=$this->input->post('birthdate');
		$birthdate=date('M-d-Y',strtotime($dateofbirth));
		$contactno=$this->input->post('contactno');
		$gender=$this->input->post('gender');
		$discounttype=$this->input->post('discounttype');
		$discountid=$this->input->post('discountid');
		$province=$this->input->post('province');
		$city=$this->input->post('city');
		$barangay=$this->input->post('barangay');
		$street=$this->input->post('street');
		$zipcode=$this->input->post('zipcode');
		$demographics=$barangay."_".$city."_".$province;
		$ap=$this->input->post('ap');
		$bday = new DateTime($dateofbirth); // Your date of birth
		$today = new Datetime(date('Y-m-d'));
		$diff = $today->diff($bday);
		$age=$diff->y;
		if(($age >= 60 && $discounttype=="SENIOR") || $discounttype=="PWD" || $age >= 60){
			$senior="Y";
			$discounttype=$discounttype;
		}else{
			$senior="N";
			$discounttype="NONE";
		}
		$dateadmit=date('M-d-Y');
		$timeadmit=date('H:i:s');
		$date=date('Y-m-d');
		$check=$this->db->query("SELECT * FROM patientprofile WHERE lastname='$lastname' AND firstname='$firstname' AND middlename='$middlename' AND dateofbirth='$dateofbirth' AND patientidno <> '$pid'");
		if($check->num_rows() > 0 && $patientidno==""){			
			return false;
			echo "<script>alert('Unable to save details! Duplicate Entry');window.history.back();</script>";
		}else{
		//Account Ledger===================================
		$this->db->query("INSERT INTO patientprofileid(caseno) VALUES('$caseno')");
		$this->db->query("INSERT INTO acctledge(patientidno,balance,`date`,admittingofficer) VALUE('$pid','0','$date','$admittingclerk')");
		//=================================================

		//Address==========================================
		$prov=$this->db->query("SELECT * FROM `state` WHERE id='$province' OR statename = '$province'");
		$state=$prov->row_array();
		$provincecode=$state['id'];
		$provincename=$state['statename'];

		$municipality=$this->db->query("SELECT * FROM city WHERE id='$city' OR city='$city'");
		$municity=$municipality->row_array();
		$citycode=$municity['id'];
		$cityname=$municity['city'];

		$barang=$this->db->query("SELECT * FROM barangay WHERE id='$barangay' OR barangay='$barangay'");
		$bar=$barang->row_array();
		$barcode=$bar['id'];
		$barangayname=$bar['barangay'];
		//=================================================

		//Doctor=================================
		$doctor=$this->db->query("SELECT * FROM docfile WHERE code='$ap'");
		$doc=$doctor->row_array();
		$apname=$doc['name'];
		$arSpecialization=$doc['specialization'];
		//=================================================

		//=================================================
		if($patientidno==""){
			//Patient Profile==================================
			$this->db->query("INSERT INTO patientprofile(patientidno,lastname,firstname,middlename,suffix,birthdate,age,sex,senior,patientname,dateofbirth,type) VALUES('$pid','$lastname','$firstname','$middlename','$suffix','$birthdate','$age','$gender','$senior','$patientname','$dateofbirth','$date')");
			$this->db->query("INSERT INTO patientprofileaddinfo(patientidno,discounttype,discountid) VALUES('$pid','$discounttype','$discountid')");
			//=================================================
		}else{
			$this->db->query("UPDATE patientprofile SET lastname='$lastname',firstname='$firstname',middlename='$middlename',suffix='$suffix',birthdate='$birthdate',age='$age',sex='$gender',senior='$senior',patientname='$patientname',dateofbirth='$dateofbirth' WHERE patientidno='$pid'");
			$check=$this->db->query("SELECT * FROM patientprofileaddinfo WHERE patientidno='$pid'");
			if($check->num_rows() > 0){
				$this->db->query("UPDATE patientprofileaddinfo SET discounttype='$discounttype',discountid='$discountid' WHERE patientidno='$pid'");				
			}else{
				$this->db->query("INSERT INTO patientprofileaddinfo(patientidno,discounttype,discountid) VALUES('$pid','$discounttype','$discountid')");
			}
		}
		//Admission========================================
		$this->db->query("INSERT INTO admission(patientidno,caseno,`type`,membership,hmomembership,hmo,policyno,paymentmode,room,ward,street,barangay,municipality,province,zipcode,middlenamed,initialdiagnosis,ad,ap,`case`,dateadmitted,timeadmitted,`status`,casetype,birthplace,stat1,patientadmit,religion,occupation,job,employerno,notify,relationship,`proc`,contactno,course,patientcontactno,diet,admittingclerk,dateadmit,`count`,branch,consult_id,lastnamed,firstnamed,senior) VALUES('$pid','$caseno','','','','','0','','OPD','out','$street','$barangayname','$cityname','$provincename','$zipcode','','','$ap','$ap','','$dateadmit','$timeadmit','Active','A','','','','','','restrict','$caseno','','','$age','','NEW','$contactno','','$admittingclerk','$date','1','KMSCI','$demographics','','','$senior')");
		$this->db->query("INSERT INTO admissionaddinfo(caseno,chiefcomplaint) VALUES('$caseno','')");
		//=================================================

		return true;
	}
	}
	public function checkMESheet($caseno){
		$odb=$this->load->database('cf4',true);
		$result=$odb->query("SELECT * FROM pemisc WHERE caseno='$caseno' GROUP BY caseno");
		if($result->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function save_vital_signs(){
		$caseno=$this->input->post('caseno');
		$sys=$this->input->post('systolic');
		$dia=$this->input->post('diastolic');
		$temp=$this->input->post('temp');
		$height=$this->input->post('height');
		$weight=$this->input->post('weight');
		$pr=$this->input->post('pr');
		$rr=$this->input->post('rr');
		$bp=$sys."/".$dia;

		$result=$this->db->query("UPDATE admission SET temp='$temp',bp='$bp',height='$height',weight='$weight' WHERE caseno='$caseno'");
		if($result){
			$this->db->query("UPDATE admissionaddinfo SET heartrate='$pr',respiratoryrate='$rr' WHERE caseno='$caseno'");
			return true;
		}else{
			return false;
		}
	}
	public function fetch_vital_signs($caseno){
		$result=$this->db->query("SELECT a.*,ad.* FROM admission a INNER JOIN admissionaddinfo ad on ad.caseno=a.caseno WHERE a.caseno='$caseno'");
		return $result->result_array();
	}
	public function fetch_credit_limit($caseno){
		$result=$this->db->query("SELECT * FROM patientscredit WHERE caseno='$caseno'");
		return $result->result_array();
	}
	public function save_credit_limit(){
		$caseno=$this->input->post('caseno');
		$credit=$this->input->post('newcredit');
		$check=$this->db->query("SELECT * FROM patientscredit WHERE caseno='$caseno'");
		if($check->num_rows()>0){
			$save=$this->db->query("UPDATE patientscredit SET creditlimit='$credit' WHERE caseno='$caseno'");
		}else{
			$save=$this->db->query("INSERT INTO patientscredit(caseno,creditlimit) VALUES('$caseno','$credit')");
		}
		if($save){
			return true;
		}else{
			return false;
		}
	}
	public function checkItems($caseno){
		$result=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND (`status` = 'Approved' OR `status` = 'PAID') AND (administration='dispensed' OR terminalname='Testdone' OR administration='administered')");
		return $result->result_array();
	}
	public function cancel_opd_admission($caseno){
		$result=$this->db->query("UPDATE admission SET `status`='CANCELLED', ward='CANCELLED' WHERE caseno='$caseno'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function getReferredSummary(){
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$result=$this->db->query("SELECT pp.lastname,pp.firstname,pp.middlename,pp.suffix,t.hci as hospital,a.disposition FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno INNER JOIN claiminfoadd t ON t.caseno=a.caseno WHERE t.hciyes='checked' AND a.dateadmit BETWEEN '$startdate' AND '$enddate' ORDER BY pp.lastname ASC,pp.firstname ASC");
		return $result->result_array();
	}
	public function update_opd_membership(){
		$caseno=$this->input->post("caseno");
		$membership=$this->input->post("membership");
		$type=$this->input->post("type");
		$paymentmode=$this->input->post("paymentmode");
		if($membership=="No"){
			$membership="Nonmed-none";
			$type="N/A";
			$paymentmode="N/A";
		}
		$result=$this->db->query("UPDATE admission SET membership='$membership',`type`='$type',paymentmode='$paymentmode' WHERE caseno='$caseno'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function getAllDischargedPatient(){
		$date=date('Y-m-d');
		$result=$this->db->query("SELECT a.*, CONCAT(pp.lastname,', ',pp.firstname) as patientname,dt.datedischarged,dt.timedischarged,d.name FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN dischargedtable dt ON dt.caseno=a.caseno INNER JOIN docfile d ON d.code=a.ap WHERE a.caseno LIKE '%O-%' AND a.dateadmit='$date' AND a.status='discharged'");
		return $result->result_array();
	}
	public function getOBReports(){
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$result=$this->db->query("SELECT pp.lastname,pp.firstname,pp.middlename,pp.dateofbirth,pp.age,a.dateadmit,d.name,a.initialdiagnosis FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN docfile d ON d.code=a.ap WHERE d.specialization='OB-GYNE' AND a.dateadmit BETWEEN '$startdate' AND '$enddate' AND a.caseno LIKE '%I-%' GROUP BY a.caseno,a.patientidno ORDER BY a.dateadmit ASC");
		return $result->result_array();
	}
}
