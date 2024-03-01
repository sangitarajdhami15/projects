<html>
<head>
    
    <title>Enter Product</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <h1>Product Details</h1>
        </div>
        <div class="row d-flex justify-content-end"> 
            <div class="col-3 d-flex justify-content-end">
                <button id="newProduct" class="btn btn-success">New</button>
            </div>   
        </div>

        <!--table start-->
        <div class="row">  
            <table class="table">
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Quality</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                
                $conn=new mysqli("localhost","root","","agtrade");
                if($conn->connect_error)
                {
                    die("Connection Error");
                }
                $sql="SELECT * from product";
                $result=$conn->query($sql);
                $i=1;
                
                foreach($result as $row)
                {
                    echo"<tr>";
                    echo("<td>".$i++."</td><td>".$row['p_name']."</td><td>".$row['p_quantity']."</td>");
                    echo("<td>".$row['p_price']."</td><td>".$row['p_quality']."</td><td>".$row['p_status']."</td>");
                    echo "
                    <td>
                
                    <button id='".$row['pid']."'class='btnUpdate btn btn-info'>Update</button>                      
                    <button id='".$row['pid']."'class='btnDelete btn btn-danger'>Delete</button></td>
                    </tr>
                    ";
                }
                ?>    
            </table>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Scripting Code for Inserting Book Starts  -->
    <script>
        $(document).ready(function(){

            $('.btnDelete').click(function(){
                var pid=this.id;
                $('#hidden_id').val(pid);
                $("#deletemdl").modal("show");
            });

            $('#productDelete').click(function(e){
                e.preventDefault();
                
                var pid=$('#hidden_id').val();
                alert(pid);      
                $.ajax({
                    url: "phpFiles/deleteProduct.php", 
                    type:'POST',
                    data:{pid:pid},
                    success: function(result){
                        alert(result);
                        
                        location.reload();
                    }
                    });
                    

            });
            


            $('#newProduct').click(function(){
               $("#testmdl").modal("show");
            });
            $('#productInsert').click(function(e){
                e.preventDefault();
                var p_name=$('#p_name').val();
                var p_quantity=$('#p_quantity').val();
                var p_price=$('#p_price').val();
                var p_quality=$('#p_quality').val();
                var p_status=$('#p_status').val();
               
                
                $.ajax({
                    url: "phpFiles/insertProduct.php", 
                    type:'POST',
                    data:{p_name:p_name,p_price:p_price,p_quantity:p_quantity,p_status:p_status,p_quality:p_quality},
                    success: function(result){
                        alert(result);
                        location.reload();
                    }
                    });
                    

            });
            /*Product Insertion Finished*/


            /*Product Update Started*/
            $('.btnUpdate').click(function(){
                var pid=this.id;
                $.ajax({
                    url: "phpFiles/edit.php", 
                    type:'POST',
                    data:{pid:pid},
                    success: function(result){
                       var jData=JSON.parse(result);
                       $('#up_name').val(jData[0].p_name);
                       $('#up_quantity').val(jData[0].p_quantity);
                       $('#up_price').val(jData[0].p_price);
                       $('#up_quality').val(jData[0].p_quality);
                       $('#up_status').val(jData[0].p_status);
                       $('#hidden_id').val(pid);
                       $("#updatemdl").modal("show");
                    }
                    });
                
                
            });

            $('#productUpdate').click(function(e){
                e.preventDefault();
                var p_name=$('#up_name').val();
                var p_quantity=$('#up_quantity').val();
                var p_price=$('#up_price').val();
                var p_quality=$('#up_quality').val();
                var p_status=$('#up_status').val();
                var pid=$('#hidden_id').val();
               
                
                $.ajax({
                    url: "phpFiles/updateProduct.php", 
                    type:'POST',
                    data:{pid:pid,p_name:p_name,p_price:p_price,p_quantity:p_quantity,p_status:p_status,p_quality:p_quality},
                    success: function(result){
                        alert(result);
                        location.reload();
                    }
                    });
                    

            });

           

        });
        
    </script> 
    <!-- Scripting Code for Inserting Book Details Ends  -->
    
</body>
</html>

    <!-- Modal for inserting book Begins-->
    <div class="modal fade" tabindex="-1" id="testmdl">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Insert New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <form action="entry.php" method="post">
                <div class="form-group">
                        <label>
                            Product Name
                        </label>
                        <input type="text" class="form-control" placeholder="Enter  Product Name" id="p_name" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" placeholder="Enter Quantity" id="p_quantity" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control" placeholder="Enter Price" id="p_price"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Quality</label>
                        <input type="text" class="form-control" placeholder="Enter Quality" id="p_quality"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="type" id="p_status">
                            <option value="available">Available</option>
                            <option value="finished">Finished</option>
                        </select>
                    </div>
                    <button type="submit"id="productInsert" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
            </div>
        </div>
    </div>
    <!-- Modal for Inserting Book Ends-->


    <!-- Modal for Udating Book Starts-->
    <div class="modal fade" tabindex="-1" id="updatemdl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">        
                    <form action="updateproduct.php" method="post">
                    <div class="form-group">
                        <label>
                            Product Name
                        </label>
                        <input type="text" class="form-control" placeholder="Enter  Product Name" id="up_name" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" placeholder="Enter Quantity" id="up_quantity" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control" placeholder="Enter Price" id="up_price"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Quality</label>
                        <input type="text" class="form-control" placeholder="Enter Quality" id="up_quality"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="type" id="up_status">
                            <option value="available">Available</option>
                            <option value="finished">Finished</option>
                        </select>
                    </div>
                    <input type="hidden" name="hidden_id" id="hidden_id">
                        <button type="submit" class="btn btn-primary" id="productUpdate">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Udating Book Ends-->

    <!-- Modal for Deleting Book Starts-->
    <div class="modal fade" tabindex="-1" id="deletemdl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <img src="cross.jpg" width="auto" height="100 px" >
                    </div>
                    <h4 class="modal-title w-100">Are you sure?</h4>
                
                </div>

                    <div class="modal-body ">
                    <form  method="post">  
                    <p>Do you really want to delete these records? This process cannot be undone.</p>      
                   
                    
                    <input type="hidden" name="hidden_id" id="hidden_id">
                    <button type="submit" class="btn btn-secondary" id="cancel">Cancel</button>
                    <button type="submit" class="btn btn-danger" id="productDelete">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>    

