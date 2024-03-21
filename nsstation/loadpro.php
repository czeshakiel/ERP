
<?php
echo "
<option></option>
";

$name=$_GET['str'];
include('../main/class.php');

if($name=="add"){
    $doctor=$_GET['doctor'];
    $services=$_GET['services'];
    $caseno=$_GET['caseno'];
    $batchno=$_GET['batchno'];
    $conn->query("INSERT INTO `orpf`(`caseno`, `doctor`, `specialization`, `batchno`) VALUES ('$caseno','$doctor','$services','$batchno')");

}elseif($name=="del"){
    $doctor=$_GET['doctor'];
    $services=$_GET['services'];
    $caseno=$_GET['caseno'];
    $id=$_GET['str2'];
    $conn->query("delete from `orpf` where id='$id'");

}elseif($name=="clear"){
    $doctor=$_GET['doctor'];
    $services=$_GET['services'];
    $caseno=$_GET['caseno'];
    $conn->query("delete from `orpf` where caseno='$caseno'");    

}else{

if($name=="OR"){

    if(isset($_GET['test'])){
     $test = $_GET['test'];
     $result2x = $conn->query("SELECT * FROM rsurgery where proccode='$test'");
     while($row2x = $result2x->fetch_assoc()){echo "<option value='$row2x[proccode]' selected>$row2x[procdesc]</option>";}
    }

$result2 = $conn->query("SELECT * FROM rsurgery order by procdesc");
while($row2 = $result2->fetch_assoc()){echo "<option value='$row2[proccode]'>$row2[procdesc]</option>";}
}else{
$sql2 = "SELECT * FROM ORPROCEDURE where dept='$name'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc())
{
$or=$row2['orprocedure'];
echo "<option value='$or'>$or</option>";
}
}

}
?>
