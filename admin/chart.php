<?php

session_start();
require "../connection/connection.php";

if (!empty($_SESSION["admin"])) {

  $date = new DateTime();
  $tz = new DateTimeZone("Asia/Colombo");
  $date->setTimezone($tz);
  $today = $date->format("Y-m-d H:i:s");

  $this_year = date("Y", strtotime($today));
  $this_year_month = date("Y-m", strtotime($today));

  $year = $_POST["year"];

  $y_rs = Database::search("SELECT * FROM `summary_year` WHERE `summary_year`='".$year."'");
  if($y_rs->num_rows > 0){

    $y_data = $y_rs->fetch_assoc();

    $m_rs = Database::search("SELECT * FROM `summary_month` WHERE `summary_month`.`summary_year_summary_year_id`='".$y_data["summary_year_id"]."'");

    $arr = array();

    if($m_rs->num_rows > 0){
      for($x = 0; $x < $m_rs->num_rows; $x++){

        $m_data = $m_rs->fetch_assoc();

        $date = DateTime::createFromFormat('!m', $m_data["summary_month"]);
        $monthName = $date->format('F');

        $d_rs = Database::search("SELECT * FROM `summary_date` WHERE `summary_date`.`summary_month_summary_month_id`='".$m_data["summary_month_id"]."' 
        ORDER BY `summary_date_id` DESC LIMIT 1");
        if($d_rs->num_rows > 0){

          $d_data = $d_rs->fetch_assoc();

          $s_rs = Database::search("SELECT * FROM `summary` WHERE `summary`.`summary_date_summary_date_id`='".$d_data["summary_date_id"]."' 
          ORDER BY `summary_id` DESC LIMIT 1");
          if($s_rs->num_rows > 0){

            $s_data = $s_rs->fetch_assoc();

          }

          $obj = new stdClass();
          $obj->month = $monthName;
          $obj->data = $s_data;

          array_push($arr,$obj);

        }

      }
    }

    echo (json_encode($arr));
  }

} else {
  header("Location:index.php");
}
?>