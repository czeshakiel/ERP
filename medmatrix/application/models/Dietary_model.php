<?php
date_default_timezone_set('Asia/Manila');
class Dietary_model extends CI_model
{
	public function __construct()
	{
		$this->load->database();
	}
	public function getSingleDiet($caseno){
		$result=$this->db->query("SELECT d.`description` FROM diet d INNER JOIN dietlist dl ON dl.code=d.COD INNER JOIN admission a ON a.caseno=dl.caseno WHERE a.caseno='$caseno' ORDER BY dl.autono DESC LIMIT 1");
		return $result->row_array();
	}
	public function getSinglePatientAdmission($caseno){
		$result=$this->db->query("SELECT pp.*,a.*,d.name FROM admission a LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno LEFT JOIN docfile d ON d.code=a.ap WHERE a.caseno='$caseno'");
		return $result->row_array();
	}
	public function getAllPatientDiet($caseno){
		$result=$this->db->query("SELECT d.`description`,dl.date,dl.time FROM diet d INNER JOIN dietlist dl ON dl.code=d.COD INNER JOIN admission a ON a.caseno=dl.caseno WHERE a.caseno='$caseno' ORDER BY dl.autono DESC");
		return $result->result_array();
	}
	public function getAllDiet(){
		$result=$this->db->query("SELECT * FROM diet ORDER BY `description` ASC");
		return $result->result_array();
	}
	public function add_diet(){
		$caseno=$this->input->post('caseno');
		$room=$this->input->post('room');
		$user=$this->input->post('user');
		$diet=$this->input->post('diet');
		$reason=$this->input->post('reason');
		$date=date('Y-m-d');
		$time=date('H:i:s');
		$result=$this->db->query("INSERT INTO dietlist(`caseno`,`code`,`remarks`,`status`,`empid`,`date`,`time`,`room`) VALUES('$caseno','$diet','$reason','','$user','$date','$time','$room')");
		if($result){
			$this->db->query("UPDATE admission SET diet='$diet' WHERE caseno='$caseno'");
			return true;
		}else{
			return false;
		}
	}
	public function getSingleAdmissionDiet($caseno){
		$result=$this->db->query("SELECT CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename,' ',pp.suffix) as patientname, pp.age,a.diet,a.room,a.religion,dl.remarks,d.description FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN dietlist dl ON dl.caseno=a.caseno INNER JOIN diet d ON d.COD=dl.code WHERE a.caseno='$caseno' ORDER BY dl.autono DESC");
		return $result->row_array();
	}
	public function getAllStation(){
		$result=$this->db->query("SELECT * FROM room WHERE nursestation <> '' GROUP BY nursestation ORDER BY autono ASC");
		return $result->result_array();
	}

	public function getAllAdmissionDiet(){
		$station=$this->input->post('station');
		$result=$this->db->query("SELECT CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename,' ',pp.suffix) as patientname, pp.age,a.diet,a.room,a.religion,a.caseno FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN room r ON r.room=a.room WHERE  a.ward = 'in' AND r.nursestation='$station' AND a.status NOT LIKE '%MGH%' ORDER BY pp.lastname");
		return $result->result_array();
	}
	public function getAllInpatient(){
		$result=$this->db->query("SELECT a.caseno,a.dateadmitted,a.timeadmitted,a.room,pp.patientname,a.religion,a.room FROM admission a JOIN patientprofile pp ON pp.patientidno=a.patientidno JOIN room r ON r.room=a.room WHERE a.ward='in' AND a.status NOT LIKE '%MGH%' GROUP BY a.caseno ORDER BY pp.lastname ASC");
		return $result->result_array();
	}
	public function checkDiet($caseno){
		$result=$this->db->query("SELECT * FROM dietary WHERE caseno='$caseno'");
		return $result->row_array();
	}
	public function getAllPatientByStation(){
		$station=$this->session->station;
		$result=$this->db->query("SELECT a.caseno,a.dateadmitted,a.timeadmitted,a.room,pp.patientname,a.religion FROM admission a JOIN patientprofile pp ON pp.patientidno=a.patientidno JOIN room r ON r.room=a.room WHERE a.ward='in' AND r.nursestation='$station' AND a.status NOT LIKE '%MGH%' GROUP BY a.caseno ORDER BY pp.lastname ASC");
		return $result->result_array();
	}
	public function getAllInPatientByStation(){
		$station=$this->input->post('station');
		$result=$this->db->query("SELECT a.caseno,a.dateadmitted,a.timeadmitted,a.room,pp.patientname,a.religion FROM admission a JOIN patientprofile pp ON pp.patientidno=a.patientidno JOIN room r ON r.room=a.room WHERE a.ward='in' AND r.nursestation='$station' AND a.status NOT LIKE '%MGH%' GROUP BY a.caseno ORDER BY r.roomprop ASC,r.room ASC");
		return $result->result_array();
	}
	public function meal_served(){
		$caseno=$this->input->post('caseno');
		$meal=$this->input->post('meal_type');
		if(count($caseno)>0){
			foreach($caseno AS $case){
				$check=$this->db->query("SELECT * FROM dietary WHERE caseno='$case'");
				if($check->num_rows()>0){
					$result=$this->db->query("UPDATE dietary SET $meal='1' WHERE caseno='$case'");
				}else{
					if($meal=="breakfast"){
						$result=$this->db->query("INSERT INTO dietary(caseno,breakfast,lunch,dinner) VALUE('$case','1','0','0')");
					}
					if($meal=="lunch"){
						$result=$this->db->query("INSERT INTO dietary(caseno,breakfast,lunch,dinner) VALUE('$case','0','1','0')");
					}
					if($meal=="dinner"){
						$result=$this->db->query("INSERT INTO dietary(caseno,breakfast,lunch,dinner) VALUE('$case','0','0','1')");
					}
				}
			}
			if($result){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function getAllPatientMasterlist(){
		$station=$this->input->post('station');
		$result=$this->db->query("SELECT a.caseno,a.room,pp.patientname,pp.age,a.initialdiagnosis,a.religion,a.diet FROM admission a JOIN patientprofile pp ON pp.patientidno=a.patientidno JOIN room r ON r.room=a.room WHERE a.ward='in' AND r.nursestation='$station' AND a.status NOT LIKE '%MGH' GROUP BY a.caseno ORDER BY r.roomprop ASC,r.room ASC");
		return $result->result_array();
	}
	public function add_charge_item(){
		$caseno=$this->input->post('caseno');
		$itemid=$this->input->post('item');
		$quantity=$this->input->post('quantity');
		$st=$this->session->dept;
		$qry=$this->db->query("SELECT * FROM receiving WHERE code='$itemid'");
		$item=$qry->row_array();
		$batchno=$st."-".date('YmdHis');
		$datearray=date('Y-m-d');
		$datenow=date('M-d-Y');
		$timenow=date('H:i:s');
		$refno=date('YmdHis');
		$gross=$quantity*$item['sellingprice'];
		$nursename=$this->session->fullname;
		$insert=$this->db->query("INSERT INTO productout(refno,invno,caseno,productcode,productdesc,sellingprice,quantity,adjustment,gross,trantype,phic,hmo,excess,`date`,`status`,terminalname,loginuser,batchno,producttype,productsubtype,approvalno,referenceno,administration,shift,location,datearray,phic1) VALUES('$refno','$timenow','$caseno','$itemid','$item[itemname]','$item[sellingprice]','$quantity','0','$gross','charge','0','0','$gross','$datenow','Approved','','$nuresname','$batchno','','$item[unit]','','','','','$st','$datearray','0')");
		if($insert){
			return true;
		}else{
			return false;
		}
	}
	public function delete_charged_item($refno){
		$result=$this->db->query("DELETE FROM productout WHERE refno='$refno'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
}
?>
