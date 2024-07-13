<?php
require_once('../db.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);

$numFeedback = 1;

$feedback = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $feedback[] = $row;
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
    <title>Обратная связь</title>
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
            <div class="tile active">
                <a>Обратная связь</a>
            </div>
        </div>
        <div class="page-content">
            <div class="title">
                <h1>Обратная связь</h1>
            </div>

            <div class="search">
                <input type="text" name="searchInput" id="searchInput" placeholder="Введите имя, почту или номер телефона">
                <input type="date" name="dateInput" id="dateInput">
                <select name="statusInput" id="statusInput">
                    <option value="" disabled>Статус</option>
                    <option value="all">Все</option>
                    <option value="1" selected>Новая</option>
                    <option value="2">Отработано</option>
                </select>
            </div>

            <table id="feedbackTable">
                <thead>
                    <tr>
                        <th>Номер</th>
                        <th>Имя</th>
                        <th>Почта</th>
                        <th>Телефон</th>
                        <th>Дата</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody id="feedbackList">
                    <?php foreach ($feedback as $item): ?>
                        <tr class="feedback-row" data-id="<?php echo $item['feedbackId']; ?>">
                            <td><?php echo $numFeedback++; ?></td>
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo $item['email']; ?></td>
                            <td><?php echo $item['phone']; ?></td>
                            <td><?php echo date("d.m.Y", strtotime($item['createdDate'])); ?></td>
                            <td>
                                <?php if ($item['feedbackStatusId'] == 1) { ?>
                                    <div class="status new">Новая</div>
                                <?php } else { ?>
                                    <div class="status processed">Обработано</div>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#searchInput, #dateInput, #statusInput').on('input change', function() {
                let searchValue = $('#searchInput').val().toLowerCase();
                let dateValue = $('#dateInput').val();
                let statusValue = $('#statusInput').val();

                $('#servicesList tr').each(function() {
                    let name = $(this).find('td').eq(1).text().toLowerCase();
                    let email = $(this).find('td').eq(2).text().toLowerCase();
                    let phone = $(this).find('td').eq(3).text().replace(/\D/g, '');
                    let date = $(this).find('td').eq(4).text();
                    let status = $(this).find('.status').hasClass('new') ? '1' : '2';

                    let normalizedPhone = phone.replace(/^7/, '').replace(/^8/, '');
                    let normalizedSearchPhone = searchValue.replace(/\D/g, '').replace(/^7/, '').replace(/^8/, '');

                    let matchesSearch = (
                        name.includes(searchValue) || 
                        email.includes(searchValue) || 
                        (normalizedPhone.includes(normalizedSearchPhone) && normalizedSearchPhone !== "")
                    );

                    let formattedDate = date.split('.').reverse().join('-');
                    let matchesDate = (dateValue === "" || formattedDate === dateValue);

                    let matchesStatus = (statusValue === "all" || statusValue === "" || status === statusValue);

                    if (matchesSearch && matchesDate && matchesStatus) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            $('#statusInput').trigger('change');
        });

        const feedbackList = document.getElementById("feedbackList");

        feedbackList.querySelectorAll('.feedback-row').forEach(row => {
                row.addEventListener('click', function() {
                    const feedbackId = row.getAttribute('data-id');
                    window.location.href = `feedback-info.php?feedbackId=${feedbackId}`;
                });
            });
    </script>




</body>
</html>
