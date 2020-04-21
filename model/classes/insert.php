<?php
namespace Database;
use Settings;
use \PDO;
use \PDOException;

class Insert
{
    protected $host = Settings\host;
    protected $dbname = Settings\dbname;
    protected $username = Settings\username;
    protected $password = Settings\password;
    protected $charset = Settings\charset;

    public function connect()
    {
        try {

            $pdo = new PDO("mysql:host=".$this->host.";charset=".$this->charset.";dbname=".$this->dbname, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function createTable($table)
    {
        $statement = $this->connect()->prepare($table);
        $statement->execute();
    }

    public function insertDay($data, $valute_id, $num_code, $char_code, $name, $value, $date)
    {
            $statement = $this->connect()->prepare($data);
            $statement->bindParam(':valute_id', $valute_id);
            $statement->bindParam(':num_code', $num_code);
            $statement->bindParam(':char_code', $char_code);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':value', $value);
            $statement->bindParam(':date', $date);
            $statement->execute();
    }

    public function insertDyn($data, $valute_id_dyn, $value, $date)
    {
        $statement = $this->connect()->prepare($data);
        $statement->bindParam(':valute_id', $valute_id_dyn);
        $statement->bindParam(':value', $value);
        $statement->bindParam(':date', $date);
        $statement->execute();
    }

    public function select($sql)
    {
        $statement = $this->connect()->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $response = json_encode($result, JSON_UNESCAPED_UNICODE);
        echo $response;
    }
}