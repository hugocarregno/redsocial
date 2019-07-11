<!DOCTYPE html>
<html lang="es">
<head>
        <title>Masctotitas - Solicitudes</title>
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
                          <section style="display: inline-flex"><img src="<?php echo DIRECTORIO.$_SESSION['tipo']."/".$solicitud->imagenPerfil; ?>" alt="<?php echo $solicitud->nombre; ?>" width="50px" height="50px">
                          <form method="post" action="<?php echo $helper->url("usuario","perfil"); ?>"><button type="submit" class="btn btn-link" name="usuario" value="<?php echo $solicitud->usuario; ?>"><?php echo $solicitud->usuario; ?></button></form>
                          <?php echo "<form style=\"display:inline;\" action=\"{$helper->url('amistad','gestionAmistad')}\" method=\"post\"><input type=\"hidden\" name=\"id\" value=\"$solicitud->id\"><button class=\"btn btn-success\" type=\"submit\" name=\"btnAccion\" value=\"confirmado\">Aceptar</button></form>
                          <form style=\"display:inline;\" action=\"{$helper->url('amistad','gestionAmistad')}\" method=\"post\"><input type=\"hidden\" name=\"id\" value=\"$solicitud->id\"><button class=\"btn btn-danger\" type=\"submit\" name=\"btnAccion\" value=\"rechazado\">Rechazar</button></form>"; ?>
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
