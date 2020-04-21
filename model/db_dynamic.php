<?php
header('Content-type: application/json');
include ("./classes/insert.php");
include ("../config/settings.php");
use Database\Insert as Conn;

if (isset($_POST['valute_id'])) { $valute_id = $_POST['valute_id']; if ($valute_id == '') { unset($valute_id);} }
if (isset($_POST['valute_id_dyn'])) { $valute_id_dyn = $_POST['valute_id_dyn']; if ($valute_id_dyn == '') { unset($valute_id_dyn);} }
if (isset($_POST['value_dyn'])) { $value = $_POST['value_dyn']; if ($value =='') { unset($value);} }
if (isset($_POST['date_dyn'])) { $date = $_POST['date_dyn']; if ($date =='') { unset($date);} }

$pdo = new Conn();
$table = "CREATE TABLE IF NOT EXISTS $valute_id (
            id INT (99) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            valute_id VARCHAR (9) NOT NULL,
            value VARCHAR (11) NOT NULL,
            date VARCHAR (25) NOT NULL
        );";
$pdo->createTable($table);
$data = "INSERT INTO $valute_id (valute_id, value, date) VALUES (:valute_id, :value, :date)";
$pdo->insertDyn($data, $valute_id_dyn, $value, $date);
$pdo = null;
$table = null;
$data = null;