<!-- <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>
        @import url('style.css');
        body {
            font-family: Inter, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
            background-blend-mode: multiply;
            background-image: url(../assets/images/feedback.jpg);
            background-position: top;
            background-repeat: no-repeat;
            background-size: cover;
            background-color: rgba(5, 51, 128, 0.75);
        }
        .content{
            display: flex;
            flex-direction: column;
            background-color: white;
            margin-top: 100px;
            margin-bottom: 100px;
            width: 80%;
        }

        .content>h1{
            margin-top: 17px;
            margin-left: 60px;
            font-size: 20px;
            color: #053380;
            font-weight: 600;
            margin-bottom: 17px;
        }
        .content>.hr{
            background-color: rgba(15, 36, 79, 0.7);
            height: 1px;
        }

        .content>p.title{
            margin: 0 auto;
            margin-top: 17px;
            color: #0F244F;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 17px;
        }

        .content>label{
            color: rgba(15, 36, 79, 0.7);
            font-size: 14px;
            font-weight: 500;
            margin-left: 60px;
        }
        .content>p.value{
            color: #0F244F;
            font-weight: 500;
            font-size: 18px;
            margin-bottom: 12px;
            margin-left: 60px;
            margin-right: 60px;
            text-align: justify;
        }

        .content>p.message{
            margin-bottom: 30px;
        }

        .content>button{
            background-color: #053380;
            border: 0;
            border-radius: 10px;
            margin: 0 auto;
            color: white;
            padding: 12px 32px;
            font-size: 600px;
            font-size: 18px;
            margin-bottom: 17px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="preheader" style="font-size:0px;font-color:#ffffff;opacity:0;">
4 варианта майских праздников от Localway. Сидеть дома в майские праздники — грех.
</div>
    <div class='container'>
        <div class="content">
            <h1>СТРОИТЕЛЬНЫЕ ТЕХНОЛОГИИ</h1>
            <div class="hr"></div>
            <p class="title">Новая заявка!</p>
            <label>Имя</label>
            <p class="value">Нетипон</p>
            <label>E-mail</label>
            <p class="value">netipon@gmail.com</p>
            <label>Телефон</label>
            <p class="value">+7 844 344 3434</p>
            <label>Сообщение</label>
            <p class="value message">Организация ООО «Строительные технологии» специализируется на фасадных и кровельных работах. Мы существуем на этом рынке 10 лет. Работаем со всеми крупными застройщиками Архангельска и Северодвинска и так же с физическими лицами. У нас есть собственное производство по распиловке алюминиевых профилей. Свой цех по жестяным работам и производству вентиляции.</p>
            <button onclick="window.location.href='http://st29.ru'">Просмотреть</button>
        </div>
    </div>
</body>
</html> -->

                <!DOCTYPE html>
                <html lang="ru">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 0;
                            padding: 0;
                            box-sizing: border-box;
                            background-color: #f0f0f0;
                        }
                        .container {
                            width: 100%;
                            max-width: 600px;
                            margin: 0 auto;
                            background-color: #ffffff;
                            padding: 20px;
                            border-radius: 10px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        }
                        .header {
                            background-color: #053380;
                            color: #ffffff;
                            text-align: center;
                            padding: 10px;
                            border-radius: 5px 5px 0 0;
                            margin-bottom: 20px;
                        }
                        .content {
                            margin-bottom: 20px;
                            padding: 0 20px;
                        }
                        .content h1 {
                            font-size: 24px;
                            margin-top: 0;
                        }
                        .content p {
                            margin-top: 0;
                            margin-bottom: 10px;
                        }
                        .footer {
                            background-color: #f0f0f0;
                            text-align: center;
                            padding: 10px;
                            border-radius: 0 0 5px 5px;
                            margin-top: 20px;
                        }
                        .button {
                            display: inline-block;
                            background-color: #053380;
                            color: white;
                            padding: 10px 20px;
                            text-decoration: none;
                            border-radius: 5px;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <div class="header">
                            <h1>СТРОИТЕЛЬНЫЕ ТЕХНОЛОГИИ</h1>
                        </div>
                        <div class="content">
                            <p><strong>Имя:</strong> ' . htmlspecialchars($name) . '</p>
                            <p><strong>Имя:</strong> ' . htmlspecialchars($name) . '</p>
                            <p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>
                            <p><strong>Телефон:</strong> ' . htmlspecialchars($phone) . '</p>
                            <p><strong>Сообщение:</strong></p>
                            <p>' . nl2br(htmlspecialchars($comment)) . '</p>
                        </div>
                        <div class="footer">
                            <a class="button" href="http://st29.ru">Посмотреть</a>
                        </div>
                    </div>
                </body>
                </html>