<?php
include '../../config/db-config.php';
global $connection;

if($_REQUEST['action'] == 'fetch_sales'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    ## Custom Filtering 
    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND Sales_Date BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    ## Call Query 
    $columns = 's.Sales_Id, s.Quantity_Open, s.Quantity_Close, s.Quantity_Balance, s.SubTotal, 
    s.Sales_Date, c.Stock_Name, c.Quantity_In, c.Selling_Price';
    $table = ' sales s JOIN stock c ON s.Stock_Id = c.Stock_Id';
    $where = " WHERE Sales_Id!='' ".$date_range;

    $columns_order = array(
        0 => 'Sales_Id',
        1 => 'Stock_Name',
        2 => 'Quantity_In',
        3 => 'Quantity_Open',
        4 => 'Quantity_Close',
        5 => 'Quantity_Balance',
        6 => 'Selling_Price',
        7 => 'SubTotal',
        8 => 'Sales_Date'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    ## Search 
    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( Stock_Name LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR Quantity_In LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Quantity_Open LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Quantity_Close LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Quantity_Balance LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Selling_Price LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR SubTotal LIKE '".$requestData['search']['value']."'";
        $sql.=" OR Sales_Date LIKE '%".$requestData['search']['value']."%' )";
    }

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    $sql .= " ORDER BY ". $columns_order[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];

    if($requestData['length'] != "-1"){
        $sql .= " LIMIT ".$requestData['start']." ,".$requestData['length'];
    }

    ## Fetch records
    $result = mysqli_query($connection, $sql);
    $data = array();
    $counter = $start;
    $count = $start;
    while($row = mysqli_fetch_array($result)){
        $count++;
        $nestedData = array();

        $nestedData['Sales_Id'] = $count;
        $nestedData['Stock_Name']           = $row["Stock_Name"];
        $nestedData['Quantity_In']          = '<div class="col text-center">'.$row["Quantity_In"].'</div>';
        $nestedData['Quantity_Open']        = '<div class="col text-center">'.$row["Quantity_Open"].'</div>';
        $nestedData['Quantity_Close']       = '<div class="col text-center">'.$row["Quantity_Close"].'</div>';
        $nestedData['Quantity_Balance']     = '<div class="col text-center">'.$row["Quantity_Balance"].'</div>';
        $nestedData['Selling_Price']        = 'RM '.$row["Selling_Price"];
        $nestedData['SubTotal']             = 'RM '.$row["SubTotal"];

        $time = strtotime($row["Sales_Date"]);
        $nestedData['Sales_Date'] = '<div class="col text-center">'.date(' d F, Y', $time).'</div>';

        $nestedData['counter'] = '
        <div class="col text-center">
            <a href="javascript:void();" data-id="'.$row['Sales_Id'].'"  class="btn btn-outline-info btn-sm editbtn" >Edit</a>  
			<a href="javascript:void();" onClick="refreshPage()" data-id="'.$row['Sales_Id'].'"  class="btn btn-outline-danger btn-sm deleteBtn" >Delete</a>
        </div>';
        $data[] = $nestedData;
    }

    ## Response
    $json_data = array(
        "draw"            => intval( $requestData['draw'] ),
        "recordsTotal"    => intval( $totalData),
        "recordsFiltered" => intval( $totalFiltered ),
        "records"         => $data
    );

    echo json_encode($json_data);
}

?>
