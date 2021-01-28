<?php
include_once("config.php");
?>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">DOB</th>
      <th scope="col">Gender</th>
      <th scope="col">State</th>
      <th scope="col">City</th>
      <th scope="col">Skills</th>
      <th scope="col">Profession</th>
      <th scope="col">Company Name</th>
      <th scope="col">Job Started</th>
      <th scope="col">Business Name</th>
      <th scope="col">Location</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col">Photo</th>
      <th scope="col">Update</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  <form method='post'>
<?php 

$user_data_query = "select * from user_details";
$user_data_res = mysqli_query($conn,$user_data_query);

if($user_data_res->num_rows > 0){
    $c = 0;
    while($row = $user_data_res->fetch_assoc()){
        $c = $c + 1;
        ?>

        <tr id="<?php echo $row['user_id']; ?>">
            <th scope="row"><? echo $c; ?></th>
            <td><?php echo $row['user_name']; ?></td>
            <td><?php echo $row['user_dob']; ?></td>
            <td><?php echo $row['user_gender']; ?></td>
            <td><?php echo $row['user_state']; ?></td>
            <td><?php echo $row['user_city']; ?></td>
            <td><?php echo $row['user_skill']; ?></td>
            <td><?php echo $row['user_profession']; ?></td>
            <td><?php echo $row['user_company_name']; ?></td>
            <td><?php echo $row['user_job_start_date']; ?></td>
            <td><?php echo $row['user_business_name']; ?></td>
            <td><?php echo $row['user_location']; ?></td>
            <td><?php echo $row['user_email']; ?></td>
            <td><?php echo $row['user_mobile']; ?></td>
            <td><img src="user_profile_photo/<?php echo $row['user_image']; ?>" style="height:100px;width:100px;" alt="profile"></td>
            <td><a class="btn btn-success" href="user_upd.php?uid=<? echo $row['user_id']; ?>" >Update</a></td>
            <td><button type="submit" class="btn btn-danger" onclick="deleteUser(<? echo $row['user_id']; ?>)" >Delete</button></td>
        </tr>

        <?php
    }
}

?>
  </form>
  </tbody>
</table>