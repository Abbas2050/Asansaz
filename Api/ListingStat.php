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
$select = "SELECT total_views,facebook_shares,twitter_shares,mail_shares,favorite,show_phone,show_mail
FROM ea_listing_stat WHERE listing_id = '$listid' ";

$responce=mysqli_query($conn,$select);

    
while($row=mysqli_fetch_array($responce))
    {
        $index['totalviews']= $row['0'];
        $index['facebookshare']= $row['1'];
        $index['twittershare']= $row['2'];
        $index['mailshare']= $row['3'];
        $index['favorite']= $row['4'];
        $index['showphone']= $row['5'];
        $index['showmail']= $row['6'];
        


        array_Push($result['Data'],$index);

    }
    $result["success"]="1";
    echo json_encode($result);

}

    mysqli_close($conn);
?>