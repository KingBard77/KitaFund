<!--========== EMPLOYEE MATERIALS ORDERING ==========-->
<?php
// This function outputs theoretical HTML
// for adding ads to a Web page.

$page_title = 'Raw Material';
include '../partials/Navbar - Employee.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Employee.php';


// Define the query:
$query = "SELECT * FROM product ORDER BY Product_Id ASC";
$product = mysqli_query($dbc, $query);

// Count the number of returned rows:
$product_num = mysqli_num_rows($product);

if ($product_num > 0) { // If it ran OK, display the records.
}
?>
<style>
    img {
    width: 200px; /* You can set the dimensions to whatever you want */
    height: 200px;
    object-fit: cover;
}
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <!--========== ORDERING RAW NATERIAL ==========-->
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="container text-center pt-5">
                            <h4 class="mb-3 mt-5">Raw Materials Order (<span><?php echo "$product_num" ?></span>
                                products)</h4>
                            <p class="w-75 mx-auto mb-5">Add to Cart - Make a <b>Raw Material Ordering</b> before end the business
                                operation.
                                <!--========== BUTTON CART RAW NATERIAL ==========-->
                                <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                    data-target="#cartModal" >
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
                            <div class="row pricing-table">
                                <?php  
                                    $query = "SELECT * FROM product ORDER BY Product_Id ASC";  
                                    $result = mysqli_query($dbc, $query);  
                                    if(mysqli_num_rows($result) > 0)  
                                    {  
                                        while($row = mysqli_fetch_array($result))  
                                        {  
                                    ?>
                                <div class="col-md-4 col-xl-4 grid-margin stretch-card pricing-card">
                                    <div class="card border-primary border pricing-card-body">
                                        <div class="text-center pricing-card-head">
                                            <!--========== PRODUCT IMAGE ==========-->
                                            <img src="../Images/Raw Materials/<?php echo $row["Product_Image"]; ?>"
                                                id="Product_Image" alt="product image"
                                                class="rounded-circle img-fluid mx-auto d-block"/>

                                            <!--========== HIDDEN PRODUCT IMAGE ==========-->
                                            <input type="hidden" name="hidden_image"
                                                id="Product_Image<?php echo $row["Product_Id"]; ?>"
                                                value="<?php echo $row["Product_Image"]; ?>" />

                                            <p>
                                                <!--========== PRODUCT NAME ==========-->
                                            <h5><?php echo $row["Product_Name"]; ?></h5>

                                            <p class="mb-3 text-muted text-uppercase small">
                                                Raw Materials Season's
                                            </p>
                                            <!--========== HIDDEN PRODUCT NAME ==========-->
                                            <input type="hidden" name="hidden_name"
                                                id="Product_Name<?php echo $row["Product_Id"]; ?>"
                                                value="<?php echo $row["Product_Name"]; ?>" /></p>
                                            <!--========== QUANTITY ==========-->
                                            <div>
                                                <div class="def-number-input number-input safari_only mb-0 w-100">
                                                    <input type="number" name="quantity" min="1" max="5" step="1"
                                                        value="1" id="quantity<?php echo $row["Product_Id"]; ?>"
                                                        class="form-control form-control-sm" value="1" />
                                                </div>
                                                <small id="passwordHelpBlock" class="form-text text-muted text-center">
                                                    (Note, 1 piece)
                                                </small>
                                            </div>
                                            <h1 class="font-weight-normal mb-4">
                                                <!--========== PRODUCT PRICE ==========-->
                                                <p class="mb-0"><span><strong>RM
                                                            <?php echo $row["Product_Price"]; ?></strong></span>
                                                </p>

                                                <!--========== HIDDEN PRODUCT PRICE ==========-->
                                                <input type="hidden" name="hidden_price"
                                                    id="Product_Price<?php echo $row["Product_Id"]; ?>"
                                                    value="<?php echo $row["Product_Price"]; ?>" />
                                            </h1>
                                        </div>
                                        <div class="wrapper">
                                            <!--========== SUBMIT BUTTON ==========-->
                                            <input type="button" name="add_to_cart"
                                                id="<?php echo $row["Product_Id"]; ?>" style="margin-top:5px;"
                                                class="btn btn-outline-secondary btn-block add_to_cart"
                                                value="Add to Cart" />

                                        </div>
                                        <p class="mt-3 mb-0 plan-cost text-gray">Free</p>
                                    </div>
                                </div>
                                <?php  
                                    }  
                                }  
                                ?>
                            </div>
                        </div>
                        <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i>
                            Do not delay the purchase, adding
                            items to your cart does not mean booking them.</p>
                    </div>
                </div>
            </div>

            <!--========== DISPLAY CART RAW NATERIAL ==========-->
            <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Raw Material Details
                            </h5>
                            <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon"
                                data-dismiss="modal" aria-label="Close"><i class="ti-home"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive" id="order_table">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Product Name</th>
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
                                            <img src="../Images/Raw Materials/<?php echo $values["product_image"]; ?>"
                                                alt="product image" class="rounded-circle img-fluid" width="350px"
                                                id="Product_Image<?php echo $values["product_image"]; ?>" />

                                            <?php echo $values["product_name"]; ?>
                                        </td>
                                        <td>
                                            <input type="number" name="quantity[]" 
                                                id="quantity<?php echo $values["product_id"]; ?>"
                                                value="<?php echo $values["product_quantity"]; ?>"
                                                data-product_id="<?php echo $values["product_id"]; ?>"
                                                class="form-control quantity" />
                                        </td>
                                        <td class="text-center">RM
                                            <?php echo $values["product_price"]; ?>
                                        </td>
                                        <td class="text-center">RM
                                            <?php echo number_format($values["product_quantity"] * $values["product_price"], 2); ?>
                                        </td>
                                        <td class="text-center"><button name="delete"
                                                class="btn btn-inverse-danger btn-fw btn-sm delete"
                                                id="<?php echo $values["product_id"]; ?>">Remove</button>
                                        </td>
                                    </tr>
                                    <?php  
                                        $total = $total + ($values["product_quantity"] * $values["product_price"]);  
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
            var product_id = $(this).attr("id");
            var product_name = $('#Product_Name' + product_id).val();
            var product_image = $('#Product_Image' + product_id).val();
            var product_price = $('#Product_Price' + product_id).val();
            var product_quantity = $('#quantity' + product_id).val();
            var action = "add";
            if (product_quantity > 0) {
                $.ajax({
                    url: "../Database/Record/Stock/Raw_Material/Action.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        product_id: product_id,
                        product_name: product_name,
                        product_image: product_image,
                        product_price: product_price,
                        product_quantity: product_quantity,
                        action: action
                    },
                    success: function(data) {
                        $('#order_table').html(data.order_table);
                        $('.badge').text(data.cart_item);
                        alert("Product has been Added into Cart");
                    }
                });
            } else {
                alert("Please Enter Number of Quantity")
            }
        });

        // SCRIPT FOR DELETE
        $(document).on('click', '.delete', function() {
            var product_id = $(this).attr("id");
            var action = "remove";
            if (confirm("Are you sure you want to remove this product?")) {
                $.ajax({
                    url: "../Database/Record/Stock/Raw_Material/Action.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        product_id: product_id,
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
            var product_id = $(this).data("product_id");
            var quantity = $(this).val();
            var action = "quantity_change";
            if (quantity != '') {
                $.ajax({
                    url: "../Database/Record/Stock/Raw_Material/Action.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        product_id: product_id,
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