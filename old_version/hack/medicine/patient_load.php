  <div id="content-wrapper">
    <div class="mui--appbar-height"></div>
    <div class="mui-container-fluid">
      <br>
      <h1>Регистрация пациента</h1>
       <br>
      <div class="mui-container-fluid">
        <div class="mui-row">
        <div class="mui-col-md-6 mui-panel">
            <form action="<?php echo PATH_FILE."patient_add.php"?>" method="post" id="patient_add" >
              <legend>Введите, пожалуйста, данные пациента</legend>
              <div class="mui-textfield">
                <input type="text" placeholder="Фамилия" id="fname" name="fname" required>
              </div>
              <div class="mui-textfield">
                <input type="text" placeholder="Имя"  id="name" name="name" required>
              </div>
              <div class="mui-textfield">
                <input type="text" placeholder="Отчество"  id="sname" name="sname" required>
              </div>
              <div class="mui-select">
                <select id="sex" name="sex" required>
                  <option value="0">Пол</option>
                  <option value="1">Женский</option>
                  <option value="2">Мужской</option>
                </select>
              </div>
              <div class="mui-textfield">
                <input type="date" placeholder="Дата рождения" id="b_date" name="b_date" required>
              </div>
              <div class="mui-textfield">
                <input type="text" placeholder="Рост" id="growth" name="growth" required>
              </div>
              <div class="mui-textfield">
                <input type="text" placeholder="Адрес" id="address" name="address" required>
              </div>
              <div class="mui-textfield">
                <input type="text" placeholder="Телефон" id="phone" name="phone" required>
              </div>
              <input type="submit" class="button" name="button" id="patient_add_new" value="Добавить пациента" />
            </form>
          </div>
        </div>
        <div class="messages" id="messages_patient"></div>
        </div>
       <br>
    </div>
  </div>
<?php
    echo "<script type=\"text/javascript\">
      \$(function() {
        \$(\"#patient_add_new\").click(function(){
          var fname = \$(\"#fname\").val();
          var name = \$(\"#name\").val();
          var sname = \$(\"#sname\").val();
          var sex = \$(\"#sex\").val();
          var b_date = \$(\"#b_date\").val();
          var growth = \$(\"#growth\").val();
          var address = \$(\"#address\").val();
          var phone = \$(\"#phone\").val();
          \$.ajax({
            type: \"POST\",
            url: \"medicine/patient_add.php\",
            data: {
               \"fname\": fname,
               \"name\": name,
               \"sname\": sname,
               \"sex\": sex,
               \"b_date\": b_date,
               \"growth\": growth,
               \"address\": address,
               \"phone\": phone
            },
            cache: false,
            success: function(responseone){
              var messageRespone = new Array('Запись добавлена', 'Данные не обновлены или были заполненны не все поля');
              var resultStatone = messageRespone[Number(responseone)];
              if(responseone == 0){
              }
              \$(\"#messages_patient\").text(resultStatone).show().delay(2500).fadeOut(2400);
            }
          });
          return false;
        });
      });
      </script>";

   ?>
