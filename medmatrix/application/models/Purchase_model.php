<?php
date_default_timezone_set('Asia/Manila');
class Purchase_model extends CI_model
{
	public function __construct()
	{
		$this->load->database();
	}
	public function getAllMedicine(){
		$dept=$this->session->dept;
		//$this->db->like('unit','PHARMACY/MEDICINE');
		$result=$this->db->query("SELECT r.* FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE s.dept='$dept' AND r.unit LIKE '%PHARMACY/MEDICINE%' GROUP BY s.code");
		return $result->result_array();
	}
	public function getAllSupplies(){
		// $this->db->like('unit','SUPPLIES');
		// $result=$this->db->get('receiving');
		$dept=$this->session->dept;		
		$result=$this->db->query("SELECT r.* FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE s.dept='$dept' AND r.unit LIKE '%SUPPLIES%' GROUP BY s.code");
		return $result->result_array();
	}
	public function getAllDiagnostics(){
		$result=$this->db->query("SELECT * FROM receiving WHERE unit='XRAY' OR unit='ULTRASOUND' OR unit='RESPIRATORY' OR unit='PULMONARY' OR unit='PHYSICAL THERAPY' OR unit='LABORATORY' OR unit='ECG' OR unit='EEG' OR unit='CT SCAN'");
		return $result->result_array();
	}
	public function getAllSuppliers(){
//		$this->db->like('status','ACTIVE');
//		$result=$this->db->get('supplierscsr');
		$result=$this->db->query("SELECT * FROM supplierscsr WHERE `status`='ACTIVE' ORDER BY suppliername ASC");
		return $result->result_array();
	}
	public function getAllPO(){		
		$result=$this->db->query("SELECT * FROM purchaseorder WHERE `status` = 'pending' AND dept ='".$this->session->dept."' AND po <> '' GROUP BY po ORDER BY reqdate DESC");
		return $result->result_array();
	}
	public function getItemsPO($param){
		$result=$this->db->query("SELECT po.*,sq.*,r.generic FROM purchaseorder po LEFT JOIN savequantity sq ON sq.rrdetails=po.rrdetails INNER JOIN receiving r ON r.code=po.code WHERE po.reqno='$param' AND po.status='pending'");
		return $result->result_array();
	}
	public function getItemsPOMonitoring($param){
		$result=$this->db->query("SELECT po.*,sq.*,r.generic,r.itemname FROM purchaseorder po INNER JOIN savequantity sq ON sq.rrdetails=po.rrdetails INNER JOIN receiving r ON r.code=po.code WHERE po.reqno='$param' AND po.status='pending' GROUP BY code ORDER BY reqdate DESC");
		return $result->result_array();
	}
	public function getAllItemsByDept($dept){
		$result=$this->db->query("SELECT r.code,r.itemname,r.generic FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE s.dept='$dept' AND s.datearray >= '2021-07-01' GROUP BY s.code ORDER BY r.itemname ASC");
		return $result->result_array();
	}
	public function getAllItemsByDeptType($dept,$type){
		$result=$this->db->query("SELECT r.code,r.itemname,r.generic FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE s.dept='$dept' AND s.datearray >= '2021-07-01' AND r.unit='$type' GROUP BY s.code ORDER BY r.itemname ASC");
		return $result->result_array();
	}
	public function fetch_single_requested_item($code){
		$st=$this->session->dept;
		$result=$this->db->query("SELECT * FROM stocktablepayables WHERE code='$code' ORDER BY datearray DESC LIMIT 1");
		if($result->num_rows()>0){
			$uc=$result->row_array();
			$unitcost=$uc['unitcost'];
			$lotno=$uc['lotno'];
			$expiration=$uc['expiration'];
		}else{
			$result=$this->db->query("SELECT * FROM stocktable WHERE code='$code' AND dept='$st' AND (trantype='charge' OR trantype='cash') ORDER BY datearray DESC LIMIT 1");
			if($result->num_rows()>0){
				$uc=$result->row_array();
				$unitcost=$uc['unitcost'];
				$lotno=$uc['lotno'];
				$expiration=$uc['expiration'];
			}else{
				$uc=0;
				$unitcost=$uc;
				$lotno="";
				$expiration="";
			}
		}
		$result=$this->db->query("SELECT prodtype1 FROM stocktablepayables WHERE code='$code' ORDER BY datearray DESC LIMIT 1");
		if($result->num_rows()>0){
			$disc=$result->row_array();
			$discount=$disc['prodtype1'];
		}else{
			$discount=0;
		}

		$result=$this->db->query("SELECT SUM(s.quantity) as quantity,r.description FROM stocktable s INNER JOIN receiving r ON r.code=s.code WHERE r.code='$code' AND s.dept='$st' AND s.datearray >= '2021-07-01' GROUP BY s.code");
		$qty=$result->row_array();
		$quantity=$qty['quantity'];
		$description=$qty['description'];

		$reqitem = array(
			'description' => $description,
			'quantity' => $quantity,
			'unitcost' => $unitcost,
			'discount' => $discount,
			'lotno'    => $lotno,
			'expiration' => $expiration
		);

		return $reqitem;
	}

	public function request_add_item(){
		$st=$this->session->dept;
		$pono=$this->session->pono;
		$supplier=explode('_',$this->session->supplier);
		$suppliercode=$supplier[0];
		$suppliername=$supplier[1];
		$terms=$this->session->terms;
		$transdate=$this->session->reqdate;
		$trantype=$this->session->trantype;
		$reqdept=$this->session->reqdept;
		$description=$this->input->post('description');
		$code=$this->input->post('code');
		$unitcost=$this->input->post('unitcost');
		$discount=$this->input->post('discount');
		$unit=$this->input->post('unit');
		$tdate=date('M-d-Y',strtotime($transdate));
		$quantity=$this->input->post('quantity');
		$qty=$this->input->post('qty');
		$nursename=$this->session->fullname;
		$checkExist=$this->db->query("SELECT * FROM purchaseorder WHERE po='".$pono."' AND code='".$code."' AND `status`='pending'");
		if($checkExist->num_rows()>0){
			$exist=$checkExist->row_array();
			$oldqty=$exist['prodqty'];
			$newqty=$oldqty+$quantity;
			$result=$this->db->query("UPDATE purchaseorder SET prodqty='".$newqty."' WHERE po='".$pono."' AND code='".$code."'");
			return $result;
		}else{
			$result=$this->db->query("INSERT INTO purchaseorder(rrno,transdate,supplier,suppliercode,terms,trantype,code,`description`,unitcost,generic,prodqty,dept,`status`,prodtype1,po,user,approvingofficer,reqdept,reqno,reqdate,requser) VALUES('','$tdate','$suppliername','$suppliercode','$terms','$trantype','$code','$description','$unitcost','$transdate','$quantity','$st','pending','$discount','$pono','$nursename','','$reqdept','$pono','$transdate','')");
			$sqlUnit=$this->db->query("SELECT rrdetails FROM purchaseorder WHERE po='$pono' AND code='$code' ORDER BY rrdetails DESC LIMIT 1");
			$units=$sqlUnit->row_array();
			$result=$this->db->query("INSERT INTO savequantity(rrdetails,unit) VALUES('$units[rrdetails]','$unit')");
			return result;
		}
	}

	public function remove_requested_item($param){
		$result=$this->db->query("DELETE FROM savequantity WHERE rrdetails='$param'");
		if($result){
			$this->db->query("DELETE FROM purchaseorder WHERE rrdetails='$param'");
			return true;
		}else{
			return false;
		}
	}
	public function getSingleSupplier($code){
		$result=$this->db->query("SELECT * FROM supplierscsr WHERE suppliercode='$code'");
		return $result->row_array();
	}
	public function poprintbody($param){
		$result=$this->db->query("SELECT po.*,SUM(po.prodqty) as prodqty,sq.unit,r.generic,r.itemname FROM purchaseorder po INNER JOIN savequantity sq ON sq.rrdetails=po.rrdetails INNER JOIN receiving r ON r.code=po.code WHERE po.po='$param' AND po.`status` <> 'cancel' AND trantype <> 'FREE GOODS' GROUP BY po.code");
		return $result->result_array();
	}
	public function getQty($code,$dept){
		$result=$this->db->query("SELECT SUM(quantity) as soh FROM stocktable WHERE code='$code' AND dept='$dept' AND datearray >= '2021-07-01'");
		return $result->row_array();
	}
	public function getLastDate($code,$dept){
		$result=$this->db->query("SELECT * FROM stocktablepayables WHERE code='$code' AND dept='$dept' AND datearray >= '2021-07-01' GROUP BY code,datearray ORDER BY datearray DESC LIMIT 1");
		return $result->row_array();
	}
	public function getLastDateQuantity($code,$dept,$date){
		$result=$this->db->query("SELECT SUM(quantity) as quantity FROM stocktable WHERE code='$code' AND dept='$dept'  AND datearray >= '2021-07-01' AND datearray < '$date' GROUP BY code");
		return $result->row_array();
	}
	public function fetch_requested_item($param){
		$result=$this->db->query("SELECT po.*,sq.*,r.generic FROM purchaseorder po INNER JOIN savequantity sq ON sq.rrdetails=po.rrdetails INNER JOIN receiving r ON r.code=po.code WHERE po.rrdetails='$param'");
		return $result->result_array();
	}
	public function request_update_item(){
		$fullname=$this->session->fullname;
		$rrdetails=$this->input->post('rrdetails');
		$description=$this->input->post('description');
		$quantity=$this->input->post('quantity');
		$unitcost=$this->input->post('unitcost');
		$discount=$this->input->post('discount');
		$unit=$this->input->post('unit');
		$update=$this->db->query("UPDATE purchaseorder SET `description`='$description',unitcost='$unitcost',prodqty='$quantity',prodtype1='$discount',requser='$fullname' WHERE rrdetails='$rrdetails'");
		if($update){
			$this->db->query("UPDATE savequantity SET `unit`='$unit' WHERE rrdetails='$rrdetails'");
			return true;
		}else{
			return false;
		}
	}

	public function getInvoice($param){
		$result=$this->db->query("SELECT * FROM saveinvoice WHERE pono='$param'");
		return $result->row_array();
	}
	public function save_invoice($invno,$pono){
		$check=$this->db->query("SELECT * FROM saveinvoice WHERE pono='$pono'");
		if($check->num_rows()>0){
			$save=$this->db->query("UPDATE saveinvoice SET invno='$invno' WHERE pono='$pono'");
		}else{
			$save=$this->db->query("INSERT INTO saveinvoice(pono,invno) VALUES('$pono','$invno')");
		}
		if($save){
			return true;
		}else{
			return false;
		}
	}
	public function save_remarks($invno,$pono){
		$check=$this->db->query("SELECT * FROM saveinvoice WHERE pono='$pono'");
		if($check->num_rows()>0){
			$save=$this->db->query("UPDATE saveinvoice SET remarks='$invno' WHERE pono='$pono'");
		}else{
			$save=$this->db->query("INSERT INTO saveinvoice(pono,remarks) VALUES('$pono','$invno')");
		}
		if($save){
			return true;
		}else{
			return false;
		}
	}
	public function save_quantity($rrdetails,$recqty,$lotno,$vat,$expiration){
		return $this->db->query("UPDATE savequantity SET quantity='$recqty',lotno='$lotno',vat='$vat',expiration='$expiration' WHERE rrdetails='$rrdetails'");
	}
	public function checkInvoice($pono,$invno){
		$result=$this->db->query("SELECT * FROM saveinvoice WHERE pono <> '$pono' AND invno='$invno'");
		return $result->result_array();
	}
	public function getPODetailsHeader($pono,$invno){
		$result=$this->db->query("SELECT po.*,si.* FROM purchaseorder po INNER JOIN saveinvoice si ON si.pono=po.po WHERE si.invno='$invno' AND po.status='pending' GROUP BY po.po");
		return $result->row_array();
	}
	public function getPODetailsFooter($pono){
		$result=$this->db->query("SELECT po.reqdept,po.trantype,r.unit FROM purchaseorder po INNER JOIN savequantity sq ON sq.rrdetails=po.rrdetails INNER JOIN receiving r ON r.code=po.code WHERE po.po='$pono' AND sq.quantity > 0 GROUP BY po.trantype,r.unit");
		return $result->result_array();
	}
	public function getPODetailsFoot($pono,$trantype,$unit){
		$result=$this->db->query("SELECT po.*,sq.* FROM purchaseorder po INNER JOIN savequantity sq ON sq.rrdetails=po.rrdetails INNER JOIN receiving r ON r.code=po.code WHERE po.po='$pono' AND po.trantype='$trantype' AND r.unit='$unit' AND po.status='pending' GROUP BY po.rrdetails");
		return $result->result_array();
	}
	public function revertRefNo($seqname){
		$seqcode=date('Y');
		$check=$this->db->query("SELECT * FROM seqpatientid WHERE seq_name='$seqname' AND seq_code='$seqcode'");
		$item=$check->row_array();
		$old_value=$item['last_value'] - 1;
		$update=$this->db->query("UPDATE seqpatientid SET last_value='$old_value' WHERE seq_name='$seqname' AND seq_code='$seqcode'");
		return true;
	}
	public function post_receiving($rrno,$invno,$pono,$invdate){
		$chargeto=$this->input->post('chargeto');		
		$items = $this->Purchase_model->getItemsPO($pono);
		foreach($items as $item){
			if($item['quantity'] > 0){
				$rrdetails = $item['rrdetails'];
				$code=$item['code'];
				$description=$item['description'];
				$suppliercode=$item['suppliercode'];
				$suppliername=$item['supplier'];
				$terms=$item['terms'];
				$trantype=$item['trantype'];
				$unitcost=$item['unitcost'];
				$recqty=$item['quantity'];
				$reqqty=$item['prodqty'];
				$reqdept=$item['reqdept'];
				$dept=$item['dept'];
				$discount=$item['prodtype1'];
				$requser=$item['user'];
				$expiration=$item['expiration'];
				$lotno=$item['lotno'];
				$vat=$item['vat'];
				$unit=$item['unit'];
				$fullname=$this->session->fullname;
				$remqty=$reqqty - $recqty;
				$timearray=date('H:i:s');
				if($remqty > 0){
					$itemrem=$this->db->query("SELECT * FROM purchaseorder WHERE rrdetails = '$rrdetails'");
					$rem=$itemrem->row_array();
					$this->db->query("INSERT INTO purchaseorder(rrno,transdate,supplier,suppliercode,terms,trantype,code,`description`,unitcost,generic,prodqty,dept,`status`,prodtype1,po,user,approvingofficer,reqdept,reqno,reqdate,requser) VALUES('','$rem[transdate]','$rem[supplier]','$rem[suppliercode]','$rem[terms]','$rem[trantype]','$rem[code]','$rem[description]','$rem[unitcost]','$rem[generic]','$remqty','$rem[dept]','pending','$rem[prodtype1]','$rem[po]','$rem[user]','','$rem[reqdept]','$rem[po]','$rem[reqdate]','')");
					$this->db->query("UPDATE purchaseorder SET rrno='$rrno',prodqty='$recqty',`status`='poreceived' WHERE rrdetails='$rrdetails'");
					$newitem=$this->db->query("SELECT rrdetails FROM purchaseorder WHERE po='$pono' ORDER BY rrdetails DESC LIMIT 1");
					$new=$newitem->row_array();
					$this->db->query("INSERT INTO savequantity(rrdetails,quantity,lotno,vat,unit,expiration) VALUES('$new[rrdetails]','0','','0','$unit','')");					
				}else{
					$this->db->query("UPDATE purchaseorder SET rrno='$rrno',`status`='poreceived' WHERE rrdetails='$rrdetails'");
				}
				$datearray=date('Y-m-d');
				//$timearray=date('H:i:s');
				$transactdate=date('M-d-Y',strtotime($invdate));
				$duedate=date('Y-m-d',strtotime($terms.' days',strtotime($datearray)));
				$this->db->query("UPDATE receiving SET unitcost='$unitcost',capital='$unitcost' WHERE `code`='$code'");
				if($chargeto <> ""){
					$dept=$chargeto;
				}
				$query="INSERT INTO stocktablepayables(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray) VALUES('$transactdate','$rrno','$pono','$invno','$suppliercode','$suppliername','$code','$description','$unitcost','$recqty','$recqty','','$recqty','$expiration','$lotno','$trantype','$terms','$transactdate','$dept','$discount','$trantype','$rrdetails','$fullname','0','$vat','$duedate','$datearray')";
				$stocktablepayables=$this->db->query($query);
				if($stocktablepayables && $chargeto==""){
					$stocktablepayables=$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$transactdate','$rrno','$pono','$invno','$suppliercode','$suppliername','$code','$description','$unitcost','$recqty','$recqty','','$recqty','$expiration','$lotno','$trantype','$terms','$transactdate','$dept','$discount','$trantype','$rrdetails','$fullname','0','u','$duedate','$datearray','$timearray')");
				}
			}
		}
		if($stocktablepayables){
			return true;
		}else{
			return false;
		}
	}

	public function getRRHead($invno,$rrno){
		$result=$this->db->query("SELECT po,datearray,dept,suppliername FROM stocktablepayables WHERE invno='$invno' AND rrno='$rrno' GROUP BY rrno");
		return $result->row_array();
	}
	public function getRRDetails($invno,$rrno){
		$result=$this->db->query("SELECT r.description,r.generic,sq.unit,sp.quantity,sp.unitcost,sp.prodtype1,sp.stockalert as vat,sp.trantype,sp.dept FROM stocktablepayables sp INNER JOIN receiving r ON r.code=sp.code INNER JOIN savequantity sq ON sq.rrdetails=sp.isid WHERE sp.invno='$invno' AND sp.rrno='$rrno'");
		return $result->result_array();
	}

	public function getRRDetailsFooter($invno,$rrno){
		$result=$this->db->query("SELECT sp.dept,sp.trantype,r.unit FROM stocktablepayables sp INNER JOIN receiving r ON r.code=sp.code WHERE sp.invno='$invno' AND sp.rrno='$rrno' GROUP BY sp.trantype,r.unit");
		return $result->result_array();
	}
	public function getRRDetailsFoot($invno,$rrno,$trantype,$unit){
		$result=$this->db->query("SELECT sp.* FROM stocktablepayables sp INNER JOIN receiving r ON r.code=sp.code WHERE sp.invno='$invno' AND sp.rrno='$rrno' AND sp.trantype='$trantype' AND r.unit='$unit' GROUP BY sp.autono");
		return $result->result_array();
	}
	public function fetch_rr_supplier($pono){
		$result=$this->db->query("SELECT supplier,suppliercode FROM purchaseorder WHERE po='$pono' GROUP BY po");
		return $result->result_array();
	}
	public function change_supplier(){
		$pono=$this->input->post('pono');
		$supplier=explode('_',$this->input->post('supplier'));
		$suppliercode=$supplier[0];
		$suppliername=$supplier[1];
		$result=$this->db->query("UPDATE purchaseorder SET suppliercode='$suppliercode',supplier='$suppliername' WHERE po='$pono' AND `status`='pending'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function add_free_goods(){
		$nursename=$this->session->fullname;
		$code=$this->input->post('code');
		$pono=$this->input->post('pono');
		$description=$this->input->post('description');
		$quantity=$this->input->post('quantity');
		$unitcost=$this->input->post('unitcost');
		$discount=$this->input->post('discount');
		$unit=$this->input->post('unit');
		$items=$this->db->query("SELECT * FROM purchaseorder WHERE rrdetails='$code'");
		$item=$items->row_array();
		$result=$this->db->query("INSERT INTO purchaseorder(rrno,transdate,supplier,suppliercode,terms,trantype,code,`description`,unitcost,generic,prodqty,dept,`status`,prodtype1,po,user,approvingofficer,reqdept,reqno,reqdate,requser) VALUES('','$item[transdate]','$item[supplier]','$item[suppliercode]','$item[terms]','FREE GOODS','$item[code]','$description','$unitcost','$item[generic]','$quantity','$item[dept]','pending','$discount','$pono','$nursename','','$item[reqdept]','$pono','$item[reqdate]','')");
		$sqlUnit=$this->db->query("SELECT rrdetails FROM purchaseorder WHERE po='$pono' AND code='$item[code]' ORDER BY rrdetails DESC LIMIT 1");
		$units=$sqlUnit->row_array();
		$result=$this->db->query("INSERT INTO savequantity(rrdetails,unit) VALUES('$units[rrdetails]','$unit')");
		return $result;
	}
	public function add_batch(){
		$nursename=$this->session->fullname;
		$code=$this->input->post('code');
		$pono=$this->input->post('pono');
		$description=$this->input->post('description');
		$quantity=$this->input->post('quantity');
		$unitcost=$this->input->post('unitcost');
		$discount=$this->input->post('discount');
		$unit=$this->input->post('unit');
		$items=$this->db->query("SELECT * FROM purchaseorder WHERE rrdetails='$code'");
		$item=$items->row_array();
		$result=$this->db->query("INSERT INTO purchaseorder(rrno,transdate,supplier,suppliercode,terms,trantype,code,`description`,unitcost,generic,prodqty,dept,`status`,prodtype1,po,user,approvingofficer,reqdept,reqno,reqdate,requser) VALUES('','$item[transdate]','$item[supplier]','$item[suppliercode]','$item[terms]','$item[trantype]','$item[code]','$description','$unitcost','$item[generic]','$quantity','$item[dept]','pending','$discount','$pono','$nursename','','$item[reqdept]','$pono','$item[reqdate]','')");
		$sqlUnit=$this->db->query("SELECT rrdetails FROM purchaseorder WHERE po='$pono' AND code='$item[code]' ORDER BY rrdetails DESC LIMIT 1");
		$units=$sqlUnit->row_array();
		$result=$this->db->query("INSERT INTO savequantity(rrdetails,unit) VALUES('$units[rrdetails]','$unit')");
		return $result;
	}

	public function getAllManualPO(){
		$result=$this->db->query("SELECT * FROM stocktablepreview WHERE dept ='".$this->session->dept."' AND invno <> '' GROUP BY invno ORDER BY datearray DESC");
		return $result->result_array();
	}
	public function getItemsManualPO($param){
		$result=$this->db->query("SELECT po.*,sq.* FROM stocktablepreview po INNER JOIN savequantity sq ON sq.rrdetails=po.isid WHERE po.invno='$param'");
		return $result->result_array();
	}
	public function manual_add_item(){
		$st=$this->session->dept;
		$invno=$this->session->invno;
		$supplier=explode('_',$this->session->supplier);
		$suppliercode=$supplier[0];
		$suppliername=$supplier[1];
		$terms=$this->session->terms;
		$transdate=$this->session->transdate;
		$invdate=$this->session->invdate;
		$trantype=$this->session->trantype;
		$reqdept=$this->session->reqdept;
		$description=$this->input->post('description');
		$code=$this->input->post('code');
		$unitcost=$this->input->post('unitcost');
		$discount=$this->input->post('discount');
		$unit=$this->input->post('unit');
		$tdate=date('M-d-Y',strtotime($transdate));
		$quantity=$this->input->post('quantity');
		$qty=$this->input->post('qty');
		$expiration=$this->input->post('expiration');
		$vat=$this->input->post('vat');
		$tdate=date('M-d-Y',strtotime($invdate));
		$nursename=$this->session->fullname;
		if($vat=="Yes"){
			$tax=$unitcost-($unitcost/1.12);
		}else{
			$tax=0;
		}
		$checkExist=$this->db->query("SELECT * FROM stocktablepreview WHERE invno='".$invno."' AND code='".$code."'");
		if($checkExist->num_rows()>0){
			$exist=$checkExist->row_array();
			$oldqty=$exist['quantity'];
			$newqty=$oldqty+$quantity;
			$result=$this->db->query("UPDATE stocktablepreview SET quantity='".$newqty."' WHERE invno='".$invno."' AND code='".$code."'");
			return $result;
		}else{
			$isid=date('YmdHis');
			$result=$this->db->query("INSERT INTO stocktablepreview(date,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray) VALUES('$tdate','','','$invno','$suppliercode','$suppliername','$code','$description','$unitcost','$quantity','0','','$quantity','$expiration','','$trantype','$terms','$transdate','$reqdept','$discount','NONE','$isid','$nursename','e','$tax','','$invdate')");
			$result=$this->db->query("INSERT INTO savequantity(rrdetails,unit,quantity,vat,expiration) VALUES('$isid','$unit','$quantity','$tax','$expiration')");
			return result;
		}
	}
	public function remove_manual_item($param){
		$result=$this->db->query("DELETE FROM savequantity WHERE rrdetails='$param'");
		if($result){
			$this->db->query("DELETE FROM stocktablepreview WHERE isid='$param'");
			return true;
		}else{
			return false;
		}
	}
	public function fetch_manual_item($param){
		$result=$this->db->query("SELECT po.*,sq.* FROM stocktablepreview po INNER JOIN savequantity sq ON sq.rrdetails=po.isid WHERE po.isid='$param'");
		return $result->result_array();
	}
	public function request_manual_item(){
		$fullname=$this->session->fullname;
		$rrdetails=$this->input->post('isid');
		$description=$this->input->post('description');
		$quantity=$this->input->post('quantity');
		$unitcost=$this->input->post('unitcost');
		$discount=$this->input->post('discount');
		$expiration=$this->input->post('expiration');
		$vat=$this->input->post('vat');
		$unit=$this->input->post('unit');
		$update=$this->db->query("UPDATE stocktablepreview SET `description`='$description',unitcost='$unitcost',quantity='$quantity',prodtype1='$discount',receivinguser='$fullname',expiration='$expiration',stockalert='$vat' WHERE isid='$rrdetails'");
		if($update){
			$this->db->query("UPDATE savequantity SET `unit`='$unit',quantity='$quantity',expiration='$expiration',vat='$vat' WHERE rrdetails='$rrdetails'");
			return true;
		}else{
			return false;
		}
	}
	public function getManualPODetailsHeader($invno){
		$result=$this->db->query("SELECT po.* FROM stocktablepreview po WHERE po.invno='$invno' GROUP BY po.invno");
		return $result->row_array();
	}
	public function getManualPODetailsFooter($pono){
		$result=$this->db->query("SELECT po.dept as reqdept,po.trantype,r.unit FROM stocktablepreview po INNER JOIN savequantity sq ON sq.rrdetails=po.isid INNER JOIN receiving r ON r.code=po.code WHERE po.invno='$pono' AND sq.quantity > 0 GROUP BY po.trantype,r.unit");
		return $result->result_array();
	}
	public function getManualPODetailsFoot($pono,$trantype,$unit){
		$result=$this->db->query("SELECT po.*,sq.* FROM stocktablepreview po INNER JOIN savequantity sq ON sq.rrdetails=po.isid INNER JOIN receiving r ON r.code=po.code WHERE po.invno='$pono' AND po.trantype='$trantype' AND r.unit='$unit' GROUP BY po.isid");
		return $result->result_array();
	}
	public function post_manual_receiving($rrno,$invno){
		$items = $this->Purchase_model->getItemsManualPO($invno);
		foreach($items as $item){
			if($item['quantity'] > 0){
				$rrdetails = $item['isid'];
				$code=$item['code'];
				$description=$item['description'];
				$suppliercode=$item['suppliercode'];
				$suppliername=$item['suppliername'];
				$terms=$item['terms'];
				$trantype=$item['trantype'];
				$unitcost=$item['unitcost'];
				$recqty=$item['quantity'];
				$reqdept=$item['dept'];
				$discount=$item['prodtype1'];
				$requser=$item['receivinguser'];
				$expiration=$item['expiration'];
				$lotno=$item['lotno'];
				$vat=$item['vat'];
				$unit=$item['unit'];
				$invdate=$item['datearray'];
				$fullname=$this->session->fullname;
				$datearray=$invdate;
				$transdate=$item['transdate'];
				$transactdate=date('M-d-Y',strtotime($invdate));
				$duedate="";
				$timearray=date('H:i:s');
				$this->db->query("UPDATE receiving SET unitcost='$unitcost',capital='$unitcost' WHERE `code`='$code'");
				$query="INSERT INTO stocktablepayables(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray) VALUES('$transactdate','$rrno','','$invno','$suppliercode','$suppliername','$code','$description','$unitcost','$recqty','$recqty','','$recqty','$expiration','$lotno','$trantype','$terms','$transdate','$reqdept','$discount','$trantype','$rrdetails','$fullname','0','$vat','$duedate','$invdate')";
				$stocktablepayables=$this->db->query($query);
				if($stocktablepayables){
					$stocktablepayables=$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$transactdate','$rrno','','$invno','$suppliercode','$suppliername','$code','$description','$unitcost','$recqty','$recqty','','$recqty','$expiration','$lotno','$trantype','$terms','$transdate','$reqdept','$discount','$trantype','$rrdetails','$fullname','0','u','$duedate','$invdate','$timearray')");
				}
			}
		}
		if($stocktablepayables){
			$this->db->query("DELETE FROM stocktablepreview WHERE invno='$invno'");
			return true;
		}else{
			return false;
		}
	}
	public function getAllRequest(){
		$dept=$this->session->dept;
		$result=$this->db->query("SELECT * FROM purchaseorder WHERE `status`='request' AND dept='$dept' GROUP BY reqdept ORDER BY reqdept ASC");
		return $result->result_array();
	}
	public function getAllRequestByReqNo($reqdept){
		$dept=$this->session->dept;
		$result=$this->db->query("SELECT * FROM purchaseorder WHERE `status`='request' AND reqdept='$reqdept' AND dept='$dept' GROUP BY reqno ORDER BY reqdate DESC");
		return $result->result_array();
	}
	public function getAllItemsRequest($reqno){
		$result=$this->db->query("SELECT po.*,r.generic FROM purchaseorder po INNER JOIN receiving r ON r.code=po.code WHERE po.`status`='request' AND po.reqno='$reqno'");
		return $result->result_array();
	}
	public function update_request($rrdetails,$issuedqty){
		$issuinguser=$this->session->fullname;
		$item=$this->db->query("SELECT * FROM purchaseorder WHERE rrdetails='$rrdetails' AND `status`='request'");
		$itemresult=$item->row_array();
		$remqty=$itemresult['prodqty']-$issuedqty;
		$nqty=$issuedqty;
		$iqty=$issuedqty;
		if($remqty > 0){
			$this->db->query("INSERT INTO purchaseorder(rrno,transdate,supplier,suppliercode,terms,trantype,code,`description`,unitcost,generic,prodqty,dept,`status`,prodtype1,po,user,approvingofficer,reqdept,reqno,reqdate,requser) VALUES('','$itemresult[transdate]','$itemresult[suppliername]','$itemresult[suppliercode]','$itemresult[terms]','$itemresult[trantype]','$itemresult[code]','$itemresult[description]','$itemresult[unitcost]','$itemresult[transdate]','$remqty','$itemresult[dept]','cancel','$itemresult[prodtype1]','$itemresult[po]','$itemresult[user]','$itemresult[approvingofficer]','$itemresult[reqdept]','$itemresult[reqno]','$itemresult[reqdate]','$itemresult[requser]')");
			$this->db->query("UPDATE purchaseorder SET prodqty='$iqty',`status`='received',user='$issuinguser' WHERE rrdetails='$rrdetails'");
			$subitem=$this->db->query("SELECT rrno,generic FROM stocktable WHERE code='$itemresult[code]' AND dept='$itemresult[dept]' AND datearray >= '2021-07-01' GROUP BY rrno HAVING SUM(quantity) > 0 ");
			$subitemresult=$subitem->result_array();
			foreach($subitemresult AS $item){
				$itemqty=$this->db->query("SELECT SUM(quantity) AS rrsoh, unitcost, expiration, lotno, trantype FROM stocktable WHERE rrno='".$item['rrno']."' AND code='$itemresult[code]' AND dept='$itemresult[dept]' AND datearray >= '2021-07-01'");
				$itemqtyresult=$itemqty->row_array();
				if($nqty>0 && $itemqtyresult['rrsoh']>0){
					if($itemqtyresult['rrsoh']>=$nqty){
						$result=$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`,`timearray`) VALUES ('$itemresult[transdate]','".$item['rrno']."','','','$itemresult[dept]','$itemresult[dept]','$itemresult[code]','$itemresult[description]','".$itemqtyresult['unitcost']."','$nqty','$nqty','$item[generic]','$issuedqty','".$itemqtyresult['expiration']."','".$itemqtyresult['lotno']."','STOCK TRANSFER','NONE','$itemresult[transdate]','$itemresult[reqdept]','','$itemresult[approvingofficer]','$itemresult[reqno]','$itemresult[requser]','','u','".date("H:i:s")."','".date("Y-m-d")."','".date("H:i:s")."')");
						$result=$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`,`timearray`) VALUES ('$itemresult[transdate]','".$item['rrno']."','','','$itemresult[reqdept]','$itemresult[reqdept]','$itemresult[code]','$itemresult[description]','".$itemqtyresult['unitcost']."','-$nqty','$nqty','$item[generic]','$issuedqty','".$itemqtyresult['expiration']."','".$itemqtyresult['lotno']."','STOCK TRANSFER','NONE','$itemresult[transdate]','$itemresult[dept]','','$itemresult[approvingofficer]','$itemresult[reqno]','$itemresult[requser]','','u','".date("H:i:s")."','".date("Y-m-d")."','".date("H:i:s")."')");
						$nqty=0;
					}else{
						$result=$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`,`timearray`) VALUES ('$itemresult[transdate]','".$item['rrno']."','','','$itemresult[dept]','$itemresult[dept]','$itemresult[code]','$itemresult[description]','".$itemqtyresult['unitcost']."','$itemqtyresult[rrsoh]','$itemqtyresult[rrsoh]','$item[generic]','$issuedqty','".$itemqtyresult['expiration']."','".$itemqtyresult['lotno']."','STOCK TRANSFER','NONE','$itemresult[transdate]','$itemresult[reqdept]','','$itemresult[approvingofficer]','$itemresult[reqno]','$itemresult[requser]','','u','".date("H:i:s")."','".date("Y-m-d")."','".date("H:i:s")."')");
						$result=$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`,`timearray`) VALUES ('$itemresult[transdate]','".$item['rrno']."','','','$itemresult[reqdept]','$itemresult[reqdept]','$itemresult[code]','$itemresult[description]','".$itemqtyresult['unitcost']."','-$itemqtyresult[rrsoh]','$itemqtyresult[rrsoh]','$item[generic]','$issuedqty','".$itemqtyresult['expiration']."','".$itemqtyresult['lotno']."','STOCK TRANSFER','NONE','$itemresult[transdate]','$itemresult[dept]','','$itemresult[approvingofficer]','$itemresult[reqno]','$itemresult[requser]','','u','".date("H:i:s")."','".date("Y-m-d")."','".date("H:i:s")."')");
						$nqty=$nqty-$itemqtyresult['rrsoh'];
					}
				}
			}
		}elseif($remqty < 0){
			return false;
		}else{
			$this->db->query("UPDATE purchaseorder SET `status`='received',user='$issuinguser' WHERE rrdetails='$rrdetails'");
			$subitem=$this->db->query("SELECT rrno,generic FROM stocktable WHERE code='$itemresult[code]' AND dept='$itemresult[dept]' AND datearray >= '2021-07-01' GROUP BY rrno HAVING SUM(quantity) > 0");
			$subitemresult=$subitem->result_array();
			foreach($subitemresult AS $item){
				$itemqty=$this->db->query("SELECT SUM(quantity) AS rrsoh, unitcost, expiration, lotno, trantype FROM stocktable WHERE rrno='".$item['rrno']."' AND code='$itemresult[code]' AND dept='$itemresult[dept]' AND datearray >= '2021-07-01'");
				$itemqtyresult=$itemqty->row_array();
				if($itemqtyresult['rrsoh']>0 && $nqty>0){
					if($itemqtyresult['rrsoh']>=$nqty){
						$result=$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`,`timearray`) VALUES ('$itemresult[transdate]','".$item['rrno']."','','','$itemresult[dept]','$itemresult[dept]','$itemresult[code]','$itemresult[description]','".$itemqtyresult['unitcost']."','$nqty','$nqty','$item[generic]','$nqty','".$itemqtyresult['expiration']."','".$itemqtyresult['lotno']."','STOCK TRANSFER','NONE','$itemresult[transdate]','$itemresult[reqdept]','','$itemresult[approvingofficer]','$itemresult[reqno]','$itemresult[requser]','','u','".date("H:i:s")."','".date("Y-m-d")."','".date("H:i:s")."')");
						$result=$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`,`timearray`) VALUES ('$itemresult[transdate]','".$item['rrno']."','','','$itemresult[reqdept]','$itemresult[reqdept]','$itemresult[code]','$itemresult[description]','".$itemqtyresult['unitcost']."','-$nqty','$nqty','$item[generic]','-$nqty','".$itemqtyresult['expiration']."','".$itemqtyresult['lotno']."','STOCK TRANSFER','NONE','$itemresult[transdate]','$itemresult[dept]','','$itemresult[approvingofficer]','$itemresult[reqno]','$itemresult[requser]','','u','".date("H:i:s")."','".date("Y-m-d")."','".date("H:i:s")."')");
						$nqty=0;
					}else{
						$result=$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`,`timearray`) VALUES ('$itemresult[transdate]','".$item['rrno']."','','','$itemresult[dept]','$itemresult[dept]','$itemresult[code]','$itemresult[description]','".$itemqtyresult['unitcost']."','$itemqtyresult[rrsoh]','$itemqtyresult[rrsoh]','$item[generic]','$issuedqty','".$itemqtyresult['expiration']."','".$itemqtyresult['lotno']."','STOCK TRANSFER','NONE','$itemresult[transdate]','$itemresult[reqdept]','','$itemresult[approvingofficer]','$itemresult[reqno]','$itemresult[requser]','','u','".date("H:i:s")."','".date("Y-m-d")."','".date("H:i:s")."')");
						$result=$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`,`timearray`) VALUES ('$itemresult[transdate]','".$item['rrno']."','','','$itemresult[reqdept]','$itemresult[reqdept]','$itemresult[code]','$itemresult[description]','".$itemqtyresult['unitcost']."','-$itemqtyresult[rrsoh]','$itemqtyresult[rrsoh]','$item[generic]','$issuedqty','".$itemqtyresult['expiration']."','".$itemqtyresult['lotno']."','STOCK TRANSFER','NONE','$itemresult[transdate]','$itemresult[dept]','','$itemresult[approvingofficer]','$itemresult[reqno]','$itemresult[requser]','','u','".date("H:i:s")."','".date("Y-m-d")."','".date("H:i:s")."')");
						$nqty=$nqty-$itemqtyresult['rrsoh'];
					}
				}else{
					$nqty=$nqty;
				}
			}
		}
		return $result;
	}

	public function issuanceprintheader($param){
		$result=$this->db->query("SELECT po.*,s.datearray FROM purchaseorder po INNER JOIN stocktable s ON s.isid=po.reqno WHERE po.reqno='$param' AND (po.`status`='received' OR po.`status`='return') GROUP BY po.po");
		return $result->row_array();
	}
	public function issuanceprintbody($param){
		$result=$this->db->query("SELECT po.*,r.generic,r.description FROM purchaseorder po INNER JOIN receiving r ON r.code=po.code WHERE reqno='$param' AND `status`='received' AND prodqty > 0 ORDER BY r.generic ASC");
		return $result->result_array();
	}
	public function issuancehistoryprintbody($reqno,$department,$startdate,$enddate){
		$result=$this->db->query("SELECT po.description,(s.quantity*s.unitcost) AS amount,s.datearray,s.lotno,po.code,SUM(s.quantity) as quantity,r.generic FROM purchaseorder po INNER JOIN stocktable s ON s.isid=po.reqno AND s.code=po.code INNER JOIN receiving r ON r.code=po.code WHERE s.suppliername='$department' AND s.datearray BETWEEN '$startdate' AND '$enddate' AND po.status='received' AND po.reqno='$reqno' GROUP BY s.code ORDER BY r.generic ASC");
		return $result->result_array();
	}
	public function getRequestedQty($reqno,$code){
		$result=$this->db->query("SELECT SUM(prodqty) as reqqty FROM purchaseorder WHERE reqno='$reqno' AND code='$code'");
		return $result->row_array();
	}
	public function getAllPendingChargeSlip(){
		$dept=$this->session->dept;
		$result=$this->db->query("SELECT * FROM stocktabletransfer WHERE isid = '' AND dept='$dept' GROUP BY invno");
		return $result->result_array();
	}
	public function getItemsTransfer($invno){
		$result=$this->db->query("SELECT st.*,r.generic FROM stocktabletransfer st INNER JOIN receiving r ON r.code=st.code WHERE st.invno='$invno' AND isid=''");
		return $result->result_array();
	}
	public function transferadditem(){
		$nursename=$this->session->fullname;
		$invno=$this->session->invno;
		$branch=$this->session->branch;
		$transdate=$this->session->transdate;
		$tdate=date('M-d-Y',strtotime($transdate));
		$dept=$this->session->dept;
		$supplier="KMSCI STOCKS";
		$trantype="TRANSFER TO ".$branch;
		$code=$this->input->post("code");
		$description=$this->input->post("description");
		$unitcost=$this->input->post("unitcost");
		$quantity=$this->input->post("quantity");
		$discount=$this->input->post("discount");
		$lotno=$this->input->post("lotno");
		$expiration=$this->input->post("expiration");
		$unit=$this->input->post("unit");
		$soh=$this->input->post("qty");
		if($soh>=$quantity){
			$insert=$this->db->query("INSERT INTO stocktabletransfer(date,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray) VALUES('$tdate','','$invno','$invno','$supplier','$supplier','$code','$description','$unitcost','$quantity','0','','$quantity','$expiration','$lotno','$trantype','','$transdate','$dept','$discount','$unit','','$nursename','e','u','','$transdate')");
				if($insert){
					return true;
				}else{
					return false;
				}
		}else{
			return false;
		}
	}
	public function remove_transfer_item($param){
		$remove=$this->db->query("DELETE FROM stocktabletransfer WHERE autono='$param'");
		if($remove){
			return true;
		}else{
			return false;
		}
	}
	public function fetch_transfer_item($id){
		$result=$this->db->query("SELECT * FROM stocktabletransfer WHERE autono='$id'");
		return $result->result_array();
	}
	public function update_transfer_item(){
		$dept=$this->session->dept;
		$code=$this->input->post("code");
		$description=$this->input->post("description");
		$unitcost=$this->input->post("unitcost");
		$discount=$this->input->post("discount");
		$quantity=$this->input->post("quantity");
		$lotno=$this->input->post("lotno");
		$expiration=$this->input->post("expiration");
		$unit=$this->input->post("unit");
		$autono=$this->input->post("autono");
		$check=$this->db->query("SELECT SUM(quantity) as qty FROM stocktable WHERE code='$code' AND dept='$dept' AND datearray >= '2021-07-01' GROUP BY code");
		$item=$check->row_array();
		if($item['qty'] >= $quantity){
			$update=$this->db->query("UPDATE stocktabletransfer SET description='$description',unitcost='$unitcost',quantity='$quantity',statquantity='$quantity',lotno='$lotno',expiration='$expiration',paymentstatus='$unit',prodtype1='$discount' WHERE autono='$autono'");
		}
		if($update){
			return true;
		}else{
			return false;
		}
	}
	public function post_transfer($invno){
		$items=$this->db->query("SELECT * FROM stocktabletransfer WHERE invno='$invno'");
		$it=$items->result_array();
		$timearray=date('H:i:s');
		foreach($it as $item){
			$insert=$this->db->query("INSERT INTO stocktable(date,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$item[date]','','$invno','$invno','$item[suppliercode]','$item[suppliername]','$item[code]','$item[description]','$item[unitcost]','-$item[quantity]','0','','$item[statquantity]','$item[expiration]','$item[lotno]','$item[trantype]','','$item[transdate]','$item[dept]','0','$item[paymentstatus]','','$item[receivinguser]','e','u','','$item[datearray]','$timearray')");
		}
		if($insert){
			$this->db->query("UPDATE stocktabletransfer SET isid='$invno' WHERE invno='$invno'");
			return true;
		}else{
			return false;
		}
	}
	public function getItemsTransferred($invno){
		$result=$this->db->query("SELECT st.*,r.generic FROM stocktabletransfer st INNER JOIN receiving r ON r.code=st.code WHERE (st.invno='$invno' OR st.po='$invno') AND isid <> '' ");
		return $result->result_array();
	}
	public function getAllChargeSlip(){
		$dept=$this->session->dept;
		$datenow = date('Y-m-d');
		$result=$this->db->query("SELECT * FROM stocktabletransfer WHERE isid <> '' AND dept='$dept' AND datearray = '$datenow' GROUP BY invno ORDER BY datearray DESC");
		return $result->result_array();
	}
	public function getAllChargeSlipByDate(){
		$dept=$this->session->dept;
		$branch=$this->input->post('branch');
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$result=$this->db->query("SELECT * FROM stocktabletransfer WHERE isid <> '' AND dept='$dept' AND trantype LIKE '%$branch%' AND datearray BETWEEN '$startdate' AND '$enddate' GROUP BY invno ORDER BY datearray DESC");
		return $result->result_array();
	}
	public function getAllReceivingByDate(){
		$supplier=explode('_',$this->input->post('supplier'));
		$suppliercode=$supplier[0];
		$suppliername=$supplier[1];
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$dept=$this->session->dept;
		if($dept=="CPU"){
			$result=$this->db->query("SELECT * FROM stocktablepayables WHERE suppliercode='$suppliercode' AND datearray BETWEEN '$startdate' AND '$enddate' AND (dept='$dept' OR dept='AMSHI' OR dept='MMSHI' OR dept='CMSHI' OR dept='MMHI') GROUP BY rrno ORDER BY datearray DESC");
		}else{
			$result=$this->db->query("SELECT * FROM stocktablepayables WHERE suppliercode='$suppliercode' AND datearray BETWEEN '$startdate' AND '$enddate' AND dept='$dept' GROUP BY rrno ORDER BY datearray DESC");
		}		
		return $result->result_array();
	}
	public function getAllReceivingBySupplier(){
		$supplier=explode('_',$this->input->post('supplier'));
		$suppliercode=$supplier[0];
		$suppliername=$supplier[1];
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$dept=$this->session->dept;		
		$result=$this->db->query("SELECT sp.*,SUM(sp.quantity) as quantity,r.generic FROM stocktablepayables sp INNER JOIN receiving r ON r.code=sp.code WHERE sp.suppliercode='$suppliercode' AND sp.datearray BETWEEN '$startdate' AND '$enddate' AND (sp.dept='$dept' OR dept='AMSHI' OR dept='MMSHI' OR dept='CMSHI' OR dept='MMHI') GROUP BY sp.code,sp.unitcost,sp.prodtype1 ORDER BY r.itemname ASC, sp.datearray DESC");
		return $result->result_array();
	}
	public function getAllReceivingDetails(){
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$dept=$this->session->dept;
		$result=$this->db->query("SELECT sp.*,SUM(sp.quantity) as quantity,r.generic FROM stocktablepayables sp INNER JOIN receiving r ON r.code=sp.code WHERE dept='$dept' AND datearray BETWEEN '$startdate' AND '$enddate' GROUP BY rrno,code ORDER BY datearray DESC");
		return $result->result_array();
	}
	public function getAllIssuanceReport(){
		$department=$this->input->post('department');
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$result=$this->db->query("SELECT s.*,po.status,po.user,po.reqdept FROM stocktable s INNER JOIN purchaseorder po ON po.reqno=s.isid WHERE po.dept='$department' AND s.datearray BETWEEN '$startdate' AND '$enddate' AND s.trantype='STOCK TRANSFER' GROUP BY s.isid ORDER BY s.datearray DESC");
		return $result->result_array();
	}
	public function getAllIssuanceDetails($param){
		$department=$this->input->post('department');
		$dept2=$this->input->post('dept2');
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$dept=$this->session->dept;
		//$result=$this->db->query("SELECT s.*,po.reqdept,r.generic,r.unit FROM stocktable s INNER JOIN purchaseorder po ON po.reqno=s.isid INNER JOIN receiving r ON r.code=s.code WHERE po.reqdept='$department' AND po.dept='$dept' AND s.datearray BETWEEN '$startdate' AND '$enddate' AND s.trantype='STOCK TRANSFER' AND po.approvingofficer='$param' GROUP BY s.code,s.isid ORDER BY r.generic ASC");
		$result=$this->db->query("SELECT po.unitcost,po.supplier,po.reqdept,r.description,s.*,s.unitcost as amount,SUM(s.quantity) as quantity,r.code,r.unit,r.generic,s.dept FROM stocktable s INNER JOIN purchaseorder po ON po.reqno=s.isid AND po.code=s.code INNER JOIN receiving r ON r.code=s.code WHERE s.isid <> '' AND s.datearray BETWEEN '$startdate' AND '$enddate' AND po.reqdept = '$department' AND (s.suppliercode='$dept' or s.suppliercode='$dept2') AND po.status='received' AND po.approvingofficer='$param' GROUP BY s.code ORDER BY r.generic ASC");
		return $result->result_array();
	}
	public function getIssuanceDetails($section){
		$department=$this->input->post('department');
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$result=$this->db->query("SELECT s.*,po.reqdept,r.generic,r.unit FROM stocktable s INNER JOIN purchaseorder po ON po.reqno=s.isid INNER JOIN receiving r ON r.code=s.code WHERE po.reqdept='$department' AND s.datearray BETWEEN '$startdate' AND '$enddate' AND s.trantype='STOCK TRANSFER' AND r.optset3='$section' GROUP BY s.isid,s.code ORDER BY s.datearray DESC");
		return $result->result_array();
	}
	public function getDiscount($code){
		$result=$this->db->query("SELECT prodtype1,unitcost,stockalert FROM stocktablepayables WHERE code='$code' ORDER BY datearray DESC LIMIT 1");
		return $result->row_array();
	}

	public function getAllPOReceived($type,$from,$to){
		$st=$this->session->dept;
		$result=$this->db->query("SELECT SUM(s.quantity*s.unitcost) AS ARTrade,SUM(s.quantity*s.prodtype1) AS ARTradeDisc,s.`date`,s.rrno,s.po,s.invno,c.suppliername,c.suppliercode,c.leadtime FROM stocktablepayables s INNER JOIN supplierscsr c ON c.suppliercode=s.suppliercode WHERE (s.trantype='$type' or trantype='FREE GOODS') AND s.datearray BETWEEN '$from' AND '$to' AND s.dept='$st' GROUP BY s.rrno, s.invno ORDER BY s.datearray ASC, s.rrno ASC");
		return $result->result_array();
	}
	public function getAllPOReceivedAmount($rrno,$invno,$po,$type){
		$st=$this->session->dept;
		$result=$this->db->query("SELECT * FROM stocktablepayables WHERE rrno='$rrno' AND po='$po' AND invno='$invno' AND dept='$st' AND trantype='$type' GROUP BY autono");
		$amount=$result->result_array();
		$tamount=0;
		foreach ($amount as $amt) {
			if($amt['prodtype1']>0){
				$tamount +=$amt['prodtype1']*$amt['quantity'];
			}else{
				$tamount +=$amt['unitcost']*$amt['quantity'];
			}
		}
		return $tamount;
	}
	public function checkVat($rrno){
		$result=$this->db->query("SELECT * FROM stocktablepayables WHERE rrno='$rrno'");
		$items=$result->result_array();
		$vat=0;
		foreach($items as $item){
			if($item['trantype'] != "FREE GOODS"){
				if($item['stockalert']>0){
					if($item['prodtype1']>0){
						$unitvat=$item['prodtype1']- ($item['prodtype1']/1.12);
						$vat +=$item['quantity']*$unitvat;
					}else{
						$unitvat=$item['unitcost']- ($item['unitcost']/1.12);
						$vat +=$item['quantity']*$unitvat;
					}

				}
			}else{
				$vat+=0;
			}
		}
		return $vat;
	}
	public function checkAmount($rrno,$type1,$type2,$type3,$trantype,$startdate,$enddate){
		$st=$this->session->dept;
		$result=$this->db->query("SELECT sp.unitcost,sp.quantity,sp.prodtype1,sp.stockalert,sp.trantype FROM stocktablepayables sp INNER JOIN receiving r ON r.code=sp.code WHERE sp.rrno='$rrno' AND (r.unit LIKE '%$type1%' OR r.unit LIKE '%$type2%' OR r.unit LIKE '%$type3%') AND sp.dept='$st' AND sp.trantype='$trantype' AND sp.datearray BETWEEN '$startdate' AND '$enddate'");
		$amount=$result->result_array();
		$res=0;
		foreach($amount as $amt){
			if($amt['prodtype1']>0){
				$unitcost=$amt['prodtype1']*$amt['quantity'];
			}else{
				$unitcost=round($amt['unitcost'],3)*$amt['quantity'];
			}
			if($amt['stockalert'] > 0){
				if($amt['trantype']=="FREE GOODS"){
					$res +=$unitcost;
				}else{
					$res +=$unitcost/1.12;
				}
			}else{
				$res +=$unitcost;
			}
		}
		return $res;
	}
	public function checkAmountFreeGoods($rrno,$trantype,$startdate,$enddate){
		$st=$this->session->dept;
		$result=$this->db->query("SELECT sp.unitcost,sp.quantity,sp.prodtype1,sp.stockalert FROM stocktablepayables sp INNER JOIN receiving r ON r.code=sp.code WHERE sp.rrno='$rrno' AND sp.dept='$st' AND sp.trantype='$trantype' AND sp.datearray BETWEEN '$startdate' AND '$enddate'");
		$amount=$result->result_array();
		$res=0;
		foreach($amount as $amt){
			if($amt['prodtype1']>0){
				$unitcost=$amt['prodtype1']*$amt['quantity'];
			}else{
				$unitcost=$amt['unitcost']*$amt['quantity'];
			}
			$res +=$unitcost;
		}
		return $res;
	}
	public function view_consolidated_po(){
		$st=$this->session->dept;
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$result=$this->db->query("SELECT r.itemname,s.suppliername,sum(po.prodqty) AS usages,s.unitcost,sum(po.prodqty * s.unitcost) as totalgross FROM stocktablepayables s INNER JOIN receiving r ON r.code=s.code INNER JOIN purchaseorder po ON po.reqno=s.po WHERE s.datearray BETWEEN '$startdate' AND '$enddate' AND s.dept='$st' AND s.suppliercode NOT LIKE '%$st%' AND s.trantype NOT LIKE '%FREE GOODS%' AND po.status='poreceived' AND po.status <> 'received' GROUP BY s.code  ORDER by r.itemname ASC");
		return $result->result_array();
	}
	public function getAdjustmentHistory(){
		$st=$this->session->dept;
		$datenow=date('Y-m-d');
		$result=$this->db->query("SELECT `date`,code,`description`,prevqty,statquantity,paymentstatus,receivinguser FROM stocktable WHERE datearray ='$datenow' AND dept='$st' AND trantype='ADJUSTMENT'");
		return $result->result_array();
	}
	public function getAdjustmentHistoryByDate(){
		$st=$this->session->dept;
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$result=$this->db->query("SELECT `date`,code,`description`,prevqty,statquantity,paymentstatus,receivinguser FROM stocktable WHERE datearray BETWEEN '$startdate' AND '$enddate' AND dept='$st' AND trantype='ADJUSTMENT' ORDER BY datearray DESC");
		return $result->result_array();
	}
	public function getPOReceived(){
		$result=$this->db->query("SELECT sp.date,sp.rrno,sp.description,sp.unitcost,SUM(sp.quantity) as quantity,sp.expiration,sp.suppliername,po.reqno,sp.lotno,sp.invno,r.generic FROM stocktablepayables sp INNER JOIN purchaseorder po ON po.reqno=sp.po INNER JOIN receiving r ON r.code=sp.code WHERE po.status='poreceived' GROUP BY sp.rrno,sp.description,sp.lotno,sp.expiration ORDER BY sp.datearray DESC LIMIT 10");
		return $result->result_array();
	}
	public function searchPOReceived(){
		$description=$this->input->post("searchme");
		$result=$this->db->query("SELECT sp.date,sp.rrno,sp.description,sp.unitcost,SUM(sp.quantity) as quantity,sp.expiration,sp.suppliername,po.reqno,sp.lotno,sp.invno,r.generic,sp.prodtype1 FROM stocktablepayables sp INNER JOIN purchaseorder po ON po.reqno=sp.po INNER JOIN receiving r ON r.code=sp.code WHERE po.status='poreceived' AND (sp.rrno LIKE '%$description%' OR r.generic LIKE '%$description%' OR r.description LIKE '%$description%') GROUP BY sp.rrno,sp.description,sp.lotno,sp.expiration ORDER BY sp.datearray DESC");
		return $result->result_array();
	}
	public function getAllKitAssemblyReport(){
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		$result=$this->db->query("SELECT ka.refno,ka.quantity,ka.datearray,ka.user,r.itemname FROM kitassemblyreference ka INNER JOIN receiving r ON r.code=ka.code WHERE ka.datearray BETWEEN '$startdate' AND '$enddate' GROUP BY ka.refno ORDER BY ka.datearray ASC");
		return $result->result_array();
	}
	public function kitassemblyreporthead($refno){
		$result=$this->db->query("SELECT ka.quantity,ka.datearray,r.itemname FROM kitassemblyreference ka INNER JOIN receiving r ON r.code=ka.code WHERE ka.refno='$refno' GROUP BY ka.refno");
		return $result->row_array();
	}

	public function kitassemblyreport($refno){
		$result=$this->db->query("SELECT ka.itemquantity,ka.itemcode,r.* ,ka.user FROM kitassemblyreference ka INNER JOIN receiving r ON r.code=ka.code WHERE ka.refno='$refno'");
		return $result->result_array();
	}
	public function getAllItems(){
		$dept=$this->session->dept;
		$result = $this->db->query("SELECT r.* FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE s.dept ='$dept' GROUP BY s.code ORDER BY r.itemname ASC");
		return $result->result_array();
	}
	public function view_sc_description(){
		$item=$this->input->post('item');
		$description=$this->db->query("SELECT `description`,generic,code FROM receiving WHERE code='$item'");
		$desc=$description->row_array();
		return $desc;
	}
	public function view_sc_begbalance(){
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$item=$this->input->post('item');
		$department=$this->input->post('department');
		$datefrom=date('Y-m-d',strtotime('-1 day',strtotime($startdate)));
		if($department=="CPU" || $department=="CSR" || $department=="CPU-RDU"){
			$begbalance=$this->db->query("SELECT SUM(quantity) as begbalance FROM stocktable WHERE code='$item' AND dept='$department' AND datearray BETWEEN '2021-07-01' AND  '$datefrom' GROUP BY code");
		}else{
			$begbalance=$this->db->query("SELECT SUM(quantity) as begbalance FROM stocktable WHERE code='$item' AND dept='$department' AND datearray <= '$datefrom' GROUP BY code");
		}
		return $begbalance->row_array();

	}
	public function view_stock_card(){
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$item=$this->input->post('item');
		$department=$this->input->post('department');
		$result=$this->db->query("SELECT * FROM stocktable WHERE code='$item' AND dept='$department' AND datearray BETWEEN '$startdate' AND '$enddate' ORDER BY datearray ASC");
		return $result->result_array();
	}
	public function authenticate_user($password){
		$st=$this->session->dept;
		$result=$this->db->query("SELECT * FROM nsauth WHERE `password`='$password' AND station='$st'");
		if($result->num_rows() > 0){
			$user=$result->row_array();
			$this->session->set_userdata('user_name',$user['name']);
			return true;
		}else{
			return false;
		}
	}
	public function getItems(){
		$st=$this->session->dept;
		$result=$this->db->query("SELECT r.code,r.`description`,SUM(s.quantity) as soh,r.generic FROM stocktable s INNER JOIN receiving r ON r.code=s.code WHERE s.dept='$st' AND datearray >= '2021-07-01' GROUP BY s.code ORDER BY r.itemname ASC LIMIT 10");
		return $result->result_array();
	}
	public function reason(){
		$result=$this->db->query("SELECT comment FROM returncomment ORDER BY code DESC");
		return $result->result_array();
	}
	public function getItemsByDescription(){
		$st=$this->session->dept;
		$description=$this->input->post('searchme');
		$result=$this->db->query("SELECT r.code,r.`description`,SUM(s.quantity) as soh,r.generic FROM stocktable s INNER JOIN receiving r ON r.code=s.code WHERE s.dept='$st' AND s.datearray >= '2021-07-01' AND (r.`description` LIKE '%$description%' OR r.generic LIKE '%$description%') GROUP BY s.code ORDER BY r.itemname ASC LIMIT 20");
		return $result->result_array();
	}
	public function adjust_item(){
		$department=$this->session->dept;
		$code=$this->input->post('code');
		$quantity=$this->input->post('quantity');
		$soh=$this->input->post('soh');
		$reason=$this->input->post('reason');
		$date=date('M-d-Y');
		$datearray=date('Y-m-d');
		$timearray=date('H:i:s');
		$nursename=$this->session->fullname;
		$rr=$this->db->query("SELECT *,SUM(quantity) as soh FROM stocktable WHERE `code`='$code' AND dept='$department' AND datearray >= '2021-07-01' GROUP BY rrno HAVING SUM(quantity) <> 0");
		$rrn=$rr->result_array();
		foreach($rrn as $rrno){
			//if($rrno['soh'] > 0){
			$rqty=$rrno['soh']*(-1);
			// }else{
			//     $rqty=$rrno['soh'];
			// }
			$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$date','$rrno[rrno]','','','$department','$department','$code','$rrno[description]','$rrno[unitcost]','$rqty','0','$rrno[generic]','0','$rrno[expiration]','$rrno[lotno]','ADJUSTMENT','NONE','$date','$department','0.00','$reason','','$nursename','$rrno[soh]','u','$rrno[duedate]','$datearray','$timearray')");
		}
		$sql=$this->db->query("SELECT * FROM stocktablepayables WHERE code='$code' AND dept='$department' AND (trantype='charge' OR trantype='cash') GROUP BY rrno ORDER BY datearray DESC LIMIT 1");
		if($sql->num_rows()>0){
			$item=$sql->row_array();
			$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$date','$item[rrno]','','','$department','$department','$code','$item[description]','$unitcost','$quantity','0','$item[generic]','$quantity','$item[expiration]','$item[lotno]','ADJUSTMENT','NONE','$date','$department','0.00','$reason','','$nursename','$soh','u','$item[duedate]','$datearray','$timearray')");
			$result=$this->db->query("INSERT INTO usermode values('$datearray','$time','$item[refno]','$department','$code','$unitcost','$quantity','BULK ADJUSTMENT','$nursename')");
		}else{
			$sql=$this->db->query("SELECT * FROM stocktable WHERE code='$code' AND dept='$department' AND (trantype='charge' OR trantype='cash') GROUP BY rrno ORDER BY datearray DESC LIMIT 1");
			$item=$sql->row_array();
			$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$date','$item[rrno]','','','$department','$department','$code','$item[description]','$unitcost','$quantity','0','$item[generic]','$quantity','$item[expiration]','$item[lotno]','ADJUSTMENT','NONE','$date','$department','0.00','$reason','','$nursename','$soh','u','$item[duedate]','$datearray','$timearray')");
			$result=$this->db->query("INSERT INTO usermode values('$datearray','$time','$item[refno]','$department','$code','$unitcost','$quantity','$reason','$nursename')");
		}
		return $result;
	}
	public function getSingleQty($code,$dept){
		if($dept=="CPU" || $dept=="CSR" || $dept=="CPU-RDU"){
			$result=$this->db->query("SELECT SUM(quantity) as soh FROM stocktable WHERE code='$code' AND dept='$dept' AND datearray>='2021-07-01' GROUP BY code");
		}else{
			$result=$this->db->query("SELECT SUM(quantity) as soh FROM stocktable WHERE code='$code' AND dept='$dept' GROUP BY code");
		}
		return $result->row_array();
	}
	public function getSingleDepartment($code){
		$result=$this->db->query("SELECT dept FROM stocktable WHERE `code`='$code' AND dept <> '' GROUP BY dept");
		return $result->result_array();
	}
	public function getAllItemsByLimit(){
		$st=$this->session->dept;
		$result = $this->db->query("SELECT r.itemname,r.code,r.generic FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE s.dept ='$st' GROUP BY s.code ORDER BY r.itemname ASC LIMIT 5");
		return $result->result_array();
	}
	public function getAllItemsByDescription(){
		$st=$this->session->dept;
		$description=$this->input->post('searchme');
		$result = $this->db->query("SELECT r.itemname,r.code,r.generic FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE s.dept ='$st' AND r.description LIKE '%$description%' GROUP BY s.code ORDER BY r.itemname ASC");
		return $result->result_array();
	}
	public function getAccountType(){
		$st=$this->session->dept;
		$result=$this->db->query("SELECT r.unit FROM stocktable s INNER JOIN receiving r ON r.code=s.code WHERE s.dept='$st' GROUP BY r.unit");
		return $result->result_array();
	}
	public function getAllItemsByType($type,$dept,$rundate){
		if($dept=="CPU" || $dept=="CSR" || $dept=="CPU-RDU"){
			if($type=="PHARMACY/MEDICINE"){
				$result=$this->db->query("SELECT r.code,r.description,SUM(s.quantity) AS quantity,s.rrno,s.unitcost,r.generic,r.capital,s.expiration FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE s.datearray BETWEEN '2021-07-01' AND '$rundate' AND r.unit LIKE '%$type%' AND r.description <> '.' AND s.dept='$dept' GROUP BY s.code ORDER BY r.description ASC");
			}else{
				$result=$this->db->query("SELECT r.code,r.description,SUM(s.quantity) AS quantity,s.rrno,s.unitcost,r.generic,r.capital,s.expiration FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE s.datearray BETWEEN '2021-07-01' AND '$rundate' AND r.unit LIKE '%$type%' AND r.description <> '.' AND s.dept='$dept' GROUP BY s.code ORDER BY r.description ASC");
			}			
		}else{
			if($type=="PHARMACY/MEDICINE"){
				$result=$this->db->query("SELECT r.code,r.description,SUM(s.quantity) AS quantity,s.rrno,s.unitcost,r.generic,r.capital,s.expiration FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE r.unit LIKE '%$type%' AND r.description <> '.' AND s.dept='$dept' AND r.gtestcode = '0' GROUP BY s.code ORDER BY r.description ASC");
			}else{
				$result=$this->db->query("SELECT r.code,r.description,SUM(s.quantity) AS quantity,s.rrno,s.unitcost,r.generic,r.capital,s.expiration FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE r.unit LIKE '%$type%' AND r.description <> '.' AND s.dept='$dept' AND r.gtestcode = '0' GROUP BY s.code ORDER BY r.description ASC");
			}
		}

		return $result->result_array();
	}
	public function getAllItemsByTypeDesc($type,$dept,$rundate,$searchme){
		if($dept=="CPU" || $dept=="CSR" || $dept=="CPU-RDU"){
			$result=$this->db->query("SELECT r.code,r.description,SUM(s.quantity) AS quantity,s.rrno,s.unitcost,r.generic,r.capital,s.expiration,s.expiration FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE s.datearray BETWEEN '2021-07-01' AND '$rundate' AND r.unit LIKE '%$type%' AND s.dept='$dept' AND (r.description LIKE '%$searchme%' OR r.generic LIKE '%$searchme%') GROUP BY s.code ORDER BY r.description ASC");
		}else{
			$result=$this->db->query("SELECT r.code,r.description,SUM(s.quantity) AS quantity,s.rrno,s.unitcost,r.generic,r.capital,s.expiration FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE r.unit LIKE '%$type%' AND s.dept='$dept' AND (r.description LIKE '%$searchme%' OR r.generic LIKE '%$searchme%') GROUP BY s.code ORDER BY r.description ASC");
		}

		return $result->result_array();
	}
	public function getExpiration($code,$rrno){
		$result=$this->db->query("SELECT expiration FROM stocktablepayables WHERE `code`='$code'");
		return $result->row_array();
	}
	public function getUnitCost($code){
		//$st=$this->session->dept;
		$result=$this->db->query("SELECT capital as unitcost FROM receiving WHERE code='$code'");
		if($result->num_rows()>0){
			$uc=$result->row_array();
			return $uc;
		}
	}
	public function validate_save(){
		$department=$this->session->valdept;
		$rundate=$this->session->valdate;
		$type=$this->session->valtype;
		$code=$this->input->post('code');
		$quantity=$this->input->post('quantity');
		$soh=$this->input->post('soh');
		$unitcost=$this->input->post('unitcost');
		$expiration=$this->input->post('expiration');
		$date=date('M-d-Y');
		$datearray=date('Y-m-d');
		$nursename=$this->session->fullname;
		$diff_qty=$soh-$quantity;
		$oqty=abs($diff_qty);
		$timearray=date('H:i:s');
if($department=="CPU" || $department=="CSR" || $department=="CPU-RDU"){
		$rr=$this->db->query("SELECT *,SUM(quantity) as soh FROM stocktable WHERE `code`='$code' AND dept='$department' AND datearray >= '2021-07-01' GROUP BY rrno HAVING soh > 0");
}else{
		$rr=$this->db->query("SELECT *,SUM(quantity) as soh FROM stocktable WHERE `code`='$code' AND dept='$department' GROUP BY rrno HAVING soh > 0");

}
		$rrn=$rr->result_array();
		foreach($rrn as $rrno){
			if($diff_qty > 0){
				$rem_qty=$oqty-$rrno['soh'];
				if($oqty > 0){
					if($rem_qty > 0){
						$rqty=$rrno['soh']*(-1);			
						$result=$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$date','$rrno[rrno]','','','$department','$department','$code','$rrno[description]','$rrno[unitcost]','$rqty','0','$rrno[generic]','0','$rrno[expiration]','$rrno[lotno]','ADJUSTMENT','NONE','$date','$department','0.00','VALIDATION','','$nursename','$rrno[soh]','u','$rrno[duedate]','$rundate','$timearray')");
						$oqty=$rem_qty;
					}else{
						$rqty=$oqty*(-1);			
						$result=$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$date','$rrno[rrno]','','','$department','$department','$code','$rrno[description]','$rrno[unitcost]','$rqty','0','$rrno[generic]','0','$rrno[expiration]','$rrno[lotno]','ADJUSTMENT','NONE','$date','$department','0.00','VALIDATION','','$nursename','$rrno[soh]','u','$rrno[duedate]','$rundate','$timearray')");
						$oqty=0;
					}
				}
			}			
		}
		if($diff_qty < 0){
				$quantity=abs($diff_qty);
				$sql=$this->db->query("SELECT * FROM stocktablepayables WHERE code='$code' AND dept='$department' AND (trantype='charge' OR trantype='cash') GROUP BY rrno ORDER BY datearray DESC LIMIT 1");
				if($sql->num_rows()>0){
					$item=$sql->row_array();
					$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$date','$item[rrno]','','','$department','$department','$code','$item[description]','$unitcost','$quantity','0','$item[generic]','$quantity','$item[expiration]','$item[lotno]','ADJUSTMENT','NONE','$date','$department','0.00','VALIDATION','','$nursename','$soh','u','$item[duedate]','$rundate','$timearray')");
					$result=$this->db->query("INSERT INTO usermode values('$datearray','$time','$item[refno]','$department','$code','$unitcost','$quantity','BULK ADJUSTMENT','$nursename')");
				}else{
					$sql=$this->db->query("SELECT * FROM stocktable WHERE code='$code' AND dept='$department' AND (trantype='charge' OR trantype='cash') GROUP BY rrno ORDER BY datearray DESC LIMIT 1");
					$item=$sql->row_array();
					$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$date','$item[rrno]','','','$department','$department','$code','$item[description]','$unitcost','$quantity','0','$item[generic]','$quantity','$item[expiration]','$item[lotno]','ADJUSTMENT','NONE','$date','$department','0.00','VALIDATION','','$nursename','$soh','u','$item[duedate]','$rundate','$timearray')");
					$result=$this->db->query("INSERT INTO usermode values('$datearray','$time','$item[refno]','$department','$code','$unitcost','$quantity','BULK ADJUSTMENT','$nursename')");
				}
			}		
		return $result;
	}
	public function add_medicine(){
		$description=$this->input->post('description');
		$generic=$this->input->post('brand');
		$pnf=$this->input->post('pnf');
		$expiration=$this->input->post('expiration');
		$unitcost=$this->input->post('unitcost');
		$cash=$this->input->post('cash');
		$charge=$this->input->post('charge');
		$quantity=$this->input->post('quantity');
		$dept=$this->input->post('department');
		$form=$this->input->post('medform');
		$strength=$this->input->post('strength');
		$unit=$this->input->post('unit');
		$package=$this->input->post('package');
		$route=$this->input->post('route');
		$lotno=$this->input->post('pricescheme');
		$nursename=$this->session->fullname;
		if($pnf=="PNDF"){$pnfr="p";}
		else if($pnf=="NON-PNDF"){$pnfr="n";}
		$cd="kmsci-34-m-".date("ymdHis")."-15-".$pnfr;
		$this->db->query("INSERT INTO `receiving` (`code`, `description`, `capital`, `sellingprice`, `quantity`, `expiration`, `lotno`, `unit`, `generic`, `OPD`, `WARD`, `PRIVATE`, `SEMIPRIVATE`, `prodtype`, `soloward`, `package`, `ave`, `unitcost`, `aveconsole`, `SuppliesPricing`, `pnf`, `itemname`, `testcode`, `gtestcode`) VALUES ('$cd', '$description', '$unitcost', '$cash', '0', '$expiration', '$lotno', 'PHARMACY/MEDICINE', '$generic', '$cash', '$charge', '$charge', '$charge', 'PHARMACY/MEDICINE', '$charge', '$package', '$form', '$unit', '$strength', '$route', '$pnf', '$description', '0', '0')");
		$rrno="AUTO-".date("YmdHis");
		if($dept=="CPU" || $dept=="CSR" || $dept=="CPU-RDU"){
			$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('".date("M-d-Y")."', '$rrno', 'POROOO00000', '0981276345', 'AUTOGEN', 'AUTOGEN', '$cd', '$description', '$unitcost', '$quantity', '$quantity', '$generic', '$quantity', '$expiration', '$lotno', 'charge', '0', '".date("M-d-Y")."', '$dept', '0.00', 'NONE', '', '$nursename', '$quantity', 'u', '".date("Y-m-d")."', '".date("Y-m-d")."')");
		}else{
			$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('".date("M-d-Y")."', '$rrno', 'POROOO00000', '0981276345', 'AUTOGEN', 'AUTOGEN', '$cd', '$description', '$unitcost', '$quantity', '$quantity', '$generic', '$quantity', '$expiration', '$lotno', 'charge', '0', '".date("M-d-Y")."', '$dept', '0.00', 'NONE', '', '$nursename', '$quantity', 'u', '".date("Y-m-d")."', '".date("Y-m-d")."')");
			$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('".date("M-d-Y")."', '$rrno', 'POROOO00000', '0981276345', 'AUTOGEN', 'AUTOGEN', '$cd', '$description', '$unitcost', '0', '0', '$generic', '0', '$expiration', '$lotno', 'charge', '0', '".date("M-d-Y")."', 'CPU', '0.00', 'NONE', '', '$nursename', '$quantity', 'u', '".date("Y-m-d")."', '".date("Y-m-d")."')");
		}
		if($lotno=="S"){
			$result=$this->db->query("INSERT INTO `productsmasterlist` (`code`, `unitprice`, `philhealth`, `hmo`, `nonmed`, `company`, `opd`, `quantity`, `expiration`, `lotno`, `unit`, `generic`, `criticallevel`) VALUES ('$cd', '$unitcost', '$charge', '$charge', '$cash', '$charge', '$cash', '', '$expiration', '$lotno', 'PHARMACY/MEDICINE', '$generic', '')");
		}else{
			$result=$this->db->query("INSERT INTO `productsmasterlist` (`code`, `unitprice`, `philhealth`, `hmo`, `nonmed`, `company`, `opd`, `quantity`, `expiration`, `lotno`, `unit`, `generic`, `criticallevel`) VALUES ('$cd', '0', '0', '0', '0', '0', '0', '', '$expiration', '$lotno', 'PHARMACY/MEDICINE', '$generic', '')");
		}
		return $result;
	}
	public function update_medicine(){
		$st=$this->session->dept;
		$code=$this->input->post('code');
		$description=$this->input->post('description');
		$generic=$this->input->post('brand');
		$form=$this->input->post('medform');
		$strength=$this->input->post('strength');
		$unit=$this->input->post('unit');
		$package=$this->input->post('package');
		$route=$this->input->post('route');
		$lotno=$this->input->post('pricescheme');
		$itemname=$description." (".$generic.")";
		$nursename=$this->session->fullname;
		$result=$this->db->query("UPDATE receiving SET `description`='$description',generic='$generic',package='$package',ave='$form',unitcost='$unit',aveconsole='$strength',SuppliesPricing='$route',itemname='$itemname' WHERE `code`='$code'");
		$result=$this->db->query("UPDATE stocktable SET `description`='$description',generic='$generic' WHERE `code`='$code'");
		$result=$this->db->query("UPDATE productsmasterlist SET generic='$generic' WHERE `code`='$code'");
		return $result;
	}
	public function fetch_single_medicine($code){
		$result=$this->db->query("SELECT * FROM receiving WHERE code='$code'");
		return $result->result_array();
	}
	public function getAllProductType(){
		$result = $this->db->query("SELECT producttype FROM producttype WHERE producttype LIKE '%SUPPLIES%' ORDER BY producttype ASC");
		return $result->result_array();
	}
	public function add_supplies(){
		$description=$this->input->post('description');
		$pnf=$this->input->post('pnf');
		$expiration=$this->input->post('expiration');
		$unitcost=$this->input->post('unitcost');
		$cash=$this->input->post('cash');
		$charge=$this->input->post('charge');
		$quantity=$this->input->post('quantity');
		$dept=$this->input->post('department');
		$lotno=$this->input->post('pricescheme');
		$unit=$this->input->post('prodtype');
		$optset3=$this->input->post('optset3');
		$nursename=$this->session->fullname;
		$cd="SP".date("ymdHis").$pnfr."-48";
		$this->db->query("INSERT INTO `receiving` (`code`, `description`, `capital`, `sellingprice`, `quantity`, `expiration`, `lotno`, `unit`, `generic`, `OPD`, `WARD`, `PRIVATE`, `SEMIPRIVATE`, `prodtype`, `soloward`, `package`, `ave`, `unitcost`, `aveconsole`, `SuppliesPricing`, `pnf`, `itemname`, `testcode`, `gtestcode`, `optset3`) VALUES ('$cd', '$description', '$unitcost', '$cash', '0', '$expiration', '$lotno', '$unit', '', '$cash', '$charge', '$charge', '$charge', '$unit', '$charge', '', '', '', '', '0', '$pnf', '$description', '0', '0','$optset3')");
		$rrno="AUTO-".date("YmdHis");
		if($dept=="CPU" || $dept=="CSR" || $dept=="CPU-RDU"){
			$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('".date("M-d-Y")."', '$rrno', 'POROOO00000', '0981276345', 'AUTOGEN', 'AUTOGEN', '$cd', '$description', '$unitcost', '$quantity', '$quantity', '$generic', '$quantity', '$expiration', '$lotno', 'charge', '0', '".date("M-d-Y")."', '$dept', '0.00', 'NONE', '', '$nursename', '$quantity', 'u', '".date("Y-m-d")."', '".date("Y-m-d")."')");
		}else{
			$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('".date("M-d-Y")."', '$rrno', 'POROOO00000', '0981276345', 'AUTOGEN', 'AUTOGEN', '$cd', '$description', '$unitcost', '$quantity', '$quantity', '$generic', '$quantity', '$expiration', '$lotno', 'charge', '0', '".date("M-d-Y")."', '$dept', '0.00', 'NONE', '', '$nursename', '$quantity', 'u', '".date("Y-m-d")."', '".date("Y-m-d")."')");
			$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('".date("M-d-Y")."', '$rrno', 'POROOO00000', '0981276345', 'AUTOGEN', 'AUTOGEN', '$cd', '$description', '$unitcost', '$quantity', '$quantity', '$generic', '$quantity', '$expiration', '$lotno', 'charge', '0', '".date("M-d-Y")."', 'CSR', '0.00', 'NONE', '', '$nursename', '$quantity', 'u', '".date("Y-m-d")."', '".date("Y-m-d")."')");
		}
		if($lotno=="S"){
			$result=$this->db->query("INSERT INTO `productsmasterlist` (`code`, `unitprice`, `philhealth`, `hmo`, `nonmed`, `company`, `opd`, `quantity`, `expiration`, `lotno`, `unit`, `generic`, `criticallevel`) VALUES ('$cd', '$unitcost', '$charge', '$charge', '$cash', '$charge', '$cash', '', '$expiration', '$lotno', '$unit', '$generic', '')");
		}else{
			$result=$this->db->query("INSERT INTO `productsmasterlist` (`code`, `unitprice`, `philhealth`, `hmo`, `nonmed`, `company`, `opd`, `quantity`, `expiration`, `lotno`, `unit`, `generic`, `criticallevel`) VALUES ('$cd', '0', '0', '0', '0', '0', '0', '', '$expiration', '$lotno', '$unit', '$generic', '')");
		}
		return $result;
	}
	public function update_supplies(){
		$code=$this->input->post('code');
		$description=$this->input->post('description');
		$prodtype=$this->input->post('prodtype');
		$optset3=$this->input->post('optset3');
		$nursename=$this->session->fullname;
		$itemname=$description;
		$result=$this->db->query("UPDATE receiving SET `description`='$description',prodtype='$prodtype',itemname='$itemname',optset3='$optset3' WHERE `code`='$code'");
		$result=$this->db->query("UPDATE stocktable SET `description`='$description' WHERE `code`='$code'");
		return $result;
	}
	public function save_supplier($suppliercode){
		$code=$this->input->post('code');
		$suppliername=$this->input->post('suppliername');
		$address=$this->input->post('address');
		$tin=$this->input->post('tin');
		$status=$this->input->post('status');
		if($code=="") {
			$result = $this->db->query("INSERT INTO supplierscsr(suppliercode,suppliername,`address`,tin,`status`) VALUES('$suppliercode','$suppliername','$address','$tin','$status')");
		}else{
			$result=$this->db->query("UPDATE supplierscsr SET suppliername='$suppliername',`address`='$address',tin='$tin',`status`='$status' WHERE suppliercode='$suppliercode'");
		}
		return $result;
	}
	public function deleteSupplier($param){
		$result=$this->db->query("DELETE FROM supplierscsr WHERE autono='$param'");
		return $result;
	}
	public function fetch_single_supplier($code){
		$result=$this->db->query("SELECT * FROM supplierscsr WHERE suppliercode='$code'");
		return $result->result_array();
	}
	public function getAllKitAssembly(){
		$st=$this->session->dept;
		$result=$this->db->query("SELECT r.code,r.itemname,r.capital as unitcost,p.philhealth,p.nonmed,r.description FROM receiving r INNER JOIN stocktable s ON s.code=r.code INNER JOIN productsmasterlist p ON p.code=r.code WHERE r.prodtype='KIT SUPPLIES' AND s.dept='$st' GROUP BY s.code LIMIT 5");
		return $result->result_array();
	}
	public function getAllKitItems($code){
		$result=$this->db->query("SELECT k.*,ka.* FROM kitassembly k INNER JOIN kitassemblydetails ka ON ka.id=k.id WHERE k.id='".$code."'");
		return $result->result_array();
	}
	public function getSingleKitAssembly($description){
		$st=$this->session->dept;
		$result=$this->db->query("SELECT r.code,r.itemname,s.unitcost,p.philhealth,p.nonmed,r.description FROM receiving r INNER JOIN stocktable s ON s.code=r.code INNER JOIN productsmasterlist p ON p.code=r.code WHERE r.prodtype='KIT SUPPLIES' AND s.dept='$st' AND r.description LIKE '%$description%' GROUP BY s.code");
		return $result->result_array();
	}
	public function save_kit_assembly(){
		$st=$this->session->dept;
		$pdesc=$this->input->post('description');
		$unitcost=$this->input->post('unitcost');
		$phic=$this->input->post('phic');
		$opd=$this->input->post('opd');
		$code=$this->input->post('code');
		$time=date('H:i:s');
		if($code==""){
			$getcode=$this->db->query("SELECT MAX(id) AS code FROM kitassembly");
			$pcode=$getcode->row_array();
			$code=$pcode['code']+1;
			$this->db->query("INSERT INTO kitassembly(id,description,unitcost,sellingpricePHIC,sellingpriceOPD) VALUES('$code','$pdesc','$unitcost','$phic','$opd')");
			$refno = date('YmdHis');
			$date = date('M-d-Y');
			$datearray = date('Y-m-d');
			$time = date('H:i:s');
			$result=$this->db->query("INSERT INTO receiving(code,`description`,capital,sellingprice,quantity,lotno,unit,generic,OPD,prodtype,soloward,package,ave,unitcost,aveconsole,SuppliesPricing,pnf,itemname,testcode,gtestcode) VALUES('$code','$pdesc','$unitcost','$phic','1','S','PHARMACY/SUPPLIES','KIT SUPPLIES','$opd','KIT SUPPLIES','0','0','0','$unitcost','0','0','0','$pdesc','0','0')");
			$result=$this->db->query("INSERT INTO productsmasterlist(code,unitprice,philhealth,hmo,nonmed,company,opd,quantity,expiration,lotno,unit,generic,criticallevel) VALUES('$code','$unitcost','$phic','$phic','$opd','$opd','$opd','','','S','','$description','0')");
			$result=$this->db->query("INSERT INTO stocktable(`date`,rrno,invno,suppliercode,suppliername,code,description,unitcost,quantity,recdqty,statquantity,expiration,trantype,terms,transdate,dept,prodtype1,paymentstatus,receivinguser,stockalert,duedate,datearray,timearray) VALUES('$date','$refno','','$st','$st','$code','$pdesc','$unitcost','1','0','1','0000-00-00','KIT ASSEMBLY','NONE','$date','$st','0','NONE','','u','$time','$datearray','$time')");
		}else{
			$result=$this->db->query("UPDATE kitassembly SET `description`='$pdesc',unitcost='$unitcost',sellingpricePHIC='$phic',sellingpriceOPD='$opd' WHERE id='$code'");
			$result=$this->db->query("UPDATE receiving SET `description`='$pdesc',capital='$unitcost',sellingprice='$phic',OPD='$opd',unitcost='$unitcost',itemname='$pdesc' WHERE code='$code'");
			$result=$this->db->query("UPDATE productsmasterlist SET unitprice='$unitcost',philhealth='$phic',hmo='$phic',nonmed='$opd',company='$opd',opd='$opd' WHERE code='$code'");
			$result=$this->db->query("UPDATE stocktable SET `description`='$pdesc',unitcost='$unitcost',dept='$st' WHERE code='$code'");
		}
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function addkitquantity($refno){
		$st=$this->session->dept;
		$date=date('M-d-Y');
		$datearray=date('Y-m-d');
		$time=date('H:i:s');
		$nursename=$this->session->fullname;
		$code=$this->input->post('code');
		$quantity=$this->input->post('quantity');
		$checkqty=$this->db->query("SELECT * FROM kitassemblydetails WHERE id='$code'");
		$availqty=$checkqty->result_array();
		$count=0;
		foreach($availqty as $chkqty){
			$tqty=$chkqty['productqty']*$quantity;
			$checkremqty=$this->db->query("SELECT SUM(quantity) as soh FROM stocktable WHERE code='$chkqty[productcode]' AND dept='$st' AND datearray >='2021-07-01'");
			$resqty=$checkremqty->row_array();
			if($tqty > $resqty['soh']){
				$count++;
			}
		}
		if($count==0){
			$unitcost=0;
			foreach($availqty as $item){
				$tqty=$item['productqty']*$quantity;
				$desc=$item['productdesc'];
				$pcode=$item['productcode'];
				$ucost=$this->db->query("SELECT unitcost FROM stocktable WHERE code='$pcode' AND dept='$st'");
				$uc=$ucost->row_array();
				$unitcost=$uc['unitcost'];
				$result=$this->db->query("INSERT INTO stocktable(`date`,rrno,invno,suppliercode,suppliername,`code`,`description`,unitcost,quantity,recdqty,statquantity,expiration,trantype,terms,transdate,dept,prodtype1,paymentstatus,receivinguser,stockalert,duedate,datearray,timearray) VALUES('$date','$refno','','$st','$st','$pcode','$desc','$unitcost','-$tqty','0','$tqty','0000-00-00','KIT ASSEMBLY','NONE','$date','$st','0','NONE','$nursename','u','$time','$datearray','$time')");

				$this->db->query("INSERT INTO kitassemblyreference(refno,`code`,itemcode,itemquantity,quantity,datearray,user) VALUES('$refno','$code','$pcode','$tqty','$quantity','$datearray','$nursename')");
			}
			$newqty=$this->db->query("SELECT * FROM receiving WHERE code='$code'");
			$resnqty=$newqty->row_array();
			$pdesc=$resnqty['description'];
			$result=$this->db->query("INSERT INTO stocktable(`date`,rrno,invno,suppliercode,suppliername,`code`,`description`,unitcost,quantity,recdqty,statquantity,expiration,trantype,terms,transdate,dept,prodtype1,paymentstatus,receivinguser,stockalert,duedate,datearray,timearray) VALUES('$date','$refno','','$st','$st','$code','$pdesc','$unitcost','$quantity','0','$quantity','0000-00-00','KIT ASSEMBLY','NONE','$date','$st','0','NONE','$nursename','u','$time','$datearray','$time')");
			return $result;
		}else{
			return false;
		}
	}
	public function getAllKitHead($code){
		$result=$this->db->query("SELECT k.* FROM kitassembly k WHERE k.id='".$code."'");
		return $result->result_array();
	}
	public function kitadditem(){
		$st=$this->session->dept;
		$code=$this->input->post('code');
		$soh=$this->input->post('soh');
		$itemcode=$this->input->post('itemcode');
		$itemdesc=$this->input->post('itemdesc');
		$quantity=$this->input->post('quantity');
		$totalqty=$soh*$quantity;
		$refno=date('YmdHis');
		$date=date('M-d-Y');
		$datearray=date('Y-m-d');
		$time=date('H:i:s');
		$nursename=$this->session->fullname;
		$checkqty=$this->db->query("SELECT SUM(quantity) as soh,unitcost FROM stocktable WHERE code='$itemcode' AND dept='$st' AND datearray >= '2021-07-01'");
		$availqty=$checkqty->row_array();
		$itemcost=$availqty['unitcost'];
		if($totalqty > $availqty['soh']){
			return false;
		}else{
			$result=$this->db->query("INSERT INTO stocktable(`date`,rrno,invno,suppliercode,suppliername,code,description,unitcost,quantity,recdqty,statquantity,expiration,trantype,terms,transdate,dept,prodtype1,paymentstatus,receivinguser,stockalert,duedate,datearray,timearray) VALUES('$date','$refno','','CPU','CPU','$itemcode','$itemdesc','$itemcost','-$totalqty','0','$totalqty','0000-00-00','KIT ASSEMBLY','NONE','$date','$st','0','NONE','$nursename','u','$time','$datearray','$time')");
			$checkexist=$this->db->query("SELECT * FROM kitassemblydetails WHERE id='$code' AND productcode='$itemcode'");
			if($checkexist->num_rows()>0){
				$exist=$checkexist->row_array();
				$newqty=$exist['productqty']+$totalqty;
				$result=$this->db->query("UPDATE kitassemblydetails SET productqty='$newqty' WHERE id='$code' AND productcode='$itemcode'");
			}else{
				$result=$this->db->query("INSERT INTO kitassemblydetails(id,productcode,productdesc,productqty) VALUES('$code','$itemcode','$itemdesc','$quantity')");
			}
			return $result;
		}
	}
	public function kitdeleteitem($code,$soh,$autono){
		$st=$this->session->dept;
		$refno=date('YmdHis');
		$date=date('M-d-Y');
		$datearray=date('Y-m-d');
		$time=date('H:i:s');
		$nursename=$this->session->fullname;
		$checkqty=$this->db->query("SELECT * FROM kitassemblydetails WHERE autono='$autono'");
		$availqty=$checkqty->row_array();
		$totalqty=$soh*$availqty['productqty'];
		$desc=$availqty['productdesc'];
		$pcode=$availqty['productcode'];
		$ucost=$this->db->query("SELECT unitcost FROM stocktable WHERE code='$pcode'");
		$uc=$ucost->row_array();
		$unitcost=$uc['unitcost'];
		$result=$this->db->query("INSERT INTO stocktable(`date`,rrno,invno,suppliercode,suppliername,code,description,unitcost,quantity,recdqty,statquantity,expiration,trantype,terms,transdate,dept,prodtype1,paymentstatus,receivinguser,stockalert,duedate,datearray,timearray) VALUES('$date','$refno','','$st','$st','$pcode','$desc','$unitcost','$totalqty','0','$totalqty','0000-00-00','KIT ASSEMBLY','NONE','$date','$st','0','NONE','$nursename','u','$time','$datearray','$time')");
		$result=$this->db->query("DELETE FROM kitassemblydetails WHERE autono='$autono'");
		return $result;
	}
	public function getAllItemsProduction($type){
		$st=$this->session->dept;
		$result = $this->db->query("SELECT r.*,SUM(s.quantity) as quantity FROM production r INNER JOIN stocktable s ON s.code=r.code WHERE r.type='$type' AND s.dept='$st' AND s.datearray >= '2021-07-01' GROUP BY s.code");
		return $result->result_array();
	}
	public function getAllProductions($code){
		$st=$this->session->dept;
		$result = $this->db->query("SELECT p.prodcode,p.proddesc FROM production p WHERE p.prodcode='$code' GROUP BY p.prodcode");
		return $result->row_array();
	}
	public function getAllProductionsQty($code){
		$st=$this->session->dept;
		$result = $this->db->query("SELECT SUM(quantity) as soh FROM stocktable WHERE code='$code' AND dept='$st' AND datearray >= '2021-07-01'");
		return $result->row_array();
	}
	public function getItemsProduction($code){
		$result=$this->db->query("SELECT * FROM production WHERE code='$code'");
		return $result->row_array();
	}
	public function save_production_gloves(){
		$dept=$this->session->dept;
		$code=$this->input->post('code');
		$box=$this->input->post('box');
		$itemdesc=$this->db->query("SELECT * FROM stocktable WHERE code='$code'");
		$itembox=$itemdesc->row_array();
		$rrno=$itembox['rrno'];
		$description=$itembox['description'];
		$unitcost=$itembox['unitcost'];
		$generic=$itembox['generic'];
		$expiration=$itembox['expiration'];
		$lotno=$itembox['lotno'];
		$transdate=date('M-d-Y');
		$prodtype1=$itembox['prodtype1'];
		$datearray=date('Y-m-d');
		$time=date('H:i:s');
		$nursename=$this->session->fullname;
		$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$transdate','$rrno','','','$dept','$dept','$code','$description','$unitcost','-$box','0','','$box','$expiration','$lotno','PRODUCTION','NONE','$transdate','$dept','$prodtype1','NONE','','$nursename','','u','$time','$datearray','$time')");
		$prodcode=$this->input->post('prodcode');
		$prodqty=$box*50;
		$itemdesc=$this->db->query("SELECT * FROM stocktable WHERE code='$prodcode'");
		$itembox=$itemdesc->row_array();
		$rrno=$itembox['rrno'];
		$description=$itembox['description'];
		$unitcost=$itembox['unitcost'];
		$generic=$itembox['generic'];
		$expiration=$itembox['expiration'];
		$lotno=$itembox['lotno'];
		$transdate=date('M-d-Y');
		$prodtype1=$itembox['prodtype1'];
		$datearray=date('Y-m-d');
		$time=date('H:i:s');
		$nursename=$this->session->fullname;
		$result=$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$transdate','$rrno','','','$dept','$dept','$prodcode','$description','$unitcost','$prodqty','0','','$prodqty','$expiration','$lotno','PRODUCTION','NONE','$transdate','$dept','$prodtype1','NONE','','$nursename','','u','$time','$datearray','$time')");
		return $result;
	}
	public function save_production_alcohol(){
		$dept=$this->session->dept;
		$code=$this->input->post('code');
		$box=$this->input->post('box');
		$bottle=$this->input->post('bottle');
		if($bottle >= 6 && $box > 0){
			$itemdesc=$this->db->query("SELECT * FROM stocktable WHERE code='$code'");
			$itembox=$itemdesc->row_array();
			$rrno=$itembox['rrno'];
			$description=$itembox['description'];
			$unitcost=$itembox['unitcost'];
			$generic=$itembox['generic'];
			$expiration=$itembox['expiration'];
			$lotno=$itembox['lotno'];
			$transdate=date('M-d-Y');
			$prodtype1=$itembox['prodtype1'];
			$datearray=date('Y-m-d');
			$time=date('H:i:s');
			$nursename=$this->session->fullname;
			$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$transdate','$rrno','','','$dept','$dept','$code','$description','$unitcost','-$box','0','','$box','$expiration','$lotno','PRODUCTION','NONE','$transdate','$dept','$prodtype1','NONE','','$nursename','','u','$time','$datearray','$time')");
			$prodcode=$this->input->post('prodcode');
			$prodqty=$box*50;
			$itemdesc=$this->db->query("SELECT * FROM stocktable WHERE code='$prodcode'");
			$itembox=$itemdesc->row_array();
			$rrno=$itembox['rrno'];
			$description=$itembox['description'];
			$unitcost=$itembox['unitcost'];
			$generic=$itembox['generic'];
			$expiration=$itembox['expiration'];
			$lotno=$itembox['lotno'];
			$transdate=date('M-d-Y');
			$prodtype1=$itembox['prodtype1'];
			$datearray=date('Y-m-d');
			$time=date('H:i:s');
			$nursename=$this->session->fullname;
			$result=$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$transdate','$rrno','','','$dept','$dept','$prodcode','$description','$unitcost','$bottle','0','','$bottle','$expiration','$lotno','PRODUCTION','NONE','$transdate','$dept','$prodtype1','NONE','','$nursename','','u','$time','$datearray','$time')");
			return $result;
		}else{
			return false;
		}
	}
	public function save_production_os(){
		$dept=$this->session->dept;
		$code=$this->input->post('code');
		$osqty=$this->input->post('osqty');
		$opqty=$this->input->post('opqty');
		$itemdesc=$this->db->query("SELECT * FROM stocktable WHERE code='$code' GROUP BY code");
		$itembox=$itemdesc->row_array();
		$rrno=$itembox['rrno'];
		$description=$itembox['description'];
		$unitcost=$itembox['unitcost'];
		$generic=$itembox['generic'];
		$expiration=$itembox['expiration'];
		$lotno=$itembox['lotno'];
		$transdate=date('M-d-Y');
		$prodtype1=$itembox['prodtype1'];
		$datearray=date('Y-m-d');
		$time=date('H:i:s');
		$nursename=$this->session->fullname;
		$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$transdate','$rrno','','','$dept','$dept','$code','$description','$unitcost','-$osqty','0','','$osqty','$expiration','$lotno','PRODUCTION','NONE','$transdate','$dept','$prodtype1','NONE','','$nursename','','u','$time','$datearray','$time')");
		$prodcode=$this->input->post('prodcode');		
		$itemdesc=$this->db->query("SELECT * FROM stocktable WHERE code='$prodcode'");
		$itembox=$itemdesc->row_array();
		$rrno=$itembox['rrno'];
		$description=$itembox['description'];
		$unitcost=$itembox['unitcost'];
		$generic=$itembox['generic'];
		$expiration=$itembox['expiration'];
		$lotno=$itembox['lotno'];
		$transdate=date('M-d-Y');
		$prodtype1=$itembox['prodtype1'];
		$datearray=date('Y-m-d');
		$time=date('H:i:s');
		$nursename=$this->session->fullname;
		$result=$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$transdate','$rrno','','','$dept','$dept','$prodcode','$description','$unitcost','$opqty','0','','$opqty','$expiration','$lotno','PRODUCTION','NONE','$transdate','$dept','$prodtype1','NONE','','$nursename','','u','$time','$datearray','$time')");
		return $result;
	}
	public function getBOD(){
		$result=$this->db->query("SELECT * FROM docfile WHERE code='100142' OR code='100143' OR code='100216' OR code='100075' OR code='100184' ORDER BY lastname ASC");
		return $result->result_array();
	}
	public function getSingleChargeBodByDate($startdate,$enddate){
		$st=$this->session->dept;
		$result=$this->db->query("SELECT * FROM stocktabletransfer WHERE datearray BETWEEN '$startdate' AND '$enddate' AND trantype LIKE '%CHARGE TO%' AND dept='$st' GROUP BY po ORDER by datearray DESC");
		return $result->result_array();
	}
	public function getSingleChargeBOD($branch,$startdate,$enddate){
		$st=$this->session->dept;
		$result=$this->db->query("SELECT * FROM stocktabletransfer WHERE datearray BETWEEN '$startdate' AND '$enddate' AND trantype LIKE '%$branch%' AND dept='$st' AND po LIKE '%BOD%' GROUP BY po ORDER by datearray DESC");
		return $result->result_array();
	}
	// public function getSingleChargeBodAll($branch,$startdate,$enddate){
    //         $st=$this->session->dept;
    //         $result=$this->db->query("SELECT * FROM stocktabletransfer WHERE datearray BETWEEN '$startdate' AND '$enddate' AND trantype LIKE '%$branch%' AND dept='$st' GROUP BY isid ORDER by datearray DESC");
    //         return $result->result_array();
    //     }
	public function getSingleChargeBodReport($isid){
		$st=$this->session->dept;
		$result=$this->db->query("SELECT * FROM stocktabletransfer WHERE isid='$isid' AND dept='$st'");
		return $result->result_array();
	}
	public function getStockTransferBranch($invno){
		$result=$this->db->query("SELECT *,SUM(quantity) as quantity FROM stocktabletransfer WHERE invno='$invno' AND isid='' GROUP BY expiration,code,paymentstatus,unitcost");
		return $result->result_array();
	}
	public function bodadditem(){
		$department=$this->session->dept;
		$invno=$this->session->invno;
		$branch=$this->session->branch;
		$nursename=$this->session->fullname;
		$quantity=$this->input->post('quantity');
		$unitcost=$this->input->post('unitcost');
		$code=$this->input->post('code');
		$expiration=$this->input->post('expiration');
		$lotno=$this->input->post('lotno');
		$unit=$this->input->post('unit');
		$description=$this->input->post('description');
		$po=$invno;
		$itemdesc=$this->db->query("SELECT *,SUM(quantity) as quantity FROM stocktable WHERE code='$code' AND dept='$department' AND datearray >='2021-07-01' GROUP BY code");
		$resitemdesc=$itemdesc->row_array();
		$rrno=$resitemdesc['rrno'];
		$supplier=$resitemdesc['suppliername'];
		$generic=$resitemdesc['generic'];
		$due=$resitemdesc['duedate'];
		$date=date('M-d-Y');
		$datearray=date('Y-m-d');
		$time=date('H:i:s');
		$qty1=$resitemdesc['quantity'];
		if($department=='CPU' || $department=='CSR'){
			$supplier='KMSCI STOCKS';
		}
		$itemqty=$this->db->query("SELECT SUM(quantity) as quantity FROM stocktable WHERE code='$code' AND dept='$department' AND datearray >='2021-07-01' GROUP BY code");
		$resitemqty=$itemqty->row_array();
		$chk1=$this->db->query("SELECT * FROM stocktabletransfer WHERE code='$code' AND invno='$invno'");
		$reschk=$chk1->row_array();
		$qty2=$reschk['quantity'];
		$qtytotal=$qty2+$quantity;
		if($qtytotal>$qty1){
			return false;
		}else{
			$chk=$this->db->query("SELECT * FROM stocktabletransfer WHERE code='$code' AND invno='$invno'");
			if($chk->num_rows()>0){
				$reschk=$chk->row_array();
				$newqty=$quantity+$reschk['quantity'];
				$result=$this->db->query("UPDATE stocktabletransfer SET quantity='$newqty' WHERE code='$code' AND invno='$invno'");
			}else{
				$result=$this->db->query("INSERT INTO stocktabletransfer(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray) VALUES('$date','$rrno','$po','$invno','$supplier','$supplier','$code','$description','$unitcost','$quantity','0','$generic','$quantity','$expiration','$lotno','CHARGE TO $branch','NONE','$date','$department','0.00','$unit','','$nursename','$qty1','u','$due','$datearray')");
			}
			return $result;
		}
	}
	public function transferremoveitem($param){
		$result=$this->db->query("DELETE FROM stocktabletransfer WHERE autono='$param'");
		return true;
	}
	public function postchargebod($invno){
		$department=$this->session->dept;
		$branch=$this->session->branch;
		$items=$this->db->query("SELECT * FROM stocktabletransfer WHERE invno='$invno' AND isid=''");
		if($items->num_rows()>0){
			$iteme=$items->result_array();
			foreach($iteme as $item){
				$autono=$item['autono'];
				$description=$item['description'];
				$code=$item['code'];
				$unitcost=$item['unitcost'];
				$quantity=$item['quantity'];
				$expiration=$item['expiration'];
				$lotno=$item['lotno'];
				$po=$item['po'];
				$rrno=$item['rrno'];
				$generic=$item['generic'];
				$qty=$item['prevqty'];
				$due=$item['duedate'];
				$nursename=$item['receivinguser'];
				$date=date('M-d-Y');
				$datearray=date('Y-m-d');
				$time=date('H:i:s');
				$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$date','$rrno','$po','$invno','$department','$department','$code','$description','$unitcost','-$quantity','0','$generic','$quantity','$expiration','$lotno','CHARGE TO $branch','NONE','$date','$department','0.00','NONE','$invno','$nursename','$qty','u','$due','$datearray','$time')");
				$this->db->query("INSERT INTO usermode(`date`,`time`,refno,caseno,productcode,amount,quantity,reasons,user) VALUES('$datearray','$time','$rrno','$department','$code','$unitcost','$quantity','TRANSFER TO $branch','$nursename')");
				$result=$this->db->query("UPDATE stocktabletransfer SET isid='$invno' WHERE autono='$autono'");
			}
			return $result;
		}else{
			return false;
		}
	}
	public function getDepartmentReturn(){
		$st=$this->session->dept;
		$result=$this->db->query("SELECT * FROM purchaseorder WHERE status='transfer' AND reqdept='$st' GROUP BY reqno ORDER BY reqdate DESC");
		return $result->result_array();
	}
	public function getDepartmentReturnItems($reqno){
		$st=$this->session->dept;
		$result=$this->db->query("SELECT * FROM purchaseorder WHERE status='transfer' AND reqdept='$st' AND reqno='$reqno'");
		return $result->result_array();
	}
	public function getDepartmentReturnDetails($reqno){
		$st=$this->session->dept;
		$result=$this->db->query("SELECT * FROM purchaseorder WHERE status='transfer' AND reqdept='$st' AND reqno='$reqno' GROUP BY reqno ORDER BY reqdate DESC");
		return $result->row_array();
	}
	public function getQtyPharma($code,$dept){
		$result=$this->db->query("SELECT SUM(quantity) as soh FROM stocktable WHERE code='$code' AND dept='$dept'");
		return $result->row_array();
	}
	public function return_items($rrdetails,$issuedqty){
		$issuinguser=$this->session->fullname;
		$item=$this->db->query("SELECT * FROM purchaseorder WHERE rrdetails='$rrdetails' AND `status`='transfer'");
		$itemresult=$item->row_array();
		$remqty=$itemresult['prodqty']-$issuedqty;
		$nqty=$issuedqty;
		$iqty=$issuedqty;
		if($remqty > 0){
			$this->db->query("INSERT INTO purchaseorder(rrno,transdate,supplier,suppliercode,terms,trantype,code,`description`,unitcost,generic,prodqty,dept,`status`,prodtype1,po,user,approvingofficer,reqdept,reqno,reqdate,requser) VALUES('','$itemresult[transdate]','$itemresult[suppliername]','$itemresult[suppliercode]','$itemresult[terms]','$itemresult[trantype]','$itemresult[code]','$itemresult[description]','$itemresult[unitcost]','$itemresult[transdate]','$remqty','$itemresult[dept]','cancel return','$itemresult[prodtype1]','$itemresult[po]','$itemresult[user]','$itemresult[approvingofficer]','$itemresult[reqdept]','$itemresult[reqno]','$itemresult[reqdate]','$itemresult[requser]')");
			$this->db->query("UPDATE purchaseorder SET prodqty='$iqty',`status`='return',user='$issuinguser',transdate='".date("Y-m-d")."' WHERE rrdetails='$rrdetails'");
			$subitem=$this->db->query("SELECT rrno,generic FROM stocktable WHERE code='$itemresult[code]' AND dept='$itemresult[dept]' GROUP BY rrno HAVING SUM(quantity) > 0 ");
			$subitemresult=$subitem->result_array();
			foreach($subitemresult AS $item){
				$itemqty=$this->db->query("SELECT SUM(quantity) AS rrsoh, unitcost, expiration, lotno, trantype FROM stocktable WHERE rrno='".$item['rrno']."' AND code='$itemresult[code]' AND dept='$itemresult[dept]'");
				$itemqtyresult=$itemqty->row_array();
				if($nqty>0 && $itemqtyresult['rrsoh']>0){
					if($itemqtyresult['rrsoh']>=$nqty){
						$result=$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('".date("M-d-Y")."','".$item['rrno']."','','','$itemresult[dept]','$itemresult[dept]','$itemresult[code]','$itemresult[description]','".$itemqtyresult['unitcost']."','$nqty','$nqty','$item[generic]','$issuedqty','".$itemqtyresult['expiration']."','".$itemqtyresult['lotno']."','DEPARTMENT RETURN','NONE','$itemresult[transdate]','$itemresult[reqdept]','','NONE','$itemresult[reqno]','$itemresult[requser]','','u','".date("H:i:s")."','".date("Y-m-d")."')");
						$result=$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('".date("M-d-Y")."','".$item['rrno']."','','','$itemresult[reqdept]','$itemresult[reqdept]','$itemresult[code]','$itemresult[description]','".$itemqtyresult['unitcost']."','-$nqty','$nqty','$item[generic]','$issuedqty','".$itemqtyresult['expiration']."','".$itemqtyresult['lotno']."','DEPARTMENT RETURN','NONE','$itemresult[transdate]','$itemresult[dept]','','NONE','$itemresult[reqno]','$itemresult[requser]','','u','".date("H:i:s")."','".date("Y-m-d")."')");
						$nqty=0;
					}else{
						$result=$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('".date("M-d-Y")."','".$item['rrno']."','','','$itemresult[dept]','$itemresult[dept]','$itemresult[code]','$itemresult[description]','".$itemqtyresult['unitcost']."','$itemqtyresult[rrsoh]','$itemqtyresult[rrsoh]','$item[generic]','$issuedqty','".$itemqtyresult['expiration']."','".$itemqtyresult['lotno']."','DEPARTMENT RETURN','NONE','$itemresult[transdate]','$itemresult[reqdept]','','NONE','$itemresult[reqno]','$itemresult[requser]','','u','".date("H:i:s")."','".date("Y-m-d")."')");
						$result=$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('".date("M-d-Y")."','".$item['rrno']."','','','$itemresult[reqdept]','$itemresult[reqdept]','$itemresult[code]','$itemresult[description]','".$itemqtyresult['unitcost']."','-$itemqtyresult[rrsoh]','$itemqtyresult[rrsoh]','$item[generic]','$issuedqty','".$itemqtyresult['expiration']."','".$itemqtyresult['lotno']."','DEPARTMENT RETURN','NONE','$itemresult[transdate]','$itemresult[dept]','','NONE','$itemresult[reqno]','$itemresult[requser]','','u','".date("H:i:s")."','".date("Y-m-d")."')");
						$nqty=$nqty-$itemqtyresult['rrsoh'];
					}
				}
			}
		}elseif($remqty < 0){
			return false;
		}else{
			$this->db->query("UPDATE purchaseorder SET `status`='return',user='$issuinguser',transdate='".date("Y-m-d")."' WHERE rrdetails='$rrdetails'");
			$subitem=$this->db->query("SELECT rrno,generic FROM stocktable WHERE code='$itemresult[code]' AND dept='$itemresult[dept]' GROUP BY rrno HAVING SUM(quantity) > 0");
			$subitemresult=$subitem->result_array();
			foreach($subitemresult AS $item){
				$itemqty=$this->db->query("SELECT SUM(quantity) AS rrsoh, unitcost, expiration, lotno, trantype FROM stocktable WHERE rrno='".$item['rrno']."' AND code='$itemresult[code]' AND dept='$itemresult[dept]'");
				$itemqtyresult=$itemqty->row_array();
				if($itemqtyresult['rrsoh']>0&&$nqty>0){
					if($itemqtyresult['rrsoh']>=$nqty){
						$result=$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('".date("M-d-Y")."','".$item['rrno']."','','','$itemresult[dept]','$itemresult[dept]','$itemresult[code]','$itemresult[description]','".$itemqtyresult['unitcost']."','$nqty','$nqty','$item[generic]','$nqty','".$itemqtyresult['expiration']."','".$itemqtyresult['lotno']."','DEPARTMENT RETURN','NONE','$itemresult[transdate]','$itemresult[reqdept]','','NONE','$itemresult[reqno]','$itemresult[requser]','','u','".date("H:i:s")."','".date("Y-m-d")."')");
						$result=$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('".date("M-d-Y")."','".$item['rrno']."','','','$itemresult[reqdept]','$itemresult[reqdept]','$itemresult[code]','$itemresult[description]','".$itemqtyresult['unitcost']."','-$nqty','$nqty','$item[generic]','-$nqty','".$itemqtyresult['expiration']."','".$itemqtyresult['lotno']."','DEPARTMENT RETURN','NONE','$itemresult[transdate]','$itemresult[dept]','','NONE','$itemresult[reqno]','$itemresult[requser]','','u','".date("H:i:s")."','".date("Y-m-d")."')");
						$nqty=0;
					}else{
						$result=$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('".date("M-d-Y")."','".$item['rrno']."','','','$itemresult[dept]','$itemresult[dept]','$itemresult[code]','$itemresult[description]','".$itemqtyresult['unitcost']."','$itemqtyresult[rrsoh]','$itemqtyresult[rrsoh]','$item[generic]','$issuedqty','".$itemqtyresult['expiration']."','".$itemqtyresult['lotno']."','DEPARTMENT RETURN','NONE','$itemresult[transdate]','$itemresult[reqdept]','','NONE','$itemresult[reqno]','$itemresult[requser]','','u','".date("H:i:s")."','".date("Y-m-d")."')");
						$result=$this->db->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('".date("M-d-Y")."','".$item['rrno']."','','','$itemresult[reqdept]','$itemresult[reqdept]','$itemresult[code]','$itemresult[description]','".$itemqtyresult['unitcost']."','-$itemqtyresult[rrsoh]','$itemqtyresult[rrsoh]','$item[generic]','$issuedqty','".$itemqtyresult['expiration']."','".$itemqtyresult['lotno']."','DEPARTMENT RETURN','NONE','$itemresult[transdate]','$itemresult[dept]','','NONE','$itemresult[reqno]','$itemresult[requser]','','u','".date("H:i:s")."','".date("Y-m-d")."')");
						$nqty=$nqty-$itemqtyresult['rrsoh'];
					}
				}else{
					$nqty=$nqty;
				}
			}
		}
		return $result;
	}
	public function getDepartmentReturned(){
		$st=$this->session->dept;
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$result=$this->db->query("SELECT * FROM purchaseorder WHERE status='return' AND reqdept='$st' AND transdate BETWEEN '$startdate' AND '$enddate' GROUP BY reqno ORDER BY reqdate DESC");
		return $result->result_array();
	}
	public function cancel_return($param){
		$cancel=$this->db->query("UPDATE purchaseorder SET `status`='cancel return' WHERE reqno='$param' AND `status`='transfer'");
		if($cancel){
			return true;
		}else{
			return false;
		}
	}
	public function cancel_return_view($rrdetails,$reqno){
		$cancel=$this->db->query("UPDATE purchaseorder SET `status`='cancel return' WHERE rrdetails='$rrdetails'");
		if($cancel){
			return true;
		}else{
			return false;
		}
	}
	public function returnhistoryprintbody($param){
		$result=$this->db->query("SELECT po.*,r.generic FROM purchaseorder po INNER JOIN receiving r ON r.code=po.code WHERE po.reqno='$param' AND po.`status`='return'");
		return $result->result_array();
	}
	public function getAllPendingReturn(){
		$result=$this->db->query("SELECT * FROM stocktablereturn WHERE isid='' GROUP BY invno ORDER BY datearray DESC");
		return $result->result_array();
	}
	public function getReturnDetails($invno){
		$result=$this->db->query("SELECT suppliername,suppliercode FROM stocktablereturn WHERE invno='$invno' GROUP BY invno");
		return $result->row_array();
	}
	public function getReturnItems($invno){
		$result=$this->db->query("SELECT *,SUM(quantity) as quantity FROM stocktablereturn WHERE invno='$invno' AND isid='' GROUP BY expiration,code,paymentstatus,unitcost");
		return $result->result_array();
	}
	public function searchreturnsupplier(){
		$st=$this->session->dept;
		$param=$this->input->post('description');
		$suppliercode=$this->input->post('suppliercode');
		$result=$this->db->query("SELECT po.prodqty as prodqty,s.*,r.generic,r.itemname FROM stocktablepayables s INNER JOIN purchaseorder po ON s.po=po.po INNER JOIN receiving r ON r.code=s.code WHERE s.suppliercode='$suppliercode' AND s.dept='$st' AND s.description LIKE '%$param%' GROUP BY s.rrno,s.expiration,s.code");
		return $result->result_array();
	}
	public function getQtyReturn($code,$dept,$rrno){
		$result=$this->db->query("SELECT SUM(quantity) as soh FROM stocktable WHERE code='$code' AND dept='$dept' AND datearray >= '2021-07-01' AND rrno='$rrno' GROUP BY code");
		return $result->row_array();
	}
	public function returnadditem(){
		$department=$this->session->dept;
		$invno=$this->session->invno;
		$nursename=$this->session->fullname;
		$quantity=$this->input->post('quantity');
		$rrno=$this->input->post('rrno');
		$unitcost=$this->input->post('unitcost');
		$code=$this->input->post('code');
		$expiration=$this->input->post('expiration');
		$lotno=$this->input->post('lotno');
		$suppliercode=$this->input->post('suppliercode');
		$suppliername=$this->input->post('suppliername');
		$description=$this->input->post('description');
		$po=$invno;
		$itemdesc=$this->db->query("SELECT * FROM stocktablepayables WHERE code='$code' AND dept='$department' AND rrno='$rrno' GROUP BY code");
		$resitemdesc=$itemdesc->row_array();
		$generic=$resitemdesc['generic'];
		$due=$resitemdesc['duedate'];
		$date=date('M-d-Y');
		$datearray=date('Y-m-d');
		$time=date('H:i:s');
		$qty1=$resitemdesc['quantity'];
		$itemqty=$this->db->query("SELECT SUM(quantity) as quantity FROM stocktable WHERE code='$code' AND dept='$department' AND datearray >='2021-07-01' GROUP BY code");
		$resitemqty=$itemqty->row_array();
		if($quantity>$qty1){
			return false;
		}else{
			$chk=$this->db->query("SELECT * FROM stocktablereturn WHERE code='$code' AND invno='$invno'");
			if($chk->num_rows()>0){
				$reschk=$chk->row_array();
				$newqty=$quantity+$reschk['quantity'];
				$result=$this->db->query("UPDATE stocktablereturn SET quantity='$newqty' WHERE code='$code' AND invno='$invno'");
			}else{
				$result=$this->db->query("INSERT INTO stocktablereturn(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$date','$rrno','$po','$invno','$suppliercode','$suppliername','$code','$description','$unitcost','$quantity','0','$generic','$quantity','$expiration','$lotno','RETURN TO SUPPLIER','NONE','$date','$department','0.00','','','$nursename','$qty1','u','$due','$datearray','$time')");
			}
			return $result;
		}
	}
	public function returnremoveitem($param){
		$result=$this->db->query("DELETE FROM stocktablereturn WHERE autono='$param'");
		return true;
	}
	public function postreturnsupplier(){
		$department=$this->session->dept;
		$invno=$this->session->invno;
		$items=$this->db->query("SELECT * FROM stocktablereturn WHERE invno='$invno' AND isid=''");
		if($items->num_rows()>0){
			$iteme=$items->result_array();
			foreach($iteme as $item){
				$autono=$item['autono'];
				$suppliercode=$item['suppliercode'];
				$suppliername=$item['suppliername'];
				$description=$item['description'];
				$code=$item['code'];
				$unitcost=$item['unitcost'];
				$quantity=$item['quantity'];
				$expiration=$item['expiration'];
				$lotno=$item['lotno'];
				$po=$item['po'];
				$rrno=$item['rrno'];
				$generic=$item['generic'];
				$qty=$item['prevqty'];
				$due=$item['duedate'];
				$nursename=$item['receivinguser'];
				$date=date('M-d-Y');
				$datearray=date('Y-m-d');
				$time=date('H:i:s');
				$this->db->query("INSERT INTO stocktable(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray,timearray) VALUES('$date','$rrno','$po','$invno','$suppliercode','$suppliername','$code','$description','$unitcost','-$quantity','0','$generic','$quantity','$expiration','$lotno','RETURN TO SUPPLIER','NONE','$date','$department','0.00','NONE','$invno','$nursename','$qty','u','$due','$datearray','$time')");
				$this->db->query("INSERT INTO usermode(`date`,`time`,refno,caseno,productcode,amount,quantity,reasons,user) VALUES('$datearray','$time','$rrno','$department','$code','$unitcost','$quantity','RETURN TO $suppliername','$nursename')");
				$result=$this->db->query("UPDATE stocktablereturn SET isid='$invno' WHERE autono='$autono'");
			}
			return $result;
		}else{
			return false;
		}
	}
	public function printReturnDetails($invno){
		$result=$this->db->query("SELECT * FROM stocktablereturn WHERE invno='$invno'");
		return $result->row_array();
	}
	public function printReturnItems($invno){
		$result=$this->db->query("SELECT * FROM stocktablereturn WHERE invno='$invno' AND isid <> ''");
		return $result->result_array();
	}
	public function printPreviewReturnItems($invno){
		$result=$this->db->query("SELECT * FROM stocktablereturn WHERE invno='$invno' AND isid = ''");
		return $result->result_array();
	}
	public function getAllPendingReturnByDate(){
		$supplier=explode("_",$this->input->post('supplier'));
		$suppliercode=$supplier[0];
		$suppliername=$supplier[1];
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$result=$this->db->query("SELECT * FROM stocktablereturn WHERE isid <> '' AND suppliercode='$suppliercode' AND datearray BETWEEN '$startdate' AND '$enddate' AND isid LIKE '%RTS%' GROUP BY invno ORDER BY datearray DESC");
		return $result->result_array();
	}
	public function cancel_issuance($reqno){
		$query=$this->db->query("SELECT * FROM purchaseorder WHERE reqno='$reqno' AND `status`='request'");
		if($query->num_rows()>0){
			$cancel=$this->db->query("UPDATE purchaseorder SET `status`='cancel' WHERE reqno='$reqno' AND `status`='request'");
			if($cancel){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function cancel_stock_issuance($id){
			$cancel=$this->db->query("UPDATE purchaseorder SET `status`='cancel' WHERE rrdetails='$id'");
			if($cancel){
				return true;
			}else{
				return false;
			}		
	}
	public function getSubSection(){
		$result=$this->db->query("SELECT * FROM labsection ORDER BY description ASC");
		return $result->result_array();
	}
	public function edit_invoice(){
		$rrno=$this->input->post('rrno');
		$oldinvno=$this->input->post('oldinvno');
		$invno=$this->input->post('invno');
		$result=$this->db->query("UPDATE stocktablepayables SET invno='$invno' WHERE rrno='$rrno' AND invno='$oldinvno'");
		if($result){
			return true;
		}else{
			return false;
		}
	}

	public function save_reorder_level(){
		$code=$this->input->post('code');
		$dept=$this->input->post('dept');			
		$quantity=$this->input->post('quantity');
		$datenow=date('Y-m-d');
		$timenow=date('H:i:s');
		$user=$this->session->fullname;
		$check=$this->db->query("SELECT * FROM reorder WHERE code='$code' AND dept='$dept'");
		if($check->num_rows() > 0){
			$result=$this->db->query("UPDATE reorder SET quantity='$quantity',date_updated='$datenow',time_updated='$timenow',updated_by='$user' WHERE code='$code'");
		}else{
			$result=$this->db->query("INSERT INTO reorder(`code`,`quantity`,`dept`,`date_added`,`time_added`,`added_by`,`date_updated`,`time_updated`,`updated_by`) VALUES('$code','$quantity','$dept','$datenow','$timenow','$user','$datenow','$timenow','$user')");
		}
		if($result){
			return true;
		}else{
			return false;
		}
	}

	public function getAllReOrderLevel(){
		$dept=$this->session->dept;
		if($dept=="CPU" || $dept=="CSR" || $dept=="CPU-RDU"){
			$result=$this->db->query("SELECT r.code,r.itemname,r.generic,SUM(s.quantity) as soh,rl.quantity,rl.dept as department FROM stocktable s INNER JOIN receiving r ON r.code=s.code LEFT JOIN reorder rl ON rl.code=r.code WHERE s.dept='$dept' AND s.datearray >= '2021-07-01' AND rl.dept='$dept' GROUP BY s.code ORDER BY r.itemname ASC");			
		}else{
			$result=$this->db->query("SELECT r.code,r.itemname,r.generic,SUM(s.quantity) as quantity,rl.quantity FROM stocktable s INNER JOIN receiving r ON r.code=s.code LEFT JOIN reorder rl ON rl.code=r.code WHERE s.dept='$dept' AND rl.dept='$dept' GROUP BY s.code ORDER BY r.itemname ASC");
		}
		return $result->result_array();
	}
	public function getAllExpiry(){
		$dept=$this->session->dept;
		$datenow=date('Y-m-d');
		if($dept=="CPU" || $dept=="CSR" || $dept=="CPU-RDU"){
			$result=$this->db->query("SELECT SUM(s.quantity) as soh,r.itemname,r.generic,sp.rrno,sp.suppliername,sp.expiration,DATEDIFF(sp.expiration,'$datenow') as no_of_days FROM stocktable s INNER JOIN receiving r ON r.code=s.code INNER JOIN stocktablepayables sp ON sp.rrno=s.rrno AND sp.code=s.code WHERE s.dept='$dept' AND s.datearray > '2021-07-01' AND sp.trantype='charge' AND sp.expiration <> '0000-00-00' GROUP BY s.rrno,s.code,sp.suppliername HAVING soh > 0 AND no_of_days <= 90 AND no_of_days > 0 ORDER BY r.itemname ASC, sp.datearray DESC");
		}else{
			$result=$this->db->query("SELECT SUM(s.quantity) as soh,r.itemname,r.generic,sp.rrno,sp.suppliername,sp.expiration,DATEDIFF(sp.expiration,'$datenow') as no_of_days FROM stocktable s INNER JOIN receiving r ON r.code=s.code INNER JOIN stocktablepayables sp ON sp.rrno=s.rrno AND sp.code=s.code WHERE s.dept='$dept' AND sp.trantype='charge' AND sp.dept='CPU' AND sp.expiration <> '0000-00-00' GROUP BY s.rrno,s.code,sp.suppliername HAVING soh > 0 AND no_of_days <= 90 AND no_of_days > 0 ORDER BY sp.datearray DESC");
		}
		return $result->result_array();
	}
	public function getAllRequestedItems(){
		$dept=$this->session->dept;
		$result=$this->db->query("SELECT * FROM purchaseorder WHERE reqdept='$dept' AND `status` = 'received' GROUP BY reqno ORDER BY reqdate DESC");
		return $result->result_array();
	}
	public function getRequestedItem($reqno){
		$dept=$this->session->dept;
		$result=$this->db->query("SELECT * FROM purchaseorder WHERE reqdept='$dept' AND `status` = 'received' AND reqno='$reqno'");
		return $result->result_array();
	}
	public function getAllItemsBySupplier($type){
		$dept=$this->session->dept;
		$result=$this->db->query("SELECT r.*,s.suppliercode,s.suppliername FROM receiving r INNER JOIN stocktable s ON s.code=r.code WHERE s.dept='$dept' AND r.unit LIKE '%$type%' AND s.suppliercode <> 'CPU' AND s.suppliercode <> 'VARIOUS PATIENT' AND s.suppliercode <> '' AND s.suppliercode <> 'CSR' AND s.suppliercode <> 'PHARMACY' AND s.suppliercode <> 'AUTOGEN' AND (trantype = 'charge' OR trantype = 'cash') GROUP BY s.suppliercode,s.code ORDER BY r.itemname ASC");
		return $result->result_array();
	}
	public function getUnitCostByItem($code,$supplier){
		$result=$this->db->query("SELECT * FROM stocktablepayables WHERE code='$code' AND suppliercode='$supplier' ORDER BY datearray DESC LIMIT 1");
		if($result->num_rows()>0){
			return $result->row_array();
		}
	}
}
