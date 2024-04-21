<?php
require_once "config.php";

class UpdateQuerys {

    function __construct() { 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->updateQuery();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->getQuery();
        }
    }

    private function updateQuery() {
        try {
            $conn = dbConfig::initDb();
            $queryId = $_POST['query-id'];
            $solution = $_POST['solution'];
            
            $query = "UPDATE tbl_farmar_query SET officer_solution=?, office_time=NOW() WHERE idtbl_farmar_query=?";       
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $solution, $queryId); 
            
            $stmt->execute();
            $stmt->close();
            $response = array('success' => true);
            echo json_encode($response);

        } catch(Exception $ex) {
            echo json_encode(array('success' => false, 'message' => 'Error: ' . $ex->getMessage()));
        }
    }

    private function getQuery() {
        if (isset($_GET['query-id'])) {
            try {
                $conn = dbConfig::initDb();
                $queryId = $_GET['query-id'];
    
                $query = "SELECT u.full_name AS farmer_name, fq.farmer_query,fq.officer_solution as officer_solution FROM tbl_farmar_query fq JOIN tbl_users u ON fq.farmer_id = u.idtbl_users and idtbl_farmar_query= ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $queryId);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo json_encode($row);
                } else {
                    echo json_encode(array('error' => 'No data found for query ID: ' . $queryId));
                }
    
                $stmt->close();
            } catch(Exception $ex) {
                echo json_encode(array('error' => 'Error: ' . $ex->getMessage()));
            }
        } else {
            echo json_encode(array('error' => 'No query ID specified'));
        }
    }
    
}

$updateQuery = new UpdateQuerys();
?>
