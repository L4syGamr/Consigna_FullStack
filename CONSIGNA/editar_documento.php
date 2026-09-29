<?php
require "conexion.php";

$mensajes = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id          = $_POST['ID'];
    $titulo      = trim($_POST['TITULO']);
    $cedula      = $_POST['CEDULA_PACIENTE'];
    $tipo        = $_POST['TIPO'];
    $nom_archivo = trim($_POST['NOM_ARCHIVO']);

    if (!is_numeric($id) || !is_numeric($cedula)) {
        $mensajes[] = "Error: El ID y la cédula deben ser números.";
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
        if ($cedula === "" || strlen($cedula) !== 8 ) {
            $mensajes[] = "Error: La cédula debe ser un número de 8 dígitos.";
        }

    if (empty($mensajes)) {
        try {
            $stmt = $pdo->prepare("SELECT RUTA_ARCHIVO FROM DOCUMENTOS WHERE ID = :ID");
            $stmt->execute([':ID' => $id]);
            $rutaActual = $stmt->fetchColumn();

            if ($rutaActual === false) {
                $mensajes[] = "Error: No existe un documento con ese ID.";
            } else {
                $rutaNueva = "documentos/$tipo/$nom_archivo.pdf";

                if ($rutaActual !== $rutaNueva && !rename($rutaActual, $rutaNueva)) {
                    $mensajes[] = "Error: No se pudo renombrar el archivo.";
                } else {
                    $sql = "UPDATE DOCUMENTOS
                            SET TITULO = :TITULO, TIPO = :TIPO, CEDULA_PACIENTE = :CEDULA_PACIENTE, RUTA_ARCHIVO = :RUTA_ARCHIVO, FECHA_EMISION = NOW()
                            WHERE ID = :ID";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':TITULO'          => $titulo,
                        ':TIPO'            => $tipo,
                        ':CEDULA_PACIENTE' => $cedula,
                        ':RUTA_ARCHIVO'    => $rutaNueva,
                        ':ID'              => $id,                    ]);

                    header("Location: formulario.php?ok=2");
                    exit;
                }
            }}
        } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();

    }
}
