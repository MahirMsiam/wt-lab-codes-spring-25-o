<?php
	include("db_conn.php");

	// session check if needed

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
			// insert user into db
			// $sql = "INSERT INTO users (username, email, password) values ('";
			// $sql .= $_POST['username'];
			// $sql .= "','";
			// $sql .= $_POST['email'];
			// $sql .= "','";
			// $sql .= $_POST['password'];
			// $sql .= "');";
			// INSERT INTO users (username, email, password) values ('adam','adam@example.com','123');


			// prepared statements stop SQL injection
			// $conn->query($sql); // DONT DO THIS
			$sql = "INSERT INTO users (username, email, password) values (?,?,?)";
			$prepared_statement = $conn->prepare($sql);
			$prepared_statement->bind_param("sss", $_POST['username'], $_POST['email'], $_POST['password']);

			if($prepared_statement->execute()) {
				// insert successfull
				header('Location: home.php');
			} else {
				// insert unsuccessfull
				echo "eror happ";
			}
		}
	}
?>