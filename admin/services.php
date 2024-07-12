<?php
require_once('../db.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql = "SELECT * FROM service ORDER BY sort_order";
$result = $conn->query($sql);

$services = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
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
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <title>Услуги</title>
</head>
<body>
    <div class="content">
        <div class="nav">
            <p class="title">Админ-панель</p>
            <div class="tile" onClick="window.location.href = 'index.php'">
                <a>Настройки</a>
            </div>
            <div class="tile active">
                <a>Услуги</a>
            </div>
        </div>
        <div class="page-content">
            <div class="title">
                <h1>Услуги</h1>
                <button id="addButton">Добавить</button>
            </div>
            <table id="servicesTable">
                <thead>
                    <tr>
                        <th>Номер</th>
                        <th>Название</th>
                    </tr>
                </thead>
                <tbody id="servicesList">
                    <?php foreach ($services as $service): ?>
                        <tr class="service-row" data-id="<?php echo $service['serviceId']; ?>" data-sort-order="<?php echo $service['sort_order']; ?>">
                            <td><?php echo $service['sort_order']; ?></td>
                            <td><?php echo $service['name']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const servicesList = document.getElementById('servicesList');

            new Sortable(servicesList, {
                animation: 150,
                onEnd: function (evt) {
                    let order = [];
                    servicesList.querySelectorAll('tr').forEach((row, index) => {
                        row.querySelector('td').innerText = index + 1; // Update the displayed order
                        order.push({
                            id: row.getAttribute('data-id'),
                            sort_order: index + 1
                        });
                    });

                    fetch('service_update.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ order: order })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            console.log('Order updated successfully');
                        } else {
                            console.error('Failed to update order: ', data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });

            // Add click event listeners to each service row
            servicesList.querySelectorAll('.service-row').forEach(row => {
                row.addEventListener('click', function() {
                    const serviceId = row.getAttribute('data-id');
                    window.location.href = `service-info.php?serviceId=${serviceId}`;
                });
            });

            document.getElementById('addButton').addEventListener('click', function() {
                fetch('service_add.php', {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = `service-info.php?serviceId=${data.serviceId}`;
                    } else {
                        console.error('Failed to add service: ', data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
</body>
</html>
