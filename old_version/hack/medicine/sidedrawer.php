<?php
echo "<div id=\"sidedrawer\" class=\"mui--no-user-select\">\n";
    echo "<div id=\"sidedrawer-brand\" class=\"mui--appbar-line-height\">\n";
        echo "<img src=\"".RELPATH."images/logo.svg\" width=\"40\" height=\"40\" alt=\"\">\n";
        echo "Уход за Астмой\n";
    echo "</div>\n";
    echo "<div class=\"mui-divider\"></div>\n";
    echo "<ul>\n";
        echo "<li>\n";
            echo "<strong>Список пациентов</strong>\n";
            echo "<ul>\n";
                echo "<li><a href=\"index.php?div=1\">Добавить</a></li>\n";
                echo "<li><a href=\"index.php\">Список пациентов</a></li>\n";
            echo "</ul>\n";
        echo "</li>\n";
    echo "</ul>\n";
echo "</div>\n";
?>