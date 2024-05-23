<?php
include 'database_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    // Ensure $connection is defined
    if (!$connection) {
        echo "Database connection error";
        exit();
    }

    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    
    // Check if the statement is prepared successfully
    $stmt = $connection->prepare($sql);
    if ($stmt === false) {
        echo "Error preparing statement: " . $connection->error;
        exit();
    }

    $stmt->bind_param("ssss", $name, $email, $password, $role);

    if ($stmt->execute()) {
        header("Location: login.html");
        exit();
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    $stmt->close();
}

$connection->close();
?>
