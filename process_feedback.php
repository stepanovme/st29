<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO feedback (name, email, phone, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $phone, $comment);

    if ($stmt->execute()) {
        echo 'Success';
    } else {
        http_response_code(500);
        echo 'Error';
    }

    $stmt->close();
    $conn->close();
}
?>
