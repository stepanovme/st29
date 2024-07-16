<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: auth.php');
    exit;
}

$user_id = $_SESSION['user_id'];

require_once('../db.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Function to log debug messages
function debug_log($message) {
    error_log($message);
}

// Handle POST request to update service order
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postData = file_get_contents('php://input');
    debug_log("Received POST data: " . $postData);
    $data = json_decode($postData, true);

    if (isset($data['order']) && is_array($data['order'])) {
        $conn->begin_transaction();

        try {
            foreach ($data['order'] as $item) {
                $serviceId = (int)$item['id'];
                $sortOrder = (int)$item['sort_order'];
                $sqlUpdate = "UPDATE service SET sort_order = $sortOrder WHERE serviceId = $serviceId";
                if (!$conn->query($sqlUpdate)) {
                    throw new Exception('Database update failed');
                }
            }
            $conn->commit();
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            $conn->rollback();
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid order data']);
    }
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
