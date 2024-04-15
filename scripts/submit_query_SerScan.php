<?php
require_once 'config.php';

class ServiceSelect{
    public function __construct() {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {    
        $location = $_GET['loc'];
        $userID = $_COOKIE['UserId'];        
        try {
            $conn = dbConfig::initDb();
            $sqlQuery = "SELECT DISTINCT sel_service FROM tbl_reg_service_list WHERE user_id=$userID AND location_name='$location'";
            $result = $conn->query($sqlQuery);
            $data = array();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $data[] = $row['sel_service'];
                }
            }
            $conn->close();
            header('Content-Type: application/json');
            echo json_encode($data);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['loc'])) {
    $serviceselect = new ServiceSelect();
}
?>
