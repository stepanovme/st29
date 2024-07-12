<?php
require_once('../db.php');

$sql = "SELECT * FROM setting";
$result = $conn -> query($sql);

if($result -> num_rows > 0){
    while($row = $result -> fetch_assoc()){
        $companyName = $row['nameCompany'];
        $phone = $row['phone'];
        $email = $row['email'];
        $address = $row['address'];
    }

}

if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    $copanyNameValue = $_POST['companyName'];
    $phoneValue = $_POST['phone'];
    $emailValue = $_POST['email'];
    $addressValue = $_POST['address'];

    $sqlInsert = "INSERT INTO setting (nameCompany, phone, email, address) VALUES ('$copanyNameValue', '$phoneValue', '$emailValue', '$addressValue')";
    $resultInsert = $conn -> query($sqlInsert);

    header("Location: index.php");
}


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Настройки</title>
</head>
<body>
    <div class="content">
        <div class="nav">
            <p class="title">Админ-панель</p>
            <div class="tile active">
                <a>Настройки</a>
            </div>
            <div class="tile" onClick="window.location.href = 'services.php'">
                <a>Услуги</a>
            </div>
        </div>
        <div class="page-content">
            <h1>Настройки</h1>
            <form method="POST">
                <label for="">Название компании: </label>
                <input type="text" name="companyName" id="companyName" value="<?php echo $companyName;?>">
                <label for="">Номер телефона: </label>
                <input type="text" name="phone" id="phone" value="<?php echo $phone;?>">
                <label for="">Эл. почта: </label>
                <input type="text" name="email" id="email" value="<?php echo $email;?>">
                <label for="">Адрес: </label>
                <input type="text" name="address" id="address" value="<?php echo $address;?>">
                <button type="submit">Сохранить</button>
            </form>
        </div>
    </div>
</body>
</html>