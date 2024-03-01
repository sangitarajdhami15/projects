<?php
                $p_name = $_POST['p_name'];
                $p_price = $_POST['p_price'];
                $p_quantity = $_POST['p_quantity'];
                $p_quality = $_POST['p_quality'];
                $p_status = $_POST['p_status'];
                $pid=$_POST['pid'];
                
                $conn=new mysqli("localhost","root","","agtrade");
                if($conn->connect_error!=0)
                 {
                 die("Connection Error");
                }
                
            
              $sql="UPDATE `product` SET `p_name`='$p_name',`p_price`='$p_price',`p_quantity`='$p_quantity',`p_quality`='$p_quality',`p_status`='$p_status' 
              WHERE pid='$pid'";
               

                $result =$conn->query($sql);
                if ($result) {
                    echo "Product Updated Successfully";
                } else {
                    die(mysqli_error($conn));
                } 
                
                
           
?>