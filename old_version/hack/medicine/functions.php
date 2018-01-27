<?php
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


function date_pr_v($date_pr)   // Преобразование даты в вид "ДД.ММ.ГГГГ"
{
  if (ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $date_pr, $regb))
  {
    echo "$regb[3].$regb[2].$regb[1]";
    echo " (".get_age($date_pr).")";
  }
  else
  {
    echo "Неверный формат даты: $date";
  }
}
?>