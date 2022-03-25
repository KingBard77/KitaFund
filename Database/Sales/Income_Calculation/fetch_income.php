<?php
include '../../config/db-config.php';
global $connection;

if($_REQUEST['action'] == 'fetch_income'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    ## Custom Filtering 
    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND Income_Date BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    ## Call Query 
    $columns = 'Income_Id, Net_Expenses, Net_Income, Income_Date ';
    $table = ' income ';
    $where = " WHERE Income_Id!='' ".$date_range;

    $columns_order = array(
        0 => 'Income_Id',
        1 => 'Net_Expenses',
        2 => 'Net_Income',
        3 => 'Income_Date'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    ## Search 
    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( Net_Expenses LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR Net_Income LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Income_Date LIKE '%".$requestData['search']['value']."%' )";
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

        $nestedData['Income_Id'] = $count;
        $nestedData['Net_Expenses']   = 'RM '.$row["Net_Expenses"];


        $net_income =''; 
        if ($row["Net_Income"] > 0)
        {
            $net_income =  " <div class='text-success col text-center'>
                                <i class='ti-arrow-up'> </i>";
        } else if ($row["Net_Income"] < 0)
        {
            $net_income =  " <div class='text-danger col text-center'>
                                <i class='ti-arrow-down'> </i>";
        } else
        {
            $net_income = " <div class='text-warning col text-center'>";
        } 
        $nestedData['Net_Income']       = ''.$net_income. '<b>RM ' .$row["Net_Income"]. '</b></div>';

        $time = strtotime($row["Income_Date"]);
        $nestedData['Income_Date'] = '<div class="col text-center">'.date(' d F, Y', $time).'</div>';

        $nestedData['counter'] = '
        <div class="col text-center">
            <a href="javascript:void();" data-id="'.$row['Income_Id'].'"  class="btn btn-outline-info btn-sm editbtn" >Edit</a>  
			<a href="javascript:void();" onClick="refreshPage()" data-id="'.$row['Income_Id'].'"  class="btn btn-outline-danger btn-sm deleteBtn" >Delete</a>
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