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

$sql = "SELECT work.workId AS workId, work.name AS workName, work.createDate AS workCreateDate, work.finishDate AS workFinishDate,
               GROUP_CONCAT(service.name ORDER BY service.name SEPARATOR ', ') AS serviceNames
        FROM work
        INNER JOIN workSevice ON workSevice.workId = work.workId
        INNER JOIN service ON service.serviceId = workSevice.ServiceId
        GROUP BY work.workId";

$result = $conn->query($sql);

$numWork = 1;

$work = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $work[] = $row;
    }
}

$sqlService = "SELECT * FROM service";
$resultService = $conn->query($sqlService);

$service = [];
if ($resultService->num_rows > 0) {
    while ($row = $resultService->fetch_assoc()) {
        $service[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/services.css">
    <link rel="stylesheet" href="../css/feedback.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Список работ</title>
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
            <div class="tile" onClick="window.location.href = 'feedback.php'">
                <a>Обратная связь</a>
            </div>
            <div class="tile active">
                <a>Работы</a>
            </div>
        </div>
        <div class="page-content">
            <div class="title">
                <h1>Список работ</h1>
                <button id="addButton">Добавить</button>
            </div>

            <div class="search">
                <input type="text" name="searchInput" id="searchInput" placeholder="Введите название">
                <input type="date" name="dateInput" id="dateInput">
                <select name="serviceInput" id="serviceInput">
                    <option value="all" selected>Услуги</option>
                    <?php foreach ($service as $item): ?>
                        <option value="<?php echo $item['name']; ?>"><?php echo $item['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <table id="feedbackTable">
                <thead>
                    <tr>
                        <th>Номер</th>
                        <th>Название</th>
                        <th>Услуги</th>
                        <th>Дата создания</th>
                    </tr>
                </thead>
                <tbody id="feedbackList">
                    <?php foreach ($work as $item): ?>
                        <tr class="feedback-row clickable-row" data-id="<?php echo $item['workId']; ?>" data-services="<?php echo $item['serviceNames']; ?>" data-date="<?php echo date("Y-m-d", strtotime($item['workCreateDate'])); ?>">
                            <td><?php echo $numWork++; ?></td>
                            <td><?php echo $item['workName']; ?></td>
                            <td><?php echo $item['serviceNames']; ?></td>
                            <td><?php echo date("d.m.Y", strtotime($item['workCreateDate'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#feedbackList tr').filter(function() {
                    $(this).toggle($(this).find('td:eq(1)').text().toLowerCase().indexOf(value) > -1)
                });
            });

            $('#serviceInput').on('change', function() {
                var value = $(this).val().toLowerCase();
                if (value === 'all') {
                    $('#feedbackList tr').show();
                } else {
                    $('#feedbackList tr').filter(function() {
                        $(this).toggle($(this).data('services').toLowerCase().indexOf(value) > -1)
                    });
                }
            });

            $('#dateInput').on('change', function() {
                var value = $(this).val();
                $('#feedbackList tr').filter(function() {
                    $(this).toggle($(this).data('date') === value)
                });
            });

            $('.clickable-row').click(function() {
                var workId = $(this).data('id');

                window.location.href = 'works-info.php?workId=' + workId;
            });
        });

        
    </script>
</body>
</html>
