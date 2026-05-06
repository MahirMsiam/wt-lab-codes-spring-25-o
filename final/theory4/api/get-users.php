<?php
// API endpoint that returns users list from db (Method: GET)
// URL: http://localhost:8080/wt_o/theory4/api/get-users.php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	include_once("db.php");

	$dbConnObj = new DBConnection();
	$conn = $dbConnObj->connect();

	$sql = "SELECT * FROM users";
	$result = $conn->query($sql);

	$user_count = $result->num_rows;
	$users_array = []; // indexed array

	// $users_array: 
	// [0] -> ["username"=>"john", "email"=>"john@example.com, "id"=>1...] 
	// [1] -> ["username"=>"jane", "email"=>"jane@example.com, "id"=>2...] 

	if ($user_count > 0) {
		while($row = $result->fetch_assoc()) { // this loop iterates over all rows that were returned
			// for each row, create a user object that will be insterted into users_array	
			$user = []; // associative array
			$user['username'] = $row['username'];
			$user['id'] = $row['id'];
			$user['email'] = $row['email'];
			$user['created_at'] = $row['created_at'];

			array_push($users_array, $user);
		}
	} else {
		echo "No users found in db";
	}

	echo json_encode($users_array); // converts php variables (arrays, object) to JSON
}
?>