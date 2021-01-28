<?php 
include('config.php');
$state = $_POST['state'];

if(isset($_POST['old_city_name'])){ $old_city_name = $_POST['old_city_name'];}else{ $old_city_name = "";}



$city_list = mysqli_query($conn,"select * from cities where city_state='$state'");
if($city_list->num_rows > 0){
    while($row = $city_list->fetch_assoc()){
        ?>
            <option value="<?php echo $row['city_name'] ?>" <?php if($row['city_name']==$old_city_name){ echo "selected";} ?> ><?php echo $row['city_name'] ?></option>
        <?php
    }
}

?>