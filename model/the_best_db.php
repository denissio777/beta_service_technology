<?php
header('Content-type: application/json');
include ("./classes/insert.php");
include ("../config/settings.php");
use Database\Insert as Conn;

if (isset($_GET['valute_id'])) { $valute_id = $_GET['valute_id']; if ($valute_id == '') { unset($valute_id);} }
if (isset($_GET['date_to'])) { $date_to = $_GET['date_to']; if ($date_to == '') { unset($date_to);} }
if (isset($_GET['date_from'])) { $date_from = $_GET['date_from']; if ($date_from == '') { unset($date_from);} }

$pdo = new Conn();
$sql = "SELECT DISTINCT `date`,`value`,`name`,`char_code`,`num_code` FROM `currency` WHERE `date` BETWEEN '" . $date_from . "' AND '" . $date_to . "' AND (valute_id = '" . $valute_id . "')";
$pdo->select($sql);
$pdo = null;
$sql = null;