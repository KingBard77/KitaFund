<?php
include '../config/db-config.php';
global $connection;

if($_REQUEST['action'] == 'fetch_volunteer'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    ## Custom Filtering 
    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $volunteer_remark = $_REQUEST['volunteer_remark'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND volunteer_date BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    if($volunteer_remark != ''){
        $volunteer_remark = " AND volunteer_remark = '$volunteer_remark' ";
    }

    ## Call Query 
    $columns = 'volunteer_id, volunteer_name, volunteer_email, volunteer_remark, volunteer_description, volunteer_date';
    $table = ' volunteer';
    $where = " WHERE volunteer_remark!='' ".$date_range.$volunteer_remark;

    $columns_order = array(
        0 => 'volunteer_id',
        1 => 'volunteer_name',
        2 => 'volunteer_email',
        3 => 'volunteer_description',
        4 => 'volunteer_remark',
        5 => 'volunteer_date'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    ## Search 
    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( volunteer_name LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR volunteer_email LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR volunteer_remark LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR volunteer_description LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR volunteer_date LIKE '%".$requestData['search']['value']."%' )";
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

        $nestedData['volunteer_id'] = $count;
        $nestedData['volunteer_name'] = $row["volunteer_name"];
        $nestedData['volunteer_email'] = '<a href="mailto:'.strtolower($row["volunteer_email"]).'">'.strtolower($row["volunteer_email"]).'</a>';

        $Status = '';
        if($row["volunteer_remark"] == 'Pending'){
            $Status ='<label class="badge badge-warning">Pending</label>';
        }
        if($row["volunteer_remark"] == 'Approved'){
            $Status ='<label class="badge badge-success">Approved</label>';
        }
        if($row["volunteer_remark"] == 'Unapproved'){
            $Status ='<label class="badge badge-danger">Unapproved</label>';
        }
        $nestedData['volunteer_remark'] = '<div class="col text-center">'.$Status.'</div>';


        $nestedData['volunteer_description'] = $row["volunteer_description"];

        $time = strtotime($row["volunteer_date"]);
        $nestedData['volunteer_date'] = '<div class="col text-center">'.date(' d F, Y', $time).'</div>';

        $nestedData['counter'] = '
        <div class="col text-center">
            <a href="javascript:void();" data-id="'.$row['volunteer_id'].'"  class="btn btn-outline-info btn-sm editbtn" >Edit</a>  
			<a href="javascript:void();" onClick="refreshPage()" data-id="'.$row['volunteer_id'].'"  class="btn btn-outline-danger btn-sm deleteBtn" >Delete</a>
			<a href="Employee_View.php?id='.$row['volunteer_id'].'"  class="btn btn-outline-primary btn-sm infoBtn" >View</a>
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
