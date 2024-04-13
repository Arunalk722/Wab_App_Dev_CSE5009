<?php
// Check if the username cookie is set and not empty
if(isset($_COOKIE["username"]) && !empty($_COOKIE["username"])) {
    // Check if a query parameter is present and its value matches a specific condition
    if(isset($_GET["submit_query"]) && $_GET["submit_query"] == "true") {
        // Redirect to the submit_query.html page if the conditions are met
        header("Location: ../submit_query.html");
        exit();
    } elseif(isset($_GET["list_of_querys"]) && $_GET["list_of_querys"] == "true") {
        // Redirect to the admin panel page if the conditions are met
        header("Location: ../list_of_querys.html");
        exit();
    } elseif(isset($_GET["farming_service"]) && $_GET["farming_service"] == "true") {
        // Redirect to another example page if the conditions are met
        header("Location: ../farming_service.html");
        exit();
    } else {
        // Redirect to a default page if none of the conditions are met
        header("Location: ../default_page.html");
        exit();
    }
} else {  
    // Redirect to the login page if the username cookie is not set or empty
    header("Location: ../login.html");
    exit();
}
?>
