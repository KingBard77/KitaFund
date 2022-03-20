<?php
include '../../config/db-config.php';
global $connection;

if($_REQUEST['action'] == 'fetch_invoice'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    ## Custom Filtering 
    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND Invoice_Date BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }


    ## Call Query 
    $columns = 'Invoice_Id, Total, Overhead, Total_Cash, Total_Sales, Invoice_Message, Invoice_Date ';
    $table = ' invoice ';
    $where = " WHERE Invoice_Id!='' ".$date_range;

    $columns_order = array(
        0 => 'Invoice_Id',
        1 => 'Total',
        2 => 'Overhead',
        3 => 'Total_Cash',
        4 => 'Total_Sales',
        5 => 'Invoice_Message',
        6 => 'Invoice_Date'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    ## Search 
    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( Total LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR Overhead LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Total_Cash LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Total_Sales LIKE '".$requestData['search']['value']."'";
        $sql.=" OR Invoice_Message LIKE '".$requestData['search']['value']."'";
        $sql.=" OR Invoice_Date LIKE '%".$requestData['search']['value']."%' )";
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

        $nestedData['Invoice_Id'] = $count;
        $nestedData['Total']            = 'RM '.$row["Total"];
        $nestedData['Overhead']         = 'RM '.$row["Overhead"];
        $nestedData['Total_Cash']       = 'RM '.$row["Total_Cash"];
        $nestedData['Invoice_Message']  = $row["Invoice_Message"];
        $nestedData['Total_Sales']      = 'RM '.$row["Total_Sales"];

        $time = strtotime($row["Invoice_Date"]);
        $nestedData['Invoice_Date'] = '<div class="col text-center">'.date(' d F, Y', $time).'</div>';

        $nestedData['counter'] = '
        <div class="col text-center">
            <a href="javascript:void();" data-id="'.$row['Invoice_Id'].'"  class="btn btn-outline-info btn-sm editbtn" >Edit</a>  
			<a href="javascript:void();" onClick="refreshPage()" data-id="'.$row['Invoice_Id'].'"  class="btn btn-outline-danger btn-sm deleteBtn" >Delete</a>
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
