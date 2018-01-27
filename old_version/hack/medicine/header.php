<?php
echo "<header id=\"header\">\n";
    echo "<div class=\"mui-appbar mui--appbar-line-height\">\n";
        echo "<div class=\"mui-container-fluid\">\n";
            echo "<a class=\"sidedrawer-toggle mui--visible-xs-inline-block mui--visible-sm-inline-block js-show-sidedrawer\">☰</a>\n";
            echo "<div class=\"mui-col-md-12\">\n";
                echo "<a class=\"sidedrawer-toggle mui--hidden-xs mui--hidden-sm js-hide-sidedrawer\">☰</a>\n";
                echo "<span class=\"sidedrawer-toggle mui--hidden-xs mui--hidden-sm js-hide-sidedrawer\">".$_SESSION['doc_user_name'].", здравствуйте!</span>\n";
                echo "<form action=\"index.php\" method=\"post\">\n";
                        echo "<input type=\"hidden\" name=\"exit\" value=\"exit\">\n";
//                        echo "<input type=\"submit\" name=\"submit\" class=\"submit\" value=\"Выйти\">&nbsp;";
                        echo "<button class=\"mui-btn mui-btn--logout\" name=\"submit\" id=\"logout\" value=\"\">Выйти</button>\n";
                echo "</form>\n";
            echo "</div>\n";
            echo "<span class=\"mui--text-title mui--visible-xs-inline-block mui--visible-sm-inline-block\">".TITLE."</span>\n";
        echo "</div>\n";
    echo "</div>\n";
echo "</header>";
?>