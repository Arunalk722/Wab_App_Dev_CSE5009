<?php
// Include the database connection file
require_once 'config.php';

// Function to get locations from the database
function getLocations($con) {
    $locations = array();

    $query = "SELECT location_name FROM tbl_location_list";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $locations[] = $row['location_name'];
    }

    return $locations;
}

// Form validation
$fullName = $_POST['full-name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm-password'];
$selectedLocation = $_POST['locations'];

if (empty($fullName) || empty($email) || empty($phone) || empty($address) || empty($password) || empty($confirmPassword) || empty($selectedLocation)) {
    die("All fields are required.");
}

if ($password !== $confirmPassword) {
    die("Passwords do not match.");
}

// Check if email already exists
$query = "SELECT * FROM tbl_users WHERE email_address = ?";
$stmt = mysqli_prepare($con, $query);
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
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "ssssss", $fullName, $email, $phone, $address, $hashedPassword, $selectedLocation);

// Execute the statement
if (mysqli_stmt_execute($stmt)) {
    // Return success message along with the locations
    $locations = getLocations($con);
    $response = array(
        'status' => 'success',
        'locations' => $locations
    );
    die(json_encode($response));
} else {
    die("Error: " . mysqli_error($con)); // Return error message
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($con);
?>
