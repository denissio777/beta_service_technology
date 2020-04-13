<?php
header('Content-type: application/json');

$servername = "localhost";
$username = "mysql";
$password = "mysql";
$dbname = "exchange_db";

if (isset($_GET['valute_id'])) { $valute_id = $_GET['valute_id']; if ($valute_id == '') { unset($valute_id);} }
if (isset($_GET['date_to'])) { $date_to = $_GET['date_to']; if ($date_to == '') { unset($date_to);} }
if (isset($_GET['date_from'])) { $date_from = $_GET['date_from']; if ($date_from == '') { unset($date_from);} }

try {
$pdo = new PDO("mysql:host=".$servername.";dbname=".$dbname, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = "SELECT DISTINCT `date`,`value`,`name`,`char_code`,`num_code` FROM `currency` WHERE `date` BETWEEN '" . $date_from . "' AND '" . $date_to . "' AND (valute_id = '" . $valute_id . "')";
$sql = $pdo->prepare($statement);
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$response = json_encode($result, JSON_UNESCAPED_UNICODE);
echo $response;
}
catch (PDOException $e) {
    echo $e->getMessage();
    die();
}