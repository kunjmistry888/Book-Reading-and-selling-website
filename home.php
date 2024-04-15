<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
<style>
.category .box-container{
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(27rem, 1fr));
   gap: 1rem;
   align-items: flex-start;
}

.category .box-container .box{
   border:var(--border);
   padding:1rem;
   text-align: center;
}

.category .box-container .box img{
   width: 100%;
   height: 10rem;
   object-fit: contain;
}

.category .box-container .box h3{
   font-size: 2rem;
   margin-top: 1.5rem;
   color:var(--black);
   text-transform: capitalize;
}

.category .box-container .box:hover{
   background-color: var(--black);
}

.category .box-container .box:hover img{
   filter: invert(1);
}

.category .box-container .box:hover h3{
   color:var(--white);
}

.products .box-container .box .cat{
   font-size: 1.8rem;
   color:var(--light-color);
}

.products .box-container .box .cat:hover{
   color:var(--black);
   text-decoration: underline;
}

</style>

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3>Hand Picked Book to your door.</h3>
      <p></p>
      <a href="pay.php" class="white-btn">Subscription</a>
   </div>

</section>

<section class="category">

   <h1 class="title">Book category</h1>

   <div class="box-container">

      <a href="category.php?category=Programming" class="box">
      <!--<img src="images/programming.jpg" alt="">-->
         <h3>Programming</h3>
      </a>

      <a href="category.php?category=History" class="box">
         <!--<img src="images/history.jpg" alt="">-->
         <h3>History</h3>
      </a>

      <a href="category.php?category=Mystery" class="box">
         <!--<img src="images/mystry.jpg" alt="">-->
         <h3>mystery</h3>
      </a>

      <a href="category.php?category=Kids" class="box">
         <!--<img src="images/kids.jpg" alt="">-->
         <h3>Kids</h3>
      </a>

      <a href="category.php?category=Crime" class="box">
         <!--<img src="images/kids.jpg" alt="">-->
         <h3>Crime</h3>
      </a>

      <a href="category.php?category=Romance" class="box">
         <!--<img src="images/kids.jpg" alt="">-->
         <h3>Romance</h3>
      </a>

      <a href="category.php?category=Biography" class="box">
         <!--<img src="images/kids.jpg" alt="">-->
         <h3>Biography</h3>
      </a>

      <a href="category.php?category=Business and Money" class="box">
         <!--<img src="images/kids.jpg" alt="">-->
         <h3>Business and Money</h3>
      </a>

      <a href="category.php?category=Cooking" class="box">
         <!--<img src="images/kids.jpg" alt="">-->
         <h3>Cooking</h3>
      </a>

      <a href="category.php?category=Motivational / Inspirational" class="box">
         <!--<img src="images/kids.jpg" alt="">-->
         <h3>Motivational / Inspirational</h3>
      </a>

   </div>

</section>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 3") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price"><?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <a href="pay.php" class="btn btn-success">Read</a>
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
	
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>
   

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div>

</section>


<!--<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>about us</h3>
         <p></p>
         <a href="about.php" class="btn">read more</a>
      </div>

   </div>

</section>-->

<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p></p>
      <a href="contact.php" class="white-btn">contact us</a>
   </div>

</section>





<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>
</html>