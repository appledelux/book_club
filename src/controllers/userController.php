<?php

require_once __DIR__ . '/../config/database.php';

class User
{
    private $conn;
    private $table_name = "users";

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function findAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByUsername($username)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    public function save($username, $password): array
    {
        try {
            $query = "INSERT INTO " . $this->table_name . " (username, password) VALUES (:username, :password)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);

            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Usuario creado correctamente.'];
            }
            return ['success' => false, 'message' => 'Error al crear el usuario.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }

    }

    public function remove($id)
    {
        try {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    return ['success' => true, 'message' => 'Usuario eliminado correctamente.'];
                } else {
                    return ['success' => false, 'message' => 'No se encontró el usuario para eliminar.'];
                }
            }
            return ['success' => false, 'message' => 'Error al eliminar el usuario.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
}
?>