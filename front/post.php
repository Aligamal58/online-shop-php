<?php
session_start();
if((isset($_SESSION['name']))){



include("headerprofile.php");
include "../admin/function.php";
$con=mysqli_connect("localhost","root","","shop");
$do='';
if(isset($_GET['do'])){
    $do=$_GET['do'];
}
else{
    $do='manage';
}
if($do=='manage'){
    $name=$_SESSION['name'];
  
$query="SELECT*FROM users WHERE(name='$name')";

$res=mysqli_query($con,$query);
$get=mysqli_fetch_assoc($res);
$id=$get['id'];





    
    $query="SELECT post.*,catagory.name 
    AS cat_name FROM post
     INNER JOIN catagory ON catagory.id=post.cat_id 
    WHERE (post.user_id=$id)
     ";
     
        $res=mysqli_query($con,$query);
     
      
        ?>
    
    <div class="graph-visual tables-main">


    <div class="graph">
    <h2 class="inner-tittle">Show Post</h2>
            <div class="tables">
                    
                    <table class="table">
                        <thead>
                            <tr>
                              <th>  id</th>
                              <th> Name</th>
                              <th>descrabtion</th>
                              <th>price</th>
                              <th>image</th>
                              <th>catagory</th>
                             
                              <th>controller</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
   
       
    
    while($row=mysqli_fetch_assoc($res)){
    echo "<tr>";
    echo"<td>".$row['id']."</td>";
    echo"<td>".$row['name']."</td>";
    echo"<td>".$row['descrabtion']."</td>";
    echo"<td>".$row['price']."</td>";
    echo"<td><img src=../upload/avatar/".$row['image']."></td>";
    echo"<td>".$row['cat_name']."</td>";
    
    
    echo"<td><a href='?do=edit&id=" . $row['id']."'>Edit</a>
    <a href='?do=delet&id=" . $row['id']."'>DELET</a> ";
    
    echo"</tr>";
    }
    ?>
    
    </tbody>




			
    </tbody>
</table>
</div>

</div>
    
    
<?php        
        
    
     

}
elseif($do=='add'){
    $name=$_SESSION['name'];
    $query="SELECT*FROM users WHERE(name='$name')";

$res=mysqli_query($con,$query);
$get=mysqli_fetch_assoc($res);
$id=$get['id'];
$role=$get['active'];
if($role==1){
    ?>
     <div class="graph-visual tables-main">
     <div class="graph">
    <div class="forms-main">
					
                    <div class="graph-form">
                  
<div class="form-body">
<h2 class="inner-tittle">Add post </h2>
    <form action="?do=insert"  method="POST" enctype="multipart/form-data"> <div class="form-group">

   
    <input type="hidden" class="form-control" id="exampleInputEmail1" name="id" value=<?php echo$id?> > 
    <label for="exampleInputEmail1">Name</label> 
    <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="name"> </div>

    <label for="exampleInputEmail1">price</label> 
    <input type="number" class="form-control" id="exampleInputEmail1" name="price" placeholder="price"> </div>

    <label for="exampleInputEmail1">image</label> 
    <input type="file" class="form-control" id="exampleInputEmail1" name="image" placeholder="image"> 

    <label for="exampleInputEmail1">descrabtion</label> 
    <input type="text" class="form-control" id="exampleInputEmail1" name="descrabtion" placeholder="descrabtion"> 


<div class="form-group">
			<label class="col-sm-2 control-label">catagory</label>
		<!--<div class="col-sm-8">-->
	<select name="catagory" class="form-control1">
   

	<option value="0">....</option>
    <?php
$query="SELECT*FROM catagory";
$res=mysqli_query($con,$query);


while($cat=mysqli_fetch_assoc($res)){
echo " <option value='".$cat['id']."'>".$cat['name']."</option>";

}?>
    
        </select>
    	




    	</div>
        </div>
</div>
      
         <input  class="btn" type="submit" value="check" name="send" />
         </form> 
    </div>

</div>
       
<?php }
else{
    ?>
    <div class="alert alert-danger" role="alert">
        <?php
echo "please wait even admin accept request  can you add post ";
    ?>
  </div>
  <?php

}
}
elseif($do=='insert'){
   
    if($_SERVER['REQUEST_METHOD']=='POST'){
        echo"<h1 class='text-center'>insert</h1>";
        $image_name=$_FILES['image']['name'];
        $image_size=$_FILES['image']['size'];
        $image_tmp=$_FILES['image']['tmp_name'];
        $image_type=$_FILES['image']['type'];
$image_allow_extnation=array("jpg","png","jpeg");
$image_extnation=end(explode(".",$image_name));


        $name=$_POST['name'];
        $des=$_POST['descrabtion'];
        $price=$_POST['price'];
        $cat=$_POST['catagory'];
        $user=$_POST['id'];
        

       
        $formeror=array();
        if(!empty($image_name)&& !in_array($image_extnation,$image_allow_extnation)){
            $formeror[]='please inter onter image';
        }
        if(empty($name)){
    $fohmeror[]='please inter name';
        }
        
        if(empty($des)){
            $formeror[]='please inter descrabtion';
        }
        if(empty($price)){
            $formeror[]='please intre price';
        }
        
        if(empty($cat)){
            $formeror[]='please intre class';}

       
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
            $image=rand(0,10000000).'_'.$image_name;
            move_uploaded_file($image_tmp,"../upload\avatar\\".$image);
            $query="INSERT INTO post(name,descrabtion,price,image,cat_id,user_id)VALUE('$name','$des','$price','$image','$cat','$user')";
            $res=mysqli_query($con,$query);}
        
        if(isset($res)){
            ?>
            <div class="alert alert-danger" role="alert">
                <?php
        echo "Done insert";
            ?>
          </div>
          <?php
           
        
        }
        
    }
}


//////edit//////////////////
elseif($do=='edit'){
    
    $id= isset($_GET['id']) && is_numeric($_GET['id'])? intval($_GET['id']):0;
    $query="SELECT*FROM post WHERE(id='$id')";
    $res=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($res);
    $count=mysqli_num_rows($res);
    if($count>0){
    ?>


<div class="graph-visual tables-main">
     <div class="graph">
    <div class="forms-main">
					
                    <div class="graph-form">
<div class="form-body">
<h2 class="inner-tittle">update post </h2>
    <form action="?do=update"  method="POST" enctype="multipart/form-data"> <div class="form-group">

    <input type="hidden" class="form-control" id="exampleInputEmail1" name="id" value=<?php echo$row['id']?> placeholder="name"> </div>


    <label for="exampleInputEmail1">Name</label> 
    <input type="text" class="form-control" id="exampleInputEmail1" name="name" value=<?php echo$row['name']?> placeholder="name"> </div>

    <label for="exampleInputEmail1">price</label> 
    <input type="number" class="form-control" id="exampleInputEmail1" name="price"  value=<?php echo$row['price']?> placeholder="price"> 

    <label for="exampleInputEmail1">descrabtion</label> 
    <input type="text" class="form-control" id="exampleInputEmail1" name="descrabtion" value=<?php echo$row['descrabtion']?> placeholder="descrabtion"> 

    <label for="exampleInputEmail1">image</label> 
    <input type="file" class="form-control" id="exampleInputEmail1" name="image" placeholder="image"> 


<div class="form-group">
			<label class="col-sm-2 control-label">catagory</label>
		<!--<div class="col-sm-8">-->
	<select name="catagory" class="form-control1">
   

	<option value="0">....</option>
    <?php
$query="SELECT*FROM catagory";
$res=mysqli_query($con,$query);


while($cat=mysqli_fetch_assoc($res)){
    
    echo"<option value='" .$cat['id']."'";if($row['cat_id']==$cat['id']){echo'selected';}echo">".$cat['name']."</option>";


}?>
    
        </select>
    	




    	</div>
        </div>
</div>
      
         <input  class="btn" type="submit" value="check" name="send" />
         </form> 
    </div>

</div>

<?php
}
}






    

        elseif($do=='update'){
    echo"<h1 class='text-centeh'>update post</h1>";
    if($_SERVER['REQUEST_METHOD']=='POST'){

        $image_name=$_FILES['image']['name'];
        $image_size=$_FILES['image']['size'];
        $image_tmp=$_FILES['image']['tmp_name'];
        $image_type=$_FILES['image']['type'];
$image_allow_extnation=array("jpg","png","jpeg");
$image_extnation=end(explode(".",$image_name));






        $id=$_POST['id'];
        $name=$_POST['name'];
        $des=$_POST['descrabtion'];
        $price=$_POST['price'];
        $cat=$_POST['catagory'];
      
        $formeror=array();
        if(!empty($image_name)&& !in_array($image_extnation,$image_allow_extnation)){
            $formeror[]='please inter onter image';
        }
        if(empty($name)){
    $fohmeror[]='please inter name';
        }
        
        if(empty($des)){
            $formeror[]='please inter descrabtion';
        }
        if(empty($price)){
            $formeror[]='please intre price';
        }
        
        if(empty($cat)){
            $formeror[]='please intre class';
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
            $image=rand(0,10000000).'_'.$image_name;
            move_uploaded_file($image_tmp,"../upload\avatar\\".$image);
            $query="UPDATE post SET name='$name',descrabtion='$des',price='$price',image='$image',cat_id='$cat'
            WHERE id='$id'";
        $res=mysqli_query($con,$query);
        if(isset($res)){
            ?>
            <div class="alert alert-danger" role="alert">
                <?php
        echo "yes update";
            ?>
          </div>
          <?php
        }
    }
}
}
elseif($do=='delet'){
    $postid= isset($_GET['id']) && is_numeric($_GET['id'])? intval($_GET['id']):0;
    $query="SELECT*FROM post WHERE(id='$postid')";
    $res=mysqli_query($con,$query);
   
    $count=mysqli_num_rows($res);
if($count>0){
    $query="DELETE FROM post WHERE(id='$postid')";
    $res=mysqli_query($con,$query);
}

if(isset($res)){
    ?>
    <div class="alert alert-danger" role="alert">
        <?php
echo "yes Delete";
    ?>
  </div>
  <?php
}


else{  
    ?>
    <div class="alert alert-danger" role="alert">
        <?php
echo "No Delete";
    ?>
  </div>
  <?php
}
}



include("footerP.php");
}
else{
    header("location:login.php");
}
?>
