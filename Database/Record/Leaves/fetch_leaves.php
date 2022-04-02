<?php
include '../../config/db-config.php';
global $connection;

session_start();

if($_REQUEST['action'] == 'fetch_leaves'){
	
	$emp_code = $_SESSION["Employee_Code"];
    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    ## Custom Filtering 
    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $Leave_Status = $_REQUEST['Leave_Status'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND Apply_Date BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    if($Leave_Status != ''){
        $Leave_Status = " AND Leave_Status = '$Leave_Status' ";
    }

    ## Call Query 
    $columns = 'l.Leave_Id, e.Employee_Code, l.Leave_Type, l.From_Date, 
    l.To_Date, l.Leave_Message, l.Owner_Remark, l.Leave_Status, l.Apply_Date ';
    $table = ' leaves l JOIN employee e ON l.Employee_Code = e.Profile_Id ';
    $where = " WHERE e.Employee_Code ='$emp_code' ".$date_range.$Leave_Status;
	

    $columns_order = array(
        0 => 'Leave_Id',
        1 => 'Employee_Code',
        2 => 'Leave_Type',
        3 => 'From_Date',
        4 => 'To_Date',
        5 => 'Leave_Message',
        7 => 'Leave_Status',
        8 => 'Apply_Date'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    ## Search 
    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( Leave_Type LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR e.Employee_Code LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR From_Date LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR To_Date LIKE '".$requestData['search']['value']."'";
        $sql.=" OR Leave_Message LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Leave_Status LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Apply_Date LIKE '%".$requestData['search']['value']."%' )";
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

        $nestedData['Leave_Id'] = $count;
        $nestedData['Employee_Code'] = $row["Employee_Code"];
        $nestedData['Leave_Type'] = $row["Leave_Type"];

        $From_Date = strtotime($row["From_Date"]);
        $nestedData['From_Date'] = date('d M, Y', $From_Date);

        $To_Date = strtotime($row["To_Date"]);
        $nestedData['To_Date'] = date('d M, Y', $To_Date);
        
        $nestedData['Leave_Message'] = $row["Leave_Message"];
        
        $Status = '';
        if($row["Leave_Status"] == 'Pending'){
            $Status ='<label class="badge badge-warning">Pending</label>';
        }
        if($row["Leave_Status"] == 'Approved'){
            $Status ='<label class="badge badge-success">Approved</label>';
        }
        if($row["Leave_Status"] == 'Unapproved'){
            $Status ='<label class="badge badge-danger">Unapproved</label>';
        }
        $nestedData['Leave_Status'] = '<div class="col text-center">'.$Status.'</div>';
            

        $Apply_Date = strtotime($row["Apply_Date"]);
        $nestedData['Apply_Date'] = '<div class="col text-center">'.date('h:i:s A - d M, Y', $Apply_Date).'</div>';

        $nestedData['counter'] = '
        <div class="col text-center">
            <a href="javascript:void();" data-id="'.$row['Leave_Id'].'"  class="btn btn-outline-info btn-sm editbtn" >Edit</a>  
			<a href="javascript:void();" onClick="refreshPage()" data-id="'.$row['Leave_Id'].'"  class="btn btn-outline-danger btn-sm deleteBtn" >Delete</a>
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
