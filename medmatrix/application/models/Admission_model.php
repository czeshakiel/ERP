<?php
date_default_timezone_set('Asia/Manila');
class Admission_model extends CI_model
{
	public function __construct()
	{
		$this->load->database();
	}
	public function getSelectedPatient($searchme){
		$result=$this->db->query("SELECT pp.* FROM patientprofile pp LEFT JOIN admission a ON a.patientidno=pp.patientidno WHERE CONCAT(pp.lastname,' ',pp.firstname) LIKE '%%$searchme%%' OR a.employerno = '$searchme' GROUP BY a.patientidno ORDER BY a.dateadmit DESC");
		return $result->result_array();
	}
	public function getSelectedRDUPatient($searchme){
		$result=$this->db->query("SELECT pp.*,a.caseno,a.status,a.dateadmitted FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE CONCAT(lastname,' ',firstname) LIKE '%%$searchme%%' AND (a.caseno LIKE 'R-%' OR a.caseno LIKE '%WD-%' OR a.caseno LIKE '%W-%') ORDER BY a.dateadmit DESC");
		return $result->result_array();
	}
	public function getLastVisit($patientidno){
		$lastvisit=$this->db->query("SELECT dateadmitted FROM admission WHERE patientidno='$patientidno' GROUP BY patientidno ORDER BY dateadmit DESC LIMIT 1");
		return $lastvisit->row_array();
	}
	public function checkAdmission($patientidno){
		$state=$this->db->query("SELECT * FROM admission WHERE patientidno='$patientidno' AND (ward='in' OR disposition='DIED' OR (ward='out' AND employerno LIKE '%RDU%' AND status='Active' AND room='RDU')) GROUP BY patientidno ORDER BY dateadmit DESC");
		if($state->num_rows()>0){
			return $state->row_array();
		}else{
			return false;
		}
	}
	public function getAllInpatient(){
		$result=$this->db->query("SELECT a.*,pp.lastname,pp.firstname,pp.middlename,pp.suffix,ad.name as adname,ap.name as apname FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN docfile ad ON ad.code=a.ad INNER JOIN docfile ap ON ap.code=a.ap WHERE a.ward='in' AND a.caseno LIKE '%I-%' ORDER BY dateadmit DESC,timeadmitted DESC");
		return $result->result_array();
	}
	public function getAllInpatientHMO(){
		$result=$this->db->query("SELECT a.*,pp.lastname,pp.firstname,pp.middlename,pp.suffix,ad.name as adname,ap.name as apname FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN docfile ad ON ad.code=a.ad INNER JOIN docfile ap ON ap.code=a.ap WHERE a.ward='in' AND a.caseno LIKE '%I-%' AND (a.status='MGH' OR a.hmo <> '') AND a.hmo <> 'N/A' ORDER BY dateadmit DESC,timeadmitted DESC");
		return $result->result_array();
	}
	public function getSingleInpatient($searchme){
		$result=$this->db->query("SELECT a.*,pp.lastname,pp.firstname,pp.middlename,pp.suffix,ad.name as adname,ap.name as apname FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN docfile ad ON ad.code=a.ad INNER JOIN docfile ap ON ap.code=a.ap WHERE a.ward='in' AND a.caseno LIKE '%I-%' AND CONCAT(pp.lastname,' ',pp.firstname) LIKE '%%$searchme%%' ORDER BY dateadmit DESC,timeadmitted DESC");
		return $result->result_array();
	}
	public function getAllARPatient($dateadmit){
		// if($dateadmit==""){
		// 	$dateadmit=date('Y-m-d');
		// }
		if($this->session->dept=="KONSULTA"){
			$result=$this->db->query("SELECT a.*,pp.lastname,pp.firstname,pp.middlename,pp.suffix,ad.name as adname,ap.name as apname FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno LEFT JOIN docfile ad ON ad.code=a.ad LEFT JOIN docfile ap ON ap.code=a.ap WHERE a.ward='out' AND a.caseno LIKE '%ARK-%' AND a.dateadmit='$dateadmit' ORDER BY dateadmit DESC,timeadmitted DESC");
		}else{
			$result=$this->db->query("SELECT a.*,pp.lastname,pp.firstname,pp.middlename,pp.suffix,ad.name as adname,ap.name as apname FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno LEFT JOIN docfile ad ON ad.code=a.ad LEFT JOIN docfile ap ON ap.code=a.ap WHERE a.ward='out' AND a.caseno LIKE '%AR-%' AND a.dateadmit='$dateadmit' ORDER BY dateadmit DESC,timeadmitted DESC");
		}
		return $result->result_array();
	}
	public function getAllRDUARPatient($dateadmit){
		//$dateadmit=$this->session->startdate;
		$result=$this->db->query("SELECT a.*,pp.lastname,pp.firstname,pp.middlename,pp.suffix,ad.name as adname,ap.name as apname FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN docfile ad ON ad.code=a.ad INNER JOIN docfile ap ON ap.code=a.ap WHERE a.ward='out' AND a.status='Active' AND a.caseno LIKE 'ARD-%' AND a.dateadmit='$dateadmit' ORDER BY dateadmit DESC,timeadmitted DESC");
		return $result->result_array();
	}
	public function getSingleARPatient($searchme){
		if($this->session->dept=="KONSULTA"){
			$result=$this->db->query("SELECT a.*,pp.lastname,pp.firstname,pp.middlename,pp.suffix,ad.name as adname,ap.name as apname FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN docfile ad ON ad.code=a.ad INNER JOIN docfile ap ON ap.code=a.ap WHERE a.ward='out' AND a.status='Active' AND a.caseno LIKE 'ARK-%' AND CONCAT(pp.lastname,' ',pp.firstname) LIKE '%%$searchme%%' ORDER BY dateadmit DESC,timeadmitted DESC");
		}else{
			$result=$this->db->query("SELECT a.*,pp.lastname,pp.firstname,pp.middlename,pp.suffix,ad.name as adname,ap.name as apname FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN docfile ad ON ad.code=a.ad INNER JOIN docfile ap ON ap.code=a.ap WHERE a.ward='out' AND a.status='Active' AND a.caseno LIKE 'AR-%' AND CONCAT(pp.lastname,' ',pp.firstname) LIKE '%%$searchme%%' ORDER BY dateadmit DESC,timeadmitted DESC");
		}
		return $result->result_array();
	}
	public function getSingleRDUARPatient($searchme){
		$result=$this->db->query("SELECT a.*,pp.lastname,pp.firstname,pp.middlename,pp.suffix,ad.name as adname,ap.name as apname FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN docfile ad ON ad.code=a.ad INNER JOIN docfile ap ON ap.code=a.ap WHERE a.ward='out' AND a.status='Active' AND a.caseno LIKE '%ARD-%' AND CONCAT(pp.lastname,' ',pp.firstname) LIKE '%%$searchme%%' ORDER BY dateadmit DESC,timeadmitted DESC");
		return $result->result_array();
	}
	public function fetch_previous_admission($patientidno){
		$state=$this->db->query("SELECT a.*,pp.*,pa.discounttype,pa.discountid,a.type FROM admission a LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno LEFT JOIN patientprofileaddinfo pa ON pa.patientidno=pp.patientidno WHERE pp.patientidno='$patientidno' ORDER BY a.dateadmit DESC LIMIT 1");
		if($state->num_rows()>0){
			return $state->row_array();
		}else{
			if($this->session->dept=="HMO"){
				$state=$this->db->query("SELECT pp.*,a.* FROM patientprofile pp LEFT JOIN admission a ON a.patientidno=pp.patientidno WHERE pp.patientidno='$patientidno'");
			}else{
				$state=$this->db->query("SELECT a.*,pp.*,pa.discounttype,pa.discountid,a.type FROM admission a LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno LEFT JOIN patientprofileaddinfo pa ON pa.patientidno=pp.patientidno WHERE pp.patientidno='$patientidno' ORDER BY a.dateadmit DESC LIMIT 1");
			}
			return $state->row_array();
		}
	}
	public function save_admission($patientidno,$pid,$caseno,$admittingclerk,$empid){
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
		$ad=$this->input->post('ad');
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
		$case=$this->input->post('case');
		$room=$this->input->post('room');

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
		$doctor=$this->db->query("SELECT `name` FROM docfile WHERE code='$ap'");
		$doc=$doctor->row_array();
		$apname=$doc['name'];

		$doctor=$this->db->query("SELECT `name` FROM docfile WHERE code='$ad'");
		$doc=$doctor->row_array();
		$adname=$doc['name'];
		//=================================================

		//Room Rates=======================================
		$rates=$this->db->query("SELECT * FROM room WHERE room='$room'");
		$rate=$rates->row_array();
		$roomrates=$rate['roomrates'];
		$creditlimit=$rate['pfadmit'];
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
		$this->db->query("INSERT INTO admission(patientidno,caseno,`type`,membership,hmomembership,hmo,policyno,paymentmode,room,ward,street,barangay,municipality,province,zipcode,middlenamed,initialdiagnosis,ad,ap,`case`,dateadmitted,timeadmitted,`status`,casetype,birthplace,stat1,patientadmit,religion,occupation,job,employerno,notify,relationship,`proc`,contactno,course,patientcontactno,diet,admittingclerk,dateadmit,`count`,branch,consult_id,lastnamed,firstnamed,senior) VALUES('$pid','$caseno','$type','$membership','$hmomembership','$hmo','$loalimit','$paymentmode','$room','in','$street','$barangayname','$cityname','$provincename','$zipcode','$contactperson','','$ad','$ap','$case','$dateadmit','$timeadmit','Active','A','','$civilstatus','$disposition','$religion','','restrict','$hcn','$nationality','$contactpersonrelation','$age','$contactpersonno','NEW','$contactno','','$admittingclerk','$date','1','KMSCI','$demographics','$father','$mother','$senior')");
		$this->db->query("INSERT INTO admissionaddinfo(caseno,chiefcomplaint) VALUES('$caseno','')");
		//=================================================

		//Productout=======================================
		$refno=$this->General_model->generateRefNo('RN',$admittingclerk);
		if($hmomembership == "none" || $hmomembership == "hmo-company") {
			$roomhmo = "0";
			$roomcash = $roomrates;
		}
		if($hmomembership == "hmo-hmo") {
			$roomhmo = $roomrates;
			$roomcash = "0";
		}
		$this->db->query("INSERT INTO productout(refno,invno,caseno,productcode,productdesc,sellingprice,quantity,adjustment,gross,trantype,phic,hmo,excess,`date`,status,loginuser,productsubtype,shift,location,datearray) VALUES('$refno','$timeadmit','$caseno','$room','$room','$roomrates','1','0','$roomrates','charge','0','$roomhmo','$roomcash','$dateadmit','Approved','$admittingclerk','ROOM ACCOMODATION','KMSCI','0','$date')");
		$refno=$this->General_model->generateRefNo('RN',$admittingclerk);
		$this->db->query("INSERT INTO productout(refno,invno,caseno,productcode,productdesc,sellingprice,quantity,adjustment,gross,trantype,phic,hmo,excess,`date`,status,loginuser,producttype,productsubtype,shift,location,datearray) VALUES('$refno','$timeadmit','$caseno','$ad','$adname','0.00','1','0','0.00','charge','0.00','0.00','0.00','$dateadmit','Approved','$admittingclerk','IPD admitting','PROFESSIONAL FEE','KMSCI','0','$date')");
		$autocharge=$this->db->query("SELECT ac.code,r.itemname,r.sellingprice,r.unit FROM admissionautocharge ac INNER JOIN receiving r ON r.code=ac.code");
		$ac=$autocharge->result_array();
		foreach($ac as $auto){
			$refno=$this->General_model->generateRefNo('RN',$admittingclerk);
			$this->db->query("INSERT INTO productout(refno,invno,caseno,productcode,productdesc,sellingprice,quantity,adjustment,gross,trantype,phic,hmo,excess,`date`,status,loginuser,producttype,productsubtype,shift,location,datearray) VALUES('$refno','$timeadmit','$caseno','$auto[code]','$auto[itemname]','$auto[sellingprice]','1','0','$auto[sellingprice]','charge','0','0','$auto[sellingprice]','$dateadmit','Approved','$admittingclerk','$st','$auto[unit]','KMSCI','0','$date')");
		}
		//========================================================

		//Diet List===============================================
		$this->db->query("INSERT INTO dietlist(caseno,code,empid,`date`,`time`,room) VALUES('$caseno','','$empid','$date','$timeadmit','UPON ADMISSION')");
		//========================================================

		//Transfer================================================
		if($transferfrom=="YES"){
			$this->db->query("INSERT INTO transfers(caseno,status,hospital,dateoftransfer,census) VALUES('$caseno','incoming','$transfrom','$date','1')");
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

		//Room Status======================================
		$this->db->query("UPDATE room SET roomstat ='occupied' where room = '$room'");
		//=================================================

		//Credit Limit=====================================
		$this->db->query("INSERT INTO patientscredit(caseno,creditlimit) VALUES('$caseno','$creditlimit')");
		//=================================================

		return true;
	}
	}
	public function save_ar_admission($patientidno,$pid,$caseno,$admittingclerk,$empid){
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
		$province=$this->input->post('province');
		$city=$this->input->post('city');
		$barangay=$this->input->post('barangay');
		$street=$this->input->post('street');
		$zipcode=$this->input->post('zipcode');
		$demographics=$barangay."_".$city."_".$province;
		$ap=$this->input->post('ap');
		$hcn=$this->input->post('hcn');
		$chargeto=explode('_',$this->input->post('chargeto'));
		$charge=$chargeto[0];
		$artype=$this->input->post('artype');

		$bday = new DateTime($dateofbirth); // Your date of birth
		$today = new Datetime(date('Y-m-d'));
		$diff = $today->diff($bday);
		$age=$diff->y;
		if($age >= 60){
			$senior="Y";
			$discounttype="SENIOR";
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
		//=================================================

		//Address==========================================
		$prov=$this->db->query("SELECT statename,id FROM `state` WHERE id='$province' OR statename = '$province'");
		$state=$prov->row_array();
		$provincecode=$state['id'];
		$provincename=$state['statename'];

		$municipality=$this->db->query("SELECT city,id FROM city WHERE id='$city' OR city='$city'");
		$municity=$municipality->row_array();
		$citycode=$municity['id'];
		$cityname=$municity['city'];

		$barang=$this->db->query("SELECT barangay,id FROM barangay WHERE id='$barangay' OR barangay='$barangay'");
		$bar=$barang->row_array();
		$barcode=$bar['id'];
		$barangayname=$bar['barangay'];
		//=================================================

		if($patientidno==""){
			//Patient Profile==================================
			$this->db->query("INSERT INTO patientprofile(patientidno,lastname,firstname,middlename,suffix,birthdate,age,sex,senior,patientname,dateofbirth,type) VALUES('$pid','$lastname','$firstname','$middlename','$suffix','$birthdate','$age','$gender','$senior','$patientname','$dateofbirth','$date')");
			$this->db->query("INSERT INTO patientprofileaddinfo(patientidno,discounttype,discountid) VALUES('$pid','$discounttype','')");
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
		$checkHMO=$this->db->query("SELECT * FROM company WHERE companyname='$charge'");
		if($checkHMO->num_rows()>0){
			$h=$checkHMO->row_array();
			if($h['type']=="hmo"){
				$hmo=$charge;
            	$charge="";
			}else{
				$hmo="";
			}
		}else{
			$hmo="";
		}
		//Admission========================================
		$this->db->query("INSERT INTO admission(patientidno,caseno,`type`,membership,hmomembership,hmo,policyno,paymentmode,room,ward,street,barangay,municipality,province,zipcode,middlenamed,initialdiagnosis,ad,ap,`case`,dateadmitted,timeadmitted,`status`,casetype,birthplace,stat1,patientadmit,religion,occupation,job,employerno,notify,relationship,`proc`,contactno,course,patientcontactno,diet,admittingclerk,dateadmit,`count`,branch,consult_id,lastnamed,firstnamed,addemployer,senior) VALUES('$pid','$caseno','N/A','none','none','$hmo','0','','OPD','out','$street','$barangayname','$cityname','$provincename','$zipcode','','','$ap','$ap','','$dateadmit','$timeadmit','Active','A','','','','','','restrict','$hcn','','','$age','','NEW','$contactno','','$admittingclerk','$date','1','KMSCI','$demographics','','','$charge','$senior')");
		//=================================================
		if($this->session->dept=="HMO" && $artype=="quotation"){
			$case="";
			$sqlItems=$this->db->query("SELECT qd.* FROM quotationdetails qd INNER JOIN quotation q ON q.caseno=qd.caseno WHERE q.patientidno='$patientidno'");
			if($sqlItems->num_rows() > 0){
			$items=$sqlItems->result_array();
			foreach($items as $item){
			    $code=$item['productcode'];
			    $desc=$item['productdesc'];
			    $qty=$item['quantity'];
			    $unitcost=$item['price_cash'];
			    $case=$item['caseno'];
			    $gross=$unitcost*$qty;
			    $sqlUnit=$this->db->query("SELECT unit FROM receiving WHERE code='$code'");
			    $unit=$sqlUnit->row_array();
			    $productsubtype=$unit['unit'];
			    if($productsubtype=="PHARMACY/MEDICINE" || $productsubtype=="PHARMACY/SUPPLIES"){
			        $batch="PHARMACY".$case;
			        if($productsubtype=="PHARMACY/MEDICINE"){
			          $type="med";
			        }else{
			          $type="sup";
			        }
			    }else{
			      $batch="LXD".$case;
			    }
			    $sqlRR=$this->db->query("SELECT rrno FROM stocktable WHERE code='$code' AND dept='PHARMACY' having SUM(quantity) >= '$qty' ORDER BY datearray ASC LIMIT 1");
			    if($sqlRR->num_rows() > 0){
			      $rr=$sqlRR->row_array();
			      $terminalname=$rr['rrno'];
			    }else{
			      $terminalname="pending";
			    }

			    //KNOW IF SENIOR-----------------------------
			    $asql=$this->db->query("SELECT `senior`, `patientname` FROM `patientprofile` WHERE `patientidno`='$patientidno'");
			    if($asql->num_rows() > 0){
			      $afetch=$asql->row_array();
			      $sn=$afetch['senior'];
			      $patname=$afetch['patientname'];
			    }
			    else{
			      $sn="N";
			      $patname="ERROR!!!";
			    }

			    if($sn=="Y"){
			      $adj=$gross*0.20;
			      $newgross=$gross-$adj;
			    }
			    else{
			      $adj=0;
			      $newgross=$gross;
			    }
			    //-------------------------------------------

			    $refno=$this->General_model->generateRefNo('RN',$admittingclerk);
			    $SQLproductout=$this->db->query("INSERT INTO productout(refno,invno,caseno,productcode,productdesc,sellingprice,quantity,adjustment,gross,trantype,phic,hmo,excess,`date`,status,loginuser,productsubtype,shift,location,datearray,administration,producttype,batchno,referenceno,terminalname) VALUES('$refno','$timeadmit','$caseno','$code','$desc','$unitcost','$qty','$adj','$newgross','charge','0','0','$newgross','$dateadmit','Approved','$admittingclerk','$productsubtype','$branch','PHARMACY','$date','pending','$type','$batch','QR-1','$terminalname')");
			    if($productsubtype =="LABORATORY"){
			      $timeofreq=date('M_d_Y_H:i');
			      $sqlTest=$this->db->query("SELECT lotno FROM receiving WHERE code='$code'");
			    $test=$sqlTest->row_array();
			    $SQLproductout=$this->db->query("INSERT INTO labtest(caseno,test,testdetails,timeofreq,refno,labno,specs,`interval`,remarks) VALUES('$caseno','$test[lotno]','$desc','$timeofreq','$refno','0','','','')");

			    $this->db->query("INSERT INTO `labpending` (`refno`, `patientidno`, `caseno`, `patientname`, `itemcode`, `productdesc`, `ptype`, `trantype`, `status`, `resultstatus`, `station`, `dateadded`, `timeadded`, `user`, `viewcount`) VALUES ('$refno', '$patientidno', '$caseno', '$patname', '$code', '$desc', '$productsubtype', 'charge', 'Approved', 'pending', 'HMO', '".date("Y-m-d")."', '".date("H:i:s")."', '$admittingclerk', '0')");
			    }

			  }
			}
		}
		return true;
	}
	}
	public function cancel_admission($caseno,$room){
		$admittingclerk=$this->session->fullname;
		$result=$this->db->query("UPDATE admission SET ward='CANCELLED',`status`='CANCELLED',admittingclerk='$admittingclerk',employerno='cancel' WHERE caseno='$caseno'");
		$result=$this->db->query("UPDATE room SET roomstat='vacant' WHERE room='$room'");
		return $result;

	}
	public function checkCharge($caseno){
		$check=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND (((productsubtype LIKE '%PHARMACY/MEDICINE%' OR productsubtype LIKE '%PHARMACY/SUPPLIES%') AND administration='dispensed') OR ((productsubtype LIKE '%LABORATORY%' OR productsubtype LIKE '%XRAY%' OR productsubtype LIKE '%CT SCAN%' OR productsubtype LIKE '%ULTRASOUND%') AND (terminalname LIKE '%Testdone%' OR terminalname='Testtobedone'))) AND trantype='charge' AND quantity > 0 GROUP BY caseno");
		if($check->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function checkChargeRDU($caseno){
		$check=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%SUPPLIES%' AND trantype='charge' AND quantity > 0 GROUP BY caseno");
		if($check->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	public function save_admission_change_room(){
		$admittingclerk=$this->session->fullname;
		$caseno=$this->input->post('caseno');
		$oldroom=$this->input->post('oldroom');
		$newroom=$this->input->post('newroom');
		$datenow=date('Y-m-d');
		$oldcredit=$this->db->query("SELECT * FROM patientscredit WHERE caseno='$caseno'");
		$credit=$oldcredit->row_array();
		$oldcreditlimit=$credit['creditlimit'];
		$rdetails=$this->db->query("SELECT * FROM room WHERE room='$newroom'");
		$room=$rdetails->row_array();
		$newcreditlimit=$room['pfadmit'];
		$sqlCheckDate=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype='ROOM ACCOMODATION' ORDER BY datearray DESC,invno DESC LIMIT 1");
		$checkDate=$sqlCheckDate->row_array();
		$oldroomdate=$checkDate['datearray']." ".$checkDate['invno'];
		$roomdate=date_diff(date_create(date('Y-m-d H:i:s')),date_create($oldroomdate));
		if($roomdate->h < 6 && ($checkDate['productdesc']=="ER BED 1" || $checkDate['productdesc']=="ER BED 2" || $checkDate['productdesc']=="ER BED 3" || $checkDate['productdesc']=="ER BED 4" || $checkDate['productdesc']=="ER BED 5" || $checkDate['productdesc']=="ER BED 6" || $checkDate['productdesc']=="ER BED 7" || $checkDate['productdesc']=="ER BED 8" || $checkDate['productdesc']=="ER BED 9" || $checkDate['productdesc']=="ER BED 10" || $checkDate['productdesc']=="ER BED 11")){
			$this->db->query("UPDATE productout SET quantity='0',sellingprice='0.00',adjustment='0.00',gross='0.00',hmo='0.00',phic='0.00',excess='0.00',phic1='0.00' WHERE refno='$checkDate[refno]'");
		}
		$refno=$this->General_model->generateRefNo('RN',$admittingclerk);
		$time=date('H:i:s');
		$dat=date('M-d-Y');
		$this->db->query("INSERT INTO productout(refno,invno,caseno,productcode,productdesc,sellingprice,quantity,adjustment,gross,trantype,phic,hmo,excess,`date`,`status`,terminalname,loginuser,batchno,producttype,productsubtype,approvalno,referenceno,administration,shift,`location`,datearray,phic1) VALUES('$refno','$time','$caseno','$newroom','$newroom','$room[roomrates]','1','0.00','$room[roomrates]','charge','0.00','0.00','$room[roomrates]','$dat','Approved','','$admittingclerk','','','ROOM ACCOMODATION','','','','KMSCI','ADMISSION','$datenow','0.00')");
		$this->db->query("UPDATE room SET roomstat='occupied' WHERE room='$newroom'");
		$this->db->query("UPDATE room SET roomstat='vacant' WHERE room='$oldroom'");
		if($newcreditlimit>$oldcreditlimit){
			$this->db->query("UPDATE patientscredit SET creditlimit='$newcreditlimit' WHERE caseno='$caseno'");
		}
		$updateAdmission=$this->db->query("UPDATE admission SET room='$newroom' WHERE caseno='$caseno'");
		return $updateAdmission;
	}
	public function save_admission_hmo(){
		$admittingclerk=$this->session->fullname;
		$caseno=$this->input->post('caseno');
		$newhmo=$this->input->post('newhmo');
		$newloa=$this->input->post('newloa');
		if($newhmo=="N/A"){
			$hmo="none";
		}else{
			$hmo="hmo-hmo";
		}
		$check=$this->db->query("SELECT * FROM admission WHERE caseno='$caseno' AND `status` = 'MGH'");
		if($check->num_rows()>0){
			$update=$this->db->query("UPDATE admission SET hmo='$newhmo',hmomembership='$hmo',policyno='$newloa' WHERE caseno='$caseno'");
		}else{
			$update=$this->db->query("UPDATE admission SET hmo='$newhmo',hmomembership='$hmo',policyno='$newloa',`status`='Active' WHERE caseno='$caseno'");
		}
		if($update){
			return true;
		}else{
			return false;
		}
	}
	public function getCoverSheet($caseno){
		$query=$this->db->query("SELECT pp.*,a.*,d.name,d.specialization FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno INNER JOIN docfile d ON d.code=a.ap WHERE a.caseno='$caseno'");
		return $query->row_array();
	}
	public function discharged($caseno){
		$lastvisit=$this->db->query("SELECT * FROM dischargedtable WHERE caseno='$caseno'");
		return $lastvisit->row_array();
	}
	public function discharge_other($caseno){
		$lastvisit=$this->db->query("UPDATE admission SET ward='discharged',`status`='discharged' WHERE caseno='$caseno'");
		return true;
	}
	public function set_rod($rod){
		$datenow=date('Y-m-d');
		$check=$this->db->query("SELECT * FROM rod WHERE datearray='$datenow' ORDER BY id DESC");
		if($check->num_rows()>0){
			$id=$check->row_array();
			$result=$this->db->query("UPDATE rod SET rod='$rod' WHERE id='$id[id]'");
		}else{
			$result=$this->db->query("INSERT INTO rod(rod,datearray) VALUES('$rod','$datenow')");
		}
		return $result;
	}
	public function set_room_status($id,$status){
		$result=$this->db->query("UPDATE room set roomstat='$status' WHERE autono='$id'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function fetch_single_admission($caseno){
		$case=explode('-',$caseno);
		if($case[0]=="WPOS"){
			$state=$this->db->query("SELECT a.*,pp.*,pa.discounttype,pa.discountid,a.type FROM admission a INNER JOIN patientprofilewalkin pp ON pp.patientidno=a.patientidno LEFT JOIN patientprofileaddinfo pa ON pa.patientidno=pp.patientidno WHERE a.caseno = '$caseno'");
		}else{
			$state=$this->db->query("SELECT a.*,pp.*,pa.discounttype,pa.discountid,a.type FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN patientprofileaddinfo pa ON pa.patientidno=pp.patientidno WHERE a.caseno = '$caseno'");
		}
		if($state->num_rows()>0){
			return $state->row_array();
		}
	}
	public function fetchSingleAdmission($caseno){
		$state=$this->db->query("SELECT a.*,pp.*,pa.discounttype,pa.discountid,a.type FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno LEFT JOIN patientprofileaddinfo pa ON pa.patientidno=pp.patientidno WHERE a.caseno = '$caseno'");
		if($state->num_rows()>0){
			return $state->result_array();
		}
	}
	public function update_admission_details(){
		$caseno=$this->input->post('caseno');
		$dateadmit=$this->input->post('admissiondate');
		$dateadmitted=date('M-d-Y',strtotime($dateadmit));
		$admissiontime=$this->input->post('admissiontime');
		$contactperson=$this->input->post('contactperson');
		$contactpersonno=$this->input->post('contactpersonno');
		$contactpersonrelation=$this->input->post('contactpersonrelation');
		$father=$this->input->post('father');
		$mother=$this->input->post('mother');
		$civilstatus=$this->input->post('civilstatus');
		$religion=$this->input->post('religion');
		$nationality=$this->input->post('nationality');
		$membership=$this->input->post('membership');
		$type=$this->input->post('type');
		$paymentmode=$this->input->post('paymentmode');
		if($membership=="phic-med"){
		}else{
			$type="N/A";
			$paymentmode="";
		}
		$update=$this->db->query("UPDATE admission SET dateadmitted='$dateadmitted',dateadmit='$dateadmit',timeadmitted='$admissiontime',middlenamed='$contactperson',contactno='$contactpersonno',relationship='$contactpersonrelation',lastnamed='$father',firstnamed='$mother',stat1='$civilstatus',religion='$religion',notify='$nationality',type='$type',membership='$membership',paymentmode='$paymentmode' WHERE caseno='$caseno'");
		if($update){
			return true;
		}else{
			return false;
		}
	}

	public function getAllOPDProcedure(){
		$result=$this->db->query("SELECT a.*,pp.lastname,pp.firstname,pp.middlename,pp.suffix,ad.name as adname,ap.name as apname FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN docfile ad ON ad.code=a.ad INNER JOIN docfile ap ON ap.code=a.ap WHERE a.ward='out' AND a.status <> 'discharged' AND a.caseno LIKE '%O-%' ORDER BY a.dateadmit DESC,a.timeadmitted DESC");
		return $result->result_array();
	}
	public function getAllPatientByStation($station){
		$result=$this->db->query("SELECT a.*,pp.lastname,pp.firstname,pp.middlename,pp.suffix,ad.name as adname,ap.name as apname,r.room FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN docfile ad ON ad.code=a.ad INNER JOIN docfile ap ON ap.code=a.ap INNER JOIN room r ON r.room=a.room WHERE a.ward='in' AND a.caseno LIKE '%I-%' AND r.nursestation='$station' ORDER BY r.roomprop ASC,r.room ASC");
		return $result->result_array();
	}
	public function save_initial_diag(){
		$caseno=$this->input->post('caseno');
		$diagnosis=$this->input->post('diagnosis');
		$result=$this->db->query("UPDATE admission SET initialdiagnosis='$diagnosis' WHERE caseno='$caseno'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function getAllRoom($caseno){
		$result=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype='ROOM ACCOMODATION'");
		return $result->result_array();
	}
	public function remove_room($refno){
		$result=$this->db->query("DELETE FROM productout WHERE refno='$refno'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
}
