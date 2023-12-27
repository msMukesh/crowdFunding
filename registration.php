<?php
// Establish connection to MySQL
$host = "localhost";
$username = "root";
$password = "semEIGHT*8";
$database = "crowdfunding_db"; // Change to your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Hash the password for security

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $email, $password);

   // Check if the statement is prepared successfully
   if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters and execute
$stmt->bind_param("sss", $fullname, $email, $password);
$result = $stmt->execute();

// Check if execution is successful
if ($result === false) {
    die("Error executing statement: " . $stmt->error);
} else {
    echo "Registration successful!";
}

    $stmt->close();
}

$conn->close();
?>
