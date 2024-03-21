<?php
class database {

public $myHost = 'localhost';
public $username = 'root';
public $password = 'km5c13cl41m5';
public $database = 'kmsci';

public $myHost2 = 'localhost';
public $username2 = 'root';
public $password2 = 'km5c13cl41m5';
public $database2 = 'eclaimtree';
public $database3 = 'eclaimtree-temp';

public $setip = '192.168.8.178';
public $setipeclaims = '192.168.8.178';
public $setipmain = '192.168.8.178';

public function myHost(){
return $this->myHost;
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

public function getDB3(){
return $this->database3;
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
$password = "km5c13cl41m5";
$dbname = "kmsci";

// Create connection
$mycon1 = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$mycon1) {
    die("Connection failed: " . mysqli_connect_error());
}

$servername2 = "localhost";
$username2 = "root";
$password2 = "km5c13cl41m5";
$dbname2 = "eclaimtree";
$dbname3 = "eclaimtree-temp";
$dbname4 = "miscset";
$dbname5 = "cf4";
$dbname6 = "epcb";

// Create connection
$mycon2 = mysqli_connect($servername2, $username2, $password2, $dbname2);
// Check connection
if (!$mycon2) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create connection
$mycon3 = mysqli_connect($servername2, $username2, $password2, $dbname3);
// Check connection
if (!$mycon3) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create connection
$mycon4 = mysqli_connect($servername2, $username2, $password2, $dbname4);
// Check connection
if (!$mycon4) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create connection
$mycon5 = mysqli_connect($servername2, $username2, $password2, $dbname5);
// Check connection
if (!$mycon5) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create connection
$mycon6 = mysqli_connect($servername2, $username2, $password2, $dbname6);
// Check connection
if (!$mycon6) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
