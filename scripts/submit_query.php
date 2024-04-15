<?php
require_once 'config.php';

class ListRegService{
 
    function __construct(){
        try{
            
            if($_SERVER['REQUEST_METHOD']=='GET'){
                $conn = dbConfig::initDb();
                $userID=$_COOKIE['UserId']; // Make sure this cookie is correctly set
                $sqlQuery = "SELECT location_name FROM tbl_reg_service_list where user_id=$userID";
                $result = $conn->query($sqlQuery);
                $data=array();
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }
                }         
                $conn->close();
                header('Content-Type: application/json');
                echo json_encode($data);
            }
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage(); 
        }
    }
}

// Create an instance of the class to trigger the constructor
$listRegService = new ListRegService();
?>
