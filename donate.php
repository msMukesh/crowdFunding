<?php
// Replace these variables with your actual database information
$host = "localhost";
$username = "root";
$password = "semEIGHT*8";
$database = "crowdfunding_db";

// Create a connection to the MySQL database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Initialize variables outside the conditional block
$imagePath = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $conn->real_escape_string($_POST["name"]);
    $phoneNumber = $conn->real_escape_string($_POST["phonenum"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $amount = $conn->real_escape_string($_POST["amount"]);

    if (isset($_FILES["image"]) ) {
        // Your code to handle file uploads here
        
    // Handle file uploads (image and resume)
    $imagePath = "uploads/" . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);

    }

    // Insert data into the database
    $sql = "INSERT INTO payment_details (name,  phone_number, email,amount,image_path)
            VALUES ('$name','$phoneNumber', '$email', '$amount', '$imagePath')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
