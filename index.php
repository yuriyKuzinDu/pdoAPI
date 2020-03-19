<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cerulean/bootstrap.min.css" rel="stylesheet" integrity="sha384-LV/SIoc08vbV9CCeAwiz7RJZMI5YntsH8rGov0Y2nysmepqMWVvJqds6y0RaxIXT" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h2 class="mt-5">Установка : </h1>
                <ul>
                    <li>Устанавливаем имя БД : /api/config/Constants.php изменяем значение переменной </li>
                    <li>Для работы нам подойдет любая база данных(поля без значений по умолчанию должны быть переданы)</li>
                    <li>Значения регистрозависимы, сравнение производится по равенству</li>
                    <li><img src="img/dbname.bmp" alt=""></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h2 class="mt-5">Добавление записи : </h1>
                <ul>
                    <li>В форм параметрах можно передать необходимые БД поля в formdata : </li>
                    <li>Окончание строки /api/students где students имя таблицы: </li>
                    <img src="img/postmanpost.bmp" alt="">
                    <li>В форм параметрах можно передать необходимые БД поля JSONфайлом : </li>
                    <img src="img/postmanpostjson.bmp" alt="">
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h2 class="mt-5">Выборка : </h1>
                <ul>
                    <li>Для выборки достаточно гет запроса /api/students : </li>
                    <li>Где students имя таблицы для выборки : </li>
                    <li>Можно добавить к запросу ?Id=2 или(и) какие либо другие параметры присущие данной структуре : </li>
                    <li>Например /api/students?Id=2&FName=Alex : </li>
                    <img src="img/postmanget.bmp" alt="">
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h2 class="mt-5">Удаление : </h1>
                <ul>
                    <li>Изменяем тип запроса на delete : </li>
                    <li>В Гет параметрах передаем поля и их значения : </li>
                    <li>Например /api/students?FName=Alex : </li>
                    <img src="img/postmandel.bmp" alt="">
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h2 class="mt-5">Изменение : </h1>
                <ul>
                    <li>Изменяем тип запроса на put/patch : </li>
                    <li>В Гет параметрах передаем поля и их значения для критерия поиска: </li>
                    <li>Например /api/students?FName=Gregor&Id=5 : </li>
                    <li>В body/row передаем JSON с новыми значениями</li>
                    <img src="img/postmanput.bmp" alt="">
                </ul>
            </div>
        </div>
    </div>
</body>
</html>