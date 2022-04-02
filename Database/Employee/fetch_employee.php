<?php
include '../config/db-config.php';
global $connection;

if($_REQUEST['action'] == 'fetch_employee'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    ## Custom Filtering 
    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $Employee_Code = $_REQUEST['Employee_Code'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND Joining_Date BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    if($Employee_Code != ''){
        $Employee_Code = " AND Employee_Code = '$Employee_Code' ";
    }

    ## Call Query 
    $columns = 'p.Profile_Id, e.Employee_Code, p.Image_Name, p.First_Name, p.Last_Name, 
    p.Email, p.Phone, p.Joining_Date ';
    $table = ' employee e JOIN profile p ON e.Profile_Id = p.Profile_Id ';
    $where = " WHERE e.Employee_Code!='' ".$date_range.$Employee_Code;

    $columns_order = array(
        0 => 'Profile_Id',
        1 => 'Image_Name',
        2 => 'Employee_Code',
        3 => 'First_Name',
        4 => 'Last_Name',
        5 => 'Email',
        6 => 'Phone',
        7 => 'Joining_Date'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    ## Search 
    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( First_Name LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR e.Employee_Code LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Last_Name LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Email LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Phone LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Joining_Date LIKE '%".$requestData['search']['value']."%' )";
    }

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    $sql .= " ORDER BY ". $columns_order[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];

    if($requestData['length'] != "-1"){
        $sql .= " LIMIT ".$requestData['start']." ,".$requestData['length'];
    }


    ## Image Result
    $image = $data['Image_Name'];
    $image_src = "../Images/Employee_Image/".$image;

    ## Fetch records
    $result = mysqli_query($connection, $sql);
    $data = array();
    $counter = $start;
    $count = $start;
    while($row = mysqli_fetch_array($result)){
        $count++;
        $nestedData = array();

        $nestedData['Profile_Id'] = $count;
        $nestedData['Image_Name'] ='<img src="../Images/Employee_Image/'.$row["Image_Name"].'" class="rounded-circle float-left img-fluid mx-auto d-block" width="50" height="35" />';
        $nestedData['Employee_Code'] = $row["Employee_Code"];
        $nestedData['First_Name'] = $row["First_Name"];
        $nestedData['Last_Name'] = $row["Last_Name"];
        $nestedData['Email'] = '<a href="mailto:'.strtolower($row["Email"]).'">'.strtolower($row["Email"]).'</a>';
        $nestedData['Phone'] = '<a href="https://wa.me/+6'.$row["Phone"].'" target="_blank">'.$row["Phone"].'</a>';

        $time = strtotime($row["Joining_Date"]);
        $nestedData['Joining_Date'] = '<div class="col text-center">'.date(' d F, Y', $time).'</div>';

        $nestedData['counter'] = '
        <div class="col text-center">
            <a href="javascript:void();" data-id="'.$row['Profile_Id'].'"  class="btn btn-outline-info btn-sm editbtn" >Edit</a>  
			<a href="javascript:void();" onClick="refreshPage()" data-id="'.$row['Profile_Id'].'"  class="btn btn-outline-danger btn-sm deleteBtn" >Delete</a>
			<a href="Employee_View.php?id='.$row['Profile_Id'].'"  class="btn btn-outline-primary btn-sm infoBtn" >View</a>
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
