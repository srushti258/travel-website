<?php

$servername = "localhost";
$username = "root";
$password = "";

// Connect MySQL
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Create Database
$sql = "CREATE DATABASE IF NOT EXISTS travelhub";
if ($conn->query($sql) === TRUE) {
    // Database created or already exists
} else {
    die("Database Error: " . $conn->error);
}

// Select Database
$conn->select_db("travelhub");

// Create Table
$table = "CREATE TABLE IF NOT EXISTS registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    travel_date DATE NOT NULL,
    travelers INT NOT NULL,
    travel_class VARCHAR(50) NOT NULL,
    special_requests TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$conn->query($table);

// Save Form Data
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $destination = $_POST['destination'];
    $travel_date = $_POST['travel_date'];
    $travelers = $_POST['travelers'];
    $travel_class = $_POST['travel_class'];
    $special_requests = $_POST['special_requests'];

    $stmt = $conn->prepare(
        "INSERT INTO registrations
        (fullname,email,phone,destination,travel_date,travelers,travel_class,special_requests)
        VALUES (?,?,?,?,?,?,?,?)"
    );

    $stmt->bind_param(
        "sssssiss",
        $fullname,
        $email,
        $phone,
        $destination,
        $travel_date,
        $travelers,
        $travel_class,
        $special_requests
    );

    if ($stmt->execute()) {
        echo "
        <h2>Registration Successful ✅</h2>
        <p>Data saved in database.</p>
        <a href='index.html'>Back Home</a>
        ";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

?>