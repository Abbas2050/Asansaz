<?php
$servername = "bigserver.host.com.pk";
$username = "bahriamall_olx";
$password = "a^@EP4y*,(=ud";
$dbname = "bahriamall_olx";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
$myresult = array();
$myresult['Data'] = array();

$customerid= $_POST["customer_id"];
$first_name=$_POST["first_name"];
$last_name=$_POST["last_name"];
$password_hash=$_POST["password_hash"];
$phone=$_POST["phone"];

$sql = "UPDATE ea_customer SET first_name = '$first_name' , last_name = '$last_name',
password_hash = '$password_hash', phone = '$phone'   WHERE customer_id = '$customerid'";

if ($conn->query($sql) === TRUE) {
 // echo "Account is created successfully";
 $myindex['messege'] = "record updated sucessfuly";
 array_Push($myresult['Data'],$myindex);
 echo json_encode($myresult);
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}
    
}
$conn->close();
?>