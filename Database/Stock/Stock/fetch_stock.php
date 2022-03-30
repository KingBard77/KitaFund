<?php
include '../../config/db-config.php';
global $connection;

if ($_REQUEST['action'] == 'fetch_stock') {

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    ## Custom Filtering
    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $Stock_Name = $_REQUEST['Stock_Name'];

    if (!empty($initial_date) && !empty($final_date)) {
        $date_range = " AND Stock_Date BETWEEN '" . $initial_date . "' AND '" . $final_date . "' ";
    } else {
        $date_range = "";
    }

    if ($Stock_Name != '') {
        $Stock_Name = " AND Stock_Name = '$Stock_Name' ";
    }

    ## Call Query
    $columns = 's.Stock_Id, s.Stock_Name, s.Quantity_In, s.Buying_Price, s.Selling_Price, s.Stock_Date,
	c.Category_Name ';
    $table = ' stock s JOIN category c ON s.Category_id = c.Category_id ';
    $where = " WHERE s.Stock_Name!='' " . $date_range . $Stock_Name;

    $columns_order = array(
        0 => 'Stock_Id',
        1 => 'Stock_Name',
        2 => 'Quantity_In',
        3 => 'Buying_Price',
        4 => 'Selling_Price',
        5 => 'Category_Name',
        6 => 'Stock_Date',
    );

    $sql = "SELECT " . $columns . " FROM " . $table . " " . $where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    ## Search
    if (!empty($requestData['search']['value'])) {
        $sql .= " AND ( Stock_Name LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Quantity_In LIKE '%" . $requestData['search']['value'] . "%'";
        $sql .= " OR Buying_Price LIKE '%" . $requestData['search']['value'] . "%'";
        $sql .= " OR Selling_Price LIKE '" . $requestData['search']['value'] . "'";
        $sql .= " OR c.Category_Name LIKE '%" . $requestData['search']['value'] . "%'";
        $sql .= " OR Stock_Date LIKE '%" . $requestData['search']['value'] . "%' )";
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

        $nestedData['Stock_Id'] = $count;
        $nestedData['Stock_Name'] 	 = $row["Stock_Name"];
        $nestedData['Quantity_In'] 	 = $row["Quantity_In"];
        $nestedData['Buying_Price']  = 'RM '.$row["Buying_Price"];
        $nestedData['Selling_Price'] = 'RM '.$row["Selling_Price"];
        $nestedData['Category_Name'] = $row["Category_Name"];

        $time = strtotime($row["Stock_Date"]);
        $nestedData['Stock_Date'] = '<div class="col text-center">'.date('h:i:s A - d M, Y', $time).'</div>';

        $nestedData['counter'] = '
		<div class="col text-center">
			<a href="javascript:void();" data-id="' . $row['Stock_Id'] . '"  class="btn btn-outline-info btn-sm editbtn" >Edit</a>
			<a href="javascript:void();" onClick="refreshPage()" data-id="' . $row['Stock_Id'] . '"  class="btn btn-outline-danger btn-sm deleteBtn" >Delete</a>
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
