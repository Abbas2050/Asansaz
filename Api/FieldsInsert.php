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

$fieldid =  $_POST["field_id"];
$listingid = $_POST["listing_id"];
$value = $_POST["value"];
$date = date('Y-m-d H:i:s');
$fid = "710";
$lid = "83";
$val = "Yes";

$conid;

$sql = "INSERT INTO ea_category_field_value(field_id,listing_id,value,created_at,updated_at)
VALUES ('$fieldid','$listingid','$value','$date','$date')";
if ($conn->query($sql) === TRUE) {

    $index['messege'] = "field inserted successfuly";
    array_Push($myresult['Data'],$index);
    echo json_encode($myresult);

} else {
   $index['messege'] = "operation failed";
    array_Push($myresult['Data'],$index);
    echo json_encode($myresult);
}

}
$conn->close();


?>