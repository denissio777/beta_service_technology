<?php

$servername = "localhost";
$username = "mysql";
$password = "mysql";
$dbname = "exchange_db";

if (isset($_POST['valute_id'])) { $valute_id = $_POST['valute_id']; if ($valute_id == '') { unset($valute_id);} }
if (isset($_POST['valute_id_dyn'])) { $valute_id_dyn = $_POST['valute_id_dyn']; if ($valute_id_dyn == '') { unset($valute_id_dyn);} }
if (isset($_POST['num_code'])) { $num_code = $_POST['num_code']; if ($num_code == '') { unset($num_code);} }
if (isset($_POST['char_code'])) { $char_code = $_POST['char_code']; if ($char_code =='') { unset($char_code);} }
if (isset($_POST['name'])) { $name = $_POST['name']; if ($name =='') { unset($name);} }
if (isset($_POST['value'])) { $value = $_POST['value']; if ($value =='') { unset($value);} }
if (isset($_POST['value_dyn'])) { $value_dyn = $_POST['value_dyn']; if ($value_dyn =='') { unset($value_dyn);} }
if (isset($_POST['date'])) { $date = $_POST['date']; if ($date =='') { unset($date);} }
if (isset($_POST['date_dyn'])) { $date_dyn = $_POST['date_dyn']; if ($date_dyn =='') { unset($date_dyn);} }

try {
$pdo = new PDO("mysql:host=".$servername.";dbname=".$dbname, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = "CREATE TABLE IF NOT EXISTS currency (
        id INT (99) PRIMARY KEY NOT NULL AUTO_INCREMENT,
        valute_id VARCHAR (9) NOT NULL,
        num_code INT (5) NOT NULL,
        char_code VARCHAR (5) NOT NULL,
        name VARCHAR (25) NOT NULL,
        value VARCHAR (11) NOT NULL,
        date DATE NOT NULL
    );";
    $mysql = $pdo->prepare($stmt);
    $mysql->execute();

    $stmt_dyn = "CREATE TABLE IF NOT EXISTS $valute_id (
            id INT (99) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            valute_id VARCHAR (9) NOT NULL,
            value VARCHAR (11) NOT NULL,
            date VARCHAR (25) NOT NULL
        );";
        $mysql_dyn = $pdo->prepare($stmt_dyn);
        $mysql_dyn->execute();

$statement = "INSERT INTO currency (valute_id, num_code, char_code, name, value, date) VALUES (:valute_id, :num_code, :char_code, :name, :value, :date)";

    $sql = $pdo->prepare($statement);
    $sql->bindParam(':valute_id', $valute_id);
    $sql->bindParam(':num_code', $num_code);
    $sql->bindParam(':char_code', $char_code);
    $sql->bindParam(':name', $name);
    $sql->bindParam(':value', $value);
    $sql->bindParam(':date', $date);
    $sql->execute();

    $statement_dyn = "INSERT INTO $valute_id (valute_id, value, date) VALUES (:valute_id, :value, :date)";

        $sql_dyn = $pdo->prepare($statement_dyn);
        $sql_dyn->bindParam(':valute_id', $valute_id_dyn);
        $sql_dyn->bindParam(':value', $value_dyn);
        $sql_dyn->bindParam(':date', $date_dyn);
        $sql_dyn->execute();
}
catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
$pdo->close();