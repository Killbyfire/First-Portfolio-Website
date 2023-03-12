<?php
require 'openDB.php';

try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $id = htmlspecialchars($_GET['id']);
    $sql = "DELETE FROM comments WHERE Id = $id";
    $conn->exec($sql);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}