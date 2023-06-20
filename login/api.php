<?php
header("Content-Type:application/json");
if (isset($_POST['username']) && $_POST['password'] != "") {
    include('dbcon.php');
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query(
        $con,
        // "SELECT * FROM `user` WHERE username='$username' AND password='$password'" //yx
        "SELECT * FROM `users` WHERE username='$username' AND password='$password'" //kq
    );
    if (mysqli_num_rows($result) > 0) {
        response($username, 200, "Login successful");
        mysqli_close($con);
    } else {
        response($username, 401, "Invalid Username or Password");
    }
} else {
    response(null, 400, "Please enter username and password");
}


function response($username, $code, $message)
{
    // Set the response header and status code
    http_response_code($code);

    // Construct the response array
    $response = array(
        'username' => $username,
        'code' => $code,
        'message' => $message
    );

    // Convert the response array to JSON
    $json_response = json_encode($response);

    // Set the Content-Type header to JSON
    header('Content-Type: application/json');

    // Echo the JSON response
    echo $json_response;
}

//curl -X POST -d "username=user&password=password" http://localhost/REST_API/login/api.php
