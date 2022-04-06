<?php
include '../config/db-config.php';
global $connection;

if($_REQUEST['action'] == 'fetch_attendance'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    ## Custom Filtering 
    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $Action_Name = $_REQUEST['Action_Name'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND Attendance_Time BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    if($Action_Name != ''){
        $Action_Name = " AND Action_Name = '$Action_Name' ";
    }

    ## Call Query 
    $columns = 'a.Attendance_Id, e.Employee_Code, a.Action_Name, a.Attendance_Time,
    a.Attendance_Message';
    $table = ' attendance a JOIN employee e ON a.Employee_Code = e.Profile_Id ';
    $where = " WHERE e.Employee_Code!='' ".$date_range.$Action_Name;

    $columns_order = array(
        0 => 'Attendance_Id',
        1 => 'Employee_Code',
        2 => 'Action_Name',
        3 => 'Attendance_Time',
        4 => 'Attendance_Message',
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where."".$group;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    ## Search 
    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( Action_Name LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR e.Employee_Code LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Attendance_Time LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Attendance_Message LIKE '%".$requestData['search']['value']."%' )";
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

        $nestedData['Attendance_Id'] = $count;
        $nestedData['Employee_Code'] = $row["Employee_Code"];

        $Status = '';
        if($row["Action_Name"] == 'punchIn'){
            $Status ='<label class="badge badge-success">Punch-In</label>';
        }
        if($row["Action_Name"] == 'punchOut'){
            $Status ='<label class="badge badge-warning">Punch-Out</label>';
        }
        $nestedData['Action_Name'] = '<div class="col text-center">'.$Status.'</div>';

        $nestedData['Attendance_Message'] = $row["Attendance_Message"];

        $time = strtotime($row["Attendance_Time"]);
        $nestedData['Attendance_Time'] = '<div class="col text-center">'.date('h:i:s A - d M, Y', $time).'</div>';

        $nestedData['counter'] = '
        <div class="col text-center">
            <a href="javascript:void();" data-id="'.$row['Attendance_Id'].'"  class="btn btn-outline-info btn-sm editbtn" >Edit</a>  
			<a href="javascript:void();" onClick="refreshPage()" data-id="'.$row['Attendance_Id'].'"  class="btn btn-outline-danger btn-sm deleteBtn" >Delete</a>
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
