<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Masctotitas - Perfil</title>
        <link rel="stylesheet" type="text/css" href="assets/css/estilo.css" />
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
        <script type="text/javascript" src="assets/js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
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
        <img src="<?php echo DIRECTORIO.$_SESSION['tipo']."/"; if(isset($usuario)){ echo $usuario[0]->imagenPerfil; }else{ echo $_SESSION['imagenPerfil'];} ?>" alt="perfil" style="border-radius:50%; width:200px; height:200px;" />
        <div class="usuario_nombre"><?php if(isset($usuario)){
          echo $usuario[0]->usuario;
        }else{
          echo $_SESSION['usuario'];
        }  ?></div>

    </div>
    <div class="usuario_nombrecompleto"><?php if(isset($usuario)){echo $usuario[0]->nombre." ".$usuario[0]->apellido;}else{ echo $_SESSION['nombre']." ".$_SESSION['apellido']; }  ?>
    <?php if($_SESSION['tipo']=="Usuario"){ ?>
      <form action="<?php if(isset($amistad)){
        //$_SESSION['amistad']=$amistad[0]->estado;
          if($amistad[0]->estado=="pendiente"){
            echo $helper->url('amistad','gestionAmistad');
            $clase="btn btn-danger";
            if($amistad[0]->usuarioEmisor==$_SESSION['id']){
              $texto="Cancelar Solicitud";
              $valorBtn="enviado";
            }else{
              $texto="Rechazar Solicitud";
              $valorBtn="rechazado";
            }
          }
          if($amistad[0]->estado=="aceptado"){
            echo $helper->url('amistad','gestionAmistad');
            $clase="btn btn-danger";
            if($amistad[0]->usuarioEmisor==$_SESSION['id']){
              $valorBtn="eliminadoE";
            }else{
              $valorBtn="eliminadoR";
            }
            $texto="Cancelar Amistad";
          }
          if($amistad[0]->estado=="cancelado" || $amistad[0]->estado=="rechazado"){
            echo $helper->url('amistad','gestionAmistad');
            $clase="btn btn-info";
            $texto="Enviar Solicitud";
            $valorBtn="enviar";
          }
          if($amistad[0]->estado=="eliminadoE" || $amistad[0]->estado=="eliminadoR"){
            echo $helper->url('amistad','gestionAmistad');
            $clase="btn btn-info";
            $texto="Enviar Solicitud";
            $valorBtn="enviar";
          }
            }else{
            if(isset($usuario)){
              echo $helper->url('amistad','gestionAmistad');
              $clase="btn btn-info";
              $texto="Enviar Solicitud";
              $valorBtn="enviar";
            }

          }  ?> " method="post">
      <?php
      if(isset($usuario)){
        if($valorBtn=="rechazado"){
          echo "<button style=\"display:inline;\" class=\"btn btn-success\" name=\"btnAccion\" value=\"enviar\" >Aceptar</button>";
        }
        echo "<button style=\"display:inline;\" class=\"$clase\" name=\"btnAccion\" value=\"$valorBtn\" >$texto</button>";
        echo "<input type=\"hidden\" name=\"id\" value=\"{$usuario[0]->id}\"><input type=\"hidden\" name=\"lugar\" value=\"perfil\">";
        }

     } ?></form>

</div>


<div class="usuario_menu">
    <ul><li class="opcion"><a href="#">Información</a></li>
        <?php //if($_SESSION['tipo']=="Usuario"){
        //  echo "<li class=\"opcion\"><a href=\"#\">Publicaciones</a></li>
          //<li class=\"opcion\"><a href=\"#\">Fotos</a></li>";
        //} ?>
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
            Se unio : <?php if(isset($usuario)){ echo date("d-m-Y", strtotime($usuario[0]->fechaAlta)); }else{ echo date("d-m-Y", strtotime($_SESSION['fechaAlta'])); } ?>
        </section>
    </div>
</div>
<footer>
    <?php echo NOMBRE_EMPRESA; ?> 2019
</footer>
</body>
</html>
