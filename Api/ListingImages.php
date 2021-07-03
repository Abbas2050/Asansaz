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

$listid=$_POST["listing_id"];
$result=array();
$result['Data']=array();

$select = "SELECT image_path FROM ea_listing_image WHERE listing_id = '$listid'";

$responce=mysqli_query($conn,$select);
if($responce){
    //echo 'response available';
}
while($row=mysqli_fetch_array($responce))
    {
        $index['imagepath']=  "https://bahriamall.pk".$row['0'];



        array_Push($result['Data'],$index);

    }
    $result["success"]="1";
    echo json_encode($result);
}
    mysqli_close($con);
?>