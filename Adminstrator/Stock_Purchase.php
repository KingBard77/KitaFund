<!--========== STOCK INVENTORIES ORDERING ==========-->
<?php
// This function outputs theoretical HTML
// for adding ads to a Web page.

$page_title = 'Stock Purchase';
include '../partials/Navbar - Owner.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Owner.php';


// Define the query:
$query = "SELECT * FROM stock ORDER BY Stock_Id ASC";
$stock = mysqli_query($dbc, $query);

// Count the number of returned rows:
$stock_num = mysqli_num_rows($stock);

if ($stock_num > 0) { // If it ran OK, display the records.
}
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <!--========== ORDERING STOCK INVENTORY ==========-->
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="container text-center pt-5">
                            <h4 class="mb-3 mt-5">Stock Inventories Order (<span><?php echo "$stock_num" ?></span>
                                stocks)</h4>
                            <p class="w-75 mx-auto mb-5">Add to Cart - Make a <b>Stock Inventories Ordering</b> before
                                end the business
                                operation.
                                <!--========== BUTTON CART STOCK ==========-->
                                <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                    data-target="#cartModal">
                                    <i class="ti-shopping-cart btn-icon-append"></i>
                                    &nbsp;View Cart
                                    <a data-toggle="tab">
                                        <span class="badge">
                                            <?php if(isset($_SESSION["shopping_cart"])) { 
                                    echo count($_SESSION["shopping_cart"]); 
                                    } else { 
                                        echo '0';
                                    }?>
                                        </span>
                                    </a>
                                </button>
                            </p>
                            <table class="table table-hover">
                                <tr>
                                    <th class="text-left">Stock Name</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                <?php  
                                    $query = "SELECT * FROM stock ORDER BY Stock_Id ASC";  
                                    $result = mysqli_query($dbc, $query);  
                                    if(mysqli_num_rows($result) > 0)  
                                    {  
                                        while($row = mysqli_fetch_array($result))  
                                        {  
                                    ?>
                                <tr>
                                    <td align="left">
                                        <!--========== HIDDEN STOCK IMAGE ==========-->
                                        <input type="hidden" name="hidden_image"
                                            id="Stock_Image<?php echo $row["Stock_Id"]; ?>"
                                            value="<?php echo $row["Stock_Image"]; ?>" />

                                        <!--========== STOCK NAME ==========-->
                                        <h5><?php echo $row["Stock_Name"]; ?></h5>

                                        <!--========== HIDDEN STOCK NAME ==========-->
                                        <input type="hidden" name="hidden_name"
                                            id="Stock_Name<?php echo $row["Stock_Id"]; ?>"
                                            value="<?php echo $row["Stock_Name"]; ?>" /></p>
                                    </td>

                                    <td align="center">
                                        <!--========== QUANTITY ==========-->
                                        <div>
                                            <div class="def-number-input number-input safari_only mb-0 w-100">
                                                <input type="number" name="quantity" min="1" max="5" step="1" value="1"
                                                    id="quantity<?php echo $row["Stock_Id"]; ?>"
                                                    class="form-control form-control-sm" value="1" />
                                            </div>
                                            <small id="passwordHelpBlock" class="form-text text-muted text-center">
                                                (Note, 1 piece)
                                            </small>
                                        </div>
                                    </td>
                                    <td align="center">
                                        <div>
                                            <!--========== STOCK PRICE ==========-->
                                            <p class="mb-0"><span><strong>RM
                                                        <?php echo $row["Buying_Price"]; ?> / 1 pieces</strong></span>
                                            </p>

                                            <!--========== STOCK DESCRIPTION ==========-->
                                            <small id="passwordHelpBlock" class="form-text text-muted text-center">(
                                                        <?php echo $row["Description"] ; ?> pieces / 1 bag )
                                            </small >

                                            <!--========== HIDDEN STOCK PRICE ==========-->
                                            <input type="hidden" name="hidden_price"
                                                id="Buying_Price<?php echo $row["Stock_Id"]; ?>"
                                                value="<?php echo $row["Buying_Price"]; ?>" />
                                        </div>
                                    </td>
                                    <td>
                                        <!--========== SUBMIT BUTTON ==========-->
                                        <input type="button" name="add_to_cart" id="<?php echo $row["Stock_Id"]; ?>"
                                            style="margin-top:5px;"
                                            class="btn btn-outline-secondary btn-block add_to_cart"
                                            value="Add to Cart" />
                                    </td>
                                </tr>
                                <?php  
                                    }  
                                }  
                                ?>
                            </table>
                        </div>
                        <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i>
                            Do not delay the purchase, adding
                            items to your cart does not mean booking them.</p>
                    </div>
                </div>
            </div>

            <!--========== DISPLAY CART STOCK INVENTORY ==========-->
            <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Stock Inventory Details
                            </h5>
                            <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon"
                                data-dismiss="modal" aria-label="Close"><i class="ti-home"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive" id="order_table">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Stock Name</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">SubTotal</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    <?php  
                                        if(!empty($_SESSION["shopping_cart"]))  
                                        {  
                                            $total = 0;  
                                            foreach($_SESSION["shopping_cart"] as $keys => $values)  
                                            {                                               
                                        ?>
                                    <tr>
                                        <td>
                                            <img src="../Images/Stock/<?php echo $values["stock_image"]; ?>"
                                                alt="stock image" class="rounded-circle img-fluid" width="350px"
                                                id="Stock_Image<?php echo $values["stock_image"]; ?>" />

                                            <?php echo $values["stock_name"]; ?>
                                        </td>
                                        <td>
                                            <input type="number" name="quantity[]"
                                                id="quantity<?php echo $values["stock_id"]; ?>"
                                                value="<?php echo $values["stock_quantity"]; ?>"
                                                data-stock_id="<?php echo $values["stock_id"]; ?>"
                                                class="form-control quantity" />
                                        </td>
                                        <td class="text-center">RM
                                            <?php echo $values["buying_price"]; ?>
                                        </td>
                                        <td class="text-center">RM
                                            <?php echo number_format($values["stock_quantity"] * $values["buying_price"], 2); ?>
                                        </td>
                                        <td class="text-center"><button name="delete"
                                                class="btn btn-inverse-danger btn-fw btn-sm delete"
                                                id="<?php echo $values["stock_id"]; ?>">Remove</button>
                                        </td>
                                    </tr>
                                    <?php  
                                        $total = $total + ($values["stock_quantity"] * $values["buying_price"]);  
                                    }  
                                    ?>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td align="center"><b>TOTAL</b></td>
                                        <td align="center"><b>RM
                                                <?php echo number_format($total, 2); ?></b></td>
                                        <td align="center">
                                            <form method="post" action="Cart.php">
                                                <input type="submit" name="place_order" class="btn btn-warning mr-2"
                                                    value="Place Order" />
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                    }  
                                    else
                                    {
                                        echo '
                                        <tr>
                                            <td colspan="5" align="center">No Item in Cart</td>
                                        </tr>
                                        ';
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
        // SCRIPT FOR ADD-TO-CART
        $(document).ready(function(data) {
            $('.add_to_cart').click(function() {
                var stock_id = $(this).attr("id");
                var stock_name = $('#Stock_Name' + stock_id).val();
                var stock_image = $('#Stock_Image' + stock_id).val();
                var buying_price = $('#Buying_Price' + stock_id).val();
                var stock_quantity = $('#quantity' + stock_id).val();
                var action = "add";
                if (stock_quantity > 0) {
                    $.ajax({
                        url: "../Database/Stock/Inventory/Action.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            stock_id: stock_id,
                            stock_name: stock_name,
                            stock_image: stock_image,
                            buying_price: buying_price,
                            stock_quantity: stock_quantity,
                            action: action
                        },
                        success: function(data) {
                            $('#order_table').html(data.order_table);
                            $('.badge').text(data.cart_item);
                            alert("Stock has been Added into Cart");
                        }
                    });
                } else {
                    alert("Please Enter Number of Quantity")
                }
            });

            // SCRIPT FOR DELETE
            $(document).on('click', '.delete', function() {
                var stock_id = $(this).attr("id");
                var action = "remove";
                if (confirm("Are you sure you want to remove this stock?")) {
                    $.ajax({
                        url: "../Database/Stock/Inventory/Action.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            stock_id: stock_id,
                            action: action
                        },
                        success: function(data) {
                            $('#order_table').html(data.order_table);
                            $('.badge').text(data.cart_item);
                        }
                    });
                } else {
                    return false;
                }
            });

            // SCRIPT FOR UPDATE QUANTITY
            $(document).on('keyup', '.quantity', function() {
                var stock_id = $(this).data("stock_id");
                var quantity = $(this).val();
                var action = "quantity_change";
                if (quantity != '') {
                    $.ajax({
                        url: "../Database/Stock/Inventory/Action.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            stock_id: stock_id,
                            quantity: quantity,
                            action: action
                        },
                        success: function(data) {
                            $('#order_table').html(data.order_table);
                        }
                    });
                }
            });

        });
        </script>

        <!--========== INCLUDE FOOTER ==========-->
        <?php include '../partials/Footer.html';?>