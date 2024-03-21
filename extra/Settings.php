<?php
class database {

public $myHost = 'localhost';
public $username = 'root';
public $password = 'b0ykup4l';
public $database = 'kmsci';

public $myHost2 = '192.168.0.222';
public $username2 = 'eclaims';
public $password2 = 'test';
public $database2 = 'eclaimtree';
public $database3 = 'eclaimtree-temp';
public $database4 = 'cf4';
public $database5 = 'phicacr';

public $setip = '192.168.0.100:100';
public $setipeclaims = '192.168.0.222';
public $setipmain = '192.168.0.191:100';

public function myHost(){
return $this->myHost;
}

public function getDB3(){
return $this->database3;
}

public function getDB4(){
return $this->database4;
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

$servername = "localhost";
$username = "root";
$password = "b0ykup4l";
$dbname = "kmsci";
$dbname2= "cf4";
$dbname5= "phicacr";

// Create connection
$mycon1 = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$mycon1) {
    die("Connection failed: " . mysqli_connect_error());
}

$mycon2 = mysqli_connect($servername, $username, $password, $dbname2);
// Check connection
if (!$mycon2) {
    die("Connection failed: " . mysqli_connect_error());
}

$mycon5 = mysqli_connect($servername, $username, $password, $dbname5);
// Check connection
if (!$mycon5) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
