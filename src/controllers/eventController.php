<?php

require_once __DIR__ . '/../config/database.php';

class Event
{
    private $conn;
    private $table_name = "events";

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

    public function findById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save($title, $date, $description)
    {
        try {
            $query = "INSERT INTO " . $this->table_name . " (title, date, description) VALUES (:title, :date, :description)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":date", $date);
            $stmt->bindParam(":description", $description);

            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Evento guardado con éxito.'];
            }
            return ['success' => false, 'message' => 'Error al guardar el evento.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    public function update($id, $title, $date, $description)
    {
        try {
            $query = "UPDATE " . $this->table_name . " 
                  SET title = :title, date = :date, description = :description 
                  WHERE id = :id";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":date", $date);
            $stmt->bindParam(":description", $description);

            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Evento actualizado correctamente.'];
            }
            return ['success' => false, 'message' => 'Error al actualizar el evento.'];
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
                    return ['success' => true, 'message' => 'Evento eliminado correctamente.'];
                } else {
                    return ['success' => false, 'message' => 'No se encontró el evento para eliminar.'];
                }
            }
            return ['success' => false, 'message' => 'Error al eliminar el evento.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
}


?>