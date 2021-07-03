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
$result=array();
$result['Data']=array();

$cus = "17";

$select = "SELECT COUNT(*) as mycount FROM ea_conversation WHERE seller_id = '$cus' OR buyer_id = '$cus' ";

$responce=mysqli_query($con,$select);
if($responce){
    //echo 'response available';
}
      $row=mysqli_fetch_array($responce);
       $index['totalChats']=  $row['0'];


        array_Push($result['Data'],$index);

    
    $result["success"]="1";
    echo json_encode($result);
}
    mysqli_close($con);
?>