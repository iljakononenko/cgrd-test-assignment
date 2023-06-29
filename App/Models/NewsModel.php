<?php

namespace App\Models;

use PDO;

/**
 * Post model
 *
 */
class NewsModel extends \Core\Model {

    /**
     * Get all the news as an associative array
     *
     * @return array
     */
    public static function getAll() {
    
        try {
            $db = static::getDB();

            $stmt = $db->query('SELECT id, title, description FROM news ORDER BY id');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Get one the news as an associative array
     *
     * @return array
     */
    public static function getOne($id) {

        try {
            $db = static::getDB();

            $sql = "SELECT id, title, description FROM news WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function addNews($title, $description) {
        try {
            $db = static::getDB();

            $sql = "INSERT INTO news (title, description) VALUES (?, ?)";
            $db->prepare($sql)->execute([$title, $description]);
            return $db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function editNews($id, $title, $description) {
        try {
            $db = static::getDB();

            $sql = "UPDATE news SET title=?, description=? WHERE id = ?";
            $db->prepare($sql)->execute([$title, $description, $id]);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function removeNews($id) {
        try {
            $db = static::getDB();

            $sql = "DELETE FROM news WHERE id = ?";
            $db->prepare($sql)->execute([$id]);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
