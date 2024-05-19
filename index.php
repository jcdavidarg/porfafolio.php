    <?php include("./header.php"); ?>
    <?php include("./connection.php"); ?>
    <?php
    
    //  Creo una instancia para consultar y guardar en un variable la table proyectos de la db
    $objConexion = new Connection();
    $proyectos = $objConexion->consultar("SELECT * FROM `proyectos`");
    
    ?>

    <div class="p-5 bg-light">
        <div class="container">
            <h3 class="display-3">Bienvenidos</h3>
            <p class="lead">Este es un portafolio de prueba aplicando conceptos básicos de PHP y MYSQL</p>
            <hr class="my-2">
            <p>Mas información</p>
        </div>
    </div>

    <br/>
    <br/>
    
    <div class="row row-cols-1 row-cols-md-3 g-4">

        <?php foreach($proyectos as $proyecto) {?>

            <div class="col">
                <div class="card">
                    <div class="image-container">
                        <img src="./imagenes/<?php echo $proyecto['imagen']; ?>" 
                            class="card-img-top" 
                            alt="imagen de referencia de <?php echo $proyecto['nombre']; ?>"
                        >
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $proyecto['nombre']; ?></h5>
                        <p class="card-text"><?php echo $proyecto['descripcion']; ?></p>
                    </div>
                </div>
            </div>
            
        <?php } ?>

    </div>

    <br/>
    <br/>

    <?php include("./footer.php"); ?>
