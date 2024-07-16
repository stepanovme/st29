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

$workId = $_GET['workId'] ?? null;

if ($workId) {
    $sql = "SELECT * FROM work WHERE workId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $workId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $work = $result->fetch_assoc();
    } else {
        die("Service not found");
    }
} else {
    die("Invalid service ID");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['workName'], $_POST['workDescription'])) {
    $workName = $_POST['workName'];
    $workDescription = $_POST['workDescription'];

    $sqlService = "UPDATE service SET name = ?, description = ? WHERE serviceId = ?";
    $stmt = $conn->prepare($sqlService);
    $stmt->bind_param('ssi', $workName, $workDescription, $serviceId);

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
    <title>Информация об работе</title>
</head>
<body>
    <div class="content">
        <div class="nav">
            <p class="title">Админ-панель</p>
            <div class="tile" onClick="window.location.href = 'index.php'">
                <a>Настройки</a>
            </div>
            <div class="tile " onClick="window.location.href = 'services.php'">
                <a>Услуги</a>
            </div>
            <div class="tile" onClick="window.location.href = 'feedback.php'">
                <a>Обратная связь</a>
            </div>
            <div class="tile active" onClick="window.location.href = 'works.php'">
                <a>Работы</a>
            </div>
        </div>
        <div class="page-content">
            <h1>Информация об работе <?php echo htmlspecialchars($work['name']); ?></h1>
            <a href="works.php"><i class="fa-solid fa-chevron-left" style="color: #0F244F;"></i> вернутся назад</a>
            <form id="workForm">
                <label>Название: </label>
                <input type="text" name="workName" id="workName" value="<?php echo htmlspecialchars($work['name']); ?>">
                <label>Фотографии: </label>
                <input type="file" name="" id="">
                <label>Оказанные услуги: </label>
                <select name="" id="" require>
                    <option value="" selected disabled>Услуги</option>
                </select>
                <label>Описание: </label>
                <textarea type="text" name="workDescription" id="workDescription"><?php echo $work['description']; ?></textarea>
                <button type="submit">Сохранить</button>
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
        
    </script>
</body>
</html>
