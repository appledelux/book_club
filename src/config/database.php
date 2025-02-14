<?php
class Database
{
    private static $host = 'db';
    private static $port = '3306';

    private static $dbName = 'book_club';
    private static $username = 'root';
    private static $password = 'root';
    private static $conn;

    public static function getConnection()
    {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO("mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbName . ";charset=utf8", self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
?>