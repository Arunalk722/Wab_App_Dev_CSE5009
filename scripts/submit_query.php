<?php
require_once 'config.php';

class ListOfRegLocation {
 
    function __construct() {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $userID = $_COOKIE['UserId'];
                $conn = dbConfig::initDb();
                $sqlQuery = "SELECT DISTINCT location_name FROM tbl_reg_service_list where user_id=$userID";
                $result = $conn->query($sqlQuery);
                $data = array();
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $data[] = $row['location_name'];
                    }
                }
                $conn->close();
                header('Content-Type: application/json');
                echo json_encode($data);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage(); 
        }
    }
}

$ListOfRegLocation = new ListOfRegLocation();

class SubmitQuery {
    function __construct() {
        try {
            $conn = dbConfig::initDb(); // Establish database connection

            // Retrieve form data
            $location = $_POST['locations'];
            $service = $_POST['services'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            // Insert data into database
            $sql = "INSERT INTO tbl_farmar_query (farmer_id, location, service, query, log_time) VALUES (?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $farmer_id = 2;
            $stmt->bind_param("isss", $farmer_id, $location, $service, $message); 
            $stmt->execute();
            $stmt->close();

            // Return response (if needed)
            $response = array("success" => true);
            echo json_encode($response);
        } catch (Exception $e) { 
            echo "Error: " . $e->getMessage();
        }
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $submitQuery = new SubmitQuery();
}
?>
