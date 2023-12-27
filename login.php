<?php
// Your database connection credentials
$host = "localhost";
$username = "root";
$password = "semEIGHT*8";
$database = "regdabase";

// Create a connection to the MySQL database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize inputs (optional, but recommended to prevent SQL injection)
    $email = $conn->real_escape_string($email);
    // $password = $conn->real_escape_string($password); // In case you hash passwords before storing

  // Check user credentials against the database
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row['password']; // Assuming 'password' is the column name for hashed passwords

    // Verify the password
    if (password_verify($password, $hashedPassword)) {
        // Login successful
        echo "Login successful!";
        // Redirect to a dashboard or any other page upon successful login
        header("Location: index.html");
        exit(); // Make sure to exit after setting the header to prevent further execution
    } else {
        // Incorrect password
        echo "Invalid email or password";
    }
} else {
    // User with given email not found
    echo "Invalid email or password";
}

}

// Close the database connection
$conn->close();
?>
