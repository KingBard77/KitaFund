<?php
include '../../config/db-config.php';
global $connection;

if($_REQUEST['action'] == 'fetch_purchase'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    ## Custom Filtering 
    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $Purchase_Status = $_REQUEST['Purchase_Status'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND Purchase_Date BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    if($Purchase_Status != ''){
        $Purchase_Status = " AND Purchase_Status = '$Purchase_Status' ";
    }

    ## Call Query 
    $columns = ' * ';
    $table = ' purchase 
    INNER JOIN profile  
    ON profile.Profile_Id = purchase.Owner_Code  
    iNNER JOIN owner
    ON owner.Profile_Id = purchase.Owner_Code';
    $where = " WHERE purchase.purchase_id!='' ".$date_range.$Purchase_Status;

    $columns_order = array(
        0 => 'Purchase_Id',
        1 => 'Purchase_Status',
        2 => 'Purchase_Date',
        3 => 'Owner_Code'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    ## Search 
    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( Purchase_Status LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR Purchase_Date LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Owner_Code LIKE '%".$requestData['search']['value']."%' )";
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

        $nestedData['Purchase_Id'] = $count;

        $Status = '';
        if($row["Purchase_Status"] == 'Pending'){
            $Status ='<label class="badge badge-warning">Pending</label>';
        }
        if($row["Purchase_Status"] == 'Purchase'){
            $Status ='<label class="badge badge-success">Purchase</label>';
        }

        $nestedData['Purchase_Status'] = '<div class="col text-center">'.$Status.'  </div>';
        $nestedData['Owner_Code'] = '<div class="col text-center">'.$row['Owner_Code'].'  </div>';
        
        $time = strtotime($row["Purchase_Date"]);
        $nestedData['Purchase_Date'] = '<div class="col text-center">'.date(' d F, Y', $time).'  </div>';
    

        $nestedData['counter'] = '
        <div class="col text-center">
            <a href="javascript:void();" data-id="'.$row['Purchase_Id'].'"  class="btn btn-outline-info btn-sm editbtn" >Edit</a>  
			<a href="javascript:void();" onClick="refreshPage()" data-id="'.$row['Purchase_Id'].'"  class="btn btn-outline-danger btn-sm deleteBtn" >Delete</a>
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
