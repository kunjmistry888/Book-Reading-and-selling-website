<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
   $row = mysqli_fetch_assoc($select_users);

   if(mysqli_num_rows($select_users) > 0){

      $_SESSION['user_name'] = $row['name'];
      $_SESSION['user_email'] = $row['email'];
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
</script>
<script type="text/javascript">
   (function(){
      emailjs.init("d96D_T73AMRsQhVSw");
   })();
</script>

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="submit" name="submit" value="login now" class="btn">
      <button class="btn btn-sm btn-warning" style="text-align:left" onclick="forg()">forget Password? </button>
      <p>don't have an account? <a href="register.php">register now</a></p>
   </form>

</div>
<script>
   function forg() {
      var mail=prompt("Enter Your Email : ");
      var digits = '0123456789';
          var OTP = "";
          for (let i = 0; i < 4; i++ ) {
              OTP += digits[Math.floor(Math.random() * 10)];
          }
      var para = { otp : OTP,
         email: mail };
      emailjs.send("service_o32tvxl","template_ykhibfj", para);
      var inp=0;
      inp=prompt("Enter OTP: ");

      if(inp==OTP){
         document.location.href="home.php";
      }
      else {
         alert("Wrong OTP");
      }
      
   }
   </script>
</body>
</html>