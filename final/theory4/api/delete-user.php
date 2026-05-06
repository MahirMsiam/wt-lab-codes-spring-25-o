<?php
// API endpoint to delete a user from db
// URL: http://localhost:8080/wt_o/theory4/api/delete-user.php
// It recieves the username as input
// Method POST

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// echo "POST request recieved";

	$raw = file_get_contents('php://input'); // extract the POST payload
	// echo $raw;
	$data_assoc = json_decode($raw, true); // converts JSON string to PHP Assoc array
	// print_r($data_assoc);
	$username = $data_assoc['username'] ?? ($_POST['username'] ?? '');
	// if (isset($data_assoc['username'])) {
	// 	echo $_POST['username'];
	// } else {
	// 	echo '';
	// }
	// echo $username;

	include_once("db.php");

	$dbConnObj = new DBConnection();
	$conn = $dbConnObj->connect();

	$sql = "DELETE FROM users where username = '" . $username . "';";
	// echo $sql;
	$delete_successful = $conn->query($sql);

	if ($delete_successful) {
		echo '{"success":"true"}';
	} else {
		echo '{"success":"false"}';
	}
}
?>