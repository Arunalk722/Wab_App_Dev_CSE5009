<?php 
require_once 'config.php';

class LocationGet {
    public function __construct() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $conn = dbConfig::initDb();
                $sql = "SELECT location_name FROM tbl_location_list";
                $result = $conn->query($sql);
                $data = array();
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $data[] = $row;
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

class RegToFarming {
    public function __construct() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $conn = dbConfig::initDb();
                $fullName = $_POST['full-name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $service = $_POST['services'];
                $location = $_POST['locations'];
                $message = $_POST['message'];
                $userID = 0;
                $currentDateTime = date('Y-m-d H:i:s');
                

                $query = "SELECT idtbl_users FROM tbl_users WHERE email_address=?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($userID);
                    $stmt->fetch();
                    $stmt->close();
                    
                    $insertQuery = "INSERT INTO tbl_reg_service_list (user_id, location_name, sel_service, add_mg, reg_time) VALUES (?, ?, ?, ?, ?)";
                    $insertStmt = mysqli_prepare($conn, $insertQuery);
                    mysqli_stmt_bind_param($insertStmt, "sssss", $userID, $location, $service, $message, $currentDateTime);
            
                    if (mysqli_stmt_execute($insertStmt)) {
                        echo "success";                        
                    } else {
                        echo "Error: " . mysqli_error($conn);                        
                    }
                } else {
                    echo "User not found";
                }
                mysqli_close($conn);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    new RegToFarming();
} else {
    new LocationGet();
} 
?>
