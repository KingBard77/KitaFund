<?php
include '../../config/db-config.php';
global $connection;

if ($_REQUEST['action'] == 'fetch_stock') {

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    ## Custom Filtering
    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $Category_Name = $_REQUEST['Category_Name'];

    if ($Category_Name != '') {
        $Category_Name = " AND Category_Name = '$Category_Name' ";
    }

    ## Call Query
    $columns = 'Category_Name, Category_Id';
    $table = ' category ';
    $where = " WHERE Category_Id!='' " . $Category_Name;

    $columns_order = array(
        0 => 'Category_Id',
        1 => 'Category_Name'
    );

    $sql = "SELECT " . $columns . " FROM " . $table . " " . $where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    ## Search
    if (!empty($requestData['search']['value'])) {
        $sql .= " AND ( Category_Name LIKE '%" . $requestData['search']['value'] . "%' )";
    }

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    $sql .= " ORDER BY " . $columns_order[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'];

    if ($requestData['length'] != "-1") {
        $sql .= " LIMIT " . $requestData['start'] . " ," . $requestData['length'];
    }

    ## Fetch records
    $result = mysqli_query($connection, $sql);
    $data = array();
    $counter = $start;
    $count = $start;
    while ($row = mysqli_fetch_array($result)) {
        $count++;
        $nestedData = array();

        $nestedData['Category_Id'] = $count;
        $nestedData['Category_Name'] = $row["Category_Name"];

        $nestedData['counter'] = '
		<div class="col text-center">
			<a href="javascript:void();" data-id="' . $row['Category_Id'] . '"  class="btn btn-outline-info btn-sm editbtn" >Edit</a>
			<a href="javascript:void();" onClick="refreshPage()" data-id="' . $row['Category_Id'] . '"  class="btn btn-outline-danger btn-sm deleteBtn" >Delete</a>
		</div>';
        $data[] = $nestedData;
    }

    ## Response
    $json_data = array(
        "draw" => intval($requestData['draw']),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "records" => $data,
    );

    echo json_encode($json_data);
}
