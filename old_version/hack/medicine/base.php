<?php
$connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Ошибка при соединении с базой данных");
mysql_set_charset(DB_CHARSET, $connection);
mysql_select_db(DB_NAME, $connection) or die("Невозможно выбрать БД ");
if (!$connection || !mysql_select_db(DB_NAME, $connection)){exit (mysql_error());}

$table_patient = "patient";
$table_examination = "examination";
$table_exam_standart = "exam_standart";
define('PATH_FILE', 'https://asthmacare.ru/hackaton/hack/');
?>