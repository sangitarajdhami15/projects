<?php
$conn=new mysqli("localhost","root","","agtrade");
if($conn->connect_error!=0)
 {
 die("Connection Error");
}
$pid=$_POST['pid'];
$sql="SELECT * FROM product WHERE pid='$pid'";

if($r=$conn->query($sql))
{
    $data=array();
    while($row=$r->fetch_assoc())
    {
        array_push($data,$row);
    }
}
    echo json_encode($data);
?>