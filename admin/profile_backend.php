<?php
   $fname=$_POST["fname"];
   $lname=$_POST["lname"];
   $position=$_POST["position"];
   $email=$_POST["email"];
   $phone=$_POST["phone"];
   $connection=new mysqli("localhost","root","20029090KpsK@","black_stone_db");
   $connection->query("INSERT INTO `management`(`f_name`,`l_name`,`email`)
   values('".$fname."','".$lname."','".$email."')") ;

   $connection->query("INSERT INTO `management_position` (`position`) VALUES('".$position."')");
   $connection->query("INSERT INTO `management_mobile` (`mobile`) VALUES('".$phone."')");

   echo("You Have Updated Your Data Sucessfully");
 
?>