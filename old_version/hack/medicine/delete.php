<?php
require_once("constants.php");
require_once("base.php");

if( isset($_POST['value']) ){
  $id = $_POST['id'];
  $id = addslashes($id);
  $id = htmlspecialchars($id);
  $id = stripslashes($id);
  $id = mysql_real_escape_string($id);

  $code = explode("-", $id);
  $table = $code[0]; //table
  $id = $code[1]; // id
  $column = $code[2]; // column

  if( isset($_POST['value']) ){
    $value = $_POST['value'];
    $value = addslashes($value);
  //  $value = htmlspecialchars($value);
    $value = stripslashes($value);
    $value = mysql_real_escape_string($value);

		echo "<div>Переданное значение id: ".$_POST['id']."</div>";
		echo "<div>Переданное значение value: ".$_POST['value']."</div>";

    $result = mysql_query("UPDATE $table SET $column='$value' WHERE id='$id' ");

    if($result == true){
      echo 0; //Ваше сообшение успешно отправлено
      }

      else{
        echo 1; //Сообщение не отправлено. Ошибка базы данных
      }
  	if( $result ){
  		exit("Настройка сохранена");
  	}else{
  		exit("Ошибка сохранения");
  	}
  }
}
?>