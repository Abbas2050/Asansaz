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


$selid =  $_POST["seller_id"];
$buyerid = $_POST["buyer_id"];
$listingid = $_POST["listing_id"];
$customeruid = $_POST["customer_uid"];
$date = date('Y-m-d H:i:s');
$created_at= $date;
$updated_at= $date;
$conid;
$sql_u = "SELECT conversation_id FROM ea_conversation  WHERE seller_id = '$selid' AND buyer_id = '$buyerid' AND listing_id = '$listingid'";
	$res_u = mysqli_query($conn, $sql_u);
if (mysqli_num_rows($res_u) > 0) {


    $row = mysqli_fetch_array($res_u);
    $index['conversationid'] = $row['conversation_id'];
    $index['messege'] = "conversation already exist";
    array_Push($myresult['Data'],$index);
    echo json_encode($myresult);
  


}else{
$sql = "INSERT INTO ea_conversation(conversation_uid,seller_id,buyer_id,listing_id,created_at,updated_at)
VALUES ('$customeruid','$selid','$buyerid','$listingid','$created_at','$updated_at')";
if ($conn->query($sql) === TRUE) {

         
$select = "SELECT conversation_id FROM ea_conversation WHERE seller_id = '$selid' AND buyer_id = '$buyerid' AND listing_id = '$listingid'";

$responce=mysqli_query($conn,$select);
if($responce){
    $row = mysqli_fetch_array($responce);
    $index['conversationid'] = $row['conversation_id'];
    $index['messege'] = "conversation created successfuly";
    array_Push($myresult['Data'],$index);
    echo json_encode($myresult);

}

         

} else {  //echo "Error: " . $sql . "<br>" . $con->error;
}

}

}
$conn->close();


?>