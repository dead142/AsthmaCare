<?php
if ($_SESSION['doc_user_rights'] > 0){ // если в сессии загружены логин и id
    echo "<body>";
        include_once ABSPATH."sidedrawer.php";
        include_once ABSPATH."header.php";
        if(isset($_GET['div']) AND $_GET['div'] == 1){include_once ABSPATH."patient_load.php";}
        elseif(isset($_GET['div']) AND $_GET['div'] == 2){include_once ABSPATH."patient_edit.php";}
        elseif(isset($_GET['div']) AND $_GET['div'] == 3){include_once ABSPATH."patient_info.php";}
        else{include_once ABSPATH."content.php";}
//        include_once ABSPATH."content.php";
        include_once ABSPATH."footer.php";
//        include_once(RELPATH."patient_srch.php");
    echo "</body>";

}
if ($_SESSION['doc_user_rights'] == 0){ // если в сессии не загружены логин и id
  echo "<div class=\"registration\">\n";
    echo "<header id=\"header\">\n";
      echo "<div class=\"mui-appbar mui--appbar-line-height\"></div>\n";
    echo "</header>\n";
    echo "<div id=\"content-wrapper\">\n";
      echo "<div class=\"mui--appbar-height\"></div>\n";
      echo "<div class=\"mui-container-fluid\">\n";
        echo "<br>\n";
        echo "<h1>Авторизация</h1>\n";
        echo "<br>\n";
        echo "<div class=\"mui-container-fluid\">\n";
          echo "<div class=\"mui-row\">\n";
            echo "<div class=\"mui-col-md-6 mui-panel\">\n";
              echo "<form action=\"index.php\" method=\"post\">\n";
                echo "<legend>Введите, пожалуйста, логин и пароль</legend>\n";
                echo "<div class=\"mui-textfield\">\n";
                  echo "<input type=\"text\" name=\"login\" placeholder=\"Логин\">\n";
                echo "</div>\n";
                echo "<div class=\"mui-textfield\">\n";
                  echo "<input type=\"password\" name=\"pass\" placeholder=\"Пароль\">\n";
                echo "</div>\n";
                echo "<input type=\"submit\" name=\"submit\" id=\"submit\" class=\"mui-btn mui-btn--raised mui-btn--accent\" value=\"Войти\">\n";
              echo "</form>\n";
            echo "</div>\n";
          echo "</div>\n";
        echo "</div>\n";
        echo "<br>\n";
      echo "</div>\n";
    echo "</div>\n";
    echo "<footer id=\"footer\">";
        echo "<div class=\"mui-container-fluid\">\n";
        echo "<br>Сделано в рамках Всероссийского хакатона <a href=\"http://www.hackrussia.ru/\" target=\"_blank\" >HackRussia</a>\n";
        echo "</div>\n";
    echo "</footer>\n";
  echo "</div>\n";
}
?>