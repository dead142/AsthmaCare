    <div id="content-wrapper">
        <div class="mui--appbar-height"></div>
        <div class="mui-container-fluid">
            <br>
            <h1>Список пациентов</h1>
            <div class="mui-row mui-col-md-12">
                <ul class="mui-tabs__bar mui-tabs__bar--justified">
                    <li class="mui--is-active"><a href="index.html">Все пациенты</a></li>
                    <li><a href="index_yellow.html">Уровень наблюдения</a></li>
                    <li><a href="index_red.html">Уровень риска</a></li>
                </ul>
                <br>
                <div id="content">
                    <table id="tablePatients" class="display" cellspacing="0" width="100%">
                    <?php
                    echo "<thead>";
                        echo "<tr>\n";
                            echo "<th>№<img src=\"".RELPATH."images/arrow_both.svg\" alt=\"\" width=\"15\"/></th>\n";
                            echo "<th>ФИО<img src=\"".RELPATH."images/arrow_both.svg\" alt=\"\" height=\"15\"/></th>\n";
                            echo "<th>Возраст<img src=\"".RELPATH."images/arrow_both.svg\" alt=\"\" height=\"15\"/></th>\n";
                            echo "<th>Телефон<img src=\"".RELPATH."images/arrow_both.svg\" alt=\"\" height=\"15\"/></th>\n";
                            echo "<th>Адрес<img src=\"".RELPATH."images/arrow_both.svg\" alt=\"\" height=\"15\"/></th>\n";
                            echo "<th></th>";
                        echo "</tr>\n";
                    echo "</thead>";
                    $query_patient_text = "SELECT * FROM $table_patient ORDER BY id DESC";
                    $query_patient = mysql_query($query_patient_text);

                    if(!$query_patient){
                        echo "<p class='text'>Поиск не осуществлен. Код ошибки:</p>";
                        echo exit(mysql_error());
                    }
                    if (mysql_num_rows($query_patient) > 0){
                        $row_patient = mysql_fetch_array($query_patient);
                        $i_patient = 0;
                        echo "<tbody>\n";
                            do{
                                $i_patient++;
                                echo "<tr>\n";
                                    echo "<td>".$i_patient."</td>\n";
                                    echo "<td><a href=\"index.php?div=2&patient_id=".$row_patient['id']."\">".$row_patient['fname']." ".$row_patient['name']." ".$row_patient['sname']."</a></td>\n";
                                    echo "<td>".get_age($row_patient['b_date'])."</td>\n";
                                    echo "<td>".$row_patient['phone']."</td>\n";
                                    echo "<td>".$row_patient['address']."</td>\n";
                                    echo "<td class=\"text-right\"><button class=\"mui-btn mui-btn--raised mui-btn--small mui-btn--danger\">Удалить</button></td>\n";
                                echo "</tr>";
                            }while($row_patient = mysql_fetch_array($query_patient));
                        unset($i_patient);
                        echo "</tbody>\n";
                    }
                    ?>
                    </table>
                    </div>
                <br>
            </div>
        </div>
    </div>
