<?php
require_once 'config.php';

class RegisterUser {
    public function __construct() {
        try {
            // Initialize the database connection
            $conn = dbConfig::initDb();

            // Form validation
            $fullName = $_POST['full-name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm-password'];
            $locations = $_POST['locations'];

            if (empty($fullName) || empty($email) || empty($phone) || empty($address) || empty($password) || empty($confirmPassword) || empty($locations)) {
                die("All fields are required.");
            }

            if ($password !== $confirmPassword) {
                die("Passwords do not match.");
            }

            // Check if email already exists
            $query = "SELECT * FROM tbl_users WHERE email_address = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) > 0) {
                die("Email already exists.");
            }
            mysqli_stmt_close($stmt);

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and bind the insert statement
            $query = "INSERT INTO tbl_users (full_name, email_address, phone_no, farmer_address, pwd, locations) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssssss", $fullName, $email, $phone, $address, $hashedPassword, $locations);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo "success"; // Return success message
            } else {
                echo "Error: " . mysqli_error($conn); // Return error message
            }

            // Close the statement and connection
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        } catch (Exception $e) {
            // Handle any exceptions that may occur during database operations
            echo "Error: " . $e->getMessage();
        }
    }
}

class GetLocations {
    public function __construct() {
        try {
            // Initialize the database connection
            $conn = dbConfig::initDb();

            // Query to retrieve data from the database
            $sql = "SELECT location_name FROM tbl_location_list";
            $result = $conn->query($sql);

            // Fetch data and store it in an array
            $data = array();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }

            // Close the database connection
            $conn->close();

            // Return data in JSON format
            header('Content-Type: application/json');
            echo json_encode($data);
        } catch (Exception $e) {
            // Handle any exceptions that may occur during database operations
            echo "Error: " . $e->getMessage();
        }
    }
}

// Check if the register form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    new RegisterUser();
} else {
    new GetLocations();
}
?>
