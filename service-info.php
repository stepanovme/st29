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

$serviceId = isset($_GET['serviceId']) ? (int)$_GET['serviceId'] : 0;
 
$sql = "SELECT * FROM service WHERE serviceId = $serviceId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nameService = $row['name'];
        $descrService = nl2br($row['description']);
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <link rel="stylesheet" href="css/service-info-landing.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <title>Услуга <?php echo $nameService;?></title>
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
                <a href="index.php">Главная</a> > <a href="services.php">Все услуги</a> > <p><?php echo $nameService;?></p>
            </div>

            <div class="service-content">
                <div class="slider">
                    <div><img src="/assets/images/work.jpg" alt=""></div>
                    <div><img src="/assets/images/promo2.jpg" alt=""></div>
                    <div><img src="/assets/images/promo3.jpg" alt=""></div>
                    <div><img src="/assets/images/promo3.jpg" alt=""></div>
                </div>
                <div class="text">
                    <h1><?php echo $nameService;?></h1>
                    <p class="descr">
                    <?php echo $descrService;?>
                    </p>
                </div>
            </div>

            <div class="our-works">
                <p class="title">Наши работы с этой услугой</p>
                <div class="works">
                    <div class="card" onclick="window.location.href='work-info.php'">
                        <p class="title">Лайский док <i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i></p>
                    </div>
                    <div class="card" onclick="window.location.href='work-info.php'">
                        <p class="title">Лайский док <i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i></p>
                    </div>
                    <div class="card" onclick="window.location.href='work-info.php'">
                        <p class="title">Лайский док <i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i></p>
                    </div>
                    <div class="card" onclick="window.location.href='work-info.php'">
                        <p class="title">Лайский док <i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="fullscreen-slider" style="display: none;">
        <div class="slick-fullscreen">
            <div><img src="/assets/images/work.jpg" alt=""></div>
        </div>
        <span class="close-fullscreen">&times;</span>
    </div>

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

    <script>
    $(document).ready(function(){
        $('.slider').slick({
            autoplay: true,
            autoplaySpeed: 2000,
            dots: true,
            appendDots: $('.slider'),
            arrows: true,
            prevArrow: '<button type="button" class="slick-prev">Previous</button>',
            nextArrow: '<button type="button" class="slick-next">Next</button>'
        });

        $('.slider img').on('click', function() {
            var slideIndex = $(this).closest('.slider').slick('slickCurrentSlide');
            var slides = $('.slider').slick('getSlick').$slides;

            // Clear existing slides if any
            if ($('.slick-fullscreen').hasClass('slick-initialized')) {
                $('.slick-fullscreen').slick('unslick');
            }

            // Add slides to fullscreen slider
            slides.each(function() {
                var src = $(this).find('img').attr('src');
                $('.slick-fullscreen').append('<div><img src="' + src + '" alt=""></div>');
            });

            // Initialize fullscreen slider
            $('.slick-fullscreen').slick({
                dots: true,
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev">Previous</button>',
                nextArrow: '<button type="button" class="slick-next">Next</button>',
                initialSlide: slideIndex
            });

            // Show fullscreen slider
            $('.fullscreen-slider').show();
        });

        $('.close-fullscreen').on('click', function() {
            $('.fullscreen-slider').hide();
        });

        $('.fullscreen-slider').on('click', function(event) {
            if (event.target.className == 'fullscreen-slider') {
                $('.fullscreen-slider').hide();
            }
        });
    });
    </script>
</body>
</html>
