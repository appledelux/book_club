<?php

require_once __DIR__ . '/../config/database.php';

class Review
{
    private $conn;
    private $table_name = "reviews";

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }


    public function findAll()
    {
        $query = "SELECT reviews.id, reviews.comment, reviews.date, users.username as user, users.id as user_id, books.title AS book_title, books.id as book_id 
                  FROM " . $this->table_name . " 
                  JOIN users ON reviews.id_user = users.id 
                  JOIN books ON reviews.id_book = books.id 
                  ORDER BY reviews.date DESC";

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

    public function save($comment, $date, $id_book, $id_user)
    {
        try {
            $query = "INSERT INTO " . $this->table_name . " (comment, date, id_book, id_user) VALUES (:comment, :date, :id_book, :id_user)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":comment", $comment);
            $stmt->bindParam(":date", $date);
            $stmt->bindParam(":id_book", $id_book);
            $stmt->bindParam(":id_user", $id_user);

            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Reseña guardada con éxito.'];
            }
            return ['success' => false, 'message' => 'Error al guardar la reseña.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }

    }

    public function update($id, $comment, $date, $id_book, $id_user)
    {
        try {
            $query = "UPDATE " . $this->table_name . " 
                  SET comment = :comment, date = :date, id_book = :id_book, id_user = :id_user 
                  WHERE id = :id";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':comment', $comment);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':id_book', $id_book);
            $stmt->bindParam(':id_user', $id_user);

            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Reseña actualizada correctamente.'];
            }
            return ['success' => false, 'message' => 'Error al actualizar la reseña.'];
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
                    return ['success' => true, 'message' => 'Reseña eliminada correctamente.'];
                } else {
                    return ['success' => false, 'message' => 'No se encontró la reseña para eliminar.'];
                }
            }
            return ['success' => false, 'message' => 'Error al eliminar la reseña.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
}
?>