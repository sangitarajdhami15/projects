                <?php
                $conn=new mysqli("localhost","root","","agtrade");
                if($conn->connect_error)
                 {
                 die("Connection Error");
                }
                $p_name = $_POST['p_name'];
                $p_price = $_POST['p_price'];
                $p_quantity = $_POST['p_quantity'];
                $p_quality = $_POST['p_quality'];
                $p_status = $_POST['p_status'];
                
            
                $sql="INSERT INTO `product`(`p_name`, `p_price`, `p_quantity`, `p_quality`, `p_status`) 
                VALUES ('$p_name','$p_price','$p_quantity','$p_quality','$p_status')";
               
                $result =$conn->query($sql);
                if ($result) {
                    echo "Product Inserted Successfully";
                } else {
                    die(mysqli_error($conn));
                }         
?>