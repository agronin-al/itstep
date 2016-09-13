<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin panel</title>
</head>
<body>
<form action="" method="post">
    <label>Создать новую категорию<input type="text" value="category name"></label>
    <input type="button" value="Добавить">


</form>
</body>
</html>

<?php
const MYSQL_HOST = 'localhost'; //127.0.0.1
const MYSQL_USER = 'root';
const MYSQL_PASS = '';
const MYSQL_DB = 'NewsBlog';
const MYSQL_ENCD = 'utf8'; //encoding
const MYSQL_PORT = 3306;
const DB_DRIVER = 'mysql';
$conn = new PDO(
    DB_DRIVER . ":dbname=" . MYSQL_DB . ";host=" . MYSQL_HOST,
    MYSQL_USER,
    MYSQL_PASS
);

?>