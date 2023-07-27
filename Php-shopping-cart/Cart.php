<?php
    session_start();
    $database_name = "shop";
    $con = mysqli_connect("localhost","root","",$database_name);

    if (isset($_POST["add"])){
        if (isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"],"product_id");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'item_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="Cart.php"</script>';
             }//else{
            //     echo '<script>alert("Product is already Added to Cart")</script>';
            //     echo '<script>window.location="Cart.php"</script>';
            // }
        }else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }

    if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("Product has been Removed...!")</script>';
                    echo '<script>window.location="Cart.php"</script>';
                }
            }
        }
    }
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style>
        /* @import url('https://fonts.googleapis.com/css?family=Titillium+Web');

        *{
            font-family: 'Titillium Web', sans-serif;
        } */
        .product{
            border: 1px solid #eaeaec;
            /* margin: -1px 10px 3px -1px; */
            padding: 10px;
            text-align: center;
            background-color: #efefef;
        }
        table, th, tr{
            text-align: center;
        }
        .title2{
            text-align: center;
            color: white;
            background-color: #009970;
            padding: 2%;
        }
        h2{
            text-align: center;
            color: white;
            background-color: #009970;
            padding: 2%;
        }
        table th{
            background-color: #efefef;
        }

        .image{
          width: 200px;
          height: 250px;
        }
        .btn{
          margin-top: 20px;
          margin-bottom: 10px;
          background-color: #009970;
          color:white;

        }

       


        
    </style>
</head>
<body>

     <div class="container" style="width: 80%,height:60%">
        <h2><b>Shopping Cart</b></h2><br>
        <?php
            $query = "SELECT * FROM product ORDER BY id ASC ";
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

                    ?>
                    <div class="col-md-3" >

                        <form method="post" action="Cart.php?action=add&id=<?php echo $row["id"]; ?>">

                            <div class="product">
                                <img class="image" src="<?php echo $row["image"]; ?>" class="img-responsive" >
                                <h5 class="text-info"><?php echo $row["pname"]; ?></h5>
                                <h5 class="text-danger"><?php echo $row["price"]; ?></h5>
                                <input type="text" name="quantity" class="form-control" value="1">
                                <input type="hidden" name="hidden_name" value="<?php echo $row["pname"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                                <input type="submit" name="add"  class="btn"
                                       value="Add to Cart">
                            </div>
                        </form>
                    </div>
                    <?php
                }
            }
        ?> 


 
    
  


        <div style="clear: both"></div>
        <br>
        <h3 class="title2"><b>Shopping Cart Details</b></h3>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="30%">Product Name</th>
                <th width="10%">Quantity</th>
                <th width="13%">Price Details</th>
                <th width="10%">Total Price</th>
                <th width="17%">Remove Item</th>
            </tr>

            <?php
                if(!empty($_SESSION["cart"])){
                    $total = 0;
                    foreach ($_SESSION["cart"] as $key => $value) {
                        ?>
                        
                        <tr>
                            <td><?php echo $value["item_name"]; ?></td>
                            <td><?php echo $value["item_quantity"]; ?></td>
                            <td>RUPEES : <?php echo $value["product_price"]; ?></td>
                            <td>
                            RUPEES : <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                            <td><a href="Cart.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span
                                        class="text-danger">Remove Item</span></a></td>

                        </tr>
                        <?php
                        $total = $total + ($value["item_quantity"] * $value["product_price"]);
                        $_SESSION['my_variable'] = $total; 
                        if (isset($_SESSION['my_variable'])) 
                        {
                            // The session variable is set
                            $my_var = $_SESSION['my_variable'];
                        } else 
                        {
                            // The session variable is not set
                            $my_var = null;
                        }
                        
                    }
                    // echo "$my_var";
                        ?>
                        <tr>
                            <td colspan="3" align="right">Total</td>
                            <th align="right">RUPEES:<?php echo number_format($total, 2); ?></th>
                            <!-- <td></td> -->
                            <td><a href="../stripe/index.php"><h5><b>Proceed to pay</b></h5></a></td>
                        </tr>
                        
                        <h3> Bill:  <?php
                        //  echo "$total"
                        // $true=isset($_SESSION['my_var']);
                       
                       
                        ?><h3>
                       
                        <?php
                    }
                ?>
            </table>
        </div>

    </div>


</body>
</html>