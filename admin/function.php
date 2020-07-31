<?php
$con=mysqli_connect("localhost","root","","shop");
/*function error($url=null,$scenod=3){

if($url==null){
    $url='member.php?do=mange';
}

echo "will be you return after ".$scenod;
header("refresh:$scenod url=$url");
}*/


function get_number($table,$row){
    global $con;
    $query="SELECT*FROM $table WHERE $row";
  
    $res=mysqli_query($con,$query);
   //$row=mysqli_fetch_assoc($res);
   
   $count=mysqli_num_rows($res);

  return $count;

}


function get_number_active($table,$row){
    global $con;
    $query="SELECT*FROM $table WHERE $row=0";
  
    $res=mysqli_query($con,$query);
   //$row=mysqli_fetch_assoc($res);
   
   $count=mysqli_num_rows($res);

  return $count;

}