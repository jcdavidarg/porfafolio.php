<?php include("./header.php"); ?>
<?php include("./connection.php"); ?>
<?php


if ($_POST) {
    //print_r($_POST);

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $fecha = new DateTime();

    $imagen = $fecha->getTimestamp() . "_" . $_FILES['archivo']['name'];

    $imagen_temporal = $_FILES['archivo']['tmp_name'];
    move_uploaded_file($imagen_temporal, "imagenes/".$imagen);

    $objConexion = new Connection();
    $sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$imagen', '$descripcion');";
    $objConexion->ejecutar($sql);
    //$mostrar = $objConexion->ejecutar($sql);
    //print_r($mostrar);
}

if ($_GET) {

    //DELETE FROM `proyectos` WHERE `proyectos`.`id` = 20
    $id = $_GET['borrar'];
    $objConexion = new Connection();
    $sql = "DELETE FROM `proyectos` WHERE `proyectos`.`id` = " . $id;
    $objConexion->ejecutar($sql);
}

$objConexion = new Connection();
$proyectos = $objConexion->consultar("SELECT * FROM `proyectos`");
//print_r($proyectos);

?>
<br />
<br />

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Datos del proyecto
                </div>
                <div class="card-body">
                    <form action="./portafolio.php" method="post" enctype="multipart/form-data">

                        Nombre del proyecto: <input class="form-control" type="text" name="nombre" id="">
                        <br />
                        Imagen del proyecto: <input class="form-control" type="file" name="archivo" id="">
                        <br />
                        Descripción:
                        <textarea class="form-control" name="descripcion" id="" rows="3"></textarea>
                        <br/>
                        <input class="btn btn-success" type="submit" value="Enviar proyecto">

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($proyectos as $proyecto) {?>
                    <tr>
                        <td class="align-middle"><?php echo $proyecto['id']; ?></td>
                        <td class="align-middle"><?php echo $proyecto['nombre']; ?></td>
                        <td class="align-middle"><?php echo $proyecto['imagen']; ?></td>
                        <td class="align-middle"><?php echo $proyecto['descripcion']; ?></td>
                        <td class="align-middle"> <a class="btn btn-danger" href="?borrar=<?php echo $proyecto['id']; ?>">Eliminar</a> </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include("./footer.php"); ?>