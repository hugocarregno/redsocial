<?php if(!$_SESSION){
  header("location:indexView.php");
}
?>
<header class="cabecera">
  <nav>
    <ul>
      <li>
        <a href="<?php echo $helper->url("usuario","perfil"); ?>"><span><img class="menu-foto" src="<?php echo DIRECTORIO.$_SESSION['tipo']."/".$_SESSION['imagenPerfil']; ?>"/></span></a>
      </li>
      <li class="nombre"><?php echo $_SESSION['apellido']." ".$_SESSION['nombre']; ?></li>
      <li class="rol"><?php echo $_SESSION['tipo']; ?></li>
      <li>
        <form method="post" action="<?php echo $helper->url("usuario","buscarUsuario"); ?>">
          <input type="search" placeholder="Buscar" name="busqueda">
          <button type="submit" name="buscar">
            <img src="assets/img/lupa.png" height="16" alt="Buscar">
          </button>
        </form>
      </li>
      <li class="menu_opcion opcion"><a href="<?php switch ($_SESSION['tipo']) {
        case 'Usuario':
          echo $helper->url("post","muro");
          break;
        case 'Moderador':
          echo $helper->url("moderador","panelModerador");
          break;
        case 'Administrador':
          echo $helper->url("administrador","panelAdministrador");
          break;
        default:
          header("location:indexView.php");
          break;
      } ?>">Inicio</a></li>
      <li class="opcion"><a href="<?php echo $helper->url("amistad","solicitudes"); ?>">Solicitud</a></li>
      <li class="opcion"><a href="<?php echo $helper->url("usuario","perfil"); ?>">Perfil</a></li>
      <li class="opcion"><a href="<?php echo $helper->url("login","cerrarSesion"); ?>">Salir</a></li>
    </ul>
  </nav>
</header>
