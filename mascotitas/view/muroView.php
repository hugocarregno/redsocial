<!DOCTYPE html>
<html lang="es">
<head>
    <title>Masctotitas - Muro</title>
    <link rel="stylesheet" type="text/css" href="assets/css/estilo.css" />
    <script type="text/javascript" src="assets/js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8">
    <meta name="description" content="Red social para amantes de los animales">
    <meta name="keywords" content="RedSocialAnimales">
    <link rel="icon" href="assets/img/icono.png" type="image/png" sizes="16x16">
</head>
<body>
<?php include("cabeceraView.php"); ?>
        <div class="container">
        <article>
            <section class="publicar">
              <form method="post" action="<?php echo $helper->url("post","crearPublicacion"); ?>" enctype="multipart/form-data">
                <input type="text" class="titulo" name="titulo" placeholder="Título">
                <textarea placeholder="Cuentanos algo" name="descripcion"></textarea>
                <div class="boton-publicar">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" lang="es" name="foto1">
                    <label class="custom-file-label" for="customFileLang">Foto</label>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" lang="es" name="foto2">
                    <label class="custom-file-label" for="customFileLang">Foto</label>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" lang="es" name="foto3">
                    <label class="custom-file-label" for="customFileLang">Foto</label>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" lang="es" name="adjunto">
                    <label class="custom-file-label" for="customFileLang">Adjunto</label>
                  </div>
                  <input type="radio" name="visibilidad" value="amigos" id="amigos" checked>Amigos
                  <input type="radio" name="visibilidad" value="publico" id="publico">Público
                  <input type="submit" class="btn btn-info" value="Publicar" name="publicar">
                </div>
              </form>
            </section>
            <?php if(isset($post)){
            foreach ($post as $posteo) { ?>
              <section>
              <?php  echo "<div class=\"perfil\"><div class=\"foto\"><img src=\"".DIRECTORIO.$_SESSION['tipo'].'/'.$posteo->imagenPerfil."\" alt=\"$posteo->usuario\" width=\"50px\" height=\"50px\"></div>
              <div class=\"publicado\"><h2>$posteo->titulo</h2><h3><form method=\"post\" action=\"{$helper->url('usuario','perfil')}\" ><button type=\"submit\" class=\"btn btn-link\" style=\"display:inherit;\" name=\"busqueda\" value=\"$posteo->usuario\">$posteo->nombre $posteo->apellido</button><input type=\"hidden\" name=\"lugar\" value=\"muro\"></form></h3><h3>".date('d-m-Y H:i:s', strtotime($posteo->fecha))."</h3></div>
              <div style=\"clear: both;\"></div></div>";
                      echo "<div class=\"publicacion\"><p>$posteo->descripcion</p><img src=\"".DIRECTORIO.'post/'.$posteo->foto1."\" width=\"50%\"></div> ";
                      echo "<div class=\"acciones\"><span> Comentar </span>";
                      if($_SESSION['usuario']==$posteo->usuario){
                        echo "<input type=\"button\" name=\"editar\" value=\"Editar\" id=\"$posteo->id\" class=\"btn btn-info btn-xs edit_data\" />";
                      }
                      echo "<span> Denunciar</span><input type=\"image\" src=\"assets/img/denunciar.png\" width=\"20px\" height=\"20px\"></div>";
                      //echo "<input type=\"hidden\" name=\"posteoId\" id=\"posteoId\" />";

               ?>
              </section>
          <?php  }
          } ?>
        </article>



<!--

            <div class="comentarios">
                <span>comentario1</span><input type="image" src="img/denunciar.png" width="20px" height="20px">
                <h6>10-06-19 20:31</h6>
            </div>
        </section>
-->



    </div>

<footer>
	+cotitas 2019
</footer>
</body>
</html>
