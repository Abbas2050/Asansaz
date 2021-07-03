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
    echo 'connection success';
$listingid = $_POST["listing_id"];
$packageid = $_POST["package_id"];
$myresult = array();
$myresult['Data'] = array();
$upd = "UPDATE ea_listing SET package_id = '$packageid' WHERE listing_id = '$listingid'";
$response = mysqli_query($conn,$upd);
if($response){
    echo 'response avaiable';
}
if($conn->query($upd) === TRUE){
    
    $index['messege'] = "record updated successfully";
    $index['listingid'] = $listingid;
    $index['packageid'] = $packageid;
    array_push($myresult['Data'],$index);
    echo json_encode($myresult);
}else{
    $index['messege'] = "record not update";
    $index['listingid'] = $listingid;
    $index['packageid'] = $packageid;
    array_push($myresult['Data'],$index);
    echo json_encode($myresult);
}
}
mysqli_close($con);
?>