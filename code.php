<?php 
session_start();

include('config/dbcon.php');


if(isset($_POST['check_Emailbtn'])){
   $email = $_POST['email'];
   $checkemail = "SELECT email FROM user WHERE email = '$email' ";
   $checkemail_run = mysqli_query($conn , $checkemail);
   
   if(mysqli_num_rows($checkemail_run) > 0){
      echo "EMAIL ID ALREADY TAKEN";
   } else {
      echo "It's Available";
   }
   exit; // Make sure to exit after echoing the response.
}


// USER ADD

if(isset($_POST['addUser'])){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $address = $_POST['address'];
   $password = $_POST['password'];
   $confirmpassword = $_POST['confirmpassword'];

   if($password == $confirmpassword){


      $checkemail = "SELECT email FROM user WHERE email = '$email' ";
      $checkemail_run = mysqli_query($conn , $checkemail);

      if(mysqli_num_rows($checkemail_run) > 0){
         $_SESSION['status'] = "EMAIL ALREADY EXISTS";
         $_SESSION['status_code'] = "warning";
         header("Location: register.php");

         exit;
      }else{

         $add_query = "INSERT INTO user (name, email, address, password) VALUES ('$name', '$email' , '$address', '$password')";

         $add_query_start = mysqli_query($conn , $add_query);
      
      
         if($add_query_start){
      
          $_SESSION['status'] = "USER ADDED SUCCESSFULLY";
          $_SESSION['status_code'] = "success";
          header("Location: register.php");
         }
      
         else{
      
          $_SESSION['status'] = "USER REGISTERATION FAILED";
          $_SESSION['status_code'] = "error";
          header("Location: register.php");
         };

      };

                           

   }else{
      $_SESSION['status'] = "PASSWROD DOES NOT MATCH";
      $_SESSION['status_code'] = "error";
      header("Location: register.php");


   }


  

}





// USER UPDATE

if(isset($_POST['editUser'])){

   $user_id = $_POST['user_id'];
   $name = $_POST['name'];
   $email = $_POST['email'];
   $address = $_POST['address'];
   $password = $_POST['password'];


   $update_query = "UPDATE user SET name = '$name' , email = '$email', address = '$address', password = '$password' WHERE id = '$user_id'";
   $update_query_start = mysqli_query($conn, $update_query);



   if($update_query_start){

      $_SESSION['status'] = "USER UPDATED SUCCESSFULLY";
      $_SESSION['status_code'] = "success";
      header("Location: register.php");
     }
   
     else{
   
      $_SESSION['status'] = "USER UPDATE FAILED";
       $_SESSION['status_code'] = "error";
      header("Location: register.php");
     };
}
include ('includes/script.php') ;


if(isset($_POST['delete_btn_set'])){

   $del_id = $_POST['delete_id'];
   $reg_query = "DELETE FROM user WHERE id = '$del_id'";
   $reg_query_run = mysqli_query($conn,$reg_query);
}



?>