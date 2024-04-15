<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select_users = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'Email already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `admin`(name, email, password) VALUES('$name', '$email', '$cpass')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:admin_login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

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
      <h3>register now</h3>
      <input type="text" name="name" placeholder="enter your name" required class="box">
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="admin_login.php">login now</a></p>
   </form>

   <script>
  function validateForm() {
    var name = document.forms["registrationForm"]["name"].value;
    var email = document.forms["registrationForm"]["email"].value;
    var password = document.forms["registrationForm"]["password"].value;
    var cpassword = document.forms["registrationForm"]["cpassword"].value;

    // Name validation (only alphabets and spaces)
    var nameRegex = /^[A-Za-z\s]+$/;
    if (!name.match(nameRegex)) {
      alert("Name can only contain alphabets and spaces.");
      return false;
    }

    // Email validation (only @gmail.com and @gmail.in allowed)
    var emailRegex = /^[\w-]+@gmail\.(com|in)$/;
    if (!email.match(emailRegex)) {
      alert("Email must be of the form '@gmail.com' or '@gmail.in'.");
      return false;
    }

    // Password validation (8 characters, alphanumeric)
    var passwordRegex = /^(?=.*\d)(?=.*[A-Za-z]).{8,}$/;
    if (!password.match(passwordRegex)) {
      alert("Password must be at least 8 characters and contain both letters and numbers.");
      return false;
    }

    // Confirm Password validation
    if (password !== cpassword) {
      alert("Password and Confirm Password do not match.");
      return false;
    }

    // If all validations pass, the form will be submitted
    return true;
  }
</script>


</div>

</body>
</html>