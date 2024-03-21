<?php
date_default_timezone_set('Asia/Manila');
class Cashier_model extends CI_model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getAllCollectionMeds(){
		$rundate=$this->input->post('startdate');
		$enddate=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));
		$startdate=date('Y-m-d',strtotime('-1 day',strtotime($enddate)));		
		$orstart=$this->input->post('orstart');
		$orend=$this->input->post('orend');
		$orstart1=$this->input->post('orstart1');
		$orend1=$this->input->post('orend1');

		$result=$this->db->query("SELECT acctno,acctname,ofr,description,accttitle,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount FROM collection WHERE (accttitle LIKE '%PHARMACY/MEDICINE%' OR accttitle = 'CANCELLED') AND ((datearray = '$startdate' AND paymentTime > '23:00:00') OR (datearray = '$enddate' AND paymentTime <= '23:00:00'))  AND ((ofr BETWEEN '$orstart' AND '$orend') OR (ofr BETWEEN '$orstart1' AND '$orend1')) GROUP BY ofr ORDER BY ofr ASC");
		return $result->result_array();
	}

	public function getAllAccountTitle(){
		$result=$this->db->query("SELECT * FROM accounttitle WHERE accounttitle NOT LIKE 'OTHER FEES' ORDER BY accounttitle ASC");
		return $result->result_array();		
	}
	public function getAllSubAccountTitle($accttitle){
		$result=$this->db->query("SELECT subaccounttitle FROM subaccounttitle WHERE accounttitle='$accttitle'");
		return $result->result_array();
	}
	public function getAllCollectionType($accttitle,$startdate,$enddate,$orstart,$orend,$orstart1,$orend1){
		if($accttitle=="BIOPSY INCOME"){
			$result=$this->db->query("SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount FROM collection WHERE (accttitle LIKE '%LABORATORY%' AND description LIKE '%BIOPSY%') AND ((datearray = '$startdate' AND paymentTime >= '23:00:00')  OR (datearray = '$enddate' AND paymentTime < '23:00:00')) AND (ofr BETWEEN '$orstart' AND '$orend' OR ofr BETWEEN '$orstart1' AND '$orend1') AND `type` NOT LIKE '%pending%' GROUP BY description,accttitle,ofr ORDER BY ofr ASC");								
		}elseif($accttitle=="LABORATORY"){
			$result=$this->db->query("SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount FROM collection WHERE (accttitle LIKE '%$subaccttitle%' AND (description NOT LIKE '%BIOPSY%' AND description NOT LIKE '%RAPID TEST%' AND description NOT LIKE '%RT PCR%' AND description NOT LIKE '%RT-PCR%')) AND ((datearray = '$startdate' AND paymentTime >= '23:00:00')  OR (datearray = '$enddate' AND paymentTime < '23:00:00')) AND (ofr BETWEEN '$orstart' AND '$orend' OR ofr BETWEEN '$orstart1' AND '$orend1') AND `type` NOT LIKE '%pending%' GROUP BY description,accttitle,ofr ORDER BY ofr ASC");
		}elseif($accttitle=="RAPID TEST"){
			$result=$this->db->query("SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount FROM collection WHERE (accttitle LIKE '%LABORATORY%' AND description LIKE '%RAPID TEST%') AND ((datearray = '$startdate' AND paymentTime >= '23:00:00')  OR (datearray = '$enddate' AND paymentTime < '23:00:00')) AND (ofr BETWEEN '$orstart' AND '$orend' OR ofr BETWEEN '$orstart1' AND '$orend1') AND `type` NOT LIKE '%pending%' GROUP BY description,accttitle,ofr ORDER BY ofr ASC");		
		}elseif($accttitle=="RT PCR"){
			$result=$this->db->query("SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount FROM collection WHERE ((accttitle LIKE '%LABORATORY%' OR accttitle LIKE '%MISCELLANEOUS%') AND (description LIKE '%RT-PCR%' OR description LIKE '%TRANSPORTATION AND SUPPLIES%')) AND ((datearray = '$startdate' AND paymentTime >= '23:00:00')  OR (datearray = '$enddate' AND paymentTime < '23:00:00')) AND (ofr BETWEEN '$orstart' AND '$orend' OR ofr BETWEEN '$orstart1' AND '$orend1') AND `type` NOT LIKE '%pending%' GROUP BY description,accttitle,ofr ORDER BY ofr ASC");		
		}elseif($accttitle=="RESPIRATORY SUPPLIES"){
			$result=$this->db->query("SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount FROM collection WHERE (accttitle LIKE '%PHARMACY/SUPPLIES%' AND description LIKE '%NEBULE%') AND ((datearray = '$startdate' AND paymentTime >= '23:00:00')  OR (datearray = '$enddate' AND paymentTime < '23:00:00')) AND (ofr BETWEEN '$orstart' AND '$orend' OR ofr BETWEEN '$orstart1' AND '$orend1') AND `type` NOT LIKE '%pending%' GROUP BY description,accttitle,ofr ORDER BY ofr ASC");															
		}elseif($accttitle=="MEDICAL SUPPLIES"){
			$result=$this->db->query("SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount FROM collection WHERE accttitle LIKE '%$subaccttitle%' AND (description NOT LIKE '%NEBULE%' AND description NOT LIKE '%TRANSPORTATION%') AND ((datearray = '$startdate' AND paymentTime >= '23:00:00')  OR (datearray = '$enddate' AND paymentTime < '23:00:00')) AND (ofr BETWEEN '$orstart' AND '$orend' OR ofr BETWEEN '$orstart1' AND '$orend1') AND `type` NOT LIKE '%pending%' GROUP BY description,accttitle,ofr ORDER BY ofr ASC");		
		}else{
			$result=$this->db->query("SELECT acctname,ofr,description,`date`,Dept,paymentTime,SUM(amount) AS amount,SUM(discount) AS discount FROM collection WHERE accttitle LIKE '%$subaccttitle%' AND ((datearray = '$startdate' AND paymentTime >= '23:00:00')  OR (datearray = '$enddate' AND paymentTime < '23:00:00')) AND (ofr BETWEEN '$orstart' AND '$orend' OR ofr BETWEEN '$orstart1' AND '$orend1') AND `type` NOT LIKE '%pending%' GROUP BY description,accttitle,ofr ORDER BY ofr ASC");
		}
		return $result->result_array();
	}

	public function getARTradePatient($description){
		$result=$this->db->query("SELECT *,SUM(amount) as amount FROM collection WHERE acctname LIKE '%$description%' AND `type` = 'pending' AND (accttitle LIKE '%AR TRADE%' OR accttitle LIKE '%AR EMPLOYEE%' OR accttitle LIKE '%AR PERSONAL%' OR accttitle LIKE '%AR DOCTOR%') AND acctno NOT LIKE '%x%' GROUP BY acctno ORDER BY acctname ASC");
		return $result->result_array();
	}
	public function getARTradePatientDetails($caseno){
		$result=$this->db->query("SELECT c.*,a.street,a.barangay,a.municipality as city,a.province FROM collection c INNER JOIN admission a ON a.caseno=c.acctno WHERE c.acctno = '$caseno' AND (c.accttitle LIKE '%AR TRADE%' OR c.accttitle LIKE '%AR EMPLOYEE%' OR c.accttitle LIKE '%AR PERSONAL%' OR c.accttitle LIKE '%AR DOCTOR%')");
		return $result->result_array();
	}
	public function getAllGuarantor($caseno){
		$result=$this->db->query("SELECT * FROM pfdiscount WHERE caseno='$caseno'");
		return $result->result_array();
	}
	public function getConfinement($caseno){
		$result=$this->db->query("SELECT a.dateadmit,d.datearray,c.shift FROM admission a LEFT JOIN dischargedtable d ON d.caseno=a.caseno RIGHT JOIN collection c ON c.acctno=a.caseno WHERE a.caseno='$caseno' AND c.accttitle LIKE 'AR %'");
		return $result->row_array();
	}
	public function getPatientDeposit($caseno,$datearray){
		$result=$this->db->query("SELECT * FROM collection WHERE acctno='$caseno' AND accttitle LIKE '%DEPOSIT%' AND datearray='$datearray'");
		return $result->result_array();
	}
	public function getPatientDepositBegin($caseno,$startdate,$enddate){
		$result=$this->db->query("SELECT * FROM collection WHERE acctno='$caseno' AND accttitle LIKE '%DEPOSIT%' AND datearray BETWEEN '$startdate' AND '$enddate'");
		return $result->result_array();
	}
	public function getRefundPatient($description){
		$result=$this->db->query("SELECT a.caseno,a.dateadmit,pp.lastname,pp.firstname,pp.middlename,pp.suffix FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE CONCAT(pp.lastname,' ',pp.firstname) LIKE '%%$description%%' AND a.status <> 'discharged' AND a.result <> 'FINAL' AND (a.caseno LIKE '%I-%' OR (a.caseno LIKE '%O-%' AND (a.employerno LIKE '%M%' OR a.employerno LIKE '%E%')))");
		return $result->result_array();
	}
	public function getRefundPatientDetails($caseno){
		$result=$this->db->query("SELECT * FROM collection WHERE acctno='$caseno' AND refno LIKE '%RF%'");
		return $result->result_array();
	}
	public function save_refund(){
		$caseno=$this->input->post('caseno');
		$patientname=$this->input->post('patientname');
		$amount=$this->input->post('amount');
		$date=date('M-d-Y');
		$datearray=date('Y-m-d');
		$user=$this->session->fullname;
		if($amount > 0){
			$refno=$this->General_model->generateRefNo('RF',$this->session->fullname);
			$result=$this->db->query("INSERT INTO collection(refno,acctno,acctname,ofr,description,accttitle,amount,discount,`date`,Dept,username,shift,`type`,paymentTime,paidBy,datearray,branch,batchno) VALUES('$refno','$caseno','$patientname','','HOSPITAL BILL','AP PATIENT DEPOSIT','$amount','0','$date','in','$user','','pending','','','$datearray','KMSCI','')");
			if($result){
				$result=$this->db->query("INSERT INTO acctgenledge(refno,acctitle,transaction,amount,`date`,caseno,status) VALUES('$refno','AP PATIENT DEPOSIT','credit','$amount','$date','$caseno','pending')");
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
			return false;
		}
	}
	public function remove_refund($refno){
		$result=$this->db->query("DELETE FROM collection WHERE refno='$refno'");
		if($result){
			$this->db->query("DELETE FROM acctgenledge WHERE refno='$refno'");
			return true;
		}else{
			return false;
		}
	}
}
