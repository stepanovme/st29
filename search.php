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
    <link rel="stylesheet" href="css/service-info-landing.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <title>Все услуги</title>
</head>
<body>
    
    <header>
        <div class="content">
            <div class="logo">
                <?php echo $companyName; ?>
            </div>
            <div class="nav">
                <a id="callCompany">О КОМПАНИИ</a>
                <a id="callServices">НАШИ УСЛУГИ</a>
                <a id="callWorks">НАШИ РАБОТЫ</a>
                <a id="callContacts">КОНТАКТЫ</a>
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
                <a href="index.php">Главная</a> > <a href="services.php">Все услуги</a> > <p>Фасадные работы</p>
            </div>

            <div class="service-content">
                <img src="/assets/images/work.jpg" alt="">
                <div class="text">
                    <h1>Фасадные работы</h1>
                    <p class="descr">
                    Фасадные работы: монтаж фасадов НВФ
                    Комплекс работ по монтажу навесного вентилируемого фасада с теплоизоляционным слоем, включая монтаж оконных и дверных откосов, водоотливов, примыканий и углов. Комплекс работ по монтажу навесного вентилируемого фасада с теплоизоляционным слоем, включая монтаж оконных и дверных откосов, водоотливов, примыканий и углов.
                    <br><br>
                    Комплекс работ по монтажу навесного вентилируемого фасада с теплоизоляционным слоем, включая монтаж оконных и дверных откосов, водоотливов, примыканий и углов. Комплекс работ по монтажу навесного вентилируемого фасада с теплоизоляционным слоем, включая монтаж оконных и дверных откосов, водоотливов, примыканий и углов.
                    <br><br>
                    Комплекс работ по монтажу навесного вентилируемого фасада с теплоизоляционным слоем, включая монтаж оконных и дверных откосов, водоотливов, примыканий и углов.
                    </p>
                </div>
            </div>

            <div class="our-works">
                <p class="title">Наши работы с этой услугой</p>
                <div class="works">
                    <div class="work"></div>
                    <div class="work"></div>
                    <div class="work"></div>
                    <div class="work"></div>
                </div>
            </div>
            
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