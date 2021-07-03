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
$val = "mute";
$listid = $_POST["listingid"];

    //echo 'connection success';
    $upd = "UPDATE ea_listing SET status = '$val' WHERE listing_id = '$listid'";
    $respons = mysqli_query($conn,$upd);
    if(!$respons){
        $index['message'] = "listing mute fail";
        array_push($myresult['Data'],$index);
        echo json_encode($myresult);
    }else{
        $index['message'] = "listing mute success";
        array_push($myresult['Data'],$index);
        echo json_encode($myresult);
    }

}
mysqli_close($conn);
?>