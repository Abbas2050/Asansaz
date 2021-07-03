<?php
$servername = "bigserver.host.com.pk";
$username = "bahriamall_olx";
$password = "a^@EP4y*,(=ud";
$dbname = "bahriamall_olx";
$result = array();
$result['Data'] = array();
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
    $select = "SELECT package_id,title,price,listing_days,promo_days,total_ads FROM ea_listing_package";
    $response = mysqli_query($conn,$select);
    if(!$response){
        echo 'no response';
    }else{
       
        while($row = mysqli_fetch_array($response)){
            
            $index['pid'] = $row['0'];
            $index['title'] = $row['1'];
            $index['price'] = $row['2'];
            $index['listingdays'] = $row['3'];
            $index['promodays'] = $row['4'];
            $index['totalads'] = $row['5'];
            array_push($result['Data'],$index);
        }
        echo json_encode($result);
    }
}
mysqli_close($con);
?>
