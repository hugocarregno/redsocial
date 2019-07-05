<?php if(!$_SESSION){
  header("location:indexView.php");
}
?>
<header class="cabecera">
  <nav>
    <ul>
      <li>
        <a href="<?php echo $helper->url("usuario","perfil"); ?>"><span class="menu-foto"></span></a>
      </li>
      <li class="nombre"><?php echo $_SESSION['apellido']." ".$_SESSION['nombre']; ?></li>
      <li class="rol"><?php echo $_SESSION['tipo']; ?></li>
      <li>
        <form action="#">
          <input type="text" placeholder="Buscar">
          <button>
            <img src="assets/img/lupa.png" height="16" alt="Buscar">
          </button>
        </form>
      </li>
      <li class="menu_opcion opcion"><a href="<?php echo $helper->url("usuario","muro"); ?>">Inicio</a></li>
      <li class="opcion"><a href="<?php echo $helper->url("usuario","amigos"); ?>">Solicitud</a></li>
      <li class="opcion"><a href="<?php echo $helper->url("usuario","perfil"); ?>">Perfil</a></li>
      <li class="opcion"><a href="<?php echo $helper->url("login","cerrarSesion"); ?>">Salir</a></li>
    </ul>
  </nav>
</header>
