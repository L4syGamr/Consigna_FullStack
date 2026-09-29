<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = $_POST['TITULO'];
    $id = $_POST['CEDULA_PACIENTE'];
    $tipo = $_POST['TIPO'];
    $nom_archivo = $_POST['NOM_ARCHIVO'];

    $ruta = "documentos/$tipo/$nom_archivo.pdf";

    // move_uploaded_file  Mueve el archivo subido a la ruta definida en $tipo 
    move_uploaded_file($_FILES['ARCHIVO']['tmp_name'], $ruta);

    
    if (!is_numeric($id)) {
        $mensajes[] = "Error: El ID debe ser un número.";
    }
    if ($tipo !== "indicacion" && $tipo !== "informacion") {
        $mensajes[] = "Error: El tipo debe ser 'indicacion' o 'informacion'.";
    }
    if ($titulo === "") {
        $mensajes[] = "Error: Debe tener un titulo.";
    }
    if ($nom_archivo === "") {
        $mensajes[] = "Error: Debe tener un nombre de archivo.";
    }
        if ($id === "" || strlen($id) !== 8 ) {
            $mensajes[] = "Error: La cédula debe ser un número de 8 dígitos.";
        }
    if (empty($mensajes)) {
        
    try {
        $sql = "INSERT INTO DOCUMENTOS (TITULO, TIPO, CEDULA_PACIENTE, RUTA_ARCHIVO, FECHA_EMISION
        ) 
                VALUES (:TITULO, :TIPO, :CEDULA_PACIENTE, :RUTA_ARCHIVO, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':TITULO' => $titulo,
            ':TIPO' => $tipo,
            ':CEDULA_PACIENTE' => $id,
            ':RUTA_ARCHIVO' => $ruta,
        ]);

        Header("Location: formulario.php?ok=1");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
