<?php
session_start();

$tot=$_SESSION['my_variable']; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Integartion (Stripe)</title>
    <!-- <link rel="stylesheet" href="./css/_style.css"/> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.7);
  transition: 0.3s;
  width: 30%;
  margin-left:530px;
  margin-top:3%;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);
}

.container {
  padding: 2px 16px;
}
.card-header{
     text-align:center;
     padding:10px 0px;
     background-color:#009970;
     color:white;
}
.card-footer{
     text-align:center;
}
.rate{
     font-size:30px;
     color:red;
}
.buy_now{
     border: 1px solid #009970;
  border-radius: 17px;
  padding: 10px 30px;
  background-color: #009970;
  color: white;
  /* margin-left:200px */
}
</style>
</head>
<body>



   <div class="card">
   <div class="card-header"><b>Khadhi Products</b></div> 
  <img src="./merge.jpg" alt="Avatar" style="width:100%" height="500px">
  <input type="hidden" name="image_src" id="image_src" value="./merge.jpg" />
  
  <div class="card-footer">
               <span class="rate">₹<?php echo $tot; ?></span><br><br>
                    <input  type="submit" name="submit" value="Buy" class="buy_now"/>
                    <input type="hidden" name="price"  id="price" value="<?php echo $tot; ?>"/>
                    <input type="hidden" name="item_name" id="item_name" value="Khadhi products"/>   
               </div><br>  
</div>
   <script>
    
     
        $(document).ready(function(){
           $(".buy_now").on('click',function(e){
                e.preventDefault();
                    var image_src = $(this).closest(".card").find("#image_src").attr("value");
                    var item_name = $(this).closest(".card").find("#item_name").attr("value");
                    var price = $(this).closest(".card").find("#price").attr("value");
                    var dt = '&image='+image_src+'&item_name='+item_name+'&price='+price;
                    var url = 'http://localhost/cvs/Consultancy/stripe/checkout.php?'+dt; 
                    
                    $.ajax({
                         url:url,
                         method:'GET',
                         success:function(){
                              window.location.href=url;
                         }
                    });
                   
                    
           });
          
        });
   </script>
</body>
</html>
