<!DOCTYPE html>
<html lang="es">
<head>
        <title>Solicitudes</title>
        <link rel="stylesheet" type="text/css" href="assets/css/estilo.css" />
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta charset="utf-8">
        <meta name="description" content="Red social para amantes de los animales">
        <meta name="keywords" content="RedSocialAnimales">
        <link rel="icon" href="assets/img/icono.png" type="image/png" sizes="16x16">
</head>
<body>
  <?php include("cabeceraView.php"); ?>
              <div class="container">
                <p>Solicitudes</p>
                    <article>
                      <?php if(isset($amistad)){
                        foreach ($amistad as $solicitud) { ?>
                          <section><img src="<?php echo $solicitud->imagenPerfil; ?>" alt="<?php echo $solicitud->nombre; ?>" width="50px" height="50px">";
                          <a href="<?php echo $helper->url("usuario","perfil"); ?>"><?php echo $solicitud->nombre." ".$solicitud->apellido; ?></a><button class="btn btn-success">Aceptar</button><button type="button" class="btn btn-danger">Rechazar</button>
                          </section>
                      <?php  } ?>
                    <?php  }else{
                      echo "no hay solicitudes";
                    } ?>
                    </article>
                </div>
</body>
<footer>
  +cotitas 2019
</footer>
</html>
