<?php
	class Pages extends CI_Controller{
		public function __construct()
		  {
		    parent::__construct();
		    $this->load->library('session');
		  }
		public function view(){
            	$page="login";
				if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
					$page="error404";
	            }
				if($this->session->user_login){
					redirect(base_url()."main");
				}
            	$this->load->view('pages/'.$page);
		}
		public function request_login(){
            	$page="login_request";
				if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
					$page="error404";
	            }
				if($this->session->user_login){
					redirect(base_url()."main");
				}
            	$this->load->view('pages/'.$page);
		}
		public function checklogin(){
			$username=$this->input->post("username");
			$password=$this->input->post("password");
			$dept=$this->input->post("dept");
			$data=$this->General_model->login($username,$password,$dept);
			echo json_encode($data);
		}
		public function authenticate(){
			$userdata=$this->General_model->authenticate();
			if($userdata){
				$user_data = array(
					'username' => $userdata['username'],
					'dept' => $userdata['station'],
					'fullname' => $userdata['name'],
					'user_login' => true
				);
				$this->session->set_userdata($user_data);
				//echo "<script>window.location='".base_url()."main';</script>";
				redirect(base_url()."main");
			}else{
				$this->session->set_flashdata('invalid','Invalid username and password!');
				redirect('http://192.168.0.100:100/ERP');
			}
        }
        public function main(){
            if($this->session->user_login){
				if($this->session->dept=="ADMISSION"){
					$page="main";
					if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
						$page="error404";
						$this->load->view('pages/'.$page);
					}else{
						$datenow=date('Y-m-d');
						$data['header']=$this->General_model->getInfo();
						// $data['inpatient'] = $this->General_model->getAllInpatient();
						// $data['mgh'] = $this->General_model->getAllInpatientByStatus('MGH');
						// $data['newadmit'] = $this->General_model->getAllInpatientByDate($datenow);
						// $data['vacantroom'] = $this->General_model->getAllRoomsByStatus('vacant');
						$data['inpatient'] = array();
						$data['mgh'] = array();
						$data['newadmit'] = array();
						$data['vacantroom'] = array();
						$data['department'] = $this->session->dept;
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalAdmission');
					}
				}
				else if($this->session->dept=="ER"){
					$page="main";
					if(!file_exists(APPPATH.'views/pages/emergency/'.$page.".php")){
						$page="error404";
						$this->load->view('pages/'.$page);
					}else{
						$datenow=date('Y-m-d');
						$data['header']=$this->General_model->getInfo();
						// $data['inpatient'] = $this->General_model->getAllInpatient();
						// $data['mgh'] = $this->General_model->getAllInpatientByStatus('MGH');
						// $data['newadmit'] = $this->General_model->getAllInpatientByDate($datenow);
						// $data['vacantroom'] = $this->General_model->getAllRoomsByStatus('vacant');
						$data['inpatient'] = array();
						$data['mgh'] = array();
						$data['newadmit'] = array();
						$data['vacantroom'] = array();
						$data['department'] = $this->session->dept;
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/emergency/'.$page,$data);
						$this->load->view('templates/modalER');
					}
				}
				else if($this->session->dept=="OPD" || $this->session->dept=="ONCOLOGY" || $this->session->dept=="KONSULTA"){
					$page="main";
					if(!file_exists(APPPATH.'views/pages/outpatient/'.$page.".php")){
						$page="error404";
						$this->load->view('pages/'.$page);
					}else{
						$datenow=date('Y-m-d');
						$data['header']=$this->General_model->getInfo();
						// $data['outpatient'] = $this->General_model->getAllOutPatientByDate($datenow);
						// $data['walkin'] = $this->General_model->getAllWalkinPatientByDate($datenow);
						// $data['laboratory'] = $this->General_model->getAllLaboratoryByDate($datenow);
						// $data['diagnostics'] = $this->General_model->getAllDiagnosticsByDate($datenow);
						$data['outpatient'] = array();
						$data['walkin'] = array();
						$data['laboratory'] = array();
						$data['diagnostics'] = array();
						$data['department'] = $this->session->dept;
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/outpatient/'.$page,$data);
						$this->load->view('templates/modalER');
					}
				}
				else if($this->session->dept=="Masterfile"){
					$page="main";
					if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
						$page="error404";
						$this->load->view('pages/'.$page);
					}else{
						$datenow=date('Y-m-d');
						$data['header']=$this->General_model->getInfo();
						$data['employees'] = $this->Masterfile_model->getAllEmployees();
						$data['rooms'] = $this->General_model->getAllRooms();
						$data['doctors'] = $this->Masterfile_model->getAllDoctors();
						$data['hmo'] = $this->General_model->getCompany();
						$data['department'] = $this->session->dept;
						$this->load->view('templates/headerMasterfile',$data);
						$this->load->view('pages/masterfile/'.$page,$data);
						$this->load->view('templates/modalMasterfile');
					}
				}
				else if($this->session->dept=="CPU" || $this->session->dept=="CSR" || $this->session->dept=="CPU-RDU"){
					$page="main";
					if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
						$page="error404";
						$this->load->view('pages/'.$page);
					}else{
						$datenow=date('Y-m-d');
						$data['header']=$this->General_model->getInfo();
						$data['medicine'] = $this->Purchase_model->getAllMedicine();
						$data['supplies'] = $this->Purchase_model->getAllSupplies();
						$data['diagnostics'] = $this->Purchase_model->getAllDiagnostics();
						$data['suppliers'] = $this->Purchase_model->getAllSuppliers();
						$data['items'] = $this->Purchase_model->getAllReOrderLevel();
						// $data['medicine'] = array();
						// $data['supplies'] = array();
						// $data['diagnostics'] = array();
						// $data['suppliers'] = array();
						$data['department'] = $this->session->dept;
						$this->session->unset_userdata('user_name');
						$this->load->view('templates/headerSCM',$data);
						$this->load->view('pages/supplychain/'.$page,$data);
						$this->load->view('templates/modalSCM');
					}
				}
				else if($this->session->dept=="MEDICAL RECORDS"){
					$page="main";
					if(!file_exists(APPPATH.'views/pages/medicalrecords/'.$page.".php")){
						$page="error404";
						$this->load->view('pages/'.$page);
					}else{
						$datenow=date('Y-m-d');
						$data['header']=$this->General_model->getInfo();
						$data['walkinpatient'] = array();
						//$data['patient'] = $this->Records_model->getAllPatient();
						$data['patient'] =array();
						// $data['inpatient'] = $this->General_model->getAllInpatient();
						// $data['outpatient'] = $this->Records_model->getAllOutPatient();
						$data['inpatient'] = array();
						$data['outpatient'] = array();
						//$data['walkinpatient']="";
						$data['department'] = $this->session->dept;
						$this->load->view('templates/headerMRD',$data);
						$this->load->view('pages/medicalrecords/'.$page,$data);
						$this->load->view('templates/modalMRD');
					}
				}
				else if($this->session->dept=="DIETARY"){
					$page="main";
					if(!file_exists(APPPATH.'views/pages/dietary/'.$page.".php")){
						$page="error404";
						$this->load->view('pages/'.$page);
					}else{
						$datenow=date('Y-m-d');
						$data['header']=$this->General_model->getInfo();
						// $data['employees'] = $this->General_model->getAllInpatient();
						// $data['rooms'] = $this->General_model->getAllInpatientByStatus('MGH');
						// $data['doctors'] = $this->General_model->getAllInpatientByStatus('WARNING');
						// $data['hmo'] = $this->General_model->getAllInpatientByStatus('LOCKED');
						$data['employees'] = array();
						$data['rooms'] = array();
						$data['doctors'] = array();
						$data['hmo'] = array();
						$data['department'] = $this->session->dept;
						$this->load->view('templates/headerDietary',$data);
						$this->load->view('pages/dietary/'.$page,$data);
						$this->load->view('templates/modalDietary');
					}
				}
				else if($this->session->dept=="RDU"){
				$page="main";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$datenow=date('Y-m-d');
					$data['header']=$this->General_model->getInfo();
					// $data['inpatient'] = $this->Dialysis_model->getAllRDUPatient();
					// $data['mgh'] = $this->Dialysis_model->getAllRDUpatientByStatus('MGH');
					// $data['newadmit'] = $this->Dialysis_model->getAllRDUpatientByDate($datenow);
					// $data['vacantroom'] = $this->Dialysis_model->getAllRDUpatientByStatus('discharged');
					$data['inpatient'] = array();
					$data['mgh'] = array();
					$data['newadmit'] = array();
					$data['vacantroom'] = array();
					$data['department'] = $this->session->dept;
					$this->load->view('templates/headerDialysis',$data);
					$this->load->view('pages/dialysis/'.$page,$data);
					$this->load->view('templates/modalRDU');
				}
			}else if($this->session->dept=="HMO"){
				$page="main";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$datenow=date('Y-m-d');
					$data['header']=$this->General_model->getInfo();
					// $data['inpatient'] = $this->General_model->getAllInpatient();
					// $data['mgh'] = $this->General_model->getAllInpatientByStatus('MGH');
					// $data['newadmit'] = $this->General_model->getAllInpatientByDate($datenow);
					// $data['vacantroom'] = $this->General_model->getAllRoomsByStatus('vacant');
					$data['inpatient'] = array();
					$data['mgh'] = array();
					$data['newadmit'] = array();
					$data['vacantroom'] = array();
					$data['department'] = $this->session->dept;
					$this->load->view('templates/headerHMO',$data);
					$this->load->view('pages/hmo/'.$page,$data);
					$this->load->view('templates/modalHMO');
				}
			}else{
				$page="main";
				//$page="error404";
				if(!file_exists(APPPATH.'views/pages/access/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
						$data['header']=$this->General_model->getInfo();
						$data['inpatient'] = array();
						$data['mgh'] = array();
						$data['newadmit'] = array();
						$data['vacantroom'] = array();
						$data['department'] = $this->session->dept;
						$this->load->view('templates/headerOther',$data);
						$this->load->view('pages/access/'.$page,$data);
						$this->load->view('templates/modalOther');
					}
				//redirect(base_url()."stock_request");
			}
				$this->load->view('templates/footer');
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }

		}
		public function logout(){
			$this->session->unset_userdata('user_login');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('dept');
			unset($_SESSION['user_login']);
			//if($this->session->user_login){
				redirect('http://192.168.0.100:100/ERP');
			// }else{
			// 	redirect(base_url()."main");
			// }
		}
		public function return_dept($dept1){
			if(strpos($dept1,'NS') !== false){
				$dept1="nsstation";
			}
			else if(strpos($dept1,'CASHIER') !== false){
				$dept1="cashier";
			}
			else if(strpos($dept1,'PHARMACY') !== false){
				$dept1="pharmacy";
			}
			else if(strpos($dept1,'BILLING') !== false){
				$dept1="billing";
			}
			else if(strpos($dept1,'ACCOUNTING') !== false){
				$dept1="accounting";
			}
			else if($dept1="PT" || $dept1=="RT" || $dept1=="OR"){
				$dept1="specialservices";
			}


			$this->session->unset_userdata('user_login');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('dept');
			redirect('../../'.mb_strtolower($dept1).'/?main&');
		}
		//==============Start of Admitting Module===================================
		public function admission(){
			if($this->session->user_login){
				$page="admission";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Admission";
					$data['inpatient'] = $this->General_model->getAllPatient();
					//$data['inpatient'] = array();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="ADMISSION"){
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalAdmission',$data);
					}
					if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY" || $dept=="KONSULTA"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					if($dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalRDU',$data);
					}
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalHMO',$data);
					}
					$this->load->view('templates/footer');
					}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_admission(){
			if($this->session->user_login){
				$page="admission";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$searchme=$this->input->post('searchme');
					$data['header']=$this->General_model->getInfo();
					$data['title']="Admission";
					$data['inpatient'] = $this->Admission_model->getSelectedPatient($searchme);
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="ADMISSION"){
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalAdmission',$data);
					}
					if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY" || $dept=="KONSULTA"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					if($dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalRDU',$data);
					}
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalHMO',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function getCity(){
			$id=$this->input->post('id');
			$data=$this->General_model->getCity($id);
			echo json_encode($data);
		}
		public function getBarangay(){
			$id=$this->input->post('id');
			$data=$this->General_model->getBarangay($id);
			echo json_encode($data);
		}
		public function getZipCode(){
			$id=$this->input->post('id');
			$data=$this->General_model->getZipCode($id);
			echo json_encode($data);
		}
		public function fetch_previous_admission(){
			$id=$this->input->post('id');
			$data=$this->Admission_model->fetch_previous_admission($id);
			echo json_encode($data);
		}

		public function ipdadmission(){
			if($this->session->user_login){
				$page="ipdadmission";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="In-Patient Admission";
					$data['nationality'] = $this->General_model->getNationality();
					$data['religion'] = $this->General_model->getReligion();
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['admitting'] = $this->General_model->getAdmittingDoctor();
					$data['room'] = $this->General_model->getAllRoomsByStatus('vacant');
					$data['company'] = $this->General_model->getCompany();
					$data['province'] = $this->General_model->getState();
					$rod=$this->General_model->getResidentDuty();
					$data['rod']=$rod['name'];
					$data['rodcode']=$rod['code'];
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="ADMISSION"){
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalAdmission',$data);
					}
					if($dept=="ER"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}

		public function rduadmission(){
			if($this->session->user_login){
				$page="rduadmission";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Dialysis Patient Admission";
					$data['nationality'] = $this->General_model->getNationality();
					$data['religion'] = $this->General_model->getReligion();
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['admitting'] = $this->General_model->getAdmittingDoctor();
					$data['room'] = $this->General_model->getAllRoomsByStatus('vacant');
					$data['company'] = $this->General_model->getCompany();
					$data['province'] = $this->General_model->getState();
					$rod=$this->General_model->getResidentDuty();
					$data['rod']=$rod['name'];
					$data['rodcode']=$rod['code'];
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDialysis',$data);
					$this->load->view('pages/dialysis/'.$page,$data);
					$this->load->view('templates/modalRDU',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function ipdreadmission(){
			if($this->session->user_login){
				$page="ipdreadmission";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="In-Patient Admission";
					$patientidno=$this->input->post('patientidno');
					$data['patientidno'] = $patientidno;
					$data['inpatient'] = $this->Admission_model->fetch_previous_admission($patientidno);
					$data['nationality'] = $this->General_model->getNationality();
					$data['religion'] = $this->General_model->getReligion();
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['admitting'] = $this->General_model->getAdmittingDoctor();
					$data['room'] = $this->General_model->getAllRoomsByStatus('vacant');
					$data['company'] = $this->General_model->getCompany();
					$data['province'] = $this->General_model->getState();
					$rod=$this->General_model->getResidentDuty();
					$data['rod']=$rod['name'];
					$data['rodcode']=$rod['code'];
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="ADMISSION"){
						$this->load->view('templates/headerAdmission',$data);
					}
					if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY"){
						$this->load->view('templates/headerER',$data);
					}
					$this->load->view('pages/admission/'.$page,$data);
					$this->load->view('templates/modalAdmission',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function rdureadmission(){
			if($this->session->user_login){
				$page="rdureadmission";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Dialysis Patient Admission";
					$patientidno=$this->input->post('patientidno');
					$data['patientidno'] = $patientidno;
					$data['inpatient'] = $this->Admission_model->fetch_previous_admission($patientidno);
					$data['nationality'] = $this->General_model->getNationality();
					$data['religion'] = $this->General_model->getReligion();
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['admitting'] = $this->General_model->getAdmittingDoctor();
					$data['room'] = $this->General_model->getAllRoomsByStatus('vacant');
					$data['company'] = $this->General_model->getCompany();
					$data['province'] = $this->General_model->getState();
					$rod=$this->General_model->getResidentDuty();
					$data['rod']=$rod['name'];
					$data['rodcode']=$rod['code'];
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDialysis',$data);
					$this->load->view('pages/dialysis/'.$page,$data);
					$this->load->view('templates/modalRDU');
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}

		public function aradmission(){
			if($this->session->user_login){
				$page="aradmission";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="AR Patient Admission";
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['admitting'] = $this->General_model->getAdmittingDoctor();
					$data['company'] = $this->General_model->getCompany();
					$data['accttitles'] = $this->General_model->getAccountTitleAR();
					$data['employees'] = $this->General_model->getEmployeeDetails();
					$data['province'] = $this->General_model->getState();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="ADMISSION"){
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalAdmission');
					}
					if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY" || $dept=="KONSULTA"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalER');
					}
					if($dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalRDU');
					}
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalHMO');
					}

					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}

		public function arreadmission(){
			if($this->session->user_login){
				$page="arreadmission";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="AR Patient Admission";
					$patientidno=$this->input->post('patientidno');
					$artype=$this->input->post('artype');
					$data['patientidno'] = $patientidno;
					$data['artype'] = $artype;
					$data['inpatient'] = $this->Admission_model->fetch_previous_admission($patientidno);
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['admitting'] = $this->General_model->getAdmittingDoctor();
					$data['company'] = $this->General_model->getCompany();
					$data['accttitles'] = $this->General_model->getAccountTitleAR();
					$data['employees'] = $this->General_model->getEmployeeDetails();
					$data['province'] = $this->General_model->getState();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="ADMISSION"){
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalAdmission');
					}
					if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY" || $dept=="KONSULTA"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalER');
					}
					if($dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalRDU');
					}
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalHMO');
					}

					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}

		public function submitadmission(){
			$dept=$this->session->dept;
			$password=$this->input->post('password');
			$admittype=$this->input->post('admissiontype');
			$patientidno=$this->input->post('patientidno');
			$check=$this->General_model->checkUser($password,$dept);
			$username=$this->session->username;
			$nursename=$this->session->fullname;
			if($patientidno==""){
				$pid=$this->General_model->generatePatientID("1",$check['name']);
			}else{
				$pid=$patientidno;
			}
			if($admittype=="IPD"){
				$caseno=$this->General_model->generateCaseNo("I",$check['name']);
				$admit=$this->Admission_model->save_admission($patientidno,$pid,$caseno,$check['name'],$check['empid']);
			}
			if($admittype=="AR"){
				if($dept=="RDU"){
					$caseno=$this->General_model->generateCaseNo("ARD",$check['name']);
				}else if($dept=="KONSULTA"){
					$caseno=$this->General_model->generateCaseNo("ARK",$check['name']);
				}else{
					$caseno=$this->General_model->generateCaseNo("AR",$check['name']);
				}
				$admit=$this->Admission_model->save_ar_admission($patientidno,$pid,$caseno,$check['name'],$check['empid']);
			}
			if($admittype=="OPD"){
				$caseno=$this->General_model->generateCaseNo("O",$check['name']);
				$admit=$this->Emergency_model->save_opd_admission($patientidno,$pid,$caseno,$check['name'],$check['empid']);
			}
			if($admittype=="Walkin"){
				if($dept=="RDU"){
					$caseno=$this->General_model->generateCaseNo("WD",$check['name']);
				}else{
					$caseno=$this->General_model->generateCaseNo("W",$check['name']);
				}
				$admit=$this->Emergency_model->save_walkin_admission($patientidno,$pid,$caseno,$check['name'],$check['empid']);
			}
			if($admittype=="RDU"){
				$caseno=$this->General_model->generateCaseNo("R",$check['name']);
				$admit=$this->Dialysis_model->save_rdu_admission($patientidno,$pid,$caseno,$check['name'],$check['empid']);
			}
			if($admit){
				if($admittype=="IPD"){
					echo "<script>alert('Admission successfully saved!');window.location='".base_url()."admit_ipdlist';</script>";
				}else if($admittype=="OPD" || $admittype=="Walkin" || $admittype=="AR"){
					if($dept=="HMO"){
						echo "<script>alert('Admission successfully saved!');window.location='".base_url()."view_profile/$caseno';</script>";
					}else{
						echo "<script>alert('Admission successfully saved!');window.location='http://192.168.0.100:100/ERP/main/bridge.php?caseno=$caseno&username=$username&nursename=$nursename&&dept=$dept';</script>";
					}					
				}else if($admittype=="RDU"){
					echo "<script>alert('Admission successfully saved!');window.location='".base_url()."rdu_list';</script>";
				}
			}else{
				echo "<script>alert('Unable to save details! Duplicate Entry');window.history.back();</script>";
			}
		}
		public function checkPassword(){
			$id=$this->input->post('id');
			$dept=$this->session->dept;
			$data=$this->General_model->checkPassword($id,$dept);
			echo json_encode($data);
		}
		public function checkControlNo(){
			$id=$this->input->post('id');
			$dept=$this->session->dept;
			$data=$this->General_model->checkControlNo($id);
			echo json_encode($data);
		}
		public function checkHCNExist(){
			$id=$this->input->post('id');
			$data=$this->General_model->checkHCN($id);
			echo json_encode($data);
		}
		public function admit_ipdlist(){
			if($this->session->user_login){
				$page="ipdlist";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Active In-Patient";
					// $data['company'] = array();
					// $data['religion'] = array();
					// $data['nationality'] = array();
					// $data['room'] = array();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="ER"){
						$data['inpatient'] = $this->Admission_model->getAllInPatient();
						$data['company'] = $this->General_model->getCompany();
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					if($dept=="ADMISSION"){
						$data['inpatient'] = $this->Admission_model->getAllInPatient();
						$data['company'] = $this->General_model->getCompany();
						$data['religion'] = $this->General_model->getReligion();
						$data['nationality'] = $this->General_model->getNationality();
						$data['room'] = $this->General_model->getAllRoomsByStatus('vacant');
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalAdmission',$data);
					}
					if($dept=="HMO"){
						$data['inpatient'] = $this->Admission_model->getAllInPatient();
						$data['company'] = $this->General_model->getCompany();
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalHMO',$data);
					}

					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function rdu_list(){
			if($this->session->user_login){
				$page="rdulist";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Active Dialysis Patient";
					$data['inpatient'] = $this->Dialysis_model->getAllActiveRDUPatient();
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['room'] = $this->General_model->getAllRoomsByStatus('vacant');
					$data['company'] = $this->General_model->getCompany();
					$data['nationality'] = $this->General_model->getNationality();
					$data['religion'] = $this->General_model->getReligion();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDialysis',$data);
					$this->load->view('pages/dialysis/'.$page,$data);
					$this->load->view('templates/modalRDU',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_rdu_list(){
			if($this->session->user_login){
				$page="rdulist";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$searchme=$this->input->post('searchme');
					$data['header']=$this->General_model->getInfo();
					$data['title']="Active Dialysis Patient";
					$data['inpatient'] = $this->Dialysis_model->getSingleActiveRDUPatient($searchme);
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['room'] = $this->General_model->getAllRoomsByStatus('vacant');
					$data['company'] = $this->General_model->getCompany();
					$data['nationality'] = $this->General_model->getNationality();
					$data['religion'] = $this->General_model->getReligion();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDialysis',$data);
					$this->load->view('pages/dialysis/'.$page,$data);
					$this->load->view('templates/modalRDU',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_ipdlist(){
			if($this->session->user_login){
				$page="ipdlist";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Active In-Patient";
					$searchme=$this->input->post('searchme');
					$data['inpatient'] = $this->Admission_model->getSingleInPatient($searchme);
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['room'] = $this->General_model->getAllRoomsByStatus('vacant');
					$data['company'] = $this->General_model->getCompany();
					$data['religion'] = $this->General_model->getReligion();
					$data['nationality'] = $this->General_model->getNationality();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="ADMISSION"){
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalAdmission',$data);
					}
					if($dept=="ER"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function admit_arlist(){
			if($this->session->user_login){
				$page="arlist";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Active AR Patient ".$this->session->startdate;
					if($this->session->startdate){
						$startdate=$this->session->startdate;
					}else{
						if($this->input->post('startdate') <> ""){
							$this->session->set_userdata('startdate',$this->input->post('startdate'));
						}else{
							$this->session->set_userdata('startdate',date('Y-m-d'));
						}
						$startdate=$this->session->startdate;
					}
					if($this->session->dept=="RDU"){
						$data['inpatient'] = $this->Admission_model->getAllRDUARPatient($startdate);
					}else{
						$data['inpatient'] = $this->Admission_model->getAllARPatient($startdate);
					}
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['department'] = $this->session->dept;
					$data['startdate'] = $startdate;
					$dept=$this->session->dept;
					if($dept=="ADMISSION"){
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalAdmission',$data);
					}
					if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY" || $dept=="KONSULTA"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					if($dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalRDU',$data);
					}
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modal',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_arlist(){
			if($this->session->user_login){
				$page="arlist";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Active AR Patient";
					$dept=$this->session->dept;
					$searchme=$this->input->post('searchme');
					if($dept=="RDU"){
						$data['inpatient'] = $this->Admission_model->getSingleRDUARPatient($searchme);
					}else{
						$data['inpatient'] = $this->Admission_model->getSingleARPatient($searchme);
					}
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['department'] = $this->session->dept;
					if($dept=="ADMISSION"){
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalAdmission',$data);
					}
					if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY" || $dept=="KONSULTA"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					if($dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modal',$data);
					}
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modal',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}

		public function cancel_admission($caseno,$room){
			$cancel=$this->Admission_model->cancel_admission($caseno,$room);
			if($cancel){
				$message="Patient admission successfully cancelled with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				if($this->session->dept=="RDU"){
					$dir="rdu_list";
				}else{
					$dir="admit_ipdlist";
				}
				echo "<script>alert('Patient admission successfully cancelled!');window.location='".base_url()."$dir';</script>";
			}else{
				echo "<script>alert('Unable to cancel patient admission!');window.location='".base_url()."$dir';</script>";
			}
		}
		public function update_admission_details(){
			$caseno=$this->input->post('caseno');
			$patientidno=$this->input->post('patientidno');
			$update=$this->Admission_model->update_admission_details();
			if($update){
				$message="Admission details successfully updated with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Admission details successfully updated!');</script>";
			}else{
				echo "<script>alert('Unable to udpate admission details!');</script>";
			}
			if($this->session->dept=="MEDICAL RECORDS"){
				echo "<script>window.location='".base_url()."view_patient_record_details/$patientidno/$caseno';</script>";
			}else if($this->session->dept=="RDU"){
				echo "<script>window.location='".base_url()."rdu_list';</script>";
			}else{
				echo "<script>window.location='".base_url()."admit_ipdlist';</script>";
			}
		}
		public function fetch_single_doctor(){
			$id=$this->input->post('id');
			$data=$this->General_model->fetch_single_doctor($id);
			echo json_encode($data);
		}
		public function fetch_account_doctor(){
			$id=$this->input->post('id');
			$data=$this->Masterfile_model->fetch_account_doctor($id);
			echo json_encode($data);
		}
		public function update_attending_doctor(){
			$caseno=$this->input->post('caseno');
			$update=$this->General_model->update_attending_doctor();
			if($update){
				$this->General_model->update_admitting_doctor();
				$message="Attending and admitting doctor successfully updated with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Attending and admitting Doctor successfully updated!');</script>";
			}else{
				echo "<script>alert('Unable to udpate attending and admitting doctor!');</script>";
			}
			if($this->session->dept=="RDU"){
				echo "<script>window.location='".base_url()."rdu_list';</script>";
			}else{
				echo "<script>window.location='".base_url()."admit_ipdlist';</script>";
			}
		}
		public function update_ar_attending_doctor(){
			$caseno=$this->input->post('caseno');
			$update=$this->General_model->update_attending_doctor();
			if($update){
				$message="Attending doctor successfully updated with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Attending Doctor successfully updated!');window.location='".base_url()."admit_arlist';</script>";
			}else{
				echo "<script>alert('Unable to udpate attending doctor!');window.location='".base_url()."admit_arlist';</script>";
			}
		}
		public function save_admission_change_room(){
			$caseno=$this->input->post('caseno');
			$update=$this->Admission_model->save_admission_change_room($caseno);
			if($update){
				$message="Patient room successfully updated with the caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Admission room successfully updated!');window.location='".base_url()."manage_room_admit/$caseno';</script>";
			}else{
				echo "<script>alert('Unable to udpate admission room!');window.location='".base_url()."manage_room_admit/$caseno';</script>";
			}
		}
		public function remove_room($caseno,$refno){
			$update=$this->Admission_model->remove_room($refno);
			if($update){
				$message="Patient room successfully deleted with refno $refno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Admission room successfully deleted!');window.location='".base_url()."manage_room_admit/$caseno';</script>";
			}else{
				echo "<script>alert('Unable to delete admission room!');window.location='".base_url()."manage_room_admit/$caseno';</script>";
			}
		}
		public function save_admission_hmo(){
			$caseno=$this->input->post('caseno');
			$update=$this->Admission_model->save_admission_hmo($caseno);
			if($update){
				$message="Patient hmo successfully updated with the caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Patient HMO successfully updated!');</script>";
			}else{
				echo "<script>alert('Unable to udpate Patient HMO!');</script>";
			}
			if($this->session->dept=="RDU"){
				echo "<script>window.location='".base_url()."rdu_list';</script>";
			}else if($this->session->dept=="ONCOLOGY" || $this->session->dept=="OPD" || $this->session->dept=="ER"){
				echo "<script>window.location='".base_url()."opdlist';</script>";
			}else{
				echo "<script>window.location='".base_url()."admit_ipdlist';</script>";
			}
		}
		public function save_admission_hmo_ar(){
			$caseno=$this->input->post('caseno');
			$update=$this->Admission_model->save_admission_hmo($caseno);
			if($update){
				$message="Patient hmo successfully updated with the caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Patient HMO successfully updated!');</script>";
			}else{
				echo "<script>alert('Unable to udpate Patient HMO!');</script>";
			}
				echo "<script>window.close();</script>";
		}
		public function save_admission_hmo_procedure(){
			$caseno=$this->input->post('caseno');
			$update=$this->Admission_model->save_admission_hmo($caseno);
			if($update){
				$message="Patient hmo successfully updated with the caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Patient HMO successfully updated!');</script>";
			}else{
				echo "<script>alert('Unable to udpate Patient HMO!');</script>";
			}
				echo "<script>window.location='".base_url()."admit_opdprocedure';</script>";
		}
		public function save_admission_hmo_allocation(){
			$caseno=$this->input->post('caseno');
			$update=$this->Hmo_model->save_admission_hmo($caseno);
			if($update){
				$message="Patient hmo successfully updated with the caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','LOA limit successfully updated!');
			}else{

			}
				redirect(base_url()."hmo_allocation/$caseno");
		}

		public function cover_sheet($caseno){
			$page = "coversheet";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$header=$this->General_model->getinfo();
			$data['body']=$this->Admission_model->getCoverSheet($caseno);
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 40,
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_bottom' => 10,
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:center;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="70"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <center style="font-family:Arial;"><h4>CLINICAL COVER SHEET</h4></center>
             </div>
            ');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function discharge_ar_admission($caseno){
			$update=$this->Admission_model->discharge_other($caseno);
			if($update){
				$message="Patient successfully discharged with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Patient successfully discharged!');window.location='".base_url()."admit_arlist';</script>";
			}else{
				echo "<script>alert('Unable to discharge patient!');window.location='".base_url()."admit_arlist';</script>";
			}
		}
		public function request_stock($fn,$un,$d){
			$d=str_replace('%20',' ',$d);
			$fn=str_replace('%20',' ',$fn);
			$this->session->set_userdata('fullname',$fn);
			$this->session->set_userdata('username',$un);
			$this->session->set_userdata('dept',$d);
			$this->session->set_userdata('user_login',true);
			redirect(base_url()."stock_request");
		}
		public function discharged_report($fn,$un,$d){
			$d=str_replace('%20',' ',$d);
			$fn=str_replace('%20',' ',$fn);
			$this->session->set_userdata('fullname',$fn);
			$this->session->set_userdata('username',$un);
			$this->session->set_userdata('dept',$d);
			$this->session->set_userdata('user_login',true);
			redirect(base_url()."discharged_summary");
		}
		public function dialysis_report($fn,$un,$d){
			$d=str_replace('%20',' ',$d);
			$fn=str_replace('%20',' ',$fn);
			$this->session->set_userdata('fullname',$fn);
			$this->session->set_userdata('username',$un);
			$this->session->set_userdata('dept',$d);
			$this->session->set_userdata('user_login',true);
			redirect(base_url()."dialysis_summary");
		}
		public function arpatient_billing($fn,$un,$d){
			$d=str_replace('%20',' ',$d);
			$fn=str_replace('%20',' ',$fn);
			$this->session->set_userdata('fullname',$fn);
			$this->session->set_userdata('username',$un);
			$this->session->set_userdata('dept',$d);
			$this->session->set_userdata('user_login',true);
			redirect(base_url()."arpatient_list");
		}
		public function arhmo_billing($fn,$un,$d){
			$d=str_replace('%20',' ',$d);
			$fn=str_replace('%20',' ',$fn);
			$this->session->set_userdata('fullname',$fn);
			$this->session->set_userdata('username',$un);
			$this->session->set_userdata('dept',$d);
			$this->session->set_userdata('user_login',true);
			redirect(base_url()."arhmo_billing_report");
		}
		public function patient_deposit($fn,$un,$d){
			$d=str_replace('%20',' ',$d);
			$fn=str_replace('%20',' ',$fn);
			$this->session->set_userdata('fullname',$fn);
			$this->session->set_userdata('username',$un);
			$this->session->set_userdata('dept',$d);
			$this->session->set_userdata('user_login',true);
			redirect(base_url()."patient_deposit_report");
		}
		public function discharged_summary(){
			if($_SESSION['user_login']){
				$page="discharged_summary";
				if(!file_exists(APPPATH.'views/pages/billing/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Discharged Summary Report";
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="BILLING" or $dept=="ACCOUNTING"){
						$this->load->view('templates/headerOther',$data);
						$this->load->view('pages/billing/'.$page,$data);
						$this->load->view('templates/modalOther',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function dialysis_summary(){
			if($_SESSION['user_login']){
				$page="dialysis_summary";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Oxygen Supplies Summary Report";
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="BILLING" or $dept=="ACCOUNTING"){
						$this->load->view('templates/headerOther',$data);
						$this->load->view('pages/dialysis/'.$page,$data);
						$this->load->view('templates/modalOther',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function arhmo_billing_report(){
			if($_SESSION['user_login']){
				$page="arhmo_billing_report";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="AR HMO for BILLING";
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="BILLING" or $dept=="ACCOUNTING"){
						$this->load->view('templates/headerOther',$data);
						$this->load->view('pages/hmo/'.$page,$data);
						$this->load->view('templates/modalOther',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function patient_deposit_report(){
			if($_SESSION['user_login']){
				$page="patient_deposit_report";
				if(!file_exists(APPPATH.'views/pages/accounting/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="PATIENT DEPOSIT REPORT";
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="ACCOUNTING"){
						$this->load->view('templates/headerOther',$data);
						$this->load->view('pages/accounting/'.$page,$data);
						$this->load->view('templates/modalOther',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function stock_request(){
			if($_SESSION['user_login']){
				$page="stock_request";
				if(!file_exists(APPPATH.'views/pages/general/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
						$this->session->unset_userdata('reqno');
						$this->session->unset_userdata('requestingdept');
						$this->session->unset_userdata('requestinguser');
						$this->session->unset_userdata('requestingdept');
						$this->session->unset_userdata('requesteddept');
						$this->session->unset_userdata('type');

					$data['header']=$this->General_model->getInfo();
					$data['title']="Stock Request";
					$data['request'] = $this->General_model->getAllStockRequest();
					$data['station'] = $this->General_model->getAllStation();
					$data['dept'] = $this->session->dept;
					$data['department'] = $this->session->dept;
					$dept = $this->session->dept;
					if($dept=="ADMISSION"){
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modalAdmission',$data);
					}
					else if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY" || $dept=="KONSULTA"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					else if($dept=="CPU" || $dept=="CSR" || $dept=="CPU-RDU"){
						$this->load->view('templates/headerSCM',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modalSCM',$data);
					}
					else if($dept=="MEDICAL RECORDS"){
						$this->load->view('templates/headerMRD',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modalMRD',$data);
					}
					else if($dept=="DIETARY"){
						$this->load->view('templates/headerDietary',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modalDietary',$data);
					}
					else if($dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modalRDU',$data);
					}
					else if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modalHMO',$data);
					}
					else{
						$this->load->view('templates/headerOther',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modalOther',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function stock_request_new(){
			if($this->session->user_login){
				$page="stock_request_new";
				if(!file_exists(APPPATH.'views/pages/general/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."stock_request'>Stock Request</a> >> Create Request";
					if($this->session->reqno){
						$reqno=$this->session->reqno;
						$requestingdept=$this->session->requestingdept;
						$requestinguser=$this->session->requestinguser;
						$requestingdate=$this->session->requestingdate;
						$requesteddept=$this->session->requesteddept;
						$type=$this->session->type;
					}else{
						$this->session->set_userdata('reqno',$this->input->post('reqno'));
						$this->session->set_userdata('requestingdept',$this->input->post('requestingdept'));
						$this->session->set_userdata('requestinguser',$this->input->post('requestinguser'));
						$this->session->set_userdata('requestingdate',$this->input->post('requestingdate'));
						$this->session->set_userdata('requesteddept',$this->input->post('requesteddept'));
						$this->session->set_userdata('type',$this->input->post('type'));

						$reqno=$this->session->reqno;
						$requestingdept=$this->session->requestingdept;
						$requestinguser=$this->session->requestinguser;
						$requestingdate=$this->session->requestingdate;
						$requesteddept=$this->session->requesteddept;
						$type=$this->session->type;
					}
					$data['reqno'] = $reqno;
					$data['requestingdept'] = $requestingdept;
					$data['requestinguser'] = $requestinguser;
					$data['requestingdate'] = $requestingdate;
					$data['requesteddept'] = $requesteddept;
					$data['type'] = $type;
					$data['requested'] = $this->General_model->getAllRequested($reqno,$requestingdept);
					$data['search_result']=$this->General_model->fetch_item_by_desc($requesteddept);
					$data['dept'] = $this->session->dept;
					$data['department'] = $this->session->dept;
					$dept = $this->session->dept;
					if($dept=="ADMISSION"){
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modalAdmission',$data);
					}
					else if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY" || $dept=="KONSULTA"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					else if($dept=="CPU" || $dept=="CSR" || $dept=="CPU-RDU"){
						$this->load->view('templates/headerSCM',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modal',$data);
					}
					else if($dept=="MEDICAL RECORDS"){
						$this->load->view('templates/headerMRD',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modal',$data);
					}
					else if($dept=="DIETARY"){
						$this->load->view('templates/headerDietary',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modal',$data);
					}
					else if($dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modalRDU',$data);
					}
					else if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modal',$data);
					}
					else{
						$this->load->view('templates/headerOther',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modal',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function stock_request_cancel($reqno){
			$reqno=str_replace('%20',' ',$reqno);
			$cancel=$this->General_model->cancel_request($reqno);
			if($cancel){
				echo "<script>alert('Request successfully cancelled!');window.location='".base_url()."stock_request';</script>";
			}else{
				echo "<script>alert('Unable to cancel stock request!');window.location='".base_url()."stock_request_new';</script>";
			}
		}
		public function stock_request_print($param){
			$param=str_replace('%20',' ',$param);
			$page="stock_request_print";
			$data['header']=$this->General_model->requestprintheader($param);
			$reqdate = $data['header']['reqdate'];
			$requestingdept = $data['header']['reqdept'];
			$requesteddept= $data['header']['dept'];
			$data['body']=$this->General_model->requestprintbody($param);
			$header=$this->General_model->getInfo();

			$html = $this->load->view('pages/general/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 10,
				'margin_right' => 10,
				'setAutoBottomMargin' => 'stretch'
				//'format' => [210, 148]
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:center;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                     <td width="20">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                    <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:13px;">'.$header['address'].'</font></td>
                  <td width="30">&nbsp;</td>
              </tr>
            </table>
			 <center><h4>STOCK TRANSFER REQUISITION</h4></center>
			 <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
             <tr>
                <td width="25%" align="right">Requested To:</td>
                <td align="right"><b>'.$requesteddept.'</b></td>
                 <td width="30%" align="right">Request No.:</td>
                 <td align="right"><b>'.$param.'</b></td>
                 </tr>
                 <tr>
				 <td align="right">Requesting Department:</td>
                <td align="right"><b>'.$requestingdept.'</b></td>
                 <td align="right">Date: </td>
                 <td align="right"><b>'.date('M-d-Y',strtotime($reqdate)).'</b></td>
                 </tr>
                 <tr>
             </table>
             <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;">
                <tr>
                     <td align="center" width="5%" style="border-bottom:1px solid black;"><b>#</b></td>
                     <td align="center" width="5%" style="border-bottom:1px solid black;"><b>QTY</b></td>
					 <td width="65%" style="border-bottom:1px solid black;"><b>DESCRIPTION</b></td>
					 <td align="left" width="25%" style="border-bottom:1px solid black;"><b>LAST DATE REQUESTED</b></td>
				 </tr>
                 </table>
             </div>
            ');
//			$mpdf->setFooter('<div>
//            <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size:10px;font-weight:bold;">
//            <tr>
//            <td width="35%">Requested by:_________________________</td>
//            <td width="35%">Received by:_________________________</td>
//            <td width="30%">Approved by:_______________________</td>
//            </tr>
//            </table>
//            </div>{PAGENO}');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function requestadditem(){
			$code=$this->input->post('code');
			$quantity=$this->input->post('quantity');
			$type=$this->input->post('type');
			$qty=$this->input->post('qty');
			$data=$this->General_model->requestadditem($code,$quantity,$type,$qty);
			if($data){
				$this->session->set_flashdata('add_success','Item successfully added!');
			}else{
				$this->session->set_flashdata('add_failed','Requested quantity must NOT greater than stock on hand!');
			}
			redirect(base_url()."stock_request_new");
		}
		public function fetch_single_item(){
			$code=$this->input->post('id');
			$dept=$this->session->requesteddept;
			$data=$this->General_model->fetch_single_item($code,$dept);
			echo json_encode($data);
		}
		public function fetch_single_code(){
			$code=$this->input->post('id');
			$data=$this->General_model->fetch_single_code($code);
			echo json_encode($data);
		}
		public function remove_item_request($id){
			$remove=$this->General_model->remove_item_request($id);
			if($remove){
				$this->session->set_flashdata('remove_success','Item successfully removed!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to remove item!');
			}
			redirect(base_url()."stock_request_new");
		}
		public function daily_admission(){
			if($this->session->dept=="MEDICAL RECORDS"){
				$page = "admission_records";
				$data['body']=$this->General_model->getAllAdmissionRecords();
				$startdate=$this->input->post('startdate');
				$enddate=$this->input->post('enddate');
				$startdate=date('F d, Y',strtotime($startdate));
				$enddate=date('F d, Y',strtotime($enddate));
			}else if($this->session->dept=="RDU"){
				$page = "daily_admission_rdu";
				$data['body']=$this->General_model->getAllRDUAdmission();
				$startdate=$this->input->post('rundate');
				$startdate=date('F d, Y',strtotime($startdate));
				$enddate=$startdate;
			}else{
				$page = "daily_admission";
				$data['body']=$this->General_model->getAllAdmission();
				$startdate=$this->input->post('rundate');
				$startdate=date('F d, Y',strtotime($startdate));
				$enddate=$startdate;
			}
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}

			$header=$this->General_model->getinfo();
			$this->load->view('pages/reports/'.$page, $data);
			//$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'setAutoBottomMargin' => 'stretch',
				'margin_right' => 5,
				'margin_bottom' => 10,
				'orientation' => 'L',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4 style="margin-left:90px;">ADMISSION REPORT<br>'.$startdate.' to '.$enddate.'</h4>
             </div>');
			// $mpdf->autoPageBreak = true;
			// $mpdf->WriteHTML($html);
			// $mpdf->Output();
		}
		public function daily_discharged(){
			if($this->session->dept=="MEDICAL RECORDS"){
				$page = "daily_discharged_list";
			}else{
				$page = "daily_discharged";
			}
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$rundate=$this->input->post('rundate');
			$startdate=date('F d, Y',strtotime($rundate));
			$header=$this->General_model->getinfo();
			$data['body']=$this->General_model->getAllDischarged();
			$data['dischargeddate'] = $startdate;
			//$html=$this->load->view('pages/reports/'.$page, $data,true);
			$html=$this->load->view('pages/reports/'.$page, $data);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 2,
				'margin_right' => 2,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4 style="margin-left:90px;">DAILY DISCHARGED REPORT<br>'.$startdate.'</h4>
             </div>');
			$mpdf->autoPageBreak = true;
			//$mpdf->WriteHTML($html);
			//$mpdf->Output();
		}
		public function rod_manager(){
			if($this->session->user_login){
				$page="rod_manager";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Resident on Duty Manager";
					$data['admitting'] = $this->General_model->getAdmittingDoctor();
					$rod=$this->General_model->getResidentDuty();
					$data['rod']=$rod['name'];
					$data['rodcode']=$rod['code'];
					$data['rodspecialization'] = $rod['specialization'];
					$data['department'] = $this->session->dept;
					$this->load->view('templates/headerAdmission',$data);
					$this->load->view('pages/admission/'.$page,$data);
					$this->load->view('templates/modalAdmission');
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function set_rod($id){
			$updaterod=$this->Admission_model->set_rod($id);
			if($updaterod){
				$message="Resident on Duty successfully updated.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('set_success','Today`s ROD successfully updated!');
			}else{
				$this->session->set_flashdata('set_failed','Unable to update ROD!');
			}
			redirect(base_url()."rod_manager");
		}
		public function room_status(){
			if($this->session->user_login){
				$page="room_status";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Room Manager";
					$data['department'] = $this->session->dept;
					$this->load->view('templates/headerAdmission',$data);
					$this->load->view('pages/admission/'.$page,$data);
					$this->load->view('templates/modalAdmission');
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function set_status_vacant($id){
			$status=$this->Admission_model->set_room_status($id,'vacant');
			if($status){
				$message="Room status successfully updated with Room ID of $id.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('set_success','Room status successfully updated!');
			}else {
				$this->session->set_flashdata('set_failed', 'Unable to update Room Status!');
			}
			redirect(base_url()."room_status");
		}
		public function set_status_occupied($id)
		{
			$status = $this->Admission_model->set_room_status($id, 'occupied');
			if ($status) {
				$message = "Room status successfully updated with Room ID of $id.";
				$loginuser = $this->session->fullname;
				$this->General_model->userlogs($message, $loginuser);
				$this->session->set_flashdata('set_success', 'Room status successfully updated!');
			} else {
				$this->session->set_flashdata('set_failed', 'Unable to update Room Status!');
			}
			redirect(base_url() . "room_status");
		}
		public function patientprofile($patientidno){
			if($this->session->user_login){
				$page="patientprofile";
				if(!file_exists(APPPATH.'views/pages/general/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."admission'>Patient List</a> >> Patient Profile";
					$data['patient'] = $this->General_model->getSinglePatient($patientidno);
					$data['admission'] = $this->General_model->getAllPatientAdmission($patientidno);
					$data['province'] = $this->General_model->getState();
					$data['company'] = $this->General_model->getCompany();
					$data['patientidno'] = $patientidno;
					$dept = $this->session->dept;
					$data['department']=$dept;
					if($dept=="ADMISSION"){
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modalAdmission',$data);
					}
					if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					if($dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
						$this->load->view('pages/general/'.$page,$data);
						$this->load->view('templates/modalRDU',$data);
					}
					if($dept=="HMO"){
						$page="patientprofile";
						$data['title']="<a href='".base_url()."arpatient_list'>Patient List</a> >> Patient Profile";
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/hmo/'.$page,$data);
						$this->load->view('templates/modalHMO',$data);
					}
					if($dept=="BILLING"){
						$page="patientprofile";
						$data['title']="<a href='".base_url()."arpatient_list'>Patient List</a> >> Patient Profile";
						$this->load->view('templates/headerOther',$data);
						$this->load->view('pages/hmo/'.$page,$data);
						$this->load->view('templates/modalOther',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function updatepatientprofile(){
			$patientidno=$this->input->post('patientidno');
			$caseno=$this->input->post('caseno');
			$update=$this->General_model->updatepatientprofile();
			if($update){
				$message = "Patient profile successfully updated with patientidno $patientidno.";
				$loginuser = $this->session->fullname;
				$this->General_model->userlogs($message, $loginuser);
				$this->session->set_flashdata('save_success','Profile successfully updated!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to update profile!');
			}
			if($this->session->dept=="MEDICAL RECORDS"){
				if($caseno==""){
					redirect(base_url()."view_patient_record/".$patientidno);
				}else{
					redirect(base_url()."view_patient_record_details/".$patientidno."/".$caseno);
				}				
			}else{
				redirect(base_url()."patientprofile/".$patientidno);
			}
		}
		public function search_patient_record(){
			if($this->session->user_login){
				$page="search_patient_record";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Search Patient Record";
					$data['inpatient'] = $this->General_model->getAllPatient();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="MEDICAL RECORDS"){
						$this->load->view('templates/headerMRD',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalMRD',$data);
					}else{
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalAdmission',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_patient_record_search(){
			if($this->session->user_login){
				$page="search_patient_record";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Search Patient Record";
					$searchme=$this->input->post('searchme');
					$data['inpatient'] = $this->Admission_model->getSelectedPatient($searchme);
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="MEDICAL RECORDS"){
						$this->load->view('templates/headerMRD',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalMRD',$data);
					}else{
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalAdmission',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function view_patient_record($patientidno){
			if($this->session->user_login){
				$page="patientrecord";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."search_patient_record'>Search Patient</a> >> Patient Record";
					$data['patient'] = $this->General_model->getSinglePatient($patientidno);
					$data['admission'] = $this->General_model->getAllInPatientAdmission($patientidno);
					$data['patientidno'] = $patientidno;
					$dept = $this->session->dept;
					if($dept=="MEDICAL RECORDS"){
						$this->load->view('templates/headerMRD',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalMRD',$data);
					}else{
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalAdmission',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function view_patient_record_details($patientidno,$caseno){
			if($this->session->user_login){
				$page="patientrecorddetails";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."search_patient_record'>Search Patient</a> >> <a href='".base_url()."view_patient_record/$patientidno'>Patient Record</a> >> Admission Details";
					$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['patientidno'] = $patientidno;
					$data['caseno'] = $caseno;
					$data['province'] = $this->General_model->getState();
					$data['company'] = $this->General_model->getCompany();
						$data['religion'] = $this->General_model->getReligion();
						$data['nationality'] = $this->General_model->getNationality();
					$dept = $this->session->dept;
					$data['department'] = $dept;
					if($dept=="MEDICAL RECORDS"){
						$this->load->view('templates/headerMRD',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalMRD',$data);
					}else{
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/admission/'.$page,$data);
						$this->load->view('templates/modalAdmission',$data);
					}

					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function fetchSinglePatient(){
			$id=$this->input->post('id');
			$data=$this->General_model->fetchSinglePatient($id);
			echo json_encode($data);
		}
		public function fetch_single_admission(){
			$id=$this->input->post('id');
			$data=$this->Admission_model->fetchSingleAdmission($id);
			echo json_encode($data);
		}
		public function fetch_single_address(){
			$id=$this->input->post('id');
			$data=$this->General_model->fetch_single_address($id);
			echo json_encode($data);
		}
		public function updatepatientaddress(){
			$patientidno=$this->input->post('patientidno');
			$caseno=$this->input->post('caseno');
			$update=$this->General_model->updatepatientaddress();
			if($update){
				$message = "Patient address successfully updated with patientidno $patientidno.";
				$loginuser = $this->session->fullname;
				$this->General_model->userlogs($message, $loginuser);
				$this->session->set_flashdata('save_success','Address successfully updated!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to update address!');
			}
			if($this->session->dept=="MEDICAL RECORDS"){
				redirect(base_url()."view_patient_record_details/".$patientidno."/".$caseno);
			}else{
				redirect(base_url()."patientprofile/".$patientidno);
			}
		}
		public function summary_chart($caseno){
			$page = "summary_chart";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$rundate=$this->input->post('rundate');
			$startdate=date('F d, Y',strtotime($rundate));
			$header=$this->General_model->getinfo();
			$profile=$this->Admission_model->fetch_single_admission($caseno);
			$doctor=$this->General_model->fetch_single_doctor_by_code($profile['ap']);
			$data['body'] = array();
			$case=explode("-",$profile['employerno']);
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 10,
				'margin_right' => 10,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
			<br>
			<table width="100%" border="0" style="font-size:12px;">
				<tr>
					<td colspan="6" align="center"><h2>SUMMARY CHART</h2></td>
				</tr>
				<tr>
					<td colspan="5">&nbsp;</td>
					<td>T.D. No.</td>
				</tr>
				<tr>
					<td colspan="5">&nbsp;</td>
					<td>Case No.: <b>'.$case[1].'</b></td>
				</tr>
				<tr>
					<td align="center"><b>'.$profile['lastname'].'</b></td>
					<td width="3%">&nbsp;</td>
					<td align="center"><b>'.$profile['firstname'].'</b></td>
					<td align="center"><b>'.$profile['middlename'].'</b></td>
					<td width="2%">&nbsp;</td>
					<td>
					</tr>

					<tr>
						<td colspan="6">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="6"><b>Medical Profession Service Fees</b></td>
					</tr>
					<tr>
						<td align="right"><b>Attending Physician:</b></td>
						<td></td>
						<td style="border-bottom:1px solid black">'.$doctor['name'].'</td>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td align="right"><b>Attending Physician:</b></td>
						<td></td>
						<td style="border-bottom:1px solid black">&nbsp;</td>
						<td colspan="3">&nbsp;</td>
					</tr>
			</table>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function admission_patient_list(){
			if($this->session->user_login){
				$page="patientlist";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Active In-Patient";
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="ADMISSION"){
						$this->load->view('templates/headerAdmission',$data);
					}
					if($dept=="ER"){
						$this->load->view('templates/headerER',$data);
					}
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
					}
					$this->load->view('pages/admission/'.$page,$data);
					$this->load->view('templates/modalAdmission',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_initial_diag(){
			$caseno=$this->input->post('caseno');
			$result=$this->Admission_model->save_initial_diag();
			if($result){
				$message = "Patient initial diagnosis successfully updated with caseno $caseno.";
				$loginuser = $this->session->fullname;
				$this->General_model->userlogs($message, $loginuser);
				$this->session->set_flashdata('success','Patient initial diagnosis successfully updated!');
			}else{
				$this->session->set_flashdata('failed','Unable to update initial diagnosis!');
			}
			redirect(base_url()."admit_ipdlist");
		}
		public function manage_room_admit($caseno){
			if($this->session->user_login){
				$page="manage_room_admit";
				if(!file_exists(APPPATH.'views/pages/admission/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."admit_ipdlist'>IPD List</a> >> Manage Room Admission";
					$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
					$data['rooms'] = $this->Admission_model->getAllRoom($caseno);
					$data['room'] = $this->General_model->getAllRoomsByStatus('vacant');
					$data['caseno'] = $caseno;
					$dept = $this->session->dept;
					$data['department'] = $dept;
					$this->load->view('templates/headerAdmission',$data);
					$this->load->view('pages/admission/'.$page,$data);
					$this->load->view('templates/modalAdmission',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		//==============End of Admitting Module=====================================

		//==============Start of Emergency Room Module==============================
		public function opdlist(){
			if($this->session->user_login){
				$page="opdlist";
				if(!file_exists(APPPATH.'views/pages/emergency/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					if($this->session->rundate && $this->session->atype){
						$rundate=$this->session->rundate;
						$type=$this->session->atype;
					}else{
						$this->session->set_userdata('rundate',$this->input->post('rundate'));
						$this->session->set_userdata('atype',$this->input->post('atype'));
						$rundate=$this->session->rundate;
						$type=$this->session->atype;
					}
					$data['header']=$this->General_model->getInfo();
					$data['title']="Active Out Patient";
					$data['outpatient'] = $this->Emergency_model->getAllOutPatient();
					$data['admitting'] = $this->General_model->getAdmittingDoctor();
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['company'] = $this->General_model->getCompany();
					$data['department'] = $this->session->dept;
					$data['rundate'] = $rundate;
					$data['type'] = $type;
					$dept=$this->session->dept;
					if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/emergency/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					if($dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
						$this->load->view('pages/emergency/'.$page,$data);
						$this->load->view('templates/modalRDU',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function searchopdlist(){
			if($this->session->user_login){
				$page="opdlist";
				if(!file_exists(APPPATH.'views/pages/emergency/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					if($this->session->rundate && $this->session->atype){
						$rundate=$this->session->rundate;
						$type=$this->session->atype;
					}else{
						$this->session->set_userdata('rundate',$this->input->post('rundate'));
						$this->session->set_userdata('atype',$this->input->post('atype'));
						$rundate=$this->session->rundate;
						$type=$this->session->atype;
					}
					$data['header']=$this->General_model->getInfo();
					$data['title']="Active Out Patient";
					$searchme=$this->input->post('searchme');
					$data['outpatient'] = $this->Emergency_model->getSingleOutPatient($searchme);
					$data['admitting'] = $this->General_model->getAdmittingDoctor();
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['department'] = $this->session->dept;
					$data['rundate'] = $rundate;
					$data['type'] = $type;
					$dept=$this->session->dept;
					if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/emergency/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					if($dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
						$this->load->view('pages/emergency/'.$page,$data);
						$this->load->view('templates/modalRDU',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function update_admitting_doctor(){
			$caseno=$this->input->post('caseno');
			if($this->session->rundate && $this->session->atype){
				$rundate=$this->session->rundate;
				$type=$this->session->atype;
			}else{
				$this->session->set_userdata('rundate',$this->input->post('rundate'));
				$this->session->set_userdata('atype',$this->input->post('atype'));
				$rundate=$this->session->rundate;
				$type=$this->session->atype;
			}
			$data=$this->Emergency_model->update_admitting_doctor($caseno);
			if($data){
				$this->session->set_flashdata('success','Admitting doctor successfully updated!');
			}else{
				$this->session->set_flashdata('failed','Unable to update admitting doctor!');
			}
			redirect(base_url()."opdlist");
		}
		public function opdadmission(){
			if($this->session->user_login){
				$page="opdadmission";
				if(!file_exists(APPPATH.'views/pages/emergency/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Out-Patient Admission";
					$data['nationality'] = $this->General_model->getNationality();
					$data['religion'] = $this->General_model->getReligion();
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['admitting'] = $this->General_model->getAdmittingDoctor();
					$data['room'] = $this->General_model->getAllRoomsByStatus('vacant');
					$data['company'] = $this->General_model->getCompany();
					$data['province'] = $this->General_model->getState();
					$data['servicetype'] = $this->General_model->getServiceType();
					$data['procedure'] = $this->General_model->getProcedure();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY"){
						$this->load->view('templates/headerER',$data);
					}
					$this->load->view('pages/emergency/'.$page,$data);
					$this->load->view('templates/modalER',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function opdreadmission(){
			if($this->session->user_login){
				$page="opdreadmission";
				if(!file_exists(APPPATH.'views/pages/emergency/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Out-Patient Admission";
					$patientdino=$this->input->post('patientidno');
					$data['patientidno'] = $patientdino;
					$data['outpatient'] = $this->Admission_model->fetch_previous_admission($patientdino);
					$data['nationality'] = $this->General_model->getNationality();
					$data['religion'] = $this->General_model->getReligion();
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['admitting'] = $this->General_model->getAdmittingDoctor();
					$data['room'] = $this->General_model->getAllRoomsByStatus('vacant');
					$data['company'] = $this->General_model->getCompany();
					$data['province'] = $this->General_model->getState();
					$data['servicetype'] = $this->General_model->getServiceType();
					$data['procedure'] = $this->General_model->getProcedure();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY"){
						$this->load->view('templates/headerER',$data);
					}
					$this->load->view('pages/emergency/'.$page,$data);
					$this->load->view('templates/modalER',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}

		public function walkinadmission(){
			if($this->session->user_login){
				$page="walkinadmission";
				if(!file_exists(APPPATH.'views/pages/emergency/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Walkin Patient Admission";
					// /$data['attending'] = $this->General_model->getAttendingDoctor();
					// $data['admitting'] = $this->General_model->getAdmittingDoctor();
					// $data['province'] = $this->General_model->getState();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/emergency/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					if($dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
						$this->load->view('pages/emergency/'.$page,$data);
						$this->load->view('templates/modalRDU',$data);
					}

					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function walkinreadmission(){
			if($this->session->user_login){
				$page="walkinreadmission";
				if(!file_exists(APPPATH.'views/pages/emergency/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Walkin Patient Admission";
					$patientdino=$this->input->post('patientidno');
					$data['patientidno'] = $patientdino;
					$data['outpatient'] = $this->Admission_model->fetch_previous_admission($patientdino);
					// $data['attending'] = $this->General_model->getAttendingDoctor();
					// $data['admitting'] = $this->General_model->getAdmittingDoctor();
					// $data['province'] = $this->General_model->getState();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/emergency/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					if($dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
						$this->load->view('pages/emergency/'.$page,$data);
						$this->load->view('templates/modalRDU',$data);
					}

					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function daily_admission_opd(){
			$page = "daily_admission";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$rundate=$this->input->post('rundate');
			$startdate=date('F d, Y',strtotime($rundate));
			$header=$this->General_model->getinfo();
			$data['body']=$this->General_model->getAllAdmissionOPD();
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 45,
				'margin_left' => 5,
				'margin_right' => 5,
				'margin_bottom' => 10,
				'orientation' => 'L',
				'format' => 'Legal'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4 style="margin-left:90px;">DAILY OPD ADMISSION REPORT<br>'.$startdate.'</h4>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function rod_reports(){
			$page = "rod_reports";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$datefrom=date('F d, Y',strtotime($startdate));
			$dateto=date('F d, Y',strtotime($enddate));
			$header=$this->General_model->getinfo();
			$data['rod'] = $this->input->post('code');
			$data['body']=$this->Emergency_model->getRODReports();
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 45,
				'margin_left' => 5,
				'margin_right' => 5,
				'margin_bottom' => 10,
				'format' => 'Legal'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4>ROD REPORTS<br>'.$datefrom.' - '.$dateto.'</h4>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}

		public function discharge_opd_admission($caseno){
			$update=$this->Admission_model->discharge_other($caseno);
			if($update){
				$message="Patient successfully discharged with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Patient successfully discharged!');window.location='".base_url()."main';</script>";
			}else{
				echo "<script>alert('Unable to discharge patient!');window.location='".base_url()."main';</script>";
			}
		}
		public function save_vital_signs(){
			$caseno=$this->input->post('caseno');
			$update=$this->Emergency_model->save_vital_signs();
			if($update){
				$message="Vital signs successfully updated with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Vital signs successfully updated!');window.location='".base_url()."admit_ipdlist';</script>";
			}else{
				echo "<script>alert('Unable to update vital signs!');window.location='".base_url()."admit_ipdlist';</script>";
			}
			//redirect(base_url()."admit_ipdlist");
		}
		public function fetch_vital_signs(){
			$id=$this->input->post('id');
			$data=$this->Emergency_model->fetch_vital_signs($id);
			echo json_encode($data);
		}
		public function fetch_credit_limit(){
			$id=$this->input->post('id');
			$data=$this->Emergency_model->fetch_credit_limit($id);
			echo json_encode($data);
		}
		public function save_credit_limit(){
			$rundate=$this->input->post('rundate');
			$atype=$this->input->post('atype');
			$this->session->set_userdata('rundate',$rundate);
			$this->session->set_userdata('atype',$atype);
			$save=$this->Emergency_model->save_credit_limit();
			if($save){
				$message="Credit Limit successfully updated with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('success','Credit Limit successfully updated!');
			}else{
				$this->session->set_flashdata('failed','Unable to update credit limit!');
			}
			redirect(base_url()."opdlist");
		}
		public function cancel_opd_admission($caseno){
			$cancel=$this->Emergency_model->cancel_opd_admission($caseno);
			if($cancel){
				$message="Patient admission successfully cancelled with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Patient admission successfully cancelled!');window.location='".base_url()."opdlist';</script>";
			}else{
				echo "<script>alert('Unable to cancel patient admission!');window.location='".base_url()."opdlist';</script>";
			}
		}

		public function referred_summary(){
			$page = "referred_summary";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$datefrom=date('F d, Y',strtotime($startdate));
			$dateto=date('F d, Y',strtotime($enddate));
			$header=$this->General_model->getinfo();
			$data['body']=$this->Emergency_model->getReferredSummary();
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:center;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4>REFERRED SUMMARY REPORT<br>'.$datefrom.' to '.$dateto.'</h4>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function print_index_card($caseno){
			$page = "index_card";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$header=$this->General_model->getinfo();
			$data['item']=$this->General_model->getAdmissionByPatient($caseno);
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 5,
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'A4'
			]);
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function update_opd_membership(){
			$caseno=$this->input->post("caseno");
			$update=$this->Emergency_model->update_opd_membership();
			if($update){
				$message="Membership successfully updated with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('success','Memebership successfully updated');
			}else{
				$this->session->set_flashdata('failed','Unable to update Memebership!');
			}
			redirect(base_url()."opdlist");
		}
		public function dischargedlist(){
			if($this->session->user_login){
				$page="dischargedlist";
				if(!file_exists(APPPATH.'views/pages/emergency/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Discharged Out Patient";
					$data['outpatient'] = $this->Emergency_model->getAllDischargedPatient();
					$dept=$this->session->dept;
					$data['department'] = $dept;
					if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/emergency/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					if($dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
						$this->load->view('pages/emergency/'.$page,$data);
						$this->load->view('templates/modalRDU',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function opd_minor_report(){
			$page = "opd_minor_report";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$header=$this->General_model->getinfo();
			$data['body']=$this->General_model->getAllAdmissionMinor($startdate,$enddate);
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'orientation' => 'L',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4 style="margin-left:90px;">OPD MINOR REPORT<br>'.date('M-d-Y',strtotime($startdate)).' to '.date('M-d-Y',strtotime($enddate)).'</h4>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function ob_reports(){
			$page = "ob_reports";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$datefrom=date('F d, Y',strtotime($startdate));
			$dateto=date('F d, Y',strtotime($enddate));
			$header=$this->General_model->getinfo();
			$data['rod'] = $this->input->post('code');
			$data['body']=$this->Emergency_model->getOBReports();
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 45,
				'margin_left' => 5,
				'margin_right' => 5,
				'margin_bottom' => 10,
				'format' => 'Legal'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4>OB REPORTS<br>'.$datefrom.' - '.$dateto.'</h4>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		//==============End of Emergency Room Module==============================

		//==============Start of Masterfile Module================================
		public function manage_employees(){
            if($this->session->user_login){
	            $page="manage_employees";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['header']=$this->General_model->getInfo();
					$data['title'] = "Employee Manager";
					$data['employees'] = $this->Masterfile_model->getAllEmployees();
					$data['search_result'] = "";
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile');
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}

		public function patient_merging(){
            if($this->session->user_login){
	            $page="patient_merging";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['header']=$this->General_model->getInfo();
					$data['title'] = "Patient Merging";
					if($this->session->dept=="Masterfile"){$this->load->view('templates/headerMasterfile',$data);}
					else{$this->load->view('templates/headerMRD',$data);}
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMRD');
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}

		public function save_employee(){
			$empid=$this->input->post('empid');
			if($this->input->post('empid')=="") {
				$save_employee = $this->Masterfile_model->save_employee();
				if ($save_employee) {
					$message="Employee profile successfully added!";
					$loginuser=$this->session->fullname;
					$this->General_model->userlogs($message,$loginuser);
					$this->session->set_flashdata('save_success', 'Employee successfully added!');
				} else {
					$this->session->set_flashdata('save_failed', 'Unable to add new employee!');
				}
			}else{
				$update=$this->Masterfile_model->update_employee();
				if($update){
					$message="Employee profile successfully updated with employee ID $empid.";
					$loginuser=$this->session->fullname;
					$this->General_model->userlogs($message,$loginuser);
					$this->session->set_flashdata('save_success','Employee successfully updated!');
				}else{
					$this->session->set_flashdata('save_failed','Unable to update new employee!');
				}
			}
			redirect(base_url()."manage_employees");
		}
		public function fetch_single_employee(){
			$id=$this->input->post('id');
			$data=$this->Masterfile_model->fetch_single_employee($id);
			echo json_encode($data);
		}
		public function update_employee(){
			$update=$this->Masterfile_model->update_employee();
			if($update){
				$this->session->set_flashdata('save_success','Employee successfully updated!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to update new employee!');
			}
			redirect(base_url()."manage_employees");
		}
		public function manage_employee_account($empid){
            if($this->session->user_login){
	            $page="manage_employee_account";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."manage_employees'>Employees</a> >> User Accounts";
					$data['employee'] = $this->Masterfile_model->getSingleEmployee($empid);
					$data['access'] = $this->Masterfile_model->getEmployeeAccess($empid);
					$data['station'] = $this->Masterfile_model->getAllStation();
					$data['empid'] = $empid;
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile');
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}
		public function delete_station_account($empid,$id){
			$delete=$this->Masterfile_model->delete_user_account($id);
			if($delete){
				$message="User account successfully deleted with employee ID $empid.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Station account successfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete station access!');
			}
			redirect(base_url()."manage_employee_account/$empid");
		}
		public function delete_doctor_account($empid,$id){
			$delete=$this->Masterfile_model->delete_doctor_account($id);
			if($delete){
				$message="Doctor account successfully deleted with employee ID $empid.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Doctor account successfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete doctor access!');
			}
			redirect(base_url()."manage_doctor_account/$empid");
		}
		public function add_employee_access(){
			$empid=$this->input->post('empid');
			$addnew=$this->Masterfile_model->add_employee_access();
			if($addnew){
				$message="User access successfully added with employee ID $empid.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Station account successfully added!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to add station access!');
			}
			redirect(base_url()."manage_employee_account/$empid");
		}
		public function update_user_account(){
			$empid=$this->input->post('empid');
			$addnew=$this->Masterfile_model->update_user_account();
			if($addnew){
				$message="User account successfully updated with employee ID $empid.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','User account successfully updated!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to update user account!');
			}
			redirect(base_url()."manage_employee_account/$empid");
		}

		public function fetch_single_access(){
			$id=$this->input->post('id');
			$stat=$this->input->post('station');
			$data=$this->Masterfile_model->fetch_single_access($id,$stat);
			echo json_encode($data);
		}
		public function fetch_doctor_access(){
			$id=$this->input->post('id');
			$stat=$this->input->post('station');
			$data=$this->Masterfile_model->fetch_doctor_access($id,$stat);
			echo json_encode($data);
		}
		public function update_user_access(){
			$empid=$this->input->post('empid');
			$addnew=$this->Masterfile_model->update_user_access();
			if($addnew){
				$message="User access successfully updated with employee ID $empid.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','User access successfully updated!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to update user access!');
			}
			redirect(base_url()."manage_employee_account/$empid");
		}

		public function update_doctor_access(){
			$empid=$this->input->post('empid');
			$addnew=$this->Masterfile_model->update_doctor_access();
			if($addnew){
				$message="Doctor access successfully updated with employee ID $empid.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Dcotor access successfully updated!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to update doctor access!');
			}
			redirect(base_url()."manage_doctor_account/$empid");
		}

		public function view_employee_profile($empid){
            if($this->session->user_login){
	            $page="view_employee_profile";
				if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['title']="General";
					$data['subtitle'] = "<a href='".base_url()."manage_employees'>Employees</a> >> User Profile";
					$data['employee'] = $this->Masterfile_model->getSingleEmployee($empid);
					$data['access'] = $this->Masterfile_model->getEmployeeAccess($empid);
					$data['empid'] = $empid;
					$this->load->view('templates/header',$data);
					$this->load->view('pages/'.$page,$data);
					$this->load->view('templates/modalMasterfile');
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}

		public function manage_doctors(){
            if($this->session->user_login){
	            $page="manage_doctors";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['title']="Manage Doctor";
					$data['header']=$this->General_model->getInfo();
					$data['doctors'] = $this->Masterfile_model->getAllDoctors();
					$data['specializations'] = $this->Masterfile_model->getAllSpecialization();
					$data['search_result']="";
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}
		public function save_doctor(){
			$lastname=$this->input->post('lastname');
			$firstname=$this->input->post('firstname');
			$docid=$this->input->post('code');
			if($docid=="") {
				$fullname = "Dr. " . $firstname . " " . $lastname;
				$save_employee = $this->Masterfile_model->save_doctor();
				if ($save_employee) {
					$message = $fullname . " profile successfully saved!";
					$loginuser = $this->session->fullname;
					$this->General_model->userlogs($message, $loginuser);
					$this->session->set_flashdata('save_success', 'Doctor successfully added!');
				} else {
					$this->session->set_flashdata('save_failed', 'Unable to add new doctor!');
				}
			}else{
				$save_employee=$this->Masterfile_model->update_doctor();
				if($save_employee){
					$message = $fullname . " profile successfully updated!";
					$loginuser = $this->session->fullname;
					$this->General_model->userlogs($message, $loginuser);
					$this->session->set_flashdata('save_success','Doctor profile successfully updated!');
				}else{
					$this->session->set_flashdata('save_failed','Unable to update doctor!');
				}
			}
			redirect(base_url()."manage_doctors");
		}
		public function manage_search_doctors(){
            if($this->session->user_login){
	            $page="manage_doctors";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['title']="Manage Doctors";
					$data['header']=$this->General_model->getInfo();
					$data['doctors'] = $this->Masterfile_model->getSingleDoctor();
					$data['specializations'] = $this->Masterfile_model->getAllSpecialization();
					$data['search_result']="1";
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}

		public function update_doctor_account(){
			$empid=$this->input->post('empid');
			$save_employee=$this->Masterfile_model->update_doctor_account();
			if($save_employee){
				$this->session->set_flashdata('save_success','Doctor account successfully updated!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to update doctor account!');
			}
			redirect(base_url()."manage_doctor_account/$empid");
		}
		public function add_doctor_access(){
			$empid=$this->input->post('empid');
			$addnew=$this->Masterfile_model->add_doctor_access();
			if($addnew){
				$message="Doctor access successfully added with employee ID $empid.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Doctor account successfully added!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to add doctor access!');
			}
			redirect(base_url()."manage_doctor_account/$empid");
		}

		public function activate_doctor(){
			$save_employee=$this->Masterfile_model->doctorstatus("ACTIVATE");
			if($save_employee){
				$this->session->set_flashdata('save_success','Doctor status successfully updated!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to update doctor status!');
			}
			redirect(base_url()."manage_doctors");
		}
		public function deactivate_doctor(){
			$save_employee=$this->Masterfile_model->doctorstatus("DEACTIVATE");
			if($save_employee){
				$this->session->set_flashdata('save_success','Doctor status successfully updated!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to update doctor status!');
			}
			redirect(base_url()."manage_doctors");
		}

		public function manage_doctor_account($empid){
			if($this->session->user_login){
				$page="manage_doctor_account";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."manage_doctors'>Doctors</a> >> Doctor Accounts";
					$data['employee'] = $this->Masterfile_model->getSingleDoctorByID($empid);
					$data['doctor'] = $this->Masterfile_model->getSingleDoctorByCode($empid);
					$data['access'] = $this->Masterfile_model->getDoctorAccess($empid);
					$data['station'] = $this->Masterfile_model->getAllStation();
					$data['empid'] = $empid;
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile');
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function manage_rooms(){
            if($this->session->user_login){
	            $page="manage_rooms";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['title'] = "Room Manager";
					$data['header']=$this->General_model->getInfo();
					$data['station'] = $this->Masterfile_model->getAllRooms();
					$data['search_result']="";
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}
		public function view_rooms($room){
			$room=str_replace('%20',' ',$room);
            if($this->session->user_login){
	            $page="view_rooms";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['title']="<a href='".base_url()."manage_rooms'>Station</a> >> Beds";
					$data['header']=$this->General_model->getInfo();
					$data['rooms'] = $this->Masterfile_model->getSingleStation($room);
					$data['search_result']="";
					$data['station'] = $room;
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}
		public function save_room(){
			$station=$this->input->post('station');
			$autono=$this->input->post('autono');
			$saveroom=$this->Masterfile_model->save_room();
			if($saveroom){
				if($autono==""){
					$message = "Bed details successfully added!";
					$loginuser = $this->session->fullname;
					$this->General_model->userlogs($message, $loginuser);
					$this->session->set_flashdata('save_success','Bed details successfully added!');
				}else{
					$message = "Bed details successfully updated with room id $autono.";
					$loginuser = $this->session->fullname;
					$this->General_model->userlogs($message, $loginuser);
					$this->session->set_flashdata('save_success','Bed details successfully updated!');
				}
			}else{
				$this->session->set_flashdata('save_failed','Unable to save Bed!');
			}
			redirect(base_url()."view_rooms/".$station);
		}
		public function view_room_search(){
            if($this->session->user_login){
				$room=$this->input->post('station');
				$searchme=$this->input->post('searchme');
	            $page="view_rooms";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['title']="<a href='".base_url()."manage_rooms'>Station</a> >> Beds";
					$data['header']=$this->General_model->getInfo();
					$data['rooms'] = $this->Masterfile_model->getSingleStationByDesc($room,$searchme);
					$data['search_result']="1";
					$data['station'] = $room;
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}
		public function fetch_single_room(){
			$id=$this->input->post('id');
			$data=$this->Masterfile_model->fetch_single_room($id);
			echo json_encode($data);
		}
		public function delete_room($station,$room){
			$addroom=$this->Masterfile_model->delete_room($room);
			if($addroom){
				$this->session->set_flashdata('save_success','Room successfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete room!');
			}
			redirect(base_url()."view_rooms/".$station);
		}
		public function change_room_status($station,$room,$status){
			$addroom=$this->Masterfile_model->change_room_status($room,$status);
			if($addroom){
				$message = "Room status successfully updated with room $room";
				$loginuser = $this->session->fullname;
				$this->General_model->userlogs($message, $loginuser);
				$this->session->set_flashdata('save_success','Room status successfully updated!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to update room status!');
			}
			redirect(base_url()."view_rooms/".$station);
		}
		public function manage_hmo(){
            if($this->session->user_login){
	            $page="manage_hmo";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['title'] = "HMO Manager";
					$data['header']=$this->General_model->getInfo();
					$data['company'] = $this->Masterfile_model->getAllHMO();
					$data['search_result']="";
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}
		public function manage_search_hmo(){
            if($this->session->user_login){
	            $page="manage_hmo";
				if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['title']="General";
					$data['subtitle'] = "HMO Manager";
					$data['company'] = $this->Masterfile_model->getAllSingleHMO();
					$data['search_result']="1";
					$this->load->view('templates/header',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}
		public function fetch_single_hmo(){
			$id=$this->input->post('id');
			$data=$this->Masterfile_model->fetch_single_hmo($id);
			echo json_encode($data);
		}
		public function save_hmo(){
			$id=$this->input->post('hmo_id');
			$addroom=$this->Masterfile_model->save_hmo();
			if($addroom){
				if($id==""){
					$this->session->set_flashdata('save_success','HMO successfully added!');
				}else{
					$this->session->set_flashdata('save_success','HMO successfully updated!');
				}
			}else{
				$this->session->set_flashdata('save_failed','Unable to update HMO!');
			}
			redirect(base_url()."manage_hmo");
		}
		public function update_hmo(){
			$addroom=$this->Masterfile_model->update_hmo();
			if($addroom){
				$this->session->set_flashdata('save_success','HMO successfully updated!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to update HMO!');
			}
			redirect(base_url()."manage_hmo");
		}
		public function delete_hmo($id){
			$addroom=$this->Masterfile_model->delete_hmo($id);
			if($addroom){
				$this->session->set_flashdata('save_success','HMO successfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete HMO!');
			}
			redirect(base_url()."manage_hmo");
		}

		public function manage_diagnostics(){
            if($this->session->user_login){
	            $page="manage_diagnostics";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['title'] = "Manage Diagnostics";
					$data['header']=$this->General_model->getInfo();
					$data['diagnostics'] = $this->Masterfile_model->getAllDiagnostics();
					$data['unit'] =$this->Masterfile_model->getAllDiagnosticUnit();
					$data['types'] =$this->Masterfile_model->getAllDiagnosticType();
					$data['search_result']="";
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}
		public function save_diagnostics(){
			$code=$this->input->post('code');
			$addroom=$this->Masterfile_model->save_diagnostic();
			if($code==""){
				if($addroom){
					$this->session->set_flashdata('save_success','Diagnostic successfully added!');
				}else{
					$this->session->set_flashdata('save_failed','Unable to add new Diagnostic!');
				}
			}else{
				if($addroom){
					$this->session->set_flashdata('save_success','Diagnostic successfully updated!');
				}else{
					$this->session->set_flashdata('save_failed','Unable to update Diagnostic!');
				}
			}
			redirect(base_url()."manage_diagnostics");
		}

		public function fetch_single_diagnostic(){
			$id=$this->input->post('id');
			$data=$this->Masterfile_model->fetch_single_diagnostic($id);
			echo json_encode($data);
		}
		public function delete_diagnostic($code){
			$addroom=$this->Masterfile_model->delete_diagnostic($code);
			if($addroom){
				$this->session->set_flashdata('save_success','Diagnostic successfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete Diagnostic!');
			}
			redirect(base_url()."manage_diagnostics");
		}

		public function manage_others(){
            if($this->session->user_login){
	            $page="manage_others";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['title'] = "Other Items Manager";
					$data['header']=$this->General_model->getInfo();
					$data['diagnostics'] = $this->Masterfile_model->getAllOthers();
					$data['unit'] =$this->Masterfile_model->getAllOtherUnit();
					$data['types'] =$this->Masterfile_model->getAllOtherType();
					$data['search_result']="";
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}

		public function save_others(){
			$code=$this->input->post('code');
			$addroom=$this->Masterfile_model->save_others();
			if($code==""){
				if($addroom){
					$this->session->set_flashdata('save_success','Item successfully added!');
				}else{
					$this->session->set_flashdata('save_failed','Unable to add new Item!');
				}
			}else{
				if($addroom){
					$this->session->set_flashdata('save_success','Item successfully updated!');
				}else{
					$this->session->set_flashdata('save_failed','Unable to update item!');
				}
			}
			redirect(base_url()."manage_others");
		}

		public function update_others(){
			$addroom=$this->Masterfile_model->update_others();
			if($addroom){
				$this->session->set_flashdata('save_success','Item successfully updated!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to update item!');
			}
			redirect(base_url()."manage_others");
		}
		public function delete_others($code){
			$addroom=$this->Masterfile_model->delete_diagnostic($code);
			if($addroom){
				$this->session->set_flashdata('save_success','Item successfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete item!');
			}
			redirect(base_url()."manage_others");
		}

	public function manage_address(){
            if($this->session->user_login){
	            $page="manage_address";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['title'] = "Province Manager";
					$data['header']=$this->General_model->getInfo();
					$data['province'] = $this->Masterfile_model->getAllProvince();
					$data['search_result']="";
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}
		public function save_address(){
			$id=$this->input->post('id');
			$addroom=$this->Masterfile_model->save_address();
			if($id=="") {
				if ($addroom) {
					$this->session->set_flashdata('save_success', 'Province successfully added!');
				} else {
					$this->session->set_flashdata('save_failed', 'Unable to add new Province!');
				}
			}else{
				if($addroom){
					$this->session->set_flashdata('save_success','Province successfully updated!');
				}else{
					$this->session->set_flashdata('save_failed','Unable to update province!');
				}
			}
			redirect(base_url()."manage_address");
		}

		public function delete_province($code){
			$addroom=$this->Masterfile_model->delete_province($code);
			if($addroom){
				$this->session->set_flashdata('save_success','Province successfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete province!');
			}
			redirect(base_url()."manage_address");
		}

		public function manage_city($province){
            if($this->session->user_login){
	            $page="manage_city";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['title'] = "<a href='".base_url()."manage_address'>Province </a>>> City/Municipality Manager";
					$data['header']=$this->General_model->getInfo();
					$data['municipality'] = $this->Masterfile_model->getAllCity($province);
					$data['province']=$province;
					$data['search_result']="";
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}

		public function save_city(){
			$id=$this->input->post('id');
			$province=$this->input->post('prov_id');
			$addroom=$this->Masterfile_model->save_city();
			if($id=="") {
				if ($addroom) {
					$this->session->set_flashdata('save_success', 'City successfully added!');
				} else {
					$this->session->set_flashdata('save_failed', 'Unable to add new City!');
				}
			}else{
				if($addroom){
					$this->session->set_flashdata('save_success','City successfully updated!');
				}else{
					$this->session->set_flashdata('save_failed','Unable to update city!');
				}
			}
			redirect(base_url()."manage_city/".$province);
		}

		public function manage_barangay($city,$province){
            if($this->session->user_login){
	            $page="manage_barangay";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['title'] = "<a href='".base_url()."manage_address'>Province </a>>> <a href='".base_url()."manage_city/$province'>City/Municipality</a> >> Barangay Manager";
					$data['header']=$this->General_model->getInfo();
					$data['barangay'] = $this->Masterfile_model->getAllBarangay($city);
					$data['province']=$province;
					$data['city']=$city;
					$data['search_result']="";
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}

		public function save_barangay(){
			$id=$this->input->post('id');
			$province=$this->input->post('prov_id');
			$city=$this->input->post('city_id');
			$addroom=$this->Masterfile_model->save_barangay();
			if($id=="") {
				if ($addroom) {
					$this->session->set_flashdata('save_success', 'Barangay successfully added!');
				} else {
					$this->session->set_flashdata('save_failed', 'Unable to add new barangay!');
				}
			}else{
				if($addroom){
					$this->session->set_flashdata('save_success','Barangay successfully updated!');
				}else{
					$this->session->set_flashdata('save_failed','Unable to update barangay!');
				}
			}
			redirect(base_url()."manage_barangay/".$city."/".$province);
		}
		public function fetch_single_province(){
			$id=$this->input->post('id');
			$data=$this->Masterfile_model->getSingleProvince($id);
			echo json_encode($data);
		}
		public function fetch_single_city(){
			$id=$this->input->post('id');
			$data=$this->Masterfile_model->getSingleCity($id);
			echo json_encode($data);
		}
		public function fetch_single_barangay(){
			$id=$this->input->post('id');
			$data=$this->Masterfile_model->getSingleBarangay($id);
			echo json_encode($data);
		}
		public function delete_barangay($id,$city,$province){
			$delete=$this->Masterfile_model->delete_barangay($id);
			if($delete){
				$this->session->set_flashdata('save_success','Barangay successfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete barangay!');
			}
			redirect(base_url()."manage_barangay/".$city."/".$province);
		}
		public function delete_city($city,$province){
			$delete=$this->Masterfile_model->delete_city($city);
			if($delete){
				$this->session->set_flashdata('save_success','City/Municipality successfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete city/municipality!');
			}
			redirect(base_url()."manage_city/".$province);
		}

		public function manage_religion(){
			if($this->session->user_login){
				$page="manage_religion";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['title'] = "Religion Manager";
					$data['header']=$this->General_model->getInfo();
					$data['religion'] = $this->General_model->getReligion();
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_religion(){
			$id=$this->input->post('id');
			$save=$this->Masterfile_model->save_religion();
			if($save) {
				if ($id == "") {
					$this->session->set_flashdata('save_success','Religion successfully added!');
				}else{
					$this->session->set_flashdata('save_success','Religion successfully updated!');
				}
			}else{
				$this->session->set_flashdata('save_failed','Unable to add/update religion!');
			}
			redirect(base_url()."manage_religion");
		}
		public function delete_religion($id){
			$delete=$this->Masterfile_model->delete_religion($id);
			if($delete){
				$this->session->set_flashdata('save_success','Religion successfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete religion!');
			}
			redirect(base_url()."manage_religion");
		}

		public function manage_station(){
			if($this->session->user_login){
				$page="manage_station";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['title'] = "Station Manager";
					$data['header']=$this->General_model->getInfo();
					$data['station'] = $this->General_model->getStation();
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_station(){
			$id=$this->input->post('id');
			$save=$this->Masterfile_model->save_station();
			if($save) {
				if ($id == "") {
					$this->session->set_flashdata('save_success','Station successfully added!');
				}else{
					$this->session->set_flashdata('save_success','Station successfully updated!');
				}
			}else{
				$this->session->set_flashdata('save_failed','Unable to add/update station!');
			}
			redirect(base_url()."manage_station");
		}
		public function delete_station($id){
			$delete=$this->Masterfile_model->delete_station($id);
			if($delete){
				$this->session->set_flashdata('save_success','Station successfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete station!');
			}
			redirect(base_url()."manage_station");
		}

		public function manage_nationality(){
			if($this->session->user_login){
				$page="manage_nationality";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['title'] = "Nationality Manager";
					$data['header']=$this->General_model->getInfo();
					$data['nationality'] = $this->General_model->getNationality();
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_nationality(){
			$id=$this->input->post('id');
			$save=$this->Masterfile_model->save_nationality();
			if($save) {
				if ($id == "") {
					$this->session->set_flashdata('save_success','Nationality successfully added!');
				}else{
					$this->session->set_flashdata('save_success','Nationality successfully updated!');
				}
			}else{
				$this->session->set_flashdata('save_failed','Unable to add/update nationality!');
			}
			redirect(base_url()."manage_nationality");
		}
		public function delete_nationality($id){
			$delete=$this->Masterfile_model->delete_nationality($id);
			if($delete){
				$this->session->set_flashdata('save_success','Nationality successfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete nationality!');
			}
			redirect(base_url()."manage_nationality");
		}

		public function manage_accounttitle(){
			if($this->session->user_login){
				$page="manage_accounttitle";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['title'] = "Account Title Manager";
					$data['header']=$this->General_model->getInfo();
					$data['nationality'] = $this->General_model->getAllAccountTitle();
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_accounttitle(){
			$id=$this->input->post('id');
			$save=$this->Masterfile_model->save_accounttitle();
			if($save) {
				if ($id == "") {
					$this->session->set_flashdata('save_success','Account Title successfully added!');
				}else{
					$this->session->set_flashdata('save_success','Account Title successfully updated!');
				}
			}else{
				$this->session->set_flashdata('save_failed','Unable to add/update account title!');
			}
			redirect(base_url()."manage_accounttitle");
		}
		public function delete_accounttitle($id){
			$delete=$this->Masterfile_model->delete_accounttitle($id);
			if($delete){
				$this->session->set_flashdata('save_success','Account Title successfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete account title!');
			}
			redirect(base_url()."manage_accounttitle");
		}

		public function manage_autocharge(){
			if($this->session->user_login){
				$page="manage_autocharge";
				if(!file_exists(APPPATH.'views/pages/masterfile/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['title'] = "Admission Autocharge Manager";
					$data['header']=$this->General_model->getInfo();
					$data['autocharge'] = $this->Masterfile_model->getAutocharge();
					$data['items'] = $this->Masterfile_model->getItems();
					$this->load->view('templates/headerMasterfile',$data);
					$this->load->view('pages/masterfile/'.$page,$data);
					$this->load->view('templates/modalMasterfile',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_autocharge(){
			$save=$this->Masterfile_model->save_autocharge();
			if($save) {
					$this->session->set_flashdata('save_success','Item successfully added!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to add item!');
			}
			redirect(base_url()."manage_autocharge");
		}
		public function delete_autocharge($id){
			$delete=$this->Masterfile_model->delete_autocharge($id);
			if($delete){
				$this->session->set_flashdata('save_success','Item successfully removed!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to remove item!');
			}
			redirect(base_url()."manage_autocharge");
		}
		//==============================End of Masterfile Module=================================

		//==============================Start of SCM Module======================================
		public function purchase_request(){
			if($this->session->user_login){
				$page="purchase_request";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Purchase Requisition";
					$data['purchases'] = $this->Purchase_model->getAllPO();
					$data['suppliers'] = $this->Purchase_model->getAllSuppliers();
					$data['station'] = $this->General_model->getStation();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($this->session->pono){
						$this->session->unset_userdata('pono');
						$this->session->unset_userdata('supplier');
						$this->session->unset_userdata('reqdept');
						$this->session->unset_userdata('terms');
						$this->session->unset_userdata('trantype');
						$this->session->unset_userdata('reqdate');
					}
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function create_request(){
				$pono = $this->General_model->generatePONo('POBROK',$this->session->fullname);
				$this->session->set_userdata('pono',$pono);
				$this->session->set_userdata('supplier',$this->input->post('supplier'));
				$this->session->set_userdata('reqdept',$this->input->post('reqdept'));
				$this->session->set_userdata('terms',$this->input->post('terms'));
				$this->session->set_userdata('trantype',$this->input->post('trantype'));
				$this->session->set_userdata('reqdate',$this->input->post('reqdate'));
				redirect(base_url()."manage_purchase_request");
		}
		public function manage_request($pono,$supplier,$reqdept,$terms,$trantype,$reqdate){
			$supplier=str_replace('%20',' ',$supplier);
			$supplier=str_replace(',','',$supplier);
			$this->session->set_userdata('pono',$pono);
			$this->session->set_userdata('supplier',$supplier);
			$this->session->set_userdata('reqdept',$reqdept);
			$this->session->set_userdata('terms',$terms);
			$this->session->set_userdata('trantype',$trantype);
			$this->session->set_userdata('reqdate',$reqdate);
			redirect(base_url()."manage_purchase_request");
		}
		public function manage_purchase_request(){
			if($this->session->user_login){
				if($this->session->pono){

				}else{
					redirect(base_url()."purchase_request");
				}
				$page="manage_purchase_request";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Manage Purchase Request";
					$dept=$this->session->dept;
					$pono=$this->session->pono;
					$supplier=explode('_',$this->session->supplier);
					$data['suppliername'] = $supplier[1];
					$data['suppliercode'] = $supplier[0];
					$data['reqdept'] = $this->session->reqdept;
					$data['terms'] = $this->session->terms;
					$data['trantype'] = $this->session->trantype;
					$data['transdate'] = $this->session->reqdate;
					$data['pono'] = $pono;
					$data['invoice'] = $this->Purchase_model->getInvoice($pono);
					$data['items'] = $this->Purchase_model->getItemsPO($pono);
					$data['itemdept'] = $this->Purchase_model->getAllItemsByDept($dept);
					$data['department'] = $dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function fetch_single_requested_item(){
			$id=$this->input->post('id');
			$data=$this->Purchase_model->fetch_single_requested_item($id);
			echo json_encode($data);
		}
		public function poadditem(){
			$addtolist=$this->Purchase_model->request_add_item();
			if($addtolist){
				$this->session->set_flashdata('add_success','Item successfully added!');
			}else{
				$this->session->set_flashdata('add_failed','Unable to add item!');
			}
			redirect(base_url()."manage_purchase_request");
		}

		public function remove_requested_item($code){
			$remove=$this->Purchase_model->remove_requested_item($code);
			if($remove){
				$this->session->set_flashdata('remove_success','Item successfully removed!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to remove item!');
			}
			redirect(base_url()."manage_purchase_request");
		}
		public function po_print($pono){
			if($this->session->user_login){
				$page="po_print";
				$supplier=explode('_',$this->session->supplier);
				$suppliercode=$supplier[0];
				$suppliername=$supplier[1];
				$pono=$this->session->pono;
				$reqdept = $this->session->reqdept;
				$terms = $this->session->terms;
				$trantype = $this->session->trantype;
				$transdate = $this->session->reqdate;
				$add=$this->Purchase_model->getSingleSupplier($suppliercode);
				$supplieraddress=$add['address'];
				$data['body']=$this->Purchase_model->poprintbody($pono);
				$invoice = $this->Purchase_model->getInvoice($pono);
				$gross=0;
				$discount=0;
				$total=0;
				foreach ($data['body'] as $item){
					$gross += $item['prodqty'] * $item['unitcost'];
					if($item['prodtype1'] > 0){
						$discount += $item['prodqty'] * $item['prodtype1'];
					}else{
						$discount += $item['prodqty'] * $item['unitcost'];
					}


				}
				if($reqdept=="CPU" || $reqdept=="CSR" || $reqdept=="CPU-RDU"){
					$requser="JIHAN S. KUSAIN, RPh";
					$role="Purchasing Officer";
				}else{					
					$requser="JUDILYN P. ABUAN, RPh";
					$role="Pharmacy Head";
				}
				$total=$gross-$discount;
				$header=$this->General_model->getInfo();
				$html = $this->load->view('pages/supplychain/'.$page,$data,true);
				$mpdf = new \Mpdf\Mpdf([
					'margin_top' => 78,
					'margin_left' => 10,
					'margin_right' => 10,
					'margin_bottom' => 120,
					'format' => 'letter'
				]);
				$mpdf->setHTMLHeader('
            <div style="text-align:center;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                     <td width="20">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                    <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:13px;">'.$header['address'].'</font><br>
                    <font style="font-size:13px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="30">&nbsp;</td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="1" style="font-family:Arial,Helvetica; font-size: 12px;">
             <tr>
                <td align="right">P.O. No.: </td>
                 <td width="20%" align="right"><b>'.$pono.'</b></td>
                 </tr>
                 <tr>
               <td align="right">Date: </td>
                 <td width="20%" align="right"><b>'.date("m/d/Y",strtotime($transdate)).'</b></td>
                 </tr>
                 <tr>
                 <td align="right">Terms: </td>
                 <td width="20%" align="right"><b>'.$terms.'</b></td>
                 </tr>
             </table>
			 <center><h4>PURCHASE ORDER</h4></center>
			 <table width="100%" border="1" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;border-collapse:collapse;">
             <tr>
                <td width="10%">To: </td>
                 <td><b>'.$suppliername.'</b></td>
                 </tr>
                 <tr>
				 <td>Address: </td>
                 <td><b>'.$supplieraddress.'</b></td>
                 </tr>
                 <tr>
             </table>
             <br>
             <table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;border-collapse:collapse;">
                <tr>
					 <td align="center" width="41%" style="border-bottom:0;"><b>DESCRIPTION</b></td>
					 <td align="center" width="5%" style="border-bottom:0;"><b>QTY</b></td>
					 <td align="center" width="9%" style="border-bottom:0;"><b>UNIT</b></td>
					 <td align="center" width="15%" style="border-bottom:0;"><b>ORIG U PRICE</b></td>
					 <td align="center" width="15%" style="border-bottom:0;"><b>DISC U PRICE</b></td>
					 <td align="center" width="15%" style="border-bottom:0;"><b>AMOUNT</b></td>
				 </tr>
                 </table>
             </div>
            ');
				$mpdf->setHTMLFooter('<div>
            <table width="100%" border="0" cellspacing="1" cellpadding="0" style="font-family: Arial, Helvetica;font-size: 10px;">
            <tr>
            	<td colspan="2"><b><i>REMARKS: '.$invoice['remarks'].'</i></b></td>
            </tr>
            <tr>
            	<td colspan="2">&nbsp;</td>
            </tr>
			<tr>
                    <td style="vertical-align:top;border-top:1px solid black;"><b>TOTAL GROSS</b></td>
                    <td align="right" style="border-top:1px solid black;"><u><b>'.number_format($gross,2).'</b></u></td>
                </tr>
				<tr>
                    <td style="vertical-align:top;"><b>TOTAL DISCOUNT</b></td>
                    <td align="right"><u><b>'.number_format($total,2).'</b></u></td>
                </tr>
				<tr>
                    <td style="vertical-align:top;"><b>NET AMOUNT</b></td>
                    <td align="right"><u><b>'.number_format($discount,2).'</b></u></td>
                </tr>
				<tr>
					<td colspan="2" style="border-bottom:1px solid black;"></td>
				</tr>
                <tr>
                    <td style="vertical-align:top;"><b><u>THIS ORDER IS SUBJECT TO THE FOLLOWING CONDITION:</u></b></td>
                    <td align="center">Accepted Order and Receiving<br>Original</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"></td>
                    <td align="center" width="25%">By:__________________________________</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;">
                    1. The above purchase are subject to inspection and analysis by our Purchasing/Accounting department<br>
                    &nbsp;&nbsp;&nbsp;and payment will not be made and delivery will not be accepted of any of the specifications are not met.<br>
                    2. Failure to comply with any of the following gives buyer the right to cancel all or any part of this order.<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;a. All packages and delivery must bear this purchase order.<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;b. Goods must confirm quantity, description and specification set forth above including price and<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;c. Delivery must be properly packed.<br>
                    3. All invoice must be rendered immediately after delivery with the acomplished original Purchase Order.<br>
                    4. The seller guarantee the materials identified herein shall be without defect.<br>
                    5. Any defects identified shall not be noted in the invoice by the seller.<br>
                    </td>
                    <td align="center" width="25%"  style="vertical-align:top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorized Signature of Supplier</td>
                </tr>
                <tr>
                <td colspan="2">&nbsp;</td>
                </tr>
                </table>
                <table width="100%" border="0" style="font-family:Arial, Helvetica, sans-serif; font-size:10px;">
                <tr>
                    <td style="vertical-align:top;"><b>Note: <u>Please deliver Longer Expiry of Medicine and Supplies!</u></b></td>
                    <td align="center" width="25%"></td>
                </tr>
                <tr>
                <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><b>Prepared by:</u></b></td>
                    <td width="50%"><b>Approved by:</b></td>
                </tr>
                <tr>
                <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><b><u>'.$requser.'</u></b></td>
                    <td width="50%"></td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><b>'.$role.'</b></td>
                    <td width="50%">___________________________________</td>
                </tr>
                <tr>
                <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><b>Reviewed by:</u></b></td>
                    <td width="50%">___________________________________</td>
                </tr>
                <tr>
                <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><b>__________________________________</b></td>
                    <td width="50%">___________________________________</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><b>FINANCE OFFICER</u></b></td>
                    <td width="50%"></td>
                </tr>
            </table>
            </div>');
				$mpdf->autoPageBreak = true;
				$mpdf->WriteHTML($html);
				$mpdf->Output();
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function pr_print($pono){
			if($this->session->user_login){
				$page="pr_print";
				$supplier=explode('_',$this->session->supplier);
				$suppliercode=$supplier[0];
				$suppliername=$supplier[1];
				$pono=$this->session->pono;
				$reqdept = $this->session->reqdept;
				$terms = $this->session->terms;
				$trantype = $this->session->trantype;
				$transdate = $this->session->reqdate;
				$data['body']=$this->Purchase_model->poprintbody($pono);
				$header=$this->General_model->getInfo();
				$html = $this->load->view('pages/supplychain/'.$page,$data,true);
				$mpdf = new \Mpdf\Mpdf([
					'margin_top' => 64.5,
					'margin_left' => 10,
					'margin_right' => 10,
					'margin_bottom' => 10,
					'format' => 'letter'
				]);
				$mpdf->setHTMLHeader('
            <div style="text-align:center;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                     <td width="20">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                    <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:13px;">'.$header['address'].'</font><br>
                    <font style="font-size:13px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="30">&nbsp;</td>
              </tr>
            </table>
			 <center><h4>PURCHASE REQUISITION SLIP</h4></center>
			 <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
             <tr>
                <td width="20%">Department: </td>
                 <td><b>'.$reqdept.'</b></td>
                 <td width="20%">PR No.: </td>
                  <td><b>'.$pono.'</b></td>
                 </tr>
                 <tr>
				 <td>Name of Company: </td>
                 <td><b>'.$suppliername.'</b></td>
                 <td>PR Date: </td>
                         <td><b>'.date("m/d/Y",strtotime($transdate)).'</b></td>
                 </tr>
                 <tr>
             </table>
             <br>
             <table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:10px;border-collapse:collapse;">
                <tr>
					 <td align="center" width="41%" style="border-bottom:0;"><b>DESCRIPTION</b></td>
           <td align="center" width="10%" style="border-bottom:0;"><b>DATE<br />LAST RR</b></td>
					 <td align="center" width="10%" style="border-bottom:0;"><b>LAST QTY<br />RECEIVED</b></td>
					 <td align="center" width="11%" style="border-bottom:0;"><b>REMAINING<br />BALANCE</b></td>
					 <td align="center" width="10%" style="border-bottom:0;"><b>QTY<br />ORDERED</b></td>
           <td align="center" width="7%" style="border-bottom:0;"><b>ORIG U PRICE</b></td>
           <td align="center" width="7%" style="border-bottom:0;"><b>DISC U PRICE</b></td>
					 <td align="center" width="10%" style="border-bottom:0;"><b>AMOUNT</b></td>
				 </tr>
                 </table>
             </div>
            ');
				$mpdf->autoPageBreak = true;
				$mpdf->WriteHTML($html);
				$mpdf->Output();
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function pr_study($pono){
			if($this->session->user_login){
				$page="pr_study";
				$supplier=explode('_',$this->session->supplier);
				$suppliercode=$supplier[0];
				$suppliername=$supplier[1];
				$pono=$this->session->pono;
				$reqdept = $this->session->reqdept;
				$terms = $this->session->terms;
				$trantype = $this->session->trantype;
				$transdate = $this->session->reqdate;
				$data['body']=$this->Purchase_model->poprintbody($pono);
				$data['transdate'] = $transdate;
				$header=$this->General_model->getInfo();
				$html = $this->load->view('pages/supplychain/'.$page,$data,true);
				$mpdf = new \Mpdf\Mpdf([
					'margin_top' => 63.5,
					'margin_left' => 10,
					'margin_right' => 10,
					'margin_bottom' => 10,
					'format' => 'Folio',
					'orientation' => 'L'
				]);
				$mpdf->setHTMLHeader('
            <div style="text-align:center;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                     <td width="20">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                    <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:13px;">'.$header['address'].'</font><br>
                    <font style="font-size:13px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="30">&nbsp;</td>
              </tr>
            </table>
			 <center><h4>PURCHASE REQUISITION STUDY</h4></center>
			 <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
                 <tr>
				 <td width="15%">Name of Company: </td>
                 <td><b>'.$suppliername.'</b></td>
                 </tr>
                 <tr>
                 <td width="15%">Date of Inventory: </td>
                         <td><b>'.date("m/d/Y",strtotime($transdate)).'</b></td>
                 </tr>
                 <tr>
             </table>
             <br>
             <table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:10px;border-collapse:collapse;">
                <tr>
					 <td align="center" width="41%" style="border-bottom:0;"><b>DESCRIPTION</b></td>
           <td align="center" width="10%" style="border-bottom:0;"><b>DATE<br />LAST RR</b></td>
           <td align="center" width="5%" style="border-bottom:0;"><b>QUANTITY<br />ON HAND</b></td>
					 <td align="center" width="5%" style="border-bottom:0;"><b>LAST QTY<br />RECEIVED</b></td>
					 <td align="center" width="5%" style="border-bottom:0;"><b>QUANTITY<br />LEFT</b></td>
           <td align="center" width="5%" style="border-bottom:0;"><b>QUANTITY<br />USED</b></td>
           <td align="center" width="5%" style="border-bottom:0;"><b>DAYS<br />INV</b></td>
           <td align="center" width="10%" style="border-bottom:0;"><b>AVERAGE<br />DAILY USAGE</b></td>
           <td align="center" width="10%" style="border-bottom:0;"><b>RECOMM. 60<br />STOCK LEVEL</b></td>
					 <td align="center" width="5%" style="border-bottom:0;"><b>QTY<br />ORDERED</b></td>
           <td align="center" width="7%" style="border-bottom:0;"><b>ORIG U PRICE</b></td>
           <td align="center" width="7%" style="border-bottom:0;"><b>DISC U PRICE</b></td>
					 <td align="center" width="10%" style="border-bottom:0;"><b>AMOUNT</b></td>
				 </tr>
                 </table>
             </div>
            ');
				$mpdf->autoPageBreak = true;
				$mpdf->WriteHTML($html);
				$mpdf->Output();
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function fetch_requested_item(){
			$id=$this->input->post('id');
			$data=$this->Purchase_model->fetch_requested_item($id);
			echo json_encode($data);
		}
		public function update_requested_item(){
			$update=$this->Purchase_model->request_update_item();
			if($update){
				$this->session->set_flashdata('remove_success','Item successfully updated!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to update item!');
			}
				redirect(base_url()."manage_purchase_request");

		}
		public function update_receive_item(){
			$update=$this->Purchase_model->request_update_item();
			if($update){
				$this->session->set_flashdata('remove_success','Item successfully updated!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to update item!');
			}
				redirect(base_url()."manage_receiving/".$this->input->post('pono'));
		}

		public function purchase_receiving(){
			if($this->session->user_login){
				$page="purchase_receiving";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Purchase Receiving";
					$data['purchases'] = $this->Purchase_model->getAllPO();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($this->session->pono){
						$this->session->unset_userdata('pono');
						$this->session->unset_userdata('supplier');
						$this->session->unset_userdata('reqdept');
						$this->session->unset_userdata('terms');
						$this->session->unset_userdata('trantype');
						$this->session->unset_userdata('reqdate');
					}
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function manage_receiving($pono){
			if($this->session->user_login){
				$page="manage_receiving";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Manage Receiving";
					$data['purchases'] = $this->Purchase_model->getItemsPO($pono);
					$data['invoice'] = $this->Purchase_model->getInvoice($pono);
					$data['supplier']=$this->Purchase_model->getAllSuppliers();
					$data['pono'] = $pono;
					$data['department'] = $this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_invoice(){
			$invno=$this->input->post('invno');
			$pono=$this->input->post('pono');
			$data=$this->Purchase_model->checkInvoice($pono,$invno);
			if(count($data)>0){
				echo json_encode($data);
			}else{
				$this->Purchase_model->save_invoice($invno,$pono);
				echo json_encode($data);
			}
		}
		public function save_remark(){
			$invno=$this->input->post('invno');
			$pono=$this->input->post('pono');
			$data=$this->Purchase_model->save_remarks($invno,$pono);
			echo json_encode($data);
		}
		public function save_quantity(){
			$recqty=$this->input->post('recqty');
			$rrdetails=$this->input->post('rrdetails');
			$lotno=$this->input->post('lotno');
			$vat=$this->input->post('tax');
			$expiration=$this->input->post('expiration');
			$d=count($rrdetails);
			for($i=0;$i<$d;$i++){
				$data=$this->Purchase_model->save_quantity($rrdetails[$i],$recqty[$i],$lotno[$i],$vat[$i],$expiration[$i]);
			}
			echo json_encode($data);
		}
		public function preview_receiving($pono,$invno){
			$page="receiving_report";
			$head=$this->Purchase_model->getPODetailsHeader($pono,$invno);
			$header=$this->General_model->getInfo();
			$supplier=$head['supplier'];
			$rrno="";
			$transdate="";
			$data['body'] = $this->Purchase_model->getItemsPO($pono);
			$html=$this->load->view('pages/supplychain/'.$page, $data,true);
			$foot=$this->Purchase_model->getItemsPO($pono);
			$totalgross=0;
			$def=0;
			$itax=0;
			foreach($foot as $f){
				if($f['quantity']>0){
					if($f['trantype']=="FREE GOODS"){
						if ($f['prodtype1'] > 0) {
							$def += $f['prodtype1'] * $f['quantity'];
						} else {
							$def += $f['unitcost'] * $f['quantity'];
						}
					}else {
						if ($f['prodtype1'] > 0) {
							$ucost=$f['prodtype1'] * $f['quantity'];
						} else {
							$ucost=$f['unitcost'] * $f['quantity'];
						}
						$totalgross +=round($ucost,2);
						if($f['vat'] > 0){
							$tax = $ucost/1.12;
							$itax +=$ucost-$tax;
						}
					}
				}
			}
			$inventory="";
			$footer=$this->Purchase_model->getPODetailsFooter($pono);
			$ewtax=0;
			foreach($footer as $fr){
				$tot=0;
				
				if($fr['trantype']=="FREE GOODS"){
					$fg=" FG ";
				}else{
					$fg="";
				}
				$dept=$fr['reqdept'];
				$foot=$this->Purchase_model->getPODetailsFoot($pono,$fr['trantype'],$fr['unit']);
				foreach($foot as $ft){
					$tax=0;
					if($ft['trantype']=="FREE GOODS"){
						if($ft['prodtype1'] > 0){
							$ucost=$ft['prodtype1']*$ft['quantity'];
						}else{
							$ucost=$ft['unitcost']*$ft['quantity'];
						}
					}else {
						if ($ft['prodtype1'] > 0) {
							$ucost = $ft['prodtype1'] * $ft['quantity'];
						} else {
							$ucost = $ft['unitcost'] * $ft['quantity'];
						}
						if ($ft['vat'] > 0) {
							$tax = $ucost - ($ucost / 1.12);
						}
						$ewtax += ($ucost-$tax)*.01;
					}
					$tot += $ucost-$tax;
				}
				$inventory .='
                    <tr>
                    <td width="5%">&nbsp;</td>
                    <td width="55%">INVENTORY - '.$fr['unit'].' '.$fg.' ('.$dept.')</td>
                    <td align="right" width="20%">'.number_format($tot,2).'</td>
                    <td align="right" width="20%">'.number_format(0,2).'</td>
                    </tr>
                    ';
			}
			$accountpayable=$totalgross-$def;
			if($supplier=="KMSCI CSR"){
				$handfee=$totalgross*.01;
			}else{
				$handfee=0;
			}
			if($itax==0){
				$itax = $totalgross*.12;
				$itax1 = $itax;
				$itaxdesc= "NV";
				$itaxdesc1= "NV";				
			}else{
				$itaxdesc= "GOODS";
				$itaxdesc1= "";
				$itax1=0;
			}
			if(strpos($invno,'DR') !== false){
			$itax=0;
			$itax1=0;
			$ewtax=0;
		}
if($itax1 > 0){
			$nv='
			<tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;INPUT TAX - '.$itaxdesc1.'</td>
            <td align="right" width="20%">'.number_format(0,3).'</td>
            <td align="right" width="20%">'.number_format($itax1,3).'</td>
            </tr>
			';
		}else{
			$nv="";
		}
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 59,
				'margin_left' => 5,
				'margin_right' => 10,
				'margin_bottom' => 85,
				//'format' => [215.9,137.5],
				'format' => 'Letter',
				'orientation' => 'L'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:center;font-family:Arial;">
             <table width="500" border="0" cellspacing="0" cellpadding="0">
             <tr>
             <td width="20">&nbsp;</td>
             <td width="80"></td>
            <td align="center" style="font-family:Arial;"><b style="font-size:10px;">Republic of the Philippines</td>
          <td width="30">&nbsp;</td>
      </tr>
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="50"><img src="'.base_url().'design/images/kmsci.png" width="50"></td>
                    <td align="center" style="font-family:Arial;"><b style="font-size:12px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <center style="width:500px;"><h4>RECEIVING REPORT</h4></center>
            <table width="500" border="0" cellspacing="1" cellpadding="1" style="font-family:Arial,Helvetica; font-size: 10px;">
             <tr>
                <td align="right">Supplier: </td>
                 <td><b>'.$supplier.'</b></td>
                 <td align="right">R.R. No.: </td>
                 <td><b>'.$rrno.'</b></td>
                 </tr>
                 <tr>
                <td align="right"  width="70">Invoice No.: </td>
                 <td><b>'.$invno.'</b></td>
                 <td align="right">P.O No.: </td>
                 <td><b>'.$pono.'</b></td>
                 </tr>
                 <tr>
                 <td align="right">Date: </td>
                 <td><b>'.$transdate.'</b></td>
                 <td align="right"></td>
                 <td></td>
                 </tr>
             </table>
             <table width="400" border="1" cellspacing="0" cellpadding="0" style="font-family:Arial;font-size:9px;border-collapse: collapse;">
                <tr>
					 <td align="center" width="5%">Qty</td>
					 <td align="center" width="9%">Unit</td>
					 <td align="center" width="39%">Description</td>
					 <td align="center" width="6%">Conv</td>
					 <td align="center" width="7%">Whr</td>
					 <td align="center" width="11%">Unit<br>Price</td>
                     <td align="center" width="10%">Disc<br>Price</td>
                     <td align="center" width="12%">Gross</td>
                     <td align="center" width="11%">Vat</td>
                     <td align="center" width="12%">Net</td>
				 </tr>
                 </table>
             </div>
            ');
			$mpdf->setHTMLFooter('
            <div>

            <table width="500" border="0" cellspacing="0" cellpadding="1" style="font-size:12px;">
                <tr>
                    <td width="80%" align="right" $view>Total Gross:</td>
                    <td width="20%" align="right" $view><b>'.number_format($totalgross,2).'</b></td>
                </tr>
                <tr $view>
                    <td width="80%" align="right">Handling Fee (1%):</td>
                    <td width="20%" align="right"><b>'.number_format($handfee,2).'</b></td>
                </tr>
                <tr>
                    <td width="80%" align="right" style="border-top:1px solid black;">Total:</td>
                    <td width="20%" style="border-bottom:1px solid; border-top:1px solid black;" align="right"><b>'.number_format($totalgross+$handfee,2).'</b></td>
                </tr>
            </table>
            <br>
            <table width="500" border="0" cellspacing="0" cellpadding="1" style="font-size:11px;">
            <tr>
            <td colspan="2">Journal Entries</td>
            <td align="right"><b>Debit</b></td>
            <td align="right"><b>Credit</b></td>
            </tr>
            '.$inventory.'
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">INPUT TAX</td>
            <td align="right" width="20%">'.number_format($itax,3).'</td>
            <td align="right" width="20%">'.number_format(0,3).'</td>
            </tr>
            '.$nv.'
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">DEFERRED INCOME - </td>
            <td align="right" width="20%">'.number_format(0,3).'</td>
            <td align="right" width="20%">'.number_format($def,3).'</td>
            </tr>
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">FREIGHT IN - </td>
            <td align="right" width="20%">'.number_format($handfee,3).'</td>
            <td align="right" width="20%">'.number_format(0,3).'</td>
            </tr>
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">EXPANDED WTAX - </td>
            <td align="right" width="20%">'.number_format(0,3).'</td>
            <td align="right" width="20%">'.number_format($ewtax,3).'</td>
            </tr>
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">ACCOUNTS PAYABLE-TRADE</td>
            <td align="right" width="20%" style="border-bottom:1px solid;">'.number_format(0,3).'</td>
            <td align="right" width="20%" style="border-bottom:1px solid;">'.number_format($totalgross+$handfee-$ewtax,3).'</td>
            </tr>
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">&nbsp;</td>
            <td align="right" width="20%">'.number_format($totalgross+$handfee+$def,3).'</td>
            <td align="right" width="20%">'.number_format($totalgross+$handfee+$def,3).'</td>
            </tr>
            </table>
            <br>
            <br>
            <br>
            <table width="500" border="0" cellspacing="0" cellpadding="1" style="font-size:8px;">
            <tr>
            <td style="border-top:1px solid black;" colspan="4">&nbsp;</td>
            </tr>
            <tr>
            <td width="25%">Prepared by:_______________</td>
            <td width="25%">Checked by:_______________</td>
            <td width="25%">Reviewed by:_______________</td>
            <td width="25%">Noted/Verified by:_______________</td>
            </tr>
            </table>
            </div>
            ');
			$mpdf->SetWatermarkText('PREVIEW');
			$mpdf->showWatermarkText = true;
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function post_receiving(){

			$invno=$this->input->post('invno');
			$pono=$this->input->post('pono');
			$invdate=$this->input->post('invdate');
			$rrno=$this->General_model->generateRefNo('RRN',$this->session->fullname);
			$post=$this->Purchase_model->post_receiving($rrno,$invno,$pono,$invdate);
			if($post){
				redirect(base_url()."rr_print/$invno/$rrno");
			}else{
				$this->Purchase_model->revertRefNo('RRN');
				echo "<script>alert('Unable to post receiving!');window.location='".base_url()."manage_receiving/$pono';</script>";
			}
		}

		public function rr_print($invno,$rrno){
			$invno = str_replace('%20',' ',$invno);
			$page="receiving_report";
			$head=$this->Purchase_model->getRRHead($invno,$rrno);
			$supplier=$head['suppliername'];
			$transdate=date('M-d-Y',strtotime($head['datearray']));
			$pono=$head['po'];
			$header=$this->General_model->getInfo();
			$data['body'] = $this->Purchase_model->getRRDetails($invno,$rrno);
			$html=$this->load->view('pages/supplychain/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 59,
				'margin_left' => 5,
				'margin_right' => 10,
				'margin_bottom' => 85,
				//'format' => [215.9,137.5],
				'format' => 'Letter',
				'orientation' => 'L'
			]);
			$inventory="";
			$footer=$this->Purchase_model->getRRDetailsFooter($invno,$rrno);
			$totalgross=0;
			$def=0;
			$itax=0;
			$ewtax=0;
			foreach($footer as $fr){
				$tot=0;
				if($fr['trantype']=="FREE GOODS"){
					$fg=" FG ";
				}else{
					$fg="";
				}
				$dept=$fr['dept'];
				$foot=$this->Purchase_model->getRRDetailsFoot($invno,$rrno,$fr['trantype'],$fr['unit']);
				foreach($foot as $ft){
					$tax=0;
					if($ft['trantype']=="FREE GOODS"){
						if($ft['prodtype1'] > 0){
							$ucost=$ft['prodtype1']*$ft['quantity'];
						}else{
							$ucost=round($ft['unitcost'],3)*$ft['quantity'];
						}
						$def +=$ucost;
					}else {
						if ($ft['prodtype1'] > 0) {
							$ucost = $ft['prodtype1'] * $ft['quantity'];
						} else {
							$ucost = $ft['unitcost'] * $ft['quantity'];
						}
						$totalgross +=round($ucost,2);
						if ($ft['stockalert'] > 0) {
							$tax = $ucost - ($ucost / 1.12);
						}
						$ewtax += ($ucost-$tax)*.01;
					}
					$itax +=$tax;
					$tot += $ucost-$tax;
				}
				$inventory .='
                    <tr>
                    <td width="5%">&nbsp;</td>
                    <td width="55%">INVENTORY - '.$fr['unit'].' '.$fg.' (<b>'.$dept.'</b>)</td>
                    <td align="right" width="20%">'.number_format($tot,3).'</td>
                    <td align="right" width="20%">'.number_format(0,3).'</td>
                    </tr>
                    ';

			}
			$accountpayable=$totalgross-$def;
			if($supplier=="KMSCI CSR"){
				$handfee=$totalgross*.01;
			}else{
				$handfee=0;
			}
			if($itax==0){
				$itax = $totalgross*.12;
				$itax1 = $itax;
				$itaxdesc= "NV";
				$itaxdesc1= "NV";				
			}else{
				$itaxdesc= "GOODS";
				$itaxdesc1= "";
				$itax1=0;
			}
			if(strpos($invno,'DR') !== false){
			$itax=0;
			$itax1=0;
			$ewtax=0;
		}
if($itax1 > 0){
			$nv='
			<tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;INPUT TAX - '.$itaxdesc1.'</td>
            <td align="right" width="20%">'.number_format(0,3).'</td>
            <td align="right" width="20%">'.number_format($itax1,3).'</td>
            </tr>
			';
		}else{
			$nv="";
		}		
			$mpdf->setHTMLHeader('
            <div style="text-align:center;font-family:Arial;">
             <table width="500" border="0" cellspacing="0" cellpadding="0">
             <tr>
             <td width="20">&nbsp;</td>
             <td width="80"></td>
            <td align="center" style="font-family:Arial;"><b style="font-size:10px;">Republic of the Philippines</td>
          <td width="30">&nbsp;</td>
      </tr>
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="50"><img src="'.base_url().'design/images/kmsci.png" width="50"></td>
                    <td align="center" style="font-family:Arial;"><b style="font-size:12px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <center style="width:500px;"><h4>RECEIVING REPORT</h4></center>
            <table width="500" border="0" cellspacing="1" cellpadding="1" style="font-family:Arial,Helvetica; font-size: 10px;">
             <tr>
                <td align="right">Supplier: </td>
                 <td><b>'.$supplier.'</b></td>
                 <td align="right">R.R. No.: </td>
                 <td><b>'.$rrno.'</b></td>
                 </tr>
                 <tr>
                <td align="right"  width="70">Invoice No.: </td>
                 <td><b>'.$invno.'</b></td>
                 <td align="right">P.O No.: </td>
                 <td><b>'.$pono.'</b></td>
                 </tr>
                 <tr>
                 <td align="right">RR Date: </td>
                 <td><b>'.$transdate.'</b></td>
                 <td align="right"></td>
                 <td></td>
                 </tr>
             </table>
             <table width="400" border="1" cellspacing="0" cellpadding="0" style="font-family:Arial;font-size:9px;border-collapse: collapse;">
                <tr>
					 <td align="center" width="5%">Qty</td>
					 <td align="center" width="9%">Unit</td>
					 <td align="center" width="39%">Description</td>
					 <td align="center" width="6%">Conv</td>
					 <td align="center" width="7%">Whr</td>
					 <td align="center" width="11%">Unit<br>Price</td>
                     <td align="center" width="10%">Disc<br>Price</td>
                     <td align="center" width="12%">Gross</td>
                     <td align="center" width="11%">Vat</td>
                     <td align="center" width="12%">Net</td>
				 </tr>
                 </table>
             </div>
            ');
			$mpdf->setHTMLFooter('
            <div>

            <table width="500" border="0" cellspacing="0" cellpadding="1" style="font-size:12px;">
                <tr>
                    <td width="80%" align="right" $view>Total Gross:</td>
                    <td width="20%" align="right" $view><b>'.number_format($totalgross,2).'</b></td>
                </tr>
                <tr $view>
                    <td width="80%" align="right">Handling Fee (1%):</td>
                    <td width="20%" align="right"><b>'.number_format($handfee,2).'</b></td>
                </tr>
                <tr>
                    <td width="80%" align="right" style="border-top:1px solid black;">Total:</td>
                    <td width="20%" style="border-bottom:1px solid; border-top:1px solid black;" align="right"><b>'.number_format($totalgross+$handfee,2).'</b></td>
                </tr>
            </table>
            <br>
            <table width="500" border="0" cellspacing="0" cellpadding="1" style="font-size:11px;">
            <tr>
            <td colspan="2">Journal Entries</td>
            <td align="right"><b>Debit</b></td>
            <td align="right"><b>Credit</b></td>
            </tr>
            '.$inventory.'
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">INPUT TAX - '.$itaxdesc.'</td>
            <td align="right" width="20%">'.number_format($itax,3).'</td>
            <td align="right" width="20%">'.number_format(0,3).'</td>
            </tr>
            '.$nv.'
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">DEFERRED INCOME - </td>
            <td align="right" width="20%">'.number_format(0,3).'</td>
            <td align="right" width="20%">'.number_format($def,3).'</td>
            </tr>
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">FREIGHT IN - </td>
            <td align="right" width="20%">'.number_format($handfee,3).'</td>
            <td align="right" width="20%">'.number_format(0,3).'</td>
            </tr>
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">EXPANDED WTAX - </td>
            <td align="right" width="20%">'.number_format(0,3).'</td>
            <td align="right" width="20%">'.number_format($ewtax,3).'</td>
            </tr>
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">ACCOUNTS PAYABLE-TRADE</td>
            <td align="right" width="20%" style="border-bottom:1px solid;">'.number_format(0,3).'</td>
            <td align="right" width="20%" style="border-bottom:1px solid;">'.number_format($totalgross+$handfee-$ewtax,3).'</td>
            </tr>
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">&nbsp;</td>
            <td align="right" width="20%">'.number_format($totalgross+$handfee+$def+$itax1,3).'</td>
            <td align="right" width="20%">'.number_format($totalgross+$handfee+$def+$itax1,3).'</td>
            </tr>
            </table>
            <br>
            <br>
            <br>
            <table width="500" border="0" cellspacing="0" cellpadding="1" style="font-size:8px;">
            <tr>
            <td style="border-top:1px solid black;" colspan="4">&nbsp;</td>
            </tr>
            <tr>
            <td width="25%">Prepared by:_______________</td>
            <td width="25%">Checked by:_______________</td>
            <td width="25%">Reviewed by:_______________</td>
            <td width="25%">Noted/Verified by:_______________</td>
            </tr>
            </table>
            </div>
            ');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();

		}
		public function fetch_rr_supplier(){
			$id=$this->input->post('id');
			$data=$this->Purchase_model->fetch_rr_supplier($id);
			echo json_encode($data);
		}
		public function change_supplier(){
			$pono=$this->input->post('pono');
			$change=$this->Purchase_model->change_supplier();
			if($change){
				$message="Supplier successfully changed with P.O. No. $pono.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('remove_success','Supplier successfully changed!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to change supplier!');
			}
			redirect(base_url()."manage_receiving/$pono");
		}

		public function receiving_add_free_goods(){
			$pono=$this->input->post('pono');
			$freegoods=$this->Purchase_model->add_free_goods();
			if($freegoods){
				$this->session->set_flashdata('remove_success','Free goods successfully added!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to add free goods!');
			}
			redirect(base_url()."manage_receiving/$pono");
		}
		public function receiving_add_batch(){
			$pono=$this->input->post('pono');
			$freegoods=$this->Purchase_model->add_batch();
			if($freegoods){
				$this->session->set_flashdata('remove_success','Item successfully added!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to add item!');
			}
			redirect(base_url()."manage_receiving/$pono");
		}
		public function manual_receiving(){
			if($this->session->user_login){
				$page="manual_receiving";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Manual Receiving";
					$data['purchases'] = $this->Purchase_model->getAllManualPO();
					$data['suppliers'] = $this->Purchase_model->getAllSuppliers();
					$data['station'] = $this->General_model->getStation();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($this->session->invno){
						$this->session->unset_userdata('invno');
						$this->session->unset_userdata('supplier');
						$this->session->unset_userdata('reqdept');
						$this->session->unset_userdata('terms');
						$this->session->unset_userdata('trantype');
						$this->session->unset_userdata('transdate');
						$this->session->unset_userdata('invdate');
					}
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function create_receiving(){
			$this->session->set_userdata('invno',$this->input->post('invno'));
			$this->session->set_userdata('supplier',$this->input->post('supplier'));
			$this->session->set_userdata('reqdept',$this->input->post('reqdept'));
			$this->session->set_userdata('terms',$this->input->post('terms'));
			$this->session->set_userdata('trantype',$this->input->post('trantype'));
			$this->session->set_userdata('transdate',$this->input->post('transdate'));
			$this->session->set_userdata('invdate',$this->input->post('invdate'));
			redirect(base_url()."manage_manual_receiving");
		}
		public function manage_manual_receiving(){
			if($this->session->user_login){
				if($this->session->invno){

				}else{
					redirect(base_url()."manual_receiving");
				}
				$page="manage_manual_receiving";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Manage Manual Receiving";
					$reqdept=$this->session->reqdept;
					$invno=$this->session->invno;
					$supplier=explode('_',$this->session->supplier);
					$data['suppliername'] = $supplier[1];
					$data['suppliercode'] = $supplier[0];
					$data['reqdept'] = $this->session->reqdept;
					$data['terms'] = $this->session->terms;
					$data['trantype'] = $this->session->trantype;
					$data['transdate'] = $this->session->transdate;
					$data['invdate'] = $this->session->invdate;
					$data['invno'] = $this->session->invno;
					$data['items'] = $this->Purchase_model->getItemsManualPO($invno);
					$data['itemdept'] = $this->Purchase_model->getAllItemsByDept($reqdept);
					$data['department'] = $reqdept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function manualpoadditem(){
			$addtolist=$this->Purchase_model->manual_add_item();
			if($addtolist){
				$this->session->set_flashdata('add_success','Item successfully added!');
			}else{
				$this->session->set_flashdata('add_failed','Unable to add item!');
			}
			redirect(base_url()."manage_manual_receiving");
		}
		public function remove_manual_item($code){
			$remove=$this->Purchase_model->remove_manual_item($code);
			if($remove){
				$this->session->set_flashdata('remove_success','Item successfully removed!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to remove item!');
			}
			redirect(base_url()."manage_manual_receiving");
		}
		public function fetch_manual_item(){
			$id=$this->input->post('id');
			$data=$this->Purchase_model->fetch_manual_item($id);
			echo json_encode($data);
		}
		public function update_manual_item(){
			$update=$this->Purchase_model->request_manual_item();
			if($update){
				$this->session->set_flashdata('remove_success','Item successfully updated!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to update item!');
			}
			redirect(base_url()."manage_manual_receiving");
		}
		public function preview_manual_receiving($invno){
			$invno = str_replace('%20',' ',$invno);
			$page="receiving_report";
			$head=$this->Purchase_model->getManualPODetailsHeader($invno);
			$header=$this->General_model->getInfo();
			$supplier=$head['suppliername'];
			$rrno="";
			$transdate=$head['transdate'];
			$data['body'] = $this->Purchase_model->getItemsManualPO($invno);
			$html=$this->load->view('pages/supplychain/'.$page, $data,true);
			$foot=$this->Purchase_model->getItemsManualPO($invno);
			$totalgross=0;
			$def=0;
			$itax=0;
			foreach($foot as $f){
				if($f['quantity']>0){
					if($f['trantype']=="FREE GOODS"){
						if ($f['prodtype1'] > 0) {
							$def += $f['prodtype1'] * $f['quantity'];
						} else {
							$def += $f['unitcost'] * $f['quantity'];
						}
					}else {
						if ($f['prodtype1'] > 0) {
							$ucost=$f['prodtype1'] * $f['quantity'];
						} else {
							$ucost=$f['unitcost'] * $f['quantity'];
						}
						$totalgross +=$ucost;
						if($f['vat'] > 0){
							$tax = $ucost/1.12;
							$itax +=$ucost-$tax;
						}
					}
				}
			}
			$inventory="";
			$footer=$this->Purchase_model->getManualPODetailsFooter($invno);
			foreach($footer as $fr){
				$ewtax=0;
				$tot=0;
				if($fr['trantype']=="FREE GOODS"){
					$fg=" FG ";
				}else{
					$fg="";
				}
				$dept=$fr['reqdept'];
				$foot=$this->Purchase_model->getManualPODetailsFoot($invno,$fr['trantype'],$fr['unit']);
				foreach($foot as $ft){
					$tax=0;
					if($ft['trantype']=="FREE GOODS"){
						if($ft['prodtype1'] > 0){
							$ucost=$ft['prodtype1']*$ft['quantity'];
						}else{
							$ucost=$ft['unitcost']*$ft['quantity'];
						}
					}else {
						if ($ft['prodtype1'] > 0) {
							$ucost = $ft['prodtype1'] * $ft['quantity'];
						} else {
							$ucost = $ft['unitcost'] * $ft['quantity'];
						}
						if ($ft['vat'] > 0) {
							$tax = $ucost - ($ucost / 1.12);
						}
						$ewtax += ($ucost-$tax)*.01;
					}
					$tot += $ucost-$tax;
				}
				$inventory .='
                    <tr>
                    <td width="5%">&nbsp;</td>
                    <td width="55%">INVENTORY - '.$fr['unit'].' '.$fg.' ('.$dept.')</td>
                    <td align="right" width="20%">'.number_format($tot,3).'</td>
                    <td align="right" width="20%">'.number_format(0,3).'</td>
                    </tr>
                    ';
			}
			$accountpayable=$totalgross-$def;
			if($supplier=="KMSCI CSR"){
				$handfee=$totalgross*.01;
			}else{
				$handfee=0;
			}
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 59,
				'margin_left' => 5,
				'margin_right' => 10,
				'margin_bottom' => 85,
				//'format' => [215.9,137.5],
				'format' => 'Letter',
				'orientation' => 'L'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:center;font-family:Arial;">
             <table width="500" border="0" cellspacing="0" cellpadding="0">
             <tr>
             <td width="20">&nbsp;</td>
             <td width="80"></td>
            <td align="center" style="font-family:Arial;"><b style="font-size:10px;">Republic of the Philippines</td>
          <td width="30">&nbsp;</td>
      </tr>
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="50"><img src="'.base_url().'design/images/kmsci.png" width="50"></td>
                    <td align="center" style="font-family:Arial;"><b style="font-size:12px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <center style="width:500px;"><h4>RECEIVING REPORT</h4></center>
            <table width="500" border="0" cellspacing="1" cellpadding="1" style="font-family:Arial,Helvetica; font-size: 10px;">
             <tr>
                <td align="right">Supplier: </td>
                 <td><b>'.$supplier.'</b></td>
                 <td align="right">R.R. No.: </td>
                 <td><b>'.$rrno.'</b></td>
                 </tr>
                 <tr>
                <td align="right"  width="70">Invoice No.: </td>
                 <td><b>'.$invno.'</b></td>
                 <td align="right">P.O No.: </td>
                 <td><b>'.$pono.'</b></td>
                 </tr>
                 <tr>
                 <td align="right">Date: </td>
                 <td><b>'.$transdate.'</b></td>
                 <td align="right"></td>
                 <td></td>
                 </tr>
             </table>
             <table width="400" border="1" cellspacing="0" cellpadding="0" style="font-family:Arial;font-size:9px;border-collapse: collapse;">
                <tr>
					 <td align="center" width="5%">Qty</td>
					 <td align="center" width="9%">Unit</td>
					 <td align="center" width="39%">Description</td>
					 <td align="center" width="6%">Conv</td>
					 <td align="center" width="7%">Whr</td>
					 <td align="center" width="11%">Unit<br>Price</td>
                     <td align="center" width="10%">Disc<br>Price</td>
                     <td align="center" width="12%">Gross</td>
                     <td align="center" width="11%">Vat</td>
                     <td align="center" width="12%">Net</td>
				 </tr>
                 </table>
             </div>
            ');
			$mpdf->setHTMLFooter('
            <div>

            <table width="500" border="0" cellspacing="0" cellpadding="1" style="font-size:12px;">
                <tr>
                    <td width="80%" align="right" $view>Total Gross:</td>
                    <td width="20%" align="right" $view><b>'.number_format($totalgross,2).'</b></td>
                </tr>
                <tr $view>
                    <td width="80%" align="right">Handling Fee (1%):</td>
                    <td width="20%" align="right"><b>'.number_format($handfee,2).'</b></td>
                </tr>
                <tr>
                    <td width="80%" align="right" style="border-top:1px solid black;">Total:</td>
                    <td width="20%" style="border-bottom:1px solid; border-top:1px solid black;" align="right"><b>'.number_format($totalgross+$handfee,2).'</b></td>
                </tr>
            </table>
            <br>
            <table width="500" border="0" cellspacing="0" cellpadding="1" style="font-size:11px;">
            <tr>
            <td colspan="2">Journal Entries</td>
            <td align="right"><b>Debit</b></td>
            <td align="right"><b>Credit</b></td>
            </tr>
            '.$inventory.'
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">INPUT TAX</td>
            <td align="right" width="20%">'.number_format($itax,3).'</td>
            <td align="right" width="20%">'.number_format(0,3).'</td>
            </tr>
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">DEFERRED INCOME - </td>
            <td align="right" width="20%">'.number_format(0,3).'</td>
            <td align="right" width="20%">'.number_format($def,3).'</td>
            </tr>
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">FREIGHT IN - </td>
            <td align="right" width="20%">'.number_format($handfee,3).'</td>
            <td align="right" width="20%">'.number_format(0,3).'</td>
            </tr>
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">EXPANDED WTAX - </td>
            <td align="right" width="20%">'.number_format(0,3).'</td>
            <td align="right" width="20%">'.number_format($ewtax,3).'</td>
            </tr>
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">ACCOUNTS PAYABLE-TRADE</td>
            <td align="right" width="20%" style="border-bottom:1px solid;">'.number_format(0,3).'</td>
            <td align="right" width="20%" style="border-bottom:1px solid;">'.number_format($totalgross+$handfee-$ewtax,3).'</td>
            </tr>
            <tr>
            <td width="5%">&nbsp;</td>
            <td width="55%">&nbsp;</td>
            <td align="right" width="20%">'.number_format($totalgross+$handfee+$def,3).'</td>
            <td align="right" width="20%">'.number_format($totalgross+$handfee+$def,3).'</td>
            </tr>
            </table>
            <br>
            <br>
            <br>
            <table width="500" border="0" cellspacing="0" cellpadding="1" style="font-size:8px;">
            <tr>
            <td style="border-top:1px solid black;" colspan="4">&nbsp;</td>
            </tr>
            <tr>
            <td width="25%">Prepared by:_______________</td>
            <td width="25%">Checked by:_______________</td>
            <td width="25%">Reviewed by:_______________</td>
            <td width="25%">Noted/Verified by:_______________</td>
            </tr>
            </table>
            </div>
            ');
			$mpdf->SetWatermarkText('PREVIEW');
			$mpdf->showWatermarkText = true;
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function post_manual_receiving($invno){
			$invno = str_replace('%20',' ',$invno);
			$rrno=$this->General_model->generateRefNo('RRN',$this->session->fullname);
			$post=$this->Purchase_model->post_manual_receiving($rrno,$invno);
			if($post){
				redirect(base_url()."rr_print/$invno/$rrno");
			}else{
				$this->Purchase_model->revertRefNo('RRN');
				echo "<script>alert('Unable to post receiving!');window.location='".base_url()."manage_manual_receiving';</script>";
			}
		}
		public function po_monitoring(){
			if($this->session->user_login){
				$page="po_monitoring";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Purchase Order Monitoring";
					$data['purchases'] = $this->Purchase_model->getAllPO();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}

		public function bridge($url){
			if($url=="printpo"){
			$pono=$this->input->post('pono');
			$this->session->pono = $this->input->post('pono');
			$this->session->supplier = $this->input->post('supplier');
			$this->session->reqdept = $this->input->post('reqdept');
			$this->session->trantype = $this->input->post('trantype');
			$this->session->reqdate = $this->input->post('reqdate');
			$this->session->terms = $this->input->post('terms');
			$this->session->user_login = $this->input->post('user_login');
			echo"<script>window.location='../po_print/$pono';</script>";
			}
		}
		public function po_print_monitoring($pono){
			if($this->session->user_login){
				$page="po_print";
				$items = $this->Purchase_model->getItemsPOMonitoring($pono);
				foreach($items as $item){
					$suppliercode=$item['suppliercode'];
					$suppliername=$item['supplier'];
				}
				$reqdept = $this->session->reqdept;
				$terms = $this->session->terms;
				$trantype = $this->session->trantype;
				$transdate = $this->session->reqdate;
				$add=$this->Purchase_model->getSingleSupplier($suppliercode);
				$supplieraddress=$add['address'];
				$data['body']=$this->Purchase_model->poprintbody($pono);
				$gross=0;
				$discount=0;
				$total=0;
				foreach ($data['body'] as $item){
					$gross += $item['prodqty'] * $item['unitcost'];
					$discount += $item['prodqty'] * $item['prodtype1'];
				}
				$total=$gross-$discount;
				$header=$this->General_model->getInfo();
				$html = $this->load->view('pages/supplychain/'.$page,$data,true);
				$mpdf = new \Mpdf\Mpdf([
					'margin_top' => 78,
					'margin_left' => 10,
					'margin_right' => 10,
					'margin_bottom' => 120,
					'format' => 'letter'
				]);
				$mpdf->setHTMLHeader('
            <div style="text-align:center;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                     <td width="20">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                    <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:13px;">'.$header['address'].'</font><br>
                    <font style="font-size:13px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="30">&nbsp;</td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="1" style="font-family:Arial,Helvetica; font-size: 12px;">
             <tr>
                <td align="right">P.O. No.: </td>
                 <td width="20%" align="right"><b>'.$pono.'</b></td>
                 </tr>
                 <tr>
               <td align="right">Date: </td>
                 <td width="20%" align="right"><b>'.date("m/d/Y",strtotime($transdate)).'</b></td>
                 </tr>
                 <tr>
                 <td align="right">Terms: </td>
                 <td width="20%" align="right"><b>'.$terms.'</b></td>
                 </tr>
             </table>
			 <center><h4>PURCHASE ORDER</h4></center>
			 <table width="100%" border="1" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;border-collapse:collapse;">
             <tr>
                <td width="10%">To: </td>
                 <td><b>'.$suppliername.'</b></td>
                 </tr>
                 <tr>
				 <td>Address: </td>
                 <td><b>'.$supplieraddress.'</b></td>
                 </tr>
                 <tr>
             </table>
             <br>
             <table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;border-collapse:collapse;">
                <tr>
					 <td align="center" width="41%" style="border-bottom:0;"><b>DESCRIPTION</b></td>
					 <td align="center" width="5%" style="border-bottom:0;"><b>QTY</b></td>
					 <td align="center" width="9%" style="border-bottom:0;"><b>UNIT</b></td>
					 <td align="center" width="15%" style="border-bottom:0;"><b>ORIG U PRICE</b></td>
					 <td align="center" width="15%" style="border-bottom:0;"><b>DISC U PRICE</b></td>
					 <td align="center" width="15%" style="border-bottom:0;"><b>AMOUNT</b></td>
				 </tr>
                 </table>
             </div>
            ');
				$mpdf->setFooter('<div>
            <table width="100%" border="0" cellspacing="1" cellpadding="0" style="font-family: Arial, Helvetica;font-size: 10px;">
			<tr>
                    <td style="vertical-align:top;"><b>TOTAL GROSS</b></td>
                    <td align="right"><u><b>'.number_format($gross,2).'</b></u></td>
                </tr>
				<tr>
                    <td style="vertical-align:top;"><b>TOTAL DISCOUNT</b></td>
                    <td align="right"><u><b>'.number_format($discount,2).'</b></u></td>
                </tr>
				<tr>
                    <td style="vertical-align:top;"><b>NET AMOUNT</b></td>
                    <td align="right"><u><b>'.number_format($total,2).'</b></u></td>
                </tr>
				<tr>
					<td colspan="2" style="border-bottom:1px solid black;"></td>
				</tr>
                <tr>
                    <td style="vertical-align:top;"><b><u>THIS ORDER IS SUBJECT TO THE FOLLOWING CONDITION:</u></b></td>
                    <td align="center">Accepted Order and Receiving<br>Original</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"></td>
                    <td align="center" width="25%">By:__________________________________</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;">
                    1. The above purchase are subject to inspection and analysis by our Purchasing/Accounting department<br>
                    &nbsp;&nbsp;&nbsp;and payment will not be made and delivery will not be accepted of any of the specifications are not met.<br>
                    2. Failure to comply with any of the following gives buyer the right to cancel all or any part of this order.<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;a. All packages and delivery must bear this purchase order.<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;b. Goods must confirm quantity, description and specification set forth above including price and<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;c. Delivery must be properly packed.<br>
                    3. All invoice must be rendered immediately after delivery with the acomplished original Purchase Order.<br>
                    4. The seller guarantee the materials identified herein shall be without defect.<br>
                    5. Any defects identified shall not be noted in the invoice by the seller.<br>
                    </td>
                    <td align="center" width="25%"  style="vertical-align:top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorized Signature of Supplier</td>
                </tr>
                <tr>
                <td colspan="2">&nbsp;</td>
                </tr>
                </table>
                <table width="100%" border="0" style="font-family:Arial, Helvetica, sans-serif; font-size:10px;">
                <tr>
                    <td style="vertical-align:top;"><b>Note: <u>Please deliver Longer Expiry of Medicine and Supplies!</u></b></td>
                    <td align="center" width="25%"></td>
                </tr>
                <tr>
                <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><b>Prepared by:</u></b></td>
                    <td width="50%"><b>Approved by:</b></td>
                </tr>
                <tr>
                <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><b><u>JIHAN S. KUSAIN, RPh</u></b></td>
                    <td width="50%">___________________________________</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><b>Purchasing Officer</b></td>
                    <td width="50%"></td>
                </tr>
                <tr>
                <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><b>Reviewed by:</u></b></td>
                    <td width="50%"></td>
                </tr>
                <tr>
                <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><b>__________________________________</b></td>
                    <td width="50%">___________________________________</td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><b>FINANCE OFFICER</u></b></td>
                    <td width="50%"></td>
                </tr>
            </table>
            </div>');
				$mpdf->autoPageBreak = true;
				$mpdf->WriteHTML($html);
				$mpdf->Output();
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function stock_issuance(){
			if($this->session->user_login){
				$page="stock_issuance";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Stock Issuance";
					$data['requests'] = $this->Purchase_model->getAllRequest();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function view_stock_issuance($reqdept){
			$reqdept=str_replace('%20',' ',$reqdept);
			if($this->session->user_login){
				$page="view_stock_issuance";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."stock_issuance'>Stock Issuance</a> >> Pending Request";
					$data['requests'] = $this->Purchase_model->getAllRequestByReqNo($reqdept);
					$data['department'] = $this->session->dept;
					$data['reqdept'] = $reqdept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function manage_stock_issuance($reqdept,$reqno){
			$reqdept=str_replace('%20',' ',$reqdept);
			$reqno=str_replace('%20',' ',$reqno);
			if($this->session->user_login){
				$page="manage_stock_issuance";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Manage Stock Issuance";
					$data['requests'] = $this->Purchase_model->getAllItemsRequest($reqno);
					$data['department'] = $this->session->dept;
					$data['reqdept'] = $reqdept;
					$data['reqno'] = $reqno;
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function post_stock_issuance(){
			$rrdetails=$this->input->post('rrdetails');
			$issuedqty=$this->input->post('issuedqty');
			$reqno=$this->input->post('reqno');
			$reqdept=$this->input->post('reqdept');
			$soh=$this->input->post('soh');
			$x=0;
			foreach($rrdetails AS $id){
				if($issuedqty[$x]>0 && $soh[$x] >= $issuedqty[$x]){
					$insert=$this->Purchase_model->update_request($id,$issuedqty[$x]);
				}
				$x++;
			}
			$date=date('Y-m-d');
			redirect(base_url()."print_stock_issuance_detailed_copy/".$reqno."/".$this->session->dept."/$date/$date");
		}
		public function cancel_issuance($reqno){
			$cancel=$this->Purchase_model->cancel_issuance($reqno);
			if($cancel){
				echo "<script>alert('Request successfully cancelled!');window.close();</script>";
			}else{
				echo "<script>alert('Unable to cancel request!');window.history.back();</script>";
			}
		}
		public function cancel_stock_issuance($reqdept,$reqno,$id){
			$cancel=$this->Purchase_model->cancel_stock_issuance($id);
			if($cancel){
				echo "<script>alert('Request successfully cancelled!');</script>";
			}else{
				echo "<script>alert('Unable to cancel request!');</script>";
			}
			$request=$this->Purchase_model->getAllItemsRequest($reqno);
			if(count($request)>0){
				echo "<script>window.location='".base_url()."manage_stock_issuance/$reqdept/$reqno';</script>";
			}else{
				echo "<script>window.close();</script>";
			}
		}
		public function print_stock_issuance($reqno){
			$reqno=str_replace('%20',' ',$reqno);
			$page="stockissuanceprint";
			$data['header']=$this->Purchase_model->issuanceprintheader($reqno);
			$header=$this->General_model->getInfo();
			$reqdate = $data['header']['reqdate'];
			$requestingdept = $data['header']['reqdept'];
			$requesteddept= $data['header']['dept'];
			$data['body']=$this->Purchase_model->issuanceprintbody($reqno);

			$html = $this->load->view('pages/supplychain/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 63,
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_bottom' => 10,
				'format' => 'Letter'
			]);
			$mpdf->setHTMLHeader('
                <div style="text-align:center;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="20">&nbsp;</td>
                        <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                        <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                        <font style="font-size:13px;">'.$header['address'].'</font></td>
                    <td width="30">&nbsp;</td>
                </tr>
                </table>
                <center><h4>STOCK TRANSFER ISSUANCE</h4></center>
                <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
                <tr>
                    <td width="25%" align="right">Issued To:</td>
                    <td align="right"><b>'.$requesteddept.'</b></td>
                    <td width="30%" align="right">Request No.:</td>
                    <td align="right"><b>'.explode('-',$reqno)[1].'</b></td>
                    </tr>
                    <tr>
                    <td align="right">Requesting Department:</td>
                    <td align="right"><b>'.$requestingdept.'</b></td>
                    <td align="right">Date: </td>
                    <td align="right"><b>'.date('M-d-Y',strtotime($reqdate)).'</b></td>
                    </tr>
                    <tr>
                </table>
                <br>
                <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;">
                    <tr>
                        <td align="center" width="10%" style="border-bottom:1px solid black;"><b>#</b></td>
                        <td align="center" width="10%" style="border-bottom:1px solid black;"><b>QTY</b></td>
                        <td align="center" width="30%" style="border-bottom:1px solid black;"><b>ITEM CODE</b></td>
                        <td width="50%" style="border-bottom:1px solid black;"><b>DESCRIPTION</b></td>
                    </tr>
                    </table>
                </div>
                ');
			//$mpdf->setFooter('<br>{PAGENO}');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}

		public function print_stock_issuance_detailed($reqno,$department,$startdate,$enddate){
			$reqno=str_replace('%20',' ',$reqno);
			$page="stockissuanceprintdetailed";
			$data['header']=$this->Purchase_model->issuanceprintheader($reqno);
			$header=$this->General_model->getInfo();
			$reqdate = $data['header']['datearray'];
			$requestingdept = $data['header']['reqdept'];
			$requesteddept= $data['header']['dept'];
			$data['reqno']=$reqno;
			$data['body']=$this->Purchase_model->issuancehistoryprintbody($reqno,$department,$startdate,$enddate);

			$html = $this->load->view('pages/supplychain/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 63,
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_bottom' => 10,
				'format' => 'Letter'
			]);
			$mpdf->setHTMLHeader('
                <div style="text-align:center;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="20">&nbsp;</td>
                        <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                        <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                        <font style="font-size:13px;">'.$header['address'].'</font></td>
                    <td width="30">&nbsp;</td>
                </tr>
                </table>
                <center><h4>ISSUANCE REPORT</h4></center>
                <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
                <tr>
                    <td width="15%" align="right">Issuance ID:</td>
                    <td align="right"><b>'.$reqno.'</b></td>
                    <td width="30%" align="right">Request No.:</td>
                    <td align="right"><b>'.explode('-',$reqno)[1].'</b></td>
                    </tr>
                    <tr>
                    <td align="right">Issued to:</td>
                    <td align="right"><b>'.$requestingdept.'</b></td>
                    <td align="right">Date: </td>
                    <td align="right"><b>'.date('M-d-Y',strtotime($reqdate)).'</b></td>
                    </tr>
                    <tr>
                </table>
                <br>
                <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;">
                    <tr>
                        <td align="center" width="10%" style="border-bottom:1px solid black;"><b>#</b></td>
                        <td width="40%" style="border-bottom:1px solid black;"><b>DESCRIPTION</b></td>
                        <td align="center" width="8%" style="border-bottom:1px solid black;"><b>LOT NO</b></td>
                        <td align="center" width="15%" style="border-bottom:1px solid black;"><b>QTY REQUESTED</b></td>
                        <td align="center" width="15%" style="border-bottom:1px solid black;"><b>QTY ISSUED</b></td>
                        <td align="center" width="12%" style="border-bottom:1px solid black;"><b>SUB TOTAL</b></td>
                    </tr>
                    </table>
                </div>
                ');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}

		public function print_stock_issuance_detailed_copy($reqno,$department,$startdate,$enddate){
			$reqno=str_replace('%20',' ',$reqno);
			$page="stockissuanceprintdetailedcopy";
			$data['header']=$this->Purchase_model->issuanceprintheader($reqno);
			$header=$this->General_model->getInfo();
			$reqdate = $data['header']['datearray'];
			$requestingdept = $data['header']['reqdept'];
			$requesteddept= $data['header']['dept'];
			$data['reqno']=$reqno;
			$data['body']=$this->Purchase_model->issuancehistoryprintbody($reqno,$department,$startdate,$enddate);

			$html = $this->load->view('pages/supplychain/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 63,
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_bottom' => 22,
				'format' => 'Letter'
			]);
			$mpdf->setHTMLHeader('
                <div style="text-align:center;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="20">&nbsp;</td>
                        <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                        <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                        <font style="font-size:13px;">'.$header['address'].'</font></td>
                    <td width="30">&nbsp;</td>
                </tr>
                </table>
                <center><h4>ISSUANCE REPORT</h4></center>
                <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
                <tr>
                    <td width="15%" align="right">Issuance ID:</td>
                    <td align="right"><b>'.$reqno.'</b></td>
                    <td width="30%" align="right">Request No.:</td>
                    <td align="right"><b>'.explode('-',$reqno)[1].'</b></td>
                    </tr>
                    <tr>
                    <td align="right">Issued to:</td>
                    <td align="right"><b>'.$requestingdept.'</b></td>
                    <td align="right">Date: </td>
                    <td align="right"><b>'.date('M-d-Y',strtotime($reqdate)).'</b></td>
                    </tr>
                    <tr>
                </table>
                <br>
                <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;">
                    <tr>
                        <td align="center" width="10%" style="border-bottom:1px solid black;"><b>#</b></td>
                        <td width="52%" style="border-bottom:1px solid black;"><b>DESCRIPTION</b></td>
                        <td align="center" width="8%" style="border-bottom:1px solid black;"><b>LOT NO</b></td>
                        <td align="center" width="15%" style="border-bottom:1px solid black;"><b>QTY REQUESTED</b></td>
                        <td align="center" width="15%" style="border-bottom:1px solid black;"><b>QTY ISSUED</b></td>
                    </tr>
                    </table>
                </div>
                ');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function stock_transfer(){
			if($this->session->user_login){
				$page="stock_transfer";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					if($this->session->invno){
						$this->session->unset_userdata('invno');
						$this->session->unset_userdata('branch');
						$this->session->unset_userdata('transdate');
					}
					$data['header']=$this->General_model->getInfo();
					$data['title']="Stock Transfer to Branch";
					$data['requests'] = $this->Purchase_model->getAllPendingChargeSlip();
					$data['station'] = $this->General_model->getAllBranch();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function create_transfer(){
			$branch=$this->input->post('branch');
			$invno=$this->input->post('invno');
			$transdate=$this->input->post('transdate');
			$this->session->set_userdata('invno',$invno);
			$this->session->set_userdata('branch',$branch);
			$this->session->set_userdata('transdate',$transdate);
			redirect(base_url()."stock_transfer_new");
		}

		public function stock_transfer_new(){
			if($this->session->user_login){
				if($this->session->invno){

				}else{
					redirect(base_url()."stock_transfer");
				}
				$page="stock_transfer_new";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Stock Transfer to Branch";
					$dept=$this->session->dept;
					$invno=$this->session->invno;
					$branch=$this->session->branch;
					$transdate=$this->session->transdate;
					$data['branch'] = $branch;
					$data['transdate'] = $transdate;
					$data['invno'] = $invno;
					$data['items'] = $this->Purchase_model->getItemsTransfer($invno);
					$data['itemdept'] = $this->Purchase_model->getAllItemsByDept($dept);
					$data['department'] = $dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function transferadditem(){
			$transfer=$this->Purchase_model->transferadditem();
			if($transfer){
				$this->session->set_flashdata('add_success','Item successfully added!');
			}else{
				$this->session->set_flashdata('add_failed','Unable to add item!');
			}
			redirect(base_url()."stock_transfer_new");
		}
		public function remove_transfer_item($param){
			$remove=$this->Purchase_model->remove_transfer_item($param);
			if($remove){
				$this->session->set_flashdata('remove_success','Item successfully removed!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to remove item!');
			}
			redirect(base_url()."stock_transfer_new");
		}
		public function fetch_transfer_item(){
			$id=$this->input->post('id');
			$data=$this->Purchase_model->fetch_transfer_item($id);
			echo json_encode($data);
		}
		public function update_transfer_item(){
			$remove=$this->Purchase_model->update_transfer_item($param);
			if($remove){
				$this->session->set_flashdata('remove_success','Item successfully updated!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to update item!');
			}
			redirect(base_url()."stock_transfer_new");
		}
		public function preview_transfer($invno){
			$page="transferprint";
			$header=$this->General_model->getInfo();
			$branch=$this->session->branch;
			$transdate=$this->session->transdate;
			$terms="NONE";
			if($branch=="AMSHI" || $branch=="CMSHI" || $branch=="MMSHI" || $branch=="MMHI" || $branch=="KMSCI"){
				$branch="CPU - ".$branch;
				$hf=1;
			}else{
				$branch="DR. ".$branch;
				$hf=0;
			}
			if($branch=="CPU - AMSHI"){
				$branch="CPU - ANTIPAS MEDICAL SPECIALISTS HOSPITAL, INC.";
			}
			if($branch=="CPU - CMSHI"){
				$branch="CPU - CENTENO MEDICAL SPECIALISTS HOSPITAL, INC.";
			}
			if($branch=="CPU - MMSHI"){
				$branch="CPU - MAKILALA MEDICAL SPECIALISTS HOSPITAL, INC.";
			}
			if($branch=="CPU - MMHI"){
				$branch="CPU - MAGSAYSAY MEDICAL HEALTHCARE, INC.";
			}
			if($branch=="CPU - KMSCI"){
				$branch="CPU - KIDAPAWAN MEDICAL SPECIALISTS CENTER, INC.";
			}
			$data['body'] = $this->Purchase_model->getItemsTransfer($invno);
			$footer = $this->Purchase_model->getItemsTransfer($invno);
			$grandtotal=0;
			foreach($footer as $foot){
				if($foot['prodtype1'] > 0){
					$totalamount=$foot['quantity']*$foot['prodtype1'];
				}else{
					$totalamount=$foot['unitcost']*$foot['quantity'];
				}
				$grandtotal +=$totalamount;
			}
			$handfee=$grandtotal*($hf/100);

			$html = $this->load->view('pages/supplychain/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 65.5,
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_bottom' => 100
			]);
			$mpdf->setHTMLHeader('
                <div style="text-align:center;">
                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                         <td width="20">&nbsp;</td>
                         <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                        <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                        <font style="font-size:13px;">'.$header['address'].'</font><br>
                        <font style="font-size:13px;">Tel. No.: '.$header['telno'].'</font></td>
                      <td width="30">&nbsp;</td>
                  </tr>
                </table>
                <table width="100%" border="0" cellspacing="1" style="font-family:Arial,Helvetica; font-size: 12px;">
                 <tr>
                    <td align="right">Charge Slip No.: </td>
                     <td width="20%" align="right"><b>'.$invno.'</b></td>
                     </tr>
                 </table>
                 <center><h4>CHARGE SLIP</h4></center>
                 <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-family:Arial;font-size:13px;border-collapse:collapse;">
                    <tr>
                        <td colspan="5" rowspan="3" style="vertical-align:top;">Charge To:<br><br>'.$branch.'</td>
                        <td colspan="2">Date: '.date('M-d-Y',strtotime($transdate)).'</td>
                    </tr>
                    <tr>
                        <td width="15%">Terms:</td>
                        <td width="15%">'.$terms.'</td>
                    </tr>
                    <tr>
                        <td colspan="2">P.O. No.: '.$invno.'</td>
                    </tr>
                     </table>
                 </div>
                ');
			$mpdf->setHTMLFooter('<div>
                <table width="100%" border="0" cellpadding="1" style="font-family:Arial;font-size:13px;">
                <tr>
                   <td align="center" width="5%"></td>
           <td align="center" width="9%"></td>
           <td width="41%"></td>
           <td align="left" width="15%"><b>Total</b></td>
           <td align="center" width="15%"></td>
                   <td align="right" width="5%"></td>
           <td align="right" width="25%" style="border-bottom:1px solid;font-weight:bold;">'.number_format($grandtotal,2).'</td>
                </tr>
                <tr>
                   <td align="center" width="5%"></td>
           <td align="center" width="9%"></td>
           <td width="41%"></td>
           <td align="left" width="30%" colspan="2"><b>Add: 1% Handling Fee</b></td>
                   <td align="right" width="5%"></td>
           <td align="right" width="25%" style="border-bottom:1px solid;font-weight:bold;">'.number_format($handfee,2).'</td>
                </tr>
                <tr>
                   <td align="center" width="5%"></td>
           <td align="center" width="9%"></td>
           <td width="41%"></td>
           <td align="left" width="30%" colspan="2"><b>Grand Total</b></td>
                   <td align="right" width="5%"></td>
           <td align="right" width="25%" style="border-bottom:1px solid;font-weight:bold;">'.number_format($handfee+$grandtotal,2).'</td>
                </tr>
                </table>
                <br /><br /><br /><br />
                <table width="100%" border="0" cellspacing="1" cellpadding="0" style="font-family: Arial, Helvetica;font-size: 10px;">
                    <tr>
                    <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="25%"><b>Prepared by:</u></b></td>
                        <td width="25%"><b>Checked by:</b></td>
                        <td width="25%"><b>Approved by:</u></b></td>
                        <td width="25%"><b>Received by:</b></td>
                    </tr>
                    <tr>
                    <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="25%"><b>'.$user.'</b></td>
                        <td width="25%"></td>
                        <td width="25%"></td>
                        <td width="25%">_________________________________</td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="25%"></td>
                        <td width="25%"></td>
                        <td width="25%"><b>Signature Over Printed Name</b></td>
                    </tr>
                    <tr>
                    <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                    <td colspan="4"><b>NOTE: Return of expiry Medicines and Supplies must be three (3) months before expiration date.</b></td>
                    </tr>
                    <tr>
                    <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                    <td align="right" style="border-bottom:1px solid;"><b>** white and yellow copy - customer</b></td>
                    <td></td>
                    <td align="right" style="border-bottom:1px solid;"><b>** pink copy - Kmsci copy</b></td>
                    </tr>

                </table>
                </div>');
			$mpdf->SetWatermarkText('PREVIEW');
			$mpdf->showWatermarkText = true;
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function post_transfer($invno){
			$post=$this->Purchase_model->post_transfer($invno);
			if($post){
				$this->session->set_flashdata('remove_success','Transaction successfully posted!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to post transaction!');
			}
			redirect(base_url()."stock_transfer_new");
		}
		public function print_transfer($invno){
			$page="transferprint";
			$header=$this->General_model->getInfo();
			$heads=$this->Purchase_model->getItemsTransferred($invno);
			$user=$this->session->fullname;
			$branch="";
			foreach($heads as $head){
				$branch=str_replace("TRANSFER TO ","",$head['trantype']);
				$branch=str_replace("CHARGE TO ","",$branch);
				$transdate = $head['datearray'];
			}
			$terms="NONE";
			if($branch=="AMSHI" || $branch=="CMSHI" || $branch=="MMSHI" || $branch=="MMHI" || $branch=="KMSCI"){
				$branch="CPU - ".$branch;
				$hf=1;
			}else{
				$branch="DR. ".$branch;
				$hf=0;
			}
			if($branch=="CPU - AMSHI"){
				$branch="CPU - ANTIPAS MEDICAL SPECIALISTS HOSPITAL, INC.";
			}
			if($branch=="CPU - CMSHI"){
				$branch="CPU - CENTENO MEDICAL SPECIALISTS HOSPITAL, INC.";
			}
			if($branch=="CPU - MMSHI"){
				$branch="CPU - MAKILALA MEDICAL SPECIALISTS HOSPITAL, INC.";
			}
			if($branch=="CPU - MMHI"){
				$branch="CPU - MAGSAYSAY MEDICAL HEALTHCARE, INC.";
			}
			if($branch=="CPU - KMSCI"){
				$branch="CPU - KIDAPAWAN MEDICAL SPECIALISTS CENTER, INC.";
			}
			$data['body'] = $this->Purchase_model->getItemsTransferred($invno);
			$footer = $this->Purchase_model->getItemsTransferred($invno);
			$grandtotal=0;
			foreach($footer as $foot){
				if($foot['prodtype1'] > 0){
					$totalamount=$foot['prodtype1']*$foot['quantity'];
				}else{
					$totalamount=$foot['unitcost']*$foot['quantity'];
				}
				$grandtotal +=$totalamount;
			}
			$handfee=$grandtotal*($hf/100);

			$html = $this->load->view('pages/supplychain/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 10,
				'margin_right' => 10,
				'setAutoBottomMargin' => 'stretch'
			]);
			$mpdf->setHTMLHeader('
                <div style="text-align:center;">
                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                         <td width="20">&nbsp;</td>
                         <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                        <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                        <font style="font-size:13px;">'.$header['address'].'</font><br>
                        <font style="font-size:13px;">Tel. No.: '.$header['telno'].'</font></td>
                      <td width="30">&nbsp;</td>
                  </tr>
                </table>
                <table width="100%" border="0" cellspacing="1" style="font-family:Arial,Helvetica; font-size: 12px;">
                 <tr>
                    <td align="right">Charge Slip No.: </td>
                     <td width="20%" align="right"><b>'.$invno.'</b></td>
                     </tr>
                 </table>
                 <center><h4>CHARGE SLIP</h4></center>
                 <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-family:Arial;font-size:13px;border-collapse:collapse;">
                    <tr>
                        <td colspan="5" rowspan="3" style="vertical-align:top;">Charge To:<br><br>'.$branch.'</td>
                        <td colspan="2">Date: '.date('M-d-Y',strtotime($transdate)).'</td>
                    </tr>
                    <tr>
                        <td width="15%">Terms:</td>
                        <td width="15%">'.$terms.'</td>
                    </tr>
                    <tr>
                        <td colspan="2">P.O. No.: '.$invno.'</td>
                    </tr>
                     </table>
                 </div>
                ');
			$mpdf->setHTMLFooter('<div>
                <table width="100%" border="0" cellpadding="1" style="font-family:Arial;font-size:13px;">
                <tr>
                   <td align="center" width="5%"></td>
           <td align="center" width="9%"></td>
           <td width="41%"></td>
           <td align="left" width="15%"><b>Total</b></td>
           <td align="center" width="15%"></td>
                   <td align="right" width="5%"></td>
           <td align="right" width="25%" style="border-bottom:1px solid;font-weight:bold;">'.number_format($grandtotal,2).'</td>
                </tr>
                <tr>
                   <td align="center" width="5%"></td>
           <td align="center" width="9%"></td>
           <td width="41%"></td>
           <td align="left" width="30%" colspan="2"><b>Add: 1% Handling Fee</b></td>
                   <td align="right" width="5%"></td>
           <td align="right" width="25%" style="border-bottom:1px solid;font-weight:bold;">'.number_format($handfee,2).'</td>
                </tr>
                <tr>
                   <td align="center" width="5%"></td>
           <td align="center" width="9%"></td>
           <td width="41%"></td>
           <td align="left" width="30%" colspan="2"><b>Grand Total</b></td>
                   <td align="right" width="5%"></td>
           <td align="right" width="25%" style="border-bottom:1px solid;font-weight:bold;">'.number_format($handfee+$grandtotal,2).'</td>
                </tr>
                </table>
                <br /><br /><br /><br />
                <table width="100%" border="0" cellspacing="1" cellpadding="0" style="font-family: Arial, Helvetica;font-size: 10px;">
                    <tr>
                    <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="25%"><b>Prepared by:</u></b></td>
                        <td width="25%"><b>Checked by:</b></td>
                        <td width="25%"><b>Approved by:</u></b></td>
                        <td width="25%"><b>Received by:</b></td>
                    </tr>
                    <tr>
                    <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="25%"><b><u>'.$user.'</u></b></td>
                        <td width="25%"></td>
                        <td width="25%"></td>
                        <td width="25%">_________________________________</td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="25%"></td>
                        <td width="25%"></td>
                        <td width="25%"><b>Signature Over Printed Name</b></td>
                    </tr>
                    <tr>
                    <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                    <td colspan="4"><b>NOTE: Return of expiry Medicines and Supplies must be three (3) months before expiration date.</b></td>
                    </tr>
                    <tr>
                    <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                    <td align="right" style="border-bottom:1px solid;"><b>** white and yellow copy - customer</b></td>
                    <td></td>
                    <td align="right" style="border-bottom:1px solid;"><b>** pink copy - Kmsci copy</b></td>
                    </tr>

                </table>
                </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function charge_slip(){
			if($this->session->user_login){
				$page="charge_slip";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					if($this->session->invno){
						$this->session->unset_userdata('invno');
						$this->session->unset_userdata('branch');
						$this->session->unset_userdata('transdate');
					}
					$data['header']=$this->General_model->getInfo();
					$data['title']="Charge Slip";
					$data['requests'] = $this->Purchase_model->getAllChargeSlip();
					$data['station'] = $this->General_model->getAllBranch();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_charge_slip(){
			if($this->session->user_login){
				$page="charge_slip";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					if($this->session->invno){
						$this->session->unset_userdata('invno');
						$this->session->unset_userdata('branch');
						$this->session->unset_userdata('transdate');
					}
					$data['header']=$this->General_model->getInfo();
					$data['title']="Charge Slip";
					$data['requests'] = $this->Purchase_model->getAllChargeSlipByDate();
					$data['station'] = $this->General_model->getAllBranch();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function receiving_history(){
			if($this->session->user_login){
				$page="receiving_history";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Receiving History";
					$data['suppliers'] = $this->Purchase_model->getAllSuppliers();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function receiving_history_supplier(){
			if($this->session->user_login){
				$page="receiving_history_supplier";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$supplier=explode('_',$this->input->post('supplier'));
					$suppliercode=$supplier[0];
					$suppliername=$supplier[1];
					$data['title']="<a href='".base_url()."receiving_history'>Receiving History</a> >> Supplier ";
					$data['purchases'] = $this->Purchase_model->getAllReceivingByDate();
					$data['suppliers'] = $this->Purchase_model->getAllSuppliers();
					$data['department'] = $this->session->dept;
					$data['suppliername'] = $suppliername;
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function receiving_history_supplier_details(){
			$page="receiving_history_supplier_details";

			$data['body'] = $this->Purchase_model->getAllReceivingBySupplier();
			$html = $this->load->view('pages/supplychain/'.$page,$data,true);
			$header=$this->General_model->getInfo();
			$supplier=explode('_',$this->input->post('supplier'));
			$suppliercode=$supplier[0];
			$suppliername=$supplier[1];
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 10,
				'margin_right' => 10,
				'setAutoBottomMargin' => 'stretch'
			]);
			$mpdf->setHTMLHeader('
                <div style="text-align:center;">
                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                         <td width="20">&nbsp;</td>
                         <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                        <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                        <font style="font-size:13px;">'.$header['address'].'</font><br>
                        <font style="font-size:13px;">Tel. No.: '.$header['telno'].'</font></td>
                      <td width="30">&nbsp;</td>
                  </tr>
                </table>
                 <center><h4>RECEIVING HISTORY</h4></center>
                 <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-family:Arial;font-size:13px;border-collapse:collapse;">
                    <tr>
                    	<td width="12%">Date Range: </td><td>'.$startdate.' - '.$enddate.'</td>
					</tr>
					<tr>
                    	<td>Supplier: </td><td>'.$suppliername.'</td>
					</tr>
                     </table>
                 </div>
                 </div>
                ');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function receiving_history_details(){
			$page="receiving_history_details";

			$data['body'] = $this->Purchase_model->getAllReceivingDetails();
			$html = $this->load->view('pages/supplychain/'.$page,$data,true);
			$header=$this->General_model->getInfo();
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 55,
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_bottom' => 100
			]);
			$mpdf->setHTMLHeader('
                <div style="text-align:center;">
                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                         <td width="20">&nbsp;</td>
                         <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                        <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                        <font style="font-size:13px;">'.$header['address'].'</font><br>
                        <font style="font-size:13px;">Tel. No.: '.$header['telno'].'</font></td>
                      <td width="30">&nbsp;</td>
                  </tr>
                </table>
                 <center><h4>RECEIVING HISTORY DETAILS</h4></center>
                 <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-family:Arial;font-size:13px;border-collapse:collapse;">
                    <tr>
                    	<td width="12%">Date Range: </td><td>'.$startdate.' - '.$enddate.'</td>
					</tr>
                     </table>
                 </div>
                 <br>
                 </div>
                ');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function issuance_history(){
			if($this->session->user_login){
				$page="issuance_history";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Issuance History";
					$data['suppliers'] = $this->General_model->getStation();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function issuance_history_report(){
			if($this->session->user_login){
				$page="issuance_history_report";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$department=$this->input->post('department');
					$startdate=$this->input->post('startdate');
					$enddate=$this->input->post('enddate');
					$data['title']="<a href='".base_url()."issuance_history'>Issuance History</a> >> Report ";
					$data['purchases'] = $this->Purchase_model->getAllIssuanceReport();
					$data['department'] = $department;
					$data['startdate'] = $startdate;
					$data['enddate'] = $enddate;
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function issuance_history_charge(){
			$page="issuance_history_details";
			$data['startdate'] = $this->input->post('startdate');
			$data['enddate'] = $this->input->post('enddate');
			$data['department'] = $this->input->post('department');
			$data['dept2'] = $this->input->post('dept2');
			$header=$this->General_model->getInfo();
			$data['items']= $this->Purchase_model->getAllIssuanceDetails('charge');

			$html=$this->load->view('pages/supplychain/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 45,
				'margin_left' => 8,
				'margin_right' => 8,
				'margin_bottom' => 10,
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:center;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="20">&nbsp;</td>
                    <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                    <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:13px;">'.$header['address'].'</font></td>
                <td width="30">&nbsp;</td>
            </tr>
            </table>
            <center><h4>ISSUANCE HISTORY DETAILED (CHARGED)</h4></center>
            </div>
            ');
			//$mpdf->setFooter('{PAGENO}');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function issuance_history_expense(){
			$page="issuance_history_details";
			$data['startdate'] = $this->input->post('startdate');
			$data['enddate'] = $this->input->post('enddate');
			$data['department'] = $this->input->post('department');
			$data['dept2'] = $this->input->post('dept2');
			$header=$this->General_model->getInfo();
			if($data['department']=="LABORATORY"){
				$data['items']=$this->Purchase_model->getSubSection();
				$page="issuance_history_details_lab";
			}else{
				$data['items']= $this->Purchase_model->getAllIssuanceDetails('EXPENSE');
			}

			$html=$this->load->view('pages/supplychain/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 45,
				'margin_left' => 8,
				'margin_right' => 8,
				'margin_bottom' => 10,
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:center;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="20">&nbsp;</td>
                    <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                    <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:13px;">'.$header['address'].'</font></td>
                <td width="30">&nbsp;</td>
            </tr>
            </table>
            <center><h4>ISSUANCE HISTORY DETAILED (EXPENSE)</h4></center>
            </div>
            ');
			//$mpdf->setFooter('{PAGENO}');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function receiving_summary(){
			if($this->session->dept=="CPU"){
				$page = "view_receiving_summary_cpu";
			}else if($this->session->dept=="CSR"){
				$page = "view_receiving_summary_csr";
			}else{
				$page = "view_receiving_summary_rdu";
			}
			$header=$this->General_model->getInfo();
			$type=$this->input->post('trantype');
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$data['trantype'] = $type;
			$data['datefrom'] = $startdate;
			$data['dateto'] = $enddate;
			$data['items'] = $this->Purchase_model->getAllPOReceived($type,$startdate,$enddate);
			$html=$this->load->view('pages/supplychain/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 58,
				'margin_left' => 5,
				'margin_right' => 5,
				'margin_bottom' => 22,
				'format' => 'folio',
				'orientation' => 'L'
			]);
			$mpdf->setHTMLHeader('
    <div style="text-align:center;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="20">&nbsp;</td>
            <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
            <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
            <font style="font-size:13px;">'.$header['address'].'</font></td>
        <td width="30">&nbsp;</td>
    </tr>
    </table>
    <center><h4>RECEIVING REPORT SUMMARY<br />('.$this->session->dept.')</h4></center>
    <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
        <tr>
        <td width="10%" align="right">Date Range:</td>
        <td ><b>'.date('m/d/Y',strtotime($startdate)).' to '.date('m/d/Y',strtotime($enddate)).'</b></td>
        </tr>
        <tr>
        <td width="10%" align="right">Transaction Type:</td>
        <td ><b>'.$type.'</b></td>
        </tr>
    </table>
    </div>
    ');
			//$mpdf->setFooter('{PAGENO}');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}

		public function weekly_invoice_report(){
			if($this->session->dept=="CPU"){
				$page = "weekly_invoice_report_cpu";
				$page1 = "weekly_invoice_report_cpu_lind";
			}else if($this->session->dept=="CSR"){
				$page = "weekly_invoice_report_csr";
				$page1 = "weekly_invoice_report_csr_lind";
			}else{
				$page = "weekly_invoice_report_rdu";
				$page1 = "weekly_invoice_report_rdu_lind";
			}
			$header=$this->General_model->getInfo();
			$type=$this->input->post('trantype');
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$data['trantype'] = $type;
			$data['datefrom'] = $startdate;
			$data['dateto'] = $enddate;
			$data['items'] = $this->Purchase_model->getAllPOReceived($type,$startdate,$enddate);
			$html=$this->load->view('pages/supplychain/'.$page, $data,true);
			$html1=$this->load->view('pages/supplychain/'.$page1, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
    <div style="text-align:center;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="20">&nbsp;</td>
            <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
            <td align="center" style="font-family:Arial;"><b style="font-size:14x;">'.$header['heading'].'</b><br>
            <font style="font-size:12px;">'.$header['address'].'</font></td>
        <td width="30">&nbsp;</td>
    </tr>
    </table>
    <center><h5>WEEKLY INVOICE REPORT<br />('.$this->session->dept.')</h5></center>
    <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
        <tr>
        <td width="10%" align="right">Date Range:</td>
        <td ><b>'.date('m/d/Y',strtotime($startdate)).' to '.date('m/d/Y',strtotime($enddate)).'</b></td>
        </tr>
        <tr>
        <td width="15%" align="right">Transaction Type:</td>
        <td ><b>'.$type.'</b></td>
        </tr>
    </table>
    </div>
    ');
			//$mpdf->setFooter('{PAGENO}');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->AddPage();
			$mpdf->WriteHTML($html1);
			$mpdf->Output();
		}
		public function consolidated_po(){
			$page = "consolidated_po";
			$header=$this->General_model->getInfo();
			$startdate=date('F d, Y',strtotime($this->input->post('startdate')));
			$enddate=date('F d, Y',strtotime($this->input->post('enddate')));
			$startdate=date('M-d-Y',strtotime($this->input->post('startdate')));
			$enddate=date('M-d-Y',strtotime($this->input->post('enddate')));

			$data['items'] = $this->Purchase_model->view_consolidated_po();

			$html=$this->load->view('pages/supplychain/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 60,
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_bottom' => 22,
				'orientation' => 'L'
			]);
			$mpdf->setHTMLHeader('
        <div style="text-align:center;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="20">&nbsp;</td>
            <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
            <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
            <font style="font-size:13px;">'.$header['address'].'</font></td>
            <td width="30">&nbsp;</td>
        </tr>
        </table>
        <center><h4>CONSOLIDATED PURCHASE ORDER</h4></center>
        <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
        <tr>
            <td width="10%" align="right">Period Covered:</td>
            <td ><b>'.$startdate.' To '.$enddate.'</b></td>
            </tr>
        </table>
        <br>
        <table width="100%" border="1" cellspacing="0" cellpadding="0" style="font-family:Arial;font-size:12px;">
            <tr>
                <td witdh="25%" align="center" style="border-bottom:1px solid black;"><b>ITEM</b></td>
                <td width="25%" align="center" style="border-bottom:1px solid black;"><b>SUPPLIER</b></td>
                <td width="15%" align="center" style="border-bottom:1px solid black;"><b>USAGES</b></td>
                <td width="15%" align="center" style="border-bottom:1px solid black;"><b>UNIT COST</b></td>
                <td width="20%" align="center" style="border-bottom:1px solid black;"><b>TOTAL</b></td>
            </tr>
            </table>
        </div>
        ');
			$mpdf->setFooter('{PAGENO}');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function adjustment_history(){
			if($this->session->user_login){
				$page="adjustment_history";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Adjustment History";
					$data['subtitle']="Today's Adjustment";
					$data['items'] = $this->Purchase_model->getAdjustmentHistory();
					$data['department'] = $this->session->dept;
					$data['view'] = "style='display:none;'";
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function view_adjustment_history(){
			if($this->session->user_login){
				$page="adjustment_history";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Adjustment History";
					$data['subtitle']="Adjustment Date: ".$this->input->post('startdate')." to ".$this->input->post('enddate');
					$data['items'] = $this->Purchase_model->getAdjustmentHistoryByDate();
					$data['department'] = $this->session->dept;
					$data['view'] = "";
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function item_price(){
			if($this->session->user_login){
				$page="item_price";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Search Item Price";
					$data['items'] = $this->Purchase_model->getPOReceived();
					$data['department'] = $this->session->dept;
					$data['view'] = "style='display:none;'";
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_item_price(){
			if($this->session->user_login){
				$page="item_price";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Search Item Price";
					$data['items'] = $this->Purchase_model->searchPOReceived();
					$data['department'] = $this->session->dept;
					$data['view'] = "style='display:none;'";
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function kit_assembly_report(){
			if($this->session->user_login){
				$page="kit_assembly_report";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Kit Assembly Report";
					$data['startdate'] = $this->input->post('startdate');
					$data['enddate'] = $this->input->post('enddate');
					$data['items']= $this->Purchase_model->getAllKitAssemblyReport();
					$data['department'] = $this->session->dept;
					$data['view'] = "style='display:none;'";
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function print_kit_assembly_report($refno){
			$page="print_kit_assembly_report";
			$head=$this->Purchase_model->kitassemblyreporthead($refno);
			$data['body']=$this->Purchase_model->kitassemblyreport($refno);
			$header=$this->General_model->getInfo();

			$html = $this->load->view('pages/supplychain/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 65,
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_bottom' => 10,
				'format' => 'Letter'
			]);
			$mpdf->setHTMLHeader('
                <div style="text-align:center;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="20">&nbsp;</td>
                        <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                        <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                        <font style="font-size:13px;">'.$header['address'].'</font></td>
                    <td width="30">&nbsp;</td>
                </tr>
                </table>
                <center><h4>KIT ASSEMBLY REPORT</h4></center>
                <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
                <tr>
                    <td width="15%" align="right">Item Kit:</td>
                    <td align="right"><b>'.$head['itemname'].'</b></td>
                    <td width="30%" align="right">Ref No.:</td>
                    <td align="right"><b>'.$refno.'</b></td>
                    </tr>
                    <tr>
                    <td align="right">Quantity:</td>
                    <td align="right"><b>'.$head['quantity'].'</b></td>
                    <td align="right">Date: </td>
                    <td align="right"><b>'.date('M-d-Y',strtotime($head['datearray'])).'</b></td>
                    </tr>
                    <tr>
                </table>
                <br>
                <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;">
                    <tr>
                        <td align="center" width="10%" style="border-bottom:1px solid black;"><b>#</b></td>
                        <td align="center" width="10%" style="border-bottom:1px solid black;"><b>QTY</b></td>
                        <td align="center" width="30%" style="border-bottom:1px solid black;"><b>ITEM CODE</b></td>
                        <td width="50%" style="border-bottom:1px solid black;"><b>DESCRIPTION</b></td>
                    </tr>
                    </table>
                </div>
                ');
			//$mpdf->setFooter('<br>{PAGENO}');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function stock_card(){
			if($this->session->user_login){
				$page="stock_card";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Stock Card";
					$data['items'] = $this->Purchase_model->getAllItems();
					$data['station'] = $this->General_model->getAllStation();
					$data['department'] = $this->session->dept;
					$data['view'] = "style='display:none;'";
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function view_stock_card(){
			$page="view_stock_card";
			$header=$this->General_model->getInfo();
			$startdate=date('F d, Y',strtotime($this->input->post('startdate')));
			$enddate=date('F d, Y',strtotime($this->input->post('enddate')));
			$data['title'] = "Electronic Stock Card";
			$data['toptitle'] = "Inventory";
			$data['itemdesc'] = $this->Purchase_model->view_sc_description();
			$description = $data['itemdesc']['description'];
			$generic = $data['itemdesc']['generic'];
			$data['itembalance'] = $this->Purchase_model->view_sc_begbalance();
			$begin=0;
			$begin=$data['itembalance']['begbalance'];
			$data['begbalance'] = $begin;
			$data['items'] = $this->Purchase_model->view_stock_card();

			$html = $this->load->view('pages/supplychain/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 58,
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_bottom' => 22,
				'orientation' => 'L'
			]);
			$mpdf->setHTMLHeader('
                <div style="text-align:center;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="20">&nbsp;</td>
                        <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                        <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                        <font style="font-size:13px;">'.$header['address'].'</font></td>
                    <td width="30">&nbsp;</td>
                </tr>
                </table>
                <center><h4>ELECTRONIC STOCK CARD</h4></center>
        <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
        <tr>
            <td width="10%" align="right">Item Code:</td>
            <td ><b>'.$data['itemdesc']['code'].'</b></td>
            </tr>
        <tr>
            <td width="10%" align="right">Item Name:</td>
            <td ><b>'.$description.' <font color="red">('.$generic.')</font></b></td>
            </tr>
        </table>
        <br>
        </div>
                ');

			$mpdf->setFooter('{PAGENO}');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function authenticate_adjustment(){
			$password=$this->input->post('password');
			$authentic=$this->Purchase_model->authenticate_user($password);
			if($authentic){
				redirect(base_url()."adjusting_entry");
			}else{
				echo "<script>alert('Invalid password. You are not authorized!');window.location='".base_url()."';</script>";
			}
		}
		public function adjusting_entry(){
			if($this->session->user_login){
				$page="adjustment_entry";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Adjusting Entry";
					$data['items'] = $this->Purchase_model->getItems();
					$data['reasons'] = $this->Purchase_model->reason();
					$data['department'] = $this->session->dept;
					$data['view'] = "style='display:none;'";
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_adjusting_entry(){
			if($this->session->user_login){
				$page="adjustment_entry";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Adjusting Entry";
					$data['items'] = $this->Purchase_model->getItemsByDescription();
					$data['reasons'] = $this->Purchase_model->reason();
					$data['department'] = $this->session->dept;
					$data['view'] = "style='display:none;'";
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function adjust_item(){
			$code=$this->input->post('code');
			$adjust=$this->Purchase_model->adjust_item();
			if($adjust){
				$this->session->set_flashdata('success','Item quantity successfully adjusted!');
			}else{
				$this->session->set_flashdata('failed','Unable to adjust item quantity!');
			}
			redirect(base_url()."adjusting_entry");
		}
		public function stock_on_hand(){
			if($this->session->user_login){
				$page="stock_on_hand";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Stock on Hand";
					$data['subtitle']="List of Items";
					$data['items'] = $this->Purchase_model->getAllItemsByLimit();
					$data['department'] = $this->session->dept;
					$data['view'] = "style='display:none;'";
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_stock_on_hand(){
			if($this->session->user_login){
				$page="stock_on_hand";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Stock on Hand";
					$data['subtitle']="List of Items";
					$data['items'] = $this->Purchase_model->getAllItemsByDescription();
					$data['department'] = $this->session->dept;
					$data['view'] = "style='display:none;'";
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function count_sheet(){
			if($this->session->user_login){
				$page="count_sheet";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Count Sheet";
					$data['items'] = $this->General_model->getAllStation();
					$data['type'] = $this->Purchase_model->getAccountType();
					$data['department'] = $this->session->dept;
					$data['view'] = "style='display:none;'";
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function count_sheet_print(){
			$page="count_sheet_print";
			$header=$this->General_model->getInfo();
			$type=$this->input->post('type');
			$department=$this->input->post('department');
			$rundate=$this->input->post('rundate');
			$data['items'] = $this->Purchase_model->getAllItemsByType($type,$department,$rundate);

			$html=$this->load->view('pages/supplychain/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 60,
				'margin_left' => 10,
				'margin_right' => 10,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
        <div style="text-align:center;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="20">&nbsp;</td>
                <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                <font style="font-size:13px;">'.$header['address'].'</font></td>
            <td width="30">&nbsp;</td>
        </tr>
        </table>
        <center><h4>COUNT SHEET</h4></center>
        <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
            <tr>
            <td width="25%" align="right">Inventory Date:</td>
            <td ><b>'.date('m/d/Y',strtotime($rundate)).'</b></td>
            </tr>
            <tr>
            <td width="25%" align="right">Account Title:</td>
            <td ><b>'.$type.'</b></td>
            </tr>
        </table>
        <table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:10px; border-collapse:collapse;">
            <tr>
                <td witdh="5%" align="center" style="border-bottom:0;"><b>NO.</b></td>
                <td width="55%" align="center" style="border-bottom:0;"><b>DESCRIPTION</b></td>
                <td width="15%" align="center" style="border-bottom:0;"><b>EXPIRATION</b></td>
                <td width="5%" align="center" style="border-bottom:0;"><b>QTY</b></td>
                <td width="10%" align="center" style="border-bottom:0;"><b>PHYSICAL COUNT 1</b></td>
                <td width="10%" align="center" style="border-bottom:0;"><b>PHYSICAL COUNT 2</b></td>
            </tr>
            </table>
        </div>
        ');
			//$mpdf->setFooter('{PAGENO}');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();

		}
		public function count_sheet_view(){
			$page="count_sheet_view";
			$header=$this->General_model->getInfo();
			$type=$this->input->post('type');
			$department=$this->input->post('department');
			$rundate=$this->input->post('rundate');
			$data['items'] = $this->Purchase_model->getAllItemsByType($type,$department,$rundate);

			$html=$this->load->view('pages/supplychain/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 60,
				'margin_left' => 10,
				'margin_right' => 10,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
        <div style="text-align:center;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="20">&nbsp;</td>
                <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                <font style="font-size:13px;">'.$header['address'].'</font></td>
            <td width="30">&nbsp;</td>
        </tr>
        </table>
        <center><h4>ENDING INVENTORY REPORT</h4></center>
        <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
            <tr>
            <td width="25%" align="right">Inventory Date:</td>
            <td ><b>'.date('m/d/Y',strtotime($rundate)).'</b></td>
            </tr>
            <tr>
            <td width="25%" align="right">Account Title:</td>
            <td ><b>'.$type.'</b></td>
            </tr>
        </table>
        <table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:10px; border-collapse:collapse;">
        <tr>
            <td witdh="5%" align="center" style="border-bottom:0;"><b>NO.</b></td>
            <td width="62%" align="center" style="border-bottom:0;"><b>DESCRIPTION</b></td>
            <td width="10%" align="center" style="border-bottom:0;"><b>EXPIRATION</b></td>
            <td width="5%" align="center" style="border-bottom:0;"><b>QTY</b></td>
            <td width="8%" align="center" style="border-bottom:0;"><b>UNITCOST</b></td>
            <td width="10%" align="center" style="border-bottom:0;"><b>TOTAL AMOUNT</b></td>
        </tr>
        </table>
        </div>
        ');
			//$mpdf->setFooter('{PAGENO}');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();

		}
		public function validation(){
			if($this->session->user_login){
				$page="validation";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Validation";
					$this->session->unset_userdata('valdept');
					$this->session->unset_userdata('valtype');
					$this->session->unset_userdata('valdate');
					$data['items'] = $this->General_model->getAllStation();
					$data['type'] = $this->Purchase_model->getAccountType();
					$data['department'] = $this->session->dept;
					$data['view'] = "style='display:none;'";
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function validate(){
			if($this->session->user_login){
				$page="validate";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."validation'>Validation Details</a> >> Validate";
					if($this->session->valdept && $this->session->valtype && $this->session->valdate){
						$type=$this->session->valtype;
						$department=$this->session->valdept;
						$rundate=$this->session->valdate;
					}else{
						$this->session->set_userdata('valdept',$this->input->post('department'));
						$this->session->set_userdata('valtype',$this->input->post('type'));
						$this->session->set_userdata('valdate',$this->input->post('rundate'));
						$type=$this->session->valtype;
						$department=$this->session->valdept;
						$rundate=$this->session->valdate;
					}
					$data['items'] = $this->Purchase_model->getAllItemsByType($type,$department,$rundate);
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_validate(){
			if($this->session->user_login){
				$page="validate";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."validation'>Validation Details</a> >> Validate";
						$type=$this->session->valtype;
						$department=$this->session->valdept;
						$rundate=$this->session->valdate;
					$data['items'] = $this->Purchase_model->getAllItemsByTypeDesc($type,$department,$rundate,$this->input->post('searchme'));
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function validate_save(){
			$validate=$this->Purchase_model->validate_save();
			if($validate){
				$this->session->set_flashdata('success','Item successfully validated!');
			}else{
				$this->session->set_flashdata('failed','Unable to validate item!');
			}
			redirect(base_url()."validate");
		}
		public function manage_medicine(){
			if($this->session->user_login){
				$page="manage_medicine";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Manage Medicine";
					$data['items'] = $this->Purchase_model->getAllMedicine();
					$data['station'] = $this->General_model->getAllStation();
					$data['department'] = $this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}

		public function price_review(){
			if($this->session->user_login){
				$page="price_review";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Price Review";
					$data['items'] = $this->Purchase_model->getAllMedicine();
					$data['station'] = $this->General_model->getAllStation();
					$data['department'] = $this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}

		public function add_medicine(){
			$save=$this->Purchase_model->add_medicine();
			if($save){
				$this->session->set_flashdata('success','Medicine Successfully added!');
				redirect(base_url()."manage_medicine");
			}else{
				$this->session->set_flashdata('failed','Unable to add medicine!');
				redirect(base_url()."manage_medicine");
			}
		}
		public function update_medicine(){
			$save=$this->Purchase_model->update_medicine();
			if($save){
				$this->session->set_flashdata('success','Medicine successfully updated!');
				redirect(base_url()."manage_medicine");
			}else{
				$this->session->set_flashdata('failed','Unable to update medicine!');
				redirect(base_url()."manage_medicine");
			}
		}
		public function fetch_single_medicine(){
			$id=$this->input->post('id');
			$data=$this->Purchase_model->fetch_single_medicine($id);
			echo json_encode($data);
		}
		public function manage_supplies(){
			if($this->session->user_login){
				$page="manage_supplies";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Manage Supplies";
					$data['items'] = $this->Purchase_model->getAllSupplies();
					$data['station'] = $this->General_model->getAllStation();
					$data['type'] = $this->Purchase_model->getAllProductType();
					$data['department'] = $this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function add_supplies(){
			$save=$this->Purchase_model->add_supplies();
			if($save){
				$this->session->set_flashdata('success','Supplies successfully added!');
				redirect(base_url()."manage_supplies");
			}else{
				$this->session->set_flashdata('failed','Unable to add supplies!');
				redirect(base_url()."add_supplies");
			}
		}
		public function update_supplies(){
			$save=$this->Purchase_model->update_supplies();
			if($save){
				$this->session->set_flashdata('success','Supplies successfully updated!');
				redirect(base_url()."manage_supplies");
			}else{
				$this->session->set_flashdata('failed','Unable to update supplies!');
				redirect(base_url()."manage_supplies");
			}
		}
		public function manage_supplier(){
			if($this->session->user_login){
				$page="manage_supplier";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Manage Suppliers";
					$data['items'] = $this->Purchase_model->getAllSuppliers();
					$data['department'] = $this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_supplier(){
			$code=$this->input->post('code');
			if($code==""){
				$suppliercode=$this->General_model->generateRefNo('S',$this->session->fullname);
			}else{
				$suppliercode=$code;
			}
			$save=$this->Purchase_model->save_supplier($suppliercode);
			if($save){
				$this->session->set_flashdata('success','Supplier details successfully saved!');
				redirect(base_url()."manage_supplier");
			}else{
				$this->session->set_flashdata('failed','Unable to save supplier details!');
				redirect(base_url()."manage_supplier");
			}
		}
		public function delete_supplier($param){
			$delete=$this->Purchase_model->deleteSupplier($param);
			if($delete){
				$this->session->set_flashdata('success','Supplier details successfully deleted!');
				redirect(base_url()."manage_supplier");
			}else{
				$this->session->set_flashdata('failed','Unable to delete supplier details!');
				redirect(base_url()."manage_supplier");
			}
		}
		public function fetch_single_supplier(){
			$id=$this->input->post('id');
			$data=$this->Purchase_model->fetch_single_supplier($id);
			echo json_encode($data);
		}
		public function kit_assembly(){
			if($this->session->user_login){
				$page="kit_assembly";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Kit Assembly";
					$data['items'] = $this->Purchase_model->getAllKitAssembly();
					foreach($data['items'] AS $item){
						$data['itemcode'] = $item['code'];
					}
					$data['department'] = $this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_kit_assembly(){
			if($this->session->user_login){
				$page="kit_assembly";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Kit Assembly";
					$data['items'] = $this->Purchase_model->getSingleKitAssembly($this->input->post('description'));
					foreach($data['items'] AS $item){
						$data['itemcode'] = $item['code'];
					}
					$data['department'] = $this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_kit_assembly(){
			$code=$this->input->post('code');
			$save=$this->Purchase_model->save_kit_assembly();
			if($save){
				if($code==""){
					$this->session->set_flashdata('success','Kit details successfully added!');
				}else{
					$this->session->set_flashdata('success','Kit details successfully updated!');
				}
			}else{
				$this->session->set_flashdata('failed','Unable to save kit details!');
			}
			redirect(base_url()."kit_assembly");
		}
		public function add_kit_quantity(){
			$refno=date('YmdHis');
                $insert=$this->Purchase_model->addkitquantity($refno);
                if($insert) {
					redirect(base_url()."print_kit_assembly_report/$refno");
				}
		}
		public function add_kit_items($code,$soh){
			if($this->session->user_login){
				$page="add_kit_items";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$dept=$this->session->dept;
					$data['header']=$this->General_model->getInfo();
					$data['title']="Add Kit Assembly Items";
					$data['soh'] = $soh;
					$data['code'] = $code;
					$data['head'] = $this->Purchase_model->getAllKitHead($code);
					$data['items'] = $this->Purchase_model->getAllKitItems($code);
					$data['itemdept'] = $this->Purchase_model->getAllItemsByDept($dept);
					$data['department'] = $dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function add_kit_item(){
			$code=$this->input->post('code');
			$soh=$this->input->post('soh');
			$insert=$this->Purchase_model->kitadditem();
			if($insert){
				$this->session->set_flashdata('add_success','Item successfully added!');
			}else{
				$this->session->set_flashdata('add_failed','Unable to add item!');
			}
			redirect(base_url()."add_kit_items/".$code."/".$soh);
		}
		public function remove_kit_item($code,$soh,$autono){
			$delete=$this->Purchase_model->kitdeleteitem($code,$soh,$autono);
			if($delete){
				$this->session->set_flashdata('remove_success','Item successfully removed!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to remove item!');
			}
			redirect(base_url()."add_kit_items/".$code."/".$soh);
		}
		public function item_production(){
			if($this->session->user_login){
				$page="item_production";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$dept=$this->session->dept;
					$data['header']=$this->General_model->getInfo();
					$data['title']="Item Production";
					$data['items'] = $this->Purchase_model->getAllItemsProduction('GLOVES');
					$data['items1'] = $this->Purchase_model->getAllItemsProduction('GALLON');
					$data['items2'] = $this->Purchase_model->getAllItemsProduction('OS');
					$data['department'] = $dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_production_gloves(){
			$code=$this->input->post('code');
			$production=$this->Purchase_model->save_production_gloves();
			if($production){
				$this->session->set_flashdata('success','Production successfully saved!');
			}else{
				$this->session->set_flashdata('failed','Unable to save production!');
			}
			redirect(base_url()."item_production");
		}
		public function save_production_os(){
			$code=$this->input->post('code');
			$desc=$this->input->post('description');
			$production=$this->Purchase_model->save_production_os();
			if($production){
				$message="$desc production successfully processed.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('success','Production successfully saved!');
			}else{
				$this->session->set_flashdata('failed','Unable to save production!');
			}
			redirect(base_url()."item_production");
		}
		public function save_production_alcohol(){
			$code=$this->input->post('code');
			$production=$this->Purchase_model->save_production_alcohol();
			if($production){
				$this->session->set_flashdata('success','Production successfully saved!');
			}else{
				$this->session->set_flashdata('failed','Unable to save production!');
			}
			redirect(base_url()."item_production");
		}
		public function charge_to_bod(){
			if($this->session->user_login){
				$page="charge_to_bod";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					if($this->session->invno){
						$this->session->unset_userdata('invno');
						$this->session->unset_userdata('branch');
						$this->session->unset_userdata('acttitle');
						$this->session->unset_userdata('transdate');
					}
					$data['header']=$this->General_model->getInfo();
					$data['title']="Charge to BOD";
					$rundate=date('Y-m-d');
					$data['bod'] = $this->Purchase_model->getBOD();
					$data['items'] = $this->Purchase_model->getSingleChargeBODByDate($rundate,$rundate);
					$data['type'] = $this->Purchase_model->getAccountType();
					$data['department'] = $this->session->dept;
					$data['board'] = "";
					$data['startdate'] = "";
					$data['enddate'] = "";
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_charge_to_bod(){
			if($this->session->user_login){
				$page="charge_to_bod";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					if($this->session->invno){
						$this->session->unset_userdata('invno');
						$this->session->unset_userdata('branch');
						$this->session->unset_userdata('acttitle');
						$this->session->unset_userdata('transdate');
					}
					$bod=$this->input->post('branch');
					$startdate=$this->input->post('startdate');
					$enddate=$this->input->post('enddate');
					$data['board'] = $bod;
					$data['startdate']=$startdate;
					$data['enddate']=$enddate;
					$data['header']=$this->General_model->getInfo();
					$data['title']="Charge to BOD";
					$rundate=date('Y-m-d');
					$data['bod'] = $this->Purchase_model->getBOD();
					$data['items'] = $this->Purchase_model->getSingleChargeBOD($bod,$startdate,$enddate);
					$data['type'] = $this->Purchase_model->getAccountType();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function print_charge_bod($bod,$startdate,$enddate){
			$bod=str_replace('%20',' ',$bod);
            $page = "print_charge_bod";
            $data['items'] = $this->Purchase_model->getSingleChargeBOD($bod,$startdate,$enddate);
            $header=$this->General_model->getInfo();
            $html=$this->load->view('pages/supplychain/'.$page, $data,true);
            //$this->load->view('pages/supplychain/'.$page, $data);
            $mpdf = new \Mpdf\Mpdf([
                'setAutoTopMargin' => 'stretch',
                'margin_left' => 10,
                'margin_right' => 10,
                'setAutoBottomMargin' => 'stretch'
        ]);
        $mpdf->setHTMLHeader('
        <div style="text-align:center;">
       <table width="100%" border="0" cellspacing="0" cellpadding="1" border="0" style="cellpadding:10px; font-size:10px;">
            <tr>
            	<td width="20" style="border-right:0;height:70px;">&nbsp;</td>
                <td width="80" style="border-right:0;border-left:0;"><img src="'.base_url().'design/images/kmsci.png" width="50"></td>
                <td style="font-family:Arial; border-left:0;"><b style="font-size:12px;">'.$header['heading'].'</b><br>
                <font style="font-size:12px;">'.$header['address'].'</font></td>
        </tr>
        </table>
        <center><h4>CHARGE TO BOD REPORT</h4></center>
        <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
            <tr>
            <td width="10%" align="right">Date Range:</td>
            <td ><b>'.date('m/d/Y',strtotime($startdate)).' to '.date('m/d/Y',strtotime($enddate)).'</b></td>
            </tr>
            <tr>
            <td width="10%" align="right">Charge To:</td>
            <td><b>Dr. '.$bod.'</b></td>
            </tr>
        </table>
        </div>
        ');
        $mpdf->autoPageBreak = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        }
		public function create_charge(){
			$invno = $this->General_model->generateRefNo('BOD',$this->session->fullname);
			$this->session->set_userdata('invno',$invno);
			$this->session->set_userdata('branch',$this->input->post('bod'));
			$this->session->set_userdata('transdate',date('Y-m-d'));
			redirect(base_url()."new_charge_to_bod");
		}
		public function manage_charge(){
			$invno = $this->input->post('invno');
			$this->session->set_userdata('invno',$invno);
			$this->session->set_userdata('branch',$this->input->post('bod'));
			$this->session->set_userdata('transdate',date('Y-m-d'));
			redirect(base_url()."new_charge_to_bod");
		}
		public function new_charge_to_bod(){
			if($this->session->user_login){
				$page="new_charge_to_bod";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{

					$data['header']=$this->General_model->getInfo();
					$data['title']="Charge to BOD";
					$invno=$this->session->invno;
					$data['bod'] = $this->session->branch;
					$data['transdate'] = $this->session->transdate;
					$data['department'] = $this->session->dept;
					$data['invno'] = $invno;
					$data['items'] = $this->Purchase_model->getStockTransferBranch($invno);
					$dept=$this->session->dept;
					$data['itemdept'] = $this->Purchase_model->getAllItemsByDept($dept);
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function bodadditem(){
			$add=$this->Purchase_model->bodadditem();
			if($add){
				$this->session->set_flashdata('add_success','Item successfully added!');
			}else{
				$this->session->set_flashdata('add_failed','Unable to add item!');
			}
			redirect(base_url()."new_charge_to_bod");
		}
		public function bodremoveitem($param){
			$remove=$this->Purchase_model->transferremoveitem($param);
			if($remove){
				$this->session->set_flashdata('remove_success','Item successfully removed!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to remove item!');
			}
			redirect(base_url()."new_charge_to_bod");
		}
		public function postchargebod($invno){
			$transfer=$this->Purchase_model->postchargebod($invno);
			if($transfer){
				redirect(base_url()."charge_to_bod");
			}else{
				redirect(base_url()."new_charge_to_bod");
			}
		}
		public function department_return(){
			if($this->session->user_login){
				$page="department_return";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Department Return";
					$data['items'] = $this->Purchase_model->getDepartmentReturn();
					$data['view'] = "style='display:none;'";
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function view_returns($reqno){
			if($this->session->user_login){
				$page="view_returns";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Department Returns";
					$data['items'] = $this->Purchase_model->getDepartmentReturnItems($reqno);
					$details = $this->Purchase_model->getDepartmentReturnDetails($reqno);
					$data['reqno']=$reqno;
					$data['reqdate'] = $details['reqdate'];
					$data['requser'] = $details['requser'];
					$data['reqdept'] = $details['dept'];
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function return_item(){
			$reqno=$this->input->post('reqno');
			$rrdetails=$this->input->post('rrdetails');
			$quantity=$this->input->post('quantity');
			$return=$this->Purchase_model->return_items($rrdetails,$quantity);
			if($return){
				$this->session->set_flashdata('save_success','Item successfully returned!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to return item!');
			}
			redirect(base_url()."view_returns/".$reqno);
		}
		public function cancel_return($param){
			$cancel=$this->Purchase_model->cancel_return($param);
			if($cancel){
				$this->session->set_flashdata('save_success','Transaction successfully cancelled!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to cancel transaction!');
			}
			redirect(base_url()."department_return");
		}
		public function cancel_return_view($rrdetails,$reqno){
			$cancel=$this->Purchase_model->cancel_return_view($rrdetails,$reqno);
			if($cancel){
				$this->session->set_flashdata('save_success','Item successfully cancelled!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to cancel item!');
			}
			redirect(base_url()."view_returns/$reqno");
		}
		public function department_return_history(){
			if($this->session->user_login){
				$page="department_return_history";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Department Return History";
					$data['items'] = $this->Purchase_model->getDepartmentReturned();
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function return_print($param){
			$param=str_replace('%20',' ',$param);
			$page="stock_request_print";
			$data['header']=$this->Purchase_model->issuanceprintheader($param);
			$reqdate = $data['header']['reqdate'];
			$requestingdept = $data['header']['reqdept'];
			$requesteddept= $data['header']['dept'];
			$data['body']=$this->Purchase_model->returnhistoryprintbody($param);
			$header=$this->General_model->getInfo();

			$html = $this->load->view('pages/general/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 63,
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_bottom' => 22
				//'format' => [210, 148]
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:center;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                     <td width="20">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                    <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:13px;">'.$header['address'].'</font></td>
                  <td width="30">&nbsp;</td>
              </tr>
            </table>
			 <center><h4>STOCK TRANSFER REQUISITION<br>(RETURN)</h4></center>
			 <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
             <tr>
                <td width="25%" align="right">Charge To:</td>
                <td align="right"><b>'.$requesteddept.'</b></td>
                 <td width="30%" align="right">Request No.:</td>
                 <td align="right"><b>'.$param.'</b></td>
                 </tr>
                 <tr>
				 <td align="right">Requesting Department:</td>
                <td align="right"><b>'.$requestingdept.'</b></td>
                 <td align="right">Date: </td>
                 <td align="right"><b>'.date('M-d-Y',strtotime($reqdate)).'</b></td>
                 </tr>
                 <tr>
             </table>
             <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;">
                <tr>
                     <td align="center" width="5%" style="border-bottom:1px solid black;"><b>#</b></td>
                     <td align="center" width="5%" style="border-bottom:1px solid black;"><b>QTY</b></td>
					 <td width="65%" style="border-bottom:1px solid black;"><b>DESCRIPTION</b></td>
					 <td align="left" width="25%" style="border-bottom:1px solid black;"><b>LAST DATE REQUESTED</b></td>
				 </tr>
                 </table>
             </div>
            ');

			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function return_to_supplier(){
			if($this->session->user_login){
				$page="return_to_supplier";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Return to Supplier";
					$this->session->unset_userdata('supplier');
					$this->session->unset_userdata('invno');
					$this->session->unset_userdata('transdate');
					$data['items'] = $this->Purchase_model->getAllSuppliers();
					$data['pending'] = $this->Purchase_model->getAllPendingReturn();
					$data['view'] = "style='display:none;'";
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function create_return(){
			$invno=$this->General_model->generateRefNo('RTS',$this->session->fullname);
			$this->session->set_userdata('invno',$invno);
			$this->session->set_userdata('supplier',$this->input->post('supplier'));
			$this->session->set_userdata('transdate',$this->input->post('transdate'));
			redirect(base_url()."manage_return");
		}
		public function update_return(){
			$this->session->set_userdata('invno',$this->input->post('invno'));
			$this->session->set_userdata('supplier',$this->input->post('supplier'));
			$this->session->set_userdata('transdate',$this->input->post('transdate'));
			redirect(base_url()."manage_return");
		}
		public function manage_return(){
			if($this->session->user_login){
				$page="manage_return";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Return to Supplier";
					$dept=$this->session->dept;
					$invno=$this->session->invno;
					$supplier=explode('_',$this->session->supplier);
					$suppliercode=$supplier[0];
					$suppliername=$supplier[1];
					$transdate=$this->session->transdate;
					$data['items'] = $this->Purchase_model->getReturnItems($invno);
					$data['searchresult']="";
					$data['department'] = $dept;
					$data['invno'] = $invno;
					$data['suppliername'] = $suppliername;
					$data['suppliercode'] = $suppliercode;
					$data['transdate'] = $transdate;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function manage_return_search(){
			if($this->session->user_login){
				$page="manage_return";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Return to Supplier";
					$dept=$this->session->dept;
					$invno=$this->session->invno;
					$supplier=explode('_',$this->session->supplier);
					$suppliercode=$supplier[0];
					$suppliername=$supplier[1];
					$transdate=$this->session->transdate;
					$data['items'] = $this->Purchase_model->getReturnItems($invno);
					$data['searchresult']=$this->Purchase_model->searchreturnsupplier();
					$data['department'] = $dept;
					$data['invno'] = $invno;
					$data['suppliername'] = $suppliername;
					$data['suppliercode'] = $suppliercode;
					$data['transdate'] = $transdate;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modalSCM',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function returnadditem(){
			$return=$this->Purchase_model->returnadditem();
			if($return){
				$this->session->set_flashdata('remove_success','Item successfully added!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to add item!');
			}
			redirect(base_url()."manage_return");
		}
		public function returnremoveitem($param){
			$remove=$this->Purchase_model->returnremoveitem($param);
			if($remove){
				$this->session->set_flashdata('remove_success','Item successfully removed!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to remove item!');
			}
			redirect(base_url()."manage_return");
		}
		public function postreturnsupplier(){
			$post=$this->Purchase_model->postreturnsupplier();
			if($post){
				echo "<script>alert('Transaction successfully posted!');window.location='".base_url()."return_to_supplier';</script>";
			}else{
				echo "<script>alert('Unable to post transaction!');window.location='".base_url()."manage_return';</script>";
			}
		}
		public function preview_return($invno){
			$param=str_replace('%20',' ',$param);
			$page="print_return";
			$details=$this->Purchase_model->printReturnDetails($invno);
			$supplier=$details['suppliername'];
			$returndate=$details['datearray'];
			$data['items'] = $this->Purchase_model->printPreviewReturnItems($invno);
			$header=$this->General_model->getInfo();

			$html=$this->load->view('pages/supplychain/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 62.5,
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_bottom' => 22
			]);
			$mpdf->setHTMLHeader('
        <div style="text-align:center;">
         <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                     <td width="20">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                    <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:13px;">'.$header['address'].'</font></td>
                  <td width="30">&nbsp;</td>
              </tr>
            </table>
        <center><h4>RETURN ITEMS TO SUPPLIER</h4></center>
        <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
            <tr>
            <td width="10%" align="right">TO:</td>
            <td ><b>'.$supplier.'</b></td>
            </tr>
            <tr>
            <td width="10%" align="right">Return Date:</td>
            <td ><b>'.date('m/d/Y',strtotime($returndate)).'</b></td>
            </tr>
        </table>
        <br>
        <table width="100%" border="1" cellspacing="0" cellpadding="0" style="font-family:Arial;font-size:12px;border-collapse: collapse;">
            <tr>
                <td witdh="25%" align="center" style="border-bottom:1px solid black;"><b>ITEM</b></td>
                <td width="25%" align="center" style="border-bottom:1px solid black;"><b>EXPIRATION</b></td>
                <td width="10%" align="center" style="border-bottom:1px solid black;"><b>LOT NO</b></td>
                <td width="15%" align="center" style="border-bottom:1px solid black;"><b>UNIT COST</b></td>
                <td width="10%" align="center" style="border-bottom:1px solid black;"><b>QTY</b></td>
                <td width="15%" align="right" style="border-bottom:1px solid black;"><b>TOTAL</b></td>
            </tr>
            </table>
        </div>
        ');
			$mpdf->setHTMLFooter('
        <div>
        <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size:10px;font-weight:bold;">
            <tr>
            <td width="35%">Prepared by:_________________________</td>
            <td width="35%">Checked by:_________________________</td>
            <td width="30%">Noted by:_______________________</td>
            </tr>
            </table>
        </div>');
			$mpdf->SetWatermarkText('PREVIEW');
			$mpdf->showWatermarkText = true;
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function item_returns(){
			if($this->session->user_login){
				$page="item_returns";
				if(!file_exists(APPPATH.'views/pages/supplychain/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Return to Supplier History";
					$this->session->unset_userdata('supplier');
					$this->session->unset_userdata('invno');
					$this->session->unset_userdata('transdate');
					$data['pending'] = $this->Purchase_model->getAllPendingReturnByDate();
					$data['view'] = "style='display:none;'";
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/supplychain/'.$page,$data);
					$this->load->view('templates/modal',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function print_return($invno){
			$param=str_replace('%20',' ',$param);
			$page="print_return";
			$details=$this->Purchase_model->printReturnDetails($invno);
			$supplier=$details['suppliername'];
			$returndate=$details['datearray'];
			$data['items'] = $this->Purchase_model->printReturnItems($invno);
			$header=$this->General_model->getInfo();

			$html=$this->load->view('pages/supplychain/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 62.5,
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_bottom' => 22
			]);
			$mpdf->setHTMLHeader('
        <div style="text-align:center;">
         <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                     <td width="20">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                    <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:13px;">'.$header['address'].'</font></td>
                  <td width="30">&nbsp;</td>
              </tr>
            </table>
        <center><h4>RETURN ITEMS TO SUPPLIER</h4></center>
        <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
            <tr>
            <td width="10%" align="right">TO:</td>
            <td ><b>'.$supplier.'</b></td>
            </tr>
            <tr>
            <td width="10%" align="right">Return Date:</td>
            <td ><b>'.date('m/d/Y',strtotime($returndate)).'</b></td>
            </tr>
        </table>
        <br>
        <table width="100%" border="1" cellspacing="0" cellpadding="0" style="font-family:Arial;font-size:12px;border-collapse: collapse;">
            <tr>
                <td witdh="25%" align="center" style="border-bottom:1px solid black;"><b>ITEM</b></td>
                <td width="25%" align="center" style="border-bottom:1px solid black;"><b>EXPIRATION</b></td>
                <td width="10%" align="center" style="border-bottom:1px solid black;"><b>LOT NO</b></td>
                <td width="15%" align="center" style="border-bottom:1px solid black;"><b>UNIT COST</b></td>
                <td width="10%" align="center" style="border-bottom:1px solid black;"><b>QTY</b></td>
                <td width="15%" align="right" style="border-bottom:1px solid black;"><b>TOTAL</b></td>
            </tr>
            </table>
        </div>
        ');
			$mpdf->setHTMLFooter('
        <div>
        <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size:10px;font-weight:bold;">
            <tr>
            <td width="35%">Prepared by:_________________________</td>
            <td width="35%">Checked by:_________________________</td>
            <td width="30%">Noted by:_______________________</td>
            </tr>
            </table>
        </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function fetch_invoice(){
			$id=$this->input->post('id');
			$data=$this->General_model->generateRefNo($id,$this->session->fullname);
			echo json_encode($data);
		}
		public function edit_invoice(){
			$rrno=$this->input->post('rrno');
			$oldinvno=$this->input->post('oldinvno');
			$invno=$this->input->post('invno');
			$update=$this->Purchase_model->edit_invoice();
			if($update){
				$message="Invoice successfully updated from $oldinvno to $invno with RRNO $rrno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Invoice successfully updated!');window.close();</script>";
			}else{
				echo "<script>alert('Unable to update invoice!');window.close();</script>";
			}
		}
		public function save_reorder_level(){
			$code=$this->input->post('code');
			$dept=$this->input->post('dept');
			$type=$this->input->post('type');
			$quantity=$this->input->post('quantity');
			$description=$this->input->post('description');
			$update=$this->Purchase_model->save_reorder_level();
			if($update){
				$message="$description reorder level successfully updated!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('success',"$description reorder level successfully updated!");
			}else{
				$this->session->set_flashdata('danger',"Unable to udpate $description reorder level!");
			}
			redirect(base_url()."manage_$type");
		}

		public function critical_level(){
			$page="critical_level";
			$header=$this->General_model->getInfo();
			$data['items'] = $this->Purchase_model->getAllReOrderLevel();
			$data['dept']=$this->session->dept;
			$html=$this->load->view('pages/supplychain/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 10,
				'margin_right' => 10,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
        <div style="text-align:center;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="20">&nbsp;</td>
                <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                <font style="font-size:13px;">'.$header['address'].'</font></td>
            <td width="30">&nbsp;</td>
        </tr>
        </table>
        <center><h4>ITEMS CRITICAL LEVEL</h4></center>
        ');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();

		}
		public function near_expiry(){
			$page="near_expiry";
			$header=$this->General_model->getInfo();
			$data['items'] = $this->Purchase_model->getAllExpiry();
			$data['dept']=$this->session->dept;
			$html=$this->load->view('pages/supplychain/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
        <div style="text-align:center;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="20">&nbsp;</td>
                <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                <font style="font-size:13px;">'.$header['address'].'</font></td>
            <td width="30">&nbsp;</td>
        </tr>
        </table>
        <center><h4>NEAR EXPIRY ITEMS</h4></center>
        ');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();

		}
		public function fetch_bod_price(){
			$id=$this->input->post('id');
			$data=$this->Purchase_model->fetch_transfer_item($id);
			echo json_encode($data);
		}

		public function update_bod_price(){
			$update=$this->Purchase_model->update_transfer_item();
			if($update){
				$this->session->set_flashdata('remove_success','Item successfully updated!');
			}else{
				$this->session->set_flashdata('remove_failed','Unable to update item!');
			}
				redirect(base_url()."new_charge_to_bod");

		}
		public function change_dept($dept){
			$this->session->unset_userdata('dept');
			$this->session->set_userdata('dept',$dept);
			redirect(base_url()."main");
		}
		public function request_history(){
			if($this->session->user_login){
				$page="request_history";
				if(!file_exists(APPPATH.'views/pages/general/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Requisition History";
					$data['items'] = $this->Purchase_model->getAllRequestedItems();					
					$data['department'] = $this->session->dept;					
					$dept=$this->session->dept;
					$this->load->view('templates/headerOther',$data);
					$this->load->view('pages/general/'.$page,$data);
					$this->load->view('templates/modalOther',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function list_of_items(){
			$page="list_of_items";
			$header=$this->General_model->getInfo();
			$data['items_meds'] = $this->Purchase_model->getAllItemsBySupplier("MEDICINE");
			$data['items_sup'] = $this->Purchase_model->getAllItemsBySupplier("SUPPLIES");
			$html=$this->load->view('pages/supplychain/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 10,
				'margin_right' => 10,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
        <div style="text-align:center;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="20">&nbsp;</td>
                <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                <font style="font-size:13px;">'.$header['address'].'</font></td>
            <td width="30">&nbsp;</td>
        </tr>
        </table>
        <center><h4>ITEMS MASTER LIST</h4></center>       
        <table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:10px; border-collapse:collapse;">
            <tr>
                <td witdh="5%" align="center"><b>NO.</b></td>
                <td width="50%" align="center" ><b>DESCRIPTION</b></td>                
                <td width="25%" align="center" ><b>SUPPLIER</b></td>                
                <td width="10%" align="center" ><b>UNIT COST</b></td>
                <td width="10%" align="center" ><b>DISCOUNT</b></td>
            </tr>
            </table>
        </div>
        ');
			//$mpdf->setFooter('{PAGENO}');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();

		}
		//==============================End of SCM Module========================================

		//==============================Start of MRD Module========================================
		public function update_discharged_date_time(){
			$patientidno=$this->input->post('patientidno');
			$caseno=$this->input->post('caseno');
			$update=$this->Records_model->update_discharged_date_time();
			if($update){
				$message="Patient discharged date and time successfully updated with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('success','Profile successfully updated!');
			}else{
				$this->session->set_flashdata('failed','Unable to update profile!');
			}
			redirect(base_url()."view_patient_record_details/$patientidno/$caseno");
		}
		public function manage_diagnosis($patientidno,$caseno){
			if($this->session->user_login){
				$page="manage_diagnosis";
				if(!file_exists(APPPATH.'views/pages/medicalrecords/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$dept=$this->session->dept;
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."search_patient_record'>Search Patient</a> >> <a href='".base_url()."view_patient_record/$patientidno'>Patient Record</a> >> <a href='".base_url()."view_patient_record_details/$patientidno/$caseno'>Admission Details</a> >> Manage Diagnosis";
					$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
					$data['caserate'] = $this->General_model->finalcaserate($caseno);
					//$data['caserates'] = $this->General_model->caserates();
					$data['patientidno'] = $patientidno;
					$data['caseno'] = $caseno;
					$data['department'] = $dept;
					$this->load->view('templates/headerMRD',$data);
					$this->load->view('pages/medicalrecords/'.$page,$data);
					$this->load->view('templates/modalMRD',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function add_diagnosis($patientidno,$caseno){
			if($this->session->user_login){
				$page="add_diagnosis";
				if(!file_exists(APPPATH.'views/pages/medicalrecords/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$dept=$this->session->dept;
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."search_patient_record'>Search Patient</a> >> <a href='".base_url()."view_patient_record/$patientidno'>Patient Record</a> >> <a href='".base_url()."view_patient_record_details/$patientidno/$caseno'>Admission Details</a> >> <a href='".base_url()."manage_diagnosis/$patientidno/$caseno'>Manage Diagnosis</a> >> Add Diagnosis";
					$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
					//$data['caserate'] = $this->General_model->finalcaserate($caseno);
					$data['caserates'] = $this->General_model->caserates();
					$data['patientidno'] = $patientidno;
					$data['caseno'] = $caseno;
					$data['department'] = $dept;
					$this->load->view('templates/headerMRD',$data);
					$this->load->view('pages/medicalrecords/'.$page,$data);
					$this->load->view('templates/modalMRD',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_add_diagnosis(){
			if($this->session->user_login){
				$page="add_diagnosis";
				if(!file_exists(APPPATH.'views/pages/medicalrecords/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$caseno=$this->input->post('caseno');
					$patientidno=$this->input->post('patientidno');
					$dept=$this->session->dept;
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."search_patient_record'>Search Patient</a> >> <a href='".base_url()."view_patient_record/$patientidno'>Patient Record</a> >> <a href='".base_url()."view_patient_record_details/$patientidno/$caseno'>Admission Details</a> >> <a href='".base_url()."manage_diagnosis/$patientidno/$caseno'>Manage Diagnosis</a> >> Add Diagnosis";
					$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
					//$data['caserate'] = $this->General_model->finalcaserate($caseno);
					$data['caserates'] = $this->General_model->searchcaserates();
					$data['patientidno'] = $patientidno;
					$data['caseno'] = $caseno;
					$data['department'] = $dept;
					$this->load->view('templates/headerMRD',$data);
					$this->load->view('pages/medicalrecords/'.$page,$data);
					$this->load->view('templates/modal',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_diagnosis(){
			$patientidno=$this->input->post('patientidno');
			$caseno=$this->input->post('caseno');
			$description=$this->input->post('description');
			$add=$this->Records_model->save_diagnosis();
			if($add){
				$message="$description successfully added with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('success','Case Rate successfully added!');
			}else{
				$this->session->set_flashdata('failed','Unable to add case rate!');
			}
			redirect(base_url()."add_diagnosis/$patientidno/$caseno");
		}
		public function remove_diagnosis($patientidno,$caseno,$autono){
			$add=$this->Records_model->remove_diagnosis($autono);
			if($add){
				$message="Case rate successfully removed with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('success','Case Rate successfully removed!');
			}else{
				$this->session->set_flashdata('failed','Unable to remove case rate!');
			}
			redirect(base_url()."manage_diagnosis/$patientidno/$caseno");
		}
		public function fetch_single_case(){
			$id=$this->input->post('id');
			$data=$this->Records_model->fetch_single_case($id);
			echo json_encode($data);
		}
		public function update_diagnosis(){
			$patientidno=$this->input->post('patientidno');
			$caseno=$this->input->post('caseno');
			$description=$this->input->post('description');
			$add=$this->Records_model->update_diagnosis();
			if($add){
				$message="$description successfully updated with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('success','Case Rate successfully updated!');
			}else{
				$this->session->set_flashdata('failed','Unable to update case rate!');
			}
			redirect(base_url()."manage_diagnosis/$patientidno/$caseno");
		}
		public function update_disposition(){
			$patientidno=$this->input->post('patientidno');
			$caseno=$this->input->post('caseno');
			$update=$this->Records_model->update_disposition();
			if($update){
				$message="Disposition and Status successfully updated with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('success','Disposition and Status successfully updated!');
			}else{
				$this->session->set_flashdata('failed','Unable to update disposition and status!');
			}
			redirect(base_url()."view_patient_record_details/$patientidno/$caseno");
		}
		public function update_attending_doctor_mrd(){
			$caseno=$this->input->post('caseno');
			$patientidno=$this->input->post('patientidno');
			$update=$this->General_model->update_attending_doctor();
			if($update){
				$message="Attending doctor successfully updated with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('success','Attending doctor successfully updated!');
			}else{
				$this->session->set_flashdata('failed','Unable to update attending doctor!');
			}
			redirect(base_url()."view_patient_record_details/$patientidno/$caseno");
		}
		public function printCF3($caseno){
			$page="print_cf3";
			$data['caseno']=$caseno;
			$header=$this->General_model->getInfo();
			$html = $this->load->view('pages/general/'.$page,$data,true);
			//$html = $this->load->view('pages/general/'.$page,$data);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 10,
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_bottom' => 10,
				'format' => [210, 297]
			]);
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function testresultview($patientidno,$caseno,$test){
			$test=str_replace('%20',' ',$test);
			if($this->session->user_login){
				$page="view_test_result";
				if(!file_exists(APPPATH.'views/pages/medicalrecords/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$dept=$this->session->dept;
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."search_patient_record'>Search Patient</a> >> <a href='".base_url()."view_patient_record/$patientidno'>Patient Record</a> >> <a href='".base_url()."view_patient_record_details/$patientidno/$caseno'>Admission Details</a> >> $test Test Results";
					$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
					$data['results'] = $this->Records_model->getLabResult($caseno,$test);
					$data['patientidno'] = $patientidno;
					$data['caseno'] = $caseno;
					$data['testing'] = $test;
					$data['department'] = $dept;
					$this->load->view('templates/headerMRD',$data);
					$this->load->view('pages/medicalrecords/'.$page,$data);
					$this->load->view('templates/modalMRD',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function medsupview($patientidno,$caseno,$test){
			if($this->session->user_login){
				$page="medsupview";
				if(!file_exists(APPPATH.'views/pages/medicalrecords/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$dept=$this->session->dept;
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."search_patient_record'>Search Patient</a> >> <a href='".base_url()."view_patient_record/$patientidno'>Patient Record</a> >> <a href='".base_url()."view_patient_record_details/$patientidno/$caseno'>Admission Details</a> >> $test Details";
					$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
					$data['results'] = $this->Records_model->getAllCharges($caseno,$test);
					$data['patientidno'] = $patientidno;
					$data['caseno'] = $caseno;
					$data['test'] = $test;
					$data['department'] = $dept;
					$this->load->view('templates/headerSCM',$data);
					$this->load->view('pages/medicalrecords/'.$page,$data);
					$this->load->view('templates/modalMRD',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function documents($patientidno,$caseno,$test){
			$test=str_replace('%20',' ',$test);
			if($this->session->user_login){
				if($test=="Medico Legal"){
					$page="document_medicolegal";
				}else{
					$page="documents";
				}
				if(!file_exists(APPPATH.'views/pages/medicalrecords/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$dept=$this->session->dept;
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."search_patient_record'>Search Patient</a> >> <a href='".base_url()."view_patient_record/$patientidno'>Patient Record</a> >> <a href='".base_url()."view_patient_record_details/$patientidno/$caseno'>Admission Details</a> >> $test List";
					$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
					if($test=="Medico Legal"){
						$data['results'] = $this->Records_model->getAllMedicoLegal($caseno);
					}else{
						$data['results'] = $this->Records_model->getAllDocuments($caseno,$test);
					}
					$data['patientidno'] = $patientidno;
					$data['caseno'] = $caseno;
					$data['test'] = $test;
					$data['department'] = $dept;
					$this->load->view('templates/headerMRD',$data);
					$this->load->view('pages/medicalrecords/'.$page,$data);
					$this->load->view('templates/modalMRD',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function printMedCert($patientidno,$caseno,$id){
			$page="medical_certificate";
			$data['caseno']=$caseno;
			$data['header']=$this->General_model->getInfo();
			$data['discharged'] = $this->Admission_model->discharged($caseno);
			$data['caserates'] = $this->General_model->finalcaseratereport($caseno);
			$data['surgical'] = $this->General_model->surgical($caseno);
			$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
			$ap = $this->Admission_model->fetch_single_admission($caseno);			
			$data['document'] = $this->Records_model->getSingleDocument($id);
			$doctor = $this->General_model->fetch_single_doctor_by_code($ap['ap']);
			$html = $this->load->view('pages/medicalrecords/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 10,
				'margin_left' => 15,
				'margin_right' => 15,
				'margin_bottom' => 10,
				'format' => 'Letter'
			]);
			$mpdf->setHTMLFooter('
        <div>
        <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size:10px;font-weight:bold;">
            <tr>
            	<td colspan="3">PREPARED BY:</td>
			</tr>
			<tr>
				<td colspan="3" style="height: 20px;"></td>
			</tr>
			<tr>
				<td align="center" style="border-bottom: 1px solid black;">'.$this->session->fullname.'</td>
				<td width="20%">&nbsp;</td>
				<td align="center" style="border-bottom: 1px solid black;">'.$doctor['name'].', M.D.</td>
			</tr>
			<tr>
				<td align="center">Medical Record Clerk</td>
				<td width="20%">&nbsp;</td>
				<td align="center">Attending Physician</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td>License No.: <u>'.$doctor['licenseno'].'</u></td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td>CERTIFIED CORRECT PER RECORD:</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td style="border-bottom: 1px solid black;"></td>
			</tr>
            </table>
        </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function create_certificate(){
			$patientidno=$this->input->post('patientidno');
			$caseno=$this->input->post('caseno');
			$type=$this->input->post('type');
			if($type=="Medico Legal"){
				$create=$this->Records_model->create_medicolegal();
			}else{
				$create=$this->Records_model->create_certificate();
			}
			if($create){
				$this->session->set_flashdata('success','Certificate successfully created!');
			}else{
				$this->session->set_flashdata('failed','Unbale to create certificate!');
			}
			redirect(base_url()."documents/$patientidno/$caseno/$type");
		}
		public function fetch_single_certificate(){
			$id=$this->input->post('id');
			$data=$this->Records_model->fetch_single_certificate($id);
			echo json_encode($data);
		}
		public function update_certificate(){
			$patientidno=$this->input->post('patientidno');
			$caseno=$this->input->post('caseno');
			$type=$this->input->post('type');
			if($type=="Medico Legal"){
				$create=$this->Records_model->update_medicolegal();
			}else{
				$create=$this->Records_model->update_certificate();
			}
			if($create){
				$this->session->set_flashdata('success','Certificate successfully updated!');
			}else{
				$this->session->set_flashdata('failed','Unbale to update certificate!');
			}
			redirect(base_url()."documents/$patientidno/$caseno/$type");
		}
		public function delete_document($patientidno,$caseno,$test,$id){
			$test=str_replace('%20',' ',$test);
			if($test=="Medico Legal") {
				$create=$this->Records_model->delete_medicolegal($id);
			}else{
				$create=$this->Records_model->delete_certificate($id);
			}
			if($create){
				$message="Certificate successfully deleted with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('success','Certificate successfully deleted!');
			}else{
				$this->session->set_flashdata('failed','Unbale to delete certificate!');
			}
			redirect(base_url()."documents/$patientidno/$caseno/$test");
		}
		public function issue_document($patientidno,$caseno,$test,$id){
			$test=str_replace('%20',' ',$test);
			if($test=="Medico Legal"){
				$create=$this->Records_model->issue_medicolegal($id);
			}else{
				$create=$this->Records_model->issue_certificate($id);
			}
			if($create){
				$message="Certificate successfully issued with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('success','Certificate successfully issued!');
			}else{
				$this->session->set_flashdata('failed','Unbale to issue certificate!');
			}
			redirect(base_url()."documents/$patientidno/$caseno/$test");
		}

		public function printMedAbs($patientidno,$caseno,$id){
			$page="medical_abstract";
			$data['caseno']=$caseno;
			$data['header']=$this->General_model->getInfo();
			$data['discharged'] = $this->Admission_model->discharged($caseno);
			$data['caserates'] = $this->General_model->finalcaseratereport($caseno);
			$data['surgical'] = $this->General_model->surgical($caseno);
			$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
			$ap = $this->Admission_model->fetch_single_admission($caseno);
			$data['document'] = $this->Records_model->getSingleDocument($id);
			$doctor = $this->General_model->fetch_single_doctor_by_code($ap['ap']);
			//$html = $this->load->view('pages/medicalrecords/'.$page,$data,true);
			$html = $this->load->view('pages/medicalrecords/'.$page,$data);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 10,
				'margin_left' => 15,
				'margin_right' => 15,
				'margin_bottom' => 10,
				'format' => 'Letter'
			]);
			$mpdf->setHTMLFooter('
        ');
			// $mpdf->autoPageBreak = true;
			// $mpdf->WriteHTML($html);
			// $mpdf->Output();
		}
		public function printClinicalAbs($patientidno,$caseno,$id){
			$page="clinical_abstract";
			$data['caseno']=$caseno;
			$data['header']=$this->General_model->getInfo();
			$data['discharged'] = $this->Admission_model->discharged($caseno);
			$data['caserates'] = $this->General_model->finalcaseratereport($caseno);
			$data['surgical'] = $this->General_model->surgical($caseno);
			$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
			$ap = $this->Admission_model->fetch_single_admission($caseno);
			$data['document'] = $this->Records_model->getSingleDocument($id);
			$doctor = $this->General_model->fetch_single_doctor_by_code($ap['ap']);
			$html = $this->load->view('pages/medicalrecords/'.$page,$data,true);
			//$html = $this->load->view('pages/medicalrecords/'.$page,$data);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 10,
				'margin_left' => 15,
				'margin_right' => 15,
				'margin_bottom' => 10,
				'format' => 'Letter'
			]);
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function printConfineCert($patientidno,$caseno,$id){
			$page="confinement_certificate";
			$data['caseno']=$caseno;
			$data['header']=$this->General_model->getInfo();
			$data['discharged'] = $this->Admission_model->discharged($caseno);
			$data['caserates'] = $this->General_model->finalcaseratereport($caseno);
			$data['surgical'] = $this->General_model->surgical($caseno);
			$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
			$ap = $this->Admission_model->fetch_single_admission($caseno);
			$data['document'] = $this->Records_model->getSingleDocument($id);
			$doctor = $this->General_model->fetch_single_doctor_by_code($ap['ap']);
			$html = $this->load->view('pages/medicalrecords/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 10,
				'margin_left' => 15,
				'margin_right' => 15,
				'margin_bottom' => 10,
				'format' => 'Letter'
			]);
			$mpdf->setHTMLFooter('
        <div>
        <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size:10px;font-weight:bold;">
            <tr>
            	<td colspan="3">PREPARED BY:</td>
			</tr>
			<tr>
				<td colspan="3" style="height: 20px;"></td>
			</tr>
			<tr>
				<td align="center" style="border-bottom: 1px solid black;">'.$this->session->fullname.'</td>
				<td width="20%">&nbsp;</td>
				<td align="center" style="border-bottom: 1px solid black;">'.$doctor['name'].', M.D.</td>
			</tr>
			<tr>
				<td align="center">Medical Record Clerk</td>
				<td width="20%">&nbsp;</td>
				<td align="center">Attending Physician</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td>License No.: <u>'.$doctor['licenseno'].'</u></td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td>CERTIFIED CORRECT PER RECORD:</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td style="border-bottom: 1px solid black;"></td>
			</tr>
            </table>
        </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function fetch_single_medicolegal(){
			$id=$this->input->post('id');
			$data=$this->Records_model->fetch_single_medicolegal($id);
			echo json_encode($data);
		}
		public function printMedLegal($patientidno,$caseno,$id){
			$page="medico_legal";
			$data['caseno']=$caseno;
			$data['header']=$this->General_model->getInfo();
			$data['discharged'] = $this->Admission_model->discharged($caseno);
			$data['caserates'] = $this->General_model->finalcaserate($caseno);
			$data['surgical'] = $this->General_model->surgical($caseno);
			$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
			$ap = $this->Admission_model->fetch_single_admission($caseno);
			$data['document'] = $this->Records_model->getSingleMedicolegal($id);
			$doctor = $this->General_model->fetch_single_doctor_by_code($ap['ap']);
			$html = $this->load->view('pages/medicalrecords/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 10,
				'margin_left' => 15,
				'margin_right' => 15,
				'margin_bottom' => 10,
				'format' => 'Letter'
			]);
			$mpdf->setHTMLFooter('
        <div>
        <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size:10px;font-weight:bold;">
            <tr>
            	<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" style="height: 20px;"></td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td align="center" style="border-bottom: 1px solid black;">'.$doctor['name'].'</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td align="center">Attending Physician</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td>License No.: <u>'.$doctor['licenseno'].'</u></td>
			</tr>
            </table>
        </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function daily_admission_list(){
			$page = "daily_admission_list";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$header=$this->General_model->getinfo();

			$startdate=$this->input->post('startdate');
			$startdate=date('F d, Y',strtotime($startdate));
			$type=$this->input->post('type');
			if($type=="AdmissionTime"){
				$data['body']=$this->General_model->getAllAdmissionListTime();
			}else{
				$data['body']=$this->General_model->getAllAdmissionListAlphabetical();
			}
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'orientation' => 'P',
				'format' => 'letter'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4 style="margin-left:90px;">ADMISSION REPORT<br>'.$startdate.'</h4>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}

		public function baby_admission(){
			$page = "baby_admission";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$header=$this->General_model->getinfo();

			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$startdate=date('F d, Y',strtotime($startdate));
			$enddate=date('F d, Y',strtotime($enddate));
			$data['body'] = $this->General_model->getAllBabyAdmission();
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 45,
				'margin_left' => 5,
				'margin_right' => 5,
				'margin_bottom' => 10,
				'orientation' => 'L',
				'format' => 'Legal'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4 style="margin-left:90px;">LIST OF BABY<br>'.$startdate.' - '.$enddate.'</h4>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function expired_admission(){
			$page = "expired_admission";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$header=$this->General_model->getinfo();

			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			// $startdate=date('F d, Y',strtotime($startdate));
			// $enddate=date('F d, Y',strtotime($enddate));
			$data['startdate'] = $startdate;
			$data['enddate'] = $enddate;
			$data['body'] = $this->General_model->getAllExpiredPatient();
			//$html=$this->load->view('pages/reports/'.$page, $data,true);
			$html=$this->load->view('pages/reports/'.$page, $data);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'orientation' => 'P',
				'format' => 'Legal'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4 style="margin-left:90px;">LIST OF EXPIRED PATIENT<br>'.$startdate.' - '.$enddate.'</h4>
             </div>');
			$mpdf->autoPageBreak = true;
			//$mpdf->WriteHTML($html);
			//$mpdf->Output();
		}
		public function course_ward_compliance(){
			$page = "course_ward_compliance";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$header=$this->General_model->getinfo();

			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$startdate=date('F d, Y',strtotime($startdate));
			$enddate=date('F d, Y',strtotime($enddate));
			$data['body'] = $this->General_model->getAllCompliance();
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 45,
				'margin_left' => 5,
				'margin_right' => 5,
				'margin_bottom' => 10,
				'orientation' => 'L',
				'format' => 'Legal'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4 style="margin-left:90px;">CF4 Compliance Report<br>'.$startdate.' - '.$enddate.'</h4>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function patient_list(){
			$page = "patient_list";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$header=$this->General_model->getinfo();

			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$startdate=date('F d, Y',strtotime($startdate));
			$enddate=date('F d, Y',strtotime($enddate));
			$data['body'] = $this->General_model->getAllPatientList();
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 45,
				'margin_left' => 5,
				'margin_right' => 5,
				'margin_bottom' => 10,
				'orientation' => 'L',
				'format' => 'Legal'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4 style="margin-left:90px;">List of Patient<br>'.$startdate.' - '.$enddate.'</h4>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function reopen(){
			$patientidno=$this->input->post('patientidno');
			$caseno=$this->input->post('caseno');
			$password=$this->input->post('password');
			$authenticate=$this->Records_model->checkUser($password,$this->session->dept);
			if($authenticate){
				$reopen=$this->Records_model->reopen($caseno,$authenticate['name']);
				if($reopen){
					$message="Record successfully re-opened with caseno $caseno.";
					$loginuser=$authenticate['name'];
					$this->General_model->userlogs($message,$loginuser);
					$this->session->set_flashdata('success','Record successfully Re-opened!');
				}else{
					$this->session->set_flashdata('failed','Unable to reopen record!');
				}
			}else{
				$this->session->set_flashdata('failed','You are not authorized!');
			}
			redirect(base_url()."view_patient_record_details/$patientidno/$caseno");
		}
		public function discharge_patient(){
			$patientidno=$this->input->post('patientidno');
			$caseno=$this->input->post('caseno');
			$discharged=$this->Records_model->discharge_patient($caseno);
			if($discharged){
					$message="Patient successfully discharged with caseno $caseno.";
					$loginuser=$this->session->fullname;
					$this->General_model->userlogs($message,$loginuser);
					$this->session->set_flashdata('success','Patient successfully discharged!');
			}else{
				$this->session->set_flashdata('failed','Unable to discharge patient!');
			}
			redirect(base_url()."view_patient_record_details/$patientidno/$caseno");
		}

		public function index_card($patientidno){
			$page = "index_card";
			if(!file_exists(APPPATH.'views/pages/medicalrecords/'.$page.".php")){
				show_404();
			}
			// if($this->session->user_login){
			// }else{
			// 	redirect('http://192.168.0.100:100/ERP');
			// }
			$header=$this->General_model->getinfo();

			$data['body'] = $this->General_model->getAllInPatientAdmissionCard($patientidno);
			$patient = $this->General_model->getSinglePatientAdmission($patientidno);
			$lastname="";
			$firstname="";
			$middlename="";
			$age="";
			$sex="";
			$nationality="";
			$civilstatus="";
			$birthdate="";
			$address="";
			$contactno="";
			foreach($patient as $pt){
				$lastname=$pt['lastname'];
				$firstname=$pt['firstname'];
				$middlename=$pt['middlename'];
				$age=$pt['age'];
				$sex=$pt['sex'];
				$nationality=$pt['notify'];
				$civilstatus=$pt['stat1'];
				$birthdate=$pt['birthdate'];
				$address=$pt['street'].", ".$pt['barangay'].", ".$pt['municipality'].", ".$pt['province']." ".$pt['zipcode'];
				$contactno=$pt['patientcontactno'];
			}
			$hrn = $this->General_model->getHRN($patientidno);
			$html=$this->load->view('pages/medicalrecords/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 100,
				'margin_bottom' => 195,
				'format' => 'Letter'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="60"><img src="'.base_url().'design/images/kmsci.png" width="50"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:10px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <table border="0" width="100%" style="font-size: 9px;">
	<tr>
		<td width="50%">&nbsp;</td>
		<td align="right">Hospital No.:</td>
		<td align="center" width="15%" style="border-bottom: 1px solid black;">'.$hrn['hrn'].'</td>
	</tr>
</table>
<table border="0" cellspacing="0" cellpadding="1" width="100%" style="font-size: 9px; margin-top: 5px;">
	<tr>
		<td  width="30%" style="border-bottom: 1px solid;">'.$lastname.'</td>
		<td width="30%" style="border-bottom: 1px solid;">'.$firstname.'</td>
		<td width="30%" style="border-bottom: 1px solid;">'.$middlename.'</td>
		<td align="center" width="10%" style="border-bottom: 1px solid;">'.$age.'</td>
	</tr>
	<tr>
		<td><b>Lastname</b></td>
		<td><b>Firstname</b></td>
		<td><b>Middlename</b></td>
		<td align="center"><b>AGE</b></td>
	</tr>
</table>
<table border="0" cellspacing="0" cellpadding="1" width="100%" style="font-size: 9px; margin-top: 5px;">
	<tr>
		<td width="10%" align="center" style="border-bottom: 1px solid;">'.$sex.'</td>
		<td style="border-bottom: 1px solid;">'.$nationality.'</td>
		<td style="border-bottom: 1px solid;">'.$civilstatus.'</td>
		<td style="border-bottom: 1px solid;">'.$birthdate.'</td>
	</tr>
	<tr>
		<td align="center" width="10%"><b>Sex</b></td>
		<td width="30%"><b>Nationality</b></td>
		<td width="30%"><b>Civil Status</b></td>
		<td width="30%"><b>Date of Birth</b></td>
	</tr>
</table>
<table border="0" cellspacing="0" cellpadding="1" width="100%" style="font-size: 9px; margin-top: 5px;">
	<tr>
		<td width="80%" style="border-bottom: 1px solid;">'.$address.'</td>
		<td style="border-bottom: 1px solid;" align="right">'.$contactno.'</td>
	</tr>
	<tr>
		<td width="80%"><b>Address</b></td>
		<td width="20%" align="right"><b>Contact No</b></td>
	</tr>
</table>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function getHRN($patientidno){
			$generate=$this->Records_model->save_hrn($patientidno);
			if($generate){
				$message="Patient HRN successfully created with patientidno $patientidno.";
					$loginuser=$this->session->fullname;
					$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('HRN successfully generated!');window.location='".base_url()."view_patient_record/$patientidno';</script>";
			}else{
				echo "<script>alert('Unable to generate HRN!');window.location='".base_url()."view_patient_record/$patientidno';</script>";
			}
		}
		public function top_diseases(){
			$page = "top_diseases";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$header=$this->General_model->getinfo();

			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$startdate=date('F d, Y',strtotime($startdate));
			$enddate=date('F d, Y',strtotime($enddate));
			$data['startdate'] = $this->input->post('startdate');
			$data['enddate'] = $this->input->post('enddate');
			$data['body'] = $this->Records_model->getAllTopDiseases();
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'orientation' => 'L',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4 style="margin-left:90px;">List of Top 10 Diseases<br>'.$startdate.' - '.$enddate.'</h4>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function tag_emr(){
			$patientidno=$this->input->post('patientidno');
			$caseno=$this->input->post('caseno');
			$code=explode('_',$this->input->post('icd10code'));
			$icd10code=$code[1];
			$tag=$this->Records_model->tag_emr();
			if($tag){
				$message="Patient ICD Code successfully tagged to EMR with caseno $caseno and ICD10Code $icd10code.";
					$loginuser=$this->session->fullname;
					$this->General_model->userlogs($message,$loginuser);
					$this->session->set_flashdata('save_success',"Patient ICD Code successfully tagged to EMR with caseno $caseno and ICD10Code $icd10code.");
			}else{
				$this->session->set_flashdata('save_failed','Unable to tag ICD Code to EMR!');
			}
			redirect(base_url()."manage_diagnosis/$patientidno/$caseno");
		}
		public function remove_emr($patientidno,$caseno,$code){
			$remove=$this->Records_model->remove_emr($code,$caseno);
			if($remove){
				$message="Patient ICD Code successfully removed from EMR with caseno $caseno and ICD10Code $code.";
					$loginuser=$this->session->fullname;
					$this->General_model->userlogs($message,$loginuser);
					$this->session->set_flashdata('save_success',"Patient ICD Code successfully removed from EMR with caseno $caseno and ICD10Code $code.");
			}else{
				$this->session->set_flashdata('save_failed','Unable to remove ICD Code from EMR!');
			}
			redirect(base_url()."manage_diagnosis/$patientidno/$caseno");
		}
		public function logout_case($patientidno,$caseno){
			$remove=$this->Records_model->logout_case($patientidno,$caseno);
			if($remove){
				$message="Patient ICD Code successfully logged out with caseno $caseno.";
					$loginuser=$this->session->fullname;
					$this->General_model->userlogs($message,$loginuser);
					$this->session->set_flashdata('save_success',"Patient ICD Code successfully logged out with caseno $caseno.");
			}else{
				$this->session->set_flashdata('save_failed','Unable to logout ICD Code!');
			}
			redirect(base_url()."manage_diagnosis/$patientidno/$caseno");
		}
		public function view_documents(){
			if($this->session->user_login){
				$page="view_documents";
				if(!file_exists(APPPATH.'views/pages/medicalrecords/'.$page.".php")){
					$page="error404";
					//$this->load->view('pages/'.$page);
				}else{
					$rundate=$this->input->post('startdate');
					if(isset($_POST['forward'])){
						$forward=$this->Records_model->forward_certificate($rundate);
						if($forward){
							$message="Income from Records successfully forwarded to Cashier.";
							$loginuser=$this->session->fullname;
							$this->General_model->userlogs($message,$loginuser);

						}else{

						}
					}
					if(isset($_POST['cancel'])){
						$forward=$this->Records_model->cancel_forward_certificate($rundate);
						if($forward){
							$message="Income from Records successfully cancelled from collection.";
							$loginuser=$this->session->fullname;
							$this->General_model->userlogs($message,$loginuser);

						}else{

						}
					}
					unset($_POST['forward']);
					$dept=$this->session->dept;
					$data['header']=$this->General_model->getInfo();
					$data['title']="Certifcation Report";
					$data['documents'] = $this->Records_model->getAllDocumentsByDate($rundate);
					$data['medicolegal'] = $this->Records_model->getAllMedicoLegalByDate($rundate);
					$data['others'] = $this->Records_model->getAllOtherDocumentsByDate($rundate);
					$data['department'] = $dept;
					$data['datearray'] = $rundate;
					$this->load->view('templates/headerMRD',$data);
					$this->load->view('pages/medicalrecords/'.$page,$data);
					$this->load->view('templates/modalMRD',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}

		public function print_certificate_forward($rundate,$type){
			$page = "print_certificate_forward";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$header=$this->General_model->getinfo();
			$data['documents'] = $this->Records_model->getAllDocumentsByDate($rundate);
			$data['medicolegal'] = $this->Records_model->getAllMedicoLegalByDate($rundate);
			$data['others'] = $this->Records_model->getAllOtherDocumentsByDate($rundate);
			$data['type']=$type;
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 10,
				'margin_right' => 10,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4 style="margin-left:90px;">INCOME FROM RECORDS ('.$type.')<br>'.date('m/d/Y',strtotime($rundate)).'</h4>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function issue_second_copy($patientidno,$caseno,$test,$location){
			$test=str_replace('%20',' ',$test);
			if($test=="Medico Legal"){
				$amount=1000;
			}else{
				$amount=25;
			}
			$issue=$this->Records_model->issue_second_copy($caseno,$test,$amount);
			if($issue){
				$this->session->set_flashdata('success','2nd Copy of Certificate successfully submitted!');
			}else{
				$this->session->set_flashdata('failed','Unable to submit 2nd copy of certificate!');
			}
			redirect(base_url()."$location/$patientidno/$caseno/$test");
		}
		public function issue_second_copy_lab($patientidno,$caseno,$test,$type,$location){
			$test=str_replace('%20',' ',$test);
			$amount=5;
			$issue=$this->Records_model->issue_second_copy($caseno,$test,$amount);
			if($issue){
				$this->session->set_flashdata('save_success','2nd Copy of Diagnostics successfully submitted!');
			}else{
				$this->session->set_flashdata('failed','Unable to submit 2nd copy of Diagnostics!');
			}
			redirect(base_url()."$location/$patientidno/$caseno/$type");
		}
		public function issue_second_copy_others(){
			$test=$this->input->post('type');
			$patientidno=$this->input->post('patientidno');
			$caseno=$this->input->post('caseno');
			$amount=80;
			$issue=$this->Records_model->issue_second_copy($caseno,$test,$amount);
			if($issue){
				$this->session->set_flashdata('save_success','2nd Copy of Other Documents successfully submitted!');
			}else{
				$this->session->set_flashdata('failed','Unable to submit 2nd copy of Other Documents!');
			}
			redirect(base_url()."view_patient_record_details/$patientidno/$caseno");
		}

		public function photocopy(){
			$test="Photocopy";
			$caseno="WPOS-001";
			$amount=$this->input->post('amount');
			$issue=$this->Records_model->photocopy($caseno,$test,$amount);
			if($issue){
				echo "<script>alert('Photocopy income successfully posted!');</script>";
			}else{
				echo "<script>alert('Unable to post photocopy income!');</script>";
			}
			echo "<script>window.close();</script>";
		}
		public function upload_chart(){
			$caseno=$this->input->post('caseno');
			$patientidno=$this->input->post('patientidno');
			$remove=$this->Records_model->uploadChart();
			if($remove){
				$message="Chart successfully uploaded with caseno $caseno.";
					$loginuser=$this->session->fullname;
					$this->General_model->userlogs($message,$loginuser);
					$this->session->set_flashdata('save_success',"Chart successfully uploaded with caseno $caseno.");
			}else{
				$this->session->set_flashdata('save_failed','Unable to upload Chart!');
			}
			redirect(base_url()."view_patient_record_details/$patientidno/$caseno");
		}
		public function delete_chart($patientidno,$caseno,$id){
			$remove=$this->Records_model->deleteChart($id);
			if($remove){
				$message="Chart successfully deleted with caseno $caseno.";
					$loginuser=$this->session->fullname;
					$this->General_model->userlogs($message,$loginuser);
					$this->session->set_flashdata('save_success',"Chart successfully deleted with caseno $caseno.");
			}else{
				$this->session->set_flashdata('save_failed','Unable to deleted Chart!');
			}
			redirect(base_url()."view_patient_record_details/$patientidno/$caseno");
		}

		public function view_chart($id){
			if($this->session->user_login){
				$page="view_chart";
				if(!file_exists(APPPATH.'views/pages/medicalrecords/'.$page.".php")){
					$page="error404";
					//$this->load->view('pages/'.$page);
				}else{
					$data['id'] = $id;
					$this->load->view('pages/medicalrecords/'.$page,$data);
		}
	}else{
		echo "<script>window.close();</script>";
	}
}

		// public function view_documents_copy(){
		// 	if($this->session->user_login){
		// 		$page="view_documents_copy";
		// 		if(!file_exists(APPPATH.'views/pages/medicalrecords/'.$page.".php")){
		// 			$page="error404";
		// 			//$this->load->view('pages/'.$page);
		// 		}else{
		// 			$rundate=$this->input->post('startdate');
		// 			if(isset($_POST['forward'])){
		// 				$forward=$this->Records_model->forward_documents($rundate);
		// 				if($forward){
		// 					$message="Income from Records successfully forwarded to Cashier.";
		// 					$loginuser=$this->session->fullname;
		// 					$this->General_model->userlogs($message,$loginuser);
		// 				}else{

		// 				}
		// 			}
		// 			if(isset($_POST['cancel'])){
		// 				$forward=$this->Records_model->cancel_forward_documents($rundate);
		// 				if($forward){
		// 					$message="Income from Records successfully cancelled from collection.";
		// 					$loginuser=$this->session->fullname;
		// 					$this->General_model->userlogs($message,$loginuser);
		// 				}else{

		// 				}
		// 			}
		// 			unset($_POST['forward']);
		// 			$dept=$this->session->dept;
		// 			$data['header']=$this->General_model->getInfo();
		// 			$data['title']="Certifcation Report";
		// 			$data['documents'] = $this->Records_model->getAllOtherDocumentsByDate($rundate);
		// 			$data['department'] = $dept;
		// 			$data['datearray'] = $rundate;
		// 			$this->load->view('templates/headerMRD',$data);
		// 			$this->load->view('pages/medicalrecords/'.$page,$data);
		// 			$this->load->view('templates/modalMRD',$data);
		// 			$this->load->view('templates/footer');
		// 		}
		// 	}else{
		// 		redirect('http://192.168.0.100:100/ERP');
		// 	}
		// }
	public function add_icd(){
		$code=$this->input->post('code');
		$description=$this->input->post('description');
		$add=$this->Records_model->add_icd();
		if($add){
			$message="ICD10 $code - $description successfully added!";
			$loginuser=$this->session->fullname;
			$this->General_model->userlogs($message,$loginuser);
			echo "<script>alert('ICD10 $code - $description successfully added!');window.history.back();</script>";
		}else{
			echo "<script>alert('Unable to add ICD10Code! $code');window.history.back();</script>";
		}

	}
	public function printMedCertPreview($patientidno,$caseno,$id){
			$page="medical_certificate";
			$data['caseno']=$caseno;
			$data['header']=$this->General_model->getInfo();
			$data['discharged'] = $this->Admission_model->discharged($caseno);
			$data['caserates'] = $this->General_model->finalcaseratereport($caseno);
			$data['surgical'] = $this->General_model->surgical($caseno);
			$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
			$ap = $this->Admission_model->fetch_single_admission($caseno);			
			$data['document'] = $this->Records_model->getSingleDocument($id);
			$doctor = $this->General_model->fetch_single_doctor_by_code($ap['ap']);
			$html = $this->load->view('pages/medicalrecords/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 10,
				'margin_left' => 15,
				'margin_right' => 15,
				'margin_bottom' => 10,
				'format' => 'Letter'
			]);
			$mpdf->setHTMLFooter('
        <div>
        <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size:10px;font-weight:bold;">
            <tr>
            	<td colspan="3">PREPARED BY:</td>
			</tr>
			<tr>
				<td colspan="3" style="height: 20px;"></td>
			</tr>
			<tr>
				<td align="center" style="border-bottom: 1px solid black;">'.$this->session->fullname.'</td>
				<td width="20%">&nbsp;</td>
				<td align="center" style="border-bottom: 1px solid black;">'.$doctor['name'].', M.D.</td>
			</tr>
			<tr>
				<td align="center">Medical Record Clerk</td>
				<td width="20%">&nbsp;</td>
				<td align="center">Attending Physician</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td>License No.: <u>'.$doctor['licenseno'].'</u></td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td>CERTIFIED CORRECT PER RECORD:</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td style="border-bottom: 1px solid black;"></td>
			</tr>
            </table>
        </div>');			
			$mpdf->SetWatermarkText('PREVIEW');
			$mpdf->showWatermarkText = true;
			$mpdf->autoPageBreak = true;			
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function printMedAbsPreview($patientidno,$caseno,$id){
			$page="medical_abstract";
			$data['caseno']=$caseno;
			$data['header']=$this->General_model->getInfo();
			$data['discharged'] = $this->Admission_model->discharged($caseno);
			$data['caserates'] = $this->General_model->finalcaseratereport($caseno);
			$data['surgical'] = $this->General_model->surgical($caseno);
			$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
			$ap = $this->Admission_model->fetch_single_admission($caseno);
			$data['document'] = $this->Records_model->getSingleDocument($id);
			$doctor = $this->General_model->fetch_single_doctor_by_code($ap['ap']);
			$html = $this->load->view('pages/medicalrecords/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 10,
				'margin_left' => 15,
				'margin_right' => 15,
				'margin_bottom' => 10,
				'format' => 'Letter'
			]);			
			$mpdf->SetWatermarkText('PREVIEW');
			$mpdf->showWatermarkText = true;
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function printClinicalAbsPreview($patientidno,$caseno,$id){
			$page="clinical_abstract";
			$data['caseno']=$caseno;
			$data['header']=$this->General_model->getInfo();
			$data['discharged'] = $this->Admission_model->discharged($caseno);
			$data['caserates'] = $this->General_model->finalcaseratereport($caseno);
			$data['surgical'] = $this->General_model->surgical($caseno);
			$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
			$ap = $this->Admission_model->fetch_single_admission($caseno);
			$data['document'] = $this->Records_model->getSingleDocument($id);
			$doctor = $this->General_model->fetch_single_doctor_by_code($ap['ap']);
			$html = $this->load->view('pages/medicalrecords/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 10,
				'margin_left' => 15,
				'margin_right' => 15,
				'margin_bottom' => 10,
				'format' => 'Letter'
			]);
			$mpdf->SetWatermarkText('PREVIEW');
			$mpdf->showWatermarkText = true;
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function printConfineCertPreview($patientidno,$caseno,$id){
			$page="confinement_certificate";
			$data['caseno']=$caseno;
			$data['header']=$this->General_model->getInfo();
			$data['discharged'] = $this->Admission_model->discharged($caseno);
			$data['caserates'] = $this->General_model->finalcaseratereport($caseno);
			$data['surgical'] = $this->General_model->surgical($caseno);
			$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
			$ap = $this->Admission_model->fetch_single_admission($caseno);
			$data['document'] = $this->Records_model->getSingleDocument($id);
			$doctor = $this->General_model->fetch_single_doctor_by_code($ap['ap']);
			$html = $this->load->view('pages/medicalrecords/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 10,
				'margin_left' => 15,
				'margin_right' => 15,
				'margin_bottom' => 10,
				'format' => 'Letter'
			]);
			$mpdf->setHTMLFooter('
        <div>
        <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size:10px;font-weight:bold;">
            <tr>
            	<td colspan="3">PREPARED BY:</td>
			</tr>
			<tr>
				<td colspan="3" style="height: 20px;"></td>
			</tr>
			<tr>
				<td align="center" style="border-bottom: 1px solid black;">'.$this->session->fullname.'</td>
				<td width="20%">&nbsp;</td>
				<td align="center" style="border-bottom: 1px solid black;">'.$doctor['name'].', M.D.</td>
			</tr>
			<tr>
				<td align="center">Medical Record Clerk</td>
				<td width="20%">&nbsp;</td>
				<td align="center">Attending Physician</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td>License No.: <u>'.$doctor['licenseno'].'</u></td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td>CERTIFIED CORRECT PER RECORD:</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td style="border-bottom: 1px solid black;"></td>
			</tr>
            </table>
        </div>');
			$mpdf->SetWatermarkText('PREVIEW');
			$mpdf->showWatermarkText = true;
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function printMedLegalPreview($patientidno,$caseno,$id){
			$page="medico_legal";
			$data['caseno']=$caseno;
			$data['header']=$this->General_model->getInfo();
			$data['discharged'] = $this->Admission_model->discharged($caseno);
			$data['caserates'] = $this->General_model->finalcaseratereport($caseno);
			$data['surgical'] = $this->General_model->surgical($caseno);
			$data['patient'] = $this->Admission_model->fetch_single_admission($caseno);
			$ap = $this->Admission_model->fetch_single_admission($caseno);
			$data['document'] = $this->Records_model->getSingleMedicolegal($id);
			$doctor = $this->General_model->fetch_single_doctor_by_code($ap['ap']);
			$html = $this->load->view('pages/medicalrecords/'.$page,$data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 10,
				'margin_left' => 15,
				'margin_right' => 15,
				'margin_bottom' => 10,
				'format' => 'Letter'
			]);
			$mpdf->setHTMLFooter('
        <div>
        <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size:10px;font-weight:bold;">
            <tr>
            	<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" style="height: 20px;"></td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td align="center" style="border-bottom: 1px solid black;">'.$doctor['name'].'</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td align="center">Attending Physician</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td>License No.: <u>'.$doctor['licenseno'].'</u></td>
			</tr>
            </table>
        </div>');
			$mpdf->SetWatermarkText('PREVIEW');
			$mpdf->showWatermarkText = true;
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function update_final_diag(){
			$caseno=$this->input->post("caseno");
			$patientidno=$this->input->post("patientidno");
			$update=$this->Records_model->update_final_diag();
			if($update){
					$message="Final diagnosis successfully updated with caseno $caseno.";
					$loginuser=$this->session->fullname;
					$this->General_model->userlogs($message,$loginuser);
					$this->session->set_flashdata('save_success',"Final diagnosis successfully updated with caseno $caseno.");
			}else{
				$this->session->set_flashdata('save_failed','Unable to update final diagnosis!');
			}
			redirect(base_url()."view_patient_record_details/$patientidno/$caseno");
		}
		//==============================End of MRD Module========================================

		//==============================Start of Dietary Module==================================
		public function patient_list_view(){
			if($this->session->user_login){
				$page="patient_list_view";
				if(!file_exists(APPPATH.'views/pages/dietary/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Active In-Patient";
					$data['inpatient'] = $this->Admission_model->getAllInPatient();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDietary',$data);
					$this->load->view('pages/dietary/'.$page,$data);
					$this->load->view('templates/modalDietary',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_patient_list_view(){
			if($this->session->user_login){
				$page="patient_list_view";
				if(!file_exists(APPPATH.'views/pages/dietary/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Active In-Patient";
					$searchme=$this->input->post('searchme');
					$data['inpatient'] = $this->Admission_model->getSingleInPatient($searchme);
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDietary',$data);
					$this->load->view('pages/dietary/'.$page,$data);
					$this->load->view('templates/modalDietary',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}

		public function patient_list_view_details($caseno){
			if($this->session->user_login){
				$page="patient_list_view_details";
				if(!file_exists(APPPATH.'views/pages/dietary/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Patient Diet Details";
					$data['patient'] = $this->Dietary_model->getSinglePatientAdmission($caseno);
					$data['diet'] = $this->Dietary_model->getAllPatientDiet($caseno);
					$data['alldiet'] = $this->Dietary_model->getAllDiet();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDietary',$data);
					$this->load->view('pages/dietary/'.$page,$data);
					$this->load->view('templates/modalDietary',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function add_diet(){
			$caseno=$this->input->post('caseno');
			$diet=$this->input->post('diet');
			$insert=$this->Dietary_model->add_diet();
			if($insert){
				$message="Patient diet successfully saved with caseno $caseno and diet code $diet.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('success','Patient diet successfully saved!');
			}else{
				$this->session->set_flashdata('failed','Unable to save patient diet!');
			}
			redirect(base_url()."patient_list_view_details/$caseno");
		}
		public function print_diet_tag($caseno){
			$page = "diet_tag";
			if(!file_exists(APPPATH.'views/pages/dietary/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$header=$this->General_model->getinfo();

			$data['body'] = $this->Dietary_model->getSingleAdmissionDiet($caseno);
			$html=$this->load->view('pages/dietary/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 5,
				'margin_left' => 5,
				'margin_right' => 5,
				'margin_bottom' => 10,
				'format' => 'Letter'
			]);
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function print_diet_tag_all(){
			$page = "diet_tag_all";
			if(!file_exists(APPPATH.'views/pages/dietary/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$header=$this->General_model->getinfo();

			$data['body'] = $this->Dietary_model->getAllAdmissionDiet();
			$html=$this->load->view('pages/dietary/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 15,
				'margin_left' => 5,
				'margin_right' => 5,
				'margin_bottom' => 20,
				'format' => 'folio'
			]);
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function meal_monitoring(){
			if($this->session->user_login){
				$page="meal_monitoring";
				if(!file_exists(APPPATH.'views/pages/dietary/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$this->session->unset_userdata('station');
					$this->session->unset_userdata('meal_type');
					$data['header']=$this->General_model->getInfo();
					$data['title']="Active In-Patient";
					$data['inpatient'] = $this->Dietary_model->getAllInPatient();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDietary',$data);
					$this->load->view('pages/dietary/'.$page,$data);
					$this->load->view('templates/modalDietary',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}

		public function pf_report(){
			if($this->session->user_login){
				$page="pf_report";
				if(!file_exists(APPPATH.'views/pages/dietary/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$this->session->unset_userdata('station');
					$data['header']=$this->General_model->getInfo();
					$data['title']="Prof. Fee Report";
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDietary',$data);
					$this->load->view('pages/dietary/'.$page,$data);
					$this->load->view('templates/modalDietary',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}

		public function serve_meal()
		{
			if ($this->session->user_login) {
				$page = "serve_meal";
				if (!file_exists(APPPATH . 'views/pages/dietary/' . $page . ".php")) {
					$page = "error404";
					$this->load->view('pages/' . $page);
				} else {
					if($this->session->station){
						$station = $this->session->station;
						$mt = $this->session->meal_type;
					}else{
						$this->session->set_userdata('station', $this->input->post('station'));
						$this->session->set_userdata('meal_type', $this->input->post('meal_type'));
						$station = $this->session->station;
						$mt = $this->session->meal_type;
					}
					$mt1 = mb_strtoupper($mt);
					$data['header'] = $this->General_model->getInfo();
					$data['title'] = "SERVE $mt1 ($station)";
					$data['inpatient'] = $this->Dietary_model->getAllPatientByStation();
					$data['department'] = $this->session->dept;
					$data['meal_type'] = $mt;
					$data['station'] = $station;
					$dept = $this->session->dept;
					$this->load->view('templates/headerDietary', $data);
					$this->load->view('pages/dietary/' . $page, $data);
					$this->load->view('templates/modalDietary',$data);
					$this->load->view('templates/footer');
				}
			} else {
				redirect('http://192.168.0.100:100/ERP');
			}
		}
			public function meal_served(){
				$serve=$this->Dietary_model->meal_served();
				if($serve){
					$this->session->set_flashdata('save_success','Meal successfully served!');
				}else{
					$this->session->set_flashdata('save_failed','Unable to serve meal!');
				}
				redirect(base_url()."serve_meal");
			}

		public function masterlist_print(){
			$page = "masterlist_print";
			if(!file_exists(APPPATH.'views/pages/dietary/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$header=$this->General_model->getinfo();
			$station=$this->input->post('station');
			$meal=$this->input->post('meal_type');
			$data['body'] = $this->Dietary_model->getAllPatientMasterlist();
			$data['meal_type'] = $meal;
			$data['station'] = $station;
			$html=$this->load->view('pages/dietary/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'margin_bottom' => 40,
				'format' => 'Folio'
			]);
			$mpdf->setHTMLHeader('
			<div style="text-align:center;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="20">&nbsp;</td>
                <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                <font style="font-size:13px;">'.$header['address'].'</font></td>
            <td width="30">&nbsp;</td>
        </tr>
        </table>
        <center><h4>DIET LIST</h4></center>
        <table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse: collapse; font-size: 11px;">
        	<tr>
				<td width="10%">Meal Type:</td>
				<td>'.mb_strtoupper($meal).'</td>
				<td width="10%">Date:</td>
				<td>'.date('m/d/Y').'</td>
			</tr>
			<tr>
				<td>Station:</td>
				<td>'.$station.'</td>
				<td>Time:</td>
				<td>'.date('h:i A').'</td>
			</tr>
		</table>
		<br>
        </div>
			');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function meal_monitoring_sheet(){
			$page = "meal_monitoring_sheet";
			if(!file_exists(APPPATH.'views/pages/dietary/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$header=$this->General_model->getinfo();
			$station=$this->input->post('station');
			$data['inpatient'] = $this->Dietary_model->getAllInPatientByStation();
			$data['station'] = $station;
			$html=$this->load->view('pages/dietary/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'Folio'
			]);
			$mpdf->setHTMLHeader('
			<div style="text-align:center;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="20">&nbsp;</td>
                <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                <font style="font-size:13px;">'.$header['address'].'</font></td>
            <td width="30">&nbsp;</td>
        </tr>
        </table>
        <center><h4>MEAL MONITORING SHEET</h4></center>
        <table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse: collapse; font-size: 11px;">
        	<tr>
				<td width="10%">Meal Type:</td>
				<td>'.mb_strtoupper($meal).'</td>
				<td width="10%">Date:</td>
				<td>'.date('m/d/Y').'</td>
			</tr>
			<tr>
				<td>Station:</td>
				<td>'.$station.'</td>
				<td>Time:</td>
				<td>'.date('h:i A').'</td>
			</tr>
		</table>
		<br>
        </div>
			');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function add_charge_item(){
			$caseno=$this->input->post('caseno');
			$charged=$this->Dietary_model->add_charge_item();
			if($charged){
				$message="Patient dietary counseling has been charged with caseno $caseno.!";
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Item successfully charged!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to charge item!');
			}
			redirect(base_url()."patient_list_view_details/$caseno");
		}
		public function delete_charged_item($caseno,$id){
			$delete=$this->Dietary_model->delete_charged_item($id);
			if($delete){
				$message="Patient dietary counseling has been deleted with refno $id and caseno $caseno.!";
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Item successfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete item!');
			}
			redirect(base_url()."patient_list_view_details/$caseno");
		}
		//==============================End of Dietary Module====================================

		//==============================Start of Dialysis Module=================================
		public function search_patient_record_rdu(){
			if($this->session->user_login){
				$page="search_patient_record_rdu";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Search Patient Record";
					$data['inpatient'] = $this->General_model->getAllRDUPatient();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDialysis',$data);
					$this->load->view('pages/dialysis/'.$page,$data);
					$this->load->view('templates/modalRDU',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_patient_record_search_rdu(){
			if($this->session->user_login){
				$page="search_patient_record_rdu";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Search Patient Record";
					$searchme=$this->input->post('searchme');
					$data['inpatient'] = $this->Admission_model->getSelectedRDUPatient($searchme);
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDialysis',$data);
					$this->load->view('pages/dialysis/'.$page,$data);
					$this->load->view('templates/modalRDU',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}

		public function activate_account(){
			$password=$this->input->post('password');
			$dept=$this->session->dept;
			$caseno=$this->input->post('caseno');
			$reason=$this->input->post('reason');
			$check=$this->General_model->checkPassword($password,$dept);
			if(count($check)>0){
				$loginuser="";
				foreach($check as $user){
					$loginuser=$user['name'];
				}
				$update=$this->Dialysis_model->activate_account();
				$message="Patient account ($caseno) has been activated by $loginuser with the reason $reason";
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Patient account successfully activated!');window.location='".base_url()."search_patient_record_rdu';</script>";
			}else{
				echo "<script>alert('Unable to activate patient account!');window.location='".base_url()."search_patient_record_rdu';</script>";
			}

		}
		public function inventory_reports(){
			$page="inventory_reports";
			$header=$this->General_model->getInfo();
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$code=$this->input->post('item');
			$data['items'] = $this->Dialysis_model->getAllItemsDispensed();
			$data['dept']=$this->session->dept;
			$item=$this->Dialysis_model->getSingleItem($code);
			$html=$this->load->view('pages/dialysis/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_bottom' => 22,
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
        <div style="text-align:center;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="20">&nbsp;</td>
                <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                <font style="font-size:13px;">'.$header['address'].'</font></td>
            <td width="30">&nbsp;</td>
        </tr>
        </table>
        <center><h4>RDU ITEM INVENTORY REPORT</h4></center>
        <table width="100%" border="0" cellspacing="0" style="font-family:Arial,Helvetica; font-size: 12px;">
            <tr>
            <td width="25%" align="right">Inclusive Date:</td>
            <td><b>'.date('m/d/Y',strtotime($startdate)).' to '.date('m/d/Y',strtotime($enddate)).'</b></td>
            </tr>
        </table>
        ');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();

		}

		public function stock_on_hand_rdu(){
			$page="stock_on_hand";
			$header=$this->General_model->getInfo();
			$data['items'] = $this->Dialysis_model->getAllItems();
			$data['dept']=$this->session->dept;
			$datenow=date('F d, Y');

			$html=$this->load->view('pages/dialysis/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 10,
				'margin_right' => 10,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
        <div style="text-align:center;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="20">&nbsp;</td>
                <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                <font style="font-size:13px;">'.$header['address'].'</font></td>
            <td width="30">&nbsp;</td>
        </tr>
        </table>
        <center><h4>STOCK ON HAND<br>as of '.$datenow.'</h4></center>
        ');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();

		}
		public function for_transmittal(){
			if($this->session->user_login){
				$page="for_transmittal";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					 $data['header']=$this->General_model->getInfo();
					 $data['title']="For Transmittal";
					 $data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDialysis',$data);
					$this->load->view('pages/dialysis/'.$page,$data);
					$this->load->view('templates/modalRDU',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function consoldetails($csn){
			if($this->session->user_login){
				$page="consoldetails";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					 $data['header']=$this->General_model->getInfo();
					 $data['title']="Patient Profile";
					 $data['department'] = $this->session->dept;
					 $data['rducaseno'] = $csn;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDialysis-consol-details',$data);
					$this->load->view('pages/dialysis/'.$page,$data);
					$this->load->view('templates/modalRDU',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function guarantee_letter(){
			if($this->session->user_login){
				$page="guarantee_letter";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					 $data['header']=$this->General_model->getInfo();
					 $data['title']="Guarantee Letter";
				     $data['inpatient'] = $this->General_model->getAllPatient();
					 $data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDialysis',$data);
					$this->load->view('pages/dialysis/'.$page,$data);
					$this->load->view('templates/modalRDU',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_guarantee_letter(){
			if($this->session->user_login){
				$page="guarantee_letter";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					 $data['header']=$this->General_model->getInfo();
					 $data['title']="Guarantee Letter";
					 $searchme=$this->input->post('searchme');
				     $data['inpatient'] = $this->Admission_model->getSelectedPatient($searchme);
					 $data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDialysis',$data);
					$this->load->view('pages/dialysis/'.$page,$data);
					$this->load->view('templates/modalRDU',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function manage_guarantee_letter($patientidno){
			if($this->session->user_login){
				$page="manage_guarantee_letter";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					 $data['header']=$this->General_model->getInfo();
					 $data['title']="Manage Guarantee Letter";
				     $data['patient'] = $this->Dialysis_model->getSinglePatientByID($patientidno);
				     $data['guarantee_letter'] = $this->Dialysis_model->getAllGuaranteeLetter($patientidno);
					 $data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDialysis',$data);
					$this->load->view('pages/dialysis/'.$page,$data);
					$this->load->view('templates/modalRDU',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function fetch_gl_details(){
			$id=$this->input->post('id');
			$gl_id=$this->input->post('gl_id');
			$data=$this->Dialysis_model->fetchGLDetails($gl_id);
			echo json_encode($data);
		}
		public function save_gl(){
			$patientidno=$this->input->post('patientidno');
			$save=$this->Dialysis_model->save_gl();
			if($save){
				$message="Patient Guarantee Letter successfully saved with patientidno $patientidno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Patient Guarantee Letter successfully saved!');window.location='".base_url()."manage_guarantee_letter/$patientidno';</script>";
			}else{
				echo "<script>alert('Unable to save patient guarantee letter!');window.location='".base_url()."manage_guarantee_letter/$patientidno';</script>";
			}

		}
		public function view_guarantee_letter($patientidno,$gl_id){
			$gl_id=str_replace('%20',' ',$gl_id);
			if($this->session->user_login){
				$page="view_guarantee_letter";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					 $data['header']=$this->General_model->getInfo();
					 $data['title']="Guarantee Letter Ledger";
				     $data['patient'] = $this->Dialysis_model->getSinglePatientByID($patientidno);
				     $data['guarantee_letter'] = $this->Dialysis_model->getAllGuaranteeLetterHistory($gl_id,$patientidno);
					 $data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDialysis',$data);
					$this->load->view('pages/dialysis/'.$page,$data);
					$this->load->view('templates/modalRDU',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function gl_allocation($caseno,$patientidno){
			if($this->session->user_login){
				$page="gl_allocation";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					 $data['header']=$this->General_model->getInfo();
					 $data['title']="Guarantee Letter Posting";
					 $data['hosp'] = $this->Hmo_model->getHospitalBillPayment($caseno);
				     $data['patient'] = $this->Dialysis_model->getSinglePatientByID($patientidno);
				     $data['allocation'] = $this->Dialysis_model->getRDUAllocation($caseno);
					 $data['department'] = $this->session->dept;
					 $data['caseno'] = $caseno;
					 $data['patientidno'] = $patientidno;
					$dept=$this->session->dept;
					$this->load->view('templates/headerDialysis',$data);
					$this->load->view('pages/dialysis/'.$page,$data);
					$this->load->view('templates/modalRDU',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_gl_posting(){
			$caseno=$this->input->post('caseno');
			$patientidno=$this->input->post('patientidno');
			$post=$this->Dialysis_model->post_gl();
			if($post){
				echo "<script>alert('Assistance successfully posted!');window.location='".base_url()."gl_allocation/$caseno/$patientidno';</script>";
			}else{
				echo "<script>alert('Unable to post assistance!');window.location='".base_url()."gl_allocation/$caseno/$patientidno';</script>";
			}
		}
		public function remove_gl_posting($caseno,$patientidno,$refno){
			$assistance=$this->Dialysis_model->remove_gl_posting($refno);
			if($assistance){
				$message="Patient allocated guarantee letter has been removed with caseno $caseno!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Posted guarantee letter successfully removed!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to remove posted guarantee letter!');
			}
			redirect(base_url()."gl_allocation/$caseno/$patientidno");
		}
		public function patient_discharged(){
			$discharged=$this->Dialysis_model->patient_discharged();
			if($discharged){
				$message="Patient successfully discharged with caseno $caseno!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Patient successfully discharged!');</script>";
			}else{
				echo "<script>alert('Unable to discharge patient!');</script>";
			}				
				echo "<script>window.close();</script>";
		}
		public function rdu_discharged($caseno){			
				$page="rdu_discharged";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					 $data['header']=$this->General_model->getInfo();
					 $data['title']="Discharge Patient";					 
					 $data['department'] = $this->session->dept;
					 $data['caseno'] = $caseno;					 
					$dept=$this->session->dept;
					$this->load->view('templates/headerDialysis',$data);
					$this->load->view('pages/dialysis/'.$page,$data);
					$this->load->view('templates/modalRDU',$data);
					$this->load->view('templates/footer');
				}			
		}
		public function daily_discharged_dialysis(){
			$page="print_daily_discharged_report_rdu";
			if(!file_exists(APPPATH.'views/pages/billing/'.$page.".php")){
				show_404();
			}
			$rundate=$this->input->post('rundate');			
			$user=$this->session->fullname;
			$data['department']="";
			$data['button']="";
			$data['type']="";
			$startdate=date('F d, Y',strtotime($rundate));
			$data['startdate']=$startdate;
			$header=$this->General_model->getinfo();
			$data['body']=$this->General_model->getAllDischargedReportRDU();
			//$this->load->view('pages/billing/'.$page, $data);
			$html=$this->load->view('pages/billing/'.$page, $data,true);
			$page="print_daily_discharged_report_credit_rdu";
			$html1=$this->load->view('pages/billing/'.$page, $data,true);
			//$this->load->view('pages/billing/'.$page, $data);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',				
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
             </div>');
			$mpdf->setHTMLFooter('
            <div style="text-align:left;">
             <table width="50%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td><b>Prepared by:</b></td>
                     <td><b>Checked by:</b></td>
                     <td><b>Noted by:</b></td>
              </tr>
              <tr>
              	<td colspan="3">&nbsp;</td>
              </tr>
              <tr>
                     <td><u>'.$user.'</u></td>
                     <td><u>E. MUDANZA</u></td>
                     <td><u>MEHRALYN L. TORCULAS</u></td>
              </tr>
              <tr>
                     <td>BILLING</td>
                     <td>CASHIER</td>
                     <td>FINANCE OFFICER</td>
              </tr>
            </table>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->AddPage();
			$mpdf->WriteHTML($html1);
			$mpdf->Output();
	 }
	 public function daily_discharged_dialysis_summary(){
			$page="print_daily_discharged_report_summary_rdu";
			if(!file_exists(APPPATH.'views/pages/billing/'.$page.".php")){
				show_404();
			}
			$rundate=$this->input->post('rundate');
			$department=$this->input->post('department');
			$user=$this->session->fullname;
			$startdate=date('F d, Y',strtotime($rundate));
			$data['rundate']=$rundate;
			$data['department']=$department;
			$data['user'] = $user;
			$header=$this->General_model->getinfo();
			$data['body']=$this->General_model->getAllDischargedReportRDU();
			//$this->load->view('pages/billing/'.$page, $data);
			$html=$this->load->view('pages/billing/'.$page, $data,true);
			// $page="print_daily_discharged_report_credit";
			// $html1=$this->load->view('pages/billing/'.$page, $data,true);
			//$this->load->view('pages/billing/'.$page, $data);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'Legal'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:center;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h3>Daily Discharged Summary</h3>
            As of '.$startdate.'
            <br>
            <br>
            <table width="100%" border="0" style="font-size:12px;">
        <tr>
            <td align="left" style="font-size:12px;" width="40%"><b>ACCOUNTS</b></td>
            <td align="right" style="font-size:12px;" width="20%"><b>BEG. BALANCE</b></td>
            <td align="right" style="font-size:12px;" width="20%"><b>TODAY</b></td>
            <td align="right" style="font-size:12px;" width="20%"><b>TOTAL TO DATE</b></td>
        </tr>
        </table>
             </div>');
			$mpdf->setHTMLFooter('
				<div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td><b>Prepared by:</b></td>
                     <td><b>Checked by:</b></td>
                     <td><b>Noted by:</b></td>
              </tr>
              <tr>
                <td colspan="3">&nbsp;</td>
              </tr>
              <tr>
                     <td><u>'.$user.'</u></td>
                     <td><u>E. MUDANZA</u></td>
                     <td><u>MEHRALYN L. TORCULAS</u></td>
              </tr>
              <tr>
                     <td>BILLING</td>
                     <td>CASHIER</td>
                     <td>FINANCE OFFICER</td>
              </tr>
            </table>
             </div>
            ');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
	 }

	 public function hospital_charges($caseno,$username){
			$page="hospital_charges";
			if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
				show_404();
			}
			
			$header=$this->General_model->getinfo();
			$data['body']=$this->Dialysis_model->getPatientCharges($caseno);
			$data['patient']=$this->Dialysis_model->getPatient($caseno);	
			$data['username']=$username;
			$data['caseno']=$caseno;
			$html=$this->load->view('pages/dialysis/'.$page, $data,true);			
			// $html=$this->load->view('pages/dialysis/'.$page, $data);			
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 15,
				'margin_right' => 15,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'Letter'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:center;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:14px;">'.$header['address'].'</font><br>
                    <font style="font-size:14px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4>ESTIMATE OF HOSPITAL CHARGES (HCI) and INFORMED FINANCIAL CONSENT</h4>                  
             </div>');			
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
	 }
	 public function print_dialysis_summary(){
			$page = "print_dialysis_summary";
			if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');			
			$header=$this->General_model->getinfo();			
			$data['body'] = $this->Dialysis_model->getAllOxygenUsed();			
			$html=$this->load->view('pages/dialysis/'.$page, $data,true);
			//$html=$this->load->view('pages/dialysis/'.$page, $data);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 10,
				'margin_right' => 10,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
			<br>
			<table width="100%" border="0" style="font-size:14px;">
				<tr>
					<td colspan="6" align="center"><h2>OXYGEN SUPPLIES SUMMARY REPORT</h2></td>
				</tr>
				<tr>
					<td>Date From: <b>'.date('M-d-Y',strtotime($startdate)).'</b></td>
					<td colspan="5">&nbsp;</td>					
				</tr>
				<tr>
					<td>Date To: <b>'.date('M-d-Y',strtotime($enddate)).'</b></td>
					<td colspan="5">&nbsp;</td>					
				</tr>
			</table>
			<table border="1" width="100%" style="border-collapse: collapse;">
				<tr>
					<td width="5%">No.</td>
					<td width="50%">Name of Patient</td>
					<td width="15%">Date Admitted</td>
					<td width="15%">Per Liter</td>
					<td width="15%">Amount</td>
				</tr>
			</table>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		//==============================End of Dialysis Module===================================

		//==============================Start of HMO Module======================================
		public function admit_opdprocedure(){
			if($this->session->user_login){
				$page="opdprocedure";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Active OPD Procedure ";

					$data['inpatient'] = $this->Admission_model->getAllOPDProcedure();
					$data['attending'] = $this->General_model->getAttendingDoctor();
					$data['company'] = $this->General_model->getCompany();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="ADMISSION"){
						$this->load->view('templates/headerAdmission',$data);
						$this->load->view('pages/hmo/'.$page,$data);
						$this->load->view('templates/modalAdmission',$data);
					}
					if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/hmo/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					if($dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
						$this->load->view('pages/hmo/'.$page,$data);
						$this->load->view('templates/modalRDU',$data);
					}
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/hmo/'.$page,$data);
						$this->load->view('templates/modalHMO',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function hmo_allocation($caseno){
			if($this->session->user_login){
				$page="hmo_allocation";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$pat=$this->Hmo_model->getPatient($caseno);
					$data['header']=$this->General_model->getInfo();
					$data['title']="<i class='icofont-user'></i> ".$pat['lastname'].", ".$pat['firstname'];

					$data['allocation'] = $this->Hmo_model->getHMOAllocation();
					$data['caseno'] = $caseno;
					$data['patientidno'] = $pat['patientidno'];
					$dept=$this->session->dept;
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
					}
					if($dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
					}
					$this->load->view('pages/hmo/'.$page,$data);
					$this->load->view('templates/modalHMO',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_allocation(){
			$caseno=$this->input->post('caseno');
			$save=$this->Hmo_model->save_allocation();
			if($save){
				$message="Patient allocated hmo has been posted with caseno $caseno!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Allocation successfully saved!');

			}else{

			}
				redirect(base_url()."hmo_allocation/$caseno");
		}
		public function remove_allocation($caseno,$producttype){
			$producttype=str_replace('%20',' ',$producttype)			;
			$save=$this->Hmo_model->remove_allocation($caseno,$producttype);
			if($save){
				$message="Patient allocated hmo has been removed with caseno $caseno!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Allocation successfully removed!');
				redirect(base_url()."hmo_allocation/$caseno");
			}else{
				$this->session->set_flashdata('save_failed','Unable to remove allocation!');
				redirect(base_url()."hmo_allocation/$caseno");
			}
		}
		public function save_allocation_pf(){
			$caseno=$this->input->post('caseno');
			$save=$this->Hmo_model->save_allocation_pf();
			if($save){
				$message="Patient PF allocated hmo has been posted with caseno $caseno!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','HMO PF allocation successfully saved!');
				redirect(base_url()."hmo_allocation/$caseno");
			}else{
				redirect(base_url()."hmo_allocation/$caseno");
			}
		}
		public function remove_allocation_pf($caseno,$refno){
			$save=$this->Hmo_model->remove_allocation_pf($caseno,$refno);
			if($save){
				$message="Patient allocated hmo pf has been removed with caseno $caseno!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','PF HMO allocation successfully removed!');
				redirect(base_url()."hmo_allocation/$caseno");
			}else{
				$this->session->set_flashdata('save_failed','Unable to remove pf hmo allocation!');
				redirect(base_url()."hmo_allocation/$caseno");
			}
		}
		public function remove_allocation_all($caseno){
			$save=$this->Hmo_model->remove_allocation_all($caseno);
			if($save){
				$message="Patient allocated hmo has been removed with caseno $caseno!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','HMO allocation successfully removed!');
				redirect(base_url()."hmo_allocation/$caseno");
			}else{
				$this->session->set_flashdata('save_failed','Unable to remove hmo allocation!');
				redirect(base_url()."hmo_allocation/$caseno");
			}
		}
		public function hmo_assistance($caseno){
			if($this->session->user_login){
				$page="hmo_assistance";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$pat=$this->Hmo_model->getPatient($caseno);
					$data['header']=$this->General_model->getInfo();
					$data['title']="<i class='icofont-user'></i> ".$pat['lastname'].", ".$pat['firstname'];

					$data['allocation'] = $this->Hmo_model->getHMOAssistance($caseno);
					$data['hosp'] = $this->Hmo_model->getHospitalBillPayment($caseno);
					$data['accttitle']=$this->Hmo_model->getAccttitle();
					$data['allocation_pf'] = $this->Hmo_model->getHMOAssistancePF($caseno);
					$data['caseno'] = $caseno;
					$data['patientidno']=$pat['patientidno'];
					$dept=$this->session->dept;
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
					}else if($dept=="BILLING"){
						$this->load->view('templates/headerOther',$data);
					}
					$this->load->view('pages/hmo/'.$page,$data);
					$this->load->view('templates/modalHMO',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_assistance(){
			$caseno=$this->input->post('caseno');
			$assistance=$this->Hmo_model->save_assistance();
			if($assistance){
				$message="Patient allocated hmo assistance has been saved with caseno $caseno!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','HMO assistance successfully saved!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to save hmo assistance!');
			}
			redirect(base_url()."hmo_assistance/$caseno");
		}
		public function remove_assistance($refno,$caseno){
			$assistance=$this->Hmo_model->remove_assistance($refno,$caseno);
			if($assistance){
				$message="Patient allocated hmo assistance has been removed with caseno $caseno!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','HMO assistance successfully removed!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to remove hmo assistance!');
			}
			redirect(base_url()."hmo_assistance/$caseno");
		}
		public function remove_excess($refno,$caseno){
			$assistance=$this->Hmo_model->remove_excess($refno,$caseno);
			if($assistance){
				$message="Patient posted excess has been removed with caseno $caseno!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Posted Excess successfully removed!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to remove posted excess!');
			}
			redirect(base_url()."hmo_excess/$caseno");
		}
		public function save_assistance_pf(){
			$caseno=$this->input->post('caseno');
			$c=$this->input->post('code');
			$amount=$this->input->post('allo');
			$hmo=$this->input->post('hmo');
			$i=0;
			$count=0;
			foreach($c AS $code){
				$assistance=$this->Hmo_model->save_assistance_pf($code,$amount[$i],$hmo[$i],$caseno);
				$i++;
				if($assistance){
					$count++;
				}
			}
			if($count>0){
				$message="Patient allocated hmo assistance pf has been saved with caseno $caseno!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','HMO assistance pf successfully saved!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to save hmo assistance pf!');
			}
			redirect(base_url()."hmo_assistance/$caseno");
		}
		public function quotation(){
			if($this->session->user_login){
				$page="quotation";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Quotation";
					$data['inpatient'] = $this->Hmo_model->getAllPatientLimit();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					// if($dept=="ADMISSION"){
					// 	$this->load->view('templates/headerAdmission',$data);
					// }
					// if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY"){
					// 	$this->load->view('templates/headerER',$data);
					// }
					// if($dept=="RDU"){
					// 	$this->load->view('templates/headerDialysis',$data);
					// }
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
					}
					$this->load->view('pages/hmo/'.$page,$data);
					$this->load->view('templates/modalHMO',$data);
					$this->load->view('templates/footer');
					}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_quotation(){
			if($this->session->user_login){
				$page="quotation";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Quotation";
					$data['inpatient'] = $this->Hmo_model->getSinglePatient();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					// if($dept=="ADMISSION"){
					// 	$this->load->view('templates/headerAdmission',$data);
					// }
					// if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY"){
					// 	$this->load->view('templates/headerER',$data);
					// }
					// if($dept=="RDU"){
					// 	$this->load->view('templates/headerDialysis',$data);
					// }
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
					}
					$this->load->view('pages/hmo/'.$page,$data);
					$this->load->view('templates/modalHMO',$data);
					$this->load->view('templates/footer');
					}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function fetch_single_patient(){
			$id=$this->input->post('id');
			$data=$this->General_model->fetchSinglePatient($id);
			echo json_encode($data);
		}
		public function new_patient_quotation(){
			$quotation=$this->Hmo_model->save_quotation();
			if($quotation){
				echo "<script>alert('New quotation successfully created!');</script>";
			}else{
				echo "<script>alert('Unable to create new quotation!');</script>";
			}
			echo "<script>window.location='".base_url()."quotation_list';</script>";
		}
		public function quotation_list(){
			if($this->session->user_login){
				$page="quotation_list";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Quotation List";
					$data['inpatient'] = $this->Hmo_model->getAllQuotation();
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					// if($dept=="ADMISSION"){
					// 	$this->load->view('templates/headerAdmission',$data);
					// }
					// if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY"){
					// 	$this->load->view('templates/headerER',$data);
					// }
					// if($dept=="RDU"){
					// 	$this->load->view('templates/headerDialysis',$data);
					// }
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
					}
					$this->load->view('pages/hmo/'.$page,$data);
					$this->load->view('templates/modalHMO',$data);
					$this->load->view('templates/footer');
					}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function quotation_view($id,$caseno){
			if($this->session->user_login){
				$page="quotation_view";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Quotation Details";
					$data['patient'] = $this->Hmo_model->getSingleQuotation($id);
					$data['inpatient'] = $this->Hmo_model->getAllQuotationDetails($caseno);
					$data['department'] = $this->session->dept;
					$data['quote_id'] = $id;
					$data['caseno'] = $caseno;
					$dept=$this->session->dept;
					// if($dept=="ADMISSION"){
					// 	$this->load->view('templates/headerAdmission',$data);
					// }
					// if($dept=="ER" || $dept=="OPD" || $dept=="ONCOLOGY"){
					// 	$this->load->view('templates/headerER',$data);
					// }
					// if($dept=="RDU"){
					// 	$this->load->view('templates/headerDialysis',$data);
					// }
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
					}
					$this->load->view('pages/hmo/'.$page,$data);
					$this->load->view('templates/modalHMO',$data);
					$this->load->view('templates/footer');
					}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function remove_quote_item($q_id,$caseno,$id){
			$remove_item=$this->Hmo_model->remove_quote_item($id);
			if($remove_item){
				$message="Quote item successfully removed with ID $id.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Item successfully removed!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to remove item!');
			}
			redirect(base_url()."quotation_view/$q_id/$caseno");
		}
		public function print_quotation($caseno,$id){
			$page="print_quotation";
			$header=$this->General_model->getInfo();
			$data['pat'] = $this->Hmo_model->getSingleQuotation($id);
			$data['items'] = $this->Hmo_model->getAllQuotationDetails($caseno);
			$data['caseno']=$caseno;
			$data['datenow']=date('D, F d, Y');

			$html=$this->load->view('pages/hmo/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 10,
				'margin_right' => 10,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'Letter'
			]);
			$mpdf->setHTMLHeader('
        <div style="text-align:center;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="20">&nbsp;</td>
                <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                <font style="font-size:13px;">'.$header['address'].'</font></td>
            <td width="30">&nbsp;</td>
        </tr>
        </table>
        ');
		$mpdf->setHTMLFooter('
		<table width="100%" border="0">
		<tr>
			<td colspan="2">PREPARED BY</td>
		</tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
		<td><b><u>'.$this->session->fullname.'</u></b></td>
		</tr>
		<tr>
		<td>HMO STAFF</td>
		</tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">VERIFIED BY</td>
		</tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
		<td><b><u>JUDILYN ABUAN</u></b></td>
		<td><b><u>ROSEMARIE S. AGRIPO</u></b></td>
		</tr>
		<tr>
		<td>HEAD, PHARMACY</td>
		<td>HEAD, CASHIER</td>
		</tr>
		</table>
		');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();

		}
		public function daily_admission_ar_hmo(){
			$page = "daily_admission_ar_hmo";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$rundate=$this->input->post('rundate');
			$startdate=date('F d, Y',strtotime($rundate));
			$header=$this->General_model->getinfo();
			$data['body']=$this->Hmo_model->getAllAdmissionARHMO();
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'orientation' => 'L',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4 style="margin-left:90px;">DAILY AR ADMISSION REPORT<br>'.$startdate.'</h4>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function daily_admission_ar_employee(){
			$page = "daily_admission_ar_employee";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$rundate=$this->input->post('rundate');
			$startdate=date('F d, Y',strtotime($rundate));
			$header=$this->General_model->getinfo();
			$data['body']=$this->Hmo_model->getAllAdmissionAREmployee($rundate);
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',				
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4 style="margin-left:90px;">DAILY AR EMPLOYEE REPORT<br>'.$startdate.'</h4>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function daily_admission_ipd_hmo(){
			$page = "daily_admission_ipd_hmo";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$date1=date('F d, Y',strtotime($startdate));
			$date2=date('F d, Y',strtotime($enddate));
			$header=$this->General_model->getinfo();
			$data['ns1']=$this->Hmo_model->getAllAdmissionHMO($startdate,$enddate,'NS1');
			$data['ns2']=$this->Hmo_model->getAllAdmissionHMO($startdate,$enddate,'NS2');
			$data['ns3']=$this->Hmo_model->getAllAdmissionHMO($startdate,$enddate,'NS3');
			$data['ns5a']=$this->Hmo_model->getAllAdmissionHMO($startdate,$enddate,'NS 5A');
			$data['ns5b']=$this->Hmo_model->getAllAdmissionHMO($startdate,$enddate,'NS 5B');
			$data['ns6']=$this->Hmo_model->getAllAdmissionHMO($startdate,$enddate,'NS 6');
			$data['icu']=$this->Hmo_model->getAllAdmissionHMO($startdate,$enddate,'ICU');
			$data['nicu']=$this->Hmo_model->getAllAdmissionHMO($startdate,$enddate,'SCU');
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4 style="margin-left:90px;">DAILY ADMISSION REPORT<br>'.$date1.' - '.$date2.'</h4>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function pf_allocation($caseno){
			if($this->session->user_login){
				$page="pf_allocation";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$pat=$this->Hmo_model->getPatient($caseno);
					$data['patient']=$this->Hmo_model->getPatient($caseno);
					$data['header']=$this->General_model->getInfo();
					$data['title']="<i class='icofont-user'></i> ".$pat['lastname'].", ".$pat['firstname'];

					$data['allocation'] = $this->Hmo_model->getAllArTrade($caseno);
					$dept=$this->session->dept;
					$data['caseno'] = $caseno;
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
					}
					$this->load->view('pages/hmo/'.$page,$data);
					$this->load->view('templates/modalHMO',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_pf_discount(){
			$caseno=$this->input->post('caseno');
			$save=$this->Hmo_model->save_pf_discount();
			if($save){
				$message="Patient guarantee allocation has been posted with caseno $caseno!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Allocation successfully saved!');
				redirect(base_url()."pf_allocation/$caseno");
			}else{
				$this->session->set_flashdata('save_failed','Unable to save allocation!');
				redirect(base_url()."pf_allocation/$caseno");
			}
		}
		public function remove_pf_allocation($refno,$caseno){
			$remove=$this->Hmo_model->remove_pf_allocation($refno);
			if($remove){
				$message="Patient guarantee allocation has been posted with caseno $caseno!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Allocation successfully saved!');
				redirect(base_url()."pf_allocation/$caseno");
			}else{
				$this->session->set_flashdata('save_failed','Unable to save allocation!');
				redirect(base_url()."pf_allocation/$caseno");
			}
		}
		public function arpatient_list(){
			if($this->session->user_login){
				$page="arpatient_list";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['inpatient'] = $this->General_model->getAllPatient();
					$data['header']=$this->General_model->getInfo();
					$data['title']="AR Patient";
					$data['department']	= $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="BILLING"){
						$this->load->view('templates/headerOther',$data);
						$this->load->view('pages/hmo/'.$page,$data);
						$this->load->view('templates/modalOther',$data);
					}else{
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/hmo/'.$page,$data);
						$this->load->view('templates/modalHMO',$data);
					}
					$this->load->view('templates/footer');

				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_arpatient_list(){
			if($this->session->user_login){
				$page="arpatient_list";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$searchme=$this->input->post('searchme');
					$data['header']=$this->General_model->getInfo();
					$data['inpatient'] = $this->Admission_model->getSelectedPatient($searchme);
					$data['title']="AR Patient";
					$data['department']	= $this->session->dept;
					$dept=$this->session->dept;
					if($dept=="BILLING"){
						$this->load->view('templates/headerOther',$data);
						$this->load->view('pages/hmo/'.$page,$data);
						$this->load->view('templates/modalOther',$data);
					}else{
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/hmo/'.$page,$data);
						$this->load->view('templates/modalHMO',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function hmo_charges($patientidno,$caseno){
			if($this->session->user_login){
				$page="hmo_charges";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="<a href='".base_url()."admission'>Patient List</a> >> <a href='".base_url()."patientprofile/$patientidno'>Patient Profile</a> >> HMO Charges";
					$data['patient'] = $this->General_model->getSinglePatient($patientidno);
					$data['admission'] = $this->Hmo_model->getAllCharges($caseno);
					$data['patientidno'] = $patientidno;
					$data['caseno'] = $caseno;
					$dept = $this->session->dept;
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/hmo/'.$page,$data);
						$this->load->view('templates/modalHMO',$data);
						$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function delete_charges($patientidno,$caseno,$refno){
			$delete=$this->Hmo_model->delete_charges($refno,$caseno);
			if($delete){
				$message="HMO charged item successfully deleted with caseno $caseno and referrence no. $refno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','HMO charged item successfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete HMO charged item!');
			}
			redirect(base_url()."hmo_charges/$patientidno/$caseno");
		}
		public function daily_admission_walkin_hmo(){
			if($this->session->user_login){
				$page="daily_admission_walkin_hmo";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Daily Walkin HMO";

					$data['inpatient'] = $this->Hmo_model->getAllWalkinHMOReport();
					$data['department'] = $this->session->dept;
					$data['startdate'] = $this->input->post('startdate');
					$data['enddate'] = $this->input->post('enddate');
					$dept=$this->session->dept;
					$this->load->view('templates/headerHMO',$data);
					$this->load->view('pages/hmo/'.$page,$data);
					$this->load->view('templates/modalHMO',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function view_walkin_hmo($addemployer,$startdate,$enddate){
			$addemployer=str_replace('%20',' ',$addemployer);
			$page = "view_walkin_hmo";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$header=$this->General_model->getinfo();
			$data['body']=$this->Hmo_model->getAllAdmissionARHMO($addemployer,$startdate,$enddate);
			//$this->load->view('pages/reports/'.$page, $data);
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'letter',
				'orientation' => 'L'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:center;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="50">&nbsp;</td>
                <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                <font style="font-size:13px;">'.$header['address'].'</font></td>
            <td width="130">&nbsp;</td>
        </tr>
        </table>
            <h4>PATIENT LIST</h4>
            Date Range: '.date('M-d-Y',strtotime($startdate)).' - '.date('M-d-Y',strtotime($enddate)).'
            <br>HMO/Company: '.$addemployer.'
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function view_profile($caseno){
			if($this->session->user_login){
				$page="view_profile";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Patient Profile";
					$data['patient'] = $this->Dietary_model->getSinglePatientAdmission($caseno);
					$data['company'] = $this->General_model->getCompany();
					$data['department'] = $this->session->dept;
					$data['caseno']= $caseno;
					$dept=$this->session->dept;
					if($dept=="BILLING"){
						$this->load->view('templates/headerOther',$data);
						$this->load->view('pages/hmo/'.$page,$data);
						$this->load->view('templates/modalOther',$data);
					}else{
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/hmo/'.$page,$data);
						$this->load->view('templates/modalHMO',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function details_hmo($caseno,$patientidno){
			$page="details_hmo";
			$header=$this->General_model->getInfo();
			$data['patient'] = $this->Hmo_model->fetch_single_admission($caseno);
			$data['caseno']=$caseno;
			$data['datenow']=date('D, F d, Y');

			$html=$this->load->view('pages/hmo/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
        <div style="text-align:center;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="50">&nbsp;</td>
                <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                <font style="font-size:13px;">'.$header['address'].'</font></td>
            <td width="130">&nbsp;</td>
        </tr>
        </table>
        <h5>DETAILED STATEMENT OF ACCOUNT</h5>
        ');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();

		}
		public function discharged_patient(){
			if($this->session->user_login){
				$page="discharged_patient";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Search Discharged Patient";
					$data['inpatient'] = array();
					$dept=$this->session->dept;
					$this->load->view('templates/headerHMO',$data);
					$this->load->view('pages/hmo/'.$page,$data);
					$this->load->view('templates/modalHMO',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_discharged_patient(){
			if($this->session->user_login){
				$page="discharged_patient";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Search Discharged Patient";
					$searchme=$this->input->post('searchme');
					$data['inpatient'] = $this->Hmo_model->fetch_inpatient($searchme);
					$dept=$this->session->dept;
					$this->load->view('templates/headerHMO',$data);
					$this->load->view('pages/hmo/'.$page,$data);
					$this->load->view('templates/modalHMO',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}

		public function search_archive(){
			if($this->session->user_login){
				$page="search_archive";
				if(!file_exists(APPPATH.'views/pages/searcharchive/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Search Archive Patient";
					$data['dept'] = $this->session->dept;
					$data['department'] = $this->session->dept;
					$data['inpatient'] = array();
					$dept = $this->session->dept;
					$this->load->view('templates/headerER',$data);
					$this->load->view('pages/searcharchive/'.$page,$data);
					$this->load->view('templates/modalER',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_archive_patient(){
			if($this->session->user_login){
				$page="search_archive";
				if(!file_exists(APPPATH.'views/pages/searcharchive/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Search Archive Patient";
					$searcharc=$this->input->post('searcharc');
					$data['inpatient'] = $this->Hmo_model->fetch_arcpatient($searcharc);
					$data['dept'] = $this->session->dept;
					$data['department'] = $this->session->dept;
					$dept = $this->session->dept;
					$this->load->view('templates/headerER',$data);
					$this->load->view('pages/searcharchive/'.$page,$data);
					$this->load->view('templates/modalER',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_hmo_price(){
			$caseno=$this->input->post('caseno');
			$refno=$this->input->post('refno');
			$save_price=$this->Hmo_model->save_hmo_price();
			if($save_price){
				$message = "Diagnostic price successfully updated with refno $refno and caseno $caseno.";
				$loginuser = $this->session->fullname;
				$this->General_model->userlogs($message, $loginuser);
				//$this->session->set_flashdata('save_success','Item price successfully updated!');
				echo "<script>alert('Item price successfully updated!');</script>";
			}else{
				echo "<script>alert('Unable to update Diagnostic price!');</script>";
				//$this->session->set_flashdata('save_failed','Unable to update Diagnostic price!');
			}
			echo "<script>window.close();</script>";
			//redirect(base_url()."view_profile/$caseno");
		}
		public function delete_hmo_price($caseno,$refno){
			$save_price=$this->Hmo_model->delete_hmo_price($refno);
			if($save_price){
				$message = "Diagnostic price successfully deleted with refno $refno and caseno $caseno.";
				$loginuser = $this->session->fullname;
				$this->General_model->userlogs($message, $loginuser);
				$this->session->set_flashdata('save_success','Item price successfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete Diagnostic price!');
			}
			redirect(base_url()."view_profile/$caseno");
		}
		public function add_hmo_pf(){
			$caseno=$this->input->post('caseno');
			$save_pf=$this->Hmo_model->add_hmo_pf();
			if($save_pf){
				$message = "HMO Professional Fee successfully added with caseno $caseno.";
				$loginuser = $this->session->fullname;
				$this->General_model->userlogs($message, $loginuser);
				$this->session->set_flashdata('save_success','HMO Professional Fee successfully added!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to add HMO Professional Fee!');
			}
			redirect(base_url()."view_profile/$caseno");
		}
		public function print_soa($caseno,$patientidno){
			$page="print_soa";
			$header =$this->General_model->getInfo();
			$patient = $this->Hmo_model->fetch_single_admission($caseno);
			$data['items'] = $this->Hmo_model->fetchAllCharges($caseno);
			$data['caseno']=$caseno;
			$data['datenow']=date('D, F d, Y');

			$html=$this->load->view('pages/hmo/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 150,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'Letter',
				'orientation' => 'L'
			]);
			$mpdf->setHTMLHeader('

        <table width="100%" border="0" cellspacing="0" cellpadding="1" border="1" style="cellpadding:10px; font-size:10px;">
            <tr>
            	<td width="20" style="border-right:0;height:70px;">&nbsp;</td>
                <td width="80" style="border-right:0;border-left:0;"><img src="'.base_url().'design/images/kmsci.png" width="50"></td>
                <td style="font-family:Arial; border-left:0;"><b style="font-size:12px;">'.$header['heading'].'</b><br>
                <font style="font-size:12px;">'.$header['address'].'</font></td>
        </tr>
        <tr>
        	<td colspan="3" align="center"><h3>H O S P I T A L &nbsp;&nbsp;&nbsp;B I L L</h3></td>
        </tr>
        <tr>
        	<td colspan="3" align="center"></td>
        </tr>
        <tr>
        <td colspan="3">
        	<table width="100%" border="0">
        	<tr>
        		<td>Name of Patient: <b>'.$patient['lastname'].', '.$patient['firstname'].' '.$patient['middlename'].'</b></td>
        		<td>Caseno: <b>'.$caseno.'</b></td>
        	</tr>
        	<tr>
        	<td>Date Admitted: <b>'.date('m/d/Y',strtotime($patient['dateadmit'])).'</b></td>
        	<td>HMO: '.$patient['hmo'].'</td>
        	</tr>
        	<tr>
        	<td>Date Discharged: <b>'.date('m/d/Y',strtotime($patient['dateadmit'])).'</b></td>
        	<td>Room No.: '.$patient['room'].'</td>
        	</tr>
        	</table>
        </td>
        </tr>
        </table>
        ');
			$mpdf->setHTMLFooter('
				<table width="100%" border="0" style="font-size:12px;">
					<tr>
						<td>Prepared by:</td>
						<td>Verified by:</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td><b><u>'.$this->session->fullname.'</u></b></td>
						<td><b><u>VON ANTHONY V. QUEZON</u></b></td>
					</tr>
					<tr>
						<td>HMO CLERK</td>
						<td>HMO HEAD</td>
					</tr>
				</table>
				');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();

		}
		public function print_soa_beta($caseno,$patientidno){
			$page="print_soa_beta";
			$header =$this->General_model->getInfo();
			$patient = $this->Hmo_model->fetch_single_admission($caseno);
			$data['items'] = $this->Hmo_model->fetchAllCharges($caseno);
			$data['caseno']=$caseno;
			$data['datenow']=date('D, F d, Y');
			$data['hmo_desc'] = $patient['hmo'];

			$html=$this->load->view('pages/hmo/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 150,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'Letter',
				'orientation' => 'L'
			]);
			$mpdf->setHTMLHeader('

        <table width="100%" border="0" cellspacing="0" cellpadding="1" border="1" style="cellpadding:10px; font-size:10px;">
            <tr>
            	<td width="20" style="border-right:0;height:70px;">&nbsp;</td>
                <td width="80" style="border-right:0;border-left:0;"><img src="'.base_url().'design/images/kmsci.png" width="50"></td>
                <td style="font-family:Arial; border-left:0;"><b style="font-size:12px;">'.$header['heading'].'</b><br>
                <font style="font-size:12px;">'.$header['address'].'</font></td>
        </tr>
        <tr>
        	<td colspan="3" align="center"><h3>H O S P I T A L &nbsp;&nbsp;&nbsp;B I L L</h3></td>
        </tr>
        <tr>
        	<td colspan="3" align="center"></td>
        </tr>
        <tr>
        <td colspan="3">
        	<table width="100%" border="0">
        	<tr>
        		<td>Name of Patient: <b>'.$patient['lastname'].', '.$patient['firstname'].' '.$patient['middlename'].'</b></td>
        		<td>Caseno: <b>'.$caseno.'</b></td>
        	</tr>
        	<tr>
        	<td>Date Admitted: <b>'.date('m/d/Y',strtotime($patient['dateadmit'])).'</b></td>
        	<td>HMO: '.$patient['hmo'].'</td>
        	</tr>
        	<tr>
        	<td>Date Discharged: <b>'.date('m/d/Y',strtotime($patient['dateadmit'])).'</b></td>
        	<td>Room No.: '.$patient['room'].'</td>
        	</tr>
        	</table>
        </td>
        </tr>
        </table>
        ');
			$mpdf->setHTMLFooter('
				<table width="100%" border="0" style="font-size:12px;">
					<tr>
						<td>Prepared by:</td>
						<td>Verified by:</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td><b><u>'.$this->session->fullname.'</u></b></td>
						<td><b><u>VON ANTHONY V. QUEZON</u></b></td>
					</tr>
					<tr>
						<td>HMO CLERK</td>
						<td>HMO HEAD</td>
					</tr>
				</table>
				');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();

		}
		public function hmofinalize(){
			$caseno=$this->input->post('caseno');
			$finalize=$this->Hmo_model->finalize();
			if($finalize){
				$message = "Account successfully finalized with caseno $caseno.";
				$loginuser = $this->session->fullname;
				$this->General_model->userlogs($message, $loginuser);
				$this->session->set_flashdata('save_success','Account successfully finalized!');
			}else{
				//$this->session->set_flashdata('save_failed','Unable to finalize account!');
			}
			redirect(base_url()."view_profile/$caseno");
		}
		public function hmoreopen(){
			$caseno=$this->input->post('caseno');
			$password=$this->input->post('password');
			$dept=$this->session->dept;
			$check=$this->General_model->checkPassword($password,$dept);
			if($check){
			$finalize=$this->Hmo_model->hmoreopen();
			if($finalize){
				$message = "Account successfully re-opened with caseno $caseno.";
				$loginuser = $this->session->fullname;
				$this->General_model->userlogs($message, $loginuser);
				$this->session->set_flashdata('save_success','Account successfully re-opened!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to re-open account!');
			}
		}else{
			$this->session->set_flashdata('save_failed','Invalid Password!');
		}
			redirect(base_url()."view_profile/$caseno");

		}
		public function daily_admission_ar_hmo_billing(){
			$page = "daily_admission_ar_hmo_billing";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$rundate=$this->input->post('rundate');
			$header=$this->General_model->getinfo();
			$data['body']=$this->Hmo_model->getAllAdmissionARHMOBilling($rundate);
			$data['rundate'] = $rundate;
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'letter',
				'orientation' => 'L'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:center;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="50">&nbsp;</td>
                <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                <font style="font-size:13px;">'.$header['address'].'</font></td>
            <td width="130">&nbsp;</td>
        </tr>
        </table>
            <h4>DAILY REPORT FOR BILLING</h4>
             </div>');
			$mpdf->setHTMLFooter('
				<table width="50%" border="0" style="font-size:12px;">
					<tr>
						<td><b>PREPARED BY:</b></td>
						<td><b>RECEIVED BY:</b></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td><b><u>'.$this->session->fullname.'</u></b></td>
						<td>_____________________________</td>
					</tr>
					<tr>
						<td>HMO Staff</td>
						<td>BILLING Staff</td>
					</tr>
					</td>
				</table>
				');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function daily_admission_ar_hmo_billing_excel(){
			$page = "daily_admission_ar_hmo_billing_excel";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$rundate=$this->input->post('rundate');
			$data['header']=$this->General_model->getinfo();
			$data['body']=$this->Hmo_model->getAllAdmissionARHMOBilling($rundate);
			$data['rundate'] = $rundate;
			//$html=$this->load->view('pages/reports/'.$page, $data,true);
			$this->load->view('pages/reports/'.$page, $data);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'letter',
				'orientation' => 'L'
			]);
		// 	$mpdf->setHTMLHeader('
        //     <div style="text-align:center;">
        // <table width="100%" border="0" cellspacing="0" cellpadding="0">
        //     <tr>
        //         <td width="50">&nbsp;</td>
        //         <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
        //         <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
        //         <font style="font-size:13px;">'.$header['address'].'</font></td>
        //     <td width="130">&nbsp;</td>
        // </tr>
        // </table>
        //     <h4>DAILY REPORT FOR BILLING</h4>
        //      </div>');
		// 	$mpdf->setHTMLFooter('
		// 		<table width="50%" border="0" style="font-size:12px;">
		// 			<tr>
		// 				<td><b>PREPARED BY:</b></td>
		// 				<td><b>RECEIVED BY:</b></td>
		// 			</tr>
		// 			<tr>
		// 				<td colspan="2">&nbsp;</td>
		// 			</tr>
		// 			<tr>
		// 				<td><b><u>'.$this->session->fullname.'</u></b></td>
		// 				<td>_____________________________</td>
		// 			</tr>
		// 			<tr>
		// 				<td>HMO Staff</td>
		// 				<td>BILLING Staff</td>
		// 			</tr>
		// 			</td>
		// 		</table>
		//		');
			// $mpdf->autoPageBreak = true;
			// $mpdf->WriteHTML($html);
			// $mpdf->Output();
		}
		public function daily_admission_ar_hmo_billing_summary(){
			$page = "daily_admission_ar_hmo_billing_summary";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$rundate=$this->input->post('rundate');
			$header=$this->General_model->getinfo();
			$data['body']=$this->Hmo_model->getAllAdmissionARHMOBilling($rundate);
			$data['begin']=$this->Hmo_model->getAllAdmissionARHMOBillingBegin($rundate);			
			$data['rundate'] = $rundate;
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'letter'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:center;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="50">&nbsp;</td>
                <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                <font style="font-size:13px;">'.$header['address'].'</font></td>
            <td width="130">&nbsp;</td>
        </tr>
        </table>
            <h4>DAILY SUMMARY REPORT FOR BILLING<br>as of '.date('m/d/Y',strtotime($rundate)).'</h4>
             </div>');
			$mpdf->setHTMLFooter('
				<table width="50%" border="0" style="font-size:12px;">
					<tr>
						<td><b>PREPARED BY:</b></td>
						<td><b>RECEIVED BY:</b></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td><b><u>'.$this->session->fullname.'</u></b></td>
						<td>_____________________________</td>
					</tr>
					<tr>
						<td>HMO Staff</td>
						<td>BILLING Staff</td>
					</tr>
					</td>
				</table>
				');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
		public function hmo_price_list(){
			if($this->session->user_login){
				$page="hmo_price_list";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$type=$this->input->post('service');
					$data['header']=$this->General_model->getInfo();
					$data['items'] = $this->Hmo_model->getAllPriceList();
					$data['title']="$type PRICE LIST";
					$dept=$this->session->dept;
					$data['department'] = $dept;
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/hmo/'.$page,$data);
						$this->load->view('templates/modalHMO',$data);
					}
					if($dept=="ER"){
						$this->load->view('templates/headerER',$data);
						$this->load->view('pages/hmo/'.$page,$data);
						$this->load->view('templates/modalER',$data);
					}
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function daily_discharged_inpatient(){
			$page="print_daily_discharged_report_hmo";
			if(!file_exists(APPPATH.'views/pages/billing/'.$page.".php")){
				show_404();
			}
			$rundate=$this->input->post('rundate');
			$department=$this->input->post('department');
			$user=$this->session->fullname;
			$data['department']="";
			$data['button']="";
			$data['type']="";
			$startdate=date('F d, Y',strtotime($rundate));
			$data['startdate']=$startdate;
			$header=$this->General_model->getinfo();
			$data['body']=$this->General_model->getAllDischargedReportIPD();
			//$this->load->view('pages/billing/'.$page, $data);
			$html=$this->load->view('pages/billing/'.$page, $data,true);
			$page="print_daily_discharged_report_credit_hmo";
			$html1=$this->load->view('pages/billing/'.$page, $data,true);
			//$this->load->view('pages/billing/'.$page, $data);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'orientation' => 'L',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
             </div>');
			$mpdf->setHTMLFooter('
            <div style="text-align:left;">
             <table width="50%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td><b>Prepared by:</b></td>
                     <td><b>Checked by:</b></td>
                     <td><b>Noted by:</b></td>
              </tr>
              <tr>
              	<td colspan="3">&nbsp;</td>
              </tr>
              <tr>
                     <td><u>'.$user.'</u></td>
                     <td><u>E. MUDANZA</u></td>
                     <td><u>MEHRALYN L. TORCULAS</u></td>
              </tr>
              <tr>
                     <td>BILLING</td>
                     <td>CASHIER</td>
                     <td>FINANCE OFFICER</td>
              </tr>
            </table>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->AddPage();
			$mpdf->WriteHTML($html1);
			$mpdf->Output();
	 }
	 public function hmo_excess($caseno){
			if($this->session->user_login){
				$page="hmo_excess";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$pat=$this->Hmo_model->getPatient($caseno);
					$data['header']=$this->General_model->getInfo();
					$data['title']="<i class='icofont-user'></i> ".$pat['lastname'].", ".$pat['firstname'];

					$data['allocation'] = $this->Hmo_model->getHMOAllocation();
					$data['caseno'] = $caseno;
					$data['patientidno'] = $pat['patientidno'];
					$dept=$this->session->dept;
					if($dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
					}
					$this->load->view('pages/hmo/'.$page,$data);
					$this->load->view('templates/modalHMO',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function post_excess(){
			$caseno=$this->input->post('caseno');
			$save=$this->Hmo_model->post_excess();
			if($save){
				$message="Patient excess has been posted with caseno $caseno!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Excess sucessfully posted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to post excess!');
			}
			redirect(base_url()."hmo_excess/$caseno");
		}
		public function daily_discharged_inpatient_summary(){
			$page="print_daily_discharged_report_summary";
			if(!file_exists(APPPATH.'views/pages/billing/'.$page.".php")){
				show_404();
			}
			$rundate=$this->input->post('rundate');
			$department=$this->input->post('department');
			$user=$this->session->fullname;
			$startdate=date('F d, Y',strtotime($rundate));
			$data['rundate']=$rundate;
			$data['department']=$department;
			$data['user'] = $user;
			$header=$this->General_model->getinfo();
			$data['body']=$this->General_model->getAllDischargedReportIPD();
			//$this->load->view('pages/billing/'.$page, $data);
			$html=$this->load->view('pages/billing/'.$page, $data,true);
			// $page="print_daily_discharged_report_credit";
			// $html1=$this->load->view('pages/billing/'.$page, $data,true);
			//$this->load->view('pages/billing/'.$page, $data);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'Legal'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:center;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h3>Daily Discharged Summary</h3>
            As of '.$startdate.'
            <br>
            <br>
            <table width="100%" border="0" style="font-size:12px;">
        <tr>
            <td align="left" style="font-size:12px;" width="40%"><b>ACCOUNTS</b></td>
            <td align="right" style="font-size:12px;" width="20%"><b>BEG. BALANCE</b></td>
            <td align="right" style="font-size:12px;" width="20%"><b>TODAY</b></td>
            <td align="right" style="font-size:12px;" width="20%"><b>TOTAL TO DATE</b></td>
        </tr>
        </table>
             </div>');
			$mpdf->setHTMLFooter('
				<div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td><b>Prepared by:</b></td>
                     <td><b>Checked by:</b></td>
                     <td><b>Noted by:</b></td>
              </tr>
              <tr>
                <td colspan="3">&nbsp;</td>
              </tr>
              <tr>
                     <td><u>'.$user.'</u></td>
                     <td><u>E. MUDANZA</u></td>
                     <td><u>MEHRALYN L. TORCULAS</u></td>
              </tr>
              <tr>
                     <td>BILLING</td>
                     <td>CASHIER</td>
                     <td>FINANCE OFFICER</td>
              </tr>
            </table>
             </div>
            ');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
	 }
	public function soa_settings(){
            if($this->session->user_login){
	            $page="soa_settings";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
					$data['title'] = "HMO SOA Account Title";
					$data['header']=$this->General_model->getInfo();
					$data['items'] = $this->Hmo_model->getAccounttitleSOA();
					$data['company'] = $this->Hmo_model->getAllHMO();
					$this->load->view('templates/headerHMO',$data);
					$this->load->view('pages/hmo/'.$page,$data);
					$this->load->view('templates/modalHMO',$data);
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}
	public function soa_settings_details($id){
            if($this->session->user_login){
	            $page="soa_settings_details";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
		            $page="error404";
					$this->load->view('pages/'.$page);
		        }else{
		        	$data['account_id'] = $id;
		        	$data['accttitle'] = $this->Hmo_model->getAccountTitle($id);		        	
					$data['title'] = "<a href='".base_url()."soa_settings'><<</i>Back</a>"." | HMO SOA Account Title";
					$data['header']=$this->General_model->getInfo();
					$data['items'] = $this->Hmo_model->getAccounttitleSOADetails($id);
					$this->load->view('templates/headerHMO',$data);
					$this->load->view('pages/hmo/'.$page,$data);
					$this->load->view('templates/modalHMO',$data);
					$this->load->view('templates/footer');
				}
	        }else{
	            redirect('http://192.168.0.100:100/ERP');
	        }
		}
		public function add_soa_accounttitle(){
			$accttitle=$this->input->post('accounttitle');
			$hmo=$this->input->post('hmo');
			$add=$this->Hmo_model->add_soa_hmo();
			if($add){
				$message="Account Title ($accttitle) and HMO ($hmo) added successfully!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Account Title sucessfully added!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to add account title!');
			}
			redirect(base_url()."soa_settings");
		}
		public function update_soa_accounttitle(){
			$accttitle=$this->input->post('accounttitle');
			$hmo=$this->input->post('hmo');
			$add=$this->Hmo_model->update_soa_hmo();
			if($add){
				$message="Account Title ($accttitle) and HMO ($hmo) updated successfully!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Account Title sucessfully updated!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to update account title!');
			}
			redirect(base_url()."soa_settings");
		}
		public function delete_soa_accounttitle($id){			
			$add=$this->Hmo_model->delete_soa_hmo($id);
			if($add){
				$message="Account Title deleted successfully!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Account Title sucessfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete account title!');
			}
			redirect(base_url()."soa_settings");
		}

		public function add_soa_subaccounttitle(){
			$acct_id=$this->input->post('accounttitle_id');
			$accttitle=$this->input->post('accounttitle');
			$hmo=$this->input->post('hmo');
			$add=$this->Hmo_model->add_soa_hmo_details();
			if($add){
				$message="Account Title ($accttitle) and HMO ($hmo) added successfully!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Account Title sucessfully added!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to add account title!');
			}
			redirect(base_url()."soa_settings_details/$acct_id");
		}
		public function update_soa_subaccounttitle(){
			$acct_id=$this->input->post('accounttitle_id');
			$accttitle=$this->input->post('accounttitle');
			$hmo=$this->input->post('hmo');
			$add=$this->Hmo_model->update_soa_hmo_details();
			if($add){
				$message="Account Title ($accttitle) and HMO ($hmo) updated successfully!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Account Title sucessfully updated!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to update account title!');
			}
			redirect(base_url()."soa_settings_details/$acct_id");
		}
		public function delete_soa_subaccounttitle($id,$acct_id){
			$add=$this->Hmo_model->delete_soa_hmo_details($id);
			if($add){
				$message="Account Title deleted successfully!";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				$this->session->set_flashdata('save_success','Account Title sucessfully deleted!');
			}else{
				$this->session->set_flashdata('save_failed','Unable to delete account title!');
			}
			redirect(base_url()."soa_settings_details/$acct_id");
		}
		public function active_ar_patient(){
			if($this->session->user_login){
				$page="active_ar_patient";
				if(!file_exists(APPPATH.'views/pages/hmo/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Active AR Patient";
					$data['arpatient'] = $this->Hmo_model->getAllActiveARPatient();					
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerHMO',$data);
					$this->load->view('pages/hmo/'.$page,$data);
					$this->load->view('templates/modalHMO',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function rdu_hmo(){
			if($this->session->user_login){
				$page="rdulist_hmo";
				if(!file_exists(APPPATH.'views/pages/dialysis/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Active Dialysis Patient";
					$data['inpatient'] = $this->Dialysis_model->getAllActiveRDUPatient();					
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerHMO',$data);
					$this->load->view('pages/dialysis/'.$page,$data);
					$this->load->view('templates/modalHMO',$data);
					$this->load->view('templates/footer');
				}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		//==============================End of HMO Module=======================================

		//=============================Start of Cashier Module==================================
		public function report_portal($fn,$un,$d){
			$fn=str_replace('%20',' ',$fn);
			$this->session->set_userdata('fullname',$fn);
			$this->session->set_userdata('username',$un);
			$this->session->set_userdata('dept',$d);
			$this->session->set_userdata('user_login',true);
			redirect(base_url()."cashier_reports");
		}
		public function cashier_reports(){
			if($this->session->user_login){
				$page="main_report";
				if(!file_exists(APPPATH.'views/pages/cashier/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Cashier Reports";
					$data['department'] = $this->session->dept;
					$dept=$this->session->dept;
					$this->load->view('templates/headerCashier',$data);
					$this->load->view('pages/cashier/'.$page,$data);
					$this->load->view('templates/modalOther',$data);
					$this->load->view('templates/footer');
					}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}

		public function daily_collection(){
			if($this->session->user_login){
				$page="daily_collection";
				if(!file_exists(APPPATH.'views/pages/cashier/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Cashier Reports";
					if($this->session->dept=="RDU"){
						$this->load->view('templates/headerDialysis',$data);
						$this->load->view('pages/cashier/'.$page,$data);
						$this->load->view('templates/modalRDU',$data);
					}else{
						$this->load->view('templates/headerCashier',$data);
						$this->load->view('pages/cashier/'.$page,$data);
						$this->load->view('templates/modalOther',$data);
					}					
					$this->load->view('templates/footer');
					}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function print_daily_collection(){
			$type=$this->input->post('type');
			$rundate=$this->input->post('startdate');
			$enddate=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));
			$startdate=date('Y-m-d',strtotime('-1 day',strtotime($enddate)));
			$orstart=$this->input->post('orstart');
			$orend=$this->input->post('orend');
			$orstart1=$this->input->post('orstart1');
			$orend1=$this->input->post('orend1');
			$header=$this->General_model->getInfo();
			if($type=="meds"){
				$page="print_medicine_report";
				$data['body']=$this->Cashier_model->getAllCollectionMeds();
			}
			if($type=="cpor"){
				$page="print_collection_report";
				$data['body']=$this->Cashier_model->getAllAccountTitle();
			}
			$data['rundate'] = $rundate;
			$data['startdate'] = $startdate;
			$data['enddate'] = $enddate;
			$data['orstart'] = $orstart;
			$data['orstart1'] = $orstart1;
			$data['orend'] = $orend;
			$data['orend1'] = $orend1;
			$html=$this->load->view('pages/cashier/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 10,
				'margin_right' => 10,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
        <div style="text-align:center;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="20">&nbsp;</td>
                <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="80"></td>
                <td align="center" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                <font style="font-size:13px;">'.$header['address'].'</font></td>
            <td width="30">&nbsp;</td>
        </tr>
        </table>
        <table width="100%" border="0">
        	<tr>
        		<td align="center"><h3>COLLECTION REPORT</td>
        	</tr>
        </table>
        ');
		$mpdf->setHTMLFooter('
		<table width="100%" border="0">
		<tr>
			<td>Prepared by</td>
			<td>Checked by</td>
			<td>Noted by</td>
		</tr>
		<tr>
		<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td><b><u>'.str_replace('%20',' ',$this->session->fullname).'</u></b></td>
			<td><b><u>ROSEMARIE AGRIPO</u></b></td>
			<td><b><u></u></b></td>
		</tr>
		<tr>
			<td>Cashier</td>
			<td>Cashier-Head</td>
			<td>Finance Officer</td>
		</tr>
		</table>
		');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();

		}
		public function artrade_list(){
			if($this->session->user_login){
				$page="artrade_list";
				if(!file_exists(APPPATH.'views/pages/cashier/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="AR Trade Index Card";
					$data['search_result']="";
					if($this->session->dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/cashier/'.$page,$data);
						$this->load->view('templates/modalHMO',$data);
					}else{
						$this->load->view('templates/headerCashier',$data);
						$this->load->view('pages/cashier/'.$page,$data);
						$this->load->view('templates/modalOther',$data);
					}
					$this->load->view('templates/footer');
					}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function artrade_list_search(){
			if($this->session->user_login){
				$page="artrade_list";
				if(!file_exists(APPPATH.'views/pages/cashier/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="AR Trade Index Card";
					$description=$this->input->post('description');
					$data['search_result']=$this->Cashier_model->getARTradePatient($description);
					if($this->session->dept=="HMO"){
						$this->load->view('templates/headerHMO',$data);
						$this->load->view('pages/cashier/'.$page,$data);
						$this->load->view('templates/modalHMO',$data);
					}else{
						$this->load->view('templates/headerCashier',$data);
						$this->load->view('pages/cashier/'.$page,$data);
						$this->load->view('templates/modalOther',$data);
					}
					$this->load->view('templates/footer');
					}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function artrade_indexcard($caseno){
			$page = "artrade_indexcard";
			if(!file_exists(APPPATH.'views/pages/cashier/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$header=$this->General_model->getinfo();
			$data['caseno']	 = $caseno;
			$data['profile']=$this->Cashier_model->getARTradePatientDetails($caseno);
			$patientname="";
			$address="";
			$approved="";
			$tradedate="";
			foreach($data['profile'] as $profile){
				$patientname=$profile['acctname'];
				$address=$profile['street'].", ".$profile['barangay'].", ".$profile['city'].", ".$profile['province'];
				if($profile['branch'] <> ''){
					$approved=$profile['branch'];
				}
				if($tradedate == ''){
					$tradedate=date('M-d-Y',strtotime($profile['datearray']));
				}
			}
			$confine=$this->Cashier_model->getConfinement($caseno);
			$admit=$confine['dateadmit'];
			$discharge=$confine['datearray'];
			$collateral=explode('||',$confine['shift']);

			if($discharge==""){
				$discharge="Present";
			}
			$confinement=date('M d, Y',strtotime($admit))." to ".date('M d, Y',strtotime($discharge));
			$html=$this->load->view('pages/cashier/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 10,
				'margin_right' => 10,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
              <tr>
              	<td colspan="4" align="center"><h4>AR TRADE INDEX CARD</h4></td>
              </tr>
            </table>
            <p>Patient Name: '.$patientname.'<br>Address: '.$address.'<br>Approved by: '.$approved.'<br>Confinement Period: '.$confinement.'<br>Collateral/C/O: '.$collateral[1].'</p>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}

		public function professional_fee(){
			if($this->session->user_login){
				$page="professional_fee";
				if(!file_exists(APPPATH.'views/pages/cashier/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['doctors'] = $this->Masterfile_model->getAllDoctors();
					$data['title']="Cashier Reports";
					$this->load->view('templates/headerCashier',$data);
					$this->load->view('pages/cashier/'.$page,$data);
					$this->load->view('templates/modalOther',$data);
					$this->load->view('templates/footer');
					}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		//=============================End of Cashier Module====================================

		//=============================Start of Billing Module==================================
		public function post_refund($fn,$un,$d){
			$fn=str_replace('%20',' ',$fn);
			$this->session->set_userdata('fullname',$fn);
			$this->session->set_userdata('username',$un);
			$this->session->set_userdata('dept',$d);
			$this->session->set_userdata('user_login',true);
			redirect(base_url()."patient_refund");
		}
		public function print_daily_discharged_report(){
			$page="print_daily_discharged_report";
			if(!file_exists(APPPATH.'views/pages/billing/'.$page.".php")){
				show_404();
			}
			// if($this->session->user_login){
			// }else{
			// 	redirect('http://192.168.0.100:100/ERP');
			// }
			$rundate=$this->input->post('rundate');
			$type=$this->input->post('type');
			$department=$this->input->post('department');
			if($this->session->fullname==""){
				$user=$this->input->post('fullname');
			}else{
				$user=$this->session->fullname;
			}
			$startdate=date('F d, Y',strtotime($rundate));
			$data['type'] = $type;
			$data['startdate'] = $startdate;
			$data['department'] = $department;
			$data['button'] = "";
			$header=$this->General_model->getinfo();
			if($type=="WCOH"){
				$data['body']=$this->General_model->getAllDischargedReportCOH($department);
			}else{
				$data['body']=$this->General_model->getAllDischargedReportWOCOH($department);
			}
			//$this->load->view('pages/billing/'.$page, $data);
			$html=$this->load->view('pages/billing/'.$page, $data,true);
			$page="print_daily_discharged_report_credit";
			$html1=$this->load->view('pages/billing/'.$page, $data,true);
			//$this->load->view('pages/billing/'.$page, $data);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'orientation' => 'L',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
             </div>');
			$mpdf->setHTMLFooter('
            <div style="text-align:left;">
             <table width="50%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td><b>Prepared by:</b></td>
                     <td><b>Checked by:</b></td>
                     <td><b>Noted by:</b></td>
              </tr>
              <tr>
              	<td colspan="3">&nbsp;</td>
              </tr>
              <tr>
                     <td><u>'.$user.'</u></td>
                     <td><u>E. MUDANZA</u></td>
                     <td><u>MEHRALYN L. TORCULAS</u></td>
              </tr>
              <tr>
                     <td>BILLING</td>
                     <td>CASHIER</td>
                     <td>FINANCE OFFICER</td>
              </tr>
            </table>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->AddPage();
			$mpdf->WriteHTML($html1);
			$mpdf->Output();
	 }

	 public function print_daily_discharged_report_beta(){
			$page="print_daily_discharged_report_beta";
			if(!file_exists(APPPATH.'views/pages/billing/'.$page.".php")){
				show_404();
			}
			// if($this->session->user_login){
			// }else{
			// 	redirect('http://192.168.0.100:100/ERP');
			// }
			$rundate=$this->input->post('rundate');
			$type=$this->input->post('type');
			$department=$this->input->post('department');
			if($this->session->fullname==""){
				$user=$this->input->post('fullname');
			}else{
				$user=$this->session->fullname;
			}
			$startdate=date('F d, Y',strtotime($rundate));
			$data['type'] = $type;
			$data['startdate'] = $startdate;
			$data['rundate'] = $rundate;
			$data['department'] = $department;
			$data['button'] = "";
			$header=$this->General_model->getinfo();
			if($type=="WCOH"){
				$data['body']=$this->General_model->getAllDischargedReportCOH($department);
				$data['body1']= array();
			}else{
				$data['body']=$this->General_model->getAllDischargedReportWOCOH($department);
				$data['body1'] = $this->Hmo_model->getAllAdmissionARHMOBilling($rundate);
			}
			//$this->load->view('pages/billing/'.$page, $data);
			$html=$this->load->view('pages/billing/'.$page, $data,true);
			$page="print_daily_discharged_report_credit";
			$html1=$this->load->view('pages/billing/'.$page, $data,true);
			//$this->load->view('pages/billing/'.$page, $data);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'orientation' => 'L',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
             </div>');
			$mpdf->setHTMLFooter('
            <div style="text-align:left;">
             <table width="50%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td><b>Prepared by:</b></td>
                     <td><b>Checked by:</b></td>
                     <td><b>Noted by:</b></td>
              </tr>
              <tr>
              	<td colspan="3">&nbsp;</td>
              </tr>
              <tr>
                     <td><u>'.$user.'</u></td>
                     <td><u>E. MUDANZA</u></td>
                     <td><u>MEHRALYN L. TORCULAS</u></td>
              </tr>
              <tr>
                     <td>BILLING</td>
                     <td>CASHIER</td>
                     <td>FINANCE OFFICER</td>
              </tr>
            </table>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->AddPage();
			$mpdf->WriteHTML($html1);
			$mpdf->Output();
	 }

	 public function print_daily_discharged_report_alpha(){
			$page="print_daily_discharged_report_alpha";
			if(!file_exists(APPPATH.'views/pages/billing/'.$page.".php")){
				show_404();
			}
			// if($this->session->user_login){
			// }else{
			// 	redirect('http://192.168.0.100:100/ERP');
			// }
			$rundate=$this->input->post('rundate');
			$type=$this->input->post('type');
			$department=$this->input->post('department');
			if($this->session->fullname==""){
				$user=$this->input->post('fullname');
			}else{
				$user=$this->session->fullname;
			}
			$startdate=date('F d, Y',strtotime($rundate));
			$data['type'] = $type;
			$data['startdate'] = $startdate;
			$data['rundate'] = $rundate;
			$data['department'] = $department;
			$data['button'] = "";
			$header=$this->General_model->getinfo();
			if($type=="WCOH"){
				$data['body']=$this->General_model->getAllDischargedReportCOH($department);
				$data['body1']= array();
			}else{
				$data['body']=$this->General_model->getAllDischargedReportWOCOH($department);
				$data['body1'] = $this->Hmo_model->getAllAdmissionARHMOBilling($rundate);
			}
			$this->load->view('pages/billing/'.$page, $data);
			//$html=$this->load->view('pages/billing/'.$page, $data,true);
			$page="print_daily_discharged_report_credit";
			//$html1=$this->load->view('pages/billing/'.$page, $data,true);
			$this->load->view('pages/billing/'.$page, $data);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'orientation' => 'L',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
             </div>');
			$mpdf->setHTMLFooter('
            <div style="text-align:left;">
             <table width="50%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td><b>Prepared by:</b></td>
                     <td><b>Checked by:</b></td>
                     <td><b>Noted by:</b></td>
              </tr>
              <tr>
              	<td colspan="3">&nbsp;</td>
              </tr>
              <tr>
                     <td><u>'.$user.'</u></td>
                     <td><u>E. MUDANZA</u></td>
                     <td><u>MEHRALYN L. TORCULAS</u></td>
              </tr>
              <tr>
                     <td>BILLING</td>
                     <td>CASHIER</td>
                     <td>FINANCE OFFICER</td>
              </tr>
            </table>
             </div>');
			// $mpdf->autoPageBreak = true;
			// $mpdf->WriteHTML($html);
			// $mpdf->AddPage();
			// $mpdf->WriteHTML($html1);
			// $mpdf->Output();
	 }

	 public function print_daily_discharged_report_excel(){
			$page="print_daily_discharged_report_excel";
			if(!file_exists(APPPATH.'views/pages/billing/'.$page.".php")){
				show_404();
			}
			// if($this->session->user_login){
			// }else{
			// 	redirect('http://192.168.0.100:100/ERP');
			// }
			$rundate=$this->input->post('rundate');
			$type=$this->input->post('type');
			$department=$this->input->post('department');
			if($this->session->fullname==""){
				$user=$this->input->post('fullname');
			}else{
				$user=$this->session->fullname;
			}
			$startdate=date('F d, Y',strtotime($rundate));
			$data['type'] = $type;
			$data['startdate'] = $startdate;
			$data['department'] = $department;
			$header=$this->General_model->getinfo();
			if($type=="WCOH"){
				$data['body']=$this->General_model->getAllDischargedReportCOH($department);
			}else{
				$data['body']=$this->General_model->getAllDischargedReportWOCOH($department);
			}
			$data['button']="1";
			$this->load->view('pages/billing/'.$page, $data);
			$page="print_daily_discharged_report_credit_excel";
			$this->load->view('pages/billing/'.$page, $data);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'orientation' => 'L',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
             </div>');
			$mpdf->setHTMLFooter('
            <div style="text-align:left;">
             <table width="50%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td><b>Prepared by:</b></td>
                     <td><b>Checked by:</b></td>
                     <td><b>Noted by:</b></td>
              </tr>
              <tr>
              	<td colspan="3">&nbsp;</td>
              </tr>
              <tr>
                     <td><u>'.$user.'</u></td>
                     <td><u>E. MUDANZA</u></td>
                     <td><u>MEHRALYN L. TORCULAS</u></td>
              </tr>
              <tr>
                     <td>BILLING</td>
                     <td>CASHIER</td>
                     <td>FINANCE OFFICER</td>
              </tr>
            </table>
             </div>');
			// $mpdf->autoPageBreak = true;
			// $mpdf->WriteHTML($html);
			// $mpdf->AddPage();
			// $mpdf->WriteHTML($html1);
			// $mpdf->Output();
	 }
	 public function patient_refund(){
			if($this->session->user_login){
				$page="post_refund";
				if(!file_exists(APPPATH.'views/pages/billing/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Post Refund";
					$data['search_result']="";
					$this->load->view('templates/headerOther',$data);
					$this->load->view('pages/billing/'.$page,$data);
					$this->load->view('templates/modalOther',$data);
					$this->load->view('templates/footer');
					}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function search_patient_refund(){
			if($this->session->user_login){
				$page="post_refund";
				if(!file_exists(APPPATH.'views/pages/billing/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Post Refund";
					$description=$this->input->post('description');
					$data['search_result']=$this->Cashier_model->getRefundPatient($description);
					$this->load->view('templates/headerOther',$data);
					$this->load->view('pages/billing/'.$page,$data);
					$this->load->view('templates/modalOther',$data);
					$this->load->view('templates/footer');
					}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function manage_refund($caseno){
			if($this->session->user_login){
				$page="manage_refund";
				if(!file_exists(APPPATH.'views/pages/billing/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['title']="Post Refund";
					$data['caseno']=$caseno;
					$data['patient']=$this->Hmo_model->getPatient($caseno);
					$data['history']=$this->Cashier_model->getRefundPatientDetails($caseno);
					$this->load->view('templates/headerOther',$data);
					$this->load->view('pages/billing/'.$page,$data);
					$this->load->view('templates/modalOther',$data);
					$this->load->view('templates/footer');
					}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_refund(){
			$caseno=$this->input->post('caseno');
			$update=$this->Cashier_model->save_refund();
			if($update){
				$message="Patient refund successfully posted with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Patient Refund amount successfully posted!');window.location='".base_url()."manage_refund/$caseno';</script>";
			}else{
				echo "<script>alert('Unable to post patient refund amount!');window.location='".base_url()."manage_refund/$caseno';</script>";
			}
		}
		public function remove_refund($caseno,$refno){
			$update=$this->Cashier_model->remove_refund($refno);
			if($update){
				$message="Patient refund successfully removed with caseno $caseno.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Patient Refund amount successfully removed!');window.location='".base_url()."manage_refund/$caseno';</script>";
			}else{
				echo "<script>alert('Unable to remove patient refund amount!');window.location='".base_url()."manage_refund/$caseno';</script>";
			}
		}
		public function report_settings(){
			if($this->session->user_login){
				$page="report_settings";
				if(!file_exists(APPPATH.'views/pages/billing/'.$page.".php")){
					$page="error404";
					$this->load->view('pages/'.$page);
				}else{
					$data['header']=$this->General_model->getInfo();
					$data['items']=$this->General_model->getAllBillingAccount();
					$data['title']="Report Settings";					
					$this->load->view('templates/headerOther',$data);
					$this->load->view('pages/billing/'.$page,$data);
					$this->load->view('templates/modalOther',$data);
					$this->load->view('templates/footer');
					}
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
		}
		public function save_billing_report(){
			$id=$this->input->post('id');
			$accounttitle=explode(',',$this->input->post('accounttitle'));
			$x=0;			
			foreach($accounttitle as $accttitle){
				$update=$this->General_model->save_billing_report($id,$accttitle);
				if($update){
					$x++;
				}				
			}			
			if($x > 0){
				$message="Billing report account title ($accttitle) successfully saved.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Billing report account title ($accttitle) successfully saved.');</script>";
			}else{
				echo "<script>alert('Unable to save billing account title!');</script>";
			}
				echo "<script>window.location='".base_url()."report_settings';</script>";
		}
		public function delete_billing_report($id,$accttitle){			
			$update=$this->General_model->delete_billing_report($id);			
			if($update){
				$message="Billing report account title ($accttitle) successfully deleted.";
				$loginuser=$this->session->fullname;
				$this->General_model->userlogs($message,$loginuser);
				echo "<script>alert('Billing report account title ($accttitle) successfully deleted.');</script>";
			}else{
				echo "<script>alert('Unable to delete billing account title!');</script>";
			}
				echo "<script>window.location='".base_url()."report_settings';</script>";
		}
		//======================================End of Billing Module===========================

	 	//=====================================Start of NS Module===============================
	 	public function print_home_meds($caseno,$batchno){
			$page="print_home_meds";
			if(!file_exists(APPPATH.'views/pages/reports/'.$page.".php")){
				show_404();
			}
			$header=$this->General_model->getinfo();
			$profile=$this->Admission_model->fetch_single_admission($caseno);
			$ap=$this->General_model->fetch_single_doctor_by_code($profile['ap']);
			$data['body']=$this->General_model->getAllHomeMeds($caseno,$batchno);
			$data['caseno']=$caseno;
			$body=$this->General_model->getAllHomeMeds($caseno,$batchno);
			$html=$this->load->view('pages/reports/'.$page, $data,true);
			//$this->load->view('pages/reports/'.$page, $data);
			$mpdf = new \Mpdf\Mpdf([
				'setAutoTopMargin' => 'stretch',
				'margin_left' => 5,
				'margin_right' => 115,
				'setAutoBottomMargin' => 'stretch',
				'margin_footer' => 175,
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="35"><img src="'.base_url().'design/images/kmsci.png" width="25"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:10px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
              </tr>
            </table>
            <br>
            <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-family:Arial; font-size:9px;">
                <tr>
                     <td width="18%">Patient Name:</td>
                     <td style="border-bottom:1px solid black;">'.$profile['lastname'].', '.$profile['firstname'].' '.$profile['middlename'].'</td>
              	</tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-family:Arial; font-size:9px;">
              <tr>
                     <td width="7%">Age:</td>
                     <td style="border-bottom:1px solid black;" align="center">'.$profile['age'].'</td>
                     <td width="7%">Sex:</td>
                     <td style="border-bottom:1px solid black;" align="center">'.$profile['sex'].'</td>
                     <td>&nbsp;</td>
                     <td width="10%">Date:</td>
                     <td style="border-bottom:1px solid black;" width="20%">'.date('M d, Y').'</td>
              </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-family:Arial; font-size:9px;">
              <tr>
                     <td width="13%">Address:</td>
                     <td style="border-bottom:1px solid black;">'.$profile['street'].', '.$profile['barangay'].', '.$profile['municipality'].', '.$profile['province'].'</td>
              </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-family:Arial; font-size:9px;">
              <tr>
              	<td colspan="2" style="border-bottom:2px solid black;">&nbsp;</td>
              </tr>
              <tr>
              	<td colspan="2"><br><img src="'.base_url().'design/images/RX.png" height="40"></td>
              </tr>
            </table>
            <br>
            <table width="100%" border="0" cellpadding="2" cellspacing="0" style="font-size: 10px;">
				<tr>
					<td>Generic/Brand</td>
					<td align="center" width="10%">Qty</td>
				</tr>
				</table>
             </div>');
			$mpdf->setHTMLFooter('
            <div style="text-align:right;">
             <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-family:Arial; font-size:10px;">
                <tr>
                   <td width="50%">&nbsp;</td>
                   <td style="border-bottom:1px solid black;" colspan="2" align="center">DR. '.$ap['name'].'</td>
               </tr>
               <tr>
               		<td width="50%">&nbsp;</td>
                    <td width="15%"><b>License #</b></td>
                    <td style="border-bottom:1px solid black;">'.$ap['licenseno'].'</td>
               </tr>
               <tr>
               		<td width="50%">&nbsp;</td>
                    <td width="15%"><b>PTR #</b></td>
                    <td style="border-bottom:1px solid black;">'.$ap['ptrno'].'</td>
               </tr>
               <tr>
               		<td width="50%">&nbsp;</td>
                    <td width="15%"><b>S2 #</b></td>
                    <td style="border-bottom:1px solid black;">'.$ap['s2no'].'</td>
               </tr>
            </table>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
	 }
	 	//=====================================End of NS module=================================

	 //========================================Start of Accounting Module=======================
	 public function view_patient_deposit(){
			$page = "view_patient_deposit";
			if(!file_exists(APPPATH.'views/pages/accounting/'.$page.".php")){
				show_404();
			}
			if($this->session->user_login){
			}else{
				redirect('http://192.168.0.100:100/ERP');
			}
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate');
			$startdatebeg=date('Y-m-d',strtotime('-1 month',strtotime($startdate)));
			$enddatebeg=date('Y-m-t',strtotime($startdatebeg));
			$header=$this->General_model->getinfo();
			$data['body']=$this->General_model->getAllPatientByDate($startdate,$enddate);
			$data['begin']=$this->General_model->getAllPatientByDate($startdatebeg,$enddatebeg);
			$data['startdate'] = $startdate;
			$data['enddate'] = $enddate;
			$data['startdatebeg'] = $startdatebeg;
			$data['enddatebeg'] = $enddatebeg;
			$html=$this->load->view('pages/accounting/'.$page, $data,true);
			$mpdf = new \Mpdf\Mpdf([
				'margin_top' => 46.5,
				'margin_left' => 5,
				'margin_right' => 5,
				'setAutoBottomMargin' => 'stretch',
				'format' => 'folio'
			]);
			$mpdf->setHTMLHeader('
            <div style="text-align:left;">
             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;">
                <tr>
                     <td width="10">&nbsp;</td>
                     <td width="80"><img src="'.base_url().'design/images/kmsci.png" width="70"></td>
                    <td align="left" style="font-family:Arial;"><b style="font-size:16px;">'.$header['heading'].'</b><br>
                    <font style="font-size:10px;">'.$header['address'].'</font><br>
                    <font style="font-size:10px;">Tel. No.: '.$header['telno'].'</font></td>
                  <td width="60">&nbsp;</td>
              </tr>
            </table>
            <h4 style="margin-left:90px;">PATIENT DEPOSIT REPORT</h4>
            <table width="100%" border="1" cellpadding="2" cellspacing="0" style="font-size: 12px;border-collapse: collapse;">
				<tr>
					<td width="10%" align="center"><b>DATE</b></td>
					<td width="40%" align="center"><b>PATIENT NAME</b></td>
					<td align="center" width="30%"><b>DEBIT</b></td>
					<td align="center" width="20%"><b>CREDIT</b></td>
				</tr>
				</table>
             </div>');
			$mpdf->autoPageBreak = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}
	 //========================================End of Accounting Module=========================
	}
?>
