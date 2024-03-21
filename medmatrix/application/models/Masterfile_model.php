<?php
date_default_timezone_set('Asia/Manila');
	class Masterfile_model extends CI_model{
		public function __construct(){
            $this->load->database();
        }
        public function getAllEmployees(){
            $result=$this->db->query("SELECT * FROM nsauthemployees ORDER BY lastname ASC, firstname ASC");
            return $result->result_array();
        }
        public function save_employee(){
            $lastname=$this->input->post('lastname');
            $firstname=$this->input->post('firstname');
            $middlename=$this->input->post('middlename');
            $birthdate=$this->input->post('birthdate');
            $gender=$this->input->post('gender');
            $fullname=$firstname." ".$middlename." ".$lastname;
            $address=$this->input->post('address');

            $bday = new DateTime($birthdate); // Your date of birth
            $today = new Datetime(date('Y-m-d'));
            $diff = $today->diff($bday);
            $age=$diff->y;

            $position=$this->input->post('designation');
            $salary=$this->input->post('salary');
            $tin=$this->input->post('tin');
            $sss=$this->input->post('sss');
            $phic=$this->input->post('phic');
            $hdmf=$this->input->post('hdmf');

            $check=$this->db->query("SELECT * FROM nsauthemployees WHERE lastname='$lastname' AND firstname='$firstname' AND middlename='$middlename' AND birthdate='$birthdate'");
            if($check->num_rows()>0){
                return false;                
            }else{
                $empid=$this->db->query("SELECT autono FROM empid ORDER BY autono DESC LIMIT 1");
                if($empid->num_rows()>0){
                    $eid=$empid->row_array();
                    $id=$eid['autono'];
                    $id = $id + 1;
                    $insert=$this->db->query("INSERT INTO nsauthemployees VALUES('$lastname','$firstname','$middlename','$fullname','$id','$address','$birthdate','$age','$gender','$position','$salary','$tin','$sss','$phic','$hdmf',NOW(),'','Active','','','')");
                    if($insert){
                        $this->db->query("INSERT INTO empid VALUES('$id')");
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }
        public function fetch_single_employee($id){
            $result=$this->db->query("SELECT * FROM nsauthemployees WHERE empid='$id'");
            return $result->result_array();
        }
        public function getSingleEmployee($id){
            $result=$this->db->query("SELECT * FROM nsauthemployees WHERE empid='$id'");
            return $result->row_array();
        }
        public function getEmployeeAccess($id){
            $result=$this->db->query("SELECT * FROM nsauth WHERE empid='$id' ORDER BY station ASC");
            return $result->result_array();
        }
		public function getDoctorAccess($id){
			$result=$this->db->query("SELECT * FROM nsauthdoctors WHERE empid='$id' AND station <> '' ORDER BY station ASC");
			return $result->result_array();
		}
        public function fetch_single_access($id,$station){
            $result=$this->db->query("SELECT * FROM nsauth WHERE empid='$id' AND autono='$station'");
            return $result->result_array();
        }
		public function fetch_doctor_access($id,$station){
			$result=$this->db->query("SELECT * FROM nsauthdoctors WHERE empid='$id' AND autono='$station'");
			return $result->result_array();
		}
        public function update_employee(){
            $empid=$this->input->post('empid');
            $lastname=$this->input->post('lastname');
            $firstname=$this->input->post('firstname');
            $middlename=$this->input->post('middlename');
            $birthdate=$this->input->post('birthdate');
            $gender=$this->input->post('gender');
            $fullname=$firstname." ".$middlename." ".$lastname;
            $address=$this->input->post('address');

            $bday = new DateTime($birthdate); // Your date of birth
            $today = new Datetime(date('Y-m-d'));
            $diff = $today->diff($bday);
            $age=$diff->y;

            $position=$this->input->post('designation');
            $salary=$this->input->post('salary');
            $tin=$this->input->post('tin');
            $sss=$this->input->post('sss');
            $phic=$this->input->post('phic');
            $hdmf=$this->input->post('hdmf');

            $update=$this->db->query("UPDATE nsauthemployees SET lastname='$lastname',firstname='$firstname',middlename='$middlename',`name`='$fullname',`address`='$address',birthdate='$birthdate',age='$age',gender='$gender',position='$position',salary='$salary',tin='$tin',sss='$sss',philhealth='$phic',pagibig='$hdmf' WHERE empid='$empid'");
            if($update){
                return true;
            }else{
                return false;
            }
        }

        public function delete_user_account($id){
            $result=$this->db->query("DELETE FROM nsauth WHERE autono='$id'");
            if($result){
                return true;
            }else{
                return false;
            }
        }
		public function delete_doctor_account($id){
			$result=$this->db->query("DELETE FROM nsauthdoctors WHERE autono='$id'");
			if($result){
				return true;
			}else{
				return false;
			}
		}

        public function getAllStation(){
            $result=$this->db->query("SELECT * FROM station ORDER BY station ASC");
            return $result->result_array();
        }
        public function checkStationExist($station,$empid){
            $result=$this->db->query("SELECT * FROM nsauth WHERE station='$station' AND empid='$empid'");
            if($result->num_rows()>0){
                return true;
            }else{
                return false;
            }
        }
		public function checkAccessExist($station,$empid){
			$result=$this->db->query("SELECT * FROM nsauthdoctors WHERE station='$station' AND empid='$empid'");
			if($result->num_rows()>0){
				return true;
			}else{
				return false;
			}
		}
        public function add_employee_access(){
            $empid=$this->input->post('empid');
            $access=$this->input->post('access');
            $station=$this->input->post('station');
            $details=$this->db->query("SELECT * FROM nsauthemployees WHERE empid='$empid'");
            if($details->num_rows()>0){
                $emp=$details->row_array();
                $user=$emp['username'];
                $pass=$emp['password'];
                $name=$emp['name'];
                $datearray=date('Y-m-d');
                $insert=$this->db->query("INSERT INTO nsauth(station,`password`,username,`name`,empid,shift,datearray,Branch,Access) VALUES('$station','$pass','$user','$name','$empid','0','$datearray','KMSCI','$access')");
                if($insert){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        public function update_user_account(){
            $empid=$this->input->post('empid');
            $username=$this->input->post('username');
            $password=$this->input->post('password');
            $check=$this->db->query("SELECT * FROM nsauthemployees WHERE (username='$username' OR `password`='$password') AND empid <> '$empid'");
            if($check->num_rows()>0){
                return false;
            }else{
                $update=$this->db->query("UPDATE nsauthemployees SET username='$username',`password`='$password' WHERE empid='$empid'");
                if($update){
                    $this->db->query("UPDATE nsauth SET username='$username',`password`='$password' WHERE empid='$empid'");
                    return true;
                }else{
                    return false;
                }
            }            
        }

        public function update_user_access(){
            $empid=$this->input->post('empid');
			$autono=$this->input->post('autono');
			$access=$this->input->post('access');
            $update=$this->db->query("UPDATE nsauth SET Access='$access' WHERE autono='$autono'");
            if($update){
                return true;
            }else{
                return false;
            }
        }

		public function update_doctor_access(){
			$empid=$this->input->post('empid');
			$autono=$this->input->post('autono');
			$access=$this->input->post('access');
			$update=$this->db->query("UPDATE nsauthdoctors SET Access='$access' WHERE autono='$autono'");
			if($update){
				return true;
			}else{
				return false;
			}
		}

        public function getAllDoctors(){
            $result=$this->db->query("SELECT * FROM docfile ORDER BY lastname ASC");
            return $result->result_array();
        }
        public function getAllSpecialization(){
            $result=$this->db->query("SELECT * FROM PF_SHARING GROUP BY specialization ORDER BY specialization ASC");
            return $result->result_array();
        }

        public function save_doctor(){
            $lastname=$this->input->post('lastname');
            $firstname=$this->input->post('firstname');
            $middlename=$this->input->post('middlename');
            $suffix=$this->input->post('suffix');
            $specialization=$this->input->post('specialization');
            $fullname=$firstname." ".$middlename." ".$lastname;
            $phicacc=$this->input->post('phicacc');            

            $tin=$this->input->post('tin');
            $pf=$this->input->post('pf');
            $email=$this->input->post('email');
            $rebates=$this->input->post('rebates');
            $licenseno=$this->input->post('licenseno');
            $ptrno=$this->input->post('ptrno');
            $s2no=$this->input->post('s2no');

            $check=$this->db->query("SELECT * FROM docfile WHERE lastname='$lastname' AND firstname='$firstname' AND middlename='$middlename' AND phicacc='$phicacc'");
            if($check->num_rows()>0){
                return false;                
            }else{
                $empid=$this->db->query("SELECT autono FROM docid ORDER BY autono DESC LIMIT 1");
                if($empid->num_rows()>0){
                    $eid=$empid->row_array();
                    $id=$eid['autono'];
                    $id = $id + 1;
                    $insert=$this->db->query("INSERT INTO docfile(code,`name`,specialization,tod,phicacc,tinbir,PF,rebates,emailaddress,licenseno,ptrno,s2no,lastname,firstname,middlename,ext,status) VALUES('$id','$fullname','$specialization','$specialization','$phicacc','$tin','$pf','$rebates','$email','$licenseno','$ptrno','$s2no','$lastname','$firstname','$middlename','$suffix','ACTIVE')");
                    if($insert){
                        $this->db->query("INSERT INTO docid VALUES('$id')");
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }

		public function add_doctor_access(){
			$empid=$this->input->post('empid');
			$access=$this->input->post('access');
			$station=$this->input->post('station');
			$details=$this->db->query("SELECT nd.username,nd.password,d.name FROM nsauthdoctors nd INNER JOIN docfile d ON d.code=nd.empid WHERE nd.empid='$empid'");
			if($details->num_rows()>0){
				$emp=$details->row_array();
				$user=$emp['username'];
				$pass=$emp['password'];
				$name=$emp['name'];
				$datearray=date('Y-m-d');
				$insert=$this->db->query("INSERT INTO nsauthdoctors(station,`password`,username,`name`,empid,shift,datearray,Branch,Access) VALUES('$station','$pass','$user','$name','$empid','0','$datearray','KMSCI','$access')");
				if($insert){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

        public function getSingleDoctor(){
			$searchme=$this->input->post('searchme');
            $result=$this->db->query("SELECT * FROM docfile WHERE CONCAT(lastname,' ',firstname) LIKE '%%$searchme%%'");
            return $result->result_array();
        }
		public function getSingleDoctorByID($id){
			$result=$this->db->query("SELECT * FROM nsauthdoctors WHERE empid='$id'");
			return $result->row_array();
		}
		public function getSingleDoctorByCode($id){
			$result=$this->db->query("SELECT * FROM docfile WHERE `code`='$id'");
			return $result->row_array();
		}
        public function fetch_single_doctor($id){
            $result=$this->db->query("SELECT * FROM docfile WHERE code='$id'");
            return $result->result_array();
        }
		public function fetch_account_doctor($id){
			$result=$this->db->query("SELECT * FROM nsauthdoctors WHERE empid='$id'");
			return $result->result_array();
		}

        public function update_doctor(){
            $code=$this->input->post('code');
            $lastname=$this->input->post('lastname');
            $firstname=$this->input->post('firstname');
            $middlename=$this->input->post('middlename');
            $suffix=$this->input->post('suffix');
            $specialization=$this->input->post('specialization');
            $fullname=$firstname." ".$middlename." ".$lastname;
            $phicacc=$this->input->post('phicacc');            

            $tin=$this->input->post('tin');
            $pf=$this->input->post('pf');
            $email=$this->input->post('email');
            $rebates=$this->input->post('rebates');
            $licenseno=$this->input->post('licenseno');
            $ptrno=$this->input->post('ptrno');
            $s2no=$this->input->post('s2no');
            
            $insert=$this->db->query("UPDATE docfile SET `name`='$fullname',specialization='$specialization',tod='$specialization',phicacc='$phicacc',tinbir='$tin',PF='$pf',rebates='$rebates',emailaddress='$email',licenseno='$licenseno',ptrno='$ptrno',s2no='$s2no',lastname='$lastname',firstname='$firstname',middlename='$middlename',ext='$suffix' WHERE code='$code'");
            if($insert){
                return true;
            }else{
                return false;
            }                            
        }
		public function update_doctor_account(){
			$empid=$this->input->post("empid");
			$username=$this->input->post("username");
			$password=$this->input->post("password");
			$check=$this->db->query("SELECT * FROM nsauthdoctors WHERE empid='$empid'");
			if($check->num_rows()>0){
				$update=$this->db->query("UPDATE nsauthdoctors SET username='$username',password='$password' WHERE empid='$empid'");
			}else{
				$update=$this->db->query("INSERT INTO nsauthdoctors(username,password,empid) VALUES('$username','$password','$empid')");
			}
			if($update){
				return true;
			}else{
				return false;
			}
		}

        public function doctorstatus($status){
            $id=$this->input->post("code");
            $result=$this->db->query("UPDATE docfile SET `status`='$status' WHERE code='$id'");
            if($result){
                return true;
            }else{
                return false;
            }
        }

        public function getAllRooms(){
            $result=$this->db->query("SELECT nursestation,MAX(roomrates) as roomrates FROM room WHERE nursestation <> '' GROUP BY nursestation ORDER BY autono ASC");
            return $result->result_array();
        }
        public function getRoom($station){
            $result=$this->db->query("SELECT * FROM room WHERE nursestation='$station' ORDER BY room");
            return $result->result_array();
        }
        public function getSingleStation($room){
            $result=$this->db->query("SELECT * FROM room WHERE nursestation='$room' ORDER BY room ASC");
            return $result->result_array();
        }
        public function getSingleStationByDesc($station,$room){
            $result=$this->db->query("SELECT * FROM room WHERE nursestation='$station' AND room LIKE '%$room%' ORDER BY room ASC");
            return $result->result_array();
        }
        public function save_room(){
            $station=$this->input->post('station');
			$autono=$this->input->post('autono');
            $room=$this->input->post('room');
            $roomrates=$this->input->post('roomrates');
            $roomprop=$this->input->post('roomprop');
            $credit=$this->input->post('credit');
            $roomkit=$this->input->post('roomkit');
			if($autono==""){
				$check=$this->db->query("SELECT * FROM room WHERE room='$room'");
				if($check->num_rows()>0){
					return false;
				}else{
					$insert=$this->db->query("INSERT INTO room(room,roomrates,roomstat,roomprop,pfadmit,pfattend,DOCTORS_PF,nursestation,`type`,branch) VALUES('$room','$roomrates','vacant','$roomprop','$credit','$roomkit','0','$station','0','KMSCI')");
					if($insert){
						return true;
					}else{
						return false;
					}
				}
			}else{
				$check=$this->db->query("SELECT * FROM room WHERE room='$room' AND autono <> '$autono'");
				if($check->num_rows()>0){
					return false;
				}else{
					$insert=$this->db->query("UPDATE room SET room='$room',roomrates='$roomrates',roomprop='$roomprop',pfadmit='$credit',pfattend='$roomkit' WHERE autono='$autono'");
					if($insert){
						return true;
					}else{
						return false;
					}
				}
			}
        }
        public function fetch_single_room($id){
            $result=$this->db->query("SELECT * FROM room WHERE autono='$id'");
            return $result->result_array();
        }
        public function update_room(){
            $autono=$this->input->post('autono');
            $station=$this->input->post('station');
            $room=$this->input->post('room');
            $roomrates=$this->input->post('roomrates');
            $roomprop=$this->input->post('roomprop');
            $credit=$this->input->post('credit');
            $roomkit=$this->input->post('roomkit');
            $check=$this->db->query("SELECT * FROM room WHERE room='$room' AND autono <> '$autono'");
            if($check->num_rows()>0){
                return false;
            }else{
                $insert=$this->db->query("UPDATE room SET room='$room',roomrates='$roomrates',roomprop='$roomprop',pfadmit='$credit',pfattend='$roomkit' WHERE autono='$autono'");
                if($insert){
                    return true;
                }else{
                    return false;
                }
            }
        }
        public function delete_room($id){
            $result=$this->db->query("DELETE FROM room WHERE autono='$id'");
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function change_room_status($id,$status){
            if($status=="vacant"){
                $status="occupied";
            }else{
                $status="vacant";
            }
            $result=$this->db->query("UPDATE room SET roomstat='$status' WHERE autono='$id'");
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function getAllHMO(){
            $result=$this->db->query("SELECT * FROM company WHERE acctno <> '' GROUP BY companyname ORDER BY companyname ASC");
            return $result->result_array();
        }
        public function getAllSingleHMO(){
            $searchme=$this->input->post('searchme');
            $result=$this->db->query("SELECT * FROM company WHERE acctno <> '' AND companyname LIKE '%$searchme%' GROUP BY companyname ORDER BY companyname ASC");
            return $result->result_array();
        }
        public function fetch_single_hmo($id){
            $result=$this->db->query("SELECT * FROM company WHERE acctno='$id'");
            return $result->result_array();
        }

        public function save_hmo(){
			$id=$this->input->post('hmo_id');
            $companyname=$this->input->post('company');
            $address=$this->input->post('address');
            $type=$this->input->post('hmotype');
			if($id==""){
				$check=$this->db->query("SELECT * FROM company WHERE companyname='$companyname'");
				if($check->num_rows()>0){
					return false;
				}else{
					$acctno=date('YmdHis');
					$insert=$this->db->query("INSERT INTO company(acctno,companyname,`Address`,`type`,NONPCS,PCS,ROD) VALUES('$acctno','$companyname','$address','$type','0','0','0')");
					if($insert){
						return true;
					}else{
						return false;
					}
				}
			}else{
				$acctno=$id;
				$companyname=$this->input->post('company');
				$address=$this->input->post('address');
				$type=$this->input->post('hmotype');
				$check=$this->db->query("SELECT * FROM company WHERE companyname='$companyname' AND acctno <> '$acctno'");
				if($check->num_rows()>0){
					return false;
				}else{
					$insert=$this->db->query("UPDATE company SET companyname='$companyname',`Address`='$address',`type`='$type' WHERE acctno='$acctno'");
					if($insert){
						return true;
					}else{
						return false;
					}
				}
			}
        }
        public function delete_hmo($id){
            $delete=$this->db->query("DELETE FROM company WHERE acctno='$id'");
            if($delete){
                return true;
            }else{
                return false;
            }
        }

        public function getAllDiagnostics(){
            $result=$this->db->query("SELECT * FROM receiving WHERE `unit` = 'LABORATORY' OR `unit` = '2D ECHO' OR `unit` = 'CT SCAN' OR `unit` = 'XRAY' OR `unit` = 'ULTRASOUND' OR `unit` = 'EEG' OR `unit` = 'ECG' OR `unit` = 'MAMMOGRAM' ORDER BY `unit` ASC ");
            return $result->result_array();
        }
        public function getAllSingleDiagnostics(){
            $searchme=$this->input->post("searchme");
            $result=$this->db->query("SELECT * FROM receiving WHERE `description` LIKE '%$searchme%' AND (`unit` = 'LABORATORY' OR `unit` = '2D ECHO' OR `unit` = 'CT SCAN' OR `unit` = 'XRAY' OR `unit` = 'ULTRASOUND' OR `unit` = 'EEG' OR `unit` = 'ECG' OR `unit` = 'MAMMOGRAM') ORDER BY `unit` ASC ");
            return $result->result_array();
        }
        public function getAllDiagnosticUnit(){
            $result=$this->db->query("SELECT `unit` FROM receiving WHERE `unit` = 'LABORATORY' OR `unit` = '2D ECHO' OR `unit` = 'CT SCAN' OR `unit` = 'XRAY' OR `unit` = 'ULTRASOUND' OR `unit` = 'EEG' OR `unit` = 'ECG' OR `unit` = 'MAMMOGRAM' GROUP BY `unit` ORDER BY `unit` ASC ");
            return $result->result_array();
        }
        public function getAllDiagnosticType(){
            $result=$this->db->query("SELECT lotno FROM receiving WHERE `unit` = 'LABORATORY' OR `unit` = '2D ECHO' OR `unit` = 'CT SCAN' OR `unit` = 'XRAY' OR `unit` = 'ULTRASOUND' OR `unit` = 'EEG' OR `unit` = 'ECG' OR `unit` = 'MAMMOGRAM' GROUP BY lotno ORDER BY lotno ASC");
            return $result->result_array();
        }
        public function save_diagnostic(){
			$oldcode=$this->input->post('code');
            $description=strtoupper($this->input->post('description'));
            $pnf=$this->input->post('pndf');
            $unit=$this->input->post('unit');            
            $cash=$this->input->post('cash');
            $charge=$this->input->post('charge');
            $type=$this->input->post('ptype');
            
            $sql=$this->db->query("SELECT `code` FROM producttype WHERE producttype='$unit'");
            $pcode=$sql->row_array();
            $scode=$pcode['code'];
			if($oldcode==""){
				if ($pnf == "pndf") {
					$pnfr = "p";
				} else if ($pnf == "npndf") {
					$pnfr = "n";
				}

				$code = date('YmdHis') . $pnf . "-" . $scode;
			}else{
				$code = $oldcode;
			}
            $check=$this->db->query("SELECT * FROM receiving WHERE `description`='$description' AND `code` <> '$code'");
            if($check->num_rows()>0){
                return false;
            }else{
				if($oldcode=="") {
					$insert = $this->db->query("INSERT INTO `receiving` (`code`, `description`, `capital`, `sellingprice`, `quantity`, `expiration`, `lotno`, `unit`, `generic`, `OPD`, `WARD`, `PRIVATE`, `SEMIPRIVATE`, `prodtype`, `soloward`, `package`, `ave`, `unitcost`, `aveconsole`, `SuppliesPricing`, `pnf`, `itemname`, `testcode`, `gtestcode`) VALUES ('$code', '$description', '$cash', '$cash', '0', '', '$type', '$unit', '', '$cash', '$charge', '$charge', '$charge', '$unit', '$charge', '', '', '', '', '0', '$pnf', '$description', '0', '0')");
				}else{
					$insert=$this->db->query("UPDATE `receiving` SET `description`='$description', `capital`='$cash', `sellingprice`='$cash', `lotno`='$type', `unit`='$unit', `OPD`='$cash', `WARD`='$charge', `PRIVATE`='$charge', `SEMIPRIVATE`='$charge', `prodtype`='$unit', `soloward`='$charge', `pnf`='$pnf', `itemname`='$description' WHERE `code`='$code'");
				}
                if($insert){
					if($oldcode=="") {
						$this->db->query("INSERT INTO `productsmasterlist` (`code`, `unitprice`, `philhealth`, `hmo`, `nonmed`, `company`, `opd`, `quantity`, `expiration`, `lotno`, `unit`, `generic`, `criticallevel`) VALUES ('$code', '$cash', '$charge', '$charge', '$cash', '$charge', '$cash', '', '', '$type', '$unit', '', '')");
					}else{
						$this->db->query("UPDATE `productsmasterlist` SET `unitprice`='$cash', `philhealth`='$charge', `hmo`='$charge', `nonmed`='$cash', `company`='$charge', `opd`='$cash', `lotno`='$type', `unit`='$unit' WHERE `code`='$code'");
					}
                    return true;
                }else{
                    return false;
                }
            }
        }
        public function fetch_single_diagnostic($id){
            $result=$this->db->query("SELECT * FROM receiving WHERE `code`='$id'");
            return $result->result_array();
        }

        public function delete_diagnostic($id){
            $result=$this->db->query("DELETE FROM receiving WHERE `code`='$id'");
            if($result){
                return true;
            }else{
                return false;
            }
        }

        public function getAllOthers(){
            $result=$this->db->query("SELECT * FROM receiving WHERE `unit` <> 'LABORATORY' AND `unit` <> '2D ECHO' AND `unit` <> 'CT SCAN' AND `unit` <> 'XRAY' AND `unit` <> 'ULTRASOUND' AND `unit` <> 'EEG' AND `unit` <> 'ECG' AND `unit` <> 'MAMMOGRAM' AND `unit` <> 'PHARMACY/MEDICINE' AND `unit` <> 'PHARMACY/SUPPLIES' AND `unit` <> 'MEDICAL SURGICAL SUPPLIES' ORDER BY `unit` ASC ");
            return $result->result_array();
        }
        public function getAllSingleOthers(){
            $searchme=$this->input->post("searchme");
            $result=$this->db->query("SELECT * FROM receiving WHERE `description` LIKE '%$searchme%' AND `unit` <> 'LABORATORY' AND `unit` <> '2D ECHO' AND `unit` <> 'CT SCAN' AND `unit` <> 'XRAY' AND `unit` <> 'ULTRASOUND' AND `unit` <> 'EEG' AND `unit` <> 'ECG' AND `unit` <> 'MAMMOGRAM' AND `unit` <> 'PHARMACY/MEDICINE' AND `unit` <> 'PHARMACY/SUPPLIES' AND `unit` <> 'MEDICAL SURGICAL SUPPLIES' ORDER BY `unit` ASC");
            return $result->result_array();
        }
        public function getAllOtherUnit(){
            $result=$this->db->query("SELECT `unit` FROM receiving WHERE `unit` <> 'LABORATORY' AND `unit` <> '2D ECHO' AND `unit` <> 'CT SCAN' AND `unit` <> 'XRAY' AND `unit` <> 'ULTRASOUND' AND `unit` <> 'EEG' AND `unit` <> 'ECG' AND `unit` <> 'MAMMOGRAM' AND `unit` <> 'PHARMACY/MEDICINE' AND `unit` <> 'PHARMACY/SUPPLIES' AND `unit` <> 'MEDICAL SURGICAL SUPPLIES' GROUP BY `unit` ORDER BY `unit` ASC");
            return $result->result_array();
        }
        public function getAllOtherType(){
            $result=$this->db->query("SELECT lotno FROM receiving WHERE `unit` <> 'LABORATORY' AND `unit` <> '2D ECHO' AND `unit` <> 'CT SCAN' AND `unit` <> 'XRAY' AND `unit` <> 'ULTRASOUND' AND `unit` <> 'EEG' AND `unit` <> 'ECG' AND `unit` <> 'MAMMOGRAM' AND `unit` <> 'PHARMACY/MEDICINE' AND `unit` <> 'PHARMACY/SUPPLIES' AND `unit` <> 'MEDICAL SURGICAL SUPPLIES' GROUP BY `lotno`");
            return $result->result_array();
        }
        public function save_others(){
			$oldcode=$this->input->post('code');
            $description=strtoupper($this->input->post('description'));
            $pnf=$this->input->post('pndf');
            $unit=$this->input->post('unit');
            $cash=$this->input->post('cash');
            $charge=$this->input->post('charge');
            $type=$this->input->post('ptype');
            
            $sql=$this->db->query("SELECT `code` FROM producttype WHERE producttype='$unit'");
            $pcode=$sql->row_array();
            $scode=$pcode['code'];
            if($scode==""){
                $scode="00";
            }
			if($oldcode=="") {
				if ($pnf == "pndf") {
					$pnfr = "p";
				} else if ($pnf == "npndf") {
					$pnfr = "n";
				}

				$code = date('YmdHis') . $pnf . "-" . $scode;
			}else{
				$code=$oldcode;
			}
            $check=$this->db->query("SELECT * FROM receiving WHERE `description`='$description' AND `code` <> '$oldcode'");
            if($check->num_rows()>0){
                return false;
            }else{
				if($oldcode==""){
					$insert=$this->db->query("INSERT INTO `receiving` (`code`, `description`, `capital`, `sellingprice`, `quantity`, `expiration`, `lotno`, `unit`, `generic`, `OPD`, `WARD`, `PRIVATE`, `SEMIPRIVATE`, `prodtype`, `soloward`, `package`, `ave`, `unitcost`, `aveconsole`, `SuppliesPricing`, `pnf`, `itemname`, `testcode`, `gtestcode`) VALUES ('$code', '$description', '$cash', '$cash', '0', '', '$type', '$unit', '', '$cash', '$charge', '$charge', '$charge', '$unit', '$charge', '', '', '', '', '0', '$pnf', '$description', '0', '0')");
				}else{
					$insert=$this->db->query("UPDATE `receiving` SET `description`='$description', `capital`='$cash', `sellingprice`='$cash', `lotno`='$type', `unit`='$unit', `OPD`='$cash', `WARD`='$charge', `PRIVATE`='$charge', `SEMIPRIVATE`='$charge', `prodtype`='$unit', `soloward`='$charge', `pnf`='$pnf', `itemname`='$description' WHERE `code`='$code'");
				}
                if($insert){
					if($oldcode=="") {
						$this->db->query("INSERT INTO `productsmasterlist` (`code`, `unitprice`, `philhealth`, `hmo`, `nonmed`, `company`, `opd`, `quantity`, `expiration`, `lotno`, `unit`, `generic`, `criticallevel`) VALUES ('$code', '$cash', '$charge', '$charge', '$cash', '$charge', '$cash', '', '', '$type', '$unit', '', '')");
					}else{
						$this->db->query("UPDATE `productsmasterlist` SET `unitprice`='$cash', `philhealth`='$charge', `hmo`='$charge', `nonmed`='$cash', `company`='$charge', `opd`='$cash', `lotno`='$type', `unit`='$unit' WHERE `code`='$code'");
					}
                    return true;
                }else{
                    return false;
                }
            }
        }       

        public function update_others(){
            $code=$this->input->post('code');
            $description=strtoupper($this->input->post('description'));
            $pnf=$this->input->post('pndf');
            $unit=$this->input->post('unit');            
            $cash=$this->input->post('cash');
            $charge=$this->input->post('charge');
            $type=$this->input->post('ptype');
                                    
            $check=$this->db->query("SELECT * FROM receiving WHERE `description`='$description' AND `code` <> '$code'");
            if($check->num_rows()>0){
                return false;
            }else{
                $insert=$this->db->query("UPDATE `receiving` SET `description`='$description', `capital`='$cash', `sellingprice`='$cash', `lotno`='$type', `unit`='$unit', `OPD`='$cash', `WARD`='$charge', `PRIVATE`='$charge', `SEMIPRIVATE`='$charge', `prodtype`='$unit', `soloward`='$charge', `pnf`='$pnf', `itemname`='$description' WHERE `code`='$code'");
                if($insert){
                    $this->db->query("UPDATE `productsmasterlist` SET `unitprice`='$cash', `philhealth`='$charge', `hmo`='$charge', `nonmed`='$cash', `company`='$charge', `opd`='$cash', `lotno`='$type', `unit`='$unit' WHERE `code`='$code'");
                    return true;
                }else{
                    return false;
                }
            }
        }
        
        public function getAllProvince(){
            $result=$this->db->query("SELECT * FROM `state` ORDER BY statename ASC");
            return $result->result_array();
        }
        public function getAllCity($province){
            $result=$this->db->query("SELECT c.*,p.statename,z.ZIP_CODE as zipcode FROM `city` c INNER JOIN `state` p ON p.id=c.stateid INNER JOIN zipcode z ON z.MUN_ID=c.id WHERE c.stateid='$province' ORDER BY c.city ASC");
            return $result->result_array();
        }
        public function getAllSingleCity($province,$city){
            $result=$this->db->query("SELECT c.*,p.statename,z.ZIP_CODE as zipcode FROM `city` c INNER JOIN `state` p ON p.id=c.stateid INNER JOIN zipcode z ON z.MUN_ID=c.id WHERE c.stateid='$province' AND c.city LIKE '%$city%' ORDER BY c.city ASC");
            return $result->result_array();
        }
        public function getSingleProvince($id){
            $result=$this->db->query("SELECT * FROM `state` WHERE `id` = '$id'");
            return $result->result_array();
        }
		public function getSingleCity($id){
			$result=$this->db->query("SELECT c.*,z.* FROM city c INNER JOIN zipcode z ON z.MUN_ID=c.id WHERE c.`id` = '$id'");
			return $result->result_array();
		}
		public function getSingleBarangay($id){
			$result=$this->db->query("SELECT * FROM barangay WHERE `id` = '$id'");
			return $result->result_array();
		}
        public function getAllBarangay($city){
            $result=$this->db->query("SELECT b.*,c.city,p.statename FROM barangay b INNER JOIN `city` c ON c.id=b.cityid INNER JOIN `state` p ON p.id=c.stateid WHERE b.cityid='$city' ORDER BY b.barangay ASC");
            return $result->result_array();
        }
        public function getAllSingleBarangay($city,$barangay){
            $result=$this->db->query("SELECT b.*,c.city,p.statename FROM barangay b INNER JOIN `city` c ON c.id=b.cityid INNER JOIN `state` p ON p.id=c.stateid WHERE b.cityid='$city' AND b.barangay LIKE '%$barangay%' ORDER BY b.barangay ASC");
            return $result->result_array();
        }
		public function save_address(){
			$id=$this->input->post('id');
			$description=$this->input->post('description');
			$check=$this->db->query("SELECT * FROM `state` WHERE statename='$description' AND `id` <> '$id'");
			if($check->num_rows()>0){
				return false;
			}else {
				if ($id == "") {
					$q = $this->db->query("SELECT id as curr_id FROM `state` ORDER BY id DESC LIMIT 1");
					$qr = $q->row_array();
					$newid = $qr['curr_id'] + 1;
					$saveaddress = $this->db->query("INSERT INTO `state`(id,statename,countryid) VALUES('$newid','$description','1017')");
				}else{
					$saveaddress = $this->db->query("UPDATE `state` SET statename='$description' WHERE id='$id'");
				}
				if($saveaddress){
					return true;
				}else{
					return false;
				}
			}
		}

		public function delete_province($id){
			$check=$this->db->query("SELECT * FROM city WHERE stateid='$id'");
			$result=$check->result_array();
			foreach($result as $res){
				$this->db->query("DELETE FROM barangay WHERE cityid='$res[id]'");
				$this->db->query("DELETE FROM zipcode WHERE MUN_ID='$res[id]'");
			}
			$this->db->query("DELETE FROM city WHERE stateid='$id'");
			$delete=$this->db->query("DELETE FROM `state` WHERE id='$id'");
			if($delete){
				return true;
			}else{
				return false;
			}
		}
		public function save_city(){
			$id=$this->input->post('id');
			$province=$this->input->post('prov_id');
			$description=$this->input->post('description');
			$zipcode=$this->input->post("zipcode");
			$check=$this->db->query("SELECT * FROM city WHERE city='$description' AND `id` <> '$id' AND stateid = '$province'");
			if($check->num_rows()>0){
				return false;
			}else {
				if ($id == "") {
					$q = $this->db->query("SELECT id as curr_id FROM city ORDER BY id DESC LIMIT 1");
					$qr = $q->row_array();
					$newid = $qr['curr_id'] + 1;
					$saveaddress = $this->db->query("INSERT INTO city(id,city,stateid,logno) VALUES('$newid','$description','$province','99999999')");
					$this->db->query("INSERT INTO zipcode(PROV_ID,MUN_ID,ZIP_CODE) VALUES('$province','$newid','$zipcode')");
				}else{
					$saveaddress = $this->db->query("UPDATE city SET city='$description' WHERE id='$id'");
					$this->db->query("UPDATE zipcode SET ZIP_CODE='$zipcode' WHERE MUN_ID='$id'");
				}
				if($saveaddress){
					return true;
				}else{
					return false;
				}
			}
		}
		public function save_barangay(){
			$id=$this->input->post('id');
			$province=$this->input->post('prov_id');
			$city=$this->input->post('city_id');
			$description=$this->input->post('description');
			$zipcode=$this->input->post("zipcode");
			$check=$this->db->query("SELECT * FROM barangay WHERE barangay='$description' AND `id` <> '$id' AND cityid = '$city'");
			if($check->num_rows()>0){
				return false;
			}else {
				if ($id == "") {
					$q = $this->db->query("SELECT id as curr_id FROM barangay ORDER BY id DESC LIMIT 1");
					$qr = $q->row_array();
					$newid = $qr['curr_id'] + 1;
					$saveaddress = $this->db->query("INSERT INTO barangay(id,barangay,cityid,zipcode) VALUES('$newid','$description','$city','')");
				}else{
					$saveaddress = $this->db->query("UPDATE barangay SET barangay='$description' WHERE id='$id'");
				}
				if($saveaddress){
					return true;
				}else{
					return false;
				}
			}
		}
		public function delete_barangay($id){
			$result=$this->db->query("DELETE FROM barangay WHERE id='$id'");
			if($result){
				return true;
			}else{
				return false;
			}
		}
		public function delete_city($id){
			$result=$this->db->query("DELETE FROM barangay WHERE cityid='$id'");
			if($result){
				$this->db->query("DELETE FROM zipcode WHERE MUN_ID='$id'");
				$delete=$this->db->query("DELETE FROM city WHERE id='$id'");
			}
			if($delete){
				return true;
			}else{
				return false;
			}
		}

		public function save_religion(){
			$id=$this->input->post('id');
			$description=$this->input->post('description');
			if($id==""){
				$result=$this->db->query("INSERT INTO religion(`description`) VALUES('$description')");
			}else{
				$result=$this->db->query("UPDATE religion SET `description`='$description' WHERE id='$id'");
			}
			if($result){
				return true;
			}else{
				return false;
			}
		}

		public function delete_religion($id){
			$result=$this->db->query("DELETE FROM religion WHERE id='$id'");
			if($result){
				return true;
			}else{
				return false;
			}
		}

		public function save_station(){
			$id=$this->input->post('id');
			$description=$this->input->post('description');
			if($id==""){
				$result=$this->db->query("INSERT INTO station(station) VALUES('$description')");
			}else{
				$result=$this->db->query("UPDATE station SET station='$description' WHERE id='$id'");
			}
			if($result){
				return true;
			}else{
				return false;
			}
		}

		public function delete_station($id){
			$result=$this->db->query("DELETE FROM station WHERE id='$id'");
			if($result){
				return true;
			}else{
				return false;
			}
		}

		public function save_nationality(){
			$id=$this->input->post('id');
			$description=$this->input->post('description');
			if($id==""){
				$result=$this->db->query("INSERT INTO nationality(`description`) VALUES('$description')");
			}else{
				$result=$this->db->query("UPDATE nationality SET `description`='$description' WHERE id='$id'");
			}
			if($result){
				return true;
			}else{
				return false;
			}
		}

		public function delete_nationality($id){
			$result=$this->db->query("DELETE FROM nationality WHERE id='$id'");
			if($result){
				return true;
			}else{
				return false;
			}
		}

		public function save_accounttitle(){
			$id=$this->input->post('id');
			$description=$this->input->post('description');
			$check=$this->db->query("SELECT * FROM accttitle WHERE accttitle='$description' AND acctcode <> '$id'");
				if($check->num_rows()>0){
					return false;
				}else {
					if ($id == "") {
						$genid=$this->db->query("SELECT acctcode FROM accttitle ORDER BY acctcode DESC LIMIT 1");
						$nid=$genid->row_array();
						$newid=$nid['acctcode'] + 1;
						$result = $this->db->query("INSERT INTO accttitle(acctcode,accttitle,beg_balance,`date`) VALUES('$newid','$description','0','')");
					} else {
						$result = $this->db->query("UPDATE accttitle SET accttitle='$description' WHERE acctcode='$id'");
					}
					if ($result) {
						return true;
					} else {
						return false;
					}
				}
		}

		public function delete_accounttitle($id){
			$result=$this->db->query("DELETE FROM accttitle WHERE acctcode='$id'");
			if($result){
				return true;
			}else{
				return false;
			}
		}
		public function getItems(){
			$result=$this->db->query("SELECT * FROM receiving WHERE unit NOT LIKE '%PHARMACY/MEDICINE%' AND unit NOT LIKE '%LABORATORY%' AND unit NOT LIKE '%OFFICE SUPPLIES%' AND code <> ' ' AND unit NOT LIKE '%GENERAL SUPPLIES%' AND unit NOT LIKE '%CERTIFICATION%' AND unit NOT LIKE '%COMPUTER%' AND unit NOT LIKE '%CT SCAN%' AND unit NOT LIKE '%EEG%' AND unit NOT LIKE '%ECG%' AND unit NOT LIKE '%XRAY%' AND unit NOT LIKE '%ULTRASOUND%' AND unit NOT LIKE '%RADIOLOGY%' AND unit NOT LIKE '%ACCOUNTABLE%' AND unit NOT LIKE '%MEDICAL SURGICAL%' AND unit NOT LIKE '%CENTRAL SUPPLIES%'");
			return $result->result_array();
		}
		public function getAutocharge(){
			$result=$this->db->query("SELECT ac.code,r.itemname FROM receiving r INNER JOIN admissionautocharge ac ON ac.code=r.code");
			return $result->result_array();
		}
		public function checkAutocharge($code){
			$result=$this->db->query("SELECT * FROM admissionautocharge WHERE code='$code'");
			if($result->num_rows()>0){
				return true;
			}else{
				return false;
			}
		}
		public function save_autocharge(){
			$code=$this->input->post('code');
			$result=$this->db->query("INSERT INTO admissionautocharge(`code`,ward) VALUES('$code','IPD')");
			if($result){
				return true;
			}else{
				return false;
			}
		}
		public function delete_autocharge($id){
			$result=$this->db->query("DELETE FROM admissionautocharge WHERE code='$id'");
			if($result){
				return true;
			}else{
				return false;
			}
		}
	}
?>
