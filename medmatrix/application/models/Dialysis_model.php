<?php
date_default_timezone_set('Asia/Manila');
class Dialysis_model extends CI_model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getAllRDUPatient(){
		$result=$this->db->query("SELECT * FROM admission WHERE room='RDU' AND `status`='Active' GROUP BY patientidno");
		return $result->result_array();
	}
	public function getAllActiveRDUPatient(){
		$result=$this->db->query("SELECT a.*, pp.lastname,pp.firstname,pp.middlename,pp.suffix,ap.name as apname FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno LEFT JOIN docfile ap ON ap.code=a.ap WHERE a.room='RDU' AND a.`status`='Active' ORDER BY a.dateadmit DESC,a.timeadmitted DESC");
		return $result->result_array();
	}
	public function getSingleActiveRDUPatient($searchme){
		$result=$this->db->query("SELECT a.*, pp.lastname,pp.firstname,pp.middlename,pp.suffix,ap.name as apname FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno LEFT JOIN docfile ap ON ap.code=a.ap WHERE a.room='RDU' AND a.`status`='Active' AND CONCAT(pp.lastname,' ',pp.firstname) LIKE '%%$searchme%%' ORDER BY a.dateadmit DESC,a.timeadmitted DESC");
		return $result->result_array();
	}
	public function getAllRDUpatientByDate($date){
		$result=$this->db->query("SELECT * FROM admission WHERE room='RDU' AND `status`='Active' AND dateadmit='$date'");
		return $result->result_array();
	}
	public function getAllRDUpatientByStatus($status){
		$result=$this->db->query("SELECT * FROM admission WHERE caseno LIKE 'R-%' AND `status`='$status' GROUP BY patientidno");
		return $result->result_array();
	}
	public function save_rdu_admission($patientidno,$pid,$caseno,$admittingclerk,$empid){
		$st=$this->session->dept;
		$lastname=$this->input->post('lastname');
		$firstname=$this->input->post('firstname');
		$middlename=$this->input->post('middlename');
		$suffix=$this->input->post('suffix');
		$patientname=$lastname." ".$firstname." ".$suffix." ".$middlename;
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
		$type=$this->input->post('type');
		$paymentmode=$this->input->post('paymentmode');
		$hcn=$this->input->post('hcn');
		$room="RDU";

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
		//=================================================
		/*
		//Room Rates=======================================
		$rates=$this->db->query("SELECT * FROM room WHERE room='$room'");
		$rate=$rates->row_array();
		$roomrates=$rate['roomrates'];
		$creditlimit=$rate['pfadmit'];
		//=================================================
		*/
		if($patientidno==""){
			//Patient Profile==================================
			$this->db->query("INSERT INTO patientprofile(patientidno,lastname,firstname,middlename,suffix,birthdate,age,sex,senior,patientname,dateofbirth,type) VALUES('$pid','$lastname','$firstname','$middlename','$suffix','$birthdate','$age','$gender','$senior','$patientname','$dateofbirth','$date')");
			$this->db->query("INSERT INTO patientprofileaddinfo(patientidno,discounttype,discountid) VALUES('$pid','$discounttype','$discountid')");
			//=================================================
		}else{
			$this->db->query("UPDATE patientprofile SET lastname='$lastname',firstname='$firstname',middlename='$middlename',suffix='$suffix',birthdate='$birthdate',age='$age',sex='$gender',senior='$senior',patientname='$patientname',dateofbirth='$dateofbirth' WHERE patientidno='$pid'");
			$this->db->query("UPDATE patientprofileaddinfo SET discounttype='$discounttype',discountid='$discountid' WHERE patientidno='$pid'");
		}
		//Admission========================================
		$this->db->query("INSERT INTO admission(patientidno,caseno,`type`,membership,hmomembership,hmo,policyno,paymentmode,room,ward,street,barangay,municipality,province,zipcode,middlenamed,initialdiagnosis,ad,ap,`case`,dateadmitted,timeadmitted,`status`,casetype,birthplace,stat1,patientadmit,religion,occupation,job,employerno,notify,relationship,`proc`,contactno,course,patientcontactno,diet,admittingclerk,dateadmit,`count`,branch,consult_id,lastnamed,firstnamed) VALUES('$pid','$caseno','$type','$membership','$hmomembership','$hmo','$loalimit','$paymentmode','$room','out','$street','$barangayname','$cityname','$provincename','$zipcode','$contactperson','','$ap','$ap','','$dateadmit','$timeadmit','Active','A','','$civilstatus','','$religion','','restrict','$hcn','$nationality','$contactpersonrelation','$age','$contactpersonno','NEW','$contactno','','$admittingclerk','$date','1','KMSCI','$demographics','$father','$mother')");
		$this->db->query("INSERT INTO admissionaddinfo(caseno,chiefcomplaint) VALUES('$caseno','')");
		//=================================================

		return true;
	}
	public function activate_account(){
		$caseno=$this->input->post('caseno');
		$result=$this->db->query("UPDATE admission SET status='Active',ward='out' WHERE caseno='$caseno'");
		if($result){
			$this->db->query("DELETE FROM dischargedtable WHERE caseno='$caseno'");
			return true;
		}else{
			return false;
		}
	}
	public function getAllItems(){
		$dept=$this->session->dept;
		$result=$this->db->query("SELECT r.code,r.itemname,SUM(s.quantity) as soh FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE s.dept='$dept' GROUP BY s.code ORDER BY r.itemname ASC");
		return $result->result_array();
	}
	public function getAllItemsDispensed(){
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$code=$this->input->post('item');
		$sql="SELECT *, SUM(quantity) as quantity FROM productout WHERE caseno LIKE '%R-%' AND datearray BETWEEN '$startdate' AND '$enddate' AND productcode='$code' AND quantity > 0 GROUP BY caseno,trantype ORDER BY datearray ASC";
		$result=$this->db->query($sql);
		return $result->result_array();
	}
	public function getSingleItem($code){
		$result=$this->db->query("SELECT * FROM receiving WHERE code='$code'");
		return $result->row_array();
	}
	public function getSinglePatient($caseno){
		$result=$this->db->query("SELECT pp.patientname FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$caseno'");
		return $result->row_array();
	}
	public function getSinglePatientByID($patientidno){
		$result=$this->db->query("SELECT * FROM patientprofile  WHERE patientidno='$patientidno'");
		return $result->row_array();
	}
	public function getAllGuaranteeLetter($patientidno){
		$result=$this->db->query("SELECT *,SUM(amount) as remaining FROM gl_posting WHERE patientidno='$patientidno' GROUP BY gl_id,patientidno ORDER by id ASC");
		return $result->result_array();
	}
	public function fetchGLDetails($id){
		$result=$this->db->query("SELECT *,SUM(amount) as amount FROM gl_posting WHERE gl_id='$id' GROUP BY gl_id ORDER BY id ASC");
		return $result->result_array();
	}
	public function save_gl(){
		$id=$this->input->post('id');
		$patientidno=$this->input->post('patientidno');
		$gl_id=$this->input->post('gl_id');
		$company=$this->input->post('company');
		$amount=$this->input->post('amount');
		$datearray=$this->input->post('datearray');		
		if($id==""){
			$refno=$this->General_model->generateRefNo('GLP',$this->session->fullname);
			$result=$this->db->query("INSERT INTO gl_posting(gl_id,gl_company,amount,patientidno,datearray,refno,gl_type,status) VALUES('$gl_id','$company','$amount','$patientidno','$datearray','$refno','debit','pending')");
		}else{
			$result=$this->db->query("UPDATE gl_posting SET gl_company='$company',amount='$amount',datearray='$datearray' WHERE id='$id'");
		}
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function getAllGuaranteeLetterHistory($gl_id,$patientidno){
		$result=$this->db->query("SELECT * FROM gl_posting WHERE gl_id='$gl_id' AND patientidno='$patientidno' ORDER by id ASC");
		return $result->result_array();
	}
	public function getRDUAllocation($caseno){
		$result=$this->db->query("SELECT excess as totalexcess FROM productout WHERE caseno='$caseno' AND trantype='charge'");
		return $result->result_array();
	}
	public function getGL($patientidno){
		$result=$this->db->query("SELECT *,SUM(amount) as amount FROM gl_posting WHERE patientidno='$patientidno' GROUP BY gl_company HAVING SUM(amount) > 0");
		return $result->result_array();
	}
	public function post_gl(){
		$caseno=$this->input->post('caseno');
		$patientidno=$this->input->post('patientidno');
		$amount=$this->input->post('amount');
		$company=$this->input->post('gl_company');
		$user=$this->session->fullname;
		$datearray=date('Y-m-d');
		$date=date('M-d-Y');
		$patient=$this->Dialysis_model->getSinglePatientByID($patientidno);
		$patientname=$patient['lastname'].", ".$patient['firstname']." ".$patient['middlename']." ".$patient['suffix'];		
		$orig_amount=$amount;
		if($amount > 0){
			if($company=="DISCOUNT" || $company=="AR TRADE"){
				$refno=$this->General_model->generateRefNo('GL',$user);
				$result=$this->db->query("INSERT INTO collection(refno,acctno,acctname,ofr,description,accttitle,amount,discount,`date`,Dept,username,shift,type,paymentTime,paidBy,datearray,branch,batchno) VALUES('$refno','$caseno','$patientname','','HOSPITAL BILL','$company','$amount','0','$date','out','$user','','pending','','','$datearray','KMSCI','')");
					if($result){
						$result=$this->db->query("INSERT INTO acctgenledge(refno,acctitle,transaction,amount,`date`,caseno,status) VALUES('$refno','$company','credit','$amount','$date','$caseno','pending')");
						if($result){
							return true;
						}else{							
							$this->db->query("DELETE FROM collection WHERE refno='$refno'");
							return false;
						}
					}else{						
						return false;
					}
			}else{
				$check=$this->db->query("SELECT *,SUM(amount) as amount FROM gl_posting WHERE patientidno='$patientidno' AND gl_company='$company' GROUP BY gl_id HAVING amount > 0");
				if($check->num_rows()>0){
					$exist=$check->result_array();				
					$refno=$this->General_model->generateRefNo('GL',$user);
					$f_amount=0;
					foreach($exist as $item){					
						if($orig_amount > 0){						
								if($item['amount'] > $orig_amount){
									$result=$this->db->query("INSERT INTO gl_posting(gl_id,gl_company,amount,patientidno,datearray,refno,gl_type,status) VALUES('$item[gl_id]','$company','-$orig_amount','$patientidno','$datearray','$refno','credit','$caseno')");								
									$f_amount +=$orig_amount;
									$orig_amount=0;			
								}else{
									$new_amount=$orig_amount-$item['amount'];
									$result=$this->db->query("INSERT INTO gl_posting(gl_id,gl_company,amount,patientidno,datearray,refno,gl_type,status) VALUES('$item[gl_id]','$company','-$item[amount]','$patientidno','$datearray','$refno','credit','$caseno')");								
									$f_amount =$item['amount'];
									$orig_amount=$new_amount;								
								}

						}
					}				
					//$f_amount=$amount-$f_amount;
					$result=$this->db->query("INSERT INTO collection(refno,acctno,acctname,ofr,description,accttitle,amount,discount,`date`,Dept,username,shift,type,paymentTime,paidBy,datearray,branch,batchno) VALUES('$refno','$caseno','$patientname','','HOSPITAL BILL','AR $company','$f_amount','0','$date','out','$user','','pending','','','$datearray','KMSCI','')");
					if($result){
						$result=$this->db->query("INSERT INTO acctgenledge(refno,acctitle,transaction,amount,`date`,caseno,status) VALUES('$refno','AR $company','credit','$f_amount','$date','$caseno','pending')");
						if($result){
							return true;
						}else{
							$this->db->query("DELETE FROM gl_posting WHERE refno='$refno'");
							$this->db->query("DELETE FROM collection WHERE refno='$refno'");
							return false;
						}
					}else{
						$this->db->query("DELETE FROM gl_posting WHERE refno='$refno'");
						return false;
					}
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}

	public function remove_gl_posting($refno){
		$this->db->query("DELETE FROM acctgenledge WHERE refno='$refno'");
		$this->db->query("DELETE FROM collection WHERE refno='$refno'");
		$this->db->query("DELETE FROM gl_posting WHERE refno='$refno'");
		return true;
	}
	public function patient_discharged(){
		$caseno=$this->input->post('caseno');
		$patient=$this->db->query("SELECT pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno='$caseno'");
		$prof=$patient->row_array();
		$patientname=$prof['lastname']." ".$prof['firstname']." ".$prof['middlename']." ".$prof['suffix'];
		$datearray=$this->input->post('datedischarged');
		$timearray=$this->input->post('timedischarged');
		$date=date('M-d-Y',strtotime($datearray));
		$check=$this->db->query("SELECT * FROM dischargedtable WHERE caseno='$caseno'");
		if($check->num_rows()>0){
			$result=$this->db->query("UPDATE dischargedtable SET datedischarged='$date',timedischarged='$timearray',datearray='$datearray' WHERE caseno='$caseno'");
		}else{
			$result=$this->db->query("INSERT INTO dischargedtable(caseno,patientname,datedischarged,timedischarged,dept,datearray,count,branch) VALUES('$caseno','$patientname','$date','$timearray','rdu','$datearray','9','KMSCI')");
		}		
		if($result){
			$this->db->query("UPDATE admission SET status='discharged', ward='discharged' WHERE caseno='$caseno'");
			return true;
		}else{
			return false;
		}

	}
	public function getPatientCharges($caseno){
		$result=$this->db->query("SELECT SUM(phic) as phic,SUM(excess) as excess FROM productout WHERE caseno='$caseno' AND productsubtype <> 'PROFESSIONAL FEE' AND trantype='charge'");
		return $result->row_array();
	}
	public function getPatient($caseno){
        $result=$this->db->query("SELECT pp.*,a.* FROM admission pp INNER JOIN patientprofile a ON a.patientidno=pp.patientidno WHERE pp.caseno='$caseno'");
        return $result->row_array();
    }
    public function getAllOxygenUsed(){
    	$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$result=$this->db->query("SELECT SUM(po.quantity) as per_liter,po.*,pp.lastname,pp.firstname,pp.middlename,a.dateadmit FROM productout po INNER JOIN admission a ON a.caseno=po.caseno INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno LIKE 'R-%' AND po.productsubtype='OXYGEN SUPPLIES' AND po.productdesc='OXYGEN PER LITER' AND a.dateadmit BETWEEN '$startdate' AND '$enddate' GROUP BY po.caseno ORDER BY a.dateadmit ASC");
		return $result->result_array();
    }
}
