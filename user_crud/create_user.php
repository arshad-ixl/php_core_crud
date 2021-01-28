<?php
include_once("config.php");
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

    <h3>Create New Record</h3>
        <form action="save_details.php" method="post" enctype="multipart/form-data" onsubmit="validation()">
            <div class="mb-3">
                <label class="form-label">User Name</label>
                <input type="text" class="form-control" id="user_name" name="user_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Date Of Birth</label>
                <input type="date" class="form-control" id="user_dob" name="user_dob" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Gender</label><br>
                Male : <input type="radio" name="user_gender" value="MALE" id="user_gender1" required><br>
                Female : <input type="radio" name="user_gender" value="FEMALE"  id="user_gender2" required><br>
                Others : <input type="radio" name="user_gender" value="OTHERS"  id="user_gender3" required><br>
            </div>
            <div class="mb-3">
                <label class="form-label">State</label><br>
                <select onchange="cititesOptions();" class="form-select" id="user_state" name="user_state" required>
                <option selected value="">Select State</option>
                <?php 
                    $state_query= "select distinct city_state from cities";
                    $state_res = mysqli_query($conn,$state_query);
                    while($row = $state_res->fetch_assoc()){

                ?>
                <option value="<?php echo $row['city_state']?>"><?php echo $row['city_state']; ?></option>
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
                <label class="form-label">Education Details</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="edu_name" name="edu_name[]" placeholder='Education'>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="edu_year_completion" name="edu_year_completion[]" placeholder='Year of Completion'>
                </div>
                <div class="col-md-2">
                    <span id="add_field_button" class="btn btn-primary">Add New</span>
                </div>


            </div>
            <div id="input_fields_wrap"></div>


            <br>

            <div class="mb-3">
                <label class="form-label">User Image</label>
                <input type="file" class="form-control" id="user_image" name="user_image" required>
            </div>
            
            <!-- // skills  -->
            <div class="mb-3">
            <label class="form-label">Skills</label>
            <select class="js-example-basic-multiple form-control" name="user_skill[]" multiple="multiple">
                <option value="FLUTTER">FLUTTER</option>
                <option value="JAVA">JAVA</option>
                <option value="KOTLIN">KOTLIN</option>
                <option value="PYTHON">PYTHON</option>
            </select>
            </div>
           
            <!-- skills end -->

            <div class="mb-3">
                <label class="form-label">Certificates (Select One or More Files)</label>
                <input type="file" class="form-control" id="crt_name" name="crt_name[]" multiple>
            </div>
            <div class="mb-3">
                <label class="form-label">Profession</label><br>
                <label for="user_profession1">Salaried</label> : <input type="radio" name="user_profession" value="Salaried" onclick="selectedProfession('Salaried');" id="user_profession1" required><br>
                <label for="user_profession2">Self-employed</label> : <input type="radio" name="user_profession" value="Self-employed" onclick="selectedProfession('Self-employed');" id="user_profession2" required><br>
            </div><hr>

            <div class="mb-3" id="company_name" style="display:none">
                <label class="form-label">Company Name</label><br>
                <input type="text" name="user_company_name" id="user_company_name" class="form-control"><br>
            </div>
            <div class="mb-3" id="job_started" style="display:none">
                <label class="form-label">Job Started From</label><br>
                <input type="date" name="user_job_start_date" id="user_job_start_date" class="form-control"><br>
            </div>

            <div class="mb-3" id="business_name" style="display:none">
                <label class="form-label">Business Name</label><br>
                <input type="text" name="user_business_name" id="user_business_name" class="form-control"><br>
            </div>
            <div class="mb-3" id="location" style="display:none">
                <label class="form-label">Location</label><br>
                <input type="text" name="user_location" id="user_location" class="form-control"><br>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="Email" class="form-control" id="user_email" name="user_email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="user_mobile" name="user_mobile" minlength="10" maxlength="10" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
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
    // alert(SelectedState);
    $.ajax({
        url:'city_list.php',
        type:'post',
        datatype:'html',
        data:{state:SelectedState},
        success:function(cities){
            $('#user_city').html(cities);
        }
    })
    
}
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

$(document).on("submit", "form", function(e){
    
    // var user_name = $("#user_name").val();
    if($("#user_name").val()==='' ||  $("#user_dob").val()==='' ||  $("#user_gender").val()==='' ||  $("#user_state").val()==='' || $("#user_image").val()==='' ||  $("#user_profession").val()==='' || $("#user_email").val()==='' ||  $("#user_mobile").val()===''){
        e.preventDefault();
        alert('Please Enter All Details!');
    }
});

    </script>

</html>