<?php 
session_start();
require("../includes/database_connect.php");


$email = $_POST['email'];
$password = $_POST['password'];
$password = sha1($password);


$sql = "SELECT * FROM users WHERE email='$email' AND password='password'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    $response = array("success" => false, "message" => "Something went wrong!");
    echo json_encode($response);
    return;
}

$row_count = mysqli_num_rows($result);
if ($row_count != 0) {
    $response = array("success" => false, "message" => "This email id is already registered with us!");
    echo json_encode($response);
    return;
}


$sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
//$sql = "INSERT INTO users (email, password, full_name, phone, gender, college_name) VALUES ('$email', '$password', '$full_name', '$phone', '$gender', '$college_name')";
$result = mysqli_query($conn, $sql);
if (!$result) {
    $response = array("success" => false, "message" => "Something went wrong!");
    echo json_encode($response);
    return;
}

$response = array("success" => true, "message" => "You are logged in  successfully!");
echo json_encode($response);
mysqli_close($conn);



?>

Click <a href="../index.php">here</a> to continue.
<?php
mysqli_close($conn);
