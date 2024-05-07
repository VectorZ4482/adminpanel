<?php 

session_start();
include ('includes/header.php');
include ('includes/topbar.php');
include ('includes/sidebar.php');
include ('config/dbcon.php')
?>





<div class="content-wrapper">

<div class="content-header">    
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>





<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <?php 


if(isset($_SESSION["status"])){

  echo "<h4>". $_SESSION["status"] . "</h4>";
  unset($_SESSION["status"]);
};

?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edit - Registerd Users</h3>
                
                    <a href="register.php" class="btn btn-danger btn-sm float-right">Back</a>
                  
                
              </div>







              <div class="card-body">

<!-- Modal -->




<?php 


if(isset($_GET['user_id'])){
$user_id = $_GET['user_id'];

$get_query = "SELECT * FROM user WHERE id = '$user_id' LIMIT 1";

$get_query_result  = mysqli_query($conn , $get_query) or die("Query UnSuccesfull");

if(mysqli_num_rows($get_query_result) > 0){
    

while($row1 = mysqli_fetch_assoc($get_query_result)){



?>
      <form action="code.php" method = "POST">
    <div class="formgroup">
      <label for="">Name</label>
      <input type="hidden" name = "user_id" class= "form-control" placeholder="Enter Name" value = "<?php echo $row1 ['id']?>">
      <input type="text" name = "name" class= "form-control" placeholder="Enter Name" value = "<?php echo $row1 ['name']?>">
    </div>
    <div class="formgroup">
      <label for="">Email</label>
      <input type="email"name = "email" class= "form-control" placeholder="Enter Email" value = "<?php echo $row1 ['email']?>">
    </div>
    <div class="formgroup">
      <label for="">Address</label>
      <input type="text" name = "address" class= "form-control" placeholder="Enter Address" value = "<?php echo $row1 ['address']?>">
    </div>
    <div class="formgroup">
      <label for="">Password</label>
      <input type="password" name = "password" class= "form-control" placeholder="Enter Password" value = "<?php echo $row1 ['password']?>">
      
</div>
<button type="submit" name = "editUser" class="btn btn-primary float-right mt-4">Edit User</button>
</form>

<?php 
}
}else{
  echo "<h4>No Record Found</h4>";
}

}
?>




              </div>   

</div>

              </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>






</div>




<?php 


include ('includes/footer.php');
include ('includes/script.php');  
include ('includes/alert.php'); 


?>