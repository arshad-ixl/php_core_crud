<?php
include_once("config.php");
$user_id = $_GET['uid'];
$user_details_query = "SELECT * FROM `user_details` where user_id='$user_id'";
$user_details_query_res = mysqli_query($conn,$user_details_query);
$row = $user_details_query_res->fetch_assoc();
// print_r($row);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  </head>
  <body>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous">
    </script>
        <!-- select2 cdn -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <div class="container">

    <h3>Update Record</h3>
        <form action="changes_update.php" method="post" enctype="multipart/form-data">
            
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $row['user_id']; ?>" >
            <input type="hidden" id="old_city_name" value="<?php echo $row['user_city']; ?>">
            <div class="mb-3">
                <label class="form-label">User Name</label>
                <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $row['user_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Date Of Birth</label>
                <input type="date" class="form-control" id="user_dob" name="user_dob" value="<?php echo $row['user_dob']; ?>" required>
            </div><hr>
            <div class="mb-3">
                <label class="form-label">Gender</label><br>
                Male : <input type="radio" name="user_gender" value="MALE" id="user_gender1" <?php if($row['user_gender']=='MALE'){ echo 'checked';}?> ><br>
                Female : <input type="radio" name="user_gender" value="FEMALE"  id="user_gender2" <?php if($row['user_gender']=='FEMALE'){ echo 'checked';}?>><br>
                Others : <input type="radio" name="user_gender" value="OTHERS"  id="user_gender3" <?php if($row['user_gender']=='OTHERS'){ echo 'checked';}?>><br>
            </div><hr>
            <div class="mb-3">
                <label class="form-label">State</label><br>
                <?php
                // echo $row['user_state'];
                ?>
                <select onchange="cititesOptions();" class="form-select" id="user_state" name="user_state" required>
                <option selected value="">Select State</option>
                <?php 
                    $state_query= "select distinct city_state from cities";
                    $state_res = mysqli_query($conn,$state_query);
                    while($row1 = $state_res->fetch_assoc()){
                ?>
                <option value="<?php echo $row1['city_state']?>" <?php if($row1['city_state']==$row['user_state']){ echo 'selected';}?> ><?php echo $row1['city_state']; ?></option>
                <?php }  ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">City</label><br>
                <select id="user_city" class="form-select" id="user_city" name="user_city" required>
                <option selected value="">Select City</option>
                </select>
            </div>
            
            <div class="row">
            <?php
            $edu_query = "SELECT * FROM `user_education` where edu_user_id='$user_id'";
            $edu_query_res = mysqli_query($conn,$edu_query);
            ?>

                <label class="form-label">Education Details</label>
                <?php
                while($edu_row = $edu_query_res->fetch_assoc()){
                ?>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="edu_name_<?php echo $edu_row['edu_id'];?>" name="edu_name[]" value="<?php echo $edu_row['edu_name'];?>" placeholder='Education'>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="edu_year_completion_<?php echo $edu_row['edu_id'];?>" name="edu_year_completion[]" value="<?php echo $edu_row['edu_year_completion'];?>" placeholder='Year of Completion'>
                </div>
                <?php } ?>

                <div class="col-md-2">
                    <span id="add_field_button" class="btn btn-primary">Add New</span>
                </div>

            </div>
            <div id="input_fields_wrap"></div>


            <br>

            <div class="mb-3">
                <label class="form-label">Profession</label><br>
                <label for="user_profession1">Salaried</label> : <input type="radio" name="user_profession" value="Salaried" onclick="selectedProfession('Salaried');" id="user_profession1" <?php if($row['user_profession']=='Salaried'){echo 'checked';} ?>><br>
                <label for="user_profession2">Self-employed</label> : <input type="radio" name="user_profession" value="Self-employed" onclick="selectedProfession('Self-employed');" id="user_profession2" <?php if($row['user_profession']=='Self-employed'){echo 'checked';} ?>><br>
            </div><hr>
            
            <div class="mb-3" id="company_name" style="display:<?php if($row['user_profession']=='Salaried'){ echo 'block';}else{ echo 'none';}?>">
                <label class="form-label">Company Name</label><br>
                <input type="text" name="user_company_name" id="user_company_name" class="form-control" value="<?php echo $row['user_company_name']; ?>"><br>
            </div>
            <div class="mb-3" id="job_started" style="display:<?php if($row['user_profession']=='Salaried'){ echo 'block';}else{ echo 'none';}?>">
                <label class="form-label">Job Started From</label><br>
                <input type="date" name="user_job_start_date" id="user_job_start_date" class="form-control" value="<?php echo $row['user_job_start_date']; ?>"><br>
            </div>

            <div class="mb-3" id="business_name" style="display:<?php if($row['user_profession']=='Self-employed'){ echo 'block';}else{ echo 'none';}?>">
                <label class="form-label">Business Name</label><br>
                <input type="text" name="user_business_name" id="user_business_name" class="form-control" value="<?php echo $row['user_business_name']; ?>"><br>
            </div>
            <div class="mb-3" id="location" style="display:<?php if($row['user_profession']=='Self-employed'){ echo 'block';}else{ echo 'none';}?>">
                <label class="form-label">Location</label><br>
                <input type="text" name="user_location" id="user_location" class="form-control" value="<?php echo $row['user_location']; ?>"><br>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo $row['user_email'];?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="user_mobile" name="user_mobile" value="<?php echo $row['user_mobile']; ?>" minlength="10" maxlength="10" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
  </body>

    <script>

    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $("#input_fields_wrap"); //Fields wrapper
    var add_button      = $("#add_field_button"); //Add button ID
    var x = 1; //initlal text box count
    $(add_button).on("click",function(e){ //on add input button click
        e.preventDefault();
    //    alert(x);
        if(x < max_fields){ //max input box allowed
            // var series_id = x;
            x++; //text box increment
            $(wrapper).append('<div class="dynamic_div_class" id="dynamic_div_'+x+'"><div class="row"><div class="col-md-6"><input type="text" class="form-control" id="edu_name'+x+'" name="edu_name[]" placeholder="Education"></div><div class="col-md-4"><input type="text" class="form-control" id="edu_year_completion'+x+'" name="edu_year_completion[]" placeholder="Year of Completion"></div><div class="col-md-2"><span onclick="remove_dynamic_row('+x+')" class="btn btn-primary">Remove</span></div></div></div>');

        }
    });
    function remove_dynamic_row(row){
        // alert(row);
      $("#dynamic_div_"+row).remove();
    }
    function selectedProfession(value){
        // alert(value);
        if(value==='Salaried'){
            $("#company_name").show();
            $("#job_started").show();
            $("#business_name").hide();
            $("#location").hide();


        }else if(value==='Self-employed'){
            $("#company_name").hide();
            $("#job_started").hide();
            $("#business_name").show();
            $("#location").show();
        }

    }

    function cititesOptions(){
    var SelectedState = $('#user_state').val();
    var old_city_name = $('#old_city_name').val();
    // alert(old_city_name);
    // alert(SelectedState);
    $.ajax({
        url:'city_list.php',
        type:'post',
        datatype:'html',
        data:{state:SelectedState,old_city_name:old_city_name},
        success:function(cities){
            $('#user_city').html(cities);
        }
    })
    
}
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    cititesOptions();
});
    </script>

</html>