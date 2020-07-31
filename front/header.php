
<?php

session_start();


if(isset($_POST['add'])){
    if(isset($_SESSION['cart'])){
        $id_array=array_column($_SESSION['cart'],'item_id');
        if(!in_array($_GET['id'],$id_array)){
           $count=count($_SESSION['cart']);
            $item_array=array(
               'item_id'=>$_GET['id'],
                'item_name'=>$_POST['name'],
                'item_price' =>$_POST['price'],
				'item_quantity' =>$_POST['quantity'],
				'item_image' =>$_POST['image']
            );
            $_SESSION['cart'][$count]=$item_array;
        }
        else{
			?>
			<div class="alert alert-danger" role="alert">
				<?php
		echo"item is added alrady ";
			?>
		  </div>
		  <?php

        }
    }
    else{
        $item_array=array(
            'item_id'=>$_GET['id'],
            'item_name'=>$_POST['name'],
            'item_price' =>$_POST['price'],
			'item_quantity' =>$_POST['quantity'],
			'item_image' =>$_POST['image']
        );
        $_SESSION['cart'][0]=$item_array;

    }
}	

if(isset($_GET['action'])){
    if($_GET['action']=='delet'){
        foreach( $_SESSION['cart'] as $key=>$value){
            if($value['item_id']==$_GET['id']){
                unset( $_SESSION['cart'][$key]);
            }
        }
    }
}



$total=0;
if(isset($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $key=>$value)
    {
$total=$total+$value['item_quantity'];
	

	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro - HTML Ecommerce Template</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="logout.php"><i class="lnr lnr-power-switch"></i> log out</a></li>
						<li><a href="profile.php"><i class="fa fa-user-o"></i> My Account</a></li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->
						<?php
                        $con=mysqli_connect("localhost","root","","shop");
                         $query="SELECT*FROM catagory";
                         $res=mysqli_query($con,$query);
                         
                        
                            ?>
					
				

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a  class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										
										
										<div class="qty"><?php echo$total;?></div>
										<span ><a href="cart.php"> Your Cart</a></span>
										
									</a>
						

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
                        <li class="active"><a href="index.php">Home</a></li>
                        <?php
                        $con=mysqli_connect("localhost","root","","shop");
                         $query="SELECT*FROM catagory";
                         $res=mysqli_query($con,$query);
                         
                         while($row=mysqli_fetch_assoc($res)){
                            ?>
						<li><a href="store.php?do=<?php echo$row['id']?>"><?php echo $row['name']?></a></li>
                        <?php
                         }
                        ?>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

	