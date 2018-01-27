<?php
if(isset($_GET['code'])){define('TERMIN_ID', $_GET['code']);}
	else{define('TERMIN_ID', 0);}
define('TERMIN_ACTIVE', 'AND (active<=3 XOR active=0)');  // насколько подробно выводить записи (1 или 2-школьный уровень, 3-ЕГЭ, 4-олимпиада, 9-медвуз...)

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" dir=\"ltr\" lang=\"ru\">";

echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
  include_once ABSPATH."head.php";
  if(isset($_GET['srch'])){
    include_once ABSPATH."header.php";
    include_once ABSPATH."body.php";
    include_once ABSPATH."footer.php";
    include_once(RELPATH."patient_srch.php");
    echo "поиск";
  }
  elseif(isset($_GET['srch'])){
    include_once(RELPATH."patient_srch.php");
    echo "поиск";
  }
  else{
    include_once ABSPATH."login.php";
  }
echo "</html>";
?>