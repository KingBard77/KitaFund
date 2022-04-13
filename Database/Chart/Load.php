<?php
include '../connection.php';
if (isset($_POST['row'])) {
    $start = $_POST['row'];
    $limit = 8;
    $query = "SELECT *
            FROM stock s JOIN category c ON s.Category_id = c.Category_id 
            ORDER BY Stock_Id ASC LIMIT ".$start.",".$limit;	
    $result = mysqli_query($dbc,$query);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tbody>
            <tr>
                <td class="pl-0"><?php echo $row["Stock_Name"]; ?></td>
                <td>
                    <p class="mb-0">
                    <div class="col text-center"><span class="font-weight-bold mr-2">
                            <?php echo $row["Category_Name"]; ?></span>
                    </div>
                    </p>
                </td>
                <td class="text-muted">
                    <div class="col text-center">
                        <?php echo $row["Quantity_In"]; ?> pieces
                    </div>
                </td>
            </tr>
        </tbody>
        <?php 
        }  
    }	
}
?>