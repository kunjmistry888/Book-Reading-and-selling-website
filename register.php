<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));


   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'email already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$cpass')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:login.php');
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
   <title>register</title>

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

<form action="" method="post" onsubmit="return validateForm()">
    <h3>Register Now</h3>
    <input type="text" name="name" id="name" placeholder="Enter your name" required class="box">
    <span id="nameError" class="error"></span>

    <input type="email" name="email" id="email" placeholder="Enter your email" required class="box">
    <span id="emailError" class="error"></span>

    <input type="password" name="password" id="password" placeholder="Enter your password" required class="box">
    <span id="passwordError" class="error"></span>

    <input type="password" name="cpassword" id="cpassword" placeholder="Confirm your password" required class="box">
    <span id="cpasswordError" class="error"></span>

    <input type="submit" name="submit" value="Register Now" class="btn">
    <p>Already have an account? <a href="login.php">Login Now</a></p>
</form>

<script>
function validateForm() {
    // Get form input values
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var cpassword = document.getElementById("cpassword").value;

    // Regular expressions for validation
    var nameRegex = /^[A-Za-z\s]+$/;
    var emailRegex = /^[\w-]+@(gmail\.com|gmail\.in)$/;
    var passwordRegex = /^(?=.*\d)(?=.*[A-Za-z]).{8,}$/;

    // Error messages
    var nameError = document.getElementById("nameError");
    var emailError = document.getElementById("emailError");
    var passwordError = document.getElementById("passwordError");
    var cpasswordError = document.getElementById("cpasswordError");

    // Reset previous error messages
    nameError.innerHTML = "";
    emailError.innerHTML = "";
    passwordError.innerHTML = "";
    cpasswordError.innerHTML = "";

    // Validate name
    if (!name.match(nameRegex)) {
        nameError.innerHTML = "Name should contain only alphabets and spaces.";
        return false;
    }

    // Validate email
    if (!email.match(emailRegex)) {
        emailError.innerHTML = "Invalid email address. Only @gmail.com and @gmail.in are accepted.";
        return false;
    }

    // Validate password
    if (!password.match(passwordRegex)) {
        passwordError.innerHTML = "Password should be at least 8 characters long and contain both letters and digits.";
        return false;
    }

    // Confirm password
    if (password !== cpassword) {
        cpasswordError.innerHTML = "Passwords do not match.";
        return false;
    }

    // If all validations pass, the form is submitted
    return true;
}
</script>

   

</div>

</body>
</html>