<?php

session_start();
include ('includes/header.php');
include ('includes/topbar.php');
include ('includes/sidebar.php');
include ('config/dbcon.php')
  ?>

<style>
.showpw{
  margin-top: 19px;
  margin-left: 3px;
}

.form-check-label {
  margin-left: 1px;
  font-weight: bold;
  cursor: pointer;
}

.cbox{
  margin-top: 6px;
}



</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Modal -->
  <div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="code.php" method="post">

            <div class="formgroup">
              <label for="">Name</label>
              <input type="text" name="name" class="form-control" placeholder="Enter Name">
            </div>
            <div class="formgroup">
              <label for="" >Email</label>
             <b> <span class = "email_error text-primary  ml-2 mt-1"></span></b>
              <input type="email" name="email" class="form-control email_id" placeholder="Enter Email">
            </div>
            <div class="formgroup">
              <label for="">Address</label>
              <input type="text" name="address" class="form-control" placeholder="Enter Addres">
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="formgroup">
                  <label for="">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Enter Password"  id = "Show">
                  <!-- <i class="fa-solid fas fa-eye"></i> -->
                </div>

              </div>

              <div class="col-md-6 ">
                <div class="formgroup">
                  <label for=""> Confirm Password</label>
                  <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" id = "Show2">
                  <!-- <i class="fa-solid fas fa-eye"></i> -->
                </div>
              </div>
            </div>
            <div class="showpw">
    <div class="form-check">
      <input type="checkbox" class="form-check-input cbox" id="showPassword" onclick="showpw()">
      <label class="form-check-label" for="showPassword">Show Password</label>
    </div>
  </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="addUser" class="btn btn-primary">Add User</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Registered User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Registerd User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Registerd Users</h3>

              <a href="" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#AddUser">Add
                User</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">



              <?php
              $sql = "SELECT * FROM user";

              $result = mysqli_query($conn, $sql) or die("Query UnSuccesfull");

              if (mysqli_num_rows($result) > 0) {




                ?>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>NAME</th>
                      <th>EMAIL</th>
                      <th>PASSWORD</th>
                      <th>ADDRESS</th>
                      <th>ACTIONS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {

                      ?>


                      <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td> <?php echo $row['address']; ?></td>
                        <td><a href="edit.php?user_id=<?php echo $row['id'] ?>" class="btn btn-success btn-sm">EDIT</a>
                          <input type="hidden" class="delete_id_value" value="<?php echo $row['id'] ?>">
                          <a href="javascript:void(0)" class="deletebtn btn btn-danger btn-sm"> DELETE</a>

                          <!-- <button  type = "button" value = "<?php echo $row['id'] ?>" href = "#" class= "btn btn-danger btn-sm deletebtn">DELETE</button></td> -->

                      </tr>
                      <?php

                    }
                    ?>

                  </tbody>
                </table>

                <?php
              } else {
                echo "<h1> NO RECORDS FOUND </h1>";
              }
              ?>
            </div>
            <!-- /.card-body -->
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




<!-- FOOTER / SCRIPT IN CLUDES -->

<?php include ('includes/footer.php'); ?>
<?php include ('includes/script.php'); ?>
<?php include ('includes/alert.php'); ?>



<!-- CONFIRM AND DELETE -->



<script>

  $(document).ready(function () {
    $('.email_id').keyup(function (e) { 
      
      var email = $('.email_id').val();
      
      $.ajax({
        type: "POST",
        url: "code.php",
        data: {
          'check_Emailbtn' : 1,
          'email' : email,
        },

        success: function (response) {
          // alert(response);

          $('.email_error').text(response);
          
        }
      });
    });
  });
</script>



<script>




  $(document).ready(function () {
    $('.deletebtn').click(function (e) {
      e.preventDefault();

      var deleteid = $(this).closest("tr").find('.delete_id_value').val();

      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          $.ajax({
            type: "POST",
            url: "code.php",
            data: {
              "delete_btn_set": 1,
              "delete_id": deleteid
            }, // Comma was missing here
            success: function (response) {
              swal("DATA DELETED SUCCESSFULLY", {
                icon: "success",
              }).then((result) => {
                location.reload();
              });
            }
          });
        }
      });
    });
  });





</script>