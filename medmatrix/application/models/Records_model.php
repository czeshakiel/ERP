<?php
date_default_timezone_set('Asia/Manila');
class Records_model extends CI_model
{
	public function __construct()
	{
		$this->load->database();
	}
	public function getAllPatient(){
		$result=$this->db->query("SELECT * FROM patientprofile");
		return $result->result_array();
	}
	public function getAllOutPatient(){
		$result=$this->db->query("SELECT * FROM admission WHERE caseno LIKE '%O-%'");
		return $result->result_array();
	}
	public function getAllWalkinPatient(){
		$result=$this->db->query("SELECT * FROM admission WHERE caseno LIKE '%W-%' AND `status`='discharged'");
		return $result->result_array();
	}
	public function update_discharged_date_time(){
		$patientidno=$this->input->post('patientidno');
		$caseno=$this->input->post('caseno');
		$ddate=$this->input->post('dischargeddate');
		$disdate=date('M-d-Y',strtotime($ddate));
		$dtime=$this->input->post('dischargedtime');
		$result=$this->db->query("UPDATE dischargedtable SET datedischarged='$disdate',datearray='$ddate',timedischarged='$dtime' WHERE caseno='$caseno'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function checkExistICD($caseno,$icdcode){
		$result=$this->db->query("SELECT * FROM finalcaserate WHERE caseno='$caseno' AND icdcode='$icdcode'");
		if($result->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	public function save_diagnosis(){
		$caseno=$this->input->post('caseno');
		$code=$this->input->post('code');
		$description=$this->input->post('description');
		$type=$this->input->post('type');
		$datetime=date("Y-m-d H:i:s");
		$nursename=$this->session->fullname;
		$items=$this->db->query("SELECT * FROM caserates WHERE icdcode='$code'");
		$item=$items->row_array();
		$hospitalshare=$item['hospital'];
		$pfshare=$item['pf'];
		$insert=$this->db->query("INSERT INTO `finalcaserate` (`icdcode`, `hospitalshare`, `pfshare`, `caseno`, `level`, `description`, `desccf2`, `type`, `con`, `datetime`, `user`) VALUES ('$code', '$hospitalshare', '$pfshare', '$caseno', 'additional', '$description', '$description', '$type', '', '$datetime', '$nursename')");
		if($insert){
			return true;
		}else{
			return false;
		}
	}
	public function remove_diagnosis($autono){
		$result=$this->db->query("DELETE FROM finalcaserate WHERE autono='$autono'");
		if($result){
			return true;
		}else{
			return false;
		}
	}

	public function fetch_single_case($id){
		$result=$this->db->query("SELECT * FROM finalcaserate WHERE autono='$id'");
		return $result->result_array();
	}

	public function update_diagnosis(){
		$autono=$this->input->post('autono');
		$description=$this->input->post('description');
		$level=$this->input->post('level');
		$result=$this->db->query("UPDATE finalcaserate SET description='$description' WHERE autono='$autono'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function update_disposition(){
		$caseno=$this->input->post('caseno');
		$disposition=$this->input->post('disposition');
		$status=$this->input->post('status');
		$update=$this->db->query("UPDATE admission SET disposition='$disposition',status='$status',ward='$status' WHERE caseno='$caseno'");
		if($update){
			return true;
		}else{
			return false;
		}
	}
	public function getChiefComplaint($caseno){
		$odb=$this->load->database('cf4',true);
		$result=$odb->query("SELECT * FROM subjective WHERE caseno='$caseno'");
		return $result->row_array();
	}
	public function getGenSurvey($caseno){
		$odb=$this->load->database('cf4',true);
		$result=$odb->query("SELECT * FROM pegensurvey WHERE caseno='$caseno'");
		return $result->row_array();
	}
	public function getVitalSigns($caseno){
		$odb=$this->load->database('cf4',true);
		$result=$odb->query("SELECT * FROM pepert WHERE caseno='$caseno'");
		return $result->row_array();
	}
	public function getAbdomen($caseno){
		$odb=$this->load->database('cf4',true);
		$epcb=$this->load->database('epcb',true);
		$result=$epcb->query("SELECT * FROM tsekap_lib_abdomen WHERE LIB_STAT ='1' ORDER BY SORT_NO ASC");
		$res=$result->result_array();
		$desc="";
		foreach($res as $abdomen){
			$check=$odb->query("SELECT * FROM pemisc WHERE caseno='$caseno'");
			$items=$check->result_array();
			foreach($items as $item){
				if($abdomen['ABDOMEN_ID']==$item['pAbdomenId']){
					$desc=$abdomen['ABDOMEN_DESC'];
				}
			}
		}
		return $desc;
	}
	public function getHeent($caseno){
		$odb=$this->load->database('cf4',true);
		$epcb=$this->load->database('epcb',true);
		$result=$epcb->query("SELECT * FROM tsekap_lib_heent WHERE LIB_STAT ='1' ORDER BY SORT_NO ASC");
		$res=$result->result_array();
		$desc="";
		foreach($res as $abdomen){
			$check=$odb->query("SELECT * FROM pemisc WHERE caseno='$caseno'");
			$items=$check->result_array();
			foreach($items as $item){
				if($abdomen['HEENT_ID']==$item['pHeentId']){
					$desc=$abdomen['HEENT_DESC'];
				}
			}
		}
		return $desc;
	}
	public function getGUIE($caseno){
		$odb=$this->load->database('cf4',true);
		$epcb=$this->load->database('epcb',true);
		$result=$epcb->query("SELECT * FROM tsekap_lib_genitourinary WHERE LIB_STAT ='1' ORDER BY SORT_NO ASC");
		$res=$result->result_array();
		$desc="";
		foreach($res as $abdomen){
			$check=$odb->query("SELECT * FROM pemisc WHERE caseno='$caseno'");
			$items=$check->result_array();
			foreach($items as $item){
				if($abdomen['GU_ID']==$item['pGuId']){
					$desc=$abdomen['GU_DESC'];
				}
			}
		}
		return $desc;
	}
	public function getChest($caseno){
		$odb=$this->load->database('cf4',true);
		$epcb=$this->load->database('epcb',true);
		$result=$epcb->query("SELECT * FROM tsekap_lib_chest WHERE LIB_STAT ='1' ORDER BY SORT_NO ASC");
		$res=$result->result_array();
		$desc="";
		foreach($res as $abdomen){
			$check=$odb->query("SELECT * FROM pemisc WHERE caseno='$caseno'");
			$items=$check->result_array();
			foreach($items as $item){
				if($abdomen['CHEST_ID']==$item['pChestId']){
					$desc=$abdomen['CHEST_DESC'];
				}
			}
		}
		return $desc;
	}
	public function getSkin($caseno){
		$odb=$this->load->database('cf4',true);
		$epcb=$this->load->database('epcb',true);
		$result=$epcb->query("SELECT * FROM tsekap_lib_skin_extremities WHERE LIB_STAT ='1' ORDER BY SORT_NO ASC");
		$res=$result->result_array();
		$desc="";
		foreach($res as $abdomen){
			$check=$odb->query("SELECT * FROM pemisc WHERE caseno='$caseno'");
			$items=$check->result_array();
			foreach($items as $item){
				if($abdomen['SKIN_ID']==$item['pSkinId']){
					$desc=$abdomen['SKIN_DESC'];
				}
			}
		}
		return $desc;
	}
	public function getHeart($caseno){
		$odb=$this->load->database('cf4',true);
		$epcb=$this->load->database('epcb',true);
		$result=$epcb->query("SELECT * FROM tsekap_lib_heart WHERE LIB_STAT ='1' ORDER BY SORT_NO ASC");
		$res=$result->result_array();
		$desc="";
		foreach($res as $abdomen){
			$check=$odb->query("SELECT * FROM pemisc WHERE caseno='$caseno'");
			$items=$check->result_array();
			foreach($items as $item){
				if($abdomen['HEART_ID']==$item['pHeartId']){
					$desc=$abdomen['HEART_DESC'];
				}
			}
		}
		return $desc;
	}
	public function getNeuro($caseno){
		$odb=$this->load->database('cf4',true);
		$epcb=$this->load->database('epcb',true);
		$result=$epcb->query("SELECT * FROM tsekap_lib_neuro WHERE LIB_STAT ='1' ORDER BY SORT_NO ASC");
		$res=$result->result_array();
		$desc="";
		foreach($res as $abdomen){
			$check=$odb->query("SELECT * FROM pemisc WHERE caseno='$caseno'");
			$items=$check->result_array();
			foreach($items as $item){
				if($abdomen['NEURO_ID']==$item['pNeuroId']){
					$desc=$abdomen['NEURO_DESC'];
				}
			}
		}
		return $desc;
	}
	public function getCourseWard($caseno){
		$odb=$this->load->database('cf4',true);
		$result=$odb->query("SELECT * FROM courseward WHERE caseno='$caseno' ORDER BY pDateAction ASC");
		return $result->result_array();
	}
	public function getLabFindings($caseno){
		$result=$this->db->query("SELECT * FROM labfindings WHERE caseno='$caseno'");
		return $result->result_array();
	}
	public function getPregHistory($caseno){
		$odb=$this->load->database('cf4',true);
		$result=$odb->query("SELECT ph.*,mh.* FROM preghist ph INNER JOIN menshist mh ON mh.caseno=ph.caseno WHERE ph.caseno='$caseno'");
		return $result->row_array();
	}
	public function getLabResult($caseno,$test){
		if($test=="XRAY"){
			$result=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND (productsubtype='$test' OR productsubtype='ECG' OR productsubtype='EEG' OR productsubtype='2D ECHO') AND quantity > 0");
		}else{
			$result=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype='$test' AND quantity > 0");
		}

		return $result->result_array();
	}
	public function getLabTestType($caseno,$refno){
		$result=$this->db->query("SELECT * FROM labtest WHERE caseno='$caseno' AND refno='$refno'");
		return $result->row_array();
	}
	public function getHematology($refno){
		$result=$this->db->query("SELECT * FROM hematology WHERE lab29='$refno'");
		return $result->row_array();
	}
	public function getVerifier($refno){
		$result=$this->db->query("SELECT * FROM verifier WHERE refno='$refno'");
		return $result->row_array();
	}
	public function checkVerified($refno){
		$result=$this->db->query("SELECT * FROM labpending WHERE refno='$refno'");
		return $result->row_array();
	}
	public function getAllCharges($caseno,$type){
		$result=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%$type%' AND quantity > 0");
		return $result->result_array();
	}
	public function getAllChargesMeds($caseno){
		$result=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%MEDICINE%' AND quantity > 0 GROUP BY productcode");
		return $result->result_array();
	}
	public function getAllDocuments($caseno,$type){
		$result=$this->db->query("SELECT * FROM abstract WHERE caseno='$caseno' AND `type` = '$type'");
		return $result->result_array();
	}
	public function getSingleDocument($id){
		$result=$this->db->query("SELECT * FROM abstract WHERE id='$id'");
		return $result->row_array();
	}
	public function create_certificate(){
		$caseno=$this->input->post('caseno');
		$patientidno=$this->input->post('patientidno');
		$type=$this->input->post('type');
		$purpose=$this->input->post('purpose');
		$remarks=$this->input->post('remarks');
		$chargeto=$this->input->post('chargeto');
		$username=$this->session->fullname;
		$profile=$this->Admission_model->fetch_single_admission($caseno);
		$patientname=$profile['firstname']." ".$profile['middlename']." ".$profile['lastname'];
		$date=date('M-d-Y');
		$datearray=date('Y-m-d');
		$time=date('H:i:s');
		$create=$this->db->query("INSERT INTO abstract(caseno,note,purpose,recommendation,user,`status`,`type`,is_employee) VALUES('$caseno','','$purpose','$remarks','$username','pending','$type','$chargeto')");
		if($create){
			// $qry=$this->db->query("SELECT * FROM abstract WHERE caseno='$caseno' ORDER BY id DESC LIMIT 1");
			// $res=$qry->row_array();
			// $refno=$this->General_model->generateRefNo('RN',$username);
			// $this->db->query("INSERT INTO `collection`(`refno`,`acctno`,`acctname`,`ofr`,`description`,`accttitle`,`amount`,`discount`,`date`,`Dept`,`username`,`shift`,`type`,`paymentTime`,`paidBy`,`datearray`,`branch`) VALUES('$refno','$patientidno','$patientname','','$type','CERTIFICATION FEE','50','0','$date','out','$username','$res[id]','pending','$time','','$datearray','KMSCI')");
			return true;
		}else{
			return false;
		}
	}
	public function fetch_single_certificate($id){
		$result=$this->db->query("SELECT * FROM abstract WHERE id='$id'");
		return $result->result_array();
	}
	public function update_certificate(){
		$caseno=$this->input->post('caseno');
		$id=$this->input->post('id');
		$purpose=$this->input->post('purpose');
		$remarks=$this->input->post('remarks');
		$chargeto=$this->input->post('chargeto');
		$username=$this->session->fullname;
		$create=$this->db->query("UPDATE abstract SET purpose='$purpose',recommendation='$remarks',`user`='$username',is_employee='$chargeto' WHERE id='$id'");
		if($create){
			return true;
		}else{
			return false;
		}
	}
	public function delete_certificate($id){
		$result=$this->db->query("DELETE FROM abstract WHERE id='$id'");
		if($result){
			$this->db->query("DELETE FROM `collection` WHERE shift='$id'");
			return true;
		}else{
			return false;
		}
	}
	public function issue_certificate($id){
		$datearray=date('Y-m-d');
		$result=$this->db->query("UPDATE abstract SET `status`='issued',date_issued='$datearray' WHERE id='$id'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function getAllMedicoLegal($caseno){
		$result=$this->db->query("SELECT * FROM medicolegal WHERE caseno='$caseno'");
		return $result->result_array();
	}
	public function issue_medicolegal($id){
		$datearray=date('Y-m-d');
		$result=$this->db->query("UPDATE medicolegal SET `status`='issued',date_issued='$datearray' WHERE id='$id'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function delete_medicolegal($id){
		$result=$this->db->query("DELETE FROM medicolegal WHERE id='$id'");
		if($result){
			$this->db->query("DELETE FROM `collection` WHERE shift='$id'");
			return true;
		}else{
			return false;
		}
	}
	public function create_medicolegal(){
		$caseno=$this->input->post('caseno');
		$patientidno=$this->input->post('patientidno');
		$noi=$this->input->post('noi');
		$poi=$this->input->post('poi');
		$toi=$this->input->post('toi');
		$doi=$this->input->post('doi');
		$advise=$this->input->post('advise');
		$recommend=$this->input->post('recommend');
		$chargeto=$this->input->post('chargeto');
		$username=$this->session->fullname;
		$profile=$this->Admission_model->fetch_single_admission($caseno);
		$patientname=$profile['firstname']." ".$profile['middlename']." ".$profile['lastname'];
		$date=date('M-d-Y');
		$datearray=date('Y-m-d');
		$time=date('H:i:s');
		$create=$this->db->query("INSERT INTO medicolegal(caseno,medcase,medplace,medtime,meddate,medadvised,medrecommend,`user`,`status`,is_employee) VALUES('$caseno','$noi','$poi','$toi','$doi','$advise','$recommend','$username','pending','$chargeto')");
		if($create){
			return true;
		}else{
			return false;
		}
	}
	public function update_medicolegal(){
		$caseno=$this->input->post('caseno');
		$id=$this->input->post('id');
		$noi=$this->input->post('noi');
		$poi=$this->input->post('poi');
		$toi=$this->input->post('toi');
		$doi=$this->input->post('doi');
		$advise=$this->input->post('advise');
		$recommend=$this->input->post('recommend');
		$chargeto=$this->input->post('chargeto');
		$username=$this->session->fullname;
		$create=$this->db->query("UPDATE medicolegal SET medcase='$noi',medplace='$poi',medtime='$toi',meddate='$doi',medadvised='$advise',medrecommend='$recommend',`user`='$username',is_employee='$chargeto' WHERE id='$id'");
		if($create){
			return true;
		}else{
			return false;
		}
	}
	public function fetch_single_medicolegal($id){
		$result=$this->db->query("SELECT * FROM medicolegal WHERE id='$id'");
		return $result->result_array();
	}
	public function getSingleMedicoLegal($id){
		$result=$this->db->query("SELECT * FROM medicolegal WHERE id='$id'");
		return $result->row_array();
	}
	public function getCF4CourseWard($caseno){
		$odb=$this->load->database('cf4',true);
		$result=$odb->query("SELECT count(no) as ciwcount,if(count(no)>0,'Yes','No') as status,ifnull(user,'') as user FROM courseward c left join courseward_logs l on c.no=l.trans_id where  c.caseno='$caseno'");
		return $result->result_array();
	}

	public function  reopen($caseno,$user){
		$this->db->query("UPDATE admission SET result='' WHERE caseno='$caseno'");
		$case=explode('-',$caseno);
		if($case[0]=="I"){
			$this->db->query("UPDATE admission SET ward='in', status='MGH' WHERE caseno='$caseno'");
			$this->db->query("DELETE FROM dischargedtable WHERE caseno='$caseno'");
			$this->db->query("DELETE FROM dischargedtablepaid WHERE caseno='$caseno'");
			$this->db->query("DELETE FROM transfers WHERE caseno='$caseno' AND status='outgoing'");
		}else{
			$this->db->query("UPDATE admission SET ward='out', status='Active' WHERE caseno='$caseno'");
			$this->db->query("DELETE FROM dischargedtable WHERE caseno='$caseno'");
			$this->db->query("DELETE FROM dischargedtablepaid WHERE caseno='$caseno'");
		}
		$date=date('Y-m-d');
		$this->db->query("DELETE FROM dischargedby WHERE caseno='$caseno'");
		$this->db->query("INSERT INTO activationmode VALUES('$caseno','$user','$date')");
		return true;
	}
	public function checkUser($password,$dept){
		$result=$this->db->query("SELECT * FROM nsauth WHERE `password`='$password' AND station='$dept' AND (empid='26' OR empid='10468' OR Access='5')");
		if($result->num_rows()>0){
			return $result->row_array();
		}else{
			return false;
		}
	}
	public function discharge_patient($case){
		$nursename = $this->session->fullname;
		$datedischarged = $this->input->post('datedischarged');
		$timedischarged = $this->input->post('timedischarged');

		$Query = $this->db->query("delete from statementproductoutslash where caseno='$case'");
		$Query = $this->db->query("delete from statementproductout where caseno='$case'");

		$sqlPatient = $this->db->query("SELECT a.*,pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno='$case'");
		if ($sqlPatient->num_rows() > 0) {
			$patient = $sqlPatient->row_array();
			$patientidno = $patient['patientidno'];
			$caseno = $patient['caseno'];
			$member = $patient['paymentmode'];
			$corp=$patient['corp'];
			$membership = $patient['membership'];
			$hmomembership = $patient['hmomembership'];
			$hmo = $patient['hmo'];
			$roomno = $patient['room'];
			$ward = $patient['ward'];;
			$street = $patient['street'];
			$barangay = $patient['barangay'];
			$municipality = $patient['municipality'];
			$province = $patient['province'];
			$initialdiagnosis = $patient['initialdiagnosis'];
			$ap = $patient['ap'];
			$dateadmitted = $patient['dateadmitted'];
			$dateadmit = $patient['dateadmit'];
			$branch = $patient['branch'];
			$age = $patient['age'];
			$lastname = $patient['lastname'];
			$firstname = $patient['firstname'];
			$middlename = $patient['middlename'];
			$senior = $patient['senior'];
			$patientname = $lastname . " " . $firstname . " " . $middlename;
			$disposition = $patient['disposition'];
			$patientadmit = $patient['patientadmit'];
			$statusAdmit = $patient['status'];
		}
		if ($statusAdmit == "MGH") {
			if($corp =="FINAL-PAID"){
			$date1 = new DateTime($dateadmit);
			$date2 = new DateTime($datedischarged);

			if ($member == "Member") {
				$NHIP = "1";
				$NONNHIP = "0";
				$member = "NHIP";
			} else {
				$NONNHIP = "1";
				$NHIP = "0";
				$member = "NONNHIP";
			}

			$Query = $this->db->query("delete from incensus where caseno='$case'");
			$Query = $this->db->query("select date from wholeyear  where  date  between  '$dateadmit'  and '$datedischarged'  and date not like '%$datedischarged%'  group by date");
			if ($Query->num_rows() > 0) {
				$d = $Query->row_array();
				$date100 = $d['date'];
			}else{
				$date100=$datedischarged;
			}

			$Query = $this->db->query("insert into incensus values('$case','$NHIP','$NONNHIP','$date100','$branch','$member','')");
			$Query = $this->db->query("delete from incensusdis where caseno='$case'");
			$Query = $this->db->query("insert into incensusdis values('$case','$NHIP','$NONNHIP','$date100','$branch','$member')");

			$Query = $this->db->query("select sum(hmo) totalhmo from productout where caseno = '$case' and trantype = 'charge' and trantype not like '%OFFSET%' and productcode not like '%N/A%' and producttype not like '%READERS FEE%' and producttype not like '%PAYMENT OF%'");
			if ($Query->num_rows() > 0) {
				$d = $Query->row_array();
				$totalhmo = $d['totalhmo'];
			}

			$Query = $this->db->query("select sum(phic) as total from productout where caseno = '$case'   and productcode not like '%N/A%' and productsubtype not like '%READERS FEE%' AND productsubtype not like '%CT CONTRAST%' and producttype not like '%PAYMENT OF%'");
			if ($Query->num_rows() > 0) {
				$d = $Query->row_array();
				$grosstotalphic = $d['total'];
			}

			$Query = $this->db->query("select sum(hmo) as totalhmo from productout where caseno = '$case' and trantype = 'charge'  and productsubtype not like '%PROFESSIONAL FEE%'");
			if ($Query->num_rows() > 0) {
				$d = $Query->row_array();
				$grosstotalhmo = $d['totalhmo'];
			}

			$Query = $this->db->query("select sum(hmo) as totalhmopf from productout where caseno = '$case' and trantype = 'charge'  and productsubtype  like '%PROFESSIONAL FEE%' and producttype not like '%PAYMENT OF%'");
			if ($Query->num_rows() > 0) {
				$d = $Query->row_array();
				$grosstotalhmopf = $d['totalhmopf'];
			}

			$Query = $this->db->query("select sum(hmo) as totalhmopf from productout where caseno = '$case' and trantype = 'charge' and productcode not like '%N/A%' and producttype not like '%PAYMENT OF%'");
			if ($Query->num_rows() > 0) {
				$d = $Query->row_array();
				$totalhmo1 = $d['totalhmopf'];
			}
			$totalcaserate=0;
			$Query = $this->db->query("select sum(hospitalshare) as hospitalshare,sum(pfshare) as pfshare,caseno from finalcaserate where caseno = '$case' and (level='primary'  or level='related procedure') group by caseno");
			if ($Query->num_rows() > 0) {
				$d = $Query->row_array();
				$hospitalshare = $d['hospitalshare'];
				$pfshare = $d['pfshare'];
				$caseno100 = $d['caseno'];
				$totalcaserate = $hospitalshare + $pfshare;
			}

			$date = date('M-d-Y', strtotime($datedischarged));
			$tim = date('H:i:s', strtotime($timedischarged));
			$QueryDischarged = $this->db->query("INSERT INTO dischargedtable values('$case','$patientname','$date','$tim','UNDONE','UNDONE','U','0','$grosstotalphic','$totalcaserate','U','UNDONE','$grosstotalhmo','0','0','1','0','UNDONE','$grosstotalhmopf','$ward','$datedischarged','1','$branch')");
			$Query = $this->db->query("INSERT INTO dischargedtablepaid values('$case','$patientname','$date','$tim','UNDONE','UNDONE','U','0','$grosstotalphic','$totalcaserate','U','UNDONE','$grosstotalhmo','0','0','1','0','UNDONE','$grosstotalhmopf','$ward','$datedischarged','1','$branch','')");

			$Query = $this->db->query("update productout set producttype='manual' where  caseno = '$case' and productsubtype='ROOM ACCOMODATION'");
			$Query = $this->db->query("update room set roomstat='vacant' where room = '$roomno' AND branch='$branch'");
			$Query = $this->db->query("update admission set ward ='discharged',status='discharged'  where  caseno = '$case'");
			$Query = $this->db->query("update admissionicd set datedischarged='$datedischarged',type='$membership' where caseno = '$case'");

			$Query = $this->db->query("delete from statementadmission where caseno='$case'");

			$Query = $this->db->query("select sum(sellingprice * quantity) as totalbill,sum(hmo) as totalhmo,sum(phic) as totalphic,sum(adjustment) as senior,sum(excess) as totalexcess from productout where caseno = '$case'         and (trantype ='charge'  or  trantype ='ISSUED'   OR  trantype ='extinguish' )   AND productcode not like '%N/A%' and trantype not like '%RETURN%' and trantype not like '%OFFSET%' and trantype not like '%REVENUE%' and producttype not like '%PAYMENT OF%' and producttype not like '%READERS FEE%'   and producttype not like '%CT CONTRAST%'");
			if ($Query->num_rows() > 0) {
				$d = $Query->row_array();
				$totalbill = $d['totalbill'];
				$totalhmo = $d['totalhmo'];
				$totalphic = $d['totalphic'];
				$senior = $d['senior'];
				$totalexcess = $d['totalexcess'];
				if ($tim >= "00:00:01" && $tim <= "13:00:00") {
					$shift = "1";
				}
				if ($tim >= "13:00:01" && $tim <= "21:00:00") {
					$shift = "2";
				}
				if ($tim >= "21:00:01" && $tim <= "23:59:59") {
					$shift = "3";
				}
			}
			$Query = $this->db->query("INSERT INTO dischargedby  values('$case','$nursename','$totalbill','$senior','$totalhmo','$totalphic','$totalexcess','$totalcaserate','$hmo','$lastname','$firstname','$roomno','$membership','$datedischarged','$tim','$branch','$shift','1')");
			if ($QueryDischarged && $Query) {


				$sqlPatient = $this->db->query("SELECT a.*,pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno='$case'");
				if ($sqlPatient->num_rows() > 0) {
					$patient = $sqlPatient->row_array();
					$patientidno = $patient['patientidno'];
					$caseno = $patient['caseno'];
					$member = $patient['paymentmode'];
					$membership = $patient['membership'];
					$hmomembership = $patient['hmomembership'];
					$hmo = $patient['hmo'];
					$roomno = $patient['room'];
					$ward = $patient['ward'];;
					$street = $patient['street'];
					$barangay = $patient['barangay'];
					$municipality = $patient['municipality'];
					$province = $patient['province'];
					$initialdiagnosis = $patient['initialdiagnosis'];
					$ap = $patient['ap'];
					$dateadmitted = $patient['dateadmitted'];
					$dateadmit = $patient['dateadmit'];
					$branch = $patient['branch'];
					$age = $patient['age'];
					$lastname = $patient['lastname'];
					$firstname = $patient['firstname'];
					$middlename = $patient['middlename'];
					$senior = $patient['senior'];
					$patientname = $lastname . " " . $firstname . " " . $middlename;
					$disposition = $patient['disposition'];
					$patientadmit = $patient['patientadmit'];
				}
				$reportingyear = date('Y');
				$odb = $this->load->database('emr', true);
				if ($ward == "discharged") {

					$Query = $odb->query("select hfhudcode from genInfoClassification");
					if ($Query->num_rows() > 0) {
						$d = $Query->row_array();
						$hfhudcode = $d['hfhudcode'];
					}

					$Query = $odb->query("select tscode,doctor  from specialtycaseno where caseno = '$case'");
					if ($Query->num_rows() > 0) {
						$d = $Query->row_array();
						$tscode1 = $d['tscode'];
						$doctor = $d['doctor'];
					}

					$Query = $this->db->query("select *  from docfile where code= '$doctor'");
					if ($Query->num_rows() > 0) {
						$d = $Query->row_array();
						$productcode = $d['code'];
					}

					$Query = $this->db->query("select producttype  from productout where caseno = '$case' and productcode='$productcode'");
					if ($Query->num_rows() > 0) {
						$d = $Query->row_array();
						$producttype = $d['producttype'];
					}
					$Query = $this->db->query("SELECT tod from docfile  where code='$doctor'");
					if ($Query->num_rows() > 0) {
						$d = $Query->row_array();
						$othertypeofservicespecify = $d['tod'];
					}

					$Query = $odb->query("select  tscode,tsdesc  from  rtservice  where tscode='$tscode1'");
					if ($Query->num_rows() > 0) {
						$d = $Query->row_array();
						$tscode = $d['tscode'];
						$tsdesc = $d['tsdesc'];
					}

					$days = $date2->diff($date1);
					$totallengthstay = $days->d;

					if ($membership == "Nonmed-none" && $hmomembership == "none") {
						$nppay = "1";
						$nphtotal = "1";

						$phpay = "0";
						$phtotal = "0";
						$hmo = "0";

					}

					if ($membership == "phic-med") {
						$nppay = "0";
						$nphtotal = "0";

						$phpay = "1";
						$phtotal = "1";
						$hmo = "0";

					}
					if (($membership == "Nonmed-none" && $hmomembership == "hmo-hmo") || ($membership == "Nonmed-none" && $hmomembership == "hmo-hmo")) {
						$nppay = "0";
						$nphtotal = "0";

						$phpay = "0";
						$phtotal = "0";
						$hmo = "1";

					}

					if ($disposition == "RECOVERED") {
						$recoveredimproved = "1";
						$transferred = "0";
						$hama = "0";
						$absconded = "0";
						$unimproved = "0";
						$totaldeaths = "0";
						$nopatients = "1";

						$totaldischarges = "1";

					}
					if ($disposition == "IMPROVED") {
						$recoveredimproved = "1";
						$transferred = "0";

						$hama = "0";
						$absconded = "0";
						$unimproved = "0";
						$totaldeaths = "0";
						$totaldischarges = "1";
						$nopatients = "1";
					}
					if ($disposition == "HAMA") {
						$recoveredimproved = "0";
						$transferred = "0";
						$hama = "1";
						$nopatients = "1";
						$absconded = "0";
						$unimproved = "0";
						$totaldeaths = "0";
						$totaldischarges = "1";
						$nopatients = "1";
					}
					if ($disposition == "ABSCONDED") {
						$recoveredimproved = "0";
						$transferred = "0";
						$hama = "0";
						$absconded = "1";
						$unimproved = "0";
						$totaldeaths = "0";
						$totaldischarges = "1";
						$nopatients = "1";
					}

					if ($disposition == "UNIMPROVED") {
						$recoveredimproved = "0";
						$transferred = "0";
						$hama = "0";
						$absconded = "0";
						$unimproved = "1";
						$totaldeaths = "0";
						$totaldischarges = "1";
						$nopatients = "1";
					}
					if ($disposition == "TRANSFERRED") {

						$transferred = "1";
						$nopatients = "1";
						$totaldischarges = "1";
						$recoveredimproved = "0";

						$hama = "0";
						$absconded = "0";
						$unimproved = "0";
						$totaldeaths = "0";

					}


					if ($disposition == "DIED") {
						$recoveredimproved = "0";
						$transferred = "0";
						$hama = "0";
						$absconded = "0";
						$unimproved = "0";
						$totaldeaths = "1";
						$totaldischarges = "1";
						$nopatients = "1";

						if ($totallengthstay < 2) {
							$deathsbelow48 = "1";
							$deathsover48 = "0";
						}



						if ($totallengthstay >= 2) {
							$deathsbelow48 = "0";
							$deathsover48 = "1";
						}


						$SQLstatement = $odb->query("select typeofdeath from typeofdeath where patientidno='$patientidno'");
						if ($SQLstatement->num_rows() > 0) {
							$death = $SQLstatement->row_array();
							$typeofdeath = $death['typeofdeath'];
						}

						if ($typeofdeath == "STILLBIRTHS") {

							$totaldeaths = "";
							$totalstillbirths = "1";
							$totalneonataldeaths = "0";
							$totalmaternaldeaths = "0";
							$totaldeathsnewborn = "0";
							$totalerdeaths = "0";
							$totaldeaths48down = "0";
							$totaldeaths48up = "0";
							$totalerdeaths = "0";

							$deathsbelow48 = "0";
							$deathsover48 = "0";

						}

						if ($typeofdeath == "NEONATAL") {
							$totaldeaths = "0";
							$totalstillbirths = "0";
							$totalneonataldeaths = "1";
							$totalmaternaldeaths = "0";
							$totaldeathsnewborn = "0";
							$totalerdeaths = "0";
							$deathsbelow48 = "0";
							$deathsover48 = "0";
							$totalerdeaths = "0";
						}
						if ($typeofdeath == "MATERNAL") {
							$totaldeaths = "0";
							$totalstillbirths = "0";
							$totalneonataldeaths = "0";
							$totalmaternaldeaths = "1";
							$totaldeathsnewborn = "0";
							$totalerdeaths = "0";
							$deathsbelow48 = "0";
							$deathsover48 = "0";
							$totalerdeaths = "0";

						}

						$SQL = "insert into patienthospitalOperationsDeaths values('$hfhudcode','$totaldeaths','$deathsbelow48','$deathsover48','$totalerdeaths','$totaldoa','$totalstillbirths','$totalneonataldeaths','$totalmaternaldeaths','$totaldeathsnewborn','$totaldischargedeaths','$grossdeathrate','$ndrnumerator','$ndrdenominator','$netdeathrate','$reportingyear','','$datedischarged','$case','$branch')";
						$InsertRecord = $odb->query($SQL);

						$SQL = "insert into patientstat values('$patientidno','$case','EXPIRED','pending')";
						$InsertRecord = $odb->query($SQL);
					}
					if ($producttype == "IPD Procedure done at OR") {
						if ($proc <= 18) {
							$tscode = "5";
						}
						if ($proc >= 19) {
							$tscode = "6";
						}
					}
					$nphservicecharity="";
					$phservice="";
					$owwa="";
					$deathsbelow48="";
					$deathsover48="";
					$remarks="";
					$status1="";
					$SQL = "INSERT INTO  patienthospOptDischargesSpecialty values('$hfhudcode','$tscode','$nopatients','$totallengthstay','$nppay','$nphservicecharity','$nphtotal','$phpay','$phservice','$phtotal','$hmo','$owwa','$recoveredimproved','$transferred','$hama','$absconded','$unimproved','$deathsbelow48','$deathsover48','$totaldeaths','$totaldischarges','$remarks','$reportingyear','','$datedischarged','$tsdesc','PENDING','$case','$branch')";
					$InsertRecords = $odb->query($SQL);
					if ($tscode == "7") {
						$SQLstatement = $odb->query("delete from patienthospOptDischargesSpecialty   where   caseno = '$case'");
						$SQL = "INSERT INTO  patienthospOptDischargesSpecialty values('$hfhudcode','$tscode','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','$totaldischarges','$remarks','$reportingyear','','$datedischarged','$tsdesc','PENDING','$case','$branch')";
						$InsertRecords = $odb->query($SQL);
						$SQL = "INSERT INTO  patienthospOptDischargesSpecialtyOthers values('$hfhudcode','$othertypeofservicespecify','$nopatients','$totallengthstay','$nppay','$nphservicecharity','$nphtotal','$phpay','$phservice','$phtotal','$hmo','$owwa','$recoveredimproved','$transferred','$hama','$absconded','$unimproved','$deathsbelow48','$deathsover48','$totaldeaths','$totaldischarges','$remarks','$reportingyear','','$datedischarged','$tsdesc','PENDING','$case','$branch')";
						$InsertRecords = $odb->query($SQL);
					}
					if ($patientadmit == "NEWBORN" || $patientadmit == "NEW BORN") {

						$SQLstatement = $odb->query("select code from newborn where caseno='$case'");
						if ($SQLstatement->num_rows() > 0) {
							$c = $SQLstatement->row_array();
							$code2 = $c['code'];
						}
						$SQLstatement = $odb->query("delete from patienthospOptDischargesSpecialty   where   caseno = '$case'");
						$SQLstatement = $odb->query("delete from patienthospOptDischargesSpecialtyOthers   where   caseno = '$case'");
						$SQL = "INSERT INTO  patienthospOptDischargesSpecialty values('$hfhudcode','$code2','$nopatients','$totallengthstay','$nppay','$nphservicecharity','$nphtotal','$phpay','$phservice','$phtotal','$hmo','$owwa','$recoveredimproved','$transferred','$hama','$absconded','$unimproved','$deathsbelow48','$deathsover48','$totaldeaths','$totaldischarges','$remarks','$reportingyear','','$datedischarged','$tsdesc','PENDING','$case','$branch')";
						$InsertRecords = $odb->query($SQL);

						$SQLstatement = $odb->query("select typeofbirth from typeofbirth where caseno='$caseno'");
						if ($SQLstatement->num_rows() > 0) {
							$birth = $SQLstatement->num_rows();
							$typeofbirth = $birth['typeofbirth'];
						}
						if ($typeofbirth == "NORMAL") {
							$totallbvdelivery = "1";
							$totallbcdelivery = "0";
							$totalotherdelivery = "0";
						}
						if ($typeofbirth == "CAESARIAN") {
							$totallbvdelivery = "0";
							$totallbcdelivery = "1";
							$totalotherdelivery = "0";
						}
						if ($typeofbirth == "OTHERS") {
							$totallbvdelivery = "0";
							$totallbcdelivery = "0";
							$totalotherdelivery = "1";
						}

						$SQL = "insert into patienthospOptDischargesNumberDeliveries values('$hfhudcode','1','$totallbvdelivery','$totallbcdelivery','$totalotherdelivery','$reportingyear','','$datedischarged','$case','$branch')";
						$InsertRecord = $odb->query($SQL);

					}

					if ($ward == "discharged") {
						$admitdischarged = "0";
						$discharge = "1";
						$death = "0";
						$transferin = "0";
						$transferout = "0";
						$totalinpatients = "1";
					}
					if ($dateadmit == $datedischarged) {
						$admitdischarged = "1";
						$discharge = "0";
						$death = "0";
						$transferin = "0";
						$transferout = "0";
						$admission = "";
					}

					if ($disposition == "DIED") {
						$admitdischarged = "0";
						$discharge = "0";
						$death = "1";
						$transferin = "0";
						$transferout = "0";
					}

					$SQLstatement = $this->db->query("select status from transfers where caseno='$case'");
					if ($SQLstatement->num_rows() > 0) {
						$st1 = $SQLstatement->num_rows();
						$status1 = $st1['status'];
					}

					if ($status1 == "ingoing") {
						$admitdischarged = "0";
						$discharge = "1";
						$death = "0";
						$transferin = "0";
						$transferout = "0";
						$totalnewborn = "0";
					}
					if ($status1 == "outgoing") {
						$admitdischged = "0";
						$discharge = "0";
						$death = "0";
						$transferin = "0";
						$transferout = "1";
						$totalnewborn = "0";
					}
					if ($patientadmit == "NEWBORN" || $patientadmit == "NEW BORN") {
						$admitdischged = "0";
						$discharge = "1";
						$death = "0";
						$transferin = "0";
						$transferout = "0";
						$totalnewborn = "0";
					}
					$remaining=0;
					$admission="";
					$total=0;
					$total1=0;
					$midnight="";

					$SQL = "INSERT INTO  beddays values('$datedischarged','$reportingyear','$remaining','$admission','','$total','$discharge','$death','$transferout','$total1','$midnight','$admitdischarged','$case','$branch','','$disposition')";
					$InsertRecords = $odb->query($SQL);

					if ($ward == "discharged") {
						$admitdischarged = "0";
						$discharge = "1";
						$death = "0";
						$transferin = "0";
						$transferout = "0";
						$totalinpatients = "1";
					}
					if ($dateadmit == $datedischarged) {
						$admitdischarged = "1";
						$discharge = "1";
						$death = "0";
						$transferin = "0";
						$transferout = "0";
						$totalinpatients = "1";
					}

					if ($disposition == "DIED") {
						$admitdischarged = "0";
						$discharge = "0";
						$death = "1";
						$transferin = "0";
						$transferout = "0";
					}
					$SQLstatement = $this->db->query("select status from transfers where caseno='$case'");
					if ($SQLstatement->num_rows() > 0) {
						$st2 = $SQLstatement->num_rows();
						$status2 = $st2['status'];
					}


					if ($status2 == "ingoing") {
						$admitdischarged = "0";
						$discharge = "1";
						$death = "0";
						$transferin = "1";
						$transferout = "0";
						$totalnewborn = "0";
						$totalinpatients = "1";
					}

					if ($status2 == "outgoing") {
						$admitdischged = "0";
						$discharge = "1";
						$death = "0";
						$transferin = "0";
						$transferout = "1";
						$totalnewborn = "0";
						$totalinpatients = "1";
					}


					if ($patientadmit == "NEWBORN") {

						$admitdischarged = "0";
						$discharge = "0";
						$death = "0";
						$transferin = "0";
						$transferout = "0";
						$totalinpatients = "0";
						$totalnewborn = "1";


					}
					$SQL = "insert into patienthospOptSummaryOfPatients values('$hfhudcode','$totalinpatients','$totalnewborn','$discharge','$admitdischarged','','$transferin','$transferout','','$reportingyear','','$datedischarged','$case','$branch','$patientname','')";
					$InsertRecord = $odb->query($SQL);

				}

				if (($disposition == "DIED") && ($patientadmit == "NEWBORN" || $patientadmit == "NEW BORN")) {
					$SQLstatement = $odb->query("delete from patienthospOptDischargesSpecialty   where   caseno = '$case'");
					$SQLstatement = $odb->query("delete from patienthospOptDischargesSpecialtyothers   where   caseno = '$case'");
					$SQLstatement = $odb->query("delete from patienthospOptSummaryOfPatients   where   caseno = '$case'");
					$SQLstatement = $odb->query("delete from beddays   where   caseno = '$case'");
				}
			}
			return true;
		}
		}
	}
	public function checkHRN($patientidno){
		$result=$this->db->query("SELECT * FROM hrn WHERE patientidno='$patientidno'");
		return $result->row_array();
	}
	public function save_hrn($patientidno){
		$hrn=$this->General_model->generatePatientID('104',$this->session->fullname);
		$generate=$this->db->query("INSERT INTO hrn(hrn,patientidno) VALUES('$hrn','$patientidno')");
		if($generate){
			return true;
		}else{
			return false;
		}
	}
	public function getAllTopDiseases(){
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$query=$this->db->query("SELECT phd.icd10desc,phd.icd10code,count(phd.icd10code) as topnumber FROM `patienthospOptDischargesMorbidity` phd WHERE phd.datearray BETWEEN '$startdate' AND '$enddate' AND phd.icd10code NOT LIKE '%Z%' AND phd.icd10code NOT LIKE '%E86%' AND phd.icd10code NOT LIKE '%S%' AND phd.icd10category <> 'primary' AND phd.icd10category <> 'secondary' AND phd.icd10category <> '' GROUP BY phd.icd10code ORDER BY count(phd.icd10code) DESC LIMIT 10");
		return $query->result_array();
	}
	public function checkTopDisease($icdcode,$startdate,$enddate){
		$query=$this->db->query("SELECT * FROM `patienthospOptDischargesMorbidity` WHERE datearray BETWEEN '$startdate' AND '$enddate' AND icd10code='$icdcode'");
		return $query->result_array();
	}
	public function getAllICD10Code(){
		$odb = $this->load->database('emr', true);
		$result=$odb->query("SELECT * FROM ricd10 ORDER BY icd10code ASC");
		return $result->result_array();
	}
	public function tag_emr(){
		$patientidno=$this->input->post('patientidno');
		$caseno=$this->input->post('caseno');
		$icdcode=explode('_',$this->input->post('icd10code'));
		$icd10code=$icdcode[1];
		$code=$this->input->post('icdcode');
		$sqlCheck=$this->db->query("UPDATE finalcaserate SET `emrgroup`='$icd10code' WHERE autono='$code'");
		if($sqlCheck){
			return true;
		}else{
			return false;
		}
	}
	public function remove_emr($code,$caseno){
		$result=$this->db->query("DELETE FROM `patienthospOptDischargesMorbidity` WHERE `patientidno`='$caseno' AND `icd10category`='$code'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function logout_case($patientidno,$caseno){
			  $patient=$this->db->query("SELECT * FROM patientprofile WHERE patientidno='$patientidno'");
              $pat=$patient->row_array();
              $birthdate=$pat['dateofbirth'];
              $gender=$pat['sex'];
              $patientname=$pat['patientname'];
              $discharged=$this->db->query("SELECT datearray FROM dischargedtable WHERE caseno='$caseno'");
              $dis=$discharged->row_array();
              $datedischarged=$dis['datearray'];
              $datearray=date('Y-m-d');
              $bday = new DateTime($birthdate); // Your date of birth
              $today = new Datetime($datedischarged);
              $diff = $today->diff($bday);
              $age=$diff->y;
              $munder1=0;$funder1=0;$m1to4=0;$f1to4=0;$m5to9=0;$f5to9=0;$m10to14=0;$f10to14=0;$m15to19=0;$f15to19=0;$m20to24=0;$f20to24=0;$m25to29=0;$f25to29=0;
              $m30to34=0;$f30to34=0;$m35to39=0;$f35to39=0;$m40to44=0;$f40to44=0;$m45to49=0;$f45to49=0;$m50to54=0;$f50to54=0;$m55to59=0;$f55to59=0;$m60to64=0;$f60to64=0;
              $m65to69=0;$f65to69=0;$m70over=0;$f70over=0;
              if($gender=="M" || $gender=="m"){
                if($age < 1){
                  $munder1=1;
                }
                if($age >= 1 && $age < 5){
                  $m1to4=1;
                }
                if($age >= 5 && $age < 10){
                  $m5to9=1;
                }
                if($age >= 10 && $age < 15){
                  $m10to14=1;
                }
                if($age >= 15 && $age < 20){
                  $m15to19=1;
                }
                if($age >= 20 && $age < 25){
                  $m20to24=1;
                }
                if($age >= 25 && $age < 30){
                  $m25to29=1;
                }
                if($age >= 30 && $age < 35){
                  $m30to34=1;
                }
                if($age >= 35 && $age < 40){
                  $m35to39=1;
                }
                if($age >= 40 && $age < 45){
                  $m40to44=1;
                }
                if($age >= 45 && $age < 50){
                  $m45to49=1;
                }
                if($age >= 50 && $age < 55){
                  $m50to54=1;
                }
                if($age >= 55 && $age < 60){
                  $m55to59=1;
                }
                if($age >= 60 && $age < 65){
                  $m60to64=1;
                }
                if($age >= 65 && $age < 70){
                  $m65to69=1;
                }
                if($age >= 70){
                  $m70over=1;
                }
              }else{
                if($age < 1){
                  $funder1=1;
                }
                if($age >= 1 && $age < 5){
                  $f1to4=1;
                }
                if($age >= 5 && $age < 10){
                  $f5to9=1;
                }
                if($age >= 10 && $age < 15){
                  $f10to14=1;
                }
                if($age >= 15 && $age < 20){
                  $f15to19=1;
                }
                if($age >= 20 && $age < 25){
                  $f20to24=1;
                }
                if($age >= 25 && $age < 30){
                  $f25to29=1;
                }
                if($age >= 30 && $age < 35){
                  $f30to34=1;
                }
                if($age >= 35 && $age < 40){
                  $f35to39=1;
                }
                if($age >= 40 && $age < 45){
                  $f40to44=1;
                }
                if($age >= 45 && $age < 50){
                  $f45to49=1;
                }
                if($age >= 50 && $age < 55){
                  $f50to54=1;
                }
                if($age >= 55 && $age < 60){
                  $f55to59=1;
                }
                if($age >= 60 && $age < 65){
                  $f60to64=1;
                }
                if($age >= 65 && $age < 70){
                  $f65to69=1;
                }
                if($age >= 70){
                  $f70over=1;
                }
              }
            $sqlCase=$this->db->query("SELECT * FROM finalcaserate WHERE caseno='$caseno' AND `emrgroup` <> ''");
            if($sqlCase->num_rows() > 0){
            	$items=$sqlCase->result_array();
              foreach($items as $item){
                $code=$item['icdcode'];
                $description=$item['description'];
                $icd10code=$item['emrgroup'];
                $level=$item['level'];

                $checkExist=$this->db->query("SELECT * FROM patienthospOptDischargesMorbidity WHERE patientidno='$caseno' AND icd10code='$icd10code'");
              if($checkExist->num_rows() > 0){
                $result=$this->db->query("UPDATE patienthospOptDischargesMorbidity SET `icd10desc`='$description', `munder1`='$munder1', `funder1`='$funder1', `m1to4`='$m1to4', `f1to4`='$f1to4', `m5to9`='$m5to9', `f5to9`='$f5to9', `m10to14`='$m10to14', `f10to14`='$f10to14', `m15to19`='$m15to19', `f15to19`='$f15to19', `m20to24`='$m20to24', `f20to24`='$f20to24', `m25to29`='$m25to29', `f25to29`='$f25to29', `m30to34`='$m30to34', `f30to34`='$f30to34', `m35to39`='$m35to39', `f35to39`='$f35to39', `m40to44`='$m40to44', `f40to44`='$f40to44', `m45to49`='$m45to49', `f45to49`='$f45to49', `m50to54`='$m50to54', `f50to54`='$f50to54', `m55to59`='$m55to59', `f55to59`='$f55to59', `m60to64`='$m60to64', `f60to64`='$f60to64', `m65to69`='$m65to69', `f65to69`='$f65to69', `m70over`='$m70over', `f70over`='$f70over', `msubtotal`='0', `fsubtotal`='0', `grandtotal`='0',`datearray`='$datearray',`icd10code`='$icd10code',`type`='$level' WHERE patientidno='$caseno' AND icd10category='$code'");
              }else{
                $result=$this->db->query("INSERT INTO patienthospOptDischargesMorbidity(`icd10desc`, `munder1`, `funder1`, `m1to4`, `f1to4`, `m5to9`, `f5to9`, `m10to14`, `f10to14`, `m15to19`, `f15to19`, `m20to24`, `f20to24`, `m25to29`, `f25to29`, `m30to34`, `f30to34`, `m35to39`, `f35to39`, `m40to44`, `f40to44`, `m45to49`, `f45to49`, `m50to54`, `f50to54`, `m55to59`, `f55to59`, `m60to64`, `f60to64`, `m65to69`, `f65to69`, `m70over`, `f70over`, `msubtotal`, `fsubtotal`, `grandtotal`, `icd10code`, `icd10category`, `datearray`, `patientidno`, `branch`, `type`, `status`) VALUES('$description','$munder1','$funder1','$m1to4','$f1to4','$m5to9','$f5to9','$m10to14','$f10to14','$m15to19','$f15to19','$m20to24','$f20to24','$m25to29','$f25to29','$m30to34','$f30to34','$m35to39','$f35to39','$m40to44','$f40to44','$m45to49','$f45to49','$m50to54','$f50to54','$m55to59','$f55to59','$m60to64','$f60to64','$m65to69','$f65to69','$m70over','$f70over',0,0,0,'$icd10code','$code','$datearray','$caseno','$branch','$level','PENDING')");
              }
              }
            }
            if($result){
            	return true;
            }else{
            	return false;
            }
	}
	public function getAllDocumentsByDate($rundate){
		$result=$this->db->query("SELECT ab.is_employee,ab.type,ab.user,r.sellingprice as unitcost,pp.lastname,pp.firstname,pp.middlename,pp.suffix FROM abstract ab INNER JOIN admission a ON a.caseno=ab.caseno INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno LEFT JOIN receiving r ON r.description=ab.type WHERE ab.date_issued='$rundate' AND ab.`status`='issued' ORDER BY pp.lastname ASC");
		return $result->result_array();
	}

	public function getAllMedicoLegalByDate($rundate){
		$result=$this->db->query("SELECT ab.is_employee,ab.user,r.sellingprice as unitcost,pp.lastname,pp.firstname,pp.middlename,pp.suffix FROM medicolegal ab INNER JOIN admission a ON a.caseno=ab.caseno INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno LEFT JOIN receiving r ON r.description='MEDICO LEGAL' WHERE ab.date_issued='$rundate' AND ab.`status`='issued' ORDER BY pp.lastname ASC");
		return $result->result_array();
	}
	public function forward_certificate($rundate){
		$totalamount=0;
		$document=$this->db->query("SELECT r.sellingprice as unitcost FROM abstract ab INNER JOIN receiving r ON r.description=ab.type WHERE ab.date_issued='$rundate' AND ab.`status`='issued' AND ab.is_employee = ''");
		$medicolegal=$this->db->query("SELECT r.sellingprice as unitcost FROM medicolegal ab INNER JOIN receiving r ON r.description='MEDICO LEGAL' WHERE ab.date_issued='$rundate' AND ab.`status`='issued' AND ab.is_employee = ''");
		$others=$this->db->query("SELECT amount as unitcost FROM second_copy WHERE date_issued='$rundate'");
		foreach($document->result_array() as $item){
			$totalamount +=$item['unitcost'];
		}
		foreach($medicolegal->result_array() as $item){
			$totalamount +=$item['unitcost'];
		}
		foreach($others->result_array() as $item){
			$totalamount +=$item['unitcost'];
		}

		if($totalamount > 0){
			$refno=$this->General_model->generateRefNo('MRD',$this->session->fullname);
			$acctno="WPOS-001";
			$acct="RECORDS";
			$description="INCOME FROM RECORDS";
			$fullname=$this->session->fullname;
			$date=date('M-d-Y',strtotime($rundate));
			$check=$this->db->query("SELECT * FROM collection WHERE datearray='$rundate' AND acctno='WPOS-001' AND refno LIKE '%MRD%'");
			if($check->num_rows()>0){

			}else{
				$save=$this->db->query("INSERT INTO `collection`(`refno`,`acctno`,`acctname`,`ofr`,`description`,`accttitle`,`amount`,`discount`,`date`,`Dept`,`username`,`shift`,`type`,`paymentTime`,`paidBy`,`datearray`,`branch`) VALUES('$refno','$acctno','$acct','','$description','CERTIFICATION FEE','$totalamount','0','$date','out','$fullname','','pending','','','$rundate','KMSCI')");
				if($save){
					$this->db->query("UPDATE abstract SET refno='$refno' WHERE `status`='issued' AND date_issued='$rundate' AND is_employee = ''");
					$this->db->query("UPDATE medicolegal SET refno='$refno' WHERE `status`='issued' AND date_issued='$rundate' AND is_employee = ''");
					$this->db->query("UPDATE second_copy SET refno='$refno' WHERE date_issued='$rundate'");
					echo "<script>alert('Income from Records successfully forwarded to Cashier!');</script>";
				}
			}
		}else{
			echo "<script>alert('Unable to process transaction!');</script>";
		}
	}
	public function cancel_forward_certificate($rundate){
		$data=$this->db->query("SELECT * FROM collection WHERE datearray='$rundate' AND acctno='WPOS-001' AND refno LIKE '%MRD%'");
		if($data->num_rows()>0){
			$dt=$data->row_array();
			$refno=$dt['refno'];
			$cancel=$this->db->query("DELETE FROM collection WHERE refno='$refno'");
			if($cancel){
				$this->db->query("UPDATE abstract SET refno='' WHERE refno='$refno'");
				$this->db->query("UPDATE medicolegal SET refno='' WHERE refno='$refno'");
				$this->db->query("UPDATE second_copy SET refno='' WHERE refno='$refno'");
				echo "<script>alert('Income from Records successfully cancelled from collection!');</script>";
			}else{
				echo "<script>alert('Unable to cancel transaction!');</script>";
			}
		}else{

		}
	}

	public function issue_second_copy($caseno,$test,$amount){
		$datenow=date('Y-m-d');
		$user=$this->session->fullname;
		$result=$this->db->query("INSERT INTO second_copy(caseno,description,type,amount,date_issued,user,refno) VALUES('$caseno','$test','2ND COPY','$amount','$datenow','$user','')");
		if($result){
			return true;
		}else{
			return false;
		}
	}

	public function photocopy($caseno,$test,$amount){
		$datenow=date('Y-m-d');
		$user=$this->session->fullname;
		$result=$this->db->query("INSERT INTO second_copy(caseno,description,type,amount,date_issued,user,refno) VALUES('$caseno','$test','$test','$amount','$datenow','$user','')");
		if($result){
			return true;
		}else{
			return false;
		}
	}

	public function getAllOtherDocumentsByDate($rundate){
		$result=$this->db->query("SELECT ab.description,ab.type,ab.user,ab.amount as unitcost,pp.lastname,pp.firstname,pp.middlename,pp.suffix,ab.refno FROM second_copy ab INNER JOIN admission a ON a.caseno=ab.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno LEFT JOIN patientprofilewalkin ppw ON ppw.patientidno=a.patientidno WHERE ab.date_issued='$rundate' ORDER BY pp.lastname ASC");
		return $result->result_array();
	}

	public function getChart($caseno){
		$odb = $this->load->database('chart', true);
		$result=$odb->query("SELECT * FROM uploadchart WHERE caseno='$caseno'");
		return $result->row_array();
	}
	public function uploadChart(){
		$odb = $this->load->database('chart', true);
		$caseno=$this->input->post('caseno');
		$patientidno=$this->input->post('patientidno');
		$file_name=$_FILES['file']['name'];
		$file_tmp=$_FILES['file']['tmp_name'];
		$upload_by=$this->session->fullname;
		$datearray=date('Y-m-d');
		$timearray=date('H:i:s');
		$pdf_blob=addslashes(file_get_contents($file_tmp));
			$check=$odb->query("SELECT * FROM uploadchart WHERE caseno='$caseno' AND patientidno='$patientidno'");
			if($check->num_rows()>0){
				$insert=$odb->query("UPDATE uploadchart SET document='$pdf_blob',uploaded_by='$upload_by',datearray='$datearray',timearray='$timearray' WHERE caseno='$caseno' AND patientidno='$patientidno'");
			}else{
				$insert=$odb->query("INSERT INTO uploadchart(`caseno`,`patientidno`,`document`,`uploaded_by`,`datearray`,`timearray`) VALUES('$caseno','$patientidno','$pdf_blob','$upload_by','$datearray','$timearray')");
			}
			if($insert){
				return true;
			}else{
				return false;
			}
	}
	public function deleteChart($id){
		$odb = $this->load->database('chart', true);
		$result=$odb->query("DELETE FROM uploadchart WHERE id='$id'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function downloadChart($id){
		$odb = $this->load->database('chart', true);
		$result=$odb->query("SELECT * FROM uploadchart WHERE caseno='$id'");
		return $result->row_array();
	}
	public function add_icd(){
		$code=$this->input->post('code');
		$description=$this->input->post('description');
		$sqlCheck=$this->db->query("SELECT * FROM caserates WHERE icdcode='$code'");
		if($sqlCheck->num_rows()>0){
		  return false;
		}else{
		  $sqlUpdate=$this->db->query("INSERT INTO caserates(`icdcode`, `description`, `actualcaserate`, `hospital`, `pf`, `actualcaserate2`, `hospital2`, `pf2`, `actualcaserate3`, `hospital3`, `pf3`, `groupid`, `groupdiag`, `category`, `rvscode`, `annex`, `rproc`, `range`) VALUES('$code','$description','0','0','0','0','0','0','0','0','0','CR0002','$description','medical','$code','','','')");
		  if($sqlUpdate){
		    return true;
		  }else{
		    return false;
		  }
		}
	}
	public function update_final_diag(){
		$caseno=$this->input->post('caseno');
		$patientidno=$this->input->post('patientidno');
		$finaldx=$this->input->post('finaldx');
		$result=$this->db->query("UPDATE admission SET finaldiagnosis='$finaldx' WHERE caseno='$caseno' AND patientidno='$patientidno'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
}
