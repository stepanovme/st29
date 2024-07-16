<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: auth.php');
    exit;
}

$user_id = $_SESSION['user_id'];

require_once('../db.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$feedbackId = $_GET['feedbackId'] ?? null;

$sql = "SELECT * FROM feedback WHERE feedbackId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $feedbackId);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $message = $row["message"];
    $date = $row["createdDate"];
    $status = $row["feedbackStatusId"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feedbackId = $_GET['feedbackId'];
    $sqlFeedback = "UPDATE feedback SET feedbackStatusId = ? WHERE feedbackId = ?";
    $stmt = $conn->prepare($sqlFeedback);
    $feedbackStatusId = 2;
    $stmt->bind_param('ii', $feedbackStatusId, $feedbackId);

    header('Content-Type: application/json');
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
    <link rel="stylesheet" href="../css/feedback-info.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Обратная связь от</title>
</head>
<body>
    <div class="content">
        <div class="nav">
            <p class="title">Админ-панель</p>
            <div class="tile" onClick="window.location.href = 'index.php'">
                <a>Настройки</a>
            </div>
            <div class="tile" onClick="window.location.href = 'services.php'">
                <a>Услуги</a>
            </div>
            <div class="tile active" onClick="window.location.href = 'feedback.php'">
                <a>Обратная связь</a>
            </div>
            <div class="tile" onClick="window.location.href = 'works.php'">
                <a>Работы</a>
            </div>
        </div>

        <div class="page-content">
            <div class="title">
                <h1>Обратная связь от</h1>
                <?php if($status == 1) {?>
                    <div class="status new">Новая</div>
                <?php } else { ?>
                    <div class="status processed">Обработано</div>
                <?php } ?>
            </div>
            <a href="feedback.php"><i class="fa-solid fa-chevron-left" style="color: #0F244F;"></i> вернутся назад</a>
            <form id="feedbackForm">
                <label>Имя: </label>
                <input type="text" value="<?php echo $name; ?>" readonly>
                <label>Почта: </label>
                <input type="text" value="<?php echo $email; ?>" readonly>
                <label>Телефон: </label>
                <input type="text" value="<?php echo $phone; ?>" readonly>
                <label>Дата: </label>
                <input type="text" value="<?php echo $date; ?>" readonly>
                <label>Комментарий: </label>
                <textarea type="text" readonly><?php echo $message; ?></textarea>
                <?php if($status == 1) {?>
                    <button type="submit" id="processButton">Обработано</button>
                <?php } ?>
                <button type="button" id="deleteButton">Удалить</button>
            </form>
        </div>
    </div>
    <div id="notification" class="notification"></div>

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

        document.getElementById('feedbackForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const feedbackId = <?php echo $feedbackId; ?>;

            fetch('feedback-info.php?feedbackId=' + feedbackId, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Статус обращения успешно изменён', true);
                    document.querySelector('.status').textContent = 'Обработано';
                    document.querySelector('.status').classList.remove('new');
                    document.querySelector('.status').classList.add('processed');
                    document.getElementById('processButton').style.display = 'none';
                } else {
                    showNotification('Ошибка изменения статуса обращения: ' + (data.message || 'Unknown error'), false);
                }
            })
            .catch(error => {
                showNotification('Ошибка изменения статуса обращения: ' + error, false);
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
            const feedbackId = <?php echo $feedbackId; ?>;
            
            fetch('feedback_delete.php?feedbackId=' + feedbackId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ deleteFeedback: true })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Услуга успешно удалена', true);
                    window.location.href = 'feedback.php';
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
