<?php

include_once("../db_connect/connection.php");
$db = $con;

define('tableName', 'users');
$userData = $_POST;

loginUser($db, $userData);

function loginUser($db, $userData) {

    $email  = $userData['email'];
    $password  = $userData['password'];

    if(!empty($email) && !empty($password)){

        $query = "SELECT id,full_name, email, password FROM ".'users';
        $query .= " WHERE email = '$email' AND password = '$password'";
        $query=mysqli_query($db,$query);
        $result = mysqli_fetch_array($query);
        $num_rows=mysqli_num_rows($query);
        if($num_rows > 0) {
           session_start();
           $_SESSION['id'] = $result['id'];
           $_SESSION['email'] = $result['email'];
           $_SESSION['full_name'] = $result['full_name'];
           echo "success";
        } else {
            echo "Wrong email and password";
        }
   } else {
      echo "All Fields are required";
   }
   exit;
}

?>