<?php
if($_POST['id'] AND $_POST['exam']) {
  require_once("medicine/constants.php");
  require_once("medicine/base.php");
  require_once("medicine/functions.php");

  $query_text_patient = "SELECT * FROM $table_patient WHERE id = ".$_GET['id'];
  $query_patient = mysql_query($query_text_patient);
  if(!$query_patient){
    echo "<p class='text'>Выбор подчинённых терминов. Поиск не осуществлен. Код ошибки:</p>";
    echo exit(mysql_error());
  }
  if (mysql_num_rows($query_patient) > 0){
    $row_patient = mysql_fetch_array($query_patient);

  function get_age($date)
    {
      if (ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $date, $reg))
      {
        $day = $reg[3];
        $month = $reg[2];
        $year = $reg[1];
      }
      if ($month > date('m') || $month == date('m') && $day > date('d')){
        $year_result = (string)(date('Y') - $year - 1);
      }
      else{
        $year_result = (string)(date('Y') - $year);
      }
      $last_numeral2 = intval($year_result[strlen($year_result) - 1]);
      $last_numeral1 = intval($year_result[strlen($year_result) - 2]);
      $last_numeral = $last_numeral1.$last_numeral2;
      if ($last_numeral2 == 1 AND $last_numeral != 11)
          $text_year = 'год';
      else if($last_numeral >= 10 AND $last_numeral <= 20)
          $text_year = 'лет';
      else if ($last_numeral2 >= 2 && $last_numeral2 <= 4)
          $text_year = 'года';
      else
          $text_year = 'лет';
      return $year_result;
    }



    $age = get_age($row_patient['b_date']);

        if($age >= 5 AND $age < 8){$age_tbl = '5';}
    elseif($age >= 8 AND $age < 11){$age_tbl = '8';}
    elseif($age >= 11 AND $age < 15){$age_tbl = '11';}
    elseif($age >= 15 AND $age < 20){$age_tbl = '15';}
    elseif($age >= 20 AND $age < 25){$age_tbl = '20';}
    elseif($age >= 25 AND $age < 30){$age_tbl = '25';}
    elseif($age >= 30 AND $age < 35){$age_tbl = '30';}
    elseif($age >= 35 AND $age < 40){$age_tbl = '35';}
    elseif($age >= 40 AND $age < 45){$age_tbl = '40';}
    elseif($age >= 45 AND $age < 50){$age_tbl = '45';}
    elseif($age >= 50 AND $age < 55){$age_tbl = '50';}
    elseif($age >= 55 AND $age < 60){$age_tbl = '55';}
    elseif($age >= 60 AND $age < 65){$age_tbl = '60';}
    elseif($age >= 65 AND $age < 70){$age_tbl = '65';}
    elseif($age >= 70 AND $age < 75){$age_tbl = '70';}
    elseif($age >= 75 AND $age < 80){$age_tbl = '75';}
    elseif($age >= 80 AND $age < 85){$age_tbl = '80';}
    elseif($age >= 85){$age_tbl = '85';}
    echo $table_exam_standart;

    $query_text_exam = "SELECT * FROM exam_standart WHERE growth = '".$row_patient['growth']."' AND sex = '".$row_patient['sex']."'";
    $query_exam = mysql_query($query_text_exam);
    if(!$query_exam){
      echo "<p class='text'>Выбор подчинённых терминов. Поиск не осуществлен. Код ошибки:</p>";
      echo exit(mysql_error());
    }
    if (mysql_num_rows($query_exam) > 0){
      $row_exam = mysql_fetch_array($query_exam);
//      echo "<br>".$row_exam[$age_tbl]."- значение<br>";
      $exam_percent = round($_GET['exam'] * 80 / $row_exam[$age_tbl], 0);

      if($exam_percent >= 80){$exam_cathegory = 'green';}
      elseif($exam_percent >= 60 AND $exam_percent < 80){$exam_cathegory = 'yellow';}
      elseif($exam_percent < 60){$exam_cathegory = 'red';}

      $query_text = "INSERT INTO $table_examination (patient_id, result, result_standart, result_percent, exam_cathegory, time) VALUES ('".$_GET['id']."', '".$_GET['exam']."', '".$row_exam[$age_tbl]."', '".$exam_percent."', '".$exam_cathegory."', '".$_GET['time']."')";
      $query = mysql_query($query_text);
      $query_id = mysql_insert_id();
      if($query){
        $code = "200";
        $message = "ACCESS";
        $result = 'true';
        $id = $row_patient['id'];
        $arr = array('code' => $code, 'message' => $message, 'result' => $result, 'id' => $id, 'percent' => $exam_percent, 'cathegory' => $exam_cathegory);
        echo json_encode($arr);
      }
      else{
        $code = "100";
        $message = "DATA NOT ADDED";
        $result = "false";
        $arr = array('code' => $code, 'message' => $message, 'result' => $result);
        echo json_encode($arr);
      }
    }
  }
}

else{
  $code = "100";
  $message = "QUERY IS EMPTY";
  $query_id = "null";
  $arr = array('code' => $code, 'message' => $message);
  echo json_encode($arr);
}
?>