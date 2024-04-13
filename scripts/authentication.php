<?php
// Include the database connection file
require_once "config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the entered username and password from the form
    $enteredUsername = $_POST["email_address"];
    $enteredPassword = $_POST["pass"];

    // Prepare a SQL statement to select the user from the database
    $sql = "SELECT * FROM tbl_users WHERE email_address = ?";
    
    // Prepare and bind parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $enteredUsername);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if the user exists in the database
    if ($result->num_rows == 1) {
        // Fetch the row
        $row = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($enteredPassword, $row["pwd"])) {
            // Store the username in a cookie with a 1-day expiry
            setcookie("username", $enteredUsername, time() + (86400 * 1), "/"); // 86400 = 1 day
            
            // Redirect the user to the dashboard or any other page
            echo "<script>window.location.href = '../index.html';</script>"; // Redirect back to login screen
            exit();
        } else {
            // If the password is incorrect, display an error message
            echo "<script>alert('Invalid username or password. Please try again.');</script>";
            echo "<script>window.location.href = '../login.html';</script>"; // Redirect back to login screen
            exit();
        }
    } else {
        // If the user does not exist, display an error message
        echo "<script>alert('User does not exist.');</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$con->close();
?>
