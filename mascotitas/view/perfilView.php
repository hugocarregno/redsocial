<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Perfil</title>
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
<div class="usuario_muro">
    <div class="usuario">
        <img src="<?php echo DIRECTORIO."usuario_sitio/".$_SESSION['imagenPerfil']; ?>" alt="perfil"/>
        <div class="usuario_nombre"><?php if(isset($usuario)){
          echo $usuario[0]->usuario;
        }else{
          echo $_SESSION['usuario'];
        }  ?></div>

    </div>
    <div class="usuario_nombrecompleto"><?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?></div>
    <?php if($_SESSION['tipo']=="Usuario"){ ?>
      <form action="<?php if(isset($amistad)){
          if($amistad[0]->estado=="pendiente" || $amistad[0]->estado=="aceptado"){
            echo $helper->url('amistad','cancelarAmistad');
            $clase="btn btn-danger";
            $texto="Cancelar Amistad";
          }
          if($amistad[0]->estado=="cancelado" || $amistad[0]->estado=="rechazado"){
            echo $helper->url('amistad','solicitarAmistad');
            $clase="btn btn-info";
            $texto="Solicitar Amistad";
          }
          if($amistad[0]->estado=="eliminadoE" || $amistad[0]->estado=="eliminadoR"){
            echo $helper->url('amistad','solicitarAmistad');
            $clase="btn btn-info";
            $texto="Solicitar Amistad";
          }
            }else{
            if(isset($usuario)){echo $helper->url('amistad','solicitarAmistad');
            $clase="btn btn-info";
            $texto="Solicitar Amistad";}

            }   ?> " method="post">
            <?php  if(isset($usuario)){echo "<button class=\"$clase\" name=\"btn_accion\">$texto</button><input type=\"hidden\" name=\"id\" value=\"{$usuario[0]->id}\" >"; } ?>
          </form>
    <?php    } ?>
</div>
<div class="usuario_menu">
    <ul><li class="opcion"><a href="#">Información</a></li>
        <?php if($_SESSION['tipo']=="Usuario"){
          echo "<li class=\"opcion\"><a href=\"#\">Publicaciones</a></li>
          <li class=\"opcion\"><a href=\"#\">Fotos</a></li>";
        }?>
    </ul>
    <br>
    <div class="desplegable">
        <section>
            Nombre: <?php if(isset($usuario)){
              echo $usuario[0]->nombre;
            }else{ echo $_SESSION['nombre']; } ?>
        </section>
        <section>
            Apellido: <?php if(isset($usuario)){
              echo $usuario[0]->apellido;
            }else{ echo $_SESSION['apellido']; } ?>
        </section>
        <section>
            Sexo: <?php if(isset($usuario)){
              if($usuario[0]->sexo==1){
                echo "masculino";
              }else{
                echo "femenino";
              }
            }else{ if($_SESSION['sexo']==1){
              echo "masculino";
            }else{
              echo "femenino";
            }
            } ?>
        </section>
        <section>
            E - mail: <?php if(isset($usuario)){ echo $usuario[0]->mail; }else{ echo $_SESSION['mail'];} ?>
        </section>
        <section>
            Teléfono: <?php if(isset($usuario)){ echo $usuario[0]->telefono; }else{ echo $_SESSION['telefono'];} ?>
        </section>
        <section>
            Se unio : <?php if(isset($usuario)){ echo $usuario[0]->fechaAlta; }else{ echo $_SESSION['fechaAlta']; } ?>
        </section>
    </div>
</div>
<footer>
    <?php echo NOMBRE_EMPRESA; ?> 2019
</footer>
</body>
</html>
