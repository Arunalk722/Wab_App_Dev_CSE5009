<?php
require_once 'config.php';
class SubmitQuery {
    function __construct() {
        try {
            $conn = dbConfig::initDb(); 
            $location = $_POST['locations'];
            $service = $_POST['services'];            
            $message = $_POST['message'];
            $sql = "INSERT INTO tbl_farmar_query (farmer_id, location, service, query, log_time) VALUES (?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $farmer_id =$_COOKIE['UserId'];
            $stmt->bind_param("isss", $farmer_id, $location, $service, $message); 
            $stmt->execute();
            $stmt->close();
            $response = array("success" => true);
            echo json_encode($response);
        } catch (Exception $e) { 
            echo "Error: " . $e->getMessage();
        }
    }
}
$submitQuery = new SubmitQuery();
?>
