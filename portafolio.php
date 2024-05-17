<?php include("./header.php"); ?>
<?php include("./connection.php"); ?>
<?php

$objConexion = new Connection();

$sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, 'proyecto1', 'imagen 1', 'imagen del proyecto 1');";

$objConexion->ejecutar($sql);

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
                    <form action="./portafolio.php" method="post">

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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Aplicacion web</td>
                        <td>imagen.jpg</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Aplicacion de escritorio</td>
                        <td>imagen2.jpg</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include("./footer.php"); ?>