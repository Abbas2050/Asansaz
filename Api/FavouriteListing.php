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
    $myindex['messege'] = "Failed to connect to database";
  array_Push($myresult['Data'],$myindex);
  echo json_encode($myresult);
  exit();
}else{
$myresult = array();
$myresult['Data'] = array();

$listingid = $_POST["listing_id"];
$customerid = $_POST["customer_id"];
$date = date('Y-m-d H:i:s');
$created_at= $date;
$updated_at= $date;


$sql_u = "SELECT * FROM ea_listing_favorite  WHERE customer_id = '$customerid' AND listing_id='$listingid'";
	$res_u = mysqli_query($conn, $sql_u);
if (mysqli_num_rows($res_u) > 0) {
  // echo "Account already Exsist";
  $index['messege'] = "Favorite already exsist";
  array_Push($myresult['Data'],$index);
  echo json_encode($myresult);

}
else
{


$sql = "INSERT INTO ea_listing_favorite (customer_id,listing_id,created_at,updated_at)
VALUES ('$customerid','$listingid','$created_at','$updated_at')";
if ($conn->query($sql) === TRUE) {

         $index['messege'] = "Favorite Added Successfully";
         array_Push($myresult['Data'],$index);
         echo json_encode($myresult);
         
} else {  //echo "Error: " . $sql . "<br>" . $con->error;

}
     
}
}
$conn->close();


?>