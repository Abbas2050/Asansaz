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

$listingid = $_POST["listing_id"];
$customerid = $_POST["customer_id"];

$select = "SELECT customer_id,listing_id FROM ea_listing_favorite WHERE customer_id = '$customerid' AND listing_id = '$listingid'";

$responce=mysqli_query($conn,$select);
if(mysqli_num_rows($responce) > 0){
  $index['messege']= "response available";
    array_Push($myresult['Data'],$index);
    echo json_encode($myresult);
}else{
    //echo 'response not available';
    $index['messege']= "response not available";
    array_Push($myresult['Data'],$index);
    echo json_encode($myresult);
    
}
   
}
    mysqli_close($conn);
?>