<?php
date_default_timezone_set('Asia/Manila');
class Hmo_model extends CI_model
{
	public function __construct()
	{
		$this->load->database();
	}
    public function getPatient($caseno){
        $result=$this->db->query("SELECT pp.*,a.* FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$caseno'");
        return $result->row_array();
    }
    public function getLOA($caseno){
        $result=$this->db->query("SELECT `policyno` FROM admission WHERE caseno='$caseno'");
        return $result->row_array();
    }
	public function getHMOAllocation(){
        $result=$this->db->query("SELECT id,producttype FROM hmoallocation ORDER BY id ASC");
        return $result->result_array();
    }
    public function getHMOAllocationType($id){
        $result=$this->db->query("SELECT productsubtype FROM hmoallocationtype WHERE pid='$id' AND productsubtype <> 'PROFESSIONAL FEE'");
        return $result->result_array();
    }
    public function getHMOAllocationTypePF($id){
        $result=$this->db->query("SELECT productsubtype FROM hmoallocationtype WHERE pid='$id' AND productsubtype = 'PROFESSIONAL FEE'");
        return $result->result_array();
    }
    public function save_allocation(){
        $allocation=$this->input->post('amount');
        $account=$this->input->post('producttype');
        $caseno=$this->input->post('caseno');
        $items=$this->db->query("SELECT SUM(hmo) as amount FROM productout WHERE caseno='$caseno' AND quantity > 0 GROUP BY caseno");
        $item=$items->row_array();
        $totalhmo = $item['amount'];
        $loa=$this->input->post('loa');
        $totalamount=0;
        foreach($allocation AS $item){            
                $totalamount +=$item;            
        }
        $grandtotal = $totalhmo+$totalamount;
        $diff=$loa-$grandtotal;
        if($diff >= 0){
        $i=0;
        foreach($allocation AS $amount){
            if($amount>0){
                $allocate=$amount;
                $query=$this->db->query("SELECT pst.productsubtype FROM hmoallocationtype pst INNER JOIN hmoallocation pt ON pt.id=pst.pid WHERE pt.producttype='$account[$i]' ORDER BY pst.id DESC");
                if($query->num_rows()>0){
                    $result=$query->result_array();
                    foreach($result AS $row){
                        $qryitems=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND quantity > 0 AND gross > 0 AND trantype='charge' AND productsubtype='$row[productsubtype]' ORDER BY excess DESC");
                        if($qryitems->num_rows()>0){
                            $res=$qryitems->result_array();
                            foreach($res AS $items){
                                if($allocate>=$items['excess']){
                                    $allocate=$allocate-$items['excess'];                                    
                                    $excess=$items['gross']-$items['phic']-$items['excess']-$items['phic1'];
                                    $sqlUpdate=$this->db->query("UPDATE productout SET hmo='$items[excess]',excess='$excess' WHERE refno='$items[refno]'");
                                  }else if($allocate<$items['excess'] && $allocate > 0){                                    
                                    $excess=$items['excess']-$allocate;
                                    $sqlUpdate=$this->db->query("UPDATE productout SET hmo='$allocate',excess='$excess' WHERE refno='$items[refno]'");
                                    $allocate=0;
                                  }else{
                                    $allocate=0;                                    
                                  }
                            }
                        }
                        
                    }
                }
            }
            $i++;
        }
         if($sqlUpdate){
            return true;
        }else{
            $this->session->set_flashdata('save_failed','Unable to save allocation!');
            return false;
        }
    }else{
        $this->session->set_flashdata('save_failed','Unable to allocate! Allocation amount exceeds the LOA Limit!');
        return false;
    }       
    }
    public function remove_allocation($caseno,$producttype){
        $prodtype=$this->db->query("SELECT pst.productsubtype FROM hmoallocationtype pst INNER JOIN hmoallocation pt ON pt.id=pst.pid WHERE pt.producttype='$producttype'");;
        if($prodtype->num_rows()>0){
            $ptype=$prodtype->result_array();
            foreach($ptype as $row){
                $query=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND quantity > 0 AND gross > 0 AND hmo > 0 AND trantype='charge' AND productsubtype='$row[productsubtype]' ORDER BY excess DESC");
                if($query->num_rows()>0){
                    $result=$query->result_array();
                    foreach($result as $items){
                        $hmo=0;
                        $excess=($items['sellingprice']*$items['quantity'])-$items['adjustment']-$items['phic']-$items['phic1'];
                        $sqlUpdate=$this->db->query("UPDATE productout SET hmo='$hmo',excess='$excess' WHERE refno='$items[refno]'");                        
                    }
                }
            }
        }
        if($sqlUpdate){
            return true;
        }else{
            return false;
        }
    }
    public function save_allocation_pf(){
        $allocation=$this->input->post('amount');
        $account=$this->input->post('refno');
        $caseno=$this->input->post('caseno');
         $totalhmo=$this->input->post('totalhmo');
        $loa=$this->input->post('loa');
        $totalamount=0;
        foreach($allocation AS $item){
            if($item>0){
                $totalamount +=$item;
            }
        }
        $grandtotal = $totalhmo+$totalamount;
        if($loa >= $grandtotal){
        $i=0;
        foreach($account AS $rrno){
            if($allocation[$i]>0){
                $allocate=$allocation[$i];
                $sqlItem=$this->db->query("SELECT * FROM productout WHERE refno='$rrno'");
                $item=$sqlItem->row_array();
                $gross=$item['gross'];
                $phic=$item['phic'];
                $excess=$item['excess'];
                $phic1=$item['phic1'];
                if($allocate >= $excess){
                    $allocate=$excess;
                    $excess=0;
                    $sqlUpdate=$this->db->query("UPDATE productout SET hmo='$allocate',excess='$excess' WHERE refno='$rrno'");
                }else{
                    $excess=$gross-$phic-$allocate-$phic1;
                    $sqlUpdate=$this->db->query("UPDATE productout SET hmo='$allocate',excess='$excess' WHERE refno='$rrno'");
                }
            }
            $i++;
        }
        if($sqlUpdate){
            return true;
        }else{
            return false;
        }
    }else{
         $this->session->set_flashdata('save_failed','Unable to allocate! Allocation amount exceeds the LOA Limit!');
        return false;
    }
    }

    public function remove_allocation_pf($caseno,$refno){
        $sqlItem=$this->db->query("SELECT * FROM productout WHERE refno='$refno'");
        $item=$sqlItem->row_array();
        $gross=$item['gross'];
        $phic=$item['phic'];
        $phic1=$item['phic1'];
        $excess=$gross-$phic-$phic1;
        $sqlUpdate=$this->db->query("UPDATE productout SET hmo='0', excess='$excess' WHERE refno='$refno'");
        if($sqlUpdate){
            return true;
        }else{
            return false;
        }
    }
    public function remove_allocation_all($caseno){
        $sqlItem=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND trantype='charge' AND hmo > 0");
        $items=$sqlItem->result_array();
        foreach($items as $item){
            $gross=$item['gross'];
            $phic=$item['phic'];
            $phic1=$item['phic1'];
            $excess=$gross-$phic-$phic1;
            $sqlUpdate=$this->db->query("UPDATE productout SET hmo='0', excess='$excess' WHERE refno='$item[refno]'");
        }        
        if($sqlUpdate){
            return true;
        }else{
            return false;
        }
    }

    public function getHMOAssistance($caseno){
        $result=$this->db->query("SELECT *,excess as totalexcess FROM productout WHERE caseno='$caseno' AND (productsubtype NOT LIKE '%PROFESSIONAL FEE%' OR (productsubtype LIKE '%PROFESSIONAL FEE%' AND (producttype LIKE '%IPD apnurse%' OR producttype LIKE '%IPD admitting%'))) AND trantype='charge' AND status ='Approved' AND quantity > 0 AND (terminalname <> 'pending' AND administration <> 'pending' OR (productsubtype='PHYSICAL THERAPY' AND (terminalname='pending' OR terminalname='Testdone')) OR ((productsubtype LIKE '%MISC%' OR productsubtype LIKE '%NURSING%' OR productsubtype='MEDICAL EQUIPMENT' OR productsubtype LIKE '%DIETARY%' OR productsubtype LIKE '%OXYGEN%' OR productsubtype LIKE '% EC%' OR productsubtype LIKE '%FEE%'   OR productsubtype LIKE '%OR-CHARGES%' OR productsubtype LIKE '%SUPPLIES%')) OR productsubtype ='LABORATORY' OR productsubtype = 'CT SCAN')");
        return $result->result_array();
    }
    public function getHospitalBillPayment($caseno){
        $result=$this->db->query("SELECT SUM(amount) as amount FROM collection WHERE acctno='$caseno' AND (`description` LIKE '%HOSPITAL BILL%' )");
        return $result->row_array();
    }
    public function getExcessPayment($caseno,$accttitle){
        $result=$this->db->query("SELECT SUM(amount+discount) as amount FROM collection WHERE acctno='$caseno' AND accttitle='$accttitle' GROUP BY accttitle");
        return $result->row_array();
    }
    public function getHMOAssistancePF($caseno){
        $result=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%PROFESSIONAL FEE%' AND excess > 0 AND (producttype NOT LIKE '%IPD admitting%' AND producttype NOT LIKE '%IPD apnurse%' AND producttype NOT LIKE '%READERS FEE%' AND producttype <> '' )");
        return $result->result_array();
    }
    public function getPFPayment($caseno,$description){
        $result=$this->db->query("SELECT SUM(amount) as amount FROM collection WHERE acctno='$caseno' AND description LIKE '%$description%'");
        return $result->row_array();
    }
    public function getAccttitle(){
        $result=$this->db->query("SELECT accttitle FROM accttitle WHERE accttitle LIKE '%AR %'");
        return $result->result_array();
    }
    public function save_assistance(){
        $caseno=$this->input->post('caseno');
        $amount=$this->input->post('amount');
        $balance=$this->input->post('balance');
        $hmohosp=$this->input->post('hmohosp');
        if($amount > $balance){
            $amount=$balance;
        }
        $nursename=$this->session->fullname;
        $cd=explode('-',$caseno);
        if($cd[0]=="I"){
            $d="IPD";
        }else{
            $d="OPD";
        }
        if($this->session->dept=="BILLING"){
            $sql=$this->db->query("SELECT * FROM admission WHERE caseno='$caseno'");
            $gua=$sql->row_array();
            $guar=$gua['addemployer'];
            $emp=$this->db->query("SELECT * FROM nsauthemployees WHERE empid='$guar'");
            if($emp->num_rows()>0){
                $g=$emp->row_array();
                $guarantor=$guar."||".$g['name'];
            }else{
                $emp=$this->db->query("SELECT * FROM docfile WHERE code='$guar'");
                if($emp->num_rows()>0){
                    $g=$emp->row_array();
                    $guarantor=$guar."||".$g['name'];
                }else{                
                    $guarantor="";
                }
            }
        }else{
            $guarantor="";
        }
        $date=date('M-d-Y');
        $datearray=date('Y-m-d');
        $check=$this->db->query("SELECT * FROM collection WHERE acctno='$caseno' AND accttitle='$hmohosp'");
        if($check->num_rows()>0){
            return false;
        }else{
            if($cd[0]=="AR"){
                $beginamount=$amount;
                $query=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND excess > 0 AND `status`='Approved' AND productsubtype NOT LIKE '%PROFESSIONAL FEE%' AND trantype='charge' AND quantity > 0 ORDER BY excess ASC");
                if($query->num_rows()>0){
                    $items=$query->result_array();
                    foreach($items as $item){
                        $refno=$item['refno'];
                        $gross=$item['excess'];
                        $hmo=$item['hmo'];                    
                        if($beginamount > 0 && $gross > 0){
                            if($beginamount >= $gross){
                                $gross=$gross+$hmo;
                                $excess=0;
                                $this->db->query("UPDATE productout SET hmo='$gross',excess='$excess' WHERE refno='$refno'");
                                $beginamount=$beginamount-$gross;
                            }else{
                                $gross=$beginamount+$hmo;
                                $excess=$item['gross']-$gross;
                                $this->db->query("UPDATE productout SET hmo='$gross',excess='$excess' WHERE refno='$refno'");
                                $beginamount=0;
                            }
                        }
                    }
                }
            }
            $patient=$this->Hmo_model->getPatient($caseno);
            $patientname=$patient['patientname'];
            $timearray=date('H:i:s');
            $refno=$this->General_model->generateRefNo('RNQ',$nursename);
            $post=$this->db->query("INSERT INTO `collection`(refno,acctno,acctname,ofr,`description`,accttitle,amount,discount,`date`,Dept,username,shift,`type`,paymentTime,paidBy,datearray,branch) VALUES('$refno','$caseno','$patientname','','HOSPITAL BILL','$hmohosp','$amount','0.00','$date','$d','$nursename','$guarantor','pending','$timearray','','$datearray','KMSCI')");
            if($post){
                $this->db->query("INSERT INTO acctgenledge(refno,acctitle,transaction,amount,date,caseno,status) VALUES('$refno','$hmohosp','debit','$amount','$date','$caseno','pending')");
                return true;
            }else{
                return false;
            }
        }
    }
    public function save_assistance_pf($code,$amount,$hmo,$caseno){        
        $nursename=$this->session->fullname;
        $cd=explode('-',$caseno);
        if($cd[0]=="I"){
            $d="IPD";
        }else{
            $d="OPD";
        }
        $date=date('M-d-Y');
        $datearray=date('Y-m-d');
        $nursename=$this->session->fullname;
        $patient=$this->Hmo_model->getPatient($caseno);
        $patientname=$patient['patientname'];
        $items=$this->db->query("SELECT * FROM productout WHERE refno='$code'");
        $item=$items->row_array();
        if($amount>0){
            $refno=$this->General_model->generateRefNo('RNQ',$nursename);
            $acctno=$caseno;
            $acctname=$patientname;
            $description=$item['productdesc'];
            $accttitle="PROFESSIONAL FEE";
            if($hmo=="PROFESSIONAL FEE"){
                $hmopf1=$hmo;
            }else{
                $hmopf1 = $hmo." PF";
            }
            $discount="0.00";
            $save=$this->db->query("INSERT INTO `collection`(refno,acctno,acctname,ofr,`description`,accttitle,amount,discount,`date`,Dept,username,shift,`type`,paymentTime,paidBy,datearray,branch) VALUES('$refno','$acctno','$acctname','','$description','$hmopf1','$amount','$discount','$date','$d','$nursename','0','pending','','','$datearray','KMSCI')");
            if($save){
                $this->db->query("INSERT INTO acctgenledge(refno,acctitle,transaction,amount,date,caseno,status) VALUES('$refno','$hmopf1','debit','$amount','$date','$caseno','pending')");
                return true;
            }else{
                return false;
            }            
        }
    }
    public function getAllocationHistory($caseno){
        $result=$this->db->query("SELECT refno,`description`,accttitle,SUM(amount) as amount,`type` FROM `collection` WHERE acctno='$caseno' AND accttitle NOT LIKE '%PHARMACY%' AND accttitle NOT LIKE '%SUPPLIES%' AND accttitle NOT LIKE '%MISC%' GROUP BY `description`,accttitle,amount");
        return $result->result_array();
    }
    public function getExcessHistory($caseno){
        $result=$this->db->query("SELECT refno,`description`,accttitle,SUM(amount) as amount,`type` FROM `collection` WHERE acctno='$caseno' AND refno LIKE '%PE%'  GROUP BY refno");
        return $result->result_array();
    }
    public function remove_assistance($refno,$caseno){
        $qry=$this->db->query("SELECT * FROM collection WHERE refno='$refno'");
        $q=$qry->row_array();
        $amount=$q['amount'];
        $beginamount=$amount;
        $query=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND hmo > 0 ORDER BY hmo ASC");
        $items=$query->result_array();
        foreach($items AS $item){
            $refno1=$item['refno'];
            $gross=$item['gross'];
            $hmo=$item['hmo'];
            $excess=$item['excess'];
            if($hmo > 0){
                if($beginamount > $hmo && $beginamount > 0){
                    $this->db->query("UPDATE productout SET hmo='0',excess='$gross' WHERE refno='$refno1'");
                    $beginamount -= $hmo;
                }else{
                    $rem=$hmo-$beginamount;
                    $gross=$gross-$rem;
                    $this->db->query("UPDATE productout SET hmo='$rem',excess='$gross' WHERE refno='$refno1'");
                    $beginamount=0;
                }                
            }
        }
        $result=$this->db->query("DELETE FROM `collection` WHERE refno='$refno'");
        if($result){
            $this->db->query("DELETE FROM acctgenledge WHERE refno='$refno'");
            return true;
        }else{
            return false;
        }
    }
    public function getAllPatientLimit(){
        $result=$this->db->query("SELECT * FROM patientprofile ORDER BY lastname ASC LIMIT 10");
        return $result->result_array();
    }
    public function getSinglePatient(){
        $description=$this->input->post('searchme');
        $result=$this->db->query("SELECT * FROM patientprofile WHERE CONCAT(lastname,' ',firstname) LIKE '%%$description%%' ORDER BY lastname ASC");
        return $result->result_array();
    }
    public function save_quotation(){
        $dept=$this->session->dept;
        $patientidno=$this->input->post('patientidno');
        $lastname=$this->input->post('lastname');
        $firstname=$this->input->post('firstname');
        $middlename=$this->input->post('middlename');
        $suffix=$this->input->post('suffix');
        $patientname=$lastname." ".$firstname." ".$suffix." ".$middlename;
        $dateofbirth=$this->input->post('birthdate');
        $birthdate=date('M-d-Y',strtotime($dateofbirth));
        $gender=$this->input->post('sex');
        $password=$this->input->post('password');
        $bday = new DateTime($dateofbirth); // Your date of birth
        $today = new Datetime(date('Y-m-d'));
        $diff = $today->diff($bday);
        $age=$diff->y;
        if($age >= 60){
          $senior="Y";
        }else{
          $senior="N";
        }
        $date=date('Y-m-d');
        $nursename=$this->session->fullname;
        $check=$this->db->query("SELECT name,empid FROM nsauth WHERE password='$password' AND station='$dept'");
        if($check->num_rows() > 0){
            $caseno=$this->General_model->generateCaseNo('Q',$nursename);
            if($patientidno==""){
                $patientidno=$this->General_model->generatePatientID('1',$nursename);
                $save=$this->db->query("INSERT INTO patientprofile(patientidno,lastname,firstname,middlename,suffix,age,sex,senior,dateofbirth,birthdate,patientname,`type`) VALUES('$patientidno','$lastname','$firstname','$middlename','$suffix','$age','$gender','$senior','$dateofbirth','$birthdate','$patientname','$date')");                
                $save=$this->db->query("INSERT INTO patientprofileaddinfo(patientidno,discounttype,discountid) VALUES('$patientidno','$senior','')");
                $save=$this->db->query("INSERT INTO quotation(patientidno,caseno,lastname,firstname,middlename,suffix,age,sex,senior,dateofbirth,admittingclerk,`status`,datearray) VALUES('$patientidno','$caseno','$lastname','$firstname','$middlename','$suffix','$age','$gender','$senior','$dateofbirth','$nursename','issued','$date')");
            }else{
                $save=$this->db->query("INSERT INTO quotation(patientidno,caseno,lastname,firstname,middlename,suffix,age,sex,senior,dateofbirth,admittingclerk,`status`,datearray) VALUES('$patientidno','$caseno','$lastname','$firstname','$middlename','$suffix','$age','$gender','$senior','$dateofbirth','$nursename','issued','$date')");
            }
            if($save){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }        
    }
    public function getAllQuotation(){
        $result=$this->db->query("SELECT * FROM quotation WHERE `status`='issued' ORDER BY id DESC");
        return $result->result_array();
    }
    public function getSingleQuotation($id){
        $result=$this->db->query("SELECT * FROM quotation WHERE id='$id'");
        return $result->row_array();
    }
    public function getAllQuotationDetails($caseno){
        $result=$this->db->query("SELECT * FROM quotationdetails WHERE caseno='$caseno'");
        return $result->result_array();
    }
    public function remove_quote_item($id){
        $result=$this->db->query("DELETE FROM quotationdetails WHERE id='$id'");
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public function checkQuotationType($caseno){
        $result=$this->db->query("SELECT r.unit,q.nursename FROM receiving r INNER JOIN quotationdetails q ON q.productcode=r.code WHERE q.caseno='$caseno' GROUP BY r.unit");
        return $result->result_array();
    }

    public function getAllAdmissionARHMO($addemployer,$startdate,$enddate){        
        $result=$this->db->query("SELECT CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,a.caseno,a.addemployer,a.hmo,a.dateadmit FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno LEFT JOIN company c ON c.companyname=a.addemployer WHERE a.dateadmit BETWEEN '$startdate' AND '$enddate' AND a.caseno LIKE '%AR-%' AND  a.addemployer='$addemployer' ORDER BY pp.lastname ASC");
        return $result->result_array();
    }

     public function getAllAdmissionAREmployee($startdate){        
        $result=$this->db->query("SELECT CONCAT(pp.lastname,', ',pp.firstname,' ',pp.middlename) as patientname,a.caseno,pp.age FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.dateadmit ='$startdate' AND a.caseno LIKE '%AR-%' AND a.addemployer='KMSCI' ORDER BY pp.lastname ASC");
        return $result->result_array();
    }

    public function getARAmount($caseno,$type){
        $result=$this->db->query("SELECT SUM(sellingprice*quantity) as amount FROM productout WHERE caseno='$caseno' AND productsubtype='$type' GROUP BY productsubtype");
        return $result->row_array();
    }

    public function getAllAdmissionHMO($startdate,$enddate,$station){
        $result=$this->db->query("SELECT CONCAT(p.lastname,', ',p.firstname,' ',p.middlename,' ',p.suffix) as patientname,a.caseno,a.hmo,a.middlenamed,a.room,a.caseno FROM patientprofile p INNER JOIN admission a ON a.patientidno=p.patientidno INNER JOIN room r ON r.room=a.room WHERE a.dateadmit BETWEEN '$startdate' AND '$enddate' AND a.caseno LIKE '%I-%' AND p.lastname NOT LIKE '%TESTRDU%' AND r.nursestation='$station' ORDER BY a.hmo ASC");
        return $result->result_array();
    }
    public function getAllArTrade($caseno){
        $result=$this->db->query("SELECT * FROM collection WHERE acctno='$caseno' AND (accttitle LIKE '%AR TRADE%' OR accttitle LIKE '%AR EMPLOYEE%' OR accttitle LIKE '%AR PERSONAL%' OR accttitle LIKE '%AR DOCTOR%') AND acctno NOT LIKE '%x%' AND `type`='pending' GROUP BY refno ORDER BY accttitle ASC");
        return $result->result_array();
    }
    public function getPFDiscount($caseno,$description){
        $result=$this->db->query("SELECT amount FROM collection WHERE acctno='$caseno' AND description='$description' AND refno LIKE '%LP%'");
        return $result->row_array();
    }
    public function getPFDiscountHistory($caseno){
        $result=$this->db->query("SELECT * FROM collection WHERE acctno='$caseno' AND refno LIKE '%LP%'");
        return $result->result_array();
    }
    public function save_pf_discount(){
        $refno=$this->input->post('refno');
        $caseno=$this->input->post('caseno');
        $amount=$this->input->post('amount');
        $accttitle=$this->input->post('accttitle');
        $nursename=$this->session->fullname;
        $x=0;        
        foreach($refno as $code){
            $coll=$this->db->query("SELECT * FROM collection WHERE refno='$code'");
            if($coll->num_rows()>0){
                $item=$coll->row_array();                
                    $acctno=$caseno;
                    $acctname=$item['acctname'];
                    $description=$item['description'];
                    $account=$accttitle[$x];
                    $tamount=$amount[$x];
                    $d=$item['Dept'];
                    $datearray=date('Y-m-d');
                    $date=date('M-d-Y');
                    $discount=$item['discount'];
                    if(strpos($item['accttitle'], ' PF') !== false){
                        $account = $account." PF";
                    }
                    if($tamount>0){
                    // $sqlCheck=$this->db->query("SELECT * FROM pfdiscount WHERE refno='$code' AND datearray='$datearray' AND accttitle='$account'");
                    // if($sqlCheck->num_rows()>0){
                    //     $check=$sqlCheck->row_array();
                    //     $oldamount=$check['amount'];
                    //     $newamount=$oldamount+$tamount;
                    //     $sqlDiscount=$this->db->query("UPDATE pfdiscount SET amount='$newamount' WHERE refno='$code'");
                    // }else{
                    //     $sqlDiscount=$this->db->query("INSERT INTO pfdiscount(refno,caseno,amount,accttitle,nursename,datearray) VALUES('$code','$caseno','$tamount','$account','$nursename','$datearray')");
                    // }  
                            //$patient=$this->Hmo_model->getPatient($caseno);
                            $patientname=$item['acctname'];
                            $timearray=date('H:i:s');
                            $refno=$this->General_model->generateRefNo('LP',$nursename);
                            $post=$this->db->query("INSERT INTO `collection`(refno,acctno,acctname,ofr,`description`,accttitle,amount,discount,`date`,Dept,username,shift,`type`,paymentTime,paidBy,datearray,branch) VALUES('$refno','$caseno','$patientname','','$description','$account','$tamount','$discount','$date','$d','$nursename','0','pending','$timearray','','$datearray','KMSCI')");
                            if($post){
                                $sqlDiscount=$this->db->query("INSERT INTO acctgenledge(refno,acctitle,transaction,amount,date,caseno,status) VALUES('$refno','$account','debit','$tamount','$date','$caseno','pending')");
                            }      
                    }  
            }
            $x++;
        }
        if($sqlDiscount){
            return true;        
        }else{
            return false;
        }
    }
    public function remove_pf_allocation($refno){
        $result=$this->db->query("DELETE FROM collection WHERE refno='$refno'");
        if($result){
            $this->db->query("DELETE FROM acctgenledge WHERE refno='$refno'");
            return true;
        }else{
            return false;
        }
    }
    public function getAllCharges($caseno){
        $result=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND (productsubtype='LABORATORY' OR productsubtype='XRAY' OR productsubtype='ULTRASOUND' OR productsubtype='CT SCAN' OR productsubtype='2D ECHO' OR productsubtype='MAMMOGRAPHY') AND terminalname='pending' AND `status`='Approved'");
        return $result->result_array();
    }
    public function delete_charges($refno,$caseno){
        $newcase=$caseno."_CANCELLED";
        $result=$this->db->query("UPDATE productout SET caseno='$newcase' WHERE refno='$refno'");
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function getAllWalkinHMO(){
        $rundate=$this->input->post('rundate');
        $result=$this->db->query("SELECT *,COUNT(caseno) as patient FROM admission WHERE caseno LIKE '%AR-%' AND dateadmit='$rundate' AND addemployer NOT LIKE '%AR %' AND addemployer NOT LIKE '' AND addemployer NOT LIKE '%\_%' GROUP BY addemployer");
        return $result->result_array();
    }
    public function getAllWalkinHMOReport(){
        $startdate=$this->input->post('startdate');
        $enddate=$this->input->post('enddate');
        $result=$this->db->query("SELECT *,COUNT(caseno) as patient FROM admission WHERE caseno LIKE '%AR-%' AND dateadmit BETWEEN '$startdate' AND '$enddate' AND addemployer NOT LIKE '%AR %' AND addemployer NOT LIKE '' AND addemployer NOT LIKE '%\_%' GROUP BY addemployer");
        return $result->result_array();
    }
    public function getAllAdmissionWalkinHMO($addemployer,$startdate,$enddate){        
        $result=$this->db->query("SELECT pp.lastname,pp.firstname,pp.middlename,pp.suffix,a.caseno,a.dateadmit FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.addemployer='$addemployer' AND dateadmit BETWEEN '$startdate' AND '$enddate'");
        return $result->result_array();
    }
    public function fetch_single_admission($caseno){
        $state=$this->db->query("SELECT a.*,pp.*,pa.discounttype,pa.discountid,d.name,dt.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN patientprofileaddinfo pa ON pa.patientidno=pp.patientidno LEFT JOIN docfile d ON d.code=a.ap LEFT JOIN dischargedtable dt ON dt.caseno=a.caseno WHERE a.caseno = '$caseno'");
        if($state->num_rows()>0){
            return $state->row_array();
        }
    }
    public function fetch_product($caseno,$type){
        if($type=="PHARMACY/MEDICINE" || $type=="PHARMACY/SUPPLIES"){
            $result=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%$type%' AND quantity > 0 AND `status`='Approved'");
        }else if($type=="PROFESSIONAL FEE"){
            $result=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%$type%' AND quantity > 0 AND `status`='Approved' AND producttype <>'IPD admitting'");
        }else{
            $result=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%$type%' AND quantity > 0 AND `status`='Approved'");
        }        
        return $result->result_array();
    }
    
    public function fetch_inpatient($description){
        $result=$this->db->query("SELECT pp.*,a.dateadmit,a.room,a.caseno,dt.datearray FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN dischargedtable dt ON dt.caseno=a.caseno WHERE CONCAT(pp.lastname,' ',pp.firstname) LIKE '%$description%' AND a.caseno LIKE '%I-%' ORDER BY dt.datearray DESC");
        return $result->result_array();
    }
    public function fetch_arcpatient($description){
        $result=$this->db->query("SELECT pp.*,a.dateadmit,a.room,a.caseno,dt.datearray FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN dischargedtable dt ON dt.caseno=a.caseno WHERE CONCAT(pp.lastname,' ',pp.firstname) LIKE '%$description%' AND a.caseno NOT LIKE '%I-%' ORDER BY a.dateadmit DESC LIMIT 50");
        return $result->result_array();
    }
    public function save_hmo_price(){
        $caseno=$this->input->post('caseno');
        $refno=$this->input->post('refno');
        $srp=$this->input->post('sellingprice');
        $discount=$this->input->post('discount');
        $hmo=$this->input->post('hmo');
        $gross=$srp-$discount;
        $excess=$gross-$hmo;
        $result=$this->db->query("UPDATE productout SET sellingprice='$srp',adjustment='$discount',gross='$gross',hmo='$hmo',excess='$excess' WHERE caseno='$caseno' AND refno='$refno'");
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public function delete_hmo_price($refno){
        $result=$this->db->query("UPDATE productout SET status='cancel',sellingprice='0',quantity='0',adjustment='0',gross='0',hmo='0',phic='0',excess='0' WHERE refno='$refno'");
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public function add_hmo_pf(){
        $caseno=$this->input->post('caseno');
        $doctor=$this->input->post('doctor');
        $pf=explode('_',$doctor);
        $pfcode=$pf[1];
        $pfname=$pf[0];
        $amount=$this->input->post('amount');
        $hmo=$this->input->post('hmo');
        $excess=$amount-$hmo;
        $timeadmit=date('H:i:s');        
        $date=date('Y-m-d');
        $dateadmit=date('M-d-Y');
        $admittingclerk=$this->session->fullname;
        $refno=$this->General_model->generateRefNo('RN',$admittingclerk);
        $result=$this->db->query("INSERT INTO productout(refno,invno,caseno,productcode,productdesc,sellingprice,quantity,adjustment,gross,trantype,phic,hmo,excess,`date`,status,loginuser,producttype,productsubtype,shift,location,datearray) VALUES('$refno','$timeadmit','$caseno','$pfcode','$pfname','$amount','1','0','$amount','charge','0.00','$hmo','$excess','$dateadmit','Approved','$admittingclerk','IPD attending','PROFESSIONAL FEE','KMSCI','0','$date')");
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public function fetchAllCharges($caseno){
        $result=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND (terminalname <> 'pending' OR (terminalname = 'pending' AND (productsubtype='PHYSICAL THERAPY' OR productsubtype = 'RDU SUPPLIES'))) AND quantity > 0 AND`status`='Approved'");
        return $result->result_array();
    }
    public function finalize(){
        $caseno=$this->input->post('caseno');
        $sql=$this->db->query("SELECT * FROM admission WHERE caseno='$caseno'");        
        $item=$sql->row_array();
        $patientidno=$item['patientidno'];
        $timeadmit=date('H:i:s');
        $user=$this->session->fullname;
        $datenow=date('Y-m-d');        
        $datedischarged=date('M-d-Y');
        $hmo=$item['hmo'];
        $ward=$item['ward'];
        if($hmo == "N/A" || $hmo==""){
            $check=$this->db->query("SELECT * FROM collection WHERE accttitle LIKE '%AR %' AND amount > 0 AND acctno='$caseno'");
            if($check->num_rows() > 0){
                $grant="ok";
            }else{
                $grant="not ok";
            }
        }else{
            $grant="ok";
        }

        if($grant=="ok"){
            $check=$this->db->query("SELECT * FROM arv_tbl_hmofinalize WHERE caseno='$caseno'");
            if($check->num_rows() > 0){
                $item=$check->row_array();
                $datedischarged=date('M-d-Y',strtotime($item['datearray']));
                $datenow=date('Y-m-d',strtotime($item['datearray']));
                $result=$this->db->query("UPDATE arv_tbl_hmofinalize SET date_updated='$datenow',time_updated='$timeadmit',update_by='$user',`status`='pending' WHERE caseno='$caseno'");
            }else{
                $result=$this->db->query("INSERT INTO arv_tbl_hmofinalize(caseno,datearray,timearray,user,status,date_updated,time_updated,update_by) VALUES('$caseno','$datenow','$timeadmit','$user','pending','$datenow','$timeadmit','$user')");
            }
            if($result){
                $this->db->query("UPDATE admission SET `status`='discharged',ward='discharged' WHERE caseno='$caseno'");
                $this->db->query("UPDATE productout SET `status`='cancel',sellingprice='0',quantity='0',gross='0',adjustment='0',phic='0',hmo='0',excess='0',terminalname='cancel' WHERE caseno='$caseno' AND batchno LIKE '%LXD-%' AND terminalname='pending' AND productsubtype <> 'PHYSICAL THERAPY'");            
                $this->db->query("UPDATE productout SET `status`='cancel',sellingprice='0',quantity='0',gross='0',adjustment='0',phic='0',hmo='0',excess='0',administration='cancel' WHERE caseno='$caseno' AND (batchno LIKE '%PHARMACY-%' OR batchno LIKE '%CSR2-%') AND administration='pending'");
                if($this->session->dept=="BILLING"){
                    $query=$this->db->query("SELECT * FROM patientprofile WHERE patientidno='$patientidno'");
                    $p=$query->row_array();
                    $patientname=$p['patientname'];
                    $this->db->query("INSERT INTO dischargedtable VALUES('$caseno','$patientname','$datedischarged','$timeadmit','UNDONE','UNDONE','U','0','0','0','U','UNDONE','0','0','0','1','0','UNDONE','0','$ward','$datenow','1','KMSCI')");
                }                
                return true;
            }else{
                return false;
            }
        }else{
            $this->session->set_flashdata('save_failed','Unable to finalize account! Guarantee Letter must be posted!');
            return false;            
        }
    }
    public function hmoreopen(){
        $caseno=$this->input->post('caseno');
        $check=$this->db->query("SELECT * FROM arv_tbl_hmofinalize WHERE caseno='$caseno' AND `status`='pending'");
        if($check->num_rows() > 0){
            $this->db->query("UPDATE admission SET `status`='Active',ward='out' WHERE caseno='$caseno'");
            $this->db->query("UPDATE arv_tbl_hmofinalize SET `status` = '' WHERE caseno='$caseno'");
            $this->db->query("DELETE FROM dischargedtable WHERE caseno='$caseno'");
            return true;
        }else{
            return false;
        }
    }
    public function getAllAdmissionARHMOBilling($rundate){        
        $result=$this->db->query("SELECT pp.lastname,pp.firstname,pp.middlename,pp.suffix,a.caseno,a.dateadmit,a.employerno,a.hmo,a.addemployer FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN arv_tbl_hmofinalize atm ON atm.caseno=a.caseno WHERE atm.datearray='$rundate' AND atm.status <> ''");
        return $result->result_array();
    }
    public function getAllAdmissionARHMOBillingBegin($rundate){  
        $type=$this->input->post('type');      
        if($type=="m"){
            $startdate=date('Y-m',strtotime($rundate))."-01";
            $enddate=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));        
        }else{
            $enddate=date('Y-m-d',strtotime('-1 day',strtotime($rundate)));
            $startdate=date('Y',strtotime($rundate))."-01-01";
        }            
        $result=$this->db->query("SELECT pp.lastname,pp.firstname,pp.middlename,pp.suffix,a.caseno,a.dateadmit,a.employerno,a.hmo,a.addemployer FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN arv_tbl_hmofinalize atm ON atm.caseno=a.caseno WHERE atm.datearray BETWEEN '$startdate' AND '$enddate' AND atm.status <> ''");
        return $result->result_array();
    }
    public function save_admission_hmo($caseno){
        $loa=$this->input->post('newloa');
        $check=$this->db->query("SELECT SUM(hmo) as amount FROM productout WHERE caseno='$caseno' AND quantity > 0 GROUP BY caseno");
        $item=$check->row_array();
        $hmo=$item['amount'];

        if($loa >= $hmo){
            $result=$this->db->query("UPDATE admission SET policyno='$loa' WHERE caseno='$caseno'");
            return true;
        }else{
            $this->session->set_flashdata('save_failed','Unable to update LOA limit! LOA limit is less than the hmo allocated amount!');
            return false;
        }
    }
    public function fetch_product_by_allocation($caseno,$hmo){
        $result=$this->db->query("SELECT po.* FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' AND a.hmo='$hmo' AND po.quantity > 0 AND po.status='Approved' AND (po.terminalname <> 'pending' OR po.administration <> 'pending')");
        return $result->result_array();
    }
    public function fetch_product_by_assistance($caseno,$hmo){
        $result=$this->db->query("SELECT c.* FROM collection c INNER JOIN admission a ON a.caseno=c.acctno WHERE a.caseno='$caseno' AND c.accttitle LIKE '%$hmo%' AND c.type='pending'");
        return $result->result_array();
    }
    public function getAllPriceList(){
        $type=$this->input->post('service');
        if($type=="LABORATORY"){
            $result=$this->db->query("SELECT r.itemname,p.opd,p.philhealth,r.code,r.SEMIPRIVATE,p.hmo FROM receiving r INNER JOIN productsmasterlist p ON p.code=r.code WHERE r.unit='LABORATORY' ORDER BY r.itemname ASC");
        }else if($type=="IMAGING"){
            $result=$this->db->query("SELECT r.itemname,p.opd,p.philhealth,p.hmo,r.code FROM receiving r INNER JOIN productsmasterlist p ON p.code=r.code WHERE (r.unit='XRAY' OR r.unit='ECG' OR r.unit='EEG' OR r.unit='CT SCAN' OR r.unit='ULTRASOUND') ORDER BY r.itemname ASC");
        }else{
            $result=$this->db->query("SELECT r.itemname,p.opd,p.philhealth,p.hmo,r.code FROM receiving r INNER JOIN productsmasterlist p ON p.code=r.code WHERE (r.unit='HEARTSTATION' OR  r.unit = '2D ECHO' OR r.unit='PHYSICAL THERAPY' OR r.unit='RESPIRATORY') ORDER BY r.itemname ASC");
        }
        return $result->result_array();

    }
    public function post_excess(){
        $caseno=$this->input->post('caseno');
        $accttitle=$this->input->post('producttype');
        $amount=$this->input->post('amount');
        $datearray=date('Y-m-d');
        $date=date('M-d-Y');
        $discount=0;
        $user=$this->session->fullname;
        $checkSenior=$this->db->query("SELECT pp.*,pa.discounttype FROM patientprofile pp LEFT JOIN patientprofileaddinfo pa ON pa.patientidno=pp.patientidno INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$caseno'");
        $senior=$checkSenior->row_array();
        if($senior['senior']=="Y" || $senior['discounttype']=="PWD" || $senior['discounttype']=="SENIOR"){
            $discount=$amount*.2;
            $amount=$amount-$discount;            
        }
        if($amount > 0){
            $refno=$this->General_model->generateRefNo('PE',$user);
            $result=$this->db->query("INSERT INTO collection(refno,acctno,acctname,ofr,description,accttitle,amount,discount,`date`,Dept,username,shift,`type`,paymentTime,paidBy,datearray,branch,batchno) VALUE('$refno','$caseno','$senior[patientname]','','$accttitle','$accttitle','$amount','$discount','$date','out','$user','','pending','','','$datearray','','')");
            return true;
        }else{
            return false;
        }

    }
    public function remove_excess($refno,$caseno){
        $result=$this->db->query("DELETE FROM collection WHERE refno='$refno'");
        if($result){
            return true;
        }else{
            return false;
        }
    }
	public function getAccounttitleSOA(){
		$result=$this->db->query("SELECT * FROM soahmo ORDER BY hmo ASC");
		return $result->result_array();
	}
	public function getAccounttitleSOADetails($id){
		$result=$this->db->query("SELECT * FROM soahmodetails WHERE accounttitle_id='$id' ORDER BY accounttitle ASC");
		return $result->result_array();
	}
	public function add_soa_hmo(){
		$accounttitle=$this->input->post('accounttitle');
		$hmo=$this->input->post('hmo');
		$check=$this->db->query("SELECT * FROM soahmo WHERE accounttitle='$accounttitle' AND hmo='$hmo'");
		if($check->num_rows()>0){
			return false;
		}else{
			$result=$this->db->query("INSERT INTO soahmo(accounttitle,hmo) VALUES('$accounttitle','$hmo')");					
			return true;
		}
	}
	public function update_soa_hmo(){
		$id=$this->input->post('id');
		$accounttitle=$this->input->post('accounttitle');
		$hmo=$this->input->post('hmo');
		$check=$this->db->query("SELECT * FROM soahmo WHERE accounttitle='$accounttitle' AND hmo='$hmo' AND id <> '$id'");
		if($check->num_rows()>0){
			return false;
		}else{
			$result=$this->db->query("UPDATE soahmo SET accounttitle='$accounttitle',hmo='$hmo' WHERE id='$id'");
			return true;
		}
	}
	public function delete_soa_hmo($id){
		$result=$this->db->query("DELETE FROM soahmo WHERE id='$id'");
		if($result){
			$this->db->query("DELETE FROM soahmodetails WHERE accounttitle_id='$id'");
			return true;
		}else{
			return false;
		}
	}

	public function add_soa_hmo_details(){
		$account_id=$this->input->post('accounttitle_id');
		$accounttitle=$this->input->post('accounttitle');
		$check=$this->db->query("SELECT * FROM soahmodetails WHERE accounttitle='$accounttitle' AND accounttitle_id='$account_id'");
		if($check->num_rows()>0){
			return false;
		}else{
			$result=$this->db->query("INSERT INTO soahmodetails(accounttitle_id,accounttitle) VALUES('$account_id','$accounttitle')");					
			return true;
		}
	}
	public function update_soa_hmo_details(){
		$id=$this->input->post('id');
		$account_id=$this->input->post('accounttitle_id');
		$accounttitle=$this->input->post('accounttitle');
		$check=$this->db->query("SELECT * FROM soahmodetails WHERE accounttitle='$accounttitle' AND accounttitle_id='$account_id' AND id <> '$id'");
		if($check->num_rows()>0){
			return false;
		}else{
			$result=$this->db->query("UPDATE soahmodetails SET accounttitle='$accounttitle' WHERE id='$id'");
			return true;
		}
	}
	public function delete_soa_hmo_details($id){
		$result=$this->db->query("DELETE FROM soahmodetails WHERE id='$id'");
		if($result){			
			return true;
		}else{
			return false;
		}
	}
    public function getAllHMO(){
        $result=$this->db->query("SELECT * FROM company WHERE type='hmo' ORDER BY companyname ASC");
        return $result->result_array();
    }
    public function getAccountTitle($id){
        $result=$this->db->query("SELECT * FROM soahmo WHERE id='$id'");
        return $result->row_array();
    }
    public function getAccttitleByUnit(){
        $result=$this->db->query("SELECT * FROM receiving GROUP BY unit ORDER BY unit ASC");
        return $result->result_array();
    }
    public function getAllActiveARPatient(){
        $result=$this->db->query("SELECT pp.*,a.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno LIKE 'AR-%' AND (a.status = 'Active' OR a.ward='out') AND a.dateadmit > '2023-10-01' AND a.addemployer NOT LIKE '%MMSHI%' AND a.addemployer NOT LIKE '%CMSHI%' AND a.addemployer NOT LIKE '%AMSHI%' AND a.addemployer NOT LIKE '%MMHI%' AND a.addemployer NOT LIKE '%KMSCI%' AND a.addemployer NOT LIKE '%1%' AND a.addemployer NOT LIKE '%2%' AND a.addemployer NOT LIKE '%3%' AND a.addemployer NOT LIKE '%4%' ORDER BY a.dateadmit DESC");
        return $result->result_array();
    }
    public function getAllLabResult($caseno){
        $result=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' AND (productsubtype = 'LABORATORY' OR productsubtype = 'XRAY' OR productsubtype = 'ULTRASOUND' OR productsubtype = 'CT SCAN' OR productsubtype = 'EEG' OR productsubtype = 'ECG' OR productsubtype = '2D ECHO' OR productsubtype = 'HEARTSTATION')");
        return $result->result_array();
    }
}
?>
