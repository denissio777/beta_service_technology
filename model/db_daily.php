<?php
header('Content-type: application/json');
include ("./classes/insert.php");
include ("../config/settings.php");
use Database\Insert as Conn;

if (isset($_POST['valute_id'])) { $valute_id = $_POST['valute_id']; if ($valute_id == '') { unset($valute_id);} }
if (isset($_POST['num_code'])) { $num_code = $_POST['num_code']; if ($num_code == '') { unset($num_code);} }
if (isset($_POST['char_code'])) { $char_code = $_POST['char_code']; if ($char_code =='') { unset($char_code);} }
if (isset($_POST['name'])) { $name = $_POST['name']; if ($name =='') { unset($name);} }
if (isset($_POST['value'])) { $value = $_POST['value']; if ($value =='') { unset($value);} }
if (isset($_POST['date'])) { $date = $_POST['date']; if ($date =='') { unset($date);} }

$pdo = new Conn();
$table = "CREATE TABLE IF NOT EXISTS currency (
        id INT (99) PRIMARY KEY NOT NULL AUTO_INCREMENT,
        valute_id VARCHAR (9) NOT NULL,
        num_code INT (5) NOT NULL,
        char_code VARCHAR (5) NOT NULL,
        name VARCHAR (25) NOT NULL,
        value VARCHAR (11) NOT NULL,
        date DATE NOT NULL
    );";
$pdo->createTable($table);
$data = "INSERT INTO currency (valute_id, num_code, char_code, name, value, date) VALUES (:valute_id, :num_code, :char_code, :name, :value, :date)";
$pdo->insertDay($data, $valute_id, $num_code, $char_code, $name, $value, $date);
$pdo = null;
$table = null;
$data = null;