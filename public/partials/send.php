<?php
header('Content-Type: text/html; charset=utf-8');
require_once 'connection.php'; // подключаем скрипт

if (isset($_POST['firstname']) && isset($_POST['email'])) {

   $firstname = $_POST['firstname'];
   $lastname = $_POST['lastname'];
   $email = $_POST['email'];
   $country = $_POST['country'];
   $firstname = htmlspecialchars($firstname);
   $lastname = htmlspecialchars($lastname);
   $email = htmlspecialchars($email);
   $country = htmlspecialchars($country);
   $firstname = urldecode($firstname);
   $lastname = urldecode($lastname);
   $email = urldecode($email);
   $country = urldecode($country);
   $firstname = trim($firstname);
   $lastname = trim($lastname);
   $email = trim($email);
   $country = trim($country);
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
        <td style='padding:10px 5px; width:100px;'><b>FIRST NAME:</b></td>
        <td style='padding: 10px 5px;'>" . $firstname . "</td></tr>
        <td style='padding:10px 5px; width:100px;'><b>LAST NAME:</b></td>
        <td style='padding: 10px 5px;'>" . $lastname . "</td></tr>
        <td style='padding: 10px 5px;'><b>EMAIL:</b></td>
        <td style='padding: 10px 5px;'>" . $email . "</td></tr>
        <td style='padding:10px 5px; width:100px;'><b>COUNTRY:</b></td>
        <td style='padding: 10px 5px;'>" . $country . "</td></tr>
    <tr>";

   // подключаемся к серверу
   $link = mysqli_connect($host_vps, $user_vps, $password_vps, $database_vps)
      or die("Ошибка " . mysqli_error($link));

   // экранирования символов для mysql
   $firstname = htmlentities(mysqli_real_escape_string($link, $firstname));
   $lastname = htmlentities(mysqli_real_escape_string($link, $lastname));
   $email = htmlentities(mysqli_real_escape_string($link, $email));
   $country = htmlentities(mysqli_real_escape_string($link, $country));

   // создание строки запроса
   $query = "INSERT INTO users VALUES(NULL, '$firstname','$lastname','$email','$country')";

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
