<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Путь к autoload.php PHPMailer, если вы используете Composer

require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO feedback (name, email, phone, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $phone, $comment);

    if ($stmt->execute()) {
        echo 'Success';

        // Получение ID вставленной строки
        $feedbackId = $conn->insert_id;

        $mail = new PHPMailer(true); 
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.mail.ru'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'info@st29.ru';
            $mail->Password = 'GGzxmrHUbhnWRAFgwnze';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->SMTPDebug = 2;
            $mail->Debugoutput = 'html';

            $mail->CharSet = 'UTF-8';

            $mail->setFrom('info@st29.ru', 'Строительные технологии 29');
            $mail->addAddress('st.stepanov57@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = 'Новая заявка обратной связи!';
            $mail->Body = '
                <!DOCTYPE html>
                <html lang="ru">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <style>
                        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap");
                        * {
                            font-family: "Inter", sans-serif;
                        }
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
                        .ii a[href] {
                            color: white;
                            text-decoration: none;
                        }
                        .content h1 {
                            font-size: 22px;
                            margin-top: 0;
                        }
                        .content p {
                            margin-top: 0;
                            margin-bottom: 10px;
                            font-size: 15px;
                        }
                        .content p.label{
                            color: rgba(15, 36, 79, 0.7);
                            font-weight: 500;
                            margin-bottom: 0;
                        }
                        .content p.value{
                            text-decoration: none;
                            color: #0F244F;
                            font-weight: 500;
                        }
                        .content p.title {
                            color: #053380;
                            font-weight: 700;
                            text-align: center;
                            margin-bottom: 20px;
                            font-size: 20px;
                        }
                        .footer {
                            background-color: #f0f0f0;
                            text-align: center;
                            padding: 10px;
                            border-radius: 0 0 5px 5px;
                            margin-top: 20px;
                        }
                        .footer a{
                            text-decoration: none !important;
                            color: white;
                        }
                        .button {
                            display: inline-block;
                            background-color: #053380;
                            color: white;
                            padding: 10px 20px;
                            text-decoration: none;
                            border-radius: 5px;
                        }
                        .button a{
                            color: white;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <div class="header">
                            <h1>СТРОИТЕЛЬНЫЕ ТЕХНОЛОГИИ</h1>
                        </div>
                        <div class="content">
                            <p class="title">Новая заявка!</p>
                            <p class="label">Имя:</p>
                            <p class="value">' . htmlspecialchars($name) . '</p>
                            <p class="label">Email:</p>
                            <p class="value">' . htmlspecialchars($email) . '</p>
                            <p class="label">Телефон:</p>
                            <p class="value">' . htmlspecialchars($phone) . '</p>
                            <p class="label">Сообщение:</p>
                            <p class="value">' . nl2br(htmlspecialchars($comment)) . '</p>
                        </div>
                        <div class="footer">
                            <a class="button" href="http://st29.ru/admin/feedback-info.php?feedbackId=' . $feedbackId . '">Посмотреть</a>
                        </div>
                    </div>
                </body>
                </html>
            ';

            $mail->send();
            echo 'Email sent successfully';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        http_response_code(500);
        echo 'Error';
    }

    $stmt->close();
    $conn->close();
}
?>
