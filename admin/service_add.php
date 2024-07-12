<?php
require_once('../db.php');

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Fetch the current maximum sort_order
        $sqlMaxSortOrder = "SELECT COALESCE(MAX(sort_order), 0) + 1 AS max_sort_order FROM service";
        $resultMaxSortOrder = $conn->query($sqlMaxSortOrder);

        if ($resultMaxSortOrder && $resultMaxSortOrder->num_rows > 0) {
            $rowMaxSortOrder = $resultMaxSortOrder->fetch_assoc();
            $maxSortOrder = $rowMaxSortOrder['max_sort_order'];
        } else {
            throw new Exception('Failed to fetch maximum sort order');
        }

        // Insert new service
        $sqlInsert = "INSERT INTO service (name, description, sort_order) VALUES ('Новая услуга', '', ?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param('i', $maxSortOrder);

        if ($stmtInsert->execute()) {
            $newServiceId = $stmtInsert->insert_id;
            echo json_encode(['success' => true, 'serviceId' => $newServiceId]);
        } else {
            throw new Exception('Ошибка добавления услуги: ' . $stmtInsert->error);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Неверный метод запроса']);
}
?>
