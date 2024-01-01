<?php

include 'connect.php';

if (isset($_POST['updateid'])) {
    $update = $_POST['updateid'];

    $sql = "SELECT * FROM crud WHERE id=$update";
    $result = mysqli_query($con, $sql);
    $response = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $response = $row;
    }
    echo json_encode($response);
} else {
    $response['status'] = 200;
    $response['message'] = "Invalid or data not found";
}

// update query
if (isset($_POST['hiddendata'])) {
    $userid = $_POST['hiddendata'];
    $name = $_POST['updatename'];
    $email = $_POST['updateemail'];
    $mobile = $_POST['updatemobile'];
    $place = $_POST['updateplace'];


    $sql = "UPDATE crud SET name='$name', email='$email', mobile='$mobile', place='$place' WHERE id=$userid";

    $result = mysqli_query($con, $sql);
}
