<?php
include '../config/db-config.php';
global $connection;

if($_REQUEST['action'] == 'fetch_contact'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    ## Custom Filtering 
    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $contact_subject = $_REQUEST['contact_subject'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND contact_date BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    if($contact_subject != ''){
        $contact_subject = " AND contact_subject = '$contact_subject' ";
    }

    ## Call Query 
    $columns = 'contact_id, contact_name, contact_email, contact_subject, contact_message, contact_date, contact_remark';
    $table = ' contact';
    $where = " WHERE contact_subject!='' ".$date_range.$contact_subject;

    $columns_order = array(
        0 => 'contact_id',
        1 => 'contact_name',
        2 => 'contact_email',
        3 => 'contact_subject',
        4 => 'contact_message',
        5 => 'contact_remark',
        6 => 'contact_date'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    ## Search 
    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( contact_name LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR contact_email LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR contact_subject LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR contact_message LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR contact_remark LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR contact_date LIKE '%".$requestData['search']['value']."%' )";
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

        $nestedData['contact_id'] = $count;
        $nestedData['contact_name'] = $row["contact_name"];
        $nestedData['contact_email'] = '<a href="mailto:'.strtolower($row["contact_email"]).'">'.strtolower($row["contact_email"]).'</a>';
        $nestedData['contact_subject'] = $row["contact_subject"];

        $nestedData['contact_message'] = $row["contact_message"];

        $Status = '';
        if($row["contact_remark"] == 'Hold'){
            $Status ='<label class="badge badge-warning">Hold</label>';
        }
        if($row["contact_remark"] == 'Proceed'){
            $Status ='<label class="badge badge-success">Proceed</label>';
        }
        if($row["contact_remark"] == 'Reject'){
            $Status ='<label class="badge badge-danger">Reject</label>';
        }
        $nestedData['contact_remark'] = '<div class="col text-center">'.$Status.'</div>';



        $time = strtotime($row["contact_date"]);
        $nestedData['contact_date'] = '<div class="col text-center">'.date(' d F, Y', $time).'</div>';

        $nestedData['counter'] = '
        <div class="col text-center">
            <a href="javascript:void();" data-id="'.$row['contact_id'].'"  class="btn btn-outline-info btn-sm editbtn" >Edit</a>  
			<a href="javascript:void();" onClick="refreshPage()" data-id="'.$row['contact_id'].'"  class="btn btn-outline-danger btn-sm deleteBtn" >Delete</a>
			<a href="Employee_View.php?id='.$row['contact_id'].'"  class="btn btn-outline-primary btn-sm infoBtn" >View</a>
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
