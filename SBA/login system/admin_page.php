<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Retail costumer</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <!-- <h3>hi, <span>admin</span></h3> -->
      <h1>Welcome <span><?php echo $_SESSION['admin_name'] ?></span></h1>
      <p><i>Happy to see you again on CVS Khadhi Stores</i></p>
      <a href="../../Php-shopping-cart/Cart.php" class="btn">Purchase</a>
     
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

</body>
</html>