<?php
class UserData {
    private $fullName;
    private $phoneNo;
    private $locations;  
    private $userType;
    public function __construct() {
        if(isset($_COOKIE["EmailAddress"], $_COOKIE["FullName"], $_COOKIE["PhoneNumber"], $_COOKIE["Locations"], $_COOKIE["UserType"])) {
            $this->fullName = $_COOKIE["FullName"];
            $this->phoneNo = $_COOKIE["PhoneNumber"];
            $this->locations = $_COOKIE["Locations"];
            $this->userType = $_COOKIE["UserType"];
        } else {  
            header("Location: ../login.html");
            exit();
        }
    }
    
    public function getFullName() {
        return $this->fullName;
    }

    public function getPhoneNo() {
        return $this->phoneNo;
    }

    public function getLocations() {
        return $this->locations;
    }

    public function getUserType() {
        return $this->userType;
    }

    public function redirectToPage($page) {
        switch($page) {
            case "submit_query":
                header("Location: ../submit_query.html");
                exit();
            case "list_of_queries":
                header("Location: ../list_of_queries.html");
                exit();
            case "farming_service":
                header("Location: ../farming_service.html");
                exit();
            default:
                header("Location: ../default_page.html");
                exit();
        }
    }
}

// Usage:
try {
    $userData = new UserData();   
    if(isset($_GET["submit_query"]) && $_GET["submit_query"] == "true") {
        $userData->redirectToPage("submit_query");
    } elseif(isset($_GET["list_of_queries"]) && $_GET["list_of_queries"] == "true") {
        $userData->redirectToPage("list_of_queries");
    } elseif(isset($_GET["farming_service"]) && $_GET["farming_service"] == "true") {
        $userData->redirectToPage("farming_service");
    } else {
        $userData->redirectToPage("default");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
