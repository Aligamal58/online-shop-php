<?php

$con=mysqli_connect("localhost","root","","shop");

function get_post($name=null,$price,$image){
    global $con;
    $query="SELECT post.*,catagory.name 
    AS cat_name,users.name AS user FROM post
     INNER JOIN catagory ON catagory.id=post.cat_id 
     INNER JOIN users ON users.id=post.user_id 
     ";
  
    $res=mysqli_query($con,$query);
   while($row=mysqli_fetch_assoc($res)){
    return $row[$name];
    return $row[$price];
    return $row[$image];
  
   }
   
   

 

}