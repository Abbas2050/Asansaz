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
$result = array();
$result['Data'] = array();
$searchText = $_POST["searchText"];

    //connect success
    $select = "SELECT category_id,name FROM ea_category WHERE name LIKE '%{$searchText}%'";
    $response = mysqli_query($conn,$select);
    if(!$response){
        //response not available
    }else{
        //response available
        while($row = mysqli_fetch_array($response)){
            $index['category_id'] = $row['0'];
            $index['name'] = $row['1'];
            array_push($result['Data'],$index);
        }
        echo json_encode($result);
    }
}
    mysqli_close($conn);

?>