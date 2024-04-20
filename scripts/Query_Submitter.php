<?php
require_once 'config.php';
class QuerySubmitter {
    function __construct() {
        try {

            $conn = dbConfig::initDb();           
            $locations = $_POST['locations'];
            $service = $_POST['services'];            
            $message = $_POST['message'];
            $sql = "INSERT INTO tbl_farmar_query (farmer_id, locations, services, farmer_query, log_time) VALUES (?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $farmer_id =$_COOKIE['UserId'];
            $stmt->bind_param("isss", $farmer_id, $locations, $service, $message); 
            $stmt->execute();
            $stmt->close();
            $response = array(true);
            echo json_encode($response);
        } catch (Exception $e) { 
            echo "Error: " . $e->getMessage();
        }
    }
}

    $submitQuery = new QuerySubmitter();

?>