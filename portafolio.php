<?php include("./header.php"); ?>
<?php include("./connection.php"); ?>
<?php


if ($_POST) {
    //print_r($_POST);

    $nombre = $_POST['nombre'];

    $objConexion = new Connection();

    //$sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, 'proyecto1', 'imagen 1', 'imagen del proyecto 1');";
    $sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', 'imagen 1', 'imagen del proyecto 1');";

    $objConexion->ejecutar($sql);
    //$mostrar = $objConexion->ejecutar($sql);
    //print_r($mostrar);
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
                        <td class="align-middle"> <a class="btn btn-danger" href="#">Eliminar</a> </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include("./footer.php"); ?>