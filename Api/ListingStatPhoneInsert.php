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
$sql_u = "SELECT show_phone,show_mail FROM ea_listing_stat  WHERE listing_id = '$listingid'";
    $responce=mysqli_query($conn,$sql_u);
    $row=mysqli_fetch_array($responce);

       $val1 = $row['0']+1;
       $val2 = $row['1']+1;

$sql = "UPDATE ea_listing_stat SET show_phone = '$val1',show_mail = '$val2' WHERE listing_id = '$listingid'";
if ($conn->query($sql) === TRUE) {

         $index['messege'] = "phone and email view added Successfully";
         $index['listingid'] = $listingid;
         array_Push($myresult['Data'],$index);
         echo json_encode($myresult);
         
} else {  //echo "Error: " . $sql . "<br>" . $con->error;

}
     
}
$conn->close();


?>