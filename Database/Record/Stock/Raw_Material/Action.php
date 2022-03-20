<?php  
 //action.php  
 session_start();  
 $connect = mysqli_connect("localhost", "root", "", "burgerbyte");  
 if(isset($_POST["product_id"]))  
 {  
      $order_table = '';  
      $message = '';  
      if($_POST["action"] == "add")  
      {  
           if(isset($_SESSION["shopping_cart"]))  
           {  
                $is_available = 0;  
                foreach($_SESSION["shopping_cart"] as $keys => $values)  
                {  
                     if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])  
                     {  
                          $is_available++;  
                          $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];  
                     }  
                }  
                if($is_available < 1)  
                {  
                     $item_array = array(  
                          'product_id'               =>     $_POST["product_id"],  
                          'product_name'               =>     $_POST["product_name"],  
                          'product_image'               =>     $_POST["product_image"],  
                          'product_price'               =>     $_POST["product_price"],  
                          'product_quantity'          =>     $_POST["product_quantity"]  
                     );  
                     $_SESSION["shopping_cart"][] = $item_array;  
                }  
           }  
           else  
           {  
                $item_array = array(  
                     'product_id'               =>     $_POST["product_id"],  
                     'product_name'               =>     $_POST["product_name"],  
                     'product_image'               =>     $_POST["product_image"],  
                     'product_price'               =>     $_POST["product_price"],  
                     'product_quantity'          =>     $_POST["product_quantity"]  
                );  
                $_SESSION["shopping_cart"][] = $item_array;  
           }  
      }  
      if($_POST["action"] == "remove")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["product_id"] == $_POST["product_id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     $message = '  <div class="alert alert-success" role="alert">
                                        <p class="alert-heading"><h3>Product Removed</h3></p>
                                        <p><b>Thank You</b> </p>
                                   </div>';  
                }  
           }  
      }  
      if($_POST["action"] == "quantity_change")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])  
                {  
                     $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_POST["quantity"];  
                }  
           }  
      }  
      $order_table .= '  
           '.$message.'  
           <table class="table table-hover">  
                <tr>  
                    <th>Product Name</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">SubTotal</th>
                    <th class="text-center">Action</th>
                </tr>  
           ';  
      if(!empty($_SESSION["shopping_cart"]))  
      {  
           $total = 0;  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                $order_table .= '  
                     <tr> 
                         <td>
                              <img src="../Images/Raw Materials/'.$values["product_image"].'"
                              alt="product image" class="rounded-circle img-fluid"
                              width="350px" id="Product_Image'.$values["product_image"].'""/>
                              
                              '.$values["product_name"].'
                         </td>  
                         <td>
                              <input type="number" name="quantity[]" id="quantity'.$values["product_id"].'" 
                              value="'.$values["product_quantity"].'" class="form-control quantity" data-product_id="'.$values["product_id"].'" />
                         </td>  
                         <td align="center">
                              RM '.$values["product_price"].'
                         </td>  
                         <td align="center">
                              RM '.number_format($values["product_quantity"] * $values["product_price"], 2).'
                         </td>  
                         <td align="center">
                              <button name="delete" class="btn btn-inverse-danger btn-fw btn-sm delete" id="'.$values["product_id"].'">Remove</button>
                         </td>  
                     </tr>  
                ';  
                $total = $total + ($values["product_quantity"] * $values["product_price"]);  
           }  
           $order_table .= '  
                <tr> 
                     <td colspan="2"></td>
                     <td align="center"><b>TOTAL</b></td>  
                     <td align="center"><b>RM '.number_format($total, 2).'</b></td>   
                     <td align="center">
                         <form method="post" action="cart.php">  
                              <input type="submit" name="place_order" class="btn btn-warning mr-2" 
                              value="Place Order" />  
                         </form>
                    </td>  
           ';  
      }  
      $order_table .= '</table>';  
      $output = array(  
           'order_table'     =>     $order_table,  
           'cart_item'          =>     count($_SESSION["shopping_cart"])  
      );  
      echo json_encode($output);  
 }  
 ?>
