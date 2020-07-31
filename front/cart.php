<?php

include("header.php");

?>


<?php 


if(isset($_POST['send'])){
    ?>
       <div class="alert alert-danger">
           <ul>
           <h2>Done checkk</h2>
        </ul>
</div>
<?php
}
?>


<div class="col-md-12">
<div class="row">
   
    <div class="products-tabs">
        <!-- tab -->
      
     
        
        <div id="tab1" class="tab-pane active">
            <div class="products-slick" data-nav="#slick-nav-1">
             
                <!-- product -->
                <?php
                if(isset($_SESSION['cart'])){
foreach($_SESSION['cart'] as $key=>$value)
    {?>
                <div class="product">
                    <div class="product-img">
                   <?php 
                         $value['item_quantity'];
                   echo"<td><img src=../upload/avatar/".$value['item_image']."></td>";
    ?>
                        <div class="product-label">
                            <h3></h3>
                        </div>
                    </div>
                    <div class="product-body">
                    
                  
                        
                        <h4 class="product-price"> price = <?php echo $value['item_price'];?><del class="product-old-price"> 65$</del></h4>
                        <h4 class="product-price"> Quantity = <?php echo $value['item_quantity'];?></h4>
                       <?php $total=$value['item_quantity']*$value['item_price'];?>
                        <h4 class="product-price">totalprice= <?php echo$total;?>
                        <div class="product-btns">

                        <?php $value['item_quantity'];?>
                     
                       <br> 
  <a  class="btn btn-danger" href="cart.php?action=delet&id=<?php echo $value['item_id'];?>">remove</a></button>


  </div>
                    </div>
                    
               </div>


    <form action="<?php echo $_SERVER['PHP_SELF']?>"  method="POST" > 
<input type="hidden"  name="id" value=<?php echo $value['item_id']?> > 
<input type="hidden"  name="name" value=<?php echo $value['item_name']?> > 
<input type="hidden"  name="price"value=<?php echo $value['item_price']?> > 
<input type="hidden"  name="name_user"value=<?php echo $_SESSION['name']?> > 
<input type="hidden"  name="email_user"value=<?php echo $_SESSION['email']?> > 
<input type="hidden" value=<?php echo $value['item_quantity']?> name="quantity" placeholder="price"> 
<input type="hidden" value=<?php echo $total?>> 
<input type="submit" style="background:red"  value="check proudct" name=send>

</form>



  <?php

}
  ?>
               
                <div class="container">
                    <?php if(empty($_SESSION['cart'])){
                        ?>
                
                <div class="alert alert-danger">
           <ul>
           <h2>no products</h2>
        </ul>
</div>
                <?php
                }
                ?>
</div>
              
               
</div>
</div>
<br><br>
   

<!-- Order Details -->
<div class="col-md-5 order-details">
<div class="section-title text-center">
    <h3 class="title">Your Order</h3>
</div>
<div class="order-summary">
    <div class="order-col">
        <div><strong>PRODUCT</strong></div>
        <div><strong>TOTAL</strong></div>
    </div>
   
    <div class="order-products">
        <div class="order-col">
            <div></div>
            <div></div>
        </div>
       
        
    <div class="order-col">
        <div><strong>TOTAL</strong></div>
        <div><strong class="order-total">
            <?php
$total=0;
if(isset($_POST['send'])){
foreach($_SESSION['cart'] as $key=>$value)
    {
      $total=$total+($value['item_quantity']*$value['item_price']);
    }
}

echo $total .'$';}
    ?>

        </strong></div>
    </div>
</div>


 
<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
if(isset($_POST['send'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $price=$_POST['price'];
    $total=$_POST['quantity'];
    $name_user=$_POST['name_user'];
    $email_user=$_POST['email_user'];
    $con=mysqli_connect("localhost","root","","shop");
    $query="INSERT INTO cart (id_proudct,name,price,totalprice,name_user,email_user)VALUE('$id','$name','$price','$total',' $name_user','$email_user')";
    $res=mysqli_query($con,$query);
}

}
?>

<!-- SECTION -->
<div class="section">
<!-- container -->
<div class="container">
<!-- row -->
<div class="row">
</div>
<!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /SECTION -->




</div>
</div>
</div>
</div>
























<?php

    include("footer.php");