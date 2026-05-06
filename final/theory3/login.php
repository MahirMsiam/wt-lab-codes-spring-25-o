<?php
	session_start();

	include("db_conn.php");

	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		//login form submitted
		$username = $_POST['username'];
		$password = $_POST['password'];

		//actually check user in db
		$sql = "SELECT * FROM users WHERE username = '" . $username . "';";
		//SELECT * FROM users WHERE username = 'john';
		$result = $conn->query($sql);

		// check if at least one row was returned
		if ($result->num_rows > 0) {
			//at least one user was found
			while ($row = $result->fetch_assoc()) {
				// echo print_r($row['passwordk']);
				// echo "<br>";
				if ($row['password'] === $password) {
					//login successful

					// store username in session
					$_SESSION['username'] = $username;

					// redirect to home page
					header('Location: home.php');
				} else {
					// login unsuccessful
					echo "invalid password";
				}
			}
		} else {
			// no user was found with the username
			echo "Invalid username";
		}
	}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<title>Page Title</title>
	<link rel='stylesheet' href='main.css'>
</head>
<body>
	<h1>Login page</h1>
	<form method="post" action="login.php">
		<input type="text" placeholder="username" name="username">
		<input type="password" placeholder="password" name="password">
		<input type="submit" value="Login">
	</form>	
</body>
</html>