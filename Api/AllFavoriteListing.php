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

$customerid=$_POST["customer_id"];
$result=array();
$result['Data']=array();

$select = "SELECT ea_listing.title,ea_listing.listing_id,ea_listing.price,ea_currency.symbol,
ea_location.city,ea_listing.created_at,ea_location.longitude,ea_location.latitude,ea_category.category_id,
ea_customer.customer_id,ea_customer.first_name,ea_customer.last_name,ea_listing.hide_phone,ea_listing.hide_email,
ea_listing.description,ea_customer.email,ea_customer.phone
FROM (((((ea_listing INNER JOIN ea_category ON ea_listing.category_id = ea_category.category_id)
INNER JOIN ea_currency ON ea_listing.currency_id=ea_currency.currency_id)
INNER JOIN ea_location ON ea_listing.location_id = ea_location.location_id)
INNER JOIN ea_customer ON ea_listing.customer_id = ea_customer.customer_id)
INNER JOIN ea_listing_favorite ON ea_listing.listing_id = ea_listing_favorite.listing_id) WHERE ea_listing_favorite.customer_id  = '$customerid'" ;

$responce=mysqli_query($conn,$select);
if($responce){
    //echo 'response available';
}
while($row=mysqli_fetch_array($responce))
    {
        $sl = $row['1'];
        $index['imagepath'];
        $selectinner = "SELECT  image_path FROM ea_listing_image WHERE listing_id = $sl LIMIT 1";
        $res=mysqli_query($conn,$selectinner);
        if($res){
           //echo 'inner response available';
            }
        while($rr = mysqli_fetch_array($res)){
            $i = $rr['0'];
            $index['imagepath']= "https://olx.onlineurbusiness.com".$i;
        }
         $index['name']=  $row['0'];
        $index['listingid']= $row['1'];
        $index['price']= $row['3'].$row['2'];
        $index['city']= $row['4'];
        $index['createdat']= $row['5'];
        $index['longitude']= $row['6'];
        $index['latitude']= $row['7'];
        $index['categoryid']= $row['8'];
        $index['customerid']= $row['9'];
        $index['customername']= $row['10'].' '.$row['11'];
        $index['hidephone']= $row['12'];
        $index['hideemail']= $row['13'];
        $index['description']= $row['14'];
        $index['email']= $row['15'];
        $index['phone']= $row['16'];
        $index['cost']= $row['2'];


        array_Push($result['Data'],$index);

    }
    $result["success"]="1";
    echo json_encode($result);
}
    mysqli_close($con);
?>