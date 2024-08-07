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
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <title><?php echo $companyName;?></title>
</head>
<body>
        
    <section class="promo">
        <video autoplay loop muted playsinline id="promoVideo">
            <source src="../assets/videos/promo.mp4" type="video/mp4">
        </video>
        <div class="overlay"></div>
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

        <div class="text">
            <div class="content">
                <h1>СТРОИТЕЛЬСТВО И<br> ПРОЕКТИРОВАНИЕ</h1>
                <p>Специалезируемся на фасадных<br> и кровельных работах</p>
                <div class="buttons">
                    <button type="button" class="call-us" id="callMeBack">Связаться с нами!</button>
                    <button type="button" class="view-works" onclick="window.location.href = 'search.php'">Посмотреть работы&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></button>
                </div>
            </div>
        </div>
    </section>

    <section class="service" id="services">
        <div class="content">
            <p class="title">
                Наши услуги
            </p>

            <?php 
                $sql = "SELECT * FROM service ORDER BY sort_order";
                $result = $conn->query($sql);
                $numService = 0;

                if ($result->num_rows > 0) {
                    echo '<div class="cards">';
                    while ($row = $result->fetch_assoc()) {
                        $numService++;
                        $description = $row['description'];
                        if (strlen($description) > 120) {
                            $description = substr($description, 0, 280) . '...';
                        }
                        echo ' 
                            <div class="card" onclick="window.location.href=\'service-info.php?serviceId=' . $row['serviceId'] . '\'">
                                <p class="num">0'.$numService.'</p>
                                <p class="title">'.$row['name'].'</p>
                                <p class="descr">'.$description.'</p>
                            </div>
                        ';
                    }
                    echo '</div>';
                }
            ?>
        </div>
    </section>

    <section class="our-works" id="works">
        <div class="content">
            <p class="title">Наши работы</p>
            <div class="reasons">
                <div class="reason">
                    <p class="title">10</p>
                    <p class="descr">лет опыта</p>
                </div>
                <div class="reason">
                    <p class="title">100+</p>
                    <p class="descr">выполненных работ<br>по кровле и фасадам</p>
                </div>
                <div class="reason">
                    <p class="title">200+</p>
                    <p class="descr">разработанных рабочих документаций и спецификаций<br>на кровлю и фасады</p>
                </div>
                <div class="reason">
                    <p class="title">100%</p>
                    <p class="descr">довольных клиентов</p>
                </div>
            </div>

            <div class="works">
                <div class="work" onclick="window.location.href='work-info.php'">
                    <p class="title">Лайский док</p>
                    <p class="descr">Комплекс работ по монтажу навесного вентилируемого фасада с теплоизоляционным слоем, включая монтаж оконных и дверных откосов, водоотливов, примыканий и углов</p>
                    <p class="details">Подробнее <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></p>
                </div>
                <div class="work" onclick="window.location.href='work-info.php'">
                    <p class="title">Лайский док</p>
                    <p class="descr">Комплекс работ по монтажу навесного вентилируемого фасада с теплоизоляционным слоем, включая монтаж оконных и дверных откосов, водоотливов, примыканий и углов</p>
                    <p class="details">Подробнее <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></p>
                </div>
                <div class="work" onclick="window.location.href='work-info.php'">
                    <p class="title">Лайский док</p>
                    <p class="descr">Комплекс работ по монтажу навесного вентилируемого фасада с теплоизоляционным слоем, включая монтаж оконных и дверных откосов, водоотливов, примыканий и углов</p>
                    <p class="details">Подробнее <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></p>
                </div>
                <div class="work" onclick="window.location.href='work-info.php'">
                    <p class="title">Лайский док</p>
                    <p class="descr">Комплекс работ по монтажу навесного вентилируемого фасада с теплоизоляционным слоем, включая монтаж оконных и дверных откосов, водоотливов, примыканий и углов</p>
                    <p class="details">Подробнее <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></p>
                </div>
                <div class="work" onclick="window.location.href='work-info.php'">
                    <p class="title">Лайский док</p>
                    <p class="descr">Комплекс работ по монтажу навесного вентилируемого фасада с теплоизоляционным слоем, включая монтаж оконных и дверных откосов, водоотливов, примыканий и углов</p>
                    <p class="details">Подробнее <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></p>
                </div>
                <div class="work" onclick="window.location.href='work-info.php'">
                    <p class="title">Лайский док</p>
                    <p class="descr">Комплекс работ по монтажу навесного вентилируемого фасада с теплоизоляционным слоем, включая монтаж оконных и дверных откосов, водоотливов, примыканий и углов</p>
                    <p class="details">Подробнее <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></p>
                </div>
                <div class="work" onclick="window.location.href='work-info.php'">
                    <p class="title">Лайский док</p>
                    <p class="descr">Комплекс работ по монтажу навесного вентилируемого фасада с теплоизоляционным слоем, включая монтаж оконных и дверных откосов, водоотливов, примыканий и углов</p>
                    <p class="details">Подробнее <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></p>
                </div>
                <div class="work" onclick="window.location.href='work-info.php'">
                    <p class="title">Лайский док</p>
                    <p class="descr">Комплекс работ по монтажу навесного вентилируемого фасада с теплоизоляционным слоем, включая монтаж оконных и дверных откосов, водоотливов, примыканий и углов</p>
                    <p class="details">Подробнее <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></p>
                </div>
                
            </div>
            <button type="button" class="viewBtn" onclick="window.location.href = 'search.php'">Посмотреть работы <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></button>
        </div>
    </section>

    <section class="about-company" id="company">
        <div class="content">
            <div class="info">
                <p class="title">О компании</p>
                <p class="descr">Организация ООО «Строительные технологии» специализируется на фасадных и кровельных работах. Мы существуем на этом рынке 10 лет. Работаем со всеми крупными 
                застройщиками Архангельска и Северодвинска и так же с физическими лицами. 
                У нас есть собственное производство по распиловке алюминиевых профилей. 
                Свой цех по жестяным работам и производству вентиляции.</p>
            </div>
            <img src="/assets/images/company.jpg" alt="">
        </div>
    </section>

    <section class="reviews">
        <div class="content">
            <p class="title">Наши отзывы</p>
            <div class="reviews-content">
                <div class="review">
                    <p class="title">Николай М.</p>
                    <p class="comment">Воспользовался услугами данной компании и не пожалел, сперва настораживало малое 
                        кол-во информации о ребятах в сети, но после того как начали сотрудничать, 
                        стало понятно, что знают чем занимаются. </p>
                    <div class="stars">
                        <img src="/assets/images/star.png" alt="">
                        <img src="/assets/images/star.png" alt="">
                        <img src="/assets/images/star.png" alt="">
                        <img src="/assets/images/star.png" alt="">
                        <img src="/assets/images/star.png" alt="">
                    </div>
                </div>
                <div class="review">
                    <p class="title">Николай М.</p>
                    <p class="comment">Воспользовался услугами данной компании и не пожалел, сперва настораживало малое 
                        кол-во информации о ребятах в сети, но после того как начали сотрудничать, 
                        стало понятно, что знают чем занимаются. </p>
                    <div class="stars">
                        <img src="/assets/images/star.png" alt="">
                        <img src="/assets/images/star.png" alt="">
                        <img src="/assets/images/star.png" alt="">
                        <img src="/assets/images/star.png" alt="">
                        <img src="/assets/images/star.png" alt="">
                    </div>
                </div>
            </div>
            <div class="buttons">
                <button type="button"><i class="fa-solid fa-chevron-left" style="color: #ffffff;"></i></button>
                <button type="button"><i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i></button>
            </div>
        </div>
    </section>

    <section class="send-review">
        <form action="">
            <p class="title">Оставить отзыв</p>
            <p class="descr">Используйте форму для отправки отзыва.</p>
            <input type="text" name="nameReview" id="nameReview" placeholder="Ваше имя">
            <textarea name="commentReview" id="commentReview" placeholder="Сообщение"></textarea>
            <button type="submit">Отправить</button>
        </form>
    </section>

    <section class="feedback" id="feedback">
        <form id="feedbackForm" action="process_feedback.php" method="post">
            <p class="title">Обратная связь</p>
            <p class="descr">Используйте форму для отправки нам сообщения.<br>
            Мы ответим вам в ближайшее время.</p>
            <input type="text" name="name" id="name" placeholder="Ваше имя" required>
            <div class="line">
                <input type="email" name="email" id="email" placeholder="Эл. почта" required>
                <input type="tel" name="phone" id="phone" placeholder="Телефон" required>
            </div>
            <textarea name="comment" id="comment" placeholder="Сообщение" required></textarea>
            <button type="submit">Отправить</button>
        </form>
    </section>

    <section class="contacts" id="contacts">
        <div class="content">
            <div class="maps" id="map">
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A1a0d6043f33f3689581218168a1eb2b48d2579a9ca5611549d62b4ed4bbb61cc&amp;width=600&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
            </div>
            <div class="info">
                <p class="title">Контакты</p>
                <p class="phone">Телефон: <a href="tel:<?php echo $phoneFormated;?>">+7 (960) 008-32-81</a></p>
                <p class="email">Эл. почта: <?php echo $email;?></p>
                <p class="address">Адрес: <?php echo $address;?></p>
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

    <div id="notification" style="display: none;">Сообщение отправлено!</div>

    <script src="/js/index.js"></script>
</body>
</html>