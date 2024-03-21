<?php
class database {

public $myHost = 'localhost';
public $username = 'root';
public $password = 'test';
public $database = 'kmsci';

public $myHost2 = '192.168.0.222';
public $username2 = 'eclaims';
public $password2 = 'test';
public $database2 = 'eclaimtree';
public $database3 = 'eclaimtree-temp';

public $setip = 'localhost';
public $setipeclaims = '192.168.0.222';
public $setipmain = '192.168.0.191:100';

public function myHost(){
return $this->myHost;
}

public function getDB3(){

return $this->database3;

}

public function getUser(){
return $this->username;
}

public function getPass(){
return $this->password;
}

public function getDB(){
return $this->database;
}

public function myHost2(){
return $this->myHost2;
}

public function getUser2(){
return $this->username2;
}

public function getPass2(){
return $this->password2;
}

public function getDB2(){
return $this->database2;
}

public function setIP(){
return $this->setip;
}

public function setIPMain(){
return $this->setipmain;
}

public function setIPeClaims(){
return $this->setipeclaims;
}

}
?>
