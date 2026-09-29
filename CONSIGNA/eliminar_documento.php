<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['ID'];
if (!is_numeric($id)) {
        $mensajes[] = "Error: El ID debe ser un número.";
    }
if (empty($mensajes)) {
    try {
        $sql = "UPDATE DOCUMENTOS
                SET ACTIVO = 0
                WHERE ID = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':ID' => $id
        ]);

Header("Location: formulario.php?ok=3");
exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }}}
