<?php
header('Content-Type: text/html; charset=utf-8');
require_once 'connection.php'; // подключаем скрипт

if (isset($_POST['name']) && isset($_POST['email'])) {

   $name = $_POST['name'];
   $email = $_POST['email'];
   $name = htmlspecialchars($name);
   $email = htmlspecialchars($email);
   $name = urldecode($name);
   $email = urldecode($email);
   $name = trim($name);
   $email = trim($email);
   $success_added_data = '';

   $to = "olegleshiy7@gmail.com";
   $subject = "New users";
   $subject = '=?utf-8?b?' . base64_encode($subject) . '?=';

   $headers = "Content-type: text/html; charset=\"utf-8\"\r\n";
   $headers .= "From: leshiy@gmail.com\r\n";
   $headers .= "MIME-Version: 1.0\r\n";

   $message = "
    <table style='width:300px; margin: 40px; font-size: 15px; font-family: Helvetica, Arial, sans-serif; color:#1f1000;' cellpadding='0' cellspacing='0'>
    <tr>
        <td style='padding:10px 5px; width:100px;'><b>NAME:</b></td>
        <td style='padding: 10px 5px;'>" . $name . "</td></tr>
    <tr>";
   if ($email) {
      $message .= "<tr>
        <td style='padding: 10px 5px;'><b>EMAIL:</b></td>
        <td style='padding: 10px 5px;'>" . $email . "</td></tr>";
   }

   // подключаемся к серверу
   $link = mysqli_connect($host, $user, $password, $database)
      or die("Ошибка " . mysqli_error($link));

   // экранирования символов для mysql
   $name = htmlentities(mysqli_real_escape_string($link, $name));
   $email = htmlentities(mysqli_real_escape_string($link, $email));

   // создание строки запроса
   $query = "INSERT INTO users VALUES(NULL, '$name','$email')";

   // выполняем запрос
   $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
   if ($result) {
      $success_added_data = 'data added';
   }
   // закрываем подключение
   mysqli_close($link);


   if (mail($to, $subject, $message, $headers)) {
      $result = 'Success and ' . $success_added_data;
   } else {
      $result = 'Error!';
   }
   die($result);
} else {
   echo '<span style="color: #ff0000">Fields is empty</span>';
   header('Location: ' . '/', true, 303);
   die();
}
