<?php

class File {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Store file attributes
    public function storeAttributes($attributes) {
        $sql = "INSERT INTO file_attributes (file_name, file_size, uploader_id, upload_time) VALUES (:file_name, :file_size, :uploader_id, :upload_time)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'file_name' => $attributes['file_name'],
            'file_size' => $attributes['file_size'],
            'uploader_id' => $attributes['uploader_id'],
            'upload_time' => $attributes['upload_time']
        ]);
        return $this->db->lastInsertId();
    }

    // Retrieve file attributes
    public function getFileAttributes($id) {
        $sql = "SELECT * FROM file_attributes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
