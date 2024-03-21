<?php
	date_default_timezone_set('Asia/Manila');
	class General_model extends CI_model
	{
		public function __construct()
		{
			$this->load->database();
		}
		public function authenticate(){
			$username=$this->input->post('username');
			$password=$this->input->post('password');
			$dept=$this->input->post('dept');
			// $this->db->where('username',$username);
			// $this->db->where('password',$password);
			// $this->db->where('station',$dept);
			$result=$this->db->query("SELECT * FROM nsauth WHERE username='$username' AND `password`='$password' AND station='$dept' GROUP BY username,empid");
			if($result->num_rows()>0){
				return $result->row_array();
			}else{
				return false;
			}
		}
		public function login($username,$password,$dept){
			$result=$this->db->query("SELECT * FROM nsauth WHERE username='$username' AND `password`='$password' AND station='$dept' GROUP BY username,empid");
			// $this->db->where('username',$username);
			// $this->db->where('password',$password);
			// $this->db->where('station',$dept);
			// $result=$this->db->get('nsauth');
			if($result->num_rows()>0){
				$user=$result->row_array();
				$user_data = array(
					'username' => $user['username'],
					'dept' => $user['station'],
					'fullname' => $user['name'],
					'user_login' => true
				);
				$this->session->set_userdata($user_data);

				return $result->result_array();
			}else{
				return false;
			}
		}
		public function getInfo(){
			$result=$this->db->query("SELECT * FROM heading");
			return $result->row_array();
		}
		public function getAllPatient(){
			$result=$this->db->query("SELECT * FROM patientprofile ORDER BY lastname ASC LIMIT 10");
			return $result->result_array();
		}
		public function getAllRDUPatient(){
			$result=$this->db->query("SELECT pp.*,a.caseno,a.status,a.dateadmitted FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE (a.caseno LIKE 'R-%' OR a.caseno LIKE '%WD-%') GROUP BY a.patientidno ORDER BY pp.lastname ASC LIMIT 10");
			return $result->result_array();
		}
		public function getAllInpatient(){
			$result=$this->db->query("SELECT * FROM admission WHERE ward='in' AND caseno LIKE '%I-%' GROUP BY patientidno");
			return $result->result_array();
		}
		public function getAllInpatientByDate($date){
			$result=$this->db->query("SELECT caseno FROM admission WHERE ward='in' AND caseno LIKE '%I-%' AND dateadmit='$date' GROUP BY patientidno");
			return $result->result_array();
		}
		public function getAllInpatientByStatus($status){
			$result=$this->db->query("SELECT caseno FROM admission WHERE ward='in' AND caseno LIKE '%I-%' AND `status`='$status' GROUP BY patientidno");
			return $result->result_array();
		}
		public function getAllRooms(){
			$result=$this->db->query("SELECT * FROM room ORDER BY room ASC");
			return $result->result_array();
		}
		public function getAllRoomByStation($station){
			$result=$this->db->query("SELECT * FROM room WHERE nursestation='$station' ORDER BY room ASC");
			return $result->result_array();
		}
		public function getAllRoomsByStatus($status){
			$result=$this->db->query("SELECT room FROM room WHERE roomstat='$status' GROUP BY room ORDER BY room ASC");
			return $result->result_array();
		}
		public function fetch_single_room($id){
			$result=$this->db->query("SELECT * FROM room WHERE autono='$id'");
			return $result->result_array();
		}
		public function fetch_single_doctor($id){
			$result=$this->db->query("SELECT * FROM docfile WHERE code='$id'");
			return $result->result_array();
		}
		public function fetch_single_doctor_by_code($id){
			$result=$this->db->query("SELECT * FROM docfile WHERE code='$id'");
			return $result->row_array();
		}
		public function getNationality(){
			$result=$this->db->query("SELECT * FROM nationality GROUP BY `description` ORDER BY id ASC");
			return $result->result_array();
		}
		public function getReligion(){
			$result=$this->db->query("SELECT * FROM religion GROUP BY `description` ORDER BY `description` ASC");
			return $result->result_array();
		}
		public function getStation(){
			$result=$this->db->query("SELECT * FROM station ORDER BY station ASC");
			return $result->result_array();
		}
		public function getState(){
			$state=$this->db->query("SELECT `id`,statename FROM `state` ORDER BY `id` ASC");
			return $state->result_array();
		}
		public function getCity($id){
			$state=$this->db->query("SELECT `id`,city FROM city where stateid='$id' ORDER by city ASC");
			return $state->result_array();
		}
		public function getBarangay($id){
			$state=$this->db->query("SELECT `id`,barangay FROM barangay WHERE cityid='$id' ORDER BY barangay ASC");
			return $state->result_array();
		}
		public function getZipCode($cityId){
			$state=$this->db->query("SELECT ZIP_CODE FROM zipcode WHERE MUN_ID='$cityId' LIMIT 1");
			return $state->result_array();
		}
		public function getCompany(){
		if($this->session->dept=="HMO"){
			$state=$this->db->query("SELECT * FROM company WHERE (`type` = 'company' OR `type` = 'hmo') GROUP BY companyname ORDER BY companyname ASC");
		}else{
			$state=$this->db->query("SELECT * FROM company WHERE acctno <> '' GROUP BY companyname ORDER BY companyname ASC");
		}
			return $state->result_array();
		}
		public function getResidentDuty(){
			$doctor=$this->db->query("SELECT d.name,d.code,d.specialization FROM docfile d INNER JOIN rod r ON r.rod=d.code ORDER BY id DESC");
			return $doctor->row_array();
		}
		public function getAttendingDoctor(){
			$doctor=$this->db->query("SELECT * FROM docfile WHERE specialization NOT LIKE '%ROD%' ORDER BY lastname ASC");
			return $doctor->result_array();
		}
		public function getAdmittingDoctor(){
			$doctor=$this->db->query("SELECT * FROM docfile WHERE (specialization LIKE '%ROD%' OR specialization LIKE '%PEDIA%') OR `code`='100124' ORDER BY lastname ASC");
			return $doctor->result_array();
		}
		public function getAllDoctor(){
			$doctor=$this->db->query("SELECT * FROM docfile ORDER BY lastname ASC");
			return $doctor->result_array();
		}

		public function checkUser($password,$dept){
			$result=$this->db->query("SELECT * FROM nsauth WHERE `password`='$password' AND station='$dept'");
			if($result->num_rows()>0){
				return $result->row_array();
			}else{
				return false;
			}
		}
		public function checkPassword($password,$dept){
			$result=$this->db->query("SELECT * FROM nsauth WHERE `password`='$password' AND station='$dept'");
			return $result->result_array();
		}
		public function checkControlNo($employerno){
			$result=$this->db->query("SELECT * FROM admission WHERE employerno='$employerno'");
			return $result->result_array();
		}
		public function checkHCN($hcn){
			$result=$this->db->query("SELECT * FROM admission WHERE employerno='$hcn'");
			return $result->result_array();
		}
		public function generateCaseNo($seqname,$user){
			$datenow=date('Y');
			$query=$this->db->query("SELECT * FROM seqcaseno WHERE seq_name='$seqname' AND seq_code='$datenow'");
			if($query->num_rows()>0){
				$row=$query->row_array();
				$seq_name=$row['seq_name'];
				$seq_code=$row['seq_code'];
				$last_value=$row['last_value'];
				$last_gen_date=date('Y',strtotime($row['last_gen_date']));
				$date=date('Y-m-d H:i:s');
				if($last_gen_date == $seq_code){
					$new_value=$last_value+1;
				}else{
					$new_value=1;
				}
				$count_last_value=strlen($new_value);
				$count_format=strlen('0000000');
				$count=$count_format - $count_last_value;
				$new_format="";
				for($i=0;$i<$count;$i++){
					$new_format=$new_format."0";
				}

				$caseno=$seq_name."-".$seq_code."".$new_format."".$new_value;
				$updateCaseNo=$this->db->query("UPDATE seqcaseno SET `last_value`='$new_value',last_gen_date='$date',last_gen_by='$user' WHERE seq_name='$seqname'");
			}else{
				$new_value=1;
				$last_gen_date=date('Y');
				$format='000000';
				$date=date('Y-m-d H:i:s');
				$caseno=$seqname."-".$last_gen_date."".$format."".$new_value;
				$update=$this->db->query("INSERT INTO seqcaseno(seq_name,seq_code,`last_value`,last_gen_date,last_gen_by) VALUES('$seqname','$last_gen_date','$new_value','$date','$user')");
			}
			return $caseno;
		}
		public function generatePatientID($seqname,$user){
			$query=$this->db->query("SELECT * FROM seqpatientid WHERE id='$seqname'");
			if($query->num_rows()>0){
				$row=$query->row_array();
				$seq_name=$row['seq_name'];
				$seq_code=$row['seq_code'];
				$last_value=$row['last_value'];
				$date=date('Y-m-d H:i:s');
				$new_value=$last_value+1;
				if($new_value > 99){
					$new_value="00";
					$seq_code=$seq_code+1;
					if($seq_code > 99){
						$seq_name=$seq_name+1;
						$seq_code="00";
						if(strlen($seq_name) < 2){
							$seq_name="0".$seq_name;
						}
					}
					if(strlen($seq_code)<2){
						$seq_code="0".$seq_code;
					}
				}
				$count_last_value=strlen($new_value);
				$count_format=strlen('00');
				$count=$count_format - $count_last_value;
				$new_format="";
				for($i=0;$i<$count;$i++){
					$new_format="0".$new_value;
				}
				if($count<=0){
					$new_format=$new_value;
				}
				$caseno=$seq_name."-".$seq_code."-".$new_format;
				$this->db->query("UPDATE seqpatientid SET seq_name='$seq_name',seq_code='$seq_code',last_value='$new_format',last_gen_date='$date',last_gen_by='$user' WHERE id='$seqname'");
			}else{
				$new_value="01";
				$last_gen_date="00";
				$format='00';
				$date=date('Y-m-d H:i:s');
				$caseno=$format."-".$last_gen_date."-".$new_value;
				$this->db->query("INSERT INTO seqpatientid(id,seq_name,seq_code,last_value,last_gen_date,last_gen_by) VALUES('$seqname','$format','$last_gen_date','$new_value','$date,'$user')");
			}
			return $caseno;
		}
		public function generateRefNo($seqname,$user){
			$datenow=date('Y');
			$checkExist=$this->db->query("SELECT * FROM seqpatientid WHERE seq_name='$seqname' AND seq_code='$datenow'");
			if($checkExist->num_rows()==1){
				$row=$checkExist->row_array();
				$seq_name=$seqname;
				$seq_code=$datenow;
				$last_value=$row['last_value'];
				$last_gen_date=date('Ym',strtotime($row['last_gen_date']));
				$date=date('Y-m-d H:i:s');
				$new_value=$last_value+1;
				$count_last_value=strlen($new_value);
				$count_format=strlen('00000');
				$count=$count_format - $count_last_value;
				$new_format="";
				for($i=0;$i<$count;$i++){
					$new_format=$new_format."0";
				}

				$caseno=$seq_name."".$seq_code."".$new_format."".$new_value;
				$this->db->query("UPDATE seqpatientid SET last_value='$new_value',last_gen_date='$date',last_gen_by='$user' WHERE seq_name='$seqname'");
			}else{
				$new_value=1;
				$last_gen_date=date('Ym');
				$format='0000';
				$seq_name=$seqname;
				$caseno=$seq_name."".$datenow."".$format."".$new_value;
				$this->db->query("INSERT INTO seqpatientid(seq_name,seq_code,last_value,last_gen_date,last_gen_by) VALUES('$seqname','$datenow','$new_value',NOW(),'$user')");
			}
			return $caseno;
		}
		public function generatePONo($prefix,$user){
			$datenow=date('Y');
			$checkExist=$this->db->query("SELECT * FROM seqpatientid WHERE seq_name='$prefix' AND seq_code='$datenow'");
			if($checkExist->num_rows()==1){
				$row=$checkExist->row_array();
				$seq_name=$prefix;
				$seq_code=$datenow;
				$last_value=$row['last_value'];
				$last_gen_date=date('Ym',strtotime($row['last_gen_date']));
				$date=date('Y-m-d H:i:s');
				$new_value=$last_value+1;
				$count_last_value=strlen($new_value);
				$count_format=strlen('00000');
				$count=$count_format - $count_last_value;
				$new_format="";
				for($i=0;$i<$count;$i++){
					$new_format=$new_format."0";
				}

				$caseno=$seq_code."".$new_format."".$new_value;
				$this->db->query("UPDATE seqpatientid SET last_value='$new_value',last_gen_date='$date',last_gen_by='$user' WHERE seq_name='$prefix'");
			}else{
				$new_value=1;
				$last_gen_date=date('Ym');
				$format='0000';
				$caseno=$datenow."".$format."".$new_value;
				$this->db->query("INSERT INTO seqpatientid(seq_name,seq_code,last_value,last_gen_date,last_gen_by) VALUES('$prefix','$datenow','$new_value',NOW(),'$user')");
			}
			return $caseno;
		}
		public function userlogs($message,$loginuser){
			$datearray=date('Y-m-d');
			$timearray=date('H:i:s');
			$logs=$this->db->query("INSERT INTO userlogs(transaction,loginuser,datearray,timearray) VALUES('$message','$loginuser','$datearray','$timearray')");
			return $logs;
		}

		public function update_attending_doctor(){
			$caseno=$this->input->post('caseno');
			$ap=$this->input->post('ap');
			$update=$this->db->query("UPDATE admission SET ap='$ap' WHERE caseno='$caseno'");
			if($update){
				return true;
			}else{
				return false;
			}
		}
		public function update_admitting_doctor(){
			$caseno=$this->input->post('caseno');
			$ap=$this->input->post('ad');
			$update=$this->db->query("UPDATE admission SET ad='$ap' WHERE caseno='$caseno'");
			if($update){
				return true;
			}else{
				return false;
			}
		}
		public function getAccountTitleAR(){
			$state=$this->db->query("SELECT * FROM accttitle WHERE accttitle LIKE '%AR %' ORDER BY accttitle ASC");
			return $state->result_array();
		}
		public function getEmployeeDetails(){
			$state=$this->db->query("SELECT * FROM nsauthemployees ORDER BY lastname ASC");
			return $state->result_array();
		}
		public function checkChargeTo($id){
			$query=$this->db->query("SELECT * FROM nsauthemployees WHERE empid='$id'");
			if($query->num_rows()>0){
				return $query->row_array();
			}else{
				$query=$this->db->query("SELECT * FROM docfile WHERE code='$id'");
				return $query->row_array();
			}
		}
		public function getAllStockRequest(){
			$dept=$this->session->dept;
			$result=$this->db->query("SELECT * FROM purchaseorder WHERE reqdept='$dept' AND `status`='request' GROUP BY reqno ORDER BY reqdate DESC");
			return $result->result_array();
		}
		public function requestprintheader($param){
			$result=$this->db->query("SELECT * FROM purchaseorder WHERE reqno='$param' AND `status`='request' GROUP BY po");
			return $result->row_array();
		}
		public function requestprintbody($param){
			$result=$this->db->query("SELECT po.*,r.generic FROM purchaseorder po INNER JOIN receiving r ON r.code=po.code WHERE reqno='$param' AND `status`='request' ORDER BY r.generic ASC");
			return $result->result_array();
		}
		public function getRequestLastDate($code,$reqdept,$reqdate){
			$result=$this->db->query("SELECT reqdate FROM purchaseorder WHERE code='$code' AND reqdept='$reqdept' AND reqdate < '$reqdate' GROUP BY reqno ORDER BY reqdate DESC");
			return $result->row_array();
		}
		public function getAllStation(){
			$result=$this->db->query("SELECT station FROM nsauth GROUP BY station");
			return $result->result_array();
		}
		public function fetch_item_by_desc($dept){
			if($dept=="CPU" || $dept=="CSR" || $dept=="CPU-RDU") {
				$result = $this->db->query("SELECT r.*,SUM(s.quantity) as quantity FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE s.dept='$dept' AND s.datearray >= '2021-07-01' GROUP BY r.code ORDER BY r.description ASC");
			}else{
				$result = $this->db->query("SELECT r.*,SUM(s.quantity) as quantity FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE s.dept='$dept' GROUP BY r.code ORDER BY r.description ASC");
			}
			return $result->result_array();
		}
		public function getAllRequested($reqno,$reqdept){
			$result=$this->db->query("SELECT po.*,r.description,r.generic,r.itemname FROM purchaseorder po INNER JOIN receiving r ON r.code=po.code WHERE po.reqdept='$reqdept' AND po.`status`='request' AND po.reqno='$reqno' ORDER BY po.rrdetails ASC");
			return $result->result_array();
		}
		public function getQty($code,$dept){
			if($dept=="CPU" || $dept=="CSR" || $dept=="CPU-RDU"){
				$result=$this->db->query("SELECT SUM(quantity) as quantity FROM stocktable WHERE `code`='$code' AND dept='$dept' AND datearray >= '2021-07-01'");
			}else{
				$result=$this->db->query("SELECT SUM(quantity) as quantity FROM stocktable WHERE `code`='$code' AND dept='$dept'");
			}
			return $result->row_array();

		}
		public function requestadditem($code,$quantity,$type,$qty){
			$reqno=$this->session->reqno;
			$requestingdept=$this->session->requestingdept;
			$requestinguser=$this->session->requestinguser;
			$requestingdate=$this->session->requestingdate;
			$requesteddept=$this->session->requesteddept;
			$tdate=date('M-d-Y',strtotime($requestingdate));
			$checkExist=$this->db->query("SELECT * FROM purchaseorder WHERE reqno='".$reqno."' AND code='".$code."' AND `status`='request'");
			if($checkExist->num_rows()>0){
				$exist=$checkExist->row_array();
				$oldqty=$exist['prodqty'];
				$newqty=$oldqty+$quantity;
				if($newqty > $qty){
					return false;
				}else{
					$this->db->query("UPDATE purchaseorder SET prodqty='".$newqty."' WHERE reqno='".$reqno."' AND code='".$code."'");
					return true;
				}
			}else{
				$sqlDescription=$this->db->query("SELECT `description`,unitcost,prodtype1 FROM stocktablepayables WHERE code='$code' AND (trantype='charge' OR trantype='cash') ORDER BY autono DESC LIMIT 1");
				if($sqlDescription->num_rows()>0){
					$item1=$sqlDescription->row_array();
					$desc = $item1['description'];
					$unitcost=$item1['unitcost'];
				}else{
					$sqlDescription=$this->db->query("SELECT `description`,prodtype1,unitcost FROM stocktable WHERE code='$code' AND (trantype='charge' OR trantype='cash') ORDER BY autono DESC LIMIT 1");
					$item2=$sqlDescription->row_array();
					$desc = $item2['description'];
					$unitcost=$item2['unitcost'];
				}
				if($quantity>$qty){
					return false;
				}else{
					$this->db->query("INSERT INTO purchaseorder(rrno,transdate,supplier,suppliercode,terms,trantype,code,`description`,unitcost,generic,prodqty,dept,`status`,prodtype1,po,user,approvingofficer,reqdept,reqno,reqdate,requser) VALUES('','$tdate','$requesteddept','$requesteddept','','None','$code','$desc','$unitcost','$requestingdate','$quantity','$requesteddept','request','0','$reqno','$requestinguser','$type','$requestingdept','$reqno','$requestingdate','$requestinguser')");
					return true;
				}
			}
		}
		public function fetch_single_item($code,$dept){
			if($dept=="CPU" || $dept=="CSR" || $dept=="CPU-RDU") {
				$result = $this->db->query("SELECT r.*,SUM(s.quantity) as quantity FROM stocktable s INNER JOIN receiving r ON r.code=s.code WHERE s.dept='$dept' AND s.datearray >= '2021-07-01' AND s.`code`='$code' GROUP BY s.code");
			}else{
				$result = $this->db->query("SELECT r.*,SUM(s.quantity) as quantity FROM stocktable s INNER JOIN receiving r ON r.code=s.code WHERE s.dept='$dept' AND s.`code`='$code' GROUP BY s.code");
			}
			return $result->result_array();
		}
		public function remove_item_request($id){
			$result=$this->db->query("DELETE FROM purchaseorder WHERE rrdetails='$id'");
			if($result){
				return true;
			}else{
				return false;
			}
		}
		public function cancel_request($reqno){
			$check=$this->db->query("SELECT * FROM purchaseorder WHERE reqno='$reqno' AND `status`='received'");
			if($check->num_rows()>0){
				return false;
			}else{
				$this->db->query("DELETE FROM purchaseorder WHERE reqno='$reqno'");
				return true;
			}
		}
		public function getAllAdmission(){
			$rundate=$this->input->post('rundate');
			$admitted=$this->db->query("SELECT a.*,pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno LIKE '%I-%' AND a.dateadmit='$rundate' ORDER BY a.employerno ASC");
			return $admitted->result_array();
		}
		public function getAllRDUAdmission(){
			$rundate=$this->input->post('rundate');
			$admitted=$this->db->query("SELECT a.*,pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno LIKE 'R-%' AND a.dateadmit='$rundate' ORDER BY a.employerno ASC");
			return $admitted->result_array();
		}
		public function getAllAdmissionOPD(){
			$rundate=$this->input->post('rundate');
			$admitted=$this->db->query("SELECT a.*,pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno LIKE '%O-%' AND a.dateadmit='$rundate' ORDER BY a.employerno ASC");
			return $admitted->result_array();
		}
		public function finalcaserate($caseno){
			$caserate=$this->db->query("SELECT fc.* FROM finalcaserate fc WHERE fc.caseno='$caseno' AND (fc.type ='icd' OR fc.description LIKE '%covid%' OR fc.type ='rvs') GROUP BY fc.icdcode ORDER BY fc.autono ASC");
			return $caserate->result_array();
		}
		public function finalcaseratereport($caseno){
			$caserate=$this->db->query("SELECT fc.* FROM finalcaserate fc INNER JOIN caserates cs ON cs.icdcode=fc.icdcode WHERE fc.caseno='$caseno' AND (fc.type ='icd' OR fc.description LIKE '%covid%' OR fc.type ='rvs') AND cs.category <> 'surgical' GROUP BY fc.icdcode ORDER BY fc.autono ASC");
			return $caserate->result_array();
		}
		public  function surgical($caseno){
			$caserate=$this->db->query("SELECT fc.* FROM finalcaserate fc INNER JOIN caserates cs ON cs.icdcode=fc.icdcode WHERE fc.caseno='$caseno' AND cs.category = 'surgical' AND fc.description NOT LIKE '%COVID%' ORDER BY fc.autono ASC");
			return $caserate->result_array();
		}
		public function getAllDischarged(){
			$rundate=$this->input->post('rundate');
			//$dateadmitted=date('M-d-Y',strtotime($rundate));
			$admitted=$this->db->query("SELECT a.*,pp.*,dt.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN dischargedtable dt ON dt.caseno=a.caseno WHERE dt.datearray = '$rundate' AND a.caseno LIKE '%I-%' ORDER BY pp.lastname ASC");
			return $admitted->result_array();
		}
		public function getSinglePatient($patientidno){
			$result=$this->db->query("SELECT pp.*,pa.*,a.patientcontactno FROM patientprofile pp INNER JOIN patientprofileaddinfo pa ON pa.patientidno=pp.patientidno INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE pp.patientidno='$patientidno' GROUP BY a.patientidno ORDER BY a.patientcontactno DESC");
			return $result->row_array();
		}
		public function fetchSinglePatient($patientidno){
			$result=$this->db->query("SELECT pp.*,pa.*,a.patientcontactno FROM patientprofile pp INNER JOIN patientprofileaddinfo pa ON pa.patientidno=pp.patientidno INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE pp.patientidno='$patientidno' GROUP BY a.patientidno ORDER BY a.patientcontactno DESC");
			return $result->result_array();
		}
		public function getAllPatientAdmission($patientidno){
			  if($this->session->dept=="BILLING"){
			  	$result=$this->db->query("SELECT * FROM admission WHERE patientidno='$patientidno' AND caseno LIKE 'AR-%' ORDER BY dateadmit DESC");
			  }else{
				$result=$this->db->query("SELECT * FROM admission WHERE patientidno='$patientidno' GROUP BY caseno ORDER BY dateadmit DESC");
			 }

			return $result->result_array();
		}
		public function updatepatientprofile(){
			$patientidno=$this->input->post('patientidno');
			$lastname=$this->input->post('lastname');
			$firstname=$this->input->post('firstname');
			$middlename=$this->input->post('middlename');
			$suffix=$this->input->post('suffix');
			$dateofbirth=$this->input->post('birthdate');
			$birthdate=date('M-d-Y',strtotime($dateofbirth));
			$gender=$this->input->post('gender');
			$discounttype=$this->input->post('discounttype');
			$discountid=$this->input->post('discountid');
			$contactno=$this->input->post('contactno');
			$patientname=$lastname." ".$firstname." ".$middlename." ".$suffix;
			$bday=new DateTime($dateofbirth);
			$datenow=date('Y-m-d');
			$today=new DateTime($datenow);
			$diff=$today->diff($bday);
			$age=$diff->y;
			if(($age >= 60 && $discounttype=="SENIOR") || $discounttype=="PWD" || $age >= 60){
				$senior="Y";
				$discounttype=$discounttype;
			}else{
				$senior="N";
				$discounttype="NONE";
			}
			$this->db->query("UPDATE patientprofile SET lastname='$lastname',firstname='$firstname',middlename='$middlename',suffix='$suffix',birthdate='$birthdate',age='$age',sex='$gender',senior='$senior',patientname='$patientname',dateofbirth='$dateofbirth' WHERE patientidno='$patientidno'");
			$this->db->query("UPDATE patientprofileaddinfo SET discounttype='$discounttype',discountid='$discountid' WHERE patientidno='$patientidno'");
			$this->db->query("UPDATE admission SET patientcontactno='$contactno' WHERE patientidno='$patientidno'");
			return true;
		}
		public function getAllInPatientAdmission($patientidno){

				$result=$this->db->query("SELECT * FROM admission WHERE patientidno='$patientidno' AND (caseno LIKE '%I-%' OR (caseno LIKE '%O-%' AND employerno LIKE '%M%' OR employerno LIKE '%E%' OR employerno LIKE '%ONCO%')) ORDER BY dateadmit DESC");

			return $result->result_array();
		}
		public function getSingleAddress($patientidno){
			$result=$this->db->query("SELECT street,barangay,municipality,province,zipcode FROM admission WHERE patientidno='$patientidno' ORDER BY province DESC");
			return $result->row_array();
		}
		public function fetch_single_address($patientidno){
			$result=$this->db->query("SELECT street,barangay,municipality,province,zipcode FROM admission WHERE patientidno='$patientidno' ORDER BY province DESC");
			return $result->result_array();
		}
		public function updatepatientaddress(){
			$patientidno=$this->input->post('patientidno');
			$province=$this->input->post('province');
			$city=$this->input->post('city');
			$barangay=$this->input->post('barangay');
			$street=$this->input->post('street');
			$zipcode=$this->input->post('zipcode');
			$statename=$this->db->query("SELECT * FROM `state` WHERE id='$province' OR statename='$province'");
			$state=$statename->row_array();
			$provinceid=$state['id'];
			$provincename=$state['statename'];

			$municityname=$this->db->query("SELECT * FROM city WHERE id='$city' OR city='$city'");
			$municity=$municityname->row_array();
			$cityid=$municity['id'];
			$cityname=$municity['city'];

			$barang=$this->db->query("SELECT * FROM barangay WHERE id='$barangay' OR barangay='$barangay'");
			$barangname=$barang->row_array();
			$barangayid=$barangname['id'];
			$barangayname=$barangname['barangay'];

			$update=$this->db->query("UPDATE admission SET street='$street',province='$provincename',municipality='$cityname',barangay='$barangayname',zipcode='$zipcode' WHERE patientidno='$patientidno'");
			if($update){
				return true;
			}else{
				return false;
			}
		}

		public function getServiceType(){
			$result=$this->db->query("SELECT DISTINCT proc FROM PF_SHARING WHERE tag NOT LIKE '%None%' ORDER BY proc ASC");
			return $result->result_array();
		}
		public function getProcedure(){
			$odb=$this->load->database('emr',true);
			$dept=$this->session->dept;
			$d="";
			if($dept=="OPD"){
				$d="OR";
			}
			if($dept=="ONCO"){
				$d="ONCO";
			}
			$result=$odb->query("SELECT * FROM rsurgery WHERE procdesc <> '' ORDER BY procdesc ASC");
			return $result->result_array();
		}

		public function getAllOutPatientByDate($datenow){
			$result=$this->db->query("SELECT * FROM admission WHERE dateadmit='$datenow' AND caseno LIKE '%O-%' ORDER BY timeadmitted DESC");
			return $result->result_array();
		}
		public function getAllWalkinPatientByDate($datenow){
			$result=$this->db->query("SELECT * FROM admission WHERE dateadmit='$datenow' AND (caseno LIKE '%W-%' OR caseno LIKE '%WPOS-%') ORDER BY timeadmitted DESC");
			return $result->result_array();
		}
		public function getAllLaboratoryByDate($datenow){
			$result=$this->db->query("SELECT a.*,po.productdesc,d.name FROM admission a INNER JOIN productout po ON po.caseno=a.caseno INNER JOIN docfile d ON d.code=a.ap WHERE a.dateadmit='$datenow' AND a.caseno LIKE '%W-%' AND po.productsubtype='LABORATORY' ORDER BY timeadmitted DESC");
			return $result->result_array();
		}
		public function getAllDiagnosticsByDate($datenow){
			$result=$this->db->query("SELECT a.*,po.productdesc,d.name FROM admission a INNER JOIN productout po ON po.caseno=a.caseno INNER JOIN docfile d ON d.code=a.ap WHERE a.dateadmit='$datenow' AND a.caseno LIKE '%W-%' AND (po.productsubtype='2D ECHO' OR po.productsubtype='XRAY' OR po.productsubtype='CT SCAN' OR po.productsubtype='UTRASOUND' OR po.productsubtype='EEG' OR po.productsubtype='ECG') ORDER BY timeadmitted DESC");
			return $result->result_array();
		}
		public function getAllAccountTitle(){
			$result=$this->db->query("SELECT * FROM accttitle ORDER BY acctcode ASC");
			return $result->result_array();
		}
		public function fetch_single_code($id){
			$result=$this->db->query("SELECT * FROM receiving WHERE code='$id'");
			return $result->result_array();
		}
		public function getAllBranch(){
			$result=$this->db->query("SELECT * FROM station ORDER BY station ASC");
			return $result->result_array();
		}
		public function caserates(){
			$result=$this->db->query("SELECT * FROM caserates WHERE description <> '' ORDER BY description ASC LIMIT 10");
			return $result->result_array();
		}
		public function searchcaserates(){
			$description=$this->input->post('description');
			$result=$this->db->query("SELECT * FROM caserates WHERE description <> '' AND (description LIKE '%$description%' || icdcode LIKE '%$description%') ORDER BY description ASC");
			return $result->result_array();
		}
		public function getAllAdmissionRecords(){
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$type=$this->input->post('type');
			if($type=="AdmissionDate"){
				$admitted=$this->db->query("SELECT a.*,pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno LIKE 'I-%' AND a.dateadmit BETWEEN '$startdate' AND '$enddate' AND a.status <> 'CANCELLED' ORDER BY a.employerno ASC");
			}else{
				$admitted=$this->db->query("SELECT a.*,pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno LIKE 'I-%' AND a.dateadmit BETWEEN '$startdate' AND '$enddate' AND a.status <> 'CANCELLED' ORDER BY pp.lastname ASC");
			}
			return $admitted->result_array();
		}
		public function getAllAdmissionListTime(){
			$startdate=$this->input->post('startdate');
			$admitted=$this->db->query("SELECT a.*,pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno LIKE '%I-%' AND a.dateadmit = '$startdate' ORDER BY a.timeadmitted ASC");
			return $admitted->result_array();
		}
		public function getAllAdmissionListAlphabetical(){
			$startdate=$this->input->post('startdate');
			$admitted=$this->db->query("SELECT a.*,pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno LIKE '%I-%' AND a.dateadmit = '$startdate' ORDER BY pp.lastname ASC,pp.firstname ASC");
			return $admitted->result_array();
		}
		public function getHRN($id){
			$result=$this->db->query("SELECT hrn FROM hrn WHERE patientidno='$id'");
			return $result->row_array();
		}
		public function getAllBabyAdmission(){
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$admitted=$this->db->query("SELECT a.*,pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno LIKE '%I-%' AND a.dateadmit BETWEEN '$startdate' AND '$enddate' AND a.stat1='NEW BORN' ORDER BY a.dateadmit ASC");
			return $admitted->result_array();
		}
		public function getAllExpiredPatient(){
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$admitted=$this->db->query("SELECT a.*,pp.*,dt.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN dischargedtable dt ON dt.caseno=a.caseno WHERE dt.datearray BETWEEN '$startdate' AND '$enddate' AND a.caseno LIKE '%I-%' AND a.disposition = 'DIED' ORDER BY dt.datearray ASC");
			return $admitted->result_array();
		}
		public function getAllCompliance(){
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$admitted=$this->db->query("SELECT a.*,pp.*,dt.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN dischargedtable dt ON dt.caseno=a.caseno WHERE dt.datearray BETWEEN '$startdate' AND '$enddate' AND (a.caseno LIKE '%I-%' OR a.employerno LIKE 'M%')  order by dt.datearray,dt.timedischarged,a.caseno asc");
			return $admitted->result_array();
		}
		public function getAllPatientList(){
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$admitted=$this->db->query("SELECT a.*,pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.dateadmit BETWEEN '$startdate' AND '$enddate' AND (a.caseno LIKE '%I-%' OR a.caseno LIKE '%O-%') AND a.status NOT LIKE '%CANCELLED%' AND pp.lastname NOT LIKE '%TESTÑRDU%' ORDER BY a.dateadmit ASC");
			return $admitted->result_array();
		}
		public function getProcessBy($caseno){
			$admitted=$this->db->query("SELECT * FROM userlogs WHERE transaction LIKE '%$caseno%'");
			return $admitted->result_array();
		}
		public function getSinglePatientAdmission($patientidno){
			$result=$this->db->query("SELECT pp.*,a.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.patientidno='$patientidno' AND a.caseno LIKE '%I-%' GROUP BY a.patientidno");
			return $result->result_array();
		}
		public function getAllInPatientAdmissionCard($patientidno){
			$result=$this->db->query("SELECT * FROM admission WHERE patientidno='$patientidno' AND caseno LIKE '%I-%' ORDER BY dateadmit ASC");
			return $result->result_array();
		}
		public function getAdmissionByPatient($caseno){
			$result=$this->db->query("SELECT pp.*,a.street,a.barangay,a.municipality,a.province,a.zipcode,ai.chiefcomplaint,a.dateadmit,a.timeadmitted,a.ap FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN admissionaddinfo ai ON ai.caseno=a.caseno WHERE a.caseno='$caseno'");
			return $result->row_array();
		}
		public function getAllDischargedReportCOH($caseno){
			$rundate=$this->input->post('rundate');
			$enddate=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));
			$startdate=date('Y-m-d',strtotime('-1 day',strtotime($enddate)));
			if($caseno=="O-"){
				$result=$this->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE (c.datearray = '$rundate') AND (a.status='discharged' OR a.ward='discharged') AND a.caseno LIKE '%$caseno%' AND ((c.accttitle='CASHONHAND' AND (c.type='cash-Visa' OR c.type='card-Visa')) OR (c.accttitle='PROFESSIONAL FEE' AND c.type='card-Visa')) AND c.refno NOT LIKE '%LP%' GROUP BY a.caseno ORDER BY pp.lastname ASC");
			}else{
				$result=$this->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE ((c.datearray = '$startdate' AND c.paymentTime >= '23:00:00') OR (c.datearray = '$enddate' AND c.paymentTime < '23:00:00')) AND (a.status='discharged' OR a.ward='discharged') AND a.caseno LIKE '%$caseno%' AND ((c.accttitle='CASHONHAND' AND (c.type='cash-Visa' OR c.type='card-Visa')) OR (c.accttitle='PROFESSIONAL FEE' AND c.type='card-Visa')) AND c.refno NOT LIKE '%LP%' GROUP BY a.caseno ORDER BY pp.lastname ASC");
			}
			return $result->result_array();
		}
		public function getAllDischargedReportWOCOH($caseno){
			$rundate=$this->input->post('rundate');
			$enddate=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));
			$startdate=date('Y-m-d',strtotime('-1 day',strtotime($enddate)));
			if($caseno=="O-"){
				$result=$this->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno LEFT JOIN arv_tbl_hmofinalize atm ON atm.caseno=a.caseno WHERE (c.datearray = '$rundate') AND (a.status='discharged' OR a.ward='discharged') AND (a.caseno LIKE '%$caseno%') AND (((c.accttitle = 'AR TRADE' OR c.accttitle LIKE '%AR TRADE%' OR c.accttitle = 'NO EXCESS' OR c.accttitle LIKE '%AR EMPLOYEE%' OR c.accttitle LIKE '%AR DOCTOR%') AND c.type='pending') OR (c.accttitle='PROFESSIONAL FEE' AND c.type='cash-Visa')) AND c.refno NOT LIKE '%LP%' GROUP BY a.caseno ORDER BY pp.lastname ASC");
			}else{
				$result=$this->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE ((c.datearray = '$startdate' AND c.paymentTime >= '23:00:00') OR (c.datearray = '$enddate' AND c.paymentTime < '23:00:00')) AND (a.status='discharged' OR a.ward='discharged') AND a.caseno LIKE '%$caseno%' AND (((c.accttitle = 'AR TRADE' OR c.accttitle LIKE '%AR TRADE%' OR c.accttitle LIKE 'AR DSWD' OR c.accttitle = 'NO EXCESS' OR c.accttitle LIKE '%AR EMPLOYEE%' OR c.accttitle LIKE '%AR DOCTOR%') AND c.type='pending') OR (c.accttitle='PROFESSIONAL FEE' AND c.type='cash-Visa')) AND c.refno NOT LIKE '%LP%' GROUP BY a.caseno ORDER BY pp.lastname ASC");			
			}
			return $result->result_array();
			// if($result->num_rows() > 0 ){
			// 	return $result->result_array();
			// }else{
			// 	$result=$this->db->query("SELECT CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,a.caseno,a.dateadmit,a.employerno,a.hmo,a.addemployer,c.amount FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN arv_tbl_hmofinalize atm ON atm.caseno=a.caseno LEFT JOIN collection c ON c.acctno=a.caseno WHERE atm.datearray='$rundate' AND atm.status <> ''");
        	// 	return $result->result_array();
			// }
		}		
		public function checkCOH($caseno){
			$result=$this->db->query("SELECT SUM(amount) AS amount FROM collection WHERE ((accttitle='CASHONHAND' AND (`type`='cash-Visa' OR `type`='card-Visa')) OR (accttitle ='PROFESSIONAL FEE' AND `type`='card-Visa')) AND acctno='$caseno'");
			return $result->row_array();
		}
		public function getAllHomeMeds($caseno,$batchno){
			$case=explode('-',$caseno);
			if($case[0]=="I"){
				$check=$this->db->query("SELECT * FROM admission WHERE caseno='$caseno' AND (`status` = 'MGH' OR `status`='discharged')");
				if($check->num_rows()>0){
					$result=$this->db->query("SELECT ph.productcode, ph.productdesc, SUM(ph.quantity) as quantity, ph.refno, ph.trantype FROM productout po RIGHT JOIN productouthm ph ON ph.refno=po.refno WHERE ph.caseno='$caseno' AND (ph.batchno='$batchno') group by ph.productcode");
				}else{
					$result=$this->db->query("SELECT po.productcode, po.productdesc, SUM(po.quantity) as quantity, po.refno, po.trantype FROM productout po LEFT JOIN productouthm ph ON ph.refno=po.refno WHERE po.caseno='$caseno' AND po.batchno='$batchno' group by po.productcode");
				}
			}else{
				if($case[0]=="WPOS"){
					$result=$this->db->query("SELECT productcode, productdesc, SUM(quantity) as quantity, refno, trantype, gross  FROM productout WHERE caseno='$caseno' AND batchno='$batchno' group by productcode");
				}else{
					$result=$this->db->query("SELECT productcode, productdesc, SUM(quantity) as quantity, refno, trantype, gross  FROM productouthm WHERE caseno='$caseno' AND batchno='$batchno' group by productcode");
				}
			}
			return $result->result_array();
		}
		public function getAllHomeMedsRemarks($caseno,$refno){
			$result=$this->db->query("SELECT * FROM homemeds WHERE caseno='$caseno' and refno='$refno'");
			return $result->row_array();
		}
		public function getAllPatientByDate($startdate,$enddate){
			$result=$this->db->query("SELECT pp.*,a.caseno,a.dateadmit,c.datearray FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN collection c ON c.acctno=a.caseno LEFT JOIN dischargedtable dt ON dt.caseno=a.caseno WHERE (c.datearray BETWEEN '$startdate' AND '$enddate' OR dt.datearray BETWEEN '$startdate' AND '$enddate')  AND c.accttitle LIKE '%DEPOSIT%' GROUP BY a.caseno ORDER BY pp.lastname ASC,c.datearray DESC");
			return $result->result_array();
		}

		public function getAllDischargedReportIPD(){
			$rundate=$this->input->post('rundate');
			$department=$this->input->post('department');
			$enddate=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));
			$startdate=date('Y-m-d',strtotime('-1 day',strtotime($enddate)));
			if($department=="R-"){
				$result=$this->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname FROM admission a LEFT JOIN dischargedtable c ON c.caseno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE (c.datearray = '$rundate') AND (a.status='discharged' OR a.ward = 'discharged') AND a.caseno LIKE '$department%' AND a.hmo <> 'N/A' GROUP BY a.caseno ORDER BY pp.lastname ASC");
			}else if($department=="O-"){
				$result=$this->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname FROM admission a LEFT JOIN dischargedtable c ON c.caseno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE (c.datearray = '$rundate') AND (a.status='discharged' OR a.ward = 'discharged') AND (a.caseno LIKE '$department%' OR a.caseno LIKE 'W-%' OR a.caseno LIKE 'AR-%') AND a.hmo <> 'N/A' GROUP BY a.caseno ORDER BY pp.lastname ASC");
			}else{
				$result=$this->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,SUM(c.amount) as amount FROM admission a LEFT JOIN collection c ON c.acctno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE ((c.datearray = '$startdate' AND c.paymentTime >= '23:00:00') OR (c.datearray = '$enddate' AND c.paymentTime < '23:00:00')) AND (a.status='discharged' OR a.ward = 'discharged') AND a.caseno LIKE '%$department%' AND a.hmo <> 'N/A' AND ((c.accttitle='CASHONHAND' AND (c.type='cash-Visa' OR c.type='card-Visa')) OR (c.accttitle='PROFESSIONAL FEE' AND c.type LIKE '%Visa%') OR (((c.accttitle = 'AR TRADE' OR c.accttitle LIKE '%AR TRADE%' OR c.accttitle = 'NO EXCESS' OR c.accttitle LIKE '%AR EMPLOYEE%' OR c.accttitle LIKE '%AR DOCTOR%') AND c.type='pending'))) GROUP BY a.caseno ORDER BY pp.lastname ASC");
			}
			return $result->result_array();
		}
		public function getAllAdmissionMinor($startdate,$enddate){
			$result=$this->db->query("SELECT pp.*,a.* FROM admission a INNER JOIN patientprofile pp ON a.patientidno=pp.patientidno WHERE a.dateadmit BETWEEN '$startdate' AND '$enddate' AND a.employerno LIKE '%M%' AND a.caseno LIKE '%O-%'");
			return $result->result_array();
		}
		public function getAllDischargedReportRDU(){
			$rundate=$this->input->post('rundate');								
			$result=$this->db->query("SELECT a.caseno,CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname FROM admission a LEFT JOIN dischargedtable c ON c.caseno=a.caseno LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE (c.datearray = '$rundate') AND (a.status='discharged' OR a.ward = 'discharged') AND a.caseno LIKE 'R-%' GROUP BY a.caseno ORDER BY pp.lastname ASC");			
			return $result->result_array();
		}
		public function getAllBillingAccount(){
			$result=$this->db->query("SELECT * FROM billingreport ORDER BY accounttitle ASC");
			return $result->result_array();
		}
		public function save_billing_report($id,$accttitle){			
			$check=$this->db->query("SELECT * FROM billingreport WHERE accounttitle='$accttitle' AND id <> '$id'");
			if($check->num_rows() > 0){
				return false;
			}else{
				if($id==""){
					$result=$this->db->query("INSERT INTO billingreport(accounttitle) VALUES('$accttitle')");
				}else{
					$result=$this->db->query("UPDATE billingreport SET accounttitle='$accttitle' WHERE id='$id'");
				}
				return true;
			}			
		}
		public function delete_billing_report($id){
			$result=$this->db->query("DELETE FROM billingreport WHERE id='$id'");
			if($result){
				return true;
			}else{
				return false;
			}
		}
	}

?>
