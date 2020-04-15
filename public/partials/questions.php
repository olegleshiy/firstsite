<?php
header('Content-Type: text/html; charset=utf-8');

if (isset($_REQUEST) && isset($_REQUEST['sendto'])) {
    $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
    $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : false;

    $to = $_REQUEST['sendto'];
    $subject = "TEST";
    $subject = '=?utf-8?b?' . base64_encode($subject) . '?=';

    $headers = "Content-type: text/html; charset=\"utf-8\"\r\n";
    $headers .= "From: info@test.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";

    $message = "
    <table style='width:300px; margin: 40px; font-size: 15px; font-family: Helvetica, Arial, sans-serif; color:#1f1000;' cellpadding='0' cellspacing='0'>
    <tr>
        <td style='padding:10px 5px; width:100px;'><b>NAME:</b></td>
        <td style='padding: 10px 5px;'>" . $name . "</td></tr>
    <tr>";
    if ($phone) {
        $message .= "<tr>
        <td style='padding: 10px 5px;'><b>PHONE:</b></td>
        <td style='padding: 10px 5px;'>" . $phone . "</td></tr>";
    }
    if (mail($to, $subject, $message, $headers)) {
        $result = 'success';
    } else {
        $result = 'Error!';
    }
    die($result);
}
