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

$listing_id = $_POST["listing_id"];
//-----------------------$target_dir = "../../olx.onlineurbusiness.com/uploads/images/listings";
$target_dir = "../uploads/images/listings";
$pathdir = "/uploads/images/listings";
 $image_form_key=rand();
 $sort_order=1;
 $date = date('Y-m-d H:i:s');
$created_at= $date;
$updated_at= $date;

if(!file_exists($target_dir)){
    mkdir($target_dir,0777,true);
}
$target_dir = $target_dir."/".basename($_FILES["file"]["name"]);
$pathdir = $pathdir."/".basename($_FILES["file"]["name"]);
$folder_path = $target_dir;

if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_dir)){
    
$sql = "INSERT INTO ea_listing_image (listing_id,image_form_key,image_path,sort_order,created_at,updated_at) 
VALUES ('$listing_id','$image_form_key','$pathdir',$sort_order,'$created_at','$updated_at')";
mysqli_query($conn, $sql);
    
    echo json_encode([
        "Messege" => "The file has been uploaded",
        "Status" => "OK",
        "listingId" => $_POST["listing_id"],
        "filepath" => $folder_path
        ]);
}else{
    echo json_encode([
        "Messege" => "Error uploading file",
        "Status" => "Error",
        "listingId" => $_POST["listing_id"],
        "filepath" => $folder_path
        ]);
}

}
?>