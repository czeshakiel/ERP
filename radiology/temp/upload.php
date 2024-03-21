<?php
if(isset($_POST['sender'])){
$hosp=$_POST['sender'];
$patientidno=$_POST['patientidno'];
$caseno=$_POST['caseno'];
$refno=$_POST['refno'];
$name=$_POST['name'];
$gender=$_POST['gender'];
$age=$_POST['age'];
$code=$_POST['code'];
$desc=$_POST['desc'];
$datereq=$_POST['datereq'];
$reader=$_POST['reader'];

//if(!is_dir("Documents/$hc")){mkdir("Documents/$hc", 0777, true);}

$name=$_FILES['file']['name'];
$size=$_FILES['file']['size'];
$type=$_FILES['file']['type'];
$temp=$_FILES['file']['tmp_name'];
$filetype=$_POST['filetype'];
list($file2, $type2) = explode(".", $name);
$name2 = $refno.".".$type2;

$file_name = $_FILES['file']['name'];
$asd=move_uploaded_file($_FILES['file']['tmp_name'], $name2);


$conn = mysqli_connect("localhost", "root", "", "kmsci");

$sql = $conn->query("select * from sendoutrequest where caseno='$caseno' and refno='$refno'");
if(mysqli_num_rows()>0){
$conn->query("update `sendoutrequest` set hosp='$hosp', patientid='$patientidno', name='$name', gender='$gender', age='$age', code='$code', desc='$desc', datearrayreq='$datereq', reader='$reader' where caseno='$caseno' and refno='$refno'");
}else{
$conn->query("INSERT INTO `sendoutrequest`(`hosp`, `patientid`, `caseno`, `refno`, `name`, `gender`, `age`, `code`, `desc`, `status`, `interpretation`, `impression`, `datearrayreq`, `datetimedone`, `reader`)
VALUES ('$hosp', '$patientidno', '$caseno', '$refno', '$name', '$gender', '$age', '$code', '$desc', 'pending', '', '', '$datereq', '', '$reader')");
}

}
?>