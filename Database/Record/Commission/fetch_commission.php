<?php
include '../../config/db-config.php';
global $connection;

session_start();

if($_REQUEST['action'] == 'fetch_commission'){

    $emp_code = $_SESSION["Employee_Code"];
    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    ## Custom Filtering 
    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $Commission_Status = $_REQUEST['Commission_Status'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND Commission_Date BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    if($Commission_Status != ''){
        $Commission_Status = " AND Commission_Status = '$Commission_Status' ";
    }

    ## Call Query 
    $columns = 'p.Profile_Id, e.Employee_Code, c.Commission_Id, c.Commission_Date, c.Commission_Status,
    c.Basic_Commission, c.Earning_Total, c.Claiming, c.Deduction, c.Bonus, c.Net_Commission, 
    c.Account_No, c.Bank_Name, c.Commission_Message ';
    $table = ' employee e JOIN profile p ON e.Profile_Id = p.Profile_Id 
                          JOIN comission c ON c.Employee_Code = e.Profile_Id';
    $where = " WHERE e.Employee_Code ='$emp_code' ".$date_range.$Commission_Status;

    $columns_order = array(
        0 => 'Commission_Id',
        1 => 'Employee_Code',
        2 => 'Commission_Date',
        3 => 'Commission_Status',
        4 => 'Account_No',
        5 => 'Bank_Name',
        6 => 'Commission_Message'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    ## Search 
    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( Commission_Date LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR e.Employee_Code LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Commission_Status LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Account_No LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Bank_Name LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Commission_Message LIKE '%".$requestData['search']['value']."%' )";
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

        $nestedData['Commission_Id']        = $count;
        $nestedData['Employee_Code']        = $row["Employee_Code"];

        $Status = '';
        if($row["Commission_Status"] == 'Paid'){
            $Status ='<label class="badge badge-success">Paid</label>';
        }
        if($row["Commission_Status"] == 'Unpaid'){
            $Status ='<label class="badge badge-danger">Unpaid</label>';
        }

        $nestedData['Commission_Status'] = $Status;
        $nestedData['Account_No']           = $row["Account_No"];
        $nestedData['Bank_Name']            = $row["Bank_Name"];
        $nestedData['Commission_Message']   = $row["Commission_Message"];

        $time = strtotime($row["Commission_Date"]);
        $nestedData['Commission_Date'] = '<div class="col text-center">'.date('h:i:s A - d M, Y', $time).'</div>';

        $nestedData['counter'] = '
        <div class="col text-center">
            <a href="javascript:void();" data-id="'.$row['Commission_Id'].'"  class="btn btn-outline-info btn-sm editbtn" >Edit</a>  
			<a href="javascript:void();" onClick="refreshPage()" data-id="'.$row['Commission_Id'].'"  class="btn btn-outline-danger btn-sm deleteBtn" >Delete</a>
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
