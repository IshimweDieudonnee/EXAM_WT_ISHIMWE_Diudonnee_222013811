
<?php
// Connection details
$host = "localhost";
$user = "dieudonne";
$pass = "22200123";
$database = "communicationskills_workshops_platform";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
