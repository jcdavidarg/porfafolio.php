<?php include("./header.php"); ?>
<?php include("./connection.php"); ?>
<?php


if ($_POST) {
    //print_r($_POST);

    //  Obtengo nombre del formulario
    $nombre = $_POST['nombre'];

    //  Obtengo descripcion del formulario
    $descripcion = $_POST['descripcion'];

    //  Obtengo la fecha y hora actual
    $fecha = new DateTime();
    
    //  Le agrego la fecha y hora a el nombre del archivo nombrado archivo del formulario
    $imagen = $fecha->getTimestamp() . "_" . $_FILES['archivo']['name'];

    //  Obtengo el arhivo de forma temporal
    $imagen_temporal = $_FILES['archivo']['tmp_name'];

    //  Guarda el archivo temporal en una ruta y un nombre determinado
    move_uploaded_file($imagen_temporal, "imagenes/".$imagen);

    //  Creo una instancia de conexion para ejecutar el INSERT a la tabla proyectos con todos los campos recuperados del formulario
    $objConexion = new Connection();
    $sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$imagen', '$descripcion');";
    $objConexion->ejecutar($sql);
}

if ($_GET) {

    //  Obtengo el parametro borrar con su id de la url
    $id = $_GET['borrar'];

    //  Creo una instancia de conexion para consultar con el id traer el nombre de la imagen en la db 
    $objConexion = new Connection();
    $imagen = $objConexion->consultar("SELECT `imagen` FROM `proyectos` WHERE id=" . "$id;");

    //  Borra el archivo localmente
    unlink("imagenes/" . $imagen[0]['imagen']);

    //  Borrar el registro en la db del id seleccionando
    $sql = "DELETE FROM `proyectos` WHERE `proyectos`.`id` = " . $id;
    $objConexion->ejecutar($sql);
}

//  Creo una instancia para consultar y guardar en un variable la table proyectos de la db
$objConexion = new Connection();
$proyectos = $objConexion->consultar("SELECT * FROM `proyectos`");


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
                        <td class="align-middle">
                            <img width="150" 
                                src="./imagenes/<?php echo $proyecto['imagen']; ?>" 
                                class="img-fluid" 
                                alt="imagen de referencia de <?php echo $proyecto['nombre']; ?>"
                            >
                        </td>
                        <td class="align-middle"><?php echo $proyecto['descripcion']; ?></td>
                                                                            <!-- MANDO POR LA URL UNA QUERY - PARAMETRO LLAMADO borrar con el id del registro -->
                        <td class="align-middle"> <a class="btn btn-danger" href="?borrar=<?php echo $proyecto['id']; ?>">Eliminar</a> </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include("./footer.php"); ?>