<?php

include_once("../db_connect/connection.php");
$db = $con;
define('tableName', 'users');
$userData = $_POST;

registerUser($db, $userData);

function registerUser($db, $userData) {

    $fullName = $userData['full_name'];
    $email    = $userData['email'];
    $password = $userData['password'];
    $mobile   = $userData['mobile'];
    
    if (!empty($fullName) && !empty($email) && !empty($password) && !empty($mobile)) {

        $plainPassword = $password;

        
        $query = "INSERT INTO " . tableName . " (full_name, email, password, mobile) ";
        $query .= "VALUES ('$fullName', '$email', '$plainPassword', '$mobile')";

        
        $execute = $db->query($query);
        if ($execute) {
            echo "success";
        } else {
            echo "Error: " . $db->error;
        }
    } else {
        echo "All Fields are required";
    }
}
