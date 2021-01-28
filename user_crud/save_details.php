<?php
include_once("config.php");

$user_name = $_POST['user_name'];
$user_dob = $_POST['user_dob'];
$user_gender = $_POST['user_gender'];
$user_state = $_POST['user_state'];
$user_city = $_POST['user_city'];
$user_skill = implode("-",$_POST['user_skill']);

$user_profession = $_POST['user_profession'];
if($user_profession == "Salaried"){
    $user_company_name = $_POST['user_company_name'];
    $user_job_start_date = $_POST['user_job_start_date'];
    $user_business_name = null;
    $user_location = null;
}else{
    $user_company_name = null;
    $user_job_start_date = null;
    $user_business_name = $_POST['user_business_name'];
    $user_location = $_POST['user_location'];
}
$user_email = $_POST['user_email']; 
$user_mobile = $_POST['user_mobile'];

// image upload
$user_image = $_FILES["user_image"]["name"]; 
$image_tempname = $_FILES["user_image"]["tmp_name"];     
$folder = "user_profile_photo/".$user_image; 
move_uploaded_file($image_tempname, $folder);

if($user_profession == "Salaried"){
    $user_insert_query = "INSERT INTO `user_details`(`user_name`, `user_dob`, `user_gender`, `user_state`, `user_city`,`user_image`,`user_profession`, `user_company_name`, `user_job_start_date`,`user_email`,`user_mobile`,`user_skill`) 
    VALUES ('$user_name','$user_dob','$user_gender','$user_state','$user_city','$user_image','$user_profession','$user_company_name','$user_job_start_date','$user_email','$user_mobile','$user_skill')";
    $user_insert_query_result = mysqli_query($conn,$user_insert_query);
}else{
    $user_insert_query = "INSERT INTO `user_details`(`user_name`, `user_dob`, `user_gender`, `user_state`, `user_city`,`user_image`,`user_profession`, `user_business_name`, `user_location`, `user_email`,`user_mobile`,`user_skill`) 
    VALUES ('$user_name','$user_dob','$user_gender','$user_state','$user_city','$user_image','$user_profession','$user_business_name','$user_location','$user_email','$user_mobile','$user_skill')";
    $user_insert_query_result = mysqli_query($conn,$user_insert_query);
    }

// saving certi
$current_id = $conn->insert_id;
if($current_id){
    $upload_dir = 'user_certificates/'.DIRECTORY_SEPARATOR;
    foreach ($_FILES['crt_name']['tmp_name'] as $key => $value) {
        $file_tmpname = $_FILES['crt_name']['tmp_name'][$key]; 
        $file_name = $_FILES['crt_name']['name'][$key]; 

        $filepath = $upload_dir.$file_name;
        move_uploaded_file($file_tmpname, $filepath);
        $cert_query = "INSERT INTO `user_certificate`(`crt_name`, `crt_user_id`) VALUES ('$file_name','$current_id')";
        $cert_query_result = mysqli_query($conn,$cert_query);
        
    }

    //education insertion
    foreach($_POST['edu_name'] as $key => $edu_value){
        $edu_name = $edu_value;
        $edu_year_completion = $_POST['edu_year_completion'][$key];
        $edu_query = "INSERT INTO `user_education`(`edu_name`, `edu_year_completion`, `edu_user_id`) VALUES ('$edu_name','$edu_year_completion','$current_id')";
        mysqli_query($conn,$edu_query);
    }
}
header('Location:index.php');
?>