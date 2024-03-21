<?php
function generateRefNo($seqname,$user){
  $user=mysqli_query($conn,"SELECT name FROM nsauth WHERE username='".$user."'");
  $name=mysqli_fetch_object($user)->name;
  $datenow=date('Y');
  $check=mysqli_query($conn,"SELECT * FROM seqpatientid WHERE seq_name='$seqname' AND seq_code='$datenow'");

  if(mysqli_num_rows($check)>0){
    $row=mysqli_fetch_object($check);
    $seq_name=$row->seq_name;
    $seq_code=$row->seq_code;
    $last_value=$row->last_value;
    $last_gen_date=date('Ym');
    $date=date('Y-m-d H:i:s');

    $new_value=$last_value+1;

    $count_last_value=strlen($new_value);
    $count_format=strlen('00000');
    $count=$count_format - $count_last_value;
    $new_format="";

    for($i=0;$i<$count;$i++){
      $new_format=$new_format."0";
    }

    $caseno=$seq_name."".$last_gen_date."".$new_format."".$new_value;
    $updatecase=mysqli_query($conn,"UPDATE seqpatientid SET last_value='$new_value',last_gen_date='$date',last_gen_by='$name' WHERE seq_name='$seqname' AND seq_code='$datenow'");
  }
  else{
    $new_value=1;
    $last_gen_date=date('Ym');
    $format='0000';
    $caseno=$seqname."".$last_gen_date."".$format."".$new_value;
    $savecase=mysqli_query($conn,"INSERT INTO seqpatientid(seq_name,seq_code,last_value,last_gen_date,last_gen_by) VALUES('$seqname','$datenow','$new_value',NOW(),'$name')");
  }

  return $caseno;
}
?>
