<?php
include '../config/db-config.php';
global $connection;

if($_REQUEST['action'] == 'fetch_donator'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    ## Custom Filtering 
    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $donator_name = $_REQUEST['donator_name'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND donator_date BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    if($donator_name != ''){
        $donator_name = " AND donator_name = '$donator_name' ";
    }

    ## Call Query 
    $columns = 'donator_id, donator_name, donator_email, donator_ic, donator_phone, 
    donator_card_number, donator_name_holder, ccv, expired_date, amount, donator_date';
    $table = ' donator';
    $where = " WHERE donator_name!='' ".$date_range.$donator_name;

    $columns_order = array(
        0 => 'donator_id',
        1 => 'donator_name',
        2 => 'donator_email',
        3 => 'donator_ic',
        4 => 'donator_phone',
        5 => 'donator_card_number',
        6 => 'donator_name_holder',
        7 => 'ccv',
        8 => 'expired_date',
        9 => 'amount',
        10 => 'joining_date'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    ## Search 
    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( donator_name LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR donator_email LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR donator_ic LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR donator_phone LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR donator_card_number LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR donator_name_holder LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR ccv LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR expired_date LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR amount LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR donator_date LIKE '%".$requestData['search']['value']."%' )";
    }

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    $sql .= " ORDER BY ". $columns_order[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];

    if($requestData['length'] != "-1"){
        $sql .= " LIMIT ".$requestData['start']." ,".$requestData['length'];
    }

    ## Image Result
    // $image = $data['Image_Name'];
    // $image_src = "../Images/Employee_Image/".$image;

    ## Fetch records
    $result = mysqli_query($connection, $sql);
    $data = array();
    $counter = $start;
    $count = $start;
    while($row = mysqli_fetch_array($result)){
        $count++;
        $nestedData = array();

        $nestedData['donator_id'] = $count;
        $nestedData['donator_name'] = $row["donator_name"];
        $nestedData['donator_email'] = '<a href="mailto:'.strtolower($row["donator_email"]).'">'.strtolower($row["donator_email"]).'</a>';
        $nestedData['donator_ic'] = $row["donator_ic"];
        $nestedData['donator_phone'] = '<a href="https://wa.me/+6'.$row["donator_phone"].'" target="_blank">'.$row["donator_phone"].'</a>';

        $nestedData['donator_card_number'] = $row["donator_card_number"];
        $nestedData['donator_name_holder'] = $row["donator_name_holder"];
        $nestedData['ccv'] = $row["ccv"];
        $nestedData['amount'] = 'RM '.$row["amount"];
        $nestedData['expired_date'] = $row["expired_date"];

        $time = strtotime($row["donator_date"]);
        $nestedData['donator_date'] = '<div class="col text-center">'.date(' d F, Y', $time).'</div>';

        $nestedData['counter'] = '
        <div class="col text-center">
            <a href="javascript:void();" data-id="'.$row['donator_id'].'"  class="btn btn-outline-info btn-sm editbtn" >Edit</a>  
			<a href="javascript:void();" onClick="refreshPage()" data-id="'.$row['donator_id'].'"  class="btn btn-outline-danger btn-sm deleteBtn" >Delete</a>
			<a href="Employee_View.php?id='.$row['donator_id'].'"  class="btn btn-outline-primary btn-sm infoBtn" >View</a>
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
