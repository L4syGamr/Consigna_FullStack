<?php
require "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
   <div class="container">
    <h1 class="text-center my-4">GESTIÓN DE DOCUMENTOS de Serena Case, 3MA</h1>
    <div class="row">
        <div class="col-12">
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php endif; ?>
            <table class="table table-hover bg-light shadow-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Ruta de Archivo</th>
                        <th scope="col">Fecha de Emision</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM documentos WHERE ACTIVO = 1;";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $documento = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <?php foreach ($documento as $doc): ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($doc["ID"]) ?></th>
                        <td><?= htmlspecialchars($doc["TITULO"]) ?></td>
                        <td><?= htmlspecialchars($doc["TIPO"]) ?></td>
                        <td><?= htmlspecialchars($doc["RUTA_ARCHIVO"]) ?></td>
                        <td><?= htmlspecialchars($doc["FECHA_EMISION"]) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mb-4">

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white"><h2>CREAR DOCUMENTO <img src="logo/guardar.png"width="20" height="20" style="border-radius: 10px;"></h2> </div>
            
                <div class="card-body">
                    <form method="post" action="alta_documento.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="TITULO" placeholder="Ingresar Titulo" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="CEDULA_PACIENTE" placeholder="Ingresar Cédula"required maxlength="8">
                        </div>
                        <div class="form-group">
                            <input type="text" name="NOM_ARCHIVO" placeholder="Ingresar Titulo de Documento" required>
                        </div>
                        <div class="form-group">
                            <input type="file" name="ARCHIVO">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="TIPO" required>
                                <option value="">Seleccionar Tipo</option>
                                <option>indicacion</option>
                                <option>informacion</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success text-white">Enviar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white"><h2>EDITAR DOCUMENTO <img src="logo/editar.png"width="20" height="20" style="border-radius: 10px;"></h2></div>
                <div class="card-body">
                    <form method="post" action="editar_documento.php">
                        <div class="form-group">
                            <select class="form-control" name="ID">
                                <?php foreach ($documento as $doc): ?>
                                <option value="<?= htmlspecialchars($doc["ID"]) ?>"><?= htmlspecialchars($doc["TITULO"]) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="TITULO" placeholder="Ingresar Titulo en el sistema" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="CEDULA_PACIENTE" placeholder="Ingresar Cédula"maxlength="8">
                        </div>
                        <div class="form-group">
                            <input type="text" name="NOM_ARCHIVO" placeholder="Ingresar Titulo de Documento">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="TIPO" required>
                                <option>indicacion</option>
                                <option>informacion</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning text-white">Editar</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="row mb-4">

        <div class="col-md-6 offset-md-3">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white"><h2>ELIMINAR DOCUMENTO <img src="logo/eliminar.png" width="20" height="20" style="border-radius: 10px;"></h2></div>
                <div class="card-body">
                    <form method="post" action="eliminar_documento.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <select class="form-control" name="ID">
                                <?php foreach ($documento as $doc): ?>
                                <option value="<?= htmlspecialchars($doc["ID"]) ?>"><?= htmlspecialchars($doc["TITULO"] )?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                       
                        </div>
                        <button type="submit" class="btn btn-danger text-white">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>

        

    </div>

</div>

    
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
