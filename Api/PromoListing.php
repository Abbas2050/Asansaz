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

    //echo 'database connected';
    $select = "SELECT ea_listing.title,ea_listing.listing_id FROM ea_listing INNER JOIN ea_listing_package ON ea_listing.package_id = ea_listing_package.package_id 
    WHERE ea_listing_package.package_id = 2 LIMIT 10";
    $response = mysqli_query($con,$select);
    if($response){
        //echo 'response availabel';
        while($row=mysqli_fetch_array($response)){
            $index['title'] = $row['0'];
            $index['listingid'] = $row['1'];
            $li = $row['1'];
            $selectinner = "SELECT  image_path FROM ea_listing_image WHERE listing_id = '$li' LIMIT 1";
            $innerresponse = mysqli_query($con,$selectinner);
            $innerrow = mysqli_fetch_array($innerresponse);
            $im = $innerrow['0'];
            $index['imagepath'] = "https://olx.onlineurbusiness.com".$im;
            array_push($result['Data'],$index);
            
        }
        echo json_encode($result);
    }else{
        //echo 'response not available';
    }
    
}

?>