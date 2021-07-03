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
$conversationid = $_POST["conversation_id"];
$buyerid = $_POST["buyer_id"];
$date = date('Y-m-d H:i:s');
$created_at= $date;
$updated_at= $date;
$msg = $_POST["message"];

$sql = "INSERT INTO ea_conversation_message(conversation_id,buyer_id,message,created_at,updated_at)
VALUES ('$conversationid','$buyerid','$msg','$created_at','$updated_at')";
if ($conn->query($sql) === TRUE) {

         $index['sellerid']= "noid";
         $index['buyerid']= $buyerid;
         $index['messege']= $msg;
         array_Push($myresult['Data'],$index);
         echo json_encode($myresult);
         
} else {  //echo "Error: " . $sql . "<br>" . $con->error;
}

}

$conn->close();


?>