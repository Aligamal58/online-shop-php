<?php

session_start();
if((isset($_SESSION['email']))){
include("header.php");
include("function.php");
$con=mysqli_connect("localhost","root","","shop");
$do='';
if(isset($_GET['do'])){
    $do=$_GET['do'];
}
else{
    $do='manage';
}
if($do=='manage'){
    
  

      
   
$query="SELECT*FROM users";
    //$query="SELECT*FROM user ";
    $res=mysqli_query($con,$query);
   
    
    ?>


                                          <div class="graph-visual tables-main">

											<h2 class="inner-tittle">Show Member</h2>
												<div class="graph">
														<div class="tables">
																
																<table class="table">
																	<thead>
																		<tr>
																		  <th>  id</th>
																		  <th> Name</th>
																		  <th>email</th>
                                                                          <th>date</th>
                                                                          <th>controller</th>
																		</tr>
																	</thead>
																	<tbody>
                                                                    <?php

while($row=mysqli_fetch_assoc($res)){
    //echo"<img src='upload/avatar/foot.jpg'>";
    //$img=$row['image'];
    //echo$img;
   // echo"<img src=upload/avatar/".$row['image'].">";
echo "<tr>";
echo"<td>".$row['id']."</td>";
echo"<td>".$row['name']."</td>";
echo"<td>".$row['email']."</td>";
echo"<td>".$row['date']."</td>";

echo"<td><a href='?do=edit&id=" . $row['id']."'>Edit </a>
<a href='?do=delet&id=" . $row['id']."'> DELET</a> ";
if($row['active']==0){
echo"<a href='?do=active&id=" . $row['id']."'>active</a>";}
echo"</tr>";
}
															
?>
</tbody>




			
                                                                    </tbody>
																</table>
															</div>
												
										        </div>
    
    

<?php }
elseif($do=='edit'){
    
    $userid= isset($_GET['id']) && is_numeric($_GET['id'])? intval($_GET['id']):0;
    $query="SELECT*FROM users WHERE(id='$userid')";
    $res=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($res);
    $count=mysqli_num_rows($res);
    if($count>0){
    ?>
   

	<div class="forms-main">
						<h2 class="inner-tittle">Edit Member </h2>
						<div class="graph-form">
	<div class="form-body">
        <form action="?do=update"  method="POST"> <div class="form-group">

        <input type="hidden" class="form-control" name="id" id="exampleInputEmail1" value="<?php echo$row['id']?>"> </div>

        <label for="exampleInputEmail1">Name</label> 
        <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="name"value="<?php echo$row['name']?>"> </div>

             <label for="exampleInputEmail1">Email address</label> 
        <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email"value="<?php echo$row['email']?>">  

       
             <label for="exampleInputEmail1">Password</label>
 <input type="password" class="form-control" id="exampleInputEmail1" name="password" placeholder="Password"value="<?php echo$row['password']?>"> </div> 

    
          
             <input  class="btn" type="submit" value="check" name="send" />
             </form> 
		</div>

</div>

<?php }

else{echo"no exists id";}
}
elseif($do=='update'){
    echo"<h1 class='text-centeh'>updit</h1>";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $userid=$_POST['id'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $pass=$_POST['password'];
        $formeror=array();
        if(empty($name)){
    $formeror[]='please inter the name';
        }
        if(strlen($name)<4){
    
            $formeror[]='please atleast name 5';
        }
        if(empty($email)){
            $formeror[]='please inter  email';
        }

        if(empty($pass)){
            $formeror[]='please inter the password';
        }
        foreach($formeror as $error){
            ?>
            <div class="alert alert-danger" role="alert">
                <?php
        echo $error;
            ?>
          </div>
          <?php
        }
        if(empty($formeror)){
            //$check= item("user",$name);
           // if($check==1){echo"please inter other any name";}
            //else{
        $query="UPDATE users SET name='$name',email='$email',password='$pass' WHERE id='$userid'";
        $res=mysqli_query($con,$query);
        
        if(isset($res)){
?>
             <div class="alert alert-danger" role="alert">
                <?php
            echo'yes update';
  ?>
</div>
<?php
           }
        
    }
}


?>

<button type="button" class="btn btn-danger"><a href="member.php">Back</a></button>
<?php
}
elseif($do=='delet'){
    $userid= isset($_GET['id']) && is_numeric($_GET['id'])? intval($_GET['id']):0;
    $query="SELECT*FROM users WHERE(id='$userid')";
    $res=mysqli_query($con,$query);
   
    $count=mysqli_num_rows($res);
if($count>0){
    $query="DELETE FROM users WHERE(id='$userid')";
    $res=mysqli_query($con,$query);
}
if(isset($res)){
    ?>
    <div class="alert alert-danger" role="alert">
       <?php
   echo'  Done Delete';
?>
</div>
<?php
}

else{echo"no";}
}
elseif($do=='active'){
    $userid= isset($_GET['id']) && is_numeric($_GET['id'])? intval($_GET['id']):0;
    $query="SELECT*FROM users WHERE(id='$userid')";
    $res=mysqli_query($con,$query);
   
    $count=mysqli_num_rows($res);
if($count>0){
    $query="UPDATE users SET active=1  WHERE(id='$userid') ";
    $res=mysqli_query($con,$query);}
    if(isset($res)){
        ?>
                     <div class="alert alert-danger" role="alert">
                        <?php
                    echo'yes update';
          ?>
        </div>
        <?php
    }
    else{
        
            ?>
                         <div class="alert alert-danger" role="alert">
                            <?php
                        echo'No update';
              ?>
            </div>
            <?php
        
    }
}




include("footer.php");
}
else{
	header("location:login.php");
}

?>