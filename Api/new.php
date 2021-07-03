<?php
$servername = "bigserver.host.com.pk";
$username = "bahriamall_olx";
$password = "a^@EP4y*,(=ud";
$dbname = "bahriamall_olx";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode("connection failed");
  //die("Connection failed: " . $conn->connect_error);
}else{
    echo json_encode("connection succes");
$myresult = array();
$myresult['Data'] = array();
$first_name=$_POST["first_name"];
$last_name=$_POST["last_name"];
$email=$_POST["email"];
$password_hash=$_POST["password_hash"];
$nickname=$_POST["nickname"];
$phone=$_POST["phone"];
$gender=$_POST["gender"];
$date = date('Y-m-d H:i:s');
$created_at=$date;
$encpass = crypt($password_hash);

$a = substr(md5(mt_rand()), 0, 16);
$sour = "Website";


$sql_u = "SELECT * FROM ea_customer  WHERE email='$email'";
	$res_u = mysqli_query($conn, $sql_u);
if (mysqli_num_rows($res_u) > 0) {
  // echo "Account already Exsist";
  $myindex['messege'] = "Account already exsist";
  array_Push($myresult['Data'],$myindex);
  echo json_encode($myresult);
}
else
{
    $sql = "INSERT INTO ea_customer (customer_uid,first_name,last_name,nickname,gender,email,phone,password_hash,source,created_at,activation_date)
VALUES ('$a','$first_name','$last_name','$nickname','$gender','$email','$phone','$encpass','$sour','$created_at','$created_at')";

if ($conn->query($sql) === TRUE) {
 // echo "Account is created successfully";
 $myindex['messege'] = "Account created sucessfuly";
 array_Push($myresult['Data'],$myindex);
 echo json_encode($myresult);
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}
    
}


}
$conn->close();
?>