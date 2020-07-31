<?php

include('header.php');
include("function.php");

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

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
				
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
										<!-- product -->

										<?php
$con=mysqli_connect("localhost","root","","shop");

 $query="SELECT post.*,catagory.name 
 AS cat_name 
 
 FROM post
  INNER JOIN catagory ON catagory.id=post.cat_id 
  
  ";

  
$res=mysqli_query($con,$query);
while($row=mysqli_fetch_assoc($res)){
 


										?>
										<div class="product">
											<div class="product-img">
											<?php echo"<td><img src=../upload/avatar/".$row['image']."></td>";?>
												<div class="product-label">
													<span class="sale">-30%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"><?php echo $row['cat_name']?></p>
												<!--<h3 class="product-name"><a href="#">product name goes here</a></h3>-->
												<h4 class="product-price"><?php echo $row['price'] ?><del class="product-old-price">$990.00</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
									
												<form  action="index.php?action=add&id=<?php echo $row['id']?>"  method="POST">
												<input type="text" name="quantity" value="1" /><br>
												<input type="hidden" name="image" value=<?php echo $row['image'] ?> /><br>
												<input  type="hidden" placeholder="inter_name" name="name" value=<?php echo$row['name']?> /><br>
													   <input type="hidden" placeholder="price" name="price" value=<?php echo$row['price']?> /><br>
											   
											  
												
											</div>
											<div class="add-to-cart">
											<?php	if(isset($_SESSION['name'])){
												?>
												<i class="fa fa-shopping-cart"></i> <input  class="add-to-cart-btn" type="submit"    name="add" value="cart" />
											<?php
											}
											else{
												echo"<div style=color:red>";
												echo"if you want this proudact go to";
												echo"<a href='sign.php'>"."sign "."</a>";
												echo"</div>";
											}
											?>
												</form>
											</div>
										</div>
<?php
}
?>
		</div>		
		</div>	
		</div>	
		</div>	
		</div>	
		</div>
						</div>
					

								

		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

		<?php
		include("footer.php");
		?>