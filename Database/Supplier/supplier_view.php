<?php

include '../../config/db-config.php';
global $connection;

$Supplier_Id = $_GET['id'];
                                        // Retrieve the user's information:
                                        $query = "SELECT *
                                        FROM supplier
                                        WHERE Supplier_Id = $Supplier_Id ";
                                        $supplier = mysqli_query($dbc, $query);

                                        if (mysqli_num_rows($supplier) == 1) { // Valid user ID, show the form.

                                            // Get the user's information:
                                            $row = mysqli_fetch_array($supplier, MYSQLI_NUM); //MYSQLI_ASSOC
                                        ?>
<div class="message-body">
    <div class="sender-details">
        <img class="img-sm rounded-circle me-3" src="../Images/BurgerByte_Logo.png" alt="">
        <div class="details">
            <p class="msg-subject">
                <?php echo $row[3];?>
            </p>
            <p class="sender-email">
                <?php echo $row[1];?>
                <a href="#"><?php echo $row[2];?></a>
                &nbsp;<i class="ti-user"></i>
            </p>
        </div>
    </div>
    <div class="message-content">
        <p><?php echo $row[4];?></p>
        <p><br><br>Regards,<br>BurgerByte.Co</p>
        <p>* Click an attachment below to see the details:</p>
    </div>
    <div class="attachments-sections">
        <ul>
            <li>
                <div class="thumb"><i class="ti-file"></i></div>
                <div class="details">
                    <p class="file-name">Seminar Reports.pdf</p>
                    <div class="buttons">
                        <p class="file-size">678Kb</p>
                        <a href="#" class="view">View</a>
                        <a href="#" class="download">Download</a>
                    </div>
                </div>
            </li>
            <li>
                <div class="thumb"><i class="ti-image"></i></div>
                <div class="details">
                    <p class="file-name">Product Design.jpg</p>
                    <div class="buttons">
                        <p class="file-size">1.96Mb</p>
                        <a href="#" class="view">View</a>
                        <a href="#" class="download">Download</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<?php
                                        } else { // Not a valid user ID.
                                            echo 'NO DATA';
                                        }
                                        
                                        mysqli_close($dbc);?>