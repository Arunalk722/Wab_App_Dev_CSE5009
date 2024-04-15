<?php
class dbConfig {
    public static function initDb() {
        $host = "localhost";
        $user = "sa";
        $password = "123Aruna@";
        $database = "doa_organic";
        $con = mysqli_connect($host, $user, $password, $database);
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $con;
    }
}
?>
