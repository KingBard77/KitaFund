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
if (isset($_POST['Profile_Id'])) {
	$query = "SELECT * FROM profile where Profile_Id=".$_POST['Profile_Id']." LIMIT 1";
	$result = $db->query($query);
	if ($result->num_rows > 0 ) {
		 while ($row = $result->fetch_assoc()) {
			$data['success'] = true;
		 	$data['bank_name'] = $row['Bank_Name'];
			$data['account_no'] = $row['Account_No'];
		 }
	}else{

		$data['success'] = false;
	}

}

echo json_encode($data);
?>