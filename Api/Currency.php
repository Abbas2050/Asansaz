<?php
$servername = "bigserver.host.com.pk";
$username = "bahriamall_olx";
$password = "a^@EP4y*,(=ud";
$dbname = "bahriamall_olx";
$result=array();
$result['Data']=array();
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
mysqli_set_charset($conn,“utf8mb4”);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
mysqli_set_charset($conn,“utf8mb4_unicode_ci”);
//echo 'connection success';
$select = "SELECT * FROM ea_currency";
$response = mysqli_query($conn,$select);
if(!$response){
    //echo 'response not found';
}else{
   
    while($row = mysqli_fetch_array($response)){
        
        $index['currencyid'] = utf8_encode($row['0']);
        $index['symbol'] = utf8_encode($row['3']);
        array_Push($result['Data'],$index);
        
    }

   //$json_string = json_encode($result);
   //var_dump($json_string);
     //var_dump($result['Data']);
    //echo $result;
   // print_r($result);
   echo json_encode($result);
   //echo json_encode($reult,JSON_UNESCAPED_UNICODE);

  
}

}
    mysqli_close($conn);
?>