<?php
require_once("constants.php");
require_once("base.php");

    $fname = $_POST['fname'];
    $fname = addslashes($fname);
    $fname = htmlspecialchars($fname);
    $fname = stripslashes($fname);
    $fname = mysql_real_escape_string($fname);

    $name = $_POST['name'];
    $name = addslashes($name);
    $name = htmlspecialchars($name);
    $name = stripslashes($name);
    $name = mysql_real_escape_string($name);

    $sname = $_POST['sname'];
    $sname = addslashes($sname);
    $sname = htmlspecialchars($sname);
    $sname = stripslashes($sname);
    $sname = mysql_real_escape_string($sname);

    $sex = $_POST['sex'];
    $sex = addslashes($sex);
    $sex = htmlspecialchars($sex);
    $sex = stripslashes($sex);
    $sex = mysql_real_escape_string($sex);

    $b_date = $_POST['b_date'];
    $b_date = addslashes($b_date);
    $b_date = htmlspecialchars($b_date);
    $b_date = stripslashes($b_date);
    $b_date = mysql_real_escape_string($b_date);

    $growth = $_POST['growth'];
    $growth = addslashes($growth);
    $growth = htmlspecialchars($growth);
    $growth = stripslashes($growth);
    $growth = mysql_real_escape_string($growth);

    $address = $_POST['address'];
    $address = addslashes($address);
    $address = htmlspecialchars($address);
    $address = stripslashes($address);
    $address = mysql_real_escape_string($address);

    $phone = $_POST['phone'];
    $phone = addslashes($phone);
    $phone = htmlspecialchars($phone);
    $phone = stripslashes($phone);
    $phone = mysql_real_escape_string($phone);

    $result = mysql_query("INSERT INTO $table_patient (fname, name, sname, sex, b_date, growth, address, phone)
                        VALUES ('$fname', '$name', '$sname', '$sex', '$b_date', '$growth', '$address', '$phone') ");

    if($result == true){
        echo 0; //Ваше сообшение успешно отправлено
    }
    else{
        echo 1; //Сообщение не отправлено. Ошибка базы данных
    }


 ?>