<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<title>Page Title</title>
	<link rel='stylesheet' href='main.css'>
</head>
<body>
	<style>
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}
	</style>
	<h2>Users list:</h2>
	<a href="create.php">Create New User</a>
	<table id="users_table">
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>Email</th>
			<th>Created At</th>
			<th>Actions</th>
		</tr>
		<!-- <tr>
			<td>adam</td>
			<td>email</td>
		</tr> -->
		<!-- print rows with $users_array -->
	</table>
</body>
<script>
	document.addEventListener('DOMContentLoaded', loadUsersList());

	function loadUsersList() {
		// Get the users list from the API
		// URL: http://localhost:8080/wt_o/theory4/api/get-users.php
		// Method: GET

		var xhr = new XMLHttpRequest();
		xhr.open("GET", "http://localhost:8080/wt_o/theory4/api/get-users.php", false);
		xhr.send();
		console.log(xhr.responseText);

		// To populate the HTML table with this API response
		// step 1: convert JSON string response back to JS objects
		var users_list_arr = JSON.parse(xhr.responseText); // json_decode
		// JSON.stringify(users_list_arr) // json_encode


		var users_table = document.getElementById("users_table");
		// console.log(users_table);

		users_list_arr.forEach(user => {
			// console.log(user.id);
			// create a row for user

			var row = document.createElement('tr');

			// id
			var td = document.createElement('td');
			td.innerHTML = user.id;
			row.appendChild(td);

			// username
			var td = document.createElement('td');
			td.innerHTML = user.username;
			row.appendChild(td);

			// email
			var td = document.createElement('td');
			td.innerHTML = user.email;
			row.appendChild(td);

			// created_at
			var td = document.createElement('td');
			td.innerHTML = user.created_at;
			row.appendChild(td);

			// delete button
			var delete_button = document.createElement('button');
			delete_button.innerHTML = "Delete " + user.username;
			delete_button.addEventListener('click', () => {
				deleteUser(user.username)
			});
			row.appendChild(delete_button);

			// edit button
			var edit_button = document.createElement('button');
			edit_button.innerHTML = "edit " + user.username;
			edit_button.addEventListener('click', () => {
			});
			row.appendChild(edit_button);

			users_table.appendChild(row);
		});
	}

	function deleteUser(username) {
		alert("Deleting " + username);

		// call the delete-user.php API
		// URL: http://localhost:8080/wt_o/theory4/api/delete-user.php
		// Method: POST
		// Payload: {"username": "john"}

		var xhr = new XMLHttpRequest();
		xhr.open("POST", "http://localhost:8080/wt_o/theory4/api/delete-user.php", true); 
		// false = Synchronous
		// true = Asynchronous

		// For async requests, we should handle all paths before sending
		xhr.onreadystatechange = function () {
			if (xhr.readyState === 4 && xhr.status === 200) {
				// response is ready and request was successful
				alert(xhr.responseText);
				location.reload();
			} else if (xhr.readyState === 4 && xhr.status === 500) {
				alert("Internal server error from API");
			} else if (xhr.readyState === 4 && xhr.status === 400) {
				alert("Bad request from API");
			}
		}

		xhr.send('{"username":"' + username + '"}');
	}

	json_encode
	json_decode
</script>
</html>