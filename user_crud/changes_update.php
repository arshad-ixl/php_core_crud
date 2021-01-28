<?php
include_once("config.php");

// print_r($_POST);
$user_id = $_POST['user_id'];
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

    $update_query = "UPDATE `user_details` SET `user_name`='$user_name',`user_dob`='$user_dob',`user_gender`='$user_gender',`user_state`='$user_state',`user_city`='$user_city',`user_profession`='$user_profession',`user_company_name`='$user_company_name', `user_job_start_date`='$user_job_start_date',`user_business_name`='$user_business_name', `user_location`='$user_location',`user_email`='$user_email',`user_mobile`='$user_mobile' WHERE `user_id`='$user_id' ";

    $result = mysqli_query($conn,$update_query);

    if($result){
        
        $delete_query = "DELETE FROM `user_education` where `edu_user_id`='$user_id' ";
        mysqli_query($conn,$edu_query);

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