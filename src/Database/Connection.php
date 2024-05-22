<?php
namespace App\Database;
use PDO;
use PDOException;

$servername = "localhost";
$username = "root";
$password = "3264";
$dbname = "fatec";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Definir o modo de erro do PDO para exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão bem-sucedida";
} catch(PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
}

class Connection
{
    private $conn;
    
    function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "3264";
        $dbname = "fatec";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Definir o modo de erro do PDO para exceção
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexão bem-sucedida";
        } catch(PDOException $e) {
            echo "Conexão falhou: " . $e->getMessage();
        }

    }

    function query($sql)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    

    function query_insert($sql)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    function query_update($sql)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function query_delete($sql)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }
}

?>
