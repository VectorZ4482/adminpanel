<?php


include('config/dbcon.php');

?>


<script src = "assets/plugins/sweetalert/sweetalert.js"></script>
 
 <?php
 if(isset($_SESSION['status']) && $_SESSION['status']){

 

 ?>
<script>
   swal({
   title: "<?php   echo $_SESSION['status']; ?>",
   icon: "<?php   echo $_SESSION['status_code']; ?>",
   button: "OK",
 });

 </script>



 <?php 
 unset($_SESSION['status']);
 }

 ?>


<?php include('script.php') ?>