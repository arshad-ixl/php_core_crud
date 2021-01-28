<?php
include_once("config.php");

echo $delId = $_POST['id'];
echo $delete_user_query = "delete from user_details where user_id='$delId'";
$delete_user_res = mysqli_query($conn,$delete_user_query);
if($delete_user_res){
    return true;
}


// if(isset($_POST['id'])){
//     $deleteId = $_POST['id'];
//     $delete_user_query = "delete from page where id='$deleteId'";
//     $delete_user_res = mysqli_query($conn,$delete_user_query);
// }

?>