<?php 
$host = 'localhost';
$username = 'root';
$pass = '';
$db = 'burgerbyte';

$db = new mysqli($host,$username,$pass,$db);

if ($db->connect_error) {
	 die("Connection Failed". $db->connect_error);
}
$data = array();
if (isset($_POST['Stock_Id'])) {
	$query = "SELECT * FROM stock where Stock_Id=".$_POST['Stock_Id']." LIMIT 1";
	$result = $db->query($query);
	if ($result->num_rows > 0 ) {
		 while ($row = $result->fetch_assoc()) {
			$data['success'] = true;
		 	$data['selling_price'] = $row['Selling_Price'];
			$data['quantity_in'] = $row['Quantity_In'];
		 }
	}else{

		$data['success'] = false;
	}

}

echo json_encode($data);
?>