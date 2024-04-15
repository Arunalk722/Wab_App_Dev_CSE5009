<?php
require_once 'config.php';

class LoginUser {
    private $conn;

    public function __construct() {
        $this->conn = dbConfig::initDb();
    }

    public function _authUser() {
        try {
            $enteredUsername = $_POST["email_address"];
            $enteredPassword = $_POST["pass"];
            $sql = "SELECT * FROM tbl_users WHERE email_address = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $enteredUsername);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if (password_verify($enteredPassword, $row["pwd"])) {           
                    $userData = serialize($row);
                    setcookie("user_data", $userData, time() + (86400 * 1), "/");
                    echo "<script>window.location.href = '../index.html';</script>";
                    exit();
                } else {
                    echo "<script>alert('Invalid username or password. Please try again.');</script>";
                    echo "<script>window.location.href = '../login.html';</script>";
                    exit();
                }
            } else {
                echo "<script>alert('User does not exist.');</script>";
                echo "<script>window.location.href = '../login.html';</script>";
                exit();
            } 
            $stmt->close();        
        } catch (Exception $e) {          
            echo "Error: " . $e->getMessage();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginUser = new LoginUser();
    $loginUser->_authUser();
} else {
  
}
?>