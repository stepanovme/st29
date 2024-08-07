<?php
require_once('db.php');

$sql = "SELECT * FROM setting";
$result = $conn -> query($sql);

if($result -> num_rows > 0){
    while($row = $result -> fetch_assoc()){
        $companyName = $row['nameCompany'];
        $phone = $row['phone'];
        $email = $row['email'];
        $address = $row['address'];

        $phoneFormated = str_replace([' ', '(', ')', '-'], '', $phone);
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/services-landing.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <title>Все услуги</title>
</head>
<body>
    
    <header>
        <div class="content">
            <div class="logo" onclick="window.location.href = 'index.php'">
                <?php echo $companyName; ?>
            </div>
            <div class="nav">
                <a id="callCompany" href="index.php">О КОМПАНИИ</a>
                <a id="callServices" href="index.php">НАШИ УСЛУГИ</a>
                <a id="callWorks" href="index.php">НАШИ РАБОТЫ</a>
                <a id="callContacts" href="index.php">КОНТАКТЫ</a>
            </div>
            <div class="buttons">
                <a href="tel:<?php echo $phoneFormated; ?>"><?php echo $phone; ?></a>
                <button type="button" id="callMe">ЗАКАЗАТЬ ЗВОНОК</button>
            </div>
        </div>
    </header>

    <section>
        <div class="content">
            <div class="tree">
                <a href="index.php">Главная</a> > <p>Все услуги</p>
            </div>

            <?php 
            $sql = "SELECT * FROM service ORDER BY sort_order";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                echo '<div class="list-services">';
                while ($row = $result->fetch_assoc()) {             
                    echo ' 
                        <div class="card" onclick="window.location.href=\'service-info.php?serviceId=' . $row['serviceId'] . '\'">
                            <p class="title">'.$row['name'].' <i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i></p>
                        </div>
                    ';
                }
                echo '</div>';
            }
            ?>
        </div>
    </section>

    <footer>
        <div class="content">
            <p>© 2020 <?php echo $companyName;?></p>
            <div class="other">
                <div class="nav">
                    <p class="title">НАВИГАЦИЯ</p>
                    <a id="footerCompany">О компании</a>
                    <a id="footerServices">Наши услуги</a>
                    <a id="footerWorks">Наши работы</a>
                    <a id="footerContacts">Контакты</a>
                </div>
                <div class="contacts">
                    <p class="title">КОНТАКТЫ</p>
                    <p>Номер телефона: <?php echo $phone;?></p>
                    <p>Эл. почта: <?php echo $email;?></p>
                    <p>Адрес: <?php echo $address;?></p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>