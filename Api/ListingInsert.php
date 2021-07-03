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
    //echo 'connection success';
$myresult = array();
$myresult['Data'] = array();

$customerid=$_POST["customer_id"];
$locationid=$_POST["location_id"];
$categoryid=$_POST["category_id"];
$currencyid=$_POST["currency_id"];
$title=$_POST["title"];
$desc=$_POST["desc"];
$price = $_POST["price"];
$hidephone=$_POST["hidephone"];
$hideemail=$_POST["hideemail"];
$date = date('Y-m-d H:i:s');
/*//------random string function starts from here----
function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
//-------random string function end here---------*/
/*$c = random_str();


$slug = $ne.'-'.$c;*/
$random = substr(md5(mt_rand()), 0, 16);
$ne = str_replace(" ","-",$title);
$slug = $ne.'-'.$random;
$sql = "INSERT INTO ea_listing(customer_id,location_id,category_id,currency_id,title,slug,description,price,hide_phone,hide_email,created_at,updated_at)
VALUES('$customerid','$locationid','$categoryid','$currencyid','$title','$slug','$desc','$price','$hidephone','$hideemail','$date','$date')";

if ($conn->query($sql) === TRUE) {
    
    $select = "SELECT listing_id FROM ea_listing ORDER BY created_at DESC LIMIT 1" ;
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
       
} 
}
$conn->close();
?>