
<?php

session_start();
if((isset($_SESSION['name']))){




	include("headerprofile.php");
	//include("function.php");
?>
					<!-- //header-ends -->
						<!--outter-wp-->
							
								   
						<div class="outter-wp">
									<!--sub-heard-part-->
									  <div class="sub-heard-part">
									   <ol class="breadcrumb m-b-0">
											<li><a href="index.php">Home</a></li>
											
										</ol>
									   </div>


<?php
print_r($_SESSION['name']);?>

										
																
											 	<!--//profile-inner-->
												<!--//profile-->
									</div>
									<!--//outer-wp-->
									 <h3 class="sub-tittle pro">Profile</h3>
									      <div class="profile-widget">
												
													</div>
															
										
									 <!--footer section start-->
									<?php	
									 include("footerP.php");
}
else{
	header("location:login.php");
}