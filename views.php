<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="action.php" method="post" name="form">
        <label for="first_name">Введите имя: </label>
        <input type="text" name="first_name" placeholder="Введите имя">
        </br></br>
        <label for="last_name">Введите фамилию: </label>
        <input type="text" name="last_name" placeholder="Введите фамилию">
        </br></br>
        <label for="birthday">Введите дату рождения: </label>
        <input type="date" name="birthday">
        </br></br>
        <label for="gender">Выберите пол: </label>
        <input type="radio" name="gender" value="0">Муж
        <input type="radio" name="gender" value="1">Жен
        </br></br>
        <label for="birth_city">Введите город рождения: </label>
        <input type="text" name="birth_city" placeholder="Введите город">
        </br></br>
        <input type="submit" name="submit_form" value="Отправить!">
    </form>
</body>
</html>
