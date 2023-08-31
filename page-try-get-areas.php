<?php

require_once('dbconnect.php');

// reading json file
$json = file_get_contents('userdata.json');

//converting json object to php associative array
$data = json_decode($json, true);

// processing the array of objects
foreach ($data as $user) {
    $firstname = $user['firstname'];
    $lastname = $user['lastname'];
    $gender = $user['firstname'];
    $username = $user['username'];

    // preparing statement for insert query
    $st = mysqli_prepare($connection, 'INSERT INTO users(firstname, lastname, gender, username) VALUES (?, ?, ?, ?)');

    // bind variables to insert query params
    mysqli_stmt_bind_param($st, 'ssss', $firstname, $lastname, $gender, $username);

    // executing insert query
    mysqli_stmt_execute($st);
}

?>