<?php
                $pid=$_POST['pid'];                
               $conn=new mysqli("localhost","root","","agtrade");
                if($conn->connect_error)
                 {
                 die("Connection Error");
                }               
                $sql="DELETE FROM product WHERE pid='$pid'";
                $result =$conn->query($sql);
                if ($result) {
                    echo ("Product Deleted Successfully");
                } else {
                    echo("Error");
                }         
?>