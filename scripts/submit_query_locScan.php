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
?>
