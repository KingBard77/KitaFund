<?php  
//action.php  
session_start();  
include('../../connection.php'); 

if(isset($_POST["stock_id"]))  
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
                    if($_SESSION["shopping_cart"][$keys]['stock_id'] == $_POST["stock_id"])  
                    {  
                         $is_available++;  
                         $_SESSION["shopping_cart"][$keys]['stock_quantity'] = $_SESSION["shopping_cart"][$keys]['stock_quantity'] + $_POST["stock_quantity"];  
                    }  
               }  
               if($is_available < 1)  
               {  
                    $item_array = array(  
                         'stock_id'                =>     $_POST["stock_id"],  
                         'stock_name'              =>     $_POST["stock_name"],   
                         'stock_image'             =>     $_POST["stock_image"],   
                         'buying_price'            =>     $_POST["buying_price"],  
                         'stock_quantity'          =>     $_POST["stock_quantity"]  
                    );  
                    $_SESSION["shopping_cart"][] = $item_array;  
               }  
          }  
          else  
          {  
               $item_array = array(  
                    'stock_id'                =>     $_POST["stock_id"],  
                    'stock_name'              =>     $_POST["stock_name"], 
                    'stock_image'             =>     $_POST["stock_image"],   
                    'buying_price'            =>     $_POST["buying_price"],  
                    'stock_quantity'          =>     $_POST["stock_quantity"]  
               );  
               $_SESSION["shopping_cart"][] = $item_array;  
          }  
     }  
     if($_POST["action"] == "remove")  
     {  
          foreach($_SESSION["shopping_cart"] as $keys => $values)  
          {  
               if($values["stock_id"] == $_POST["stock_id"])  
               {  
                    unset($_SESSION["shopping_cart"][$keys]);  
                    $message = '   <div class="alert alert-success" role="alert">
                                        <p class="alert-heading"><h3>Stock Removed</h3></p>
                                        <p><b>Thank You</b> </p>
                                   </div>';  
               }  
          }  
     }  
     if($_POST["action"] == "quantity_change")  
     {  
          foreach($_SESSION["shopping_cart"] as $keys => $values)  
          {  
               if($_SESSION["shopping_cart"][$keys]['stock_id'] == $_POST["stock_id"])  
               {  
                    $_SESSION["shopping_cart"][$keys]['stock_quantity'] = $_POST["quantity"];  
               }  
          }  
     }  
     $order_table .= '  
          '.$message.'  
          <table class="table table-hover">  
               <tr>  
                    <th>Stock Name</th>
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
                              <img src="../Images/Stock/'.$values["stock_image"].'"
                                   alt="stock image" class="rounded-circle img-fluid"
                                   width="350px" id="Stock_Image'.$values["stock_image"].'""/>

                              '.$values["stock_name"].'
                         </td>  
                         <td>
                              <input type="number" name="quantity[]" id="quantity'.$values["stock_id"].'" 
                              value="'.$values["stock_quantity"].'" class="form-control quantity" data-stock_id="'.$values["stock_id"].'" />
                         </td>  
                         <td align="center">
                              RM '.$values["buying_price"].'
                         </td>  
                         <td align="center">
                              RM '.number_format($values["stock_quantity"] * $values["buying_price"], 2).'
                         </td>  
                         <td align="center">
                              <button name="delete" class="btn btn-inverse-danger btn-fw btn-sm delete" id="'.$values["stock_id"].'">Remove</button>
                         </td>  
                    </tr>  
               ';  
               $total = $total + ($values["stock_quantity"] * $values["buying_price"]);  
          }  
          $order_table .= 
               '<tr> 
                    <td colspan="2"></td>
                    <td align="center"><b>TOTAL</b></td>  
                    <td align="center"><b>RM '.number_format($total, 2).'</b></td>   
                    <td align="center">
                         <form method="post" action="cart.php">  
                              <input type="submit" name="place_order" class="btn btn-warning mr-2" 
                              value="Place Order" />  
                         </form>
                    </td>
               </tr>';  
     }  
     $order_table .= '</table>';  
     $output = array(  
          'order_table'       =>     $order_table,  
          'cart_item'         =>     count($_SESSION["shopping_cart"])  
     );  
     echo json_encode($output);  
}  
?>
