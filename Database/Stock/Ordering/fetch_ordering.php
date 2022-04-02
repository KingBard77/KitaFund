<?php
include '../../config/db-config.php';
global $connection;

if($_REQUEST['action'] == 'fetch_ordering'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    ## Custom Filtering 
    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $Order_Status = $_REQUEST['Order_Status'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND Order_Date BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    if($Order_Status != ''){
        $Order_Status = " AND Order_Status = '$Order_Status' ";
    }

    ## Call Query 
    $columns = ' * ';
    $table = ' ordering 
    INNER JOIN profile  
    ON profile.Profile_Id = ordering.Employee_Code  
    iNNER JOIN employee
    ON employee.Profile_Id = ordering.Employee_Code';
    $where = " WHERE ordering.Order_Id!='' ".$date_range.$Order_Status;

    $columns_order = array(
        0 => 'Order_Id',
        1 => 'Order_Status',
        2 => 'Order_Date',
        3 => 'Employee_Code'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    ## Search 
    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( Order_Status LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR Order_Date LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Employee_Code LIKE '%".$requestData['search']['value']."%' )";
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

        $nestedData['Order_Id'] = $count;

        $Status = '';
        if($row["Order_Status"] == 'Pending'){
            $Status ='<label class="badge badge-warning">Pending</label>';
        }
        if($row["Order_Status"] == 'Purchase'){
            $Status ='<label class="badge badge-success">Purchase</label>';
        }

        $nestedData['Order_Status'] = '<div class="col text-center">'.$Status.'  </div>';
        $nestedData['Employee_Code'] = '<div class="col text-center">'.$row['Employee_Code'].'  </div>';
        
        $time = strtotime($row["Order_Date"]);
        $nestedData['Order_Date'] = '<div class="col text-center">'.date(' d F, Y', $time).'  </div>';
    

        $nestedData['counter'] = '
        <div class="col text-center">
            <a href="javascript:void();" data-id="'.$row['Order_Id'].'"  class="btn btn-outline-info btn-sm editbtn" >Edit</a>  
			<a href="javascript:void();" onClick="refreshPage()" data-id="'.$row['Order_Id'].'"  class="btn btn-outline-danger btn-sm deleteBtn" >Delete</a>
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
