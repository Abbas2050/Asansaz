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
   // echo 'connection success';
$listid = $_POST["listingid"];
$currencyid=$_POST["currency_id"];
$title=$_POST["title"];
$desc=$_POST["desc"];
$price = $_POST["price"];
$hidephone=$_POST["hidephone"];
$hideemail=$_POST["hideemail"];
$date = date('Y-m-d H:i:s');
$sql = "UPDATE ea_listing SET title = '$title',currency_id = '$currencyid',description='$desc',price = '$price',hide_phone = '$hidephone',hide_email='$hideemail',updated_at='$date' WHERE listing_id ='$listid'";
if ($conn->query($sql) === TRUE) {
    $index['messege'] = "Listing updated succesfully";
    array_push($myresult['Data'],$index);
    echo json_encode($myresult);
} else {
  $index['messege'] = "Listing update failed";
    array_push($myresult['Data'],$index);
    echo json_encode($myresult);
 }
}
$conn->close();
?>