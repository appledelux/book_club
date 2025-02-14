<?php
require_once __DIR__ . '/../config/database.php';

class Book
{
    private $conn;
    private $table_name = "books";

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

    public function save($title, $author, $book_genre, $year_published)
    {

        if (empty($title) || empty($author)) {
            return ['success' => false, 'message' => 'Título y autor son obligatorios.'];
        }

        $query = "INSERT INTO " . $this->table_name . " (title, author, book_genre, year_published) VALUES (:title, :author, :book_genre, :year_published)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":author", $author);
        $stmt->bindParam(":book_genre", $book_genre);
        $stmt->bindParam(":year_published", $year_published);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Libro guardado con éxito.'];
        }
        return ['success' => false, 'message' => 'Error al guardar el libro.'];

    }


    public function update($id, $title, $author, $book_genre, $year_published)
    {
        try {
            $query = "UPDATE " . $this->table_name . " 
                  SET title = :title, 
                      author = :author, 
                      book_genre = :book_genre, 
                      year_published = :year_published 
                  WHERE id = :id";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":author", $author);
            $stmt->bindParam(":book_genre", $book_genre);
            $stmt->bindParam(":year_published", $year_published);

            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Libro actualizado correctamente.'];
            }
            return ['success' => false, 'message' => 'Error al actualizar el libro.'];
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
                    return ['success' => true, 'message' => 'Libro eliminado correctamente.'];
                } else {
                    return ['success' => false, 'message' => 'No se encontró el libro para eliminar.'];
                }
            }
            return ['success' => false, 'message' => 'Error al eliminar el libro.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
}
?>