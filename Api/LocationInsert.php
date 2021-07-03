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


$date = date('Y-m-d H:i:s');
$created_at= $date;
$updated_at= $date;
$contryid = $_POST["country_id"];
$zoneid = $_POST["zone_id"];
$longitude = $_POST["logitude"];
$latitude = $_POST["latitude"];
$city = $_POST["city"];
//$zip = "46000";

$sql = "INSERT INTO ea_location(country_id,zone_id,city,latitude,longitude,created_at,updated_at)
VALUES ('$contryid','$zoneid','$city','$latitude','$longitude','$created_at','$updated_at')";

if ($conn->query($sql) === TRUE) {

      $select = "SELECT location_id FROM ea_location ORDER BY created_at DESC LIMIT 1" ;
       $responce=mysqli_query($conn,$select);  
       if(mysqli_num_rows($responce) > 0){
           $myrow  = mysqli_fetch_array($responce);
           $myindex['messege'] = $myrow['0'];
          array_Push($myresult['Data'],$myindex);
         echo json_encode($myresult);
       }else{
          $myindex['messege'] = "No Record found";
          array_Push($myresult['Data'],$myindex);
         echo json_encode($myresult);
       }

         
} else {  //echo "Error: " . $sql . "<br>" . $con->error;
}

}

$conn->close();


?>