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
$customerid = $_POST["customer_id"];
$cus = "17";

$select = "SELECT COUNT(customer_id) as mycount FROM ea_listing_favorite WHERE customer_id = '$customerid' ";

$responce=mysqli_query($con,$select);
if($responce){
    //echo 'response available';
}
      $row=mysqli_fetch_array($responce);
       $index['totalAds']=  $row['0'];


        array_Push($result['Data'],$index);

    
    $result["success"]="1";
    echo json_encode($result);
}
    mysqli_close($con);
?>