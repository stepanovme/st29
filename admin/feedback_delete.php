<?php
require_once('../db.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$feedbackId = $_GET['feedbackId'] ?? null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['deleteFeedback']) && $feedbackId) {
        $sqlDelete = "DELETE FROM feedback WHERE feedbackId = ?";
        $stmt = $conn->prepare($sqlDelete);
        $stmt->bind_param('i', $feedbackId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database delete failed']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
    }
    exit;
}
?>
