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
$resut = array();
$result['Data'] = array();
$catid = $_POST["categoryid"];
$value = $_POST["value"];
$fid = "718";
$cat = "8";
$val = "Yes";
$searchText = "Loan";

    //connection success
    $sql = "SELECT ea_category_field.field_id,ea_category_field.label,ea_category_field_value.listing_id,ea_category_field_value.value 
    FROM ea_category_field INNER JOIN ea_category_field_value ON ea_category_field.field_id = ea_category_field_value.field_id 
    WHERE ea_category_field.label LIKE '%{$searchText}%' AND ea_category_field.category_id = '$catid' AND ea_category_field_value.value = '$value'";
    $response = mysqli_query($conn,$sql);
    if(!$response){
        //response not available
    }else{
        //response available
        while($row = mysqli_fetch_array($response)){
            $listid = $row['2'];
            $innnerselect = "SELECT ea_listing.title,ea_listing.listing_id,ea_listing.price,ea_currency.symbol,
ea_location.city,ea_listing.created_at,ea_location.longitude,ea_location.latitude,ea_category.category_id,
ea_customer.customer_id,ea_customer.first_name,ea_customer.last_name,ea_listing.hide_phone,ea_listing.hide_email,
ea_listing.description,ea_customer.email,ea_customer.phone
FROM ((((ea_listing INNER JOIN ea_category ON ea_listing.category_id = ea_category.category_id)
INNER JOIN ea_currency ON ea_listing.currency_id=ea_currency.currency_id)
INNER JOIN ea_location ON ea_listing.location_id = ea_location.location_id)
INNER JOIN ea_customer ON ea_listing.customer_id = ea_customer.customer_id)WHERE ea_listing.listing_id = '$listid'";

$innerresponse = mysqli_query($conn,$innnerselect);
if(!$innerresponse){
    //inner response not avaiable
}else{
    //inner response available
    while($inrow=mysqli_fetch_array($innerresponse))
    {
        $sl = $inrow['1'];
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
         $index['name']=  $inrow['0'];
        $index['listingid']= $inrow['1'];
        $index['price']= $inrow['3'].$inrow['2'];
        $index['city']= $inrow['4'];
        $index['createdat']= $inrow['5'];
        $index['longitude']= $inrow['6'];
        $index['latitude']= $inrow['7'];
        $index['categoryid']= $inrow['8'];
        $index['customerid']= $inrow['9'];
        $index['customername']= $inrow['10'].' '.$inrow['11'];
        $index['hidephone']= $inrow['12'];
        $index['hideemail']= $inrow['13'];
        $index['description']= $inrow['14'];
        $index['email']= $inrow['15'];
        $index['phone']= $inrow['16'];
        $index['cost']= $inrow['2'];


        array_Push($result['Data'],$index);

    }
}
            //array_push($result['Data'],$index);
            
        }
        echo json_encode($result);
    }
}

mysqli_close($con);
?>