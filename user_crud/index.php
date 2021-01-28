<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous">
    </script>

    <title>CRUD OPERATION</title>
  </head>
  <body>
    <div class="container-fluid">
        <div>
            <label for="exampleInputEmail1">All User Details</label>
            <a href="create_user.php"><button type="submit" class="my-3 mx-5 btn btn-dark">Create New Record</button></a>
        </div>
        <div id="empdata">
            <!-- // all ajax data fetch_user.php -->
        </div>
    </div>
  </body>
</html>

<script>
    // fetching all records
    function fetchUserData(){
        $(document).ready(function(){
            $.ajax({
                url:'fetch_user.php',
                type:'post',
                datatype:'html',
                success:function(empDataResponse){
                    $('#empdata').html(empDataResponse);
                }
            });
        });
    }

    fetchUserData();

    // deleting particular record
    function deleteUser(deleteUserId){
        $(document).ready(function(){
            const deleteId = deleteUserId;
            $.ajax({
                url:'user_delete.php',
                type:'post',
                data:{id:deleteId},
                success:function(){        
                    $(`#${deleteUserId}`).remove();
                    fetchUserData();
                }
            })
        });
    }

</script>