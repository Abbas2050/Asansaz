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
$date = date('Y-m-d H:i:s');
$created_at= $date;
$updated_at= $date;
$tv = "0";
$fs = "0";
$ts = "0";
$ms = "0";
$fav = "0";
$sp = "0";
$se = "0";

$sql_u = "SELECT * FROM ea_listing_stat  WHERE listing_id = '$listingid'";
	$res_u = mysqli_query($conn, $sql_u);
if (mysqli_num_rows($res_u) > 0) {
  // echo "Account already Exsist";
  $index['messege'] = "Statistics already exsist";
  array_Push($myresult['Data'],$index);
  echo json_encode($myresult);

}
else
{

$sql = "INSERT INTO ea_listing_stat (listing_id,total_views,facebook_shares,twitter_shares,mail_shares,favorite,show_phone,show_mail,created_at,updated_at)
VALUES ('$listingid','$tv','$fs','$ts','$ms','$fav','$sp','$se','$created_at','$updated_at')";
if ($conn->query($sql) === TRUE) {


         $index['messege'] = "Staticstic Added Successfully";
         array_Push($myresult['Data'],$index);
         echo json_encode($myresult);

         
} else {  //echo "Error: " . $sql . "<br>" . $con->error;

}
     

}
}
$conn->close();


?>