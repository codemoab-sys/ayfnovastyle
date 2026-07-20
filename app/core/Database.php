<?php
namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
            ];
            $this->connection = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            if (function_exists('error_log')) {
                error_log('[Database] ' . $e->getMessage());
            }
            http_response_code(500);
            die('Error de conexión a la base de datos.');
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public static function beginTransaction()
    {
        self::getInstance()->connection->beginTransaction();
    }

    public static function commit()
    {
        self::getInstance()->connection->commit();
    }

    public static function rollback()
    {
        if (self::getInstance()->connection->inTransaction()) {
            self::getInstance()->connection->rollBack();
        }
    }
}
