<?php   
 session_start();  
 $connect = mysqli_connect('localhost','tentangk_edel','siewlede12345','tentangk_edel');  
 if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = [
                     'item_id'=>$_GET["id"],  
                     'item_name'=>$_POST["hidden_name"],  
                     'item_price'=>$_POST["hidden_price"],  
                     'item_quantity'=>$_POST["quantity"]  
                ];  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="shop.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = [ 
                'item_id'=>$_GET["id"],  
                'item_name'=>$_POST["hidden_name"],  
                'item_price'=>$_POST["hidden_price"],  
                'item_quantity'=>$_POST["quantity"]  
          ];  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="shop.php"</script>';  
                }  
           }  
      }  
 }  
 if (isset($_POST["kirim"])){
     $namaa = $_POST["namaa"];
     $emaill = $_POST["emaill"];
     $pesan = $_POST["pesan"];
 
     $query = "INSERT INTO pesan VALUES 
     ('', '$namaa', '$emaill', '$pesan') ";
 
     mysqli_query($connect, $query);
 }



 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Shopping Cart</title>  
           <script src="js/jquery.min.js"></script>  
           <link rel="stylesheet" href="css/bootstrap.min.css">
           <script src="https://kit.fontawesome.com/a81368914c.js"></script>
           <script src="js/script.js"></script>
           <script src="js/bootstrap.min.js"></script>
           <link rel="stylesheet" href="css/style4.css"> 
      </head>  
      <body> 
      <!--navigasi bar-->
          <nav class="navbar navbar-inverse navbar-fixed-top">
               <div class="container-fluid">
                    <div class="navbar-header">
                         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
                         data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                         </button>
                         <a href="#home" class="navbar-brand page-scroll">Peternakan  Ayam</a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                         <ul class="nav navbar-nav navbar-right">
                              <li><a href="#shop" class="page-scroll"><i class="fas fa-shopping-cart"></i></a></li>
                              <li><a href="#contact" class="page-scroll">Contact</a></li>
                              <li name="logout"><button type="button" class="btn btn-default navbar-btn"><a href="logout.php">Logout</a></button></li>
                              
                         </ul>
                    </div>
               </div>
          </nav>
     <!--end of navbar--> 
           <br/>  
           <div id = "shop" class="container" style="width:600px;">  
                <h3 align="center">Shopping Cart</h3>
                <hr>
                <br />  
                <?php  
                $query = "SELECT * FROM tbl_product ORDER BY id ASC";  
                $result = mysqli_query($connect, $query);  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>  
                <div class="col-sm-4">  
                     <form method="post" action="shop.php?action=add&id=<?php echo $row["id"]; ?>">  
                          <div style="border:1px solid #333; background-color:#e6ccff; border-radius:5px; padding:16px;" align="center">  
                               <img src="img/<?php echo $row["image"]; ?>" class="img-responsive" /><br />  
                               <h4 class="text-info"><?php echo $row["name"]; ?></h4>  
                               <h4 class="text-danger">Rp <?php echo $row["price"]; ?></h4>  
                               <input type="text" name="quantity" class="form-control" value="1" />  
                               <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  
                          </div>  
                     </form>  
                </div>  
                <?php  
                     }  
                }  
                ?>  
                <div style="clear:both"></div>  
                <br />  
                <h3>Order Details</h3>  
                <div class="table-responsive" style="height:800px;" id="order">
                <img src="img/cart1.svg">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="40%">Item Name</th>  
                               <th width="10%">Quantity</th>  
                               <th width="20%">Price</th>  
                               <th width="15%">Total</th>  
                               <th width="5%">Action</th>  
                          </tr>  
                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values["item_name"]; ?></td>  
                               <td><?php echo $values["item_quantity"]; ?></td>  
                               <td>Rp <?php echo $values["item_price"]; ?></td>  
                               <td>Rp <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                               <td><a href="shop.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3" align="right">Total</td>  
                               <td align="right">Rp <?php echo number_format($total, 2); ?></td>
                               <td><li name="bayar"><button type="submit" class="btn btn-success"><a href="logout.php" onclick = "return alert ('Terima kasih! Lakukan konfirmasi pembayaran');">Bayar!</a></button></li></td>
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>
           </div>

           
                <div id= "contact" class="contact" style="position:relative;">
                    <div class="row">
                         <div class="col-sm-12">
                              <h2 class="text-center">Contact</h2>
                              <hr>
                         </div>
                    </div>

                    <div class="row">
                         <div class="col-sm-4">
                              <img src="img/chick.svg" style="width:200px; height:200px;">
                         </div>
                         <div class="col-sm-4">
                              <img src="img/fb.png">
                              <p>Sisfo Peternakan Ayam</p>
                              <img src="img/insta.png">
                              <p>@sisfoternakayam</p>
                              <img src="img/twit.png">
                              <p>@sisfoternakayam</p>
                         </div>
                         <div class="col-sm-4">
                         <h3> Info lebih lanjut</h3>
                         <form action="" method="post">
                              <div class="form-group">
                                   <label for="namaa">Nama :</label>
                                   <input type="text" class="form-control" id="namaa" name="namaa" placeholder="Nama">
                              </div>
                              <div class="form-group">
                                   <label for="emaill">Email :</label>
                                   <input type="text" class="form-control" id="emaill" name="emaill" placeholder="Email">
                              </div>
                              <div class="form-group">
                                   <label for="textarea1">Pesan :</label>
                                   <textarea class="form-control" id="textarea1" name="pesan" rows="3" placeholder="Masukkan pesan"></textarea>
                              </div>
                              <button type="submit" class="btn btn-primary" name="kirim">Kirim</button>
                         
                         </form>
                         </div>
                    </div>
               </div>
               <!--end of contact-->

               <!--footer-->
               <footer>
                    <div class="container text-center">
                         <div class="row">
                              <div class="col-sm-12">
                                   <p>&copy; copyright 2020 | Sisfo Ternak Ayam by <a href="http://instagram.com/delweiss99">Edelweis</a></p>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-sm-12">
                                   <p><i class="fas fa-phone-square-alt"></i> +62 888-0689-7055</p>
                              </div>
                         </div>
                    </div>
               </footer>
               <!--end of footer-->  
           <br/>  
      </body>  
 </html>