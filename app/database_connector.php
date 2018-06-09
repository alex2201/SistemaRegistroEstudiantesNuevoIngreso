<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 2/06/18
 * Time: 01:46 AM
 */

$host = '127.0.0.1';
$user = "usuario";
$pass = "Pass.1234";
$database = "sistema_registro";

$conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_error) {
    die('Could not connect: ' . $conn->connect_error);
} else {
    $conn->set_charset("utf8");
}