<?php
  if(isset($_GET['srch'])){
    include_once(RELPATH."patient_srch.php");
    echo "поиск";
  }
  elseif(isset($_GET['srch'])){
    include_once(RELPATH."patient_srch.php");
    echo "поиск";
  }
  else{
    echo "<body>\n";
      include_once ABSPATH."login.php";
    echo "</body>\n";
  }
?>