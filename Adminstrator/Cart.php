<!--========== PURCHASE CART DETAILS ==========-->

<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
// This function outputs theoretical HTML
// for adding ads to a Web page.

$page_title = 'Purchase Details';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';

$Profile_Id = $_SESSION['Profile_Id'] ;

?>
<!--========== PURCHASE CART DETAILS ==========-->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Stock Purchase Details</h4>
                        <p class="card-description">
                            <?php echo 'Order Summary <b>for Purchase No.'.$_SESSION["purchase_id"].'</b> '?>
                        </p>
                        <?php
                        if(isset($_POST["place_order"]))  
                         {  
                              $insert_order = "  
                              INSERT INTO purchase(Owner_Code, Purchase_Status)  
                              VALUES('$Profile_Id', 'pending')  
                              ";  
                              $purchase_id = "";  
                              if(mysqli_query($dbc, $insert_order))  
                              {  
                                   $purchase_id = mysqli_insert_id($dbc);  
                              }  
                              $_SESSION["purchase_id"] = $purchase_id;  
                              $order_details = "";  
                              foreach($_SESSION["shopping_cart"] as $keys => $values)  
                              {  
                                   $order_details .= "  
                                   INSERT INTO purchase_details(Purchase_Id, Description, Total_Expenses, Quantity)  
                                   VALUES('".$purchase_id."', '".$values["stock_name"]."', '".$values["buying_price"]."', '".$values["stock_quantity"]."');  
                                   ";  
                              }  
                              if(mysqli_multi_query($dbc, $order_details))  
                              {  
                                   unset($_SESSION["shopping_cart"]);  
                                   echo '<script>alert("You have successfully place an order...Thank you")</script>';  
                                   echo '<script>window.location.href="cart.php"</script>';  
                              }  
                         }  
                         if(isset($_SESSION["purchase_id"]))  
                         {  
                              $customer_details = '';  
                              $order_details = '';  
                              $total = 0;  
                              $query = '  
                              SELECT * FROM purchase  
                              INNER JOIN purchase_details  
                              ON purchase_details.purchase_id = purchase.purchase_id  
                              INNER JOIN profile  
                              ON profile.Profile_Id = purchase.Owner_Code  
                              iNNER JOIN owner
                              ON owner.Profile_Id = purchase.Owner_Code
                              WHERE purchase.purchase_id = "'.$_SESSION["purchase_id"].'"  
                              ';  
                              $result = mysqli_query($dbc, $query);  
                              while($row = mysqli_fetch_array($result))  
                              {  
                                   $customer_details = ' 
                                   <p><b>'.$row["Purchase_Date"].'</b></p>  
                                   <p><b>'.$row["Owner_Code"].'</b></p>  
                                   <label>'.$row["First_Name"].', '.$row["Last_Name"].'</label>  
                                   <p>'.$row["Address"].'</p>  
                                   <p>'.$row["City"].', '.$row["Postal_Code"].'</p>  
                                   <p>'.$row["Country"].'</p>  
                                   ';  
                                   $order_details .= "  
                                        <tr>  
                                             <td>".$row["Description"]."</td>  
                                             <td class='text-center'>".$row["Quantity"]."</td>  
                                             <td class='text-center'>RM ".$row["Total_Expenses"]."</td>  
                                             <td>RM ".number_format($row["Quantity"] * $row["Total_Expenses"], 2)."</td>  
                                        </tr>  
                                   ";  
                                   $total = $total + ($row["Quantity"] * $row["Total_Expenses"]);  
                              }  
                              echo '  
                              <div class="table-responsive" id="GFG">  
                                   <table class="table">  
                                        <tr>  
                                             <td><label>Owner Details</label></td>  
                                        </tr>  
                                        <tr>  
                                             <td>'.$customer_details.'</td>  
                                        </tr>  
                                        <tr>  
                                             <td><label>Stock Purchase Details</label></td>  
                                        </tr>  
                                        <tr>  
                                             <td>  
                                                  <table class="table table-bordered" id="GFG">  
                                                       <tr>  
                                                            <th width="50%">Stock Name</th>  
                                                            <th class="text-center" width="15%">Quantity</th>  
                                                            <th class="text-center" width="15%">Price (RM)</th>  
                                                            <th width="20%">SubTotal (RM)</th>  
                                                       </tr>  
                                                       '.$order_details.'  
                                                       <tr>  
                                                            <td colspan="3" align="right"><label><b>TOTAL EXPENSES</b></label></td>    
                                                            <td><b> RM '.number_format($total, 2).' </b></td>  
                                                       </tr>  
                                                  </table>  
                                             </td>  
                                        </tr>  
                                   </table> 
                                   <div class="text-right"> 
                                        <button class="btn btn-primary mr-2" onclick="printDiv()"><i
                                                  class="ti-printer me-1"></i> &nbsp;Print</a></button>
                                        <button onclick="goBack()" class="btn btn-light">Back</button>
                                   </div>
                              </div>  
                              ';  
                         }  
                         ?>
                    </div>
                </div>
            </div>
        </div>
        <script>
        function printDiv() {
            var divContents = document.getElementById("GFG").innerHTML;
            var a = window.open('', '', 'height=1920, width=1500');
            a.document.write('<html>');
            a.document.write('<body > <h1>Stock Inventories Receipt <br>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }

        function goBack() {
            window.history.back();
        }
        </script>
        <!--========== INCLUDE FOOTER ==========-->
        <?php include '../partials/Footer.html';?>