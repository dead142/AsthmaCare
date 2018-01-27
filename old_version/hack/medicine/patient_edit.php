  <div id="content-wrapper">
    <div class="mui--appbar-height"></div>
    <div class="mui-container-fluid">
      <br>
      <h1>Иванов Иван Иваныч</h1>
      <br>
      <div class="mui-container-fluid">
        <div class="mui-row">
        <div class="mui-col-md-12">
          <h2>Информация</h2>
<?php
                    $query_patient_text = "SELECT * FROM $table_patient WHERE id=".$_GET['patient_id'];
                    $query_patient = mysql_query($query_patient_text);

                    if(!$query_patient){
                        echo "<p class='text'>Поиск не осуществлен. Код ошибки:</p>";
                        echo exit(mysql_error());
                    }
                    if (mysql_num_rows($query_patient) > 0){
                        $row_patient = mysql_fetch_array($query_patient);

                        echo "<table class=\"mui-table mui-table--bordered mui-table--information\">
                            <tbody>
                            <tr>
                              <td>Фамилия</td>
                              <td>
                                <span data-id=\"".$table_patient."-".$row_patient['id']."-fname\" class=\"task_edit\" contenteditable>".$row_patient['fname']."</span>
                              </td>
                            </tr>
                            <tr>
                              <td>Имя</td>
                              <td><span data-id=\"".$table_patient."-".$row_patient['id']."-name\" class=\"task_edit\" contenteditable>".$row_patient['name']."</span></td>
                            </tr>
                            <tr>
                              <td>Отчество</td>
                              <td><span data-id=\"".$table_patient."-".$row_patient['id']."-sname\" class=\"task_edit\" contenteditable>".$row_patient['sname']."</span></td>
                            </tr>
                            <tr>
                              <td>Дата рождения</td>
                              <td><span data-id=\"".$table_patient."-".$row_patient['id']."-b_date\" class=\"task_edit\" contenteditable>".$row_patient['b_date']."</span></td>
                            </tr>
                            <tr>
                              <td>Рост</td>
                              <td><span data-id=\"".$table_patient."-".$row_patient['id']."-growth\" class=\"task_edit\" contenteditable>".$row_patient['growth']."</span></td>
                            </tr>
                            <tr>
                              <td>Адрес</td>
                              <td><span data-id=\"".$table_patient."-".$row_patient['id']."-address\" class=\"task_edit\" contenteditable>".$row_patient['address']."</span></td>
                            </tr>
                            <tr>
                              <td>Телефон</td>
                              <td><span data-id=\"".$table_patient."-".$row_patient['id']."-phone\" class=\"task_edit\" contenteditable>".$row_patient['phone']."</span></td>
                            </tr>
                            </tbody>
                          </table>
                        ";
                    }
?>
<!--          <div class="messages"></div>
          <button class="mui-btn mui-btn--raised mui-btn--small mui-btn--primary" id="edit">Редактировать</button>
          <button class="mui-btn mui-btn--raised mui-btn--small mui-btn--accent" id="save">Сохранить</button>
-->
        </div>
        <div class="mui-col-md-12">
          <h2>График наблюдений</h2>
          <div class="mui-panel mui-col-md-8">
             <div class="demo-container">
                <div id="placeholder" class="demo-placeholder"></div>
              </div>
          </div>
        </div>
        <div class="mui-col-md-12">
          <h2>Список наблюдений</h2>
           <table class="mui-table mui-table--bordered">
            <thead>
              <tr>
                <th>Время показания<img src="<?php echo RELPATH; ?>images/arrow_down.svg" alt="" height="15"/></th>
                <th>Результат<img src="<?php echo RELPATH; ?>images/arrow_down.svg" alt="" height="15"/></th>
                <th>Процент<img src="<?php echo RELPATH; ?>images/arrow_down.svg" alt="" height="15"/></th>
                <th>Уровень<img src="<?php echo RELPATH; ?>images/arrow_down.svg" alt="" height="15"/></th>
              </tr>
            </thead>
            <tbody>
<?php

                    $query_ex_text = "SELECT * FROM $table_examination WHERE patient_id=".$row_patient['id']." ORDER BY time DESC";
                    $query_ex = mysql_query($query_ex_text);

                    if(!$query_ex){
                        echo "<p class='text'>Поиск не осуществлен. Код ошибки:</p>";
                        echo exit(mysql_error());
                    }
                    if (mysql_num_rows($query_ex) > 0){
                        $row_ex = mysql_fetch_array($query_ex);
                    do{
                        echo "<tr>\n";
                            echo "<td>".$row_ex['time']."</td>\n";
                            echo "<td>".$row_ex['result']."</td>\n";
                            echo "<td>".$row_ex['exam_percent']."</td>\n";
                            echo "<td>".$row_ex['exam_cathegory']."</td>\n";
                        echo "</tr>\n";
                    }while($row_ex = mysql_fetch_array($query_ex));
                    }

              echo "<script>       \$('#send_parameter').click(function(){

               console.log(".$_GET['patient_id'].");
            return false;
            var date  = \$('#date').val();
            var result = \$('#result').val();



          });";

 ?>
               </script>

            </tbody>
          </table>
          <div class="messages"></div>
          <button type="submit" class="mui-btn mui-btn--raised mui-btn--accent" id="send_parameter">Добавить наблюдение</button>
          <div class="add_show">
            <div class="mui-col-md-6 mui-panel">
              <form  action="<?php echo PATH_FILE."patient_ex.php"?>" method="post" id="patient_add" >
                <legend>Введите, пожалуйста, данные</legend>
                <div class="mui-textfield">
                  <input type="datetime" placeholder="Дата показания" id="date" required>
                </div>
                <div class="mui-textfield">
                  <input type="text" placeholder="Значение" id="result" required>
                </div>
                <button type="submit" class="mui-btn mui-btn--raised mui-btn--accent">Отправить</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
  </div>
</div>

<?php


                    $query_exam_text = "SELECT * FROM $table_examination WHERE patient_id=".$row_patient['id']." ORDER BY time DESC";
                    $query_exam = mysql_query($query_exam_text);

                    if(!$query_exam){
                        echo "<p class='text'>Поиск не осуществлен. Код ошибки:</p>";
                        echo exit(mysql_error());
                    }
                    if (mysql_num_rows($query_exam) > 0){
                        $row_exam = mysql_fetch_array($query_exam);

echo "  <script type=\"text/javascript\">\n";
echo "\n";
echo "    // порядок - красный, желтый, зеленый\n";
echo "    \$(function() {\n";
echo "      var markings = [\n";
echo "        { color: \"#FBE9E7\", lineWidth: 1, yaxis: { from: 0, to: 78 } },\n";
echo "        { color: \"#FFFDE7\", lineWidth: 1, yaxis: { from: 78, to: 80 } },\n";
echo "        { color: \"#E8F5E9\", lineWidth: 1, yaxis: { from: 80, to: 530 } }\n";
echo "      ];\n";
echo "\n";
echo "      var d1 = {\n";
echo "        color: '#212121',\n";
echo "        data:  [";
$i= 0;
do{
    echo "[".$i.", ".$row_exam['result_percent']."]";
    $i++;
    if($i != mysql_num_rows($row_exam)){echo ",";}
}while($row_exam = mysql_fetch_array($query_exam));

echo "]\n";
echo "      };\n";
echo "\n";
echo "      \$.plot(\"#placeholder\", [d1],\n";
echo "         {\n";
echo "            xaxes: [\n";
echo "               { show: false }\n";
echo "            ],\n";
echo "           grid: { markings: markings }\n";
echo "         }\n";
echo "      )\n";
echo "\n";
echo "    });\n";
echo "\n";
echo "  </script>\n";
                    }
?>