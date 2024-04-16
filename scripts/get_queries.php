<?php
require_once 'config.php';

try {
    $conn = dbConfig::initDb();
    $sqlQuery = "SELECT us.full_name, us.email_address, us.phone_no, us.farmer_address, fq.location, fq.services, fq.farmer_query,fq.log_time,fq.idtbl_farmar_query  FROM tbl_users AS us JOIN tbl_farmar_query AS fq ON us.idtbl_users = fq.farmer_id ";
    $result = $conn->query($sqlQuery);
    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($data);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
