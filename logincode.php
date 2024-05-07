<?php 

session_start();
 include ('includes/alert.php'); 


include ('config/dbcon.php');

if(isset($_POST['login_btn'])){



    $email = $_POST['email'];
    $password = $_POST['password'];

    $log_query = "SELECT * FROM user WHERE email = '$email' AND password = '$password' LIMIT 1";

    $log_quey_run = mysqli_query($conn, $log_query);

    if(mysqli_num_rows($log_quey_run) > 0){

        foreach($log_quey_run as $row){
         $user_id   = $row['id'];
         $user_name   = $row['name'];
         $user_email   = $row['email'];
        

        }

        $_SESSION['auth'] = true;
        $_SESSION['auth_user'] = [

            'user_id' => $user_id,
            'user_name' => $user_name,
            'user_email' => $user_email,
        ];
        header('Location: index.php');
        $_SESSION['status'] = "LOGGED IN SUCCESSFULLY";
        $_SESSION['status_code'] = "success";
        

    }else{

        $_SESSION['status'] = "INVALID EMAIL OR PASSWORD ";
        $_SESSION['status_code'] = "error";
        header('Location: login.php');
    }
   
}else{

    $_SESSION['status'] = "ACCESS DENIED";
      $_SESSION['status_code'] = "warning";
    header('Location: login.php');
}

?>