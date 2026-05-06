<?php
	class DBConnection {
		private $hostname = 'localhost';
		private $db_username = 'root';
		private $db_password = '';
		private $db_name = 'wt_o';

		public function connect() {
			// echo 'DBConnection connect method called';
			$connection = new mysqli(
				$this->hostname,
				$this->db_username,
				$this->db_password,
				$this->db_name,
			);
			// echo 'DBConnection object created: ' . print_r($connection, true);

			if (isset($connection->connect_error)) {
				echo "DB connection failed: " . $connection->connect_error;
			}

			return $connection;
		}
	}
?>