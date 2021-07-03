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
$result = array();
$result['Data'] = array();
$customerid = $_POST["customer_id"];
$ci = "21";
$select = "SELECT first_name,last_name,email,password_hash,phone,created_at FROM ea_customer
WHERE customer_id = '$ci'";
$response = mysqli_query($conn,$select);
if(!$response){
    echo 'response not available';
}else{
    $row = mysqli_fetch_array($response);
    $index['firstname'] = $row['0'];
    $index['lastname'] = $row['1'];
    $index['fullname'] = $row['0'].' '.$row['1'];
    $index['email'] = $row['2'];
    $index['password'] = $row['3'];
    $index['phone'] = $row['4'];
    $index['createdat'] = $row['5'];
    array_push($result['Data'],$index);
    echo json_encode($result);
}
}
mysqli_close($conn);

?>