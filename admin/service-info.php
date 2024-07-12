<?php
require_once('../db.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$serviceId = $_GET['serviceId'] ?? null;

if ($serviceId) {
    $sql = "SELECT * FROM service WHERE serviceId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $serviceId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $service = $result->fetch_assoc();
    } else {
        die("Service not found");
    }
} else {
    die("Invalid service ID");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['serviceName'], $_POST['serviceDescription'])) {
    $serviceName = $_POST['serviceName'];
    $serviceDescription = $_POST['serviceDescription'];

    $sqlService = "UPDATE service SET name = ?, description = ? WHERE serviceId = ?";
    $stmt = $conn->prepare($sqlService);
    $stmt->bind_param('ssi', $serviceName, $serviceDescription, $serviceId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database update failed']);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/service-info.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Информация об услуге</title>
</head>
<body>
    <div class="content">
        <div class="nav">
            <p class="title">Админ-панель</p>
            <div class="tile" onClick="window.location.href = 'index.php'">
                <a>Настройки</a>
            </div>
            <div class="tile active" onClick="window.location.href = 'services.php'">
                <a>Услуги</a>
            </div>
        </div>
        <div class="page-content">
            <h1>Информация об услуге <?php echo htmlspecialchars($service['name']); ?></h1>
            <a href="services.php"><i class="fa-solid fa-chevron-left" style="color: #0F244F;"></i> вернутся назад</a>
            <form id="serviceForm">
                <label>Название: </label>
                <input type="text" name="serviceName" id="serviceName" value="<?php echo htmlspecialchars($service['name']); ?>">
                <label>Описание: </label>
                <textarea type="text" name="serviceDescription" id="serviceDescription"><?php echo htmlspecialchars($service['description']); ?></textarea>
                <button type="submit">Сохранить</button>
                <button type="button" id="deleteButton">Удалить</button>
            </form>
        </div>
    </div>
    <div id="notification" class="notification"></div>

    <!-- The Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <p>Вы уверены, что хотите удалить эту услугу?</p>
            <button id="confirmDelete">Да</button>
            <button id="cancelDelete">Нет</button>
        </div>
    </div>

    <script>
        function showNotification(message, isSuccess) {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.style.backgroundColor = isSuccess ? 'white' : 'white';
            notification.style.color = isSuccess ? '#5595FF' : '#5595FF';
            notification.classList.add('show');
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        document.getElementById('serviceForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const serviceId = <?php echo $serviceId; ?>;

            fetch('service-info.php?serviceId=' + serviceId, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Данные успешно сохранены', true);
                } else {
                    showNotification('Ошибка сохранения данных: ' + (data.message || 'Unknown error'), false);
                }
            })
            .catch(error => {
                showNotification('Ошибка сохранения данных: ' + error, false);
            });
        });

        const deleteButton = document.getElementById('deleteButton');
        const deleteModal = document.getElementById('deleteModal');
        const confirmDelete = document.getElementById('confirmDelete');
        const cancelDelete = document.getElementById('cancelDelete');

        deleteButton.addEventListener('click', function() {
            deleteModal.style.display = 'block';
        });

        cancelDelete.addEventListener('click', function() {
            deleteModal.style.display = 'none';
        });

        confirmDelete.addEventListener('click', function() {
            const serviceId = <?php echo $serviceId; ?>;
            
            fetch('service_delete.php?serviceId=' + serviceId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ deleteService: true })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Услуга успешно удалена', true);
                    window.location.href = 'services.php';
                } else {
                    showNotification('Ошибка удаления услуги: ' + (data.message || 'Unknown error'), false);
                }
            })
            .catch(error => {
                showNotification('Ошибка удаления услуги: ' + error, false);
            });
        });
    </script>
</body>
</html>
